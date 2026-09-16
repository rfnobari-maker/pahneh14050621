<?php
include('../lock_p1.php');
include('../login/config.php');
include('../event.php');
include('../date_con.php');
require_once('../Jalali.php');

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate('Y/m/d');
$time = date('H:i:s');

function benef_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function benef_digits($v)
{
    $v = trim($v . '');
    $fa = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $en = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($fa, $en, $v);
}

function benef_post($key, $digits)
{
    if (!isset($_POST[$key])) return '';
    $v = trim($_POST[$key] . '');
    return $digits ? benef_digits($v) : $v;
}

function benef_valid_cod_m($code)
{
    if (!preg_match('/^\d{10}$/', $code)) return false;
    $check = (int) $code[9];
    $sum = 0;
    for ($i = 0; $i < 9; $i++) {
        $sum += ((int) $code[$i]) * (10 - $i);
    }
    $r = $sum % 11;
    return ($r < 2 && $check === $r) || ($r >= 2 && $check === (11 - $r));
}

function benef_csrf_token()
{
    if (empty($_SESSION['benef_csrf']) || !is_string($_SESSION['benef_csrf'])) {
        if (function_exists('random_bytes')) {
            $_SESSION['benef_csrf'] = bin2hex(random_bytes(16));
        } else {
            $_SESSION['benef_csrf'] = bin2hex(openssl_random_pseudo_bytes(16));
        }
    }
    return $_SESSION['benef_csrf'];
}

function benef_csrf_ok($token)
{
    $sess = isset($_SESSION['benef_csrf']) ? $_SESSION['benef_csrf'] : '';
    if ($sess === '' || $token === '') return false;
    if (function_exists('hash_equals')) return hash_equals($sess, $token);
    return $sess === $token;
}

function benef_load_place($dbh, $login_session, $m_bah, $add_city, $add_abadi)
{
    $out = array('ok' => false, 'row' => null);
    if ($m_bah === 'shahr' && $add_city !== '' && $add_city !== '-') {
        $stmt = $dbh->prepare('SELECT add_city, ostan, city, shahr, id_ostan, id_city, id_mar FROM list_city WHERE add_city = ? AND mor_cod_m = ?');
        $stmt->execute(array($add_city, $login_session));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $out['ok'] = true;
            $out['row'] = $row;
        }
    } elseif ($m_bah === 'abadi' && $add_abadi !== '' && $add_abadi !== '-') {
        $stmt = $dbh->prepare('SELECT add_abadi, ostan, city, abadi, id_ostan, id_city, id_mar FROM list_abadi WHERE add_abadi = ? AND mor_cod_m = ?');
        $stmt->execute(array($add_abadi, $login_session));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $out['ok'] = true;
            $out['row'] = $row;
        }
    }
    return $out;
}

function benef_count_natural($dbh, $bah_cod_m)
{
    $stmt = $dbh->prepare("SELECT id FROM bah WHERE bah_cod_m = ? AND no_bah = '1'");
    $stmt->execute(array($bah_cod_m));
    return (int) $stmt->rowCount();
}

function benef_count_sh_meli($dbh, $sh_meli)
{
    $stmt = $dbh->prepare('SELECT id FROM bah WHERE sh_meli = ?');
    $stmt->execute(array($sh_meli));
    return (int) $stmt->rowCount();
}

$csrf = benef_csrf_token();
$field_errors = array();
$mess = '';
$show_step2 = false;
$saved_ok = false;
$identity = array();
$place_row = null;
$place_label = '';

$m_bah = benef_post('m_bah', false);
$add_abadi = benef_post('add_abadi', false);
$add_city = benef_post('add_city', false);
$no_nation = benef_post('no_nation', true);
$no_bah = benef_post('no_bah', true);
$bah_cod_m = benef_post('bah_cod_m', true);
$date_t = benef_post('date_t', true);
$s_bah = benef_post('s_bah', true);
$sh_meli = benef_post('sh_meli', true);
$num_bah = benef_post('num_bah', true);

$jens = $name = $last_name = $sh_sh = $m_sod = $fname = $m_tah = $er_mtah = '';
$tel_s = $tel_m = $cod_p = $ostan_s = $shahr_s = $city_s = $rosta_s = '';
$co_name = $no_co = $co_sabt = $nation = '';
$fa_1 = $fa_2 = $fa_3 = $fa_45 = $fa_67 = $fa_8 = $fa_9 = $fa_10 = $fa_11 = $fa_12 = $fa_13 = $fa_14 = '2';

$force_step1 = (isset($_POST['benef_nav']) && $_POST['benef_nav'] === '1');
$is_save = (!$force_step1 && isset($_POST['benef_save']) && $_POST['benef_save'] === '1' && isset($_POST['action']));
$is_continue = (!$force_step1 && !$is_save && isset($_POST['action']));

if ($no_nation === '2') {
    $no_bah = '1';
}

$draft = (isset($_SESSION['benef_draft']) && is_array($_SESSION['benef_draft'])) ? $_SESSION['benef_draft'] : null;

if ($force_step1 && $draft) {
    if (isset($draft['step1']) && is_array($draft['step1'])) {
        $s1 = $draft['step1'];
        $m_bah = isset($s1['m_bah']) ? $s1['m_bah'] : $m_bah;
        $add_city = isset($s1['add_city']) ? $s1['add_city'] : $add_city;
        $add_abadi = isset($s1['add_abadi']) ? $s1['add_abadi'] : $add_abadi;
        $no_nation = isset($s1['no_nation']) ? $s1['no_nation'] : $no_nation;
        $no_bah = isset($s1['no_bah']) ? $s1['no_bah'] : $no_bah;
        $bah_cod_m = isset($s1['bah_cod_m']) ? $s1['bah_cod_m'] : $bah_cod_m;
        $date_t = isset($s1['date_t_in']) ? $s1['date_t_in'] : $date_t;
        $s_bah = isset($s1['s_bah']) ? $s1['s_bah'] : $s_bah;
        $sh_meli = isset($s1['sh_meli']) ? $s1['sh_meli'] : $sh_meli;
    }
}

