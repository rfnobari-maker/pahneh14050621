<?php 
session_start();
include('../../lock_Sc.php');
include('../../event.php');
if(isset($_POST['id_ostan'])) {	$id_ostan1 = $_POST['id_ostan']  ; } else { $id_ostan1=$_SESSION["id_ostan1"] ; };
if(isset($_POST['id_city5'])) { $id_city = $_POST['id_city5']    ; } else { $id_city = $_SESSION["id_city"]   ; } ;
if(isset($_POST['id_mar']))   { $id_mar = $_POST['id_mar']       ; } else { $id_mar = $_SESSION["id_mar"]     ; } ;
if(isset($_POST['no_fa']))    { $no_fa = $_POST['no_fa']         ; } else { $no_fa = $_SESSION["no_fa"]       ; } ;
if(isset($_POST['no_gol']))   { $no_gol = $_POST['no_gol']       ; } else { $no_gol = $_SESSION["no_gol"]     ; } ;
if(isset($_POST['g_tol']))    { $g_tol = $_POST['g_tol']         ; } else { $g_tol = $_SESSION["g_tol"]       ; } ;
if(isset($_POST['m_ab']))     { $m_ab = $_POST['m_ab']           ; } else { $m_ab = $_SESSION["m_ab"]         ; } ;
if(isset($_POST['no_mal']))   { $no_mal = $_POST['no_mal']       ; } else {$no_mal = $_SESSION["no_mal"]      ; } ;
if(isset($_POST['mor_cod_m'])){ $mor_cod_m = $_POST['mor_cod_m'] ; } else {$mor_cod_m = $_SESSION["mor_cod_m"]; } ;
if(isset($_POST['bah_cod_m'])){ $bah_cod_m = $_POST['bah_cod_m'] ; } else {$bah_cod_m = $_SESSION["bah_cod_m"]; } ;
if(isset($_POST['sal']))      { $sal = $_POST['sal']             ; } else {$sal = $_SESSION["sal"]            ; } ;
//if(isset($_SESSION["id_ostan1"])){ $id_ostan1=$_SESSION["id_ostan1"]; unset($_SESSION["id_ostan1"]) ; } else { $id_ostan1 = $_POST['id_ostan'] ; };
//if(isset($_SESSION["id_city"]))  {  $id_city = $_SESSION["id_city"] ;  unset($_SESSION["id_city"]) ; } else {  $id_city = $_POST['id_city5'] ;  } ;
//if(isset($_SESSION["id_mar"]))   {  $id_mar = $_SESSION["id_mar"] ;    unset($_SESSION["id_mar"]);  } else {  $id_mar = $_POST['id_mar'] ;  } ;
//if(isset($_SESSION["no_fa"]))  {  $no_fa = $_SESSION["no_fa"] ; unset($_SESSION["no_fa"]);  } else {  $no_fa = $_POST['no_fa'] ;  } ;
//if(isset($_SESSION["no_saz"]))   {  $no_saz = $_SESSION["no_saz"] ;  unset($_SESSION["no_saz"]); } else {  $no_saz = $_POST['no_saz'] ;  } ;
//if(isset($_SESSION["no_gol"]))   {  $no_gol = $_SESSION["no_gol"] ;  unset($_SESSION["no_gol"]); } else {  $no_gol = $_POST['no_gol'] ;  } ;
//if(isset($_SESSION["g_tol"])) {  $g_tol = $_SESSION["g_tol"] ; unset($_SESSION["g_tol"]); } else { $g_tol = $_POST['g_tol'] ;  } ;
//if(isset($_SESSION["m_ab"]))  {  $m_ab = $_SESSION["m_ab"] ; unset($_SESSION["m_ab"]); } else {  $m_ab = $_POST['m_ab'] ;  } ;
//if(isset($_SESSION["no_mal"]))   {  $no_mal = $_SESSION["no_mal"] ; unset($_SESSION["no_mal"]);  } else {  $no_mal = $_POST['no_mal'] ;  } ;
//if(isset($_SESSION["mor_cod_m"])){  $mor_cod_m = $_SESSION["mor_cod_m"];unset($_SESSION["mor_cod_m"]); } else {$mor_cod_m = $_POST['mor_cod_m'] ; };
//if(isset($_SESSION["bah_cod_m"])){  $bah_cod_m = $_SESSION["bah_cod_m"] ;unset($_SESSION["bah_cod_m"]);}else{$bah_cod_m = $_POST['bah_cod_m'] ;  } ;
//if(isset($_SESSION["sal"]))  {  $sal = $_SESSION["sal"] ;  unset($_SESSION["sal"]); } else {  $sal = $_POST['sal'] ;  } ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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
     <P><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
   <form  id="reg-form" method="post" action="#1">
             <div style="width: 600px; padding: 5px; border: 3px solid navy; margin: auto; text-align: left; border-radius:15px" >
             <table width="100%" height="360" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="48" colspan='4' align='center' bgcolor="#FFFFFF"><span class="style1">لیست مزارع تکثیر و پرورش آبزیان</span></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="58" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="sal" class="input_text  required" id="z_sal" style="height:40px ; width:100PX ; direction:rtl" tabindex="2">
                    <option value="1403"<?php if ($sal=='1403') echo 'selected=selected'?>>1403</option>
                    <option value="1402"<?php if ($sal=='1402') echo 'selected=selected'?>>1402</option>
                    <option value="1401"<?php if ($sal=='1401') echo 'selected=selected'?>>1401</option>
                    <option value="1400" <?php if ($sal=='1400') echo 'selected=selected'?>>1400</option>
                     <option value="1399" <?php if ($sal=='1399') echo 'selected=selected'?>>1399</option>
                     <option value="1398" <?php if ($sal=='1398') echo 'selected=selected'?>>1398</option>
                     <option value="1397" <?php if ($sal=='1397') echo 'selected=selected'?>>1397</option>
                     <option value="1396" <?php if ($sal=='1396') echo 'selected=selected'?>>1396</option>
                     <option value="1395" <?php if ($sal=='1395') echo 'selected=selected'?>>1395</option>
                     <option value="1394" <?php if ($sal=='1394') echo 'selected=selected'?>>1394</option>
                   </select>
                 </div></td>
                 <td height="58" align="right" bgcolor="#DDDDDD" class="input_text" ><font size="2" class="style8">: سال </font></td>
                 <td height="58" align="right" bgcolor="#DDDDDD" class="input_text" >
                    <?php  $id_ostan1=$id_ostan ?>
                  <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                  <option value="-1">انتخاب استان</option>
                   <?php
