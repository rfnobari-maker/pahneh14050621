<?php
/**
 * PHP Client for AJIX Setak Web Services - نسخه باغی (ذخیره در جدول موقت)
 */

require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

define('AJIX_API_URL', 'https://sr-ajix.maj.ir/Services/SetakApi/');
define('GET_TOKEN_ENDPOINT', AJIX_API_URL . 'GetToken');
define('GET_DATA_ENDPOINT', AJIX_API_URL . 'VezaratOstaniDataBagh');

$gateway_username = 'ajix_poudadmin';
$gateway_password = '6ae390lm';
$service_username = 'vezarat';
$service_password = '123321';

if (!function_exists('run_setak_b_import')) {

function curlPostB($url, $headers, $post_data = '', $user_pwd = null) {
    $ch = curl_init();
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_CONNECTTIMEOUT => 30,
        CURLOPT_TIMEOUT => 120,
        CURLOPT_SSL_VERIFYPEER => true
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

function getAccessTokenB($gUser, $gPass, $sUser, $sPass) {
    $body = json_encode(array("userName" => $sUser, "password" => $sPass));
    $headers = array('Content-Type: application/json', 'Content-Length: ' . strlen($body));
    $result = curlPostB(GET_TOKEN_ENDPOINT, $headers, $body, "$gUser:$gPass");
    if ($result['http_code'] !== 200) return false;
    $data = json_decode($result['response'], true);
    return isset($data['access_token']) ? $data['access_token'] : false;
}

function getProvincialDataB($token, $gUser, $gPass) {
    $headers = array(
        'AJIX_Auth: Bearer ' . $token,
        'Authorization: Basic ' . base64_encode("$gUser:$gPass"),
        'Content-Length: 0',
        'Accept: */*'
    );
    $result = curlPostB(GET_DATA_ENDPOINT, $headers, '');
    if ($result['http_code'] !== 200) return false;
    return json_decode($result['response'], true);
}

function rec_val_b($record, $keys, $default = '') {
    foreach ($keys as $k) {
        if (isset($record[$k]) && $record[$k] !== '' && $record[$k] !== null) {
            return $record[$k];
        }
    }
    return $default;
}

function save_to_garden_temp($records, $dbh) {
    $dbh->exec("TRUNCATE TABLE Garden_ab_temp");
    $today = function_exists('jdate') ? jdate("Y/m/d") : date("Y/m/d");
    $count = 0;
    foreach ($records as $record) {
        $date_s = rec_val_b($record, array('date_s', 'dateS', 'Date_s', 'tarikh', 'tarikh_s'));
        if ($date_s === '') {
            $date_s = $today;
        }
        $query = "INSERT INTO Garden_ab_temp
                  (id_ostan, z_sal, group_cod, group_name, product_cod, product_name,
                   s_nobar_abi, s_nobar_dem, s_bar_abi, s_bar_dem,
                   t_abi, t_dem, a_abi, a_dem, date_s)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($query);
        $ok = $stmt->execute(array(
            rec_val_b($record, array('id_ostan', 'idOstan')),
            rec_val_b($record, array('z_sal', 'zSal')),
            rec_val_b($record, array('group_cod', 'group_code', 'groupCod', 'GroupCod', 'groh_cod', 'code_group')),
            rec_val_b($record, array('group_name', 'groupName', 'GroupName', 'groh_name', 'name_group')),
            rec_val_b($record, array('product_cod', 'product_code', 'productCod')),
            rec_val_b($record, array('product_name', 'productName')),
            isset($record['s_nobar_abi']) ? floatval($record['s_nobar_abi']) : 0,
            isset($record['s_nobar_dem']) ? floatval($record['s_nobar_dem']) : 0,
            isset($record['s_bar_abi']) ? floatval($record['s_bar_abi']) : 0,
            isset($record['s_bar_dem']) ? floatval($record['s_bar_dem']) : 0,
            isset($record['t_abi']) ? floatval($record['t_abi']) : 0,
            isset($record['t_dem']) ? floatval($record['t_dem']) : 0,
            isset($record['a_abi']) ? floatval($record['a_abi']) : 0,
            isset($record['a_dem']) ? floatval($record['a_dem']) : 0,
            $date_s
        ));
        if ($ok) $count++;
    }
    return $count;
}

function run_setak_b_import($dbh, $gateway_username, $gateway_password, $service_username, $service_password) {
    $result = array('success' => false, 'message' => '', 'count' => 0);
    $accessToken = getAccessTokenB($gateway_username, $gateway_password, $service_username, $service_password);
    if ($accessToken) {
        $provincialData = getProvincialDataB($accessToken, $gateway_username, $gateway_password);
        if ($provincialData && isset($provincialData['vezaratOstaniDataBagh'])) {
            $count = save_to_garden_temp($provincialData['vezaratOstaniDataBagh'], $dbh);
            $result['success'] = true;
            $result['message'] = '✅ داده‌های باغی با موفقیت در جدول موقت ذخیره شد.';
            $result['count'] = $count;
        } else {
            $result['message'] = '❌ خطا در دریافت داده‌های باغی از سرویس ستاک';
        }
    } else {
        $result['message'] = '❌ خطا در دریافت توکن ستاک';
    }
    return $result;
}

}

if (!defined('SETAK_B_NO_AUTO_RUN')) {
    $result = run_setak_b_import($dbh, $gateway_username, $gateway_password, $service_username, $service_password);
    if (!headers_sent()) {
        header('Content-Type: application/json; charset=utf-8');
    }
    echo json_encode($result);
    exit;
}
