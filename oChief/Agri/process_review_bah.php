<?php
include('../../lock_oce.php');
include('../../login/config.php');
include('../../event.php');
require_once('../../Jalali.php');
include '../../web/Send_Request.php';
include_once('../../web/sms1.php'); // اضافه شده برای ارسال پیامک

header('Content-Type: application/json');
error_reporting(0);
ini_set('display_errors', 0);
$req_id     = isset($_POST['req_id']) ? intval($_POST['req_id']) : 0;
$action     = isset($_POST['action']) ? intval($_POST['action']) : 0;
$comment    = isset($_POST['comment']) ? $_POST['comment'] : '';
$date_now   = jdate("Y/m/d");

if (!$req_id || !in_array($action, array(1, 2))) {
    echo json_encode(array('status' => 'error', 'message' => 'اطلاعات ناقص است.'));
    exit;
}

try {
    $stmt = $dbh->prepare("SELECT * FROM Agri_req_bah WHERE id = :id AND reg_status = 2");
    $stmt->execute(array(':id' => $req_id));
    $req_data = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$req_data) {
        echo json_encode(array('status' => 'error', 'message' => 'درخواست مورد نظر یافت نشد.'));
        exit;
    }

    if ($action == 1) {
        $final_status = 3; 
    } else {
        $final_status = 33; 
    }

    // عملیات نهایی بروزرسانی Agri_req_bah
    $sql_update = "UPDATE Agri_req_bah SET reg_status = :status, prov_comment = :comment, prov_date = :mdate WHERE id = :id";
    $stmt_up = $dbh->prepare($sql_update);
    $result = $stmt_up->execute(array(
        ':status'  => $final_status,
        ':comment' => $comment,
        ':mdate'   => $date_now,
        ':id'      => $req_id
    ));

    if ($result) {
        $msg = ($final_status == 3) ? 'درخواست تایید شد و اطلاعات بروزرسانی گردید.' : 'درخواست رد شد.';
        
        // *** شرط برای به‌روزرسانی جدول Agri ***
        if ($final_status == 3) {
            // فرض می‌کنیم Agri_id در جدول Agri_req_bah موجود است و شناسه اصلی مورد استفاده برای شرط است.

            $z_sal = $req_data['z_sal']; 
            $bah_cod_m = $req_data['bah_cod_m']; 
            $new_bah_cod_m = $req_data['new_bah_cod_m']; 
            $num_bah = $req_data['num_bah']; 
            $new_num_bah = $req_data['new_num_bah']; 
            $Agri_id = $req_data['Agri_id']; 
            $reason = $req_data['reason']; // تصحیح شد: $row به $req_data تغییر کرد
            $mor_cod_m = isset($req_data['mor_cod_m']) ? $req_data['mor_cod_m'] : ''; // کارشناس پهنه

            $Agri_table = "Agri" . str_replace('-', '_', $z_sal);
            $prod_table = "Agri_prod" . str_replace('-', '_', $z_sal);

            // ارسال تغییرات به سیستم
            $national_id = $bah_cod_m;
            $year = substr($z_sal, 0, strpos($z_sal, "-"));
            $category = 0;
            $update_date = $date_now;
            $msg_code = 0;
            $message = $reason;
            $change_type = "ChangeNationalID";
            $old_value = $bah_cod_m;
            $new_value = $new_bah_cod_m;
            
            // کوئری حلقه محصولات 
            $sql_query = "SELECT id FROM $prod_table WHERE Agri_id = :id";
            $stmt_product = $dbh->prepare($sql_query);
            $stmt_product->execute(array(':id' => $Agri_id));
            $results = $stmt_product->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                foreach ($results as $row) {
                    $area_id = $row["id"];
                    // ارسال اطلاعات
                    send_changes_info($national_id, $area_id, $year, $category, $change_type, $old_value, $new_value, $update_date, $msg_code, $message);
                }
            }
            
            if ($Agri_id) {
                $sql_update_Agri = "UPDATE $Agri_table SET date_s = :date_s , bah_cod_m = :bah_cod_m , num_bah = :num_bah WHERE id = :Agri_id";
                $stmt_up_Agri = $dbh->prepare($sql_update_Agri);
                $stmt_up_Agri->execute(array(
                    ':date_s' => $date_now,
                    ':bah_cod_m' => $new_bah_cod_m,
                    ':num_bah' => $new_num_bah,
                    ':Agri_id' => $Agri_id
                ));
                
                $sql_update_prod = "UPDATE $prod_table SET date_s = :date_s, bah_cod_m = :bah_cod_m, num_bah = :num_bah WHERE Agri_id = :Agri_id";
                $stmt_up_prod = $dbh->prepare($sql_update_prod);
                $stmt_up_prod->execute(array(
                    ':date_s' => $date_now,
                    ':bah_cod_m' => $new_bah_cod_m,
                    ':num_bah' => $new_num_bah,
                    ':Agri_id' => $Agri_id
                ));
            }
            
            // ============================================================
            // ارسال پیامک به کارشناس پهنه در صورت تایید درخواست
            // با استفاده از تابع user_tel() موجود در event.php
            // ============================================================
            if (!empty($mor_cod_m)) {
                // دریافت شماره تلفن کارشناس پهنه با استفاده از تابع user_tel
                $tel_mor = user_tel($mor_cod_m);
                
                if ($tel_mor && !empty($tel_mor)) {
                    // استانداردسازی شماره تلفن
                    $tel_mor = trim($tel_mor);
                    if (strlen($tel_mor) == 10) {
                        $tel_mor = '0' . $tel_mor;
                    }
                    
                    if (strlen($tel_mor) == 11) {
                        // ساخت متن پیامک
                        $sms_text = "با درخواست شما مبنی بر تغییر بهره بردار با کد ملی " . $bah_cod_m . " موافقت شد.";
                        $uid = uniqid();
                        
                        // ارسال پیامک
                        sendSMS($tel_mor, $sms_text . '(سامانه پهنه بندی)', $uid);
                    }
                }
            }
            // ============================================================
        }
        
        echo json_encode(array('status' => 'success', 'message' => $msg));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'خطا در ثبت نهایی دیتابیس.'));
    }

} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'خطای سیستمی: ' . $e->getMessage()));
}
?>