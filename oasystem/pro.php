<?php include("../lock_ad.php");
include('counter.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>سامانه پهنه بندی آبادی های آذربایجان شرقی</title>
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
           <p>&nbsp;</p>
           <p align="center"  ><img src="../files/reza.gif" width="240" height="57"  style="border-radius:15px" alt=""/></p>
              <div class="box"  align="center">
                <p><a href="benef.php" title="ثبت اطلاعات بهره بردار"><img src="../files/adduser.jpg" alt="upload" width="86" height="85" border="0" class="tricky_image" /></a></p>
<p><a href="benef.php" class="btn">ثبت بهره بردار</a></p>
</div>
              <div class="box" align="center">
                <p><a href="manager_benef.php" title="ویرایش و حذف اطلاعات بهره بردار"><img src="../files/user.jpg" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="manager_benef.php" class="btn"> مدیریت بهره بردار</a></p>
              </div>
              <div class="box" align="center">
                              <p><a href="liste_benef.php" title="لیست بهره برداران ثبت شده"><img src="../files/Sback.PNG" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                              <p><a href="liste_benef.php" class="btn"> لیست بهره برداران:<?php echo $count_bah ; ?></a></p>
                            </div>
            <p class="style9">&nbsp;</p></td>
          </tr>
          <tr>
            <td  height="100px"colspan="2" valign="middle" background="../files/bottom.gif"><p><span class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 6-34438000 041 فکس: 334439940 041<br />
              <span class="Row-Footer">Web Designer  : R.NOBARI </span></span></p></td>
          </tr>
        </table>
      </div>
<!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code -->
</body>
</html>