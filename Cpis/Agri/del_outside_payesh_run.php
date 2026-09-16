<?php
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../../Jalali.php');
require_once('../../login/config.php');
date_default_timezone_set('Asia/Tehran');
set_time_limit(25);
@ini_set('max_execution_time', '25');
@ini_set('default_socket_timeout', '3');
@ini_set('memory_limit', '256M');

if (!isset($login_session) || $login_session === '') {
    return;
}

function doph_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function doph_product_map($z_sal)
{
    if ($z_sal !== '1404-1405') {
        return array();
    }
    return array(
        '103' => '102', '107' => '106', '176' => '490', '178' => '490', '180' => '490', '182' => '490', '184' => '490',
        '186' => '490', '188' => '490', '190' => '490', '192' => '490', '194' => '490', '196' => '490', '198' => '490', '200' => '490',
        '414' => '490', '416' => '490', '418' => '490', '420' => '490', '422' => '490', '424' => '490', '426' => '490', '428' => '490',
        '430' => '490', '432' => '490', '434' => '490', '436' => '490', '438' => '490', '440' => '490', '442' => '490', '444' => '490',
        '446' => '490', '448' => '490', '449' => '490', '464' => '490', '150' => '148'
    );
}

function doph_map_join($z_sal)
{
    $map = doph_product_map($z_sal);
    if (empty($map)) {
        return array('join' => '', 'parent_col' => 'NULL');
    }
    $parts = array();
    foreach ($map as $child => $parent) {
        $parts[] = 'SELECT ' . (int) $child . ' AS child_cod, ' . (int) $parent . ' AS parent_cod';
    }
    return array(
        'join' => ' LEFT JOIN (' . implode(' UNION ALL ', $parts) . ') doph_map ON doph_map.child_cod = CAST(p.cod_mah AS UNSIGNED) ',
        'parent_col' => 'doph_map.parent_cod'
    );
}

function doph_payesh_label($payesh)
{
    if ($payesh == 2) {
        return 'نهاده اختصاص داده شده — منتقل نشد';
    }
    if ($payesh == 0 || $payesh == -1) {
        return 'ارتباط پایش برقرار نشد — منتقل نشد';
    }
    return 'آزاد برای انتقال';
}

function doph_payesh_check($id, $year, &$client)
{
    if ($id == 3741675) {
        return 2;
    }
    if (!class_exists('SoapClient')) {
        return -1;
    }
    try {
        if ($client === null) {
            $client = new SoapClient('http://172.17.18.14/pahne/pahneservice.asmx?WSDL', array(
                'connection_timeout' => 3,
                'cache_wsdl' => WSDL_CACHE_BOTH,
                'keep_alive' => true,
                'exceptions' => true
            ));
        }
        $res = $client->CheckEditorDeletePermission(array(
            'Username' => 'test',
            'Password' => 'test',
            'type' => 0,
            'year' => $year,
            'AreaID' => $id
        ));
        if (isset($res->CheckEditorDeletePermissionResult->EditPermission)) {
            return (int)$res->CheckEditorDeletePermissionResult->EditPermission;
        }
        return 0;
    } catch (Exception $e) {
        $client = null;
        return -1;
    }
}

if (!isset($z_sal) || !isset($Agri_prod_table) || !isset($Agri_table) || !isset($Agri_prod_archive)) {
    echo 'پیکربندی سال زراعی ناقص است.';
    return;
}
if (!isset($payesh_year)) {
    $payesh_year = substr($z_sal, 0, 4);
}
if (!isset($page_title)) {
    $page_title = 'انتقال محصولات خارج از برش ' . $z_sal;
}

$date_edit = jdate('Y/m/d');
$time = date('H:i:s');
$do_move = (isset($_POST['action']) && $_POST['action'] === 'move');
$list_after = isset($_GET['after']) ? (int)$_GET['after'] : 0;
$move_after = isset($_POST['move_after']) ? (int)$_POST['move_after'] : 0;
$f_ostan = 0;
if (isset($_POST['f_ostan'])) {
    $f_ostan = (int)$_POST['f_ostan'];
} elseif (isset($_GET['f_ostan'])) {
    $f_ostan = (int)$_GET['f_ostan'];
}

