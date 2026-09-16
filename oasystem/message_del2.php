<?php 
include("../lock_ad.php");
include('../event.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
if(isset($_POST['bulk_delete_submit'])){
    $idArr = $_POST['checked_id'];
    foreach($idArr as $id){
$query = "SELECT s_user from pm WHERE id=:id";
$stmt = $dbh->prepare($query);
$stmt->bindParam(':id',$id, PDO::PARAM_INT);   
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$s_user =  $row['s_user'] ; 
///
$query = "UPDATE pm  SET ru_read=?,del=?, del_date=?,del_time=? WHERE id=?";
$q = $dbh->prepare($query);
$q->execute(array('4','T',$date_edit,$time,$id));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','حذف پیام دریافتی از/ '.user_name($s_user)) ; 
    }
}
 ?>
<form name="myform1" class="myform" method="post" action="messanger.php">
 </form>
   <script type="text/javascript">document.myform1.submit();</script> 