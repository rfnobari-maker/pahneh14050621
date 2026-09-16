<?php
include("../../lock_p1.php"); 
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
//
    $bah_cod_m   = isset($_POST['bah_cod_m'])  ? $_POST['bah_cod_m']  : '';
    $query = "SELECT ok from bah where  bah_cod_m = :bah_cod_m ";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
    $found = $stmt -> rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $ok = $row['ok'] ;
   if($ok=='2')
   {
      alert ('بهره بردار در قید حیات نمیباشد !! امکان ویرایش اطلاعات مقدور نیست  ') ;
    ?>
    <form  name="myform" class="myform" method="post" action="index.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
	
	}
   if($ok=='4')
   {
      alert ('اطلاعات بهره بردار از طرف ثبت احوال تایید نشد !! امکان ویرایش اطلاعات مقدور نمیباشد  ') ;
    ?>
    <form  name="myform" class="myform" method="post" action="index.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
	}

//
 if (isset($_POST['action1'])) 
 {  
$id = isset($_POST['id']) ? $_POST['id'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$t_mah = isset($_POST['t_mah']) ? $_POST['t_mah'] : '';

$num3_t_mah = $t_mah ;

// شروع حلقه تنوع محصول 
while ($num3_t_mah > 0){
$Vegeprod_id = isset($_POST['Vegeprod_id' . $num3_t_mah]) ? $_POST['Vegeprod_id' . $num3_t_mah] : '';
$dah_bazar    = isset($_POST['dah_bazar' . $num3_t_mah])    ? $_POST['dah_bazar' . $num3_t_mah]    : '';
$mah_bazar    = isset($_POST['mah_bazar' . $num3_t_mah])    ? $_POST['mah_bazar' . $num3_t_mah]    : '';
$s_bar        = isset($_POST['s_bar' . $num3_t_mah])        ? $_POST['s_bar' . $num3_t_mah]        : '';
$mah_tol      = isset($_POST['mah_tol' . $num3_t_mah])      ? $_POST['mah_tol' . $num3_t_mah]      : '';
$mah_tolp     = isset($_POST['mah_tolp' . $num3_t_mah])     ? $_POST['mah_tolp' . $num3_t_mah]     : '';

$query = "UPDATE  Vege_prod SET 
date_s=?,s_bar=?,mah_tol=?,mah_tolp=? WHERE id=? " ;
$q = $dbh->prepare($query);
$q->execute(array($date_edit,$s_bar,$mah_tol,$mah_tolp,$Vegeprod_id));

$num3_t_mah--;
 if ($num3_t_mah == 0 )
{
break ; 
}
}

// ثبت در بانک پیگیری

sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'تکمیل اطلاعات صیفی - '.$bah_cod_m,$id_ostan) ; 
alert ('اطلاعات بهره برداری صیفی با موفقیت تصحیح شد ') ;

?>
<script>
window.opener.location.reload();
window.close();
</script>
<?php
}
?>
<?php
 /////////////////////////////////////////////// 
if  (isset($_POST['id']))
{
 $id = $_POST['id'] ; 
 $query = "SELECT * from Vege where id = $id "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$id));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$t_mah = $row["t_mah"];
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
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
    </script>
