<?php 
include('../../lock_p1.php');
include('../../event.php');
 $id_ostan1 = $id_ostan ;
 $id_city = $id_city ;
 $id_mar    = $id_mar ; 
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city  = isset($_POST['add_city'])  ? $_POST['add_city']  : '';
$no_kesh   = isset($_POST['no_kesh'])   ? $_POST['no_kesh']   : '';
$m_ab      = isset($_POST['m_ab'])      ? $_POST['m_ab']      : '';
$no_ab     = isset($_POST['no_ab'])     ? $_POST['no_ab']     : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal     = isset($_POST['z_sal'])     ? $_POST['z_sal']     : '';
$zka1      = isset($_POST['zka1'])      ? $_POST['zka1']      : '';
$zka2      = isset($_POST['zka2'])      ? $_POST['zka2']      : '';
$zkb1      = isset($_POST['zkb1'])      ? $_POST['zkb1']      : '';
$zkb2      = isset($_POST['zkb2'])      ? $_POST['zkb2']      : '';
$sba1      = isset($_POST['sba1'])      ? $_POST['sba1']      : '';
$sba2      = isset($_POST['sba2'])      ? $_POST['sba2']      : '';
$sbb1      = isset($_POST['sbb1'])      ? $_POST['sbb1']      : '';
$sbb2      = isset($_POST['sbb2'])      ? $_POST['sbb2']      : '';
$mtol1     = isset($_POST['mtol1'])     ? $_POST['mtol1']     : '';
$mtol2     = isset($_POST['mtol2'])     ? $_POST['mtol2']     : '';
$mtolp1    = isset($_POST['mtolp1'])    ? $_POST['mtolp1']    : '';
$mtolp2    = isset($_POST['mtolp2'])    ? $_POST['mtolp2']    : '';
 $Agri_table     = 'Agri'.str_replace('-','_',$z_sal) ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
// کد گروه و کد محصول - تصحیح خطای Undefined index
 $mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
 $mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
// تعریف متغیر num_t_mah برای جلوگیری از خطای Undefined variable
$num_t_mah = isset($num_t_mah) ? $num_t_mah : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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

<script type="text/javascript">
$(document).ready(function()
{
$(".country<?php echo htmlspecialchars($num_t_mah) ;?>").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_city.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar").html(html);
} 
});
});
});
</script>

<script type="text/javascript">
$(document).ready(function()
{
$(".country").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_city.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar<?php echo htmlspecialchars($num_t_mah) ;?>").html(html);
} 
});
});
});
</script>
  <script>
