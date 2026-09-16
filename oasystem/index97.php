<?php
include("../lock_ad.php");
//include("../farsidigit.php");
include("counter.php");
//include("request_counter.php");
 ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ;?></title>
<link href="../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style3 {color: #FFFFFF}
.style4 {	font-size: 10px;
	color: #FFFFFF;
}
.box
{
 width:250px ; float:right ; line-height:150% ; margin-left:10px ; margin-top:10px ; margin-bottom:30px ; font-family:Tahoma ; margin-right:50px 
}
.tricky_image {
	margin-bottom:10px;
    max-width:86px; 
    max-height:86px;
    -moz-transition: all 1s; 
    -webkit-transition: all 1s;  
    -ms-transition: all 1s;  
    -o-transition: all 1s;  
    transition: all 1s; 
    opacity:1;
    filter:alpha(opacity=100);
}

.tricky_image:hover {
    opacity:0.2;
    filter:alpha(opacity=20);
}
.tricky_image1 {	margin-bottom:10px;
    max-width:86px; 
    max-height:86px;
    -moz-transition: all 1s; 
    -webkit-transition: all 1s;  
    -ms-transition: all 1s;  
    -o-transition: all 1s;  
    transition: all 1s; 
    opacity:1;
    filter:alpha(opacity=100);
}
.tricky_image2 {	margin-bottom:10px;
    max-width:86px; 
    max-height:86px;
    -moz-transition: all 1s; 
    -webkit-transition: all 1s;  
    -ms-transition: all 1s;  
    -o-transition: all 1s;  
    transition: all 1s; 
    opacity:1;
    filter:alpha(opacity=100);
}
.tricky_image3 {	margin-bottom:10px;
    max-width:86px; 
    max-height:86px;
    -moz-transition: all 1s; 
    -webkit-transition: all 1s;  
    -ms-transition: all 1s;  
    -o-transition: all 1s;  
    transition: all 1s; 
    opacity:1;
    filter:alpha(opacity=100);
}
.box1 { width:275px ; float:right ; line-height:150% ; margin-left:10px ; margin-top:10px ; margin-bottom:30px ; font-family:Tahoma ; margin-right:20px 
}
.tricky_image7 {margin-bottom:10px;
    max-width:86px; 
    max-height:86px;
    -moz-transition: all 1s; 
    -webkit-transition: all 1s;  
    -ms-transition: all 1s;  
    -o-transition: all 1s;  
    transition: all 1s; 
    opacity:1;
    filter:alpha(opacity=100);
}
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
            <td>
<?php include('top.php');?>
              <div class="box1" align="center">
                <p><a href="user.php" title="تعریف کاربر جدید"><img src="../files/adduser.jpg"  width="83" height="83" border="0" class="tricky_image" /></a></p>
<p><a href="user.php" class="btn">تعریف کاربر جدید</a></p>
</div>
              <div class="box1" align="center">
                <p><a href="user_view.php" title="مدیریت کاربران"><img src="../files/user.jpg"  width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="user_view.php" class="btn">مدیریت کاربران </a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="mar.php" title="تعریف مرکز جدید"><img src="../files/mar.png"  width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="mar.php" class="btn">تعریف مرکز جدید</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="mar_view.php" title="مدیریت مراکز جهاد کشاورزی"><img src="../files/mar_edit.png"  width="83" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="mar_view.php" class="btn">مدیریت مراکز جهاد کشاورزی</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="region.php" title="منطقه بندی استان"><img src="../files/region.png"  width="86" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="region.php" class="btn">منطقه بندی استان</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="active_abadi.php" title="لیست آبادی های فعال"><img src="../files/active_abadi.png"  width="83" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="active_abadi.php" class="btn">لیست آبادی های فعال</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="inactive_abadi.php" title="لیست آبادهای غیر فعال"><img src="../files/inactive_abadi.png"  width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="inactive_abadi.php" class="btn">لیست آبادهای غیر فعال</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="add_abadi.php" title=" ثبت آبادی جدید مرکز"><img src="../files/add_abadi.png"  width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="add_abadi.php" class="btn"> فعال سازی یک آبادی </a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="change_abadi_mar.php" title="تغییر مروج و مرکز آبادی"><img src="../files/edity_abadi.png"  width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="change_abadi_mar.php" class="btn">ویرایش مروج / مرکز ، آبادی</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="active_city.php" title="لیست شهرهای فعال"><img src="../files/active_city.png"  width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="active_city.php" class="btn">لیست شهرهای فعال</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="inactive_city.php" title="لیست شهرهای غیر فعال"><img src="../files/inactive_city.png"  width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="inactive_city.php" class="btn">لیست شهرهای غیر فعال</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="add_city.php" title="فعال سازی یک شهر"><img src="../files/add_city.png"  width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="add_city.php" class="btn">فعال سازی یک شهر</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="change_city_mar.php" title="تغییر مروج و مرکز شهر"><img src="../files/edit_city.png"  width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="change_city_mar.php" class="btn">ویرایش  مروج /مرکز، شهر</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="search_user.php" title="جستجوی کاربر"><img src="../files/morvege2.png"  width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="search_user.php" class="btn">جستجوی کاربر</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="message_list.php" title="لیست پیام ها"><img src="../files/messanger.png"  width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="message_list.php" class="btn">لیست پیام ها</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="requests.php" title="درخواست رسیده "><img src="../files/Sback.PNG"  width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="requests.php" class="btn">درخواست های رسیده</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="#" title="درخواست رسیده "><img src="../files/changeuser.png"  width="83" height="85" border="0" class="tricky_image" /></a><br />
                </p>
                <p><a href="#" class="btn">کاربری مدیریت سامانه</a><a href="#" class="btn"></a><br />
                </p>
                <p><span class="style8"> بعد از ساعت 13 فعال خواهد بود .</span></p>
              </div>
              <p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p class="style9">&nbsp;</p></td>
          </tr>
          <tr>
            <td  height="100px"colspan="2" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
          </tr>
        </table>
      </div>
<!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code -->
</body>
</html>
