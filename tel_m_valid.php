<?php
include('./event.php');
include('./web/shah2.php'); // بارگذاری فایل شامل تابع getShahkarStatus

// تغییر مهم: اعتبارسنجی بر اساس tel_m و cod_m انجام می‌شود
if (isset($_POST['tel_m']) && isset($_POST['cod_m'])) {
    $tel_m = $_POST['tel_m'];
    $cod_m = $_POST['cod_m']; // استفاده از متغیر cod_m به جای bah_cod_m
    
    // بررسی وضعیت شماره موبایل و کد ملی با استفاده از تابع استعلام شاپرک/شاهکار
    // فرض می‌شود تابع getShahkarStatus در shah2.php با آرگومان‌های (شماره موبایل، کد ملی) کار می‌کند
    $shahkarStatus = getShahkarStatus($tel_m, $cod_m); 

    // ثبت پاسخ برای اشکال‌زدایی (لاگ خطا)
    // این خط برای ثبت لاگ در سرور است و می‌توانید آن را حذف کنید
    error_log("Tel: $tel_m, Cod M: $cod_m, Status: $shahkarStatus");

    // بررسی نتیجه و ارسال پاسخ به فرانت‌اند
    if ($shahkarStatus === "مطابقت دارد") {
        echo "success"; // برای مطابقت
    } else if ($shahkarStatus === "عدم مطابقت") {
        echo "no_match"; // برای عدم مطابقت
    } else {
        echo "error"; // برای خطای استعلام (مانند خطای ارتباط با سرویس)
    }
    
    exit; // پایان اسکریپت
}
?>