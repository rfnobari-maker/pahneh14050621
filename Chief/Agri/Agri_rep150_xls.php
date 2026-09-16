<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=زراعی.xls");
include('../../lock_ce.php');
include('../../event.php');
include('counter15.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $no_kesh = $_POST['no_kesh'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $z_sal = $_POST['z_sal'] ;
// کد گروه و کد محصول
// $mah_qroup = $_POST['mah_qroup'] ;
 $mah_name = $_POST['mah_name'] ;
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
      <p align="center"  class="style8">گزارش اطلاعات زراعی به تفکیک محصول / بهره بردار
        <?php
 if ($id_ostan1 == '-1')    { $v_id_ostan  = 1 ;}else{ $v_id_ostan  = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)         { $v_id_city   = 1 ;}else{ $v_id_city   = "id_city='$id_city'" ;}
 if ($id_mar  == 0)         { $v_id_mar    = 1 ;}else{ $v_id_mar    = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')    { $f_add_abadi = 1 ;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')     { $f_add_city  = 1 ;}else{ $f_add_city  = "add_city = '$add_city'" ;}
 if ($no_kesh == '0')       { $f_no_kesh   = 1 ;}else{ $f_no_kesh   = "no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')      { $v_mor_cod_m = 1 ;}else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')      { $v_bah_cod_m = 1 ;}else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')          { $v_z_sal     = 1 ;}else{ $v_z_sal     = "z_sal = '$z_sal'" ;}
 if ($mah_name == '')       { $v_cod_mah   = 1 ;}else{ $v_cod_mah   = "cod_mah = '$mah_name'" ;}

 include_once('../../login/config.php');
  $query = "select 
bah.name,bah.last_name , 
Agri.bah_cod_m,
count(Agri.id) as gat ,
sum(Agri_prod.zer_kesht_a + Agri_prod.zer_kesht_b) as zer_kesht ,
sum(Agri_prod.s_bar_a + Agri_prod.s_bar_b) as s_bar ,
sum(Agri_prod.mah_tolp) as mah_tolp ,
sum(Agri_prod.mah_tol) as mah_tol 
from (select id,num_bah,z_sal,bah_cod_m from Agri where 
$v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal 
 group by bah_cod_m)Agri
inner join bah ON bah.bah_cod_m = Agri.bah_cod_m and bah.num_bah = Agri.num_bah
inner join ( select zer_kesht_a,zer_kesht_b,s_bar_a,s_bar_b,mah_tolp,mah_tol,z_sal,bah_cod_m from Agri_prod where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah )
Agri_prod ON Agri_prod.bah_cod_m = Agri.bah_cod_m  and Agri.z_sal = Agri_prod.z_sal
group by Agri.bah_cod_m 
ORDER BY Agri.bah_cod_m ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
      </p>
      <table width="85%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="style8">
          <td align="center" width="11%" bgcolor="#CCCCCC">میزان محصول قطعی / تن</td>
          <td align="center" width="14%" bgcolor="#CCCCCC"> میزان محصول پیش بینی  / 
          تن</td>
          <td align="center" width="14%" bgcolor="#CCCCCC">سطح برداشت /هکتار</td>
          <td align="center" width="14%" bgcolor="#CCCCCC">سطح زیر کشت هکتار </td>
          <td align="center" width="14%" bgcolor="#CCCCCC"> تعداد            قطعه<br /></td>
          <td align="center" width="13%" bgcolor="#CCCCCC"><span class="style8"> کد ملی بهره بردار</span></td>
          <td align="center" width="7%" bgcolor="#CCCCCC">نام</td>
          <td align="center" width="8%" bgcolor="#CCCCCC">نام خانوادگی</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
  ?>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tol'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tolp'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['gat'] ?></td>
          <td height="37" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'] ?></td>
          <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'] ?></td>
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


