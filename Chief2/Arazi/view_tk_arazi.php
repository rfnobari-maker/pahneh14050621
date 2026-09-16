<?php
include("../../lock_ce.php");
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
//
if  (isset($date_edit))
{
function renderForm($error,$date_s,$mor_cod_m,$bah_cod_m,$no_bat,$jens,$name,$last_name,$date_t,$sh_sh,$m_sod,$fname,$m_tah,$er_mtah,$tel_s,$tel_m,$ostan_s,$shahr_s,$city_s,$rosta_s,$co_name,$no_co,$sh_meli,$co_sabt,$fa_1,$fa_2,$fa_3,$fa_4,$fa_5,$fa_6,$fa_7,$fa_8,$fa_9,$fa_10,$fa_11,$fa_12,$fa_13,$add_abadi,$add_city)
{ 
 
$mor_cod_m = $_POST['mor_cod_m'];
$id = $_POST['id'];
include('../../login/config.php');
$query = "SELECT * from tk_arazi where mor_cod_m =:mor_cod_m and id=:id"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$mor_cod_m,':id'=>$id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $tk_name = $row['name'];
 $last_name = $row['last_name'];
 $tk_cod_m = $row['tk_cod_m']; 
 $add_abadi = $row['add_abadi'] ;
 $no_ka = $row['no_ka'] ;
 $no_ara = $row['no_ara'] ;
 $m_tk = $row['m_tk'] ;
 $lat = $row['lat'] ;
 $lng = $row['lng'] ;
 $address = $row['address'] ;
 $file = $row['file'] ;
 $tk_1 = $row['tk_1'] ;
 $tk_2 = $row['tk_2'] ;
 $tk_3 = $row['tk_3'] ;
 $tk_4 = $row['tk_4'] ;
 $tk_5 = $row['tk_5'] ;
 $tk_6 = $row['tk_6'] ;
 $tk_7 = $row['tk_7'] ;
 $tk_8 = $row['tk_8'] ;
 $tk_9 = $row['tk_9'] ;
 $tk_10 = $row['tk_10'] ;
 $tk_11 = $row['tk_11'] ;
 $tk_12 = $row['tk_12'] ;
 $tk_13 = $row['tk_13'] ;
 $tk_14 = $row['tk_14'] ;
 $tk_15 = $row['tk_15'] ;
 $tk_16 = $row['tk_16'] ;
 $tk_17 = $row['tk_17'] ;
 $tk_18 = $row['tk_18'] ;
 $tk_19 = $row['tk_19'] ;
 $tk_20 = $row['tk_20'] ;
 $tk_21 = $row['tk_21'] ;
 $tk_22 = $row['tk_22'] ;
 $tk_23 = $row['tk_23'] ;
 $tk_24 = $row['tk_24'] ;
 $tk_25 = $row['tk_25'] ;
 $tk_26 = $row['tk_26'] ;
 $tk_27 = $row['tk_27'] ;
 $tk_28 = $row['tk_28'] ;
 $tk_29 = $row['tk_29'] ;
 $sa_tk = $row['sa_tk'] ;
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
<?php include('top.php')?>
	    <form action="" method="post" enctype="multipart/form-data" id="form1" name="form1">
 <p align="center" ><span class="style8"><strong>گزارش تغییر کاربری اراضی کشاورزی</strong></span></p>
 <table style="border:3px solid #069;" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="57">&nbsp;</td>
     <td>&nbsp;</td>
     <td width="173">&nbsp;</td>
     <td><div align="right"><span style="text-align: right">
       <select  name="add_abadi" disabled="disabled"  class="required input_text" id="add_abadi" style="width:170px ; height:40px" tabindex="1" dir="rtl" >
         <option value="" >انتخاب نام آبادی</option>
         <?php
 include('../../login/config.php');
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE  mor_cod_m = '$mor_cod_m'"  ;
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
     <td width="312" height="43"><div align="right">
       <input name="last_name" type="text" class="required  input_text" id="last_name" style="width:150px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td width="145"><div align="right">:نام خانوادگی</div></td>
     <td width="173">&nbsp;</td>
     <td width="221"><div align="right">
       <input name="tk_name" type="text" class="required input_text" id="name" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $tk_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td width="165"><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="45">&nbsp;</td>
     <td>&nbsp;</td>
     <td width="173">&nbsp;</td>
     <td height="45" dir="rtl"><div align="right">
       <input name="tk_cod_m" type="text" class="input_text" id="tk_cod_m"  style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $tk_cod_m ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:30px" align="right" >:کد ملی </div></td>
   </tr>
   <tr>
     <td height="44" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right"><strong>: مشخصات زمین</strong></div></td>
     </tr>
   <tr>
     <td height="55"><div align="right">
       <select name="no_ara" disabled="disabled" class="required input_text" id="no_ara" style="height:40px ; width:150px ; direction:rtl" tabindex="6">
         <option value="">انتخاب کنید</option>
         <option value="1" <?php if($no_ara=='1') echo "selected='selected'" ?>>آبی</option>
         <option value="2" <?php if($no_ara=='2') echo "selected='selected'" ?>>دیم</option>
       </select>
     </div></td>
     <td><div align="right">:نوع اراضی </div></td>
     <td width="173">&nbsp;</td>
     <td height="55" dir="rtl"><div align="right">
       <select name="no_ka" disabled="disabled" class="required input_text" id="no_ka" style="height:40px ; width:150px ; direction:rtl" tabindex="5">
         <option value="" >انتخاب کنید</option>
         <option value="1" <?php if($no_ka=='1') echo "selected='selected'" ?> >زراعی</option>
         <option value="2" <?php if($no_ka=='2') echo "selected='selected'" ?>>باغی</option>
       </select>
     </div></td>
     <td><div style="margin-right:30px" align="right" >: کاربری زمین </div></td>
   </tr>
   <tr>
     <td height="46">&nbsp;</td>
     <td>&nbsp;</td>
     <td width="173">&nbsp;</td>
     <td><div align="right">
       <span class="style2">مترمربع</span>
       <input name="m_tk" type="text" class="required number input_text" id="m_tk" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $m_tk ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:30px" align="right" >:میزان تغییر کاربری</div></td>
   </tr>
   <tr>
     <td height="37" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right"><strong>: UTM مختصات زمین یه صورت </strong></div></td>
     </tr>
   <tr>
     <td height="46"><div align="right">
       <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right"><strong>:Y عرض جغرافیایی</strong></div></td>
     <td width="173">&nbsp;</td>
     <td><div align="right">
       <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:30px" align="right" ><strong>:<strong>X</strong> طول جغرافیایی </strong></div></td>
   </tr>
     <tr>
     <td height="145" colspan="4" bgcolor="#FFFFFF"><div align="right">
      <?php if (strlen($file)> 0) { ?> <a  target="new" href="../../prof/arazi/tk_files/<?php echo $file ;?>"><img src="../../prof/arazi/tk_files/<?php echo $file ;?>" width="150" height="150"  alt=""/> </a> <?php }?>
       <textarea name="address" cols="60" rows="8" readonly="readonly" class="required input_text"  style="width:400px" tabindex="10"><?php echo $address ;?></textarea>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" ><span class="normalTextSmall">: آدرس دقیق محل</span></div></td>
   </tr>
  
   <tr>
     <td colspan="5" align="center">&nbsp;</td>
   </tr>
 </table>
 <table width="95%" height="152"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
   <tr>
     <td height="38" colspan="6" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"> <strong>: نوع تغییر کاربری</strong></div></td>
   </tr>
   <tr>
     <td height="56"  colspan="6" bgcolor="#FFFFFF"><table width="100%" align="center" cellpadding="0" cellspacing="0" class="input_text">
       <tr>
         <td width="455" height="31" style="text-align: right" dir="rtl">&nbsp;عبور شبکه‎های برق</td>
         <td width="24" style="text-align: left"><input type="checkbox" <?php if($tk_15=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_15" id="tk_15" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;برداشت یا افزایش    شن و ماسه</td>
         <td width="48" style="text-align: left"><input type="checkbox" <?php if($tk_1=='on') echo 'checked' ;?>   disabled="disabled"  class="red" name="tk_1" id="tk_1" /></td>
         </tr>
       <tr>
         <td width="455" height="47" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;انتقال و تغییر    حقابه اراضی زارعی و باغات به سایر اراضی و فعالیت‎های غیر کشاورزی</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_15=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_16" id="tk_16" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;ایجاد بنا و    تأسیسات</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_2=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_2" id="tk_2" /></td>
         </tr>
       <tr>
         <td width="455" height="41" style="text-align: right" dir="rtl">&nbsp;سوازندن، قطع و    ریشه کنی و خشک کردن باغات به هر طریق</td>
         <td style="text-align: left"><input type="checkbox" <?php if($tk_17=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_17" id="tk_17" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;خاکبرداری و    خاکریزی</td>
         <td style="text-align: left"><input type="checkbox" <?php if($tk_3=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_3" id="tk_3" /></td>
         </tr>
       <tr>
         <td width="455" height="37" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;مخلوط ریزی و شن    ریزی</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_18=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_18" id="tk_18" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;گود برداری</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_4=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_4" id="tk_4" /></td>
         </tr>
       <tr>
         <td width="455" height="40" style="text-align: right" dir="rtl">&nbsp;احداث راه‎آهن و فرودگاه</td>
         <td style="text-align: left"><input name="tk_19" type="checkbox" <?php if($tk_19=='on') echo 'checked' ;?> disabled="disabled"  class="red"  id="tk_19" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;احداث کوره‎های آجر    و گچ‎پزی</td>
         <td style="text-align: left"><input type="checkbox" <?php if($tk_5=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_5" id="tk_5" /></td>
         </tr>
       <tr>
         <td width="455" height="38" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;احداث پارک و فضای    سبز.</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_20=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_20" id="tk_20" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;پی کنی</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_6=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_6" id="tk_6" /></td>
         </tr>
       <tr>
         <td width="455" height="41" style="text-align: right" dir="rtl">&nbsp;پیست‎های ورزشی</td>
         <td style="text-align: left"><input type="checkbox" <?php if($tk_21=='on') echo 'checked' ;?> disabled="disabled"  class="red"  name="tk_21" id="tk_21" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;دیوار کشی اراضی</td>
         <td style="text-align: left"><input type="checkbox" <?php if($tk_7=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_7" id="tk_7" /></td>
       </tr>
       <tr>
         <td width="455" height="47" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;استخرهای ذخیره آب    غیر کشاورزی</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_22=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_22" id="tk_22" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;دپوی زباله، نخاله    و مصالح ساختمانی، شن و ماسه و ضایعات فلزی.</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_8=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_8" id="tk_8" /></td>
       </tr>
       <tr>
         <td width="455" height="40" style="text-align: right" dir="rtl">&nbsp;احداث پارکینگ مسقف    و غیرمسقف</td>
         <td style="text-align: left"><input type="checkbox" <?php if($tk_23=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_23" id="tk_23" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;ایجاد سکونتگاههای    موقت</td>
         <td style="text-align: left"><input type="checkbox" <?php if($tk_9=='on') echo 'checked' ;?> disabled="disabled"  class="red"  name="tk_9" id="tk_9" /></td>
       </tr>
       <tr>
         <td width="455" height="47" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">محوطه سازی (شامل سنگفرش    و آسفالت کاری، جدول گذاری، سنگ ریزی و موارد مشابه)</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_24=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_24" id="tk_24" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;استقرار کانکس و    آلاچیق</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_10=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_10" id="tk_10" /></td>
       </tr>
       <tr>
         <td width="455" height="42" style="text-align: right" dir="rtl">&nbsp;صنایع تبدیلی و    تکمیلی و غذایی و طرح‎های موضوع تبصره 4 فوق‎الذکر.</td>
         <td style="text-align: left"><input type="checkbox" <?php if($tk_25=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_25" id="tk_25" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;احداث جاده و راه</td>
         <td style="text-align: left"><input type="checkbox" <?php if($tk_11=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_11" id="tk_11" /></td>
       </tr>
       <tr>
         <td width="455" height="42" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;صنایع دستی</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_26=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_26" id="tk_26" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;دفن زباله‎های    واحدهای صنعتی</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_12=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_12" id="tk_12" /></td>
       </tr>
       <tr>
         <td width="455" height="49" style="text-align: right" dir="rtl">&nbsp;طرح‎های خدمات    عمومی</td>
         <td style="text-align: left"><input type="checkbox" <?php if($tk_27=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_27" id="tk_27" /></td>
         <td width="453" style="text-align: right" dir="rtl">&nbsp;رها کردن پساب‎های    واحدهای صنعتی، فاضلاب‎های شهری، ضایعات کارخانجات</td>
         <td style="text-align: left"><input type="checkbox"  <?php if($tk_13=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_13" id="tk_13" /></td>
       </tr>
       <tr>
         <td width="455" height="42" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;طرح‎های تملک    دارایی‎های سرمایه‎ای مصوب مجلس شورای اسلامی (ملی – استانی).</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_28=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_28" id="tk_28" /></td>
         <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;لوله گذاری</td>
         <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" <?php if($tk_14=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_14" id="tk_14" /></td>
       </tr>
       <tr>
         <td height="42" bgcolor="#FFFFFF" style="text-align: right" dir="rtl">&nbsp;</td>
         <td bgcolor="#FFFFFF" style="text-align: left">&nbsp;</td>
         <td bgcolor="#FFFFFF" style="text-align: right" dir="rtl">تغییر طرح های موضوع تبصره 4 به طرح های موضوع تبصره یک </td>
         <td bgcolor="#FFFFFF" style="text-align: left"><input type="checkbox" <?php if($tk_29=='on') echo 'checked' ;?> disabled="disabled"  class="red" name="tk_29" id="tk_29" /></td>
       </tr>
     </table></td>
   </tr>
   <tr>
     <td  colspan="6" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0">
       <tr>
         <td width="73%" height="141"><div align="right">
           <textarea class="input_text" name="sa_tk" id="sa_tk" cols="60" rows="8"><?php echo $sa_tk ;?></textarea>
         </div></td>
         <td width="27%">: سایر موارد با ذکر توضیح</td>
       </tr>
     </table></td>
   </tr>
   </table>
 <p align="center" >&nbsp;</p>
      </form> 
        <p><a href="list_tkarazi.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
        </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><p class="MenuItemRight">Copyright © 2014, سازمان نظام مهندسی کشاورزی و منابع طبیعی استان آذربایجان شرقی All Rights Reserved.</p>
      <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</table>
 <?php  
} 
renderForm($error,$date_s,$mor_cod_m,$name,$last_name,$add_abadi,$id_city,$id_mar,$id_ostan,$tk_cod_m,$no_ka,$no_ara,$m_tk,$lat,$lng,$address,$pic,$tk_1,$tk_2,$tk_3,$tk_4,$tk_5,$tk_6,$tk_7,$tk_8,$tk_9,$tk_10,$tk_11,$tk_12,$tk_13,$tk_14,$tk_15,$tk_16,$tk_17,$tk_18,$tk_19,$tk_20,$tk_21,$tk_22,$tk_23,$tk_24,$tk_25,$tk_26,$tk_27,$tk_28,$tk_29,$sa_tk);
}
?>
</p></td>
</tr>
</td>
</table></body>
</html>
  <?php
