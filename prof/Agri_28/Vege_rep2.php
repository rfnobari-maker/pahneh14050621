<?php 
include('../../lock_p1.php');
include('../../event.php');
include('counter15.php');
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city   = isset($_POST['id_city5']) ? $_POST['id_city5'] : '';
$id_mar    = isset($_POST['id_mar']) ? $_POST['id_mar'] : ''; 
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city  = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$ra_kesh   = isset($_POST['ra_kesh']) ? $_POST['ra_kesh'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal     = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$b_time    = isset($_POST['b_time']) ? $_POST['b_time'] : '';
$zka1      = isset($_POST['zka1']) ? $_POST['zka1'] : '';
$zka2      = isset($_POST['zka2']) ? $_POST['zka2'] : '';
$sba1      = isset($_POST['sba1']) ? $_POST['sba1'] : '';
$sba2      = isset($_POST['sba2']) ? $_POST['sba2'] : '';
$mtol1     = isset($_POST['mtol1']) ? $_POST['mtol1'] : '';
$mtol2     = isset($_POST['mtol2']) ? $_POST['mtol2'] : '';
$mtolp1    = isset($_POST['mtolp1']) ? $_POST['mtolp1'] : '';
$mtolp2    = isset($_POST['mtolp2']) ? $_POST['mtolp2'] : '';
$ragham    = isset($_POST['ragham']) ? $_POST['ragham'] : ''; 
$no_ab     = isset($_POST['no_ab']) ? $_POST['no_ab'] : ''; 
$dah_bazar = isset($_POST['dah_bazar']) ? $_POST['dah_bazar'] : ''; 
$mah_bazar = isset($_POST['mah_bazar']) ? $_POST['mah_bazar'] : ''; 
$mah_name  = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
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
$(".country<?php echo $num_t_mah ;?>").change(function()
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
$(".mar<?php echo $num_t_mah ;?>").html(html);
} 
});
});
});
</script>
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_popup2(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
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
      <span class="style8">گزارش اختصاصی اطلاعات صیفی </span><br />
      </p>
      <span class="style1"><a name="1" id="1"></a></span>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 800px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="671" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td width="204" height="62" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
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
                 <td height="62" align="right" bgcolor="#DDDDDD" class="input_text" >
                  <?php $id_ostan1 = $id_ostan?>
                   <select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="-1">انتخاب استان</option>
                     <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY  ostan ASC "  ;
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
                 <td height="41" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="b_time" class="input_text  required" id="b_time" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($b_time=='1') { echo 'selected="selected"' ; } ?>>زمستانه/استمرار</option>
                     <option value="2" <?php if ($b_time=='2') { echo 'selected="selected"' ; } ?>>بهاره</option>
                     <option value="3" <?php if ($b_time=='3') { echo 'selected="selected"' ; } ?>>تابستانه</option>
                     <option value="4" <?php if ($b_time=='4') { echo 'selected="selected"' ; } ?>>پاییزه</option>
                   </select>
                 </div></td>
                 <td height="41" align="center" bgcolor="#FFFFFF" ><span class="normalTextSmall">: فصل تولید</span></td>
                 <td width="196" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_city5" disabled="disabled" class="style8" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="0"> کل استان</option>
                     <?php
$query = "SELECT id_city,city FROM cityname WHERE  `id_ostan` = '$id_ostan1' ORDER BY BINARY city ASC "  ;
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
                 <td width="166"  align='center' bgcolor="#FFFFFF" ><font size="2" class="normalTextSmall"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="42" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >انتخاب نام آبادی</option>
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
                 <td height="42"  align='center' bgcolor="#DDDDDD" class="normalTextSmall"> : نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="id_mar" disabled="disabled" class="style8" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
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
                 <td rowspan="2"  align='center' bgcolor="#DDDDDD" ><font size="2" class="normalTextSmall"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="40" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >انتخاب نام شهر</option>
                   <?php
$query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = '$login_session' ORDER BY BINARY shahr "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                   <?php }?>
                 </select></td>
                 <td height="40"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">:نام شهر</td>
               </tr>
               <tr >
                 <td height="60" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="ragham" id="ragham" class="input_text  required"  style="height:40px ; width:100px ; direction:rtl" tabindex="6">
                     <?php
switch ($mah_name) {
    case "174":
  ?>
                     <option value="-">-----</option>
                     <?php
        break;
    case "172":
  ?>
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($ragham=='1') { echo 'selected="selected"' ; }?>>قرمز</option>
                     <option value="2" <?php if ($ragham=='2') { echo 'selected="selected"' ; }?>>سفید</option>
                     <option value="3" <?php if ($ragham=='3') { echo 'selected="selected"' ; }?>>زرد</option>
                     <option value="4" <?php if ($ragham=='4') { echo 'selected="selected"' ; }?>>صورتی</option>
                     <?php
        break;
    case "170":
  ?>
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($ragham=='1') { echo 'selected="selected"' ; }?>>اگریا</option>
                     <option value="2" <?php if ($ragham=='2') { echo 'selected="selected"' ; }?>>سانته</option>
                     <option value="3" <?php if ($ragham=='3') { echo 'selected="selected"' ; }?>>ساتینا</option>
                     <option value="4" <?php if ($ragham=='4') { echo 'selected="selected"' ; }?>>میلوا</option>
                     <option value="5" <?php if ($ragham=='5') { echo 'selected="selected"' ; }?>>بورن</option>
                     <option value="6" <?php if ($ragham=='6') { echo 'selected="selected"' ; }?>>ساوالان</option>
                     <option value="7" <?php if ($ragham=='7') { echo 'selected="selected"' ; }?>>آرنیدا</option>
                     <option value="8" <?php if ($ragham=='8') { echo 'selected="selected"' ; }?>>بانبا</option>
                     <option value="9" <?php if ($ragham=='9') { echo 'selected="selected"' ; }?>>مارفونا</option>
                     <option value="10" <?php if ($ragham=='10') { echo 'selected="selected"' ; }?>>فونتانه</option>
                     <option value="11" <?php if ($ragham=='11') { echo 'selected="selected"' ; }?>>راموس</option>
                     <option value="12" <?php if ($ragham=='12') { echo 'selected="selected"' ; }?>>پیکاسو</option>
                     <option value="13" <?php if ($ragham=='13') { echo 'selected="selected"' ; }?>>جلی</option>
                     <option value="14" <?php if ($ragham=='14') { echo 'selected="selected"' ; }?>>سایر</option>
                     <?php
}
?>
                   </select>
                 </div></td>
                 <td height="60"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: رقم</td>
                 <td height="60" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select  name="mah_name" class="required input_text country" id="mah_name" style="width:150px ; height:40px" tabindex="22" dir="rtl" onchange="this.form.submit()" >
                     <option value="">انتخاب محصول</option>
                     <option value="174" <?php if ($mah_name=='174') echo 'selected="selected"' ; ?>>گوجه فرنگی</option>
                     <option value="170" <?php if ($mah_name=='170') echo 'selected="selected"' ; ?>>سیب زمینی</option>
                     <option value="172" <?php if ($mah_name=='172') echo 'selected="selected"' ; ?>>پیاز</option>
                   </select></td>
                 <td  align='center' bgcolor="#FFFFFF" ><font size="2" class="normalTextSmall">:نام محصول</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="ra_kesh" id="ra_kesh" class="input_text  required"  style="height:40px ; width:150px ; direction:rtl" tabindex="7">
                     <?php if ($mah_name=='170') {?>
                     <option value="2" <?php if ($ra_kesh=='2') { echo 'selected="selected"' ; }?>>مستقیم</option>
                     <?php } else {?>
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($ra_kesh=='1') { echo 'selected="selected"' ; }?>>نشایی</option>
                     <option value="2" <?php if ($ra_kesh=='2') { echo 'selected="selected"' ; }?>>مستقیم</option>
                     <?php }?>
                     <?php if ($mah_name=='174') {?> 
                  <option value="3"<?php if ($ra_kesh=='3') { echo 'selected="selected"' ; }?>>نشایی با مالچ</option>
                  <option value="4"<?php if ($ra_kesh=='4') { echo 'selected="selected"' ; }?>>مستقیم با مالچ</option>
                    <?php }?>
                   </select>
                 </div></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall"><font size="2" class="normalTextSmall">:روش کشت</font></td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="no_ab" class="input_text  required" id="no_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="8">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($no_ab=='1') { echo 'selected="selected"' ; }?>>نواری</option>
                     <option value="2" <?php if ($no_ab=='2') { echo 'selected="selected"' ; }?>>غرقابی</option>
                     <option value="3" <?php if ($no_ab=='3') { echo 'selected="selected"' ; }?>>قطره ای</option>
                     <option value="4" <?php if ($no_ab=='4') { echo 'selected="selected"' ; }?>>بارانی</option>
                     <option value="5" <?php if ($no_ab=='5') { echo 'selected="selected"' ; }?>>سایر</option>
                   </select>
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" ><font size="2" class="normalTextSmall">:روش آبیاری</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="zka2" type="text" class="input_text" id="zka2"  style="height:35px ; width:70px " value="<?php echo $zka2?>" />
                   </div></td>
                 <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی</td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="zka1" type="text" class="input_text" id="zka1"  style="height:35px ; width:70px " value="<?php echo $zka1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" ><font size="2" class="normalTextSmall">سطح زیر کشت <br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="sba2" type="text" class="input_text" id="sba2"  style="height:35px ; width:70px " value="<?php echo $sba2?>" />
                   </div></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">:کوچکتر یا مساوی</td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="sba1" type="text" class="input_text" id="zka4"  style="height:35px ; width:70px " value="<?php echo $sba1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" ><font size="2" class="normalTextSmall">سطح  برداشت <br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtolp2" type="text" class="input_text" id="mtolp2"  style="height:35px ; width:70px " value="<?php echo $mtolp2?>" />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtolp1" type="text" class="input_text" id="mtol4"  style="height:35px ; width:70px " value="<?php echo $mtolp1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" ><font size="2" class="normalTextSmall">میزان پیش بینی محصول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <span class="style2">تن </span>
                   <input name="mtol2" type="text" class="input_text" id="mtol2"  style="height:35px ; width:70px " value="<?php echo $mtol2?>" />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <span class="style2">تن </span>
                   <input name="mtol1" type="text" class="input_text" id="mtol1"  style="height:35px ; width:70px " value="<?php echo $mtol1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" ><font size="2" class="normalTextSmall">میزان تولید محصول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="dah_bazar" class="required input_text  required" id="dah_bazar"  style="height:40px ; width:150px ; direction:rtl" tabindex="3">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($dah_bazar=='1') { echo 'selected="selected"' ; } ?>>دهه اول </option>
                     <option value="2" <?php if ($dah_bazar=='2') { echo 'selected="selected"' ; } ?>>دهه دوم</option>
                     <option value="3" <?php if ($dah_bazar=='3') { echo 'selected="selected"' ; } ?>>دهه سوم</option>
                   </select>
                 </div></td>
                 <td height="54" align="right" bgcolor="#FFFFFF"  ><font size="2" class="normalTextSmall">: دهه ارسال به بازار</font></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="mah_bazar" class="required input_text  required" id="mah_bazar<?php echo $num2_t_mah ;?>"  style="height:40px ; width:150px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($mah_bazar=='1') { echo 'selected="selected"' ; } ?>>فروردین</option>
                     <option value="2" <?php if ($mah_bazar=='2') { echo 'selected="selected"' ; } ?>>اردیبهشت</option>
                     <option value="3" <?php if ($mah_bazar=='3') { echo 'selected="selected"' ; } ?>>خرداد</option>
                     <option value="4" <?php if ($mah_bazar=='4') { echo 'selected="selected"' ; } ?>>تیر</option>
                     <option value="5" <?php if ($mah_bazar=='5') { echo 'selected="selected"' ; } ?>>مرداد</option>
                     <option value="6" <?php if ($mah_bazar=='6') { echo 'selected="selected"' ; } ?>>شهریور</option>
                     <option value="7" <?php if ($mah_bazar=='7') { echo 'selected="selected"' ; } ?>>مهر</option>
                     <option value="8" <?php if ($mah_bazar=='8') { echo 'selected="selected"' ; } ?>>آبان</option>
                     <option value="9" <?php if ($mah_bazar=='9') { echo 'selected="selected"' ; } ?>>آذر</option>
                     <option value="10" <?php if ($mah_bazar=='10') { echo 'selected="selected"' ; } ?>>دی</option>
                     <option value="11" <?php if ($mah_bazar=='11') { echo 'selected="selected"' ; } ?>>بهمن</option>
                     <option value="12" <?php if ($mah_bazar=='12') { echo 'selected="selected"' ; } ?>>اسفند</option>
                   </select>
                 </div></td>
                 <td height="54"  align='center' bgcolor="#FFFFFF" ><font size="2" class="normalTextSmall">:ماه ارسال به بازار</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                   </div>                </td>
                 <td height="54" align="right" bgcolor="#DDDDDD"  ><font size="2" class="normalTextSmall">: کد ملی بهره بردار</font></td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="mor_cod_m" type="text" class="style8"  style="height:35px ; width:170px " value="<?php echo $login_session ?>" readonly="readonly" />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" ><font size="2" class="normalTextSmall">: کد ملی مروج</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px  ; background-color:#3CF ; alignment-adjust:middle" value='اجرای کوئری' />
                 </td>
                 </tr>
             </table> 
           </div>
 </form>
             <p>
               <?php
 if (isset($_POST['action'])) 
 {  
 if ($id_ostan1 == '-1') { $v_id_ostan  = 1   ;}else{$v_id_ostan  = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      { $v_id_city   = 1   ;}else{$v_id_city   = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      { $v_id_mar    = 1   ;}else{$v_id_mar    = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') { $f_add_abadi = 1   ;}else{$f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1   ;}else{$f_add_city  = "add_city = '$add_city'" ;}
 if ($ra_kesh == '')     { $v_ra_kesh    = 1   ;}else{$v_ra_kesh   = "ra_kesh = '$ra_kesh'" ;}
 if ($mor_cod_m == '')   { $v_mor_cod_m = 1   ;}else{$v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')   { $v_bah_cod_m = 1   ;}else{$v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')       { $v_z_sal     = 1   ;}else{$v_z_sal     = "z_sal = '$z_sal'" ;}
 if ($b_time == '')        { $f_b_time=   1 ;}else{ $f_b_time   = "b_time = '$b_time'"       ;}
 if ($mah_name == '')    { $v_cod_mah   = 1   ;}else{$v_cod_mah   = "cod_mah = '$mah_name'" ;}
 if ($zka1 == '')        { $v_zka1  = 1       ;}else{$v_zka1      = "zer_kesht >= '$zka1'" ;}
 if ($zka2 == '')        { $v_zka2  = 1       ;}else{$v_zka2      = "zer_kesht <= '$zka2'" ;}
 if ($sba1 == '')        { $v_sba1  = 1       ;}else{$v_sba1      = "s_bar >= '$sba1'" ;}
 if ($sba2 == '')        { $v_sba2  = 1       ;}else{$v_sba2      = "s_bar <= '$sba2'" ;}
 if ($mtol1 == '')       { $v_mtol1  = 1      ;}else{$v_mtol1     = "mah_tol >= '$mtol1'" ;}
 if ($mtol2 == '')       { $v_mtol2  = 1      ;}else{$v_mtol2     = "mah_tol <= '$mtol2'" ;}
 if ($mtolp1 == '')      { $v_mtolp1  = 1     ;}else{$v_mtolp1    = "mah_tolp >= '$mtolp1'" ;}
 if ($mtolp2 == '')      { $v_mtolp2  = 1     ;}else{$v_mtolp2    = "mah_tolp <= '$mtolp2'" ;}
 if ($ragham == '')      { $v_ragham  = 1     ;}else{$v_ragham    = "ragham = '$ragham'" ;}
 if ($no_ab == '')       { $v_no_ab  = 1     ;}else{$v_no_ab   = "no_ab = '$no_ab'" ;}
 if ($mah_bazar == '')   { $v_mah_bazar  = 1  ;}else{$v_mah_bazar     = "mah_bazar = '$mah_bazar'" ;}
 if ($dah_bazar == '')   { $v_dah_bazar  = 1  ;}else{$v_dah_bazar      = "dah_bazar = '$dah_bazar'" ;}
 include('../../login/config.php');
$start=0;
$limit=25;
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$start=($id-1)*$limit;
  $query = "SELECT * from  Vege_prod where  $v_id_ostan  and  $v_id_city  and  $v_id_mar and  $f_add_abadi and 
  $f_add_city and $v_mor_cod_m and $v_bah_cod_m and $v_z_sal  and  $v_cod_mah and $v_sba1 and
  $v_sba2    and  $v_ragham  and $v_no_ab and $v_zka1 and $v_zka2 and $v_mah_bazar and $v_dah_bazar and
  $v_mtolp1 and  $v_mtolp2  and $v_mtol1 and $v_mtol2 and $v_ra_kesh and $f_b_time ORDER BY bah_cod_m ASC LIMIT $start, $limit "; 
 $query1 = "SELECT count(*) from  Vege_prod where  $v_id_ostan  and  $v_id_city  and  $v_id_mar and  $f_add_abadi and 
  $f_add_city and $v_mor_cod_m and $v_bah_cod_m and $v_z_sal  and  $v_cod_mah and $v_sba1 and
  $v_sba2    and  $v_ragham  and $v_no_ab and $v_zka1 and $v_zka2 and $v_mah_bazar and $v_dah_bazar and
  $v_mtolp1 and  $v_mtolp2  and $v_mtol1 and $v_mtol2 and $v_ra_kesh and $f_b_time"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form  action="Vege_rep2_xls.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="ra_kesh"   value="<?php echo  $ra_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="b_time" value="<?php echo $b_time;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="zka1"  value="<?php echo $zka1 ;?>" />
                   <input type="hidden" name="zka2"  value="<?php echo $zka2 ;?>" />
                   <input type="hidden" name="ragham"  value="<?php echo $ragham ;?>" />
                   <input type="hidden" name="no_ab"  value="<?php echo $no_ab ;?>" />
                   <input type="hidden" name="sba1"  value="<?php echo $sba1 ;?>" />
                   <input type="hidden" name="sba2"  value="<?php echo $sba2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <input type="hidden" name="mah_bazar"  value="<?php echo  $mah_bazar ;?>" />
                   <input type="hidden" name="dah_bazar"  value="<?php echo  $dah_bazar ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
             <br />
            <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td width="12%" rowspan="2" bgcolor="#006699">عملیات</td>
                <td width="9%" rowspan="2" bgcolor="#006699">نام محصول</td>
                <td width="10%" rowspan="2" bgcolor="#006699">فصل تولید </td>
          <td colspan="2" bgcolor="#006699">میزان محصول / تن</td>
          <td colspan="2" bgcolor="#006699">مساحت/هکتار</td>
          <td  colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="9%" bgcolor="#006699">قطعی</td>
          <td width="9%" bgcolor="#006699">پیش بینی</td>
          <td width="7%" bgcolor="#006699">سطح برداشت</td>
          <td width="11%" bgcolor="#006699">سطح زیر کشت</td>
          <td width="12%" bgcolor="#006699" class="style8"><img src="../../files/sort.png" width="15" height="24"  alt=""/><span class="text1"> کد ملی</span></td>
          <td width="16%" bgcolor="#006699">نام و نام خانوادگی</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['b_time']=='1')  $v_b_time='زمستانه/استمرار';
if ($row['b_time']=='2')  $v_b_time='بهاره';
if ($row['b_time']=='3')  $v_b_time='تابستانه';
if ($row['b_time']=='4')  $v_b_time='پاییزه';
  ?>
          <td height="58" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Vegedata_T_view.php" method="post" onsubmit="target_popup2(this)">
              <input type="hidden" name="id"  value="<?php echo $row['Vege_id'] ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
            </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_b_time ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],3)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],3)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar']+0 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht']+0 ; ?></td>
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
<div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
<?php   
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> fetchColumn();
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="Vege_rep2.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city5"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="ra_kesh"   value="<?php echo  $ra_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="b_time" value="<?php echo $b_time;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="zka1"  value="<?php echo $zka1 ;?>" />
                   <input type="hidden" name="zka2"  value="<?php echo $zka2 ;?>" />
                   <input type="hidden" name="ragham"  value="<?php echo $ragham ;?>" />
                   <input type="hidden" name="no_ab"  value="<?php echo $no_ab ;?>" />
                   <input type="hidden" name="sba1"  value="<?php echo $sba1 ;?>" />
                   <input type="hidden" name="sba2"  value="<?php echo $sba2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <input type="hidden" name="mah_bazar"  value="<?php echo  $mah_bazar ;?>" />
                   <input type="hidden" name="dah_bazar"  value="<?php echo  $dah_bazar ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="Vege_rep2.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city5"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="ra_kesh"   value="<?php echo  $ra_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="b_time" value="<?php echo $b_time;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="zka1"  value="<?php echo $zka1 ;?>" />
                   <input type="hidden" name="zka2"  value="<?php echo $zka2 ;?>" />
                   <input type="hidden" name="ragham"  value="<?php echo $ragham ;?>" />
                   <input type="hidden" name="no_ab"  value="<?php echo $no_ab ;?>" />
                   <input type="hidden" name="sba1"  value="<?php echo $sba1 ;?>" />
                   <input type="hidden" name="sba2"  value="<?php echo $sba2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <input type="hidden" name="mah_bazar"  value="<?php echo  $mah_bazar ;?>" />
                   <input type="hidden" name="dah_bazar"  value="<?php echo  $dah_bazar ;?>" />
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
      <li class='current'><form  action="Vege_rep2.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city5"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="ra_kesh"   value="<?php echo  $ra_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="b_time" value="<?php echo $b_time;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="zka1"  value="<?php echo $zka1 ;?>" />
                   <input type="hidden" name="zka2"  value="<?php echo $zka2 ;?>" />
                   <input type="hidden" name="ragham"  value="<?php echo $ragham ;?>" />
                   <input type="hidden" name="no_ab"  value="<?php echo $no_ab ;?>" />
                   <input type="hidden" name="sba1"  value="<?php echo $sba1 ;?>" />
                   <input type="hidden" name="sba2"  value="<?php echo $sba2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <input type="hidden" name="mah_bazar"  value="<?php echo  $mah_bazar ;?>" />
                   <input type="hidden" name="dah_bazar"  value="<?php echo  $dah_bazar ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
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