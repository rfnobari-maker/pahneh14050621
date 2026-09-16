<?php
// تابع فراخوانی وب‌سرویس
function callSoapWebService($userName, $password, $partIDCode) {
    $url = "http://172.17.18.41/agriwindows/unitservicesVer3.asmx";
    $headers = array(
        "Content-Type: text/xml; charset=utf-8",
        "SOAPAction: \"http://tempuri.org/WS_G_1_4\""
    );

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

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return "خطا در اتصال: " . $error_msg;
    }

    curl_close($ch);
    return $response;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['partIDCode'])) {
    $userName = "pahneadmin";
    $password = "pkg@1876";
    $partIDCode = $_POST['partIDCode'];  // دریافت کد یکتا از فرم

    // فراخوانی وب‌سرویس و تبدیل پاسخ به SimpleXML
    $response = callSoapWebService($userName, $password, $partIDCode);
    
    // بررسی پاسخ
    if (!$response) {
        echo "خطا در دریافت پاسخ از وب‌سرویس.";
        exit;
    }

    $xml = simplexml_load_string($response);
    if ($xml === false) {
        echo "خطا در تجزیه پاسخ XML.";
        exit;
    }

    $xml->registerXPathNamespace('ns', 'http://tempuri.org/');
    $result = $xml->xpath('//ns:ListUnitProperty/ns:UnitProperty');

    if ($result) {
        foreach ($result as $unitProperty) {
            // استفاده از طول و عرض جغرافیایی برگشتی از وب‌سرویس
            $latitude = $unitProperty->Latitude;
            $longitude = $unitProperty->Longitude;
			$unitName = $unitProperty->UnitName ;

            // نمایش اطلاعات
            echo "
            <div style='border: 2px solid #ccc; padding: 20px; margin: 20px; width: 80%;'>
                <h2>اطلاعات واحد</h2>
                <p><strong>شناسه یکتا:</strong> " . $unitProperty->PartIdCode . "</p>
                <p><strong>کد اپیدمیولوژیک:</strong> " . $unitProperty->EpidemiologicCode . "</p>
                <p><strong>کد پستی واحد:</strong> " . $unitProperty->UnitPostalCode . "</p>
                <p><strong>استان:</strong> " . $unitProperty->Ostan . "</p>
                <p><strong>شهرستان:</strong> " . $unitProperty->Shahrestan . "</p>
                <p><strong>آدرس پستی:</strong> " . $unitProperty->PostalAddress . "</p>
                <p><strong>جزئیات آدرس:</strong> " . $unitProperty->DetailAddress . "</p>
                <p><strong>طول جغرافیایی:</strong> " . $unitProperty->Longitude . "</p>
                <p><strong>عرض جغرافیایی:</strong> " . $unitProperty->Latitude . "</p>
                <p><strong>نام واحد:</strong> " . $unitProperty->UnitName . "</p>
                <p><strong>گروه واحد:</strong> " . $unitProperty->UnitGroup . "</p>
                <p><strong>نوع واحد:</strong> " . $unitProperty->UnitType . "</p>
                <p><strong>وضعیت پروانه:</strong> " . $unitProperty->LicenseStatus . "</p>
                <p><strong>نام مالک:</strong> " . $unitProperty->OwnerName . " " . $unitProperty->OwnerFamily . "</p>
                <p><strong>شماره تلفن همراه مالک:</strong> " . $unitProperty->OwnerMobile . "</p>
                <p><strong>وضعیت اجاره واحد:</strong> " . $unitProperty->RentStatus . "</p>
            </div>
            ";
            
            // نمایش نقشه با استفاده از کد قبلی شما
            echo "
             <div style='border: 2px solid #ccc; padding: 10px; width: 80%; margin-top: 20px;'>
			<!DOCTYPE html>
            <html>
            <head>
                <title>نمایش مکان با OpenStreetMap</title>
                <link rel='stylesheet' href='https://unpkg.com/leaflet@1.7.1/dist/leaflet.css' />
                <style>
                    #map { 
                        height: 400px;
                        width: 100%;
                    }
                </style>
            </head>
            <body>
                <h3>نمایش مکان روی نقشه</h3>
                <div id='map'></div>
                <script src='https://unpkg.com/leaflet@1.7.1/dist/leaflet.js'></script>
                <script>
                    var map = L.map('map').setView([$latitude, $longitude], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }).addTo(map);
                    L.marker([$latitude, $longitude]).addTo(map)
                        .bindPopup('مکان دامداری : $unitName')
                        .openPopup();
                </script>
            </body>
            </html>
			</div>
            ";
        }
    } else {
        echo "هیچ اطلاعاتی یافت نشد.";
    }
} else {
    // فرم برای وارد کردن کد یکتا
    echo '
    <form method="POST" style="text-align: center; margin: 20px;">
        <label for="partIDCode" style="font-size: 16px;">کد یکتا را وارد کنید:</label>
        <input type="text" id="partIDCode" name="partIDCode" required style="padding: 5px; font-size: 16px;">
        <button type="submit" style="padding: 6px 20px; font-size: 16px;">ارسال</button>
    </form>';
}
?>
