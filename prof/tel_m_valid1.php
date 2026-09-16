<?php
include('../event.php');
include('../web/shah2.php'); // بارگذاری فایل شامل تابع

// اگر درخواست POST وجود داشته باشد
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tel_m = $_POST['tel_m'] ;
    $bah_cod_m = $_POST['bah_cod_m'] ;

    // بررسی وضعیت شماره موبایل و کد ملی با استفاده از تابع
    $shahkarStatus = getShahkarStatus($tel_m, $bah_cod_m); // این تابع باید در shah2.php تعریف شده باشد

    // بررسی نتیجه
    if ($shahkarStatus === "مطابقت دارد") {
        echo "success"; // برای مطابقت
    } else if ($shahkarStatus === "عدم مطابقت") {
        echo "no_match"; // برای عدم مطابقت
    } else {
        echo "error"; // برای خطای استعلام
    }
} else {
    // نمایش فرم برای ورود دستی داده‌ها
    ?>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>تست مطابقت</title>
    </head>
    <body>
        <h1>تست مطابقت شماره همراه و کد ملی</h1>
        <form method="POST" action="">
            <label for="tel_m">شماره همراه:</label>
            <input type="text" id="tel_m" name="tel_m" required>
            <br><br>
            <label for="bah_cod_m">کد ملی:</label>
            <input type="text" id="bah_cod_m" name="bah_cod_m" required>
            <br><br>
            <input type="submit" value="بررسی مطابقت">
        </form>
    </body>
    </html>
    <?php
}
?>
