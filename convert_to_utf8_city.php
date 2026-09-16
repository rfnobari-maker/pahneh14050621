<?php
include('login/config_old.php');
include('login/config_utf8_new.php');

/**
 * تابعی برای انتقال داده‌ها از یک جدول به جدولی دیگر
 * @param string $source_table نام جدول اصلی
 * @param string $destination_table نام جدول مقصد
 * @return void
 */
function transfer_data($source_table, $destination_table)
{
    // استفاده از کانکشن قدیمی برای خواندن
    global $dbh; 
    // استفاده از کانکشن جدید برای نوشتن
    global $dbh_utf8;

    try {
        // خواندن داده‌ها از جدول مبدأ
        $query_select = "SELECT * FROM {$source_table}";
        $stmt_select = $dbh->prepare($query_select);
        $stmt_select->execute();

        // آماده‌سازی کوئری INSERT برای جدول مقصد
        $columns = array_keys($stmt_select->fetch(PDO::FETCH_ASSOC));
        $placeholders = ':' . implode(',:', $columns);
        $columns_list = implode(',', $columns);

        $query_insert = "INSERT INTO {$destination_table} ({$columns_list}) VALUES ({$placeholders})";
        $stmt_insert = $dbh_utf8->prepare($query_insert);
        
        // بازگرداندن نشانگر نتیجه به ابتدای مجموعه
        $stmt_select->execute();

        // انتقال داده‌ها به صورت حلقه
        while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
            $stmt_insert->execute($row);
        }

        echo "انتقال داده‌ها از {$source_table} به {$destination_table} با موفقیت انجام شد.<br>";

    } catch (PDOException $e) {
        echo "خطا در انتقال داده‌ها از {$source_table} به {$destination_table}: " . $e->getMessage() . "<br>";
    }
}

// استفاده از تابع برای جداول مختلف
transfer_data('product_z_amar_21', 'product_z_amar');
transfer_data('promo_cent_public_21', 'promo_cent_public');

?>