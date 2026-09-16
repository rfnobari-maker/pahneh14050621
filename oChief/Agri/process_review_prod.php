<?php
// درج فایل‌های ضروری با حفظ محدودیت PHP 5.3
include('../../lock_oce.php');
include('../../login/config.php');
include('../../event.php');
require_once('../../Jalali.php');
include_once('CropValidationService.php');
include '../../web/Send_Request.php';
include_once('../../web/sms1.php'); // برای ارسال پیامک

header('Content-Type: application/json');
error_reporting(0);
ini_set('display_errors', 0);

// دریافت و اعتبارسنجی داده‌ها
$req_id     = isset($_POST['req_id']) ? intval($_POST['req_id']) : 0;
$action     = isset($_POST['action']) ? intval($_POST['action']) : 0;
$comment    = isset($_POST['comment']) ? $_POST['comment'] : '';
$check_only = isset($_POST['check_only']) ? true : false;
$date_now   = jdate("Y/m/d");

// بررسی داده‌های ورودی
if (!$req_id || !in_array($action, array(1, 2))) {
    echo json_encode(array('status' => 'error', 'message' => 'اطلاعات ناقص است.'));
    exit;
}

try {
    // دریافت اطلاعات درخواست (وضعیت 2 یعنی تایید شده در شهرستان، منتظر تایید استان)
    $stmt = $dbh->prepare("SELECT * FROM Agri_prod_req WHERE id = :id AND status = 2");
    $stmt->execute(array(':id' => $req_id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo json_encode(array('status' => 'error', 'message' => 'درخواست مورد نظر یافت نشد.'));
        exit;
    }

    // خواندن متغیرها از $row
    $cod_mah = $row['cod_mah'];
    $new_cod_mah = $row['new_cod_mah'];
    $new_cod_qroup = $row['new_cod_qroup'];
    $zer_kesht_a = $row['zer_kesht_a'];
    $zer_kesht_b = $row['zer_kesht_b'];
    $new_zer_kesht_a = $row['new_zer_kesht_a'];
    $new_zer_kesht_b = $row['new_zer_kesht_b'];
    $mor_cod_m = isset($row['mor_cod_m']) ? $row['mor_cod_m'] : ''; // کارشناس پهنه
    $bah_cod_m = $row['bah_cod_m']; // کد ملی بهره بردار
    
    // محاسبه سطح کل قبلی و جدید
    $zer_kesht = floatval($zer_kesht_a) + floatval($zer_kesht_b);      // سطح قبلی (old_area)
    $new_zer_kesht = floatval($new_zer_kesht_a) + floatval($new_zer_kesht_b); // سطح جدید (new_area)
    
    $z_sal = $row['z_sal'];
    $reason = $row['reason'];
    $prod_id = $row['prod_id'];

    // دریافت اطلاعات جغرافیایی
    $year_table = "Agri" . str_replace('-', '_', $z_sal);
    $stmt_geo = $dbh->prepare("SELECT id_ostan, id_city, id_mar, no_kesh FROM `$year_table` WHERE id = :agri_id");
    $stmt_geo->execute(array(':agri_id' => $row['Agri_id']));
    $geo_data = $stmt_geo->fetch(PDO::FETCH_ASSOC);

    // اعتبارسنجی در صورت تایید
    if ($action == 1) {
        // اگر محصول تغییر کرده یا سطح تغییر یافته، اعتبارسنجی کن
        if ($cod_mah != $new_cod_mah or $zer_kesht != $new_zer_kesht) {
            $validator = new CropValidationService($dbh);
            $validation = $validator->validateCultivatedAreaAgainstAllocation(
                $row['Agri_id'],      // agri_id_from_agri_table
                $new_cod_mah,         // product_code
                $new_zer_kesht,       // new_area (سطح جدید)
                $zer_kesht,           // old_area (سطح قبلی)
                $z_sal,               // z_sal
                $geo_data['id_ostan'], // id_ostan
                $geo_data['id_city'],  // id_city
                $geo_data['id_mar'],   // id_mar
                $geo_data['no_kesh']   // no_kesh
            );

            if (!$validation['isValid']) {
                echo json_encode(array('status' => 'error', 'message' => $validation['message']));
                exit;
            }
        }
        
        if ($check_only) {
            echo json_encode(array('status' => 'success', 'message' => 'معتبر'));
            exit;
        }
        $final_status = 3; // تایید نهایی استان
    } else {
        $final_status = 33; // رد نهایی استان
    }

    // انجام بروزرسانی‌ها فقط در صورتی که تایید شده باشد
    if ($final_status == 3) {
        // ارسال تغییرات به سیستم
        $national_id = $bah_cod_m;
        $area_id = $prod_id;
        $year = substr($z_sal, 0, strpos($z_sal, "-"));
        $category = 0;
        $update_date = $date_now;
        $msg_code = 0;
        $message = $reason;

        // تغییر محصول
        if ($cod_mah != $new_cod_mah) {
            $change_type = "ChangeProduct";
            $old_value = $cod_mah;
            $new_value = $new_cod_mah;
            send_changes_info($national_id, $area_id, $year, $category, $change_type, $old_value, $new_value, $update_date, $msg_code, $message);
        }

        // تغییر زیرکشت اول
        if ($zer_kesht_a != $new_zer_kesht_a) {
            $change_type = "ChangeArea1";
            $old_value = $zer_kesht_a;
            $new_value = $new_zer_kesht_a;
            send_changes_info($national_id, $area_id, $year, $category, $change_type, $old_value, $new_value, $update_date, $msg_code, $message);
        }

        // تغییر زیرکشت دوم
        if ($zer_kesht_b != $new_zer_kesht_b) {
            $change_type = "ChangeArea2";
            $old_value = $zer_kesht_b;
            $new_value = $new_zer_kesht_b;
            send_changes_info($national_id, $area_id, $year, $category, $change_type, $old_value, $new_value, $update_date, $msg_code, $message);
        }

        // بروزرسانی جدول محصول
        $prod_table = "Agri_prod" . str_replace('-', '_', $z_sal);
        
        // پیدا کردن id رکورد Agri_prod مربوطه
        $stmt_find_prod = $dbh->prepare("SELECT id FROM `$prod_table` WHERE Agri_id = :agri_id AND cod_mah = :cod_mah LIMIT 1");
        $stmt_find_prod->execute(array(':agri_id' => $row['Agri_id'], ':cod_mah' => $cod_mah));
        $prod_record_id = $stmt_find_prod->fetchColumn();
        
        if ($prod_record_id) {
            // بروزرسانی رکورد موجود
            $sql_update_prod = "UPDATE `$prod_table` SET cod_qroup = :new_cod_qroup, cod_mah = :new_cod_mah, zer_kesht_a = :new_zer_kesht_a, zer_kesht_b = :new_zer_kesht_b, date_s = :date_s WHERE id = :id";
            $stmt_prod = $dbh->prepare($sql_update_prod);
            $stmt_prod->execute(array(
                ':new_cod_qroup' => $new_cod_qroup,
                ':new_cod_mah' => $new_cod_mah,
                ':new_zer_kesht_a' => $new_zer_kesht_a,
                ':new_zer_kesht_b' => $new_zer_kesht_b,
                ':date_s' => $date_now,
                ':id' => $prod_record_id
            ));
        }
    }

    // بروزرسانی وضعیت درخواست
    $sql_update = "UPDATE Agri_prod_req SET status = :status, prov_comment = :comment, prov_date = :mdate WHERE id = :id";
    $stmt_up = $dbh->prepare($sql_update);
    $result = $stmt_up->execute(array(
        ':status'  => $final_status,
        ':comment' => $comment,
        ':mdate'   => $date_now,
        ':id'      => $req_id
    ));

    if ($result) {
        $msg = ($final_status == 3) ? 'درخواست تایید شد و اطلاعات بروزرسانی گردید' : 'درخواست رد شد.';
        
        // ============================================================
        // ارسال پیامک به کارشناس پهنه در صورت تایید درخواست
        // با استفاده از تابع user_tel() موجود در event.php
        // ============================================================
        if ($final_status == 3 && !empty($mor_cod_m)) {
            // دریافت شماره تلفن کارشناس پهنه با استفاده از تابع user_tel
            $tel_mor = user_tel($mor_cod_m);
            
            if ($tel_mor && !empty($tel_mor)) {
                // استانداردسازی شماره تلفن (مشابه send_sms.php)
                $tel_mor = trim($tel_mor);
                if (strlen($tel_mor) == 10) {
                    $tel_mor = '0' . $tel_mor;
                }
                
                if (strlen($tel_mor) == 11) {
                    // ساخت متن پیامک
                    $sms_text = "با درخواست شما مبنی بر تغییرات زراعی بهره بردار با کد ملی " . $bah_cod_m . " موافقت شد.";
                    $uid = uniqid();
                    
                    // ارسال پیامک
                    sendSMS($tel_mor, $sms_text . '(سامانه پهنه بندی)', $uid);
                }
            }
        }
        // ============================================================
        
        echo json_encode(array('status' => 'success', 'message' => $msg));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'خطا در ثبت نهایی دیتابیس.'));
    }
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'خطای سیستمی: ' . $e->getMessage()));
}
?>