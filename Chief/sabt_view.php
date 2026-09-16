<?php 
 include_once('../login/config.php');
 if (isset($_POST['id'])) 
 { 
$id = $_POST['id'] ; 
$s_user = $_POST['s_user'] ; 
$ru_read = $_POST['ru_read'] ; 
$list_ru_read = isset($_POST['list_ru_read']) ? $_POST['list_ru_read'] : '';
$list_q = isset($_POST['list_q']) ? $_POST['list_q'] : '';
$order_field = isset($_POST['order_field']) ? $_POST['order_field'] : 's_date';
$order_by = isset($_POST['order_by']) ? $_POST['order_by'] : 'desc';
$page_id = isset($_POST['page_id']) ? (int)$_POST['page_id'] : 1;
if ($page_id < 1) $page_id = 1;
if ($ru_read=='1') $v_ru_read='2' ;
if ($ru_read=='3') $v_ru_read='3' ;
if ($ru_read=='2') $v_ru_read='2' ;
include_once('../login/config.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$query = "UPDATE pm  SET r_date=?, r_time=? , ru_read=? WHERE id=?";
$q = $dbh->prepare($query);
$q->execute(array($date_edit,$time,$v_ru_read,$id));
?>
 <form name="reply" class="reply" method="post" action="message_view.php">
      <input type="hidden" name="s_user" value="<?php echo htmlspecialchars($s_user); ?>" />
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>" />
      <input type="hidden" name="ru_read" value="<?php echo htmlspecialchars($ru_read); ?>" />
      <input type="hidden" name="list_ru_read" value="<?php echo htmlspecialchars($list_ru_read); ?>" />
      <input type="hidden" name="list_q" value="<?php echo htmlspecialchars($list_q); ?>" />
      <input type="hidden" name="order_field" value="<?php echo htmlspecialchars($order_field); ?>" />
      <input type="hidden" name="order_by" value="<?php echo htmlspecialchars($order_by); ?>" />
      <input type="hidden" name="page_id" value="<?php echo (int)$page_id; ?>" />
     </form>
    <script type="text/javascript">document.reply.submit();</script>
<?php
 } 
 ?>
