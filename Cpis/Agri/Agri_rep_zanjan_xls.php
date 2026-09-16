<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_ویژه_زراعی.xls");
include('../../lock_cp.php');
include('../../event.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
      <p align="center"  class="style8">گزارش اختصاصی اطلاعات زراعی 
        <?php
 include_once('../../login/config.php');
  $query = "SELECT 
Agri_prod1398_1399.bah_cod_m,Agri_prod1398_1399.no_kesh,Agri_prod1398_1399.cod_mah
,sum(Agri_prod1398_1399.zer_kesht_a) as zer_kesht_a
,sum(Agri_prod1398_1399.zer_kesht_b) as zer_kesht_b
,sum(Agri_prod1398_1399.mah_tol) as mah_tol
,Agri_prod1398_1399.mah_bem FROM Agri_prod1398_1399 
inner join zanjan_bah on zanjan_bah.bah_cod_m = Agri_prod1398_1399.bah_cod_m
WHERE Agri_prod1398_1399.id_ostan='19'  and Agri_prod1398_1399.mah_tol>0 
group by Agri_prod1398_1399.no_kesh , Agri_prod1398_1399.cod_mah ,Agri_prod1398_1399.bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <br />
      </p>
      <table width="85%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#0099FF">
        <tr class="style8">
          <td align="center" width="10%" bgcolor="#CCCCCC">بیمه</td>
          <td align="center" width="10%" bgcolor="#CCCCCC">میزان تولید / تن</td>
          <td align="center" width="12%" bgcolor="#CCCCCC">نام محصول</td>
          <td align="center" width="11%" bgcolor="#CCCCCC">سطح زیر کشت مجدد / هکتار</td>
          <td align="center" width="11%" bgcolor="#CCCCCC">سطح زیر کشت اول / هکتار</td>
          <td align="center" width="11%" bgcolor="#CCCCCC">نوع کشت</td>
          <td align="center" width="10%" bgcolor="#CCCCCC"><span class="style8"> کد ملی بهره بردار</span></td>
          <td align="center" width="19%" bgcolor="#CCCCCC">نام و نام خانوادگی بهره بردار</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['no_kesh']=='1' ) $v_no_kesh= 'آبی' ; 
if ($row['no_kesh']=='2' ) $v_no_kesh= 'دیم' ; 
if ($row['mah_bem']=='1' ) $v_mah_bem= 'هست' ; 
if ($row['mah_bem']=='2' ) $v_mah_bem= 'نیست' ; 

$add_abadi = '"'.$row['add_abadi'].'"' ; 
$add_city = '"'.$row['add_city'].'"' ; 


$m_cod_m = $row['m_cod_m'] ; 
  ?>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_mah_bem ; ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],3)*1 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_b']+0  ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh ?></td>
          <td align="center" height="33" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
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


