<?php
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=االگوی_کشت_ابلاغی.xls");
include('../../lock_cp.php');
include('../../event.php');
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';

// تعریف product_map و نام جدول Agri_prod
$product_map = array(
    '103' => '102',
    '107' => '106',
    '176' => '490',
    '178' => '490',
    '180' => '490',
    '182' => '490',
    '184' => '490',
    '186' => '490',
    '188' => '490',
    '190' => '490',
    '192' => '490',
    '194' => '490',
    '196' => '490',
    '198' => '490',
    '200' => '490',
    '414' => '490',
    '416' => '490',
    '418' => '490',
    '420' => '490',
    '422' => '490',
    '424' => '490',
    '426' => '490',
    '428' => '490',
    '430' => '490',
    '432' => '490',
    '434' => '490',
    '436' => '490',
    '438' => '490',
    '440' => '490',
    '442' => '490',
    '444' => '490',
    '446' => '490',
    '448' => '490',
    '449' => '490',
    '464' => '490'
);

// نگاشت mah_name به mah_name_mapped
$mah_name_mapped = $mah_name;
if (array_key_exists($mah_name, $product_map)) {
    $mah_name_mapped = $product_map[$mah_name];
}

// ساخت نام جدول Agri_prod به صورت پویا
$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

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
        IFNULL(m.total_marakez_abi,0) AS total_marakez_abi,
        IFNULL(za.total_z_kesht_abi, 0) AS total_z_kesht_abi,
        IFNULL(zd.total_z_kesht_dem, 0) AS total_z_kesht_dem
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
    LEFT JOIN (
        SELECT
            id_ostan,
            IFNULL(SUM(zer_kesht_a), 0) + IFNULL(SUM(zer_kesht_b), 0) AS total_z_kesht_abi
        FROM " . $Agri_prod_table . "
        WHERE z_sal = :z_sal
        AND cod_mah = :mah_name_mapped
        AND no_kesh = '1'
        GROUP BY id_ostan
    ) za ON o.id_ostan = za.id_ostan
    LEFT JOIN (
        SELECT
            id_ostan,
            IFNULL(SUM(zer_kesht_a), 0) + IFNULL(SUM(zer_kesht_b), 0) AS total_z_kesht_dem
        FROM " . $Agri_prod_table . "
        WHERE z_sal = :z_sal
        AND cod_mah = :mah_name_mapped
        AND no_kesh = '2'
        GROUP BY id_ostan
    ) zd ON o.id_ostan = zd.id_ostan
    WHERE o.z_sal = :z_sal
      AND o.group_cod = :mah_qroup
      AND o.product_cod = :mah_name
    ORDER BY FIELD(o.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')
";
$stmt = $dbh->prepare($query);
$stmt->execute(array(
    ':z_sal'     => $z_sal,
    ':mah_qroup' => $mah_qroup,
    ':mah_name'  => $mah_name,
    ':mah_name_mapped' => $mah_name_mapped
));
$t_row = $stmt -> rowCount() ;
if ($t_row>0) { ;
?>
            <table width="100%" >
              <tr class="text1">
          <td colspan="3" bgcolor="#CCCCCC" style="text-align: center">درصد تحقق برش مرکز سطوح ابلاغی</td>
          <td colspan="3" bgcolor="#CCCCCC" style="text-align: center">درصد تحقق برش شهرستانی سطوح ابلاغی<br /></td>
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">تولید / تن <br /></td>
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">سطح ابلاغی / هکتار<br /></td>
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">سطح زیر کشت / هکتار<br /></td>
          <td width="13%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">استان</td>
          <td width="5%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="5%" bgcolor="#CCCCCC" style="text-align: center">کل</td>
          <td width="6%" height="22" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
          <td width="7%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
          <td width="5%" bgcolor="#CCCCCC" style="text-align: center">کل</td>
          <td width="10%" height="22" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
          <td width="10%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
          <td width="11%" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
          <td width="9%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
          <td width="10%" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
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
$total_z_kesht_abi = 0;
$total_z_kesht_dem = 0;

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
  $total_z_kesht_abi += $row['total_z_kesht_abi'];
  $total_z_kesht_dem += $row['total_z_kesht_dem'];

  // محاسبه درصد تحقق برش مرکز (کل) و برش شهرستانی (کل) برای هر استان
  $percent_ostan_city_all = ($row['s_dem'] + $row['s_abi'] > 0) ? round((($row['total_city_dem'] + $row['total_city_abi']) * 100 / ($row['s_dem'] + $row['s_abi'])), 1) : 0;
  $percent_ostan_marakez_all = ($row['s_dem'] + $row['s_abi'] > 0) ? round((($row['total_marakez_dem'] + $row['total_marakez_abi']) * 100 / ($row['s_dem'] + $row['s_abi'])), 1) : 0;

?>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $percent_ostan_marakez_all; ?></td>
                <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ($row['s_dem'] > 0) ? round(($row['total_marakez_dem'] *100/$row['s_dem']),1) : 0;  ?></td>
                <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ($row['s_abi'] > 0) ? round(($row['total_marakez_abi'] *100/$row['s_abi']),1) : 0;  ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $percent_ostan_city_all; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ($row['s_dem'] > 0) ? round(($row['total_city_dem'] *100/$row['s_dem']),1) : 0;  ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ($row['s_abi'] > 0) ? round(($row['total_city_abi'] *100/$row['s_abi']),1) : 0;  ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['total_z_kesht_dem']*1,2); ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['total_z_kesht_abi']*1,2); ?></td>
                <td class="style19" align="center" style="vertical-align: middle;" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
                  <?php echo $row['ostan'] ?>
</td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
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

// محاسبه درصدهای کل ملی (فرمول‌های اضافه شده)
$total_s_all = $total_s_dem + $total_s_abi;
$total_city_all = $total_city_dem + $total_city_abi;
$total_marakez_all = $total_marakez_dem + $total_marakez_abi;

$percent_national_city_all = ($total_s_all > 0) ? round(($total_city_all * 100 / $total_s_all), 1) : 0;
$percent_national_marakez_all = ($total_s_all > 0) ? round(($total_marakez_all * 100 / $total_s_all), 1) : 0;
?>
              <tr style='background:#ccc; font-weight:bold; border-top: 2px solid black;'>
                <td colspan="14" style="text-align:center; font-size:16px;">جمع بندی کل کشور</td>
              </tr>
              <tr style='background:#e0e0e0; font-weight:bold;'>
                <td align="center" class="normalTextSmall"><?php echo $percent_national_marakez_all; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $percent_national_marakez_dem; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $percent_national_marakez_abi; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $percent_national_city_all; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $percent_national_city_dem; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $percent_national_city_abi; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $total_t_dem*1; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $total_t_abi*1; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $total_s_dem*1; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $total_s_abi*1; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $total_z_kesht_dem*1; ?></td>
                <td class="normalTextSmall" align="center"><?php echo $total_z_kesht_abi*1; ?></td>
                <td class="style19" align="center" style="vertical-align: middle;">کل کشور</td>
                <td class="normalTextSmall" align="center"></td>
              </tr>
        <?php
}
}
?>
  </table>