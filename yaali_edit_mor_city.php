<?php
include ('event.php');
?>
<form name="test" method="post"> 
  <p>
    <input type="text" name="mor_cod_m" width="75px" required>
    : کد ملی مروج
  </p>
  <p>
    <input type="submit" name="action" id="btn1" value="بروزرسانی">
  </p>
</form>

<?php
if (isset($_POST['action'])) { 
    $mor_cod_m = trim($_POST['mor_cod_m']);
    
    // اعتبارسنجی ورودی
    if (empty($mor_cod_m)) {
        echo "<script>alert('لطفا کد ملی مروج را وارد کنید');</script>";
        exit;
    }
    
    include ('login/config.php');
    
    try {
        // شروع تراکنش
        $dbh->beginTransaction();
        
        // دریافت داده‌های پایه با استفاده از prepared statement
        $query = "SELECT add_city, mor_cod_m, id_mar, id_city, id_ostan 
                 FROM list_city 
                 WHERE mor_cod_m = ? AND mor_cod_m <> ''";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array($mor_cod_m));
        
        $found = false;
        
        // لیست تمام جداول برای بهینه‌سازی
        $tables = array(
            'bah',
            'Agri1397_1398', 'Agri1398_1399', 'Agri1399_1400', 'Agri1400_1401',
            'Agri1401_1402', 'Agri1402_1403', 'Agri1403_1404', 'Agri1404_1405', 'Agri1405_1406',
            'Agri_prod1397_1398', 'Agri_prod1398_1399', 'Agri_prod1399_1400',
            'Agri_prod1400_1401', 'Agri_prod1401_1402', 'Agri_prod1402_1403',
            'Agri_prod1403_1404', 'Agri_prod1404_1405', 'Agri_prod1405_1406',
            'Garden', 'Garden_prod','Greenhous', 'Greenhous_prod', 'Greenprod_annual',
            'Aquatic','Aquatic2', 'bee', 'unknown_bee',
            'Vege', 'Vege_prod',
            'Mushroom', 'Mushroom_prod',
            'animals_unit'
        );
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $found = true;
            $add_city = $row['add_city'];
            $mor_cod_m = $row['mor_cod_m'];
            $id_mar = $row['id_mar'];
            $id_city = $row['id_city'];
            $id_ostan = $row['id_ostan'];
            
            // نمایش اطلاعات برای دیباگ
            echo "<script>alert('" . addslashes($add_city) . "---->" . addslashes($mor_cod_m) . "---->" . addslashes($id_mar) . "');</script>";
            
            // به‌روزرسانی تمام جداول در یک حلقه
            foreach ($tables as $table) {
                $query = "UPDATE $table SET mor_cod_m = ?, id_mar = ?, id_ostan = ?, id_city = ? WHERE add_city = ?";
                $q = $dbh->prepare($query);
                $result = $q->execute(array($mor_cod_m, $id_mar, $id_ostan, $id_city, $add_city));
                
                if (!$result) {
                    throw new Exception("خطا در بروزرسانی جدول: $table");
                }
            }
        }
        
        if ($found) {
            $dbh->commit();
            echo "<script>alert('عملیات بروزرسانی با موفقیت انجام شد');</script>";
        } else {
            $dbh->rollBack();
            echo "<script>alert('هیچ رکوردی با کد ملی وارد شده یافت نشد');</script>";
        }
        
    } catch (Exception $e) {
        // بازگردانی تراکنش در صورت خطا
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
        }
        echo "<script>alert('خطا در انجام عملیات: " . addslashes($e->getMessage()) . "');</script>";
        error_log("Database error: " . $e->getMessage());
    }
    
    $dbh = null;
}
?>