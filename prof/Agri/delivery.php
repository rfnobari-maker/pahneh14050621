<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function delivery_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $dis)
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
        'dis' => $dis
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city   = isset($_POST['id_city5']) ? $_POST['id_city5'] : '';
$id_mar    = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
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
            width: 72px;
            padding: 3px 2px;
            white-space: normal;
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
        .agri1-table .agri1-delivery-input { width: 64px; }
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
        .agri1-save-edit { color: var(--color-muted-foreground); }
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
            <h1 class="agri1-title" id="delivery-title">ثبت میزان گندم تحویلی به دولت</h1>
        </header>

        <section class="agri1-card agri1-card-search" aria-labelledby="delivery-title">
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
                            <option value="-1">انتخاب کنید</option>
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
                        if (isset($_POST['id_city5'])) {
                            $id_city = $_POST['id_city5'];
                        }
                        ?>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_abadi">نام آبادی</label>
                        <select name="add_abadi" class="input_text" id="add_abadi" tabindex="6" dir="rtl">
                            <option value="0">انتخاب کنید</option>
                            <?php
                            $query = "SELECT add_abadi,abadi FROM `list_abadi` WHERE `mor_cod_m` = '$login_session' ORDER BY BINARY abadi";
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
                        <input name="id_city" type="hidden" value="<?php echo agri2_h($id_city); ?>"/>
                        <input name="id_city5" type="hidden" value="<?php echo agri2_h($id_city); ?>"/>
                        <input name="id_mar" type="hidden" value="<?php echo agri2_h($id_mar); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_city">نام شهر</label>
                        <select name="add_city" class="input_text" id="add_city" tabindex="7" dir="rtl">
                            <option value="0">انتخاب کنید</option>
                            <?php
                            $query = "SELECT add_city,shahr FROM `list_city` WHERE `id_mar` = '$id_mar' and `mor_cod_m`= '$login_session' ORDER BY BINARY shahr";
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
                            <option value="1" <?php if ($dis == '' || $dis == '1') echo 'selected="selected"'; ?>>همه رکوردها</option>
                            <option value="2" <?php if ($dis == '2') echo 'selected="selected"'; ?>>رکوردهای بدون تحویل</option>
                        </select>
                    </div>
                </div>
                <p class="agri1-hint">فقط قطعات دارای تولید قطعی نمایش داده می‌شود.</p>
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

            $v_cod_mah = "cod_mah IN (102, 103)";
            $v_mah_tol = "mah_tol > 0";

            if ($dis == '1') {
                $v_dis = "1=1";
            } else {
                $v_dis = "id NOT IN (SELECT Agri_id FROM delivery WHERE Agri_id IS NOT NULL)";
            }

            $start = 0;
            $limit = 10;
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
            if ($id < 1) $id = 1;
            $start = ($id - 1) * $limit;

            $query = "SELECT id,bah_cod_m,sh_gat,no_kesh,cod_mah,zer_kesht_a,zer_kesht_b,mah_tolp,s_bar_a,s_bar_b,mah_tol,add_abadi,mah_kh 
                      FROM $Agri_prod_table 
                      WHERE $v_id_ostan AND $v_id_city AND $v_id_mar AND $f_add_abadi AND $f_add_city 
                      AND $f_no_kesh AND $v_mor_cod_m AND $v_bah_cod_m AND $v_z_sal AND $v_cod_mah AND $v_mah_tol AND $v_dis 
                      ORDER BY bah_cod_m,sh_gat ASC LIMIT $start, $limit";

            $query1 = "SELECT COUNT(*) FROM $Agri_prod_table 
                       WHERE $v_id_ostan AND $v_id_city AND $v_id_mar AND $f_add_abadi AND $f_add_city 
                       AND $f_no_kesh AND $v_mor_cod_m AND $v_bah_cod_m AND $v_z_sal AND $v_cod_mah AND $v_mah_tol AND $v_dis";

            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $t_row = $stmt->rowCount();
            if ($t_row > 0) {
        ?>
        <section class="agri1-card agri1-card-results" aria-label="نتایج جستجو">
            <h2 class="agri1-card-title">نتایج</h2>
            <div class="agri1-export">
                <form action="delivery_export_excel.php" method="post">
                    <?php delivery_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $dis); ?>
                    <button type="submit" title="دانلود نتایج با فرمت فایل اکسل">
                        <img src="../../files/xls.png" width="44" height="45" alt="خروجی اکسل"/>
                    </button>
                </form>
            </div>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <colgroup>
                        <col style="width:9%"/>
                        <col style="width:10%"/>
                        <col style="width:9%"/>
                        <col style="width:8%"/>
                        <col style="width:8%"/>
                        <col style="width:10%"/>
                        <col style="width:6%"/>
                        <col style="width:7%"/>
                        <col style="width:11%"/>
                        <col style="width:16%"/>
                        <col style="width:6%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="agri1-ops-col" rowspan="2">عملیات</th>
                            <th rowspan="2">میزان تحویلی به دولت<br />تن</th>
                            <th rowspan="2">میزان تولید قطعی<br />تن</th>
                            <th colspan="2">سطح برداشت<br />هکتار</th>
                            <th rowspan="2">نام محصول</th>
                            <th rowspan="2">نوع کشت</th>
                            <th rowspan="2">شماره قطعه</th>
                            <th colspan="2">مشخصات بهره‌بردار</th>
                            <th rowspan="2">ردیف</th>
                        </tr>
                        <tr>
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

                        $check_delivery = "SELECT delivery_amount FROM delivery WHERE Agri_id = '" . $row['id'] . "'";
                        $stmt_check = $dbh->prepare($check_delivery);
                        $stmt_check->execute();
                        $delivery_row = $stmt_check->fetch(PDO::FETCH_ASSOC);
                        $delivery_amount = ($delivery_row) ? $delivery_row['delivery_amount'] : '';
                        $has_delivery = ($delivery_row) ? true : false;
                    ?>
                        <tr>
                            <td class="agri1-ops">
                                <form name="form<?php echo $t_r; ?>" id="form<?php echo $t_r; ?>">
                                    <input type="hidden" id="id<?php echo $t_r; ?>" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                    <input type="hidden" id="add_city<?php echo $t_r; ?>" name="add_city" value="<?php echo agri2_h($add_city); ?>"/>
                                    <input type="hidden" id="z_sal_h<?php echo $t_r; ?>" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
                                    <input type="hidden" id="bah_cod_m<?php echo $t_r; ?>" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                    <input type="hidden" id="add_abadi<?php echo $t_r; ?>" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                    <input type="hidden" id="sh_gat<?php echo $t_r; ?>" name="sh_gat" value="<?php echo agri2_h($row['sh_gat']); ?>"/>
                                    <input type="hidden" id="id_ostan_h<?php echo $t_r; ?>" name="id_ostan_h" value="<?php echo agri2_h($id_ostan1); ?>"/>
                                    <input type="hidden" id="id_city_h<?php echo $t_r; ?>" name="id_city_h" value="<?php echo agri2_h($id_city); ?>"/>
                                    <input type="hidden" id="id_mar_h<?php echo $t_r; ?>" name="id_mar_h" value="<?php echo agri2_h($id_mar); ?>"/>
                                    <input type="hidden" id="mor_cod_m_h<?php echo $t_r; ?>" name="mor_cod_m_h" value="<?php echo agri2_h($login_session); ?>"/>
                                    <input type="hidden" id="s_bar_a_h<?php echo $t_r; ?>" value="<?php echo agri2_h($row['s_bar_a']); ?>"/>
                                    <input type="hidden" id="s_bar_b_h<?php echo $t_r; ?>" value="<?php echo agri2_h($row['s_bar_b']); ?>"/>
                                    <input type="hidden" id="mah_tol_h<?php echo $t_r; ?>" value="<?php echo agri2_h($row['mah_tol']); ?>"/>
                                    <div class="agri1-save-wrap">
                                        <?php if ($has_delivery) { ?>
                                        <button type="button" class="agri1-btn agri1-btn-ghost" id="editBtn<?php echo $t_r; ?>" onclick="enableEdit(<?php echo $t_r; ?>)">ویرایش</button>
                                        <button type="button" class="agri1-btn agri1-btn-primary" id="updateBtn<?php echo $t_r; ?>" style="display:none;" onclick="updateDelivery(<?php echo $t_r; ?>)">بروزرسانی</button>
                                        <span class="agri1-save-msg agri1-save-ok" id="statusMsg<?php echo $t_r; ?>">ثبت شد</span>
                                        <span class="agri1-save-msg agri1-save-edit" id="editMsg<?php echo $t_r; ?>" style="display:none;">در حال ویرایش</span>
                                        <?php } else { ?>
                                        <button type="button" class="agri1-btn agri1-btn-primary submit<?php echo $t_r; ?>" id="submit<?php echo $t_r; ?>" tabindex="<?php echo $r . '5'; ?>" onclick="submitDelivery(<?php echo $t_r; ?>)">ثبت</button>
                                        <span class="error<?php echo $t_r; ?> agri1-save-msg agri1-save-err" style="display:none">ثبت نشد</span>
                                        <span class="success<?php echo $t_r; ?> agri1-save-msg agri1-save-ok" style="display:none">ثبت شد</span>
                                        <?php } ?>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <input name="delivery_amount" type="text" class="delivery<?php echo $t_r; ?> agri1-inline-input agri1-delivery-input" id="delivery<?php echo $t_r; ?>" dir="ltr" inputmode="decimal" tabindex="<?php echo $r . '4'; ?>" value="<?php echo agri2_h($delivery_amount); ?>" maxlength="12" <?php if ($has_delivery) echo 'readonly="readonly"'; ?>/>
                            </td>
                            <td><?php echo agri2_h($row['mah_tol'] * 1); ?></td>
                            <td><?php echo agri2_h($row['s_bar_b'] * 1); ?></td>
                            <td><?php echo agri2_h($row['s_bar_a'] * 1); ?></td>
                            <td>
                                <?php echo agri2_h(mah_name($row['cod_mah'])); ?>
                                <input name="cod_mah<?php echo $t_r; ?>" type="hidden" value="<?php echo agri2_h($row['cod_mah']); ?>"/>
                            </td>
                            <td>
                                <?php echo agri2_h($v_no_kesh); ?>
                                <input name="no_kesh<?php echo $t_r; ?>" type="hidden" value="<?php echo agri2_h($row['no_kesh']); ?>"/>
                            </td>
                            <td><?php echo agri2_h($row['sh_gat']); ?></td>
                            <td dir="ltr"><?php echo agri2_h($row['bah_cod_m']); ?></td>
                            <td class="agri1-name-col"><?php echo agri2_h(str_replace('&nbsp;', ' ', bah_name($row['bah_cod_m']))); ?></td>
                            <td><?php echo (int)$r; ?></td>
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
                    <form action="delivery.php?id=<?php echo (int)$id - 1; ?>#1" method="post">
                        <?php delivery_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $dis); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="delivery.php?id=1#1" method="post">
                        <?php delivery_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $dis); ?>
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
                    <form action="delivery.php?id=<?php echo (int)$i; ?>#1" method="post">
                        <?php delivery_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $dis); ?>
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
                    <form action="delivery.php?id=<?php echo (int)$total; ?>#1" method="post">
                        <?php delivery_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $dis); ?>
                        <button type="submit" class="agri1-pager-btn"><?php echo (int)$total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if (isset($id) && $id != $total && $total > 0) { ?>
                <li>
                    <form action="delivery.php?id=<?php echo (int)$id + 1; ?>#1" method="post">
                        <?php delivery_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $dis); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="delivery.php" method="post">
                    <?php delivery_filter_hiddens($id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, $no_kesh, $z_sal, $dis); ?>
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
                    this.action = 'delivery.php?id=' + pageId + '#1';
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

        function deliveryPayload(row) {
            return 'delivery_amount=' + document.getElementById('delivery' + row).value +
                '&id_agri=' + document.getElementById('id' + row).value +
                '&bah_cod_m=' + document.getElementById('bah_cod_m' + row).value +
                '&sh_gat=' + document.getElementById('sh_gat' + row).value +
                '&id_ostan=' + document.getElementById('id_ostan_h' + row).value +
                '&id_city=' + document.getElementById('id_city_h' + row).value +
                '&id_mar=' + document.getElementById('id_mar_h' + row).value +
                '&mor_cod_m=' + document.getElementById('mor_cod_m_h' + row).value +
                '&s_bar_a=' + document.getElementById('s_bar_a_h' + row).value +
                '&s_bar_b=' + document.getElementById('s_bar_b_h' + row).value +
                '&mah_tol=' + document.getElementById('mah_tol_h' + row).value +
                '&z_sal=' + document.getElementById('z_sal_h' + row).value;
        }

        function validateDelivery(row) {
            var delivery_amount = document.getElementById('delivery' + row).value;
            var mah_tol = document.getElementById('mah_tol_h' + row).value;
            if (delivery_amount.trim() === '' || isNaN(parseFloat(delivery_amount)) || parseFloat(delivery_amount) < 0) {
                alert('لطفاً میزان تحویلی معتبر وارد کنید');
                return false;
            }
            var mtol = parseFloat(mah_tol) || 0;
            var del = parseFloat(delivery_amount) || 0;
            if (del > mtol) {
                alert('میزان تحویلی از تولید قطعی بیشتر است!');
                return false;
            }
            return true;
        }

        function setDeliveryReadonly(row, locked) {
            var input = document.getElementById('delivery' + row);
            if (!input) return;
            if (locked) {
                input.setAttribute('readonly', 'readonly');
            } else {
                input.removeAttribute('readonly');
                input.focus();
            }
        }

        function enableEdit(row) {
            var editBtn = document.getElementById('editBtn' + row);
            var updateBtn = document.getElementById('updateBtn' + row);
            var statusMsg = document.getElementById('statusMsg' + row);
            var editMsg = document.getElementById('editMsg' + row);
            setDeliveryReadonly(row, false);
            if (editBtn) editBtn.style.display = 'none';
            if (updateBtn) updateBtn.style.display = 'inline-flex';
            if (statusMsg) statusMsg.style.display = 'none';
            if (editMsg) editMsg.style.display = 'inline-block';
        }

        function updateDelivery(row) {
            if (!validateDelivery(row)) return false;
            $.ajax({
                type: 'POST',
                url: 'post_delivery',
                data: deliveryPayload(row),
                success: function (response) {
                    var editBtn = document.getElementById('editBtn' + row);
                    var updateBtn = document.getElementById('updateBtn' + row);
                    var statusMsg = document.getElementById('statusMsg' + row);
                    var editMsg = document.getElementById('editMsg' + row);
                    if (response == 'success') {
                        setDeliveryReadonly(row, true);
                        if (editBtn) editBtn.style.display = 'inline-flex';
                        if (updateBtn) updateBtn.style.display = 'none';
                        if (statusMsg) {
                            statusMsg.style.display = 'inline-block';
                            statusMsg.className = 'agri1-save-msg agri1-save-ok';
                            statusMsg.innerHTML = 'ثبت شد';
                        }
                        if (editMsg) editMsg.style.display = 'none';
                    } else if (statusMsg) {
                        statusMsg.style.display = 'inline-block';
                        statusMsg.className = 'agri1-save-msg agri1-save-err';
                        statusMsg.innerHTML = 'ثبت نشد';
                    }
                },
                error: function () {
                    var statusMsg = document.getElementById('statusMsg' + row);
                    if (statusMsg) {
                        statusMsg.style.display = 'inline-block';
                        statusMsg.className = 'agri1-save-msg agri1-save-err';
                        statusMsg.innerHTML = 'ثبت نشد';
                    }
                }
            });
        }

        function ensureEditControls(row) {
            var form = document.getElementById('form' + row);
            if (!form) return;
            var wrap = form.querySelector('.agri1-save-wrap') || form;
            if (!document.getElementById('editBtn' + row)) {
                var editBtn = document.createElement('button');
                editBtn.type = 'button';
                editBtn.className = 'agri1-btn agri1-btn-ghost';
                editBtn.id = 'editBtn' + row;
                editBtn.innerHTML = 'ویرایش';
                editBtn.onclick = function () { enableEdit(row); };
                wrap.appendChild(editBtn);
            }
            if (!document.getElementById('updateBtn' + row)) {
                var updateBtn = document.createElement('button');
                updateBtn.type = 'button';
                updateBtn.className = 'agri1-btn agri1-btn-primary';
                updateBtn.id = 'updateBtn' + row;
                updateBtn.innerHTML = 'بروزرسانی';
                updateBtn.style.display = 'none';
                updateBtn.onclick = function () { updateDelivery(row); };
                wrap.appendChild(updateBtn);
            }
            if (!document.getElementById('statusMsg' + row)) {
                var statusMsg = document.createElement('span');
                statusMsg.className = 'agri1-save-msg agri1-save-ok';
                statusMsg.id = 'statusMsg' + row;
                statusMsg.innerHTML = 'ثبت شد';
                wrap.appendChild(statusMsg);
            }
            if (!document.getElementById('editMsg' + row)) {
                var editMsg = document.createElement('span');
                editMsg.className = 'agri1-save-msg agri1-save-edit';
                editMsg.id = 'editMsg' + row;
                editMsg.innerHTML = 'در حال ویرایش';
                editMsg.style.display = 'none';
                wrap.appendChild(editMsg);
            }
        }

        function submitDelivery(row) {
            if (!validateDelivery(row)) {
                $('.error' + row).fadeOut(200).show();
                return false;
            }
            var submitBtn = document.getElementById('submit' + row);
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'ثبت';
            }
            $.ajax({
                type: 'POST',
                url: 'post_delivery',
                data: deliveryPayload(row),
                success: function (response) {
                    if (response == 'success') {
                        $('.success' + row).fadeIn(200).show();
                        $('.error' + row).fadeOut(200).hide();
                        setDeliveryReadonly(row, true);
                        if (submitBtn) submitBtn.style.display = 'none';
                        $('.success' + row).hide();
                        ensureEditControls(row);
                    } else {
                        $('.success' + row).fadeOut(200).hide();
                        $('.error' + row).fadeOut(200).show();
                        if (submitBtn) submitBtn.disabled = false;
                    }
                },
                error: function () {
                    $('.error' + row).fadeOut(200).show();
                    if (submitBtn) submitBtn.disabled = false;
                }
            });
            return false;
        }
    </script>
