<?php
header('Content-Type: application/json');

// دریافت داده‌های ارسال شده از درخواست
$data = json_decode(file_get_contents('php://input'), true);
$partIDCode = isset($data['partIDCode']) ? $data['partIDCode'] : null;

// بررسی مقدار دریافتی
if (!$partIDCode) {
    echo json_encode(array('message' => 'شناسه معتبر نیست'));
    exit();
}

// اتصال به دیتابیس از طریق فایل پیکربندی
include('./login/config.php');  // فرض می‌کنیم این فایل اتصال PDO را تنظیم می‌کند

try {
    // تهیه و اجرای کوئری حذف
    $stmt = $dbh->prepare("DELETE FROM animals WHERE partIDCode = :partIDCode");
    $stmt->bindParam(':partIDCode', $partIDCode, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(array('message' => 'کلیه اطلاعات ثبت شده با موفقیت حذف شدند'));
    } else {
        echo json_encode(array('message' => 'خطا در حذف رکورد'));
    }
} catch (PDOException $e) {
    echo json_encode(array('message' => 'خطا در اتصال به دیتابیس: ' . $e->getMessage()));
}
?>
