<?php
include("../lock_ad.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
#int
{ margin-right:10px 
}
</style>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4" height="230"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><?php 
 include ('../login/config.php');
 ?>
      <p align="center" >
        <?php include ('../login/config.php');
 $query = "SELECT * FROM  mar where  id_ostan = '$id_ostan' "    ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
        لیست مراکز جهاد کشاورزی</p>
      <table width="250" height="99" border="1" align="center" cellpadding="0" cellspacing="0" >
        <tr align="center" class="style8">
          <td width="34%" height="58" bgcolor="#CCCCCC">کد مرکز</td>
          <td width="66%" bgcolor="#CCCCCC">نام مرکز</td>
          <td width="66%" bgcolor="#CCCCCC">شهرستان</td>
        </tr>
        <tr>
          <?php
 foreach($stmt as $row){
?>
          <td height="39" class="normalTextSmaller"><?php echo $row['id_mar'];?></td>
          <td   class="normalTextSmaller"><?php echo $row['mar'];?></td>
          <td   class="normalTextSmaller"><?php echo $row['city'];?></td>
          <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
        </tr>
        <?php
}
?>
      </table>
    </td>
  </tr>
</table>
</td>
                  </tr>
</table>
</body>
</html>
 