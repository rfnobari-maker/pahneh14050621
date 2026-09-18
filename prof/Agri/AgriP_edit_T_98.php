<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri98_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $mah_qroup, $mah_name, $dis)
{
    $pairs = array(
        'action' => '1',
        'id_ostan' => $id_ostan1,
        'id_city5' => $id_city,
        'id_mar' => $id_mar,
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'bah_cod_m' => $bah_cod_m,
        'mor_cod_m' => $mor_cod_m,
        'no_kesh' => $no_kesh,
        'z_sal' => $z_sal,
        'mah_qroup' => $mah_qroup,
        'mah_name' => $mah_name,
        'dis' => $dis
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');
$id_ostan1 = (isset($_POST['id_ostan']) && $_POST['id_ostan'] !== '') ? $_POST['id_ostan'] : $id_ostan;
$id_city   = (isset($_POST['id_city5']) && $_POST['id_city5'] !== '' && $_POST['id_city5'] !== '0') ? $_POST['id_city5'] : $id_city;
$id_mar    = (isset($_POST['id_mar']) && $_POST['id_mar'] !== '' && $_POST['id_mar'] !== '0') ? $_POST['id_mar'] : $id_mar;
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city  = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh   = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$dis       = isset($_POST['dis']) ? $_POST['dis'] : '';

if (isset($_POST['z_sal'])) {
    $z_sal = $_POST['z_sal'];
    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
} else {
    $z_sal = '';
    $Agri_prod_table = '';
}

$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
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
            white-space: nowrap;
            overflow: hidden;
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
        @media (max-width: 1100px) {
            .agri1-table-hint { display: block; }
        }
        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
            .agri1-table th { font-size: 13px; }
            .agri1-table td { font-size: 14px; }
            .agri1-table .agri1-inline-input,
            .agri1-table .agri1-inline-select {
                font-size: 16px;
                min-height: 36px;
            }
            .agri1-table .agri1-kh-select.is-empty { font-size: 13px; }
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
            $(".country<?php if (isset($num_t_mah)) echo $num_t_mah; ?>").change(function () {
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
            <h1 class="agri1-title" id="agri98-title">تکمیل اطلاعات سطح برداشت و تولید قطعی</h1>
        </header>

        <section class="agri1-card agri1-card-search" aria-labelledby="agri98-title">
            <form id="reg-form" class="agri1-form" method="post" action="#1" novalidate>
                <h2 class="agri1-card-title">جستجو</h2>
                <div class="agri1-grid">
                    <div class="agri1-field">
                        <label class="agri1-label" for="z_sal">سال زراعی</label>
                        <select name="z_sal" class="input_text required" id="z_sal" tabindex="1">
                            <option value="1404-1405" <?php if (isset($z_sal) && $z_sal == '1404-1405') echo 'selected="selected"'; ?>>1404-1405</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_ostan">استان</label>
                        <select name="id_ostan" disabled="disabled" class="style8" id="id_ostan" dir="rtl">
                            <?php $id_ostan1 = $id_ostan; ?>
                            <option value="-1">انتخاب استان</option>
                            <?php
                            $query = "SELECT id_ostan,ostan FROM `ostanname` ORDER BY BINARY ostan ASC";
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
                        <select name="no_kesh" class="input_text required" id="no_bah2" tabindex="2">
                            <option value="0">انتخاب کنید</option>
                            <option value="1" <?php if (isset($no_kesh) and $no_kesh == "1") echo "selected='selected'"; ?>>آبی</option>
                            <option value="2" <?php if (isset($no_kesh) and $no_kesh == "2") echo "selected='selected'"; ?>>دیم</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="id_city">شهرستان</label>
                        <?php $id_city = isset($_SESSION['id_city']) ? $_SESSION['id_city'] : $id_city; ?>
                        <select name="id_city5" disabled="disabled" class="style8" id="id_city" dir="rtl">
                            <option value="0">کل استان</option>
                            <?php
                            $query = "SELECT id_city,city FROM `cityname` WHERE `id_ostan` = '$id_ostan1' ORDER BY BINARY city ASC";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['id_city']); ?>"
                                <?php if ($row['id_city'] == $id_city) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['city']); ?></option>
                            <?php } ?>
                        </select>
                        <?php
                        if (isset($_POST['id_city5']) && $_POST['id_city5'] !== '' && $_POST['id_city5'] !== '0') {
                            $id_city = $_POST['id_city5'];
                        }
                        ?>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mah_qroup">گروه محصولات</label>
                        <select name="mah_qroup" class="required input_text country" id="mah_qroup" tabindex="3" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            <?php
                            $query = "SELECT DISTINCT group_cod,group_name FROM `product_z`";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['group_cod']); ?>"
                                <?php if (isset($mah_qroup) and $row['group_cod'] == $mah_qroup) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['group_name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="mah_name">نام محصول</label>
                        <select name="mah_name" class="required input_text mar" id="mah_name" tabindex="4" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            <?php
                            if (isset($mah_qroup) && $mah_qroup !== '') {
                                $query = "SELECT DISTINCT product_cod,product_name FROM `product_z` WHERE `group_cod` = $mah_qroup";
                                $stmt = $dbh->prepare($query);
                                $stmt->execute();
                                foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['product_cod']); ?>"
                                <?php if ($row['product_cod'] == $mah_name) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['product_name']); ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="bakh">مرکز جهاد کشاورزی</label>
                        <?php $id_mar = isset($_SESSION['id_mar']) ? $_SESSION['id_mar'] : $id_mar; ?>
                        <select name="id_mar" disabled="disabled" class="style8" id="bakh" dir="rtl">
                            <option value="0">نام مرکز</option>
                            <?php
                            if ($id_ostan1 !== '' && $id_ostan1 !== '-1' && $id_city !== '' && $id_city !== '0') {
                                $query = "SELECT id_mar,mar FROM `mar` WHERE `id_ostan` = $id_ostan1 and `id_city` = $id_city";
                                $stmt = $dbh->prepare($query);
                                $stmt->execute();
                                foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['id_mar']); ?>"
                                <?php if ($row['id_mar'] == $id_mar) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['mar']); ?></option>
                            <?php }
                            } ?>
                        </select>
                        <?php
                        if (isset($_POST['id_mar']) && $_POST['id_mar'] !== '' && $_POST['id_mar'] !== '0') {
                            $id_mar = $_POST['id_mar'];
                        }
                        ?>
                        <input name="id_city" type="hidden" value="<?php echo agri2_h($id_city); ?>"/>
                        <input name="id_city5" type="hidden" value="<?php echo agri2_h($id_city); ?>"/>
                        <input name="id_mar" type="hidden" value="<?php echo agri2_h($id_mar); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_abadi">نام آبادی</label>
                        <select name="add_abadi" class="input_text" id="add_abadi" tabindex="6" dir="rtl">
                            <option value="0">انتخاب کنید</option>
                            <?php
                            $id_city = isset($_SESSION['id_city']) ? $_SESSION['id_city'] : $id_city;
                            $id_mar  = isset($_SESSION['id_mar']) ? $_SESSION['id_mar'] : $id_mar;
                            $query = "SELECT add_abadi,abadi FROM `list_abadi` WHERE `id_ostan` = '$id_ostan' and `id_city` = '$id_city' and `id_mar` = '$id_mar' and `mor_cod_m` = '$login_session' ORDER BY BINARY abadi";
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
                        <label class="agri1-label" for="add_city">نام شهر</label>
                        <select name="add_city" class="input_text" id="add_city" tabindex="7" dir="rtl">
                            <option value="0">انتخاب کنید</option>
                            <?php
                            $query = "SELECT add_city,shahr FROM `list_city` WHERE `id_ostan` = '$id_ostan' and `id_city` = '$id_city' and `id_mar` = '$id_mar' and `mor_cod_m` = '$login_session' ORDER BY BINARY shahr";
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
                        <label class="agri1-label" for="mor_cod_m">کد ملی مروج</label>
                        <input name="mor_cod_m" id="mor_cod_m" type="text" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($login_session); ?>" readonly="readonly"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="bah_cod_m">کد ملی بهره‌بردار</label>
                        <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m" dir="ltr" inputmode="numeric" tabindex="8" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="dis">نمایش رکوردها</label>
                        <select name="dis" class="input_text required" id="dis" tabindex="9">
                            <option value="1" selected="selected" <?php if ($dis == "1") echo "selected='selected'"; ?>>همه رکوردها</option>
                            <option value="2" <?php if ($dis == "2") echo "selected='selected'"; ?>>رکوردهای فاقد تولید قطعی</option>
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
            if ($id_ostan1 == '-1') {
                $v_id_ostan = 'id_ostan=id_ostan';
            } else {
                $v_id_ostan = "id_ostan='$id_ostan1'";
            }
            if ($id_city == 0) {
                $v_id_city = 1;
            } else {
                $v_id_city = "id_city='$id_city'";
            }
            if ($id_mar == 0) {
                $v_id_mar = 1;
            } else {
                $v_id_mar = "id_mar='$id_mar'";
            }
            if ($add_abadi == '0') {
                $f_add_abadi = 1;
            } else {
                $f_add_abadi = "add_abadi = '$add_abadi'";
            }
            if ($add_city == '0') {
                $f_add_city = 1;
            } else {
                $f_add_city = "add_city = '$add_city'";
            }
            if ($no_kesh == '0') {
                $f_no_kesh = 1;
            } else {
                $f_no_kesh = "no_kesh = '$no_kesh'";
            }
            if ($mor_cod_m == '') {
                $v_mor_cod_m = 1;
            } else {
                $v_mor_cod_m = "mor_cod_m ='$login_session' ";
            }
            if ($bah_cod_m == '') {
                $v_bah_cod_m = 1;
            } else {
                $v_bah_cod_m = "bah_cod_m ='$bah_cod_m' ";
            }
            if ($z_sal == '') {
                $v_z_sal = 1;
            } else {
                $v_z_sal = "z_sal = '$z_sal'";
            }
            if ($mah_name == '') {
                $v_cod_mah = 1;
            } else {
                $v_cod_mah = "cod_mah = '$mah_name'";
            }
            if ($dis == '1') {
                $v_dis = 1;
            } else {
                $v_dis = "mah_tol = 0 and mah_kh !='1' ";
            }

            $start = 0;
            $limit = 10;
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
            if ($id < 1) $id = 1;
            $start = ($id - 1) * $limit;
            $query = "SELECT id,bah_cod_m,sh_gat,no_kesh,cod_mah,zer_kesht_a,zer_kesht_b,mah_tolp,s_bar_a,s_bar_b,mah_tol,add_abadi,mah_kh from $Agri_prod_table where $v_id_ostan and $v_id_city and $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh and $v_mor_cod_m and $v_bah_cod_m and $v_z_sal and $v_cod_mah and $v_dis ORDER BY bah_cod_m,sh_gat ASC LIMIT $start, $limit ";
            $query1 = "SELECT count(*) from $Agri_prod_table where $v_id_ostan and $v_id_city and $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh and $v_mor_cod_m and $v_bah_cod_m and $v_z_sal and $v_cod_mah and $v_dis ";
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $t_row = $stmt->rowCount();
            if ($t_row > 0) {
        ?>
        <section class="agri1-card agri1-card-results" aria-label="نتایج جستجو">
            <h2 class="agri1-card-title">نتایج</h2>
            <p class="agri1-table-hint">برای مشاهده همه ستون‌ها جدول را افقی بکشید.</p>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <colgroup>
                        <col style="width:6%"/>
                        <col style="width:8%"/>
                        <col style="width:8%"/>
                        <col style="width:6%"/>
                        <col style="width:6%"/>
                        <col style="width:7%"/>
                        <col style="width:6%"/>
                        <col style="width:6%"/>
                        <col style="width:10%"/>
                        <col style="width:5%"/>
                        <col style="width:6%"/>
                        <col style="width:9%"/>
                        <col style="width:13%"/>
                        <col style="width:4%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="agri1-ops-col" rowspan="2">عملیات</th>
                            <th rowspan="2">خسارت دیده؟</th>
                            <th rowspan="2">میزان تولید قطعی<br />تن</th>
                            <th colspan="2">سطح برداشت<br />هکتار</th>
                            <th rowspan="2">پیش‌بینی تولید<br />تن</th>
                            <th colspan="2">سطح زیر کشت<br />هکتار</th>
                            <th rowspan="2">نام محصول</th>
                            <th rowspan="2">نوع کشت</th>
                            <th rowspan="2">شماره قطعه</th>
                            <th colspan="2">مشخصات بهره‌بردار</th>
                            <th rowspan="2">ردیف</th>
                        </tr>
                        <tr>
                            <th>دوم</th>
                            <th>اول</th>
                            <th>دوم</th>
                            <th>اول</th>
                            <th>کد ملی</th>
                            <th>نام و نام خانوادگی</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $t_r = 1;
                    $r = $start + 1;
                    foreach ($stmt as $row) {
                        $v_no_kesh = '';
                        if ($row['no_kesh'] == '1') $v_no_kesh = 'آبی';
                        if ($row['no_kesh'] == '2') $v_no_kesh = 'دیم';
                    ?>
                        <tr>
                            <td class="agri1-ops">
                                <form name="form<?php echo $t_r; ?>" id="row-form-<?php echo $t_r; ?>">
                                    <input type="hidden" id="id<?php echo $t_r; ?>" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                    <input type="hidden" id="add_city<?php echo $t_r; ?>" name="add_city" value="<?php echo agri2_h($add_city); ?>"/>
                                    <input type="hidden" id="z_sal<?php echo $t_r; ?>" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
                                    <input type="hidden" id="bah_cod_m<?php echo $t_r; ?>" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                    <input type="hidden" id="add_abadi<?php echo $t_r; ?>" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                    <input type="hidden" id="sh_gat<?php echo $t_r; ?>" name="sh_gat" value="<?php echo agri2_h($row['sh_gat']); ?>"/>
                                    <div class="agri1-save-wrap">
                                        <button type="submit" name="submit" class="agri1-btn agri1-btn-primary submit<?php echo $t_r; ?>" id="submit<?php echo $t_r; ?>" tabindex="<?php echo $r . '5'; ?>">ثبت</button>
                                        <span class="error<?php echo $t_r; ?> agri1-save-msg agri1-save-err" style="display:none">ثبت نشد</span>
                                        <span class="success<?php echo $t_r; ?> agri1-save-msg agri1-save-ok" style="display:none">ثبت شد</span>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <select name="mah_kh" class="required input_text agri1-inline-select agri1-kh-select<?php if ($row['mah_kh'] != '1' && $row['mah_kh'] != '2') echo ' is-empty'; ?>" id="mah_kh<?php echo $t_r; ?>" tabindex="<?php echo $r . '4'; ?>" form="row-form-<?php echo $t_r; ?>">
                                    <option value="">انتخاب کنید</option>
                                    <option value="1" <?php if ($row['mah_kh'] == '1') echo 'selected="selected"'; ?>>بلی</option>
                                    <option value="2" <?php if ($row['mah_kh'] == '2') echo 'selected="selected"'; ?>>خیر</option>
                                </select>
                            </td>
                            <td>
                                <input name="mah_tol" type="text" class="mah_tol<?php echo $t_r; ?> required number input_text agri1-inline-input" id="mah_tol<?php echo $t_r; ?>" tabindex="<?php echo $r . '3'; ?>" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($row['mah_tol'] * 1); ?>" maxlength="10" form="row-form-<?php echo $t_r; ?>"/>
                            </td>
                            <td>
                                <input name="s_bar_b" type="text" class="s_bar_b<?php echo $t_r; ?> required digits input_text agri1-inline-input" id="s_bar_b<?php echo $t_r; ?>" tabindex="<?php echo $r . '2'; ?>" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($row['s_bar_b'] * 1); ?>" maxlength="6" form="row-form-<?php echo $t_r; ?>"/>
                            </td>
                            <td>
                                <input name="s_bar_a" type="text" class="s_bar_a<?php echo $t_r; ?> required digits input_text agri1-inline-input" id="s_bar_a<?php echo $t_r; ?>" tabindex="<?php echo $r . '1'; ?>" dir="ltr" inputmode="decimal" value="<?php echo agri2_h($row['s_bar_a'] * 1); ?>" maxlength="6" form="row-form-<?php echo $t_r; ?>"/>
                            </td>
                            <td><?php echo agri2_h($row['mah_tolp'] * 1); ?></td>
                            <td>
                                <?php echo agri2_h($row['zer_kesht_b']); ?>
                                <input name="zer_kesht_b<?php echo $t_r; ?>" type="hidden" class="zer_kesht_b<?php echo $t_r; ?> required digits style8" id="zer_kesht_b<?php echo $t_r; ?>" value="<?php echo agri2_h($row['zer_kesht_b'] * 1); ?>"/>
                            </td>
                            <td>
                                <?php echo agri2_h($row['zer_kesht_a']); ?>
                                <input name="zer_kesht_a<?php echo $t_r; ?>" type="hidden" class="zer_kesht_a<?php echo $t_r; ?> required digits style8" id="zer_kesht_a<?php echo $t_r; ?>" value="<?php echo agri2_h($row['zer_kesht_a'] * 1); ?>"/>
                            </td>
                            <td class="agri1-name-col">
                                <?php echo agri2_h(mah_name($row['cod_mah'])); ?>
                                <input name="cod_mah<?php echo $t_r; ?>" type="hidden" class="cod_mah<?php echo $t_r; ?> required digits style2" id="cod_mah<?php echo $t_r; ?>" value="<?php echo agri2_h($row['cod_mah']); ?>"/>
                            </td>
                            <td>
                                <?php echo agri2_h($v_no_kesh); ?>
                                <input name="no_kesh<?php echo $t_r; ?>" type="hidden" class="no_kesh<?php echo $t_r; ?> required digits style2" id="no_kesh<?php echo $t_r; ?>" value="<?php echo agri2_h($row['no_kesh']); ?>"/>
                            </td>
                            <td><?php echo agri2_h($row['sh_gat']); ?></td>
                            <td dir="ltr"><?php echo agri2_h($row['bah_cod_m']); ?></td>
                            <td class="agri1-name-col"><?php echo agri2_h(str_replace('&nbsp;', ' ', bah_name($row['bah_cod_m']))); ?></td>
                            <td><?php echo $r; ?></td>
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
                    <form action="AgriP_edit_T_98.php?id=<?php echo (int)$id - 1; ?>#1" method="post">
                        <?php agri98_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $mah_qroup, $mah_name, $dis); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="AgriP_edit_T_98.php?id=1#1" method="post">
                        <?php agri98_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $mah_qroup, $mah_name, $dis); ?>
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
                    <form action="AgriP_edit_T_98.php?id=<?php echo (int)$i; ?>#1" method="post">
                        <?php agri98_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $mah_qroup, $mah_name, $dis); ?>
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
                    <form action="AgriP_edit_T_98.php?id=<?php echo (int)$total; ?>#1" method="post">
                        <?php agri98_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $mah_qroup, $mah_name, $dis); ?>
                        <button type="submit" class="agri1-pager-btn"><?php echo (int)$total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if (isset($id) && $id != $total && $total > 0) { ?>
                <li>
                    <form action="AgriP_edit_T_98.php?id=<?php echo (int)$id + 1; ?>#1" method="post">
                        <?php agri98_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $mah_qroup, $mah_name, $dis); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="AgriP_edit_T_98.php" method="post">
                    <?php agri98_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $mah_qroup, $mah_name, $dis); ?>
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
                    this.action = 'AgriP_edit_T_98.php?id=' + pageId + '#1';
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
            $(document).on('change', '.agri1-kh-select', function () {
                if (this.value === '') $(this).addClass('is-empty');
                else $(this).removeClass('is-empty');
            });
        })();
    </script>
