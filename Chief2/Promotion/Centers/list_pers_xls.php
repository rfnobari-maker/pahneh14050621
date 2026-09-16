<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=personnel_list.xls");
?>
<?php 
include('../../../lock_ce.php');
include('../../../event.php') ;
include ('../../../login/config.php');
$id_ostan = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
<tr>
  <td>
      <?php 
if ($id_ostan == '-1') { $v_id_ostan = 'id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 'id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
$query = "SELECT * FROM  mar where  $v_id_ostan and  $v_id_city order by id_ostan,id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
    <table width="2000" height="103" border="0" align="center" cellpadding="1" cellspacing="1" >
    <tr align="center" class="text_r">
      <td width="4%" height="42" bgcolor="#999999">جمع</td>
    <td width="4%" bgcolor="#999999">سرباز سازندگی</td>
    <td width="4%" bgcolor="#999999">نیروی پشتیبانی</td>
    <td width="5%" bgcolor="#999999">کارشناس پهنه</td>
    <td width="3%" bgcolor="#999999">رئیس مرکز</td>
    <td width="4%" bgcolor="#999999"> کد مرکز</td>
    <td width="6%" bgcolor="#999999">نام مرکز</td>
    <td width="7%" bgcolor="#999999">شهرستان</td>
    <td width="7%" bgcolor="#999999">استان</td>
    <td width="2%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
   
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {
?>
    <td align="center" height="44" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo mar_kol($row['id_ostan'],$row['id_mar'])?></td>
    <td align="center"  bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="tilt"><?php echo mar_sar($row['id_ostan'],$row['id_mar'])?></span></td>
    <td align="center"  bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="tilt"><?php echo mar_p($row['id_ostan'],$row['id_mar'])?></span></td>
    <td align="center"  bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="tilt"><?php echo mar_k($row['id_ostan'],$row['id_mar'])?></span></td>
    <td align="center"  bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="tilt"><?php echo mar_r($row['id_ostan'],$row['id_mar'])?></span></td>
    <td align="center"  bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo $row['id_mar'];?></span></td>
 <td align="center"   class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['mar'];?></span></td>
    <td align="center"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']);?></span></td>
    <td align="center"  style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo ostan_name($row['id_ostan']);?></span></td>
    <td align="center"  style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
<?php

function mar_kol($id_ostan1,$id_mar1)
{
include('../../../login/config.php');
 $query = "SELECT  count(*) FROM  users WHERE  id_ostan = '$id_ostan1' and id_mar = '$id_mar1' and (
     S_access='2' or S_access='1' or S_access= '50' or S_access='51' ) " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol = $stmt->fetchColumn();
return $kol ; 	

}

function mar_sar($id_ostan1,$id_mar1)
{
include('../../../login/config.php');
 $query = "SELECT  count(*) FROM  users WHERE  id_ostan = '$id_ostan1' and id_mar = '$id_mar1' and  S_access='51' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$sar = $stmt->fetchColumn();
return $sar ; 	

}

function mar_p($id_ostan1,$id_mar1)
{
include('../../../login/config.php');
 $query = "SELECT  count(*) FROM  users WHERE  id_ostan = '$id_ostan1' and id_mar = '$id_mar1' and  S_access='50' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$sar = $stmt->fetchColumn();
return $sar ; 	

}

function mar_k($id_ostan1,$id_mar1)
{
include('../../../login/config.php');
 $query = "SELECT  count(*) FROM  users WHERE  id_ostan = '$id_ostan1' and id_mar = '$id_mar1' and  S_access='1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$sar = $stmt->fetchColumn();
return $sar ; 	

}

function mar_r($id_ostan1,$id_mar1)
{
include('../../../login/config.php');
 $query = "SELECT  count(*) FROM  users WHERE  id_ostan = '$id_ostan1' and id_mar = '$id_mar1' and  S_access='2' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$sar = $stmt->fetchColumn();
return $sar ; 	

}
?>

