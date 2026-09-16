<?php
require_once("../../lock_ce.php");
include('../../login/config.php');

// سال ثابت
$z_sal = '1405-1406';

// اجرای مستقیم تولید CSV
$filename = "eagri_data_mar_" . str_replace('-', '_', $z_sal) . ".csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

$output = fopen('php://output', 'w');

// ==============================================
// کوئری اصلی با فیلتر سال
// ==============================================
$sql = "SELECT `id_ostan` , `id_city` ,`id_mar`, `z_sal` , `group_cod` , `product_cod` , `s_abi` , `s_dem` , `t_abi` , `t_dem` , `a_abi` , `a_dem`
FROM `Agri_ab_mar`
WHERE (`s_abi` > 0 OR `s_dem` > 0) AND `z_sal` = :z_sal";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':z_sal', $z_sal);
$stmt->execute();

// ==============================================
// محصولات خاص (فقط سطح آبی دارند، دیم = 0)
// ==============================================
$special_products = array('170', '172', '174');

// ==============================================
// نگاشت محصولات والد-فرزند (فقط برای سال 1404-1405)
// ==============================================
// برای سال 1405-1406 نگاشت غیرفعال است
$product_map = array(
    '103' => '102', '107' => '106', '176' => '490', '178' => '490', '180' => '490',
    '182' => '490', '184' => '490', '186' => '490', '188' => '490', '190' => '490',
    '192' => '490', '194' => '490', '196' => '490', '198' => '490', '200' => '490',
    '414' => '490', '416' => '490', '418' => '490', '420' => '490', '422' => '490',
    '424' => '490', '426' => '490', '428' => '490', '430' => '490', '432' => '490',
    '434' => '490', '436' => '490', '438' => '490', '440' => '490', '442' => '490',
    '444' => '490', '446' => '490', '448' => '490', '449' => '490', '464' => '490'
);

// ==============================================
// آرایه‌های Lookup برای تمام فیلدها
// ==============================================
$zkesht_abi_lookup = array();
$zkesht_dem_lookup = array();
$s_bar_abi_lookup = array();
$s_bar_dem_lookup = array();
$mah_tolp_abi_lookup = array();
$mah_tolp_dem_lookup = array();
$mah_tol_abi_lookup = array();
$mah_tol_dem_lookup = array();

// ==============================================
// مرحله 1: دریافت داده‌ها از Agri_prod (برای محصولات غیر خاص)
// ==============================================
$table_name = 'Agri_prod' . str_replace('-', '_', $z_sal);

$check = $dbh->query("SHOW TABLES LIKE '$table_name'");
if ($check->rowCount() > 0) {
    
    // سطح زیر کشت آبی (no_kesh = '1')
    $query_abi = "SELECT id_ostan, id_city, id_mar, z_sal, cod_qroup, cod_mah,
                  SUM(IFNULL(zer_kesht_a, 0) + IFNULL(zer_kesht_b, 0)) AS zkesht,
                  SUM(IFNULL(s_bar_a, 0) + IFNULL(s_bar_b, 0)) AS s_bar,
                  SUM(IFNULL(mah_tolp, 0)) AS mah_tolp,
                  SUM(IFNULL(mah_tol, 0)) AS mah_tol
                  FROM `$table_name`
                  WHERE z_sal = :z_sal AND no_kesh = '1'
                  GROUP BY id_ostan, id_city, id_mar, z_sal, cod_qroup, cod_mah";
    
    $stmt_abi = $dbh->prepare($query_abi);
    $stmt_abi->bindParam(':z_sal', $z_sal);
    $stmt_abi->execute();
    
    while ($row_abi = $stmt_abi->fetch(PDO::FETCH_ASSOC)) {
        $key = $row_abi['id_ostan'] . '|' . $row_abi['id_city'] . '|' . $row_abi['id_mar'] . '|' . $row_abi['z_sal'] . '|' . $row_abi['cod_qroup'] . '|' . $row_abi['cod_mah'];
        $zkesht_abi_lookup[$key] = (float)$row_abi['zkesht'];
        $s_bar_abi_lookup[$key] = (float)$row_abi['s_bar'];
        $mah_tolp_abi_lookup[$key] = (float)$row_abi['mah_tolp'];
        $mah_tol_abi_lookup[$key] = (float)$row_abi['mah_tol'];
    }
    
    // سطح زیر کشت دیم (no_kesh = '2')
    $query_dem = "SELECT id_ostan, id_city, id_mar, z_sal, cod_qroup, cod_mah,
                  SUM(IFNULL(zer_kesht_a, 0) + IFNULL(zer_kesht_b, 0)) AS zkesht,
                  SUM(IFNULL(s_bar_a, 0) + IFNULL(s_bar_b, 0)) AS s_bar,
                  SUM(IFNULL(mah_tolp, 0)) AS mah_tolp,
                  SUM(IFNULL(mah_tol, 0)) AS mah_tol
                  FROM `$table_name`
                  WHERE z_sal = :z_sal AND no_kesh = '2'
                  GROUP BY id_ostan, id_city, id_mar, z_sal, cod_qroup, cod_mah";
    
    $stmt_dem = $dbh->prepare($query_dem);
    $stmt_dem->bindParam(':z_sal', $z_sal);
    $stmt_dem->execute();
    
    while ($row_dem = $stmt_dem->fetch(PDO::FETCH_ASSOC)) {
        $key = $row_dem['id_ostan'] . '|' . $row_dem['id_city'] . '|' . $row_dem['id_mar'] . '|' . $row_dem['z_sal'] . '|' . $row_dem['cod_qroup'] . '|' . $row_dem['cod_mah'];
        $zkesht_dem_lookup[$key] = (float)$row_dem['zkesht'];
        $s_bar_dem_lookup[$key] = (float)$row_dem['s_bar'];
        $mah_tolp_dem_lookup[$key] = (float)$row_dem['mah_tolp'];
        $mah_tol_dem_lookup[$key] = (float)$row_dem['mah_tol'];
    }
}

