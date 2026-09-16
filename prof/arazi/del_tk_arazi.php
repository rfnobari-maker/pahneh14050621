<?php 
include("../../lock_p1.php");
include('../../event.php');
require_once('../../Jalali.php');
 if (isset($_POST['mor_cod_m'])) 
 { 
$id = $_POST['id'];
$add_abadi = $_POST['add_abadi'];
$mor_cod_m = $_POST['mor_cod_m'] ;
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
$query = "DELETE FROM tk_arazi WHERE mor_cod_m=? AND id=?";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'حذف گزارش تغییر کاربری اراضی کشاورزی ',$id_ostan) ; 
?>
<form name="myform" class="myform" method="post" action="list_tkarazi.php">
<input type="hidden" name="com_alert" value="گزارش مورد نظر با موفقیت حذف شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="list_tkarazi.php">
<input type="hidden" name="com_alert" value="خطایی در حذف گزارش مورد نظر رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
 ?>