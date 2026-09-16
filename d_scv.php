<?php
require_once('Jalali.php');
$days_ago = 1 ; 
?>
<div align="center"  style=" margin:auto ; padding:25px ;  font-family:tahoma; font-size:16px ; background-color:#CC9 ; width:450px ; height:250px ; border-radius: 25px ">
<form action="export_csv.php" method="post">
	<p>
    امروز : <?php echo jdate('Y/m/d') ?></p>
	<p><br>
	  <br>
	 دریافت اطلاعات ثبت شده 
	  <input type="text" name="days_ago" style="width:40px ; height:35px ; font-size:18 " value="<?php echo $days_ago?>" min="1"> 
    روز قبل هستم    </p>
	<p>&nbsp;</p>
	<p><br>
	  <br>
	  <input type="submit" align="middle" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px " value="دریافت ">
    </p>
</form>
</div>
