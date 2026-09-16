<?php
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
$query = "SELECT count(*) from Agri_prod1398 WHERE
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
function city_name1($id_city,$id_ostan)
{
include('login/config.php');
$query = "SELECT city from public_abadi4  where id_city = '$id_city' and id_ostan = '$id_ostan' ";
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
return $row['Last_name'].'&nbsp;'.$row['name']; 
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
$query = "SELECT ostan from public_abadi4 where id_ostan = '$id_ostan' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['ostan']; 
$dbh = null;
}
function city_name($id_city)
{
include('login/config.php');
$query = "SELECT city from public_abadi4  where id_city = '$id_city'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['city']; 
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
<?php } function sar_ind_data($bah_cod_m,$num_bah)
{
include('../../login/config.php');
$query = "SELECT mor_cod_m,no_bah,bah_cod_m,jens,name,last_name,date_t,sh_sh,m_sod,fname,m_tah,er_mtah,tel_s,tel_m,co_name,no_co,sh_meli,co_sabt,add_city,id_ostan,id_city,id_mar,add_abadi from ind_bah where  bah_cod_m = :bah_cod_m and num_bah=:num_bah" ; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
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
<table style="border:3px solid #069; margin-top:-10px" width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFCC" s >
   <tr>
 <?php  if ($no_bah=='1') { ?>
  <td height="22" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی / مشاغل وابسته به بخش کشاورزی </strong></div></td>
   </tr>
   <tr>
     <td width="179" height="30" bgcolor="#FFFFFF"><div align="right">
     <?php echo city_name1($id_city,$id_ostan) ?>
     </div></td>
     <td width="208" bgcolor="#FFFFFF"><div align="right">:شهرستان</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td width="179" bgcolor="#FFFFFF"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td width="334" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right">
<?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">: آبادی / شهر</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
<?php echo mar_name($id_mar) ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $last_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">:نام خانوادگی</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $bah_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $sh_sh ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">:شماره شناسنامه</div></td>
     <td width="60" bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $bah_cod_m ; ?></div></td>
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
     <td height="22" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی / مشاغل وابسته به بخش کشاورزی</strong></div></td>
   </tr>
   <tr>
     <td width="179" height="30" bgcolor="#FFFFFF"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?> </div></td>
     <td width="208" bgcolor="#FFFFFF"><div align="right">:شهرستان</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td width="179" bgcolor="#FFFFFF"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"> <?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">: آبادی / شهر</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">:کدملی مدیر عامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $co_name ; ?><br>
     <?php echo $sh_meli ; ?>     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام شرکت/ شناسه ملی شرکت</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $last_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $bah_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام مدیرعامل</div></td>
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
function edit_database_abadi($id_mar,$mor_cod_m,$id_abadi,$add_abadi)
{
include ('login/config.php') ;

$query = "UPDATE bah SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE bee SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE unknown_bee SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Agri1395_1396 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Agri1396_1397 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Agri1397_1398 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Garden SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Garden_prod SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Agri_prod1395_1396 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Agri_prod1396_1397 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Agri_prod1397_1398 SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Aquatic SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Greenhous SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE spoultry SET id_mar='$id_mar',mor_cod_m='$mor_cod_m' WHERE substr(add_abadi,14,6)=$id_abadi";
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
$query = "UPDATE unknown_bee SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri1395_1396 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri1396_1397 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri1397_1398 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri_prod1395_1396 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri_prod1396_1397 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Agri_prod1397_1398 SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Garden SET id_mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mor_cod_m,$add_city));
$query = "UPDATE Garden_prod SET id_mar=?,mor_cod_m=? WHERE add_city=?";
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
function bah_agri_count($bah_cod_m)
{
include('login/config.php');
$query = "SELECT count(*) from Agri1395_1396 where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result1 = $stmt->fetchColumn();
$query = "SELECT count(*) from Agri1396_1397 where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result2 = $stmt->fetchColumn();
$query = "SELECT count(*) from Agri1397_1398 where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result3 = $stmt->fetchColumn();
$result_kol = $result1 + $result2 + $result3 ; 
return $result_kol ; 
// clos conntection 
$dbh = null;
}
function bah_garden_count($bah_cod_m)
{
include('login/config.php');
$query = "SELECT count(*) from Garden where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function bah_greenhous_count($bah_cod_m)
{
include('login/config.php');
$query = "SELECT count(*) from Greenhous where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
function bah_bee_count($bah_cod_m)
{
include('login/config.php');
$query = "SELECT count(*) from bee where bah_cod_m = '$bah_cod_m' ";
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
function bah_aquatic_count($bah_cod_m)
{
include('login/config.php');
$query = "SELECT count(*) from Aquatic where bah_cod_m = '$bah_cod_m' ";
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
function Agri_id($bah_cod_m,$sh_gat,$z_sal,$mor_cod_m,$date_s)
{
include('login/config.php');
$query = "SELECT id from Agri where bah_cod_m = '$bah_cod_m' and sh_gat='$sh_gat' and  z_sal = '$z_sal' and  mor_cod_m = '$mor_cod_m' and  date_s = '$date_s'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['id'] ;
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