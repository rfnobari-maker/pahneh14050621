<?php
session_start();
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
$query = "SELECT * FROM Garden_ab_request WHERE id = ?";
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
// دریافت و پاکسازی داده‌ها - بر اساس توافق نهایی
// ============================================================
if ($status == 'rejected') {
    // ============================================================
    // حالت ۱: رد درخواست - تمام مقادیر admin را 0 قرار بده
    // ============================================================
    $admin_s_nobar_abi = 0;
    $admin_s_nobar_dem = 0;
    $admin_s_bar_abi = 0;
    $admin_s_bar_dem = 0;
    $admin_a_abi = 0;
    $admin_a_dem = 0;
} elseif ($status == 'reviewing') {
    // ============================================================
    // حالت ۲: در حال بررسی
    // اگر قبلاً در وضعیت reviewing نبوده، کپی کن
    // در غیر این صورت، تغییرات مدیر را حفظ کن
    // ============================================================
    if ($request['status'] != 'reviewing') {
        // اولین باری است که به reviewing می‌رود → کپی از request
        $admin_s_nobar_abi = floatval($request['request_s_nobar_abi']);
        $admin_s_nobar_dem = floatval($request['request_s_nobar_dem']);
        $admin_s_bar_abi = floatval($request['request_s_bar_abi']);
        $admin_s_bar_dem = floatval($request['request_s_bar_dem']);
        $admin_a_abi = floatval($request['request_a_abi']);
        $admin_a_dem = floatval($request['request_a_dem']);
    } else {
        // قبلاً در وضعیت reviewing بوده → تغییرات مدیر را حفظ کن
        // سطح غیر بارور آبی
        if (isset($_POST['admin_s_nobar_abi']) && $_POST['admin_s_nobar_abi'] !== '' && $_POST['admin_s_nobar_abi'] !== null) {
            $admin_s_nobar_abi = floatval(clean_number($_POST['admin_s_nobar_abi']));
        } else {
            $admin_s_nobar_abi = floatval($request['admin_s_nobar_abi']);
        }

        // سطح غیر بارور دیم
        if (isset($_POST['admin_s_nobar_dem']) && $_POST['admin_s_nobar_dem'] !== '' && $_POST['admin_s_nobar_dem'] !== null) {
            $admin_s_nobar_dem = floatval(clean_number($_POST['admin_s_nobar_dem']));
        } else {
            $admin_s_nobar_dem = floatval($request['admin_s_nobar_dem']);
        }

        // سطح بارور آبی
        if (isset($_POST['admin_s_bar_abi']) && $_POST['admin_s_bar_abi'] !== '' && $_POST['admin_s_bar_abi'] !== null) {
            $admin_s_bar_abi = floatval(clean_number($_POST['admin_s_bar_abi']));
        } else {
            $admin_s_bar_abi = floatval($request['admin_s_bar_abi']);
        }

        // سطح بارور دیم
        if (isset($_POST['admin_s_bar_dem']) && $_POST['admin_s_bar_dem'] !== '' && $_POST['admin_s_bar_dem'] !== null) {
            $admin_s_bar_dem = floatval(clean_number($_POST['admin_s_bar_dem']));
        } else {
            $admin_s_bar_dem = floatval($request['admin_s_bar_dem']);
        }

        // عملکرد آبی
        if (isset($_POST['admin_a_abi']) && $_POST['admin_a_abi'] !== '' && $_POST['admin_a_abi'] !== null) {
            $admin_a_abi = floatval(clean_number($_POST['admin_a_abi']));
        } else {
            $admin_a_abi = floatval($request['admin_a_abi']);
        }

        // عملکرد دیم
        if (isset($_POST['admin_a_dem']) && $_POST['admin_a_dem'] !== '' && $_POST['admin_a_dem'] !== null) {
            $admin_a_dem = floatval(clean_number($_POST['admin_a_dem']));
        } else {
            $admin_a_dem = floatval($request['admin_a_dem']);
        }
    }
} elseif ($status == 'approved') {
    // ============================================================
    // حالت ۳: تأیید (با یا بدون تغییر)
    // اگر کاربر مقداری وارد کرده باشد = همان مقدار
    // اگر کاربر مقداری وارد نکرده باشد = کپی از درخواستی
    // ============================================================
    
    // سطح غیر بارور آبی
    if (isset($_POST['admin_s_nobar_abi']) && $_POST['admin_s_nobar_abi'] !== '' && $_POST['admin_s_nobar_abi'] !== null) {
        $admin_s_nobar_abi = floatval(clean_number($_POST['admin_s_nobar_abi']));
    } else {
        $admin_s_nobar_abi = floatval($request['request_s_nobar_abi']);
    }

    // سطح غیر بارور دیم
    if (isset($_POST['admin_s_nobar_dem']) && $_POST['admin_s_nobar_dem'] !== '' && $_POST['admin_s_nobar_dem'] !== null) {
        $admin_s_nobar_dem = floatval(clean_number($_POST['admin_s_nobar_dem']));
    } else {
        $admin_s_nobar_dem = floatval($request['request_s_nobar_dem']);
    }

    // سطح بارور آبی
    if (isset($_POST['admin_s_bar_abi']) && $_POST['admin_s_bar_abi'] !== '' && $_POST['admin_s_bar_abi'] !== null) {
        $admin_s_bar_abi = floatval(clean_number($_POST['admin_s_bar_abi']));
    } else {
        $admin_s_bar_abi = floatval($request['request_s_bar_abi']);
    }

    // سطح بارور دیم
    if (isset($_POST['admin_s_bar_dem']) && $_POST['admin_s_bar_dem'] !== '' && $_POST['admin_s_bar_dem'] !== null) {
        $admin_s_bar_dem = floatval(clean_number($_POST['admin_s_bar_dem']));
    } else {
        $admin_s_bar_dem = floatval($request['request_s_bar_dem']);
    }

    // عملکرد آبی
    if (isset($_POST['admin_a_abi']) && $_POST['admin_a_abi'] !== '' && $_POST['admin_a_abi'] !== null) {
        $admin_a_abi = floatval(clean_number($_POST['admin_a_abi']));
    } else {
        $admin_a_abi = floatval($request['request_a_abi']);
    }

    // عملکرد دیم
    if (isset($_POST['admin_a_dem']) && $_POST['admin_a_dem'] !== '' && $_POST['admin_a_dem'] !== null) {
        $admin_a_dem = floatval(clean_number($_POST['admin_a_dem']));
    } else {
        $admin_a_dem = floatval($request['request_a_dem']);
    }
} else {
    // ============================================================
    // حالت ۴: در انتظار تأیید (pending) - تغییری در مقادیر admin اعمال نمی‌شود
    // ============================================================
    $admin_s_nobar_abi = floatval($request['admin_s_nobar_abi']);
    $admin_s_nobar_dem = floatval($request['admin_s_nobar_dem']);
    $admin_s_bar_abi = floatval($request['admin_s_bar_abi']);
    $admin_s_bar_dem = floatval($request['admin_s_bar_dem']);
    $admin_a_abi = floatval($request['admin_a_abi']);
    $admin_a_dem = floatval($request['admin_a_dem']);
}