function target_popup(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=250,height=479"); 
    form.target = 'formpopup';
}
    function target_Agri17(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=750,height=600"); 
    form.target = 'formpopup'; 
	}
   </script>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
      <?php include('top.php');?>
      <span class="style8">گزارش اختصاصی اطلاعات زراعی </span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="741" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td width="204" height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                       <?php
                    $query = "SELECT z_sal FROM `z_sal`  ORDER BY z_sal DESC "  ;
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                   <option value="<?php echo $row['z_sal'] ;?>"
                   <?php if ($row['z_sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['z_sal'] ;?></option>
                   <?php }?>
                   </select>
                   </div></td>
                 <td width="134"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: سال زراعی</td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="-1">انتخاب استان</option>
                     <?php
$query = "SELECT  id_ostan,ostan FROM `ostanname`  ORDER BY BINARY ostan ASC "  ;
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
                 <td  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="55" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="no_kesh" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl">
                     <option value="0">انتخاب کنید</option>
                     <option value="1" <?php if($no_kesh=="1") echo "selected='selected'"?>>آبی</option>
                     <option value="2" <?php if($no_kesh=="2") echo "selected='selected'"?>>دیم</option>
                   </select>
                 </div></td>
                 <td height="55" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: نوع کشت</font></td>
                 <td align="right" bgcolor="#FFFFFF" class="input_text" >
                 <select  name="id_city" disabled="disabled" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                   <option value="0"> کل استان</option>
                   <?php
 $query = "SELECT  id_city,city FROM `cityname` WHERE  `id_ostan` = '$id_ostan1' ORDER BY BINARY city ASC "  ;
 $stmt = $dbh->prepare($query);
 $stmt->execute();
 foreach($stmt as $row){
?>
                   <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
                   <?php }?>
                   </select>
                   <?php 
				   if (isset($_POST['id_city']))
  $id_city = $_POST['id_city'] ; 
?></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall"> :شهرستان</font></td>
                 </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="" >انتخاب نام آبادی</option>
                   <?php
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session' ORDER BY BINARY abadi "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                   <?php }?>
                 </select></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall"> : نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="id_mar" disabled="disabled" class="input_text" id="id_mar" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
                   <option value="0"> نام مرکز</option>
                   <?php
$query = "SELECT  id_mar,mar FROM `mar` WHERE  `id_ostan` = $id_ostan1 and `id_city` = $id_city"  ;
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
                   <input name="id_city2" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td rowspan="2"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="" >انتخاب نام شهر</option>
                   <?php
$query = "SELECT  add_city,shahr FROM `list_city` WHERE `mor_cod_m` = '$login_session' ORDER BY BINARY shahr "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                   <?php }?>
                 </select></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">:نام شهر</td>
               </tr>
               <tr >
                 <td height="54" align="right" class="input_text" ><div align="right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                   </div></td>
                 <td height="54" align="right" class="style1" ><font size="2" class="normalTextSmall">: کد ملی بهره بردار</font></td>
                 <td height="54" align="right" class="input_text" ><div align="right">
                   <input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m"  style="height:35px ; width:170px " value="<?php echo $login_session ?>" />
                   </div></td>
                 <td height="54"  align='center' class="style1"><font size="2" class="normalTextSmall">: کد ملی مروج</font></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="52" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="no_ab" class="input_text  required" id="no_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="18">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($no_ab=='1') { echo 'selected="selected"' ; }?>>جوی و پشته</option>
                     <option value="2" <?php if ($no_ab=='2') { echo 'selected="selected"' ; }?>>نواری</option>
                     <option value="3" <?php if ($no_ab=='3') { echo 'selected="selected"' ; }?>>غرقابی</option>
                     <option value="4" <?php if ($no_ab=='4') { echo 'selected="selected"' ; }?>>تشتکی</option>
                     <option value="5" <?php if ($no_ab=='5') { echo 'selected="selected"' ; }?>>تحت فشار قطره ای</option>
                     <option value="6" <?php if ($no_ab=='6') { echo 'selected="selected"' ; }?>>تحت فشار بارانی</option>
                     <option value="7" <?php if ($no_ab=='7') { echo 'selected="selected"' ; }?>>سایر</option>
                   </select>
                 </div></td>
                 <td height="52" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">:نحوه آبیاری</font></td>
                 <td width="196" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="m_ab" class="input_text required " id="m_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="14">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($m_ab=='1') { echo 'selected="selected"' ; } ?> >چشمه</option>
                     <option value="2" <?php if ($m_ab=='2') { echo 'selected="selected"' ; } ?>>قنات</option>
                     <option value="3" <?php if ($m_ab=='3') { echo 'selected="selected"' ; } ?>>رودخانه</option>
                     <option value="4" <?php if ($m_ab=='4') { echo 'selected="selected"' ; } ?>>سد</option>
                     <option value="5" <?php if ($m_ab=='5') { echo 'selected="selected"' ; } ?>>چاه سطحی</option>
                     <option value="6"  <?php if ($m_ab=='6') { echo 'selected="selected"' ; } ?>>چاه عمیق</option>
                     <option value="7"  <?php if ($m_ab=='7') { echo 'selected="selected"' ; } ?>>چاه نیمه عمیق</option>
                     <option value="8"  <?php if ($m_ab=='8') { echo 'selected="selected"' ; } ?>>زهکش</option>
                     <option value="9"  <?php if ($m_ab=='9') { echo 'selected="selected"' ; } ?>>پساب</option>
                     <option value="10" <?php if ($m_ab=='10') { echo 'selected="selected"' ; } ?>>آب بندان</option>
                     <option value="11" <?php if ($m_ab=='11') { echo 'selected="selected"' ; } ?>>سایر</option>
                   </select>
                 </div></td>
                 <td width="166"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">: منبع آب</font></td>
               </tr>
               <tr >
                 <td height="44" align="right" class="input_text" ><div align="right">
                   <select  name="mah_name" class="required input_text mar" id="mah_name" style="width:170px ; height:40px" tabindex="23" dir="rtl">
                     <?php
 $query = "SELECT DISTINCT product_cod,product_name FROM `product_z` WHERE  `group_cod` = '$mah_qroup' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['product_cod'] ;?>"
   <?php if ($row['product_cod']==$mah_name) echo 'selected=selected'?>> <?php echo $row['product_name'] ;?></option>
                     <?php
}
?>
                     </select>
                   </div></td>
                 <td height="44"  align='center' class="normalTextSmall">: نام محصول</td>
                 <td height="44" align="right" class="input_text" ><div align="right">
                   <select  name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px ; height:40px" tabindex="22" dir="rtl"  >
                     <option value="" > انتخاب گروه</option>
                     <?php
