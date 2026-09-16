<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
include('../lock_p2.php');
if(isset($_POST['status']))
 {
	$cod_m      = $_POST['cod_m'] ; 
	$status     = $_POST['status'] ; 


require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
$query = "update users set date_status=?,status=? where username=? ";
$stmt = $dbh->prepare($query);
$stmt->execute(array($date_edit,$status,$cod_m));

$query = "INSERT INTO h_status (cod_m,id_ostan,id_city,id_mar,date_status,status)
                      VALUES   (:cod_m,:id_ostan,:id_city,:id_mar,:date_status,:status)";
$q = $dbh->prepare($query);
$q->execute(array(':cod_m'=>$cod_m,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,
':date_status'=>$date_edit,':status'=>$status));



}
