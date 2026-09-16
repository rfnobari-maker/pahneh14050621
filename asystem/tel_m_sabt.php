<?php
include('../event.php');
include('../web/shah2.php'); // اضافه کردن فایل شامل تابع getShahkarStatus

if (isset($_POST['tel_m']) && isset($_POST['id']) && isset($_POST['bah_cod_m'])) {
    $tel_m = $_POST['tel_m'];
    $id = (int) $_POST['id'];
    $bah_cod_m = $_POST['bah_cod_m'];

    require_once('../Jalali.php');
    date_default_timezone_set('Asia/Tehran');
    $date_edit = jdate("Y/m/d");

    // بررسی وضعیت شماره موبایل و کد ملی
    $shahkarStatus = getShahkarStatus($tel_m, $bah_cod_m);

if ($shahkarStatus === "مطابقت دارد") {
    include('../login/config.php');
    $valid = '200'; 
    $query = "UPDATE bah SET date_s=?, tel_m=?, valid=? WHERE id=?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($date_edit, $tel_m, $valid, $id));

    $query = "UPDATE bah20 SET date_s=?, tel_m=?, valid=? WHERE bah_cod_m=?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($date_edit, $tel_m, $valid, $bah_cod_m));

    echo "success";
} else if ($shahkarStatus === "عدم مطابقت") {
    include('../login/config.php');
    $valid = '600';
    $query = "UPDATE bah SET date_s=?, tel_m=?, valid=? WHERE id=?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($date_edit, $tel_m, $valid, $id));

    $query = "UPDATE bah20 SET date_s=?, tel_m=?, valid=? WHERE bah_cod_m=?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($date_edit, $tel_m, $valid, $bah_cod_m));

    echo "no_match";
} else {
    echo "error";
}
}
exit; // خروج بعد از ارسال پاسخ
?>
