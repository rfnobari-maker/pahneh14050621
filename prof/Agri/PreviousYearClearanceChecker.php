<?php
/**
 * کلاس بررسی تعیین‌تکلیف محصولات سال قبل
 * فقط برای سال زراعی 1405-1406 به بعد
 * PHP 5.3 Compatible
 */
class PreviousYearClearanceChecker {
    
    private $dbh;
    private $bah_cod_m;
    private $mor_cod_m;
    private $current_z_sal;
    private $previous_z_sal;
    private $section;
    private $excluded_products;
    
    /**
     * حداقل سال زراعی مشمول قانون
     */
    const MIN_ELIGIBLE_YEAR = 1406;
    
    /**
     * نقشه تنظیمات بخش‌ها
     * برای افزودن بخش جدید فقط یک کلید به این آرایه اضافه کنید
     */
    private $sectionConfig = array(
        'agri' => array(
            'table_prefix'    => 'Agri_prod',
            'table_is_dynamic'=> true,
            'area_fields'     => array('zer_kesht_a', 'zer_kesht_b'),
        ),
        'vege' => array(
            'table_prefix'    => 'Vege_prod',
            'table_is_dynamic'=> false,
            'area_fields'     => array('zer_kesht'),
        ),
    );
    
    /**
     * لیست محصولات استثناء (بدون کد تکراری)
     */
    private $default_excluded_products = array(
        '106','120', '154', '144', '108', '136', '172',
        '170', '128', '112', '208', '156', '202', '246'
    );
    
    /**
     * سازنده کلاس
     */
    public function __construct($dbh, $bah_cod_m, $mor_cod_m, $current_z_sal, $section, $additional_excluded = array()) {
        $this->dbh            = $dbh;
        $this->bah_cod_m      = $bah_cod_m;
        $this->mor_cod_m      = $mor_cod_m;
        $this->current_z_sal  = $current_z_sal;
        $this->section        = $section;
        $this->previous_z_sal = $this->getPreviousYear();
        
        $this->excluded_products = array_values(array_unique(
            array_merge($this->default_excluded_products, $additional_excluded)
        ));
    }
    
    /**
     * محاسبه سال قبل
     * مثال: 1406-1405 → 1405-1404
     */
    private function getPreviousYear() {
        $parts = explode('-', $this->current_z_sal);
        if (count($parts) != 2) {
            return '';
        }
        return ((int)$parts[0] - 1) . '-' . ((int)$parts[1] - 1);
    }
    
    /**
     * بررسی مشمولیت سال - داینامیک (بدون لیست سخت‌کد)
     */
    private function isYearEligible() {
        $parts = explode('-', $this->current_z_sal);
        if (count($parts) != 2) {
            return false;
        }
        $maxYear = max((int)$parts[0], (int)$parts[1]);
        return $maxYear >= self::MIN_ELIGIBLE_YEAR;
    }
    
    /**
     * اعتبارسنجی فرمت سال برای جلوگیری از SQL Injection در نام جدول
     */
    private function isValidYearFormat() {
        return (bool)preg_match('/^1[34]\d{2}-1[34]\d{2}$/', $this->current_z_sal);
    }
    
    // ============================================================
    // API عمومی
    // ============================================================
    
    public function getExcludedProducts() {
        return $this->excluded_products;
    }
    
    public function setExcludedProducts($excluded_products) {
        $this->excluded_products = array_values(array_unique($excluded_products));
    }
    
    public function addExcludedProduct($product_code) {
        if (!in_array($product_code, $this->excluded_products)) {
            $this->excluded_products[] = $product_code;
        }
    }
    
    public function removeExcludedProduct($product_code) {
        $key = array_search($product_code, $this->excluded_products);
        if ($key !== false) {
            unset($this->excluded_products[$key]);
            $this->excluded_products = array_values($this->excluded_products);
            return true;
        }
        return false;
    }
    
    // ============================================================
    // متد اصلی بررسی
    // ============================================================
    