$list_size = 80;
$move_size = 5;
$has_map = (doph_product_map($z_sal) !== array());
$map_join = doph_map_join($z_sal);
$parent_col = $map_join['parent_col'];
$sess_key = 'doph_' . str_replace('-', '_', $z_sal) . '_' . $f_ostan;

$ostan_list = array();
$ostan_name = '';
try {
    $ostan_list = $dbh->query("SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($ostan_list as $o) {
        if ((int)$o['id_ostan'] === $f_ostan) {
            $ostan_name = $o['ostan'];
            break;
        }
    }
} catch (Exception $e) {
    $ostan_list = array();
}

if ($f_ostan < 1 || $ostan_name === '') {
    $f_ostan = 0;
    $ostan_name = '';
}

if ($f_ostan > 0 && (!isset($_SESSION[$sess_key]) || (!$do_move && $list_after === 0))) {
    $_SESSION[$sess_key] = array(
        'moved' => 0,
        'skipped' => 0
    );
}

$where_out = "
    p.id_ostan = :f_ostan
    AND (
        NOT EXISTS (
            SELECT 1 FROM Agri_ab_mar x
            WHERE x.id_ostan = p.id_ostan
              AND x.id_city  = p.id_city
              AND x.id_mar   = p.id_mar
              AND x.z_sal    = p.z_sal
              AND (x.s_abi > 0 OR x.s_dem > 0)
        )
        OR ab.product_cod IS NULL
        OR (p.no_kesh = 1 AND IFNULL(ab.s_abi,0) <= 0)
        OR (p.no_kesh = 2 AND IFNULL(ab.s_dem,0) <= 0)
    )
";
if ($has_map) {
    $where_out .= "
    AND NOT EXISTS (
        SELECT 1 FROM Agri_ab_mar abm
        WHERE abm.z_sal = p.z_sal
          AND abm.id_ostan = p.id_ostan
          AND abm.id_city  = p.id_city
          AND abm.id_mar   = p.id_mar
          AND $parent_col IS NOT NULL
          AND CAST(abm.product_cod AS UNSIGNED) = $parent_col
          AND (abm.s_abi > 0 OR abm.s_dem > 0)
    )
";
}

$sql_from = "
FROM `$Agri_prod_table` p
LEFT JOIN product_z pz ON pz.product_cod = p.cod_mah
LEFT JOIN ostanname o ON o.id_ostan = p.id_ostan
LEFT JOIN cityname c ON c.id_city = p.id_city AND c.id_ostan = p.id_ostan
LEFT JOIN mar m ON m.id_mar = p.id_mar
LEFT JOIN Agri_ab_mar ab
       ON ab.z_sal = p.z_sal
      AND ab.id_ostan = p.id_ostan
      AND ab.id_city  = p.id_city
      AND ab.id_mar   = p.id_mar
      AND ab.product_cod = p.cod_mah
{$map_join['join']}
WHERE $where_out
";

$sql_cols = "
    p.id,
    p.Agri_id,
    p.z_sal,
    p.bah_cod_m,
    p.cod_mah,
    pz.product_name,
    p.no_kesh,
    (IFNULL(p.zer_kesht_a,0) + IFNULL(p.zer_kesht_b,0)) AS sath_kesht,
    o.ostan,
    c.city,
    m.mar,
    $parent_col AS madar_cod,
    CASE
        WHEN NOT EXISTS (
            SELECT 1 FROM Agri_ab_mar x
            WHERE x.id_ostan = p.id_ostan
              AND x.id_city  = p.id_city
              AND x.id_mar   = p.id_mar
              AND x.z_sal    = p.z_sal
              AND (x.s_abi > 0 OR x.s_dem > 0)
        ) THEN 'بدون برنامه الگوی کشت مرکز'
        WHEN ab.product_cod IS NULL THEN 'محصول در برش مرکز نیست'
        WHEN p.no_kesh = 1 AND IFNULL(ab.s_abi,0) <= 0 THEN 'برش آبی ندارد'
        WHEN p.no_kesh = 2 AND IFNULL(ab.s_dem,0) <= 0 THEN 'برش دیم ندارد'
    END AS noe_khata
";

$moved_batch = 0;
$skipped_batch = 0;
$move_error = '';
$move_done = false;
$need_move_continue = false;
$next_move_after = $move_after;
$rows = array();
$has_more_list = false;
$next_list_after = $list_after;

