<?php
include('../../lock_expar.php');
include('../../event.php');
if(isset($_POST['s_abi']))
{

function clean_number($value) {
    return str_replace('٬', '', $value);
}
    $s_abi   = clean_number($_POST['s_abi']) ; 
    $s_dem   = clean_number($_POST['s_dem']) ; 
    $t_abi   = clean_number($_POST['t_abi']) ; 
    $t_dem   = clean_number($_POST['t_dem']) ; 
    $a_abi   = clean_number($_POST['a_abi']) ; 
    $a_dem   = clean_number($_POST['a_dem']) ; 
    $id      = clean_number($_POST['id']) ; 
    $z_sal     = $_POST['z_sal'] ; 
    $id_ostan = $_POST['id_ostan']; 
    $id_city = $_POST['id_city']; 
    $id_product = $_POST['id_product']; 

    // ----------------------------------------------------
    // --- بخش جدید: اعتبارسنجی مجدد برای جلوگیری از Race Condition ---
    // ----------------------------------------------------

    // 1. دریافت مقادیر فعلی رکورد از پایگاه داده Agri_ab_city
    $query_current = "SELECT s_abi, s_dem, t_abi, t_dem FROM Agri_ab_city WHERE id = ?";
    $stmt_current = $dbh->prepare($query_current);
    $stmt_current->execute(array($id));
    $current_values = $stmt_current->fetch(PDO::FETCH_ASSOC);

    $current_s_abi = isset($current_values['s_abi']) ? $current_values['s_abi'] : 0;
    $current_s_dem = isset($current_values['s_dem']) ? $current_values['s_dem'] : 0;
    $current_t_abi = isset($current_values['t_abi']) ? $current_values['t_abi'] : 0;
    $current_t_dem = isset($current_values['t_dem']) ? $current_values['t_dem'] : 0;
    
    // 2. دریافت سقف‌های مجاز برای شهرستان از Agri_ab_ostan
    $query_city = "SELECT s_abi, s_dem, t_abi, t_dem FROM Agri_ab_ostan WHERE id_ostan = ?  AND z_sal = ? AND product_cod = ?";
    $stmt_city = $dbh->prepare($query_city);
    $stmt_city->execute(array($id_ostan, $z_sal, $id_product));
    $city_limits = $stmt_city->fetch(PDO::FETCH_ASSOC);
    
    if (!$city_limits) {
        echo json_encode(array('valid' => false, 'message' => 'اطلاعات سقف استان یافت نشد.'));
        exit;
    }
    
    // 3. محاسبه مجموع مقادیر فعلی تمام مراکز آن شهرستان از Agri_ab_city
    $query_sum = "SELECT SUM(s_abi) as total_s_abi, SUM(s_dem) as total_s_dem, SUM(t_abi) as total_t_abi, SUM(t_dem) as total_t_dem FROM Agri_ab_city WHERE id_ostan = ? AND id_city = ? AND z_sal = ? AND product_cod = ?";
    $stmt_sum = $dbh->prepare($query_sum);
    $stmt_sum->execute(array($id_ostan,$id_city, $z_sal, $id_product));
    $sum_mar = $stmt_sum->fetch(PDO::FETCH_ASSOC);

    // 4. اعتبارسنجی نهایی با احتساب مقدار جدید (کنترل سقف شهرستان)
    $new_total_s_abi = ($sum_mar['total_s_abi'] - $current_s_abi) + $s_abi;
    $new_total_s_dem = ($sum_mar['total_s_dem'] - $current_s_dem) + $s_dem;
    $new_total_t_abi = ($sum_mar['total_t_abi'] - $current_t_abi) + $t_abi;
    $new_total_t_dem = ($sum_mar['total_t_dem'] - $current_t_dem) + $t_dem;
    
    if (
        ($new_total_s_abi > $city_limits['s_abi']) ||
        ($new_total_s_dem > $city_limits['s_dem']) ||
        ($new_total_t_abi > $city_limits['t_abi']) ||
        ($new_total_t_dem > $city_limits['t_dem'])
    ) {

        echo json_encode(array('valid' => false, 'message' => 'مقادیر وارد شده از سقف مجاز استان بیشتر است.'));
        exit;
    }


require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
$query = "update Agri_ab_city set date_s=?,s_abi=?,s_dem=?,t_abi=?,t_dem=?,a_abi=?,a_dem=? where id=? ";
$stmt = $dbh->prepare($query);
$stmt->execute(array($date_edit, $s_abi, $s_dem, $t_abi, $t_dem, $a_abi, $a_dem, $id));
$count = $stmt->rowCount();

// تنها در صورت موفقیت‌آمیز بودن به‌روزرسانی، رویداد را ثبت کنید و پاسخ موفقیت‌آمیز برگردانید.
if ($count > 0) {
    $status = 'ثبت اطلاعات تولیدات نهایی کشاورزی';
    sabt_event($login_session, getUserIP_1(), $date_edit, $time, '', $status, $id_ostan);
    echo json_encode(array('valid' => true, 'message' => 'اطلاعات با موفقیت ذخیره شد.'));
} else {
    // در صورتی که هیچ رکوردی تحت تأثیر قرار نگرفت، پاسخ ناموفق برگردانید.
    echo json_encode(array('valid' => false, 'message' => ' هیچ تغییری در داده‌ها ایجاد نشده.'));
}
}
?>