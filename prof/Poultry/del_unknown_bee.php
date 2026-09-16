<?php 
include("../../lock_p1.php");
$mor_cod_m = $_POST['mor_cod_m'] ; 
$add_abadi = $_POST['add_abadi'] ; 
$add_city = $_POST['add_city'] ; 
$id = $_POST['id'];
if ($add_abadi=='-') $add_abadi = $add_city ;
include('../../event.php');
require_once('../../Jalali.php');
 if (isset($_POST['mor_cod_m'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
$query = "DELETE FROM unknown_bee WHERE mor_cod_m=? AND id=?";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'حذف اطلاعات زنبورستان ناشناس ',$id_ostan) ; 
?>
<form name="myform" class="myform" method="post" action="list_unknown_bee.php">
<input type="hidden" name="com_alert" value="اطلاعات زنبورستان با موفقیت حذف شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="list_unknown_bee.php">
<input type="hidden" name="com_alert" value="خطایی در حذف اطلاعات زنبورستان رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
 ?>