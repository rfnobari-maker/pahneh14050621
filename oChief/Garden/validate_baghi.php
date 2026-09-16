<?php
/**
 * تابع مشترک اعتبارسنجی برش شهرستان - محصولات باغی
 * سازگار با PHP 5.3.3
 * 
 * فیلدهای باغی:
 * - s_bar_abi    : سطح بارور آبی
 * - s_bar_dem    : سطح بارور دیم
 * - s_nobar_abi  : سطح غیربارور آبی
 * - s_nobar_dem  : سطح غیربارور دیم
 * - t_abi        : تولید آبی
 * - t_dem        : تولید دیم
 */

function getFieldLabelBaghi($field_name) {
    $labels = array(
        's_bar_abi'   => 'سطح بارور آبی',
        's_bar_dem'   => 'سطح بارور دیم',
        's_nobar_abi' => 'سطح غیربارور آبی',
        's_nobar_dem' => 'سطح غیربارور دیم',
        't_abi'       => 'تولید آبی',
        't_dem'       => 'تولید دیم'
    );
    return isset($labels[$field_name]) ? $labels[$field_name] : $field_name;
}

/**
 * تابع اعتبارسنجی برش شهرستان برای محصولات باغی
 * 
 * @param object $dbh اتصال PDO به دیتابیس
 * @param array $params پارامترهای مورد نیاز
 * @return array نتیجه اعتبارسنجی با اطلاعات کامل
 */
