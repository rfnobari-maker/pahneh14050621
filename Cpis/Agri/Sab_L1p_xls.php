<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=االگوی_کشت_ابلاغی.xls");
include('../../lock_cp.php');
include('../../event.php');
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

<div align="center">  برنامه الگوی کشت ابلاغی محصول <?php echo mah_name($mah_name)?> در سال زراعی <?php echo($z_sal)?></div>
              <?php
 if (isset($_POST['z_sal'])) 
 {  
include('../../login/config.php') ;
$query = "
    SELECT 
        o.id_ostan,
        o.product_cod,
        o.z_sal,
        o.s_dem,
        o.s_abi,
        o.t_dem,
        o.t_abi,
        o.a_dem,
        o.a_abi,
        osn.ostan,
        IFNULL(c.total_city_dem,0) AS total_city_dem,
        IFNULL(c.total_city_abi,0) AS total_city_abi,
        IFNULL(m.total_marakez_dem,0) AS total_marakez_dem,
        IFNULL(m.total_marakez_abi,0) AS total_marakez_abi
    FROM Agri_ab_ostan o
    JOIN ostanname osn ON o.id_ostan = osn.id_ostan
    LEFT JOIN (
        SELECT 
            id_ostan,
            product_cod,
            SUM(s_dem) AS total_city_dem,
            SUM(s_abi) AS total_city_abi
        FROM Agri_ab_city
        WHERE z_sal = :z_sal
        AND group_cod = :mah_qroup
        AND product_cod = :mah_name
        GROUP BY id_ostan, product_cod
    ) c 
       ON o.id_ostan = c.id_ostan
      AND o.product_cod = c.product_cod
    LEFT JOIN (
        SELECT 
            id_ostan,
            product_cod,
            SUM(s_dem) AS total_marakez_dem,
            SUM(s_abi) AS total_marakez_abi
        FROM Agri_ab_mar
        WHERE z_sal = :z_sal
        AND group_cod = :mah_qroup
        AND product_cod = :mah_name
        GROUP BY id_ostan, product_cod
    ) m 
       ON o.id_ostan = m.id_ostan
      AND o.product_cod = m.product_cod
    WHERE o.z_sal = :z_sal
      AND o.group_cod = :mah_qroup
      AND o.product_cod = :mah_name
    ORDER BY FIELD(o.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')
";
$stmt = $dbh->prepare($query);
$stmt->execute(array(
    ':z_sal'     => $z_sal,
    ':mah_qroup' => $mah_qroup,
    ':mah_name'  => $mah_name
));
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
            <table width="100%" >
              <tr class="text1">
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">عملکرد / کیلوگرم در هکتار<br /></td>
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">تولید / تن <br /></td>
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center"><p>سطح   / هکتار<br />
          </p></td>
          <td width="10%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">عنوان</td>
          <td width="10%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">استان</td>
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
        <?php 
$r = 1 ;
$total_s_dem = 0;
$total_s_abi = 0;
$total_t_dem = 0;
$total_t_abi = 0;
$total_a_dem = 0;
$total_a_abi = 0;
$total_city_dem = 0;
$total_city_abi = 0;
$total_marakez_dem = 0;
$total_marakez_abi = 0;

foreach($stmt as $row){ 
  // محاسبه ترازها
  $diff_city_dem = $row['s_dem'] - $row['total_city_dem'];
  $diff_city_abi = $row['s_abi'] - $row['total_city_abi'];
  $diff_marakez_dem = $row['s_dem'] - $row['total_marakez_dem'];
  $diff_marakez_abi = $row['s_abi'] - $row['total_marakez_abi'];
  
  // جمع بندی برای کل کشور
  $total_s_dem += $row['s_dem'];
  $total_s_abi += $row['s_abi'];
  $total_t_dem += $row['t_dem'];
  $total_t_abi += $row['t_abi'];
  $total_a_dem += $row['a_dem'];
  $total_a_abi += $row['a_abi'];
  $total_city_dem += $row['total_city_dem'];
  $total_city_abi += $row['total_city_abi'];
  $total_marakez_dem += $row['total_marakez_dem'];
  $total_marakez_abi += $row['total_marakez_abi'];
?>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>برنامه الگوی کشت ابلاغی</td>
                <td rowspan="7" class="style19" align="center" style="vertical-align: middle;" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
    <?php echo $row['ostan'] ?>
</td>
                <td rowspan="7" class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
              </tr>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_city_dem']; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_city_abi']; ?></td>
                <td class="normalTextSmaller" align="center" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> مجموع برش شهرستانی</td>
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
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_city_dem; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_city_abi; ?></td>
                <td class="normalTextSmall" align="center" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> تراز شهرستانی</td>
              </tr>
              <tr style='font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_marakez_dem; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_marakez_abi; ?></td>
                <td class="normalTextSmall" align="center" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall" style="padding-right: 20px;">تراز مراکز</span></td>
              </tr>
              <tr style='font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['total_city_dem'] *100/$row['s_dem']),1)  ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['total_city_abi'] *100/$row['s_abi']),1)  ?></td>
                <td class="normalTextSmall" align="center" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall" style="padding-right: 20px;">درصد برش شهرستانی</span></td>
              </tr>
              <tr style='font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(( $row['total_marakez_dem'] *100/$row['s_dem']),1)  ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['total_marakez_abi'] *100/$row['s_abi']),1)  ?></td>
                <td class="normalTextSmall" align="center" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>درصد برش مراکز</td>
              </tr>
        <?php 
	$r++ ; 
}
// محاسبه میانگین عملکرد برای کل کشور
$avg_a_dem = ($total_s_dem > 0) ? ($total_t_dem * 1000) / $total_s_dem : 0;
$avg_a_abi = ($total_s_abi > 0) ? ($total_t_abi * 1000) / $total_s_abi : 0;

// محاسبه ترازهای ملی
$diff_national_city_dem = $total_s_dem - $total_city_dem;
$diff_national_city_abi = $total_s_abi - $total_city_abi;
$diff_national_marakez_dem = $total_s_dem - $total_marakez_dem;
$diff_national_marakez_abi = $total_s_abi - $total_marakez_abi;

// محاسبه درصدهای ملی
$percent_national_city_dem = ($total_s_dem > 0) ? round(($total_city_dem * 100 / $total_s_dem), 1) : 0;
$percent_national_city_abi = ($total_s_abi > 0) ? round(($total_city_abi * 100 / $total_s_abi), 1) : 0;
$percent_national_marakez_dem = ($total_s_dem > 0) ? round(($total_marakez_dem * 100 / $total_s_dem), 1) : 0;
$percent_national_marakez_abi = ($total_s_abi > 0) ? round(($total_marakez_abi * 100 / $total_s_abi), 1) : 0;

?>
              <tr style='background:#ccc; font-weight:bold; border-top: 2px solid black;'>
                <td colspan="9" style="text-align:center; font-size:16px;">جمع بندی کل کشور</td>
              </tr>
              <tr style='background:#e0e0e0; font-weight:bold;'>
                <td class="normalTextSmall" align="center"><?php echo round($avg_a_dem, 1); ?></td>
                <td class="normalTextSmall" align="center"><?php echo round($avg_a_abi, 1); ?></td>
                <td class="normalTextSmall" align="center"><?php echo $total_t_dem*1; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $total_t_abi*1; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $total_s_dem*1; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $total_s_abi*1; ?></td>
                <td class="normalTextSmall" align="center">برنامه الگوی کشت ابلاغی</td>
                <td rowspan="7" class="style19" align="center" style="vertical-align: middle;">کل کشور</td>
                <td rowspan="7" class="normalTextSmall" align="center"></td>
              </tr>
              <tr style='background:#e0e0e0; font-weight:bold;'>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td class="normalTextSmall" align="center"><?php echo $total_city_dem*1; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $total_city_abi*1; ?></td>
                <td class="normalTextSmaller" align="center" style="padding-right: 20px;"> مجموع برش شهرستانی</td>
              </tr>
              <tr style='background:#e0e0e0; font-weight:bold;'>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td class="normalTextSmall" align="center"><?php echo $total_marakez_dem*1; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $total_marakez_abi*1; ?></td>
                <td class="normalTextSmaller" align="center" style="padding-right: 20px;"> مجموع برش مراکز</td>
              </tr>
              <tr style='background:#e0e0e0; font-weight:bold;'>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td class="normalTextSmall" align="center"><?php echo $diff_national_city_dem; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $diff_national_city_abi; ?></td>
                <td class="normalTextSmall" align="center" style="padding-right: 20px;"> تراز شهرستانی</td>
              </tr>
              <tr style='background:#e0e0e0; font-weight:bold;'>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td class="normalTextSmall" align="center"><?php echo $diff_national_marakez_dem; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $diff_national_marakez_abi; ?></td>
                <td class="normalTextSmall" align="center" style="padding-right: 20px;"> تراز مراکز</td>
              </tr>
              <tr style='background:#e0e0e0; font-weight:bold;'>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td class="normalTextSmall" align="center"><?php echo $percent_national_city_dem; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $percent_national_city_abi; ?></td>
                <td class="normalTextSmall" align="center" style="padding-right: 20px;"> درصد برش شهرستانی</td>
              </tr>
              <tr style='background:#e0e0e0; font-weight:bold;'>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td class="normalTextSmall" align="center"><?php echo $percent_national_marakez_dem; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $percent_national_marakez_abi; ?></td>
                <td class="normalTextSmall" align="center" style="padding-right: 20px;"> درصد برش مراکز</td>
              </tr>
        <?php 
}
}
?>
  </table>