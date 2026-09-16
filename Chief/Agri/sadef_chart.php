<?php
// PHP 5.2.3 Compatibility Notice
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once("../../login/config.php");

function get_db_connection() {
    global $dbh;
    if (!$dbh) { return null; }
    return $dbh;
}

function execute_prepared_statement($query, $params) {
    $dbh = get_db_connection();
    if (!$dbh) { return null; }
    $stmt = $dbh->prepare($query);
    if ($stmt->execute($params)) {
        return $stmt;
    }
    return null;
}

// ----------------------------------------------
// دریافت فیلترها از GET
$selected_z_sal = isset($_GET['z_sal']) ? $_GET['z_sal'] : null;
$selected_season = isset($_GET['season']) ? $_GET['season'] : 'paeez'; // پیش‌فرض: پاییز

// تعریف ترتیب فصل‌ها و کلیدهای معادل
$seasons_order = array('paeez', 'zemestan', 'bahar', 'tabestan', 'sal');
$season_names = array(
    'paeez'    => 'پاییز',
    'zemestan' => 'زمستان',
    'bahar'    => 'بهار',
    'tabestan' => 'تابستان',
    'sal'      => 'کل سال زراعی'
);

// اگر انتخاب نامعتبر بود، اصلاح شود
if (!in_array($selected_season, $seasons_order)) {
    $selected_season = 'paeez';
}

$dbh = get_db_connection();
if (!$dbh) {
    die('<div class="card info-message"><p>خطا در اتصال به پایگاه داده.</p></div>');
}

// دریافت لیست سال‌های زراعی موجود
$z_sal_list = array();
$stmt = execute_prepared_statement("SELECT DISTINCT z_sal FROM sokht_ostan ORDER BY z_sal DESC", array());
if ($stmt) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $z_sal_list[] = $row['z_sal'];
    }
}
if (empty($z_sal_list)) {
    die('<div class="card info-message"><p>هیچ سال زراعی در جدول یافت نشد.</p></div>');
}

// اگر انتخاب نشده یا نامعتبر، آخرین سال را انتخاب کن
if (!$selected_z_sal || !in_array($selected_z_sal, $z_sal_list)) {
    $selected_z_sal = $z_sal_list[0]; // جدیدترین سال
}

// ----------------------------------------------
// کوئری اصلی برای دریافت داده‌های تمام فصول برای سال انتخاب‌شده
$query = "
    SELECT
        id_ostan,
        ostan,
        sahmie_sal,
        sahmie_bahar, taghsim_bahar, estefade_bahar, baghimande_bahar,
        sahmie_tabestan, taghsim_tabestan, estefade_tabestan, baghimande_tabestan,
        sahmie_paeez, taghsim_paeez, estefade_paeez, baghimande_paeez,
        sahmie_zemestan, taghsim_zemestan, estefade_zemestan, baghimande_zemestan
    FROM sokht_ostan
    WHERE z_sal = ?
    ORDER BY ostan
";
$stmt = execute_prepared_statement($query, array($selected_z_sal));
$rows = array();
if ($stmt) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $row;
    }
}

if (empty($rows)) {
    echo '<div class="card info-message"><p>اطلاعاتی برای سال زراعی ' . htmlspecialchars($selected_z_sal) . ' یافت نشد.</p></div>';
    // ادامه نمی‌دهیم ولی فرم را نمایش می‌دهیم
    // اما برای سادگی، می‌توانیم فقط پیام دهیم و خروجی بگیریم
    // ولی بهتر است فرم فیلتر را بالای صفحه نمایش دهیم.
    // برای این کار، متغیر $rows را خالی در نظر گرفته و بعداً شرط می‌گذاریم.
}

