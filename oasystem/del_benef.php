<?php 
include("../lock_ad.php");
$add_abadi = $_POST['add_abadi'] ; 
$add_city = $_POST['add_city'] ; 
$bah_cod_m = $_POST['bah_cod_m'];
if (strlen($add_abadi)==0) $add_abadi = $add_city ;
include('../event.php');
require_once('../Jalali.php');
 if (isset($_POST['bah_cod_m'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
$sql = "DELETE FROM bah WHERE bah_cod_m =  :bah_cod_m";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':bah_cod_m', $_POST['bah_cod_m'], PDO::PARAM_INT);   
$stmt->execute();
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'حذف اطلاعات بهره بردار - '.$bah_cod_m) ; 
?>
<form name="myform" class="myform" method="post" action="manager_benef.php">
<input type="hidden" name="com_alert" value="اطلاعات بهره بردار با موفقیت حذف شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="manager_benef.php">
<input type="hidden" name="com_alert" value="خطایی در حذف اطلاعات بهره بردار رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
 ?>