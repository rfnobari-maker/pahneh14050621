<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
require_once('../../Jalali.php');
require_once('CropValidationService.php');

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

if (isset($_POST["id"])) {
    
    $id = isset($_POST["id"]) ? $_POST["id"] : null;
    $z_sal = isset($_POST["z_sal"]) ? $_POST["z_sal"] : null;
    $cod_qroup = isset($_POST["f_cod_qroup"]) ? $_POST["f_cod_qroup"] : null;
    $cod_mah = isset($_POST["f_cod_mah"]) ? $_POST["f_cod_mah"] : null;
    $s_kesht_b = isset($_POST["f_s_kesht_b"]) ? (float)$_POST["f_s_kesht_b"] : 0.0;
    $s_kesht_gb = isset($_POST["f_s_kesht_gb"]) ? (float)$_POST["f_s_kesht_gb"] : 0.0;
    $tree_b = isset($_POST["f_tree_b"]) ? (int)$_POST["f_tree_b"] : 0;
    $tree_gb = isset($_POST["f_tree_gb"]) ? (int)$_POST["f_tree_gb"] : 0;
    $mah_tolp = isset($_POST["f_mah_tolp"]) ? (float)$_POST["f_mah_tolp"] : 0.0;
    $mah_tol = isset($_POST["f_mah_tol"]) ? (float)$_POST["f_mah_tol"] : 0.0;
    $mah_bem = isset($_POST["f_mah_bem"]) ? $_POST["f_mah_bem"] : '2';
    $mah_kh = isset($_POST["f_mah_kh"]) ? $_POST["f_mah_kh"] : '2';
    $Garden_id = isset($_POST["Garden_id"]) ? $_POST["Garden_id"] : '';
    $mor_cod_m = isset($_POST["mor_cod_m"]) ? $_POST["mor_cod_m"] : '';
    $id_ostan = isset($_POST["id_ostan"]) ? $_POST["id_ostan"] : '';
    $id_city = isset($_POST["id_city"]) ? $_POST["id_city"] : '';
    $id_mar = isset($_POST["id_mar"]) ? $_POST["id_mar"] : '';
    $no_kesh = isset($_POST["no_kesh"]) ? $_POST["no_kesh"] : '';
    $nah_kesh = isset($_POST["nah_kesh"]) ? $_POST["nah_kesh"] : '';
    $num_bah = isset($_POST["num_bah"]) ? $_POST["num_bah"] : '';
    $sh_gat = isset($_POST["sh_gat"]) ? $_POST["sh_gat"] : '';
    $add_abadi = isset($_POST["add_abadi"]) ? $_POST["add_abadi"] : '';
    $add_city = isset($_POST["add_city"]) ? $_POST["add_city"] : '';
    $bah_cod_m = isset($_POST["bah_cod_m"]) ? $_POST["bah_cod_m"] : '';

    // ========== اگر نحوه کشت "درختان پراکنده" است، سطح کشت را 0 قرار بده ==========
    if ($nah_kesh == '3') {
        $s_kesht_b = 0;
        $s_kesht_gb = 0;
        if ($tree_b == 0 && $tree_gb == 0) {
            echo "خطا: در نحوه کشت درختان پراکنده ثبت محصول بدون تعداد درخت مجاز نیست.";
            exit;
        }
    } else {
        if ($s_kesht_b == 0 && $s_kesht_gb == 0 && $tree_b == 0 && $tree_gb == 0) {
            echo "خطا: ثبت محصول بدون سطح کشت و تعداد درخت مجاز نیست.";
            exit;
        }
        if ($s_kesht_b <= 0 && $tree_b > 0) {
            echo 'امکان ثبت تعداد درخت بارور بدون ثبت سطح کشت بارور وجود ندارد.';
            exit;
        }
        if ($s_kesht_gb <= 0 && $tree_gb > 0) {
            echo 'امکان ثبت تعداد درخت غیربارور بدون ثبت سطح کشت غیربارور وجود ندارد.';
            exit;
        }
    }
    // ========== پایان ==========

    $Garden_prod_table = 'Garden_prod';
    $Garden_table = 'Garden';
    
    // ======== دریافت مستقیم Garden_id از دیتابیس ========
    $query_get_garden = "SELECT Garden_id FROM `$Garden_prod_table` WHERE id = :id";
    $stmt_garden = $dbh->prepare($query_get_garden);
    $stmt_garden->execute(array(':id' => $id));
    $garden_row_temp = $stmt_garden->fetch(PDO::FETCH_ASSOC);
    $real_garden_id = $garden_row_temp['Garden_id'];
    
    if (!$real_garden_id) {
        echo "خطا: باغ مربوط به این محصول یافت نشد.";
        exit;
    }
    // ======== پایان دریافت Garden_id ========
    
    // ======== اعتبارسنجی تراز مساحت (فقط برای نحوه کشت غیر پراکنده) ========
    if ($nah_kesh != '3') {
        $query_check_area = "SELECT m_zamin FROM `$Garden_table` WHERE id = :garden_id";
        $stmt_check = $dbh->prepare($query_check_area);
        $stmt_check->bindValue(':garden_id', $real_garden_id);
        $stmt_check->execute();
        $garden_row = $stmt_check->fetch(PDO::FETCH_ASSOC);
        $m_zamin_server = (float)$garden_row['m_zamin'];
        
        $query_sum_area = "SELECT SUM(s_kesht_b + s_kesht_gb) AS total_area FROM `$Garden_prod_table` WHERE Garden_id = :garden_id AND id != :current_id";
        $stmt_sum = $dbh->prepare($query_sum_area);
        $stmt_sum->bindValue(':garden_id', $real_garden_id);
        $stmt_sum->bindValue(':current_id', $id);
        $stmt_sum->execute();
        $sum_row = $stmt_sum->fetch(PDO::FETCH_ASSOC);
        $current_total_area = (float)$sum_row['total_area'];
        
        $new_area = $s_kesht_b + $s_kesht_gb;
        $overall_total = $current_total_area + $new_area;
        
        if ($overall_total > $m_zamin_server) {
            echo "خطا: مجموع سطح کشت (" . number_format($overall_total, 2) . " هکتار) از مساحت کل زمین (" . number_format($m_zamin_server, 2) . " هکتار) بیشتر است.";
            exit;
        }
    }
    // ======== پایان اعتبارسنجی تراز مساحت ========
    
    // اعتبارسنجی اولیه
    if (!isset($cod_qroup) || !is_numeric($cod_qroup) || (int)$cod_qroup <= 0 ||
        !isset($cod_mah) || !is_numeric($cod_mah) || (int)$cod_mah <= 0) {
        echo 'خطا! نام گروه و محصول را بررسی کنید.';
        exit;
    }

    $stmt_dup = $dbh->prepare("SELECT id FROM `$Garden_prod_table` WHERE Garden_id = :gid AND cod_mah = :cod AND id != :id LIMIT 1");
    $stmt_dup->execute(array(
        ':gid' => $real_garden_id,
        ':cod' => $cod_mah,
        ':id' => $id
    ));
    if ($stmt_dup->fetch(PDO::FETCH_ASSOC)) {
        echo 'این محصول در این قطعه فقط یک‌بار قابل ثبت است.';
        exit;
    }
    
    // برای نحوه کشت درختان پراکنده، سطح کشت نباید ثبت شود
    if ($nah_kesh == '3') {
        if ($s_kesht_b > 0 || $s_kesht_gb > 0) {
            echo 'خطا! در نحوه کشت "درختان پراکنده" ثبت سطح کشت مجاز نیست.';
            exit;
        }
        $validationServicePattern = new CropValidationService($dbh);
        $patternCheck = $validationServicePattern->validateProductExistsInAllocation(
            $cod_mah,
            $z_sal,
            $id_ostan,
            $id_city,
            $id_mar
        );
        if (!$patternCheck['isValid']) {
            echo $patternCheck['message'];
            exit;
        }
    }
    
    try {
        $dbh->beginTransaction();
        
        // بررسی محدودیت پایش
        $stmt_old = $dbh->prepare("SELECT cod_qroup, cod_mah, s_kesht_b, s_kesht_gb FROM `$Garden_prod_table` WHERE id = ?");
        $stmt_old->execute(array($id));
        $oldData = $stmt_old->fetch(PDO::FETCH_ASSOC);
        
        if (!$oldData) {
            echo "رکورد یافت نشد.";
            throw new Exception("Record not found");
        }
        
        if (check_payesh($id, 1, substr($z_sal, 0, 4)) == 2) {
            if ($cod_qroup != $oldData['cod_qroup'] ||
                $cod_mah != $oldData['cod_mah'] ||
                $s_kesht_b != $oldData['s_kesht_b'] ||
                $s_kesht_gb != $oldData['s_kesht_gb']) {
                echo 'خطا! برای این رکورد از طریق سامانه پایش، نهاده اختصاص داده شده و تغییر در گروه، محصول یا سطح کشت مجاز نمی‌باشد.';
                throw new Exception("Payesh restriction");
            }
        }
        
        // ======== اعتبارسنجی سطح کشت و تولید (فقط برای نحوه کشت غیر پراکنده) ========
        if ($nah_kesh != '3') {
            $validationService = new CropValidationService($dbh);
            
            // اعتبارسنجی سطح کشت
            $validationResult = $validationService->validateCultivatedAreaAgainstAllocation(
                $id,
                $real_garden_id,
                $cod_mah,
                $s_kesht_b,
                $s_kesht_gb,
                $z_sal,
                $id_ostan,
                $id_city,
                $id_mar,
                $no_kesh,
                0,
                0
            );
            
            if (!$validationResult['isValid']) {
                echo $validationResult['message'];
                throw new Exception("Validation failed: " . $validationResult['message']);
            }
            
            // اعتبارسنجی حداکثر تولید پیش‌بینی (فقط سطح بارور)
            if ($mah_tolp > 0) {
                $validationResultTolp = $validationService->validateProductionLimit(
                    $cod_mah,
                    $s_kesht_b,
                    $mah_tolp,
                    $no_kesh,
                    'pishbini'
                );
                if (!$validationResultTolp['isValid']) {
                    echo $validationResultTolp['message'];
                    throw new Exception("Production validation failed");
                }
            }
            
            // اعتبارسنجی حداکثر تولید قطعی (فقط سطح بارور)
            if ($mah_tol > 0) {
                $validationResultTol = $validationService->validateProductionLimit(
                    $cod_mah,
                    $s_kesht_b,
                    $mah_tol,
                    $no_kesh,
                    'ghatii'
                );
                if (!$validationResultTol['isValid']) {
                    echo $validationResultTol['message'];
                    throw new Exception("Production validation failed");

                }
            }
        }
        // ======== پایان اعتبارسنجی ========
        
        // درج رکورد قبلی در جدول تاریخچه del_rec_Garden
        $query_del_rec = "
            INSERT INTO `del_rec_Garden` (`Date`, `Table_id`, `Table_name`, `sal`, `bah_cod_m`, `mor_cod_m`, `cod_mah`, `date_s`, `num_bah`, `no_kesh`, `nah_kesh`, `s_kesht_b`, `s_kesht_gb`, `tree_b`, `tree_gb`, `mah_tolp`, `mah_tol`, `mah_bem`, `mah_kh`, `add_abadi`, `add_city`, `Type_Op`)
            SELECT :Date, id, :Table_name, :sal, bah_cod_m, :mor_cod_m, cod_mah, date_s, num_bah, no_kesh, nah_kesh, s_kesht_b, s_kesht_gb, tree_b, tree_gb, mah_tolp, mah_tol, mah_bem, mah_kh, add_abadi, add_city, :Type_Op
            FROM `$Garden_prod_table`
            WHERE id = :id_source
        ";
        $q_del_rec = $dbh->prepare($query_del_rec);
        $q_del_rec->execute(array(
            ':Date' => $date_edit,
            ':Table_name' => $Garden_prod_table,
            ':sal' => substr($z_sal, 0, 4),
            ':mor_cod_m' => $login_session,
            ':Type_Op' => '2',
            ':id_source' => $id
        ));
        
        // بروزرسانی رکورد در جدول Garden_prod
        $updateQuery = "
            UPDATE `$Garden_prod_table`
            SET
                date_s = ?, cod_qroup = ?, cod_mah = ?, s_kesht_b = ?, s_kesht_gb = ?,
                tree_b = ?, tree_gb = ?, mah_tolp = ?, mah_tol = ?, mah_bem = ?, mah_kh = ?,
                id_mar = ?, no_kesh = ?, nah_kesh = ?, id_ostan = ?, id_city = ?, 
                add_abadi = ?, add_city = ?, bah_cod_m = ?
            WHERE id = ?
        ";
        $updateStmt = $dbh->prepare($updateQuery);
        $updateStmt->execute(array(
            $date_edit, $cod_qroup, $cod_mah, $s_kesht_b, $s_kesht_gb,
            $tree_b, $tree_gb, $mah_tolp, $mah_tol, $mah_bem, $mah_kh,
            $id_mar, $no_kesh, $nah_kesh, $id_ostan, $id_city,
            $add_abadi, $add_city, $bah_cod_m, $id
        ));
        
        // بروزرسانی تعداد محصولات در جدول Garden
        $updateGardenTableQuery = "
            UPDATE `$Garden_table`
            SET t_mah = (SELECT COUNT(*) FROM `$Garden_prod_table` WHERE Garden_id = :garden_id_subquery),
                date_s = :date_s_update
            WHERE id = :id_update
        ";
        $updateGardenTableStmt = $dbh->prepare($updateGardenTableQuery);
        $updateGardenTableStmt->execute(array(
            ':garden_id_subquery' => $real_garden_id,
            ':date_s_update' => $date_edit,
            ':id_update' => $real_garden_id
        ));
        
        // ثبت رویداد
        sabt_event(
            $login_session,
            $_SERVER['REMOTE_ADDR'],
            $date_edit,
            $time,
            $add_abadi,
            'ویرایش محصول باغی /' . $z_sal . '/' . $sh_gat . '/' . $bah_cod_m,
            $id_ostan
        );
        
        $dbh->commit();
        echo 'اطلاعات محصول با موفقیت ویرایش شد.';
        
    } catch (PDOException $e) {
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
        }
        echo 'خطا در ویرایش اطلاعات: ' . $e->getMessage();
    } catch (Exception $e) {
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
        }
    }
} else {
    echo "شناسه محصول برای ویرایش ارسال نشده است.";
}
?>