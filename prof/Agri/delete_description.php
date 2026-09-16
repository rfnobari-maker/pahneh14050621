<?php
require_once('../../login/config.php');

header('Content-Type: application/json'); // تنظیم نوع محتوا به JSON
$response = array('success' => false); // مقدار پیش‌فرض پاسخ

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['z_sal'])) {
    $id = $_POST['id'];
    $z_sal = $_POST['z_sal'];
    $Agri_not_table = 'Agri_note' . str_replace('-', '_', $z_sal);

    try {
        $stmt = $dbh->prepare("DELETE FROM `$Agri_not_table` WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = 'خطا در حذف رکورد';
        }
    } catch (PDOException $e) {
        $response['error'] = 'خطای پایگاه‌داده: ' . $e->getMessage();
    }
} else {
    $response['error'] = 'پارامترهای لازم ارسال نشده‌اند';
}

echo json_encode($response);
?>
