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
$userName = "pahneadmin";
$password = "pkg@1876";
$partIDCode = "230911485026";


// فراخوانی وب‌سرویس و تبدیل پاسخ به SimpleXML
$response = callSoapWebService($userName, $password, $partIDCode);
$xml = simplexml_load_string($response);
$xml->registerXPathNamespace('ns', 'http://tempuri.org/');

// استخراج گره‌های UnitProperty
$result = $xml->xpath('//ns:ListUnitProperty/ns:UnitProperty');

if ($result) {
    foreach ($result as $unitProperty) {
        // نمایش اطلاعات عمومی واحد
        echo "<strong>شناسه یکتا: </strong>" . $unitProperty->PartIdCode . "<br>";
        echo "<strong>کد اپیدمیولوژیک: </strong>" . $unitProperty->EpidemiologicCode . "<br>";
        echo "<strong>کد پستی واحد: </strong>" . $unitProperty->UnitPostalCode . "<br>";
        echo "<strong>استان: </strong>" . $unitProperty->Ostan . "<br>";
        echo "<strong>شهرستان: </strong>" . $unitProperty->Shahrestan . "<br>";
        echo "<strong>آدرس پستی: </strong>" . $unitProperty->PostalAddress . "<br>";
        echo "<strong>جزئیات آدرس: </strong>" . $unitProperty->DetailAddress . "<br>";
        echo "<strong>طول جغرافیایی: </strong>" . $unitProperty->Longitude . "<br>";
        echo "<strong>عرض جغرافیایی: </strong>" . $unitProperty->Latitude . "<br>";
        echo "<strong>نام واحد: </strong>" . $unitProperty->UnitName . "<br>";
        echo "<strong>گروه واحد: </strong>" . $unitProperty->UnitGroup . "<br>";
        echo "<strong>نوع واحد: </strong>" . $unitProperty->UnitType . "<br>";
        echo "<strong>وضعیت پروانه: </strong>" . $unitProperty->LicenseStatus . "<br>";
        echo "<strong>کد ملی مالک: </strong>" . $unitProperty->OwnerNationalcode . "<br>";
        echo "<strong>نام مالک: </strong>" . $unitProperty->OwnerName . " " . $unitProperty->OwnerFamily . "<br>";
        echo "<strong>شماره تلفن همراه مالک: </strong>" . $unitProperty->OwnerMobile . "<br>";
        echo "<strong>وضعیت اجاره واحد: </strong>" . $unitProperty->RentStatus . "<br>";
        
        // استخراج PartCapacityInfo و نمایش جزئیات ظرفیت
        $capacities = $unitProperty->PartCapacityInfo;
        if ($capacities) {
            echo "<strong>ظرفیت‌ها:</strong><br>";
            foreach ($capacities->UnitCapacityInfo as $capacity) {
                echo "<strong>عنوان فعالیت: </strong>" . (string)$capacity->ActivityTypeName . "<br>";
                echo "<strong>کد فعالیت: </strong>" . (string)$capacity->ActivityTypeCode . "<br>";
                echo "<strong>عنوان ظرفیت: </strong>" . (string)$capacity->CapacityName . "<br>";
                echo "<strong>کد ظرفیت: </strong>" . (string)$capacity->CapacityCode . "<br>";
                echo "<strong>واحد ظرفیت: </strong>" . (string)$capacity->CapacityUnitName . "<br>";
                echo "<strong>کد واحد ظرفیت: </strong>" . (string)$capacity->CapacityUnitCode . "<br>";
                echo "<strong>مقدار ظرفیت: </strong>" . (string)$capacity->Amount . "<br><br>";
            }
        } else {
            echo "ظرفیتی برای این واحد یافت نشد.<br>";
        }
        
        // نمایش اطلاعات اضافی مانند تاریخ و وضعیت
        echo "<strong>وضعیت فعالیت: </strong>" . $unitProperty->Active . "<br>";
        echo "<strong>تاریخ ثبت تغییرات: </strong>" . $unitProperty->EntryDate . "<br><br>";
    }
} else {
    echo "هیچ اطلاعاتی یافت نشد.";
}
?>

