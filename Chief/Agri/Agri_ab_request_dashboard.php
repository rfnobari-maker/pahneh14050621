<?php
session_start();
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

// ============================================================
// دریافت فیلترها از متد POST یا SESSION
// ============================================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['dashboard_filter_id_ostan'] = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
    $_SESSION['dashboard_filter_z_sal'] = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
    $_SESSION['dashboard_filter_cod_qroup'] = isset($_POST['cod_qroup']) ? $_POST['cod_qroup'] : '';
    $_SESSION['dashboard_filter_product_cod'] = isset($_POST['product_cod']) ? $_POST['product_cod'] : '';
}

$filter_id_ostan = isset($_SESSION['dashboard_filter_id_ostan']) ? $_SESSION['dashboard_filter_id_ostan'] : '';
$filter_z_sal = isset($_SESSION['dashboard_filter_z_sal']) ? $_SESSION['dashboard_filter_z_sal'] : '';
$filter_cod_qroup = isset($_SESSION['dashboard_filter_cod_qroup']) ? $_SESSION['dashboard_filter_cod_qroup'] : '';
$filter_product_cod = isset($_SESSION['dashboard_filter_product_cod']) ? $_SESSION['dashboard_filter_product_cod'] : '';

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

$where_clause = (!empty($where_conditions)) ? "WHERE " . implode(" AND ", $where_conditions) : "";

// ============================================================
// دریافت لیست استان‌ها، گروه‌ها و محصولات برای فیلتر
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

// ============================================================
// آمار کلی
// ============================================================
$query_total = "SELECT COUNT(*) as total,
                       SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                       SUM(CASE WHEN status = 'reviewing' THEN 1 ELSE 0 END) as reviewing,
                       SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as approved,
                       SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) as rejected
                FROM Agri_ab_request r $where_clause";
$stmt_total = $dbh->prepare($query_total);
$stmt_total->execute($params);
$stats = $stmt_total->fetch(PDO::FETCH_ASSOC);

$total = $stats['total'] ? $stats['total'] : 0;
$pending = $stats['pending'] ? $stats['pending'] : 0;
$reviewing = $stats['reviewing'] ? $stats['reviewing'] : 0;
$approved = $stats['approved'] ? $stats['approved'] : 0;
$rejected = $stats['rejected'] ? $stats['rejected'] : 0;
$approval_rate = $total > 0 ? round(($approved / $total) * 100, 1) : 0;

// ============================================================
// پرتقاضاترین محصولات
// ============================================================
$query_top = "SELECT r.product_name, COUNT(*) as count
              FROM Agri_ab_request r $where_clause
              GROUP BY r.product_name
              ORDER BY count DESC
              LIMIT 10";
$stmt_top = $dbh->prepare($query_top);
$stmt_top->execute($params);
$top_products = $stmt_top->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// محصولات با درخواست تکراری
// ============================================================
$query_duplicate = "SELECT r.product_name, COUNT(*) as count
                    FROM Agri_ab_request r $where_clause
                    GROUP BY r.product_name
                    HAVING COUNT(*) > 1
                    ORDER BY count DESC
                    LIMIT 10";
$stmt_duplicate = $dbh->prepare($query_duplicate);
$stmt_duplicate->execute($params);
$duplicate_products = $stmt_duplicate->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// تحلیل تغییرات (افزایش/کاهش)
// ============================================================
$query_changes = "SELECT
    SUM(CASE WHEN r.request_s_abi > r.current_s_abi THEN 1 ELSE 0 END) as inc_s_abi,
    SUM(CASE WHEN r.request_s_abi < r.current_s_abi THEN 1 ELSE 0 END) as dec_s_abi,
    SUM(CASE WHEN r.request_s_dem > r.current_s_dem THEN 1 ELSE 0 END) as inc_s_dem,
    SUM(CASE WHEN r.request_s_dem < r.current_s_dem THEN 1 ELSE 0 END) as dec_s_dem,
    SUM(CASE WHEN r.request_a_abi > r.current_a_abi THEN 1 ELSE 0 END) as inc_a_abi,
    SUM(CASE WHEN r.request_a_abi < r.current_a_abi THEN 1 ELSE 0 END) as dec_a_abi,
    SUM(CASE WHEN r.request_a_dem > r.current_a_dem THEN 1 ELSE 0 END) as inc_a_dem,
    SUM(CASE WHEN r.request_a_dem < r.current_a_dem THEN 1 ELSE 0 END) as dec_a_dem
