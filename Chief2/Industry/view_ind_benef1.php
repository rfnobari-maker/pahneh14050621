<?php
include('../../lock_ce.php');
include('../../event.php');
if  (isset($_POST['ShenaseKasboKar']))
{
function renderForm($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$co_name,$no_co,$sh_meli,$co_sabt)
{ 
$ShenaseKasboKar = $_POST['ShenaseKasboKar'];
include('../../login/config.php');
$query = "SELECT * from ind_bah where  ShenaseKasboKar = :ShenaseKasboKar "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':ShenaseKasboKar'=>$ShenaseKasboKar));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$mor_cod_m = $row['mor_cod_m'] ; 
$no_bah = $row['no_bah']; 
$NationalCode = $row['NationalCode']; 
$cod_p = $row['cod_p']; 
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
$no_co  = $row['no_co'] ;
$sh_meli  = $row['sh_meli'] ;
$co_sabt  = $row['co_sabt'] ;
$add_city = $row['add_city'] ;
$add_abadi = $row['add_abadi'] ;
$addres   = $row['addres']; 
$email  = $row['email']; 
$c_f_name  = $row['c_f_name']; 
$c_l_name  = $row['c_l_name']; 
$c_cod_m = $row['c_cod_m']; 
$date_sabt = $row['date_sabt']; 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<link href="radio.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script>
function close_window() {
      close();
 }
