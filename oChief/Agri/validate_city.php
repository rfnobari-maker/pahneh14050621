<?php
/**
 * تابع مشترک اعتبارسنجی برش شهرستان
 */

function getFieldLabel($field_name) {
    $labels = array(
        's_abi' => 'سطح آبی',
        's_dem' => 'سطح دیم',
        't_abi' => 'تولید آبی',
        't_dem' => 'تولید دیم'
    );
    return isset($labels[$field_name]) ? $labels[$field_name] : $field_name;
}

function validateCityAllocation($dbh, $params) {
    $defaults = array('check_centers' => true);
    $params = array_merge($defaults, $params);
    
    $id_ostan = $params['id_ostan'];
    $id_city = $params['id_city'];
    $z_sal = $params['z_sal'];
    $product_cod = $params['product_cod'];
    $field_name = $params['field_name'];
    $new_value = floatval($params['new_value']);
    $current_record_id = isset($params['current_record_id']) ? intval($params['current_record_id']) : null;
    $check_centers = $params['check_centers'];
    
    // اعتبارسنجی نام فیلد
    $allowed = array('s_abi', 's_dem', 't_abi', 't_dem');
    if (!in_array($field_name, $allowed)) {
        return array('valid' => false, 'message' => '⚠️ فیلد نامعتبر');
    }
    
    if ($new_value < 0) {
        return array('valid' => false, 'message' => '⚠️ مقدار نمی‌تواند منفی باشد.');
    }
    
    $result = array(
        'valid' => true,
        'message' => '',
        'data' => array(
            'city_limit' => 0,
            'current_sum' => 0,
            'other_cities_sum' => 0,
            'total_current' => 0,
            'remaining' => 0,
            'new_remaining' => 0,
            'centers_sum' => 0,
            'min_allowed' => 0,
            'max_allowed' => 0,
            'current_value' => 0,
            'requested_value' => $new_value
        )
    );
    
    try {
        // ۱. دریافت سقف استان
        $query1 = "SELECT {$field_name} FROM Agri_ab_ostan 
                   WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $stmt1 = $dbh->prepare($query1);
        $stmt1->execute(array($z_sal, $id_ostan, $product_cod));
        $city_limit = $stmt1->fetchColumn();
        if ($city_limit === false || $city_limit === null) {
            $result['valid'] = false;
            $result['message'] = '⚠️ میزان ابلاغی این محصول برای استان ثبت نشده است.';
            return $result;
        }
        $city_limit = floatval($city_limit);
        $result['data']['city_limit'] = $city_limit;
        
        // ۲. مقدار فعلی رکورد (در صورت ویرایش)
        $current_value = 0;
        if ($current_record_id) {
            $query_current = "SELECT {$field_name} FROM Agri_ab_city WHERE id = ?";
            $stmt_current = $dbh->prepare($query_current);
            $stmt_current->execute(array($current_record_id));
            $current_value = floatval($stmt_current->fetchColumn());
            $result['data']['current_value'] = $current_value;
        }
        
        // ۳. مجموع سایر شهرستان‌ها (به جز رکورد جاری)
        $query_sum = "SELECT SUM({$field_name}) FROM Agri_ab_city 
                      WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $params_sum = array($z_sal, $id_ostan, $product_cod);
        if ($current_record_id) {
            $query_sum .= " AND id != ?";
            $params_sum[] = $current_record_id;
        }
        $stmt_sum = $dbh->prepare($query_sum);
        $stmt_sum->execute($params_sum);
        $other_cities_sum = floatval($stmt_sum->fetchColumn());
        $result['data']['other_cities_sum'] = $other_cities_sum;
        
        // ۴. مجموع کل فعلی (شامل این رکورد)
        $total_current = $other_cities_sum + $current_value;
        $result['data']['total_current'] = $total_current;
        $result['data']['current_sum'] = $total_current; // برای سازگاری با کد قبلی
        
        // ۵. محاسبه مجموع مراکز (برای کنترل کاهش)
        $centers_sum = 0;
        if ($check_centers) {
            $query_centers = "SELECT SUM({$field_name}) FROM Agri_ab_mar 
                              WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
            $stmt_centers = $dbh->prepare($query_centers);
            $stmt_centers->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
            $centers_sum = floatval($stmt_centers->fetchColumn());
            $result['data']['centers_sum'] = $centers_sum;
            $result['data']['min_allowed'] = $centers_sum;
        }
        
        // ۶. محاسبات جدید
        $new_total = $other_cities_sum + $new_value;   // مجموع جدید بعد از اعمال تغییر
        $remaining = $city_limit - $total_current;     // موجودی قبل از تغییر
        $new_remaining = $city_limit - $new_total;     // موجودی پس از اعمال مقدار جدید
        $max_allowed = $city_limit - $other_cities_sum; // حداکثر مجاز برای این رکورد
        
        $result['data']['remaining'] = $remaining;
        $result['data']['new_remaining'] = $new_remaining;
        $result['data']['max_allowed'] = $max_allowed;
        
        // ۷. کنترل افزایش
        if ($new_total > $city_limit) {
            $result['valid'] = false;
            $result['message'] = "❌ امکان افزایش " . getFieldLabel($field_name) . " وجود ندارد.\n\n" .
                "📊 اطلاعات لحظه‌ای:\n" .
                "سقف ابلاغی استان: " . number_format($city_limit) . "\n" .
                "مجموع کل فعلی (شامل این رکورد): " . number_format($total_current) . "\n" .
                "مقدار فعلی این رکورد: " . number_format($current_value) . "\n" .
                "سایر شهرستان‌ها: " . number_format($other_cities_sum) . "\n" .
                "موجودی قابل تخصیص: " . number_format($remaining) . "\n" .
                "مقدار درخواستی شما: " . number_format($new_value) . "\n\n" .
                "💡 حداکثر مقداری که می‌توانید وارد کنید: " . number_format($max_allowed);
            return $result;
        }
        
        // ۸. کنترل کاهش
        if ($check_centers && $new_value < $centers_sum && $new_value < $current_value) {
            $result['valid'] = false;
            $result['message'] = "❌ امکان کاهش " . getFieldLabel($field_name) . " وجود ندارد.\n\n" .
                "📊 اطلاعات لحظه‌ای:\n" .
                "مقدار فعلی شهرستان: " . number_format($current_value,2) . "\n" .
                "مجموع مراکز: " . number_format($centers_sum,2) . "\n" .
                "حداقل مقدار مجاز: " . number_format($centers_sum,2) . "\n" .
                "مقدار درخواستی شما: " . number_format($new_value,2) . "\n\n" .
                "💡 برای کاهش بیشتر، ابتدا برش مراکز را اصلاح کنید.";
            return $result;
        }
        
        $result['valid'] = true;
        $result['message'] = '✅ مقدار مجاز است.';
        return $result;
        
    } catch (PDOException $e) {
        $result['valid'] = false;
        $result['message'] = '⚠️ خطای پایگاه‌داده: ' . $e->getMessage();
        return $result;
    }
}
?>