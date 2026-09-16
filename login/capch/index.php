<?php
include("db.php");
session_start();

$msg='';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$recaptcha=$_POST['g-recaptcha-response'];
if(!empty($recaptcha))
{
include("getCurlData.php");
$google_url="https://www.google.com/recaptcha/api/siteverify";
$secret='6Le49g0UAAAAAKGw0g0t9vviyaRefUf6OBsIdtUe';
$ip=$_SERVER['REMOTE_ADDR'];
$url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
$res=getCurlData($url);
$res= json_decode($res, true);
if($res['success'])
{

/********/
$username=mysqli_real_escape_string($db,$_POST['username']); 
$password=md5(mysqli_real_escape_string($db,$_POST['password'])); 
if(!empty($username) && !empty($password))
{

$result=mysqli_query($db,"SELECT id FROM users WHERE username='$username' and passcode='$password'");
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
if(mysqli_num_rows($result)==1)
{
$_SESSION['login_user']=$username;
header("location: home.php");
}
else
{
$msg="Please give valid Username or Password.";
}

}
else
{
$msg="Please give valid Username or Password.";
}
/********/
}
else
{
$msg="Please re-enter your reCAPTCHA.";
}

}
else
{
$msg="Please re-enter your reCAPTCHA.";
}

}
?>



<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Google reCaptcha 2</title>
<link rel="stylesheet" href="css/style.css"/>
<script src='https://www.google.com/recaptcha/api.js'></script>
	
</head>

<body>
<div id="main">
<h1>Google reCaptcha 2</h1>
<div>Demo <a href="http://www.9lessons.info">Tutorial Link</a> - 9lessons Programming Blog <a href="http://9lessons.info">9lessons.info</a><br/><br/></div>

					

<div id="box">
<form action="" method="post">
<label>Username</label> <input type="text" name="username" class="input" />
<label>Password </label><input type="password" name="password" class="input" />
<br/><br/>
<div class="g-recaptcha" data-sitekey="6Le49g0UAAAAAIdbC8IUyH4ZaSOTbjvTHkmi4zXP"></div>
<br/>
<input type="submit" class="button button-primary" value="Log In" id="login"/> 

<span class='msg'><?php echo $msg; ?></span>
</form>
</div>


</div>
<iframe src="http://demos.9lessons.info/counter.html" frameborder="0" scrolling="no" height="0"></iframe>

</body>
</html>
