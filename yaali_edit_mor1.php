<form name="test" method="post"> 
  <p>
    <input type="text" name="mor_cod_m" width="75px">
    : کد ملی مروج  
  </p>
  <p>
    <input type="submit" name="action" id="btn1">
  </p>
</form>
<?php
if (isset($_POST['action'])) { 
    $mor_cod_m = $_POST['mor_cod_m'];

    // اتصال به دیتابیس
    include('login/config.php');
    
    // دریافت اطلاعات مورد نظر
    $query = "SELECT add_abadi, mor_cod_m, id_mar, id_city, id_ostan FROM list_abadi WHERE mor_cod_m = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($mor_cod_m));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($data) {
        // تعریف آرایه جداول
        $tables = array(
            "bah", "bah20", "Agri1397_1398", "Agri1398_1399", "Agri1399_1400", 
            "Agri1400_1401", "Agri1401_1402", "Agri1402_1403", "Agri1403_1404",
            "Agri_prod1397_1398", "Agri_prod1398_1399", "Agri_prod1399_1400", 
            "Agri_prod1400_1401", "Agri_prod1401_1402", "Agri_prod1402_1403",
            "Agri_prod1403_1404", "Garden", "Garden_prod", "Greenhous", 
            "Greenhous_prod", "Greenprod_annual", "Aquatic", "bee", "unknown_bee", 
            "Vege", "Vege_prod", "Mushroom", "Mushroom_prod"
        );

        // شروع تراکنش
        $dbh->beginTransaction();
        try {
            foreach ($data as $row) {
                foreach ($tables as $table) {
                    $query = "UPDATE $table SET mor_cod_m = ?, id_ostan = ?, id_city = ?, id_mar = ? WHERE add_abadi = ?";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute(array(
                        $row['mor_cod_m'], 
                        $row['id_ostan'], 
                        $row['id_city'], 
                        $row['id_mar'], 
                        $row['add_abadi']
                    ));
                }
            }
            // تایید تراکنش
            $dbh->commit();
            echo "<script>alert('تمام');</script>";
        } catch (Exception $e) {
            // بازگردانی در صورت خطا
            $dbh->rollBack();
            echo "<script>alert('خطا: {$e->getMessage()}');</script>";
        }
    } else {
        echo "<script>alert('هیچ داده‌ای یافت نشد');</script>";
    }

    // بستن اتصال
    $dbh = null;
}
?>
