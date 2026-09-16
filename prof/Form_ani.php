<?php
include("../lock_p1.php");
include('../date_con.php');
require_once('../Jalali.php');
//require_once('../ersal_p.php');
if  (1==1)
//if  (isset($_POST['no_mt']))
{
function renderForm($error,$no_dar,$no_mt,$date_s,$city,$bakh,$rosta,$no_fa,$z_to,$m_hadaf,$z_kol,$z_mo,$unit,$no_sh,$p_fa,$p_as,$arz_j,$tol_j,$adres_tarh,$mas_kol,$mas_mos,$name,$last_name ,$sh_sh,$date_t,$m_cod,$tel_s ,$tel_m,$m_sod,$fname,$m_tah,$addres,$co_name,$sh_meli,$f_no,$f_sh,$f_date,$List1,$List2,$f_mas_kol,$f_mas_mos,$f_z_kol,$f_z_mo,$f_unit,$f_name,$f_last_name,$f_co_name,$f_co_sabt)
{ 
date_default_timezone_set('Asia/Tehran') ;
$date_s = date_con(jdate("Y/m/d"));
$no_bah = $_POST['no_bah'] ;
$no_fa = $_POST['no_fa'] ;
$f_no = $_POST['no_mmoj'] ;
$no_dar = $_POST['no_dar'] ;
$m_hadaf = $_POST['no_mhad'] ;
$no_mt= $_POST['no_mt'] ;
$m_cod = $_POST['m_cod'] ;
if ($no_mt==1) 
{
	$v_no_mt = "حقیقی" ;
}
else
{
	$v_no_mt = "حقوقی" ;
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>ثبت کاربر : سازمان نظام مهندسی کشاورزی و منابع طبیعی استان</title>
	<link rel="stylesheet" href="jspc-gray.css">
	<script type="text/javascript" src="js-persian-cal.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
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
     <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="file:///J|/pahne bandi/pahneh/files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>

  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
	    <form action="" method="post" id="form1" name="form1">
 <p align="center" >&nbsp;</p>
 <p align="center" ><span class="style1">ثبت درخواست</span> مجوز دامداری </p>
 <table style="border:3px solid #069;" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <?php
  if ($no_bah=='1') 
     {
?>
     <td height="38" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی</strong></div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <select name="m_tah" class="required" id="m_tah" style="height:40px ; width:150px ; direction:rtl" tabindex="35">
         <option value="">انتخاب کنید</option>
         <option value="1">مرد</option>
         <option value="2">زن</option>
       </select>
     </div></td>
     <td><div align="right">:جنسیت</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
       <input name="bah_cod_m" type="text" class="required digits" id="bah_cod_m" style="width:150px; height:30px ; background:#0CF " dir="ltr" lang="fa" value="<?php echo $bah_cod_m ; ?>" maxlength="10" xml:lang="fa" readonly="readonly" />
     </div></td>
     <td><div style="margin-right:65px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td width="234" height="47"><div align="right">
       <input name="last_name2" type="text" class="required" style="width:200px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" xml:lang="fa" />
     </div></td>
     <td width="156"><div align="right">:نام خانوادگی</div></td>
     <td width="88">&nbsp;</td>
     <td width="234"><div align="right">
       <input name="name2" type="text" class="required" style="width:200px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $name ; ?>" maxlength="50" xml:lang="fa" />
     </div></td>
     <td width="177"><div style="margin-right:65px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="54"><div align="right">
       <input name="sh_sh2" type="text" class="required digits" id="sh_sh2" style="width:150px; height:30px ; " tabindex="31" dir="rtl" lang="fa" value="<?php echo $sh_sh ; ?>" maxlength="20" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td width="88">&nbsp;</td>
     <td height="55" dir="rtl"><div align="right">
       <input name="pcal" type="text" class="pdate required" id="pcal1" style="width:150px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:65px" align="right" >:تاریخ تولد</div></td>
   </tr>
   <tr>
     <td height="55"><div align="right">
       <input name="fname2" type="text" class="required" id="fname2" style="width:200px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $fname ; ?>" maxlength="35" xml:lang="fa" />
     </div></td>
     <td><div align="right">:نام پدر</div></td>
     <td width="88">&nbsp;</td>
     <td height="55" dir="rtl"><div align="right">
       <input name="m_sab" type="text" class="required" id="m_sab" style="width:150px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $m_sab ; ?>" maxlength="35" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:65px" align="right" >:محل صدور</div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <select name="m_tah" class="required" id="m_tah" style="height:40px ; width:150px ; direction:rtl" tabindex="35">
         <option value="">انتخاب کنید</option>
         <option value="1">بلی </option>
         <option value="2">خیر</option>
       </select>
     </div></td>
     <td><div align="right">:مدرک مرتبط با کشاورزی</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
       <select name="m_tah2" class="required" id="m_tah2" style="height:40px ; width:150px ; direction:rtl" tabindex="35">
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
     <td><div style="margin-right:65px" align="right" >:مدرک تحصیلی</div></td>
   </tr>
   <tr>
     <td height="46"><div align="right"><span class="style2"><img src="../files/sms.png" width="28" height="32" /></span>
       <input name="tel_m2" type="text" class="required digits" id="tel_m2" style="width:150px; height:30px ; " tabindex="37" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td width="88">&nbsp;</td>
     <td><div align="right">
       <input name="tel_s2" type="text" class="required digits" id="tel_s2" style="width:150px; height:30px ; " tabindex="36" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:65px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
     <td height="47" colspan="4"><div align="right"></div></td>
     <td><div style="margin-right:65px" align="right" >: محل سکونت</div></td>
   </tr>
   <tr>
     <?php
}
  if ($no_bah=='2') 
     {
?>
     <p class="one" >&nbsp;</p>
     <td height="38" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی</strong></div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <select name="m_tah" class="required" id="m_tah" style="height:40px ; width:150px ; direction:rtl" tabindex="35">
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
       <input name="co_name" type="text" class="required" id="co_name" style="width:200px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $co_name ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:65px" align="right">: نام شرکت</div></td>
   </tr>
   <tr>
     <td height="45" bgcolor="#FFFFFF"><div align="right"  >
       <input name="co_sabt" type="text" class="required" id="co_sabt" style="width:200px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $sh_sh ; ?>" maxlength="20"  align="baseline" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: شماره ثبت</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="sh_meli" type="text" class="required digits" id="sh_meli" style="width:150px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $sh_meli ; ?>" maxlength="20" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:65px" align="right">: شناسه ملی</div></td>
   </tr>
   <tr>
     <td height="48" dir="rtl"><div align="right">
       <input name="pcal" type="text" class="pdate required" id="pcal" style="width:150px; height:30px ; " tabindex="31" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: تاریخ ثبت</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="m_sab2" type="text" class="required" id="m_sab2" style="width:200px; height:30px ; " tabindex="30" dir="rtl" lang="fa" value="<?php echo $m_sab ; ?>" maxlength="35" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:65px" align="right">: محل ثبت</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF"><div align="right">
       <input name="last_name2" type="text" class="required" style="width:200px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="name2" type="text" class="required" style="width:200px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $name ; ?>" maxlength="50" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:65px" align="right">: نام مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF"><div align="right"><span class="style2"><img src="files/sms.png" width="25" height="25" /></span>
       <input name="tel_m2" type="text" class="required digits" id="tel_m2" style="width:150px; height:30px ; " tabindex="36" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: شماره همراه</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="m_cod2" type="text" class="required digits" id="m_cod2" style="width:200px; height:30px ; background:#0CF " dir="ltr" lang="fa" value="<?php echo $m_cod ; ?>" maxlength="10" xml:lang="fa"  readonly="readonly"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:65px" align="right" >: کد ملی مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="tel_s2" type="text" class="required digits" id="tel_s2" style="width:150px; height:30px ; " tabindex="35" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:65px" align="right" >: شماره تلفن ثابت</div></td>
   </tr>
   <tr>
     <td height="45" colspan="4" bgcolor="#FFFFFF"><div align="right"></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:65px" align="right" >: آدرس شرکت</div></td>
     <?php
   }
   ?>
     <td width="3"></p></td>
   </tr>
   <tr>
     <td colspan="5" align="center">&nbsp;</td>
   </tr>
 </table>
 <table width="95%" height="355" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
   <tr>
     <td height="38" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>زمینه فعالیت کشاورزی</strong></div></td>
   </tr>
   <tr>
     <td width="228" height="32"><div align="right">
       <p>
         <label> بلی
           <input name="fa_8" type="radio" class="green" id="fa_1_14" value="1" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input name="fa_8" type="radio" class="red" id="fa_1_15" value="2" />
         </label>
         <br />
       </p>
     </div></td>
     <td width="156"><div align="right">:طیور سنتی</div></td>
     <td width="88">&nbsp;</td>
     <td width="179"><div align="right">
       <p>
         <label> بلی
           <input type="radio" name="fa_1"   class="green"   value="1" id="fa_1_0" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_1"   class="red"   value="2" id="fa_1_1" />
         </label>
         <br />
       </p>
     </div></td>
     <td width="241"><div style="margin-right:65px" align="right">:دارای اراضی زراعی </div></td>
   </tr>
   <tr>
     <td height="32" bgcolor="#FFFFCC"><div align="right">
       <p>
         <label> بلی
           <input type="radio" name="fa_9"   class="green"   value="1" id="fa_1_16" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_9"   class="red"   value="2" id="fa_1_17" />
         </label>
         <br />
       </p>
     </div></td>
     <td bgcolor="#FFFFCC"><div align="right">:طیور صنعتی</div></td>
     <td bgcolor="#FFFFCC">&nbsp;</td>
     <td bgcolor="#FFFFCC"><div align="right">
       <div align="right">
         <p>
           <label> بلی
             <input type="radio" name="fa_2"   class="green"   value="1" id="fa_1_2" />
           </label>
           <br />
           <label> خیر</label>
           <label>
             <input type="radio" name="fa_2"   class="red"   value="2" id="fa_1_3" />
           </label>
           <br />
         </p>
       </div>
     </div></td>
     <td bgcolor="#FFFFCC"><div style="margin-right:65px" align="right">:باغ و قلمستان</div></td>
   </tr>
   <tr>
     <td height="32"><div align="right">
       <p>
         <label> بلی
           <input type="radio" name="fa_10"   class="green"   value="1" id="fa_1_18" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_10"   class="red"   value="2" id="fa_1_19" />
         </label>
         <br />
       </p>
     </div></td>
     <td><div align="right">:زنبور عسل</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
       <p>
         <label> بلی
           <input type="radio" name="fa_3"   class="green"   value="1" id="fa_1_4" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_3"   class="red"   value="2" id="fa_1_5" />
         </label>
         <br />
       </p>
     </div></td>
     <td><div style="margin-right:65px" align="right">:کشت گلخانه ای</div></td>
   </tr>
   <tr>
     <td height="32" bgcolor="#FFFFCC"><div align="right">
       <p>
         <label> بلی
           <input type="radio" name="fa_11"   class="green"   value="1" id="fa_1_20" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_11"   class="red"   value="2" id="fa_1_21" />
         </label>
         <br />
       </p>
     </div></td>
     <td bgcolor="#FFFFCC"><div align="right">:کرم ابریشم</div></td>
     <td bgcolor="#FFFFCC">&nbsp;</td>
     <td bgcolor="#FFFFCC"><div align="right">
       <p>
         <label> بلی
           <input type="radio" name="fa_4"   class="green"   value="1" id="fa_1_6" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_4"   class="red"   value="2" id="fa_1_7" />
         </label>
         <br />
       </p>
     </div></td>
     <td bgcolor="#FFFFCC"><div style="margin-right:65px" align="right">:دام سنگین سنتی</div></td>
   </tr>
   <tr>
     <td height="59"><div align="right">
       <p>
         <label> بلی
           <input type="radio" name="fa_12"   class="green"   value="1" id="fa_1_22" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_12"   class="red"   value="2" id="fa_1_23" />
         </label>
         <br />
       </p>
     </div></td>
     <td><div align="right">:پرورش ماهی</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
       <p>
         <label> بلی
           <input type="radio" name="fa_5"   class="green"   value="1" id="fa_1_8" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_5"   class="red"   value="2" id="fa_1_9" />
         </label>
         <br />
       </p>
     </div></td>
     <td><div style="margin-right:65px" align="right">:دام سنگین صنعتی</div></td>
   </tr>
   <tr>
     <td height="32" bgcolor="#FFFFCC"><div align="right">
       <p>
         <label> بلی
           <input type="radio" name="fa_13"   class="green"   value="1" id="fa_1_12" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_13"   class="red"   value="2" id="fa_1_13" />
         </label>
         <br />
       </p>
     </div></td>
     <td bgcolor="#FFFFCC"><div align="right">:صنایع کشاورزی</div></td>
     <td bgcolor="#FFFFCC">&nbsp;</td>
     <td bgcolor="#FFFFCC"><div align="right">
       <p>
         <label> بلی
           <input type="radio" name="fa_6"   class="green"   value="1" id="fa_1_10" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_6"   class="red"   value="2" id="fa_1_11" />
         </label>
         <br />
       </p>
     </div></td>
     <td bgcolor="#FFFFCC"><div style="margin-right:65px" align="right">:دام سبک سنتی</div></td>
   </tr>
   <tr>
     <td height="32">&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td><div align="right">
       <p>
         <label> بلی
           <input type="radio" name="fa_7"   class="green"   value="1" id="fa_1_24" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_7"   class="red"   value="2" id="fa_1_25" />
         </label>
         <br />
       </p>
     </div></td>
     <td><div style="margin-right:65px" align="right">:دام سبک صنعتی</div></td>
   </tr>
 </table>
 <p>&nbsp;</p>
 <div align="center">
   <p>
     <input type="hidden" name="no_mt" value=<?php echo $no_mt; ?> />
     <input type="hidden" name="cod_p" value=<?php echo randomChar() ;  ?> />
     <input type="submit" name="action" value="ثبت و ادامه" style="width:150px ; height:45px" tabindex="38" />
   </p>
</div>
 <p align="center" >&nbsp;</p>
      </form> 

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
    <td  height="109"colspan="3" valign="middle" background="files/bottom.gif"><p class="MenuItemRight">Copyright © 2014, سازمان نظام مهندسی کشاورزی و منابع طبیعی استان آذربایجان شرقی All Rights Reserved.</p>
      <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</table>
 <?php  
 } 
 include('login/config.php');
 if (isset($_POST['action'])) 
 {  
 function alert($string)
{
    echo '<script type="text/javascript">alert("' . $string . '");</script>';
}
//alert('ثبت فشرده شد'); 
 $cod_p = $_POST['cod_p']; 
 $no_mt = $_POST['no_mt']; 
 $date_s = $_POST['date_s']; 
 $no_fa = $_POST['no_fa']; 
 $z_to = $_POST['z_to']; 
 $no_dar = $_POST['no_dar']; 
 $m_hadaf = $_POST['m_hadaf']; 
 $z_kol = $_POST['z_kol']; 
 $z_mo = $_POST['z_mo']; 
 $unit = $_POST['unit']; 
 $no_sh = $_POST['no_sh']; 
 $city = $_POST['city']; 
 $bakh = $_POST['bakh']; 
 $rosta = $_POST['rosta']; 
 $p_fa = $_POST['p_fa']; 
 $p_as = $_POST['p_as']; 
 $arz_j = $_POST['arz_j']; 
 $tol_j = $_POST['tol_j']; 
 $adres_tarh = $_POST['adres_tarh']; 
 $mas_kol = $_POST['mas_kol']; 
 $mas_mos = $_POST['mas_mos']; 
 $name = $_POST['name']; 
 $last_name = $_POST['last_name']; 
 $m_cod = $_POST['m_cod']; 
 $sh_sh = $_POST['sh_sh']; 
 $date_t = date_con($_POST['date_t']); 
 $m_sab = $_POST['m_sab']; 
 $fname = $_POST['fname']; 
 $m_tah = $_POST['m_tah']; 
 $tel_s = $_POST['tel_s']; 
 $tel_m = $_POST['tel_m']; 
 $addres = $_POST['addres']; 
 $co_name = $_POST['co_name']; 
 $sh_meli = $_POST['sh_meli']; 
 $f_no = $_POST['f_no']; 
 $f_sh = $_POST['f_sh']; 
 $f_date = date_con($_POST['f_date']); 
 $f_no_bah = $_POST['List1']; 
 $f_no_fa = $_POST['List2']; 
 $f_mas_kol = $_POST['f_mas_kol']; 
 $f_mas_mos = $_POST['f_mas_mos']; 
 $f_z_kol = $_POST['f_z_kol']; 
 $f_z_mo = $_POST['f_z_mo']; 
 $f_unit = $_POST['f_unit']; 
 $f_name = $_POST['f_name']; 
 $f_last_name = $_POST['f_last_name']; 
 $f_co_name = $_POST['f_co_name']; 
 $f_co_sabt = $_POST['f_co_sabt']; 
 $status = '1'; 
 $no_bah = 'دامداری صنعتی' ;
// تعریف متغیرهای که هنگام لود فرم خالی رد میشن
if ($no_mt==1) { $co_name = '' ;  $sh_meli='' ; }
if ($no_mt==2) { $fname = '' ; $m_tah='' ; }
if ($f_no =='بدون مجوز')  { $f_sh = '' ; $f_date ='';  $f_no_bah = ''; $f_no_fa = ''; $f_mas_kol =''; $f_mas_mos = ''; $f_z_kol = ''; $f_z_mo = ''; $f_unit = ''; $f_name = ''; $f_last_name = ''; $f_co_name = ''; $f_co_sabt = '';  } 
if (($f_no <>'بدون مجوز') and ($no_dar =='صدور')) {  $f_no_bah = ''; $f_no_fa = ''; $f_mas_kol =''; $f_mas_mos = ''; $f_z_kol = ''; $f_z_mo = ''; $f_unit = ''; $f_name = ''; $f_last_name = ''; $f_co_name = ''; $f_co_sabt = '';  } 
if (($f_no <>'بدون مجوز') and ($no_dar =='ابطال')) {  $f_no_bah = ''; $f_no_fa = ''; $f_mas_kol =''; $f_mas_mos = ''; $f_z_kol = ''; $f_z_mo = ''; $f_unit = ''; $f_name = ''; $f_last_name = ''; $f_co_name = ''; $f_co_sabt = '';  } 
if ($no_dar =='تمدید') { $f_no_bah = ''; $f_no_fa = ''; $f_mas_kol =''; $f_mas_mos = ''; $f_z_kol = ''; $f_z_mo = ''; $f_unit = ''; $f_name = ''; $f_last_name = ''; $f_co_name = ''; $f_co_sabt = '';  } 
if ($no_dar =='تغییر کاربری') { $f_name = ''; $f_last_name = ''; $f_co_name = ''; $f_co_sabt = '';  } 
if ($no_dar =='تغییر نام') { $f_no_bah = ''; $f_no_fa = ''; $f_mas_kol =''; $f_mas_mos = ''; $f_z_kol = ''; $f_z_mo = ''; $f_unit = '' ; }
if (($no_dar =='کاهش ظرفیت') or($no_dar =='افزایش ظرفیت') or($no_dar =='توسعه') or($no_dar =='نوسازی و بهسازی'))  {  $f_no_bah = ''; $f_no_fa = ''; $f_name = ''; $f_last_name = ''; $f_co_name = ''; $f_co_sabt = '';  }
{ 
$query = "INSERT INTO dar_ani (cod_p,no_mt,date_s,no_fa,z_to,no_dar,m_hadaf,z_kol,z_mo,unit,no_sh,city,bakh
,rosta,p_fa,p_as,arz_j,tol_j,adres_tarh,mas_kol,mas_mos,name,last_name,m_cod,sh_sh,date_t,m_sab,fname,m_tah,tel_s,tel_m,addres,co_name,sh_meli,f_no,f_sh,f_date,f_no_bah,f_no_fa,f_mas_kol,f_mas_mos,f_z_kol,f_z_mo,f_unit,f_name,f_last_name,f_co_name,f_co_sabt,status,no_bah) VALUES (:cod_p,:no_mt,:date_s,:no_fa,:z_to,:no_dar,:m_hadaf,:z_kol,:z_mo,:unit,:no_sh,:city,:bakh,:rosta,:p_fa,:p_as,:arz_j,:tol_j,:adres_tarh,:mas_kol,:mas_mos,:name,:last_name,:m_cod,:sh_sh,:date_t,:m_sab,:fname,:m_tah,:tel_s,:tel_m,:addres,:co_name,:sh_meli,:f_no,:f_sh,:f_date,:f_no_bah,:f_no_fa,:f_mas_kol,:f_mas_mos,:f_z_kol,:f_z_mo,:f_unit,:f_name,:f_last_name,:f_co_name,:f_co_sabt,:status,:no_bah)";
$q = $dbh->prepare($query);
$q->execute(array(':cod_p'=>$cod_p,':no_mt'=>$no_mt,':date_s'=>$date_s,':no_fa'=>$no_fa,':z_to'=>$z_to,':no_dar'=>$no_dar,':m_hadaf'=>$m_hadaf,':z_kol'=>$z_kol,':z_mo'=>$z_mo,':unit'=>$unit,':no_sh'=>$no_sh,':city'=>$city,':bakh'=>$bakh,':rosta'=>$rosta,':p_fa'=>$p_fa,':p_as'=>$p_as,':arz_j'=>$arz_j,':tol_j'=>$tol_j,':adres_tarh'=>$adres_tarh,':mas_kol'=>$mas_kol,':mas_mos'=>$mas_mos,':name'=>$name,':last_name'=>$last_name,':m_cod'=>$m_cod,':sh_sh'=>$sh_sh,':date_t'=>$date_t,':m_sab'=>$m_sab,':fname'=>$fname,':m_tah'=>$m_tah,':tel_s'=>$tel_s,':tel_m'=>$tel_m,':addres'=>$addres,':co_name'=>$co_name,':sh_meli'=>$sh_meli,':f_no'=>$f_no,':f_sh'=>$f_sh,':f_date'=>$f_date,':f_no_bah'=>$f_no_bah,':f_no_fa'=>$f_no_fa,':f_mas_kol'=>$f_mas_kol,':f_mas_mos'=>$f_mas_mos,':f_z_kol'=>$f_z_kol,':f_z_mo'=>$f_z_mo,':f_unit'=>$f_unit,':f_name'=>$f_name,':f_last_name'=>$f_last_name,':f_co_name'=>$f_co_name,':f_co_sabt'=>$f_co_sabt,':status'=>$status,':no_bah'=>$no_bah));
// ارسال اس ام اس 
$text= " با سلام اطلاعات شمادر سامانه ثبت مجوز فعالیت های کشاورزی سازمان نظام مهندسی استان ثبت شد کد رهگیری ".$cod_p." اطلاعات بیشتر در سایت سامانه  به آدرس www.aeo-azsh.ir" ; 
sms($tel_m,$text) ;
 // ثبت در بانک پیگیری
include('event.php');
sabt_event($no_bah,$cod_p,'ثبت درخواست در سامانه / در انتظار ارسال ',$date_s,$euser) ; 
 // once saved, redirect back to the view page 
 //header("Location: user_view.php");
 if ($no_sh >'0') 
 {
?>
<form name="myform" class="myform" method="post" action="mo_sh.php">
<input type="hidden" name="no_sh" value="<?php echo $no_sh ;?>">
<input type="hidden" name="cod_p" value="<?php echo $cod_p ;?>">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 }
 else
 {
//<form name="myform" class="myform" method="post" action="upload\up_document.php?trak=<?php echo md5($cod_p) ;>">
 ?>
<form name="myform" class="myform" method="post" action="view_Fani.php">
<input type="hidden" name="cod_p" value="<?php echo $cod_p ;?>">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 }
 }
 } 
 else 
 // if the form hasn't been submitted, display the form 
 { 
 renderForm( $error,$no_dar,$no_mt,$date_s,$city,$bakh,$rosta,$no_fa,$z_to,$m_hadaf,$z_kol,$z_mo,$unit,$no_sh,$p_fa,$p_as,$arz_j,$tol_j,$adres_tarh,$mas_kol,$mas_mos,$name,$last_name ,$sh_sh,$date_t,$m_cod,$tel_s ,$tel_m,$m_sod,$fname,$m_tah,$addres,$co_name,$sh_meli,$f_no,$f_sh,$f_date,$List1,$List2,$f_mas_kol,$f_mas_mos,$f_z_kol,$f_z_mo,$f_unit,$f_name,$f_last_name,$f_co_name,$f_co_sabt);
 }
}
else 
{
?>
<script>
window.location.href='prolis.php';
</script>
<?php
}
?>
					</p></td>
                  </tr>
</table></body>
</body>
</html>