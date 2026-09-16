<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=corn_list.xls");
include('../lock_df.php');
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
      <p align="center"  class="style8">مشخصات بهره برداران کشاورزی تولید کننده گندم</p>
      <?php 
include('../login/config.php');
 $query = "SELECT 
`bah`.`bah_cod_m`,
`bah`.`no_bah`,
`bah`.`name`,
`bah`.`last_name`,
`bah`.`fname`,
`bah`.`co_name`,
`bah`.`sh_meli`
FROM `bah` 
inner join Agri_prod ON 
`bah`.`bah_cod_m` = `Agri_prod`.`bah_cod_m`  and `bah`.`num_bah` = `Agri_prod`.`num_bah`
WHERE `Agri_prod`.z_sal = '1396-1397' and `Agri_prod`.cod_mah = '102'  "; 
$stmt= $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="98%" height="90" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor='#0066CC'>
        <tr align="center" class="text1">
          <td width="2%" bgcolor="#CCCCCC" class="style8">نام پدر</td>
          <td width="2%" bgcolor="#CCCCCC" class="style8">کد ملی</td>
          <td width="5%" bgcolor="#CCCCCC" class="style8">نام خانوادگی</td>
          <td width="2%" bgcolor="#CCCCCC" class="style8"> نام </td>
          <td width="3%" bgcolor="#CCCCCC" class="style8"> شناسه ملی </td>
          <td width="3%" bgcolor="#CCCCCC" class="style8">نام شرکت</td>
          <td width="3%" bgcolor="#CCCCCC" class="style8">نوع بهره بردار</td>
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
          <td height="30" align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fname'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_meli'] ;?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['co_name'];?></td>
   <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah'] ;?></td>
   <td align="center" class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php
$r++ ; 
}
?>
</table>
      <p align="center">
<p>
