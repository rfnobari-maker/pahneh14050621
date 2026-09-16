<?php
// شامل کردن فایل تنظیمات پایگاه داده
include('./login/config.php'); // فایل تنظیمات دیتابیس شما
    
    // دریافت داده‌های ارسالی از فرم
    $partIDCode = isset($_POST['partIDCode']) ? $_POST['partIDCode'] : '';
    $sal = isset($_POST['sal']) ? $_POST['sal'] : '';
    
    // ساختن کوئری جستجو
    $query = "SELECT * FROM animals WHERE partIDCode = :partIDCode AND sal = :sal";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':partIDCode', $partIDCode);
    $stmt->bindParam(':sal', $sal);
    $stmt->execute();
    
    // بررسی نتایج
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // اگر رکوردی یافت شد، ارسال آن به صورت JSON
    if ($records) {
        echo json_encode(array('records' => $records));
    } else {
        echo json_encode(array('records' => array()));
    }
?>
