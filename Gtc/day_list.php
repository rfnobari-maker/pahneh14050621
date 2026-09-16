<?php
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$days_ago = 1 ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
</head>
<body>
<p></p>
<p></p>
<p></p>
<p></p>
<div align="center"  style=" margin:auto ; padding:25px ;  font-family:tahoma; font-size:16px ; background-color:#CC9 ; width:450px ; height:350px ; border-radius: 25px ">
<form action="export_csv.php" method="post">
	<p class="style8">لیست روزانه گندم کاران سال زراعی 1397-1396</p>
	<p>&nbsp;</p>
	<p>امروز : <?php echo jdate('Y/m/d') ?></p>
	<p><br>
	 دریافت اطلاعات ثبت شده 
	  <input name="days_ago" type="text" class="fvheader"  style="width:40px ; height:35px ; font-size:18px " value="<?php echo $days_ago?>" > 
    روز قبل</p>
	<p style="color:#F00 ; font-size:14px"><?php if(isset($_POST['error'])) echo $_POST['error'] ?></p>
	<p><br>
	  <br>
	  <input type="submit" align="middle" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:150px ; height:40px ; direction:rtl ; " value="دریافت فایل CSV ">
    </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
           <p align="center"><a href="index.php" title="برگشت به صفحه قبل"><img src="files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          <p>&nbsp;</p></td>

</body>
</html>