<?php
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../side_menu1.php');

$id_ostan1   = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city     = isset($_POST['id_city5']) ? $_POST['id_city5'] : '';
$id_mar      = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$add_abadi   = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city    = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh     = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$nah_kesh    = isset($_POST['nah_kesh']) ? $_POST['nah_kesh'] : '';
$m_ab        = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
$no_ab       = isset($_POST['no_ab']) ? $_POST['no_ab'] : '';
$mor_cod_m   = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m   = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal       = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$skb1        = isset($_POST['skb1']) ? $_POST['skb1'] : '';
$skb2        = isset($_POST['skb2']) ? $_POST['skb2'] : '';
$skgb1       = isset($_POST['skgb1']) ? $_POST['skgb1'] : '';
$skgb2       = isset($_POST['skgb2']) ? $_POST['skgb2'] : '';
$treeb1      = isset($_POST['treeb1']) ? $_POST['treeb1'] : '';
$treeb2      = isset($_POST['treeb2']) ? $_POST['treeb2'] : '';
$treegb1     = isset($_POST['treegb1']) ? $_POST['treegb1'] : '';
$treegb2     = isset($_POST['treegb2']) ? $_POST['treegb2'] : '';
$mtol1       = isset($_POST['mtol1']) ? $_POST['mtol1'] : '';
$mtol2       = isset($_POST['mtol2']) ? $_POST['mtol2'] : '';
$mtolp1      = isset($_POST['mtolp1']) ? $_POST['mtolp1'] : '';
$mtolp2      = isset($_POST['mtolp2']) ? $_POST['mtolp2'] : '';
$mah_kh      = isset($_POST['mah_kh']) ? $_POST['mah_kh'] : '';
$mah_qroup   = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name    = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
<style>
button
{
	border-color:#FFF ;
}
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
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
url: "ajax_garden.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar").html(html);
} 
});
});
});

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
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
      <span class="style8">گزارش اختصاصی اطلاعات باغی </span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="848" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="204" height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                              <select  name="z_sal" class="input_text"  id="id_ostan" style="width:170px ; height:40px" dir="rtl" >
                   <?php
                   $query = "SELECT  sal FROM b_sal ORDER BY sal desc"  ;
                   $stmt = $dbh->prepare($query);
                   $stmt->execute();
                   foreach($stmt as $row){
                   ?>
                     <option value="<?php echo $row['sal'] ;?>"
                    <?php if (isset($z_sal) && $row['sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['sal'] ;?></option>
                   <?php }?>
                 </select>


                 </div></td>
                 <td width="134"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: سال </td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                 <select  name="id_ostan" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                  <option value="-1">انتخاب استان</option>
                  <?php
$query = "SELECT  id_ostan,ostan FROM ostanname  ORDER BY BINARY ostan ASC "  ;
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
                   <select name="no_kesh" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl">
                     <option value="0">انتخاب کنید</option>
                     <option value="1" <?php if($no_kesh=="1") echo "selected='selected'"?>>آبی</option>
                     <option value="2" <?php if($no_kesh=="2") echo "selected='selected'"?>>دیم</option>
                   </select>
                 </div></td>
                 <td height="41" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: نوع کشت</font></td>
                 <td width="196" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_city5" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="0"> کل استان</option>
                     <?php
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan1' ORDER BY BINARY city ASC "  ;
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
                 <td width="166"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >انتخاب نام آبادی</option>
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
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall"> : نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="id_mar" class="input_text" id="id_mar" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
                   <option value="0"> نام مرکز</option>
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
                   <input name="id_city2" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td rowspan="2"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >انتخاب نام شهر</option>
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
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">:نام شهر</td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                   </div></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: کد ملی بهره بردار</font></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m"  style="height:35px ; width:170px " value="<?php echo $mor_cod_m?>" />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">: کد ملی مروج</font></td>
           </tr>
               <tr >
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

                 <td height="50" colspan="2" align="right"  bgcolor="#FFFFFF" class="style8" >برای کشت پراکنده نباید نوع کشت انتخاب شود</td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="nah_kesh" class="input_text  required" id="nah_kesh"  style="height:40px ; width:170px ; direction:rtl">
                     <option value="0">انتخاب کنید</option>
                     <option value="1"<?php if($nah_kesh=="1") echo "selected='selected'"?>>ساده</option>
                     <option value="2"<?php if($nah_kesh=="2") echo "selected='selected'"?>>مخلوط</option>
                     <option value="3"<?php if($nah_kesh=="3") echo "selected='selected'"?>>پراکنده</option>
                     </select>
                 </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">:نحوه کشت</font></td>
               </tr>
               
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="skb2" type="text" class="input_text" id="skb2"  style="height:35px ; width:70px " value="<?php echo $skb2?>" />
                   </div></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی</td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="skb1" type="text" class="input_text" id="skb1"  style="height:35px ; width:70px " value="<?php echo $skb1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">سطح زیر کشت بارور<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="skgb2" type="text" class="input_text" id="skgb2"  style="height:35px ; width:70px " value="<?php echo $skgb2?>" />
                   </div></td>
                 <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی</td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="skgb1" type="text" class="input_text" id="skgb1"  style="height:35px ; width:70px " value="<?php echo $skgb1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">سطح زیر کشت غیر بارور<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">اصله </span>
                     <input name="treeb2" type="text" class="input_text" id="treeb2"  style="height:35px ; width:70px " value="<?php echo $treeb2?>" />
                 </div></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">:کوچکتر یا مساوی</td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">اصله </span>
                     <input name="treeb1" type="text" class="input_text" id="zka4"  style="height:35px ; width:70px " value="<?php echo $treeb1?>" />
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">تعداد درخت بارور<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">اصله </span>
                     <input name="treegb2" type="text" class="input_text" id="treegb2"  style="height:35px ; width:70px " value="<?php echo $treegb2?>" />
                   </div></td>
                 <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">اصله </span>
                     <input name="treegb1" type="text" class="input_text" id="zkb4"  style="height:35px ; width:70px " value="<?php echo $treegb1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">تعداد درخت غیر بارور<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="61" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select  name="mah_name" class="required input_text mar" id="mah_name" style="width:170px ; height:40px" tabindex="23" dir="rtl">
                     <?php
 $query = "SELECT DISTINCT product_cod,product_name FROM product_b WHERE  group_cod = $mah_qroup " ;
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
                 <td height="61"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: نام محصول</td>
                 <td height="61" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select  name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px ; height:40px" tabindex="22" dir="rtl"  >
                     <option value="" > انتخاب گروه</option>
                     <?php
$query = "SELECT DISTINCT group_cod,group_name FROM product_b "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                     <?php }?>
                   </select>
                 </div>                   <div align="right"></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">:گروه محصولات</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtolp2" type="text" class="input_text" id="mtolp2"  style="height:35px ; width:70px " value="<?php echo $mtolp2?>" />
                 </div></td>
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtolp1" type="text" class="input_text" id="mtol4"  style="height:35px ; width:70px " value="<?php echo $mtolp1?>" />
                 </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">میزان پیش بینی محصول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtol2" type="text" class="input_text" id="mtol2"  style="height:35px ; width:70px " value="<?php echo $mtol2?>" />
                 </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtol1" type="text" class="input_text" id="mtol5"  style="height:35px ; width:70px " value="<?php echo $mtol1?>" />
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">میزان تولید محصول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">&nbsp;</td>
                 <td height="41" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                <select name="mah_kh<?php echo $num2_t_mah ;?>" class="required input_text  required" id="mah_kh<?php echo $num2_t_mah ;?>"  style="height:40px ; direction:rtl" tabindex="30">
                  <option value="0">انتخاب</option>
                  <option value="1" <?php if ($mah_kh=='1') { echo 'selected="selected"' ; } ?>>بلی</option>
                  <option value="2" <?php if ($mah_kh=='2') { echo 'selected="selected"' ; } ?>>خیر</option>
                </select>
                 </div></td>
                 <td height="41" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: خسارت</font></td>
                 </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='اجرای کوئری' />
                   </td>
               </tr>
             </table> 
           </div>
 </form>
             <p>
               <?php
 if (isset($_POST['action'])) 
 {  
$conditions = array();

if ($id_ostan1 != '-1')     $conditions[] = "Garden_prod.id_ostan = '$id_ostan1'";
if ($id_city != 0)          $conditions[] = "Garden_prod.id_city = '$id_city'";
if ($id_mar != 0)           $conditions[] = "Garden_prod.id_mar = '$id_mar'";
if ($add_abadi != '0')      $conditions[] = "Garden_prod.add_abadi = '$add_abadi'";
if ($add_city != '0')       $conditions[] = "Garden_prod.add_city = '$add_city'";
if ($no_kesh != '0')        $conditions[] = "Garden.no_kesh = '$no_kesh'";
if ($nah_kesh != '0')       $conditions[] = "Garden.nah_kesh = '$nah_kesh'";
if ($m_ab !== '')           $conditions[] = "Garden.m_ab = '$m_ab'";
if ($no_ab !== '')          $conditions[] = "Garden.no_ab = '$no_ab'";
if ($mor_cod_m !== '')      $conditions[] = "Garden_prod.mor_cod_m = '$mor_cod_m'";
if ($bah_cod_m !== '')      $conditions[] = "Garden_prod.bah_cod_m = '$bah_cod_m'";
if ($z_sal !== '')          $conditions[] = "Garden_prod.z_sal = '$z_sal'";
if ($mah_name !== '')       $conditions[] = "Garden_prod.cod_mah = '$mah_name'";
if ($skb1 !== '')           $conditions[] = "Garden_prod.s_kesht_b >= $skb1";
if ($skb2 !== '')           $conditions[] = "Garden_prod.s_kesht_b <= $skb2";
if ($skgb1 !== '')          $conditions[] = "Garden_prod.s_kesht_gb >= $skgb1";
if ($skgb2 !== '')          $conditions[] = "Garden_prod.s_kesht_gb <= $skgb2";
if ($treeb1 !== '')         $conditions[] = "Garden_prod.tree_b >= $treeb1";
if ($treeb2 !== '')         $conditions[] = "Garden_prod.tree_b <= $treeb2";
if ($treegb1 !== '')        $conditions[] = "Garden_prod.tree_gb >= $treegb1";
if ($treegb2 !== '')        $conditions[] = "Garden_prod.tree_gb <= $treegb2";
if ($mtol1 !== '')          $conditions[] = "Garden_prod.mah_tol >= $mtol1";
if ($mtol2 !== '')          $conditions[] = "Garden_prod.mah_tol <= $mtol2";
if ($mtolp1 !== '')         $conditions[] = "Garden_prod.mah_tolp >= $mtolp1";
if ($mtolp2 !== '')         $conditions[] = "Garden_prod.mah_tolp <= $mtolp2";
if ($mah_kh != '0')         $conditions[] = "Garden_prod.mah_kh = '$mah_kh'";

// ساختن شرط نهایی
$whereClause = '';
if (count($conditions) > 0) {
    $whereClause = 'WHERE ' . implode(' AND ', $conditions);
}
$start=0;
$limit=25;
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start=($id-1)*$limit;
  $query = " SELECT Garden_prod.*, Garden.nah_kesh
FROM Garden_prod
INNER JOIN Garden ON Garden_prod.Garden_id = Garden.id
$whereClause
ORDER BY Garden_prod.bah_cod_m ASC
LIMIT $start, $limit  "; 
 $query1 = "SELECT count(*)
FROM Garden_prod
INNER JOIN Garden ON Garden_prod.Garden_id = Garden.id
$whereClause  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <span class="style1"><a name="1" id="1"></a></span><br />
             </p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td width="56"><form  action="Garden_rep170_xls.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh"   value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="nah_kesh"   value="<?php echo  $nah_kesh ;?>" />
                   <input type="hidden" name="m_ab"       value="<?php echo  $m_ab ;?>" />
                   <input type="hidden" name="no_ab"      value="<?php echo  $no_ab ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="skb1"  value="<?php echo $skb1 ;?>" />
                   <input type="hidden" name="skb2"  value="<?php echo $skb2 ;?>" />
                   <input type="hidden" name="skgb1"  value="<?php echo $skgb1 ;?>" />
                   <input type="hidden" name="skgb2"  value="<?php echo $skgb2 ;?>" />
                   <input type="hidden" name="treeb1"  value="<?php echo $treeb1 ;?>" />
                   <input type="hidden" name="treeb2"  value="<?php echo $treeb2 ;?>" />
                   <input type="hidden" name="treegb1"  value="<?php echo $treegb1 ;?>" />
                   <input type="hidden" name="treegb2"  value="<?php echo $treegb2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <input type="hidden" name="mah_kh"  value="<?php echo $mah_kh ;?>" />

                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                 <td width="56"><form  action="Garden_rep170_doc.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh"   value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="nah_kesh"   value="<?php echo  $nah_kesh ;?>" />
                   <input type="hidden" name="m_ab"       value="<?php echo  $m_ab ;?>" />
                   <input type="hidden" name="no_ab"      value="<?php echo  $no_ab ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="skb1"  value="<?php echo $skb1 ;?>" />
                   <input type="hidden" name="skb2"  value="<?php echo $skb2 ;?>" />
                   <input type="hidden" name="skgb1"  value="<?php echo $skgb1 ;?>" />
                   <input type="hidden" name="skgb2"  value="<?php echo $skgb2 ;?>" />
                   <input type="hidden" name="treeb1"  value="<?php echo $treeb1 ;?>" />
                   <input type="hidden" name="treeb2"  value="<?php echo $treeb2 ;?>" />
                   <input type="hidden" name="treegb1"  value="<?php echo $treegb1 ;?>" />
                   <input type="hidden" name="treegb2"  value="<?php echo $treegb2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <input type="hidden" name="mah_kh"  value="<?php echo $mah_kh ;?>" />                   
                   <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
                 </form></td>

               </tr>
             </table>
             <br />
            <table width="90%"  align="center" class="my-table" >
              <tr class="text1">
                <td colspan="2" rowspan="3" bgcolor="#006699">عملیات</td>
                <td width="7%" rowspan="3" bgcolor="#006699">نام محصول</td>
          <td colspan="2" bgcolor="#006699">میزان محصول / تن</td>
          <td colspan="6" bgcolor="#006699">مساحت/هکتار</td>
          <td width="8%" rowspan="3" bgcolor="#006699">نحوه کاشت</td>
          <td colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="4%" rowspan="3" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="5%" rowspan="2" bgcolor="#006699">قطعی</td>
          <td width="6%" rowspan="2" bgcolor="#006699">پیش بینی</td>
          <td colspan="3" bgcolor="#006699">تعداد درخت</td>
          <td  colspan="3" bgcolor="#006699">سطح زیر کشت</td>
          <td width="10%"  rowspan="2" bgcolor="#006699" class="style8"><img src="../../files/sort.png" width="15" height="24"  alt=""/><span class="text1"> کد ملی</span></td>
          <td width="14%" rowspan="2" bgcolor="#006699">نام و نام خانوادگی</td>
          </tr>
        <tr class="text1">
          <td width="5%" bgcolor="#006699">کل</td>
          <td width="3%" bgcolor="#006699">غیر بارور</td>
          <td width="5%" bgcolor="#006699">بارور </td>
          <td width="6%"  bgcolor="#006699">کل</td>
          <td width="8%" bgcolor="#006699">غیر بارور</td>
          <td width="7%" bgcolor="#006699">بارور </td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if($row['nah_kesh']=="1")  $f_nah_kesh = 'ساده'  ;
if($row['nah_kesh']=="2")  $f_nah_kesh = 'مخلوط' ;
if($row['nah_kesh']=="3")  $f_nah_kesh = 'پراکنده' ;
  ?>
          <td width="6%" height="53" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>  <form  action="../send_pm1.php#1" method="post" onsubmit="target_popup2(this)">
     <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
     <button><img src="../../files/receive_mail.png" width="23" height="25" title="ارسال پیام " /></button>
     </form></td>
          <td width="6%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Gardendata_view1.php" method="post" onsubmit="target_popup2(this)">
              <input type="hidden" name="id"  value="<?php echo $row['Garden_id'] ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="27" height="23"  alt=""/></button>
          </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name_bagh($row['cod_mah']) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],4)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],4)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b']+$row['tree_gb'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_gb']+0 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b']+0 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesht_b'] + $row['s_kesht_gb'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesht_gb']+0  ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesht_b']+0 ; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $f_nah_kesh ?></td>
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
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1->fetchColumn();
$total = ceil($rows/$limit);


