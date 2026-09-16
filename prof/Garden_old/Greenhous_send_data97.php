<?php 
include("../../lock_p1.php");
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include_once('../../login/config.php');
if(isset($_POST['Go_send_data'])){
    $idArr = $_POST['checked_id'];
     $mor_cod_m = $_POST['mor_cod_m'] ; 
    $bah_cod_m =$_POST['bah_cod_m'] ; 
    $query = "SELECT id from Greenhous where  bah_cod_m = :bah_cod_m and sal= :sal and mor_cod_m = :mor_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':sal'=>'1397',':mor_cod_m'=>$login_session));
$found = $stmt -> rowCount();
    if ($found>0) {
         $com_alert = 'خطا : \n \n برای بهره بردار قبلا اطلاعات گلخانه سال 1397 ثبت شده است' ;
    }
else 
{
		foreach($idArr as $id){
$query ="CREATE TEMPORARY TABLE tmp$id SELECT * FROM Greenhous WHERE bah_cod_m=:bah_cod_m and sal = :sal and mor_cod_m = :mor_cod_m and id=:id" ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':sal'=>'1396',':mor_cod_m'=>$mor_cod_m,':id'=>$id));
$query = "update tmp$id set date_s = :date_s ,id = '',sal='1397',no_mtol1_1=0,no_mtol1_2=0,no_mtol1_3=0,no_mtol1_4=0,no_mtol1_5=0,no_mtol1_6=0,no_mtol2_1=0,no_mtol2_2=0,no_mtol2_3=0,no_mtol2_4=0,no_mtol3_1=0,no_mtol3_2=0,no_mtol3_3=0,no_mtol3_4=0,no_mtol4_1=0,no_mtol4_2=0,no_mtol4_3=0,no_mtol4_4=0  where bah_cod_m = :bah_cod_m and mor_cod_m = :mor_cod_m ";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':date_s'=>$date_edit,':bah_cod_m'=>$bah_cod_m,':mor_cod_m'=>$mor_cod_m));
$query = "INSERT INTO Greenhous SELECT * FROM tmp$id" ;  	
$stmt = $dbh->prepare($query);
$stmt->execute();
	//sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','حذف پیام دریافتی از/ '.user_name($s_user)) ; 
 }
         sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','انتقال اطلاعات پایه گلخانه - '.$bah_cod_m,$id_ostan) ; 
	     $com_alert = 'اطلاعات با موفقیت ارسال شد.   \n \n اکنون می توانید نسبت به ویرایش اطلاعات 1397 اقدام فرمایید ';
 }
 }
 
 ?>
<form name="myform1" class="myform" method="post" action="liste_Greenhous.php#1">
        <input type="hidden" name="no_mtol" value="0" />
        <input type="hidden" name="sys_kesh" value="0" />
        <input type="hidden" name="no_mal" value="0" />
        <input type="hidden" name="no_saz" value="0" />
        <input type="hidden" name="no_gol" value="0" />
        <input type="hidden" name="sys_hot" value="0" />
        <input type="hidden" name="sal" value="1397" />
        <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="com_alert" value="<?php echo  $com_alert ;?>" />
 </form>
   <script type="text/javascript">document.myform1.submit();</script> 