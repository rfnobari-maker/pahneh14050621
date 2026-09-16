<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_تحویل_گندم.xls");

include("../../lock_p1.php");
include_once("../../event.php");
require_once('../../Jalali.php');

// دریافت پارامترها از POST
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city   = isset($_POST['id_city5']) ? $_POST['id_city5'] : '';
$id_mar    = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city  = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh   = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$dis       = isset($_POST['dis']) ? $_POST['dis'] : '';

// ساخت نام جدول
if ($z_sal != '') {
    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
} else {
    die('سال زراعی مشخص نشده است');
}

// تابع برای دریافت اطلاعات بهره بردار (اگر در event.php نباشد)
if (!function_exists('bah_info')) {
    function bah_info($bah_cod_m) {
        global $dbh;
        try {
            $query = "SELECT name, last_name FROM users WHERE username = :bah_cod_m";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : array('name' => '', 'last_name' => '');
        } catch (Exception $e) {
            return array('name' => '', 'last_name' => '');
        }
    }
}

// تابع برای دریافت نام مرکز (اگر در event.php نباشد)
if (!function_exists('mar_name')) {
    function mar_name($id_mar) {
        global $dbh;
        try {
            $query = "SELECT mar FROM mar WHERE id_mar = :id_mar";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':id_mar' => $id_mar));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return isset($row['mar']) ? $row['mar'] : '';
        } catch (Exception $e) {
            return '';
        }
    }
}

// تابع برای دریافت نام شهرستان (اگر در event.php نباشد)
if (!function_exists('city_name')) {
    function city_name($id_city) {
        global $dbh;
        try {
            $query = "SELECT city FROM cityname WHERE id_city = :id_city";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':id_city' => $id_city));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return isset($row['city']) ? $row['city'] : '';
        } catch (Exception $e) {
            return '';
        }
    }
}

// تابع برای دریافت نام آبادی (اگر در event.php نباشد)
if (!function_exists('abadi_name')) {
    function abadi_name($add_abadi) {
        global $dbh;
        if ($add_abadi == '0' || $add_abadi == '') return '';
        try {
            $query = "SELECT abadi FROM list_abadi WHERE add_abadi = :add_abadi";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':add_abadi' => $add_abadi));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return isset($row['abadi']) ? $row['abadi'] : '';
        } catch (Exception $e) {
            return '';
        }
    }
}