</head>
<body>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td>
      <p class="style8">ویرایش   اطلاعات تکمیلی بهره برداری های صیفی
        <?php sar_data2($bah_cod_m,$no_bah) ;?>
           <br />
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
        <tr>
          <td width="4"><p>&nbsp;</p>
          <p>&nbsp;</p></td>
          <td width="840" >
    <form action="#" method="post" id="form1" name="form1">
              <table width="99%" height="454" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
                <tr>
                  <td height="29" colspan="7" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
                </tr>
                <tr>
                  <td width="31%" height="40" colspan="2"><div align="right"> <?php echo city_name1($id_city1,$id_ostan1) ?></div></td>
                  <td width="20%"><div align="right">:شهرستان</div></td>
                  <td width="1%">&nbsp;</td>
                  <td colspan="2"><div align="right"><?php echo ostan_name($id_ostan1) ; ?></div></td>
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
                  <td><div style="margin-right:30px" align="right" >:فصل تولید</div></td>
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
                  <td width="21%" height="49"><div align="right"><span class="style2">هکتار</span></div></td>
                  <td width="9%"><div align="right"><?php echo $m_zamin ; ?></div></td>
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
                  <td height="101" colspan="7">
                  <table width="100%" height="129" border="1" cellpadding="0" cellspacing="0">
                    <tr class="style8">
                      <td width="7%" height="19" rowspan="2" bgcolor="#FFFFCC">محصول بیمه هست ؟</td>
                      <td width="8%" rowspan="2" bgcolor="#FFFFCC">میزان تولید <br />
                        <span class="style2">تن</span><br /></td>
                      <td width="8%" rowspan="2" bgcolor="#FFFFCC">سطح برداشت<br />
                        <span class="style2">هکتار</span></td>
                      <td height="47" colspan="2" bgcolor="#FFFFCC">تاریخ ارسال به بازار</td>
                      <td width="7%" rowspan="2" bgcolor="#FFFFCC">پیش بینی تولید<br />
                        <span class="style2">تن</span></td>
                      <td width="11%" rowspan="2" bgcolor="#FFFFCC">تاریخ اولین آبیاری</td>
                      <td width="8%" rowspan="2" bgcolor="#FFFFCC">روش آبیاری</td>
                      <td width="8%" rowspan="2" bgcolor="#FFFFCC">روش کشت</td>
                      <td width="8%" rowspan="2" bgcolor="#FFFFCC">نوع رقم</td>
                      <td width="6%" rowspan="2" bgcolor="#FFFFCC">سطح زیر کشت<br />
                        <span class="style2">هکتار</span></td>
                      <td width="9%" rowspan="2" bgcolor="#FFFFCC">نام محصول</td>
                      <td width="4%" rowspan="2" bgcolor="#FFFFCC">ردیف</td>
                      </tr>
                    <tr class="style8">
                      <td width="8%" bgcolor="#FFFFCC">ماه</td>
                      <td width="8%" bgcolor="#FFFFCC">دهه</td>
                    </tr>
                    <?php 
$n = 1 ;
$num2_t_mah = $t_mah ;
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
 if ($ragham=='8') $v_ragham = 'بانبا' ; 
 if ($ragham=='9') $v_ragham = 'مارفونا' ; 
 if ($ragham=='10') $v_ragham = 'فونتانه' ; 
 if ($ragham=='11') $v_ragham = 'راموس' ; 
 if ($ragham=='12') $v_ragham = 'پیکاسو' ; 
 if ($ragham=='13') $v_ragham = 'جلی' ; 
 if ($ragham=='14') $v_ragham = 'سایر' ; 
}
 $mah_bazar = $row['mah_bazar'] ;
 $dah_bazar = $row['dah_bazar'] ;
 $mah_tolp = $row['mah_tolp'] ;
 $s_bar = $row['s_bar'] ;
 $mah_tol = $row['mah_tol'] ;
