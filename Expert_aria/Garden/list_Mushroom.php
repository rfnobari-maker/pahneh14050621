<?php 
include('../../lock_expar.php');
include('../../event.php');
if(isset($_POST['id_ostan']))  $id_ostan1 = $_POST['id_ostan'] ;
if(isset($_POST['id_city5']))  $id_city   = $_POST['id_city5'] ;
if(isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'] ; 
if(isset($_POST['add_abadi']))
{
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $no_moj = $_POST['no_moj'] ;
 $no_mush = $_POST['no_mush'] ;
 $m_ab      = $_POST['m_ab'] ;
 $gaz = $_POST['gaz'] ;
 $barg = $_POST['barg'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $m_cod_m   = $_POST['m_cod_m'] ;
 $z_es1 = $_POST['z_es1'] ;
 $z_es2 = $_POST['z_es2'] ;
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
             <p> <span class="style1">لیست واحدهای پرورش قارچ</span></p>
             <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="530" border='0' align="center" cellpadding='0' cellspacing='0'>
                 <tr bgcolor='#f1f1f1' >
                   <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
                 </tr>
                 <tr bgcolor='#f1f1f1' >
                   <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
                   <td  align='center' bgcolor="#DDDDDD" class="normalTextSmall">&nbsp;</td>
                   <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="id_ostan2" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <?php $id_ostan1 = $id_ostan ; ?>
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
                   <td width="204" height="46" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                   <td width="134"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">&nbsp;</td>
                   <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_city3" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
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
                   <td  align='center' bgcolor="#FFFFFF" class="normalTextSmall"><span class="style1"><font size="2" class="normalTextSmall">:شهرستان</font></span></td>
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
                   <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"><span style="text-align: right">
                     <input name="m_cod_m" type="text" class="input_text" id="m_cod_m"  style="height:35px ; width:170px " value="<?php echo $m_cod_m?>" />
                   </span></div></td>
                   <td height="54" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: کد ملی مالک</font></td>
                   <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                     <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                   </div></td>
                   <td height="54"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">: کد ملی بهره بردار</font></td>
                 </tr>
                 <tr >
                   <td height="52" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
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
                   <td height="52" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">: منبع آب</font></td>
                   <td width="196" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                     <select name="no_mush" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl">
                       <option value="0">انتخاب کنید</option>
                       <option value="1" <?php if ($no_mush=='1') { echo 'selected="selected"' ; } ?>>صدفی</option>
                       <option value="2" <?php if ($no_mush=='2') { echo 'selected="selected"' ; } ?>>دکمه ای</option>
                       <option value="3" <?php if ($no_mush=='3') { echo 'selected="selected"' ; } ?>>سایر قارچ های پرورشی خاص</option>
                     </select>
                   </div></td>
                   <td width="166"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">: نوع قارچ پرورشی</font></td>
                 </tr>
                 <tr>
                   <td height="50" align="right"  bgcolor="#FFFFFF" class="style8" ><div align="right">
                     <input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m"  style="height:35px ; width:170px " value="<?php echo $mor_cod_m?>" />
                   </div></td>
                   <td height="50" align="right"  bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: کد ملی کارشناس</font></td>
                   <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                     <select name="no_moj" class="input_text required " id="no_moj"  style="height:40px ; width:170px ; direction:rtl" tabindex="13">
                       <option value="">انتخاب کنید</option>
                       <option value="1" <?php if ($no_moj=='1') { echo 'selected="selected"' ; } ?> >پروانه بهره برداری/نظام مهندسی</option>
                       <option value="2" <?php if ($no_moj=='2') { echo 'selected="selected"' ; } ?>>مشاغل خانگی/وزارت جهاد</option>
                       <option value="3" <?php if ($no_moj=='3') { echo 'selected="selected"' ; } ?>>تسهیلات/بسیج سازندگی</option>
                       <option value="4" <?php if ($no_moj=='4') { echo 'selected="selected"' ; } ?>>فاقد مجوز</option>                     </select>
                   </div></td>
                   <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">: نوع مجوز</font></td>
                 </tr>
                 <tr >
                   <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"><span class="style2">تن در سال</span>
                     <input name="z_es2" type="text" class="input_text" id="z_es2"  style="height:35px ; width:70px " value="<?php echo $z_es2?>" />
                   </div></td>
                   <td height="50"  align='center' bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">: کوچکتر یا مساوی</font></td>
                   <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"><span class="style2">تن در سال</span>
                     <input name="z_es1" type="text" class="input_text" id="z_es1"  style="height:35px ; width:70px " value="<?php echo $z_es1?>" />
                   </div></td>
                   <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">ظرفیت اسمی<br />
                     : بزرگتر یا مساوی</font></td>
                 </tr>
                 <tr >
                   <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                     <select name="barg" class="input_text required " id="gaz"  style="height:40px ; width:100px ; direction:rtl" tabindex="37">
                       <option value="">انتخاب کنید</option>
                       <option value="1" <?php if ($barg=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
                       <option value="2" <?php if ($barg=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
                       </select>
                    </div></td>
                   <td height="50"  align='center' bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: برق</font></td>
                   <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                     <select name="gaz" class="input_text required " id="seeAnotherField"  style="height:40px ; width:100px ; direction:rtl" tabindex="37">
                       <option value="">انتخاب کنید</option>
                       <option value="1" <?php if ($gaz=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
                       <option value="2" <?php if ($gaz=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
                       </select>
                    </div></td>
                   <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall"> : گاز طبیعی</font></td>
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
 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') { $v_add_abadi = 1; }else { $v_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city == '0')  { $v_add_city  = 1 ; }else{ $v_add_city = "add_city = '$add_city'" ;}
 if ($no_mush == '0')  { $f_no_mush  = 1  ; }else{ $f_no_mush = "no_mush = '$no_mush'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($m_cod_m == '')  { $v_m_cod_m  = 1  ; }else{ $v_m_cod_m = "m_cod_m = '$m_cod_m'" ;}
 if ($no_moj == '')  { $f_no_moj  = 1  ; }else{ $f_no_moj = "no_moj = '$no_moj'" ;}
 if ($m_ab == '')  { $f_m_ab  = 1  ; }else{ $f_m_ab = "m_ab = '$m_ab'" ;}
 if ($gaz == '')  { $f_gaz  = 1  ; }else{ $f_gaz = "gaz = '$gaz'" ;}
 if ($barg == '')  { $f_barg  = 1  ; }else{ $f_barg = "barg = '$barg'" ;}
 if ($z_es1 == '')  { $f_z_es1   = 1  ; }else{ $f_z_es1 = "z_es >= $z_es1" ;}
 if ($z_es2 == '')  { $f_z_es2  = 1  ; }else{  $f_z_es2 = "z_es <= $z_es2" ;}
$start=0;
$limit=25;
if(isset($_GET['id']))
{
$id=$_GET['id'];
$start=($id-1)*$limit;
}
$query = "SELECT id,id_ostan,id_city,add_abadi,add_city,no_mush,m_zamin,m_arseh,bah_cod_m,unit_name,no_mal,mor_cod_m from Mushroom
 where  $v_mor_cod_m and $v_id_ostan and $v_id_city and  $v_add_abadi and $v_add_city 
and $f_no_mush and $v_bah_cod_m  and $v_m_cod_m and $f_m_ab and $f_gaz and $f_barg and $f_no_moj and $f_z_es1
and $f_z_es2 
 ORDER BY bah_cod_m ASC LIMIT $start, $limit  "; 
$query1 = "SELECT id from Mushroom 
 where  $v_mor_cod_m and $v_id_ostan and $v_id_city and  $v_add_abadi and $v_add_city 
and $f_no_mush and $v_bah_cod_m  and $v_m_cod_m and $f_m_ab and $f_gaz and $f_barg and $f_no_moj and $f_z_es1
and $f_z_es2 
 ORDER BY bah_cod_m "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<p align="right"><p><span class="style1"><a name="1" id="1"></a></span>
<form  action="list_Mushroom_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mush" value="<?php echo $no_mush ;?>" />
        <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
        <input type="hidden" name="gaz" value="<?php echo $gaz ;?>" />
        <input type="hidden" name="barg" value="<?php echo $barg ;?>" />
        <input type="hidden" name="z_es1" value="<?php echo $z_es1 ;?>" />
        <input type="hidden" name="z_es2" value="<?php echo $z_es2 ;?>" />
<button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="39" height="45"  alt=""/></button>
      </form></p>
      <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td colspan="3" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="7%" rowspan="2" bgcolor="#006699">مساحت زیربنا<br />
            <span class="style2">مترمربع</span></td>
          <td width="7%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
            <span class="style2">مترمربع</span></td>
          <td width="9%" rowspan="2" bgcolor="#006699">نوع قارچ پرورشی</td>
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
if ($row['no_mush']=='1')  $v_no_mush='صدفی';
if ($row['no_mush']=='2')  $v_no_mush='دکمه ای';
if ($row['no_mush']=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';
  ?>
          <td width="2%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <form  action="../send_pm1.php" method="post" onsubmit="target_po3(this)">
     <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
     <button><img src="../../files/receive_mail.png" width="20" height="20" title="ارسال پیام " /></button>
     </form></td>
          <td width="3%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <form  action="liste_Mush_prod.php" method="post" onsubmit="target_po3(this)">
            <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
            <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
            <button><img src="../../files/komo2.png" title="نمایش اطلاعات عملکرد واحد "  width="20" height="20"  alt=""/></button>
          </form></td>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Mushroom_view.php" method="post"  onsubmit="target_po3(this)">
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات واحد"  width="20" height="20"  alt=""/></button>
            </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_arseh']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mush ?></td>
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
    <form  action="list_Mushroom.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
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
        <input type="hidden" name="gaz" value="<?php echo $gaz ;?>" />
        <input type="hidden" name="barg" value="<?php echo $barg ;?>" />
        <input type="hidden" name="z_es1" value="<?php echo $z_es1 ;?>" />
        <input type="hidden" name="z_es2" value="<?php echo $z_es2 ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="list_Mushroom.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
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
        <input type="hidden" name="gaz" value="<?php echo $gaz ;?>" />
        <input type="hidden" name="barg" value="<?php echo $barg ;?>" />
        <input type="hidden" name="z_es1" value="<?php echo $z_es1 ;?>" />
        <input type="hidden" name="z_es2" value="<?php echo $z_es2 ;?>" />
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
      <li class='current'><form  action="list_Mushroom.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
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
        <input type="hidden" name="gaz" value="<?php echo $gaz ;?>" />
        <input type="hidden" name="barg" value="<?php echo $barg ;?>" />
        <input type="hidden" name="z_es1" value="<?php echo $z_es1 ;?>" />
        <input type="hidden" name="z_es2" value="<?php echo $z_es2 ;?>" />
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
<p><a href="Mushroom.php"    title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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