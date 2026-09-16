<?php include("../lock_Sc.php");
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
              <div class="box"  align="center">
                <p><a href="profile.php" title="ویرایش اطلاعات کاربری"><img src="../files/request.jpg" alt="upload" width="86" height="72" border="0" class="tricky_image" /></a></p>
<p><a href="profile.php" class="btn">ویرایش اطلاعات کاربری</a></p>
</div>
              <div class="box" align="center">
                <p><a href="centers.php" title="لیست مراکز جهاد کشاورزی"><img src="../files/centers.png" alt="users" width="86" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="centers.php" class="btn">  مراکز جهاد کشاورزی:<?php echo $count_m ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="lists_city.php" title="مشاهده لیست شهر های تحت پوشش"><img src="../files/city.png" alt="users" width="83" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="lists_city.php" class="btn"> شهرهای تحت پوشش : <?php echo city_shahr_count($id_city,$id_ostan) ;  ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="lists_abadi.php" title="لیست آبادی های شهرستان "><img src="../files/abadi.png" alt="users" width="86" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="lists_abadi.php" class="btn"> لیست آبادی ها:<?php echo $count ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_pubcity.php" title="مشاهده اطلاعات عمومی شهر ها "><img src="../files/city-pub.png" alt="users" width="86" height="71" border="0" class="tricky_image" /></a></p>
                <p><a href="list_pubcity.php" class="btn"> اطلاعات عمومی شهر ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="listpublic_abadi.php" title="اطلاعات عمومی  آبادی ها"><img src="../files/pub_abadi.png" alt="users" width="83" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="listpublic_abadi.php" class="btn"> اطلاعات عمومی  آبادی ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="prof.php" title="اطلاعات اختصاصی  آبادی ها"><img src="../files/p_abadi.png" alt="users" width="86" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="prof.php" class="btn"> اطلاعات اختصاصی  آبادی ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="city_promo.php" title="مروجین شهرستان"><img src="../files/morvege1.png" alt="users" width="83" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="city_promo.php" class="btn">کارشناسان مسئول پهنه:<?php echo city_mor_count($row['id_city'],$id_ostan) ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="search_promo.php" title="جستجوی مروج"><img src="../files/morvege2.png" alt="users" width="83" height="72" border="0" class="tricky_image" /></a></p>
                <p><a href="search_promo.php" class="btn">جستجوی مروج</a></p>
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