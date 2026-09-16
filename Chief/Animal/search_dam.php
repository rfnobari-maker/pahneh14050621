<?php
// اتصال به پایگاه داده از طریق فایل config.php
include('../../login/config.php');
// دریافت پارامترهای جستجو
$partIDCode = isset($_GET['partIDCode']) ? $_GET['partIDCode'] : '';
$sal = isset($_GET['sal']) ? $_GET['sal'] : '';

// بررسی ورودی‌ها
if (empty($partIDCode) || empty($sal)) {
    echo json_encode(array('found' => false, 'message' => 'لطفاً کد بخش و سال را وارد کنید.'));
    exit;
}

// جستجو در پایگاه داده بر اساس `partIDCode` و `sal`
$query = "SELECT * FROM animals WHERE partIDCode = :partIDCode AND sal = :sal";
$stmt = $dbh->prepare($query);
$stmt->bindParam(':partIDCode', $partIDCode);
$stmt->bindParam(':sal', $sal);

$stmt->execute();

// بررسی اینکه آیا رکوردی یافت شده است یا نه
if ($stmt->rowCount() > 0) {
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // بازیابی تمام رکوردها
    
    echo json_encode(array(
        'found' => true,
        'records' => $data // بازگرداندن تمام رکوردها به صورت یک آرایه
    ));
} else {
    echo json_encode(array(
        'found' => false,
        'message' => 'آمار واحد تاکنون ثبت نشده در صورت تمایل همینک میتوانید ثبت کنید '
    ));
}

// بستن اتصال
$dbh = null;
?>
