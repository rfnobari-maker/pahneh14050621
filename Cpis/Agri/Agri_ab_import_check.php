<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

$action = isset($_GET['action']) ? $_GET['action'] : '';

// ============================================================
// فقط برای action=run_setak (اجرای جداگانه setak.php بدون خروجی)
// ============================================================
if ($action == 'run_setak') {
    $setak_path = dirname(__FILE__) . '/setak.php';
    if (file_exists($setak_path)) {
        ob_start();
        include($setak_path);
        ob_end_clean();
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => 'فایل setak.php پیدا نشد'));
    }
    exit;
}

// ============================================================
// تابع گرفتن Backup از جدول Agri_ab_ostan
// ============================================================
function backup_agri_ab_ostan($dbh) {
    $today = jdate("Ymd");
    $backup_table = "Agri_ab_ostan_" . $today;
    
    $check = $dbh->query("SHOW TABLES LIKE '$backup_table'");
    if ($check->rowCount() > 0) {
        $dbh->exec("DROP TABLE $backup_table");
    }
    
    $create = "CREATE TABLE $backup_table LIKE Agri_ab_ostan";
    $dbh->exec($create);
    
    $insert = "INSERT INTO $backup_table SELECT * FROM Agri_ab_ostan";
    $dbh->exec($insert);
    
    return $backup_table;
}

// ============================================================
// مجموع فیلدهای ابلاغی به تفکیک استان / سال / محصول
// ============================================================
function load_ab_sums($dbh, $table) {
    $allowed = array('Agri_ab_city' => true, 'Agri_ab_mar' => true);
    $sums = array();
    if (!isset($allowed[$table])) {
        return $sums;
    }
    $sql = "SELECT id_ostan, z_sal, product_cod,
                   COALESCE(SUM(s_abi), 0) AS s_abi,
                   COALESCE(SUM(s_dem), 0) AS s_dem,
                   COALESCE(SUM(a_abi), 0) AS a_abi,
                   COALESCE(SUM(a_dem), 0) AS a_dem
            FROM {$table}
            GROUP BY id_ostan, z_sal, product_cod";
    $stmt = $dbh->query($sql);
    if (!$stmt) {
        return $sums;
    }
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $key = $row['id_ostan'] . '|' . $row['z_sal'] . '|' . $row['product_cod'];
        $sums[$key] = $row;
    }
    return $sums;
}

function get_sum_from_map($map, $id_ostan, $z_sal, $product_cod, $field) {
    $key = $id_ostan . '|' . $z_sal . '|' . $product_cod;
    if (isset($map[$key][$field])) {
        return floatval($map[$key][$field]);
    }
    return 0;
}

function load_expert_sums($dbh, $temp_data) {
    $sums = array();
    $years = array();
    foreach ($temp_data as $row) {
        $years[$row['z_sal']] = true;
    }
    foreach ($years as $z_sal => $unused) {
        $prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
        try {
            $sql = "SELECT id_ostan, cod_mah, no_kesh,
                           COALESCE(SUM(zer_kesht_a) + SUM(zer_kesht_b), 0) AS expert_sum
                    FROM {$prod_table}
                    GROUP BY id_ostan, cod_mah, no_kesh";
            $stmt = $dbh->query($sql);
            if (!$stmt) {
                continue;
            }
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $key = $z_sal . '|' . $row['id_ostan'] . '|' . $row['cod_mah'] . '|' . $row['no_kesh'];
                $sums[$key] = floatval($row['expert_sum']);
            }
        } catch (PDOException $e) {}
    }
    return $sums;
}

function add_decrease_conflicts($new_val, $current_val, $checks, $meta, &$conflicts, &$conflict_count) {
    if ($new_val >= $current_val) {
        return false;
    }
    $has_conflict = false;
    foreach ($checks as $check) {
        if ($new_val < $check['sum']) {
            $has_conflict = true;
            $conflicts[] = array(
                'ostan' => $meta['ostan'],
                'z_sal' => $meta['z_sal'],
                'product_name' => $meta['product_name'],
                'field' => $meta['field'],
                'current_value' => $current_val,
                'new_value' => $new_val,
                'reason' => $meta['field'] . ' جدید (' . number_format($new_val, 1) .
                            ') از مجموع ' . $check['label'] . ' (' . number_format($check['sum'], 1) . ') کمتر است'
            );
            $conflict_count++;
        }
    }
    return $has_conflict;
}

function flush_progress_line($payload) {
    echo json_encode($payload);
    echo "\n";
    if (ob_get_level() > 0) {
        ob_flush();
    }
    flush();
}

function stream_check_progress_cb($p) {
    flush_progress_line(array(
        'type' => 'progress',
        'current' => $p['current'],
        'total' => $p['total'],
        'ostan' => $p['ostan'],
        'product' => $p['product']
    ));
}

