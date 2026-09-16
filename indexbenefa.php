<?php 
include("lock_p1.php");
include('counter.php');
// $login_session ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ;?></title>
<link href="FA.css" rel="stylesheet" type="text/css" />
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
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
          <td><img src="files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td>
</td>
          </tr>
          <tr>
            <td>
  <?php include('top.php'); ?>
              <p align="right" class="RedTitleSmaller" style="margin-right:30px">&nbsp;</p>
              <p class="style8"><img src="login/help/mtoh0.jpg" width="709" height="103"  alt=""/></p>
            <p class="style9"><img src="login/help/mtoh3.jpg" width="850" height="286"  alt=""/></p>
            <p class="style9">&nbsp;</p>
            <p class="style9"><a href="indexbenefb.php" class="btn">ورود به صفحه اصلی </a></p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p></td>
          </tr>
          <tr>
<td  height="109"colspan="3" valign="middle" background="files/bottom.gif"><?php include('footer.php')?></td>
          </tr>
        </table>
      </div>
<p><!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code --></p>
</body>
</html>