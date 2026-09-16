<?php
require_once dirname(__FILE__) . '/auth.php';
require_once dirname(__FILE__) . '/lib.php';

$jalali = dirname(__FILE__) . '/../Jalali.php';
if (is_file($jalali) && !function_exists('jdate')) {
    require_once $jalali;
}

$dash_root = '../';
$domains = array(
    'agri' => 'زراعی',
    'vege' => 'صیفی',
    'garden' => 'باغی',
    'greenhouse' => 'گلخانه',
    'mushroom' => 'قارچ',
    'bee' => 'زنبور',
    'aquatic' => 'شیلات'
);

function dash_admin_h($s)
{
    return htmlspecialchars($s . '', ENT_QUOTES, 'UTF-8');
}

function dash_admin_fa_dt($dt)
{
    $dt = trim($dt . '');
    if ($dt === '' || $dt === '0000-00-00 00:00:00') {
        return '-';
    }
    $ts = strtotime($dt);
    if (!$ts) {
        return $dt;
    }
    if (function_exists('jdate')) {
        return jdate('Y/m/d H:i', $ts);
    }
    return date('Y-m-d H:i', $ts);
}

function dash_admin_source_for($domain, $year)
{
    $y = (int) $year;
    $n = $y + 1;
    if ($domain === 'agri') {
        return 'Agri' . $y . '_' . $n . ',Agri_prod' . $y . '_' . $n;
    }
    if ($domain === 'vege') {
        return 'Vege,Vege_prod';
    }
    if ($domain === 'garden') {
        return 'Garden,Garden_prod';
    }
    if ($domain === 'greenhouse') {
        return 'Greenhous,Greenhous_prod';
    }
    if ($domain === 'mushroom') {
        return 'Mushroom,Mushroom_prod';
    }
    if ($domain === 'bee') {
        return 'bee';
    }
    if ($domain === 'aquatic') {
        return 'Aquatic,Aquatic2';
    }
    return '';
}

function dash_admin_label_for($domain, $year)
{
    $y = (int) $year;
    if ($domain === 'agri' || $domain === 'vege') {
        return $y . '_' . ($y + 1);
    }
    return (string) $y;
}

/** Default open/locked rules (same as seed). */
function dash_admin_default_status($domain, $year)
{
    $y = trim($year . '');
    if ($domain === 'agri' || $domain === 'vege') {
        return ($y === '1404' || $y === '1405') ? 'open' : 'locked';
    }
    return ($y === '1405') ? 'open' : 'locked';
}

/** Collect years from b_sal only (+ forced open years 1404/1405). */
function dash_admin_collect_years($dbh)
{
    $sals = array();
    $salRows = dash_rows($dbh, 'SELECT sal FROM b_sal ORDER BY sal ASC', array());
    foreach ($salRows as $r) {
        $s = trim($r['sal'] . '');
        if (preg_match('/^(13|14)\d{2}$/', $s) && !in_array($s, $sals, true)) {
            $sals[] = $s;
        }
    }
    foreach (array('1404', '1405') as $must) {
        if (!in_array($must, $sals, true)) {
            $sals[] = $must;
        }
    }
    sort($sals);
    return $sals;
}

