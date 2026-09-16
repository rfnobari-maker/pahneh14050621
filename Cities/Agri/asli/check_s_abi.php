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
        'message' => 'اطلاعات ناقص ارسال شده است.',
        'stage1_value' => null,
        'stage2_value' => null,
        'final_value' => null,
        'stage1_query' => null
    ));
    exit;
}

$user_value  = floatval(clean_number($_POST[$field]));
$z_sal       = $_POST['z_sal'];
$id_ostan    = $_POST['id_ostan'];
$id_city    = $_POST['id_city'];
$id_mar    = $_POST['id_mar'];
$product_cod = $_POST['product_cod'];
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 

// --- اضافه شدن بخش نگاشت محصولات ---
$product_code_from_input = intval($product_cod);
// تعریف نگاشت برای محصولات مرتبط
$product_map = array(
    103 => 102,
    107 => 106,
);
// اگر کد محصول ورودی در آرایه نگاشت وجود داشت، از کد مرجع استفاده کن
$final_product_code = $product_code_from_input;
if (isset($product_map[$product_code_from_input])) {
    $final_product_code = $product_map[$product_code_from_input];
}
// ------------------------------------

try {
    // مرحله 1: دریافت مقدار شهرستان
    $query1 = "SELECT {$fields[$field]['column']} FROM Agri_ab_city WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
    
    // ساخت کوئری با مقادیر واقعی برای نمایش در لاگ
    $stage1_query_for_log = "SELECT {$fields[$field]['column']} FROM Agri_ab_city WHERE z_sal = '{$z_sal}' AND id_ostan = '{$id_ostan}' AND id_city = '{$id_city}' AND product_cod = '{$product_cod}'";
    
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
    $city_value = $stmt1->fetchColumn();
    if ($city_value === false) {
        echo json_encode(array(
            'valid' => false,
            'message' => 'میزان ابلاغی این محصول برای شهرستان ثبت نشده است.!',
            'stage1_value' => null,
            'stage2_value' => null,
            'final_value' => null,
            'stage1_query' => $stage1_query_for_log // نمایش کوئری با مقادیر واقعی
        ));
        exit;
    }

    // مرحله 2: مجموع مقدار در جدول مرکز
    $query2 = "
        SELECT 
            SUM({$fields[$field]['column']}) AS sum_mar_value,
            SUM(CASE WHEN id_mar = ? THEN {$fields[$field]['column']} ELSE 0 END) AS rec_mar_value
        FROM Agri_ab_mar 
        WHERE z_sal = ? AND id_ostan = ? AND id_city = ?  AND product_cod = ?";
    $stmt2 = $dbh->prepare($query2);
    $stmt2->execute(array($id_mar, $z_sal, $id_ostan, $id_city, $product_cod));
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);

    $sum_mar_value = isset($row['sum_mar_value']) ? $row['sum_mar_value'] : 0;
    $rec_mar_value = isset($row['rec_mar_value']) ? $row['rec_mar_value'] : 0;


    // بررسی نهایی
    $total = $sum_mar_value + $user_value - $rec_mar_value;

    if ($city_value < $total) {
        echo json_encode(array(
            'valid' => false,
            'message' => 'مجموع مقادیر وارد شده بیش از میزان برش شهرستان می‌باشد.!',
            'stage1_value' => floatval($city_value),
            'stage2_value' => floatval($sum_mar_value),
            'final_value' => floatval($total),
            'stage1_query' => $stage1_query_for_log
        ));

    } else {
        // --- مرحله 3: بررسی مقدار ثبت شده فعلی (بخش اصلاح شده) ---
        // ایجاد آرایه‌ای از کدهای محصولی که باید در مجموع لحاظ شوند
        $related_products = array($product_code_from_input);
        if ($product_code_from_input != $final_product_code) {
            $related_products[] = $final_product_code;
        }

        // ساخت عبارت IN برای کوئری به صورت پویا
        $in_clause = implode(',', array_fill(0, count($related_products), '?'));

       $sabt_sh_value = 0 ; 
	    $query3 = "SELECT {$fields[$field]['sabt_sh']} FROM {$Agri_prod_table} WHERE cod_mah IN ($in_clause) AND {$fields[$field]['kesht']} AND id_ostan = ? AND id_city = ? AND id_mar = ?";
        $stmt3 = $dbh->prepare($query3);
        
        // ترکیب پارامترها برای اجرا
        $params = array_merge($related_products, array($id_ostan, $id_city, $id_mar));
        $stmt3->execute($params);

        $sabt_sh_value = $stmt3->fetchColumn();

        if ($sabt_sh_value > $user_value) {
            echo json_encode(array(
                'valid'        => false,
                'message'      => 'میزان ثبت شده فعلی در سامانه بیشتر از این مقدار میباشد.!',
                'stage1_value' => floatval($city_value),
                'stage2_value' => floatval($sum_mar_value),
                'final_value'  => floatval($total),
                'sabt_value'  => floatval($sabt_sh_value),				
                'stage1_query' => $stage1_query_for_log
            ));
        } else {
            echo json_encode(array(
                'valid' => true,
                'stage1_value' => floatval($city_value),
                'stage2_value' => floatval($sum_mar_value),
                'final_value'  => floatval($total),
                'sabt_value'  => floatval($sabt_sh_value),				
                'stage1_query' => $stage1_query_for_log
            ));
        }
    }
} catch (PDOException $e) {
    echo json_encode(array(
        'valid' => false,
        'message' => 'خطای پایگاه‌داده: ' . $e->getMessage(),
        'stage1_value' => null,
        'stage2_value' => null,
        'final_value' => null,
        'stage1_query' => $stage1_query_for_log
    ));
}
?>