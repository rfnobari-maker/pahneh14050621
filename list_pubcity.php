<?php include('lock_p1.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="jspc-gray.css">
    <style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>
</head>
<body>
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
   <?php include('top.php'); ?>
    <td width="840" ><?php
$query = "SELECT add_city,shahr,bakh FROM  list_city WHERE mor_cod_m = '$user_check' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p>اطلاعات عمومی  شهر های تحت پوشش </p>
           <p><img src="files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <p>&nbsp;</p>
           <table width="85%" height="101" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td height="56" bgcolor="#CCCCCC">عملیات</td>
    <td width="14%" height="56" bgcolor="#CCCCCC" class="style2">تاریخ آخرین بروز رسانی </td>
    <td width="22%" bgcolor="#CCCCCC">آدرس آماری شهر</td>
    <td width="18%" bgcolor="#CCCCCC">نام شهر</td>
    <td width="16%" bgcolor="#CCCCCC">بخش</td>
    <td width="5%" bgcolor="#CCCCCC">ردیف</td>
  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
$add_city = $row['add_city'] ;
$query3 = "SELECT up_date FROM  public_city  where add_city = '$add_city' " ;
$stmt3 = $dbh->prepare($query3);
$stmt3->execute();
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
$up_date = $row3['up_date'] ; 
if ($up_date=='') $up_date =  '<p style=color:red> عدم بروز رسانی</p>' ;
?>
<td width="10%" height="45" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><form  action="public_city.php" method="post">
  <input type="hidden" name="add_city" value="<?php echo $row['add_city'] ;?>" />
  <button><img src="files/edit.png" border="0"  title="ويرايش اطلاعات عمومی شهر" width="30" height="30" /></button>
</form></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $up_date ;?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['add_city'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['shahr'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['bakh'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="indexbenef.php" title="برگشت به صفحه قبل"><img src="files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="files/bottom.gif"><?php include('footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>