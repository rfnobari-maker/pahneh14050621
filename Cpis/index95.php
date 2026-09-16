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
.tricky_image:hover {
    opacity:0.2;
    filter:alpha(opacity=20);
	}
    div.header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
	      }
	.home {
    margin-top: 380px;
}
    </style>
</head>
<body>
<div class="header" >
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
          <td><img src="../files/images/header.jpg" width="100%" height="123" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
          </tr>
          <tr>
            <td>
  <?php include('top.php'); ?>
              </td>
          </tr>
        </table>
        </div>
<div class="home">
        <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
            <td>
              <div class="box"  align="center">
                <p><a href="profile.php" title="مدیریت اطلاعات کاربری"><img src="../files/request.jpg" alt="upload" width="86" height="72" border="0" class=class="tricky_image" /></a></p>
<p><a href="profile.php" class="btn">ویرایش اطلاعات کاربری</a></p>
</div>
              <div class="box" align="center">
                <p><a href="provinces.php" title="لیست مراکز جهاد کشاورزی"><img src="../files/centers.png" alt="users" width="86" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="provinces.php" class="btn">   استان های تحت پوشش: <?php echo ostan_count() ;  ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="lists_city.php" title="مشاهده لیست شهر های تحت پوشش"><img src="../files/city.png" alt="users" width="83" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="lists_city.php" class="btn"> شهرهای تحت پوشش : <?php echo totl_shahr_count() ;  ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="inactive_city.php" title="مشاهده لیست شهر های تحت پوشش"><img src="../files/inactive_city.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="inactive_city.php" class="btn"> شهرهای غیر فعال: <?php echo inactive_city() ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="lists_abadi.php" title="لیست آبادی های شهرستان "><img src="../files/abadi.png" alt="users" width="86" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="lists_abadi.php" class="btn"> آبادی های تحت پوشش:<?php echo abadi_count() ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="inactive_abadi.php" title="لیست آبادی های شهرستان "><img src="../files/inactive_abadi.png" alt="users" width="86" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="inactive_abadi.php" class="btn"> آبادی های غیر فعال:<?php echo inactive_abadi() ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_pubcity.php" title="مشاهده اطلاعات عمومی شهر ها "><img src="../files/city-pub.png" alt="users" width="86" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="list_pubcity.php" class="btn"> اطلاعات عمومی شهر ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="listpublic_abadi.php" title="اطلاعات عمومی  آبادی ها"><img src="../files/pub_abadi.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="listpublic_abadi.php" class="btn"> اطلاعات عمومی  آبادی ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_center.php" title="اطلاعات مراکز جهاد کشاورزی"><img src="../files/mar.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="list_center.php" class="btn">مراکز جهاد کشاورزی:<?php echo totl_mar_count() ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="prof.php" title="اطلاعات اختصاصی  آبادی ها"><img src="../files/p_abadi.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="prof.php" class="btn"> اطلاعات اختصاصی  </a></p>
              </div>
              <div class="box" align="center">
                <p><a href="promo.php" title="مروجین شهرستان"><img src="../files/morvege1.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="promo.php" class="btn">کارشناسان مسئول پهنه :<?php echo mor_count() ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="promo_action.php" title="مروجین شهرستان"><img src="../files/reports.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="promo_action.php" class="btn">گزارش عملکرد کارشناسان پهنه</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="search_promo.php" title="جستجوی مروج"><img src="../files/morvege2.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="search_promo.php" class="btn">جستجوی کاربر</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="live_view.php" title="مشاهده عملکرد روزانه کاربران"><img src="../files/live.png" alt="users" width="83" height="80" border="0" class="tricky_image" /></a></p>
                <p><a href="live_view.php" class="btn">مشاهده عملکرد کاربران</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="admins.php" title="مشاهده عملکرد روزانه کاربران"><img src="../files/1_003.png" alt="users" width="82" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="admins.php" class="btn">ادمین های استانی سامانه</a></p>
              </div>
            <p class="style9">&nbsp;</p></td>
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