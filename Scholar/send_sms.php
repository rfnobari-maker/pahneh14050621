<?php
include ("../lock_Sc.php");
include '../sms.php' ; 
$username=$_POST['username'] ;
$tel_m=$_POST['tel_m'] ;
if(strlen($tel_m)== 10) $tel_m ='0'.$tel_m ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی</title>
<script>
function close_window() {
      close();
 }
</script>
<style>
#send
{ font-family:Tahoma ; color:#039 ; border-radius:10px 
	
	}

#send:hover
{ background-color:#FF6
	
}
#notok
{
	  padding-top:100px ; color:#FFF ; line-height:200% ; font-family:Tahoma ; font-size:16px ; width:200px 
}
body {
    background-image: url(../files/mobile.png);
    background-repeat: no-repeat;
}
</style>
</head>
<body>
<div align="center">
<?php if(strlen($tel_m)== 11)
{
?>
<form action="" method="post" >
  <p>&nbsp;</p>
  <p>&nbsp;    </p>
  <p><br />
    <input name="tel_m" type="text" style="width:90px" disabled="disabled" id="textfield" value="<?php echo $tel_m ?>" />
    :
    شماره 
    <br />
    <br />
<textarea name="message" style=" direction:rtl ; width:180px ; height:125px ; font-family:Tahoma ; font-size:14px ; color:#069 " maxlength="150" placeholder="متن پیام شما"></textarea>
    <input type="hidden" name="tel_m" value="<? echo $tel_m ; ?>">
  </p>
  <p style="font-family: Tahoma; font-size: 10px; color: #900;">طول پیام حداکثر 150 کارکتر </p>
  <p>
    <input type="submit"  id="send" name="action" value="ارسال" style="width:100px ; height:30px" tabindex="39" />
</p>
</form>
<?php 
}
else 
{
echo '<div id=notok>' ;
echo 'امکان ارسال پیامک مقدور نیست' ;
echo '<p>' ;
echo 'شماره تلفن همراه ، کاربر مورد نظر معتبر نمی باشد  ' ;
echo '</div>' ;
}
?>
<button  id="send" onclick="close_window()">انصراف</button>
</div>
</body>
<?php  if (isset($_POST['action'])) 
 {  
 $message = $_POST['message']; 
 $tel_m = $_POST['tel_m']; 
if (strlen($message<10))
{
 sms($tel_m,$message.'(سامانه پهنه بندی/فرستنده پیام : '.$PersName.')') ;
alert('پیام شما با موفقیت ارسال شد '); 
}
else 
{
alert('پیام ارسالی حداقل باید 10 کارکتر باشد'); 
}
 }
 ?>
<?php
  function alert($string)
{
    echo '<script type="text/javascript">alert("' . $string . '");</script>';
}
?>
