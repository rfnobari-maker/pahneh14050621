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
if ($b_time=='1')  $v_b_time='استمرار ، زمستانه';
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
           <p class="style8">نمایش  اطلاعات محصولات صیفی<br />
             <?php sar_data2($bah_cod_m,$no_bah) ;?>
      </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
             
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="liste_Vege.php" method="post" id="form1" name="form1">
      <table width="99%" height="503" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <p class="one" >&nbsp;</p>
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="31%" height="40"><div align="right"> <?php echo city_name1($id_city1,$id_ostan1) ?></div></td>
          <td width="20%"><div align="right">:شهرستان</div></td>
          <td width="1%">&nbsp;</td>
          <td width="30%"><div align="right"><?php echo ostan_name($id_ostan1) ; ?></div></td>
          <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo mar_name($id_mar1) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo $v_m_ab; ?></div></td>
          <td><div align="right">:منبع آب</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo $v_b_time; ?></div></td>
          <td><div style="margin-right:30px" align="right" >:نوع طرح</div></td>
        </tr>
        <tr>
          <td height="63"><div align="right"> <span class="style2">درجه اعشار</span>
            <input name="lat2" type="text" class="required number input_text" id="lat2" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">37.010521: مثال</span></div></td>
          <td><div align="right">:Y عرض جغرافیایی</div></td>
          <td>&nbsp;</td>
          <td><div align="right"><span class="style2">درجه اعشار</span>
            <input name="lng2" type="text" class="required number input_text" id="lng2" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">46.212486: مثال</span></div></td>
          <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
        </tr>
        <tr>
          <td height="38">&nbsp;</td>
          <td>&nbsp;</td>
          <td height="49">&nbsp;</td>
          <td height="49"><div align="right"><span class="style2">هکتار</span>
            <input name="m_zamin2" type="text" class="input_text required" id="m_zamin2" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="11"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">:مساحت زمین</div></td>
        </tr>
        <tr>
          <td height="5" colspan="5">  
            </td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF">
            </td>
        </tr>
          <tr>
          <td height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات کاشت</strong></div></td>
          </tr>
        <tr>
          <td height="40">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select name="z_sal" disabled="disabled" class="input_text  required" id="z_sal"  style="height:40px ; width:120px ; direction:rtl" tabindex="20">
   <option value="">انتخاب کنید</option>
   <option value="1396-1397" <?php if ($z_sal=='1396-1397') { echo 'selected="selected"' ; } ?>>1396-1397</option>
   </select>
          </div></td>
          <td><div style="margin-right:30px" align="right">: سال زراعی</div></td>
        </tr>
        <tr>
          <td height="101" colspan="5"><table width="100%" height="101" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="11%" height="19" bgcolor="#FFFFCC">محصول بیمه هست ؟</td>
              <td width="14%" bgcolor="#FFFFCC">تاریخ اولین آبیاری<br />
                <span class="style8">روز / ماه / سال</span></td>
              <td width="13%" bgcolor="#FFFFCC">روش آبیاری</td>
              <td width="9%" bgcolor="#FFFFCC">روش کشت</td>
              <td width="11%" bgcolor="#FFFFCC">نوع رقم</td>
              <td width="7%" bgcolor="#FFFFCC">سطح زیر کشت<br />
                <span class="style2">هکتار</span></td>
              <td width="7%" bgcolor="#FFFFCC">نام محصول</td>
              <td width="3%" bgcolor="#FFFFCC">ردیف</td>
            </tr>
            <?php 
