<?php
include('./login/config.php');
include('./web/sms1.php');
include('event.php');

// تابع برای ارسال کد تایید
$username = '1380066174';

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
        $message = "کد تأیید شما: $code";
        $uid = uniqid();
        
        sendSMS($result['tel_m'], $message, $uid);

        return "کد تایید ارسال شد.";

    } catch (PDOException $e) {
        return "خطا: " . $e->getMessage();
    }
}

echo sendVerificationCode($username);
?>
