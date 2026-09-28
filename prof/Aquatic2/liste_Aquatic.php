<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../login/config.php');

$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city  = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_fa     = isset($_POST['no_fa']) ? $_POST['no_fa'] : '';
$no_mal    = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
$sal       = isset($_POST['sal']) ? $_POST['sal'] : '';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 1;
if (isset($_POST['action']) && (string) $_POST['action'] !== '1') {
    $id = 1;
}
if ($id < 1) {
    $id = 1;
}
$limit = 10;
$start = ($id - 1) * $limit;
$query1 = '';
$total = 0;
$found = 0;
$rows_count = 0;
$stmt = null;
$list_rows = array();
$did_search = isset($_POST['action']);
if ($did_search && ($sal === '' || $sal === '0')) {
    $sal = '1404';
}

if (!function_exists('agri2_h')) {
    function agri2_h($v)
    {
        if (!isset($v)) {
            return '';
        }
        return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
    }
}

function liste_aquatic_ops_svg($name)
{
    $d = array(
        'view' => '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>',
        'edit' => '<path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>',
        'del' => '<path d="M4 7h16"/><path d="M9 7V4h6v3"/><path d="M6 7l1 14h10l1-14"/><path d="M10 11v6"/><path d="M14 11v6"/>'
    );
    $p = isset($d[$name]) ? $d[$name] : '';
    return '<svg class="agri1-icon" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true">' . $p . '</svg>';
}

