<?php include("../lock_ce.php");
include('counter.php');
//include('side_menu1.php');

 //echo $login_session ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link rel="shortcut icon" href="../files/images/favicon.ico" type="image/x-icon">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
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
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
          <td><img src="../files/images/header.jpg" width="100%" height="130" /></td>
          </tr>
          <tr>
            <td ><?php include('menu.php'); ?>
</td>
          </tr>
          <tr>
            <td>
           <?php include('top.php'); ?>
              <div   align="center">
</div>
           <?php if(strstr($perm,'p1')) { ?>
              <div class="box" align="center">
                <p><a href="provinces.php" title="پنل مدیریتی استان ها "><img src="../files/centers.png" alt="استان ها" width="86" height="83" border="0" class="tricky_image" /></a></p>
                <p><a href="provinces.php" class="btn" onclick="showMessage(event)">   استان های تحت پوشش: <?php echo ostan_count() ;  ?></a></p>
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


<script>
function showMessage(event) {
  // نمایش پیام "لطفاً صبر کنید"
  alert("لطفاً صبر کنید");

  // عدم اجرای عملکرد پیش‌فرض لینک
  event.preventDefault();

  // با تاخیر بارگیری صفحه مورد نظر
  setTimeout(function() {
    window.location.href = "provinces.php";
  }, 3000);
}
</script>

</body>
</html>