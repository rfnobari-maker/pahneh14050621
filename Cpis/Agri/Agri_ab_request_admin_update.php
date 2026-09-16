<?php
require_once("../../lock_cp.php");
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
// ✅ کنترل‌های اعتباری در لحظه تأیید (فقط برای وضعیت approved)
// درخواست در سطح استان است؛ جمع برش همه شهرستان‌های همان استان ملاک است.
// (کاربر Cpis معمولاً id_city در session ندارد؛ نباید کنترل‌ها به‌خاطر آن رد شوند.)
// ============================================================
if ($status == 'approved') {

    $z_sal = $request['z_sal'];
    $id_ostan = $request['id_ostan'];
    $product_cod = $request['product_cod'];
    $prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
    $current_s_abi = floatval($request['current_s_abi']);
    $current_s_dem = floatval($request['current_s_dem']);
    $current_a_abi = floatval($request['current_a_abi']);
    $current_a_dem = floatval($request['current_a_dem']);

    // ============================================================
    // ۱. کنترل کاهش سطح آبی (فقط اگر مقدار تأیید از ابلاغی فعلی کمتر باشد)
    // ============================================================
    if ($admin_s_abi < $current_s_abi) {

        // الف) برش شهرستان‌ها (جدول Agri_ab_city) — جمع همه شهرستان‌های استان
        $query_city = "SELECT COALESCE(SUM(s_abi), 0) FROM Agri_ab_city
                       WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $stmt_city = $dbh->prepare($query_city);
        $stmt_city->execute(array($z_sal, $id_ostan, $product_cod));
        $city_sum = floatval($stmt_city->fetchColumn());

        if ($admin_s_abi < $city_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح آبی تأیید شده (' . number_format($admin_s_abi) . ') از مجموع برش شهرستان‌ها (' . number_format($city_sum) . ') کمتر است. ابتدا برش شهرستان‌ها را اصلاح کنید.'
            ));
            exit;
        }

        // ب) برش مراکز (جدول Agri_ab_mar) — جمع همه مراکز استان
        $query_centers = "SELECT COALESCE(SUM(s_abi), 0) FROM Agri_ab_mar
                           WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($z_sal, $id_ostan, $product_cod));
        $centers_sum = floatval($stmt_centers->fetchColumn());

        if ($admin_s_abi < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح آبی تأیید شده (' . number_format($admin_s_abi) . ') از مجموع برش مراکز (' . number_format($centers_sum) . ') کمتر است. ابتدا برش مراکز را اصلاح کنید.'
            ));
            exit;
        }

        // ج) مجموع کشت کارشناسان (جدول Agri_prod)
        try {
            $query_expert = "SELECT COALESCE(SUM(zer_kesht_a) + SUM(zer_kesht_b), 0)
                             FROM {$prod_table}
                             WHERE cod_mah = ? AND id_ostan = ? AND no_kesh = '1'";
            $stmt_expert = $dbh->prepare($query_expert);
            $stmt_expert->execute(array($product_cod, $id_ostan));
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
    }

    // ============================================================
    // ۲. کنترل کاهش سطح دیم
    // ============================================================
    if ($admin_s_dem < $current_s_dem) {

        // الف) برش شهرستان‌ها (جدول Agri_ab_city)
        $query_city = "SELECT COALESCE(SUM(s_dem), 0) FROM Agri_ab_city
                       WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $stmt_city = $dbh->prepare($query_city);
        $stmt_city->execute(array($z_sal, $id_ostan, $product_cod));
        $city_sum = floatval($stmt_city->fetchColumn());

        if ($admin_s_dem < $city_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح دیم تأیید شده (' . number_format($admin_s_dem) . ') از مجموع برش شهرستان‌ها (' . number_format($city_sum) . ') کمتر است. ابتدا برش شهرستان‌ها را اصلاح کنید.'
            ));
            exit;
        }

        // ب) برش مراکز (جدول Agri_ab_mar)
        $query_centers = "SELECT COALESCE(SUM(s_dem), 0) FROM Agri_ab_mar
                           WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($z_sal, $id_ostan, $product_cod));
        $centers_sum = floatval($stmt_centers->fetchColumn());

        if ($admin_s_dem < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح دیم تأیید شده (' . number_format($admin_s_dem) . ') از مجموع برش مراکز (' . number_format($centers_sum) . ') کمتر است. ابتدا برش مراکز را اصلاح کنید.'
            ));
            exit;
        }

        // ج) مجموع کشت کارشناسان (جدول Agri_prod)
        try {
            $query_expert = "SELECT COALESCE(SUM(zer_kesht_a) + SUM(zer_kesht_b), 0)
                             FROM {$prod_table}
                             WHERE cod_mah = ? AND id_ostan = ? AND no_kesh = '2'";
            $stmt_expert = $dbh->prepare($query_expert);
            $stmt_expert->execute(array($product_cod, $id_ostan));
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

    // ============================================================
    // ۳. کنترل کاهش عملکرد آبی
    // ============================================================
    if ($admin_a_abi < $current_a_abi) {

        // الف) برش شهرستان‌ها (جدول Agri_ab_city)
        $query_city = "SELECT COALESCE(SUM(a_abi), 0) FROM Agri_ab_city
                       WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $stmt_city = $dbh->prepare($query_city);
        $stmt_city->execute(array($z_sal, $id_ostan, $product_cod));
        $city_sum = floatval($stmt_city->fetchColumn());

        if ($admin_a_abi < $city_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ عملکرد آبی تأیید شده (' . number_format($admin_a_abi, 2) . ') از مجموع برش شهرستان‌ها (' . number_format($city_sum, 2) . ') کمتر است. ابتدا برش شهرستان‌ها را اصلاح کنید.'
            ));
            exit;
        }

        // ب) برش مراکز (جدول Agri_ab_mar)
        $query_centers = "SELECT COALESCE(SUM(a_abi), 0) FROM Agri_ab_mar
                           WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($z_sal, $id_ostan, $product_cod));
        $centers_sum = floatval($stmt_centers->fetchColumn());

        if ($admin_a_abi < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ عملکرد آبی تأیید شده (' . number_format($admin_a_abi, 2) . ') از مجموع برش مراکز (' . number_format($centers_sum, 2) . ') کمتر است. ابتدا برش مراکز را اصلاح کنید.'
            ));
            exit;
        }
    }

    // ============================================================
    // ۴. کنترل کاهش عملکرد دیم
    // ============================================================
    if ($admin_a_dem < $current_a_dem) {

        // الف) برش شهرستان‌ها (جدول Agri_ab_city)
        $query_city = "SELECT COALESCE(SUM(a_dem), 0) FROM Agri_ab_city
                       WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $stmt_city = $dbh->prepare($query_city);
        $stmt_city->execute(array($z_sal, $id_ostan, $product_cod));
        $city_sum = floatval($stmt_city->fetchColumn());

        if ($admin_a_dem < $city_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ عملکرد دیم تأیید شده (' . number_format($admin_a_dem, 2) . ') از مجموع برش شهرستان‌ها (' . number_format($city_sum, 2) . ') کمتر است. ابتدا برش شهرستان‌ها را اصلاح کنید.'
            ));
            exit;
        }

        // ب) برش مراکز (جدول Agri_ab_mar)
        $query_centers = "SELECT COALESCE(SUM(a_dem), 0) FROM Agri_ab_mar
                           WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($z_sal, $id_ostan, $product_cod));
        $centers_sum = floatval($stmt_centers->fetchColumn());

        if ($admin_a_dem < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ عملکرد دیم تأیید شده (' . number_format($admin_a_dem, 2) . ') از مجموع برش مراکز (' . number_format($centers_sum, 2) . ') کمتر است. ابتدا برش مراکز را اصلاح کنید.'
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
// به‌روزرسانی در دیتابیس (Agri_ab_request)
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
    // ✅ جایگزینی در جدول اصلی Agri_ab_ostan (فقط در صورت تأیید)
    // ============================================================
    if ($status == 'approved') {
        
        // دریافت اطلاعات گروه و نام محصول از جدول product_z
        $query_prod = "SELECT group_cod, group_name, product_name FROM product_z WHERE product_cod = ? LIMIT 1";
        $stmt_prod = $dbh->prepare($query_prod);
        $stmt_prod->execute(array($request['product_cod']));
        $product_info = $stmt_prod->fetch(PDO::FETCH_ASSOC);
        
        $group_cod = $product_info['group_cod'] ? $product_info['group_cod'] : '';
        $group_name = $product_info['group_name'] ? $product_info['group_name'] : '';
        $product_name = $product_info['product_name'] ? $product_info['product_name'] : $request['product_name'];
        
        // محاسبه تولید
        $t_abi = ($admin_s_abi * $admin_a_abi) / 1000;
        $t_dem = ($admin_s_dem * $admin_a_dem) / 1000;
        
        // بررسی وجود رکورد در Agri_ab_ostan
        $query_check = "SELECT id FROM Agri_ab_ostan 
                        WHERE id_ostan = ? AND z_sal = ? AND product_cod = ?";

        $stmt_check = $dbh->prepare($query_check);
        $stmt_check->execute(array($request['id_ostan'], $request['z_sal'], $request['product_cod']));
        $exists = $stmt_check->fetchColumn();
        
        if ($exists) {
            // به‌روزرسانی رکورد موجود
            $query_update_ostan = "UPDATE Agri_ab_ostan SET
                s_abi = ?,
                s_dem = ?,
                a_abi = ?,
                a_dem = ?,
                t_abi = ?,
                t_dem = ?,
                date_s = ?
            WHERE id_ostan = ? AND z_sal = ? AND product_cod = ?";
            
            $stmt_update_ostan = $dbh->prepare($query_update_ostan);
            $result_ostan = $stmt_update_ostan->execute(array(
                $admin_s_abi,
                $admin_s_dem,
                $admin_a_abi,
                $admin_a_dem,
                $t_abi,
                $t_dem,
                $date_now,
                $request['id_ostan'],
                $request['z_sal'],
                $request['product_cod']
            ));
            
            if (!$result_ostan) {
                $errorInfo = $stmt_update_ostan->errorInfo();
                echo json_encode(array(
                    'valid' => false,
                    'message' => '⚠️ خطا در به‌روزرسانی جدول اصلی: ' . $errorInfo[2]
                ));
                exit;
            }
            
        } else {
            // درج رکورد جدید
            $query_insert_ostan = "INSERT INTO Agri_ab_ostan (
                id_ostan, z_sal, group_cod, group_name, 
                product_cod, product_name, s_abi, s_dem, 
                a_abi, a_dem, t_abi, t_dem, date_s
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt_insert_ostan = $dbh->prepare($query_insert_ostan);
            $result_ostan = $stmt_insert_ostan->execute(array(
                $request['id_ostan'],
                $request['z_sal'],
                $group_cod,
                $group_name,
                $request['product_cod'],
                $product_name,
                $admin_s_abi,
                $admin_s_dem,
                $admin_a_abi,
                $admin_a_dem,
                $t_abi,
                $t_dem,
                $date_now
            ));
            
            if (!$result_ostan) {
                $errorInfo = $stmt_insert_ostan->errorInfo();
                echo json_encode(array(
                    'valid' => false,
                    'message' => '⚠️ خطا در درج در جدول اصلی: ' . $errorInfo[2]
                ));
                exit;
            }
        }
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
        'approved' => 'تأیید/تعدیل شده',
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