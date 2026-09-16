<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');
require_once('../../Jalali.php');
require_once('CropValidationService.php');

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

if (isset($_POST["f_cod_qroup"]) && is_array($_POST["f_cod_qroup"])) {
    
    if (isset($_POST['honeypot-field']) && !empty($_POST['honeypot-field'])) {
        echo 'دسترسی ممنوع: این ارسال توسط یک ربات انجام شده است.';
        exit();
    }
    
    $cod_qroup = $_POST["f_cod_qroup"];
    $cod_mah = $_POST["f_cod_mah"];
    $s_kesht_b = $_POST["f_s_kesht_b"];
    $s_kesht_gb = $_POST["f_s_kesht_gb"];
    $tree_b = $_POST["f_tree_b"];
    $tree_gb = $_POST["f_tree_gb"];
    $mah_tolp = $_POST["f_mah_tolp"];
    $mah_tol = $_POST["f_mah_tol"];
    $mah_bem = isset($_POST["f_mah_bem"]) ? $_POST["f_mah_bem"] : array();
    $mah_kh = isset($_POST["f_mah_kh"]) ? $_POST["f_mah_kh"] : array();
    $id_mar = $_POST["id_mar"];
    $Garden_id = $_POST["Garden_id"];
    $mor_cod_m = $_POST["mor_cod_m"];
    $id_ostan = $_POST["id_ostan"];
    $id_city = $_POST["id_city"];
    $num_bah = $_POST["num_bah"];
    $sh_gat = $_POST["sh_gat"];
    $no_kesh = $_POST["no_kesh"];
    $nah_kesh = $_POST["nah_kesh"];
    $z_sal = $_POST["z_sal"];
    $add_abadi = $_POST["add_abadi"];
    $add_city = $_POST["add_city"];
    $bah_cod_m = $_POST["bah_cod_m"];
    $m_zamin = isset($_POST["m_zamin"]) ? $_POST["m_zamin"] : 0;
    
    $Garden_table = 'Garden';
    $Garden_prod_table = 'Garden_prod';
    
    $validationService = new CropValidationService($dbh);
    
    $valid_products_placeholders = array();
    $valid_products_params = array();
    $error_messages = array();
    $batch_cumulative_sums = array();
    $existing_product_codes = array();
    $batch_product_codes = array();
    $stmt_exist = $dbh->prepare("SELECT cod_mah FROM `$Garden_prod_table` WHERE Garden_id = :gid");
    $stmt_exist->execute(array(':gid' => $Garden_id));
    while ($ex = $stmt_exist->fetch(PDO::FETCH_ASSOC)) {
        $existing_product_codes[$ex['cod_mah']] = true;
    }
    
    // ========== اگر نحوه کشت "درختان پراکنده" است، سطح کشت را 0 قرار بده ==========
    if ($nah_kesh == '3') {
        foreach ($s_kesht_b as $index => $value) {
            $s_kesht_b[$index] = 0;
            $s_kesht_gb[$index] = 0;
        }
    }
    // ========== پایان ==========
    
    // ========== بررسی تراز مساحت در سمت سرور (فقط برای نحوه کشت غیر پراکنده) ==========
    if ($nah_kesh != '3') {
        $query_check_area = "SELECT m_zamin FROM `$Garden_table` WHERE id = :garden_id";
        $stmt_check = $dbh->prepare($query_check_area);
        $stmt_check->bindValue(':garden_id', $Garden_id);
        $stmt_check->execute();
        $garden_row = $stmt_check->fetch(PDO::FETCH_ASSOC);
        $m_zamin_server = (float)$garden_row['m_zamin'];

        $query_sum_area = "SELECT SUM(s_kesht_b + s_kesht_gb) AS total_area FROM `$Garden_prod_table` WHERE Garden_id = :garden_id";
        $stmt_sum = $dbh->prepare($query_sum_area);
        $stmt_sum->bindValue(':garden_id', $Garden_id);
        $stmt_sum->execute();
        $sum_row = $stmt_sum->fetch(PDO::FETCH_ASSOC);
        $current_total_area = (float)$sum_row['total_area'];

        $new_rows_total = 0;
        foreach ($s_kesht_b as $index => $value) {
            $new_rows_total += (float)$s_kesht_b[$index] + (float)$s_kesht_gb[$index];
        }

        $overall_total = $current_total_area + $new_rows_total;

        if ($overall_total > $m_zamin_server) {
            echo "خطا: مجموع سطح کشت جدید (" . number_format($overall_total, 2) . " هکتار) از مساحت کل زمین (" . number_format($m_zamin_server, 2) . " هکتار) بیشتر است.";
            exit;
        }
    }
    // ========== پایان بررسی تراز مساحت ==========
    
    $count = 0;
    foreach ($cod_qroup as $value) {
        
        // ========== برای نحوه کشت "درختان پراکنده" (nah_kesh=3) ==========
        if ($nah_kesh == '3') {
            if (
                empty($value) || !is_numeric($value) || (int)$value <= 0 ||
                empty($cod_mah[$count]) || !is_numeric($cod_mah[$count]) || (int)$cod_mah[$count] <= 0
            ) {
                $error_messages[] = "محصول در ردیف " . ($count + 1) . ": خطا! نام گروه یا محصول نامعتبر است.";
                $count++;
                continue;
            }

            // بررسی سطح کشت (نباید ثبت شود)
            if ((float)$s_kesht_b[$count] > 0 || (float)$s_kesht_gb[$count] > 0) {
                $error_messages[] = "محصول در ردیف " . ($count + 1) . ": در نحوه کشت 'درختان پراکنده' ثبت سطح کشت مجاز نیست.";
                $count++;
                continue;
            }

            if ((float)$tree_b[$count] == 0 && (float)$tree_gb[$count] == 0) {
                $error_messages[] = "محصول در ردیف " . ($count + 1) . ": در نحوه کشت درختان پراکنده ثبت محصول بدون تعداد درخت مجاز نیست.";
                $count++;
                continue;
            }

            $current_product_code = $cod_mah[$count];
            $patternCheck = $validationService->validateProductExistsInAllocation(
                $current_product_code,
                $z_sal,
                $id_ostan,
                $id_city,
                $id_mar
            );
            if (!$patternCheck['isValid']) {
                $error_messages[] = "محصول : " . mah_name($current_product_code) . " (ردیف " . ($count + 1) . "): " . $patternCheck['message'];
                $count++;
                continue;
            }

            if (isset($existing_product_codes[$current_product_code]) || isset($batch_product_codes[$current_product_code])) {
                $error_messages[] = "محصول : " . mah_name($current_product_code) . " (ردیف " . ($count + 1) . "): این محصول در این قطعه فقط یک‌بار قابل ثبت است.";
                $count++;
                continue;
            }
            $batch_product_codes[$current_product_code] = true;
            
            // مقداردهی پیش‌فرض برای mah_bem و mah_kh
            $bem_val = (isset($mah_bem[$count]) && $mah_bem[$count] !== '') ? $mah_bem[$count] : '2';
            $kh_val = (isset($mah_kh[$count]) && $mah_kh[$count] !== '') ? $mah_kh[$count] : '2';
            
            $valid_products_placeholders[] = '(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            
            array_push(
                $valid_products_params,
                $date_edit,
                $cod_qroup[$count],
                $current_product_code,
                0,  // s_kesht_b
                0,  // s_kesht_gb
                (float)$tree_b[$count],
                (float)$tree_gb[$count],
                (float)$mah_tolp[$count],
                (float)$mah_tol[$count],
                $bem_val,
                $kh_val,
                $id_mar,
                (int)$Garden_id,
                $mor_cod_m,
                $no_kesh,
                $nah_kesh,
                $id_ostan,
                $id_city,
                $num_bah,
                $sh_gat,
                $z_sal,
                $add_abadi,
                $add_city,
                $bah_cod_m
            );
            
            $count++;
            continue;
        }
        // ========== پایان شرط نحوه کشت پراکنده ==========
        
        // ========== اعتبارسنجی برای نحوه کشت غیر پراکنده (ساده و مخلوط) ==========
        
        // شرط اصلی اعتبارسنجی فیلدها
        if (
            !empty($value) && is_numeric($value) && (int)$value > 0 &&
            !empty($cod_mah[$count]) && is_numeric($cod_mah[$count]) && (int)$cod_mah[$count] > 0 &&
            $s_kesht_b[$count] !== '' && $s_kesht_gb[$count] !== '' &&
            $tree_b[$count] !== '' && $tree_gb[$count] !== '' &&
            $mah_tolp[$count] !== '' && $mah_tol[$count] !== ''
        ) {
            
            $current_product_code = $cod_mah[$count];
            $current_cultivated_area_bar = (float)$s_kesht_b[$count];
            $current_cultivated_area_nobar = (float)$s_kesht_gb[$count];

            if (isset($existing_product_codes[$current_product_code]) || isset($batch_product_codes[$current_product_code])) {
                $error_messages[] = "محصول : " . mah_name($current_product_code) . " (ردیف " . ($count + 1) . "): این محصول در این قطعه فقط یک‌بار قابل ثبت است.";
                $count++;
                continue;
            }

            if ($current_cultivated_area_bar == 0 && $current_cultivated_area_nobar == 0
                && (float)$tree_b[$count] == 0 && (float)$tree_gb[$count] == 0) {
                $error_messages[] = "محصول در ردیف " . ($count + 1) . ": ثبت محصول بدون سطح کشت و تعداد درخت مجاز نیست.";
                $count++;
                continue;
            }

            if ($current_cultivated_area_bar <= 0 && (float)$tree_b[$count] > 0) {
                $error_messages[] = "محصول در ردیف " . ($count + 1) . ": امکان ثبت تعداد درخت بارور بدون ثبت سطح کشت بارور وجود ندارد.";
                $count++;
                continue;
            }
            if ($current_cultivated_area_nobar <= 0 && (float)$tree_gb[$count] > 0) {
                $error_messages[] = "محصول در ردیف " . ($count + 1) . ": امکان ثبت تعداد درخت غیربارور بدون ثبت سطح کشت غیربارور وجود ندارد.";
                $count++;
                continue;
            }
            
            // مجموع تجمعی بارور و غیربارور جداگانه برای همین محصول در بچ جاری
            $key_for_sum = $current_product_code . '-' . $no_kesh;
            $current_batch_bar = 0.0;
            $current_batch_nobar = 0.0;
            if (isset($batch_cumulative_sums[$key_for_sum])) {
                $current_batch_bar = $batch_cumulative_sums[$key_for_sum]['bar'];
                $current_batch_nobar = $batch_cumulative_sums[$key_for_sum]['nobar'];
            }
            
            // اعتبارسنجی سطح کشت با استفاده از CropValidationService
            $validationResult = $validationService->validateCultivatedAreaAgainstAllocation(
                null,
                $Garden_id,
                $current_product_code,
                (float)$s_kesht_b[$count],
                (float)$s_kesht_gb[$count],
                $z_sal,
                $id_ostan,
                $id_city,
                $id_mar,
                $no_kesh,
                $current_batch_bar,
                $current_batch_nobar
            );
            
            // اعتبارسنجی تولید فقط بر اساس سطح بارور
            $s_barvar_for_tol = (float)$s_kesht_b[$count];
            
            // اعتبارسنجی حداکثر تولید پیش‌بینی (mah_tolp)
            $tolp_validation = array('isValid' => true);
            if ((float)$mah_tolp[$count] > 0) {
                $tolp_validation = $validationService->validateProductionLimit(
                    $current_product_code,
                    $s_barvar_for_tol,
                    (float)$mah_tolp[$count],
                    $no_kesh,
                    'pishbini'
                );
            }
            
            // اعتبارسنجی حداکثر تولید قطعی (mah_tol)
            $tol_validation = array('isValid' => true);
            if ((float)$mah_tol[$count] > 0) {
                $tol_validation = $validationService->validateProductionLimit(
                    $current_product_code,
                    $s_barvar_for_tol,
                    (float)$mah_tol[$count],
                    $no_kesh,
                    'ghatii'
                );
            }
            
            // ترکیب نتایج اعتبارسنجی
            if (!$validationResult['isValid'] || !$tolp_validation['isValid'] || !$tol_validation['isValid']) {
                if (!$validationResult['isValid']) {
                    $error_messages[] = "محصول : " . mah_name($current_product_code) . " (ردیف " . ($count + 1) . "): " . $validationResult['message'];
                }
                if (!$tolp_validation['isValid']) {
                    $error_messages[] = "محصول : " . mah_name($current_product_code) . " (ردیف " . ($count + 1) . "): " . $tolp_validation['message'];
                }
                if (!$tol_validation['isValid']) {
                    $error_messages[] = "محصول : " . mah_name($current_product_code) . " (ردیف " . ($count + 1) . "): " . $tol_validation['message'];
                }
                $count++;
                continue;
            }
            
            // مقداردهی پیش‌فرض برای mah_bem و mah_kh
            $bem_val = (isset($mah_bem[$count]) && $mah_bem[$count] !== '') ? $mah_bem[$count] : '2';
            $kh_val = (isset($mah_kh[$count]) && $mah_kh[$count] !== '') ? $mah_kh[$count] : '2';
            
            $valid_products_placeholders[] = '(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            
            array_push(
                $valid_products_params,
                $date_edit,
                $cod_qroup[$count],
                $current_product_code,
                (float)$s_kesht_b[$count],
                (float)$s_kesht_gb[$count],
                (float)$tree_b[$count],
                (float)$tree_gb[$count],
                (float)$mah_tolp[$count],
                (float)$mah_tol[$count],
                $bem_val,
                $kh_val,
                $id_mar,
                (int)$Garden_id,
                $mor_cod_m,
                $no_kesh,
                $nah_kesh,
                $id_ostan,
                $id_city,
                $num_bah,
                $sh_gat,
                $z_sal,
                $add_abadi,
                $add_city,
                $bah_cod_m
            );
            
            // به‌روزرسانی مجموع تجمعی بارور و غیربارور برای بچ جاری
            if (!isset($batch_cumulative_sums[$key_for_sum])) {
                $batch_cumulative_sums[$key_for_sum] = array('bar' => 0.0, 'nobar' => 0.0);
            }
            $batch_cumulative_sums[$key_for_sum]['bar'] += $current_cultivated_area_bar;
            $batch_cumulative_sums[$key_for_sum]['nobar'] += $current_cultivated_area_nobar;
            $batch_product_codes[$current_product_code] = true;
            
        } else {
            $error_messages[] = "محصول در ردیف " . ($count + 1) . ": خطا! نام گروه یا محصول نامعتبر یا فیلدهای ضروری خالی هستند.";
        }
        
        $count++;
    }
    
    try {
        $dbh->beginTransaction();
        
        if (!empty($valid_products_placeholders)) {
            
            $insert_query_sql = 'INSERT INTO `' . $Garden_prod_table . '`
                (date_s, cod_qroup, cod_mah, s_kesht_b, s_kesht_gb, tree_b, tree_gb, 
                 mah_tolp, mah_tol, mah_bem, mah_kh, id_mar, Garden_id, mor_cod_m, 
                 no_kesh, nah_kesh, id_ostan, id_city, num_bah, sh_gat, z_sal, 
                 add_abadi, add_city, bah_cod_m)
                VALUES ' . implode(', ', $valid_products_placeholders);
            
            $stmt = $dbh->prepare($insert_query_sql);
            $stmt->execute($valid_products_params);
            
            // به‌روزرسانی تعداد محصولات در جدول Garden
            $updateQuery = "UPDATE `$Garden_table`
                            SET t_mah = (SELECT COUNT(*) FROM `$Garden_prod_table` WHERE Garden_id = :garden_id_subquery),
                                date_s = :date_s_update
                            WHERE id = :id_update";
            $updateStmt = $dbh->prepare($updateQuery);
            $updateStmt->execute(array(
                ':garden_id_subquery' => $Garden_id,
                ':date_s_update' => $date_edit,
                ':id_update' => $Garden_id
            ));
            
            // ثبت رویداد
            sabt_event(
                $login_session,
                $_SERVER['REMOTE_ADDR'],
                $date_edit,
                $time,
                $add_abadi,
                'ثبت محصول باغی /' . $z_sal . '/' . $sh_gat . '/' . $bah_cod_m . ' (شامل ' . count($valid_products_placeholders) . ' محصول)',
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