<?php
header('Content-Type: application/json; charset=utf-8');
//include('../../lock_oce.php'); // اینجا متغیرهای id_ostan, id_city, id_mar را دریافت می‌کنیم
include("../../login/config.php"); // اتصال به دیتابیس
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");

// گزارش خطاها
error_reporting(E_ALL);
ini_set('display_errors', 1);

// دریافت داده‌های ورودی
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// بررسی خطای JSON
if (json_last_error() !== JSON_ERROR_NONE) {
    $response = array(
        'status' => 'error',
        'message' => 'خطا در پردازش JSON دریافتی',
        'error_code' => json_last_error()
    );
    echo json_encode($response);
    exit;
}

// بررسی فیلدهای ضروری
if (empty($data['username']) || empty($data['id_city']) || empty($data['z_sal'])) {
    $response = array(
        'status' => 'error',
        'message' => 'نام کاربری، کد شهرستان یا سال زراعی وجود ندارد'
    );
    echo json_encode($response);
    exit;
}

// پردازش داده‌ها
$username = trim($data['username']);
$id_ostan = trim($data['id_ostan']);
$id_city = trim($data['id_city']);
$mor_cod_m = '' ; 
$id_mar = '' ; 
$z_sal = trim($data['z_sal']);
$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
$action = isset($data['action']) ? trim($data['action']) : '';
if ($action === 'approve') {
    $app_result = 1 ;
	$app_level_v = '3' ;  
} elseif ($action === 'reject') {
    $app_result = 2;
} else {
    $app_result = 0;
	$app_level_v = '20' ; 
}
$app_level = '3';
$app_comment = isset($data['reason']) ? trim($data['reason']) : '';
$app_date = $date_edit;

try {
    // ابتدا رکورد جدید را در جدول Agri_approved ثبت می‌کنیم
    $stmt = $dbh->prepare("INSERT INTO Agri_approved 
        (z_sal, id_ostan, id_city, id_mar, mor_cod_m, app_user, app_level, app_date, app_result, app_comment)
        VALUES (:z_sal, :id_ostan, :id_city, :id_mar, :mor_cod_m, :app_user, :app_level, :app_date, :app_result, :app_comment)
    ");
    $stmt->bindParam(':z_sal', $z_sal);
    $stmt->bindParam(':id_ostan', $id_ostan);
    $stmt->bindParam(':id_city', $id_city);
    $stmt->bindParam(':id_mar', $id_mar);
    $stmt->bindParam(':mor_cod_m', $mor_cod_m);
    $stmt->bindParam(':app_user', $username);
    $stmt->bindParam(':app_level', $app_level);
    $stmt->bindParam(':app_date', $app_date);
    $stmt->bindParam(':app_result', $app_result);
    $stmt->bindParam(':app_comment', $app_comment);
    $stmt->execute();


    $updateStmt = $dbh->prepare("UPDATE $Agri_prod_table SET app_level = :app_level, app_date = :app_date WHERE id_ostan = :id_ostan and id_city = :id_city and app_level in ('2','30')");
    $updateStmt->bindParam(':app_level', $app_level_v);
    $updateStmt->bindParam(':app_date', $app_date);
    $updateStmt->bindParam(':id_ostan', $id_ostan);
    $updateStmt->bindParam(':id_city', $id_city);	
    $updateStmt->execute();

    $response = array(
        'status' => 'success',
        'message' => 'رکورد با موفقیت ثبت و جدول بروزرسانی شد',
        'data' => array(
            'username' => $username,
            'z_sal' => $z_sal,
            'id_ostan' => $id_ostan,
            'id_city' => $id_city,
            'id_mar' => $id_mar,
            'app_level' => $app_level,
            'app_result' => $app_result,
            'app_comment' => $app_comment,
            'app_date' => $app_date
        )
    );
    echo json_encode($response);
} catch (PDOException $e) {
    $response = array(
        'status' => 'error',
        'message' => 'خطا در عملیات دیتابیس: ' . $e->getMessage()
    );
    echo json_encode($response);
}
?>