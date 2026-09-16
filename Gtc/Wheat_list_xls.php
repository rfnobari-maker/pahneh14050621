<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=wheat_list.xls");
include('../lock_df.php');
include('../event.php') ;
$date_s1 = $_POST['date_s1'];
$date_s2 = $_POST['date_s2'];
if ($date_s1 == '') { $v_date_s1 = 1 ;} else { $v_date_s1 = "Agri_prod.date_s >= '$date_s1'" ;}
if ($date_s2 == '') { $v_date_s2 = 1 ;} else { $v_date_s2 = "Agri_prod.date_s <= '$date_s2'" ;}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
      <p align="center"  class="style8">مشخصات گندم کاران سال زراعی 1397-1396 </p>
      <?php 
include('../login/config.php');
 $query = "SELECT Agri_prod.`date_s`,Agri_prod.`id_ostan` , Agri_prod.`id_city` , Agri_prod.`id_mar` , Agri_prod.`add_abadi` , Agri_prod.`add_city` , Agri_prod.`mor_cod_m` , bah.`bah_cod_m` , Agri_prod.`num_bah` , bah.`jens` , bah.`name` , bah.`last_name` , bah.`date_t` , bah.`sh_sh` , bah.`m_sod` , bah.`fname` , bah.`tel_s` , bah.`tel_m` ,Agri_prod.no_kesh
,Agri_prod.`mah_tolp`,Agri_prod.`zer_kesht_a`+Agri_prod.`zer_kesht_b` as zer_kesht
FROM bah
INNER JOIN Agri_prod ON bah.bah_cod_m = Agri_prod.bah_cod_m
AND bah.no_bah = Agri_prod.num_bah
AND Agri_prod.cod_mah = '102'
AND Agri_prod.z_sal = '1396-1397'
and Agri_prod.mah_tolp > 0
and Agri_prod.zer_kesht_a+Agri_prod.zer_kesht_b > 0
and $v_date_s1 and $v_date_s2
order by Agri_prod.date_s 
 "; 

$stmt= $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="98%" height="90" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor='#0066CC'>
        <tr align="center" class="text1">
          <td width="8%" bgcolor="#CCCCCC" class="style8">کد ملی کارشناس</td>
          <td width="5%" bgcolor="#CCCCCC" class="style8">نام کارشناس</td>
          <td  bgcolor="#CCCCCC"><span class="style8">عملکرد/تن</span></td>
          <td  bgcolor="#CCCCCC"><p class="style8">پیش بینی  /
          تن</p></td>
          <td width="5%" bgcolor="#CCCCCC" class="style8">سطح زیر کشت 
          / هکتار </td>
          <td bgcolor="#CCCCCC" class="style8">نوع کشت</td>
          <td bgcolor="#CCCCCC" class="style8">شماره همراه</td>
          <td width="4%" bgcolor="#CCCCCC" class="style8">شماره ثابت</td>
          <td width="2%" bgcolor="#CCCCCC" class="style8">نام پدر</td>
          <td width="3%" bgcolor="#CCCCCC" class="style8">محل صدور</td>
          <td width="5%" bgcolor="#CCCCCC" class="style8">شماره شناسنامه</td>
          <td width="3%" bgcolor="#CCCCCC" class="style8">تاریخ تولد </td>
          <td width="2%" bgcolor="#CCCCCC" class="style8"> کد ملی<br />
          </td>
          <td width="4%" bgcolor="#CCCCCC" class="style8">جنسیت</td>
          <td width="5%" bgcolor="#CCCCCC" class="style8">نام خانوادگی</td>
          <td width="2%" bgcolor="#CCCCCC" class="style8"> نام </td>
          <td width="3%" bgcolor="#CCCCCC" class="style8">نوع بهره بردار</td>
          <td width="3%" bgcolor="#CCCCCC" class="style8">آدرس آماری آبادی</td>
          <td width="3%" bgcolor="#CCCCCC" class="style8"><p>آدرس آماری شهر</p></td>
          <td width="6%" bgcolor="#CCCCCC" class="style8"> کد شهرستان </td>
          <td width="4%" bgcolor="#CCCCCC" class="style8"> کد استان </td>
          <td width="6%" bordercolor="#0066CC" bgcolor="#CCCCCC" class="style8">نام آبادی</td>
          <td width="6%" bordercolor="#0066CC" bgcolor="#CCCCCC" class="style8">نام شهر</td>
          <td width="6%" bordercolor="#0066CC" bgcolor="#CCCCCC" class="style8">نام شهرستان</td>
          <td width="4%" bordercolor="#0066CC" bgcolor="#CCCCCC" class="style8">نام استان</td>
          <td width="5%" bgcolor="#CCCCCC" class="style8">آخرین ویرایش</td>
          <td width="4%" bgcolor="#CCCCCC" class="style8">ردیف</td>
        </tr>
        <tr>
          <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$mor_cod_m=$row['mor_cod_m'];
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
?>
     <?php 
	 if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;
     if($row['jens'] == '1') $v_jens = 'مرد' ; else $v_jens='زن' ;
?>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $mor_cod_m?></span></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo user_name($mor_cod_m)?></span></td>
          <td align="center" width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo round(($row['mah_tolp']/$row['zer_kesht']),1)*1 ; ?></span></td>
          <td align="center" width="5%" height="30" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><span class="normalTextSmall"><?php echo $row['mah_tolp'] ?></span></span></td>
   <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><span class="normalTextSmall"><?php echo $row['zer_kesht'] ; ?></span></td>
   <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="5%" class="normalTextSmaller"><?php echo $row['no_kesh'];?></td>
   <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="4%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tel_s'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fname'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_sod'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_sh'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_t'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['jens'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['num_bah'] ;?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_abadi'].'&nbsp;';?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $add_city ;?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_city'];?></td>
   <td align="center"  class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_ostan'];?></td>
   <td align="center" bordercolor="#0066CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi'])?></td>
   <td align="center" bordercolor="#0066CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_name($row['add_city'])?></td>
   <td align="center" bordercolor="#0066CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan'])?></td>
   <td align="center" bordercolor="#0066CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan'])?></td>
   <td align="center" class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_s'];?></td>
   <td align="center" class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php
$r++ ; 
}
?>
</table>
      <p align="center">
<p>
