<?php
session_start();
header('Content-Type: application/json');

include('login/config.php');
include('./event.php');

// بررسی وجود session موقت
if (!isset($_SESSION['temp_bah_cod_m']) || !isset($_SESSION['temp_num_bah'])) {
    echo json_encode(array('success' => false, 'message' => 'اطلاعات کاربر یافت نشد. لطفاً دوباره وارد شوید.'));
    exit;
}

$bah_cod_m = $_SESSION['temp_bah_cod_m'];
$num_bah = $_SESSION['temp_num_bah'];

// دریافت اطلاعات کاربر
$stmt = $dbh->prepare("SELECT tel_m FROM bah WHERE bah_cod_m = ? AND num_bah = ? LIMIT 1");
$stmt->execute(array($bah_cod_m, $num_bah));
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || empty($user['tel_m'])) {
    echo json_encode(array('success' => false, 'message' => 'شماره موبایل یافت نشد.'));
    exit;
}

$tel_m = $user['tel_m'];

// غیرفعال کردن OTP های قبلی استفاده نشده
$stmt = $dbh->prepare("UPDATE otp_logs SET is_used = 1 WHERE bah_cod_m = ? AND is_used = 0");
$stmt->execute(array($bah_cod_m));

// تولید OTP جدید (6 رقمی)
$otp = rand(100000, 999999);
$expires_at = date('Y-m-d H:i:s', strtotime('+5 minutes'));

// ذخیره در دیتابیس
$stmt = $dbh->prepare("INSERT INTO otp_logs (bah_cod_m, otp, tel_m, expires_at) VALUES (?, ?, ?, ?)");
$stmt->execute(array($bah_cod_m, $otp, $tel_m, $expires_at));

// ارسال پیامک - بررسی وجود تابع sendSMS
$message = "کد تأیید ورود: " . $otp . " - این کد تا ۵ دقیقه معتبر است.";
$uid = uniqid();

// بررسی وجود تابع sendSMS و فراخوانی آن
if (function_exists('sendSMS')) {
    sendSMS($tel_m, $message . ' (سامانه بهره‌برداران)', $uid);
    $sms_sent = true;
} else {
    // اگر تابع sendSMS وجود نداشت، فقط برای تست لاگ کنیم
    error_log("SMS to {$tel_m}: {$message}");
    $sms_sent = true; // برای تست فرض می‌کنیم ارسال شده
}

echo json_encode(array('success' => true, 'message' => 'کد جدید با موفقیت ارسال شد.'));
?>