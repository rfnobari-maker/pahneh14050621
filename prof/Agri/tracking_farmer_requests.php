<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri_farmer_track_filter_hiddens($z_sal, $bah_cod_m)
{
    $pairs = array(
        'action' => '1',
        'z_sal' => $z_sal,
        'bah_cod_m' => $bah_cod_m
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}

$z_sal     = isset($_POST['z_sal'])     ? $_POST['z_sal']     : '1404-1405';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';

$login_session = $_SESSION['login_user'];
$id_mar        = $_SESSION['id_mar'];

$Agri_table = 'Agri' . str_replace('-', '_', $z_sal);

if (isset($_GET['del_id'])) {
    $del_id = intval($_GET['del_id']);
    $check_sql = "SELECT reg_status FROM Agri_req_bah WHERE id = :id AND mor_cod_m = :login_session";
    $check_stmt = $dbh->prepare($check_sql);
    $check_stmt->execute(array(':id' => $del_id, ':login_session' => $login_session));
    $req_status = $check_stmt->fetchColumn();

    if ($req_status != 3 && $req_status != 33) {
        $del_sql = "DELETE FROM Agri_req_bah WHERE id = :id AND mor_cod_m = :login_session";
        $del_stmt = $dbh->prepare($del_sql);
        $del_stmt->execute(array(':id' => $del_id, ':login_session' => $login_session));
        header('Location: tracking_farmer_requests.php?msg=deleted');
        exit;
    }
}

$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 1;
if ($id < 1) $id = 1;
$limit = 10;
$start = ($id - 1) * $limit;

$where = "WHERE mor_cod_m = :login_session AND z_sal = :z_sal";
if (!empty($bah_cod_m)) {
    $where .= " AND (bah_cod_m = :bah_cod_m OR new_bah_cod_m = :bah_cod_m)";
}

$count_sql = "SELECT COUNT(*) FROM Agri_req_bah $where";
$stmt_c = $dbh->prepare($count_sql);
$stmt_c->bindParam(':login_session', $login_session);
$stmt_c->bindParam(':z_sal', $z_sal);
if (!empty($bah_cod_m)) {
    $stmt_c->bindParam(':bah_cod_m', $bah_cod_m);
}
$stmt_c->execute();
$rows = (int)$stmt_c->fetchColumn();
$total = $rows > 0 ? (int)ceil($rows / $limit) : 0;
if ($total > 0 && $id > $total) {
    $id = $total;
    $start = ($id - 1) * $limit;
}

$sql = "SELECT * FROM Agri_req_bah $where ORDER BY id DESC LIMIT $start, $limit";
$req_stmt = $dbh->prepare($sql);
$req_stmt->bindParam(':login_session', $login_session);
$req_stmt->bindParam(':z_sal', $z_sal);
if (!empty($bah_cod_m)) {
    $req_stmt->bindParam(':bah_cod_m', $bah_cod_m);
}
$req_stmt->execute();
$track_rows = $req_stmt->fetchAll(PDO::FETCH_ASSOC);

$land_by_id = array();
$land_ids = array();
foreach ($track_rows as $tr) {
    if (isset($tr['Agri_id']) && $tr['Agri_id'] !== '') {
        $land_ids[] = (int)$tr['Agri_id'];
    }
}
$land_ids = array_values(array_unique(array_filter($land_ids)));
if (count($land_ids) > 0) {
    $in = implode(',', $land_ids);
    $inf_stmt = $dbh->query("SELECT id, add_abadi, add_city, no_kesh, m_zamin FROM `$Agri_table` WHERE id IN ($in)");
    if ($inf_stmt) {
        while ($inf_row = $inf_stmt->fetch(PDO::FETCH_ASSOC)) {
            $land_by_id[$inf_row['id']] = $inf_row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>پیگیری درخواست‌های تغییر بهره‌بردار</title>
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
            width: 72px;
            padding: 3px 2px;
            white-space: nowrap;
        }
        .agri1-table th.agri1-col-row { width: 36px; }
        .agri1-table th.agri1-col-date { width: 78px; }
        .agri1-table th.agri1-col-status { width: 92px; }
        .agri1-table th.agri1-col-num { width: 64px; }
        .agri1-table th.agri1-col-kesh { width: 48px; }
        .agri1-table .agri1-name-col {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .agri1-table td.agri1-comment-col {
            white-space: normal;
            text-align: right;
            font-size: 11px;
            line-height: 1.45;
        }
        .agri1-table .agri1-btn {
            min-width: 44px;
            min-height: 32px;
            padding: 4px 8px;
            font-size: 13px;
        }
        .agri1-old-val {
            color: var(--color-muted-foreground);
            text-decoration: line-through;
            display: block;
            font-size: 10px;
        }
        .agri1-new-val {
            color: var(--color-primary);
            font-weight: 700;
            display: block;
        }
        .agri1-status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 8px;
            color: var(--color-on-primary);
            font-weight: 700;
            font-size: 10px;
            min-width: 86px;
        }
        .agri1-status-0 { background: var(--color-accent); }
        .agri1-status-1,
        .agri1-status-2 { background: var(--color-secondary); }
        .agri1-status-3 { background: var(--color-primary); }
        .agri1-status-11,
        .agri1-status-22,
        .agri1-status-33 { background: var(--color-destructive); }
        .agri1-comment-row {
            border-top: 1px dashed var(--color-border);
            margin-top: 5px;
            padding-top: 4px;
        }
        .agri1-comment-date {
            color: var(--color-muted-foreground);
            font-size: 9px;
            display: block;
            margin-top: 2px;
        }
        .agri1-comment-center { color: var(--color-secondary); }
        .agri1-comment-city { color: var(--color-accent); }
        .agri1-comment-prov { color: var(--color-destructive); }
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
        function confirmDelete(id) {
            if (confirm('آیا از حذف این درخواست اطمینان دارید؟')) {
                window.location.href = 'tracking_farmer_requests.php?del_id=' + id;
            }
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

    <main class="agri1-main" id="1">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri-farmer-track-title">پیگیری درخواست‌های تغییر بهره‌بردار</h1>
        </header>

        <section class="agri1-card agri1-card-search" aria-labelledby="agri-farmer-track-title">
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
                        <label class="agri1-label" for="bah_cod_m">کد ملی (قدیم/جدید)</label>
                        <input type="text" name="bah_cod_m" id="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>" maxlength="10" dir="ltr" inputmode="numeric" autocomplete="off"/>
                    </div>
                </div>
                <div class="agri1-actions">
                    <button type="submit" name="action" id="action" value="جستجو" class="agri1-btn agri1-btn-primary">جستجو</button>
                </div>
            </form>
        </section>

<?php
if ($rows > 0) {
    $status_text = array(
        0 => 'در جریان',
        1 => 'تایید مرکز',
        11 => 'رد مرکز',
        2 => 'تایید شهرستان',
        22 => 'رد شهرستان',
        3 => 'تایید نهایی',
        33 => 'رد نهایی'
    );
?>
        <section class="agri1-card agri1-card-results" aria-label="نتایج جستجو">
            <h2 class="agri1-card-title">نتایج</h2>
            <div class="agri1-table-wrap agri1-table-rtl">
                <table class="agri1-table">
                    <thead>
                        <tr>
                            <th class="agri1-col-row">ردیف</th>
                            <th class="agri1-col-date">تاریخ ثبت</th>
                            <th>نام آبادی</th>
                            <th class="agri1-col-kesh">نوع کشت</th>
                            <th class="agri1-col-num">مساحت زمین</th>
                            <th>بهره‌بردار فعلی (قبلی)</th>
                            <th>بهره‌بردار پیشنهادی</th>
                            <th class="agri1-col-num">شناسه قطعه</th>
                            <th>علت و نظرات کارشناسی</th>
                            <th class="agri1-col-status">وضعیت فعلی</th>
                            <th class="agri1-ops-col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
    $r = $start + 1;
    foreach ($track_rows as $row) {
        $inf = isset($land_by_id[$row['Agri_id']]) ? $land_by_id[$row['Agri_id']] : array('add_abadi' => '', 'add_city' => '', 'no_kesh' => '', 'm_zamin' => '');
        $st = isset($row['reg_status']) ? $row['reg_status'] : '';
        $st_label = isset($status_text[$st]) ? $status_text[$st] : 'نامشخص';
        $old_name = str_replace('&nbsp;', ' ', bah_name2($row['bah_cod_m'], $row['num_bah']));
        $new_name = str_replace('&nbsp;', ' ', bah_name2($row['new_bah_cod_m'], $row['new_num_bah']));
        $place = abadi_name($inf['add_abadi']) . shahr_name($inf['add_city']);
        $no_kesh_txt = '';
        if ($inf['no_kesh'] == '1') $no_kesh_txt = 'آبی';
        if ($inf['no_kesh'] == '2') $no_kesh_txt = 'دیم';
?>
                        <tr>
                            <td><?php echo (int)$r; ?></td>
                            <td><?php echo agri2_h($row['date_req']); ?></td>
                            <td class="agri1-name-col"><?php echo agri2_h($place); ?></td>
                            <td><?php echo agri2_h($no_kesh_txt); ?></td>
                            <td><?php echo agri2_h($inf['m_zamin']); ?></td>
                            <td class="agri1-name-col">
                                <span class="agri1-old-val"><?php echo agri2_h($old_name); ?></span>
                                <small><?php echo agri2_h($row['bah_cod_m']); ?></small>
                            </td>
                            <td class="agri1-name-col">
                                <span class="agri1-new-val"><?php echo agri2_h($new_name); ?></span>
                                <small><?php echo agri2_h($row['new_bah_cod_m']); ?></small>
                            </td>
                            <td><?php echo agri2_h($row['Agri_id']); ?></td>
                            <td class="agri1-comment-col">
                                <div><strong>علت درخواست:</strong> <?php echo agri2_h($row['reason']); ?></div>
<?php if (!empty($row['center_comment'])) { ?>
                                <div class="agri1-comment-row">
                                    <strong class="agri1-comment-center">نظر مرکز:</strong> <?php echo agri2_h($row['center_comment']); ?>
                                    <span class="agri1-comment-date">تاریخ بررسی: <?php echo agri2_h($row['center_date']); ?></span>
                                </div>
<?php } ?>
<?php if (!empty($row['city_comment'])) { ?>
                                <div class="agri1-comment-row">
                                    <strong class="agri1-comment-city">نظر شهرستان:</strong> <?php echo agri2_h($row['city_comment']); ?>
                                    <span class="agri1-comment-date">تاریخ بررسی: <?php echo agri2_h($row['city_date']); ?></span>
                                </div>
<?php } ?>
<?php if (!empty($row['prov_comment'])) { ?>
                                <div class="agri1-comment-row">
                                    <strong class="agri1-comment-prov">نظر نهائی استان:</strong> <?php echo agri2_h($row['prov_comment']); ?>
                                    <span class="agri1-comment-date">تاریخ بررسی: <?php echo agri2_h($row['prov_date']); ?></span>
                                </div>
<?php } ?>
                            </td>
                            <td>
                                <span class="agri1-status agri1-status-<?php echo agri2_h($st); ?>"><?php echo agri2_h($st_label); ?></span>
                            </td>
                            <td class="agri1-ops">
<?php if ($row['reg_status'] != 3 && $row['reg_status'] != 33) { ?>
                                <button type="button" class="agri1-btn agri1-btn-ghost" onclick="confirmDelete(<?php echo (int)$row['id']; ?>);">حذف</button>
<?php } else { ?>
                                -
<?php } ?>
                            </td>
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

if ($rows > 0) {
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
                    <form action="tracking_farmer_requests.php?id=<?php echo (int)$id - 1; ?>#1" method="post">
                        <?php agri_farmer_track_filter_hiddens($z_sal, $bah_cod_m); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="tracking_farmer_requests.php?id=1#1" method="post">
                        <?php agri_farmer_track_filter_hiddens($z_sal, $bah_cod_m); ?>
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
                    <form action="tracking_farmer_requests.php?id=<?php echo (int)$i; ?>#1" method="post">
                        <?php agri_farmer_track_filter_hiddens($z_sal, $bah_cod_m); ?>
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
                    <form action="tracking_farmer_requests.php?id=<?php echo (int)$total; ?>#1" method="post">
                        <?php agri_farmer_track_filter_hiddens($z_sal, $bah_cod_m); ?>
                        <button type="submit" class="agri1-pager-btn"><?php echo (int)$total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($id != $total && $total > 0) { ?>
                <li>
                    <form action="tracking_farmer_requests.php?id=<?php echo (int)$id + 1; ?>#1" method="post">
                        <?php agri_farmer_track_filter_hiddens($z_sal, $bah_cod_m); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="tracking_farmer_requests.php" method="post">
                    <?php agri_farmer_track_filter_hiddens($z_sal, $bah_cod_m); ?>
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
                    this.action = 'tracking_farmer_requests.php?id=' + pageId + '#1';
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
            <a class="agri1-btn agri1-btn-ghost" href="Agri_req_bah.php" title="برگشت به صفحه قبل">
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
    </script>
</body>
</html>
