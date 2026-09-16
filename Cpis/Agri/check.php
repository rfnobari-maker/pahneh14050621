<?php
header('Content-Type: application/json');
include('../../login/config.php');

function clean_number($value) {
    return str_replace('٬', '', $value);
}

// لیست فیلدهای مجاز و جدول/ستون متناظر
$fields = array(
    's_abi' => array( 'column' => 's_abi','sabt_sh' => 'sum(zer_kesht_a)+sum(zer_kesht_b)','kesht' => 'no_kesh = "1"'),
    's_dem' => array( 'column' => 's_dem','sabt_sh' => 'sum(zer_kesht_a)+sum(zer_kesht_b)','kesht' => 'no_kesh = "2"'),
    't_abi' => array( 'column' => 't_abi','sabt_sh' => 'sum(mah_tol)','kesht' => 'no_kesh = "1"'),
    't_dem' => array( 'column' => 't_dem','sabt_sh' => 'sum(mah_tol)','kesht' => 'no_kesh = "2"'),
);

// تشخیص کدام فیلد ارسال شده
$field = null;
foreach ($fields as $key => $info) {
    if (isset($_POST[$key])) {
        $field = $key;
        break;
    }
}

if (!$field || !isset($_POST['z_sal'], $_POST['id_ostan'], $_POST['product_cod'])) {
    echo json_encode(array(
        'valid' => false,
        'message' => 'اطلاعات ناقص ارسال شده است.'
    ));
    exit;
}

$user_value  = floatval(clean_number($_POST[$field]));
$z_sal       = $_POST['z_sal'];
$id_ostan    = $_POST['id_ostan'];
$product_cod = $_POST['product_cod'];
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 

try {
    // بررسی مقدار ثبت شده فعلی
    $stmt3 = $dbh->prepare("SELECT {$fields[$field]['sabt_sh']} FROM {$Agri_prod_table} WHERE cod_mah=? AND {$fields[$field]['kesht']} AND id_ostan = ? ");
    $stmt3->execute(array($product_cod,$id_ostan));
    $sabt_sh_value = $stmt3->fetchColumn();
    if ($sabt_sh_value > $user_value) {
        echo json_encode(array(
            'valid' => false,
            'message' => 'میزان ثبت شده فعلی در سامانه بیشتر از این مقدار میباشد.!'
        ));
    } else {
        echo json_encode(array('valid' => true));
    }
} catch (PDOException $e) {
    echo json_encode(array(
        'valid' => false,
        'message' => 'خطای پایگاه‌داده: ' . $e->getMessage()
    ));
}
?>

