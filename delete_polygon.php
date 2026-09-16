<?php
// اتصال به پایگاه داده
include('./login/config.php');

// دریافت داده‌ها از درخواست POST
$data = json_decode(file_get_contents("php://input"), true);

// بررسی اینکه ID پلیگون ارسال شده است
if (!isset($data['id']) || empty($data['id'])) {
    echo json_encode(array('success' => false, 'error' => 'شناسه پلیگون ارسال نشده است.'));
    exit();
}

// استخراج شناسه پلیگون
$polygonId = $data['id'];

// ایجاد کوئری برای حذف پلیگون با استفاده از شناسه
$query = "DELETE FROM polygons WHERE id = :id";

// استفاده از PDO برای اجرای کوئری
try {
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $polygonId, PDO::PARAM_INT);

    // اجرای کوئری
    $result = $stmt->execute();

    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'error' => 'خطا در حذف پلیگون.'));
    }
} catch (PDOException $e) {
    echo json_encode(array('success' => false, 'error' => 'خطا در اتصال به پایگاه داده: ' . $e->getMessage()));
}

// بستن اتصال
if (isset($dbh)) {
    $dbh = null;
}
?>