if ($is_continue) {
    if (!benef_csrf_ok(benef_post('csrf', false))) {
        $field_errors['form'] = 'نشست منقضی شده است. صفحه را تازه کنید و دوباره تلاش کنید.';
    }
    if ($m_bah !== 'shahr' && $m_bah !== 'abadi') {
        $field_errors['m_bah'] = 'موقعیت بهره‌بردار را انتخاب کنید';
    }
    $place = benef_load_place($dbh, $login_session, $m_bah, $add_city, $add_abadi);
    if ($m_bah === 'shahr' && !$place['ok']) {
        $field_errors['add_city'] = 'نام شهر را از فهرست انتخاب کنید';
    }
    if ($m_bah === 'abadi' && !$place['ok']) {
        $field_errors['add_abadi'] = 'نام آبادی را از فهرست انتخاب کنید';
    }
    if ($no_nation !== '1' && $no_nation !== '2') {
        $field_errors['no_nation'] = 'ملیت بهره‌بردار را تعیین کنید';
    }
    if ($no_nation === '1' && $no_bah !== '1' && $no_bah !== '2') {
        $field_errors['no_bah'] = 'نوع بهره‌بردار را انتخاب کنید';
    }
    if ($no_nation === '2') {
        $no_bah = '1';
    }
    if ($bah_cod_m === '') {
        $field_errors['bah_cod_m'] = ($no_nation === '2') ? 'کد اختصاصی را وارد کنید' : (($no_bah === '2') ? 'کد ملی مدیرعامل را وارد کنید' : 'کد ملی را وارد کنید');
    } elseif ($no_nation === '1') {
        if (!benef_valid_cod_m($bah_cod_m)) {
            $field_errors['bah_cod_m'] = 'کد ملی باید ۱۰ رقم معتبر باشد';
        }
    } elseif (!preg_match('/^[A-Za-z0-9]{5,20}$/', $bah_cod_m)) {
        $field_errors['bah_cod_m'] = 'کد اختصاصی نامعتبر است';
    }
    if ($no_nation === '1') {
        if ($date_t === '') {
            $field_errors['date_t'] = 'تاریخ تولد را وارد کنید';
        } elseif (!preg_match('/^\d{8}$/', $date_t)) {
            $field_errors['date_t'] = 'تاریخ تولد را هشت‌رقمی وارد کنید (مثال: ۱۳۵۲۰۴۲۵)';
        }
    }
    if ($no_bah === '2') {
        if ($sh_meli === '') {
            $field_errors['sh_meli'] = 'شناسه ملی را وارد کنید';
        } elseif (!preg_match('/^\d{11}$/', $sh_meli)) {
            $field_errors['sh_meli'] = 'شناسه ملی باید ۱۱ رقمی باشد';
        }
    }
    if ($s_bah !== '1' && $s_bah !== '2' && $s_bah !== '3') {
        $field_errors['s_bah'] = 'وضعیت سکونت بهره‌بردار را انتخاب کنید';
    }

    if (empty($field_errors)) {
        $count_codm = benef_count_natural($dbh, $bah_cod_m);
        if ($no_bah === '1' && $count_codm > 0) {
            $field_errors['bah_cod_m'] = 'اطلاعات بهره‌بردار قبلاً ثبت شده است';
        } else {
            $num_bah = (string) ($count_codm + 1);
            $identity = array(
                'name' => '',
                'last_name' => '',
                'fname' => '',
                'sh_sh' => '',
                'jens' => '',
                'date_t' => '',
                'nation' => '',
                'm_sod' => '',
                'co_name' => '',
                'dead' => false
            );

            if ($no_bah === '2') {
                if (benef_count_sh_meli($dbh, $sh_meli) > 0) {
                    $field_errors['sh_meli'] = 'این شناسه ملی قبلاً ثبت شده است. ثبت مجدد مقدور نیست.';
                } else {
                    include_once('../web/ws_co3.php');
                    $data = checkNationalCode($sh_meli);
                    if (isset($data['error'])) {
                        $field_errors['sh_meli'] = 'استعلام شناسه ملی با خطا مواجه شد. دوباره تلاش کنید.';
                    } else {
                        $msg = isset($data['Result']['Message']) ? $data['Result']['Message'] : '';
                        if ($msg !== 'فراخوانی با موفقیت انجام شد') {
                            $field_errors['sh_meli'] = 'شناسه ملی وارد شده معتبر نیست.';
                        } else {
                            $identity['co_name'] = isset($data['Name']) ? $data['Name'] : '';
                        }
                    }
                }
            }

            if (empty($field_errors) && $no_nation === '1') {
                include_once('../web/ws_sabt.php');
                $result = webservice($date_t, $bah_cod_m);
                if (!is_array($result) || !isset($result['name']) || $result['name'] === '' || $result['name'] === null) {
                    $field_errors['date_t'] = 'تاریخ تولد صحیح نیست یا مشخصات یافت نشد.';
                } else {
                    $identity['name'] = $result['name'];
                    $identity['last_name'] = isset($result['family']) ? $result['family'] : '';
                    $identity['fname'] = isset($result['fatherName']) ? $result['fatherName'] : '';
                    $identity['sh_sh'] = isset($result['shenasnameNo']) ? $result['shenasnameNo'] : '';
                    if (isset($result['gender']) && (string) $result['gender'] === '1') $identity['jens'] = '1';
                    if (isset($result['gender']) && (string) $result['gender'] === '0') $identity['jens'] = '2';
                    $bd = isset($result['birthDate']) ? benef_digits($result['birthDate']) : '';
                    if (preg_match('/^\d{8}$/', $bd)) {
                        $identity['date_t'] = substr($bd, 0, 4) . '/' . substr($bd, 4, 2) . '/' . substr($bd, 6, 2);
                    } else {
                        $identity['date_t'] = $bd;
                    }
                    $identity['nation'] = 'ایرانی';
                    if (isset($result['deathStatus']) && (string) $result['deathStatus'] === '1') {
                        $field_errors['bah_cod_m'] = 'این شخص فوت شده است. ثبت مقدور نیست.';
                    }
                }
            } elseif (empty($field_errors) && $no_nation === '2') {
                include_once('../web/ws_for.php');
                $result = webservice_for($bah_cod_m);
                if (!is_array($result) || !isset($result['name']) || $result['name'] === '') {
                    $field_errors['bah_cod_m'] = 'کد اختصاصی یافت نشد.';
                } else {
                    $identity['name'] = $result['name'];
                    $identity['last_name'] = isset($result['last_name']) ? $result['last_name'] : '';
                    $identity['jens'] = isset($result['jens']) ? $result['jens'] : '';
                    $identity['fname'] = isset($result['fname']) ? $result['fname'] : '';
                    $identity['date_t'] = isset($result['date_t']) ? $result['date_t'] : '';
                    $identity['m_sod'] = isset($result['m_sod']) ? $result['m_sod'] : '';
                    $identity['nation'] = isset($result['nation']) ? $result['nation'] : '';
                    $identity['sh_sh'] = isset($result['sh_sh']) ? $result['sh_sh'] : '';
                }
            }

            if (empty($field_errors)) {
                $place_row = $place['row'];
                $_SESSION['benef_draft'] = array(
                    'at' => time(),
                    'step1' => array(
                        'm_bah' => $m_bah,
                        'add_city' => ($m_bah === 'shahr') ? $add_city : '',
                        'add_abadi' => ($m_bah === 'abadi') ? $add_abadi : '',
                        'no_nation' => $no_nation,
                        'no_bah' => $no_bah,
                        'bah_cod_m' => $bah_cod_m,
                        'date_t_in' => $date_t,
                        's_bah' => $s_bah,
                        'sh_meli' => ($no_bah === '2') ? $sh_meli : '',
                        'num_bah' => $num_bah
                    ),
                    'identity' => $identity,
                    'place' => $place_row
                );
                $show_step2 = true;
                $date_t = ($no_bah === '2') ? '' : $identity['date_t'];
                $name = $identity['name'];
                $last_name = $identity['last_name'];
                $fname = $identity['fname'];
                $sh_sh = $identity['sh_sh'];
                $jens = $identity['jens'];
                $nation = $identity['nation'];
                $m_sod = $identity['m_sod'];
                $co_name = $identity['co_name'];
            }
        }
    }
    if (!empty($field_errors)) {
        $mess = 'لطفاً موارد زیر را تکمیل کنید';
        $show_step2 = false;
    }
}

