<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گلخانه.xls");
include('../../lock_p1.php');
include('../../event.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
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
<style type="text/css">
#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
</style>
</head>
<body>
      <p align="center"  class="style8">گزارش محصولات گلخانه
        <?php
 include_once('../../login/config.php');
 $query = " SELECT  `Greenhous_prod`.`id_ostan` ,  `Greenhous_prod`.`id_city` ,  sum(`Greenhous_prod`.`no_mtol1_1`) as tol  sum(`Greenhousn`.`m_zamin_gol`) as zamin_gol
FROM `Greenhous_prod` 
inner join Greenhousn ON Greenhousn.id = Greenhous_prod.unit_id

WHERE `Greenhous_prod`.`y_prod`='1400' and  `Greenhous_prod`.`no_mtol1_1` > 0  and 
`Greenhous_prod`.`no_mtol1_2` = 0  and 
`Greenhous_prod`.`no_mtol1_3` = 0  and 
`Greenhous_prod`.`no_mtol1_4` = 0  and 
`Greenhous_prod`.`no_mtol1_5` = 0  and 
`Greenhous_prod`.`no_mtol1_6` = 0  and 

`Greenhous_prod`.`no_mtol2_1` = 0 and 
`Greenhous_prod`.`no_mtol2_2` = 0 and 
`Greenhous_prod`.`no_mtol2_3` = 0 and 
`Greenhous_prod`.`no_mtol2_4` = 0 and 

`Greenhous_prod`.`no_mtol4_1` = 0 and 
`Greenhous_prod`.`no_mtol4_2` = 0 and 
`Greenhous_prod`.`no_mtol4_3` = 0 and 
`Greenhous_prod`.`no_mtol4_4` = 0 and 

`Greenhous_prod`.`no_mtol3_1` = 0 and  
`Greenhous_prod`.`no_mtol3_2` = 0 and  
`Greenhous_prod`.`no_mtol3_3` = 0 and  
`Greenhous_prod`.`no_mtol3_4` = 0 
group by `id_ostan`,`id_city` "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <br />
      </p>
      <table width="85%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#0099FF">
        <tr class="style8">
          <td width="2%" align="center" bgcolor="#CCCCCC">عملکرد</td>
          <td width="10%" align="center" bgcolor="#CCCCCC">میزان تولید کل </td>
          <td width="6%" align="center" bgcolor="#CCCCCC">میزان تولید - تک محصول</td>
          <td width="11%" align="center" bgcolor="#CCCCCC">سطح زیر کشت تک محصولی </td>
          <td align="center" width="12%" bgcolor="#CCCCCC">واحد</td>
          <td align="center" width="13%" bgcolor="#CCCCCC">نام محصول </td>
          <td align="center" width="14%" bgcolor="#CCCCCC">شهرستان</td>
          <td align="center" width="13%" bgcolor="#CCCCCC">استان</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
  ?>
          <td height="33" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tol'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zamin_gol'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>تن</td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>خیار</td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
    </table>
   <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }
?>   
</body>
</html>


