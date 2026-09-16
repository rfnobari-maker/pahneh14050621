<?php

// اطلاعات احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// آدرس وب سرویس
$url = 'https://sr-ajix.maj.ir/services/GetIDMatching';

// داده‌هایی که باید ارسال شوند
$data = array(
    "requestId" => "bbbb20211227103629000000",
    "serviceNumber" => "09147857121",
    "serviceType" => 2,
    "identificationType" => 0,
    "identificationNo" => "1380066174"
);

// مقداردهی اولیه cURL
$ch = curl_init($url);

// تنظیمات cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// اجرای درخواست و دریافت پاسخ
$response = curl_exec($ch);
$error = curl_error($ch);

// بستن اتصال cURL
curl_close($ch);

// بررسی خطا و نمایش نتیجه
if ($error) {
    echo "خطا در ارتباط: $error";
} else {
    echo "پاسخ وب سرویس: $response";
}
