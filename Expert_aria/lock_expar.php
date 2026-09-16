

<?php
include('login/config.php');
session_start();
$user_check=$_SESSION['login_user'];
$karbar_m = $_SESSION['karbar'] ;
//
if( isset($_SESSION[‘last_acted_on’]) && (time() - $_SESSION[‘last_acted_on’] > 60*30) ){
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
     header("Location:login/login.php");
}else{
    $_SESSION[‘last_acted_on’] = time();
}
//
$query = "SELECT * from users  WHERE username='".$user_check."' and S_access='5'";
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
$id_ostan = $row['id_ostan'];
$pic = $row['pic'];
$jens = $row['jens'];
$id_aria = $row['id_aria'];
$expert_unit =$row['expert_unit'];
if ($expert_unit=='1') $v_expert_unit='مدیریت هماهنگی ترویج' ;
if ($expert_unit=='2') $v_expert_unit='مدیریت باغبانی' ;
if ($expert_unit=='3') $v_expert_unit='مدیریت حفظ نباتات' ;
if ($expert_unit=='4') $v_expert_unit='مدیریت زراعت' ;
if ($expert_unit=='5') $v_expert_unit='مدیریت امور شیلات و آبزیان' ;
if ($expert_unit=='6') $v_expert_unit='مدیریت امور دام' ;
if ($expert_unit=='7') $v_expert_unit='مدیریت امور طیور' ;
if ($expert_unit=='8') $v_expert_unit='مدیریت امور اراضی' ;
if ($expert_unit=='9') $v_expert_unit='مدیریت صنایع کشاورزی' ;
if ($expert_unit=='10') $v_expert_unit='مدیریت آب و خاک' ;
if ($jens == 'مرد') $v_jen = 'آقای' ; 
if ($jens == 'زن') $v_jen = 'خانم';
if ($pic=='') $pic = 'no_pic.png' ; 
$dbh = null;
if(!isset($login_session))
{
    header("Location:login/login.php");
}
?>