$query = "SELECT DISTINCT group_cod,group_name FROM `product_z` "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                     <?php }?>
                    </select></td>
                 <td  align='center' class="style1"><font size="2" class="normalTextSmall">:گروه محصولات</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="zka2" type="text" class="input_text" id="zka2"  style="height:35px ; width:70px " value="<?php echo $zka2?>" />
                   </div></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="zka1" type="text" class="input_text" id="zka1"  style="height:35px ; width:70px " value="<?php echo $zka1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">سطح زیر کشت اول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="zkb2" type="text" class="input_text" id="zkb2"  style="height:35px ; width:70px " value="<?php echo $zkb2?>" />
                   </div></td>
                 <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="zkb1" type="text" class="input_text" id="zkb1"  style="height:35px ; width:70px " value="<?php echo $zkb1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">سطح زیر کشت دوم<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="sba2" type="text" class="input_text" id="sba2"  style="height:35px ; width:70px " value="<?php echo $sba2?>" />
                 </div></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="sba1" type="text" class="input_text" id="zka4"  style="height:35px ; width:70px " value="<?php echo $sba1?>" />
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">سطح  برداشت اول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="sbb2" type="text" class="input_text" id="sbb2"  style="height:35px ; width:70px " value="<?php echo $sbb2?>" />
                   </div></td>
                 <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="sbb1" type="text" class="input_text" id="zkb4"  style="height:35px ; width:70px " value="<?php echo $sbb1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">سطح  برداشت دوم<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtolp2" type="text" class="input_text" id="mtolp2"  style="height:35px ; width:70px " value="<?php echo $mtolp2?>" />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtolp1" type="text" class="input_text" id="mtol4"  style="height:35px ; width:70px " value="<?php echo $mtolp1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">میزان پیش بینی محصول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <span class="style2">تن </span>
                   <input name="mtol2" type="text" class="input_text" id="mtol2"  style="height:35px ; width:70px " value="<?php echo $mtol2?>" />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <span class="style2">تن </span>
                   <input name="mtol1" type="text" class="input_text" id="mtol1"  style="height:35px ; width:70px " value="<?php echo $mtol1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">میزان تولید محصول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='اجرای کوئری' />
                   </td>
               </tr>
             </table> 
           </div>
 </form>
             <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 // مقداردهی اولیه متغیرها برای جلوگیری از خطاهای undefined
