<?php
require_once('../../lock_cp.php');
require_once('../../event.php');
require_once('../side_menu1.php');
require_once(__DIR__ . '/Agri_ab_moghayerat_lib.php');

$kinds = agri_ab_moghayer_kinds();
$searched = isset($_POST['action']);
$z_sal = isset($_POST['z_sal']) ? trim($_POST['z_sal']) : '';
$id_ostan1 = isset($_POST['id_ostan']) ? trim($_POST['id_ostan']) : '';
$moghayer = agri_ab_moghayer_norm_kind(isset($_POST['moghayer']) ? $_POST['moghayer'] : 'ostan_city');

if (!$searched && isset($id_ostan) && $id_ostan !== '' && $id_ostan !== '-1' && $id_ostan != -1) {
    $id_ostan1 = $id_ostan;
}

$years_list = array();
try {
    $stmt_years = $dbh->query("SELECT DISTINCT z_sal FROM Agri_ab_ostan WHERE z_sal IS NOT NULL AND z_sal <> '' ORDER BY z_sal DESC");
    if ($stmt_years) {
        $years_list = $stmt_years->fetchAll(PDO::FETCH_COLUMN);
    }
} catch (PDOException $e) {
}
if (empty($years_list)) {
    $years_list = array('1405-1406', '1404-1405');
}
if ($z_sal === '') {
    $z_sal = $years_list[0];
}

$ostan_list = array();
try {
    $stmt_ostan = $dbh->query("SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC");
    if ($stmt_ostan) {
        $ostan_list = $stmt_ostan->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
}

$counts = array('mar_prod' => null, 'city_mar' => null, 'ostan_city' => null);
$rows = array();
$total_rows = 0;
$total = 0;
$id = 1;
$start = 0;
$limit = 10;
$prod_missing = false;
$search_error = '';

if ($searched) {
    if (!agri_ab_moghayer_valid_year($z_sal)) {
        $search_error = 'سال زراعی را انتخاب کنید.';
    } else {
        if ($moghayer === 'mar_prod' && !agri_ab_moghayer_table_exists($dbh, agri_ab_moghayer_prod_table($z_sal))) {
            $prod_missing = true;
        }
        $id = 1;
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }
        if (isset($_POST['page_input'])) {
            $id = (int) $_POST['page_input'];
        }
        if ($id < 1) {
            $id = 1;
        }
        $start = ($id - 1) * $limit;
        if (!$prod_missing) {
            $page = agri_ab_moghayer_page($dbh, $moghayer, $z_sal, $id_ostan1, $start, $limit);
            $rows = $page['rows'];
            $counts[$moghayer] = $page['total'];
            $total_rows = $page['total'];
            $total = $total_rows > 0 ? (int) ceil($total_rows / $limit) : 0;
            if (isset($page['start'])) {
                $start = (int) $page['start'];
                $id = $limit > 0 ? (int) floor($start / $limit) + 1 : 1;
            }
        }
    }
}

