<?php
/**
 * Build dash_snap_locked — same usage pattern as dash_snap_build.php
 *
 *   /Chief/dash_snap_build_locked.php?confirm=1
 *   /Chief/dash_snap_build_locked.php?confirm=1&year=1403
 *
 *   php dash_snap_build_locked.php
 *   php dash_snap_build_locked.php 1403
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');

$SOURCE_VER = 'locked-20260905e';
$isCli = (php_sapi_name() === 'cli');

if ($isCli) {
    require_once dirname(__FILE__) . '/../login/config.php';
    require_once dirname(__FILE__) . '/dash_mgmt_lib.php';
} else {
    header('Content-Type: text/html; charset=utf-8');
    $dash_any_access = true; // TEMP: no S_access lock
    require_once dirname(__FILE__) . '/dash_mgmt_auth.php';
    require_once dirname(__FILE__) . '/dash_mgmt_lib.php';
}

function dash_locked_h($s)
{
    return htmlspecialchars($s . '', ENT_QUOTES, 'UTF-8');
}

function dash_locked_out($msg, $isCli)
{
    if ($isCli) {
        echo $msg . PHP_EOL;
    } else {
        echo '<pre>' . dash_locked_h($msg) . '</pre>';
    }
}

if (!$dbh) {
    dash_locked_out('DB connection failed', $isCli);
    exit(1);
}

if (!function_exists('dash_snap_build_locked_levels')) {
    dash_locked_out('dash_mgmt_lib.php is outdated — upload latest dash_mgmt_lib.php', $isCli);
    exit(1);
}

if (!dash_snap_ensure_tables($dbh)) {
    dash_locked_out('Cannot ensure dash_snap_locked / dash_snap_run tables exist', $isCli);
    exit(1);
}

if (!$isCli) {
    if (!isset($_GET['confirm']) || $_GET['confirm'] !== '1') {
        echo '<p>Build locked snapshots into <code>dash_snap_locked</code>.</p>';
        echo '<p><a href="?confirm=1"><strong>Run ?confirm=1</strong></a> (all locked years)</p>';
        echo '<p>Optional: <code>?confirm=1&amp;year=1403</code></p>';
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

// Same rule as open build: explicit year wins; else all locked (with fallback)
$years = dash_locked_years_or_fallback($dbh);
if ($yearFilter !== '') {
    $years = array($yearFilter);
}

if (!$years) {
    dash_locked_out('No locked agri years found. Sync year status, or pass &year=1403', $isCli);
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
    dash_locked_out('Cannot write dash_snap_run: ' . $e->getMessage(), $isCli);
}

$totalRows = 0;
$totalCities = 0;
$allErrors = array();
$started = microtime(true);

dash_locked_out('START ver=' . $SOURCE_VER . ' table=dash_snap_locked years=' . implode(',', $years), $isCli);

foreach ($years as $year) {
    dash_locked_out('Building locked year ' . $year . ' ...', $isCli);
    $GLOBALS['dash_snap_last_error'] = '';
    $res = dash_snap_build_locked_levels($dbh, $year, $SOURCE_VER, true);
    $totalRows += (int) $res['rows'];
    $totalCities += isset($res['cities']) ? (int) $res['cities'] : 0;
    if (!empty($res['errors'])) {
        $allErrors = array_merge($allErrors, $res['errors']);
        foreach ($res['errors'] as $err) {
            dash_locked_out('ERR ' . $year . ': ' . $err, $isCli);
        }
    }
    dash_locked_out(
        'Year ' . $year . ' rows=' . $res['rows'] . ' cities=' . (isset($res['cities']) ? $res['cities'] : 0),
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

dash_locked_out(
    'DONE status=' . $status . ' rows=' . $totalRows . ' cities=' . $totalCities . ' sec=' . $elapsed . ' run_id=' . $runId,
    $isCli
);

exit($ok ? 0 : 1);
