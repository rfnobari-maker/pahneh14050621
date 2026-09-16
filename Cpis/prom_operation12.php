<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=list.xls");
include('../lock_cp.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>
</head>
<body>
    <?php
include_once('../login/config.php');
$query = "SELECT * FROM  log  where  id_ostan = '12' and date > '1397/12/29' ORDER BY date DESC , time DESC " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
    ?>
  </p>
  <table width="90%" height="78" border="1" align="center" cellpadding="0" cellspacing="0" >
          <tr align="center" class="style8">
    <td width="15%"  height="37" bgcolor="#CCCCCC">آی پی سیستم</td>
    <td width="12%"  bgcolor="#CCCCCC">ساعت</td>
    <td width="12%"  bgcolor="#CCCCCC">تاریخ</td>
    <td width="19%"  bgcolor="#CCCCCC">نام آبادی</td>
    <td width="25%"  bgcolor="#CCCCCC">عملیات</td>
    <td width="13%"  bgcolor="#CCCCCC">کد ملی کارشناس</td>
    <td width="4%"  bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
foreach($stmt as $row){
	$add_abadi =  $row['add_abadi'] ; 
$query3 = "SELECT * FROM  list_abadi  where add_abadi = '$add_abadi' " ;
$stmt3 = $dbh->prepare($query3);
$stmt3->execute();
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
?>
    <td height="39" class="normalTextSmall"><?php echo $row['ip'];?></td>
    <td class="normalTextSmall"><?php echo $row['time'];?></td>
    <td class="normalTextSmall"><?php echo $row['date'];?></td>
    <td class="normalTextSmall"><?php echo $row3['abadi'];?></td>
    <td class="normalTextSmall"><?php echo $row['verb'];?></td>
    <td><span class="normalTextSmall"><?php echo $row['username'];?></span></td>
    <td><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
</body>
</html>