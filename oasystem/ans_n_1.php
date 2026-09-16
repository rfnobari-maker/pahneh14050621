<?php
include('../lock_ad.php');
include ('../login/config.php') ; 
include('../event.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$id = $_POST['id']  ; 
$add_abadi = $_POST['id_abadi']  ; 
$cod_m1 = $_POST['cod_m1'] ;
$cod_m2 = $_POST['cod_m2'] ; 
$id_mar = $_POST['id_mar'] ; 
$mar = $_POST['mar'] ; 
$query = "UPDATE change_mor SET status=? , date_a = ?
	WHERE mor_codm_old=? and mor_codm_new=? and add_abadi = ? and id=? ";
$q = $dbh->prepare($query);
$q->execute(array('3',$date_edit,$cod_m1,$cod_m2,$add_abadi,$id));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'عدم تایید درخواست ') ; 
?>
<form name="myform" class="myform" method="post" action="list_request1.php">
    <input type="hidden" name="id_mar" value="<?php echo $id_mar ;?>" />
    <input type="hidden" name="mar" value="<?php echo $mar ;?>" />
</form>
<script type="text/javascript">document.myform.submit();</script>
