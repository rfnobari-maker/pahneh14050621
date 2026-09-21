<?php
require_once("../../lock_cp.php");
include('../../login/config.php');

// سال ثابت
$z_sal = '1404-1405';

// نام جدول خروجی که قبلاً توسط Sab_L3_tbl.php ساخته شده
$output_table = 'eagri_data_mar_1404';

// نام فایل CSV
$filename = "eagri_data_mar_" . str_replace('-', '_', $z_sal) . ".csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

$output = fopen('php://output', 'w');

// ==============================================
// بررسی وجود جدول خروجی
// ==============================================
$check = $dbh->query("SHOW TABLES LIKE '$output_table'");
if ($check->rowCount() == 0) {
    fputcsv($output, array('خطا: جدول ' . $output_table . ' وجود ندارد. ابتدا Sab_L3_tbl.php را اجرا کنید.'));
    fclose($output);
    $dbh = null;
    exit();
}

// ==============================================
// خواندن داده‌ها از جدول خروجی
// ==============================================
$stmt = $dbh->query("SELECT * FROM `$output_table`");

// ==============================================
// نوشتن هدر CSV بر اساس ستون‌های جدول
// ==============================================
$columnNames = array();
for ($i = 0; $i < $stmt->columnCount(); $i++) {
    $colMeta = $stmt->getColumnMeta($i);
    $columnNames[] = $colMeta['name'];
}
fputcsv($output, $columnNames);

// ==============================================
// نوشتن ردیف‌های داده
// ==============================================
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, $row);
}

fclose($output);
$dbh = null;
exit();
?>