<?php include('../lock_ad.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="../jspc-gray.css">
	<script type="text/javascript" src="../js-persian-cal.min.js"></script>
    <script type="text/javascript" src="../script.js"></script>
    <style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
-->
    </style>
	<script src="../15_files/jquery.js" type="text/javascript"></script>
    <script src="../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
        });
    </script>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
            <p>
              <?php
if (isset($_POST['username'])) 
{ 
$username = $_POST['username'] ; 
 $id_city = $_POST['id_city']; 
 $id_mar = $_POST['id_mar']; 
 $id_ostan = $_POST['id_ostan']; 
 $s_access = $_POST['s_access']; 
 $expert_unit = $_POST['expert_unit'] ;
include('../date_con.php');
include('../event.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
$query = "SELECT * FROM users WHERE  username = ?";
$stmt = $dbh->prepare($query);
$stmt->execute(array($username));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $username = $row['username']; 
 $ostan = $row['ostan']; 
 $city = $row['city']; 
 $markaz = $row['markaz']; 
 $cod_m = $row['cod_m']; 
 $name_m = $row['name']; 
 $last_name = $row['Last_name']; 
 $jens = $row['jens']; 
 $sh_sh = $row['sh_sh']; 
 $date_t = $row['date_t']; 
 $m_sodor = $row['m_sodor']; 
 $fname = $row['fname']; 
 $m_tah = $row['m_tah']; 
 $r_tah = $row['r_tah']; 
 $univer = $row['univer']; 
 $m_date = $row['m_date']; 
 $avre = $row['avre']; 
 $v_tahol = $row['v_tahol']; 
 $cod_p = $row['cod_p']; 
 $tel_s = $row['tel_s']; 
 $tel_m = $row['tel_m']; 
 $addres = $row['addres']; 
 $id_ostan = $row['id_ostan'];
 $id_city = $row['id_city'];
 $id_mar = $row['id_mar'];
 $s_access = $row['S_access'];
 $access = $row['Access'];
 $id_aria = $row['id_aria'];
 $expert_unit =  $row['expert_unit'];
// حذف تصویر
 if (isset($_POST['del_pic']))
 {
$file ='../files/users/'.$row_del['pic'] ;
//unlink($file);
$query = "UPDATE users SET pic=?  WHERE username=?";
$q = $dbh->prepare($query);
$q->execute(array('',$username));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','حذف تصویر کاربر',$id_ostan) ; 
 }
 //
if($_FILES['pic']['name']) {
list($name,$result) = upload('pic','../files/users','jpg,jpeg,gif,png,JPG,JPEG,PNG');
if ($result==1) {
$pic =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >تصویر شما با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo "<br align='center' style='text-decoration:rtl'> <font size=3 color='#900 ' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
if (isset($_POST['action4'] ) ) {
$query = "UPDATE users 
        SET pic=? WHERE username=?";
$q = $dbh->prepare($query);
$q->execute(array($pic,$username));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','آپلود تصویر کاربر',$id_ostan) ; 
} 
$query = "SELECT * from users WHERE username='".$username."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
// $row تک خطی 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 ?>
            </p>
            <p align="center" ><span class="style1">ویرایش اطلاعات کاربر</span></p>
            <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<?php
if (isset($_POST['id_ostan']) or isset($_POST['id_ostan']) )
{
 $id_ostan = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
}
?>
            <form action="" method="post" enctype="multipart/form-data">
              <table width="75%" border="0" align="center" cellpadding="0" cellspacing="0" >
                <tr>
                      <td width="282" height="235" align="center" bgcolor="#FFFFFF"><p align="justify" class="normalTextSmall"  style="direction:rtl; color:#900 ; margin-right:20px ; margin-left:20px" >تصویر کاربر </p>
                        <p align="justify" class="style2"  style="direction:rtl; color:#900 ; margin-right:20px ; margin-left:20px" >- حجم فایل ارسالی نباید از 2 کیلوبایت کمتر و از 30 کیلوبایت بیشتر باشد</p>
                        <p align="justify" class="style2" style="direction:rtl ; color:#900; margin-right:20px ; margin-left:20px">- برای تغییر تصویر موجود ، ابتدا تصویر قبلی را حذف نمایید .</p>
                      <p align="justify" class="style2" style="direction:rtl ; color:#900; margin-right:20px ; margin-left:20px">- پس ار ارسال تصویر جدید ، برای مشاهده تغییرات ، کلید F5 را فشار دهید. </p></td>
                      <td width="257" align="center" bgcolor="#FFFFFF"><p class="up_row">
                        <?php if($row['pic']<>""){
							 		?>
            <img style="border:1px solid #021a40;" src="<?php echo '../files/users/'.$row['pic'];?>?m=<?php echo filemtime('../files/users/'.user_pic($row['s_user']))?>"  width="87" height="107"/>                 
                        <p class="up_row">
                          <input type="submit" name="del_pic"  value="حذف"   style="width:50px; height:30px ; font-family:Tahoma, Geneva, sans-serif " />
                        </p>
                        <?php }  else { echo '<img style="border:1px solid #021a40;" src=../files/users/no_pic.png  width=87 height=107/>' ;}?>
                        <p>
                        <input type="hidden" name="no_file" value="<?php echo $username ; ?>" />
                        <input type="hidden" name="username" value="<?php echo $username ; ?>" />
                        <input type="submit" value="ارسال فايل" name="action4"  <?php if($row['pic']<>"") { echo ' disabled="disabled"';}?>/>
                  <input name="pic" type="file" id="pic"  accept=".jpg,.jpeg,.gif,.png,.JPG,.JPEG,.GIF,.PNG" /></td>
                    </tr>
                  </table>
                            </form></td>
        </tr>
          </table>

      <form action="" method="post" id="form1" name="form1">
        <div align="center">
          <p>
    <input type="hidden" name="cod_p" style="height:26px ; width:150px ; background:#0CF ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $cod_p ;?>" />
          <table style="border:3px solid #069;" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="48" colspan="5" class="style9" > <span style="color: #069"></span>
       <div style="margin-right:15px" align="right">
         <p>&nbsp;</p>
         <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
           <tr  >
             <td>&nbsp;</td>
             <td><div align="right"></div></td>
             <td align="right" class="input_text" >&nbsp;</td>
             <td height="45" align="right" class="input_text" ><div align="right">
               <input name="cod_m" type="text" id="cod_m" style="height:26px ; width:150px ;  ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $cod_m ?>"  />
             </div></td>
             <td><div id="int2" align="right">:شماره ملی</div></td>
           </tr>
           <tr  >
             <td width="320"><div align="right" >
               <select name="s_access" class="required input_text" style="height:40px ; width:200px ; direction:rtl" tabindex="11">
                 <option value="1" <?php if ($s_access=='1') { echo 'selected="selected"' ; } ?>>مروج کشاورزی</option>
                 <option value="2" <?php if ($s_access=='2') { echo 'selected="selected"' ; } ?>>رئیس مرکز</option>
                 <option value="3" <?php if ($s_access=='3') { echo 'selected="selected"' ; } ?>>مدیریت شهرستان</option>
                 <option value="4" <?php if ($s_access=='4') { echo 'selected="selected"' ; } ?>>مدیریت سامانه</option>
                 <option value="5" <?php if ($s_access=='5') { echo 'selected="selected"' ; } ?>>کارشناس معین استان</option>
                 <option value="6" <?php if ($s_access=='6') { echo 'selected="selected"' ; } ?>>کارشناس موضوعی شهرستان</option>
                 <option value="7" <?php if ($s_access=='7') { echo 'selected="selected"' ; } ?>>محقق معین شهرستان</option>
                 <option value="50" <?php if ($s_access=='50') { echo 'selected="selected"' ; } ?>>نیروی پشتیبانی</option>
                 <option value="51" <?php if ($s_access=='51') { echo 'selected="selected"' ; } ?>>سرباز سازندگی</option>

               </select>
             </div></td>
             <td width="149"><div align="right">:سطح دسترسی</div></td>
             <td align="right" class="input_text" >&nbsp;</td>
             <td width="238" height="45" align="right" class="input_text" >
<select  name="id_ostan1" id="id_ostan1" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
           <?php
$query = "SELECT DISTINCT id_ostan,ostan FROM ostanname where id_ostan = '$id_ostan' ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
  <option value="<?php echo $row['id_ostan'] ;?>"<?php if ($row['id_ostan']==$id_ostan) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
           <?php }?>
           </select>             
 <?php if (isset($_POST['id_ostan1']))
  $id_ostan = $_POST['id_ostan1'] ; 
?></td>
             <td><div id="int" align="right">: استان</div></td>
             </tr>
           <tr >
             <td width="320"><div align="right" >
               <select name="expert_unit" class="required input_text" style="height:40px ; width:200px ; direction:rtl" tabindex="13">
         <option value="0">---</option>
         <option value="11"<?php if ($expert_unit=='11'){ echo 'selected="selected"' ; } ?>>سازمان جهاد کشاورزی</option>
         <option value="1" <?php if ($expert_unit=='1') { echo 'selected="selected"' ; } ?>>طرح و برنامه/ترویج</option>
         <option value="2" <?php if ($expert_unit=='2') { echo 'selected="selected"' ; } ?>>باغبانی</option>
         <option value="3" <?php if ($expert_unit=='3') { echo 'selected="selected"' ; } ?>>حفظ نباتات</option>
         <option value="4" <?php if ($expert_unit=='4') { echo 'selected="selected"' ; } ?>>زراعت</option>
         <option value="5" <?php if ($expert_unit=='5') { echo 'selected="selected"' ; } ?>>شیلات و آبزیان</option>
         <option value="6" <?php if ($expert_unit=='6') { echo 'selected="selected"' ; } ?>>دام </option>
         <option value="7" <?php if ($expert_unit=='7') { echo 'selected="selected"' ; } ?>>طیور و زنبورعسل</option>
         <option value="8" <?php if ($expert_unit=='8') { echo 'selected="selected"' ; } ?>>اراضی </option>
         <option value="9" <?php if ($expert_unit=='9') { echo 'selected="selected"' ; } ?>>صنایع تبدیلی و تکمیلی</option>
         <option value="10" <?php if($expert_unit=='10') { echo 'selected="selected"';} ?>> آب و خاک</option>
       </select>
             </div></td>
             <td width="149"><div align="right">:واحد تخصصی</div></td>
             <td width="28" align="right"  class="input_text" >&nbsp;</td> 
             <td height="45" align="right"  class="input_text" >
             <select dir="rtl"  name="id_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
               <option value="0">--</option>
               <?php
$query = "SELECT DISTINCT id_city,city FROM cityname WHERE id_ostan = $id_ostan"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
   <option value="<?php echo $row['id_city'];?>"
 <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>               <?php 
		   }?>
               </select>
               <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
               <?php if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
             <td width="146"><div id="int" align="right">: شهرستان</div></td>
             </tr>
           </table>
          </div></td>
   </tr>
   <tr>
     <td height="38"><div align="right" class="input_text" >
       <select name="id_aria" class="required input_text" id="id_aria" style="width:170px ; height:40px" tabindex="12" dir="rtl" >
         <option value="0">---</option>
         <?php
      $query = "SELECT DISTINCT id_aria FROM aria WHERE  id_ostan = $id_ostan"  ;
      $stmt = $dbh->prepare($query);
      $stmt->execute();
      foreach($stmt as $row){
     ?>
    <option value="<?php echo $row['id_aria'] ;?>"
   <?php if ($row['id_aria']==$id_aria) echo 'selected=selected'?>> <?php echo $row['id_aria'] ;?></option>
         <?php 
		   }?>
       </select>
     </div></td>
     <td><div id="int3" align="right">:منطقه تحت پوشش</div></td>
     <td width="29" rowspan="9">&nbsp;</td>
     <td><div align="right">
       <select dir="rtl"  name="id_mar" id="id_mar" style="width:170px ; height:40px">
         <option value="0">--</option>
         <?php
$query = "SELECT DISTINCT id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan' and id_city = '$id_city'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
         <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
         <?php }?>
         </select>
       <input name="id_ostan2" type="hidden" value="<?php echo $id_ostan ;?>" />
       <input name="id_city2" type="hidden" value="<?php echo $id_city ;?>" />
       </div>
       </td>
     <td><div style="margin-right:15px" align="right">:مرکز خدمات </div></td>
   </tr>
      <tr>
        <td height="38"><div align="right">
          <input name="last_name" type="text"  style="width:200px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" xml:lang="fa" />
          </div></td>
        <td width="149"><div align="right">:نام خانوادگی</div></td>
        <td width="239"><div align="right">
          <input name="name" type="text"  style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $name_m ; ?>" maxlength="50" xml:lang="fa" />
        </div></td>
        <td width="159"><div style="margin-right:15px" align="right">: نام</div></td>
      </tr>
   <tr>
     <td height="38"><div align="right">
       <input name="sh_sh" type="text" class=" digits" id="sh_sh" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $sh_sh ; ?>" maxlength="20" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td><div align="right">
       <select name="jens"  id="jens" style="height:40px ; width:100px ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="مرد"<?php if ($jens=='مرد') { echo 'selected="selected"' ; } ?>>آقا</option>
         <option value="زن"<?php if ($jens=='زن') { echo 'selected="selected"' ; } ?>>خانم</option>
       </select>
     </div></td>
     <td><div style="margin-right:15px" align="right" >: جنسیت</div></td>
   </tr>


   <tr>
     <td height="42"><div align="right">
       <input name="m_sodor" type="text"  id="m_sodor" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $m_sodor ; ?>" maxlength="35" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:محل صدور</div></td>
    <td height="42" dir="rtl"><div align="right">
       <input name="date_t" type="text" class="pdate " id="pcal1" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:15px" align="right" > : تاریخ تولد</div></td>
   </tr>
   <tr>
     <td height="38"><div align="right">
       <select name="m_tah"  id="m_tah" style="height:40px ; width:150px ; direction:rtl" tabindex="8"> <option value="">انتخاب کنید</option>
         <option value="1" <?php if ($m_tah=='1') { echo 'selected="selected"' ; } ?>>لیسانس</option>
         <option value="2" <?php if ($m_tah=='2') { echo 'selected="selected"' ; } ?>>فوق لیسانس</option>
         <option value="3" <?php if ($m_tah=='3') { echo 'selected="selected"' ; } ?>>دکتری</option>
       </select>
     </div></td>
     <td><div align="right">:مدرک تحصیلی</div></td>
     <td><div align="right">
       <input name="fname" type="text"  id="fname" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $fname ; ?>" maxlength="35" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:15px" align="right" >: نام پدر</div></td>
   </tr>
   <tr>
     <td height="42"><div align="right">
       <input name="univer" type="text"  id="univer" style="width:200px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $univer ; ?>" maxlength="35" xml:lang="fa" />
     </div></td>
     <td><div align="right">:نام دانشگاه</div></td>
     <td><div align="right">
       <input name="r_tah" type="text"  id="r_tah" style="width:200px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $r_tah ; ?>" maxlength="35" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:15px" align="right" >:رشته تحصیلی</div></td>
     </tr>
   <tr>
     <td height="42"><div align="right">
       <input name="avre" type="text"  id="avre" style="width:75px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $avre ; ?>" maxlength="5" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:معدل </div></td>
    <td height="42" dir="rtl"><div align="right">
       <input name="m_date" type="text" class="pdate " id="pcal2" style="width:150px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $m_date ; ?>" maxlength="10" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:15px" align="right" >:تاریخ اخذ مدرک</div></td>
     </tr>
   <tr>
     <td height="42"><div align="right">
       <input name="cod_p" type="text"  id="cod_p" style="width:150px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="35" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:کد پرسنلی</div></td>
     <td height="38"><div align="right">
       <select name="v_tahol"  id="v_tahol" style="height:40px ; width:150px ; direction:rtl" tabindex="13">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($v_tahol=='1') { echo 'selected="selected"' ; } ?>>متاهل</option>
         <option value="2"<?php if ($v_tahol=='2') { echo 'selected="selected"' ; } ?>>مجرد</option>
       </select>
     </div></td>
     <td><div style="margin-right:15px" align="right" >:وضعیت تاهل</div></td>
     </tr>
   <tr>
     <td height="38"><div align="right"><span class="style2"><img src="../files/sms.png" width="25" height="25" /></span>
       <input name="tel_m" type="text" class=" digits" id="tel_m" style="width:150px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td><div align="right">
       <input name="tel_s" type="text" class=" digits" id="tel_s" style="width:150px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:15px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
     <td height="38" colspan="4"><div align="right">
       <input name="addres" type="text"  id="addres" style="width:700px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $addres ; ?>" maxlength="300" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:15px" align="right" >:آدرس محل سکونت</div></td>
     <tr>
 <td width="320"></p>
   <tr>
     <td colspan="5" align="center">&nbsp;</td>
   </tr>
   </table>
   <p>
        <input type="hidden" name="username"  value="<?php echo $username ;?>" />
     <input type="submit" name="action2"  value="بازگشت" style="width:150px ; height:45px" />
     <input type="submit" name="action" value="تصحیح اطلاعات" style="width:150px ; height:45px" tabindex="18" />

   </p>

   </p>

 </div>
    </form>
     <?php
}
else 
{
	echo '<br>' ; 
	echo '<p align=center style=color:red> مجوز دسترسی به این صفحه را ندارید </p> ' ;
	}
