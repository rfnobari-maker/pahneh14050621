<?php
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

function check_id($id)
{
$webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
$Username = "test";
$Password = "test";
$type= 0 ; 
$year= 1401 ;

	$client = new SoapClient($webservice_url);
	$res = $client->CheckEditorDeletePermission(array(
	 "Username"   => $Username ,
	 "Password"   => $Password ,
	 "type" => $type ,
     "year" => $year ,
	 "AreaID" => $id));
	$chech_result = $res->CheckEditorDeletePermissionResult->EditPermission ;
	return $chech_result  ; 
}
function check_product($id)
{
$webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
$Username = "test";
$Password = "test";
$type= 0 ; 
$year= 1401 ;

	$client = new SoapClient($webservice_url);
	$res = $client->CheckEditorDeletePermission(array(
	 "Username"   => $Username ,
	 "Password"   => $Password ,
	 "type" => $type ,
     "year" => $year ,
	 "AreaID" => $id));
	$chech_result = $res->CheckEditorDeletePermissionResult->product ;
	return $chech_result  ; 
}
function center_username($id_ostan,$id_mar)
{
include('login/config.php');
$query = "SELECT username from users where id_ostan = '$id_ostan' and id_mar = '$id_mar' and S_Access = '2'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['username'] ;
// clos conntection 
$dbh = null;
}

