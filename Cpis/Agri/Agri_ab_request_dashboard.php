<?php
if (!session_id()) {
    session_start();
}
require_once("../../lock_cp.php");

if (isset($_GET['reset'])) {
    unset(
        $_SESSION['dashboard_filter_id_ostan'],
        $_SESSION['dashboard_filter_z_sal'],
        $_SESSION['dashboard_filter_cod_qroup'],
        $_SESSION['dashboard_filter_product_cod'],
        $_SESSION['dashboard_filter_status']
    );
    if (!headers_sent()) {
        header('Location: Agri_ab_request_dashboard.php');
        exit;
    }
    echo '<script>window.location.replace("Agri_ab_request_dashboard.php");</script>';
    exit;
}

require_once("../../event.php");
require_once('../side_menu1.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

function dash_num($v) {
    return ($v !== null && $v !== '') ? $v : 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['dashboard_filter_id_ostan'] = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
    $_SESSION['dashboard_filter_z_sal'] = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
    $_SESSION['dashboard_filter_cod_qroup'] = isset($_POST['cod_qroup']) ? $_POST['cod_qroup'] : '';
    $_SESSION['dashboard_filter_product_cod'] = isset($_POST['product_cod']) ? $_POST['product_cod'] : '';
    $_SESSION['dashboard_filter_status'] = isset($_POST['status']) ? $_POST['status'] : '';
}

if (isset($_GET['status'])) {
    $_SESSION['dashboard_filter_status'] = $_GET['status'];
}

$filter_id_ostan = isset($_SESSION['dashboard_filter_id_ostan']) ? $_SESSION['dashboard_filter_id_ostan'] : '';
$filter_z_sal = isset($_SESSION['dashboard_filter_z_sal']) ? $_SESSION['dashboard_filter_z_sal'] : '';
$filter_cod_qroup = isset($_SESSION['dashboard_filter_cod_qroup']) ? $_SESSION['dashboard_filter_cod_qroup'] : '';
$filter_product_cod = isset($_SESSION['dashboard_filter_product_cod']) ? $_SESSION['dashboard_filter_product_cod'] : '';
$filter_status = isset($_SESSION['dashboard_filter_status']) ? $_SESSION['dashboard_filter_status'] : '';

// ============================================================
// ساخت شرط WHERE
// ============================================================
$where_conditions = array();
$params = array();

if (!empty($filter_id_ostan)) {
    $where_conditions[] = "r.id_ostan = ?";
    $params[] = $filter_id_ostan;
}
if (!empty($filter_z_sal)) {
    $where_conditions[] = "r.z_sal = ?";
    $params[] = $filter_z_sal;
}
if (!empty($filter_cod_qroup)) {
    $where_conditions[] = "r.cod_qroup = ?";
    $params[] = $filter_cod_qroup;
}
if (!empty($filter_product_cod)) {
    $where_conditions[] = "r.product_cod = ?";
    $params[] = $filter_product_cod;
}

$where_no_status = (!empty($where_conditions)) ? "WHERE " . implode(" AND ", $where_conditions) : "";
$params_no_status = $params;

if (!empty($filter_status) && in_array($filter_status, array('pending', 'reviewing', 'approved', 'rejected'))) {
    $where_conditions[] = "r.status = ?";
    $params[] = $filter_status;
}

$where_clause = (!empty($where_conditions)) ? "WHERE " . implode(" AND ", $where_conditions) : "";

// ============================================================
// دریافت لیست استان‌ها، گروه‌ها و محصولات
// ============================================================
$query_ostan = "SELECT id_ostan, ostan FROM ostanname ORDER BY ostan ASC";
$stmt_ostan = $dbh->prepare($query_ostan);
$stmt_ostan->execute();
$ostan_list = $stmt_ostan->fetchAll(PDO::FETCH_ASSOC);

$query_groups = "SELECT DISTINCT group_cod, group_name FROM product_z ORDER BY group_name ASC";
$stmt_groups = $dbh->prepare($query_groups);
$stmt_groups->execute();
$groups_list = $stmt_groups->fetchAll(PDO::FETCH_ASSOC);

$products_list = array();
if (!empty($filter_cod_qroup)) {
    $query_prod = "SELECT product_cod, product_name FROM product_z WHERE group_cod = ? ORDER BY product_name ASC";
    $stmt_prod = $dbh->prepare($query_prod);
    $stmt_prod->execute(array($filter_cod_qroup));
    $products_list = $stmt_prod->fetchAll(PDO::FETCH_ASSOC);
}

$years_list = array();
try {
    $stmt_years = $dbh->query("SELECT DISTINCT z_sal FROM Agri_ab_request WHERE z_sal IS NOT NULL AND z_sal <> '' ORDER BY z_sal DESC");
    if ($stmt_years) {
        $years_list = $stmt_years->fetchAll(PDO::FETCH_COLUMN);
    }
} catch (PDOException $e) {}
if (empty($years_list)) {
    $years_list = array('1405-1406', '1404-1405');
}

// ============================================================
// آمار کلی
// ============================================================
$query_total = "SELECT COUNT(*) as total,
                       SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                       SUM(CASE WHEN status = 'reviewing' THEN 1 ELSE 0 END) as reviewing,
                       SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as approved,
                       SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) as rejected
                FROM Agri_ab_request r $where_no_status";
$stmt_total = $dbh->prepare($query_total);
$stmt_total->execute($params_no_status);
$stats = $stmt_total->fetch(PDO::FETCH_ASSOC);

$total = dash_num($stats['total']);
$pending = dash_num($stats['pending']);
$reviewing = dash_num($stats['reviewing']);
$approved = dash_num($stats['approved']);
$rejected = dash_num($stats['rejected']);
$approval_rate = $total > 0 ? round(($approved / $total) * 100, 1) : 0;

$overall_rate = 0;
try {
    $overall = $dbh->query("SELECT COUNT(*) as total, SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as approved FROM Agri_ab_request")->fetch(PDO::FETCH_ASSOC);
    $overall_total = dash_num($overall['total']);
    $overall_rate = $overall_total > 0 ? round((dash_num($overall['approved']) / $overall_total) * 100, 1) : 0;
} catch (PDOException $e) {}
$rate_vs_all = $approval_rate - $overall_rate;

// ============================================================
// پرتقاضاترین محصولات
// ============================================================
$query_top = "SELECT r.product_cod, r.product_name, COUNT(*) as count
              FROM Agri_ab_request r $where_clause
              GROUP BY r.product_cod, r.product_name
              ORDER BY count DESC
              LIMIT 10";
$stmt_top = $dbh->prepare($query_top);
$stmt_top->execute($params);
$top_products = $stmt_top->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// محصولات با درخواست تکراری
// ============================================================
$query_duplicate = "SELECT r.product_name, MAX(o.ostan) as ostan, r.z_sal, COUNT(*) as count
                    FROM Agri_ab_request r
                    LEFT JOIN ostanname o ON r.id_ostan = o.id_ostan
                    $where_clause
                    GROUP BY r.id_ostan, r.z_sal, r.product_cod, r.product_name
                    HAVING COUNT(*) > 1
                    ORDER BY count DESC
                    LIMIT 10";
