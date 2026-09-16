<?php 
include("../../lock_p1.php");
$add_abadi = $_POST['add_abadi'] ; 
$add_city = $_POST['add_city'] ; 
$bah_cod_m = $_POST['bah_cod_m'];
$sh_gat = $_POST['sh_gat'];
$z_sal = $_POST['z_sal'];
$id = $_POST['id'];
include('../../event.php');
require_once('../../Jalali.php');
 if (isset($_POST['bah_cod_m'])) 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
$query = "DELETE FROM Agri WHERE bah_cod_m=? AND id=?";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$id));
$query = "DELETE FROM Agri_prod WHERE bah_cod_m=? AND sh_gat=? AND z_sal=? AND add_abadi = ? AND add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$sh_gat,$z_sal,$add_abadi,$add_city));

sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'حذف اطلاعات زراعی - '.$bah_cod_m) ; 
?>
<form name="myform" class="myform" method="post" action="liste_Agri.php">
<input type="hidden" name="com_alert" value="اطلاعات زراعی با موفقیت حذف شد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="liste_Agri.php">
<input type="hidden" name="com_alert" value="خطایی در حذف اطلاعات زراعی رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>

<?php
 } 
 ?>
