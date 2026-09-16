<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست بهره برداران.xls");
include('../../lock_oce.php');
include('../../event.php');
include('counter15.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $z_sal = $_POST['z_sal'] ;
// کد گروه و کد محصول
 $mah_qroup = $_POST['mah_qroup'] ;
 $mah_name = $_POST['mah_name'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
               <?php
 $v_id_ostan = "id_ostan='$id_ostan1'" ;
 if ($id_city == 0)    { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
 $v_z_sal = "z_sal = '$z_sal'" ;
 $v_cod_mah = "cod_mah = '$mah_name'" ;
 include('../../login/config.php');
 $query = "SELECT id_ostan,id_city,mor_cod_m,bah_cod_m,((SUM(zer_kesht_a)+SUM(zer_kesht_b))/10000) as zk,((SUM(s_bar_a)+SUM(s_bar_b))/10000) as sb ,SUM(mah_tol) as mtol,SUM(mah_tolp) as mtol_p from Agri_prod where $v_id_ostan  and $v_id_city  and $v_z_sal and  $v_cod_mah GROUP BY bah_cod_m  ORDER BY id_city,bah_cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ; ?>
<p  align="center" style="font-size:16px; font-family:Tahoma" >بهره برداران تولید کننده محصول <?php echo mah_name($mah_name) ;?> طی سال زراعی <?php echo $z_sal ;?> در استان <?php echo ostan_name($id_ostan1)?></p>
            <table width="89%" height="88" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td align="center" width="9%" bgcolor="#999999">مروج</td>
          <td align="center" width="9%" height="41" bgcolor="#999999">میزان تولید /
            تن </td>
          <td align="center" width="12%" bgcolor="#999999">سطح برداشت/
            هکتار</td>
          <td align="center" width="12%" bgcolor="#999999">  پیش بینی تولید / تن</td>
          <td align="center" width="13%" bgcolor="#999999">سطح زیر کشت /
            هکتار</td>
          <td align="center" width="10%" bgcolor="#999999">نام پدر</td>
          <td align="center" width="11%" bgcolor="#999999"><span class="text1"> کد ملی</span></td>
          <td align="center" width="13%" bgcolor="#999999">نام و نام خانوادگی</td>
          <td align="center" width="14%" bgcolor="#999999">شهرستان</td>
          <td align="center" width="6%" bgcolor="#999999">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
  ?>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mtol'],2)?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['sb'],2) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mtol_p'],2)?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zk'],2) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_fname($row['bah_cod_m'])?></td>
          <td align="center" height="44" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
  <td  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo city_name1($row['id_city'],$row['id_ostan'])?></div></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
   <?php }  
?>
<p align="center">-------------- پایان گزارش ----------------</p>
</body>
</html>