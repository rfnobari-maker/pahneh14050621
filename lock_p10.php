<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  lang="en-US" xml:lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
// --- منطق PHP موجود (مدیریت نشست و احراز هویت) ---

if (session_id() == '')  session_start();

// تنظیم زمان انقضای جلسه به 1 ساعت (3600 ثانیه)
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);

// بررسی اینکه آیا جلسه فعال است
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 3600) {
    session_unset();
    session_destroy();
    if (isset($dbh)) $dbh = null;
    header("Location: /login/login.php?message=timeout");
    exit();
} else {
    $_SESSION['last_activity'] = time();
}

$actual_link = "https://$_SERVER[HTTP_HOST]";
if (isset($_SESSION['title'])) $title = $_SESSION['title'];
if (isset($_SESSION['login_user'])) $user_check = $_SESSION['login_user'];
if (isset($_SESSION['karbar'])) $karbar_m = $_SESSION['karbar'];
if (isset($_SESSION['username'])) $login_session = $_SESSION['username'];
if (isset($_SESSION['cod_m'])) $cod_m_session = $_SESSION['cod_m'];
if (isset($_SESSION['PersName'])) $PersName = $_SESSION['PersName'];
if (isset($PersName)) $euser = $PersName;
if (isset($_SESSION['ostan'])) $ostan = $_SESSION['ostan'];
if (isset($_SESSION['city'])) $city = $_SESSION['city'];
if (isset($_SESSION['id_ostan'])) $id_ostan = $_SESSION['id_ostan'];
if (isset($_SESSION['id_city'])) $id_city = $_SESSION['id_city'];
if (isset($_SESSION['markaz'])) $markaz = $_SESSION['markaz'];
if (isset($_SESSION['id_mar'])) $id_mar = $_SESSION['id_mar'];
if (isset($_SESSION['name'])) $name = $_SESSION['name'];
if (isset($_SESSION['v_jen'])) { $v_jen = $_SESSION['v_jen']; } else {  $v_jen = ''; }
if (isset($_SESSION['pic'])) $pic = $_SESSION['pic'];
if (isset($_SESSION['no_karbar'])) $no_karbar = $_SESSION['no_karbar'];
if (isset($_SESSION['date_pas'])) $date_pas = $_SESSION['date_pas'];

if (!isset($login_session) || $karbar_m != '1') {
    if (isset($_SESSION)) session_destroy();
    if (isset($dbh)) $dbh = null;
    header("Location: {$actual_link}/login/login.php");
    exit();
}

?>