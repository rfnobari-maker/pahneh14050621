<?php
/**
 * Build year-independent beneficiary snapshot (country + ostan).
 *
 * Web (logged-in dash):
 *   /dash/dash_snap_bah_build.php?confirm=1
 *
 * CLI:
 *   php dash_snap_bah_build.php
 */
$SOURCE_VER = 'bah-20260906a';
$isCli = (php_sapi_name() === 'cli');

if ($isCli) {
    require_once dirname(__FILE__) . '/../login/config.php';
    require_once dirname(__FILE__) . '/lib.php';
} else {
    header('Content-Type: text/html; charset=utf-8');
    require_once dirname(__FILE__) . '/auth.php';
    require_once dirname(__FILE__) . '/lib.php';
}

function dash_bah_build_h($s)
{
    return htmlspecialchars($s . '', ENT_QUOTES, 'UTF-8');
}

function dash_bah_build_out($msg, $isCli)
{
    if ($isCli) {
        echo $msg . PHP_EOL;
    } else {
        echo '<pre>' . dash_bah_build_h($msg) . '</pre>';
    }
}

if (!$dbh) {
    dash_bah_build_out('DB connection failed', $isCli);
    exit(1);
}

if (!function_exists('dash_bah_snap_build')) {
    dash_bah_build_out('lib.php is outdated — upload latest dash/lib.php', $isCli);
    exit(1);
}

if (!dash_bah_snap_ensure($dbh)) {
    dash_bah_build_out('Cannot create dash_snap_bah', $isCli);
    exit(1);
}

if (!$isCli) {
    if (!isset($_GET['confirm']) || $_GET['confirm'] !== '1') {
        echo '<p>ساخت اسنپ‌شات بهره‌بردار (کشور و استان) — یک‌بار، بدون سال زراعی.</p>';
        echo '<p><a href="?confirm=1"><strong>اجرا با ?confirm=1</strong></a></p>';
        exit;
    }
}

@set_time_limit(0);
@ini_set('memory_limit', '512M');

dash_bah_build_out('START ver=' . $SOURCE_VER . ' table=dash_snap_bah levels=country,ostan', $isCli);

$started = microtime(true);
$res = dash_bah_snap_build($dbh);
$elapsed = round(microtime(true) - $started, 1);
$ok = !empty($res['ok']);
$status = $ok ? 'ok' : 'fail';

if (!empty($res['errors'])) {
    foreach ($res['errors'] as $err) {
        dash_bah_build_out('ERR ' . $err, $isCli);
    }
}

dash_bah_build_out(
    'DONE status=' . $status
    . ' rows=' . (int) $res['rows']
    . ' total=' . (int) $res['total']
    . ' ms=' . (int) $res['ms']
    . ' sec=' . $elapsed,
    $isCli
);

if (!$isCli) {
    $sample = dash_rows(
        $dbh,
        "SELECT level_code, id_ostan, name_label, bah_total, bah_natural, bah_legal, bah_male, bah_female, built_at
         FROM dash_snap_bah
         ORDER BY level_code ASC, id_ostan ASC",
        array()
    );
    echo '<p>ردیف‌های اسنپ بهره‌بردار:</p>';
    echo '<table border="1" cellpadding="6" cellspacing="0"><tr>';
    echo '<th>level</th><th>ostan</th><th>name</th><th>total</th><th>natural</th><th>legal</th><th>male</th><th>female</th><th>built_at</th></tr>';
    foreach ($sample as $r) {
        echo '<tr>';
        echo '<td>' . dash_bah_build_h($r['level_code']) . '</td>';
        echo '<td>' . dash_bah_build_h($r['id_ostan']) . '</td>';
        echo '<td>' . dash_bah_build_h($r['name_label']) . '</td>';
        echo '<td>' . dash_bah_build_h($r['bah_total']) . '</td>';
        echo '<td>' . dash_bah_build_h($r['bah_natural']) . '</td>';
        echo '<td>' . dash_bah_build_h($r['bah_legal']) . '</td>';
        echo '<td>' . dash_bah_build_h($r['bah_male']) . '</td>';
        echo '<td>' . dash_bah_build_h($r['bah_female']) . '</td>';
        echo '<td>' . dash_bah_build_h($r['built_at']) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

exit($ok ? 0 : 1);
