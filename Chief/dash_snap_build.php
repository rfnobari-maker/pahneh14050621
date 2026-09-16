<?php
/**
 * Build dash_snap_open for country + ostan + city (open agri years).
 *
 * Web (logged-in dash admin):
 *   /Chief/dash_snap_build.php?confirm=1
 *   optional: &year=1405
 *
 * CLI:
 *   php dash_snap_build.php
 *   php dash_snap_build.php 1405
 */
$SOURCE_VER = '20260905e';
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

function dash_build_h($s)
{
    return htmlspecialchars($s . '', ENT_QUOTES, 'UTF-8');
}

function dash_build_out($msg, $isCli)
{
    if ($isCli) {
        echo $msg . PHP_EOL;
    } else {
        echo '<pre>' . dash_build_h($msg) . '</pre>';
    }
}

if (!$dbh) {
    dash_build_out('DB connection failed', $isCli);
    exit(1);
}

if (!dash_snap_ensure_tables($dbh)) {
    dash_build_out('Cannot ensure dash_snap_open tables / extra_text column', $isCli);
    exit(1);
}

if (!$isCli) {
    if (!isset($_GET['confirm']) || $_GET['confirm'] !== '1') {
        echo '<p>Build country + ostan + city snapshots for open years.</p>';
        echo '<p><a href="?confirm=1"><strong>Run ?confirm=1</strong></a></p>';
        echo '<p>Optional: <code>?confirm=1&amp;year=1405</code></p>';
        echo '<p>Note: city level can take a long time.</p>';
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
    dash_build_out('No open agri years in dash_year_status', $isCli);
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
    dash_build_out('Cannot write dash_snap_run: ' . $e->getMessage(), $isCli);
}

$totalRows = 0;
$totalCities = 0;
$allErrors = array();
$started = microtime(true);

dash_build_out('START ver=' . $SOURCE_VER . ' levels=country,ostan,city years=' . implode(',', $years), $isCli);

foreach ($years as $year) {
    dash_build_out('Building year ' . $year . ' ...', $isCli);
    $res = dash_snap_build_open_levels($dbh, $year, $SOURCE_VER, true);
    $totalRows += (int) $res['rows'];
    $totalCities += isset($res['cities']) ? (int) $res['cities'] : 0;
    if (!empty($res['errors'])) {
        $allErrors = array_merge($allErrors, $res['errors']);
        foreach ($res['errors'] as $err) {
            dash_build_out('ERR ' . $year . ': ' . $err, $isCli);
        }
    }
    dash_build_out(
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

dash_build_out(
    'DONE status=' . $status . ' rows=' . $totalRows . ' cities=' . $totalCities . ' sec=' . $elapsed . ' run_id=' . $runId,
    $isCli
);

if (!$isCli && $ok) {
    echo '<p>Sample city rows:</p>';
    $sample = dash_rows(
        $dbh,
        "SELECT year_agri, level_code, id_ostan, id_city, name_label, cnt_agri, cnt_garden, built_at
         FROM dash_snap_open
         WHERE level_code = 'city'
         ORDER BY year_agri DESC, id_ostan ASC, id_city ASC
         LIMIT 20",
        array()
    );
    echo '<table border="1" cellpadding="6" cellspacing="0"><tr>';
    echo '<th>year</th><th>level</th><th>ostan</th><th>city</th><th>name</th><th>agri</th><th>garden</th><th>built_at</th></tr>';
    foreach ($sample as $r) {
        echo '<tr>';
        echo '<td>' . dash_build_h($r['year_agri']) . '</td>';
        echo '<td>' . dash_build_h($r['level_code']) . '</td>';
        echo '<td>' . dash_build_h($r['id_ostan']) . '</td>';
        echo '<td>' . dash_build_h($r['id_city']) . '</td>';
        echo '<td>' . dash_build_h($r['name_label']) . '</td>';
        echo '<td>' . dash_build_h($r['cnt_agri']) . '</td>';
        echo '<td>' . dash_build_h($r['cnt_garden']) . '</td>';
        echo '<td>' . dash_build_h($r['built_at']) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

exit($ok ? 0 : 1);
