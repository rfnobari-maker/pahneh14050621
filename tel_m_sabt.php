<?php
include("lock_p1.php");
include('./web/shah2.php'); 
require_once('./Jalali.php');
date_default_timezone_set('Asia/Tehran');

// فایل جدیدی که فقط مخصوص آپدیت کاربران است
include('update_user_tel.php');

// ====================================================================
// ثبت شماره همراه بهره‌بردار
// ====================================================================

if (isset($_POST['tel_m']) && isset($_POST['bah_cod_m'])) {

    $tel_m     = trim($_POST['tel_m']);
    $bah_cod_m = trim($_POST['bah_cod_m']);
    $date_edit = jdate("Y/m/d");

    $shahkarStatus = getShahkarStatus($tel_m, $bah_cod_m);

    if ($shahkarStatus === "مطابقت دارد") {

        $result = updateUserTelAndValid($tel_m, '200', $bah_cod_m);

        echo ($result === "ok") ? "success" : "db_error";
    } 
    else if ($shahkarStatus === "عدم مطابقت") {

        $result = updateUserTelAndValid($tel_m, '0', $bah_cod_m);

        echo ($result === "ok") ? "no_match" : "db_error";
    } 
    else {
        echo "error";
    }

    exit;
}

echo "invalid_request";
?>
