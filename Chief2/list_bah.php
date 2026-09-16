<?php 
include('../lock_ce.php');
include('../event.php');
//include('counter14.php');
 if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'] ;
 if(isset($_POST['id_city5'])) $id_city   = $_POST['id_city5'] ;
 if(isset($_POST['id_mar'])) $id_mar    = $_POST['id_mar'] ; 
 if(isset($_POST['add_abadi'])) $add_abadi = $_POST['add_abadi'] ;
 if(isset($_POST['add_city2'])) $add_city  = $_POST['add_city2'] ;
 if(isset($_POST['mor_cod_m'])) $mor_cod_m = $_POST['mor_cod_m'] ;
 if(isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'] ;
 if(isset($_POST['sh_meli'])) $sh_meli   = $_POST['sh_meli'] ;
 if(isset($_POST['s_bah'])) $s_bah     = $_POST['s_bah'] ;
 if(isset($_POST['no_fa'])) $no_fa1 = $_POST['no_fa'] ;
 if(isset($_POST['ok'])) $ok = $_POST['ok'] ;
 if(isset($_POST['no_bah'])) $no_bah = $_POST['no_bah'] ;
 if(isset($_POST['jens'])) $jens = $_POST['jens'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
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
      <span class="style8">لیست  بهره برداران کشاورزی </span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="444" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m"  style="height:35px ; width:170px " value="<?php echo $mor_cod_m?>" />
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8"><span class="style1"><font size="2" class="style8">: کد ملی مروج</font></span></td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                 <select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
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
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                 </div></td>
                 <td height="47" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="style8">: کد ملی بهره بردار</font></td>
                 <td width="214" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_city5" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value=""> کل استان</option>
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
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="sh_meli" type="text" class="input_text" id="sh_meli"  style="height:35px ; width:170px " value="<?php echo $sh_meli?>" />
                 </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="style8"><font size="2" class="style8">: شناسه ملی</font></td>
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <select  name="id_mar" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
                     <option value=""> نام مرکز</option>
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
                 <td width="146"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="43" align="right" bgcolor="#FFFFFF" class="input_text" >
                 <select  name="add_city2"  class="input_text" id="add_city2" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="" >انتخاب نام شهر</option>
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
                 <td height="43"  align='center' bgcolor="#FFFFFF" class="style8">:نام شهر</td>
                 <td height="43" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="" >انتخاب نام آبادی</option>
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
                 <td height="43"  align='center' bgcolor="#FFFFFF" class="style1"><span class="style8"> : نام آبادی</span></td>
               </tr>
               <tr >
                 <td height="52" align="left" bgcolor="#DDDDDD"><div align="right"><span style="text-align: right">
                   <select  name="no_fa"  class="input_text" id="no_fa" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="" >همه موارد </option>
                     <option value="fa_1"  <?php if ($no_fa1=='fa_1') echo 'selected=selected'?> >دارای اراضی زراعی</option>
                     <option value="fa_2"  <?php if ($no_fa1=='fa_2') echo 'selected=selected'?> >باغ و قلمستان</option>
                     <option value="fa_3"  <?php if ($no_fa1=='fa_3') echo 'selected=selected'?>>کشت گلخانه ای</option>
                     <option value="fa_45" <?php if ($no_fa1=='fa_45') echo 'selected=selected'?>>دام سنگین</option>
                     <option value="fa_67" <?php if ($no_fa1=='fa_67') echo 'selected=selected'?> >دام سبک</option>
                     <option value="fa_8"  <?php if ($no_fa1=='fa_8') echo 'selected=selected'?> >طیور سنتی</option>
                     <option value="fa_9"  <?php if ($no_fa1=='fa_9') echo 'selected=selected'?> >طیور صنعتی</option>
                     <option value="fa_10" <?php if ($no_fa1=='fa_10') echo 'selected=selected'?> >زنبور عسل</option>
                     <option value="fa_11" <?php if ($no_fa1=='fa_11') echo 'selected=selected'?> >کرم ابریشم</option>
                     <option value="fa_12" <?php if ($no_fa1=='fa_12') echo 'selected=selected'?> >اپرورش ماهی</option>
                     <option value="fa_13" <?php if ($no_fa1=='fa_13') echo 'selected=selected'?> >صنایع کشاورزی</option>
                   </select>
                 </span></div></td>
                 <td height="52" align="left" bgcolor="#DDDDDD"><span class="style8">:زمینه فعالیت</span></td>
                 <td height="52" align="right" bgcolor="#DDDDDD" class="input_text">
                   <select  name="s_bah"  class="input_text" id="s_bah" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="" >انتخاب وضعیت سکونت</option>
                     <option value="1" <?php if ($s_bah == '1') echo "selected=selected" ?>>ساکن </option>
                     <option value="2" <?php if ($s_bah == '2') echo "selected=selected" ?>>غیرساکن</option>
                     <option value="3" <?php if ($s_bah == '3') echo "selected=selected" ?>>عشایر</option>
                     </select>
                 </td>
                 <td height="52" align="left" bgcolor="#DDDDDD"><span class="style8">: وضعیت سکونت</span></td>
                 </tr>
               <tr >
                 <td height="60" align="left"><div align="right"><span style="text-align: right">
                   <select  name="no_bah"  class="input_text" id="no_bah" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="" <?php if ($no_bah == '') echo "selected=selected" ?>>همه موارد </option>
                     <option value="1" <?php if ($no_bah == '1') echo "selected=selected" ?>>حقیقی</option>
                     <option value="2" <?php if ($no_bah == '2') echo "selected=selected" ?>>حقوقی</option>
                   </select>
                 </span></div></td>
                 <td height="60" align="left"><span class="style8">: نوع بهره بردار</span></td>
                 <td height="60" align="left"><div align="right"><span style="text-align: right">
                   <select  name="ok"  class="input_text" id="ok" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="" <?php if ($ok == '') echo "selected=selected" ?>>همه موارد </option>
                     <option value="4"  <?php if ($ok == '4') echo "selected=selected" ?>>تایید نشده</option>
                     <option value="1" <?php if ($ok == '1') echo "selected=selected" ?>>زنده</option>
                     <option value="2" <?php if ($ok == '2') echo "selected=selected" ?>>فوتی</option>
                     </select>
                 </span></div></td>
                 <td height="60" align="left"><span class="style8">: وضعیت حیات بهره بردار</span></td>
               </tr>
               <tr >
                 <td height="60" colspan="2" align="left" bgcolor="#DDDDDD">&nbsp;</td>
                 <td height="60" align="left" bgcolor="#DDDDDD"><div align="right"><span style="text-align: right">
                   <select  name="jens"  class="input_text" id="jens" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="" <?php if ($jens == '') echo "selected=selected" ?>>همه موارد </option>
                     <option value="1" <?php if ($jens == '1') echo "selected=selected" ?>>مرد</option>
                     <option value="2" <?php if ($jens == '2') echo "selected=selected" ?>>زن</option>
                   </select>
                 </span></div></td>
                 <td height="60" align="left" bgcolor="#DDDDDD"><span class="style8">: جنسیت بهره بردار</span></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
               </tr>
               </table> 
           </div>
 </form>
             <span class="style1"><a name="1" id="1"></a></span>
             <?php
   if(isset($_POST['action']))
{
 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "bah.id_ostan='$id_ostan1'" ;}
 if ($id_city == '')    { $v_id_city = 1 ;} else { $v_id_city = "bah.id_city='$id_city'" ;}
 if ($id_mar  == '')    { $v_id_mar = 1 ;} else { $v_id_mar = "bah.id_mar='$id_mar'" ;}
 if ($add_abadi  == '')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "bah.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '')  { $f_add_city  = 1  ; }else{ $f_add_city = "bah.add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "bah.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah.bah_cod_m = '$bah_cod_m'" ;}
 if ($sh_meli == '')    { $v_sh_meli  = 1      ; }else{ $v_sh_meli = "bah.sh_meli = '$sh_meli'" ;}
 if ($s_bah == '')     { $v_s_bah  = 1         ; }else{ $v_s_bah = "bah.s_bah = '$s_bah'" ;}
 if ($no_fa1 == '')  { $v_no_fa  = 1  ; }else{ $v_no_fa = "$no_fa1='1'" ;}
 if ($ok == '')  { $f_ok  = 1  ; }else{ $f_ok = "bah.ok = '$ok'" ;}
 if ($no_bah == '')  { $f_no_bah  = 1  ; }else{ $f_no_bah = "bah.no_bah = '$no_bah'" ;}
 if ($jens == '')    { $f_jens  = 1    ; }else{ $f_jens   = "bah.jens = '$jens'" ;}

$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
  $query = "SELECT bah.date_s,bah.add_abadi,bah.add_city,bah.no_bah,bah.name,bah.last_name
 ,bah.co_name,bah.bah_cod_m,bah.sh_meli,bah.tel_m,bah.mor_cod_m,bah.ok
,list_abadi.ostan,list_abadi.city as city1,list_abadi.abadi,list_abadi.mar
,list_city.ostan,list_city.city as city2,list_city.shahr,list_city.mar
 FROM  bah
 left join list_abadi on list_abadi.add_abadi = bah.add_abadi
 left join list_city  on list_city.add_city   = bah.add_city
 where $v_id_ostan  and $f_jens and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city  and $v_mor_cod_m and $v_bah_cod_m and $v_sh_meli and $v_s_bah and $v_no_fa and $f_ok and $f_no_bah ORDER BY BINARY last_name ASC LIMIT $start, $limit "; 
$query1 = "SELECT id FROM  bah where $v_id_ostan and $f_jens and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $v_mor_cod_m and $v_bah_cod_m and $v_sh_meli and $v_s_bah and $v_no_fa and $f_ok and $f_no_bah ORDER BY BINARY last_name ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
        
           <p><img id="download-icon" src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
        <div id="loading-spinner" style="display: none;">
        <i class="style8">تا پایان عملیات دانلود فایل منتظر باشید</i>
        </div>
           <div id="download-icon" align="center"><form  action="list_bah_xls.php" method="post" onclick="startDownload()">
                 <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                 <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                 <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                 <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                 <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                 <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                 <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                 <input type="hidden" name="sh_meli" value="<?php echo  $sh_meli ;?>" />
                 <input type="hidden" name="s_bah" value="<?php echo  $s_bah ;?>" />
                 <input type="hidden" name="no_fa" value="<?php echo $no_fa1 ;?>" />
                 <input type="hidden" name="ok"    value="<?php echo $ok ;?>" />
                 <input type="hidden" name="no_bah"   value="<?php echo $no_bah ;?>" />
                 <input type="hidden" name="jens" value="<?php echo  $jens ;?>" />

                <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="42" height="42"  alt=""/></button>
               </form></div></br>

<!-- جاوااسکریپت کد برای نمایش اسپینر و دانلود فایل -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function startDownload() {
  // نمایش اسپینر و مخفی کردن آیکون دانلود
  $("#download-icon").hide();
  $("#loading-spinner").show();

  // شبیه‌سازی دانلود فایل
  setTimeout(function() {
    // مخفی کردن اسپینر و نمایش آیکون دانلود
    $("#loading-spinner").hide();
    $("#download-icon").show();
    // مخفی کردن پیام
    $("#message").hide();
  }, 3000); // ۳ ثانیه
}
</script>
           <table width="98%" height="132" border="0" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text1">
      <td height="57" bgcolor="#999999"><p>مشاهده</p>
        <p>اطلاعات</p></td>
      <td width="8%" bgcolor="#999999">کارشناس مروج</td>
      <td bgcolor="#999999">آخرین وضعیت<br />
        بهره بردار</td>
      <td bgcolor="#999999">تاریخ ثبت</td>
      <td height="57" bgcolor="#999999">شماره همراه</td>
      <td width="8%" bgcolor="#999999"> کد ملی/ شناسه ملی<br /></td>
      <td width="9%" bgcolor="#999999">نام خانوادگی / نام شرکت</td>
      <td width="7%" bgcolor="#999999"> نام </td>
      <td width="8%" bgcolor="#999999">نوع بهره بردار</td>
      <td width="10%" bgcolor="#999999">شهر / آبادی </td>
      <td width="11%" bgcolor="#999999">شهرستان </td>
      <td width="5%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
      <?php
$r = $start+1 ;
 foreach($stmt as $row)
  {
$mor_cod_m1=$row['mor_cod_m'];
$pic = user_pic($mor_cod_m1) ;
 if($row['ok'] == '3') $v_ok = 'در حال استعلام' ;
 if($row['ok'] == '1') $v_ok = 'زنده' ;
 if($row['ok'] == '2') $v_ok = 'فوتی' ;
 if($row['ok'] == '4') $v_ok = 'تایید نشده' ;
?>
      <td width="7%" height="72" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="view_benef1.php#1" method="post" onsubmit="target_popup2(this)">
        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
        <input type="hidden" name="no_bah" value="<?php echo $row['no_bah'] ;?>" />
        <button><img src="../files/view.png" title="نمایش اطلاعات بهره بردار"  width="33" height="26"  alt=""/></button>
      </form></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><img id="img1" src="../files/users/<?php echo $pic ?>" width="28" height="34"  alt=""/><br />
        <?php echo user_name($mor_cod_m1)?><br/>
        <?php echo $mor_cod_m1?><br /></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="9%" class="normalTextSmaller"><?php echo $v_ok ;?></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="9%" class="normalTextSmaller"><?php echo $row['date_s'];?></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="9%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?><br />
        <?php echo $row['sh_meli'];?>      </p></td>
      <?php if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;?>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?><br />
        <?php echo $row['co_name'];?> <br /></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah ;?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?><?php echo $row['shahr'];?><br />
        <?php echo $row['add_abadi'];?><?php echo $row['add_city'];?></td>
      <?php 
if ($pic == '') $pic = 'no_pic.png'
 ?>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city1'];?><?php echo $row['city2'];?></td>
      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
}
?>
</table>
<div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
<?php 
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);
if($id>1)
{
	?>
    <form  action="list_bah.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa1 ;?>" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
        <input type="hidden" name="add_city2" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
        <input type="hidden" name="sh_meli" value="<?php echo  $sh_meli ;?>" />
        <input type="hidden" name="s_bah" value="<?php echo  $s_bah ;?>" />
        <input type="hidden" name="ok"    value="<?php echo $ok ;?>" />
        <input type="hidden" name="no_bah"   value="<?php echo $no_bah ;?>" />
        <input type="hidden" name="jens" value="<?php echo  $jens ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="list_bah.php?id=<?php echo $id+1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa1 ;?>" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
        <input type="hidden" name="add_city2" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
        <input type="hidden" name="sh_meli" value="<?php echo  $sh_meli ;?>" />
        <input type="hidden" name="s_bah" value="<?php echo  $s_bah ;?>" />                 
        <input type="hidden" name="ok"    value="<?php echo $ok ;?>" />
        <input type="hidden" name="no_bah"   value="<?php echo $no_bah ;?>" />
       <input type="hidden" name="jens" value="<?php echo  $jens ;?>" />        
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
      <li class='current'><form  action="list_bah.php?id=<?php echo $i?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa1 ;?>" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
        <input type="hidden" name="add_city2" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
        <input type="hidden" name="sh_meli" value="<?php echo  $sh_meli ;?>" />
        <input type="hidden" name="s_bah" value="<?php echo  $s_bah ;?>" />                 
        <input type="hidden" name="ok"    value="<?php echo $ok ;?>" />
        <input type="hidden" name="no_bah"   value="<?php echo $no_bah ;?>" />
        <input type="hidden" name="jens" value="<?php echo  $jens ;?>" />        
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
          <p><a href="benef.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>