// تابع برای دریافت نام محصول (اگر در event.php نباشد)
if (!function_exists('mah_name')) {
    function mah_name($cod_mah) {
        global $dbh;
        try {
            $query = "SELECT product_name FROM product_z WHERE product_cod = :cod_mah";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':cod_mah' => $cod_mah));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return isset($row['product_name']) ? $row['product_name'] : $cod_mah;
        } catch (Exception $e) {
            return $cod_mah;
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>گزارش تحویل گندم</title>
    <style>
        body { font-family: Tahoma, Arial, sans-serif; direction: rtl; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #0099CC; padding: 5px; text-align: center; }
        th { background-color: #999999; color: #fff; font-weight: bold; }
        .total-row { background-color: #CCCCCC; font-weight: bold; }
        .even-row { background-color: #FFFFCC; }
        .header-title { font-size: 16px; font-weight: bold; text-align: center; margin-bottom: 10px; }
        .footer-info { text-align: center; font-size: 11px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="header-title">گزارش میزان تحویل گندم به دولت</div>
    <?php 
    try {
        // ساخت شرط‌های جستجو
        if ($id_ostan1 == '-1' || $id_ostan1 == '') { 
            $v_id_ostan = '1=1'; 
        } else { 
            $v_id_ostan = "a.id_ostan = " . intval($id_ostan1); 
        }
        
        if ($id_city == '0' || $id_city == '') { 
            $v_id_city = '1=1'; 
        } else { 
            $v_id_city = "a.id_city = " . intval($id_city); 
        }
        
        if ($id_mar == '0' || $id_mar == '') { 
            $v_id_mar = '1=1'; 
        } else { 
            $v_id_mar = "a.id_mar = " . intval($id_mar); 
        }
        
        if ($add_abadi == '0' || $add_abadi == '') { 
            $f_add_abadi = '1=1'; 
        } else { 
            $f_add_abadi = "a.add_abadi = '" . addslashes($add_abadi) . "'"; 
        }
        
        if ($add_city == '0' || $add_city == '') { 
            $f_add_city = '1=1'; 
        } else { 
            $f_add_city = "a.add_city = '" . addslashes($add_city) . "'"; 
        }
        
        if ($no_kesh == '0' || $no_kesh == '') { 
            $f_no_kesh = '1=1'; 
        } else { 
            $f_no_kesh = "a.no_kesh = " . intval($no_kesh); 
        }
        
        if ($mor_cod_m == '') { 
            $v_mor_cod_m = '1=1'; 
        } else { 
            $v_mor_cod_m = "a.mor_cod_m = '" . addslashes($mor_cod_m) . "'"; 
        }
        
        if ($bah_cod_m == '') { 
            $v_bah_cod_m = '1=1'; 
        } else { 
            $v_bah_cod_m = "a.bah_cod_m = '" . addslashes($bah_cod_m) . "'"; 
        }
        
        if ($z_sal == '') { 
            $v_z_sal = '1=1'; 
        } else { 
            $v_z_sal = "a.z_sal = '" . addslashes($z_sal) . "'"; 
        }
        
        // شرط محصولات 102 و 103
        $v_cod_mah = "cod_mah IN (102, 103)";
        
        // شرط mah_tol > 0
        $v_mah_tol = "a.mah_tol > 0";
        
        // شرط نمایش
        if ($dis == '1') { 
            $v_dis = '1=1'; 
        } else { 
            $v_dis = "a.id NOT IN (SELECT Agri_id FROM delivery WHERE Agri_id IS NOT NULL)";
        }

        // بررسی وجود جدول
        $check_table = "SHOW TABLES LIKE '$Agri_prod_table'";
        $stmt_check = $dbh->prepare($check_table);
        $stmt_check->execute();
        if ($stmt_check->rowCount() == 0) {
            die('جدول مورد نظر وجود ندارد');
        }

        // کوئری اصلی
        $query = "SELECT a.id,a.mor_cod_m,a.bah_cod_m,a.sh_gat,a.no_kesh,a.cod_mah,a.zer_kesht_a,a.zer_kesht_b,a.mah_tolp,a.s_bar_a,a.s_bar_b,a.mah_tol,a.add_abadi,a.mah_kh,a.id_ostan,a.id_ostan,a.id_city,a.id_mar,
                  d.delivery_amount 
                  FROM $Agri_prod_table a
                  LEFT JOIN delivery d ON a.id = d.Agri_id
                  WHERE $v_id_ostan AND $v_id_city AND $v_id_mar AND $f_add_abadi AND $f_add_city 
                  AND $f_no_kesh AND $v_mor_cod_m AND $v_bah_cod_m AND $v_z_sal AND $v_cod_mah AND $v_mah_tol AND $v_dis 
                  ORDER BY a.bah_cod_m,a.sh_gat ASC";
        
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        
        if ($stmt->rowCount() == 0) {
            echo '<p style="text-align:center; color:red;">اطلاعاتی یافت نشد</p>';
        } else {
            $r = 1;
            $total_delivery = 0;
            $total_production = 0;
    ?>
    <table>
        <tr>
          <th colspan="2">کارشناس</th>
            <th rowspan="2">میزان تحویلی<br>به دولت (تن)</th>
            <th rowspan="2">میزان تولید قطعی<br>(تن)</th>
            <th colspan="2">سطح برداشت (هکتار)</th>
            <th rowspan="2">نام محصول</th>
            <th rowspan="2">نوع کشت</th>
            <th rowspan="2">شماره قطعه</th>
            <th colspan="2">مشخصات بهره بردار</th>
            <th rowspan="2">نام آبادی</th>
            <th rowspan="2">مرکز</th>
            <th rowspan="2">شهرستان</th>
            <th rowspan="2">ردیف</th>
        </tr>
        <tr>
          <th>کد ملی </th>
          <th>نام و نام خانوادگی</th>
          <th>دوم</th>
            <th>اول</th>
            <th>کد ملی</th>
            <th>نام و نام خانوادگی</th>
        </tr>
        <?php 
        foreach($stmt as $row){
            if ($row['no_kesh']=='1') $v_no_kesh='آبی';     
            elseif ($row['no_kesh']=='2') $v_no_kesh='دیم';
            else $v_no_kesh='';
            
            $delivery_val = isset($row['delivery_amount']) ? floatval($row['delivery_amount']) : 0;
            $total_delivery += $delivery_val;
            $total_production += floatval($row['mah_tol']);
            
            // دریافت اطلاعات بهره بردار
            $bah_info = bah_info($row['bah_cod_m']);
        ?>
        <tr <?php if($r%2 == 0) echo 'class="even-row"'; ?>>
          <td><?php echo $row['mor_cod_m']?></td>
          <td><?php echo user_name($row['mor_cod_m'])?></td>
          <td><?php echo number_format($delivery_val, 2); ?></td>
            <td><?php echo number_format(floatval($row['mah_tol']), 2); ?></td>
            <td><?php echo number_format(floatval($row['s_bar_b']), 2); ?></td>
            <td><?php echo number_format(floatval($row['s_bar_a']), 2); ?></td>
            <td><?php echo mah_name($row['cod_mah']); ?></td>
            <td><?php echo $v_no_kesh; ?></td>
            <td><?php echo htmlspecialchars($row['sh_gat']); ?></td>
            <td><?php echo htmlspecialchars($row['bah_cod_m']); ?></td>
            <td><?php echo bah_name($row['bah_cod_m'])?></td>
            <td><?php echo abadi_name($row['add_abadi']); ?></td>
            <td><?php echo mar_name($row['id_mar']); ?></td>
            <td><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
            <td><?php echo $r; ?></td>
        </tr>
        <?php 
            $r++;
        }
        ?>
        <!-- ردیف جمع کل -->
        <tr class="total-row">
          <td colspan="2">&nbsp;</td>
            <td><?php echo number_format($total_delivery, 2); ?></td>
            <td><?php echo number_format($total_production, 2); ?></td>
            <td colspan="11">جمع کل</td>
        </tr>
    </table>
    <div class="footer-info">
        تاریخ تهیه گزارش: <?php echo function_exists('jdate') ? jdate("Y/m/d") : date("Y/m/d"); ?> - <?php echo date('H:i:s'); ?>
    </div>
    <?php 
        }
    } catch (PDOException $e) {
        echo '<p style="text-align:center; color:red;">خطا در دریافت اطلاعات: ' . htmlspecialchars($e->getMessage()) . '</p>';
    } catch (Exception $e) {
        echo '<p style="text-align:center; color:red;">خطا: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
    ?>
</body>
</html>