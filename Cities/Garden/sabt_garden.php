<?php
header('Content-Type: application/json; charset=utf-8');
include('../../lock_p3.php');
include('../../event.php');
require_once('../../Jalali.php');
require_once('validate_garden.php');

date_default_timezone_set('Asia/Tehran');

function clean_number($value) {
    if ($value === null || $value === '') return '0';
    return str_replace('٬', '', $value);
}

// بررسی وجود داده
if (!isset($_POST['s_bar_abi'])) {
    echo json_encode(array('valid' => false, 'message' => '⚠️ داده‌ای برای ذخیره ارسال نشده است.'));
    exit;
}

// دریافت و پاکسازی داده‌ها
$s_bar_abi = clean_number($_POST['s_bar_abi']);
$s_bar_dem = clean_number($_POST['s_bar_dem']);
$s_nobar_abi = clean_number($_POST['s_nobar_abi']);
$s_nobar_dem = clean_number($_POST['s_nobar_dem']);
$t_abi = clean_number($_POST['t_abi']);
$t_dem = clean_number($_POST['t_dem']);
$a_abi = clean_number($_POST['a_abi']);
$a_dem = clean_number($_POST['a_dem']);
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';
$id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : null;
$id_product = isset($_POST['id_product']) ? $_POST['id_product'] : '';

// تشخیص نوع (شهرستان یا مرکز)
$table_type = isset($_POST['table_type']) ? $_POST['table_type'] : 'city';

if ($table_type == 'mar' && ($id_mar === null || $id_mar == '')) {
    echo json_encode(array('valid' => false, 'message' => '⚠️ شناسه مرکز ارسال نشده است.'));
    exit;
}

if ($id == 0 || $z_sal == '' || $id_ostan == '' || $id_city == '' || $id_product == '') {
    echo json_encode(array('valid' => false, 'message' => '⚠️ اطلاعات ناقص ارسال شده است.'));
    exit;
}

// ============================================================
// اعتبارسنجی مجدد با validate_garden.php
// ============================================================
$fields = array(
    's_bar_abi' => $s_bar_abi,
    's_bar_dem' => $s_bar_dem,
    's_nobar_abi' => $s_nobar_abi,
    's_nobar_dem' => $s_nobar_dem,
    't_abi' => $t_abi,
    't_dem' => $t_dem
);

foreach ($fields as $fname => $fvalue) {
    $params = array(
        'id_ostan' => $id_ostan,
        'id_city' => $id_city,
        'id_mar' => $id_mar,
        'z_sal' => $z_sal,
        'product_cod' => $id_product,
        'field_name' => $fname,
        'new_value' => $fvalue,
        'current_record_id' => $id,
        'table_type' => $table_type,
        'check_centers' => ($table_type == 'city'),
        'check_expert' => ($table_type == 'mar')
    );
    
    $res = validateGardenAllocation($dbh, $params);
    if (!$res['valid']) {
        echo json_encode(array(
            'valid' => false, 
            'message' => "خطا در اعتبارسنجی {$fname}: " . $res['message']
        ));
        exit;
    }
}

// ============================================================
// ذخیره‌سازی
// ============================================================
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

try {
    // تعیین جدول هدف
    $table_target = ($table_type == 'mar') ? 'Garden_ab_mar' : 'Garden_ab_city';
    
    $query = "UPDATE {$table_target} 
              SET date_s = ?, 
                  s_bar_abi = ?, s_bar_dem = ?, 
                  s_nobar_abi = ?, s_nobar_dem = ?,
                  t_abi = ?, t_dem = ?, 
                  a_abi = ?, a_dem = ? 
              WHERE id = ?";
    
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(
        $date_edit, 
        $s_bar_abi, $s_bar_dem, 
        $s_nobar_abi, $s_nobar_dem,
        $t_abi, $t_dem, 
        $a_abi, $a_dem, 
        $id
    ));
    $count = $stmt->rowCount();
    
    if ($count > 0) {
        $status = 'ثبت اطلاعات تولیدات نهایی باغی';
        if (function_exists('sabt_event')) {
            sabt_event($login_session, getUserIP_1(), $date_edit, $time, '', $status, $id_ostan);
        }
        echo json_encode(array('valid' => true, 'message' => '✅ اطلاعات با موفقیت ذخیره شد.'));
    } else {
        echo json_encode(array('valid' => false, 'message' => '⚠️ هیچ تغییری در داده‌ها ایجاد نشده است.'));
    }
    
} catch (PDOException $e) {
    echo json_encode(array('valid' => false, 'message' => '⚠️ خطای پایگاه‌داده: ' . $e->getMessage()));
}
?>