    public function check() {
        $result = array(
            'has_uncleared'      => false,
            'uncleared_products' => array(),
            'message'            => '',
            'excluded_products'  => $this->excluded_products
        );
        
        if (!$this->isValidYearFormat() || !$this->isYearEligible()) {
            $result['message'] = 'سال جاری مشمول بررسی تعیین‌تکلیف سال قبل نمی‌شود';
            return $result;
        }
        
        if (empty($this->previous_z_sal)) {
            $result['message'] = 'سال قبل معتبر نیست';
            return $result;
        }
        
        if (!isset($this->sectionConfig[$this->section])) {
            $result['message'] = 'نوع بخش نامعتبر است';
            return $result;
        }
        
        $uncleared = $this->findUnclearedProducts();
        
        if (count($uncleared) > 0) {
            $result['has_uncleared']      = true;
            $result['uncleared_products'] = $uncleared;
            $result['message']            = $this->buildErrorMessage($uncleared);
        } else {
            $result['message'] = 'همه محصولات سال قبل تعیین‌تکلیف شده‌اند';
        }
        
        return $result;
    }
    
    // ============================================================
    // منطق یکپارچه بررسی (agri و vege)
    // ============================================================
    
    /**
     * یافتن محصولات تعیین‌تکلیف‌نشده
     * 
     * شرط اصلی:
     *   - مجموع سطح کشت > 0
     *   - عملکرد قطعی (mah_tol) خالی
     *   - خسارت (mah_kh) ثبت نشده (خالی یا '0')
     *   - در لیست استثناء نباشد
     */
    private function findUnclearedProducts() {
        $config = $this->sectionConfig[$this->section];
        
        // ---- ساخت نام جدول ----
        if ($config['table_is_dynamic']) {
            $table_name = $config['table_prefix'] . str_replace('-', '_', $this->previous_z_sal);
        } else {
            $table_name = $config['table_prefix'];
        }
        
        // ---- ساخت بخش SELECT برای فیلدهای سطح کشت ----
        $area_selects = array();
        foreach ($config['area_fields'] as $field) {
            $area_selects[] = "p.`$field`";
        }
        $area_select_sql = implode(', ', $area_selects);
        
        // ---- ساخت شرط مجموع سطح کشت ----
        $area_conditions = array();
        foreach ($config['area_fields'] as $field) {
            $area_conditions[] = "COALESCE(p.`$field`, 0)";
        }
        $area_sum_sql = '(' . implode(' + ', $area_conditions) . ') > 0';
        
        // ---- کوئری پایه ----
        // شرط mah_kh: فقط '', '0' یا NULL به معنی ثبت نشده است
        $query = "SELECT p.id, p.cod_mah, p.mah_tol, p.mah_kh, p.z_sal, $area_select_sql
                  FROM `$table_name` p
                  WHERE p.bah_cod_m = :bah_cod_m
                    AND p.mor_cod_m = :mor_cod_m
                    AND (p.mah_tol IS NULL OR p.mah_tol = 0 OR p.mah_tol = '')
                    AND (p.mah_kh IS NULL OR p.mah_kh != '1')
                    AND $area_sum_sql";
        
        $params = array(
            ':bah_cod_m' => $this->bah_cod_m,
            ':mor_cod_m' => $this->mor_cod_m
        );
        
        // ---- فیلتر سال (فقط برای جداول غیرداینامیک مثل Vege_prod) ----
        if (!$config['table_is_dynamic']) {
            $query .= " AND p.z_sal = :z_sal";
            $params[':z_sal'] = $this->previous_z_sal;
        }
        
        // ---- فیلتر محصولات استثناء ----
        if (!empty($this->excluded_products)) {
            $placeholders = array();
            foreach ($this->excluded_products as $index => $cod) {
                $key = ':excluded_' . $index;
                $placeholders[] = $key;
                $params[$key]   = $cod;
            }
            $query .= " AND p.cod_mah NOT IN (" . implode(', ', $placeholders) . ")";
        }
        
        $query .= " ORDER BY p.id";
        
        $stmt = $this->dbh->prepare($query);
        $stmt->execute($params);
        
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($rows)) {
            return array();
        }
        
