<?php 
include("../../lock_cp.php");
$id = $_POST['id'];
include('../../event.php');
require_once('../../Jalali.php');
 if (isset($_POST['id'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include_once('../../login/config.php');

$query = "DELETE FROM Greenhous WHERE id=? LIMIT 1";
$q = $dbh->prepare($query);
$q->execute(array($id));

$query = "DELETE FROM Greenhous_prod WHERE  unit_id= ? ";
$q = $dbh->prepare($query);
$q->execute(array($id));

$query = "DELETE FROM Greenprod_annual WHERE unit_id= ? ";
$q = $dbh->prepare($query);
$q->execute(array($id));


$dbh = null ; 

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