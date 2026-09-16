<?php
include('../lock_p1.php');
include('../event.php');

if (!function_exists('agri2_h')) {
    function agri2_h($v)
    {
        if (!isset($v)) return '';
        return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
    }
}

function manager_benef_digits($v)
{
    $v = trim($v . '');
    $fa = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $en = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($fa, $en, $v);
}

function manager_benef_ops_svg($name)
{
    $d = array(
        'view' => '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>',
        'edit' => '<path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>',
        'mail' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 7 9-7"/>'
    );
    $p = isset($d[$name]) ? $d[$name] : '';
    return '<svg class="agri1-icon" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true">' . $p . '</svg>';
}

function manager_benef_valid_markup($valid, $rid)
{
    $valid = (string) $valid;
    if ($valid === '200') {
        $cls = 'is-ok';
        $title = 'تایید شده';
        $svg = '<path d="M20 6L9 17l-5-5"/>';
    } elseif ($valid === '600') {
        $cls = 'is-no';
        $title = 'تایید نشده';
        $svg = '<path d="M18 6L6 18"/><path d="M6 6l12 12"/>';
    } else {
        $cls = 'is-wait';
        $title = 'بررسی نشده';
        $svg = '<circle cx="12" cy="12" r="9"/><path d="M12 8v4"/><path d="M12 16h.01"/>';
    }
    return '<span class="agri1-valid ' . $cls . '" id="statusIcon' . (int) $rid . '" title="' . agri2_h($title) . '"><svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">' . $svg . '</svg></span>';
}

function manager_benef_pic($username)
{
    $pic = function_exists('user_pic') ? user_pic($username) : 'no_pic.png';
    $pic = basename(str_replace('\\', '/', $pic . ''));
    if ($pic === '' || $pic === '.' || $pic === '..') $pic = 'no_pic.png';
    return $pic;
}

$bah_cod_m = isset($_POST['bah_cod_m']) ? manager_benef_digits($_POST['bah_cod_m']) : '';
$bah_cod_m = preg_replace('/[^\d]/', '', $bah_cod_m);
$field_errors = array();
$did_search = isset($_POST['action']);
$stmt = null;
$t_row = 0;

if ($did_search) {
    if ($bah_cod_m === '') {
        $field_errors['bah_cod_m'] = 'کد ملی یا شناسه ملی را وارد کنید';
    } elseif (strlen($bah_cod_m) < 10 || strlen($bah_cod_m) > 11) {
        $field_errors['bah_cod_m'] = 'کد ملی ۱۰ رقم و شناسه ملی ۱۱ رقم است';
    }
}

