<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
include('../cod_m.php');
require_once('../../Jalali.php');
require_once('PreviousYearClearanceChecker.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri2_clean_code($v)
{
    if (!isset($v)) return '';
    $v = trim($v);
    if ($v == '/' || $v == '\\') return '';
    return $v;
}

function agri2_load_place($dbh, $m_poul, $add_abadi, $add_city)
{
    $out = array(
        'ok' => false,
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'id_ostan' => '',
        'id_city' => '',
        'id_mar' => ''
    );
    if ($m_poul == 'abadi' && $add_abadi != '' && $add_abadi != '-') {
        $query = "SELECT id_ostan,id_city,id_mar,add_abadi from list_abadi where add_abadi = :add_abadi";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':add_abadi' => $add_abadi));
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $out['ok'] = true;
            $out['add_abadi'] = $row['add_abadi'];
            $out['add_city'] = '-';
            $out['id_ostan'] = $row['id_ostan'];
            $out['id_city'] = $row['id_city'];
            $out['id_mar'] = $row['id_mar'];
        }
    } elseif ($m_poul == 'shahr' && $add_city != '' && $add_city != '-') {
        $query = "SELECT id_ostan,id_city,id_mar,add_city from list_city where add_city = :add_city";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':add_city' => $add_city));
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $out['ok'] = true;
            $out['add_city'] = $row['add_city'];
            $out['add_abadi'] = '-';
            $out['id_ostan'] = $row['id_ostan'];
            $out['id_city'] = $row['id_city'];
            $out['id_mar'] = $row['id_mar'];
        }
    }
    return $out;
}

function agri2_num($v)
{
    $v = trim(str_replace(array('،', ','), '.', $v . ''));
    if ($v === '') return null;
    if (!is_numeric($v)) return false;
    return $v + 0;
}

function vege_build_products($mah1, $mah2, $mah3, $t_kind)
{
    $name_mah = array();
    if ($mah1 == '1') $name_mah[] = array('گوجه فرنگی', '174');
    if ($mah2 == '1') $name_mah[] = array('پیاز', '172');
    if ($mah3 == '1') {
        $n = intval($t_kind);
        if ($n < 1) $n = 1;
        while ($n > 0) {
            $name_mah[] = array('سیب زمینی', '170');
            $n--;
        }
    }
    return $name_mah;
}

function vege_label_b_time($b_time)
{
    if ($b_time == '1') return 'زمستانه/استمرار';
    if ($b_time == '2') return 'بهاره';
    if ($b_time == '3') return 'تابستانه';
    if ($b_time == '4') return 'پاییزه';
    return '';
}

function vege_label_m_ab($m_ab)
{
    $map = array(
        '1' => 'چشمه', '2' => 'قنات', '3' => 'رودخانه', '4' => 'سد',
        '5' => 'چاه سطحی', '6' => 'چاه عمیق', '7' => 'چاه نیمه عمیق',
        '8' => 'زهکش', '9' => 'پساب', '10' => 'آب بندان', '11' => 'سایر'
    );
    return isset($map[$m_ab]) ? $map[$m_ab] : '';
}

function vege_ragham_options($prod_name, $selected)
{
    $opts = array();
    if ($prod_name == 'گوجه فرنگی') {
        $opts[] = array('-', '-----');
    } elseif ($prod_name == 'پیاز') {
        $opts[] = array('', 'انتخاب کنید');
        $opts[] = array('1', 'قرمز');
        $opts[] = array('2', 'سفید');
        $opts[] = array('3', 'زرد');
        $opts[] = array('4', 'صورتی');
    } elseif ($prod_name == 'سیب زمینی') {
        $opts[] = array('', 'انتخاب کنید');
        $map = array(
            '1' => 'اگریا', '2' => 'سانته', '3' => 'ساتینا', '4' => 'میلوا',
            '5' => 'بورن', '6' => 'ساوالان', '7' => 'آرنیدا', '8' => 'بانبا',
            '9' => 'مارفونا', '10' => 'فونتانه', '11' => 'راموس', '12' => 'پیکاسو',
            '13' => 'جلی', '14' => 'سایر'
        );
        foreach ($map as $k => $v) $opts[] = array($k, $v);
    }
    $html = '';
    foreach ($opts as $o) {
        $sel = ((string)$selected === (string)$o[0]) ? ' selected="selected"' : '';
        $html .= '<option value="' . agri2_h($o[0]) . '"' . $sel . '>' . agri2_h($o[1]) . '</option>';
    }
    return $html;
}

function vege_ra_kesh_options($prod_name, $selected)
{
    if ($prod_name == 'سیب زمینی') {
        return '<option value="2" selected="selected">مستقیم</option>';
    }
    $html = '<option value="">انتخاب کنید</option>';
    $html .= '<option value="1"' . ($selected == '1' ? ' selected="selected"' : '') . '>نشایی</option>';
    $html .= '<option value="2"' . ($selected == '2' ? ' selected="selected"' : '') . '>مستقیم</option>';
    if ($prod_name == 'گوجه فرنگی') {
        $html .= '<option value="3"' . ($selected == '3' ? ' selected="selected"' : '') . '>نشایی با مالچ</option>';
        $html .= '<option value="4"' . ($selected == '4' ? ' selected="selected"' : '') . '>مستقیم با مالچ</option>';
    }
    return $html;
}

function vege_validate_step2($post, $t_mah, $name_mah)
{
    $errors = array();
    $lng = agri2_num(isset($post['lng']) ? $post['lng'] : '');
    $lat = agri2_num(isset($post['lat']) ? $post['lat'] : '');
    $m_zamin = agri2_num(isset($post['m_zamin']) ? $post['m_zamin'] : '');

    if ($lng === null) $errors['lng'] = 'طول جغرافیایی را وارد کنید';
    elseif ($lng === false) $errors['lng'] = 'طول جغرافیایی باید عدد باشد';
    elseif ($lng < 40 || $lng > 70) $errors['lng'] = 'طول جغرافیایی باید بین ۴۰ تا ۷۰ باشد (مثال: ۴۶٫۲۱)';

    if ($lat === null) $errors['lat'] = 'عرض جغرافیایی را وارد کنید';
    elseif ($lat === false) $errors['lat'] = 'عرض جغرافیایی باید عدد باشد';
    elseif ($lat < 20 || $lat > 45) $errors['lat'] = 'عرض جغرافیایی باید بین ۲۰ تا ۴۵ باشد (مثال: ۳۷٫۰۱)';

    if ($m_zamin === null) $errors['m_zamin'] = 'کل سطح زیر کشت را وارد کنید';
    elseif ($m_zamin === false) $errors['m_zamin'] = 'کل سطح زیر کشت باید عدد باشد';
    elseif ($m_zamin <= 0) $errors['m_zamin'] = 'کل سطح زیر کشت باید بزرگ‌تر از صفر باشد';

    $sum = 0;
    $n = 1;
    $idx = $t_mah;
    while ($idx > 0) {
        $prod = isset($name_mah[$n - 1][0]) ? $name_mah[$n - 1][0] : '';
        $mas = agri2_num(isset($post['mah_mas' . $idx]) ? $post['mah_mas' . $idx] : '');
        if ($mas === null) $errors['mah_mas' . $idx] = 'سطح زیر کشت «' . $prod . '» را وارد کنید';
        elseif ($mas === false) $errors['mah_mas' . $idx] = 'سطح زیر کشت «' . $prod . '» باید عدد باشد';
        elseif ($mas <= 0) $errors['mah_mas' . $idx] = 'سطح زیر کشت «' . $prod . '» باید بزرگ‌تر از صفر باشد';
        else $sum += $mas;

        if (!isset($post['mah_bem' . $idx]) || $post['mah_bem' . $idx] == '') {
            $errors['mah_bem' . $idx] = 'وضعیت بیمه «' . $prod . '» را انتخاب کنید';
        }
        if (!isset($post['no_ab' . $idx]) || $post['no_ab' . $idx] == '') {
            $errors['no_ab' . $idx] = 'روش آبیاری «' . $prod . '» را انتخاب کنید';
        }
        if ($prod != 'سیب زمینی' && (!isset($post['ra_kesh' . $idx]) || $post['ra_kesh' . $idx] == '')) {
            $errors['ra_kesh' . $idx] = 'روش کشت «' . $prod . '» را انتخاب کنید';
        }
        if ($prod != 'گوجه فرنگی' && (!isset($post['ragham' . $idx]) || $post['ragham' . $idx] == '')) {
            $errors['ragham' . $idx] = 'نوع رقم «' . $prod . '» را انتخاب کنید';
        }
        $sal_ab = isset($post['sal_ab' . $idx]) ? $post['sal_ab' . $idx] : '';
        $mah_ab = isset($post['mah_ab' . $idx]) ? $post['mah_ab' . $idx] : '';
        $roz_ab = isset($post['roz_ab' . $idx]) ? $post['roz_ab' . $idx] : '';
        if ($sal_ab == '' || $mah_ab == '' || $roz_ab == '') {
            $errors['date_ab' . $idx] = 'تاریخ اولین آبیاری «' . $prod . '» را کامل انتخاب کنید';
        }
        $idx--;
        $n++;
    }

    if ($m_zamin !== null && $m_zamin !== false && $sum > $m_zamin) {
        $errors['traz'] = 'مجموع سطح محصولات از کل سطح زیر کشت بیشتر است';
    }
    return $errors;
}

function vege_redirect_hidden($name, $value)
{
    echo '<input type="hidden" name="' . agri2_h($name) . '" value="' . agri2_h($value) . '"/>';
}

$slash_keys = array('add_abadi', 'add_city', 'id_city', 'id_mar', 'id_ostan', 'm_poul');
foreach ($slash_keys as $k) {
    if (isset($_POST[$k])) {
        $_POST[$k] = agri2_clean_code($_POST[$k]);
    }
}

