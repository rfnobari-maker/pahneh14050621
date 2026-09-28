<?php include("../../lock_oce.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ;?></title>
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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
          <td><img src="../../files/images/header.jpg" width="949" height="100" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
          </tr>
          <tr>
            <td>
  <?php include('top.php'); ?>
           <p align="center" class="style8"  >گزارشات باغبانی ویژه آمارنامه </p>
           <p align="center"  ><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div style="margin-right:25px ; direction:rtl">
             <p align="right"> <a href="Garden_amar_1.php" class="style9"> الف- گزارش سطح و ميزان توليد محصولات باغباني </a></p>
             <p align="right" class="style8"> شامل هر سه بخش باغ ، گلخانه و قارچ های خوراکی با امکان گزارش گیری : </p>
             <p align="right"> 1- گزارش کل کشور به تفکیک استان</p>
             <p align="right">2-  گزارش استان به تفکیک شهرستان </p>
             <p align="right">3-  قابلیت محدود سازی دامنه گزارش به مرکز ، آبادی و شهر </p>
             <p align="right">4- گزارش گیری بر حسب گروه محصولات </p>
             <p align="right">5- گزارش گیری ریر مجموعه یک گروه </p>
             <p align="right">6- گرارش گیری یک محصول خاص </p>
             <p></p>
             <p align="right"> <a href="Garden_amar_2.php" class="style9"> ب - گزارش سطح ، میزان تولید و عملکرد محصولات باغبانی به تفکیک نوع محصول </a></p>
             <p></p>
             <p align="right" class="style8"> شامل هر سه بخش باغ ، گلخانه و قارچ های خوراکی با امکان گزارش گیری :</p>
             <p align="right"> 1- گزارش سطح ، میزان تولید و عملکرد محصولات کل کشور </p>
             <p align="right">2-  گزارش سطح ، میزان تولید و عملکرد محصولات  شهرستان </p>
             <p align="right">3-  قابلیت محدود سازی دامنه گزارش به مرکز ، آبادی و شهر </p>
             <p align="right">5- گزارش گیری  یک گروه </p>
             <p align="right">6- گرارش گیری یک محصول خاص </p>
             <p align="right" class="style9"> ج - خروجی اکسل داشبورد محصولات باغی
               <select name="z_sal" id="garden_dash_sal" class="style9" style="margin:0 8px; direction:ltr;">
                 <option value="1404">1404</option>
                 <option value="1403">1403</option>
                 <option value="1402">1402</option>
               </select>
               <a href="Garden_dash_xls.php?z_sal=1405" id="garden_dash_xls_link" class="style9">دانلود اکسل</a> </p>
             <p align="right" class="style9"> چ - خروجی اکسل داشبورد محصولات گلخانه
               <select name="y_prod" id="greenhous_dash_sal" class="style9" style="margin:0 8px; direction:ltr;">
                 <option value="1404">1404</option>
                 <option value="1403">1403</option>
                 <option value="1402">1402</option>
               </select>
               <a href="Garden_dash_Greenhous_xls.php?y_prod=1405" id="greenhous_dash_xls_link" class="style9">دانلود اکسل</a> </p>
             <p align="right" class="style9"> ح - خروجی اکسل داشبورد محصولات قارچ خوراکی
               <select name="y_prod" id="mush_dash_sal" class="style9" style="margin:0 8px; direction:ltr;">
                 <option value="1404">1404</option>
                 <option value="1403">1403</option>
                 <option value="1402">1402</option>
               </select>
               <a href="Mush_dash_xls.php?y_prod=1405" id="mush_dash_xls_link" class="style9">دانلود اکسل</a> </p>
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
           <p>&nbsp;</p>
            <p>&nbsp;</p></td>
          </tr>
          <tr>
    <td  colspan="3" valign="middle">
     <p class="LinkRedTitle"><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
    </td>
          </tr>
          <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
          </tr>
        </table>
      </div>
<!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code -->
</body>
</html>