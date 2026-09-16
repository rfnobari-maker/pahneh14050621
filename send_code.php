<?php
include ('./login/config.php');
include ('./web/sms1.php');
date_default_timezone_set('Asia/Tehran');

// بررسی و دریافت داده‌ها
$data = json_decode(file_get_contents('php://input'), true);
$username = isset($data['username']) ? $data['username'] : '';

if (empty($username)) {
    echo json_encode(array('status' => 'error', 'message' => "نام کاربری وارد نشده است."));
    exit;
}

function sendVerificationCode($username) {
    global $dbh;

    try {
        // دریافت شماره موبایل کاربر
        $stmt = $dbh->prepare("SELECT tel_m FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return array('status' => 'error', 'message' => "نام کاربری یافت نشد.");
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

        return array('status' => 'success', 'message' => "کد تایید ارسال شد.", 'expires_in' => 120);

    } catch (PDOException $e) {
        return array('status' => 'error', 'message' => "خطا: " . $e->getMessage());
    }
}

echo json_encode(sendVerificationCode($username));
?>
