<?php
/**
 * PHP Client for AJIX Setak Web Services - FINAL VERSION (با قابلیت دانلود مستقیم TSV/CSV)
 * * این کد داده ها را دریافت کرده و به صورت یک فایل متنی (جدا شده با Tab و با دو ستون اضافه) برای مرورگر ارسال می کند.
 */

// --- Configuration ---
define('AJIX_API_URL', 'https://sr-ajix.maj.ir/Services/SetakApi/');
define('GET_TOKEN_ENDPOINT', AJIX_API_URL . 'GetToken'); 
define('GET_DATA_ENDPOINT', AJIX_API_URL . 'VezaratOstaniData'); 

// 1. اعتبارنامه های گت‌وی (Basic Auth Header)
$gateway_username = 'ajix_poudadmin';
$gateway_password = '6ae390lm';

// 2. اعتبارنامه های سرویس ستاک (JSON Body)
$service_username = 'vezarat';
$service_password = '123321';

// --- Helper Function for cURL POST Request (بدون تغییر) ---
function curlPost($url, $headers, $post_data = '', $user_pwd = null) {
    $ch = curl_init();
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_HTTPHEADER => $headers
    );
    if ($user_pwd !== null) {
        $options[CURLOPT_USERPWD] = $user_pwd;
    }
    if (!empty($post_data)) {
        $options[CURLOPT_POSTFIELDS] = $post_data;
    }
    curl_setopt_array($ch, $options);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if (curl_errno($ch)) {
        $error = 'cURL Error: ' . curl_error($ch);
        curl_close($ch);
        return array('response' => $error, 'http_code' => 0); 
    }

    curl_close($ch);
    return array('response' => $response, 'http_code' => $http_code);
}

// --- 1. Get Access Token Function (بدون نمایش خروجی) ---
function getAccessToken($gUser, $gPass, $sUser, $sPass) {
    $url = GET_TOKEN_ENDPOINT;
    $body_data = array("userName" => $sUser, "password" => $sPass);
    $body = json_encode($body_data);
    $headers = array('Content-Type: application/json', 'Content-Length: ' . strlen($body));
    
    $result = curlPost($url, $headers, $body, "$gUser:$gPass");

    if ($result['http_code'] !== 200) {
        //echo "❌ Error: GetToken API returned HTTP status " . $result['http_code'] . ". Response: " . $result['response'] . "\n";
        return false;
    }
    
    $data = json_decode($result['response'], true);
    if ($data !== null && isset($data['access_token'])) {
        return $data['access_token']; 
    } else {
        return false;
    }
}

// --- 2. Get Provincial Data Function (بدون نمایش خروجی) ---
function getProvincialData($token, $gUser, $gPass) {
    $url = GET_DATA_ENDPOINT; 
    
    $auth_header_ajix = 'AJIX_Auth: Bearer ' . $token; 
    $auth_header_basic = 'Authorization: Basic ' . base64_encode("$gUser:$gPass"); 
    
    $headers = array($auth_header_ajix, $auth_header_basic, 'Content-Length: 0', 'Accept: */*');
    
    $result = curlPost($url, $headers, ''); 

    if ($result['http_code'] !== 200) {
        return false;
    }
    
    $data = json_decode($result['response'], true);
    
    if ($data !== null) {
        return $data;
    } else {
        return false;
    }
}

// ===================================
// --- Client Execution Workflow (دانلود TSV/CSV) ---
// ===================================

// اگر اسکریپت در مرورگر اجرا شود، خروجی‌های اضافی را سرکوب می‌کنیم
@ini_set('display_errors', 0);
if (ob_get_level() == 0) ob_start(); // شروع بافر خروجی

$accessToken = getAccessToken($gateway_username, $gateway_password, $service_username, $service_password);

if ($accessToken) {
    $provincialData = getProvincialData($accessToken, $gateway_username, $gateway_password);
    
    if ($provincialData && isset($provincialData['vezaratOstaniData'])) {
        
        $records = $provincialData['vezaratOstaniData'];
        
        // --- تنظیم متغیرهای خروجی ---
        $delimiter = "\t"; // جداکننده Tab
        $current_date_only = date('Y-m-d'); // فقط تاریخ، بدون زمان
        $output_content = '';

        // --- ۱. ردیف هدر (با ستون‌های اضافه شده) ---
    //    $header_columns = array(
    //        'id', 'id_ostan', 'z_sal', 'group_cod', 'group_name', 'product_cod', 
    //        'product_name', 's_abi', 's_dem', 't_abi', 't_dem', 'a_abi', 'a_dem', 'date_s'
    //    );
    //    $output_content .= implode($delimiter, $header_columns) . "\n";
        
        // --- ۲. ردیف‌های داده ---
        $id_counter = 1;
        foreach ($records as $record) {
            $line = $id_counter . $delimiter; // فیلد جدید id (شماره ردیف)
            
            $line .= (isset($record['id_ostan']) ? $record['id_ostan'] : '') . $delimiter;
            $line .= (isset($record['z_sal']) ? $record['z_sal'] : '') . $delimiter;
            $line .= (isset($record['group_cod']) ? $record['group_cod'] : '') . $delimiter;
            $line .= (isset($record['group_name']) ? $record['group_name'] : '') . $delimiter;
            $line .= (isset($record['product_cod']) ? $record['product_cod'] : '') . $delimiter;
            $line .= (isset($record['product_name']) ? $record['product_name'] : '') . $delimiter;
            $line .= (isset($record['s_abi']) ? $record['s_abi'] : '') . $delimiter;
            $line .= (isset($record['s_dem']) ? $record['s_dem'] : '') . $delimiter;
            $line .= (isset($record['t_abi']) ? $record['t_abi'] : '') . $delimiter;
            $line .= (isset($record['t_dem']) ? $record['t_dem'] : '') . $delimiter;
            $line .= (isset($record['a_abi']) ? $record['a_abi'] : '') . $delimiter;
            $line .= (isset($record['a_dem']) ? $record['a_dem'] : '') . $delimiter;
            
            $line .= $current_date_only . "\n"; // فیلد جدید date_s (فقط تاریخ)
            
            $output_content .= $line;
            $id_counter++;
        }

        // --- ۳. ارسال هدرهای دانلود ---
        if (ob_get_level() > 0) ob_end_clean(); // پاکسازی بافر قبل از ارسال هدرها

        $filename = 'setak_data_' . date('Ymd') . '.csv';

        header('Content-Description: File Transfer');
        header('Content-Type: text/csv; charset=utf-8'); // نوع فایل و انکودینگ UTF-8
        header('Content-Disposition: attachment; filename="' . $filename . '"'); // اجبار به دانلود
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . strlen($output_content)); 

        // --- ۴. خروجی نهایی ---
        echo "\xEF\xBB\xBF"; // افزودن BOM برای UTF-8 در CSV (برای نمایش صحیح در اکسل)
        echo $output_content;
        exit;
        
    } else {
        // در صورت عدم موفقیت در دریافت داده، پیام در مرورگر نمایش داده شود.
        echo "❌ خطای دریافت داده: داده های استانی دریافت نشد یا خالی بود.\n";
    }
    
} else {
    // در صورت عدم موفقیت در دریافت توکن، پیام در مرورگر نمایش داده شود.
    echo "❌ خطای احراز هویت: توکن دسترسی دریافت نشد. لطفاً اعتبارنامه‌ها را بررسی کنید.\n";
}

?>