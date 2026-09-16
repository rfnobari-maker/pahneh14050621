<?php
function updateUserTelAndValid($tel_m, $valid, $bah_cod_m) {

include('./login/config.php');
    // اجرای آپدیت
    $query = "UPDATE users SET tel_m=?, valid=? WHERE cod_m=?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($tel_m, $valid, $bah_cod_m));

    return "ok";
}
?>
