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
     * لیست محصولات استثناء
     * برای اضافه یا حذف کافیست این آرایه را ویرایش کنید
     */
    private $default_excluded_products = array('144', '108', '136', '172', '170');
    
    /**
     * سازنده کلاس
     * 
     * @param object $dbh اتصال دیتابیس
     * @param string $bah_cod_m کد بهره‌بردار
     * @param string $mor_cod_m کد کارشناس (کاربر لاگین شده)
     * @param string $current_z_sal سال زراعی جاری (مثلاً 1406-1405)
     * @param string $section نوع بخش: 'agri' یا 'vege'
     * @param array $additional_excluded محصولات استثناء اضافی (اختیاری)
     */
    public function __construct($dbh, $bah_cod_m, $mor_cod_m, $current_z_sal, $section, $additional_excluded = array()) {
        $this->dbh = $dbh;
        $this->bah_cod_m = $bah_cod_m;
        $this->mor_cod_m = $mor_cod_m;
        $this->current_z_sal = $current_z_sal;
        $this->section = $section;
        $this->previous_z_sal = $this->getPreviousYear();
        
        // ترکیب لیست پیش‌فرض با لیست اضافی
        $this->excluded_products = array_merge($this->default_excluded_products, $additional_excluded);
        // حذف مقادیر تکراری
        $this->excluded_products = array_unique($this->excluded_products);
    }
    
    /**
     * محاسبه سال قبل
     * مثال: 1406-1405 → 1405-1404
     * 
     * @return string
     */
    private function getPreviousYear() {
        $parts = explode('-', $this->current_z_sal);
        if (count($parts) != 2) {
            return '';
        }
        $year1 = (int)$parts[0] - 1;
        $year2 = (int)$parts[1] - 1;
        return $year1 . '-' . $year2;
    }
    
    /**
     * بررسی آیا سال جاری مشمول قانون می‌شود؟
     * فقط از سال 1405-1406 به بعد
     * 
     * @return bool
     */
    private function isYearEligible() {
        $eligibleYears = array('1405-1406', '1406-1405', '1407-1406', '1408-1407', '1409-1408', '1410-1409');
        return in_array($this->current_z_sal, $eligibleYears);
    }
    
    /**
     * دریافت لیست محصولات استثناء
     * 
     * @return array
     */
    public function getExcludedProducts() {
        return $this->excluded_products;
    }
    
    /**
     * تنظیم لیست محصولات استثناء (بازنویسی کامل)
     * 
     * @param array $excluded_products
     */
    public function setExcludedProducts($excluded_products) {
        $this->excluded_products = $excluded_products;
    }
    
    /**
     * اضافه کردن محصول به لیست استثناء
     * 
     * @param string $product_code
     */
    public function addExcludedProduct($product_code) {
        if (!in_array($product_code, $this->excluded_products)) {
            $this->excluded_products[] = $product_code;
        }
    }
    
    /**
     * حذف محصول از لیست استثناء
     * 
     * @param string $product_code
     * @return bool
     */
    public function removeExcludedProduct($product_code) {
        $key = array_search($product_code, $this->excluded_products);
        if ($key !== false) {
            unset($this->excluded_products[$key]);
            $this->excluded_products = array_values($this->excluded_products); // بازآرایی ایندکس
            return true;
        }
        return false;
    }
    
    /**
     * بررسی اصلی - آیا محصولات تعیین‌تکلیف نشده وجود دارد؟
     * 
     * @return array ['has_uncleared' => bool, 'uncleared_products' => array, 'message' => string]
     */
    public function check() {
        $result = array(
            'has_uncleared' => false,
            'uncleared_products' => array(),
            'message' => '',
            'excluded_products' => $this->excluded_products // برای نمایش محصولات استثناء
        );
        
        if (!$this->isYearEligible()) {
            $result['message'] = 'سال جاری مشمول بررسی تعیین‌تکلیف سال قبل نمی‌شود';
            return $result;
        }
        
        if (empty($this->previous_z_sal)) {
            $result['message'] = 'سال قبل معتبر نیست';
            return $result;
        }
        
        if ($this->section == 'agri') {
            $uncleared = $this->checkAgriPreviousYear();
        } elseif ($this->section == 'vege') {
            $uncleared = $this->checkVegePreviousYear();
        } else {
            $result['message'] = 'نوع بخش نامعتبر است';
            return $result;
        }
        
        if (count($uncleared) > 0) {
            $result['has_uncleared'] = true;
            $result['uncleared_products'] = $uncleared;
            $result['message'] = $this->buildErrorMessage($uncleared);
        } else {
            $result['message'] = 'همه محصولات سال قبل تعیین‌تکلیف شده‌اند';
        }
        
        return $result;
    }
    
    /**
     * بررسی محصولات زراعی سال قبل
     * 
     * @return array لیست محصولات تعیین‌تکلیف نشده
     */
    private function checkAgriPreviousYear() {
        $uncleared = array();
        
        $table_name = 'Agri_prod' . str_replace('-', '_', $this->previous_z_sal);
        
        $check_query = "SELECT COUNT(*) as total FROM `$table_name` WHERE bah_cod_m = :bah_cod_m AND mor_cod_m = :mor_cod_m";
        $check_stmt = $this->dbh->prepare($check_query);
        $check_stmt->execute(array(
            ':bah_cod_m' => $this->bah_cod_m,
            ':mor_cod_m' => $this->mor_cod_m
        ));
        $check_row = $check_stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($check_row['total'] == 0) {
            return $uncleared;
        }
        
        $query = "SELECT p.id, p.cod_mah, p.mah_tol, p.mah_kh, p.z_sal 
                  FROM `$table_name` p
                  WHERE p.bah_cod_m = :bah_cod_m 
                  AND p.mor_cod_m = :mor_cod_m
                  AND (p.mah_tol IS NULL OR p.mah_tol = 0 OR p.mah_tol = '')
                  AND (p.mah_kh IS NULL OR p.mah_kh != '1' OR p.mah_kh = '')";
        
        // اعمال فیلتر محصولات استثناء
        if (!empty($this->excluded_products)) {
            $placeholders = array();
            foreach ($this->excluded_products as $index => $cod) {
                $placeholders[] = ':excluded_' . $index;
            }
            $query .= " AND p.cod_mah NOT IN (" . implode(', ', $placeholders) . ")";
        }
        
        $query .= " ORDER BY p.id";
        
        $stmt = $this->dbh->prepare($query);
        
        $params = array(
            ':bah_cod_m' => $this->bah_cod_m,
            ':mor_cod_m' => $this->mor_cod_m
        );
        
        if (!empty($this->excluded_products)) {
            foreach ($this->excluded_products as $index => $cod) {
                $params[':excluded_' . $index] = $cod;
            }
        }
        
        $stmt->execute($params);
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product_name = $this->getProductName($row['cod_mah']);
            $uncleared[] = array(
                'id' => $row['id'],
                'cod_mah' => $row['cod_mah'],
                'product_name' => $product_name,
                'mah_tol' => $row['mah_tol'],
                'mah_kh' => $row['mah_kh'],
                'z_sal' => $row['z_sal']
            );
        }
        
        return $uncleared;
    }
    
    /**
     * بررسی محصولات صیفی سال قبل
     * 
     * @return array لیست محصولات تعیین‌تکلیف نشده
     */
    private function checkVegePreviousYear() {
        $uncleared = array();
        
        $check_query = "SELECT COUNT(*) as total FROM Vege_prod WHERE bah_cod_m = :bah_cod_m AND mor_cod_m = :mor_cod_m AND z_sal = :z_sal";
        $check_stmt = $this->dbh->prepare($check_query);
        $check_stmt->execute(array(
            ':bah_cod_m' => $this->bah_cod_m,
            ':mor_cod_m' => $this->mor_cod_m,
            ':z_sal' => $this->previous_z_sal
        ));
        $check_row = $check_stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($check_row['total'] == 0) {
            return $uncleared;
        }
        
        $query = "SELECT p.id, p.cod_mah, p.z_sal, p.Vege_id
                  FROM Vege_prod p
                  WHERE p.bah_cod_m = :bah_cod_m 
                  AND p.mor_cod_m = :mor_cod_m
                  AND p.z_sal = :z_sal
                  AND (p.mah_tol IS NULL OR p.mah_tol = 0 OR p.mah_tol = '')
                  AND (p.mah_kh IS NULL OR p.mah_kh != '1' OR p.mah_kh = '')";
        
        // اعمال فیلتر محصولات استثناء
        if (!empty($this->excluded_products)) {
            $placeholders = array();
            foreach ($this->excluded_products as $index => $cod) {
                $placeholders[] = ':excluded_' . $index;
            }
            $query .= " AND p.cod_mah NOT IN (" . implode(', ', $placeholders) . ")";
        }
        
        $query .= " ORDER BY p.id";
        
        $stmt = $this->dbh->prepare($query);
        
        $params = array(
            ':bah_cod_m' => $this->bah_cod_m,
            ':mor_cod_m' => $this->mor_cod_m,
            ':z_sal' => $this->previous_z_sal
        );
        
        if (!empty($this->excluded_products)) {
            foreach ($this->excluded_products as $index => $cod) {
                $params[':excluded_' . $index] = $cod;
            }
        }
        
        $stmt->execute($params);
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product_name = $this->getProductName($row['cod_mah']);
            $uncleared[] = array(
                'id' => $row['id'],
                'cod_mah' => $row['cod_mah'],
                'product_name' => $product_name,
                'z_sal' => $row['z_sal']
            );
        }
        
        return $uncleared;
    }
    
    /**
     * دریافت نام محصول از کد آن
     * 
     * @param string $cod_mah
     * @return string
     */
    private function getProductName($cod_mah) {
        if (empty($cod_mah)) {
            return 'نامشخص';
        }
        
        $query = "SELECT product_name FROM product_z WHERE product_cod = :cod_mah LIMIT 1";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute(array(':cod_mah' => $cod_mah));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row ? $row['product_name'] : 'کد ' . $cod_mah;
    }
    
    /**
     * ساخت پیام خطا
     * 
     * @param array $uncleared لیست محصولات تعیین‌تکلیف نشده
     * @return string
     */
    private function buildErrorMessage($uncleared) {
        $product_names = array();
        foreach ($uncleared as $item) {
            $product_names[] = $item['product_name'] . ' (کد: ' . $item['cod_mah'] . ')';
        }
        
        $message = 'امکان ثبت محصول جدید برای این بهره‌بردار وجود ندارد. ';
        $message .= 'لطفاً ابتدا نسبت به تعیین‌تکلیف سوابق سال زراعی ' . $this->previous_z_sal . ' (ثبت عملکرد قطعی یا خسارت) ';
        $message .= 'برای محصولات زیر اقدام نمایید:' . "\n";
        $message .= '- ' . implode("\n- ", $product_names);
        
        // اضافه کردن اطلاعات محصولات استثناء
        if (!empty($this->excluded_products)) {
            $excluded_names = array();
            foreach ($this->excluded_products as $cod) {
                $name = $this->getProductName($cod);
                $excluded_names[] = $name . ' (کد: ' . $cod . ')';
            }
            $message .= "\n\n" . 'محصولات زیر در لیست استثناء قرار دارند و نیازی به تعیین‌تکلیف ندارند:' . "\n";
            $message .= '- ' . implode("\n- ", $excluded_names);
        }
        
        return $message;
    }
}
?>