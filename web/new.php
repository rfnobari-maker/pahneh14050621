<?php
// اطلاعات احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// ساخت Timestamp
$created = gmdate('Y-m-d\TH:i:s\Z'); // زمان ساخت
$expires = gmdate('Y-m-d\TH:i:s\Z', strtotime('+10 minutes')); // زمان انقضا

// ساخت توکن امنیتی WS-Security به همراه Timestamp
$xml = '
<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
  <wsu:Timestamp wsu:Id="Timestamp-1">
    <wsu:Created>' . $created . '</wsu:Created>
    <wsu:Expires>' . $expires . '</wsu:Expires>
  </wsu:Timestamp>
  <wsse:UsernameToken>
    <wsse:Username>' . $username . '</wsse:Username>
    <wsse:Password>' . $password . '</wsse:Password>
  </wsse:UsernameToken>
</wsse:Security>';

// تنظیمات برای SoapClient
$options = array(
    'trace' => 1,
    'exceptions' => 1,
    'cache_wsdl' => WSDL_CACHE_NONE,
    'stream_context' => stream_context_create(array(
        'http' => array(
            'header' => 'Content-Type: application/soap+xml',
        ),
    )),
);

// آدرس WSDL
$wsdl = "https://sr-ajix.maj.ir/services/SabteAhvalEstelam3?wsdl";

try {
    // ساخت SoapClient
    $client = new SoapClient($wsdl, $options);

    // اضافه کردن هدر امنیتی به درخواست SOAP
    $header = new SoapHeader(
        'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd',
        'Security',
        new SoapVar($xml, XSD_ANYXML)
    );

    $client->__setSoapHeaders($header);

    // پارامترهای ورودی برای متد getEstelam3
    $params = array(
        BirthDate => 13520312,
        nin => 1380066174,
    );

    // فراخوانی متد getEstelam3
  print_r($result = $client->getEstelam3($params));

    // نمایش خروجی
   // echo "Family Name: " . $result-> message;

} catch (SoapFault $fault) {
    // نمایش خطا
    echo "Error: {$fault->faultstring}";
}
