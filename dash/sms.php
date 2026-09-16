<?php
/**
 * JSON SMS sender for dash_mgmt (same gateways rules as send_sms.php).
 */
header('Content-Type: application/json; charset=utf-8');

if (!defined('DASH_JSON')) {
    define('DASH_JSON', 1);
}
require_once dirname(__FILE__) . '/auth.php';

$sms_lib = dirname(__FILE__) . '/../web/sms1.php';
if (!is_file($sms_lib)) {
    echo json_encode(array('ok' => false, 'error' => 'سرویس پیامک در دسترس نیست.'));
    exit;
}
require_once $sms_lib;

$flags = defined('JSON_UNESCAPED_UNICODE') ? JSON_UNESCAPED_UNICODE : 0;

function dash_sms_out($payload)
{
    global $flags;
    echo json_encode($payload, $flags);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    dash_sms_out(array('ok' => false, 'error' => 'درخواست نامعتبر است.'));
}

$tel_m = isset($_POST['tel_m']) ? trim($_POST['tel_m'] . '') : '';
$message = isset($_POST['message']) ? trim($_POST['message'] . '') : '';
$who = isset($_POST['who']) ? trim($_POST['who'] . '') : '';

$tel_m = preg_replace('/\D+/', '', $tel_m);
if (strlen($tel_m) === 10 && $tel_m[0] === '9') {
    $tel_m = '0' . $tel_m;
}

if (strlen($tel_m) !== 11 || $tel_m[0] !== '0') {
    dash_sms_out(array('ok' => false, 'error' => 'شماره تلفن همراه معتبر نیست.'));
}

$len = function_exists('mb_strlen') ? mb_strlen($message, 'UTF-8') : strlen($message);
if ($len < 10) {
    dash_sms_out(array('ok' => false, 'error' => 'متن پیام حداقل باید ۱۰ کاراکتر باشد.'));
}
if ($len > 150) {
    dash_sms_out(array('ok' => false, 'error' => 'طول پیام حداکثر ۱۵۰ کاراکتر است.'));
}

$sender = isset($PersName) ? trim($PersName . '') : '';
if ($sender === '' && isset($name)) {
    $sender = trim($name . '');
}
$suffix = '(سامانه پهنه بندی/فرستنده پیام : ' . $sender . ')';
$full = $message . $suffix;

try {
    $uid = uniqid('dash_', true);
    if (!function_exists('sendSMS')) {
        dash_sms_out(array('ok' => false, 'error' => 'تابع ارسال پیامک یافت نشد.'));
    }
    @sendSMS($tel_m, $full, $uid);
    dash_sms_out(array(
        'ok' => true,
        'message' => 'پیامک با موفقیت ارسال شد.',
        'to' => $tel_m,
        'who' => $who
    ));
} catch (Exception $e) {
    dash_sms_out(array('ok' => false, 'error' => 'ارسال پیامک با خطا مواجه شد.'));
}
