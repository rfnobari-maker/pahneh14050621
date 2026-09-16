<?php 
include("../../lock_Sc.php");
include('../../event.php');
require_once('../../Jalali.php');
if (isset($_POST['id_mar'])) 
{ 
$id_mar = $_POST['id_mar'] ; 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
$query = "UPDATE  users SET con_center=?, con_city=?,date_con_city=? where id_mar = '$id_mar' and  S_access = '1' " ;
$q = $dbh->prepare($query);
$q->execute(array('','2',$date_edit));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'',' عدم تائید اطلاعات سرشماری زنبورستان ها مرکز - '.$id_mar) ; 
?>
<form name="myform" class="myform" method="post" action="confi_bee.php">
<input type="hidden" name="com_alert" value=" عدم تایید اطلاعات مرکز با موفقیت ثبت شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="confi_bee.php">
<input type="hidden" name="com_alert" value="خطایی در عدم تایید اطلاعات مرکز رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
 ?>