?>
      <!--تاریخ فارسی-->

      <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal1' );
		  </script>
      <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal2' );
		  </script>
      <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal3' );
		  </script>
<!--end form --> 
    </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>



<?php


 if (isset($_POST['action'])) 
 {  
//alert('ثبت فشرده شد'); 

 $id_ostan = $_POST['id_ostan']; 
 $id_city = $_POST['id_city']; 
 $id_mar = $_POST['id_mar']; 
 $id_aria = $_POST['id_aria']; 
 $ostan = ostan_name($id_ostan) ;
 $city =city_name1($id_city,$id_ostan) ;
 $markaz = mar_name($id_mar) ;
 $cod_m = $_POST['cod_m'];  
 $name = $_POST['name']; 
 $last_name = $_POST['last_name']; 
 $jens = $_POST['jens']; 
 $sh_sh = $_POST['sh_sh']; 
 $date_t = date_con($_POST['date_t']); 
 $m_sodor = $_POST['m_sodor']; 
 $fname = $_POST['fname']; 
 $m_tah = $_POST['m_tah']; 
 $r_tah = $_POST['r_tah']; 
 $univer = $_POST['univer']; 
 $m_date = date_con($_POST['m_date']); 
 $avre = $_POST['avre']; 
 $v_tahol = $_POST['v_tahol']; 
 $cod_p = $_POST['cod_p']; 
 $tel_s = $_POST['tel_s']; 
 $tel_m = $_POST['tel_m']; 
 $addres = $_POST['addres']; 
 $s_access = $_POST['s_access']; 
 $access = $_POST['access']; 
 $expert_unit = $_POST['expert_unit']; 
// تعریف متغیرهای که هنگام لود فرم خالی رد میشن
{ 

$query = "UPDATE users 
        SET  cod_m=?,id_ostan=?,id_city=?,id_mar=?,ostan=?,city=?,markaz=?,name=? ,Last_name=?,jens=?,sh_sh=?,date_t=?,m_sodor=?,fname=?,m_tah=?,r_tah=?,univer=?,m_date=?,avre=?,v_tahol=?,cod_p=?,tel_s=?,tel_m=?,addres=?,S_access=?,id_aria=?,expert_unit=?
		WHERE username=?";
$q = $dbh->prepare($query);
$q->execute(array($cod_m,$id_ostan,$id_city,$id_mar,$ostan,$city,$markaz,$name,$last_name,$jens,$sh_sh,$date_t,$m_sodor,$fname,$m_tah,$r_tah,$univer,$m_date,$avre,$v_tahol,$cod_p,$tel_s,$tel_m,$addres,$s_access,$id_aria,$expert_unit,$username));

sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','ویرایش اطلاعات کاربر با نام کاربری :'.$username,$id_ostan) ; 
alert('اطلاعات کاربری شما با موفقیت تصحیح شد ') ;
?>
<form name="myform" class="myform" method="post" action="user_view.php">
        <input type="hidden" name="previous" value="<?php echo $previous ;?>">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ;?>" />
        <input type="hidden" name="s_access" value="<?php echo $s_access ;?>" />
         <input type="hidden" name="expert_unit" value="<?php echo $expert_unit ;?>" />
        <input type="hidden" name="action" value="1" />
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
// end click update
 }
 }
 ?>
