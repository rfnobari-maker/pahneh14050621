<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=االگوی_کشت_ابلاغی.xls");
include('../../lock_expar.php');
include('../../event.php');
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
?>
<div align="center">  برنامه الگوی کشت ابلاغی محصول <?php echo mah_name($mah_name)?> در سال زراعی <?php echo($z_sal)?></div>
              <?php
 if (isset($_POST['z_sal'])) 
 {  
include('../../login/config.php') ;
$query = "
    SELECT a.*, o.city
    FROM Agri_ab_city a
    JOIN cityname o ON a.id_ostan = o.id_ostan and a.id_city = o.id_city
    WHERE a.z_sal = :z_sal
      AND a.group_cod = :mah_qroup
      AND a.product_cod = :mah_name
     AND a.id_ostan = :id_ostan
    ORDER BY BINARY o.city ASC";
$stmt = $dbh->prepare($query);
$stmt->execute(array(
    ':z_sal'     => $z_sal,
    ':mah_qroup' => $mah_qroup,
    ':mah_name'  => $mah_name,
    ':id_ostan'  => $id_ostan
));
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
            <table width="100%" >
              <tr class="text1">
          <td height="28" colspan="2" bgcolor="#CCCCCC" style="text-align: center">عملکرد / کیلوگرم در هکتار<br /></td>
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">تولید / تن <br /></td>
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center"><p>سطح   / هکتار<br />
          </p></td>
          <td width="10%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">شهرستان</td>
          <td width="5%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="15%" height="22" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
          <td width="12%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
          <td width="11%" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
          <td width="9%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
          <td width="10%" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
          <td width="9%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
          </tr>
        <tr>
          <?php 
//$r = $start+1 ;
$r = 1 ;
foreach($stmt as $row){ 
 $t_r = $r ; 
  ?>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_dem']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_abi']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dem']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_abi']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_dem']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_abi']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'] ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
}
}
}
	?>
  </table>
