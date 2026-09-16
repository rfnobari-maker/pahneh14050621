<?php 
include("../../../lock_p2.php");
$h_add_abadi=$_POST['h_add_abadi']  ;
$h_g_tah = $_POST['h_g_tah']  ;
$h_sal_z = $_POST['h_sal_z']  ;
$h_no_oz = $_POST['h_no_oz']  ;
$m_page = $_POST['m_page'];
$add_abadi = $_POST['add_abadi'] ; 
$cod_m = $_POST['cod_m'];
include('../../../event.php');
require_once('../../../Jalali.php');

include('../../../login/config.php');
$query = "SELECT id from Eworker_h where  cod_m=? ";
$q = $dbh->prepare($query);
$q->execute(array($cod_m));
$count_h = $q -> rowCount();
alert(' تعداد سوابق حمایتی :'.$count_h) ;
$query = "SELECT id from Eworker_ac where  cod_m=? ";
$q = $dbh->prepare($query);
$q->execute(array($cod_m));
$count_ac = $q -> rowCount();
alert('تعداد سوابق عملکردی :'.$count_ac) ;
 if (isset($_POST['cod_m']) and $count_h == 0 and $count_ac == 0) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$query = "DELETE FROM Eworker WHERE cod_m=?  ";
$q = $dbh->prepare($query);
$q->execute(array($cod_m));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'حذف مددکار ترویجی - '.$cod_m,$id_ostan) ; 
?>
<form name="myform" class="myform" method="post" action="<?php echo $m_page?>">
     <input type="hidden" name="cod_m" value="<?php echo $cod_m  ;?>" />
     <input type="hidden" name="add_abadi" value="<?php echo $h_add_abadi  ;?>" />
     <input type="hidden" name="g_tah" value="<?php echo $h_g_tah  ;?>" />
     <input type="hidden" name="sal_z" value="<?php echo $h_sal_z  ;?>" />
     <input type="hidden" name="no_oz" value="<?php echo $h_no_oz  ;?>" />
    <input type="hidden" name="action_lise" value="1" />
<input type="hidden" name="com_alert" value="اطلاعات مددکار ترویجی با موفقیت حذف شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="<?php echo $m_page?>">
     <input type="hidden" name="cod_m" value="<?php echo $cod_m  ;?>" />
     <input type="hidden" name="add_abadi" value="<?php echo $h_add_abadi  ;?>" />
     <input type="hidden" name="g_tah" value="<?php echo $h_g_tah  ;?>" />
     <input type="hidden" name="sal_z" value="<?php echo $h_sal_z  ;?>" />
     <input type="hidden" name="no_oz" value="<?php echo $h_no_oz  ;?>" />
    <input type="hidden" name="action_lise" value="1" />
<input type="hidden" name="com_alert" value="خطایی در حذف اطلاعات مددکار رخ داده است ،  احتمالاً مدکار داری اطلاعات عملکرد یا حمایت هست ">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
 ?>
