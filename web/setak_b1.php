<?php
/**
 * PHP Client for AJIX Setak Web Services - FINAL VERSION (PHP 5.3.3 Compatible)
 * * این کد داده های باغ را با ستون های جدید دریافت کرده و به صورت فایل CSV خروجی می دهد.
 */

// --- Configuration ---
define('AJIX_API_URL', 'https://sr-ajix.maj.ir/Services/SetakApi/');
define('GET_TOKEN_ENDPOINT', AJIX_API_URL . 'GetToken'); 
// 💡 اندپوینت جدید
define('GET_DATA_ENDPOINT', AJIX_API_URL . 'VezaratOstaniDataBagh'); 

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

// --- 1. Get Access Token Function (بدون تغییر) ---
function getAccessToken($gUser, $gPass, $sUser, $sPass) {
    $url = GET_TOKEN_ENDPOINT;
    $body_data = array("userName" => $sUser, "password" => $sPass);
    $body = json_encode($body_data);
    $headers = array('Content-Type: application/json', 'Content-Length: ' . strlen($body));
    
    $result = curlPost($url, $headers, $body, "$gUser:$gPass");

    if ($result['http_code'] !== 200) {
        return false;
    }
    
    $data = json_decode($result['response'], true);
    if ($data !== null && isset($data['access_token'])) {
        return $data['access_token']; 
    } else {
        return false;
    }
}

// --- 2. Get Provincial Data Function (بدون تغییر) ---
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

@ini_set('display_errors', 0);
if (ob_get_level() == 0) ob_start(); 

$accessToken = getAccessToken($gateway_username, $gateway_password, $service_username, $service_password);

if ($accessToken) {
    $provincialData = getProvincialData($accessToken, $gateway_username, $gateway_password);
    
    // 💡 کلید داده جدید
    if ($provincialData && isset($provincialData['vezaratOstaniDataBagh'])) {
        
        $records = $provincialData['vezaratOstaniDataBagh']; 
        
        // --- تنظیم متغیرهای خروجی ---
        $delimiter = "\t"; // جداکننده Tab
        $current_date_only = date('Y-m-d'); 
        $output_content = '';

        // --- ۱. ردیف هدر (اختیاری: برای وضوح بیشتر) ---
        // 💡 هدرهای جدید
        $header_columns = array(
           'id', 'id_ostan', 'z_sal', 'group_cod', 'group_name', 'product_cod', 
           'product_name', 's_nobar_abi', 's_nobar_dem', 's_bar_abi', 's_bar_dem', 
           't_abi', 't_dem', 'a_abi', 'a_dem', 'date_s'
        );
        $output_content .= implode($delimiter, $header_columns) . "\n";
        
        // --- ۲. ردیف‌های داده (تغییر یافته) ---
        $id_counter = 1;
        foreach ($records as $record) {
            $line = $id_counter . $delimiter; // فیلد جدید id (شماره ردیف)
            
            $line .= (isset($record['id_ostan']) ? $record['id_ostan'] : '') . $delimiter;
            $line .= (isset($record['z_sal']) ? $record['z_sal'] : '') . $delimiter;
            $line .= (isset($record['group_cod']) ? $record['group_cod'] : '') . $delimiter;
            $line .= (isset($record['group_name']) ? $record['group_name'] : '') . $delimiter;
            $line .= (isset($record['product_cod']) ? $record['product_cod'] : '') . $delimiter;
            $line .= (isset($record['product_name']) ? $record['product_name'] : '') . $delimiter;
            
            // ⭐️ فیلدهای جدید مربوط به مساحت (Surface Area)
            $line .= (isset($record['s_nobar_abi']) ? $record['s_nobar_abi'] : '') . $delimiter;
            $line .= (isset($record['s_nobar_dem']) ? $record['s_nobar_dem'] : '') . $delimiter;
            $line .= (isset($record['s_bar_abi']) ? $record['s_bar_abi'] : '') . $delimiter;
            $line .= (isset($record['s_bar_dem']) ? $record['s_bar_dem'] : '') . $delimiter;
            
            // ⭐️ فیلدهای تولید و عملکرد (Production/Yield)
            $line .= (isset($record['t_abi']) ? $record['t_abi'] : '') . $delimiter;
            $line .= (isset($record['t_dem']) ? $record['t_dem'] : '') . $delimiter;
            $line .= (isset($record['a_abi']) ? $record['a_abi'] : '') . $delimiter;
            $line .= (isset($record['a_dem']) ? $record['a_dem'] : '') . $delimiter;
            
            $line .= $current_date_only . "\n"; // فیلد جدید date_s
            
            $output_content .= $line;
            $id_counter++;
        }

        // --- ۳. ارسال هدرهای دانلود ---
        if (ob_get_level() > 0) ob_end_clean(); 

        $filename = 'setak_data_bagh_' . date('Ymd') . '.csv';

        header('Content-Description: File Transfer');
        header('Content-Type: text/csv; charset=utf-8'); 
        header('Content-Disposition: attachment; filename="' . $filename . '"'); 
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . strlen($output_content)); 

        // --- ۴. خروجی نهایی ---
        echo "\xEF\xBB\xBF"; // BOM برای UTF-8
        echo $output_content;
        exit;
        
    } else {
        echo "❌ خطای دریافت داده: داده های باغ دریافت نشد یا خالی بود.\n";
    }
    
} else {
    echo "❌ خطای احراز هویت: توکن دسترسی دریافت نشد. لطفاً اعتبارنامه‌ها را بررسی کنید.\n";
}

?>