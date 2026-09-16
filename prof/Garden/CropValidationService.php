<?php
include_once('../../login/config.php');

class CropValidationService {

    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    /**
     * اعتبارسنجی سطح کشت باغی بر اساس الگوی کشت ابلاغی
     *
     * @param int|null $current_product_garden_prod_id شناسه محصول فعلی (برای ویرایش)
     * @param int $garden_id شناسه باغ از جدول Garden
     * @param string $product_code کد محصول
     * @param float $s_kesht_b سطح کشت بارور جدید
     * @param float $s_kesht_gb سطح کشت غیربارور جدید
     * @param string $z_sal سال زراعی
     * @param int $id_ostan کد استان
     * @param int $id_city کد شهرستان
     * @param int $id_mar کد مرکز جهاد
     * @param int $no_kesh نوع کشت (1=آبی، 2=دیم)
     * @param float $current_batch_total_bar مجموع سطح بارور همین محصول در بچ جاری
     * @param float $current_batch_total_nobar مجموع سطح غیربارور همین محصول در بچ جاری
     * @return array ['isValid' => bool, 'message' => string]
     */
    public function validateCultivatedAreaAgainstAllocation(
        $current_product_garden_prod_id,
        $garden_id,
        $product_code,
        $s_kesht_b_new,
        $s_kesht_gb_new,
        $z_sal,
        $id_ostan,
        $id_city,
        $id_mar,
        $no_kesh,
        $current_batch_total_bar = 0,
        $current_batch_total_nobar = 0
    ){

        $s_kesht_b_new = (float)$s_kesht_b_new;
        $s_kesht_gb_new = (float)$s_kesht_gb_new;

        // پاکسازی ورودی‌ها
        $z_sal = preg_replace('/[^0-9\-]/', '', $z_sal);
        $id_ostan = preg_replace('/[^0-9]/', '', $id_ostan);
        $id_city = preg_replace('/[^0-9]/', '', $id_city);
        $id_mar = preg_replace('/[^0-9]/', '', $id_mar);
        $no_kesh = preg_replace('/[^0-9]/', '', $no_kesh);

        // دریافت سطح ابلاغی از جدول Garden_ab_mar
        $query_allocation = "
            SELECT s_bar_abi, s_bar_dem, s_nobar_abi, s_nobar_dem
            FROM `Garden_ab_mar`
            WHERE product_cod = :product_code
            AND id_ostan = :id_ostan
            AND id_city = :id_city
            AND id_mar = :id_mar
            AND z_sal = :z_sal
            LIMIT 1";

        $stmt = $this->dbh->prepare($query_allocation);
        $stmt->bindValue(':product_code', $product_code);
        $stmt->bindValue(':id_ostan', $id_ostan);
        $stmt->bindValue(':id_city', $id_city);
        $stmt->bindValue(':id_mar', $id_mar);
        $stmt->bindValue(':z_sal', $z_sal);
        $stmt->execute();

        $allocation_data = $stmt->fetch(PDO::FETCH_ASSOC);

        // اگر الگوی کشت ثبت نشده باشد، ثبت سطح کشت ممنوع است
        if (!$allocation_data) {
            if ($s_kesht_b_new == 0 && $s_kesht_gb_new == 0) {
                return array(
                    'isValid' => true,
                    'message' => ''
                );
            } else {
                return array(
                    'isValid' => false,
                    'message' => 'الگوی کشت (سطح ابلاغی) برای این محصول ثبت نشده است. لطفاً ابتدا الگوی کشت را تعریف کنید.'
                );
            }
        }

        // تعیین مقادیر ابلاغی بر اساس نوع کشت (آبی/دیم)
        if ($no_kesh == 1) { // آبی
            $allocated_bar = (float)$allocation_data['s_bar_abi'];
            $allocated_nobar = (float)$allocation_data['s_nobar_abi'];
        } else { // دیم
            $allocated_bar = (float)$allocation_data['s_bar_dem'];
            $allocated_nobar = (float)$allocation_data['s_nobar_dem'];
        }

        // محاسبه مجموع سطح کشت قبلی برای این محصول در این محدوده
        $sum_query = "
            SELECT SUM(gp.s_kesht_b) AS total_bar, SUM(gp.s_kesht_gb) AS total_nobar
            FROM `Garden_prod` gp
            JOIN `Garden` g ON gp.Garden_id = g.id
            WHERE gp.cod_mah = :product_code
            AND g.id_ostan = :id_ostan
            AND g.id_city = :id_city
            AND g.id_mar = :id_mar
            AND g.no_kesh = :no_kesh
            AND g.z_sal = :z_sal";

        $params = array(
            ':product_code' => $product_code,
            ':id_ostan' => $id_ostan,
            ':id_city' => $id_city,
            ':id_mar' => $id_mar,
            ':no_kesh' => $no_kesh,
            ':z_sal' => $z_sal
        );

        // اگر در حال ویرایش هستیم، محصول فعلی را از محاسبه خارج کن
        if ($current_product_garden_prod_id != null) {
            $sum_query .= " AND gp.id != :current_id";
            $params[':current_id'] = intval($current_product_garden_prod_id);
        }

        $stmt_sum = $this->dbh->prepare($sum_query);
        $stmt_sum->execute($params);

        $row = $stmt_sum->fetch(PDO::FETCH_ASSOC);

        $current_total_bar = (float)$row['total_bar'];
        $current_total_nobar = (float)$row['total_nobar'];

        // محاسبه مجموع نهایی (قبلی + بچ جاری بارور/غیربارور جداگانه + جدید)
        $overall_total_bar = $current_total_bar + (float)$current_batch_total_bar + $s_kesht_b_new;
        $overall_total_nobar = $current_total_nobar + (float)$current_batch_total_nobar + $s_kesht_gb_new;

        // ========== اعتبارسنجی سطح بارور ==========
        if ($allocated_bar == 0) {
            // اگر سطح ابلاغی بارور صفر است، ثبت هرگونه سطح بارور ممنوع است
            if ($s_kesht_b_new > 0) {
                return array(
                    'isValid' => false,
                    'message' => 'خطا: سطح ابلاغی برای کشت بارور این محصول صفر است و امکان ثبت سطح کشت بارور وجود ندارد.'
                );
            }
        } else {
            // اگر سطح ابلاغی بارور بیشتر از صفر است، کل سطح نباید از آن بیشتر شود
            if ($overall_total_bar > $allocated_bar) {
                return array(
                    'isValid' => false,
                    'message' => 'خطا: مجموع سطح کشت بارور (' . number_format($overall_total_bar, 2) . 
                               ' هکتار) بیشتر از سطح ابلاغی (' . number_format($allocated_bar, 2) . ' هکتار) است'
                );
            }
        }

        // ========== اعتبارسنجی سطح غیربارور ==========
        if ($allocated_nobar == 0) {
            // اگر سطح ابلاغی غیربارور صفر است، ثبت هرگونه سطح غیربارور ممنوع است
            if ($s_kesht_gb_new > 0) {
                return array(
                    'isValid' => false,
                    'message' => 'خطا: سطح ابلاغی برای کشت غیربارور این محصول صفر است و امکان ثبت سطح کشت غیربارور وجود ندارد.'
                );
            }
        } else {
            // اگر سطح ابلاغی غیربارور بیشتر از صفر است، کل سطح نباید از آن بیشتر شود
            if ($overall_total_nobar > $allocated_nobar) {
                return array(
                    'isValid' => false,
                    'message' => 'خطا: مجموع سطح کشت غیربارور (' . number_format($overall_total_nobar, 2) . 
                               ' هکتار) بیشتر از سطح ابلاغی (' . number_format($allocated_nobar, 2) . ' هکتار) است'
                );
            }
        }

        return array(
            'isValid' => true,
            'message' => ''
        );
    }

