<?php
session_start();

include('login/config.php');
include('./event.php');

// پردازش لاگین OTP
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['otp'])) {
    $entered_otp = trim($_POST['otp']);
    $bah_cod_m = isset($_SESSION['temp_bah_cod_m']) ? $_SESSION['temp_bah_cod_m'] : null;
    $num_bah   = isset($_SESSION['temp_num_bah']) ? $_SESSION['temp_num_bah'] : null;

    if (!empty($bah_cod_m) && !empty($num_bah)) {
        $stmt = $dbh->prepare("SELECT * FROM otp_logs WHERE bah_cod_m = ? AND otp = ? AND expires_at > NOW() AND is_used = 0 LIMIT 1");
        $stmt->execute(array($bah_cod_m, $entered_otp));
        $otp_row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($otp_row) {
            $update_stmt = $dbh->prepare("UPDATE otp_logs SET is_used = 1 WHERE id = ?");
            $update_stmt->execute(array($otp_row['id']));
            $_SESSION['bah_cod_m'] = $bah_cod_m;
            $_SESSION['num_bah']   = $num_bah;
            unset($_SESSION['temp_bah_cod_m'], $_SESSION['temp_num_bah']);
        }
    }
}

if (!isset($_SESSION['bah_cod_m']) || !isset($_SESSION['num_bah'])) {
    header("Location: login.php");
    exit;
}

$bah_cod_m = $_SESSION['bah_cod_m'];
$num_bah   = $_SESSION['num_bah'];

$stmt = $dbh->prepare("SELECT * FROM bah WHERE bah_cod_m = ? AND num_bah = ? LIMIT 1");
$stmt->execute(array($bah_cod_m, $num_bah));
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) die("اطلاعات یافت نشد.");

$selected_year = isset($_POST['selected_year']) ? $_POST['selected_year'] : '1404';
$active_tab = isset($_POST['active_tab']) ? $_POST['active_tab'] : 'identity';

// نوع شرکت
$company_type_text = '-';
if (isset($user['no_co'])) {
    $company_types = array('1' => 'سهامی عام', '2' => 'سهامی خاص', '3' => 'مسئولیت محدود', '4' => 'تضامنی', '5' => 'نسبی', '6' => 'تعاونی');
    $company_type_text = isset($company_types[$user['no_co']]) ? $company_types[$user['no_co']] : $user['no_co'];
}

// نام جداول زراعی بر اساس سال
$agri_table = "Agri" . $selected_year . "_" . ($selected_year + 1);
$agri_prod_table = "Agri_prod" . $selected_year . "_" . ($selected_year + 1);

// ========== دریافت داده‌های زراعت با یک JOIN (بهینه شده) ==========
function getUserAgriData($dbh, $agri_table, $agri_prod_table, $bah_cod_m, $num_bah) {
    try {
        $sql = "
            SELECT 
                a.id as piece_id, a.sh_gat, a.m_zamin, a.no_kesh, a.s_ayesh,
                p.*, 
                pr.product_name, pr.group_name
            FROM $agri_table a
            LEFT JOIN $agri_prod_table p ON p.Agri_id = a.id AND p.bah_cod_m = a.bah_cod_m AND p.num_bah = a.num_bah
            LEFT JOIN product_z pr ON p.cod_mah = pr.product_cod
            WHERE a.bah_cod_m = ? AND a.num_bah = ?
            ORDER BY a.id DESC, p.id DESC
        ";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($bah_cod_m, $num_bah));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return array();
    }
}

$agri_data = getUserAgriData($dbh, $agri_table, $agri_prod_table, $bah_cod_m, $num_bah);

// پردازش داده‌های زراعت
$agri_pieces = array();
$agri_products = array();
$agri_stats = array(
    'total_pieces' => 0,
    'abi_count' => 0, 
    'dimi_count' => 0,
    'abi_area' => 0, 
    'dimi_area' => 0,
    'abi_harvest' => 0, 
    'dimi_harvest' => 0
);

