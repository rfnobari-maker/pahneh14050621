<?php
include('../../lock_p1.php');
include('../../event.php');

if (!function_exists('agri2_h')) {
    function agri2_h($v)
    {
        if (!isset($v)) return '';
        return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
    }
}

function greenh_ops_svg($name)
{
    $d = array(
        'view' => '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>',
        'crop' => '<path d="M12 3v18"/><path d="M5 10c3 0 5-3 7-7 2 4 4 7 7 7"/><path d="M5 16c3 0 5-3 7-7 2 4 4 7 7 7"/>',
        'land' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 10h18"/><path d="M9 10v9"/>',
        'del' => '<path d="M4 7h16"/><path d="M9 7V4h6v3"/><path d="M6 7l1 14h10l1-14"/><path d="M10 11v6"/><path d="M14 11v6"/>'
    );
    $p = isset($d[$name]) ? $d[$name] : '';
    return '<svg class="agri1-icon" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true">' . $p . '</svg>';
}

function greenh_map($code, $map)
{
    $code = (string) $code;
    return isset($map[$code]) ? $map[$code] : '';
}

function greenh_label_no_kesht($v)
{
    return greenh_map($v, array('1' => 'گلخانه', '2' => 'فضای باز'));
}

function greenh_label_no_saz($v)
{
    return greenh_map($v, array(
        '1' => 'فلزی با پوشش پلاستیکی',
        '2' => 'فلزی با پوشش پلی کربنات',
        '3' => 'فلزی با پوشش شیشه ای',
        '4' => 'چوبی پلاستیکی'
    ));
}

function greenh_label_no_gol($v)
{
    return greenh_map($v, array(
        '1' => 'تونلی تک قلو',
        '2' => 'تونلی به هم پیوسته',
        '3' => 'یک طرفه',
        '4' => 'شیشه ای سقف شیروانی'
    ));
}

function greenh_label_sys_kesh($v)
{
    return greenh_map($v, array('1' => 'خاکی', '2' => 'هیدروپونیک', '3' => 'اکوآپونیک'));
}

function greenh_label_sys_hot($v)
{
    return greenh_map($v, array('1' => 'حرارت مرکزی', '2' => 'هیتر یا بخاری', '3' => 'تشعشعی'));
}

function greenh_label_no_mal($v)
{
    return greenh_map($v, array(
        '1' => 'سند ششدانگ',
        '2' => 'سند مشاعی',
        '3' => 'اصلاحات اراضی',
        '4' => 'موقوفه',
        '5' => 'واگذاری',
        '6' => 'قولنامه',
        '7' => 'اجاره'
    ));
}

function greenh_label_v_unit($v)
{
    return greenh_map($v, array(
        '1' => 'فعال',
        '2' => 'در حال اخذ پروانه تاسیس',
        '3' => 'دارای پیشرفت فیزیکی',
        '4' => 'غیرفعال'
    ));
}

function greenh_label_m_fani($v)
{
    return greenh_map($v, array('1' => 'دارد', '2' => 'ندارد'));
}

function greenh_label_no_mtol($v)
{
    return greenh_map($v, array(
        '211100' => 'سبزی و صیفی',
        '211300' => 'گل و گیاه زینتی',
        '211200' => 'سایر'
    ));
}

function greenh_label_no_moj($v)
{
    return greenh_map($v, array(
        '1' => 'پروانه بهره برداری/نظام مهندسی',
        '5' => 'پروانه بهره برداری/سازمان جهاد کشاورزی',
        '2' => 'مشاغل خانگی/وزارت جهاد',
        '3' => 'تسهیلات/بسیج سازندگی',
        '4' => 'فاقد مجوز'
    ));
}

function greenh_label_month($v)
{
    return greenh_map($v, array(
        '01' => 'فروردین',
        '02' => 'اردیبهشت',
        '03' => 'خرداد',
        '04' => 'تیر',
        '05' => 'مرداد',
        '06' => 'شهریور',
        '07' => 'مهر',
        '08' => 'آبان',
        '09' => 'آذر',
        '10' => 'دی',
        '11' => 'بهمن',
        '12' => 'اسفند'
    ));
}

function greenh_y_ok($y)
{
    return $y !== '' && (bool) preg_match('/^\d{4}$/', $y);
}

function greenh_eq(&$where, &$params, $col, $val, $empty)
{
    if ($val === '' || in_array((string) $val, $empty, true)) {
        return;
    }
    $key = ':' . preg_replace('/[^a-zA-Z0-9_]/', '_', $col);
    while (isset($params[$key])) {
        $key .= 'x';
    }
    $where[] = $col . ' = ' . $key;
    $params[$key] = $val;
}

function greenh_hiddens($pairs)
{
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

function greenh_opt($val, $cur, $label)
{
    $sel = ((string) $cur === (string) $val) ? ' selected="selected"' : '';
    echo '<option value="' . agri2_h($val) . '"' . $sel . '>' . agri2_h($label) . '</option>';
}

function greenh_month_options($cur)
{
    $months = array(
        '01' => 'فروردین',
        '02' => 'اردیبهشت',
        '03' => 'خرداد',
        '04' => 'تیر',
        '05' => 'مرداد',
        '06' => 'شهریور',
        '07' => 'مهر',
        '08' => 'آبان',
        '09' => 'آذر',
        '10' => 'دی',
        '11' => 'بهمن',
        '12' => 'اسفند'
    );
    echo '<option value="">انتخاب</option>';
    foreach ($months as $k => $lab) {
        greenh_opt($k, $cur, $lab);
    }
}

function greenh170_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $no_kesht, $y_prod, $skb1, $skb2, $mor_cod_m, $date_1_kesh, $date_2_kesh, $date_1_bar, $date_2_bar, $mtol1, $mtol2, $group_cod, $mah_cod)
{
    greenh_hiddens(array(
        'action' => '1',
        'id_ostan' => $id_ostan1,
        'id_city5' => $id_city,
        'id_mar' => $id_mar,
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'bah_cod_m' => $bah_cod_m,
        'no_kesht' => $no_kesht,
        'y_prod' => $y_prod,
        'skb1' => $skb1,
        'skb2' => $skb2,
        'mor_cod_m' => $mor_cod_m,
        'date_1_kesh' => $date_1_kesh,
        'date_2_kesh' => $date_2_kesh,
        'date_1_bar' => $date_1_bar,
        'date_2_bar' => $date_2_bar,
        'mtol1' => $mtol1,
        'mtol2' => $mtol2,
        'group_cod' => $group_cod,
        'mah_cod' => $mah_cod
    ));
}

function greenh_num_ok($v)
{
    return $v !== '' && is_numeric($v);
}

function greenh_mon_ok($v)
{
    return $v !== '' && (bool) preg_match('/^(0[1-9]|1[0-2])$/', $v);
}

