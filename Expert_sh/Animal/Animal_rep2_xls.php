<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=آمار_دام_گونه.xls");
include('../../lock_expsh.php');
include('../../event.php');
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if(isset($_POST['sal'])) $sal = $_POST['sal'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
  <?php if((isset($_POST['sal'])))
{
	include_once('../../login/config.php');
$sal = $_POST['sal'];
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if ($id_ostan1 == '') 
{
 $query = "SELECT 
    SUM(CASE WHEN an.species = '1' THEN an.quantity ELSE 0 END) AS kol_1,
    SUM(CASE WHEN an.species = '2' THEN an.quantity ELSE 0 END) AS kol_2,
    SUM(CASE WHEN an.species = '3' THEN an.quantity ELSE 0 END) AS kol_3,
    SUM(CASE WHEN an.species = '4' THEN an.quantity ELSE 0 END) AS kol_4,
    SUM(CASE WHEN an.species = '5' THEN an.quantity ELSE 0 END) AS kol_5,
    SUM(CASE WHEN an.species = '6' THEN an.quantity ELSE 0 END) AS kol_6,
    SUM(CASE WHEN an.species = '7' THEN an.quantity ELSE 0 END) AS kol_7,
    SUM(CASE WHEN an.species = '8' THEN an.quantity ELSE 0 END) AS kol_8,
    SUM(CASE WHEN an.species = '9' THEN an.quantity ELSE 0 END) AS kol_9,
au.id_ostan
FROM 
    animals_unit au
INNER JOIN 
    animals an 
ON 
    au.PartIdCode = an.PartIdCode
WHERE 
    an.sal = '$sal'
GROUP BY 
    au.id_ostan  ORDER BY  FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21')"  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT 
  au.id_city , au.id_mar , 
    SUM(CASE WHEN an.species = '1' THEN an.quantity ELSE 0 END) AS kol_1,
    SUM(CASE WHEN an.species = '2' THEN an.quantity ELSE 0 END) AS kol_2,
    SUM(CASE WHEN an.species = '3' THEN an.quantity ELSE 0 END) AS kol_3,
    SUM(CASE WHEN an.species = '4' THEN an.quantity ELSE 0 END) AS kol_4,
    SUM(CASE WHEN an.species = '5' THEN an.quantity ELSE 0 END) AS kol_5,
    SUM(CASE WHEN an.species = '6' THEN an.quantity ELSE 0 END) AS kol_6,
    SUM(CASE WHEN an.species = '7' THEN an.quantity ELSE 0 END) AS kol_7,
    SUM(CASE WHEN an.species = '8' THEN an.quantity ELSE 0 END) AS kol_8,
    SUM(CASE WHEN an.species = '9' THEN an.quantity ELSE 0 END) AS kol_9,
au.id_ostan
FROM 
    animals_unit au
INNER JOIN 
    animals an 
ON 
    au.PartIdCode = an.PartIdCode
WHERE 
   sal = '$sal' and id_ostan = '$id_ostan1' and id_city = '$id_city'
group by id_mar "  ;

}
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center">گزارش آمار دام به تفکیک گونه در سال <?php echo $sal?></p>
<table width="99%" height="160" border="1" bordercolor="#00CCFF" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="text1">
    <td width="8%" bordercolor="#0099CC" bgcolor="#999999">سگ</td>
    <td width="8%" bordercolor="#0099CC" bgcolor="#999999">قاطر</td>
    <td width="9%" bordercolor="#0099CC" bgcolor="#999999">استر</td>
    <td width="11%" bordercolor="#0099CC" bgcolor="#999999">اسب</td>
    <td width="10%" height="36" bordercolor="#0099CC" bgcolor="#999999">بز</td>
    <td width="9%" bordercolor="#0099CC" bgcolor="#999999">گوسفند</td>
    <td width="8%" bordercolor="#0099CC" bgcolor="#999999">شتر</td>
    <td width="9%" bordercolor="#0099CC" bgcolor="#999999">گاومیش</td>
    <td width="10%" bordercolor="#0099CC" bgcolor="#999999">گاو</td>
    <td width="15%" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'مرکز جهاد کشاورزی'  ; ?>
      <br /></td>
    <td width="3%" bgcolor="#999999">ردیف</td>
  </tr>
  <tr>
    <?php
$r = 1 ;
  foreach($stmt as $row){
 ?>
    <td height="38" align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_9']?></td>
    <td height="38" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_8']?></td>
    <td height="38" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_7']?></td>
    <td height="38" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_6']?></td>
    <td height="38" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_5']?></td>
    <td height="38" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_4']?></td>
    <td height="38" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_3']?></td>
    <td height="38" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_2']?></td>
    <td height="38" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_1']?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php if($id_ostan1=='') echo ostan_name($row['id_ostan']) ;  else echo mar_name($row['id_mar'])  ; ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
  <?php
$r++ ; 
}
if ($id_ostan1 == '') 
{
 $query = "SELECT 
    SUM(CASE WHEN an.species = '1' THEN an.quantity ELSE 0 END) AS kol_1,
    SUM(CASE WHEN an.species = '2' THEN an.quantity ELSE 0 END) AS kol_2,
    SUM(CASE WHEN an.species = '3' THEN an.quantity ELSE 0 END) AS kol_3,
    SUM(CASE WHEN an.species = '4' THEN an.quantity ELSE 0 END) AS kol_4,
    SUM(CASE WHEN an.species = '5' THEN an.quantity ELSE 0 END) AS kol_5,
    SUM(CASE WHEN an.species = '6' THEN an.quantity ELSE 0 END) AS kol_6,
    SUM(CASE WHEN an.species = '7' THEN an.quantity ELSE 0 END) AS kol_7,
    SUM(CASE WHEN an.species = '8' THEN an.quantity ELSE 0 END) AS kol_8,
    SUM(CASE WHEN an.species = '9' THEN an.quantity ELSE 0 END) AS kol_9,
au.id_ostan
FROM 
    animals_unit au
INNER JOIN 
    animals an 
ON 
    au.PartIdCode = an.PartIdCode
WHERE 
    an.sal = '$sal' "  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT 
    SUM(CASE WHEN an.species = '1' THEN an.quantity ELSE 0 END) AS kol_1,
    SUM(CASE WHEN an.species = '2' THEN an.quantity ELSE 0 END) AS kol_2,
    SUM(CASE WHEN an.species = '3' THEN an.quantity ELSE 0 END) AS kol_3,
    SUM(CASE WHEN an.species = '4' THEN an.quantity ELSE 0 END) AS kol_4,
    SUM(CASE WHEN an.species = '5' THEN an.quantity ELSE 0 END) AS kol_5,
    SUM(CASE WHEN an.species = '6' THEN an.quantity ELSE 0 END) AS kol_6,
    SUM(CASE WHEN an.species = '7' THEN an.quantity ELSE 0 END) AS kol_7,
    SUM(CASE WHEN an.species = '8' THEN an.quantity ELSE 0 END) AS kol_8,
    SUM(CASE WHEN an.species = '9' THEN an.quantity ELSE 0 END) AS kol_9,
au.id_ostan
FROM 
    animals_unit au
INNER JOIN 
    animals an 
ON 
    au.PartIdCode = an.PartIdCode
WHERE 
    an.sal = '$sal' and id_ostan = '$id_ostan1' and id_city = '$id_city'  "  ;
}
?>
  <tr align="center" class="text1">
    <td bordercolor="#0099CC" bgcolor="#999999">سگ</td>
    <td bordercolor="#0099CC" bgcolor="#999999">قاطر</td>
    <td bordercolor="#0099CC" bgcolor="#999999">استر</td>
    <td bordercolor="#0099CC" bgcolor="#999999">اسب</td>
    <td height="33" bordercolor="#0099CC" bgcolor="#999999">بز</td>
    <td bordercolor="#0099CC" bgcolor="#999999">گوسفند</td>
    <td bordercolor="#0099CC" bgcolor="#999999">شتر</td>
    <td bordercolor="#0099CC" bgcolor="#999999">گاومیش</td>
    <td bordercolor="#0099CC" bgcolor="#999999">گاو</td>
    <td colspan="2" bgcolor="#999999">&nbsp;</td>
  </tr>
  <?php
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
  <tr>
    <td height="40" align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_9']?></td>
    <td height="40" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_8']?></td>
    <td height="40" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_7']?></td>
    <td height="40" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_6']?></td>
    <td height="40" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_5']?></td>
    <td height="40" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_4']?></td>
    <td height="40" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_3']?></td>
    <td height="40" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_2']?></td>
    <td height="40" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_1']?></td>
    <td colspan="2" align="center"  <?php  echo 'bgcolor=#ffcc99' ?>>مجموع کل شهرستان</td>
  </tr>
</table>
<?php }?>
</body>
</html>