<?php
// CropValidationService.php
include_once('../../login/config.php');

class CropValidationService {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    public function validateCultivatedAreaAgainstAllocation(
        $current_product_agri_prod_id,
        $agri_id_from_agri_table,
        $product_code,
        $zer_kesht_a_new,
        $zer_kesht_b_new,
        $z_sal,
        $id_ostan,
        $id_city,
        $id_mar,
        $no_kesh,
        $current_batch_total // پارامتر جدید
    ) {
        $product_code_from_input = $product_code;
         $product_map = array('103' => '102','107' => '106','176' => '490','178' => '490', '180' => '490', '182' => '490', '184' => '490',
 '186' => '490','188' => '490','190' => '490','192' => '490', '194' => '490','196' => '490','198' => '490','200' => '490','414' => '490',
 '416' => '490','418' => '490','420' => '490','422' => '490','424' => '490','426' => '490','428' => '490','430' => '490','432' => '490',
 '434' => '490','436' => '490','438' => '490','440' => '490','442' => '490','444' => '490','446' => '490','448' => '490','449' => '490',
 '464' => '490','150' => '148');

        $final_product_code = isset($product_map[$product_code_from_input]) ? $product_map[$product_code_from_input] : $product_code_from_input;

        $zer_kesht_a_new = (float)$zer_kesht_a_new;
        $zer_kesht_b_new = (float)$zer_kesht_b_new;
        $z_sal = preg_replace('/[^0-9\-]/', '', $z_sal);
        $id_ostan = preg_replace('/[^0-9]/', '', $id_ostan);
        $id_city = preg_replace('/[^0-9]/', '', $id_city);
        $id_mar = preg_replace('/[^0-9]/', '', $id_mar);
        $no_kesh = preg_replace('/[^0-9]/', '', $no_kesh);

        if ($z_sal !== '1404-1405') {
            return array('isValid' => true, 'message' => 'اعتبارسنجی سطح ابلاغی برای این سال زراعی فعال نیست.');
        }

        $Agri_ab_mar_table = 'Agri_ab_mar';
        $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
        $Agri_table = 'Agri' . str_replace('-', '_', $z_sal);

        // --- مرحله ۳: واکشی مقادیر ابلاغی از جدول Agri_ab_mar ---
        $query_allocation = "
            SELECT s_abi, s_dem
            FROM `$Agri_ab_mar_table`
            WHERE product_cod = :product_code
              AND id_ostan = :id_ostan
              AND id_city = :id_city
              AND id_mar = :id_mar
              AND z_sal = :z_sal
            LIMIT 1
        ";
        $stmt_allocation = $this->dbh->prepare($query_allocation);
        $stmt_allocation->bindValue(':product_code', $final_product_code, PDO::PARAM_INT);
        $stmt_allocation->bindValue(':id_ostan', $id_ostan, PDO::PARAM_STR);
        $stmt_allocation->bindValue(':id_city', $id_city, PDO::PARAM_STR);
        $stmt_allocation->bindValue(':id_mar', $id_mar, PDO::PARAM_STR);
        $stmt_allocation->bindValue(':z_sal', $z_sal, PDO::PARAM_STR);
        $stmt_allocation->execute();

        $allocation_data = $stmt_allocation->fetch(PDO::FETCH_ASSOC);
        if (!$allocation_data) {
            return array('isValid' => false, 'message' => 'خطا: برش الگوی کشت برای این محصول ثبت نشده است!');
        }

        $allocated_irrigated = isset($allocation_data['s_abi']) ? (float)$allocation_data['s_abi'] : 0.0;
        $allocated_dry_farmed = isset($allocation_data['s_dem']) ? (float)$allocation_data['s_dem'] : 0.0;

        // --- مرحله ۴: محاسبه مجموع فعلی سطح زیر کشت از جداول Agri_prod و Agri ---
        $related_products = array($product_code_from_input);
        if ($product_code_from_input != $final_product_code) {
            $related_products[] = $final_product_code;
        }
        $in_clause = implode(',', array_fill(0, count($related_products), '?'));

        $sum_query = "
            SELECT SUM(ap.zer_kesht_a + ap.zer_kesht_b) AS total_sum_current_type
            FROM `$Agri_prod_table` ap
            WHERE ap.cod_mah IN ($in_clause)
              AND ap.id_ostan = ?
              AND ap.id_city = ?
              AND ap.id_mar = ?
              AND ap.no_kesh = ?
        ";
        $params = array_merge($related_products, array($id_ostan, $id_city, $id_mar, $no_kesh));

        if ($current_product_agri_prod_id !== null) {
            $sum_query .= " AND ap.id != ?";
            $params[] = intval($current_product_agri_prod_id);
        }

        $stmt_sum = $this->dbh->prepare($sum_query);
        $stmt_sum->execute($params);

        $current_sum_data = $stmt_sum->fetch(PDO::FETCH_ASSOC);
        $current_total_sum_for_type = isset($current_sum_data['total_sum_current_type']) ? (float)$current_sum_data['total_sum_current_type'] : 0.0;

        // --- مرحله ۵: محاسبه مجموع نهایی و مقایسه با مقدار ابلاغی ---
        $new_total_cultivated_area = $zer_kesht_a_new + $zer_kesht_b_new;
        
        // اصلاح کلیدی: افزودن مجموع تجمعی جدید به مجموع فعلی
        $overall_total_for_type = $current_total_sum_for_type + $current_batch_total + $new_total_cultivated_area;

        if ($no_kesh == '1') {
            if ($overall_total_for_type > $allocated_irrigated) {
                return array('isValid' => false, 'message' => 'خطا: مجموع سطح زیر کشت آبی این محصول (' . $overall_total_for_type . ') بیش از میزان ابلاغی آبی (' . $allocated_irrigated . ') است.');
            }
        } elseif ($no_kesh == '2') {
            if ($overall_total_for_type > $allocated_dry_farmed) {
                return array('isValid' => false, 'message' => 'خطا: مجموع سطح زیر کشت دیم این محصول (' . $overall_total_for_type . ') بیش از میزان ابلاغی دیم (' . $allocated_dry_farmed . ') است.');
            }
        } else {
            return array('isValid' => false, 'message' => 'خطا: نوع کشت نامعتبر است.');
        }

        return array('isValid' => true, 'message' => '');
    }
}
?>