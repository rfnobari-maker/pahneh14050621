<?php include("../lock_cp.php");
include('counter.php');
 //echo $login_session ;
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
.box1 {width:275px ; float:right ; line-height:150% ; margin-left:10px ; margin-top:10px ; margin-bottom:30px ; font-family:Tahoma ; margin-right:20px 
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
           <?php include('top.php'); ?>
              <div   align="center">
</div>
              <p><span class="style8"> کاربران سامانه</span><br />
              <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>              </p>

              <div class="box"  align="center">
                <p><a href="profile.php" title="ویرایش اطلاعات کاربری"><img src="../files/request.jpg" alt="ویرایش" width="86" height="83" border="0" class="tricky_image" /></a></p>
<p><a href="profile.php" class="btn">ویرایش اطلاعات کاربری</a></p>
</div>
              <div class="box1" align="center">
                <p><a href="user_view.php" title="مدیریت درخواست های ثبت شده"><img src="../files/1_003.png" alt="users" width="86" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="user_view.php" class="btn">مدیریت کاربران </a></p>
              </div>
              <div class="box" align="center">
                <p><a href="promo.php" title="کارشناسان پهنه"><img src="../files/morvege1.png" alt="کارشناسان " width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="promo.php" class="btn">کارشناسان پهنه :<?php echo mor_count() ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="promo_action.php" title="گزارش عملکرد کارشناسان پهنه"><img src="../files/reports.png" alt="گزارش عملکرد" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="promo_action.php" class="btn">گزارش عملکرد کارشناسان پهنه</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="search_promo.php" title="جستجوی کاربر"><img src="../files/morvege2.png" alt="جستجو" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="search_promo.php" class="btn">جستجوی کاربر</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="live_view.php" title="مشاهده عملکرد بروز  کاربران"><img src="../files/live.png" alt="عملکرد بروز" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="live_view.php" class="btn">مشاهده عملکرد بروز کاربران</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="admins.php" title="ادمین های استانی"><img src="../files/1_003.png" alt="ادمین" width="82" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="admins.php" class="btn">ادمین های استانی سامانه</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="login_rep.php" title="گزارش ورود به سامانه"><img src="../files/login_rep.png" alt="گزارش ورود به سامانه" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="login_rep.php" class="btn">گزارش ورود به سامانه</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="ostan_action.php" title="گزارش عملکرد کارشناسان پهنه"><img src="../files/reports.png" alt="گزارش عملکرد" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="ostan_action.php" class="btn">گزارش عملکرد استان</a></p>
              </div>
              <p style="height:600px">&nbsp;</p>
              <div><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/></a></div>
            <p>&nbsp;</p></td>
          </tr>
          <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
          </tr>
        </table>
      </div>
<p><!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code --></p>
</body>
</html>