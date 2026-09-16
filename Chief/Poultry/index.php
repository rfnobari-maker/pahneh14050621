<?php include("../../lock_ce.php");
//include('../counter.php');
?>
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
<table width="949px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
          <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
          </tr>
          <tr>
            <td>
  <?php include('top.php'); ?>
           <p align="center" class="style8"  >  زنبور عسل <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div class="box" align="center">
             <p><img src="../../files/bee.png" alt="bee" width="136" height="86" border="0" class="tricky_image" /></p>
             <p><a href="list_bee.php" class="btn">لیست زنبورستان ها</a></p>
             <p>&nbsp;</p>
                <p><a href="manager_bee.php" class="btn">جستجوی زنبوردار </a></p>
             <p>&nbsp;</p>
                <p><a href="list_unknown_bee.php" class="btn">لیست زنبورستان های ناشناس</a></p>
             <p>&nbsp;</p>
                <p><a href="list_bee_kol.php" class="btn">لیست نهایی زنبورستان های استان </a></p>
              </div>
           <div class="box" align="center">
             <p><a href="../bee2.php"><img src="../../files/reports.png" alt="bee" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="bee6.php" class="btn">گزارش تولید به تفکیک استان</a></p>
             <p><br />
             </p>
             <p><a href="bee2.php" class="btn">گزارش تولید به تفکیک شهرستان</a></p>
             <p>&nbsp;</p>
             <p><a href="bee60.php" class="btn">گزارش نهایی تولید به تفکیک استان</a></p>
             <p>&nbsp;</p>
             <p><a href="bee_Ncity.php" class="btn">گزارش نهایی تولید به تفکیک شهرستان</a><br />
             </p>
           </div>
           <div class="box" align="center">
             <p><img src="../../files/filter_data_icon.jpg" alt="bee" width="86" height="86" border="0" class="tricky_image" /></p>
             <p><a href="bee72.php" class="btn">گزارش زنبوردار به تفکیک استان</a>
               </p>
             <p>&nbsp;</p>
             <p><a href="bee5.php" class="btn">گزارش زنبورستان به تفکیک شهرستان</a></p>
             <p>&nbsp;</p>
             <p><a href="beeT.php" class="btn">گزارش تلفات به تفکیک استان</a></p>
             <p>&nbsp;</p>
             <p>&nbsp;</p>
           </div>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
          <p><a href="../prof.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
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