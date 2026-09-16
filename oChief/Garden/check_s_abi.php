<?php
/**
 * check_s_abi.php - اعتبارسنجی لحظه‌ای (Real-time) برای محصولات باغی
 * با استفاده از تابع مشترک validate_baghi.php
 * سازگار با PHP 5.3.3
 */

header('Content-Type: application/json; charset=utf-8');

include('../../login/config.php');
require_once('validate_baghi.php');

/**
 * تابع پاکسازی اعداد از جداکننده هزارگان
 */
function clean_number($value) {
    if ($value === null || $value === '') return '0';
    // حذف جداکننده‌های هزارگان فارسی و کاما
    return str_replace(array('٬', ',', '،'), '', $value);
}

// ============================================================
// لیست فیلدهای مجاز باغی
// ============================================================
$allowed_fields = array(
    's_bar_abi', 
    's_bar_dem', 
    's_nobar_abi', 
    's_nobar_dem', 
    't_abi', 
    't_dem'
);

// تشخیص کدام فیلد ارسال شده
$field = null;
foreach ($allowed_fields as $key) {
    if (isset($_POST[$key])) {
        $field = $key;
        break;
    }
}

if (!$field) {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ فیلد مورد نظر یافت نشد.'
    ));
    exit;
}

// ============================================================
// بررسی پارامترهای الزامی
// ============================================================
$required_params = array('z_sal', 'id_ostan', 'id_city', 'product_cod');
foreach ($required_params as $param) {
    if (!isset($_POST[$param]) || $_POST[$param] == '') {
        echo json_encode(array(
            'valid' => false,
            'message' => "⚠️ پارامتر {$param} ارسال نشده است."
        ));
        exit;
    }
}

// ============================================================
// دریافت و پاکسازی داده‌ها
// ============================================================
$clean_value = clean_number($_POST[$field]);
$id_rec = isset($_POST['id_rec']) && $_POST['id_rec'] != '' ? intval($_POST['id_rec']) : null;

// ============================================================
// فراخوانی تابع مشترک اعتبارسنجی
// ============================================================
$params = array(
    'id_ostan'          => $_POST['id_ostan'],
    'id_city'           => $_POST['id_city'],
    'z_sal'             => $_POST['z_sal'],
    'product_cod'       => $_POST['product_cod'],
    'field_name'        => $field,
    'new_value'         => $clean_value,
    'current_record_id' => $id_rec,
    'check_centers'     => true
);

$result = validateCityAllocationBaghi($dbh, $params);

// ============================================================
// اضافه کردن اطلاعات debug (در صورت درخواست)
// ============================================================
if (isset($_POST['debug']) && $_POST['debug'] == '1') {
    $result['debug'] = array(
        'id_rec'        => $id_rec,
        'field'         => $field,
        'clean_value'   => $clean_value,
        'raw_value'     => $_POST[$field]
    );
}

// ============================================================
// بازگرداندن پاسخ JSON
// ============================================================
echo json_encode($result);
?>