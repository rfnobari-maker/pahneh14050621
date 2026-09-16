<?php
/**
 * PHP Client for AJIX Setak Web Services - FINAL VERSION (PHP 5.3.2 Compatible)
 * * رفع خطای "توکن AJIX_Auth اجباری است" با استفاده از نام هدر صحیح: AJIX_Auth
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

// --- 1. Get Access Token Function (بدون تغییر) ---
function getAccessToken($gUser, $gPass, $sUser, $sPass) {
    echo "Attempting to retrieve Access Token...\n";
    $url = GET_TOKEN_ENDPOINT;
    $body_data = array("userName" => $sUser, "password" => $sPass);
    $body = json_encode($body_data);
    $headers = array('Content-Type: application/json', 'Content-Length: ' . strlen($body));
    
    $result = curlPost($url, $headers, $body, "$gUser:$gPass");

    if ($result['http_code'] !== 200) {
        echo "❌ Error: GetToken API returned HTTP status " . $result['http_code'] . ". Response: " . $result['response'] . "\n";
        return false;
    }
    
    $data = json_decode($result['response'], true);
    if ($data !== null && isset($data['access_token'])) {
        echo "✅ Successfully retrieved Access Token.\n";
        return $data['access_token']; 
    } else {
        echo "❌ Error: Could not retrieve 'access_token' from GetToken response. Response: " . $result['response'] . "\n";
        return false;
    }
}

// --- 2. Get Provincial Data Function (متد دریافت برش استانی - اصلاح نهایی) ---
function getProvincialData($token, $gUser, $gPass) {
    echo "\nAttempting to retrieve Provincial Cultivation Pattern Data...\n";
    $url = GET_DATA_ENDPOINT; 
    
    // *** اصلاح نهایی: استفاده از AJIX_Auth (با زیرخط) طبق پیام خطا ***
    $auth_header_ajix = 'AJIX_Auth: Bearer ' . $token; 
    
    // هدر Basic Auth برای احراز هویت گت‌وی
    $auth_header_basic = 'Authorization: Basic ' . base64_encode("$gUser:$gPass"); 
    
    $headers = array(
        $auth_header_ajix, // هدر صحیح نهایی
        $auth_header_basic,
        'Content-Length: 0', 
        'Accept: */*'
    );
    
    // اجرای درخواست POST (بدون بدنه POST)
    $result = curlPost($url, $headers, ''); 

    if ($result['http_code'] !== 200) {
        echo "❌ Error: VezaratOstaniData API returned HTTP status " . $result['http_code'] . ". Response: " . $result['response'] . "\n";
        return false;
    }
    
    $data = json_decode($result['response'], true);
    
    if ($data !== null) {
        echo "✅ Successfully retrieved Provincial Data.\n";
        return $data;
    } else {
        echo "❌ Error: Could not decode JSON response for VezaratOstaniData. Response: " . $result['response'] . "\n";
        return false;
    }
}

// ===================================
// --- Client Execution Workflow ---
// ===================================

// 1. دریافت توکن
$accessToken = getAccessToken($gateway_username, $gateway_password, $service_username, $service_password);

if ($accessToken) {
    // 2. دریافت داده های استانی
    $provincialData = getProvincialData($accessToken, $gateway_username, $gateway_password);
    
    if ($provincialData) {
        
        echo "\n--- API Status ---\n";
        if (isset($provincialData['status'])) {
            echo "Status: " . $provincialData['status'] . "\n"; 
        }
        if (isset($provincialData['message'])) {
            echo "Message: " . $provincialData['message'] . "\n";
        }

        // نمایش نمونه ای از داده ها
        if (isset($provincialData['vezaratOstaniData']) && is_array($provincialData['vezaratOstaniData'])) {
            $count = count($provincialData['vezaratOstaniData']);
            echo "Total records in vezaratOstaniData: $count\n";
            
            if ($count > 0) {
                echo "\n--- Sample Cultivation Data (First Record) ---\n";
                $record = $provincialData['vezaratOstaniData'][0];
                
                echo "کد استان (id_ostan): " . (isset($record['id_ostan']) ? $record['id_ostan'] : 'N/A') . "\n";
                echo "سال زراعی (z_sal): " . (isset($record['z_sal']) ? $record['z_sal'] : 'N/A') . "\n";
                echo "نام محصول (product_name): " . (isset($record['product_name']) ? $record['product_name'] : 'N/A') . "\n";
                echo "سطح آبی (s_abi): " . (isset($record['s_abi']) ? $record['s_abi'] : 'N/A') . "\n";
                echo "------------------------------------\n";
            }
        }
        
    } else {
        echo "❌ Failed to retrieve Provincial Cultivation Pattern Data.\n";
    }
    
} else {
    echo "❌ Execution stopped due to token failure.\n";
}

?>