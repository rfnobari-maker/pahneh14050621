<?php
function sendSMS($recipient, $message, $uid) {
    $url = 'https://sr-ajix.maj.ir/Services/NewPGSBSMSSend/PeerToPeer';

    // اطلاعات احراز هویت
    $username = 'ajix_poudadmin';
    $password = '6ae390lm';

    // تنظیمات درخواست
     $data = array(
    "senders" => array("40400300"),
    "messages" => array($message),
    "recipients" => array($recipient),
    "uids" => array($uid)
);


    // هدرهای احراز هویت
    $headers = array(
        "Authorization: Basic " . base64_encode("$username:$password"),
        "Content-Type: application/json"
    );

    // تنظیمات curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // اجرای درخواست و دریافت نتیجه
    $response = curl_exec($ch);
    $curlFailed = ($response === false || curl_errno($ch));
    if ($curlFailed) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    $result = is_string($response) ? json_decode($response, true) : null;
    $statusCode = '';
    $statusMessage = '';
    if (is_array($result) && isset($result['result']['status']) && is_array($result['result']['status'])) {
        if (isset($result['result']['status']['statusCode'])) {
            $statusCode = (string) $result['result']['status']['statusCode'];
        }
        if (isset($result['result']['status']['message'])) {
            $statusMessage = (string) $result['result']['status']['message'];
        }
    }

    if (!$curlFailed && $statusCode === '200') {
        return true;
    }

    echo 'خطا در ارسال پیام: ' . $statusMessage;
    return false;
}

// استفاده از تابع
//sendSMS("09052449870", "test send SMS", "7");
?>