// ============================================================
// ✅ کنترل سطح در همه حالت‌ها به جز رد (rejected)
// بدون توجه به افزایش یا کاهش بودن مقدار admin نسبت به current
// ============================================================
if ($status != 'rejected') {
    
    // دریافت id_city از session
    $id_city = isset($_SESSION['id_city']) ? $_SESSION['id_city'] : null;
    
    if (!empty($id_city)) {
        $z_sal = $request['z_sal'];
        $id_ostan = $request['id_ostan'];
        $product_cod = $request['product_cod'];
        
        // ============================================================
        // ۱. کنترل سطح غیر بارور آبی
        // ============================================================
        // الف) برش شهرستانی
        $query_centers = "SELECT COALESCE(SUM(s_nobar_abi), 0) FROM Garden_ab_mar 
                           WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
        $centers_sum = floatval($stmt_centers->fetchColumn());
        
        if ($admin_s_nobar_abi < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح غیر بارور آبی (' . number_format($admin_s_nobar_abi, 1) . ') از مجموع برش مراکز (' . number_format($centers_sum, 1) . ') کمتر است. لطفاً درخواست را بررسی کنید.'
            ));
            exit;
        }
        
        // ب) مجموع کشت کارشناسان
        $query_expert = "SELECT COALESCE(SUM(s_kesht_gb), 0) 
                         FROM Garden_prod 
                         WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ? AND no_kesh = '1'";
        $stmt_expert = $dbh->prepare($query_expert);
        $stmt_expert->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
        $expert_sum = floatval($stmt_expert->fetchColumn());
        
        if ($admin_s_nobar_abi < $expert_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح غیر بارور آبی (' . number_format($admin_s_nobar_abi, 1) . ') از مجموع کشت کارشناسان (' . number_format($expert_sum, 1) . ') کمتر است. لطفاً درخواست را بررسی کنید.'
            ));
            exit;
        }
        
        // ============================================================
        // ۲. کنترل سطح غیر بارور دیم
        // ============================================================
        // الف) برش شهرستانی
        $query_centers = "SELECT COALESCE(SUM(s_nobar_dem), 0) FROM Garden_ab_mar 
                           WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
        $centers_sum = floatval($stmt_centers->fetchColumn());
        
        if ($admin_s_nobar_dem < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح غیر بارور دیم (' . number_format($admin_s_nobar_dem, 1) . ') از مجموع برش مراکز (' . number_format($centers_sum, 1) . ') کمتر است. لطفاً درخواست را بررسی کنید.'
            ));
            exit;
        }
        
        // ب) مجموع کشت کارشناسان
        $query_expert = "SELECT COALESCE(SUM(s_kesht_gb), 0) 
                         FROM Garden_prod 
                         WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ? AND no_kesh = '2'";
        $stmt_expert = $dbh->prepare($query_expert);
        $stmt_expert->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
        $expert_sum = floatval($stmt_expert->fetchColumn());
        
        if ($admin_s_nobar_dem < $expert_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح غیر بارور دیم (' . number_format($admin_s_nobar_dem, 1) . ') از مجموع کشت کارشناسان (' . number_format($expert_sum, 1) . ') کمتر است. لطفاً درخواست را بررسی کنید.'
            ));
            exit;
        }
        
        // ============================================================
        // ۳. کنترل سطح بارور آبی
        // ============================================================
        // الف) برش شهرستانی
        $query_centers = "SELECT COALESCE(SUM(s_bar_abi), 0) FROM Garden_ab_mar 
                           WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
        $centers_sum = floatval($stmt_centers->fetchColumn());
        
        if ($admin_s_bar_abi < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح بارور آبی (' . number_format($admin_s_bar_abi, 1) . ') از مجموع برش مراکز (' . number_format($centers_sum, 1) . ') کمتر است. لطفاً درخواست را بررسی کنید.'
            ));
            exit;
        }
        
        // ب) مجموع کشت کارشناسان
        $query_expert = "SELECT COALESCE(SUM(s_kesht_b), 0) 
                         FROM Garden_prod 
                         WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ? AND no_kesh = '1'";
        $stmt_expert = $dbh->prepare($query_expert);
        $stmt_expert->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
        $expert_sum = floatval($stmt_expert->fetchColumn());
        
        if ($admin_s_bar_abi < $expert_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح بارور آبی (' . number_format($admin_s_bar_abi, 1) . ') از مجموع کشت کارشناسان (' . number_format($expert_sum, 1) . ') کمتر است. لطفاً درخواست را بررسی کنید.'
            ));
            exit;
        }
        
        // ============================================================
        // ۴. کنترل سطح بارور دیم
        // ============================================================
        // الف) برش شهرستانی
        $query_centers = "SELECT COALESCE(SUM(s_bar_dem), 0) FROM Garden_ab_mar 
                           WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
        $stmt_centers = $dbh->prepare($query_centers);
        $stmt_centers->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
        $centers_sum = floatval($stmt_centers->fetchColumn());
        
        if ($admin_s_bar_dem < $centers_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح بارور دیم (' . number_format($admin_s_bar_dem, 1) . ') از مجموع برش مراکز (' . number_format($centers_sum, 1) . ') کمتر است. لطفاً درخواست را بررسی کنید.'
            ));
            exit;
        }
        
        // ب) مجموع کشت کارشناسان
        $query_expert = "SELECT COALESCE(SUM(s_kesht_b), 0) 
                         FROM Garden_prod 
                         WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ? AND no_kesh = '2'";
        $stmt_expert = $dbh->prepare($query_expert);
        $stmt_expert->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
        $expert_sum = floatval($stmt_expert->fetchColumn());
        
        if ($admin_s_bar_dem < $expert_sum) {
            echo json_encode(array(
                'valid' => false,
                'message' => '❌ سطح بارور دیم (' . number_format($admin_s_bar_dem, 1) . ') از مجموع کشت کارشناسان (' . number_format($expert_sum, 1) . ') کمتر است. لطفاً درخواست را بررسی کنید.'
            ));
            exit;
        }
    }
}

$admin_note = isset($_POST['admin_note']) ? trim($_POST['admin_note']) : '';

// ============================================================
// ثبت تاریخ تأیید/رد
// ============================================================
$approved_at = null;
if ($status == 'approved' || $status == 'rejected') {
    $approved_at = jdate("Y/m/d");
}

// ============================================================
// به‌روزرسانی در دیتابیس
// ============================================================
$date_now = jdate("Y/m/d");

try {
    $query = "UPDATE Garden_ab_request SET
        admin_s_nobar_abi = ?,
        admin_s_nobar_dem = ?,
        admin_s_bar_abi = ?,
        admin_s_bar_dem = ?,
        admin_a_abi = ?,
        admin_a_dem = ?,
        admin_note = ?,
        status = ?,
        approved_at = ?,
        updated_at = ?
    WHERE id = ?";

    $stmt = $dbh->prepare($query);
    $result = $stmt->execute(array(
        $admin_s_nobar_abi,
        $admin_s_nobar_dem,
        $admin_s_bar_abi,
        $admin_s_bar_dem,
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
        $status_text = 'مدیریت درخواست تغییر الگوی کشت باغی - محصول: ' . $request['product_name'] . ' - وضعیت جدید: ' . $status;
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