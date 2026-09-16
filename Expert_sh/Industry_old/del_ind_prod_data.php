<?php 
include("../../lock_expsh.php");
include('../../event.php');
require_once('../../Jalali.php');
include('../../login/config.php');
$bah_cod_m = $_POST['bah_cod_m'];
$unit_id = $_POST['unit_id'];
 if (isset($_POST['unit_id']))  
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$query = "DELETE FROM ind_unit_info WHERE unit_id=? ";
$q = $dbh->prepare($query);
$q->execute(array($unit_id));
$query = "DELETE FROM ind_unit_prod WHERE unit_id=? ";
$q = $dbh->prepare($query);
$q->execute(array($unit_id));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','حذف عملکرد واحد صنعتی - '.$bah_cod_m,$id_ostan) ; 
?>
<form  name="myform" class="myform" method="post" action="list_ind_prod.php#1">
<input type="hidden" name="com_alert" value="عملکرد واحد با موفقیت حذف شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form  name="myform" class="myform" method="post" action="list_ind_prod.php#1">
<input type="hidden" name="com_alert" value="خطایی در حذف عهملکرد واحد رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 ?>