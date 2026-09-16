<?php
include("../lock_expsh.php");
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
function renderForm($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens2,$name,$last_name,$date_t,$sh_sh,$m_sod,
$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$co_name,$no_co,$sh_meli,$co_sabt,$addres,$email)
{ 
 $bah_cod_m = $_POST['bah_cod_m'];
# alert($_POST['bah_cod_m']) ;
# alert($_POST['date_t']) ;
 $num_bah = $_POST['num_bah'];
 $add_abadi = $_POST["add_abadi"]; 
 $add_city = $_POST["add_city"]; 
 $no_bah = $_POST["no_bah"]; 
 //$date_kh = $_POST["date_t"]; 
 //$date_t = substr($date_kh,0,4).'/'.substr($date_kh,4,2).'/'.substr($date_kh,6,2);
// Enter these 3 parameters:

$webservice_url = "http://172.17.18.40:/GetPersonInfo/GetingPersonByNationalIdAndBirthDate.asmx?wsdl";
$username = "poudadmin";
$password = "6ae390lm";


//$webservice_url = "http://172.17.18.14:1080/GetPersonInfo/GetingPersonByNationalIdAndBirthDate.asmx?wsdl";
//$username = "agriPahneh";
//$password = "2@ej5D6*7";
if (isset($_POST['date_t'])) {
	$client = new SoapClient($webservice_url);
	$res = $client->GetPersonInfo(array("userName" => $username , "passWord" =>$password , "NationalId" =>$_POST['bah_cod_m'], "BirthDate" =>$_POST['date_t']));
	//echo '<pre dir="ltr">';print_r($res);echo '</pre>';
	if ($res->GetPersonInfoResult->status==Okay) { ;
	$name1 = $res->GetPersonInfoResult->firstName;
	$last_name = $res->GetPersonInfoResult->lastName;
	$fname = $res->GetPersonInfoResult->fatherName;
	$sh_sh = $res->GetPersonInfoResult->identityCertificateID;
	if ($res->GetPersonInfoResult->gender==0) $jens2 = '2' ;
	if ($res->GetPersonInfoResult->gender==1) $jens2 = '1' ;
	if ($res->GetPersonInfoResult->lifeStatus==1){ $live = 'کد ملی :'.$bah_cod_m. ' فوت شده در تاریخ :' .$res->GetPersonInfoResult->deathDate  ;  $bah_cod_m='' ; }
	$date_t = $res->GetPersonInfoResult->birthDate;
    $yy = (substr($date_t,0,4));
    $mm = (substr($date_t,4,2)) ;
    $dd = (substr($date_t,6,2)) ;
    $date_t = $yy.'/'.$mm.'/'.$dd ;
	}
	else 
	{
		$notfound =  'تاریخ تولد صحیح نیست ' ; $name = '' ; 
	}
	echo '</div>';
}


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
	<script src="../15_files/jquery.js" type="text/javascript"></script>
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
   <?php include('top.php'); ?>
 <p align="center" ><span class="style8">ثبت اطلاعات بهره بردار مشاغل وابسته به بخش کشاورزی </span> <br />
   <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/> </p>
 <table style="border:3px solid #069;" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <?php  if ($no_bah=='1') { ?>
     <td height="38" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی <span class="style8"><?php echo $notfound,$live?></span></strong></div></td>
   </tr>
   <tr>
     <td height="46"><div align="right"> 
            <select name="jens" disabled="disabled" class="required" id="jens2" style="height:40px ; width:150px ; direction:rtl ; background:#0CF">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php  if ($jens2=='1') echo "selected='selected'" ?> >مرد</option>
         <option value="2" <?php if ($jens2=='2') echo "selected='selected'" ?>>زن</option>
       </select>
     </div></td>
     <td><div align="right">:جنسیت</div></td>
     <td width="175" rowspan="7"  class="style8">&nbsp;</td>
     <td><div align="right">
       <input name="bah_cod_m" type="text" class="required digits" id="bah_cod_m" style="width:150px; height:30px ; background:#0CF " dir="ltr" lang="fa" value="<?php echo $bah_cod_m ; ?>" maxlength="10" xml:lang="fa" readonly="readonly" />
     </div></td>
     <td><div style="margin-right:20px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td width="295" height="47"><div align="right">
       <input name="last_name" type="text" class="required" id="last_name" style="width:150px; height:30px ; background:#0CF " dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td width="266"><div align="right">:نام خانوادگی</div></td>
     <td width="259"><div align="right">
       <input name="name" type="text" class="required" id="name" style="width:150px; height:30px ; background:#0CF " dir="rtl" lang="fa" value="<?php echo $name1 ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td width="188"><div style="margin-right:20px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="55"><div align="right">
       <input name="sh_sh" type="text" class="required digits" id="sh_sh" style="width:150px; height:30px ; background:#0CF " dir="rtl" lang="fa" value="<?php echo $sh_sh ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td height="55" dir="rtl"><div align="right">
       <input name="date_t" type="text" class="required" style="width:150px; height:30px ; background:#0CF" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:20px" align="right" >:تاریخ تولد</div></td>
   </tr>
   <tr>
     <td height="55"><div align="right">
       <input name="fname" type="text" class="required" id="fname" style="width:150px; height:30px ; background:#0CF " dir="rtl" lang="fa" value="<?php echo $fname ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td><div align="right">:نام پدر</div></td>
     <td height="55" dir="rtl"><div align="right">
       <input name="m_sod" type="text" class="required" id="m_sod" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $m_sod ; ?>" maxlength="35" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:20px" align="right" >:محل صدور</div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <select name="er_mtah" class="required" id="er_mtah" style="height:40px ; width:150px ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="1">بلی </option>
         <option value="2">خیر</option>
       </select>
     </div></td>
     <td><div align="right">:مدرک مرتبط با کشاورزی</div></td>
     <td><div align="right">
       <select name="m_tah" class="required" id="m_tah" style="height:40px ; width:150px ; direction:rtl" tabindex="2">
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
     <td><div style="margin-right:20px" align="right" >:مدرک تحصیلی</div></td>
   </tr>
   <tr>
     <td height="46"><div align="right"><span class="style2">ضروری<img src="../files/sms.png" width="28" height="32" /></span>
       <input name="tel_m" type="text" class="required digits" id="tel_m" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td><div align="right">
       <input name="tel_s" type="text" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:20px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
     <td height="50"><div align="right">
       <input name="email" type="text" class="required email" id="email" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="75" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:آدرس پست الکترونیک</div></td>
     <td><div align="right">
       <input name="cod_p2" type="text" class="required digits" id="cod_p" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="10" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:20px" align="right" >:کد پستی</div></td>
   </tr>
   <tr>
     <td height="50" colspan="4" bgcolor="#FFFFFF"><div align="right">
       <input name="addres" type="text" class="required" placeholder="آدرس" id="addres2" style="width:450px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $addres ; ?>" maxlength="450" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:20px" align="right" >نشانی  پستی </div></td>
   </tr>
   <tr>
     <td height="50" bgcolor="#FFFFCC"><div align="right"><span style="text-align: right">سایر
       <input name="fa3" type="checkbox"  class="green" id="fa3" tabindex="11" value="1" <?php if ($fa3 == '1') { ?>checked='checked' <?php } ?>  />
     </span></div></td>
     <td height="50" bgcolor="#FFFFCC"><div align="right"><span style="text-align: right">ماشین آلات کشاورزی
       <input name="fa2" type="checkbox"  class="green" id="fa2" tabindex="10" value="1" <?php if ($fa2 == '1') { ?>checked='checked' <?php } ?>  />
     </span></div></td>
     <td height="50" colspan="2" bgcolor="#FFFFCC"><div align="right"><span style="text-align: right">صنایع تبدیلی و تکمیلی کشاورزی
       <input name="fa1" type="checkbox"  class="green" id="fa1" tabindex="9" value="1" <?php if ($fa1 == '1') { ?>checked='checked' <?php } ?>  />
     </span></div></td>
     <td bgcolor="#FFFFCC"><div style="margin-right:20px" align="right" >زمینه فعالیت </div></td>
   </tr>
   <tr>
     <?php }  if ($no_bah=='2') { ?>
     <td height="38" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی </strong><strong><span class="style8"><?php echo $notfound,$live?></span></strong></div></td>
   </tr>
   <tr>
     <td height="46"><div align="right"  >
       <input name="co_name" type="text" class="required" id="co_name" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $co_name ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
     </div></td>
     <td><div align="right">:عنوان شرکت/ موسسه</div></td>
     <td rowspan="7" bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
       <select name="no_co" class="required" id="no_co" style="height:40px ; width:180px ; direction:rtl" tabindex="1" onchange="this.form.submit()">
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
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right">: نوع شرکت/ موسسه</div></td>
   </tr>
   <?php if($no_co <>'8') { ?>
   <tr>
     <td height="45" bgcolor="#FFFFFF"><div align="right"  >
       <input name="co_sabt" type="text" class="required" id="co_sabt" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $co_sabt ; ?>" maxlength="20"  align="baseline" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: شماره ثبت</div></td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="sh_meli" type="text" class="required digits" id="sh_meli" style="width:150px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $sh_meli ; ?>" maxlength="11" minlength='11' xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right">: شناسه ملی</div></td>
   </tr>
   <tr>
     <td height="48" dir="rtl"><div align="right">
       <input name="date_t" type="text" class="pdate required" id="pcal2" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: تاریخ ثبت</div></td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="m_sod" type="text" class="required" id="m_sod" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $m_sod ; ?>" maxlength="35" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right">: محل ثبت</div></td>
   </tr>
   <?php }?>
   <tr>
     <td height="44" bgcolor="#FFFFFF"><div align="right">
       <input name="last_name" type="text" class="required" id="last_name" style="width:150px; height:30px ; background:#0CF " dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="name" type="text" class="required" id="name" style="width:150px; height:30px ; background:#0CF " dir="rtl" lang="fa" value="<?php echo $name1 ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right">: نام مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="48" bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right">
     <input name="bah_cod_m" type="text" class="required digits" id="bah_cod_m" style="width:150px; height:30px ; background:#0CF " dir="ltr" lang="fa" value="<?php echo $bah_cod_m ; ?>" maxlength="10" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right" >:کدملی مدیر عامل</div></td>
   </tr>
   <tr>
     <td height="44" bgcolor="#FFFFFF"><div align="right"><span class="style2"><img src="../files/sms.png" width="28" height="32" /></span>
       <input name="tel_m" type="text" class="required digits" id="tel_m" style="width:150px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div align="right">: شماره همراه</div></td>
     <td bgcolor="#FFFFFF"><div align="right">
       <input name="tel_s" type="text" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right" >: تلفن ثابت دفتر مرکزی</div></td>
   </tr>
   <tr>
     <td height="50"><div align="right">
       <input name="email" type="text" class="required email" id="email" style="width:150px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="75" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:آدرس پست الکترونیک</div></td>
     <td><div align="right">
       <input name="cod_p" type="text" class="required digits" id="cod_p" style="width:150px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="10" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:20px" align="right" >:کد پستی</div></td>
   </tr>
   <tr>
     <td height="45" colspan="4" bgcolor="#FFFFFF"><div align="right">
       <input name="addres" type="text" class="required" placeholder="آدرس" id="addres" style="width:450px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $addres ; ?>" maxlength="450" xml:lang="fa"/>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:20px" align="right" >: آدرس شرکت</div></td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td height="50" bgcolor="#FFFFCC"><div align="right"><span style="text-align: right">سایر
       <input name="fa3" type="checkbox"  class="green" id="fa3" tabindex="14" value="1" <?php if ($fa3 == '1') { ?>checked='checked' <?php } ?>  />
     </span></div></td>
     <td height="50" bgcolor="#FFFFCC"><div align="right"><span style="text-align: right">ماشین آلات کشاورزی
       <input name="fa2" type="checkbox"  class="green" id="fa2" tabindex="13" value="1" <?php if ($fa2 == '1') { ?>checked='checked' <?php } ?>  />
     </span></div></td>
     <td height="50" colspan="2" bgcolor="#FFFFCC"><div align="right"><span style="text-align: right">صنایع تبدیلی و تکمیلی کشاورزی
       <input name="fa1" type="checkbox"  class="green" id="fa1" tabindex="12" value="1" <?php if ($fa1 == '1') { ?>checked='checked' <?php } ?>  />
     </span></div></td>
     <td bgcolor="#FFFFCC"><div style="margin-right:20px" align="right" >زمینه فعالیت </div></td>
     <td width="8"><p></p></td>
   </tr>
   <?php
    }
   ?>
   <tr>
     <td colspan="5" align="center">&nbsp;</td>
   </tr>
 </table>
 <p>&nbsp;</p>
 <div align="center">
   <p>
     <input type="hidden" name="jens" value=<?php echo $jens2; ?> />
     <input type="hidden" name="no_bah" value=<?php echo $no_bah; ?> />
     <input type="hidden" name="num_bah" value=<?php echo $num_bah; ?> />
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
                      <p><a href="Industry.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
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
$num_bah = $_POST['num_bah']; 
$bah_cod_m = $_POST['bah_cod_m']; 
$cod_p = $_POST['cod_p']; 
$jens2= $_POST['jens2']; 
$name = $_POST['name']; 
$last_name = $_POST['last_name']; 
$sh_sh   = $_POST['sh_sh']; 
$fname   = $_POST['fname']; 
$m_tah   = $_POST['m_tah']; 
$er_mtah = $_POST['er_mtah'];
$tel_s   = $_POST['tel_s']; 
$tel_m  = $_POST['tel_m']; 
$co_name  = $_POST['co_name'] ;
$no_co  = $_POST['no_co'] ;
$sh_meli  = $_POST['sh_meli'] ;
$co_sabt  = $_POST['co_sabt'] ;
$m_sod   = $_POST['m_sod']; 
$date_t  = $_POST['date_t']; 
$addres   = $_POST['addres']; 
$email  = $_POST['email']; 
$fa1  = $_POST['fa1']; 
$fa2  = $_POST['fa2']; 
$fa3  = $_POST['fa3']; 
if ($fa1!='1' and $fa2!='1' and $fa3 !='1')  $mess.=' حداقل باید یک زمینه فعالیت انتخاب شود' ;
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
// تعریف متغیرهای که هنگام لود فرم خالی رد میشن
if ($no_bah=='1') {$co_name = '' ; $no_co=''; $sh_meli=''; $co_sabt='';}
if ($no_bah=='2') {$fname= '' ; $m_tah='' ; $er_mtah= '' ; $jens2='' ; $sh_sh=''; }
 {
  if(strlen($add_abadi)>5) 
   {
    $query = "SELECT id_ostan,id_city,id_mar,ostan,city,abadi from list_abadi where add_abadi = '$add_abadi'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id_ostan = $row['id_ostan']; 
    $id_city = $row['id_city']; 
    $id_mar = $row['id_mar']; 
	$add_city = '' ;
	
   }
 if(strlen($add_city)>5) 
  {
    $query = "SELECT id_ostan,id_city,id_mar,ostan,city,shahr from list_city where add_city = '$add_city'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id_ostan = $row['id_ostan']; 
    $id_city = $row['id_city']; 
    $id_mar = $row['id_mar']; 
    $add_abadi = '' ;
  }
}
 $ok = '1' ; 
 $query = "INSERT IGNORE INTO ind_bah (date_s,mor_cod_m,no_bah,bah_cod_m,num_bah,cod_p,jens,name,last_name,date_t,
 sh_sh,m_sod,fname,m_tah,er_mtah,tel_s,tel_m,co_name,no_co,sh_meli,co_sabt,add_abadi,add_city,id_city,id_mar,
 id_ostan,fa1,fa2,fa3,ok,addres,email) 
 VALUES(:date_s,:mor_cod_m,:no_bah,:bah_cod_m,:num_bah,:cod_p,:jens,:name,:last_name, :date_t,:sh_sh,:m_sod,:fname,
 :m_tah,:er_mtah,:tel_s,:tel_m,:co_name,:no_co,:sh_meli,:co_sabt,:add_abadi,:add_city,:id_city,:id_mar,:id_ostan
 ,:fa1,:fa2,:fa3,:ok,:addres,:email)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':no_bah'=>$no_bah,':bah_cod_m'=>$bah_cod_m,