$page_title = (isset($title) && $title !== '') ? $title : 'جستجوی یک بهره‌بردار';
$pahneh_crumb = array(
    array('label' => 'خانه', 'href' => '../indexbenef.php'),
    array('label' => 'اطلاعات اختصاصی', 'href' => 'index.php'),
    array('label' => 'بهره‌برداران کشاورزی', 'href' => 'benefic.php'),
    array('label' => 'جستجوی یک بهره‌بردار'),
);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo agri2_h($page_title); ?></title>
    <link href="../FA.css" rel="stylesheet" type="text/css"/>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script>
        function target_popup2(form) {
            window.open('null', 'formpopup', 'width=950,height=700,resizable,scrollbars');
            form.target = 'formpopup';
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
        .agri1-page .agri1-form #mor_cod_m,
        .agri1-page .agri1-form #bah_cod_m,
        .agri1-page .agri1-form #sh_meli {
            text-align: center;
            letter-spacing: 0.08em;
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
        .agri1-table th.agri1-ops-col,
        .agri1-table td.agri1-ops {
            width: 84px;
            padding: 4px 3px;
            white-space: nowrap;
        }
        .agri1-table .agri1-name-col {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .agri1-table td.agri1-tel-cell { white-space: normal; }
        .agri1-ops-bar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }
        .agri1-ops-bar form { display: inline-flex; margin: 0; }
        .agri1-ops-btn {
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
        .agri1-tel {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }
        .agri1-tel-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }
        .agri1-table .agri1-inline-input {
            width: 88px;
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
        .agri1-table .agri1-inline-input:focus {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
        }
        .agri1-table .agri1-tel-btn {
            min-width: 44px;
            min-height: 32px;
            padding: 4px 8px;
            font-size: 12px;
            border-radius: 8px;
            box-shadow: none;
        }
        .agri1-save-msg {
            font-size: 11px;
            min-height: 14px;
            line-height: 1.3;
        }
        .agri1-save-ok { color: var(--color-primary); }
        .agri1-save-err { color: var(--color-destructive); }
        .agri1-valid {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--color-muted-foreground);
        }
        .agri1-valid.is-ok { color: var(--color-primary); }
        .agri1-valid.is-no { color: var(--color-destructive); }
        .agri1-valid .agri1-icon {
            width: 20px;
            height: 20px;
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

        .agri1-expert {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
            font-size: 12px;
            white-space: normal;
        }
        .agri1-expert img {
            width: 32px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--color-border);
        }
        .agri1-card-search .agri1-grid {
            grid-template-columns: 1fr;
            max-width: 420px;
            margin: 0 auto;
            direction: rtl;
        }
        .agri1-page .agri1-form input[aria-invalid="true"] { border-color: var(--color-destructive); }
        .agri1-hint {
            margin: 6px 0 0;
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
        }
        .agri1-error {
            margin: 8px 0 0;
            color: var(--color-destructive);
            font-size: 0.875rem;
        }
        .is-hidden { display: none !important; }
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
    <?php include(__DIR__ . '/../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="liste-title">جستجوی یک بهره‌بردار</h1>
        </header>
        <section class="agri1-card agri1-card-search" aria-labelledby="liste-title">
            <form id="reg-form" class="agri1-form" method="post" action="manager_benef.php#1" novalidate>
                <h2 class="agri1-card-title">جستجو</h2>
                <div class="agri1-grid">
                    <div class="agri1-field">
                        <label class="agri1-label" for="bah_cod_m">کد ملی / شناسه ملی بهره‌بردار</label>
                        <input name="bah_cod_m" type="text" id="bah_cod_m" dir="ltr" inputmode="numeric" maxlength="11" autocomplete="off" value="<?php echo agri2_h($bah_cod_m); ?>" aria-invalid="<?php echo isset($field_errors['bah_cod_m']) ? 'true' : 'false'; ?>" aria-describedby="hint-bah_cod_m error-bah_cod_m"/>
                        <p class="agri1-hint" id="hint-bah_cod_m">کد ملی ۱۰ رقم یا شناسه ملی ۱۱ رقم</p>
                        <p class="agri1-error<?php echo isset($field_errors['bah_cod_m']) ? '' : ' is-hidden'; ?>" id="error-bah_cod_m"><?php echo isset($field_errors['bah_cod_m']) ? agri2_h($field_errors['bah_cod_m']) : ''; ?></p>
                    </div>
                </div>
                <div class="agri1-actions">
                    <button type="submit" name="action" id="action" value="1" class="agri1-btn agri1-btn-primary">جستجو</button>
                </div>
            </form>
        </section>

        <a name="1" id="1"></a>
<?php
if ($did_search && empty($field_errors)) {
    $query = "SELECT bah.*
,list_abadi.ostan,list_abadi.city as city1,list_abadi.abadi,list_abadi.mar
,list_city.ostan,list_city.city as city2,list_city.shahr,list_city.mar
 FROM  bah
 left join list_abadi on list_abadi.add_abadi = bah.add_abadi
 left join list_city  on list_city.add_city   = bah.add_city
where  bah.bah_cod_m = :bah_cod_m or  bah.sh_meli = :sh_meli";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m, ':sh_meli' => $bah_cod_m));
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
                            <li><label><input type="checkbox" data-col-toggle="ops" checked/> عملیات</label></li>
                            <li><label><input type="checkbox" data-col-toggle="expert" checked/> کارشناس پهنه</label></li>
                            <li><label><input type="checkbox" data-col-toggle="life" checked/> آخرین وضعیت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="date_s" checked/> تاریخ ثبت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="valid" checked/> احراز هویت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="tel" checked/> شماره همراه</label></li>
                            <li><label><input type="checkbox" data-col-toggle="cod_m" checked/> کد ملی / شناسه ملی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="lname" checked/> نام خانوادگی / شرکت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="name" checked/> نام</label></li>
                            <li><label><input type="checkbox" data-col-toggle="no_bah" checked/> نوع بهره‌بردار</label></li>
                            <li><label><input type="checkbox" data-col-toggle="abadi" checked/> شهر / آبادی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="city" checked/> شهرستان</label></li>
                            <li><label><input type="checkbox" data-col-toggle="rownum" checked/> ردیف</label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <colgroup>
                        <col data-col="ops" style="width:8%"/>
                        <col data-col="expert" style="width:9%"/>
                        <col data-col="life" style="width:8%"/>
                        <col data-col="date_s" style="width:8%"/>
                        <col data-col="valid" style="width:6%"/>
                        <col data-col="tel" style="width:13%"/>
                        <col data-col="cod_m" style="width:10%"/>
                        <col data-col="lname" style="width:10%"/>
                        <col data-col="name" style="width:7%"/>
                        <col data-col="no_bah" style="width:6%"/>
                        <col data-col="abadi" style="width:8%"/>
                        <col data-col="city" style="width:7%"/>
                        <col data-col="rownum" style="width:4%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="agri1-ops-col" data-col="ops">عملیات</th>
                            <th data-col="expert">کارشناس پهنه</th>
                            <th data-col="life">آخرین وضعیت بهره‌بردار</th>
                            <th data-col="date_s">تاریخ ثبت / ویرایش</th>
                            <th data-col="valid">احراز هویت</th>
                            <th data-col="tel">شماره همراه</th>
                            <th data-col="cod_m">کد ملی / شناسه ملی</th>
                            <th data-col="lname">نام خانوادگی / نام شرکت</th>
                            <th data-col="name">نام</th>
                            <th data-col="no_bah">نوع بهره‌بردار</th>
                            <th data-col="abadi">شهر / آبادی</th>
                            <th data-col="city">شهرستان</th>
                            <th data-col="rownum">ردیف</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
        $r = 1;
        $t_r = 1;
        foreach ($stmt as $row) {
            $mor_cod_m = $row['mor_cod_m'];
            $pic = manager_benef_pic($mor_cod_m);
            $v_ok = '';
            if ($row['ok'] == '3') $v_ok = 'در حال استعلام';
            if ($row['ok'] == '1') $v_ok = 'زنده';
            if ($row['ok'] == '2') $v_ok = 'فوتی';
            if ($row['ok'] == '4') $v_ok = 'تایید نشده';
            $v_no_bah = ($row['no_bah'] == '1') ? 'حقیقی' : 'حقوقی';
            $date_t_flat = substr($row['date_t'], 0, 4) . substr($row['date_t'], 5, 2) . substr($row['date_t'], 8, 2);
            $expert_name = function_exists('user_name') ? str_replace('&nbsp;', ' ', user_name($mor_cod_m)) : '';
?>
                        <tr>
                            <td class="agri1-ops" data-col="ops">
                                <div class="agri1-ops-bar">
<?php if ($mor_cod_m == $login_session) { ?>
                                    <form action="edit_benef.php" method="post">
                                        <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                        <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>"/>
                                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                        <input type="hidden" name="num_bah" value="<?php echo agri2_h($row['num_bah']); ?>"/>
                                        <input type="hidden" name="no_bah" value="<?php echo agri2_h($row['no_bah']); ?>"/>
                                        <input type="hidden" name="no_nation" value="<?php echo agri2_h($row['no_nation']); ?>"/>
                                        <input type="hidden" name="s_bah" value="<?php echo agri2_h($row['s_bah']); ?>"/>
                                        <input type="hidden" name="sh_meli" value="<?php echo agri2_h($row['sh_meli']); ?>"/>
                                        <input type="hidden" name="date_t" value="<?php echo agri2_h($date_t_flat); ?>"/>
                                        <button type="submit" class="agri1-ops-btn" title="ویرایش اطلاعات بهره‌بردار" aria-label="ویرایش اطلاعات بهره‌بردار"><?php echo manager_benef_ops_svg('edit'); ?></button>
                                    </form>
<?php } else { ?>
                                    <form action="../send_pm1.php#1" method="post" onsubmit="target_popup2(this)">
                                        <input type="hidden" name="username" value="<?php echo agri2_h($row['mor_cod_m']); ?>"/>
                                        <button type="submit" class="agri1-ops-btn" title="ارسال پیام به کارشناس" aria-label="ارسال پیام به کارشناس"><?php echo manager_benef_ops_svg('mail'); ?></button>
                                    </form>
<?php } ?>
                                    <form action="view_benef1.php#1" method="post" onsubmit="target_popup2(this)">
                                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                        <input type="hidden" name="no_bah" value="<?php echo agri2_h($row['no_bah']); ?>"/>
                                        <button type="submit" class="agri1-ops-btn" title="نمایش اطلاعات بهره‌بردار" aria-label="نمایش اطلاعات بهره‌بردار"><?php echo manager_benef_ops_svg('view'); ?></button>
                                    </form>
                                </div>
                            </td>
                            <td data-col="expert">
                                <div class="agri1-expert">
                                    <img src="../files/users/<?php echo agri2_h($pic); ?>" width="32" height="40" alt=""/>
                                    <span><?php echo agri2_h($expert_name); ?></span>
                                    <span dir="ltr"><?php echo agri2_h($mor_cod_m); ?></span>
                                </div>
                            </td>
                            <td data-col="life"><?php echo agri2_h($v_ok); ?></td>
                            <td data-col="date_s"><?php echo agri2_h($row['date_s']); ?></td>
                            <td data-col="valid"><?php echo manager_benef_valid_markup($row['valid'], $t_r); ?></td>
                            <td class="agri1-tel-cell" data-col="tel">
                                <div class="agri1-tel">
                                    <input type="hidden" id="id<?php echo (int) $t_r; ?>" value="<?php echo agri2_h($row['id']); ?>"/>
                                    <input type="hidden" id="bah_cod_m<?php echo (int) $t_r; ?>" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                    <div class="agri1-tel-row">
                                        <input name="tel_m" type="text" class="agri1-inline-input" id="tel_m<?php echo (int) $t_r; ?>" dir="ltr" inputmode="numeric" maxlength="11" value="<?php echo agri2_h($row['tel_m']); ?>" aria-label="شماره همراه"/>
                                        <button type="button" class="agri1-btn agri1-btn-primary agri1-tel-btn" data-no="<?php echo (int) $t_r; ?>">ثبت</button>
                                    </div>
                                    <span class="agri1-save-msg" id="telMsg<?php echo (int) $t_r; ?>" role="status"></span>
                                </div>
                            </td>
                            <td data-col="cod_m" dir="ltr"><?php echo agri2_h($row['bah_cod_m']); ?><br/><?php echo agri2_h($row['sh_meli']); ?></td>
                            <td class="agri1-name-col" data-col="lname"><?php echo agri2_h($row['last_name']); ?><br/><?php echo agri2_h($row['co_name']); ?></td>
                            <td class="agri1-name-col" data-col="name"><?php echo agri2_h($row['name']); ?></td>
                            <td data-col="no_bah"><?php echo agri2_h($v_no_bah); ?></td>
                            <td class="agri1-name-col" data-col="abadi"><?php echo agri2_h($row['abadi']); ?><?php echo agri2_h($row['shahr']); ?><br/><?php echo agri2_h($row['add_abadi']); ?><?php echo agri2_h($row['add_city']); ?></td>
                            <td class="agri1-name-col" data-col="city"><?php echo agri2_h($row['city1']); ?><?php echo agri2_h($row['city2']); ?></td>
                            <td data-col="rownum"><?php echo (int) $r; ?></td>
                        </tr>
<?php
            $r++;
            $t_r++;
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
        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="benefic.php" title="برگشت به صفحه قبل">
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
    <script>
        (function () {
            var fa = '۰۱۲۳۴۵۶۷۸۹';
            var ar = '٠١٢٣٤٥٦٧٨٩';
            var el = document.getElementById('bah_cod_m');
            if (el) {
                el.addEventListener('input', function () {
                    this.value = String(this.value).replace(/[۰-۹٠-٩]/g, function (ch) {
                        var i = fa.indexOf(ch);
                        if (i > -1) return String(i);
                        i = ar.indexOf(ch);
                        return i > -1 ? String(i) : ch;
                    }).replace(/[^\d]/g, '');
                });
            }
            var form = document.getElementById('reg-form');
            var overlay = document.getElementById('agri1-overlay');
            var submitBtn = document.getElementById('action');
            var busy = false;
            if (!form) return;
            form.addEventListener('submit', function (e) {
                if (busy) { e.preventDefault(); return; }
                var v = el ? el.value.replace(/[^\d]/g, '') : '';
                if (el) el.value = v;
                var err = document.getElementById('error-bah_cod_m');
                if (!v || v.length < 10 || v.length > 11) {
                    e.preventDefault();
                    if (el) el.setAttribute('aria-invalid', 'true');
                    if (err) { err.textContent = 'کد ملی ۱۰ رقم و شناسه ملی ۱۱ رقم است'; err.classList.remove('is-hidden'); }
                    if (el) el.focus();
                    return;
                }
                busy = true;
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
            var KEY = 'manager_benef_hidden_cols';
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
                for (var n = 0; n < ids.length; n++) { if (map[ids[n]]) hiddenCount++; }
                var label = btn.querySelector('.agri1-col-picker-label');
                if (label) label.textContent = hiddenCount > 0 ? ('ستون‌ها (' + hiddenCount + ' پنهان)') : 'ستون‌ها';
            }
            var hidden = readHidden();
            apply(hidden);
            function openPanel() { picker.classList.add('is-open'); btn.setAttribute('aria-expanded', 'true'); }
            function closePanel() { picker.classList.remove('is-open'); btn.setAttribute('aria-expanded', 'false'); }
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                if (picker.classList.contains('is-open')) closePanel(); else openPanel();
            });
            panel.addEventListener('click', function (e) { e.stopPropagation(); });
            document.addEventListener('click', function () { closePanel(); });
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
            if (resetBtn) {
                resetBtn.addEventListener('click', function () { hidden = {}; writeHidden(hidden); apply(hidden); });
            }
        })();
        (function ($) {
            function setValidStatus(no, kind) {
                var el = document.getElementById('statusIcon' + no);
                if (!el) return;
                var ok = kind === 'ok';
                el.className = 'agri1-valid ' + (ok ? 'is-ok' : 'is-no');
                el.title = ok ? 'تایید شده' : 'تایید نشده';
                el.innerHTML = ok
                    ? '<svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>'
                    : '<svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>';
            }
            function setTelMsg(no, text, ok) {
                var msg = document.getElementById('telMsg' + no);
                if (!msg) return;
                msg.textContent = text;
                msg.className = 'agri1-save-msg ' + (ok ? 'agri1-save-ok' : 'agri1-save-err');
            }
            $(document).on('click', '.agri1-tel-btn', function () {
                var btn = this;
                if (btn.getAttribute('data-busy') === '1') return false;
                var no = btn.getAttribute('data-no');
                var tel_m = $('#tel_m' + no).val();
                var id = $('#id' + no).val();
                var bah_cod_m = $('#bah_cod_m' + no).val();
                if (!tel_m || tel_m.length < 11) {
                    setTelMsg(no, 'ثبت نشد', false);
                    return false;
                }
                btn.setAttribute('data-busy', '1');
                btn.setAttribute('aria-busy', 'true');
                $.ajax({
                    type: 'POST',
                    url: 'tel_m_sabt_s.php',
                    data: { tel_m: tel_m, id: id, bah_cod_m: bah_cod_m },
                    success: function (response) {
                        var out = String(response).trim();
                        if (out === 'success') {
                            setTelMsg(no, 'ثبت شد', true);
                            setValidStatus(no, 'ok');
                        } else if (out === 'no_match') {
                            setTelMsg(no, 'عدم مطابقت شماره و کد ملی', false);
                            setValidStatus(no, 'no');
                        } else {
                            setTelMsg(no, 'ثبت نشد', false);
                        }
                    },
                    error: function () { setTelMsg(no, 'ثبت نشد', false); },
                    complete: function () {
                        btn.setAttribute('data-busy', '0');
                        btn.removeAttribute('aria-busy');
                    }
                });
                return false;
            });
        })(jQuery);
    </script>
</body>
</html>