FROM Agri_ab_request r $where_clause";
$stmt_changes = $dbh->prepare($query_changes);
$stmt_changes->execute($params);
$changes = $stmt_changes->fetch(PDO::FETCH_ASSOC);

// ============================================================
// تغییرات بر اساس محصول
// ============================================================
$query_product_changes = "SELECT r.product_name,
    SUM(CASE WHEN r.request_s_abi > r.current_s_abi THEN 1 ELSE 0 END) as inc_s_abi,
    SUM(CASE WHEN r.request_s_abi < r.current_s_abi THEN 1 ELSE 0 END) as dec_s_abi,
    SUM(CASE WHEN r.request_s_dem > r.current_s_dem THEN 1 ELSE 0 END) as inc_s_dem,
    SUM(CASE WHEN r.request_s_dem < r.current_s_dem THEN 1 ELSE 0 END) as dec_s_dem,
    SUM(CASE WHEN r.request_a_abi > r.current_a_abi THEN 1 ELSE 0 END) as inc_a_abi,
    SUM(CASE WHEN r.request_a_abi < r.current_a_abi THEN 1 ELSE 0 END) as dec_a_abi,
    SUM(CASE WHEN r.request_a_dem > r.current_a_dem THEN 1 ELSE 0 END) as inc_a_dem,
    SUM(CASE WHEN r.request_a_dem < r.current_a_dem THEN 1 ELSE 0 END) as dec_a_dem,
    COUNT(*) as total
FROM Agri_ab_request r $where_clause
GROUP BY r.product_name
ORDER BY total DESC
LIMIT 15";
$stmt_product_changes = $dbh->prepare($query_product_changes);
$stmt_product_changes->execute($params);
$product_changes = $stmt_product_changes->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// آمار بر اساس استان
// ============================================================
$query_ostan_stats = "SELECT o.ostan, COUNT(*) as count
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
    'approved' => 'تأیید/تعدیل شده',
    'rejected' => 'رد شده'
);

$status_colors = array(
    'pending' => '#f57c00',
    'reviewing' => '#1976d2',
    'approved' => '#2e7d32',
    'rejected' => '#c62828'
);

// ============================================================
// آماده‌سازی داده‌ها برای جاوااسکریپت
// ============================================================
$top_labels = array();
$top_data = array();
foreach ($top_products as $p) {
    $top_labels[] = addslashes($p['product_name']);
    $top_data[] = $p['count'];
}

$ostan_labels = array();
$ostan_data = array();
foreach ($ostan_stats as $o) {
    $ostan_labels[] = addslashes($o['ostan']);
    $ostan_data[] = $o['count'];
}