':num_bah'=>$num_bah,':cod_p'=>$cod_p,':jens'=>$jens2,':name'=>$name,':last_name'=>$last_name,':date_t'=>$date_t,
':sh_sh'=>$sh_sh,':m_sod'=>$m_sod,':fname'=>$fname,':m_tah'=>$m_tah,':er_mtah'=>$er_mtah,':tel_s'=>$tel_s,
':tel_m'=>$tel_m,':co_name'=>$co_name,':no_co'=>$no_co,':sh_meli'=>$sh_meli,':co_sabt'=>$co_sabt,
':add_abadi'=>$add_abadi,':add_city'=>$add_city,':id_city'=>$id_city,':id_mar'=>$id_mar,':id_ostan'=>$id_ostan,
':fa1'=>$fa1,':fa2'=>$fa2,':fa3'=>$fa3,':ok'=>$ok,':addres'=>$addres,':email'=>$email));
// ارسال اس ام اس 
//$text= " با سلام اطلاعات شمادر سامانه ثبت مجوز فعالیت های کشاورزی سازمان نظام مهندسی استان ثبت شد کد رهگیری ".$cod_p." اطلاعات بیشتر در سایت سامانه  به آدرس www.aeo-azsh.ir" ; 
//sms($tel_m,$text) ;
 // ثبت در بانک پیگیری
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'ثبت اطلاعات بهره بردار صنایع- '.$bah_cod_m,$id_ostan) ; 
 // once saved, redirect back to the view page 
 //header("Location: user_view.php");
unset($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens2,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,
$co_name,$no_co,$sh_meli,$co_sabt,$add_abadi,$add_city,$addres,$email);
alert ('اطلاعات بهره بردار با موفقیت ثبت شد '.$date_s) ;
?>
<form  name="myform" class="myform" method="post" action="ind.php">
<input type="hidden" name="cod_p" value="<?php echo $cod_p ;?>">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
} 
 else 
 // if the form hasn't been submitted, display the form 
{ 
renderForm($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah
,$er_mtah,$tel_s,$tel_m,$co_name,$no_co,$sh_meli,$co_sabt,$add_abadi,$add_city);
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
</html>