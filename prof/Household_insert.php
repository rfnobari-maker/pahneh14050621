<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
include('../lock_p1.php');
include('../event.php');
if (isset($_POST['sp_cod_m'], $_POST['id'], $_POST['sp_name'], $_POST['sp_last_name'])) {
    $sp_cod_m     = $_POST['sp_cod_m'];
    $id           = $_POST['id'];
    $sp_name      = $_POST['sp_name'];
    $sp_last_name = $_POST['sp_last_name'];
    $bah_cod_m    = $_POST['bah_cod_m']; // تعریف bah_cod_m

    require_once('../Jalali.php');
    date_default_timezone_set('Asia/Tehran');
    $date_edit = jdate("Y/m/d");

    include('../login/config.php');

    // آپدیت جدول bah
    $query = "UPDATE bah SET date_s=?, sp_cod_m=? WHERE id=?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($date_edit, $sp_cod_m, $id));

    // آپدیت جدول bah20
    $query = "UPDATE bah20 SET date_s=?, sp_cod_m=? WHERE bah_cod_m =? and no_bah = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($date_edit, $sp_cod_m, $bah_cod_m , '1'));

    // چک کردن وجود رکورد در Household
    $query_Household = "SELECT count(*) FROM Household WHERE sp_cod_m = :sp_cod_m";
    $stmt_Household = $dbh->prepare($query_Household);
    $stmt_Household->bindParam(':sp_cod_m', $sp_cod_m, PDO::PARAM_STR);
    $stmt_Household->execute();

    if ($stmt_Household->fetchColumn() == 0) {
        // وارد کردن داده‌ها به Household
        $query = "
        INSERT INTO Household (date_s, id_ostan, id_city, id_mar, add_abadi, add_city, mor_cod_m, sp_cod_m,s_bah, jens, name, last_name, date_t, sh_sh, fname, tel_m,cod_p ,ok, no_nation, nation)
        SELECT date_s, id_ostan, id_city, id_mar, add_abadi, add_city, mor_cod_m, bah_cod_m,s_bah, jens, name, last_name, date_t, sh_sh, fname, tel_m,cod_p, ok, no_nation, nation
        FROM bah
        WHERE bah_cod_m = :sp_cod_m;
        ";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':sp_cod_m', $sp_cod_m, PDO::PARAM_INT); // استفاده از bindParam برای id
        $stmt->execute();
    }
}
?>
</html>
