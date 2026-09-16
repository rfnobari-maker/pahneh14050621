<?php
/**
 * خروجی CSV بهره‌برداران روی سرور (reza/bah.csv).
 * پیش‌فرض: فقط زنده (ok=1)، کل کشور، بازنویسی کامل.
 */
require_once __DIR__ . '/login/config.php';

if (!isset($dbh) || !($dbh instanceof PDO)) {
    header('Content-Type: text/plain; charset=utf-8');
    echo "اتصال به پایگاه داده برقرار نشد.\n";
    exit(1);
}

$limit = 10;
$outDir = __DIR__ . DIRECTORY_SEPARATOR . 'reza';
$outFile = $outDir . DIRECTORY_SEPARATOR . 'bah.csv';

if (!is_dir($outDir) && !mkdir($outDir, 0755, true)) {
    header('Content-Type: text/plain; charset=utf-8');
    echo "ساخت پوشه خروجی ممکن نشد: " . $outDir . "\n";
    exit(1);
}

$sql = "SELECT
            bah.id_ostan,
            COALESCE(ostanname.ostan, bah.ostan_s) AS ostan,
            bah.id_city,
            COALESCE(cityname.city, bah.shahr_s) AS city,
            bah.add_city AS shahr_code,
            bah.city_s,
            COALESCE(list_city.shahr, NULLIF(bah.city_s, '-')) AS shahr_name,
            bah.add_abadi,
            list_abadi.abadi AS abadi,
            bah.no_bah,
            bah.name,
            bah.last_name,
            bah.bah_cod_m,
            bah.co_name,
            bah.sh_meli,
            bah.tel_m,
            bah.valid,
            bah.no_nation,
            bah.nation
        FROM bah
        LEFT JOIN ostanname ON ostanname.id_ostan = bah.id_ostan
        LEFT JOIN cityname ON cityname.id_ostan = bah.id_ostan AND cityname.id_city = bah.id_city
        LEFT JOIN list_city ON list_city.add_city = bah.add_city
        LEFT JOIN list_abadi ON list_abadi.add_abadi = bah.add_abadi
        WHERE bah.ok = '1'
        ORDER BY CASE
            WHEN bah.add_city IS NOT NULL AND bah.add_city <> '' AND bah.add_city <> '0' THEN 0
            ELSE 1
        END, bah.id ASC " ;

$stmt = $dbh->prepare($sql);
$stmt->execute();

$file = fopen($outFile, 'w');
if ($file === false) {
    header('Content-Type: text/plain; charset=utf-8');
    echo "نوشتن فایل ممکن نشد: " . $outFile . "\n";
    exit(1);
}

fwrite($file, "\xEF\xBB\xBF");
fputcsv($file, array(
    'ردیف',
    'استان',
    'کد استان',
    'شهرستان',
    'کد شهرستان',
    'نام شهر',
    'کد شهر',
    'آبادی',
    'کد آبادی',
    'نوع بهره بردار',
    'نام',
    'نام خانوادگی',
    'کد ملی',
    'نام شرکت',
    'شناسه ملی شرکت',
    'شماره همراه',
    'احراز هویت شاهکار',
    'تابعیت'
));

$n = 0;
foreach ($stmt as $row) {
    $n++;
    $noBah = isset($row['no_bah']) ? (string) $row['no_bah'] : '';
    $noNation = isset($row['no_nation']) ? (string) $row['no_nation'] : '';
    $nationTxt = isset($row['nation']) ? trim($row['nation']) : '';
    $shahrCode = isset($row['shahr_code']) ? trim($row['shahr_code']) : '';
    $shahrName = isset($row['shahr_name']) ? trim($row['shahr_name']) : '';
    if ($shahrName === '' || $shahrName === '-') {
        $cityS = isset($row['city_s']) ? trim($row['city_s']) : '';
        $shahrName = ($cityS !== '' && $cityS !== '-') ? $cityS : '';
    }
    if ($shahrCode === '0') {
        $shahrCode = '';
    }

    $abadiCode = isset($row['add_abadi']) ? trim($row['add_abadi']) : '';
    $abadiName = isset($row['abadi']) ? trim($row['abadi']) : '';
    if ($abadiCode === '' || $abadiCode === '0') {
        $abadiCode = '';
        $abadiName = '';
    } elseif ($abadiName === '-') {
        $abadiName = '';
    }

    if ($noBah === '2') {
        $typeLabel = 'حقوقی';
    } elseif ($noBah === '1') {
        $typeLabel = 'حقیقی';
    } else {
        $typeLabel = $noBah;
    }

    if ($noNation === '1') {
        $nationLabel = 'ایرانی';
    } elseif ($noNation === '2') {
        $nationLabel = ($nationTxt !== '') ? $nationTxt : 'غیرایرانی';
    } else {
        $nationLabel = $nationTxt;
    }

    fputcsv($file, array(
        $n,
        isset($row['ostan']) ? $row['ostan'] : '',
        isset($row['id_ostan']) ? $row['id_ostan'] : '',
        isset($row['city']) ? $row['city'] : '',
        isset($row['id_city']) ? $row['id_city'] : '',
        $shahrName,
        $shahrCode,
        $abadiName,
        $abadiCode,
        $typeLabel,
        isset($row['name']) ? $row['name'] : '',
        isset($row['last_name']) ? $row['last_name'] : '',
        isset($row['bah_cod_m']) ? $row['bah_cod_m'] : '',
        isset($row['co_name']) ? $row['co_name'] : '',
        isset($row['sh_meli']) ? $row['sh_meli'] : '',
        isset($row['tel_m']) ? $row['tel_m'] : '',
        (isset($row['valid']) && (string) $row['valid'] === '600') ? 'تایید شده' : 'عدم تایید',
        $nationLabel
    ));
}

fclose($file);

header('Content-Type: text/plain; charset=utf-8');
echo "فایل ذخیره شد: " . $outFile . "\n";
echo "تعداد ردیف: " . $n . "\n";
