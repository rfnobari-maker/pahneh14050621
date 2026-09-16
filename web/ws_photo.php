<?php
/**
 * تابع دریافت عکس کارت ملی از وب سرویس ثبت احوال
 * @param string $nin کد ملی (arg4)
 * @param string $card_serial سری و سریال کارت ملی/هوشمند (arg5)
 * @return array شامل عکس به صورت باینری (image_binary) یا پیام خطا و پاسخ خام
 */
function get_sabt_ahval_photo($nin, $card_serial) {
    // اطلاعات احراز هویت (از همان اطلاعات فایل ws_sabt.php استفاده کنید)
    $username = 'ajix_poudadmin';
    $password = '6ae390lm'; 
    
    // ۱. اطلاعات ورودی به صورت آرایه PHP (سازگار با PHP 5.3)
    $data = array(
        "arg4" => $nin,          
        "arg5" => $card_serial   
    );

    // تبدیل آرایه PHP به فرمت JSON
    $jsonData = json_encode($data);
    
    // ۲. آدرس URL سرویس دریافت عکس
    $url = "https://sr-ajix.maj.ir/Services/GSBSabteAhvalGetImageSmart";
    
    // تنظیمات cURL
    $ch = curl_init($url);
    $options = array(
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
            'Authorization: Basic ' . base64_encode($username . ':' . $password)
        ),
        CURLOPT_POST => TRUE,
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_SSL_VERIFYPEER => FALSE,
        CURLOPT_SSL_VERIFYHOST => FALSE
    );

    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    $curl_error = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // بررسی خطاهای cURL
    if ($curl_error) {
        return array('success' => FALSE, 'message' => 'cURL Error: ' . $curl_error, 'http_code' => $http_code, 'raw_response' => $response);
    }
    
    $responseData = json_decode($response, TRUE);
    
    // --- ۱. بررسی تصویر ---
    $image_base64 = NULL;
    // دسترسی ایمن به متغیرها (سازگار با PHP 5.3)
    if (isset($responseData['result']['data']['S:Envelope']['S:Body']['ns0:getImageSmartResponse']['return']['image'])) {
        $image_base64 = $responseData['result']['data']['S:Envelope']['S:Body']['ns0:getImageSmartResponse']['return']['image'];
    }

    // اگر عکس با فرمت Base64 یافت شد و طول آن قابل قبول بود
    if ($image_base64 && strlen($image_base64) > 100) {
        $photo_binary_data = base64_decode($image_base64);
        
        return array(
            'success' => TRUE,
            'image_binary' => $photo_binary_data,
            'image_base64' => $image_base64
        );
    } 

    // --- ۲. بررسی پیام خطای داخلی سرویس ---
    $inner_message = NULL;
    if (isset($responseData['result']['data']['S:Envelope']['S:Body']['ns0:getImageSmartResponse']['return']['message'])) {
        $inner_message = $responseData['result']['data']['S:Envelope']['S:Body']['ns0:getImageSmartResponse']['return']['message'];
    }

    // --- ۳. تولید پیام نهایی خطا ---
    $message = 'Photo data not found in expected JSON path.';
    
    if ($inner_message && trim($inner_message) !== '') {
        $message = "خطای داخلی سرویس: " . $inner_message;
    } elseif (isset($responseData['status']['message'])) {
        $message = 'Service Status: ' . $responseData['status']['message'];
    }
        
    return array(
        'success' => FALSE, 
        'message' => $message, 
        'http_code' => $http_code,
        'raw_response' => $response // پاسخ خام برای عیب‌یابی
    );
}
?>