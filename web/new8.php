<?php
// اطلاعات احراز هویت
$username = 'poudadmin';
$password = '6ae390lm';

// آدرس وب‌سرویس
$serviceUrl = "https://sr-ajix.maj.ir/services/SabteAhvalEstelam3";

// ساخت درخواست SOAP
$xml = '
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" 
                  xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
    <soapenv:Header>
        <wsse:Security>
            <wsse:UsernameToken>
                <wsse:Username>' . $username . '</wsse:Username>
                <wsse:Password>' . $password . '</wsse:Password>
            </wsse:UsernameToken>
        </wsse:Security>
    </soapenv:Header>
    <soapenv:Body>
        <getEstelam3>
            <BirthDate>13520312</BirthDate>
            <nin>1380066174</nin>
        </getEstelam3>
    </soapenv:Body>
</soapenv:Envelope>';

// ایجاد درخواست curl
$ch = curl_init();

// تنظیم URL وب‌سرویس
curl_setopt($ch, CURLOPT_URL, $serviceUrl);

// فعال‌سازی ارسال داده‌ها
curl_setopt($ch, CURLOPT_POST, true);

// ارسال درخواست SOAP
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);

// تنظیم هدرها
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: text/xml; charset=utf-8",
    "Content-Length: " . strlen($xml)
));

// فعال‌سازی دریافت خروجی
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// نمایش اطلاعات مربوط به درخواست
curl_setopt($ch, CURLOPT_VERBOSE, true);

// اجرای درخواست و دریافت نتیجه
$result = curl_exec($ch);

// بررسی خطاهای curl
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // نمایش نتیجه و اطلاعات مربوط به پاسخ HTTP
    echo "Result: " . $result . "\n";
    echo "HTTP Code: " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "\n";
}

// بستن ارتباط curl
curl_close($ch);
?>
