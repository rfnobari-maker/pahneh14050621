<?php
include('../../lock_p1.php');
include('../../event.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function vege_rep2_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $ra_kesh, $mor_cod_m, $bah_cod_m, $z_sal, $b_time, $zka1, $zka2, $sba1, $sba2, $mtol1, $mtol2, $mtolp1, $mtolp2, $ragham, $no_ab, $dah_bazar, $mah_bazar, $mah_name)
{
    $pairs = array(
        'action' => '1',
        'id_ostan' => $id_ostan1,
        'id_city5' => $id_city,
        'id_mar' => $id_mar,
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'ra_kesh' => $ra_kesh,
        'mor_cod_m' => $mor_cod_m,
        'bah_cod_m' => $bah_cod_m,
        'z_sal' => $z_sal,
        'b_time' => $b_time,
        'zka1' => $zka1,
        'zka2' => $zka2,
        'sba1' => $sba1,
        'sba2' => $sba2,
        'mtol1' => $mtol1,
        'mtol2' => $mtol2,
        'mtolp1' => $mtolp1,
        'mtolp2' => $mtolp2,
        'ragham' => $ragham,
        'no_ab' => $no_ab,
        'dah_bazar' => $dah_bazar,
        'mah_bazar' => $mah_bazar,
        'mah_name' => $mah_name
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city   = isset($_POST['id_city5']) ? $_POST['id_city5'] : '';
$id_mar    = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city  = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$ra_kesh   = isset($_POST['ra_kesh']) ? $_POST['ra_kesh'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal     = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$b_time    = isset($_POST['b_time']) ? $_POST['b_time'] : '';
$zka1      = isset($_POST['zka1']) ? $_POST['zka1'] : '';
$zka2      = isset($_POST['zka2']) ? $_POST['zka2'] : '';
$sba1      = isset($_POST['sba1']) ? $_POST['sba1'] : '';
$sba2      = isset($_POST['sba2']) ? $_POST['sba2'] : '';
$mtol1     = isset($_POST['mtol1']) ? $_POST['mtol1'] : '';
$mtol2     = isset($_POST['mtol2']) ? $_POST['mtol2'] : '';
$mtolp1    = isset($_POST['mtolp1']) ? $_POST['mtolp1'] : '';
$mtolp2    = isset($_POST['mtolp2']) ? $_POST['mtolp2'] : '';
$ragham    = isset($_POST['ragham']) ? $_POST['ragham'] : '';
$no_ab     = isset($_POST['no_ab']) ? $_POST['no_ab'] : '';
$dah_bazar = isset($_POST['dah_bazar']) ? $_POST['dah_bazar'] : '';
$mah_bazar = isset($_POST['mah_bazar']) ? $_POST['mah_bazar'] : '';
$mah_name  = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
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
            max-width: 800px;
            margin-right: auto;
            margin-left: auto;
            padding: 22px 20px;
        }
        .agri1-card-search .agri1-card-title {
            margin-bottom: 10px;
            padding-bottom: 6px;
        }
        .agri1-card-search .agri1-grid {
            gap: 16px 20px;
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
        .agri1-card-search .agri1-hint {
            margin: 0 0 4px;
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
        }
        .agri1-table td {
            padding: 4px 3px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid var(--color-border);
            color: var(--color-foreground);
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
        .agri1-export {
            display: flex;
            justify-content: center;
            margin: 0 0 12px;
        }
        .agri1-export form { margin: 0; }
        .agri1-export button {
            border: 0;
            background: transparent;
            padding: 0;
            cursor: pointer;
        }
        .agri1-export button:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
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
            margin-top: var(--space-3);
            padding: var(--space-2);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            background: var(--color-card);
            text-align: center;
        }
        .agri1-pager-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 8px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .agri1-pager-list form { display: inline; }
        .agri1-pager-btn {
            min-height: var(--touch);
            min-width: var(--touch);
            padding: 8px 14px;
            border: 1px solid var(--color-border);
            border-radius: 12px;
            background: var(--color-card);
            color: var(--color-foreground);
            cursor: pointer;
            font: inherit;
            font-weight: 700;
        }
        .agri1-pager-btn:hover { background: var(--color-muted); }
        .agri1-pager-btn.is-current,
        .agri1-pager-btn.is-nav {
            background: var(--color-primary);
            color: var(--color-on-primary);
            border-color: var(--color-primary);
        }
        .agri1-pager-ellipsis { color: var(--color-muted-foreground); padding: 8px; }
        .agri1-pager-jump {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 12px;
        }
        .agri1-pager-jump form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }
        .agri1-pager-jump input[type="number"],
        .agri1-pager-jump input[type="text"] {
            width: 88px;
            min-height: var(--touch);
            padding: 8px 10px;
            border: 1px solid #64748B;
            border-radius: 10px;
            font-size: 16px;
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
    <script type="text/javascript">
        $(document).ready(function () {
            $(".country").change(function () {
                var id = $(this).val();
                var dataString = 'group_cod=' + id;
                $.ajax({
                    type: "POST",
                    url: "ajax_city.php",
                    data: dataString,
                    cache: false,
                    success: function (html) {
                        $(".mar").html(html);
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
    <?php include(__DIR__ . '/../../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="vege-rep2-title">گزارش اختصاصی اطلاعات صیفی</h1>
        </header>

        <section class="agri1-card agri1-card-search" aria-labelledby="vege-rep2-title">
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
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['z_sal']); ?>"
                                <?php if ($row['z_sal'] == $z_sal) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['z_sal']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_ostan">استان</label>
                        <?php $id_ostan1 = $id_ostan; ?>
                        <select name="id_ostan" class="style8" id="id_ostan" dir="rtl" onchange="this.form.submit()">
                            <option value="-1">انتخاب استان</option>
                            <?php
                            $query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY  ostan ASC ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['id_ostan']); ?>"
                                <?php if ($row['id_ostan'] == $id_ostan1) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['ostan']); ?></option>
                            <?php } ?>
                        </select>
                        <?php
                        if (isset($_POST['id_ostan'])) {
                            $id_ostan1 = $_POST['id_ostan'];
                        }
                        ?>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="b_time">فصل تولید</label>
                        <select name="b_time" class="input_text required" id="b_time" tabindex="4">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($b_time == '1') { echo 'selected="selected"'; } ?>>زمستانه/استمرار</option>
                            <option value="2" <?php if ($b_time == '2') { echo 'selected="selected"'; } ?>>بهاره</option>
                            <option value="3" <?php if ($b_time == '3') { echo 'selected="selected"'; } ?>>تابستانه</option>
                            <option value="4" <?php if ($b_time == '4') { echo 'selected="selected"'; } ?>>پاییزه</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_city">شهرستان</label>
                        <select name="id_city5" disabled="disabled" class="style8" id="id_city" dir="rtl" onchange="this.form.submit()">
                            <option value="0"> کل استان</option>
                            <?php
                            $query = "SELECT id_city,city FROM cityname WHERE  `id_ostan` = '$id_ostan1' ORDER BY BINARY city ASC ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['id_city']); ?>"
                                <?php if ($row['id_city'] == $id_city) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['city']); ?></option>
                            <?php } ?>
                        </select>
                        <?php
                        if (isset($_POST['id_city5'])) {
                            $id_city = $_POST['id_city5'];
                        }
                        ?>
                        <input type="hidden" name="id_city5" value="<?php echo agri2_h($id_city); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_abadi">نام آبادی</label>
                        <select name="add_abadi" class="input_text" id="add_abadi" dir="rtl">
                            <option value="0">انتخاب کنید</option>
                            <?php
                            $query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session' ORDER BY BINARY abadi ";
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
                        <label class="agri1-label" for="bakh">مرکز جهاد کشاورزی</label>
                        <select name="id_mar" disabled="disabled" class="style8" id="bakh" dir="rtl" onchange="this.form.submit()">
                            <option value="0"> نام مرکز</option>
                            <?php
                            if ($id_ostan1 !== '' && $id_city !== '') {
                                $query = "SELECT  id_mar,mar FROM `mar` WHERE  `id_ostan` = $id_ostan1 and `id_city` = $id_city";
                                $stmt = $dbh->prepare($query);
                                $stmt->execute();
                                foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['id_mar']); ?>"
                                <?php if ($row['id_mar'] == $id_mar) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['mar']); ?></option>
                            <?php
                                }
                            }
                            ?>
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
                            <option value="0">انتخاب کنید</option>
                            <?php
                            $query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = '$login_session' ORDER BY BINARY shahr ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['add_city']); ?>"
                                <?php if ($row['add_city'] == $add_city) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['shahr']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mah_name">نام محصول</label>
                        <select name="mah_name" class="required input_text country" id="mah_name" tabindex="22" dir="rtl" onchange="this.form.submit()">
                            <option value="">انتخاب محصول</option>
                            <option value="174" <?php if ($mah_name == '174') echo 'selected="selected"'; ?>>گوجه فرنگی</option>
                            <option value="170" <?php if ($mah_name == '170') echo 'selected="selected"'; ?>>سیب زمینی</option>
                            <option value="172" <?php if ($mah_name == '172') echo 'selected="selected"'; ?>>پیاز</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="ragham">رقم</label>
                        <select name="ragham" id="ragham" class="input_text required" tabindex="6">
                            <?php
                            switch ($mah_name) {
                                case "174":
                            ?>
                            <option value="-">-----</option>
                            <?php
                                    break;
                                case "172":
                            ?>
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($ragham == '1') { echo 'selected="selected"'; } ?>>قرمز</option>
                            <option value="2" <?php if ($ragham == '2') { echo 'selected="selected"'; } ?>>سفید</option>
                            <option value="3" <?php if ($ragham == '3') { echo 'selected="selected"'; } ?>>زرد</option>
                            <option value="4" <?php if ($ragham == '4') { echo 'selected="selected"'; } ?>>صورتی</option>
                            <?php
                                    break;
                                case "170":
                            ?>
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($ragham == '1') { echo 'selected="selected"'; } ?>>اگریا</option>
                            <option value="2" <?php if ($ragham == '2') { echo 'selected="selected"'; } ?>>سانته</option>
                            <option value="3" <?php if ($ragham == '3') { echo 'selected="selected"'; } ?>>ساتینا</option>
                            <option value="4" <?php if ($ragham == '4') { echo 'selected="selected"'; } ?>>میلوا</option>
                            <option value="5" <?php if ($ragham == '5') { echo 'selected="selected"'; } ?>>بورن</option>
                            <option value="6" <?php if ($ragham == '6') { echo 'selected="selected"'; } ?>>ساوالان</option>
                            <option value="7" <?php if ($ragham == '7') { echo 'selected="selected"'; } ?>>آرنیدا</option>
                            <option value="8" <?php if ($ragham == '8') { echo 'selected="selected"'; } ?>>بانبا</option>
                            <option value="9" <?php if ($ragham == '9') { echo 'selected="selected"'; } ?>>مارفونا</option>
                            <option value="10" <?php if ($ragham == '10') { echo 'selected="selected"'; } ?>>فونتانه</option>
                            <option value="11" <?php if ($ragham == '11') { echo 'selected="selected"'; } ?>>راموس</option>
                            <option value="12" <?php if ($ragham == '12') { echo 'selected="selected"'; } ?>>پیکاسو</option>
                            <option value="13" <?php if ($ragham == '13') { echo 'selected="selected"'; } ?>>جلی</option>
                            <option value="14" <?php if ($ragham == '14') { echo 'selected="selected"'; } ?>>سایر</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="no_ab">روش آبیاری</label>
                        <select name="no_ab" class="input_text required" id="no_ab" tabindex="8">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($no_ab == '1') { echo 'selected="selected"'; } ?>>نواری</option>
                            <option value="2" <?php if ($no_ab == '2') { echo 'selected="selected"'; } ?>>غرقابی</option>
                            <option value="3" <?php if ($no_ab == '3') { echo 'selected="selected"'; } ?>>قطره ای</option>
                            <option value="4" <?php if ($no_ab == '4') { echo 'selected="selected"'; } ?>>بارانی</option>
                            <option value="5" <?php if ($no_ab == '5') { echo 'selected="selected"'; } ?>>سایر</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="ra_kesh">روش کشت</label>
                        <select name="ra_kesh" id="ra_kesh" class="input_text required" tabindex="7">
                            <?php if ($mah_name == '170') { ?>
                            <option value="2" <?php if ($ra_kesh == '2') { echo 'selected="selected"'; } ?>>مستقیم</option>
                            <?php } else { ?>
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($ra_kesh == '1') { echo 'selected="selected"'; } ?>>نشایی</option>
                            <option value="2" <?php if ($ra_kesh == '2') { echo 'selected="selected"'; } ?>>مستقیم</option>
                            <?php } ?>
                            <?php if ($mah_name == '174') { ?>
                            <option value="3"<?php if ($ra_kesh == '3') { echo 'selected="selected"'; } ?>>نشایی با مالچ</option>
                            <option value="4"<?php if ($ra_kesh == '4') { echo 'selected="selected"'; } ?>>مستقیم با مالچ</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field" aria-hidden="true"></div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="zka1">سطح زیر کشت — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="zka1" type="text" class="input_text" id="zka1" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($zka1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="zka2">سطح زیر کشت — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="zka2" type="text" class="input_text" id="zka2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($zka2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="zka4">سطح برداشت — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="sba1" type="text" class="input_text" id="zka4" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($sba1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="sba2">سطح برداشت — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">هکتار</p>
                        <input name="sba2" type="text" class="input_text" id="sba2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($sba2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mtol4">میزان پیش بینی محصول — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">تن</p>
                        <input name="mtolp1" type="text" class="input_text" id="mtol4" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($mtolp1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mtolp2">میزان پیش بینی محصول — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">تن</p>
                        <input name="mtolp2" type="text" class="input_text" id="mtolp2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($mtolp2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mtol1">میزان تولید محصول — بزرگتر یا مساوی</label>
                        <p class="agri1-hint">تن</p>
                        <input name="mtol1" type="text" class="input_text" id="mtol1" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($mtol1); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mtol2">میزان تولید محصول — کوچکتر یا مساوی</label>
                        <p class="agri1-hint">تن</p>
                        <input name="mtol2" type="text" class="input_text" id="mtol2" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($mtol2); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mah_bazar">ماه ارسال به بازار</label>
                        <select name="mah_bazar" class="required input_text required" id="mah_bazar" tabindex="4">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($mah_bazar == '1') { echo 'selected="selected"'; } ?>>فروردین</option>
                            <option value="2" <?php if ($mah_bazar == '2') { echo 'selected="selected"'; } ?>>اردیبهشت</option>
                            <option value="3" <?php if ($mah_bazar == '3') { echo 'selected="selected"'; } ?>>خرداد</option>
                            <option value="4" <?php if ($mah_bazar == '4') { echo 'selected="selected"'; } ?>>تیر</option>
                            <option value="5" <?php if ($mah_bazar == '5') { echo 'selected="selected"'; } ?>>مرداد</option>
                            <option value="6" <?php if ($mah_bazar == '6') { echo 'selected="selected"'; } ?>>شهریور</option>
                            <option value="7" <?php if ($mah_bazar == '7') { echo 'selected="selected"'; } ?>>مهر</option>
                            <option value="8" <?php if ($mah_bazar == '8') { echo 'selected="selected"'; } ?>>آبان</option>
                            <option value="9" <?php if ($mah_bazar == '9') { echo 'selected="selected"'; } ?>>آذر</option>
                            <option value="10" <?php if ($mah_bazar == '10') { echo 'selected="selected"'; } ?>>دی</option>
                            <option value="11" <?php if ($mah_bazar == '11') { echo 'selected="selected"'; } ?>>بهمن</option>
                            <option value="12" <?php if ($mah_bazar == '12') { echo 'selected="selected"'; } ?>>اسفند</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="dah_bazar">دهه ارسال به بازار</label>
                        <select name="dah_bazar" class="required input_text required" id="dah_bazar" tabindex="3">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($dah_bazar == '1') { echo 'selected="selected"'; } ?>>دهه اول </option>
                            <option value="2" <?php if ($dah_bazar == '2') { echo 'selected="selected"'; } ?>>دهه دوم</option>
                            <option value="3" <?php if ($dah_bazar == '3') { echo 'selected="selected"'; } ?>>دهه سوم</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="bah_cod_m">کد ملی بهره بردار</label>
                        <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mor_cod_m">کد ملی مروج</label>
                        <input name="mor_cod_m" type="text" class="style8" id="mor_cod_m" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($login_session); ?>" readonly="readonly"/>
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
        $t_row = 0;

        if (isset($_POST['action'])) {
            if ($id_ostan1 == '-1') { $v_id_ostan  = 1   ;}else{$v_id_ostan  = "id_ostan='$id_ostan1'" ;}
            if ($id_city == 0)      { $v_id_city   = 1   ;}else{$v_id_city   = "id_city='$id_city'" ;}
            if ($id_mar  == 0)      { $v_id_mar    = 1   ;}else{$v_id_mar    = "id_mar='$id_mar'" ;}
            if ($add_abadi  == '0') { $f_add_abadi = 1   ;}else{$f_add_abadi = "add_abadi = '$add_abadi'" ;}
            if ($add_city  == '0')  { $f_add_city  = 1   ;}else{$f_add_city  = "add_city = '$add_city'" ;}
            if ($ra_kesh == '')     { $v_ra_kesh    = 1   ;}else{$v_ra_kesh   = "ra_kesh = '$ra_kesh'" ;}
            if ($mor_cod_m == '')   { $v_mor_cod_m = 1   ;}else{$v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
            if ($bah_cod_m == '')   { $v_bah_cod_m = 1   ;}else{$v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
            if ($z_sal == '')       { $v_z_sal     = 1   ;}else{$v_z_sal     = "z_sal = '$z_sal'" ;}
            if ($b_time == '')        { $f_b_time=   1 ;}else{ $f_b_time   = "b_time = '$b_time'"       ;}
            if ($mah_name == '')    { $v_cod_mah   = 1   ;}else{$v_cod_mah   = "cod_mah = '$mah_name'" ;}
            if ($zka1 == '')        { $v_zka1  = 1       ;}else{$v_zka1      = "zer_kesht >= '$zka1'" ;}
            if ($zka2 == '')        { $v_zka2  = 1       ;}else{$v_zka2      = "zer_kesht <= '$zka2'" ;}
            if ($sba1 == '')        { $v_sba1  = 1       ;}else{$v_sba1      = "s_bar >= '$sba1'" ;}
            if ($sba2 == '')        { $v_sba2  = 1       ;}else{$v_sba2      = "s_bar <= '$sba2'" ;}
            if ($mtol1 == '')       { $v_mtol1  = 1      ;}else{$v_mtol1     = "mah_tol >= '$mtol1'" ;}
            if ($mtol2 == '')       { $v_mtol2  = 1      ;}else{$v_mtol2     = "mah_tol <= '$mtol2'" ;}
            if ($mtolp1 == '')      { $v_mtolp1  = 1     ;}else{$v_mtolp1    = "mah_tolp >= '$mtolp1'" ;}
            if ($mtolp2 == '')      { $v_mtolp2  = 1     ;}else{$v_mtolp2    = "mah_tolp <= '$mtolp2'" ;}
            if ($ragham == '')      { $v_ragham  = 1     ;}else{$v_ragham    = "ragham = '$ragham'" ;}
            if ($no_ab == '')       { $v_no_ab  = 1     ;}else{$v_no_ab   = "no_ab = '$no_ab'" ;}
            if ($mah_bazar == '')   { $v_mah_bazar  = 1  ;}else{$v_mah_bazar     = "mah_bazar = '$mah_bazar'" ;}
            if ($dah_bazar == '')   { $v_dah_bazar  = 1  ;}else{$v_dah_bazar      = "dah_bazar = '$dah_bazar'" ;}
            include('../../login/config.php');
            $start = 0;
            $limit = 10;
            $id     = isset($_GET['id']) ? (int)$_GET['id'] : 1;
            $query1 = '';
            $total  = 0;
            $start = ($id - 1) * $limit;
            $query = "SELECT * from  Vege_prod where  $v_id_ostan  and  $v_id_city  and  $v_id_mar and  $f_add_abadi and 
  $f_add_city and $v_mor_cod_m and $v_bah_cod_m and $v_z_sal  and  $v_cod_mah and $v_sba1 and
  $v_sba2    and  $v_ragham  and $v_no_ab and $v_zka1 and $v_zka2 and $v_mah_bazar and $v_dah_bazar and
  $v_mtolp1 and  $v_mtolp2  and $v_mtol1 and $v_mtol2 and $v_ra_kesh and $f_b_time ORDER BY bah_cod_m ASC LIMIT $start, $limit ";
            $query1 = "SELECT count(*) from  Vege_prod where  $v_id_ostan  and  $v_id_city  and  $v_id_mar and  $f_add_abadi and 
  $f_add_city and $v_mor_cod_m and $v_bah_cod_m and $v_z_sal  and  $v_cod_mah and $v_sba1 and
  $v_sba2    and  $v_ragham  and $v_no_ab and $v_zka1 and $v_zka2 and $v_mah_bazar and $v_dah_bazar and
  $v_mtolp1 and  $v_mtolp2  and $v_mtol1 and $v_mtol2 and $v_ra_kesh and $f_b_time";
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $t_row = $stmt->rowCount();
            if ($t_row > 0) {
        ?>
        <section class="agri1-card agri1-card-results" aria-label="نتایج جستجو">
            <h2 class="agri1-card-title">نتایج</h2>
            <div class="agri1-export">
                <form action="Vege_rep2_xls.php" method="post">
                    <input type="hidden" name="id_ostan" value="<?php echo agri2_h($id_ostan1); ?>"/>
                    <input type="hidden" name="id_city" value="<?php echo agri2_h($id_city); ?>"/>
                    <input type="hidden" name="id_mar" value="<?php echo agri2_h($id_mar); ?>"/>
                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
                    <input type="hidden" name="add_city" value="<?php echo agri2_h($add_city); ?>"/>
                    <input type="hidden" name="ra_kesh" value="<?php echo agri2_h($ra_kesh); ?>"/>
                    <input type="hidden" name="mor_cod_m" value="<?php echo agri2_h($mor_cod_m); ?>"/>
                    <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
                    <input type="hidden" name="b_time" value="<?php echo agri2_h($b_time); ?>"/>
                    <input type="hidden" name="mah_name" value="<?php echo agri2_h($mah_name); ?>"/>
                    <input type="hidden" name="zka1" value="<?php echo agri2_h($zka1); ?>"/>
                    <input type="hidden" name="zka2" value="<?php echo agri2_h($zka2); ?>"/>
                    <input type="hidden" name="ragham" value="<?php echo agri2_h($ragham); ?>"/>
                    <input type="hidden" name="no_ab" value="<?php echo agri2_h($no_ab); ?>"/>
                    <input type="hidden" name="sba1" value="<?php echo agri2_h($sba1); ?>"/>
                    <input type="hidden" name="sba2" value="<?php echo agri2_h($sba2); ?>"/>
                    <input type="hidden" name="mtolp1" value="<?php echo agri2_h($mtolp1); ?>"/>
                    <input type="hidden" name="mtolp2" value="<?php echo agri2_h($mtolp2); ?>"/>
                    <input type="hidden" name="mtol1" value="<?php echo agri2_h($mtol1); ?>"/>
                    <input type="hidden" name="mtol2" value="<?php echo agri2_h($mtol2); ?>"/>
                    <input type="hidden" name="mah_bazar" value="<?php echo agri2_h($mah_bazar); ?>"/>
                    <input type="hidden" name="dah_bazar" value="<?php echo agri2_h($dah_bazar); ?>"/>
                    <button type="submit" title="دانلود نتایج با فرمت فایل اکسل">
                        <img src="../../files/xls.png" width="44" height="45" alt="خروجی اکسل"/>
                    </button>
                </form>
            </div>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <colgroup>
                        <col style="width:8%"/>
                        <col style="width:12%"/>
                        <col style="width:11%"/>
                        <col style="width:8%"/>
                        <col style="width:9%"/>
                        <col style="width:9%"/>
                        <col style="width:10%"/>
                        <col style="width:12%"/>
                        <col style="width:15%"/>
                        <col style="width:6%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="agri1-ops-col">عملیات</th>
                            <th>نام محصول</th>
                            <th>فصل تولید</th>
                            <th>قطعی</th>
                            <th>پیش بینی</th>
                            <th>سطح برداشت</th>
                            <th>سطح زیر کشت</th>
                            <th>کد ملی</th>
                            <th>نام</th>
                            <th>ردیف</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $r = $start + 1;
                    foreach ($stmt as $row) {
                        $v_b_time = '';
                        if ($row['b_time'] == '1') $v_b_time = 'زمستانه/استمرار';
                        if ($row['b_time'] == '2') $v_b_time = 'بهاره';
                        if ($row['b_time'] == '3') $v_b_time = 'تابستانه';
                        if ($row['b_time'] == '4') $v_b_time = 'پاییزه';
                    ?>
                        <tr>
                            <td class="agri1-ops">
                                <form action="Vegedata_T_view.php" method="post" onsubmit="target_popup2(this)">
                                    <input type="hidden" name="id" value="<?php echo agri2_h($row['Vege_id']); ?>"/>
                                    <button type="submit">
                                        <img src="../../files/view.png" title="نمایش اطلاعات بهره برداری" width="33" height="26" alt=""/>
                                    </button>
                                </form>
                            </td>
                            <td><?php echo agri2_h(mah_name($row['cod_mah'])); ?></td>
                            <td><?php echo agri2_h($v_b_time); ?></td>
                            <td><?php echo agri2_h(round($row['mah_tol'], 3) * 1); ?></td>
                            <td><?php echo agri2_h(round($row['mah_tolp'], 3) * 1); ?></td>
                            <td><?php echo agri2_h($row['s_bar'] + 0); ?></td>
                            <td><?php echo agri2_h($row['zer_kesht'] + 0); ?></td>
                            <td dir="ltr"><?php echo agri2_h($row['bah_cod_m']); ?></td>
                            <td class="agri1-name-col"><?php echo agri2_h(str_replace('&nbsp;', ' ', bah_name($row['bah_cod_m']))); ?></td>
                            <td><?php echo (int)$r; ?></td>
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

            if ($t_row > 0 && $query1 !== '') {
                $stmt1 = $dbh->prepare($query1);
                $stmt1->execute();
                $rows = $stmt1->fetchColumn();
                $total = ($limit > 0) ? ceil($rows / $limit) : 0;
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
                    <form action="Vege_rep2.php?id=<?php echo (int)$id - 1; ?>#1" method="post">
                        <?php vege_rep2_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $ra_kesh, $mor_cod_m, $bah_cod_m, $z_sal, $b_time, $zka1, $zka2, $sba1, $sba2, $mtol1, $mtol2, $mtolp1, $mtolp2, $ragham, $no_ab, $dah_bazar, $mah_bazar, $mah_name); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="Vege_rep2.php?id=1#1" method="post">
                        <?php vege_rep2_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $ra_kesh, $mor_cod_m, $bah_cod_m, $z_sal, $b_time, $zka1, $zka2, $sba1, $sba2, $mtol1, $mtol2, $mtolp1, $mtolp2, $ragham, $no_ab, $dah_bazar, $mah_bazar, $mah_name); ?>
                        <button type="submit" class="agri1-pager-btn">1</button>
                    </form>
                </li>
                    <?php if ($start_page > 2) { ?>
                <li><span class="agri1-pager-ellipsis">...</span></li>
                    <?php } ?>
                <?php } ?>
                <?php for ($i = $start_page; $i <= $end_page; $i++) { ?>
                <li>
                    <?php if ($i == $id) { ?>
                    <span class="agri1-pager-btn is-current"><?php echo (int)$i; ?></span>
                    <?php } else { ?>
                    <form action="Vege_rep2.php?id=<?php echo (int)$i; ?>#1" method="post">
                        <?php vege_rep2_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $ra_kesh, $mor_cod_m, $bah_cod_m, $z_sal, $b_time, $zka1, $zka2, $sba1, $sba2, $mtol1, $mtol2, $mtolp1, $mtolp2, $ragham, $no_ab, $dah_bazar, $mah_bazar, $mah_name); ?>
                        <button type="submit" class="agri1-pager-btn"><?php echo (int)$i; ?></button>
                    </form>
                    <?php } ?>
                </li>
                <?php } ?>
                <?php if ($show_last) { ?>
                    <?php if ($end_page < $total - 1) { ?>
                <li><span class="agri1-pager-ellipsis">...</span></li>
                    <?php } ?>
                <li>
                    <form action="Vege_rep2.php?id=<?php echo (int)$total; ?>#1" method="post">
                        <?php vege_rep2_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $ra_kesh, $mor_cod_m, $bah_cod_m, $z_sal, $b_time, $zka1, $zka2, $sba1, $sba2, $mtol1, $mtol2, $mtolp1, $mtolp2, $ragham, $no_ab, $dah_bazar, $mah_bazar, $mah_name); ?>
                        <button type="submit" class="agri1-pager-btn"><?php echo (int)$total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if (isset($id) && $id != $total && $total > 0) { ?>
                <li>
                    <form action="Vege_rep2.php?id=<?php echo (int)$id + 1; ?>#1" method="post">
                        <?php vege_rep2_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $ra_kesh, $mor_cod_m, $bah_cod_m, $z_sal, $b_time, $zka1, $zka2, $sba1, $sba2, $mtol1, $mtol2, $mtolp1, $mtolp2, $ragham, $no_ab, $dah_bazar, $mah_bazar, $mah_name); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="Vege_rep2.php" method="post">
                    <?php vege_rep2_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $ra_kesh, $mor_cod_m, $bah_cod_m, $z_sal, $b_time, $zka1, $zka2, $sba1, $sba2, $mtol1, $mtol2, $mtolp1, $mtolp2, $ragham, $no_ab, $dah_bazar, $mah_bazar, $mah_name); ?>
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
                    this.action = 'Vege_rep2.php?id=' + pageId + '#1';
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
            form.addEventListener('submit', function (e) {
                var submitter = e.submitter || document.activeElement;
                if (!submitter || submitter.name !== 'action') return;
                if (overlay) overlay.className = 'agri1-overlay is-open';
                if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
            });
        })();
    </script>
</body>
</html>
