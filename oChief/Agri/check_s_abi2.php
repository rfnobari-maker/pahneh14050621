<?php
header('Content-Type: application/json');
include('../../login/config.php');

function clean_number($value) {
    return str_replace('٬', '', $value);
}

$fields = array(
    's_abi' => array('column' => 's_abi'),
    's_dem' => array('column' => 's_dem'),
    't_abi' => array('column' => 't_abi'),
    't_dem' => array('column' => 't_dem'),
);

$field = null;
foreach ($fields as $key => $info) {
    if (isset($_POST[$key])) {
        $field = $key;
        break;
    }
}

if (!$field || !isset($_POST['z_sal'], $_POST['id_ostan'], $_POST['id_city'], $_POST['product_cod'])) {
    echo json_encode(array(
        'valid' => false,
        'message' => 'اطلاعات ناقص ارسال شده است.'
    ));
    exit;
}

$user_value  = floatval(clean_number($_POST[$field]));
$z_sal       = $_POST['z_sal'];
$id_ostan    = $_POST['id_ostan'];
$id_city     = $_POST['id_city'];
$product_cod = $_POST['product_cod'];

try {
    // مرحله 1: دریافت مقدار ابلاغی استان
    $stmt1 = $dbh->prepare("SELECT {$fields[$field]['column']} FROM Agri_ab_ostan WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?");
    $stmt1->execute(array($z_sal, $id_ostan, $product_cod));
    $ostan_value = $stmt1->fetchColumn();

    if ($ostan_value === false) {
        echo json_encode(array(
            'valid' => false,
            'message' => 'میزان ابلاغی برای این محصول در استان ثبت نشده است.!',
            'stage1_value' => $ostan_value
        ));
        exit;
    }
    
    // مرحله 2: مجموع مقدار فعلی در جدول شهرستان
    $stmt2 = $dbh->prepare("
        SELECT 
            SUM({$fields[$field]['column']}) AS sum_city_value,
            SUM(CASE WHEN id_city = ? THEN {$fields[$field]['column']} ELSE 0 END) AS rec_city_value
        FROM Agri_ab_city 
        WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?
    ");

    $stmt2->execute(array($id_city, $z_sal, $id_ostan, $product_cod));
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);

    $sum_city_value = isset($row['sum_city_value']) ? $row['sum_city_value'] : 0;
    $rec_city_value = isset($row['rec_city_value']) ? $row['rec_city_value'] : 0;

    $total = $sum_city_value + $user_value - $rec_city_value;

    if ($ostan_value < $total) {
        echo json_encode(array(
            'valid' => false,
            'message' => 'مجموع مقادیر وارد شده بیش از میزان ابلاغی استان می‌باشد.!',
            'stage1_value' => $ostan_value,
            'stage2_value' => $sum_city_value,
            'final_value' => $total
        ));
    } else {
        echo json_encode(array(
            'valid' => true,
            'stage1_value' => $ostan_value,
            'stage2_value' => $sum_city_value,
            'final_value' => $total,
        ));
    }
} catch (PDOException $e) {
    echo json_encode(array(
        'valid' => false,
        'message' => 'خطای پایگاه‌داده: ' . $e->getMessage()
    ));
}
?>