$pieces_temp = array();
foreach ($agri_data as $row) {
    if (!isset($pieces_temp[$row['piece_id']])) {
        $pieces_temp[$row['piece_id']] = array(
            'id' => $row['piece_id'],
            'sh_gat' => $row['sh_gat'],
            'm_zamin' => $row['m_zamin'],
            'no_kesh' => $row['no_kesh'],
            's_ayesh' => $row['s_ayesh']
        );
        $agri_stats['total_pieces']++;
        if ($row['no_kesh'] == '1') {
            $agri_stats['abi_count']++;
        } elseif ($row['no_kesh'] == '2') {
            $agri_stats['dimi_count']++;
        }
    }
    
    if (!empty($row['id']) && !empty($row['cod_mah'])) {
        $agri_products[] = $row;
        $area = floatval($row['zer_kesht_a']);
        $harvest = floatval($row['s_bar_a']);
        if ($row['no_kesh'] == '1') {
            $agri_stats['abi_area'] += $area;
            $agri_stats['abi_harvest'] += $harvest;
        } elseif ($row['no_kesh'] == '2') {
            $agri_stats['dimi_area'] += $area;
            $agri_stats['dimi_harvest'] += $harvest;
        }
    }
}
$agri_pieces = array_values($pieces_temp);

// ========== سایر فعالیت‌ها با آیکون گندم برای زراعت ==========
$activities = array(
    'agri' => array('count' => $agri_stats['total_pieces'], 'icon' => 'fas fa-tractor', 'name' => 'زراعت', 'color' => '#2e7d32'),
    'vege' => array('count' => (int)bah_vege_count($bah_cod_m, $num_bah, $selected_year."-".($selected_year+1)), 'icon' => 'fas fa-carrot', 'name' => 'صیفی جات', 'color' => '#e67e22'),
    'garden' => array('count' => (int)bah_garden_count($bah_cod_m, $num_bah, $selected_year), 'icon' => 'fas fa-apple-alt', 'name' => 'باغی', 'color' => '#d35400'),
    'mushroom' => array('count' => (int)bah_Mushroom_count($bah_cod_m, $num_bah, $selected_year), 'icon' => 'fas fa-leaf', 'name' => 'قارچ', 'color' => '#8e44ad'),
    'greenhouse' => array('count' => (int)bah_Greenhous_count($bah_cod_m, $num_bah, $selected_year), 'icon' => 'fas fa-warehouse', 'name' => 'گلخانه', 'color' => '#2980b9'),
    'aquatic' => array('count' => (int)bah_Aquatic_count($bah_cod_m, $num_bah, $selected_year), 'icon' => 'fas fa-fish', 'name' => 'آبزی پروری', 'color' => '#16a085'),
    'bee' => array('count' => (int)bah_bee_count($bah_cod_m, $num_bah, $selected_year), 'icon' => 'fas fa-bug', 'name' => 'زنبور عسل', 'color' => '#f39c12')
);
$has_any_activity = false;
foreach ($activities as $act) {
    if ($act['count'] > 0) $has_any_activity = true;
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>داشبورد بهره‌بردار</title>
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }
        
        .dashboard-header {
            background: linear-gradient(135deg, #1e6b3b 0%, #0d3b1f 100%);
            color: white;
            padding: 30px 0;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .btn-logout-circle {
            position: absolute;
            left: 25px;
            top: 25px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(5px);
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
        }
        
        .btn-logout-circle:hover {
            background: rgba(255,255,255,0.35);
            transform: scale(1.05);
            color: white;
        }
        
        .dashboard-header h2 { font-size: 1.8rem; font-weight: 500; margin: 10px 0 5px; }
        .dashboard-header p { opacity: 0.9; font-size: 1rem; }
        
        .nav-tabs { border-bottom: none; gap: 10px; flex-wrap: wrap; justify-content: center; margin-bottom: 25px; }
        .nav-tabs .nav-link {
            border: none; color: #555; font-weight: 500; padding: 10px 28px;
            border-radius: 50px; transition: all 0.25s ease; background: white; 
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .nav-tabs .nav-link:hover { background: #e8f5e9; color: #2e7d32; transform: translateY(-2px); }
        .nav-tabs .nav-link.active { background: #2e7d32; color: white; box-shadow: 0 4px 12px rgba(46,125,50,0.3); }
        
        .card {
            border: none; border-radius: 24px; box-shadow: 0 8px 24px rgba(0,0,0,0.05);
            overflow: hidden; margin-bottom: 25px; transition: transform 0.2s ease;
        }
        .card:hover { transform: translateY(-3px); }
        
        .card-header {
            text-align: right;
            background: white; border-bottom: 1px solid #f0f0f0;
            padding: 18px 24px; font-weight: 600; color: #1a3a2a; font-size: 1.1rem;
        }
        .card-header i { color: #2e7d32; margin-left: 10px; }
        
        .info-table { width: 100%; }
        .info-table tr { border-bottom: 1px solid #f0f0f0; transition: background 0.2s; }
        .info-table tr:hover { background: #fafbfc; }
        .info-table td { padding: 14px 20px; }
        .info-label { background: #f8f9fa; font-weight: 600; color: #2c5e3c; width: 180px; }
        .info-value { color: #1e2a3a; }
        
        .activity-card {
            background: white;
            border-radius: 24px;
            padding: 24px 15px;
            text-align: center;
            box-shadow: 0 6px 18px rgba(0,0,0,0.05);
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            cursor: pointer;
            border: 1px solid rgba(0,0,0,0.03);
            height: 100%;
        }
        .activity-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 30px rgba(0,0,0,0.12);
            background: linear-gradient(145deg, #ffffff, #fefefe);
        }
        .activity-icon { font-size: 48px; margin-bottom: 18px; display: inline-block; }
        .activity-count { font-size: 34px; font-weight: 800; line-height: 1.2; color: #1e2a3a; }
        .activity-name { font-size: 14px; color: #6c757d; margin-top: 10px; font-weight: 500; letter-spacing: 0.3px; }
        
        .modal-custom .modal-content {
            border-radius: 28px;
            border: none;
            overflow: hidden;
        }
        .modal-custom .modal-header {
            background: linear-gradient(135deg, #1e6b3b, #0d3b1f);
            color: white;
            border: none;
            padding: 20px 28px;
        }
        .modal-custom .modal-body { padding: 28px; background: #f8fafc; }
        
        .two-columns {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            margin-bottom: 35px;
        }
        .column-card {
            flex: 1;
            min-width: 250px;
            background: white;
            border-radius: 24px;
            padding: 24px;
            transition: all 0.2s ease;
        }
        .column-card.abi { background: linear-gradient(135deg, #e8f4fd, #ffffff); border-right: 4px solid #2196F3; }
        .column-card.dimi { background: linear-gradient(135deg, #fff8e7, #ffffff); border-right: 4px solid #FF9800; }
        
        .column-title {
            font-size: 20px;
            font-weight: 700;
            padding-bottom: 15px;
            margin-bottom: 20px;
            border-bottom: 2px solid;
            text-align: center;
        }
        .column-title.abi { color: #1976d2; border-bottom-color: #90caf9; }
        .column-title.dimi { color: #f57c00; border-bottom-color: #ffcc80; }
        
        .stat-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .stat-label { color: #5a6e7c; font-size: 14px; font-weight: 500; }
        .stat-value { font-weight: 800; font-size: 18px; }
        .stat-value.abi { color: #1976d2; }
        .stat-value.dimi { color: #f57c00; }
        
        .products-table-wrapper {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }
        .products-table { width: 100%; border-collapse: collapse; }
        .products-table th {
            background: #f1f8e9;
            color: #2e5c2e;
            font-weight: 700;
            padding: 14px 12px;
            font-size: 13px;
        }
        .products-table td { padding: 12px 12px; border-bottom: 1px solid #edf2f7; font-size: 13px; }
        .products-table tr:hover td { background-color: #f8fff4; }
        
        .badge-type {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 600;
        }
        .badge-abi { background: #e3f2fd; color: #1976d2; }
        .badge-dimi { background: #fff3e0; color: #f57c00; }
        
        .empty-message { text-align: center; padding: 70px 20px; color: #9aa6b5; background: white; border-radius: 24px; }
        .footer { text-align: center; padding: 25px; font-size: 12px; color: #9aa6b5; border-top: 1px solid #e9ecef; margin-top: 30px; }
        
        /* ================== رفع مشکل فلش در سلیکت (RTL) ================== */
        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: left 0.75rem center !important;
            background-size: 16px 12px;
            padding: 0.6rem 0.75rem 0.6rem 2.2rem !important;
            text-align: right;
            direction: rtl;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            border-radius: 16px;
            border: 1px solid #dee2e6;
            font-size: 14px;
            cursor: pointer;
        }
        
        .form-select:hover {
            border-color: #2e7d32;
        }
        
        .form-select:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 0 0.2rem rgba(46,125,50,0.25);
        }
        
        select.form-select option {
            direction: rtl;
            text-align: right;
            padding: 8px;
        }
        
        /* افزایش عرض و بهبود نمایش */
        .year-select-wrapper {
            max-width: 220px;
        }
        
        .form-label {
            font-weight: 600;
            color: #2c5e3c;
            margin-bottom: 8px;
            display: block;
            text-align: right;
        }
        
        @media (max-width: 768px) {
            .two-columns { flex-direction: column; gap: 16px; }
            .info-label { width: 120px; font-size: 12px; }
            .nav-tabs .nav-link { padding: 6px 16px; font-size: 13px; }
            .dashboard-header h2 { font-size: 1.3rem; }
            .btn-logout-circle { left: 15px; top: 15px; width: 38px; height: 38px; }
            .year-select-wrapper { max-width: 100%; }
        }
    </style>
</head>
<body>

<div class="dashboard-header">
    <a href="logout.php" class="btn-logout-circle" title="خروج">
        <i class="fas fa-sign-out-alt"></i>
    </a>
    <div class="container">
        <i class="fas fa-seedling" style="font-size: 44px;"></i>
        <h2>پورتال بهره‌بردار کشاورزی</h2>
        <p class="mb-0">
            <?php echo htmlspecialchars($user['name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8'); ?>
            <?php if($user['no_bah'] == '2' && !empty($user['co_name'])): ?>
                | <?php echo htmlspecialchars($user['co_name'], ENT_QUOTES, 'UTF-8'); ?>
            <?php endif; ?>
        </p>
    </div>
</div>

<div class="container">
    
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link <?php echo ($active_tab=='identity') ? 'active' : ''; ?>" data-bs-toggle="tab" href="#identity">
                <i class="fas fa-user-circle ms-1"></i> اطلاعات هویتی
            </a>
        </li>
        <?php if ($user['no_bah'] == '2'): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo ($active_tab=='company') ? 'active' : ''; ?>" data-bs-toggle="tab" href="#company">
                <i class="fas fa-building ms-1"></i> اطلاعات شرکت
            </a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link <?php echo ($active_tab=='history') ? 'active' : ''; ?>" data-bs-toggle="tab" href="#history">
                <i class="fas fa-chart-line ms-1"></i> سوابق فعالیت
            </a>
        </li>
    </ul>

    <div class="tab-content">
        
        <div class="tab-pane fade <?php echo ($active_tab=='identity') ? 'show active' : ''; ?>" id="identity">
            <div class="card">
                <div class="card-header"><i class="fas fa-id-card"></i> اطلاعات هویتی</div>
                <div class="card-body p-0">
                    <table class="info-table">
                        <tr><td class="info-label">نوع بهره‌بردار</td><td class="info-value"><?php echo ($user['no_bah'] == '1') ? 'حقیقی' : 'حقوقي'; ?></td></tr>
                        <tr><td class="info-label">نام</td><td class="info-value"><?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                        <tr><td class="info-label">نام خانوادگی</td><td class="info-value"><?php echo htmlspecialchars($user['last_name'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                        <tr><td class="info-label">کد ملی</td><td class="info-value"><?php echo htmlspecialchars($user['bah_cod_m'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                        <?php if(!empty($user['sh_meli'])): ?>
                        <tr><td class="info-label">شناسه ملی</td><td class="info-value"><?php echo htmlspecialchars($user['sh_meli'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                        <?php endif; ?>
                        <tr><td class="info-label">شماره همراه</td><td class="info-value"><?php echo htmlspecialchars($user['tel_m'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                        <tr><td class="info-label">تلفن ثابت</td><td class="info-value"><?php echo !empty($user['tel_s']) ? htmlspecialchars($user['tel_s'], ENT_QUOTES, 'UTF-8') : '-'; ?></td></tr>
                        <tr><td class="info-label">استان</td><td class="info-value"><?php echo htmlspecialchars($user['ostan_s'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                        <tr><td class="info-label">شهرستان</td><td class="info-value"><?php echo !empty($user['shahr_s']) ? htmlspecialchars($user['shahr_s'], ENT_QUOTES, 'UTF-8') : '-'; ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
        
        <?php if ($user['no_bah'] == '2'): ?>
        <div class="tab-pane fade <?php echo ($active_tab=='company') ? 'show active' : ''; ?>" id="company">
            <div class="card">
                <div class="card-header"><i class="fas fa-building"></i> اطلاعات شرکت</div>
                <div class="card-body p-0">
                    <table class="info-table">
                        <tr><td class="info-label">نام شرکت</td><td class="info-value"><strong><?php echo htmlspecialchars(!empty($user['co_name']) ? $user['co_name'] : '-', ENT_QUOTES, 'UTF-8'); ?></strong></td></tr>
                        <tr><td class="info-label">شناسه ملی</td><td class="info-value"><?php echo htmlspecialchars(!empty($user['sh_meli']) ? $user['sh_meli'] : '-', ENT_QUOTES, 'UTF-8'); ?></td></tr>
                        <tr><td class="info-label">شماره ثبت</td><td class="info-value"><?php echo htmlspecialchars(!empty($user['co_sabt']) ? $user['co_sabt'] : '-', ENT_QUOTES, 'UTF-8'); ?></td></tr>
                        <tr><td class="info-label">نوع شرکت</td><td class="info-value"><?php echo htmlspecialchars($company_type_text, ENT_QUOTES, 'UTF-8'); ?></td></tr>
                        <tr><td class="info-label">نماینده</td><td class="info-value"><?php echo htmlspecialchars($user['name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="tab-pane fade <?php echo ($active_tab=='history') ? 'show active' : ''; ?>" id="history">
            <div class="card">
                <div class="card-header"><i class="fas fa-chart-line"></i> سوابق فعالیت</div>
                <div class="card-body">
                    
                    <form method="POST" class="mb-4" id="yearForm">
                        <input type="hidden" name="active_tab" value="history">
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt text-success ml-1"></i> سال زراعی
                                </label>
                                <div class="year-select-wrapper">
                                    <select name="selected_year" class="form-select w-100" onchange="document.getElementById('yearForm').submit()">
                                        <?php
                                        $years = array('1405','1404','1403','1402','1401','1400');
                                        foreach($years as $y) {
                                            $selected = ($y == $selected_year) ? 'selected' : '';
                                            echo "<option value='$y' $selected>$y-".($y+1)."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <?php if ($has_any_activity): ?>
                    <div class="row">
                        <?php foreach ($activities as $act_key => $act): ?>
                            <?php if ($act['count'] > 0): ?>
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                                <div class="activity-card" onclick="openActivityModal('<?php echo $act_key; ?>')">
                                    <div class="activity-icon"><i class="<?php echo $act['icon']; ?>" style="color: <?php echo $act['color']; ?>; font-size: 48px;"></i></div>
                                    <div class="activity-count"><?php echo number_format($act['count']); ?></div>
                                    <div class="activity-name"><?php echo $act['name']; ?></div>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                        <div class="empty-message">
                            <i class="fas fa-seedling" style="font-size: 56px; color: #cbd5e0;"></i>
                            <p class="mt-3">هیچ فعالیت کشاورزی برای سال <?php echo $selected_year; ?> ثبت نشده است.</p>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="footer">
        <i class="fas fa-leaf"></i> سامانه پهنه‌بندی و مدیریت داده‌های کشاورزی
    </div>
    
</div>

<!-- مودال زراعت (با آیکون گندم) -->
<div class="modal fade modal-custom" id="modal_agri" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-wheat-alt ms-2"></i> جزئیات زراعت - سال <?php echo $selected_year . " - " . ($selected_year+1); ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                
                <div class="two-columns">
                    <div class="column-card abi">
                        <div class="column-title abi"><i class="fas fa-tint"></i> کشت آبی</div>
                        <div class="stat-row">
                            <span class="stat-label">تعداد قطعات</span>
                            <span class="stat-value abi"><?php echo number_format($agri_stats['abi_count']); ?></span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">سطح زیر کشت (هکتار)</span>
                            <span class="stat-value abi"><?php echo number_format($agri_stats['abi_area'], 2); ?></span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">سطح برداشت (هکتار)</span>
                            <span class="stat-value abi"><?php echo number_format($agri_stats['abi_harvest'], 2); ?></span>
                        </div>
                    </div>
                    
                    <div class="column-card dimi">
                        <div class="column-title dimi"><i class="fas fa-cloud-sun"></i> کشت دیم</div>
                        <div class="stat-row">
                            <span class="stat-label">تعداد قطعات</span>
                            <span class="stat-value dimi"><?php echo number_format($agri_stats['dimi_count']); ?></span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">سطح زیر کشت (هکتار)</span>
                            <span class="stat-value dimi"><?php echo number_format($agri_stats['dimi_area'], 2); ?></span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">سطح برداشت (هکتار)</span>
                            <span class="stat-value dimi"><?php echo number_format($agri_stats['dimi_harvest'], 2); ?></span>
                        </div>
                    </div>
                </div>
                
                <h6 class="mb-3 text-right"><i class="fas fa-seedling text-success"></i> محصولات کشت شده</h6>
                <?php if (count($agri_products) > 0): ?>
                <div class="products-table-wrapper">
                    <div class="table-responsive">
                        <table class="products-table">
                            <thead>
                                <tr><th>نام محصول</th><th>گروه</th><th>نوع کشت</th><th>زیر کشت (هکتار)</th><th>برداشت (هکتار)</th><th>تولید (تن)</th><th>پیش‌بینی (تن)</th></tr>
                            </thead>
                            <tbody>
                                <?php foreach ($agri_products as $product): 
                                    $crop_type = ($product['no_kesh'] == '1') ? 'آبی' : 'دیم';
                                    $crop_type_class = ($product['no_kesh'] == '1') ? 'badge-abi' : 'badge-dimi';
                                ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars(!empty($product['product_name']) ? $product['product_name'] : $product['cod_mah'], ENT_QUOTES, 'UTF-8'); ?></strong></td>
                                    <td><?php echo htmlspecialchars(!empty($product['group_name']) ? $product['group_name'] : '-', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><span class="badge-type <?php echo $crop_type_class; ?>"><?php echo $crop_type; ?></span></td>
                                    <td><?php echo number_format(floatval($product['zer_kesht_a']), 2); ?></td>
                                    <td><?php echo number_format(floatval($product['s_bar_a']), 2); ?></td>
                                    <td><?php echo number_format(floatval($product['mah_tol']), 2); ?></td>
                                    <td><?php echo number_format(floatval($product['mah_tolp']), 2); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php else: ?>
                <div class="text-center text-muted py-5 bg-white rounded-4">هیچ محصولی ثبت نشده است.</div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>

<!-- سایر مودال‌ها -->
<div class="modal fade modal-custom" id="modal_vege" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title"><i class="fas fa-carrot ms-2"></i> جزئیات صیفی جات</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body"><div class="text-center text-muted py-5">محتوای صیفی جات - در حال تکمیل </div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button></div></div></div></div>

<div class="modal fade modal-custom" id="modal_garden" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title"><i class="fas fa-apple-alt ms-2"></i> جزئیات باغی</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body"><div class="text-center text-muted py-5">محتوای باغی - در حال تکمیل </div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button></div></div></div></div>

<div class="modal fade modal-custom" id="modal_mushroom" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title"><i class="fas fa-leaf ms-2"></i> جزئیات قارچ</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body"><div class="text-center text-muted py-5">محتوای قارچ - در حال تکمیل </div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button></div></div></div></div>

<div class="modal fade modal-custom" id="modal_greenhouse" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title"><i class="fas fa-warehouse ms-2"></i> جزئیات گلخانه</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body"><div class="text-center text-muted py-5">محتوای گلخانه - در حال تکمیل </div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button></div></div></div></div>

<div class="modal fade modal-custom" id="modal_aquatic" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title"><i class="fas fa-fish ms-2"></i> جزئیات آبزی پروری</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body"><div class="text-center text-muted py-5">محتوای آبزی پروری - در حال تکمیل </div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button></div></div></div></div>

<div class="modal fade modal-custom" id="modal_bee" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title"><i class="fas fa-bug ms-2"></i> جزئیات زنبور عسل</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body"><div class="text-center text-muted py-5">محتوای زنبور عسل - در حال تکمیل </div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button></div></div></div></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function openActivityModal(activity) {
    var modals = {
        'agri': '#modal_agri',
        'vege': '#modal_vege',
        'garden': '#modal_garden',
        'mushroom': '#modal_mushroom',
        'greenhouse': '#modal_greenhouse',
        'aquatic': '#modal_aquatic',
        'bee': '#modal_bee'
    };
    if (modals[activity]) {
        var modalElement = document.querySelector(modals[activity]);
        var modal = new bootstrap.Modal(modalElement);
        modal.show();
    }
}
</script>

</body>
</html>