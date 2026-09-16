<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=corn_prod.xls");
include('../../lock_ce.php');
include('../../event.php');
// کد گروه و کد محصول
// $mah_qroup = $_POST['mah_qroup'] ;
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
      <p align="center"  class="style8">گزارش لیست بهره برداران تولید کننده ذرت دانه ای در سال زراعی 1396-1395
        <?php
 include('../../login/config.php');
  $query = "SELECT date_s,mor_cod_m,id_ostan,id_city,id_mar,add_abadi,add_city,bah_cod_m,num_bah,zer_kesht_a,zer_kesht_b,mah_tolp FROM Agri_prod WHERE z_sal ='1395-1396' and cod_mah = '108' and cod_qroup = '1' limit 0,1 "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
       <br/>
      </p>
<table width="85%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="style8">
          <td align="center" width="10%" bgcolor="#CCCCCC"> پیش بینی  /
          تن</td>
          <td align="center" width="10%" bgcolor="#CCCCCC">سطح زیر کشت دوم / هکتار
</td>
          <td align="center" width="11%" bgcolor="#CCCCCC">سطح زیر کشت 
          اول  / هکتار
</td>
          <td align="center" width="9%" bgcolor="#CCCCCC"><span class="style8"> کد ملی بهره بردار</span></td>
          <td width="10%" align="center" bgcolor="#CCCCCC">نوع بهره بردار</td>
          <td width="8%" align="center" bgcolor="#CCCCCC">آدرس آماری آبادی</td>
          <td width="8%" align="center" bgcolor="#CCCCCC"><p>آدرس آماری شهر</p></td>
          <td width="8%" align="center" bgcolor="#CCCCCC"> کد شهرستان </td>
          <td width="10%" align="center" bgcolor="#CCCCCC"> کد استان </td>
          <td align="center" width="8%" bgcolor="#CCCCCC">آخرین ویرایش</td>
          <td align="center" width="8%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
  ?>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tolp'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_b']/10000 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a']/10000 ; ?></td>
          <td height="29" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah'] ;?></td>
          <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_abadi'].'&nbsp;';?></td>
          <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_shahr'];?></td>
          <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_city'];?></td>
          <td align="center" class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_ostan'];?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['date_s'];?></span></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
        </table>
        <p align="center" class="style8">&nbsp;</p>
   <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }
?>   
</body>
</html>


