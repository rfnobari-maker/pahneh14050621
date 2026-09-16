<?php //include('lock_p1.php');?>
<?php
$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="FA.css" rel="stylesheet" type="text/css" />
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>سامانه پهنه بندی روستاهای آذربایجان شرقی</title>
	<link rel="stylesheet" href="jspc-gray.css">
	<script type="text/javascript" src="js-persian-cal.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
-->
    </style>
	<script src="./assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
        });
    </script>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php //include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><?
include('login/config.php');
$query = "SELECT * FROM  log ORDER BY date DESC , time DESC" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p>مشاهده عملکرد زنده کاربران در سامانه </p>
           <p><img src="files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <p>&nbsp;</p>
           <table width="85%" height="97" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="11%" height="49" bgcolor="#CCCCCC">عملیات</td>
    <td width="18%" height="49" bgcolor="#CCCCCC">آدرس آماری آبادی</td>
    <td width="11%" bgcolor="#CCCCCC">نام آبادی</td>
    <td width="12%" bgcolor="#CCCCCC">دهستان</td>
    <td width="15%" bgcolor="#CCCCCC">بخش</td>
    <td width="15%" bgcolor="#CCCCCC">شهرستان</td>
    <td width="12%" bgcolor="#CCCCCC">استان</td>
    <td width="6%" bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
    <td class="normalTextSmaller"><?php echo $row['username'];?></td>
    <td class="normalTextSmaller"><?php echo $row['ip'];?></td>
    <td class="normalTextSmaller"><?php echo $row['date'];?></td>
    <td class="normalTextSmaller"><?php echo $row['time'];?></td>
    <td class="normalTextSmaller"><?php echo $row['add_abadi'];?></td>
    <td class="normalTextSmaller"><?php echo $row['verb'];?></td>
    <td><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
  <td  height="109"colspan="3" valign="middle" background="files/bottom.gif"><p class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 34438000-6 041 فکس: 334439940 041<br />
          <span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</table>
</body>
</html>
