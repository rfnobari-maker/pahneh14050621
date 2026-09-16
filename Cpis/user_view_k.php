<?php
include("../lock_cp.php");
include("../event.php");
$id_mar = $_POST['id_mar'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
#int
{ margin-right:10px 
}
</style>
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
    function target_Agri17(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=750,height=600"); 
    form.target = 'formpopup'; 
	}
   </script>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 include ('../login/config.php');
 ?>
  کاربران سامانه
  <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
   <?php echo $_POST['mess'] ; ?> </p>
<form method="post" name="form1" id="form3"  action="">
  <div style="width:390px; padding: 5px; border:2px solid navy; margin: auto; text-align: left; border-radius:15px ; background-color:#F1F1F1" >
   <table width="388" border='0' align="center" cellpadding='0' cellspacing='0'>
     <tr bgcolor='#f1f1f1' >
       <td height="45" align="right" bgcolor="#F1F1F1" class="input_text" >
         <select dir="rtl"  name="id_ostan" id="id_ostan" style="width:170px ; height:40px"  onchange="this.form.submit()">
           <option value="-1">انتخاب استان</option>
           <?php
$query = "SELECT  id_ostan,ostan FROM ostanname ORDER BY BINARY  ostan ASC"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
           <option value="<?php  echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$_POST['id_ostan']) echo 'selected=selected'?>> <?php  echo $row['ostan'] ;?></option>
           <?php 
		   }?>
           </select>
</td>
       <td> <div id="int" align="right">: استان</div></td>
     </tr>
     <tr bgcolor='#f1f1f1' >
       <td width="246" height="45" align="right" bgcolor="#F1F1F1" class="input_text" >
           <select dir="rtl"  name="id_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
         <option value="0">انتخاب شهرستان</option>
             <?php
$id_ostan = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
$query = "SELECT id_city,city FROM cityname WHERE  id_ostan = '$id_ostan' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
             <option value="<?php  echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php  echo $row['city'] ;?></option>
             <?php 
		   }?>
            </select>
</td>
       <td width="142"><div id="int" align="right">: شهرستان</div></td>
     </tr>
     <tr bgcolor='#f1f1f1' >
       <td height="44" align="right" bgcolor="#F1F1F1" class="input_text" ><div align="right">
         <select dir="rtl"  name="id_mar" id="id_mar" style="width:170px ; height:40px">
           <option value="0">انتخاب مرکز</option>
           <?php