$stmt_duplicate = $dbh->prepare($query_duplicate);
$stmt_duplicate->execute($params);
$duplicate_products = $stmt_duplicate->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// تحلیل تغییرات
// ============================================================
$query_changes = "SELECT
    SUM(CASE WHEN r.request_s_abi > r.current_s_abi THEN 1 ELSE 0 END) as inc_s_abi,
    SUM(CASE WHEN r.request_s_abi < r.current_s_abi THEN 1 ELSE 0 END) as dec_s_abi,
    SUM(CASE WHEN r.request_s_dem > r.current_s_dem THEN 1 ELSE 0 END) as inc_s_dem,
    SUM(CASE WHEN r.request_s_dem < r.current_s_dem THEN 1 ELSE 0 END) as dec_s_dem,
    SUM(CASE WHEN r.request_a_abi > r.current_a_abi THEN 1 ELSE 0 END) as inc_a_abi,
    SUM(CASE WHEN r.request_a_abi < r.current_a_abi THEN 1 ELSE 0 END) as dec_a_abi,
    SUM(CASE WHEN r.request_a_dem > r.current_a_dem THEN 1 ELSE 0 END) as inc_a_dem,
    SUM(CASE WHEN r.request_a_dem < r.current_a_dem THEN 1 ELSE 0 END) as dec_a_dem,
    COALESCE(SUM(r.request_s_abi - r.current_s_abi), 0) as net_s_abi,
    COALESCE(SUM(r.request_s_dem - r.current_s_dem), 0) as net_s_dem,
    COALESCE(SUM(r.request_a_abi - r.current_a_abi), 0) as net_a_abi,
    COALESCE(SUM(r.request_a_dem - r.current_a_dem), 0) as net_a_dem
FROM Agri_ab_request r $where_clause";
$stmt_changes = $dbh->prepare($query_changes);
$stmt_changes->execute($params);
$changes = $stmt_changes->fetch(PDO::FETCH_ASSOC);
if (!$changes) {
    $changes = array();
}
foreach (array('inc_s_abi','dec_s_abi','inc_s_dem','dec_s_dem','inc_a_abi','dec_a_abi','inc_a_dem','dec_a_dem','net_s_abi','net_s_dem','net_a_abi','net_a_dem') as $ck) {
    $changes[$ck] = dash_num(isset($changes[$ck]) ? $changes[$ck] : 0);
}

// ============================================================
// تغییرات بر اساس محصول
// ============================================================
$query_product_changes = "SELECT r.product_cod, r.product_name,
    SUM(CASE WHEN r.request_s_abi > r.current_s_abi THEN 1 ELSE 0 END) as inc_s_abi,
    SUM(CASE WHEN r.request_s_abi < r.current_s_abi THEN 1 ELSE 0 END) as dec_s_abi,
    SUM(CASE WHEN r.request_s_dem > r.current_s_dem THEN 1 ELSE 0 END) as inc_s_dem,
    SUM(CASE WHEN r.request_s_dem < r.current_s_dem THEN 1 ELSE 0 END) as dec_s_dem,
    SUM(CASE WHEN r.request_a_abi > r.current_a_abi THEN 1 ELSE 0 END) as inc_a_abi,
    SUM(CASE WHEN r.request_a_abi < r.current_a_abi THEN 1 ELSE 0 END) as dec_a_abi,
    SUM(CASE WHEN r.request_a_dem > r.current_a_dem THEN 1 ELSE 0 END) as inc_a_dem,
    SUM(CASE WHEN r.request_a_dem < r.current_a_dem THEN 1 ELSE 0 END) as dec_a_dem,
    COALESCE(SUM(r.request_s_abi - r.current_s_abi), 0) as net_s_abi,
    COALESCE(SUM(r.request_s_dem - r.current_s_dem), 0) as net_s_dem,
    COUNT(*) as total
FROM Agri_ab_request r $where_clause
GROUP BY r.product_cod, r.product_name
ORDER BY total DESC
LIMIT 15";
$stmt_product_changes = $dbh->prepare($query_product_changes);
$stmt_product_changes->execute($params);
$product_changes = $stmt_product_changes->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// آمار بر اساس استان
// ============================================================
$query_ostan_stats = "SELECT r.id_ostan, MAX(o.ostan) as ostan, COUNT(*) as count
                      FROM Agri_ab_request r
                      LEFT JOIN ostanname o ON r.id_ostan = o.id_ostan
                      $where_clause
                      GROUP BY r.id_ostan
                      ORDER BY count DESC
                      LIMIT 10";
$stmt_ostan_stats = $dbh->prepare($query_ostan_stats);
$stmt_ostan_stats->execute($params);
$ostan_stats = $stmt_ostan_stats->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// وضعیت‌ها
// ============================================================
$status_labels = array(
    'pending' => 'در انتظار تأیید',
    'reviewing' => 'در حال بررسی',
    'approved' => 'تأیید شده',
    'rejected' => 'رد شده'
);

$status_colors = array(
    'pending' => '#f59e0b',
    'reviewing' => '#3b82f6',
    'approved' => '#10b981',
    'rejected' => '#ef4444'
);

// ============================================================
// آماده‌سازی داده‌ها برای جاوااسکریپت
// ============================================================
$top_labels = array();
$top_data = array();
foreach ($top_products as $p) {
    $top_labels[] = $p['product_name'];
    $top_data[] = (int)$p['count'];
}

$ostan_labels = array();
$ostan_data = array();
foreach ($ostan_stats as $o) {
    $ostan_labels[] = $o['ostan'] ? $o['ostan'] : 'نامشخص';
    $ostan_data[] = (int)$o['count'];
}

$dup_labels = array();
$dup_data = array();
foreach ($duplicate_products as $p) {
    $dup_labels[] = $p['product_name'] . ' — ' . ($p['ostan'] ? $p['ostan'] : '') . ' (' . $p['z_sal'] . ')';
    $dup_data[] = (int)$p['count'];
}

