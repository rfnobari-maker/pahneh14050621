<?php
// اتصال به دیتابیس
$pdo = new PDO('mysql:host=localhost;dbname=your_db_name;charset=utf8', 'your_username', 'your_password');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// دریافت اطلاعات واحد از دیتابیس
function getUnitDetails($partIDCode) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM units WHERE PartIdCode = :partIDCode LIMIT 1");
    $stmt->execute(array('partIDCode' => $partIDCode));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// ذخیره اطلاعات جدید در دیتابیس
if (isset($_POST['saveData'])) {
    $unitId = $_POST['unitId'];
    $stmt = $pdo->prepare("INSERT INTO registered_units (unit_id, registered_at) VALUES (:unitId, NOW())");
    $stmt->execute(array('unitId' => $unitId));
    echo "<p style='color: green;'>اطلاعات با موفقیت ذخیره شد!</p>";
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>نمایش اطلاعات دامداری</title>
    <link href="../FA.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container { width: 80%; margin: auto; display: flex; justify-content: space-between; }
        .info-container, .map-container { width: 45%; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        #map { height: 400px; }
        #submitBtn { display: none; margin-top: 20px; padding: 10px; background-color: #09C; color: white; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <h2>جستجوی اطلاعات دامداری</h2>
    <form method="POST">
        <input type="text" name="partIDCode" placeholder="شناسه یکتا" required>
        <button type="submit">جستجو</button>
    </form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['partIDCode'])) {
    $partIDCode = $_POST['partIDCode'];
    $unitData = getUnitDetails($partIDCode);

    if (!$unitData) {
        echo "<p style='color: red;'>شناسه یکتا یافت نشد!</p>";
        exit;
    }
?>
    <div class="container">
        <div class="info-container">
            <h3>اطلاعات واحد</h3>
            <table>
                <tr><td><strong>شناسه یکتا:</strong></td><td><?= htmlspecialchars($unitData['PartIdCode']) ?></td></tr>
                <tr><td><strong>نام واحد:</strong></td><td><?= htmlspecialchars($unitData['UnitName']) ?></td></tr>
<tr><td><strong>کد پستی واحد:</strong></td><td><?= htmlspecialchars($unitData['UnitPostalCode']) ?></td></tr>
<tr><td><strong>استان:</strong></td><td><?= htmlspecialchars($unitData['Ostan']) ?></td></tr>
<tr><td><strong>شهرستان:</strong></td><td><?= htmlspecialchars($unitData['Shahrestan']) ?></td></tr>
<tr><td><strong>آدرس پستی:</strong></td><td><?= htmlspecialchars($unitData['PostalAddress']) ?></td></tr>
<tr><td><strong>طول جغرافیایی:</strong></td><td><?= htmlspecialchars($unitData['Longitude']) ?></td></tr>
<tr><td><strong>عرض جغرافیایی:</strong></td><td><?= htmlspecialchars($unitData['Latitude']) ?></td></tr>
<tr><td><strong>نام واحد:</strong></td><td><?= htmlspecialchars($unitData['UnitName']) ?></td></tr>
<tr><td><strong>گروه واحد:</strong></td><td>دامداری</td></tr>
<tr><td><strong>نوع واحد:</strong></td><td><?= htmlspecialchars(translateUnitType($unitData['UnitType'])) ?></td></tr>
<tr><td><strong>ظرفیت:</strong></td><td><?= htmlspecialchars($unitData['Capacity']) ?></td></tr>
<tr><td><strong>وضعیت پروانه:</strong></td><td><?= htmlspecialchars(translateLicenseStatus($unitData['LicenseStatus'])) ?></td></tr>
<tr><td><strong>وضعیت اجاره واحد:</strong></td><td><?= htmlspecialchars(translateRentStatus($unitData['RentStatus'])) ?></td></tr>
            </table>
        </div>
    // نمایش نقشه
<?php
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
?>
            <form method="POST">
                <input type="hidden" name="unitId" value="<?= htmlspecialchars($unitData['id']) ?>">
                <button type="submit" name="saveData" id="submitBtn">ثبت اطلاعات</button>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var map = L.map('map').setView([<?= $unitData['Latitude'] ?>, <?= $unitData['Longitude'] ?>], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            L.marker([<?= $unitData['Latitude'] ?>, <?= $unitData['Longitude'] ?>]).addTo(map);
            document.getElementById('submitBtn').style.display = 'block';
        });
    </script>
<?php } 
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
