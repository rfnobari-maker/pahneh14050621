<?php 
 include('../login/config.php');
 if (isset($_POST['id'])) 
 { 
$id = $_POST['id'] ; 
$s_user = $_POST['s_user'] ; 
$ru_read = $_POST['ru_read'] ; 
if ($ru_read=='1') $v_ru_read='2' ;
if ($ru_read=='3') $v_ru_read='3' ;
if ($ru_read=='2') $v_ru_read='2' ;
include('../login/config.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$query = "UPDATE pm  SET r_date=?, r_time=? , ru_read=? WHERE id=?";
$q = $dbh->prepare($query);
$q->execute(array($date_edit,$time,$v_ru_read,$id));
?>
 <form name="reply" class="reply" method="post" action="message_view.php">
      <input type="hidden" name="s_user" value="<?php echo $s_user ;?>" />
      <input type="hidden" name="id" value="<?php echo $id ;?>" />
     </form>
    <script type="text/javascript">document.reply.submit();</script>
<?php
 } 
 ?>