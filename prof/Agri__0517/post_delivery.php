<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

if(isset($_POST['delivery_amount']))
{
    $delivery_amount = test_input($_POST['delivery_amount']);
    $id_agri = test_input($_POST['id_agri']);
    $bah_cod_m = test_input($_POST['bah_cod_m']);
    $sh_gat = test_input($_POST['sh_gat']);
    $id_ostan = test_input($_POST['id_ostan']);
    $id_city = test_input($_POST['id_city']);
    $id_mar = test_input($_POST['id_mar']);
    $mor_cod_m = test_input($_POST['mor_cod_m']);
    $s_bar_a = test_input($_POST['s_bar_a']);
    $s_bar_b = test_input($_POST['s_bar_b']);
    $mah_tol = test_input($_POST['mah_tol']);
    $z_sal = test_input($_POST['z_sal']);
    
    include('../../login/config.php');
    
    // ایجاد جدول اگر وجود نداشته باشد
    $sql_create = "CREATE TABLE IF NOT EXISTS `delivery` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `id_ostan` varchar(2) DEFAULT NULL,
        `id_city` varchar(2) DEFAULT NULL,
        `id_mar` varchar(5) DEFAULT NULL,
        `mor_cod_m` varchar(20) NOT NULL,
        `bah_cod_m` varchar(20) NOT NULL,
        `Agri_id` int(11) NOT NULL,
        `s_bar_a` decimal(15,3) DEFAULT NULL,
        `s_bar_b` decimal(15,3) DEFAULT NULL,
        `mah_tol` decimal(15,3) DEFAULT NULL,
        `delivery_amount` decimal(15,3) DEFAULT NULL,
        `date_s` varchar(20) DEFAULT NULL,
        `time_s` varchar(20) DEFAULT NULL,
        `z_sal` varchar(20) DEFAULT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `Agri_id` (`Agri_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
    
    try {
        $dbh->exec($sql_create);
    } catch (PDOException $e) {
        // جدول احتمالاً وجود دارد
    }
    
    // بررسی اینکه آیا قبلاً ثبت شده
    $check_query = "SELECT id, delivery_amount FROM delivery WHERE Agri_id = ?";
    $check_stmt = $dbh->prepare($check_query);
    $check_stmt->execute(array($id_agri));
    $existing = $check_stmt->fetch(PDO::FETCH_ASSOC);
    
    if($existing) {
        // بروزرسانی - امکان ویرایش وجود دارد
        $query = "UPDATE delivery SET 
                    delivery_amount = ?,
                    date_s = ?,
                    time_s = ?,
                    s_bar_a = ?,
                    s_bar_b = ?,
                    mah_tol = ?
                  WHERE Agri_id = ?";
        $stmt = $dbh->prepare($query);
        $result = $stmt->execute(array(
            $delivery_amount,
            $date_edit,
            $time,
            $s_bar_a,
            $s_bar_b,
            $mah_tol,
            $id_agri
        ));
        
        if($result) {
            echo 'success';
        } else {
            echo 'خطا در بروزرسانی اطلاعات';
        }
    } else {
        // ثبت جدید
        $query = "INSERT INTO delivery (
                    id_ostan, id_city, id_mar, mor_cod_m, bah_cod_m, 
                    Agri_id, s_bar_a, s_bar_b, mah_tol, delivery_amount, 
                    date_s, time_s, z_sal
                  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($query);
        $result = $stmt->execute(array(
            $id_ostan,
            $id_city,
            $id_mar,
            $mor_cod_m,
            $bah_cod_m,
            $id_agri,
            $s_bar_a,
            $s_bar_b,
            $mah_tol,
            $delivery_amount,
            $date_edit,
            $time,
            $z_sal
        ));
        
        if($result) {
            echo 'success';
        } else {
            echo 'خطا در ثبت اطلاعات';
        }
    }
}
?>