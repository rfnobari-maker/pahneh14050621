<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');

// تنظیمات تاریخ شمسی و منطقه زمانی
require_once('../../Jalali.php');
if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set('Asia/Tehran');
}
$date_edit = jdate("Y/m/d");

header('Content-Type: application/json');

// دریافت داده‌ها با استفاده از آرایه قدیمی
$agri_id   = isset($_POST['agri_id'])  ? $_POST['agri_id']  : '';
//$agri_id = 8738551 ; 
$z_sal     = isset($_POST['z_sal'])    ? $_POST['z_sal']    : '';
$new_cod_m = isset($_POST['new_cod_m'])? $_POST['new_cod_m'] : '';
$num_bah   = isset($_POST['num_bah'])  ? $_POST['num_bah']  : '';
$reason    = isset($_POST['reason'])   ? $_POST['reason']   : '';

if (empty($agri_id) || empty($new_cod_m) || empty($num_bah)) {
    echo json_encode(array('status' => 'error', 'message' => 'اطلاعات ارسالی ناقص است.'));
    exit;
}

try {
    // ۱. بررسی وجود درخواست فعال (reg_status نامساوی 3 یا 33) [cite: 2]
    $stmt_check = $dbh->prepare("SELECT id FROM Agri_req_bah WHERE Agri_id = :agri_id AND reg_status NOT IN (3, 33)");
    $stmt_check->execute(array(':agri_id' => $agri_id));
    
    if ($stmt_check->rowCount() > 0) {
        echo json_encode(array('status' => 'error', 'message' => 'برای این قطعه قبلاً یک درخواست در جریان ثبت شده است.'));
        exit;
    }

    // ۲. استخراج اطلاعات فعلی زمین از جدول Agri مربوط به آن سال 
    $Agri_table = 'Agri'.str_replace('-','_',$z_sal);
    $stmt_get = $dbh->prepare("SELECT * FROM `$Agri_table` WHERE id = :id");
    $stmt_get->execute(array(':id' => $agri_id));
    $agri_data = $stmt_get->fetch(PDO::FETCH_ASSOC);

    if (!$agri_data) {
        echo json_encode(array('status' => 'error', 'message' => 'اطلاعات قطعه زمین یافت نشد.'));
        exit;
    }

    // ۳. ثبت در جدول درخواست‌ها با مقادیر اولیه طبق ساختار جدول [cite: 2]
    $sql_ins = "INSERT INTO Agri_req_bah (
        Agri_id, date_req, mor_cod_m, id_ostan, id_city, id_mar, 
        bah_cod_m, num_bah, new_bah_cod_m, new_num_bah, 
        sh_gat, m_zamin, no_kesh, z_sal, add_abadi, add_city, 
        reason, reg_status
    ) VALUES (
        :agri_id, :date_req, :mor_cod_m, :id_ostan, :id_city, :id_mar, 
        :bah_cod_m, :num_bah, :new_bah_cod_m, :new_num_bah, 
        :sh_gat, :m_zamin, :no_kesh, :z_sal, :add_abadi, :add_city, 
        :reason, 0
    )";

    $stmt_ins = $dbh->prepare($sql_ins);
    $stmt_ins->execute(array(
        ':agri_id'       => $agri_id,
        ':date_req'      => $date_edit,
        ':mor_cod_m'     => $login_session,
        ':id_ostan'      => $agri_data['id_ostan'],
        ':id_city'       => $agri_data['id_city'],
        ':id_mar'        => $agri_data['id_mar'],
        ':bah_cod_m'     => $agri_data['bah_cod_m'],
        ':num_bah'       => $agri_data['num_bah'],
        ':new_bah_cod_m' => $new_cod_m,
        ':new_num_bah'   => $num_bah,
        ':sh_gat'        => $agri_data['sh_gat'],
        ':m_zamin'       => $agri_data['m_zamin'],
        ':no_kesh'       => $agri_data['no_kesh'],
        ':z_sal'         => $z_sal,
        ':add_abadi'     => $agri_data['add_abadi'],
        ':add_city'      => $agri_data['add_city'],
        ':reason'        => $reason
    ));

    echo json_encode(array('status' => 'success', 'message' => 'درخواست با موفقیت ثبت شد.'));

} catch (PDOException $e) {
    echo json_encode(array('status' => 'error', 'message' => 'خطا: ' . $e->getMessage()));
}
?>