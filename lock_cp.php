<?php
session_start();
$title = 'سامانه اجرای الگوی کشت' ; 
$dbh = null;
include('login/config.php');
require_once dirname(__FILE__) . '/login/sys_access.php';
$user_check = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : '';
$karbar_m = isset($_SESSION['karbar']) ? $_SESSION['karbar'] : '';
$actual_link = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

if( isset($_SESSION['last_acted_on']) && (time() - $_SESSION['last_acted_on'] > 60*15) ){
    $_SESSION = array();
    session_destroy();
     header("Location:$actual_link/login/cpis.php");
     exit;
}else{
    $_SESSION['last_acted_on'] = time();
}
$row = pahneh_sys_fetch_user($dbh, $user_check);
if (!$row || !pahneh_sys_can($row, 'cpis')) {
    header("Location:$actual_link/login/cpis.php");
    exit;
}
$login_session=$row['username'];
 $PersName = $row['Last_name'];
$euser = $PersName ; 
$ostan = $row['ostan'];
//$city = $row['city'];
//$markaz = $row['markaz'];
$name = $row['name'];
$id_ostan = $row['id_ostan'];
$pic = $row['pic'];
$jens = $row['jens'];
$perm = $row['perm'];
$date_pas = $row['date_pas'];
if ($jens == 'مرد')  $v_jen = 'آقای' ; 
if ($jens == 'زن')  $v_jen = 'خانم';
if ($pic=='') $pic = 'no_pic.png' ; 
$dbh = null;
?>