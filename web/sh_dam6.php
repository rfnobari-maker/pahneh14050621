<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>نمایش اطلاعات دامداری</title>
    <link href="../FA.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container {
            border: 2px solid #09C;
            padding: 15px;
            border-radius: 15px;
            background-color: #fff;
            margin-bottom: 20px;
            display: inline-block;
        }
        .info-container, .map-container {
            border: 2px solid #ccc;
            padding: 20px;
            width: 48%;
            box-sizing: border-box;
            display: inline-block;
            vertical-align: top;
            background-color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        #map {
            height: 400px;
            width: 100%;
        }
		.container {
        display: flex;
        justify-content: space-between;
    }

    .info-container {
        order: 2;
    }

    .map-container {
        order: 1;
    }
    </style>
</head>
<body>
    <!-- فرم همیشه نمایش داده می‌شود -->
    <div class="form-container">
        <form method="POST">
            <button type="submit" style="padding: 6px 20px; font-size: 16px; border-radius:10px">ارسال</button>
            <input type="text" id="partIDCode" name="partIDCode" required style="padding: 5px; font-size: 16px;">
            <label for="partIDCode" style="font-size: 16px;">: کد یکتا را وارد کنید</label>

        </form>
    </div>

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

// نمایش اطلاعات بعد از ارسال فرم
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['partIDCode'])) {
    $userName = "pahneadmin";
    $password = "pkg@1876";
    $partIDCode = $_POST['partIDCode'];

    $response = callSoapWebService($userName, $password, $partIDCode);

    if (!$response) {
        echo "<p>خطا در دریافت پاسخ از وب‌سرویس.</p>";
        exit;
    }

    $xml = simplexml_load_string($response);
    if ($xml === false) {
        echo "<p>خطا در تجزیه پاسخ XML.</p>";
        exit;
    }

    $xml->registerXPathNamespace('ns', 'http://tempuri.org/');
    $result = $xml->xpath('//ns:ListUnitProperty/ns:UnitProperty');

    if ($result) {
        foreach ($result as $unitProperty) {
			// بررسی اینکه UnitGroup برابر با 1 باشد
            if ($unitProperty->UnitGroup*1 != 1) {
            echo "<p style='color: red; font-size: 18px;'>شناسه یکتا مربوط به دامداری نیست.</p>";
            exit; // توقف اجرای کد
               }
            $latitude = $unitProperty->Latitude;
            $longitude = $unitProperty->Longitude;
            $unitName = $unitProperty->UnitName;
        	$unitType = $unitProperty->UnitType*1;
            $licenseStatus = $unitProperty->LicenseStatus*1 ; 
            $rentStatus = $unitProperty->RentStatus*1;
  echo "<div class='container'>
                <div class='info-container'>
                    <h2>اطلاعات واحد</h2>
                    <table dir='rtl'>
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
                    <tr><td><strong>گروه واحد:</strong></td><td> دامداری </td></tr>
                    <tr><td><strong>نوع واحد:</strong></td><td>" . translateUnitType($unitType) . "</td></tr>
                    <tr><td><strong>وضعیت پروانه:</strong></td><td>" . translateLicenseStatus($licenseStatus) . "</td></tr>
                    <tr><td><strong>نام مالک:</strong></td><td>" . $unitProperty->OwnerName . " " . $unitProperty->OwnerFamily . "</td></tr>
                    <tr><td><strong>شماره تلفن همراه مالک:</strong></td><td>" . $unitProperty->OwnerMobile . "</td></tr>
                    <tr><td><strong>وضعیت اجاره واحد:</strong></td><td>" . translateRentStatus($rentStatus) . "</td></tr>

                    </table>";

            // استخراج PartCapacityInfo و نمایش جزئیات ظرفیت
            $capacities = $unitProperty->PartCapacityInfo;
            if ($capacities) {
                echo "<h3 style='text-align: center;'>ظرفیت‌ها</h3><table dir='rtl'>";
                foreach ($capacities->UnitCapacityInfo as $capacity) {
                    echo "
                    <tr><td><strong>عنوان فعالیت:</strong></td><td>" . (string)$capacity->ActivityTypeName . "</td></tr>
                    <tr><td><strong>کد فعالیت:</strong></td><td>" . (string)$capacity->ActivityTypeCode . "</td></tr>
                    <tr><td><strong>عنوان ظرفیت:</strong></td><td>" . (string)$capacity->CapacityName . "</td></tr>
                    <tr><td><strong>کد ظرفیت:</strong></td><td>" . (string)$capacity->CapacityCode . "</td></tr>
                    <tr><td><strong>واحد ظرفیت:</strong></td><td>" . (string)$capacity->CapacityUnitName . "</td></tr>
                    <tr><td><strong>مقدار ظرفیت:</strong></td><td>" . (string)$capacity->Amount . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='text-align: center;'>ظرفیتی برای این واحد یافت نشد.</p>";
            }

            // نمایش اطلاعات اضافی
            echo "<p dir='rtl'><strong>وضعیت فعالیت:</strong> " . $unitProperty->Active . "</p>
                  <p dir='rtl'><strong>تاریخ ثبت تغییرات:</strong> " . $unitProperty->EntryDate . "</p>
                </div>";
     // نمایش نقشه
            echo "<div class='map-container'>
                    <h3>نمایش مکان روی نقشه</h3>
                    <div id='map'></div>
                    <script src='https://unpkg.com/leaflet@1.7.1/dist/leaflet.js'></script>
                    <script>
                        var map = L.map('map').setView([$latitude, $longitude], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                        }).addTo(map);
                        L.marker([$latitude, $longitude]).addTo(map)
                            .bindPopup('مکان دامداری: $unitName')
                            .openPopup();
                    </script>
                </div>
            </div>";
        }
    } else {
        echo "<p>هیچ اطلاعاتی یافت نشد.</p>";
    }
}
?>
<?php 
// نوع فعالیت
function translateUnitType($unitType) {
    $unitTypes = array(
        1  => 'واحد پرواربندی گاو',
        2  => 'واحد پرورش گاو شيري',
        3  => 'واحد پرورش گاوميش داشتی',
        4  => 'واحد پرواربندی گوسفند',
        5  => 'واحد پرورش گوسفند داشتي',
        6  => 'واحد پرورش بز',
        7  => 'واحد پرورش اسب',
        8  => 'واحد پرورش گوزن',
        9  => 'واحد پرورش شتر داشتی',
        10 => 'واحد پرورش لاما',
        11 => 'واحد پرورش سگ(گله، پليس، نگهبان و...)',
        13 => 'واحد پرورش حيوانات آزمايشگاهي(موش، خوكچه هندي، هامستر و...)',
        15 => 'واحد پرورش دام چند منظوره',
        16 => 'واحد پروش دام روستايی',
        19 => 'واحد پرورش دام مستقر در مجتمع دامپروري',
        20 => 'واحد پرواربندی گاوميش',
        21 => 'واحد پرواربندی شتر',
        22 => 'واحد پرورش آهو و جبير',
        23 => 'واحد پرورش مارال',
        24 => 'واحد پرورش كل و بز',
        25 => 'واحد پرورش قوچ و ميش',
        26 => 'واحد پرورش الاغ شيري',
        27 => 'واحد پرورش روباه (توليد پوست)',
        28 => 'واحد پرورش خرگوش',
        29 => 'واحد پروش دام غیر صنعتی',
        30 => 'واحد پرورش دام مستقر در مجموعه دامپروري'
    );
    // بازگشت ترجمه کد واحد
    return isset($unitTypes[$unitType]) ? $unitTypes[$unitType] : 'نوع واحد نامشخص';
}

// تابع برای ترجمه وضعیت پروانه
function translateLicenseStatus($licenseStatus) {
    $status = array(
        1 => 'دارای پروانه/ مجوز',
        2 => 'فاقد پروانه/ مجوز'
    );

    // بازگشت ترجمه کد وضعیت پروانه
    return isset($status[$licenseStatus]) ? $status[$licenseStatus] : 'وضعیت نامشخص';
}
//
// تابع برای ترجمه وضعیت اجاره واحد
function translateRentStatus($rentStatus) {
    $status = array(
        1 => 'دارای مستاجر',
        2 => 'بدون مستاجر'
    );

    // بازگشت ترجمه کد وضعیت اجاره
    return isset($status[$rentStatus]) ? $status[$rentStatus] : 'وضعیت نامشخص';
}


?>
</body>
</html>