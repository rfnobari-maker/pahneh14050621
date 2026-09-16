<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
include('../lock_p1.php');
include('../event.php');
if(isset($_POST['tel_m']))
{
	$tel_m   = $_POST['tel_m'] ; 
	$id        = $_POST['id'] ; 
	$bah_cod_m = $_POST['bah_cod_m'] ; 
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
$query = "update bah set date_s=?,tel_m=? where id=? ";
$stmt = $dbh->prepare($query);
$stmt->execute(array($date_edit,$tel_m,$id));

$query = "update bah2 set date_s=?,tel_m=? where bah_cod_m=? ";
$stmt = $dbh->prepare($query);
$stmt->execute(array($date_edit,$tel_m,$bah_cod_m));


}
