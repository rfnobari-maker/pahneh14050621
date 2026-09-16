<?php 
include("../../lock_p1.php");
$add_abadi = $_POST['add_abadi'] ; 
$add_city = $_POST['add_city'] ; 
$bah_cod_m = $_POST['bah_cod_m'];
$unit_id = $_POST['unit_id'];
$y_prod = $_POST['y_prod'];

include('../../event.php');
require_once('../../Jalali.php');
 if (isset($_POST['bah_cod_m'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include_once('../../login/config.php');
$query = "DELETE FROM Greenhous_prod WHERE  unit_id=? and y_prod = $y_prod ";
$q = $dbh->prepare($query);
$q->execute(array($unit_id));
$query = "DELETE FROM Greenprod_annual WHERE  unit_id=? and y_prod = $y_prod  ";
$q = $dbh->prepare($query);
$q->execute(array($unit_id));

sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'حذف عملکرد گلخانه- '.$bah_cod_m,$id_ostan) ; 



?>
<script>
alert(' اطلاعات با موفقیت حذف شد') ; 
window.opener.location.reload();
window.close();
</script>
<?php
 } 
 else 
 { 
?>
<script>
alert(' خطایی در حذف اطلاعات رخ داده است ') ; 
window.close();
</script>
<?php
 } 
 ?>