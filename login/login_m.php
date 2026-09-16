<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
include("config.php");
include_once 'common.php';
strtoupper($_POST['security_code']) ;
if(isset($_SESSION['captcha']))$_SESSION['captcha'] ;
if(strcmp(md5(strtoupper($_POST['security_code'])),$_SESSION['security_code'])!=0)
	{
$error="کد امنیتی وارد شده صحیح نیست" ;
	}
 	else
	{
// username and password sent from form 
$myusername=$_POST['User_Name'];
$mypass=$_POST['Pass'];
 $sql=$dbh->prepare("SELECT username,cod_m,Last_name,ostan,city,id_ostan,id_city,markaz,id_mar,name,jens,
date_pas,password,psalt,id,Access,S_access,Last_name,pic  FROM users WHERE username=?");
 $sql->execute(array($myusername));
 while($r=$sql->fetch()){
  $p=$r['password'];
  $p_salt=$r['psalt'];
  $id=$r['id'];
  $access= $r['Access']; 
  $s_access=$r['S_access']; 
  $PersName=$r['Last_name'];
  $_SESSION['username']  =$r['username'];
  $_SESSION['cod_m']     =$r['cod_m'];
  $_SESSION['PersName']  = $r['Last_name'];
  $_SESSION['ostan']     = $r['ostan'];
  $_SESSION['city']      = $r['city'];
  $_SESSION['id_ostan']  = $r['id_ostan']; 
  $_SESSION['id_city']   = $r['id_city'];
  $_SESSION['markaz']    = $r['markaz'];
  $_SESSION['id_mar']    = $r['id_mar'];
  $_SESSION['name']      = $r['name'];
  $_SESSION['jens']      = $r['jens'];
  $_SESSION['date_pas']  = $r['date_pas'];

  if ($_SESSION['jens'] == 'مرد') { $_SESSION['v_jen'] = 'آقای' ; }
  if ($_SESSION['jens'] == 'زن')  { $_SESSION['v_jen'] = 'خانم';}

  $_SESSION['pic'] = $r['pic'];
 if ($_SESSION['pic'] =='') $_SESSION['pic'] = 'no_pic.png' ;
  }
 $site_salt="subinsblogsalt";
 $salted_hash = hash('sha256',$mypass.$site_salt.$p_salt);
 if($p==$salted_hash){
	 if ($access == 1)
 {
//session_register('myusername');
$_SESSION['login_user']=$myusername;
$_SESSION['karbar']=$s_access ;
$_SESSION['last_acted_on'] = time();
$_SESSION['title'] = 'سامانه جامع پهنه بندی و مدیریت داده های کشاورزی' ; 
if ($s_access==1)  $firstpage = 'indexbenef.php' and  $_SESSION['no_karbar'] = 'مروج کشاورزی ' ; 
if ($s_access==2)  $firstpage = "Centers"        and  $_SESSION['no_karbar'] = 'رئیس مرکز ' ; 
if ($s_access==3)  $firstpage = "Cities";
if ($s_access==4)  $firstpage = "oChief";
if ($s_access==5)  $firstpage = "Expert_aria";
if ($s_access==6)  $firstpage = "Expert_sh";
if ($s_access==7)  $firstpage = "Scholar";
if ($s_access==8)  $firstpage = "Slaughterhouse";
if ($s_access==20) $firstpage = "Chief";
if ($s_access==21) $firstpage = "Dafa";
if ($s_access==22) $firstpage = "Gtc";
if ($s_access==98) $firstpage = "oasystem";
if ($s_access==99) $firstpage = "asystem";
header('Location: ../'.$firstpage);
//last_user
include('../Jalali.php');
$ip = getUserIP();
date_default_timezone_set('Asia/Tehran') ;
$date = jdate("Y/m/d") ;
$time = date('H:i:s') ;
$query = "INSERT INTO Last_user (date,time,ip,PersName,PersCode) VALUES (:date,:time,:ip,:PersName,:myusername)";
$q = $dbh->prepare($query);
$q->execute(array(':date'=>$date,':time'=>$time,':ip'=>$ip,':PersName'=>$PersName,':myusername'=>$myusername));
//End of Last_user
$dbh = null;
}
else 
{
$error="دسترسی شما به سامانه مسدود شده است";
//$error="مراجعه فرمایید http://10.7.234.61 از ساعت 7 لغایت 13 به آدرس";
}
}
else
{
$error=" نام کاربری یا کلمه عبور اشتباه است ";
}
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../files/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="login_style.css"  />
<META content="سامانه جامع پهنه بندی و  مدیریت داده های کشاورزی" name=description>
<title>سامانه جامع پهنه بندی و مدیریت داده های کشاورزی</title>
<link href="../FA.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="./cont_files/custom.css">
<script type="text/javascript" async src="./cont_files/ga.js"></script>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
</head>
<!-- CSS برای استایل مدال -->
<style>
/* استایل برای مدال */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

/* محتویات مدال */
.modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px; /* عرض مدال */
    height: 300px; /* ارتفاع مدال */
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
	border-radius: 15px;
	
	
}

/* دکمه بستن مدال */
.close {
    position: absolute;
    top: 10px;
    right: 16px;
    font-size: 24px;
    cursor: pointer;
}

</style>

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

<link href="js-image-slider.css" rel="stylesheet" type="text/css" />
<script src="js-image-slider.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body onload="new_captcha();"> 
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td bgcolor="#FFFFFF"><img src="../files/images/header46.jpg" width="100%" height="157" /></td>
  </tr>
  <tr>
 <td height="461" valign="top" bgcolor="#FFFFFF"><table width="100%" border="5" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="337" rowspan="2" bgcolor="#ACC3B1" valign="top">
           <div style="float: left; margin-left: 20px; margin-right: 30px; margin-top: 20px; margin-bottom: 20px; background:radial-gradient(#CCC,#FFF) ; border-radius: 10px; width: 300px;">
    <img src="../files/login.png" width="169" height="59" alt=""/>
    <form action="" method="post" name="frmlogin" id="frmlogin">
        <p>
            <input name="User_Name" type="text" class="input_text" placeholder="نام کاربری" style="width: 170px; height: 30px; border: 1px solid #295C89; border-radius: 10px" tabindex="1" />
        </p>
        
        <p>
            <input name="Pass" type="password" class="input_text" placeholder="کلمه عبور" style="width: 170px; height: 30px; border: 1px solid #295C89; border-radius: 10px" tabindex="2" autocomplete="off" />
        </p>

        <img border="0" id="captcha" src="image.php" alt="">
        &nbsp;<a href="JavaScript: new_captcha();"><img src="refresh.png" alt="" width="30" height="26" border="0" align="bottom"></a>
        <br>
            <input name="security_code" type="text" class="input_text" id="security_code" placeholder="کد امنیتی" style="width: 170px; height: 30px; border: 1px solid #295C89; border-radius: 10px; margin-top: 10px;" tabindex="3" autocomplete="off" />
        </p>

        <p >
            <input name="submit" type="submit" class="btn-33" id="login" tabindex="4" value="ورود" />
            <br /><span style="font-size: 13px; color: #cc0000; margin-top: 15px; text-align: center; ">
                <?php if(isset($error)) echo $error; ?>
            </span>
        </p>
        <p>
            <!-- دکمه فراموشی رمز عبور -->
            <a href="#" class="btn-33" style="font-size: 12px;" onclick="openModal(); return false;">فراموشی رمز عبور؟</a>

            <!-- مدال برای نمایش محتوای forget.php -->
            <div id="modal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <iframe id="forgetIframe" width="100%" height="100%" style="border: none;  border-radius: 15px;"></iframe>
                </div>
            </div>
        </p>
    </form>
    <div class="normalTextSmall" style="margin: 10px; margin-top: 5px; direction: rtl;">
        از مرورگرهای 
        <a title='دانلود مرورگر موزیلا فایرفاکس' href="https://www.p30world.com/106/%D8%AF%D8%A7%D9%86%D9%84%D9%88%D8%AF-%D9%81%D8%A7%DB%8C%D8%B1%D9%81%D8%A7%DA%A9%D8%B3-firefox/#more-106">
            <img src="../files/f.png" width="25" height="23" alt="Firefox"/>
        </a>
        یا 
        <a title='دانلود مرورگر کروم' href="https://www.p30world.com/2883/%D8%AF%D8%A7%D9%86%D9%84%D9%88%D8%AF-%DA%AF%D9%88%DA%AF%D9%84-%DA%A9%D8%B1%D9%88%D9%85-google-chrome/">
            <img src="../files/ch.png" width="25" height="23" alt="Chrome"/>
        </a> استفاده نمایید.
    </div>
</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
            <td  height="48"colspan="2" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
  </tr>
  <tr>
    <td width="964" align="center" bgcolor="#4C5550"  ><table width="100%" height="232" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="32%" align="right" bgcolor="#4C5550" style="text-align: right"><a href="help/Bee_form_1403.pdf" target="new" class="LinkCadetBlue">فرم درخواست بازدید از زنبورستان / خود اظهاری</a></td>
        <td width="4%" align="right" bgcolor="#4C5550" style="text-align: right"><span style="text-align: center"><img src="../files/con_info.png" width="16" height="16"  alt=""/></span></td>
        <td width="25%" align="right" bgcolor="#4C5550" style="text-align: right"><a href="help/centers.pdf" class="LinkCadetBlue">راهنمای سامانه ویژه روسای مراکز</a></td>
        <td width="5%" align="right" bgcolor="#4C5550" style="text-align: center"><img src="../files/con_info.png" width="16" height="16"  alt=""/></td>
        <td width="30%" height="28" align="right" bgcolor="#4C5550" style="text-align: right"><a href="help/admin.ppsx" class="LinkCadetBlue"> استان  admin راهنمای سامانه ویژه</a></td>
        <td width="4%" align="center" bgcolor="#4C5550"><img src="../files/con_info.png" width="16" height="16"  alt=""/></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#4C5550" style="text-align: right"><a href="help/Bee_1404.pptx" class="LinkCadetBlue">راهنمای آمارگیری زنبورستان های کشور در سال 1404</a></td>
        <td align="center" bgcolor="#4C5550" style="text-align: right"><span style="text-align: center"><img src="../files/jadid.gif" width="35" height="15"  alt=""/></span></td>
        <td bgcolor="#4C5550" style="text-align: right" ><a href="help/Data1.xlsx" class="LinkCadetBlue">فایل اکسل اقلام اطلاعاتی فرم های موجود</a></td>
        <td align="right" bgcolor="#4C5550" style="text-align: center" ><img src="../files/con_info.png" width="16" height="16"  alt=""/></td>
        <td height="21" align="right" bgcolor="#4C5550" style="text-align: right" ><a href="help/manager.ppsx" class="LinkCadetBlue">راهنمای سامانه ویژه مدیریت استان</a></td>
        <td height="21" align="right" bgcolor="#4C5550"><img src="../files/con_info.png" width="16" height="16"  alt=""/><a href="help/exp_pahneh.pdf" class="LinkCadetBlue"></a></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#4C5550" class="LinkCadetBlue" style="text-align: right"><a href="help/Bee_1404.pdf" target="_new" class="LinkCadetBlue">آشنائی با تجهیزات و دستگاه های زنبورداری</a></td>
        <td align="right" bgcolor="#4C5550" style="text-align: right"><span style="text-align: center"><img src="../files/jadid.gif" width="35" height="15"  alt=""/></span></td>
        <td align="right" bgcolor="#4C5550" style="text-align: right" ><a href="help/Agri1.pdf" target="new" class="LinkCadetBlue">راهنمای تکمیل فرم زراعی</a></td>
        <td align="right" bgcolor="#4C5550" style="text-align: center" ><img src="../files/con_info.png" width="16" height="16"  alt=""/></td>
        <td height="22" align="right" bgcolor="#4C5550" style="text-align: right" ><a href="help/moravej.ppsx" class="LinkCadetBlue">راهنمای سامانه ویژه کارشناسان پهنه </a></td>
        <td height="22" align="right" bgcolor="#4C5550"><img src="../files/con_info.png" width="16" height="16"  alt=""/><a href="help/exp_pahneh.pdf" class="LinkCadetBlue"></a></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#4C5550" style="text-align: right"><a href="help/Vega.pptx" target="_new" class="LinkCadetBlue">راهنمای ثبت اطلاعات سبزی و صیفی</a></td>
        <td align="right" bgcolor="#4C5550" style="text-align: right"><span style="text-align: center"><img src="../files/con_info.png" width="16" height="16"  alt=""/></span></td>
        <td align="right" bgcolor="#4C5550" style="text-align: right" ><a href="help/Bee1402.ppsx" target="new" class="LinkCadetBlue">راهنمای انتقال اطلاعات زراعی</a></td>
        <td align="right" bgcolor="#4C5550" style="text-align: center" ><img src="../files/con_info.png" width="16" height="16"  alt=""/></td>
        <td align="right" bgcolor="#4C5550" style="text-align: right" ><a href="help/Garden.pdf" class="LinkCadetBlue">راهنمای تکمیل فرم باغی</a></td>
        <td height="25" align="right" bgcolor="#4C5550"><img src="../files/con_info.png" width="16" height="16"  alt=""/><a href="help/exp_pahneh.pdf" class="LinkCadetBlue"></a></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#4C5550" style="text-align: right"><a href="help/mushroom.pdf" target="new" class="LinkCadetBlue">راهنمای تکمیل فرم پرورش قارچ</a></td>
        <td align="right" bgcolor="#4C5550" style="text-align: right"><span style="text-align: center"><img src="../files/con_info.png" width="16" height="16"  alt=""/></span></td>
        <td align="right" bgcolor="#4C5550" style="text-align: right" ><a href="help/Industry_new.pdf" target="new" class="LinkCadetBlue">راهنمای تکمیل فرم صنایع</a></td>
        <td align="right" bgcolor="#4C5550" style="text-align: center" ><img src="../files/con_info.png" width="16" height="16"  alt=""/></td>
        <td align="right" bgcolor="#4C5550" style="text-align: right" ><a href="help/Eworker.pdf" class="LinkCadetBlue">راهنماي ثبت اطلاعات مددکاران 
          و تسهیلگران </a></td>
        <td align="right" bgcolor="#4C5550" style="text-align: center" ><img src="../files/con_info.png" width="16" height="16"  alt=""/></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#4C5550" style="text-align: right"><a href="help/Aquatic.pdf" target="new" class="LinkCadetBlue">راهنمای ثبت اطلاعات مزارع تکثیر و پرورش آبزیان</a></td>
        <td align="right" bgcolor="#4C5550" style="text-align: right"><span style="text-align: center"><img src="../files/con_info.png" width="16" height="16"  alt=""/></span></td>
        <td align="right" bgcolor="#4C5550" style="text-align: right" ><a href="help/Green1401_2.pdf" target="new" class="LinkCadetBlue">راهنمای تکمیل فرم گلخانه</a></td>
        <td align="right" bgcolor="#4C5550" style="text-align: center" ><img src="../files/con_info.png" width="16" height="16"  alt=""/></td>
        <td align="right" bgcolor="#4C5550" style="text-align: right" ><a href="help/send_pic_new.pdf" target="new" class="LinkCadetBlue">دستورالعمل و برشورهای دفتر امور گلخانه ها و گیاهان زینت</a><a href="help/Greenhous.pdf" target="new" class="LinkCadetBlue"></a></td>
        <td align="right" bgcolor="#4C5550" style="text-align: center" ><img src="../files/con_info.png" width="16" height="16"  alt=""/></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#4C5550" style="text-align: right"><a href="https://pbiamar.maj.ir/ManagementReport/powerbi/Pahne/HomePahneBIReport" target="new" class="LinkCadetBlue"> USER &amp; PASS: pbiuser/ داشبورد مدیریتی پهنه بندی</a></td>
        <td height="30" align="right" bgcolor="#4C5550" style="text-align: right" >&nbsp;</td>
        <td height="30" align="right" bgcolor="#4C5550" style="text-align: right" ><a href="help/Animal.pdf" target="new" class="LinkCadetBlue">راهنمای ثبت اطلاعات دام</a></td>
        <td height="30" align="right" bgcolor="#4C5550" style="text-align: right" ><span style="text-align: center"><img src="../files/jadid.gif" width="35" height="15"  alt=""/></span></td>
        <td height="30" align="right" bgcolor="#4C5550" style="text-align: right" ><a href="help/S_ab_L2.pdf" target="new" class="LinkCadetBlue">دستورالعمل ثبت برش شهرستانی الگوئی کشت</a></td>
        <td height="30" align="right" bgcolor="#4C5550" style="text-align: right" ><span style="text-align: center"><img src="../files/jadid.gif" width="35" height="15"  alt=""/></span></td>
      </tr>
      <tr>
        <td height="30" colspan="6" align="right" bgcolor="#4C5550" style="text-align: right" ><table width="20%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="right"><a href="https://www.instagram.com/poud.maj.ir" target="new"><img src="../files/1.gif" width="36" height="36" title="ما را دنبال کنید"  alt=""/></a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="30" colspan="6" bgcolor="#4C5550" class="text1" style="text-align: center" >02143541691 : پشتیبانی سامانه </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
 <?php
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // حذف پورت در صورت وجود
    $ipParts = explode(':', $ip);
    return $ipParts[0];
}
?>
<script>
    function openModal() {
        // آدرس iframe را دوباره تنظیم می‌کنیم تا صفحه از ابتدا بارگذاری شود
        document.getElementById("forgetIframe").src = "../forget.php";
        
        // نمایش مودال
        document.getElementById("modal").style.display = "block";
    }

    function closeModal() {
        // بستن مودال
        document.getElementById("modal").style.display = "none";
        
        // حذف آدرس iframe برای پاکسازی و جلوگیری از بارگذاری اضافی
        document.getElementById("forgetIframe").src = "";
    }
</script>