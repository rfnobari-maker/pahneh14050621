<?php 
include('../../lock_expsh.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
if  (isset($_POST['ShenaseKasboKar']))
{
$y_prod = $_POST['y_prod']  ;
$d_prod  = $_POST['d_prod']  ;
$ShenaseKasboKar = $_POST['ShenaseKasboKar'];
include('../../login/config.php');
$query = "DELETE FROM ind_unit_info where y_prod=? and d_prod=?
 and  ShenaseKasboKar=?  ";
$q = $dbh->prepare($query);
$q->execute(array($y_prod,$d_prod,$ShenaseKasboKar));
$query = "DELETE FROM ind_unit_prod where y_prod=? and d_prod=?
 and  ShenaseKasboKar=?  ";
$q = $dbh->prepare($query);
$q->execute(array($y_prod,$d_prod,$ShenaseKasboKar));

sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','حذف عملکرد واحد صنعتی - '.$ShenaseKasboKar,$id_ostan) ; 
?>
<script>
alert(' اطلاعات با موفقیت حذف شد') ; 
</script>
     <form name="myform" class="myform" action="ind_list_performance.php" method="post" onsubmit="winpap1(this)">
         <input type="hidden" name="ShenaseKasboKar" value="<?php echo $ShenaseKasboKar ;?>" />
         <button><img src="../../files/komo.png" title="نمایش عملکرد واحد صنعتی"  width="20" height="20"  alt=""/></button>
     </form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<script>
alert(' خطایی در حذف اطلاعات رخ داده است ') ; 
window.close();
</script>
</script>
     <form name="myform" class="myform" action="ind_list_performance.php" method="post" onsubmit="winpap1(this)">
         <input type="hidden" name="ShenaseKasboKar" value="<?php echo $ShenaseKasboKar ;?>" />
         <button><img src="../../files/komo.png" title="نمایش عملکرد واحد صنعتی"  width="20" height="20"  alt=""/></button>
     </form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 ?>
 <script>
function winpap1(form) {
    window.open('null', 'formpopup', 'width=900,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>