<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');
include('../../login/config.php');

function agri2_h($v)
{
    if (!isset($v)) {
        return '';
    }
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri2_post($key, $default)
{
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}

function aquatic_load_place($dbh, $add_abadi, $add_city)
{
    $out = array(
        'ok' => false,
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'id_ostan' => '',
        'id_city' => '',
        'id_mar' => ''
    );
    if ($add_abadi != '' && $add_abadi != '-') {
        $stmt = $dbh->prepare("SELECT add_abadi, id_ostan, id_city, id_mar FROM list_abadi WHERE add_abadi = :add_abadi");
        $stmt->execute(array(':add_abadi' => $add_abadi));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $out['ok'] = true;
            $out['add_abadi'] = $row['add_abadi'];
            $out['add_city'] = '-';
            $out['id_ostan'] = $row['id_ostan'];
            $out['id_city'] = $row['id_city'];
            $out['id_mar'] = $row['id_mar'];
            return $out;
        }
    }
    if ($add_city != '' && $add_city != '-') {
        $stmt = $dbh->prepare("SELECT add_city, id_ostan, id_city, id_mar FROM list_city WHERE add_city = :add_city");
        $stmt->execute(array(':add_city' => $add_city));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
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

function aquatic_fa_label($no_fa)
{
    if ($no_fa == '1') return 'تکثیر';
    if ($no_fa == '2') return 'پرورش';
    if ($no_fa == '3') return 'تکثیر و پرورش';
    return '';
}

function aquatic_mal_label($no_mal)
{
    $map = array(
        '1' => 'سند ششدانگ',
        '2' => 'سند مشاعی',
        '3' => 'اصلاحات اراضی',
        '4' => 'موقوفه',
        '5' => 'واگذاری',
        '6' => 'قولنامه',
        '7' => 'اجاره',
        '8' => 'سایر'
    );
    return isset($map[$no_mal]) ? $map[$no_mal] : '';
}

function aquatic_save_malek($dbh, $date_s, $mor_cod_m, $m_cod_m, $m_addres, $m_jens, $m_name, $m_last_name, $m_fname, $m_tel_m)
{
    $stmt = $dbh->prepare("SELECT id FROM malek WHERE m_cod_m = :m_cod_m");
    $stmt->execute(array(':m_cod_m' => $m_cod_m));
    if ($stmt->rowCount() == 0) {
        $q = $dbh->prepare("INSERT INTO malek (date_s,mor_cod_m,m_cod_m,m_addres,m_jens,m_name,m_last_name,m_fname,m_tel_m) VALUES(:date_s,:mor_cod_m,:m_cod_m,:m_addres,:m_jens,:m_name,:m_last_name,:m_fname,:m_tel_m)");
        $q->execute(array(
            ':date_s' => $date_s,
            ':mor_cod_m' => $mor_cod_m,
            ':m_cod_m' => $m_cod_m,
            ':m_addres' => $m_addres,
            ':m_jens' => $m_jens,
            ':m_name' => $m_name,
            ':m_last_name' => $m_last_name,
            ':m_fname' => $m_fname,
            ':m_tel_m' => $m_tel_m
        ));
    } else {
        $q = $dbh->prepare("UPDATE malek SET date_s=?,mor_cod_m=?,m_cod_m=?,m_addres=?,m_jens=?,m_name=?,m_last_name=?,m_fname=?,m_tel_m=? WHERE m_cod_m=?");
        $q->execute(array($date_s, $mor_cod_m, $m_cod_m, $m_addres, $m_jens, $m_name, $m_last_name, $m_fname, $m_tel_m, $m_cod_m));
    }
}

function aquatic_tak_rows()
{
    return array(
        1 => array('ماهیان گرمابی', 'هزار قطعه'),
        2 => array('ماهیان دریایی در استخرهای خاکی', 'هزار قطعه'),
        3 => array('ماهیان خاویاری', 'هزار قطعه'),
        4 => array('ماهیان سردآبی (قزل آلا)', 'هزار قطعه'),
        5 => array('منابع آبی طبیعی و نیمه طبیعی', 'هزار قطعه'),
        6 => array('میگو آب شیرین', 'هزار قطعه'),
        7 => array('میگو آب شور', 'هزار قطعه'),
        8 => array('شاه میگو', 'هزار قطعه'),
        9 => array('ماهیان زینتی', 'هزار قطعه'),
        10 => array('صدف', 'هزار قطعه')
    );
}

function aquatic_par_rows()
{
    return array(
        1 => array('پرورش ماهی تیلاپیا', 'تن'),
        2 => array('پرورش ماهی در دریا (قفس)', 'تن'),
        3 => array('پرورش ماهیان خاویاری', 'تن'),
        4 => array('پرورش ماهیان دریایی در استخرهای خاکی', 'تن'),
        5 => array('پرورش ماهیان سردآبی', 'تن'),
        6 => array('پرورش ماهیان گرمابی', 'تن'),
        7 => array('پرورش میگو آب شیرین', 'تن'),
        8 => array('پرورش میگو آب شور', 'تن'),
        9 => array('پرورش شاه میگو', 'تن'),
        10 => array('پرورش در منابع آبی طبیعی و نیمه طبیعی', 'تن'),
        11 => array('ماهیان زینتی', 'هزارقطعه'),
        12 => array('زالوی طبی', 'هزار عدد'),
        13 => array('گیاهان آبزی', 'هزار شاخه'),
        14 => array('کروکودیل', 'سر'),
        15 => array('صدف', 'تن'),
        16 => array('جلبک (وزن تر)', 'تن'),
        17 => array('سیست و بیومس آرتمیا', 'تن')
    );
}

$page_title = (isset($title) && $title !== '') ? $title : 'ثبت مزرعه تکثیر و پرورش آبزیان';
$pahneh_crumb_title = 'ثبت مزرعه تکثیر و پرورش آبزیان';

if (isset($_POST['bah_cod_m'])) {
    $bah_cod_m = $_POST['bah_cod_m'];
    $query = "SELECT ok FROM bah WHERE bah_cod_m = :bah_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $ok = ($row && isset($row['ok'])) ? $row['ok'] : '';
    if ($ok == '2') {
        alert('بهره بردار در قید حیات نمیباشد !! امکان ثبت اطلاعات مقدور نیست  ');
        echo '<form name="myform" class="myform" method="post" action="index.php"></form>';
        echo '<script type="text/javascript">document.myform.submit();</script>';
        exit;
    }
    if ($ok == '4') {
        alert('اطلاعات بهره بردار از طرف ثبت احوال تایید نشد !! امکان ثبت اطلاعات مقدور نمیباشد  ');
        echo '<form name="myform" class="myform" method="post" action="index.php"></form>';
        echo '<script type="text/javascript">document.myform.submit();</script>';
        exit;
    }
}

if (isset($_POST['action'])) {
    $date_s = $date_edit;
    $mor_cod_m = $login_session;
    $bah_cod_m = agri2_post('bah_cod_m', '');
    $add_city = agri2_post('add_city', '');
    $add_abadi = agri2_post('add_abadi', '');
    $id_ostan = agri2_post('id_ostan', '');
    $id_city = agri2_post('id_city', '');
    $id_mar = agri2_post('id_mar', '');
    $no_fa = agri2_post('no_fa', '');
    $m_zamin = agri2_post('m_zamin', '');
    $no_mal = agri2_post('no_mal', '');
    $lng = agri2_post('lng', '');
    $lat = agri2_post('lat', '');
    if ($lng > 99) $lng = 0;
    if ($lat > 99) $lat = 0;
    $m_cod_m = agri2_post('m_cod_m', '');
    $num_bah = agri2_post('num_bah', '');
    if ($no_mal <> '7') $m_cod_m = $bah_cod_m;
    $m_vaz_sok = agri2_post('m_vaz_sok', '');
    $g_tol = agri2_post('g_tol', '');
    $pt_no = agri2_post('pt_no', '');
    $pt_date = agri2_post('pt_date', '');
    $pb_no = agri2_post('pb_no', '');
    $pb_date = agri2_post('pb_date', '');
    $m_ab = agri2_post('m_ab', '');
    $unit_name = agri2_post('unit_name', '');
    $sal = agri2_post('sal', '');
    $t_mah = agri2_post('t_mah', '');
    $m_addres = agri2_post('m_addres', '');
    $m_jens = agri2_post('m_jens', '');
    $m_name = agri2_post('m_name', '');
    $m_last_name = agri2_post('m_last_name', '');
    $m_fname = agri2_post('m_fname', '');
    $m_tel_m = agri2_post('m_tel_m', '');

    $tak1 = $tak2 = $tak3 = $tak4 = $tak5 = $tak6 = $tak7 = $tak8 = $tak9 = $tak10 = 0;
    $par1 = $par2 = $par3 = $par4 = $par5 = $par6 = $par7 = $par8 = $par9 = $par10 = $par11 = $par12 = $par13 = $par14 = $par15 = $par16 = $par17 = 0;
    if ($no_fa == '1' || $no_fa == '3') {
        for ($i = 1; $i <= 10; $i++) {
            ${'tak' . $i} = agri2_post('tak' . $i, null);
        }
    }
    if ($no_fa == '2' || $no_fa == '3') {
        for ($i = 1; $i <= 17; $i++) {
            ${'par' . $i} = agri2_post('par' . $i, null);
        }
    }

    $place = aquatic_load_place($dbh, $add_abadi, $add_city);
    if ($place['ok']) {
        $add_abadi = $place['add_abadi'];
        $add_city = $place['add_city'];
        $id_ostan = $place['id_ostan'];
        $id_city = $place['id_city'];
        $id_mar = $place['id_mar'];
    }

    $tak_columns = array();
    $tak_placeholders = array();
    for ($i = 1; $i <= 10; $i++) {
        $tak_columns[] = 'tak' . $i;
        $tak_placeholders[] = ':tak' . $i;
    }
    $par_columns = array();
    $par_placeholders = array();
    for ($i = 1; $i <= 17; $i++) {
        $par_columns[] = 'par' . $i;
        $par_placeholders[] = ':par' . $i;
    }
    $base_columns = "date_s,mor_cod_m,bah_cod_m,num_bah,id_ostan,id_city,id_mar,add_abadi,add_city,m_zamin,no_mal,lng,lat,m_cod_m,m_vaz_sok,no_fa,g_tol,pt_no,pt_date,pb_no,pb_date,m_ab,unit_name,sal";
    $base_placeholders = ":date_s,:mor_cod_m,:bah_cod_m,:num_bah,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:m_zamin,:no_mal,:lng,:lat,:m_cod_m,:m_vaz_sok,:no_fa,:g_tol,:pt_no,:pt_date,:pb_no,:pb_date,:m_ab,:unit_name,:sal";
    $query = "INSERT INTO Aquatic2 (" . $base_columns . "," . implode(',', $tak_columns) . "," . implode(',', $par_columns) . ") VALUES(" . $base_placeholders . "," . implode(',', $tak_placeholders) . "," . implode(',', $par_placeholders) . ")";
    $params = array(
        ':date_s' => $date_s,
        ':mor_cod_m' => $mor_cod_m,
        ':bah_cod_m' => $bah_cod_m,
        ':num_bah' => $num_bah,
        ':id_ostan' => $id_ostan,
        ':id_city' => $id_city,
        ':id_mar' => $id_mar,
        ':add_abadi' => $add_abadi,
        ':add_city' => $add_city,
        ':m_zamin' => $m_zamin,
        ':no_mal' => $no_mal,
        ':lng' => $lng,
        ':lat' => $lat,
        ':m_cod_m' => $m_cod_m,
        ':m_vaz_sok' => $m_vaz_sok,
        ':no_fa' => $no_fa,
        ':g_tol' => $g_tol,
        ':pt_no' => $pt_no,
        ':pt_date' => $pt_date,
        ':pb_no' => $pb_no,
        ':pb_date' => $pb_date,
        ':m_ab' => $m_ab,
        ':unit_name' => $unit_name,
        ':sal' => $sal
    );
    for ($i = 1; $i <= 10; $i++) {
        $params[':tak' . $i] = ${'tak' . $i};
    }
    for ($i = 1; $i <= 17; $i++) {
        $params[':par' . $i] = ${'par' . $i};
    }
    $q = $dbh->prepare($query);
    $q->execute($params);
    aquatic_save_malek($dbh, $date_s, $mor_cod_m, $m_cod_m, $m_addres, $m_jens, $m_name, $m_last_name, $m_fname, $m_tel_m);
    sabt_event($login_session, getUserIP_1(), $date_edit, $time, $add_abadi, 'ثبت اطلاعات تکثیر و پرورش آبزیان - ' . $bah_cod_m);
    unset($date_s, $mor_cod_m, $bah_cod_m, $num_bah, $id_ostan, $id_city, $id_mar, $add_abadi, $add_city, $m_zamin, $no_mal, $lng, $lat, $m_cod_m, $m_vaz_sok, $no_fa, $g_tol, $pt_no, $pt_date, $pb_no, $pb_date, $m_ab, $unit_name, $sal, $tak1, $tak2, $tak3, $tak4, $tak5, $par1, $par2, $par3, $par4);
    alert('اطلاعات مزرعه  تکثیر  و پرورش آبزیان  با موفقیت ثبت شد ');
    echo '<form name="myform" class="myform" method="post" action="index.php"></form>';
    echo '<script type="text/javascript">document.myform.submit();</script>';
    exit;
}

if (!isset($_POST['bah_cod_m'])) {
    echo '<form name="myform" class="myform" method="post" action="Aquatic.php"></form>';
    echo '<script type="text/javascript">document.myform.submit();</script>';
    exit;
}

$date_s = date_con(jdate("Y/m/d"));
$add_abadi = agri2_post('add_abadi', '');
$add_city = agri2_post('add_city', '');
$bah_cod_m = agri2_post('bah_cod_m', '');
$m_poul = agri2_post('m_poul', '');
$no_mal = agri2_post('no_mal', '');
$no_fa = agri2_post('no_fa', '');
$nah_kesh = agri2_post('nah_kesh', '');
$lng = agri2_post('lng', '');
$lat = agri2_post('lat', '');
$m_zamin = agri2_post('m_zamin', '');
$m_ab = agri2_post('m_ab', '');
$g_tol = agri2_post('g_tol', '');
$pt_no = agri2_post('pt_no', '');
$pt_date = agri2_post('pt_date', '');
$pb_no = agri2_post('pb_no', '');
$pb_date = agri2_post('pb_date', '');
$unit_name = agri2_post('unit_name', '');
$sal = agri2_post('sal', '1404');
if ($sal === '') $sal = '1404';
$m_vaz_sok = agri2_post('m_vaz_sok', '');
$m_addres = agri2_post('m_addres', '');
$m_cod_m = agri2_post('m_cod_m', '');
$m_name = agri2_post('m_name', '');
$m_last_name = agri2_post('m_last_name', '');
$m_fname = agri2_post('m_fname', '');
$m_tel_m = agri2_post('m_tel_m', '');
$m_jens = agri2_post('m_jens', '');
$num_bah = agri2_post('num_bah', '');
$no_bah = '';
$co_name = '';
for ($i = 1; $i <= 10; $i++) {
    ${'tak' . $i} = agri2_post('tak' . $i, '');
}
for ($i = 1; $i <= 17; $i++) {
    ${'par' . $i} = agri2_post('par' . $i, '');
}

$query = "SELECT num_bah,no_bah,co_name,fname,name,jens,last_name,tel_m FROM bah WHERE bah_cod_m = :bah_cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m' => $bah_cod_m));
$bah = $stmt->fetch(PDO::FETCH_ASSOC);
if ($bah) {
    $no_bah = $bah['no_bah'];
    if ($num_bah === '') $num_bah = $bah['num_bah'];
    $co_name = $bah['co_name'];
}
if ($num_bah === '') $num_bah = '1';

if ($no_mal <> 7 && $bah) {
    if ($no_bah == '2') {
        $m_fname = '-';
    } else {
        $m_fname = $bah['fname'];
    }
    $m_name = $bah['name'];
    $m_jens = $bah['jens'];
    $m_last_name = $bah['last_name'];
    $m_fname = $bah['fname'];
    if (!isset($_POST['num_bah'])) $num_bah = '1';
    $m_tel_m = $bah['tel_m'];
}

$v_no_fa = aquatic_fa_label($no_fa);
$v_no_mal = aquatic_mal_label($no_mal);
if ($no_mal <> '7') $m_cod_m = $bah_cod_m;

$id_ostan = '';
$id_city = '';
$id_mar = '';
if ($m_poul == 'abadi') {
    $place = aquatic_load_place($dbh, $add_abadi, '');
} elseif ($m_poul == 'shahr') {
    $place = aquatic_load_place($dbh, '', $add_city);
} else {
    $place = aquatic_load_place($dbh, $add_abadi, $add_city);
}
if ($place['ok']) {
    $add_abadi = $place['add_abadi'];
    $add_city = $place['add_city'];
    $id_ostan = $place['id_ostan'];
    $id_city = $place['id_city'];
    $id_mar = $place['id_mar'];
}

$lock_owner = ((string) $no_mal !== '7');
$show_land = ((string) $nah_kesh !== '3');
$fname_label = ($no_bah == 2 || $no_bah == '2') ? 'نام شرکت' : 'نام پدر';
$fname_value = ($no_bah == 2 || $no_bah == '2') ? $co_name : $m_fname;
$lock_attr = $lock_owner ? ' readonly="readonly"' : '';
$lock_class = $lock_owner ? ' agri-lock' : '';
$ab_opts = array('1' => 'رودخانه', '2' => 'چاه', '3' => 'چشمه و قنات', '4' => 'آبن بندان', '5' => 'خور و دریا', '6' => 'دریاچه', '7' => 'سایر منابع');
$tol_opts = array('1' => 'مجتمع', '2' => 'منفرد', '3' => 'مدار بسته', '4' => 'دو منظوره', '5' => 'شالیزار', '6' => 'قفس', '7' => 'پن', '8' => 'آب بندان', '9' => 'منابع آبی', '10' => 'سایر موارد');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo agri2_h($page_title); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../jspc-gray.css"/>
    <script type="text/javascript" src="../js-persian-cal.min.js"></script>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <style>
        :root {
            --color-primary: #15803D; --color-on-primary: #FFFFFF; --color-secondary: #166534;
            --color-accent: #A16207; --color-on-accent: #FFFFFF; --color-background: #F0FDF4;
            --color-foreground: #14532D; --color-card: #FFFFFF; --color-card-foreground: #14532D;
            --color-muted: #E8F0F1; --color-muted-foreground: #475569; --color-border: #86C9A0;
            --color-destructive: #DC2626; --color-ring: #15803D; --color-warning-bg: #FEF2F2;
            --space-1: 8px; --space-2: 16px; --space-3: 24px; --space-4: 32px;
            --radius: 12px; --duration: 200ms; --shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
            --touch: 44px; --font: myfont, Tahoma, "Segoe UI", sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-padding-top: 96px; -webkit-text-size-adjust: 100%; text-size-adjust: 100%; }
        body.agri1-body { margin: 0; background: var(--color-background); color: var(--color-foreground); font-family: var(--font); font-size: 16px; line-height: 1.6; }
        .agri1-skip { position: absolute; right: -999px; top: 8px; z-index: 90; background: var(--color-primary); color: var(--color-on-primary); padding: 8px 16px; border-radius: 8px; }
        .agri1-skip:focus { right: 8px; }
        .agri1-main { width: min(920px, 100%); margin: 0 auto; padding: var(--space-3) var(--space-2) var(--space-4); }
        .agri1-title { margin: 0 0 var(--space-2); color: var(--color-foreground); font-size: clamp(1.35rem, 2.4vw, 1.85rem); line-height: 1.4; }
        .agri1-card { background: var(--color-card); border: 1px solid var(--color-border); border-radius: 16px; box-shadow: var(--shadow); padding: var(--space-3); margin-bottom: var(--space-3); }
        .agri1-card-title { margin: 0 0 14px; padding-bottom: 8px; border-bottom: 1px solid var(--color-border); font-size: 1rem; }
        .agri1-alert { display: flex; gap: 12px; margin-bottom: var(--space-3); padding: var(--space-2); border-radius: var(--radius); border: 1px solid #FECACA; background: var(--color-warning-bg); color: #991B1B; }
        .agri1-alert h2 { margin: 0 0 8px; font-size: 1rem; }
        .agri1-alert a { color: #991B1B; }
        .agri1-icon { flex: 0 0 auto; width: 24px; height: 24px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .agri1-hint { margin: 6px 0 0; color: var(--color-muted-foreground); font-size: 0.875rem; }
        .agri1-note { margin: 0 0 12px; padding: 12px 14px; border-radius: 10px; background: #EFF6FF; border: 1px solid #BFDBFE; color: #1D4ED8; }
        .agri1-field { margin-top: 12px; }
        .agri1-label { display: block; margin-bottom: 6px; font-weight: 700; }
        .agri1-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .agri1-info { min-height: var(--touch); padding: 10px 12px; border-radius: 10px; background: var(--color-muted); color: var(--color-foreground); }
        .agri1-page .agri1-form input[type="text"],
        .agri1-page .agri1-form select,
        .agri1-page .agri1-form textarea {
            width: 100%; min-height: var(--touch); padding: 10px 12px; border: 1px solid #64748B; border-radius: 10px;
            background: var(--color-card); color: var(--color-foreground); font-size: 16px; font-family: inherit;
        }
        .agri1-page .agri1-form textarea { min-height: 96px; resize: vertical; }
        .agri1-page .agri1-form select {
            appearance: none; -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2314532D' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: left 10px center; padding-left: 32px;
        }
        .agri1-page .agri1-form input[type="text"]:focus,
        .agri1-page .agri1-form select:focus,
        .agri1-page .agri1-form textarea:focus { border-color: var(--color-ring); box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25); outline: none; }
        .agri1-page .agri1-form input[aria-invalid="true"],
        .agri1-page .agri1-form select[aria-invalid="true"],
        .agri1-page .agri1-form textarea[aria-invalid="true"] { border-color: var(--color-destructive); }
        .agri1-page .agri1-form input.agri-lock,
        .agri1-page .agri1-form input[readonly] { background: #FFFBEB; }
        .agri1-select { position: relative; width: 100%; }
        .agri1-select.is-enhanced > select { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0; }
        .agri1-select-btn { display: flex; align-items: center; justify-content: space-between; gap: 8px; width: 100%; min-height: var(--touch); padding: 6px 12px; border: 1px solid #64748B; border-radius: 10px; background: var(--color-card); color: var(--color-foreground); font-size: 16px; font-family: inherit; text-align: right; cursor: pointer; }
        .agri1-select-btn:focus-visible, .agri1-select.is-open .agri1-select-btn { outline: none; border-color: var(--color-ring); box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25); }
        .agri1-select-label { flex: 1; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .agri1-select-list { display: none; position: absolute; top: calc(100% + 4px); right: 0; left: 0; z-index: 40; max-height: 240px; overflow-y: auto; margin: 0; padding: 6px 0; list-style: none; background: var(--color-card); border: 1px solid var(--color-border); border-radius: 10px; box-shadow: var(--shadow); direction: rtl; }
        .agri1-select.is-open .agri1-select-list { display: block; }
        .agri1-select-option { min-height: 36px; padding: 8px 14px; cursor: pointer; }
        .agri1-select-option:hover, .agri1-select-option.is-active, .agri1-select-option.is-selected { background: #ECFDF3; }
        .agri1-error { margin: 8px 0 0; color: var(--color-destructive); font-size: 0.875rem; }
        .is-hidden { display: none !important; }
        .agri1-actions { display: flex; justify-content: center; flex-wrap: wrap; gap: 12px; margin-top: var(--space-2); }
        .agri1-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: var(--touch); padding: 10px 20px; border: 0; border-radius: 12px; cursor: pointer; font-size: 16px; font-weight: 700; font-family: inherit; text-decoration: none; }
        .agri1-btn:focus-visible { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-btn[aria-busy="true"] { opacity: 0.85; }
        .agri1-btn-primary { background: var(--color-primary); color: var(--color-on-primary); box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25); }
        .agri1-btn-primary:hover { background: var(--color-secondary); }
        .agri1-btn-ghost { background: transparent; color: var(--color-foreground); border: 1px solid var(--color-border); }
        .agri1-btn-ghost:hover { background: var(--color-muted); }
        .agri1-back { margin-top: var(--space-3); }
        .agri1-overlay { display: none; position: fixed; inset: 0; z-index: 90; align-items: center; justify-content: center; background: rgba(15, 23, 42, 0.55); }
        .agri1-overlay.is-open { display: flex !important; }
        .agri1-overlay-panel { display: flex; flex-direction: column; align-items: center; gap: 12px; min-width: 220px; padding: 24px; border-radius: 16px; background: var(--color-card); }
        .agri1-spinner { width: 40px; height: 40px; border: 3px solid var(--color-border); border-top-color: var(--color-primary); border-radius: 50%; animation: agri1-spin 0.8s linear infinite; }
        @keyframes agri1-spin { to { transform: rotate(360deg); } }
        .agri1-prod-table { width: 100%; border-collapse: collapse; }
        .agri1-prod-table th, .agri1-prod-table td { border: 1px solid var(--color-border); padding: 8px 10px; text-align: right; }
        .agri1-prod-table th { background: #ECFDF3; color: var(--color-foreground); font-size: 0.9rem; }
        .agri1-prod-table td.agri1-unit { color: var(--color-muted-foreground); font-size: 0.875rem; width: 22%; }
        .agri1-prod-table td.agri1-amt { width: 28%; }
        @media (max-width: 640px) { .agri1-grid { grid-template-columns: 1fr; } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; } }
    </style>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#form1">رفتن به فرم ثبت</a>
    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>
    <?php include(__DIR__ . '/../../chrome.php'); ?>
    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title">ثبت مزرعه تکثیر و پرورش آبزیان جدید</h1>
        </header>
        <?php sar_data2($bah_cod_m, $num_bah); ?>
        <form action="" method="post" id="form1" name="form1" class="agri1-form" novalidate>
            <div class="agri1-alert is-hidden" id="agri1-error-summary" role="alert" tabindex="-1">
                <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 9v4"></path><path d="M12 17h.01"></path><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path></svg>
                <div>
                    <h2>لطفاً موارد زیر را تکمیل کنید</h2>
                    <ul id="agri1-error-list"></ul>
                </div>
            </div>
            <section class="agri1-card">
                <h2 class="agri1-card-title">موقعیت بهره برداری</h2>
                <div class="agri1-grid">
                    <div class="agri1-field" style="margin-top:0">
                        <span class="agri1-label">استان</span>
                        <div class="agri1-info"><?php echo ostan_name($id_ostan); ?></div>
                    </div>
                    <div class="agri1-field" style="margin-top:0">
                        <span class="agri1-label">شهرستان</span>
                        <div class="agri1-info"><?php echo city_name1($id_city, $id_ostan); ?></div>
                    </div>
                    <div class="agri1-field">
                        <span class="agri1-label">مرکز جهاد کشاورزی</span>
                        <div class="agri1-info"><?php echo mar_name($id_mar); ?></div>
                    </div>
                    <div class="agri1-field">
                        <span class="agri1-label">آبادی / شهر</span>
                        <div class="agri1-info"><?php echo abadi_name($add_abadi); ?></div>
                    </div>
                    <div class="agri1-field">
                        <span class="agri1-label">نوع فعالیت</span>
                        <div class="agri1-info"><?php echo agri2_h($v_no_fa); ?></div>
                    </div>
                    <div class="agri1-field">
                        <span class="agri1-label">نوع مالکیت</span>
                        <div class="agri1-info"><?php echo agri2_h($v_no_mal); ?></div>
                    </div>
                </div>
            </section>
<?php if ($show_land) { ?>
            <section class="agri1-card">
                <h2 class="agri1-card-title">اطلاعات زمین</h2>
                <div class="agri1-grid">
                    <div class="agri1-field" style="margin-top:0" id="field-lng">
                        <label class="agri1-label" for="lng">X طول جغرافیایی</label>
                        <input name="lng" type="text" id="lng" dir="ltr" inputmode="decimal" maxlength="11" value="<?php echo agri2_h($lng); ?>"/>
                        <p class="agri1-hint">مثال: 46.212486</p>
                        <p class="agri1-error is-hidden" id="error-lng"></p>
                    </div>
                    <div class="agri1-field" style="margin-top:0" id="field-lat">
                        <label class="agri1-label" for="lat">Y عرض جغرافیایی</label>
                        <input name="lat" type="text" id="lat" dir="ltr" inputmode="decimal" maxlength="11" value="<?php echo agri2_h($lat); ?>"/>
                        <p class="agri1-hint">مثال: 37.010521</p>
                        <p class="agri1-error is-hidden" id="error-lat"></p>
                    </div>
                    <div class="agri1-field" id="field-m_zamin">
                        <label class="agri1-label" for="m_zamin">مساحت مفید (مترمربع)</label>
                        <input name="m_zamin" type="text" id="m_zamin" dir="ltr" inputmode="decimal" maxlength="70" value="<?php echo agri2_h($m_zamin); ?>"/>
                        <p class="agri1-error is-hidden" id="error-m_zamin"></p>
                    </div>
                </div>
            </section>
            <section class="agri1-card">
                <h2 class="agri1-card-title">اطلاعات مالک</h2>
                <?php if ($lock_owner) { ?><p class="agri1-note">اطلاعات بهره بردار به عنوان مالک ثبت خواهد شد</p><?php } ?>
                <div class="agri1-grid">
                    <div class="agri1-field" style="margin-top:0" id="field-m_cod_m">
                        <label class="agri1-label" for="m_cod_m">کد ملی مالک</label>
                        <input name="m_cod_m" type="text" class="Mcod_m<?php echo $lock_class; ?>" id="m_cod_m" dir="ltr" inputmode="numeric" maxlength="10" value="<?php echo agri2_h($m_cod_m); ?>"<?php echo $lock_attr; ?>/>
                        <p class="agri1-error is-hidden" id="error-m_cod_m"></p>
                    </div>
                    <div class="agri1-field" style="margin-top:0" id="field-m_jens">
                        <label class="agri1-label" for="m_jens">جنسیت</label>
                        <select name="m_jens" class="mar" id="m_jens">
                            <option value="1"<?php if ((string) $m_jens === '1') echo ' selected="selected"'; ?>>مرد</option>
                            <option value="2"<?php if ((string) $m_jens === '2') echo ' selected="selected"'; ?>>زن</option>
                        </select>
                        <p class="agri1-error is-hidden" id="error-m_jens"></p>
                    </div>
                    <div class="agri1-field" id="field-m_name">
                        <label class="agri1-label" for="m_name">نام</label>
                        <input name="m_name" type="text" class="<?php echo trim($lock_class); ?>" id="m_name" maxlength="75" value="<?php echo agri2_h($m_name); ?>"<?php echo $lock_attr; ?>/>
                        <p class="agri1-error is-hidden" id="error-m_name"></p>
                    </div>
                    <div class="agri1-field" id="field-m_last_name">
                        <label class="agri1-label" for="m_last_name">نام خانوادگی</label>
                        <input name="m_last_name" type="text" class="<?php echo trim($lock_class); ?>" id="m_last_name" maxlength="70" value="<?php echo agri2_h($m_last_name); ?>"<?php echo $lock_attr; ?>/>
                        <p class="agri1-error is-hidden" id="error-m_last_name"></p>
                    </div>
                    <div class="agri1-field" id="field-m_fname">
                        <label class="agri1-label" for="m_fname"><?php echo agri2_h($fname_label); ?></label>
                        <input name="m_fname" type="text" class="<?php echo trim($lock_class); ?>" id="m_fname" maxlength="100" value="<?php echo agri2_h($fname_value); ?>"<?php echo $lock_attr; ?>/>
                        <p class="agri1-error is-hidden" id="error-m_fname"></p>
                    </div>
                    <div class="agri1-field" id="field-m_tel_m">
                        <label class="agri1-label" for="m_tel_m">تلفن همراه</label>
                        <input name="m_tel_m" type="text" class="<?php echo trim($lock_class); ?>" id="m_tel_m" dir="ltr" inputmode="numeric" maxlength="11" value="<?php echo agri2_h($m_tel_m); ?>"<?php echo $lock_attr; ?>/>
                        <p class="agri1-error is-hidden" id="error-m_tel_m"></p>
                    </div>
                    <div class="agri1-field" id="field-m_vaz_sok">
                        <label class="agri1-label" for="m_vaz_sok">وضعیت سکونت</label>
                        <select name="m_vaz_sok" id="m_vaz_sok">
                            <option value="">انتخاب کنید</option>
                            <option value="1"<?php if ($m_vaz_sok == '1') echo ' selected="selected"'; ?>>ساکن</option>
                            <option value="2"<?php if ($m_vaz_sok == '2') echo ' selected="selected"'; ?>>غیرساکن</option>
                        </select>
                        <p class="agri1-error is-hidden" id="error-m_vaz_sok"></p>
                    </div>
                </div>
                <div class="agri1-field" id="field-m_addres">
                    <label class="agri1-label" for="m_addres">آدرس محل سکونت</label>
                    <textarea name="m_addres" id="m_addres" rows="4"><?php echo agri2_h($m_addres); ?></textarea>
                    <p class="agri1-error is-hidden" id="error-m_addres"></p>
                </div>
            </section>
<?php } ?>
            <section class="agri1-card">
                <h2 class="agri1-card-title">اطلاعات واحد</h2>
                <div class="agri1-grid">
                    <div class="agri1-field" style="margin-top:0" id="field-g_tol">
                        <label class="agri1-label" for="g_tol">قالب تولید</label>
                        <select name="g_tol" id="g_tol">
                            <option value="">انتخاب کنید</option>
                            <?php foreach ($tol_opts as $val => $lab) {
                                $sel = ((string) $g_tol === (string) $val) ? ' selected="selected"' : '';
                                echo '<option value="' . agri2_h($val) . '"' . $sel . '>' . agri2_h($lab) . '</option>';
                            } ?>
                        </select>
                        <p class="agri1-error is-hidden" id="error-g_tol"></p>
                    </div>
                    <div class="agri1-field" style="margin-top:0" id="field-m_ab">
                        <label class="agri1-label" for="m_ab">منبع تامین آب</label>
                        <select name="m_ab" id="m_ab">
                            <option value="">انتخاب کنید</option>
                            <?php foreach ($ab_opts as $val => $lab) {
                                $sel = ((string) $m_ab === (string) $val) ? ' selected="selected"' : '';
                                echo '<option value="' . agri2_h($val) . '"' . $sel . '>' . agri2_h($lab) . '</option>';
                            } ?>
                        </select>
                        <p class="agri1-error is-hidden" id="error-m_ab"></p>
                    </div>
                    <div class="agri1-field" id="field-pt_no">
                        <label class="agri1-label" for="pt_no">شماره پروانه تاسیس</label>
                        <input name="pt_no" type="text" id="pt_no" dir="ltr" maxlength="20" value="<?php echo agri2_h($pt_no); ?>"/>
                        <p class="agri1-error is-hidden" id="error-pt_no"></p>
                    </div>
                    <div class="agri1-field" id="field-pt_date">
                        <label class="agri1-label" for="pcal1">تاریخ پروانه تاسیس</label>
                        <input name="pt_date" type="text" class="pdate" id="pcal1" dir="ltr" maxlength="10" value="<?php echo agri2_h($pt_date); ?>"/>
                        <p class="agri1-error is-hidden" id="error-pcal1"></p>
                    </div>
                    <div class="agri1-field" id="field-pb_no">
                        <label class="agri1-label" for="pb_no">شماره پروانه بهره برداری</label>
                        <input name="pb_no" type="text" id="pb_no" dir="ltr" maxlength="20" value="<?php echo agri2_h($pb_no); ?>"/>
                        <p class="agri1-error is-hidden" id="error-pb_no"></p>
                    </div>
                    <div class="agri1-field" id="field-pb_date">
                        <label class="agri1-label" for="pcal2">تاریخ پروانه بهره برداری</label>
                        <input name="pb_date" type="text" class="pdate" id="pcal2" dir="ltr" maxlength="10" value="<?php echo agri2_h($pb_date); ?>"/>
                        <p class="agri1-error is-hidden" id="error-pcal2"></p>
                    </div>
                </div>
                <div class="agri1-field" id="field-unit_name">
                    <label class="agri1-label" for="unit_name">نام مجتمع</label>
                    <input name="unit_name" type="text" id="unit_name" maxlength="75" value="<?php echo agri2_h($unit_name); ?>"/>
                    <p class="agri1-hint">در صورت واقع شدن در مجتمع شیلاتی</p>
                    <p class="agri1-error is-hidden" id="error-unit_name"></p>
                </div>
            </section>
            <section class="agri1-card">
                <h2 class="agri1-card-title">اطلاعات تولید</h2>
                <div class="agri1-field" id="field-sal" style="margin-top:0; max-width:240px">
                    <label class="agri1-label" for="sal">سال</label>
                    <select name="sal" id="sal">
                        <option value="1404"<?php if ($sal == '1404') echo ' selected="selected"'; ?>>1404</option>
                    </select>
                    <p class="agri1-error is-hidden" id="error-sal"></p>
                </div>
<?php if ($no_fa == '1' || $no_fa == '3') { ?>
                <h3 class="agri1-card-title" style="margin-top:20px">تکثیر</h3>
                <table class="agri1-prod-table">
                    <thead>
                        <tr><th>عنوان</th><th>میزان تولید سالانه</th><th>واحد</th></tr>
                    </thead>
                    <tbody>
                    <?php foreach (aquatic_tak_rows() as $i => $meta) {
                        $val = ${'tak' . $i}; ?>
                        <tr>
                            <td><?php echo agri2_h($meta[0]); ?></td>
                            <td class="agri1-amt" id="field-tak<?php echo $i; ?>">
                                <label class="is-hidden" for="tak<?php echo $i; ?>"><?php echo agri2_h($meta[0]); ?></label>
                                <input name="tak<?php echo $i; ?>" type="text" id="tak<?php echo $i; ?>" dir="ltr" inputmode="decimal" maxlength="35" value="<?php echo agri2_h($val); ?>"/>
                                <p class="agri1-error is-hidden" id="error-tak<?php echo $i; ?>"></p>
                            </td>
                            <td class="agri1-unit"><?php echo agri2_h($meta[1]); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
<?php } ?>
<?php if ($no_fa == '2' || $no_fa == '3') { ?>
                <h3 class="agri1-card-title" style="margin-top:20px">پرورش</h3>
                <table class="agri1-prod-table">
                    <thead>
                        <tr><th>عنوان</th><th>میزان تولید سالانه</th><th>واحد</th></tr>
                    </thead>
                    <tbody>
                    <?php foreach (aquatic_par_rows() as $i => $meta) {
                        $val = ${'par' . $i}; ?>
                        <tr>
                            <td><?php echo agri2_h($meta[0]); ?></td>
                            <td class="agri1-amt" id="field-par<?php echo $i; ?>">
                                <label class="is-hidden" for="par<?php echo $i; ?>"><?php echo agri2_h($meta[0]); ?></label>
                                <input name="par<?php echo $i; ?>" type="text" id="par<?php echo $i; ?>" dir="ltr" inputmode="decimal" maxlength="35" value="<?php echo agri2_h($val); ?>"/>
                                <p class="agri1-error is-hidden" id="error-par<?php echo $i; ?>"></p>
                            </td>
                            <td class="agri1-unit"><?php echo agri2_h($meta[1]); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
<?php } ?>
            </section>
            <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
            <input type="hidden" name="num_bah" value="<?php echo agri2_h($num_bah); ?>"/>
            <input type="hidden" name="id_ostan" value="<?php echo agri2_h($id_ostan); ?>"/>
            <input type="hidden" name="id_city" value="<?php echo agri2_h($id_city); ?>"/>
            <input type="hidden" name="add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
            <input type="hidden" name="add_city" value="<?php echo agri2_h($add_city); ?>"/>
            <input type="hidden" name="id_mar" value="<?php echo agri2_h($id_mar); ?>"/>
            <input type="hidden" name="no_fa" value="<?php echo agri2_h($no_fa); ?>"/>
            <input type="hidden" name="no_mal" value="<?php echo agri2_h($no_mal); ?>"/>
            <div class="agri1-actions">
                <button type="submit" name="action" value="ثبت اطلاعات" id="submit" class="agri1-btn agri1-btn-primary">ثبت اطلاعات</button>
            </div>
        </form>
        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="index.php">بازگشت به صفحه قبل</a>
        </p>
    </main>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td height="109" style="background: url('../../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../../footer.php'); ?>
            </td>
        </tr>
    </table>
    <script type="text/javascript">
        if (typeof AMIB !== 'undefined') {
            if (document.getElementById('pcal1')) var objCal1 = new AMIB.persianCalendar('pcal1');
            if (document.getElementById('pcal2')) var objCal2 = new AMIB.persianCalendar('pcal2');
        }
    </script>
    <script>
        (function () {
            var form = document.getElementById('form1');
            if (!form) return;
            var overlay = document.getElementById('agri1-overlay');
            var submitBtn = document.getElementById('submit');
            var summary = document.getElementById('agri1-error-summary');
            var list = document.getElementById('agri1-error-list');
            var sending = false;
            var lockOwner = <?php echo $lock_owner ? 'true' : 'false'; ?>;
            var showLand = <?php echo $show_land ? 'true' : 'false'; ?>;
            var noFa = <?php echo json_encode((string) $no_fa); ?>;

            function optionText(opt) { return String(opt.text || '').replace(/^\s+|\s+$/g, ''); }
            var openWrap = null;
            function closeWrap(wrap) {
                if (!wrap) return;
                wrap.classList.remove('is-open');
                var btn = wrap.querySelector('.agri1-select-btn');
                if (btn) btn.setAttribute('aria-expanded', 'false');
                if (openWrap === wrap) openWrap = null;
            }
            function closeAll() {
                var wraps = form.querySelectorAll('.agri1-select.is-open');
                for (var i = 0; i < wraps.length; i++) closeWrap(wraps[i]);
            }
            function enhance(select) {
                if (select.getAttribute('data-agri1-select') === '1') return;
                select.setAttribute('data-agri1-select', '1');
                var wrap = document.createElement('div');
                wrap.className = 'agri1-select';
                select.parentNode.insertBefore(wrap, select);
                wrap.appendChild(select);
                var listId = (select.id || ('agri1-sel-' + Math.random().toString(36).slice(2))) + '-list';
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'agri1-select-btn';
                btn.setAttribute('aria-haspopup', 'listbox');
                btn.setAttribute('aria-expanded', 'false');
                btn.setAttribute('aria-controls', listId);
                btn.innerHTML = '<span class="agri1-select-label"></span><svg class="agri1-icon" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>';
                var labelEl = btn.querySelector('.agri1-select-label');
                var ul = document.createElement('ul');
                ul.id = listId; ul.className = 'agri1-select-list'; ul.setAttribute('role', 'listbox');
                wrap.appendChild(btn); wrap.appendChild(ul); wrap.classList.add('is-enhanced');
                function currentIndex() { return select.selectedIndex < 0 ? 0 : select.selectedIndex; }
                function syncFromSelect() {
                    var opt = select.options[currentIndex()];
                    labelEl.textContent = opt ? optionText(opt) : '';
                    var items = ul.querySelectorAll('.agri1-select-option');
                    for (var i = 0; i < items.length; i++) items[i].classList.toggle('is-selected', items[i].getAttribute('data-index') === String(currentIndex()));
                }
                function buildList() {
                    ul.innerHTML = '';
                    for (var i = 0; i < select.options.length; i++) {
                        var li = document.createElement('li');
                        li.className = 'agri1-select-option'; li.setAttribute('role', 'option');
                        li.setAttribute('data-index', String(i)); li.textContent = optionText(select.options[i]);
                        ul.appendChild(li);
                    }
                    syncFromSelect();
                }
                function choose(index) {
                    if (index < 0 || index >= select.options.length) return;
                    select.selectedIndex = index; syncFromSelect(); closeWrap(wrap); btn.focus();
                }
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (wrap.classList.contains('is-open')) { closeWrap(wrap); return; }
                    closeAll(); buildList(); wrap.classList.add('is-open'); btn.setAttribute('aria-expanded', 'true'); openWrap = wrap;
                });
                ul.addEventListener('click', function (e) {
                    var li = e.target.closest ? e.target.closest('.agri1-select-option') : null;
                    if (!li) return;
                    choose(parseInt(li.getAttribute('data-index'), 10));
                });
                btn.addEventListener('keydown', function (e) {
                    var idx = currentIndex();
                    if (e.key === 'ArrowDown') { e.preventDefault(); if (!wrap.classList.contains('is-open')) { btn.click(); } else choose(Math.min(idx + 1, select.options.length - 1)); }
                    else if (e.key === 'ArrowUp') { e.preventDefault(); choose(Math.max(idx - 1, 0)); }
                    else if (e.key === 'Escape') { closeWrap(wrap); }
                    else if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); if (!wrap.classList.contains('is-open')) btn.click(); }
                });
                buildList();
                select.agri1Rebuild = buildList;
            }
            var selects = form.querySelectorAll('select');
            for (var s = 0; s < selects.length; s++) enhance(selects[s]);
            document.addEventListener('click', function (e) {
                if (openWrap && !openWrap.contains(e.target)) closeAll();
            });

            function val(id) {
                var el = document.getElementById(id);
                return el ? String(el.value || '').replace(/^\s+|\s+$/g, '') : '';
            }
            function setErr(id, msg) {
                var el = document.getElementById(id);
                var err = document.getElementById('error-' + id);
                if (el) el.setAttribute('aria-invalid', msg ? 'true' : 'false');
                if (err) { err.textContent = msg || ''; err.className = msg ? 'agri1-error' : 'agri1-error is-hidden'; }
            }
            function req(id, label, errors) {
                if (val(id) === '') errors[id] = label + ' را وارد کنید';
            }
            function reqSel(id, label, errors) {
                if (val(id) === '') errors[id] = label + ' را انتخاب کنید';
            }
            function reqNum(id, label, errors) {
                var v = val(id);
                if (v === '') { errors[id] = label + ' را وارد کنید'; return; }
                if (!/^-?\d+(\.\d+)?$/.test(v.replace(/[،,]/g, '.'))) errors[id] = label + ' باید عدد باشد';
            }

            form.addEventListener('submit', function (e) {
                var errors = {};
                if (showLand) {
                    reqNum('lng', 'طول جغرافیایی', errors);
                    reqNum('lat', 'عرض جغرافیایی', errors);
                    req('m_zamin', 'مساحت مفید', errors);
                    req('m_cod_m', 'کد ملی مالک', errors);
                    reqSel('m_jens', 'جنسیت', errors);
                    req('m_name', 'نام', errors);
                    req('m_last_name', 'نام خانوادگی', errors);
                    req('m_fname', 'نام پدر / شرکت', errors);
                    req('m_tel_m', 'تلفن همراه', errors);
                    req('m_addres', 'آدرس محل سکونت', errors);
                    reqSel('m_vaz_sok', 'وضعیت سکونت', errors);
                }
                reqSel('g_tol', 'قالب تولید', errors);
                reqSel('m_ab', 'منبع تامین آب', errors);
                req('pt_no', 'شماره پروانه تاسیس', errors);
                req('pcal1', 'تاریخ پروانه تاسیس', errors);
                req('pb_no', 'شماره پروانه بهره برداری', errors);
                req('pcal2', 'تاریخ پروانه بهره برداری', errors);
                req('unit_name', 'نام مجتمع', errors);
                reqSel('sal', 'سال', errors);
                if (noFa === '1' || noFa === '3') {
                    for (var t = 1; t <= 10; t++) reqNum('tak' + t, 'میزان تولید تکثیر', errors);
                }
                if (noFa === '2' || noFa === '3') {
                    for (var p = 1; p <= 17; p++) reqNum('par' + p, 'میزان تولید پرورش', errors);
                }
                var ids = [];
                for (var k in errors) { if (errors.hasOwnProperty(k)) ids.push(k); }
                for (var c = 0; c < form.elements.length; c++) {
                    var nm = form.elements[c].id;
                    if (nm) setErr(nm, errors[nm] || '');
                }
                if (ids.length) {
                    e.preventDefault();
                    sending = false;
                    list.innerHTML = '';
                    for (var i = 0; i < ids.length; i++) {
                        var li = document.createElement('li');
                        var a = document.createElement('a');
                        a.href = '#field-' + ids[i];
                        if (ids[i] === 'pcal1') a.href = '#field-pt_date';
                        if (ids[i] === 'pcal2') a.href = '#field-pb_date';
                        a.textContent = errors[ids[i]];
                        li.appendChild(a);
                        list.appendChild(li);
                    }
                    summary.classList.remove('is-hidden');
                    summary.focus();
                    return;
                }
                if (sending) { e.preventDefault(); return; }
                sending = true;
                if (overlay) overlay.className = 'agri1-overlay is-open';
                if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
            });

            if (!lockOwner && window.jQuery) {
                jQuery(document).ready(function ($) {
                    $('.Mcod_m').on('change', function () {
                        var id = $(this).val();
                        $.ajax({
                            type: 'POST',
                            url: 'select_mar.php',
                            data: { cod_m: id },
                            cache: false,
                            success: function (html) {
                                var sel = document.getElementById('m_jens');
                                $('.mar').html(html);
                                if (sel && typeof sel.agri1Rebuild === 'function') sel.agri1Rebuild();
                            }
                        });
                    });
                });
            }
        })();
    </script>
</body>
</html>
