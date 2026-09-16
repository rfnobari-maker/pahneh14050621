<?php
include('../../lock_p1.php');
include('../../event.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $m_ab, $no_ab, $z_sal, $mah_qroup, $mah_name, $zka1, $zka2, $zkb1, $zkb2, $sba1, $sba2, $sbb1, $sbb2, $mtolp1, $mtolp2, $mtol1, $mtol2)
{
    $pairs = array(
        'action' => '1',
        'id_ostan' => $id_ostan1,
        'id_city' => $id_city,
        'id_mar' => $id_mar,
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'bah_cod_m' => $bah_cod_m,
        'mor_cod_m' => $mor_cod_m,
        'no_kesh' => $no_kesh,
        'm_ab' => $m_ab,
        'no_ab' => $no_ab,
        'z_sal' => $z_sal,
        'mah_qroup' => $mah_qroup,
        'mah_name' => $mah_name,
        'zka1' => $zka1,
        'zka2' => $zka2,
        'zkb1' => $zkb1,
        'zkb2' => $zkb2,
        'sba1' => $sba1,
        'sba2' => $sba2,
        'sbb1' => $sbb1,
        'sbb2' => $sbb2,
        'mtolp1' => $mtolp1,
        'mtolp2' => $mtolp2,
        'mtol1' => $mtol1,
        'mtol2' => $mtol2
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

$id_ostan1 = $id_ostan;
$id_city = $id_city;
$id_mar    = $id_mar;
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city  = isset($_POST['add_city'])  ? $_POST['add_city']  : '';
$no_kesh   = isset($_POST['no_kesh'])   ? $_POST['no_kesh']   : '';
$m_ab      = isset($_POST['m_ab'])      ? $_POST['m_ab']      : '';
$no_ab     = isset($_POST['no_ab'])     ? $_POST['no_ab']     : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal     = isset($_POST['z_sal'])     ? $_POST['z_sal']     : '';
$zka1      = isset($_POST['zka1'])      ? $_POST['zka1']      : '';
$zka2      = isset($_POST['zka2'])      ? $_POST['zka2']      : '';
$zkb1      = isset($_POST['zkb1'])      ? $_POST['zkb1']      : '';
$zkb2      = isset($_POST['zkb2'])      ? $_POST['zkb2']      : '';
$sba1      = isset($_POST['sba1'])      ? $_POST['sba1']      : '';
$sba2      = isset($_POST['sba2'])      ? $_POST['sba2']      : '';
$sbb1      = isset($_POST['sbb1'])      ? $_POST['sbb1']      : '';
$sbb2      = isset($_POST['sbb2'])      ? $_POST['sbb2']      : '';
$mtol1     = isset($_POST['mtol1'])     ? $_POST['mtol1']     : '';
$mtol2     = isset($_POST['mtol2'])     ? $_POST['mtol2']     : '';
$mtolp1    = isset($_POST['mtolp1'])    ? $_POST['mtolp1']    : '';
$mtolp2    = isset($_POST['mtolp2'])    ? $_POST['mtolp2']    : '';
$Agri_table     = 'Agri'.str_replace('-','_',$z_sal);
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal);
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
$num_t_mah = isset($num_t_mah) ? $num_t_mah : '';
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
        .agri1-card-search .agri1-hint {
            margin: 0 0 4px;
        }
        .agri1-card-results .agri1-note {
            margin-bottom: 12px;
        }
        .agri1-ops button {
            border: 0;
            background: transparent;
            padding: 0;
            cursor: pointer;
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
    <script type="text/javascript">
        $(document).ready(function()
        {
        $(".country<?php echo htmlspecialchars($num_t_mah) ;?>").change(function()
        {
        var id=$(this).val();
        var dataString = 'group_cod='+ id;
        $.ajax
        ({
        type: "POST",
        url: "ajax_city.php",
        data: dataString,
        cache: false,
        success: function(html)
        {
        $(".mar").html(html);
        }
        });
        });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function()
        {
        $(".country").change(function()
        {
        var id=$(this).val();
        var dataString = 'group_cod='+ id;
        $.ajax
        ({
        type: "POST",
        url: "ajax_city.php",
        data: dataString,
        cache: false,
        success: function(html)
        {
        $(".mar<?php echo htmlspecialchars($num_t_mah) ;?>").html(html);
        }
        });
        });
        });
    </script>
    <script>
        function target_popup(form) {
            window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=250,height=479");
            form.target = 'formpopup';
        }
        function target_Agri17(form) {
            window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=750,height=600");
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
    <?php include(__DIR__ . '/../../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri170-title">گزارش اختصاصی اطلاعات زراعی</h1>
        </header>

        <section class="agri1-card agri1-card-search" aria-labelledby="agri170-title">
            <form id="reg-form" class="agri1-form" method="post" action="#1" novalidate>
                <h2 class="agri1-card-title">جستجو</h2>
                <div class="agri1-grid">
                    <div class="agri1-field">
                        <label class="agri1-label" for="z_sal">سال زراعی</label>
                        <select name="z_sal" class="input_text required" id="z_sal">
                            <?php
                            $query = "SELECT z_sal FROM `z_sal`  ORDER BY z_sal DESC ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach($stmt as $row){
                            ?>
                            <option value="<?php echo agri2_h($row['z_sal']); ?>"
                            <?php if ($row['z_sal']==$z_sal) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['z_sal']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_ostan">استان</label>
                        <select name="id_ostan" disabled="disabled" class="style8" id="id_ostan" dir="rtl">
                            <option value="-1">انتخاب استان</option>
                            <?php
                            $query = "SELECT  id_ostan,ostan FROM `ostanname`  ORDER BY BINARY ostan ASC ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach($stmt as $row){
                            ?>
                            <option value="<?php echo agri2_h($row['id_ostan']); ?>"
                            <?php if ($row['id_ostan']==$id_ostan1) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['ostan']); ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="id_ostan" value="<?php echo agri2_h($id_ostan1); ?>"/>
                        <?php
                        if (isset($_POST['id_ostan']))
                            $id_ostan1= $_POST['id_ostan'];
                        ?>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="no_bah2">نوع کشت</label>
                        <select name="no_kesh" class="input_text required" id="no_bah2">
                            <option value="0">انتخاب کنید</option>
                            <option value="1" <?php if($no_kesh=="1") echo "selected='selected'"; ?>>آبی</option>
                            <option value="2" <?php if($no_kesh=="2") echo "selected='selected'"; ?>>دیم</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_city">شهرستان</label>
                        <select name="id_city" disabled="disabled" class="input_text" id="id_city" dir="rtl">
                            <option value="0"> کل استان</option>
                            <?php
                            $query = "SELECT  id_city,city FROM `cityname` WHERE  `id_ostan` = '$id_ostan1' ORDER BY BINARY city ASC ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach($stmt as $row){
                            ?>
                            <option value="<?php echo agri2_h($row['id_city']); ?>"
                            <?php if ($row['id_city']==$id_city) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['city']); ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="id_city" value="<?php echo agri2_h($id_city); ?>"/>
                        <?php
                        if (isset($_POST['id_city']))
                            $id_city = $_POST['id_city'];
                        ?>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_abadi">نام آبادی</label>
                        <select name="add_abadi" class="input_text" id="add_abadi" dir="rtl">
                            <option value="">انتخاب نام آبادی</option>
                            <?php
                            $query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session' ORDER BY BINARY abadi ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach($stmt as $row){
                            ?>
                            <option value="<?php echo agri2_h($row['add_abadi']); ?>"
                            <?php if ($row['add_abadi']==$add_abadi) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['abadi']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_mar">مرکز جهاد کشاورزی</label>
                        <select name="id_mar" disabled="disabled" class="input_text" id="id_mar" dir="rtl">
                            <option value="0"> نام مرکز</option>
                            <?php
                            $query = "SELECT  id_mar,mar FROM `mar` WHERE  `id_ostan` = $id_ostan1 and `id_city` = $id_city";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach($stmt as $row){
                            ?>
                            <option value="<?php echo agri2_h($row['id_mar']); ?>"
                            <?php if ($row['id_mar']==$id_mar) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['mar']); ?></option>
                            <?php } ?>
                        </select>
                        <?php
                        if (isset($_POST['id_mar']))
                            $id_mar = $_POST['id_mar'];
                        ?>
                        <input name="id_city2" type="hidden" value="<?php echo agri2_h($id_city); ?>"/>
                        <input type="hidden" name="id_mar" value="<?php echo agri2_h($id_mar); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_city">نام شهر</label>
                        <select name="add_city" class="input_text" id="add_city" dir="rtl">
                            <option value="">انتخاب نام شهر</option>
                            <?php
                            $query = "SELECT  add_city,shahr FROM `list_city` WHERE `mor_cod_m` = '$login_session' ORDER BY BINARY shahr ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach($stmt as $row){
                            ?>
                            <option value="<?php echo agri2_h($row['add_city']); ?>"
                            <?php if ($row['add_city']==$add_city) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['shahr']); ?></option>
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
                        <input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($login_session); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="no_ab">نحوه آبیاری</label>
                        <select name="no_ab" class="input_text required" id="no_ab" tabindex="18">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($no_ab=='1') { echo 'selected="selected"'; } ?>>جوی و پشته</option>
                            <option value="2" <?php if ($no_ab=='2') { echo 'selected="selected"'; } ?>>نواری</option>
                            <option value="3" <?php if ($no_ab=='3') { echo 'selected="selected"'; } ?>>غرقابی</option>
                            <option value="4" <?php if ($no_ab=='4') { echo 'selected="selected"'; } ?>>تشتکی</option>
                            <option value="5" <?php if ($no_ab=='5') { echo 'selected="selected"'; } ?>>تحت فشار قطره ای</option>
                            <option value="6" <?php if ($no_ab=='6') { echo 'selected="selected"'; } ?>>تحت فشار بارانی</option>
                            <option value="7" <?php if ($no_ab=='7') { echo 'selected="selected"'; } ?>>سایر</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="m_ab">منبع آب</label>
                        <select name="m_ab" class="input_text required" id="m_ab" tabindex="14">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($m_ab=='1') { echo 'selected="selected"'; } ?>>چشمه</option>
                            <option value="2" <?php if ($m_ab=='2') { echo 'selected="selected"'; } ?>>قنات</option>
                            <option value="3" <?php if ($m_ab=='3') { echo 'selected="selected"'; } ?>>رودخانه</option>
                            <option value="4" <?php if ($m_ab=='4') { echo 'selected="selected"'; } ?>>سد</option>
                            <option value="5" <?php if ($m_ab=='5') { echo 'selected="selected"'; } ?>>چاه سطحی</option>
                            <option value="6" <?php if ($m_ab=='6') { echo 'selected="selected"'; } ?>>چاه عمیق</option>
                            <option value="7" <?php if ($m_ab=='7') { echo 'selected="selected"'; } ?>>چاه نیمه عمیق</option>
                            <option value="8" <?php if ($m_ab=='8') { echo 'selected="selected"'; } ?>>زهکش</option>
                            <option value="9" <?php if ($m_ab=='9') { echo 'selected="selected"'; } ?>>پساب</option>
                            <option value="10" <?php if ($m_ab=='10') { echo 'selected="selected"'; } ?>>آب بندان</option>
                            <option value="11" <?php if ($m_ab=='11') { echo 'selected="selected"'; } ?>>سایر</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mah_name">نام محصول</label>
                        <select name="mah_name" class="required input_text mar" id="mah_name" tabindex="23" dir="rtl">
                            <?php
                            $query = "SELECT DISTINCT product_cod,product_name FROM `product_z` WHERE  `group_cod` = '$mah_qroup' ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach($stmt as $row){
                            ?>
                            <option value="<?php echo agri2_h($row['product_cod']); ?>"
                            <?php if ($row['product_cod']==$mah_name) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['product_name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mah_qroup">گروه محصولات</label>
                        <select name="mah_qroup" class="required input_text country" id="mah_qroup" tabindex="22" dir="rtl">
                            <option value=""> انتخاب گروه</option>
                            <?php
                            $query = "SELECT DISTINCT group_cod,group_name FROM `product_z` ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach($stmt as $row){
                            ?>
                            <option value="<?php echo agri2_h($row['group_cod']); ?>"
                            <?php if ($row['group_cod']==$mah_qroup) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['group_name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="zka2">سطح زیر کشت اول — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="zka2" type="text" class="input_text" id="zka2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($zka2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="zka1">سطح زیر کشت اول — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="zka1" type="text" class="input_text" id="zka1" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($zka1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="zkb2">سطح زیر کشت دوم — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="zkb2" type="text" class="input_text" id="zkb2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($zkb2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="zkb1">سطح زیر کشت دوم — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="zkb1" type="text" class="input_text" id="zkb1" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($zkb1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="sba2">سطح برداشت اول — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="sba2" type="text" class="input_text" id="sba2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($sba2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="zka4">سطح برداشت اول — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="sba1" type="text" class="input_text" id="zka4" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($sba1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="sbb2">سطح برداشت دوم — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="sbb2" type="text" class="input_text" id="sbb2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($sbb2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="zkb4">سطح برداشت دوم — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="sbb1" type="text" class="input_text" id="zkb4" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($sbb1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mtolp2">میزان پیش‌بینی محصول — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">تن</p>
                        <input name="mtolp2" type="text" class="input_text" id="mtolp2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($mtolp2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mtol4">میزان پیش‌بینی محصول — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">تن</p>
                        <input name="mtolp1" type="text" class="input_text" id="mtol4" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($mtolp1); ?>"/>
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
        $start = 0;

        if (isset($_POST['action']))
        {
        if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "`$Agri_prod_table`.id_ostan='$id_ostan1'" ;}
        if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "`$Agri_prod_table`.id_city='$id_city'" ;}
        if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "`$Agri_prod_table`.id_mar='$id_mar'" ;}
        if ($add_abadi  == '')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "`$Agri_prod_table`.add_abadi = '$add_abadi'" ;}
        if ($add_city  == '')  { $f_add_city  = 1  ; }else{ $f_add_city = "`$Agri_prod_table`.add_city = '$add_city'" ;}
        if ($no_kesh == '0')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "`$Agri_prod_table`.no_kesh = '$no_kesh'" ;}
        if ($m_ab == '')  { $f_m_ab  = 1  ; }else{ $f_m_ab = "`$Agri_table`.m_ab = '$m_ab'" ;}
        if ($no_ab == '')  { $f_no_ab  = 1  ; }else{ $f_no_ab = "`$Agri_table`.no_ab = '$no_ab'" ;}
        if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "`$Agri_prod_table`.mor_cod_m = '$mor_cod_m'" ;}
        if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "`$Agri_prod_table`.bah_cod_m = '$bah_cod_m'" ;}
        if ($mah_name == '')  { $v_cod_mah  = 1  ; }else{ $v_cod_mah = "`$Agri_prod_table`.cod_mah = '$mah_name'" ;}
        if ($zka1 == '')  { $v_zka1  = 1  ; }else{ $v_zka1 = "`$Agri_prod_table`.zer_kesht_a >= $zka1" ;}
        if ($zka2 == '')  { $v_zka2  = 1  ; }else{ $v_zka2 = "`$Agri_prod_table`.zer_kesht_a <= $zka2" ;}
        if ($zkb1 == '')  { $v_zkb1  = 1  ; }else{ $v_zkb1 = "`$Agri_prod_table`.zer_kesht_b >= $zkb1" ;}
        if ($zkb2 == '')  { $v_zkb2  = 1  ; }else{ $v_zkb2 = "`$Agri_prod_table`.zer_kesht_b <= $zkb2" ;}
        if ($sba1 == '')  { $v_sba1  = 1  ; }else{ $v_sba1 = "`$Agri_prod_table`.s_bar_a >= $sba1" ;}
        if ($sba2 == '')  { $v_sba2  = 1  ; }else{ $v_sba2 = "`$Agri_prod_table`.s_bar_a <= $sba2" ;}
        if ($sbb1 == '')  { $v_sbb1  = 1  ; }else{ $v_sbb1 = "`$Agri_prod_table`.s_bar_b >= $sbb1" ;}
        if ($sbb2 == '')  { $v_sbb2  = 1  ; }else{ $v_sbb2 = "`$Agri_prod_table`.s_bar_b <= $sbb2" ;}
        if ($mtol1 == '')  { $v_mtol1  = 1  ; }else{ $v_mtol1 = "`$Agri_prod_table`.mah_tol >= $mtol1" ;}
        if ($mtol2 == '')  { $v_mtol2  = 1  ; }else{ $v_mtol2 = "`$Agri_prod_table`.mah_tol <= $mtol2" ;}
        if ($mtolp1 == '')  { $v_mtolp1  = 1  ; }else{ $v_mtolp1 = "`$Agri_prod_table`.mah_tolp >= $mtolp1" ;}
        if ($mtolp2 == '')  { $v_mtolp2  = 1  ; }else{ $v_mtolp2 = "`$Agri_prod_table`.mah_tolp <= $mtolp2" ;}
        include('../../login/config.php');
        $start=0;
        $limit=10;
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
        if ($id < 1) $id = 1;
        $start=($id-1)*$limit;
        $query = "SELECT `$Agri_prod_table`.*,`$Agri_table`.m_ab, `$Agri_table`.no_ab
        from `$Agri_prod_table` 
        INNER JOIN `$Agri_table` ON `$Agri_table`.id = `$Agri_prod_table`.Agri_id
        where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh and $f_m_ab and $f_no_ab and $v_mor_cod_m and $v_bah_cod_m  and  $v_cod_mah and $v_sba1 and $v_sba2 and $v_sbb1 and $v_sbb2 and $v_zka1 and $v_zka2 and $v_zkb1 and $v_zkb2 and $v_mtolp1 and $v_mtolp2 and $v_mtol1 and $v_mtol2 ORDER BY bah_cod_m ASC LIMIT $start, $limit ";
        $query1 = "SELECT count(*)
        from `$Agri_prod_table` 
        INNER JOIN `$Agri_table` ON `$Agri_table`.id = `$Agri_prod_table`.Agri_id
        where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh and $f_m_ab and $f_no_ab and $v_mor_cod_m and $v_bah_cod_m  and  $v_cod_mah and $v_sba1 and $v_sba2 and $v_sbb1 and $v_sbb2 and $v_zka1 and $v_zka2 and $v_zkb1 and $v_zkb2 and $v_mtolp1 and $v_mtolp2 and $v_mtol1 and $v_mtol2";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $t_row = $stmt -> rowCount();
        if ($t_row>0) {
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
                            <li><label><input type="checkbox" data-col-toggle="mah_tol" checked/> میزان محصول قطعی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="mah_tolp" checked/> میزان محصول پیش‌بینی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="s_bar_kol" checked/> سطح برداشت کل</label></li>
                            <li><label><input type="checkbox" data-col-toggle="s_bar_b" checked/> سطح برداشت دوم</label></li>
                            <li><label><input type="checkbox" data-col-toggle="s_bar_a" checked/> سطح برداشت اول</label></li>
                            <li><label><input type="checkbox" data-col-toggle="zer_kol" checked/> سطح زیر کشت کل</label></li>
                            <li><label><input type="checkbox" data-col-toggle="zer_b" checked/> سطح زیر کشت دوم</label></li>
                            <li><label><input type="checkbox" data-col-toggle="zer_a" checked/> سطح زیر کشت اول</label></li>
                            <li><label><input type="checkbox" data-col-toggle="bah_cod_m" checked/> کد ملی بهره‌بردار</label></li>
                            <li><label><input type="checkbox" data-col-toggle="name" checked/> نام و نام خانوادگی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="rownum" checked/> ردیف</label></li>
                        </ul>
                    </div>
                </div>
                <div class="agri1-xls">
                <form action="Agri_rep170_xls.php" method="post">
                    <input type="hidden" name="id_ostan"  value="<?php echo agri2_h($id_ostan1); ?>"/>
                    <input type="hidden" name="id_city"   value="<?php echo agri2_h($id_city); ?>"/>
                    <input type="hidden" name="id_mar"    value="<?php echo agri2_h($id_mar); ?>"/>
                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
                    <input type="hidden" name="add_city"  value="<?php echo agri2_h($add_city); ?>"/>
                    <input type="hidden" name="no_kesh"   value="<?php echo agri2_h($no_kesh); ?>"/>
                    <input type="hidden" name="m_ab"       value="<?php echo agri2_h($m_ab); ?>"/>
                    <input type="hidden" name="no_ab"      value="<?php echo agri2_h($no_ab); ?>"/>
                    <input type="hidden" name="mor_cod_m" value="<?php echo agri2_h($mor_cod_m); ?>"/>
                    <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    <input type="hidden" name="z_sal"     value="<?php echo agri2_h($z_sal); ?>"/>
                    <input type="hidden" name="mah_name"  value="<?php echo agri2_h($mah_name); ?>"/>
                    <input type="hidden" name="zka1"  value="<?php echo agri2_h($zka1); ?>"/>
                    <input type="hidden" name="zka2"  value="<?php echo agri2_h($zka2); ?>"/>
                    <input type="hidden" name="zkb1"  value="<?php echo agri2_h($zkb1); ?>"/>
                    <input type="hidden" name="zkb2"  value="<?php echo agri2_h($zkb2); ?>"/>
                    <input type="hidden" name="sba1"  value="<?php echo agri2_h($sba1); ?>"/>
                    <input type="hidden" name="sba2"  value="<?php echo agri2_h($sba2); ?>"/>
                    <input type="hidden" name="sbb1"  value="<?php echo agri2_h($sbb1); ?>"/>
                    <input type="hidden" name="sbb2"  value="<?php echo agri2_h($sbb2); ?>"/>
                    <input type="hidden" name="mtolp1"  value="<?php echo agri2_h($mtolp1); ?>"/>
                    <input type="hidden" name="mtolp2"  value="<?php echo agri2_h($mtolp2); ?>"/>
                    <input type="hidden" name="mtol1"  value="<?php echo agri2_h($mtol1); ?>"/>
                    <input type="hidden" name="mtol2"  value="<?php echo agri2_h($mtol2); ?>"/>
                    <button type="submit" title="دانلود نتایج با فرمت فایل اکسل">
                        <img src="../../files/xls.png" width="44" height="40" alt="خروجی اکسل"/>
                    </button>
                </form>
                <form action="Agri_rep170_doc.php" method="post">
                    <input type="hidden" name="id_ostan"  value="<?php echo agri2_h($id_ostan1); ?>"/>
                    <input type="hidden" name="id_city"   value="<?php echo agri2_h($id_city); ?>"/>
                    <input type="hidden" name="id_mar"    value="<?php echo agri2_h($id_mar); ?>"/>
                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
                    <input type="hidden" name="add_city"  value="<?php echo agri2_h($add_city); ?>"/>
                    <input type="hidden" name="no_kesh"   value="<?php echo agri2_h($no_kesh); ?>"/>
                    <input type="hidden" name="mor_cod_m" value="<?php echo agri2_h($mor_cod_m); ?>"/>
                    <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    <input type="hidden" name="z_sal"     value="<?php echo agri2_h($z_sal); ?>"/>
                    <input type="hidden" name="mah_name"  value="<?php echo agri2_h($mah_name); ?>"/>
                    <input type="hidden" name="zka1"  value="<?php echo agri2_h($zka1); ?>"/>
                    <input type="hidden" name="zka2"  value="<?php echo agri2_h($zka2); ?>"/>
                    <input type="hidden" name="zkb1"  value="<?php echo agri2_h($zkb1); ?>"/>
                    <input type="hidden" name="zkb2"  value="<?php echo agri2_h($zkb2); ?>"/>
                    <input type="hidden" name="sba1"  value="<?php echo agri2_h($sba1); ?>"/>
                    <input type="hidden" name="sba2"  value="<?php echo agri2_h($sba2); ?>"/>
                    <input type="hidden" name="sbb1"  value="<?php echo agri2_h($sbb1); ?>"/>
                    <input type="hidden" name="sbb2"  value="<?php echo agri2_h($sbb2); ?>"/>
                    <input type="hidden" name="mtolp1"  value="<?php echo agri2_h($mtolp1); ?>"/>
                    <input type="hidden" name="mtolp2"  value="<?php echo agri2_h($mtolp2); ?>"/>
                    <input type="hidden" name="mtol1"  value="<?php echo agri2_h($mtol1); ?>"/>
                    <input type="hidden" name="mtol2"  value="<?php echo agri2_h($mtol2); ?>"/>
                    <button type="submit" title="دانلود نتایج با فرمت فایل ورد">
                        <img src="../../files/word.png" width="44" height="40" alt="خروجی ورد"/>
                    </button>
                </form>
                </div>
            </div>
            <p class="agri1-note">فقط قطعات دارای محصول در محاسبه شرکت داده شده / قطعات دارای تنوع محصول 0 یا به عبارت دیگر قطعه ی که کلاً آیش ثبت شده محاسبه نگردیده</p>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <colgroup>
                        <col data-col="ops" style="width:6%"/>
                        <col data-col="product" style="width:9%"/>
                        <col data-col="mah_tol" style="width:7%"/>
                        <col data-col="mah_tolp" style="width:7%"/>
                        <col data-col="s_bar_kol" style="width:6%"/>
                        <col data-col="s_bar_b" style="width:6%"/>
                        <col data-col="s_bar_a" style="width:6%"/>
                        <col data-col="zer_kol" style="width:6%"/>
                        <col data-col="zer_b" style="width:6%"/>
                        <col data-col="zer_a" style="width:6%"/>
                        <col data-col="bah_cod_m" style="width:10%"/>
                        <col data-col="name" style="width:15%"/>
                        <col data-col="rownum" style="width:4%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="agri1-ops-col" data-col="ops" rowspan="3">عملیات</th>
                            <th data-col="product" rowspan="3">نام محصول</th>
                            <th data-col-group="mah" colspan="2">میزان محصول / تن</th>
                            <th data-col-group="masahat" colspan="6">مساحت / هکتار</th>
                            <th data-col-group="bah" colspan="2">مشخصات بهره‌بردار</th>
                            <th data-col="rownum" rowspan="3">ردیف</th>
                        </tr>
                        <tr>
                            <th data-col="mah_tol" rowspan="2">قطعی</th>
                            <th data-col="mah_tolp" rowspan="2">پیش‌بینی</th>
                            <th data-col-group="s_bar" colspan="3">سطح برداشت</th>
                            <th data-col-group="zer" colspan="3">سطح زیر کشت</th>
                            <th data-col="bah_cod_m" rowspan="2">کد ملی</th>
                            <th data-col="name" rowspan="2">نام و نام خانوادگی</th>
                        </tr>
                        <tr>
                            <th data-col="s_bar_kol">کل</th>
                            <th data-col="s_bar_b">دوم</th>
                            <th data-col="s_bar_a">اول</th>
                            <th data-col="zer_kol">کل</th>
                            <th data-col="zer_b">دوم</th>
                            <th data-col="zer_a">اول</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $r = $start+1;
                    foreach($stmt as $row){
                    ?>
                        <tr>
                            <td class="agri1-ops" data-col="ops">
                                <form action="Agridata_view1.php" method="post" onsubmit="target_Agri17(this)">
                                    <input type="hidden" name="id" value="<?php echo agri2_h($row['Agri_id']); ?>"/>
                                    <input type="hidden" name="z_sal" value="<?php echo agri2_h($row['z_sal']); ?>"/>
                                    <button type="submit"><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری" width="33" height="26" alt=""/></button>
                                </form>
                            </td>
                            <td data-col="product"><?php echo agri2_h(mah_name($row['cod_mah'])); ?></td>
                            <td data-col="mah_tol"><?php echo agri2_h(round($row['mah_tol'],3)*1); ?></td>
                            <td data-col="mah_tolp"><?php echo agri2_h(round($row['mah_tolp'],3)*1); ?></td>
                            <td data-col="s_bar_kol"><?php echo agri2_h($row['s_bar_a']+$row['s_bar_b']); ?></td>
                            <td data-col="s_bar_b"><?php echo agri2_h($row['s_bar_b']+0); ?></td>
                            <td data-col="s_bar_a"><?php echo agri2_h($row['s_bar_a']+0); ?></td>
                            <td data-col="zer_kol"><?php echo agri2_h($row['zer_kesht_a'] + $row['zer_kesht_b']); ?></td>
                            <td data-col="zer_b"><?php echo agri2_h($row['zer_kesht_b']+0); ?></td>
                            <td data-col="zer_a"><?php echo agri2_h($row['zer_kesht_a']+0); ?></td>
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
        $total = ceil($rows/$limit);
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
                    <form action="Agri_rep170.php?id=<?php echo (int)$id - 1; ?>#1" method="post">
                        <?php agri170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $m_ab, $no_ab, $z_sal, $mah_qroup, $mah_name, $zka1, $zka2, $zkb1, $zkb2, $sba1, $sba2, $sbb1, $sbb2, $mtolp1, $mtolp2, $mtol1, $mtol2); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="Agri_rep170.php?id=1#1" method="post">
                        <?php agri170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $m_ab, $no_ab, $z_sal, $mah_qroup, $mah_name, $zka1, $zka2, $zkb1, $zkb2, $sba1, $sba2, $sbb1, $sbb2, $mtolp1, $mtolp2, $mtol1, $mtol2); ?>
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
                    <form action="Agri_rep170.php?id=<?php echo (int)$i; ?>#1" method="post">
                        <?php agri170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $m_ab, $no_ab, $z_sal, $mah_qroup, $mah_name, $zka1, $zka2, $zkb1, $zkb2, $sba1, $sba2, $sbb1, $sbb2, $mtolp1, $mtolp2, $mtol1, $mtol2); ?>
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
                    <form action="Agri_rep170.php?id=<?php echo (int)$total; ?>#1" method="post">
                        <?php agri170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $m_ab, $no_ab, $z_sal, $mah_qroup, $mah_name, $zka1, $zka2, $zkb1, $zkb2, $sba1, $sba2, $sbb1, $sbb2, $mtolp1, $mtolp2, $mtol1, $mtol2); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int)$total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if (isset($id) && $id != $total && $total > 0) { ?>
                <li>
                    <form action="Agri_rep170.php?id=<?php echo (int)$id + 1; ?>#1" method="post">
                        <?php agri170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $m_ab, $no_ab, $z_sal, $mah_qroup, $mah_name, $zka1, $zka2, $zkb1, $zkb2, $sba1, $sba2, $sbb1, $sbb2, $mtolp1, $mtolp2, $mtol1, $mtol2); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="Agri_rep170.php" method="post">
                    <?php agri170_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $m_ab, $no_ab, $z_sal, $mah_qroup, $mah_name, $zka1, $zka2, $zkb1, $zkb2, $sba1, $sba2, $sbb1, $sbb2, $mtolp1, $mtolp2, $mtol1, $mtol2); ?>
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
                    this.action = 'Agri_rep170.php?id=' + pageId + '#1';
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

            var KEY = 'Agri_rep170_hidden_cols';
            var GROUPS = {
                mah: ['mah_tol', 'mah_tolp'],
                s_bar: ['s_bar_kol', 's_bar_b', 's_bar_a'],
                zer: ['zer_kol', 'zer_b', 'zer_a'],
                masahat: ['s_bar_kol', 's_bar_b', 's_bar_a', 'zer_kol', 'zer_b', 'zer_a'],
                bah: ['bah_cod_m', 'name']
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
