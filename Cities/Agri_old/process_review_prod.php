<?php
include('../../lock_p3.php');
include('../../login/config.php');
include('../../event.php');
require_once('../../Jalali.php');
include_once('CropValidationService.php'); 

header('Content-Type: application/json');
error_reporting(0);
ini_set('display_errors', 0);

$req_id     = isset($_POST['req_id']) ? intval($_POST['req_id']) : 0;
$action     = isset($_POST['action']) ? intval($_POST['action']) : 0;
$comment    = isset($_POST['comment']) ? $_POST['comment'] : '';
$check_only = isset($_POST['check_only']) ? true : false; // تشخیص مرحله پیش‌بررسی
$date_now   = jdate("Y/m/d");

if (!$req_id || !in_array($action, array(1, 2))) {
    echo json_encode(array('status' => 'error', 'message' => 'اطلاعات ناقص است.'));
    exit;
}

try {
    $stmt = $dbh->prepare("SELECT * FROM Agri_prod_req WHERE id = :id AND status = 1");
    $stmt->execute(array(':id' => $req_id));
    $req_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$req_data) {
        echo json_encode(array('status' => 'error', 'message' => 'درخواست مورد نظر یافت نشد.'));
        exit;
    }

    $year_table = "Agri" . str_replace('-', '_', $req_data['z_sal']);
    $stmt_geo = $dbh->prepare("SELECT id_ostan, id_city, id_mar, no_kesh FROM `$year_table` WHERE id = :agri_id");
    $stmt_geo->execute(array(':agri_id' => $req_data['Agri_id']));
    $geo_data = $stmt_geo->fetch(PDO::FETCH_ASSOC);
// بررسی اینکه آیا کد محصول تغییر کرده و سطح زیر کشت افزایش یافته    

      $new_cod_mah       =  $req_data['new_cod_mah'] ;  
      $new_zer_kesht_a   =   $req_data['new_zer_kesht_a'] ; 
      $new_zer_kesht_b   =   $req_data['new_zer_kesht_b'] ; 
      $new_zer_kesht = $new_zer_kesht_a + $new_zer_kesht_b ; 

      $cod_mah       =  $req_data['cod_mah'] ;  
      $zer_kesht_a   =   $req_data['zer_kesht_a'] ; 
      $zer_kesht_b   =   $req_data['zer_kesht_b'] ; 
      $zer_kesht = $zer_kesht_a + $zer_kesht_b ; 

    if ($action == 1) {
   if ( $cod_mah != $new_cod_mah or $zer_kesht < $new_zer_kesht)
   {
        $validator = new CropValidationService($dbh);
$validation = $validator->validateCultivatedAreaAgainstAllocation(
    $req_data['Agri_id'], 
    $req_data['new_cod_mah'], 
    $new_zer_kesht,      // سطح جدید
    $zer_kesht,          // سطح قبلی (old_area)
    $req_data['z_sal'], 
    $geo_data['id_ostan'], 
    $geo_data['id_city'], 
    $geo_data['id_mar'], 
    $geo_data['no_kesh']
);

        if (!$validation['isValid']) {
            echo json_encode(array('status' => 'error', 'message' => $validation['message']));
            exit;
        }
   }
        // اگر فقط مرحله چک کردن است، اینجا متوقف شو
        if ($check_only) {
            echo json_encode(array('status' => 'success', 'message' => 'معتبر'));
            exit;
        }
        $final_status = 2; 
    } else {
        $final_status = 22; 
    }

    // عملیات نهایی بروزرسانی
    $sql_update = "UPDATE Agri_prod_req SET status = :status, city_comment = :comment, city_date = :mdate WHERE id = :id";
    $stmt_up = $dbh->prepare($sql_update);
    $result = $stmt_up->execute(array(
        ':status'  => $final_status,
        ':comment' => $comment,
        ':mdate'   => $date_now,
        ':id'      => $req_id
    ));

    if ($result) {
        $msg = ($final_status == 2) ? 'درخواست تایید و به زراعت استان ارسال شد.' : 'درخواست رد شد.';
        echo json_encode(array('status' => 'success', 'message' => $msg));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'خطا در ثبت نهایی دیتابیس.'));
    }

} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'خطای سیستمی: ' . $e->getMessage()));
}