<?php
// URL وب‌سرویس
//$url = 'https://sr-ajix.maj.ir/services/CompanyGetLatestInfo';
$url = 'https://sr-ajix.maj.ir/Services/GSBCompanyGetLatestInfo';

// اطلاعات احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// داده‌های درخواست (آرایه)
$data = array(
    'TheCCompany' => array(
        'NationalCode' => '10260056446'
    )
);

// تبدیل آرایه PHP به JSON
$jsonData = json_encode($data);

// هدرها (آرایه)
$headers = array(
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode($username . ':' . $password), // احراز هویت Basic Auth
    'Cookie: cookiesession1=678B28975DA91354B12369E64E227D4E' // ارسال کوکی
);

// تنظیمات cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); // آدرس وب‌سرویس
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // دریافت نتیجه به عنوان رشته
curl_setopt($ch, CURLOPT_POST, true); // استفاده از متد POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // داده‌های JSON ارسال شده
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // اضافه کردن هدرها

// اجرای درخواست و دریافت پاسخ
$response = curl_exec($ch);

// بررسی خطاهای cURL
if (curl_errno($ch)) {
    echo 'خطا در ارتباط: ' . curl_error($ch);
} else {
    // نمایش پاسخ
    echo 'پاسخ وب‌سرویس: ' . $response;
}

// بستن cURL
curl_close($ch);
?>
