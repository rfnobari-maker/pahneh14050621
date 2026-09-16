<?php
include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id == 0) {
    echo '<script>alert("⚠️ شناسه درخواست نامعتبر."); window.location.href="Garden_ab_request_list.php";</script>';
    exit;
}

// دریافت اطلاعات درخواست
$query = "SELECT * FROM Garden_ab_request WHERE id = ? AND id_ostan = ?";
$stmt = $dbh->prepare($query);
$stmt->execute(array($id, $id_ostan));
$request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$request) {
    echo '<script>alert("⚠️ درخواست یافت نشد."); window.location.href="Garden_ab_request_list.php";</script>';
    exit;
}

// بررسی وضعیت (فقط pending و reviewing قابل حذف هستند)
if ($request['status'] != 'pending' && $request['status'] != 'reviewing') {
    echo '<script>alert("⚠️ این درخواست قبلاً تأیید یا رد شده است و قابل حذف نیست."); window.location.href="Garden_ab_request_detail.php";</script>';
    exit;
}

// ============================================================
// حذف فایل پیوست (اگر وجود دارد)
// ============================================================
if (!empty($request['attachment']) && file_exists('../../' . $request['attachment'])) {
    unlink('../../' . $request['attachment']);
}

// ============================================================
// حذف از دیتابیس
// ============================================================
try {
    $query = "DELETE FROM Garden_ab_request WHERE id = ? AND id_ostan = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($id, $id_ostan));
    $count = $stmt->rowCount();
    
    if ($count > 0) {
        // ثبت رویداد
        if (function_exists('sabt_event')) {
            $status_text = 'حذف درخواست تغییر الگوی کشت باغی - محصول: ' . $request['product_name'];
            sabt_event($login_session, getUserIP_1(), jdate("Y/m/d"), date('H:i:s'), '', $status_text, $id_ostan);
        }
        
        echo '<script>alert("✅ درخواست با موفقیت حذف شد."); window.location.href="Garden_ab_request_list.php";</script>';
        exit;
    } else {
        echo '<script>alert("⚠️ خطا در حذف درخواست."); window.location.href="Garden_ab_request_detail.php?id=' . $id . '";</script>';
        exit;
    }
    
} catch (PDOException $e) {
    echo '<script>alert("⚠️ خطای پایگاه‌داده: ' . $e->getMessage() . '"); window.location.href="Garden_ab_request_detail.php?id=' . $id . '";</script>';
    exit;
}
?>