    /**
     * فقط وجود نام محصول در الگوی کشت مرکز را بررسی می‌کند (بدون سقف سطح).
     * برای درختان پراکنده که سطح ندارند ولی باید در الگو باشند.
     *
     * @param string $product_code کد محصول
     * @param string $z_sal سال زراعی
     * @param int $id_ostan کد استان
     * @param int $id_city کد شهرستان
     * @param int $id_mar کد مرکز جهاد
     * @return array ['isValid' => bool, 'message' => string]
     */
    public function validateProductExistsInAllocation($product_code, $z_sal, $id_ostan, $id_city, $id_mar)
    {
        $z_sal = preg_replace('/[^0-9\-]/', '', $z_sal);
        $id_ostan = preg_replace('/[^0-9]/', '', $id_ostan);
        $id_city = preg_replace('/[^0-9]/', '', $id_city);
        $id_mar = preg_replace('/[^0-9]/', '', $id_mar);

        $query = "
            SELECT product_cod
            FROM `Garden_ab_mar`
            WHERE product_cod = :product_code
            AND id_ostan = :id_ostan
            AND id_city = :id_city
            AND id_mar = :id_mar
            AND z_sal = :z_sal
            LIMIT 1";

        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(':product_code', $product_code);
        $stmt->bindValue(':id_ostan', $id_ostan);
        $stmt->bindValue(':id_city', $id_city);
        $stmt->bindValue(':id_mar', $id_mar);
        $stmt->bindValue(':z_sal', $z_sal);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return array(
                'isValid' => false,
                'message' => 'این محصول در الگوی کشت مرکز ثبت نشده است.'
            );
        }

