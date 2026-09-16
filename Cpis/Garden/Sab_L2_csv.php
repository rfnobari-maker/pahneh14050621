<?php
require_once("../../lock_cp.php");
include('../../login/config.php');

// نام فایل خروجی برای محصولات باغی
$filename = "garden_data_city.csv";

// تنظیم هدرهای HTTP برای دانلود فایل
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// ایجاد یک استریم برای نوشتن داده‌های CSV
$output = fopen('php://output', 'w');

// درج BOM برای نمایش صحیح حروف فارسی در اکسل
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// اجرای کوئری SQL برای اطلاعات باغی شهرستانی مطابق Sab_L2.php
$sql = "SELECT `id_ostan`, `id_city`, `z_sal`, `group_cod`, `product_cod`, `product_name`, 
               `s_bar_abi`, `s_bar_dem`, `s_nobar_abi`, `s_nobar_dem`, 
               `t_abi`, `t_dem`, `a_abi`, `a_dem`
        FROM `Garden_ab_city`
        WHERE `s_bar_abi` > 0 
           OR `s_bar_dem` > 0 
           OR `s_nobar_abi` > 0 
           OR `s_nobar_dem` > 0";

$stmt = $dbh->prepare($sql);
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
$dbh = null;
exit();
?>