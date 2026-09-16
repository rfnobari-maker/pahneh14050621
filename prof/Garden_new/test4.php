<?php 
include_once 'common.php';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
 strtoupper($_POST['security_code']) ;
 $_SESSION['captcha'] ;
if(strcmp(md5(strtoupper($_POST['security_code'])),$_SESSION['security_code'])!=0)
	{
$error="کد امنیتی وارد شده صحیح نیست" ;
	}
 	else
	{
		$error = 'OK' ;
}
echo $error ; 
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript">
<!--
function new_captcha()
{
var c_currentTime = new Date();
var c_miliseconds = c_currentTime.getTime();

document.getElementById('captcha').src = 'image.php?x='+ c_miliseconds;
}
-->
</script>
</head>

<body onLoad="new_captcha();">
<img border="0" id="captcha" src="image.php" alt="">
 &nbsp;<a href="JavaScript: new_captcha();"><img src="refresh.png" alt="" width="30" height="26" border="0" align="bottom"></a>
    <p align="center" style="margin-top:-5px">
     <form method="post">
      <input name="security_code" type="text"  class="input_text" id="security_code" placeholder="کد امنیتی " style=" width:120px ; height:25px ; border: 1px solid #295C89; border-radius: 10px ; margin-top:10px"  tabindex="3" autocomplete="off"  onfocus="[php light=”true”]
using System.Globalization;
InputLanguage.CurrentInputLanguage = InputLanguage.FromCulture(new CultureInfo("fa-IR"));
[/php]"/>
      <span class="text1">: کد امنیتی</span></p>
      <input type="submit" name="submit" value="ثبت" >
      </form>
    <p align="center" style="margin-top:-5px">&nbsp;</p>
</body>
</html>