<?php 
include('../../lock_p1.php');
include('../../event.php');
if(isset($_POST['id_ostan'])) { $id_ostan1 = $_POST['id_ostan']  ; };
if(isset($_POST['id_city5'])) { $id_city = $_POST['id_city5']    ; };
if(isset($_POST['id_mar']))   { $id_mar = $_POST['id_mar']       ; };
if(isset($_POST['no_mtol']))  { $no_mtol = $_POST['no_mtol']     ; };
if(isset($_POST['no_saz']))   { $no_saz = $_POST['no_saz']       ; };
if(isset($_POST['no_gol']))   { $no_gol = $_POST['no_gol']       ; };
if(isset($_POST['sys_kesh'])) { $sys_kesh = $_POST['sys_kesh']   ; };
if(isset($_POST['sys_hot']))  { $sys_hot = $_POST['sys_hot']     ; };
if(isset($_POST['no_mal']))   { $no_mal = $_POST['no_mal']       ; };
if(isset($_POST['mor_cod_m'])){ $mor_cod_m = $_POST['mor_cod_m'] ; };
if(isset($_POST['bah_cod_m'])){ $bah_cod_m = $_POST['bah_cod_m'] ; };
if(isset($_POST['sal']))      { $sal = $_POST['sal']             ; };
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	width:50px
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
     <P>&nbsp;</p>
   <form  id="reg-form" method="post" action="#1">
             <div style="width: 600px; padding: 5px; border: 3px solid navy; margin: auto; text-align: left; border-radius:15px" >
             <table width="100%" height="437" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="48" colspan='4' align='center' bgcolor="#FFFFFF"><span class="style1">لیست گلخانه داران</span></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="58" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="sal" class="input_text  required" id="sal" style="height:40px ; width:100PX ; direction:rtl" tabindex="2">
                     <option value="1398" <?php if ($sal=='1398') echo 'selected=selected'?>>1398</option>
                     <option value="1397" <?php if ($sal=='1397') echo 'selected=selected'?>>1397</option>
                     <option value="1396" <?php if ($sal=='1396') echo 'selected=selected'?>>1396</option>
                     <option value="1395" <?php if ($sal=='1395') echo 'selected=selected'?>>1395</option>
                     <option value="1394" <?php if ($sal=='1394') echo 'selected=selected'?>>1394</option>
                   </select>
                 </div></td>
                 <td height="58" align="right" bgcolor="#DDDDDD" class="input_text" ><font size="2" class="style8">: سال </font></td>
                 <td height="58" align="right" bgcolor="#DDDDDD" class="input_text" >
                 <?php $id_ostan1 = $id_ostan ?>
                      <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                   <option value="-1">انتخاب استان</option>

                   <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
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
                 <td width="194" height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_mar" disabled="disabled" class="style8" id="bakh" style="width:150PX ; height:40px" tabindex="4" dir="rtl">
                   <option value="0"> نام مرکز</option>
                   <?php
$query = "SELECT  id_mar,mar FROM `mar` WHERE  `id_ostan` = $id_ostan1 and `id_city` = $id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
                   <?php }?>
                 </select>
                   <input name="id_city2" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td width="96" align="center" bgcolor="#FFFFFF" class="input_text" ><span class="style1"><font size="2" class="style8">: مرکز خدمات</font></span></td>
                 <td width="198" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_city5" disabled="disabled" class="style8" id="id_city" style="width:150px ; height:40px" tabindex="3" dir="rtl"  onchange="this.form.submit()">
                   <option value="0"> کل استان</option>
                   <?php