// Function to generate hidden inputs (reduces code duplication)
function generate_hidden_inputs() {
    global $id_ostan1, $id_city, $id_mar, $add_abadi, $add_city,
           $bah_cod_m, $m_ab, $no_ab, $mor_cod_m, $no_kesh, $nah_kesh,
           $z_sal, $mah_qroup, $mah_name, $skb1, $skb2, $skgb1, $skgb2,
           $treeb1, $treeb2, $treegb1, $treegb2, $mtolp1, $mtolp2,
           $mtol1, $mtol2, $mah_kh;
    ?>
    <input type="hidden" name="action" value="1" />
    <input type="hidden" name="id_ostan" value="<?= htmlspecialchars($id_ostan1) ?>" />
    <input type="hidden" name="id_city5" value="<?= htmlspecialchars($id_city) ?>" />
    <input type="hidden" name="id_mar" value="<?= htmlspecialchars($id_mar) ?>" />
    <input type="hidden" name="add_abadi" value="<?= htmlspecialchars($add_abadi) ?>" />
    <input type="hidden" name="add_city" value="<?= htmlspecialchars($add_city) ?>" />
    <input type="hidden" name="bah_cod_m" value="<?= htmlspecialchars($bah_cod_m) ?>" />
    <input type="hidden" name="m_ab" value="<?= htmlspecialchars($m_ab) ?>" />
    <input type="hidden" name="no_ab" value="<?= htmlspecialchars($no_ab) ?>" />
    <input type="hidden" name="mor_cod_m" value="<?= htmlspecialchars($mor_cod_m) ?>" />
    <input type="hidden" name="no_kesh" value="<?= htmlspecialchars($no_kesh) ?>" />
    <input type="hidden" name="nah_kesh" value="<?= htmlspecialchars($nah_kesh) ?>" />
    <input type="hidden" name="z_sal" value="<?= htmlspecialchars($z_sal) ?>" />
    <input type="hidden" name="mah_qroup" value="<?= htmlspecialchars($mah_qroup) ?>" />
    <input type="hidden" name="mah_name" value="<?= htmlspecialchars($mah_name) ?>" />
    <input type="hidden" name="skb1" value="<?= htmlspecialchars($skb1) ?>" />
    <input type="hidden" name="skb2" value="<?= htmlspecialchars($skb2) ?>" />
    <input type="hidden" name="skgb1" value="<?= htmlspecialchars($skgb1) ?>" />
    <input type="hidden" name="skgb2" value="<?= htmlspecialchars($skgb2) ?>" />
    <input type="hidden" name="treeb1" value="<?= htmlspecialchars($treeb1) ?>" />
    <input type="hidden" name="treeb2" value="<?= htmlspecialchars($treeb2) ?>" />
    <input type="hidden" name="treegb1" value="<?= htmlspecialchars($treegb1) ?>" />
    <input type="hidden" name="treegb2" value="<?= htmlspecialchars($treegb2) ?>" />
    <input type="hidden" name="mtolp1" value="<?= htmlspecialchars($mtolp1) ?>" />
    <input type="hidden" name="mtolp2" value="<?= htmlspecialchars($mtolp2) ?>" />
    <input type="hidden" name="mtol1" value="<?= htmlspecialchars($mtol1) ?>" />
    <input type="hidden" name="mtol2" value="<?= htmlspecialchars($mtol2) ?>" />
    <input type="hidden" name="mah_kh" value="<?= htmlspecialchars($mah_kh) ?>" />
    <?php
}

