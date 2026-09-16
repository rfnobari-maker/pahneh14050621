<?php 
include('../lock_p3.php');
include ('../login/config.php') ; 
include('../event.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$add_abadi = $_POST['id_abadi']  ; 
$id_abadi = substr($add_abadi,10,6);
$cod_m1 = $_POST['cod_m1'] ;
$cod_m2 = $_POST['cod_m2'] ; 
$id_mar = $_POST['id_mar'] ; 
$mar = $_POST['mar'] ; 
$query ="UPDATE list_abadi 
       SET mor_cod_m=?
	WHERE  mor_cod_m=? and add_abadi=?";
$q = $dbh->prepare($query);
$q->execute(array($cod_m2,$cod_m1,$add_abadi));
$query = "UPDATE change_mor SET status=? , date_a = ?
	WHERE mor_codm_old=? and mor_codm_new=? and add_abadi = ? ";
$q = $dbh->prepare($query);
$q->execute(array('2',$date_edit,$cod_m1,$cod_m2,$add_abadi));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'تایید درخواست تغییر مروج ') ; 
echo edit_database_abadi($id_mar,$cod_m2,$id_abadi,$add_abadi) ;
?>
<form name="myform" class="myform" method="post" action="list_request1.php">
    <input type="hidden" name="id_mar" value="<?php echo $id_mar ;?>" />
    <input type="hidden" name="mar" value="<?php echo $mar ;?>" />
</form>
<script type="text/javascript">document.myform.submit();</script>
