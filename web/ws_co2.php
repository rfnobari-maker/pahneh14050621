<?php
// URL وب‌سرویس
$url = 'https://sr-ajix.maj.ir/Services/GSBCompanyGetLatestInfo';

// اطلاعات احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// داده‌های درخواست (مطابق نمونه curl)
$data = array(
    'NationalCode' => '10100190358',
    'Name' => ''
);

// تبدیل آرایه PHP به JSON
$jsonData = json_encode($data);

// هدرها (مطابق نمونه curl)
$headers = array(
    'Content-Type: application/json',
    'Accept: /',
    'Accept-Encoding: gzip, deflate, br',
    'Authorization: Basic ' . base64_encode($username . ':' . $password),
    'Cache-Control: no-cache',
    'Connection: keep-alive',
    'Host: sr-ajix.maj.ir',
    'User-Agent: PHP/' . phpversion()
);

// تنظیمات cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate, br'); // پشتیبانی از فشرده‌سازی

// اجرای درخواست و دریافت پاسخ
$response = curl_exec($ch);

// بررسی خطاهای cURL
if (curl_errno($ch)) {
    echo 'خطا در ارتباط: ' . curl_error($ch);
} else {
    // نمایش پاسخ
 //   echo 'پاسخ وب‌سرویس: ' . $response;
echo  $response['result']['data']['Result'] ; 
echo '<p>' ;  
echo $response['result']['data']['TheCCompany']['Name'] ; 
}

// بستن cURL
curl_close($ch);
?>