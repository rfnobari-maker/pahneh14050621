<?php
include ('./login/config.php');
include ('./web/sms1.php');
date_default_timezone_set('Asia/Tehran'); // به جای 'Asia/Tehran'، نام منطقه زمانی خود را بگذارید


// بررسی و دریافت داده‌ها
$data = json_decode(file_get_contents('php://input'), true);
$username = isset($data['username']) ? $data['username'] : '';

if (empty($username)) {
    echo "نام کاربری وارد نشده است.";
    exit;
}

// تابع ارسال کد تایید
function sendVerificationCode($username) {
    global $dbh;

    try {
        // دریافت شماره موبایل کاربر
        $stmt = $dbh->prepare("SELECT tel_m FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return "نام کاربری یافت نشد.";
        }

        // تولید کد تایید و زمان انقضا
        $code = rand(100000, 999999);
        $expiresAt = date('Y-m-d H:i:s', strtotime('+2 minutes'));

        // ذخیره کد تایید در جدول
        $stmt = $dbh->prepare("INSERT INTO password_reset_codes (username, phone_number, verification_code, expires_at) VALUES (:username, :phone_number, :verification_code, :expires_at)");
        $stmt->execute(array(
            ':username' => $username,
            ':phone_number' => $result['tel_m'],
            ':verification_code' => $code,
            ':expires_at' => $expiresAt
        ));

        // ارسال پیامک
        $message = "کد تأیید سامانه پهنه بندی : $code";
        $uid = uniqid();
        
        sendSMS($result['tel_m'], $message, $uid);

        return "کد تایید ارسال شد ، زمان اعتبار 120 ثانیه";

    } catch (PDOException $e) {
        return "خطا: " . $e->getMessage();
    }
}

// فراخوانی تابع و نمایش نتیجه
echo sendVerificationCode($username);
?>
