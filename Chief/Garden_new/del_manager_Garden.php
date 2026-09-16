<?php 
include("../../lock_p1.php");
include('../../event.php');
require_once('../../Jalali.php');
include_once('../../login/config.php');
$add_abadi = $_POST['add_abadi'] ; 
$add_city = $_POST['add_city'] ; 
$bah_cod_m = $_POST['bah_cod_m'];
$sh_gat = $_POST['sh_gat'];
$z_sal = $_POST['z_sal'];
$id = $_POST['id'];
$check_cod = $_POST['check_cod'];

 if (isset($_POST['bah_cod_m']) and $z_sal !='1395')  
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$query = "DELETE FROM Garden WHERE bah_cod_m=? AND id=?";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$id));
$query = "DELETE FROM Garden_prod WHERE bah_cod_m=? AND sh_gat=? AND z_sal=? AND add_abadi = ? AND add_city=? AND Garden_id=?  ";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$sh_gat,$z_sal,$add_abadi,$add_city,$id));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'حذف اطلاعات باغی و قلمستان - '.$bah_cod_m,$id_ostan) ; 

?>
<form name="myform" class="myform" method="post" action="manager_Garden.php">
<input type="hidden" name="action" value="1">
<input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ?>">
<input type="hidden" name="com_alert" value="اطلاعات باغی و قلمستان با موفقیت حذف شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="manager_Garden.php">
<input type="hidden" name="action" value="1">
<input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ?>">
<input type="hidden" name="com_alert" value="خطایی در حذف اطلاعات باغی و قلمستان رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 ?>