<?php
$no = isset($t_row) ? $t_row : 0;
while ($no > 0) {
?>
<script>
$('.delivery<?php echo $no; ?>').on('keyup change', function () {
    var mtol = parseFloat(document.getElementById('mah_tol_h<?php echo $no; ?>').value) || 0;
    var del = parseFloat(this.value) || 0;
    var submitBtn = document.getElementById('submit<?php echo $no; ?>');
    if (this.value.trim() === '' || isNaN(del)) {
        if (submitBtn) submitBtn.disabled = true;
        return;
    }
    if (del < 0) {
        alert('میزان تحویلی نمی‌تواند منفی باشد!');
        $(this).val('');
        $(this).focus();
        if (submitBtn) submitBtn.disabled = true;
        return;
    }
    if (del > mtol) {
        alert('میزان تحویلی به دولت (' + del + ' تن) از میزان تولید قطعی (' + mtol + ' تن) بیشتر است!');
        $(this).val('');
        $(this).focus();
        if (submitBtn) submitBtn.disabled = true;
        return;
    }
    if (submitBtn) submitBtn.disabled = false;
});
$(document).ready(function () {
    var initialVal = $('#delivery<?php echo $no; ?>').val();
    var submitBtn = document.getElementById('submit<?php echo $no; ?>');
    if (!submitBtn) return;
    if (initialVal && initialVal.trim() !== '' && !isNaN(parseFloat(initialVal)) && parseFloat(initialVal) >= 0) {
        var mtol = parseFloat(document.getElementById('mah_tol_h<?php echo $no; ?>').value) || 0;
        if (parseFloat(initialVal) <= mtol) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    } else {
        submitBtn.disabled = true;
    }
});
</script>
<?php
    $no--;
}
?>
</body>
</html>
