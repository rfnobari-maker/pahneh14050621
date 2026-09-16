<?php
require_once("../../lock_ce.php");
include('../../login/config.php');

$filename = "eagri_data_mar.csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');

// اجرای کوئری اصلی
$sql = "SELECT `id_ostan` , `id_city` ,`id_mar`, `z_sal` , `group_cod` , `product_cod` , `s_abi` , `s_dem` , `t_abi` , `t_dem` , `a_abi` , `a_dem`
FROM `Agri_ab_mar`
WHERE `s_abi` > 0 OR `s_dem` > 0";
$stmt = $dbh->prepare($sql);
$stmt->execute();

// ==============================================
// محصولات خاص (فقط سطح آبی دارند، دیم = 0)
// ==============================================
$special_products = array('170', '172', '174');

// ==============================================
// آرایه‌های Lookup
// ==============================================
$zkesht_abi_lookup = array();
$zkesht_dem_lookup = array();

// ==============================================
// مرحله 1: دریافت سطح زیر کشت از Agri_prod (برای محصولات غیر خاص)
// ==============================================
$years_sql = "SELECT DISTINCT z_sal FROM Agri_ab_mar";
$years_stmt = $dbh->prepare($years_sql);
$years_stmt->execute();

while ($year_row = $years_stmt->fetch(PDO::FETCH_ASSOC)) {
    $year = $year_row['z_sal'];
    $table_name = 'Agri_prod' . str_replace('-', '_', $year);
    
    $check = $dbh->query("SHOW TABLES LIKE '$table_name'");
    if ($check->rowCount() == 0) {
        continue;
    }
    
    // سطح آبی (no_kesh = '1')
    $query_abi = "SELECT id_ostan, id_city, id_mar, z_sal, cod_qroup, cod_mah,
                  SUM(IFNULL(zer_kesht_a, 0) + IFNULL(zer_kesht_b, 0)) AS total
                  FROM `$table_name`
                  WHERE z_sal = :z_sal AND no_kesh = '1'
                  GROUP BY id_ostan, id_city, id_mar, z_sal, cod_qroup, cod_mah";
    
    $stmt_abi = $dbh->prepare($query_abi);
    $stmt_abi->bindParam(':z_sal', $year);
    $stmt_abi->execute();
    
    while ($row_abi = $stmt_abi->fetch(PDO::FETCH_ASSOC)) {
        $key = $row_abi['id_ostan'] . '|' . $row_abi['id_city'] . '|' . $row_abi['id_mar'] . '|' . $row_abi['z_sal'] . '|' . $row_abi['cod_qroup'] . '|' . $row_abi['cod_mah'];
        $zkesht_abi_lookup[$key] = (float)$row_abi['total'];
    }
    
    // سطح دیم (no_kesh = '2')
    $query_dem = "SELECT id_ostan, id_city, id_mar, z_sal, cod_qroup, cod_mah,
                  SUM(IFNULL(zer_kesht_a, 0) + IFNULL(zer_kesht_b, 0)) AS total
                  FROM `$table_name`
                  WHERE z_sal = :z_sal AND no_kesh = '2'
                  GROUP BY id_ostan, id_city, id_mar, z_sal, cod_qroup, cod_mah";
    
    $stmt_dem = $dbh->prepare($query_dem);
    $stmt_dem->bindParam(':z_sal', $year);
    $stmt_dem->execute();
    
    while ($row_dem = $stmt_dem->fetch(PDO::FETCH_ASSOC)) {
        $key = $row_dem['id_ostan'] . '|' . $row_dem['id_city'] . '|' . $row_dem['id_mar'] . '|' . $row_dem['z_sal'] . '|' . $row_dem['cod_qroup'] . '|' . $row_dem['cod_mah'];
        $zkesht_dem_lookup[$key] = (float)$row_dem['total'];
    }
}

// ==============================================
// مرحله 2: محصولات خاص از Vege_prod (فقط سطح آبی)
// ==============================================
$vege_query = "SELECT id_ostan, id_city, id_mar, z_sal, cod_mah, SUM(zer_kesht) AS total
               FROM Vege_prod
               WHERE cod_mah IN ('170', '172', '174')
               GROUP BY id_ostan, id_city, id_mar, z_sal, cod_mah";
$vege_stmt = $dbh->prepare($vege_query);
$vege_stmt->execute();

while ($vege_row = $vege_stmt->fetch(PDO::FETCH_ASSOC)) {
    // برای محصولات خاص، group_cod وجود ندارد
    $key = $vege_row['id_ostan'] . '|' . $vege_row['id_city'] . '|' . $vege_row['id_mar'] . '|' . $vege_row['z_sal'] . '|' . '' . '|' . $vege_row['cod_mah'];
    // فقط سطح آبی را پر می‌کنیم
    $zkesht_abi_lookup[$key] = (float)$vege_row['total'];
    // سطح دیم برای محصولات خاص = 0 (مقداری ذخیره نمی‌کنیم، بعداً 0 برمی‌گردد)
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
    $z_sal = $row['z_sal'];
    
    // ساخت کلید lookup
    if (in_array($product_cod, $special_products)) {
        // محصولات خاص: group_cod را خالی می‌گذاریم
        $key = $id_ostan . '|' . $id_city . '|' . $id_mar . '|' . $z_sal . '|' . '' . '|' . $product_cod;
        // برای محصولات خاص، سطح دیم = 0
        $row['z_kesht_abi'] = isset($zkesht_abi_lookup[$key]) ? $zkesht_abi_lookup[$key] : 0;
        $row['z_kesht_dem'] = 0;
    } else {
        // محصولات غیر خاص
        $key = $id_ostan . '|' . $id_city . '|' . $id_mar . '|' . $z_sal . '|' . $group_cod . '|' . $product_cod;
        $row['z_kesht_abi'] = isset($zkesht_abi_lookup[$key]) ? $zkesht_abi_lookup[$key] : 0;
        $row['z_kesht_dem'] = isset($zkesht_dem_lookup[$key]) ? $zkesht_dem_lookup[$key] : 0;
    }
    
    fputcsv($output, $row);
}

fclose($output);
$dbh = null;
exit();
?>