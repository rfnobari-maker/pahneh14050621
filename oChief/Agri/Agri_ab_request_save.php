<?php
include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran');

header('Content-Type: application/json; charset=utf-8');

function clean_number($value) {
    if ($value === null || $value === '') return '0';
    $value = str_replace('٬', '', $value);
    $value = str_replace(',', '', $value);
    return $value;
}

if (!isset($_POST['action']) || $_POST['action'] != 'save') {
    echo json_encode(array('valid' => false, 'message' => '⚠️ درخواست نامعتبر.'));
    exit;
}

// ============================================================
// دریافت و پاکسازی داده‌ها
// ============================================================
$id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$cod_qroup = isset($_POST['cod_qroup']) ? $_POST['cod_qroup'] : ''; // ✅ جدید
$product_cod = isset($_POST['product_cod']) ? $_POST['product_cod'] : '';
$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
$reason = isset($_POST['reason']) ? trim($_POST['reason']) : '';

// دریافت id_city از session یا POST
$id_city = isset($_SESSION['id_city']) ? $_SESSION['id_city'] : null;
if (empty($id_city) && isset($_POST['id_city'])) {
    $id_city = $_POST['id_city'];
}

// مقادیر فعلی (ابلاغی)
$current_s_abi = floatval(clean_number(isset($_POST['current_s_abi']) ? $_POST['current_s_abi'] : 0));
$current_s_dem = floatval(clean_number(isset($_POST['current_s_dem']) ? $_POST['current_s_dem'] : 0));
$current_t_abi = floatval(clean_number(isset($_POST['current_t_abi']) ? $_POST['current_t_abi'] : 0));
$current_t_dem = floatval(clean_number(isset($_POST['current_t_dem']) ? $_POST['current_t_dem'] : 0));
$current_a_abi = floatval(clean_number(isset($_POST['current_a_abi']) ? $_POST['current_a_abi'] : 0));
$current_a_dem = floatval(clean_number(isset($_POST['current_a_dem']) ? $_POST['current_a_dem'] : 0));

// مقادیر درخواستی (سطح + عملکرد)
$request_s_abi = floatval(clean_number(isset($_POST['request_s_abi']) ? $_POST['request_s_abi'] : 0));
$request_s_dem = floatval(clean_number(isset($_POST['request_s_dem']) ? $_POST['request_s_dem'] : 0));
$request_a_abi = floatval(clean_number(isset($_POST['request_a_abi']) ? $_POST['request_a_abi'] : 0));
$request_a_dem = floatval(clean_number(isset($_POST['request_a_dem']) ? $_POST['request_a_dem'] : 0));

// تولید محاسبه‌شده
$calculated_t_abi = floatval(clean_number(isset($_POST['calculated_t_abi']) ? $_POST['calculated_t_abi'] : 0));
$calculated_t_dem = floatval(clean_number(isset($_POST['calculated_t_dem']) ? $_POST['calculated_t_dem'] : 0));

// ============================================================
// اعتبارسنجی اولیه
// ============================================================
if ($id_ostan == '' || $z_sal == '' || $product_cod == '' || $product_name == '') {
    echo json_encode(array('valid' => false, 'message' => '⚠️ اطلاعات ناقص ارسال شده است.'));
    exit;
}

if ($reason == '') {
    echo json_encode(array('valid' => false, 'message' => '⚠️ لطفاً علت درخواست را وارد کنید.'));
    exit;
}

if (strlen($reason) > 250) {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ متن علت درخواست نباید بیشتر از ۲۵۰ کاراکتر باشد.'
    ));
    exit;
}

// ============================================================
// بررسی حداقل یک تغییر (سطح + عملکرد)
// ============================================================
$has_change = false;
$changes = array();

if ($request_s_abi != $current_s_abi) {
    $has_change = true;
    $changes[] = 'سطح آبی: ' . number_format($current_s_abi) . ' → ' . number_format($request_s_abi);
}
if ($request_s_dem != $current_s_dem) {
    $has_change = true;
    $changes[] = 'سطح دیم: ' . number_format($current_s_dem) . ' → ' . number_format($request_s_dem);
}
if ($request_a_abi != $current_a_abi) {
    $has_change = true;
    $changes[] = 'عملکرد آبی: ' . number_format($current_a_abi) . ' → ' . number_format($request_a_abi);
}
if ($request_a_dem != $current_a_dem) {
    $has_change = true;
    $changes[] = 'عملکرد دیم: ' . number_format($current_a_dem) . ' → ' . number_format($request_a_dem);
}

