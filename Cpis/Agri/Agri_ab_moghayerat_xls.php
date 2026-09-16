<?php
require_once('../../lock_cp.php');
require_once('../../event.php');
require_once(__DIR__ . '/Agri_ab_moghayerat_lib.php');

$kinds = agri_ab_moghayer_kinds();
$z_sal = isset($_POST['z_sal']) ? trim($_POST['z_sal']) : '';
$id_ostan1 = isset($_POST['id_ostan']) ? trim($_POST['id_ostan']) : '';
$moghayer = agri_ab_moghayer_norm_kind(isset($_POST['moghayer']) ? $_POST['moghayer'] : 'ostan_city');
$kind_meta = $kinds[$moghayer];
$show_city = ($moghayer === 'mar_prod' || $moghayer === 'city_mar');
$show_mar = ($moghayer === 'mar_prod');

if (!agri_ab_moghayer_valid_year($z_sal)) {
    header('Content-Type: text/html; charset=utf-8');
    echo 'سال زراعی نامعتبر است.';
    exit;
}

$rows = agri_ab_moghayer_rows($dbh, $moghayer, $z_sal, $id_ostan1, 0, null);
$fname = 'moghayerat_' . $moghayer . '_' . str_replace('-', '_', $z_sal) . '.xls';

header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $fname . '"');
header('Pragma: no-cache');
header('Expires: 0');
echo "\xEF\xBB\xBF";
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head>
<body dir="rtl">
<table border="1">
    <tr>
        <th>ردیف</th>
        <th>کد استان</th>
        <th>استان</th>
        <?php if ($show_city) { ?><th>کد شهرستان</th><th>شهرستان</th><?php } ?>
        <?php if ($show_mar) { ?><th>کد مرکز</th><th>مرکز</th><?php } ?>
        <th>کد محصول</th>
        <th>محصول</th>
        <th>آبی / دیم</th>
        <th><?php echo agri2_h($kind_meta['up']); ?></th>
        <th><?php echo agri2_h($kind_meta['down']); ?></th>
        <th>مغایرت</th>
    </tr>
<?php
$r = 1;
foreach ($rows as $row) {
?>
    <tr>
        <td><?php echo (int) $r; ?></td>
        <td><?php echo agri2_h(agri_ab_moghayer_blank($row['id_ostan'])); ?></td>
        <td><?php echo agri2_h(agri_ab_moghayer_blank($row['ostan'])); ?></td>
        <?php if ($show_city) { ?>
        <td><?php echo agri2_h(agri_ab_moghayer_blank($row['id_city'])); ?></td>
        <td><?php echo agri2_h(agri_ab_moghayer_blank($row['city'])); ?></td>
        <?php } ?>
        <?php if ($show_mar) { ?>
        <td><?php echo agri2_h(agri_ab_moghayer_blank($row['id_mar'])); ?></td>
        <td><?php echo agri2_h(agri_ab_moghayer_blank($row['mar'])); ?></td>
        <?php } ?>
        <td><?php echo agri2_h(agri_ab_moghayer_blank($row['product_cod'])); ?></td>
        <td><?php echo agri2_h($row['product_name']); ?></td>
        <td><?php echo agri2_h($row['noe']); ?></td>
        <td><?php echo agri2_h(agri_ab_moghayer_num($row['val_up'])); ?></td>
        <td><?php echo agri2_h(agri_ab_moghayer_num($row['val_down'])); ?></td>
        <td><?php echo agri2_h(agri_ab_moghayer_num($row['val_diff'])); ?></td>
    </tr>
<?php
    $r++;
}
?>
</table>
</body>
</html>
