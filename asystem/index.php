<?php
include("../lock_admin.php");
//include("../farsidigit.php");
//include("counter.php");
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
<p align="center">&nbsp;</p>
              <div class="box1" align="center">
                <p><a href="user.php" title="مدیریت درخواست های ثبت شده"><img src="../files/adduser.jpg" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
<p><a href="user.php" class="btn">تعریف کاربر جدید</a></p>
</div>
              <div class="box1" align="center">
                <p><a href="user_view.php" title="مدیریت درخواست های ثبت شده"><img src="../files/user.jpg" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="user_view.php" class="btn">مدیریت کاربران </a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="search_user.php" title="جستجوی کاربر"><img src="../files/morvege2.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="search_user.php" class="btn">جستجوی کاربر</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="mar_view.php" title="مدیریت مراکز جهاد کشاورزی"><img src="../files/mar_edit.png"  width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="mar_view.php" class="btn">مدیریت مراکز جهاد کشاورزی</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="message_list.php" title="جستجوی کاربر"><img src="../files/messanger.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="message_list.php" class="btn">لیست پیام ها</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="requests.php" title="درخواست رسیده "><img src="../files/Sback.PNG" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="requests.php" class="btn">درخواست های رسیده</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="add_abadi.php" title=" ثبت آبادی جدید مرکز"><img src="../files/add_abadi.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="add_abadi.php" class="btn">  ثبت آبادی جدید</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="change_abadi.php" title="تغییر مروج و مرکز آبادی"><img src="../files/abadi.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="change_abadi.php" class="btn">تغییر اطلاعات آبادی</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="../yaali_test2.php" title="تغییر مروج و مرکز آبادی"><img src="../files/abadi.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="../yaali_test2.php" class="btn">تغییر آدرس آماری آبادی در جداول</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="../yaali_convert_abadi_to_city.php" title="تغییر مروج و مرکز آبادی"><img src="../files/merge.jpg" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="../yaali_convert_abadi_to_city.php" class="btn">تبدیل آبادی به شهر </a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="../yaali_merge_abadi_to_abadi.php" title="ادغام یک آبادی در آبادی دیگر"><img src="../files/merge.jpg" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="../yaali_merge_abadi_to_abadi.php" class="btn">ادغام آبادی در آبادی </a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="change_abadi_mar.php" title="تغییر مروج و مرکز آبادی"><img src="../files/abadi.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="change_abadi_mar.php" class="btn">تغییر مروج و مرکز آبادی</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="change_shahr_mar.php" title="تغییر مروج و مرکز آبادی"><img src="../files/city.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="change_shahr_mar.php" class="btn">تغییر مروج و مرکز شهر</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="list_bah.php" title="تغییر مروج و مرکز آبادی"><img src="../files/login_rep.png" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="list_bah.php" class="btn">ویرایش شماره همراه بهره بردار</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="message_crud.php" title="درج پیام"><img src="../files/Ind.png"  width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="message_crud" class="btn">درج پیام</a></p>
              </div>
              <div class="box1" align="center">
                <p><a href="../Chief" title="سوئیچ به محیط کاربری مدیریت سامانه"><img src="../files/changeuser.png"  width="83" height="85" border="0" class="tricky_image" /></a></p>
                <p><a href="../Chief" class="btn">کاربری مدیریت سامانه</a></p>
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
</body>
</html>
