<?php
if ($no_karbar == 'مدیر سامانه استان')  { include("../lock_ad.php"); } else {include("../lock_oce.php");}
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
              <div class="box"  align="center">
                <p><a href="profile.php" title="ویرایش اطلاعات کاربری"><img src="../files/request.jpg" alt="اطلاعات کاربری" width="86" height="72" border="0" class="tricky_image" /></a></p>
<p><a href="profile.php" class="btn">ویرایش اطلاعات کاربری</a></p>
</div>
              <div class="box" align="center">
                <p><a href="centers.php" title="لیست مراکز جهاد کشاورزی"><img src="../files/centers.png" alt="شهرستان ها " width="86" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="centers.php" class="btn">  شهرستان های استان : <?php echo city_count($id_ostan) ;  ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="lists_city.php" title="مشاهده لیست شهر های تحت پوشش"><img src="../files/city.png" alt="شهرها" width="83" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="lists_city.php" class="btn"> شهرهای تحت پوشش : <?php echo shahr_count($id_ostan) ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="lists_abadi.php" title="لیست آبادی های شهرستان "><img src="../files/abadi.png" alt="آبادی ها " width="86" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="lists_abadi.php" class="btn"> آبادی های تحت پوشش:<?php echo ostan_abadi_count($id_ostan) ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_pubcity.php" title="مشاهده اطلاعات عمومی شهر ها "><img src="../files/city-pub.png" alt="اطلاعات عمومی شهر " width="86" height="71" border="0" class="tricky_image" /></a></p>
                <p><a href="list_pubcity.php" class="btn"> اطلاعات عمومی شهر ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="listpublic_abadi.php" title="اطلاعات عمومی  آبادی ها"><img src="../files/pub_abadi.png" alt="اطلاعات عمومی آبادی " width="83" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="listpublic_abadi.php" class="btn"> اطلاعات عمومی  آبادی ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_center.php" title="اطلاعات مراکز جهاد کشاورزی"><img src="../files/mar.png" alt="مراکز جهاد کشاورزی" width="86" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="list_center.php" class="btn">مراکز جهاد کشاورزی:<?php echo totl_mar_count($id_ostan) ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="prof.php" title="اطلاعات اختصاصی  آبادی ها"><img src="../files/p_abadi.png" alt="اطلاعات اختصاصی" width="86" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="prof.php" class="btn"> اطلاعات اختصاصی  </a></p>
              </div>
              <div class="box" align="center">
                <p><a href="ostan_promo.php" title="مروجین شهرستان"><img src="../files/morvege1.png" alt="مروجین کشاورزی" width="83" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="ostan_promo.php" class="btn">مروجین استان  :<?php echo ostan_mor_count($row['id_ostan']) ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_chief.php" title="لیست کارشناسان معین استانی"><img src="../files/chief.jpg" alt="" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="list_chief.php" class="btn">مدیران استانی سامانه:<?php echo ostan_chief_count($id_ostan) ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_expar.php" title="لیست کارشناسان معین استانی"><img src="../files/exp_ostan.png" alt="" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="list_expar.php" class="btn">کارشناسان معین استان:<?php echo ostan_expar_count($id_ostan) ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_expar_sh.php" title="لیست کارشناسان معین استانی"><img src="../files/exp_city.png" alt="" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="list_expar_sh.php" class="btn">کارشناسان موضوعی شهرستان:<?php echo ostan_expar_sh_count($id_ostan) ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_scholar.php" title="لیست کارشناسان معین استانی"><img src="../files/scholar.png" alt="" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="list_scholar.php" class="btn">محققین معین  شهرستان:<?php echo ostan_scholar_count($id_ostan) ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="search_promo.php" title="جستجوی مروج"><img src="../files/morvege2.png" alt="جستجوی کاربر " width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="search_promo.php" class="btn">جستجوی کاربر</a></p>
              </div>

              <div class="box" align="center">
                <p><a href="requests.php" title="درخواست رسیده "><img src="../files/Sback.PNG" alt="درخواست های رسیده" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="requests.php" class="btn">درخواست های رسیده</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="live_view.php" title="مشاهده عملکرد روزانه کاربران"><img src="../files/live.png" alt="عملکرد  بروز کاربران " width="83" height="80" border="0" class="tricky_image" /></a></p>
                <p><a href="live_view.php" class="btn">مشاهده عملکرد کاربران</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="promo_action.php" title="مروجین شهرستان"><img src="../files/reports.png" alt="عملکرد  مروجین " width="80" height="80" border="0" class="tricky_image" /></a></p>
                <p><a href="promo_action.php" class="btn">گزارش عملکرد کارشناسان پهنه</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="login_rep.php" title="گزارش ورود به سامانه"><img src="../files/login_rep.png" alt="گزارش ورود به سامانه" width="80" height="80" border="0" class="tricky_image" /></a></p>
                <p><a href="login_rep.php" class="btn">گزارش ورود به سامانه</a></p>
              </div>
           <?php 
		   $query = "SELECT * from users  WHERE username='".$user_check."' and S_access='98' ";
           $stmt = $dbh->prepare($query);
           $stmt->execute();
           $ch_num = $stmt -> rowCount();
		   if ($ch_num > 0)
           {
		   ?>
              <div class="box1" align="center">
                <p><a href="../oasystem" title="درخواست رسیده "><img src="../files/changeuser.png"  width="83" height="85" border="0" class="tricky_image" /></a></p>
                <p><a href="../oasystem" class="btn">کاربری ادمین استان</a></p>
              </div>
              <?php }?>
            <p class="style9">&nbsp;</p></td>
          </tr>
          <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
          </tr>
        </table>
      </div>
<p><!-- Begin WebGozar.com Counter code 
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>-->
<!-- End WebGozar.com Counter code --></p>
</body>
</html>