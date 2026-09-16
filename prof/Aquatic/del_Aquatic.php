<?php 
include("../../lock_p1.php");
$m_page      = isset($_POST['m_page']) ? $_POST['m_page'] : null;
$add_abadi   = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : null;
$add_city    = isset($_POST['add_city']) ? $_POST['add_city'] : null;
$bah_cod_m   = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : null;
$sal         = isset($_POST['sal']) ? $_POST['sal'] : null;
$id          = isset($_POST['id']) ? $_POST['id'] : null;
$h_add_abadi = isset($_POST['h_add_abadi']) ? $_POST['h_add_abadi'] : null;
$h_add_city  = isset($_POST['h_add_city']) ? $_POST['h_add_city'] : null;
$h_no_mal    = isset($_POST['h_no_mal']) ? $_POST['h_no_mal'] : null;
$h_no_fa     = isset($_POST['h_no_fa']) ? $_POST['h_no_fa'] : null;
$h_sal       = isset($_POST['h_sal']) ? $_POST['h_sal'] : null;
include('../../event.php');
require_once('../../Jalali.php');
 if (isset($_POST['bah_cod_m'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
$query = "DELETE FROM Aquatic2 WHERE bah_cod_m=? AND id=? AND sal = ?";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$id,$sal));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'حذف اطلاعات مزرعه تکثیر و پرورش آبزیان - '.$bah_cod_m) ; 
?>
<form name="myform" class="myform" method="post" action="<?php echo $m_page ?>">
<input type="hidden" name="action" value="1">
<input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ?>">
<input type="hidden" name="add_abadi" value="<?php echo $h_add_abadi?>" />
<input type="hidden" name="add_city" value="<?php echo $h_add_city?>" />
<input type="hidden" name="no_mal" value="<?php echo $h_no_mal?>" />
<input type="hidden" name="no_fa" value="<?php echo $h_no_fa?>" />
<input type="hidden" name="sal" value="<?php echo $h_sal?>" />
<input type="hidden" name="com_alert" value="اطلاعات مزرعه با موفقیت حذف شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="<?php echo $m_page ?>">
<input type="hidden" name="com_alert" value="خطایی در حذف اطلاعات مزرعه رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
 ?>
