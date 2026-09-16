<?php
/**
 * Build dash_snap_garden_locked — country + ostan × product for locked garden years.
 *
 *   /dash/dash_snap_garden_build_locked.php?confirm=1
 *   /dash/dash_snap_garden_build_locked.php?confirm=1&year=1404
 *
 *   php dash_snap_garden_build_locked.php
 *   php dash_snap_garden_build_locked.php 1404
 */
$SOURCE_VER = 'garden-l-20260909a';
$isCli = (php_sapi_name() === 'cli');

if ($isCli) {
    require_once dirname(__FILE__) . '/../login/config.php';
    require_once dirname(__FILE__) . '/lib.php';
    require_once dirname(__FILE__) . '/lib_garden.php';
} else {
    header('Content-Type: text/html; charset=utf-8');
    require_once dirname(__FILE__) . '/auth.php';
    require_once dirname(__FILE__) . '/lib.php';
    require_once dirname(__FILE__) . '/lib_garden.php';
}

function dash_garden_locked_h($s)
{
    return htmlspecialchars($s . '', ENT_QUOTES, 'UTF-8');
}

function dash_garden_locked_out($msg, $isCli)
{
    if ($isCli) {
        echo $msg . PHP_EOL;
    } else {
        echo '<pre>' . dash_garden_locked_h($msg) . '</pre>';
    }
}

if (!$dbh) {
    dash_garden_locked_out('DB connection failed', $isCli);
    exit(1);
}

if (!function_exists('dash_garden_snap_build_year')) {
    dash_garden_locked_out('lib_garden.php is outdated — upload latest dash/lib_garden.php', $isCli);
    exit(1);
}

if (!dash_garden_snap_ensure($dbh)) {
    dash_garden_locked_out('Cannot ensure dash_snap_garden_locked', $isCli);
    exit(1);
}

if (function_exists('dash_snap_ensure_tables')) {
    dash_snap_ensure_tables($dbh);
}

if (!$isCli) {
    if (!isset($_GET['confirm']) || $_GET['confirm'] !== '1') {
        echo '<p>ساخت اسنپ‌شات باغبانی مسدود (کشور و استان × محصول).</p>';
        echo '<p><a href="?confirm=1"><strong>اجرا با ?confirm=1</strong></a> (همهٔ سال‌های مسدود)</p>';
        echo '<p>اختیاری: <code>?confirm=1&amp;year=1404</code></p>';
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

$years = dash_garden_locked_years_or_fallback($dbh);
if ($yearFilter !== '') {
    $years = array($yearFilter);
}

if (!$years) {
    dash_garden_locked_out('No locked garden years found. Sync year status, or pass &year=1404', $isCli);
    exit(1);
}

$runId = 0;
try {
    $stmt = $dbh->prepare(
        "INSERT INTO dash_snap_run (started_at, status, target, year_agri, rows_written, source_ver)
         VALUES (NOW(), 'running', 'locked', ?, 0, ?)"
    );
    $stmt->execute(array($yearFilter !== '' ? $yearFilter : null, $SOURCE_VER));
    $runId = (int) $dbh->lastInsertId();
} catch (Exception $e) {
    dash_garden_locked_out('Cannot write dash_snap_run: ' . $e->getMessage(), $isCli);
}

$totalRows = 0;
$allErrors = array();
$started = microtime(true);

dash_garden_locked_out(
    'START ver=' . $SOURCE_VER . ' table=dash_snap_garden_locked years=' . implode(',', $years),
    $isCli
);

foreach ($years as $year) {
    dash_garden_locked_out('Building locked garden year ' . $year . ' ...', $isCli);
    $GLOBALS['dash_garden_snap_last_error'] = '';
    $res = dash_garden_snap_build_year($dbh, $year, $SOURCE_VER, 'dash_snap_garden_locked');
    $totalRows += (int) $res['rows'];
    if (!empty($res['errors'])) {
        $allErrors = array_merge($allErrors, $res['errors']);
        foreach ($res['errors'] as $err) {
            dash_garden_locked_out('ERR ' . $year . ': ' . $err, $isCli);
        }
    }
    dash_garden_locked_out(
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

dash_garden_locked_out(
    'DONE status=' . $status . ' rows=' . $totalRows . ' sec=' . $elapsed . ' run_id=' . $runId,
    $isCli
);

exit($ok ? 0 : 1);
