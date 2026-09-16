<?php
if (session_id() == '') {
    session_start();
}
$title = 'سامانه جامع پهنه بندی و مدیریت داده های کشاورزی' ; 
include('login/config.php');
$user_check=$_SESSION['login_user'];
$karbar_m = $_SESSION['karbar'] ;
$actual_link = "http://$_SERVER[HTTP_HOST]";
//
if( isset($_SESSION["last_acted_on"]) && (time() - $_SESSION["last_acted_on"] > 60*15) ){
    $_SESSION = array();
    session_destroy();
header("Location:".$actual_link."/login/login.php");
}else{
    $_SESSION["last_acted_on"] = time();
}
//
$query = "SELECT * from users  WHERE username='".$user_check."' and S_access='98' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
// $row تک خطی 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$login_session=$row['username'];
$PersName = $row['Last_name'];
$euser = $PersName ; 
$ostan = $row['ostan'];
$id_ostan = $row['id_ostan'];
$city = $row['city'];
$markaz = $row['markaz'];
$name = $row['name'];
$id_city = $row['id_city'];
$pic = $row['pic'];
$jens = $row['jens'];
if ($jens == 'مرد')  $v_jen = 'آقای' ; 
if ($jens == 'زن')  $v_jen = 'خانم';
if ($pic=='') $pic = 'no_pic.png' ; 
$no_karbar = 'مدیر سامانه استان' ; 
$dbh = null;
if(!isset($login_session))
{
header("Location:".$actual_link."/login/login.php");
}
?>