$mess = $add_abadi = $add_city = $m_poul = '';
$field_errors = array();
$pattern_errors = array();
$show_step2 = false;
$place_ok = false;
$place_err = '';
$clearance_err = '';
$save_err = '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$id_mar = isset($_POST['id_mar']) ? agri2_clean_code($_POST['id_mar']) : '';
$b_time = isset($_POST['b_time']) ? $_POST['b_time'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah1 = isset($_POST['mah1']) ? $_POST['mah1'] : '';
$mah2 = isset($_POST['mah2']) ? $_POST['mah2'] : '';
$mah3 = isset($_POST['mah3']) ? $_POST['mah3'] : '';
$t_kind = isset($_POST['t_kind']) ? $_POST['t_kind'] : '';
$m_ab = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
$no_bah = isset($_POST['no_bah']) ? $_POST['no_bah'] : '';
$lng = isset($_POST['lng']) ? $_POST['lng'] : '';
$lat = isset($_POST['lat']) ? $_POST['lat'] : '';
$m_zamin = isset($_POST['m_zamin']) ? $_POST['m_zamin'] : '';
$v_b_time = '';
$v_m_ab = '';
$name_mah = array();
$t_mah = 0;

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

if (isset($_POST['action1'])) {
    ?>
    <form name="myform" class="myform" method="post" action="../benef.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
    exit;
}

if (isset($_POST['m_poul'])) $m_poul = $_POST['m_poul'];
if (isset($_POST['add_abadi'])) {
    $add_abadi = $_POST['add_abadi'];
    if (isset($_POST['m_poul'])) $m_poul = $_POST['m_poul'];
}
if (isset($_POST['add_city'])) {
    $add_city = $_POST['add_city'];
    if (isset($_POST['m_poul'])) $m_poul = $_POST['m_poul'];
}

$id_ostan = isset($_POST['id_ostan']) ? agri2_clean_code($_POST['id_ostan']) : '';
$id_city = isset($_POST['id_city']) ? agri2_clean_code($_POST['id_city']) : '';
$force_step1 = (isset($_POST['agri_step']) && $_POST['agri_step'] == '1');

$is_save = (!$force_step1 && isset($_POST['action']) && isset($_POST['m_zamin']));
if ($is_save) {
    $query = "SELECT ok,no_bah from bah where bah_cod_m = :bah_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $ok = ($row && isset($row['ok'])) ? $row['ok'] : '';
    if ($no_bah == '' && $row && isset($row['no_bah'])) $no_bah = $row['no_bah'];
    if ($ok == '2') {
        alert('بهره بردار در قید حیات نمیباشد !! امکان ثبت اطلاعات مقدور نیست');
        ?>
    <form name="myform" class="myform" method="post" action="index.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
        <?php
        exit;
    }
    if ($ok == '4') {
        alert('اطلاعات بهره بردار از طرف ثبت احوال تایید نشد !! امکان ثبت اطلاعات مقدور نمیباشد');
        ?>
    <form name="myform" class="myform" method="post" action="index.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
        <?php
        exit;
    }

    $date_s = $date_edit;
    $mor_cod_m = $login_session;
    $m_poul = isset($_POST['m_poul']) ? agri2_clean_code($_POST['m_poul']) : $m_poul;
    $add_city = agri2_clean_code(isset($_POST['add_city']) ? $_POST['add_city'] : $add_city);
    $add_abadi = agri2_clean_code(isset($_POST['add_abadi']) ? $_POST['add_abadi'] : $add_abadi);
    if ($m_poul == '') {
        if ($add_abadi != '' && $add_abadi != '-') $m_poul = 'abadi';
        elseif ($add_city != '' && $add_city != '-') $m_poul = 'shahr';
    }
    $place = agri2_load_place($dbh, $m_poul, $add_abadi, $add_city);
    if (!$place['ok']) {
        $place_err = 'موقعیت بهره برداری نامعتبر است. آبادی/شهر را دوباره انتخاب کنید.';
        $show_step2 = true;
    } else {
        $add_abadi = $place['add_abadi'];
        $add_city = $place['add_city'];
        $id_ostan = $place['id_ostan'];
        $id_city = $place['id_city'];
        $id_mar = $place['id_mar'];
        $name_mah = vege_build_products($mah1, $mah2, $mah3, $t_kind);
        $t_mah = count($name_mah);
        if (isset($_POST['t_mah']) && intval($_POST['t_mah']) > 0) {
            $t_mah = intval($_POST['t_mah']);
        }
        if ($t_mah < 1) {
            $field_errors['mah'] = 'حداقل باید یک محصول انتخاب شود';
            $show_step2 = true;
            $mess = 'لطفاً موارد زیر را تکمیل کنید';
        } else {
            $field_errors = vege_validate_step2($_POST, $t_mah, $name_mah);
            if (!empty($field_errors)) {
                $show_step2 = true;
                $mess = 'لطفاً موارد زیر را تکمیل کنید';
            } else {
                try {
                    $clearanceChecker = new PreviousYearClearanceChecker($dbh, $bah_cod_m, $mor_cod_m, $z_sal, 'vege');
                    $clearanceResult = $clearanceChecker->check();
                    if ($clearanceResult['has_uncleared']) {
                        $clearance_err = $clearanceResult['message'];
                        $show_step2 = true;
                    }
                } catch (Exception $e) {
                    error_log('PreviousYearClearanceChecker Error: ' . $e->getMessage());
                }

                if ($clearance_err == '') {
                    $lng = agri2_num($_POST['lng']);
                    $lat = agri2_num($_POST['lat']);
                    $m_zamin = agri2_num($_POST['m_zamin']);
                    $b_time = $_POST['b_time'];
                    $m_ab = $_POST['m_ab'];
                    $z_sal = trim($_POST['z_sal']);
                    if (isset($_POST['no_bah']) && $_POST['no_bah'] != '') $no_bah = $_POST['no_bah'];

                    $query = "SELECT max(`sh_gat`) as `max_shgat` FROM `Vege` WHERE bah_cod_m= :bah_cod_m and z_sal= :z_sal and no_bah = :no_bah";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute(array(':bah_cod_m' => $bah_cod_m, ':z_sal' => $z_sal, ':no_bah' => $no_bah));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $t_gat = $row['max_shgat'];
                    $sh_gat = $t_gat + 1;

                    $successful_products_count = 0;
                    $products_to_insert = array();
                    $temp_zer_kesht_for_this_form = array();
                    $num3_t_mah = $t_mah;
                    $n_prod = 1;
                    while ($num3_t_mah > 0) {
                        if (isset($_POST['mah_mas' . $num3_t_mah])) {
                            $zer_kesht = agri2_num($_POST['mah_mas' . $num3_t_mah]);
                            $cod_mah = isset($_POST['cod_mah' . $num3_t_mah]) ? $_POST['cod_mah' . $num3_t_mah] : '';
                            $prod_label = isset($name_mah[$n_prod - 1][0]) ? $name_mah[$n_prod - 1][0] : mah_name($cod_mah);

                            if (!isset($temp_zer_kesht_for_this_form[$cod_mah])) {
                                $temp_zer_kesht_for_this_form[$cod_mah] = 0;
                            }

                            $is_validation_needed = ($z_sal != '1403-1404');
                            $is_valid_product = true;
                            if ($is_validation_needed) {
                                $query_sum = "SELECT SUM(zer_kesht) as total_zer_kesht FROM Vege_prod WHERE id_ostan = :id_ostan AND id_city = :id_city AND id_mar = :id_mar AND z_sal = :z_sal AND cod_mah = :cod_mah";
                                $stmt_sum = $dbh->prepare($query_sum);
                                $stmt_sum->execute(array(':id_ostan' => $id_ostan, ':id_city' => $id_city, ':id_mar' => $id_mar, ':z_sal' => $z_sal, ':cod_mah' => $cod_mah));
                                $row_sum = $stmt_sum->fetch(PDO::FETCH_ASSOC);
                                $current_db_total = $row_sum['total_zer_kesht'] ? $row_sum['total_zer_kesht'] : 0;

                                $query_abi = "SELECT s_abi FROM Agri_ab_mar WHERE id_ostan = :id_ostan AND id_city = :id_city AND id_mar = :id_mar AND z_sal = :z_sal AND product_cod = :cod_mah";
                                $stmt_abi = $dbh->prepare($query_abi);
                                $stmt_abi->execute(array(':id_ostan' => $id_ostan, ':id_city' => $id_city, ':id_mar' => $id_mar, ':z_sal' => $z_sal, ':cod_mah' => $cod_mah));
                                $row_abi = $stmt_abi->fetch(PDO::FETCH_ASSOC);

                                if (!$row_abi || $row_abi['s_abi'] == 0) {
                                    $pattern_errors[] = 'الگوی کشت برای محصول «' . $prod_label . '» تعریف نشده است (سقف مجاز صفر یا وجود ندارد).';
                                    $is_valid_product = false;
                                } else {
                                    $s_abi_limit = $row_abi['s_abi'];
                                    if (($current_db_total + $temp_zer_kesht_for_this_form[$cod_mah] + $zer_kesht) > $s_abi_limit) {
                                        $pattern_errors[] = 'سقف مجاز برای ثبت محصول «' . $prod_label . '» پر شده است.';
                                        $is_valid_product = false;
                                    }
                                }
                            }

                            if ($is_valid_product) {
                                $temp_zer_kesht_for_this_form[$cod_mah] += $zer_kesht;
                                $no_ab_p = $_POST['no_ab' . $num3_t_mah];
                                $mah_bem = $_POST['mah_bem' . $num3_t_mah];
                                $ragham = isset($_POST['ragham' . $num3_t_mah]) ? $_POST['ragham' . $num3_t_mah] : '';
                                $ra_kesh = $_POST['ra_kesh' . $num3_t_mah];
                                $sal_ab = isset($_POST['sal_ab' . $num3_t_mah]) ? $_POST['sal_ab' . $num3_t_mah] : '';
                                $mah_ab = $_POST['mah_ab' . $num3_t_mah];
                                $roz_ab = $_POST['roz_ab' . $num3_t_mah];
                                $date_ab = $sal_ab . '/' . $mah_ab . '/' . $roz_ab;
                                $products_to_insert[] = array(
                                    'zer_kesht' => $zer_kesht,
                                    'cod_mah' => $cod_mah,
                                    'no_ab' => $no_ab_p,
                                    'mah_bem' => $mah_bem,
                                    'ragham' => $ragham,
                                    'ra_kesh' => $ra_kesh,
                                    'sal_ab' => $sal_ab,
                                    'mah_ab' => $mah_ab,
                                    'roz_ab' => $roz_ab,
                                    'date_ab' => $date_ab
                                );
                                $successful_products_count++;
                            }
                        }
                        $num3_t_mah--;
                        $n_prod++;
                    }

                    if ($successful_products_count > 0) {
                        try {
                            $dbh->beginTransaction();
                            $query = "INSERT INTO Vege (date_s,mor_cod_m,bah_cod_m,b_time,no_bah,sh_gat,id_ostan,id_city,id_mar,add_abadi,add_city,m_zamin,lng,lat,m_ab,z_sal,t_mah)
                            VALUES(:date_s,:mor_cod_m,:bah_cod_m,:b_time,:no_bah,:sh_gat,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:m_zamin,:lng,:lat,:m_ab,:z_sal,:t_mah)";
                            $q = $dbh->prepare($query);
                            $q->execute(array(
                                ':date_s' => $date_s, ':mor_cod_m' => $mor_cod_m, ':bah_cod_m' => $bah_cod_m,
                                ':b_time' => $b_time, ':no_bah' => $no_bah, ':sh_gat' => $sh_gat,
                                ':id_ostan' => $id_ostan, ':id_city' => $id_city, ':id_mar' => $id_mar,
                                ':add_abadi' => $add_abadi, ':add_city' => $add_city, ':m_zamin' => $m_zamin,
                                ':lng' => $lng, ':lat' => $lat, ':m_ab' => $m_ab, ':z_sal' => $z_sal,
                                ':t_mah' => $successful_products_count
                            ));
                            $Vege_id = Vege_id($bah_cod_m, $sh_gat, $z_sal, $mor_cod_m, $date_s);
                            foreach ($products_to_insert as $product) {
                                $query = "INSERT INTO Vege_prod (Vege_id,date_s,mor_cod_m,bah_cod_m,b_time,no_bah,sh_gat,id_ostan,id_city,id_mar,add_abadi,add_city,z_sal,ra_kesh,cod_mah,zer_kesht,mah_bem,ragham,no_ab,sal_ab,mah_ab,roz_ab,date_ab)
                                VALUES(:Vege_id,:date_s,:mor_cod_m,:bah_cod_m,:b_time,:no_bah,:sh_gat,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:z_sal,:ra_kesh,:cod_mah,:zer_kesht,:mah_bem,:ragham,:no_ab,:sal_ab,:mah_ab,:roz_ab,:date_ab)";
                                $q = $dbh->prepare($query);
                                $q->execute(array(
                                    ':Vege_id' => $Vege_id, ':date_s' => $date_s, ':mor_cod_m' => $mor_cod_m,
                                    ':bah_cod_m' => $bah_cod_m, ':b_time' => $b_time, ':no_bah' => $no_bah,
                                    ':sh_gat' => $sh_gat, ':id_ostan' => $id_ostan, ':id_city' => $id_city,
                                    ':id_mar' => $id_mar, ':add_abadi' => $add_abadi, ':add_city' => $add_city,
                                    ':z_sal' => $z_sal, ':ra_kesh' => $product['ra_kesh'], ':cod_mah' => $product['cod_mah'],
                                    ':zer_kesht' => $product['zer_kesht'], ':mah_bem' => $product['mah_bem'],
                                    ':ragham' => $product['ragham'], ':no_ab' => $product['no_ab'],
                                    ':sal_ab' => $product['sal_ab'], ':mah_ab' => $product['mah_ab'],
                                    ':roz_ab' => $product['roz_ab'], ':date_ab' => $product['date_ab']
                                ));
                            }
                            sabt_event($login_session, getUserIP_1(), $date_edit, $time, $add_abadi, 'ثبت اطلاعات صیفی - ' . $bah_cod_m, $id_ostan);
                            $dbh->commit();
                            $success_message = 'اطلاعات ' . $successful_products_count . ' محصول با موفقیت ثبت شد.';
                            if (!empty($pattern_errors)) {
                                $success_message .= "\n" . implode("\n", $pattern_errors);
                            }
                            alert($success_message);
                            ?>
    <form name="myform1" class="myform" method="post" action="index.php"></form>
    <script type="text/javascript">document.myform1.submit();</script>
                            <?php
                            exit;
                        } catch (PDOException $e) {
                            $dbh->rollBack();
                            $save_err = 'خطای پایگاه داده: امکان ثبت اطلاعات نیست.';
                            $show_step2 = true;
                        }
                    } else {
                        $show_step2 = true;
                        $mess = 'هیچ محصولی ثبت نشد';
                        if (empty($pattern_errors)) {
                            $pattern_errors[] = 'هیچ محصولی برای ثبت معتبر نبود.';
                        }
                    }
                }
            }
        }
    }
}

if (!$is_save && (isset($_POST['action']) || isset($_POST['action9']))) {
    if ($m_poul == '') {
        $mess = 'موقعیت بهره برداری را تعیین کنید ' . '<p>';
        $field_errors['m_poul'] = 'موقعیت بهره برداری را تعیین کنید';
    }
    $add_city = isset($_POST['add_city']) ? $_POST['add_city'] : $add_city;
    if ($m_poul == 'shahr' && $add_city == '') {
        $mess .= 'نام شهر را انتخاب کنید' . '<p>';
        $field_errors['add_city'] = 'نام شهر را انتخاب کنید';
    }
    $add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : $add_abadi;
    if ($m_poul == 'abadi' && $add_abadi == '') {
        $mess .= 'نام آبادی را انتخاب کنید' . '<p>';
        $field_errors['add_abadi'] = 'نام آبادی را انتخاب کنید';
    }
    if ($bah_cod_m == '') {
        $mess .= 'کد ملی را وارد کنید' . '<p>';
        $field_errors['bah_cod_m'] = 'کد ملی را وارد کنید';
    }
    if ($z_sal == '') {
        $mess .= 'سال زراعی را انتخاب کنید' . '<p>';
        $field_errors['z_sal'] = 'سال زراعی را انتخاب کنید';
    }
    if ($b_time == '') {
        $mess .= 'فصل تولید را انتخاب کنید' . '<p>';
        $field_errors['b_time'] = 'فصل تولید را انتخاب کنید';
    }
    if ($m_ab == '') {
        $mess .= 'نوع منبع آب را انتخاب کنید' . '<p>';
        $field_errors['m_ab'] = 'نوع منبع آب را انتخاب کنید';
    }
    if ($mah1 != '1' && $mah2 != '1' && $mah3 != '1') {
        $mess .= ' حداقل باید یک محصول انتخاب شود' . '<p>';
        $field_errors['mah'] = 'حداقل باید یک محصول انتخاب شود';
    }
    if ($mah3 == '1' && $t_kind < 1) {
        $mess .= ' تعداد ارقام کشت سیب زمینی را تصحیح کنید' . '<p>';
        $field_errors['t_kind'] = 'تعداد ارقام کشت سیب زمینی را تصحیح کنید';
    }

    if ($mess == '') {
        $query = "SELECT no_bah from bah where bah_cod_m = :bah_cod_m";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
        $count_codm = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && isset($row['no_bah']) && $no_bah == '') $no_bah = $row['no_bah'];
        if ($count_codm > 1 && !isset($_POST['action9'])) {
            ?>
            <form name="myform1" class="myform" method="post" action="Vbah_history.php">
                <?php
                vege_redirect_hidden('bah_cod_m', $bah_cod_m);
                vege_redirect_hidden('m_poul', $m_poul);
                vege_redirect_hidden('add_city', $add_city);
                vege_redirect_hidden('add_abadi', $add_abadi);
                vege_redirect_hidden('b_time', $b_time);
                vege_redirect_hidden('mah1', $mah1);
                vege_redirect_hidden('mah2', $mah2);
                vege_redirect_hidden('mah3', $mah3);
                vege_redirect_hidden('t_kind', $t_kind);
                vege_redirect_hidden('m_ab', $m_ab);
                vege_redirect_hidden('z_sal', $z_sal);
                ?>
            </form>
            <script type="text/javascript">document.myform1.submit();</script>
            <?php
            exit;
        }
        if ($count_codm == 0) {
            $mess = 'اطلاعات بهره بردار یافت نشد <p> برای ثبت اطلاعات محصولات عمده صیفی ، ابتدا اطلاعات بهره بردار را ثبت نمایید ';
            $not_found_bah = true;
            $field_errors['bah_cod_m'] = 'اطلاعات بهره بردار یافت نشد';
        } else {
            if (!isset($_POST['action9'])) {
                $query = "SELECT count(*) FROM Vege WHERE bah_cod_m = :bah_cod_m and z_sal = :z_sal";
                $stmt = $dbh->prepare($query);
                $stmt->execute(array(':bah_cod_m' => $bah_cod_m, ':z_sal' => $z_sal));
                $count_vege = $stmt->fetchColumn();
                if ($count_vege > 0) {
                    ?>
                    <form name="myform1" class="myform" method="post" action="Vege_history.php">
                        <?php
                        vege_redirect_hidden('no_bah', $no_bah);
                        vege_redirect_hidden('bah_cod_m', $bah_cod_m);
                        vege_redirect_hidden('m_poul', $m_poul);
                        vege_redirect_hidden('add_city', $add_city);
                        vege_redirect_hidden('add_abadi', $add_abadi);
                        vege_redirect_hidden('b_time', $b_time);
                        vege_redirect_hidden('mah1', $mah1);
                        vege_redirect_hidden('mah2', $mah2);
                        vege_redirect_hidden('mah3', $mah3);
                        vege_redirect_hidden('t_kind', $t_kind);
                        vege_redirect_hidden('m_ab', $m_ab);
                        vege_redirect_hidden('z_sal', $z_sal);
                        ?>
                    </form>
                    <script type="text/javascript">document.myform1.submit();</script>
                    <?php
                    exit;
                }
            }
            $show_step2 = true;
        }
    }
}

