<?php
include ('./login/config.php');

$data = json_decode(file_get_contents('php://input'), true);
$verificationCode = isset($data['verificationCode']) ? $data['verificationCode'] : '';

if (empty($verificationCode)) {
    echo "کد تأیید وارد نشده است.";
    exit;
}

// بررسی کد تأیید
$stmt = $dbh->prepare("SELECT username FROM password_reset_codes WHERE verification_code = :verification_code AND expires_at > NOW()");
$stmt->bindParam(':verification_code', $verificationCode);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    echo "کد تأیید نامعتبر یا منقضی شده است.";
} else {
    echo "کد تأیید صحیح است.";
}
?>
