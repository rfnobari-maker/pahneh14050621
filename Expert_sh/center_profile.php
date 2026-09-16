<?php include('../lock_expsh.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
-->
    </style>
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td>
<?php 
include('top.php');
if (isset($_POST['username'])) 
{ 
$username = $_POST['username'] ; 
$cod_m = $_POST['cod_m'] ; 
include('../login/config.php');
 $query = "SELECT * FROM  users WHERE username = '$username' and cod_m = '$cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
  $cod_m = $row['cod_m']; 
  $name = $row['name']; 
  $last_name = $row['Last_name']; 
  $jens = $row['jens']; 
 $sh_sh = $row['sh_sh']; 
 $date_t = $row['date_t']; 
 $m_sodor = $row['m_sodor']; 
 $fname = $row['fname']; 
 $m_tah = $row['m_tah']; 
 $r_tah = $row['r_tah']; 
 $univer = $row['univer']; 
 $m_date = $row['m_date']; 
 $avre = $row['avre']; 
 $v_tahol = $row['v_tahol']; 
 $cod_p = $row['cod_p']; 
 $tel_s = $row['tel_s']; 
 $tel_m = $row['tel_m']; 
 $addres = $row['addres']; 
 $mor_pic = $row['pic']; 
 $markaz = $row['markaz']; 
 $city = $row['city'] ;
  if ($mor_pic=='') $mor_pic = 'no_pic.png'
?>


    <form action="centers.php" method="post" id="form1" name="form1">
        <div align="center">
          <p>
    <input type="hidden" name="cod_p" style="height:26px ; width:150px ; background:#0CF ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $cod_p ;?>" />
          <table style="border:3px solid #069;" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="48" colspan="6" class="style9" > <span style="color: #069"></span>
       <div style="margin-right:40px" align="right">
         <p><strong>اطلاعات محل خدمت</strong></p>
       </div></td>
     </tr>
   <tr>
     <td width="252" height="66"><div align="right">
       <input name="city" type="text" id="city" style="height:26px ; width:150px ; background:#0CF ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $city ?>" readonly="readonly" />
       </div></td>
     <td width="195"><div align="right">:شهرستان </div></td>
     <td width="42">&nbsp;</td>
     <td width="200"><div align="right" >
       <input name="ostan" type="text" class="required" id="ostan" style="width:200px; height:30px ; background:#0CF " dir="rtl" lang="fa" value="<?php echo $ostan ; ?>" maxlength="50" xml:lang="fa" readonly="readonly"/>
       </div></td>
     <td width="105"><div style="margin-right:15px" align="right">: استان</div></td>
     <td width="104" rowspan="2"><div style="float:right ; margin-right:10px ; margin-top:15px ; padding:10px "  > <img src="../files/users/<?php echo $mor_pic ?>" width="74" height="96" alt="تصویر کاربر "/></div></td>
   </tr>
   <tr>
     <td height="63">&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td><div align="right">
       <input name="cod_m2" type="text" id="cod_m2" style="height:26px ; width:150px ; background:#0CF ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $cod_m ?>" readonly="readonly" />
     </div></td>
     <td><div style="margin-right:15px" align="right">: کد ملی </div></td>
     </tr>
   <tr>
     <td height="38" colspan="6" align="center"><p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p></td>
   </tr>
      <tr>
   <td height="38" colspan="6" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات کاربر</strong></div></td>
     </tr>
   <tr>
     <td height="38"><div align="right">
       <input name="last_name" type="text" class="required" style="width:200px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
       </div></td>
     <td><div align="right">:نام خانوادگی</div></td>
     <td rowspan="8">&nbsp;</td>
     <td><div align="right">
   <input name="name" type="text" class="required" style="width:150px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
       </div></td>
     <td colspan="2"><div style="margin-right:15px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="38"><div align="right">
       <input name="sh_sh" type="text" class="required digits" id="sh_sh" style="width:150px; height:30px ; " tabindex="31" dir="rtl" lang="fa" value="<?php echo $sh_sh ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td><div align="right">
       <select name="jens" disabled="disabled" class="required" id="jens" style="height:40px ; width:100px ; direction:rtl" tabindex="35">
         <option value="">انتخاب کنید</option>
         <option value="مرد"<?php if ($jens=='مرد') { echo 'selected="selected"' ; } ?>>آقا</option>
         <option value="زن"<?php if ($jens=='زن') { echo 'selected="selected"' ; } ?>>خانم</option>
       </select>
     </div></td>
     <td colspan="2"><div style="margin-right:15px" align="right" >: جنسیت</div></td>
   </tr>


   <tr>
     <td height="42"><div align="right">
       <input name="m_sodor" type="text" class="required" id="m_sodor" style="width:150px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $m_sodor ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:محل صدور</div></td>
    <td height="42" dir="rtl"><div align="right">
       <input name="date_t" type="text" class="pdate required" id="pcal1" style="width:150px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td colspan="2"><div style="margin-right:15px" align="right" > : تاریخ تولد</div></td>
   </tr>
   <tr>
     <td height="38"><div align="right">
       <select name="m_tah" disabled="disabled" class="required" id="m_tah" style="height:40px ; width:150px ; direction:rtl" tabindex="35"> <option value="">انتخاب کنید</option>
         <option value="1" <?php if ($m_tah=='1') { echo 'selected="selected"' ; } ?>>لیسانس</option>
         <option value="2" <?php if ($m_tah=='2') { echo 'selected="selected"' ; } ?>>فوق لیسانس</option>
         <option value="3" <?php if ($m_tah=='3') { echo 'selected="selected"' ; } ?>>دکتری</option>
       </select>
     </div></td>
     <td><div align="right">:مدرک تحصیلی</div></td>
     <td><div align="right">
       <input name="fname" type="text" class="required" id="fname" style="width:150px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $fname ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td colspan="2"><div style="margin-right:15px" align="right" >: نام پدر</div></td>
   </tr>
   <tr>
     <td height="42"><div align="right">
       <input name="univer" type="text" class="required" id="univer" style="width:200px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $univer ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td><div align="right">:نام دانشگاه</div></td>
     <td><div align="right">
       <input name="r_tah" type="text" class="required" id="r_tah" style="width:200px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $r_tah ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td colspan="2"><div style="margin-right:15px" align="right" >:رشته تحصیلی</div></td>
     </tr>
   <tr>
     <td height="42"><div align="right">
       <input name="avre" type="text" class="required" id="avre" style="width:75px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $avre ; ?>" maxlength="5" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:معدل </div></td>
    <td height="42" dir="rtl"><div align="right">
       <input name="m_date" type="text" class="pdate required" id="pcal2" style="width:150px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $m_date ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td colspan="2"><div style="margin-right:15px" align="right" >:تاریخ اخذ مدرک</div></td>
     </tr>
   <tr>
     <td height="42"><div align="right">
       <input name="cod_p" type="text" class="required" id="cod_p" style="width:150px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:کد پرسنلی</div></td>
     <td height="42"><div align="right">
       <select name="v_tahol" disabled="disabled" class="required" id="v_tahol" style="height:40px ; width:150px ; direction:rtl" tabindex="35">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($v_tahol=='1') { echo 'selected="selected"' ; } ?>>متاهل</option>
         <option value="2"<?php if ($v_tahol=='2') { echo 'selected="selected"' ; } ?>>مجرد</option>
       </select>
     </div></td>
     <td colspan="2"><div style="margin-right:15px" align="right" >:وضعیت تاهل</div></td>
     </tr>
   <tr>
     <td height="38"><div align="right"><span class="style2"><img src="../files/sms.png" width="25" height="25" /></span>
       <input name="tel_m" type="text" class="required digits" id="tel_m" style="width:150px; height:30px ; " tabindex="37" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td><div align="right">
       <input name="tel_s" type="text" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="36" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
     </div></td>
     <td colspan="2"><div style="margin-right:15px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
     <td height="38" colspan="4"><div align="right">
       <input name="addres" type="text" class="required" id="addres" style="width:700px; height:30px ; " tabindex="38" dir="rtl" lang="fa" value="<?php echo $addres ; ?>" maxlength="300" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td colspan="2"><div style="margin-right:15px" align="right" >:آدرس محل سکونت</div></td>
     <tr>
 <td></p>
   <tr>
     <td colspan="6" align="center">&nbsp;</td>
   </tr>
   </table>
   <p>
   <input type="hidden" name="username"  value="<?php echo $username ;?>" />
   <input type="hidden" name="previous" value="<?php echo $previous ;?>">
     <input type="submit" name="action" value="بازگشت" style="width:150px ; height:45px" tabindex="39" />
   </p>
   </p>
 </div>
    </form>
 <?php
}
else 
{
	echo '<br>' ; 
	echo '<p align=center style=color:red> مجوز دسترسی به این صفحه را ندارید </p> ' ;
	}
?>
     </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