if (!$has_change) {
    echo json_encode(array(
        'valid' => false, 
        'message' => '⚠️ حداقل یک فیلد (سطح یا عملکرد) باید تغییر کند.'
    ));
    exit;
}

// ============================================================
// ✅ کنترل کاهش سطح با کوئری‌های مستقیم
// ============================================================

if (!empty($id_city)) {
    
    // ۱. کنترل کاهش سطح آبی
    if ($request_s_abi < $current_s_abi) {
        
        // الف) برش شهرستانی (سطح نباید از مجموع مراکز کمتر شود)
        $query_centers = "SELECT COALESCE(SUM(s_abi), 0) FROM Agri_ab_mar 
                           WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
        $centers_sum = floatval($stmt_centers->fetchColumn());
        
        if ($request_s_abi < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح آبی پیشنهادی (' . number_format($request_s_abi) . ') از مجموع برش مراکز (' . number_format($centers_sum) . ') کمتر است. ابتدا برش مراکز را اصلاح کنید.'
            ));
            exit;
        }
        
        // ب) مجموع کشت کارشناسان (سطح نباید از مجموع کشت کارشناسان کمتر شود)
        $prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
        
        // بررسی وجود جدول
        try {
            $query_expert = "SELECT COALESCE(SUM(zer_kesht_a) + SUM(zer_kesht_b), 0) 
                             FROM {$prod_table} 
                             WHERE cod_mah = ? AND id_ostan = ? AND id_city = ? AND no_kesh = '1'";
            $stmt_expert = $dbh->prepare($query_expert);
            $stmt_expert->execute(array($product_cod, $id_ostan, $id_city));
            $expert_sum = floatval($stmt_expert->fetchColumn());
        } catch (PDOException $e) {
            // اگر جدول وجود نداشت، مقدار 0 در نظر گرفته می‌شود
            $expert_sum = 0;
        }
        
        if ($request_s_abi < $expert_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح آبی پیشنهادی (' . number_format($request_s_abi) . ') از مجموع کشت کارشناسان (' . number_format($expert_sum) . ') کمتر است.'
            ));
            exit;
        }
    }
    
    // ۲. کنترل کاهش سطح دیم
    if ($request_s_dem < $current_s_dem) {
        
        // الف) برش شهرستانی (سطح نباید از مجموع مراکز کمتر شود)
        $query_centers = "SELECT COALESCE(SUM(s_dem), 0) FROM Agri_ab_mar 
                           WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
        $centers_sum = floatval($stmt_centers->fetchColumn());
        
        if ($request_s_dem < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح دیم پیشنهادی (' . number_format($request_s_dem) . ') از مجموع برش مراکز (' . number_format($centers_sum) . ') کمتر است. ابتدا برش مراکز را اصلاح کنید.'
            ));
            exit;
        }
        
        // ب) مجموع کشت کارشناسان (سطح نباید از مجموع کشت کارشناسان کمتر شود)
        $prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
        
        try {
            $query_expert = "SELECT COALESCE(SUM(zer_kesht_a) + SUM(zer_kesht_b), 0) 
                             FROM {$prod_table} 
                             WHERE cod_mah = ? AND id_ostan = ? AND id_city = ? AND no_kesh = '2'";
            $stmt_expert = $dbh->prepare($query_expert);
            $stmt_expert->execute(array($product_cod, $id_ostan, $id_city));
            $expert_sum = floatval($stmt_expert->fetchColumn());
        } catch (PDOException $e) {
            $expert_sum = 0;
        }
        
        if ($request_s_dem < $expert_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح دیم پیشنهادی (' . number_format($request_s_dem) . ') از مجموع کشت کارشناسان (' . number_format($expert_sum) . ') کمتر است.'
            ));
            exit;
        }
    }
}

