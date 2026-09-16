<?php 
include('../../lock_expsh.php');
include('../../event.php');
if (isset($_POST['y_prod']))   $y_prod  = $_POST['y_prod'] ; 
if(isset($_POST['id_ostan']))  $id_ostan1 = $_POST['id_ostan'] ;
if(isset($_POST['id_city5']))  $id_city   = $_POST['id_city5'] ;
if(isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'] ; 
if(isset($_POST['no_kesht']))  { $no_kesht = $_POST['no_kesht']     ; };
if(isset($_POST['no_saz']))   { $no_saz = $_POST['no_saz']       ; };
if(isset($_POST['no_gol']))   { $no_gol = $_POST['no_gol']       ; };
if(isset($_POST['sys_kesh'])) { $sys_kesh = $_POST['sys_kesh']   ; };
if(isset($_POST['sys_hot']))  { $sys_hot = $_POST['sys_hot']     ; };
if(isset($_POST['add_abadi']))
{
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $no_moj = $_POST['no_moj'] ;
 $no_mush = $_POST['no_mush'] ;
 $m_ab      = $_POST['m_ab'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $m_cod_m   = $_POST['m_cod_m'] ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
   <style type="text/css">
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
width:50px
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
function target_po2(form) {
    window.open('null', 'formpopup', 'width=500,height=130,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
  <script>
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
      </p>
   <form  id="reg-form" method="post" action="#1">
             <p> <span class="style1">لیست واحدهای داری  عملکرد تولید </span> </p>
             <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="528" border='0' align="center" cellpadding='0' cellspacing='0'>
                 <tr bgcolor='#f1f1f1' >
                   <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
                 </tr>
                 <tr bgcolor='#f1f1f1' >
                   <td height="52" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                   <td  align='center' bgcolor="#FFFFFF" class="normalTextSmall">&nbsp;</td>
                   <td width="233" height="52" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                     <select name="y_prod" class="input_text  required" id="y_prod" style="height:40px ; width:170px ; direction:rtl">
                       <option value="1404" <?php if ($y_prod=='1404') echo 'selected=selected'?>>1404</option>
                       <option value="1403" <?php if ($y_prod=='1403') echo 'selected=selected'?>>1403</option>
                       <option value="1402" <?php if ($y_prod=='1402') echo 'selected=selected'?>>1402</option>
                       <option value="1401" <?php if ($y_prod=='1401') echo 'selected=selected'?>>1401</option>
                       <option value="1400" <?php if ($y_prod=='1400') echo 'selected=selected'?>>1400</option>
                       <option value="1399" <?php if ($y_prod=='1399') echo 'selected=selected'?>>1399</option>
                       <option value="1398" <?php if ($y_prod=='1398') echo 'selected=selected'?>>1398</option>                       
                     </select>
                   </div></td>
                   <td width="135"  align='center' bgcolor="#FFFFFF" ><span ><font size="2" class="normalTextSmall">: عملکرد سال </font></span></td>
                  </tr>
                 <tr bgcolor='#f1f1f1' >
                   <td width="198" height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="id_city5" disabled="disabled" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="0"> کل استان</option>
                     <?php
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan' ORDER BY BINARY city ASC "  ;
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
                   <td width="134"  align='center' bgcolor="#DDDDDD" class="normalTextSmall"><span class="style1"><font size="2" class="normalTextSmall">:شهرستان</font></span></td>
                   <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                    <?php $id_ostan1 = $id_ostan?>
                   <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
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
                 <tr >
                   <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
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
                   <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall"> : نام آبادی</td>
                   <td rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_mar" class="input_text" id="id_mar" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
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
                   <td rowspan="2"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall"> :مرکز جهاد کشاورزی</font></td>
                 </tr>
                 <tr >
                   <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
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
                   <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">:نام شهر</td>
                 </tr>
                 <tr >
                   <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"><span style="text-align: right">
                     <input name="m_cod_m" type="text" class="input_text" id="m_cod_m"  style="height:35px ; width:170px " value="<?php echo $m_cod_m?>" />
                   </span></div></td>
                   <td height="54" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">: کد ملی مالک</font></td>
                   <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                     <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                   </div></td>
                   <td height="54"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">: کد ملی بهره بردار</font></td>
                 </tr>
                 <tr >
                   <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                     <select name="sys_kesh" class="input_text  required" id="sys_kesh"  style="height:40px ; width:150px ; direction:rtl" tabindex="20">
                       <option value="">انتخاب کنید</option>
                       <option value="1" <?php if ($sys_kesh=='1') { echo 'selected="selected"' ; } ?>>خاکی</option>
                       <option value="2" <?php if ($sys_kesh=='2') { echo 'selected="selected"' ; } ?>>هیدروپونیک</option>
                       <option value="3" <?php if ($sys_kesh=='3') { echo 'selected="selected"' ; } ?>>اکوآپونیک</option>
                     </select>
                   </div></td>
                   <td height="54" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: سیستم کشت</font></td>
                   <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                     <!--<form action="" method="post" name="form_kesh"> -->
                     <select name="no_kesht" class="input_text  required" id="no_kesht" style="height:40px ; width:150px ; direction:rtl" tabindex="3" >
                       <option value="">انتخاب کنید</option>
                       <option value="1" <?php if ($no_kesht=='1') { echo 'selected="selected"' ; } ?>>گلخانه</option>
                       <option value="2" <?php if ($no_kesht=='2') { echo 'selected="selected"' ; } ?>>فضای باز</option>
                     </select>
                     <!--< </form> -->
                   </div></td>
                   <td height="47"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">:نوع کشت</font></td>
                 </tr>
                 <tr >
                   <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                     <select name="no_gol" class="input_text required " id="no_gol"  style="height:40px ; width:150px ; direction:rtl" tabindex="6">
                       <option value="">انتخاب کنید</option>
                       <option value="1" <?php if ($no_gol=='1') { echo 'selected="selected"' ; } ?>>تونلی تک قلو</option>
                       <option value="2" <?php if ($no_gol=='2') { echo 'selected="selected"' ; } ?>>تونلی بهم پیوسته</option>
                       <option value="3" <?php if ($no_gol=='3') { echo 'selected="selected"' ; } ?>>یک طرفه</option>
                       <option value="4" <?php if ($no_gol=='4') { echo 'selected="selected"' ; } ?>>شیشه ای سقف شیروانی</option>
                     </select>
                   </div></td>
                   <td height="54" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">: نوع گلخانه</font></td>
                   <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                     <select name="no_saz" class="input_text required " id="no_saz"  style="height:40px ; width:150px ; direction:rtl" tabindex="12">
                       <option value="">انتخاب کنید</option>
                       <option value="1" <?php if ($no_saz=='1') { echo 'selected="selected"' ; } ?>>فلزی با پوشش پلاستیکی</option>
                       <option value="2" <?php if ($no_saz=='2') { echo 'selected="selected"' ; } ?>>فلزی با پوشش پلی کربنات</option>
                       <option value="3" <?php if ($no_saz=='3') { echo 'selected="selected"' ; } ?>>فلزی با پوشش شیشه ای</option>
                       <option value="4" <?php if ($no_saz=='4') { echo 'selected="selected"' ; } ?>>چوبی پلاستیکی</option>
                     </select>
                   </div></td>
                   <td height="47"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">:نوع سازه</font></td>
                 </tr>
                 <tr >
                   <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                     <select name="sys_hot" class="input_text  required" id="sys_hot"  style="height:40px ; width:150px ; direction:rtl" tabindex="8">
                       <option value="">انتخاب کنید</option>
                       <option value="1" <?php if ($sys_hot=='1') { echo 'selected="selected"' ; } ?>>حرارت مرکزی</option>
                       <option value="2" <?php if ($sys_hot=='2') { echo 'selected="selected"' ; } ?>>هیتر یا بخاری</option>
                       <option value="3" <?php if ($sys_hot=='3') { echo 'selected="selected"' ; } ?>>تشعشعی</option>
                     </select>
                   </div></td>
                   <td height="54" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: سیستم گرمایشی</font></td>
                   <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                     <select name="no_moj" class="input_text required " id="no_moj"  style="height:40px ; width:230px ; direction:rtl" tabindex="13">
                       <option value="">انتخاب کنید</option>
                       <option value="1" <?php if ($no_moj=='1') { echo 'selected="selected"' ; } ?> >پروانه بهره برداری/نظام مهندسی</option>
                       <option value="5" <?php if ($no_moj=='5') { echo 'selected="selected"' ; } ?> >پروانه بهره برداری/سازمان جهاد کشاورزی</option>
                       <option value="2" <?php if ($no_moj=='2') { echo 'selected="selected"' ; } ?>>مشاغل خانگی/وزارت جهاد</option>
                       <option value="3" <?php if ($no_moj=='3') { echo 'selected="selected"' ; } ?>>تسهیلات/بسیج سازندگی</option>
                       <option value="4" <?php if ($no_moj=='4') { echo 'selected="selected"' ; } ?>>فاقد مجوز</option>
                     </select>
                   </div></td>
                   <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">: نوع مجوز</font></td>
                  </tr>
                 <tr>
                   <td height="50" align="right"  bgcolor="#DDDDDD" class="style8" >&nbsp;</td>
                   <td height="50" align="right"  bgcolor="#DDDDDD" class="style1" >&nbsp;</td>
                   <td height="50" align="right"  bgcolor="#DDDDDD" class="style8" ><div align="right">
                     <input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m"  style="height:35px ; width:170px " value="<?php echo $mor_cod_m?>" />
                   </div></td>
                   <td height="50" align="right"  bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">: کد ملی کارشناس</font></td>
                  </tr>
                 <tr >
                   <td height="60" colspan="4" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
                 </tr>
               </table>
             </div>
   </form>

<?php 
 if (isset($_POST['action'])) 
 {  
 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "Greenhous.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "Greenhous.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "Greenhous.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') { $v_add_abadi = 1; }else { $v_add_abadi = "Greenhous.add_abadi = '$add_abadi'" ;}
 if ($add_city == '0')  { $v_add_city  = 1 ; }else{ $v_add_city = "Greenhous.add_city = '$add_city'" ;}
 if ($no_mush == '0')  { $f_no_mush  = 1  ; }else{ $f_no_mush = "Greenhous.no_mush = '$no_mush'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "Greenhous.bah_cod_m = '$bah_cod_m'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "Greenhous.mor_cod_m = '$mor_cod_m'" ;}
 if ($m_cod_m == '')  { $v_m_cod_m  = 1  ; }else{ $v_m_cod_m = "Greenhous.m_cod_m = '$m_cod_m'" ;}
 if ($no_moj == '')  { $f_no_moj  = 1  ; }else{ $f_no_moj = "Greenhous.no_moj = '$no_moj'" ;}
 if ($no_kesht == '')   { $f_no_kesht    = 1  ;}else{ $f_no_kesht   = "Greenhous.no_kesht = '$no_kesht'" ;}
 if ($no_saz == '')    { $f_no_saz     = 1  ;}else{ $f_no_saz    = "Greenhous.no_saz = '$no_saz'" ;}
 if ($no_gol == '')    { $f_no_gol     = 1  ;}else{ $f_no_gol    = "Greenhous.no_gol = '$no_gol'" ;}
 if ($sys_kesh == '')  { $f_sys_kesh   = 1  ;}else{ $f_sys_kesh  = "Greenhous.sys_kesh = '$sys_kesh'" ;}
 if ($sys_hot == '')   { $f_sys_hot    = 1  ;}else{ $f_sys_hot   = "Greenhous.sys_hot = '$sys_hot'" ;}

$start=0;
$limit=25;
if(isset($_GET['id']))
{
$id=$_GET['id'];
$start=($id-1)*$limit;
}
  $query = "SELECT Greenhous.* from Greenhous
left join Greenhous_prod On Greenhous_prod.unit_id = Greenhous.id and Greenhous_prod.y_prod='$y_prod'
 where  $v_mor_cod_m and 
 $v_id_ostan and 
 $v_id_city and  
 $v_id_mar and  
 $v_add_abadi and 
 $v_add_city and 
 $v_bah_cod_m  and 
 $v_m_cod_m and 
 $f_no_moj and 
 $f_no_kesht and 
 $f_no_saz and 
 $f_no_gol and 
 $f_sys_kesh  and
 $f_sys_hot  and 
    Greenhous_prod.unit_id is not null 
 ORDER BY Greenhous.bah_cod_m ASC LIMIT $start, $limit  "; 
$query1 = "SELECT Greenhous.id from Greenhous
left join Greenhous_prod On Greenhous_prod.unit_id = Greenhous.id and Greenhous_prod.y_prod='$y_prod'
 where  $v_mor_cod_m and 
 $v_id_ostan and 
 $v_id_city and  
 $v_id_mar and  
 $v_add_abadi and 
 $v_add_city and 
 $v_bah_cod_m  and 
 $v_m_cod_m and 
 $f_no_moj and 
 $f_no_kesht and 
 $f_no_saz and 
 $f_no_gol and 
 $f_sys_kesh  and
 $f_sys_hot  and 
    Greenhous_prod.unit_id is not null 
 ORDER BY Greenhous.bah_cod_m ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<p align="right"><p><span class="style1"><a name="1" id="1"></a></span>
<form  action="Greenhous_WP_xls.php" method="post">
        <input type="hidden" name="y_prod" value="<?php echo $y_prod ?>" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mush" value="<?php echo $no_mush ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
        <input type="hidden" name="no_kesht" value="<?php  echo $no_kesht ;?>" />
        <input type="hidden" name="no_saz" value="<?php  echo $no_saz ;?>" />
        <input type="hidden" name="no_gol" value="<?php  echo $no_gol ;?>" />
        <input type="hidden" name="sys_kesh" value="<?php  echo $sys_kesh ;?>" />
        <input type="hidden" name="sys_hot" value="<?php  echo $sys_hot ;?>" />
<button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="39" height="45"  alt=""/></button>
      </form></p>
      <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td colspan="3" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="7%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
            <span class="style2">مترمربع</span></td>
          <td width="9%" rowspan="2" bgcolor="#006699">نوع کشت</td>
          <td width="13%" rowspan="2" bgcolor="#006699">نام واحد</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="3" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="10%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="13%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="11%" bgcolor="#006699">شهر/آبادی</td>
          <td width="9%" bgcolor="#006699">شهرستان</td>
          <td width="7%" bgcolor="#006699">استان</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['no_kesht']=='1')  $v_no_kesht='گلخانه';
if ($row['no_kesht']=='2')  $v_no_kesht='فضای باز';
  ?>
          <td width="2%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> 
           <form  action="../send_pm1.php#1" method="post" onsubmit="target_po3(this)">
     <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
     <button><img src="../../files/receive_mail.png" width="20" height="20" title="ارسال پیام " /></button>
     </form></td>
          <td width="3%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <form  action="liste_Greenhous_prod.php" method="post" onsubmit="target_po3(this)">
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="no_moj" value="<?php echo $row['no_moj']  ;?>" />
              <button><img src="../../files/komo2.png" title="نمایش اطلاعات عملکرد واحد "  width="20" height="20"  alt=""/></button>
            </form></td>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Greenhous_viewn.php" method="post" onsubmit="target_po3(this)">
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="20" height="20"  alt=""/></button>
            </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesht?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['unit_name']; ?></td>
          <td height="40" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['no_bah'])?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
 }
	?>
      </table>
      <?php 
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);
if($id>1)
{
	?>
    <form  action="list_Greenhous_W_P.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="y_prod" value="<?php echo $y_prod ?>" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mush" value="<?php echo $no_mush ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
        <input type="hidden" name="no_kesht" value="<?php  echo $no_kesht ;?>" />
        <input type="hidden" name="no_saz" value="<?php  echo $no_saz ;?>" />
        <input type="hidden" name="no_gol" value="<?php  echo $no_gol ;?>" />
        <input type="hidden" name="sys_kesh" value="<?php  echo $sys_kesh ;?>" />
        <input type="hidden" name="sys_hot" value="<?php  echo $sys_hot ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="list_Greenhous_W_P.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="y_prod" value="<?php echo $y_prod ?>" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mush" value="<?php echo $no_mush ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
        <input type="hidden" name="no_kesht" value="<?php  echo $no_kesht ;?>" />
        <input type="hidden" name="no_saz" value="<?php  echo $no_saz ;?>" />
        <input type="hidden" name="no_gol" value="<?php  echo $no_gol ;?>" />
        <input type="hidden" name="sys_kesh" value="<?php  echo $sys_kesh ;?>" />
        <input type="hidden" name="sys_hot" value="<?php  echo $sys_hot ;?>" />
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
      <li class='current'><form  action="list_Greenhous_W_P.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="y_prod" value="<?php echo $y_prod ?>" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mush" value="<?php echo $no_mush ;?>" />
        <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
        <input type="hidden" name="no_kesht" value="<?php  echo $no_kesht ;?>" />
        <input type="hidden" name="no_saz" value="<?php  echo $no_saz ;?>" />
        <input type="hidden" name="no_gol" value="<?php  echo $no_gol ;?>" />
        <input type="hidden" name="sys_kesh" value="<?php  echo $sys_kesh ;?>" />
        <input type="hidden" name="sys_hot" value="<?php  echo $sys_hot ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
 }
echo "</ul>";
?>
</div>
<p><br />
             <br />
           </p>
<p><a href="Greenhous.php"    title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>
      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
 <?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>