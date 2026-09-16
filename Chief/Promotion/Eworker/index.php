<?php 
include('../../../lock_ce.php');
include('../../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city5'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $sal_z = $_POST['sal_z'] ;
 $cod_m = $_POST['cod_m'] ;
 $jens = $_POST['jens'] ;
 $v_tah = $_POST['v_tah'] ;
 $g_tah = $_POST['g_tah'] ;
 $z_fa1 = $_POST['z_fa1'] ;
 $z_fa2 = $_POST['z_fa2'] ;
 $no_oz = $_POST['no_oz'] ;
 $oz_ta = $_POST['oz_ta'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    </style>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

-->
</style>
<style type="text/css">
#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
</style>
  <script>
function target_po3(form) {
    window.open('null', 'formpopup', 'width=950,height=1400,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../../files/images/header.jpg" width="100%" height="149" /></td>
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
      <?php include('top.php');?>
      <span class="style8">گزارش اطلاعات مددکاران ترویجی/ تسهیلگران</span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="428" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <span class="style2">مثال : 1387</span>
                   <input name="sal_z" type="text" class="input_text" id="sal_z"  style="height:35px ; width:75px " value="<?php echo $z_sal?>" />
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: سال جذب</td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                 <select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                  <option value="-1">مهم نیست</option>
                   <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
                   <?php 
		   }?>
                 </select>
                   <?php 
				   if (isset($_POST['id_ostan']))
  $id_ostan1= $_POST['id_ostan'] ; 
?></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="41" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="jens" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl">
                     <option value="0">مهم نیست</option>
                     <option value="1" <?php if ($jens=='1') echo 'selected=selected'?>>مرد</option>
                     <option value="2" <?php if ($jens=='2') echo 'selected=selected'?>>زن</option>
                   </select>
                 </div></td>
                 <td height="41" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="style8">: جنسیت</font></td>
                 <td width="214" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_city5" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="0"> مهم نیست</option>
                     <?php
$query = "SELECT DISTINCT id_city,city FROM public_abadi4 WHERE  id_ostan = '$id_ostan1' ORDER BY BINARY city ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
                     <?php }?>
                     </select>
                   <?php 
				   if (isset($_POST['id_city5']))
  $id_city = $_POST['id_city5'] ; 
?></td>
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="42" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >مهم نیست</option>
                   <?php
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE  id_mar = '$id_mar' ORDER BY BINARY abadi "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                   <?php }?>
                 </select></td>
                 <td height="42"  align='center' bgcolor="#DDDDDD" class="style8">نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="id_mar" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
                   <option value="0">مهم نیست</option>
                   <?php
$query = "SELECT  id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan1' and id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
                   <?php }?>
                 </select>
                   <?php
                 				   if (isset($_POST['id_mar']))
  $id_mar = $_POST['id_mar'] ; 

				 ?>
                   <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td rowspan="2"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="40" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >مهم نیست</option>
                   <?php
$query = "SELECT  add_city,shahr FROM list_city WHERE  id_mar = '$id_mar' ORDER BY BINARY shahr "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                   <?php }?>
                 </select></td>
                 <td height="40"  align='center' bgcolor="#DDDDDD" class="style8">:نام شهر</td>
               </tr>
               <tr >
                 <td height="44" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="v_tah"  class="input_text mar required" id="v_tah"  style="height:40px ; width:120px ; direction:rtl" tabindex="4">
                     <option value="0">مهم نیست</option>
                     <option value="1" <?php if ($v_tah=='1') echo 'selected=selected'?>>مجرد</option>
                     <option value="2" <?php if ($v_tah=='2') echo 'selected=selected'?>>متاهل</option>
                   </select>
                 </div></td>
                 <td height="44" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="style8">: وضعیت تاهل</font></td>
                 <td height="44" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="g_tah"  class="input_text mar required" id="g_tah"  style="height:40px ; width:200px ; direction:rtl" tabindex="8">
                     <option value="0">مهم نیست</option>
                     <option value="1"  <?php if ($g_tah=='1') echo 'selected=selected'?>>امور دام </option>
                     <option value="2"  <?php if ($g_tah=='2') echo 'selected=selected'?>>دامپزشکی</option>
                     <option value="3"  <?php if ($g_tah=='3') echo 'selected=selected'?>>زراعت و باغبانی</option>
                     <option value="4"  <?php if ($g_tah=='4') echo 'selected=selected'?>>شیلات و آبزیان</option>
                     <option value="5"  <?php if ($g_tah=='5') echo 'selected=selected'?>>منابع طبیعی و آبخیزداری</option>
                     <option value="6"  <?php if ($g_tah=='6') echo 'selected=selected'?>>آب و خاک</option>
                     <option value="7"  <?php if ($g_tah=='7') echo 'selected=selected'?>>مکانیزاسیون کشاورزی</option>
                     <option value="8"  <?php if ($g_tah=='8') echo 'selected=selected'?>>صنایع تبدیلی و تکمیلی</option>
                     <option value="9"  <?php if ($g_tah=='9') echo 'selected=selected'?>>ترویج و آموزش کشاورزی</option>
                     <option value="10" <?php if ($g_tah=='10') echo 'selected=selected'?>>غیر کشاورزی</option>
                     <option value="11" <?php if ($g_tah=='11') echo 'selected=selected'?>>اعلام نشده</option>
                     <option value="12" <?php if ($g_tah=='12') echo 'selected=selected'?>>فاقد مدرک دانشگاهی</option>
                   </select>
                 </div></td>
                 <td height="44"  align='center' bgcolor="#FFFFFF" class="style1"><table width="100%" cellspacing="0" cellpadding="0" border="0">
                   <tbody>
                     <tr>
                       <td><font size="2" class="style8">:گرایش تحصیلی	</font></td>
                     </tr>
                   </tbody>
                 </table></td>
               </tr>
               <tr >
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="z_fa2"  class="input_text mar required" id="z_fa2"  style="height:40px ; width:200px ; direction:rtl" tabindex="10">
                     <option value="0">مهم نیست</option>
                     <option value="1" <?php if ($z_fa2=='1') echo 'selected=selected'?>>زراعت</option>
                     <option value="2" <?php if ($z_fa2=='2') echo 'selected=selected'?>>باغبانی</option>
                     <option value="3" <?php if ($z_fa2=='3') echo 'selected=selected'?>>پرورش دام سبک و سنگین</option>
                     <option value="4" <?php if ($z_fa2=='4') echo 'selected=selected'?>>پرورش طیور</option>
                     <option value="5" <?php if ($z_fa2=='5') echo 'selected=selected'?>>پرورش زنبورعسل</option>
                     <option value="6" <?php if ($z_fa2=='6') echo 'selected=selected'?>>نوغانداری</option>
                     <option value="7" <?php if ($z_fa2=='7') echo 'selected=selected'?>>شیلات و آبزیان</option>
                     <option value="8" <?php if ($z_fa2=='8') echo 'selected=selected'?>>صید و صیادی</option>
                     <option value="9" <?php if ($z_fa2=='9') echo 'selected=selected'?>>جنگل و مرتع</option>
                     <option value="10" <?php if ($z_fa2=='10') echo 'selected=selected'?>>آبخیزداری</option>
                     <option value="11" <?php if ($z_fa2=='11') echo 'selected=selected'?>>صنایع تبدیلی</option>
                     <option value="12" <?php if ($z_fa2=='12') echo 'selected=selected'?>>صنایع و مشاغل خانگی</option>
                     <option value="13" <?php if ($z_fa2=='13') echo 'selected=selected'?>>خدمات اجتماعی</option>
                   </select>
                 </div></td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="style1" ><table width="100%" cellspacing="0" cellpadding="0" border="0">
                   <tbody>
                     <tr>
                       <td><font size="2" class="style8">:زمینه فعالیت2 </font></td>
                     </tr>
                   </tbody>
                 </table></td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="z_fa1"  class="input_text mar required" id="z_fa1"  style="height:40px ; width:200px ; direction:rtl" tabindex="9">
                     <option value="0">مهم نیست</option>
                     <option value="1" <?php if ($z_fa1=='1') echo 'selected=selected'?>>زراعت</option>
                     <option value="2" <?php if ($z_fa1=='2') echo 'selected=selected'?>>باغبانی</option>
                     <option value="3" <?php if ($z_fa1=='3') echo 'selected=selected'?>>پرورش دام سبک و سنگین</option>
                     <option value="4" <?php if ($z_fa1=='4') echo 'selected=selected'?>>پرورش طیور</option>
                     <option value="5" <?php if ($z_fa1=='5') echo 'selected=selected'?>>پرورش زنبورعسل</option>
                     <option value="6" <?php if ($z_fa1=='6') echo 'selected=selected'?>>نوغانداری</option>
                     <option value="7" <?php if ($z_fa1=='7') echo 'selected=selected'?>>شیلات و آبزیان</option>
                     <option value="8" <?php if ($z_fa1=='8') echo 'selected=selected'?>>صید و صیادی</option>
                     <option value="9" <?php if ($z_fa1=='9') echo 'selected=selected'?>>جنگل و مرتع</option>
                     <option value="10" <?php if ($z_fa1=='10') echo 'selected=selected'?>>آبخیزداری</option>
                     <option value="11" <?php if ($z_fa1=='11') echo 'selected=selected'?>>صنایع تبدیلی</option>
                     <option value="12" <?php if ($z_fa1=='12') echo 'selected=selected'?>>صنایع و مشاغل خانگی</option>
                     <option value="13" <?php if ($z_fa1=='13') echo 'selected=selected'?>>خدمات اجتماعی</option>
                   </select>
                 </div></td>
                 <td height="46"  align='center' bgcolor="#DDDDDD" class="style1"><table width="100%" cellspacing="0" cellpadding="0" border="0">
                   <tbody>
                     <tr>
                       <td><font size="2" class="style8">:زمینه فعالیت1 </font></td>
                     </tr>
                   </tbody>
                 </table></td>
               </tr>
               <tr >
                 <td height="44" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="oz_ta" class="required input_text  " id="oz_ta"  style="height:40px ; width:120px ; direction:rtl" tabindex="13">
                     <option value="0">مهم نیست</option>
                     <option value="1" <?php if ($oz_ta =='1') echo 'selected=selected'?>>بلی</option>
                     <option value="2" <?php if ($oz_ta =='2') echo 'selected=selected'?>>خیر</option>
                   </select>
                 </div></td>
                 <td height="44" align="right" bgcolor="#FFFFFF" class="style1" ><table width="100%" cellspacing="0" cellpadding="0" border="0">
                   <tbody>
                     <tr>
                       <td><font size="2" class="style8">:عضو تعاونی /تشکل </font></td>
                     </tr>
                   </tbody>
                 </table></td>
                 <td height="44" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="no_oz" class="required input_text  " id="no_oz"  style="height:40px ; width:120px ; direction:rtl" tabindex="12">
                     <option value="0">مهم نیست</option>
                     <option value="1"<?php if ($no_oz =='1') echo 'selected=selected'?>>فعال</option>
                     <option value="2"<?php if ($no_oz =='2') echo 'selected=selected'?>>غیرفعال</option>
                   </select>
                 </div></td>
                 <td height="44"  align='center' bgcolor="#FFFFFF" class="style1"><table width="100%" cellspacing="0" cellpadding="0" border="0">
                   <tbody>
                     <tr>
                       <td><font size="2" class="style8">:نوع عضویت</font></td>
                     </tr>
                   </tbody>
                 </table></td>
               </tr>
               <tr >
                 <td height="43" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
                 <td height="43" align="right" bgcolor="#DDDDDD" class="style1" >&nbsp;</td>
                 <td height="43" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="cod_m" type="text" class="input_text" id="cod_m"  style="height:35px ; width:170px " value="<?php echo $cod_m?>" />
                 </div></td>
                 <td height="43" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="style8">: کد ملی </font></td>
                 </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' />
                 </td>
                 </tr>
             </table> 
           </div>
 </form>
             <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['action'])) 
 {  
 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($cod_m == '')  { $v_cod_m  = 1 ; }else{ $v_cod_m = "cod_m = '$cod_m'" ;}
 if ($sal_z == '')  { $v_sal_z  = 1  ; }else{ $v_sal_z = "sal_z = '$sal_z'" ;}
 if ($jens == '0')  { $v_jens  = 1  ; }else{ $v_jens = "jens = '$jens'" ;}
 if ($v_tah == '0')  { $v_v_tah  = 1  ; }else{ $v_tah = "v_tah = '$v_tah'" ;}
 if ($g_tah == '0')  { $v_g_tah  = 1  ; }else{ $v_g_tah = "g_tah = '$g_tah'" ;}
 if ($z_fa1 == '0')  { $v_z_fa1  = 1  ; }else{ $v_z_fa1 = "z_fa1 = '$z_fa1'" ;}
 if ($z_fa2 == '0')  { $v_z_fa2  = 1  ; }else{ $v_z_fa2 = "z_fa2 = '$z_fa2'" ;}
 if ($no_oz == '0')  { $v_no_oz  = 1  ; }else{ $v_no_oz = "no_oz = '$no_oz'" ;}
 if ($oz_ta == '0')  { $v_oz_ta  = 1  ; }else{ $v_oz_ta = "oz_ta = '$oz_ta'" ;}
 include_once('../../../login/config.php');
$start=0;
$limit=50;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $query = "SELECT * from Eworker where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $v_cod_m and  $v_sal_z  and $v_jens and $v_v_tah and $v_g_tah and $v_z_fa1 and $v_z_fa2 and $v_no_oz and $v_oz_ta ORDER BY cod_m ASC LIMIT $start, $limit "; 

 $query1 = "SELECT id from Eworker where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $v_cod_m and  $v_sal_z  and $v_jens and $v_v_tah and $v_g_tah and $v_z_fa1 and $v_z_fa2 and $v_no_oz and $v_oz_ta ORDER BY cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
             <img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form  action="Eworker_rep_xls.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                   <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                   <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                   <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="cod_m" value="<?php echo $cod_m ;?>" />
                   <input type="hidden" name="sal_z" value="<?php echo $sal_z ;?>" />
                   <input type="hidden" name="jens" value="<?php echo $jens ;?>" />
                   <input type="hidden" name="v_tah" value="<?php echo $v_tah ;?>" />
                   <input type="hidden" name="g_tah" value="<?php echo $g_tah ;?>" />
                   <input type="hidden" name="z_fa1" value="<?php echo $z_fa1 ;?>" />
                   <input type="hidden" name="z_fa2" value="<?php echo $z_fa2 ;?>" />
                   <input type="hidden" name="no_oz" value="<?php echo $no_oz ;?>" />
                   <input type="hidden" name="oz_ta" value="<?php echo $oz_ta ;?>" />
                   <button><img src="../../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
            <br />
<table width="95%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td width="7%" rowspan="2" bordercolor="#0099CC" bgcolor="#006699">مشاهده</td>
          <td width="6%" rowspan="2" bordercolor="#0099CC" bgcolor="#006699">نوع عضویت</td>
          <td width="8%" rowspan="2" bordercolor="#0099CC" bgcolor="#006699">گرایش تحصیلی</td>
          <td width="6%" rowspan="2" bordercolor="#0099CC" bgcolor="#006699">رشته تحصیلی</td>
          <td width="6%" rowspan="2" bordercolor="#0099CC" bgcolor="#006699">سال جذب</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات مددکار</td>
          <td colspan="4" bordercolor="#0099CC" bgcolor="#006699">موقعیت مددکار</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="7%" height="36" bgcolor="#006699" class="style8"><img src="../../../files/sort.png" width="15" height="24"  alt=""/><span class="text1"> کد ملی</span></td>
          <td width="15%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="9%" bordercolor="#0099CC" bgcolor="#006699">شهر / آبادی</td>
          <td width="11%" bordercolor="#0099CC" bgcolor="#006699">مرکز جهاد کشاورزی</td>
          <td width="10%" bordercolor="#0099CC" bgcolor="#006699">شهرستان</td>
          <td width="10%" bordercolor="#0099CC" bgcolor="#006699">استان</td>
          </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['g_tah']=='1') $f_g_tah='امور دام ' ;	 
