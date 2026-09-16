<?php 
include("../../lock_p2.php");
$cod_m = $_POST['mor_cod_m'] ; 
$username = $_POST['username'] ; 
include('../../event.php');
require_once('../../Jalali.php');
if (isset($_POST['mor_cod_m'])) 
{ 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
$query = "UPDATE  users SET con_center=?,date_con_center=?,con_city=? where username = $username " ;
$q = $dbh->prepare($query);
$q->execute(array('1',$date_edit,''));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','تائید اطلاعات سرشماری زنبورستان ها مروج'.$cod_m) ; 
?>
<form name="myform" class="myform" method="post" action="confi_bee.php">
<input type="hidden" name="com_alert" value="تایید اطلاعات مروج با موفقیت ثبت شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="confi_bee.php">
<input type="hidden" name="com_alert" value="خطایی در تایید اطلاعات مروج رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
 ?>