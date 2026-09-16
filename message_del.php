<?php 
include("lock_p1.php");
include('event.php');
require_once('Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
if (isset($_POST['s_user'])) 
 { 
$s_user = $_POST['s_user'] ;
$id = $_POST['id'] ;
include('login/config.php');
if ($s_user==$login_session) { 
$sql = "DELETE FROM pm WHERE id=:id ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id',$id, PDO::PARAM_INT);   
$stmt->execute();
}
else 
{
$query = "UPDATE pm  SET ru_read=?,del=?, del_date=?,del_time=? WHERE id=?";
$q = $dbh->prepare($query);
$q->execute(array('4','T',$date_edit,$time,$id));
}
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','حذف پیام  / '.user_name($s_user),$id_ostan) ; 
 } 
 ?>
<form name="myform1" class="myform" method="post" action="messanger.php">
 </form>
   <script type="text/javascript">document.myform1.submit();</script> 