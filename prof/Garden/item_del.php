<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

if (isset($_POST['id']) && isset($_POST['z_sal'])) {
    
    $id = $_POST['id'];
    $z_sal = $_POST['z_sal'];

    $payesh_status = check_payesh($id, 1, substr($z_sal, 0, 4));
    if ($payesh_status == 2) {
        echo 'خطا! برای این محصول از طریق سامانه پایش، نهاده اختصاص داده شده و حذف مقدور نیست.';
        exit;
    }
    if ($payesh_status == 0) {
        echo 'ارتباط با وب سرویس سامانه پایش برقرار نشد، بعداً بررسی کنید.';
        exit;
    }
    
    $Garden_table = 'Garden';
    $Garden_prod_table = 'Garden_prod';
    
    try {
        $dbh->beginTransaction();
        
        // ابتدا اطلاعات محصول را دریافت کن
        $query = "SELECT Garden_id, bah_cod_m, sh_gat, cod_mah, add_abadi, add_city, num_bah, no_kesh, nah_kesh, date_s, id_ostan, s_kesht_b, s_kesht_gb, tree_b, tree_gb, mah_tolp, mah_tol, mah_bem, mah_kh FROM `$Garden_prod_table` WHERE id = :id";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {
            if ($dbh->inTransaction()) {
                $dbh->rollBack();
            }
            echo "رکورد یافت نشد.";
            exit;
        }
        
        $garden_id = $row['Garden_id'];
        $bah_cod_m = $row['bah_cod_m'];
        $sh_gat = $row['sh_gat'];
        $cod_mah = $row['cod_mah'];
        $add_abadi = $row['add_abadi'];
        $add_city = $row['add_city'];
        $id_ostan = $row['id_ostan'];
        
        // ثبت در جدول تاریخچه del_rec_Garden
        $query_del_rec = "
            INSERT INTO `del_rec_Garden` (`Date`, `Table_id`, `Table_name`, `sal`, `bah_cod_m`, `mor_cod_m`, `cod_mah`, `date_s`, `num_bah`, `no_kesh`, `nah_kesh`, `s_kesht_b`, `s_kesht_gb`, `tree_b`, `tree_gb`, `mah_tolp`, `mah_tol`, `mah_bem`, `mah_kh`, `add_abadi`, `add_city`, `Type_Op`)
            VALUES (:Date, :Table_id, :Table_name, :sal, :bah_cod_m, :mor_cod_m, :cod_mah, :date_s, :num_bah, :no_kesh, :nah_kesh, :s_kesht_b, :s_kesht_gb, :tree_b, :tree_gb, :mah_tolp, :mah_tol, :mah_bem, :mah_kh, :add_abadi, :add_city, :Type_Op)
        ";
        $q_del_rec = $dbh->prepare($query_del_rec);
        $q_del_rec->execute(array(
            ':Date' => $date_edit,
            ':Table_id' => $id,
            ':Table_name' => $Garden_prod_table,
            ':sal' => substr($z_sal, 0, 4),
            ':bah_cod_m' => $bah_cod_m,
            ':mor_cod_m' => $login_session,
            ':cod_mah' => $cod_mah,
            ':date_s' => $row['date_s'],
            ':num_bah' => $row['num_bah'],
            ':no_kesh' => $row['no_kesh'],
            ':nah_kesh' => $row['nah_kesh'],
            ':s_kesht_b' => $row['s_kesht_b'],
            ':s_kesht_gb' => $row['s_kesht_gb'],
            ':tree_b' => $row['tree_b'],
            ':tree_gb' => $row['tree_gb'],
            ':mah_tolp' => $row['mah_tolp'],
            ':mah_tol' => $row['mah_tol'],
            ':mah_bem' => $row['mah_bem'],
            ':mah_kh' => $row['mah_kh'],
            ':add_abadi' => $add_abadi,
            ':add_city' => $add_city,
            ':Type_Op' => '3'  // 3 = حذف
        ));
        
        // حذف محصول از جدول اصلی
        $sql = "DELETE FROM `$Garden_prod_table` WHERE id = :id";
        $cust = $dbh->prepare($sql);
        $cust->execute(array(':id' => $id));

        $query_update = "UPDATE `$Garden_table`
                        SET t_mah = (SELECT COUNT(*) FROM `$Garden_prod_table` WHERE Garden_id = :garden_id_subquery),
                            date_s = :date_s_update
                        WHERE id = :id_update";
        $q_update = $dbh->prepare($query_update);
        $q_update->execute(array(
            ':garden_id_subquery' => $garden_id,
            ':date_s_update' => $date_edit,
            ':id_update' => $garden_id
        ));
        
        // ثبت رویداد
        sabt_event(
            $login_session,
            $_SERVER['REMOTE_ADDR'],
            $date_edit,
            $time,
            $add_abadi,
            'حذف محصول باغی /' . $z_sal . '/' . $sh_gat . '/' . $bah_cod_m,
            $id_ostan
        );
        
        $dbh->commit();
        echo 'success';
        
    } catch (PDOException $e) {
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
        }
        echo 'خطا در حذف محصول: ' . $e->getMessage();
    }
} else {
    echo "شناسه محصول یا سال برای حذف ارسال نشده است.";
}
?>