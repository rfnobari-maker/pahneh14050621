<?php
/**
 * sabt_ab.php - ذخیره برش شهرستان برای محصولات باغی
 * با اعتبارسنجی مجدد (Race Condition) و استفاده از تابع مشترک validate_baghi.php
 * سازگار با PHP 5.3.3
 * 
 * اصلاح: شرط "حداقل یکی از سطوح" فقط برای رکوردهای جدید (id=0)
 */

header('Content-Type: application/json; charset=utf-8');

include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
require_once('validate_baghi.php');

date_default_timezone_set('Asia/Tehran');

/**
 * تابع پاکسازی اعداد از جداکننده هزارگان
 */
function clean_number($value) {
    if ($value === null || $value === '') return '0';
    return str_replace(array('٬', ',', '،'), '', $value);
}

// ============================================================
// بررسی وجود داده
// ============================================================
if (!isset($_POST['s_bar_abi'])) {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ داده‌ای برای ذخیره ارسال نشده است.'
    ));
    exit;
}

// ============================================================
// دریافت و پاکسازی داده‌ها
// ============================================================
$s_bar_abi   = clean_number($_POST['s_bar_abi']);
$s_bar_dem   = clean_number($_POST['s_bar_dem']);
$s_nobar_abi = clean_number($_POST['s_nobar_abi']);
$s_nobar_dem = clean_number($_POST['s_nobar_dem']);
$t_abi       = clean_number($_POST['t_abi']);
$t_dem       = clean_number($_POST['t_dem']);
$a_abi       = clean_number($_POST['a_abi']);
$a_dem       = clean_number($_POST['a_dem']);

$id          = isset($_POST['id']) ? intval($_POST['id']) : 0;
$z_sal       = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$id_ostan    = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city     = isset($_POST['id_city']) ? $_POST['id_city'] : '';
$id_product  = isset($_POST['id_product']) ? $_POST['id_product'] : '';

// ============================================================
// اعتبارسنجی اولیه داده‌ها
// ============================================================
if ($id == 0 || $z_sal == '' || $id_ostan == '' || $id_city == '' || $id_product == '') {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ اطلاعات ناقص ارسال شده است.'
    ));
    exit;
}

// ============================================================
// اعتبارسنجی مجدد (Re-Validation) برای جلوگیری از Race Condition
// ============================================================
$fields = array(
    's_bar_abi'   => $s_bar_abi,
    's_bar_dem'   => $s_bar_dem,
    's_nobar_abi' => $s_nobar_abi,
    's_nobar_dem' => $s_nobar_dem,
    't_abi'       => $t_abi,
    't_dem'       => $t_dem
);

$validation_errors = array();

foreach ($fields as $fname => $fvalue) {
    $float_value = floatval($fvalue);
    
    if ($float_value == 0) {
        continue;
    }
    
    $res = validateCityAllocationBaghi($dbh, array(
        'id_ostan'          => $id_ostan,
        'id_city'           => $id_city,
        'z_sal'             => $z_sal,
        'product_cod'       => $id_product,
        'field_name'        => $fname,
        'new_value'         => $float_value,
        'current_record_id' => $id,
        'check_centers'     => true
    ));
    
    if (!$res['valid']) {
        $validation_errors[] = "❌ " . getFieldLabelBaghi($fname) . ": " . $res['message'];
    }
}

if (!empty($validation_errors)) {
    echo json_encode(array(
        'valid' => false,
        'message' => "⚠️ اعتبارسنجی مجدد ناموفق:\n\n" . implode("\n", $validation_errors)
    ));
    exit;
}

// ============================================================
// اعتبارسنجی منطقی (قوانین کسب و کار) - نسخه اصلاح‌شده
// ============================================================

// 1. بررسی: اگر سطح بارور وجود دارد، تولید باید بزرگتر از 0 باشد
if (floatval($s_bar_abi) > 0 && floatval($t_abi) <= 0) {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ برای سطح بارور آبی، تولید باید بزرگتر از 0 باشد.'
    ));
    exit;
}

if (floatval($s_bar_dem) > 0 && floatval($t_dem) <= 0) {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ برای سطح بارور دیم، تولید باید بزرگتر از 0 باشد.'
    ));
    exit;
}

// 2. بررسی: حداقل یکی از سطوح (بارور یا غیربارور) باید مقدار داشته باشد
// ✅ فقط برای رکوردهای جدید (id=0) - کاربر می‌تواند رکورد موجود را صفر کند
if ($id == 0) {
    $has_surface = (
        floatval($s_bar_abi) > 0 || 
        floatval($s_bar_dem) > 0 || 
        floatval($s_nobar_abi) > 0 || 
        floatval($s_nobar_dem) > 0
    );
    
    if (!$has_surface) {
        echo json_encode(array(
            'valid' => false,
            'message' => '⚠️ حداقل یکی از فیلدهای سطح (بارور یا غیربارور) باید دارای مقدار باشد.'
        ));
        exit;
    }
}
// اگر id > 0 باشد (رکورد موجود)، کاربر می‌تواند همه را صفر کند (برای تصحیح اشتباه)

// ============================================================
// آماده‌سازی برای ذخیره
// ============================================================
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

try {
    // ============================================================
    // به‌روزرسانی رکورد
    // ============================================================
    $query = "UPDATE Garden_ab_city 
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
        $status = 'ثبت اطلاعات تولیدات باغی - شهرستان';
        if (function_exists('sabt_event')) {
            sabt_event($login_session, getUserIP_1(), $date_edit, $time, '', $status, $id_ostan);
        }
        
        echo json_encode(array(
            'valid' => true,
            'message' => '✅ اطلاعات با موفقیت ذخیره شد.'
        ));
    } else {
        echo json_encode(array(
            'valid' => false,
            'message' => '⚠️ هیچ تغییری در داده‌ها ایجاد نشده است.'
        ));
    }
    
} catch (PDOException $e) {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ خطای پایگاه‌داده: ' . $e->getMessage()
    ));
} catch (Exception $e) {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ خطا: ' . $e->getMessage()
    ));
}
?>