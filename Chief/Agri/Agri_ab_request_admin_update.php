<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../../Jalali.php');
require_once('../../login/config.php');
date_default_timezone_set('Asia/Tehran');

header('Content-Type: application/json; charset=utf-8');

function clean_number($value) {
    if ($value === null || $value === '') return '0';
    $value = str_replace('٬', '', $value);
    $value = str_replace(',', '', $value);
    return $value;
}

// ============================================================
// بررسی درخواست
// ============================================================
if (!isset($_POST['action']) || $_POST['action'] != 'admin_update') {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ درخواست نامعتبر.'
    ));
    exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id == 0) {
    echo json_encode(array('valid' => false, 'message' => '⚠️ شناسه درخواست نامعتبر.'));
    exit;
}

// ============================================================
// دریافت اطلاعات فعلی درخواست
// ============================================================
$query = "SELECT * FROM Agri_ab_request WHERE id = ?";
$stmt = $dbh->prepare($query);
$stmt->execute(array($id));
$request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$request) {
    echo json_encode(array('valid' => false, 'message' => '⚠️ درخواست یافت نشد.'));
    exit;
}

// ============================================================
// بررسی قفل بودن (در صورت تأیید یا رد شده، اجازه ویرایش ندارد)
// ============================================================
if ($request['status'] == 'approved' || $request['status'] == 'rejected') {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ این درخواست قبلاً تأیید یا رد شده است و قابل ویرایش نیست.'
    ));
    exit;
}

// ============================================================
// دریافت وضعیت جدید
// ============================================================
$status = isset($_POST['status']) ? $_POST['status'] : 'pending';

// ============================================================
// اعتبارسنجی وضعیت
// ============================================================
$valid_statuses = array('pending', 'reviewing', 'approved', 'rejected');
if (!in_array($status, $valid_statuses)) {
    echo json_encode(array('valid' => false, 'message' => '⚠️ وضعیت نامعتبر.'));
    exit;
}

// ============================================================
// دریافت و پاکسازی داده‌ها
// ============================================================
// اگر وضعیت رد شده باشد، همه مقادیر admin را 0 قرار بده
if ($status == 'rejected') {
    $admin_s_abi = 0;
    $admin_s_dem = 0;
    $admin_a_abi = 0;
    $admin_a_dem = 0;
} else {
    // در غیر این صورت، اگر کاربر مقداری وارد کرده باشد همان را بگیر، در غیر این صورت از درخواستی کپی کن
    $admin_s_abi = (isset($_POST['admin_s_abi']) && $_POST['admin_s_abi'] !== '' && $_POST['admin_s_abi'] !== null)
        ? floatval(clean_number($_POST['admin_s_abi'])) 
        : floatval($request['request_s_abi']);

    $admin_s_dem = (isset($_POST['admin_s_dem']) && $_POST['admin_s_dem'] !== '' && $_POST['admin_s_dem'] !== null)
        ? floatval(clean_number($_POST['admin_s_dem'])) 
        : floatval($request['request_s_dem']);

    $admin_a_abi = (isset($_POST['admin_a_abi']) && $_POST['admin_a_abi'] !== '' && $_POST['admin_a_abi'] !== null)
        ? floatval(clean_number($_POST['admin_a_abi'])) 
        : floatval($request['request_a_abi']);

    $admin_a_dem = (isset($_POST['admin_a_dem']) && $_POST['admin_a_dem'] !== '' && $_POST['admin_a_dem'] !== null)
        ? floatval(clean_number($_POST['admin_a_dem'])) 
        : floatval($request['request_a_dem']);
}

$admin_note = isset($_POST['admin_note']) ? trim($_POST['admin_note']) : '';