$flash = '';
$flashErr = '';
if (isset($_SESSION['dash_admin_flash'])) {
    $flash = $_SESSION['dash_admin_flash'];
    unset($_SESSION['dash_admin_flash']);
}
if (isset($_SESSION['dash_admin_flash_err'])) {
    $flashErr = $_SESSION['dash_admin_flash_err'];
    unset($_SESSION['dash_admin_flash_err']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action === 'set_status') {
        $year = isset($_POST['year_agri']) ? trim($_POST['year_agri'] . '') : '';
        $domain = isset($_POST['domain']) ? trim($_POST['domain'] . '') : '';
        $status = isset($_POST['status']) ? trim($_POST['status'] . '') : '';
        if (!preg_match('/^(13|14)\d{2}$/', $year) || !isset($domains[$domain]) || ($status !== 'open' && $status !== 'locked')) {
            $_SESSION['dash_admin_flash_err'] = 'invalid request';
        } else {
            $who = trim($PersName . '');
            if ($who === '') {
                $who = 'admin';
            }
            $label = dash_admin_label_for($domain, $year);
            $source = dash_admin_source_for($domain, $year);
            $lockedAt = ($status === 'locked') ? date('Y-m-d H:i:s') : null;
            $lockedBy = ($status === 'locked') ? $who : null;
            $note = ($status === 'open') ? 'active year' : 'locked year';
            try {
                $sql = "INSERT INTO dash_year_status
                    (year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
                    ON DUPLICATE KEY UPDATE
                      status=VALUES(status),
                      label=VALUES(label),
                      source_table=VALUES(source_table),
                      locked_at=VALUES(locked_at),
                      locked_by=VALUES(locked_by),
                      note=VALUES(note),
                      updated_at=NOW()";
                $st = $dbh->prepare($sql);
                $ok = $st && $st->execute(array(
                    $year, $domain, $status, $label, $source, $lockedAt, $lockedBy, $note
                ));
                if ($ok) {
                    $_SESSION['dash_admin_flash'] = 'OK: ' . $domain . ' / ' . $year . ' => ' . $status;
                } else {
                    $_SESSION['dash_admin_flash_err'] = 'save failed';
                }
            } catch (Exception $e) {
                $_SESSION['dash_admin_flash_err'] = 'save error';
            }
        }
        header('Location: admin.php');
        exit;
    }
    if ($action === 'sync_years') {
        try {
            $sals = dash_admin_collect_years($dbh);
            $ins = $dbh->prepare(
                "INSERT INTO dash_year_status
                 (year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
                 ON DUPLICATE KEY UPDATE
                   status=VALUES(status),
                   label=VALUES(label),
                   source_table=VALUES(source_table),
                   locked_at=VALUES(locked_at),
                   locked_by=VALUES(locked_by),
                   note=VALUES(note),
                   updated_at=NOW()"
            );
            $n = 0;
            foreach ($sals as $sal) {
                foreach ($domains as $dom => $_lab) {
                    $st = dash_admin_default_status($dom, $sal);
                    $lockedAt = ($st === 'locked') ? date('Y-m-d H:i:s') : null;
                    $lockedBy = ($st === 'locked') ? 'seed' : null;
                    $note = ($st === 'open') ? 'active year' : 'locked year';
                    if ($ins && $ins->execute(array(
                        $sal,
                        $dom,
                        $st,
                        dash_admin_label_for($dom, $sal),
                        dash_admin_source_for($dom, $sal),
                        $lockedAt,
                        $lockedBy,
                        $note
                    ))) {
                        $n++;
                    }
                }
            }
            // Remove years that are not in b_sal (e.g. old Agri* leftovers like 1397)
            $placeholders = implode(',', array_fill(0, count($sals), '?'));
            $del = $dbh->prepare(
                "DELETE FROM dash_year_status WHERE year_agri NOT IN ($placeholders)"
            );
            $removed = 0;
            if ($del && $del->execute($sals)) {
                $removed = (int) $del->rowCount();
            }
            $_SESSION['dash_admin_flash'] = 'sync OK years=' . count($sals) . ' rows=' . $n
                . ($removed ? (' removed=' . $removed) : '');
        } catch (Exception $e) {
            $_SESSION['dash_admin_flash_err'] = 'sync failed';
        }
        header('Location: admin.php');
        exit;
    }
}

$statusRows = dash_rows(
    $dbh,
    "SELECT year_agri, domain, status, label, source_table, locked_at, locked_by, updated_at
     FROM dash_year_status
     ORDER BY year_agri DESC, domain ASC",
    array()
);
$matrix = array();
$yearList = array();
foreach ($statusRows as $r) {
    $y = $r['year_agri'];
    if (!isset($matrix[$y])) {
        $matrix[$y] = array();
        $yearList[] = $y;
    }
    $matrix[$y][$r['domain']] = $r;
}

$openAgriYears = function_exists('dash_open_years')
    ? dash_open_years($dbh, array('agri'))
    : array();
$lockedAgriYears = function_exists('dash_locked_years')
    ? dash_locked_years($dbh, array('agri'))
    : array();
$openGardenYears = function_exists('dash_open_years')
    ? dash_open_years($dbh, array('garden'))
    : array();
$lockedGardenYears = function_exists('dash_locked_years')
    ? dash_locked_years($dbh, array('garden'))
    : array();

$snapCounts = dash_rows(
    $dbh,
    "SELECT year_agri, level_code, COUNT(*) AS c, MAX(built_at) AS built_at
     FROM dash_snap_open
     GROUP BY year_agri, level_code
     ORDER BY year_agri DESC, level_code ASC",
    array()
);
$snapLockedCounts = dash_rows(
    $dbh,
    "SELECT year_agri, level_code, COUNT(*) AS c, MAX(built_at) AS built_at
     FROM dash_snap_locked
     GROUP BY year_agri, level_code
     ORDER BY year_agri DESC, level_code ASC",
    array()
);
$snapBahRows = array();
if (function_exists('dash_bah_snap_ensure') && dash_bah_snap_ensure($dbh)) {
    $snapBahRows = dash_rows(
        $dbh,
        "SELECT level_code, id_ostan, name_label, bah_total, bah_natural, bah_legal, bah_male, bah_female, built_at, build_ms
         FROM dash_snap_bah
         ORDER BY level_code ASC, id_ostan ASC",
        array()
    );
}
$snapAgriOpen = array();
if (dash_table_exists($dbh, 'dash_snap_agri_open')) {
    $snapAgriOpen = dash_rows(
        $dbh,
        "SELECT year_agri, level_code, COUNT(*) AS c, MAX(built_at) AS built_at
         FROM dash_snap_agri_open
         GROUP BY year_agri, level_code
         ORDER BY year_agri DESC, level_code ASC",
        array()
    );
}
$snapAgriLocked = array();
if (dash_table_exists($dbh, 'dash_snap_agri_locked')) {
    $snapAgriLocked = dash_rows(
        $dbh,
        "SELECT year_agri, level_code, COUNT(*) AS c, MAX(built_at) AS built_at
         FROM dash_snap_agri_locked
         GROUP BY year_agri, level_code
         ORDER BY year_agri DESC, level_code ASC",
        array()
    );
}
$snapGardenOpen = array();
if (dash_table_exists($dbh, 'dash_snap_garden_open')) {
    $snapGardenOpen = dash_rows(
        $dbh,
        "SELECT year_agri, level_code, COUNT(*) AS c, MAX(built_at) AS built_at
         FROM dash_snap_garden_open
         GROUP BY year_agri, level_code
         ORDER BY year_agri DESC, level_code ASC",
        array()
    );
}
$snapGardenLocked = array();
if (dash_table_exists($dbh, 'dash_snap_garden_locked')) {
    $snapGardenLocked = dash_rows(
        $dbh,
        "SELECT year_agri, level_code, COUNT(*) AS c, MAX(built_at) AS built_at
         FROM dash_snap_garden_locked
         GROUP BY year_agri, level_code
         ORDER BY year_agri DESC, level_code ASC",
        array()
    );
}
$runs = dash_rows(
    $dbh,
    "SELECT id, started_at, finished_at, status, target, year_agri, rows_written, error_text, source_ver
     FROM dash_snap_run
     ORDER BY id DESC
     LIMIT 12",
    array()
);

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مدیریت داشبورد آمار</title>
    <link rel="stylesheet" href="<?php echo dash_admin_h($dash_root); ?>FA.css">
    <link rel="stylesheet" href="<?php echo dash_admin_h($dash_root); ?>agri1-theme.css">
    <style>
        body { margin: 0; background: #F0FDF4; color: #14532D; font-family: myfont, Tahoma, sans-serif; }
        .dash-admin { max-width: 1100px; margin: 0 auto; padding: 16px 12px 48px; }
        .dash-admin h1 { margin: 0 0 8px; font-size: 1.4rem; }
        .dash-admin .sub { margin: 0 0 16px; color: #475569; font-size: 14px; }
        .dash-admin-card { background: #fff; border: 1px solid #86C9A0; border-radius: 16px; padding: 16px; margin-bottom: 16px; }
        .dash-admin-card h2 { margin: 0 0 12px; font-size: 1.05rem; }
        .dash-admin-actions { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 14px; }
        .dash-admin-btn, .dash-admin-actions button {
            min-height: 42px; padding: 0 14px; border-radius: 11px; border: 1px solid #86C9A0;
            background: #fff; color: #14532D; font: inherit; font-weight: 700; cursor: pointer; text-decoration: none;
            display: inline-flex; align-items: center;
        }
        .dash-admin-btn.primary { background: #15803D; color: #fff; border-color: #15803D; }
        .dash-admin-btn.danger { border-color: #F59E0B; color: #A16207; background: #FFFBEB; }
        .dash-admin-flash { padding: 10px 12px; border-radius: 12px; margin-bottom: 14px; }
        .dash-admin-flash.ok { background: #ECFDF3; border: 1px solid #86C9A0; }
        .dash-admin-flash.err { background: #FEF2F2; border: 1px solid #FECACA; color: #B91C1C; }
        .dash-admin-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .dash-admin-table th, .dash-admin-table td { border: 1px solid #E8F0F1; padding: 8px 6px; text-align: center; }
        .dash-admin-table th, .dash-admin-table td.year { background: #F7FEF9; font-weight: 700; }
        .dash-pill { display: inline-block; min-width: 54px; padding: 4px 8px; border-radius: 999px; font-size: 12px; font-weight: 700; }
        .dash-pill.open { background: #ECFDF3; color: #166534; border: 1px solid #86C9A0; }
        .dash-pill.locked { background: #F8FAFC; color: #64748B; border: 1px solid #CBD5E1; }
        .dash-admin-mini { margin-top: 6px; }
        .dash-admin-mini button { min-height: 30px; padding: 0 8px; border-radius: 8px; border: 1px solid #86C9A0; background: #fff; font: inherit; font-size: 11px; cursor: pointer; }
        .dash-admin-note { font-size: 13px; color: #475569; line-height: 1.6; margin: 0 0 10px; }
        code { direction: ltr; display: inline-block; }
    </style>
</head>
<body>
<div class="dash-admin">
    <h1>مدیریت داشبورد آمار</h1>
    <p class="sub">کاربر: <?php echo dash_admin_h($login_session); ?></p>

    <div class="dash-admin-actions">
        <a class="dash-admin-btn primary" href="index.php">بازگشت به داشبورد</a>
        <form method="post" style="display:inline;margin:0">
            <input type="hidden" name="action" value="sync_years">
            <button type="submit" class="dash-admin-btn">همگام‌سازی سنوات از b_sal</button>
        </form>
    </div>

    <?php if ($flash !== ''): ?>
        <div class="dash-admin-flash ok"><?php echo dash_admin_h($flash); ?></div>
    <?php endif; ?>
    <?php if ($flashErr !== ''): ?>
        <div class="dash-admin-flash err"><?php echo dash_admin_h($flashErr); ?></div>
    <?php endif; ?>

    <section class="dash-admin-card">
        <h2>وضعیت سنوات</h2>
        <div style="overflow:auto">
            <table class="dash-admin-table">
                <thead>
                    <tr>
                        <th>سال</th>
                        <?php foreach ($domains as $dom => $fa): ?>
                            <th><?php echo dash_admin_h($fa); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                <?php if (!$yearList): ?>
                    <tr><td colspan="<?php echo 1 + count($domains); ?>">ردیفی نیست — همگام‌سازی را بزنید.</td></tr>
                <?php endif; ?>
                <?php foreach ($yearList as $y): ?>
                    <tr>
                        <td class="year"><?php echo dash_admin_h($y); ?></td>
                        <?php foreach ($domains as $dom => $fa): ?>
                            <?php
                            $cell = isset($matrix[$y][$dom]) ? $matrix[$y][$dom] : null;
                            $st = $cell ? $cell['status'] : '';
                            ?>
                            <td>
                                <?php if ($cell): ?>
                                    <span class="dash-pill <?php echo $st === 'open' ? 'open' : 'locked'; ?>">
                                        <?php echo $st === 'open' ? 'باز' : 'مسدود'; ?>
                                    </span>
                                    <div class="dash-admin-mini">
                                        <form method="post" style="display:inline;margin:0">
                                            <input type="hidden" name="action" value="set_status">
                                            <input type="hidden" name="year_agri" value="<?php echo dash_admin_h($y); ?>">
                                            <input type="hidden" name="domain" value="<?php echo dash_admin_h($dom); ?>">
                                            <input type="hidden" name="status" value="<?php echo $st === 'open' ? 'locked' : 'open'; ?>">
                                            <button type="submit"><?php echo $st === 'open' ? 'مسدود' : 'باز'; ?></button>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="dash-admin-card">
        <h2>اسنپ‌شات بهره‌بردار (بدون سال)</h2>
        <p class="dash-admin-note">
            تعداد بهره‌بردار کشور و استان یک‌بار از جدول <code>bah</code> ذخیره می‌شود.
            داشبورد همین عدد را برای همهٔ سال‌های زراعی می‌خواند. شهرستان و مرکز همچنان زنده است.
        </p>
        <div class="dash-admin-actions">
            <a class="dash-admin-btn primary" target="_blank" href="dash_snap_bah_build.php?confirm=1">ساخت / به‌روزرسانی اسنپ بهره‌بردار</a>
        </div>
        <div style="overflow:auto">
            <table class="dash-admin-table">
                <thead>
                    <tr>
                        <th>سطح</th><th>استان</th><th>نام</th><th>کل</th>
                        <th>حقیقی</th><th>حقوقی</th><th>مرد</th><th>زن</th><th>ساخت</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!$snapBahRows): ?>
                    <tr><td colspan="9">خالی — یک‌بار ساخت را بزنید.</td></tr>
                <?php endif; ?>
                <?php foreach ($snapBahRows as $br): ?>
                    <tr>
                        <td><?php echo dash_admin_h($br['level_code']); ?></td>
                        <td><?php echo dash_admin_h($br['id_ostan']); ?></td>
                        <td><?php echo dash_admin_h($br['name_label']); ?></td>
                        <td><?php echo dash_admin_h($br['bah_total']); ?></td>
                        <td><?php echo dash_admin_h($br['bah_natural']); ?></td>
                        <td><?php echo dash_admin_h($br['bah_legal']); ?></td>
                        <td><?php echo dash_admin_h($br['bah_male']); ?></td>
                        <td><?php echo dash_admin_h($br['bah_female']); ?></td>
                        <td><?php echo dash_admin_h(dash_admin_fa_dt($br['built_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="dash-admin-card">
        <h2>اسنپ‌شات زراعت (کشور و استان × محصول)</h2>
        <p class="dash-admin-note">
            داشبورد زراعت در سطح کشور از این جدول می‌خواند (گروه و محصول هنگام نمایش جمع می‌شوند).
            استان، شهرستان و مرکز همچنان زنده‌اند. سال باز را شبانه با کرون خانه هم می‌سازد.
        </p>
        <p class="dash-admin-note">سال‌های agri باز: <?php echo $openAgriYears ? dash_admin_h(implode(', ', $openAgriYears)) : '-'; ?></p>
        <div class="dash-admin-actions">
            <a class="dash-admin-btn primary" target="_blank" href="dash_snap_agri_build.php?confirm=1">ساخت زراعت باز</a>
            <?php foreach ($openAgriYears as $oy): ?>
                <a class="dash-admin-btn" target="_blank" href="dash_snap_agri_build.php?confirm=1&amp;year=<?php echo dash_admin_h($oy); ?>">زراعت <?php echo dash_admin_h($oy); ?></a>
            <?php endforeach; ?>
        </div>
        <div style="overflow:auto">
            <table class="dash-admin-table">
                <thead><tr><th>سال</th><th>سطح</th><th>ردیف</th><th>ساخت</th></tr></thead>
                <tbody>
                <?php if (!$snapAgriOpen): ?><tr><td colspan="4">خالی — یک‌بار ساخت باز را بزنید.</td></tr><?php endif; ?>
                <?php foreach ($snapAgriOpen as $sc): ?>
                    <tr>
                        <td><?php echo dash_admin_h($sc['year_agri']); ?></td>
                        <td><?php echo dash_admin_h($sc['level_code']); ?></td>
                        <td><?php echo dash_admin_h($sc['c']); ?></td>
                        <td><?php echo dash_admin_h(dash_admin_fa_dt($sc['built_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="dash-admin-note" style="margin-top:14px">سال‌های agri مسدود: <?php echo $lockedAgriYears ? dash_admin_h(implode(', ', $lockedAgriYears)) : '-'; ?></p>
        <div class="dash-admin-actions">
            <a class="dash-admin-btn danger" target="_blank" href="dash_snap_agri_build_locked.php?confirm=1">ساخت زراعت مسدود</a>
            <?php foreach ($lockedAgriYears as $ly): ?>
                <a class="dash-admin-btn" target="_blank"
                   href="dash_snap_agri_build_locked.php?confirm=1&amp;year=<?php echo dash_admin_h($ly); ?>">
                    زراعت <?php echo dash_admin_h($ly); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div style="overflow:auto">
            <table class="dash-admin-table">
                <thead><tr><th>سال</th><th>سطح</th><th>ردیف</th><th>ساخت</th></tr></thead>
                <tbody>
                <?php if (!$snapAgriLocked): ?><tr><td colspan="4">خالی</td></tr><?php endif; ?>
                <?php foreach ($snapAgriLocked as $sc): ?>
                    <tr>
                        <td><?php echo dash_admin_h($sc['year_agri']); ?></td>
                        <td><?php echo dash_admin_h($sc['level_code']); ?></td>
                        <td><?php echo dash_admin_h($sc['c']); ?></td>
                        <td><?php echo dash_admin_h(dash_admin_fa_dt($sc['built_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="dash-admin-card">
        <h2>اسنپ‌شات باغبانی (کشور و استان × محصول)</h2>
        <p class="dash-admin-note">
            داشبورد باغبانی در سطح کشور از این جدول می‌خواند (گروه، محصول، آبی/دیم و بارور/غیربارور هنگام نمایش جمع می‌شوند).
            استان، شهرستان و مرکز همچنان زنده‌اند. سال باز را شبانه با کرون هم می‌سازد.
            ابلاغی از <code>Garden_ab_ostan</code> و برش از <code>Garden_ab_city</code>.
        </p>
        <p class="dash-admin-note">سال‌های garden باز: <?php echo $openGardenYears ? dash_admin_h(implode(', ', $openGardenYears)) : '-'; ?></p>
        <div class="dash-admin-actions">
            <a class="dash-admin-btn primary" target="_blank" href="dash_snap_garden_build.php?confirm=1">ساخت باغبانی باز</a>
            <?php foreach ($openGardenYears as $oy): ?>
                <a class="dash-admin-btn" target="_blank" href="dash_snap_garden_build.php?confirm=1&amp;year=<?php echo dash_admin_h($oy); ?>">باغبانی <?php echo dash_admin_h($oy); ?></a>
            <?php endforeach; ?>
        </div>
        <div style="overflow:auto">
            <table class="dash-admin-table">
                <thead><tr><th>سال</th><th>سطح</th><th>ردیف</th><th>ساخت</th></tr></thead>
                <tbody>
                <?php if (!$snapGardenOpen): ?><tr><td colspan="4">خالی — یک‌بار ساخت باز را بزنید.</td></tr><?php endif; ?>
                <?php foreach ($snapGardenOpen as $sc): ?>
                    <tr>
                        <td><?php echo dash_admin_h($sc['year_agri']); ?></td>
                        <td><?php echo dash_admin_h($sc['level_code']); ?></td>
                        <td><?php echo dash_admin_h($sc['c']); ?></td>
                        <td><?php echo dash_admin_h(dash_admin_fa_dt($sc['built_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="dash-admin-note" style="margin-top:14px">سال‌های garden مسدود: <?php echo $lockedGardenYears ? dash_admin_h(implode(', ', $lockedGardenYears)) : '-'; ?></p>
        <div class="dash-admin-actions">
            <a class="dash-admin-btn danger" target="_blank" href="dash_snap_garden_build_locked.php?confirm=1">ساخت باغبانی مسدود</a>
            <?php foreach ($lockedGardenYears as $ly): ?>
                <a class="dash-admin-btn" target="_blank"
                   href="dash_snap_garden_build_locked.php?confirm=1&amp;year=<?php echo dash_admin_h($ly); ?>">
                    باغبانی <?php echo dash_admin_h($ly); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div style="overflow:auto">
            <table class="dash-admin-table">
                <thead><tr><th>سال</th><th>سطح</th><th>ردیف</th><th>ساخت</th></tr></thead>
                <tbody>
                <?php if (!$snapGardenLocked): ?><tr><td colspan="4">خالی</td></tr><?php endif; ?>
                <?php foreach ($snapGardenLocked as $sc): ?>
                    <tr>
                        <td><?php echo dash_admin_h($sc['year_agri']); ?></td>
                        <td><?php echo dash_admin_h($sc['level_code']); ?></td>
                        <td><?php echo dash_admin_h($sc['c']); ?></td>
                        <td><?php echo dash_admin_h(dash_admin_fa_dt($sc['built_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="dash-admin-card">
        <h2>ساخت اسنپ‌شات باز</h2>
        <p class="dash-admin-note">سال‌های agri باز: <?php echo $openAgriYears ? dash_admin_h(implode(', ', $openAgriYears)) : '-'; ?></p>
        <div class="dash-admin-actions">
            <a class="dash-admin-btn primary" target="_blank" href="dash_snap_build.php?confirm=1">ساخت همه باز</a>
            <?php foreach ($openAgriYears as $oy): ?>
                <a class="dash-admin-btn" target="_blank" href="dash_snap_build.php?confirm=1&amp;year=<?php echo dash_admin_h($oy); ?>">ساخت <?php echo dash_admin_h($oy); ?></a>
            <?php endforeach; ?>
        </div>
        <div style="overflow:auto">
            <table class="dash-admin-table">
                <thead><tr><th>سال</th><th>سطح</th><th>ردیف</th><th>ساخت</th></tr></thead>
                <tbody>
                <?php if (!$snapCounts): ?><tr><td colspan="4">خالی</td></tr><?php endif; ?>
                <?php foreach ($snapCounts as $sc): ?>
                    <tr>
                        <td><?php echo dash_admin_h($sc['year_agri']); ?></td>
                        <td><?php echo dash_admin_h($sc['level_code']); ?></td>
                        <td><?php echo dash_admin_h($sc['c']); ?></td>
                        <td><?php echo dash_admin_h(dash_admin_fa_dt($sc['built_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="dash-admin-card">
        <h2>ساخت اسنپ‌شات مسدود</h2>
        <p class="dash-admin-note">
            سال‌های agri مسدود:
            <?php echo $lockedAgriYears ? dash_admin_h(implode(', ', $lockedAgriYears)) : '-'; ?>
            <?php if (!$lockedAgriYears): ?>
                — اول «همگام‌سازی سنوات از b_sal» را بزنید.
            <?php endif; ?>
        </p>
        <div class="dash-admin-actions">
            <a class="dash-admin-btn danger" target="_blank" href="dash_snap_build_locked.php?confirm=1">ساخت همه مسدود</a>
            <?php foreach ($lockedAgriYears as $ly): ?>
                <a class="dash-admin-btn" target="_blank"
                   href="dash_snap_build_locked.php?confirm=1&amp;year=<?php echo dash_admin_h($ly); ?>">
                    ساخت <?php echo dash_admin_h($ly); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div style="overflow:auto">
            <table class="dash-admin-table">
                <thead><tr><th>سال</th><th>سطح</th><th>ردیف</th><th>ساخت</th></tr></thead>
                <tbody>
                <?php if (!$snapLockedCounts): ?><tr><td colspan="4">خالی</td></tr><?php endif; ?>
                <?php foreach ($snapLockedCounts as $sc): ?>
                    <tr>
                        <td><?php echo dash_admin_h($sc['year_agri']); ?></td>
                        <td><?php echo dash_admin_h($sc['level_code']); ?></td>
                        <td><?php echo dash_admin_h($sc['c']); ?></td>
                        <td><?php echo dash_admin_h(dash_admin_fa_dt($sc['built_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="dash-admin-card">
        <h2>آخرین اجراها</h2>
        <div style="overflow:auto">
            <table class="dash-admin-table">
                <thead>
                    <tr>
                        <th>id</th><th>شروع</th><th>پایان</th><th>وضعیت</th>
                        <th>هدف</th><th>سال</th><th>ردیف</th><th>نسخه</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!$runs): ?><tr><td colspan="8">خالی</td></tr><?php endif; ?>
                <?php foreach ($runs as $run): ?>
                    <tr>
                        <td><?php echo dash_admin_h($run['id']); ?></td>
                        <td><?php echo dash_admin_h(dash_admin_fa_dt($run['started_at'])); ?></td>
                        <td><?php echo dash_admin_h(dash_admin_fa_dt($run['finished_at'])); ?></td>
                        <td><?php echo dash_admin_h($run['status']); ?></td>
                        <td><?php echo dash_admin_h($run['target']); ?></td>
                        <td><?php echo dash_admin_h($run['year_agri']); ?></td>
                        <td><?php echo dash_admin_h($run['rows_written']); ?></td>
                        <td><?php echo dash_admin_h($run['source_ver']); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="dash-admin-note">
            Cron خانه + زراعت باز + باغبانی باز:<br>
            <code>0 4 * * * /usr/bin/php /path/to/dash/dash_snap_cron.php &gt;&gt; /var/log/dash_snap_cron.log 2&gt;&amp;1</code>
        </p>
    </section>
</div>
</body>
</html>
