<?php include('../../../lock_p2.php');
$cod_m = $_POST['cod_m'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<link rel="stylesheet" href="../../../jspc-gray.css">
<script type="text/javascript" src="../../../js-persian-cal.min.js"></script>
<script type="text/javascript" src="../../../script.js"></script>
<style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
-->
    </style>
	<script src="../../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../../15_files/messages_fa.js" type="text/javascript"></script>
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
            <td><img src="../../../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4">
 </td>
    <td width="840" >
              <?php
include('../../../date_con.php');
include('../../../event.php');
require_once('../../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('top.php');
include('../../../login/config.php');
$query = "SELECT * FROM users WHERE  cod_m='$cod_m'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $username = $row['username']; 
 $ostan = $row['ostan']; 
 $city = $row['city']; 
 $markaz = $row['markaz']; 
 $date_es = $row['date_es']; 
 $date_kh = $row['date_kh']; 
 $cod_m = $row['cod_m']; 
 $name1 = $row['name']; 
 $last_name = $row['Last_name']; 
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
 $tel_s = $row['tel_s']; 
 $tel_m = $row['tel_m']; 
 $addres = $row['addres']; 
 $id = $row['id']; 

// حذف تصویر
 if (isset($_POST['del_pic']))
 {
$file ='../../../files/users/'.$row_del['pic'] ;
//unlink($file);
$query = "UPDATE users SET pic=?  WHERE cod_m=?";
$q = $dbh->prepare($query);
$q->execute(array('',$cod_m));
sabt_event1($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','حذف تصویر پرسنل پشتیبانی',$id_ostan) ; 
 }
 //
if($_FILES['pic']['name']) {
list($name,$result) = upload('pic','../../../files/users','jpg,jpeg,gif,png');
if ($result==1) {
$pic =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >تصویر  با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo "<br align='center' style='text-decoration:rtl'> <font size=3 color='#900 ' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
$pic = '' ; 
  }
 }
if (isset($_POST['action4'] ) ) {
$query = "UPDATE users 
        SET pic=? WHERE cod_m=?";
$q = $dbh->prepare($query);
$q->execute(array($pic,$cod_m));
sabt_event1($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','آپلود تصویر پرسنل پشتیبانی',$id_ostan) ; 
} 
$query = "SELECT * from users WHERE cod_m='$cod_m'";
$stmt = $dbh->prepare($query);
$stmt->execute();
// $row تک خطی 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 ?>
            </p>
            <span class="style1">ویرایش اطلاعات سرباز سازندگی ، مرکز </span>
            <p align="center" ><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <form action="" method="post" enctype="multipart/form-data">
            <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" >
                <tr>
                      <td width="282" height="235" align="center" bgcolor="#FFFFCC"><p align="justify" class="normalTextSmall"  style="direction:rtl; color:#900 ; margin-right:20px ; margin-left:20px" >تصویر سرباز سازندگی</p>
                        <p align="justify" class="style2"  style="direction:rtl; color:#900 ; margin-right:20px ; margin-left:20px" >- حجم فایل ارسالی نباید از 3 کیلوبایت کمتر و از 30 کیلوبایت بیشتر باشد</p>
                      <p align="justify" class="style2" style="direction:rtl ; color:#900; margin-right:20px ; margin-left:20px">- برای تغییر تصویر موجود ، ابتدا تصویر قبلی را حذف نمایید .</p></td>
                      <td width="257" align="center" bgcolor="#FFFFCC"><p class="up_row">
                        <?php if($row['pic']<>""){
							 		?>
            <img style="border:1px solid #021a40;" src="<?php echo 'http://pahneh.eaj.ir/files/users/'.$row['pic'];?>"  width="87" height="107"/>                      
                        <p class="up_row">
                          <input type="submit" name="del_pic"  value="حذف"   style="width:50px; height:30px ; font-family:Tahoma, Geneva, sans-serif " />
                        </p>
                        <?php }  else { echo '<img style="border:1px solid #021a40;" src=../../../files/users/no_pic.png  width=87 height=107/>' ;}?>
                        <p>
                        <input type="hidden" name="no_file" value="<?php echo $cod_m ; ?>" />
                        <input type="hidden" name="cod_m" value="<?php echo $cod_m ; ?>" />
                        <input type="submit" value="ارسال فايل" name="action4"  <?php if($row['pic']<>"") { echo ' disabled="disabled"';}?>/>
                  <input name="pic" type="file" id="pic"  accept=".jpg,.jpeg,.gif,.png" /></td>
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
              <td height="18" colspan="5" class="style9" ><span style="color: #069"></span></td>
            </tr>
            <tr>
              <td width="319" height="48"><div align="right">
                <input name="city" type="text" id="city" style="height:26px ; width:150px ; background:#0CF ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $city ?>" readonly="readonly" />
              </div></td>
              <td width="148"><div align="right">:شهرستان </div></td>
              <td width="30">&nbsp;</td>
              <td width="237"><div align="right" >
                <input name="ostan" type="text" class="required" id="ostan" style="width:200px; height:30px ; background:#0CF " dir="rtl" lang="fa" value="<?php echo $ostan ; ?>" maxlength="50" xml:lang="fa" readonly="readonly"/>
              </div></td>
              <td width="158"><div style="margin-right:15px" align="right">: استان</div></td>
            </tr>
            <tr>
              <td height="48">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><div align="right">
                <input name="markaz" type="text" id="markaz" style="height:26px ; font-size:12px ; background:#0CF ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $markaz ?>" readonly="readonly" />
              </div></td>
              <td><div style="margin-right:15px" align="right">: مرکز جهاد کشاورزی </div></td>
            </tr>
            <tr>
              <td height="38"><div align="right" dir="rtl">
                <input name="date_kh" type="text" class="pdate required" id="pcal4" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $date_kh ; ?>" maxlength="10" xml:lang="fa" />
              </div></td>
              <td><div align="right">:تاریخ خاتمه خدمت</div></td>
              <td height="38" align="center">&nbsp;</td>
              <td height="42" dir="rtl"><div align="right">
                <input name="date_es" type="text" class="pdate required" id="pcal3" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $date_es ; ?>" maxlength="10" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" > : تاریخ شروع به کار</div></td>
            </tr>
            <tr>
              <td height="38"><div align="right">
                <input name="last_name" type="text" class="required" style="width:200px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" xml:lang="fa" />
              </div></td>
              <td><div align="right">:نام خانوادگی</div></td>
              <td rowspan="8">&nbsp;</td>
              <td><div align="right">
                <input name="name" type="text" class="required" style="width:150px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $name1 ; ?>" maxlength="50" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right">: نام</div></td>
            </tr>
            <tr>
              <td height="38"><div align="right">
                <input name="sh_sh" type="text" class="required digits" id="sh_sh" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $sh_sh ; ?>" maxlength="20" xml:lang="fa"/>
              </div></td>
              <td><div align="right">:شماره شناسنامه</div></td>
              <td height="48"><div align="right">
                <input name="cod_m" type="text" class="required digits" id="cod_m" style="height:26px ; width:150px  ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" tabindex="5" dir="rtl"  value="<?php echo $cod_m ?>" />
              </div></td>
              <td><div style="margin-right:15px" align="right">: کد ملی</div></td>
            </tr>
            <tr>
              <td height="42"><div align="right">
                <input name="m_sodor" type="text" class="required" id="m_sodor" style="width:150px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $m_sodor ; ?>" maxlength="35" xml:lang="fa"/>
              </div></td>
              <td><div align="right">:محل صدور</div></td>
              <td height="42" dir="rtl"><div align="right">
                <input name="date_t" type="text" class="pdate required" id="pcal1" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" > : تاریخ تولد</div></td>
            </tr>
            <tr>
              <td height="38"><div align="right">
                <select name="m_tah" class="required" id="m_tah2" style="height:40px ; width:150px ; direction:rtl" tabindex="10">
                  <option value="">انتخاب کنید</option>
                  <option value="8"<?php if ($m_tah=='8') { echo 'selected="selected"' ; } ?>>بیسواد</option>
                  <option value="7"<?php if ($m_tah=='7') { echo 'selected="selected"' ; } ?>>خواندن و نوشتن</option>
                  <option value="6"<?php if ($m_tah=='6') { echo 'selected="selected"' ; } ?>>سیکل</option>
                  <option value="4" <?php if ($m_tah=='4') { echo 'selected="selected"' ; } ?>>دیپلم</option>
                  <option value="5" <?php if ($m_tah=='5') { echo 'selected="selected"' ; } ?>>فوق دیپلم</option>
                  <option value="1" <?php if ($m_tah=='1') { echo 'selected="selected"' ; } ?>>لیسانس</option>
                  <option value="2" <?php if ($m_tah=='2') { echo 'selected="selected"' ; } ?>>فوق لیسانس</option>
                  <option value="3" <?php if ($m_tah=='3') { echo 'selected="selected"' ; } ?>>دکتری</option>
                  <option value="9" <?php if ($m_tah=='9') { echo 'selected="selected"' ; } ?>>تحصیلات حوزوی</option>
                </select>
              </div></td>
              <td><div align="right">:مدرک تحصیلی</div></td>
              <td><div align="right">
                <input name="fname" type="text" class="required" id="fname" style="width:150px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $fname ; ?>" maxlength="35" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >: نام پدر</div></td>
            </tr>
            <tr>
              <td height="42"><div align="right">
                <input name="univer" type="text" class="required" id="univer" style="width:200px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $univer ; ?>" maxlength="35" xml:lang="fa" />
              </div></td>
              <td><div align="right">:نام دانشگاه</div></td>
              <td><div align="right">
                <input name="r_tah" type="text" class="required" id="r_tah" style="width:200px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $r_tah ; ?>" maxlength="35" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >:رشته تحصیلی</div></td>
            </tr>
            <tr>
              <td height="42"><div align="right">
                <input name="avre" type="text" class="required" id="avre" style="width:75px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $avre ; ?>" maxlength="5" xml:lang="fa"/>
              </div></td>
              <td><div align="right">:معدل </div></td>
              <td height="42" dir="rtl"><div align="right">
                <input name="m_date" type="text" class="pdate required" id="pcal2" style="width:150px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $m_date ; ?>" maxlength="10" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >:تاریخ اخذ مدرک</div></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
              <td height="38"><div align="right">
                <select name="v_tahol" class="required" id="v_tahol" style="height:40px ; width:150px ; direction:rtl" tabindex="15">
                  <option value="">انتخاب کنید</option>
                  <option value="1"<?php if ($v_tahol=='1') { echo 'selected="selected"' ; } ?>>متاهل</option>
                  <option value="2"<?php if ($v_tahol=='2') { echo 'selected="selected"' ; } ?>>مجرد</option>
                </select>
              </div></td>
              <td><div style="margin-right:15px" align="right" >:وضعیت تاهل</div></td>
            </tr>
            <tr>
              <td height="38"><div align="right"><span class="style2"><img src="../../../files/sms.png" width="28" height="32" /></span>
                <input name="tel_m" type="text" class="required digits" id="tel_m" style="width:150px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" xml:lang="fa"/>
              </div></td>
              <td><div align="right">:شماره همراه</div></td>
              <td><div align="right">
                <input name="tel_s" type="text" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
              </div></td>
              <td><div style="margin-right:15px" align="right" >:شماره تلفن ثابت</div></td>
            </tr>
            <tr>
              <td height="38" colspan="4"><div align="right">
                <input name="addres" type="text" class="required" id="addres" style="width:700px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $addres ; ?>" maxlength="300" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >:آدرس محل سکونت</div></td>
            </tr>
            <tr>
              <td width="319"></p></td>
            </tr>
            <tr>
              <td colspan="5" align="center">&nbsp;</td>
            </tr>
          </table>
          <p>
   <input type="hidden" name="id"  value="<?php echo $id ;?>" />
    <a href="list_sold.php"><input name="action2" type="button" style="width:150px ; height:45px" tabindex="24"  value="بازگشت" /></a>&nbsp;
     <input type="submit" name="action" value="تصحیح اطلاعات" style="width:150px ; height:45px" tabindex="39" />

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
      <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal4' );
		  </script>

<!--end form --> 
    </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>



<?php


 if (isset($_POST['action'])) 
 {  
//alert('ثبت فشرده شد'); 
 $cod_m = $_POST['cod_m']; 
 $name = $_POST['name']; 
 $last_name = $_POST['last_name']; 
 $sh_sh = $_POST['sh_sh']; 
 $date_es = $_POST['date_es']; 
 $date_kh = $_POST['date_kh']; 
 $date_t = $_POST['date_t']; 
 $m_sodor = $_POST['m_sodor']; 
 $fname = $_POST['fname']; 
 $m_tah = $_POST['m_tah']; 
 $r_tah = $_POST['r_tah']; 
 $univer = $_POST['univer']; 
 $m_date = $_POST['m_date']; 
 $avre = $_POST['avre']; 
 $v_tahol = $_POST['v_tahol']; 
 $tel_s = $_POST['tel_s']; 
 $tel_m = $_POST['tel_m']; 
 $addres = $_POST['addres']; 
 $id = $_POST['id']; 



// تعریف متغیرهای که هنگام لود فرم خالی رد میشن
{ 
include('../login/config.php');
$query = "UPDATE users 
        SET  cod_m=?,date_es=?,date_kh=?,name=?,Last_name=?,sh_sh=?,date_t=?,m_sodor=?,fname=?,m_tah=?,r_tah=?,univer=?,m_date=?,avre=?,v_tahol=?,tel_s=?,tel_m=?,addres=?
		WHERE id=?";
$q = $dbh->prepare($query);
$q->execute(array($cod_m,$date_es,$date_kh,$name,$last_name,$sh_sh,$date_t,$m_sodor,$fname,$m_tah,$r_tah,$univer,$m_date,$avre,$v_tahol,$tel_s,$tel_m,$addres,$id
));

sabt_event1($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','ویرایش اطلاعات سرباز سازندگی ',$id_ostan) ; 
alert('اطلاعات سرباز سازندگی با موفقیت تصحیح شد ') ;
?>
<form name="myform" class="myform" method="post" action="list_sold.php">
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
    $file_name = $no_file.'.' . $ext;//Get Unique Name
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
   
switch ($file_id)
 {
  case "pic":
        $max_filesize  = 30000;
		$min_filesize = 2000;
}
            $size=filesize($_FILES[$file_id]['tmp_name']);
//            $max_filesize = 122091;
            if (($size > $max_filesize) || ($size < $min_filesize))
		   {
			$result = 'حجم فایل غیر مجاز '.($size/1000).'کیلوبایت'  ;
             }
			 chmod($uploadfile,0777);//Make it universally writable.
        }
    }
		  return array($file_name,$result);
}
////End
?>
