<?php include("../lock_oce.php");
include('counter.php');
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
           <p align="center"  ><img src="../files/reza.gif" width="240" height="57"  style="border-radius:15px" alt=""/></p>
              <div class="box"  align="center">
                <p><a href="benef.php" title="اطلاعات بهره برداران کشاورزی"><img src="../files/farmer.png" alt="بهره برداران کشاورزی " width="71" height="86" border="0" class="tricky_image" /></a></p>
<p><a href="benef.php" class="btn"> بهره برداران کشاورزی</a></p>
</div>
              <div class="box" align="center">
                <p><a href="Agri/index.php" title="مدیریت امور زراعت"><img src="../files/zera.png" alt="زراعت" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="Agri/index.php" class="btn">  زراعت</a></p>
              </div>
              <div class="box" align="center">
                              <p><a href="Garden" title="#"><img src="../files/tree.png" alt="باغبانی" width="86" height="86" border="0" class="tricky_image" /></a></p>
                              <p><a href="Garden" class="btn">  باغبانی</a></p>
                            </div>
              <div class="box" align="center">
                <p><a href="#" title="#"><img src="../files/ani.jpg" alt="دام" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="#" class="btn"> دام </a></p>
              </div>
              <div class="box" align="center">
                <p><a href="Poultry/" title="#"><img src="../files/pol.jpg" alt="طیور و زنبورعسل" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="Poultry/" class="btn"> طیور و زنبور عسل</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="Aquatic" title="#"><img src="../files/fish1.png" alt="آبزی پروری" width="86" height="87" border="0" class="tricky_image" /></a></p>
                <p><a href="Aquatic" class="btn">  آبزی پروری</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="#" title="#"><img src="../files/ab.png" alt="آب و خاک" width="97" height="87" class="tricky_image" border="0" /></a></p>
                <p><a href="#" class="btn">  آب و خاک </a></p>
              </div>
              <div class="box" align="center">
                <p><a href="#" title="#"><img src="../files/sana.png" alt="صنایع کشاورزی" width="158" height="87" border="0" class="tricky_image" /></a></p>
                <p><a href="#" class="btn">  صنایع کشاورزی </a></p>
              </div>
              <div class="box" align="center">
                <p><a href="Promotion" title="#"><img src="../files/farmer-512.png" alt="ترویج" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="Promotion" class="btn">  ترویج </a></p>
              </div>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
           <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
            </a>            </p></td>
          </tr>
          <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
          </tr>
        </table>
      </div>
</body>
</html>