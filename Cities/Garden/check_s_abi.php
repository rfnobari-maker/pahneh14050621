<?php
header('Content-Type: application/json; charset=utf-8');

include('../../lock_p3.php');   // برای دسترسی به $dbh

// ============================================================
// تبدیل ارقام و ممیز فارسی/عربی به لاتین
// ============================================================
function clean_number($value) {
    if ($value === null) return '0';
    $value = str_replace(
        array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹','٠','١','٢','٣','٤','٥','٦','٧','٨','٩','٫','،'),
        array('0','1','2','3','4','5','6','7','8','9','0','1','2','3','4','5','6','7','8','9','.','.'),
        (string)$value
    );
    return str_replace(array('٬', ',', ' '), '', $value);
}

// پاسخ JSON استاندارد
function json_response($valid, $message, $data = array()) {
    echo json_encode(array(
        'valid'   => (bool)$valid,
        'message' => (string)$message,
        'data'    => $data,
    ));
    exit;
}

// ============================================================
// فیلدهای مجاز
// ============================================================
$fields = array(
    's_bar_abi'   => 's_bar_abi',
    's_bar_dem'   => 's_bar_dem',
    't_abi'       => 't_abi',
    't_dem'       => 't_dem',
    's_nobar_abi' => 's_nobar_abi',
    's_nobar_dem' => 's_nobar_dem',
);

// ============================================================
// اعتبارسنجی ورودی‌ها
// ============================================================
$field = null;
foreach ($fields as $key => $col) {
    if (isset($_POST[$key]) && $_POST[$key] !== '') {
        $field = $key;
        break;
    }
}

if (!$field) {
    json_response(false, 'فیلد ارسالی نامعتبر است.');
}

$required = array('z_sal', 'id_ostan', 'id_city', 'id_mar', 'product_cod');
foreach ($required as $r) {
    if (!isset($_POST[$r]) || $_POST[$r] === '') {
        json_response(false, 'اطلاعات ناقص ارسال شده است. (' . $r . ')');
    }
}

// تبدیل و پاکسازی
$user_value  = floatval(clean_number($_POST[$field]));
$z_sal       = trim($_POST['z_sal']);
$id_ostan    = intval($_POST['id_ostan']);
$id_city     = intval($_POST['id_city']);
$id_mar      = intval($_POST['id_mar']);
$product_cod = trim($_POST['product_cod']);

if ($user_value < 0) {
    json_response(false, 'مقدار وارد شده نمی‌تواند منفی باشد.');
}

if ($id_ostan <= 0 || $id_city <= 0 || $id_mar <= 0 || $product_cod === '') {
    json_response(false, 'شناسه‌های ارسالی نامعتبر هستند.');
}

$column      = $fields[$field];
$city_table  = 'Garden_ab_city';
$mar_table   = 'Garden_ab_mar';

try {
    // ============================================================
    // مرحله 1: سقف شهرستان (برش ابلاغی شهرستان برای این محصول)
    // ============================================================
    $stmt1 = $dbh->prepare("SELECT {$column} FROM {$city_table} 
                            WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?");
    $stmt1->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
    $city_value = $stmt1->fetchColumn();

    if ($city_value === false) {
        json_response(false, 'برش این محصول برای شهرستان ثبت نشده است!');
    }
    $city_value = floatval($city_value);

    // ============================================================
    // مرحله 2: مجموع مقادیر فعلی مراکز این شهرستان
    //   sum_all: مجموع کل مراکز (شامل خود این مرکز)
    //   rec_val: مقدار فعلی همین مرکز
    // ============================================================
    $stmt2 = $dbh->prepare("
        SELECT 
            COALESCE(SUM({$column}), 0) AS sum_all,
            COALESCE(SUM(CASE WHEN id_mar = ? THEN {$column} ELSE 0 END), 0) AS rec_val
        FROM {$mar_table}
        WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?");
    $stmt2->execute(array($id_mar, $z_sal, $id_ostan, $id_city, $product_cod));
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);

    $sum_all = floatval($row['sum_all']);
    $rec_val = floatval($row['rec_val']);

    // مجموع سایر مراکز (بدون این مرکز)
    $other_cities_sum = $sum_all - $rec_val;
    if ($other_cities_sum < 0) $other_cities_sum = 0;

    // حداکثر مقداری که این مرکز می‌تواند داشته باشد
    $max_allowed = $city_value - $other_cities_sum;
    if ($max_allowed < 0) $max_allowed = 0;

    // مجموع جدید بعد از اعمال مقدار کاربر
    $new_total = $other_cities_sum + $user_value;
    $new_remaining = $city_value - $new_total;

    // ============================================================
    // بررسی نهایی
    // ============================================================
    if ($new_total > $city_value + 0.0001) {  // تحمل خطای اعشاری کوچک
        json_response(false, 
            'مجموع مقادیر وارد شده بیش از میزان برش شهرستان می‌باشد!',
            array(
                'city_limit'       => $city_value,
                'total_current'    => $sum_all,
                'other_cities_sum' => $other_cities_sum,
                'max_allowed'      => $max_allowed,
                'new_remaining'    => $new_remaining,
                'expert_value'     => 0,
            )
        );
    }

    // موفق
    json_response(true, 'مقدار مجاز است.', array(
        'city_limit'       => $city_value,
        'total_current'    => $sum_all,
        'other_cities_sum' => $other_cities_sum,
        'max_allowed'      => $max_allowed,
        'new_remaining'    => $new_remaining,
        'expert_value'     => 0,
    ));

} catch (PDOException $e) {
    json_response(false, 'خطای پایگاه‌داده: ' . $e->getMessage());
}