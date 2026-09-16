<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=organiz_list.xls");
?>
<?php 
include('../../../lock_expsh.php');
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
$query = "SELECT * FROM  promo_cent_organiz where  $v_id_ostan and  $v_id_city group by id_mar order by id_ostan,id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
  <table width="95%" height="195" border="0" align="center" cellpadding="0" cellspacing="2" >
    <tr align="center" class="text1">
               <td height="35" colspan="3" bgcolor="#999999">تعداد تشکل های کشاورزی</td>
               <td colspan="4" bordercolor="#FFFFFF" bgcolor="#999999">مراکز موضوع ماده 2</td>
               <td width="12%" rowspan="2" bgcolor="#999999">مرکز جهاد کشاورزی</td>
    <td width="12%" rowspan="2" bgcolor="#999999">شهرستان</td>
    <td width="11%" rowspan="2" bgcolor="#999999">استان</td>
    <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>

  </tr>
             <tr align="center" class="text1">
               <td height="90" bgcolor="#999999">تشکل کشاورزی موضوعی - محصولی</td>
               <td height="90" bgcolor="#999999">شرکت های سهامی زراعی</td>
               <td height="90" bgcolor="#999999">تعاونی تولید روستایی</td>
               <td bordercolor="#FFFFFF" bgcolor="#999999">سایر مراکز موضوع ماده 2</td>
               <td bordercolor="#FFFFFF" bgcolor="#999999">کلینیک دامپزشکی</td>
               <td bordercolor="#FFFFFF" bgcolor="#999999">کلینیک گیاهپزشکی</td>
               <td bordercolor="#FFFFFF" bgcolor="#999999">مشاوره ای  - فنی و مهندسی</td>
              </tr>
  <tr>
   
<?php
$r = 1 ;
 foreach($stmt as $row){
$id_city = $row['id_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_mar = $row['id_mar'] ;
?>
<td align="center" width="10%" height="62"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['ta_3'];?></span></td>
<td align="center" width="8%" height="62"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['ta_2'];?></span></td>
    <td align="center" width="8%"   <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['ta_1'];?></span></td>
    <td align="center" width="8%" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mmd_4'];?></td>
    <td align="center" width="8%" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mmd_3'];?></td>
    <td align="center" width="9%" bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mmd_2'];?></td>
    <td align="center" width="9%" bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo $row['mmd_1'];?></span></td>
    <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo mar_name($row['id_mar']) ;?></td>
    <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']);?></td>
    <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo ostan_name($row['id_ostan']);?></td>
    <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
 }
?>
</table>
