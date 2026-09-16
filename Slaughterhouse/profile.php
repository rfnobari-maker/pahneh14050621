<?php include('../lock_slau.php');?>
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
include('../date_con.php');
include('../event.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
$query = "SELECT * FROM users WHERE  username='".$user_check."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$cod_m    = $row['cod_m'] ; 
$username = $row['username']; 
$ostan    = $row['ostan']; 
$name_m   = $row['name']; 
$last_name = $row['Last_name']; 
$tel_s = $row['tel_s']; 
 $tel_m = $row['tel_m']; 
// حذف تصویر
 if (isset($_POST['del_pic']))
 {
 $file ='../files/users/'.$row_del['pic'] ;
unlink($file);
$query = "UPDATE users SET pic=?  WHERE username=?";
$q = $dbh->prepare($query);
$q->execute(array('',$user_check));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','حذف تصویر کاربر') ; 
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
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','آپلود تصویر کاربر') ; 
} 
$query = "SELECT * from users WHERE username='".$user_check."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
// $row تک خطی 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 ?>
            </p>
            <p align="center" ><span class="style1">ویرایش اطلاعات کاربر</span></p>
            <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <form action="" method="post" enctype="multipart/form-data">
              <table width="75%" border="0" align="center" cellpadding="0" cellspacing="0" >
                <tr>
                      <td width="352" height="235" align="center" bgcolor="#FFFFFF"><p align="justify" class="normalTextSmall"  style="direction:rtl; color:#900 ; margin-right:20px ; margin-left:20px" >تصویر کاربر </p>
                        <p align="justify" class="style2"  style="direction:rtl; color:#900 ; margin-right:20px ; margin-left:20px" >- حجم فایل ارسالی نباید از 2 کیلوبایت کمتر و از 30 کیلوبایت بیشتر باشد</p>
                      <p align="justify" class="style2" style="direction:rtl ; color:#900; margin-right:20px ; margin-left:20px">- برای تغییر تصویر موجود ، ابتدا تصویر قبلی را حذف نمایید .</p>
                      <p align="justify" class="style2" style="direction:rtl ; color:#900; margin-right:20px ; margin-left:20px">- پس ار ارسال تصویر جدید ، برای مشاهده تغییرات ، کلید F5 را فشار دهید. </p></td>
                      <td width="310" align="center" bgcolor="#FFFFFF"><p class="up_row">
                        <?php if($row['pic']<>""){
							 		?>
            <img style="border:1px solid #021a40;" src="<?php echo '../files/users/'.$row['pic'];?>"  width="87" height="107"/>                      
                        <p class="up_row">
                          <input type="submit" name="del_pic"  value="حذف"   style="width:50px; height:30px ; font-family:Tahoma, Geneva, sans-serif " />
                        </p>
                        <?php }  else { echo '<img style="border:1px solid #021a40;" src=../files/users/no_pic.png  width=87 height=107/>' ;}?>
                        <p>
                        <input type="hidden" name="no_file" value="<?php echo $username ; ?>" />
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
       <div style="margin-right:40px" align="right"><strong>اطلاعات محل خدمت </strong></div></td>
     </tr>
   <tr>
     <td width="319" height="48"><div align="right">
       <input name="cod_m" type="text" id="cod_m" style="height:26px ; width:150px ; background:#0CF ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $cod_m ?>" readonly="readonly" />
     </div></td>
     <td width="148"><div align="right">: کد ملی</div></td>
     <td width="30">&nbsp;</td>
     <td width="237"><div align="right" >
       <input name="ostan" type="text" class="required" id="ostan" style="width:200px; height:30px ; background:#0CF " dir="rtl" lang="fa" value="<?php echo $ostan ; ?>" maxlength="50" xml:lang="fa" readonly="readonly"/>
     </div></td>
     <td width="158"><div style="margin-right:15px" align="right">: استان</div></td>
     </tr>
   <tr>
     <td height="38" colspan="5" align="center"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></td>
   </tr>
      <tr>
   <td height="38" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات کاربر</strong></div></td>
     </tr>
   <tr>
     <td height="38"><div align="right">
       <input name="last_name" type="text" class="required" style="width:200px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" xml:lang="fa" />
       </div></td>
     <td><div align="right">:نام کشتارگاه</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
   <input name="name" type="text" class="required" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $name_m ; ?>" maxlength="50" xml:lang="fa" />
       </div></td>
     <td><div style="margin-right:15px" align="right">: نام نماینده</div></td>
   </tr>
   <tr>
     <td height="38"><div align="right"><span class="style2"><img src="../files/sms.png" width="25" height="25" /></span>
       <input name="tel_m" type="text" class="required digits" id="tel_m" style="width:150px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" xml:lang="fa"/>
       </div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
       <input name="tel_s" type="text" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
       </div></td>
     <td><div style="margin-right:15px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
 <td width="319"></p>
   <tr>
     <td colspan="5" align="center">&nbsp;</td>
   </tr>
   </table>
   <p>
   <input type="hidden" name="username"  value="<?php echo $username ;?>" />
   <input type="hidden" name="previous" value="<?php echo $previous ;?>">
     <input type="submit" name="action" value="تصحیح اطلاعات" style="width:150px ; height:45px" tabindex="18" />

   </p>

   </p>

 </div>

    </form>

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
 $name = $_POST['name']; 
 $last_name = $_POST['last_name']; 
 $tel_s = $_POST['tel_s']; 
 $tel_m = $_POST['tel_m']; 

// تعریف متغیرهای که هنگام لود فرم خالی رد میشن
{ 
include('../login/config.php');
$query = "UPDATE users 
        SET  name=?,Last_name=?,tel_s=?,tel_m=?
		WHERE username=?";
$q = $dbh->prepare($query);
$q->execute(array($name,$last_name,$tel_s,$tel_m,$username
));

sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','ویرایش اطلاعات کاربر') ; 
alert('اطلاعات کاربری شما با موفقیت تصحیح شد ') ;
?>
<form name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
// end click update
 }
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
<?php if(isset($_GET["a"]))  
{
$string = 'کاربر گرامی : برای استفاده از امکانات سامانه تکمیل اطلاعات کاربری و آپلود عکس پرسنلی ، الزامی است' ;
echo '<script type="text/javascript">alert("' . $string . '");</script>' ; 
}
?>