$query = "SELECT DISTINCT id_ostan,ostan FROM public_abadi4 ORDER BY BINARY ostan "  ;
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
                 <td width="194" height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_mar" class="input_text" id="bakh" style="width:150PX ; height:40px" tabindex="4" dir="rtl">
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
                   <input name="id_city2" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td width="108" align="center" bgcolor="#FFFFFF" class="input_text" ><span class="style1"><font size="2" class="style8">: مرکز خدمات</font></span></td>
                 <td width="198" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_city5" disabled="disabled" class="style8" id="id_city" style="width:150px ; height:40px" tabindex="3" dir="rtl"  onchange="this.form.submit()">
                   <option value="0"> کل استان</option>
                   <?php
$query = "SELECT DISTINCT id_city,city FROM list_abadi WHERE  id_ostan = '$id_ostan1' ORDER BY BINARY city"  ;
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
                 <td width="100"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="g_tol" class="input_text  required" id="g_tol"  style="height:40px ; width:150px ; direction:rtl" tabindex="20">
                     <option value="0">انتخاب کنید</option>
                  <option value="1" <?php if ($g_tol=='1') { echo 'selected="selected"' ; } ?>>مجتمع</option>
                  <option value="2" <?php if ($g_tol=='2') { echo 'selected="selected"' ; } ?>>منفرد</option>
                  <option value="3" <?php if ($g_tol=='3') { echo 'selected="selected"' ; } ?>>مدار بسته</option>
                  <option value="4" <?php if ($g_tol=='4') { echo 'selected="selected"' ; } ?>>دو منظوره</option>
                  <option value="5" <?php if ($g_tol=='5') { echo 'selected="selected"' ; } ?>>شالیزار</option>
                  <option value="6" <?php if ($g_tol=='6') { echo 'selected="selected"' ; } ?>>قفس</option>
                  <option value="7" <?php if ($g_tol=='7') { echo 'selected="selected"' ; } ?>>پن</option>
                  <option value="8" <?php if ($g_tol=='8') { echo 'selected="selected"' ; } ?>>آب بندان</option>
                  <option value="9" <?php if ($g_tol=='9') { echo 'selected="selected"' ; } ?>>منابع آبی</option>
                  <option value="10" <?php if ($g_tol=='10') { echo 'selected="selected"' ; } ?>>سایر موارد</option>
                   </select>
                 </div></td>
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><font size="2" class="style8">:قالب تولید</font></td>
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <!--<form action="" method="post" name="form_kesh"> -->
                   <select name="no_fa" class="input_text  required" id="no_fa" style="height:40px ; width:150px ; direction:rtl" tabindex="5" >
                     <option value="0">انتخاب کنید</option>
                     <option value="1" <?php if ($no_fa=='1') { echo 'selected="selected"' ; } ?>>تکثیر</option>
                     <option value="2" <?php if ($no_fa=='2') { echo 'selected="selected"' ; } ?>>پرورش</option>
                     <option value="3" <?php if ($no_fa=='3') { echo 'selected="selected"' ; } ?>>تکثیر و پرورش</option>
                   </select>
                   <!--< </form> -->
                 </div></td>
                 <td height="47"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">:نوع فعالیت</font></td>
               </tr>
               <tr >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="m_ab" class="input_text  required" id="m_ab"  style="height:40px ; width:150px ; direction:rtl" tabindex="8">
                     <option value="0">انتخاب کنید</option>
                  <option value="1" <?php if ($m_ab=='1') { echo 'selected="selected"' ; } ?>>رودخانه</option>
                  <option value="2" <?php if ($m_ab=='2') { echo 'selected="selected"' ; } ?>>چاه</option>
                  <option value="3" <?php if ($m_ab=='3') { echo 'selected="selected"' ; } ?>>چشمه و قنات</option>
                  <option value="4" <?php if ($m_ab=='4') { echo 'selected="selected"' ; } ?>>آبن بندان</option>
                  <option value="5" <?php if ($m_ab=='5') { echo 'selected="selected"' ; } ?>>خور و دریا</option>
                  <option value="6" <?php if ($m_ab=='6') { echo 'selected="selected"' ; } ?>>دریاچه</option>
                  <option value="7" <?php if ($m_ab=='7') { echo 'selected="selected"' ; } ?>>سایر منابع</option>
                     </select>
                   </div></td>
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><font size="2" class="style8">:منبع تامین آب </font></td>
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
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
                 <td height="47"  align='center' bgcolor="#FFFFFF" class="style8"><span class="style1"><font size="2" class="style8">: نوع مالکیت</font></span></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"><span style="text-align: right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:150PX " tabindex="10" value="<?php echo $bah_cod_m ?>" />
                 </span></div>                </td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><span class="style1"><font size="2" class="style8">: کد ملی بهره بردار</font></span></td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"><span style="text-align: right">
                   <input name="mor_cod_m" type="text" class="input_text"  style="height:35px ; width:150PX " tabindex="9" value="<?php echo $mor_cod_m?>" />
                 </span></div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="style8"><span class="style1"><font size="2" class="style8">: کد ملی مروج</font></span></td>
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
$_SESSION["no_fa"] = $_POST['no_fa'] ; 
$_SESSION["g_tol"] = $_POST['g_tol'] ; 
$_SESSION["m_ab"] = $_POST['m_ab'] ; 
$_SESSION["no_mal"] = $_POST['no_mal'] ; 
$_SESSION["mor_cod_m"] = $_POST['mor_cod_m'] ; 
$_SESSION["bah_cod_m"] = $_POST['bah_cod_m'] ; 
$_SESSION["sal"] = $_POST['sal'] ; 
if ($id_ostan1 == '-1')    { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
if ($id_city == 0)    { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar  == 0)    { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($no_mal  == '0')  { $f_no_mal  = 'id = id'  ; }else{ $f_no_mal = "no_mal = '$no_mal'" ;}
if ($no_fa == '0')  { $f_no_fa  = 'id = id'  ; }else{ $f_no_fa = "no_fa = '$no_fa'" ;}
if ($g_tol == '0')  { $f_g_tol  = 'id = id'  ; }else{ $f_g_tol = "g_tol = '$g_tol'" ;}
if ($m_ab == '0')   { $f_m_ab  = 'id = id'  ; }else{ $f_m_ab = "m_ab = '$m_ab'" ;}
if ($mor_cod_m == '')  { $v_mor_cod_m  = 'id = id'  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
if ($bah_cod_m == '')  { $v_bah_cod_m  = 'id = id'  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
if ($sal == '')  { $v_sal  = 'id = id'  ; }else{ $v_sal = "sal = '$sal'" ;}
include('../../login/config.php');
$start=0;
$limit=100;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
   $query = "SELECT id,id_ostan,id_city,id_mar,no_fa,g_tol,mor_cod_m,bah_cod_m,sal,no_mal,m_zamin,add_abadi,add_city,m_ab,num_bah from Aquatic where $v_id_ostan  and $v_id_city and  $v_id_mar  and $f_no_fa and $f_g_tol and $f_m_ab and $f_no_mal and $v_mor_cod_m and $v_bah_cod_m and $v_sal  ORDER BY mor_cod_m ASC LIMIT $start, $limit "; 
   $query1 = "SELECT id,id_ostan,id_city,id_mar,no_fa,g_tol,mor_cod_m,bah_cod_m,sal,no_mal,m_zamin,add_abadi,add_city,m_ab,num_bah from Aquatic where $v_id_ostan  and $v_id_city and  $v_id_mar  and $f_no_fa and $f_g_tol and $f_m_ab and $f_no_mal and $v_mor_cod_m and $v_bah_cod_m and $v_sal  ORDER BY mor_cod_m "; 
   $stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
         <form  action="Aquatic_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ;?>" />
        <input type="hidden" name="id_city" value="<?php  echo $id_city ;?>" />
        <input type="hidden" name="id_mar" value="<?php  echo $id_mar ;?>" />
        <input type="hidden" name="no_mal" value="<?php   echo $no_mal ;?>" />
        <input type="hidden" name="no_fa" value="<?php  echo $no_fa ;?>" />
        <input type="hidden" name="g_tol" value="<?php  echo $g_tol ;?>" />
        <input type="hidden" name="m_ab" value="<?php  echo $m_ab ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php  echo $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php  echo $bah_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php  echo $z_sal ;?>" />
          <button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="58" height="62"  alt=""/></button>
          <span class="style1"><span class="style8"><a name="1" id="1"></a></span></span>
        </form></p>
      <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td width="5%" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="5%" rowspan="2" bordercolor="#CCCCCC" bgcolor="#006699">کارشناس<br />
            مروج</td>
          <td width="9%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
            مترمربع</td>
          <td width="8%" rowspan="2" bgcolor="#006699">منبع آب</td>
          <td width="9%" rowspan="2" bgcolor="#006699">قالب تولید</td>
          <td width="9%" rowspan="2" bgcolor="#006699">نوع فعالیت</td>
          <td width="6%" rowspan="2" bgcolor="#006699">سال</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="3" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="8%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="12%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="8%" bgcolor="#006699">شهر/آبادی</td>
          <td width="8%" bgcolor="#006699">شهرستان</td>
          <td width="8%" bgcolor="#006699">استان</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
if ($row['no_mal']=='1') $f_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $f_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $f_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $f_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $f_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $f_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $f_no_mal='اجاره' ;	 
if ($row['no_fa']=='1') $f_no_fa='تکثیر' ;	 
if ($row['no_fa']=='2') $f_no_fa='پرورش' ;	 
if ($row['no_fa']=='3') $f_no_fa='تکثیر و پرورش' ;	 
if ($row['g_tol']=='1') $f_g_tol='مجتمع' ;	 
if ($row['g_tol']=='2') $f_g_tol='منفرد' ;	
if ($row['g_tol']=='3') $f_g_tol='مداربسته' ;	
if ($row['g_tol']=='4') $f_g_tol='دو منظوره' ;	 
if ($row['g_tol']=='5') $f_g_tol='شالیزار' ;	
if ($row['g_tol']=='6') $f_g_tol='قفس' ;	
if ($row['g_tol']=='7') $f_g_tol='پن' ;	 
if ($row['g_tol']=='8') $f_g_tol='آب بندان' ;	 
if ($row['g_tol']=='9') $f_g_tol='منابع آبی' ;	 
if ($row['g_tol']=='10') $f_g_tol='سایر موارد' ;	 

if ($row['m_ab']=='1') $v_m_ab='رودخانه' ;	 
if ($row['m_ab']=='2') $v_m_ab='چاه' ;	
if ($row['m_ab']=='3') $v_m_ab='قنات و چشمه' ;	
if ($row['m_ab']=='4') $v_m_ab='آب بندان' ;	 
if ($row['m_ab']=='5') $v_m_ab='خور و دریا' ;	
if ($row['m_ab']=='6') $v_m_ab='دریاچه' ;	
if ($row['m_ab']=='7') $v_m_ab='سایرمنابع' ;	 

  ?>
          <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="Aquatic_view.php" method="post">
           <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
           <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
           <input type="hidden" name="num_bah" value="<?php echo $row['num_bah'] ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $row['m_poul'] ;?>" />
           <input type="hidden" name="sal" value="<?php echo $row['sal'] ;?>" />
           <input type="hidden" name="no_fa" value="<?php echo $row['no_fa'] ;?>" />
           <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form></td>
          <td bordercolor="#CCCCCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />
            <?php echo user_name($row['mor_cod_m'])?><br/>
            <?php echo $row['mor_cod_m']?><br />
            <?php echo user_tel($row['mor_cod_m'])?><br />
          </p></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_ab ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $f_g_tol?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $f_no_fa?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal']; ?></td>
          <td height="108" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name($row['bah_cod_m'])?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']); ?></td>
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
    <form  action="liste_Aquatic.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="no_mal" value="<?php   echo $no_mal ;?>" />
        <input type="hidden" name="nah_kesh" value="<?php  echo $nah_kesh ;?>" />
        <input type="hidden" name="no_kesh" value="<?php  echo $no_kesh ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php  echo $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php  echo $bah_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php  echo $z_sal ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="liste_Aquatic.php?id=<?php echo $id+1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="no_mal" value="<?php   echo $no_mal ;?>" />
        <input type="hidden" name="nah_kesh" value="<?php  echo $nah_kesh ;?>" />
        <input type="hidden" name="no_kesh" value="<?php  echo $no_kesh ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php  echo $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php  echo $bah_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php  echo $z_sal ;?>" />
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
      <li class='current'><form  action="liste_Aquatic.php?id=<?php echo $i?>" method="post">
        <input type="hidden" name="action" value="1" />
         <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="no_mal" value="<?php   echo $no_mal ;?>" />
        <input type="hidden" name="nah_kesh" value="<?php  echo $nah_kesh ;?>" />
        <input type="hidden" name="no_kesh" value="<?php  echo $no_kesh ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php  echo $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php  echo $bah_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php  echo $z_sal ;?>" />
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