if ($mah_tolp == 0 ) $mah_tolp='' ;
if ($mah_tol == 0 )  $mah_tol='' ;
$Vegeprod_id = $row['id'] ;
?>
                    <tr>
                 <td  height="44" <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo $v_mah_bem?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div align="center">
       <input name="mah_tol<?php echo $num2_t_mah ;?>" type="text" class="mah_tol<?php echo $num2_t_mah ;?> required number input_text" id="mah_tol<?php echo $num2_t_mah ;?>" style="width:70px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo  $mah_tol ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                 </div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div align="center">
                <input name="s_bar<?php echo $num2_t_mah ;?>" type="text" class="s_bar<?php echo $num2_t_mah ;?> required number input_text" id="s_bar<?php echo $num2_t_mah ;?>" style="width:40px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php   echo round($s_bar,1) ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                 </div></td>
                 <td <?php if($n%2 == 0)   echo 'bgcolor=#CCCCCC' ?>><div align="center">
                   <select name="mah_bazar<?php echo $num2_t_mah ;?>" disabled="disabled" class="required input_text  required" id="mah_bazar<?php echo $num2_t_mah ;?>"  style="height:40px ; width:80px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($mah_bazar=='1') { echo 'selected="selected"' ; } ?>>فروردین</option>
                     <option value="2" <?php if ($mah_bazar=='2') { echo 'selected="selected"' ; } ?>>اردیبهشت</option>
                     <option value="3" <?php if ($mah_bazar=='3') { echo 'selected="selected"' ; } ?>>خرداد</option>
                     <option value="4" <?php if ($mah_bazar=='4') { echo 'selected="selected"' ; } ?>>تیر</option>
                     <option value="5" <?php if ($mah_bazar=='5') { echo 'selected="selected"' ; } ?>>مرداد</option>
                     <option value="6" <?php if ($mah_bazar=='6') { echo 'selected="selected"' ; } ?>>شهریور</option>
                     <option value="7" <?php if ($mah_bazar=='7') { echo 'selected="selected"' ; } ?>>مهر</option>
                     <option value="8" <?php if ($mah_bazar=='8') { echo 'selected="selected"' ; } ?>>آبان</option>
                     <option value="9" <?php if ($mah_bazar=='9') { echo 'selected="selected"' ; } ?>>آذر</option>
                     <option value="10" <?php if ($mah_bazar=='10') { echo 'selected="selected"' ; } ?>>دی</option>
                     <option value="11" <?php if ($mah_bazar=='11') { echo 'selected="selected"' ; } ?>>بهمن</option>
                     <option value="12" <?php if ($mah_bazar=='12') { echo 'selected="selected"' ; } ?>>اسفند</option>
                   </select>
                 </div></td>
                 <td <?php if($n%2 == 0)   echo 'bgcolor=#CCCCCC' ?>><div align="center">
                   <select name="dah_bazar<?php echo $num2_t_mah ;?>" disabled="disabled" class="required input_text  required" id="dah_bazar<?php echo $num2_t_mah ;?>"  style="height:40px ; width:80px ; direction:rtl" tabindex="3">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($dah_bazar=='1') { echo 'selected="selected"' ; } ?>>دهه اول </option>
                     <option value="2" <?php if ($dah_bazar=='2') { echo 'selected="selected"' ; } ?>>دهه دوم</option>
                     <option value="3" <?php if ($dah_bazar=='3') { echo 'selected="selected"' ; } ?>>دهه سوم</option>
                   </select>
                 </div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div align="center">
                <div align="center">
                <input name="mah_tolp<?php echo $num2_t_mah ;?>" type="text" class="mah_tolp<?php echo $num2_t_mah ;?> required number input_text" id="mah_tolp<?php echo $num2_t_mah ;?>" style="width:70px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo  $mah_tolp ; ?>" maxlength="10" readonly  align="baseline" xml:lang="fa" />
              </div>
            <input type="hidden" name="Vegeprod_id<?php echo $num2_t_mah ;?>" value=<?php echo $Vegeprod_id; ?> />
              </div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo $date_ab ;?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo $v_no_ab ?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo $v_ra_kesh ?></div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"> <?php echo $v_ragham ;?> </div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>>
                   <div align="center">
                     <input name="zer_kesht<?php echo $num2_t_mah ;?>" type="text" class="zer_kesht required number input_text" id="zer_kesht<?php echo $num2_t_mah ;?>" style="width:50px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $zer_kesht ;?>" maxlength="10"  align="baseline" xml:lang="fa" />
                   </div></td>
                 <td <?php if($n%2 == 0)  echo 'bgcolor=#CCCCCC' ?>><div  align="center"><?php echo  $v_cod_mah ?></div>
 <input name="cod_mah<?php echo $num2_t_mah ;?>" type="hidden" class="cod_mah required number input_text" id="cod_mah<?php echo $num2_t_mah ;?>"  value="<?php echo $cod_mah ;?>" />
                 </td>
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
                 <input type="hidden" name="t_mah" value=<?php echo $t_mah; ?> />
                 <input type="hidden" name="id" value=<?php echo $id; ?> />
                 <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
                 <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
                 <input type="button" name="cancel" value="انصراف"  onclick="close_window()" style="width:150px ; height:45px" tabindex="7" /> 
                 <input type="submit" name="action1" value="تصحیح اطلاعات" id="submit" style="width:150px ; height:45px" tabindex="6" />
             </form> 
          </td>
        </tr>