// ----------------------------------------------
// تابع کمکی برای استخراج داده‌های یک فصل خاص
function get_season_data($rows, $season_key) {
    $data = array(
        'sahmie' => array(),
        'taghsim' => array(),
        'estefade' => array(),
        'baghimande' => array(),
        'taghsim_nashode' => array()
    );
    $sum_sahmie = 0;
    $sum_taghsim = 0;
    $sum_estefade = 0;
    $sum_baghimande = 0;
    $sum_taghim_nashode = 0;

    if ($season_key == 'sal') {
        // کل سال: از sahmie_sal و جمع فصول
        foreach ($rows as $row) {
            $sahmie = (float)$row['sahmie_sal'];
            $taghsim = (float)$row['taghsim_bahar'] + (float)$row['taghsim_tabestan'] + (float)$row['taghsim_paeez'] + (float)$row['taghsim_zemestan'];
            $estefade = (float)$row['estefade_bahar'] + (float)$row['estefade_tabestan'] + (float)$row['estefade_paeez'] + (float)$row['estefade_zemestan'];
            $baghimande = (float)$row['baghimande_bahar'] + (float)$row['baghimande_tabestan'] + (float)$row['baghimande_paeez'] + (float)$row['baghimande_zemestan'];
            $taghsim_nashode = $sahmie - $taghsim;

            $data['sahmie'][] = $sahmie;
            $data['taghsim'][] = $taghsim;
            $data['estefade'][] = $estefade;
            $data['baghimande'][] = $baghimande;
            $data['taghsim_nashode'][] = $taghsim_nashode;

            $sum_sahmie += $sahmie;
            $sum_taghsim += $taghsim;
            $sum_estefade += $estefade;
            $sum_baghimande += $baghimande;
            $sum_taghim_nashode += $taghsim_nashode;
        }
    } else {
        // یک فصل خاص
        $suffix = '';
        switch ($season_key) {
            case 'bahar': $suffix = 'bahar'; break;
            case 'tabestan': $suffix = 'tabestan'; break;
            case 'paeez': $suffix = 'paeez'; break;
            case 'zemestan': $suffix = 'zemestan'; break;
            default: $suffix = 'bahar';
        }
        foreach ($rows as $row) {
            $sahmie = (float)$row['sahmie_' . $suffix];
            $taghsim = (float)$row['taghsim_' . $suffix];
            $estefade = (float)$row['estefade_' . $suffix];
            $baghimande = (float)$row['baghimande_' . $suffix];
            $taghsim_nashode = $sahmie - $taghsim;

            $data['sahmie'][] = $sahmie;
            $data['taghsim'][] = $taghsim;
            $data['estefade'][] = $estefade;
            $data['baghimande'][] = $baghimande;
            $data['taghsim_nashode'][] = $taghsim_nashode;

            $sum_sahmie += $sahmie;
            $sum_taghsim += $taghsim;
            $sum_estefade += $estefade;
            $sum_baghimande += $baghimande;
            $sum_taghim_nashode += $taghsim_nashode;
        }
    }

    return array(
        'data' => $data,
        'sums' => array(
            'sahmie' => $sum_sahmie,
            'taghsim' => $sum_taghsim,
            'estefade' => $sum_estefade,
            'baghimande' => $sum_baghimande,
            'taghsim_nashode' => $sum_taghim_nashode
        )
    );
}

// استخراج داده‌های فصل انتخاب‌شده
$season_result = get_season_data($rows, $selected_season);
$season_data = $season_result['data'];
$sums = $season_result['sums'];

// ساخت برچسب‌ها (نام استان‌ها)
$labels = array();
$ostan_id_map = array();
foreach ($rows as $row) {
    $labels[] = $row['ostan'];
    $ostan_id_map[$row['ostan']] = $row['id_ostan'];
}

// ----------------------------------------------
// ساخت مجموعه‌های داده (datasets) برای Chart.js
$datasets = array();

// 1. سهمیه
$datasets[] = array(
    'label' => 'سهمیه (جمع: ' . number_format($sums['sahmie']) . ')',
    'data' => $season_data['sahmie'],
    'backgroundColor' => '#2196F3',
    'borderColor' => '#2196F3',
    'borderWidth' => 1
);

