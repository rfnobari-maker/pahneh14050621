<?php include("../lock_p2.php");
include('counter.php');
 //echo $login_session ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>سامانه پهنه بندی آبادی های آذربایجان شرقی</title>
<link href="../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style3 {color: #FFFFFF}
.style4 {	font-size: 10px;
	color: #FFFFFF;
}
.box
{
 width:275px ; float:right ; line-height:150% ; margin-left:10px ; margin-top:10px ; margin-bottom:30px ; font-family:Tahoma ; margin-right:20px 
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
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
          <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
          </tr>
          <tr>
            <td>
<div style="float:right ; margin-right:30px ; margin-left:20px ; margin-top:15px ; padding:10px "  > <img src="../files/users/<?php echo $pic ?>" width="79" height="103"  alt="تصویر کاربر "/></div>
              <p align="right" class="link" style="margin-right:30px">&nbsp;</p>
              <p align="right" class="style2" style="margin-right:30px">پانل مدیریتی سامانه پهنه بندی آبادی های استان</p>
              <p align="right" class="RedTitleSmaller" style="margin-right:30px">ویژه روسای مراکز جهاد کشاورزی </p>
              <p align="right" class="normalTextSmaller" style="margin-right:30px">محل خدمت : <?php echo $ostan.'&nbsp; /&nbsp;'.$city.'&nbsp;/&nbsp;'.$markaz ;  ?></p>
              <p align="right" class="RedTitleSmaller" style="margin-right:30px">&nbsp;</p>
              <div class="box"  align="center">
                <p><a href="profile.php" title="ثبت درخواست جدید"><img src="../files/request.jpg" alt="upload" width="86" height="72" border="0" class="tricky_image" /></a></p>
<p><a href="profile.php" class="btn">ویرایش اطلاعات کاربری</a></p>
</div>
              <div class="box" align="center">
                <p><a href="lists_abadi.php" title="مدیریت درخواست های ثبت شده"><img src="../files/abadi.png" alt="users" width="86" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="lists_abadi.php" class="btn"> لیست آبادی های مرکز :<?php echo $count ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_abadi.php" title="مدیریت درخواست های ثبت شده"><img src="../files/pub_abadi.png" alt="users" width="83" height="74" border="0" class="tricky_image" /></a></p>
                <p><a href="list_abadi.php" class="btn"> اطلاعات عمومی  آبادی ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="#" title="مدیریت درخواست های ثبت شده"><img src="../files/p_abadi.png" alt="users" width="86" height="79" border="0" class="tricky_image" /></a></p>
                <p><a href="#" class="btn"> اطلاعات اختصاصی  آبادی ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="promotes.php" title="مدیریت درخواست های ثبت شده"><img src="../files/morvege1.png" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="promotes.php" class="btn">مروجین مرکز :<?php echo $count_mor ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_abadi_kol.php" title="مدیریت درخواست های ثبت شده"><img src="../files/morvege2.png" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="list_abadi_kol.php" class="btn">مشاهده عملکرد مروج</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="change_request.php" title="مدیریت درخواست های ثبت شده"><img src="../files/setting.png" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="change_request.php" class="btn"> درخواست تغییرات</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="request.php" title="مدیریت درخواست های ثبت شده"><img src="../files/Sback.PNG" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="request.php" class="btn"> درخواست های ثبت شده </a></p>
              </div>
              <div class="box" align="center">
                <p><a href="promotes_kol.php" title="مدیریت درخواست های ثبت شده"><img src="../files/morvege1.png" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="promotes_kol.php" class="btn">مروجین استان  :<?php echo $count_kol ; ?></a></p>
              </div>
            <p class="style9">&nbsp;</p></td>
          </tr>
          <tr>
            <td  height="100px"colspan="2" valign="middle" background="../files/bottom.gif"><p><span class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 34438000-6 041 فکس: 334439940 041<br />
              <span class="Row-Footer">Web Designer  : R.NOBARI </span></span></p></td>
          </tr>
        </table>
      </div>
<!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code -->
</body>
</html>