$query = "SELECT id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan' and id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
           <option value="<?php  echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>>
             <?php  echo $row['mar'] ;?>
             </option>
           <?php }?>
         </select>
       </div></td>
       <td><div  id="int2" align="right">: مرکز جهاد کشاورزی</div></td>
     </tr>
     <tr bgcolor='#f1f1f1' >
       <td height="64" align="right" bgcolor="#F1F1F1" class="input_text" ><div align="right" >
         <select name="s_access" class="required input_text" id="s_access" style="height:40px ; width:200px ; direction:rtl" tabindex="11">
           <option value="0">انتخاب سطح دسترسی</option>
           <option value="1" <?php if ($_POST['s_access']=='1') { echo 'selected="selected"' ; } ?>>مروج کشاورزی</option>
           <option value="2" <?php if ($_POST['s_access']=='2') { echo 'selected="selected"' ; } ?>>رئیس مرکز</option>
           <option value="6" <?php if ($_POST['s_access']=='6') { echo 'selected="selected"' ; } ?>>کارشناس موضوعی شهرستان</option>
           <option value="7" <?php if ($_POST['s_access']=='7') { echo 'selected="selected"' ; } ?>>محقق معین شهرستان</option>
           <option value="3" <?php if ($_POST['s_access']=='3') { echo 'selected="selected"' ; } ?>>مدیریت شهرستان</option>
           <option value="4" <?php if ($_POST['s_access']=='4') { echo 'selected="selected"' ; } ?>>مدیریت سامانه</option>
           <option value="5" <?php if ($_POST['s_access']=='5') { echo 'selected="selected"' ; } ?>>کارشناس معین استان</option>
           <option value="98" <?php if ($_POST['s_access']=='98') { echo 'selected="selected"' ; } ?>>مدیر استانی سامانه</option>
           <option value="20" <?php if ($_POST['s_access']=='20') { echo 'selected="selected"' ; } ?>>مدیر کشوری سامانه</option>
           <option value="50" <?php if ($_POST['s_access']=='50') { echo 'selected="selected"' ; } ?>>نیروی پشتیبانی</option>
           <option value="51" <?php if ($_POST['s_access']=='51') { echo 'selected="selected"' ; } ?>>سرباز سازندگی</option>

         </select>
       </div></td>
       <td><div id="int3" align="right">:دسترسی سطح</div></td>
     </tr>
     <tr bgcolor='#f1f1f1' >
       <td height="64" align="right" bgcolor="#F1F1F1" class="input_text" ><div align="right" >
         <select name="expert_unit" class="required input_text" style="height:40px ; width:200px ; direction:rtl" tabindex="13">
           <option value="0">---</option>
           <option value="11" <?php if ($_POST['expert_unit']=='11')  { echo 'selected="selected"' ; } ?>>سازمان جهاد کشاورزی</option>
           <option value="1" <?php if ($_POST['expert_unit']=='1')  { echo 'selected="selected"' ; } ?>>طرح و برنامه/ترویج</option>
           <option value="2" <?php if ($_POST['expert_unit']=='2')  { echo 'selected="selected"' ; } ?>>باغبانی</option>
           <option value="3" <?php if ($_POST['expert_unit']=='3')  { echo 'selected="selected"' ; } ?>>حفظ نباتات</option>
           <option value="4" <?php if ($_POST['expert_unit']=='4')  { echo 'selected="selected"' ; } ?>>زراعت</option>
           <option value="5" <?php if ($_POST['expert_unit']=='5')  { echo 'selected="selected"' ; } ?>>شیلات و آبزیان</option>
           <option value="6" <?php if ($_POST['expert_unit']=='6')  { echo 'selected="selected"' ; } ?>>دام</option>
           <option value="7" <?php if ($_POST['expert_unit']=='7')  { echo 'selected="selected"' ; } ?>>طیور و زنبورعسل</option>
           <option value="8" <?php if ($_POST['expert_unit']=='8')  { echo 'selected="selected"' ; } ?>>اراضی </option>
           <option value="9" <?php if ($_POST['expert_unit']=='9')  { echo 'selected="selected"' ; } ?>>صنایع تبدیلی و تکمیلی</option>
           <option value="10"<?php if ($_POST['expert_unit']=='10') { echo 'selected="selected"' ; } ?>>آب و خاک</option>
         </select>
       </div></td>
       <td><div id="int4" align="right">:واحد تخصصی</div></td>
     </tr>
   </table>
   </div>
 <div align="center">
   <p>
       <input name="action" type="submit" style="width:150px ; height:45px" tabindex="12" value="جستجو" />
   </p>
 </div>
    </form>
  <?php 
 if (isset($_POST['action'])) 
 {  
 $id_city = $_POST['id_city']; 
 $id_mar = $_POST['id_mar']; 
 $id_ostan = $_POST['id_ostan']; 
 $s_access = $_POST['s_access']; 
 $expert_unit = $_POST['expert_unit'] ;
if ($id_ostan == '-1') { $v_id_ostan = 1;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($s_access == 0) { $v_s_access = 1 ;} else { $v_s_access = "S_access='$s_access' " ;}
if ($expert_unit == 0) { $v_expert_unit = 1 ;} else { $v_expert_unit = "expert_unit='$expert_unit'" ;}
 $query = "SELECT * FROM  users where  $v_id_ostan and  $v_id_city and $v_id_mar and $v_s_access and $v_expert_unit "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <br />
<div align="center">
     <form  action="user_view_k_xls.php" method="post">
      <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan ;?>" />
      <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
      <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
      <input type="hidden" name="s_access" value="<?php echo $s_access ;?>" />
      <input type="hidden" name="expert_unit" value="<?php echo $expert_unit ;?>" />
      <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="39" height="44"  alt=""/></button>
     </form></div>
     <br />
<table width="95%" height="108" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
      <td width="6%" height="48" bgcolor="#CCCCCC">عملیات</td>
      <td width="8%" bgcolor="#CCCCCC">آخرین بازدید</td>
      <td width="10%" bgcolor="#CCCCCC">واحد تخصصی</td>
      <td width="10%" bgcolor="#CCCCCC">سطح دسترسی</td>
      <td width="9%" bgcolor="#CCCCCC">تلفن همراه</td>
      <td width="9%" bgcolor="#CCCCCC">کد ملی</td>
      <td width="10%" bgcolor="#CCCCCC">نام خانوادگی</td>
      <td width="7%" bgcolor="#CCCCCC">نام</td>
      <td width="7%" bgcolor="#CCCCCC">تصویر</td>
      <td width="8%" bgcolor="#CCCCCC">مرکز</td>
      <td width="8%" bgcolor="#CCCCCC">شهرستان</td>
      <td width="13%" bgcolor="#CCCCCC">استان</td>
      <td width="3%" bgcolor="#CCCCCC">ردیف</td>
    </tr>
    <tr>
      <?php
	  $r = 1 ; 
 foreach($stmt as $row){
$pic =   $row['pic'] ;
if ($row['S_access']=='1') $f_s_access = 'مروج کشاورزی' ; 
if ($row['S_access']=='2') $f_s_access = 'رئیس مرکز' ; 
if ($row['S_access']=='6') $f_s_access = 'کارشناس موضوعی' ; 
if ($row['S_access']=='7') $f_s_access = 'محقق معین' ; 
if ($row['S_access']=='3') $f_s_access = 'مدیر شهرستان' ; 
if ($row['S_access']=='4') $f_s_access = 'مدیر استانی' ; 
if ($row['S_access']=='5') $f_s_access = 'کارشناس معین استان' ; 
if ($row['S_access']=='98') $f_s_access = 'ادمین استان' ; 
if ($row['S_access']=='20') $f_s_access = 'مدیر کشوری' ; 
if ($row['S_access']=='50') $f_s_access = 'نیروی پشتیبانی' ; 
if ($row['S_access']=='51') $f_s_access = 'سرباز سازندگی' ; 

if ($row['expert_unit']=='11')  $f_expert_unit = 'سازمان جهاد کشاورزی' ; 
if ($row['expert_unit']=='1')  $f_expert_unit = 'طرح و برنامه/ترویج' ; 
if ($row['expert_unit']=='2')  $f_expert_unit = 'باغبانی' ; 
if ($row['expert_unit']=='3')  $f_expert_unit = 'حفظ نباتات' ; 
if ($row['expert_unit']=='4')  $f_expert_unit = 'زراعت' ; 
if ($row['expert_unit']=='5')  $f_expert_unit = 'شیلات و آبزیان' ; 
if ($row['expert_unit']=='6')  $f_expert_unit = 'دام' ; 
if ($row['expert_unit']=='7')  $f_expert_unit = 'طیور و زنبورعسل' ; 
if ($row['expert_unit']=='8')  $f_expert_unit = 'اراضی' ; 
if ($row['expert_unit']=='9')  $f_expert_unit = 'صنایع تبدیلی و تکمیلی' ; 
if ($row['expert_unit']=='10') $f_expert_unit = 'آب و خاک' ; 
?>
      <td height="58" bgcolor="#FFFFCC" class="normalTextSmaller">
        <form  action="send_pm1.php#1" method="post" onsubmit="target_Agri17(this)">
          <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
          <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
        </form></td>
      <td bgcolor="#FFFFCC"  class="normalTextSmaller"><?php echo last_log($row['username'])?></td>
      <td bgcolor="#FFFFCC"  class="normalTextSmaller"><?php echo $f_expert_unit?></td>
      <td bgcolor="#FFFFCC"  class="normalTextSmaller"><?php echo $f_s_access?><br /></td>
      <td bgcolor="#FFFFCC"  class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
      <td bgcolor="#FFFFCC"  class="normalTextSmaller"><?php echo $row['cod_m'];?></td>
      <td bgcolor="#FFFFCC"  class="normalTextSmaller"><?php echo $row['Last_name'];?></td>
      <td bgcolor="#FFFFCC"   class="normalTextSmaller"><?php echo $row['name'];?> <span class="style21"><a name="1" id="1"></a></span></td>
      <td bgcolor="#FFFFCC"><form  action="last_login.php" method="post" onsubmit="target_popup(this)">
      <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
      <button><img id="img1" src="../files/users/<?php echo $pic;?>" width="37" height="45"  alt=""/></button>
      </form></td>
      <td bgcolor="#FFFFCC"><?php echo $row['markaz']?><br />
        <span class="normalTextSmaller"><?php echo $row['id_mar'];?></span></td>
      <td bgcolor="#FFFFCC"><?php echo city_name1($row['id_city'],$row['id_ostan'])?></td>
      <td bgcolor="#FFFFCC"><?php echo ostan_name($row['id_ostan'])?></td>
      <?php 
if ($pic == '') $pic = 'no_pic.png'  ?>
      <td bgcolor="#FFFFCC"><?php echo $r ?></td>
    </tr>
    <?php
$r = $r+1  ;
}
}
?>
</table>  <p>&nbsp;</p>
  <p>&nbsp;</p><p><a href="users.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p></td>
  </tr>
  <tr>
      <td  height="100px"colspan="2" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table>
</body>
</html>