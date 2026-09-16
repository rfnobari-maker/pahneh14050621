<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=داشبورد_مدیریتی.xls");
include('../lock_oce.php');
include('counter.php');
//$id_ostan = $_POST['id_ostan'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
<?php include('../login/config.php');
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan' order by id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center" class="style1">داشبورد مدیریتی /  شهرستان های استان </p>
                        <table width="800" height="107" border="1" bordercolor="#0099CC" align="center" cellpadding="1" cellspacing="0" >
             <tr align="center" class="text1">
    <td colspan="5" bgcolor="#999999">تعداد</td>
    <td height="37" colspan="2" bgcolor="#999999">مشخصات مدیر شهرستان </td>
    <td width="14%" rowspan="2" bgcolor="#999999">شهرستان </td>
    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td bgcolor="#999999">بهره بردار<br /></td>
    <td bgcolor="#999999"> آبادی <br /></td>
    <td bgcolor="#999999">شهر</td>
    <td bgcolor="#999999">مروج<br /></td>
    <td width="9%" bgcolor="#999999">مرکز<br /></td>
    <td width="18%" height="32" bgcolor="#999999">نام خانوادگی</td>
    <td width="12%" bgcolor="#999999">نام</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
	 $id_city = $row['id_city'] ;
$query2 = "SELECT name,Last_name FROM  users WHERE  id_city = '$id_city' and id_ostan = '$id_ostan' and  S_access = '3'"  ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
//echo $row2['User_Name'] ; 
?>
  <td align="center" width="15%" height="36"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_count($id_ostan,$row['id_city'])?></td>
  <td  align="center"width="12%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <?php echo city_abadi_count($id_ostan,$row['id_city'])?>
  </td>
    <td align="center" width="8%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_shahr_count($id_ostan,$row['id_city'])?></td>
    <td align="center" width="8%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_mor_count($id_ostan,$row['id_city'])?></td>
    <td  align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <?php echo city_mar_count($id_ostan,$row['id_city']);?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row2['Last_name'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row2['name'];?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?>    </td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
</body>
</html>