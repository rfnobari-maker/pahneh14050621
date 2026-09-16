<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=supplies_list.xls");
?>
<?php 
include('../../../lock_oce.php');
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
$query = "SELECT DISTINCT id_mar,id_city,id_ostan  FROM  promo_cent_supplies where  $v_id_ostan and  $v_id_city order by id_ostan,id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
  <table width="95%" height="94" border="2" align="center" cellpadding="2" cellspacing="2" >
    <tr align="center" class="text1">
      <td height="45" bgcolor="#999999">سمپاش</td>
      <td width="3%" bordercolor="#FFFFFF" bgcolor="#999999">تراکتور</td>
      <td width="17%" bordercolor="#FFFFFF" bgcolor="#999999">خودرو</td>
      <td width="17%" bordercolor="#FFFFFF" bgcolor="#999999">آرشیو رسانه های ترویجی</td>
      <td width="34%" bordercolor="#FFFFFF" bgcolor="#999999">تابلو اعلانات ترویجی</td>
      <td width="34%" bordercolor="#FFFFFF" bgcolor="#999999">تلویزیون</td>
      <td width="34%" bordercolor="#FFFFFF" bgcolor="#999999">پرده نمایش</td>
      <td width="34%" bordercolor="#FFFFFF" bgcolor="#999999">چاپگر</td>
      <td width="34%" bordercolor="#FFFFFF" bgcolor="#999999">اسکنر</td>
      <td width="34%" bordercolor="#FFFFFF" bgcolor="#999999">اینترنت</td>
      <td width="34%" bordercolor="#FFFFFF" bgcolor="#999999">ویدئو پروژکتور</td>
      <td width="7%" bordercolor="#FFFFFF" bgcolor="#999999">دستگاه کپی</td>
      <td width="7%" bordercolor="#FFFFFF" bgcolor="#999999">دستگاه فاکس</td>
      <td width="8%" bordercolor="#FFFFFF" bgcolor="#999999">دوربین دیجیتالی</td>
      <td width="7%" bordercolor="#FFFFFF" bgcolor="#999999">GPS</td>
      <td width="4%" bordercolor="#FFFFFF" bgcolor="#999999">لب تاپ</td>
      <td width="3%" bordercolor="#FFFFFF" bgcolor="#999999">رایانه</td>
      <td width="4%" bordercolor="#FFFFFF" bgcolor="#999999">صندلی</td>
      <td width="3%" bordercolor="#FFFFFF" bgcolor="#999999">میز</td>
      <td width="3%" bordercolor="#FFFFFF" bgcolor="#999999">کد مرکز</td>
      <td width="6%" bgcolor="#999999">مرکز جهاد کشاورزی</td>
      <td width="6%" bgcolor="#999999">شهرستان</td>
      <td width="4%" bgcolor="#999999">استان</td>
      <td width="4%" bgcolor="#999999">ردیف</td>
      
    </tr>
             <tr>
               
  <?php
$r = 1 ;
 foreach($stmt as $row){
$id_city = $row['id_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_mar = $row['id_mar'] ;
// شمارش تعداد تجهیزات مرکز

$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '18' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row33 = $stmt->fetch(PDO::FETCH_ASSOC);

$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '19' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row44 = $stmt->fetch(PDO::FETCH_ASSOC);

$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '1' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row3 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '2' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row4 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '3' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row6 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '4' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row7 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '5' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row8 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '6' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row9 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '7' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row10 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '8' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row11 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '9' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row12 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '10' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row13 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '11' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row14 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '12' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row15 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '13' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row16 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '14' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row17 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '15' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row18 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '16' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row19 = $stmt->fetch(PDO::FETCH_ASSOC);
//
$query = "SELECT SUM(num) as num_taj1 FROM promo_cent_supplies where  id_ostan = '$id_ostan' and  id_city='$id_city' and id_mar = '$id_mar' and no_taj = '17' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row20 = $stmt->fetch(PDO::FETCH_ASSOC);
//
?>
  <td align="center" width="4%" height="43"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row20['num_taj1'] ?></span></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row19['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row18['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row17['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row16['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row15['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row14['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row13['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row12['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row11['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row10['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row9['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row8['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row7['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row6['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row4['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo $row3['num_taj1'] ?></span></td>
               <td align="center" bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row44['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row33['num_taj1'] ?></td>
               <td align="center" bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo $row['id_mar'];?></span></td>
               <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall">
			   <?php //echo mar_name1($row['id_mar'],$row['id_ostan']) ;?>
               <?php echo mar_name($row['id_mar']) ;?>
               </td>
               <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']);?></td>
               <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo ostan_name($row['id_ostan']);?></td>
               <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
             </tr>
<?php
$r++ ; 
 }
?>
</table>