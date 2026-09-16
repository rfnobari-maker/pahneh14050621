<?php
include_once('../../lock_p1.php');
include_once('../../event.php');

$add_abadi = '';
$add_city = '';
$no_kesh = '';
$nah_kesh = '';
$no_mal = '';
$bah_cod_m = '';
$z_sal = '';
$ok = '';
$query1 = '';
$params = array();
$limit = 10;
$id = isset($_GET['id']) ? (int) $_GET['id'] : 1;
if ($id < 1) {
    $id = 1;
}
$start = ($id - 1) * $limit;

if (isset($_POST['back_p'])) {
    if (isset($_SESSION['page_date'])) {
        $page_date = $_SESSION['page_date'];
        $bah_cod_m = isset($page_date['p_bah_cod_m']) ? $page_date['p_bah_cod_m'] : '';
        $add_abadi = isset($page_date['p_add_abadi']) ? $page_date['p_add_abadi'] : '';
        $add_city = isset($page_date['p_add_city']) ? $page_date['p_add_city'] : '';
        $no_kesh = isset($page_date['p_no_kesh']) ? $page_date['p_no_kesh'] : '';
        $nah_kesh = isset($page_date['p_nah_kesh']) ? $page_date['p_nah_kesh'] : '';
        $no_mal = isset($page_date['p_no_mal']) ? $page_date['p_no_mal'] : '';
        $z_sal = isset($page_date['p_z_sal']) ? $page_date['p_z_sal'] : '';
        $ok = isset($page_date['ok']) ? $page_date['ok'] : '';
    }
} else {
    unset($_SESSION['page_date']);

    $add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
    $add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
    $no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
    $nah_kesh = isset($_POST['nah_kesh']) ? $_POST['nah_kesh'] : '';
    $no_mal = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
    $bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
    $z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
    $ok = isset($_POST['ok']) ? $_POST['ok'] : '';

    include_once('../session_start.php');

    $_SESSION['page_date'] = array(
        'p_add_abadi' => $add_abadi,
        'p_add_city' => $add_city,
        'p_bah_cod_m' => $bah_cod_m,
        'p_no_kesh' => $no_kesh,
        'p_nah_kesh' => $nah_kesh,
        'p_no_mal' => $no_mal,
        'p_z_sal' => $z_sal,
        'ok' => $ok
    );
}

if (!function_exists('agri2_h')) {
    function agri2_h($v)
    {
        if (!isset($v)) return '';
        return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
    }
}

function liste_garden_ops_svg($name)
{
    $d = array(
        'view' => '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>',
        'note' => '<path d="M21 15a2 2 0 0 1-2 2H8l-5 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
        'crop' => '<path d="M12 3v18"/><path d="M5 10c3 0 5-3 7-7 2 4 4 7 7 7"/><path d="M5 16c3 0 5-3 7-7 2 4 4 7 7 7"/>',
        'land' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 10h18"/><path d="M9 10v9"/>',
        'del' => '<path d="M4 7h16"/><path d="M9 7V4h6v3"/><path d="M6 7l1 14h10l1-14"/><path d="M10 11v6"/><path d="M14 11v6"/>'
    );
    $p = isset($d[$name]) ? $d[$name] : '';
    return '<svg class="agri1-icon" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true">' . $p . '</svg>';
}

function liste_garden_z_sal_ok($z_sal)
{
    return $z_sal !== '' && (bool) preg_match('/^\d{4}$/', $z_sal);
}

