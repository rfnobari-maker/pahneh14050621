<?php 
include('../../lock_Sc.php');
include('../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city5'] ;
 $id_mar   = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city  = $_POST['add_city'] ;
 $b_time    = $_POST['b_time'] ;
 $m_ab    = $_POST['m_ab'] ;
 $confi    = $_POST['confi'] ;
 $confi2    = $_POST['confi2'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $z_sal = $_POST['z_sal'] ;
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
      <span class="style8">لیست بهره برداران صیفی کار</span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="475" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                       <?php
                    $query = "SELECT z_sal FROM z_sal  ORDER BY z_sal DESC "  ;
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                   <option value="<?php echo $row['z_sal'] ;?>"
                   <?php if ($row['z_sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['z_sal'] ;?></option>
                   <?php }?>
                   </select>
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: سال زراعی</td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
          <?php $id_ostan1 = $id_ostan ; ?>
                 <select  name="id_ostan" disabled="disabled"  class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
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
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" colspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td width="214" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_city5" disabled="disabled"  class="style8" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
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
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="42" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
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
                 <td height="42"  align='center' bgcolor="#DDDDDD" class="style8">:نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <select  name="id_mar"  class="style8" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
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
                 <td width="146" rowspan="2"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="42" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >انتخاب نام شهر</option>
                   <?php
$query = "SELECT  add_city,shahr FROM list_city WHERE  id_mar = '$id_mar' and id_ostan = '$id_ostan1' ORDER BY BINARY shahr "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                   <?php }?>
                 </select></td>
                 <td height="42"  align='center' bgcolor="#DDDDDD" class="style8">:نام شهر</td>
                 </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="m_ab2" class="input_text required " id="m_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="14">
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
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="style8">: منبع آب</td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="b_time2" class="input_text  required" id="b_time" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($b_time=='1') { echo 'selected="selected"' ; } ?>>زمستانه/استمرار</option>
                     <option value="2" <?php if ($b_time=='2') { echo 'selected="selected"' ; } ?>>بهاره</option>
                     <option value="3" <?php if ($b_time=='3') { echo 'selected="selected"' ; } ?>>تابستانه</option>
                     <option value="4" <?php if ($b_time=='4') { echo 'selected="selected"' ; } ?>>پاییزه</option>
                     </select>
                   </div>
                   <div align="right"></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8">:فصل تولید</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="confi2" class="input_text  required" id="confi2" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="" <?php if ($confi2=='') { echo 'selected="selected"' ; } ?> >همه موارد</option>
                     <option value="1" <?php if ($confi2=='1') { echo 'selected="selected"' ; } ?>>بررسی نشده</option>
                     <option value="2" <?php if ($confi2=='2') { echo 'selected="selected"' ; } ?>>تایید شده</option>
                     <option value="3" <?php if ($confi2=='3') { echo 'selected="selected"' ; } ?>>تایید نشده</option>
                     </select>
                   </div></td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="style8">:وضعیت تایید تکمیلی</font></td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="confi" class="input_text  required" id="confi" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="" <?php if ($confi=='') { echo 'selected="selected"' ; } ?> >همه موارد</option>
                     <option value="1" <?php if ($confi=='1') { echo 'selected="selected"' ; } ?>>بررسی نشده</option>
                     <option value="2" <?php if ($confi=='2') { echo 'selected="selected"' ; } ?>>تایید شده</option>
                     <option value="3" <?php if ($confi=='3') { echo 'selected="selected"' ; } ?>>تایید نشده</option>
                     </select>
                   </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">:وضعیت تایید اولیه</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                   </div>                </td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="style8">: کد ملی بهره بردار</font></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="mor_cod_m" type="text" class="input_text" value="<?php echo $mor_cod_m?>"  style="height:35px ; width:170px " />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8">: کد ملی مروج</font></td>
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
 if ($id_ostan1 == '-1')    { $v_id_ostan= 1 ;}else{ $v_id_ostan = "id_ostan='$id_ostan1'"    ;}
 if ($id_city == 0)         { $v_id_city=  1 ;}else{ $v_id_city  = "id_city='$id_city'"       ;}
 if ($id_mar  == 0)         { $v_id_mar=   1 ;}else{ $v_id_mar   = "id_mar='$id_mar'"         ;}
 if ($add_abadi  == '0')    { $f_add_abadi=1 ;}else{ $f_add_abadi= "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')     { $f_add_city= 1 ;}else{ $f_add_city = "add_city = '$add_city'"   ;}
 if ($b_time == '')        { $f_b_time=   1 ;}else{ $f_b_time   = "b_time = '$b_time'"       ;}
 if ($m_ab == '')          { $f_m_ab=     1 ;}else{ $f_m_ab     = "m_ab = '$m_ab'"           ;}
 if ($confi == '')         { $f_confi=    1 ;}else{ $f_confi    = "confi = '$confi'"         ;}
 if ($confi2 == '')        { $f_confi2=   1 ;}else{ $f_confi2   = "confi2 = '$confi2'"       ;}
 if ($mor_cod_m == '')      { $v_mor_cod_m=1 ;}else{ $v_mor_cod_m= "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')      { $v_bah_cod_m=1 ;}else{ $v_bah_cod_m= "bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')          { $v_z_sal=    1 ;}else{ $v_z_sal    = "z_sal = '$z_sal'"         ;}

 include('../../login/config.php');
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $query = "SELECT * from Vege where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_b_time and $f_m_ab and $f_confi and $f_confi2 and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal  ORDER BY bah_cod_m ASC LIMIT $start, $limit "; 
 $query1 = "SELECT * from Vege where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_b_time and $f_m_ab and $f_confi and $f_confi2 and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td rowspan="2" bgcolor="#006699">عملیات</td>
          <td colspan="2" rowspan="2" bgcolor="#006699">کارشناس<br />
            مروج</td>
          <td width="6%" rowspan="2" bgcolor="#006699">تایید تکمیلی</td>
          <td width="6%" rowspan="2" bgcolor="#006699">تایید اولیه</td>
          <td width="8%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
            <span class="style2">هکتار</span></td>
          <td width="6%" rowspan="2" bgcolor="#006699">منبع آب </td>
          <td width="5%" rowspan="2" bgcolor="#006699">نوع طرح</td>
          <td width="6%" rowspan="2" bgcolor="#006699">شماره قطعه</td>
          <td width="5%" rowspan="2" bgcolor="#006699">سال زراعی</td>
          <td  colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="3" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="4%"  bgcolor="#006699">کد ملی </td>
          <td width="8%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="8%" bgcolor="#006699">شهر/آبادی</td>
          <td width="8%" bgcolor="#006699">شهرستان</td>
          <td width="8%" bgcolor="#006699">استان</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
$pic = user_pic($row['mor_cod_m']) ; 
if ($row['b_time']=='1')  $v_b_time='زمستانه/استمرار';
if ($row['b_time']=='2')  $v_b_time='بهاره';
if ($row['b_time']=='3')  $v_b_time='تابستانه';
if ($row['b_time']=='4')  $v_b_time='پاییزه';
if ($row['m_ab']=='1')  $v_m_ab='چشمه';
if ($row['m_ab']=='2')  $v_m_ab='قنات';
if ($row['m_ab']=='3')  $v_m_ab='رودخانه'; 
if ($row['m_ab']=='4')  $v_m_ab='سد';
if ($row['m_ab']=='5')  $v_m_ab='چاه سطحی';
if ($row['m_ab']=='6')  $v_m_ab='چاه عمیق';
if ($row['m_ab']=='7')  $v_m_ab='چاه نیمه عمیق';
if ($row['m_ab']=='8')  $v_m_ab='زهکش';
if ($row['m_ab']=='9')  $v_m_ab='پساب';
if ($row['m_ab']=='10')  $v_m_ab='آب بندان' ;
if ($row['m_ab']=='11')  $v_m_ab='سایر' ;
  ?>
          <td width="7%" height="50" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Vegedata_T_view.php" method="post" onsubmit="target_popup2(this)">
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
            </form></td>
          <td width="4%" bordercolor="#CCCCCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['mor_cod_m'])?><br />
            <?php echo $row['mor_cod_m']?><br />
            <?php echo user_tel($row['mor_cod_m'])?><br />
            </p></td>
          <td width="7%" bordercolor="#CCCCCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br/></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['confi2']=='1') {?>
            <img src="../../files/FAQ.png" title="اعتبار رکورد بررسی نشده "  width="20" height="20"  alt=""/>
            <?php }?>
            <?php if ($row['confi2']=='2') {?>
            <img src="../../files/icon1Active.png" title="اعتبار رکورد تایید شده"  width="20" height="20"  alt=""/>
            <?php }?>
            <?php if ($row['confi2']=='3') {?>
            <img src="../../files/icon1Inactive.png" title="اعتبار رکورد تایید نشده"  width="20" height="20"  alt=""/>
            <?php }?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['confi']=='1') {?>
            <img src="../../files/FAQ.png" title="اعتبار رکورد بررسی نشده "  width="20" height="20"  alt=""/>
            <?php }?>
            <?php if ($row['confi']=='2') {?>
            <img src="../../files/icon1Active.png" title="اعتبار رکورد تایید شده"  width="20" height="20"  alt=""/>
            <?php }?>
            <?php if ($row['confi']=='3') {?>
            <img src="../../files/icon1Inactive.png" title="اعتبار رکورد تایید نشده"  width="20" height="20"  alt=""/>
            <?php }?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_ab?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_b_time ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_sal']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['no_bah'])?></td>
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
    <form  action="Vege_rep1.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="b_time" value="<?php echo $b_time;?>" />
        <input type="hidden" name="m_ab" value="<?php echo $m_ab;?>" />
        <input type="hidden" name="confi" value="<?php echo $confi;?>" />
        <input type="hidden" name="confi2" value="<?php echo $confi2;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="Vege_rep1.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="b_time" value="<?php echo $b_time;?>" />
        <input type="hidden" name="m_ab" value="<?php echo $m_ab;?>" />
        <input type="hidden" name="confi" value="<?php echo $confi;?>" />
        <input type="hidden" name="confi2" value="<?php echo $confi2;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
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
      <li class='current'><form  action="Vege_rep1.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
         <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="b_time" value="<?php echo $b_time;?>" />
        <input type="hidden" name="m_ab" value="<?php echo $m_ab;?>" />
        <input type="hidden" name="confi" value="<?php echo $confi;?>" />
        <input type="hidden" name="confi2" value="<?php echo $confi2;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
          <p><a href="Vege.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>