        // ---- دریافت نام همه محصولات با یک کوئری (رفع N+1) ----
        $cods = array();
        foreach ($rows as $r) {
            $cods[] = $r['cod_mah'];
        }
        $productNames = $this->getProductNames(array_unique($cods));
        
        // ---- ساخت آرایه خروجی ----
        $uncleared = array();
        foreach ($rows as $row) {
            $item = array(
                'id'           => $row['id'],
                'cod_mah'      => $row['cod_mah'],
                'product_name' => isset($productNames[$row['cod_mah']])
                                    ? $productNames[$row['cod_mah']]
                                    : 'کد ' . $row['cod_mah'],
                'mah_tol'      => $row['mah_tol'],
                'mah_kh'       => $row['mah_kh'],
                'z_sal'        => $row['z_sal']
            );
            // افزودن داینامیک فیلدهای سطح کشت
            foreach ($config['area_fields'] as $field) {
                $item[$field] = $row[$field];
            }
            $uncleared[] = $item;
        }
        
        return $uncleared;
    }
    
    // ============================================================
    // دریافت نام محصولات به صورت دسته‌ای (رفع N+1)
    // ============================================================
    
    /**
     * دریافت نام چند محصول با یک کوئری
     * 
     * @param array $cod_list لیست کد محصولات
     * @return array [cod => name]
     */
    private function getProductNames($cod_list) {
        // فیلتر مقادیر خالی
        $clean = array();
        foreach ($cod_list as $cod) {
            if ($cod !== '' && $cod !== null) {
                $clean[] = $cod;
            }
        }
        $clean = array_values(array_unique($clean));
        if (empty($clean)) {
            return array();
        }
        
        $placeholders = array();
        $params = array();
        foreach ($clean as $i => $cod) {
            $key = ':pc_' . $i;
            $placeholders[] = $key;
            $params[$key]   = $cod;
        }
        
        $query = "SELECT product_cod, product_name FROM product_z 
                  WHERE product_cod IN (" . implode(', ', $placeholders) . ")";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute($params);
        
        $result = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['product_cod']] = $row['product_name'];
        }
        return $result;
    }
    
    // ============================================================
    // ساخت پیام خطا (بهینه‌شده با یک کوئری)
    // ============================================================
    
    private function buildErrorMessage($uncleared) {
        // ---- جمع‌آوری همه کدها برای یک کوئری واحد ----
        $all_cods = array();
        foreach ($uncleared as $item) {
            $all_cods[] = $item['cod_mah'];
        }
        foreach ($this->excluded_products as $cod) {
            $all_cods[] = $cod;
        }
        $productNames = $this->getProductNames($all_cods);
        
        // ---- لیست محصولات تعیین‌تکلیف‌نشده ----
        $product_names = array();
        foreach ($uncleared as $item) {
            $name = isset($productNames[$item['cod_mah']])
                        ? $productNames[$item['cod_mah']]
                        : 'کد ' . $item['cod_mah'];
            $product_names[] = $name . ' (کد: ' . $item['cod_mah'] . ')';
        }
        
        $message  = 'امکان ثبت محصول جدید برای این بهره‌بردار وجود ندارد. ';
        $message .= 'لطفاً ابتدا نسبت به تعیین‌تکلیف سوابق سال زراعی ' . $this->previous_z_sal . ' (ثبت عملکرد قطعی یا خسارت) ';
        $message .= 'برای محصولات زیر اقدام نمایید:' . "\n";
        $message .= '- ' . implode("\n- ", $product_names);
        
        // ---- لیست محصولات استثناء ----
        if (!empty($this->excluded_products)) {
            $excluded_names = array();
            foreach ($this->excluded_products as $cod) {
                $name = isset($productNames[$cod]) ? $productNames[$cod] : 'کد ' . $cod;
                $excluded_names[] = $name . ' (کد: ' . $cod . ')';
            }
            $message .= "\n\n" . 'محصولات زیر در لیست استثناء قرار دارند و نیازی به تعیین‌تکلیف ندارند:' . "\n";
            $message .= '- ' . implode("\n- ", $excluded_names);
        }
        
        return $message;
    }
}
?>