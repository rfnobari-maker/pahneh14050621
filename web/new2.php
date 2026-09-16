<?php
// تنظیم اطلاعات احراز هویت
$username = 'poudadmin';
$password = '6ae390lm';

// ساخت هدر Basic Authorization
$auth = base64_encode("$username:$password");

// آدرس WSDL
$wsdl = "https://sr-ajix.maj.ir/services/SabteAhvalEstelam3?wsdl";

// ایجاد درخواست curl
$ch = curl_init();

// تنظیم URL وب‌سرویس
curl_setopt($ch, CURLOPT_URL, $wsdl);

// فعال‌سازی دریافت خروجی
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// نمایش اطلاعات مربوط به درخواست
curl_setopt($ch, CURLOPT_VERBOSE, true);

// تنظیم هدر Authorization
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Basic $auth"
));

// اجرای درخواست و دریافت نتیجه
$result = curl_exec($ch);

// بررسی خطاهای curl
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // نمایش نتیجه و اطلاعات مربوط به پاسخ HTTP
    echo "Result: " . $result . "\n";
    echo "HTTP Code: " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "\n";
}

// بستن ارتباط curl
curl_close($ch);
?>