function Abadi_tbah_count($add_abadi)
{
include('login/config.php');
 $query = "SELECT count(*) from bah where add_abadi = '$add_abadi'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
 function Abadi_agri_count($add_abadi,$table)
{
include('login/config.php');
 $query = "SELECT count(*) from $table where add_abadi = '$add_abadi'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function Abadi_vege_count($add_abadi,$sal)
{
include('login/config.php');
 $query = "SELECT count(*) from Vege where add_abadi = '$add_abadi'  and z_sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}

function Abadi_garden_count($add_abadi,$sal)
{
include('login/config.php');
 $query = "SELECT count(*) from Garden where add_abadi = '$add_abadi'  and z_sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function Abadi_Mushroom_count($add_abadi,$sal)
{
include('login/config.php');
 $query = "SELECT count(*) from Mushroom_prod where add_abadi = '$add_abadi'  and y_prod = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function Abadi_Greenhous_count($add_abadi,$y_prod)
{
include('login/config.php');
 $query = "SELECT count(*) from Greenhous_prod where add_abadi = '$add_abadi'  and y_prod = '$y_prod' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function Abadi_bee_count($add_abadi,$sal)
{
include('login/config.php');
  $query = "SELECT count(*) from bee where add_abadi = '$add_abadi'  and sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function Abadi_Aquatic_count($add_abadi,$sal)
{
include('login/config.php');
 $query = "SELECT count(*) from Aquatic where add_abadi = '$add_abadi'  and sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}

// شمارش تعداد روزهای کشتار
function slau_for_day($for_days){
	require_once('Jalali.php');
	include ('login/config.php') ;
	$sql = "DELETE FROM samasat_for_day WHERE 1";
    $stmt =  $dbh->prepare($sql);
    $stmt->bindParam( PDO::PARAM_INT);   
    $stmt->execute();
	
$xy = 1;
do {
 $date_check_E =  date('Y-m-d',time()+($xy*86400)) ;
 $date_check_F =  jdate('Y/m/d',time()+($xy*86400)) ;
 $date_check_name_E =  date('l',time()+($xy*86400)) ;
 $date_check_name_F =  jdate('l',time()+($xy*86400)) ;
$query = "INSERT INTO samasat_for_day(date_check_E,date_check_F,date_check_name_E,date_check_name_F) 
           VALUES (:date_check_E,:date_check_F,:date_check_name_E,:date_check_name_F)";
    $q = $dbh->prepare($query);
    $q->execute(array(':date_check_E'=>$date_check_E,':date_check_F'=>$date_check_F,':date_check_name_E'=>$date_check_name_E,':date_check_name_F'=>$date_check_name_F));
	  $xy++;
} while ($xy <= $for_days+10); // 10 روز اضافه کردم که بعد بتونم 5 شنبه ها را راحت حذف کنم
$date_check_name_E = 'Thursday'	; // 5 شنبه ها را حذف میکنه
$sql = "DELETE FROM samasat_for_day WHERE date_check_name_E =  :date_check_name_E";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':date_check_name_E', $date_check_name_E, PDO::PARAM_INT);   
$stmt->execute();

$query = "SELECT * from samasat_for_day";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_row = $stmt -> rowCount(); // تعداد موجود را شمارش میکنه 
$limit = $count_row-$for_days ;  // محاسبه محدودیت 
	$sql = "DELETE FROM samasat_for_day WHERE 1 order by date_check_E DESC limit $limit "; // تعداد روز های اضافه را حذف میکنه
    $stmt =  $dbh->prepare($sql);
    $stmt->bindParam( PDO::PARAM_INT);   
    $stmt->execute();

$query = "SELECT date_check_E from samasat_for_day where 1   " ; // محاسبه تفاوت هر روز با روز جاری 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$time2 = $row['date_check_E'] ; 
$time1 = date("Y-m-d");
  $x_days = strtotime($time2) - strtotime($time1);
  $x_days = round($x_days / 86400,0,1);
$query = "UPDATE samasat_for_day SET x_days = $x_days  where date_check_E = '$time2' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
}

 $query = "SELECT max(x_days) as diff  FROM samasat_for_day  WHERE 1 ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$diff= $row['diff'] ; 
return $diff ;  // محاسبه کل روز ها 


}

// سن گله به روز 
function age_day($date){
require_once('Jalali.php');
$time2 = date("Y/m/d");
$arr_parts = explode('/', $date);
 $jYear  = $arr_parts[0];
 $jMonth = $arr_parts[1];
 $jDay   = $arr_parts[2];
 $time1   = jalali_to_gregorian($jYear, $jMonth, $jDay);
 $time3 = $time1[0].'-'.$time1[1].'-'.$time1[2] ; 
    $diff = strtotime($time2) - strtotime($time3);
    return round($diff / 86400,0,1);
}
// تاریخ آخرین بازدید
function last_log($username)
{
include ('../login/config.php') ;
$query = "SELECT max(date) as last_log from Last_user WHERE PersCode = '$username' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$last_login = $row['last_log'] ; 
return $last_login ;
$dbh = null;
}
// استعلام کد محصول  از خرید تضمینی 
function e_cod_mah($bah_cod_m,$id_ostan,$id_city,$num_bah,$cod_mah)
{
include ('../../login/config.php') ;
$query = "SELECT count(*) from Agri_prod1399 WHERE
 bah_cod_m = '$bah_cod_m' and 
 id_ostan  = '$id_ostan'  and
 id_city   = '$id_city'   and 
 num_bah   = '$num_bah'   and 
 cod_mah   = '$cod_mah'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$e_result = $stmt->fetchColumn();
return $e_result ;
$dbh = null;
}
function kol_zk_108($bah_cod_m,$id_ostan,$num_bah)
{
include ('../login/config.php') ;
$query = "SELECT (sum(zer_kesht_a)+sum(zer_kesht_b)) as kol_zk FROM Agri_prod WHERE 
  cod_mah = '108' AND z_sal = '1395-1396' and id_ostan = '$id_ostan' and bah_cod_m = '$bah_cod_m'
  and num_bah = '$num_bah'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['kol_zk'] ;
$dbh = null;
}
function kol_pt_108($bah_cod_m,$id_ostan,$num_bah)
{
include ('../login/config.php') ;
$query = "SELECT sum(mah_tolp) as kol_pt FROM Agri_prod WHERE 
  cod_mah = '108' AND z_sal = '1395-1396' and id_ostan = '$id_ostan' and bah_cod_m = '$bah_cod_m'
 and num_bah = '$num_bah'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['kol_pt'] ;
$dbh = null;
}
function edit_180($date_s,$bah_cod_m)
{
include ('../login/config.php') ;
$query = "UPDATE Agri_prod SET date_s = '$date_s' WHERE z_sal = '1395-1396' and bah_cod_m = '$bah_cod_m' and cod_mah = '108'";
$q = $dbh->prepare($query);
$q->execute();
$dbh = null;
}
function edit_180_1($date_s,$bah_cod_m)
{
include ('../../login/config.php') ;
$query = "UPDATE Agri_prod SET date_s = '$date_s' WHERE z_sal = '1395-1396' and bah_cod_m = '$bah_cod_m' and cod_mah = '108'";
$q = $dbh->prepare($query);
$q->execute();
$dbh = null;
}
function bank_account5($bah_cod_m,$num_bah)
{
include('login/config.php');
$query = "SELECT bank_account from bah where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['bank_account'] ;
// clos conntection 
$dbh = null;
}
function bah_fname($bah_cod_m)
{
include('login/config.php');
$query = "SELECT fname from bah where bah_cod_m = '$bah_cod_m'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['fname'] ;
// clos conntection 
$dbh = null;
}
function bah_name2($bah_cod_m,$num_bah)
{
include('login/config.php');
$query = "SELECT name,Last_name from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['Last_name'].'&nbsp;'.$row['name']; 
// clos conntection 
$dbh = null;
}
function bah_vaz($bah_cod_m)
{
include('login/config.php');
$query = "SELECT ok from bah where bah_cod_m = '$bah_cod_m'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['ok']; 
// clos conntection 
$dbh = null;
}

function m_name($m_cod_m)
{
include('login/config.php');
$query = "SELECT m_name,m_last_name from malek where m_cod_m = '$m_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['m_last_name'].'&nbsp;'.$row['m_name']; 
// clos conntection 
$dbh = null;
}

function abadi_name($add_abadi)
{
include('login/config.php');
$query = "SELECT abadi,add_abadi from list_abadi where add_abadi = '$add_abadi' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['abadi'];
// clos conntection 
$dbh = null;
}
function abadi_name_id($id_abadi)
{
include('login/config.php');
$query = "SELECT abadi from public_abadi4 where id_abadi = '$id_abadi' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['abadi'];
// clos conntection 
$dbh = null;
}
function bakh_name($id_ostan,$id_city,$id_bakh)
{
include('login/config.php');
$query = "SELECT bakh from bakhname where id_ostan='$id_ostan' and id_city='$id_city' and id_bakh='$id_bakh' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['bakh'];
// clos conntection 
$dbh = null;
}

function city_name1($id_city,$id_ostan)
{
include('login/config.php');
$query = "SELECT city from cityname  where id_city = '$id_city' and id_ostan = '$id_ostan' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['city']; 
// clos conntection 
$dbh = null;
}
function sabt_event($username,$ip,$date,$time,$add_abadi,$verb,$id_ostan) {
include('login/config.php');
$query = "INSERT INTO log (username,ip,date,time,add_abadi,verb,id_ostan) VALUES (:username,:ip,:date,:time,:add_abadi,:verb,:id_ostan)";
$q = $dbh->prepare($query);
$q->execute(array(':username'=>$username,':ip'=>$ip,':date'=>$date,':time'=>$time,':add_abadi'=>$add_abadi,':verb'=>$verb,
':id_ostan'=>$id_ostan));
// clos conntection 
$dbh = null;
}
function user_name($username)
{
include('login/config.php');
$query = "SELECT name,Last_name from users where username = '$username' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['Last_name'].'-'.$row['name']; 
// clos conntection 
$dbh = null;
}
function user_name1($cod_m)
{
include('login/config.php');
$query = "SELECT name,Last_name from users where cod_m = '$cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['Last_name'].'&nbsp;'.$row['name']; 
// clos conntection 
$dbh = null;
}
function user_tel($username)
{
include('login/config.php');
$query = "SELECT tel_m from users where username = '$username' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['tel_m']; 
// clos conntection 
$dbh = null;
}
function bah_name($bah_cod_m)
{
include('login/config.php');
$query = "SELECT name,Last_name from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['Last_name'].'&nbsp;'.$row['name']; 
// clos conntection 
$dbh = null;
}
function bah_first_name($bah_cod_m)
{
include('login/config.php');
$query = "SELECT name from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['name']; 
// clos conntection 
$dbh = null;
}
function bah_last_name($bah_cod_m)
{
include('login/config.php');
$query = "SELECT Last_name from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['Last_name']; 
// clos conntection 
$dbh = null;
}

function user_pic($username)
{
include('login/config.php');
$query = "SELECT pic from users where username = '$username' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$pic_name =  $row['pic'] ;
if ($pic_name == '') $pic_name = 'no_pic.png' ;
return $pic_name ; 
$dbh = null;
}
function shahr_name($add_city)
{
include('login/config.php');
$query = "SELECT shahr from list_city where add_city = '$add_city' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['shahr']; 
// clos conntection 
$dbh = null;
}
function ostan_name($id_ostan)
{
include('login/config.php');
$query = "SELECT ostan from ostanname where id_ostan = '$id_ostan' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['ostan']; 
$dbh = null;
}
function mar_name($id_mar)
{
include('login/config.php');
$query = "SELECT mar from mar where id_mar = '$id_mar' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['mar']; 
// clos conntection 
$dbh = null;
}
function mar_name1($id_mar,$id_ostan)
{
include('login/config.php');
$query = "SELECT mar from mar where id_ostan ='$id_ostan' and id_mar = '$id_mar' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['mar']; 
// clos conntection 
$dbh = null;
}
function alert($string)
{
    echo '<script type="text/javascript">alert("' . $string . '");</script>';
}
function sar_data($bah_cod_m)
{
include('../../login/config.php');
$query = "SELECT * from bah where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_s= $row['city_s'] ; 
$mor_cod_m = $row['mor_cod_m'] ; 
$no_bah = $row['no_bah']; 
$bah_cod_m = $row['bah_cod_m']; 
$bah_jens= $row['jens']; 
$bah_name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$sh_sh   = $row['sh_sh']; 
$m_sod   = $row['m_sod']; 
$fname   = $row['fname']; 
$m_tah   = $row['m_tah']; 
$er_mtah = $row['er_mtah'];
$tel_s   = $row['tel_s']; 
$tel_m  = $row['tel_m']; 
$ostan_s  = $row['ostan_s'] ;
$shahr_s  = $row['shahr_s'] ;
$city_s   =  $row['city_s'] ;
$rosta_s  = $row['rosta_s'] ;
$co_name  = $row['co_name'] ;
$no_co  = $row['no_co'] ;
$sh_meli  = $row['sh_meli'] ;
$co_sabt  = $row['co_sabt'] ;
$add_city = $row['add_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$id_mar = $row['id_mar'] ;
$add_abadi = $row['add_abadi'] ;
// clos conntection 
$dbh = null;
?>
<table style="border:3px solid #069;" width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
 <?php  if ($no_bah=='1') { ?>
  <td height="27" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی</strong></div></td>
   </tr>
   <tr>
     <td width="370" height="30"><div align="right">
       <?php echo city_name1($id_city,$id_ostan) ?>
     </div></td>
     <td width="152"><div align="right">:شهرستان</div></td>
     <td>&nbsp;</td>
     <td width="207"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td width="172"><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
<?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $last_name ; ?></div></td>
     <td><div align="right">:نام خانوادگی</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $bah_name ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $sh_sh ; ?></div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td width="91">&nbsp;</td>
     <td><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td width="91">&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
 <?php }  if ($no_bah=='2') { ?>
     <td height="24" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی</strong></div></td>
   </tr>
   <tr>
     <td width="370" height="30"><div align="right"> <?php echo city_name($id_city) ?> </div></td>
     <td width="152"><div align="right">:شهرستان</div></td>
     <td>&nbsp;</td>
     <td width="207"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td><div align="right">:کد ملی مدیر عامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $co_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام شرکت</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $last_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $bah_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
    <?php  }?>
 </table>
<?php } function sar_data2($bah_cod_m,$num_bah)
{
include('../../login/config.php');
$query = "SELECT city_s,mor_cod_m,no_bah,bah_cod_m,jens,name,last_name,date_t,sh_sh,m_sod,fname,m_tah,er_mtah,tel_s,tel_m,ostan_s,shahr_s,city_s,rosta_s,co_name,no_co,sh_meli,co_sabt,add_city,id_ostan,id_city,id_mar,add_abadi from bah where  bah_cod_m = :bah_cod_m and num_bah=:num_bah" ; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_s= $row['city_s'] ; 
$mor_cod_m = $row['mor_cod_m'] ; 
$no_bah = $row['no_bah']; 
$bah_cod_m = $row['bah_cod_m']; 
$bah_jens= $row['jens']; 
$bah_name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$sh_sh   = $row['sh_sh']; 
$m_sod   = $row['m_sod']; 
$fname   = $row['fname']; 
$m_tah   = $row['m_tah']; 
$er_mtah = $row['er_mtah'];
$tel_s   = $row['tel_s']; 
$tel_m  = $row['tel_m']; 
$ostan_s  = $row['ostan_s'] ;
$shahr_s  = $row['shahr_s'] ;
$city_s   =  $row['city_s'] ;
$rosta_s  = $row['rosta_s'] ;
$co_name  = $row['co_name'] ;
$no_co  = $row['no_co'] ;
$sh_meli  = $row['sh_meli'] ;
$co_sabt  = $row['co_sabt'] ;
$add_city = $row['add_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$id_mar = $row['id_mar'] ;
$add_abadi = $row['add_abadi'] ;
// clos conntection 
$dbh = null;
?>
<table style="border:3px solid #069; margin-top:-10px" width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFCC" s >
   <tr>
 <?php  if ($no_bah=='1') { ?>
  <td height="22" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی</strong></div></td>
   </tr>
   <tr>
     <td width="179" height="30"><div align="right">
     <?php echo city_name1($id_city,$id_ostan) ?>
     </div></td>
     <td width="208"><div align="right">:شهرستان</div></td>
     <td>&nbsp;</td>
     <td width="179"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td width="334"><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right">
<?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
<?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $last_name ; ?></div></td>
     <td><div align="right">:نام خانوادگی</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $bah_name ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $sh_sh ; ?></div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td width="60">&nbsp;</td>
     <td><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td width="60">&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
 <?php }  if ($no_bah=='2') { ?>
     <td height="22" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی</strong></div></td>
   </tr>
   <tr>
     <td width="179" height="30"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?> </div></td>
     <td width="208"><div align="right">:شهرستان</div></td>
     <td>&nbsp;</td>
     <td width="179"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"> <?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td><div align="right">:کدملی مدیر عامل</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $co_name; ?><br>
     <?php echo $sh_meli ; ?>     </div></td>
     <td><div style="margin-right:30px" align="right">: نام شرکت/ شناسه ملی شرکت</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $last_name ; ?></div></td>
     <td><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $bah_name ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: نام مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >: تلفن ثابت</div></td>
   </tr>
    <?php  }?>
</table>
<?php } function sar_ind_data($NationalCode,$no_bah)
{
include('../../login/config.php');
$query = "SELECT * from ind_bah where  NationalCode = :NationalCode and no_bah=:no_bah" ; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':NationalCode'=>$NationalCode,':no_bah'=>$no_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$mor_cod_m = $row['mor_cod_m'] ; 
$no_bah = $row['no_bah']; 
$NationalCode = $row['NationalCode']; 
$bah_jens= $row['jens']; 
$bah_name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$sh_sh   = $row['sh_sh']; 
$fname   = $row['fname']; 
$m_tah   = $row['m_tah']; 
$r_tah = $row['r_tah'];
$tel_s   = $row['tel_s']; 
$tel_m  = $row['tel_m']; 
$co_name  = $row['co_name'] ;
$c_f_name  = $row['c_f_name'] ;
$c_l_name  = $row['c_l_name'] ;
$c_cod_m  = $row['c_cod_m'] ;

$no_co  = $row['no_co'] ;
$co_sabt  = $row['co_sabt'] ;
$add_city = $row['add_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$id_mar = $row['id_mar'] ;
$add_abadi = $row['add_abadi'] ;
// clos conntection 
$dbh = null;
?>
<table  width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFCC" s >
   <tr>
 <?php  if ($no_bah=='1') { ?>
  <td height="22" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی صنایع کشاورزی</strong></div></td>
   </tr>
   <tr>
     <td width="179" height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $last_name ; ?></div></td>
     <td width="208" bgcolor="#FFFFFF"><div align="right">:نام خانوادگی</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td width="179" bgcolor="#FFFFFF"><div align="right"><?php echo $bah_name ; ?></div></td>
     <td width="334" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $sh_sh ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">:شماره شناسنامه</div></td>
     <td width="60" bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $NationalCode; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">:شماره همراه</div></td>
     <td width="60" bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $tel_s ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
 <?php }  if ($no_bah=='2') { ?>
     <td height="22" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی صنایع کشاورزی</strong></div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $c_cod_m ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">:کدملی مدیر عامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $co_name ; ?><br>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام شرکت</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $c_f_name,$c_l_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $NationalCode; ?><br>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: شناسه ملی </div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">:شماره همراه</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $tel_s ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >: تلفن ثابت</div></td>
   </tr>
    <?php  }?>
</table>
<?php } function bah_m_tah($bah_cod_m)
{
include('login/config.php');
$query = "SELECT m_tah from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['m_tah']; 
// clos conntection 
$dbh = null;
}
function bah_tel_m($bah_cod_m)
{
include('login/config.php');
$query = "SELECT tel_m from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['tel_m']; 
// clos conntection 
$dbh = null;
}
function bah_date_t($bah_cod_m)
{
include('login/config.php');
$query = "SELECT date_t from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['date_t']; 
// clos conntection 
$dbh = null;
}

function edit_database_abadi($id_mar,$mor_cod_m,$id_abadi,$add_abadi)
{
include ('login/config.php') ;
$query = "UPDATE bah SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi' ";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE bee SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE unknown_bee SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Agri1397_1398 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1398_1399 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1399_1400 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1400_1401 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1401_1402 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1402_1403 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1403_1404 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();


$query = "UPDATE Garden SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Garden_prod SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();


$query = "UPDATE Agri_prod1397_1398 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1398_1399 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1399_1400 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1400_1401 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1401_1402 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1402_1403 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1403_1404 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();


$query = "UPDATE Aquatic SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Greenhous SET id_mar='$id_mar', mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Greenhous_prod SET id_mar='$id_mar', mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Greenprod_annual SET id_mar='$id_mar', mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Mushroom SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Mushroom_prod SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Vege SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Vege_prod SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE add_abadi = '$add_abadi'";
$q = $dbh->prepare($query);
$q->execute();
$dbh = null;
}
function edit_database_city($id_mar,$mor_cod_m,$add_city)
{
include ('login/config.php') ;
$query = "UPDATE bah SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));

$query = "UPDATE bee SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));

$query = "UPDATE Aquatic SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE unknown_bee SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri1397_1398 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri1398_1399 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri1399_1400 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri1400_1401 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri1401_1402 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri1402_1403 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri1403_1404 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));


$query = "UPDATE Agri_prod1397_1398 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri_prod1398_1399 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri_prod1399_1400 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri_prod1400_1401 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri_prod1401_1402 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri_prod1402_1403 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri_prod1403_1404 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));

$query = "UPDATE Garden SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Garden_prod SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Greenhous SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));

$query = "UPDATE Greenhous_prod SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));

$query = "UPDATE Greenprod_annual SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));

$query = "UPDATE Mushroom SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Mushroom_prod SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Vege SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Vege_prod SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$dbh = null;
}
function city_aria($id_ostan,$id_city)
{
include('login/config.php');
$query = "SELECT id_aria from aria where id_ostan = '$id_ostan' and id_city = '$id_city' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['id_aria']; 
$dbh = null;
}
function  S_access($username)
{
include('login/config.php');
$query = "SELECT S_access from users where username = '$username' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$S_access =  $row['S_access'] ;
return $S_access ; 
$dbh = null;
}

function mah_name_amar($cod_mah)
{
include('../../login/config.php');
$query = "SELECT product_name from product_z_amar  where  product_cod_amar = :product_cod_amar"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':product_cod_amar'=>$cod_mah));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$product_name = $row['product_name'] ;
return $product_name ;
$dbh = null;
}

function mah_name($cod_mah)
{
include('../../login/config.php');
$query = "SELECT product_name from product_z  where  product_cod = :product_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':product_cod'=>$cod_mah));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$product_name = $row['product_name'] ;
return $product_name ;
$dbh = null;
}

function group_name_amar($cod_qroup)
{
include('../../login/config.php');
$query = "SELECT group_cod,group_name from product_z_amar  where  group_cod = :group_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':group_cod'=>$cod_qroup));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$group_name = $row['group_name'] ;
return $group_name ;
$dbh = null;
}

function group_name($cod_qroup)
{
include('../../login/config.php');
$query = "SELECT group_cod,group_name from product_z  where  group_cod = :group_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':group_cod'=>$cod_qroup));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$group_name = $row['group_name'] ;
return $group_name ;
$dbh = null;
}

function group_name_green($group_cod)
{
include('../../login/config.php');
$query = "SELECT group_cod,group_name from product_G  where  group_cod = :group_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':group_cod'=>$group_cod));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$group_name = $row['group_name'] ;
return $group_name ;
$dbh = null;
}


function mah_name_green($mah_cod)
{
include('../../login/config.php');
$query = "SELECT mah_name from product_G  where  mah_cod = :mah_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mah_cod'=>$mah_cod));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$mah_name = $row['mah_name'] ;
return $mah_name ;
$dbh = null;
}

function mah_name_bagh($cod_mah)
{
include('../../login/config.php');
$query = "SELECT product_name from product_b  where  product_cod = :product_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':product_cod'=>$cod_mah));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$product_name = $row['product_name'] ;
return $product_name ;
$dbh = null;
}
function mah_name_bagh_amar($cod_mah)
{
include('../../login/config.php');
$query = "SELECT product_name from product_b_amar  where  product_cod = :product_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':product_cod'=>$cod_mah));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$product_name = $row['product_name'] ;
return $product_name ;
$dbh = null;
}

function redirect($url){
     if (!headers_sent()){
         header('Location: '.$url); exit;
     }else{
         echo '<script type="text/javascript">';
         echo 'window.location.href="'.$url.'";';
         echo '</script>';
         echo '<noscript>';
         echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
         echo '</noscript>'; exit;
     }
 }
 function user_mfa($username)
{
include('login/config.php');
$query = "SELECT ostan,city,markaz from users where username = '$username' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['ostan'].'/'.$row['city'].'/'.$row['markaz']; 
// clos conntection 
$dbh = null;
}
function sar_data3($bah_cod_m,$num_bah)
{
include('../../../login/config.php');
$query = "SELECT bah_cod_m,jens,name,last_name,date_t,sh_sh,m_sod,fname,m_tah,er_mtah,tel_s,tel_m from bah where  bah_cod_m = :bah_cod_m and num_bah=:num_bah" ; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$bah_cod_m = $row['bah_cod_m']; 
$bah_jens= $row['jens']; 
$bah_name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$sh_sh   = $row['sh_sh']; 
$m_sod   = $row['m_sod']; 
$fname   = $row['fname']; 
$m_tah   = $row['m_tah']; 
$er_mtah = $row['er_mtah'];
$tel_s   = $row['tel_s']; 
$tel_m  = $row['tel_m']; 
// clos conntection 
$dbh = null;
?> 
	    
 <table style="border:3px solid #069;" width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>

  <td height="30" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات فردی مددکار</strong></div></td>
   </tr>
   <tr>
     <td width="429" height="30"><div align="right"><?php echo $last_name ; ?></div></td>
     <td width="191" class="style8"><div align="right">:نام خانوادگی</div></td>
     <td>&nbsp;</td>
     <td width="350"><div align="right"><?php echo $bah_name ; ?></div></td>
     <td width="180" class="style8"><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $sh_sh ; ?></div></td>
     <td class="style8"><div align="right">:شماره شناسنامه</div></td>
     <td width="108">&nbsp;</td>
     <td><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td class="style8"><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td class="style8"><div align="right">:شماره همراه</div></td>
     <td width="108">&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td class="style8"><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $fname ; ?></div></td>
     <td class="style8"><div align="right">:نام پدر</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $date_t ; ?></div></td>
     <td class="style8"><div style="margin-right:30px" align="right" >:تاریخ تولد </div></td>
   </tr>
</table>
<?php }function bah_count($bah_cod_m)
{
include('login/config.php');
$query = "SELECT count(*) from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt -> fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function bah_ind_unit_count($bah_cod_m,$num_bah)
{
include('login/config.php');
$query = "SELECT count(*) from ind_unit where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function bah_ind_prod_count($bah_cod_m,$num_bah)
{
include('login/config.php');
$query = "SELECT count(*) from ind_prod where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function ind_unit_prod_count($unit_id)
{
include('login/config.php');
$query = "SELECT count(*) from ind_unit_info where unit_id = '$unit_id'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function bah_agri_count($bah_cod_m,$num_bah,$table)
{
include('login/config.php');
$query = "SELECT count(*) from $table where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function bah_vege_count($bah_cod_m,$num_bah,$sal)
{
include('login/config.php');
 $query = "SELECT count(*) from Vege where bah_cod_m = '$bah_cod_m' and no_bah = '$num_bah' and z_sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}

function bah_garden_count($bah_cod_m,$num_bah,$sal)
{
include('login/config.php');
 $query = "SELECT count(*) from Garden where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and z_sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function bah_Mushroom_count($bah_cod_m,$num_bah,$sal)
{
include('login/config.php');
 $query = "SELECT count(*) from Mushroom_prod where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and y_prod = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function bah_Greenhous_count($bah_cod_m,$num_bah,$y_prod)
{
include('login/config.php');
 $query = "SELECT count(*) from Greenhous_prod where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and y_prod = '$y_prod' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function bah_Greenhous_count_mor($bah_cod_m)
{
include('login/config.php');
 $query = "SELECT count(*) from Greenhousn where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and y_prod = '$y_prod' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}

function bah_bee_count($bah_cod_m,$num_bah,$sal)
{
include('login/config.php');
  $query = "SELECT count(*) from bee where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function bah_eworker_count($bah_cod_m)
{
include('login/config.php');
$query = "SELECT count(*) from Eworker where cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function bah_Aquatic_count($bah_cod_m,$num_bah,$sal)
{
include('login/config.php');
 $query = "SELECT count(*) from Aquatic where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}

// میزان حداکثر تولید زراعی / مترمربع
function mht_z($cod_mah,$m_sb,$no_kesh)
{
include('login/config.php');
$query = "SELECT ht_ab,ht_dem from ht_z where cod_mah = '$cod_mah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$rcount = $stmt -> rowCount();
if ($rcount > 0) {
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($no_kesh == '1') $sh_ht = $row['ht_ab'] ;
if ($no_kesh == '2') $sh_ht = $row['ht_dem'] ;
}
else 
{
$sh_ht = 299 ; 
// اگر حداکثر تولید برای یک محصول وارد نشده باشد حداکثر تولید آن را 299 تن در هکتار قبول کن
}
$m_ht = $m_sb * $sh_ht ;
return  $m_ht ;
// clos conntection 
$dbh = null;
}
// حداکثر تولید گلخانه
function mht_G($mah_cod,$m_sk)
{
include('login/config.php');
$query = "SELECT ht from product_G where mah_cod = '$mah_cod' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$rcount = $stmt -> rowCount();
if ($rcount > 0) {
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sh_ht = $row['ht'] ;
}
else 
{
$sh_ht = 299 ; 
// اگر حداکثر تولید برای یک محصول وارد نشده باشد حداکثر تولید آن را 299 تن در هکتار قبول کن
}
$m_ht = $m_sk * $sh_ht ;
return  $m_ht ;
// clos conntection 
$dbh = null;
}

// میزان حداکثر تولید باغی / هکتار
function mht_b($cod_mah,$m_sb,$no_kesh)
{
include('login/config.php');
$query = "SELECT ht_ab,ht_dem from ht_b where cod_mah = '$cod_mah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$rcount = $stmt -> rowCount();
if ($rcount > 0) {
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($no_kesh == '1') $sh_ht = $row['ht_ab'] ;
if ($no_kesh == '2') $sh_ht = $row['ht_dem'] ;
}
else 
{
$sh_ht = 299 ; 
// اگر حداکثر تولید برای یک محصول وارد نشده باشد حداکثر تولید آن را 299 تن در هکتار قبول کن
}
$m_ht = $m_sb * $sh_ht ;
return  $m_ht ;
// clos conntection 
$dbh = null;
}
// میزان حداکثر تولید زراعی / هکتار
function V_mht($cod_mah,$m_sb)
{
include('login/config.php');
$query = "SELECT ht_ab,ht_dem from ht_z where cod_mah = '$cod_mah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sh_ht = $row['ht_ab'] ;
$m_ht = ($m_sb ) * $sh_ht ;
return  $m_ht ;
// clos conntection 
$dbh = null;
}
function Agri_id2($bah_cod_m,$sh_gat,$z_sal,$mor_cod_m,$date_s)
{
include('login/config.php');
$Agri_table = 'Agri'.str_replace('-','_',$z_sal) ;  
$query = "SELECT id from $Agri_table where bah_cod_m = '$bah_cod_m' and sh_gat='$sh_gat' and  z_sal = '$z_sal' and  mor_cod_m = '$mor_cod_m' and  date_s = '$date_s'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['id'] ;
// clos conntection 
$dbh = null;
}
function Garden_id($bah_cod_m,$sh_gat,$z_sal,$mor_cod_m,$date_s)
{
include('login/config.php');
$query = "SELECT id from Garden where bah_cod_m = '$bah_cod_m' and sh_gat='$sh_gat' and  z_sal = '$z_sal' and  mor_cod_m = '$mor_cod_m' and  date_s = '$date_s'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['id'] ;
// clos conntection 
$dbh = null;
}
function Vege_id($bah_cod_m,$sh_gat,$z_sal,$mor_cod_m,$date_s)
{
include('login/config.php');
$query = "SELECT id from Vege where bah_cod_m = '$bah_cod_m' and sh_gat='$sh_gat' and  z_sal = '$z_sal' and  mor_cod_m = '$mor_cod_m' and  date_s = '$date_s'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['id'] ;
// clos conntection 
$dbh = null;
}
function Vege_pt($Vege_id)
{
include('login/config.php');
$query = "SELECT count(*)  from Vege_prod WHERE Vege_id = '$Vege_id' AND mah_tolp is null";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt -> fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function Vege_baz($Vege_id)
{
include('login/config.php');
$query = "SELECT count(*)  from Vege_prod WHERE Vege_id = '$Vege_id' AND mah_bazar = ''";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt -> fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function Vege_sbar($Vege_id)
{
include('login/config.php');
$query = "SELECT count(*)  from Vege_prod WHERE Vege_id = '$Vege_id' AND s_bar is null ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt -> fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function Vege_tol($Vege_id)
{
include('login/config.php');
$query = "SELECT count(*)  from Vege_prod WHERE Vege_id = '$Vege_id' AND mah_tol is null ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt -> fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
?>
<?php
   function sar_data20($bah_cod_m,$num_bah)
{
include('../login/config.php');
$query = "SELECT city_s,mor_cod_m,no_bah,bah_cod_m,jens,name,last_name,date_t,sh_sh,m_sod,fname,m_tah,er_mtah,tel_s,tel_m,ostan_s,shahr_s,city_s,rosta_s,co_name,no_co,sh_meli,co_sabt,add_city,id_ostan,id_city,id_mar,add_abadi from bah where  bah_cod_m = :bah_cod_m and num_bah=:num_bah" ; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_s= $row['city_s'] ; 
$mor_cod_m = $row['mor_cod_m'] ; 
$no_bah = $row['no_bah']; 
$bah_cod_m = $row['bah_cod_m']; 
$bah_jens= $row['jens']; 
$bah_name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$sh_sh   = $row['sh_sh']; 
$m_sod   = $row['m_sod']; 
$fname   = $row['fname']; 
$m_tah   = $row['m_tah']; 
$er_mtah = $row['er_mtah'];
$tel_s   = $row['tel_s']; 
$tel_m  = $row['tel_m']; 
$ostan_s  = $row['ostan_s'] ;
$shahr_s  = $row['shahr_s'] ;
$city_s   =  $row['city_s'] ;
$rosta_s  = $row['rosta_s'] ;
$co_name  = $row['co_name'] ;
$no_co  = $row['no_co'] ;
$sh_meli  = $row['sh_meli'] ;
$co_sabt  = $row['co_sabt'] ;
$add_city = $row['add_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$id_mar = $row['id_mar'] ;
$add_abadi = $row['add_abadi'] ;
// clos conntection 
$dbh = null;
?>
<table style="border:3px solid #069; margin-top:-10px" width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFCC" s >
   <tr>
 <?php  if ($no_bah=='1') { ?>
  <td height="22" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی</strong></div></td>
   </tr>
   <tr>
     <td width="179" height="30"><div align="right">
     <?php echo city_name1($id_city,$id_ostan) ?>
     </div></td>
     <td width="208"><div align="right">:شهرستان</div></td>
     <td>&nbsp;</td>
     <td width="179"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td width="334"><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right">
<?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
<?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $last_name ; ?></div></td>
     <td><div align="right">:نام خانوادگی</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $bah_name ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $sh_sh ; ?></div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td width="60">&nbsp;</td>
     <td><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td width="60">&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
 <?php }  if ($no_bah=='2') { ?>
     <td height="22" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی</strong></div></td>
   </tr>
   <tr>
     <td width="179" height="30"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?> </div></td>
     <td width="208"><div align="right">:شهرستان</div></td>
     <td>&nbsp;</td>
     <td width="179"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"> <?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td><div align="right">:کدملی مدیر عامل</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $co_name; ?><br>
     <?php echo $sh_meli ; ?>     </div></td>
     <td><div style="margin-right:30px" align="right">: نام شرکت/ شناسه ملی شرکت</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $last_name ; ?></div></td>
     <td><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $bah_name ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: نام مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >: تلفن ثابت</div></td>
   </tr>
    <?php } }?>
