<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=الگوی_تولید_باغی_شهرستان.xls");
include('../../lock_ce.php');
include('../../event.php');

$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';

?>
<div align="center" dir="rtl" style="font-family: Tahoma;">
    گزارش برش الگوی کشت محصولات باغی به تفکیک شهرستان برای محصول <?php echo mah_name_bagh($mah_name);?> در سال زراعی <?php echo($z_sal)?>
</div>

<?php
if (isset($_POST['z_sal']) && !empty($mah_qroup) && !empty($mah_name) && !empty($id_ostan1)) 
{  
    include('../../login/config.php') ;

    // کوئری منطبق بر محصولات باغی (Sab_L2_Prod)
    $query = "
    SELECT 
        c.id_city, c.city,
        a.s_bar_dem, a.s_bar_abi, a.s_nobar_dem, a.s_nobar_abi,
        a.t_dem, a.t_abi, a.a_dem, a.a_abi,
        IFNULL(m.m_s_bar_dem, 0) AS m_s_bar_dem,
        IFNULL(m.m_s_bar_abi, 0) AS m_s_bar_abi,
        IFNULL(m.m_s_nobar_dem, 0) AS m_s_nobar_dem,
        IFNULL(m.m_s_nobar_abi, 0) AS m_s_nobar_abi
    FROM cityname c
    LEFT JOIN Garden_ab_city a ON c.id_city = a.id_city AND a.z_sal = :zs AND a.product_cod = :pn
    LEFT JOIN (
        SELECT id_city, 
            SUM(s_bar_dem) as m_s_bar_dem, SUM(s_bar_abi) as m_s_bar_abi,
            SUM(s_nobar_dem) as m_s_nobar_dem, SUM(s_nobar_abi) as m_s_nobar_abi
        FROM Garden_ab_mar 
        WHERE z_sal = :zs AND product_cod = :pn
        GROUP BY id_city
    ) m ON c.id_city = m.id_city
    WHERE c.id_ostan = :io
    ORDER BY BINARY c.city ASC";

    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':zs' => $z_sal, ':pn' => $mah_name, ':io' => $id_ostan1));

    if ($stmt->rowCount() > 0) { 
?>
    <table width="100%" border="1" dir="rtl">
        <tr style="background-color: #006699; color: #FFFFFF; font-weight: bold; text-align: center;">
            <td colspan="2">عملکرد</td>
            <td colspan="2">تولید</td>
            <td colspan="2">سطح بارور</td>
            <td colspan="2">سطح غیربارور</td>
            <td rowspan="2">عنوان محاسباتی</td>
            <td rowspan="2">شهرستان</td>
            <td rowspan="2">ردیف</td>
        </tr>
        <tr style="background-color: #006699; color: #FFFFFF; font-weight: bold; text-align: center;">
            <td>دیم</td><td>آبی</td>
            <td>دیم</td><td>آبی</td>
            <td>دیم</td><td>آبی</td>
            <td>دیم</td><td>آبی</td>
        </tr>
        <?php
        $r = 1;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // محاسبات تراز منطبق بر فایل اصلی
            $diff_s_bar_dem = $row['s_bar_dem'] - $row['m_s_bar_dem'];
            $diff_s_bar_abi = $row['s_bar_abi'] - $row['m_s_bar_abi'];
            $diff_s_nobar_dem = $row['s_nobar_dem'] - $row['m_s_nobar_dem'];
            $diff_s_nobar_abi = $row['s_nobar_abi'] - $row['m_s_nobar_abi'];
            
            $bg = ($r % 2 == 0) ? 'bgcolor="#FFFFCC"' : 'bgcolor="#FFFFFF"';
        ?>
        <tr <?php echo $bg; ?> style="font-weight:bold;">
            <td align="center"><?php echo $row['a_dem']*1; ?></td>
            <td align="center"><?php echo $row['a_abi']*1; ?></td>
            <td align="center"><?php echo $row['t_dem']*1; ?></td>
            <td align="center"><?php echo $row['t_abi']*1; ?></td>
            <td align="center"><?php echo $row['s_bar_dem']*1; ?></td>
            <td align="center"><?php echo $row['s_bar_abi']*1; ?></td>
            <td align="center"><?php echo $row['s_nobar_dem']*1; ?></td>
            <td align="center"><?php echo $row['s_nobar_abi']*1; ?></td>
            <td align="right" bgcolor="#EAEAEA">برش ابلاغی شهرستان</td>
            <td rowspan="3" align="center"><?php echo $row['city']; ?></td>
            <td rowspan="3" align="center"><?php echo $r++; ?></td>
        </tr>
        <tr <?php echo $bg; ?>>
            <td colspan="4"></td>
            <td align="center"><?php echo $row['m_s_bar_dem']*1; ?></td>
            <td align="center"><?php echo $row['m_s_bar_abi']*1; ?></td>
            <td align="center"><?php echo $row['m_s_nobar_dem']*1; ?></td>
            <td align="center"><?php echo $row['m_s_nobar_abi']*1; ?></td>
            <td align="right">مجموع برش مراکز</td>
        </tr>
        <tr <?php echo $bg; ?> style="font-weight:bold;">
            <td colspan="4"></td>
            <td align="center" style="color:<?php echo ($diff_s_bar_dem >= 0) ? 'green' : 'red'; ?>"><?php echo $diff_s_bar_dem; ?></td>
            <td align="center" style="color:<?php echo ($diff_s_bar_abi >= 0) ? 'green' : 'red'; ?>"><?php echo $diff_s_bar_abi; ?></td>
            <td align="center" style="color:<?php echo ($diff_s_nobar_dem >= 0) ? 'green' : 'red'; ?>"><?php echo $diff_s_nobar_dem; ?></td>
            <td align="center" style="color:<?php echo ($diff_s_nobar_abi >= 0) ? 'green' : 'red'; ?>"><?php echo $diff_s_nobar_abi; ?></td>
            <td align="right">تراز مراکز</td>
        </tr>
        <?php 
        }
    }
}
?>
    </table>