if ($is_save) {
    if (!benef_csrf_ok(benef_post('csrf', false))) {
        $field_errors['form'] = 'نشست منقضی شده است. صفحه را تازه کنید و دوباره تلاش کنید.';
        $mess = $field_errors['form'];
    } elseif (!$draft || !isset($draft['step1']) || !isset($draft['identity']) || !isset($draft['place'])) {
        $field_errors['form'] = 'اطلاعات مرحله قبل یافت نشد. مشخصات اولیه را دوباره تکمیل کنید.';
        $mess = $field_errors['form'];
    } else {
        $s1 = $draft['step1'];
        $identity = $draft['identity'];
        $place_row = $draft['place'];
        $m_bah = $s1['m_bah'];
        $add_city = $s1['add_city'];
        $add_abadi = $s1['add_abadi'];
        $no_nation = $s1['no_nation'];
        $no_bah = $s1['no_bah'];
        $bah_cod_m = $s1['bah_cod_m'];
        $s_bah = $s1['s_bah'];
        $sh_meli = $s1['sh_meli'];
        $num_bah = $s1['num_bah'];
        $name = $identity['name'];
        $last_name = $identity['last_name'];
        $fname = $identity['fname'];
        $sh_sh = $identity['sh_sh'];
        $jens = $identity['jens'];
        $nation = $identity['nation'];
        $co_name = $identity['co_name'];

        $m_tah = benef_post('m_tah', true);
        $er_mtah = benef_post('er_mtah', true);
        $tel_s = benef_post('tel_s', true);
        $tel_m = benef_post('tel_m', true);
        $cod_p = benef_post('cod_p', true);
        $ostan_s = benef_post('ostan_s', false);
        $shahr_s = benef_post('shahr_s', false);
        $city_s = benef_post('city_s', false);
        $rosta_s = benef_post('rosta_s', false);
        $no_co = benef_post('no_co', true);
        $co_sabt = benef_post('co_sabt', false);
        $m_sod = benef_post('m_sod', false);
        $date_t_post = benef_post('date_t', false);
        $fa_keys = array('fa_1', 'fa_2', 'fa_3', 'fa_45', 'fa_67', 'fa_8', 'fa_9', 'fa_10', 'fa_11', 'fa_12', 'fa_13', 'fa_14');
        foreach ($fa_keys as $fk) {
            $fv = benef_post($fk, true);
            $$fk = ($fv === '1' || $fv === '2') ? $fv : '2';
        }

        if ($no_bah === '1') {
            $date_t = $identity['date_t'];
            if ($no_nation === '2') {
                $m_sod = $identity['m_sod'];
            }
            if (!in_array($m_tah, array('1', '2', '3', '4', '5', '6', '7', '8', '9'), true)) $field_errors['m_tah'] = 'مدرک تحصیلی را انتخاب کنید';
            if ($er_mtah !== '1' && $er_mtah !== '2') $field_errors['er_mtah'] = 'مدرک مرتبط با کشاورزی را مشخص کنید';
            if ($no_nation === '1' && trim($m_sod) === '') $field_errors['m_sod'] = 'محل صدور را وارد کنید';
        } else {
            $date_t = $date_t_post;
            $co_name = $identity['co_name'];
            if (!in_array($no_co, array('1', '2', '3', '4', '5', '6', '7', '8'), true)) $field_errors['no_co'] = 'نوع شرکت/مؤسسه را انتخاب کنید';
            if (trim($co_sabt) === '') $field_errors['co_sabt'] = 'شماره ثبت را وارد کنید';
            if (trim($date_t) === '') $field_errors['date_t'] = 'تاریخ ثبت را وارد کنید';
            if (trim($m_sod) === '') $field_errors['m_sod'] = 'محل ثبت را وارد کنید';
        }

        if ($tel_m === '') {
            $field_errors['tel_m'] = 'شماره همراه را وارد کنید';
        } elseif (!preg_match('/^09\d{9}$/', $tel_m)) {
            $field_errors['tel_m'] = 'شماره همراه باید ۱۱ رقم و با ۰۹ شروع شود';
        }
        if ($tel_s === '') {
            $field_errors['tel_s'] = 'شماره تلفن ثابت را وارد کنید';
        } elseif (!preg_match('/^\d{8,11}$/', $tel_s)) {
            $field_errors['tel_s'] = 'شماره تلفن ثابت نامعتبر است';
        }
        if ($cod_p === '') {
            $field_errors['cod_p'] = 'کد پستی را وارد کنید';
        } elseif (!preg_match('/^\d{10}$/', $cod_p)) {
            $field_errors['cod_p'] = 'کد پستی باید ۱۰ رقمی باشد';
        }

        if ($s_bah === '2') {
            if (trim($ostan_s) === '') $field_errors['ostan_s'] = 'استان محل سکونت را وارد کنید';
            if (trim($shahr_s) === '') $field_errors['shahr_s'] = 'شهرستان را وارد کنید';
            if (trim($city_s) === '') $field_errors['city_s'] = 'شهر را وارد کنید';
            if (trim($rosta_s) === '') $field_errors['rosta_s'] = 'روستا را وارد کنید';
        }

        $place_check = benef_load_place($dbh, $login_session, $m_bah, $add_city, $add_abadi);
        if (!$place_check['ok']) {
            $field_errors['form'] = 'موقعیت بهره‌بردار نامعتبر است. مشخصات اولیه را اصلاح کنید.';
        } else {
            $place_row = $place_check['row'];
        }

        if ($no_bah === '1' && benef_count_natural($dbh, $bah_cod_m) > 0) {
            $field_errors['bah_cod_m'] = 'اطلاعات بهره‌بردار قبلاً ثبت شده است';
        }
        if ($no_bah === '2' && $sh_meli !== '' && benef_count_sh_meli($dbh, $sh_meli) > 0) {
            $field_errors['sh_meli'] = 'این شناسه ملی قبلاً ثبت شده است.';
        }

        if (!empty($field_errors)) {
            $mess = isset($field_errors['form']) ? $field_errors['form'] : 'لطفاً موارد زیر را تکمیل کنید';
            $show_step2 = true;
        } else {
            if ($no_bah === '1') {
                $co_name = '';
                $no_co = '';
                $sh_meli = '';
                $co_sabt = '';
            } else {
                $fname = '';
                $m_tah = '';
                $er_mtah = '';
                $jens = '';
                $sh_sh = '';
            }

            $save_add_city = $add_city;
            $save_add_abadi = $add_abadi;
            if ($s_bah === '1') {
                if ($m_bah === 'abadi' && isset($place_row['abadi'])) {
                    $ostan_s = $place_row['ostan'];
                    $shahr_s = $place_row['city'];
                    $rosta_s = $place_row['abadi'];
                    $city_s = '-';
                    $save_add_city = '';
                } elseif ($m_bah === 'shahr' && isset($place_row['shahr'])) {
                    $ostan_s = $place_row['ostan'];
                    $shahr_s = $place_row['city'];
                    $rosta_s = '-';
                    $city_s = $place_row['shahr'];
                    $save_add_abadi = '';
                }
            } else {
                if ($m_bah === 'abadi') $save_add_city = '';
                if ($m_bah === 'shahr') $save_add_abadi = '';
            }

            $date_s = $date_edit;
            $mor_cod_m = $login_session;
            $valid = '200';

            $query = "INSERT IGNORE INTO bah (date_s,mor_cod_m,no_bah,bah_cod_m,num_bah,cod_p,jens,name,last_name,date_t,sh_sh,m_sod,fname,m_tah,er_mtah,tel_s,tel_m,valid,ostan_s,shahr_s,city_s,rosta_s,co_name,no_co,sh_meli,co_sabt,fa_1,fa_2,fa_3,fa_45,fa_67,fa_8,fa_9,fa_10,fa_11,fa_12,fa_13,fa_14,add_abadi,add_city,id_city,id_mar,s_bah,id_ostan,no_nation,nation,ok)
 VALUES(:date_s,:mor_cod_m,:no_bah,:bah_cod_m,:num_bah,:cod_p,:jens,:name,:last_name,:date_t,:sh_sh,:m_sod,:fname,:m_tah,:er_mtah,:tel_s,:tel_m,:valid,:ostan_s,:shahr_s,:city_s,:rosta_s,:co_name,:no_co,:sh_meli,:co_sabt,:fa_1,:fa_2,:fa_3,:fa_45,:fa_67,:fa_8,:fa_9,:fa_10,:fa_11,:fa_12,:fa_13,:fa_14,:add_abadi,:add_city,:id_city,:id_mar,:s_bah,:id_ostan,:no_nation,:nation,:ok)";
            $q = $dbh->prepare($query);
            $q->execute(array(
                ':date_s' => $date_s,
                ':mor_cod_m' => $mor_cod_m,
                ':no_bah' => $no_bah,
                ':bah_cod_m' => $bah_cod_m,
                ':num_bah' => $num_bah,
                ':cod_p' => $cod_p,
                ':jens' => $jens,
                ':name' => $name,
                ':last_name' => $last_name,
                ':date_t' => $date_t,
                ':sh_sh' => $sh_sh,
                ':m_sod' => $m_sod,
                ':fname' => $fname,
                ':m_tah' => $m_tah,
                ':er_mtah' => $er_mtah,
                ':tel_s' => $tel_s,
                ':tel_m' => $tel_m,
                ':valid' => $valid,
                ':ostan_s' => $ostan_s,
                ':shahr_s' => $shahr_s,
                ':city_s' => $city_s,
                ':rosta_s' => $rosta_s,
                ':co_name' => $co_name,
                ':no_co' => $no_co,
                ':sh_meli' => $sh_meli,
                ':co_sabt' => $co_sabt,
                ':fa_1' => $fa_1,
                ':fa_2' => $fa_2,
                ':fa_3' => $fa_3,
                ':fa_45' => $fa_45,
                ':fa_67' => $fa_67,
                ':fa_8' => $fa_8,
                ':fa_9' => $fa_9,
                ':fa_10' => $fa_10,
                ':fa_11' => $fa_11,
                ':fa_12' => $fa_12,
                ':fa_13' => $fa_13,
                ':fa_14' => $fa_14,
                ':add_abadi' => $save_add_abadi,
                ':add_city' => $save_add_city,
                ':id_city' => $id_city,
                ':id_mar' => $id_mar,
                ':s_bah' => $s_bah,
                ':id_ostan' => $id_ostan,
                ':no_nation' => $no_nation,
                ':nation' => $nation,
                ':ok' => '1'
            ));

            sabt_event($login_session, getUserIP_1(), $date_edit, $time, $save_add_abadi, 'ثبت اطلاعات بهره بردار - ' . $bah_cod_m, $id_ostan);
            unset($_SESSION['benef_draft']);
            $saved_ok = true;
            $show_step2 = false;
            $m_bah = $add_abadi = $add_city = $no_bah = $no_nation = $bah_cod_m = $date_t = $s_bah = $sh_meli = '';
            $name = $last_name = $fname = $jens = $nation = $co_name = '';
            $draft = null;
        }
    }
}

if ($show_step2) {
    if (isset($_SESSION['benef_draft']) && is_array($_SESSION['benef_draft'])) {
        $draft = $_SESSION['benef_draft'];
        if (isset($draft['place'])) $place_row = $draft['place'];
        if (isset($draft['identity']) && is_array($draft['identity'])) $identity = $draft['identity'];
        if (isset($draft['step1']) && is_array($draft['step1'])) {
            $s1 = $draft['step1'];
            $m_bah = $s1['m_bah'];
            $add_city = $s1['add_city'];
            $add_abadi = $s1['add_abadi'];
            $no_nation = $s1['no_nation'];
            $no_bah = $s1['no_bah'];
            $bah_cod_m = $s1['bah_cod_m'];
            $s_bah = $s1['s_bah'];
            $sh_meli = $s1['sh_meli'];
            $num_bah = $s1['num_bah'];
        }
    }
    if (is_array($place_row)) {
        if ($m_bah === 'shahr' && isset($place_row['shahr'])) $place_label = $place_row['shahr'];
        elseif ($m_bah === 'abadi' && isset($place_row['abadi'])) $place_label = $place_row['abadi'];
    }
    if (!isset($identity['name'])) {
        $identity = array_merge(array(
            'name' => '', 'last_name' => '', 'fname' => '', 'sh_sh' => '',
            'jens' => '', 'date_t' => '', 'nation' => '', 'm_sod' => '', 'co_name' => ''
        ), is_array($identity) ? $identity : array());
    }
}

