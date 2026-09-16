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

$required_params = array('z_sal', 'id_ostan', 'id_city', 'product_cod');
foreach ($required_params as $param) {
    if (!isset($_POST[$param]) || $_POST[$param] == '') {
        echo json_encode(array('valid' => false, 'message' => "⚠️ پارامتر {$param} ارسال نشده است."));
        exit;
    }
}

$clean_value = clean_number($_POST[$field]);
$id_rec = isset($_POST['id_rec']) && $_POST['id_rec'] != '' ? intval($_POST['id_rec']) : null;

$params = array(
    'id_ostan' => $_POST['id_ostan'],
    'id_city' => $_POST['id_city'],
    'z_sal' => $_POST['z_sal'],
    'product_cod' => $_POST['product_cod'],
    'field_name' => $field,
    'new_value' => $clean_value,
    'current_record_id' => $id_rec,
    'check_centers' => true,
    'table_type' => 'city'
);

$result = validateCityAllocation($dbh, $params);

if (isset($_POST['debug']) && $_POST['debug'] == '1') {
    $result['debug'] = array(
        'id_rec' => $id_rec,
        'field' => $field,
        'clean_value' => $clean_value
    );
}

echo json_encode($result);
?>