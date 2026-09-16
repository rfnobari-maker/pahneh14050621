<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=build_list.xls");
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
if ($id_ostan == -1) { $v_id_ostan = 'id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 'id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
$query = "SELECT * FROM  promo_cent_build where  $v_id_ostan and  $v_id_city group by id_mar order by id_ostan,id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
    <table width="2000" height="96" border="0" align="center" cellpadding="1" cellspacing="1" >
    <tr align="center" class="text_r">
      <td width="3%" bgcolor="#999999">خانه سازمانی</td>
    <td width="3%" bgcolor="#999999">انبار</td>
    <td width="3%" bgcolor="#999999">فضای الگویی</td>
    <td width="3%" bgcolor="#999999">آبدارخانه</td>
    <td width="3%" bgcolor="#999999">سرویس بهداشتی</td>
    <td width="4%" bgcolor="#999999">خوابگاه</td>
    <td width="4%" bgcolor="#999999">اتاق نگهبان</td>
    <td width="3%" bgcolor="#999999">سرایداری</td>
    <td width="3%" bgcolor="#999999">محوطه</td>
    <td width="3%" height="42" bgcolor="#999999">راهرو و مشاعات</td>
    <td width="4%" bgcolor="#999999">نمازخانه</td>
    <td width="5%" bgcolor="#999999">سالن اجتماعات</td>
    <td width="5%" bgcolor="#999999">فضای آموزشی</td>
    <td width="4%" bgcolor="#999999">      نهادهای مردمی</td>
    <td width="4%" bgcolor="#999999">اتاق<br />
      کارشناسان</td>
    <td width="4%" bgcolor="#999999">اتاق رئیس مرکز</td>
    <td width="4%" bgcolor="#999999">نوع مالکیت</td>
    <td width="4%" bgcolor="#999999">مساحت عرصه</td>
    <td width="5%" bgcolor="#999999">مساحت اعیان</td>
    <td width="3%" bgcolor="#999999">سال ساخت</td>
    <td width="4%" bgcolor="#999999"> کد مرکز</td>
    <td width="7%" bgcolor="#999999">نام مرکز</td>
    <td width="7%" bgcolor="#999999">شهرستان</td>
    <td width="6%" bgcolor="#999999">استان</td>
    <td width="2%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
   
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {
if ($row['no_mal']=='1') $v_no_mal = 'ملکی' ;
if ($row['no_mal']=='2') $v_no_mal = 'استجاری' ;

?>
 <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_16'];?></span></td>
<td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_15'];?></span></td>
<td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_14'];?></span></td>
<td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_13'];?></span></td>
<td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_12'];?></span></td>
<td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_11'];?></span></td>
<td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_10'];?></span></td>
<td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_9'];?></span></td>
<td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_8'];?></span></td>
  <td height="51"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_7'];?></span></td>
  <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_6'];?></span></td>
  <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_5'];?></span></td>
  <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_4'];?></span></td>
  <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_3'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_2'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['faz_1'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $v_no_mal ; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['s_arce'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['s_ayan'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['y_make'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['id_mar'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo mar_name1($row['id_mar'],$row['id_ostan']) ;?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']);?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo ostan_name($row['id_ostan']);?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>