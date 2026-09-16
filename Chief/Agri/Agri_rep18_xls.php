<?php
@ini_set('zlib.output_compression', '0');
@ini_set('implicit_flush', '1');
@ini_set('memory_limit', '512M');
@set_time_limit(0);
ignore_user_abort(true);
while (ob_get_level() > 0) {
    ob_end_clean();
}

require_once __DIR__ . '/../../lock_ce.php';
require_once __DIR__ . '/../../event.php';
require_once __DIR__ . '/Agri_rep18_inc.php';

$f = agri_rep18_filters();
$prod = agri_rep18_table('Agri_prod', $f['z_sal']);
$agri = agri_rep18_table('Agri', $f['z_sal']);

if ($prod === '' || $agri === '' || $f['mah_name'] === '' || $f['id_ostan'] === '' || $f['id_ostan'] === '-1') {
    header('Content-Type: text/html; charset=utf-8');
    echo '<p style="font-family:Tahoma;text-align:center">پارامترهای گزارش کامل نیست.</p>';
    exit;
}

list($where_sql, $params) = agri_rep18_where($f);
$query = agri_rep18_select_xls($prod, $agri)
    . " WHERE $where_sql"
    . ' GROUP BY p.bah_cod_m, p.id_ostan, p.id_city, p.id_mar, p.no_kesh, a.m_ab'
    . ' ORDER BY p.id_city, p.bah_cod_m, p.no_kesh, a.m_ab';

$mah_label = mah_name($f['mah_name']);
$ostan_label = ostan_name($f['id_ostan']);
$title_line = 'بهره برداران تولید کننده محصول ' . $mah_label
    . ' طی سال زراعی ' . $f['z_sal']
    . ' در استان ' . $ostan_label;

$filename = 'Agri_rep18_' . str_replace('-', '_', $f['z_sal']) . '.xls';

header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('X-Accel-Buffering: no');

if (function_exists('apache_setenv')) {
    @apache_setenv('no-gzip', '1');
}

function agri_rep18_td($v, $as_text)
{
    $v = agri2_h($v);
    if ($as_text) {
        return '<td style="mso-number-format:\'\\@\'" align="center">' . $v . '</td>';
    }
    return '<td align="center">' . $v . '</td>';
}

function agri_rep18_tr($cells)
{
    echo '<tr>';
    foreach ($cells as $cell) {
        echo agri_rep18_td($cell[0], !empty($cell[1]));
    }
    echo "</tr>\r\n";
}

echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel">';
echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo '<style>td,th{font-family:Tahoma;font-size:11pt;white-space:nowrap} th{background:#999;font-weight:bold}</style>';
echo '</head><body>';
echo '<p align="center" style="font-family:Tahoma;font-size:14pt">' . agri2_h($title_line) . '</p>';
echo '<table border="1" cellpadding="2" cellspacing="0">';
echo '<tr>';
$headers = array(
    'شماره همراه مروج',
    'کد ملی مروج',
    'نام مروج',
    'عملکرد تن در هکتار',
    'میزان تولید / تن',
    'سطح برداشت / هکتار',
    'پیش بینی تولید / تن',
    'سطح زیر کشت / هکتار',
    'کد نوع کشت',
    'نوع کشت',
    'نام پدر',
    'شماره همراه',
    'کد ملی',
    'نام و نام خانوادگی',
    'تاریخ ثبت',
    'کد منبع آبی',
    'نام منبع آبی',
    'مرکز جهاد کشاورزی',
    'کد مرکز',
    'شهرستان',
    'کد شهرستان',
    'استان',
    'کد استان',
    'ردیف'
);
foreach ($headers as $h) {
    echo '<th>' . agri2_h($h) . '</th>';
}
echo "</tr>\r\n";
flush();

if (defined('PDO::MYSQL_ATTR_USE_BUFFERED_QUERY')) {
    $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
}

$stmt = $dbh->prepare($query);
$stmt->execute($params);

$r = 1;
$flushed = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $zk = isset($row['zk']) ? (float) $row['zk'] : 0;
    $sb = isset($row['sb']) ? (float) $row['sb'] : 0;
    $mtol = isset($row['mtol']) ? (float) $row['mtol'] : 0;
    $mtol_p = isset($row['mtol_p']) ? (float) $row['mtol_p'] : 0;
    $yield = agri_rep18_yield($mtol, $sb);
    agri_rep18_tr(array(
        array(isset($row['mor_tel']) ? $row['mor_tel'] : '', true),
        array(isset($row['mor_cod_m']) ? $row['mor_cod_m'] : '', true),
        array(agri_rep18_join_name(isset($row['mor_ln']) ? $row['mor_ln'] : '', isset($row['mor_n']) ? $row['mor_n'] : ''), false),
        array($yield === '' ? '' : $yield, false),
        array(round($mtol, 2), false),
        array(round($sb, 2), false),
        array(round($mtol_p, 2), false),
        array(round($zk, 2), false),
        array(isset($row['no_kesh']) ? $row['no_kesh'] : '', true),
        array(agri_rep18_no_kesh_name(isset($row['no_kesh']) ? $row['no_kesh'] : ''), false),
        array(isset($row['bah_fn']) ? $row['bah_fn'] : '', false),
        array(isset($row['bah_tel']) ? $row['bah_tel'] : '', true),
        array(isset($row['bah_cod_m']) ? $row['bah_cod_m'] : '', true),
        array(agri_rep18_join_name(isset($row['bah_ln']) ? $row['bah_ln'] : '', isset($row['bah_n']) ? $row['bah_n'] : ''), false),
        array(isset($row['date_s']) ? $row['date_s'] : '', true),
        array(isset($row['m_ab']) ? $row['m_ab'] : '', true),
        array(agri_rep18_m_ab_name(isset($row['m_ab']) ? $row['m_ab'] : ''), false),
        array(isset($row['mar_name']) ? $row['mar_name'] : '', false),
        array(isset($row['id_mar']) ? $row['id_mar'] : '', true),
        array(isset($row['city_name']) ? $row['city_name'] : '', false),
        array(isset($row['id_city']) ? $row['id_city'] : '', true),
        array(isset($row['ostan_name']) ? $row['ostan_name'] : '', false),
        array(isset($row['id_ostan']) ? $row['id_ostan'] : '', true),
        array($r, false)
    ));
    $r++;
    $flushed++;
    if ($flushed >= 150) {
        $flushed = 0;
        flush();
    }
}
$stmt->closeCursor();

echo '</table></body></html>';
flush();
exit;
