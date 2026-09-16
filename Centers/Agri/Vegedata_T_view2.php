<?php
include("../../lock_p2.php"); 
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
if  (isset($_POST['id']))
{
 $id = $_POST['id'] ; 
date_default_timezone_set('Asia/Tehran') ;
$date_s = date_con(jdate("Y/m/d"));
include('../../login/config.php');
 $query = "SELECT * from Vege where id = $id "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$id));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$id_ostan1 = $row["id_ostan"];
$id_city1 = $row["id_city"];
$id_mar1 = $row["id_mar"];
$add_abadi = $row["add_abadi"]; 
$add_city = $row["add_city"]; 
$lng = $row['lng'];
$lat = $row['lat'];
$m_zamin = $row['m_zamin'];
$m_ab = $row['m_ab'];
$bah_cod_m = $row['bah_cod_m'];
$no_bah = $row['no_bah'] ; 
$add_abadi = $row["add_abadi"]; 
$add_city = $row["add_city"]; 
$bah_cod_m = $row['bah_cod_m'];
$m_poul = $row['m_poul'];
$b_time = $row['b_time'];
if ($b_time=='1')  $v_b_time='زمستانه/استمرار';
if ($b_time=='2')  $v_b_time='بهاره';
if ($b_time=='3')  $v_b_time='تابستانه';
if ($b_time=='4')  $v_b_time='پاییزه';
$z_sal = $row['z_sal'];
$t_mah = $row['t_mah'];
if ($m_ab=='1')  $v_m_ab='چشمه';
if ($m_ab=='2')  $v_m_ab='قنات';
if ($m_ab=='3')  $v_m_ab='رودخانه'; 
if ($m_ab=='4')  $v_m_ab='سد';
if ($m_ab=='5')  $v_m_ab='چاه سطحی';
if ($m_ab=='6')  $v_m_ab='چاه عمیق';
if ($m_ab=='7')  $v_m_ab='چاه نیمه عمیق';
if ($m_ab=='8')  $v_m_ab='زهکش';
if ($m_ab=='9')  $v_m_ab='پساب';
if ($m_ab=='10')  $v_m_ab='آب بندان' ;
if ($m_ab=='11')  $v_m_ab='سایر' ;

$num_t_mah = $t_mah ; 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<script>
function close_window() {
      close();
 }
