<?php include("../lock_cp.php");
include('counter.php');
		   include('side_menu.html');
 //echo $login_session ;
?>
<link rel="shortcut icon" href="../files/images/favicon.ico" type="image/x-icon">
<link href="../FA01.css" rel="stylesheet" type="text/css" />
<title><?php echo $title ;?></title>

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
.box1 {width:275px ; float:right ; line-height:150% ; margin-left:10px ; margin-top:10px ; margin-bottom:30px ; font-family:Tahoma ; margin-right:20px 
}
</style>
</head>
<body style="top:-70px">

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
             <tr>
            <td dir="ltr"><?php include('header.html'); ?>
             </td>
          </tr>
          <tr>
            <td>
           <?php include('top.php') ; ?>
           
              <div   align="center">
</div>
           <?php if(strstr($perm,'p1')) { ?>
              <div class="box" align="center">
                <p><a href="provinces.php" title="پنل مدیریتی استان ها "><img src="../files/centers.png" alt="استان ها" width="86" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="provinces.php" class="btn">   استان های تحت پوشش: <?php echo ostan_count() ;  ?></a></p>
              </div>
            <?php } if(strstr($perm,'p1')) { ?>
              <div class="box" align="center">
                <p><a href="cities&amp;villages.php" title=" شهر های آبادی ها "><img src="../files/city.png" alt="شهرها و آبادی ها " width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="cities&amp;villages.php" class="btn">شهرها و آبادی ها +</a></p>
              </div>
             <?php } if(strstr($perm,'d')) { ?>
              <div class="box" align="center">
                <p><a href="prof.php" title="اطلاعات اختصاصی  آبادی ها"><img src="../files/p_abadi.png" alt="اطلاعات اختصاصی " width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="prof.php" class="btn"> اطلاعات اختصاصی +</a></p>
              </div>
             <?php } if(strstr($perm,'p3')) { ?>
              <div class="box" align="center">
                <p><a href="list_center.php" title="اطلاعات مراکز جهاد کشاورزی"><img src="../files/mar.png" alt="مراکز جهاد " width="83" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="list_center.php" class="btn">مراکز جهاد کشاورزی:<?php echo totl_mar_count() ; ?></a></p>
              </div>
             <?php } if(strstr($perm,'p4')) { ?>
              <div class="box" align="center">
                <p><a href="users.php" title=" کاربران سامانه"><img src="../files/login_rep.png" alt=" کاربران سامانه" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="users.php" class="btn">کاربران سامانه +</a></p>
              </div>
             <?php } 
		   $query = "SELECT * from users  WHERE username='".$user_check."' and S_access='99' ";
           $stmt = $dbh->prepare($query);
           $stmt->execute();
           $ch_num = $stmt -> rowCount();
		   if ($ch_num > 0)
           {
		   ?>
              <div class="box1" align="center">
                <p><a href="../asystem" title="سوئیچ به محیط کاربری ادمین "><img src="../files/changeuser.png"  width="83" height="85" border="0" class="tricky_image" /></a></p>
                <p><a href="../asystem" class="btn">کاربری ادمین سامانه +</a></p>
              </div>
<?php }?>              
            <p class="style9">&nbsp;</p></td>
          </tr>
          <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
          </tr>
        </table>
      </div>
<p><!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code --></p>
</body>
</html>