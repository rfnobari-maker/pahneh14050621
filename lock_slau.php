<?php
session_start();
$dbh = null;
include('login/config.php');
$title = 'سامانه جامع پهنه بندی و مدیریت داده های کشاورزی' ; 
$user_check=$_SESSION['login_user'];
$karbar_m = $_SESSION['karbar'] ;
$actual_link = "http://$_SERVER[HTTP_HOST]";

//
if( isset($_SESSION[‘last_acted_on’]) && (time() - $_SESSION[‘last_acted_on’] > 60*15) ){
    $_SESSION = array();
    session_destroy();
header("Location:".$actual_link."/login/login.php");
}else{
    $_SESSION[‘last_acted_on’] = time();
}
//
 $query = "SELECT date_pas,username,Last_name,ostan,id_ostan,city,id_city,markaz,name,id_mar,pic,jens,id_aria,expert_unit from users  WHERE username='".$user_check."' and S_access='8'";
$stmt = $dbh->prepare($query);
$stmt->execute();
// $row تک خطی 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$login_session=$row['username'];
$PersName = $row['Last_name'];
$date_pas = $row['date_pas'];
$euser = $PersName ; 
$ostan = $row['ostan'];
$city = $row['city'];
$markaz = $row['markaz'];
$name = $row['name'];
$id_ostan = $row['id_ostan'];
$pic = $row['pic'];
$jens = $row['jens'];
$id_aria = $row['id_aria'];
$expert_unit =$row['expert_unit'];
if ($expert_unit=='1') $v_expert_unit='طرح و برنامه/ترویج' ;
if ($expert_unit=='2') $v_expert_unit='باغبانی' ;
if ($expert_unit=='3') $v_expert_unit='حفظ نباتات' ;
if ($expert_unit=='4') $v_expert_unit='زراعت' ;
if ($expert_unit=='5') $v_expert_unit='شیلات و آبزیان' ;
if ($expert_unit=='6') $v_expert_unit='دام' ;
if ($expert_unit=='7') $v_expert_unit='طیور و زنبورعسل' ;
if ($expert_unit=='8') $v_expert_unit='اراضی' ;
if ($expert_unit=='9') $v_expert_unit='صنایع تبدیلی و تکمیلی' ;
if($expert_unit=='10') $v_expert_unit='آب و خاک' ;
if ($jens == 'مرد') $v_jen = 'آقای' ; 
if ($jens == 'زن') $v_jen = 'خانم';
if ($pic=='') $pic = 'no_pic.png' ; 
$dbh = null;
if(!isset($login_session))
{
header("Location:".$actual_link."/login/login.php");
}
?>