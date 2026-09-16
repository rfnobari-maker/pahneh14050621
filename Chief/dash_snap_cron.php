<?php
/**
 * CLI cron: rebuild dash_snap_open for agri OPEN years only.
 *
 * Crontab (server local time 04:00):
 *   0 4 * * * /usr/bin/php /path/to/Chief/dash_snap_cron.php >> /var/log/dash_snap_cron.log 2>&1
 *
 * Optional year:
 *   php dash_snap_cron.php 1405
 */
if (php_sapi_name() !== 'cli') {
    header('HTTP/1.1 403 Forbidden');
    echo "CLI only\n";
    exit(1);
}

$SOURCE_VER = 'cron-20260905e';
require_once dirname(__FILE__) . '/../login/config.php';
require_once dirname(__FILE__) . '/dash_mgmt_lib.php';

if (!$dbh) {
    fwrite(STDERR, "DB connection failed\n");
    exit(1);
}

@set_time_limit(0);
@ini_set('memory_limit', '512M');

$yearFilter = '';
if (isset($argv[1]) && preg_match('/^(13|14)\d{2}$/', $argv[1])) {
    $yearFilter = $argv[1];
}

$years = dash_open_years($dbh, array('agri'));
if ($yearFilter !== '') {
    if (!in_array($yearFilter, $years, true)) {
        fwrite(STDERR, "Year $yearFilter is not open in dash_year_status (agri)\n");
        exit(1);
    }
    $years = array($yearFilter);
}

if (!$years) {
    echo date('c') . " No open agri years. Skip.\n";
    exit(0);
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
    fwrite(STDERR, "dash_snap_run insert failed: " . $e->getMessage() . "\n");
}

$totalRows = 0;
$allErrors = array();
$started = microtime(true);
echo date('c') . " START open years=" . implode(',', $years) . "\n";

foreach ($years as $year) {
    echo date('c') . " Building $year ...\n";
    $res = dash_snap_build_open_levels($dbh, $year, $SOURCE_VER, true);
    $totalRows += (int) $res['rows'];
    if (!empty($res['errors'])) {
        $allErrors = array_merge($allErrors, $res['errors']);
        foreach ($res['errors'] as $err) {
            echo "ERR $year: $err\n";
        }
    }
    echo date('c') . " Year $year rows=" . $res['rows'] . " cities=" . (isset($res['cities']) ? $res['cities'] : 0) . "\n";
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

echo date('c') . " DONE status=$status rows=$totalRows sec=$elapsed run_id=$runId\n";
exit($ok ? 0 : 1);
