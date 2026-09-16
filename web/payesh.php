<?php
// اطلاعات احراز هویت
$username = 'ajix_hemayat';
$password = '6ha296MNL';

// تابع برای دریافت توکن
function getToken() {
    global $username, $password;

    $url = "https://c.payeshkood.ir/log_payesh/rest/ConversionService/ConnectToPayesh/token";

    // تنظیمات cURL برای درخواست توکن
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));

    $response = curl_exec($ch);

    if ($response === false) {
        echo "خطا در دریافت توکن: " . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);

    // دیکد کردن JSON بدون json_decode
    $result = php52_json_decode($response);
    return $result;
}

// تابع برای ارسال داده‌های کشاورز به وب‌سرویس
function sendFarmerData($token, $data) {
    $url = "https://c.payeshkood.ir/log_payesh/rest/ConversionService/ConnectToPayesh/frs_ctr";

    // تبدیل دستی آرایه به JSON
    $jsonData = php52_json_encode($data);

    // تنظیمات cURL برای ارسال داده
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    $response = curl_exec($ch);

    if ($response === false) {
        echo "خطا در ارسال داده‌ها: " . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);

    // دیکد کردن JSON بدون json_decode
    $result = php52_json_decode($response);
    return $result;
}

// تابع برای دیکد کردن JSON در PHP 5.2
function php52_json_decode($json) {
    require_once 'JSON.php'; // نیازمند نصب کتابخانه Services_JSON
    $jsonService = new Services_JSON();
    return $jsonService->decode($json);
}

// تابع برای تبدیل آرایه به JSON در PHP 5.2
function php52_json_encode($array) {
    require_once 'JSON.php';
    $jsonService = new Services_JSON();
    return $jsonService->encode($array);
}

// دریافت توکن
$tokenResponse = getToken();
if (isset($tokenResponse->token)) {
    $token = $tokenResponse->token;

    // داده‌های ورودی برای ارسال به وب‌سرویس
    $data = array(
        "cod_keshavarz" => "2031957417",
        "mahsool" => "246",
        "noi_kesht" => "1",
        "nobat_kesht" => "1",
        "cod_amari" => "2706040002022334",
        "sal_z" => "1403-1404"
    );

    // ارسال داده‌ها به وب‌سرویس و دریافت پاسخ
    $response = sendFarmerData($token, $data);
    if ($response) {
        echo "پاسخ از سرور: ";
        print_r($response);
    } else {
        echo "خطایی در دریافت پاسخ از سرور رخ داد.";
    }
} else {
    echo "دریافت توکن با مشکل مواجه شد.";
}
?>
