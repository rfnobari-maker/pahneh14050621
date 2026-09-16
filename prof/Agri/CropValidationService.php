<?php
/**
 * اعتبارسنجی سطح کشت در برابر برش الگوی کشت ابلاغی مرکز (Agri_ab_mar)
 * سازگار با PHP 5.3
 */

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
        $current_batch_total = 0.0
    ) {
        $product_map = array(
            '103' => '102', '107' => '106', '176' => '490', '178' => '490', '180' => '490', '182' => '490', '184' => '490',
            '186' => '490', '188' => '490', '190' => '490', '192' => '490', '194' => '490', '196' => '490', '198' => '490', '200' => '490',
            '414' => '490', '416' => '490', '418' => '490', '420' => '490', '422' => '490', '424' => '490', '426' => '490', '428' => '490',
            '430' => '490', '432' => '490', '434' => '490', '436' => '490', '438' => '490', '440' => '490', '442' => '490', '444' => '490',
            '446' => '490', '448' => '490', '449' => '490', '464' => '490', '150' => '148'
        );

        $product_code_from_input = $product_code;
        $z_sal = preg_replace('/[^0-9\-]/', '', $z_sal);

        // نگاشت کد والد فقط برای 1404-1405 است؛ از 1405-1406 برش روی همان کد محصول چک می‌شود
        $use_product_map = ($z_sal === '1404-1405');
        if ($use_product_map && isset($product_map[$product_code_from_input])) {
            $final_product_code = $product_map[$product_code_from_input];
        } else {
            $final_product_code = $product_code_from_input;
        }

        $related_products = array($final_product_code);
        if ($use_product_map) {
            foreach ($product_map as $child => $parent) {
                if ($parent == $final_product_code) {
                    $related_products[] = $child;
                }
            }
            if ($product_code_from_input != $final_product_code) {
                $related_products[] = $product_code_from_input;
            }
        }
        $related_products = array_unique($related_products);

        $zer_kesht_a_new = (float)$zer_kesht_a_new;
        $zer_kesht_b_new = (float)$zer_kesht_b_new;
        $current_batch_total = (float)$current_batch_total;

        $id_ostan = preg_replace('/[^0-9]/', '', $id_ostan);
        $id_city = preg_replace('/[^0-9]/', '', $id_city);
        $id_mar = preg_replace('/[^0-9]/', '', $id_mar);
        $no_kesh = preg_replace('/[^0-9]/', '', $no_kesh);

        $new_area = $zer_kesht_a_new + $zer_kesht_b_new;
        if ($new_area <= 0) {
            return array('isValid' => true, 'message' => '');
        }

        // سال‌های قبل از 1404-1405 الگوی کشت ابلاغی نداشتند
        if ($z_sal !== '' && strcmp($z_sal, '1404-1405') < 0) {
            return array(
                'isValid' => true,
                'message' => 'اعتبارسنجی سطح ابلاغی برای این سال زراعی فعال نیست.'
            );
        }

        if ($id_ostan === '' || $id_city === '' || $id_mar === '') {
            return array('isValid' => false, 'message' => 'خطا: اطلاعات مکان (استان، شهرستان، مرکز) برای بررسی برش الگوی کشت ناقص است.');
        }

        if ($no_kesh !== '1' && $no_kesh !== '2') {
            return array('isValid' => false, 'message' => 'خطا: نوع کشت نامعتبر است.');
        }

        $Agri_ab_mar_table = 'Agri_ab_mar';
        $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
        $Agri_table = 'Agri' . str_replace('-', '_', $z_sal);

        try {
            $stmt_year = $this->dbh->prepare("
                SELECT COUNT(*) AS cnt
                FROM `$Agri_ab_mar_table`
                WHERE id_ostan = :id_ostan
                  AND id_city = :id_city
                  AND id_mar = :id_mar
                  AND z_sal = :z_sal
                  AND (s_abi > 0 OR s_dem > 0)
            ");
            $stmt_year->execute(array(
                ':id_ostan' => $id_ostan,
                ':id_city' => $id_city,
                ':id_mar' => $id_mar,
                ':z_sal' => $z_sal
            ));
            $year_row = $stmt_year->fetch(PDO::FETCH_ASSOC);
            $year_cnt = isset($year_row['cnt']) ? (int)$year_row['cnt'] : 0;
            if ($year_cnt <= 0) {
                return array(
                    'isValid' => false,
                    'message' => 'خطا: برنامه الگوی کشت این مرکز برای سال زراعی ' . $z_sal . ' ثبت نشده است. امکان ثبت محصول وجود ندارد.'
                );
            }

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
            $stmt = $this->dbh->prepare($query_allocation);
            $stmt->bindValue(':product_code', $final_product_code);
            $stmt->bindValue(':id_ostan', $id_ostan);
            $stmt->bindValue(':id_city', $id_city);
            $stmt->bindValue(':id_mar', $id_mar);
            $stmt->bindValue(':z_sal', $z_sal);
            $stmt->execute();
            $allocation_data = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$allocation_data) {
                return array(
                    'isValid' => false,
                    'message' => 'خطا: برش الگوی کشت برای این محصول در این مرکز ثبت نشده است.'
                );
            }

            $allocated_irrigated = isset($allocation_data['s_abi']) ? (float)$allocation_data['s_abi'] : 0.0;
            $allocated_dry = isset($allocation_data['s_dem']) ? (float)$allocation_data['s_dem'] : 0.0;

            if ($no_kesh === '1' && $allocated_irrigated <= 0) {
                return array(
                    'isValid' => false,
                    'message' => 'خطا: برش الگوی کشت آبی برای این محصول در این مرکز صفر یا تعریف نشده است.'
                );
            }
            if ($no_kesh === '2' && $allocated_dry <= 0) {
                return array(
                    'isValid' => false,
                    'message' => 'خطا: برش الگوی کشت دیم برای این محصول در این مرکز صفر یا تعریف نشده است.'
                );
            }

            $in_clause = implode(',', array_fill(0, count($related_products), '?'));
            $sum_query = "
                SELECT SUM(ap.zer_kesht_a + ap.zer_kesht_b) AS total
                FROM `$Agri_prod_table` ap
                JOIN `$Agri_table` a ON ap.Agri_id = a.id
                WHERE ap.cod_mah IN ($in_clause)
                  AND a.id_ostan = ?
                  AND a.id_city = ?
                  AND a.id_mar = ?
                  AND a.no_kesh = ?
            ";
            $params = array_merge(
                $related_products,
                array($id_ostan, $id_city, $id_mar, $no_kesh)
            );

            if ($current_product_agri_prod_id !== null && $current_product_agri_prod_id !== '') {
                $sum_query .= " AND ap.id != ?";
                $params[] = intval($current_product_agri_prod_id);
            }

            $stmt_sum = $this->dbh->prepare($sum_query);
            $stmt_sum->execute($params);
            $row = $stmt_sum->fetch(PDO::FETCH_ASSOC);
            $current_total = isset($row['total']) ? (float)$row['total'] : 0.0;
            $overall_total = $current_total + $current_batch_total + $new_area;

            if ($no_kesh === '1' && $overall_total > $allocated_irrigated) {
                return array(
                    'isValid' => false,
                    'message' => 'خطا: مجموع سطح زیر کشت آبی این محصول در مرکز (' . $overall_total . ' هکتار) بیش از میزان ابلاغی آبی (' . $allocated_irrigated . ' هکتار) است.'
                );
            }
            if ($no_kesh === '2' && $overall_total > $allocated_dry) {
                return array(
                    'isValid' => false,
                    'message' => 'خطا: مجموع سطح زیر کشت دیم این محصول در مرکز (' . $overall_total . ' هکتار) بیش از میزان ابلاغی دیم (' . $allocated_dry . ' هکتار) است.'
                );
            }

            return array('isValid' => true, 'message' => '');
        } catch (PDOException $e) {
            return array(
                'isValid' => false,
                'message' => 'خطا در اعتبارسنجی الگوی کشت: ' . $e->getMessage()
            );
        }
    }
}
?>
