<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=تولید_به_تفکیک_استان.doc");
include('../../lock_ce.php');
include('../../event.php');
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
 if ($mah_name=='170') $v_cod_mah = 'سیب زمینی' ; 

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

<p align="center"  class="style8">گزارش تولید محصول <?php echo $v_cod_mah ?> به تفکیک استان   در سال زراعی <?php echo $z_sal?>
              <?php
 if (1==1) 
 {  
  $v_z_sal     = "z_sal = '$z_sal'" ;
  $v_cod_mah   = "cod_mah = '$mah_name'" ;
 if ($ra_kesh == '')     { $v_ra_kesh  = 1   ;}else{$v_ra_kesh  = "ra_kesh = '$ra_kesh'" ;}
 if ($b_time == '')      { $f_b_time   = 1 ;}else{ $f_b_time     = "b_time = '$b_time'"       ;}
 if ($ragham == '')      { $v_ragham   = 1     ;}else{$v_ragham    = "ragham = '$ragham'" ;}
 if ($no_ab == '')       { $v_no_ab    = 1     ;}else{$v_no_ab      = "no_ab = '$no_ab'" ;}
 if ($mah_bazar == '')   { $v_mah_bazar= 1  ;}else{$v_mah_bazar = "mah_bazar = '$mah_bazar'" ;}
 if ($dah_bazar == '')   { $v_dah_bazar= 1  ;}else{$v_dah_bazar = "dah_bazar = '$dah_bazar'" ;}
 include('../../login/config.php');
$query = "SELECT ostan,id_ostan from ostanname where 1 
ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21') "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
              <br />
</p>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
  <tr class="text1">
                <td width="15%" height="38" bgcolor="#CCCCCC"> مجموع تولید قطعی / 
                  <span class="style3">تن </span></td>
                <td width="16%" bgcolor="#CCCCCC"> مجموع  پیش بینی تولید / 
                <span class="style3">تن</span></td>
          <td width="16%" bgcolor="#CCCCCC"> مجموع  سطح برداشت /<span class="style3">هکتار</span></td>
          <td width="16%" bgcolor="#CCCCCC">مجموع  سطح زیر کشت /<span class="style3">هکتار</span></td>
    <td width="15%" bgcolor="#CCCCCC">سطح زیر کشت ابلاغی / <span class="style3">هکتار</span><br /></td>
          <td width="17%" bgcolor="#CCCCCC">نام استان</td>
          <td width="5%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
$id_ostan = $row['id_ostan'] ; 
$ostan = $row['ostan'] ; 
$query = "SELECT id_ostan,sum(zer_kesht) as T_zer_kesht, sum(s_bar) as T_s_bar , sum(mah_tolp) as T_mah_tolp 
 , sum(mah_tol) as T_mah_tol from Vege_prod
   where  $v_z_sal  and  $v_cod_mah and  $v_ragham  and $v_no_ab  and $v_mah_bazar and $v_dah_bazar and
  $v_ra_kesh and $f_b_time and id_ostan = '$id_ostan' Group by id_ostan  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
  ?>
          <td height="39"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['T_mah_tol'],3)*1 ; ?></td>
          <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['T_mah_tolp'],3)*1 ; ?></td>
          <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['T_s_bar']+0 ; ?></td>
          <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['T_zer_kesht']+0 ; ?></td>
          <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
          <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo $ostan?></div></td>
          <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}

  $query = "SELECT  sum(zer_kesht) as T_zer_kesht, sum(s_bar) as T_s_bar , sum(mah_tolp) as T_mah_tolp , sum(mah_tol) as T_mah_tol
     from  Vege_prod where $v_z_sal  and  $v_cod_mah and  $v_ragham  and $v_no_ab  and $v_mah_bazar and $v_dah_bazar and
  $v_ra_kesh and $f_b_time "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
	?>
        <tr>
          <td height="38" bgcolor="#CCCCCC" class="text1"> مجموع تولید قطعی / <span class="style3">تن </span></td>
          <td bgcolor="#CCCCCC" class="text1"> مجموع  پیش بینی تولید / <span class="style3">تن</span></td>
          <td bgcolor="#CCCCCC" class="text1"> مجموع  سطح برداشت /<span class="style3">هکتار</span></td>
          <td bgcolor="#CCCCCC" class="text1">مجموع  سطح زیر کشت /<span class="style3">هکتار</span></td>
          <td bgcolor="#CCCCCC" class="text1">سطح زیر کشت ابلاغی / <span class="style3">هکتار</span><br /></td>
          <td colspan="2" bgcolor="#CCCCCC" class="text1"  >کل</td>
          </tr>
<?php 
foreach($stmt as $row){ 
?>
        <tr>
          <td height="39" ><?php echo round($row['T_mah_tol'],3)*1 ; ?></td>
          <td><?php echo round($row['T_mah_tolp'],3)*1 ; ?></td>
          <td><?php echo $row['T_s_bar']+0 ; ?></td>
          <td><?php echo $row['T_zer_kesht']+0 ; ?></td>
          <td  >&nbsp;</td>
          <td colspan="2"  >&nbsp;</td>
          </tr>
  </table>
   <?php }
}
?>


</body>
</html>