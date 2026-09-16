<?php
include('../../lock_p1.php');
include('../../event.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri_noon_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $bah_cod_m, $m_cod_m, $z_sal)
{
    $pairs = array(
        'action_lise' => '1',
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'no_mal' => $no_mal,
        'no_kesh' => $no_kesh,
        'bah_cod_m' => $bah_cod_m,
        'm_cod_m' => $m_cod_m,
        'z_sal' => $z_sal
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

$add_abadi = $add_city = $no_kesh = $no_mal = $bah_cod_m = $m_cod_m = $z_sal = '';
if (isset($_POST['back_p'])) {
    $bah_cod_m = isset($_SESSION['page_date']['p_bah_cod_m']) ? $_SESSION['page_date']['p_bah_cod_m'] : '';
    $m_cod_m   = isset($_SESSION['page_date']['p_m_cod_m']) ? $_SESSION['page_date']['p_m_cod_m'] : '';
    $add_abadi = isset($_SESSION['page_date']['p_add_abadi']) ? $_SESSION['page_date']['p_add_abadi'] : '';
    $add_city  = isset($_SESSION['page_date']['p_add_city']) ? $_SESSION['page_date']['p_add_city'] : '';
    $no_kesh   = isset($_SESSION['page_date']['p_no_kesh']) ? $_SESSION['page_date']['p_no_kesh'] : '';
    $no_mal    = isset($_SESSION['page_date']['p_no_mal']) ? $_SESSION['page_date']['p_no_mal'] : '';
    $z_sal     = isset($_SESSION['page_date']['p_z_sal']) ? $_SESSION['page_date']['p_z_sal'] : '';
} else {
    unset($_SESSION['page_date']);
    $add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
    $add_city  = isset($_POST['add_city']) ? $_POST['add_city'] : '';
    $no_kesh   = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
    $no_mal    = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
    $bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
    $m_cod_m   = isset($_POST['m_cod_m']) ? $_POST['m_cod_m'] : '';
    $z_sal     = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
    include_once('../session_start.php');
    $_SESSION['page_date'] = array(
        'p_add_abadi' => $add_abadi,
        'p_add_city' => $add_city,
        'p_bah_cod_m' => $bah_cod_m,
        'p_m_cod_m' => $m_cod_m,
        'p_no_kesh' => $no_kesh,
        'p_no_mal' => $no_mal,
        'p_z_sal' => $z_sal
    );
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
        .agri1-page .agri1-form #bah_cod_m,
        .agri1-page .agri1-form #m_cod_m {
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
        .agri1-xls { display: flex; justify-content: center; margin: 0 0 12px; }
        .agri1-xls button {
            min-width: var(--touch);
            min-height: var(--touch);
            background: transparent;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
        }
        .agri1-xls button:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
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
            width: 148px;
            padding: 3px 2px;
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
        .agri1-ops-bar button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            min-height: 32px;
            background: transparent;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
            padding: 4px;
            line-height: 0;
        }
        .agri1-ops-bar button img {
            width: 30px;
            height: 23px;
            display: block;
        }
        .agri1-ops-bar button:focus-visible {
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
    <script>
        function target_Agri17(form) {
            window.open("null", "formpopup", "location=1,status=1,scrollbars=1,width=750,height=600");
            form.target = "formpopup";
        }
        function target_Agri18(form) {
            window.open("null", "formpopup", "location=1,status=1,scrollbars=1,width=1200px,height=800px");
            form.target = "formpopup";
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
            <h1 class="agri1-title" id="liste-noon-title">لیست قطعات زراعی فاقد ویرایش بعد از انتقال</h1>
        </header>

        <section class="agri1-card agri1-card-search" aria-labelledby="liste-noon-title">
            <form id="reg-form" class="agri1-form" method="post" action="#1" novalidate>
                <h2 class="agri1-card-title">جستجو</h2>
                <div class="agri1-grid">
                    <div class="agri1-field">
                        <label class="agri1-label" for="z_sal">سال زراعی</label>
                        <select name="z_sal" class="input_text required" id="z_sal">
                            <option value="1405-1406" <?php if (isset($z_sal) && $z_sal == '1405-1406') echo 'selected="selected"'; ?>>1405-1406</option>
                            <option value="1404-1405" <?php if (isset($z_sal) && $z_sal == '1404-1405') echo 'selected="selected"'; ?>>1404-1405</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_city">نام شهر</label>
                        <select name="add_city" class="input_text" id="add_city" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            <?php
                            $query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = '$login_session'";
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
                        <label class="agri1-label" for="bah_cod_m">کد ملی بهره‌بردار</label>
                        <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m" dir="ltr" inputmode="numeric" value="<?php if (isset($z_sal)) echo agri2_h($bah_cod_m); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_abadi">نام آبادی</label>
                        <select name="add_abadi" class="input_text" id="add_abadi" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            <?php
                            $query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session'";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                            <option value="<?php echo agri2_h($row['add_abadi']); ?>"
                                <?php if (isset($row['add_abadi'], $add_abadi) && $row['add_abadi'] == $add_abadi) echo 'selected="selected"'; ?>> <?php echo agri2_h($row['abadi']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="m_cod_m">کد ملی مالک</label>
                        <input name="m_cod_m" type="text" class="input_text" id="m_cod_m" dir="ltr" inputmode="numeric" value="<?php if (isset($z_sal)) echo agri2_h($m_cod_m); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="no_mal">نوع مالکیت</label>
                        <select name="no_mal" class="input_text required" id="no_mal" tabindex="4">
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
                        <label class="agri1-label" for="no_kesh">نوع کشت</label>
                        <select name="no_kesh" class="input_text required" id="no_kesh" tabindex="6">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if (isset($no_kesh) && $no_kesh == "1") echo 'selected="selected"'; ?>>آبی</option>
                            <option value="2" <?php if (isset($no_kesh) && $no_kesh == "2") echo 'selected="selected"'; ?>>دیم</option>
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
if (isset($_POST['action_lise'])) {
    $Agri_table = 'Agri' . str_replace('-', '_', $z_sal);

    if ($z_sal == '1404-1405' or $z_sal == '1405-1406') $Agri_edit_available = '1'; else $Agri_edit_available = '0';
    if ($add_abadi == '') { $v_add_abadi = 1; } else { $v_add_abadi = "`agri`.add_abadi = '$add_abadi'"; }
    if ($add_city  == '') { $v_add_city  = 1; } else { $v_add_city  = "`agri`.add_city  = '$add_city'"; }
    if ($no_mal    == '') { $f_no_mal    = 1; } else { $f_no_mal    = "`agri`.no_mal    = '$no_mal'"; }
    if ($no_kesh   == '') { $f_no_kesh   = 1; } else { $f_no_kesh   = "`agri`.no_kesh   = '$no_kesh'"; }
    if ($bah_cod_m == '') { $v_bah_cod_m = 1; } else { $v_bah_cod_m = "`agri`.bah_cod_m = '$bah_cod_m'"; }
    if ($m_cod_m   == '') { $v_m_cod_m   = 1; } else { $v_m_cod_m   = "`agri`.m_cod_m = '$m_cod_m'"; }

    $start = 0;
    $limit = 10;
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
    if ($id < 1) $id = 1;
    $start = ($id - 1) * $limit;
    $query = " SELECT 
    agri.docId,
    agri.s_ayesh,
    agri.num_bah,
    agri.id,
    agri.mor_cod_m,
    agri.no_mal,
    agri.bah_cod_m,
    agri.m_cod_m,
    agri.add_abadi,
    agri.add_city,
    agri.sh_gat,
    agri.no_kesh,
    agri.m_zamin,
    agri.id_ostan,
    agri.id_city,
    agri.t_mah,
    bah.name,
    bah.last_name,
    bah.no_bah,
    list_abadi.abadi,
    list_city.city
FROM 
    `$Agri_table` AS agri
INNER JOIN 
    bah 
    ON agri.bah_cod_m = bah.bah_cod_m AND agri.num_bah = bah.num_bah
LEFT JOIN 
    list_abadi 
    ON agri.add_abadi = list_abadi.add_abadi
LEFT JOIN 
    list_city 
    ON agri.add_city = list_city.add_city
WHERE 
    agri.mor_cod_m = '$login_session' 
    AND $v_add_abadi 
    AND $v_add_city 
    AND $f_no_kesh 
    AND $f_no_mal 
    AND $v_bah_cod_m 
    AND $v_m_cod_m 
    AND agri.date_s NOT LIKE '%/%'
ORDER BY 
    agri.bah_cod_m, agri.sh_gat ASC
LIMIT 
    $start, $limit;
  ";
    $query1 = "SELECT count(*) from `$Agri_table` AS agri  where  mor_cod_m = '$login_session' and $v_add_abadi and $v_add_city and $f_no_kesh and $f_no_mal and $v_bah_cod_m and $v_m_cod_m and  date_s not like '%/%'   ";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $found = $stmt->fetchAll();
    $t_row = count($found);
?>
        <a name="1" id="1"></a>
<?php if ($t_row > 0) { ?>
        <section class="agri1-card agri1-card-results" aria-label="نتایج جستجو">
            <form action="list_noon_edit_xls.php" method="post" class="agri1-xls">
                <?php agri_noon_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $bah_cod_m, $m_cod_m, $z_sal); ?>
                <button type="submit"><img src="../../files/xls.png" title="دانلود فایل اکسل" width="33" height="45" alt="دانلود فایل اکسل"/></button>
            </form>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <colgroup>
                        <col style="width:12%"/>
                        <col style="width:6%"/>
                        <col style="width:7%"/>
                        <col style="width:6%"/>
                        <col style="width:9%"/>
                        <col style="width:8%"/>
                        <col style="width:6%"/>
                        <col style="width:8%"/>
                        <col style="width:9%"/>
                        <col style="width:12%"/>
                        <col style="width:12%"/>
                        <col style="width:5%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="agri1-ops-col" rowspan="2">عملیات</th>
                            <th rowspan="2">سطح آیش</th>
                            <th rowspan="2">مساحت زمین<br/>هکتار</th>
                            <th rowspan="2">نوع کشت</th>
                            <th rowspan="2">کد ملی مالک</th>
                            <th rowspan="2">نوع مالکیت</th>
                            <th rowspan="2">شماره قطعه</th>
                            <th colspan="3">مشخصات بهره بردار</th>
                            <th rowspan="2">آبادی/شهر</th>
                            <th rowspan="2">ردیف</th>
                        </tr>
                        <tr>
                            <th>همراه</th>
                            <th>کد ملی</th>
                            <th>نام و نام خانوادگی</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
    $r = $start + 1;
    foreach ($found as $row) {
        $v_no_mal = '';
        if ($row['no_mal'] == '1') $v_no_mal = 'سند ششدانگ';
        if ($row['no_mal'] == '2') $v_no_mal = 'سند مشاعی';
        if ($row['no_mal'] == '3') $v_no_mal = 'اصلاحات اراضی';
        if ($row['no_mal'] == '4') $v_no_mal = 'موقوفه';
        if ($row['no_mal'] == '5') $v_no_mal = 'واگذاری';
        if ($row['no_mal'] == '6') $v_no_mal = 'قولنامه';
        if ($row['no_mal'] == '7') $v_no_mal = 'اجاره';
        if ($row['no_mal'] == '8') $v_no_mal = 'سایر';
        $v_no_kesh = '';
        if ($row['no_kesh'] == '1') $v_no_kesh = 'آبی';
        if ($row['no_kesh'] == '2') $v_no_kesh = 'دیم';
        $bah_full = str_replace('&nbsp;', ' ', $row['last_name'] . ' ' . $row['name']);
?>
                        <tr>
                            <td class="agri1-ops">
                                <div class="agri1-ops-bar">
                                    <?php if ($Agri_edit_available == '1' and $row['docId'] == '') { ?>
                                    <form action="del_list_Agri.php" method="post">
                                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                        <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                        <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>"/>
                                        <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                        <input type="hidden" name="sh_gat" value="<?php echo agri2_h($row['sh_gat']); ?>"/>
                                        <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
                                        <input type="hidden" name="id_page" value="<?php echo agri2_h($id); ?>"/>
                                        <button type="submit" onclick="return confirm('از حذف اطلاعات زراعی مطمئن هستید ؟ ')" aria-label="حذف اطلاعات زراعی">
                                            <img src="../../files/del.png" title="حذف اطلاعات زراعی" width="30" height="23" alt=""/>
                                        </button>
                                    </form>
                                    <?php } ?>
                                    <?php if ($Agri_edit_available == '1') { ?>
                                    <form action="P_edit1.php" method="post" onsubmit="target_Agri18(this)">
                                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                        <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                        <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
                                        <button type="submit" aria-label="ویرایش اطلاعات محصول">
                                            <img src="../../files/Pro.png" title="ویرایش اطلاعات محصول" width="30" height="23" alt=""/>
                                        </button>
                                    </form>
                                    <form action="Agri_edit.php" method="post">
                                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                        <input type="hidden" name="sh_gat" value="<?php echo agri2_h($row['sh_gat']); ?>"/>
                                        <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
                                        <input type="hidden" name="m_poul" value="<?php if (isset($row['m_poul'])) echo agri2_h($row['m_poul']); ?>"/>
                                        <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                        <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>"/>
                                        <input type="hidden" name="no_kesh" value="<?php echo agri2_h($row['no_kesh']); ?>"/>
                                        <input type="hidden" name="no_mal" value="<?php echo agri2_h($row['no_mal']); ?>"/>
                                        <input type="hidden" name="t_mah" value="<?php echo agri2_h($row['t_mah']); ?>"/>
                                        <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                        <input type="hidden" name="id_page" value="<?php echo agri2_h($id); ?>"/>
                                        <button type="submit" aria-label="ویرایش اطلاعات زمین">
                                            <img src="../../files/Ear.png" title="ویرایش اطلاعات زمین" width="30" height="23" alt=""/>
                                        </button>
                                    </form>
                                    <?php } ?>
                                    <form action="Agridata_view1.php" method="post" onsubmit="target_Agri17(this)">
                                        <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                        <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
                                        <button type="submit" aria-label="نمایش اطلاعات بهره برداری">
                                            <img src="../../files/view.png" title="نمایش اطلاعات بهره برداری" width="30" height="23" alt=""/>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td><?php echo agri2_h($row['s_ayesh'] * 1); ?></td>
                            <td><?php echo agri2_h($row['m_zamin'] * 1); ?></td>
                            <td><?php echo agri2_h($v_no_kesh); ?></td>
                            <td dir="ltr"><?php echo agri2_h($row['m_cod_m']); ?></td>
                            <td><?php echo agri2_h($v_no_mal); ?></td>
                            <td><?php echo agri2_h($row['sh_gat']); ?></td>
                            <td dir="ltr"><?php echo agri2_h(bah_tel_m($row['bah_cod_m'])); ?></td>
                            <td dir="ltr"><?php echo agri2_h($row['bah_cod_m']); ?></td>
                            <td class="agri1-name-col"><?php echo agri2_h($bah_full); ?></td>
                            <td class="agri1-name-col"><?php echo agri2_h(abadi_name($row['add_abadi'])) . agri2_h(shahr_name($row['add_city'])); ?></td>
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
}

if (isset($query1)) {
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute();
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
                    <form action="liste_noon_edit.php?id=<?php echo (int)$id - 1; ?>#1" method="post">
                        <?php agri_noon_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $bah_cod_m, $m_cod_m, $z_sal); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="liste_noon_edit.php?id=1#1" method="post">
                        <?php agri_noon_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $bah_cod_m, $m_cod_m, $z_sal); ?>
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
                    <form action="liste_noon_edit.php?id=<?php echo (int)$i; ?>#1" method="post">
                        <?php agri_noon_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $bah_cod_m, $m_cod_m, $z_sal); ?>
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
                    <form action="liste_noon_edit.php?id=<?php echo (int)$total; ?>#1" method="post">
                        <?php agri_noon_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $bah_cod_m, $m_cod_m, $z_sal); ?>
                        <button type="submit" class="agri1-pager-btn"><?php echo (int)$total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if (isset($id) && $id != $total && $total > 0) { ?>
                <li>
                    <form action="liste_noon_edit.php?id=<?php echo (int)$id + 1; ?>#1" method="post">
                        <?php agri_noon_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $bah_cod_m, $m_cod_m, $z_sal); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="liste_noon_edit.php" method="post">
                    <?php agri_noon_filter_hiddens($add_abadi, $add_city, $no_mal, $no_kesh, $bah_cod_m, $m_cod_m, $z_sal); ?>
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
                    this.action = 'liste_noon_edit.php?id=' + pageId + '#1';
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
            var submitBtn = document.getElementById('action_lise');
            if (!form) return;
            form.addEventListener('submit', function () {
                if (overlay) overlay.className = 'agri1-overlay is-open';
                if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
            });
        })();
    </script>
<?php if (isset($_POST['com_alert'])) alert($_POST['com_alert']); ?>
</body>
</html>
