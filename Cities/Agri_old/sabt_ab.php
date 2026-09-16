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

    // 1. دریافت مقادیر فعلی رکورد از پایگاه داده Agri_ab_mar
    $query_current = "SELECT s_abi, s_dem, t_abi, t_dem FROM Agri_ab_mar WHERE id = ?";
    $stmt_current = $dbh->prepare($query_current);
    $stmt_current->execute(array($id));
    $current_values = $stmt_current->fetch(PDO::FETCH_ASSOC);

    $current_s_abi = isset($current_values['s_abi']) ? $current_values['s_abi'] : 0;
    $current_s_dem = isset($current_values['s_dem']) ? $current_values['s_dem'] : 0;
    $current_t_abi = isset($current_values['t_abi']) ? $current_values['t_abi'] : 0;
    $current_t_dem = isset($current_values['t_dem']) ? $current_values['t_dem'] : 0;
    
    // 2. دریافت سقف‌های مجاز برای شهرستان از Agri_ab_city
    $query_city = "SELECT s_abi, s_dem, t_abi, t_dem FROM Agri_ab_city WHERE id_ostan = ? AND id_city = ? AND z_sal = ? AND product_cod = ?";
    $stmt_city = $dbh->prepare($query_city);
    $stmt_city->execute(array($id_ostan,$id_city, $z_sal, $id_product));
    $city_limits = $stmt_city->fetch(PDO::FETCH_ASSOC);
    
    if (!$city_limits) {
        echo json_encode(array('valid' => false, 'message' => 'اطلاعات سقف شهرستان یافت نشد.'));
        exit;
    }
    
    // 3. محاسبه مجموع مقادیر فعلی تمام مراکز آن شهرستان از Agri_ab_mar
    $query_sum = "SELECT SUM(s_abi) as total_s_abi, SUM(s_dem) as total_s_dem, SUM(t_abi) as total_t_abi, SUM(t_dem) as total_t_dem FROM Agri_ab_mar WHERE id_ostan = ? AND id_city = ? AND z_sal = ? AND product_cod = ?";
    $stmt_sum = $dbh->prepare($query_sum);
    $stmt_sum->execute(array($id_ostan,$id_city, $z_sal, $id_product));
    $sum_mar = $stmt_sum->fetch(PDO::FETCH_ASSOC);

    // 4. اعتبارسنجی نهایی با احتساب مقدار جدید (کنترل سقف شهرستان)
    $new_total_s_abi = ($sum_mar['total_s_abi'] - $current_s_abi) + $s_abi;
    $new_total_s_dem = ($sum_mar['total_s_dem'] - $current_s_dem) + $s_dem;
    $new_total_t_abi = ($sum_mar['total_t_abi'] - $current_t_abi) + $t_abi;
    $new_total_t_dem = ($sum_mar['total_t_dem'] - $current_t_dem) + $t_dem;
    
    if (
        ($new_total_s_abi > $city_limits['s_abi']) ||
        ($new_total_s_dem > $city_limits['s_dem']) ||
        ($new_total_t_abi > $city_limits['t_abi']) ||
        ($new_total_t_dem > $city_limits['t_dem'])
    ) {
        echo json_encode(array('valid' => false, 'message' => 'مقادیر وارد شده از سقف مجاز شهرستان بیشتر است.'));
        exit;
    }

    // ============================================================
    // اعتبارسنجی مقادیر کارشناسان - فقط برای s_abi و s_dem
    // ============================================================
    
    $executed_queries = array();
    
    // ===== تابع فقط برای s_abi و s_dem =====
    function validate_surface($dbh, $field_name, $user_value, $current_value, $id_city, $id_mar, $id_product, $z_sal, &$executed_queries) {
        
        // اگر مقدار جدید >= مقدار فعلی باشد، نیازی به بررسی نیست
        if ($user_value >= $current_value) {
            return array('valid' => true);
        }

        $prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
        $query_prod = '';
        $params = array();

        // کوئری برای s_abi
        if ($field_name == 's_abi') {
            $query_prod = "SELECT SUM(zer_kesht_a)+SUM(zer_kesht_b) FROM {$prod_table} WHERE id_city = ? AND id_mar = ? AND cod_mah = ? AND no_kesh = 1";
            $params = array($id_city, $id_mar, $id_product);
        } 
        // کوئری برای s_dem
        elseif ($field_name == 's_dem') {
            $query_prod = "SELECT SUM(zer_kesht_a)+SUM(zer_kesht_b) FROM {$prod_table} WHERE id_city = ? AND id_mar = ? AND cod_mah = ? AND no_kesh = 2";
            $params = array($id_city, $id_mar, $id_product);
        }

        $executed_queries[] = array(
            'field' => $field_name,
            'query' => $query_prod,
            'params' => $params,
            'table' => $prod_table
        );

        if ($query_prod) {
            $stmt_prod = $dbh->prepare($query_prod);
            $stmt_prod->execute($params);
            $prod_value = $stmt_prod->fetchColumn();
            $prod_value = ($prod_value !== false) ? floatval($prod_value) : 0;
            
            if ($user_value < $prod_value) {
                $field_names = array(
                    's_abi' => 'سطح آبی',
                    's_dem' => 'سطح دیم'
                );
                $message = 'مقدار ثبت شده توسط کارشناسان پهنه در مراکز این شهرستان بیش از این مقدار است. (مقدار کارشناسان برای ' . $field_names[$field_name] . ': ' . number_format($prod_value) . ')';
                return array('valid' => false, 'message' => $message, 'query_info' => $executed_queries);
            }
        }

        return array('valid' => true, 'query_info' => $executed_queries);
    }
    
    // ===== فقط s_abi و s_dem رو بررسی کن =====
    $validation_results = array();
    $validation_results[] = validate_surface($dbh, 's_abi', $s_abi, $current_s_abi, $id_city, $id_mar, $id_product, $z_sal, $executed_queries);
    $validation_results[] = validate_surface($dbh, 's_dem', $s_dem, $current_s_dem, $id_city, $id_mar, $id_product, $z_sal, $executed_queries);
    
    // ===== t_abi و t_dem رو اصلاً بررسی نکن =====
    // $validation_results[] = validate_prod_value($dbh, 't_abi', ...);
    // $validation_results[] = validate_prod_value($dbh, 't_dem', ...);

    foreach ($validation_results as $result) {
        if (!$result['valid']) {
            $response = array(
                'valid' => false, 
                'message' => $result['message'],
                'queries' => $result['query_info'],
                'debug_info' => array(
                    'id_product' => $id_product,
                    'id_city' => $id_city,
                    'id_mar' => $id_mar,
                    'z_sal' => $z_sal,
                    'table_name' => 'Agri_prod' . str_replace('-', '_', $z_sal)
                )
            );
            echo json_encode($response);
            exit;
        }
    }
    
    // ============================================================
    // ذخیره سازی در دیتابیس
    // ============================================================
    require_once('../../Jalali.php');
    date_default_timezone_set('Asia/Tehran') ;
    $date_edit = jdate("Y/m/d");
    $time = date('H:i:s') ;
    include('../../login/config.php');
    $query = "update Agri_ab_mar set date_s=?,s_abi=?,s_dem=?,t_abi=?,t_dem=?,a_abi=?,a_dem=? where id=? ";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($date_edit, $s_abi, $s_dem, $t_abi, $t_dem, $a_abi, $a_dem, $id));
    $count = $stmt->rowCount();

    if ($count > 0) {
        $status = 'ثبت اطلاعات تولیدات نهایی کشاورزی';
        sabt_event($login_session, getUserIP_1(), $date_edit, $time, '', $status, $id_ostan);
        echo json_encode(array('valid' => true, 'message' => 'اطلاعات با موفقیت ذخیره شد.'));
    } else {
        echo json_encode(array('valid' => false, 'message' => 'هیچ تغییری در داده‌ها ایجاد نشده.'));
    }
}
?>