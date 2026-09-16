<?php 
include("../lock_ce.php");
include('../event.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
if(isset($_POST['bulk_delete_submit'])){
    $idArr = $_POST['checked_id'];
    foreach($idArr as $id){
$query = "SELECT r_user from pm WHERE id=:id";
$stmt = $dbh->prepare($query);
$stmt->bindParam(':id',$id, PDO::PARAM_INT);   
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$r_user =  $row['r_user'] ; 
///
$sql = "DELETE FROM pm WHERE id=:id ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id',$id, PDO::PARAM_INT);   
$stmt->execute();
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','حذف پیام ارسالی به / '.user_name($r_user)) ; 
    }
}
 ?>
<form name="myform1" class="myform" method="post" action="sent_message.php">
 </form>
   <script type="text/javascript">document.myform1.submit();</script> 