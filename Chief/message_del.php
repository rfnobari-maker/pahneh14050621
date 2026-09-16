<?php 
include("../lock_ce.php");
include('../event.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;

$list_ru_read = isset($_POST['list_ru_read']) ? $_POST['list_ru_read'] : '';
$list_q = isset($_POST['list_q']) ? $_POST['list_q'] : '';
$order_field = isset($_POST['order_field']) ? $_POST['order_field'] : 's_date';
$order_by = isset($_POST['order_by']) ? $_POST['order_by'] : 'desc';
$page_id = isset($_POST['page_id']) ? (int)$_POST['page_id'] : 1;
if ($page_id < 1) $page_id = 1;

if (isset($_POST['s_user'])) 
 { 
$s_user = $_POST['s_user'] ;
$id = $_POST['id'] ;
include_once('../login/config.php');
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
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','حذف پیام خصوصی / '.user_name($s_user)) ; 
 } 
 ?>
<form name="myform1" class="myform" method="get" action="messanger.php">
 <input type="hidden" name="id" value="<?php echo (int)$page_id; ?>" />
 <input type="hidden" name="ru_read" value="<?php echo htmlspecialchars($list_ru_read); ?>" />
 <input type="hidden" name="q" value="<?php echo htmlspecialchars($list_q); ?>" />
 <input type="hidden" name="order_field" value="<?php echo htmlspecialchars($order_field); ?>" />
 <input type="hidden" name="order_by" value="<?php echo htmlspecialchars($order_by); ?>" />
 </form>
   <script type="text/javascript">document.myform1.submit();</script>
