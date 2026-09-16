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

// ============================================================
// بررسی درخواست
// ============================================================
if (!isset($_POST['action']) || $_POST['action'] != 'edit') {
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
$query = "SELECT * FROM Agri_ab_request WHERE id = ? AND id_ostan = ?";
$stmt = $dbh->prepare($query);
$stmt->execute(array($id, $id_ostan));
$request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$request) {
    echo json_encode(array('valid' => false, 'message' => '⚠️ درخواست یافت نشد.'));
    exit;
}

// بررسی وضعیت (فقط pending و reviewing قابل ویرایش هستند)
if ($request['status'] != 'pending' && $request['status'] != 'reviewing') {
    echo json_encode(array('valid' => false, 'message' => '⚠️ این درخواست قبلاً تأیید یا رد شده است و قابل ویرایش نیست.'));
    exit;
}

// ============================================================
// دریافت و پاکسازی داده‌های جدید
// ============================================================
$cod_qroup = isset($_POST['cod_qroup']) ? $_POST['cod_qroup'] : ''; // ✅ جدید
$reason = isset($_POST['reason']) ? trim($_POST['reason']) : '';

// مقادیر درخواستی جدید
$request_s_abi = floatval(clean_number(isset($_POST['request_s_abi']) ? $_POST['request_s_abi'] : 0));
$request_s_dem = floatval(clean_number(isset($_POST['request_s_dem']) ? $_POST['request_s_dem'] : 0));
$request_a_abi = floatval(clean_number(isset($_POST['request_a_abi']) ? $_POST['request_a_abi'] : 0));
$request_a_dem = floatval(clean_number(isset($_POST['request_a_dem']) ? $_POST['request_a_dem'] : 0));

// تولید محاسبه‌شده
$calculated_t_abi = floatval(clean_number(isset($_POST['calculated_t_abi']) ? $_POST['calculated_t_abi'] : 0));
$calculated_t_dem = floatval(clean_number(isset($_POST['calculated_t_dem']) ? $_POST['calculated_t_dem'] : 0));

// مقادیر فعلی (ابلاغی) - از دیتابیس
$current_s_abi = floatval($request['current_s_abi']);
$current_s_dem = floatval($request['current_s_dem']);
$current_a_abi = floatval($request['current_a_abi']);
$current_a_dem = floatval($request['current_a_dem']);

// ============================================================
// اعتبارسنجی
// ============================================================
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
// بررسی حداقل یک تغییر
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
// کنترل کاهش سطح (برش شهرستانی و مجموع کشت کارشناسان)
// ============================================================
$id_city = isset($_SESSION['id_city']) ? $_SESSION['id_city'] : null;

if (!empty($id_city)) {

    // ۱. کنترل کاهش سطح آبی
    if ($request_s_abi < $current_s_abi) {

        // الف) برش شهرستانی (سطح نباید از مجموع مراکز کمتر شود)
        $query_centers = "SELECT COALESCE(SUM(s_abi), 0) FROM Agri_ab_mar 
                           WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($request['z_sal'], $id_ostan, $id_city, $request['product_cod']));
        $centers_sum = floatval($stmt_centers->fetchColumn());

        if ($request_s_abi < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح آبی پیشنهادی (' . number_format($request_s_abi) . ') از مجموع برش مراکز (' . number_format($centers_sum) . ') کمتر است. ابتدا برش مراکز را اصلاح کنید.'
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
            $stmt_expert->execute(array($request['product_cod'], $id_ostan, $id_city));
            $expert_sum = floatval($stmt_expert->fetchColumn());
        } catch (PDOException $e) {
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

        // الف) برش شهرستانی
        $query_centers = "SELECT COALESCE(SUM(s_dem), 0) FROM Agri_ab_mar 
                           WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($request['z_sal'], $id_ostan, $id_city, $request['product_cod']));
        $centers_sum = floatval($stmt_centers->fetchColumn());

        if ($request_s_dem < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح دیم پیشنهادی (' . number_format($request_s_dem) . ') از مجموع برش مراکز (' . number_format($centers_sum) . ') کمتر است. ابتدا برش مراکز را اصلاح کنید.'
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
            $stmt_expert->execute(array($request['product_cod'], $id_ostan, $id_city));
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
// پردازش فایل پیوست
// ============================================================
$attachment_path = $request['attachment'];

// اگر کاربر درخواست حذف فایل کرده باشد
if (isset($_POST['remove_attachment']) && $_POST['remove_attachment'] == '1') {
    if (!empty($request['attachment']) && file_exists('../../' . $request['attachment'])) {
        unlink('../../' . $request['attachment']);
    }
    $attachment_path = null;
}

// اگر فایل جدید آپلود شده باشد
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
        // حذف فایل قبلی
        if (!empty($request['attachment']) && file_exists('../../' . $request['attachment'])) {
            unlink('../../' . $request['attachment']);
        }

        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/files/requests/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $new_filename = 'request_' . $id_ostan . '_' . $request['product_cod'] . '_' . date('Ymd_His') . '.' . $ext;
        $upload_path = $upload_dir . $new_filename;

        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $upload_path)) {
            $attachment_path = '/files/requests/' . $new_filename;
        }
    }
}

// ============================================================
// به‌روزرسانی در دیتابیس
// ============================================================
$date_now = jdate("Y/m/d");

try {
    $query = "UPDATE Agri_ab_request SET
        cod_qroup = ?,
        request_s_abi = ?,
        request_s_dem = ?,
        request_a_abi = ?,
        request_a_dem = ?,
        calculated_t_abi = ?,
        calculated_t_dem = ?,
        reason = ?,
        attachment = ?,
        updated_at = ?
    WHERE id = ? AND id_ostan = ?";

    $stmt = $dbh->prepare($query);
    $result = $stmt->execute(array(
        $cod_qroup,
        $request_s_abi,
        $request_s_dem,
        $request_a_abi,
        $request_a_dem,
        $calculated_t_abi,
        $calculated_t_dem,
        $reason,
        $attachment_path,
        $date_now,
        $id,
        $id_ostan
    ));

    if (!$result) {
        $errorInfo = $stmt->errorInfo();
        echo json_encode(array(
            'valid' => false,
            'message' => '⚠️ خطا در به‌روزرسانی: ' . $errorInfo[2]
        ));
        exit;
    }

    // ثبت رویداد
    if (function_exists('sabt_event')) {
        $status_text = 'ویرایش درخواست تغییر الگوی کشت - محصول: ' . $request['product_name'];
        sabt_event($login_session, getUserIP_1(), $date_now, date('H:i:s'), '', $status_text, $id_ostan);
    }

    echo json_encode(array(
        'valid' => true,
        'message' => '✅ درخواست با موفقیت ویرایش شد.',
        'changes' => $changes
    ));

} catch (PDOException $e) {
    echo json_encode(array(
        'valid' => false,
        'message' => '⚠️ خطای پایگاه‌داده: ' . $e->getMessage()
    ));
}
?>