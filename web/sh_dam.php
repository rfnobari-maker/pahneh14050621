<?php
function callSoapWebService($userName, $password, $partIDCode) {
    // آدرس سرور وب‌سرویس
    $url = "http://172.17.18.41/agriwindows/unitservicesVer3.asmx";

    // هدرهای HTTP
    $headers = array(
        "Content-Type: text/xml; charset=utf-8",
        "SOAPAction: \"http://tempuri.org/WS_G_1_4\""
    );

    // محتوای SOAP Envelope با قالب دقیق
    $soapRequest = <<<EOD
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">
   <soapenv:Header/>
   <soapenv:Body>
      <tem:WS_G_1_4>
         <tem:userName>{$userName}</tem:userName>
         <tem:Password>{$password}</tem:Password>
         <tem:PartIDcode_>{$partIDCode}</tem:PartIDcode_>
      </tem:WS_G_1_4>
   </soapenv:Body>
</soapenv:Envelope>
EOD;

    // تنظیمات cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // اجرای درخواست
    $response = curl_exec($ch);

    // بررسی خطاها
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return "خطا در اتصال: " . $error_msg;
    }

    curl_close($ch);

    // بازگرداندن پاسخ
    return $response;
}

// اطلاعات ورودی به وب‌سرویس
$userName = "eslahNejad";
$password = "9#bG640@N";
$partIDCode = "230911485026";

// فراخوانی تابع
$response = callSoapWebService($userName, $password, $partIDCode);

// نمایش پاسخ
header("Content-Type: text/plain");
print_r($response);
?>
