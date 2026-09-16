<?php 
include("../lock_ad.php");
$add_abadi = $_POST['add_abadi'] ; 
$id_mar = $_POST['id_mar'] ; 
include('../event.php');
require_once('../Jalali.php');
 if (isset($_POST['add_abadi'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
$sql = "DELETE FROM list_abadi WHERE add_abadi =  :add_abadi";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':add_abadi', $_POST['add_abadi'], PDO::PARAM_INT);   
$stmt->execute();
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'قطع ارتباط آبادی از مرکز - '.$is_mar,$id_ostan) ; 
?>
<form name="myform" class="myform" method="post" action="active_abadi.php">
<input type="hidden" name="com_alert" value="آبادی مورد نظر به لیست آبادی های غیر فعال اضافه گردید">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="active_abadi.php">
<input type="hidden" name="com_alert" value="خطایی در غیر فعال سازی آبادی رخ داده است ">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
 ?>