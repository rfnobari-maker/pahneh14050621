<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
require_once('../../Jalali.php');
require_once('CropValidationService.php'); // Include the validation service

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

// --- Start: Check if $dbh is set and a valid PDO instance ---
if (!isset($dbh) || !($dbh instanceof PDO)) {
    echo 'خطا: اتصال به دیتابیس برقرار نشد. لطفاً فایل config.php را بررسی کنید.';
    exit;
}

// --- Main code: Check if $_POST["id"] is set ---
if (isset($_POST["id"])) {
    // --- Robust $_POST variable assignments with isset() and default values ---
    $id = isset($_POST["id"]) ? $_POST["id"] : null;
    $z_sal = isset($_POST["z_sal"]) ? $_POST["z_sal"] : null;
    $cod_qroup = isset($_POST["f_cod_qroup"]) ? $_POST["f_cod_qroup"] : null;
    $cod_mah = isset($_POST["f_cod_mah"]) ? $_POST["f_cod_mah"] : null;
    $zer_kesht_a = isset($_POST["f_zer_kesht_a"]) ? (float)$_POST["f_zer_kesht_a"] : 0.0;
    $zer_kesht_b = isset($_POST["f_zer_kesht_b"]) ? (float)$_POST["f_zer_kesht_b"] : 0.0;
    $mah_mas = $zer_kesht_a + $zer_kesht_b;
    $s_bar_a = isset($_POST["f_s_bar_a"]) ? (float)$_POST["f_s_bar_a"] : 0.0;
    $s_bar_b = isset($_POST["f_s_bar_b"]) ? (float)$_POST["f_s_bar_b"] : 0.0;
    $mah_tolp = isset($_POST["f_mah_tolp"]) ? (float)$_POST["f_mah_tolp"] : 0.0;
    $mah_tol = isset($_POST["f_mah_tol"]) ? (float)$_POST["f_mah_tol"] : 0.0;
    $mah_bem = isset($_POST["f_mah_bem"]) ? $_POST["f_mah_bem"] : 0.0;
    $mah_kh = isset($_POST["f_mah_kh"]) ? $_POST["f_mah_kh"] : 0.0;
    $Agri_id = isset($_POST["Agri_id"]) ? $_POST["Agri_id"] : '';
    $mor_cod_m = isset($_POST["mor_cod_m"]) ? $_POST["mor_cod_m"] : '';
    $no_kesh = isset($_POST["no_kesh"]) ? $_POST["no_kesh"] : '';
    $num_bah = isset($_POST["num_bah"]) ? $_POST["num_bah"] : '';
    $sh_gat = isset($_POST["sh_gat"]) ? $_POST["sh_gat"] : '';
    $add_abadi = isset($_POST["add_abadi"]) ? $_POST["add_abadi"] : '';
    $add_city = isset($_POST["add_city"]) ? $_POST["add_city"] : '';
    $bah_cod_m = isset($_POST["bah_cod_m"]) ? $_POST["bah_cod_m"] : '';

    // Old values (from client, for del_rec if needed, but del_rec SELECTs from DB)
    $cod_qroup_old = isset($_POST["f_cod_qroup_old"]) ? $_POST["f_cod_qroup_old"] : 0;
    $cod_mah_old = isset($_POST["f_cod_mah_old"]) ? $_POST["f_cod_mah_old"] : 0;
    $zer_kesht_a_old_from_client = isset($_POST["f_zer_kesht_a_old"]) ? (float)$_POST["f_zer_kesht_a_old"] : 0.0;
    $zer_kesht_b_old_from_client = isset($_POST["f_zer_kesht_b_old"]) ? (float)$_POST["f_zer_kesht_b_old"] : 0.0;
    $mah_tolp_old = isset($_POST["f_mah_tolp_old"]) ? (float)$_POST["f_mah_tolp_old"] : 0.0;

    // --- Initial validation for critical fields (from your provided file) ---
    if (!isset($cod_qroup) || !is_numeric($cod_qroup) || (int)$cod_qroup <= 0 ||
        !isset($cod_mah) || !is_numeric($cod_mah) || (int)$cod_mah <= 0) {
        echo 'خطا! نام گروه و محصول را بررسی کنید.';
        exit;
    }

    // Determine table names based on z_sal
    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
    $Agri_table = 'Agri' . str_replace('-', '_', $z_sal);

    try {
        // --- Start Database Transaction ---
        if (!($dbh instanceof PDO) || $dbh->inTransaction()) {
            throw new Exception("خطا در شروع تراکنش دیتابیس: شی PDO نامعتبر است یا تراکنش قبلاً آغاز شده است.");
        }
        $dbh->beginTransaction();

        // --- 1. Contract product validation logic ---
        $change = 0; // Flag for area reduction
		if (check_payesh($id,0,substr($z_sal, 0, 4)) == 2)
		{
                echo 'خطا! برای این رکورد از طریق سامانه پایش ، نهاده اختصاص داده شده ، ویرایش مقدور نمیباشد';
                throw new Exception("Contract product name changed.");
		}

        // --- 2. Validate cultivated area against allocation using CropValidationService ---
        $validationService = new CropValidationService($dbh);
        $validationResult = $validationService->validateCultivatedAreaAgainstAllocation(
            $id,            // $current_product_agri_prod_id
            $Agri_id,       // $agri_id_from_agri_table
            $cod_mah,       // $product_code
            $zer_kesht_a,   // $zer_kesht_a_new
            $zer_kesht_b,   // $zer_kesht_b_new
            $z_sal,         // $z_sal
            $id_ostan,      // $id_ostan
            $id_city,       // $id_city
            $id_mar,        // $id_mar
            $no_kesh,        // $no_kesh
			0.0             // **پارامتر جدید و مهم:** $current_batch_total باید صفر باشد
        );

        if (!$validationResult['isValid']) {
            echo $validationResult['message'];
            throw new Exception("Validation failed: " . $validationResult['message']);
        }

        // --- 3. Insert old record into del_rec (history of edit) ---
        $query_del_rec = "
            INSERT INTO `del_rec` (`Date`, `Table_id`, `Table_name`, `sal`, `bah_cod_m`, `mor_cod_m`, `cod_mah`, `date_s`, `num_bah`, `no_kesh`, `zer_kesht_a`, `zer_kesht_b`, `mah_tolp`, `add_abadi`, `add_city` , `Type_Op`)
            SELECT :Date, id, :Table_name, :sal, bah_cod_m, :mor_cod_m, cod_mah, date_s, num_bah, no_kesh, zer_kesht_a, zer_kesht_b, mah_tolp, add_abadi, add_city , :Type_Op
            FROM `$Agri_prod_table`
            WHERE id = :id_source
        ";
        $q_del_rec = $dbh->prepare($query_del_rec);
        $q_del_rec->execute(array(
            ':Date' => $date_edit,
            ':Table_name' => $Agri_prod_table,
            ':sal' => substr($z_sal, 0, 4), // Extract year
            ':mor_cod_m' => $login_session, // Assuming login_session is the user who performed the edit
            ':Type_Op' => '2', // Descriptive operation type
            ':id_source' => $id
        ));

        // --- 4. Update record in Agri_prod_table ---
        $updateQuery = "
            UPDATE `$Agri_prod_table`
            SET
                date_s = ?, cod_qroup = ?, cod_mah = ?, zer_kesht_a = ?, zer_kesht_b = ?,
                s_bar_a = ?, s_bar_b = ?, mah_tolp = ?, mah_tol = ?, mah_bem = ?,
                mah_kh = ?, id_mar = ?, no_kesh = ?, id_ostan = ?, id_city = ?, add_abadi = ?, add_city = ?, bah_cod_m = ?
            WHERE id = ?
        ";
        $updateStmt = $dbh->prepare($updateQuery);

        $updateStmt->execute(array(
            $date_edit, $cod_qroup, $cod_mah, $zer_kesht_a, $zer_kesht_b, $s_bar_a, $s_bar_b, $mah_tolp, $mah_tol, $mah_bem, $mah_kh,$id_mar
			, $no_kesh, $id_ostan, $id_city, $add_abadi, $add_city, $bah_cod_m, $id
        ));

        // --- 5. Update product count in main Agri table ---
        $updateAgriTableQuery = "
            UPDATE `$Agri_table`
            SET t_mah = (SELECT COUNT(*) FROM `$Agri_prod_table` WHERE Agri_id = :agri_id_subquery),
                date_s = :date_s_update
            WHERE id = :id_update
        ";
        $updateAgriTableStmt = $dbh->prepare($updateAgriTableQuery);
        $updateAgriTableStmt->execute(array(
            ':agri_id_subquery' => $Agri_id,
            ':date_s_update' => $date_edit,
            ':id_update' => $Agri_id
        ));

        // --- 6. Log event ---
        sabt_event(
            $login_session,
            $_SERVER['REMOTE_ADDR'],
            $date_edit,
            $time,
            $add_abadi,
            'ویرایش محصول زراعی /' . substr($z_sal, 0, 4) . '/' . $sh_gat . '/' . $bah_cod_m,
            $id_ostan
        );

        // Commit transaction
        $dbh->commit();
        echo 'اطلاعات محصولات با موفقیت ویرایش شدند.';

    } catch (PDOException $e) {
        // Rollback transaction on PDO error
        if ($dbh instanceof PDO && $dbh->inTransaction()) {
            $dbh->rollBack();
        }
        echo 'خطا در ویرایش اطلاعات: ' . $e->getMessage();

    } catch (Exception $e) {
        // Rollback transaction on custom logic error (e.g., validation failure)
        if ($dbh instanceof PDO && $dbh->inTransaction()) {
            $dbh->rollBack();
        }
        // Message already echoed before throwing, so no need to echo here.
    }
} else {
    echo "شناسه محصول برای ویرایش ارسال نشده است.";
}
?>