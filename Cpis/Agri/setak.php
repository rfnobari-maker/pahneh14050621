<?php
/**
 * PHP Client for AJIX Setak Web Services - نسخه ذخیره در جدول موقت
 */

require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

// --- Configuration ---
define('AJIX_API_URL', 'https://sr-ajix.maj.ir/Services/SetakApi/');
define('GET_TOKEN_ENDPOINT', AJIX_API_URL . 'GetToken'); 
define('GET_DATA_ENDPOINT', AJIX_API_URL . 'VezaratOstaniData'); 

// اعتبارنامه‌ها
$gateway_username = 'ajix_poudadmin';
$gateway_password = '6ae390lm';
$service_username = 'vezarat';
$service_password = '123321';

// ============================================================
// ایجاد جدول موقت اگر وجود نداشت
// ============================================================
function create_temp_table($dbh) {
    try {
        $dbh->exec("CREATE TABLE IF NOT EXISTS Agri_ab_temp (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_ostan VARCHAR(2),
            z_sal VARCHAR(9),
            group_cod VARCHAR(3),
            group_name VARCHAR(50),
            product_cod VARCHAR(20),
            product_name VARCHAR(55),
            s_abi DECIMAL(7,1),
            s_dem DECIMAL(7,1),
            t_abi DECIMAL(10,1),
            t_dem DECIMAL(10,1),
            a_abi DECIMAL(8,2),
            a_dem DECIMAL(8,2),
            date_s VARCHAR(10),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci");
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

// تابع درخواست
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
    curl_close($ch);
    return array('response' => $response, 'http_code' => $http_code);
}

// گرفتن توکن
function getAccessToken($gUser, $gPass, $sUser, $sPass) {
    $url = GET_TOKEN_ENDPOINT;
    $body_data = array("userName" => $sUser, "password" => $sPass);
    $body = json_encode($body_data);
    $headers = array('Content-Type: application/json', 'Content-Length: ' . strlen($body));
    $result = curlPost($url, $headers, $body, "$gUser:$gPass");
    if ($result['http_code'] !== 200) return false;
    $data = json_decode($result['response'], true);
    return isset($data['access_token']) ? $data['access_token'] : false;
}

// دریافت داده
function getProvincialData($token, $gUser, $gPass) {
    $url = GET_DATA_ENDPOINT;
    $headers = array(
        'AJIX_Auth: Bearer ' . $token,
        'Authorization: Basic ' . base64_encode("$gUser:$gPass"),
        'Content-Length: 0',
        'Accept: */*'
    );
    $result = curlPost($url, $headers, '');
    if ($result['http_code'] !== 200) return false;
    $data = json_decode($result['response'], true);
    return $data;
}

function rec_val($record, $keys, $default = '') {
    foreach ($keys as $k) {
        if (isset($record[$k]) && $record[$k] !== '' && $record[$k] !== null) {
            return $record[$k];
        }
    }
    return $default;
}

// ذخیره در جدول موقت
function save_to_temp_table($records, $dbh) {
    // ابتدا جدول را بساز
    create_temp_table($dbh);
    
    // پاک کردن داده‌های قبلی
    $dbh->exec("TRUNCATE TABLE Agri_ab_temp");
    
    $count = 0;
    $today = function_exists('jdate') ? jdate("Y/m/d") : date("Y/m/d");
    
    foreach ($records as $record) {
        $query = "INSERT INTO Agri_ab_temp 
                  (id_ostan, z_sal, group_cod, group_name, product_cod, product_name, 
                   s_abi, s_dem, t_abi, t_dem, a_abi, a_dem, date_s) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($query);
        
        $date_s = rec_val($record, array('date_s', 'dateS', 'Date_s', 'tarikh', 'tarikh_s'));
        if ($date_s === '') {
            $date_s = $today;
        }
        
        $result = $stmt->execute(array(
            rec_val($record, array('id_ostan', 'idOstan')),
            rec_val($record, array('z_sal', 'zSal')),
            rec_val($record, array('group_cod', 'group_code', 'groupCod', 'GroupCod', 'groh_cod', 'code_group')),
            rec_val($record, array('group_name', 'groupName', 'GroupName', 'groh_name', 'name_group')),
            rec_val($record, array('product_cod', 'product_code', 'productCod')),
            rec_val($record, array('product_name', 'productName')),
            isset($record['s_abi']) ? floatval($record['s_abi']) : 0,
            isset($record['s_dem']) ? floatval($record['s_dem']) : 0,
            isset($record['t_abi']) ? floatval($record['t_abi']) : 0,
            isset($record['t_dem']) ? floatval($record['t_dem']) : 0,
            isset($record['a_abi']) ? floatval($record['a_abi']) : 0,
            isset($record['a_dem']) ? floatval($record['a_dem']) : 0,
            $date_s
        ));
        if ($result) $count++;
    }
    return $count;
}

// ============================================================
// اجرای اصلی
// ============================================================
$result = array('success' => false, 'message' => '', 'count' => 0);

try {
    $accessToken = getAccessToken($gateway_username, $gateway_password, $service_username, $service_password);

    if ($accessToken) {
        $provincialData = getProvincialData($accessToken, $gateway_username, $gateway_password);
        if ($provincialData && isset($provincialData['vezaratOstaniData'])) {
            $records = $provincialData['vezaratOstaniData'];
            $count = save_to_temp_table($records, $dbh);
            $result['success'] = true;
            $result['message'] = '✅ داده‌ها با موفقیت در جدول موقت ذخیره شد.';
            $result['count'] = $count;
        } else {
            $result['message'] = '❌ خطا در دریافت داده';
        }
    } else {
        $result['message'] = '❌ خطا در دریافت توکن';
    }
} catch (Exception $e) {
    $result['message'] = '❌ خطا: ' . $e->getMessage();
}

// برگرداندن نتیجه به صورت JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($result);
exit;
?>