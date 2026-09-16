<?php
// این فایل مسئول پردازش و ثبت نهایی داده‌ها در پایگاه داده است.
include('../../lock_p3.php');
include('../../event.php');
require_once('../../Jalali.php');

header('Content-Type: application/json');

// تابع برای پاک کردن کاراکترهای غیرعددی و جداکننده‌ها
function clean_number($value) {
    // تبدیل ارقام فارسی به انگلیسی
    $persian_to_english = array(
        '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
        '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9'
    );
    $value = strtr($value, $persian_to_english);
    // حذف جداکننده‌های هزارگان (کاما و جداکننده فارسی)
    return str_replace(array('٬', ','), '', $value);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id_mar'], $_POST['z_sal'])) {
    echo json_encode(array('success' => false, 'message' => 'درخواست نامعتبر.'));
    exit;
}

$id_mar = $_POST['id_mar'];
$z_sal = $_POST['z_sal'];

// بررسی و اعتبارسنجی وجود آرایه‌ها و پاک کردن مقادیر
$s_abi_new = isset($_POST['s_abi']) ? array_map('clean_number', $_POST['s_abi']) : array();
$s_dem_new = isset($_POST['s_dem']) ? array_map('clean_number', $_POST['s_dem']) : array();
$t_abi_new = isset($_POST['t_abi']) ? array_map('clean_number', $_POST['t_abi']) : array();
$t_dem_new = isset($_POST['t_dem']) ? array_map('clean_number', $_POST['t_dem']) : array();
$product_cod_new = isset($_POST['product_cod']) ? $_POST['product_cod'] : array();

// مقادیر اولیه برای اعتبارسنجی سمت سرور
$initial_s_abi = clean_number($_POST['initial_s_abi']);
$initial_s_dem = clean_number($_POST['initial_s_dem']);
$initial_t_abi = clean_number($_POST['initial_t_abi']);
$initial_t_dem = clean_number($_POST['initial_t_dem']);

// محاسبه مقادیر مجموع جدید
$total_s_abi_new = array_sum($s_abi_new);
$total_s_dem_new = array_sum($s_dem_new);
$total_t_abi_new = array_sum($t_abi_new);
$total_t_dem_new = array_sum($t_dem_new);

// اعتبارسنجی نهایی
if ($total_s_abi_new > $initial_s_abi || $total_s_dem_new > $initial_s_dem || $total_t_abi_new > $initial_t_abi || $total_t_dem_new > $initial_t_dem) {
    echo json_encode(array('success' => false, 'message' => 'مجموع مقادیر وارد شده از تراز اولیه بیشتر است.'));
    exit;
}

// محاسبه تراز باقی‌مانده
$remaining_s_abi = $initial_s_abi - $total_s_abi_new;
$remaining_s_dem = $initial_s_dem - $total_s_dem_new;
$remaining_t_abi = $initial_t_abi - $total_t_abi_new;
$remaining_t_dem = $initial_t_dem - $total_t_dem_new;

try {
    require_once('../../login/config.php');
    $dbh->beginTransaction();

    // به‌روزرسانی مقدار محصول 490 با تراز باقی‌مانده
    $query_update_490 = "UPDATE Agri_ab_mar SET s_abi=?, s_dem=?, t_abi=?, t_dem=? WHERE id_mar = ? AND product_cod = '490' AND z_sal = ?";
    $stmt_update_490 = $dbh->prepare($query_update_490);
    $stmt_update_490->execute(array($remaining_s_abi, $remaining_s_dem, $remaining_t_abi, $remaining_t_dem, $id_mar, $z_sal));

    // بررسی اینکه آیا به روزرسانی موفقیت‌آمیز بوده است
    if ($stmt_update_490->rowCount() === 0) {
        throw new Exception("رکورد محصول 490 برای به‌روزرسانی یافت نشد. لطفاً از وجود آن در پایگاه داده اطمینان حاصل کنید.");
    }
    
    // فقط در صورت وجود داده برای ثبت، عملیات حذف و ثبت را انجام می‌دهد.
    if (!empty($product_cod_new)) {
        // حذف ردیف‌های موجود به جز محصول 490
        $group_cod = '4' ; 
		$query_delete = "DELETE FROM Agri_ab_mar WHERE id_mar = ? AND z_sal = ? and group_cod = ? AND id_product not in ('490','170','172','174')";
        $stmt_delete = $dbh->prepare($query_delete);
        $stmt_delete->execute(array($id_mar, $z_sal,$group_cod));
         

        // ثبت ردیف‌های جدید
        $query_insert_new = "INSERT INTO Agri_ab_mar (id_ostan,id_city,id_mar, z_sal,group_cod,group_name, product_cod,product_name, s_abi, s_dem, t_abi, t_dem, a_abi, a_dem) 
		VALUES (?,?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert_new = $dbh->prepare($query_insert_new);
    
        foreach ($product_cod_new as $key => $product_cod) {
            // محاسبه عملکرد
            $s_abi_val = isset($s_abi_new[$key]) ? $s_abi_new[$key] : 0;
            $s_dem_val = isset($s_dem_new[$key]) ? $s_dem_new[$key] : 0;
            $t_abi_val = isset($t_abi_new[$key]) ? $t_abi_new[$key] : 0;
            $t_dem_val = isset($t_dem_new[$key]) ? $t_dem_new[$key] : 0;

            $a_abi = ($s_abi_val > 0) ? ($t_abi_val / $s_abi_val * 1000) : 0;
            $a_dem = ($s_dem_val > 0) ? ($t_dem_val / $s_dem_val * 1000) : 0;

            $stmt_insert_new->execute(array(
                $id_ostan,
                $id_city,
                $id_mar,
                $z_sal,
                $group_cod,
                group_name($group_cod),
                $product_cod,
                mah_name($product_cod),
				$s_abi_val,
                $s_dem_val,
                $t_abi_val,
                $t_dem_val,
                $a_abi,
                $a_dem
            ));
        }
    }

    $dbh->commit();
    echo json_encode(array('success' => true, 'message' => 'اطلاعات با موفقیت ثبت و به‌روزرسانی شد.'));

} catch (PDOException $e) {
    $dbh->rollBack();
    echo json_encode(array('success' => false, 'message' => 'خطا در پایگاه داده: ' . $e->getMessage()));
} catch (Exception $e) {
    $dbh->rollBack();
    echo json_encode(array('success' => false, 'message' => $e->getMessage()));
}
?>