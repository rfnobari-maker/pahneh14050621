<?php
require_once("../../lock_cp.php");
include('../../login/config.php');

$filename = "eagri_data.csv";

// تنظیم هدرهای HTTP برای دانلود فایل
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// ایجاد یک استریم برای نوشتن داده‌های CSV
$output = fopen('php://output', 'w');

// اجرای کوئری SQL
$sql = "SELECT `id_ostan` , `id_city` , `z_sal` , `group_cod` , `product_cod` , `s_abi` , `s_dem` , `t_abi` , `t_dem` , `a_abi` , `a_dem`
FROM `Agri_ab_city`
WHERE `s_abi` >0
OR `s_dem` >0 ";
$stmt = $dbh ->prepare($sql);
$stmt->execute();

// دریافت نام ستون‌ها و نوشتن به عنوان هدر CSV
$columnNames = array();
for ($i = 0; $i < $stmt->columnCount(); $i++) {
    $colMeta = $stmt->getColumnMeta($i);
    $columnNames[] = $colMeta['name'];
}
fputcsv($output, $columnNames);

// دریافت ردیف‌های داده و نوشتن آن‌ها در فایل CSV
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, $row);
}

// بستن استریم و اتصال به پایگاه داده
fclose($output);
$conn = null;
exit();
?>