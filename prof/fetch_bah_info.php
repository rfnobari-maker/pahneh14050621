<?php
if (isset($_POST['sp_cod_m'])) {
    include('../login/config.php');
    $sp_cod_m = $_POST['sp_cod_m'];

    // کوئری برای پیدا کردن نام و نام خانوادگی با استفاده از bah_cod_m
    $query = "SELECT name, last_name FROM bah WHERE bah_cod_m = :sp_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':sp_cod_m', $sp_cod_m, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // ارسال پاسخ به فرمت JSON
        echo json_encode($row);
    } else {
        // اگر در جدول bah پیدا نشد، در جدول Household جستجو می‌کنیم
        $query_Household = "SELECT name, last_name FROM Household WHERE sp_cod_m = :sp_cod_m";
        $stmt_Household = $dbh->prepare($query_Household);
        $stmt_Household->bindParam(':sp_cod_m', $sp_cod_m, PDO::PARAM_STR);
        $stmt_Household->execute();

        if ($stmt_Household->rowCount() > 0) {
            $row_Household = $stmt_Household->fetch(PDO::FETCH_ASSOC);
            // ارسال پاسخ به فرمت JSON
            echo json_encode($row_Household);
        } else {
            // اگر در هر دو جدول پیدا نشد
            echo json_encode(array('error' => 'No data found'));
        }
    }
}
?>
