<?php
include("../../lock_p1.php");
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
//
if($_FILES['pic']['name']) {
list($name,$result) = upload('pic','tk_files','jpg,jpeg,gif,png,JPG,JPEG,PNG');
if ($result==1) {
$file_send =  $name ;
 $mess =  "<br align='center'> <font size=3 color='#060' >پیام شما با موفقیت ارسال شد </font></br>";
 } else 
 {
 $mess =  "<br align='center' style='text-decoration:rtl'> <font size=3 color='#900 ' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
}
else 
{
$file_send = '' ;
}
//require_once('../ersal_p.php');
if  (isset($date_edit))
{
function renderForm($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$ostan_s,$shahr_s,$city_s,$rosta_s,$co_name,$no_co,$sh_meli,$co_sabt,$fa_1,$fa_2,$fa_3,$fa_4,$fa_5,$fa_6,$fa_7,$fa_8,$fa_9,$fa_10,$fa_11,$fa_12,$fa_13,$add_abadi,$add_city)
{ 
date_default_timezone_set('Asia/Tehran') ;
 $date_s = date_con(jdate("Y/m/d"));
 $bah_cod_m = $_POST['bah_cod_m'];
 $add_abadi = $_POST["add_abadi"]; 
 $add_city = $_POST["add_city"]; 
 $no_bah ='1'; 
 $s_bah = $_POST["s_bah"]; 
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
    <title>سامانه پهنه بندی آبادی های آذربایجان شرقی</title>
	<link rel="stylesheet" href="../jspc-gray.css">
     <link href="../radio.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../../js-persian-cal.min.js"></script>
    <script type="text/javascript" src="../../script.js"></script>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
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
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
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
 <p align="center" ><span class="style8"><strong>ثبت تغییر کاربری اراضی کشاورزی</strong></span></p>
 <table style="border:3px solid #069;" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="57">&nbsp;</td>
     <td>&nbsp;</td>
     <td width="177">&nbsp;</td>
     <td><div align="right"><span style="text-align: right">
       <select  name="add_abadi"  class="required input_text" id="add_abadi" style="width:170px ; height:40px" tabindex="1" dir="rtl" >
         <option value="" >انتخاب نام آبادی</option>
         <?php
 include('../../login/config.php');
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = $login_session"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
         <option value="<? echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <? echo $row['abadi'] ;?></option>
         <?php }?>
         </select>
       </span></div></td>
     <td><div style="margin-right:30px" align="right" >: نام آبادی</div></td>
   </tr>
   <tr>
     <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right"><strong>: مشخصات فرد تغییر دهنده کاربری اراضی کشاورزی</strong></div></td>
     </tr>
   <tr>
     <td width="311" height="43"><div align="right">
       <input name="last_name" type="text" class="required  input_text" id="last_name" style="width:150px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" xml:lang="fa" />
     </div></td>
     <td width="122"><div align="right">:نام خانوادگی</div></td>
     <td width="177">&nbsp;</td>
     <td width="214"><div align="right">
       <input name="name" type="text" class="required input_text" id="name" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $name ; ?>" maxlength="50" xml:lang="fa" />
     </div></td>
     <td width="158"><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="45">&nbsp;</td>
     <td>&nbsp;</td>
     <td width="177">&nbsp;</td>
     <td height="45" dir="rtl"><div align="right">
       <input name="tk_cod_m" type="text" class="input_text" id="tk_cod_m"  style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:30px" align="right" >:کد ملی </div></td>
   </tr>
   <tr>
     <td height="44" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right"><strong>: مشخصات زمین</strong></div></td>
     </tr>
   <tr>
     <td height="55"><div align="right">
       <select name="no_ara" class="required input_text" id="no_ara" style="height:40px ; width:150px ; direction:rtl" tabindex="6">
         <option value="">انتخاب کنید</option>
         <option value="1">آبی</option>
         <option value="2">دیم</option>
       </select>
     </div></td>
     <td><div align="right">:نوع اراضی </div></td>
     <td width="177">&nbsp;</td>
     <td height="55" dir="rtl"><div align="right">
       <select name="no_ka" class="required input_text" id="no_ka" style="height:40px ; width:150px ; direction:rtl" tabindex="5">
         <option value="">انتخاب کنید</option>
         <option value="1">زراعی</option>
         <option value="2">باغی</option>
       </select>
     </div></td>
     <td><div style="margin-right:30px" align="right" >: کاربری زمین </div></td>
   </tr>
   <tr>
     <td height="46">&nbsp;</td>
     <td>&nbsp;</td>
     <td width="177">&nbsp;</td>
     <td><div align="right">
       <span class="style2">مترمربع</span>
       <input name="m_tk" type="text" class="required digits input_text" id="m_tk" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:30px" align="right" >:میزان تغییر کاربری</div></td>
   </tr>
   <tr>
     <td height="37" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right"><strong>: UTM مختصات زمین یه صورت </strong></div></td>
     </tr>
   <tr>
     <td height="46"><div align="right">
       <input name="lat" type="text" class="number input_text" id="lat" style="width:150px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:عرض جغرافیایی</div></td>
     <td width="177">&nbsp;</td>
     <td><div align="right">
       <input name="lng" type="text" class="number input_text" id="lng" style="width:150px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:30px" align="right" >:طول جغرافیایی</div></td>
   </tr>
     <tr>
     <td height="145" colspan="4" bgcolor="#FFFFFF"><div align="right">
       <textarea name="address" cols="60" rows="8" class="required input_text" id="address" tabindex="10"><?php echo $comment ;?></textarea>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" ><span class="normalTextSmall">: آدرس دقیق محل</span></div></td>
   </tr>
     <tr>
       <td height="46" colspan="2">&nbsp;</td>
       <td colspan="2"><div align="right" class="input_text" >
         <input name="pic" type="file" id="pic" tabindex="11"  accept=".jpg,.jpeg,.gif,.png,.JPG,.JPEG,.GIF,.PNG,.xlsx,.xls,.doc,.docx,.pdf" />
         <br />
       </div></td>
       <td><div style="margin-right:30px" align="right" >:تصویر محل</div></td>
     </tr>
  
   <tr>
     <td colspan="5" align="center">&nbsp;</td>
   </tr>
 </table>
 <table width="95%" height="152"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
   <tr>
     <td height="38" colspan="6" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"> : نوع تغییر کاربری</div></td>
   </tr>
   <tr>
     <td height="56"  colspan="6" bgcolor="#FFFFFF"><table width="100%" align="center" cellpadding="0" cellspacing="0" class="input_text">
       <tr>
         <td width="455" height="31" style="text-align: right" dir="rtl">&nbsp;عبور شبکه‎های برق</td>
         <td width="24" style="text-align: left"><input type="checkbox" class="red"name="tk_15" id="tk_15" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;برداشت یا افزایش    شن و ماسه</td>
         <td width="48" style="text-align: left"><input type="checkbox" class="red"name="tk_1" id="tk_1" /></td>
         </tr>
       <tr>
         <td width="455" height="47" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;انتقال و تغییر    حقابه اراضی زارعی و باغات به سایر اراضی و فعالیت‎های غیر کشاورزی</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_16" id="tk_16" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;ایجاد بنا و    تأسیسات</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_2" id="tk_2" /></td>
         </tr>
       <tr>
         <td width="455" style="text-align: right" dir="rtl">&nbsp;سوازندن، قطع و    ریشه کنی و خشک کردن باغات به هر طریق</td>
         <td style="text-align: left"><input type="checkbox" class="red"name="tk_17" id="tk_17" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;خاکبرداری و    خاکریزی</td>
         <td style="text-align: left"><input type="checkbox" class="red"name="tk_3" id="tk_3" /></td>
         </tr>
       <tr>
         <td width="455" height="37" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;مخلوط ریزی و شن    ریزی</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_18" id="tk_18" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;گود برداری</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_4" id="tk_4" /></td>
         </tr>
       <tr>
         <td width="455" height="40" style="text-align: right" dir="rtl">&nbsp;احداث راه‎آهن و فرودگاه</td>
         <td style="text-align: left"><input name="tk_19" type="checkbox" class="red" id="tk_19" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;احداث کوره‎های آجر    و گچ‎پزی</td>
         <td style="text-align: left"><input type="checkbox" class="red"name="tk_5" id="tk_5" /></td>
         </tr>
       <tr>
         <td width="455" height="38" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;احداث پارک و فضای    سبز.</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_20" id="tk_20" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;پی کنی</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_6" id="tk_6" /></td>
         </tr>
       <tr>
         <td width="455" height="41" style="text-align: right" dir="rtl">&nbsp;پیست‎های ورزشی</td>
         <td style="text-align: left"><input type="checkbox" class="red"name="tk_21" id="tk_21" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;دیوار کشی اراضی</td>
         <td style="text-align: left"><input type="checkbox" class="red"name="tk_7" id="tk_7" /></td>
       </tr>
       <tr>
         <td width="455" height="47" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;استخرهای ذخیره آب    غیر کشاورزی</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_22" id="tk_22" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;دپوی زباله، نخاله    و مصالح ساختمانی، شن و ماسه و ضایعات فلزی.</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_8" id="tk_8" /></td>
       </tr>
       <tr>
         <td width="455" height="40" style="text-align: right" dir="rtl">&nbsp;احداث پارکینگ مسقف    و غیرمسقف</td>
         <td style="text-align: left"><input type="checkbox" class="red"name="tk_23" id="tk_23" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;ایجاد سکونتگاههای    موقت</td>
         <td style="text-align: left"><input type="checkbox" class="red"name="tk_9" id="tk_9" /></td>
       </tr>
       <tr>
         <td width="455" height="47" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">محوطه سازی (شامل سنگفرش    و آسفالت کاری، جدول گذاری، سنگ ریزی و موارد مشابه)</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_24" id="tk_24" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;استقرار کانکس و    آلاچیق</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_10" id="tk_10" /></td>
       </tr>
       <tr>
         <td width="455" style="text-align: right" dir="rtl">&nbsp;صنایع تبدیلی و    تکمیلی و غذایی و طرح‎های موضوع تبصره 4 فوق‎الذکر.</td>
         <td style="text-align: left"><input type="checkbox" class="red"name="tk_25" id="tk_25" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;احداث جاده و راه</td>
         <td style="text-align: left"><input type="checkbox" class="red"name="tk_11" id="tk_11" /></td>
       </tr>
       <tr>
         <td width="455" height="42" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;صنایع دستی</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_26" id="tk_26" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;دفن زباله‎های    واحدهای صنعتی</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_12" id="tk_12" /></td>
       </tr>
       <tr>
         <td width="455" height="49" style="text-align: right" dir="rtl">&nbsp;طرح‎های خدمات    عمومی</td>
         <td style="text-align: left"><input type="checkbox" class="red"name="tk_27" id="tk_27" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;رها کردن پساب‎های    واحدهای صنعتی، فاضلاب‎های شهری، ضایعات کارخانجات</td>
         <td style="text-align: left"><input type="checkbox" class="red"name="tk_13" id="tk_13" /></td>
       </tr>
       <tr>
         <td width="455" height="42" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;طرح‎های تملک    دارایی‎های سرمایه‎ای مصوب مجلس شورای اسلامی (ملی – استانی).</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_28" id="tk_28" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;لوله گذاری</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_14" id="tk_14" /></td>
       </tr>
       <tr>
         <td height="42" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;</td>
         <td bgcolor="#CCCCCC" style="text-align: left">&nbsp;</td>
         <td bgcolor="#CCCCCC" style="text-align: right" dir="rtl">تغییر طرح های موضوع تبصره 4 به طرح های موضوع تبصره یک </td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="tk_29" id="tk_29" /></td>
       </tr>
     </table></td>
   </tr>
   <tr>
     <td  colspan="6" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0">
       <tr>
         <td width="73%" height="141"><div align="right">
           <textarea class="input_text" name="sa_tk" id="sa_tk" cols="60" rows="8"><?php echo $comment ;?></textarea>
         </div></td>
         <td width="27%">: سایر موارد با ذکر توضیح</td>
       </tr>
     </table></td>
   </tr>
   </table>
 <div align="center">
   <p>
     <input type="submit" name="action" value="ثبت و ادامه" style="width:150px ; height:45px" tabindex="28" />
   </p>
</div>
 <p align="center" >&nbsp;</p>
      </form> 
     
           </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><p class="MenuItemRight">Copyright © 2014, سازمان نظام مهندسی کشاورزی و منابع طبیعی استان آذربایجان شرقی All Rights Reserved.</p>
      <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</table>
 <?php  
} 
 include('../../login/config.php');
 if (isset($_POST['action'])) 
 {  
$date_s = $date_edit ; 
$mor_cod_m = $login_session ;
$name = $_POST['name']; 
$last_name = $_POST['last_name']; 
$tk_cod_m = '' ;
$tk_cod_m   = $_POST['tk_cod_m']; 
$no_ka   = $_POST['no_ka']; 
$no_ara   = $_POST['no_ara']; 
$m_tk   = $_POST['m_tk']; 
$lat = '' ;
$lat = $_POST['lat'];
$lng = '' ;
$lng   = $_POST['lng']; 
$pic = '';
$pic = $_POST['pic']; 
$address =$_POST['address'];
  $tk_1  = $_POST['tk_1'] ;
if(!$tk_1==on) $tk_1 ='' ;
  $tk_2   = $_POST['tk_2'] ;
if(!$tk_2==on) $tk_2 ='' ;
 $tk_3   = $_POST['tk_3'] ;
if(!$tk_3==on) $tk_3 ='' ;
 $tk_4   = $_POST['tk_4'] ;
if(!$tk_4==on) $tk_4 ='' ;
 $tk_5   = $_POST['tk_5'] ;
if(!$tk_5==on) $tk_5 ='' ;
 $tk_6   = $_POST['tk_6'] ;         
if(!$tk_6==on) $tk_6 ='' ;
 $tk_7   = $_POST['tk_7'] ;
if(!$tk_7==on) $tk_7 ='' ;
 $tk_8   = $_POST['tk_8'] ;
if(!$tk_8==on) $tk_8 ='' ;
 $tk_9   = $_POST['tk_9'] ;
if(!$tk_9==on) $tk_9 ='' ;
 $tk_10  = $_POST['tk_10'] ;
if(!$tk_10==on) $tk_10 ='' ;
 $tk_11  = $_POST['tk_11'] ;
if(!$tk_11==on) $tk_11 ='' ;
 $tk_12  = $_POST['tk_12'] ;
if(!$tk_12==on) $tk_12 ='' ;
 $tk_13  = $_POST['tk_13'] ;
if(!$tk_13==on) $tk_13 ='' ;
 $tk_14   = $_POST['tk_14'] ;
if(!$tk_14==on) $tk_14 ='' ;
 $tk_15   = $_POST['tk_15'] ;
if(!$tk_15==on) $tk_15 ='' ;
 $tk_16   = $_POST['tk_16'] ;         
if(!$tk_16==on) $tk_16 ='' ;
 $tk_17   = $_POST['tk_17'] ;
if(!$tk_17==on) $tk_17 ='' ;
 $tk_18   = $_POST['tk_18'] ;
if(!$tk_18==on) $tk_18 ='' ;
 $tk_19   = $_POST['tk_19'] ;
if(!$tk_19==on) $tk_19 ='' ;
 $tk_20  = $_POST['tk_20'] ;
if(!$tk_20==on) $tk_20 ='' ;
 $tk_21  = $_POST['tk_21'] ;
if(!$tk_21==on) $tk_21 ='' ;
 $tk_22  = $_POST['tk_22'] ;
if(!$tk_22==on) $tk_22 ='' ;
 $tk_23 = $_POST['tk_23'] ;
if(!$tk_23==on) $tk_23 ='' ;
 $tk_24 = $_POST['tk_24'] ;
if(!$tk_24==on) $tk_24 ='' ;
 $tk_25 = $_POST['tk_25'] ;
if(!$tk_25==on) $tk_25 ='' ;
 $tk_26 = $_POST['tk_26'] ;
if(!$tk_26==on) $tk_26 ='' ;
 $tk_27 = $_POST['tk_27'] ;
if(!$tk_27==on) $tk_27='' ;
 $tk_28 = $_POST['tk_28'] ;
if(!$tk_28==on) $tk_28 ='' ;
 $tk_29 = $_POST['tk_29'] ;
if(!$tk_29==on) $tk_29 ='' ;
 $sa_tk = '' ;
 $sa_tk  = $_POST['sa_tk'] ;
 $add_abadi = $_POST['add_abadi'] ;
// تعریف متغیرهای که هنگام لود فرم خالی رد میشن
 include('../../login/config.php');
 $query = "SELECT * from list_abadi where add_abadi = :add_abadi"; 
 $stmt = $dbh->prepare($query);
 $stmt->execute(array(':add_abadi'=>$add_abadi));
 $found = $stmt -> rowCount();
 $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $id_ostan = $row["id_ostan"]; 
   $id_city = $row["id_city"]; 
   $id_mar = $row["id_mar"]; 
 $query = "INSERT INTO tk_arazi (date_s,mor_cod_m,name,last_name,add_abadi,id_city,id_mar,id_ostan,tk_cod_m,no_ka,no_ara,m_tk,lat,lng,address,pic,tk_1,tk_2,tk_3,tk_4,tk_5,tk_6,tk_7,tk_8,tk_9,tk_10,tk_11,tk_12,tk_13,tk_14,tk_15,tk_16,tk_17,tk_18,tk_19,tk_20,tk_21,tk_22,tk_23,tk_24,tk_25,tk_26,tk_27,tk_28,tk_29,sa_tk) VALUES(:date_s,:mor_cod_m,:name,:last_name,:add_abadi,:id_city,:id_mar,:id_ostan,:tk_cod_m,:no_ka,:no_ara,:m_tk,:lat,:lng,:address,:pic,:tk_1,:tk_2,:tk_3,:tk_4,:tk_5,:tk_6,:tk_7,:tk_8,:tk_9,:tk_10,:tk_11,:tk_12,:tk_13,:tk_14,:tk_15,:tk_16,:tk_17,:tk_18,:tk_19,:tk_20,:tk_21,:tk_22,:tk_23,:tk_24,:tk_25,:tk_26,:tk_27,:tk_28,:tk_29,:sa_tk)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':name'=>$name,':last_name'=>$last_name,':add_abadi'=>$add_abadi,':id_city'=>$id_city,':id_mar'=>$id_mar,':id_ostan'=>$id_ostan,':tk_cod_m'=>$tk_cod_m,':no_ka'=>$no_ka,':no_ara'=>$no_ara,':m_tk'=>$m_tk,':lat'=>$lat,':lng'=>$lng,':address'=>$address,':pic'=>$pic,':tk_1'=>$tk_1,':tk_2'=>$tk_2,':tk_3'=>$tk_3,':tk_4'=>$tk_4,':tk_5'=>$tk_5,':tk_6'=>$tk_6,':tk_7'=>$tk_7,':tk_8'=>$tk_8,':tk_9'=>$tk_9,':tk_10'=>$tk_10,':tk_11'=>$tk_11,':tk_12'=>$tk_12,':tk_13'=>$tk_13,':tk_14'=>$tk_14,':tk_15'=>$tk_15,':tk_16'=>$tk_16,':tk_17'=>$tk_17,':tk_18'=>$tk_18,':tk_19'=>$tk_19,':tk_20'=>$tk_20,':tk_21'=>$tk_21,':tk_22'=>$tk_22,':tk_23'=>$tk_23,':tk_24'=>$tk_24,':tk_25'=>$tk_25,':tk_26'=>$tk_26,':tk_27'=>$tk_27,':tk_28'=>$tk_28,':tk_29'=>$tk_29,':sa_tk'=>$sa_tk));
// ارسال اس ام اس 
//$text= " با سلام اطلاعات شمادر سامانه ثبت مجوز فعالیت های کشاورزی سازمان نظام مهندسی استان ثبت شد کد رهگیری ".$cod_p." اطلاعات بیشتر در سایت سامانه  به آدرس www.aeo-azsh.ir" ; 
//sms($tel_m,$text) ;
 // ثبت در بانک پیگیری
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'ثبت تغییر کاربری') ; 
 // once saved, redirect back to the view page 
 //header("Location: user_view.php");
unset($error,$date_s,$mor_cod_m,$name,$last_name,$add_abadi,$id_city,$id_mar,$id_ostan,$tk_cod_m,$no_ka,$no_ara,$m_tk,$lat,$lng,$address,$pic,$tk_1,$tk_2,$tk_3,$tk_4,$tk_5,$tk_6,$tk_7,$tk_8,$tk_9,$tk_10,$tk_11,$tk_12,$tk_13,$tk_14,$tk_15,$tk_16,$tk_17,$tk_18,$tk_19,$tk_20,$tk_21,$tk_22,$tk_23,$tk_24,$tk_25,$tk_26,$tk_27,$tk_28,$tk_29,$sa_tk);
alert ('اطلاعات بهره بردار با موفقیت ثبت شد ') ;
?>
<form  name="myform" class="myform" method="post" action="index.php">
<input type="hidden" name="cod_p" value="<?php echo $cod_p ;?>">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
} 
 else 
 // if the form hasn't been submitted, display the form 
{ 
renderForm($error,$date_s,$mor_cod_m,$name,$last_name,$add_abadi,$id_city,$id_mar,$id_ostan,$tk_cod_m,$no_ka,$no_ara,$m_tk,$lat,$lng,$address,$pic,$tk_1,$tk_2,$tk_3,$tk_4,$tk_5,$tk_6,$tk_7,$tk_8,$tk_9,$tk_10,$tk_11,$tk_12,$tk_13,$tk_14,$tk_15,$tk_16,$tk_17,$tk_18,$tk_19,$tk_20,$tk_21,$tk_22,$tk_23,$tk_24,$tk_25,$tk_26,$tk_27,$tk_28,$tk_29,$sa_tk);
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
  <?php
   // فانكشن آپلود فايل 
function upload($file_id, $folder="", $types="") 
{
// پوشه نام 
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("md");
$time = date('Hi') ;
   if(!$_FILES[$file_id]['name']) return array('','No file specified');
      $file_title = $_FILES[$file_id]['name'];
	$ext = substr(strrchr(basename($file_title), '.'), 1);
    $no_file = $_POST['s_user'].'_'.$date_edit.'_'.$time ;
    $file_name = $no_file.'.' . $ext;//Get Unique Name
  //  echo $file_name ; 
	$all_types = explode(",",strtolower($types));
    if($types) {
        if(in_array($ext,$all_types));
        else {
            $result = 'فايل غير مجاز' ;
			echo "<br/>\n" ;
			 //Show error if any.
        //   return array('',$result);
		  return array($file_name,$result);
        }
    }
    //Where the file must be uploaded to
    if($folder) $folder .= '/';//Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;
    $result = 1;
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "امكان آپلود فايل وجود ندارد "; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : مقصد يافت نشد ";
        } elseif(!is_writable($folder)) {
            $result .= " : امكان نوشتن در مقصد وجود ندارد";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : فايل قابل نوشتن نيست";
        }
        $file_name = '';
        
    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result =  " فايل خالي است لطفا يك فايل معتبر انتخاب كنيد "; //Show the error message
			echo "<br/>\n" ;
        } else {
// کنترل حجم فایل
   
switch ($file_id)
 {
  case "pic":
        $max_filesize  = 50000;
		$min_filesize = 200;
}
            $size=filesize($_FILES[$file_id]['tmp_name']);
//            $max_filesize = 122091;
            if (($size > $max_filesize) || ($size < $min_filesize))
		   {
			$result = 'حجم فایل غیر مجاز '.($size/1000).'کیلوبایت'  ;
             }
			 chmod($uploadfile,0777);//Make it universally writable.
        }
    }
		  return array($file_name,$result);
}
////End
?>