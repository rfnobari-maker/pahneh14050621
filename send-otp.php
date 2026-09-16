<?php
// هدرهای امنیتی
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");

session_start();

include('login/config.php');

if (file_exists('./event.php')) {
    include('./event.php');
}

function goBackWithError($msg) {
    $_SESSION['login_error'] = $msg;
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: login.php");
    exit;
}

// دریافت و پاکسازی کد
$input_code = isset($_POST['bah_cod_m']) ? trim($_POST['bah_cod_m']) : '';

if (empty($input_code)) {
    goBackWithError("لطفاً کد ملی (10 رقم) یا شناسه ملی (11 رقم) خود را وارد کنید.");
}

// اعتبارسنجی: 10 رقم یا 11 رقم
$length = strlen($input_code);
if ($length !== 10 && $length !== 11) {
    goBackWithError("کد ملی باید 10 رقم یا شناسه ملی باید 11 رقم باشد.");
}

if (!preg_match('/^\d+$/', $input_code)) {
    goBackWithError("لطفاً فقط از اعداد استفاده کنید.");
}

// جستجو در دیتابیس
// اگر 10 رقم بود => جستجو در bah_cod_m
// اگر 11 رقم بود => جستجو در sh_meli
if ($length == 10) {
    $stmt = $dbh->prepare("SELECT tel_m, num_bah, name, last_name, no_bah, bah_cod_m FROM bah WHERE bah_cod_m = ? LIMIT 1");
    $stmt->execute(array($input_code));
} else { // 11 رقم
    $stmt = $dbh->prepare("SELECT tel_m, num_bah, name, last_name, no_bah, bah_cod_m FROM bah WHERE sh_meli = ? LIMIT 1");
    $stmt->execute(array($input_code));
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    goBackWithError("کد ملی یا شناسه ملی وارد شده در سیستم ثبت نشده است.");
}

if (empty($user['tel_m'])) {
    goBackWithError("شماره موبایل برای این کاربر ثبت نشده است. لطفاً با پشتیبانی تماس بگیرید.");
}

$tel_m = $user['tel_m'];
$num_bah = $user['num_bah'];
$bah_cod_m = $user['bah_cod_m'];  // مهم: این همان کد ملی اصلی است

// تولید OTP 6 رقمی
$otp = rand(100000, 999999);
$expires_at = date('Y-m-d H:i:s', strtotime('+5 minutes'));

// حذف OTP های قدیمی
$stmt = $dbh->prepare("DELETE FROM otp_logs WHERE bah_cod_m = ? AND is_used = 0");
$stmt->execute(array($bah_cod_m));

// ذخیره OTP جدید
$stmt = $dbh->prepare("INSERT INTO otp_logs (bah_cod_m, otp, tel_m, expires_at) VALUES (?, ?, ?, ?)");
$stmt->execute(array($bah_cod_m, $otp, $tel_m, $expires_at));

// ذخیره در session - توجه: اینجا bah_cod_m اصلی را ذخیره می‌کنیم
$_SESSION['temp_bah_cod_m'] = $bah_cod_m;  // کد ملی اصلی (همیشه 10 رقم)
$_SESSION['temp_num_bah'] = $num_bah;
$_SESSION['temp_input_code'] = $input_code; // برای دیباگ (اختیاری)

// ارسال پیامک
if (file_exists('./web/sms1.php')) {
    include('./web/sms1.php');
    if (function_exists('sendSMS')) {
        $message = "کد تأیید ورود: " . $otp . " - این کد تا ۵ دقیقه معتبر است.";
        $uid = uniqid();
        sendSMS($tel_m, $message . ' (سامانه بهره‌برداران)', $uid);
    }
}

// برای تست (در محیط عملیاتی حذف شود)
$_SESSION['debug_otp'] = $otp;

header("Location: verify-otp.php");
exit;
?>