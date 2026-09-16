<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=االگوی_کشت_ابلاغی_شهرستان.xls");
include('../../lock_expar.php');
include('../../event.php');

$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';

?>
<div align="center">برش الگوی کشت ابلاغی محصولات زراعی به تفکیک شهرستان برای محصول <?php echo mah_name($mah_name);?> در سال زراعی <?php echo($z_sal)?></div>
              <?php
 if (isset($_POST['z_sal']) && !empty($mah_qroup) && !empty($mah_name) && !empty($id_ostan1)) 
 {  
include('../../login/config.php') ;

$query = "
SELECT
    c.id_city,
    c.city,
    a.s_dem AS s_dem_city,
    a.s_abi AS s_abi_city,
    a.t_dem AS t_dem_city,
    a.t_abi AS t_abi_city,
    a.a_dem AS a_dem_city,
    a.a_abi AS a_abi_city,
    IFNULL(m.total_marakez_dem, 0) AS total_marakez_dem,
    IFNULL(m.total_marakez_abi, 0) AS total_marakez_abi
FROM cityname c
LEFT JOIN Agri_ab_city a
    ON c.id_city = a.id_city
    AND a.z_sal = :z_sal
    AND a.group_cod = :mah_qroup
    AND a.product_cod = :mah_name
    AND a.id_ostan = :id_ostan_target
LEFT JOIN (
    SELECT
        id_city,
        SUM(s_dem) AS total_marakez_dem,
        SUM(s_abi) AS total_marakez_abi
    FROM Agri_ab_mar
    WHERE z_sal = :z_sal
    AND group_cod = :mah_qroup
    AND product_cod = :mah_name
    AND id_ostan = :id_ostan_target
    GROUP BY id_city
) m
    ON c.id_city = m.id_city
WHERE c.id_ostan = :id_ostan_target
ORDER BY BINARY c.city ASC;
";

$stmt = $dbh->prepare($query);
$stmt->execute(array(
    ':z_sal'     => $z_sal,
    ':mah_qroup' => $mah_qroup,
    ':mah_name'  => $mah_name,
    ':id_ostan_target' => $id_ostan1
));
$t_row = $stmt->rowCount();

if ($t_row>0) { ;
?>
              <table width="100%" >
              <tr class="text1">
                <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">عملکرد / کیلوگرم در هکتار<br /></td>
                <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">تولید / تن <br /></td>
                <td colspan="2" bgcolor="#CCCCCC" style="text-align: center"><p>سطح   / هکتار<br /></p></td>
                <td width="19%" height="35" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">عنوان</td>
                <td width="13%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">شهرستان </td>
                <td width="4%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">ردیف</td>
              </tr>
              <tr class="text1">
                <td width="12%" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
                <td width="10%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
                <td width="12%" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
                <td width="9%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
                <td width="11%" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
                <td width="10%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
              </tr>
              <?php
                $r = 1 ;
                foreach($stmt as $row){
                // محاسبه ترازها
                $diff_marakez_dem = $row['s_dem_city'] - $row['total_marakez_dem'];
                $diff_marakez_abi = $row['s_abi_city'] - $row['total_marakez_abi'];
              ?>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_dem_city']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_abi_city']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dem_city']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_abi_city']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_dem_city']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_abi_city']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>میزان برش شهرستان</td>
                <td rowspan="3" class="style19" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'] ?></td>
                <td rowspan="3" class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
              </tr>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_marakez_dem']; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_marakez_abi']; ?></td>
                <td class="normalTextSmaller" align="center" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> مجموع برش مراکز</td>
              </tr>
              <tr style='font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_marakez_dem; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_marakez_abi; ?></td>
                <td class="normalTextSmall" align="center" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> تراز مراکز</td>
              </tr>
        <?php 
	$r++ ; 
}
}
}
	?>
  </table>