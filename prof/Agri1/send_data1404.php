<?php 
include("../../lock_p1.php");
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
if(isset($_POST['Go_send_data'])){
    $idArr = $_POST['checked_id'];
     $mor_cod_m = $_POST['mor_cod_m'] ; 
    $bah_cod_m =$_POST['bah_cod_m'] ; 
    $query = "SELECT num_bah,id,mor_cod_m,no_mal,bah_cod_m,add_abadi,add_city,sh_gat,z_sal,no_kesh,m_zamin,id_ostan,
	id_city,t_mah,check_cod from 
	`Agri1403_1404` where  bah_cod_m = :bah_cod_m  and mor_cod_m = :mor_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':mor_cod_m'=>$login_session));
$found = $stmt -> rowCount();
    if ($found>0) {
         $com_alert = 'خطا : \n \n برای بهره بردار قبلا اطلاعات زراعی 1404-1403 ثبت شده است' ;
    }
else 
{
	foreach($idArr as $id){
$query ="CREATE TEMPORARY TABLE tmp$id SELECT * FROM `Agri1402_1403` WHERE bah_cod_m=:bah_cod_m and mor_cod_m = :mor_cod_m and id=:id" ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':mor_cod_m'=>$mor_cod_m,':id'=>$id));
$query = "update tmp$id set date_s = :date_s ,id = '',z_sal='1403-1404',t_mah=0,s_ayesh=0 where bah_cod_m = :bah_cod_m and mor_cod_m = :mor_cod_m ";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':date_s'=>$date_edit,':bah_cod_m'=>$bah_cod_m,':mor_cod_m'=>$mor_cod_m));
$query = "INSERT INTO `Agri1403_1404` SELECT * FROM tmp$id" ;  	
$stmt = $dbh->prepare($query);
$stmt->execute();
//
//
	//sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','حذف پیام دریافتی از/ '.user_name($s_user)) ; 
 }
         sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','انتقال اطلاعات پایه زراعی 1403-1402 / '.$bah_cod_m,$id_ostan) ; 
	     $com_alert = 'اطلاعات با موفقیت ارسال شد.   \n \n اکنون می توانید نسبت به ویرایش اطلاعات 1404-1403 اقدام فرمایید ';
 }
 }
unset($date_edit,$city,$cod_m_session,$date_edit,$e,$euser,$found,$id,$id_city,$id_mar,$id_ostan,$idArr,$karbar_m,$markaz,$mor_cod_m,$name,$no_karbar,$ostan,$pic,$query,$row,$stmt,$time,$title,$user,$v_jen) ;

 ?>
 <form name="myform1" class="myform" method="post" action="liste_Agri.php#1">
        <input type="hidden" name="z_sal" value="1403-1404" />
        <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
        <input type="hidden" name="action_lise" value="1" />
        <input type="hidden" name="com_alert" value="<?php echo  $com_alert ;?>" />
        <input type="hidden" name="t_mah" value="-1" />
        <input type="hidden" name="action_lise" value="1" />
 </form>
   <script type="text/javascript">document.myform1.submit();</script> 