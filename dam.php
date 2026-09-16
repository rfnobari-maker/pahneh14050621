<?php
include ('./web/dam_unitDetails.php'); // فایل حاوی تابع را فراخوانی کنید
include ('./event.php'); 
?>
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
            display: flex;
            justify-content: space-between;
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
            <label for="partIDCode" style="font-size: 16px;">: شناسه یکتا را وارد کنید</label>

        </form>
    </div>
    </div>

<?php
// بررسی ارسال فرم
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['partIDCode'])) {
    $partIDCode = $_POST['partIDCode'];
    $unitData = getUnitDetails($partIDCode); // فراخوانی تابع
    // بررسی خطاها
    if (isset($unitData['error'])) {
        echo "<p style='color: red; font-size: 18px;'>" . $unitData['error'] . "</p>";
        exit;
    }

    // بررسی اینکه UnitGroup برابر با 1 باشد
    if ($unitData['UnitGroup'] != 1) {
        echo "<p style='color: red; font-size: 18px;'>شناسه یکتا مربوط به دامداری نیست.</p>";
        exit;
    }
    $bah_cod_m     = $unitData['OwnerNationalcode'] ;
    $unitTypes     = $unitData['UnitType']*1 ; 
    $licenseStatus = $unitData['LicenseStatus']*1 ; 
    $rentStatus    = $unitData['RentStatus']*1 ; 
    $ActiStatus    = $unitData['Active']*1  ; 
      ?>
<div style="width: 85%; margin: 0 auto; text-align: center">
    <?php sar_data2($bah_cod_m, '1'); ?>
</div>
      <?php
    // نمایش اطلاعات واحد
    echo "<div class='container'>
            <div class='info-container'>
                <h2>اطلاعات واحد</h2>
                <table dir='rtl'>
                    <tr><td><strong>شناسه یکتا:</strong></td><td>" . $unitData['PartIdCode'] . "</td></tr>
                    <tr><td><strong>کد اپیدمیولوژیک:</strong></td><td>" . $unitData['EpidemiologicCode'] . "</td></tr>
                    <tr><td><strong>کد پستی واحد:</strong></td><td>" . $unitData['UnitPostalCode'] . "</td></tr>
                    <tr><td><strong>استان:</strong></td><td>" . $unitData['Ostan'] . "</td></tr>
                    <tr><td><strong>شهرستان:</strong></td><td>" . $unitData['Shahrestan'] . "</td></tr>
                    <tr><td><strong>آدرس پستی:</strong></td><td>" . $unitData['PostalAddress'] . "</td></tr>
                    <tr><td><strong>طول جغرافیایی:</strong></td><td>" . $unitData['Longitude'] . "</td></tr>
                    <tr><td><strong>عرض جغرافیایی:</strong></td><td>" . $unitData['Latitude'] . "</td></tr>
                    <tr><td><strong>نام واحد:</strong></td><td>" . $unitData['UnitName'] . "</td></tr>
                    <tr><td><strong>گروه واحد:</strong></td><td> دامداری </td></tr>
                    <tr><td><strong>نوع واحد:</strong></td><td>" . translateUnitType($unitTypes) . "</td></tr>
                    <tr><td><strong>وضعیت پروانه:</strong></td><td>" . translateLicenseStatus($licenseStatus) . "</td></tr>
                    <tr><td><strong>وضعیت اجاره واحد:</strong></td><td>" . translateRentStatus($rentStatus) . "</td></tr>
                </table>
           ";

    // استخراج PartCapacityInfo و نمایش جزئیات ظرفیت
    $capacities = $unitData['Capacities']; // فرض کنید 'Capacities' در داده‌ها موجود است
    if ($capacities) {
        echo "<h3 style='text-align: center;'>ظرفیت‌ها</h3><table dir='rtl'>";
        foreach ($capacities as $capacity) {
            echo "
			 <!--
            <tr><td><strong>عنوان فعالیت:</strong></td><td>" . $capacity['ActivityTypeName'] . "</td></tr>
            <tr><td><strong>کد فعالیت:</strong></td><td>" .  $capacity['ActivityTypeCode'] . "</td></tr>
            <tr><td><strong>عنوان ظرفیت:</strong></td><td>" . $capacity['CapacityName'] . "</td></tr>
            <tr><td><strong>کد ظرفیت:</strong></td><td>" . $capacity['CapacityCode'] . "</td></tr>
            <tr><td><strong>واحد ظرفیت:</strong></td><td>" . $capacity['CapacityUnitName'] . "</td></tr>
			-->
            <tr><td><strong> ظرفیت:</strong></td><td>" . $capacity['Amount'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>ظرفیتی برای این واحد یافت نشد.</p>";
    }
            echo "<p dir='rtl'><strong>وضعیت فعالیت:</strong> " . translateActiStatus($ActiStatus) . "</p>
                  <p dir='rtl'><strong>تاریخ ثبت تغییرات:</strong> " . $unitData['EntryDate'] . "</p>
                </div>";
    // نمایش نقشه
    echo "<div class='map-container'>
            <h3>نمایش مکان روی نقشه</h3>
            <div id='map'></div>
            <script src='https://unpkg.com/leaflet@1.7.1/dist/leaflet.js'></script>
            <script>
                var map = L.map('map').setView([" . $unitData['Latitude'] . ", " . $unitData['Longitude'] . "], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);
                L.marker([" . $unitData['Latitude'] . ", " . $unitData['Longitude'] . "]).addTo(map)
                    .bindPopup('مکان دامداری: " . $unitData['UnitName'] . "')
                    .openPopup();
            </script>
        </div>
    </div>";
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

// تابع برای ترجمه وضعیت اجاره واحد
function translateRentStatus($rentStatus) {
    $status = array(
        1 => 'دارای مستاجر',
        2 => 'بدون مستاجر'
    );

    // بازگشت ترجمه کد وضعیت اجاره
    return isset($status[$rentStatus]) ? $status[$rentStatus] : 'وضعیت نامشخص';
}

// تابع برای ترجمه وضعیت فعالیت واحد
function translateActiStatus($ActiStatus) {
    $status = array(
        1 => 'فعال',
        2 => 'غیرفعال'
    );

    // بازگشت ترجمه کد وضعیت اجاره
    return isset($status[$ActiStatus]) ? $status[$ActiStatus] : 'وضعیت نامشخص';
}
?>
</body>
</html>
