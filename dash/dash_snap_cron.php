<?php
/**
 * CLI cron: rebuild dash_snap_open for agri OPEN years only.
 *
 * Crontab (server local time 04:00):
 *   0 4 * * * /usr/bin/php /path/to/dash/dash_snap_cron.php >> /var/log/dash_snap_cron.log 2>&1
 *
 * Optional year:
 *   php dash_snap_cron.php 1405
 */
if (php_sapi_name() !== 'cli') {
    header('HTTP/1.1 403 Forbidden');
    echo "CLI only\n";
    exit(1);
}

$SOURCE_VER = 'cron-20260905f';
$AGRI_VER = 'agri-20260906a';
$GARDEN_VER = 'garden-20260909a';
require_once dirname(__FILE__) . '/../login/config.php';
require_once dirname(__FILE__) . '/lib.php';
require_once dirname(__FILE__) . '/lib_agri.php';
require_once dirname(__FILE__) . '/lib_garden.php';

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
    if (in_array($yearFilter, $years, true)) {
        $years = array($yearFilter);
    } else {
        echo date('c') . " Year $yearFilter is not an open agri year. Skip house/agri.\n";
        $years = array();
    }
}

$ok = true;
$agriOk = true;
if (!$years) {
    echo date('c') . " No open agri years. Skip house/agri.\n";
} else {
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

$agriOk = true;
if (function_exists('dash_agri_snap_ensure') && dash_agri_snap_ensure($dbh)) {
    $agriRunId = 0;
    try {
        $stmt = $dbh->prepare(
            "INSERT INTO dash_snap_run (started_at, status, target, year_agri, rows_written, source_ver)
             VALUES (NOW(), 'running', 'open', ?, 0, ?)"
        );
        $stmt->execute(array($yearFilter !== '' ? $yearFilter : null, $AGRI_VER));
        $agriRunId = (int) $dbh->lastInsertId();
    } catch (Exception $e) {
        fwrite(STDERR, "dash_snap_run agri insert failed: " . $e->getMessage() . "\n");
    }
    $agriRows = 0;
    $agriErrors = array();
    $agriStart = microtime(true);
    echo date('c') . " START agri open years=" . implode(',', $years) . "\n";
    foreach ($years as $year) {
        echo date('c') . " Building agri $year ...\n";
        $GLOBALS['dash_agri_snap_last_error'] = '';
        $res = dash_agri_snap_build_year($dbh, $year, $AGRI_VER, 'dash_snap_agri_open');
        $agriRows += (int) $res['rows'];
        if (!empty($res['errors'])) {
            $agriErrors = array_merge($agriErrors, $res['errors']);
            foreach ($res['errors'] as $err) {
                echo "ERR agri $year: $err\n";
            }
        }
        echo date('c') . " Agri $year rows=" . $res['rows']
            . " country=" . (isset($res['country']) ? $res['country'] : 0)
            . " ostan=" . (isset($res['ostan']) ? $res['ostan'] : 0) . "\n";
    }
    $agriElapsed = round(microtime(true) - $agriStart, 1);
    $agriOk = empty($agriErrors);
    $agriStatus = $agriOk ? 'ok' : 'fail';
    $agriErrText = $agriOk ? null : implode(' | ', array_slice($agriErrors, 0, 30));
    if ($agriRunId > 0) {
        try {
            $stmt = $dbh->prepare(
                "UPDATE dash_snap_run
                 SET finished_at = NOW(), status = ?, rows_written = ?, error_text = ?
                 WHERE id = ?"
            );
            $stmt->execute(array($agriStatus, $agriRows, $agriErrText, $agriRunId));
        } catch (Exception $e) {
        }
    }
    echo date('c') . " DONE agri status=$agriStatus rows=$agriRows sec=$agriElapsed run_id=$agriRunId\n";
}
}

$gardenOk = true;
$gardenYears = dash_open_years($dbh, array('garden'));
if ($yearFilter !== '') {
    if (in_array($yearFilter, $gardenYears, true)) {
        $gardenYears = array($yearFilter);
    } else {
        $gardenYears = array();
    }
}
if ($gardenYears && function_exists('dash_garden_snap_ensure') && dash_garden_snap_ensure($dbh)) {
    $gardenRunId = 0;
    try {
        $stmt = $dbh->prepare(
            "INSERT INTO dash_snap_run (started_at, status, target, year_agri, rows_written, source_ver)
             VALUES (NOW(), 'running', 'open', ?, 0, ?)"
        );
        $stmt->execute(array($yearFilter !== '' ? $yearFilter : null, $GARDEN_VER));
        $gardenRunId = (int) $dbh->lastInsertId();
    } catch (Exception $e) {
        fwrite(STDERR, "dash_snap_run garden insert failed: " . $e->getMessage() . "\n");
    }
    $gardenRows = 0;
    $gardenErrors = array();
    $gardenStart = microtime(true);
    echo date('c') . " START garden open years=" . implode(',', $gardenYears) . "\n";
    foreach ($gardenYears as $year) {
        echo date('c') . " Building garden $year ...\n";
        $GLOBALS['dash_garden_snap_last_error'] = '';
        $res = dash_garden_snap_build_year($dbh, $year, $GARDEN_VER, 'dash_snap_garden_open');
        $gardenRows += (int) $res['rows'];
        if (!empty($res['errors'])) {
            $gardenErrors = array_merge($gardenErrors, $res['errors']);
            foreach ($res['errors'] as $err) {
                echo "ERR garden $year: $err\n";
            }
        }
        echo date('c') . " Garden $year rows=" . $res['rows']
            . " country=" . (isset($res['country']) ? $res['country'] : 0)
            . " ostan=" . (isset($res['ostan']) ? $res['ostan'] : 0) . "\n";
    }
    $gardenElapsed = round(microtime(true) - $gardenStart, 1);
    $gardenOk = empty($gardenErrors);
    $gardenStatus = $gardenOk ? 'ok' : 'fail';
    $gardenErrText = $gardenOk ? null : implode(' | ', array_slice($gardenErrors, 0, 30));
    if ($gardenRunId > 0) {
        try {
            $stmt = $dbh->prepare(
                "UPDATE dash_snap_run
                 SET finished_at = NOW(), status = ?, rows_written = ?, error_text = ?
                 WHERE id = ?"
            );
            $stmt->execute(array($gardenStatus, $gardenRows, $gardenErrText, $gardenRunId));
        } catch (Exception $e) {
        }
    }
    echo date('c') . " DONE garden status=$gardenStatus rows=$gardenRows sec=$gardenElapsed run_id=$gardenRunId\n";
}

exit(($ok && $agriOk && $gardenOk) ? 0 : 1);
