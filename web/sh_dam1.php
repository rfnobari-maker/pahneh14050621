<?php
function callSoapWebService($userName, $password, $partIDCode) {
    // آدرس سرور وب‌سرویس
    $url = "http://172.17.18.41/agriwindows/unitservicesVer3.asmx";

    // هدرهای HTTP
    $headers = array(
        "Content-Type: text/xml; charset=utf-8",
        "SOAPAction: \"http://tempuri.org/WS_G_1_4\""
    );

    // محتوای SOAP Envelope
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

// فراخوانی وب‌سرویس
$response = callSoapWebService($userName, $password, $partIDCode);

// تبدیل پاسخ به SimpleXML
$xml = simplexml_load_string($response);
$xml->registerXPathNamespace('ns', 'http://tempuri.org/');

// استخراج داده‌ها
$result = $xml->xpath('//ns:ListUnitProperty/ns:UnitProperty');
if ($result) {
    $listUnitProperty = $result[0]; // اینجا به ایندکس 0 دسترسی دارید
    // ادامه پردازش
} else {
    echo "هیچ گره‌ای پیدا نشد.";
}


if ($listUnitProperty) {
    // مقادیر را در متغیرها ذخیره کنید
    $partIdCode = (string)$listUnitProperty->PartIdCode;
    $epidemiologicCode = (string)$listUnitProperty->EpidemiologicCode;
    $unitPostalCode = (string)$listUnitProperty->UnitPostalCode;
    $ostan = (string)$listUnitProperty->Ostan;
    $shahrestan = (string)$listUnitProperty->Shahrestan;
    $postalAddress = (string)$listUnitProperty->PostalAddress;
    $detailAddress = (string)$listUnitProperty->DetailAddress;
    $longitude = (string)$listUnitProperty->Longitude;
    $latitude = (string)$listUnitProperty->Latitude;
    $unitName = (string)$listUnitProperty->UnitName;

    // نمایش مقادیر
 echo "PartIdCode: $partIdCode<br><br>";
echo "EpidemiologicCode: $epidemiologicCode<br><br>";
echo "UnitPostalCode: $unitPostalCode<br><br>";
echo "Ostan: $ostan<br><br>";
echo "Shahrestan: $shahrestan<br><br>";
echo "PostalAddress: $postalAddress<br><br>";
echo "DetailAddress: $detailAddress<br><br>";
echo "Longitude: $longitude<br><br>";
echo "Latitude: $latitude<br><br>";
echo "UnitName: $unitName<br><br>";
} else {
    echo "هیچ داده‌ای پیدا نشد.";
}
?>
