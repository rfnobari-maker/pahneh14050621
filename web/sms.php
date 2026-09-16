<?php

// اطلاعات احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// تنظیمات داده‌ها به صورت آرایه
$data = array(
    "senders" => array("40400300"),
    "messages" => array("رمز جدید شما در سامانه پهنه بندی : Jj1403"),
    "recipients" => array("09147857121"),
    "uids" => array("5")
);

// تنظیمات هدرهای HTTP
$headers = array(
    "Content-Type: application/json",
    "Authorization: Basic " . base64_encode($username . ":" . $password)
);

// تبدیل آرایه داده‌ها به JSON
$jsonData = json_encode($data);

// پیکربندی cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://sr-ajix.maj.ir/Services/NewPGSBSMSSend/PeerToPeer");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

// اجرای درخواست
$response = curl_exec($ch);

// بررسی خطاهای احتمالی
if(curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    echo 'Response: ' . $response;
}

// بستن درخواست cURL
curl_close($ch);

?>