// ============================================================
// تابع بررسی مغایرت‌ها از جدول موقت
// ترتیب کنترل: شهرستان (Agri_ab_city) → مراکز (Agri_ab_mar) → کشت کارشناسان
// ============================================================
function check_conflicts_from_temp($dbh, &$progress = null, $on_progress = null) {
    $conflicts = array();
    $conflict_count = 0;
    
    $query_temp = "SELECT * FROM Agri_ab_temp ORDER BY id";
    $stmt_temp = $dbh->prepare($query_temp);
    $stmt_temp->execute();
    $temp_data = $stmt_temp->fetchAll(PDO::FETCH_ASSOC);
    $total = count($temp_data);
    $ok = 0;
    $current_index = 0;
    
    $ostans = array();
    $query_ostan = "SELECT id_ostan, ostan FROM ostanname";
    $stmt_ostan = $dbh->prepare($query_ostan);
    $stmt_ostan->execute();
    while ($row = $stmt_ostan->fetch(PDO::FETCH_ASSOC)) {
        $ostans[$row['id_ostan']] = $row['ostan'];
    }
    
    $city_sums = load_ab_sums($dbh, 'Agri_ab_city');
    $mar_sums = load_ab_sums($dbh, 'Agri_ab_mar');
    $expert_sums = load_expert_sums($dbh, $temp_data);
    
    $ostan_map = array();
    $query_current = "SELECT * FROM Agri_ab_ostan";
    $stmt_current = $dbh->query($query_current);
    if ($stmt_current) {
        while ($row = $stmt_current->fetch(PDO::FETCH_ASSOC)) {
            $key = $row['id_ostan'] . '|' . $row['z_sal'] . '|' . $row['product_cod'];
            $ostan_map[$key] = $row;
        }
    }
    
    foreach ($temp_data as $temp_row) {
        $current_index++;
        
        $ostan_name = isset($ostans[$temp_row['id_ostan']]) ? $ostans[$temp_row['id_ostan']] : $temp_row['id_ostan'];
        $progress = array(
            'current' => $current_index,
            'total' => $total,
            'ostan' => $ostan_name,
            'product' => $temp_row['product_name']
        );
        if (is_callable($on_progress)) {
            $on_progress($progress);
        }
        
        $id_ostan = $temp_row['id_ostan'];
        $z_sal = $temp_row['z_sal'];
        $product_cod = $temp_row['product_cod'];
        $product_name = $temp_row['product_name'];
        $row_key = $id_ostan . '|' . $z_sal . '|' . $product_cod;
        
        if (!isset($ostan_map[$row_key])) {
            $ok++;
            continue;
        }
        $current = $ostan_map[$row_key];
        
        $has_conflict = false;
        $meta = array(
            'ostan' => $ostan_name,
            'z_sal' => $z_sal,
            'product_name' => $product_name
        );
        
        $city_s_abi = get_sum_from_map($city_sums, $id_ostan, $z_sal, $product_cod, 's_abi');
        $mar_s_abi = get_sum_from_map($mar_sums, $id_ostan, $z_sal, $product_cod, 's_abi');
        $expert_abi_key = $z_sal . '|' . $id_ostan . '|' . $product_cod . '|1';
        $expert_abi = isset($expert_sums[$expert_abi_key]) ? $expert_sums[$expert_abi_key] : 0;
        
        $meta['field'] = 'سطح آبی';
        if (add_decrease_conflicts($temp_row['s_abi'], $current['s_abi'], array(
            array('sum' => $city_s_abi, 'label' => 'برش شهرستان‌ها'),
            array('sum' => $mar_s_abi, 'label' => 'برش مراکز'),
            array('sum' => $expert_abi, 'label' => 'کشت کارشناسان')
        ), $meta, $conflicts, $conflict_count)) {
            $has_conflict = true;
        }
        
        $city_s_dem = get_sum_from_map($city_sums, $id_ostan, $z_sal, $product_cod, 's_dem');
        $mar_s_dem = get_sum_from_map($mar_sums, $id_ostan, $z_sal, $product_cod, 's_dem');
        $expert_dem_key = $z_sal . '|' . $id_ostan . '|' . $product_cod . '|2';
        $expert_dem = isset($expert_sums[$expert_dem_key]) ? $expert_sums[$expert_dem_key] : 0;
        
        $meta['field'] = 'سطح دیم';
        if (add_decrease_conflicts($temp_row['s_dem'], $current['s_dem'], array(
            array('sum' => $city_s_dem, 'label' => 'برش شهرستان‌ها'),
            array('sum' => $mar_s_dem, 'label' => 'برش مراکز'),
            array('sum' => $expert_dem, 'label' => 'کشت کارشناسان')
        ), $meta, $conflicts, $conflict_count)) {
            $has_conflict = true;
        }
        
        $city_a_abi = get_sum_from_map($city_sums, $id_ostan, $z_sal, $product_cod, 'a_abi');
        $mar_a_abi = get_sum_from_map($mar_sums, $id_ostan, $z_sal, $product_cod, 'a_abi');
        
        $meta['field'] = 'عملکرد آبی';
        if (add_decrease_conflicts($temp_row['a_abi'], $current['a_abi'], array(
            array('sum' => $city_a_abi, 'label' => 'برش شهرستان‌ها'),
            array('sum' => $mar_a_abi, 'label' => 'برش مراکز')
        ), $meta, $conflicts, $conflict_count)) {
            $has_conflict = true;
        }
        
        $city_a_dem = get_sum_from_map($city_sums, $id_ostan, $z_sal, $product_cod, 'a_dem');
        $mar_a_dem = get_sum_from_map($mar_sums, $id_ostan, $z_sal, $product_cod, 'a_dem');
        
        $meta['field'] = 'عملکرد دیم';
        if (add_decrease_conflicts($temp_row['a_dem'], $current['a_dem'], array(
            array('sum' => $city_a_dem, 'label' => 'برش شهرستان‌ها'),
            array('sum' => $mar_a_dem, 'label' => 'برش مراکز')
        ), $meta, $conflicts, $conflict_count)) {
            $has_conflict = true;
        }
        
        if (!$has_conflict) {
            $ok++;
        }
    }
    
    return array(
        'total' => $total,
        'ok' => $ok,
        'conflicts' => $conflicts,
        'conflict_count' => $conflict_count,
        'has_conflict' => ($conflict_count > 0)
    );
}

