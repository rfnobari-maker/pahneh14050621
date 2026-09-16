<?php

// اطلاعات کاربری
$username = 'poudadmin';
$password = '6ae390lm';

// اطلاعات ورودی
$birthDate = 'YYYY-MM-DD'; // تاریخ تولد
$nin = 'your_nin'; // شماره ملی

// آدرس وب‌سرویس
$wsdl = 'https://sr-ajix.maj.ir/services/SabteAhvalEstelam٣?wsdl';

$options = array(
    'trace' => 1,
    'exceptions' => true,
    'stream_context' => stream_context_create(array(
        'http' => array(
            'header' => 'Authorization: Basic ' . base64_encode("$username:$password")
        )
    ))
);

try {
    // ایجاد شیء SoapClient
    $client = new SoapClient($wsdl, $options);

    // پارامترهای ورودی
    $params = array(
        'BirthDate' => $birthDate,
        'nin' => $nin,
    );

    // فراخوانی متد getEstelam3
    $response = $client->__soapCall('getEstelam3', array($params));

    // پردازش خروجی
    $family = $response->family; // فرض بر این است که خروجی دارای فیلد family است
    echo "Family: " . $family;

} catch (SoapFault $fault) {
    // مدیریت خطا
    echo "Error: " . $fault->getMessage();
}
?>