function validateCityAllocationBaghi($dbh, $params) {
    // تنظیمات پیش‌فرض
    $defaults = array(
        'check_centers' => true,  // آیا کنترل کاهش با مراکز انجام شود؟
        'product_cod'   => null   // کد محصول (اختیاری)
    );
    $params = array_merge($defaults, $params);
    
    // استخراج پارامترها
    $id_ostan     = $params['id_ostan'];
    $id_city      = $params['id_city'];
    $z_sal        = $params['z_sal'];
    $product_cod  = $params['product_cod'];
    $field_name   = $params['field_name'];
    $new_value    = floatval($params['new_value']);
    $current_record_id = isset($params['current_record_id']) ? intval($params['current_record_id']) : null;
    $check_centers = $params['check_centers'];
    
    // لیست فیلدهای مجاز باغی
    $allowed_fields = array('s_bar_abi', 's_bar_dem', 's_nobar_abi', 's_nobar_dem', 't_abi', 't_dem');
    if (!in_array($field_name, $allowed_fields)) {
        return array(
            'valid' => false,
            'message' => '⚠️ فیلد نامعتبر'
        );
    }
    
    // مقدار نمی‌تواند منفی باشد
    if ($new_value < 0) {
        return array(
            'valid' => false,
            'message' => '⚠️ مقدار نمی‌تواند منفی باشد.'
        );
    }
    
    // ساختار پاسخ
    $result = array(
        'valid' => true,
        'message' => '',
        'data' => array(
            // اطلاعات سقف و مجموع
            'city_limit'      => 0,        // سقف ابلاغی استان
            'current_sum'     => 0,        // مجموع کل فعلی (همه شهرستان‌ها)
            'other_cities_sum'=> 0,        // مجموع سایر شهرستان‌ها (به جز رکورد جاری)
            'total_current'   => 0,        // مجموع کل فعلی (شامل این رکورد)
            'remaining'       => 0,        // موجودی قابل تخصیص (قبل از تغییر)
            'new_remaining'   => 0,        // موجودی پس از تغییر
            'max_allowed'     => 0,        // حداکثر مجاز برای این رکورد
            'current_value'   => 0,        // مقدار فعلی این رکورد
            'requested_value' => $new_value, // مقدار درخواستی
            
            // اطلاعات مراکز (برای کنترل کاهش)
            'centers_sum'     => 0,        // مجموع مراکز این شهرستان
            'min_allowed'     => 0,        // حداقل مقدار مجاز (بر اساس مراکز)
            
            // اطلاعات اضافی برای نمایش
            'field_label'     => getFieldLabelBaghi($field_name)
        )
    );
    
    try {
        // ============================================================
        // ۱. دریافت سقف استان (Garden_ab_ostan)
        // ============================================================
        $query1 = "SELECT {$field_name} FROM Garden_ab_ostan 
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
        
        // ============================================================
        // ۲. مقدار فعلی رکورد (در صورت ویرایش)
        // ============================================================
        $current_value = 0;
        if ($current_record_id) {
            $query_current = "SELECT {$field_name} FROM Garden_ab_city WHERE id = ?";
            $stmt_current = $dbh->prepare($query_current);
            $stmt_current->execute(array($current_record_id));
            $current_value = floatval($stmt_current->fetchColumn());
            $result['data']['current_value'] = $current_value;
        }
        
        // ============================================================
        // ۳. مجموع سایر شهرستان‌ها (به جز رکورد جاری)
        // ============================================================
        $query_sum = "SELECT SUM({$field_name}) FROM Garden_ab_city 
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
        
        // ============================================================
        // ۴. مجموع کل فعلی (شامل این رکورد)
        // ============================================================
        $total_current = $other_cities_sum + $current_value;
        $result['data']['total_current'] = $total_current;
        $result['data']['current_sum'] = $total_current;
        
        // ============================================================
        // ۵. محاسبه مجموع مراکز (برای کنترل کاهش)
        // ============================================================
        $centers_sum = 0;
        $min_allowed = 0;
        if ($check_centers) {
            $query_centers = "SELECT SUM({$field_name}) FROM Garden_ab_mar 
                              WHERE z_sal = ? AND id_ostan = ? AND id_city = ? AND product_cod = ?";
            $stmt_centers = $dbh->prepare($query_centers);
            $stmt_centers->execute(array($z_sal, $id_ostan, $id_city, $product_cod));
            $centers_sum = floatval($stmt_centers->fetchColumn());
            $result['data']['centers_sum'] = $centers_sum;
            $min_allowed = $centers_sum;
            $result['data']['min_allowed'] = $min_allowed;
        }
        
        // ============================================================
        // ۶. محاسبات جدید
        // ============================================================
        $new_total = $other_cities_sum + $new_value;        // مجموع جدید بعد از اعمال تغییر
        $remaining = $city_limit - $total_current;          // موجودی قبل از تغییر
        $new_remaining = $city_limit - $new_total;          // موجودی پس از اعمال مقدار جدید
        $max_allowed = $city_limit - $other_cities_sum;     // حداکثر مجاز برای این رکورد
        
        $result['data']['remaining'] = $remaining;
        $result['data']['new_remaining'] = $new_remaining;
        $result['data']['max_allowed'] = $max_allowed;
        
        // ============================================================
        // ۷. کنترل افزایش (نمی‌توان از سقف استان بیشتر شد)
        // ============================================================
        if ($new_total > $city_limit) {
            $result['valid'] = false;
            $result['message'] = "❌ امکان افزایش " . getFieldLabelBaghi($field_name) . " وجود ندارد.\n\n" .
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
        
        // ============================================================
        // ۸. کنترل کاهش (نمی‌توان از مجموع مراکز کمتر شد)
        // ============================================================
        // شرط: اگر مقدار جدید از مجموع مراکز کمتر باشد و همچنین از مقدار فعلی کمتر باشد
        if ($check_centers && $new_value < $centers_sum && $new_value < $current_value) {
            $result['valid'] = false;
            $result['message'] = "❌ امکان کاهش " . getFieldLabelBaghi($field_name) . " وجود ندارد.\n\n" .
                "📊 اطلاعات لحظه‌ای:\n" .
                "مقدار فعلی شهرستان: " . number_format($current_value) . "\n" .
                "مجموع مراکز: " . number_format($centers_sum) . "\n" .
                "حداقل مقدار مجاز: " . number_format($centers_sum) . "\n" .
                "مقدار درخواستی شما: " . number_format($new_value) . "\n\n" .
                "💡 برای کاهش بیشتر، ابتدا برش مراکز را اصلاح کنید.";
            return $result;
        }
        
        // ============================================================
        // ۹. مقدار مجاز است
        // ============================================================
        $result['valid'] = true;
        $result['message'] = '✅ مقدار مجاز است.';
        return $result;
        
    } catch (PDOException $e) {
        $result['valid'] = false;
        $result['message'] = '⚠️ خطای پایگاه‌داده: ' . $e->getMessage();
        return $result;
    }
}

/**
 * تابع کمکی برای دریافت خلاصه اطلاعات یک محصول باغی در یک شهرستان
 * برای نمایش در باکس اطلاعات کلی (Summary Box)
 * 
 * @param object $dbh اتصال PDO
 * @param array $params پارامترها
 * @return array خلاصه اطلاعات برای هر ۶ فیلد
 */
function getBaghiSummaryData($dbh, $params) {
    $id_ostan    = $params['id_ostan'];
    $id_city     = isset($params['id_city']) ? $params['id_city'] : null;
    $z_sal       = $params['z_sal'];
    $product_cod = $params['product_cod'];
    
    $fields = array('s_bar_abi', 's_bar_dem', 's_nobar_abi', 's_nobar_dem', 't_abi', 't_dem');
    $summary = array();
    
    foreach ($fields as $field) {
        // دریافت سقف استان
        $q_limit = "SELECT {$field} FROM Garden_ab_ostan 
                    WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $stmt_limit = $dbh->prepare($q_limit);
        $stmt_limit->execute(array($z_sal, $id_ostan, $product_cod));
        $city_limit = floatval($stmt_limit->fetchColumn());
        
        // دریافت مجموع کل (همه شهرستان‌ها)
        $q_sum = "SELECT SUM({$field}) FROM Garden_ab_city 
                  WHERE z_sal = ? AND id_ostan = ? AND product_cod = ?";
        $params_sum = array($z_sal, $id_ostan, $product_cod);
        
        // اگر شهرستان مشخص باشد، فقط همان شهرستان
        if ($id_city) {
            $q_sum .= " AND id_city = ?";
            $params_sum[] = $id_city;
        }
        
        $stmt_sum = $dbh->prepare($q_sum);
        $stmt_sum->execute($params_sum);
        $total_current = floatval($stmt_sum->fetchColumn());
        
        $summary[$field] = array(
            'limit'    => $city_limit,
            'total'    => $total_current,
            'remaining'=> $city_limit - $total_current
        );
    }
    
    return $summary;
}

/**
 * تابع کمکی برای تولید HTML باکس اطلاعات کلی (Summary Box)
 * 
 * @param array $summary_data خروجی تابع getBaghiSummaryData
 * @param string $product_name نام محصول
 * @return string HTML باکس اطلاعات کلی
 */
function renderBaghiSummaryBox($summary_data, $product_name = '') {

    $html = '
    <div class="summary-box" style="background: #e3f2fd; border: 2px solid #006699; border-radius: 8px; padding: 12px 20px; margin: 15px auto; width: 90%; text-align: right; font-family: Tahoma; font-size: 14px; line-height: 2; direction: rtl;">
        <div style="font-size:16px; font-weight:bold; color:#003366; border-bottom:1px solid #006699; padding-bottom:5px; margin-bottom:8px;">
            📊 اطلاعات کلی تخصیص محصول باغی: ' . htmlspecialchars($product_name) . '
        </div>
        <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
                <td width="50%" colspan="2" style="font-weight:bold; color:#003366;">سطح بارور</td>
                <td width="50%" colspan="2" style="font-weight:bold; color:#003366;">سطح غیربارور</td>
            </tr>
            <tr>
                <td width="25%"><span style="font-weight:bold; color:#003366;">آبی:</span></td>
                <td width="25%">سقف: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_bar_abi']['limit']) . '</span> | مجموع: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_bar_abi']['total']) . '</span> | موجودی: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_bar_abi']['remaining']) . '</span></td>
                <td width="25%"><span style="font-weight:bold; color:#003366;">آبی:</span></td>
                <td width="25%">سقف: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_nobar_abi']['limit']) . '</span> | مجموع: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_nobar_abi']['total']) . '</span> | موجودی: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_nobar_abi']['remaining']) . '</span></td>
            </tr>
            <tr>
                <td><span style="font-weight:bold; color:#003366;">دیم:</span></td>
                <td>سقف: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_bar_dem']['limit']) . '</span> | مجموع: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_bar_dem']['total']) . '</span> | موجودی: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_bar_dem']['remaining']) . '</span></td>
                <td><span style="font-weight:bold; color:#003366;">دیم:</span></td>
                <td>سقف: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_nobar_dem']['limit']) . '</span> | مجموع: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_nobar_dem']['total']) . '</span> | موجودی: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_nobar_dem']['remaining']) . '</span></td>
            </tr>
            <tr style="border-top:1px solid #ccc;">
                <td colspan="4" style="font-weight:bold; color:#003366; padding-top:8px;">تولید</td>
            </tr>
            <tr>
                <td><span style="font-weight:bold; color:#003366;">آبی:</span></td>
                <td>سقف: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['t_abi']['limit']) . '</span> | مجموع: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['t_abi']['total']) . '</span> | موجودی: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['t_abi']['remaining']) . '</span></td>
                <td><span style="font-weight:bold; color:#003366;">دیم:</span></td>
                <td>سقف: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['t_dem']['limit']) . '</span> | مجموع: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['t_dem']['total']) . '</span> | موجودی: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['t_dem']['remaining']) . '</span></td>
            </tr>
        </table>
        <div style="font-size:12px; color:#666; margin-top:5px; border-top:1px solid #ccc; padding-top:5px;">
            💡 برای هر شهرستان، مقدار مورد نظر را وارد کنید. موجودی جدید پس از اعمال تغییر در هر ردیف نمایش داده می‌شود.
        </div>
    </div>';
    
    return $html;
}
?>