<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=کدینگ_محصولات_باغی.xls");
//include('lock_ce.php');
include('event.php') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    </style>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

-->
</style>
</head>
<body>
      <p>
             <?php 
include('login/config.php');
$query = "SELECT * FROM product_b_new WHERE 1 ORDER BY group_cod,product_cod";
$stmt= $dbh->prepare($query);
$stmt->execute(array());
?>
<p align="center" dir="rtl">کدینگ محصولات باغی</p>
      <table width="98%" height="86" border="0" align="center" cellpadding="1" cellspacing="1" >
        <tr align="center" class="text_r">
          <td width="14%" height="42" bgcolor="#999999">کد محصول </td>
    <td width="19%" bgcolor="#999999">نام محصول </td>
    <td width="15%" bgcolor="#999999">کد گروه </td>
    <td width="14%" bgcolor="#999999">نام گروه </td>
    <td width="4%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {

//echo $row2['User_Name'] ; 
?>
    <td height="27" class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['product_cod_new'] ;  ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo $row['product_name'] ; ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo $row['group_cod'] ; ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo $row['group_name']; ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
  <p align="center"> ------------- پایان گزارش -----------------</p>
