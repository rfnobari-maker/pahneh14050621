<?php
// اطلاعات کاربری برای احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// منطقه زمانی را به ایران تنظیم کنید
//date_default_timezone_set('Asia/Tehran');
date_default_timezone_set('+03:30');

// تابعی برای تولید requestId با فرمت مناسب
function generateRequestId() {
    $providerCode = '0554'; // کد سرویس دهنده
    $dateTime = date('YmdHis'); // زمان دقیق با فرمت یکتایی
    $microtime = substr((string) microtime(false), 2, 6); // شش رقم برای میکروثانیه
    return $providerCode . $dateTime . $microtime;
}

// تابع برای گرفتن وضعیت شهکار
function getShahkarStatus($mobileNumber, $nationalCode) {
    global $username, $password; // استفاده از متغیرهای گلوبال
    $url = 'https://sr-ajix.maj.ir/services/GetIDMatching';

    // مقداردهی ورودی JSON
    $data = array(
        "requestId" => generateRequestId(),
        "serviceNumber" => $mobileNumber,
        "serviceType" => 2,
        "identificationType" => 0,
        "identificationNo" => $nationalCode
    );

    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        CURLOPT_USERPWD => "$username:$password",
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data)
    );

    // ارسال درخواست با استفاده از cURL
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);

    // بررسی و مدیریت خطا
    if ($response === false) {
        curl_close($ch);
        return "استعلام با مشکل مواجه شده";
    }

    $result = json_decode($response, true);
    curl_close($ch);

    // بررسی JSON و استخراج shahkarStatus
    if (json_last_error() !== JSON_ERROR_NONE) {
        return "استعلام با مشکل مواجه شده";
    }

    // بررسی وجود کلیدهای مورد نظر و برگرداندن پیام مناسب
    if (isset($result['result']['data']['response'])) {
        $status = $result['result']['data']['response'];
        if ($status === 200) {
            return "مطابقت دارد";
        } elseif ($status === 600) {
            return "عدم مطابقت";
        } else {
            return "استعلام با مشکل مواجه شده";
        }
    } else {
        return "استعلام با مشکل مواجه شده";
    }
}

// استفاده از تابع و نمایش نتیجه
//$mobileNumber = "09147857121";
//$nationalCode = "1380066174";
//echo getShahkarStatus($mobileNumber, $nationalCode);
?>
