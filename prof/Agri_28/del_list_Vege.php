<?php 
include("../../lock_p1.php");
$add_abadi = $_POST['add_abadi'] ; 
$add_city = $_POST['add_city'] ; 
$bah_cod_m = $_POST['bah_cod_m'];
$id = $_POST['id'];
include('../../event.php');
require_once('../../Jalali.php');
 if (isset($_POST['bah_cod_m']) and $z_sal !='1394-1395') 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
$query = "DELETE FROM Vege WHERE id=? LIMIT 1";
$q = $dbh->prepare($query);
$q->execute(array($id));
$query = "DELETE FROM Vege_prod WHERE  Vege_id=?  ";
$q = $dbh->prepare($query);
$q->execute(array($id));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'حذف اطلاعات محصولات جالیزی  - '.$bah_cod_m,$id_ostan) ; 
// start 61
// end 61

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