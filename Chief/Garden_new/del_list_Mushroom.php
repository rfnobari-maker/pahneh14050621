<?php 
include("../../lock_p1.php");
$add_abadi = $_POST['add_abadi'] ; 
$add_city = $_POST['add_city'] ; 
$bah_cod_m = $_POST['bah_cod_m'];
$id = $_POST['id'];
include('../../event.php');
require_once('../../Jalali.php');
 if (isset($_POST['bah_cod_m'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include_once('../../login/config.php');
$query = "SELECT count(*) FROM Mushroom_prod WHERE unit_id= $id ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> fetchColumn();
if ($count_codm>0) { 
?>
<script>
alert(' این واحد دارای عملکرد میباشد ، برای حذف اطلاعات واحد ، باید ابتدا عملکرد واحد را حذف کنید') ; 
window.close();
</script>
<?php
 } 
 else 
{
$query = "DELETE FROM Mushroom WHERE id=? LIMIT 1";
$q = $dbh->prepare($query);
$q->execute(array($id));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'حذف واحد پرورش قارچ- '.$bah_cod_m,$id_ostan) ; 
?>
<script>
alert(' اطلاعات با موفقیت حذف شد') ; 
window.opener.location.reload();
window.close();
</script>
<?php
 } 
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