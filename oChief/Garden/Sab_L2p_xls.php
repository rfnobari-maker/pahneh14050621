<?php 
// تنظیم هدر برای خروجی اکسل
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=الگوی_کشت_باغی_ابلاغی.xls");

include('../../lock_oce.php');
include('../../event.php');

// دریافت متغیرها
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
$id_ostan = $_SESSION['id_ostan']; // دریافت شناسه استان از سشن

?>
<html xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        table, td, th { border: 1px solid #000; border-collapse: collapse; text-align: center; }
        .head-row { background-color: #006699; color: #ffffff; font-weight: bold; }
        .sub-head { background-color: #006699; color: #ffffff; }
    </style>
</head>
<body>

<div align="center" style="font-family: Tahoma; font-size: 14px; font-weight: bold; margin-bottom: 20px;">
    برنامه الگوی کشت ابلاغی محصول <?php echo isset($mah_name) ? mah_name_bagh($mah_name) : ''; ?> در سال <?php echo($z_sal)?>
</div>

<?php
if (isset($_POST['z_sal']) && !empty($id_ostan)) 
{  
    include('../../login/config.php') ;
    
    // کوئری اصلاح شده برای خواندن از جدول باغی (Garden_ab_city)
    $query = "
        SELECT a.*, o.city
        FROM Garden_ab_city a
        JOIN cityname o ON a.id_ostan = o.id_ostan AND a.id_city = o.id_city
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
    
    $t_row = $stmt->rowCount(); 
    
    if ($t_row > 0) {
?>
    <table width="100%" border="1">
        <tr class="head-row">
            <td colspan="2" height="30">عملکرد / کیلوگرم در هکتار</td>
            <td colspan="2">تولید / تن</td>
            <td colspan="2">سطح کل بارور / هکتار</td>
            <td colspan="2">سطح کل غیر بارور / هکتار</td>
            <td width="15%" rowspan="2">شهرستان</td>
            <td width="5%" rowspan="2">ردیف</td>
        </tr>
        <tr class="sub-head">
            <td width="10%">دیم</td>
            <td width="10%">آبی</td>
            <td width="10%">دیم</td>
            <td width="10%">آبی</td>
            <td width="10%">دیم</td>
            <td width="10%">آبی</td>
            <td width="10%">دیم</td>
            <td width="10%">آبی</td>
        </tr>
        
        <?php 
        $r = 1;
        foreach($stmt as $row){ 
            // تعیین رنگ پس‌زمینه برای خوانایی بهتر (یک درمیان)
            $bg_color = ($r % 2 == 0) ? '#FFFFCC' : '#FFFFFF';
        ?>
        <tr bgcolor="<?php echo $bg_color; ?>">
            <td><?php echo $row['a_dem']*1; ?></td>
            <td><?php echo $row['a_abi']*1; ?></td>
            
            <td><?php echo $row['t_dem']*1; ?></td>
            <td><?php echo $row['t_abi']*1; ?></td>
            
            <td><?php echo $row['s_bar_dem']*1; ?></td>
            <td><?php echo $row['s_bar_abi']*1; ?></td>
            
            <td><?php echo $row['s_nobar_dem']*1; ?></td>
            <td><?php echo $row['s_nobar_abi']*1; ?></td>
            
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $r; ?></td>
        </tr>
        <?php 
            $r++; 
        }
        ?>
    </table>
<?php 
    } else {
        echo '<p dir="rtl" align="center">اطلاعاتی یافت نشد.</p>';
    }
}
?>
</body>
</html>