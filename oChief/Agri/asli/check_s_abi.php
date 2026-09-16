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
$id_city    = $_POST['id_city'];
$product_cod = $_POST['product_cod'];
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 


try {
    // مرحله 1: دریافت مقدار استان
    $stmt1 = $dbh->prepare("SELECT {$fields[$field]['column']} FROM Agri_ab_ostan WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?");
    $stmt1->execute(array($z_sal, $id_ostan, $product_cod));
    $ostan_value = $stmt1->fetchColumn();

    if ($ostan_value === false) {
        echo json_encode(array(
            'valid' => false,
            'message' => 'میزان ابلاغی برای این محصول در استان ثبت نشده است.!'
        ));
        exit;
    }

    // مرحله 2: مجموع مقدار در جدول شهر
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


    // بررسی نهایی
    $total = $sum_city_value + $user_value - $rec_city_value;

    if ($ostan_value < $total) {
        echo json_encode(array(
            'valid' => false,
            'message' => 'مجموع مقادیر وارد شده بیش از میزان ابلاغی استان می‌باشد.!'
        ));

    } else {
        // بررسی مقدار ثبت شده فعلی
        $stmt3 = $dbh->prepare("SELECT {$fields[$field]['sabt_sh']} FROM {$Agri_prod_table} WHERE cod_mah=? AND {$fields[$field]['kesht']} AND id_ostan = ? AND id_city = ?");
        $stmt3->execute(array($product_cod,$id_ostan, $id_city));
        $sabt_sh_value = $stmt3->fetchColumn();
        if ($sabt_sh_value > $user_value) {
            echo json_encode(array(
                'valid' => false,
                'message' => 'میزان ثبت شده فعلی در سامانه بیشتر از این مقدار میباشد.!'
            ));
        } else {
            echo json_encode(array('valid' => true));
        }
    }
} catch (PDOException $e) {
    echo json_encode(array(
        'valid' => false,
        'message' => 'خطای پایگاه‌داده: ' . $e->getMessage()
    ));
}
?>
