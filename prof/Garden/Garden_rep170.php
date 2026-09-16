<?php
include('../../lock_p1.php');
include('../../event.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function garden170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $no_kesh, $nah_kesh, $m_ab, $no_ab, $mor_cod_m, $bah_cod_m, $z_sal, $skb1, $skb2, $skgb1, $skgb2, $treeb1, $treeb2, $treegb1, $treegb2, $mtol1, $mtol2, $mtolp1, $mtolp2, $mah_kh, $mah_qroup, $mah_name)
{
    $pairs = array(
        'action' => '1',
        'id_ostan' => $id_ostan1,
        'id_city5' => $id_city,
        'id_mar' => $id_mar,
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'no_kesh' => $no_kesh,
        'nah_kesh' => $nah_kesh,
        'm_ab' => $m_ab,
        'no_ab' => $no_ab,
        'mor_cod_m' => $mor_cod_m,
        'bah_cod_m' => $bah_cod_m,
        'z_sal' => $z_sal,
        'skb1' => $skb1,
        'skb2' => $skb2,
        'skgb1' => $skgb1,
        'skgb2' => $skgb2,
        'treeb1' => $treeb1,
        'treeb2' => $treeb2,
        'treegb1' => $treegb1,
        'treegb2' => $treegb2,
        'mtol1' => $mtol1,
        'mtol2' => $mtol2,
        'mtolp1' => $mtolp1,
        'mtolp2' => $mtolp2,
        'mah_kh' => $mah_kh,
        'mah_qroup' => $mah_qroup,
        'mah_name' => $mah_name
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

function garden170_export_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $no_kesh, $nah_kesh, $m_ab, $no_ab, $mor_cod_m, $bah_cod_m, $z_sal, $mah_name, $skb1, $skb2, $skgb1, $skgb2, $treeb1, $treeb2, $treegb1, $treegb2, $mtolp1, $mtolp2, $mtol1, $mtol2, $mah_kh)
{
    $pairs = array(
        'id_ostan' => $id_ostan1,
        'id_city' => $id_city,
        'id_mar' => $id_mar,
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'no_kesh' => $no_kesh,
        'nah_kesh' => $nah_kesh,
        'm_ab' => $m_ab,
        'no_ab' => $no_ab,
        'mor_cod_m' => $mor_cod_m,
        'bah_cod_m' => $bah_cod_m,
        'z_sal' => $z_sal,
        'mah_name' => $mah_name,
        'skb1' => $skb1,
        'skb2' => $skb2,
        'skgb1' => $skgb1,
        'skgb2' => $skgb2,
        'treeb1' => $treeb1,
        'treeb2' => $treeb2,
        'treegb1' => $treegb1,
        'treegb2' => $treegb2,
        'mtolp1' => $mtolp1,
        'mtolp2' => $mtolp2,
        'mtol1' => $mtol1,
        'mtol2' => $mtol2,
        'mah_kh' => $mah_kh
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

$id_ostan1 = $id_ostan;
$id_city = $id_city;
$id_mar = $id_mar;
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$nah_kesh = isset($_POST['nah_kesh']) ? $_POST['nah_kesh'] : '';
$m_ab = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
$no_ab = isset($_POST['no_ab']) ? $_POST['no_ab'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$skb1 = isset($_POST['skb1']) ? $_POST['skb1'] : '';
$skb2 = isset($_POST['skb2']) ? $_POST['skb2'] : '';
$skgb1 = isset($_POST['skgb1']) ? $_POST['skgb1'] : '';
$skgb2 = isset($_POST['skgb2']) ? $_POST['skgb2'] : '';
$treeb1 = isset($_POST['treeb1']) ? $_POST['treeb1'] : '';
$treeb2 = isset($_POST['treeb2']) ? $_POST['treeb2'] : '';
$treegb1 = isset($_POST['treegb1']) ? $_POST['treegb1'] : '';
$treegb2 = isset($_POST['treegb2']) ? $_POST['treegb2'] : '';
$mtol1 = isset($_POST['mtol1']) ? $_POST['mtol1'] : '';
$mtol2 = isset($_POST['mtol2']) ? $_POST['mtol2'] : '';
$mtolp1 = isset($_POST['mtolp1']) ? $_POST['mtolp1'] : '';
$mtolp2 = isset($_POST['mtolp2']) ? $_POST['mtolp2'] : '';
$mah_kh = isset($_POST['mah_kh']) ? $_POST['mah_kh'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
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
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".country").change(function () {
                var id = $(this).val();
                var dataString = 'group_cod=' + id;
                $.ajax({
                    type: "POST",
                    url: "ajax_garden.php",
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
        function target_popup(form) {
            window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
            form.target = 'formpopup';
        }
        function target_popup2(form) {
            window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
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
        array('label' => 'گزارش اختصاصی اطلاعات باغی'),
    );
    include(__DIR__ . '/../../chrome.php');
    ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri170-title">گزارش اختصاصی اطلاعات باغی</h1>
        </header>

        <section class="agri1-card agri1-card-search" aria-labelledby="agri170-title">
            <form id="reg-form" class="agri1-form" method="post" action="#1" novalidate>
                <h2 class="agri1-card-title">جستجو</h2>
                <div class="agri1-grid">
                    <div class="agri1-field">
                        <label class="agri1-label" for="z_sal">سال زراعی</label>
                        <select name="z_sal" class="input_text required" id="z_sal">
                            <option value="1404" <?php if ($z_sal == '1404') echo 'selected="selected"'; ?>>1404</option>
                            <option value="1403" <?php if ($z_sal == '1403') echo 'selected="selected"'; ?>>1403</option>
                            <option value="1402" <?php if ($z_sal == '1402') echo 'selected="selected"'; ?>>1402</option>
                            <option value="1401" <?php if ($z_sal == '1401') echo 'selected="selected"'; ?>>1401</option>
                            <option value="1400" <?php if ($z_sal == '1400') echo 'selected="selected"'; ?>>1400</option>
                            <option value="1399" <?php if ($z_sal == '1399') echo 'selected="selected"'; ?>>1399</option>
                            <option value="1398" <?php if ($z_sal == '1398') echo 'selected="selected"'; ?>>1398</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_ostan">استان</label>
                        <?php $id_ostan1 = $id_ostan; ?>
                        <select name="id_ostan" disabled="disabled" class="style8" id="id_ostan" dir="rtl">
                            <option value="-1">انتخاب استان</option>
                            <?php
                            $query = "SELECT  id_ostan,ostan FROM `ostanname`  ORDER BY BINARY ostan ASC ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['id_ostan']); ?>"
                                <?php if ($row['id_ostan'] == $id_ostan1) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['ostan']); ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="id_ostan" value="<?php echo agri2_h($id_ostan1); ?>"/>
                        <?php
                        if (isset($_POST['id_ostan'])) {
                            $id_ostan1 = $_POST['id_ostan'];
                        }
                        ?>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="no_bah2">نوع کشت</label>
                        <select name="no_kesh" class="input_text required" id="no_bah2">
                            <option value="0">انتخاب کنید</option>
                            <option value="1" <?php if ($no_kesh == "1") echo "selected='selected'"; ?>>آبی</option>
                            <option value="2" <?php if ($no_kesh == "2") echo "selected='selected'"; ?>>دیم</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_city">شهرستان</label>
                        <select name="id_city5" disabled="disabled" class="input_text" id="id_city" dir="rtl">
                            <option value="0"> کل استان</option>
                            <?php
                            $query = "SELECT  id_city,city FROM `cityname` WHERE  `id_ostan` = '$id_ostan1' ORDER BY BINARY city ASC ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['id_city']); ?>"
                                <?php if ($row['id_city'] == $id_city) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['city']); ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="id_city5" value="<?php echo agri2_h($id_city); ?>"/>
                        <?php
                        if (isset($_POST['id_city5'])) {
                            $id_city = $_POST['id_city5'];
                        }
                        ?>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_abadi">نام آبادی</label>
                        <select name="add_abadi" class="input_text" id="add_abadi" dir="rtl">
                            <option value="0">انتخاب نام آبادی</option>
                            <?php
                            $query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `id_mar` = '$id_mar' ORDER BY BINARY abadi ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['add_abadi']); ?>"
                                <?php if ($row['add_abadi'] == $add_abadi) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['abadi']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_mar">مرکز جهاد کشاورزی</label>
                        <select name="id_mar" disabled="disabled" class="input_text" id="id_mar" dir="rtl">
                            <option value="0"> نام مرکز</option>
                            <?php
                            $query = "SELECT  id_mar,mar FROM `mar` WHERE  `id_ostan` = '$id_ostan1' and `id_city` = '$id_city'";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['id_mar']); ?>"
                                <?php if ($row['id_mar'] == $id_mar) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['mar']); ?></option>
                            <?php } ?>
                        </select>
                        <?php
                        if (isset($_POST['id_mar'])) {
                            $id_mar = $_POST['id_mar'];
                        }
                        ?>
                        <input name="id_city2" type="hidden" value="<?php echo agri2_h($id_city); ?>"/>
                        <input type="hidden" name="id_mar" value="<?php echo agri2_h($id_mar); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_city">نام شهر</label>
                        <select name="add_city" class="input_text" id="add_city" dir="rtl">
                            <option value="0">انتخاب نام شهر</option>
                            <?php
                            $query = "SELECT  add_city,shahr FROM `list_city` WHERE  `id_mar` = '$id_mar' ORDER BY BINARY shahr ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['add_city']); ?>"
                                <?php if ($row['add_city'] == $add_city) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['shahr']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field" aria-hidden="true"></div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="bah_cod_m">کد ملی بهره‌بردار</label>
                        <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mor_cod_m">کد ملی مروج</label>
                        <input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($login_session); ?>" readonly="readonly"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="no_ab">نحوه آبیاری</label>
                        <select name="no_ab" class="input_text required" id="no_ab" tabindex="18">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($no_ab == '1') { echo 'selected="selected"'; } ?>>جوی و پشته</option>
                            <option value="2" <?php if ($no_ab == '2') { echo 'selected="selected"'; } ?>>نواری</option>
                            <option value="3" <?php if ($no_ab == '3') { echo 'selected="selected"'; } ?>>غرقابی</option>
                            <option value="4" <?php if ($no_ab == '4') { echo 'selected="selected"'; } ?>>تشتکی</option>
                            <option value="5" <?php if ($no_ab == '5') { echo 'selected="selected"'; } ?>>تحت فشار قطره ای</option>
                            <option value="6" <?php if ($no_ab == '6') { echo 'selected="selected"'; } ?>>تحت فشار بارانی</option>
                            <option value="7" <?php if ($no_ab == '7') { echo 'selected="selected"'; } ?>>سایر</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="m_ab">منبع آب</label>
                        <select name="m_ab" class="input_text required" id="m_ab" tabindex="14">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($m_ab == '1') { echo 'selected="selected"'; } ?>>چشمه</option>
                            <option value="2" <?php if ($m_ab == '2') { echo 'selected="selected"'; } ?>>قنات</option>
                            <option value="3" <?php if ($m_ab == '3') { echo 'selected="selected"'; } ?>>رودخانه</option>
                            <option value="4" <?php if ($m_ab == '4') { echo 'selected="selected"'; } ?>>سد</option>
                            <option value="5" <?php if ($m_ab == '5') { echo 'selected="selected"'; } ?>>چاه سطحی</option>
                            <option value="6" <?php if ($m_ab == '6') { echo 'selected="selected"'; } ?>>چاه عمیق</option>
                            <option value="7" <?php if ($m_ab == '7') { echo 'selected="selected"'; } ?>>چاه نیمه عمیق</option>
                            <option value="8" <?php if ($m_ab == '8') { echo 'selected="selected"'; } ?>>زهکش</option>
                            <option value="9" <?php if ($m_ab == '9') { echo 'selected="selected"'; } ?>>پساب</option>
                            <option value="10" <?php if ($m_ab == '10') { echo 'selected="selected"'; } ?>>آب بندان</option>
                            <option value="11" <?php if ($m_ab == '11') { echo 'selected="selected"'; } ?>>سایر</option>
                        </select>
                    </div>
                    <div class="agri1-field" aria-hidden="true"></div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="nah_kesh">نحوه کشت</label>
                        <p class="agri1-hint">برای کشت پراکنده نباید نوع کشت انتخاب شود</p>
                        <select name="nah_kesh" class="input_text required" id="nah_kesh">
                            <option value="0">انتخاب کنید</option>
                            <option value="1" <?php if ($nah_kesh == "1") echo "selected='selected'"; ?>>ساده</option>
                            <option value="2" <?php if ($nah_kesh == "2") echo "selected='selected'"; ?>>مخلوط</option>
                            <option value="3" <?php if ($nah_kesh == "3") echo "selected='selected'"; ?>>پراکنده</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="skb2">سطح زیر کشت بارور — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="skb2" type="text" class="input_text" id="skb2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($skb2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="skb1">سطح زیر کشت بارور — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="skb1" type="text" class="input_text" id="skb1" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($skb1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="skgb2">سطح زیر کشت غیر بارور — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="skgb2" type="text" class="input_text" id="skgb2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($skgb2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="skgb1">سطح زیر کشت غیر بارور — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="skgb1" type="text" class="input_text" id="skgb1" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($skgb1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="treeb2">تعداد درخت بارور — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">اصله</p>
                        <input name="treeb2" type="text" class="input_text" id="treeb2" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($treeb2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="treeb1">تعداد درخت بارور — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">اصله</p>
                        <input name="treeb1" type="text" class="input_text" id="treeb1" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($treeb1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="treegb2">تعداد درخت غیر بارور — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">اصله</p>
                        <input name="treegb2" type="text" class="input_text" id="treegb2" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($treegb2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="treegb1">تعداد درخت غیر بارور — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">اصله</p>
                        <input name="treegb1" type="text" class="input_text" id="treegb1" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($treegb1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mah_name">نام محصول</label>
                        <select name="mah_name" class="required input_text mar" id="mah_name" tabindex="23" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            <?php
                            $query = "SELECT DISTINCT product_cod,product_name FROM `product_b` WHERE  `group_cod` = '$mah_qroup' ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['product_cod']); ?>"
                                <?php if ($row['product_cod'] == $mah_name) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['product_name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mah_qroup">گروه محصولات</label>
                        <select name="mah_qroup" class="required input_text country" id="mah_qroup" tabindex="22" dir="rtl">
                            <option value=""> انتخاب گروه</option>
                            <?php
                            include_once('../../login/config.php');
                            $query = "SELECT DISTINCT group_cod,group_name FROM `product_b` ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['group_cod']); ?>"
                                <?php if ($row['group_cod'] == $mah_qroup) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['group_name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mtolp2">میزان پیش‌بینی محصول — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">تن</p>
                        <input name="mtolp2" type="text" class="input_text" id="mtolp2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($mtolp2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mtolp1">میزان پیش‌بینی محصول — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">تن</p>
                        <input name="mtolp1" type="text" class="input_text" id="mtolp1" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($mtolp1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mtol2">میزان تولید محصول — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">تن</p>
                        <input name="mtol2" type="text" class="input_text" id="mtol2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($mtol2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mtol1">میزان تولید محصول — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">تن</p>
                        <input name="mtol1" type="text" class="input_text" id="mtol1" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($mtol1); ?>"/>
                    </div>
                    <div class="agri1-field" aria-hidden="true"></div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mah_kh">خسارت</label>
                        <select name="mah_kh" class="required input_text" id="mah_kh" tabindex="30">
                            <option value="0">انتخاب کنید</option>
                            <option value="1" <?php if ($mah_kh == '1') { echo 'selected="selected"'; } ?>>بلی</option>
                            <option value="2" <?php if ($mah_kh == '2') { echo 'selected="selected"'; } ?>>خیر</option>
                        </select>
                    </div>
                </div>
                <div class="agri1-actions">
                    <button type="submit" name="action" id="action" value="اجرای کوئری" class="agri1-btn agri1-btn-primary">اجرای کوئری</button>
                </div>
            </form>
        </section>

        <a name="1" id="1"></a>
        <?php
        $query1 = '';
        $limit = 10;
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
        if ($id < 1) $id = 1;
        $start = 0;

        if (isset($_POST['action']))
        {
 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "Garden_prod.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "Garden_prod.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "Garden_prod.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "Garden_prod.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "Garden_prod.add_city = '$add_city'" ;}
 if ($no_kesh == '0')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "Garden.no_kesh = '$no_kesh'" ;}
 if ($nah_kesh == '0')  { $f_nah_kesh  = 1  ; }else{ $f_nah_kesh = "Garden.nah_kesh = '$nah_kesh'" ;}
 if ($m_ab == '')  { $f_m_ab  = 1  ; }else{ $f_m_ab = "Garden.m_ab = '$m_ab'" ;}
 if ($no_ab == '')  { $f_no_ab  = 1  ; }else{ $f_no_ab = "Garden.no_ab = '$no_ab'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "Garden_prod.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "Garden_prod.bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "Garden_prod.z_sal = '$z_sal'" ;}
 if ($mah_name == '')  { $v_cod_mah  = 1  ; }else{ $v_cod_mah = "Garden_prod.cod_mah = '$mah_name'" ;}
 if ($skb1 == '')  { $v_skb1  = 1  ; }else{ $v_skb1 = "Garden_prod.s_kesht_b >= $skb1" ;}
 if ($skb2 == '')  { $v_skb2  = 1  ; }else{ $v_skb2 = "Garden_prod.s_kesht_b <= $skb2" ;}
 if ($skgb1 == '')  { $v_skgb1  = 1  ; }else{ $v_skgb1 = "Garden_prod.s_kesht_gb >= $skgb1" ;}
 if ($skgb2 == '')  { $v_skgb2  = 1  ; }else{ $v_skgb2 = "Garden_prod.s_kesht_gb <= $skgb2" ;}
 if ($treeb1 == '')  { $v_treeb1  = 1  ; }else{ $v_treeb1 = "Garden_prod.tree_b >= $treeb1" ;}
 if ($treeb2 == '')  { $v_treeb2  = 1  ; }else{ $v_treeb2 = "Garden_prod.tree_b <= $treeb2" ;}
 if ($treegb1 == '')  { $v_treegb1  = 1  ; }else{ $v_treegb1 = "Garden_prod.tree_gb >= $treegb1" ;}
 if ($treegb2 == '')  { $v_treegb2  = 1  ; }else{ $v_treegb2 = "Garden_prod.tree_gb <= $treegb2" ;}
 if ($mtol1 == '')  { $v_mtol1  = 1  ; }else{ $v_mtol1 = "Garden_prod.mah_tol >= $mtol1" ;}
 if ($mtol2 == '')  { $v_mtol2  = 1  ; }else{ $v_mtol2 = "Garden_prod.mah_tol <= $mtol2" ;}
 if ($mtolp1 == '')  { $v_mtolp1  = 1  ; }else{ $v_mtolp1 = "Garden_prod.mah_tolp >= $mtolp1" ;}
 if ($mtolp2 == '')  { $v_mtolp2  = 1  ; }else{ $v_mtolp2 = "Garden_prod.mah_tolp <= $mtolp2" ;}
 if ($mah_kh == '0')  { $f_mah_kh  = 1  ; }else{ $f_mah_kh = "Garden_prod.mah_kh = '$mah_kh'" ;}

 include_once('../../login/config.php');
$start=0;
$limit=10;
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
if ($id < 1) $id = 1;
$start=($id-1)*$limit;
  $query = " SELECT Garden_prod.*,Garden.nah_kesh
FROM Garden_prod
INNER JOIN Garden ON Garden_prod.Garden_id = Garden.id
where  $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $f_nah_kesh and $f_m_ab and $f_no_ab and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah and $v_treeb1 and $v_treeb2 and $v_treegb1 and $v_treegb2 and $v_skb1 and $v_skb2 and $v_skgb1 and $v_skgb2 and $v_mtolp1 and $v_mtolp2 and $v_mtol1 and $v_mtol2 and  $f_mah_kh ORDER BY Garden_prod.bah_cod_m ASC LIMIT $start, $limit ";
 $query1 = "SELECT count(*)
FROM Garden_prod
INNER JOIN Garden ON Garden_prod.Garden_id = Garden.id
where  $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $f_nah_kesh and $f_m_ab and $f_no_ab and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah and $v_treeb1 and $v_treeb2 and $v_treegb1 and $v_treegb2 and $v_skb1 and $v_skb2 and $v_skgb1 and $v_skgb2 and $v_mtolp1 and $v_mtolp2 and $v_mtol1 and $v_mtol2 and  $f_mah_kh  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ;
if ($t_row>0) {
if($nah_kesh=="1")  $f_nah_kesh = 'ساده'  ;
if($nah_kesh=="2")  $f_nah_kesh = 'مخلوط' ;
if($nah_kesh=="3")  $f_nah_kesh = 'پراکنده' ;
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
                            <li><label><input type="checkbox" data-col-toggle="ops_msg" checked/> پیام</label></li>
                            <li><label><input type="checkbox" data-col-toggle="ops_view" checked/> مشاهده</label></li>
                            <li><label><input type="checkbox" data-col-toggle="product" checked/> نام محصول</label></li>
                            <li><label><input type="checkbox" data-col-toggle="mah_tol" checked/> میزان محصول قطعی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="mah_tolp" checked/> میزان محصول پیش‌بینی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="tree_kol" checked/> تعداد درخت کل</label></li>
                            <li><label><input type="checkbox" data-col-toggle="treegb" checked/> درخت غیر بارور</label></li>
                            <li><label><input type="checkbox" data-col-toggle="treeb" checked/> درخت بارور</label></li>
                            <li><label><input type="checkbox" data-col-toggle="kesht_kol" checked/> سطح زیر کشت کل</label></li>
                            <li><label><input type="checkbox" data-col-toggle="s_keshtgb" checked/> سطح غیر بارور</label></li>
                            <li><label><input type="checkbox" data-col-toggle="s_keshtb" checked/> سطح بارور</label></li>
                            <li><label><input type="checkbox" data-col-toggle="nah_kesh" checked/> نحوه کاشت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="bah_cod_m" checked/> کد ملی بهره‌بردار</label></li>
                            <li><label><input type="checkbox" data-col-toggle="name" checked/> نام و نام خانوادگی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="rownum" checked/> ردیف</label></li>
                        </ul>
                    </div>
                </div>
                <div class="agri1-xls">
                    <form action="Garden_rep170_xls.php" method="post">
                        <?php garden170_export_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $no_kesh, $nah_kesh, $m_ab, $no_ab, $mor_cod_m, $bah_cod_m, $z_sal, $mah_name, $skb1, $skb2, $skgb1, $skgb2, $treeb1, $treeb2, $treegb1, $treegb2, $mtolp1, $mtolp2, $mtol1, $mtol2, $mah_kh); ?>
                        <button type="submit" title="دانلود نتایج با فرمت فایل اکسل">
                            <img src="../../files/xls.png" width="44" height="40" alt="خروجی اکسل"/>
                        </button>
                    </form>
                    <form action="Garden_rep170_doc.php" method="post">
                        <?php garden170_export_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $no_kesh, $nah_kesh, $m_ab, $no_ab, $mor_cod_m, $bah_cod_m, $z_sal, $mah_name, $skb1, $skb2, $skgb1, $skgb2, $treeb1, $treeb2, $treegb1, $treegb2, $mtolp1, $mtolp2, $mtol1, $mtol2, $mah_kh); ?>
                        <button type="submit" title="دانلود نتایج با فرمت فایل ورد">
                            <img src="../../files/word.png" width="44" height="40" alt="خروجی ورد"/>
                        </button>
                    </form>
                </div>
            </div>
            <p class="agri1-table-hint">برای مشاهده همه ستون‌ها جدول را افقی بکشید.</p>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <colgroup>
                        <col data-col="ops_msg" style="width:5%"/>
                        <col data-col="ops_view" style="width:5%"/>
                        <col data-col="product" style="width:9%"/>
                        <col data-col="mah_tol" style="width:6%"/>
                        <col data-col="mah_tolp" style="width:6%"/>
                        <col data-col="tree_kol" style="width:5%"/>
                        <col data-col="treegb" style="width:5%"/>
                        <col data-col="treeb" style="width:5%"/>
                        <col data-col="kesht_kol" style="width:6%"/>
                        <col data-col="s_keshtgb" style="width:6%"/>
                        <col data-col="s_keshtb" style="width:6%"/>
                        <col data-col="nah_kesh" style="width:7%"/>
                        <col data-col="bah_cod_m" style="width:10%"/>
                        <col data-col="name" style="width:13%"/>
                        <col data-col="rownum" style="width:4%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="agri1-ops-col" data-col="ops_msg" rowspan="3">پیام</th>
                            <th class="agri1-ops-col" data-col="ops_view" rowspan="3">مشاهده</th>
                            <th data-col="product" rowspan="3">نام محصول</th>
                            <th data-col-group="mah" colspan="2">میزان محصول / تن</th>
                            <th data-col-group="masahat" colspan="6">مساحت/هکتار</th>
                            <th data-col="nah_kesh" rowspan="3">نحوه کاشت</th>
                            <th data-col-group="spec" colspan="2">مشخصات بهره‌بردار</th>
                            <th data-col="rownum" rowspan="3">ردیف</th>
                        </tr>
                        <tr>
                            <th data-col="mah_tol" rowspan="2">قطعی</th>
                            <th data-col="mah_tolp" rowspan="2">پیش بینی</th>
                            <th data-col-group="tree" colspan="3">تعداد درخت</th>
                            <th data-col-group="kesht" colspan="3">سطح زیر کشت</th>
                            <th data-col="bah_cod_m" rowspan="2">کد ملی</th>
                            <th data-col="name" rowspan="2">نام و نام خانوادگی</th>
                        </tr>
                        <tr>
                            <th data-col="tree_kol">کل</th>
                            <th data-col="treegb">غیر بارور</th>
                            <th data-col="treeb">بارور</th>
                            <th data-col="kesht_kol">کل</th>
                            <th data-col="s_keshtgb">غیر بارور</th>
                            <th data-col="s_keshtb">بارور</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $r = $start + 1;
                    foreach ($stmt as $row) {
                    ?>
                        <tr>
                            <td class="agri1-ops" data-col="ops_msg">
                                <form action="../send_pm1.php#1" method="post" onsubmit="target_popup2(this)">
                                    <input type="hidden" name="username" value="<?php echo agri2_h($row['mor_cod_m']); ?>"/>
                                    <button type="submit"><img src="../../files/receive_mail.png" width="23" height="25" title="ارسال پیام " alt=""/></button>
                                </form>
                            </td>
                            <td class="agri1-ops" data-col="ops_view">
                                <form action="Gardendata_view1.php" method="post" onsubmit="target_popup2(this)">
                                    <input type="hidden" name="id" value="<?php echo agri2_h($row['Garden_id']); ?>"/>
                                    <button type="submit"><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری" width="27" height="23" alt=""/></button>
                                </form>
                            </td>
                            <td data-col="product"><?php echo agri2_h(mah_name_bagh($row['cod_mah'])); ?></td>
                            <td data-col="mah_tol"><?php echo agri2_h(round($row['mah_tol'], 4) * 1); ?></td>
                            <td data-col="mah_tolp"><?php echo agri2_h(round($row['mah_tolp'], 4) * 1); ?></td>
                            <td data-col="tree_kol"><?php echo agri2_h($row['tree_b'] + $row['tree_gb']); ?></td>
                            <td data-col="treegb"><?php echo agri2_h($row['tree_gb'] + 0); ?></td>
                            <td data-col="treeb"><?php echo agri2_h($row['tree_b'] + 0); ?></td>
                            <td data-col="kesht_kol"><?php echo agri2_h($row['s_kesht_b'] + $row['s_kesht_gb']); ?></td>
                            <td data-col="s_keshtgb"><?php echo agri2_h($row['s_kesht_gb'] + 0); ?></td>
                            <td data-col="s_keshtb"><?php echo agri2_h($row['s_kesht_b'] + 0); ?></td>
                            <td data-col="nah_kesh"><?php echo agri2_h($f_nah_kesh); ?></td>
                            <td data-col="bah_cod_m" dir="ltr"><?php echo agri2_h($row['bah_cod_m']); ?></td>
                            <td class="agri1-name-col" data-col="name"><?php echo agri2_h(str_replace('&nbsp;', ' ', bah_name($row['bah_cod_m']))); ?></td>
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
}}
        ?>

        <?php
        if (!empty($query1)) {
            $stmt1 = $dbh->prepare($query1);
            $stmt1->execute();
            $rows = $stmt1->fetchColumn();
            $total = ($limit > 0) ? ceil($rows / $limit) : 1;
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
                    <form action="Garden_rep170.php?id=<?php echo (int)$id - 1; ?>#1" method="post">
                        <?php garden170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $no_kesh, $nah_kesh, $m_ab, $no_ab, $mor_cod_m, $bah_cod_m, $z_sal, $skb1, $skb2, $skgb1, $skgb2, $treeb1, $treeb2, $treegb1, $treegb2, $mtol1, $mtol2, $mtolp1, $mtolp2, $mah_kh, $mah_qroup, $mah_name); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="Garden_rep170.php?id=1#1" method="post">
                        <?php garden170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $no_kesh, $nah_kesh, $m_ab, $no_ab, $mor_cod_m, $bah_cod_m, $z_sal, $skb1, $skb2, $skgb1, $skgb2, $treeb1, $treeb2, $treegb1, $treegb2, $mtol1, $mtol2, $mtolp1, $mtolp2, $mah_kh, $mah_qroup, $mah_name); ?>
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
                    <form action="Garden_rep170.php?id=<?php echo (int)$i; ?>#1" method="post">
                        <?php garden170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $no_kesh, $nah_kesh, $m_ab, $no_ab, $mor_cod_m, $bah_cod_m, $z_sal, $skb1, $skb2, $skgb1, $skgb2, $treeb1, $treeb2, $treegb1, $treegb2, $mtol1, $mtol2, $mtolp1, $mtolp2, $mah_kh, $mah_qroup, $mah_name); ?>
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
                    <form action="Garden_rep170.php?id=<?php echo (int)$total; ?>#1" method="post">
                        <?php garden170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $no_kesh, $nah_kesh, $m_ab, $no_ab, $mor_cod_m, $bah_cod_m, $z_sal, $skb1, $skb2, $skgb1, $skgb2, $treeb1, $treeb2, $treegb1, $treegb2, $mtol1, $mtol2, $mtolp1, $mtolp2, $mah_kh, $mah_qroup, $mah_name); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int)$total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if (isset($id) && $id != $total && $total > 0) { ?>
                <li>
                    <form action="Garden_rep170.php?id=<?php echo (int)$id + 1; ?>#1" method="post">
                        <?php garden170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $no_kesh, $nah_kesh, $m_ab, $no_ab, $mor_cod_m, $bah_cod_m, $z_sal, $skb1, $skb2, $skgb1, $skgb2, $treeb1, $treeb2, $treegb1, $treegb2, $mtol1, $mtol2, $mtolp1, $mtolp2, $mah_kh, $mah_qroup, $mah_name); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="Garden_rep170.php" method="post">
                    <?php garden170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $no_kesh, $nah_kesh, $m_ab, $no_ab, $mor_cod_m, $bah_cod_m, $z_sal, $skb1, $skb2, $skgb1, $skgb2, $treeb1, $treeb2, $treegb1, $treegb2, $mtol1, $mtol2, $mtolp1, $mtolp2, $mah_kh, $mah_qroup, $mah_name); ?>
                    <span>به صفحه</span>
                    <input type="text" inputmode="numeric" lang="en" dir="ltr" id="pageIdInput" name="page_input" value="<?php echo isset($id) ? (int)$id : 1; ?>" placeholder="1"/>
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
                    this.action = 'Garden_rep170.php?id=' + pageId + '#1';
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

            var KEY = 'Garden_rep170_hidden_cols';
            var GROUPS = {
                mah: ['mah_tol', 'mah_tolp'],
                tree: ['tree_kol', 'treegb', 'treeb'],
                kesht: ['kesht_kol', 's_keshtgb', 's_keshtb'],
                masahat: ['tree_kol', 'treegb', 'treeb', 'kesht_kol', 's_keshtgb', 's_keshtb'],
                spec: ['bah_cod_m', 'name']
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
                var groupThs = table.querySelectorAll('[data-col-group]');
                for (var g = 0; g < groupThs.length; g++) {
                    var groupId = groupThs[g].getAttribute('data-col-group');
                    var kids = GROUPS[groupId] || [];
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
