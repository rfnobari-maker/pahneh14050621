<?php 
include("lock_p1.php");
include('counter.php');
// $login_session ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ;?></title>
<link href="FA.css" rel="stylesheet" type="text/css" />
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
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
          <td><img src="files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
          </tr>
          <tr>
            <td>
  <?php include('top.php'); ?>
              <p align="right" class="RedTitleSmaller" style="margin-right:30px">&nbsp;</p>
              <div class="box"  align="center">
                <p><a href="profile.php" title="مدیریت اطلاعات کاربری"><img src="files/request.jpg" alt="upload" width="86" height="86" border="0" class="tricky_image" /></a></p>
<p><a href="profile.php" class="btn">ویرایش اطلاعات کاربری</a></p>
</div>
              <div class="box" align="center">
                <p><a href="lists_city.php" title="مشاهده لیست آبادی های تحت پوشش"><img src="files/city.png" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="lists_city.php" class="btn"> لیست شهرها :<?php echo $count_city ; ?></a></p>
              </div>
              <div class="box" align="center">
                              <p><a href="lists_abadi.php" title="مشاهده لیست آبادی های تحت پوشش"><img src="files/abadi.png" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                              <p><a href="lists_abadi.php" class="btn"> لیست آبادی ها :<?php echo $count ; ?></a></p>
                            </div>
              <div class="box" align="center">
                              <p><a href="list_pubabadi.php" title="مشاهده و ویرایش اطلاعات عمومی آبادی ها "><img src="files/pub_abadi.png" alt="اطلاعاات عمومی آبادی" width="86" height="86" border="0" class="tricky_image" /></a></p>
                              <p><a href="list_pubabadi.php" class="btn"> اطلاعات عمومی  آبادی ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_pubcity.php" title="مشاهده و ویرایش اطلاعات عمومی شهر ها "><img src="files/city-pub.png" alt="اطلاعات عمومی شهر" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="list_pubcity.php" class="btn"> اطلاعات عمومی شهر ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="prof/index.php"><img src="files/p_abadi.png" alt="اطلاعات اختصاصی" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p> <a href="prof/index.php" class="btn">اطلاعات اختصاصی    </a></p>
              </div>
              <div class="box" align="center">
                <p><a href="search_promo.php" title="جستجوی کاربران سیستم "><img src="files/morvege2.png" alt="جستجو" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="search_promo.php" class="btn">جستجوی کاربر</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_expar.php" title="کارشناسان معین استان"><img src="files/exp_ostan.png" alt="کارشناسان معین" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="list_expar.php" class="btn">کارشناسان معین استان</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_expar_sh.php" title="کارشناسان موضوعی  شهرستان"><img src="files/exp_city.png" alt="کارشناسان موضوعی" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="list_expar_sh.php" class="btn">کارشناسان موضوعی  شهرستان</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_scholar.php" title="محقق معین شهرستان"><img src="files/scholar1.png" alt="محقق معین" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="list_scholar.php" class="btn">محقق معین شهرستان</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_Admin.php" title="ادمین استان"><img src="files/admin.png" alt="ادمین استان" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="list_Admin.php" class="btn">ادمین استانی سامانه</a></p>
              </div>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p></td>
          </tr>
          <tr>
<td  height="109"colspan="3" valign="middle" background="files/bottom.gif"><?php include('footer.php')?></td>
          </tr>
        </table>
      </div>
<p><!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code --></p>
</body>
</html>