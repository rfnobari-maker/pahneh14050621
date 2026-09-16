<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=corn_list.xls");
include('../lock_cp.php');
include('../event.php') ;
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
      <p align="center"  class="style8">مشخصات بهره برداران کشاورزی تولید کننده ذرت دانه ای در سال زراعی 1396-1395 </p>

      <?php 
include_once('../login/config.php');
 $query = "SELECT bah.date_s,bah.id_ostan , bah.id_city , bah.id_mar , bah.add_abadi , bah.add_city , bah.mor_cod_m , bah.bah_cod_m , bah.no_bah , bah.jens , bah.name , bah.last_name , bah.date_t , bah.sh_sh , bah.m_sod , bah.fname , bah.tel_s , bah.tel_m ,bah.bank_account
FROM bah
INNER JOIN Agri_prod ON bah.bah_cod_m = Agri_prod.bah_cod_m
AND bah.no_bah = Agri_prod.num_bah
AND Agri_prod.cod_mah = '108'
AND Agri_prod.z_sal = '1395-1396' "; 
$stmt= $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="98%" height="90" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor='#0066CC'>
        <tr align="center" class="text1">
          <td  bgcolor="#CCCCCC"><p class="style8">کد ملی کارشناس</p></td>
          <td width="5%" bgcolor="#CCCCCC" class="style8">نام کارشناس</td>
          <td bgcolor="#CCCCCC" class="style8">شماره حساب بانک کشاورزی</td>
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
          <td width="5%" bgcolor="#CCCCCC" class="style8">نوع بهره بردار</td>
          <td width="5%" bgcolor="#CCCCCC" class="style8">آدرس آماری آبادی</td>
          <td width="6%" bgcolor="#CCCCCC" class="style8"><p>آدرس آماری شهر</p></td>
          <td width="6%" bgcolor="#CCCCCC" class="style8"> کد شهرستان </td>
          <td width="6%" bgcolor="#CCCCCC" class="style8"> کد استان </td>
          <td width="6%" bordercolor="#0066CC" bgcolor="#CCCCCC" class="style8">نام شهرستان</td>
          <td width="6%" bordercolor="#0066CC" bgcolor="#CCCCCC" class="style8">نام استان</td>
          <td width="7%" bgcolor="#CCCCCC" class="style8">آخرین ویرایش</td>
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
          <td align="center" width="5%" height="30" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $mor_cod_m?></span></td>
   <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo user_name($mor_cod_m)?></td>
   <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="5%" class="normalTextSmaller"><?php echo $row['bank_account'];?></td>
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
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah'] ;?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_abadi'].'&nbsp;';?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_shahr'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_city'];?></td>
   <td align="center"  class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_ostan'];?></td>
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
