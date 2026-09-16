<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri_l3_filter_hiddens($id_ostan1, $id_city, $id_mar, $z_sal, $dis)
{
    $pairs = array(
        'action' => '1',
        'id_ostan' => $id_ostan1,
        'id_city' => $id_city,
        'id_mar' => $id_mar,
        'z_sal' => $z_sal,
        'dis' => $dis
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

$id_ostan1 = $id_ostan;
$z_sal     = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$dis       = isset($_POST['dis']) ? $_POST['dis'] : '';

$stmt = $dbh->query("SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC");
$ostans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo agri2_h($title); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        var initial_id_ostan = '<?php echo agri2_h(!empty($id_ostan1) ? $id_ostan1 : ''); ?>';
        var initial_id_city = '<?php echo agri2_h(!empty($id_city) ? $id_city : ''); ?>';
        var initial_id_mar = '<?php echo agri2_h(!empty($id_mar) ? $id_mar : ''); ?>';
    </script>
    <script src="../../location/ajax-location.js"></script>
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
        .agri1-card-search .agri1-grid-single {
            display: grid;
            grid-template-columns: minmax(200px, 280px);
            justify-content: center;
            direction: rtl;
        }
        .agri1-card-search .agri1-label {
            margin-bottom: 4px;
            font-size: 0.875rem;
        }
        .agri1-page .agri1-card-search .agri1-form input[type="text"],
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
        .agri1-hint {
            margin: 12px 0 0;
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
        }
        .agri1-note {
            margin: 0;
            padding: 12px 14px;
            border-radius: 10px;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            color: #1D4ED8;
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
            font-family: inherit;
            box-shadow: none;
            transition: border-color var(--duration) ease, box-shadow var(--duration) ease;
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
        .agri1-page .agri1-form #bah_cod_m {
            text-align: center;
            letter-spacing: 0.08em;
        }
        .agri1-page .agri1-form input.agri-lock,
        .agri1-page .agri1-form input[readonly],
        .agri1-page .agri1-form select:disabled {
            background: var(--color-card);
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
        .agri1-table .agri1-inline-input,
        .agri1-table .agri1-inline-select {
            width: 52px;
            min-height: 32px;
            padding: 2px 4px;
            border: 1px solid #64748B;
            border-radius: 8px;
            background: var(--color-card);
            color: var(--color-foreground);
            font-size: 13px;
            font-family: inherit;
            text-align: center;
        }
        .agri1-table .agri1-inline-select { width: 58px; }
        .agri1-table .agri1-kh-select {
            width: 86px;
            min-height: 32px;
            font-size: 12px;
            font-weight: 400;
        }
        .agri1-table .agri1-kh-select.is-empty {
            font-size: 10px;
        }
        .agri1-table .agri1-inline-input:focus,
        .agri1-table .agri1-inline-select:focus {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
        }
        .agri1-table .agri1-btn {
            min-width: 44px;
            min-height: 32px;
            padding: 4px 8px;
            font-size: 13px;
        }
        .agri1-save-wrap {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }
        .agri1-save-msg { font-size: 0.75rem; font-weight: 700; }
        .agri1-save-ok { color: var(--color-primary); }
        .agri1-save-err { color: var(--color-destructive); }
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
            <h1 class="agri1-title" id="sab-l3-title">مشاهده برش مرکز جهاد کشاورزی ، برنامه الگوی کشت ابلاغی محصولات زراعی</h1>
        </header>

        <section class="agri1-card agri1-card-search" aria-labelledby="sab-l3-title">
            <form id="reg-form" class="agri1-form" method="post" action="#1" novalidate>
                <h2 class="agri1-card-title">جستجو</h2>
                <div class="agri1-grid agri1-grid-single">
                    <div class="agri1-field">
                        <label class="agri1-label" for="z_sal2">سال زراعی</label>
                        <select name="z_sal" class="input_text required" id="z_sal2" tabindex="1">
                            <option value="1405-1406" <?php if (isset($z_sal) && $z_sal == '1405-1406') echo 'selected="selected"'; ?>>1405-1406</option>
                            <option value="1404-1405" <?php if (isset($z_sal) && $z_sal == '1404-1405') echo 'selected="selected"'; ?>>1404-1405</option>
                        </select>
                    </div>
                </div>
                <div class="agri1-actions">
                    <button type="submit" name="action" id="action" value="جستجو" class="agri1-btn agri1-btn-primary" tabindex="10">جستجو</button>
                </div>
            </form>
        </section>

        <a name="1" id="1"></a>
        <?php
        if (isset($_POST['action'])) {
            $start = 0;
            $limit = 10;
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
            if ($id < 1) $id = 1;
            $start = ($id - 1) * $limit;
            $query  = "SELECT  * from Agri_ab_mar where z_sal = '$z_sal' and id_ostan = '$id_ostan1' and id_city = '$id_city' and id_mar = '$id_mar' and ((s_abi > 0) or (s_dem > 0)) group by group_cod,product_cod ASC LIMIT $start, $limit ";
            $query1 = "SELECT  count(*) from Agri_ab_mar where z_sal = '$z_sal' and id_ostan = '$id_ostan1' and id_city = '$id_city' and id_mar = '$id_mar' and ((s_abi > 0) or (s_dem > 0))";
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $t_row = $stmt->rowCount();
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
                    <li><label><input type="checkbox" data-col-toggle="a_dem" checked/> عملکرد دیم</label></li>
                    <li><label><input type="checkbox" data-col-toggle="a_abi" checked/> عملکرد آبی</label></li>
                    <li><label><input type="checkbox" data-col-toggle="t_dem" checked/> تولید دیم</label></li>
                    <li><label><input type="checkbox" data-col-toggle="t_abi" checked/> تولید آبی</label></li>
                    <li><label><input type="checkbox" data-col-toggle="s_dem" checked/> سطح دیم</label></li>
                    <li><label><input type="checkbox" data-col-toggle="s_abi" checked/> سطح آبی</label></li>
                    <li><label><input type="checkbox" data-col-toggle="product" checked/> نام محصول</label></li>
                    <li><label><input type="checkbox" data-col-toggle="group_name" checked/> گروه</label></li>
                    <li><label><input type="checkbox" data-col-toggle="rownum" checked/> ردیف</label></li>
                </ul>
            </div>
        </div>
        <form action="Sab_L3_xls.php" method="post" class="agri1-xls">
                    <input type="hidden" name="id_ostan" value="<?php echo agri2_h($id_ostan1); ?>"/>
                    <input type="hidden" name="id_city" value="<?php echo agri2_h($id_city); ?>"/>
                    <input type="hidden" name="id_mar" value="<?php echo agri2_h($id_mar); ?>"/>
                    <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
            <button type="submit"><img src="../../files/xls.png" title="دانلود فایل اکسل" width="44" height="40" alt="دانلود فایل اکسل"/></button>
        </form>
        </div>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <colgroup>
                        <col data-col="a_dem" style="width:11%"/>
                        <col data-col="a_abi" style="width:11%"/>
                        <col data-col="t_dem" style="width:10%"/>
                        <col data-col="t_abi" style="width:10%"/>
                        <col data-col="s_dem" style="width:10%"/>
                        <col data-col="s_abi" style="width:10%"/>
                        <col data-col="product" style="width:16%"/>
                        <col data-col="group_name" style="width:14%"/>
                        <col data-col="rownum" style="width:8%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th colspan="2" data-col-group="amal">عملکرد / کیلوگرم در هکتار</th>
                            <th colspan="2" data-col-group="tolid">تولید / تن</th>
                            <th colspan="2" data-col-group="sath">سطح / هکتار</th>
                            <th colspan="2" data-col-group="spec">مشخصات</th>
                            <th rowspan="2" data-col="rownum">ردیف</th>
                        </tr>
                        <tr>
                            <th data-col="a_dem">دیم</th>
                            <th data-col="a_abi">آبی</th>
                            <th data-col="t_dem">دیم</th>
                            <th data-col="t_abi">آبی</th>
                            <th data-col="s_dem">دیم</th>
                            <th data-col="s_abi">آبی</th>
                            <th data-col="product">نام محصول</th>
                            <th data-col="group_name">گروه</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $r = $start + 1;
                    foreach ($stmt as $row) {
                    ?>
                        <tr>
                            <td data-col="a_dem"><?php echo agri2_h($row['a_dem'] * 1); ?></td>
                            <td data-col="a_abi"><?php echo agri2_h($row['a_abi'] * 1); ?></td>
                            <td data-col="t_dem"><?php echo agri2_h($row['t_dem'] * 1); ?></td>
                            <td data-col="t_abi"><?php echo agri2_h($row['t_abi'] * 1); ?></td>
                            <td data-col="s_dem"><?php echo agri2_h($row['s_dem'] * 1); ?></td>
                            <td data-col="s_abi"><?php echo agri2_h($row['s_abi'] * 1); ?></td>
                            <td class="agri1-name-col" data-col="product"><?php echo agri2_h($row['product_name']); ?></td>
                            <td class="agri1-name-col" data-col="group_name"><?php echo agri2_h($row['group_name']); ?></td>
                            <td data-col="rownum"><?php echo (int)$r; ?></td>
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
        ?>

        <?php
        if (isset($query1)) {
            $stmt1 = $dbh->prepare($query1);
            $stmt1->execute();
            $rows = $stmt1->fetchColumn();
            $total = ceil($rows / $limit);
            if ($rows > 10) $t_row = 10; else $t_row = $rows;
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
                    <form action="Sab_L3.php?id=<?php echo (int)$id - 1; ?>#1" method="post">
                        <?php agri_l3_filter_hiddens($id_ostan1, $id_city, $id_mar, $z_sal, $dis); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="Sab_L3.php?id=1#1" method="post">
                        <?php agri_l3_filter_hiddens($id_ostan1, $id_city, $id_mar, $z_sal, $dis); ?>
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
                    <span class="agri1-pager-btn is-current is-num" lang="en"><?php echo (int)$i; ?></span>
                    <?php } else { ?>
                    <form action="Sab_L3.php?id=<?php echo (int)$i; ?>#1" method="post">
                        <?php agri_l3_filter_hiddens($id_ostan1, $id_city, $id_mar, $z_sal, $dis); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int)$i; ?></button>
                    </form>
                    <?php } ?>
                </li>
                <?php } ?>
                <?php if ($show_last) { ?>
                    <?php if ($end_page < $total - 1) { ?>
                <li><span class="agri1-pager-ellipsis">...</span></li>
                    <?php } ?>
                <li>
                    <form action="Sab_L3.php?id=<?php echo (int)$total; ?>#1" method="post">
                        <?php agri_l3_filter_hiddens($id_ostan1, $id_city, $id_mar, $z_sal, $dis); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int)$total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if (isset($id) && $id != $total && $total > 0) { ?>
                <li>
                    <form action="Sab_L3.php?id=<?php echo (int)$id + 1; ?>#1" method="post">
                        <?php agri_l3_filter_hiddens($id_ostan1, $id_city, $id_mar, $z_sal, $dis); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="Sab_L3.php" method="post">
                    <?php agri_l3_filter_hiddens($id_ostan1, $id_city, $id_mar, $z_sal, $dis); ?>
                    <span>به صفحه</span>
                    <input type="text" inputmode="numeric" lang="en" dir="ltr" id="pageIdInput" name="page_input" value="<?php echo isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 1; ?>" placeholder="1"/>
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
                if (!isNaN(pageId) && pageId >= 1 && pageId <= <?php echo (int)$total; ?>) {
                    this.action = 'Sab_L3.php?id=' + pageId + '#1';
                } else {
                    e.preventDefault();
                    alert('لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo (int)$total; ?> وارد کنید.');
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
            var picker = document.getElementById('agri1-col-picker');
            var btn = document.getElementById('agri1-col-picker-btn');
            var panel = document.getElementById('agri1-col-panel');
            var table = document.querySelector('.agri1-table');
            if (!picker || !btn || !panel || !table) return;

            var KEY = 'Sab_L3_hidden_cols';
            var GROUP = {
                amal: ['a_dem', 'a_abi'],
                tolid: ['t_dem', 't_abi'],
                sath: ['s_dem', 's_abi'],
                spec: ['product', 'group_name']
            };

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