// ============================================================
// ✅ کنترل مجدد در لحظه تأیید (فقط برای وضعیت approved)
// ============================================================
if ($status == 'approved') {
    
    // دریافت id_city از session
    $id_city = isset($_SESSION['id_city']) ? $_SESSION['id_city'] : null;
    
    if (!empty($id_city)) {
        
        // ============================================================
        // ۱. کنترل کاهش سطح آبی (بر اساس مقدار admin_s_abi)
        // ============================================================
        // الف) برش شهرستانی (سطح نباید از مجموع مراکز کمتر شود)
        $query_centers = "SELECT COALESCE(SUM(s_abi), 0) FROM Agri_ab_mar 
                           WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($request['z_sal'], $request['id_ostan'], $id_city, $request['product_cod']));
        $centers_sum = floatval($stmt_centers->fetchColumn());
        
        if ($admin_s_abi < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح آبی تأیید شده (' . number_format($admin_s_abi) . ') از مجموع برش مراکز (' . number_format($centers_sum) . ') کمتر است. لطفاً مقدار را اصلاح کنید.'
            ));
            exit;
        }
        
        // ب) مجموع کشت کارشناسان (سطح نباید از مجموع کشت کارشناسان کمتر شود)
        $prod_table = 'Agri_prod' . str_replace('-', '_', $request['z_sal']);
        try {
            $query_expert = "SELECT COALESCE(SUM(zer_kesht_a) + SUM(zer_kesht_b), 0) 
                             FROM {$prod_table} 
                             WHERE cod_mah = ? AND id_ostan = ? AND id_city = ? AND no_kesh = '1'";
            $stmt_expert = $dbh->prepare($query_expert);
            $stmt_expert->execute(array($request['product_cod'], $request['id_ostan'], $id_city));
            $expert_sum = floatval($stmt_expert->fetchColumn());
        } catch (PDOException $e) {
            $expert_sum = 0;
        }
        
        if ($admin_s_abi < $expert_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح آبی تأیید شده (' . number_format($admin_s_abi) . ') از مجموع کشت کارشناسان (' . number_format($expert_sum) . ') کمتر است. لطفاً مقدار را اصلاح کنید.'
            ));
            exit;
        }
        
        // ============================================================
        // ۲. کنترل کاهش سطح دیم (بر اساس مقدار admin_s_dem)
        // ============================================================
        // الف) برش شهرستانی
        $query_centers = "SELECT COALESCE(SUM(s_dem), 0) FROM Agri_ab_mar 
                           WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($request['z_sal'], $request['id_ostan'], $id_city, $request['product_cod']));
        $centers_sum = floatval($stmt_centers->fetchColumn());
        
        if ($admin_s_dem < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح دیم تأیید شده (' . number_format($admin_s_dem) . ') از مجموع برش مراکز (' . number_format($centers_sum) . ') کمتر است. لطفاً مقدار را اصلاح کنید.'
            ));
            exit;
        }
        
        // ب) مجموع کشت کارشناسان
        $prod_table = 'Agri_prod' . str_replace('-', '_', $request['z_sal']);
        try {
            $query_expert = "SELECT COALESCE(SUM(zer_kesht_a) + SUM(zer_kesht_b), 0) 
                             FROM {$prod_table} 
                             WHERE cod_mah = ? AND id_ostan = ? AND id_city = ? AND no_kesh = '2'";
            $stmt_expert = $dbh->prepare($query_expert);
            $stmt_expert->execute(array($request['product_cod'], $request['id_ostan'], $id_city));
            $expert_sum = floatval($stmt_expert->fetchColumn());
        } catch (PDOException $e) {
            $expert_sum = 0;
        }
        
        if ($admin_s_dem < $expert_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح دیم تأیید شده (' . number_format($admin_s_dem) . ') از مجموع کشت کارشناسان (' . number_format($expert_sum) . ') کمتر است. لطفاً مقدار را اصلاح کنید.'
            ));
            exit;
        }
    }
}

// ============================================================
// ثبت تاریخ تأیید/رد
// ============================================================
$approved_at = null;
if ($status == 'approved' || $status == 'rejected') {
    $approved_at = jdate("Y/m/d");
} else {
    $approved_at = null;
}

// ============================================================
// به‌روزرسانی در دیتابیس
// ============================================================
$date_now = jdate("Y/m/d");

try {
    $query = "UPDATE Agri_ab_request SET
        admin_s_abi = ?,
        admin_s_dem = ?,
        admin_a_abi = ?,
        admin_a_dem = ?,
        admin_note = ?,
        status = ?,
        approved_at = ?,
        updated_at = ?
    WHERE id = ?";

    $stmt = $dbh->prepare($query);
    $result = $stmt->execute(array(
        $admin_s_abi,
        $admin_s_dem,
        $admin_a_abi,
        $admin_a_dem,
        $admin_note,
        $status,
        $approved_at,
        $date_now,
        $id
    ));

    if (!$result) {
        $errorInfo = $stmt->errorInfo();
        echo json_encode(array(
            'valid' => false,
            'message' => '⚠️ خطا در به‌روزرسانی: ' . $errorInfo[2]
        ));
        exit;
    }

    // ============================================================
    // ثبت رویداد
    // ============================================================
    if (function_exists('sabt_event')) {
        $status_text = 'مدیریت درخواست تغییر الگوی کشت - محصول: ' . $request['product_name'] . ' - وضعیت جدید: ' . $status;
        sabt_event($login_session, getUserIP_1(), $date_now, date('H:i:s'), '', $status_text, $request['id_ostan']);
    }

    $status_labels = array(
        'pending' => 'در انتظار تأیید',
        'reviewing' => 'در حال بررسی',
        'approved' => 'تأیید شده',
        'rejected' => 'رد شده'
    );

    echo json_encode(array(
        'valid' => true,
        'message' => '✅ درخواست با موفقیت به‌روزرسانی شد. وضعیت جدید: ' . $status_labels[$status]
    ));

} catch (PDOException $e) {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ خطای پایگاه‌داده: ' . $e->getMessage()
    ));
}
?>