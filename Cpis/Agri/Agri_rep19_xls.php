<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=محصولات زراعی.xls");
include('../../lock_cp.php');
include('../../event.php');
include('counter15.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $z_sal = $_POST['z_sal'] ;
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
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
 if ($id_ostan1 == '-1')   { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)        { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($add_abadi  == '0')   { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')    { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
 $v_z_sal = "z_sal = '$z_sal'" ;
 include_once('../../login/config.php');
  $query = "SELECT add_abadi,add_city,cod_mah,id_ostan,id_city,id_mar,mor_cod_m,bah_cod_m,((zer_kesht_a+zer_kesht_b)) as zk,((s_bar_a+s_bar_b)) as sb ,mah_tol ,mah_tolp  from $Agri_prod_table where $v_id_ostan  and $v_id_city  and $v_z_sal and  $f_add_abadi  and $f_add_city  ORDER BY bah_cod_m,cod_mah ASC   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ; ?>
<p  align="center" style="font-size:16px; font-family:Tahoma" >مشخصات محصولات زراعی </p>
            <table width="100%" height="149" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td align="center" width="4%" bgcolor="#999999">شماره همراه مروج</td>
                <td align="center" width="4%" bgcolor="#999999">کد ملی مروج</td>
                <td align="center" width="4%" bgcolor="#999999"> نام مروج</td>
          <td align="center" width="4%" height="41" bgcolor="#999999">میزان تولید /
            تن </td>
          <td align="center" width="5%" bgcolor="#999999">سطح برداشت/
            هکتار</td>
          <td align="center" width="5%" bgcolor="#999999">  پیش بینی تولید / تن</td>
          <td align="center" width="6%" bgcolor="#999999">سطح زیر کشت /
            هکتار</td>
          <td align="center" width="5%" bgcolor="#999999">نام پدر</td>
          <td align="center" width="5%" bgcolor="#999999">شماره همراه</td>
          <td align="center" width="5%" bgcolor="#999999"><span class="text1"> کد ملی</span></td>
          <td align="center" width="10%" bgcolor="#999999">نام و نام خانوادگی</td>
          <td align="center" width="6%" bgcolor="#999999">کد محصول</td>
          <td align="center" width="7%" bgcolor="#999999">نام محصول</td>
          <td align="center" width="7%" bgcolor="#999999">مرکز جهاد کشاورزی</td>
          <td width="5%" bgcolor="#999999">کد آبادی </td>
          <td width="5%" bgcolor="#999999">شهر/آبادی</td>
          <td width="5%" bgcolor="#999999">شهرستان</td>
          <td width="5%" bgcolor="#999999">استان</td>
          <td align="center" width="3%" bgcolor="#999999">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
  ?>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
      <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['mor_cod_m']) ?><br /></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],2)?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['sb'],2) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],2)?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zk'],2) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_fname($row['bah_cod_m'])?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_tel_m($row['bah_cod_m']) ?></td>
          <td align="center" height="52" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td align="center"  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_mah'] ?></td>
          <td align="center"  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']) ?></td>
          <td align="center"  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar']) ?></td>
          <td  align="center" class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo substr($row['add_abadi'],13,6) ?></td>
  <td  align="center" class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
  <td  align="center" class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
  <td  align="center" class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']); ?></td>
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