$query = "SELECT DISTINCT id_city,city FROM `list_abadi` WHERE  `id_ostan` = $id_ostan1 ORDER BY BINARY city"  ;
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
                 <td width="112"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="sys_kesh" class="input_text  required" id="sys_kesh"  style="height:40px ; width:150px ; direction:rtl" tabindex="20">
                     <option value="0">انتخاب کنید</option>
                    <option value="1" <?php if ($sys_kesh=='1') { echo 'selected="selected"' ; } ?>>خاکی</option>
                    <option value="2" <?php if ($sys_kesh=='2') { echo 'selected="selected"' ; } ?>>هیدروپونیک</option>
                   </select>
                 </div></td>
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><font size="2" class="style8">:سیستم کشت</font></td>
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <!--<form action="" method="post" name="form_kesh"> -->
                   <select name="no_mtol" class="input_text  required" id="no_mtol" style="height:40px ; width:170px ; direction:rtl" tabindex="3" >
                     <option value="0">انتخاب کنید</option>
                     <option value="1" <?php if ($no_mtol=='1') { echo 'selected="selected"' ; } ?>>سبزی و صیفی</option>
                     <option value="2" <?php if ($no_mtol=='2') { echo 'selected="selected"' ; } ?>>گل و گیاه زینتی فضای گلخانه </option>
                     <option value="4" <?php if ($no_mtol=='4') { echo 'selected="selected"' ; } ?>>گل و گیاه زینتی فضای باز </option>
                     <option value="5" <?php if ($no_mtol=='5') { echo 'selected="selected"' ; } ?>>گل و گیاه زینتی فضای توام</option>
                     <option value="3" <?php if ($no_mtol=='3') { echo 'selected="selected"' ; } ?>>سایر</option>
                   </select>
                   <!--< </form> -->
                 </div></td>
                 <td height="47"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">:نوع محصول</font></td>
               </tr>
               <tr >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="no_gol" class="input_text required " id="no_gol"  style="height:40px ; width:150px ; direction:rtl" tabindex="6">
                     <option value="0">انتخاب کنید</option>
                    <option value="1" <?php if ($no_gol=='1') { echo 'selected="selected"' ; } ?>>تونلی تک قلو</option>
                    <option value="2" <?php if ($no_gol=='2') { echo 'selected="selected"' ; } ?>>تونلی بهم پیوسته</option>
                    <option value="3" <?php if ($no_gol=='3') { echo 'selected="selected"' ; } ?>>یک طرفه</option>
                    <option value="4" <?php if ($no_gol=='4') { echo 'selected="selected"' ; } ?>>شیشه ای سقف شیروانی</option>                   </select>
                 </div></td>
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><font size="2" class="style8">:نوع گلخانه</font></td>
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="no_saz" class="input_text required " id="no_saz"  style="height:40px ; width:150px ; direction:rtl" tabindex="12">
                     <option value="0">انتخاب کنید</option>
                    <option value="1" <?php if ($no_saz=='1') { echo 'selected="selected"' ; } ?>>فلزی با پوشش پلاستیکی</option>
                    <option value="2" <?php if ($no_saz=='2') { echo 'selected="selected"' ; } ?>>فلزی با پوشش پلی کربنات</option>
                    <option value="3" <?php if ($no_saz=='3') { echo 'selected="selected"' ; } ?>>فلزی با پوشش شیشه ای</option>
                    <option value="4" <?php if ($no_saz=='4') { echo 'selected="selected"' ; } ?>>چوبی پلاستیکی</option>
                   </select>
                 </div></td>
                 <td height="47"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8">:نوع سازه</font></td>
               </tr>
               <tr >
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="sys_hot" class="input_text  required" id="sys_hot"  style="height:40px ; width:150px ; direction:rtl" tabindex="8">
                     <option value="0">انتخاب کنید</option>
                    <option value="1" <?php if ($sys_hot=='1') { echo 'selected="selected"' ; } ?>>حرارت مرکزی</option>
                    <option value="2" <?php if ($sys_hot=='2') { echo 'selected="selected"' ; } ?>>هیتر یا بخاری</option>
                    <option value="3" <?php if ($sys_hot=='3') { echo 'selected="selected"' ; } ?>>تشعشعی</option>
                   </select>
                 </div></td>
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><span class="style1"><font size="2" class="style8">: </font></span><span style="font-family: Tahoma; color: #003366;"><font size="2" style="text-decoration: none; font-family: Tahoma; color: #990000;">سیستم گرمایشی</font></span></td>
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="no_mal" class="input_text  required" id="no_mal" style="height:40px ; width:150px ; direction:rtl" tabindex="7">
                     <option value="0">انتخاب کنید</option>
                     <option value="1" <?php if ($no_mal=='1') { echo 'selected="selected"' ; } ?>>سند ششدانگ</option>
                     <option value="2" <?php if ($no_mal=='2') { echo 'selected="selected"' ; } ?>>سند مشاعی</option>
                     <option value="3" <?php if ($no_mal=='3') { echo 'selected="selected"' ; } ?>>اصلاحات اراضی</option>
                     <option value="4" <?php if ($no_mal=='4') { echo 'selected="selected"' ; } ?>>موقوفه</option>
                     <option value="5" <?php if ($no_mal=='5') { echo 'selected="selected"' ; } ?>>واگذاری</option>
                     <option value="6" <?php if ($no_mal=='6') { echo 'selected="selected"' ; } ?>>قولنامه</option>
                     <option value="7" <?php if ($no_mal=='7') { echo 'selected="selected"' ; } ?>>اجاره</option>
                     </select>
                   </div></td>
                 <td height="47"  align='center' bgcolor="#DDDDDD" class="style8"><span class="style1"><font size="2" class="style8">: نوع مالکیت</font></span></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"><span style="text-align: right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:150PX " tabindex="10" value="<?php echo $bah_cod_m ?>" />
                 </span></div>                </td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><span class="style1"><font size="2" class="style8">: کد ملی بهره بردار</font></span></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"><span style="text-align: right">
                   <input name="mor_cod_m" type="text" class="style8"  style="height:35px ; width:170px " value="<?php echo $login_session ?>" readonly="readonly" />
                 </span></div></td>
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="style8"><span class="style1"><font size="2" class="style8">: کد ملی مروج</font></span></td>
               </tr>
               <tr >
                 <td colspan="3" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="11" value='جستجو' />
                   </td>
                 <td height="60"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
               </tr>
             </table> 
             </div>
   </form>
             <?php
 if (isset($_POST['action'])) 
 {  
$_SESSION["id_ostan1"]  = $_POST['id_ostan'] ; 
$_SESSION["id_city"] = $_POST['id_city5'] ; 
$_SESSION["id_mar"] = $_POST['id_mar'] ; 
$_SESSION["no_mtol"] = $_POST['no_mtol'] ; 
$_SESSION["no_saz"] = $_POST['no_saz'] ; 
$_SESSION["no_gol"] = $_POST['no_gol'] ; 
$_SESSION["sys_kesh"] = $_POST['sys_kesh'] ; 
$_SESSION["sys_hot"] = $_POST['sys_hot'] ; 
$_SESSION["no_mal"] = $_POST['no_mal'] ; 
$_SESSION["mor_cod_m"] = $_POST['mor_cod_m'] ; 
$_SESSION["bah_cod_m"] = $_POST['bah_cod_m'] ; 
$_SESSION["sal"] = $_POST['sal'] ; 

if ($id_ostan1 == '-1'){ $v_id_ostan   = 1  ;}else{ $v_id_ostan  = "id_ostan='$id_ostan1'" ;}
if ($id_city == 0)     { $v_id_city    = 1  ;}else{ $v_id_city   = "id_city='$id_city'" ;}
if ($id_mar  == 0)     { $v_id_mar     = 1  ;}else{ $v_id_mar    = "id_mar='$id_mar'" ;}
if ($no_mal  == '0')   { $f_no_mal     = 1  ;}else{ $f_no_mal    = "no_mal = '$no_mal'" ;}
if ($no_mtol == '0')   { $f_no_mtol    = 1  ;}else{ $f_no_mtol   = "no_mtol = '$no_mtol'" ;}
if ($no_saz == '0')    { $f_no_saz     = 1  ;}else{ $f_no_saz    = "no_saz = '$no_saz'" ;}
if ($no_gol == '0')    { $f_no_gol     = 1  ;}else{ $f_no_gol    = "no_gol = '$no_gol'" ;}
if ($sys_kesh == '0')  { $f_sys_kesh   = 1  ;}else{ $f_sys_kesh  = "sys_kesh = '$sys_kesh'" ;}
if ($sys_hot == '0')   { $f_sys_hot    = 1  ;}else{ $f_sys_hot   = "sys_hot = '$sys_hot'" ;}
if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ;}else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ;}else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
if ($sal == '')        { $v_sal        = 1  ;}else{ $v_sal       = "sal = '$sal'" ;}
$start=0;
$limit=15;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $query = "SELECT id,id_ostan,id_city,id_mar,no_mtol,no_saz,no_gol,sys_kesh,mor_cod_m,bah_cod_m,sal,no_mal,m_zamin,m_zamin_baz,add_abadi,add_city,num_bah from Greenhous where $v_id_ostan  and $v_id_city and  $v_id_mar  and $f_no_mtol and $f_no_saz and $f_no_gol and $f_sys_kesh and $f_sys_hot and $f_no_mal and $v_mor_cod_m and $v_bah_cod_m and $v_sal  ORDER BY mor_cod_m ASC LIMIT $start, $limit "; 
 $query1 = "SELECT id_ostan,id_city,id_mar,no_mtol,no_saz,no_gol,sys_kesh,mor_cod_m,bah_cod_m,sal,no_mal,m_zamin,add_abadi,add_city from Greenhous where $v_id_ostan  and $v_id_city and  $v_id_mar  and $f_no_mtol and $f_no_saz and $f_no_gol and $f_sys_kesh and $f_sys_hot and $f_no_mal and $v_mor_cod_m and $v_bah_cod_m and  $v_sal  ORDER BY mor_cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p><form  action="Greenhous_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php  echo $id_city ;?>" />
        <input type="hidden" name="id_mar" value="<?php  echo $id_mar ;?>" />
        <input type="hidden" name="no_mal" value="<?php   echo $no_mal ;?>" />
        <input type="hidden" name="no_mtol" value="<?php  echo $no_mtol ;?>" />
        <input type="hidden" name="no_saz" value="<?php  echo $no_saz ;?>" />
        <input type="hidden" name="no_gol" value="<?php  echo $no_gol ;?>" />
        <input type="hidden" name="sys_kesh" value="<?php  echo $sys_kesh ;?>" />
        <input type="hidden" name="sys_hot" value="<?php  echo $sys_hot ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php  echo $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php  echo $bah_cod_m ;?>" />
        <input type="hidden" name="sal" value="<?php  echo $sal ;?>" />
        <button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="42" height="47"  alt=""/></button>
        <span class="style1"><span class="style8"><a name="1" id="1"></a></span></span>
           </form></p>
      <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td colspan="3" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="8%" rowspan="2" bgcolor="#006699">مساحت فضای باز<br />
            <span class="style2">مترمربع</span></td>
          <td width="8%" rowspan="2" bgcolor="#006699">مساحت گلخانه<br />
            <span class="style2">مترمربع</span></td>
          <td width="9%" rowspan="2" bgcolor="#006699">نوع گلخانه</td>
          <td width="8%" rowspan="2" bgcolor="#006699">نوع سازه</td>
          <td width="8%" rowspan="2" bgcolor="#006699">سیستم کشت</td>
          <td width="11%" rowspan="2" bgcolor="#006699">نوع محصول</td>
          <td width="5%" rowspan="2" bgcolor="#006699">سال</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="9%" rowspan="2" bgcolor="#006699">شهر/آبادی</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="8%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="12%" bgcolor="#006699">نام و نام خانوادگی</td>
          </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