// Define visible pages range (shows 5 pages at a time)
$visible_pages = 5;
$start_page = max(1, $id - $visible_pages);
$end_page = min($total, $id + $visible_pages);
?>

<div dir="rtl" class="pagination-container" style="margin: 20px auto; text-align: center; padding: 15px;">
    <ul class="pagination" style="list-style: none; padding: 0; margin: 0; display: flex; justify-content: center; flex-wrap: wrap; gap: 5px;">
        <?php if($id > 1): ?>
            <li style="display: inline-block;">
                <form action="Garden_rep170.php?id=<?= $id-1 ?>#1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">&laquo; قبلی</button>
                </form>
            </li>
        <?php endif; ?>

        <?php if($start_page > 1): ?>
            <li style="display: inline-block;">
                <form action="Garden_rep170.php?id=1#1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;">1</button>
                </form>
            </li>
            <?php if($start_page > 2): ?>
                <li style="display: inline-block; color: #999; padding: 5px 10px;">...</li>
            <?php endif; ?>
        <?php endif; ?>

        <?php for($i = $start_page; $i <= $end_page; $i++): ?>
            <li style="display: inline-block;">
                <?php if($i == $id): ?>
                    <span style="background: #4CAF50; color: white; padding: 5px 10px; border-radius: 4px; display: inline-block;"><?= $i ?></span>
                <?php else: ?>
                    <form action="Garden_rep170.php?id=<?= $i ?>#1" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?= $i ?></button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endfor; ?>

        <?php if($end_page < $total): ?>
            <?php if($end_page < $total - 1): ?>
                <li style="display: inline-block; color: #999; padding: 5px 10px;">...</li>
            <?php endif; ?>
            <li style="display: inline-block;">
                <form action="Garden_rep170.php?id=<?= $total ?>#1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?= $total ?></button>
                </form>
            </li>
        <?php endif; ?>

        <?php if($id < $total): ?>
            <li style="display: inline-block;">
                <form action="Garden_rep170.php?id=<?= $id+1 ?>#1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">بعدی &raquo;</button>
                </form>
            </li>
        <?php endif; ?>
    </ul>

    <?php if($id < $total || $id > 1): ?>
    <div class="page-jump" style="margin-top: 15px;">
        <form action="Garden_rep170.php" method="post" style="display: inline-flex; align-items: center; gap: 10px;">
            <?php generate_hidden_inputs(); ?>
            <span style="font-size: 14px;"> به صفحه:</span>
            <input type="number" name="page_input"
                   value="<?= $id ?>" style="width: 60px; padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
            <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">برو</button>
        </form>
    </div>
    <?php endif; ?>
</div>

<script>
document.querySelector('.page-jump form').addEventListener('submit', function(e) {
    const pageInput = this.querySelector('input[name="page_input"]');
    const pageNum = parseInt(pageInput.value);

    if (isNaN(pageNum)) {
        e.preventDefault();
        alert('لطفاً یک عدد معتبر وارد کنید');
        return;
    }

    if (pageNum < 1 || pageNum > <?= $total ?>) {
        e.preventDefault();
        alert('لطفاً عددی بین 1 و <?= $total ?> وارد کنید');
        return;
    }

    this.action = `Garden_rep170.php?id=${pageNum}#1`;
});
</script>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>