</script>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<!-- پایان دریافت اطلاعات مالک -->
</head>
<body>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td>
      <p class="style8">مشاهده   اطلاعات تکمیلی بهره برداری های صیفی
        <?php sar_data2($bah_cod_m,$no_bah) ;?>
           <br />
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
        <tr>
          <td width="4"><p>&nbsp;</p>
          <p>&nbsp;</p></td>
          <td width="840" >
            <form action="liste_Vege.php" method="post" id="form1" name="form1">
              <table width="99%" height="447" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
                <tr>
                  <td height="29" colspan="7" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
                </tr>
                <tr>
                  <td width="31" height="40" colspan="2"><div align="right"> <?php echo city_name1($id_city1,$id_ostan1) ?></div></td>
                  <td width="20%"><div align="right">:شهرستان</div></td>
                  <td width="1%">&nbsp;</td>
                  <td width="30" colspan="2"><div align="right"><?php echo ostan_name($id_ostan1) ; ?></div></td>
                  <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
                </tr>
                <tr>
                  <td height="38" colspan="2"><div align="right"> <?php echo abadi_name($add_abadi); ?></div></td>
                  <td><div align="right">: آبادی / شهر</div></td>
                  <td>&nbsp;</td>
                  <td colspan="2"><div align="right"> <?php echo mar_name($id_mar1) ; ?></div></td>
                  <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
                </tr>
                <tr>
                  <td height="26" colspan="7" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
                </tr>
                <tr>
                  <td height="38" colspan="2"><div align="right"> <?php echo $v_m_ab; ?></div></td>
                  <td><div align="right">:منبع آب</div></td>
                  <td>&nbsp;</td>
                  <td colspan="2"><div align="right"> <?php echo $v_b_time; ?></div></td>
                  <td><div style="margin-right:30px" align="right" >:فصل کشت</div></td>
                </tr>
                <tr>
                  <td height="63"><div align="right"><span class="style2">درجه اعشار</span><br />
                  </div></td>
                  <td><div align="right"><?php echo $lat ; ?><br />
                  </div></td>
                  <td><div align="right">:Y عرض جغرافیایی</div></td>
                  <td>&nbsp;</td>
                  <td><div align="right"><span class="style2">درجه اعشار</span><br />
                  </div></td>
                  <td><div align="right"><?php echo $lng ; ?><br />
                  </div></td>
                  <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
                </tr>
                <tr>
                  <td height="49" colspan="2">&nbsp;</td>
                  <td height="49">&nbsp;</td>
                  <td height="49">&nbsp;</td>
                  <td height="49"><div align="right"><span class="style2">هکتار</span></div></td>
                  <td><div align="right"><?php echo $m_zamin ; ?></div></td>
                  <td><div style="margin-right:30px" align="right">:مساحت زمین</div></td>
                </tr>
                <tr>
                  <td height="31" colspan="7" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات کاشت</strong></div></td>
                </tr>
                <tr>
                  <td height="32" colspan="6"><div  class="input_text" align="right"><?php echo $z_sal ?></div></td>
                  <td><div style="margin-right:30px" align="right">: سال زراعی</div></td>
                </tr>
                <tr>
                  <td height="101" colspan="7"><table width="100%" height="88" border="1" cellpadding="0" cellspacing="0">
                    <tr class="style8">
                      <td width="8%" height="19" bgcolor="#FFFFCC">محصول بیمه هست ؟</td>
                      <td width="8%" bgcolor="#FFFFCC">میزان تولید <br />
                        <span class="style2">تن</span><br /></td>
                      <td width="9%" bgcolor="#FFFFCC">سطح برداشت</td>
                      <td width="13%" bgcolor="#FFFFCC">تاریخ ارسال به بازار</td>
                      <td width="7%" bgcolor="#FFFFCC">پیش بینی تولید<br />
                        <span class="style2">تن</span></td>
                      <td width="12%" bgcolor="#FFFFCC">تاریخ اولین آبیاری</td>
                      <td width="8%" bgcolor="#FFFFCC">روش آبیاری</td>
                      <td width="8%" bgcolor="#FFFFCC">روش کشت</td>
                      <td width="8%" bgcolor="#FFFFCC">نوع رقم</td>
                      <td width="6%" bgcolor="#FFFFCC">سطح زیر کشت<br />
                        <span class="style2">هکتار</span></td>
                      <td width="9%" bgcolor="#FFFFCC">نام محصول</td>
                      <td width="4%" bgcolor="#FFFFCC">ردیف</td>
                      </tr>
                    <?php 