$query1 = '';
$limit = 25;
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$start = 0;
 
 if (isset($_POST['action'])) 
 {  
 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "`$Agri_prod_table`.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "`$Agri_prod_table`.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "`$Agri_prod_table`.id_mar='$id_mar'" ;}
 if ($add_abadi  == '')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "`$Agri_prod_table`.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '')  { $f_add_city  = 1  ; }else{ $f_add_city = "`$Agri_prod_table`.add_city = '$add_city'" ;}
 if ($no_kesh == '0')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "`$Agri_prod_table`.no_kesh = '$no_kesh'" ;}
 if ($m_ab == '')  { $f_m_ab  = 1  ; }else{ $f_m_ab = "`$Agri_table`.m_ab = '$m_ab'" ;}
 if ($no_ab == '')  { $f_no_ab  = 1  ; }else{ $f_no_ab = "`$Agri_table`.no_ab = '$no_ab'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "`$Agri_prod_table`.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "`$Agri_prod_table`.bah_cod_m = '$bah_cod_m'" ;}
 if ($mah_name == '')  { $v_cod_mah  = 1  ; }else{ $v_cod_mah = "`$Agri_prod_table`.cod_mah = '$mah_name'" ;}
 if ($zka1 == '')  { $v_zka1  = 1  ; }else{ $v_zka1 = "`$Agri_prod_table`.zer_kesht_a >= $zka1" ;}
 if ($zka2 == '')  { $v_zka2  = 1  ; }else{ $v_zka2 = "`$Agri_prod_table`.zer_kesht_a <= $zka2" ;}
 if ($zkb1 == '')  { $v_zkb1  = 1  ; }else{ $v_zkb1 = "`$Agri_prod_table`.zer_kesht_b >= $zkb1" ;}
 if ($zkb2 == '')  { $v_zkb2  = 1  ; }else{ $v_zkb2 = "`$Agri_prod_table`.zer_kesht_b <= $zkb2" ;}
 if ($sba1 == '')  { $v_sba1  = 1  ; }else{ $v_sba1 = "`$Agri_prod_table`.s_bar_a >= $sba1" ;}
 if ($sba2 == '')  { $v_sba2  = 1  ; }else{ $v_sba2 = "`$Agri_prod_table`.s_bar_a <= $sba2" ;}
 if ($sbb1 == '')  { $v_sbb1  = 1  ; }else{ $v_sbb1 = "`$Agri_prod_table`.s_bar_b >= $sbb1" ;}
 if ($sbb2 == '')  { $v_sbb2  = 1  ; }else{ $v_sbb2 = "`$Agri_prod_table`.s_bar_b <= $sbb2" ;}
 if ($mtol1 == '')  { $v_mtol1  = 1  ; }else{ $v_mtol1 = "`$Agri_prod_table`.mah_tol >= $mtol1" ;}
 if ($mtol2 == '')  { $v_mtol2  = 1  ; }else{ $v_mtol2 = "`$Agri_prod_table`.mah_tol <= $mtol2" ;}
 if ($mtolp1 == '')  { $v_mtolp1  = 1  ; }else{ $v_mtolp1 = "`$Agri_prod_table`.mah_tolp >= $mtolp1" ;}
 if ($mtolp2 == '')  { $v_mtolp2  = 1  ; }else{ $v_mtolp2 = "`$Agri_prod_table`.mah_tolp <= $mtolp2" ;}
 include('../../login/config.php');
