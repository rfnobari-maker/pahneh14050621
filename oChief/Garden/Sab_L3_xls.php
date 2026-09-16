<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=الگوی_کشت_ابلاغی_باغی_مرکز.xls");
include('../../lock_oce.php');
include('../../event.php');

$id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city  = isset($_POST['id_city'])  ? $_POST['id_city']  : '';
$z_sal    = isset($_POST['z_sal'])    ? $_POST['z_sal']    : '';
$id_mar   = isset($_POST['id_mar'])   ? $_POST['id_mar']   : '';
?>
<div align="center" style="font-family: Tahoma; font-size: 14px;">
    برنامه الگوی کشت ابلاغی محصولات <b>باغی</b> مرکز جهاد کشاورزی <?php echo mar_name($id_mar) ?> 
    شهرستان <?php echo city_name1($id_city,$id_ostan) ?> در سال زراعی <?php echo($z_sal)?>
</div><br />

<?php
if (isset($_POST['z_sal'])) 
{  
    include('../../login/config.php');
    // تغییر کوئری به جدول باغی مرکز و اصلاح فیلتر سطوح
    $query = "SELECT * FROM Garden_ab_mar 
              WHERE z_sal = '$z_sal' AND id_ostan = '$id_ostan' AND id_city = '$id_city' AND id_mar = '$id_mar' 
              AND (s_bar_abi > 0 OR s_bar_dem > 0 OR s_nobar_abi > 0 OR s_nobar_dem > 0) 
              ORDER BY product_name ASC"; 
    
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) { 
?>
    <table width="100%" border="1" style="font-family: Tahoma; font-size: 12px; border-collapse: collapse;">
        <tr style="background-color: #CCCCCC; font-weight: bold; text-align: center;">
            <td colspan="2">عملکرد (کیلوگرم)</td>
            <td colspan="2">تولید (تن)</td>
            <td colspan="2">سطح بارور (هکتار)</td>
            <td colspan="2">سطح غیربارور (هکتار)</td>
            <td rowspan="2">نام محصول</td>
            <td width="5%" rowspan="2">ردیف</td>
        </tr>
        <tr style="background-color: #CCCCCC; font-weight: bold; text-align: center;">
            <td>دیم</td><td>آبی</td>
            <td>دیم</td><td>آبی</td>
            <td>دیم</td><td>آبی</td>
            <td>دیم</td><td>آبی</td>
        </tr>
        
        <?php 
        $r = 1;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
            $bg = ($r % 2 == 0) ? 'bgcolor="#FFFFCC"' : 'bgcolor="#FFFFFF"';
        ?>
        <tr <?php echo $bg; ?> style="text-align: center;">
            <td><?php echo $row['a_dem']*1 ?></td>
            <td><?php echo $row['a_abi']*1 ?></td>
            <td><?php echo $row['t_dem']*1 ?></td>
            <td><?php echo $row['t_abi']*1 ?></td>
            <td><?php echo $row['s_bar_dem']*1 ?></td>
            <td><?php echo $row['s_bar_abi']*1 ?></td>
            <td><?php echo $row['s_nobar_dem']*1 ?></td>
            <td><?php echo $row['s_nobar_abi']*1 ?></td>
            <td align="right"><?php echo $row['product_name'] ?></td>
            <td><?php echo $r++; ?></td>
        </tr>
        <?php 
        }
        ?>
    </table>
<?php 
    } else {
        echo '<div align="center">اطلاعاتی برای این مرکز یافت نشد.</div>';
    }
}
?>