$js_top_labels = json_encode($top_labels);
$js_top_data = json_encode($top_data);
$js_ostan_labels = json_encode($ostan_labels);
$js_ostan_data = json_encode($ostan_data);
$js_dup_labels = json_encode($dup_labels);
$js_dup_data = json_encode($dup_data);
$js_change_inc = json_encode(array(
    (int)$changes['inc_s_abi'], (int)$changes['inc_s_dem'],
    (int)$changes['inc_a_abi'], (int)$changes['inc_a_dem']
));
$js_change_dec = json_encode(array(
    (int)$changes['dec_s_abi'], (int)$changes['dec_s_dem'],
    (int)$changes['dec_a_abi'], (int)$changes['dec_a_dem']
));
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR" xml:lang="fa">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../../assets/js/Chart.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style type="text/css">
        /* ============================================================
           CSS Variables & Reset
           ============================================================ */
        :root {
            --primary: #0f172a;
            --primary-light: #1e293b;
            --primary-dark: #020617;
            --secondary: #2563eb;
            --secondary-light: #3b82f6;
            --secondary-dark: #1d4ed8;
            --success: #10b981;
            --success-light: #34d399;
            --danger: #ef4444;
            --danger-light: #f87171;
            --warning: #f59e0b;
            --warning-light: #fbbf24;
            --info: #0ea5e9;
            --info-light: #38bdf8;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow: 0 4px 6px rgba(0,0,0,0.07), 0 1px 3px rgba(0,0,0,0.1);
            --shadow-md: 0 10px 15px rgba(0,0,0,0.1), 0 4px 6px rgba(0,0,0,0.05);
            --shadow-lg: 0 20px 25px rgba(0,0,0,0.1), 0 10px 10px rgba(0,0,0,0.04);
            --shadow-xl: 0 25px 50px rgba(0,0,0,0.15);
            --radius: 16px;
            --radius-sm: 10px;
            --radius-xs: 6px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            text-align: right;
            font-family: 'Tahoma', 'Segoe UI', system-ui, sans-serif;
            direction: rtl;
            background: #f1f5f9;
            margin: 0;
            padding: 0;
        }

        /* ============================================================
           Dashboard Container
           ============================================================ */
        .dashboard-wrap {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 24px 40px;
        }

        /* ============================================================
           Header
           ============================================================ */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 28px;
            padding: 20px 28px;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #2563eb 100%);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }
        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 60%;
            height: 200%;
            background: rgba(255,255,255,0.03);
            transform: rotate(25deg);
            pointer-events: none;
        }
        .dashboard-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, #60a5fa, #34d399, #fbbf24, #f87171, transparent);
            opacity: 0.6;
        }
        .dashboard-header .title-group {
            display: flex;
            align-items: center;
            gap: 14px;
            z-index: 1;
        }
        .dashboard-header .title-group .icon {
            font-size: 32px;
            color: #60a5fa;
            background: rgba(255,255,255,0.1);
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.08);
        }
        .dashboard-header .title-group h1 {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            margin: 0;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .dashboard-header .title-group h1 small {
            font-size: 14px;
            font-weight: 400;
            color: rgba(255,255,255,0.6);
            margin-right: 10px;
        }
        .dashboard-header .header-actions {
            display: flex;
            gap: 10px;
            z-index: 1;
            flex-wrap: wrap;
        }
        .dashboard-header .header-actions .btn {
            padding: 10px 22px;
            border: none;
            border-radius: var(--radius-xs);
            font-family: Tahoma;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #fff;
        }
        .dashboard-header .header-actions .btn-primary {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .dashboard-header .header-actions .btn-primary:hover {
            background: rgba(255,255,255,0.25);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        .dashboard-header .header-actions .btn-success {
            background: #10b981;
        }
        .dashboard-header .header-actions .btn-success:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16,185,129,0.4);
        }

        /* ============================================================
           Filter Box
           ============================================================ */
        .filter-box {
            background: #fff;
            padding: 20px 24px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 28px;
            border: 1px solid var(--gray-200);
            transition: var(--transition);
        }
        .filter-box:hover {
            box-shadow: var(--shadow-md);
        }
        .filter-box .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px 20px;
            align-items: end;
        }
        .filter-box .filter-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .filter-box .filter-group label {
            font-size: 12px;
            font-weight: 700;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .filter-box .filter-group .filter-select {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            font-family: Tahoma;
            font-size: 13px;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-xs);
            background: var(--gray-50);
            transition: var(--transition);
            color: var(--gray-800);
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 12px center;
            padding-left: 36px;
        }
        .filter-box .filter-group .filter-select:focus {
            border-color: var(--secondary);
            outline: none;
            box-shadow: 0 0 0 4px rgba(37,99,235,0.1);
            background-color: #fff;
        }
        .filter-box .filter-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            align-items: center;
            padding-top: 6px;
        }
        .filter-box .filter-actions .btn-filter {
            padding: 10px 28px;
            border: none;
            border-radius: var(--radius-xs);
            font-family: Tahoma;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .filter-box .filter-actions .btn-filter-primary {
            background: var(--secondary);
            color: #fff;
        }
        .filter-box .filter-actions .btn-filter-primary:hover {
            background: var(--secondary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37,99,235,0.35);
        }
        .filter-box .filter-actions .btn-filter-secondary {
            background: var(--gray-200);
            color: var(--gray-700);
        }
        .filter-box .filter-actions .btn-filter-secondary:hover {
            background: var(--gray-300);
            transform: translateY(-2px);
        }

        /* ============================================================
           Stats Cards
           ============================================================ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 20px 22px;
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-200);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }
        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
        }
        .stat-card .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .stat-card .stat-icon {
            font-size: 28px;
            opacity: 0.8;
        }
        .stat-card .stat-number {
            font-size: 30px;
            font-weight: 800;
            color: var(--gray-900);
            line-height: 1.2;
            margin-top: 8px;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }
        .stat-card .stat-label {
            font-size: 13px;
            color: var(--gray-500);
            font-weight: 500;
            margin-top: 2px;
        }
        .stat-card .stat-change {
            font-size: 12px;
            font-weight: 600;
            margin-top: 6px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 10px;
            border-radius: 20px;
            background: var(--gray-100);
        }
        .stat-card .stat-change.up { color: var(--success); background: #d1fae5; }
        .stat-card .stat-change.down { color: var(--danger); background: #fee2e2; }

        /* Card Colors */
        .stat-card.total::before { background: linear-gradient(90deg, #0f172a, #2563eb); }
        .stat-card.total .stat-icon { color: #2563eb; }
        .stat-card.pending::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
        .stat-card.pending .stat-icon { color: #f59e0b; }
        .stat-card.reviewing::before { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .stat-card.reviewing .stat-icon { color: #3b82f6; }
        .stat-card.approved::before { background: linear-gradient(90deg, #10b981, #34d399); }
        .stat-card.approved .stat-icon { color: #10b981; }
        .stat-card.rejected::before { background: linear-gradient(90deg, #ef4444, #f87171); }
        .stat-card.rejected .stat-icon { color: #ef4444; }
        .stat-card.rate::before { background: linear-gradient(90deg, #8b5cf6, #a78bfa); }
        .stat-card.rate .stat-icon { color: #8b5cf6; }

        /* ============================================================
           Charts Grid
           ============================================================ */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 28px;
        }
        .chart-box {
            background: #fff;
            border-radius: var(--radius);
            padding: 24px 22px 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-200);
            transition: var(--transition);
        }
        .chart-box:hover {
            box-shadow: var(--shadow-md);
        }
        .chart-box .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        .chart-box .chart-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--gray-800);
        }
        .chart-box .chart-title i {
            margin-left: 8px;
            color: var(--secondary);
        }
        .chart-box .chart-badge {
            font-size: 11px;
            padding: 4px 12px;
            border-radius: 20px;
            background: var(--gray-100);
            color: var(--gray-600);
        }
        .chart-box canvas {
            width: 100% !important;
            height: 320px !important;
            max-height: 320px;
        }
        .chart-box canvas#topProductsChart {
            height: 440px !important;
            max-height: 440px;
        }

        /* ============================================================
           Analysis Section
           ============================================================ */
        .analysis-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 28px;
        }
        .analysis-box {
            background: #fff;
            border-radius: var(--radius);
            padding: 22px 24px;
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-200);
            transition: var(--transition);
        }
        .analysis-box:hover {
            box-shadow: var(--shadow-md);
        }
        .analysis-box .analysis-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--gray-800);
            padding-bottom: 12px;
            border-bottom: 2px solid var(--gray-100);
            margin-bottom: 14px;
        }
        .analysis-box .analysis-title i {
            margin-left: 8px;
            color: var(--secondary);
        }
        .analysis-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid var(--gray-100);
            font-size: 14px;
        }
        .analysis-item:last-child {
            border-bottom: none;
        }
        .analysis-item .label {
            color: var(--gray-600);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .analysis-item .value {
            font-weight: 700;
            font-size: 15px;
        }
        .analysis-item .value.inc { color: var(--success); }
        .analysis-item .value.dec { color: var(--danger); }

        /* ============================================================
           Product Table
           ============================================================ */
        .table-box {
            background: #fff;
            border-radius: var(--radius);
            padding: 22px 24px 24px;
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-200);
            margin-bottom: 28px;
        }
        .table-box .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .table-box .table-header h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
        }
        .table-box .table-header h3 i {
            margin-left: 8px;
            color: var(--secondary);
        }
        .table-box .table-header .table-count {
            font-size: 13px;
            color: var(--gray-500);
            background: var(--gray-100);
            padding: 4px 14px;
            border-radius: 20px;
        }
        .product-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 13px;
            border-radius: var(--radius-sm);
            overflow: hidden;
        }
        .product-table thead {
            background: linear-gradient(135deg, #0f172a, #1e293b);
        }
        .product-table thead th {
            padding: 12px 10px;
            text-align: center;
            color: #fff;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }
        .product-table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid var(--gray-100);
        }
        .product-table tbody tr:hover {
            background: var(--gray-50);
            transform: scale(1.002);
        }
        .product-table tbody td {
            padding: 10px 10px;
            text-align: center;
            color: var(--gray-700);
            font-size: 13px;
        }
        .product-table tbody td:first-child {
            font-weight: 600;
            color: var(--gray-900);
        }
        .product-table .badge-inc {
            color: var(--success);
            font-weight: 700;
        }
        .product-table .badge-dec {
            color: var(--danger);
            font-weight: 700;
        }
        .product-table .total-badge {
            display: inline-block;
            padding: 2px 12px;
            border-radius: 20px;
            background: var(--gray-100);
            font-weight: 700;
            font-size: 13px;
        }
        .product-table tbody tr:nth-child(even) {
            background: #fafbfc;
        }
        .product-table tbody tr:nth-child(even):hover {
            background: var(--gray-50);
        }

        /* ============================================================
           Responsive
           ============================================================ */
        @media (max-width: 1200px) {
            .charts-grid { grid-template-columns: 1fr 1fr; }
            .analysis-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 992px) {
            .charts-grid { grid-template-columns: 1fr; }
            .analysis-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 768px) {
            .dashboard-wrap { padding: 12px; }
            .dashboard-header { flex-direction: column; align-items: stretch; padding: 16px 20px; }
            .dashboard-header .title-group h1 { font-size: 18px; }
            .dashboard-header .title-group h1 small { display: block; margin-right: 0; margin-top: 4px; font-size: 13px; }
            .dashboard-header .title-group .icon { width: 44px; height: 44px; font-size: 22px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
            .stat-card { padding: 14px 16px; }
            .stat-card .stat-number { font-size: 22px; }
            .filter-box .filter-grid { grid-template-columns: 1fr 1fr; }
            .filter-box .filter-actions { flex-direction: column; width: 100%; }
            .filter-box .filter-actions .btn-filter { width: 100%; justify-content: center; }
            .chart-box canvas { height: 240px !important; max-height: 240px; }
            .chart-box canvas#topProductsChart { height: 380px !important; max-height: 380px; }
            .product-table { font-size: 12px; }
            .product-table thead th, .product-table tbody td { padding: 6px 4px; white-space: nowrap; }
            .dashboard-header .header-actions .btn { padding: 8px 14px; font-size: 12px; }
        }
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr 1fr; gap: 8px; }
            .stat-card .stat-number { font-size: 18px; }
            .filter-box .filter-grid { grid-template-columns: 1fr; }
            .dashboard-header .title-group h1 { font-size: 16px; }
        }

        /* ============================================================
           Animations
           ============================================================ */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .stat-card { animation: fadeInUp 0.6s ease forwards; }
        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.10s; }
        .stat-card:nth-child(3) { animation-delay: 0.15s; }
        .stat-card:nth-child(4) { animation-delay: 0.20s; }
        .stat-card:nth-child(5) { animation-delay: 0.25s; }
        .stat-card:nth-child(6) { animation-delay: 0.30s; }
        .chart-box { animation: fadeInUp 0.7s ease forwards; }
        .chart-box:nth-child(1) { animation-delay: 0.15s; }
        .chart-box:nth-child(2) { animation-delay: 0.25s; }
        .analysis-box { animation: fadeInUp 0.7s ease forwards; }
        .analysis-box:nth-child(1) { animation-delay: 0.30s; }
        .analysis-box:nth-child(2) { animation-delay: 0.40s; }
        .table-box { animation: fadeInUp 0.7s ease forwards; animation-delay: 0.45s; }

        /* ============================================================
           Scrollbar
           ============================================================ */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--gray-100); border-radius: 4px; }
        ::-webkit-scrollbar-thumb { background: var(--gray-400); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--gray-500); }

        /* ============================================================
           No Data
           ============================================================ */
        .no-data {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray-500);
        }
        .no-data i { font-size: 48px; margin-bottom: 16px; display: block; color: var(--gray-300); }
        .no-data h3 { font-size: 18px; color: var(--gray-700); margin: 0 0 8px; }
        .stat-card { cursor: pointer; text-decoration: none; color: inherit; display: block; }
        .stat-card.active-filter {
            box-shadow: 0 0 0 3px rgba(37,99,235,0.35), var(--shadow-lg);
            transform: translateY(-4px);
        }
        .chart-empty {
            height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-400);
            font-size: 14px;
            flex-direction: column;
            gap: 8px;
        }
        .net-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 28px;
        }
        .net-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 16px 18px;
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow);
        }
        .net-card .net-label { font-size: 12px; color: var(--gray-500); }
        .net-card .net-value { font-size: 22px; font-weight: 800; margin-top: 6px; }
        .net-card .net-value.pos { color: var(--success); }
        .net-card .net-value.neg { color: var(--danger); }
        .net-card .net-value.zero { color: var(--gray-500); }
        @media (max-width: 992px) {
            .net-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 480px) {
            .net-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3"><?php require_once("../header.php"); ?></td>
  </tr>
  <tr>
    <td colspan="3" valign="middle">
        <div class="dashboard-wrap">

            <!-- ============================================================ -->
            <!-- HEADER -->
            <!-- ============================================================ -->
            <div class="dashboard-header">
                <div class="title-group">
                    <div class="icon"><i class="fas fa-chart-pie"></i></div>
                    <h1>
                        داشبورد تحلیلی درخواست‌های تغییر الگوی کشت
                        <small>زراعی</small>
                    </h1>
                </div>
                <div class="header-actions">
                    <a href="Agri_ab_request_admin.php" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> مدیریت درخواست‌ها
                    </a>
                    <button class="btn btn-success" onclick="window.location.reload();">
                        <i class="fas fa-sync-alt"></i> به‌روزرسانی
                    </button>
                </div>
            </div>

            <!-- ============================================================ -->
            <!-- FILTERS -->
            <!-- ============================================================ -->
            <form method="post" action="">
                <div class="filter-box">
                    <div class="filter-grid">
                        <div class="filter-group">
                            <label><i class="fas fa-map-marker-alt"></i> استان</label>
                            <select name="id_ostan" class="filter-select">
                                <option value="">همه استان‌ها</option>
                                <?php foreach($ostan_list as $ostan): ?>
                                <option value="<?php echo $ostan['id_ostan']; ?>" <?php if($filter_id_ostan == $ostan['id_ostan']) echo 'selected="selected"'; ?>>
                                    <?php echo htmlspecialchars($ostan['ostan']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label><i class="fas fa-calendar-alt"></i> سال زراعی</label>
                            <select name="z_sal" class="filter-select">
                                <option value="">همه سال‌ها</option>
                                <?php foreach ($years_list as $yz): ?>
                                <option value="<?php echo htmlspecialchars($yz); ?>" <?php if($filter_z_sal == $yz) echo 'selected="selected"'; ?>><?php echo htmlspecialchars($yz); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label><i class="fas fa-layer-group"></i> گروه محصول</label>
                            <select name="cod_qroup" class="filter-select" id="cod_qroup">
                                <option value="">همه گروه‌ها</option>
                                <?php foreach($groups_list as $group): ?>
                                <option value="<?php echo $group['group_cod']; ?>" <?php if($filter_cod_qroup == $group['group_cod']) echo 'selected="selected"'; ?>>
                                    <?php echo htmlspecialchars($group['group_name']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label><i class="fas fa-seedling"></i> محصول</label>
                            <select name="product_cod" class="filter-select" id="product_cod">
                                <option value="">همه محصولات</option>
                                <?php foreach($products_list as $product): ?>
                                <option value="<?php echo $product['product_cod']; ?>" <?php if($filter_product_cod == $product['product_cod']) echo 'selected="selected"'; ?>>
                                    <?php echo htmlspecialchars($product['product_name']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label><i class="fas fa-flag"></i> وضعیت</label>
                            <select name="status" class="filter-select">
                                <option value="">همه وضعیت‌ها</option>
                                <?php foreach ($status_labels as $sk => $sl): ?>
                                <option value="<?php echo $sk; ?>" <?php if($filter_status == $sk) echo 'selected="selected"'; ?>><?php echo $sl; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="filter-group" style="justify-content:flex-end;">
                            <div class="filter-actions">
                                <button type="submit" class="btn-filter btn-filter-primary">
                                    <i class="fas fa-filter"></i> اعمال فیلتر
                                </button>
                                <a href="Agri_ab_request_dashboard.php?reset=1" class="btn-filter btn-filter-secondary">
                                    <i class="fas fa-undo"></i> حذف
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- ============================================================ -->
            <!-- STATS CARDS -->
            <!-- ============================================================ -->
            <div class="stats-grid">
                <a class="stat-card total<?php echo $filter_status === '' ? ' active-filter' : ''; ?>" href="Agri_ab_request_dashboard.php?status=">
                    <div class="stat-top">
                        <span class="stat-icon"><i class="fas fa-clipboard-list"></i></span>
                    </div>
                    <div class="stat-number"><?php echo number_format($total); ?></div>
                    <div class="stat-label">کل درخواست‌ها</div>
                </a>
                <a class="stat-card pending<?php echo $filter_status === 'pending' ? ' active-filter' : ''; ?>" href="Agri_ab_request_dashboard.php?status=pending">
                    <div class="stat-top">
                        <span class="stat-icon"><i class="fas fa-clock"></i></span>
                    </div>
                    <div class="stat-number"><?php echo number_format($pending); ?></div>
                    <div class="stat-label">در انتظار تأیید</div>
                </a>
                <a class="stat-card reviewing<?php echo $filter_status === 'reviewing' ? ' active-filter' : ''; ?>" href="Agri_ab_request_dashboard.php?status=reviewing">
                    <div class="stat-top">
                        <span class="stat-icon"><i class="fas fa-spinner"></i></span>
                    </div>
                    <div class="stat-number"><?php echo number_format($reviewing); ?></div>
                    <div class="stat-label">در حال بررسی</div>
                </a>
                <a class="stat-card approved<?php echo $filter_status === 'approved' ? ' active-filter' : ''; ?>" href="Agri_ab_request_dashboard.php?status=approved">
                    <div class="stat-top">
                        <span class="stat-icon"><i class="fas fa-check-circle"></i></span>
                    </div>
                    <div class="stat-number"><?php echo number_format($approved); ?></div>
                    <div class="stat-label">تأیید شده</div>
                </a>
                <a class="stat-card rejected<?php echo $filter_status === 'rejected' ? ' active-filter' : ''; ?>" href="Agri_ab_request_dashboard.php?status=rejected">
                    <div class="stat-top">
                        <span class="stat-icon"><i class="fas fa-times-circle"></i></span>
                    </div>
                    <div class="stat-number"><?php echo number_format($rejected); ?></div>
                    <div class="stat-label">رد شده</div>
                </a>
                <div class="stat-card rate">
                    <div class="stat-top">
                        <span class="stat-icon"><i class="fas fa-percentage"></i></span>
                    </div>
                    <div class="stat-number"><?php echo number_format($approval_rate, 1); ?>%</div>
                    <div class="stat-label">درصد تأیید</div>
                    <?php
                    $rate_up = $rate_vs_all >= 0;
                    $rate_txt = ($rate_vs_all >= 0 ? '+' : '') . number_format($rate_vs_all, 1) . ' نسبت به کل';
                    ?>
                    <div class="stat-change <?php echo $rate_up ? 'up' : 'down'; ?>">
                        <i class="fas <?php echo $rate_up ? 'fa-arrow-up' : 'fa-arrow-down'; ?>"></i>
                        <?php echo $rate_txt; ?>
                    </div>
                </div>
            </div>

            <div class="net-grid">
                <?php
                $nets = array(
                    array('سطح آبی (هکتار)', $changes['net_s_abi']),
                    array('سطح دیم (هکتار)', $changes['net_s_dem']),
                    array('عملکرد آبی', $changes['net_a_abi']),
                    array('عملکرد دیم', $changes['net_a_dem']),
                );
                foreach ($nets as $nitem):
                    $nv = floatval($nitem[1]);
                    $cls = $nv > 0 ? 'pos' : ($nv < 0 ? 'neg' : 'zero');
                    $sign = $nv > 0 ? '+' : '';
                ?>
                <div class="net-card">
                    <div class="net-label">تغییر خالص <?php echo $nitem[0]; ?></div>
                    <div class="net-value <?php echo $cls; ?>"><?php echo $sign . number_format($nv, 1); ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- ============================================================ -->
            <!-- CHARTS ROW 1 -->
            <!-- ============================================================ -->
            <div class="charts-grid">
                <div class="chart-box">
                    <div class="chart-header">
                        <span class="chart-title"><i class="fas fa-chart-bar"></i> پرتقاضاترین محصولات</span>
                        <span class="chart-badge"><?php echo count($top_products); ?> مورد</span>
                    </div>
                    <canvas id="topProductsChart"></canvas>
                    <?php if (count($top_products) == 0): ?><div class="chart-empty"><i class="fas fa-chart-bar"></i> داده‌ای نیست</div><?php endif; ?>
                </div>
                <div class="chart-box">
                    <div class="chart-header">
                        <span class="chart-title"><i class="fas fa-chart-pie"></i> درصد وضعیت درخواست‌ها</span>
                        <span class="chart-badge"><?php echo $total > 0 ? 'فعال' : 'بدون داده'; ?></span>
                    </div>
                    <canvas id="statusChart"></canvas>
                    <?php if ($total == 0): ?><div class="chart-empty"><i class="fas fa-chart-pie"></i> داده‌ای نیست</div><?php endif; ?>
                </div>
            </div>

            <!-- ============================================================ -->
            <!-- CHARTS ROW 2 -->
            <!-- ============================================================ -->
            <div class="charts-grid">
                <div class="chart-box">
                    <div class="chart-header">
                        <span class="chart-title"><i class="fas fa-map"></i> درخواست بر اساس استان</span>
                        <span class="chart-badge"><?php echo count($ostan_stats); ?> استان</span>
                    </div>
                    <canvas id="ostanChart"></canvas>
                    <?php if (count($ostan_stats) == 0): ?><div class="chart-empty"><i class="fas fa-map"></i> داده‌ای نیست</div><?php endif; ?>
                </div>
                <div class="chart-box">
                    <div class="chart-header">
                        <span class="chart-title"><i class="fas fa-balance-scale"></i> افزایش در برابر کاهش</span>
                        <span class="chart-badge">تعداد درخواست</span>
                    </div>
                    <canvas id="changeChart"></canvas>
                </div>
            </div>

            <!-- ============================================================ -->
            <!-- ANALYSIS SECTION -->
            <!-- ============================================================ -->
            <div class="analysis-grid">
                <div class="analysis-box">
                    <div class="analysis-title"><i class="fas fa-arrows-v"></i> تحلیل تغییرات سطح</div>
                    <div class="analysis-item">
                        <span class="label"><span style="color:var(--success);">⬆</span> افزایش سطح آبی</span>
                        <span class="value inc"><?php echo number_format($changes['inc_s_abi']); ?></span>
                    </div>
                    <div class="analysis-item">
                        <span class="label"><span style="color:var(--danger);">⬇</span> کاهش سطح آبی</span>
                        <span class="value dec"><?php echo number_format($changes['dec_s_abi']); ?></span>
                    </div>
                    <div class="analysis-item">
                        <span class="label"><span style="color:var(--success);">⬆</span> افزایش سطح دیم</span>
                        <span class="value inc"><?php echo number_format($changes['inc_s_dem']); ?></span>
                    </div>
                    <div class="analysis-item">
                        <span class="label"><span style="color:var(--danger);">⬇</span> کاهش سطح دیم</span>
                        <span class="value dec"><?php echo number_format($changes['dec_s_dem']); ?></span>
                    </div>
                    <div class="analysis-item">
                        <span class="label">تغییر خالص سطح آبی</span>
                        <span class="value <?php echo $changes['net_s_abi'] >= 0 ? 'inc' : 'dec'; ?>"><?php echo ($changes['net_s_abi'] > 0 ? '+' : '') . number_format($changes['net_s_abi'], 1); ?></span>
                    </div>
                    <div class="analysis-item">
                        <span class="label">تغییر خالص سطح دیم</span>
                        <span class="value <?php echo $changes['net_s_dem'] >= 0 ? 'inc' : 'dec'; ?>"><?php echo ($changes['net_s_dem'] > 0 ? '+' : '') . number_format($changes['net_s_dem'], 1); ?></span>
                    </div>
                </div>

                <div class="analysis-box">
                    <div class="analysis-title"><i class="fas fa-tachometer-alt"></i> تحلیل تغییرات عملکرد</div>
                    <div class="analysis-item">
                        <span class="label"><span style="color:var(--success);">⬆</span> افزایش عملکرد آبی</span>
                        <span class="value inc"><?php echo number_format($changes['inc_a_abi']); ?></span>
                    </div>
                    <div class="analysis-item">
                        <span class="label"><span style="color:var(--danger);">⬇</span> کاهش عملکرد آبی</span>
                        <span class="value dec"><?php echo number_format($changes['dec_a_abi']); ?></span>
                    </div>
                    <div class="analysis-item">
                        <span class="label"><span style="color:var(--success);">⬆</span> افزایش عملکرد دیم</span>
                        <span class="value inc"><?php echo number_format($changes['inc_a_dem']); ?></span>
                    </div>
                    <div class="analysis-item">
                        <span class="label"><span style="color:var(--danger);">⬇</span> کاهش عملکرد دیم</span>
                        <span class="value dec"><?php echo number_format($changes['dec_a_dem']); ?></span>
                    </div>
                    <div class="analysis-item">
                        <span class="label">تغییر خالص عملکرد آبی</span>
                        <span class="value <?php echo $changes['net_a_abi'] >= 0 ? 'inc' : 'dec'; ?>"><?php echo ($changes['net_a_abi'] > 0 ? '+' : '') . number_format($changes['net_a_abi'], 1); ?></span>
                    </div>
                    <div class="analysis-item">
                        <span class="label">تغییر خالص عملکرد دیم</span>
                        <span class="value <?php echo $changes['net_a_dem'] >= 0 ? 'inc' : 'dec'; ?>"><?php echo ($changes['net_a_dem'] > 0 ? '+' : '') . number_format($changes['net_a_dem'], 1); ?></span>
                    </div>
                </div>
            </div>

            <?php if (count($duplicate_products) > 0): ?>
            <div class="table-box">
                <div class="table-header">
                    <h3><i class="fas fa-clone"></i> درخواست تکراری (همان استان، سال و محصول)</h3>
                    <span class="table-count"><?php echo count($duplicate_products); ?> مورد</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>محصول</th>
                                <th>استان</th>
                                <th>سال</th>
                                <th>تعداد درخواست</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($duplicate_products as $d): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($d['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($d['ostan']); ?></td>
                                <td><?php echo htmlspecialchars($d['z_sal']); ?></td>
                                <td><span class="total-badge"><?php echo (int)$d['count']; ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <!-- ============================================================ -->
            <!-- PRODUCT TABLE -->
            <!-- ============================================================ -->
            <?php if (count($product_changes) > 0): ?>
            <div class="table-box">
                <div class="table-header">
                    <h3><i class="fas fa-table"></i> تغییرات درخواستی بر اساس محصول</h3>
                    <span class="table-count"><?php echo count($product_changes); ?> محصول</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>محصول</th>
                                <th>تعداد کل</th>
                                <th><span style="color:#34d399;">⬆</span> سطح آبی</th>
                                <th><span style="color:#f87171;">⬇</span> سطح آبی</th>
                                <th><span style="color:#34d399;">⬆</span> سطح دیم</th>
                                <th><span style="color:#f87171;">⬇</span> سطح دیم</th>
                                <th><span style="color:#34d399;">⬆</span> عملکرد آبی</th>
                                <th><span style="color:#f87171;">⬇</span> عملکرد آبی</th>
                                <th><span style="color:#34d399;">⬆</span> عملکرد دیم</th>
                                <th><span style="color:#f87171;">⬇</span> عملکرد دیم</th>
                                <th>خالص سطح آبی</th>
                                <th>خالص سطح دیم</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($product_changes as $p): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($p['product_name']); ?></td>
                                <td><span class="total-badge"><?php echo $p['total']; ?></span></td>
                                <td class="badge-inc"><?php echo $p['inc_s_abi'] ?: 0; ?></td>
                                <td class="badge-dec"><?php echo $p['dec_s_abi'] ?: 0; ?></td>
                                <td class="badge-inc"><?php echo $p['inc_s_dem'] ?: 0; ?></td>
                                <td class="badge-dec"><?php echo $p['dec_s_dem'] ?: 0; ?></td>
                                <td class="badge-inc"><?php echo $p['inc_a_abi'] ?: 0; ?></td>
                                <td class="badge-dec"><?php echo $p['dec_a_abi'] ?: 0; ?></td>
                                <td class="badge-inc"><?php echo $p['inc_a_dem'] ?: 0; ?></td>
                                <td class="badge-dec"><?php echo $p['dec_a_dem'] ?: 0; ?></td>
                                <td class="<?php echo $p['net_s_abi'] >= 0 ? 'badge-inc' : 'badge-dec'; ?>"><?php echo ($p['net_s_abi'] > 0 ? '+' : '') . number_format($p['net_s_abi'], 1); ?></td>
                                <td class="<?php echo $p['net_s_dem'] >= 0 ? 'badge-inc' : 'badge-dec'; ?>"><?php echo ($p['net_s_dem'] > 0 ? '+' : '') . number_format($p['net_s_dem'], 1); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php else: ?>
            <div class="table-box">
                <div class="no-data">
                    <i class="fas fa-inbox"></i>
                    <h3>هیچ داده‌ای برای نمایش وجود ندارد</h3>
                    <p>با اعمال فیلترهای مختلف، آمار و نمودارها را مشاهده کنید.</p>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

<!-- ============================================================ -->
<!-- CHARTS JAVASCRIPT -->
<!-- ============================================================ -->
<script>
$(document).ready(function() {
    var chartVer = (typeof Chart !== 'undefined' && Chart.defaults && Chart.defaults.global) ? 2 : 3;
    if (chartVer === 2) {
        Chart.defaults.global.defaultFontFamily = 'Tahoma, Segoe UI, sans-serif';
        Chart.defaults.global.defaultFontSize = 13;
    } else if (typeof Chart !== 'undefined' && Chart.defaults) {
        Chart.defaults.font = Chart.defaults.font || {};
        Chart.defaults.font.family = 'Tahoma, Segoe UI, sans-serif';
        Chart.defaults.font.size = 13;
    }

    function barOpts() {
        if (chartVer === 2) {
            return {
                responsive: true,
                maintainAspectRatio: true,
                legend: { display: false },
                tooltips: {
                    backgroundColor: 'rgba(15,23,42,0.9)',
                    titleFontFamily: 'Tahoma',
                    bodyFontFamily: 'Tahoma',
                    callbacks: {
                        label: function(ti, data) {
                            return data.datasets[ti.datasetIndex].label + ': ' + data.datasets[ti.datasetIndex].data[ti.index];
                        }
                    }
                },
                scales: {
                    yAxes: [{ ticks: { beginAtZero: true, callback: function(v) { return parseInt(v, 10) === v ? v : ''; } }, gridLines: { color: 'rgba(0,0,0,0.05)' } }],
                    xAxes: [{ ticks: { maxRotation: 40, minRotation: 25 }, gridLines: { display: false } }]
                }
            };
        }
        return {
            responsive: true,
            maintainAspectRatio: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { callback: function(v) { return Number.isInteger(v) ? v : ''; } }, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { ticks: { maxRotation: 40, minRotation: 25 }, grid: { display: false } }
            }
        };
    }

    $('#cod_qroup').on('change', function() {
        var group_cod = $(this).val();
        var $productSelect = $('#product_cod');
        $productSelect.empty().append('<option value="">همه محصولات</option>');
        if (!group_cod) return;
        $.ajax({
            url: 'get_products_ajax.php',
            type: 'POST',
            data: {group_cod: group_cod},
            dataType: 'json',
            success: function(data) {
                $.each(data, function(key, value) {
                    $('<option></option>').val(value.product_cod).text(value.product_name).appendTo($productSelect);
                });
            }
        });
    });

    <?php if (count($top_products) > 0): ?>
    var topProductOpts;
    if (chartVer === 2) {
        topProductOpts = {
            responsive: true,
            maintainAspectRatio: false,
            legend: { display: false },
            tooltips: {
                backgroundColor: 'rgba(15,23,42,0.9)',
                titleFontFamily: 'Tahoma',
                bodyFontFamily: 'Tahoma',
                callbacks: {
                    title: function(ti, data) { return data.labels[ti[0].index]; },
                    label: function(ti, data) { return 'تعداد: ' + data.datasets[ti.datasetIndex].data[ti.index]; }
                }
            },
            scales: {
                xAxes: [{
                    ticks: { beginAtZero: true, callback: function(v) { return parseInt(v, 10) === v ? v : ''; } },
                    gridLines: { color: 'rgba(0,0,0,0.05)' }
                }],
                yAxes: [{
                    ticks: {
                        autoSkip: false,
                        fontSize: 12,
                        fontFamily: 'Tahoma, Segoe UI, sans-serif',
                        callback: function(v) { return v; }
                    },
                    gridLines: { display: false }
                }]
            }
        };
    } else {
        topProductOpts = {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { beginAtZero: true, ticks: { callback: function(v) { return Number.isInteger(v) ? v : ''; } }, grid: { color: 'rgba(0,0,0,0.05)' } },
                y: { ticks: { autoSkip: false, font: { size: 12, family: 'Tahoma, Segoe UI, sans-serif' } }, grid: { display: false } }
            }
        };
    }
    new Chart(document.getElementById('topProductsChart').getContext('2d'), {
        type: (chartVer === 2 ? 'horizontalBar' : 'bar'),
        data: {
            labels: <?php echo $js_top_labels; ?>,
            datasets: [{
                label: 'تعداد درخواست',
                data: <?php echo $js_top_data; ?>,
                backgroundColor: '#2563eb'
            }]
        },
        options: topProductOpts
    });
    <?php endif; ?>

    <?php if ($total > 0): ?>
    new Chart(document.getElementById('statusChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['تأیید شده', 'رد شده', 'در انتظار', 'در حال بررسی'],
            datasets: [{
                data: [<?php echo (int)$approved . ',' . (int)$rejected . ',' . (int)$pending . ',' . (int)$reviewing; ?>],
                backgroundColor: ['#10b981', '#ef4444', '#f59e0b', '#3b82f6'],
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: chartVer === 2 ? {
            responsive: true,
            cutoutPercentage: 60,
            legend: { position: 'bottom', labels: { fontFamily: 'Tahoma', padding: 14 } },
            tooltips: {
                callbacks: {
                    label: function(ti, data) {
                        var val = data.datasets[0].data[ti.index];
                        var sum = 0;
                        for (var i = 0; i < data.datasets[0].data.length; i++) sum += data.datasets[0].data[i];
                        var pct = sum ? Math.round(val * 100 / sum) : 0;
                        return data.labels[ti.index] + ': ' + val + ' (' + pct + '%)';
                    }
                }
            }
        } : {
            responsive: true,
            cutout: '60%',
            plugins: { legend: { position: 'bottom' } }
        }
    });
    <?php endif; ?>

    <?php if (count($ostan_stats) > 0): ?>
    new Chart(document.getElementById('ostanChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: <?php echo $js_ostan_labels; ?>,
            datasets: [{
                label: 'تعداد درخواست',
                data: <?php echo $js_ostan_data; ?>,
                backgroundColor: '#0ea5e9'
            }]
        },
        options: barOpts()
    });
    <?php endif; ?>

    new Chart(document.getElementById('changeChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['سطح آبی', 'سطح دیم', 'عملکرد آبی', 'عملکرد دیم'],
            datasets: [
                { label: 'افزایش', data: <?php echo $js_change_inc; ?>, backgroundColor: '#10b981' },
                { label: 'کاهش', data: <?php echo $js_change_dec; ?>, backgroundColor: '#ef4444' }
            ]
        },
        options: chartVer === 2 ? {
            responsive: true,
            legend: { position: 'bottom', labels: { fontFamily: 'Tahoma' } },
            scales: {
                yAxes: [{ ticks: { beginAtZero: true, callback: function(v) { return parseInt(v, 10) === v ? v : ''; } }, gridLines: { color: 'rgba(0,0,0,0.05)' } }],
                xAxes: [{ gridLines: { display: false } }]
            }
        } : {
            responsive: true,
            plugins: { legend: { position: 'bottom' } },
            scales: {
                y: { beginAtZero: true, ticks: { callback: function(v) { return Number.isInteger(v) ? v : ''; } } },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>
</body>
</html>
<?php if (false): ?>
                backgroundColor: ['#2563eb', '#3b82f6', '#60a5fa', '#93c5fd', '#1d4ed8', '#7c3aed', '#8b5cf6', '#a78bfa', '#c084fc', '#6366f1'],
                borderRadius: 8,
                borderSkipped: false,
                barPercentage: 0.7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15,23,42,0.9)',
                    titleFont: { size: 13, family: 'Tahoma' },
                    bodyFont: { size: 13, family: 'Tahoma' },
                    cornerRadius: 8,
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            return 'تعداد: ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: { size: 12, family: 'Tahoma' },
                        stepSize: 1,
                        callback: function(value) {
                            return Number.isInteger(value) ? value.toLocaleString() : '';
                        }
                    },
                    afterBuildTicks: function(axis) {
                        axis.ticks = axis.ticks.filter(tick => Number.isInteger(tick.value));
                    },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: {
                    ticks: {
                        font: { size: 11, family: 'Tahoma' },
                        maxRotation: 40,
                        minRotation: 25
                    },
                    grid: { display: false }
                }
            }
        }
    });
    // ============================================================
    // نمودار 2: درصد وضعیت درخواست‌ها
    // ============================================================
    <?php if ($total > 0): ?>
    var ctx2 = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['✅ تأیید شده', '❌ رد شده', '🕒 در انتظار', '🔄 در حال بررسی'],
            datasets: [{
                data: [<?php echo $approved . ',' . $rejected . ',' . $pending . ',' . $reviewing; ?>],
                backgroundColor: ['#10b981', '#ef4444', '#f59e0b', '#3b82f6'],
                borderWidth: 3,
                borderColor: '#fff',
                hoverOffset: 12
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { size: 13, family: 'Tahoma' },
                        padding: 16,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15,23,42,0.9)',
                    titleFont: { size: 13, family: 'Tahoma' },
                    bodyFont: { size: 13, family: 'Tahoma' },
                    cornerRadius: 8,
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            var total = context.dataset.data.reduce((a, b) => a + b, 0);
                            var percentage = total > 0 ? Math.round((context.parsed / total) * 100) : 0;
                            return context.label + ': ' + context.parsed.toLocaleString() + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
    <?php endif; ?>

    // ============================================================
    // نمودار 3: درخواست بر اساس استان
    // ============================================================
    <?php if (count($ostan_stats) > 0): ?>
    var ctx3 = document.getElementById('ostanChart').getContext('2d');
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: [<?php echo '"' . implode('","', $ostan_labels) . '"'; ?>],
            datasets: [{
                label: 'تعداد درخواست',
                data: [<?php echo implode(',', $ostan_data); ?>],
                backgroundColor: ['#0ea5e9', '#38bdf8', '#7dd3fc', '#0284c7', '#0c4a6e', '#0891b2', '#22d3ee', '#06b6d4', '#0e7490', '#155e75'],
                borderRadius: 8,
                borderSkipped: false,
                barPercentage: 0.65
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15,23,42,0.9)',
                    titleFont: { size: 13, family: 'Tahoma' },
                    bodyFont: { size: 13, family: 'Tahoma' },
                    cornerRadius: 8,
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            return 'تعداد: ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: { size: 12, family: 'Tahoma' },
                        stepSize: 1,
                        callback: function(value) {
                            return Number.isInteger(value) ? value.toLocaleString() : '';
                        }
                    },
                    afterBuildTicks: function(axis) {
                        axis.ticks = axis.ticks.filter(tick => Number.isInteger(tick.value));
                    },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: {
                    ticks: {
                        font: { size: 11, family: 'Tahoma' },
                        maxRotation: 40,
                        minRotation: 25
                    },
                    grid: { display: false }
                }
            }
        }
    });
    <?php endif; ?>

                backgroundColor: ['#ef4444', '#f87171', '#fca5a5', '#dc2626', '#b91c1c', '#f97316', '#fb923c', '#fbbf24', '#f59e0b', '#d97706'],
                borderRadius: 8,
                borderSkipped: false,
                barPercentage: 0.7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15,23,42,0.9)',
                    titleFont: { size: 13, family: 'Tahoma' },
                    bodyFont: { size: 13, family: 'Tahoma' },
                    cornerRadius: 8,
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            return 'تعداد: ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: { size: 12, family: 'Tahoma' },
                        stepSize: 1,
                        callback: function(value) {
                            return Number.isInteger(value) ? value.toLocaleString() : '';
                        }
                    },
                    afterBuildTicks: function(axis) {
                        axis.ticks = axis.ticks.filter(tick => Number.isInteger(tick.value));
                    },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: {
                    ticks: {
                        font: { size: 11, family: 'Tahoma' },
                        maxRotation: 40,
                        minRotation: 25
                    },
                    grid: { display: false }
                }
            }
        }
    });
    <?php endif; ?>
});
</script>
</body>
</html>