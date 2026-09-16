<?php
include('../../lock_expar.php');
include('../../event.php');

if(isset($_POST['s_abi']))
{
    function clean_number($value) {
        return str_replace('٬', '', $value);
    }

    $s_abi   = clean_number($_POST['s_abi']) ;
    $s_dem   = clean_number($_POST['s_dem']) ;
    $t_abi   = clean_number($_POST['t_abi']) ;
    $t_dem   = clean_number($_POST['t_dem']) ;
    // مقادیر a_abi و a_dem در سمت کلاینت محاسبه و فقط برای نمایش هستند، نیازی به ذخیره مجدد در دیتابیس نیست اگر در سمت سرور محاسبه نمی‌شوند.
    // اما چون در POST ارسال می‌شوند و در کوئری UPDATE شما موجودند، آنها را دریافت می‌کنیم.
    $a_abi   = clean_number($_POST['a_abi']) ;
    $a_dem   = clean_number($_POST['a_dem']) ;

    $id      = clean_number($_POST['id']) ;
    $z_sal     = $_POST['z_sal'] ;
    $id_ostan = $_POST['id_ostan'];
    // group_cod و product_cod هم از Agri_s_ab.php ارسال می‌شوند ولی در کوئری UPDATE فعلی استفاده نمی‌شوند.
    // اگر لازم است ذخیره یا لاگ شوند، باید به کوئری اضافه شوند.
    // $group_cod = $_POST['group_cod'];
    // $product_cod = $_POST['product_cod'];

    require_once('../../Jalali.php');
    date_default_timezone_set('Asia/Tehran') ;
    $date_edit = jdate("Y/m/d");
    $time = date('H:i:s') ;
    include('../../login/config.php');

    try {
        $query = "UPDATE Agri_ab_city SET date_s=?,s_abi=?,s_dem=?,t_abi=?,t_dem=?,a_abi=?,a_dem=? WHERE id=? ";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array($date_edit,$s_abi,$s_dem,$t_abi,$t_dem,$a_abi,$a_dem,$id));

        // اگر عملیات موفقیت آمیز بود، "success" را برگردان
        echo 'success';
    } catch (PDOException $e) {
        // در صورت بروز خطا، پیام خطا را برگردان
        error_log("Database error in sabt_ab.php: " . $e->getMessage()); // برای لاگ کردن خطا در سرور
        echo 'error: ' . $e->getMessage(); // پیام خطای عمومی‌تر برای کاربر
    }
    exit; // بسیار مهم: پس از ارسال پاسخ، اجرای اسکریپت را متوقف کن
} else {
    // اگر پارامترهای لازم ارسال نشده بودند، پیام خطا برگردان
    echo 'error: Invalid request parameters.';
    exit;
}
?>