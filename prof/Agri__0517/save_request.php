<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");

// فراخوانی سرویس اعتبار سنجی الگوی کشت
include_once('CropValidationService.php');

// تنظیم هدر برای پاسخ JSON سازگار با PHP 5.3
header('Content-Type: application/json; charset=utf-8');

// ۱. دریافت داده‌های ارسالی از Ajax
$id            = isset($_POST['id']) ? intval($_POST['id']) : 0;
$z_sal         = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$new_cod_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : ''; 
$new_cod_mah   = isset($_POST['n_cod_mah']) ? $_POST['n_cod_mah'] : '';
$new_zer_a     = isset($_POST['n_zer_a']) ? floatval($_POST['n_zer_a']) : 0;
$new_zer_b     = isset($_POST['n_zer_b']) ? floatval($_POST['n_zer_b']) : 0;
$new_mah_tolp  = isset($_POST['n_pishbini']) ? floatval($_POST['n_pishbini']) : 0;
$reason        = isset($_POST['reason']) ? $_POST['reason'] : '';

if ($id == 0 || empty($z_sal)) {
    echo json_encode(array('status' => 'error', 'message' => 'اطلاعات ارسالی ناقص است.'));
    exit;
}

// تعیین نام جدول محصول (مثلاً Agri_prod1404_1405)
$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

try {
    // ۲. دریافت اطلاعات فعلی محصول برای کپی و مقایسه
    $stmt_old = $dbh->prepare("SELECT * FROM `$Agri_prod_table` WHERE id = :id");
    $stmt_old->execute(array(':id' => $id));
    $old = $stmt_old->fetch(PDO::FETCH_ASSOC);

    if (!$old) {
        echo json_encode(array('status' => 'error', 'message' => 'رکورد اصلی در جدول محصول یافت نشد.'));
        exit;
    }

    // ۳. اعتبار سنجی الگوی کشت (CropValidationService)
    // این بخش بررسی می‌کند که آیا درخواست جدید با سقف ابلاغی منطقه همخوانی دارد یا خیر
    $validator = new CropValidationService($dbh);
    $validationResult = $validator->validateCultivatedAreaAgainstAllocation(
        $id,                // آیدی ردیف فعلی
        $old['Agri_id'],    // آیدی کشاورز از جدول اصلی
        $new_cod_mah,       // کد محصول جدید پیشنهادی
        $new_zer_a,         // سطح جدید اول
        $new_zer_b,         // سطح جدید دوم
        $z_sal,             // سال زراعی
        $old['id_ostan'], 
        $old['id_city'], 
        $old['id_mar'], 
        $old['no_kesh'], 
        0                   // batch total
    );

    if ($validationResult['isValid'] === false) {
        // در صورت عدم تایید الگوی کشت، از ادامه کار جلوگیری شده و پیغام خطا صادر می‌شود
        echo json_encode(array(
            'status' => 'error', 
            'message' => 'خطای الگوی کشت: ' . $validationResult['message']
        ));
        exit;
    }

    // ۴. ثبت در جدول Agri_prod_req (کپی اطلاعات قدیمی + فیلدهای new_)
    $dbh->beginTransaction();
    
    $sql = "INSERT INTO Agri_prod_req (
        prod_id, Agri_id, date_s, mor_cod_m, id_ostan, id_city, id_mar, bah_cod_m, 
        num_bah, sh_gat, no_kesh, z_sal, mah_mas, cod_qroup, cod_mah, 
        zer_kesht_a, zer_kesht_b, mah_tolp, add_abadi, add_city,
        
        new_cod_qroup, new_cod_mah, new_zer_kesht_a, new_zer_kesht_b, new_mah_tolp, 
        reason, date_req, status
    ) VALUES (
        :prod_id, :Agri_id, :date_s, :mor_cod_m, :id_ostan, :id_city, :id_mar, :bah_cod_m, 
        :num_bah, :sh_gat, :no_kesh, :z_sal, :mah_mas, :cod_qroup, :cod_mah, 
        :zer_kesht_a, :zer_kesht_b, :mah_tolp, :add_abadi, :add_city,
        
        :new_cod_qroup, :new_cod_mah, :new_zer_kesht_a, :new_zer_kesht_b, :new_mah_tolp, 
        :reason, :date_req, 0
    )";

    $stmt_insert = $dbh->prepare($sql);
    $params = array(
        ':prod_id'         => $old['id'],
        ':Agri_id'         => $old['Agri_id'],
        ':date_s'          => $old['date_s'],
        ':mor_cod_m'       => $old['mor_cod_m'],
        ':id_ostan'        => $old['id_ostan'],
        ':id_city'         => $old['id_city'],
        ':id_mar'          => $old['id_mar'],
        ':bah_cod_m'       => $old['bah_cod_m'],
        ':num_bah'         => $old['num_bah'],
        ':sh_gat'          => $old['sh_gat'],
        ':no_kesh'         => $old['no_kesh'],
        ':z_sal'           => $old['z_sal'],
        ':mah_mas'         => $old['mah_mas'],
        ':cod_qroup'       => $old['cod_qroup'],
        ':cod_mah'         => $old['cod_mah'],
        ':zer_kesht_a'     => $old['zer_kesht_a'],
        ':zer_kesht_b'     => $old['zer_kesht_b'],
        ':mah_tolp'        => $old['mah_tolp'],
        ':add_abadi'       => $old['add_abadi'],
        ':add_city'        => $old['add_city'],
        
        ':new_cod_qroup'   => $new_cod_qroup,
        ':new_cod_mah'     => $new_cod_mah,
        ':new_zer_kesht_a' => $new_zer_a,
        ':new_zer_kesht_b' => $new_zer_b,
        ':new_mah_tolp'    => $new_mah_tolp,
        ':date_req'        => $date_edit ,
		':reason'          => $reason
    );

    $stmt_insert->execute($params);

    $dbh->commit();
    echo json_encode(array('status' => 'success', 'message' => 'درخواست اصلاح پس از تایید الگوی کشت، با موفقیت ثبت و در صف بررسی قرار گرفت.'));

} catch (Exception $e) {
    if (isset($dbh) && $dbh->inTransaction()) {
        $dbh->rollBack();
    }
    echo json_encode(array('status' => 'error', 'message' => 'خطا در ثبت درخواست: ' . $e->getMessage()));
}
?>