if ($row['g_tah']=='2') $f_g_tah='دامپزشکی' ;	 
if ($row['g_tah']=='3') $f_g_tah='زراعت و باغبانی' ;	 
if ($row['g_tah']=='4') $f_g_tah='شیلات و آبزیان' ;	 
if ($row['g_tah']=='5') $f_g_tah='منابع طبیعی و آبخیزداری' ;	 
if ($row['g_tah']=='6') $f_g_tah='آب و خاک' ;	 
if ($row['g_tah']=='7') $f_g_tah='مکانیزاسیون کشاورزی' ;	 
if ($row['g_tah']=='8') $f_g_tah='صنایع تبدیلی و تکمیلی' ;	 
if ($row['g_tah']=='9') $f_g_tah='ترویج و آموزش کشاورزی' ;	 
if ($row['g_tah']=='10') $f_g_tah='غیر کشاورزی' ;	 
if ($row['g_tah']=='11') $f_g_tah='اعلام نشده' ;	 
if ($row['g_tah']=='12') $f_g_tah='فاقد مدرک دانشگاهی' ;	 
if ($row['no_oz']=='1') $f_no_oz='فعال' ;	 
if ($row['no_oz']=='2') $f_no_oz='غیرفعال' ;	 

  ?>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>  
             <form  action="Eworker_view.php" method="post" onsubmit="target_po3(this)">
              <input type="hidden" name="m_page" value="liste_Eworker.php" />
              <input type="hidden" name="cod_m" value="<?php echo $row['cod_m']  ;?>" />
              <input type="hidden" name="h_add_abadi" value="<?php echo $add_abadi  ;?>" />
              <input type="hidden" name="h_g_tah" value="<?php echo $g_tah  ;?>" />
              <input type="hidden" name="h_sal_z" value="<?php echo $sal_z  ;?>" />
              <input type="hidden" name="h_no_oz" value="<?php echo $no_oz  ;?>" />
            <button><img src="../../../files/view.png" title="نمایش اطلاعات مددکار ترویجی"  width="33" height="26"  alt=""/></button>
          </form>
