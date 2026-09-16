<link href="../FA.css" rel="stylesheet" type="text/css" />
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
            $unitName = $unitProperty->UnitName;

            // نمایش اطلاعات
            echo "
          <div style='display: flex; justify-content: space-between; margin: 20px; font-family: Arial, sans-serif;'>
            <div style='border: 2px solid #ccc; padding: 20px; margin: 20px; width: 50%; font-family: myfont; background-color: #fff;'>
                <h2 style='text-align: center;'>اطلاعات واحد</h2>
                <table dir='rtl' style='width: 100%; border-collapse: collapse;'>
                    <tr><td><strong>شناسه یکتا:</strong></td><td>" . $unitProperty->PartIdCode . "</td></tr>
                    <tr><td><strong>کد اپیدمیولوژیک:</strong></td><td>" . $unitProperty->EpidemiologicCode . "</td></tr>
                    <tr><td><strong>کد پستی واحد:</strong></td><td>" . $unitProperty->UnitPostalCode . "</td></tr>
                    <tr><td><strong>استان:</strong></td><td>" . $unitProperty->Ostan . "</td></tr>
                    <tr><td><strong>شهرستان:</strong></td><td>" . $unitProperty->Shahrestan . "</td></tr>
                    <tr><td><strong>آدرس پستی:</strong></td><td>" . $unitProperty->PostalAddress . "</td></tr>
                    <tr><td><strong>جزئیات آدرس:</strong></td><td>" . $unitProperty->DetailAddress . "</td></tr>
                    <tr><td><strong>طول جغرافیایی:</strong></td><td>" . $unitProperty->Longitude . "</td></tr>
                    <tr><td><strong>عرض جغرافیایی:</strong></td><td>" . $unitProperty->Latitude . "</td></tr>
                    <tr><td><strong>نام واحد:</strong></td><td>" . $unitProperty->UnitName . "</td></tr>
                    <tr><td><strong>گروه واحد:</strong></td><td>" . $unitProperty->UnitGroup . "</td></tr>
                    <tr><td><strong>نوع واحد:</strong></td><td>" . $unitProperty->UnitType . "</td></tr>
                    <tr><td><strong>وضعیت پروانه:</strong></td><td>" . $unitProperty->LicenseStatus . "</td></tr>
                    <tr><td><strong>نام مالک:</strong></td><td>" . $unitProperty->OwnerName . " " . $unitProperty->OwnerFamily . "</td></tr>
                    <tr><td><strong>شماره تلفن همراه مالک:</strong></td><td>" . $unitProperty->OwnerMobile . "</td></tr>
                    <tr><td><strong>وضعیت اجاره واحد:</strong></td><td>" . $unitProperty->RentStatus . "</td></tr>
                </table>
            ";

   // استخراج PartCapacityInfo و نمایش جزئیات ظرفیت
            $capacities = $unitProperty->PartCapacityInfo;
            if ($capacities) {
                echo "<h3 style='text-align: center;'>ظرفیت‌ها</h3><table dir='rtl' style='width: 100%; border-collapse: collapse;'>";
                foreach ($capacities->UnitCapacityInfo as $capacity) {
                    echo "
                    <tr><td><strong>عنوان فعالیت:</strong></td><td>" . (string)$capacity->ActivityTypeName . "</td></tr>
                    <tr><td><strong>کد فعالیت:</strong></td><td>" . (string)$capacity->ActivityTypeCode . "</td></tr>
                    <tr><td><strong>عنوان ظرفیت:</strong></td><td>" . (string)$capacity->CapacityName . "</td></tr>
                    <tr><td><strong>کد ظرفیت:</strong></td><td>" . (string)$capacity->CapacityCode . "</td></tr>
                    <tr><td><strong>واحد ظرفیت:</strong></td><td>" . (string)$capacity->CapacityUnitName . "</td></tr>
                    <tr><td><strong>مقدار ظرفیت:</strong></td><td>" . (string)$capacity->Amount . "</td></tr>
                    ";
                }
                echo "</table>";
            } else {
                echo "<p style='text-align: center;'>ظرفیتی برای این واحد یافت نشد.</p>";
            }

            // نمایش اطلاعات اضافی مانند تاریخ و وضعیت
            echo "
            <p dir='rtl' align='right'><strong>وضعیت فعالیت:</strong> " . $unitProperty->Active . "</p>
            <p dir='rtl' align='right'><strong>تاریخ ثبت تغییرات:</strong> " . $unitProperty->EntryDate . "</p>
            </div>";
            // نمایش نقشه داخل یک کادر کوچک
            echo "
             <div style='border: 2px solid #ccc; padding: 10px; width: 50%; margin-top: 20px; background-color: #fff;'>
			<!DOCTYPE html>
            <html>
            <head>
                 <h2 style='text-align: center;'>نمایش مکان دامداری روی نقشه</title>
                <link rel='stylesheet' href='https://unpkg.com/leaflet@1.7.1/dist/leaflet.css' />
                <style>
                    #map { 
                        height: 400px;
                        width: 100%;
                    }
                </style>
            </head>
            <body>
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
			</div>
            ";
        }
    } else {
        echo "هیچ اطلاعاتی یافت نشد.";
    }
} else {
    // فرم برای وارد کردن کد یکتا
    echo '
    <div style="width: 500px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px ; background-color: #fff " >
    <form method="POST" style="text-align: center; margin: 20px;">
        <input type="text" id="partIDCode" name="partIDCode" required style="padding: 5px; font-size: 16px;">
        <label for="partIDCode" style="font-size: 16px;"> : کد یکتا را وارد کنید</label>
		<p></p>
        <button type="submit" style="padding: 6px 20px; font-size: 16px;">ارسال</button>
    </form>
	</div>
	';
}
?>
