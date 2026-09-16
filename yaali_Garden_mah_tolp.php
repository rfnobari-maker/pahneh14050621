<?php
include('login/config.php');

set_time_limit(0);
ini_set('memory_limit', '512M');

$log_every = 100;

echo "در حال گرفتن لیست رکوردهای 1405 با mah_tolp = 0 ...\n";

// ---- مرحله ۱: گرفتن لیست رکوردهای نیازمند به‌روزرسانی ----
$sql_list = "
    SELECT id, cod_mah, Garden_id_old
    FROM Garden_prod
    WHERE z_sal = '1405' AND mah_tolp = 0 
";
$stmt = $dbh->query($sql_list);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = count($rows);

echo "{$total} رکورد برای بررسی پیدا شد.\n\n";

if ($total == 0) {
    echo "چیزی برای به‌روزرسانی نیست.\n";
    exit;
}

// ---- مرحله ۲ و ۳: حلقه اصلی ----
$updated   = 0;
$not_found = 0;
$start     = microtime(true);

// prepared statements
$stmt_ref = $dbh->prepare("
    SELECT mah_tolp
    FROM Garden_prod
    WHERE cod_mah = ?
      AND Garden_id = ?
      AND mah_tolp > 0
    ORDER BY z_sal DESC
    LIMIT 1
");

$stmt_upd = $dbh->prepare("
    UPDATE Garden_prod
    SET mah_tolp = ?
    WHERE id = ?
");

if (!$stmt_ref || !$stmt_upd) {
    die("خطا در prepare: " . print_r($dbh->errorInfo(), true) . "\n");
}

$idx = 0;
foreach ($rows as $row) {
    $idx++;

    // پیدا کردن مقدار مرجع
    $stmt_ref->execute(array($row['cod_mah'], $row['Garden_id_old']));
    $ref = $stmt_ref->fetch(PDO::FETCH_ASSOC);

    if ($ref && $ref['mah_tolp'] > 0) {
        $stmt_upd->execute(array($ref['mah_tolp'], $row['id']));
        $updated++;
    } else {
        $not_found++;
        echo "پیدا نشد: cod_mah={$row['cod_mah']}, Garden_id_old={$row['Garden_id_old']}\n";
    }

    // لاگ دوره‌ای
    if ($idx % $log_every === 0) {
        $elapsed = microtime(true) - $start;
        $speed = $elapsed > 0 ? $idx / $elapsed : 0;
        printf("%d/%d | OK: %d | Not found: %d | %.1f rec/sec\n",
            $idx, $total, $updated, $not_found, $speed);
        flush();
    }
}

$elapsed = microtime(true) - $start;

echo "\n" . str_repeat("=", 50) . "\n";
printf("پایان در %.2f ثانیه\n", $elapsed);
echo "به‌روزرسانی شده: {$updated}\n";
echo "بدون مقدار مرجع: {$not_found}\n";
echo str_repeat("=", 50) . "\n";