$kind_meta = $kinds[$moghayer];
$show_city = ($moghayer === 'mar_prod' || $moghayer === 'city_mar');
$show_mar = ($moghayer === 'mar_prod');
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
        .agri1-page .agri1-form select:focus {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
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
            margin: 0;
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
        .agri1-results-toolbar .agri1-xls { grid-column: 2; }
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
        .agri1-table .is-col-hidden { display: none !important; }
        .agri1-table-wrap {
            width: 100%;
            overflow-x: visible;
            border: 1px solid var(--color-border);
            border-radius: 12px;
            background: var(--color-card);
            direction: ltr;
        }
        .agri1-table {
            width: 100%;
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
        }
        .agri1-table td {
            padding: 4px 3px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid var(--color-border);
            color: var(--color-foreground);
            font-weight: 400;
            font-size: 14px;
            white-space: nowrap;
        }
        .agri1-table tbody tr:nth-child(even) td { background: var(--color-background); }
        .agri1-table tbody tr:hover td { background: #ECFDF3; }
        .agri1-table .agri1-name-col {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .agri1-diff { color: var(--color-destructive); font-weight: 700; }
        .agri1-tabs {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            margin: 0 0 var(--space-3);
        }
        .agri1-tabs form { margin: 0; }
        .agri1-tabs .agri1-btn { min-height: 36px; padding: 6px 14px; font-size: 0.875rem; }
        .agri1-tab-count {
            font-family: Tahoma, "Segoe UI", sans-serif;
            font-weight: 600;
            direction: ltr;
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
        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td colspan="3">
            <?php require_once('../header.php'); ?>
        </td>
    </tr>
    <tr>
        <td colspan="3" valign="top">
    <a class="agri1-skip" href="#reg-form">رفتن به فرم جستجو</a>
    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>
    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="moghayer-title">مغایرت الگوی کشت</h1>
        </header>
        <section class="agri1-card agri1-card-search" aria-labelledby="moghayer-title">
            <form id="reg-form" class="agri1-form agri1-busy-form" method="post" action="#1" novalidate>
                <h2 class="agri1-card-title">جستجو</h2>
                <div class="agri1-grid">
                    <div class="agri1-field">
                        <label class="agri1-label" for="z_sal">سال زراعی</label>
                        <select name="z_sal" id="z_sal">
                            <?php foreach ($years_list as $y) { ?>
                            <option value="<?php echo agri2_h($y); ?>"<?php if ($z_sal == $y) echo ' selected="selected"'; ?>><?php echo agri2_h($y); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_ostan">استان</label>
                        <select name="id_ostan" id="id_ostan">
                            <option value="">انتخاب کنید</option>
                            <?php foreach ($ostan_list as $o) { ?>
                            <option value="<?php echo agri2_h($o['id_ostan']); ?>"<?php if ($id_ostan1 == $o['id_ostan']) echo ' selected="selected"'; ?>><?php echo agri2_h($o['ostan']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="moghayer" value="<?php echo agri2_h($moghayer); ?>"/>
                <div class="agri1-actions">
                    <button type="submit" name="action" id="action" value="1" class="agri1-btn agri1-btn-primary">جستجو</button>
                </div>
            </form>
        </section>

<?php if ($searched) { ?>
        <a name="1" id="1"></a>
        <?php if ($search_error !== '') { ?>
        <p class="agri1-note"><?php echo agri2_h($search_error); ?></p>
        <?php } else { ?>
        <nav class="agri1-tabs" aria-label="نوع مغایرت">
            <?php foreach ($kinds as $k => $meta) {
                $is_cur = ($k === $moghayer);
            ?>
            <form method="post" action="Agri_ab_moghayerat.php#1" class="agri1-busy-form">
                <input type="hidden" name="action" value="1"/>
                <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
                <input type="hidden" name="id_ostan" value="<?php echo agri2_h($id_ostan1); ?>"/>
                <input type="hidden" name="moghayer" value="<?php echo agri2_h($k); ?>"/>
                <button type="submit" class="agri1-btn <?php echo $is_cur ? 'agri1-btn-primary' : 'agri1-btn-ghost'; ?>"<?php if ($is_cur) echo ' aria-current="page"'; ?>>
                    <?php echo agri2_h($meta['label']); ?>
                    <span class="agri1-tab-count" data-kind="<?php echo agri2_h($k); ?>" lang="en"><?php
                    if ($counts[$k] !== null) {
                        echo '(' . (int) $counts[$k] . ')';
                    }
                    ?></span>
                </button>
            </form>
            <?php } ?>
        </nav>
        <?php if ($prod_missing) { ?>
        <p class="agri1-note">جدول کشت کارشناسان این سال زراعی موجود نیست.</p>
        <?php } elseif (count($rows) === 0) { ?>
        <p class="agri1-note">اطلاعاتی یافت نشد</p>
        <?php } else { ?>
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
                            <li><label><input type="checkbox" data-col-toggle="diff" checked/> مغایرت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="down" checked/> <?php echo agri2_h($kind_meta['down']); ?></label></li>
                            <li><label><input type="checkbox" data-col-toggle="up" checked/> <?php echo agri2_h($kind_meta['up']); ?></label></li>
                            <li><label><input type="checkbox" data-col-toggle="noe" checked/> آبی / دیم</label></li>
                            <li><label><input type="checkbox" data-col-toggle="product_cod" checked/> کد محصول</label></li>
                            <li><label><input type="checkbox" data-col-toggle="product" checked/> محصول</label></li>
                            <?php if ($show_mar) { ?>
                            <li><label><input type="checkbox" data-col-toggle="id_mar" checked/> کد مرکز</label></li>
                            <li><label><input type="checkbox" data-col-toggle="mar" checked/> مرکز</label></li>
                            <?php } ?>
                            <?php if ($show_city) { ?>
                            <li><label><input type="checkbox" data-col-toggle="id_city" checked/> کد شهرستان</label></li>
                            <li><label><input type="checkbox" data-col-toggle="city" checked/> شهرستان</label></li>
                            <?php } ?>
                            <li><label><input type="checkbox" data-col-toggle="id_ostan" checked/> کد استان</label></li>
                            <li><label><input type="checkbox" data-col-toggle="ostan" checked/> استان</label></li>
                            <li><label><input type="checkbox" data-col-toggle="rownum" checked/> ردیف</label></li>
                        </ul>
                    </div>
                </div>
                <form action="Agri_ab_moghayerat_xls.php" method="post" class="agri1-xls">
                    <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
                    <input type="hidden" name="id_ostan" value="<?php echo agri2_h($id_ostan1); ?>"/>
                    <input type="hidden" name="moghayer" value="<?php echo agri2_h($moghayer); ?>"/>
                    <button type="submit" title="دانلود نتایج با فرمت فایل اکسل">
                        <img src="../../files/xls.png" width="44" height="40" alt="خروجی اکسل"/>
                    </button>
                </form>
            </div>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <colgroup>
                        <col data-col="diff" style="width:9%"/>
                        <col data-col="down" style="width:10%"/>
                        <col data-col="up" style="width:10%"/>
                        <col data-col="noe" style="width:6%"/>
                        <col data-col="product_cod" style="width:7%"/>
                        <col data-col="product" style="width:<?php echo $show_mar ? '12%' : ($show_city ? '16%' : '22%'); ?>"/>
                        <?php if ($show_mar) { ?>
                        <col data-col="id_mar" style="width:6%"/>
                        <col data-col="mar" style="width:10%"/>
                        <?php } ?>
                        <?php if ($show_city) { ?>
                        <col data-col="id_city" style="width:6%"/>
                        <col data-col="city" style="width:9%"/>
                        <?php } ?>
                        <col data-col="id_ostan" style="width:6%"/>
                        <col data-col="ostan" style="width:9%"/>
                        <col data-col="rownum" style="width:4%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th data-col="diff">مغایرت</th>
                            <th data-col="down"><?php echo agri2_h($kind_meta['down']); ?></th>
                            <th data-col="up"><?php echo agri2_h($kind_meta['up']); ?></th>
                            <th data-col="noe">آبی / دیم</th>
                            <th data-col="product_cod">کد محصول</th>
                            <th data-col="product">محصول</th>
                            <?php if ($show_mar) { ?>
                            <th data-col="id_mar">کد مرکز</th>
                            <th data-col="mar">مرکز</th>
                            <?php } ?>
                            <?php if ($show_city) { ?>
                            <th data-col="id_city">کد شهرستان</th>
                            <th data-col="city">شهرستان</th>
                            <?php } ?>
                            <th data-col="id_ostan">کد استان</th>
                            <th data-col="ostan">استان</th>
                            <th data-col="rownum">ردیف</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $r = $start + 1;
                    foreach ($rows as $row) {
                    ?>
                        <tr>
                            <td class="agri1-diff" data-col="diff" lang="en"><?php echo agri2_h(agri_ab_moghayer_num($row['val_diff'])); ?></td>
                            <td data-col="down" lang="en"><?php echo agri2_h(agri_ab_moghayer_num($row['val_down'])); ?></td>
                            <td data-col="up" lang="en"><?php echo agri2_h(agri_ab_moghayer_num($row['val_up'])); ?></td>
                            <td data-col="noe"><?php echo agri2_h($row['noe']); ?></td>
                            <td data-col="product_cod" lang="en"><?php echo agri2_h(agri_ab_moghayer_blank($row['product_cod'])); ?></td>
                            <td class="agri1-name-col" data-col="product"><?php echo agri2_h($row['product_name']); ?></td>
                            <?php if ($show_mar) { ?>
                            <td data-col="id_mar" lang="en"><?php echo agri2_h(agri_ab_moghayer_blank($row['id_mar'])); ?></td>
                            <td class="agri1-name-col" data-col="mar"><?php echo agri2_h(agri_ab_moghayer_blank($row['mar'])); ?></td>
                            <?php } ?>
                            <?php if ($show_city) { ?>
                            <td data-col="id_city" lang="en"><?php echo agri2_h(agri_ab_moghayer_blank($row['id_city'])); ?></td>
                            <td class="agri1-name-col" data-col="city"><?php echo agri2_h(agri_ab_moghayer_blank($row['city'])); ?></td>
                            <?php } ?>
                            <td data-col="id_ostan" lang="en"><?php echo agri2_h(agri_ab_moghayer_blank($row['id_ostan'])); ?></td>
                            <td class="agri1-name-col" data-col="ostan"><?php echo agri2_h(agri_ab_moghayer_blank($row['ostan'])); ?></td>
                            <td data-col="rownum" lang="en"><?php echo (int) $r; ?></td>
                        </tr>
                    <?php
                        $r++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </section>
        <?php if ($total > 1) { ?>
        <nav class="agri1-pager" aria-label="صفحه‌بندی">
            <ul class="agri1-pager-list">
                <?php if ($id > 1) { ?>
                <li>
                    <form class="agri1-busy-form" action="Agri_ab_moghayerat.php?id=<?php echo (int) $id - 1; ?>#1" method="post">
                        <?php agri_ab_moghayer_filter_hiddens($z_sal, $id_ostan1, $moghayer); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php }
                $win_start = max(1, $id - 3);
                $win_end = min($total, $id + 3);
                if ($win_start > 1) { ?>
                <li>
                    <form class="agri1-busy-form" action="Agri_ab_moghayerat.php?id=1#1" method="post">
                        <?php agri_ab_moghayer_filter_hiddens($z_sal, $id_ostan1, $moghayer); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en">1</button>
                    </form>
                </li>
                <?php if ($win_start > 2) { ?>
                <li><span class="agri1-pager-ellipsis">...</span></li>
                <?php }
                }
                for ($i = $win_start; $i <= $win_end; $i++) {
                    if ($i == $id) { ?>
                <li><span class="agri1-pager-btn is-current is-num" lang="en"><?php echo (int) $i; ?></span></li>
                    <?php } else { ?>
                <li>
                    <form class="agri1-busy-form" action="Agri_ab_moghayerat.php?id=<?php echo (int) $i; ?>#1" method="post">
                        <?php agri_ab_moghayer_filter_hiddens($z_sal, $id_ostan1, $moghayer); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int) $i; ?></button>
                    </form>
                </li>
                    <?php }
                }
                if ($win_end < $total) {
                    if ($win_end < $total - 1) { ?>
                <li><span class="agri1-pager-ellipsis">...</span></li>
                    <?php } ?>
                <li>
                    <form class="agri1-busy-form" action="Agri_ab_moghayerat.php?id=<?php echo (int) $total; ?>#1" method="post">
                        <?php agri_ab_moghayer_filter_hiddens($z_sal, $id_ostan1, $moghayer); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int) $total; ?></button>
                    </form>
                </li>
                <?php }
                if ($id < $total) { ?>
                <li>
                    <form class="agri1-busy-form" action="Agri_ab_moghayerat.php?id=<?php echo (int) $id + 1; ?>#1" method="post">
                        <?php agri_ab_moghayer_filter_hiddens($z_sal, $id_ostan1, $moghayer); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" class="agri1-busy-form" action="Agri_ab_moghayerat.php" method="post">
                    <?php agri_ab_moghayer_filter_hiddens($z_sal, $id_ostan1, $moghayer); ?>
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
                    this.action = 'Agri_ab_moghayerat.php?id=' + pageId + '#1';
                } else {
                    e.preventDefault();
                    alert('لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo (int) $total; ?> وارد کنید.');
                }
            });
        })();
        </script>
        <?php } ?>
        <?php } ?>
        <?php } ?>
<?php } ?>

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
        </td>
    </tr>
    <tr>
        <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
            <?php include('../../footer.php'); ?>
        </td>
    </tr>
</table>
    <script>
        (function () {
            var overlay = document.getElementById('agri1-overlay');
            var forms = document.querySelectorAll('.agri1-busy-form');
            if (!overlay || !forms.length) return;
            for (var i = 0; i < forms.length; i++) {
                forms[i].addEventListener('submit', function () {
                    overlay.className = 'agri1-overlay is-open';
                    var btn = this.querySelector('button[type="submit"]');
                    if (btn) btn.setAttribute('aria-busy', 'true');
                });
            }
        })();
<?php if ($searched && $search_error === '') { ?>
        (function () {
            if (typeof jQuery === 'undefined') return;
            jQuery.post('Agri_ab_moghayerat_counts.php', {
                z_sal: <?php echo json_encode($z_sal); ?>,
                id_ostan: <?php echo json_encode($id_ostan1); ?>,
                moghayer: <?php echo json_encode($moghayer); ?>
            }, function (data) {
                if (!data) return;
                for (var k in data) {
                    if (!Object.prototype.hasOwnProperty.call(data, k)) continue;
                    var el = document.querySelector('.agri1-tab-count[data-kind="' + k + '"]');
                    if (el) el.textContent = '(' + data[k] + ')';
                }
            }, 'json');
        })();
<?php } ?>
        (function () {
            var picker = document.getElementById('agri1-col-picker');
            var btn = document.getElementById('agri1-col-picker-btn');
            var panel = document.getElementById('agri1-col-panel');
            var table = document.querySelector('.agri1-table');
            if (!picker || !btn || !panel || !table) return;

            var KEY = 'Agri_ab_moghayerat_hidden_cols';

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
            panel.addEventListener('click', function (e) { e.stopPropagation(); });
            document.addEventListener('click', function () { closePanel(); });
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