if (!$force_step1 && !$show_step2 && !isset($_POST['action']) && !isset($_POST['action9'])
    && $bah_cod_m != '' && $z_sal != '' && $b_time != '' && $m_poul != ''
    && ($mah1 == '1' || $mah2 == '1' || $mah3 == '1')) {
    $show_step2 = true;
}

if ($show_step2) {
    $query = "SELECT ok,no_bah from bah where bah_cod_m = :bah_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $ok = ($row && isset($row['ok'])) ? $row['ok'] : '';
    if ($no_bah == '' && $row && isset($row['no_bah'])) $no_bah = $row['no_bah'];
    if ($ok == '2') {
        alert('بهره بردار در قید حیات نمیباشد !! امکان ثبت اطلاعات مقدور نیست');
        ?>
    <form name="myform" class="myform" method="post" action="index.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
        <?php
        exit;
    }
    if ($ok == '4') {
        alert('اطلاعات بهره بردار از طرف ثبت احوال تایید نشد !! امکان ثبت اطلاعات مقدور نمیباشد');
        ?>
    <form name="myform" class="myform" method="post" action="index.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
        <?php
        exit;
    }
    if (isset($_POST['add_abadi'])) $add_abadi = agri2_clean_code($_POST['add_abadi']);
    if (isset($_POST['add_city'])) $add_city = agri2_clean_code($_POST['add_city']);
    if (isset($_POST['m_poul'])) $m_poul = agri2_clean_code($_POST['m_poul']);
    if ($m_poul == '') {
        if ($add_abadi != '' && $add_abadi != '-') $m_poul = 'abadi';
        elseif ($add_city != '' && $add_city != '-') $m_poul = 'shahr';
    }
    $name_mah = vege_build_products($mah1, $mah2, $mah3, $t_kind);
    $t_mah = count($name_mah);
    $v_b_time = vege_label_b_time($b_time);
    $v_m_ab = vege_label_m_ab($m_ab);
    $place = agri2_load_place($dbh, $m_poul, $add_abadi, $add_city);
    $place_ok = $place['ok'];
    if ($place_ok) {
        $add_abadi = $place['add_abadi'];
        $add_city = $place['add_city'];
        $id_ostan = $place['id_ostan'];
        $id_city = $place['id_city'];
        $id_mar = $place['id_mar'];
    } else {
        $id_ostan = '';
        $id_city = '';
        $id_mar = '';
        if ($place_err == '') $place_err = 'موقعیت بهره برداری یافت نشد. آبادی/شهر را از مرحله قبل دوباره انتخاب کنید.';
    }
}

$city_data = array();
$abadi_data = array();
if (!$show_step2) {
    $query = "SELECT add_city, shahr FROM `list_city` WHERE mor_cod_m = :mor_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':mor_cod_m' => $login_session));
    foreach ($stmt as $row) {
        $city_data[] = array('code' => $row['add_city'], 'name' => $row['shahr']);
    }
    $query = "SELECT add_abadi, abadi FROM `list_abadi` WHERE mor_cod_m = :mor_cod_m ORDER BY BINARY abadi";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':mor_cod_m' => $login_session));
    foreach ($stmt as $row) {
        $abadi_data[] = array('code' => $row['add_abadi'], 'name' => $row['abadi']);
    }
}

$city_label = '';
if ($add_city != '') {
    foreach ($city_data as $item) {
        if ($item['code'] == $add_city) {
            $city_label = $item['name'];
            break;
        }
    }
}
$abadi_label = '';
if ($add_abadi != '') {
    foreach ($abadi_data as $item) {
        if ($item['code'] == $add_abadi) {
            $abadi_label = $item['name'];
            break;
        }
    }
}

