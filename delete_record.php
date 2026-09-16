<?php
header('Content-Type: application/json');

// دریافت داده‌های ارسال شده از درخواست
$data = json_decode(file_get_contents('php://input'), true);
$id = isset($data['recordId']) ? $data['recordId'] : null;

// بررسی مقدار دریافتی
if (!$id) {
    echo json_encode(array('message' => 'شناسه معتبر نیست'));
    exit();
}

// اتصال به دیتابیس از طریق فایل پیکربندی
include('./login/config.php');  // فرض می‌کنیم این فایل اتصال PDO را تنظیم می‌کند

try {
    // تهیه و اجرای کوئری حذف
    $stmt = $dbh->prepare("DELETE FROM animals WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(array('message' => 'اطلاعات این ردیف با موفقیت حذف شد'));
    } else {
        echo json_encode(array('message' => 'خطا در حذف رکورد'));
    }
} catch (PDOException $e) {
    echo json_encode(array('message' => 'خطا در اتصال به دیتابیس: ' . $e->getMessage()));
}
?>
