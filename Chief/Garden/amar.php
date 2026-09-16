<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
if (isset($_POST['z_sal']))  $z_sal= $_POST['z_sal'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style>
button
{
	border-color:#FFF ;
}
    </style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
           <p align="center" class="style8"  >گزارشات باغبانی ویژه آمارنامه </p>
           <p align="center"  ><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <div style="margin-right:25px ; direction:rtl">
              <p align="right"> <a href="Garden_amar_1.php" class="style9"> الف- گزارش سطح و ميزان توليد محصولات باغباني </a></p>
              <p align="right" class="style8">  شامل هر سه بخش باغ ، گلخانه و قارچ های خوراکی با امکان گزارش گیری : </p>
              <p align="right">  1- گزارش کل کشور به تفکیک استان</p>
              <p align="right">2-  گزارش استان به تفکیک شهرستان  </p>
              <p align="right">3-  قابلیت محدود سازی دامنه گزارش به مرکز ، آبادی و شهر </p>
              <p align="right">4- گزارش گیری بر حسب گروه محصولات </p>
              <p align="right">5- گزارش گیری ریر مجموعه یک گروه </p>
              <p align="right">6- گرارش گیری یک محصول خاص </p>
              <p></p>
              <p align="right"> <a href="Garden_amar_2.php" class="style9"> ب - گزارش سطح ، میزان تولید و عملکرد محصولات باغبانی به تفکیک نوع محصول </a></p>
              <p></p>
              <p align="right" class="style8">  شامل هر سه بخش باغ ، گلخانه و قارچ های خوراکی با امکان گزارش گیری :</p>
              <p align="right"> 1- گزارش سطح ، میزان تولید و عملکرد محصولات کل کشور </p>
              <p align="right">2-  گزارش سطح ، میزان تولید و عملکرد محصولات  شهرستان </p>
              <p align="right">3-  قابلیت محدود سازی دامنه گزارش به مرکز ، آبادی و شهر </p>
              <p align="right">5- گزارش گیری  یک گروه </p>
              <p align="right">6- گرارش گیری یک محصول خاص </p>
              <p align="right" class="style9">
                ج - خروجی اکسل داشبورد محصولات باغی
                <select name="z_sal" id="garden_dash_sal" class="style9" style="margin:0 8px; direction:ltr;">
                  <option value="1404">1404</option>
                  <option value="1403">1403</option>
                  <option value="1402">1402</option>
                </select>
                <a href="Garden_dash_xls.php?z_sal=1405" id="garden_dash_xls_link" class="style9">دانلود اکسل</a>
              </p>
              <p align="right" class="style9">
                چ - خروجی اکسل داشبورد محصولات گلخانه
                <select name="y_prod" id="greenhous_dash_sal" class="style9" style="margin:0 8px; direction:ltr;">
                  <option value="1404">1404</option>
                  <option value="1403">1403</option>
                  <option value="1402">1402</option>
                </select>
                <a href="Garden_dash_Greenhous_xls.php?y_prod=1405" id="greenhous_dash_xls_link" class="style9">دانلود اکسل</a>
              </p>
              <p align="right" class="style9">
                ح - خروجی اکسل داشبورد محصولات قارچ خوراکی
                <select name="y_prod" id="mush_dash_sal" class="style9" style="margin:0 8px; direction:ltr;">
                  <option value="1404">1404</option>
                  <option value="1403">1403</option>
                  <option value="1402">1402</option>
                </select>
                <a href="Mush_dash_xls.php?y_prod=1405" id="mush_dash_xls_link" class="style9">دانلود اکسل</a>
              </p>
              <script type="text/javascript">
              (function () {
                function bindYearLink(selId, linkId, baseUrl, param) {
                  var sel = document.getElementById(selId);
                  var link = document.getElementById(linkId);
                  if (!sel || !link) return;
                  function syncLink() {
                    link.href = baseUrl + '?' + param + '=' + encodeURIComponent(sel.value);
                  }
                  sel.onchange = syncLink;
                  syncLink();
                }
                bindYearLink('garden_dash_sal', 'garden_dash_xls_link', 'Garden_dash_xls.php', 'z_sal');
                bindYearLink('greenhous_dash_sal', 'greenhous_dash_xls_link', 'Garden_dash_Greenhous_xls.php', 'y_prod');
                bindYearLink('mush_dash_sal', 'mush_dash_xls_link', 'Mush_dash_xls.php', 'y_prod');
              })();
              </script>
            </div>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>