function liste_garden_build_search($login_session, $add_abadi, $add_city, $no_mal, $no_kesh, $nah_kesh, $bah_cod_m, $z_sal, $ok)
{
    $where = array('Garden.mor_cod_m = :mor_cod_m');
    $params = array(':mor_cod_m' => $login_session);
    if ($add_abadi !== '') {
        $where[] = 'Garden.add_abadi = :add_abadi';
        $params[':add_abadi'] = $add_abadi;
    }
    if ($add_city !== '') {
        $where[] = 'Garden.add_city = :add_city';
        $params[':add_city'] = $add_city;
    }
    if ($no_mal !== '') {
        $where[] = 'Garden.no_mal = :no_mal';
        $params[':no_mal'] = $no_mal;
    }
    if ($no_kesh !== '') {
        $where[] = 'Garden.no_kesh = :no_kesh';
        $params[':no_kesh'] = $no_kesh;
    }
    if ($nah_kesh !== '') {
        $where[] = 'Garden.nah_kesh = :nah_kesh';
        $params[':nah_kesh'] = $nah_kesh;
    }
    if ($bah_cod_m !== '') {
        $where[] = 'Garden.bah_cod_m = :bah_cod_m';
        $params[':bah_cod_m'] = $bah_cod_m;
    }
    if (liste_garden_z_sal_ok($z_sal)) {
        $where[] = 'Garden.z_sal = :z_sal';
        $params[':z_sal'] = $z_sal;
    }
    if ($ok !== '') {
        $where[] = 'bah.ok = :ok';
        $params[':ok'] = $ok;
    }
    return array(implode(' AND ', $where), $params);
}

function liste_garden_note_map($rows)
{
    global $dbh;
    $by_year = array();
    foreach ($rows as $row) {
        $ys = isset($row['z_sal']) ? $row['z_sal'] : '';
        if (!liste_garden_z_sal_ok($ys) || $ys <= '1404') {
            continue;
        }
        $by_year[$ys][] = (int) $row['id'];
    }
    $map = array();
    foreach ($by_year as $ys => $ids) {
        $ids = array_values(array_unique($ids));
        if (!$ids) {
            continue;
        }
        $table = 'Garden_note' . $ys;
        $in = implode(',', $ids);
        try {
            $stmt = $dbh->query('SELECT Garden_id FROM `' . $table . '` WHERE Garden_id IN (' . $in . ')');
            foreach ($stmt as $n) {
                $map[$ys . ':' . (int) $n['Garden_id']] = true;
            }
        } catch (PDOException $e) {
        }
    }
    return $map;
}

