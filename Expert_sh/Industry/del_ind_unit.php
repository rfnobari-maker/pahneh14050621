<?php 
include("../../lock_expsh.php");
$id        = $_POST['id'] ; 
$add_abadi = $_POST['add_abadi'] ; 
$add_city  = $_POST['add_city'] ; 
$bah_cod_m = $_POST['bah_cod_m'];
$num_bah   = $_POST['num_bah']; 
if (strlen($add_abadi)==0) $add_abadi = $add_city ;
include('../../event.php');
require_once('../../Jalali.php');
 if (isset($_POST['bah_cod_m'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
if (ind_unit_prod_count($id) > 0) 
{	
?>
<form  name="myform" class="myform" method="post" action="list_ind_unit.php">
<input type="hidden" name="com_alert" value="واحد دارای عملکرد سالانه میباشد ، امکان حذف وجود ندارد ">
<input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m?>">
<input type="hidden" name="action" value="1" >
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php

}
else 
{
$query = "DELETE FROM ind_unit WHERE id=? ";
$q = $dbh->prepare($query);
$q->execute(array($id));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'حذف اطلاعات واحد صنعتی - '.$bah_cod_m) ; 
?>
<form name="myform" class="myform" method="post" action="list_ind_unit.php">
<input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m?>">
<input type="hidden" name="com_alert" value="اطلاعات بهره بردار با موفقیت حذف شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 }
 }
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="list_ind_unit.php">
<input type="hidden" name="com_alert" value="خطایی در حذف اطلاعات بهره بردار رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
  ?>