$id_ostan1 = $id_ostan;
$id_city = $id_city;
$id_mar = $id_mar;
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '0';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '0';
$no_kesht = isset($_POST['no_kesht']) ? $_POST['no_kesht'] : '0';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : $login_session;
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$y_prod = isset($_POST['y_prod']) ? $_POST['y_prod'] : '1405';
$skb1 = isset($_POST['skb1']) ? $_POST['skb1'] : '';
$skb2 = isset($_POST['skb2']) ? $_POST['skb2'] : '';
$date_1_kesh = isset($_POST['date_1_kesh']) ? $_POST['date_1_kesh'] : '';
$date_2_kesh = isset($_POST['date_2_kesh']) ? $_POST['date_2_kesh'] : '';
$date_1_bar = isset($_POST['date_1_bar']) ? $_POST['date_1_bar'] : '';
$date_2_bar = isset($_POST['date_2_bar']) ? $_POST['date_2_bar'] : '';
$mtol1 = isset($_POST['mtol1']) ? $_POST['mtol1'] : '';
$mtol2 = isset($_POST['mtol2']) ? $_POST['mtol2'] : '';
$group_cod = isset($_POST['group_cod']) ? $_POST['group_cod'] : '';
$mah_cod = isset($_POST['mah_cod']) ? $_POST['mah_cod'] : '';
$query1 = '';
$params = array();
$limit = 10;
$id = isset($_GET['id']) ? (int) $_GET['id'] : 1;
if ($id < 1) {
    $id = 1;
}
$start = ($id - 1) * $limit;
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
        html {
            scroll-padding-top: 96px;
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
        }
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
            width: 100%;
            margin: 0 auto;
            padding: var(--space-3) 8px var(--space-4);
        }
        .agri1-title {
            margin: 0 0 var(--space-2);
            color: var(--color-foreground);
            font-size: clamp(1.35rem, 2.4vw, 1.85rem);
            line-height: 1.4;
            text-wrap: balance;
        }
        .agri1-card-title {
            margin: 0 0 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--color-border);
            font-size: 1rem;
        }
        .agri1-card {
            background: var(--color-card);
            color: var(--color-card-foreground);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: var(--space-3);
            margin-bottom: var(--space-3);
        }
        .agri1-card-results {
            padding: 12px 8px;
        }
        .agri1-card-search {
            max-width: 720px;
            margin-right: auto;
            margin-left: auto;
            padding: 16px;
        }
        .agri1-card-search .agri1-card-title {
            margin-bottom: 10px;
            padding-bottom: 6px;
        }
        .agri1-card-search .agri1-grid {
            gap: 10px 12px;
        }
        .agri1-card-search .agri1-label {
            margin-bottom: 4px;
            font-size: 0.875rem;
        }
        .agri1-card-search .agri1-hint {
            margin: 0 0 4px;
        }
        .agri1-page .agri1-card-search .agri1-form input[type="text"],
        .agri1-page .agri1-card-search .agri1-form input[type="number"],
        .agri1-page .agri1-card-search .agri1-form select {
            min-height: 36px;
            padding: 6px 10px;
        }
        .agri1-page .agri1-card-search .agri1-form select {
            padding-left: 32px;
        }
        .agri1-page .agri1-card-search .agri1-select-btn {
            min-height: 36px;
            padding: 6px 10px;
            font-size: 16px;
        }
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
        .agri1-field { margin-top: 0; }
        .agri1-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            color: var(--color-foreground);
        }
        .agri1-hint {
            margin: 12px 0 0;
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
        }
        .agri1-note {
            margin: 0 0 var(--space-3);
            padding: 12px 14px;
            border-radius: 10px;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            color: #1D4ED8;
        }
        .agri1-card-results .agri1-note { margin-bottom: 12px; }
        .agri1-page .agri1-form input[type="text"],
        .agri1-page .agri1-form input[type="number"],
        .agri1-page .agri1-form select {
            width: 100%;
            min-height: var(--touch);
            padding: 10px 12px;
            border: 1px solid #64748B;
            border-radius: 10px;
            background: var(--color-card);
            color: var(--color-foreground);
            font-size: 16px;
            font-family: inherit;
            box-shadow: none;
            transition: border-color var(--duration) ease, box-shadow var(--duration) ease;
        }
        .agri1-page .agri1-form select {
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2314532D' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 10px center;
            padding-left: 32px;
        }
        .agri1-page .agri1-form input[type="text"]:hover,
        .agri1-page .agri1-form input[type="number"]:hover,
        .agri1-page .agri1-form select:hover {
            background: var(--color-card);
            color: var(--color-foreground);
        }
        .agri1-page .agri1-form input[type="text"]:focus,
        .agri1-page .agri1-form input[type="number"]:focus,
        .agri1-page .agri1-form select:focus {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
        }
        .agri1-page .agri1-form #bah_cod_m {
            text-align: center;
            letter-spacing: 0.08em;
        }
        .agri1-page .agri1-form input.agri-lock,
        .agri1-page .agri1-form input[readonly],
        .agri1-page .agri1-form select:disabled {
            background: var(--color-card);
        }
        .agri1-select { position: relative; width: 100%; }
        .agri1-select.is-enhanced > select {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
        .agri1-select-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            width: 100%;
            min-height: var(--touch);
            padding: 6px 12px;
            border: 1px solid #64748B;
            border-radius: 10px;
            background: var(--color-card);
            color: var(--color-foreground);
            font-size: 16px;
            font-family: inherit;
            text-align: right;
            cursor: pointer;
        }
        .agri1-select-btn:hover { background: var(--color-card); }
        .agri1-select-btn:focus-visible {
            outline: none;
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
        }
        .agri1-select.is-open .agri1-select-btn {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
        }
        .agri1-select-btn:disabled {
            cursor: default;
            color: var(--color-muted-foreground);
        }
        .agri1-select-label {
            flex: 1 1 auto;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .agri1-select-caret {
            flex: 0 0 auto;
            width: 18px;
            height: 18px;
            color: var(--color-foreground);
        }
        .agri1-select.is-open .agri1-select-caret { transform: rotate(180deg); }
        .agri1-combo-list,
        .agri1-select-list {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            right: 0;
            left: 0;
            z-index: 40;
            max-height: 240px;
            overflow-y: auto;
            margin: 0;
            padding: 6px 0;
            list-style: none;
            background: var(--color-card);
            color: var(--color-foreground);
            border: 1px solid var(--color-border);
            border-radius: 10px;
            box-shadow: var(--shadow);
            direction: rtl;
            text-align: right;
        }
        .agri1-select.is-open .agri1-select-list { display: block; }
        .agri1-combo-option,
        .agri1-select-option {
            min-height: 36px;
            padding: 8px 14px;
            cursor: pointer;
            color: var(--color-foreground);
            font-size: 0.9375rem;
            line-height: 1.4;
        }
        .agri1-select-option:hover,
        .agri1-select-option.is-active {
            background: #ECFDF3;
        }
        .agri1-select-option.is-selected {
            font-weight: 700;
            color: var(--color-primary);
            background: #ECFDF3;
        }
        .agri1-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            direction: ltr;
        }
        .agri1-grid .agri1-field {
            direction: rtl;
            text-align: right;
        }
        .agri1-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
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
            font-family: inherit;
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
        .agri1-xls {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin: 0 0 12px;
        }
        .agri1-xls form { margin: 0; }
        .agri1-xls button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: var(--touch);
            min-height: var(--touch);
            background: transparent;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
            padding: 0;
        }
        .agri1-xls button img {
            width: 44px;
            height: 40px;
            object-fit: contain;
            display: block;
        }
        .agri1-xls button:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-results-toolbar {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 8px;
            margin: 0 0 8px;
            direction: ltr;
        }
        .agri1-results-toolbar .agri1-col-picker {
            justify-self: start;
        }
        .agri1-results-toolbar .agri1-xls {
            margin: 0;
            grid-column: 2;
        }
        .agri1-col-picker { position: relative; }
        .agri1-col-picker-btn {
            min-height: var(--touch);
            padding: 8px 14px;
            font-size: 0.875rem;
        }
        .agri1-col-panel {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            z-index: 30;
            min-width: 260px;
            max-width: min(320px, calc(100vw - 24px));
            max-height: min(420px, 70vh);
            overflow-y: auto;
            padding: 10px 8px 12px;
            border: 1px solid var(--color-border);
            border-radius: 12px;
            background: var(--color-card);
            box-shadow: var(--shadow);
            direction: rtl;
            text-align: right;
            color: var(--color-foreground);
        }
        .agri1-col-picker.is-open .agri1-col-panel { display: block; }
        .agri1-col-panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 4px 8px 8px;
            border-bottom: 1px solid var(--color-border);
            margin-bottom: 6px;
        }
        .agri1-col-panel-head strong { font-size: 0.875rem; }
        .agri1-col-reset {
            background: none;
            border: 0;
            color: var(--color-primary);
            cursor: pointer;
            font: inherit;
            font-weight: 700;
            font-size: 0.8125rem;
            min-height: var(--touch);
            padding: 0 8px;
        }
        .agri1-col-reset:hover { text-decoration: underline; }
        .agri1-col-reset:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
            border-radius: 8px;
        }
        .agri1-col-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .agri1-col-list li { margin: 0; }
        .agri1-col-list label {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: var(--touch);
            padding: 0 8px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 400;
        }
        .agri1-col-list label:hover { background: var(--color-background); }
        .agri1-col-list input[type="checkbox"] {
            width: 18px;
            height: 18px;
            flex: 0 0 auto;
            accent-color: var(--color-primary);
            cursor: pointer;
        }
        .agri1-col-list input[type="checkbox"]:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-table .is-col-hidden {
            display: none !important;
        }
        .agri1-table-hint {
            display: none;
            margin: 0 0 8px;
            color: var(--color-muted-foreground);
            font-size: 0.8125rem;
            text-align: center;
        }
        .agri1-table-wrap {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            overscroll-behavior-x: contain;
            border: 1px solid var(--color-border);
            border-radius: 12px;
            background: var(--color-card);
            direction: ltr;
        }
        .agri1-table {
            width: 100%;
            min-width: 1100px;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 12px;
            direction: ltr;
        }
        .agri1-table th {
            background: var(--color-primary);
            color: var(--color-on-primary);
            padding: 5px 3px;
            font-weight: 700;
            text-align: center;
            line-height: 1.3;
            font-size: 11px;
            border: 1px solid #FFFFFF;
            white-space: nowrap;
            overflow: hidden;
        }
        .agri1-table td {
            padding: 4px 3px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid var(--color-border);
            color: var(--color-foreground);
            font-family: myfont2, yekan, Tahoma, "Segoe UI", sans-serif;
            font-weight: 400;
            font-size: 16px;
            white-space: nowrap;
        }
        .agri1-table tbody tr:nth-child(even) td { background: var(--color-background); }
        .agri1-table tbody tr:hover td { background: #ECFDF3; }
        .agri1-table th.agri1-ops-col,
        .agri1-table td.agri1-ops {
            width: 52px;
            padding: 3px 2px;
            white-space: nowrap;
        }
        .agri1-table .agri1-name-col {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .agri1-table td.agri1-ops form { margin: 0; }
        .agri1-table td.agri1-ops button {
            border: 0;
            background: transparent;
            padding: 0;
            cursor: pointer;
        }
        .agri1-table td.agri1-ops button:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-pager {
            margin-top: var(--space-2);
            padding: 10px 12px;
            border: 1px solid var(--color-border);
            border-radius: 12px;
            background: var(--color-card);
            text-align: center;
        }
        .agri1-pager-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 4px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .agri1-pager-list form { display: inline; }
        .agri1-pager-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 32px;
            min-width: 32px;
            padding: 4px 10px;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            background: var(--color-card);
            color: var(--color-foreground);
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.2;
        }
        .agri1-pager-btn:hover { background: var(--color-muted); }
        .agri1-pager-btn:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-pager-btn.is-current,
        .agri1-pager-btn.is-nav {
            background: var(--color-primary);
            color: var(--color-on-primary);
            border-color: var(--color-primary);
        }
        .agri1-pager-btn.is-num {
            font-family: Tahoma, "Segoe UI", sans-serif;
            font-size: 13px;
            font-weight: 600;
            direction: ltr;
        }
        .agri1-pager-ellipsis {
            color: var(--color-muted-foreground);
            padding: 4px 6px;
            font-family: Tahoma, "Segoe UI", sans-serif;
            font-size: 13px;
        }
        .agri1-pager-jump {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
        }
        .agri1-pager-jump form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 6px;
        }
        .agri1-pager-jump span {
            font-size: 13px;
        }
        .agri1-pager-jump input[type="number"],
        .agri1-pager-jump input[type="text"] {
            width: 64px;
            min-height: 32px;
            padding: 4px 8px;
            border: 1px solid #64748B;
            border-radius: 8px;
            font-size: 13px;
            font-family: Tahoma, "Segoe UI", sans-serif;
            text-align: center;
            direction: ltr;
        }
        @media (max-width: 1100px) {
            .agri1-table-hint { display: block; }
        }
        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
            .agri1-table th { font-size: 13px; }
            .agri1-table td { font-size: 16px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            .agri1-btn:active { transform: none; }
        }

        .agri1-page .agri1-form #m_cod_m {
            text-align: center;
            letter-spacing: 0.08em;
        }
        .agri1-table th.agri1-ops-col,
        .agri1-table td.agri1-ops {
            width: 168px;
            padding: 4px 3px;
            white-space: nowrap;
        }
        .agri1-ops-bar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }
        .agri1-ops-bar form { display: inline-flex; margin: 0; }
        .agri1-ops-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            min-width: 32px;
            min-height: 32px;
            padding: 0;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            background: var(--color-card);
            color: var(--color-foreground);
            cursor: pointer;
            line-height: 0;
            touch-action: manipulation;
            transition: background-color var(--duration) ease, border-color var(--duration) ease, color var(--duration) ease;
        }
        .agri1-ops-btn .agri1-icon {
            width: 16px;
            height: 16px;
        }
        .agri1-ops-btn:hover {
            background: var(--color-background);
            border-color: var(--color-primary);
            color: var(--color-primary);
        }
        .agri1-ops-btn:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-ops-btn-del {
            color: var(--color-destructive);
            border-color: #FECACA;
        }
        .agri1-ops-btn-del:hover {
            background: var(--color-warning-bg);
            border-color: var(--color-destructive);
            color: var(--color-destructive);
        }

    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".country").change(function () {
                var id = $(this).val();
                var dataString = 'group_cod=' + id;
                $.ajax({
                    type: "POST",
                    url: "ajax_Green_rep.php",
                    data: dataString,
                    cache: false,
                    success: function (html) {
                        $(".mar").html(html);
                        var sel = document.querySelector("select.mar");
                        if (sel && typeof sel._agri1Rebuild === "function") sel._agri1Rebuild();
                    }
                });
            });
        });
    </script>

    <script>
        function target_popup3(form) {
            window.open('null', 'formpopup', 'width=1050,height=700,resizeable,scrollbars');
            form.target = 'formpopup';
        }
    </script>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#reg-form">رفتن به فرم جستجو</a>
    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>
    <?php
    $pahneh_crumb = array(
        array('label' => 'خانه', 'href' => '../../indexbenef.php'),
        array('label' => 'اطلاعات اختصاصی', 'href' => '../index.php'),
        array('label' => 'باغبانی', 'href' => 'index.php'),
        array('label' => 'گزارش اختصاصی محصولات گلخانه'),
    );
    include(__DIR__ . '/../../chrome.php');
    ?>
    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="greenh170-title">گزارش اختصاصی محصولات گلخانه</h1>
        </header>
        <section class="agri1-card agri1-card-search" aria-labelledby="greenh170-title">
            <form id="reg-form" class="agri1-form" method="post" action="#1" novalidate>
                <h2 class="agri1-card-title">جستجو</h2>
                <div class="agri1-grid">
                    <div class="agri1-field">
                        <label class="agri1-label" for="y_prod">سال</label>
                        <select name="y_prod" class="input_text required" id="y_prod">
                         <?php
                          foreach (array('1405', '1404', '1403', '1402', '1401') as $yy) {
                           greenh_opt($yy, $y_prod, $yy);
                             }
						  ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_ostan">استان</label>
                        <select name="id_ostan" disabled="disabled" class="input_text" id="id_ostan" dir="rtl">
                            <option value="-1">انتخاب استان</option>
                            <?php
                            $stmt = $dbh->prepare('SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan ASC');
                            $stmt->execute();
                            foreach ($stmt as $row) {
                                greenh_opt($row['id_ostan'], $id_ostan1, $row['ostan']);
                            }
                            ?>
                        </select>
                        <input type="hidden" name="id_ostan" value="<?php echo agri2_h($id_ostan1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="no_bah2">نوع کشت</label>
                        <select name="no_kesht" class="input_text required" id="no_bah2">
                            <option value="0">انتخاب کنید</option>
                            <?php greenh_opt('1', $no_kesht, 'گلخانه'); ?>
                            <?php greenh_opt('2', $no_kesht, 'فضای باز'); ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_city">شهرستان</label>
                        <select name="id_city5" disabled="disabled" class="input_text" id="id_city" dir="rtl">
                            <option value="0">کل استان</option>
                            <?php
                            $stmt = $dbh->prepare('SELECT id_city,city FROM cityname WHERE id_ostan = :id_ostan ORDER BY BINARY city ASC');
                            $stmt->execute(array(':id_ostan' => $id_ostan1));
                            foreach ($stmt as $row) {
                                greenh_opt($row['id_city'], $id_city, $row['city']);
                            }
                            ?>
                        </select>
                        <input type="hidden" name="id_city5" value="<?php echo agri2_h($id_city); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_abadi">نام آبادی</label>
                        <select name="add_abadi" class="input_text" id="add_abadi" dir="rtl">
                            <option value="0">انتخاب نام آبادی</option>
                            <?php
                            $stmt = $dbh->prepare('SELECT add_abadi,abadi FROM list_abadi WHERE id_mar = :id_mar ORDER BY BINARY abadi');
                            $stmt->execute(array(':id_mar' => $id_mar));
                            foreach ($stmt as $row) {
                                greenh_opt($row['add_abadi'], $add_abadi, $row['abadi']);
                            }
                            ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_mar">مرکز جهاد کشاورزی</label>
                        <select name="id_mar" disabled="disabled" class="input_text" id="id_mar" dir="rtl">
                            <option value="0">نام مرکز</option>
                            <?php
                            $stmt = $dbh->prepare('SELECT id_mar,mar FROM mar WHERE id_ostan = :id_ostan AND id_city = :id_city');
                            $stmt->execute(array(':id_ostan' => $id_ostan1, ':id_city' => $id_city));
                            foreach ($stmt as $row) {
                                greenh_opt($row['id_mar'], $id_mar, $row['mar']);
                            }
                            ?>
                        </select>
                        <input name="id_city2" type="hidden" value="<?php echo agri2_h($id_city); ?>"/>
                        <input type="hidden" name="id_mar" value="<?php echo agri2_h($id_mar); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_city">نام شهر</label>
                        <select name="add_city" class="input_text" id="add_city" dir="rtl">
                            <option value="0">انتخاب نام شهر</option>
                            <?php
                            $stmt = $dbh->prepare('SELECT add_city,shahr FROM list_city WHERE id_mar = :id_mar ORDER BY BINARY shahr');
                            $stmt->execute(array(':id_mar' => $id_mar));
                            foreach ($stmt as $row) {
                                greenh_opt($row['add_city'], $add_city, $row['shahr']);
                            }
                            ?>
                        </select>
                    </div>
                    <div class="agri1-field" aria-hidden="true"></div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="bah_cod_m">کد ملی بهره‌بردار</label>
                        <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mor_cod_m">کد ملی مروج</label>
                        <input name="mor_cod_m" type="text" class="style8" id="mor_cod_m" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($login_session); ?>" readonly/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="date_2_kesh">پایان کشت</label>
                        <select name="date_2_kesh" class="date date_2_kesh input_text" id="date_2_kesh">
                            <?php greenh_month_options($date_2_kesh); ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="date_1_kesh">شروع کشت</label>
                        <select name="date_1_kesh" class="date date_1_kesh input_text" id="date_1_kesh">
                            <?php greenh_month_options($date_1_kesh); ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="date_2_bar">پایان برداشت</label>
                        <select name="date_2_bar" class="date date_2_bar input_text" id="date_2_bar">
                            <?php greenh_month_options($date_2_bar); ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="date_1_bar">شروع برداشت</label>
                        <select name="date_1_bar" class="date date_1_bar input_text" id="date_1_bar">
                            <?php greenh_month_options($date_1_bar); ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="skb2">سطح زیر کشت — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">مترمربع</p>
                        <input name="skb2" type="text" class="input_text" id="skb2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($skb2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="skb1">سطح زیر کشت — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">مترمربع</p>
                        <input name="skb1" type="text" class="input_text" id="skb1" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($skb1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="cod_mah">نام محصول</label>
                        <select name="mah_cod" class="required input_text mar" id="cod_mah" dir="rtl">
                            <option value="">انتخاب نام محصول</option>
                            <?php
                            if ($group_cod !== '') {
                                $stmt = $dbh->prepare('SELECT DISTINCT mah_cod,mah_name FROM product_G WHERE group_cod = :group_cod');
                                $stmt->execute(array(':group_cod' => $group_cod));
                                foreach ($stmt as $row) {
                                    greenh_opt($row['mah_cod'], $mah_cod, $row['mah_name']);
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mah_qroup">گروه محصولات</label>
                        <select name="group_cod" class="mah_qroup required input_text country" id="mah_qroup" dir="rtl">
                            <option value="">انتخاب گروه</option>
                            <?php
                            $stmt = $dbh->prepare('SELECT DISTINCT group_cod,group_name FROM product_G');
                            $stmt->execute();
                            foreach ($stmt as $row) {
                                greenh_opt($row['group_cod'], $group_cod, $row['group_name']);
                            }
                            ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mtol2">میزان تولید محصول — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">تن/عدد/اصله/گلدان/شاخه</p>
                        <input name="mtol2" type="text" class="input_text" id="mtol2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($mtol2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mtol5">میزان تولید محصول — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">تن/عدد/اصله/گلدان/شاخه</p>
                        <input name="mtol1" type="text" class="input_text" id="mtol5" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($mtol1); ?>"/>
                    </div>
                </div>
                <div class="agri1-actions">
                    <button type="submit" name="action" id="action" value="اجرای کوئری" class="agri1-btn agri1-btn-primary">اجرای کوئری</button>
                </div>
            </form>
        </section>
        <a name="1" id="1"></a>
<?php
if (isset($_POST['action'])) {
    if (!greenh_y_ok($y_prod)) {
        echo '<p class="agri1-note">اطلاعاتی یافت نشد</p>';
    } else {
        $where = array('P.y_prod = :y_prod');
        $params = array(':y_prod' => $y_prod);
        $empty0 = array('0', '-1');
        greenh_eq($where, $params, 'P.id_ostan', $id_ostan1, $empty0);
        greenh_eq($where, $params, 'P.id_city', $id_city, $empty0);
        greenh_eq($where, $params, 'P.id_mar', $id_mar, $empty0);
        greenh_eq($where, $params, 'P.add_abadi', $add_abadi, $empty0);
        greenh_eq($where, $params, 'P.add_city', $add_city, $empty0);
        greenh_eq($where, $params, 'P.no_kesht', $no_kesht, $empty0);
        if ($mor_cod_m !== '') {
            $where[] = 'P.mor_cod_m = :mor_cod_m';
            $params[':mor_cod_m'] = $mor_cod_m;
        }
        if ($bah_cod_m !== '') {
            $where[] = 'P.bah_cod_m = :bah_cod_m';
            $params[':bah_cod_m'] = $bah_cod_m;
        }
        if ($group_cod !== '') {
            $where[] = 'P.group_cod = :group_cod';
            $params[':group_cod'] = $group_cod;
        }
        if ($mah_cod !== '') {
            $where[] = 'P.mah_cod = :mah_cod';
            $params[':mah_cod'] = $mah_cod;
        }
        if (greenh_num_ok($skb1)) {
            $where[] = 'P.s_kesh >= :skb1';
            $params[':skb1'] = $skb1;
        }
        if (greenh_num_ok($skb2)) {
            $where[] = 'P.s_kesh <= :skb2';
            $params[':skb2'] = $skb2;
        }
        if (greenh_mon_ok($date_1_kesh)) {
            $where[] = 'P.date_1_kesh >= :date_1_kesh';
            $params[':date_1_kesh'] = $date_1_kesh;
        }
        if (greenh_mon_ok($date_2_kesh)) {
            $where[] = 'P.date_2_kesh <= :date_2_kesh';
            $params[':date_2_kesh'] = $date_2_kesh;
        }
        if (greenh_mon_ok($date_1_bar)) {
            $where[] = 'P.date_1_bar >= :date_1_bar';
            $params[':date_1_bar'] = $date_1_bar;
        }
        if (greenh_mon_ok($date_2_bar)) {
            $where[] = 'P.date_2_bar <= :date_2_bar';
            $params[':date_2_bar'] = $date_2_bar;
        }
        if (greenh_num_ok($mtol1)) {
            $where[] = 'P.m_tol >= :mtol1';
            $params[':mtol1'] = $mtol1;
        }
        if (greenh_num_ok($mtol2)) {
            $where[] = 'P.m_tol <= :mtol2';
            $params[':mtol2'] = $mtol2;
        }
        $sqlWhere = implode(' AND ', $where);
        $query = "SELECT P.unit_id, P.y_prod, P.num_bah, P.mah_cod, P.m_tol, P.date_1_kesh, P.date_2_kesh,
                         P.date_1_bar, P.date_2_bar, P.s_kesh, P.no_kesht, P.bah_cod_m,
                         bah.name, bah.Last_name AS last_name, product_G.mah_name
                  FROM Greenprod_annual P
                  LEFT JOIN bah ON P.bah_cod_m = bah.bah_cod_m AND P.num_bah = bah.num_bah
                  LEFT JOIN (
                      SELECT mah_cod, MIN(mah_name) AS mah_name
                      FROM product_G
                      GROUP BY mah_cod
                  ) product_G ON product_G.mah_cod = P.mah_cod
                  WHERE $sqlWhere
                  ORDER BY P.bah_cod_m ASC
                  LIMIT $start, $limit";
        $query1 = "SELECT COUNT(*) FROM Greenprod_annual P WHERE $sqlWhere";
        $stmt = $dbh->prepare($query);
        $stmt->execute($params);
        $rows_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $t_row = count($rows_list);
        if ($t_row > 0) {
?>
        <section class="agri1-card agri1-card-results" aria-label="نتایج جستجو">
            <div class="agri1-results-toolbar">
                <div class="agri1-col-picker" id="agri1-col-picker">
                    <button type="button" class="agri1-btn agri1-btn-ghost agri1-col-picker-btn" id="agri1-col-picker-btn" aria-expanded="false" aria-controls="agri1-col-panel">
                        <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                            <path d="M9 4v16"></path>
                            <path d="M15 4v16"></path>
                        </svg>
                        <span class="agri1-col-picker-label">ستون‌ها</span>
                    </button>
                    <div id="agri1-col-panel" class="agri1-col-panel" role="group" aria-labelledby="agri1-col-panel-title">
                        <div class="agri1-col-panel-head">
                            <strong id="agri1-col-panel-title">نمایش ستون‌ها</strong>
                            <button type="button" class="agri1-col-reset" id="agri1-col-reset">نمایش همه</button>
                        </div>
                        <ul class="agri1-col-list">
                            <li><label><input type="checkbox" data-col-toggle="ops" checked/> عملیات</label></li>
                            <li><label><input type="checkbox" data-col-toggle="product" checked/> نام محصول</label></li>
                            <li><label><input type="checkbox" data-col-toggle="m_tol" checked/> میزان تولید</label></li>
                            <li><label><input type="checkbox" data-col-toggle="date_2_bar" checked/> پایان برداشت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="date_1_bar" checked/> شروع برداشت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="date_2_kesh" checked/> پایان کشت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="date_1_kesh" checked/> شروع کشت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="s_kesh" checked/> سطح زیر کشت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="no_kesht" checked/> نوع کاشت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="bah_cod_m" checked/> کد ملی بهره‌بردار</label></li>
                            <li><label><input type="checkbox" data-col-toggle="name" checked/> نام و نام خانوادگی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="rownum" checked/> ردیف</label></li>
                        </ul>
                    </div>
                </div>
                <form action="Greenh_rep170_xls.php" method="post" class="agri1-xls">
                    <?php
                    greenh_hiddens(array(
                        'id_ostan' => $id_ostan1,
                        'id_city' => $id_city,
                        'id_mar' => $id_mar,
                        'add_abadi' => $add_abadi,
                        'add_city' => $add_city,
                        'no_kesht' => $no_kesht,
                        'y_prod' => $y_prod,
                        'skb1' => $skb1,
                        'skb2' => $skb2,
                        'mor_cod_m' => $mor_cod_m,
                        'bah_cod_m' => $bah_cod_m,
                        'date_1_kesh' => $date_1_kesh,
                        'date_2_kesh' => $date_2_kesh,
                        'date_1_bar' => $date_1_bar,
                        'date_2_bar' => $date_2_bar,
                        'mtol1' => $mtol1,
                        'mtol2' => $mtol2,
                        'group_cod' => $group_cod,
                        'mah_cod' => $mah_cod
                    ));
                    ?>
                    <button type="submit"><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل" width="44" height="40" alt="دانلود فایل اکسل"/></button>
                </form>
            </div>
            <p class="agri1-table-hint">برای مشاهده همه ستون‌ها جدول را افقی بکشید.</p>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <thead>
                        <tr>
                            <th class="agri1-ops-col" data-col="ops" rowspan="3">عملیات</th>
                            <th data-col="product" rowspan="3">نام محصول</th>
                            <th data-col="m_tol" rowspan="3">میزان تولید</th>
                            <th data-col-group="harvest" colspan="2" rowspan="2">زمان برداشت</th>
                            <th data-col-group="plant" colspan="2" rowspan="2">زمان کشت</th>
                            <th data-col="s_kesh" rowspan="3">سطح زیر کشت<br/>مترمربع</th>
                            <th data-col="no_kesht" rowspan="3">نوع کاشت</th>
                            <th data-col-group="spec" colspan="2">مشخصات بهره‌بردار</th>
                            <th data-col="rownum" rowspan="3">ردیف</th>
                        </tr>
                        <tr>
                            <th data-col="bah_cod_m" rowspan="2">کد ملی</th>
                            <th data-col="name" rowspan="2">نام و نام خانوادگی</th>
                        </tr>
                        <tr>
                            <th data-col="date_2_bar">پایان</th>
                            <th data-col="date_1_bar">شروع</th>
                            <th data-col="date_2_kesh">پایان</th>
                            <th data-col="date_1_kesh">شروع</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $r = $start + 1;
                    foreach ($rows_list as $row) {
                    ?>
                        <tr>
                            <td class="agri1-ops" data-col="ops">
                                <div class="agri1-ops-bar">
                                    <form action="Greenh_prod_view.php" method="post" onsubmit="target_popup3(this)">
                                        <input type="hidden" name="unit_id" value="<?php echo agri2_h($row['unit_id']); ?>"/>
                                        <input type="hidden" name="y_prod" value="<?php echo agri2_h($row['y_prod']); ?>"/>
                                        <input type="hidden" name="num_bah" value="<?php echo agri2_h($row['num_bah']); ?>"/>
                                        <button type="submit" class="agri1-ops-btn" title="نمایش اطلاعات بهره برداری" aria-label="نمایش اطلاعات بهره برداری"><?php echo greenh_ops_svg('view'); ?></button>
                                    </form>
                                </div>
                            </td>
                            <td class="agri1-name-col" data-col="product"><?php echo agri2_h(isset($row['mah_name']) ? $row['mah_name'] : ''); ?></td>
                            <td data-col="m_tol"><?php echo agri2_h(round($row['m_tol'], 4) * 1); ?></td>
                            <td data-col="date_2_bar"><?php echo agri2_h(greenh_label_month($row['date_2_bar'])); ?></td>
                            <td data-col="date_1_bar"><?php echo agri2_h(greenh_label_month($row['date_1_bar'])); ?></td>
                            <td data-col="date_2_kesh"><?php echo agri2_h(greenh_label_month($row['date_2_kesh'])); ?></td>
                            <td data-col="date_1_kesh"><?php echo agri2_h(greenh_label_month($row['date_1_kesh'])); ?></td>
                            <td data-col="s_kesh"><?php echo agri2_h($row['s_kesh'] + 0); ?></td>
                            <td data-col="no_kesht"><?php echo agri2_h(greenh_label_no_kesht($row['no_kesht'])); ?></td>
                            <td data-col="bah_cod_m" dir="ltr"><?php echo agri2_h($row['bah_cod_m']); ?></td>
                            <td class="agri1-name-col" data-col="name"><?php echo agri2_h(trim((isset($row['last_name']) ? $row['last_name'] : '') . ' ' . (isset($row['name']) ? $row['name'] : ''))); ?></td>
                            <td data-col="rownum"><?php echo (int) $r; ?></td>
                        </tr>
                    <?php
                        $r++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </section>
<?php
        } else {
            echo '<p class="agri1-note">اطلاعاتی یافت نشد</p>';
        }
    }
}
       
        if ($query1 !== '') {
            $stmt1 = $dbh->prepare($query1);
            $stmt1->execute($params);
            $rows_n = $stmt1->fetchColumn();
            $total = ceil($rows_n / $limit);
            if ($rows_n > 0) {
                $visible_pages = 3;
                $start_page = max(1, $id - $visible_pages);
                $end_page = min($total, $id + $visible_pages);
                $show_first = ($start_page > 1);
                $show_last = ($end_page < $total);
        ?>
        <nav class="agri1-pager" aria-label="صفحه‌بندی">
            <ul class="agri1-pager-list">
                <?php if ($id > 1) { ?>
                <li>
                    <form action="Greenh_rep170.php?id=<?php echo (int) $id - 1; ?>#1" method="post">
                        <?php greenh170_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $no_kesht, $y_prod, $skb1, $skb2, $mor_cod_m, $date_1_kesh, $date_2_kesh, $date_1_bar, $date_2_bar, $mtol1, $mtol2, $group_cod, $mah_cod); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="Greenh_rep170.php?id=1#1" method="post">
                        <?php greenh170_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $no_kesht, $y_prod, $skb1, $skb2, $mor_cod_m, $date_1_kesh, $date_2_kesh, $date_1_bar, $date_2_bar, $mtol1, $mtol2, $group_cod, $mah_cod); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en">1</button>
                    </form>
                </li>
                    <?php if ($start_page > 2) { ?>
                <li><span class="agri1-pager-ellipsis">...</span></li>
                    <?php } ?>
                <?php } ?>
                <?php for ($i = $start_page; $i <= $end_page; $i++) { ?>
                <li>
                    <?php if ($i == $id) { ?>
                    <span class="agri1-pager-btn is-current is-num" lang="en"><?php echo (int) $i; ?></span>
                    <?php } else { ?>
                    <form action="Greenh_rep170.php?id=<?php echo (int) $i; ?>#1" method="post">
                        <?php greenh170_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $no_kesht, $y_prod, $skb1, $skb2, $mor_cod_m, $date_1_kesh, $date_2_kesh, $date_1_bar, $date_2_bar, $mtol1, $mtol2, $group_cod, $mah_cod); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int) $i; ?></button>
                    </form>
                    <?php } ?>
                </li>
                <?php } ?>
                <?php if ($show_last) { ?>
                    <?php if ($end_page < $total - 1) { ?>
                <li><span class="agri1-pager-ellipsis">...</span></li>
                    <?php } ?>
                <li>
                    <form action="Greenh_rep170.php?id=<?php echo (int) $total; ?>#1" method="post">
                        <?php greenh170_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $no_kesht, $y_prod, $skb1, $skb2, $mor_cod_m, $date_1_kesh, $date_2_kesh, $date_1_bar, $date_2_bar, $mtol1, $mtol2, $group_cod, $mah_cod); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int) $total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($id != $total && $total > 0) { ?>
                <li>
                    <form action="Greenh_rep170.php?id=<?php echo (int) $id + 1; ?>#1" method="post">
                        <?php greenh170_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $no_kesht, $y_prod, $skb1, $skb2, $mor_cod_m, $date_1_kesh, $date_2_kesh, $date_1_bar, $date_2_bar, $mtol1, $mtol2, $group_cod, $mah_cod); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="Greenh_rep170.php" method="post">
                    <?php greenh170_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $no_kesht, $y_prod, $skb1, $skb2, $mor_cod_m, $date_1_kesh, $date_2_kesh, $date_1_bar, $date_2_bar, $mtol1, $mtol2, $group_cod, $mah_cod); ?>
                    <span>به صفحه</span>
                    <input type="text" inputmode="numeric" lang="en" dir="ltr" id="pageIdInput" name="page_input" value="<?php echo (int) $id; ?>" placeholder="1"/>
                    <button type="submit" class="agri1-pager-btn is-nav">برو</button>
                </form>
            </div>
        </nav>
        <script>
        (function () {
            var input = document.getElementById('pageIdInput');
            var form = document.getElementById('pageJumpForm');
            if (!input || !form) return;
            function toLatinDigits(v) {
                var fa = '۰۱۲۳۴۵۶۷۸۹';
                var ar = '٠١٢٣٤٥٦٧٨٩';
                return String(v).replace(/[۰-۹٠-٩]/g, function (ch) {
                    var i = fa.indexOf(ch);
                    if (i > -1) return String(i);
                    i = ar.indexOf(ch);
                    return i > -1 ? String(i) : ch;
                }).replace(/[^\d]/g, '');
            }
            input.addEventListener('input', function () {
                this.value = toLatinDigits(this.value);
            });
            form.addEventListener('submit', function (e) {
                var pageId = parseInt(toLatinDigits(input.value), 10);
                input.value = isNaN(pageId) ? '' : String(pageId);
                if (!isNaN(pageId) && pageId >= 1 && pageId <= <?php echo (int) $total; ?>) {
                    this.action = 'Greenh_rep170.php?id=' + pageId + '#1';
                } else {
                    e.preventDefault();
                    alert('لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo (int) $total; ?> وارد کنید.');
                }
            });
        })();
        </script>
        <?php
            }
        }
        ?>

        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="index.php" title="برگشت به صفحه قبل">
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

    <script>
        (function () {
            var form = document.getElementById('reg-form');
            var overlay = document.getElementById('agri1-overlay');
            var submitBtn = document.getElementById('action');
            if (!form) return;
            form.addEventListener('submit', function () {
                if (overlay) overlay.className = 'agri1-overlay is-open';
                if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
            });
        })();
        (function () {
            var form = document.getElementById('reg-form');
            if (!form) return;
            var openWrap = null;

            function optionText(opt) {
                return String(opt.text || '').replace(/^\s+|\s+$/g, '');
            }

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

            function setActive(list, index) {
                var items = list.querySelectorAll('.agri1-select-option');
                var i;
                for (i = 0; i < items.length; i++) {
                    items[i].classList.remove('is-active');
                }
                if (index < 0 || index >= items.length) return;
                items[index].classList.add('is-active');
                if (items[index].id) list.setAttribute('aria-activedescendant', items[index].id);
                if (items[index].scrollIntoView) {
                    items[index].scrollIntoView({ block: 'nearest' });
                }
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
                btn.innerHTML = '<span class="agri1-select-label"></span><svg class="agri1-icon agri1-select-caret" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>';
                var labelEl = btn.querySelector('.agri1-select-label');
                labelEl.id = listId + '-value';
                if (select.id) {
                    var fieldLab = form.querySelector('label[for="' + select.id + '"]');
                    if (fieldLab) {
                        if (!fieldLab.id) fieldLab.id = select.id + '-lbl';
                        btn.setAttribute('aria-labelledby', fieldLab.id + ' ' + labelEl.id);
                    }
                }

                var list = document.createElement('ul');
                list.id = listId;
                list.className = 'agri1-select-list agri1-combo-list';
                list.setAttribute('role', 'listbox');
                list.setAttribute('tabindex', '-1');

                wrap.appendChild(btn);
                wrap.appendChild(list);
                wrap.classList.add('is-enhanced');
                if (select.disabled) {
                    btn.disabled = true;
                }

                function currentIndex() {
                    return select.selectedIndex < 0 ? 0 : select.selectedIndex;
                }

                function syncFromSelect() {
                    var opt = select.options[currentIndex()];
                    labelEl.textContent = opt ? optionText(opt) : '';
                    var items = list.querySelectorAll('.agri1-select-option');
                    var i;
                    for (i = 0; i < items.length; i++) {
                        var on = items[i].getAttribute('data-index') === String(currentIndex());
                        items[i].classList.toggle('is-selected', on);
                        items[i].setAttribute('aria-selected', on ? 'true' : 'false');
                    }
                }

                function buildList() {
                    list.innerHTML = '';
                    var i;
                    for (i = 0; i < select.options.length; i++) {
                        var opt = select.options[i];
                        var li = document.createElement('li');
                        li.className = 'agri1-select-option agri1-combo-option';
                        li.setAttribute('role', 'option');
                        li.id = listId + '-opt-' + i;
                        li.setAttribute('data-index', String(i));
                        li.textContent = optionText(opt);
                        list.appendChild(li);
                    }
                    syncFromSelect();
                }

                function choose(index) {
                    if (index < 0 || index >= select.options.length) return;
                    select.selectedIndex = index;
                    syncFromSelect();
                    if (typeof Event === 'function') {
                        select.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                    closeWrap(wrap);
                    btn.focus();
                }

                function open() {
                    if (select.disabled) return;
                    closeAll();
                    buildList();
                    wrap.classList.add('is-open');
                    btn.setAttribute('aria-expanded', 'true');
                    openWrap = wrap;
                    setActive(list, currentIndex());
                }

                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (wrap.classList.contains('is-open')) closeWrap(wrap);
                    else open();
                });
                list.addEventListener('click', function (e) {
                    e.stopPropagation();
                    var t = e.target;
                    while (t && t !== list && (!t.getAttribute || t.getAttribute('data-index') == null)) {
                        t = t.parentNode;
                    }
                    if (!t || t === list) return;
                    choose(parseInt(t.getAttribute('data-index'), 10));
                });
                btn.addEventListener('keydown', function (e) {
                    var key = e.key;
                    var openNow = wrap.classList.contains('is-open');
                    if (key === 'ArrowDown' || key === 'ArrowUp' || key === 'Enter' || key === ' ') {
                        e.preventDefault();
                        if (!openNow) {
                            open();
                            if (key === 'ArrowUp') setActive(list, select.options.length - 1);
                            return;
                        }
                        var items = list.querySelectorAll('.agri1-select-option');
                        var cur = -1;
                        for (var i = 0; i < items.length; i++) {
                            if (items[i].classList.contains('is-active')) cur = i;
                        }
                        if (cur < 0) cur = currentIndex();
                        if (key === 'Enter' || key === ' ') {
                            choose(cur);
                            return;
                        }
                        if (key === 'ArrowDown') cur = Math.min(items.length - 1, cur + 1);
                        if (key === 'ArrowUp') cur = Math.max(0, cur - 1);
                        setActive(list, cur);
                    } else if (key === 'Home' && openNow) {
                        e.preventDefault();
                        setActive(list, 0);
                    } else if (key === 'End' && openNow) {
                        e.preventDefault();
                        setActive(list, select.options.length - 1);
                    } else if (key === 'Escape' && openNow) {
                        e.preventDefault();
                        closeWrap(wrap);
                    }
                });
                select.addEventListener('focus', function () {
                    btn.focus();
                });
                select.addEventListener('change', syncFromSelect);
                select._agri1Rebuild = buildList;
                buildList();
            }

            var selects = form.querySelectorAll('select');
            for (var s = 0; s < selects.length; s++) enhance(selects[s]);

            document.addEventListener('click', function () {
                closeAll();
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeAll();
            });
        })();
        (function () {
            var picker = document.getElementById('agri1-col-picker');
            var btn = document.getElementById('agri1-col-picker-btn');
            var panel = document.getElementById('agri1-col-panel');
            var table = document.querySelector('.agri1-table');
            if (!picker || !btn || !panel || !table) return;

            var KEY = 'Greenh_rep170_hidden_cols';
            var GROUP = { harvest: ['date_2_bar', 'date_1_bar'], plant: ['date_2_kesh', 'date_1_kesh'], spec: ['bah_cod_m', 'name'] };

            function readHidden() {
                try {
                    var raw = localStorage.getItem(KEY);
                    var arr = raw ? JSON.parse(raw) : [];
                    if (!Array.isArray(arr)) return {};
                    var map = {};
                    for (var i = 0; i < arr.length; i++) map[arr[i]] = true;
                    return map;
                } catch (e) {
                    return {};
                }
            }

            function writeHidden(map) {
                var arr = [];
                for (var k in map) {
                    if (Object.prototype.hasOwnProperty.call(map, k) && map[k]) arr.push(k);
                }
                try { localStorage.setItem(KEY, JSON.stringify(arr)); } catch (e) {}
            }

            function allIds() {
                var nodes = table.querySelectorAll('thead [data-col]');
                var ids = [];
                var seen = {};
                for (var i = 0; i < nodes.length; i++) {
                    var id = nodes[i].getAttribute('data-col');
                    if (id && !seen[id]) {
                        seen[id] = true;
                        ids.push(id);
                    }
                }
                return ids;
            }

            function visibleCount(map) {
                var ids = allIds();
                var n = 0;
                for (var i = 0; i < ids.length; i++) {
                    if (!map[ids[i]]) n++;
                }
                return n;
            }

            function apply(map) {
                var cells = table.querySelectorAll('[data-col]');
                for (var i = 0; i < cells.length; i++) {
                    var id = cells[i].getAttribute('data-col');
                    if (map[id]) cells[i].classList.add('is-col-hidden');
                    else cells[i].classList.remove('is-col-hidden');
                }
                var groupThs = table.querySelectorAll('[data-col-group]');
                for (var g = 0; g < groupThs.length; g++) {
                    var groupId = groupThs[g].getAttribute('data-col-group');
                    var kids = GROUP[groupId] || [];
                    var vis = 0;
                    for (var j = 0; j < kids.length; j++) {
                        if (!map[kids[j]]) vis++;
                    }
                    if (vis === 0) {
                        groupThs[g].classList.add('is-col-hidden');
                    } else {
                        groupThs[g].classList.remove('is-col-hidden');
                        groupThs[g].colSpan = vis;
                    }
                }
                var boxes = panel.querySelectorAll('input[type="checkbox"][data-col-toggle]');
                for (var b = 0; b < boxes.length; b++) {
                    boxes[b].checked = !map[boxes[b].getAttribute('data-col-toggle')];
                }
                var hiddenCount = 0;
                var ids = allIds();
                for (var n = 0; n < ids.length; n++) {
                    if (map[ids[n]]) hiddenCount++;
                }
                var label = btn.querySelector('.agri1-col-picker-label');
                if (label) {
                    label.textContent = hiddenCount > 0 ? ('ستون‌ها (' + hiddenCount + ' پنهان)') : 'ستون‌ها';
                }
            }

            var hidden = readHidden();
            apply(hidden);

            function openPanel() {
                picker.classList.add('is-open');
                btn.setAttribute('aria-expanded', 'true');
            }
            function closePanel() {
                picker.classList.remove('is-open');
                btn.setAttribute('aria-expanded', 'false');
            }

            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                if (picker.classList.contains('is-open')) closePanel();
                else openPanel();
            });
            panel.addEventListener('click', function (e) {
                e.stopPropagation();
            });
            document.addEventListener('click', function () {
                closePanel();
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && picker.classList.contains('is-open')) {
                    closePanel();
                    btn.focus();
                }
            });
            panel.addEventListener('change', function (e) {
                var t = e.target;
                if (!t || t.getAttribute('data-col-toggle') == null) return;
                var id = t.getAttribute('data-col-toggle');
                if (!t.checked) {
                    hidden[id] = true;
                    if (visibleCount(hidden) < 1) {
                        delete hidden[id];
                        t.checked = true;
                        return;
                    }
                } else {
                    delete hidden[id];
                }
                writeHidden(hidden);
                apply(hidden);
            });
            var resetBtn = document.getElementById('agri1-col-reset');
            if (resetBtn) {
                resetBtn.addEventListener('click', function () {
                    hidden = {};
                    writeHidden(hidden);
                    apply(hidden);
                });
            }
        })();
    </script>

</body>
</html>
