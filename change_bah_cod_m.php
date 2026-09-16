<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر
include ('login/config.php');
include ('event.php');

// تعریف جداول با تنظیمات به‌روزرسانی
$update_configs = array(
    // جداول با شرط دو ستونی: bah_cod_m و num_bah
    'bah' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'bee' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'unknown_bee' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri1397_1398' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri1398_1399' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri1399_1400' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri1400_1401' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri1401_1402' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri1402_1403' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri1403_1404' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri1404_1405' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Garden' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Garden_prod' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri_prod1397_1398' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri_prod1398_1399' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri_prod1399_1400' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri_prod1400_1401' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri_prod1401_1402' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri_prod1402_1403' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri_prod1403_1404' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Agri_prod1404_1405' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Aquatic' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Aquatic2' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Greenhous' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Greenhous_prod' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Greenprod_annual' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Mushroom' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),
    'Mushroom_prod' => array('cod_field' => 'bah_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'both'),

    // جداول با شرط تک ستونی و نام ستون متفاوت
    'Vege' => array('cod_field' => 'bah_cod_m', 'num_field' => 'no_bah', 'where_condition' => 'single'),
    'Vege_prod' => array('cod_field' => 'bah_cod_m', 'num_field' => 'no_bah', 'where_condition' => 'single'),
    'malek' => array('cod_field' => 'm_cod_m', 'num_field' => 'num_bah', 'where_condition' => 'single')
);
?>

<form name="test" method="post">
  <p>
    <input type="text" name="bah_cod_m1" id="bah_cod_m1">
    : کد ملی نادرست
  </p>
  <p>
    <input type="text" name="bah_cod_m2" id="bah_cod_m2">
    : کد ملی درست
  </p>
  <p>
    <input type="text" name="num_bah1" id="num_bah1" width="50">
    : num_bah1
  </p>
  <p>
    <input type="text" name="num_bah2" id="num_bah2" width="50">
    : num_bah2
  </p>
  <p>
    <input type="submit" name="action" id="btn1" value="بروزرسانی">
  </p>
</form>

<?php
if (isset($_POST['action'])) {
    // اعتبارسنجی داده‌های ورودی
    $bah_cod_m1 = trim($_POST['bah_cod_m1']);
    $bah_cod_m2 = trim($_POST['bah_cod_m2']);
    $num_bah1 = trim($_POST['num_bah1']);
    $num_bah2 = trim($_POST['num_bah2']);

    if (empty($bah_cod_m1) || empty($bah_cod_m2) || empty($num_bah1) || empty($num_bah2)) {
        echo "<script>alert('لطفا تمام فیلدها را پر کنید');</script>";
        exit;
    }

    try {
        // شروع تراکنش برای عملکرد اتمیک
        $dbh->beginTransaction();
        $success = true;

        // به‌روزرسانی تمام جداول بر اساس پیکربندی
        foreach ($update_configs as $table => $config) {
            $cod_field = $config['cod_field'];
            $num_field = $config['num_field'];
            $where_condition = $config['where_condition'];

            if ($where_condition == 'both') {
                $query = "UPDATE $table SET $cod_field = :cod_m2, $num_field = :num_bah2 
                         WHERE $cod_field = :cod_m1 AND $num_field = :num_bah1";
                $q = $dbh->prepare($query);
                $result = $q->execute(array(
                    ':cod_m2' => $bah_cod_m2,
                    ':num_bah2' => $num_bah2,
                    ':cod_m1' => $bah_cod_m1,
                    ':num_bah1' => $num_bah1
                ));
            } elseif ($where_condition == 'single') {
                $query = "UPDATE $table SET $cod_field = :cod_m2, $num_field = :num_bah2 
                         WHERE $cod_field = :cod_m1";
                $q = $dbh->prepare($query);
                $result = $q->execute(array(
                    ':cod_m2' => $bah_cod_m2,
                    ':num_bah2' => $num_bah2,
                    ':cod_m1' => $bah_cod_m1
                ));
            }
            
            if (!$result) {
                $success = false;
                break;
            }
        }

        if ($success) {
            // تأیید تراکنش
            $dbh->commit();
            echo "<script>alert('تمام عملیات با موفقیت انجام شد');</script>";
        } else {
            // بازگردانی تراکنش در صورت خطا
            $dbh->rollBack();
            echo "<script>alert('خطا در انجام عملیات');</script>";
        }

    } catch (Exception $e) {
        // بازگردانی تراکنش در صورت خطا
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
        }
        echo "<script>alert('خطا در انجام عملیات: " . addslashes($e->getMessage()) . "');</script>";
    }

    $dbh = null;
}
?>