<? if (isset($_POST['action2'])) 
 {  
?>
<form name="myform" class="myform" method="post" action="user_view.php">
        <input type="hidden" name="previous" value="<?php echo $previous ;?>">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ;?>" />
        <input type="hidden" name="s_access" value="<?php echo $s_access ;?>" />
        <input type="hidden" name="expert_unit" value="<?php echo $expert_unit ;?>" />
        <input type="hidden" name="action" value="1" />
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 }
?>
 

 <?php 
 // فانكشن آپلود فايل 
function upload($file_id, $folder="", $types="") 
{
// پوشه نام 

   if(!$_FILES[$file_id]['name']) return array('','No file specified');
      $file_title = $_FILES[$file_id]['name'];
    //Get file extension
   // $ext_arr = split("\.",basename($file_title));
   // $ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension
	$ext = substr(strrchr(basename($file_title), '.'), 1);
    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(),1)),0,5);
  //  $file_name = $id . '_' . $file_title;//Get Unique Name
    $no_file = $_POST['no_file']   ;
    $file_name = strrev($no_file).'.' . $ext;//Get Unique Name
  //  echo $file_name ; 
	$all_types = explode(",",strtolower($types));
    if($types) {
        if(in_array($ext,$all_types));
        else {
            $result = 'فايل غير مجاز' ;
			echo "<br/>\n" ;
			 //Show error if any.
        //   return array('',$result);
		  return array($file_name,$result);
        }
    }
    //Where the file must be uploaded to
    if($folder) $folder .= '/';//Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;
    $result = 1;
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "امكان آپلود فايل وجود ندارد "; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : مقصد يافت نشد ";
        } elseif(!is_writable($folder)) {
            $result .= " : امكان نوشتن در مقصد وجود ندارد";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : فايل قابل نوشتن نيست";
        }
        $file_name = '';
        
    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result =  " فايل خالي است لطفا يك فايل معتبر انتخاب كنيد "; //Show the error message
			echo "<br/>\n" ;
        } else {
// کنترل حجم فایل
           if ((($_FILES[$file_id]['size'])<2000) || (($_FILES[$file_id]['size'])>30000))
		    { //Check if the file is made
            $file_name = '';
            $result =  "  حجم فایل ارسالی نباید از 2 کیلوبایت کمتر و از 30 کیلوبایت بیشتر باشد "; //Show the error message
			echo "<br/>\n" ;
        } else {

			 chmod($uploadfile,0777);//Make it universally writable.
        }
    }
		  return array($file_name,$result);
}
}
////End
?>
