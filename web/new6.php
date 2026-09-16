<?php
// اطلاعات احراز هویت
$username = 'poudadmin';
$password = '6ae390lm';

// ساخت توکن امنیتی WS-Security
$xml = '
<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
                xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
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
            'header' => 'Content-Type: text/xml; charset=utf-8',
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