</td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $f_no_oz; ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $f_g_tah; ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['r_tah']; ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal_z']; ?></td>
          <td height="45" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_m'] ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['cod_m'])?></div></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ,shahr_name($row['add_city']) ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar'])?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
   <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
?>
<div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
<?php   
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="Eworker_rep.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="cod_m" value="<?php echo $cod_m ;?>" />
        <input type="hidden" name="sal_z" value="<?php echo $sal_z ;?>" />
        <input type="hidden" name="jens" value="<?php echo $jens ;?>" />
        <input type="hidden" name="v_tah" value="<?php echo $v_tah ;?>" />
        <input type="hidden" name="g_tah" value="<?php echo $g_tah ;?>" />
        <input type="hidden" name="z_fa1" value="<?php echo $z_fa1 ;?>" />
        <input type="hidden" name="z_fa2" value="<?php echo $z_fa2 ;?>" />
        <input type="hidden" name="no_oz" value="<?php echo $no_oz ;?>" />
        <input type="hidden" name="oz_ta" value="<?php echo $oz_ta ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="Eworker_rep.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="cod_m" value="<?php echo $cod_m ;?>" />
        <input type="hidden" name="sal_z" value="<?php echo $sal_z ;?>" />
        <input type="hidden" name="jens" value="<?php echo $jens ;?>" />
        <input type="hidden" name="v_tah" value="<?php echo $v_tah ;?>" />
        <input type="hidden" name="g_tah" value="<?php echo $g_tah ;?>" />
        <input type="hidden" name="z_fa1" value="<?php echo $z_fa1 ;?>" />
        <input type="hidden" name="z_fa2" value="<?php echo $z_fa2 ;?>" />
        <input type="hidden" name="no_oz" value="<?php echo $no_oz ;?>" />
        <input type="hidden" name="oz_ta" value="<?php echo $oz_ta ;?>" />
        <button class='button' >بعدی</button>
      </form>
    <?php 
}

echo "<ul class='page'>";

		for($i=1;$i<=$total;$i++)
		{
			if($i==$id) { echo "<li class='current'>".$i."</li>"; }
			else { 
			?>
      <li class='current'><form  action="Eworker_rep.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="cod_m" value="<?php echo $cod_m ;?>" />
        <input type="hidden" name="sal_z" value="<?php echo $sal_z ;?>" />
        <input type="hidden" name="jens" value="<?php echo $jens ;?>" />
        <input type="hidden" name="v_tah" value="<?php echo $v_tah ;?>" />
        <input type="hidden" name="g_tah" value="<?php echo $g_tah ;?>" />
        <input type="hidden" name="z_fa1" value="<?php echo $z_fa1 ;?>" />
        <input type="hidden" name="z_fa2" value="<?php echo $z_fa2 ;?>" />
        <input type="hidden" name="no_oz" value="<?php echo $no_oz ;?>" />
        <input type="hidden" name="oz_ta" value="<?php echo $oz_ta ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
          <p><a href="../index.php" title="برگشت به صفحه قبل"><img src="../../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>