// ============================================================
// بررسی درخواست قبلی
// ============================================================
try {
    $query_check = "SELECT COUNT(*) FROM Agri_ab_request 
                    WHERE id_ostan = ? AND z_sal = ? AND product_cod = ? 
                    AND status IN ('pending', 'reviewing')";
    $stmt_check = $dbh->prepare($query_check);
    $stmt_check->execute(array($id_ostan, $z_sal, $product_cod));
    $pending_count = $stmt_check->fetchColumn();
} catch (PDOException $e) {
    echo json_encode(array(
        'valid' => false, 
        'message' => '⚠️ خطا در بررسی درخواست قبلی: ' . $e->getMessage()
    ));
    exit;
}

if ($pending_count > 0) {
    echo json_encode(array(
        'valid' => false, 
        'message' => '⚠️ درخواست قبلی برای این محصول در انتظار تأیید است.'
    ));
    exit;
}

// ============================================================
// پردازش فایل پیوست با محدودیت ۱ مگابایت
// ============================================================
$attachment_path = null;
if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
    $max_file_size = 1 * 1024 * 1024;
    
    if ($_FILES['attachment']['size'] > $max_file_size) {
        echo json_encode(array(
            'valid' => false,
            'message' => '⚠️ حجم فایل نباید بیشتر از ۱ مگابایت باشد.'
        ));
        exit;
    }
    
    $allowed_ext = array('doc', 'docx', 'xls', 'xlsx', 'pdf', 'jpg', 'jpeg', 'png', 'gif');
    $ext = strtolower(pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION));
    
    if (in_array($ext, $allowed_ext)) {
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/files/requests/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $new_filename = 'request_' . $id_ostan . '_' . $product_cod . '_' . date('Ymd_His') . '.' . $ext;
        $upload_path = $upload_dir . $new_filename;
        
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $upload_path)) {
            $attachment_path = '/files/requests/' . $new_filename;
        }
    }
}

// ============================================================
// ذخیره در دیتابیس
// ============================================================
$date_now = jdate("Y/m/d");
$created_by = isset($login_session) ? $login_session : 0;

try {
    $query = "INSERT INTO Agri_ab_request (
        id_ostan, z_sal, product_cod, product_name, cod_qroup,
        current_s_abi, current_s_dem, current_t_abi, current_t_dem, current_a_abi, current_a_dem,
        request_s_abi, request_s_dem, request_a_abi, request_a_dem,
        calculated_t_abi, calculated_t_dem,
        reason, attachment, status, created_by, created_at
    ) VALUES (
        ?, ?, ?, ?, ?,
        ?, ?, ?, ?, ?, ?,
        ?, ?, ?, ?,
        ?, ?,
        ?, ?, 'pending', ?, ?
    )";

    $stmt = $dbh->prepare($query);
    $result = $stmt->execute(array(
        $id_ostan, $z_sal, $product_cod, $product_name, $cod_qroup,
        $current_s_abi, $current_s_dem, $current_t_abi, $current_t_dem, $current_a_abi, $current_a_dem,
        $request_s_abi, $request_s_dem, $request_a_abi, $request_a_dem,
        $calculated_t_abi, $calculated_t_dem,
        $reason, $attachment_path,
        $created_by, $date_now
    ));
    
    if (!$result) {
        $errorInfo = $stmt->errorInfo();
        echo json_encode(array(
            'valid' => false,
            'message' => '⚠️ خطا در ذخیره‌سازی: ' . $errorInfo[2]
        ));
        exit;
    }
    
    $request_id = $dbh->lastInsertId();
    
    if ($request_id == 0) {
        echo json_encode(array(
            'valid' => false,
            'message' => '⚠️ رکورد در دیتابیس ذخیره نشد.'
        ));
        exit;
    }
    
    // ثبت رویداد
    if (function_exists('sabt_event')) {
        $status_text = 'ثبت درخواست تغییر الگوی کشت - محصول: ' . $product_name;
        sabt_event($login_session, getUserIP_1(), $date_now, date('H:i:s'), '', $status_text, $id_ostan);
    }
    
    echo json_encode(array(
        'valid' => true,
        'message' => '✅ درخواست شما با موفقیت ثبت شد.',
        'request_id' => $request_id,
        'changes' => $changes
    ));
    
} catch (PDOException $e) {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ خطای پایگاه‌داده: ' . $e->getMessage()
    ));
}
?>