$n = 1 ;
$num2_t_mah = $t_mah ;
include('../../login/config.php');
$query = "SELECT * from Vege_prod where Vege_id = :Vege_id order by cod_mah DESC "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':Vege_id'=>$id));
$row_count = $stmt -> rowCount();
while ($num2_t_mah > 0){
foreach($stmt as $row)
{
 $no_ab = $row['no_ab'] ;
 if ($no_ab=='1') $v_no_ab = 'نواری' ; 
 if ($no_ab=='2') $v_no_ab = 'غرقابی' ; 
 if ($no_ab=='3') $v_no_ab = 'قطره ای' ; 
 if ($no_ab=='4') $v_no_ab = 'بارانی' ; 
 if ($no_ab=='5') $v_no_ab = 'سایر' ; 
 $zer_kesht = $row['zer_kesht'] ;
 $cod_mah = $row['cod_mah'] ;
 if ($cod_mah=='174') $v_cod_mah = 'گوجه فرنگی' ; 
 if ($cod_mah=='172') $v_cod_mah = 'پیاز' ; 
 if ($cod_mah=='170') $v_cod_mah = 'سیب زمین' ; 
 $ragham = $row['ragham'] ;
 $ra_kesh = $row['ra_kesh'] ;
 if ($ra_kesh=='1') $v_ra_kesh = 'نشایی' ; 
 if ($ra_kesh=='2') $v_ra_kesh = 'مستقیم' ; 
 if ($ra_kesh=='3') $v_ra_kesh = 'نشایی با مالچ' ; 
 if ($ra_kesh=='4') $v_ra_kesh = 'مستقیم با مالچ' ; 
 $date_ab = $row['date_ab'] ;
$mah_bem  = $row['mah_bem'] ;
 if ($mah_bem=='1') $v_mah_bem = 'بلی' ; 
 if ($mah_bem=='2') $v_mah_bem = 'خیر' ; 
switch ($cod_mah) {
    case "174":
   $v_ragham = '---' ; 
        break;
    case "172":
 if ($ragham=='1') $v_ragham = 'قرمز' ; 
 if ($ragham=='2') $v_ragham = 'سفید' ; 
 if ($ragham=='3') $v_ragham = 'زرد' ; 
 if ($ragham=='4') $v_ragham = 'صورتی' ; 
        break;
    case "170":
 if ($ragham=='1') $v_ragham = 'اگریا' ; 
 if ($ragham=='2') $v_ragham = 'سانته' ; 
 if ($ragham=='3') $v_ragham = 'ساتینا' ; 
 if ($ragham=='4') $v_ragham = 'میلوا' ; 
 if ($ragham=='5') $v_ragham = 'بورن' ; 
 if ($ragham=='6') $v_ragham = 'ساوالان' ; 
 if ($ragham=='7') $v_ragham = 'آرنیدا' ; 
 if ($ragham=='8') $v_ragham = 'باتبا' ; 
 if ($ragham=='9') $v_ragham = 'مارفونا' ; 
 if ($ragham=='10') $v_ragham = 'فونتانه' ; 
 if ($ragham=='11') $v_ragham = 'راموس' ; 
 if ($ragham=='12') $v_ragham = 'پیکاسو' ; 
 if ($ragham=='13') $v_ragham = 'جلی' ; 
 if ($ragham=='14') $v_ragham = 'سایر' ; 
}
 $mah_bazar = $row['mah_bazar'] ;
 if ($mah_bazar=='1') $v_mah_bazar = 'فروردین' ; 
 if ($mah_bazar=='2') $v_mah_bazar = 'اردیبهشت' ; 
 if ($mah_bazar=='3') $v_mah_bazar = 'خرداد' ; 
 if ($mah_bazar=='4') $v_mah_bazar = 'تیر' ; 
 if ($mah_bazar=='5') $v_mah_bazar = 'مرداد' ; 
 if ($mah_bazar=='6') $v_mah_bazar = 'شهریور' ; 
 if ($mah_bazar=='7') $v_mah_bazar = 'مهر' ; 
 if ($mah_bazar=='8') $v_mah_bazar = 'آبان' ; 
 if ($mah_bazar=='9') $v_mah_bazar = 'آذر' ; 
 if ($mah_bazar=='10') $v_mah_bazar = 'دی' ; 
 if ($mah_bazar=='11') $v_mah_bazar = 'بهمن' ; 
 if ($mah_bazar=='12') $v_mah_bazar = 'اسفند' ; 

 $dah_bazar = $row['dah_bazar'] ;
 if ($dah_bazar=='1') $v_dah_bazar = 'دهه اول' ; 
 if ($dah_bazar=='2') $v_dah_bazar = 'دهه دوم' ; 
 if ($dah_bazar=='3') $v_dah_bazar = 'دهه سوم' ; 
 $mah_tolp = $row['mah_tolp'] ;
 $s_bar = $row['s_bar'] ;
 $mah_tol = $row['mah_tol'] ;
?>
                    <tr>
                 <td  height="44" <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo $v_mah_bem?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo $mah_tol ;?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo $s_bar ;?></div></td>
                 <td <?php if($n%2 == 0)   echo 'bgcolor=#CCCCCC' ?>><div align="center"><?php  echo $v_dah_bazar.'&nbsp;'.$v_mah_bazar;?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo $mah_tolp ;?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo $date_ab ;?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo $v_no_ab ?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo $v_ra_kesh ?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"> <?php echo $v_ragham ;?> </div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo $zer_kesht ;?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo  $v_cod_mah ?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><?php echo $n ;?></td>
                    </tr>
                    <?php
 $num2_t_mah--;
 $n++ ;
}
}
?>
                  </table></td>
                </tr>
                
              </table>
              <div align="center">
                <p>
                  <input type="submit" name="action" value="بستن پنجره"  onclick="close_window()" style="height:35px ; width:100px ; font-family:Tahoma ; font-size:16px"/>
                </p>
                <p>&nbsp;</p>
              </div>
  </form> 
            
          </td>
        </tr>
<?php
unset($actual_link,$add_abadi,$add_city,$bah_cod_m,$city,$cod_mah,$count_pm,$count_pm,$date_edit,$date_s,$date_s,$dbh,$dsn,$e,$es,$euser,$found,$group_cod,$h_ab,$id,$id_ostan,$jens,$karbar_m,$markaz,$name,$no_karbar,$ostan,$password,$PersName,$PersName,$pic,$query,$row,$stmt,$time,$title,$user,$user_check,$v_jen) ;
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Vege.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
</table>
</table>
</body>
</html>