<?php
$no = isset($t_row) ? $t_row : 0;
while ($no > 0) {
?>
<script>
// ===== کنترل سطح برداشت اول =====
$('.s_bar_a<?php echo $no; ?>').on('input', function () {
    var sba = parseFloat($(this).val()) || 0;
    var sbb = parseFloat($('#s_bar_b<?php echo $no; ?>').val()) || 0;
    var zka = parseFloat($('#zer_kesht_a<?php echo $no; ?>').val()) || 0;
    var zkb = parseFloat($('#zer_kesht_b<?php echo $no; ?>').val()) || 0;

    if (sba > 0 && sbb > 0) {
        $(this).val('');
        alert('سطح برداشت اول و دوم نمی‌توانند همزمان مقدار داشته باشند.');
        this.focus();
        return;
    }
    if (zkb > 0 && zka <= 0 && sba > 0) {
        $(this).val('');
        alert('با توجه به سطح زیر کشت دوم، فقط سطح برداشت دوم مجاز است.');
        this.focus();
        return;
    }
    if (zka <= 0 && sba > 0) {
        $(this).val('');
        alert('سطح زیر کشت اول صفر است، ثبت سطح برداشت اول مجاز نیست.');
        this.focus();
    }
});
</script>
<script>
$('.s_bar_a<?php echo $no; ?>').keyup(function () {
    var zka = document.getElementById("zer_kesht_a<?php echo $no; ?>").value;
    var sba = document.getElementById("s_bar_a<?php echo $no; ?>").value;
    if (parseFloat(zka) < parseFloat(sba)) {
        alert("سطح برداشت اول از سطح زیر کشت اول بزرگتر است ");
        $('#s_bar_a<?php echo $no; ?>').val('');
        document.getElementById("s_bar_a<?php echo $no; ?>").focus();
    }
});
</script>
<script>
$('.s_bar_a<?php echo $no; ?>').change(function () {
    $('#mah_tol<?php echo $no; ?>').val('');
});
</script>

<script>
// ===== کنترل سطح برداشت دوم =====
$('.s_bar_b<?php echo $no; ?>').on('input', function () {
    var sbb = parseFloat($(this).val()) || 0;
    var sba = parseFloat($('#s_bar_a<?php echo $no; ?>').val()) || 0;
    var zka = parseFloat($('#zer_kesht_a<?php echo $no; ?>').val()) || 0;
    var zkb = parseFloat($('#zer_kesht_b<?php echo $no; ?>').val()) || 0;

    if (sba > 0 && sbb > 0) {
        $(this).val('');
        alert('سطح برداشت اول و دوم نمی‌توانند همزمان مقدار داشته باشند.');
        this.focus();
        return;
    }
    if (zka > 0 && zkb <= 0 && sbb > 0) {
        $(this).val('');
        alert('با توجه به سطح زیر کشت اول، فقط سطح برداشت اول مجاز است.');
        this.focus();
        return;
    }
    if (zkb <= 0 && sbb > 0) {
        $(this).val('');
        alert('سطح زیر کشت دوم صفر است، ثبت سطح برداشت دوم مجاز نیست.');
        this.focus();
    }
});
</script>
<script>
$('.s_bar_b<?php echo $no; ?>').keyup(function () {
    var zkb = document.getElementById("zer_kesht_b<?php echo $no; ?>").value;
    var sbb = document.getElementById("s_bar_b<?php echo $no; ?>").value;
    if (parseFloat(zkb) < parseFloat(sbb)) {
        alert("سطح برداشت دوم از سطح زیر کشت دوم بزرگتر است ");
        $('#s_bar_b<?php echo $no; ?>').val('');
        document.getElementById("s_bar_b<?php echo $no; ?>").focus();
    }
});
</script>
<script>
$('.s_bar_b<?php echo $no; ?>').change(function () {
    $('#mah_tol<?php echo $no; ?>').val('');
});
</script>

<script>
$('.mah_tol<?php echo $no; ?>').keyup(function () {
    var mcod = document.getElementById("cod_mah<?php echo $no; ?>").value;
    var sba = document.getElementById("s_bar_a<?php echo $no; ?>").value;
    var sbb = document.getElementById("s_bar_b<?php echo $no; ?>").value;
    var mtol = document.getElementById("mah_tol<?php echo $no; ?>").value;
    var no_kesh = document.getElementById("no_kesh<?php echo $no; ?>").value;
    $.ajax({
        url: "aj.php",
        type: "POST",
        data: {op: "check_mah_tol", mcod: mcod, sba: sba, sbb: sbb, mtol: mtol, no_kesh: no_kesh},
        success: function (data, status) {
            if (data != 'true') {
                document.getElementById("submit<?php echo $no; ?>").disabled = true;
                $('#mah_tol<?php echo $no; ?>').val('');
                document.getElementById("mah_tol<?php echo $no; ?>").focus();
                alert(' خطا \n \n میزان تولید وارد شده از محدود مجاز ، بیشتر هست / میزان سطح برداشت را بررسی کنید ');
            } else {
                document.getElementById("submit<?php echo $no; ?>").disabled = false;
            }
        },
        error: function () { $("#result").html("مشکلی در اتصال به سرور به وجود آمد!"); }
    });
});
</script>
<script>
$('.mah_tol<?php echo $no; ?>').change(function () {
    var sba = document.getElementById("s_bar_a<?php echo $no; ?>").value;
    var sbb = document.getElementById("s_bar_b<?php echo $no; ?>").value;
    var mtol = document.getElementById("mah_tol<?php echo $no; ?>").value;
    var sb = sba + sbb;
    if (parseFloat(sb) > 0 && parseFloat(mtol) <= 0) {
        $('#mah_tol<?php echo $no; ?>').val('');
        document.getElementById("mah_tol<?php echo $no; ?>").focus();
        alert("با توجه به سطح برداشت ، تولید قطعی نادرست است");
    }
});
</script>
<script type="text/javascript">
$(function () {
    $(".submit<?php echo $no; ?>").click(function () {
        var s_bar_a = $("#s_bar_a<?php echo $no; ?>").val();
        var s_bar_b = $("#s_bar_b<?php echo $no; ?>").val();
        var mah_tol = $("#mah_tol<?php echo $no; ?>").val();
        var e = document.getElementById("mah_kh<?php echo $no; ?>");
        var mah_kh = e.options[e.selectedIndex].value;
        var id = $("#id<?php echo $no; ?>").val();
        var bah_cod_m = $("#bah_cod_m<?php echo $no; ?>").val();
        var add_abadi = $("#add_abadi<?php echo $no; ?>").val();
        var z_sal = $("#z_sal<?php echo $no; ?>").val();
        var sh_gat = $("#sh_gat<?php echo $no; ?>").val();
        var zka = parseFloat($("#zer_kesht_a<?php echo $no; ?>").val()) || 0;
        var zkb = parseFloat($("#zer_kesht_b<?php echo $no; ?>").val()) || 0;
        var sba_num = parseFloat(s_bar_a) || 0;
        var sbb_num = parseFloat(s_bar_b) || 0;
        var sb = sba_num + sbb_num;

        var dataString = 's_bar_a=' + s_bar_a + '&s_bar_b=' + s_bar_b + '&mah_tol=' + mah_tol + '&id=' + id
            + '&bah_cod_m=' + bah_cod_m + '&add_abadi=' + add_abadi + '&z_sal=' + z_sal + '&sh_gat=' + sh_gat + '&mah_kh=' + mah_kh;

        // ===== اعتبارسنجی نهایی قبل از ارسال =====
        if (s_bar_a == '' || s_bar_b == '' || mah_tol == '' || mah_kh == '') {
            $('.success<?php echo $no; ?>').fadeOut(200).hide();
            $('.error<?php echo $no; ?>').text('همه فیلدها الزامی هستند.').fadeIn(200).show();
            return false;
        }
        if (sb > 0 && parseFloat(mah_tol) <= 0) {
            $('.success<?php echo $no; ?>').fadeOut(200).hide();
            $('.error<?php echo $no; ?>').text('با سطح برداشت موجود، تولید قطعی باید بزرگتر از صفر باشد.').fadeIn(200).show();
            return false;
        }
        if (sb <= 0 && parseFloat(mah_tol) > 0) {
            $('.success<?php echo $no; ?>').fadeOut(200).hide();
            $('.error<?php echo $no; ?>').text('بدون سطح برداشت، تولید قطعی نباید مقدار داشته باشد.').fadeIn(200).show();
            return false;
        }
        if (sba_num > 0 && sbb_num > 0) {
            $('.success<?php echo $no; ?>').fadeOut(200).hide();
            $('.error<?php echo $no; ?>').text('هر دو سطح برداشت همزمان مجاز نیست.').fadeIn(200).show();
            return false;
        }
        if (zka > 0 && sbb_num > 0) {
            $('.success<?php echo $no; ?>').fadeOut(200).hide();
            $('.error<?php echo $no; ?>').text('با سطح زیر کشت اول، فقط برداشت اول مجاز است.').fadeIn(200).show();
            return false;
        }
        if (zkb > 0 && sba_num > 0) {
            $('.success<?php echo $no; ?>').fadeOut(200).hide();
            $('.error<?php echo $no; ?>').text('با سطح زیر کشت دوم، فقط برداشت دوم مجاز است.').fadeIn(200).show();
            return false;
        }
        if (sba_num > 0 && zka <= 0) {
            $('.success<?php echo $no; ?>').fadeOut(200).hide();
            $('.error<?php echo $no; ?>').text('سطح زیر کشت اول صفر است.').fadeIn(200).show();
            return false;
        }
        if (sbb_num > 0 && zkb <= 0) {
            $('.success<?php echo $no; ?>').fadeOut(200).hide();
            $('.error<?php echo $no; ?>').text('سطح زیر کشت دوم صفر است.').fadeIn(200).show();
            return false;
        }

        // ===== ارسال به سرور =====
        $.ajax({
            type: "POST",
            url: "post98.php",
            data: dataString,
            success: function (response) {
                if (response.indexOf('error') === 0) {
                    var msg = 'ثبت نشد.';
                    if (response === 'error:both_harvest') msg = 'هر دو سطح برداشت همزمان مجاز نیست.';
                    else if (response === 'error:invalid_harvest_a') msg = 'با سطح زیر کشت دوم، سطح برداشت اول مجاز نیست.';
                    else if (response === 'error:invalid_harvest_b') msg = 'با سطح زیر کشت اول، سطح برداشت دوم مجاز نیست.';
                    else if (response === 'error:no_zer_kesht_a') msg = 'سطح زیر کشت اول صفر است.';
                    else if (response === 'error:no_zer_kesht_b') msg = 'سطح زیر کشت دوم صفر است.';
                    else if (response === 'error:record_not_found') msg = 'رکورد یافت نشد.';
                    $('.error<?php echo $no; ?>').text(msg).fadeIn(200).show();
                    $('.success<?php echo $no; ?>').fadeOut(200).hide();
                } else {
                    $('.success<?php echo $no; ?>').fadeIn(200).show();
                    $('.error<?php echo $no; ?>').fadeOut(200).hide();
                }
            },
            error: function () {
                $('.error<?php echo $no; ?>').text('خطا در ارتباط با سرور').fadeIn(200).show();
                $('.success<?php echo $no; ?>').fadeOut(200).hide();
            }
        });
        return false;
    });
});
</script>
<?php
    $no--;
}
?>
</body>
</html>