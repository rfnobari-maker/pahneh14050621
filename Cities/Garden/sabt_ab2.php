<?php
include('../../lock_p3.php');
include('../../event.php');
if(isset($_POST['s_abi']))
{

function clean_number($value) {
    return str_replace('٬', '', $value);
}
    $s_abi   = clean_number($_POST['s_abi']) ; 
    $s_dem   = clean_number($_POST['s_dem']) ; 
    $t_abi   = clean_number($_POST['t_abi']) ; 
    $t_dem   = clean_number($_POST['t_dem']) ; 
    $a_abi   = clean_number($_POST['a_abi']) ; 
    $a_dem   = clean_number($_POST['a_dem']) ; 
    $id      = clean_number($_POST['id']) ; 
    $z_sal     = $_POST['z_sal'] ; 
    $id_ostan = $_POST['id_ostan']; 
    $id_city = $_POST['id_city']; 
    $id_mar = $_POST['id_mar']; 
    $id_product = $_POST['id_product']; 

    // ----------------------------------------------------
    // --- بخش جدید: اعتبارسنجی مجدد برای جلوگیری از Race Condition ---
    // ----------------------------------------------------

    // 1. دریافت مقادیر فعلی رکورد از پایگاه داده Agri_ab_mar (مقادیر قدیمی)
    $query_current = "SELECT s_abi, s_dem, t_abi, t_dem FROM Agri_ab_mar WHERE id = ?";
    $stmt_current = $dbh->prepare($query_current);
    $stmt_current->execute(array($id));
    $current_values = $stmt_current->fetch(PDO::FETCH_ASSOC);
    
    if (!$current_values) {
        echo json_encode(array('valid' => false, 'message' => 'رکورد مورد نظر برای بروزرسانی یافت نشد.'));
        exit;
    }

    $current_s_abi = isset($current_values['s_abi']) ? floatval($current_values['s_abi']) : 0;
    $current_s_dem = isset($current_values['s_dem']) ? floatval($current_values['s_dem']) : 0;
    $current_t_abi = isset($current_values['t_abi']) ? floatval($current_values['t_abi']) : 0;
    $current_t_dem = isset($current_values['t_dem']) ? floatval($current_values['t_dem']) : 0;

    // --- کنترل سقف شهرستان (فقط در صورت افزایش مقدار) ---
    $is_any_value_increased = ($s_abi > $current_s_abi) || ($s_dem > $current_s_dem) || ($t_abi > $current_t_abi) || ($t_dem > $current_t_dem);
    
    if ($is_any_value_increased) {
        // 2. دریافت سقف‌های مجاز برای شهرستان از Agri_ab_city
        $query_city = "SELECT s_abi, s_dem, t_abi, t_dem FROM Agri_ab_city WHERE id_ostan = ? AND id_city = ? AND z_sal = ? AND product_cod = ?";
        $stmt_city = $dbh->prepare($query_city);
        $stmt_city->execute(array($id_ostan, $id_city, $z_sal, $id_product));
        $city_limits = $stmt_city->fetch(PDO::FETCH_ASSOC);
        
        if (!$city_limits) {
            echo json_encode(array('valid' => false, 'message' => 'اطلاعات سقف شهرستان یافت نشد.'));
            exit;
        }
        
        // 3. محاسبه مجموع مقادیر فعلی تمام مراکز آن شهرستان از Agri_ab_mar
        $query_sum = "SELECT SUM(s_abi) as total_s_abi, SUM(s_dem) as total_s_dem, SUM(t_abi) as total_t_abi, SUM(t_dem) as total_t_dem FROM Agri_ab_mar WHERE id_ostan = ? AND id_city = ? AND z_sal = ? AND product_cod = ?";
        $stmt_sum = $dbh->prepare($query_sum);
        $stmt_sum->execute(array($id_ostan, $id_city, $z_sal, $id_product));
        $sum_mar = $stmt_sum->fetch(PDO::FETCH_ASSOC);

        // 4. اعتبارسنجی نهایی با احتساب مقدار جدید برای هر فیلدی که افزایش یافته است
        if ($s_abi > $current_s_abi) {
            $new_total_s_abi = ($sum_mar['total_s_abi'] - $current_s_abi) + $s_abi;
            if ($new_total_s_abi > $city_limits['s_abi']) {
                echo json_encode(array('valid' => false, 'message' => 'مقدار سطح آبی از سقف مجاز شهرستان بیشتر است.')); exit;
            }
        }
        if ($s_dem > $current_s_dem) {
            $new_total_s_dem = ($sum_mar['total_s_dem'] - $current_s_dem) + $s_dem;
            if ($new_total_s_dem > $city_limits['s_dem']) {
                echo json_encode(array('valid' => false, 'message' => 'مقدار سطح دیم از سقف مجاز شهرستان بیشتر است.')); exit;
            }
        }
        if ($t_abi > $current_t_abi) {
            $new_total_t_abi = ($sum_mar['total_t_abi'] - $current_t_abi) + $t_abi;
            if ($new_total_t_abi > $city_limits['t_abi']) {
                echo json_encode(array('valid' => false, 'message' => 'مقدار تولید آبی از سقف مجاز شهرستان بیشتر است.')); exit;
            }
        }
        if ($t_dem > $current_t_dem) {
            $new_total_t_dem = ($sum_mar['total_t_dem'] - $current_t_dem) + $t_dem;
            if ($new_total_t_dem > $city_limits['t_dem']) {
                echo json_encode(array('valid' => false, 'message' => 'مقدار تولید دیم از سقف مجاز شهرستان بیشتر است.')); exit;
            }
        }
    }
    
    // --- کنترل مقادیر کارشناسان (فقط در صورت افزایش مقدار) ---
    
    function validate_prod_value($dbh, $field_name, $user_value, $id_ostan, $id_city, $id_mar, $id_product, $z_sal) {
        // شرط افزایشی بودن مقدار، بیرون از این تابع کنترل شده است
        
        $product_codes_to_check_vege = array('170', '172', '174');
        $prod_table = '';
        $query_prod = '';
        $params = array();

        if (in_array($id_product, $product_codes_to_check_vege)) {
            $prod_table = 'Vege_prod' ;
            if ($field_name == 's_abi' || $field_name == 's_dem') {
                $query_prod = "SELECT zer_kesht FROM {$prod_table} WHERE cod_mah = ? AND id_ostan = ? AND id_city = ? AND id_mar = ? AND z_sal = ?";
                $params = array($id_product, $id_ostan, $id_city, $id_mar, $z_sal);
            } elseif ($field_name == 't_abi' || $field_name == 't_dem') {
                $query_prod = "SELECT mah_tol FROM {$prod_table} WHERE cod_mah = ? AND id_ostan = ? AND id_city = ? AND id_mar = ? AND z_sal = ?";
                $params = array($id_product, $id_ostan, $id_city, $id_mar, $z_sal);
            }
        } else {
            $prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
            $agri_prod_columns = array(
                's_abi' => array('column' => 'sum(zer_kesht_a)+sum(zer_kesht_b)', 'kesht' => 'no_kesh = "1"'),
                's_dem' => array('column' => 'sum(zer_kesht_a)+sum(zer_kesht_b)', 'kesht' => 'no_kesh = "2"'),
                't_abi' => array('column' => 'sum(mah_tol)', 'kesht' => 'no_kesh = "1"'),
                't_dem' => array('column' => 'sum(mah_tol)', 'kesht' => 'no_kesh = "2"'),
            );
            $column = $agri_prod_columns[$field_name]['column'];
            $kesht = $agri_prod_columns[$field_name]['kesht'];
            $query_prod = "SELECT {$column} FROM {$prod_table} WHERE id_city = ? AND id_mar = ? AND cod_mah = ? AND {$kesht}";
            $params = array($id_city, $id_mar, $id_product);
        }

        if ($query_prod) {
            $stmt_prod = $dbh->prepare($query_prod);
            $stmt_prod->execute($params);
            $prod_value = $stmt_prod->fetchColumn();
            $prod_value = ($prod_value !== false) ? floatval($prod_value) : 0;
            
            if ($user_value < $prod_value) {
                $message = 'مقدار وارد شده از مقدار ثبت شده توسط کارشناسان پهنه کمتر است. (مقدار کارشناسان: ' . number_format($prod_value) . ')';
                return array('valid' => false, 'message' => $message);
            }
        }

        return array('valid' => true);
    }
    
    $validation_map = array(
        's_abi' => $s_abi > $current_s_abi,
        's_dem' => $s_dem > $current_s_dem,
        't_abi' => $t_abi > $current_t_abi,
        't_dem' => $t_dem > $current_t_dem
    );
    $values_map = array(
        's_abi' => $s_abi, 's_dem' => $s_dem, 't_abi' => $t_abi, 't_dem' => $t_dem
    );

    foreach ($validation_map as $field => $should_validate) {
        if ($should_validate) {
            $result = validate_prod_value($dbh, $field, $values_map[$field], $id_ostan, $id_city, $id_mar, $id_product, $z_sal);
            if (!$result['valid']) {
                echo json_encode($result);
                exit;
            }
        }
    }
    
    // --- اگر تمام کنترل‌ها موفقیت‌آمیز بود، اطلاعات را در پایگاه داده ذخیره کن ---

    require_once('../../Jalali.php');
    date_default_timezone_set('Asia/Tehran') ;
    $date_edit = jdate("Y/m/d");
    $time = date('H:i:s') ;
    include('../../login/config.php');
    $query = "update Agri_ab_mar set date_s=?, s_abi=?, s_dem=?, t_abi=?, t_dem=?, a_abi=?, a_dem=? where id=? ";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($date_edit, $s_abi, $s_dem, $t_abi, $t_dem, $a_abi, $a_dem, $id));
    $count = $stmt->rowCount();

    if ($count > 0) {
        $status = 'ثبت اطلاعات تولیدات نهایی کشاورزی';
        sabt_event($login_session, getUserIP_1(), $date_edit, $time, '', $status, $id_ostan);
        echo json_encode(array('valid' => true, 'message' => 'اطلاعات با موفقیت ذخیره شد.'));
    } else {
        echo json_encode(array('valid' => false, 'message' => 'هیچ تغییری در داده‌ها ایجاد نشد.'));
    }
}
?>