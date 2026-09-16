<?php
// اطلاعات کاربری برای احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// منطقه زمانی را به ایران تنظیم کنید (بسیار توصیه می شود)
date_default_timezone_set('Asia/Tehran');

// تابعی برای تولید requestId با دقت بالاتر
function generateRequestId() {
    $providerCode = '0554'; // کد سرویس دهنده
    $time = microtime(true);
    $dateTime = date('YmdHis', (int)$time);
    // استخراج 6 رقم میکروثانیه و اطمینان از 6 رقمی بودن (با افزودن صفر در صورت لزوم)
    $microtime = sprintf('%06d', ($time - floor($time)) * 1000000); 
    return $providerCode . $dateTime . $microtime;
}

// تابعی برای ارسال درخواست با بهبود مدیریت خطا و Timeout
function sendRequest($username, $password, $data) {
    $url = 'https://sr-ajix.maj.ir/services/GetIDMatching';
    $data_json = json_encode($data);

    $ch = curl_init();
    $options = array(
	CURLOPT_SSL_VERIFYPEER => false, 
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_json) // توصیه شده برای POST
        ),
        CURLOPT_USERPWD => "$username:$password", 
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data_json,
        CURLOPT_TIMEOUT => 30, // حداکثر 30 ثانیه برای پاسخ
        CURLOPT_SSL_VERIFYPEER => true, // همیشه SSL را بررسی کنید
        // اگر خطای certificate دریافت کردید، ممکن است نیاز به تعیین مسیر CA Bundle باشد
        // CURLOPT_CAINFO => '/path/to/your/cacert.pem', 
    );

    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // 1. بررسی و مدیریت خطای cURL (مانند خطای شبکه، DNS یا SSL)
    if ($response === false) {
        echo "Error: " . curl_error($ch) . "\n";
    } 
    // 2. بررسی کد وضعیت HTTP
    elseif ($http_code !== 200) {
        echo "HTTP Error: Received code " . $http_code . "\n";
        echo "Response body: " . $response . "\n";
    }
    // 3. بررسی و مدیریت پاسخ JSON
    else {
        $result = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "JSON decode error: " . json_last_error_msg() . "\n";
            echo "Received response: " . $response . "\n";
        } else {
            print_r($result);
        }
    }
    
    curl_close($ch);
}

// مقداردهی ورودی JSON
$data = array(
    "requestId" => generateRequestId(),
    "serviceNumber" => "09147857121", 
    "serviceType" => 2, 
    "identificationType" => 0,
    "identificationNo" => "1380066174"
);

// ارسال درخواست
sendRequest($username, $password, $data);
?>