<?php
header('Content-Type: application/json');
include('../../login/config.php');

function clean_number($value) {
    return str_replace('٬', '', $value);
}

// لیست فیلدهای مجاز و جدول/ستون متناظر
$fields = array(
    's_abi' => array('column' => 's_abi', 'sabt_sh' => 'sum(zer_kesht_a)', 'kesht' => 'no_kesh = "1"'),
    's_dem' => array('column' => 's_dem', 'sabt_sh' => 'sum(zer_kesht_b)', 'kesht' => 'no_kesh = "2"'),
    't_abi' => array('column' => 't_abi', 'sabt_sh' => 'sum(mah_tol_a)', 'kesht' => 'no_kesh = "1"'),
    't_dem' => array('column' => 't_dem', 'sabt_sh' => 'sum(mah_tol_b)', 'kesht' => 'no_kesh = "2"'),
);

// تشخیص کدام فیلد ارسال شده
$field = null;
foreach ($fields as $key => $info) {
    if (isset($_POST[$key])) {
        $field = $key;
        break;
    }
}

if (!$field || !isset($_POST['z_sal'], $_POST['id_ostan'], $_POST['product_cod'], $_POST['id_city'], $_POST['id_mar'])) {
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
$id_city     = $_POST['id_city'];
$id_mar      = $_POST['id_mar'];
$product_cod = $_POST['product_cod'];

// --- تعیین جدول بر اساس کد محصول ---
$product_codes_to_check_vege = array('170', '172', '174');
$prod_table = '';
if (in_array($product_cod, $product_codes_to_check_vege)) {
    $prod_table = 'Vege_prod';
} else {
    $prod_table = 'Agri_prod';
    $prod_table .= str_replace('-', '_', $z_sal);
}
// ---------------------------------

// --- بخش نگاشت محصولات ---
$product_code_from_input = intval($product_cod);
$product_map = array(
    103 => 102,
    107 => 106,
);
$final_product_code = $product_code_from_input;
if (isset($product_map[$product_code_from_input])) {
    $final_product_code = $product_map[$product_code_from_input];
}
// -------------------------

try {
    // ابتدا مقدار فعلی ثبت شده برای رکورد را دریافت می‌کنیم تا بررسی کنیم آیا مقدار جدید افزایش داشته است یا خیر
    $query_current_val = "
        SELECT 
            SUM({$fields[$field]['column']}) AS sum_mar_value,
            SUM(CASE WHEN id_mar = ? THEN {$fields[$field]['column']} ELSE 0 END) AS rec_mar_value
        FROM Agri_ab_mar 
        WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
    $stmt_current = $dbh->prepare($query_current_val);
    $stmt_current->execute(array($id_mar, $z_sal, $id_ostan, $id_city, $product_cod));
    $row = $stmt_current->fetch(PDO::FETCH_ASSOC);

    $sum_mar_value = isset($row['sum_mar_value']) ? floatval($row['sum_mar_value']) : 0;
    $rec_mar_value = isset($row['rec_mar_value']) ? floatval($row['rec_mar_value']) : 0; // This is the "old" value

    // *** شروع منطق جدید ***
    // فقط در صورتی که مقدار جدید بیشتر از مقدار فعلی باشد، کنترل‌ها را انجام بده
    if ($user_value <= $rec_mar_value) {
        // چون مقدار کاهش یافته یا تغییری نکرده، بدون نیاز به کنترل، آن را معتبر تلقی می‌کنیم
        echo json_encode(array('valid' => true));
        exit;
    }
    // *** پایان منطق جدید ***

    // اگر برنامه به اینجا رسیده، یعنی مقدار افزایش یافته و باید کنترل‌ها انجام شود

    // مرحله 1: دریافت مقدار برش شهرستان
    $query1 = "SELECT {$fields[$field]['column']} FROM Agri_ab_city WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
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
            'stage1_query' => $stage1_query_for_log
        ));
        exit;
    }
    $city_value = floatval($city_value);

    // بررسی نهایی: مجموع مقادیر (با حذف مقدار فعلی و اضافه کردن مقدار جدید) نباید از مقدار برش شهرستان بیشتر باشد.
    $total = $sum_mar_value + $user_value - $rec_mar_value;

    if ($city_value < $total) {
        echo json_encode(array(
            'valid' => false,
            'message' => 'مجموع مقادیر وارد شده بیش از میزان برش شهرستان می‌باشد.!',
            'stage1_value' => $city_value,
            'stage2_value' => $sum_mar_value,
            'final_value' => $total,
            'stage1_query' => $stage1_query_for_log
        ));
        exit;
    }
    
    // مرحله 3: بررسی مقدار ثبت شده فعلی در جدول تولیدات کشاورزی (Agri_prod) یا (Vege_prod)
    if (in_array($product_cod, $product_codes_to_check_vege)) {
        // کوئری جداگانه برای Vege_prod
        $query3 = "SELECT zer_kesht FROM {$prod_table} WHERE cod_mah = ? AND id_ostan = ? AND id_city = ? AND id_mar = ? AND z_sal = ?";
        $stmt3 = $dbh->prepare($query3);
        $params = array($product_code_from_input, $id_ostan, $id_city, $id_mar, $z_sal);
    } else {
        // کوئری برای Agri_prod
        $query3 = "SELECT {$fields[$field]['sabt_sh']} FROM {$prod_table} WHERE cod_mah = ? AND {$fields[$field]['kesht']} AND id_ostan = ? AND id_city = ? AND id_mar = ?";
        $stmt3 = $dbh->prepare($query3);
        $params = array($product_code_from_input, $id_ostan, $id_city, $id_mar);
    }

    $stmt3->execute($params);
    $sabt_sh_value = $stmt3->fetchColumn();
    $sabt_sh_value = ($sabt_sh_value !== false) ? floatval($sabt_sh_value) : 0;

    // افزودن شرط مقایسه با مقدار ثبت شده توسط کارشناسان
    if ($user_value < $sabt_sh_value) {
        echo json_encode(array(
            'valid' => false,
            'message' => 'مقدار وارد شده از مقدار ثبت شده توسط کارشناسان پهنه کمتر است. (مقدار کارشناسان: ' . number_format($sabt_sh_value) . ')',
            'stage1_value' => $city_value,
            'stage2_value' => $sum_mar_value,
            'final_value' => $total,
            'sabt_value' => $sabt_sh_value,
            'stage1_query' => $stage1_query_for_log
        ));
        exit;
    }
    
    echo json_encode(array(
        'valid' => true,
        'stage1_value' => $city_value,
        'stage2_value' => $sum_mar_value,
        'final_value' => $total,
        'sabt_value' => $sabt_sh_value,
        'stage1_query' => $stage1_query_for_log
    ));

} catch (PDOException $e) {
    echo json_encode(array(
        'valid' => false,
        'message' => 'خطای پایگاه‌داده: ' . $e->getMessage(),
        'stage1_value' => null,
        'stage2_value' => null,
        'final_value' => null,
        'stage1_query' => isset($stage1_query_for_log) ? $stage1_query_for_log : null
    ));
}
?>