register_shutdown_function(function () {
    $err = error_get_last();
    if ($err && in_array($err['type'], array(E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR), true)) {
        echo '<p class="msg msg-err">اجرا قطع شد: '
            . doph_h($err['message'] . ' — خط ' . $err['line'])
            . '</p></body></html>';
    }
});

try {
    if ($f_ostan < 1) {
        // فقط فرم استان
    } elseif ($do_move) {
        $_SESSION['last_acted_on'] = time();
        $dbh->exec("CREATE TABLE IF NOT EXISTS `$Agri_prod_archive` LIKE `$Agri_prod_table`");

        $stmt = $dbh->prepare("SELECT $sql_cols $sql_from AND p.id > :after ORDER BY p.id ASC LIMIT " . (int)$move_size);
        $stmt->execute(array(':f_ostan' => $f_ostan, ':after' => $move_after));
        $batch = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($batch)) {
            $move_done = true;
            if ((int)$_SESSION[$sess_key]['moved'] > 0) {
                sabt_event(
                    $login_session,
                    $_SERVER['REMOTE_ADDR'],
                    $date_edit,
                    $time,
                    '',
                    'انتقال محصولات خارج از برش به ' . $Agri_prod_archive . ' /' . $z_sal . '/' . $ostan_name . '/تعداد ' . (int)$_SESSION[$sess_key]['moved'],
                    $id_ostan
                );
            }
        } else {
            $client = null;
            $to_move = array();
            $free_agri = array();
            foreach ($batch as $row) {
                $pid = (int)$row['id'];
                $next_move_after = $pid;
                $payesh = doph_payesh_check($pid, $payesh_year, $client);
                $is_free = ($payesh != 2 && $payesh != 0 && $payesh != -1);
                $row['payesh'] = $payesh;
                $row['is_free'] = $is_free;
                $row['payesh_label'] = doph_payesh_label($payesh);
                $rows[] = $row;
                if ($is_free) {
                    $to_move[] = $pid;
                    $free_agri[$row['Agri_id']] = $row['Agri_id'];
                } else {
                    $skipped_batch++;
                }
            }

            if (!empty($to_move)) {
                $dbh->beginTransaction();
                $id_list = implode(',', array_map('intval', $to_move));
                $dbh->exec("
                    INSERT INTO `$Agri_prod_archive`
                    SELECT p.*
                    FROM `$Agri_prod_table` p
                    WHERE p.id IN ($id_list)
                      AND p.id_ostan = " . (int)$f_ostan . "
                      AND NOT EXISTS (
                          SELECT 1 FROM `$Agri_prod_archive` t WHERE t.id = p.id
                      )
                ");
                $deleted = $dbh->exec("DELETE FROM `$Agri_prod_table` WHERE id IN ($id_list) AND id_ostan = " . (int)$f_ostan);
                $moved_batch = ($deleted === false) ? 0 : (int)$deleted;
                $upd = $dbh->prepare("
                    UPDATE `$Agri_table` a
                    SET a.t_mah = (
                        SELECT COUNT(*) FROM `$Agri_prod_table` p WHERE p.Agri_id = a.id
                    )
                    WHERE a.id = :agri_id
                ");
                foreach ($free_agri as $agri_id) {
                    $upd->execute(array(':agri_id' => $agri_id));
                }
                $dbh->commit();
            }

            $_SESSION[$sess_key]['moved'] += $moved_batch;
            $_SESSION[$sess_key]['skipped'] += $skipped_batch;
            $_SESSION['last_acted_on'] = time();
            $need_move_continue = (count($batch) === $move_size);

            if (!$need_move_continue) {
                $move_done = true;
                sabt_event(
                    $login_session,
                    $_SERVER['REMOTE_ADDR'],
                    $date_edit,
                    $time,
                    '',
                    'انتقال محصولات خارج از برش به ' . $Agri_prod_archive . ' /' . $z_sal . '/' . $ostan_name . '/تعداد ' . (int)$_SESSION[$sess_key]['moved'],
                    $id_ostan
                );
            }
        }
    } else {
        $stmt = $dbh->prepare("SELECT $sql_cols $sql_from AND p.id > :after ORDER BY p.id ASC LIMIT " . (int)($list_size + 1));
        $stmt->execute(array(':f_ostan' => $f_ostan, ':after' => $list_after));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > $list_size) {
            $has_more_list = true;
            array_pop($rows);
        }
        if (!empty($rows)) {
            $next_list_after = (int)$rows[count($rows) - 1]['id'];
            foreach ($rows as &$row) {
                $row['payesh'] = '';
                $row['is_free'] = false;
                $row['payesh_label'] = 'هنگام انتقال بررسی می‌شود';
            }
            unset($row);
        }
    }
} catch (Exception $e) {
    if ($dbh instanceof PDO && $dbh->inTransaction()) {
        $dbh->rollBack();
    }
    $move_error = $e->getMessage();
}