function liste_garden_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $nah_kesh, $bah_cod_m, $z_sal, $ok)
{
    $pairs = array(
        'action_lise' => '1',
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'no_mal' => $no_mal,
        'no_kesh' => $no_kesh,
        'nah_kesh' => $nah_kesh,
        'bah_cod_m' => $bah_cod_m,
        'z_sal' => $z_sal,
        'ok' => $ok
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo agri2_h($title); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script>
        function target_Agri18(form) {
            if (window.matchMedia && window.matchMedia('(max-width: 768px)').matches) {
                form.target = '_self';
                return;
            }
            window.open("null", "formpopup", "location=1,status=1,scrollbars=1,width=1200px,height=800px");
            form.target = "formpopup";
        }
        function target_Agri21(form) {
            var width = 500;
            var height = 800;
            window.open("", "formpopup", "location=no,menubar=no,toolbar=no,status=no,scrollbars=yes,resizable=no,width=" + width + ",height=" + height + ",left=0,top=100");
            form.target = "formpopup";
        }
    </script>
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
        .agri1-page .agri1-form #bah_cod_m {
            text-align: center;
            letter-spacing: 0.08em;
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
            width: 188px;
            padding: 4px 3px;
            white-space: nowrap;
        }
        .agri1-table .agri1-name-col {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
        .agri1-ops-btn-note::after {
            content: "";
            position: absolute;
            top: 4px;
            left: 4px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--color-accent);
        }
        .agri1-ops-btn-note.is-has-note::after {
            background: var(--color-primary);
        }
        .agri1-lock-note { font-size: 0.8125rem; color: var(--color-destructive); white-space: nowrap; }
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
            <h1 class="agri1-title" id="liste-title">لیست بهره‌برداری‌های باغی</h1>
        </header>
        <section class="agri1-card agri1-card-search" aria-labelledby="liste-title">
            <form id="reg-form" class="agri1-form" method="post" action="#1" novalidate>
                <h2 class="agri1-card-title">جستجو</h2>
                <div class="agri1-grid">
                    <div class="agri1-field">
                        <label class="agri1-label" for="z_sal">سال</label>
                        <select name="z_sal" class="input_text required" id="z_sal">
                            <option value="1405" <?php if (isset($z_sal) && $z_sal == '1405') echo 'selected="selected"'; ?>>1405</option>
                            <option value="1404" <?php if (isset($z_sal) && $z_sal == '1404') echo 'selected="selected"'; ?>>1404</option>
                            <option value="1403" <?php if (isset($z_sal) && $z_sal == '1403') echo 'selected="selected"'; ?>>1403</option>
                            <option value="1402" <?php if (isset($z_sal) && $z_sal == '1402') echo 'selected="selected"'; ?>>1402</option>
                            <option value="1401" <?php if (isset($z_sal) && $z_sal == '1401') echo 'selected="selected"'; ?>>1401</option>
                            <option value="1400" <?php if (isset($z_sal) && $z_sal == '1400') echo 'selected="selected"'; ?>>1400</option>
                            <option value="1399" <?php if (isset($z_sal) && $z_sal == '1399') echo 'selected="selected"'; ?>>1399</option>
                            <option value="1398" <?php if (isset($z_sal) && $z_sal == '1398') echo 'selected="selected"'; ?>>1398</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_city">نام شهر</label>
                        <select name="add_city" class="input_text" id="add_city" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            <?php
                            $query = 'SELECT add_city, shahr FROM `list_city` WHERE `mor_cod_m` = :mor_cod_m';
                            $stmt = $dbh->prepare($query);
                            $stmt->execute(array(':mor_cod_m' => $login_session));
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['add_city']); ?>"
                            <?php if ($row['add_city'] == $add_city) echo 'selected="selected"'; ?>><?php echo agri2_h($row['shahr']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="bah_cod_m">کد ملی بهره‌بردار</label>
                        <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($bah_cod_m); ?>" />
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_abadi">نام آبادی</label>
                        <select name="add_abadi" class="input_text" id="add_abadi" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            <?php
                            $query = 'SELECT add_abadi, abadi FROM `list_abadi` WHERE `mor_cod_m` = :mor_cod_m';
                            $stmt = $dbh->prepare($query);
                            $stmt->execute(array(':mor_cod_m' => $login_session));
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['add_abadi']); ?>"
                            <?php if (isset($row['add_abadi'], $add_abadi) && $row['add_abadi'] == $add_abadi) echo 'selected="selected"'; ?>><?php echo agri2_h($row['abadi']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="nah_kesh">نحوه کاشت</label>
                        <select name="nah_kesh" class="input_text required" id="nah_kesh">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if (isset($nah_kesh) && $nah_kesh == '1') echo 'selected="selected"'; ?>>ساده</option>
                            <option value="2" <?php if (isset($nah_kesh) && $nah_kesh == '2') echo 'selected="selected"'; ?>>مخلوط</option>
                            <option value="3" <?php if (isset($nah_kesh) && $nah_kesh == '3') echo 'selected="selected"'; ?>>پراکنده</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="no_mal">نوع مالکیت</label>
                        <select name="no_mal" class="input_text required" id="no_mal">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if (isset($no_mal) && $no_mal == '1') echo 'selected="selected"'; ?>>سند ششدانگ</option>
                            <option value="2" <?php if (isset($no_mal) && $no_mal == '2') echo 'selected="selected"'; ?>>سند مشاعی</option>
                            <option value="3" <?php if (isset($no_mal) && $no_mal == '3') echo 'selected="selected"'; ?>>اصلاحات اراضی</option>
                            <option value="4" <?php if (isset($no_mal) && $no_mal == '4') echo 'selected="selected"'; ?>>موقوفه</option>
                            <option value="5" <?php if (isset($no_mal) && $no_mal == '5') echo 'selected="selected"'; ?>>واگذاری</option>
                            <option value="6" <?php if (isset($no_mal) && $no_mal == '6') echo 'selected="selected"'; ?>>قولنامه</option>
                            <option value="7" <?php if (isset($no_mal) && $no_mal == '7') echo 'selected="selected"'; ?>>اجاره</option>
                            <option value="8" <?php if (isset($no_mal) && $no_mal == '8') echo 'selected="selected"'; ?>>سایر</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="ok">وضعیت حیات</label>
                        <select name="ok" class="input_text" id="ok" dir="rtl">
                            <option value="" <?php if ($ok == '') echo 'selected="selected"'; ?>>همه موارد</option>
                            <option value="4" <?php if ($ok == '4') echo 'selected="selected"'; ?>>تایید نشده</option>
                            <option value="1" <?php if ($ok == '1') echo 'selected="selected"'; ?>>زنده</option>
                            <option value="2" <?php if ($ok == '2') echo 'selected="selected"'; ?>>فوتی</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="no_kesh">نوع کشت</label>
                        <select name="no_kesh" class="input_text required" id="no_kesh">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if (isset($no_kesh) && $no_kesh == '1') echo 'selected="selected"'; ?>>آبی</option>
                            <option value="2" <?php if (isset($no_kesh) && $no_kesh == '2') echo 'selected="selected"'; ?>>دیم</option>
                        </select>
                    </div>
                </div>
                <p class="agri1-hint">برای مشاهده لیست کلیه بهره‌برداری‌ها کلید جستجو را بدون انتخاب هیچ یک از آیتم‌ها کلیک کنید</p>
                <div class="agri1-actions">
                    <button type="submit" name="action_lise" id="action_lise" value="جستجو " class="agri1-btn agri1-btn-primary">جستجو</button>
                </div>
            </form>
        </section>

<?php
if (isset($_POST['action_lise']) || isset($_POST['back_p'])) {
    list($sqlWhere, $params) = liste_garden_build_search(
        $login_session,
        $add_abadi,
        $add_city,
        $no_mal,
        $no_kesh,
        $nah_kesh,
        $bah_cod_m,
        $z_sal,
        $ok
    );
    $query = "SELECT Garden.num_bah, Garden.id, Garden.mor_cod_m, Garden.no_mal,
                     Garden.bah_cod_m, Garden.add_abadi, Garden.add_city, Garden.sh_gat, Garden.z_sal, Garden.no_kesh,
                     Garden.nah_kesh, Garden.m_zamin, Garden.id_ostan, Garden.id_city, Garden.t_mah,
                     bah.name, bah.Last_name AS last_name,
                     list_abadi.abadi, list_city.shahr, cityname.city AS city_name
              FROM Garden
              INNER JOIN bah ON Garden.bah_cod_m = bah.bah_cod_m AND Garden.num_bah = bah.num_bah
              LEFT JOIN list_abadi ON Garden.add_abadi <> '' AND Garden.add_abadi = list_abadi.add_abadi AND list_abadi.mor_cod_m = Garden.mor_cod_m
              LEFT JOIN list_city ON Garden.add_city <> '' AND Garden.add_city = list_city.add_city AND list_city.mor_cod_m = Garden.mor_cod_m
              LEFT JOIN cityname ON cityname.id_city = Garden.id_city AND cityname.id_ostan = Garden.id_ostan
              WHERE $sqlWhere
              ORDER BY BINARY bah.Last_name, bah.name, Garden.sh_gat
              LIMIT $start, $limit";
    $query1 = "SELECT COUNT(*)
               FROM Garden
               INNER JOIN bah ON Garden.bah_cod_m = bah.bah_cod_m AND Garden.num_bah = bah.num_bah
               WHERE $sqlWhere";
    $stmt = $dbh->prepare($query);
    $stmt->execute($params);
    $rows_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $t_row = count($rows_list);
    $note_map = liste_garden_note_map($rows_list);
?>
      <a name="1" id="1"></a>
<?php if ($t_row > 0) { ?>
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
                    <li><label><input type="checkbox" data-col-toggle="m_zamin" checked/> مساحت زمین</label></li>
                    <li><label><input type="checkbox" data-col-toggle="no_kesh" checked/> نوع کشت</label></li>
                    <li><label><input type="checkbox" data-col-toggle="no_mal" checked/> نوع مالکیت</label></li>
                    <li><label><input type="checkbox" data-col-toggle="sh_gat" checked/> شماره قطعه</label></li>
                    <li><label><input type="checkbox" data-col-toggle="z_sal" checked/> سال</label></li>
                    <li><label><input type="checkbox" data-col-toggle="bah_cod_m" checked/> کد ملی بهره‌بردار</label></li>
                    <li><label><input type="checkbox" data-col-toggle="name" checked/> نام و نام خانوادگی</label></li>
                    <li><label><input type="checkbox" data-col-toggle="abadi" checked/> شهر/آبادی</label></li>
                    <li><label><input type="checkbox" data-col-toggle="city" checked/> شهرستان</label></li>
                    <li><label><input type="checkbox" data-col-toggle="rownum" checked/> ردیف</label></li>
                </ul>
            </div>
        </div>
        <form action="list_Garden_xls.php" method="post" class="agri1-xls">
            <input type="hidden" name="add_abadi" value="<?php echo agri2_h($add_abadi); ?>" />
            <input type="hidden" name="add_city" value="<?php echo agri2_h($add_city); ?>" />
            <input type="hidden" name="no_mal" value="<?php echo agri2_h($no_mal); ?>" />
            <input type="hidden" name="no_kesh" value="<?php echo agri2_h($no_kesh); ?>" />
            <input type="hidden" name="nah_kesh" value="<?php echo agri2_h($nah_kesh); ?>" />
            <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>" />
            <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>" />
            <input type="hidden" name="ok" value="<?php echo agri2_h($ok); ?>" />
            <button type="submit"><img src="../../files/xls.png" title="دانلود فایل اکسل" width="44" height="40" alt="دانلود فایل اکسل"/></button>
        </form>
        </div>
            <p class="agri1-table-hint">برای مشاهده همه ستون‌ها جدول را افقی بکشید.</p>
<div class="agri1-table-wrap">
    <table class="agri1-table">
        <colgroup>
            <col data-col="ops" style="width:16%"/>
            <col data-col="m_zamin" style="width:8%"/>
            <col data-col="no_kesh" style="width:6%"/>
            <col data-col="no_mal" style="width:9%"/>
            <col data-col="sh_gat" style="width:6%"/>
            <col data-col="z_sal" style="width:6%"/>
            <col data-col="bah_cod_m" style="width:10%"/>
            <col data-col="name" style="width:13%"/>
            <col data-col="abadi" style="width:11%"/>
            <col data-col="city" style="width:11%"/>
            <col data-col="rownum" style="width:4%"/>
        </colgroup>
        <thead>
            <tr>
                <th class="agri1-ops-col" data-col="ops" rowspan="2">عملیات</th>
                <th data-col="m_zamin" rowspan="2">مساحت زمین<br />هکتار</th>
                <th data-col="no_kesh" rowspan="2">نوع کشت</th>
                <th data-col="no_mal" rowspan="2">نوع مالکیت</th>
                <th data-col="sh_gat" rowspan="2">شماره قطعه</th>
                <th data-col="z_sal" rowspan="2">سال</th>
                <th data-col-group="bah" colspan="2">مشخصات بهره‌بردار</th>
                <th data-col-group="loc" colspan="2">موقعیت بهره‌برداری</th>
                <th data-col="rownum" rowspan="2">ردیف</th>
            </tr>
            <tr>
                <th data-col="bah_cod_m">کد ملی</th>
                <th data-col="name">نام و نام خانوادگی</th>
                <th data-col="abadi">شهر/آبادی</th>
                <th data-col="city">شهرستان</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $r = $start + 1;
        foreach ($rows_list as $row) {
            $v_no_mal = '';
            if ($row['no_mal'] == '') $v_no_mal = '-';
            if ($row['no_mal'] == '1') $v_no_mal = 'سند ششدانگ';
            if ($row['no_mal'] == '2') $v_no_mal = 'سند مشاعی';
            if ($row['no_mal'] == '3') $v_no_mal = 'اصلاحات اراضی';
            if ($row['no_mal'] == '4') $v_no_mal = 'موقوفه';
            if ($row['no_mal'] == '5') $v_no_mal = 'واگذاری';
            if ($row['no_mal'] == '6') $v_no_mal = 'قولنامه';
            if ($row['no_mal'] == '7') $v_no_mal = 'اجاره';
            if ($row['no_mal'] == '8') $v_no_mal = 'سایر';

            $v_no_kesh = '';
            if ($row['no_kesh'] == '') $v_no_kesh = '-';
            if ($row['no_kesh'] == '1') $v_no_kesh = 'آبی';
            if ($row['no_kesh'] == '2') $v_no_kesh = 'دیم';
            $row_z_sal = $row['z_sal'];
            $can_edit = ($row_z_sal == '1405');
            $can_note = ($row_z_sal > '1404');
        ?>
            <tr>
            <td class="agri1-ops" data-col="ops">
                <div class="agri1-ops-bar">
            <?php if ($can_edit) { ?>
                    <form action="del_list_Garden.php" method="post">
                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>" />
                        <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>" />
                        <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>" />
                        <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>" />
                        <input type="hidden" name="sh_gat" value="<?php echo agri2_h($row['sh_gat']); ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo agri2_h($row_z_sal); ?>" />
                        <input type="hidden" name="id_page" value="<?php echo (int) $id; ?>" />
                        <button type="submit" class="agri1-ops-btn agri1-ops-btn-del" title="حذف اطلاعات باغی" aria-label="حذف اطلاعات باغی" onclick="return confirm('از حذف اطلاعات باغی و قلمستان مطمئن هستید ؟ ')"><?php echo liste_garden_ops_svg('del'); ?></button>
                    </form>
                    <form action="P_edit1.php" method="post" onsubmit="target_Agri18(this)">
                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>" />
                        <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo agri2_h($row_z_sal); ?>" />
                        <input type="hidden" name="from_page" value="liste" />
                        <button type="submit" class="agri1-ops-btn" title="ویرایش اطلاعات محصول" aria-label="ویرایش اطلاعات محصول"><?php echo liste_garden_ops_svg('crop'); ?></button>
                    </form>
                    <form action="Garden_edit.php" method="post">
                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>" />
                        <input type="hidden" name="sh_gat" value="<?php echo agri2_h($row['sh_gat']); ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo agri2_h($row_z_sal); ?>" />
                        <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>" />
                        <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo agri2_h($row['no_kesh']); ?>" />
                        <input type="hidden" name="no_mal" value="<?php echo agri2_h($row['no_mal']); ?>" />
                        <input type="hidden" name="t_mah" value="<?php echo agri2_h($row['t_mah']); ?>" />
                        <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>" />
                        <input type="hidden" name="nah_kesh" value="<?php echo agri2_h($row['nah_kesh']); ?>" />
                        <input type="hidden" name="id_page" value="<?php echo (int) $id; ?>" />
                        <button type="submit" class="agri1-ops-btn" title="ویرایش اطلاعات باغ" aria-label="ویرایش اطلاعات باغ"><?php echo liste_garden_ops_svg('land'); ?></button>
                    </form>
            <?php } else { ?>
                <span class="agri1-lock-note">امکان ویرایش و حذف مقدور نیست</span>
            <?php } ?>
            <?php if ($can_note) { ?>
                    <form action="Garden_note" method="post" onsubmit="target_Agri21(this)">
                        <input type="hidden" name="Garden_id" value="<?php echo agri2_h($row['id']); ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo agri2_h($row_z_sal); ?>" />
                        <input type="hidden" name="mor_cod_m" value="<?php echo agri2_h($user_check); ?>" />
                        <?php $has_note = !empty($note_map[$row_z_sal . ':' . (int) $row['id']]); ?>
                        <button type="submit" class="agri1-ops-btn agri1-ops-btn-note<?php echo $has_note ? ' is-has-note' : ''; ?>" title="<?php echo $has_note ? 'نمایش توضیح' : 'درج توضیح'; ?>" aria-label="<?php echo $has_note ? 'نمایش توضیح' : 'درج توضیح'; ?>"><?php echo liste_garden_ops_svg('note'); ?></button>
                    </form>
            <?php } ?>
                <form action="Gardendata_view.php" method="post">
                    <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>" />
                    <input type="hidden" name="id_page" value="<?php echo (int) $id; ?>" />
                    <button type="submit" class="agri1-ops-btn" title="نمایش اطلاعات بهره‌برداری" aria-label="نمایش اطلاعات بهره‌برداری"><?php echo liste_garden_ops_svg('view'); ?></button>
                </form>
                </div>
            </td>
            <td data-col="m_zamin"><?php echo agri2_h($row['m_zamin'] * 1); ?></td>
            <td data-col="no_kesh"><?php echo agri2_h($v_no_kesh); ?></td>
            <td data-col="no_mal"><?php echo agri2_h($v_no_mal); ?></td>
            <td data-col="sh_gat"><?php echo agri2_h($row['sh_gat']); ?></td>
            <td data-col="z_sal"><?php echo agri2_h($row['z_sal']); ?></td>
            <td data-col="bah_cod_m" dir="ltr"><?php echo agri2_h($row['bah_cod_m']); ?></td>
            <td class="agri1-name-col" data-col="name"><?php echo agri2_h(trim((isset($row['last_name']) ? $row['last_name'] : '') . ' ' . (isset($row['name']) ? $row['name'] : ''))); ?></td>
            <td class="agri1-name-col" data-col="abadi"><?php echo agri2_h((isset($row['abadi']) ? $row['abadi'] : '') . (isset($row['shahr']) ? $row['shahr'] : '')); ?></td>
            <td class="agri1-name-col" data-col="city"><?php echo agri2_h(isset($row['city_name']) ? $row['city_name'] : ''); ?></td>
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
if ($query1 !== '') {
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute($params);
    $rows = $stmt1->fetchColumn();
    $total = ceil($rows / $limit);
    if ($rows > 0) {
        $visible_pages = 3;
        $start_page = max(1, $id - $visible_pages);
        $end_page = min($total, $id + $visible_pages);
        $show_first = ($start_page > 1);
        $show_last = ($end_page < $total);
    ?>
        <nav class="agri1-pager" aria-label="صفحه‌بندی">
            <ul class="agri1-pager-list">
                <?php if (isset($id) && $id > 1) { ?>
                <li>
                    <form action="liste_Garden.php?id=<?php echo (int) $id - 1; ?>#1" method="post">
                        <?php liste_garden_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $nah_kesh, $bah_cod_m, $z_sal, $ok); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="liste_Garden.php?id=1#1" method="post">
                        <?php liste_garden_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $nah_kesh, $bah_cod_m, $z_sal, $ok); ?>
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
                    <form action="liste_Garden.php?id=<?php echo (int) $i; ?>#1" method="post">
                        <?php liste_garden_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $nah_kesh, $bah_cod_m, $z_sal, $ok); ?>
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
                    <form action="liste_Garden.php?id=<?php echo (int) $total; ?>#1" method="post">
                        <?php liste_garden_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $nah_kesh, $bah_cod_m, $z_sal, $ok); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int) $total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if (isset($id) && $id != $total && $total > 0) { ?>
                <li>
                    <form action="liste_Garden.php?id=<?php echo (int) $id + 1; ?>#1" method="post">
                        <?php liste_garden_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $nah_kesh, $bah_cod_m, $z_sal, $ok); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="liste_Garden.php" method="post">
                    <?php liste_garden_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $nah_kesh, $bah_cod_m, $z_sal, $ok); ?>
                    <span>به صفحه</span>
                    <input type="text" inputmode="numeric" lang="en" dir="ltr" id="pageIdInput" name="page_input" value="<?php echo isset($_REQUEST['id']) ? (int) $_REQUEST['id'] : 1; ?>" placeholder="1"/>
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
                    this.action = 'liste_Garden.php?id=' + pageId + '#1';
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
            var submitBtn = document.getElementById('action_lise');
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

            var KEY = 'liste_Garden_hidden_cols';
            var GROUP = { bah: ['bah_cod_m', 'name'], loc: ['abadi', 'city'] };

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
                var anyGroupVisible = false;
                for (var g in GROUP) {
                    if (!Object.prototype.hasOwnProperty.call(GROUP, g)) continue;
                    var groupTh = table.querySelector('[data-col-group="' + g + '"]');
                    if (!groupTh) continue;
                    var vis = 0;
                    var kids = GROUP[g];
                    for (var j = 0; j < kids.length; j++) {
                        if (!map[kids[j]]) vis++;
                    }
                    if (vis === 0) {
                        groupTh.classList.add('is-col-hidden');
                    } else {
                        groupTh.classList.remove('is-col-hidden');
                        groupTh.colSpan = vis;
                        anyGroupVisible = true;
                    }
                }
                var groupRow = table.querySelector('thead tr:nth-child(2)');
                if (groupRow) {
                    if (!anyGroupVisible) groupRow.classList.add('is-col-hidden');
                    else groupRow.classList.remove('is-col-hidden');
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
<?php if (isset($_POST['com_alert'])) alert($_POST['com_alert']); ?>
