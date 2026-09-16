<?php
session_start();
include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from form 
$myusername=$_POST['User_Name'];
$mypass=$_POST['Pass'];
$query = "SELECT * FROM users WHERE username='$myusername'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = $stmt->fetch(PDO::FETCH_ASSOC);
foreach($stmt as $r){
  $p=$r['password'];
  $p_salt=$r['psalt'];
  $id=$r['id'];
  $access= $r['Access']; 
  $s_access=$r['S_access']; 
  $PersName=$r['Last_name'];
  $site_salt="subinsblogsalt";
 $salted_hash = hash('sha256',$mypass.$site_salt.$p_salt);
 if($p==$salted_hash){
 echo 'shod' ; 
	 if ($access == 1)
  {
//session_register('myusername');
$_SESSION['login_user']=$myusername;
$_SESSION['karbar']=$s_access ;
$_SESSION[‘last_acted_on’] = time();
if ($s_access==1) $firstpage = "index.php";
if ($s_access==2) $firstpage = "Centers";
if ($s_access==3) $firstpage = "Expert";
if ($s_access==4) $firstpage = "Expert";
if ($s_access==5) $firstpage = "Expert";
if ($s_access==6) $firstpage = "Secretary";
if ($s_access==7) $firstpage = "Advisor";
if ($s_access==8) $firstpage = "Advisor";
if ($s_access==9) $firstpage = "Responsible";
if ($s_access==10) $firstpage = "Subchief";
if ($s_access==11) $firstpage = "chief";
if ($s_access==12) $firstpage = "maneger";
if ($s_access==13) $firstpage = "maneger";
if ($s_access==14) $firstpage = "maneger";
if ($s_access==15) $firstpage = "maneger";
if ($s_access==16) $firstpage = "Cexpert";
if ($s_access==99) $firstpage = "asystem";
header('Location: http://pahneh.eaj.ir/'.$firstpage);
//last_user
include('../Jalali.php');
$ip = $_SERVER['REMOTE_ADDR'];
date_default_timezone_set('Asia/Tehran') ;
$date = jdate("Y/m/d") ;
$time = date('H:i:s') ;
$query = "INSERT INTO Last_user (date,time,ip,PersName,PersCode) VALUES (:date,:time,:ip,:PersName,:myusername)";
$q = $dbh->prepare($query);
$q->execute(array(':date'=>$date,':time'=>$time,':ip'=>$ip,':PersName'=>$PersName,':myusername'=>$myusername));
//End of Last_user
}
else 
{
$error="دسترسی شما به سامانه محدود شده است";
}
}
else
{
$error=" نام کاربری یا کلمه عبور اشتباه است ";
}
}
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="http://pahneh.eaj.ir/files/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="http://pahneh.eaj.ir/files/images/favicon.ico" type="image/x-icon">
<META content="سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی " name=description>
<META content="سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی   " name=keywords>
<title>سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی </title>
<style type="text/css">
label
{
font-weight:bold;
width:100px;
font-size:14px;
}
.btn {
  background: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family:Tahoma;
  color: #ffffff;
  font-size: 20px;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
  float:left;
}
.btn:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}
.box
{
border:#666666 solid 1px;
}
.style2 {font-size: 10px; }
.style3 {
	color: #000000;
	font-size: 12px;
}
.style5 {font-size: 10px; color: #000033; }
.style6 {
	font-size: 14px;
	font-weight: bold;
}
.style8 {
	font-size: 10px;
	color: #990000;
	text-decoration: none;
	direction: rtl;
}
.com
{
	font-family:tahoma;
	font-size:12px;
	color:#666;
	direction:rtl;
	margin-right:15px;
	margin-left:25px;
	text-align: justify;
	}
</style>
<link href="../PayAdmin/FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style21 {color: #666666}
.style4 {color: #E0DFE3}
.style7 {	color: #000033;
	font-weight: bold;
	font-size: 16px;
	font-family: Tahoma;
}
.style91 {font-family: Tahoma; font-size: 26px;}
</style>
<link href="../FA.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="949" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="152" bgcolor="#FFFFFF"><img src="../files/images/header.jpg" width="949" height="149" /></td>
  </tr>
  <tr>
    <td height="502" bgcolor="#ACC3B1"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td height="232" colspan="2" ><p class="RedTitleSmall">**آخرین  تغییرات در سامانه **</p>
          <p align="justify" dir="rtl" style="margin-right:15px">
            <textarea name="textarea" id="textarea" cols="45" rows="5" dir="rtl"  style="width:550px ; height:180px ; font-family:Tahoma ; color:#069; font-size:14px">

12- شروع برنامه نویسی پنل ویژه روسای مراکز جهاد کشاورزی \ 8 مرداد 94 

11- امکان جستجوی مروج و مشاهده عملکرد آن در سامانه  

10- ثبت بانک اطلاعاتی روسای مراکز جهاد کشاورزی 

9- آغاز رسمی فاز یک سامانه \ 6 مرداد 94

8- امکان مشاهده و ویرایش اطلاعات عمومی آبادی توسط مروجین 

7- ورود اطلاعات عمومی آبادی ها بر اساس سرشماری عمومی نفوس و مسکن 1390 در پایگاه داده 

6- راه اندازی فرم آبادی های تحت پوشش هر مروج 

5- راه اندازی فرم آپلود تصویر و ویرایش مشخصات اختصاصی مروجین 

4- راه اندازی پنل ویژه مروجین 

3- اختصاص نام کاربری و کلمه عبور برای 477 نفر از مروجین 

2- ثبت لیست مروجین استان به تفکیک آبادی تحت پوشش 

1- ثبت لیست آبادی های استان به تفکیک شهرستان ، بخش ، دهستان و مرکز خدمات 
</textarea>
            <br />
        </p></td>
        <td width="327" rowspan="2" align="center"   valign="top"  background="../files/back.png"> 
        <div style="width:300px; margin-right: 0px; align="left" >
          <div align="right">
            <p  ><br />
            <span class="style8">سامانه شبکه پهنه بندی </span></p>
            <p   class="style8"> آبادی های استان آذربایجان شرقی  </p>
            <p  >1 ویرایش</p>
            <p class="style21" align="center">ورود به سامانه<img src="../files/lock.gif" width="32" height="32" /></p>
  </div>
          <div style="margin:25px; margin-top: 0px;">
            
            <form name="frmlogin" action="" method="post">
              <label></label>
              <p align="right"> <span class="normalTextSmall"><br />
                </span><span class="Row-Footer">: نام کاربری</span><span class="normalTextSmall"><br />
                  </span>
                <input name="User_Name" type="text" class="box"  style="width:150px ; height:25px " />
                </p>
              <p align="right"><span class="Row-Footer">: كلمه عبور</span><br />
                <input name="Pass" type="password" AUTOCOMPLETE="off" class="box"  style=" width:150px ; height:25px"  />
                </p>
              <p align="right"><span style="font-size:11px; color:#cc0000; margin-top:10px; text-align: center;"><?php echo $error; ?></span></p>
              <p align="right">&nbsp;</p>
              <p align="right">
                <input style="font-family:Tahoma ; font-size:12px ; height:40px ; width:100px " name="submit" type="submit" value="ورود به سامانه " />
                </p>
  <p>&nbsp;</p>
  </form>
            <div style="font-size:11px; color:#cc0000; margin-top:10px; text-align: center;"></div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td width="300" align="justify" valign="top" dir="rtl" ><p align="center" class="link">آخرین کاربران سامانه:
                </p><p align="center" >
                  <?php include('last_user1.php');?>
          </p></td>
        <td width="322" align="justify" valign="top" dir="rtl" ><p class="com"><br />
          </p>
          <p style="width:90%"><span class="com"><img src="../files/jadid.gif" width="35" height="15" /> کاربران گرامی  ، در صورتی که از کلمه عبور پیشفرض استفاده میکنید ، به محض ورود به سامانه با استفاده از گزینه </span><span class="style8">تغییر کلمه عبور</span><span class="com"> نسبت به تغییر آن اقدام نمایید.</span></p>
          <p><img src="../files/contact-phone.png" width="47" height="40"  alt=""/></p>
          <p class="style9"><span class="normalTextSmall">پشتیبانی سامانه : 34439637 041</span></p>
          <p class="style9"><span class="LinkRedTitle"> <span class="normalTextSmall">پست الکترونیک</span><a href="mailto:info@aeo-azsh.ir" class="LinkRedTitle"> : Pahneh(At)eaj(Dot)ir </a></span></p>
          <p><span class="normalTextSmall">برای استفاده بهینه از خدمات سایت</span></p>
          <p><span class="normalTextSmall"> از مرورگرهای</span><img src="../files/f.png" width="30" height="29" /><span class="normalTextSmall">یا</span><img src="../files/ch.png" width="30" height="28" /><span class="normalTextSmall">استفاده نمایید</span></p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
            <td  height="100px"colspan="2" valign="middle" background="../files/bottom.gif"><p class="MenuItemRight">&nbsp;</p>
              <p class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 34438000-6 041 فکس: 334439940 041<br />
              <span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
  </tr>
</table>
<p><!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code --></p>
</body>
</html>