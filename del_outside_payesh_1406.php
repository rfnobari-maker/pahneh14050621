<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');
set_time_limit(0);
@ini_set('max_execution_time', '0');
@ini_set('memory_limit', '512M');

function doph_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

$z_sal = '1405-1406';
$payesh_year = substr($z_sal, 0, 4);
$Agri_table = 'Agri1405_1406';
$Agri_prod_table = 'Agri_prod1405_1406';
$date_edit = jdate('Y/m/d');
$time = date('H:i:s');
$do_delete = (isset($_POST['action']) && $_POST['action'] === 'delete');

$sql = "
SELECT
    p.id,
    p.Agri_id,
    p.z_sal,
    p.date_s,
    p.bah_cod_m,
    p.num_bah,
    p.sh_gat,
    p.cod_mah,
    pz.product_name,
    p.cod_qroup,
    p.no_kesh,
    p.zer_kesht_a,
    p.zer_kesht_b,
    (IFNULL(p.zer_kesht_a,0) + IFNULL(p.zer_kesht_b,0)) AS sath_kesht,
    p.id_ostan,
    o.ostan,
    p.id_city,
    c.city,
    p.id_mar,
    m.mar,
    p.mor_cod_m,
    p.add_abadi,
    p.add_city,
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
WHERE
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
ORDER BY p.id_ostan, p.id_city, p.id_mar, p.bah_cod_m, p.id
";

$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$free_ids = array();
$free_agri_ids = array();
$checked = array();

foreach ($rows as $row) {
    $pid = (int)$row['id'];
    $payesh = check_payesh($pid, 0, $payesh_year);
    $row['payesh'] = $payesh;
    $is_free = ($payesh != 2 && $payesh != 0 && $payesh != -1);
    $row['is_free'] = $is_free;
    if ($payesh == 2) {
        $row['payesh_label'] = 'نهاده اختصاص داده شده — حذف نشد';
    } elseif ($payesh == 0 || $payesh == -1) {
        $row['payesh_label'] = 'ارتباط پایش برقرار نشد — حذف نشد';
    } else {
        $row['payesh_label'] = 'حذف/ویرایش آزاد';
    }
    $checked[] = $row;
    if ($is_free) {
        $free_ids[] = $pid;
        $free_agri_ids[$row['Agri_id']] = $row['Agri_id'];
    }
}

$deleted_count = 0;
$delete_error = '';