// 2. تقسیم‌شده
$datasets[] = array(
    'label' => 'تقسیم‌شده (جمع: ' . number_format($sums['taghsim']) . ')',
    'data' => $season_data['taghsim'],
    'backgroundColor' => '#FFC107',
    'borderColor' => '#FFC107',
    'borderWidth' => 1
);

// 3. استفاده‌شده
$datasets[] = array(
    'label' => 'استفاده‌شده (جمع: ' . number_format($sums['estefade']) . ')',
    'data' => $season_data['estefade'],
    'backgroundColor' => '#F44336',
    'borderColor' => '#F44336',
    'borderWidth' => 1
);

// 4. باقی‌مانده
$datasets[] = array(
    'label' => 'باقی‌مانده (جمع: ' . number_format($sums['baghimande']) . ')',
    'data' => $season_data['baghimande'],
    'backgroundColor' => '#4CAF50',
    'borderColor' => '#4CAF50',
    'borderWidth' => 1
);

// 5. تقسیم‌نشده
$datasets[] = array(
    'label' => 'تقسیم‌نشده (جمع: ' . number_format($sums['taghsim_nashode']) . ')',
    'data' => $season_data['taghsim_nashode'],
    'backgroundColor' => '#9C27B0',
    'borderColor' => '#9C27B0',
    'borderWidth' => 1
);

// تبدیل به JSON
$labels_json = json_encode($labels);
$datasets_json = json_encode($datasets);
$ostan_id_map_json = json_encode($ostan_id_map);

// ----------------------------------------------
// شروع خروجی HTML
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نمودار وضعیت سهمیه سوخت</title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../../15_files/chart.js"></script> 
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #FFC107;
            --background-light: #f5f7fa;
            --card-background: #ffffff;
            --text-color: #333;
            --border-color: #e0e0e0;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --border-radius: 12px;
        }

        body {
            font-family: 'myfont2', Tahoma, Arial, sans-serif;
            background-color: var(--background-light);
            color: var(--text-color);
            margin: 0;
            padding: 24px;
            direction: rtl;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }
        
        .close-btn-container {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .card {
            background: var(--card-background);
            padding: 24px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        h2 {
            text-align: center;
            color: var(--primary-color);
            margin-top: 0;
            font-size: 1.8rem;
        }

        .chart-container {
            position: relative;
        }

        .info-message {
            text-align: center;
            padding: 24px;
            background-color: #fff3e0;
            border: 1px solid #ffcc80;
            border-radius: 8px;
            color: #e65100;
            font-size: 1.2rem;
        }

        .close-btn {
            background-color: #F44336;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-family: 'myfont2', Tahoma, Arial, sans-serif;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .close-btn:hover {
            background-color: #D32F2F;
            transform: translateY(-2px);
        }

        /* استایل فیلترها */
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 16px 24px;
            align-items: center;
            justify-content: center;
            background: var(--card-background);
            padding: 16px 24px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 16px;
        }
        .filter-bar label {
            font-weight: bold;
            margin-left: 8px;
        }
        .filter-bar select {
            padding: 8px 16px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            font-family: inherit;
            font-size: 1rem;
            background: white;
            cursor: pointer;
        }
        .filter-bar select:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        .filter-bar .filter-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .container { padding: 16px; }
            h2 { font-size: 1.5rem; }
            .close-btn-container { top: 10px; left: 10px; }
            .filter-bar { flex-direction: column; align-items: stretch; }
            .filter-group { justify-content: center; }
        }
    </style>
</head>
<body>

<div class="close-btn-container">
    <button class="close-btn" onclick="window.close()">بستن پنجره</button>
</div>

