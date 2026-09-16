<?php
require_once('Jalali.php');
require_once('./login/config.php'); // فایل config.php را اضافه کنید
date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");

// دریافت رکوردها از پایگاه داده
// به جای mysqli از PDO استفاده کنید
$query = $dbh->query("SELECT * FROM list_city");

if ($query->rowCount() > 0) {
    $delimiter = ",";
    $filename = "list_city.csv";
    
    // ایجاد یک اشاره‌گر فایل
    $f = fopen('php://memory', 'w');
    
    // تنظیم هدرهای ستون‌ها
    // این خط از کد اصلی به دلیل کامنت بودن، اینجا نیز کامنت باقی می‌ماند.
    // $fields = array('date_s','bah_cod_m','no_bah','num_bah', 'name', 'last_name', 'date_t', 'fname','co_name','sh_meli','id_ostan','id_city','ok');
    
    // خروجی گرفتن از هر ردیف داده، فرمت‌بندی خط به عنوان CSV و نوشتن در اشاره‌گر فایل
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $lineData = array($row['id'], $row['id_ostan'], $row['ostan'], $row['id_city'], $row['city'], $row['bakh'], $row['id_mar'], $row['mar'], $row['shahr'], $row['mor_cod_m'], $row['add_city'], $row['add_bakh']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    // بازگشت به ابتدای فایل
    fseek($f, 0);
    
    // تنظیم هدرها برای دانلود فایل به جای نمایش آن
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    // خروجی گرفتن از تمام داده‌های باقی‌مانده در اشاره‌گر فایل
    fpassthru($f);
}
exit;
?>