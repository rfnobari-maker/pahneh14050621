<?php 
include('../../lock_Sc.php');
include('../../event.php');
include('counter15.php');

if(isset($_POST['id_ostan']))  $id_ostan1 = $_POST['id_ostan'] ;
if(isset($_POST['id_city5']))  $id_city   = $_POST['id_city5'] ;
if(isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'] ; 
if(isset($_POST['add_abadi']))
{
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $y_prod = $_POST['y_prod'] ;
 $no_mush = $_POST['no_mush'] ;
 $m_fani = $_POST['m_fani'] ;
 $v_unit = $_POST['v_unit'] ;
 $nt_comp = $_POST['nt_comp'] ;
 $comp1 = $_POST['comp1'] ;
 $comp2 = $_POST['comp2'] ;
 $t_dpar1 = $_POST['t_dpar1'] ;
 $t_dpar2 = $_POST['t_dpar2'] ;
 $zer_kesh1 = $_POST['zer_kesh1'] ;
 $zer_kesh2 = $_POST['zer_kesh2'] ;
 $mah_tol1 = $_POST['mah_tol1'] ;
 $mah_tol2 = $_POST['mah_tol2'] ;
 $tol_avg1 = $_POST['tol_avg1'] ;
 $tol_avg2 = $_POST['tol_avg2'] ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
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
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_po3(form) {
    window.open('null', 'formpopup', 'width=950,height=1400,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
      <span class="style8">گزارش اختصاصی عملکرد واحد های پرورش قارچ</span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="683" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="206" height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="y_prod" class="input_text  required" id="y_prod" style="height:40px ; width:170px ; direction:rtl" tabindex="2">
                     <option value="1402" <?php if ($y_prod=='1402') echo 'selected=selected'?>>1402</option>
                     <option value="1401" <?php if ($y_prod=='1401') echo 'selected=selected'?>>1401</option>
                     <option value="1400" <?php if ($y_prod=='1400') echo 'selected=selected'?>>1400</option>
                     <option value="1399" <?php if ($y_prod=='1399') echo 'selected=selected'?>>1399</option>
                     <option value="1398" <?php if ($y_prod=='1398') echo 'selected=selected'?>>1398</option>
                     <option value="1397" <?php if ($y_prod=='1397') echo 'selected=selected'?>>1397</option>
                   </select>
                 </div></td>
                 <td width="136"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: سال </td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                 <?php $id_ostan1 = $id_ostan ; ?>
                 <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" tabindex="1" dir="rtl"  onchange="this.form.submit()">
                  <option value="-1">انتخاب استان</option>
                  <?php
$query = "SELECT id_ostan,ostan FROM ostanname  ORDER BY BINARY ostan ASC "  ;
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
                 <td height="41" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td height="41" align="right" bgcolor="#FFFFFF" class="style1" >&nbsp;</td>
                 <td width="215" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_city5" disabled="disabled" class="style8" id="id_city" style="width:170px ; height:40px" tabindex="3" dir="rtl"  onchange="this.form.submit()">
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
                 <td width="143"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" tabindex="5" dir="rtl"   >
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
                 <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="id_mar" class="input_text" id="id_mar" style="width:170px ; height:40px" tabindex="4" dir="rtl" onchange="this.form.submit()">
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
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" tabindex="6" dir="rtl"   >
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
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " tabindex="8" value="<?php echo $bah_cod_m?>" />
                   </div></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: کد ملی بهره بردار</font></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m"  style="height:35px ; width:170px " tabindex="7" value="<?php echo $mor_cod_m?>" />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">: کد ملی مروج</font></td>
           </tr>
               <tr >
<td height="52" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
  <select name="m_fani" class="input_text required " id="seeAnotherField"  style="height:40px ; width:100px ; direction:rtl" tabindex="10">
    <option value="">انتخاب کنید</option>
    <option value="1" <?php if ($m_fani=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
    <option value="2" <?php if ($m_fani=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
  </select>
</div></td>
                 <td height="52" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">: مسئول فنی</font></td>
                 <td width="215" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="no_mush" class="input_text  required" id="no_mush"  style="height:40px ; width:170px ; direction:rtl" tabindex="9">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($no_mush=='1') { echo 'selected="selected"' ; } ?>>صدفی</option>
                     <option value="2" <?php if ($no_mush=='2') { echo 'selected="selected"' ; } ?>>دکمه ای</option>
                     <option value="3" <?php if ($no_mush=='3') { echo 'selected="selected"' ; } ?>>سایر قارچ های پرورشی خاص</option>
                   </select>
                 </div></td>
                 <td width="143"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">نوع قارچ پرورشی</font></td>
               </tr>

                 <tr>
                   <td height="50" align="right"  bgcolor="#FFFFFF" class="style8" ><div align="right">
                     <select name="nt_comp" class="input_text  required" id="nah_kesh"  style="height:40px ; width:170px ; direction:rtl" tabindex="12">
                       <option value="0">انتخاب کنید</option>
                       <option value="1"<?php if($nt_comp=="1") echo "selected='selected'"?>>خود مصرفی</option>
                       <option value="2"<?php if($nt_comp=="2") echo "selected='selected'"?>>خریداری شده</option>
                       <option value="3"<?php if($nt_comp=="3") echo "selected='selected'"?>>ترکیبی</option>
                     </select>
                   </div></td>
                   <td height="50" align="right"  bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">:نحوه تامین کمپوست</font></td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="v_unit" class="input_text  required" id="v_unit" style="height:40px ; width:200px ; direction:rtl"   tabindex="11">
                     <option value="">انتخاب کنید</option>
                     <option value="1"<?php if($v_unit == '1') echo "selected='selected'" ?> >فعال</option>
                     <option value="2"<?php if($v_unit == '2') echo "selected='selected'" ?>>در حال اخذ پروانه تاسیس</option>
                     <option value="3"<?php if($v_unit == '3') echo "selected='selected'" ?>>دارای پیشرفت فیزیکی</option>
                     <option value="4"<?php if($v_unit == '4') echo "selected='selected'" ?>>غیرفعال</option>
                   </select>
                 </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">:وضعیت واحد</font></td>
               </tr>
               
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">تن در سال </span>
                     <input name="comp2" type="text" class="input_text" id="comp2"  style="height:35px ; width:70px " tabindex="14" value="<?php echo $comp2?>" />
                   </div></td>
                   <td height="50"  align='center' bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">: کوچکتر یا مساوی</font></td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">تن در سال  </span>
                     <input name="comp1" type="text" class="input_text" id="comp1"  style="height:35px ; width:70px " tabindex="13" value="<?php echo $comp1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">میزان کمپوست مصرفی <br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">دوره در سال </span>
                     <input name="t_dpar2" type="text" class="input_text" id="t_dpar2"  style="height:35px ; width:70px "  tabindex="16" value="<?php echo $t_dpar2?>" max="8" min="1" maxlength="1" />
                   </div></td>
                   <td height="50"  align='center' bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: کوچکتر یا مساوی</font></td>                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">دوره در سال </span>
                     <input name="t_dpar1" type="text" class="input_text" id="t_dpar1"  style="height:35px ; width:70px " tabindex="15" value="<?php echo $t_dpar1?>" max="8" min="1"  maxlength="1" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">تعداد دوره پرورشی<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">مترمربع </span>
                   <input name="zer_kesh2" type="text" class="input_text" id="zer_kesh2"  style="height:35px ; width:70px " tabindex="18" value="<?php echo $zer_kesh2?>" />
                   </div></td>
                   <td height="50"  align='center' bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">: کوچکتر یا مساوی</font></td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">مترمربع </span>
                   <input name="zer_kesh1" type="text" class="input_text" id="zkb4"  style="height:35px ; width:70px " tabindex="17" value="<?php echo $zer_kesh1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">سطح زیر کشت <br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">تن </span>
                     <input name="mah_tol2" type="text" class="input_text" id="mah_tol2"  style="height:35px ; width:70px " tabindex="20" value="<?php echo $mah_tol2?>" />
                   </div></td>
                   <td height="50"  align='center' bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: کوچکتر یا مساوی</font></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">تن </span>
                     <input name="mah_tol1" type="text" class="input_text" id="mtol4"  style="height:35px ; width:70px " tabindex="19" value="<?php echo $mah_tol1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">کل تولید سالانه<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"><span class="style2">کیلوگرم / مترمربع</span>
                   <input name="tol_avg2" type="text" class="input_text" id="tol_avg2"  style="height:35px ; width:70px " tabindex="22" value="<?php echo $tol_avg2?>" />
                   </div></td>
                   <td height="50"  align='center' bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">: کوچکتر یا مساوی</font></td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <span class="style2">کیلوگرم / مترمربع</span>
                   <input name="tol_avg1" type="text" class="input_text" id="tol_avg1"  style="height:35px ; width:70px " tabindex="21" value="<?php echo $tol_avg1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">عملکرد سالانه<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="23" value='اجرای کوئری' />
                   </td>
               </tr>
             </table> 
           </div>
 </form>
             <p>
               <?php
 if (isset($_POST['action'])) 
 {  
 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($no_mush == '')  { $f_no_mush  = 1  ; }else{ $f_no_mush = "no_mush = '$no_mush'" ;}
 if ($v_unit == '')  { $f_v_unit  = 1  ; }else{ $f_v_unit = "v_unit = '$v_unit'" ;}
 if ($m_fani == '')  { $f_m_fani  = 1  ; }else{ $f_m_fani = "m_fani = '$m_fani'" ;}
 if ($nt_comp == '0')  { $f_nt_comp  = 1  ; }else{ $f_nt_comp = "nt_comp = '$nt_comp'" ;}
 if ($comp1 == '')  { $v_comp1  = 1  ; }else{ $v_comp1 = "comp >= $comp1" ;}
 if ($comp2 == '')  { $v_comp2  = 1  ; }else{ $v_comp2 = "comp <= $comp2" ;}
 if ($t_dpar1 == '')  { $v_t_dpar1 = 1  ; }else{ $v_t_dpar1  = "t_dpar >= $t_dpar1" ;}
 if ($t_dpar2 == '')  { $v_t_dpar2  = 1  ; }else{ $v_t_dpar2 = "t_dpar <= $t_dpar2" ;}
 if ($zer_kesh1 == '')  { $v_zer_kesh1 = 1  ; }else{ $v_zer_kesh1  = "zer_kesh >= $zer_kesh1" ;}
 if ($zer_kesh2 == '')  { $v_zer_kesh2  = 1  ; }else{ $v_zer_kesh2 = "zer_kesh <= $zer_kesh2" ;}
 if ($mah_tol1 == '')  { $v_mah_tol1  = 1  ; }else{ $v_mah_tol1 = "mah_tol >= $mah_tol1" ;}
 if ($mah_tol2 == '')  { $v_mah_tol2  = 1  ; }else{ $v_mah_tol2 = "mah_tol <= $mah_tol2" ;}
 if ($tol_avg1 == '')  { $v_tol_avg1  = 1  ; }else{ $v_tol_avg1 = "tol_avg >= $tol_avg1" ;}
 if ($tol_avg2 == '')  { $v_tol_avg2  = 1  ; }else{ $v_tol_avg2 = "tol_avg <= $tol_avg2" ;}
 include('../../login/config.php');
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $query = " SELECT id,num_bah,bah_cod_m,mor_cod_m,unit_id,t_zan,t_mar,m_fani,no_mush,comp,nt_comp
 ,t_dpar,zer_kesh,mah_tol,tol_avg,v_unit from Mushroom_prod
where  $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and y_prod = '$y_prod' and 
$f_no_mush and $f_v_unit and $f_m_fani and $v_t_dpar1 and $v_t_dpar2 and $v_comp1 and $v_comp2 and $f_nt_comp and 
$v_zer_kesh1 and $v_zer_kesh2 and $v_mah_tol1 and $v_mah_tol2 and $v_tol_avg1 and $v_tol_avg2
and $v_bah_cod_m and $v_mor_cod_m  ORDER BY bah_cod_m ASC LIMIT $start, $limit "; 

$query1 = "SELECT id from Mushroom_prod
where  $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and y_prod = $y_prod and 
$f_no_mush and $f_v_unit and $f_m_fani and $v_t_dpar1 and $v_t_dpar2 and $v_comp1 and $v_comp2 and $f_nt_comp and 
$v_zer_kesh1 and $v_zer_kesh2 and $v_mah_tol1 and $v_mah_tol2 and $v_tol_avg1 and $v_tol_avg2 and $v_bah_cod_m and $v_mor_cod_m "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <span class="style1"><a name="1" id="1"></a></span><br />
             </p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form  action="Mush_rep1_xls.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                   <input type="hidden" name="no_mush"   value="<?php echo  $no_mush ;?>" />
                   <input type="hidden" name="y_prod"    value="<?php echo  $y_prod ;?>" />
                   <input type="hidden" name="m_fani"    value="<?php echo  $m_fani ;?>" />
                   <input type="hidden" name="comp1"     value="<?php echo  $comp1 ;?>" />
                   <input type="hidden" name="comp2"     value="<?php echo  $comp2 ;?>" />
                   <input type="hidden" name="nt_comp"   value="<?php echo  $nt_comp ;?>" />
                   <input type="hidden" name="t_dpar1"   value="<?php echo $t_dpar1 ;?>" />
                   <input type="hidden" name="t_dpar2"   value="<?php echo $t_dpar2 ;?>" />
                   <input type="hidden" name="zer_kesh1" value="<?php echo $zer_kesh1 ;?>" />
                   <input type="hidden" name="zer_kesh2" value="<?php echo $zer_kesh2 ;?>" />
                   <input type="hidden" name="mah_tol1"  value="<?php echo $mah_tol1 ;?>" />
                   <input type="hidden" name="mah_tol2"  value="<?php echo $mah_tol2 ;?>" />
                   <input type="hidden" name="tol_avg1"  value="<?php echo $tol_avg1 ;?>" />
                   <input type="hidden" name="tol_avg2"  value="<?php echo $tol_avg2 ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
             <br />
            <table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td colspan="2" rowspan="2" bgcolor="#006699">عملیات</td>
                <td width="7%" rowspan="2" bgcolor="#006699">عملکرد تولید<span class="style2"><br />
                  کیلوگرم / مترمربع</span></td>
          <td width="5%" rowspan="2" bgcolor="#006699"><p>کل تولید <span class="style2">تن</span></p></td>
          <td width="6%" rowspan="2" bgcolor="#006699">سطح زیر کشت<br />
            <span class="style2">مترمربع</span></td>
          <td width="6%" rowspan="2" bgcolor="#006699"><p>تعداد دوره پرورشی</p></td>
          <td width="8%" rowspan="2" bgcolor="#006699">نحوه تامین کمپوست</td>
          <td width="7%" rowspan="2" bgcolor="#006699"><p>کمپوست مصرفی<br />
              <span class="style2">تن / سال</span> </p></td>
          <td width="6%" rowspan="2" bgcolor="#006699">نوع قارچ</td>
          <td width="7%" rowspan="2" bgcolor="#006699">مسئول فنی</td>
          <td width="8%" rowspan="2" bgcolor="#006699"><p>تعداد شاغل<br />
              <span class="style2">نفر</span> </p></td>
          <td colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="10%" bgcolor="#006699" class="style8"><img src="../../files/sort.png" width="15" height="24"  alt=""/><span class="text1"> کد ملی</span></td>
          <td width="14%" bgcolor="#006699">نام و نام خانوادگی</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 

if ($row['no_mush']=='1')  $v_no_mush='صدفی';
if ($row['no_mush']=='2')  $v_no_mush='دکمه ای';
if ($row['no_mush']=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';

if ($row['m_fani']=='1')  $v_m_fani='دارد';
if ($row['m_fani']=='2')  $v_m_fani='ندارد';

if ($row['nt_comp']=='1')  $v_nt_comp='خود مصرفی';
if ($row['nt_comp']=='2')  $v_nt_comp='خریداری شده';
if ($row['nt_comp']=='3')  $v_nt_comp='ترکیبی';



  ?>
          <td width="6%" height="53" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="../send_pm1.php#1" method="post" onsubmit="target_po3(this)">
            <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
            <button><img src="../../files/receive_mail.png" width="23" height="25" title="ارسال پیام " /></button>
            </form></td>
          <td width="6%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
           <form  action="Mushdata_prod_view.php" method="post"  onsubmit="target_po3(this)">
                  <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
                  <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
                  <input type="hidden" name="unit_id" value="<?php echo $row['unit_id']  ;?>" />
                  <input type="hidden" name="y_prod" value="<?php echo $y_prod  ;?>" />
                  <input type="hidden" name="v_unit" value="<?php echo $row['v_unit']  ;?>" />
                  <input type="hidden" name="num_bah" value="<?php echo $row['num_bah']  ;?>" />
                  <button><img src="../../files/view.png" title="نمایش اطلاعات عملکرد واحد"  width="20" height="20"  alt=""/></button>
                </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tol_avg'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tol']*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesh']*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dpar'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_nt_comp ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['comp']*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mush;  ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_fani ; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_mar'] + $row['t_zan'] ?></td>
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
    <form  action="Mush_rep1.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_mush"   value="<?php echo  $no_mush ;?>" />
        <input type="hidden" name="y_prod"    value="<?php echo  $y_prod ;?>" />
        <input type="hidden" name="m_fani"    value="<?php echo  $m_fani ;?>" />
        <input type="hidden" name="comp1"     value="<?php echo  $comp1 ;?>" />
        <input type="hidden" name="comp2"     value="<?php echo  $comp2 ;?>" />
        <input type="hidden" name="nt_comp"   value="<?php echo  $nt_comp ;?>" />
        <input type="hidden" name="t_dpar1"   value="<?php echo $t_dpar1 ;?>" />
        <input type="hidden" name="t_dpar2"   value="<?php echo $t_dpar2 ;?>" />
        <input type="hidden" name="zer_kesh1" value="<?php echo $zer_kesh1 ;?>" />
        <input type="hidden" name="zer_kesh2" value="<?php echo $zer_kesh2 ;?>" />
        <input type="hidden" name="mah_tol1"  value="<?php echo $mah_tol1 ;?>" />
        <input type="hidden" name="mah_tol2"  value="<?php echo $mah_tol2 ;?>" />
        <input type="hidden" name="tol_avg1"  value="<?php echo $tol_avg1 ;?>" />
        <input type="hidden" name="tol_avg2"  value="<?php echo $tol_avg2 ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="Mush_rep1.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_mush"   value="<?php echo  $no_mush ;?>" />
        <input type="hidden" name="y_prod"    value="<?php echo  $y_prod ;?>" />
        <input type="hidden" name="m_fani"    value="<?php echo  $m_fani ;?>" />
        <input type="hidden" name="comp1"     value="<?php echo  $comp1 ;?>" />
        <input type="hidden" name="comp2"     value="<?php echo  $comp2 ;?>" />
        <input type="hidden" name="nt_comp"   value="<?php echo  $nt_comp ;?>" />
        <input type="hidden" name="t_dpar1"   value="<?php echo $t_dpar1 ;?>" />
        <input type="hidden" name="t_dpar2"   value="<?php echo $t_dpar2 ;?>" />
        <input type="hidden" name="zer_kesh1" value="<?php echo $zer_kesh1 ;?>" />
        <input type="hidden" name="zer_kesh2" value="<?php echo $zer_kesh2 ;?>" />
        <input type="hidden" name="mah_tol1"  value="<?php echo $mah_tol1 ;?>" />
        <input type="hidden" name="mah_tol2"  value="<?php echo $mah_tol2 ;?>" />
        <input type="hidden" name="tol_avg1"  value="<?php echo $tol_avg1 ;?>" />
        <input type="hidden" name="tol_avg2"  value="<?php echo $tol_avg2 ;?>" />
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
      <li class='current'><form  action="Mush_rep1.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_mush"   value="<?php echo  $no_mush ;?>" />
        <input type="hidden" name="y_prod"    value="<?php echo  $y_prod ;?>" />
        <input type="hidden" name="m_fani"    value="<?php echo  $m_fani ;?>" />
        <input type="hidden" name="comp1"     value="<?php echo  $comp1 ;?>" />
        <input type="hidden" name="comp2"     value="<?php echo  $comp2 ;?>" />
        <input type="hidden" name="nt_comp"   value="<?php echo  $nt_comp ;?>" />
        <input type="hidden" name="t_dpar1"   value="<?php echo $t_dpar1 ;?>" />
        <input type="hidden" name="t_dpar2"   value="<?php echo $t_dpar2 ;?>" />
        <input type="hidden" name="zer_kesh1" value="<?php echo $zer_kesh1 ;?>" />
        <input type="hidden" name="zer_kesh2" value="<?php echo $zer_kesh2 ;?>" />
        <input type="hidden" name="mah_tol1"  value="<?php echo $mah_tol1 ;?>" />
        <input type="hidden" name="mah_tol2"  value="<?php echo $mah_tol2 ;?>" />
        <input type="hidden" name="tol_avg1"  value="<?php echo $tol_avg1 ;?>" />
        <input type="hidden" name="tol_avg2"  value="<?php echo $tol_avg2 ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
          <p><a href="Mushroom.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>