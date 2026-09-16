<?php
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=الگوی_کشت_باغی.xls");

include('../../lock_cp.php');
include('../../event.php');
include('../../login/config.php');

$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div align="center" style="font-family: Tahoma; font-weight: bold;">برنامه الگوی کشت ابلاغی محصول <?php echo mah_name_bagh($mah_name)?>  در سال  <?php echo $z_sal; ?></div>
<?php
if (isset($_POST['z_sal'])) {
    // کوئری منطبق بر ساختار محصولات باغی (Sab_L1_Prod.php)
    $query = "
        SELECT 
            o.id_ostan, o.product_cod, o.z_sal,
            o.s_bar_dem, o.s_bar_abi, o.s_nobar_dem, o.s_nobar_abi,
            o.t_dem, o.t_abi, o.a_dem, o.a_abi,
            osn.ostan,
            IFNULL(c.total_city_s_bar_dem,0) AS c_bar_d, IFNULL(c.total_city_s_bar_abi,0) AS c_bar_a,
            IFNULL(c.total_city_s_nobar_dem,0) AS c_nobar_d, IFNULL(c.total_city_s_nobar_abi,0) AS c_nobar_a,
            IFNULL(m.total_marakez_s_bar_dem,0) AS m_bar_d, IFNULL(m.total_marakez_s_bar_abi,0) AS m_bar_a,
            IFNULL(m.total_marakez_s_nobar_dem,0) AS m_nobar_d, IFNULL(m.total_marakez_s_nobar_abi,0) AS m_nobar_a
        FROM Garden_ab_ostan o
        JOIN ostanname osn ON o.id_ostan = osn.id_ostan
        LEFT JOIN (
            SELECT id_ostan, product_cod,
                SUM(s_bar_dem) AS total_city_s_bar_dem, SUM(s_bar_abi) AS total_city_s_bar_abi,
                SUM(s_nobar_dem) AS total_city_s_nobar_dem, SUM(s_nobar_abi) AS total_city_s_nobar_abi
            FROM Garden_ab_city 
            WHERE z_sal = :z_sal AND group_cod = :mah_qroup AND product_cod = :mah_name
            GROUP BY id_ostan, product_cod
        ) c ON o.id_ostan = c.id_ostan AND o.product_cod = c.product_cod
        LEFT JOIN (
            SELECT id_ostan, product_cod,
                SUM(s_bar_dem) AS total_marakez_s_bar_dem, SUM(s_bar_abi) AS total_marakez_s_bar_abi,
                SUM(s_nobar_dem) AS total_marakez_s_nobar_dem, SUM(s_nobar_abi) AS total_marakez_s_nobar_abi
            FROM Garden_ab_mar 
            WHERE z_sal = :z_sal AND group_cod = :mah_qroup AND product_cod = :mah_name
            GROUP BY id_ostan, product_cod
        ) m ON o.id_ostan = m.id_ostan AND o.product_cod = m.product_cod
        WHERE o.z_sal = :z_sal AND o.group_cod = :mah_qroup AND o.product_cod = :mah_name
        ORDER BY FIELD(o.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')";

    $stmt = $dbh->prepare($query);
    $stmt->execute(array(
        ':z_sal'     => $z_sal,
        ':mah_qroup' => $mah_qroup,
        ':mah_name'  => $mah_name
    ));

    if ($stmt->rowCount() > 0) {
?>
    <table border="1">
        <tr bgcolor="#CCCCCC">
            <td colspan="3" align="center">درصد تحقق برش مرکز (بارور)</td>
            <td colspan="3" align="center">درصد تحقق برش شهرستانی (بارور)</td>
            <td colspan="2" align="center">تولید / تن</td>
            <td colspan="2" align="center">سطح ابلاغی بارور / هکتار</td>
            <td colspan="2" align="center">سطح ابلاغی غیربارور / هکتار</td>
            <td width="13%" rowspan="2" align="center">استان</td>
            <td width="5%" rowspan="2" align="center">ردیف</td>
        </tr>
        <tr bgcolor="#CCCCCC">
            <td width="5%" align="center">کل</td>
            <td width="6%" align="center">دیم</td>
            <td width="7%" align="center">آبی</td>
            <td width="5%" align="center">کل</td>
            <td width="10%" align="center">دیم</td>
            <td width="10%" align="center">آبی</td>
            <td width="11%" align="center">دیم</td>
            <td width="9%" align="center">آبی</td>
            <td width="10%" align="center">دیم</td>
            <td width="9%" align="center">آبی</td>
            <td width="10%" align="center">دیم</td>
            <td width="9%" align="center">آبی</td>
        </tr>
<?php
        $r = 1;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // محاسبات درصد تحقق مشابه فایل اصلی
            $sum_bar_abi_dem = $row['s_bar_abi'] + $row['s_bar_dem'];
            
            $p_mar_all = ($sum_bar_abi_dem > 0) ? round((($row['m_bar_a'] + $row['m_bar_d']) * 100 / $sum_bar_abi_dem), 1) : 0;
            $p_mar_d   = ($row['s_bar_dem'] > 0) ? round(($row['m_bar_d'] * 100 / $row['s_bar_dem']), 1) : 0;
            $p_mar_a   = ($row['s_bar_abi'] > 0) ? round(($row['m_bar_a'] * 100 / $row['s_bar_abi']), 1) : 0;

            $p_city_all = ($sum_bar_abi_dem > 0) ? round((($row['c_bar_a'] + $row['c_bar_d']) * 100 / $sum_bar_abi_dem), 1) : 0;
            $p_city_d   = ($row['s_bar_dem'] > 0) ? round(($row['c_bar_d'] * 100 / $row['s_bar_dem']), 1) : 0;
            $p_city_a   = ($row['s_bar_abi'] > 0) ? round(($row['c_bar_a'] * 100 / $row['s_bar_abi']), 1) : 0;

            $bg = ($r % 2 == 0) ? 'bgcolor="#FFFFCC"' : '';
?>
        <tr <?php echo $bg; ?>>
            <td align="center"><?php echo $p_mar_all; ?></td>
            <td align="center"><?php echo $p_mar_d; ?></td>
            <td align="center"><?php echo $p_mar_a; ?></td>
            <td align="center"><?php echo $p_city_all; ?></td>
            <td align="center"><?php echo $p_city_d; ?></td>
            <td align="center"><?php echo $p_city_a; ?></td>
            <td align="center"><?php echo $row['t_dem'] * 1; ?></td>
            <td align="center"><?php echo $row['t_abi'] * 1; ?></td>
            <td align="center"><?php echo $row['s_bar_dem'] * 1; ?></td>
            <td align="center"><?php echo $row['s_bar_abi'] * 1; ?></td>
            <td align="center"><?php echo $row['s_nobar_dem'] * 1; ?></td>
            <td align="center"><?php echo $row['s_nobar_abi'] * 1; ?></td>
            <td align="center"><?php echo $row['ostan']; ?></td>
            <td align="center"><?php echo $r; ?></td>
        </tr>
<?php
            $r++;
        }
    }
}
?>
    </table>
</body>
</html>