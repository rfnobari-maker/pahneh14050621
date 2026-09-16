<?php
header('Content-Type: application/json; charset=utf-8');
include('../../login/config.php');
require_once('validate_city.php');

function clean_number($value) {
    if ($value === null || $value === '') return '0';
    return str_replace('٬', '', $value);
}

$allowed_fields = array('s_abi', 's_dem', 't_abi', 't_dem');

$field = null;
foreach ($allowed_fields as $key) {
    if (isset($_POST[$key])) {
        $field = $key;
        break;
    }
}

if (!$field) {
    echo json_encode(array('valid' => false, 'message' => '⚠️ فیلد مورد نظر یافت نشد.'));
    exit;
}

// بررسی پارامترهای الزامی
$required_params = array('z_sal', 'id_ostan', 'id_city', 'product_cod');
foreach ($required_params as $param) {
    if (!isset($_POST[$param]) || $_POST[$param] == '') {
        echo json_encode(array('valid' => false, 'message' => "⚠️ پارامتر {$param} ارسال نشده است."));
        exit;
    }
}

// تشخیص نوع درخواست (شهرستان یا مرکز)
$table_type = isset($_POST['table_type']) ? $_POST['table_type'] : 'city';

// پارامترهای اختصاصی مرکز
$id_mar = isset($_POST['id_mar']) && $_POST['id_mar'] != '' ? $_POST['id_mar'] : null;

$clean_value = clean_number($_POST[$field]);
$id_rec = isset($_POST['id_rec']) && $_POST['id_rec'] != '' ? intval($_POST['id_rec']) : null;

// پارامترهای تابع اعتبارسنجی
$params = array(
    'id_ostan' => $_POST['id_ostan'],
    'id_city' => $_POST['id_city'],
    'id_mar' => $id_mar,
    'z_sal' => $_POST['z_sal'],
    'product_cod' => $_POST['product_cod'],
    'field_name' => $field,
    'new_value' => $clean_value,
    'current_record_id' => $id_rec,
    'table_type' => $table_type,
    'check_centers' => ($table_type == 'city'),  // فقط برای شهرستان
    'check_expert' => ($table_type == 'mar')     // فقط برای مراکز
);

$result = validateCityAllocation($dbh, $params);

// اگر درخواست از نوع مرکز است و مقدار خالی یا صفر است، اطلاعات موجودی را برگردان
if ($table_type == 'mar' && ($clean_value === '' || $clean_value === null || $clean_value == 0)) {
    $params_display = array(
        'id_ostan' => $_POST['id_ostan'],
        'id_city' => $_POST['id_city'],
        'id_mar' => $id_mar,
        'z_sal' => $_POST['z_sal'],
        'product_cod' => $_POST['product_cod'],
        'field_name' => $field,
        'new_value' => 0,
        'current_record_id' => null,
        'table_type' => 'mar',
        'check_centers' => false,
        'check_expert' => false
    );
    $result_display = validateCityAllocation($dbh, $params_display);
    if ($result_display['valid']) {
        echo json_encode($result_display);
        exit;
    }
}

echo json_encode($result);
?>