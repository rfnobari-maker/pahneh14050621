<?php
// آدرس وب سرویس
$wsdl = "https://sr-ajix.maj.ir/services/SabteAhvalEstelam3?wsdl";

// اطلاعات احراز هویت
$username = 'poudadmin';
$password = '6ae390lm';

// ساخت SoapClient با تنظیمات احراز هویت Basic
$options = array(
    'trace' => 1,
    'exceptions' => 1,
    'cache_wsdl' => WSDL_CACHE_NONE,
    'login' => $username,
    'password' => $password,
    'stream_context' => stream_context_create(array(
        'ssl' => array(
            'verify_peer' => false, // برای پذیرش گواهی SSL نامعتبر
            'verify_peer_name' => false,
        ),
    )),
);

try {
    // ساخت SoapClient
    $client = new SoapClient($wsdl, $options);

    // پارامترهای ورودی برای متد getEstelam3
    $params = array(
        'BirthDate' => '13520312',
        'nin' => '1380066174',
    );

    // فراخوانی متد getEstelam3
    $result = $client->getEstelam3($params);

    // نمایش خروجی
    echo "Family Name: " . $result->family;

} catch (SoapFault $fault) {
    // نمایش خطا
    echo "Error: {$fault->faultstring}";
}
?>