$start=0;
$limit=25;
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$start=($id-1)*$limit;
  $query = "SELECT `$Agri_prod_table`.*,`$Agri_table`.m_ab, `$Agri_table`.no_ab
  from `$Agri_prod_table` 
  INNER JOIN `$Agri_table` ON `$Agri_table`.id = `$Agri_prod_table`.Agri_id
  where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh and $f_m_ab and $f_no_ab and $v_mor_cod_m and $v_bah_cod_m  and  $v_cod_mah and $v_sba1 and $v_sba2 and $v_sbb1 and $v_sbb2 and $v_zka1 and $v_zka2 and $v_zkb1 and $v_zkb2 and $v_mtolp1 and $v_mtolp2 and $v_mtol1 and $v_mtol2 ORDER BY bah_cod_m ASC LIMIT $start, $limit "; 
 $query1 = "SELECT count(*)
  from `$Agri_prod_table` 
  INNER JOIN `$Agri_table` ON `$Agri_table`.id = `$Agri_prod_table`.Agri_id
  where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh and $f_m_ab and $f_no_ab and $v_mor_cod_m and $v_bah_cod_m  and  $v_cod_mah and $v_sba1 and $v_sba2 and $v_sbb1 and $v_sbb2 and $v_zka1 and $v_zka2 and $v_zkb1 and $v_zkb2 and $v_mtolp1 and $v_mtolp2 and $v_mtol1 and $v_mtol2"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td width="56"><form  action="Agri_rep170_xls.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh"   value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="m_ab"       value="<?php echo  $m_ab ;?>" />
                   <input type="hidden" name="no_ab"      value="<?php echo  $no_ab ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="zka1"  value="<?php echo $zka1 ;?>" />
                   <input type="hidden" name="zka2"  value="<?php echo $zka2 ;?>" />
                   <input type="hidden" name="zkb1"  value="<?php echo $zkb1 ;?>" />
                   <input type="hidden" name="zkb2"  value="<?php echo $zkb2 ;?>" />
                   <input type="hidden" name="sba1"  value="<?php echo $sba1 ;?>" />
                   <input type="hidden" name="sba2"  value="<?php echo $sba2 ;?>" />
                   <input type="hidden" name="sbb1"  value="<?php echo $sbb1 ;?>" />
                   <input type="hidden" name="sbb2"  value="<?php echo $sbb2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                 <td width="56"><form  action="Agri_rep170_doc.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh"   value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="zka1"  value="<?php echo $zka1 ;?>" />
                   <input type="hidden" name="zka2"  value="<?php echo $zka2 ;?>" />
                   <input type="hidden" name="zkb1"  value="<?php echo $zkb1 ;?>" />
                   <input type="hidden" name="zkb2"  value="<?php echo $zkb2 ;?>" />
                   <input type="hidden" name="sba1"  value="<?php echo $sba1 ;?>" />
                   <input type="hidden" name="sba2"  value="<?php echo $sba2 ;?>" />
                   <input type="hidden" name="sbb1"  value="<?php echo $sbb1 ;?>" />
                   <input type="hidden" name="sbb2"  value="<?php echo $sbb2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
                 </form></td>

               </tr>
             </table>
             <span class="style8">فقط قطعات دارای محصول در محاسبه شرکت داده شده / قطعات دارای تنوع محصول 0 یا به عبارت دیگر قطعه ی که کلاً آیش ثبت شده محاسبه نگردیده</span><img src="../../files/con_info.png" title="دانلود نتایج با فرمت فایل ورد"  width="16" height="16"  alt=""/><br />
            <table align="center" class="my-table" >
              <tr class="text1">
                <td rowspan="3" bgcolor="#006699">عملیات</td>
                <td width="7%" rowspan="3" bgcolor="#006699">نام محصول</td>
          <td colspan="2" bgcolor="#006699">میزان محصول / تن</td>
          <td colspan="6" bgcolor="#006699">مساحت/هکتار</td>
          <td  colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="4%" rowspan="3" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="6%" rowspan="2" bgcolor="#006699">قطعی</td>
          <td width="7%" rowspan="2" bgcolor="#006699">پیش بینی</td>
          <td colspan="3" bgcolor="#006699">سطح برداشت</td>
          <td  colspan="3" bgcolor="#006699">سطح زیر کشت</td>
          <td width="11%"  rowspan="2" bgcolor="#006699" class="style8"><img src="../../files/sort.png" width="15" height="24"  alt=""/><span class="text1"> کد ملی</span></td>
          <td width="17%" rowspan="2" bgcolor="#006699">نام و نام خانوادگی</td>
          </tr>
        <tr class="text1">
          <td width="7%" bgcolor="#006699">کل</td>
          <td width="5%" bgcolor="#006699">دوم</td>
          <td width="6%" bgcolor="#006699">اول </td>
          <td width="6%"  bgcolor="#006699">کل</td>
          <td width="6%" bgcolor="#006699">دوم</td>
          <td width="6%" bgcolor="#006699">اول </td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
  ?>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Agridata_view1.php" method="post" onsubmit="target_Agri17(this)">
              <input type="hidden" name="id"  value="<?php echo $row['Agri_id'] ;?>" />
              <input type="hidden" name="z_sal"  value="<?php echo $row['z_sal'] ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
            </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],3)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],3)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']+$row['s_bar_b'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_b']+0 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']+0 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a'] + $row['zer_kesht_b'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_b']+0  ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a']+0 ; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
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
<?php   
// بررسی وجود query1 قبل از اجرا
if (!empty($query1)) {
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1->fetchColumn();
$total = ceil($rows/$limit);

// تعیین محدوده صفحات برای نمایش
$visible_pages = 3;
$start_page = max(1, $id - $visible_pages);
$end_page = min($total, $id + $visible_pages);

$show_first = ($start_page > 1);
$show_last = ($end_page < $total);
?>

<div dir="rtl" class="pagination-container" style="margin-top:20px; text-align:center; height:auto; margin:auto; width:98%; overflow:auto; background-color:#ffffff; color:#06C; font-size:11px; padding:10px; border-radius:15px">
    <ul class="pagination" style="list-style-type:none; padding:0; margin:0; display:flex; justify-content:center; align-items:center; flex-wrap:wrap;">
        <?php if($id > 1): ?>
            <li class="page-item" style="display:inline-block; margin:2px;">
                <form action="Agri_rep170.php?id=<?php echo $id-1 ?>#1" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                    <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
                    <input type="hidden" name="no_ab" value="<?php echo $no_ab ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                    <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                    <input type="hidden" name="zka1" value="<?php echo $zka1 ;?>" />
                    <input type="hidden" name="zka2" value="<?php echo $zka2 ;?>" />
                    <input type="hidden" name="zkb1" value="<?php echo $zkb1 ;?>" />
                    <input type="hidden" name="zkb2" value="<?php echo $zkb2 ;?>" />
                    <input type="hidden" name="sba1" value="<?php echo $sba1 ;?>" />
                    <input type="hidden" name="sba2" value="<?php echo $sba2 ;?>" />
                    <input type="hidden" name="sbb1" value="<?php echo $sbb1 ;?>" />
                    <input type="hidden" name="sbb2" value="<?php echo $sbb2 ;?>" />
                    <input type="hidden" name="mtolp1" value="<?php echo $mtolp1 ;?>" />
                    <input type="hidden" name="mtolp2" value="<?php echo $mtolp2 ;?>" />
                    <input type="hidden" name="mtol1" value="<?php echo $mtol1 ;?>" />
                    <input type="hidden" name="mtol2" value="<?php echo $mtol2 ;?>" />
                    <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">&laquo; قبلی</button>
                </form>
            </li>
        <?php endif; ?>
        
        <?php if($show_first): ?>
            <li class="page-item" style="display:inline-block; margin:2px;">
                <form action="Agri_rep170.php?id=1#1" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                    <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
                    <input type="hidden" name="no_ab" value="<?php echo $no_ab ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                    <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                    <input type="hidden" name="zka1" value="<?php echo $zka1 ;?>" />
                    <input type="hidden" name="zka2" value="<?php echo $zka2 ;?>" />
                    <input type="hidden" name="zkb1" value="<?php echo $zkb1 ;?>" />
                    <input type="hidden" name="zkb2" value="<?php echo $zkb2 ;?>" />
                    <input type="hidden" name="sba1" value="<?php echo $sba1 ;?>" />
                    <input type="hidden" name="sba2" value="<?php echo $sba2 ;?>" />
                    <input type="hidden" name="sbb1" value="<?php echo $sbb1 ;?>" />
                    <input type="hidden" name="sbb2" value="<?php echo $sbb2 ;?>" />
                    <input type="hidden" name="mtolp1" value="<?php echo $mtolp1 ;?>" />
                    <input type="hidden" name="mtolp2" value="<?php echo $mtolp2 ;?>" />
                    <input type="hidden" name="mtol1" value="<?php echo $mtol1 ;?>" />
                    <input type="hidden" name="mtol2" value="<?php echo $mtol2 ;?>" />
                    <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;">1</button>
                </form>
            </li>
            <?php if($start_page > 2): ?>
                <li class="page-item disabled" style="display:inline-block; margin:2px; color:#ccc;">
                    <span style="padding:5px 10px;">...</span>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php for($i = $start_page; $i <= $end_page; $i++): ?>
            <li class="page-item <?php echo ($i == $id) ? 'active' : ''; ?>" style="display:inline-block; margin:2px;">
                <?php if($i == $id): ?>
                    <span class="current-page" style="background:#06C; color:white; padding:5px 10px; border-radius:4px; display:inline-block;"><?php echo $i; ?></span>
                <?php else: ?>
                    <form action="Agri_rep170.php?id=<?php echo $i ?>#1" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                    <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
                    <input type="hidden" name="no_ab" value="<?php echo $no_ab ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                    <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                    <input type="hidden" name="zka1" value="<?php echo $zka1 ;?>" />
                    <input type="hidden" name="zka2" value="<?php echo $zka2 ;?>" />
                    <input type="hidden" name="zkb1" value="<?php echo $zkb1 ;?>" />
                    <input type="hidden" name="zkb2" value="<?php echo $zkb2 ;?>" />
                    <input type="hidden" name="sba1" value="<?php echo $sba1 ;?>" />
                    <input type="hidden" name="sba2" value="<?php echo $sba2 ;?>" />
                    <input type="hidden" name="sbb1" value="<?php echo $sbb1 ;?>" />
                    <input type="hidden" name="sbb2" value="<?php echo $sbb2 ;?>" />
                    <input type="hidden" name="mtolp1" value="<?php echo $mtolp1 ;?>" />
                    <input type="hidden" name="mtolp2" value="<?php echo $mtolp2 ;?>" />
                    <input type="hidden" name="mtol1" value="<?php echo $mtol1 ;?>" />
                    <input type="hidden" name="mtol2" value="<?php echo $mtol2 ;?>" />
                        <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $i; ?></button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endfor; ?>
        
        <?php if($show_last): ?>
            <?php if($end_page < $total - 1): ?>
                <li class="page-item disabled" style="display:inline-block; margin:2px; color:#ccc;">
                    <span style="padding:5px 10px;">...</span>
                </li>
            <?php endif; ?>
            <li class="page-item" style="display:inline-block; margin:2px;">
                <form action="Agri_rep170.php?id=<?php echo $total ?>#1" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                    <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
                    <input type="hidden" name="no_ab" value="<?php echo $no_ab ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                    <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                    <input type="hidden" name="zka1" value="<?php echo $zka1 ;?>" />
                    <input type="hidden" name="zka2" value="<?php echo $zka2 ;?>" />
                    <input type="hidden" name="zkb1" value="<?php echo $zkb1 ;?>" />
                    <input type="hidden" name="zkb2" value="<?php echo $zkb2 ;?>" />
                    <input type="hidden" name="sba1" value="<?php echo $sba1 ;?>" />
                    <input type="hidden" name="sba2" value="<?php echo $sba2 ;?>" />
                    <input type="hidden" name="sbb1" value="<?php echo $sbb1 ;?>" />
                    <input type="hidden" name="sbb2" value="<?php echo $sbb2 ;?>" />
                    <input type="hidden" name="mtolp1" value="<?php echo $mtolp1 ;?>" />
                    <input type="hidden" name="mtolp2" value="<?php echo $mtolp2 ;?>" />
                    <input type="hidden" name="mtol1" value="<?php echo $mtol1 ;?>" />
                    <input type="hidden" name="mtol2" value="<?php echo $mtol2 ;?>" />
                    <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $total; ?></button>
                </form>
            </li>
        <?php endif; ?>
        
        <?php if($id != $total && $total > 0): ?>
            <li class="page-item" style="display:inline-block; margin:2px;">
                <form action="Agri_rep170.php?id=<?php echo $id+1 ?>#1" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                    <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
                    <input type="hidden" name="no_ab" value="<?php echo $no_ab ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                    <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                    <input type="hidden" name="zka1" value="<?php echo $zka1 ;?>" />
                    <input type="hidden" name="zka2" value="<?php echo $zka2 ;?>" />
                    <input type="hidden" name="zkb1" value="<?php echo $zkb1 ;?>" />
                    <input type="hidden" name="zkb2" value="<?php echo $zkb2 ;?>" />
                    <input type="hidden" name="sba1" value="<?php echo $sba1 ;?>" />
                    <input type="hidden" name="sba2" value="<?php echo $sba2 ;?>" />
                    <input type="hidden" name="sbb1" value="<?php echo $sbb1 ;?>" />
                    <input type="hidden" name="sbb2" value="<?php echo $sbb2 ;?>" />
                    <input type="hidden" name="mtolp1" value="<?php echo $mtolp1 ;?>" />
                    <input type="hidden" name="mtolp2" value="<?php echo $mtolp2 ;?>" />
                    <input type="hidden" name="mtol1" value="<?php echo $mtol1 ;?>" />
                    <input type="hidden" name="mtol2" value="<?php echo $mtol2 ;?>" />
                    <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">بعدی &raquo;</button>
                </form>
            </li>
        <?php endif; ?>
    </ul>
    
    <div class="page-jump" style="margin-top:10px;">
        <form id="pageJumpForm" action="Agri_rep170.php" method="post" style="display:inline-block;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                    <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
                    <input type="hidden" name="no_ab" value="<?php echo $no_ab ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                    <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                    <input type="hidden" name="zka1" value="<?php echo $zka1 ;?>" />
                    <input type="hidden" name="zka2" value="<?php echo $zka2 ;?>" />
                    <input type="hidden" name="zkb1" value="<?php echo $zkb1 ;?>" />
                    <input type="hidden" name="zkb2" value="<?php echo $zkb2 ;?>" />
                    <input type="hidden" name="sba1" value="<?php echo $sba1 ;?>" />
                    <input type="hidden" name="sba2" value="<?php echo $sba2 ;?>" />
                    <input type="hidden" name="sbb1" value="<?php echo $sbb1 ;?>" />
                    <input type="hidden" name="sbb2" value="<?php echo $sbb2 ;?>" />
                    <input type="hidden" name="mtolp1" value="<?php echo $mtolp1 ;?>" />
                    <input type="hidden" name="mtolp2" value="<?php echo $mtolp2 ;?>" />
                    <input type="hidden" name="mtol1" value="<?php echo $mtol1 ;?>" />
                    <input type="hidden" name="mtol2" value="<?php echo $mtol2 ;?>" />
            <span style="font-size:18px; margin-left:15px">به صفحه</span>
            <input type="number" 
                   id="pageIdInput"
                   name="page_input"
                   value="<?php echo isset($id) ? (int)$id : 1; ?>" 
                   placeholder="شماره صفحه" 
                   style="width:80px; padding:5px; border-radius:4px; border:1px solid #ccc;">
            <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">برو</button>
        </form>
    </div>
</div>

<script>
document.getElementById('pageJumpForm').addEventListener('submit', function(e) {
    var input = document.getElementById('pageIdInput');
    var pageId = parseInt(input.value, 10);
    if (!isNaN(pageId) && pageId >= 1 && pageId <= <?php echo $total; ?>) {
        this.action = 'Agri_rep170.php?id=' + pageId + '#1';
    } else {
        e.preventDefault();
        alert("لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo $total; ?> وارد کنید.");
    }
});
</script>
<?php } // پایان بررسی !empty($query1) ?>
</div>
          <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>