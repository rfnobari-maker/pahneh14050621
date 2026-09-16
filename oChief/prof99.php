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
             <?php  if(strstr($perm,'d9')) { ?>
              <div class="box"  align="center">
                <p><a href="benef.php" title="اطلاعات بهره برداران کشاورزی"><img src="../files/farmer.png" alt="upload" width="71" height="86" border="0" class="tricky_image" /></a></p>
<p><a href="benef.php" class="btn"> بهره برداران کشاورزی</a></p>
</div>
            <?php }if(strstr($perm,'d1') or strstr($perm,'d2')) { ?>
              <div class="box" align="center">
                <p><a href="Agri" title="مدیریت امور زراعت"><img src="../files/zera.png" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="Agri" class="btn">  زراعت</a></p>
              </div>
           <?php } if(strstr($perm,'d3') or strstr($perm,'d4') or strstr($perm,'d5')) { ?>
              <div class="box" align="center">
                              <p><a href="Garden" title="#"><img src="../files/tree.png" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                              <p><a href="Garden" class="btn">  باغبانی </a></p>
                            </div>
           <?php } if(strstr($perm,'d7')) { ?>
              <div class="box" align="center">
                <p><a href="Poultry/" title="#"><img src="../files/bee.png" alt="users" width="136" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="Poultry/" class="btn"> زنبورعسل</a></p>
              </div>
           <?php } if(strstr($perm,'d6')) { ?>
              <div class="box" align="center">
                <p><a href="Aquatic" title="#"><img src="../files/fish1.png" alt="users" width="86" height="87" border="0" class="tricky_image" /></a></p>
                <p><a href="Aquatic" class="btn"> آبزی پروری</a></p>
              </div>
           <?php } if(strstr($perm,'d8')) { ?>
              <div class="box" align="center">
                <p><a href="Promotion/index.php" title="#"><img src="../files/farmer-512.png" alt="users" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="Promotion/index.php" class="btn">  ترویج</a></p>
              </div>
            <?php }?>
</td>
          </tr>
          <tr>
            <td  height="109"colspan="3" valign="middle" >
             <p class="style8"><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/></a></p>
            </td>
          </tr>
          <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
          </tr>
        </table>
      </div>
<!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code -->
</body>
</html>