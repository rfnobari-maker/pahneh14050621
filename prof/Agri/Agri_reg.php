<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri_reg_filter_hiddens($z_sal, $bah_cod_m)
{
    $pairs = array(
        'action' => '1',
        'search' => '1',
        'z_sal' => $z_sal,
        'bah_cod_m' => $bah_cod_m
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

function check_req($Agri_id)
{
    include('../../login/config.php');
    $query = "SELECT count(*) from Agri_prod_req where Agri_id = $Agri_id and reg_status not in ('3','33')  ";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
}

$z_sal     = isset($_POST['z_sal'])     ? $_POST['z_sal']     : '1404-1405';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';

$Agri_table      = 'Agri' . str_replace('-', '_', $z_sal);
$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

$do_search = !empty($bah_cod_m) && (isset($_POST['search']) || isset($_POST['action']));
$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 1;
if ($id < 1) $id = 1;
$limit = 10;
$start = ($id - 1) * $limit;
$rows = 0;
$total = 0;
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ثبت درخواست تغییر محصول / مساحت</title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
        .agri1-page .agri1-form input[type="number"],
        .agri1-page .agri1-form select,
        .agri1-page .agri1-form textarea {
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
        .agri1-page .agri1-form textarea { min-height: 80px; resize: vertical; }
        .agri1-page .agri1-form input[type="text"]:hover,
        .agri1-page .agri1-form input[type="number"]:hover,
        .agri1-page .agri1-form select:hover,
        .agri1-page .agri1-form textarea:hover {
            background: var(--color-card);
            color: var(--color-foreground);
        }
        .agri1-page .agri1-form input[type="text"]:focus,
        .agri1-page .agri1-form input[type="number"]:focus,
        .agri1-page .agri1-form select:focus,
        .agri1-page .agri1-form textarea:focus {
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
        .agri1-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
            direction: rtl;
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
        .agri1-table-wrap.agri1-table-rtl,
        .agri1-table-wrap.agri1-table-rtl .agri1-table {
            direction: rtl;
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
        .agri1-table th.agri1-ops-wide,
        .agri1-table td.agri1-ops-wide {
            width: 20%;
            white-space: normal;
            padding: 4px 4px;
        }
        .agri1-table th.agri1-col-row { width: 36px; }
        .agri1-table th.agri1-col-kesh { width: 48px; }
        .agri1-table th.agri1-col-num { width: 56px; }
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
        .agri1-pending {
            color: var(--color-accent);
            font-weight: 700;
            background: var(--color-background);
            border: 1px solid var(--color-border);
            padding: 5px 6px;
            border-radius: 8px;
            font-size: 11px;
            line-height: 1.45;
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
        .agri1-modal {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            overflow-y: auto;
            background: rgba(15, 23, 42, 0.55);
            padding: 16px;
        }
        .agri1-modal-panel {
            background: var(--color-card);
            color: var(--color-card-foreground);
            padding: 20px;
            border-radius: 16px;
            width: 85%;
            max-width: 900px;
            margin: 20px auto;
            box-shadow: var(--shadow);
            border: 1px solid var(--color-border);
        }
        .agri1-modal-panel .agri1-card-title { margin-top: 12px; }
        .agri1-char-count {
            text-align: left;
            font-size: 10px;
            color: var(--color-muted-foreground);
            direction: ltr;
        }
        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
            .agri1-grid-3 { grid-template-columns: 1fr; }
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

    <main class="agri1-main" id="1">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri-reg-title">ثبت درخواست تغییر محصول / مساحت</h1>
        </header>

        <section class="agri1-card agri1-card-search" aria-labelledby="agri-reg-title">
            <form id="reg-form" class="agri1-form" method="post" action="#1" novalidate>
                <h2 class="agri1-card-title">جستجو</h2>
                <div class="agri1-grid">
                    <div class="agri1-field">
                        <label class="agri1-label" for="z_sal">سال زراعی</label>
                        <select name="z_sal" id="z_sal">
                            <option value="1404-1405"<?php echo ($z_sal == '1404-1405' ? ' selected' : ''); ?>>1404-1405</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="bah_cod_m">کد ملی</label>
                        <input type="text" name="bah_cod_m" id="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>" maxlength="10" dir="ltr" inputmode="numeric" autocomplete="off"/>
                    </div>
                </div>
                <div class="agri1-actions">
                    <button type="submit" name="search" id="action" value="جستجو" class="agri1-btn agri1-btn-primary">جستجو</button>
                    <a class="agri1-btn agri1-btn-ghost" href="tracking_requests.php">مشاهده و پیگیری درخواست‌ها</a>
                </div>
            </form>
        </section>

<?php
if ($do_search) {
    $sql = "SELECT p.* ,
            (SELECT r.status FROM Agri_prod_req r
             WHERE r.prod_id = p.id AND r.z_sal = :z_sal_sub
             ORDER BY r.id DESC LIMIT 1) as status
            FROM `$Agri_prod_table` p
            WHERE p.bah_cod_m = :cod_m
            AND p.id_mar = :id_mar
            AND p.mor_cod_m = :login_session
            ORDER BY p.id ASC
            LIMIT $start, $limit";
    $count_sql = "SELECT COUNT(*) FROM `$Agri_prod_table` p
            WHERE p.bah_cod_m = :cod_m
            AND p.id_mar = :id_mar
            AND p.mor_cod_m = :login_session";
    try {
        $stmt_c = $dbh->prepare($count_sql);
        $stmt_c->bindParam(':cod_m', $bah_cod_m);
        $stmt_c->bindParam(':id_mar', $id_mar);
        $stmt_c->bindParam(':login_session', $login_session);
        $stmt_c->execute();
        $rows = (int)$stmt_c->fetchColumn();
        $total = $rows > 0 ? (int)ceil($rows / $limit) : 0;
        if ($total > 0 && $id > $total) {
            $id = $total;
            $start = ($id - 1) * $limit;
            $sql = "SELECT p.* ,
                    (SELECT r.status FROM Agri_prod_req r
                     WHERE r.prod_id = p.id AND r.z_sal = :z_sal_sub
                     ORDER BY r.id DESC LIMIT 1) as status
                    FROM `$Agri_prod_table` p
                    WHERE p.bah_cod_m = :cod_m
                    AND p.id_mar = :id_mar
                    AND p.mor_cod_m = :login_session
                    ORDER BY p.id ASC
                    LIMIT $start, $limit";
        }

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':cod_m', $bah_cod_m);
        $stmt->bindParam(':id_mar', $id_mar);
        $stmt->bindParam(':login_session', $login_session);
        $stmt->bindParam(':z_sal_sub', $z_sal);
        $stmt->execute();

        if ($rows > 0) {
?>
        <section class="agri1-card agri1-card-results" aria-label="نتایج جستجو">
            <h2 class="agri1-card-title">نتایج</h2>
            <div class="agri1-table-wrap agri1-table-rtl">
                <table class="agri1-table">
                    <thead>
                        <tr>
                            <th class="agri1-col-row" rowspan="2">ردیف</th>
                            <th rowspan="2">آبادی / شهر</th>
                            <th rowspan="2">نام محصول</th>
                            <th class="agri1-col-kesh" rowspan="2">نوع کشت</th>
                            <th colspan="2">سطح زیر کشت<br>هکتار</th>
                            <th class="agri1-col-num" rowspan="2">پیش بینی تولید<br>تن</th>
                            <th rowspan="2">نام بهره‌بردار</th>
                            <th class="agri1-ops-wide" rowspan="2">عملیات</th>
                        </tr>
                        <tr>
                            <th class="agri1-col-num">اول</th>
                            <th class="agri1-col-num">دوم</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
            $t_r = 1;
            $r = $start + 1;
            while ($row = $stmt->fetch()) {
                $prod_name = mah_name($row['cod_mah']);
                $farmer_name = bah_name2($row['bah_cod_m'], $row['num_bah']);
                $place = abadi_name($row['add_abadi']) . shahr_name($row['add_city']);
                $no_kesh_txt = '';
                if ($row['no_kesh'] == '1') $no_kesh_txt = 'آبی';
                if ($row['no_kesh'] == '2') $no_kesh_txt = 'دیم';
?>
                        <tr>
                            <td><?php echo (int)$r; ?></td>
                            <td class="agri1-name-col"><?php echo agri2_h($place); ?></td>
                            <td class="agri1-name-col"><?php echo agri2_h($prod_name); ?></td>
                            <td><?php echo agri2_h($no_kesh_txt); ?></td>
                            <td><?php echo agri2_h($row['zer_kesht_a']); ?></td>
                            <td><?php echo agri2_h($row['zer_kesht_b']); ?></td>
                            <td><?php echo agri2_h($row['mah_tolp']); ?></td>
                            <td class="agri1-name-col"><?php echo agri2_h(str_replace('&nbsp;', ' ', $farmer_name)); ?></td>
                            <td class="agri1-ops-wide">
<?php
                if (isset($row['status']) && $row['status'] !== null && !($row['status'] == 3 || $row['status'] == 33)) {
?>
                                <div class="agri1-pending">درخواست قبلی این محصول تاکنون تایید یا رد نهائی نشده است</div>
<?php
                } elseif (check_req($row['Agri_id']) > 0) {
?>
                                <div class="agri1-pending">درخواست یکی از محصولات این قطعه تاکنون تایید یا رد نهائی نشده است</div>
<?php
                } else {
?>
                                <button type="button" class="agri1-btn agri1-btn-primary" onclick="openEditModal('<?php echo agri2_h($row['id']); ?>', '<?php echo agri2_h($z_sal); ?>')">ثبت تغییر محصول / مساحت</button>
<?php
                }
?>
                            </td>
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
    } catch (PDOException $e) {
        echo '<p class="agri1-note">Error: ' . agri2_h($e->getMessage()) . '</p>';
    }
}

if ($do_search && $rows > 0) {
    $visible_pages = 3;
    $start_page = max(1, $id - $visible_pages);
    $end_page = min($total, $id + $visible_pages);
    $show_first = ($start_page > 1);
    $show_last = ($end_page < $total);
?>
        <nav class="agri1-pager" aria-label="صفحه‌بندی">
            <ul class="agri1-pager-list">
                <?php if ($id > 1) { ?>
                <li>
                    <form action="Agri_reg.php?id=<?php echo (int)$id - 1; ?>#1" method="post">
                        <?php agri_reg_filter_hiddens($z_sal, $bah_cod_m); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="Agri_reg.php?id=1#1" method="post">
                        <?php agri_reg_filter_hiddens($z_sal, $bah_cod_m); ?>
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
                    <form action="Agri_reg.php?id=<?php echo (int)$i; ?>#1" method="post">
                        <?php agri_reg_filter_hiddens($z_sal, $bah_cod_m); ?>
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
                    <form action="Agri_reg.php?id=<?php echo (int)$total; ?>#1" method="post">
                        <?php agri_reg_filter_hiddens($z_sal, $bah_cod_m); ?>
                        <button type="submit" class="agri1-pager-btn"><?php echo (int)$total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($id != $total && $total > 0) { ?>
                <li>
                    <form action="Agri_reg.php?id=<?php echo (int)$id + 1; ?>#1" method="post">
                        <?php agri_reg_filter_hiddens($z_sal, $bah_cod_m); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="Agri_reg.php" method="post">
                    <?php agri_reg_filter_hiddens($z_sal, $bah_cod_m); ?>
                    <span>به صفحه</span>
                    <input type="text" inputmode="numeric" lang="en" dir="ltr" id="pageIdInput" name="page_input" value="<?php echo (int)$id; ?>" placeholder="1"/>
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
                    this.action = 'Agri_reg.php?id=' + pageId + '#1';
                } else {
                    e.preventDefault();
                    alert('لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo (int)$total; ?> وارد کنید.');
                }
            });
        })();
        </script>
<?php
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

function closeModal() {
    var modal = document.getElementById('editModal');
    if (modal) {
        modal.remove();
    }
}

function openEditModal(id, z_sal) {
    fetch('check_status.php', {
        method: 'POST',
        body: new URLSearchParams({ id: id, z_sal: z_sal }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
    .then(function (response) { return response.json(); })
    .then(function (response) {
        if (response.status === 1) {
            alert('اطلاع‌رسانی: تا کنون برای این محصول حواله‌ای صادر نشده است و تغییرات برای خود شما مقدور می‌باشد.');
        } else if (response.status === 2) {
            loadEditForm(id, z_sal);
        } else {
            alert('خطا: فعلاً امکان بررسی از سامانه پایش مقدور نیست.');
        }
    })
    .catch(function (error) {
        alert('خطا: ارتباط با سرور برقرار نشد.');
        console.error('Error:', error);
    });
}

var isSubmitting = false;

function loadEditForm(id, z_sal) {
    fetch('get_prod_details.php', {
        method: 'POST',
        body: new URLSearchParams({ id: id, z_sal: z_sal }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
    .then(function (response) { return response.json(); })
    .then(function (data) {
        if (data.error) {
            alert('خطا: اطلاعات یافت نشد.');
            return;
        }

        var modalHTML = ''
            + '<div id="editModal" class="agri1-modal">'
            + '<div class="agri1-modal-panel">'
            + '<h3 class="agri1-title" style="font-size:1.25rem;margin-bottom:12px;">ثبت درخواست تغییر محصول ، مساحت</h3>'
            + '<p class="agri1-hint" style="margin-top:0;font-weight:700;color:var(--color-accent);">اطلاعات فعلی در سامانه:</p>'
            + '<div class="agri1-table-wrap agri1-table-rtl" style="margin-bottom:16px;">'
            + '<table class="agri1-table">'
            + '<thead><tr>'
            + '<th rowspan="2">نام محصول</th>'
            + '<th colspan="2">سطح زیر کشت<br>(هکتار)</th>'
            + '<th rowspan="2">پیش‌بینی تولید<br>(تن)</th>'
            + '<th rowspan="2">کل مساحت زمین<br>(هکتار)</th>'
            + '<th rowspan="2">سطح آیش<br>(هکتار)</th>'
            + '<th rowspan="2">مجموع کشت اول<br>(هکتار)</th>'
            + '<th rowspan="2">مجموع کشت دوم<br>(هکتار)</th>'
            + '</tr><tr><th>اول</th><th>دوم</th></tr></thead>'
            + '<tbody><tr>'
            + '<td>' + data.prod_name + '</td>'
            + '<td>' + data.zer_kesht_a + '</td>'
            + '<td>' + data.zer_kesht_b + '</td>'
            + '<td>' + (data.mah_tolp || 0) + '</td>'
            + '<td>' + data.m_zamin + '</td>'
            + '<td>' + data.s_ayesh + '</td>'
            + '<td>' + data.kol_zer_a + '</td>'
            + '<td>' + data.kol_zer_b + '</td>'
            + '</tr></tbody></table></div>'
            + '<form id="editForm" class="agri1-form">'
            + '<input type="hidden" name="id" value="' + id + '">'
            + '<input type="hidden" name="z_sal" value="' + z_sal + '">'
            + '<h4 class="agri1-card-title">درج مقادیر اصلاحی جدید:</h4>'
            + '<div class="agri1-grid" style="margin-bottom:15px;padding-bottom:15px;border-bottom:1px solid var(--color-border);">'
            + '<div class="agri1-field">گروه محصول:<br>'
            + '<select name="mah_qroup" id="mah_qroup_popup">' + data.group_list_html + '</select></div>'
            + '<div class="agri1-field">نام محصول:<br>'
            + '<select name="n_cod_mah" id="mah_name_popup">'
            + '<option value="' + data.cod_mah + '" selected>' + data.prod_name + '</option>'
            + '</select></div></div>'
            + '<div class="agri1-grid-3" style="margin-bottom:15px;">'
            + '<div class="agri1-field">سطح زیر کشت اول جدید:<br><input type="number" name="n_zer_a" id="n_zer_a" step="0.0001" min="0" value="' + data.zer_kesht_a + '"></div>'
            + '<div class="agri1-field">سطح زیر کشت دوم جدید:<br><input type="number" name="n_zer_b" id="n_zer_b" step="0.0001" min="0" value="' + data.zer_kesht_b + '"></div>'
            + '<div class="agri1-field">پیش‌بینی تولید جدید (تن):<br><input type="number" name="n_pishbini" id="n_pishbini" step="0.1" min="0" value="' + (data.mah_tolp || 0) + '"></div>'
            + '</div>'
            + '<div class="agri1-field">'
            + '<label class="agri1-label" for="change_reason">علت تغییر (حداکثر 150 کاراکتر):</label>'
            + '<textarea id="change_reason" name="reason" maxlength="150" placeholder="توضیحات..." '
            + 'onkeyup="document.getElementById(\'char_count\').innerText = this.value.length"></textarea>'
            + '<div class="agri1-char-count">تعداد کاراکتر: <span id="char_count">0</span> / 150</div>'
            + '</div>'
            + '<div class="agri1-actions" style="margin-top:20px;">'
            + '<button type="submit" id="submitRequestBtn" class="agri1-btn agri1-btn-primary">ثبت درخواست</button>'
            + '<button type="button" onclick="closeModal()" class="agri1-btn agri1-btn-ghost">انصراف</button>'
            + '</div></form></div></div>';

        document.body.insertAdjacentHTML('beforeend', modalHTML);
        document.getElementById('editModal').style.display = 'flex';

        var loadProducts = function (groupId, selectedProdCod) {
            fetch('ajax_city.php', {
                method: 'POST',
                body: new URLSearchParams({ group_cod: groupId }),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(function (response) { return response.text(); })
            .then(function (html) {
                document.getElementById('mah_name_popup').innerHTML = html;
                if (selectedProdCod) {
                    document.getElementById('mah_name_popup').value = selectedProdCod;
                }
            });
        };

        document.getElementById('mah_qroup_popup').onchange = function () {
            loadProducts(this.value);
        };

        var currentGroupId = document.getElementById('mah_qroup_popup').value;
        if (currentGroupId) {
            loadProducts(currentGroupId, data.cod_mah);
        }

        var zerA = document.getElementById('n_zer_a');
        var zerB = document.getElementById('n_zer_b');
        var pishbini = document.getElementById('n_pishbini');
        var noKeshJs = data.no_kesh || '1';

        function bothKeshtPositive() {
            var a = parseFloat(zerA.value) || 0;
            var b = parseFloat(zerB.value) || 0;
            return a > 0 && b > 0;
        }

        function checkBothKesht(changedEl) {
            if (bothKeshtPositive()) {
                alert('امکان ثبت همزمان کشت اول و مجدد وجود ندارد ');
                if (changedEl) {
                    changedEl.value = '';
                    changedEl.focus();
                }
                return false;
            }
            return true;
        }

        function checkPishbiniLimit(onDone) {
            var a = parseFloat(zerA.value) || 0;
            var b = parseFloat(zerB.value) || 0;
            var mtolp = parseFloat(pishbini.value);
            var mcod = document.getElementById('mah_name_popup').value;
            if ((a > 0 || b > 0) && (pishbini.value === '' || isNaN(mtolp) || mtolp === 0)) {
                alert('با توجه به سطح زیر کشت ، میزان پیش بینی تولید باید بزرگتر از صفر باشد');
                pishbini.value = '';
                pishbini.focus();
                if (onDone) onDone(false);
                return;
            }
            fetch('aj.php', {
                method: 'POST',
                body: new URLSearchParams({
                    op: 'check_mah_tol',
                    mcod: mcod,
                    sba: a,
                    sbb: b,
                    mtol: mtolp,
                    no_kesh: noKeshJs
                }),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(function (response) { return response.text(); })
            .then(function (textResponse) {
                if (textResponse.trim() !== 'true') {
                    alert(' میزان پیش بینی وارد شده از محدوده مجاز ، بیشتر هست / میزان سطح زیر کشت را بررسی کنید ');
                    pishbini.value = '';
                    pishbini.focus();
                    if (onDone) onDone(false);
                    return;
                }
                if (onDone) onDone(true);
            })
            .catch(function () {
                alert('خطا در بررسی پیش‌بینی تولید.');
                if (onDone) onDone(false);
            });
        }

        zerA.addEventListener('keyup', function () {
            pishbini.value = '';
            checkBothKesht(zerA);
        });
        zerB.addEventListener('keyup', function () {
            pishbini.value = '';
            checkBothKesht(zerB);
        });
        zerA.addEventListener('change', function () {
            pishbini.value = '';
            checkBothKesht(zerA);
        });
        zerB.addEventListener('change', function () {
            pishbini.value = '';
            checkBothKesht(zerB);
        });
        pishbini.addEventListener('blur', function () {
            if (pishbini.value === '') return;
            if (!checkBothKesht(pishbini)) return;
            checkPishbiniLimit();
        });

        document.getElementById('editForm').onsubmit = function (e) {
            e.preventDefault();

            var submitBtn = document.getElementById('submitRequestBtn');

            if (isSubmitting) {
                alert('لطفاً صبر کنید! درخواست قبلی در حال ثبت است...');
                return false;
            }

            var reason = document.getElementById('change_reason').value.trim();
            var new_zer_a = parseFloat(document.getElementsByName('n_zer_a')[0].value) || 0;
            var new_zer_b = parseFloat(document.getElementsByName('n_zer_b')[0].value) || 0;
            var new_pishbini = parseFloat(document.getElementsByName('n_pishbini')[0].value) || 0;
            var new_product_element = document.getElementById('mah_name_popup');
            var new_product_cod = new_product_element.value;

            var kol_zamin = parseFloat(data.m_zamin) || 0;
            var kol_ayesh = parseFloat(data.s_ayesh) || 0;
            var kol_zer_a = parseFloat(data.kol_zer_a) || 0;
            var kol_zer_b = parseFloat(data.kol_zer_b) || 0;
            var current_zer_a = parseFloat(data.zer_kesht_a) || 0;
            var current_zer_b = parseFloat(data.zer_kesht_b) || 0;
            var current_pishbini = parseFloat(data.mah_tolp) || 0;
            var no_kesh_js = data.no_kesh || '1';

            if (new_zer_a > 0 && new_zer_b > 0) {
                alert('امکان ثبت همزمان کشت اول و مجدد وجود ندارد ');
                return;
            }

            if ((new_zer_a > 0 || new_zer_b > 0) && (!new_pishbini || new_pishbini === 0)) {
                alert('با توجه به سطح زیر کشت ، میزان پیش بینی تولید باید بزرگتر از صفر باشد');
                return;
            }

            if (new_zer_a === current_zer_a && new_zer_b === current_zer_b && new_pishbini === current_pishbini && new_product_cod === data.cod_mah) {
                alert('هیچ تغییری در مقادیر داده نشده است.');
                return;
            }

            var traz_a = kol_zamin - kol_ayesh - (kol_zer_a - current_zer_a + new_zer_a);
            var traz_b = kol_zamin - kol_ayesh - (kol_zer_b - current_zer_b + new_zer_b);

            if (new_zer_a > current_zer_a && traz_a < 0) {
                alert('خطا! مجموع سطح زیر کشت اول، بزرگتر از مساحت کل زمین - سطح آیش هست');
                return;
            }
            if (new_zer_b > current_zer_b && traz_b < 0) {
                alert('خطا! مجموع سطح زیر کشت دوم، بزرگتر از مساحت کل زمین - سطح آیش هست');
                return;
            }

            if (!reason || reason.trim() === '') {
                alert('وارد کردن علت تغییر الزامی است.');
                return;
            }

            var originalBtnText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'در حال ثبت درخواست...';
            submitBtn.style.opacity = '0.6';
            isSubmitting = true;

            var formEl = this;
            fetch('aj.php', {
                method: 'POST',
                body: new URLSearchParams({
                    op: 'check_mah_tol',
                    mcod: new_product_cod,
                    sba: new_zer_a,
                    sbb: new_zer_b,
                    mtol: new_pishbini,
                    no_kesh: no_kesh_js
                }),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(function (response) { return response.text(); })
            .then(function (textResponse) {
                if (textResponse.trim() !== 'true') {
                    alert('میزان پیش‌بینی وارد شده از محدوده مجاز بیشتر است / یا میزان سطح زیر کشت را بررسی کنید.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.style.opacity = '1';
                    isSubmitting = false;
                    return;
                }

                var formData = new FormData(formEl);

                fetch('save_request.php', {
                    method: 'POST',
                    body: formData
                })
                .then(function (saveResponse) { return saveResponse.json(); })
                .then(function (saveResponse) {
                    if (saveResponse.status === 'success') {
                        alert('موفقیت: درخواست اصلاح با موفقیت ثبت شد.');
                        closeModal();
                        location.reload();
                    } else {
                        alert('خطا در ثبت: ' + (saveResponse.message || 'مشکل در اعتبارسنجی الگوی کشت.'));
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                        submitBtn.style.opacity = '1';
                        isSubmitting = false;
                    }
                })
                .catch(function (error) {
                    alert('خطا در ارسال درخواست به سرور.');
                    console.error('Save Error:', error);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.style.opacity = '1';
                    isSubmitting = false;
                });
            })
            .catch(function (error) {
                alert('خطا در بررسی پیش‌بینی تولید.');
                console.error('Check Error:', error);
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
                submitBtn.style.opacity = '1';
                isSubmitting = false;
            });
        };
    })
    .catch(function (error) {
        alert('خطا در دریافت جزئیات محصول.');
        console.error('Fetch Details Error:', error);
    });
}
</script>
</body>
</html>