</script>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
	    <form action="" method="post" id="form1" name="form1">
 <p align="center" ><span class="style8"> مشاهده اطلاعات بهره بردار صنایع</span></p>
 <table style="border:3px solid #069;" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
 <?php  if ($no_bah=='1') { ?>
  <td height="38" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی</strong></div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <select name="jens" disabled="disabled" class="required" id="jens" style="height:40px ; width:150px ; direction:rtl" tabindex="1">
         <option value="">انتخاب کنید</option>
         <option value="1" <?php if($bah_jens=="1") echo "selected='selected'"?>>مرد</option>
         <option value="2" <?php if($bah_jens=="2") echo "selected='selected'"?>>زن</option>
       </select>
     </div></td>
     <td><div align="right">:جنسیت</div></td>
     <td width="98" rowspan="7">&nbsp;</td>
     <td><div align="right">
       <input name="NationalCode" type="text" class="required digits" id="NationalCode" style="width:150px; height:30px" dir="rtl" lang="fa" value="<?php echo $NationalCode ; ?>" maxlength="10" xml:lang="fa" readonly="readonly" />
     </div></td>
     <td><div style="margin-right:20px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td width="203" height="47"><div align="right">
       <input name="last_name" type="text" class="required" id="last_name" style="width:150px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td width="169"><div align="right">:نام خانوادگی</div></td>
     <td width="164"><div align="right">
       <input name="name" type="text" class="required" id="name" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $bah_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td width="115"><div style="margin-right:20px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="55"><div align="right">
       <input name="sh_sh" type="text" class="required digits" id="sh_sh" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $sh_sh ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td height="55" dir="rtl"><div align="right">
       <input name="date_t" type="text" class="pdate required" id="pcal1" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:20px" align="right" >:تاریخ تولد</div></td>
   </tr>
   <tr>
     <td height="55">&nbsp;</td>
     <td>&nbsp;</td>
     <td height="55" dir="rtl"><div align="right">
       <input name="fname" type="text" class="required" id="fname" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $fname ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:20px" align="right" >:نام پدر</div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <input name="r_tah" type="text" class="required digits" id="tel_s3" style="width:150px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $r_tah ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:رشته تحصیلی</div></td>
     <td><div align="right">
       <select name="m_tah" disabled="disabled" class="required" id="m_tah" style="height:40px ; width:150px ; direction:rtl" tabindex="8">
         <option value="">انتخاب کنید</option>
         <option value="1" <?php if($m_tah=="1") echo "selected='selected'"?>>بیسواد</option>
         <option value="2" <?php if($m_tah=="2") echo "selected='selected'"?>>خواندن و نوشتن</option>
         <option value="3" <?php if($m_tah=="3") echo "selected='selected'"?>>سیکل</option>
         <option value="4" <?php if($m_tah=="4") echo "selected='selected'"?>>دیپلم</option>
         <option value="5" <?php if($m_tah=="5") echo "selected='selected'"?>>فوق دیپلم</option>
         <option value="6" <?php if($m_tah=="6") echo "selected='selected'"?>>لیسانس</option>
         <option value="7" <?php if($m_tah=="7") echo "selected='selected'"?>>فوق لیسانس</option>
         <option value="8" <?php if($m_tah=="8") echo "selected='selected'"?>>دکتری</option>
         <option value="9" <?php if($m_tah=="9") echo "selected='selected'"?>>تحصیلات حوزوی</option>
         </select>
     </div></td>
     <td><div style="margin-right:20px" align="right" >:مدرک تحصیلی</div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <input name="tel_m" type="text" class="required digits" id="tel_m" style="width:150px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td><div align="right">
       <input name="tel_s" type="text" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:20px" align="right" >:شماره تلفن ثابت</div></td>
     </tr>
   <tr>
     <td height="50"><div align="right">
       <input name="email" type="text" class="required email" id="email" style="width:150px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $email ; ?>" maxlength="75" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:آدرس پست الکترونیک</div></td>
     <td><div align="right">
       <input name="cod_p" type="text" class="required digits" id="cod_p" style="width:150px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:20px" align="right" >:کد پستی</div></td>
     </tr>
   <tr>
     <td height="50" colspan="4" bgcolor="#FFFFFF"><div align="right">
       <input name="addres" type="text" class="required" id="addres" placeholder="آدرس" style="width:550px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $addres ; ?>" maxlength="450" readonly="readonly" xml:lang="fa"/>
       </div></td>
     <td><div style="margin-right:20px" align="right" >نشانی  پستی </div></td>
   </tr>
   <tr>
     <?php }  if ($no_bah=='2') { ?>
     <td height="38" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی</strong></div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <div align="right"  >
         <input name="co_sabt2" type="text" class="required" id="co_sabt2" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $no_co ; ?>" maxlength="20" readonly="readonly"  align="baseline" xml:lang="fa" />
       </div>
     </div></td>
     <td><div align="right">:نوع شرکت/ موسسه</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"  >
       <input name="co_name" type="text" class="required" id="co_name" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $co_name ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right">: نام شرکت / موسسه</div></td>
   </tr>
   <tr>
     <td height="45" bgcolor="#FFFFFF"><div align="right"  >
       <input name="co_sabt" type="text" class="required" id="co_sabt" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $co_sabt ; ?>" maxlength="20" readonly="readonly"  align="baseline" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: شماره ثبت</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="sh_meli" type="text" class="required digits" id="sh_meli" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $NationalCode ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right">: شناسه ملی</div></td>
   </tr>
   <tr>
     <td height="48" dir="rtl">&nbsp;</td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="pcal" type="text" class="pdate required" id="pcal2" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $date_sabt ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right">: تاریخ ثبت</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF"><div align="right">
       <input name="last_name" type="text" class="required" id="last_name" style="width:150px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $c_cod_m ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
       </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: کد مدیرعامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="name" type="text" class="required" id="name" style="width:150px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $c_f_name,$c_l_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
       </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right">: نام و نام خانوادگی مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF"><div align="right">
       <input name="tel_m2" type="text" class="required digits" id="tel_m2" style="width:150px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
       </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: شماره همراه</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="tel_s2" type="text" class="required digits" id="tel_s2" style="width:150px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
       </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
     <td height="50"><div align="right">
       <input name="email" type="text" class="required email" id="email" style="width:150px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $email ; ?>" maxlength="75" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:آدرس پست الکترونیک</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="cod_p" type="text" class="required digits" id="cod_p" style="width:150px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right" >:کد پستی</div></td>
   </tr>
   <tr>
     <td height="45" colspan="4" bgcolor="#FFFFFF"><div align="right">
       <input name="addres" type="text" class="required" id="addres" readonly="readonly" style="width:550px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $addres ; ?>" maxlength="450"  xml:lang="fa"/>
       </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right" >: آدرس شرکت</div></td>
     <td width="7">&nbsp;</td>
   </tr>
   <?php
 }
   ?>
   <tr>
     <td colspan="5" align="center">&nbsp;</td>
   </tr>
 </table>
 <p>&nbsp;</p>
      </form> 

       <p> <button  id="send" class="style8" style="width:150px ; height:45px "  onclick="close_window()">بستن پنجره</button></p>

           </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
 <?php  
} 
renderForm($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$co_name,$no_co,$sh_meli,$co_sabt,$add_abadi,$add_city);
}
else 
{
?>
<script>
window.location.href='manager_ind_benef.php';
</script>
<?php
}
?>
</p></td>
</tr>
</table></body>
</html>