// ==============================================
// مرحله 2: محصولات خاص از Vege_prod (فقط سطح آبی)
// ==============================================
$vege_query = "SELECT id_ostan, id_city, id_mar, z_sal, cod_mah, 
               SUM(zer_kesht) AS zkesht,
               SUM(s_bar) AS s_bar,
               SUM(mah_tolp) AS mah_tolp,
               SUM(mah_tol) AS mah_tol
               FROM Vege_prod
               WHERE cod_mah IN ('170', '172', '174') AND z_sal = :z_sal
               GROUP BY id_ostan, id_city, id_mar, z_sal, cod_mah";
$vege_stmt = $dbh->prepare($vege_query);
$vege_stmt->bindParam(':z_sal', $z_sal);
$vege_stmt->execute();

while ($vege_row = $vege_stmt->fetch(PDO::FETCH_ASSOC)) {
    $key = $vege_row['id_ostan'] . '|' . $vege_row['id_city'] . '|' . $vege_row['id_mar'] . '|' . $vege_row['z_sal'] . '|' . '' . '|' . $vege_row['cod_mah'];
    $zkesht_abi_lookup[$key] = (float)$vege_row['zkesht'];
    $s_bar_abi_lookup[$key] = (float)$vege_row['s_bar'];
    $mah_tolp_abi_lookup[$key] = (float)$vege_row['mah_tolp'];
    $mah_tol_abi_lookup[$key] = (float)$vege_row['mah_tol'];
}

// ==============================================
// مرحله 2.5: اعمال نگاشت محصولات والد-فرزند (فقط برای سال 1404-1405)
// ==============================================
// برای سال 1405-1406 نگاشت اعمال نمی‌شود
if ($z_sal == '1404-1405') {
    // ... کد نگاشت (که الان اجرا نمی‌شود)
}

// ==============================================
// مرحله 3: نوشتن هدر CSV
// ==============================================
$columnNames = array();
for ($i = 0; $i < $stmt->columnCount(); $i++) {
    $colMeta = $stmt->getColumnMeta($i);
    $columnNames[] = $colMeta['name'];
}
$columnNames[] = 'z_kesht_abi';
$columnNames[] = 'z_kesht_dem';
$columnNames[] = 's_bar_abi';
$columnNames[] = 's_bar_dem';
$columnNames[] = 'mah_tolp_abi';
$columnNames[] = 'mah_tolp_dem';
$columnNames[] = 'mah_tol_abi';
$columnNames[] = 'mah_tol_dem';
fputcsv($output, $columnNames);

// ==============================================
// مرحله 4: خروجی
// ==============================================
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $product_cod = $row['product_cod'];
    $group_cod = $row['group_cod'];
    $id_ostan = $row['id_ostan'];
    $id_city = $row['id_city'];
    $id_mar = $row['id_mar'];
    $z_sal_row = $row['z_sal'];
    
    if (in_array($product_cod, $special_products)) {
        $key = $id_ostan . '|' . $id_city . '|' . $id_mar . '|' . $z_sal_row . '|' . '' . '|' . $product_cod;
        $row['z_kesht_abi'] = isset($zkesht_abi_lookup[$key]) ? $zkesht_abi_lookup[$key] : 0;
        $row['z_kesht_dem'] = 0;
        $row['s_bar_abi'] = isset($s_bar_abi_lookup[$key]) ? $s_bar_abi_lookup[$key] : 0;
        $row['s_bar_dem'] = 0;
        $row['mah_tolp_abi'] = isset($mah_tolp_abi_lookup[$key]) ? $mah_tolp_abi_lookup[$key] : 0;
        $row['mah_tolp_dem'] = 0;
        $row['mah_tol_abi'] = isset($mah_tol_abi_lookup[$key]) ? $mah_tol_abi_lookup[$key] : 0;
        $row['mah_tol_dem'] = 0;
    } else {
        $key = $id_ostan . '|' . $id_city . '|' . $id_mar . '|' . $z_sal_row . '|' . $group_cod . '|' . $product_cod;
        $row['z_kesht_abi'] = isset($zkesht_abi_lookup[$key]) ? $zkesht_abi_lookup[$key] : 0;
        $row['z_kesht_dem'] = isset($zkesht_dem_lookup[$key]) ? $zkesht_dem_lookup[$key] : 0;
        $row['s_bar_abi'] = isset($s_bar_abi_lookup[$key]) ? $s_bar_abi_lookup[$key] : 0;
        $row['s_bar_dem'] = isset($s_bar_dem_lookup[$key]) ? $s_bar_dem_lookup[$key] : 0;
        $row['mah_tolp_abi'] = isset($mah_tolp_abi_lookup[$key]) ? $mah_tolp_abi_lookup[$key] : 0;
        $row['mah_tolp_dem'] = isset($mah_tolp_dem_lookup[$key]) ? $mah_tolp_dem_lookup[$key] : 0;
        $row['mah_tol_abi'] = isset($mah_tol_abi_lookup[$key]) ? $mah_tol_abi_lookup[$key] : 0;
        $row['mah_tol_dem'] = isset($mah_tol_dem_lookup[$key]) ? $mah_tol_dem_lookup[$key] : 0;
    }
    
    fputcsv($output, $row);
}

fclose($output);
$dbh = null;
exit();
?>