<?php include('../lock_p2.php');?>
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
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td>
<?php include ('top.php') ;
if (isset($_POST['mor_cod_m'])) 
{ 
$mor_cod_m = $_POST['mor_cod_m'] ; 
include('../login/config.php');
$query = "SELECT * FROM  users WHERE cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
  $cod_m = $row['cod_m']; 
  $name = $row['name']; 
  $last_name = $row['Last_name']; 
  $jens = $row['jens']; 
 $sh_sh = $row['sh_sh']; 
 $m_tah = $row['m_tah']; 
 $r_tah = $row['r_tah']; 
 $m_date = $row['m_date']; 
 $cod_p = $row['cod_p']; 
 $tel_s = $row['tel_s']; 
 $tel_m = $row['tel_m']; 
 $mor_pic = $row['pic']; 
 $markaz = $row['markaz']; 
 $id_mar = $row['id_mar']; 
 $city = $row['city']; 
 $ostan_p = $row['ostan']; 


  if ($mor_pic=='') $mor_pic = 'no_pic.png'
?>


    <form action="index.php" method="post" id="form1" name="form1">
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
       <input name="ostan" type="text" class="required" id="ostan" style="width:200px; height:30px ; background:#0CF " dir="rtl" lang="fa" value="<?php echo $ostan_p ; ?>" maxlength="50" xml:lang="fa" readonly="readonly"/>
       </div></td>
     <td width="105"><div style="margin-right:15px" align="right">: استان</div></td>
     <td width="104" rowspan="2"><div style="float:right ; margin-right:10px ; margin-top:15px ; padding:10px "  > <img src="../files/users/<?php echo $mor_pic ?>" width="74" height="96" alt="تصویر کاربر "/></div></td>
   </tr>
   <tr>
     <td height="63" colspan="3">&nbsp;</td>
     <td><div align="right">
       <input name="markaz" type="text" id="markaz" style="height:26px ; font-size:12px ; background:#0CF ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $markaz ?>" readonly="readonly" />
     </div></td>
     <td><div style="margin-right:15px" align="right">: مرکز</div></td>
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
     <td rowspan="4">&nbsp;</td>
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
     <td height="38"><div align="right">
       <select name="m_tah" disabled="disabled" class="required" id="m_tah" style="height:40px ; width:150px ; direction:rtl" tabindex="35"> <option value="">انتخاب کنید</option>
         <option value="4" <?php if ($m_tah=='4') { echo 'selected="selected"' ; } ?>>دیپلم</option>
         <option value="5" <?php if ($m_tah=='5') { echo 'selected="selected"' ; } ?>>فوق دیپلم</option>
         <option value="1" <?php if ($m_tah=='1') { echo 'selected="selected"' ; } ?>>لیسانس</option>
         <option value="2" <?php if ($m_tah=='2') { echo 'selected="selected"' ; } ?>>فوق لیسانس</option>
         <option value="3" <?php if ($m_tah=='3') { echo 'selected="selected"' ; } ?>>دکتری</option>
         </select>
       </div></td>
     <td><div align="right">:مدرک تحصیلی</div></td>
     <td><div align="right">
       <input name="r_tah" type="text" class="required" id="r_tah" style="width:200px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $r_tah ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
     </div></td>
     <td colspan="2"><div style="margin-right:15px" align="right" >:رشته تحصیلی</div></td>
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
 <td></p>
   <tr>
     <td colspan="6" align="center">&nbsp;</td>
   </tr>
   </table>
   <p>
   <input type="hidden" name="id_city" value="<?php echo  $row['id_city'] ;?>">
   <input type="hidden" name="city" value="<?php echo  $row['city'] ;?>">
   <input type="hidden" name="id_mar" value="<?php echo  $row['id_mar'] ;?>">

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