if ($do_delete && !empty($free_ids)) {
    try {
        $dbh->beginTransaction();

        $ins = $dbh->prepare("
            INSERT INTO `del_rec`
                (`Date`, `Table_id`, `Table_name`, `sal`, `bah_cod_m`, `mor_cod_m`,
                 `cod_mah`, `date_s`, `num_bah`, `no_kesh`, `zer_kesht_a`, `zer_kesht_b`,
                 `mah_tolp`, `add_abadi`, `add_city`, `Type_Op`)
            SELECT
                :Date, id, :Table_name, :sal, bah_cod_m, :mor_cod_m, cod_mah, date_s,
                num_bah, no_kesh, zer_kesht_a, zer_kesht_b, mah_tolp, add_abadi, add_city, :Type_Op
            FROM `$Agri_prod_table`
            WHERE id = :id
        ");

        $del = $dbh->prepare("DELETE FROM `$Agri_prod_table` WHERE id = :id");

        foreach ($free_ids as $pid) {
            $payesh_now = check_payesh($pid, 0, $payesh_year);
            if ($payesh_now == 2 || $payesh_now == 0 || $payesh_now == -1) {
                continue;
            }
            $ins->execute(array(
                ':Date' => $date_edit,
                ':Table_name' => $Agri_prod_table,
                ':sal' => $z_sal,
                ':mor_cod_m' => $login_session,
                ':Type_Op' => '1',
                ':id' => $pid
            ));
            $del->execute(array(':id' => $pid));
            $deleted_count++;
        }

        if (!empty($free_agri_ids)) {
            $upd = $dbh->prepare("
                UPDATE `$Agri_table` a
                SET a.t_mah = (
                    SELECT COUNT(*) FROM `$Agri_prod_table` p WHERE p.Agri_id = a.id
                )
                WHERE a.id = :agri_id
            ");
            foreach ($free_agri_ids as $agri_id) {
                $upd->execute(array(':agri_id' => $agri_id));
            }
        }

        sabt_event(
            $login_session,
            $_SERVER['REMOTE_ADDR'],
            $date_edit,
            $time,
            '',
            'حذف گروهی محصولات خارج از برش /' . $z_sal . '/تعداد ' . $deleted_count,
            $id_ostan
        );

        $dbh->commit();
    } catch (Exception $e) {
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
        }
        $delete_error = $e->getMessage();
        $deleted_count = 0;
    }
}

$free_count = count($free_ids);
$total_count = count($checked);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>حذف محصولات خارج از برش ۱۴۰۵–۱۴۰۶</title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <style>
        body { font-family: myfont, Tahoma, sans-serif; padding: 16px; background: #F0FDF4; color: #14532D; }
        table { width: 100%; border-collapse: collapse; background: #fff; font-size: 13px; }
        th, td { border: 1px solid #86C9A0; padding: 6px 8px; text-align: center; }
        th { background: #15803D; color: #fff; }
        .ok { background: #DCFCE7; }
        .no { background: #FEE2E2; }
        .bar { margin: 0 0 16px; padding: 12px; background: #fff; border: 1px solid #86C9A0; border-radius: 8px; }
        button { font-family: inherit; min-height: 44px; padding: 8px 16px; background: #DC2626; color: #fff; border: 0; border-radius: 8px; cursor: pointer; }
        button:disabled { background: #9CA3AF; cursor: not-allowed; }
        .msg { padding: 10px; margin-bottom: 12px; border-radius: 8px; }
        .msg-ok { background: #DCFCE7; }
        .msg-err { background: #FEE2E2; }
    </style>
</head>
<body>
    <h1>محصولات خارج از برش مرکز — <?php echo doph_h($z_sal); ?></h1>
    <div class="bar">
        کل ردیف خارج از برش: <strong><?php echo (int)$total_count; ?></strong>
        — آزاد برای حذف: <strong><?php echo (int)$free_count; ?></strong>
        — قفل پایش: <strong><?php echo (int)($total_count - $free_count); ?></strong>
    </div>

    <?php if ($do_delete && $delete_error === '') { ?>
        <p class="msg msg-ok"><?php echo (int)$deleted_count; ?> ردیف حذف شد. آرشیو در del_rec و t_mah به‌روز شد.</p>
    <?php } ?>
    <?php if ($delete_error !== '') { ?>
        <p class="msg msg-err">خطا در حذف: <?php echo doph_h($delete_error); ?></p>
    <?php } ?>

    <?php if (!$do_delete && $free_count > 0) { ?>
        <form method="post" onsubmit="return confirm('فقط ردیف‌هایی که پایش آزاد است حذف می‌شوند. ادامه می‌دهید؟');">
            <input type="hidden" name="action" value="delete"/>
            <p><button type="submit">حذف <?php echo (int)$free_count; ?> ردیف آزاد</button></p>
        </form>
    <?php } ?>

    <table>
        <thead>
            <tr>
                <th>پایش</th>
                <th>نوع خطا</th>
                <th>سطح</th>
                <th>کشت</th>
                <th>محصول</th>
                <th>کد محصول</th>
                <th>کد ملی</th>
                <th>مرکز</th>
                <th>شهرستان</th>
                <th>استان</th>
                <th>id</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($checked as $row) { ?>
            <tr class="<?php echo $row['is_free'] ? 'ok' : 'no'; ?>">
                <td><?php echo doph_h($row['payesh_label']); ?> (<?php echo doph_h($row['payesh']); ?>)</td>
                <td><?php echo doph_h($row['noe_khata']); ?></td>
                <td><?php echo doph_h($row['sath_kesht']); ?></td>
                <td><?php echo ($row['no_kesh'] == 1 ? 'آبی' : ($row['no_kesh'] == 2 ? 'دیم' : doph_h($row['no_kesh']))); ?></td>
                <td><?php echo doph_h($row['product_name']); ?></td>
                <td><?php echo doph_h($row['cod_mah']); ?></td>
                <td><?php echo doph_h($row['bah_cod_m']); ?></td>
                <td><?php echo doph_h($row['mar']); ?></td>
                <td><?php echo doph_h($row['city']); ?></td>
                <td><?php echo doph_h($row['ostan']); ?></td>
                <td><?php echo (int)$row['id']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>
