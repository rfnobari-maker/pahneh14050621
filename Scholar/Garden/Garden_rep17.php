<?php 
include('../../lock_Sc.php');
include('../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city5'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $no_kesh = $_POST['no_kesh'] ;
 $nah_kesh = $_POST['nah_kesh'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $z_sal = $_POST['z_sal'] ;
 $skb1 = $_POST['skb1'] ;
 $skb2 = $_POST['skb2'] ;
 $skgb1 = $_POST['skgb1'] ;
 $skgb2 = $_POST['skgb2'] ;
 $treeb1 = $_POST['treeb1'] ;
 $treeb2 = $_POST['treeb2'] ;
 $treegb1 = $_POST['treegb1'] ;
 $treegb2 = $_POST['treegb2'] ;
 $mtol1 = $_POST['mtol1'] ;
 $mtol2 = $_POST['mtol2'] ;
 $mtolp1 = $_POST['mtolp1'] ;
 $mtolp2 = $_POST['mtolp2'] ;
// کد گروه و کد محصول
 $mah_qroup = $_POST['mah_qroup'] ;
 $mah_name = $_POST['mah_name'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
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
      <?php include('top.php');?>
      <span class="style8">گزارش اختصاصی اطلاعات باغی </span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="724" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="204" height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                     <option value="1400"<?php  if ($z_sal=='1400') echo 'selected=selected'?>>1400</option>
                     <option value="1399" <?php if ($z_sal=='1399') echo 'selected=selected'?>>1399</option>
                     <option value="1398" <?php if ($z_sal=='1398') echo 'selected=selected'?>>1398</option>
                     <option value="1397" <?php if ($z_sal=='1397') echo 'selected=selected'?>>1397</option>
                     <option value="1396" <?php if ($z_sal=='1396') echo 'selected=selected'?>>1396</option>
                   </select>
                 </div></td>
                 <td width="134"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: سال </td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                 <?php $id_ostan1 = $id_ostan ;?>
                 <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                 <option value="-1">انتخاب استان</option>
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
                   <select  name="id_city5" disabled="disabled" class="style8" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="0"> کل استان</option>
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
                 <td width="166"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="50" colspan="2" align="right" bgcolor="#DDDDDD" class="style8" >برای کشت پراکنده نباید نوع کشت انتخاب شود</td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="nah_kesh" class="input_text  required" id="nah_kesh"  style="height:40px ; width:170px ; direction:rtl">
                     <option value="0">انتخاب کنید</option>
                     <option value="1"<?php if($nah_kesh=="1") echo "selected='selected'"?>>ساده</option>
                     <option value="2"<?php if($nah_kesh=="2") echo "selected='selected'"?>>مخلوط</option>
                     <option value="3"<?php if($nah_kesh=="3") echo "selected='selected'"?>>پراکنده</option>
                     </select>
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">:نحوه کشت</font></td>
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
include ('../../login/config.php');
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
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <span class="style2">تن </span>
                   <input name="mtol2" type="text" class="input_text" id="mtol2"  style="height:35px ; width:70px " value="<?php echo $mtol2?>" />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <span class="style2">تن </span>
                   <input name="mtol1" type="text" class="input_text" id="mtol1"  style="height:35px ; width:70px " value="<?php echo $mtol1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">میزان تولید محصول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="42" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
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
                 <td height="42"  align='center' bgcolor="#FFFFFF" class="normalTextSmall"> : نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_mar" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
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
                   <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td width="166" rowspan="2"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="40" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
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
                 <td height="40"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">:نام شهر</td>
                 </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                   </div>                </td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">: کد ملی بهره بردار</font></td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="mor_cod_m" type="text" class="input_text" value="<?php echo $mor_cod_m?>"  style="height:35px ; width:170px " />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">: کد ملی مروج</font></td>
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
 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "Garden_prod.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "Garden_prod.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "Garden_prod.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "Garden_prod.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "Garden_prod.add_city = '$add_city'" ;}
 if ($no_kesh == '0')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "Garden.no_kesh = '$no_kesh'" ;}
 if ($nah_kesh == '0')  { $f_nah_kesh  = 1  ; }else{ $f_nah_kesh = "Garden.nah_kesh = '$nah_kesh'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "Garden_prod.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "Garden_prod.bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "Garden_prod.z_sal = '$z_sal'" ;}
 if ($mah_name == '')  { $v_cod_mah  = 1  ; }else{ $v_cod_mah = "Garden_prod.cod_mah = '$mah_name'" ;}
 if ($skb1 == '')  { $v_skb1  = 1  ; }else{ $v_skb1 = "Garden_prod.s_kesht_b >= $skb1" ;}
 if ($skb2 == '')  { $v_skb2  = 1  ; }else{ $v_skb2 = "Garden_prod.s_kesht_b <= $skb2" ;}
 if ($skgb1 == '')  { $v_skgb1  = 1  ; }else{ $v_skgb1 = "Garden_prod.s_kesht_gb >= $skgb1" ;}
 if ($skgb2 == '')  { $v_skgb2  = 1  ; }else{ $v_skgb2 = "Garden_prod.s_kesht_gb <= $skgb2" ;}
 if ($treeb1 == '')  { $v_treeb1  = 1  ; }else{ $v_treeb1 = "Garden_prod.tree_b >= $treeb1" ;}
 if ($treeb2 == '')  { $v_treeb2  = 1  ; }else{ $v_treeb2 = "Garden_prod.tree_b <= $treeb2" ;}
 if ($treegb1 == '')  { $v_treegb1  = 1  ; }else{ $v_treegb1 = "Garden_prod.tree_gb >= $treegb1" ;}
 if ($treegb2 == '')  { $v_treegb2  = 1  ; }else{ $v_treegb2 = "Garden_prod.tree_gb <= $treegb2" ;}
 if ($mtol1 == '')  { $v_mtol1  = 1  ; }else{ $v_mtol1 = "Garden_prod.mah_tol >= $mtol1" ;}
 if ($mtol2 == '')  { $v_mtol2  = 1  ; }else{ $v_mtol2 = "Garden_prod.mah_tol <= $mtol2" ;}
 if ($mtolp1 == '')  { $v_mtolp1  = 1  ; }else{ $v_mtolp1 = "Garden_prod.mah_tolp >= $mtolp1" ;}
 if ($mtolp2 == '')  { $v_mtolp2  = 1  ; }else{ $v_mtolp2 = "Garden_prod.mah_tolp <= $mtolp2" ;}
 include('../../login/config.php');
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
   $query = " SELECT Garden_prod.*,Garden.nah_kesh
FROM Garden_prod
INNER JOIN Garden ON Garden_prod.Garden_id = Garden.id
where  $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $f_nah_kesh and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah and $v_treeb1 and $v_treeb2 and $v_treegb1 and $v_treegb2 and $v_skb1 and $v_skb2 and $v_skgb1 and $v_skgb2 and $v_mtolp1 and $v_mtolp2 and $v_mtol1 and $v_mtol2 ORDER BY Garden_prod.bah_cod_m ASC LIMIT $start, $limit "; 
 $query1 = "SELECT Garden_prod.*,Garden.nah_kesh
FROM Garden_prod
INNER JOIN Garden ON Garden_prod.Garden_id = Garden.id
where  $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $f_nah_kesh and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah and $v_treeb1 and $v_treeb2 and $v_treegb1 and $v_treegb2 and $v_skb1 and $v_skb2 and $v_skgb1 and $v_skgb2 and $v_mtolp1 and $v_mtolp2 and $v_mtol1 and $v_mtol2  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
if($nah_kesh=="1")  $f_nah_kesh = 'ساده'  ;
if($nah_kesh=="2")  $f_nah_kesh = 'مخلوط' ;
if($nah_kesh=="3")  $f_nah_kesh = 'پراکنده' ;
?>
               <span class="style1"><a name="1" id="1"></a></span><br />
             </p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td width="56"><form  action="Garden_rep17_xls.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh"   value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="nah_kesh"   value="<?php echo  $nah_kesh ;?>" />
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
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                 <td width="56"><form  action="Garden_rep17_doc.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh"   value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="nah_kesh"   value="<?php echo  $nah_kesh ;?>" />
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
                   <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
                 </form></td>

               </tr>
             </table>
             <br />
            <table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td colspan="2" rowspan="3" bgcolor="#006699">عملیات</td>
                <td width="6%" rowspan="3" bgcolor="#006699">نام محصول</td>
          <td colspan="2" bgcolor="#006699">میزان محصول / تن</td>
          <td colspan="6" bgcolor="#006699">مساحت/هکتار</td>
          <td width="5%" rowspan="3" bgcolor="#006699">نحوه کاشت</td>
          <td colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="4%" rowspan="3" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="8%" rowspan="2" bgcolor="#006699">قطعی</td>
          <td width="8%" rowspan="2" bgcolor="#006699">پیش بینی</td>
          <td colspan="3" bgcolor="#006699">تعداد درخت</td>
          <td  colspan="3" bgcolor="#006699">سطح زیر کشت</td>
          <td width="9%"  rowspan="2" bgcolor="#006699" class="style8"><img src="../../files/sort.png" width="15" height="24"  alt=""/><span class="text1"> کد ملی</span></td>
          <td width="10%" rowspan="2" bgcolor="#006699">نام و نام خانوادگی</td>
          </tr>
        <tr class="text1">
          <td width="5%" bgcolor="#006699">کل</td>
          <td width="5%" bgcolor="#006699">غیر بارور</td>
          <td width="6%" bgcolor="#006699">بارور </td>
          <td width="6%"  bgcolor="#006699">کل</td>
          <td width="7%" bgcolor="#006699">غیر بارور</td>
          <td width="8%" bgcolor="#006699">بارور </td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
  ?>
          <td width="6%" height="53" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>  <form  action="../send_pm1.php#1" method="post" onsubmit="target_popup2(this)">
     <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
     <button><img src="../../files/receive_mail.png" width="23" height="25" title="ارسال پیام " /></button>
     </form></td>
          <td width="7%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Gardendata_view1.php" method="post" onsubmit="target_popup2(this)">
              <input type="hidden" name="id"  value="<?php echo $row['Garden_id'] ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="27" height="23"  alt=""/></button>
          </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name_bagh($row['cod_mah']) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tol'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tolp'] ; ?></td>
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
    <form  action="Garden_rep17.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
        <input type="hidden" name="nah_kesh"   value="<?php echo  $nah_kesh ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
        <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
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
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="Garden_rep17.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
        <input type="hidden" name="nah_kesh"   value="<?php echo  $nah_kesh ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
        <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
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
      <li class='current'><form  action="Garden_rep17.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
         <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
        <input type="hidden" name="nah_kesh"   value="<?php echo  $nah_kesh ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
        <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
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