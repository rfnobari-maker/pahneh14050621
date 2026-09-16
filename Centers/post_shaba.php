<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
include('../lock_p2.php');
if(isset($_POST['shaba']))
 {
	$username      = $_POST['username'] ; 
	$shaba         = $_POST['shaba'] ; 

require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
$query = "update users set shaba=? where username=? ";
$stmt = $dbh->prepare($query);
$stmt->execute(array($shaba,$username));
}