$duplicate_labels = array();
$duplicate_data = array();
foreach ($duplicate_products as $p) {
    $duplicate_labels[] = addslashes($p['product_name']);
    $duplicate_data[] = $p['count'];
}
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
    <style type="text/css">
        body { text-align: right; font-family: Tahoma; direction:rtl; background:#f5f7fa; }
        
        .dashboard-box {
            width: 95%;
            margin: 20px auto;
            padding: 20px;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .dashboard-title {
            font-size: 22px;
            font-weight: bold;
            color: #003366;
            border-bottom: 3px solid #006699;
            padding-bottom: 12px;
            margin-bottom: 25px;
        }
        
        .filter-box {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            margin-bottom: 25px;
        }
        .filter-box table { width: 100%; }
        .filter-box td { padding: 5px 8px; }
        .filter-box .filter-label {
            font-weight: bold;
            color: #003366;
            font-size: 13px;
        }
        .filter-box .filter-select {
            width: 100%;
            height: 35px;
            padding: 5px;
            font-family: Tahoma;
            font-size: 13px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .filter-box .filter-btn {
            padding: 8px 25px;
            background: #006699;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 14px;
        }
        .filter-box .filter-btn:hover { background: #004d80; }
        .filter-box .reset-btn {
            padding: 8px 25px;
            background: #999;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 14px;
        }
        .filter-box .reset-btn:hover { background: #777; }
        
        .stats-cards {
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
        .stat-card .stat-percent {
            font-size: 13px;
            font-weight: bold;
            margin-top: 3px;
        }
        .stat-card.pending { border-color: #f57c00; }
        .stat-card.reviewing { border-color: #1976d2; }
        .stat-card.approved { border-color: #2e7d32; }
        .stat-card.rejected { border-color: #c62828; }
        .stat-card.total { border-color: #003366; }
        .stat-card.pending .stat-number { color: #f57c00; }
        .stat-card.reviewing .stat-number { color: #1976d2; }
        .stat-card.approved .stat-number { color: #2e7d32; }
        .stat-card.rejected .stat-number { color: #c62828; }
        .stat-card.total .stat-number { color: #003366; }
        
        .charts-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }
        .chart-box {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border: 1px solid #eee;
        }
        .chart-box .chart-title {
            font-size: 15px;
            font-weight: bold;
            color: #003366;
            margin-bottom: 15px;
            text-align: center;
        }
        .chart-box canvas { max-height: 250px; max-width: 100%; }
        
        .analysis-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }
        .analysis-box {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border: 1px solid #eee;
        }
        .analysis-box .analysis-title {
            font-size: 15px;
            font-weight: bold;
            color: #003366;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .analysis-item {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px dashed #f0f0f0;
            font-size: 13px;
        }
        .analysis-item:last-child { border-bottom: none; }
        .analysis-item .label { color: #555; }
        .analysis-item .value { font-weight: bold; }
        .analysis-item .value.inc { color: #2e7d32; }
        .analysis-item .value.dec { color: #c62828; }
        
        .product-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        .product-table th {
            background: #006699;
            color: #fff;
            padding: 8px 6px;
            text-align: center;
        }
        .product-table td {
            padding: 8px 6px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        .product-table tr:hover { background: #f5f8fa; }
        .product-table .badge-inc { color: #2e7d32; font-weight: bold; }
        .product-table .badge-dec { color: #c62828; font-weight: bold; }
        
        .btn-back {
            padding: 8px 20px;
            background: #006699;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-back:hover { background: #004d80; }
        
        .full-width { grid-column: 1 / -1; }
        
        @media (max-width: 900px) {
            .charts-row { grid-template-columns: 1fr; }
            .analysis-section { grid-template-columns: 1fr; }
            .stats-cards { grid-template-columns: repeat(2, 1fr); }
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
                    
                    <div class="dashboard-box">
                        <div class="dashboard-title">📊 داشبورد تحلیلی درخواست‌های تغییر الگوی کشت</div>
                        
                        <!-- ============================================================ -->
                        <!-- فیلترها -->
                        <!-- ============================================================ -->
                        <form method="post" action="">
                            <div class="filter-box">
                                <table border="0" cellpadding="5" cellspacing="0">
                                    <tr>
                                        <td width="12%"><span class="filter-label">استان:</span></td>
                                        <td width="20%">
                                            <select name="id_ostan" class="filter-select">
                                                <option value="">همه استان‌ها</option>
                                                <?php foreach($ostan_list as $ostan): ?>
                                                <option value="<?php echo $ostan['id_ostan']; ?>" <?php if($filter_id_ostan == $ostan['id_ostan']) echo 'selected="selected"'; ?>>
                                                    <?php echo htmlspecialchars($ostan['ostan']); ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td width="12%"><span class="filter-label">سال زراعی:</span></td>
                                        <td width="20%">
                                            <select name="z_sal" class="filter-select">
                                                <option value="">همه سال‌ها</option>
                                                <option value="1405-1406" <?php if($filter_z_sal == '1405-1406') echo 'selected="selected"'; ?>>1405-1406</option>
                                                <option value="1404-1405" <?php if($filter_z_sal == '1404-1405') echo 'selected="selected"'; ?>>1404-1405</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="filter-label">گروه محصول:</span></td>
                                        <td>
                                            <select name="cod_qroup" class="filter-select" id="cod_qroup">
                                                <option value="">همه گروه‌ها</option>
                                                <?php foreach($groups_list as $group): ?>
                                                <option value="<?php echo $group['group_cod']; ?>" <?php if($filter_cod_qroup == $group['group_cod']) echo 'selected="selected"'; ?>>
                                                    <?php echo htmlspecialchars($group['group_name']); ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td><span class="filter-label">محصول:</span></td>
                                        <td>
                                            <select name="product_cod" class="filter-select" id="product_cod">
                                                <option value="">همه محصولات</option>
                                                <?php foreach($products_list as $product): ?>
                                                <option value="<?php echo $product['product_cod']; ?>" <?php if($filter_product_cod == $product['product_cod']) echo 'selected="selected"'; ?>>
                                                    <?php echo htmlspecialchars($product['product_name']); ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <button type="submit" class="filter-btn">🔍 اعمال فیلتر</button>
                                            <a href="Agri_ab_request_dashboard.php?reset=1" class="reset-btn">🔄 حذف فیلتر</a>
                                            <a href="Agri_ab_request_admin.php" class="reset-btn" style="background:#006699;">🔙 بازگشت به مدیریت</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                        
                        <!-- ============================================================ -->
                        <!-- کارت‌های آماری -->
                        <!-- ============================================================ -->
                        <div class="stats-cards">
                            <div class="stat-card total">
                                <div class="stat-number"><?php echo number_format($total); ?></div>
                                <div class="stat-label">📋 کل درخواست‌ها</div>
                            </div>
                            <div class="stat-card pending">
                                <div class="stat-number"><?php echo number_format($pending); ?></div>
                                <div class="stat-label">🕒 در انتظار تأیید</div>
                            </div>
                            <div class="stat-card reviewing">
                                <div class="stat-number"><?php echo number_format($reviewing); ?></div>
                                <div class="stat-label">🔄 در حال بررسی</div>
                            </div>
                            <div class="stat-card approved">
                                <div class="stat-number"><?php echo number_format($approved); ?></div>
                                <div class="stat-label">✅ تأیید/تعدیل شده</div>
                            </div>
                            <div class="stat-card rejected">
                                <div class="stat-number"><?php echo number_format($rejected); ?></div>
                                <div class="stat-label">❌ رد شده</div>
                            </div>
                            <div class="stat-card total">
                                <div class="stat-number"><?php echo number_format($approval_rate); ?>%</div>
                                <div class="stat-label">📈 درصد تأیید</div>
                                <div class="stat-percent" style="color:<?php echo $approval_rate >= 50 ? '#2e7d32' : '#c62828'; ?>;">
                                    <?php echo $approval_rate >= 50 ? '⬆️ بالاتر از میانگین' : '⬇️ پایین‌تر از میانگین'; ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- ============================================================ -->
                        <!-- نمودارها -->
                        <!-- ============================================================ -->
                        <div class="charts-row">
                            <div class="chart-box">
                                <div class="chart-title">📊 پرتقاضاترین محصولات</div>
                                <canvas id="topProductsChart" height="250"></canvas>
                            </div>
                            <div class="chart-box">
                                <div class="chart-title">📈 درصد تأیید و رد</div>
                                <canvas id="statusChart" height="250"></canvas>
                            </div>
                        </div>
                        
                        <div class="charts-row">
                            <div class="chart-box">
                                <div class="chart-title">🌾 درخواست بر اساس استان</div>
                                <canvas id="ostanChart" height="250"></canvas>
                            </div>
                            <div class="chart-box">
                                <div class="chart-title">🔄 محصولات با درخواست تکراری</div>
                                <canvas id="duplicateChart" height="250"></canvas>
                            </div>
                        </div>
                        
                        <!-- ============================================================ -->
                        <!-- تحلیل تغییرات -->
                        <!-- ============================================================ -->
                        <div class="analysis-section">
                            <div class="analysis-box">
                                <div class="analysis-title">📈 تحلیل تغییرات سطح</div>
                                <div class="analysis-item">
                                    <span class="label">⬆️ افزایش سطح آبی</span>
                                    <span class="value inc"><?php echo number_format($changes['inc_s_abi']); ?> درخواست</span>
                                </div>
                                <div class="analysis-item">
                                    <span class="label">⬇️ کاهش سطح آبی</span>
                                    <span class="value dec"><?php echo number_format($changes['dec_s_abi']); ?> درخواست</span>
                                </div>
                                <div class="analysis-item">
                                    <span class="label">⬆️ افزایش سطح دیم</span>
                                    <span class="value inc"><?php echo number_format($changes['inc_s_dem']); ?> درخواست</span>
                                </div>
                                <div class="analysis-item">
                                    <span class="label">⬇️ کاهش سطح دیم</span>
                                    <span class="value dec"><?php echo number_format($changes['dec_s_dem']); ?> درخواست</span>
                                </div>
                            </div>
                            
                            <div class="analysis-box">
                                <div class="analysis-title">📈 تحلیل تغییرات عملکرد</div>
                                <div class="analysis-item">
                                    <span class="label">⬆️ افزایش عملکرد آبی</span>
                                    <span class="value inc"><?php echo number_format($changes['inc_a_abi']); ?> درخواست</span>
                                </div>
                                <div class="analysis-item">
                                    <span class="label">⬇️ کاهش عملکرد آبی</span>
                                    <span class="value dec"><?php echo number_format($changes['dec_a_abi']); ?> درخواست</span>
                                </div>
                                <div class="analysis-item">
                                    <span class="label">⬆️ افزایش عملکرد دیم</span>
                                    <span class="value inc"><?php echo number_format($changes['inc_a_dem']); ?> درخواست</span>
                                </div>
                                <div class="analysis-item">
                                    <span class="label">⬇️ کاهش عملکرد دیم</span>
                                    <span class="value dec"><?php echo number_format($changes['dec_a_dem']); ?> درخواست</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- ============================================================ -->
                        <!-- جدول تغییرات بر اساس محصول -->
                        <!-- ============================================================ -->
                        <?php if (count($product_changes) > 0): ?>
                        <div class="analysis-box" style="margin-bottom:20px;">
                            <div class="analysis-title">📋 تغییرات درخواستی بر اساس محصول</div>
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th>محصول</th>
                                        <th>تعداد کل</th>
                                        <th>⬆️ افزایش سطح آبی</th>
                                        <th>⬇️ کاهش سطح آبی</th>
                                        <th>⬆️ افزایش سطح دیم</th>
                                        <th>⬇️ کاهش سطح دیم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($product_changes as $p): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($p['product_name']); ?></strong></td>
                                        <td><?php echo $p['total']; ?></td>
                                        <td class="badge-inc"><?php echo $p['inc_s_abi'] ? $p['inc_s_abi'] : 0; ?></td>
                                        <td class="badge-dec"><?php echo $p['dec_s_abi'] ? $p['dec_s_abi'] : 0; ?></td>
                                        <td class="badge-inc"><?php echo $p['inc_s_dem'] ? $p['inc_s_dem'] : 0; ?></td>
                                        <td class="badge-dec"><?php echo $p['dec_s_dem'] ? $p['dec_s_dem'] : 0; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                        
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
// تنظیم فونت پیش‌فرض برای تمام نمودارها
Chart.defaults.global.defaultFontFamily = 'Tahoma, Arial, sans-serif';
Chart.defaults.global.defaultFontSize = 12;

$(document).ready(function() {
    // بارگذاری محصولات هنگام تغییر گروه
    $('#cod_qroup').on('change', function() {
        var group_cod = $(this).val();
        if (group_cod) {
            $.ajax({
                url: 'get_products_ajax.php',
                type: 'POST',
                data: {group_cod: group_cod},
                dataType: 'json',
                success: function(data) {
                    var $productSelect = $('#product_cod');
                    $productSelect.empty();
                    $productSelect.append('<option value="">همه محصولات</option>');
                    $.each(data, function(key, value) {
                        $productSelect.append('<option value="' + value.product_cod + '">' + value.product_name + '</option>');
                    });
                }
            });
        } else {
            $('#product_cod').empty().append('<option value="">همه محصولات</option>');
        }
    });
    
    <?php if (count($top_products) > 0): ?>
    // نمودار پرتقاضاترین محصولات
    var ctx1 = document.getElementById('topProductsChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: [<?php echo '"' . implode('","', $top_labels) . '"'; ?>],
            datasets: [{
                label: 'تعداد درخواست',
                data: [<?php echo implode(',', $top_data); ?>],
                backgroundColor: ['#006699', '#1976d2', '#2e7d32', '#f57c00', '#c62828', '#6c757d', '#0dcaf0', '#6610f2', '#fd7e14', '#d63384'],
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 11,
                            family: 'Tahoma'
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 10,
                            family: 'Tahoma'
                        },
                        maxRotation: 45,
                        minRotation: 30
                    }
                }
            }
        }
    });
    <?php endif; ?>
    
    <?php if ($total > 0): ?>
    // نمودار درصد تأیید و رد
    var ctx2 = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['✅ تأیید/تعدیل شده', '❌ رد شده', '🕒 در انتظار', '🔄 در حال بررسی'],
            datasets: [{
                data: [<?php echo $approved . ',' . $rejected . ',' . $pending . ',' . $reviewing; ?>],
                backgroundColor: ['#2e7d32', '#c62828', '#f57c00', '#1976d2'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: {
                        font: {
                            family: 'Tahoma',
                            size: 12
                        }
                    }
                }
            }
        }
    });
    <?php endif; ?>
    
    <?php if (count($ostan_stats) > 0): ?>
    // نمودار درخواست بر اساس استان
    var ctx3 = document.getElementById('ostanChart').getContext('2d');
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: [<?php echo '"' . implode('","', $ostan_labels) . '"'; ?>],
            datasets: [{
                label: 'تعداد درخواست',
                data: [<?php echo implode(',', $ostan_data); ?>],
                backgroundColor: '#1976d2',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 11,
                            family: 'Tahoma'
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 10,
                            family: 'Tahoma'
                        },
                        maxRotation: 45,
                        minRotation: 30
                    }
                }
            }
        }
    });
    <?php endif; ?>
    
    <?php if (count($duplicate_products) > 0): ?>
    // نمودار محصولات با درخواست تکراری
    var ctx4 = document.getElementById('duplicateChart').getContext('2d');
    new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: [<?php echo '"' . implode('","', $duplicate_labels) . '"'; ?>],
            datasets: [{
                label: 'تعداد درخواست تکراری',
                data: [<?php echo implode(',', $duplicate_data); ?>],
                backgroundColor: '#c62828',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 11,
                            family: 'Tahoma'
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 10,
                            family: 'Tahoma'
                        },
                        maxRotation: 45,
                        minRotation: 30
                    }
                }
            }
        }
    });
    <?php endif; ?>
});
</script>
</body>
</html>