$city_data = array();
$abadi_data = array();
$benef_json_flags = 0;
if (defined('JSON_HEX_TAG')) $benef_json_flags |= JSON_HEX_TAG;
if (defined('JSON_HEX_AMP')) $benef_json_flags |= JSON_HEX_AMP;
if (defined('JSON_UNESCAPED_UNICODE')) $benef_json_flags |= JSON_UNESCAPED_UNICODE;
if (!$show_step2) {
    $stmt = $dbh->prepare('SELECT add_city, shahr FROM list_city WHERE mor_cod_m = :mor_cod_m');
    $stmt->execute(array(':mor_cod_m' => $login_session));
    foreach ($stmt as $row) {
        $city_data[] = array('code' => $row['add_city'], 'name' => $row['shahr']);
    }
    $stmt = $dbh->prepare('SELECT add_abadi, abadi FROM list_abadi WHERE mor_cod_m = :mor_cod_m ORDER BY BINARY abadi');
    $stmt->execute(array(':mor_cod_m' => $login_session));
    foreach ($stmt as $row) {
        $abadi_data[] = array('code' => $row['add_abadi'], 'name' => $row['abadi']);
    }
}

$city_label = '';
if ($add_city !== '') {
    foreach ($city_data as $item) {
        if ($item['code'] == $add_city) {
            $city_label = $item['name'];
            break;
        }
    }
}
$abadi_label = '';
if ($add_abadi !== '') {
    foreach ($abadi_data as $item) {
        if ($item['code'] == $add_abadi) {
            $abadi_label = $item['name'];
            break;
        }
    }
}

$show_city = ($m_bah === 'shahr');
$show_abadi = ($m_bah === 'abadi');
$has_errors = ($mess !== '' || !empty($field_errors));
$has_step2_errors = ($show_step2 && !empty($field_errors));
$page_title = (isset($title) && $title !== '') ? $title : 'ثبت بهره‌بردار جدید';

$pahneh_crumb = array(
    array('label' => 'خانه', 'href' => '../indexbenef.php'),
    array('label' => 'اطلاعات اختصاصی', 'href' => 'index.php'),
    array('label' => 'بهره‌برداران کشاورزی', 'href' => 'benefic.php'),
    array('label' => 'ثبت بهره‌بردار جدید'),
);

$fa_items = array(
    'fa_1' => 'دارای اراضی زراعی',
    'fa_2' => 'باغ و قلمستان',
    'fa_3' => 'کشت گلخانه‌ای',
    'fa_45' => 'دام سنگین',
    'fa_67' => 'دام سبک',
    'fa_8' => 'طیور سنتی',
    'fa_9' => 'طیور صنعتی',
    'fa_10' => 'زنبور عسل',
    'fa_11' => 'کرم ابریشم',
    'fa_12' => 'پرورش ماهی',
    'fa_13' => 'صنایع کشاورزی',
    'fa_14' => 'پرورش قارچ خوراکی'
);
$m_tah_opts = array(
    '1' => 'بیسواد',
    '2' => 'خواندن و نوشتن',
    '3' => 'سیکل',
    '4' => 'دیپلم',
    '5' => 'فوق دیپلم',
    '6' => 'لیسانس',
    '7' => 'فوق لیسانس',
    '8' => 'دکتری',
    '9' => 'تحصیلات حوزوی'
);
$no_co_opts = array(
    '1' => 'شرکت سهامی',
    '2' => 'شرکت با مسئولیت محدود',
    '3' => 'شرکت تضامنی',
    '4' => 'شرکت مختلط غیر سهامی',
    '5' => 'شرکت مختلط سهامی',
    '6' => 'شرکت نسبی',
    '7' => 'شرکت تعاونی',
    '8' => 'مؤسسه عمومی'
);

