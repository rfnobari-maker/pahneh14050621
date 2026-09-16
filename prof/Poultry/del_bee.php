<?php 
include("../../lock_p1.php");
$add_abadi = $_POST['add_abadi'] ; 
$add_city = $_POST['add_city'] ; 
$bah_cod_m = $_POST['bah_cod_m'];
$unique_id = $_POST['unique_id'] ; 
$id = $_POST['id'];
if ($add_abadi=='-') $add_abadi = $add_city ;
include('../../event.php');
require_once('../../Jalali.php');
 if (isset($_POST['bah_cod_m'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
$query = "DELETE FROM bee WHERE bah_cod_m=$bah_cod_m AND id=$id";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE FROM bee_equipment WHERE unique_id=? ";
$q = $dbh->prepare($query);
$q->execute(array($unique_id));


sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'حذف اطلاعات زنبورستان - '.$bah_cod_m,$id_ostan) ; 
?>
<form name="myform" class="myform" method="post" action="manager_bee.php">
<input type="hidden" name="bah_cod_m" value='<?php echo $bah_cod_m ?>'/>
<input type="hidden" name="action" value='true'/>
<input type="hidden" name="com_alert" value="اطلاعات زنبورستان با موفقیت حذف شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="manager_bee.php">
<input type="hidden" name="bah_cod_m" value='<?php echo $bah_cod_m ?>'/>
<input type="hidden" name="action" value='true'/>
<input type="hidden" name="com_alert" value="خطایی در حذف اطلاعات زنبورستان رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
 ?>