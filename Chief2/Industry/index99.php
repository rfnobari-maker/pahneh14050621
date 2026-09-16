<?php include("../../lock_ce.php"); ?>
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
          <td><img src="../../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
          </tr>
          <tr>
            <td>
  <?php include('top.php'); ?>
           <p align="center" class="style8"  >صنایع  تبدیلی و تکمیلی</p>
           <p align="center" class="style8"  ><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
              <div class="box"  align="center">
                <p><img src="../../files/farmer.png" alt="" width="71" height="86" border="0" class="tricky_image" /></p>
<p><a href="list_ind_benef.php" class="btn"> لیست بهره برداران بخش صنایع</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="list_ind_unit.php"><img src="../../files/city.png" alt="" width="83" height="83" border="0" class="tricky_image" /></a></p>
               <p><a href="list_ind_unit.php" class="btn"> لیست واحد های صنعتی</a></p>
              </div>
              <div class="box" align="center">
                     <p><a href="list_ind_prod.php"><img src="../../files/Ind.png" alt="" width="83" height="83" border="0" class="tricky_image" /></a></p>
                     <p><a href="list_ind_prod.php" class="btn">لیست عملکرد سالانه واحد های صنعتی</a></p>
              </div>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
    <p class="LinkRedTitle"><a href="../prof.php"> <input name="action" type="submit"   style="width:150px ; height:45px" tabindex="39" value="بازگشت" /></a></p>
    <p class="LinkRedTitle">&nbsp;</p>
            </td>
          </tr>
          <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
          </tr>
        </table>
<!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code -->
</body>
</html>