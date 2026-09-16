
<?php include("../lock_cp.php");
include('counter.php');
 //echo $login_session ;
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
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  border-left: 16px solid pink;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
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
              <div   align="center"> 
                <p class="style8">بهره برداران کشاورزی <br />
                <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>                </p>
                <p>&nbsp;</p>
              </div>
              <div class="box"  align="center">
                <p><a href="list_bah.php"><img src="../files/farmer.png" alt="ویرایش" width="71" height="86" border="0" class="tricky_image" /></a></p>
<p><a href="list_bah.php" class="btn">لیست بهره برداران کشاورزی </a></p>
</div>
              <div class="box" align="center">
                <p><a href="bah_rep1.php" title="پنل مدیریتی استان ها "><img src="../files/centers.png" alt="استان ها" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="bah_rep1.php" class="btn"> گزارش به تفکیک مدرک تحصیلی</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="bah_rep2.php" title=" لیست شهر های تحت پوشش"><img src="../files/p_abadi.png" alt="شهرها" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="bah_rep2.php" class="btn"> گزارش به تفکیک زمینه فعالیت</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="GetPerson.php#1"><img src="../files/GetPer.png" alt="استعلام" width="87" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="GetPerson.php#1" class="btn">استعلام مشخصات بهره بردار </a><br />
                </p>
              </div>
              <div class="box" align="center">
                <p><a href="summary2.php" title="بهره برداری های ثبت شده"><img src="../files/backup.jpg" alt="بهره برداری های ثبت شده" width="92" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="summary2.php" class="btn">فرم های تکمیل شده  به تفکیک بهره بردار</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="summary.php" title="فرم های تکمیل شده"><img src="../files/Sback.PNG" alt="فرم های تکمیل شده" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="summary.php" class="btn">فرم های تکمیل شده</a></p>
              </div>
              <div class="box" align="center">
                <p><a href="../search_benef.php"><img src="../files/user-search-icon.png" alt="سوابق" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="search_benef.php" class="btn">سوابق  بهره بردار </a><br />
                </p>
              </div>
              <div class="box" align="center">
                <p><a href="list_bah_lastname.php"><img src="../files/0347.png" alt="سوابق" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="list_bah_lastname.php" class="btn">جستجو براساس نام خانوادگی</a><br />
                </p>
              </div>
              <p class="style9">&nbsp;</p>
              <p class="style9">&nbsp;</p>
              <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p></td>
          </tr>
          <tr>
            <td  colspan="3" valign="middle" ><p><a href="prof.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/></a></p>
            <p>&nbsp;</p></td>
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