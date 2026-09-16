<?php
// فایل Jalali.php را اضافه کنید
include 'Jalali.php';
include("login/config.php");
date_default_timezone_set('Asia/Tehran') ;
// بررسی اتصال PDO
if (!isset($dbh) || !($dbh instanceof PDO)) {
    die("خطا: اتصال دیتابیس (\$dbh) برقرار نشد. لطفاً config.php را بررسی کنید.");
}

// تنظیمات PDO برای مدیریت خطاها به صورت Exception (برای کارکرد صحیح تراکنش‌ها)
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// فرض می‌کنیم اتصال به دیتابیس در $db_connection برقرار شده است

// محاسبه تاریخ شمسی دیروز
$yesterday_timestamp = time() - (24 * 60 * 60);
$current_yesterday_shamsi = jdate('Y/m/d', $yesterday_timestamp);

// به‌روزرسانی مستقیم جدول day
// نیازی به چک کردن تاریخ قبلی نیست، زیرا Cron Job مطمئن است که فقط یک بار در روز اجرا می‌شود.
$sql_update = "
    UPDATE `day`
    SET `yesterday_shamsi_date` = '{$current_yesterday_shamsi}'
    WHERE `id` = 1
";
$dbh->query($sql_update);

// می‌توانید برای اطمینان از اجرا، این خط را غیرفعال کنید:
// echo "Date updated to: " . $current_yesterday_shamsi;
?>