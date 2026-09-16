<?php
include("../lock_p1.php");
include('../event.php');
include('../date_con.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
if  (isset($_POST['bah_cod_m']))
{
function renderForm($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$ostan_s,$shahr_s,$city_s,$rosta_s,$co_name,$no_co,$sh_meli,$co_sabt,$fa_1,$fa_2,$fa_3,$fa_4,$fa_5,$fa_6,$fa_7,$fa_8,$fa_9,$fa_10,$fa_11,$fa_12,$fa_13)
{ 
date_default_timezone_set('Asia/Tehran') ;
 $date_s = date_con(jdate("Y/m/d"));
 $bah_cod_m = $_POST['bah_cod_m'];
 $num_bah = $_POST['num_bah'];
 $add_abadi = $_POST["add_abadi"]; 
 $add_city = $_POST["add_city"]; 
 $no_bah = $_POST["no_bah"]; 
  $s_bah = $_POST["s_bah"]; 
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
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
</head>
<body>
     <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>

  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
<?php $name = '' ; ?>
	    <form action="" method="post" id="form1" name="form1">
 <p align="center" >&nbsp;</p>
 <p align="center" ><span class="style1">ثبت اطلاعات بهره بردار </span> </p>
 <table style="border:3px solid #069;" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
 <?php  if ($no_bah=='1') { ?>
  <td height="38" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی</strong></div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <select name="jens" class="required" id="jens" style="height:40px ; width:150px ; direction:rtl" tabindex="1">
         <option value="">انتخاب کنید</option>
         <option value="1">مرد</option>
         <option value="2">زن</option>
       </select>
     </div></td>
     <td><div align="right">:جنسیت</div></td>
     <td width="160" rowspan="7">&nbsp;</td>
     <td><div align="right">
       <input name="bah_cod_m" type="text" class="required digits" id="bah_cod_m" style="width:150px; height:30px ; background:#0CF " dir="ltr" lang="fa" value="<?php echo $bah_cod_m ; ?>" maxlength="10" xml:lang="fa" readonly="readonly" />
     </div></td>
     <td><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td width="221" height="47"><div align="right">
       <input name="last_name" type="text" class="required" id="last_name" style="width:150px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" xml:lang="fa" />
     </div></td>
     <td width="171"><div align="right">:نام خانوادگی</div></td>
     <td width="194"><div align="right">
       <input name="name" type="text" class="required" id="name" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $name ; ?>" maxlength="50" xml:lang="fa" />
     </div></td>
     <td width="141"><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="55"><div align="right">
       <input name="sh_sh" type="text" class="required digits" id="sh_sh" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $sh_sh ; ?>" maxlength="20" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td height="55" dir="rtl"><div align="right">
       <input name="date_t" type="text" class="pdate required" id="pcal1" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:30px" align="right" >:تاریخ تولد</div></td>
   </tr>
   <tr>
     <td height="55"><div align="right">
       <input name="fname" type="text" class="required" id="fname" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $fname ; ?>" maxlength="35" xml:lang="fa" />
     </div></td>
     <td><div align="right">:نام پدر</div></td>
     <td height="55" dir="rtl"><div align="right">
       <input name="m_sod" type="text" class="required" id="m_sod" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $m_sod ; ?>" maxlength="35" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:30px" align="right" >:محل صدور</div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <select name="er_mtah" class="required" id="er_mtah" style="height:40px ; width:150px ; direction:rtl" tabindex="9">
         <option value="">انتخاب کنید</option>
         <option value="1">بلی </option>
         <option value="2">خیر</option>
       </select>
     </div></td>
     <td><div align="right">:مدرک مرتبط با کشاورزی</div></td>
     <td><div align="right">
       <select name="m_tah" class="required" id="m_tah" style="height:40px ; width:150px ; direction:rtl" tabindex="8">
         <option value="">انتخاب کنید</option>
         <option value="1">بیسواد</option>
         <option value="2">خواندن و نوشتن</option>
         <option value="3">سیکل</option>
         <option value="4">دیپلم</option>
         <option value="5">فوق دیپلم</option>
         <option value="6">لیسانس</option>
         <option value="7">فوق لیسانس</option>
         <option value="8">دکتری</option>
         <option value="9">تحصیلات حوزوی</option>
         </select>
     </div></td>
     <td><div style="margin-right:30px" align="right" >:مدرک تحصیلی</div></td>
   </tr>
   <tr>
     <td height="46"><div align="right"><span class="style2">ضروری<img src="../files/sms.png" width="28" height="32" /></span>
       <input name="tel_m" type="text" class="required digits" id="tel_m" style="width:150px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td><div align="right">
       <input name="tel_s" type="text" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
     </tr>
   <tr>
     <td height="46">&nbsp;</td>
     <td>&nbsp;</td>
     <td><div align="right">
       <input name="cod_p" type="text" class="required digits" id="cod_p" style="width:150px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="10" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:30px" align="right" >:کد پستی</div></td>
   </tr>
  <?php if($s_bah==2) {?>
   <tr>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="rosta_s" type="text" placeholder="روستا" class="required " id="rosta_s" style="width:150px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $rosta_s ; ?>" maxlength="50" xml:lang="fa"/>
     </div></td>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="city_s" type="text"  placeholder="شهر" class="required" id="city_s" style="width:150px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="50" xml:lang="fa"/>
     </div></td>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="shahr_s" type="text"  placeholder="شهرستان" class="required " id="shahr_s" style="width:150px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $shahr_s ; ?>" maxlength="50" xml:lang="fa"/>
     </div></td>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="ostan_s" type="text" class="required " placeholder="استان" id="ostan_s" style="width:180px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $ostan_s ; ?>" maxlength="50" xml:lang="fa"/>
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
       <select name="no_co" class="required" id="no_co" style="height:40px ; width:180px ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="1"> شرکت سهامی</option>
         <option value="2">شرکت با مسئولیت محدود</option>
         <option value="3">شرکت تضامنی</option>
         <option value="4">شرکت مختلط غیر سهامی</option>
         <option value="5">شرکت مختلط سهامی</option>
         <option value="6"> شرکت نسبی</option>
         <option value="7">شرکت تعاونی</option>
       </select>
     </div></td>
     <td><div align="right">:نوع شرکت</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"  >
       <input name="co_name" type="text" class="required" id="co_name" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $co_name ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام شرکت</div></td>
   </tr>
   <tr>
     <td height="45" bgcolor="#FFFFFF"><div align="right"  >
       <input name="co_sabt" type="text" class="required" id="co_sabt" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $co_sabt ; ?>" maxlength="20"  align="baseline" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: شماره ثبت</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="sh_meli" type="text" class="required digits" id="sh_meli" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $sh_meli ; ?>" maxlength="20" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: شناسه ملی</div></td>
   </tr>
   <tr>
     <td height="48" dir="rtl"><div align="right">
       <input name="date_t" type="text" class="pdate required" id="pcal2" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: تاریخ ثبت</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="m_sod" type="text" class="required" id="m_sod" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $m_sod ; ?>" maxlength="35" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: محل ثبت</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF"><div align="right">
       <input name="last_name" type="text" class="required" id="last_name" style="width:150px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="name" type="text" class="required" id="name" style="width:150px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $name ; ?>" maxlength="50" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF"><div align="right"><span class="style2"><img src="../files/sms.png" width="28" height="32" /></span>
       <input name="tel_m" type="text" class="required digits" id="tel_m" style="width:150px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: شماره همراه</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="bah_cod_m" type="text" class="required digits" id="bah_cod_m" style="width:150px; height:30px ; background:#0CF " tabindex="1" dir="ltr" lang="fa" value="<?php echo $bah_cod_m ; ?>" maxlength="10"  readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:کدملی مدیر عامل</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF"><div align="right">
       <input name="cod_p" type="text" class="required digits" id="cod_p" style="width:150px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="10" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">:کد پستی</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="tel_s" type="text" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
    <?php if($s_bah==2) {?>
   <tr>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="rosta_s" type="text" placeholder="روستا" class="required" id="rosta_s" style="width:150px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $rosta_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="city_s" type="text"  placeholder="شهر" class="required" id="city_s" style="width:150px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $city_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="shahr_s" type="text"  placeholder="شهرستان" class="required" id="shahr_s" style="width:150px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $shahr_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td height="45" bgcolor="#FFFFCC"><div align="right">
       <input name="ostan_s" type="text" class="required" placeholder="استان" id="ostan_s" style="width:180px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $ostan_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >: آدرس شرکت</div></td>
   
     <td width="5"></p></td>
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
     <td width="167" height="51" bgcolor="#FFFFFF"><div align="right">
       <p>
         <label> بلی
           <input name="fa_13" type="radio"   class="required green" id="fa_1_12" tabindex="27"   value="1" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_13"   class="required red"   checked="checked"  value="2" id="fa_1_13" />
         </label>
         <br />
       </p>
     </div></td>
     <td width="108" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:صنایع کشاورزی</div></td>
     <td width="118" bgcolor="#FFFFFF"><div align="right">
       <p>
         <label> بلی
           <input name="fa_8" type="radio" class="required green" id="fa_1_14" tabindex="22" value="1" />
           </label>
         <br />
         <label> خیر</label>
         <label>
           <input name="fa_8" type="radio" class="red" id="fa_1_15" checked="checked"  value="2" />
           </label>
         <br />
         </p>
     </div></td>
     <td width="171" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:طیور سنتی</div></td>
     <td width="101" bgcolor="#FFFFFF"><div align="right">
       <p>
         <label class="required"> بلی
           <input name="fa_1" type="radio"   class="required green" id="fa_1_0" tabindex="16"   value="1" />
           </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_1"   class="required red"   checked="checked"  value="2" id="fa_1_1" />
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
           <input name="fa_9" type="radio"   class="required green" id="fa_1_16" tabindex="23"   value="1" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_9"   class="required red"   checked="checked"  value="2" id="fa_1_17" />
         </label>
         <br />
       </p>
     </div></td>
     <td bgcolor="#FFFFCC"><div style="margin-right:30px" align="right">:طیور صنعتی</div></td>
     <td bgcolor="#FFFFCC"><div align="right">
       <div align="right">
         <p>
           <label> بلی
             <input name="fa_2" type="radio"   class="required green" id="fa_1_2" tabindex="17"   value="1" />
             </label>
           <br />
           <label> خیر</label>
           <label>
             <input type="radio" name="fa_2"   class="required red"   checked="checked"  value="2" id="fa_1_3" />
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
           <input name="fa_10" type="radio"   class="required green" id="fa_1_18" tabindex="24"   value="1" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_10"   class="required red"   checked="checked"  value="2" id="fa_1_19" />
         </label>
         <br />
       </p>
     </div></td>
     <td><div style="margin-right:30px" align="right">:زنبور عسل</div></td>
     <td bgcolor="#FFFFFF"><div align="right">
       <p>
         <label> بلی
           <input type="radio" name="fa_3"   class="required green"   value="1" id="fa_1_4" />
           </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_3"   class="required red"   checked="checked"  value="2" id="fa_1_5" />
           </label>
         <br />
         </p>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:کشت گلخانه ای</div></td>
   </tr>
   <tr>
     <td height="52" bgcolor="#FFFFCC">&nbsp;</td>
     <td bgcolor="#FFFFCC">&nbsp;</td>
     <td height="48" bgcolor="#FFFFCC"><div align="right">
       <p>
         <label> بلی
           <input name="fa_11" type="radio"   class="required green" id="fa_1_20" tabindex="25"   value="1" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_11"   class="required red"   checked="checked"  value="2" id="fa_1_21" />
         </label>
         <br />
       </p>
     </div></td>
     <td bgcolor="#FFFFCC"><div  style="margin-right:30px" align="right">:کرم ابریشم</div></td>
     <td bgcolor="#FFFFCC"><div align="right">
       <p>
         <label> بلی
           <input name="fa_45" type="radio"   class="required green" id="fa_1_6" tabindex="18"   value="1" />
           </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_45"   class="required red"   checked="checked"  value="2" id="fa_1_7" />
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
           <input name="fa_12" type="radio"   class="required green" id="fa_1_22" tabindex="26"   value="1" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_12"   class="required red"   checked="checked"  value="2" id="fa_1_23" />
         </label>
         <br />
       </p>
     </div></td>
     <td><div style="margin-right:30px" align="right">:پرورش ماهی</div></td>
     <td bgcolor="#FFFFFF"><div align="right">
       <p>
         <label> بلی
           <input name="fa_67" type="radio"   class="required green" id="fa_1_10" tabindex="20"   value="1" />
           </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_67"   class="required red"   checked="checked"  value="2" id="fa_1_11" />
           </label>
         <br />
         </p>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:دام سبک </div></td>
     </tr>
 </table>
 <p>&nbsp;</p>
 <div align="center">
   <p>
     <input type="hidden" name="no_bah" value=<?php echo $no_bah; ?> />
     <input type="hidden" name="num_bah" value=<?php echo $num_bah; ?> />
     <input type="hidden" name="s_bah" value=<?php echo $s_bah; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="submit" name="action" value="ثبت و ادامه" style="width:150px ; height:45px" tabindex="28"  id="btn1" onclick="setTimeout(disableFunction, 1);"/>
        </p>
      </div>
<p align="center" >&nbsp;</p>
</form> 
<script>
function disableFunction() {
    document.getElementById("btn1").disabled = 'true';
		$("#btn1").attr("disabled","");
}
</script>
        <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal1' );
		  </script>
                <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal2' );
		  </script>
                <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal3' );
		  </script>
           </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
 <?php  
} 
 include('../login/config.php');
 if (isset($_POST['action'])) 
 {  
$date_s = $date_edit ; 
$mor_cod_m = $login_session ;
$no_bah = $_POST['no_bah']; 
$num_bah = $_POST['num_bah']; 
$bah_cod_m = $_POST['bah_cod_m']; 
$cod_p = $_POST['cod_p']; 
$jens= $_POST['jens']; 
$name = $_POST['name']; 
$last_name = $_POST['last_name']; 
$date_t  = $_POST['date_t']; 
$sh_sh   = $_POST['sh_sh']; 
$m_sod   = $_POST['m_sod']; 
$fname   = $_POST['fname']; 
$m_tah   = $_POST['m_tah']; 
$er_mtah = $_POST['er_mtah'];
$tel_s   = $_POST['tel_s']; 
$tel_m  = $_POST['tel_m']; 
$ostan_s  = $_POST['ostan_s'] ;
$shahr_s  = $_POST['shahr_s'] ;
$city_s   =  $_POST['city_s'] ;
$rosta_s  = $_POST['rosta_s'] ;
$co_name  = $_POST['co_name'] ;
$no_co  = $_POST['no_co'] ;
$sh_meli  = $_POST['sh_meli'] ;
$co_sabt  = $_POST['co_sabt'] ;
$add_city = $_POST['add_city'] ;
$add_abadi = $_POST['add_abadi'] ;
$s_bah = $_POST['s_bah']; 
 $fa_1   = $_POST['fa_1'] ;
 $fa_2   = $_POST['fa_2'] ;
 $fa_3   = $_POST['fa_3'] ;
 $fa_45   = $_POST['fa_45'] ;
 $fa_67   = $_POST['fa_67'] ;         
 $fa_8   = $_POST['fa_8'] ;
 $fa_9   = $_POST['fa_9'] ;
 $fa_10  = $_POST['fa_10'] ;
 $fa_11  = $_POST['fa_11'] ;
 $fa_12  = $_POST['fa_12'] ;
 $fa_13  = $_POST['fa_13'] ;
// تعریف متغیرهای که هنگام لود فرم خالی رد میشن
if ($no_bah=='1') {$co_name = '' ; $no_co=''; $sh_meli=''; $co_sabt='';}
if ($no_bah=='2') {$fname= '' ; $m_tah='' ; $er_mtah= '' ; $jens='' ; $sh_sh=''; }
if ($s_bah=='1')
 {
  if(strlen($add_abadi)>5) 
   {
    $query = "SELECT ostan,city,abadi from list_abadi where add_abadi = '$add_abadi'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $ostan_s = $row['ostan']; 
    $shahr_s = $row['city']; 
    $rosta_s = $row['abadi']; 
    $city_s = '-' ;	 
	$add_city = '' ;

   }
 if(strlen($add_city)>5) 
  {
    $query = "SELECT ostan,city,shahr from list_city where add_city = '$add_city'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $ostan_s = $row['ostan']; 
    $shahr_s = $row['city']; 
    $rosta_s =  '-';
    $city_s = $row['shahr']; 
    $add_abadi = '' ;
  }
}
if ($s_bah=='2')
 {
  if(strlen($add_abadi)>5) 
   {
	$add_city = '' ;
   }
 if(strlen($add_city)>5) 
  {
    $add_abadi = '' ;
  }
}
    $query = "SELECT id_ostan,id_city,id_mar,cod_m from users where username = '$login_session' and S_access = '1'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id_ostan = $row['id_ostan']; 
    $id_city = $row['id_city']; 
    $id_mar = $row['id_mar']; 
    $mor_cod_m = $row['cod_m']; 
 $query = "INSERT IGNORE INTO bah (date_s,mor_cod_m,no_bah,bah_cod_m,num_bah,cod_p,jens,name,last_name,date_t,sh_sh,m_sod,fname,m_tah,er_mtah,tel_s,tel_m,ostan_s,shahr_s,city_s,rosta_s,co_name,no_co,sh_meli,co_sabt,fa_1,fa_2,fa_3,fa_45,fa_67,fa_8,fa_9,fa_10,fa_11,fa_12,fa_13,add_abadi,add_city,id_city,id_mar,s_bah,id_ostan) VALUES(:date_s,:mor_cod_m,:no_bah,:bah_cod_m,:num_bah,:cod_p,:jens,:name,:last_name, :date_t,:sh_sh,:m_sod,:fname,:m_tah,:er_mtah,:tel_s,:tel_m,:ostan_s,:shahr_s,:city_s,:rosta_s,:co_name,:no_co,:sh_meli,:co_sabt,:fa_1,:fa_2,:fa_3,:fa_45,:fa_67,:fa_8,:fa_9,:fa_10,:fa_11,:fa_12,:fa_13,:add_abadi,:add_city,:id_city,:id_mar,:s_bah,:id_ostan)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':no_bah'=>$no_bah,':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah,':cod_p'=>$cod_p,':jens'=>$jens,':name'=>$name,':last_name'=>$last_name,':date_t'=>$date_t,':sh_sh'=>$sh_sh,':m_sod'=>$m_sod,':fname'=>$fname,':m_tah'=>$m_tah,':er_mtah'=>$er_mtah,':tel_s'=>$tel_s,':tel_m'=>$tel_m,':ostan_s'=>$ostan_s,':shahr_s'=>$shahr_s,':city_s'=>$city_s,':rosta_s'=>$rosta_s,':co_name'=>$co_name,':no_co'=>$no_co,':sh_meli'=>$sh_meli,':co_sabt'=>$co_sabt,':fa_1'=>$fa_1,':fa_2'=>$fa_2,':fa_3'=>$fa_3,':fa_45'=>$fa_45,':fa_67'=>$fa_67,':fa_8'=>$fa_8,':fa_9'=>$fa_9,':fa_10'=>$fa_10,':fa_11'=>$fa_11,':fa_12'=>$fa_12,':fa_13'=>$fa_13,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':id_city'=>$id_city,':id_mar'=>$id_mar,':s_bah'=>$s_bah,':id_ostan'=>$id_ostan));
// ارسال اس ام اس 
//$text= " با سلام اطلاعات شمادر سامانه ثبت مجوز فعالیت های کشاورزی سازمان نظام مهندسی استان ثبت شد کد رهگیری ".$cod_p." اطلاعات بیشتر در سایت سامانه  به آدرس www.aeo-azsh.ir" ; 
//sms($tel_m,$text) ;
 // ثبت در بانک پیگیری
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'ثبت اطلاعات بهره بردار - '.$bah_cod_m,$id_ostan) ; 
 // once saved, redirect back to the view page 
 //header("Location: user_view.php");
unset($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$ostan_s,$shahr_s,$city_s,$rosta_s,$co_name,$no_co,$sh_meli,$co_sabt,$fa_1,$fa_2,$fa_3,$fa_45,$fa_67,$fa_8,$fa_9,$fa_10,$fa_11,$fa_12,$fa_13,$add_abadi,$add_city);
alert ('اطلاعات بهره بردار با موفقیت ثبت شد '.$date_s) ;
?>
<form  name="myform" class="myform" method="post" action="benef.php">
<input type="hidden" name="cod_p" value="<?php echo $cod_p ;?>">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
} 
 else 
 // if the form hasn't been submitted, display the form 
{ 
renderForm($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$ostan_s,$shahr_s,$city_s,$rosta_s,$co_name,$no_co,$sh_meli,$co_sabt,$fa_1,$fa_2,$fa_3,$fa_45,$fa_67,$fa_8,$fa_9,$fa_10,$fa_11,$fa_12,$fa_13,$add_abadi,$add_city);
}
}
else 
{
?>
<script>
window.location.href='index.php';
</script>
<?php
}
?>
</p></td>
</tr>
</td>
</table></body>
</body>
</html>