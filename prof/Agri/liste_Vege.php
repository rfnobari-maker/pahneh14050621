<?php
include('../../lock_p1.php');
include('../../event.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function vege_list_filter_hiddens($add_abadi, $add_city, $z_sal, $bah_cod_m, $b_time, $m_ab, $confi)
{
    $pairs = array(
        'action_lise' => '1',
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'z_sal' => $z_sal,
        'bah_cod_m' => $bah_cod_m,
        'b_time' => $b_time,
        'm_ab' => $m_ab,
        'confi' => $confi
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$b_time = isset($_POST['b_time']) ? $_POST['b_time'] : '';
$m_ab = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
$confi = isset($_POST['confi']) ? $_POST['confi'] : '';
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
        .agri1-card-search .agri1-card-title { margin-bottom: 14px; padding-bottom: 8px; }
        .agri1-card-search .agri1-grid { gap: 16px 20px; }
        .agri1-card-search .agri1-label { margin-bottom: 6px; font-size: 0.875rem; }
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
            width: 52px;
            padding: 3px 2px;
            white-space: nowrap;
        }
        .agri1-table .agri1-ops form { display: inline; margin: 0; }
        .agri1-table .agri1-ops button { border: 0; background: transparent; padding: 0; cursor: pointer; }
        .agri1-table .agri1-ops img { display: block; margin: 0 auto; }
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
        .agri1-export { display: flex; justify-content: center; margin: 0 0 12px; }
        .agri1-export form { margin: 0; }
        .agri1-export button { border: 0; background: transparent; padding: 0; cursor: pointer; }
        .agri1-export button:focus-visible { outline: 3px solid var(--color-ring); outline-offset: 2px; }
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
        function target_po2(form) {
            window.open('null', 'formpopup', 'width=500,height=130,resizeable,scrollbars');
            form.target = 'formpopup';
        }
        function target_po3(form) {
            window.open('null', 'formpopup', 'width=950,height=1400,resizeable,scrollbars');
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
            <h1 class="agri1-title" id="liste-vege-title">لیست بهره‌برداری‌های صیفی</h1>
        </header>

        <section class="agri1-card agri1-card-search" aria-labelledby="liste-vege-title">
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
                        <label class="agri1-label" for="add_city">نام شهر</label>
                        <select name="add_city" class="input_text" id="add_city" dir="rtl">
                            <option value="0">انتخاب کنید</option>
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
                        <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="add_abadi">نام آبادی</label>
                        <select name="add_abadi" class="input_text" id="add_abadi" dir="rtl">
                            <option value="0">انتخاب کنید</option>
                            <?php
                            $query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session'";
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
                        <label class="agri1-label" for="m_ab">منبع آب</label>
                        <select name="m_ab" class="input_text required" id="m_ab">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($m_ab == '1') echo 'selected="selected"'; ?>>چشمه</option>
                            <option value="2" <?php if ($m_ab == '2') echo 'selected="selected"'; ?>>قنات</option>
                            <option value="3" <?php if ($m_ab == '3') echo 'selected="selected"'; ?>>رودخانه</option>
                            <option value="4" <?php if ($m_ab == '4') echo 'selected="selected"'; ?>>سد</option>
                            <option value="5" <?php if ($m_ab == '5') echo 'selected="selected"'; ?>>چاه سطحی</option>
                            <option value="6" <?php if ($m_ab == '6') echo 'selected="selected"'; ?>>چاه عمیق</option>
                            <option value="7" <?php if ($m_ab == '7') echo 'selected="selected"'; ?>>چاه نیمه عمیق</option>
                            <option value="8" <?php if ($m_ab == '8') echo 'selected="selected"'; ?>>زهکش</option>
                            <option value="9" <?php if ($m_ab == '9') echo 'selected="selected"'; ?>>پساب</option>
                            <option value="10" <?php if ($m_ab == '10') echo 'selected="selected"'; ?>>آب بندان</option>
                            <option value="11" <?php if ($m_ab == '11') echo 'selected="selected"'; ?>>سایر</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="b_time">فصل تولید</label>
                        <select name="b_time" class="input_text required" id="b_time">
                            <option value="">انتخاب کنید</option>
                            <option value="1" <?php if ($b_time == '1') echo 'selected="selected"'; ?>>زمستانه/استمرار</option>
                            <option value="2" <?php if ($b_time == '2') echo 'selected="selected"'; ?>>بهاره</option>
                            <option value="3" <?php if ($b_time == '3') echo 'selected="selected"'; ?>>تابستانه</option>
                            <option value="4" <?php if ($b_time == '4') echo 'selected="selected"'; ?>>پاییزه</option>
                        </select>
                    </div>
                    <div class="agri1-field" aria-hidden="true"></div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="confi">وضعیت رکورد</label>
                        <select name="confi" class="input_text required" id="confi">
                            <option value="" <?php if ($confi == '') echo 'selected="selected"'; ?>>همه موارد</option>
                            <option value="1" <?php if ($confi == '1') echo 'selected="selected"'; ?>>در حال بررسی</option>
                            <option value="2" <?php if ($confi == '2') echo 'selected="selected"'; ?>>تایید شده</option>
                            <option value="3" <?php if ($confi == '3') echo 'selected="selected"'; ?>>عدم تایید</option>
                        </select>
                    </div>
                </div>
                <div class="agri1-actions">
                    <button type="submit" name="action_lise" id="action_lise" value="جستجو" class="agri1-btn agri1-btn-primary">جستجو</button>
                </div>
                <p class="agri1-hint">برای مشاهده همه بهره‌برداری‌ها جستجو را بدون فیلتر بزنید.</p>
            </form>
        </section>

        <a name="1" id="1"></a>
<?php
$limit = 10;
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$query1 = '';
$total = 0;

if (isset($_POST['action_lise'])) {
    if ($z_sal == '1405-1406' or $z_sal == '1404-1405') $Agri_edit_available = '1'; else $Agri_edit_available = '0';
    if ($add_abadi == '0') { $v_add_abadi = 1; } else { $v_add_abadi = "add_abadi = '$add_abadi'"; }
    if ($add_city == '0') { $v_add_city = 1; } else { $v_add_city = "add_city = '$add_city'"; }
    if ($b_time == '') { $f_b_time = 1; } else { $f_b_time = "b_time = '$b_time'"; }
    if ($m_ab == '') { $f_m_ab = 1; } else { $f_m_ab = "m_ab = '$m_ab'"; }
    if ($bah_cod_m == '') { $v_bah_cod_m = 1; } else { $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'"; }
    if ($z_sal == '') { $v_z_sal = 1; } else { $v_z_sal = "z_sal = '$z_sal'"; }
    if ($confi == '') { $v_confi = 1; } else { $v_confi = "confi = '$confi'"; }
    $start = ($id - 1) * $limit;
    $query = "SELECT id,id_ostan,id_city,add_abadi,add_city,no_bah,b_time,m_ab,m_zamin,bah_cod_m,z_sal,sh_gat,confi,confi2 from Vege where  mor_cod_m = '$login_session' and $v_add_abadi and $v_add_city and $f_b_time and $f_m_ab and $v_bah_cod_m and $v_z_sal and $v_confi ORDER BY mor_cod_m ASC LIMIT $start, $limit  ";
    $query1 = "SELECT count(*) from Vege where  mor_cod_m = '$login_session' and $v_add_abadi and $v_add_city and $f_b_time and $f_m_ab and $v_bah_cod_m and $v_z_sal and $v_confi  ";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $found = $stmt->fetchAll();
    if (count($found) > 0) {
?>
        <section class="agri1-card agri1-card-results" aria-label="نتایج جستجو">
            <div class="agri1-export">
                <form action="list_Vege_xls.php" method="post">
                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
                    <input type="hidden" name="add_city" value="<?php echo agri2_h($add_city); ?>"/>
                    <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
                    <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    <input type="hidden" name="b_time" value="<?php echo agri2_h($b_time); ?>"/>
                    <input type="hidden" name="m_ab" value="<?php echo agri2_h($m_ab); ?>"/>
                    <input type="hidden" name="confi" value="<?php echo agri2_h($confi); ?>"/>
                    <button type="submit" title="دانلود فایل اکسل">
                        <img src="../../files/xls.png" width="58" height="62" alt="خروجی اکسل"/>
                    </button>
                </form>
            </div>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <colgroup>
                        <col style="width:5%"/>
                        <col style="width:5%"/>
                        <col style="width:5%"/>
                        <col style="width:5%"/>
                        <col style="width:5%"/>
                        <col style="width:7%"/>
                        <col style="width:7%"/>
                        <col style="width:8%"/>
                        <col style="width:5%"/>
                        <col style="width:7%"/>
                        <col style="width:8%"/>
                        <col style="width:12%"/>
                        <col style="width:9%"/>
                        <col style="width:8%"/>
                        <col style="width:4%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="agri1-ops-col" colspan="3" rowspan="2">عملیات</th>
                            <th colspan="2">وضعیت تایید</th>
                            <th rowspan="2">مساحت زمین<br/>هکتار</th>
                            <th rowspan="2">منبع آب</th>
                            <th rowspan="2">فصل تولید</th>
                            <th rowspan="2">شماره قطعه</th>
                            <th rowspan="2">سال زراعی</th>
                            <th colspan="2">مشخصات بهره بردار</th>
                            <th colspan="2">موقعیت بهره برداری</th>
                            <th rowspan="2">ردیف</th>
                        </tr>
                        <tr>
                            <th>تکمیلی</th>
                            <th>اولیه</th>
                            <th>کد ملی</th>
                            <th>نام و نام خانوادگی</th>
                            <th>شهر/آبادی</th>
                            <th>شهرستان</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
        $r = $start + 1;
        foreach ($found as $row) {
            $v_b_time = '';
            $v_m_ab = '';
            if ($row['b_time'] == '1') $v_b_time = 'زمستانه/استمرار';
            if ($row['b_time'] == '2') $v_b_time = 'بهاره';
            if ($row['b_time'] == '3') $v_b_time = 'تابستانه';
            if ($row['b_time'] == '4') $v_b_time = 'پاییزه';
            if ($row['m_ab'] == '1') $v_m_ab = 'چشمه';
            if ($row['m_ab'] == '2') $v_m_ab = 'قنات';
            if ($row['m_ab'] == '3') $v_m_ab = 'رودخانه';
            if ($row['m_ab'] == '4') $v_m_ab = 'سد';
            if ($row['m_ab'] == '5') $v_m_ab = 'چاه سطحی';
            if ($row['m_ab'] == '6') $v_m_ab = 'چاه عمیق';
            if ($row['m_ab'] == '7') $v_m_ab = 'چاه نیمه عمیق';
            if ($row['m_ab'] == '8') $v_m_ab = 'زهکش';
            if ($row['m_ab'] == '9') $v_m_ab = 'پساب';
            if ($row['m_ab'] == '10') $v_m_ab = 'آب بندان';
            if ($row['m_ab'] == '11') $v_m_ab = 'سایر';
?>
                        <tr>
                            <td class="agri1-ops">
                                <?php if ($Agri_edit_available == '1' and $row['confi'] != '2') { ?>
                                <form action="del_list_Vege.php" method="post">
                                    <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                    <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>"/>
                                    <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                    <input type="hidden" name="sh_gat" value="<?php echo agri2_h($row['sh_gat']); ?>"/>
                                    <input type="hidden" name="z_sal" value="<?php echo agri2_h($row['z_sal']); ?>"/>
                                    <input type="hidden" name="id_page" value="<?php echo (int)$id; ?>"/>
                                    <button type="submit" onclick="return confirm('از حذف اطلاعات این رکورد مطمئن هستید ؟ ')" aria-label="حذف اطلاعات">
                                        <img src="../../files/del1.png" title="حذف اطلاعات " width="33" height="26" alt=""/>
                                    </button>
                                </form>
                                <?php } ?>
                            </td>
                            <td class="agri1-ops">
                                <?php if ($Agri_edit_available == '1' and $row['confi'] != '2') { ?>
                                <form action="Vege_edit.php" method="post">
                                    <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                    <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>"/>
                                    <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                    <input type="hidden" name="b_time" value="<?php echo agri2_h($row['b_time']); ?>"/>
                                    <input type="hidden" name="mah1" value="<?php echo isset($row['mah1']) ? agri2_h($row['mah1']) : ''; ?>"/>
                                    <input type="hidden" name="mah2" value="<?php echo isset($row['mah2']) ? agri2_h($row['mah2']) : ''; ?>"/>
                                    <input type="hidden" name="mah3" value="<?php echo isset($row['mah3']) ? agri2_h($row['mah3']) : ''; ?>"/>
                                    <input type="hidden" name="t_kind" value="<?php echo isset($row['t_kind']) ? agri2_h($row['t_kind']) : ''; ?>"/>
                                    <input type="hidden" name="m_ab" value="<?php echo agri2_h($row['m_ab']); ?>"/>
                                    <input type="hidden" name="z_sal" value="<?php echo agri2_h($row['z_sal']); ?>"/>
                                    <input type="hidden" name="sh_gat" value="<?php echo agri2_h($row['sh_gat']); ?>"/>
                                    <button type="submit" aria-label="ویرایش اطلاعات">
                                        <img src="../../files/edit.png" title="ویرایش اطلاعات " width="33" height="26" alt=""/>
                                    </button>
                                </form>
                                <?php } ?>
                            </td>
                            <td class="agri1-ops">
                                <form action="Vegedata_T_view.php" method="post" onsubmit="target_po3(this)">
                                    <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                    <button type="submit" aria-label="نمایش اطلاعات بهره برداری">
                                        <img src="../../files/view.png" title="نمایش اطلاعات بهره برداری" width="33" height="26" alt=""/>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <?php if ((Vege_pt($row['id']) > 0) or ($row['confi'] != '2')) {
                                    echo "<img src='../../files/disable.png' width='20' height='20' title='اطلاعات کشت تکمیل نشده'  alt=''/>";
                                } else { ?>
                                    <?php if ($row['confi2'] == '1') { ?>
                                    <img src="../../files/FAQ.png" title="بررسی نشده" width="30" height="20" alt=""/>
                                    <?php } ?>
                                    <?php if ($row['confi2'] == '2') { ?>
                                    <img src="../../files/icon1Active.png" title="تایید شده" width="33" height="26" alt=""/>
                                    <?php } ?>
                                    <?php if ($row['confi2'] == '3') { ?>
                                    <img src="../../files/icon1Inactive.png" title="تایید نشده" width="33" height="26" alt=""/>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($row['confi'] == '1') { ?>
                                <img src="../../files/FAQ.png" title="در حال بررسی " width="30" height="20" alt=""/>
                                <?php } ?>
                                <?php if ($row['confi'] == '2') { ?>
                                <img src="../../files/icon1Active.png" title="تایید شده" width="33" height="26" alt=""/>
                                <?php } ?>
                                <?php if ($row['confi'] == '3') { ?>
                                <img src="../../files/icon1Inactive.png" title="تایید نشده" width="33" height="26" alt=""/>
                                <?php } ?>
                            </td>
                            <td><?php echo agri2_h($row['m_zamin']); ?></td>
                            <td><?php echo agri2_h($v_m_ab); ?></td>
                            <td><?php echo agri2_h($v_b_time); ?></td>
                            <td><?php echo agri2_h($row['sh_gat']); ?></td>
                            <td><?php echo agri2_h($row['z_sal']); ?></td>
                            <td dir="ltr"><?php echo agri2_h($row['bah_cod_m']); ?></td>
                            <td class="agri1-name-col"><?php echo agri2_h(str_replace('&nbsp;', ' ', bah_name2($row['bah_cod_m'], $row['no_bah']))); ?></td>
                            <td class="agri1-name-col"><?php echo agri2_h(abadi_name($row['add_abadi'])) . agri2_h(shahr_name($row['add_city'])); ?></td>
                            <td class="agri1-name-col"><?php echo agri2_h(city_name1($row['id_city'], $row['id_ostan'])); ?></td>
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

    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute();
    $rows = $stmt1->fetchColumn();
    if ($limit > 0) {
        $total = ceil($rows / $limit);
    } else {
        $total = 1;
    }

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
                    <form action="liste_Vege.php?id=<?php echo (int)$id - 1; ?>#1" method="post">
                        <?php vege_list_filter_hiddens($add_abadi, $add_city, $z_sal, $bah_cod_m, $b_time, $m_ab, $confi); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="liste_Vege.php?id=1#1" method="post">
                        <?php vege_list_filter_hiddens($add_abadi, $add_city, $z_sal, $bah_cod_m, $b_time, $m_ab, $confi); ?>
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
                    <form action="liste_Vege.php?id=<?php echo (int)$i; ?>#1" method="post">
                        <?php vege_list_filter_hiddens($add_abadi, $add_city, $z_sal, $bah_cod_m, $b_time, $m_ab, $confi); ?>
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
                    <form action="liste_Vege.php?id=<?php echo (int)$total; ?>#1" method="post">
                        <?php vege_list_filter_hiddens($add_abadi, $add_city, $z_sal, $bah_cod_m, $b_time, $m_ab, $confi); ?>
                        <button type="submit" class="agri1-pager-btn"><?php echo (int)$total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if (isset($id) && $id != $total && $total > 0) { ?>
                <li>
                    <form action="liste_Vege.php?id=<?php echo (int)$id + 1; ?>#1" method="post">
                        <?php vege_list_filter_hiddens($add_abadi, $add_city, $z_sal, $bah_cod_m, $b_time, $m_ab, $confi); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="liste_Vege.php" method="post">
                    <?php vege_list_filter_hiddens($add_abadi, $add_city, $z_sal, $bah_cod_m, $b_time, $m_ab, $confi); ?>
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
                    this.action = 'liste_Vege.php?id=' + pageId + '#1';
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
