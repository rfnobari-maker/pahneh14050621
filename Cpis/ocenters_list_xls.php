<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=مراکز.xls");
include('../lock_cp.php');
include('counter.php');
 $id_ostan_sh = $_POST['id_ostan_sh'];
 $ostan_sh = $_POST['ostan_sh'] ;
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
      </p>
<?php include_once('../login/config.php');
$query = "SELECT * FROM  mar WHERE  id_ostan = '$id_ostan_sh' order by id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center" class="style1">مشخصات مراکز جهاد کشاورزی استان <?php echo $ostan_sh ?></p>
           <table width="98%" height="86" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td bordercolor="#FFFFFF" bgcolor="#999999"> تعداد آبادی <br /></td>
               <td bordercolor="#FFFFFF" bgcolor="#999999"> تعداد شهر</td>
               <td width="9%" bgcolor="#999999">تعداد کارشناس <br /></td>
               <td width="10%" bgcolor="#999999">تلفن همراه</td>
               <td width="11%" height="43" bgcolor="#999999">نام خانوادگی</td>
               <td width="10%" bgcolor="#999999">نام</td>
               <td width="13%" bgcolor="#999999">کد  مرکز جهاد کشاورزی </td>
               <td width="15%" bgcolor="#999999">نام مرکز جهاد کشاورزی </td>
               <td width="13%" bgcolor="#999999">شهرستان</td>
               <td width="5%" bgcolor="#999999">ردیف</td>
             </tr>
  <tr>
<?php
$r = 1 ;
foreach($stmt as $row){
$id_mar = $row['id_mar'] ; 
$query2 = "SELECT * FROM  users WHERE  id_mar = '$id_mar' and S_access = '2' order by id_city"  ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	 
?>
<td align="center" width="7%" height="40" bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_abadi_count($row['id_mar'])  ; ?></td>
<td align="center" width="7%" bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_shahr_count($row['id_mar'])  ;?></td>
    <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_mor_count($row['id_mar'])?></td>
    <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['tel_m'];?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row2['Last_name'];?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row2['name'];?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['id_mar'];?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['mar'];?><br /></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
<?php
$r++ ; 
}
?>
</table>
</body>
</html>



