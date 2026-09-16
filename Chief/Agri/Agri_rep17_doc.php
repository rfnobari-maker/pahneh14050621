<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=زراعی.doc");
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
 $z_sal = $_POST['z_sal'] ;
 $zka1 = $_POST['zka1'] ;
 $zka2 = $_POST['zka2'] ;
 $zkb1 = $_POST['zkb1'] ;
 $zkb2 = $_POST['zkb2'] ;
 $mtol1 = $_POST['mtol1'] ;
 $mtol2 = $_POST['mtol2'] ;
 $sba1 = $_POST['sba1'] ;
 $sba2 = $_POST['sba2'] ;
 $sbb1 = $_POST['sbb1'] ;
 $sbb2 = $_POST['sbb2'] ;
 $mtol1 = $_POST['mtol1'] ;
 $mtol2 = $_POST['mtol2'] ;
 $mtolp1 = $_POST['mtolp1'] ;
 $mtolp2 = $_POST['mtolp2'] ;

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
      <p align="center"  class="style8">گزارش اختصاصی اطلاعات زراعی 
        <?php
 if ($id_ostan1 == '-1')    { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 'id = id'  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($no_kesh == '0')  { $f_no_kesh  = 'id = id'  ; }else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 'id = id'  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 'id = id'  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')  { $v_z_sal  = 'id = id'  ; }else{ $v_z_sal = "z_sal = '$z_sal'" ;}
 if ($mah_name == '')  { $v_cod_mah  = 'id = id'  ; }else{ $v_cod_mah = "cod_mah = '$mah_name'" ;}
 if ($zka1 == '')  { $v_zka1  = 1  ; }else{ $v_zka1 = "zer_kesht_a >= '$zka1'" ;}
 if ($zka2 == '')  { $v_zka2  = 1  ; }else{ $v_zka2 = "zer_kesht_a <= '$zka2'" ;}
 if ($zkb1 == '')  { $v_zkb1  = 1  ; }else{ $v_zkb1 = "zer_kesht_b >= '$zkb1'" ;}
 if ($zkb2 == '')  { $v_zkb2  = 1  ; }else{ $v_zkb2 = "zer_kesht_b <=  $zkb2'" ;}
 if ($sba1 == '')  { $v_sba1  = 1  ; }else{ $v_sba1 = "s_bar_a >= '$sba1'" ;}
 if ($sba2 == '')  { $v_sba2  = 1  ; }else{ $v_sba2 = "s_bar_a <= '$sba2'" ;}
 if ($sbb1 == '')  { $v_sbb1  = 1  ; }else{ $v_sbb1 = "s_bar_b >= '$sbb1'" ;}
 if ($sbb2 == '')  { $v_sbb2  = 1  ; }else{ $v_sbb2 = "s_bar_b <= '$sbb2'" ;}
 if ($mtol1 == '')  { $v_mtol1  = 1  ; }else{ $v_mtol1 = "mah_tol >= '$mtol1'" ;}
 if ($mtol2 == '')  { $v_mtol2  = 1  ; }else{ $v_mtol2 = "mah_tol <= '$mtol2'" ;}
 if ($mtolp1 == '')  { $v_mtolp1  = 1  ; }else{ $v_mtolp1 = "mah_tolp >= '$mtolp1'" ;}
 if ($mtolp2 == '')  { $v_mtolp2  = 1  ; }else{ $v_mtolp2 = "mah_tolp <= '$mtolp2'" ;}
 include_once('../../login/config.php');
  $query = "SELECT bah_cod_m,zer_kesht_a,zer_kesht_b,s_bar_a,s_bar_b,mah_tolp,mah_tol,cod_mah,mor_cod_m,Agri_id,id_ostan,id_city from Agri_prod where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah and $v_sba1 and $v_sba2 and $v_sbb1 and $v_sbb2 and $v_zka1 and $v_zka2 and $v_zkb1 and $v_zkb2 and $v_mtolp1 and $v_mtolp2 and $v_mtol1 and $v_mtol2 ORDER BY bah_cod_m ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <br />
      </p>
      <table width="85%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#0099FF">
        <tr class="style8">
          <td width="5%" align="center" bgcolor="#CCCCCC">همراه مروج</td>
          <td width="5%" align="center" bgcolor="#CCCCCC"> کد ملی مروج</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">نام مروج</td>
          <td align="center" bgcolor="#CCCCCC">میزان تولید / تن</td>
          <td align="center" bgcolor="#CCCCCC"> پیش بینی تولید /
            تن</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">نام محصول</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">کل سطح برداشت هکتار</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">سطح برداشت کشت مجدد / هکتار</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">سطح برداشت کشت اول/ هکتار</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">کل سطح زیر کشت /هکتار</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">سطح زیر کشت مجدد / هکتار</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">سطح زیر کشت اول / هکتار</td>
          <td align="center" width="6%" bgcolor="#CCCCCC"><span class="style8"> کد ملی بهره بردار</span></td>
          <td align="center" width="7%" bgcolor="#CCCCCC">نام و نام خانوادگی بهره بردار</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">شهرستان</td>
          <td align="center" width="8%" bgcolor="#CCCCCC">استان</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
  ?>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name1($row['mor_cod_m']) ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],3)*1 ; ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],3)*1 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']+$row['s_bar_b'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_b']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a'] + $row['zer_kesht_b'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_b']+0  ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a']+0 ; ?></td>
          <td align="center" height="33" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
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