// ============================================================
// تابع جایگزینی اطلاعات از جدول موقت
// ============================================================
function temp_has_column($dbh, $column) {
    $stmt = $dbh->query("SHOW COLUMNS FROM Agri_ab_temp LIKE " . $dbh->quote($column));
    return $stmt && $stmt->rowCount() > 0;
}

function replace_data_from_temp($dbh) {
    $backup_table = backup_agri_ab_ostan($dbh);
    
    $dbh->exec("TRUNCATE TABLE Agri_ab_ostan");
    
    $today = jdate("Y/m/d");
    $date_select = temp_has_column($dbh, 'date_s')
        ? "CASE WHEN date_s IS NULL OR date_s = '' THEN " . $dbh->quote($today) . " ELSE date_s END"
        : $dbh->quote($today);
    
    $query = "INSERT INTO Agri_ab_ostan 
              (id_ostan, z_sal, product_cod, product_name, group_cod, group_name,
               s_abi, s_dem, t_abi, t_dem, a_abi, a_dem, date_s) 
              SELECT id_ostan, z_sal, product_cod, product_name, group_cod, group_name,
                     s_abi, s_dem, t_abi, t_dem, a_abi, a_dem, {$date_select}
              FROM Agri_ab_temp";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $count = $stmt->rowCount();
    
    return array(
        'backup_table' => $backup_table,
        'inserted_count' => $count
    );
}

// ============================================================
// خروجی CSV مغایرت‌ها
// ============================================================
if ($action == 'export_conflicts' && isset($_SESSION['export_conflicts'])) {
    $conflicts = $_SESSION['export_conflicts'];
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="moghayerat_' . jdate("Y-m-d") . '.csv"');
    echo "\xEF\xBB\xBF";
    
    $output = fopen('php://output', 'w');
    fputcsv($output, array(
        'استان', 'سال', 'محصول', 'فیلد مغایر', 'مقدار فعلی', 'مقدار جدید', 'توضیح کامل'
    ));
    
    foreach ($conflicts as $c) {
        fputcsv($output, array(
            $c['ostan'], $c['z_sal'], $c['product_name'],
            $c['field'],
            $c['current_value'],
            $c['new_value'],
            $c['reason']
        ));
    }
    fclose($output);
    exit;
}

// ============================================================
// بررسی با گزارش پیشرفت واقعی (NDJSON)
// ============================================================
if ($action == 'check_stream') {
    @ini_set('output_buffering', 'off');
    @ini_set('zlib.output_compression', false);
    @ini_set('implicit_flush', true);
    if (function_exists('apache_setenv')) {
        @apache_setenv('no-gzip', 1);
    }
    header('Content-Type: application/x-ndjson; charset=utf-8');
    header('Cache-Control: no-cache');
    header('X-Accel-Buffering: no');
    while (ob_get_level() > 0) {
        ob_end_flush();
    }
    
    $check = $dbh->query("SELECT COUNT(*) FROM Agri_ab_temp")->fetchColumn();
    if ($check == 0) {
        flush_progress_line(array(
            'type' => 'error',
            'message' => '⚠️ جدول موقت خالی است. ابتدا دکمه "دریافت اطلاعات" را بزنید.'
        ));
        exit;
    }
    
    if (session_id()) {
        session_write_close();
    }
    
    $stream_progress = null;
    $result = check_conflicts_from_temp($dbh, $stream_progress, 'stream_check_progress_cb');
    
    if (function_exists('session_start')) {
        @session_start();
    }
    $_SESSION['export_conflicts'] = $result['conflicts'];
    
    flush_progress_line(array(
        'type' => 'done',
        'result' => $result
    ));
    exit;
}

// ============================================================
// اجرای عملیات بر اساس action
// ============================================================
$result = null;
$error = null;
$conflicts = null;
$replace_result = null;
$progress = null;

// دریافت تاریخ و ساعت آخرین دریافت
$temp_count = 0;
$last_fetch_date = '-';
$last_fetch = null;

try {
    $temp_count = $dbh->query("SELECT COUNT(*) FROM Agri_ab_temp")->fetchColumn();
    $last_fetch = $dbh->query("SELECT MAX(created_at) FROM Agri_ab_temp")->fetchColumn();
    if ($last_fetch) {
        $last_fetch_date = jdate("Y/m/d H:i:s", strtotime($last_fetch));
    }
} catch (PDOException $e) {
    $temp_count = 0;
}

if ($action == 'check') {
    $check = $dbh->query("SELECT COUNT(*) FROM Agri_ab_temp")->fetchColumn();
    
    if ($check > 0) {
        $result = check_conflicts_from_temp($dbh, $progress);
        $conflicts = $result['conflicts'];
        $_SESSION['export_conflicts'] = $conflicts;
    } else {
        $error = '⚠️ جدول موقت خالی است. ابتدا دکمه "دریافت اطلاعات" را بزنید.';
    }
}

