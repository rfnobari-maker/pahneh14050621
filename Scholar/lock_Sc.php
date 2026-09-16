<?php
if(!isset($_SESSION)){
    session_start();
}
$title = 'سامانه جامع پهنه بندی و مدیریت داده های کشاورزی' ; 
include('login/config.php');
$user_check=$_SESSION['login_user'];
$karbar_m = $_SESSION['karbar'] ;
//
if( isset($_SESSION['last_acted_on']) && (time() - $_SESSION['last_acted_on'] > 60*30) ){
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
      header("Location:http://10.7.234.126/login/login.php");

}else{
    $_SESSION['last_acted_on'] = time();
}
//
if(isset($_SESSION['login_user']))
{
$query = "SELECT * from users  WHERE username='".$user_check."' and S_access='7'";
$stmt = $dbh->prepare($query);
$stmt->execute();
// $row تک خطی 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$login_session=$row['username'];
 $PersName = $row['Last_name'];
$euser = $PersName ; 
$ostan = $row['ostan'];
$city = $row['city'];
$markaz = $row['markaz'];
$name = $row['name'];
$id_city = $row['id_city'];
$pic = $row['pic'];
$jens = $row['jens'];
$id_ostan = $row['id_ostan'];
if ($jens == 'مرد')  $v_jen = 'آقای' ; 
if ($jens == 'زن')  $v_jen = 'خانم';
if ($pic=='') $pic = 'no_pic.png' ; 
$no_karbar = 'محقق معین شهرستان' ; 
$dbh = null;
}
if(!isset($login_session))
{
      header("Location:http://10.7.234.126/login/login.php");

}
?>