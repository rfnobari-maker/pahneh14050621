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
    $query = "SELECT num_bah,id,mor_cod_m,no_mal,bah_cod_m,add_abadi,add_city,sh_gat,z_sal,no_kesh,m_zamin,id_ostan,id_city,t_mah,check_cod from Garden where  bah_cod_m = :bah_cod_m and z_sal= :z_sal and mor_cod_m = :mor_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':z_sal'=>'1397',':mor_cod_m'=>$login_session));
$found = $stmt -> rowCount();
    if ($found>0) {
         $com_alert = 'خطا : \n \n برای بهره بردار قبلا اطلاعات  97  ثبت شده است' ;
    }
else 
{
foreach($idArr as $id){
//alert($id) ; 
$query ="CREATE TEMPORARY TABLE tmp$id SELECT * FROM Garden_prod WHERE bah_cod_m=:bah_cod_m and z_sal = :z_sal and mor_cod_m = :mor_cod_m and Garden_id=:Garden_id " ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':z_sal'=>'1396',':mor_cod_m'=>$mor_cod_m,':Garden_id'=>$id));
$query = "update tmp$id set date_s = :date_s ,id = '',Garden_id = '', z_sal='1397' , mah_tol=0 , mah_tolp=0  where bah_cod_m = :bah_cod_m and mor_cod_m = :mor_cod_m ";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':date_s'=>$date_edit,':bah_cod_m'=>$bah_cod_m,':mor_cod_m'=>$mor_cod_m));
$query = "INSERT INTO Garden_prod SELECT * FROM tmp$id" ;  	
$stmt = $dbh->prepare($query);
$stmt->execute();

$query ="CREATE TEMPORARY TABLE Garden$id SELECT * FROM Garden WHERE bah_cod_m=:bah_cod_m and z_sal = :z_sal and mor_cod_m = :mor_cod_m and id=:id" ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':z_sal'=>'1396',':mor_cod_m'=>$mor_cod_m,':id'=>$id));
$query = "update Garden$id set date_s = :date_s ,id = '',z_sal='1397' where bah_cod_m = :bah_cod_m and mor_cod_m = :mor_cod_m ";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':date_s'=>$date_edit,':bah_cod_m'=>$bah_cod_m,':mor_cod_m'=>$mor_cod_m));
$query = "INSERT INTO Garden SELECT * FROM Garden$id" ;  	
$stmt = $dbh->prepare($query);
$stmt->execute();
	//sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','حذف پیام دریافتی از/ '.user_name($s_user)) ; 
 }
// update Garden_id
//alert($bah_cod_m) ;
//alert($mor_cod_m) ;
$query = "SELECT id,sh_gat,check_cod from Garden where bah_cod_m=:bah_cod_m and z_sal = :z_sal and mor_cod_m = :mor_cod_m  "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':z_sal'=>'1397',':mor_cod_m'=>$mor_cod_m));
foreach($stmt as $row){
$id = $row['id'] ;
$sh_gat = $row['sh_gat'] ;
$check_cod = $row['check_cod'] ;
//alert($sh_gat) ;
$query = "UPDATE Garden_prod SET Garden_id=? WHERE bah_cod_m=? and sh_gat =? and check_cod = ? and z_sal='1397' and mor_cod_m=? and Garden_id = 0 ";
$q = $dbh->prepare($query);
$q->execute(array($id,$bah_cod_m,$sh_gat,$check_cod,$mor_cod_m));
}
//
         sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','انتقال اطلاعات پایه باغی - '.$bah_cod_m,$id_ostan) ; 
	     $com_alert = 'اطلاعات با موفقیت ارسال شد.   \n \n اکنون می توانید نسبت به ویرایش اطلاعات 97  اقدام فرمایید ';
 }
 }
 unset($date_edit,$city,$cod_m_session,$date_edit,$e,$euser,$found,$id,$id_city,$id_mar,$id_ostan,$idArr,$karbar_m,$markaz,$mor_cod_m,$name,$no_karbar,$ostan,$pic,$query,$row,$stmt,$time,$title,$user,$v_jen) ;

 ?>
<form name="myform1" class="myform" method="post" action="liste_Garden.php#1">
        <input type="hidden" name="z_sal" value="1397" />
        <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
        <input type="hidden" name="action_lise" value="1" />
        <input type="hidden" name="com_alert" value="<?php echo  $com_alert ;?>" />
 </form>
   <script type="text/javascript">document.myform1.submit();</script> 