<?php
unset($actual_link,$add_abadi,$add_city,$bah_cod_m,$city,$cod_mah,$count_pm,$count_pm,$date_edit,$date_s,$date_s,$dbh,$dsn,$e,$es,$euser,$found,$group_cod,$h_ab,$id,$id_ostan,$jens,$karbar_m,$markaz,$name,$no_karbar,$ostan,$password,$PersName,$PersName,$pic,$query,$row,$stmt,$time,$title,$user,$user_check,$v_jen) ;
}
?>
</table>
<p>&nbsp;</p>
</table>
</body>
</html>
<?php
$no = $t_mah ; 
while ($no > 0){
?>
<script>
$('.s_bar<?php echo $no ?>').keyup(function () {
   var zk = document.getElementById("zer_kesht<?php echo $no ?>").value;
   var sb = document.getElementById("s_bar<?php echo $no ?>").value;
if (parseFloat(zk) < parseFloat(sb)) {
   alert("خطا ! سطح  برداشت از سطح زیر کشت بزرگتر است ");
            // پاک کردن سطح برداشت 1
			$('#s_bar<?php echo $no ?>').val('');
  			// فوکوس روی سطح برداشت 1 
			document.getElementById("s_bar<?php echo $no ?>").focus();
}

});
</script>
<script>
 $('.mah_tolp<?php echo $no ?>').change(function () {
   var p_mtol = document.getElementById("mah_tolp<?php echo $no ?>").value;
   var zk = document.getElementById("zer_kesht<?php echo $no ?>").value;
 if (parseInt(zk) > 0  &&  parseFloat(p_mtol) <= 0) {
   alert(" خطا! \n \n با توجه به سطح کاشت ، پیش بینی تولید نمیتواند صفر باشد ");
            // پاک کردن مقدار تولید 
			$('#mah_tolp<?php echo $no ?>').val('');
  			// فوکوس روی تولید محصول 
			document.getElementById("mah_tolp<?php echo $no ?>").focus();
}
 // کد محصول
   var mcod = document.getElementById("cod_mah<?php echo $no ?>").value;
//
  var sb = document.getElementById("zer_kesht<?php echo $no ?>").value ;
  var mtol = document.getElementById("mah_tolp<?php echo $no ?>").value ;
  $.ajax({
      url: "V_ajax.php",
      type: "POST",
      data: {op:"check_mah_tol",mcod:mcod,sb:sb,mtol:mtol},
      success: function(data,status){
   	    if(data!='true')
  	    {
  	    	document.getElementById("submit").disabled = true;
  	    	alert( ' خطا!  \n \n  میزان پیش بینی وارد شده از محدوده مجاز ، بیشتر هست ' );
            // پاک کردن مقدار تولید 
			$('#mah_tolp<?php echo $no ?>').val('');
  			// فوکوس روی تولید محصول 
			document.getElementById("mah_tolp<?php echo $no ?>").focus();
  	    }
  	    else
  	    	document.getElementById("submit").disabled = false ;
  	},
      error: function(){$("#result").html("مشکلی در اتصال به سرور به وجود آمد!")}
  });
});
</script>
<script>
 $('.mah_tol<?php echo $no ?>').change(function () {
   var p_mtol = document.getElementById("mah_tol<?php echo $no ?>").value;
   var sb = document.getElementById("s_bar<?php echo $no ?>").value;
 if (parseInt(sb) > 0  &&  parseFloat(p_mtol) <= 0) {
   alert(" خطا! \n \n با توجه به سطح برداشت ، میزان تولید قطعی نمیتواند صفر باشد ");
            // پاک کردن مقدار تولید 
			$('#mah_tol<?php echo $no ?>').val('');
  			// فوکوس روی تولید محصول 
			document.getElementById("mah_tol<?php echo $no ?>").focus();
}
 // کد محصول
  var mcod = document.getElementById("cod_mah<?php echo $no ?>").value;
  var sb = document.getElementById("s_bar<?php echo $no ?>").value ;
  var mtol = document.getElementById("mah_tol<?php echo $no ?>").value ;
  $.ajax({
      url: "V_ajax.php",
      type: "POST",
      data: {op:"check_mah_tol",mcod:mcod,sb:sb,mtol:mtol},
      success: function(data,status){
   	    if(data!='true')
  	    {
  	    	document.getElementById("submit").disabled = true;
  	    	alert( ' خطا!  \n \n  میزان تولید قطعی وارد شده از محدوده مجاز ، بیشتر هست '  );
            // پاک کردن مقدار تولید 
			$('#mah_tol<?php echo $no ?>').val('');
  			// فوکوس روی تولید محصول 
			document.getElementById("mah_tol<?php echo $no ?>").focus();
  	    }
  	    else
  	    	document.getElementById("submit").disabled = false ;
  	},
      error: function(){$("#result").html("مشکلی در اتصال به سرور به وجود آمد!")}
  });
});
</script>

<?php
 $no--;
}
?>