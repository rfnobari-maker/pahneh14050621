<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=الگوی_کشت_باغی_شهرستان.xls");
include('../../lock_oce.php');
include('../../event.php');

$id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
?>
<div align="center" dir="rtl">
    برنامه الگوی کشت ابلاغی محصولات باغی شهرستان <?php echo city_name1($id_city,$id_ostan) ?> در سال  <?php echo($z_sal)?>
</div>
<?php
if (isset($_POST['z_sal']) && !empty($id_city)) 
{  
    include('../../login/config.php');
    
    // کوئری برای استخراج اطلاعات باغی از جدول Garden_ab_city
    $query = "SELECT * FROM Garden_ab_city 
              WHERE z_sal = :zs AND id_ostan = :io AND id_city = :ic 
              AND (s_bar_abi > 0 OR s_bar_dem > 0 OR s_nobar_abi > 0 OR s_nobar_dem > 0) 
              ORDER BY product_name ASC";
              
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':zs' => $z_sal, ':io' => $id_ostan, ':ic' => $id_city));
    $t_row = $stmt->rowCount();
    
    if ($t_row > 0) { 
?>
    <table width="100%" border="0" dir="rtl">
        <tr class="text1">
            <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">عملکرد (کیلوگرم)</td>
            <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">تولید (تن)</td>
            <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">سطح بارور (هکتار)</td>
            <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">سطح غیربارور (هکتار)</td>
            <td colspan="2" height="35" bgcolor="#CCCCCC" style="text-align: center">مشخصات محصول</td>
            <td width="5%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">ردیف</td>
        </tr>
        <tr class="text1">
            <td bgcolor="#CCCCCC" style="text-align: center">دیم</td>
            <td bgcolor="#CCCCCC" style="text-align: center">آبی</td>
            <td bgcolor="#CCCCCC" style="text-align: center">دیم</td>
            <td bgcolor="#CCCCCC" style="text-align: center">آبی</td>
            <td bgcolor="#CCCCCC" style="text-align: center">دیم</td>
            <td bgcolor="#CCCCCC" style="text-align: center">آبی</td>
            <td bgcolor="#CCCCCC" style="text-align: center">دیم</td>
            <td bgcolor="#CCCCCC" style="text-align: center">آبی</td>
            <td bgcolor="#CCCCCC" style="text-align: center">نام محصول</td>
            <td bgcolor="#CCCCCC" style="text-align: center">گروه</td>
        </tr>
        <?php 
        $r = 1;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
            $bg = ($r % 2 == 0) ? 'bgcolor="#FFFFCC"' : '';
        ?>
        <tr>
            <td align="center" <?php echo $bg; ?>><?php echo $row['a_dem'] * 1; ?></td>
            <td align="center" <?php echo $bg; ?>><?php echo $row['a_abi'] * 1; ?></td>
            <td align="center" <?php echo $bg; ?>><?php echo $row['t_dem'] * 1; ?></td>
            <td align="center" <?php echo $bg; ?>><?php echo $row['t_abi'] * 1; ?></td>
            <td align="center" <?php echo $bg; ?>><?php echo $row['s_bar_dem'] * 1; ?></td>
            <td align="center" <?php echo $bg; ?>><?php echo $row['s_bar_abi'] * 1; ?></td>
            <td align="center" <?php echo $bg; ?>><?php echo $row['s_nobar_dem'] * 1; ?></td>
            <td align="center" <?php echo $bg; ?>><?php echo $row['s_nobar_abi'] * 1; ?></td>
            <td align="center" <?php echo $bg; ?>><?php echo $row['product_name']; ?></td>
            <td align="center" <?php echo $bg; ?>><?php echo $row['group_name']; ?></td>
            <td align="center" <?php echo $bg; ?>><?php echo $r++; ?></td>
        </tr>
        <?php 
        } 
        ?>
    </table>
<?php 
    } else {
        echo '<div align="center" dir="rtl">اطلاعاتی یافت نشد.</div>';
    }
}
?>