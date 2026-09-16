<?php 
include("../lock_expsh.php");
$add_abadi = $_POST['add_abadi'] ; 
$add_city = $_POST['add_city'] ; 
$bah_cod_m = $_POST['bah_cod_m'];
 $num_bah = $_POST['num_bah']; 
if (strlen($add_abadi)==0) $add_abadi = $add_city ;
include('../event.php');
require_once('../Jalali.php');
 if (isset($_POST['bah_cod_m'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
if ((bah_ind_prod_count($bah_cod_m,$num_bah) > 0) or (bah_ind_unit_count($bah_cod_m,$num_bah) > 0))
{	
?>
<form  name="myform" class="myform" method="post" action="manager_ind_benef.php#result">
<input type="hidden" name="com_alert" value="بهره بردار دارای بهره برداری می باشد ، امکان حذف وجود ندارد ">
<input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m?>">
<input type="hidden" name="action" value="1" >
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php

}
else 
{
$query = "DELETE FROM ind_bah WHERE bah_cod_m=? AND num_bah=?   ";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$num_bah));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'حذف اطلاعات بهره بردار صنایع - '.$bah_cod_m) ; 
?>
<form name="myform" class="myform" method="post" action="manager_ind_benef.php">
<input type="hidden" name="com_alert" value="اطلاعات بهره بردار با موفقیت حذف شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 }
 }
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="manager_ind_benef.php">
<input type="hidden" name="com_alert" value="خطایی در حذف اطلاعات بهره بردار رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
  ?>