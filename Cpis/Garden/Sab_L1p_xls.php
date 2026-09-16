<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=الگوی_کشت_باغی_ابلاغی.xls");
include('../../lock_cp.php');
include('../../event.php');

$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';

// تابع کمکی برای محاسبه درصد (سازگار با نسخه‌های قدیمی)
function calc_percent($part, $total) {
    if ($total > 0) {
        return round(($part / $total) * 100, 1) . '%';
    }
    return '0%';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div align="center" style="font-family: Tahoma; font-weight: bold;">برنامه الگوی کشت ابلاغی محصولات باغی <?php echo mah_name_bagh($mah_name)?> در سال <?php echo($z_sal)?></div>
<?php
if (isset($_POST['z_sal'])) {  
    include('../../login/config.php');
    
    // کوئری محصولات باغی
    $query = "
        SELECT 
            o.id_ostan, o.product_cod, o.z_sal,
            o.s_bar_dem, o.s_bar_abi, o.s_nobar_dem, o.s_nobar_abi,
            o.t_dem, o.t_abi, o.a_dem, o.a_abi,
            osn.ostan,
            IFNULL(c.total_city_s_bar_dem,0) AS total_city_s_bar_dem,
            IFNULL(c.total_city_s_bar_abi,0) AS total_city_s_bar_abi,
            IFNULL(c.total_city_s_nobar_dem,0) AS total_city_s_nobar_dem,
            IFNULL(c.total_city_s_nobar_abi,0) AS total_city_s_nobar_abi,
            IFNULL(m.total_marakez_s_bar_dem,0) AS total_marakez_s_bar_dem,
            IFNULL(m.total_marakez_s_bar_abi,0) AS total_marakez_s_bar_abi,
            IFNULL(m.total_marakez_s_nobar_dem,0) AS total_marakez_s_nobar_dem,
            IFNULL(m.total_marakez_s_nobar_abi,0) AS total_marakez_s_nobar_abi
        FROM Garden_ab_ostan o
        JOIN ostanname osn ON o.id_ostan = osn.id_ostan
        LEFT JOIN (
            SELECT id_ostan, product_cod,
                SUM(s_bar_dem) AS total_city_s_bar_dem, SUM(s_bar_abi) AS total_city_s_bar_abi,
                SUM(s_nobar_dem) AS total_city_s_nobar_dem, SUM(s_nobar_abi) AS total_city_s_nobar_abi
            FROM Garden_ab_city WHERE z_sal = :z_sal AND group_cod = :mah_qroup AND product_cod = :mah_name
            GROUP BY id_ostan, product_cod
        ) c ON o.id_ostan = c.id_ostan AND o.product_cod = c.product_cod
        LEFT JOIN (
            SELECT id_ostan, product_cod,
                SUM(s_bar_dem) AS total_marakez_s_bar_dem, SUM(s_bar_abi) AS total_marakez_s_bar_abi,
                SUM(s_nobar_dem) AS total_marakez_s_nobar_dem, SUM(s_nobar_abi) AS total_marakez_s_nobar_abi
            FROM Garden_ab_mar WHERE z_sal = :z_sal AND group_cod = :mah_qroup AND product_cod = :mah_name
            GROUP BY id_ostan, product_cod
        ) m ON o.id_ostan = m.id_ostan AND o.product_cod = m.product_cod
        WHERE o.z_sal = :z_sal AND o.group_cod = :mah_qroup AND o.product_cod = :mah_name
        ORDER BY FIELD(o.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')
    ";

    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':z_sal' => $z_sal, ':mah_qroup' => $mah_qroup, ':mah_name' => $mah_name));
    
    if ($stmt->rowCount() > 0) {
        // تعریف آرایه جمع کل به سبک PHP 5.3
        $totals = array(
            's_bar_dem' => 0, 's_bar_abi' => 0, 's_nobar_dem' => 0, 's_nobar_abi' => 0,
            't_dem' => 0, 't_abi' => 0,
            'city_bar_dem' => 0, 'city_bar_abi' => 0, 'city_nobar_dem' => 0, 'city_nobar_abi' => 0,
            'mar_bar_dem' => 0, 'mar_bar_abi' => 0, 'mar_nobar_dem' => 0, 'mar_nobar_abi' => 0
        );
?>
    <table border="1">
        <tr bgcolor="#CCCCCC">
            <td colspan="2" align="center">عملکرد (کيلوگرم/هکتار)</td>
            <td colspan="2" align="center">توليد (تن)</td>
            <td colspan="2" align="center">سطح بارور (هکتار)</td>
            <td colspan="2" align="center">سطح غيربارور (هکتار)</td>
            <td rowspan="2" align="center">عنوان</td>
            <td rowspan="2" align="center">استان</td>
            <td rowspan="2" align="center">رديف</td>
        </tr>
        <tr bgcolor="#CCCCCC">
            <td align="center">ديم</td><td align="center">آبی</td>
            <td align="center">ديم</td><td align="center">آبی</td>
            <td align="center">ديم</td><td align="center">آبی</td>
            <td align="center">ديم</td><td align="center">آبی</td>
        </tr>
<?php 
        $r = 1;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // انباشت مقادیر برای جمع کل
            $totals['s_bar_dem'] += $row['s_bar_dem']; $totals['s_bar_abi'] += $row['s_bar_abi'];
            $totals['s_nobar_dem'] += $row['s_nobar_dem']; $totals['s_nobar_abi'] += $row['s_nobar_abi'];
            $totals['t_dem'] += $row['t_dem']; $totals['t_abi'] += $row['t_abi'];
            $totals['city_bar_dem'] += $row['total_city_s_bar_dem']; $totals['city_bar_abi'] += $row['total_city_s_bar_abi'];
            $totals['city_nobar_dem'] += $row['total_city_s_nobar_dem']; $totals['city_nobar_abi'] += $row['total_city_s_nobar_abi'];
            $totals['mar_bar_dem'] += $row['total_marakez_s_bar_dem']; $totals['mar_bar_abi'] += $row['total_marakez_s_bar_abi'];
            $totals['mar_nobar_dem'] += $row['total_marakez_s_nobar_dem']; $totals['mar_nobar_abi'] += $row['total_marakez_s_nobar_abi'];
?>
            <tr>
                <td align="center"><?php echo $row['a_dem']; ?></td><td align="center"><?php echo $row['a_abi']; ?></td>
                <td align="center"><?php echo $row['t_dem']; ?></td><td align="center"><?php echo $row['t_abi']; ?></td>
                <td align="center"><?php echo $row['s_bar_dem']; ?></td><td align="center"><?php echo $row['s_bar_abi']; ?></td>
                <td align="center"><?php echo $row['s_nobar_dem']; ?></td><td align="center"><?php echo $row['s_nobar_abi']; ?></td>
                <td>برنامه ابلاغی</td>
                <td rowspan="5" align="center" style="vertical-align: middle;"><?php echo $row['ostan']; ?></td>
                <td rowspan="5" align="center" style="vertical-align: middle;"><?php echo $r; ?></td>
            </tr>
            <tr bgcolor="#f9f9f9">
                <td colspan="4"></td>
                <td align="center"><?php echo ($row['s_bar_dem'] - $row['total_city_s_bar_dem']); ?></td>
                <td align="center"><?php echo ($row['s_bar_abi'] - $row['total_city_s_bar_abi']); ?></td>
                <td align="center"><?php echo ($row['s_nobar_dem'] - $row['total_city_s_nobar_dem']); ?></td>
                <td align="center"><?php echo ($row['s_nobar_abi'] - $row['total_city_s_nobar_abi']); ?></td>
                <td>تراز شهرستانی</td>
            </tr>
            <tr bgcolor="#f9f9f9">
                <td colspan="4"></td>
                <td align="center"><?php echo ($row['s_bar_dem'] - $row['total_marakez_s_bar_dem']); ?></td>
                <td align="center"><?php echo ($row['s_bar_abi'] - $row['total_marakez_s_bar_abi']); ?></td>
                <td align="center"><?php echo ($row['s_nobar_dem'] - $row['total_marakez_s_nobar_dem']); ?></td>
                <td align="center"><?php echo ($row['s_nobar_abi'] - $row['total_marakez_s_nobar_abi']); ?></td>
                <td>تراز مراکز</td>
            </tr>
            <tr bgcolor="#E8F5E9">
                <td colspan="4"></td>
                <td align="center"><?php echo calc_percent($row['total_city_s_bar_dem'], $row['s_bar_dem']); ?></td>
                <td align="center"><?php echo calc_percent($row['total_city_s_bar_abi'], $row['s_bar_abi']); ?></td>
                <td align="center"><?php echo calc_percent($row['total_city_s_nobar_dem'], $row['s_nobar_dem']); ?></td>
                <td align="center"><?php echo calc_percent($row['total_city_s_nobar_abi'], $row['s_nobar_abi']); ?></td>
                <td>درصد برش شهرستانی</td>
            </tr>
            <tr bgcolor="#E8F5E9">
                <td colspan="4"></td>
                <td align="center"><?php echo calc_percent($row['total_marakez_s_bar_dem'], $row['s_bar_dem']); ?></td>
                <td align="center"><?php echo calc_percent($row['total_marakez_s_bar_abi'], $row['s_bar_abi']); ?></td>
                <td align="center"><?php echo calc_percent($row['total_marakez_s_nobar_dem'], $row['s_nobar_dem']); ?></td>
                <td align="center"><?php echo calc_percent($row['total_marakez_s_nobar_abi'], $row['s_nobar_abi']); ?></td>
                <td>درصد برش مراکز</td>
            </tr>
<?php 
            $r++; 
        } 
?>
        <tr bgcolor="#999999" style="font-weight:bold;">
            <td colspan="11" align="center">جمع بندی کل کشور</td>
        </tr>
        <tr bgcolor="#f0f0f0">
            <td align="center"><?php echo ($totals['s_bar_dem']>0) ? round(($totals['t_dem']*1000)/$totals['s_bar_dem']) : 0; ?></td>
            <td align="center"><?php echo ($totals['s_bar_abi']>0) ? round(($totals['t_abi']*1000)/$totals['s_bar_abi']) : 0; ?></td>
            <td align="center"><?php echo $totals['t_dem']; ?></td><td align="center"><?php echo $totals['t_abi']; ?></td>
            <td align="center"><?php echo $totals['s_bar_dem']; ?></td><td align="center"><?php echo $totals['s_bar_abi']; ?></td>
            <td align="center"><?php echo $totals['s_nobar_dem']; ?></td><td align="center"><?php echo $totals['s_nobar_abi']; ?></td>
            <td>مجموع ابلاغی کشور</td>
            <td rowspan="3" align="center">ایران</td><td></td>
        </tr>
        <tr bgcolor="#E8F5E9">
            <td colspan="4"></td>
            <td align="center"><?php echo calc_percent($totals['city_bar_dem'], $totals['s_bar_dem']); ?></td>
            <td align="center"><?php echo calc_percent($totals['city_bar_abi'], $totals['s_bar_abi']); ?></td>
            <td align="center"><?php echo calc_percent($totals['city_nobar_dem'], $totals['s_nobar_dem']); ?></td>
            <td align="center"><?php echo calc_percent($totals['city_nobar_abi'], $totals['s_nobar_abi']); ?></td>
            <td>درصد کل برش شهرستانی</td><td></td>
        </tr>
        <tr bgcolor="#E8F5E9">
            <td colspan="4"></td>
            <td align="center"><?php echo calc_percent($totals['mar_bar_dem'], $totals['s_bar_dem']); ?></td>
            <td align="center"><?php echo calc_percent($totals['mar_bar_abi'], $totals['s_bar_abi']); ?></td>
            <td align="center"><?php echo calc_percent($totals['mar_nobar_dem'], $totals['s_nobar_dem']); ?></td>
            <td align="center"><?php echo calc_percent($totals['mar_nobar_abi'], $totals['s_nobar_abi']); ?></td>
            <td>درصد کل برش مراکز</td><td></td>
        </tr>
    </table>
<?php 
    } 
} 
?>
</body>
</html>