if ($action == 'replace' && isset($_GET['confirm']) && $_GET['confirm'] == '1') {
    $check = $dbh->query("SELECT COUNT(*) FROM Agri_ab_temp")->fetchColumn();
    if ($check == 0) {
        $error = '⚠️ جدول موقت خالی است. ابتدا عملیات بررسی را انجام دهید.';
    } else {
        $check_result = check_conflicts_from_temp($dbh);
        if ($check_result['has_conflict']) {
            $error = '⚠️ هنوز مغایرت وجود دارد. لطفاً ابتدا مغایرت‌ها را برطرف کنید.';
            $conflicts = $check_result['conflicts'];
            $_SESSION['export_conflicts'] = $conflicts;
        } else {
            $replace_result = replace_data_from_temp($dbh);
        }
    }
}

// ============================================================
// دریافت لیست استان‌ها
// ============================================================
$query_ostan = "SELECT id_ostan, ostan FROM ostanname ORDER BY ostan ASC";
$stmt_ostan = $dbh->prepare($query_ostan);
$stmt_ostan->execute();
$ostan_list = $stmt_ostan->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR" xml:lang="fa">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    
    <style type="text/css">
        body { text-align: right; font-family: Tahoma; direction:rtl; background:#f5f7fa; }
        
        .import-box {
            width: 95%;
            margin: 20px auto;
            padding: 25px;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .import-title {
            font-size: 22px;
            font-weight: bold;
            color: #003366;
            border-bottom: 3px solid #006699;
            padding-bottom: 12px;
            margin-bottom: 25px;
        }
        
        .status-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }
        .status-card {
            background: #fff;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border-right: 4px solid #006699;
        }
        .status-card .stat-number {
            font-size: 18px;
            font-weight: bold;
            color: #003366;
        }
        .status-card .stat-label {
            font-size: 13px;
            color: #666;
            margin-top: 5px;
        }
        .status-card .stat-sub {
            font-size: 12px;
            color: #999;
            margin-top: 3px;
        }
        .status-card.fetched { border-color: #2e7d32; }
        .status-card.fetched .stat-number { color: #2e7d32; }
        .status-card.empty { border-color: #c62828; }
        .status-card.empty .stat-number { color: #c62828; }
        .status-card.warning { border-color: #f57c00; }
        .status-card.warning .stat-number { color: #f57c00; }
        
        .info-box {
            background: #e3f2fd;
            border: 2px solid #006699;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }
        .info-box .info-title {
            font-weight: bold;
            color: #003366;
            font-size: 15px;
            margin-bottom: 5px;
        }
        .info-box .info-text {
            color: #555;
            font-size: 13px;
            line-height: 1.8;
        }
        
        .stats-cards-result {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border-right: 4px solid #006699;
        }
        .stat-card .stat-number {
            font-size: 26px;
            font-weight: bold;
            color: #003366;
        }
        .stat-card .stat-label {
            font-size: 13px;
            color: #666;
            margin-top: 5px;
        }
        .stat-card.conflict { border-color: #c62828; }
        .stat-card.conflict .stat-number { color: #c62828; }
        .stat-card.success { border-color: #2e7d32; }
        .stat-card.success .stat-number { color: #2e7d32; }
        
        .conflict-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 15px;
        }
        .conflict-table th {
            background: #c62828;
            color: #fff;
            padding: 10px 8px;
            text-align: center;
        }
        .conflict-table td {
            padding: 8px 6px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        .conflict-table tr:nth-child(even) { background: #f9f9f9; }
        .conflict-table tr:hover { background: #ffebee; }
        .conflict-table .field-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            color: #fff;
        }
        .field-badge.s_abi { background: #1565c0; }
        .field-badge.s_dem { background: #e65100; }
        .field-badge.a_abi { background: #2e7d32; }
        .field-badge.a_dem { background: #6a1b9a; }
        .conflict-table .reason-text {
            font-size: 12px;
            color: #c62828;
            text-align: right;
        }
        .conflict-table .new-value {
            color: #c62828;
            font-weight: bold;
        }
        
        .btn-check {
            padding: 12px 35px;
            background: #006699;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-family: Tahoma;
            text-decoration: none;
            display: inline-block;
        }
        .btn-check:hover { background: #004d80; }
        
        .btn-fetch {
            padding: 12px 35px;
            background: #f57c00;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-family: Tahoma;
            text-decoration: none;
            display: inline-block;
        }
        .btn-fetch:hover { background: #e65100; }
        
        .btn-replace {
            padding: 12px 35px;
            background: #2e7d32;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-family: Tahoma;
            text-decoration: none;
            display: inline-block;
        }
        .btn-replace:hover { background: #1b5e20; }
        
        .btn-back {
            padding: 10px 25px;
            background: #999;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            font-family: Tahoma;
            text-decoration: none;
            display: inline-block;
        }
        .btn-back:hover { background: #777; }
        
        .btn-csv-export {
            padding: 8px 20px;
            background: #2e7d32;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-csv-export:hover { background: #1b5e20; }
        
        .btn-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 20px;
            justify-content: center;
        }
        
        .success-message {
            background: #e8f5e9;
            border: 2px solid #2e7d32;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .success-message .title {
            font-size: 18px;
            font-weight: bold;
            color: #2e7d32;
        }
        .success-message .detail {
            font-size: 14px;
            color: #555;
            margin-top: 5px;
        }
        
        .error-message {
            background: #ffebee;
            border: 2px solid #c62828;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 20px;
            color: #c62828;
            font-weight: bold;
            text-align: center;
        }
        
        .progress-container {
            display: none;
            margin: 20px 0;
            padding: 20px;
            background: #f0f7ff;
            border-radius: 10px;
            border: 2px solid #006699;
        }
        .progress-container.active {
            display: block;
        }
        .progress-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }
        .progress-info .status-text {
            font-size: 14px;
            color: #003366;
            font-weight: bold;
        }
        .progress-info .status-text .highlight {
            color: #006699;
        }
        .progress-bar-bg {
            width: 100%;
            height: 25px;
            background: #e0e0e0;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }
        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #006699, #4da6d9);
            border-radius: 12px;
            width: 0%;
            transition: width 0.3s ease;
            position: relative;
        }
        .progress-bar-fill.indeterminate,
        .progress-bar-fill.indeterminate,
        #progressFill.indeterminate {
            width: 100% !important;
            background: linear-gradient(90deg, #006699 0%, #4da6d9 40%, #006699 80%);
            background-size: 200% 100%;
            animation: progress-slide 1.2s linear infinite;
            transition: none;
        }
        @keyframes progress-slide {
            0% { background-position: 100% 0; }
            100% { background-position: -100% 0; }
        }
        .progress-bar-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 12px;
            font-weight: bold;
            color: #fff;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
            z-index: 2;
            width: 100%;
            text-align: center;
        }
        .progress-detail {
            font-size: 13px;
            color: #555;
            margin-top: 8px;
            text-align: center;
        }
        .progress-detail .product-name {
            color: #006699;
            font-weight: bold;
        }
        .progress-detail .ostan-name {
            color: #003366;
            font-weight: bold;
        }
        
        .loading-spinner,
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #e0e0e0;
            border-top: 3px solid #006699;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            vertical-align: middle;
            margin-left: 10px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @media (max-width: 900px) {
            .conflict-table { font-size: 11px; }
            .conflict-table th, .conflict-table td { padding: 4px 3px; }
            .status-cards { grid-template-columns: repeat(2, 1fr); }
            .stats-cards-result { grid-template-columns: repeat(2, 1fr); }
            .progress-info { flex-direction: column; gap: 5px; }
        }
    </style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" valign="middle">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
                <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                <td width="840">
                    
                    <div class="import-box">
                        <div class="import-title">📥 بررسی و بروزرسانی اطلاعات ابلاغی استان</div>
                        
                        <!-- ============================================================ -->
                        <!-- کارت‌های وضعیت دریافت اطلاعات -->
                        <!-- ============================================================ -->
                        <div class="status-cards">
                            <div class="status-card <?php echo ($temp_count > 0) ? 'fetched' : 'empty'; ?>">
                                <div class="stat-number"><?php echo number_format($temp_count); ?></div>
                                <div class="stat-label">📋 تعداد رکوردهای موجود</div>
                                <div class="stat-sub"><?php echo ($temp_count > 0) ? '✅ جدول موقت پر است' : '❌ جدول موقت خالی است'; ?></div>
                            </div>
                            <div class="status-card <?php echo ($temp_count > 0) ? 'fetched' : 'empty'; ?>">
                                <div class="stat-number" style="font-size:16px;">
                                    <?php echo $last_fetch_date; ?>
                                </div>
                                <div class="stat-label">📅 آخرین دریافت اطلاعات</div>
                                <div class="stat-sub">
                                    <?php 
                                    if ($last_fetch_date != '-') {
                                        $diff = time() - strtotime($last_fetch);
                                        if ($diff < 86400) {
                                            echo '🟢 امروز';
                                        } elseif ($diff < 172800) {
                                            echo '🟡 دیروز';
                                        } else {
                                            echo '🔴 ' . floor($diff / 86400) . ' روز پیش';
                                        }
                                    } else {
                                        echo '⚠️ هنوز اطلاعاتی دریافت نشده';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="status-card <?php echo ($temp_count > 0) ? 'fetched' : 'empty'; ?>">
                                <div class="stat-number">
                                    <?php 
                                    if ($temp_count > 0) {
                                        $query = "SELECT COUNT(DISTINCT id_ostan) FROM Agri_ab_temp";
                                        $ostan_count = $dbh->query($query)->fetchColumn();
                                        echo number_format($ostan_count);
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </div>
                                <div class="stat-label">🌾 تعداد استان‌های موجود</div>
                                <div class="stat-sub">
                                    <?php 
                                    if ($temp_count > 0) {
                                        $query = "SELECT COUNT(DISTINCT product_name) FROM Agri_ab_temp";
                                        $product_count = $dbh->query($query)->fetchColumn();
                                        echo number_format($product_count) . ' محصول مختلف';
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- ============================================================ -->
                        <!-- توضیحات -->
                        <!-- ============================================================ -->
                        <div class="info-box">
                            <div class="info-title">ℹ️ توضیحات</div>
                            <div class="info-text">
                                این ابزار اطلاعات ابلاغی استان را از سرویس ستاک دریافت کرده و با اطلاعات موجود در جدول <strong>Agri_ab_ostan</strong> مقایسه می‌کند.
                                <br>
                                در صورت کاهش مقدار، به‌ترتیب با <strong>برش شهرستان‌ها</strong>، <strong>برش مراکز</strong> و (برای سطح) <strong>کشت کارشناسان</strong> کنترل می‌شود.
                                <br>
                                <strong>مراحل:</strong>
                                ۱. کلیک روی دکمه <strong>«دریافت اطلاعات»</strong> برای دریافت داده از سرویس ستاک
                                <br>
                                ۲. کلیک روی دکمه <strong>«بررسی و گزارش»</strong> برای مقایسه اطلاعات
                                <br>
                                ۳. در صورت عدم وجود مغایرت، دکمه <strong>«جایگزینی اطلاعات»</strong> فعال می‌شود
                                <br>
                                ۴. قبل از جایگزینی، از جدول فعلی <strong>Backup</strong> گرفته می‌شود
                            </div>
                        </div>
                        
                        <!-- ============================================================ -->
                        <!-- دکمه‌ها -->
                        <!-- ============================================================ -->
                        <div class="btn-actions">
                            <a href="javascript:void(0)" class="btn-fetch" id="btnFetch">📥 دریافت اطلاعات</a>
                            <a href="?action=check" class="btn-check" id="btnCheck">🔍 بررسی و گزارش</a>
                            <a href="?action=replace&confirm=1" class="btn-replace" id="btnReplace" <?php if (!($action == 'check' && isset($result) && !$result['has_conflict'] && !$error)): ?>style="display:none;"<?php endif; ?> onclick="return confirm('آیا از جایگزینی اطلاعات اطمینان دارید؟\nقبل از جایگزینی، Backup گرفته می‌شود.')">
                                📥 جایگزینی اطلاعات
                            </a>
                            <a href="Agri_ab_request_admin.php" class="btn-back">🔙 بازگشت به مدیریت</a>
                        </div>
                        
                        <!-- ============================================================ -->
                        <!-- پیشرفت -->
                        <!-- ============================================================ -->
                        <div class="progress-container" id="progressContainer">
                            <div class="progress-info">
                                <span class="status-text" id="progressStatus">
                                    <span class="loading-spinner"></span>
                                    در حال بررسی ...
                                </span>
                                <span class="status-text" id="progressCount">
                                    <span class="highlight" id="currentNum">0</span> از <span id="totalNum">...</span>
                                </span>
                            </div>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" id="progressFill" style="width: 0%;">
                                    <span class="progress-bar-text" id="progressPercent">۰%</span>
                                </div>
                            </div>
                            <div class="progress-detail" id="progressDetail">
                                در حال بررسی: <span class="ostan-name" id="currentOstan">...</span> - <span class="product-name" id="currentProduct">...</span>
                            </div>
                        </div>
                        <div class="error-message" id="ajaxError" style="display:none;"></div>
                        
                        <!-- ============================================================ -->
                        <!-- خطا -->
                        <!-- ============================================================ -->
                        <?php if ($error): ?>
                        <div class="error-message"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <!-- ============================================================ -->
                        <!-- موفقیت جایگزینی -->
                        <!-- ============================================================ -->
                        <?php if ($replace_result): ?>
                        <div class="success-message">
                            <div class="title">✅ عملیات با موفقیت انجام شد</div>
                            <div class="detail">
                                تعداد رکوردهای جایگزین شده: <strong><?php echo number_format($replace_result['inserted_count']); ?></strong>
                                <br>
                                جدول Backup: <strong><?php echo $replace_result['backup_table']; ?></strong>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- ============================================================ -->
                        <!-- نتیجه بررسی -->
                        <!-- ============================================================ -->
                        <div id="checkResultsWrap">
                        <?php if ($action == 'check' && isset($result) && !$error): ?>
                        
                        <div class="stats-cards-result">
                            <div class="stat-card">
                                <div class="stat-number"><?php echo number_format($result['total']); ?></div>
                                <div class="stat-label">📋 کل رکوردهای بررسی شده</div>
                            </div>
                            <div class="stat-card success">
                                <div class="stat-number"><?php echo number_format($result['ok']); ?></div>
                                <div class="stat-label">✅ بدون مشکل</div>
                            </div>
                            <div class="stat-card <?php echo $result['has_conflict'] ? 'conflict' : 'success'; ?>">
                                <div class="stat-number"><?php echo number_format($result['conflict_count']); ?></div>
                                <div class="stat-label"><?php echo $result['has_conflict'] ? '⚠️ مغایرت' : '✨ بدون مغایرت'; ?></div>
                            </div>
                        </div>
                        
                        <!-- ============================================================ -->
                        <!-- جدول مغایرت‌ها -->
                        <!-- ============================================================ -->
                        <?php if ($result['has_conflict']): ?>
                        <div style="margin-top:10px;">
                            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; margin-bottom:10px;">
                                <span style="font-size:16px; font-weight:bold; color:#c62828;">⚠️ لیست مغایرت‌ها</span>
                                <?php if (count($conflicts) > 0): ?>
                                <a href="?action=export_conflicts" class="btn-csv-export">📥 خروجی CSV مغایرت‌ها</a>
                                <?php endif; ?>
                            </div>
                            <div style="overflow-x:auto;">
                            <table class="conflict-table">
                                <thead>
                                    <tr>
                                        <th>استان</th>
                                        <th>سال</th>
                                        <th>محصول</th>
                                        <th>فیلد مغایر</th>
                                        <th>مقدار فعلی</th>
                                        <th>مقدار جدید</th>
                                        <th>توضیح کامل</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($conflicts as $c): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($c['ostan']); ?></td>
                                        <td><?php echo $c['z_sal']; ?></td>
                                        <td><?php echo htmlspecialchars($c['product_name']); ?></td>
                                        <td>
                                            <?php
                                            $field_class = '';
                                            if ($c['field'] == 'سطح آبی') $field_class = 's_abi';
                                            elseif ($c['field'] == 'سطح دیم') $field_class = 's_dem';
                                            elseif ($c['field'] == 'عملکرد آبی') $field_class = 'a_abi';
                                            elseif ($c['field'] == 'عملکرد دیم') $field_class = 'a_dem';
                                            ?>
                                            <span class="field-badge <?php echo $field_class; ?>">
                                                <?php echo $c['field']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo number_format($c['current_value'], 1); ?></td>
                                        <td class="new-value"><?php echo number_format($c['new_value'], 1); ?></td>
                                        <td class="reason-text"><?php echo htmlspecialchars($c['reason']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            </div>
                            <div style="margin-top:15px; padding:12px; background:#fff3cd; border-radius:8px; border:1px solid #ffc107; text-align:center; color:#856404;">
                                ⚠️ برای رفع مغایرت‌ها، ابتدا برش شهرستان‌ها، برش مراکز یا کشت کارشناسان را اصلاح کنید، سپس دوباره بررسی را انجام دهید.
                            </div>
                        </div>
                        <?php else: ?>
                        <div style="margin-top:20px; padding:20px; background:#e8f5e9; border-radius:8px; border:2px solid #2e7d32; text-align:center;">
                            <div style="font-size:48px;">✅</div>
                            <div style="font-size:18px; font-weight:bold; color:#2e7d32; margin-top:10px;">
                                هیچ مغایرتی یافت نشد!
                            </div>
                            <div style="font-size:14px; color:#555; margin-top:5px;">
                                برای جایگزینی اطلاعات، روی دکمه <strong>«جایگزینی اطلاعات»</strong> کلیک کنید.
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php endif; ?>
                        </div>
                        
                    </div>
                    
                </td>
            </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

<script>
$(document).ready(function() {
    function escapeHtml(str) {
        return String(str == null ? '' : str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }
    function formatNum(n) {
        var x = parseFloat(n);
        if (isNaN(x)) x = 0;
        var parts = x.toFixed(1).split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return parts.join('.');
    }
    function fieldClass(field) {
        if (field === 'سطح آبی') return 's_abi';
        if (field === 'سطح دیم') return 's_dem';
        if (field === 'عملکرد آبی') return 'a_abi';
        if (field === 'عملکرد دیم') return 'a_dem';
        return '';
    }
    function resetProgress() {
        $('#ajaxError').hide().text('');
        $('#progressContainer').addClass('active');
        $('#progressFill').removeClass('indeterminate').css('width', '0%');
        $('#progressPercent').text('۰%');
        $('#currentNum').text('0');
        $('#totalNum').text('...');
        $('#currentOstan').text('...');
        $('#currentProduct').text('...');
        $('#progressCount').show();
        $('#progressDetail').show();
    }
    function setProgress(current, total, ostan, product) {
        var pct = total > 0 ? Math.round((current / total) * 100) : 0;
        $('#progressFill').removeClass('indeterminate').css('width', pct + '%');
        $('#progressPercent').text(pct + '%');
        $('#currentNum').text(current);
        $('#totalNum').text(total);
        if (ostan) $('#currentOstan').text(ostan);
        if (product) $('#currentProduct').text(product);
    }
    function renderCheckResult(result) {
        var html = '';
        html += '<div class="stats-cards-result">';
        html += '<div class="stat-card"><div class="stat-number">' + formatNum(result.total).replace(/\.0$/, '') + '</div><div class="stat-label">📋 کل رکوردهای بررسی شده</div></div>';
        html += '<div class="stat-card success"><div class="stat-number">' + formatNum(result.ok).replace(/\.0$/, '') + '</div><div class="stat-label">✅ بدون مشکل</div></div>';
        html += '<div class="stat-card ' + (result.has_conflict ? 'conflict' : 'success') + '">';
        html += '<div class="stat-number">' + formatNum(result.conflict_count).replace(/\.0$/, '') + '</div>';
        html += '<div class="stat-label">' + (result.has_conflict ? '⚠️ مغایرت' : '✨ بدون مغایرت') + '</div></div></div>';

        if (result.has_conflict) {
            var rows = '';
            var list = result.conflicts || [];
            for (var i = 0; i < list.length; i++) {
                var c = list[i];
                rows += '<tr>';
                rows += '<td>' + escapeHtml(c.ostan) + '</td>';
                rows += '<td>' + escapeHtml(c.z_sal) + '</td>';
                rows += '<td>' + escapeHtml(c.product_name) + '</td>';
                rows += '<td><span class="field-badge ' + fieldClass(c.field) + '">' + escapeHtml(c.field) + '</span></td>';
                rows += '<td>' + formatNum(c.current_value) + '</td>';
                rows += '<td class="new-value">' + formatNum(c.new_value) + '</td>';
                rows += '<td class="reason-text">' + escapeHtml(c.reason) + '</td>';
                rows += '</tr>';
            }
            html += '<div style="margin-top:10px;">';
            html += '<div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; margin-bottom:10px;">';
            html += '<span style="font-size:16px; font-weight:bold; color:#c62828;">⚠️ لیست مغایرت‌ها</span>';
            html += '<a href="?action=export_conflicts" class="btn-csv-export">📥 خروجی CSV مغایرت‌ها</a>';
            html += '</div><div style="overflow-x:auto;"><table class="conflict-table"><thead><tr>';
            html += '<th>استان</th><th>سال</th><th>محصول</th><th>فیلد مغایر</th><th>مقدار فعلی</th><th>مقدار جدید</th><th>توضیح کامل</th>';
            html += '</tr></thead><tbody>' + rows + '</tbody></table></div>';
            html += '<div style="margin-top:15px; padding:12px; background:#fff3cd; border-radius:8px; border:1px solid #ffc107; text-align:center; color:#856404;">';
            html += '⚠️ برای رفع مغایرت‌ها، ابتدا برش شهرستان‌ها، برش مراکز یا کشت کارشناسان را اصلاح کنید، سپس دوباره بررسی را انجام دهید.';
            html += '</div></div>';
            $('#btnReplace').hide();
        } else {
            html += '<div style="margin-top:20px; padding:20px; background:#e8f5e9; border-radius:8px; border:2px solid #2e7d32; text-align:center;">';
            html += '<div style="font-size:48px;">✅</div>';
            html += '<div style="font-size:18px; font-weight:bold; color:#2e7d32; margin-top:10px;">هیچ مغایرتی یافت نشد!</div>';
            html += '<div style="font-size:14px; color:#555; margin-top:5px;">برای جایگزینی اطلاعات، روی دکمه <strong>«جایگزینی اطلاعات»</strong> کلیک کنید.</div>';
            html += '</div>';
            $('#btnReplace').show();
        }
        $('#checkResultsWrap').html(html);
    }
    function processNdjson(text, state) {
        var lines = text.split('\n');
        var complete = lines.length - 1;
        for (var i = state.processed; i < complete; i++) {
            var line = $.trim(lines[i]);
            if (!line) continue;
            try {
                var msg = JSON.parse(line);
                if (msg.type === 'progress') {
                    $('#progressStatus').html('<span class="loading-spinner"></span> در حال بررسی ...');
                    setProgress(msg.current, msg.total, msg.ostan, msg.product);
                } else if (msg.type === 'done') {
                    state.result = msg.result;
                } else if (msg.type === 'error') {
                    state.error = msg.message;
                }
            } catch (ex) {}
        }
        state.processed = complete;
    }

    $('#btnFetch').on('click', function() {
        if (!confirm('آیا از دریافت اطلاعات جدید از سرویس ستاک مطمئن هستید؟\nجدول موقت پاک و دوباره پر می‌شود.')) {
            return false;
        }
        resetProgress();
        $('#progressCount').hide();
        $('#progressDetail').hide();
        $('#progressFill').addClass('indeterminate').css('width', '100%');
        $('#progressPercent').text('...');
        $('#progressStatus').html('<span class="loading-spinner"></span> در حال دریافت داده از سرویس ستاک ...');
        $('#btnFetch').prop('disabled', true).text('⏳ در حال دریافت...');
        $('#btnCheck').css('pointer-events', 'none');

        $.ajax({
            url: '?action=run_setak',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#progressFill').removeClass('indeterminate').css('width', '100%');
                $('#progressPercent').text('۱۰۰%');
                if (response.success) {
                    $('#progressStatus').html('✅ دریافت اطلاعات با موفقیت انجام شد!');
                    alert('✅ اطلاعات با موفقیت دریافت و در جدول موقت ذخیره شد.');
                    location.reload();
                } else {
                    $('#progressContainer').removeClass('active');
                    alert('❌ خطا: ' + response.message);
                    $('#btnFetch').prop('disabled', false).text('📥 دریافت اطلاعات');
                    $('#btnCheck').css('pointer-events', 'auto');
                }
            },
            error: function() {
                $('#progressContainer').removeClass('active');
                alert('❌ خطا در ارتباط با سرور');
                $('#btnFetch').prop('disabled', false).text('📥 دریافت اطلاعات');
                $('#btnCheck').css('pointer-events', 'auto');
            }
        });
    });

    $('#btnCheck').on('click', function(e) {
        e.preventDefault();
        resetProgress();
        $('#checkResultsWrap').empty();
        $('#btnReplace').hide();
        $('#progressStatus').html('<span class="loading-spinner"></span> در حال بررسی ...');
        $('#btnCheck').css('pointer-events', 'none');

        var state = { processed: 0, result: null, error: null };
        $.ajax({
            url: '?action=check_stream',
            type: 'GET',
            dataType: 'text',
            xhr: function() {
                var xhr = $.ajaxSettings.xhr();
                xhr.addEventListener('progress', function() {
                    processNdjson(xhr.responseText || '', state);
                });
                return xhr;
            },
            success: function(text) {
                processNdjson(text || '', state);
                if (state.error) {
                    $('#progressContainer').removeClass('active');
                    $('#ajaxError').text(state.error).show();
                    $('#btnCheck').css('pointer-events', 'auto');
                    return;
                }
                if (!state.result) {
                    $('#progressContainer').removeClass('active');
                    $('#ajaxError').text('❌ پاسخ نامعتبر از سرور دریافت شد.').show();
                    $('#btnCheck').css('pointer-events', 'auto');
                    return;
                }
                setProgress(state.result.total, state.result.total, '', '');
                $('#progressPercent').text('۱۰۰%');
                $('#progressStatus').html('✅ بررسی کامل شد!');
                renderCheckResult(state.result);
                $('#btnCheck').css('pointer-events', 'auto');
            },
            error: function() {
                $('#progressContainer').removeClass('active');
                $('#ajaxError').text('❌ خطا در ارتباط با سرور هنگام بررسی.').show();
                $('#btnCheck').css('pointer-events', 'auto');
            }
        });
    });
});
</script>
</body>
</html>