$n = 1 ;
$num2_t_mah = $t_mah ;
include('../../login/config.php');
$query = "SELECT * from Vege_prod where Vege_id = :Vege_id  "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':Vege_id'=>$id));
$row_count = $stmt -> rowCount();
while ($num2_t_mah > 0){
foreach($stmt as $row)
{
 $no_ab = $row['no_ab'] ;
 $zer_kesht = $row['zer_kesht'] ;
 $cod_mah = $row['cod_mah'] ;
 if ($cod_mah=='174') $v_cod_mah = 'گوجه فرنگی' ; 
 if ($cod_mah=='172') $v_cod_mah = 'پیاز' ; 
 if ($cod_mah=='170') $v_cod_mah = 'سیب زمین' ; 
 $ragham = $row['ragham'] ;
 $ra_kesh = $row['ra_kesh'] ;
 $sal_ab = $row['sal_ab'] ;
 $mah_ab = $row['mah_ab'] ;
 $roz_ab = $row['roz_ab'] ;
$mah_bem  = $row['mah_bem'] ;
?>

            <tr>
              <td height="51" bgcolor="#FFFFFF"><div align="center">
                <select name="mah_bem<?php echo $num2_t_mah ;?>" class="required input_text  required" id="mah_bem<?php echo $num2_t_mah ;?>"  style="height:40px ; width:100px ; direction:rtl" tabindex="12">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($mah_bem=='1') { echo 'selected="selected"' ; } ?>>بلی</option>
                  <option value="2" <?php if ($mah_bem=='2') { echo 'selected="selected"' ; } ?>>خیر</option>
                </select>
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <select name="sal_ab<?php echo $num2_t_mah ?>" class="input_text  required" id="sal<?php echo $num2_t_mah ?>"  style="height:35px ; width:40px ; direction:rtl" tabindex="11">
                  <option value="">--</option>
                  <option value="96" <?php if ($sal_ab=='96') { echo 'selected="selected"' ; } ?>>96</option>
                  <option value="97"<?php if ($sal_ab=='97') { echo 'selected="selected"' ; } ?>>97</option>
                </select>
                /
                <select name="mah_ab<?php echo $num2_t_mah ?>" class="input_text  required" id="mah<?php echo $num2_t_mah ?>"  style="height:35px ; width:40px ; direction:rtl" tabindex="10">
                  <option value="">--</option>
                  <option value="01" <?php if ($mah_ab=='01') { echo 'selected="selected"' ; } ?>>01</option>
                  <option value="02" <?php if ($mah_ab=='02') { echo 'selected="selected"' ; } ?>>02</option>
                  <option value="03" <?php if ($mah_ab=='03') { echo 'selected="selected"' ; } ?>>03</option>
                  <option value="04" <?php if ($mah_ab=='04') { echo 'selected="selected"' ; } ?>>04</option>
                  <option value="05" <?php if ($mah_ab=='05') { echo 'selected="selected"' ; } ?>>05</option>
                  <option value="06" <?php if ($mah_ab=='06') { echo 'selected="selected"' ; } ?>>06</option>
                  <option value="07" <?php if ($mah_ab=='07') { echo 'selected="selected"' ; } ?>>07</option>
                  <option value="08" <?php if ($mah_ab=='08') { echo 'selected="selected"' ; } ?>>08</option>
                  <option value="09" <?php if ($mah_ab=='09') { echo 'selected="selected"' ; } ?>>09</option>
                  <option value="10" <?php if ($mah_ab=='10') { echo 'selected="selected"' ; } ?>>10</option>
                  <option value="11" <?php if ($mah_ab=='11') { echo 'selected="selected"' ; } ?>>11</option>
                  <option value="12" <?php if ($mah_ab=='12') { echo 'selected="selected"' ; } ?>>12</option>
                </select>
                /
                <select name="roz_ab<?php echo $num2_t_mah ?>" class="input_text  required" id="roz<?php echo $num2_t_mah ?>"  style="height:35px ; width:40px ; direction:rtl" tabindex="9">
                  <option value="">--</option>
                  <option value="01" <?php if ($roz_ab=='01') { echo 'selected="selected"' ; } ?>>01</option>
                  <option value="02" <?php if ($roz_ab=='02') { echo 'selected="selected"' ; } ?>>02</option>
                  <option value="03" <?php if ($roz_ab=='03') { echo 'selected="selected"' ; } ?>>03</option>
                  <option value="04" <?php if ($roz_ab=='04') { echo 'selected="selected"' ; } ?>>04</option>
                  <option value="05" <?php if ($roz_ab=='05') { echo 'selected="selected"' ; } ?>>05</option>
                  <option value="06" <?php if ($roz_ab=='06') { echo 'selected="selected"' ; } ?>>06</option>
                  <option value="07" <?php if ($roz_ab=='07') { echo 'selected="selected"' ; } ?>>07</option>
                  <option value="08" <?php if ($roz_ab=='08') { echo 'selected="selected"' ; } ?>>08</option>
                  <option value="09" <?php if ($roz_ab=='09') { echo 'selected="selected"' ; } ?>>09</option>
                  <option value="10" <?php if ($roz_ab=='10') { echo 'selected="selected"' ; } ?>>10</option>
                  <option value="11" <?php if ($roz_ab=='11') { echo 'selected="selected"' ; } ?>>11</option>
                  <option value="12" <?php if ($roz_ab=='12') { echo 'selected="selected"' ; } ?>>12</option>
                  <option value="13" <?php if ($roz_ab=='13') { echo 'selected="selected"' ; } ?>>13</option>
                  <option value="14" <?php if ($roz_ab=='14') { echo 'selected="selected"' ; } ?>>14</option>
                  <option value="15" <?php if ($roz_ab=='15') { echo 'selected="selected"' ; } ?>>15</option>
                  <option value="16" <?php if ($roz_ab=='16') { echo 'selected="selected"' ; } ?>>16</option>
                  <option value="17" <?php if ($roz_ab=='17') { echo 'selected="selected"' ; } ?>>17</option>
                  <option value="18" <?php if ($roz_ab=='18') { echo 'selected="selected"' ; } ?>>18</option>
                  <option value="19" <?php if ($roz_ab=='19') { echo 'selected="selected"' ; } ?>>19</option>
                  <option value="20" <?php if ($roz_ab=='20') { echo 'selected="selected"' ; } ?>>20</option>
                  <option value="21" <?php if ($roz_ab=='21') { echo 'selected="selected"' ; } ?>>21</option>
                  <option value="22" <?php if ($roz_ab=='22') { echo 'selected="selected"' ; } ?>>22</option>
                  <option value="23" <?php if ($roz_ab=='23') { echo 'selected="selected"' ; } ?>>23</option>
                  <option value="24" <?php if ($roz_ab=='24') { echo 'selected="selected"' ; } ?>>24</option>
                  <option value="25" <?php if ($roz_ab=='25') { echo 'selected="selected"' ; } ?>>25</option>
                  <option value="26" <?php if ($roz_ab=='26') { echo 'selected="selected"' ; } ?>>26</option>
                  <option value="27" <?php if ($roz_ab=='27') { echo 'selected="selected"' ; } ?>>27</option>
                  <option value="28" <?php if ($roz_ab=='28') { echo 'selected="selected"' ; } ?>>28</option>
                  <option value="29" <?php if ($roz_ab=='29') { echo 'selected="selected"' ; } ?>>29</option>
                  <option value="30" <?php if ($roz_ab=='30') { echo 'selected="selected"' ; } ?>>30</option>
                  <option value="31" <?php if ($roz_ab=='31') { echo 'selected="selected"' ; } ?>>31</option>
                </select>
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <select name="no_ab<?php echo $num2_t_mah ?>" class="input_text  required" id="no_ab<?php echo $num2_t_mah ?>"  style="height:40px ; width:120px ; direction:rtl" tabindex="8">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($no_ab=='1') { echo 'selected="selected"' ; }?>>نواری</option>
                  <option value="2" <?php if ($no_ab=='2') { echo 'selected="selected"' ; }?>>غرقابی</option>
                  <option value="3" <?php if ($no_ab=='3') { echo 'selected="selected"' ; }?>>قطره ای</option>
                  <option value="4" <?php if ($no_ab=='4') { echo 'selected="selected"' ; }?>>بارانی</option>
                  <option value="5" <?php if ($no_ab=='5') { echo 'selected="selected"' ; }?>>سایر</option>
                </select>
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <select name="ra_kesh<?php echo $num2_t_mah ?>" id="no_kesht<?php echo $num2_t_mah ?>" class="input_text  required"  style="height:40px ; width:80px ; direction:rtl" tabindex="7">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($ra_kesh=='1') { echo 'selected="selected"' ; } ?>>نشایی</option>
                  <option value="2" <?php if ($ra_kesh=='2') { echo 'selected="selected"' ; } ?>>مستقیم</option>
                  <option value="3" <?php if ($ra_kesh=='3') { echo 'selected="selected"' ; } ?>>نشایی با مالچ</option>
                  <option value="4" <?php if ($ra_kesh=='4') { echo 'selected="selected"' ; } ?>>مستقیم با مالچ</option>
                </select>
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <select name="ragham<?php echo $num2_t_mah ?>" id="ragham<?php echo $num2_t_mah ?>" class="input_text  required"  style="height:40px ; width:100px ; direction:rtl" tabindex="6">
                  <?php
switch ($cod_mah) {
    case "174":
  ?>
                  <option value="-">-----</option>
                  <?php
        break;
    case "172":
  ?>
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($argam=='1') { echo 'selected="selected"' ; }?>>قرمز</option>
                  <option value="2" <?php if ($argam=='2') { echo 'selected="selected"' ; }?>>سفید</option>
                  <option value="3" <?php if ($argam=='3') { echo 'selected="selected"' ; }?>>زرد</option>
                  <option value="4" <?php if ($argam=='4') { echo 'selected="selected"' ; }?>>صورتی</option>
                  <?php
        break;
    case "170":
  ?>
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($argam=='1') { echo 'selected="selected"' ; }?>>اگریا</option>
                  <option value="2" <?php if ($argam=='2') { echo 'selected="selected"' ; }?>>سانته</option>
                  <option value="3" <?php if ($argam=='3') { echo 'selected="selected"' ; }?>>ساتینا</option>
                  <option value="4" <?php if ($argam=='4') { echo 'selected="selected"' ; }?>>میلوا</option>
                  <option value="5" <?php if ($argam=='5') { echo 'selected="selected"' ; }?>>بورن</option>
                  <option value="6" <?php if ($argam=='6') { echo 'selected="selected"' ; }?>>ساوالان</option>
                  <option value="7" <?php if ($argam=='7') { echo 'selected="selected"' ; }?>>آرنیدا</option>
                  <option value="8" <?php if ($argam=='8') { echo 'selected="selected"' ; }?>>باتبا</option>
                  <option value="9" <?php if ($argam=='9') { echo 'selected="selected"' ; }?>>مارفونا</option>
                  <option value="10" <?php if ($argam=='10') { echo 'selected="selected"' ; }?>>فونتانه</option>
                  <option value="11" <?php if ($argam=='11') { echo 'selected="selected"' ; }?>>راموس</option>
                  <option value="12" <?php if ($argam=='12') { echo 'selected="selected"' ; }?>>پیکاسو</option>
                  <option value="13" <?php if ($argam=='13') { echo 'selected="selected"' ; }?>>جلی</option>
                  <option value="14" <?php if ($argam=='14') { echo 'selected="selected"' ; }?>>سایر</option>
                  <?php
}
?>
                </select>
              </div></td>
              <td class="style8" bgcolor="#FFFFFF"><div align="center">
                <input name="mah_mas<?php echo $num2_t_mah ;?>" type="text" class="mashat required number input_text" id="mashat<?php echo $num2_t_mah ;?>" style="width:50px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $zer_kesht ;?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td class="style8" bgcolor="#FFFFFF"><div align="center">
                <input name="mah_name<?php echo $num2_t_mah ;?>" type="text" class="mah_name required  style8" id="mah_name<?php echo $num2_t_mah ;?>2" style="width:75px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo  $v_cod_mah ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><?php echo $n ;?></td>
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
     <input type="submit" name="action" value="بازگشت" id="submit" style="width:150px ; height:45px" tabindex="30" />
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