<div class="container">

    <!-- فرم فیلترها -->
    <div class="filter-bar">
        <form method="GET" action="" id="filterForm" style="display: flex; flex-wrap: wrap; gap: 16px 24px; align-items: center; justify-content: center; width: 100%;">
            <div class="filter-group">
                <label for="z_sal">سال زراعی:</label>
                <select name="z_sal" id="z_sal" onchange="document.getElementById('filterForm').submit();">
                    <?php foreach ($z_sal_list as $z): ?>
                        <option value="<?php echo htmlspecialchars($z); ?>" <?php echo ($z == $selected_z_sal) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($z); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="season">فصل:</label>
                <select name="season" id="season" onchange="document.getElementById('filterForm').submit();">
                    <?php foreach ($seasons_order as $key): ?>
                        <option value="<?php echo $key; ?>" <?php echo ($key == $selected_season) ? 'selected' : ''; ?>>
                            <?php echo $season_names[$key]; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <noscript>
                <button type="submit" style="padding:6px 16px;">اعمال</button>
            </noscript>
        </form>
    </div>

    <?php if (!empty($rows)): ?>
    <div class="card">
        <h2 class="chart-title">نمودار وضعیت سهمیه و مصرف سوخت به تفکیک استان</h2>
        <div class="chart-container">
            <canvas id="fuelChart"></canvas>
        </div>
    </div>
    
    <script>
    const labels = <?php echo $labels_json; ?>;
    const datasets = <?php echo $datasets_json; ?>;
    const ostan_id_map = <?php echo $ostan_id_map_json; ?>;
    const selected_z_sal = '<?php echo addslashes($selected_z_sal); ?>';
    const selected_season = '<?php echo addslashes($selected_season); ?>';

    function createChart(ctxId, chartTitle, chartDatasets, unit) {
        const ctx = document.getElementById(ctxId).getContext('2d');
        
        const chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: chartDatasets
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                onClick: (e) => {
                    const points = chartInstance.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
                    if (points.length) {
                        const firstPoint = points[0];
                        const labelIndex = firstPoint.index;
                        const ostanName = labels[labelIndex];
                        const ostanId = ostan_id_map[ostanName];
                        
                        if (ostanId) {
                            // ساخت فرم برای ارسال به صفحه سطح ۲
                            const postData = {
                                id_ostan: ostanId,
                                z_sal: selected_z_sal,
                                fasl: selected_season
                            };
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = 'sadef_L2_chart.php';
                            form.target = 'Payesh_L2_popup';
                            form.style.display = 'none';

                            for (const key in postData) {
                                if (postData.hasOwnProperty(key)) {
                                    const hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = key;
                                    hiddenInput.value = postData[key];
                                    form.appendChild(hiddenInput);
                                }
                            }
                            window.open('about:blank', 'Payesh_L2_popup', 'location=1,status=1,scrollbars=1,width=1000,height=800,top=50,left=50');
                            document.body.appendChild(form);
                            form.submit();
                            document.body.removeChild(form);
                        }
                    }
                },
                scales: {
                    x: {
                        stacked: false,
                        ticks: {
                            autoSkip: false,
                            font: { family: 'myfont2' }
                        }
                    },
                    y: {
                        stacked: false,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: unit,
                            font: { family: 'myfont2', size: 14 }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        rtl: true,
                        labels: {
                            font: { family: 'myfont2', size: 14 }
                        }
                    },
                    title: {
                        display: true,
                        text: chartTitle,
                        font: { family: 'myfont2', size: 16 }
                    },
                    tooltip: {
                        titleFont: { family: 'myfont2' },
                        bodyFont: { family: 'myfont2' },
                        rtl: true,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    // حذف قسمت (جمع: ...)
                                    label = label.split(' (')[0];
                                }
                                if (context.parsed.y !== null) {
                                    label += ': ' + context.parsed.y.toLocaleString();
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
        return chartInstance;
    }

    // ایجاد نمودار
    const myChart = createChart('fuelChart', 'منبع : سامانه سدف', datasets, 'لیتر');
    </script>
    <?php else: ?>
        <div class="card info-message">
            <p>اطلاعاتی برای سال زراعی <?php echo htmlspecialchars($selected_z_sal); ?> و فصل <?php echo $season_names[$selected_season]; ?> یافت نشد.</p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>