<?php
include('../event.php');
include('../web/shah2.php'); // بارگذاری فایل شامل تابع

if (isset($_POST['tel_m']) && isset($_POST['bah_cod_m'])) {
    $tel_m = $_POST['tel_m'];
    $bah_cod_m = $_POST['bah_cod_m'];
    // بررسی وضعیت شماره موبایل و کد ملی با استفاده از تابع
    $shahkarStatus = getShahkarStatus($tel_m, $bah_cod_m); // این تابع باید در shah2.php تعریف شده باشد

    // ثبت پاسخ برای اشکال‌زدایی
    //echo("Tel: $tel_m, Bah Cod: $bah_cod_m, Status: $shahkarStatus");

    // بررسی نتیجه
    if ($shahkarStatus === "مطابقت دارد") {
        echo "success"; // برای مطابقت
    } else if ($shahkarStatus === "عدم مطابقت") {
        echo "no_match"; // برای عدم مطابقت
    } else {
        echo "error"; // برای خطای استعلام
    }
    
    exit; // پایان اسکریپت
}
?>
