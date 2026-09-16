<?php include("../../../lock_p2.php");
//include('../counter.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ;?></title>
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
          <td><img src="../../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
          </tr>
          <tr>
            <td>
  <?php include('top.php'); ?>
           <p align="center" class="style8"  >اطلاعات مدد کاران ترویجی / تسهیلگران مرکز جهاد کشاورزی </p>
           <p align="center"  ><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div class="box" align="center">
             <p><img src="../../../files/active_abadi.png" alt="bee" width="86" height="80" border="0" class="tricky_image" /></p>
             <p><a href="Eworker.php" class="btn">ثبت مدد کار/تسهیلگر  جدید</a></p>
             <p>&nbsp;</p>
             <p><a href="manager_Eworker.php" class="btn">مدیریت مدد کاران / تسهیلگر موجود </a></p>
             <p>&nbsp;</p>
             <p><a href="liste_Eworker.php" class="btn">لیست مددکاران / تسهیلگران ثبت شده مرکز </a></p>
           </div>
           <div class="box" align="center">
             <p><img src="../../../files/greenhous.png" alt="bee" width="86" height="80" border="0" class="tricky_image" /></p>
             <p><a href="suEworker.php" class="btn">ثبت و مدیریت حمایت از مددکار / تسهلیگر</a></p>
             <p>&nbsp;</p>
             <p><a href="#" class="btn">لیست حمایت های انجام شده مرکز </a></p>
           </div>
           <div class="box" align="center">
             <p><img src="../../../files/pub_abadi.png" alt="bee" width="86" height="80" border="0" class="tricky_image" /></p>
             <p><a href="acEworker.php" class="btn">ثبت و مدیریت عملکرد ماهانه مددکار / تسهلیگر</a></p>
             <p>&nbsp;</p>
             <p><a href="#" class="btn">لیست عملکرد ماهانه مددکاران / تسهلیگران مرکز </a></p>
           </div>
           <p class="style9">&nbsp;</p></td>
          </tr>
          <tr>
            <td height="57"><p><a href="../index.php"><img src="../../../files/goback.jpg" width="128" height="57"  alt=""/></a></p></td>
          </tr>
          <tr>
<td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
        </table>
      </div>
<!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code -->
</body>
</html>