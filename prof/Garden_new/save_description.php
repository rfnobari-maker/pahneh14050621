<?php
require_once('../../login/config.php');
require_once('../../Jalali.php'); // شامل کردن فایل برای تبدیل تاریخ به شمسی
date_default_timezone_set('Asia/Tehran');

// چک کردن درخواست POST و دریافت متغیرها
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // دریافت متغیرها از POST
    $Garden_id = isset($_POST['Garden_id']) ? $_POST['Garden_id'] : null;
    $z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : null;
    $mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    
    if (empty($Garden_id) || empty($mor_cod_m) || empty($description)) {
        // اگر فیلدها خالی بودند، خطا می‌دهیم
        echo json_encode(array("success" => false, "error" => "تمام فیلدها باید پر شوند."));
        exit;
    }

    // تنظیم تاریخ شمسی
    $date_s = jdate("Y/m/d");

    // نام جدول
    $Garden_not_table = 'Garden_note' . str_replace('-', '_', $z_sal);

    // درج توضیح جدید در جدول
    try {
        // آماده‌سازی کوئری برای درج توضیح
        $stmt = $dbh->prepare("INSERT INTO `$Garden_not_table` (Garden_id, mor_cod_m, description, date_s) VALUES (:Garden_id, :mor_cod_m, :description, :date_s)");
        $stmt->bindParam(':Garden_id', $Garden_id, PDO::PARAM_INT);
        $stmt->bindParam(':mor_cod_m', $mor_cod_m, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':date_s', $date_s, PDO::PARAM_STR);

        // اجرای کوئری
        $stmt->execute();

        // دریافت ID آخرین ردیف درج شده
        $lastId = $dbh->lastInsertId();

        // بازگرداندن نتیجه به صورت JSON
        $response = array(
            "success" => true, 
            "id" => $lastId, 
            "description" => $description, 
            "date_s" => $date_s, 
            "mor_cod_m" => $mor_cod_m
        );
        echo json_encode($response);
    } catch (PDOException $e) {
        // در صورت خطا نمایش پیام خطا
        $response = array("success" => false, "error" => "خطا در ذخیره‌سازی: " . $e->getMessage());
        echo json_encode($response);
    }
}
