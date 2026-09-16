<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=public_list.doc");
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
$query = "SELECT * FROM  promo_cent_public where  $v_id_ostan and  $v_id_city order by id_ostan,id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
            <p align="center">اطلاعات عمومی مراکز</p>
    <table width="98%" height="96" border="0" align="center" cellpadding="1" cellspacing="1" >
    <tr align="center" class="text_r">
      <td width="9%" bgcolor="#999999">آدرس مرکز</td>
    <td width="9%" bgcolor="#999999">غالب دامی3</td>
    <td width="9%" bgcolor="#999999">غالب دامی 2</td>
    <td width="9%" bgcolor="#999999">غالب دامی 1</td>
    <td width="9%" bgcolor="#999999">غالب باغی 3</td>
    <td width="9%" bgcolor="#999999">غالب باغی 2</td>
    <td width="9%" bgcolor="#999999">غالب باغی1</td>
    <td width="9%" bgcolor="#999999">غالب زراعی3</td>
    <td width="9%" bgcolor="#999999">غالب زراعی2</td>
    <td width="9%" height="42" bgcolor="#999999">غالب زراعی1</td>
    <td width="9%" bgcolor="#999999">فعالیت غالب</td>
    <td width="9%" bgcolor="#999999">فاصله نزدیکترین آبادی<br /></td>
    <td width="9%" bgcolor="#999999">فاصله دورترین آبادی<br /></td>
    <td width="9%" bgcolor="#999999">فاکس</td>
    <td width="9%" bgcolor="#999999">تلفن</td>
    <td width="9%" bgcolor="#999999">کد پستی</td>
    <td width="9%" bgcolor="#999999">عرض جغرافیایی</td>
    <td width="9%" bgcolor="#999999">طول جغرافیایی</td>
    <td width="9%" bgcolor="#999999">سال تاسیس</td>
    <td width="9%" bgcolor="#999999">سطح مرکز</td>
    <td width="9%" bgcolor="#999999"> کد مرکز</td>
    <td width="11%" bgcolor="#999999">نام مرکز</td>
    <td width="11%" bgcolor="#999999">شهرستان</td>
    <td width="10%" bgcolor="#999999">استان</td>
    <td width="5%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
   
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {
?>
 <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['address'];?></span></td>
<td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['to_d3'];?></td>
<td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['to_d2'];
?></td>
<td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['to_d1'];?></span></td>
<td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['to_b3'];
?></span></td>
<td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['to_b2'];?></span></td>
<td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['to_b1'];?></span></td>
<td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['to_z3'];?></span></td>
<td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['to_z2'];?></span></td>
  <td height="51"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['to_z1'];?></span></td>
  <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['zf_g'];?></span></td>
  <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['f_naz_ab'];?></span></td>
  <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['f_dor_ab'];?></span></td>
  <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['fax'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tel'];?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['cod_pos'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['lat'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['lng'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['y_tas'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['rating'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['id_mar'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['m_name'];?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']);?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo ostan_name($row['id_ostan']);?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>