        return array(
            'isValid' => true,
            'message' => ''
        );
    }

    /**
     * بررسی حداکثر تولید مجاز
     *
     * @param string $product_code کد محصول
     * @param float $cultivated_area سطح کشت بارور (هکتار) — تولید فقط به سطح بارور وابسته است
     * @param float $production_amount میزان تولید وارد شده (تن)
     * @param int $no_kesh نوع کشت (1=آبی، 2=دیم)
     * @param string $production_type نوع تولید ('pishbini' یا 'ghatii')
     * @return array ['isValid' => bool, 'message' => string]
     */
    public function validateProductionLimit($product_code, $cultivated_area, $production_amount, $no_kesh, $production_type = 'pishbini')
    {
        // تولید فقط مختص سطح بارور است؛ بدون سطح بارور نباید تولید ثبت شود
        if ($cultivated_area <= 0 && $production_amount > 0) {
            $type_text = ($production_type == 'pishbini') ? 'پیش‌بینی' : 'قطعی';
            return array(
                'isValid' => false,
                'message' => "امکان ثبت میزان تولید $type_text بدون ثبت سطح کشت بارور وجود ندارد"
            );
        }

        // اگر تولید صفر است، نیازی به بررسی نیست
        if ($production_amount <= 0) {
            return array(
                'isValid' => true,
                'message' => ''
            );
        }

        $query = "SELECT ht_ab, ht_dem FROM ht_b WHERE cod_mah = :product_code LIMIT 1";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(':product_code', $product_code);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            if ($no_kesh == 1) {
                $coefficient = (float)$row['ht_ab'];
            } else {
                $coefficient = (float)$row['ht_dem'];
            }
        } else {
            // اگر ضریب ثبت نشده بود، مقدار پیش‌فرض 299
            $coefficient = 299;
        }
        
        // محاسبه حداکثر تولید مجاز
        $max_allowed = $cultivated_area * $coefficient;
        
        if ($production_amount > $max_allowed) {
            $type_text = ($production_type == 'pishbini') ? 'پیش‌بینی' : 'قطعی';
            return array(
                'isValid' => false,
                'message' => "میزان تولید $type_text وارد شده (" . number_format($production_amount, 2) . 
                            " تن) بیشتر از حداکثر مجاز (" . number_format($max_allowed, 2) . " تن) است"
            );
        }
        
        return array(
            'isValid' => true,
            'message' => ''
        );
    }
}
?>