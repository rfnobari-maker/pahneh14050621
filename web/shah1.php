<?php
// اطلاعات کاربری برای احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// منطقه زمانی را به ایران تنظیم کنید
//date_default_timezone_set('Asia/Tehran');

// تابعی برای تولید requestId با فرمت مناسب
function generateRequestId() {
    $providerCode = '0554'; // کد سرویس دهنده
    $dateTime = date('YmdHis'); // زمان دقیق با فرمت یکتایی
    $microtime = substr((string) microtime(false), 2, 6); // شش رقم برای میکروثانیه
    return $providerCode . $dateTime . $microtime;
}

// تابعی برای ارسال درخواست
function sendRequest($username, $password, $data) {
    $url = 'https://sr-ajix.maj.ir/services/GetIDMatching';
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        CURLOPT_USERPWD => "$username:$password", // احراز هویت
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
    );

    // ارسال درخواست با استفاده از cURL
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);

    // بررسی و مدیریت خطا
    if ($response === false) {
        echo "Error: " . curl_error($ch);
    } else {
        $result = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "JSON decode error: " . json_last_error_msg();
        } else {
            print_r($result);
        }
    }
    
    curl_close($ch);
}

// مقداردهی ورودی JSON
$data = array(
    "requestId" => generateRequestId(),
    "serviceNumber" => "09147857121", // شماره موبایل مورد نظر
    "serviceType" => 2, 
    "identificationType" => 0,
    "identificationNo" => "1380066174" // کد ملی مورد نظر
);

// ارسال درخواست
sendRequest($username, $password, $data);
?>
