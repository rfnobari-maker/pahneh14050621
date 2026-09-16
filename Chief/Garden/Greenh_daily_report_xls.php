<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_روزانه.xls");
include('../../lock_ce.php');
include('../../event.php');
include('Greenh_DR_counter.php');
include_once('../../login/config.php');
$Base = $_POST['Base'] ; 
$date_today = $_POST['date_today'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>

<p align="center">گزارش خلاصه روزانه گلخانه ها تهیه شده در تاریخ : <?php echo $date_today?></p>
<?php 

     if ($Base == '-1')   { $v_id_ostan = 1 ; $v_Group = id_ostan ;} 
else if ($Base == '-2')   { $v_id_ostan = 1 ; $v_Group = "id_ostan,id_city ";}
else if ($Base  > '-1')   { $v_id_ostan = "id_ostan='$Base'" ; $v_Group = id_city ;}

 $query = "SELECT id_ostan,id_city,city FROM cityname where $v_id_ostan group by $v_Group ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21'),id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<table  border="1" bordercolor="#0099FF" align="center" cellpadding="0" cellspacing="0" >
   <tr align="center" class="text1">
               <td bgcolor="#999999"> افزایش یا کاهش مساحت گلخانه نسبت به روز قبل</td>
               <td bgcolor="#999999"> افزایش یا کاهش تعداد واحد نسبت به روز قبل</td>
               <td bgcolor="#999999">مساحت گلخانه در روز قبل/ مترمربع</td>
               <td bgcolor="#999999">تعداد واحد در روز قبل </td>
               <td width="12%" bgcolor="#999999">مساحت گلخانه در روز جاری/ مترمربع</td>
     <td width="11%" bgcolor="#999999">تعداد واحد در روز جاری </td>
<?PHP if($Base != '-1') {?> 
               <td width="15%" bgcolor="#999999" >شهرستان</td>
<?php }?>
               <td width="16%" bgcolor="#999999">استان </td>
               <td width="6%" bgcolor="#999999">ردیف</td>
   </tr>
  <tr>
    <?php
$r = 1 ;
 foreach($stmt as $row){
?>
    <td align="center" width="10%" height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($Base == '-1') 
	{ 	echo round(ostan_mz($row['id_ostan'])  - ostan_mz_noToday($row['id_ostan'],$date_today),1) ;}
	else { 	echo round(city_mz($row['id_ostan'],$row['id_city']) - city_mz_noToday($row['id_ostan'],$row['id_city'],$date_today),1) ;	}?></td>
    <td align="center" width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
	<?php if($Base == '-1') 
	{ 	echo ostan_counter($row['id_ostan']) - ostan_counter_noToday($row['id_ostan'],$date_today) ;}
	else { 	echo city_counter($row['id_ostan'],$row['id_city']) - city_counter_noToday($row['id_ostan'],$row['id_city'],$date_today) ;	}?></td>
    <td align="center" width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($Base == '-1') 
	{ 	echo ostan_mz_noToday($row['id_ostan'],$date_today) ;}
	else { 	echo city_mz_noToday($row['id_ostan'],$row['id_city'],$date_today) ;	}?></td>
    <td align="center" width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($Base == '-1') 
	{ 	echo ostan_counter_noToday($row['id_ostan'],$date_today) ;}
	else { 	echo city_counter_noToday($row['id_ostan'],$row['id_city'],$date_today) ;	}?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
		<?php if($Base == '-1') { 	echo ostan_mz($row['id_ostan']) ;}
	else { 	echo city_mz($row['id_ostan'],$row['id_city']) ;	}?> </td>

    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
		<?php if($Base == '-1') { 	echo ostan_counter($row['id_ostan']) ;}
	else { 	echo city_counter($row['id_ostan'],$row['id_city']) ;	}?> </td>
<?PHP if($Base != '-1') {?> 
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'];?></td>
<?php }?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo ostan_name($row['id_ostan']);?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
  <tr>
    <td align="center" width="10%" height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($Base == '-1' or $Base=='-2')
	{ 	echo round(kol_mz()  - kol_mz_noToday($date_today),1) ;}
	else { 	echo round(ostan_mz($row['id_ostan'])  - ostan_mz_noToday($row['id_ostan'],$date_today),1) ;}?></td>
    <td align="center" width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
	<?php if($Base == '-1' or $Base=='-2')
	{ 	echo kol_counter() -  kol_counter_noToday($date_today) ;}
	else { 	echo ostan_counter($row['id_ostan']) - ostan_counter_noToday($row['id_ostan'],$date_today) ;}?></td>
    <td align="center" width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($Base == '-1' or $Base=='-2')
	{ 	echo kol_mz_noToday($date_today) ;}
	else { echo ostan_mz_noToday($row['id_ostan'],$date_today) ;}?></td>
    <td align="center" width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($Base == '-1' or $Base=='-2')
	{ 	echo kol_counter_noToday($date_today) ;}
	else { echo ostan_counter_noToday($row['id_ostan'],$date_today) ;}?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
		<?php if($Base == '-1' or $Base=='-2') { 	echo kol_mz() ;}
	else { echo ostan_mz($row['id_ostan']) ; 	}?> </td>

    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
		<?php if($Base == '-1' or $Base=='-2') { echo kol_counter() ;}
	else { 	echo ostan_counter($row['id_ostan']) ;	}?> </td>
    <td align="center" colspan="3"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>جمع کل</td>
   </tr>

</table>
</body>
</html>