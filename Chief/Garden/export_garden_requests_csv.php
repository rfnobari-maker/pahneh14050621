<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

// ============================================================
// دریافت پارامترهای فیلتر (اختیاری)
// ============================================================
$filter_id_ostan = isset($_GET['id_ostan']) ? $_GET['id_ostan'] : '';
$filter_z_sal = isset($_GET['z_sal']) ? $_GET['z_sal'] : '';
$filter_group_cod = isset($_GET['group_cod']) ? $_GET['group_cod'] : '';
$filter_product_cod = isset($_GET['product_cod']) ? $_GET['product_cod'] : '';
$filter_status = isset($_GET['status']) ? $_GET['status'] : '';

// ============================================================
// ساخت شرط WHERE بر اساس فیلترها
// ============================================================
$where_conditions = array();
$params = array();

if (!empty($filter_id_ostan)) {
    $where_conditions[] = "id_ostan = ?";
    $params[] = $filter_id_ostan;
}
if (!empty($filter_z_sal)) {
    $where_conditions[] = "z_sal = ?";
    $params[] = $filter_z_sal;
}
if (!empty($filter_group_cod)) {
    $where_conditions[] = "group_cod = ?";
    $params[] = $filter_group_cod;
}
if (!empty($filter_product_cod)) {
    $where_conditions[] = "product_cod = ?";
    $params[] = $filter_product_cod;
}
if (!empty($filter_status)) {
    $where_conditions[] = "status = ?";
    $params[] = $filter_status;
}

$where_clause = (!empty($where_conditions)) ? "WHERE " . implode(" AND ", $where_conditions) : "";

// ============================================================
// دریافت لیست درخواست‌ها (فقط از جدول Garden_ab_request)
// ============================================================
$query = "SELECT * FROM Garden_ab_request $where_clause ORDER BY created_at DESC, id DESC";

$stmt = $dbh->prepare($query);
$stmt->execute($params);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// تنظیم هدرهای خروجی CSV
// ============================================================
$filename = 'Garden_ab_request_' . jdate("Y-m-d") . '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// ایجاد خروجی با BOM برای پشتیبانی از UTF-8 در اکسل
echo "\xEF\xBB\xBF";

// ============================================================
// ایجاد فایل CSV
// ============================================================
$output = fopen('php://output', 'w');

// سطر هدر - نام فیلدهای جدول
fputcsv($output, array(
    'id',
    'id_ostan',
    'z_sal',
    'group_cod',
    'product_cod',
    'product_name',
    'current_s_nobar_abi',
    'current_s_nobar_dem',
    'current_s_bar_abi',
    'current_s_bar_dem',
    'current_t_abi',
    'current_t_dem',
    'current_a_abi',
    'current_a_dem',
    'request_s_nobar_abi',
    'request_s_nobar_dem',
    'request_s_bar_abi',
    'request_s_bar_dem',
    'request_a_abi',
    'request_a_dem',
    'calculated_t_abi',
    'calculated_t_dem',
    'admin_s_nobar_abi',
    'admin_s_nobar_dem',
    'admin_s_bar_abi',
    'admin_s_bar_dem',
    'admin_a_abi',
    'admin_a_dem',
    'reason',
    'attachment',
    'status',
    'admin_note',
    'created_by',
    'created_at',
    'updated_at',
    'approved_at'
));

// ============================================================
// نوشتن رکوردها
// ============================================================
foreach ($requests as $row) {
    fputcsv($output, array(
        $row['id'],
        $row['id_ostan'],
        $row['z_sal'],
        $row['group_cod'],
        $row['product_cod'],
        $row['product_name'],
        $row['current_s_nobar_abi'],
        $row['current_s_nobar_dem'],
        $row['current_s_bar_abi'],
        $row['current_s_bar_dem'],
        $row['current_t_abi'],
        $row['current_t_dem'],
        $row['current_a_abi'],
        $row['current_a_dem'],
        $row['request_s_nobar_abi'],
        $row['request_s_nobar_dem'],
        $row['request_s_bar_abi'],
        $row['request_s_bar_dem'],
        $row['request_a_abi'],
        $row['request_a_dem'],
        $row['calculated_t_abi'],
        $row['calculated_t_dem'],
        $row['admin_s_nobar_abi'],
        $row['admin_s_nobar_dem'],
        $row['admin_s_bar_abi'],
        $row['admin_s_bar_dem'],
        $row['admin_a_abi'],
        $row['admin_a_dem'],
        $row['reason'],
        $row['attachment'],
        $row['status'],
        $row['admin_note'],
        $row['created_by'],
        $row['created_at'],
        $row['updated_at'],
        $row['approved_at']
    ));
}

fclose($output);
exit;
?>