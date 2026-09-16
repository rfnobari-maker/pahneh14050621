<?php
include('./web/ws_sabt.php');
include('./login/config.php'); // اتصال به دیتابیس برای جدول bah
include('./login/config_utf8_1.php'); // اتصال به دیتابیس برای جدول bah20

try {
    // خواندن تمام کدهای ملی و تاریخ‌های مربوطه از جدول bah_sabt
    $query = "SELECT bah_cod_m, date_t FROM bah_sabt ";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // حلقه برای پردازش هر کد ملی و تاریخ مربوطه
    foreach ($rows as $row) {
        $bah_cod_m = $row['bah_cod_m'];
        $date_t = $row['date_t'];
        $date_t = str_replace('/', '', $date_t); // حذف کاراکتر '/'

        // دریافت اطلاعات از وب‌سرویس
        $result = webservice($date_t, $bah_cod_m);

        // اگر اطلاعات معتبر برگردانده شد
        if ($result['name'] != '') {
            $name = $result['name'];
            $last_name = $result['family'];
            $fname = $result['fatherName'];
            $sh_sh = $result['shenasnameNo'];
            $jens = ($result['gender'] == 1) ? '1' : '2';
            $ok = ($result['deathStatus'] == 1) ? '2' : '1';

            // به‌روزرسانی جدول bah
            $query = "UPDATE bah 
                      SET date_s=?, name=?, last_name=?, fname=?, sh_sh=?, jens=?, ok=?
                      WHERE bah_cod_m=?";
            $q = $dbh->prepare($query);
            $q->execute(array(
                '1403/11/09', // مقدار ثابت برای date_s
                $name,        // نام
                $last_name,   // نام خانوادگی
                $fname,       // نام پدر
                $sh_sh,       // شماره شناسنامه
                $jens,        // جنسیت
                $ok,          // وضعیت فوت
                $bah_cod_m    // شرط WHERE
            ));

            // به‌روزرسانی جدول bah20
            $query = "UPDATE bah20 
                      SET date_s=?, name=?, last_name=?, fname=?, sh_sh=?, jens=?, ok=?
                      WHERE bah_cod_m=?";
            $q = $dbh_utf8->prepare($query);
            $q->execute(array(
                '1403/11/09', // مقدار ثابت برای date_s
                $name,        // نام
                $last_name,   // نام خانوادگی
                $fname,       // نام پدر
                $sh_sh,       // شماره شناسنامه
                $jens,        // جنسیت
                $ok,          // وضعیت فوت
                $bah_cod_m    // شرط WHERE
            ));
        }
    }
} catch (PDOException $e) {
    // مدیریت خطاهای مربوط به دیتابیس
    echo "خطای دیتابیس: " . $e->getMessage();
} catch (Exception $e) {
    // مدیریت سایر خطاها
    echo "خطا: " . $e->getMessage();
}
?>