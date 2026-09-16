<?php
/**
 * Build dash_snap_agri_open — country + ostan × product for open agri years.
 *
 * Web (logged-in dash):
 *   /dash/dash_snap_agri_build.php?confirm=1
 *   optional: &year=1405
 *
 * CLI:
 *   php dash_snap_agri_build.php
 *   php dash_snap_agri_build.php 1405
 */
$SOURCE_VER = 'agri-20260906a';
$isCli = (php_sapi_name() === 'cli');

if ($isCli) {
    require_once dirname(__FILE__) . '/../login/config.php';
    require_once dirname(__FILE__) . '/lib.php';
    require_once dirname(__FILE__) . '/lib_agri.php';
} else {
    header('Content-Type: text/html; charset=utf-8');
    require_once dirname(__FILE__) . '/auth.php';
    require_once dirname(__FILE__) . '/lib.php';
    require_once dirname(__FILE__) . '/lib_agri.php';
}

function dash_agri_build_h($s)
{
    return htmlspecialchars($s . '', ENT_QUOTES, 'UTF-8');
}

function dash_agri_build_out($msg, $isCli)
{
    if ($isCli) {
        echo $msg . PHP_EOL;
    } else {
        echo '<pre>' . dash_agri_build_h($msg) . '</pre>';
    }
}

if (!$dbh) {
    dash_agri_build_out('DB connection failed', $isCli);
    exit(1);
}

if (!function_exists('dash_agri_snap_build_year')) {
    dash_agri_build_out('lib_agri.php is outdated — upload latest dash/lib_agri.php', $isCli);
    exit(1);
}

if (!dash_agri_snap_ensure($dbh)) {
    dash_agri_build_out('Cannot ensure dash_snap_agri_open / dash_snap_agri_locked', $isCli);
    exit(1);
}

if (function_exists('dash_snap_ensure_tables')) {
    dash_snap_ensure_tables($dbh);
}

if (!$isCli) {
    if (!isset($_GET['confirm']) || $_GET['confirm'] !== '1') {
        echo '<p>ساخت اسنپ‌شات زراعت (کشور و استان × محصول) برای سال‌های باز.</p>';
        echo '<p><a href="?confirm=1"><strong>اجرا با ?confirm=1</strong></a></p>';
        echo '<p>اختیاری: <code>?confirm=1&amp;year=1405</code></p>';
        exit;
    }
}

@set_time_limit(0);
@ini_set('memory_limit', '512M');

$yearFilter = '';
if ($isCli && isset($argv[1]) && preg_match('/^(13|14)\d{2}$/', $argv[1])) {
    $yearFilter = $argv[1];
} elseif (!$isCli && isset($_GET['year']) && preg_match('/^(13|14)\d{2}$/', $_GET['year'])) {
    $yearFilter = $_GET['year'];
}

$years = dash_open_years($dbh, array('agri'));
if ($yearFilter !== '') {
    $years = array($yearFilter);
}

if (!$years) {
    dash_agri_build_out('No open agri years in dash_year_status', $isCli);
    exit(1);
}

$runId = 0;
try {
    $stmt = $dbh->prepare(
        "INSERT INTO dash_snap_run (started_at, status, target, year_agri, rows_written, source_ver)
         VALUES (NOW(), 'running', 'open', ?, 0, ?)"
    );
    $stmt->execute(array($yearFilter !== '' ? $yearFilter : null, $SOURCE_VER));
    $runId = (int) $dbh->lastInsertId();
} catch (Exception $e) {
    dash_agri_build_out('Cannot write dash_snap_run: ' . $e->getMessage(), $isCli);
}

$totalRows = 0;
$allErrors = array();
$started = microtime(true);

dash_agri_build_out(
    'START ver=' . $SOURCE_VER . ' table=dash_snap_agri_open levels=country,ostan years=' . implode(',', $years),
    $isCli
);

foreach ($years as $year) {
    dash_agri_build_out('Building agri year ' . $year . ' ...', $isCli);
    $GLOBALS['dash_agri_snap_last_error'] = '';
    $res = dash_agri_snap_build_year($dbh, $year, $SOURCE_VER, 'dash_snap_agri_open');
    $totalRows += (int) $res['rows'];
    if (!empty($res['errors'])) {
        $allErrors = array_merge($allErrors, $res['errors']);
        foreach ($res['errors'] as $err) {
            dash_agri_build_out('ERR ' . $year . ': ' . $err, $isCli);
        }
    }
    dash_agri_build_out(
        'Year ' . $year . ' rows=' . $res['rows']
        . ' country=' . (isset($res['country']) ? $res['country'] : 0)
        . ' ostan=' . (isset($res['ostan']) ? $res['ostan'] : 0),
        $isCli
    );
}

$elapsed = round(microtime(true) - $started, 1);
$ok = empty($allErrors);
$status = $ok ? 'ok' : 'fail';
$errorText = $ok ? null : implode(' | ', array_slice($allErrors, 0, 30));

if ($runId > 0) {
    try {
        $stmt = $dbh->prepare(
            "UPDATE dash_snap_run
             SET finished_at = NOW(), status = ?, rows_written = ?, error_text = ?
             WHERE id = ?"
        );
        $stmt->execute(array($status, $totalRows, $errorText, $runId));
    } catch (Exception $e) {
    }
}

dash_agri_build_out(
    'DONE status=' . $status . ' rows=' . $totalRows . ' sec=' . $elapsed . ' run_id=' . $runId,
    $isCli
);

if (!$isCli && $ok) {
    $sample = dash_rows(
        $dbh,
        "SELECT year_agri, level_code, id_ostan, product_cod, group_cod,
                plant_abi, plant_dim, plan_abi, plan_dim, built_at
         FROM dash_snap_agri_open
         WHERE level_code = 'country'
         ORDER BY year_agri DESC, plant_abi DESC
         LIMIT 20",
        array()
    );
    echo '<p>نمونه ردیف کشور:</p>';
    echo '<table border="1" cellpadding="6" cellspacing="0"><tr>';
    echo '<th>year</th><th>level</th><th>product</th><th>group</th><th>plant_abi</th><th>plant_dim</th><th>plan_abi</th><th>built_at</th></tr>';
    foreach ($sample as $r) {
        echo '<tr>';
        echo '<td>' . dash_agri_build_h($r['year_agri']) . '</td>';
        echo '<td>' . dash_agri_build_h($r['level_code']) . '</td>';
        echo '<td>' . dash_agri_build_h($r['product_cod']) . '</td>';
        echo '<td>' . dash_agri_build_h($r['group_cod']) . '</td>';
        echo '<td>' . dash_agri_build_h($r['plant_abi']) . '</td>';
        echo '<td>' . dash_agri_build_h($r['plant_dim']) . '</td>';
        echo '<td>' . dash_agri_build_h($r['plan_abi']) . '</td>';
        echo '<td>' . dash_agri_build_h($r['built_at']) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

exit($ok ? 0 : 1);
