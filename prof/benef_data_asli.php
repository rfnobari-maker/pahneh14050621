<?php
include("../lock_p1.php");
include('../event.php');
include('../date_con.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
if(isset($_POST["no_co"]))
{ 
 $no_co = $_POST["no_co"]; 
 $bah_cod_m = $_POST["bah_cod_m"]; 
 $date_t = $date_kh ; 
}
if  (isset($_POST['bah_cod_m']))
{
function renderForm($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$ostan_s,$shahr_s,$city_s,$rosta_s,$co_name,$no_co,$sh_meli,$co_sabt,$fa_1,$fa_2,$fa_3,$fa_4,$fa_5,$fa_6,$fa_7,$fa_8,$fa_9,$fa_10,$fa_11,$fa_12,$fa_13,$fa_14,$no_nation,$nation)
{ 
date_default_timezone_set('Asia/Tehran') ;
 $date_s = date_con(jdate("Y/m/d"));
 $bah_cod_m = $_POST['bah_cod_m'];
# alert($_POST['bah_cod_m']) ;
# alert($_POST['date_t']) ;
 $num_bah = $_POST['num_bah'];
 $add_abadi = $_POST["add_abadi"]; 
 $add_city = $_POST["add_city"]; 
 $no_bah = $_POST["no_bah"]; 
 $s_bah = $_POST["s_bah"]; 
 $no_nation = $_POST['no_nation'] ;
if ($no_nation == '1')
{
$webservice_url = "http://172.17.18.40:/GetPersonInfo/GetingPersonByNationalIdAndBirthDate.asmx?wsdl";
$username = "poudadmin";
$password = "6ae390lm";
if (isset($_POST['date_t'])) {
	$client = new SoapClient($webservice_url);
	$res = $client->GetPersonInfo(array("userName" => $username , "passWord" =>$password , "NationalId" =>$_POST['bah_cod_m'], "BirthDate" =>$_POST['date_t']));
	//echo '<pre dir="ltr">';print_r($res);echo '</pre>';
	if ($res->GetPersonInfoResult->status==Okay) { ;
	$name = $res->GetPersonInfoResult->firstName;
	$last_name = $res->GetPersonInfoResult->lastName;
	$fname = $res->GetPersonInfoResult->fatherName;
	$sh_sh = $res->GetPersonInfoResult->identityCertificateID;
	if ($res->GetPersonInfoResult->gender==0) $jens = '2' ;
	if ($res->GetPersonInfoResult->gender==1) $jens = '1' ;
	if ($res->GetPersonInfoResult->lifeStatus==1){ $live = 'کد ملی :'.$bah_cod_m. ' فوت شده در تاریخ :' .$res->GetPersonInfoResult->deathDate  ;  $bah_cod_m='' ; }
	$date_t = $res->GetPersonInfoResult->birthDate;
    $yy = (substr($date_t,0,4));
    $mm = (substr($date_t,4,2)) ;
    $dd = (substr($date_t,6,2)) ;
    $date_t = $yy.'/'.$mm.'/'.$dd ;
    $nation = 'ایرانی' ;
	}
	else 
	{
		$notfound =  'تاریخ تولد صحیح نیست ' ; $name = '' ; 
	}
	echo '</div>';
}
}
if ($no_nation == '2')
{
$webservice_url = "http://172.17.18.40/GetForeignPersonInfo/getForeignPersonInfo.asmx?WSDL";
$Username = "test";
$Password = "test";
//$username = "poudadmin";
//$password = "6ae390lm";
	$client = new SoapClient($webservice_url);
	$res = $client->GetPersonInfo(array(
	 "userName"   => $Username ,
	 "passWord"   => $Password , 
	 "Code" => $_POST['bah_cod_m']));
	//echo '<pre dir="ltr">';print_r($res);echo '</pre>';
	if (isset($_POST['bah_cod_m'])) {
	//if ($res->GetForeignPersoninfoByCodeResult->Successful == true) { ;
	if ($res->GetPersonInfoResult->ErrorCode == 0 and $res->GetPersonInfoResult->person->PersianFirstName != '' ) { ;

	$name      = $res->GetPersonInfoResult->person->PersianFirstName ; 
	$last_name =$res->GetPersonInfoResult->person->PersianLastName  ; 
	if ($res->GetPersonInfoResult->person->Gender=='مرد') $jens = '1' ;
	if ($res->GetPersonInfoResult->person->Gender=='زن') $jens = '2' ;
	$fname = $res->GetPersonInfoResult->person->PersianFatherName    ; 
	$originalDate = $res->GetPersonInfoResult->person->BirthDate	    ; 
    $date_t =  date("Y/m/d", strtotime($originalDate));
	$m_sod  = $res->GetPersonInfoResult->person->BirthPlaceCountry->Title      ; 
	$nation = $res->GetPersonInfoResult->person->Nationality->Title      ; 
	$sh_sh  = $res->GetPersonInfoResult->person->IdentificationDocument->Number        ; 
    }
	else 
	{
		$notfound =  'کد اختصاصی یافت نشد ' ; 
	}
	echo '</div>';
}
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<link href="radio.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
        .error-message {
            color: red;
            font-size: 10px;
            display: none; /* به طور پیش‌فرض پیام‌ها نمایش داده نمی‌شوند */
        }
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
	    <form action="" method="post" id="form1" name="form1">
 <p align="center" >&nbsp;</p>
 <p align="center" ><span class="style1">ثبت اطلاعات بهره بردار </span> </p>
 <table style="border:3px solid #069;" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
 <?php  if ($no_bah=='1') { ?>
  <td height="38" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی  <span class="style8"><?php echo $notfound,$live?></span></strong></div></td>
  </tr>
   <tr>
     <td height="46"><div align="right">
       <select name="jens1" disabled="disabled" class="required" id="jens" style="height:40px ; width:150px ; direction:rtl ; background:#0CF" tabindex="1">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($jens=='1') echo "selected='selected'" ?> >مرد</option>
         <option value="2" <?php if ($jens=='2') echo "selected='selected'" ?>>زن</option>
       </select>
     </div></td>
     <td><div align="right">:جنسیت</div></td>
     <td width="175" rowspan="7"  class="style8">&nbsp;</td>
     <td><div align="right">
       <input name="bah_cod_m" type="text" class="required digits" id="bah_cod_m" style="width:150px; height:30px ; background:#0CF " dir="ltr" lang="fa" value="<?php echo $bah_cod_m ; ?>"  xml:lang="fa" readonly="readonly" />
     </div></td>
     <td><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td width="295" height="47"><div align="right">
       <input name="last_name" type="text" class="required" id="last_name" style="width:150px; height:30px ; background:#0CF " tabindex="3" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td width="266"><div align="right">:نام خانوادگی</div></td>
     <td width="259"><div align="right">
       <input name="name" type="text" class="required" id="name" style="width:150px; height:30px ; background:#0CF " tabindex="2" dir="rtl" lang="fa" value="<?php echo $name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td width="188"><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="55"><div align="right">
       <input name="sh_sh" type="text" class="required" id="sh_sh" style="width:150px; height:30px ; background:#0CF " tabindex="5" dir="rtl" lang="fa" value="<?php echo $sh_sh ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">
	 <?php if($no_nation == '1') echo ':شماره شناسنامه' ; else echo ':کد شناسائی' ; ?>
     </div></td>
     <td height="55" dir="rtl"><div align="right">
       <input name="date_t" type="text" class="required" style="width:150px; height:30px ; background:#0CF" tabindex="4" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:30px" align="right" >:تاریخ تولد</div></td>
   </tr>
   <tr>
     <td height="55"><div align="right">
       <input name="fname" type="text" class="required" id="fname" style="width:150px; height:30px ; background:#0CF " tabindex="7" dir="rtl" lang="fa" value="<?php echo $fname ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td><div align="right">:نام پدر</div></td>
     <td height="55" dir="rtl"><div align="right">
       <input name="m_sod" type="text" class="required"  id="m_sod" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $m_sod ; ?>" maxlength="35" xml:lang="fa" 
	   <?php if($no_nation=='2') echo 'readonly="readonly"'?> />
     </div></td>
     <td><div style="margin-right:30px" align="right" >
	 <?php if($no_nation == '1') echo ': :محل صدور' ; else echo ':کشور محل تولد' ; ?>
         </div></td>
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
     <td height="46"><div align="right">
       <input name="tel_m" type="text" class="required digits" id="tel_m" 
               tabindex="11" dir="rtl" lang="fa" value="<?php echo htmlspecialchars($tel_m); ?>" 
               maxlength="11" minlength="11" 
               required/>
        </br><span id="error_tel_m" class="error-message"></span>
     </div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td><div align="right">
       <input name="tel_s" type="text" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
     </tr>
   <tr>
     <td height="46"><div align="right">
       <input name="nation" type="text" class="required" id="name2" style="width:150px; height:30px ; background:#0CF " tabindex="2" dir="rtl" lang="fa" value="<?php echo $nation ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td><div align="right">:ملیت</div></td>
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
     <td height="38" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی  </strong><strong><span class="style8"><?php echo $notfound,$live?></span></strong></div></td>
   </tr>
   <tr>
     <td height="46"><div align="right"  >
       <input name="co_name" type="text" class="required" id="co_name" style="width:150px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $co_name ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
     </div></td>
     <td><div align="right">:عنوان شرکت/ موسسه</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <select name="no_co" class="required" id="no_co" style="height:40px ; width:180px ; direction:rtl" tabindex="3" onchange="this.form.submit()">
         <option value="">انتخاب کنید</option>
         <option value="1"  <?php if ($no_co =='1') echo 'selected=selected'?>> شرکت سهامی</option>
         <option value="2"  <?php if ($no_co =='2') echo 'selected=selected'?>>شرکت با مسئولیت محدود</option>
         <option value="3"  <?php if ($no_co =='3') echo 'selected=selected'?>>شرکت تضامنی</option>
         <option value="4"  <?php if ($no_co =='4') echo 'selected=selected'?>>شرکت مختلط غیر سهامی</option>
         <option value="5"  <?php if ($no_co =='5') echo 'selected=selected'?>>شرکت مختلط سهامی</option>
         <option value="6"  <?php if ($no_co =='6') echo 'selected=selected'?>> شرکت نسبی</option>
         <option value="7"  <?php if ($no_co =='7') echo 'selected=selected'?>>شرکت تعاونی</option>
         <option value="8"  <?php if ($no_co =='8') echo 'selected=selected'?>>موسسه عمومی</option>
       </select>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نوع شرکت/ موسسه</div></td>
   </tr>
   <tr>
     <td height="45" bgcolor="#FFFFFF"><div align="right"  >
       <input name="co_sabt" type="text" class="required" id="co_sabt" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $co_sabt ; ?>" maxlength="20"  align="baseline" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: شماره ثبت</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="sh_meli" type="text" class="required digits" id="sh_meli" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $sh_meli ; ?>" maxlength="11" xml:lang="fa"/>
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
       <input name="last_name" type="text" class="required" id="last_name" style="width:150px; height:30px ; background:#0CF " tabindex="3" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="name" type="text" class="required" id="name" style="width:150px; height:30px ; background:#0CF " tabindex="2" dir="rtl" lang="fa" value="<?php echo $name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF">       <input name="tel_m" type="text" class="required digits" id="tel_m" 
               tabindex="11" dir="rtl" lang="fa" value="<?php echo htmlspecialchars($tel_m); ?>" 
               maxlength="11" minlength="11" 
               required/>
        </br><span id="error_tel_m" class="error-message"></span>
</td>
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
   
     <td width="8"></p></td>
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
     <td height="53" bgcolor="#FFFFCC"><div align="right">
       <p>
         <label> بلی
           <input name="fa_14" type="radio"   class="required green" id="fa_1_8" tabindex="27"   value="1" />
         </label>
         <br />
         <label> خیر</label>
         <label>
           <input type="radio" name="fa_14"   class="required red"   checked="checked"  value="2" id="fa_1_9" />
         </label>
         <br />
       </p>
     </div></td>
     <td bgcolor="#FFFFCC"><div style="margin-right:30px" align="right">:پرورش قارچ خوراکی</div></td>
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
     <input type="hidden" name="jens" value=<?php echo $jens; ?> />
     <input type="hidden" name="no_bah" value=<?php echo $no_bah; ?> />
     <input type="hidden" name="no_nation" value=<?php echo $no_nation; ?> />
     <input type="hidden" name="num_bah" value=<?php echo $num_bah; ?> />
     <input type="hidden" name="s_bah" value=<?php echo $s_bah; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="submit" name="action" value="ثبت و ادامه" id="submit" style="width:150px ; height:45px" tabindex="32" />
        </p>
      </div>
<p align="center" >&nbsp;</p>
</form> 
<script>
function disableFunction() {
    document.getElementById("submit").disabled = 'true';
	$("#submit").attr("disabled","");
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
                      <p><a href="benef.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
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
$date_s = $date_edit ; 
$mor_cod_m = $login_session ;
$no_bah = $_POST['no_bah']; 
$no_nation = $_POST['no_nation']; 
$nation = $_POST['nation']; 
$num_bah = $_POST['num_bah']; 
$bah_cod_m = $_POST['bah_cod_m']; 
$cod_p = $_POST['cod_p']; 
$jens= $_POST['jens']; 
$name = $_POST['name']; 
$last_name = $_POST['last_name']; 
$sh_sh   = $_POST['sh_sh']; 
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
$m_sod   = $_POST['m_sod']; 
$date_t  = $_POST['date_t']; 
// نوع شرکت موسسه عمومی 
if ($no_co == '8')
 {
$sh_meli  = '' ;
$co_sabt  = '' ;
$m_sod   = '' ; 
$date_t  = ''; 
 }
//
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
 $fa_14  = $_POST['fa_14'] ;
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
 $mor_cod_m = $login_session; 

 $query = "INSERT IGNORE INTO bah (date_s,mor_cod_m,no_bah,bah_cod_m,num_bah,cod_p,jens,name,last_name,date_t,sh_sh,m_sod,fname,m_tah,er_mtah,tel_s,tel_m,ostan_s,shahr_s,city_s,rosta_s,co_name,no_co,sh_meli,co_sabt,fa_1,fa_2,fa_3,fa_45,fa_67,fa_8,fa_9,fa_10,fa_11,fa_12,fa_13,fa_14,add_abadi,add_city,id_city,id_mar,s_bah,id_ostan,no_nation,nation,ok) 
 VALUES(:date_s,:mor_cod_m,:no_bah,:bah_cod_m,:num_bah,:cod_p,:jens,:name,:last_name, :date_t,:sh_sh,:m_sod,:fname,:m_tah,:er_mtah,:tel_s,:tel_m,:ostan_s,:shahr_s,:city_s,:rosta_s,:co_name,:no_co,:sh_meli,:co_sabt,:fa_1,:fa_2,:fa_3,:fa_45,:fa_67,:fa_8,:fa_9,:fa_10,:fa_11,:fa_12,:fa_13,:fa_14,:add_abadi,:add_city,:id_city,:id_mar,:s_bah,:id_ostan,:no_nation,:nation,:ok)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':no_bah'=>$no_bah,':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah,':cod_p'=>$cod_p,':jens'=>$jens,':name'=>$name,':last_name'=>$last_name,':date_t'=>$date_t,':sh_sh'=>$sh_sh,':m_sod'=>$m_sod,':fname'=>$fname,':m_tah'=>$m_tah,':er_mtah'=>$er_mtah,':tel_s'=>$tel_s,':tel_m'=>$tel_m,':ostan_s'=>$ostan_s,':shahr_s'=>$shahr_s,':city_s'=>$city_s,':rosta_s'=>$rosta_s,':co_name'=>$co_name,':no_co'=>$no_co,':sh_meli'=>$sh_meli,':co_sabt'=>$co_sabt,':fa_1'=>$fa_1,':fa_2'=>$fa_2,':fa_3'=>$fa_3,':fa_45'=>$fa_45,':fa_67'=>$fa_67,':fa_8'=>$fa_8,':fa_9'=>$fa_9,':fa_10'=>$fa_10,':fa_11'=>$fa_11,':fa_12'=>$fa_12,':fa_13'=>$fa_13,':fa_14'=>$fa_14,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':id_city'=>$id_city,':id_mar'=>$id_mar,':s_bah'=>$s_bah,':id_ostan'=>$id_ostan,':no_nation'=>$no_nation,':nation'=>$nation,':ok'=>'1'));
 // ثبت در بانک پیگیری
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'ثبت اطلاعات بهره بردار - '.$bah_cod_m,$id_ostan) ; 
$dbh = null ;
//**START  bah2
include('../login/config_utf8.php');
$query = "INSERT INTO bah20 (date_s,mor_cod_m,no_bah,bah_cod_m,num_bah,name,last_name,date_t,fname,
sh_meli,tel_m,co_name,id_ostan,id_city,id_mar,sh_sh,m_tah,er_mtah,tel_s,s_bah,jens,co_sabt,cod_p,ok
,no_nation)
VALUES(:date_s,:mor_cod_m,:no_bah,:bah_cod_m,:num_bah,:name,:last_name,:date_t,:fname,
:sh_meli,:tel_m,:co_name,:id_ostan,:id_city,:id_mar,:sh_sh,:m_tah,:er_mtah,:tel_s,:s_bah,:jens,:co_sabt,:cod_p,:ok
,:no_nation)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':no_bah'=>$no_bah,':bah_cod_m'=>$bah_cod_m,
':num_bah'=>$num_bah,':name'=>$name,':last_name'=>$last_name,':date_t'=>$date_t,':fname'=>$fname,
':sh_meli'=>$sh_meli,':tel_m'=>$tel_m,':co_name'=>$co_name,':id_ostan'=>$id_ostan
,':id_city'=>$id_city,':id_mar'=>$id_mar,':sh_sh'=>$sh_sh,':m_tah'=>$m_tah,':er_mtah'=>$er_mtah,
':tel_s'=>$tel_s,':s_bah'=>$s_bah,':jens'=>$jens,':co_sabt'=>$co_sabt
,':cod_p'=>$cod_p,':ok'=>'1',':no_nation'=>$no_nation));
$dbh = null ;
//** END bah2
unset($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$ostan_s,$shahr_s,$city_s,$rosta_s,$co_name,$no_co,$sh_meli,$co_sabt,$fa_1,$fa_2,$fa_3,$fa_45,$fa_67,$fa_8,$fa_9,$fa_10,$fa_11,$fa_12,$fa_13,$fa_14,$add_abadi,$add_city,$no_nation,$nation);
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
renderForm($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$ostan_s,$shahr_s,$city_s,$rosta_s,$co_name,$no_co,$sh_meli,$co_sabt,$fa_1,$fa_2,$fa_3,$fa_45,$fa_67,$fa_8,$fa_9,$fa_10,$fa_11,$fa_12,$fa_13,$fa_14,$add_abadi,$add_city);
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
<script>
        document.getElementById('tel_m').addEventListener('input', function (e) {
            var value = e.target.value;
            var errorSpan = document.getElementById('error_tel_m');
            if (!/^09\d{0,9}$/.test(value)) {
                errorSpan.textContent = 'شماره همراه باید با 09 شروع شود ';
                errorSpan.style.display = 'inline'; // نمایش پیام خطا
		   } else {
                errorSpan.textContent = ''; // حذف پیام خطا
                errorSpan.style.display = 'none'; // پنهان کردن پیام خطا
            }
        });

    </script>