function liste_aquatic_filter_hiddens($add_abadi, $add_city, $no_mal, $no_fa, $sal)
{
    $pairs = array(
        'action' => '1',
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'no_mal' => $no_mal,
        'no_fa' => $no_fa,
        'sal' => $sal
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

function liste_aquatic_label($map, $v)
{
    $k = (string) $v;
    return isset($map[$k]) ? $map[$k] : '';
}

function liste_aquatic_filled($v)
{
    return $v !== '' && $v !== '0' && $v !== 0;
}

$no_fa_map = array(
    '1' => 'تکثیر',
    '2' => 'پرورش',
    '3' => 'تکثیر و پرورش'
);
$g_tol_map = array(
    '1' => 'مجتمع',
    '2' => 'منفرد',
    '3' => 'مداربسته',
    '4' => 'دو منظوره',
    '5' => 'شالیزار',
    '6' => 'قفش',
    '7' => 'پن',
    '8' => 'آب بندان',
    '9' => 'منابع آبی',
    '10' => 'سایر موارد'
);
$m_ab_map = array(
    '1' => 'رودخانه',
    '2' => 'چاه',
    '3' => 'قنات و چشمه',
    '4' => 'آب بندان',
    '5' => 'خور و دریا',
    '6' => 'دریاچه',
    '7' => 'سایرمنابع'
);
$no_mal_opts = array(
    '1' => 'سند ششدانگ',
    '2' => 'سند مشاعی',
    '3' => 'اصلاحات اراضی',
    '4' => 'موقوفه',
    '5' => 'واگذاری',
    '6' => 'قولنامه',
    '7' => 'اجاره'
);

$page_title = (isset($title) && $title !== '') ? $title : 'لیست مزارع تکثیر و پرورش';
$pahneh_crumb_title = 'لیست مزارع تکثیر و پرورش';

$abadi_rows = array();
$city_rows = array();
$opt_abadi = $dbh->prepare('SELECT add_abadi, abadi FROM list_abadi WHERE mor_cod_m = :login');
$opt_abadi->execute(array(':login' => $login_session));
$abadi_rows = $opt_abadi->fetchAll(PDO::FETCH_ASSOC);
$opt_city = $dbh->prepare('SELECT add_city, shahr FROM list_city WHERE mor_cod_m = :login');
$opt_city->execute(array(':login' => $login_session));
$city_rows = $opt_city->fetchAll(PDO::FETCH_ASSOC);

$sal_ok = preg_match('/^\d{4}$/', $sal);
$use_aquatic2 = ($sal_ok && (int) $sal > 1403);
$table = $use_aquatic2 ? 'Aquatic2' : 'Aquatic';

if ($did_search) {
    $where = array('Aq.mor_cod_m = :mor_cod_m');
    $params = array(':mor_cod_m' => $login_session);
    if (liste_aquatic_filled($add_abadi)) {
        $where[] = 'Aq.add_abadi = :add_abadi';
        $params[':add_abadi'] = $add_abadi;
    }
    if (liste_aquatic_filled($add_city)) {
        $where[] = 'Aq.add_city = :add_city';
        $params[':add_city'] = $add_city;
    }
    if (liste_aquatic_filled($no_mal)) {
        $where[] = 'Aq.no_mal = :no_mal';
        $params[':no_mal'] = $no_mal;
    }
    if (liste_aquatic_filled($no_fa)) {
        $where[] = 'Aq.no_fa = :no_fa';
        $params[':no_fa'] = $no_fa;
    }
    if ($sal_ok) {
        $where[] = 'Aq.sal = :sal';
        $params[':sal'] = $sal;
    }
    $sqlWhere = implode(' AND ', $where);
    $query1 = "SELECT COUNT(*) FROM `$table` Aq WHERE $sqlWhere";
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute($params);
    $rows_count = (int) $stmt1->fetchColumn();
    $total = $limit > 0 ? (int) ceil($rows_count / $limit) : 0;
    if ($total > 0 && $id > $total) {
        $id = $total;
    }
    $start = ($id - 1) * $limit;
    if ($start < 0) {
        $start = 0;
    }
    $sql = "SELECT Aq.id, Aq.bah_cod_m, Aq.num_bah, Aq.mor_cod_m, Aq.add_abadi, Aq.add_city,
                   Aq.id_city, Aq.id_ostan, Aq.no_fa, Aq.no_mal, Aq.sal, Aq.g_tol, Aq.m_ab, Aq.m_zamin,
                   bah.name AS bah_name, bah.Last_name AS bah_last,
                   list_abadi.abadi, list_city.shahr, cityname.city
            FROM `$table` Aq
            LEFT JOIN bah ON Aq.bah_cod_m = bah.bah_cod_m AND Aq.num_bah = bah.num_bah
            LEFT JOIN list_abadi ON list_abadi.add_abadi = Aq.add_abadi AND list_abadi.mor_cod_m = Aq.mor_cod_m
            LEFT JOIN list_city ON list_city.add_city = Aq.add_city AND list_city.mor_cod_m = Aq.mor_cod_m
            LEFT JOIN cityname ON cityname.id_city = Aq.id_city AND cityname.id_ostan = Aq.id_ostan
            WHERE $sqlWhere
            ORDER BY Aq.mor_cod_m ASC, Aq.bah_cod_m ASC
            LIMIT $start, $limit";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $list_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $found = count($list_rows);
}

$xls_action = ($sal === '1404') ? 'Aquatic2_xls.php' : 'Aquatic_xls.php';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo agri2_h($page_title); ?></title>
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
        .agri1-hero { margin-bottom: var(--space-3); }
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
        .agri1-card-results { padding: 12px 8px; }
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
        .agri1-card-search .agri1-grid { gap: 10px 12px; }
        .agri1-card-search .agri1-label {
            margin-bottom: 4px;
            font-size: 0.875rem;
        }
        .agri1-page .agri1-card-search .agri1-form input[type="text"],
        .agri1-page .agri1-card-search .agri1-form input[type="number"],
        .agri1-page .agri1-card-search .agri1-form select {
            min-height: 36px;
            padding: 6px 10px;
        }
        .agri1-page .agri1-card-search .agri1-form select { padding-left: 32px; }
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
            text-align: center;
        }
        .agri1-note {
            margin: 0 0 var(--space-3);
            padding: 12px 14px;
            border-radius: 10px;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            color: #1D4ED8;
        }
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
        .agri1-select-option.is-active { background: #ECFDF3; }
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
            justify-content: center;
            align-items: center;
            margin: 0 0 12px;
        }
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
        .agri1-results-toolbar .agri1-col-picker { justify-self: start; }
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
        .agri1-col-list { list-style: none; margin: 0; padding: 0; }
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
        .agri1-table .is-col-hidden { display: none !important; }
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
            white-space: normal;
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
        }
        .agri1-table tbody tr:nth-child(even) td { background: var(--color-background); }
        .agri1-table tbody tr:hover td { background: #ECFDF3; }
        .agri1-table th.agri1-ops-col,
        .agri1-table td.agri1-ops {
            width: 48px;
            padding: 4px 3px;
            white-space: nowrap;
        }
        .agri1-table .agri1-name-col {
            white-space: normal;
            overflow: visible;
            text-overflow: clip;
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
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
        .agri1-ops-btn .agri1-icon { width: 16px; height: 16px; }
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
        .agri1-pager-jump span { font-size: 13px; }
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
    </style>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#reg-form">رفتن به فرم جستجو</a>
    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>
    <?php include(__DIR__ . '/../../chrome.php'); ?>
    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="liste-title">لیست مزارع تکثیر و پرورش آبزیان</h1>
        </header>
        <section class="agri1-card agri1-card-search" aria-labelledby="liste-title">
            <form id="reg-form" class="agri1-form" method="post" action="#1" novalidate>
                <h2 class="agri1-card-title">جستجو</h2>
                <div class="agri1-grid">
                    <div class="agri1-field">
                        <label class="agri1-label" for="sal">سال</label>
                        <select name="sal" id="sal">
<?php for ($y = 1404; $y >= 1395; $y--) { ?>
                            <option value="<?php echo (int) $y; ?>"<?php if ((string) $sal === (string) $y || ($sal === '' && $y === 1404)) echo ' selected="selected"'; ?>><?php echo (int) $y; ?></option>
<?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_city">نام شهر</label>
                        <select name="add_city" id="add_city" dir="rtl">
                            <option value="0">انتخاب کنید</option>
<?php foreach ($city_rows as $opt) { ?>
                            <option value="<?php echo agri2_h($opt['add_city']); ?>"<?php if ((string) $opt['add_city'] === (string) $add_city) echo ' selected="selected"'; ?>><?php echo agri2_h($opt['shahr']); ?></option>
<?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_abadi">نام آبادی</label>
                        <select name="add_abadi" id="add_abadi" dir="rtl">
                            <option value="0">انتخاب کنید</option>
<?php foreach ($abadi_rows as $opt) { ?>
                            <option value="<?php echo agri2_h($opt['add_abadi']); ?>"<?php if ((string) $opt['add_abadi'] === (string) $add_abadi) echo ' selected="selected"'; ?>><?php echo agri2_h($opt['abadi']); ?></option>
<?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="no_fa">نوع فعالیت</label>
                        <select name="no_fa" id="no_fa">
                            <option value="0">انتخاب کنید</option>
<?php foreach ($no_fa_map as $k => $lab) { ?>
                            <option value="<?php echo agri2_h($k); ?>"<?php if ((string) $no_fa === (string) $k) echo ' selected="selected"'; ?>><?php echo agri2_h($lab); ?></option>
<?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="no_mal">نوع مالکیت</label>
                        <select name="no_mal" id="no_mal">
                            <option value="0">انتخاب کنید</option>
<?php foreach ($no_mal_opts as $k => $lab) { ?>
                            <option value="<?php echo agri2_h($k); ?>"<?php if ((string) $no_mal === (string) $k) echo ' selected="selected"'; ?>><?php echo agri2_h($lab); ?></option>
<?php } ?>
                        </select>
                    </div>
                </div>
                <div class="agri1-actions">
                    <button type="submit" class="agri1-btn agri1-btn-primary" name="action" id="action" value="جستجو">جستجو</button>
                </div>
                <p class="agri1-hint">برای مشاهده لیست کلیه بهره‌برداری‌ها جستجو را بدون انتخاب فیلتر بزنید</p>
            </form>
        </section>
        <a name="1" id="1"></a>
<?php if ($did_search) { ?>
<?php if ($found > 0) { ?>
        <section class="agri1-card agri1-card-results" aria-label="نتایج جستجو">
            <div class="agri1-results-toolbar">
                <div class="agri1-col-picker" id="agri1-col-picker">
                    <button type="button" class="agri1-btn agri1-btn-ghost agri1-col-picker-btn" id="agri1-col-picker-btn" aria-expanded="false" aria-controls="agri1-col-panel">
                        <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"></rect><path d="M9 4v16"></path><path d="M15 4v16"></path></svg>
                        <span class="agri1-col-picker-label">ستون‌ها</span>
                    </button>
                    <div id="agri1-col-panel" class="agri1-col-panel" role="group">
                        <div class="agri1-col-panel-head">
                            <strong>نمایش ستون‌ها</strong>
                            <button type="button" class="agri1-col-reset" id="agri1-col-reset">نمایش همه</button>
                        </div>
                        <ul class="agri1-col-list">
                            <li><label><input type="checkbox" data-col-toggle="ops_del" checked/> حذف</label></li>
                            <li><label><input type="checkbox" data-col-toggle="ops_edit" checked/> ویرایش</label></li>
                            <li><label><input type="checkbox" data-col-toggle="ops_view" checked/> نمایش</label></li>
                            <li><label><input type="checkbox" data-col-toggle="m_zamin" checked/> مساحت زمین</label></li>
                            <li><label><input type="checkbox" data-col-toggle="m_ab" checked/> منبع تامین آب</label></li>
                            <li><label><input type="checkbox" data-col-toggle="g_tol" checked/> قالب تولید</label></li>
                            <li><label><input type="checkbox" data-col-toggle="no_fa" checked/> نوع فعالیت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="sal" checked/> سال</label></li>
                            <li><label><input type="checkbox" data-col-toggle="bah_cod_m" checked/> کد ملی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="name" checked/> نام و نام خانوادگی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="abadi" checked/> شهر/آبادی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="city" checked/> شهرستان</label></li>
                            <li><label><input type="checkbox" data-col-toggle="rownum" checked/> ردیف</label></li>
                        </ul>
                    </div>
                </div>
                <form class="agri1-xls" action="<?php echo agri2_h($xls_action); ?>" method="post">
                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
                    <input type="hidden" name="add_city" value="<?php echo agri2_h($add_city); ?>"/>
                    <input type="hidden" name="no_mal" value="<?php echo agri2_h($no_mal); ?>"/>
                    <input type="hidden" name="no_fa" value="<?php echo agri2_h($no_fa); ?>"/>
                    <input type="hidden" name="sal" value="<?php echo agri2_h($sal); ?>"/>
                    <input type="hidden" name="mor_cod_m" value="<?php echo agri2_h($login_session); ?>"/>
                    <button type="submit" title="دانلود فایل اکسل" aria-label="دانلود فایل اکسل">
                        <img src="../../files/xls.png" width="44" height="40" alt=""/>
                    </button>
                </form>
            </div>
            <p class="agri1-table-hint">برای مشاهده همه ستون‌ها جدول را افقی بکشید.</p>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <thead>
                        <tr>
                            <th class="agri1-ops-col" data-col-group="ops" colspan="3">عملیات</th>
                            <th data-col="m_zamin" rowspan="2">مساحت زمین<br/>متر مربع</th>
                            <th data-col="m_ab" rowspan="2">منبع تامین آب</th>
                            <th data-col="g_tol" rowspan="2">قالب تولید</th>
                            <th data-col="no_fa" rowspan="2">نوع فعالیت</th>
                            <th data-col="sal" rowspan="2">سال</th>
                            <th data-col-group="bah" colspan="2">مشخصات بهره‌بردار</th>
                            <th data-col-group="loc" colspan="2">موقعیت بهره‌برداری</th>
                            <th data-col="rownum" rowspan="2">ردیف</th>
                        </tr>
                        <tr>
                            <th class="agri1-ops-col" data-col="ops_del">حذف</th>
                            <th class="agri1-ops-col" data-col="ops_edit">ویرایش</th>
                            <th class="agri1-ops-col" data-col="ops_view">نمایش</th>
                            <th data-col="bah_cod_m">کد ملی</th>
                            <th data-col="name">نام و نام خانوادگی</th>
                            <th data-col="abadi">شهر/آبادی</th>
                            <th data-col="city">شهرستان</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
    $r = $start + 1;
    foreach ($list_rows as $row) {
        $v_no_fa = liste_aquatic_label($no_fa_map, isset($row['no_fa']) ? $row['no_fa'] : '');
        $v_g_tol = liste_aquatic_label($g_tol_map, isset($row['g_tol']) ? $row['g_tol'] : '');
        $v_m_ab = liste_aquatic_label($m_ab_map, isset($row['m_ab']) ? $row['m_ab'] : '');
        $bah_full = trim((isset($row['bah_last']) ? $row['bah_last'] : '') . ' ' . (isset($row['bah_name']) ? $row['bah_name'] : ''));
        $bah_full = str_replace('&nbsp;', ' ', $bah_full);
        $place = (isset($row['abadi']) ? $row['abadi'] : '') . (isset($row['shahr']) ? $row['shahr'] : '');
        $can_mutate = (isset($row['sal']) && (string) $row['sal'] === '1404' && isset($row['mor_cod_m']) && (string) $row['mor_cod_m'] === (string) $login_session);
        $view_page = (isset($row['sal']) && (string) $row['sal'] > '1403') ? 'Aquatic_view2.php' : 'Aquatic_view.php';
        $row_m_poul = '';
        if (liste_aquatic_filled(isset($row['add_abadi']) ? $row['add_abadi'] : '')) {
            $row_m_poul = 'abadi';
        } elseif (liste_aquatic_filled(isset($row['add_city']) ? $row['add_city'] : '')) {
            $row_m_poul = 'shahr';
        }
?>
                        <tr>
                            <td class="agri1-ops" data-col="ops_del">
<?php if ($can_mutate) { ?>
                                <form action="del_Aquatic.php" method="post">
                                    <input type="hidden" name="h_add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
                                    <input type="hidden" name="h_add_city" value="<?php echo agri2_h($add_city); ?>"/>
                                    <input type="hidden" name="h_no_fa" value="<?php echo agri2_h($no_fa); ?>"/>
                                    <input type="hidden" name="h_no_mal" value="<?php echo agri2_h($no_mal); ?>"/>
                                    <input type="hidden" name="h_sal" value="<?php echo agri2_h($sal); ?>"/>
                                    <input type="hidden" name="m_page" value="liste_Aquatic.php"/>
                                    <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                    <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>"/>
                                    <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                    <input type="hidden" name="sal" value="<?php echo agri2_h($row['sal']); ?>"/>
                                    <button type="submit" class="agri1-ops-btn agri1-ops-btn-del" title="حذف اطلاعات مزرعه" aria-label="حذف اطلاعات مزرعه" onclick="return confirm('از حذف اطلاعات این مزرعه مطمئن هستید ؟ ')"><?php echo liste_aquatic_ops_svg('del'); ?></button>
                                </form>
<?php } ?>
                            </td>
                            <td class="agri1-ops" data-col="ops_edit">
<?php if ($can_mutate) { ?>
                                <form action="Aquatic_edit.php" method="post">
                                    <input type="hidden" name="h_add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
                                    <input type="hidden" name="h_add_city" value="<?php echo agri2_h($add_city); ?>"/>
                                    <input type="hidden" name="h_no_fa" value="<?php echo agri2_h($no_fa); ?>"/>
                                    <input type="hidden" name="h_no_mal" value="<?php echo agri2_h($no_mal); ?>"/>
                                    <input type="hidden" name="h_sal" value="<?php echo agri2_h($sal); ?>"/>
                                    <input type="hidden" name="m_page" value="liste_Aquatic.php"/>
                                    <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                    <input type="hidden" name="sal" value="<?php echo agri2_h($row['sal']); ?>"/>
                                    <input type="hidden" name="m_poul" value="<?php echo agri2_h($row_m_poul); ?>"/>
                                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                    <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>"/>
                                    <input type="hidden" name="no_fa" value="<?php echo agri2_h($row['no_fa']); ?>"/>
                                    <input type="hidden" name="no_mal" value="<?php echo agri2_h($row['no_mal']); ?>"/>
                                    <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                    <input type="hidden" name="num_bah" value="<?php echo agri2_h($row['num_bah']); ?>"/>
                                    <button type="submit" class="agri1-ops-btn" title="ویرایش اطلاعات بهره برداری" aria-label="ویرایش اطلاعات بهره برداری"><?php echo liste_aquatic_ops_svg('edit'); ?></button>
                                </form>
<?php } ?>
                            </td>
                            <td class="agri1-ops" data-col="ops_view">
                                <form action="<?php echo agri2_h($view_page); ?>" method="post">
                                    <input type="hidden" name="m_page" value="liste_Aquatic.php"/>
                                    <input type="hidden" name="h_add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
                                    <input type="hidden" name="h_add_city" value="<?php echo agri2_h($add_city); ?>"/>
                                    <input type="hidden" name="h_no_fa" value="<?php echo agri2_h($no_fa); ?>"/>
                                    <input type="hidden" name="h_no_mal" value="<?php echo agri2_h($no_mal); ?>"/>
                                    <input type="hidden" name="h_sal" value="<?php echo agri2_h($sal); ?>"/>
                                    <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                    <input type="hidden" name="sal" value="<?php echo agri2_h($row['sal']); ?>"/>
                                    <input type="hidden" name="m_poul" value="<?php echo agri2_h($row_m_poul); ?>"/>
                                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                    <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>"/>
                                    <input type="hidden" name="no_fa" value="<?php echo agri2_h($row['no_fa']); ?>"/>
                                    <input type="hidden" name="no_mal" value="<?php echo agri2_h($row['no_mal']); ?>"/>
                                    <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                    <input type="hidden" name="num_bah" value="<?php echo agri2_h($row['num_bah']); ?>"/>
                                    <button type="submit" class="agri1-ops-btn" title="نمایش اطلاعات بهره برداری" aria-label="نمایش اطلاعات بهره برداری"><?php echo liste_aquatic_ops_svg('view'); ?></button>
                                </form>
                            </td>
                            <td data-col="m_zamin"><?php echo agri2_h(isset($row['m_zamin']) ? $row['m_zamin'] : ''); ?></td>
                            <td data-col="m_ab"><?php echo agri2_h($v_m_ab); ?></td>
                            <td data-col="g_tol"><?php echo agri2_h($v_g_tol); ?></td>
                            <td data-col="no_fa"><?php echo agri2_h($v_no_fa); ?></td>
                            <td data-col="sal" dir="ltr"><?php echo agri2_h(isset($row['sal']) ? $row['sal'] : ''); ?></td>
                            <td data-col="bah_cod_m" dir="ltr"><?php echo agri2_h($row['bah_cod_m']); ?></td>
                            <td class="agri1-name-col" data-col="name"><?php echo agri2_h($bah_full); ?></td>
                            <td class="agri1-name-col" data-col="abadi"><?php echo agri2_h($place); ?></td>
                            <td class="agri1-name-col" data-col="city"><?php echo agri2_h(isset($row['city']) ? $row['city'] : ''); ?></td>
                            <td data-col="rownum" dir="ltr"><?php echo (int) $r; ?></td>
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
    if ($total > 1) {
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
                    <form action="liste_Aquatic.php?id=<?php echo (int) $id - 1; ?>#1" method="post">
                        <?php liste_aquatic_filter_hiddens($add_abadi, $add_city, $no_mal, $no_fa, $sal); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="liste_Aquatic.php?id=1#1" method="post">
                        <?php liste_aquatic_filter_hiddens($add_abadi, $add_city, $no_mal, $no_fa, $sal); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en">1</button>
                    </form>
                </li>
                <?php if ($start_page > 2) { ?><li><span class="agri1-pager-ellipsis">...</span></li><?php } ?>
                <?php } ?>
                <?php for ($i = $start_page; $i <= $end_page; $i++) { ?>
                <li>
                    <?php if ($i == $id) { ?>
                    <span class="agri1-pager-btn is-current is-num" lang="en"><?php echo (int) $i; ?></span>
                    <?php } else { ?>
                    <form action="liste_Aquatic.php?id=<?php echo (int) $i; ?>#1" method="post">
                        <?php liste_aquatic_filter_hiddens($add_abadi, $add_city, $no_mal, $no_fa, $sal); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int) $i; ?></button>
                    </form>
                    <?php } ?>
                </li>
                <?php } ?>
                <?php if ($show_last) { ?>
                <?php if ($end_page < $total - 1) { ?><li><span class="agri1-pager-ellipsis">...</span></li><?php } ?>
                <li>
                    <form action="liste_Aquatic.php?id=<?php echo (int) $total; ?>#1" method="post">
                        <?php liste_aquatic_filter_hiddens($add_abadi, $add_city, $no_mal, $no_fa, $sal); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int) $total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($id != $total && $total > 0) { ?>
                <li>
                    <form action="liste_Aquatic.php?id=<?php echo (int) $id + 1; ?>#1" method="post">
                        <?php liste_aquatic_filter_hiddens($add_abadi, $add_city, $no_mal, $no_fa, $sal); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="liste_Aquatic.php" method="post">
                    <?php liste_aquatic_filter_hiddens($add_abadi, $add_city, $no_mal, $no_fa, $sal); ?>
                    <span>به صفحه</span>
                    <input type="text" inputmode="numeric" lang="en" dir="ltr" id="pageIdInput" name="page_input" value="<?php echo (int) $id; ?>"/>
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
                var fa = '۰۱۲۳۴۵۶۷۸۹'; var ar = '٠١٢٣٤٥٦٧٨٩';
                return String(v).replace(/[۰-۹٠-٩]/g, function (ch) {
                    var i = fa.indexOf(ch); if (i > -1) return String(i);
                    i = ar.indexOf(ch); return i > -1 ? String(i) : ch;
                }).replace(/[^\d]/g, '');
            }
            input.addEventListener('input', function () { this.value = toLatinDigits(this.value); });
            form.addEventListener('submit', function (e) {
                var pageId = parseInt(toLatinDigits(input.value), 10);
                if (!isNaN(pageId) && pageId >= 1 && pageId <= <?php echo (int) $total; ?>) {
                    this.action = 'liste_Aquatic.php?id=' + pageId + '#1';
                } else {
                    e.preventDefault();
                }
            });
        })();
        </script>
<?php
    }
} else {
    echo '<p class="agri1-note">اطلاعاتی یافت نشد</p>';
}
}
?>
        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="index.php">
                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
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
            var KEY = 'liste_Aquatic_hidden_cols';
            var GROUPS = {
                ops: ['ops_del', 'ops_edit', 'ops_view'],
                bah: ['bah_cod_m', 'name'],
                loc: ['abadi', 'city']
            };
            function readHidden() {
                try {
                    var raw = localStorage.getItem(KEY);
                    var arr = raw ? JSON.parse(raw) : [];
                    if (!Array.isArray(arr)) return {};
                    var map = {};
                    for (var i = 0; i < arr.length; i++) map[arr[i]] = true;
                    return map;
                } catch (e) { return {}; }
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
                    if (id && !seen[id]) { seen[id] = true; ids.push(id); }
                }
                return ids;
            }
            function visibleCount(map) {
                var ids = allIds();
                var n = 0;
                for (var i = 0; i < ids.length; i++) { if (!map[ids[i]]) n++; }
                return n;
            }
            function applyGroup(map, groupId, kids) {
                var groupTh = table.querySelector('[data-col-group="' + groupId + '"]');
                if (!groupTh) return 0;
                var vis = 0;
                for (var j = 0; j < kids.length; j++) { if (!map[kids[j]]) vis++; }
                if (vis === 0) groupTh.classList.add('is-col-hidden');
                else { groupTh.classList.remove('is-col-hidden'); groupTh.colSpan = vis; }
                return vis;
            }
            function apply(map) {
                var cells = table.querySelectorAll('[data-col]');
                for (var i = 0; i < cells.length; i++) {
                    var id = cells[i].getAttribute('data-col');
                    if (map[id]) cells[i].classList.add('is-col-hidden');
                    else cells[i].classList.remove('is-col-hidden');
                }
                var visSecond = 0;
                for (var g in GROUPS) {
                    if (Object.prototype.hasOwnProperty.call(GROUPS, g)) visSecond += applyGroup(map, g, GROUPS[g]);
                }
                var groupRow = table.querySelector('thead tr:nth-child(2)');
                if (groupRow) {
                    if (visSecond === 0) groupRow.classList.add('is-col-hidden');
                    else groupRow.classList.remove('is-col-hidden');
                }
                var boxes = panel.querySelectorAll('input[type="checkbox"][data-col-toggle]');
                for (var b = 0; b < boxes.length; b++) boxes[b].checked = !map[boxes[b].getAttribute('data-col-toggle')];
                var hiddenCount = 0;
                var ids = allIds();
                for (var n = 0; n < ids.length; n++) { if (map[ids[n]]) hiddenCount++; }
                var label = btn.querySelector('.agri1-col-picker-label');
                if (label) label.textContent = hiddenCount > 0 ? ('ستون‌ها (' + hiddenCount + ' پنهان)') : 'ستون‌ها';
            }
            var hidden = readHidden();
            apply(hidden);
            function closePanel() {
                picker.classList.remove('is-open');
                btn.setAttribute('aria-expanded', 'false');
            }
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                if (picker.classList.contains('is-open')) closePanel();
                else { picker.classList.add('is-open'); btn.setAttribute('aria-expanded', 'true'); }
            });
            panel.addEventListener('click', function (e) { e.stopPropagation(); });
            document.addEventListener('click', closePanel);
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && picker.classList.contains('is-open')) { closePanel(); btn.focus(); }
            });
            panel.addEventListener('change', function (e) {
                var t = e.target;
                if (!t || t.getAttribute('data-col-toggle') == null) return;
                var id = t.getAttribute('data-col-toggle');
                if (!t.checked) {
                    hidden[id] = true;
                    if (visibleCount(hidden) < 1) { delete hidden[id]; t.checked = true; return; }
                } else { delete hidden[id]; }
                writeHidden(hidden);
                apply(hidden);
            });
            var resetBtn = document.getElementById('agri1-col-reset');
            if (resetBtn) resetBtn.addEventListener('click', function () { hidden = {}; writeHidden(hidden); apply(hidden); });
        })();
    </script>
</body>
</html>
<?php if (isset($_POST['com_alert'])) alert($_POST['com_alert']); ?>
