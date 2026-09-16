<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=صیفی.xls");
include('../../lock_ce.php');
include('../../event.php');
include('counter15.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city   = $_POST['id_city'] ;
 $id_mar    = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city  = $_POST['add_city'] ;
 $ra_kesh   = $_POST['ra_kesh'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $z_sal     = $_POST['z_sal'] ;
 $b_time    = $_POST['b_time'] ;
 $zka1      = $_POST['zka1'] ;
 $zka2      = $_POST['zka2'] ;
 $sba1      = $_POST['sba1'] ;
 $sba2      = $_POST['sba2'] ;
 $mtol1     = $_POST['mtol1'] ;
 $mtol2     = $_POST['mtol2'] ;
 $mtolp1    = $_POST['mtolp1'] ;
 $mtolp2    = $_POST['mtolp2'] ;
 $ragham    = $_POST['ragham'] ; 
 $no_ab     = $_POST['no_ab'] ; 
 $dah_bazar = $_POST['dah_bazar'] ; 
 $mah_bazar = $_POST['mah_bazar'] ; 
 $mah_name  = $_POST['mah_name'] ;
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
      <p align="center"  class="style8">گزارش اختصاصی محصولات صیفی
        <?php
 if ($id_ostan1 == '-1') { $v_id_ostan  = 1   ;}else{$v_id_ostan  = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      { $v_id_city   = 1   ;}else{$v_id_city   = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      { $v_id_mar    = 1   ;}else{$v_id_mar    = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') { $f_add_abadi = 1   ;}else{$f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1   ;}else{$f_add_city  = "add_city = '$add_city'" ;}
 if ($ra_kesh == '')     { $v_ra_kesh    = 1   ;}else{$v_ra_kesh   = "ra_kesh = '$ra_kesh'" ;}
 if ($mor_cod_m == '')   { $v_mor_cod_m = 1   ;}else{$v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')   { $v_bah_cod_m = 1   ;}else{$v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')       { $v_z_sal     = 1   ;}else{$v_z_sal     = "z_sal = '$z_sal'" ;}
 if ($b_time == '')        { $f_b_time=   1 ;}else{ $f_b_time   = "b_time = '$b_time'"       ;}
 if ($mah_name == '')    { $v_cod_mah   = 1   ;}else{$v_cod_mah   = "cod_mah = '$mah_name'" ;}
 if ($zka1 == '')        { $v_zka1  = 1       ;}else{$v_zka1      = "zer_kesht >= '$zka1'" ;}
 if ($zka2 == '')        { $v_zka2  = 1       ;}else{$v_zka2      = "zer_kesht <= '$zka2'" ;}
 if ($sba1 == '')        { $v_sba1  = 1       ;}else{$v_sba1      = "s_bar >= '$sba1'" ;}
 if ($sba2 == '')        { $v_sba2  = 1       ;}else{$v_sba2      = "s_bar <= '$sba2'" ;}
 if ($mtol1 == '')       { $v_mtol1  = 1      ;}else{$v_mtol1     = "mah_tol >= $mtol1" ;}
 if ($mtol2 == '')       { $v_mtol2  = 1      ;}else{$v_mtol2     = "mah_tol <= $mtol2" ;}
 if ($mtolp1 == '')      { $v_mtolp1  = 1     ;}else{$v_mtolp1    = "mah_tolp >= $mtolp1" ;}
 if ($mtolp2 == '')      { $v_mtolp2  = 1     ;}else{$v_mtolp2    = "mah_tolp <= $mtolp2" ;}
 if ($ragham == '')      { $v_ragham  = 1     ;}else{$v_ragham    = "ragham = '$ragham'" ;}
 if ($no_ab == '')       { $v_no_ab  = 1     ;}else{$v_no_ab   = "no_ab = '$no_ab'" ;}
 if ($mah_bazar == '')   { $v_mah_bazar  = 1  ;}else{$v_mah_bazar     = "mah_bazar = '$mah_bazar'" ;}
 if ($dah_bazar == '')   { $v_dah_bazar  = 1  ;}else{$v_dah_bazar      = "dah_bazar = '$dah_bazar'" ;}

 include('../../login/config.php');
  $query = "SELECT * from  Vege_prod where  $v_id_ostan  and  $v_id_city  and  $v_id_mar and  $f_add_abadi and 
  $f_add_city and $v_mor_cod_m and $v_bah_cod_m and $v_z_sal  and  $v_cod_mah and $v_sba1 and
  $v_sba2    and  $v_ragham  and $v_no_ab and $v_zka1 and $v_zka2 and $v_mah_bazar and $v_dah_bazar and
  $v_mtolp1 and  $v_mtolp2  and $v_mtol1 and $v_mtol2 and $v_ra_kesh and $f_b_time ORDER BY bah_cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
      </p>
      <table width="85%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#0099FF">
        <tr class="style8">
          <td width="5%" align="center" bgcolor="#CCCCCC">همراه مروج</td>
          <td width="5%" align="center" bgcolor="#CCCCCC"> کد ملی مروج</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">نام مروج</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">میزان تولید / تن</td>
          <td align="center" width="6%" bgcolor="#CCCCCC"> پیش بینی تولید /
          تن</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">نام محصول</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">تاریخ اولین آبیاری</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">فصل تولید </td>
          <td align="center" width="6%" bgcolor="#CCCCCC">سطح برداشت / هکتار</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">سطح زیر کشت  / هکتار</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">همراه بهره بردار</td>
          <td align="center" width="6%" bgcolor="#CCCCCC"><span class="style8"> کد ملی بهره بردار</span></td>
          <td align="center" width="7%" bgcolor="#CCCCCC">نام و نام خانوادگی بهره بردار</td>
          <td width="4%" align="center" bgcolor="#CCCCCC">نام آبادی </td>
          <td width="4%" align="center" bgcolor="#CCCCCC">آدرس آماری آبادی </td>
          <td width="3%" align="center" bgcolor="#CCCCCC">نام شهر </td>
          <td width="6%" align="center" bgcolor="#CCCCCC">آدرس آماری شهر</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">مرکز</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">شهرستان</td>
          <td align="center" width="8%" bgcolor="#CCCCCC">استان</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">تاریخ ثبت / ویرایش</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['b_time']=='1')  $v_b_time='استمرار ، زمستانه';
if ($row['b_time']=='2')  $v_b_time='بهاره';
if ($row['b_time']=='3')  $v_b_time='تابستانه';
if ($row['b_time']=='4')  $v_b_time='پاییزه';
  ?>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name1($row['mor_cod_m']) ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],3)*1 ; ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],3)*1 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_ab'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_b_time ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo bah_tel_m($row['bah_cod_m']);?></span></td>
          <td align="center" height="33" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo '"'.$row['add_abadi'].'"' ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_name($row['add_city']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_city'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_s'] ; ?></td>
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


