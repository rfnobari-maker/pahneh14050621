<?php
include('../../lock_p1.php');
// اطمینان از شروع نشست
if (session_id() == '') {
    session_start();
}

// بررسی وجود نشست کاربر
$user_logged_in = false;
$login_session_checked = '';

if (isset($_SESSION['username']) && !empty($_SESSION['username']) && isset($karbar_m) && $karbar_m == '1') {
    $user_logged_in = true;
    $login_session_checked = $_SESSION['username'];
}

// اگر کاربر لاگین نیست، خطا بده
if (!$user_logged_in) {
    error_log("[INSERT_BLOCKED] User not logged in - IP: " . $_SERVER['REMOTE_ADDR']);
    echo 'نشست کاربری شما معتبر نیست. لطفاً صفحه را بازخوانی کرده و دوباره تلاش کنید.';
    exit;
}
// پایان  اطمینان از شروع نشست
include('../../event.php');
include('../../login/config.php');
require_once('../../Jalali.php');
require_once('CropValidationService.php');
require_once('PreviousYearClearanceChecker.php'); // اضافه شده

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

if (isset($_POST["f_cod_qroup"])) {
if (isset($_POST['honeypot-field']) && !empty($_POST['honeypot-field'])) {
    echo 'دسترسی ممنوع: این ارسال توسط یک ربات انجام شده است.';
    exit(); 
}
    $cod_qroup = $_POST["f_cod_qroup"];
    $cod_mah = $_POST["f_cod_mah"];
    $zer_kesht_a = $_POST["f_zer_kesht_a"];
    $zer_kesht_b = $_POST["f_zer_kesht_b"];
    $s_bar_a = $_POST["f_s_bar_a"];
    $s_bar_b = $_POST["f_s_bar_b"];
    $mah_tolp = $_POST["f_mah_tolp"];
    $mah_tol = $_POST["f_mah_tol"];
    $mah_bem = $_POST["f_mah_bem"];
    $mah_kh = $_POST["f_mah_kh"];
    $id_mar = $_POST["id_mar"];
    $Agri_id = $_POST["Agri_id"];
    $mor_cod_m = $_POST["mor_cod_m"];
    $id_ostan = $_POST["id_ostan"];
    $id_city = $_POST["id_city"];
    $num_bah = $_POST["num_bah"];
    $sh_gat = $_POST["sh_gat"];
    $no_kesh = $_POST["no_kesh"];
    $z_sal = $_POST["z_sal"];
    $add_abadi = $_POST["add_abadi"];
    $add_city = $_POST["add_city"];
    $bah_cod_m = $_POST["bah_cod_m"];

    // ============================================================
    // قانون جدید: بررسی تعیین‌تکلیف سال قبل (فقط برای زراعی)
    // ============================================================
    $clearanceChecker = new PreviousYearClearanceChecker($dbh, $bah_cod_m, $mor_cod_m, $z_sal, 'agri');
    $clearanceResult = $clearanceChecker->check();
    
    if ($clearanceResult['has_uncleared']) {
        echo $clearanceResult['message'];
        exit;
    }
    // ============================================================

    $Agri_table = 'Agri' . str_replace('-', '_', $z_sal);
    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

    $validationService = new CropValidationService($dbh);
    
    $valid_products_placeholders = array();
    $valid_products_params = array();
    $error_messages = array();
    $batch_cumulative_sums = array();
 $product_map = array('103' => '102','107' => '106','176' => '490','178' => '490', '180' => '490', '182' => '490', '184' => '490',
 '186' => '490','188' => '490','190' => '490','192' => '490', '194' => '490','196' => '490','198' => '490','200' => '490','414' => '490',
 '416' => '490','418' => '490','420' => '490','422' => '490','424' => '490','426' => '490','428' => '490','430' => '490','432' => '490',
 '434' => '490','436' => '490','438' => '490','440' => '490','442' => '490','444' => '490','446' => '490','448' => '490','449' => '490',
 '464' => '490','150' => '148');
    foreach ($cod_qroup as $count => $value) {
		// --- بخش اضافه شده برای کنترل سطح کشت همزمان ---
        if ((float)$zer_kesht_a[$count] > 0 && (float)$zer_kesht_b[$count] > 0) {
            $error_messages[] = "محصول در ردیف " . ($count + 1) . ": امکان ثبت همزمان سطح زیر کشت اول و دوم مقدور نیست.";
            continue; // پرش به محصول بعدی و عدم ثبت این ردیف
        }
        // ----------------------------------------------
		// --- بخش اضافه شده برای کنترل سطح برداشت همزمان ---
        if ((float)$s_bar_a[$count] > 0 && (float)$s_bar_b[$count] > 0) {
            $error_messages[] = "محصول در ردیف " . ($count + 1) . ": امکان ثبت همزمان سطح برداشت اول و دوم مقدور نیست.";
            continue; // پرش به محصول بعدی و عدم ثبت این ردیف
        }
        // ----------------------------------------------
        // شرط اصلاح‌شده برای بررسی دقیق فیلدهای خالی
        if (
            !empty($value) && is_numeric($value) && (int)$value > 0 &&
            !empty($cod_mah[$count]) && is_numeric($cod_mah[$count]) && (int)$cod_mah[$count] > 0 &&
            $zer_kesht_a[$count] !== '' && $zer_kesht_b[$count] !== '' &&
            $s_bar_a[$count] !== '' && $s_bar_b[$count] !== '' &&
            $mah_tolp[$count] !== '' && $mah_tol[$count] !== '' &&
            $mah_bem[$count] !== '' && $mah_kh[$count] !== ''
        ) {
            $current_product_code = $cod_mah[$count];
            $current_cultivated_area = (float)$zer_kesht_a[$count] + (float)$zer_kesht_b[$count];
            
            // اصلاح کلید برای نگهداری مجموع تجمعی
            $final_product_code_for_sum = isset($product_map[$current_product_code]) ? $product_map[$current_product_code] : $current_product_code;
            $key_for_sum = $final_product_code_for_sum . '-' . $no_kesh;

            $current_batch_total = isset($batch_cumulative_sums[$key_for_sum]) ? $batch_cumulative_sums[$key_for_sum] : 0.0;

            $validationResult = $validationService->validateCultivatedAreaAgainstAllocation(
                null,
                $Agri_id,
                $current_product_code,
                (float)$zer_kesht_a[$count],
                (float)$zer_kesht_b[$count],
                $z_sal,
                $id_ostan,
                $id_city,
                $id_mar,
                $no_kesh,
                $current_batch_total
            );

            if ($validationResult['isValid']) {
                $mah_mas_current = $current_cultivated_area;
                $valid_products_placeholders[] = '(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

                array_push(
                    $valid_products_params,
                    $date_edit,$cod_qroup[$count], $current_product_code, (float)$zer_kesht_a[$count], (float)$zer_kesht_b[$count],
                    (float)$s_bar_a[$count], (float)$s_bar_b[$count], (float)$mah_tolp[$count], (float)$mah_tol[$count],$mah_bem[$count],
                    $mah_kh[$count],$id_mar, (int)$Agri_id,$mor_cod_m,$no_kesh,$id_ostan,$id_city,
                    $num_bah,$sh_gat, $z_sal,$add_abadi,$add_city,$bah_cod_m, $mah_mas_current
                );
                
                $batch_cumulative_sums[$key_for_sum] = $current_batch_total + $current_cultivated_area;

            } else {
                $error_messages[] = "محصول : " . mah_name($current_product_code) . " (ردیف " . ($count + 1) . "): " . $validationResult['message'];
            }
        } else {
            $error_messages[] = "محصول در ردیف " . ($count + 1) . ": خطا! نام گروه یا محصول نامعتبر یا فیلدهای ضروری خالی هستند.";
        }
    }

    try {
        $dbh->beginTransaction();

        if (!empty($valid_products_placeholders)) {
            $insert_query_sql = 'INSERT INTO `' . $Agri_prod_table . '`
                (date_s, cod_qroup, cod_mah, zer_kesht_a, zer_kesht_b, s_bar_a, s_bar_b, mah_tolp, mah_tol, mah_bem,
                mah_kh, id_mar, Agri_id, mor_cod_m, no_kesh, id_ostan, id_city, num_bah, sh_gat, z_sal,
                add_abadi, add_city, bah_cod_m, mah_mas)
                VALUES ' . implode(', ', $valid_products_placeholders);

            $stmt = $dbh->prepare($insert_query_sql);
            $stmt->execute($valid_products_params);

            $updateQuery = "UPDATE `$Agri_table`
                            SET t_mah = (SELECT COUNT(*) FROM `$Agri_prod_table` WHERE Agri_id = :agri_id_subquery),
                                date_s = :date_s_update
                            WHERE id = :id_update";
            $updateStmt = $dbh->prepare($updateQuery);
            $updateStmt->execute(array(':agri_id_subquery' => $Agri_id, ':date_s_update' => $date_edit, ':id_update' => $Agri_id));

            sabt_event(
                $login_session,
                $_SERVER['REMOTE_ADDR'],
                $date_edit,
                $time,
                $add_abadi,
                'ثبت محصول زراعی /' . substr($z_sal, 0, 4) . '/' . $sh_gat . '/' . $bah_cod_m . ' (شامل ' . count($valid_products_placeholders) . ' محصول)',
                $id_ostan
            );

            $dbh->commit();
            echo 'اطلاعات ' . count($valid_products_placeholders) . ' محصول با موفقیت ثبت شدند.' . "\n";
        } else {
            echo 'خطا: هیچ محصول معتبری برای ثبت یافت نشد.' . "\n";
        }

        if (!empty($error_messages)) {
            echo "خطا /خطاهای موجود :\n";
            foreach ($error_messages as $error) {
                echo "- " . $error . "\n";
            }
        }

    } catch (PDOException $e) {
        $dbh->rollBack();
        echo 'خطا در ثبت اطلاعات در پایگاه داده: ' . $e->getMessage() . "\n";
        if (!empty($error_messages)) {
            echo "علاوه بر این، خطاهای زیر در طول اعتبارسنجی اولیه رخ داده بودند:\n";
            foreach ($error_messages as $error) {
                echo "- " . $error . "\n";
            }
        }
    }
} else {
    echo 'خطا! پارامترهای مورد نیاز ارسال نشده‌اند.';
}
?>