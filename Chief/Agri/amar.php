<?php
include("../../lock_ce.php");
include("../../event.php");
include('../side_menu1.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
     <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
      <div style="width:95% "> <img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/>
        <p align="right"><a href="Agri_amar1.php" class="LinkRedTitle" >برآورد سطح، میزان تولید و عملکرد در هکتار محصولات زراعی کل کشور به تفکیک محصول</a></p>
        <p align="right"><a href="Agri_amar2.php" class="LinkRedTitle" >برآورد سطح، میزان تولید و عملکرد در هکتار محصولات زراعی کل کشور به تفکیک استان</a></p>
        <p align="right"><a href="Agri_amar3.php" class="LinkRedTitle" >برآورد سطح و میزان تولید هر محصول به تفکیک استان</a></p>
        <p align="right"><a href="Agri_amar4.php" class="LinkRedTitle" >برآورد سطح و میزان تولید هر دسته محصول به تفکیک استان</a></p>
        <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
        <p align="right"><a href="Agri_dash_ostan_xls1403.php" class="LinkTitleNews" >خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1404-1403</a></p>
        <p align="right"><a href="Agri_dash_ostan_city_xls1403.php" class="LinkTitleNews">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1404-1403</a></p>
        <p align="right"><a href="Agri_dash_ostan_details_xls1403.php" class="LinkTitleNews">خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1404-1403</a></p>
        <p align="right"><a href="Agri_dash_ostan_city_details_xls1403.php" class="LinkTitleNews">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1404-1403</a></p>
        <p align="right"><a href="Vege_dash_xls_ostan1403.php" class="LinkTitleNews">خروجی اکسل محصولات صیفی به تفکیک استان در سال زراعی 1404-1403</a></p>
        <p align="right"><a href="Vege_dash_xls1403.php" class="LinkTitleNews">خروجی اکسل محصولات صیفی به تفکیک استان و شهرستان در سال زراعی 1404-1403</a></p>
        <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>

        <p align="right"><a href="Agri_dash_ostan_xls1402.php" class="link1" >خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1402-1403 کدینگ آمارنامه</a></p>
        <p align="right"><a href="Agri_dash_ostan_city_xls1402.php" class="link1">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1402-1403</a></p>
        <p align="right"><a href="Agri_dash_ostan_details_xls1402.php" class="link1">خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1402-1403 کدینگ سامانه</a></p>
        <p align="right"><a href="Agri_dash_ostan_city_details_xls1402.php" class="link1">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1402-1403</a></p>
        <p align="right"><a href="Vege_dash_xls_ostan1402.php" class="link1">خروجی اکسل محصولات صیفی به تفکیک استان در سال زراعی 1402-1403</a></p>
        <p align="right"><a href="Vege_dash_xls1402.php" class="link1">خروجی اکسل محصولات صیفی به تفکیک استان و شهرستان در سال زراعی 1402-1403</a></p>


<p align="right"><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
        <p align="right"><a href="Agri_dash_ostan_xls1401.php" class="LinkTitleNews" >خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1402-1401</a></p>
        <p align="right"><a href="Agri_dash_ostan_city_xls1401.php" class="LinkTitleNews">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1402-1401</a></p>
        <p align="right"><a href="Agri_dash_ostan_details_xls1401.php" class="LinkTitleNews">خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1402-1401</a></p>
        <p align="right"><a href="Agri_dash_ostan_city_details_xls1401.php" class="LinkTitleNews">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1402-1401</a></p>
        <p align="right"><a href="Vege_dash_xls_ostan1401.php" class="LinkTitleNews">خروجی اکسل محصولات صیفی به تفکیک استان در سال زراعی 1402-1401</a></p>
        <p align="right"><a href="Vege_dash_xls1401.php" class="LinkTitleNews">خروجی اکسل محصولات صیفی به تفکیک استان و شهرستان در سال زراعی 1402-1401</a></p>
        <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/> </p>
        <p align="right"><a href="Agri_dash_ostan_xls1400.php" class="link1" >خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1401-1400</a></p>
        <p align="right"><a href="Agri_dash_ostan_city_xls1400.php" class="link1">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1401-1400</a></p>
        <p align="right"><a href="Agri_dash_ostan_details_xls1400.php" class="link1">خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1401-1400</a></p>
        <p align="right"><a href="Agri_dash_ostan_city_details_xls1400.php" class="link1">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1401-1400</a></p>
        <p align="right"><a href="Vege_dash_xls_ostan1400.php" class="link1">خروجی اکسل محصولات صیفی به تفکیک استان در سال زراعی 1401-1400</a></p>
        <p align="right"><a href="Vege_dash_xls1400.php" class="link1">خروجی اکسل محصولات صیفی به تفکیک استان و شهرستان در سال زراعی 1401-1400</a></p>
        <img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/>
        <p align="right"><a href="Agri_dash_ostan_xls.php" class="LinkTitleNews" >خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1400-1399</a></p>
        <p align="right"><a href="Agri_dash_ostan_city_xls.php" class="LinkTitleNews">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1400-1399</a></p>
        <p align="right"><a href="Agri_dash_ostan_details_xls.php" class="LinkTitleNews">خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1400-1399</a></p>
        <p align="right"><a href="Agri_dash_ostan_city_details_xls.php" class="LinkTitleNews">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1400-1399</a></p>
        <p align="right"><a href="Vege_dash_xls_ostan.php" class="LinkTitleNews">خروجی اکسل محصولات صیفی به تفکیک استان در سال زراعی 1400-1399</a></p>
        <p align="right"><a href="Vege_dash_xls.php" class="LinkTitleNews">خروجی اکسل محصولات صیفی به تفکیک استان و شهرستان در سال زراعی 1400-1399</a></p>
        <p>&nbsp;</p>
    </div></td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>