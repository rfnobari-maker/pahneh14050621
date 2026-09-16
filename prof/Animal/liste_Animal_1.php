<?php 
include('../../lock_p1.php');
include('../../event.php');
// آدرس صفحه قبلی 
$p_page = $_SERVER['HTTP_REFERER'] ;
//alert($p_page);
 if (isset($_POST['back_p']))
{
$id_ostan1   = $_SESSION['page_date']['id_ostan'] ; 
$id_city    = $_SESSION['page_date']['id_city'] ;
$bah_cod_m  = $_SESSION['page_date']['p_bah_cod_m'] ; 
$add_abadi  = $_SESSION['page_date']['p_add_abadi'] ;
$add_city   = $_SESSION['page_date']['p_add_city'] ;
$vaz_s      = $_SESSION['page_date']['vaz_s'] ;
$no_moj     = $_SESSION['page_date']['p_no_moj'] ;
$no_fa      = $_SESSION['page_date']['p_no_fa'] ;
$bah_cod_m  = $_SESSION['page_date']['p_bah_cod_m'] ;
$PartIdCode = $_SESSION['page_date']['PartIdCode'] ;
$mor_cod_m = $_SESSION['page_date']['mor_cod_m'] ;
//$back = '1' ; 
}
else 
{
unset($_SESSION['page_date']) ; 
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'] ;
if(isset($_POST['id_city5'])) $id_city = $_POST['id_city5'] ;
if(isset($_POST['add_abadi'])) $add_abadi = $_POST['add_abadi'] ;
if(isset($_POST['add_city'])) $add_city = $_POST['add_city'] ;
if(isset($_POST['no_moj'])) $no_moj = $_POST['no_moj'] ;
if(isset($_POST['vaz_s'])) $vaz_s = $_POST['vaz_s'] ;
if(isset($_POST['no_fa'])) $no_fa = $_POST['no_fa'] ;
if(isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'] ;
if(isset($_POST['PartIdCode'])) $PartIdCode = $_POST['PartIdCode'] ;
if(isset($_POST['mor_cod_m'])) $mor_cod_m = $_POST['mor_cod_m'] ;
include_once('../session_start.php') ; 
$_SESSION['page_date'] = array('p_add_abadi'=> $add_abadi,'p_add_abadi'=> $add_abadi,'p_mor_cod_m'=> $mor_cod_m,'p_add_abadi'=> $add_abadi,'p_add_city'=>$add_city,'p_bah_cod_m'=>$bah_cod_m,'p_no_moj'=>$no_moj,'p_nah_kesh'=>$nah_kesh,'p_no_fa'=>$no_fa,'p_PartIdCode'=>$PartIdCode) ; 
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
    window.open('null', 'formpopup', 'width=500,height=230,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_po3(form) {
    window.open('null', 'formpopup', 'width=1050,height=1400,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>

</head>
<body>
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
             <p> <span class="style1">لیست بهره برداری های دامی </span></p>
             <div style="width: 700px; padding: 5px; border: 3px solid navy; margin: auto; text-align: left; border-radius:20px;" >
             <table width="100%" height="381" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
               <tr bgcolor='#f1f1f1' >
                 <td width="35%" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_city5" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                   <option value="0"> کل استان</option>
                   <?php
$query = "SELECT id_city,city FROM cityname  WHERE  id_ostan = '$id_ostan1' ORDER BY BINARY city ASC "  ;
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
                 <td width="16%"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
                 <td width="35%" height="49" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
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
                 <td width="14%"  align='center' bgcolor="#FFFFFF" class="style8">: استان<span class="style1"><a name="1" id="12"></a></span></td>
               </tr>
               <tr >
                 <td height="42" align="right" class="input_text" ><select  name="add_abadi2"  class="input_text" id="add_abadi2" style="width:170px ; height:40px" dir="rtl"   >
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
                 <td height="42"  align='center' class="style8">نام آبادی</td>
                 <td rowspan="2" align="right" class="input_text" ><select  name="id_mar" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
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
                 <td rowspan="2"  align='center' class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="42" align="right" class="input_text" ><select  name="add_city2"  class="input_text" id="add_city2" style="width:170px ; height:40px" dir="rtl"   >
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
                 <td height="42"  align='center' class="style8">:نام شهر</td>
               </tr>
               <tr>
                 <td><div align="right"><span style="text-align: right">
                   <input name="bah_cod_m2" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:240px " value="<?php echo $bah_cod_m?>" />
                 </span></div></td>
                 <td class="style8"><font size="2">: کد ملی بهره بردار</font></td>
                 <td height="52"><div align="right"><span style="text-align: right">
                   <input name="PartIdCode2" type="text" class="input_text" id="PartIdCode"  style="height:35px ; width:240px " value="<?php echo $PartIdCode?>" />
                 </span></div></td>
                 <td class="style8"><font size="2">: شناسه یکتا</font></td>
               </tr>
               <tr>
                 <td height="56"><div align="right">
                   <select name="no_fa" class="input_text required" id="no_fa" style=" font-family:myfont ; height:40px ; width:250px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
  <option value="1" <?php if ($no_fa == '1') { echo 'selected="selected"'; } ?>>واحد پرواربندی گاو</option>
  <option value="2" <?php if ($no_fa == '2') { echo 'selected="selected"'; } ?>>واحد پرورش گاو شیری</option>
  <option value="3" <?php if ($no_fa == '3') { echo 'selected="selected"'; } ?>>واحد پرورش گاومیش داشتی</option>
  <option value="4" <?php if ($no_fa == '4') { echo 'selected="selected"'; } ?>>واحد پرواربندی گوسفند</option>
  <option value="5" <?php if ($no_fa == '5') { echo 'selected="selected"'; } ?>>واحد پرورش گوسفند داشتی</option>
  <option value="6" <?php if ($no_fa == '6') { echo 'selected="selected"'; } ?>>واحد پرورش بز</option>
  <option value="7" <?php if ($no_fa == '7') { echo 'selected="selected"'; } ?>>واحد پرورش اسب</option>
  <option value="8" <?php if ($no_fa == '8') { echo 'selected="selected"'; } ?>>واحد پرورش گوزن</option>
  <option value="9" <?php if ($no_fa == '9') { echo 'selected="selected"'; } ?>>واحد پرورش شتر داشتی</option>
  <option value="10" <?php if ($no_fa == '10') { echo 'selected="selected"'; } ?>>واحد پرورش لاما</option>
  <option value="11" <?php if ($no_fa == '11') { echo 'selected="selected"'; } ?>>واحد پرورش سگ (گله، پلیس، نگهبان و...)</option>
  <option value="13" <?php if ($no_fa == '13') { echo 'selected="selected"'; } ?>>واحد پرورش حیوانات آزمایشگاهی (موش، خوکچه هندی، هامستر و...)</option>
  <option value="15" <?php if ($no_fa == '15') { echo 'selected="selected"'; } ?>>واحد پرورش دام چند منظوره</option>
  <option value="16" <?php if ($no_fa == '16') { echo 'selected="selected"'; } ?>>واحد پرورش دام روستایی</option>
  <option value="19" <?php if ($no_fa == '19') { echo 'selected="selected"'; } ?>>واحد پرورش دام مستقر در مجتمع دامپروری</option>
  <option value="20" <?php if ($no_fa == '20') { echo 'selected="selected"'; } ?>>واحد پرواربندی گاومیش</option>
  <option value="21" <?php if ($no_fa == '21') { echo 'selected="selected"'; } ?>>واحد پرواربندی شتر</option>
  <option value="22" <?php if ($no_fa == '22') { echo 'selected="selected"'; } ?>>واحد پرورش آهو و جبیر</option>
  <option value="23" <?php if ($no_fa == '23') { echo 'selected="selected"'; } ?>>واحد پرورش مارال</option>
  <option value="24" <?php if ($no_fa == '24') { echo 'selected="selected"'; } ?>>واحد پرورش کل و بز</option>
  <option value="25" <?php if ($no_fa == '25') { echo 'selected="selected"'; } ?>>واحد پرورش قوچ و میش</option>
  <option value="26" <?php if ($no_fa == '26') { echo 'selected="selected"'; } ?>>واحد پرورش الاغ شیری</option>
  <option value="27" <?php if ($no_fa == '27') { echo 'selected="selected"'; } ?>>واحد پرورش روباه (تولید پوست)</option>
  <option value="28" <?php if ($no_fa == '28') { echo 'selected="selected"'; } ?>>واحد پرورش خرگوش</option>
  <option value="29" <?php if ($no_fa == '29') { echo 'selected="selected"'; } ?>>واحد پرورش دام غیر صنعتی</option>
  <option value="30" <?php if ($no_fa == '30') { echo 'selected="selected"'; } ?>>واحد پرورش دام مستقر در مجموعه دامپروری</option>
  <option value="101" <?php if ($no_fa == '101') { echo 'selected="selected"'; } ?>>دام صنعتی و نیمه صنعتی</option>
  <option value="110" <?php if ($no_fa == '110') { echo 'selected="selected"'; } ?>>دامداری عشایری</option>
  <option value="111"  <?php if ($no_fa == '111') { echo 'selected="selected"'; } ?>>دامداری روستایی و غیرصنعتی</option>
                     </select>
                   </div></td>
                 <td height="56" class="style8"><div align="right"><span style="  margin-right:15px;text-align: right">:نوع فعالیت</span></div></td>
                 <td height="56"><div align="right">
                   <select name="no_moj" class="input_text required" id="no_moj" style="height:40px ; width:200px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($no_moj=='1') { echo 'selected="selected"' ; } ?>>دارای پروانه/ مجوز </option>
                     <option value="2" <?php if ($no_moj=='2') { echo 'selected="selected"' ; } ?>>فاقد پروانه/ مجوز </option>
                     </select>
                   </div></td>
                 <td height="56" class="style8"><div align="right"><span style="  margin-right:15px;text-align: right">:نوع مجوز</span></div></td>
               </tr>
               <tr>
                 <td height="54" align="right" class="input_text" ><div align="right">
                   <input name="mor_cod_m" type="text" class="input_text" value="<?php echo $mor_cod_m?>"  style="height:35px ; width:170px " />
                 </div></td>
                 <td height="54"  align='center' class="style1"><font size="2" class="style8">: کد ملی مروج</font></td>
                 <td height="56"><div align="right">
                   <select name="vaz_s" class="input_text required" id="vaz_s" style="height:40px ; width:200px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($vaz_s=='1') { echo 'selected="selected"' ; } ?>>ساکن</option>
                     <option value="2" <?php if ($vaz_s=='2') { echo 'selected="selected"' ; } ?>>غیرساکن</option>
                     <option value="3" <?php if ($vaz_s=='3') { echo 'selected="selected"' ; } ?>>عشایر</option>
                     </select>
                 </div></td>
                 <td height="56" class="style8"><div align="right"><span style="  margin-right:15px;text-align: right">: سکونت</span></div></td>
               </tr>
               <tr>
                 <td height="84" colspan="4">
                   <p>
                     <input name="action_lise" type="submit" class="tabel"   id="action_lise" style="width:100px ; height:40px ; color:#900 ; border-radius:5px ; font-size:14px  " value="جستجو " />
                     </p>
                   <p class="style2"><span class="RedTitleSmaller">برای مشاهده لیست کلیه بهره برداری ها کلید</span> جستجو<span class="RedTitleSmaller"> را بدون انتخاب هیچ یک از آیتم ها کلیک کنید </span></p></td>
               </tr>
             </table>
             </div>
   </form>

<?php 
 if (isset($_POST['action_lise']) or (isset($back) and $back=='1'))
 {  
//session_destroy();

$query = "SELECT end_dam from users where username = '$login_session' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$end_dam =  $row['end_dam'] ; 

 if ($id_ostan1 == '-1')    { $v_id_ostan   = 1 ;}else{ $v_id_ostan  = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)         { $v_id_city    = 1 ;}else{ $v_id_city   = "id_city='$id_city'" ;}
 if ($mor_cod_m == '')      { $v_mor_cod_m  = 1 ;}else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($id_mar  == 0)         { $v_id_mar     = 1 ;}else{ $v_id_mar    = "id_mar='$id_mar'" ;}
 if ($add_abadi == '') { $v_add_abadi = 1; }else { $v_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($PartIdCode == '') { $v_PartIdCode = 1; }else { $v_PartIdCode = "PartIdCode = '$PartIdCode'" ;}
 if ($add_city == '')  { $v_add_city  = 1 ; }else{ $v_add_city = "add_city = '$add_city'" ;}
 if ($vaz_s == '')  { $f_vaz_s  = 1  ; }else{ $f_vaz_s = "vaz_s = '$vaz_s'" ;}
 if ($no_fa == '')  { $f_no_fa  = 1  ; }else{ $f_no_fa = "unit_types = '$no_fa'" ;}
 if ($no_moj == '')  { $f_no_moj  = 1  ; }else{ $f_no_moj = "license_status = '$no_moj'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}


$start=0;
$limit=15;
if(isset($_GET['id']))
{
$id=$_GET['id'];
$start=($id-1)*$limit;
}
 $query = "SELECT *
 from animals_unit where  $v_mor_cod_m and $v_add_abadi and $v_add_city and $f_vaz_s and $v_bah_cod_m and $v_PartIdCode and $f_no_fa and $f_no_moj   ORDER BY PartIdCode ASC LIMIT $start, $limit  "; 
$query1 = "SELECT count(*) from animals_unit where  $v_mor_cod_m and $v_add_abadi and $v_add_city and $v_bah_cod_m and $v_PartIdCode and $f_no_fa and $f_no_moj   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<p align="right"><p><span class="style1"><a name="1" id="1"></a></span>
<form  action="list_Garden_xls.php" method="post">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="sal" value="<?php echo $sal ;?>" />

        <button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="58" height="62"  alt=""/></button>
      </form></p>
      <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" >
        <tr class="text1">
          <td colspan="4" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ظرفیت</td>
          <td width="11%" rowspan="2" bgcolor="#006699">نوع فعالیت</td>
          <td width="11%" rowspan="2" bgcolor="#006699">نوع واحد</td>
          <td width="5%" rowspan="2" bgcolor="#006699">وضعیت مجوز</td>
          <td width="11%" rowspan="2" bgcolor="#006699">شناسه یکتا</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="2" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="6%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="9%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="12%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="12%" bgcolor="#006699">شهر/آبادی</td>
          <td width="13%" bgcolor="#006699">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
 $v_no_fa= translateUnitType($row['unit_types']) ; 
 $v_no_moj=translateLicenseStatus($row['license_status']);
  ?>
          <td width="4%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($end_dam== '') {?>
            <form  action="del_Animal_unit.php" method="post" onsubmit="target_po2(this)">
             <input type="hidden" name="partIDCode" value="<?php echo $row['PartIdCode'] ?>"> <!-- مقدار شناسه یکتا -->
             <input type="hidden" name="bah_cod_m" value="<?php  echo $row['bah_cod_m'] ?>"> <!-- مقدار شناسه یکتا -->                  
             <input type="hidden" name="add_abadi" value="<?php  echo $row['add_abadi'] ?>"> <!-- مقدار شناسه یکتا -->     
              <button onclick="return confirm('از حذف اطلاعات این واحد مطمئن هستید ؟ ')"><img src="../../files/del.png" title="حذف اطلاعات واحد " width="20" height="20"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="4%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Animal_Restats.php" method="post" onsubmit="target_po3(this)">
             <input type="hidden" name="partIDCode" value="<?php echo $row['PartIdCode']; ?>"> <!-- مقدار شناسه یکتا -->
             <input type="hidden" name="no_fa" value="<?php echo $row['unit_types'] ;  ?>"> <!-- مقدار شناسه یکتا -->
             <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ?>"> <!-- مقدار شناسه یکتا -->
             <input type="hidden" name="capacity" value="<?php echo $row['capacity'] ?>"> <!-- مقدار شناسه یکتا -->
             <input type="hidden" name="epidemiologic" value="<?php echo $row['epidemiologic'] ?>"> <!-- مقدار شناسه یکتا -->
             <input type="hidden" name="sal" value="1403"> <!-- مقدار سال -->
              <button><img src="../../files/komo2.png" title="آمار دام " width="20" height="20"  alt=""/></button>
            </form>
         </td>
          <td width="4%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($end_dam== '')  {?>
            <form  action="Animal_Redata1.php" method="post" onsubmit="target_po3(this)">
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
               <input type="hidden" name="partIDCode" value="<?php echo $row['PartIdCode'] ;?>" />
              <input type="hidden" name="num_bah" value="<?php echo $row['num_bah']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="vaz_s" value="<?php echo $row['vaz_s']  ;?>" />
              <input type="hidden" name="docNum" value="<?php echo $row['docNum']  ;?>" />

              <input type="hidden" name="Longitude" value="<?php echo $row['longitude']  ;?>" />
              <input type="hidden" name="Latitude" value="<?php echo $row['latitude']  ;?>" />
              <input type="hidden" name="polygonData" value="<?php echo $row['coordinates'] ;?>" />

              <button><img src="../../files/respons.png" title="استعلام مجدد اطلاعات بهره برداری" width="20" height="20"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="4%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
           <form  action="Animaldata_view.php" method="post" onsubmit="target_po3(this)">
               <input type="hidden" name="partIDCode" value="<?php echo $row['PartIdCode'] ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="20" height="20"  alt=""/></button>
          </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['capacity']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['Product_Name']?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_fa?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_moj?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['PartIdCode']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['num_bah'])?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
 }
	?>
      </table>
      <?php 

if(isset($query1))
{
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> fetchColumn() ;
if(isset($limit)) $total=ceil($rows/$limit);

if(isset($id) and $id>1)
{
	?>
    <form  action="liste_Animal.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action_lise" value="1" />
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="PartIdCode" value="<?php echo $PartIdCode ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="liste_Animal.php?id=<?php echo $id+1 ?>" method="post">
        <input type="hidden" name="action_lise" value="1" />
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="PartIdCode" value="<?php echo $PartIdCode ;?>" />
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
      <li class='current'><form  action="liste_Animal.php?id=<?php echo $i?>" method="post">
        <input type="hidden" name="action_lise" value="1" />
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="PartIdCode" value="<?php echo $PartIdCode ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
 }
 }
echo "</ul>";
?>
</div>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
<p>&nbsp;</p>

      <p><a href="Animal.php"><img src="../../files/new.png" width="40" height="38"  alt="ثبت واحد جدید"/></a></p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html><?php
function translateUnitType($unitType) {
    $unitTypes = array(
        1  => 'واحد پرواربندی گاو',
        2  => 'واحد پرورش گاو شيري',
        3  => 'واحد پرورش گاوميش داشتی',
        4  => 'واحد پرواربندی گوسفند',
        5  => 'واحد پرورش گوسفند داشتي',
        6  => 'واحد پرورش بز',
        7  => 'واحد پرورش اسب',
        8  => 'واحد پرورش گوزن',
        9  => 'واحد پرورش شتر داشتی',
        10 => 'واحد پرورش لاما',
        11 => 'واحد پرورش سگ(گله، پليس، نگهبان و...)',
        13 => 'واحد پرورش حيوانات آزمايشگاهي(موش، خوكچه هندي، هامستر و...)',
        15 => 'واحد پرورش دام چند منظوره',
        16 => 'واحد پروش دام روستايی',
        19 => 'واحد پرورش دام مستقر در مجتمع دامپروري',
        20 => 'واحد پرواربندی گاوميش',
        21 => 'واحد پرواربندی شتر',
        22 => 'واحد پرورش آهو و جبير',
        23 => 'واحد پرورش مارال',
        24 => 'واحد پرورش كل و بز',
        25 => 'واحد پرورش قوچ و ميش',
        26 => 'واحد پرورش الاغ شيري',
        27 => 'واحد پرورش روباه (توليد پوست)',
        28 => 'واحد پرورش خرگوش',
        29 => 'واحد پروش دام غیر صنعتی',
        30 => 'واحد پرورش دام مستقر در مجموعه دامپروري',
    	101=> 'دام صنعتی و نیمه صنعتی' ,
		110=> 'دامداری عشایری' ,
		111=> 'دامداری روستایی و غیرصنعتی'

    );
    // بازگشت ترجمه کد واحد
    return isset($unitTypes[$unitType]) ? $unitTypes[$unitType] : 'نوع واحد نامشخص';
}

// تابع برای ترجمه وضعیت پروانه
function translateLicenseStatus($licenseStatus) {
    $status = array(
        1 => 'دارای پروانه/ مجوز',
        2 => 'فاقد پروانه/ مجوز'
    );

    // بازگشت ترجمه کد وضعیت پروانه
    return isset($status[$licenseStatus]) ? $status[$licenseStatus] : 'وضعیت نامشخص';
}
?>
 <?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>