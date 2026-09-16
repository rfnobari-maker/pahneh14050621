<?php
// =============================================
// تنظیمات جلسه - باید قبل از session_start() باشد
// =============================================
if (session_id() === '') {
    // تنظیم زمان انقضا
    ini_set('session.gc_maxlifetime', 7200);
    session_set_cookie_params(7200);
    session_start();
}

// =============================================
// مدیریت زمان انقضای جلسه (2 ساعت inactivity)
// =============================================
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 7200)) {
    session_unset();
    session_destroy();
    
    if (isset($dbh)) {
        $dbh = null;
    }
    
    header("Location: /login/login.php?message=timeout");
    exit();
}

// بروزرسانی زمان آخرین فعالیت
$_SESSION['last_activity'] = time();

// =============================================
// متغیرهای پایه
// =============================================
$actual_link = "https://{$_SERVER['HTTP_HOST']}";

// =============================================
// بارگذاری متغیرهای جلسه با روش بهینه‌تر
// =============================================
$title         = isset($_SESSION['title'])       ? $_SESSION['title']       : '';
$user_check    = isset($_SESSION['login_user'])  ? $_SESSION['login_user']  : '';
$karbar_m      = isset($_SESSION['karbar'])      ? $_SESSION['karbar']      : '';
$login_session = isset($_SESSION['username'])    ? $_SESSION['username']    : '';
$cod_m_session = isset($_SESSION['cod_m'])      ? $_SESSION['cod_m']      : '';
$PersName      = isset($_SESSION['PersName'])    ? $_SESSION['PersName']    : '';
$euser         = $PersName ?: '';
$ostan         = isset($_SESSION['ostan'])       ? $_SESSION['ostan']       : '';
$city          = isset($_SESSION['city'])        ? $_SESSION['city']        : '';
$id_ostan      = isset($_SESSION['id_ostan'])    ? $_SESSION['id_ostan']    : '';
$id_city       = isset($_SESSION['id_city'])     ? $_SESSION['id_city']     : '';
$markaz        = isset($_SESSION['markaz'])      ? $_SESSION['markaz']      : '';
$id_mar        = isset($_SESSION['id_mar'])      ? $_SESSION['id_mar']      : '';
$name          = isset($_SESSION['name'])        ? $_SESSION['name']        : '';
$v_jen         = isset($_SESSION['v_jen'])       ? $_SESSION['v_jen']       : '';
$pic           = isset($_SESSION['pic'])         ? $_SESSION['pic']         : '';
$no_karbar     = isset($_SESSION['no_karbar'])   ? $_SESSION['no_karbar']   : '';
$date_pas      = isset($_SESSION['date_pas'])    ? $_SESSION['date_pas']    : '';

// =============================================
// بررسی احراز هویت
// =============================================
if (!isset($login_session) || $karbar_m != '1') {
    if (isset($_SESSION)) {
        session_destroy();
    }
    if (isset($dbh)) {
        $dbh = null;
    }
    header("Location: {$actual_link}/login/login.php");
    exit();
}
?>