<?php
header('Content-Type: application/json');
include('../../login/config.php'); // فرض بر این است که فایل config شامل اتصال PDO به $dbh است

function clean_number($value) {
    // حذف جداکننده‌های هزارگان فارسی و کاما
    return str_replace(array('٬', ',', '،'), '', $value);
}

// لیست فیلدهای مجاز
// استفاده از array() برای سازگاری با PHP 5.3
$fields = array(
    's_bar_abi' => array('column' => 's_bar_abi'),
    's_bar_dem' => array('column' => 's_bar_dem'),
    't_abi' => array('column' => 't_abi'),
    't_dem' => array('column' => 't_dem'),
    's_nobar_abi' => array('column' => 's_nobar_abi'),
    's_nobar_dem' => array('column' => 's_nobar_dem')
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
    ));
    exit;
}

// دریافت و پاکسازی ورودی‌ها
$user_value  = floatval(clean_number($_POST[$field]));
$z_sal       = $_POST['z_sal'];
$id_ostan    = $_POST['id_ostan'];
$id_city     = $_POST['id_city'];
$id_     = $_POST['id_city'];
$product_cod = $_POST['product_cod'];

// تنظیم نام جداول
$ostan_table = 'Garden_ab_ostan';
$city_table = 'Garden_ab_city';
$mar_table = 'Garden_ab_mar';

try {
    // مرحله 1: دریافت مقدار برش شهرستانی (سقف)
    $query1 = "SELECT {$fields[$field]['column']} FROM {$city_table} WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute(array($z_sal, $id_ostan, $id_city,$product_cod));
    $city_value = $stmt1->fetchColumn(); // این همان سقف شهرستانی است که باید رعایت شود
    
    // در صورت نبود مقدار ابلاغی شهرستان
    if ($city_value === false) {
        echo json_encode(array(
            'valid' => false,
            'message' => 'برش این محصول برای شهرستان ثبت نشده است.!'
        ));
        exit;
    }
    $mar_value = floatval($mar_value);

    // مرحله 2: مجموع مقدار فعلی در جدول برش مراکز
    // sum_mar_value: مجموع مقادیر ثبت شده تمام شهرستان‌ها (شامل خود این شهرستان)
    // rec_mar_value: مجموع مقادیر ثبت شده این شهرستان (که قرار است با مقدار جدید جایگزین شود)
    $query2 = "
        SELECT 
            SUM({$fields[$field]['column']}) AS sum_all_city_value,
            SUM(CASE WHEN id_mar = ? THEN {$fields[$field]['column']} ELSE 0 END) AS rec_city_value
        FROM {$mar_table} 
        WHERE z_sal = ? AND id_ostan = ? AND id_city =? AND product_cod = ?";
    $stmt2 = $dbh->prepare($query2);
    $stmt2->execute(array($id_mar, $z_sal, $id_ostan, $id_city,$product_cod));
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);

    $sum_all_city_value = isset($row['sum_all_city_value']) ? floatval($row['sum_all_city_value']) : 0;
    $rec_city_value = isset($row['rec_city_value']) ? floatval($row['rec_city_value']) : 0;

    // کنترل سقف مراکز در صورت کاهش مقدار شهرستان
    if ($user_value < $rec_city_value) {
        $query3 = "SELECT SUM({$fields[$field]['column']}) FROM {$mar_table} WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
        $stmt3 = $dbh->prepare($query3);
        $stmt3->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
        $sum_centers_value = $stmt3->fetchColumn();
        
        if ($sum_centers_value !== false && $user_value < floatval($sum_centers_value)) {
            echo json_encode(array(
                'valid' => false,
                'message' => 'مجموع مقادیر فعلی مراکز شهرستان بیشتر از این مقدار هست، برای ادامه ابتدا باید مدیر شهرستان برش مراکز را تصحیح کنند!',
                'stage1_value' => $city_value,
            ));
            exit;
        }
    }

    // بررسی نهایی: کنترل سقف استان
    // مجموع فعلی تمام شهرستان‌ها (منهای مقدار فعلی این شهرستان) + مقدار جدید ردیف کاربر
    $total = $sum_all_city_value + $user_value - $rec_city_value;

    if ($city_value < $total) {
        echo json_encode(array(
            'valid' => false,
            'message' => 'مجموع مقادیر وارد شده بیش از میزان برش شهرستان می‌باشد.!',
            'stage1_value' => $city_value, // سقف ابلاغی استان
            'stage2_value' => $sum_all_city_value, // مجموع کل ثبت شده قبل از تغییر
            'final_value' => $total, // مجموع بعد از اعمال تغییرات
        ));
        exit;
    }
    
    echo json_encode(array(
        'valid' => true,
        'stage1_value' => $city_value,
        'stage2_value' => $sum_all_city_value,
        'final_value' => $total,
    ));

} catch (PDOException $e) {
    echo json_encode(array(
        'valid' => false,
        'message' => 'خطای پایگاه‌داده: ' . $e->getMessage()
    ));
}
?>