$show_city = ($m_poul == 'shahr' || ($add_city != '' && $add_city != '-'));
$show_abadi = ($m_poul == 'abadi' || ($add_abadi != '' && $add_abadi != '-'));
$has_errors = ($mess != '');
$has_step2_errors = ($show_step2 && (!empty($field_errors) || $place_err != '' || $clearance_err != '' || $save_err != '' || !empty($pattern_errors)));
$err_m_poul = isset($field_errors['m_poul']);
$err_city = isset($field_errors['add_city']);
$err_abadi = isset($field_errors['add_abadi']);
$err_cod = isset($field_errors['bah_cod_m']);
$err_z_sal = isset($field_errors['z_sal']);
$err_b_time = isset($field_errors['b_time']);
$err_m_ab = isset($field_errors['m_ab']);
$err_mah = isset($field_errors['mah']);
$err_t_kind = isset($field_errors['t_kind']);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo agri2_h($title); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <style>
        :root {
            --color-primary: #15803D;
            --color-on-primary: #FFFFFF;
            --color-secondary: #166534;
            --color-accent: #A16207;
            --color-on-accent: #FFFFFF;
            --color-background: #F0FDF4;
            --color-foreground: #14532D;
            --color-card: #FFFFFF;
            --color-card-foreground: #14532D;
            --color-muted: #E8F0F1;
            --color-muted-foreground: #475569;
            --color-border: #86C9A0;
            --color-destructive: #DC2626;
            --color-on-destructive: #FFFFFF;
            --color-ring: #15803D;
            --color-warning-bg: #FEF2F2;
            --space-1: 8px;
            --space-2: 16px;
            --space-3: 24px;
            --space-4: 32px;
            --radius: 12px;
            --duration: 200ms;
            --shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
            --touch: 44px;
            --font: myfont, Tahoma, "Segoe UI", sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-padding-top: 96px; }

        body.agri1-body {
            margin: 0;
            background: var(--color-background);
            color: var(--color-foreground);
            font-family: var(--font);
            font-size: 16px;
            line-height: 1.6;
        }

        .agri1-skip {
            position: absolute;
            right: -999px;
            top: 8px;
            z-index: 50;
            background: var(--color-primary);
            color: var(--color-on-primary);
            padding: 8px 16px;
            border-radius: 8px;
        }
        .agri1-skip:focus { right: 8px; }

        .agri1-main {
            width: min(920px, 100%);
            margin: 0 auto;
            padding: var(--space-3) var(--space-2) var(--space-4);
        }

        .agri1-title {
            margin: 0 0 var(--space-2);
            color: var(--color-foreground);
            font-size: clamp(1.35rem, 2.4vw, 1.85rem);
            line-height: 1.4;
            text-wrap: balance;
        }

        .agri1-steps {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-1);
            list-style: none;
            margin: 0 0 var(--space-3);
            padding: 0;
        }

        .agri1-steps li {
            display: flex;
            align-items: center;
            gap: 8px;
            min-height: var(--touch);
            padding: 0 14px;
            border-radius: 999px;
            background: var(--color-muted);
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
        }

        .agri1-steps li.is-current {
            background: var(--color-primary);
            color: var(--color-on-primary);
        }

        .agri1-steps li.is-link {
            padding: 0;
            background: transparent;
        }

        .agri1-step-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            min-height: var(--touch);
            padding: 0 14px;
            border: 0;
            border-radius: 999px;
            background: var(--color-muted);
            color: var(--color-foreground);
            cursor: pointer;
            font: inherit;
            font-size: 0.875rem;
            text-decoration: underline;
            text-underline-offset: 3px;
        }
        .agri1-step-btn:hover { background: #DCFCE7; }
        .agri1-step-btn:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-step-btn .agri1-step-num {
            background: var(--color-primary);
            color: var(--color-on-primary);
        }

        .agri1-step-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            font-size: 0.75rem;
            font-weight: 700;
        }

        .agri1-card {
            background: var(--color-card);
            color: var(--color-card-foreground);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: var(--space-3);
        }

        .agri1-alert {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: var(--space-3);
            padding: var(--space-2);
            border-radius: var(--radius);
            border: 1px solid #FECACA;
            background: var(--color-warning-bg);
            color: #991B1B;
        }
        .agri1-alert:focus { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-alert h2 { margin: 0 0 8px; font-size: 1rem; }
        .agri1-alert ul { margin: 0; padding: 0 18px 0 0; }
        .agri1-alert a { color: #991B1B; text-decoration: underline; }
        .agri1-alert ul:empty { display: none; }

        .agri1-icon {
            flex: 0 0 auto;
            width: 24px;
            height: 24px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .agri1-fieldset { margin: 0 0 var(--space-3); padding: 0; border: 0; }

        .agri1-legend {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            margin-bottom: 10px;
            color: var(--color-foreground);
            font-size: 1rem;
            font-weight: 700;
        }

        .agri1-hint {
            margin: 0 0 12px;
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
        }

        .agri1-choices {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .agri1-choices-3 { grid-template-columns: 1fr 1fr 1fr; }

        .agri1-choice {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 52px;
            padding: 12px 14px;
            border: 2px solid var(--color-border);
            border-radius: var(--radius);
            background: var(--color-card);
            cursor: pointer;
            transition: border-color var(--duration) ease, background-color var(--duration) ease, box-shadow var(--duration) ease;
        }

        .agri1-choice:hover {
            border-color: var(--color-primary);
            background: #F7FEF9;
        }

        .agri1-choice:has(input:checked),
        .agri1-choice.is-selected {
            border-color: var(--color-primary);
            background: #ECFDF3;
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.16);
        }

        .agri1-choice:focus-within {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }

        .agri1-choice input {
            position: absolute;
            opacity: 0;
            width: 1px;
            height: 1px;
        }

        .agri1-choice-mark {
            width: 20px;
            height: 20px;
            border: 2px solid var(--color-primary);
            border-radius: 50%;
            flex-shrink: 0;
            position: relative;
        }

        .agri1-choice input[type="checkbox"] + .agri1-choice-mark { border-radius: 4px; }

        .agri1-choice:has(input:checked) .agri1-choice-mark::after,
        .agri1-choice.is-selected .agri1-choice-mark::after {
            content: "";
            position: absolute;
            inset: 3px;
            border-radius: 50%;
            background: var(--color-primary);
        }
        .agri1-choice:has(input[type="checkbox"]:checked) .agri1-choice-mark::after {
            border-radius: 2px;
        }

        .agri1-field { margin-top: 12px; }

        .agri1-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            color: var(--color-foreground);
        }

        .agri1-page .agri1-form input[type="text"],
        .agri1-page .agri1-form select {
            width: 100%;
            min-height: var(--touch);
            padding: 10px 12px;
            border: 1px solid #64748B;
            border-radius: 10px;
            background: var(--color-card);
            color: var(--color-foreground);
            font-size: 16px;
            box-shadow: none;
            transition: border-color var(--duration) ease, box-shadow var(--duration) ease;
        }

        .agri1-page .agri1-form #bah_cod_m {
            text-align: center;
            letter-spacing: 0.08em;
        }

        .agri1-page .agri1-form input[type="text"]:hover,
        .agri1-page .agri1-form select:hover {
            background: var(--color-card);
            color: var(--color-foreground);
        }

        .agri1-page .agri1-form input[type="text"]:focus,
        .agri1-page .agri1-form select:focus {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
        }

        .agri1-page .agri1-form input[aria-invalid="true"],
        .agri1-page .agri1-form select[aria-invalid="true"],
        .agri1-fieldset.is-invalid .agri1-choices {
            border-color: var(--color-destructive);
        }

        .agri1-combo { position: relative; }

        .agri1-page .agri1-form .agri1-combo input[type="text"] {
            padding-left: 44px;
        }

        .agri1-combo-toggle {
            position: absolute;
            left: 4px;
            top: 50%;
            transform: translateY(-50%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: var(--touch);
            height: var(--touch);
            border: 0;
            background: transparent;
            color: var(--color-foreground);
            cursor: pointer;
            border-radius: 8px;
        }
        .agri1-combo-toggle:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }

        .agri1-combo-list {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            right: 0;
            left: 0;
            z-index: 20;
            max-height: 240px;
            overflow-y: auto;
            margin: 0;
            padding: 6px 0;
            list-style: none;
            background: var(--color-card);
            border: 1px solid var(--color-border);
            border-radius: 10px;
            box-shadow: var(--shadow);
        }
        .agri1-combo-list.is-open { display: block; }

        .agri1-combo-option {
            min-height: var(--touch);
            padding: 10px 14px;
            cursor: pointer;
            color: var(--color-foreground);
        }
        .agri1-combo-option:hover,
        .agri1-combo-option.is-active {
            background: #ECFDF3;
        }
        .agri1-combo-empty {
            padding: 12px 14px;
            color: var(--color-muted-foreground);
        }

        .agri1-error {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 8px 0 0;
            color: var(--color-destructive);
            font-size: 0.875rem;
        }

        .is-hidden { display: none !important; }

        .agri1-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: var(--space-2);
        }

        .agri1-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: var(--touch);
            min-width: var(--touch);
            padding: 10px 20px;
            border: 0;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            touch-action: manipulation;
            transition: background-color var(--duration) ease, transform var(--duration) ease, box-shadow var(--duration) ease, opacity var(--duration) ease;
        }
        .agri1-btn:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-btn:active { transform: translateY(1px); }
        .agri1-btn[aria-busy="true"] { opacity: 0.85; }

        .agri1-btn-primary {
            background: var(--color-primary);
            color: var(--color-on-primary);
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25);
        }
        .agri1-btn-primary:hover { background: var(--color-secondary); }

        .agri1-btn-accent {
            background: var(--color-accent);
            color: var(--color-on-accent);
        }
        .agri1-btn-accent:hover { background: #854D0E; }

        .agri1-btn-ghost {
            background: transparent;
            color: var(--color-foreground);
            border: 1px solid var(--color-border);
        }
        .agri1-btn-ghost:hover { background: var(--color-muted); }

        .agri1-back { margin-top: var(--space-3); }

        .agri1-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 80;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, 0.55);
        }
        .agri1-overlay.is-open { display: flex !important; }

        .agri1-overlay-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            min-width: 220px;
            padding: 24px;
            border-radius: 16px;
            background: var(--color-card);
            color: var(--color-foreground);
        }

        .agri1-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--color-border);
            border-top-color: var(--color-primary);
            border-radius: 50%;
            animation: agri1-spin 0.8s linear infinite;
        }

        @keyframes agri1-spin { to { transform: rotate(360deg); } }

        .agri1-info {
            min-height: var(--touch);
            padding: 10px 12px;
            border-radius: 10px;
            background: var(--color-muted);
            color: var(--color-foreground);
        }
        .agri1-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .agri1-note {
            margin-bottom: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            color: #1D4ED8;
        }
        .agri1-page .agri1-form input.agri-lock,
        .agri1-page .agri1-form input[readonly] {
            background: #FFFBEB;
        }
        .agri1-card-title {
            margin: 0 0 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--color-border);
            font-size: 1rem;
        }
        .agri1-prod-card {
            margin: 0 0 16px;
            padding: 16px;
            border: 1px solid var(--color-border);
            border-radius: 12px;
            background: var(--color-card);
        }
        .agri1-prod-card .agri1-card-title {
            margin-bottom: 12px;
        }
        .agri1-date-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 8px;
        }
        .agri1-date-row .agri1-label {
            font-weight: 600;
            font-size: 0.8rem;
        }
        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
            .agri1-choices-3 { grid-template-columns: 1fr; }
            .agri1-date-row { grid-template-columns: 1fr; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            .agri1-btn:active { transform: none; }
        }
    </style>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#<?php echo $show_step2 ? 'form1' : 'agri2-form'; ?>">رفتن به فرم ثبت</a>

    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>

    <?php include(__DIR__ . '/../../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri2-title"><?php echo $show_step2 ? 'ثبت قطعه صیفی جدید' : 'ثبت اطلاعات محصولات عمده صیفی'; ?></h1>
            <ol class="agri1-steps" aria-label="مراحل ثبت">
                <?php if ($show_step2) { ?>
                <li class="is-link">
                    <button type="submit" class="agri1-step-btn" form="agri2-back">
                        <span class="agri1-step-num" aria-hidden="true">1</span> مشخصات اولیه
                    </button>
                </li>
                <li class="is-current" aria-current="step"><span class="agri1-step-num" aria-hidden="true">2</span> اطلاعات قطعه</li>
                <?php } else { ?>
                <li class="is-current" aria-current="step"><span class="agri1-step-num" aria-hidden="true">1</span> مشخصات اولیه</li>
                <li><span class="agri1-step-num" aria-hidden="true">2</span> اطلاعات قطعه</li>
                <?php } ?>
            </ol>
        </header>

        <section class="agri1-card" aria-labelledby="agri2-title">
            <?php if ($show_step2) { ?>
                <form id="agri2-back" method="post" action="Vege.php" class="is-hidden" aria-hidden="true">
                    <input type="hidden" name="agri_step" value="1"/>
                    <input type="hidden" name="m_poul" value="<?php echo agri2_h($m_poul); ?>"/>
                    <input type="hidden" name="add_city" value="<?php echo agri2_h(($add_city == '-') ? '' : $add_city); ?>"/>
                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h(($add_abadi == '-') ? '' : $add_abadi); ?>"/>
                    <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
                    <input type="hidden" name="b_time" value="<?php echo agri2_h($b_time); ?>"/>
                    <input type="hidden" name="mah1" value="<?php echo agri2_h($mah1); ?>"/>
                    <input type="hidden" name="mah2" value="<?php echo agri2_h($mah2); ?>"/>
                    <input type="hidden" name="mah3" value="<?php echo agri2_h($mah3); ?>"/>
                    <input type="hidden" name="t_kind" value="<?php echo agri2_h($t_kind); ?>"/>
                    <input type="hidden" name="m_ab" value="<?php echo agri2_h($m_ab); ?>"/>
                    <input type="hidden" name="no_bah" value="<?php echo agri2_h($no_bah); ?>"/>
                </form>

                <div class="agri1-alert<?php echo $has_step2_errors ? '' : ' is-hidden'; ?>" id="agri2-error-summary" role="alert" tabindex="-1" aria-labelledby="agri2-error-title" <?php if (!$has_step2_errors) echo 'hidden'; ?>>
                    <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 9v4"></path>
                        <path d="M12 17h.01"></path>
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    </svg>
                    <div>
                        <h2 id="agri2-error-title"><?php
                            if ($place_err != '') echo 'موقعیت بهره‌برداری نیاز به اصلاح دارد';
                            elseif ($clearance_err != '') echo 'تعیین‌تکلیف سال قبل';
                            elseif ($save_err != '') echo 'ثبت انجام نشد';
                            else echo 'لطفاً موارد زیر را تکمیل کنید';
                        ?></h2>
                        <?php if ($place_err != '') { ?>
                            <p><?php echo agri2_h($place_err); ?></p>
                            <p><button type="submit" class="agri1-btn agri1-btn-ghost" form="agri2-back">اصلاح موقعیت در مشخصات اولیه</button></p>
                        <?php } ?>
                        <?php if ($clearance_err != '') { ?>
                            <p><?php echo agri2_h($clearance_err); ?></p>
                        <?php } ?>
                        <?php if ($save_err != '') { ?>
                            <p><?php echo agri2_h($save_err); ?></p>
                        <?php } ?>
                        <?php if (!empty($pattern_errors)) { ?>
                            <ul>
                                <?php foreach ($pattern_errors as $perr) { ?>
                                    <li><?php echo agri2_h($perr); ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <ul id="agri2-error-list">
                            <?php if (!empty($field_errors)) { foreach ($field_errors as $fid => $ferr) { ?>
                                <li><a href="#field-<?php echo agri2_h($fid); ?>"><?php echo agri2_h($ferr); ?></a></li>
                            <?php } } ?>
                        </ul>
                    </div>
                </div>
                <div><?php sar_data2($bah_cod_m, $no_bah); ?></div>

                <form action="Vege.php" method="post" id="form1" name="form1" class="agri1-form" novalidate>
                    <h2 class="agri1-card-title">موقعیت بهره‌برداری</h2>
                    <div class="agri1-grid">
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">استان</span>
                            <div class="agri1-info"><?php echo ostan_name($id_ostan); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">شهرستان</span>
                            <div class="agri1-info"><?php echo city_name1($id_city, $id_ostan); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">مرکز جهاد کشاورزی</span>
                            <div class="agri1-info"><?php echo mar_name($id_mar); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">آبادی / شهر</span>
                            <div class="agri1-info"><?php echo abadi_name($add_abadi); ?></div>
                        </div>
                    </div>

                    <h2 class="agri1-card-title" style="margin-top:24px">اطلاعات زمین</h2>
                    <div class="agri1-grid">
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">فصل تولید</span>
                            <div class="agri1-info"><?php echo agri2_h($v_b_time); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">منبع آب</span>
                            <div class="agri1-info"><?php echo agri2_h($v_m_ab); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-lng">
                            <label class="agri1-label" for="lng">طول جغرافیایی X</label>
                            <input name="lng" type="text" id="lng" dir="ltr" lang="fa" inputmode="decimal" value="<?php echo agri2_h($lng); ?>" maxlength="11"
                                   aria-invalid="<?php echo isset($field_errors['lng']) ? 'true' : 'false'; ?>"
                                   aria-describedby="hint-lng<?php echo isset($field_errors['lng']) ? ' error-lng' : ''; ?>"/>
                            <p class="agri1-hint" id="hint-lng">درجه اعشار — مثال: 46.212486</p>
                            <p class="agri1-error<?php echo isset($field_errors['lng']) ? '' : ' is-hidden'; ?>" id="error-lng"><?php echo isset($field_errors['lng']) ? agri2_h($field_errors['lng']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-lat">
                            <label class="agri1-label" for="lat">عرض جغرافیایی Y</label>
                            <input name="lat" type="text" id="lat" dir="ltr" lang="fa" inputmode="decimal" value="<?php echo agri2_h($lat); ?>" maxlength="11"
                                   aria-invalid="<?php echo isset($field_errors['lat']) ? 'true' : 'false'; ?>"
                                   aria-describedby="hint-lat<?php echo isset($field_errors['lat']) ? ' error-lat' : ''; ?>"/>
                            <p class="agri1-hint" id="hint-lat">درجه اعشار — مثال: 37.010521</p>
                            <p class="agri1-error<?php echo isset($field_errors['lat']) ? '' : ' is-hidden'; ?>" id="error-lat"><?php echo isset($field_errors['lat']) ? agri2_h($field_errors['lat']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_zamin">
                            <label class="agri1-label" for="m_zamin">کل سطح زیر کشت (هکتار)</label>
                            <input name="m_zamin" type="text" id="m_zamin" class="mashat-total" dir="ltr" lang="fa" inputmode="decimal" value="<?php echo agri2_h($m_zamin); ?>" maxlength="11"
                                   aria-invalid="<?php echo isset($field_errors['m_zamin']) ? 'true' : 'false'; ?>"
                                   aria-describedby="hint-m_zamin<?php echo isset($field_errors['m_zamin']) ? ' error-m_zamin' : ''; ?>"/>
                            <p class="agri1-hint" id="hint-m_zamin">مجموع سطح گوجه فرنگی، پیاز و سیب زمینی را وارد کنید.</p>
                            <p class="agri1-error<?php echo isset($field_errors['m_zamin']) ? '' : ' is-hidden'; ?>" id="error-m_zamin"><?php echo isset($field_errors['m_zamin']) ? agri2_h($field_errors['m_zamin']) : ''; ?></p>
                        </div>
                    </div>

                    <h2 class="agri1-card-title" style="margin-top:24px">اطلاعات کاشت سال زراعی <?php echo agri2_h($z_sal); ?></h2>
                    <?php
                    $n = 1;
                    $num2_t_mah = $t_mah;
                    while ($num2_t_mah > 0) {
                        $prod_name = $name_mah[$n - 1][0];
                        $prod_code = $name_mah[$n - 1][1];
                        $idx = $num2_t_mah;
                        $pv_mas = isset($_POST['mah_mas' . $idx]) ? $_POST['mah_mas' . $idx] : '';
                        $pv_bem = isset($_POST['mah_bem' . $idx]) ? $_POST['mah_bem' . $idx] : '';
                        $pv_no_ab = isset($_POST['no_ab' . $idx]) ? $_POST['no_ab' . $idx] : '';
                        $pv_ra = isset($_POST['ra_kesh' . $idx]) ? $_POST['ra_kesh' . $idx] : '';
                        $pv_rag = isset($_POST['ragham' . $idx]) ? $_POST['ragham' . $idx] : '';
                        $pv_sal = isset($_POST['sal_ab' . $idx]) ? $_POST['sal_ab' . $idx] : '';
                        $pv_mah = isset($_POST['mah_ab' . $idx]) ? $_POST['mah_ab' . $idx] : '';
                        $pv_roz = isset($_POST['roz_ab' . $idx]) ? $_POST['roz_ab' . $idx] : '';
                    ?>
                    <article class="agri1-prod-card">
                        <h3 class="agri1-card-title">ردیف <?php echo $n; ?> — <?php echo agri2_h($prod_name); ?></h3>
                        <input type="hidden" name="mah_name<?php echo $idx; ?>" value="<?php echo agri2_h($prod_name); ?>"/>
                        <input type="hidden" name="cod_mah<?php echo $idx; ?>" value="<?php echo agri2_h($prod_code); ?>"/>
                        <div class="agri1-grid">
                            <div class="agri1-field" style="margin-top:0" id="field-mah_mas<?php echo $idx; ?>">
                                <label class="agri1-label" for="mashat<?php echo $idx; ?>">سطح زیر کشت (هکتار)</label>
                                <input name="mah_mas<?php echo $idx; ?>" type="text" class="mashat" id="mashat<?php echo $idx; ?>" dir="ltr" inputmode="decimal" maxlength="10" value="<?php echo agri2_h($pv_mas); ?>"
                                       aria-invalid="<?php echo isset($field_errors['mah_mas' . $idx]) ? 'true' : 'false'; ?>"
                                       aria-describedby="<?php echo isset($field_errors['mah_mas' . $idx]) ? 'error-mah_mas' . $idx : ''; ?>"/>
                                <p class="agri1-error<?php echo isset($field_errors['mah_mas' . $idx]) ? '' : ' is-hidden'; ?>" id="error-mah_mas<?php echo $idx; ?>"><?php echo isset($field_errors['mah_mas' . $idx]) ? agri2_h($field_errors['mah_mas' . $idx]) : ''; ?></p>
                            </div>
                            <div class="agri1-field" style="margin-top:0" id="field-ragham<?php echo $idx; ?>">
                                <label class="agri1-label" for="ragham<?php echo $idx; ?>">نوع رقم</label>
                                <select name="ragham<?php echo $idx; ?>" id="ragham<?php echo $idx; ?>"
                                        aria-invalid="<?php echo isset($field_errors['ragham' . $idx]) ? 'true' : 'false'; ?>"
                                        aria-describedby="<?php echo isset($field_errors['ragham' . $idx]) ? 'error-ragham' . $idx : ''; ?>">
                                    <?php echo vege_ragham_options($prod_name, $pv_rag); ?>
                                </select>
                                <p class="agri1-error<?php echo isset($field_errors['ragham' . $idx]) ? '' : ' is-hidden'; ?>" id="error-ragham<?php echo $idx; ?>"><?php echo isset($field_errors['ragham' . $idx]) ? agri2_h($field_errors['ragham' . $idx]) : ''; ?></p>
                            </div>
                            <div class="agri1-field" style="margin-top:0" id="field-ra_kesh<?php echo $idx; ?>">
                                <label class="agri1-label" for="no_kesht<?php echo $idx; ?>">روش کشت</label>
                                <select name="ra_kesh<?php echo $idx; ?>" id="no_kesht<?php echo $idx; ?>"
                                        aria-invalid="<?php echo isset($field_errors['ra_kesh' . $idx]) ? 'true' : 'false'; ?>"
                                        aria-describedby="<?php echo isset($field_errors['ra_kesh' . $idx]) ? 'error-ra_kesh' . $idx : ''; ?>">
                                    <?php echo vege_ra_kesh_options($prod_name, $pv_ra); ?>
                                </select>
                                <p class="agri1-error<?php echo isset($field_errors['ra_kesh' . $idx]) ? '' : ' is-hidden'; ?>" id="error-ra_kesh<?php echo $idx; ?>"><?php echo isset($field_errors['ra_kesh' . $idx]) ? agri2_h($field_errors['ra_kesh' . $idx]) : ''; ?></p>
                            </div>
                            <div class="agri1-field" style="margin-top:0" id="field-no_ab<?php echo $idx; ?>">
                                <label class="agri1-label" for="no_ab<?php echo $idx; ?>">روش آبیاری</label>
                                <select name="no_ab<?php echo $idx; ?>" id="no_ab<?php echo $idx; ?>"
                                        aria-invalid="<?php echo isset($field_errors['no_ab' . $idx]) ? 'true' : 'false'; ?>"
                                        aria-describedby="<?php echo isset($field_errors['no_ab' . $idx]) ? 'error-no_ab' . $idx : ''; ?>">
                                    <option value="">انتخاب کنید</option>
                                    <option value="1"<?php if ($pv_no_ab == '1') echo ' selected="selected"'; ?>>نواری</option>
                                    <option value="2"<?php if ($pv_no_ab == '2') echo ' selected="selected"'; ?>>غرقابی</option>
                                    <option value="3"<?php if ($pv_no_ab == '3') echo ' selected="selected"'; ?>>قطره ای</option>
                                    <option value="4"<?php if ($pv_no_ab == '4') echo ' selected="selected"'; ?>>بارانی</option>
                                    <option value="5"<?php if ($pv_no_ab == '5') echo ' selected="selected"'; ?>>سایر</option>
                                </select>
                                <p class="agri1-error<?php echo isset($field_errors['no_ab' . $idx]) ? '' : ' is-hidden'; ?>" id="error-no_ab<?php echo $idx; ?>"><?php echo isset($field_errors['no_ab' . $idx]) ? agri2_h($field_errors['no_ab' . $idx]) : ''; ?></p>
                            </div>
                            <div class="agri1-field" style="margin-top:0" id="field-date_ab<?php echo $idx; ?>">
                                <span class="agri1-label">تاریخ اولین آبیاری</span>
                                <div class="agri1-date-row">
                                    <div>
                                        <label class="agri1-label" for="roz<?php echo $idx; ?>">روز</label>
                                        <select name="roz_ab<?php echo $idx; ?>" id="roz<?php echo $idx; ?>">
                                            <option value="">--</option>
                                            <?php for ($d = 1; $d <= 31; $d++) { $dv = str_pad($d, 2, '0', STR_PAD_LEFT); ?>
                                            <option value="<?php echo $dv; ?>"<?php if ($pv_roz == $dv) echo ' selected="selected"'; ?>><?php echo $dv; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="agri1-label" for="mah<?php echo $idx; ?>">ماه</label>
                                        <select name="mah_ab<?php echo $idx; ?>" id="mah<?php echo $idx; ?>">
                                            <option value="">--</option>
                                            <?php for ($m = 1; $m <= 12; $m++) { $mv = str_pad($m, 2, '0', STR_PAD_LEFT); ?>
                                            <option value="<?php echo $mv; ?>"<?php if ($pv_mah == $mv) echo ' selected="selected"'; ?>><?php echo $mv; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="agri1-label" for="sal<?php echo $idx; ?>">سال</label>
                                        <select name="sal_ab<?php echo $idx; ?>" id="sal<?php echo $idx; ?>">
                                            <option value="">--</option>
                                            <option value="1405"<?php if ($pv_sal == '1405') echo ' selected="selected"'; ?>>1405</option>
                                            <option value="1404"<?php if ($pv_sal == '1404') echo ' selected="selected"'; ?>>1404</option>
                                            <option value="1403"<?php if ($pv_sal == '1403') echo ' selected="selected"'; ?>>1403</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="agri1-error<?php echo isset($field_errors['date_ab' . $idx]) ? '' : ' is-hidden'; ?>" id="error-date_ab<?php echo $idx; ?>"><?php echo isset($field_errors['date_ab' . $idx]) ? agri2_h($field_errors['date_ab' . $idx]) : ''; ?></p>
                            </div>
                            <div class="agri1-field" style="margin-top:0" id="field-mah_bem<?php echo $idx; ?>">
                                <label class="agri1-label" for="mah_bem<?php echo $idx; ?>">محصول بیمه هست؟</label>
                                <select name="mah_bem<?php echo $idx; ?>" id="mah_bem<?php echo $idx; ?>"
                                        aria-invalid="<?php echo isset($field_errors['mah_bem' . $idx]) ? 'true' : 'false'; ?>"
                                        aria-describedby="<?php echo isset($field_errors['mah_bem' . $idx]) ? 'error-mah_bem' . $idx : ''; ?>">
                                    <option value="">انتخاب کنید</option>
                                    <option value="1"<?php if ($pv_bem == '1') echo ' selected="selected"'; ?>>بلی</option>
                                    <option value="2"<?php if ($pv_bem == '2') echo ' selected="selected"'; ?>>خیر</option>
                                </select>
                                <p class="agri1-error<?php echo isset($field_errors['mah_bem' . $idx]) ? '' : ' is-hidden'; ?>" id="error-mah_bem<?php echo $idx; ?>"><?php echo isset($field_errors['mah_bem' . $idx]) ? agri2_h($field_errors['mah_bem' . $idx]) : ''; ?></p>
                            </div>
                        </div>
                    </article>
                    <?php
                        $num2_t_mah--;
                        $n++;
                    }
                    ?>

                    <div class="agri1-field" id="field-traz">
                        <span class="agri1-label">تراز مساحت (هکتار)</span>
                        <div class="agri1-info" id="traz_view">—</div>
                        <input type="hidden" id="traz" value=""/>
                        <p class="agri1-hint">تراز برابر است با کل سطح منهای مجموع سطح محصولات.</p>
                        <p class="agri1-error<?php echo isset($field_errors['traz']) ? '' : ' is-hidden'; ?>" id="error-traz"><?php echo isset($field_errors['traz']) ? agri2_h($field_errors['traz']) : ''; ?></p>
                    </div>

                    <div class="agri1-actions">
                        <input type="hidden" name="no_bah" value="<?php echo agri2_h($no_bah); ?>"/>
                        <input type="hidden" name="b_time" value="<?php echo agri2_h($b_time); ?>"/>
                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                        <input type="hidden" name="m_poul" value="<?php echo agri2_h($m_poul); ?>"/>
                        <input type="hidden" name="id_ostan" value="<?php echo agri2_h($id_ostan); ?>"/>
                        <input type="hidden" name="id_city" value="<?php echo agri2_h($id_city); ?>"/>
                        <input type="hidden" name="add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
                        <input type="hidden" name="add_city" value="<?php echo agri2_h($add_city); ?>"/>
                        <input type="hidden" name="id_mar" value="<?php echo agri2_h($id_mar); ?>"/>
                        <input type="hidden" name="t_mah" value="<?php echo agri2_h($t_mah); ?>"/>
                        <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
                        <input type="hidden" name="m_ab" value="<?php echo agri2_h($m_ab); ?>"/>
                        <input type="hidden" name="mah1" value="<?php echo agri2_h($mah1); ?>"/>
                        <input type="hidden" name="mah2" value="<?php echo agri2_h($mah2); ?>"/>
                        <input type="hidden" name="mah3" value="<?php echo agri2_h($mah3); ?>"/>
                        <input type="hidden" name="t_kind" value="<?php echo agri2_h($t_kind); ?>"/>
                        <?php if ($place_ok) { ?>
                        <button type="submit" name="action" value="ثبت اطلاعات" class="agri1-btn agri1-btn-primary" id="submit">ثبت اطلاعات</button>
                        <?php } ?>
                        <button type="submit" class="agri1-btn agri1-btn-ghost" form="agri2-back" id="agri2-back-btn">بازگشت به مشخصات اولیه</button>
                    </div>
                </form>
            <?php } else { ?>
            <?php if ($has_errors) { ?>
                <div class="agri1-alert" id="agri1-error-summary" role="alert" tabindex="-1" aria-labelledby="agri1-error-title">
                    <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 9v4"></path>
                        <path d="M12 17h.01"></path>
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    </svg>
                    <div>
                        <h2 id="agri1-error-title"><?php echo isset($not_found_bah) ? 'بهره‌بردار یافت نشد' : 'لطفاً موارد زیر را تکمیل کنید'; ?></h2>
                        <?php if (isset($not_found_bah)) { ?>
                            <p>برای ثبت اطلاعات محصولات عمده صیفی، ابتدا اطلاعات بهره‌بردار را ثبت کنید.</p>
                        <?php } elseif (!empty($field_errors)) { ?>
                            <ul>
                                <?php foreach ($field_errors as $fid => $ferr) { ?>
                                    <li><a href="#field-<?php echo agri2_h($fid); ?>"><?php echo agri2_h($ferr); ?></a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <form id="agri2-form" class="agri1-form" method="post" action="Vege.php" novalidate>
                <fieldset class="agri1-fieldset<?php echo $err_m_poul ? ' is-invalid' : ''; ?>" id="field-m_poul">
                    <legend class="agri1-legend">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        موقعیت بهره‌برداری
                    </legend>
                    <p class="agri1-hint" id="hint-m_poul">محل را انتخاب کنید؛ سپس نام شهر یا آبادی را جستجو و از فهرست برگزینید.</p>
                    <div class="agri1-choices" role="radiogroup" aria-labelledby="field-m_poul" aria-describedby="hint-m_poul<?php echo $err_m_poul ? ' error-m_poul' : ''; ?>">
                        <label class="agri1-choice<?php if ($m_poul == 'shahr') echo ' is-selected'; ?>">
                            <input type="radio" class="region" name="m_poul" value="shahr"
                                <?php if ($m_poul == 'shahr') echo 'checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>شهر</span>
                        </label>
                        <label class="agri1-choice<?php if ($m_poul == 'abadi') echo ' is-selected'; ?>">
                            <input type="radio" class="region" name="m_poul" value="abadi"
                                <?php if ($m_poul == 'abadi') echo 'checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>آبادی</span>
                        </label>
                    </div>
                    <?php if ($err_m_poul) { ?>
                        <p class="agri1-error" id="error-m_poul"><?php echo agri2_h($field_errors['m_poul']); ?></p>
                    <?php } ?>

                    <div class="agri1-field shahr_wrap<?php echo $show_city ? '' : ' is-hidden'; ?>" id="field-add_city">
                        <label class="agri1-label" for="add_city_text">نام شهر</label>
                        <div class="agri1-combo">
                            <input type="text" id="add_city_text" dir="rtl" autocomplete="off"
                                   placeholder="جستجو یا انتخاب از فهرست"
                                   role="combobox" aria-expanded="false" aria-controls="city_dropdown"
                                   aria-autocomplete="list"
                                   aria-invalid="<?php echo $err_city ? 'true' : 'false'; ?>"
                                   value="<?php echo agri2_h($city_label); ?>"/>
                            <button type="button" class="agri1-combo-toggle" id="city_arrow" aria-label="نمایش فهرست شهرها" aria-controls="city_dropdown">
                                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </button>
                            <ul id="city_dropdown" class="agri1-combo-list" role="listbox" hidden></ul>
                        </div>
                        <input type="hidden" name="add_city" id="add_city_hidden" value="<?php echo agri2_h($add_city); ?>"/>
                        <p class="agri1-error<?php echo $err_city ? '' : ' is-hidden'; ?>" id="error-add_city"><?php echo $err_city ? agri2_h($field_errors['add_city']) : 'لطفاً یک شهر را از فهرست انتخاب کنید'; ?></p>
                    </div>

                    <div class="agri1-field abadi_wrap<?php echo $show_abadi ? '' : ' is-hidden'; ?>" id="field-add_abadi">
                        <label class="agri1-label" for="add_abadi_text">نام آبادی</label>
                        <div class="agri1-combo">
                            <input type="text" id="add_abadi_text" dir="rtl" autocomplete="off"
                                   placeholder="جستجو یا انتخاب از فهرست"
                                   role="combobox" aria-expanded="false" aria-controls="abadi_dropdown"
                                   aria-autocomplete="list"
                                   aria-invalid="<?php echo $err_abadi ? 'true' : 'false'; ?>"
                                   value="<?php echo agri2_h($abadi_label); ?>"/>
                            <button type="button" class="agri1-combo-toggle" id="abadi_arrow" aria-label="نمایش فهرست آبادی‌ها" aria-controls="abadi_dropdown">
                                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </button>
                            <ul id="abadi_dropdown" class="agri1-combo-list" role="listbox" hidden></ul>
                        </div>
                        <input type="hidden" name="add_abadi" id="add_abadi_hidden" value="<?php echo agri2_h($add_abadi); ?>"/>
                        <p class="agri1-error<?php echo $err_abadi ? '' : ' is-hidden'; ?>" id="error-add_abadi"><?php echo $err_abadi ? agri2_h($field_errors['add_abadi']) : 'لطفاً یک آبادی را از فهرست انتخاب کنید'; ?></p>
                    </div>
                </fieldset>

                <fieldset class="agri1-fieldset" id="field-bah_cod_m">
                    <legend class="agri1-legend">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        مشخصات بهره‌بردار
                    </legend>
                    <label class="agri1-label" for="bah_cod_m">کد ملی بهره‌بردار / مدیرعامل</label>
                    <p class="agri1-hint" id="hint-bah_cod_m">کد ملی ثبت‌شده در سامانه را وارد کنید.</p>
                    <input name="bah_cod_m" id="bah_cod_m" type="text" inputmode="numeric" maxlength="12" dir="ltr"
                           autocomplete="off"
                           value="<?php echo agri2_h($bah_cod_m); ?>"
                           aria-invalid="<?php echo $err_cod ? 'true' : 'false'; ?>"
                           aria-describedby="hint-bah_cod_m<?php echo $err_cod ? ' error-bah_cod_m' : ''; ?>"/>
                    <?php if ($err_cod) { ?>
                        <p class="agri1-error" id="error-bah_cod_m"><?php echo agri2_h($field_errors['bah_cod_m']); ?></p>
                    <?php } ?>
                </fieldset>

                <div class="agri1-grid">
                    <div class="agri1-field" style="margin-top:0" id="field-z_sal">
                        <label class="agri1-label" for="z_sal">سال زراعی</label>
                        <select name="z_sal" id="z_sal"
                                aria-invalid="<?php echo $err_z_sal ? 'true' : 'false'; ?>"
                                aria-describedby="<?php echo $err_z_sal ? 'error-z_sal' : ''; ?>">
                            <option value="">انتخاب کنید</option>
                            <option value="1405-1406"<?php if ($z_sal == '1405-1406') echo ' selected="selected"'; ?>>1405-1406</option>
                            <option value="1404-1405"<?php if ($z_sal == '1404-1405') echo ' selected="selected"'; ?>>1404-1405</option>
                        </select>
                        <?php if ($err_z_sal) { ?>
                            <p class="agri1-error" id="error-z_sal"><?php echo agri2_h($field_errors['z_sal']); ?></p>
                        <?php } ?>
                    </div>
                    <div class="agri1-field" style="margin-top:0" id="field-b_time">
                        <label class="agri1-label" for="b_time">فصل تولید</label>
                        <select name="b_time" id="b_time"
                                aria-invalid="<?php echo $err_b_time ? 'true' : 'false'; ?>"
                                aria-describedby="hint-b_time<?php echo $err_b_time ? ' error-b_time' : ''; ?>">
                            <option value="">انتخاب کنید</option>
                            <option value="1"<?php if ($b_time == '1') echo ' selected="selected"'; ?>>زمستانه/استمرار</option>
                            <option value="2"<?php if ($b_time == '2') echo ' selected="selected"'; ?>>بهاره</option>
                            <option value="3"<?php if ($b_time == '3') echo ' selected="selected"'; ?>>تابستانه</option>
                            <option value="4"<?php if ($b_time == '4') echo ' selected="selected"'; ?>>پاییزه</option>
                        </select>
                        <p class="agri1-hint" id="hint-b_time">منظور از فصل تولید، زمان برداشت محصول نهایی است.</p>
                        <?php if ($err_b_time) { ?>
                            <p class="agri1-error" id="error-b_time"><?php echo agri2_h($field_errors['b_time']); ?></p>
                        <?php } ?>
                    </div>
                </div>

                <fieldset class="agri1-fieldset<?php echo $err_mah ? ' is-invalid' : ''; ?>" id="field-mah" style="margin-top:24px">
                    <legend class="agri1-legend">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 22V8"></path>
                            <path d="M5 12s2.5-7 7-7 7 7 7 7"></path>
                            <path d="M5 22h14"></path>
                        </svg>
                        انتخاب محصول
                    </legend>
                    <p class="agri1-hint">حداقل یک محصول را انتخاب کنید.</p>
                    <div class="agri1-choices agri1-choices-3">
                        <label class="agri1-choice<?php if ($mah1 == '1') echo ' is-selected'; ?>">
                            <input type="checkbox" name="mah1" id="mah1" value="1"<?php if ($mah1 == '1') echo ' checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>گوجه فرنگی</span>
                        </label>
                        <label class="agri1-choice<?php if ($mah2 == '1') echo ' is-selected'; ?>">
                            <input type="checkbox" name="mah2" id="mah2" value="1"<?php if ($mah2 == '1') echo ' checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>پیاز</span>
                        </label>
                        <label class="agri1-choice<?php if ($mah3 == '1') echo ' is-selected'; ?>">
                            <input type="checkbox" name="mah3" id="mah3" value="1"<?php if ($mah3 == '1') echo ' checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>سیب زمینی</span>
                        </label>
                    </div>
                    <?php if ($err_mah) { ?>
                        <p class="agri1-error" id="error-mah"><?php echo agri2_h($field_errors['mah']); ?></p>
                    <?php } ?>
                    <div class="agri1-field<?php echo ($mah3 == '1') ? '' : ' is-hidden'; ?>" id="field-t_kind">
                        <label class="agri1-label" for="t_kind">تعداد ارقام سیب زمینی</label>
                        <input name="t_kind" id="t_kind" type="text" dir="ltr" inputmode="numeric" maxlength="2" value="<?php echo agri2_h($t_kind); ?>"
                               aria-invalid="<?php echo $err_t_kind ? 'true' : 'false'; ?>"
                               aria-describedby="<?php echo $err_t_kind ? 'error-t_kind' : ''; ?>"/>
                        <?php if ($err_t_kind) { ?>
                            <p class="agri1-error" id="error-t_kind"><?php echo agri2_h($field_errors['t_kind']); ?></p>
                        <?php } else { ?>
                            <p class="agri1-error is-hidden" id="error-t_kind">تعداد ارقام کشت سیب زمینی را تصحیح کنید</p>
                        <?php } ?>
                    </div>
                </fieldset>

                <div class="agri1-field" id="field-m_ab">
                    <label class="agri1-label" for="m_ab">منبع آبیاری</label>
                    <select name="m_ab" id="m_ab"
                            aria-invalid="<?php echo $err_m_ab ? 'true' : 'false'; ?>"
                            aria-describedby="<?php echo $err_m_ab ? 'error-m_ab' : ''; ?>">
                        <option value="">انتخاب کنید</option>
                        <option value="1"<?php if ($m_ab == '1') echo ' selected="selected"'; ?>>چشمه</option>
                        <option value="2"<?php if ($m_ab == '2') echo ' selected="selected"'; ?>>قنات</option>
                        <option value="3"<?php if ($m_ab == '3') echo ' selected="selected"'; ?>>رودخانه</option>
                        <option value="4"<?php if ($m_ab == '4') echo ' selected="selected"'; ?>>سد</option>
                        <option value="5"<?php if ($m_ab == '5') echo ' selected="selected"'; ?>>چاه سطحی</option>
                        <option value="6"<?php if ($m_ab == '6') echo ' selected="selected"'; ?>>چاه عمیق</option>
                        <option value="7"<?php if ($m_ab == '7') echo ' selected="selected"'; ?>>چاه نیمه عمیق</option>
                        <option value="8"<?php if ($m_ab == '8') echo ' selected="selected"'; ?>>زهکش</option>
                        <option value="9"<?php if ($m_ab == '9') echo ' selected="selected"'; ?>>پساب</option>
                        <option value="10"<?php if ($m_ab == '10') echo ' selected="selected"'; ?>>آب بندان</option>
                        <option value="11"<?php if ($m_ab == '11') echo ' selected="selected"'; ?>>سایر</option>
                    </select>
                    <?php if ($err_m_ab) { ?>
                        <p class="agri1-error" id="error-m_ab"><?php echo agri2_h($field_errors['m_ab']); ?></p>
                    <?php } ?>
                </div>

                <div class="agri1-actions">
                    <button id="sub" name="action" type="submit" class="agri1-btn agri1-btn-primary" value="ادامه">
                        ادامه
                        <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M19 12H5"></path>
                            <path d="M12 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <?php if (isset($not_found_bah)) { ?>
                        <button name="action1" type="submit" class="agri1-btn agri1-btn-accent" value="ثبت اطلاعات بهره بردار">
                            ثبت اطلاعات بهره‌بردار
                            <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M19 8v6"></path>
                                <path d="M22 11h-6"></path>
                            </svg>
                        </button>
                    <?php } ?>
                </div>

                <input type="hidden" name="m_poul" id="m_poul_hidden" value="<?php echo agri2_h($m_poul); ?>"/>
                <?php if ($no_bah != '') { ?>
                <input type="hidden" name="no_bah" value="<?php echo agri2_h($no_bah); ?>"/>
                <?php } ?>
            </form>
            <?php } ?>
        </section>

        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="index.php">
                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                </svg>
                بازگشت به صفحه قبل
            </a>
        </p>
    </main>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td height="109" style="background: url('../../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../../footer.php'); ?>
            </td>
        </tr>
    </table>

    <?php if (!$show_step2) { ?>
    <script>
        (function () {
            var cityData = <?php echo json_encode($city_data); ?>;
            var abadiData = <?php echo json_encode($abadi_data); ?>;
            var overlay = document.getElementById('agri1-overlay');
            var form = document.getElementById('agri2-form');
            var submitBtn = document.getElementById('sub');
            var summary = document.getElementById('agri1-error-summary');
            var sending = false;

            function showOverlay() {
                if (!overlay) return;
                overlay.className = 'agri1-overlay is-open';
                if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
            }

            function syncChoiceState() {
                $('.agri1-choice').each(function () {
                    var input = $(this).find('input')[0];
                    if (input && input.checked) $(this).addClass('is-selected');
                    else $(this).removeClass('is-selected');
                });
            }

            function togglePotatoKind() {
                var potato = document.getElementById('mah3');
                var wrap = document.getElementById('field-t_kind');
                if (!wrap) return;
                if (potato && potato.checked) wrap.className = 'agri1-field';
                else wrap.className = 'agri1-field is-hidden';
            }

            function findExact(data, name) {
                var text = (name || '').replace(/^\s+|\s+$/g, '');
                for (var i = 0; i < data.length; i++) {
                    if (data[i].name === text) return data[i];
                }
                return null;
            }

            function closeList(list, input) {
                list.removeClass('is-open').attr('hidden', true);
                if (input) input.attr('aria-expanded', 'false');
            }

            function renderList(list, data, filterText, onPick) {
                list.empty();
                var filtered = data;
                if (filterText) {
                    filtered = [];
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].name.indexOf(filterText) !== -1) filtered.push(data[i]);
                    }
                }
                if (filtered.length === 0) {
                    list.append('<li class="agri1-combo-empty">موردی یافت نشد</li>');
                } else {
                    for (var j = 0; j < filtered.length; j++) {
                        var item = filtered[j];
                        var li = $('<li class="agri1-combo-option" role="option"></li>');
                        li.text(item.name);
                        li.attr('data-code', item.code);
                        li.attr('data-name', item.name);
                        list.append(li);
                    }
                    list.find('.agri1-combo-option').on('mousedown', function (e) {
                        e.preventDefault();
                        onPick($(this).attr('data-code'), $(this).attr('data-name'));
                    });
                }
                list.addClass('is-open').removeAttr('hidden');
            }

            function setupCombo(opts) {
                var input = $(opts.input);
                var hidden = $(opts.hidden);
                var list = $(opts.list);
                var arrow = $(opts.arrow);
                var data = opts.data;

                function openList() {
                    renderList(list, data, input.val(), function (code, name) {
                        input.val(name);
                        hidden.val(code);
                        input.attr('aria-invalid', 'false');
                        $(opts.error).addClass('is-hidden');
                        closeList(list, input);
                    });
                    input.attr('aria-expanded', 'true');
                }

                input.on('focus click', function () { openList(); });
                input.on('input', function () {
                    var match = findExact(data, input.val());
                    hidden.val(match ? match.code : '');
                    openList();
                });
                input.on('keydown', function (e) {
                    if (e.keyCode === 27) closeList(list, input);
                });
                arrow.on('click', function (e) {
                    e.preventDefault();
                    if (list.hasClass('is-open')) closeList(list, input);
                    else {
                        input.focus();
                        openList();
                    }
                });
            }

            function showFieldError(id, show) {
                var el = document.getElementById(id);
                if (!el) return;
                if (show) el.className = 'agri1-error';
                else el.className = 'agri1-error is-hidden';
            }

            if (summary) summary.focus();

            if (form) {
                form.addEventListener('submit', function (e) {
                    var submitter = e.submitter || document.activeElement;
                    if (submitter && submitter.getAttribute('name') === 'action1') return;

                    var region = form.querySelector('input.region:checked');
                    var hiddenRegion = document.getElementById('m_poul_hidden');
                    if (region && hiddenRegion) hiddenRegion.value = region.value;

                    var selectedType = region ? region.value : (hiddenRegion ? hiddenRegion.value : '');
                    var cityCode = document.getElementById('add_city_hidden').value;
                    var abadiCode = document.getElementById('add_abadi_hidden').value;
                    var ok = true;

                    if (selectedType === 'shahr' && (!cityCode || cityCode === '')) {
                        showFieldError('error-add_city', true);
                        document.getElementById('add_city_text').setAttribute('aria-invalid', 'true');
                        ok = false;
                    }
                    if (selectedType === 'abadi' && (!abadiCode || abadiCode === '')) {
                        showFieldError('error-add_abadi', true);
                        document.getElementById('add_abadi_text').setAttribute('aria-invalid', 'true');
                        ok = false;
                    }

                    if (!ok) {
                        e.preventDefault();
                        sending = false;
                        return;
                    }

                    if (sending) {
                        e.preventDefault();
                        return;
                    }
                    sending = true;
                    showOverlay();
                });
            }

            $(document).ready(function () {
                syncChoiceState();
                togglePotatoKind();

                setupCombo({
                    input: '#add_city_text',
                    hidden: '#add_city_hidden',
                    list: '#city_dropdown',
                    arrow: '#city_arrow',
                    error: '#error-add_city',
                    data: cityData
                });
                setupCombo({
                    input: '#add_abadi_text',
                    hidden: '#add_abadi_hidden',
                    list: '#abadi_dropdown',
                    arrow: '#abadi_arrow',
                    error: '#error-add_abadi',
                    data: abadiData
                });

                $('.agri1-choice input').change(function () {
                    syncChoiceState();
                });

                $('#mah3').on('change', togglePotatoKind);

                $('input.region').change(function () {
                    $('#m_poul_hidden').val(this.value);
                    if (this.value == 'shahr') {
                        $('.shahr_wrap').removeClass('is-hidden');
                        $('.abadi_wrap').addClass('is-hidden');
                    } else if (this.value == 'abadi') {
                        $('.abadi_wrap').removeClass('is-hidden');
                        $('.shahr_wrap').addClass('is-hidden');
                    }
                });

                $(document).on('click', function (e) {
                    if (!$(e.target).closest('.agri1-combo').length) {
                        closeList($('#city_dropdown'), $('#add_city_text'));
                        closeList($('#abadi_dropdown'), $('#add_abadi_text'));
                    }
                });
            });
        })();
    </script>
    <?php } else { ?>
    <script>
        (function () {
            var overlay = document.getElementById('agri1-overlay');
            var form = document.getElementById('form1');
            var submitBtn = document.getElementById('submit');
            var summary = document.getElementById('agri2-error-summary');
            var sending = false;
            var tMah = <?php echo (int)$t_mah; ?>;

            function parseNum(v) {
                if (v == null) return null;
                v = String(v).replace(/[،,]/g, '.').replace(/^\s+|\s+$/g, '');
                if (v === '') return null;
                if (!/^-?\d+(\.\d+)?$/.test(v)) return false;
                return parseFloat(v);
            }

            function setFieldError(id, msg) {
                var el = document.getElementById(id);
                var err = document.getElementById('error-' + id);
                if (el) el.setAttribute('aria-invalid', msg ? 'true' : 'false');
                if (err) {
                    err.textContent = msg || '';
                    err.className = msg ? 'agri1-error' : 'agri1-error is-hidden';
                }
            }

            function val(id) {
                var el = document.getElementById(id);
                return el ? el.value : '';
            }

            function updateTraz() {
                var sum = 0;
                $('.mashat').each(function () {
                    var n = parseNum(this.value);
                    if (n !== null && n !== false) sum += n;
                });
                var kol = parseNum(val('m_zamin'));
                var view = document.getElementById('traz_view');
                var hidden = document.getElementById('traz');
                var def = null;
                if (kol !== null && kol !== false) def = kol - sum;
                if (hidden) hidden.value = (def === null) ? '' : def;
                if (view) view.textContent = (def === null) ? '—' : String(def);
                var msg = '';
                if (def !== null && def < 0) msg = 'مجموع سطح محصولات از کل سطح زیر کشت بیشتر است';
                setFieldError('traz', msg);
                var box = document.getElementById('field-traz');
                if (box) {
                    var info = box.querySelector('.agri1-info');
                    if (info) info.style.color = (def !== null && def < 0) ? '#DC2626' : '';
                }
            }

            function validateStep2() {
                var errors = {};
                var lng = parseNum(val('lng'));
                var lat = parseNum(val('lat'));
                var mZamin = parseNum(val('m_zamin'));

                if (lng === null) errors.lng = 'طول جغرافیایی را وارد کنید';
                else if (lng === false) errors.lng = 'طول جغرافیایی باید عدد باشد';
                else if (lng < 40 || lng > 70) errors.lng = 'طول جغرافیایی باید بین ۴۰ تا ۷۰ باشد (مثال: ۴۶٫۲۱)';

                if (lat === null) errors.lat = 'عرض جغرافیایی را وارد کنید';
                else if (lat === false) errors.lat = 'عرض جغرافیایی باید عدد باشد';
                else if (lat < 20 || lat > 45) errors.lat = 'عرض جغرافیایی باید بین ۲۰ تا ۴۵ باشد (مثال: ۳۷٫۰۱)';

                if (mZamin === null) errors.m_zamin = 'کل سطح زیر کشت را وارد کنید';
                else if (mZamin === false) errors.m_zamin = 'کل سطح زیر کشت باید عدد باشد';
                else if (mZamin <= 0) errors.m_zamin = 'کل سطح زیر کشت باید بزرگ‌تر از صفر باشد';

                var sum = 0;
                for (var i = tMah; i >= 1; i--) {
                    var masEl = document.getElementById('mashat' + i);
                    var mas = parseNum(masEl ? masEl.value : '');
                    if (mas === null) errors['mah_mas' + i] = 'سطح زیر کشت را وارد کنید';
                    else if (mas === false) errors['mah_mas' + i] = 'سطح زیر کشت باید عدد باشد';
                    else if (mas <= 0) errors['mah_mas' + i] = 'سطح زیر کشت باید بزرگ‌تر از صفر باشد';
                    else sum += mas;

                    if (!val('mah_bem' + i)) errors['mah_bem' + i] = 'وضعیت بیمه را انتخاب کنید';
                    if (!val('no_ab' + i)) errors['no_ab' + i] = 'روش آبیاری را انتخاب کنید';
                    var ra = document.getElementById('no_kesht' + i);
                    if (ra && !ra.value) errors['ra_kesh' + i] = 'روش کشت را انتخاب کنید';
                    var rag = document.getElementById('ragham' + i);
                    if (rag && rag.value === '') errors['ragham' + i] = 'نوع رقم را انتخاب کنید';
                    if (!val('sal' + i) || !val('mah' + i) || !val('roz' + i)) {
                        errors['date_ab' + i] = 'تاریخ اولین آبیاری را کامل انتخاب کنید';
                    }
                }
                if (mZamin !== null && mZamin !== false && sum > mZamin) {
                    errors.traz = 'مجموع سطح محصولات از کل سطح زیر کشت بیشتر است';
                }
                return errors;
            }

            function applyErrors(errors) {
                var ids = ['lng', 'lat', 'm_zamin', 'traz'];
                for (var i = 1; i <= tMah; i++) {
                    ids.push('mah_mas' + i, 'ragham' + i, 'ra_kesh' + i, 'no_ab' + i, 'date_ab' + i, 'mah_bem' + i);
                }
                for (var j = 0; j < ids.length; j++) {
                    var key = ids[j];
                    var elId = key;
                    if (key.indexOf('mah_mas') === 0) elId = 'mashat' + key.replace('mah_mas', '');
                    if (key.indexOf('ra_kesh') === 0) elId = 'no_kesht' + key.replace('ra_kesh', '');
                    setFieldError(elId === key ? key : elId, errors[key] || '');
                    if (elId !== key) {
                        var err = document.getElementById('error-' + key);
                        if (err) {
                            err.textContent = errors[key] || '';
                            err.className = errors[key] ? 'agri1-error' : 'agri1-error is-hidden';
                        }
                    }
                    if (key.indexOf('date_ab') === 0) {
                        var derr = document.getElementById('error-' + key);
                        if (derr) {
                            derr.textContent = errors[key] || '';
                            derr.className = errors[key] ? 'agri1-error' : 'agri1-error is-hidden';
                        }
                    }
                }
                if (summary) {
                    var title = document.getElementById('agri2-error-title');
                    var list = document.getElementById('agri2-error-list');
                    if (list) {
                        list.innerHTML = '';
                        for (var k in errors) {
                            if (!errors.hasOwnProperty(k)) continue;
                            var li = document.createElement('li');
                            var a = document.createElement('a');
                            a.href = '#field-' + k;
                            a.appendChild(document.createTextNode(errors[k]));
                            li.appendChild(a);
                            list.appendChild(li);
                        }
                    }
                    if (title) title.textContent = 'لطفاً موارد زیر را تکمیل کنید';
                    summary.className = 'agri1-alert';
                    summary.removeAttribute('hidden');
                    try { summary.focus(); } catch (e) {}
                }
            }

            $(function () {
                if (summary && !summary.hasAttribute('hidden')) {
                    try { summary.focus(); } catch (e) {}
                }
                updateTraz();
                $(document).on('input change', '.mashat, #m_zamin', updateTraz);

                if (form) {
                    form.addEventListener('submit', function (e) {
                        if (sending) {
                            e.preventDefault();
                            return;
                        }
                        var errors = validateStep2();
                        var hasErr = false;
                        for (var k in errors) {
                            if (errors.hasOwnProperty(k)) { hasErr = true; break; }
                        }
                        if (hasErr) {
                            e.preventDefault();
                            applyErrors(errors);
                            var firstId = null;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) { firstId = key; break; }
                            }
                            var first = firstId ? document.getElementById(firstId) : null;
                            if (!first && firstId && firstId.indexOf('mah_mas') === 0) {
                                first = document.getElementById('mashat' + firstId.replace('mah_mas', ''));
                            }
                            if (first && first.focus) first.focus();
                            return;
                        }
                        sending = true;
                        if (overlay) overlay.className = 'agri1-overlay is-open';
                        if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
                    });
                }
            });
        })();
    </script>
    <?php } ?>
</body>
</html>