if ($row['no_mal']=='1') $v_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $v_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $v_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $v_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $v_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $v_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $v_no_mal='اجاره' ;	 
if ($row['no_mtol']=='1')  $v_no_mtol='سبزی و صیفی';
if ($row['no_mtol']=='2')  $v_no_mtol='گل و گیاه زینتی در فضای گلخانه';
if ($row['no_mtol']=='4')  $v_no_mtol='گل و گیاه زینتی در فضای باز ';
if ($row['no_mtol']=='5')  $v_no_mtol='گل و گیاه زینتی در فضای توام';
if ($row['no_mtol']=='3')  $v_no_mtol='سایر' ;	 
if ($row['no_saz']=='') $v_no_saz='' ;	 
if ($row['no_saz']=='1') $v_no_saz='فلزی با پوشش پلاستیکی' ;	 
if ($row['no_saz']=='2') $v_no_saz='فلزی با پوشش پلی کربنات' ;	
if ($row['no_saz']=='3') $v_no_saz='فلزی با پوشش شیشه ای' ;	
if ($row['no_saz']=='4') $v_no_saz='چوبی پلاستیکی' ;	 
if ($row['no_gol']=='') $v_no_gol='' ;	 
if ($row['no_gol']=='1') $v_no_gol='تونلی تک قلو' ;	 
if ($row['no_gol']=='2') $v_no_gol='تونلی به هم پیوسته' ;	
if ($row['no_gol']=='3') $v_no_gol='یک طرفه' ;	
if ($row['no_gol']=='4') $v_no_gol='شیشه ای سقف شیروانی' ;	 
if ($row['sys_kesh']=='') $v_sys_kesh='' ;	 
if ($row['sys_kesh']=='1') $v_sys_kesh='خاکی' ;	 
if ($row['sys_kesh']=='2') $v_sys_kesh='هیدروپونیک' ;	 
  ?>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['sal']=='1398') {?>
            <form  action="del_Greenhous.php" method="post">
              <input type="hidden" name="h_add_abadi" value="<?php echo $add_abadi?>" />
              <input type="hidden" name="h_add_city" value="<?php echo $add_city?>" />
              <input type="hidden" name="h_no_mtol" value="<?php echo $no_mtol?>" />
              <input type="hidden" name="h_no_mal" value="<?php echo $no_mal?>" />
              <input type="hidden" name="h_sal" value="<?php echo $sal?>" />
              <input type="hidden" name="m_page" value="liste_Greenhous.php" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
              <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="sal" value="<?php echo $row['sal']  ;?>" />
              <button onclick="return confirm('از حذف اطلاعات این گلخانه مطمئن هستید ؟ ')"><img src="../../files/del1.png" title="حذف اطلاعات گلخانه" width="33" height="26"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['sal']=='1398') {?>
              <form  action="Greenhous_edit.php" method="post">
              <input type="hidden" name="h_add_abadi" value="<?php echo $add_abadi?>" />
              <input type="hidden" name="h_add_city" value="<?php echo $add_city?>" />
              <input type="hidden" name="h_no_mtol" value="<?php echo $no_mtol?>" />
              <input type="hidden" name="h_no_mal" value="<?php echo $no_mal?>" />
              <input type="hidden" name="h_sal" value="<?php echo $sal?>" />
              <input type="hidden" name="m_page" value="liste_Greenhous.php" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="sal" value="<?php echo $row['sal']  ;?>" />
              <input type="hidden" name="m_poul" value="<?php echo $row['m_poul']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="no_mtol" value="<?php echo $row['no_mtol']  ;?>" />
              <input type="hidden" name="no_mal" value="<?php echo $row['no_mal']  ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="num_bah"  value="<?php echo $row['num_bah'] ;?>" />
              <button><img src="../../files/edit.png" title="ویرایش اطلاعات بهره برداری" width="33" height="26"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <form  action="Greenhous_view.php" method="post">
              <input type="hidden" name="h_add_abadi" value="<?php echo $add_abadi?>" />
              <input type="hidden" name="h_add_city" value="<?php echo $add_city?>" />
              <input type="hidden" name="h_no_mtol" value="<?php echo $no_mtol?>" />
              <input type="hidden" name="h_no_mal" value="<?php echo $no_mal?>" />
              <input type="hidden" name="h_sal" value="<?php echo $sal?>" />
              <input type="hidden" name="m_page" value="liste_Greenhous.php" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="sal" value="<?php echo $row['sal']  ;?>" />
              <input type="hidden" name="m_poul" value="<?php echo $row['m_poul']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="no_mtol" value="<?php echo $row['no_mtol']  ;?>" />
              <input type="hidden" name="no_mal" value="<?php echo $row['no_mal']  ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="num_bah"  value="<?php echo $row['num_bah'] ;?>" />
           <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin_baz']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_gol?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_saz ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_sys_kesh?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mtol?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal']?></td>
          <td height="99" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name($row['bah_cod_m'])?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
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
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="liste_Greenhous.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php  echo $id_city ;?>" />
        <input type="hidden" name="id_mar" value="<?php  echo $id_mar ;?>" />
        <input type="hidden" name="no_mal" value="<?php   echo $no_mal ;?>" />
        <input type="hidden" name="no_mtol" value="<?php  echo $no_mtol ;?>" />
        <input type="hidden" name="no_saz" value="<?php  echo $no_saz ;?>" />
        <input type="hidden" name="no_gol" value="<?php  echo $no_gol ;?>" />
        <input type="hidden" name="sys_kesh" value="<?php  echo $sys_kesh ;?>" />
        <input type="hidden" name="sys_hot" value="<?php  echo $sys_hot ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php  echo $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php  echo $bah_cod_m ;?>" />
        <input type="hidden" name="sal" value="<?php  echo $sal ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="liste_Greenhous.php?id=<?php echo $id+1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php  echo $id_city ;?>" />
        <input type="hidden" name="id_mar" value="<?php  echo $id_mar ;?>" />
        <input type="hidden" name="no_mal" value="<?php   echo $no_mal ;?>" />
        <input type="hidden" name="no_mtol" value="<?php  echo $no_mtol ;?>" />
        <input type="hidden" name="no_saz" value="<?php  echo $no_saz ;?>" />
        <input type="hidden" name="no_gol" value="<?php  echo $no_gol ;?>" />
        <input type="hidden" name="sys_kesh" value="<?php  echo $sys_kesh ;?>" />
        <input type="hidden" name="sys_hot" value="<?php  echo $sys_hot ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php  echo $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php  echo $bah_cod_m ;?>" />
        <input type="hidden" name="sal" value="<?php  echo $sal ;?>" />
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
      <li class='current'><form  action="liste_Greenhous.php?id=<?php echo $i?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php  echo $id_city ;?>" />
        <input type="hidden" name="id_mar" value="<?php  echo $id_mar ;?>" />
        <input type="hidden" name="no_mal" value="<?php   echo $no_mal ;?>" />
        <input type="hidden" name="no_mtol" value="<?php  echo $no_mtol ;?>" />
        <input type="hidden" name="no_saz" value="<?php  echo $no_saz ;?>" />
        <input type="hidden" name="no_gol" value="<?php  echo $no_gol ;?>" />
        <input type="hidden" name="sys_kesh" value="<?php  echo $sys_kesh ;?>" />
        <input type="hidden" name="sys_hot" value="<?php  echo $sys_hot ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php  echo $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php  echo $bah_cod_m ;?>" />
        <input type="hidden" name="sal" value="<?php  echo $sal ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
          </p>
          <p>&nbsp;</p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php session_regenerate_id(); ?>


