<?php 
include("../lock_ad.php");
$add_city = $_POST['add_city'] ; 
$id_mar = $_POST['id_mar'] ; 
include('../event.php');
require_once('../Jalali.php');
 if (isset($_POST['add_city'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
$sql = "DELETE FROM list_city WHERE add_city =  :add_city";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':add_city', $_POST['add_city'], PDO::PARAM_INT);   
$stmt->execute();
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_city,'قطع ارتباط شهر از مرکز - '.$is_mar,$id_ostan) ; 
?>
<form name="myform" class="myform" method="post" action="active_city.php">
<input type="hidden" name="com_alert" value="شهر مورد نظر به لیست شهر های غیر فعال اضافه گردید">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="active_city.php">
<input type="hidden" name="com_alert" value="خطایی در غیر فعال سازی شهر رخ داده است ">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
 ?>