<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=تولید_صیفی_مرکز.xls");
include('../../lock_ce.php');
include('../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $ra_kesh   = $_POST['ra_kesh'] ;
 $z_sal     = $_POST['z_sal'] ;
 $b_time    = $_POST['b_time'] ;
 $ragham    = $_POST['ragham'] ; 
 $no_ab     = $_POST['no_ab'] ; 
 $dah_bazar = $_POST['dah_bazar'] ; 
 $mah_bazar = $_POST['mah_bazar'] ; 
 $mah_name  = $_POST['mah_name'] ;

 if ($mah_name=='174') $v_cod_mah = 'گوجه فرنگی' ; 
 if ($mah_name=='172') $v_cod_mah = 'پیاز' ; 
 if ($mah_name=='170') $v_cod_mah = 'سیب زمین' ; 

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
      <p align="center"  class="style8">گزارش تولید محصول <?php echo $v_cod_mah ?> استان  به تفکیک مزکز جهاد کشاورزی
        <?php
 if ($id_ostan1 == '-1') { $v_id_ostan  = 1   ;}else{$v_id_ostan  = "Vege_prod.id_ostan='$id_ostan1'" ;}
 if ($ra_kesh == '')     { $v_ra_kesh    = 1   ;}else{$v_ra_kesh  = "Vege_prod.ra_kesh = '$ra_kesh'" ;}
 if ($z_sal == '')       { $v_z_sal     = 1   ;}else{$v_z_sal     = "Vege_prod.z_sal = '$z_sal'" ;}
 if ($b_time == '')        { $f_b_time=   1 ;}else{ $f_b_time     = "Vege_prod.b_time = '$b_time'"       ;}
 if ($mah_name == '')    { $v_cod_mah   = 1   ;}else{$v_cod_mah   = "Vege_prod.cod_mah = '$mah_name'" ;}
 if ($ragham == '')      { $v_ragham  = 1     ;}else{$v_ragham    = "Vege_prod.ragham = '$ragham'" ;}
 if ($no_ab == '')       { $v_no_ab  = 1     ;}else{$v_no_ab      = "Vege_prod.no_ab = '$no_ab'" ;}
 if ($mah_bazar == '')   { $v_mah_bazar  = 1  ;}else{$v_mah_bazar = "Vege_prod.mah_bazar = '$mah_bazar'" ;}
 if ($dah_bazar == '')   { $v_dah_bazar  = 1  ;}else{$v_dah_bazar = "Vege_prod.dah_bazar = '$dah_bazar'" ;}
 include_once('../../login/config.php');
  $query = "SELECT  cityname.city,Vege_prod.id_ostan,Vege_prod.id_city,Vege_prod.id_mar,sum(Vege_prod.zer_kesht) as T_zer_kesht, sum(Vege_prod.s_bar) as T_s_bar , sum(Vege_prod.mah_tolp) as T_mah_tolp , sum(Vege_prod.mah_tol) as T_mah_tol
     from  Vege_prod 
	 LEFT JOIN cityname ON Vege_prod.id_ostan = cityname.id_ostan and Vege_prod.id_city = cityname.id_city
	 where  $v_id_ostan  and $v_z_sal  and  $v_cod_mah and  $v_ragham  and $v_no_ab  and $v_mah_bazar and $v_dah_bazar and
  $v_ra_kesh and $f_b_time Group by Vege_prod.id_mar ORDER BY BINARY city "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
      </p>
      <table width="95%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#00CCFF">
        <tr class="text1">
          <td align="center" width="18%" height="38"> مجموع تولید قطعی /<span class="style3">تن </span></td>
          <td align="center" width="19%"> مجموع  پیش بینی تولید / 
            <span class="style3">تن</span></td>
          <td align="center" width="19%"> مجموع  سطح برداشت /<span class="style3"> هکتار</span></td>
          <td align="center" width="20%">مجموع  سطح زیر کشت / 
            <span class="style3">هکتار</span></td>
          <td align="center" width="17%">نام مرکز </td>
          <td align="center" width="17%">نام شهرستان</td>
          <td align="center" width="7%">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
  ?>
          <td align="center" height="39"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['T_mah_tol'],3)*1 ; ?></td>
          <td align="center"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['T_mah_tolp'],3)*1 ; ?></td>
          <td align="center"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['T_s_bar']+0 ; ?></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['T_zer_kesht']+0 ; ?></td>
          <td align="center"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar'])?></td>
          <td align="center"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo $row['city']?></div></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
  $query = "SELECT  id_city,sum(zer_kesht) as T_zer_kesht, sum(s_bar) as T_s_bar , sum(mah_tolp) as T_mah_tolp , sum(mah_tol) as T_mah_tol
     from  Vege_prod where  $v_id_ostan  and $v_z_sal  and  $v_cod_mah and  $v_ragham  and $v_no_ab  and $v_mah_bazar and $v_dah_bazar and
  $v_ra_kesh and $f_b_time Group by id_ostan "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
	?>
        <tr>
          <td height="38" align="center" class="text1"> مجموع تولید قطعی /<span class="style3">تن </span></td>
          <td align="center" class="text1"> مجموع  پیش بینی تولید / <span class="style3">تن</span></td>
          <td align="center" class="text1"> مجموع  سطح برداشت /<span class="style3"> هکتار</span></td>
          <td align="center" class="text1">مجموع  سطح زیر کشت / <span class="style3">هکتار</span></td>
          <td align="center" class="text1"  >&nbsp;</td>
          <td align="center" class="text1"  >کل استان </td>
          <td class="text1"  >&nbsp;</td>
        </tr>
        <?php 
foreach($stmt as $row){ 
?>
        <tr>
          <td align="center" height="39" ><?php echo round($row['T_mah_tol'],3)*1 ; ?></td>
          <td align="center"><?php echo round($row['T_mah_tolp'],3)*1 ; ?></td>
          <td align="center"><?php echo $row['T_s_bar']+0 ; ?></td>
          <td align="center"><?php echo $row['T_zer_kesht']+0 ; ?></td>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <?php }  
             }
?>   
</body>
</html>


