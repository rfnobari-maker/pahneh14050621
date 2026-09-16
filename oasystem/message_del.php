<?php 
include("../lock_ad.php");
include('../event.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
if (isset($_POST['s_user'])) 
 { 
$s_user = $_POST['s_user'] ;
$id = $_POST['id'] ;
include('../login/config.php');
$sql = "DELETE FROM pm WHERE id=:id ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id',$id, PDO::PARAM_INT);   
$stmt->execute();
 } 
 ?>

<form name="myform1" class="myform" method="post" action="messanger.php">
 </form>
   <script type="text/javascript">document.myform1.submit();</script> 