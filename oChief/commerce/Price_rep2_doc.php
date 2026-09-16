<?php 
header("Content-type: application/vnd.ms-world;charset=UTF-8");
header("Content-Disposition: attachment;Filename=میانگین_قیمت_اقلام.doc");
include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $s_date = $_POST['s_date'] ; 
 $year = $_POST['year'] ;
 $mont = $_POST['mont'] ;
 $p_cod = $_POST['p_cod'] ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
        <?php
 if (isset($_POST['year'])) 
 {  
 if ($id_ostan1 == '-1') {$v_id_ostan   = 1 ;}else{ $v_id_ostan = "price_record.id_ostan='$id_ostan1'" ;}
 if ($s_date  == 0)      {$v_s_date     = 1 ;}else{ $v_s_date = "price_record.s_date='$s_date'" ;}
 if ($p_cod == '0')       {$v_p_cod      = 1 ;}else{ $v_p_cod = "price_record.p_cod = '$p_cod'" ;}
 include('../../login/config.php');
$start=0;
 $query = "SELECT price_record.id_ostan,price_record.p_cod, count(*) as count,round(avg(p_price),0) as avg,price_pro_list.p_name,price_pro_list.p_unit
FROM price_record 
inner join price_pro_list ON price_pro_list.p_cod = price_record.p_cod
 where year = $year and mont = $mont and $v_id_ostan  and  $v_s_date  and $v_p_cod  group by price_record.p_cod  ORDER BY id_ostan,p_cod  ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
    </p>
    <table width="100%" border="1" align="center" cellpadding="1" cellspacing="1"  bordercolor="#0099CC">
      <tr class="text1">
        <td align="center" colspan="2" bgcolor="#999999">بالاترین  قیمت </td>
        <td align="center" height="39" colspan="2" bgcolor="#999999"> پایین ترین قیمت</td>
        <td align="center" width="13%" rowspan="2" bgcolor="#999999">میانگین قیمت
        ریال</td>
        <td align="center" width="6%" rowspan="2" bgcolor="#999999">تعداد  رکورد</td>
        <td align="center" width="8%" rowspan="2" bgcolor="#999999">واحد</td>
        <td align="center" width="18%" rowspan="2" bgcolor="#999999">نام محصول</td>
        <td align="center" width="13%" rowspan="2" bgcolor="#999999"> استان</td>
        <td align="center" width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
      </tr>
      <tr class="text1">
        <td align="center" width="9%" height="31" bgcolor="#999999">قیمت ریال </td>
        <td align="center" width="10%" bgcolor="#999999">نام شهرستان </td>
        <td align="center" bgcolor="#999999">قیمت ریال </td>
        <td align="center" bgcolor="#999999">نام شهرستان</td>
      </tr>
      <tr>
        <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
$id_ostan = $row['id_ostan'] ; 
$id_city_1 = $row['id_city'] ; 
$p_cod_1 = $row['p_cod'] ; 
$p_price_min = min_price($id_ostan,$p_cod_1,$year,$mont,$v_s_date) ; 
$p_price_max = max_price($id_ostan,$p_cod_1,$year,$mont,$v_s_date) ; 
$max_city	=  price_city($id_ostan,$p_cod_1,$year,$mont,$v_s_date,$p_price_max) ;
$min_city	=  price_city($id_ostan,$p_cod_1,$year,$mont,$v_s_date,$p_price_min) ;
  ?>
        <td align="center" height="27" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo 
		 $p_price_max ; 
		  ?></td>
        <td align="center" height="27" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($max_city,$id_ostan) ?></td>
        <td align="center" width="9%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo 
		  $p_price_min ; 
		  ?></td>
        <td align="center" width="10%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($min_city,$id_ostan) ?></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['avg'] ; ?></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['count'] ; ?></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"  dir="rtl"><?php echo $row['p_unit']?></div></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo $row['p_name']?></div></td>
        <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo ostan_name($id_ostan)?></div></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
      </tr>
      <?php 
	$r++ ; 
	}
	?>
    </table>
    <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
?>
</body>
</html>
<?php

function min_price($id_ostan,$p_cod,$year,$mont,$v_s_date)
{
include ('../../login/config.php') ;
 $query = "SELECT MIN( p_price ) AS min, id_city
FROM price_record
WHERE year ='$year'
AND mont ='$mont'
AND id_ostan = '$id_ostan'
AND p_cod = '$p_cod' 
AND $v_s_date";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['min'] ;
$dbh = null;
}

function max_price($id_ostan,$p_cod,$year,$mont,$v_s_date)
{
include ('../../login/config.php') ;
 $query = "SELECT max( p_price ) AS max, id_city
FROM price_record
WHERE year ='$year'
AND mont ='$mont'
AND id_ostan = '$id_ostan'
AND p_cod = '$p_cod' 
AND $v_s_date";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['max'] ;
$dbh = null;
}
function price_city($id_ostan,$p_cod,$year,$mont,$v_s_date,$p_price)
{
include ('../../login/config.php') ;
 $query = "SELECT  id_city
FROM price_record
WHERE year ='$year'
AND mont ='$mont'
AND id_ostan = '$id_ostan'
AND p_cod = '$p_cod' 
AND $v_s_date and p_price = $p_price";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['id_city'] ;
$dbh = null;
}

?>