function benef_err_cls($errors, $key)
{
    return isset($errors[$key]) ? '' : ' is-hidden';
}
function benef_invalid($errors, $key)
{
    return isset($errors[$key]) ? 'true' : 'false';
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo benef_h($page_title); ?></title>
    <link href="../FA.css" rel="stylesheet">
    <?php if ($show_step2 && $no_bah === '2') { ?>
    <link rel="stylesheet" href="../jspc-gray.css">
    <?php } ?>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <?php if ($show_step2 && $no_bah === '2') { ?>
    <script src="../js-persian-cal.min.js"></script>
    <?php } ?>
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
            z-index: 90;
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
        .agri1-hero { margin-bottom: var(--space-3); }
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
        .agri1-steps li.is-link { padding: 0; background: transparent; }
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
        .agri1-step-btn:focus-visible { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-step-btn .agri1-step-num { background: var(--color-primary); color: var(--color-on-primary); }
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
        .agri1-card-title {
            margin: 0 0 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--color-border);
            font-size: 1rem;
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
        .agri1-success {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: var(--space-3);
            padding: var(--space-2);
            border-radius: var(--radius);
            border: 1px solid var(--color-border);
            background: #ECFDF3;
            color: var(--color-foreground);
        }
        .agri1-success p { margin: 0; }
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
            font-weight: 400;
        }
        .agri1-choice .agri1-hint { display: block; margin: 2px 0 0; }
        .agri1-choices {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .agri1-choices.is-3 { grid-template-columns: 1fr 1fr 1fr; }
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
        .agri1-choice:hover { border-color: var(--color-primary); background: #F7FEF9; }
        .agri1-choice:has(input:checked),
        .agri1-choice.is-selected {
            border-color: var(--color-primary);
            background: #ECFDF3;
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.16);
        }
        .agri1-choice:focus-within { outline: 3px solid var(--color-ring); outline-offset: 2px; }
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
        .agri1-choice:has(input:checked) .agri1-choice-mark::after,
        .agri1-choice.is-selected .agri1-choice-mark::after {
            content: "";
            position: absolute;
            inset: 3px;
            border-radius: 50%;
            background: var(--color-primary);
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
        .agri1-page .agri1-form #bah_cod_m,
        .agri1-page .agri1-form #sh_meli,
        .agri1-page .agri1-form #date_t,
        .agri1-page .agri1-form #tel_m,
        .agri1-page .agri1-form #tel_s,
        .agri1-page .agri1-form #cod_p { text-align: center; letter-spacing: 0.06em; }
        .agri1-page .agri1-form input[type="text"]:focus,
        .agri1-page .agri1-form select:focus {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
        }
        .agri1-page .agri1-form input[aria-invalid="true"],
        .agri1-page .agri1-form select[aria-invalid="true"],
        .agri1-fieldset.is-invalid .agri1-choices { border-color: var(--color-destructive); }
        .agri1-combo { position: relative; }
        .agri1-page .agri1-form .agri1-combo input[type="text"] { padding-left: 44px; text-align: right; letter-spacing: 0; }
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
        .agri1-combo-toggle:focus-visible { outline: 3px solid var(--color-ring); outline-offset: 2px; }
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
        .agri1-combo-option.is-active { background: #ECFDF3; }
        .agri1-combo-empty { padding: 12px 14px; color: var(--color-muted-foreground); }
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
        .agri1-btn:focus-visible { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-btn:active { transform: translateY(1px); }
        .agri1-btn[aria-busy="true"] { opacity: 0.85; }
        .agri1-btn-primary {
            background: var(--color-primary);
            color: var(--color-on-primary);
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25);
        }
        .agri1-btn-primary:hover { background: var(--color-secondary); }
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
        #agri1-overlay { z-index: 90; }
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
        .agri1-page .agri1-form input[readonly] { background: #FFFBEB; }
        .agri1-activity-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .agri1-activity-grid .agri1-fieldset { margin-bottom: 0; }
        @media (max-width: 640px) {
            .agri1-grid,
            .agri1-activity-grid,
            .agri1-choices,
            .agri1-choices.is-3 { grid-template-columns: 1fr; }
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
    <a class="agri1-skip" href="#<?php echo $show_step2 ? 'form1' : 'benef-form'; ?>">رفتن به فرم ثبت</a>

    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>

    <?php include(__DIR__ . '/../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri1-content"><?php echo $show_step2 ? 'ثبت اطلاعات بهره‌بردار' : 'ثبت بهره‌بردار جدید'; ?></h1>
            <ol class="agri1-steps" aria-label="مراحل ثبت">
                <?php if ($show_step2) { ?>
                <li class="is-link">
                    <button type="submit" class="agri1-step-btn" form="benef-back">
                        <span class="agri1-step-num" aria-hidden="true">1</span> مشخصات اولیه
                    </button>
                </li>
                <li class="is-current" aria-current="step"><span class="agri1-step-num" aria-hidden="true">2</span> اطلاعات بهره‌بردار</li>
                <?php } else { ?>
                <li class="is-current" aria-current="step"><span class="agri1-step-num" aria-hidden="true">1</span> مشخصات اولیه</li>
                <li><span class="agri1-step-num" aria-hidden="true">2</span> اطلاعات بهره‌بردار</li>
                <?php } ?>
            </ol>
        </header>

        <section class="agri1-card" aria-labelledby="agri1-content">
            <?php if ($saved_ok) { ?>
            <div class="agri1-success" role="status">
                <svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 6L9 17l-5-5"></path></svg>
                <p>اطلاعات بهره‌بردار با موفقیت ثبت شد (<?php echo benef_h($date_edit); ?>). می‌توانید بهره‌بردار بعدی را ثبت کنید.</p>
            </div>
            <?php } ?>

            <?php if ($show_step2) { ?>
                <form id="benef-back" method="post" action="benef.php" class="is-hidden" aria-hidden="true">
                    <input type="hidden" name="benef_nav" value="1"/>
                    <input type="hidden" name="csrf" value="<?php echo benef_h($csrf); ?>"/>
                </form>

                <div class="agri1-alert<?php echo $has_step2_errors ? '' : ' is-hidden'; ?>" id="benef-error-summary" role="alert" tabindex="-1" <?php if (!$has_step2_errors) echo 'hidden'; ?>>
                    <svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 9v4"></path><path d="M12 17h.01"></path>
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    </svg>
                    <div>
                        <h2 id="benef-error-title"><?php echo benef_h($mess !== '' ? $mess : 'لطفاً موارد زیر را تکمیل کنید'); ?></h2>
                        <ul id="benef-error-list">
                            <?php foreach ($field_errors as $fid => $ferr) { ?>
                                <li><a href="#field-<?php echo benef_h($fid); ?>"><?php echo benef_h($ferr); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <h2 class="agri1-card-title"><?php echo ($no_bah === '2') ? 'مشخصات بهره‌بردار حقوقی' : 'مشخصات بهره‌بردار حقیقی'; ?></h2>
                <div class="agri1-grid">
                    <div class="agri1-field" style="margin-top:0">
                        <span class="agri1-label">موقعیت</span>
                        <div class="agri1-info"><?php echo ($m_bah === 'shahr') ? 'شهر' : 'آبادی'; ?> — <?php echo benef_h($place_label); ?></div>
                    </div>
                    <div class="agri1-field" style="margin-top:0">
                        <span class="agri1-label"><?php echo ($no_bah === '2') ? 'کد ملی مدیرعامل' : (($no_nation === '2') ? 'کد اختصاصی' : 'کد ملی'); ?></span>
                        <div class="agri1-info" dir="ltr"><?php echo benef_h($bah_cod_m); ?></div>
                    </div>
                </div>

                <form action="benef.php" method="post" id="form1" name="form1" class="agri1-form" novalidate>
                    <input type="hidden" name="csrf" value="<?php echo benef_h($csrf); ?>"/>
                    <input type="hidden" name="benef_save" value="1"/>

                    <?php if ($no_bah === '1') { ?>
                    <div class="agri1-grid" style="margin-top:16px">
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">نام</span>
                            <div class="agri1-info"><?php echo benef_h($identity['name']); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">نام خانوادگی</span>
                            <div class="agri1-info"><?php echo benef_h($identity['last_name']); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">تاریخ تولد</span>
                            <div class="agri1-info" dir="ltr"><?php echo benef_h($identity['date_t']); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label"><?php echo ($no_nation === '1') ? 'شماره شناسنامه' : 'کد شناسایی'; ?></span>
                            <div class="agri1-info"><?php echo benef_h($identity['sh_sh']); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">نام پدر</span>
                            <div class="agri1-info"><?php echo benef_h($identity['fname']); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">جنسیت</span>
                            <div class="agri1-info"><?php echo ($identity['jens'] === '2') ? 'زن' : (($identity['jens'] === '1') ? 'مرد' : '—'); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_sod">
                            <label class="agri1-label" for="m_sod"><?php echo ($no_nation === '1') ? 'محل صدور' : 'کشور محل تولد'; ?></label>
                            <input name="m_sod" type="text" id="m_sod" maxlength="35" value="<?php echo benef_h($m_sod !== '' ? $m_sod : $identity['m_sod']); ?>"
                                   <?php if ($no_nation === '2') echo 'readonly class="agri-lock"'; ?>
                                   aria-invalid="<?php echo benef_invalid($field_errors, 'm_sod'); ?>"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'm_sod'); ?>" id="error-m_sod"><?php echo isset($field_errors['m_sod']) ? benef_h($field_errors['m_sod']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">ملیت</span>
                            <div class="agri1-info"><?php echo benef_h($identity['nation']); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_tah">
                            <label class="agri1-label" for="m_tah">مدرک تحصیلی</label>
                            <select name="m_tah" id="m_tah" aria-invalid="<?php echo benef_invalid($field_errors, 'm_tah'); ?>">
                                <option value="">انتخاب کنید</option>
                                <?php foreach ($m_tah_opts as $k => $lab) { ?>
                                <option value="<?php echo $k; ?>"<?php if ($m_tah === $k) echo ' selected="selected"'; ?>><?php echo benef_h($lab); ?></option>
                                <?php } ?>
                            </select>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'm_tah'); ?>" id="error-m_tah"><?php echo isset($field_errors['m_tah']) ? benef_h($field_errors['m_tah']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-er_mtah">
                            <label class="agri1-label" for="er_mtah">مدرک مرتبط با کشاورزی</label>
                            <select name="er_mtah" id="er_mtah" aria-invalid="<?php echo benef_invalid($field_errors, 'er_mtah'); ?>">
                                <option value="">انتخاب کنید</option>
                                <option value="1"<?php if ($er_mtah === '1') echo ' selected="selected"'; ?>>بلی</option>
                                <option value="2"<?php if ($er_mtah === '2') echo ' selected="selected"'; ?>>خیر</option>
                            </select>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'er_mtah'); ?>" id="error-er_mtah"><?php echo isset($field_errors['er_mtah']) ? benef_h($field_errors['er_mtah']) : ''; ?></p>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="agri1-grid" style="margin-top:16px">
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">عنوان شرکت/مؤسسه</span>
                            <div class="agri1-info"><?php echo benef_h($identity['co_name']); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-no_co">
                            <label class="agri1-label" for="no_co">نوع شرکت/مؤسسه</label>
                            <select name="no_co" id="no_co" aria-invalid="<?php echo benef_invalid($field_errors, 'no_co'); ?>">
                                <option value="">انتخاب کنید</option>
                                <?php foreach ($no_co_opts as $k => $lab) { ?>
                                <option value="<?php echo $k; ?>"<?php if ($no_co === $k) echo ' selected="selected"'; ?>><?php echo benef_h($lab); ?></option>
                                <?php } ?>
                            </select>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'no_co'); ?>" id="error-no_co"><?php echo isset($field_errors['no_co']) ? benef_h($field_errors['no_co']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">شناسه ملی</span>
                            <div class="agri1-info" dir="ltr"><?php echo benef_h($sh_meli); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-co_sabt">
                            <label class="agri1-label" for="co_sabt">شماره ثبت</label>
                            <input name="co_sabt" type="text" id="co_sabt" maxlength="20" value="<?php echo benef_h($co_sabt); ?>"
                                   aria-invalid="<?php echo benef_invalid($field_errors, 'co_sabt'); ?>"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'co_sabt'); ?>" id="error-co_sabt"><?php echo isset($field_errors['co_sabt']) ? benef_h($field_errors['co_sabt']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_sod">
                            <label class="agri1-label" for="m_sod">محل ثبت</label>
                            <input name="m_sod" type="text" id="m_sod" maxlength="35" value="<?php echo benef_h($m_sod); ?>"
                                   aria-invalid="<?php echo benef_invalid($field_errors, 'm_sod'); ?>"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'm_sod'); ?>" id="error-m_sod"><?php echo isset($field_errors['m_sod']) ? benef_h($field_errors['m_sod']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-date_t">
                            <label class="agri1-label" for="date_t">تاریخ ثبت</label>
                            <input name="date_t" type="text" class="pdate" id="date_t" maxlength="10" dir="rtl" value="<?php echo benef_h($date_t); ?>"
                                   aria-invalid="<?php echo benef_invalid($field_errors, 'date_t'); ?>"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'date_t'); ?>" id="error-date_t"><?php echo isset($field_errors['date_t']) ? benef_h($field_errors['date_t']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">نام مدیرعامل</span>
                            <div class="agri1-info"><?php echo benef_h($identity['name']); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">نام خانوادگی مدیرعامل</span>
                            <div class="agri1-info"><?php echo benef_h($identity['last_name']); ?></div>
                        </div>
                    </div>
                    <?php } ?>

                    <h2 class="agri1-card-title" style="margin-top:24px">تماس و نشانی</h2>
                    <div class="agri1-grid">
                        <div class="agri1-field" style="margin-top:0" id="field-tel_s">
                            <label class="agri1-label" for="tel_s">شماره تلفن ثابت</label>
                            <input name="tel_s" type="text" id="tel_s" dir="ltr" inputmode="numeric" maxlength="11" value="<?php echo benef_h($tel_s); ?>"
                                   aria-invalid="<?php echo benef_invalid($field_errors, 'tel_s'); ?>"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'tel_s'); ?>" id="error-tel_s"><?php echo isset($field_errors['tel_s']) ? benef_h($field_errors['tel_s']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-tel_m">
                            <label class="agri1-label" for="tel_m">شماره همراه</label>
                            <p class="agri1-hint" id="hint-tel_m">یازده رقم، با ۰۹ شروع شود.</p>
                            <input name="tel_m" type="text" id="tel_m" dir="ltr" inputmode="numeric" maxlength="11" value="<?php echo benef_h($tel_m); ?>"
                                   aria-invalid="<?php echo benef_invalid($field_errors, 'tel_m'); ?>"
                                   aria-describedby="hint-tel_m error-tel_m"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'tel_m'); ?>" id="error-tel_m"><?php echo isset($field_errors['tel_m']) ? benef_h($field_errors['tel_m']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-cod_p">
                            <label class="agri1-label" for="cod_p">کد پستی</label>
                            <input name="cod_p" type="text" id="cod_p" dir="ltr" inputmode="numeric" maxlength="10" value="<?php echo benef_h($cod_p); ?>"
                                   aria-invalid="<?php echo benef_invalid($field_errors, 'cod_p'); ?>"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'cod_p'); ?>" id="error-cod_p"><?php echo isset($field_errors['cod_p']) ? benef_h($field_errors['cod_p']) : ''; ?></p>
                        </div>
                    </div>

                    <?php if ($s_bah === '2') { ?>
                    <p class="agri1-note" style="margin-top:16px"><?php echo ($no_bah === '2') ? 'نشانی شرکت را وارد کنید.' : 'محل سکونت غیرساکن را وارد کنید.'; ?></p>
                    <div class="agri1-grid">
                        <div class="agri1-field" style="margin-top:0" id="field-ostan_s">
                            <label class="agri1-label" for="ostan_s">استان</label>
                            <input name="ostan_s" type="text" id="ostan_s" maxlength="50" value="<?php echo benef_h($ostan_s); ?>"
                                   aria-invalid="<?php echo benef_invalid($field_errors, 'ostan_s'); ?>"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'ostan_s'); ?>" id="error-ostan_s"><?php echo isset($field_errors['ostan_s']) ? benef_h($field_errors['ostan_s']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-shahr_s">
                            <label class="agri1-label" for="shahr_s">شهرستان</label>
                            <input name="shahr_s" type="text" id="shahr_s" maxlength="50" value="<?php echo benef_h($shahr_s); ?>"
                                   aria-invalid="<?php echo benef_invalid($field_errors, 'shahr_s'); ?>"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'shahr_s'); ?>" id="error-shahr_s"><?php echo isset($field_errors['shahr_s']) ? benef_h($field_errors['shahr_s']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-city_s">
                            <label class="agri1-label" for="city_s">شهر</label>
                            <input name="city_s" type="text" id="city_s" maxlength="50" value="<?php echo benef_h($city_s); ?>"
                                   aria-invalid="<?php echo benef_invalid($field_errors, 'city_s'); ?>"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'city_s'); ?>" id="error-city_s"><?php echo isset($field_errors['city_s']) ? benef_h($field_errors['city_s']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-rosta_s">
                            <label class="agri1-label" for="rosta_s">روستا</label>
                            <input name="rosta_s" type="text" id="rosta_s" maxlength="50" value="<?php echo benef_h($rosta_s); ?>"
                                   aria-invalid="<?php echo benef_invalid($field_errors, 'rosta_s'); ?>"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'rosta_s'); ?>" id="error-rosta_s"><?php echo isset($field_errors['rosta_s']) ? benef_h($field_errors['rosta_s']) : ''; ?></p>
                        </div>
                    </div>
                    <?php } ?>

                    <h2 class="agri1-card-title" style="margin-top:24px">زمینه فعالیت کشاورزی</h2>
                    <p class="agri1-hint">برای هر مورد بلی یا خیر را مشخص کنید. پیش‌فرض «خیر» است.</p>
                    <div class="agri1-activity-grid">
                        <?php foreach ($fa_items as $fk => $flab) {
                            $cur = isset($$fk) ? $$fk : '2';
                        ?>
                        <fieldset class="agri1-fieldset">
                            <legend class="agri1-legend"><?php echo benef_h($flab); ?></legend>
                            <div class="agri1-choices" role="radiogroup">
                                <label class="agri1-choice<?php if ($cur === '1') echo ' is-selected'; ?>">
                                    <input type="radio" name="<?php echo $fk; ?>" value="1"<?php if ($cur === '1') echo ' checked="checked"'; ?>/>
                                    <span class="agri1-choice-mark" aria-hidden="true"></span>
                                    <span>بلی</span>
                                </label>
                                <label class="agri1-choice<?php if ($cur !== '1') echo ' is-selected'; ?>">
                                    <input type="radio" name="<?php echo $fk; ?>" value="2"<?php if ($cur !== '1') echo ' checked="checked"'; ?>/>
                                    <span class="agri1-choice-mark" aria-hidden="true"></span>
                                    <span>خیر</span>
                                </label>
                            </div>
                        </fieldset>
                        <?php } ?>
                    </div>

                    <div class="agri1-actions">
                        <button type="submit" name="action" value="ثبت و ادامه" class="agri1-btn agri1-btn-primary" id="submit">ثبت و ادامه</button>
                        <button type="submit" class="agri1-btn agri1-btn-ghost" form="benef-back">بازگشت به مشخصات اولیه</button>
                    </div>
                </form>
            <?php } else { ?>
                <?php if ($has_errors) { ?>
                <div class="agri1-alert" id="agri1-error-summary" role="alert" tabindex="-1">
                    <svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 9v4"></path><path d="M12 17h.01"></path>
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    </svg>
                    <div>
                        <h2 id="agri1-error-title"><?php echo benef_h($mess !== '' ? $mess : 'لطفاً موارد زیر را تکمیل کنید'); ?></h2>
                        <ul>
                            <?php foreach ($field_errors as $fid => $ferr) { ?>
                                <li><a href="#field-<?php echo benef_h($fid); ?>"><?php echo benef_h($ferr); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php } ?>

                <form id="benef-form" class="agri1-form" method="post" action="benef.php" novalidate>
                    <input type="hidden" name="csrf" value="<?php echo benef_h($csrf); ?>"/>

                    <fieldset class="agri1-fieldset<?php echo isset($field_errors['m_bah']) ? ' is-invalid' : ''; ?>" id="field-m_bah">
                        <legend class="agri1-legend">
                            <svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            موقعیت بهره‌بردار
                        </legend>
                        <p class="agri1-hint" id="hint-m_bah">محل را انتخاب کنید؛ سپس نام شهر یا آبادی را جستجو و از فهرست برگزینید.</p>
                        <div class="agri1-choices" role="radiogroup" aria-describedby="hint-m_bah">
                            <label class="agri1-choice<?php if ($m_bah === 'shahr') echo ' is-selected'; ?>">
                                <input type="radio" class="region" name="m_bah" value="shahr"<?php if ($m_bah === 'shahr') echo ' checked="checked"'; ?>/>
                                <span class="agri1-choice-mark" aria-hidden="true"></span>
                                <span>شهر</span>
                            </label>
                            <label class="agri1-choice<?php if ($m_bah === 'abadi') echo ' is-selected'; ?>">
                                <input type="radio" class="region" name="m_bah" value="abadi"<?php if ($m_bah === 'abadi') echo ' checked="checked"'; ?>/>
                                <span class="agri1-choice-mark" aria-hidden="true"></span>
                                <span>آبادی</span>
                            </label>
                        </div>
                        <p class="agri1-error<?php echo benef_err_cls($field_errors, 'm_bah'); ?>" id="error-m_bah"><?php echo isset($field_errors['m_bah']) ? benef_h($field_errors['m_bah']) : ''; ?></p>

                        <div class="agri1-field shahr_wrap<?php echo $show_city ? '' : ' is-hidden'; ?>" id="field-add_city">
                            <label class="agri1-label" for="add_city_text">نام شهر</label>
                            <div class="agri1-combo">
                                <input type="text" id="add_city_text" dir="rtl" autocomplete="off" placeholder="جستجو یا انتخاب از فهرست"
                                       role="combobox" aria-expanded="false" aria-controls="city_dropdown" aria-autocomplete="list"
                                       aria-invalid="<?php echo benef_invalid($field_errors, 'add_city'); ?>"
                                       value="<?php echo benef_h($city_label); ?>"/>
                                <button type="button" class="agri1-combo-toggle" id="city_arrow" aria-label="نمایش فهرست شهرها" aria-controls="city_dropdown">
                                    <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>
                                </button>
                                <ul id="city_dropdown" class="agri1-combo-list" role="listbox" hidden></ul>
                            </div>
                            <input type="hidden" name="add_city" id="add_city_hidden" value="<?php echo benef_h($add_city); ?>"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'add_city'); ?>" id="error-add_city"><?php echo isset($field_errors['add_city']) ? benef_h($field_errors['add_city']) : 'لطفاً یک شهر را از فهرست انتخاب کنید'; ?></p>
                        </div>

                        <div class="agri1-field abadi_wrap<?php echo $show_abadi ? '' : ' is-hidden'; ?>" id="field-add_abadi">
                            <label class="agri1-label" for="add_abadi_text">نام آبادی</label>
                            <div class="agri1-combo">
                                <input type="text" id="add_abadi_text" dir="rtl" autocomplete="off" placeholder="جستجو یا انتخاب از فهرست"
                                       role="combobox" aria-expanded="false" aria-controls="abadi_dropdown" aria-autocomplete="list"
                                       aria-invalid="<?php echo benef_invalid($field_errors, 'add_abadi'); ?>"
                                       value="<?php echo benef_h($abadi_label); ?>"/>
                                <button type="button" class="agri1-combo-toggle" id="abadi_arrow" aria-label="نمایش فهرست آبادی‌ها" aria-controls="abadi_dropdown">
                                    <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>
                                </button>
                                <ul id="abadi_dropdown" class="agri1-combo-list" role="listbox" hidden></ul>
                            </div>
                            <input type="hidden" name="add_abadi" id="add_abadi_hidden" value="<?php echo benef_h($add_abadi); ?>"/>
                            <p class="agri1-error<?php echo benef_err_cls($field_errors, 'add_abadi'); ?>" id="error-add_abadi"><?php echo isset($field_errors['add_abadi']) ? benef_h($field_errors['add_abadi']) : 'لطفاً یک آبادی را از فهرست انتخاب کنید'; ?></p>
                        </div>
                    </fieldset>

                    <fieldset class="agri1-fieldset<?php echo isset($field_errors['no_nation']) ? ' is-invalid' : ''; ?>" id="field-no_nation">
                        <legend class="agri1-legend">
                            <svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"></circle><path d="M3 12h18"></path><path d="M12 3a14 14 0 0 1 0 18"></path></svg>
                            ملیت بهره‌بردار
                        </legend>
                        <div class="agri1-choices" role="radiogroup">
                            <label class="agri1-choice<?php if ($no_nation === '1') echo ' is-selected'; ?>">
                                <input type="radio" name="no_nation" value="1"<?php if ($no_nation === '1') echo ' checked="checked"'; ?>/>
                                <span class="agri1-choice-mark" aria-hidden="true"></span>
                                <span>ایرانی</span>
                            </label>
                            <label class="agri1-choice<?php if ($no_nation === '2') echo ' is-selected'; ?>">
                                <input type="radio" name="no_nation" value="2"<?php if ($no_nation === '2') echo ' checked="checked"'; ?>/>
                                <span class="agri1-choice-mark" aria-hidden="true"></span>
                                <span>تبعه خارجی</span>
                            </label>
                        </div>
                        <p class="agri1-error<?php echo benef_err_cls($field_errors, 'no_nation'); ?>" id="error-no_nation"><?php echo isset($field_errors['no_nation']) ? benef_h($field_errors['no_nation']) : ''; ?></p>
                    </fieldset>

                    <fieldset class="agri1-fieldset wrap-no_bah<?php echo ($no_nation === '2') ? ' is-hidden' : ''; ?><?php echo isset($field_errors['no_bah']) ? ' is-invalid' : ''; ?>" id="field-no_bah">
                        <legend class="agri1-legend">
                            <svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            نوع بهره‌بردار
                        </legend>
                        <div class="agri1-choices" role="radiogroup">
                            <label class="agri1-choice<?php if ($no_bah === '1' || $no_bah === '') echo ' is-selected'; ?>">
                                <input type="radio" name="no_bah" value="1"<?php if ($no_bah === '1' || $no_bah === '') echo ' checked="checked"'; ?>/>
                                <span class="agri1-choice-mark" aria-hidden="true"></span>
                                <span>حقیقی</span>
                            </label>
                            <label class="agri1-choice<?php if ($no_bah === '2') echo ' is-selected'; ?>">
                                <input type="radio" name="no_bah" value="2"<?php if ($no_bah === '2') echo ' checked="checked"'; ?>/>
                                <span class="agri1-choice-mark" aria-hidden="true"></span>
                                <span>حقوقی</span>
                            </label>
                        </div>
                        <p class="agri1-error<?php echo benef_err_cls($field_errors, 'no_bah'); ?>" id="error-no_bah"><?php echo isset($field_errors['no_bah']) ? benef_h($field_errors['no_bah']) : ''; ?></p>
                    </fieldset>

                    <div class="agri1-field" id="field-bah_cod_m">
                        <label class="agri1-label" for="bah_cod_m" id="label-bah_cod_m">
                            <?php
                            if ($no_nation === '2') echo 'کد اختصاصی';
                            elseif ($no_bah === '2') echo 'کد ملی مدیرعامل';
                            else echo 'کد ملی بهره‌بردار';
                            ?>
                        </label>
                        <p class="agri1-hint" id="hint-bah_cod_m">برای تبعه ایرانی ده رقم؛ ارقام فارسی هم پذیرفته می‌شود.</p>
                        <input name="bah_cod_m" id="bah_cod_m" type="text" inputmode="numeric" maxlength="20" dir="ltr" autocomplete="off"
                               value="<?php echo benef_h($bah_cod_m); ?>"
                               aria-invalid="<?php echo benef_invalid($field_errors, 'bah_cod_m'); ?>"
                               aria-describedby="hint-bah_cod_m error-bah_cod_m"/>
                        <p class="agri1-error<?php echo benef_err_cls($field_errors, 'bah_cod_m'); ?>" id="error-bah_cod_m"><?php echo isset($field_errors['bah_cod_m']) ? benef_h($field_errors['bah_cod_m']) : ''; ?></p>
                    </div>

                    <div class="agri1-field wrap-sh_meli<?php echo ($no_bah === '2') ? '' : ' is-hidden'; ?>" id="field-sh_meli">
                        <label class="agri1-label" for="sh_meli">شناسه ملی شرکت</label>
                        <p class="agri1-hint" id="hint-sh_meli">یازده رقم.</p>
                        <input name="sh_meli" id="sh_meli" type="text" inputmode="numeric" maxlength="11" dir="ltr" autocomplete="off"
                               value="<?php echo benef_h($sh_meli); ?>"
                               aria-invalid="<?php echo benef_invalid($field_errors, 'sh_meli'); ?>"/>
                        <p class="agri1-error<?php echo benef_err_cls($field_errors, 'sh_meli'); ?>" id="error-sh_meli"><?php echo isset($field_errors['sh_meli']) ? benef_h($field_errors['sh_meli']) : ''; ?></p>
                    </div>

                    <div class="agri1-field wrap-date_t<?php echo ($no_nation === '2') ? ' is-hidden' : ''; ?>" id="field-date_t">
                        <label class="agri1-label" for="date_t">تاریخ تولد</label>
                        <p class="agri1-hint" id="hint-date_t">هشت رقم شمسی بدون جداکننده — مثال: ۱۳۵۲۰۴۲۵</p>
                        <input name="date_t" id="date_t" type="text" inputmode="numeric" maxlength="8" dir="ltr" autocomplete="off"
                               value="<?php echo benef_h($date_t); ?>"
                               aria-invalid="<?php echo benef_invalid($field_errors, 'date_t'); ?>"
                               aria-describedby="hint-date_t error-date_t"/>
                        <p class="agri1-error<?php echo benef_err_cls($field_errors, 'date_t'); ?>" id="error-date_t"><?php echo isset($field_errors['date_t']) ? benef_h($field_errors['date_t']) : ''; ?></p>
                    </div>

                    <fieldset class="agri1-fieldset<?php echo isset($field_errors['s_bah']) ? ' is-invalid' : ''; ?>" id="field-s_bah">
                        <legend class="agri1-legend">وضعیت سکونت</legend>
                        <div class="agri1-choices is-3" role="radiogroup">
                            <label class="agri1-choice<?php if ($s_bah === '1') echo ' is-selected'; ?>">
                                <input type="radio" name="s_bah" value="1"<?php if ($s_bah === '1') echo ' checked="checked"'; ?>/>
                                <span class="agri1-choice-mark" aria-hidden="true"></span>
                                <span>ساکن<span class="agri1-hint">حداقل شش ماه در سال</span></span>
                            </label>
                            <label class="agri1-choice<?php if ($s_bah === '2') echo ' is-selected'; ?>">
                                <input type="radio" name="s_bah" value="2"<?php if ($s_bah === '2') echo ' checked="checked"'; ?>/>
                                <span class="agri1-choice-mark" aria-hidden="true"></span>
                                <span>غیرساکن<span class="agri1-hint">کمتر از شش ماه در سال</span></span>
                            </label>
                            <label class="agri1-choice<?php if ($s_bah === '3') echo ' is-selected'; ?>">
                                <input type="radio" name="s_bah" value="3"<?php if ($s_bah === '3') echo ' checked="checked"'; ?>/>
                                <span class="agri1-choice-mark" aria-hidden="true"></span>
                                <span>عشایر</span>
                            </label>
                        </div>
                        <p class="agri1-error<?php echo benef_err_cls($field_errors, 's_bah'); ?>" id="error-s_bah"><?php echo isset($field_errors['s_bah']) ? benef_h($field_errors['s_bah']) : ''; ?></p>
                    </fieldset>

                    <div class="agri1-actions">
                        <button type="submit" name="action" value="ادامه" class="agri1-btn agri1-btn-primary" id="sub">ادامه</button>
                    </div>
                </form>
            <?php } ?>
        </section>

        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="benefic.php">
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
            <td height="109" style="background: url('../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../footer.php'); ?>
            </td>
        </tr>
    </table>

