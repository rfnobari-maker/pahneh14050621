<?php include("../lock_ce.php");
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
              <div   align="center" class="style8">شهرها و آبادی ها <br />
                <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/> <br />
              </div>
              <div class="box" align="center">
                <p><a href="list_pubcity.php" title="مشاهده اطلاعات عمومی شهر ها "><img src="../files/city-pub.png" alt="عمومی شهرها " width="86" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="list_pubcity.php" class="btn"> اطلاعات عمومی شهر ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="lists_city.php" title=" لیست شهر های تحت پوشش"><img src="../files/city.png" alt="شهرها" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="lists_city.php" class="btn"> شهرهای تحت پوشش : <?php echo totl_shahr_count() ;  ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="inactive_city.php" title="شهرهای غیر فعال"><img src="../files/inactive_city.png" alt="شهرهای غیر فعال" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="inactive_city.php" class="btn"> شهرهای غیر فعال: <?php echo inactive_city() ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="listpublic_abadi.php" title="اطلاعات عمومی  آبادی ها"><img src="../files/pub_abadi.png" alt="عمومی آبادی ها " width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="listpublic_abadi.php" class="btn"> اطلاعات عمومی  آبادی ها</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="lists_abadi.php" title=" آبادی های تحت پوشش "><img src="../files/abadi.png" alt="آبادی" width="86" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="lists_abadi.php" class="btn"> آبادی های تحت پوشش:<?php echo abadi_count() ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="lists_abadi_nmor.php" title=" آبادی های تحت پوشش "><img src="../files/download-(2).jpg" alt="آبادی" width="86" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="lists_abadi_nmor.php" class="btn"> آبادی های فعال فاقد کارشناس:<?php echo abadi_no_mor_count() ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="inactive_abadi.php" title="آبادی های غیر فعال"><img src="../files/inactive_abadi.png" alt="آبادی های غیر فعال" width="86" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="inactive_abadi.php" class="btn"> آبادی های غیر فعال:<?php echo inactive_abadi() ; ?></a></p>
              </div>
              <div class="box" align="center">
                <p><a href="ostan_cod.php" title="کد های استان ، شهرستان و مرکز جهاد کشاورزی"><img src="../files/ostan_cod.png" alt="کد های استان ، شهرستان و مرکز جهاد کشاورزی" width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="ostan_cod.php" class="btn">کد های استان ، شهرستان و مرکز </a></p>
              </div>
              <div class="box" align="center">
                <p><a href="lists_abadi_conflict_mor.php" title="کد های استان ، شهرستان و مرکز جهاد کشاورزی"><img src="../files/morvege_notok.png" alt="کد های استان ، شهرستان و مرکز جهاد کشاورزی" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="lists_abadi_conflict_mor.php" class="btn">آبادی های مغایر شهرستان / کارشناس</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="search_abadi.php" title="کد های استان ، شهرستان و مرکز جهاد کشاورزی"><img src="../files/add_new.png" alt="کد های استان ، شهرستان و مرکز جهاد کشاورزی" width="70" height="79" border="0" class="tricky_image" /></a></p>
                <p><a href="search_abadi.php" class="btn">سوابق اطلاعات یک آبادی</a></p>
              </div>
            </td>
          </tr>
          <tr>
            <td  colspan="3" valign="middle" > <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/></a></p></td>
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