$_SESSION['last_acted_on'] = time();

$moved_total = ($f_ostan > 0 && isset($_SESSION[$sess_key]['moved'])) ? (int)$_SESSION[$sess_key]['moved'] : 0;
$skipped_total = ($f_ostan > 0 && isset($_SESSION[$sess_key]['skipped'])) ? (int)$_SESSION[$sess_key]['skipped'] : 0;
$list_q = '?f_ostan=' . (int)$f_ostan;
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo doph_h($page_title); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <style>
        body { font-family: myfont, Tahoma, sans-serif; padding: 16px; background: #F0FDF4; color: #14532D; }
        table { width: 100%; border-collapse: collapse; background: #fff; font-size: 13px; }
        th, td { border: 1px solid #86C9A0; padding: 6px 8px; text-align: center; }
        th { background: #15803D; color: #fff; }
        .ok { background: #DCFCE7; }
        .no { background: #FEE2E2; }
        .bar, .pick { margin: 0 0 16px; padding: 12px; background: #fff; border: 1px solid #86C9A0; border-radius: 8px; }
        .pick label { display: block; margin-bottom: 6px; }
        .pick select { font-family: inherit; min-height: 40px; min-width: 240px; padding: 6px 8px; }
        .pick button { margin-right: 8px; }
        button { font-family: inherit; min-height: 44px; padding: 8px 16px; background: #A16207; color: #fff; border: 0; border-radius: 8px; cursor: pointer; }
        .msg { padding: 10px; margin-bottom: 12px; border-radius: 8px; }
        .msg-ok { background: #DCFCE7; }
        .msg-err { background: #FEE2E2; }
        .msg-info { background: #FEF3C7; }
        a.ghost { display: inline-block; margin: 8px 8px 0 0; color: #14532D; }
    </style>
</head>
<body>
    <h1>انتقال محصولات خارج از برش به <?php echo doph_h($Agri_prod_archive); ?></h1>

    <form class="pick" method="get">
        <label for="f_ostan">استان</label>
        <select id="f_ostan" name="f_ostan" required>
            <option value="">انتخاب کنید</option>
            <?php foreach ($ostan_list as $o) { ?>
                <option value="<?php echo (int)$o['id_ostan']; ?>"<?php if ((int)$o['id_ostan'] === $f_ostan) echo ' selected="selected"'; ?>>
                    <?php echo doph_h($o['ostan']); ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit">نمایش استان</button>
    </form>

    <?php if ($f_ostan < 1) { ?>
        <p class="msg msg-info">یک استان را انتخاب کنید. به‌خاطر حجم داده، انتقال باید استان‌به‌استان انجام شود.</p>
    <?php } else { ?>
        <div class="bar">
            استان: <strong><?php echo doph_h($ostan_name); ?></strong>
            — این صفحه: <strong><?php echo count($rows); ?></strong> ردیف
            <?php if ($do_move) { ?>
                — منتقل‌شده تا حالا: <strong><?php echo $moved_total; ?></strong>
                — قفل پایش: <strong><?php echo $skipped_total; ?></strong>
            <?php } ?>
        </div>

        <?php if ($has_map) { ?>
            <p class="msg msg-info">نگاشت ۱۴۰۴–۱۴۰۵ فعال است: اگر برای محصول مادر در همان مرکز الگوی کشت باشد، فرزند در این فهرست نمی‌آید.</p>
        <?php } ?>

        <?php if ($move_error !== '') { ?>
            <p class="msg msg-err">خطا: <?php echo doph_h($move_error); ?></p>
        <?php } ?>

        <?php if ($do_move && $move_error === '') { ?>
            <p class="msg msg-ok">این دسته: <?php echo (int)$moved_batch; ?> منتقل، <?php echo (int)$skipped_batch; ?> قفل. جمع منتقل‌شده: <?php echo $moved_total; ?></p>
        <?php } ?>

        <?php if ($need_move_continue) { ?>
            <p class="msg msg-info">انتقال استان «<?php echo doph_h($ostan_name); ?>» در دسته‌های <?php echo (int)$move_size; ?>تایی — ادامه خودکار... تب را نبندید.</p>
            <form id="doph-move" method="post">
                <input type="hidden" name="action" value="move"/>
                <input type="hidden" name="f_ostan" value="<?php echo (int)$f_ostan; ?>"/>
                <input type="hidden" name="move_after" value="<?php echo (int)$next_move_after; ?>"/>
                <p><button type="submit">ادامه انتقال</button></p>
            </form>
            <script>
                setTimeout(function () {
                    var f = document.getElementById('doph-move');
                    if (f) f.submit();
                }, 300);
            </script>
        <?php } elseif ($move_done) { ?>
            <p class="msg msg-ok">انتقال استان «<?php echo doph_h($ostan_name); ?>» تمام شد. جمع: <?php echo $moved_total; ?> ردیف به آرشیو رفت، <?php echo $skipped_total; ?> ردیف به‌خاطر پایش منتقل نشد.</p>
            <p><a class="ghost" href="<?php echo doph_h($list_q); ?>">بازگشت به فهرست همین استان</a></p>
        <?php } elseif (!$do_move) { ?>
            <form method="post" onsubmit="return confirm('فقط ردیف‌های خارج از برش استان «<?php echo doph_h($ostan_name); ?>» منتقل می‌شوند. ادامه می‌دهید؟');">
                <input type="hidden" name="action" value="move"/>
                <input type="hidden" name="f_ostan" value="<?php echo (int)$f_ostan; ?>"/>
                <input type="hidden" name="move_after" value="0"/>
                <p><button type="submit">شروع انتقال این استان</button></p>
            </form>
            <?php if ($has_more_list) { ?>
                <p><a class="ghost" href="<?php echo doph_h($list_q); ?>&amp;after=<?php echo (int)$next_list_after; ?>">۸۰ ردیف بعدی همین استان</a></p>
            <?php } ?>
        <?php } ?>

        <?php if (!empty($rows)) { ?>
        <table>
            <thead>
                <tr>
                    <th>پایش</th>
                    <th>نوع خطا</th>
                    <th>سطح</th>
                    <th>کشت</th>
                    <th>محصول</th>
                    <th>کد محصول</th>
                    <?php if ($has_map) { ?><th>کد مادر</th><?php } ?>
                    <th>کد ملی</th>
                    <th>مرکز</th>
                    <th>شهرستان</th>
                    <th>استان</th>
                    <th>id</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr class="<?php echo !empty($row['is_free']) ? 'ok' : 'no'; ?>">
                    <td><?php echo doph_h($row['payesh_label']); ?><?php if ($row['payesh'] !== '' && $row['payesh'] !== null) { ?> (<?php echo doph_h($row['payesh']); ?>)<?php } ?></td>
                    <td><?php echo doph_h($row['noe_khata']); ?></td>
                    <td><?php echo doph_h($row['sath_kesht']); ?></td>
                    <td><?php echo ($row['no_kesh'] == 1 ? 'آبی' : ($row['no_kesh'] == 2 ? 'دیم' : doph_h($row['no_kesh']))); ?></td>
                    <td><?php echo doph_h($row['product_name']); ?></td>
                    <td><?php echo doph_h($row['cod_mah']); ?></td>
                    <?php if ($has_map) { ?><td><?php echo doph_h($row['madar_cod']); ?></td><?php } ?>
                    <td><?php echo doph_h($row['bah_cod_m']); ?></td>
                    <td><?php echo doph_h($row['mar']); ?></td>
                    <td><?php echo doph_h($row['city']); ?></td>
                    <td><?php echo doph_h($row['ostan']); ?></td>
                    <td><?php echo (int)$row['id']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php } elseif (!$do_move && $move_error === '') { ?>
            <p class="msg msg-info">در این استان ردیفی خارج از برش یافت نشد.</p>
        <?php } ?>
    <?php } ?>
</body>
</html>