<?php if (!$show_step2) { ?>
    <script>
        (function () {
            var cityData = <?php echo json_encode($city_data, $benef_json_flags); ?>;
            var abadiData = <?php echo json_encode($abadi_data, $benef_json_flags); ?>;
            var overlay = document.getElementById('agri1-overlay');
            var form = document.getElementById('benef-form');
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
                    var input = $(this).find('input[type=radio]')[0];
                    if (input && input.checked) $(this).addClass('is-selected');
                    else $(this).removeClass('is-selected');
                });
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
                    else { input.focus(); openList(); }
                });
            }
            function showFieldError(id, show) {
                var el = document.getElementById(id);
                if (!el) return;
                el.className = show ? 'agri1-error' : 'agri1-error is-hidden';
            }
            function updateDependent() {
                var nation = $('input[name=no_nation]:checked').val();
                var type = $('input[name=no_bah]:checked').val() || '1';
                if (nation === '2') {
                    $('.wrap-no_bah').addClass('is-hidden');
                    $('.wrap-date_t').addClass('is-hidden');
                    $('.wrap-sh_meli').addClass('is-hidden');
                    $('#label-bah_cod_m').text('کد اختصاصی');
                } else {
                    $('.wrap-no_bah').removeClass('is-hidden');
                    $('.wrap-date_t').removeClass('is-hidden');
                    if (type === '2') {
                        $('.wrap-sh_meli').removeClass('is-hidden');
                        $('#label-bah_cod_m').text('کد ملی مدیرعامل');
                    } else {
                        $('.wrap-sh_meli').addClass('is-hidden');
                        $('#label-bah_cod_m').text('کد ملی بهره‌بردار');
                    }
                }
            }
            if (summary) {
                try { summary.focus(); } catch (e) {}
            }
            if (form) {
                form.addEventListener('submit', function (e) {
                    var region = form.querySelector('input.region:checked');
                    var selectedType = region ? region.value : '';
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
                setupCombo({
                    input: '#add_city_text', hidden: '#add_city_hidden', list: '#city_dropdown',
                    arrow: '#city_arrow', error: '#error-add_city', data: cityData
                });
                setupCombo({
                    input: '#add_abadi_text', hidden: '#add_abadi_hidden', list: '#abadi_dropdown',
                    arrow: '#abadi_arrow', error: '#error-add_abadi', data: abadiData
                });
                $('.agri1-choice input[type=radio]').change(function () { syncChoiceState(); });
                $('input.region').change(function () {
                    if (this.value === 'shahr') {
                        $('.shahr_wrap').removeClass('is-hidden');
                        $('.abadi_wrap').addClass('is-hidden');
                    } else if (this.value === 'abadi') {
                        $('.abadi_wrap').removeClass('is-hidden');
                        $('.shahr_wrap').addClass('is-hidden');
                    }
                });
                $('input[name=no_nation], input[name=no_bah]').change(updateDependent);
                updateDependent();
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
            var summary = document.getElementById('benef-error-summary');
            var sending = false;
            var telChecked = <?php echo ($no_nation === '2') ? 'true' : 'false'; ?>;
            var needTelCheck = <?php echo ($no_nation === '2') ? 'false' : 'true'; ?>;

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
                return el ? String(el.value).replace(/^\s+|\s+$/g, '') : '';
            }
            function digits(v) {
                return String(v || '').replace(/[۰-۹]/g, function (d) {
                    return String('۰۱۲۳۴۵۶۷۸۹'.indexOf(d));
                }).replace(/[٠-٩]/g, function (d) {
                    return String('٠١٢٣٤٥٦٧٨٩'.indexOf(d));
                });
            }
            function validateStep2() {
                var errors = {};
                if (document.getElementById('m_tah') && !val('m_tah')) errors.m_tah = 'مدرک تحصیلی را انتخاب کنید';
                if (document.getElementById('er_mtah') && !val('er_mtah')) errors.er_mtah = 'مدرک مرتبط با کشاورزی را مشخص کنید';
                if (document.getElementById('m_sod') && !document.getElementById('m_sod').readOnly && !val('m_sod')) {
                    errors.m_sod = document.getElementById('no_co') ? 'محل ثبت را وارد کنید' : 'محل صدور را وارد کنید';
                }
                if (document.getElementById('no_co') && !val('no_co')) errors.no_co = 'نوع شرکت/مؤسسه را انتخاب کنید';
                if (document.getElementById('co_sabt') && !val('co_sabt')) errors.co_sabt = 'شماره ثبت را وارد کنید';
                if (document.getElementById('no_co') && document.getElementById('date_t') && !val('date_t')) errors.date_t = 'تاریخ ثبت را وارد کنید';
                var telM = digits(val('tel_m'));
                if (!telM) errors.tel_m = 'شماره همراه را وارد کنید';
                else if (!/^09\d{9}$/.test(telM)) errors.tel_m = 'شماره همراه باید ۱۱ رقم و با ۰۹ شروع شود';
                var telS = digits(val('tel_s'));
                if (!telS) errors.tel_s = 'شماره تلفن ثابت را وارد کنید';
                else if (!/^\d{8,11}$/.test(telS)) errors.tel_s = 'شماره تلفن ثابت نامعتبر است';
                var codP = digits(val('cod_p'));
                if (!codP) errors.cod_p = 'کد پستی را وارد کنید';
                else if (!/^\d{10}$/.test(codP)) errors.cod_p = 'کد پستی باید ۱۰ رقمی باشد';
                if (document.getElementById('ostan_s') && !val('ostan_s')) errors.ostan_s = 'استان را وارد کنید';
                if (document.getElementById('shahr_s') && !val('shahr_s')) errors.shahr_s = 'شهرستان را وارد کنید';
                if (document.getElementById('city_s') && !val('city_s')) errors.city_s = 'شهر را وارد کنید';
                if (document.getElementById('rosta_s') && !val('rosta_s')) errors.rosta_s = 'روستا را وارد کنید';
                return errors;
            }
            function applyErrors(errors) {
                var ids = ['m_tah', 'er_mtah', 'm_sod', 'no_co', 'co_sabt', 'date_t', 'tel_m', 'tel_s', 'cod_p', 'ostan_s', 'shahr_s', 'city_s', 'rosta_s'];
                for (var i = 0; i < ids.length; i++) setFieldError(ids[i], errors[ids[i]] || '');
                if (summary) {
                    var title = document.getElementById('benef-error-title');
                    var list = document.getElementById('benef-error-list');
                    if (list) {
                        list.innerHTML = '';
                        for (var key in errors) {
                            if (!errors.hasOwnProperty(key)) continue;
                            var li = document.createElement('li');
                            var a = document.createElement('a');
                            a.href = '#field-' + key;
                            a.appendChild(document.createTextNode(errors[key]));
                            li.appendChild(a);
                            list.appendChild(li);
                        }
                    }
                    if (title) title.textContent = 'لطفاً موارد زیر را تکمیل کنید';
                    summary.className = 'agri1-alert';
                    summary.removeAttribute('hidden');
                    try { summary.focus(); } catch (e2) {}
                }
            }
            function checkTel(cb) {
                if (!needTelCheck) { if (cb) cb(true); return; }
                var tel_m = digits(val('tel_m'));
                var bah = <?php echo json_encode($bah_cod_m); ?>;
                $.ajax({
                    type: 'POST',
                    url: 'tel_m_valid.php',
                    data: { tel_m: tel_m, bah_cod_m: bah },
                    success: function (response) {
                        var t = (response || '').toString().replace(/^\s+|\s+$/g, '');
                        if (t === 'success') {
                            telChecked = true;
                            setFieldError('tel_m', '');
                            if (cb) cb(true);
                        } else {
                            telChecked = false;
                            setFieldError('tel_m', 'عدم مطابقت شماره همراه و کد ملی. شماره همراه را تصحیح کنید.');
                            if (cb) cb(false);
                        }
                    },
                    error: function () {
                        telChecked = false;
                        setFieldError('tel_m', 'خطایی در ارتباط با سرور رخ داد. دوباره تلاش کنید.');
                        if (cb) cb(false);
                    }
                });
            }
            $(function () {
                if (summary && !summary.hasAttribute('hidden')) {
                    try { summary.focus(); } catch (e) {}
                }
                $('.agri1-choice input[type=radio]').change(function () {
                    var box = $(this).closest('.agri1-choices');
                    box.find('.agri1-choice').removeClass('is-selected');
                    if (this.checked) $(this).closest('.agri1-choice').addClass('is-selected');
                });
                $('#tel_m').on('blur', function () {
                    var telM = digits(val('tel_m'));
                    if (/^09\d{9}$/.test(telM)) checkTel();
                });
                if (typeof AMIB !== 'undefined' && document.getElementById('date_t') && document.getElementById('no_co')) {
                    new AMIB.persianCalendar('date_t');
                }
                if (form) {
                    form.addEventListener('submit', function (e) {
                        var submitter = e.submitter || document.activeElement;
                        if (submitter && submitter.getAttribute('form') === 'benef-back') return;
                        if (sending) { e.preventDefault(); return; }
                        var errors = validateStep2();
                        var hasErr = false;
                        for (var k in errors) { if (errors.hasOwnProperty(k)) { hasErr = true; break; } }
                        if (hasErr) {
                            e.preventDefault();
                            applyErrors(errors);
                            return;
                        }
                        if (needTelCheck && !telChecked) {
                            e.preventDefault();
                            checkTel(function (ok) {
                                if (!ok) {
                                    applyErrors({ tel_m: document.getElementById('error-tel_m').textContent || 'لطفاً شماره همراه را بررسی کنید.' });
                                    return;
                                }
                                sending = true;
                                if (overlay) overlay.className = 'agri1-overlay is-open';
                                if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
                                form.submit();
                            });
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
