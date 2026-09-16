<?php
function getGardenFieldLabel($field_name) {
    $labels = array(
        's_bar_abi' => 'سطح بارور آبی',
        's_bar_dem' => 'سطح بارور دیم',
        's_nobar_abi' => 'سطح غیربارور آبی',
        's_nobar_dem' => 'سطح غیربارور دیم',
        't_abi' => 'تولید آبی',
        't_dem' => 'تولید دیم'
    );
    return isset($labels[$field_name]) ? $labels[$field_name] : $field_name;
}

function validateGardenAllocation($dbh, $params) {
    $defaults = array(
        'check_centers' => true,
        'check_expert' => false,
        'id_mar' => null,
        'z_sal' => null,
        'product_cod' => null,
        'field_name' => null,
        'new_value' => 0,
        'current_record_id' => null,
        'id_city' => null,
        'id_ostan' => null,
        'table_type' => 'city'
    );
    $params = array_merge($defaults, $params);
    
    $id_ostan = $params['id_ostan'];
    $id_city = $params['id_city'];
    $id_mar = $params['id_mar'];
    $z_sal = $params['z_sal'];
    $product_cod = $params['product_cod'];
    $field_name = $params['field_name'];
    $new_value = floatval($params['new_value']);
    $current_record_id = isset($params['current_record_id']) ? intval($params['current_record_id']) : null;
    $check_centers = $params['check_centers'];
    $check_expert = $params['check_expert'];
    $table_type = $params['table_type'];
    
    // ============================================================
    // ✅ اصلاح: فیلدهای مجاز (۴ سطح + ۲ تولید)
    // ============================================================
    $allowed = array('s_bar_abi', 's_bar_dem', 's_nobar_abi', 's_nobar_dem', 't_abi', 't_dem');
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
            'requested_value' => $new_value,
            'expert_value' => 0
        )
    );
    
    try {
        // ============================================================
        // ۱. تعیین جدول سقف بر اساس نوع (باغی)
        // ============================================================
        if ($table_type == 'mar') {
            $table_limit = 'Garden_ab_city';
            $where_limit = "z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
            $params_limit = array($z_sal, $id_ostan, $id_city, $product_cod);
        } else {
            $table_limit = 'Garden_ab_ostan';
            $where_limit = "z_sal = ? AND id_ostan = ? AND product_cod = ?";
            $params_limit = array($z_sal, $id_ostan, $product_cod);
        }
        
        $query_limit = "SELECT {$field_name} FROM {$table_limit} WHERE {$where_limit}";
        $stmt_limit = $dbh->prepare($query_limit);
        $stmt_limit->execute($params_limit);
        $city_limit = $stmt_limit->fetchColumn();
        
        if ($city_limit === false || $city_limit === null) {
            $result['valid'] = false;
            $result['message'] = '⚠️ میزان ابلاغی این محصول برای ' . ($table_type == 'mar' ? 'شهرستان' : 'استان') . ' ثبت نشده است.';
            return $result;
        }
        $city_limit = floatval($city_limit);
        $result['data']['city_limit'] = $city_limit;
        
        // ============================================================
        // ۲. دریافت مقدار فعلی رکورد
        // ============================================================
        $current_value = 0;
        if ($current_record_id) {
            $table_current = ($table_type == 'mar') ? 'Garden_ab_mar' : 'Garden_ab_city';
            $query_current = "SELECT {$field_name} FROM {$table_current} WHERE id = ?";
            $stmt_current = $dbh->prepare($query_current);
            $stmt_current->execute(array($current_record_id));
            $current_value = floatval($stmt_current->fetchColumn());
            $result['data']['current_value'] = $current_value;
        }
        
        // ============================================================
        // ۳. محاسبه مجموع سایر رکوردها
        // ============================================================
        $table_sum = ($table_type == 'mar') ? 'Garden_ab_mar' : 'Garden_ab_city';
        $query_sum = "SELECT SUM({$field_name}) FROM {$table_sum} 
                      WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $params_sum = array($z_sal, $id_ostan, $product_cod);
        
        if ($table_type == 'mar') {
            $query_sum .= " AND id_city = ?";
            $params_sum[] = $id_city;
        }
        
        if ($current_record_id) {
            $query_sum .= " AND id != ?";
            $params_sum[] = $current_record_id;
        }
        
        $stmt_sum = $dbh->prepare($query_sum);
        $stmt_sum->execute($params_sum);
        $other_cities_sum = floatval($stmt_sum->fetchColumn());
        $result['data']['other_cities_sum'] = $other_cities_sum;
        
        // ============================================================
        // ۴. مجموع کل فعلی
        // ============================================================
        $total_current = $other_cities_sum + $current_value;
        $result['data']['total_current'] = $total_current;
        $result['data']['current_sum'] = $total_current;
        
        // ============================================================
        // ۵. محاسبه مجموع مراکز (برای برش شهرستان)
        // ============================================================
        $centers_sum = 0;
        if ($check_centers && $table_type == 'city') {
            $query_centers = "SELECT SUM({$field_name}) FROM Garden_ab_mar 
                              WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
            $stmt_centers = $dbh->prepare($query_centers);
            $stmt_centers->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
            $centers_sum = floatval($stmt_centers->fetchColumn());
            $result['data']['centers_sum'] = $centers_sum;
            $result['data']['min_allowed'] = $centers_sum;
        }
        
        // ============================================================
        // ۶. محاسبه مقدار ثبت شده توسط کارشناسان (برای مراکز) - باغی
        // ============================================================
        $expert_value = 0;
        if ($check_expert && $table_type == 'mar') {
            
            // تعیین جدول تولیدات باغی
            $prod_table = 'Garden_prod';
            
            // ============================================================
            // تعیین فیلد و شرط بر اساس نوع سطح
            // ============================================================
            
            // تعیین کدام فیلد از Garden_prod باید خوانده شود
            // s_kesht_b = بارور, s_kesht_gb = غیربارور
            if ($field_name == 's_bar_abi' || $field_name == 's_bar_dem') {
                // بارور: از s_kesht_b استفاده می‌کنیم
                $field_expert = 'COALESCE(SUM(s_kesht_b), 0)';
            } else if ($field_name == 's_nobar_abi' || $field_name == 's_nobar_dem') {
                // غیربارور: از s_kesht_gb استفاده می‌کنیم
                $field_expert = 'COALESCE(SUM(s_kesht_gb), 0)';
            } else {
                // برای t_abi و t_dem (تولید) - بررسی نمی‌شوند
                $field_expert = '0';
            }
            
            // تعیین شرط no_kesh بر اساس فیلد
            // no_kesh = 1 => آبی, no_kesh = 2 => دیم
            if ($field_name == 's_bar_abi' || $field_name == 's_nobar_abi' || $field_name == 't_abi') {
                // هر سه آبی: no_kesh = 1
                $no_kesh = 1;
            } else if ($field_name == 's_bar_dem' || $field_name == 's_nobar_dem' || $field_name == 't_dem') {
                // هر سه دیم: no_kesh = 2
                $no_kesh = 2;
            } else {
                $no_kesh = null;
            }
            
            // ============================================================
            // ساخت کوئری با فیلتر سال زراعی
            // ============================================================
            $query_expert = "SELECT {$field_expert} 
                             FROM {$prod_table} 
                             WHERE cod_mah = ? 
                               AND id_ostan = ? 
                               AND id_city = ? 
                               AND id_mar = ? 
                               AND z_sal = ?";
            
            $params_expert = array(
                $product_cod, 
                $id_ostan, 
                $id_city, 
                $id_mar, 
                $z_sal
            );
            
            // اضافه کردن شرط no_kesh (فقط برای فیلدهای سطح، نه تولید)
            if ($no_kesh !== null && ($field_name == 's_bar_abi' || $field_name == 's_bar_dem' || 
                                      $field_name == 's_nobar_abi' || $field_name == 's_nobar_dem')) {
                $query_expert .= " AND no_kesh = ?";
                $params_expert[] = $no_kesh;
            }
            
            // ============================================================
            // اجرا و دریافت نتیجه
            // ============================================================
            $stmt_expert = $dbh->prepare($query_expert);
            $stmt_expert->execute($params_expert);
            $expert_value = floatval($stmt_expert->fetchColumn());
            $result['data']['expert_value'] = $expert_value;
        }
        
        // ============================================================
        // ۷. محاسبات موجودی
        // ============================================================
        $remaining = $city_limit - $total_current;
        $new_total = $other_cities_sum + $new_value;
        $new_remaining = $city_limit - $new_total;
        $max_allowed = $city_limit - $other_cities_sum;
        
        $result['data']['remaining'] = $remaining;
        $result['data']['new_remaining'] = $new_remaining;
        $result['data']['max_allowed'] = $max_allowed;
        
        // ============================================================
        // ۸. اعتبارسنجی نهایی
        // ============================================================
        
        if ($current_record_id && $new_value == $current_value) {
            $result['valid'] = true;
            $result['message'] = '✅ بدون تغییر';
            return $result;
        }
        
        // کنترل افزایش
        if ($new_total > $city_limit) {
            $result['valid'] = false;
            $result['message'] = "❌ امکان افزایش " . getGardenFieldLabel($field_name) . " وجود ندارد.\n\n" .
                "📊 اطلاعات لحظه‌ای:\n" .
                "سقف " . ($table_type == 'mar' ? 'شهرستان' : 'استان') . ": " . number_format($city_limit) . "\n" .
                "مجموع کل فعلی: " . number_format($total_current) . "\n" .
                "مقدار فعلی این رکورد: " . number_format($current_value) . "\n" .
                "سایر " . ($table_type == 'mar' ? 'مراکز' : 'شهرستان‌ها') . ": " . number_format($other_cities_sum) . "\n" .
                "موجودی قابل تخصیص: " . number_format($remaining) . "\n" .
                "مقدار درخواستی شما: " . number_format($new_value) . "\n\n" .
                "💡 حداکثر مقداری که می‌توانید وارد کنید: " . number_format($max_allowed);
            return $result;
        }
        
        // کنترل کاهش برای برش شهرستان
        if ($check_centers && $table_type == 'city' && $new_value < $centers_sum && $new_value < $current_value) {
            $result['valid'] = false;
            $result['message'] = "❌ امکان کاهش " . getGardenFieldLabel($field_name) . " وجود ندارد.\n\n" .
                "📊 اطلاعات لحظه‌ای:\n" .
                "مقدار فعلی شهرستان: " . number_format($current_value) . "\n" .
                "مجموع مراکز: " . number_format($centers_sum) . "\n" .
                "حداقل مقدار مجاز: " . number_format($centers_sum) . "\n" .
                "مقدار درخواستی شما: " . number_format($new_value) . "\n\n" .
                "💡 برای کاهش بیشتر، ابتدا برش مراکز را اصلاح کنید.";
            return $result;
        }
        
        // کنترل کاهش برای برش مراکز (با در نظر گرفتن مقدار کارشناسان)
        // فقط برای فیلدهای سطح (نه تولید)
        if ($check_expert && $table_type == 'mar' && 
            ($field_name == 's_bar_abi' || $field_name == 's_bar_dem' || 
             $field_name == 's_nobar_abi' || $field_name == 's_nobar_dem') &&
            $new_value < $expert_value && $new_value < $current_value) {
            $result['valid'] = false;
            $result['message'] = "❌ امکان کاهش " . getGardenFieldLabel($field_name) . " وجود ندارد.\n\n" .
                "📊 اطلاعات لحظه‌ای:\n" .
                "مقدار فعلی مرکز: " . number_format($current_value) . "\n" .
                "مقدار ثبت شده توسط کارشناسان پهنه: " . number_format($expert_value) . "\n" .
                "حداقل مقدار مجاز: " . number_format($expert_value) . "\n" .
                "مقدار درخواستی شما: " . number_format($new_value) . "\n\n" .
                "💡 برای کاهش بیشتر، ابتدا مقدار ثبت شده توسط کارشناسان پهنه را اصلاح کنید.";
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
