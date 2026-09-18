<?php
include('../../lock_p1.php');
include('../../event.php');

if (isset($_POST['s_bar_a'])) {
    $s_bar_a   = test_input($_POST['s_bar_a']);
    $s_bar_b   = test_input($_POST['s_bar_b']);
    $mah_tol   = test_input($_POST['mah_tol']);
    $mah_kh    = test_input($_POST['mah_kh']);
    $id        = test_input($_POST['id']);
    $z_sal     = test_input($_POST['z_sal']);
    $add_abadi = test_input($_POST['add_abadi']);
    $bah_cod_m = test_input($_POST['bah_cod_m']);
    $sh_gat    = test_input($_POST['sh_gat']);

    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

    require_once('../../Jalali.php');
    date_default_timezone_set('Asia/Tehran');
    $date_edit = jdate("Y/m/d");
    $time = date('H:i:s');

    include('../../login/config.php');

    // ===== کنترل‌های سمت سرور =====

    // تبدیل امن مقادیر عددی
    $sba_num = (float) str_replace(',', '', $s_bar_a);
    $sbb_num = (float) str_replace(',', '', $s_bar_b);

    // خواندن سطح زیر کشت اول و دوم از دیتابیس
    $query_chk = "SELECT zer_kesht_a, zer_kesht_b FROM $Agri_prod_table WHERE id = ?";
    $stmt_chk = $dbh->prepare($query_chk);
    $stmt_chk->execute(array($id));
    $row_chk = $stmt_chk->fetch(PDO::FETCH_ASSOC);

    if (!$row_chk) {
        http_response_code(400);
        echo 'error:record_not_found';
        exit;
    }

    $zer_kesht_a = (float) $row_chk['zer_kesht_a'];
    $zer_kesht_b = (float) $row_chk['zer_kesht_b'];

    // قاعده ۱: هر دو سطح برداشت نباید همزمان بزرگتر از صفر باشند
    if ($sba_num > 0 && $sbb_num > 0) {
        http_response_code(400);
        echo 'error:both_harvest';
        exit;
    }

    // قاعده ۲: اگر سطح زیر کشت اول > 0 باشد، فقط سطح برداشت اول مجاز است
    if ($zer_kesht_a > 0 && $sbb_num > 0) {
        http_response_code(400);
        echo 'error:invalid_harvest_b';
        exit;
    }

    // قاعده ۳: اگر سطح زیر کشت دوم > 0 باشد، فقط سطح برداشت دوم مجاز است
    if ($zer_kesht_b > 0 && $sba_num > 0) {
        http_response_code(400);
        echo 'error:invalid_harvest_a';
        exit;
    }

    // قاعده ۴: اگر سطح برداشت > 0 است، سطح زیر کشت متناظر باید > 0 باشد
    if ($sba_num > 0 && $zer_kesht_a <= 0) {
        http_response_code(400);
        echo 'error:no_zer_kesht_a';
        exit;
    }
    if ($sbb_num > 0 && $zer_kesht_b <= 0) {
        http_response_code(400);
        echo 'error:no_zer_kesht_b';
        exit;
    }

    // ===== پایان کنترل‌ها =====

    $query = "UPDATE $Agri_prod_table SET date_s=?, s_bar_a=?, s_bar_b=?, mah_tol=?, mah_kh=? WHERE id=?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($date_edit, $s_bar_a, $s_bar_b, $mah_tol, $mah_kh, $id));

    sabt_event(
        $login_session,
        getUserIP_1(),
        $date_edit,
        $time,
        $add_abadi,
        ',ثبت تولید قطعی زراعی /' . $sh_gat . '/' . $bah_cod_m,
        $id_ostan
    );

    echo 'ok';
}