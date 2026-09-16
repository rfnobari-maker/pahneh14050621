<?php 
include("../../lock_p1.php");
$m_page = $_POST['m_page'];
$add_abadi = $_POST['add_abadi'] ; 
$add_city = $_POST['add_city'] ; 
$bah_cod_m = $_POST['bah_cod_m'];
$sal = $_POST['sal'];
$id = $_POST['id'];
$h_add_abadi = $_POST['h_add_abadi'];
$h_add_city = $_POST['h_add_city'];
$h_no_mtol = $_POST['h_no_mtol'];
$h_no_mal = $_POST['h_no_mal'];
$h_sal = $_POST['h_sal'];


include('../../event.php');
require_once('../../Jalali.php');
 if (isset($_POST['bah_cod_m'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include_once('../../login/config.php');
$query = "DELETE FROM Greenhous WHERE bah_cod_m=? AND id=? AND sal = ?";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$id,$sal));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'حذف اطلاعات گلخانه - '.$bah_cod_m,$id_ostan) ; ?>
<form name="myform" class="myform" method="post" action="<?php echo $m_page ?>">
<input type="hidden" name="action" value="1">
<input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ?>">
<input type="hidden" name="add_abadi" value="<?php echo $h_add_abadi?>" />
<input type="hidden" name="add_city" value="<?php echo $h_add_city?>" />
<input type="hidden" name="no_mtol" value="<?php echo $h_no_mtol?>" />
<input type="hidden" name="no_mal" value="<?php echo $h_no_mal?>" />
<input type="hidden" name="sal" value="<?php echo $h_sal?>" />
<input type="hidden" name="com_alert" value="اطلاعات گلخانه با موفقیت حذف شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="<?php echo $m_page ?>">
<input type="hidden" name="com_alert" value="خطایی در حذف اطلاعات گلخانه رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
 ?>
