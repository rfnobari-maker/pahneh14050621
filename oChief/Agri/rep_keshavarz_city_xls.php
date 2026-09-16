<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=rep_keshavarz_city.xls");
include('../../lock_oce.php');
$id_ostan = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
$add_bakh = $_POST['add_bakh'] ; 
$add_city = $_POST['add_city'] ; 
$z_sal = $_POST['z_sal'] ;
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
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
width:50px
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
    <?php 
include ('../../login/config.php');
?>
  </p>
<?php 
if ($id_ostan == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "$Agri_prod_table.id_ostan='$id_ostan'" ;}
if ($id_city == 0 )    { $v_id_city  = 1 ;} else { $v_id_city  = "$Agri_prod_table.id_city='$id_city'"   ;}
if ($add_bakh == 0)    { $v_add_bakh = 1 ;} else { $v_add_bakh = "list_city.add_bakh='$add_bakh'" ;}
if ($add_city == 0)     { $v_add_city  = 1 ;} else { $v_add_city  = "list_city.add_city='$add_city'"   ;}
 $query = "SELECT 
$Agri_prod_table.id_ostan,
$Agri_prod_table.id_city,
list_city.add_bakh,
list_city.add_city,
list_city.ostan,
list_city.city,
list_city.bakh,
list_city.shahr,
list_city.mar ,
$Agri_prod_table.cod_mah,
product_z.product_name,
(SUM( $Agri_prod_table.zer_kesht_a ) + SUM( $Agri_prod_table.zer_kesht_b)) AS z_kesht,
SUM( $Agri_prod_table.mah_tolp ) AS mah_tolp,
(SUM( $Agri_prod_table.s_bar_a ) + SUM( $Agri_prod_table.s_bar_b )) AS s_bar,
SUM( $Agri_prod_table.mah_tol ) AS mah_tol
FROM $Agri_prod_table
INNER JOIN list_city ON $Agri_prod_table.add_city=list_city.add_city
INNER JOIN product_z  ON product_z.product_cod = $Agri_prod_table.cod_mah
where 
$Agri_prod_table.cod_mah != ''
AND $v_id_ostan  AND $v_id_city  AND $v_add_bakh  AND $v_add_city 
GROUP BY $Agri_prod_table.cod_mah , $Agri_prod_table.add_city
ORDER BY id_ostan,id_city,add_city "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  
<table width="90%" height="90" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="text1">
    <td width="9%" height="50" bgcolor="#999999">تولید قطعی</td>
    <td width="9%" height="50" bgcolor="#999999"><p>سطح برداشت</p></td>
    <td width="9%" bgcolor="#999999">پیش بینی تولید </td>
    <td width="9%" bgcolor="#999999">سطح زیر کشت</td>
    <td width="8%" bgcolor="#999999">نام محصول</td>
    <td width="7%" bgcolor="#999999">نام شهر </td>
    <td width="7%" bgcolor="#999999">مرکز</td>
    <td width="7%" bgcolor="#999999">بخش</td>
    <td width="8%" bgcolor="#999999">شهرستان</td>
    <td width="7%" bgcolor="#999999">استان</td>
    <td width="4%" bgcolor="#999999">کد محصول </td>
    <td width="4%" bgcolor="#999999">آدرس شهر</td>
    <td width="4%" bgcolor="#999999">آدرس بخش</td>
    <td width="5%" bgcolor="#999999">کد شهرستان</td>
    <td width="6%" bgcolor="#999999">کد استان</td>
    <td width="4%" bgcolor="#999999">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
<td align="center" height="40" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tol'];?></td>
 <td align="center" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar'];?></td>
 <td align="center" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tolp'];?></td>
 <td align="center" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_kesht'];?></td>
 <td align="center" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['product_name'];?></td>
 <td align="center" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['shahr'];?></td>
 <td align="center" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mar'];?></td>
 <td align="center" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bakh'];?></td>
 <td align="center" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'];?></td>
 <td align="center" class="normalTextSmaller"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan'];?></td>
 <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_mah'];?></td>
 <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_city'];?></td>
 <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_bakh'];?></td>
 <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo '&nbsp;'.$row['id_city'];?></td>
 <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo '&nbsp;'.$row['id_ostan'];?></td>
 <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
<p align="center">--------------------- پایان گزارش ---------------------</p>
</body>
</html>