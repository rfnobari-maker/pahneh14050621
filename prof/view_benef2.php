<?php
include('../lock_p1.php');
include('../event.php');
if  (isset($_POST['bah_cod_m']))
{
function renderForm($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$ostan_s,$shahr_s,$city_s,$rosta_s,$co_name,$no_co,$sh_meli,$co_sabt,$fa_1,$fa_2,$fa_3,$fa_45,$fa_67,$fa_8,$fa_9,$fa_10,$fa_11,$fa_12,$fa_13)
{ 
 $bah_cod_m = $_POST['bah_cod_m'];
 $num_bah = $_POST['num_bah'];
include('../login/config.php');
$query = "SELECT * from bah where  bah_cod_m = :bah_cod_m and num_bah = :num_bah"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_s= $row['city_s'] ; 
$mor_cod_m = $row['mor_cod_m'] ; 
$no_bah = $row['no_bah']; 
$bah_cod_m = $row['bah_cod_m']; 
$cod_p = $row['cod_p']; 
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
echo $add_city = $row['add_city'] ;
$add_abadi = $row['add_abadi'] ;
$s_bah = $row['s_bah']; 
 $fa_1   = $row['fa_1'] ;
 $fa_2   = $row['fa_2'] ;
 $fa_3   = $row['fa_3'] ;
 $fa_45   = $row['fa_45'] ;
 $fa_67   = $row['fa_67'] ;         
 $fa_8   = $row['fa_8'] ;
 $fa_9   = $row['fa_9'] ;
 $fa_10  = $row['fa_10'] ;
 $fa_11  = $row['fa_11'] ;
 $fa_12  = $row['fa_12'] ;
 $fa_13  = $row['fa_13'] ;
if ($s_bah == '1') $v_s_bah = 'ساکن' ;
if ($s_bah == '2') $v_s_bah = 'غیر ساکن' ;
if ($s_bah == '3') $v_s_bah = 'عشایر' ;
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<link href="radio.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="../jspc-gray.css">
	<script type="text/javascript" src="../js-persian-cal.min.js"></script>
    <script type="text/javascript" src="../script.js"></script>
	<script src="../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
         //$("#form1").validate();
        });
    </script>
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
 <p align="center" >&nbsp;</p>
 <p align="center" ><span class="style1"> مشاهده اطلاعات بهره بردار </span> </p>
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
     <td width="170" rowspan="7">&nbsp;</td>
     <td><div align="right">
       <input name="bah_cod_m" type="text" class="required digits" id="bah_cod_m" style="width:150px; height:30px" dir="ltr" lang="fa" value="<?php echo $bah_cod_m ; ?>" maxlength="10" xml:lang="fa" readonly="readonly" />
     </div></td>
     <td><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td width="235" height="47"><div align="right">
       <input name="last_name" type="text" class="required" id="last_name" style="width:150px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td width="182"><div align="right">:نام خانوادگی</div></td>
     <td width="184"><div align="right">
       <input name="name" type="text" class="required" id="name" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $bah_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td width="172"><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="55"><div align="right">
       <input name="sh_sh" type="text" class="required digits" id="sh_sh" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $sh_sh ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td height="55" dir="rtl"><div align="right">
       <input name="date_t" type="text" class="pdate required" id="pcal1" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:30px" align="right" >:تاریخ تولد</div></td>
   </tr>
   <tr>
     <td height="55"><div align="right">
       <input name="fname" type="text" class="required" id="fname" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $fname ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td><div align="right">:نام پدر</div></td>
     <td height="55" dir="rtl"><div align="right">
       <input name="m_sod" type="text" class="required" id="m_sod" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $m_sod ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:30px" align="right" >:محل صدور</div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <select name="er_mtah" disabled="disabled" class="required" id="er_mtah" style="height:40px ; width:150px ; direction:rtl" tabindex="9">
         <option value="">انتخاب کنید</option>
         <option value="1" <?php if($er_mtah=="1") echo "selected='selected'"?>>بلی </option>
         <option value="2" <?php if($er_mtah=="2") echo "selected='selected'"?>>خیر</option>
       </select>
     </div></td>
     <td><div align="right">:مدرک مرتبط با کشاورزی</div></td>
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
     <td><div style="margin-right:30px" align="right" >:مدرک تحصیلی</div></td>
   </tr>
   <tr>
     <td height="46"><div align="right"><span class="style2"><img src="../files/sms.png" width="28" height="32" /></span>
       <input name="tel_m" type="text" class="required digits" id="tel_m" style="width:150px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td><div align="right">
       <input name="tel_s" type="text" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
     </tr>
   <tr>
     <td height="46"><div align="right"><?php echo $v_s_bah ;?></div></td>
     <td><div align="right">:وضعیت سکونت</div></td>
     <td><div align="right">
       <input name="cod_p" type="text" class="required digits" id="cod_p" style="width:150px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:30px" align="right" >:کد پستی</div></td>
     </tr>
  <?php if($s_bah==2) {?>
   <tr>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="rosta_s" type="text" class="required " id="rosta_s" placeholder="روستا" style="width:150px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $rosta_s ; ?>" maxlength="50" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="city_s" type="text" class="required" id="city_s"  placeholder="شهر" style="width:150px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $city_s ; ?>" maxlength="50" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="shahr_s" type="text" class="required " id="shahr_s"  placeholder="شهرستان" style="width:150px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $shahr_s ; ?>" maxlength="50" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="ostan_s" type="text" class="required " id="ostan_s" placeholder="استان" style="width:180px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $ostan_s ; ?>" maxlength="50" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFCC"><div style="margin-right:30px" align="right" >: محل سکونت</div></td>
   </tr>
   <?php }?>
   <tr>
 <?php }  if ($no_bah=='2') { ?>
     <p class="one" >&nbsp;</p>
     <td height="38" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی</strong></div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <select name="no_co" disabled="disabled" class="required" id="no_co" style="height:40px ; width:180px ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="1" <?php if($no_co=="1") echo "selected='selected'"?>> شرکت سهامی</option>
         <option value="2" <?php if($no_co=="2") echo "selected='selected'"?>>شرکت با مسئولیت محدود</option>
         <option value="3"  <?php if($no_co=="3") echo "selected='selected'"?>>شرکت تضامنی</option>
         <option value="4" <?php if($no_co=="4") echo "selected='selected'"?>>شرکت مختلط غیر سهامی</option>
         <option value="5" <?php if($no_co=="5") echo "selected='selected'"?>>شرکت مختلط سهامی</option>
         <option value="6" <?php if($no_co=="6") echo "selected='selected'"?>> شرکت نسبی</option>
         <option value="7" <?php if($no_co=="7") echo "selected='selected'"?>>شرکت تعاونی</option>
         <option value="8" <?php if ($no_co =='8') echo 'selected=selected'?>>موسسه عمومی</option>
       </select>
     </div></td>
     <td><div align="right">:نوع شرکت/ موسسه</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"  >
       <input name="co_name" type="text" class="required" id="co_name" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $co_name ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام شرکت / موسسه</div></td>
   </tr>
   <tr>
     <td height="45" bgcolor="#FFFFFF"><div align="right"  >
       <input name="co_sabt" type="text" class="required" id="co_sabt" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $co_sabt ; ?>" maxlength="20" readonly="readonly"  align="baseline" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: شماره ثبت</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="sh_meli" type="text" class="required digits" id="sh_meli" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $sh_meli ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: شناسه ملی</div></td>
   </tr>
   <tr>
     <td height="48" dir="rtl"><div align="right">
       <input name="date_t" type="text" class="pdate required" id="pcal2" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: تاریخ ثبت</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="m_sod" type="text" class="required" id="m_sod" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $m_sod ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: محل ثبت</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF"><div align="right">
       <input name="last_name" type="text" class="required" id="last_name" style="width:150px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="name" type="text" class="required" id="name" style="width:150px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $bah_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF"><div align="right"><span class="style2"><img src="../files/sms.png" width="28" height="32" /></span>
       <input name="tel_m" type="text" class="required digits" id="tel_m" style="width:150px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: شماره همراه</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="bah_cod_m" type="text" class="required digits" id="bah_cod_m" style="width:150px; height:30px " tabindex="1" dir="ltr" lang="fa" value="<?php echo $bah_cod_m ; ?>" maxlength="10"  readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:کدملی مدیر عامل</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF"><div align="right">
       <input name="cod_p" type="text" class="required digits" id="cod_p" style="width:150px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">:کد پستی</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="tel_s" type="text" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
    <?php if($s_bah==2) {?>
   <tr>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="rosta_s" type="text" class="required" id="rosta_s" placeholder="روستا" style="width:150px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $rosta_s ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="city_s" type="text" class="required" id="city_s"  placeholder="شهر" style="width:150px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $city_s ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="shahr_s" type="text" class="required" id="shahr_s"  placeholder="شهرستان" style="width:150px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $shahr_s ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="ostan_s" type="text" class="required" id="ostan_s" placeholder="استان" style="width:180px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $ostan_s ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >: آدرس شرکت</div></td>
   
     <td width="7"></p></td>
   </tr>  <?php
   }
 }
   ?>
   <tr>
     <td colspan="5" align="center">&nbsp;</td>
   </tr>
 </table>
 <table width="95%" height="304" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
   <tr>
     <td height="38" colspan="6" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>زمینه فعالیت کشاورزی</strong></div></td>
   </tr>
   <tr>
     <td width="142" height="51" bgcolor="#FFFFFF"><div align="right">
       <p>
         <label> بلی
           <input name="fa_13" type="radio"  disabled="disabled"   class="required green" id="fa_1_12" tabindex="27"   <?php if($fa_13=="1") echo "checked='checked'"?>  value="1" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio"  disabled="disabled" name="fa_13"   class="required red"  <?php if($fa_13=="2") echo "checked='checked'"?> value="2" id="fa_1_13" />
         </label>
         <br />
       </p>
     </div></td>
     <td width="109" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:صنایع کشاورزی</div></td>
     <td width="112" bgcolor="#FFFFFF"><div align="right">
       <p>
         <label> بلی
           <input name="fa_8" type="radio"  disabled="disabled" class="required green" id="fa_1_14" tabindex="22" <?php if($fa_8=="1") echo "checked='checked'"?>  value="1" />
           </label>
         <br />
         <label> خیر</label>
         <label>
           <input name="fa_8" type="radio"  disabled="disabled" class="red" id="fa_1_15" <?php if($fa_8=="2") echo "checked='checked'"?> value="2" />
           </label>
         <br />
         </p>
     </div></td>
     <td width="170" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:طیور سنتی</div></td>
     <td width="132" bgcolor="#FFFFFF"><div align="right">
       <p>
         <label class="required"> بلی
           <input name="fa_1" type="radio"  disabled="disabled"   class="required green" id="fa_1_0"   <?php if($fa_1=="1") echo "checked='checked'"?>  value="1" />
           </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio"  disabled="disabled" name="fa_1"   class="required red"  <?php if($fa_1=="2") echo "checked='checked'"?>  value="2" id="fa_1_1" />
           </label>
         <br />
         </p>
     </div></td>
     <td width="166" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:دارای اراضی زراعی </div></td>
   </tr>
   <tr>
     <td height="53" bgcolor="#FFFFCC">&nbsp;</td>
     <td bgcolor="#FFFFCC">&nbsp;</td>
     <td bgcolor="#FFFFCC"><div align="right">
       <p>
         <label> بلی
           <input name="fa_9" type="radio"  disabled="disabled"   class="required green" id="fa_1_16" tabindex="23"   <?php if($fa_9=="1") echo "checked='checked'"?>  value="1" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio"  disabled="disabled" name="fa_9"   class="required red"  <?php if($fa_9=="2") echo "checked='checked'"?> value="2" id="fa_1_17" />
         </label>
         <br />
       </p>
     </div></td>
     <td bgcolor="#FFFFCC"><div style="margin-right:30px" align="right">:طیور صنعتی</div></td>
     <td bgcolor="#FFFFCC"><div align="right">
       <div align="right">
         <p>
           <label> بلی
             <input name="fa_2" type="radio"  disabled="disabled"   class="required green" id="fa_1_2" tabindex="17"   <?php if($fa_2=="1") echo "checked='checked'"?>  value="1" />
             </label>
           <br />
           <label> خیر</label>
           <label>
             <input type="radio"  disabled="disabled" name="fa_2"   class="required red"  <?php if($fa_2=="2") echo "checked='checked'"?>  value="2" id="fa_1_3" />
             </label>
           <br />
           </p>
         </div>
     </div></td>
     <td bgcolor="#FFFFCC"><div style="margin-right:30px" align="right">:باغ و قلمستان</div></td>
   </tr>
   <tr>
     <td height="51" bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td><div align="right">
       <p>
         <label> بلی
           <input name="fa_10" type="radio"  disabled="disabled"   class="required green" id="fa_1_18" tabindex="24"   <?php if($fa_10=="1") echo "checked='checked'"?>  value="1" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio"  disabled="disabled" name="fa_10"   class="required red"  <?php if($fa_10=="2") echo "checked='checked'"?> value="2" id="fa_1_19" />
         </label>
         <br />
       </p>
     </div></td>
     <td><div style="margin-right:30px" align="right">:زنبور عسل</div></td>
     <td bgcolor="#FFFFFF"><div align="right">
       <p>
         <label> بلی
           <input type="radio"  disabled="disabled"  name="fa_3"   class="required green"   <?php if($fa_3=="1") echo "checked='checked'"?>  value="1" id="fa_1_4" />
           </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio"  disabled="disabled" name="fa_3"   class="required red"  <?php if($fa_3=="2") echo "checked='checked'"?> value="2" id="fa_1_5" />
           </label>
         <br />
         </p>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:کشت گلخانه ای</div></td>
   </tr>
   <tr>
     <td height="52" bgcolor="#FFFFCC">&nbsp;</td>
     <td bgcolor="#FFFFCC">&nbsp;</td>
     <td width="112" height="48" bgcolor="#FFFFCC"><div align="right">
       <p>
         <label> بلی
           <input name="fa_11" type="radio"  disabled="disabled"   class="required green" id="fa_1_20" tabindex="25"  <?php if($fa_11=="1") echo "checked='checked'"?>  value="1" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio"  disabled="disabled" name="fa_11"   class="required red"  <?php if($fa_11=="2") echo "checked='checked'"?> value="2" id="fa_1_21" />
         </label>
         <br />
       </p>
     </div></td>
     <td width="170" bgcolor="#FFFFCC"><div  style="margin-right:30px" align="right">:کرم ابریشم</div></td>
     <td bgcolor="#FFFFCC"><div align="right">
       <p>
         <label> بلی
           <input name="fa_45" type="radio"  disabled="disabled"   class="required green" id="fa_1_6" tabindex="18"  <?php if($fa_45=="1") echo "checked='checked'"?>  value="1" />
           </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio"  disabled="disabled" name="fa_45"   class="required red" <?php if($fa_45=="2") echo "checked='checked'"?>  value="2" id="fa_1_7" />
           </label>
         <br />
         </p>
     </div></td>
     <td bgcolor="#FFFFCC"><div style="margin-right:30px" align="right">:دام سنگین </div></td>
   </tr>
   <tr>
     <td>&nbsp;</td>
     <td height="59">&nbsp;</td>
     <td height="53"><div align="right">
       <p>
         <label> بلی
           <input name="fa_12" type="radio"  disabled="disabled"   class="required green" id="fa_1_22" tabindex="26"   <?php if($fa_12=="1") echo "checked='checked'"?>  value="1" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio"  disabled="disabled" name="fa_12"   class="required red" <?php if($fa_12=="2") echo "checked='checked'"?>  value="2" id="fa_1_23" />
         </label>
         <br />
       </p>
     </div></td>
     <td><div style="margin-right:30px" align="right">:پرورش ماهی</div></td>
     <td bgcolor="#FFFFFF"><div align="right">
       <p>
         <label> بلی
           <input name="fa_67" type="radio"  disabled="disabled"   class="required green" id="fa_1_10" tabindex="20" <?php if($fa_67=="1") echo "checked='checked'"?>  value="1" />
           </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio"  disabled="disabled" name="fa_67"   class="required red"  <?php if($fa_67=="2") echo "checked='checked'"?> value="2" id="fa_1_11" />
           </label>
         <br />
         </p>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:دام سبک</div></td>
     </tr>
 </table>
 <p>&nbsp;</p>
      </form> 

       <p> <button class=" RedButton"  id="send" style="width:150px ; height:45px ;" onclick="close_window()">بستن پنجره</button></p></p>  
                  </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
 <?php  
} 
renderForm($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$ostan_s,$shahr_s,$city_s,$rosta_s,$co_name,$no_co,$sh_meli,$co_sabt,$fa_1,$fa_2,$fa_3,$fa_45,$fa_67,$fa_8,$fa_9,$fa_10,$fa_11,$fa_12,$fa_13,$add_abadi,$add_city);
}
else 
{
?>
<script>
window.location.href='manager_benef.php';
</script>
<?php
}
?>
</p></td>
</tr>
</table></body>
</body>
</html>