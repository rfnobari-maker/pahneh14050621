<?php
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
// دریافت پارامترها از POST (ارسال شده از سطح ۱)
$id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : null;
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : null;
$selected_season = isset($_POST['fasle']) ? $_POST['fasle'] : null;

// اگر پارامترها از طریق POST نیامد، از GET هم چک کنیم
if (!$id_ostan && isset($_GET['id_ostan'])) {
    $id_ostan = $_GET['id_ostan'];
}
if (!$z_sal && isset($_GET['z_sal'])) {
    $z_sal = $_GET['z_sal'];
}
if (!$selected_season && isset($_GET['fasle'])) {
    $selected_season = $_GET['fasle'];
}

// تعریف ترتیب فصل‌ها با گزینه «کل سال زراعی» در انتها
$seasons_order = array('پاییز', 'زمستان', 'بهار', 'تابستان', 'کل سال زراعی');

// اگر انتخاب نامعتبر بود، اصلاح شود
if (!in_array($selected_season, $seasons_order)) {
    $selected_season = 'پاییز';
}

// اگر id_ostan یا z_sal دریافت نشد، پیام خطا
if (!$id_ostan || !$z_sal) {
    ?>
    <!DOCTYPE html>
    <html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <title>خطا</title>
        <link href="../../FA.css" rel="stylesheet" type="text/css" />
        <style>
            body { font-family: 'myfont2', Tahoma, Arial, sans-serif; background: #f5f7fa; padding: 40px; }
            .error-box { max-width: 600px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); text-align: center; }
            .error-box h2 { color: #F44336; }
        </style>
    </head>
    <body>
        <div class="error-box">
            <h2>خطا در دریافت اطلاعات</h2>
            <p>پارامترهای لازم برای نمایش نمودار شهرستان دریافت نشد.</p>
            <p>لطفاً از صفحه اصلی نمودار استان اقدام کنید.</p>
            <br>
            <button onclick="window.close()" style="padding:10px 30px;background:#4CAF50;color:#fff;border:none;border-radius:6px;font-size:16px;cursor:pointer;">بستن پنجره</button>
        </div>
    </body>
    </html>
    <?php
    exit;
}

$dbh = get_db_connection();
if (!$dbh) {
    die('<div class="card info-message"><p>خطا در اتصال به پایگاه داده.</p></div>');
}

// ----------------------------------------------
// دریافت اطلاعات استان (برای نمایش نام)
$stmt_ostan = execute_prepared_statement(
    "SELECT ostan FROM ostanname WHERE id_ostan = ?",
    array($id_ostan)
);
$ostan_name = $id_ostan;
if ($stmt_ostan && $row = $stmt_ostan->fetch(PDO::FETCH_ASSOC)) {
    $ostan_name = $row['ostan'];
}

// ----------------------------------------------
// اگر گزینه «کل سال زراعی» انتخاب شده باشد، جمع تمام فصل‌ها
if ($selected_season == 'کل سال زراعی') {
    // کوئری برای دریافت مجموع همه فصل‌ها به تفکیک شهرستان
    $query = "
        SELECT
            id_city,
            city,
            SUM(s_city) AS s_city,
            SUM(s_es_city) AS s_es_city,
            SUM(s_ba_city) AS s_ba_city
        FROM sokht_city
        WHERE z_sal = ?
          AND id_ostan = ?
        GROUP BY id_city, city
        ORDER BY city
    ";
    $stmt = execute_prepared_statement($query, array($z_sal, $id_ostan));
} else {
    // کوئری برای یک فصل خاص
    $query = "
        SELECT
            id_city,
            city,
            s_city,
            s_es_city,
            s_ba_city
        FROM sokht_city
        WHERE z_sal = ?
          AND id_ostan = ?
          AND fasle = ?
        ORDER BY city
    ";
    $stmt = execute_prepared_statement($query, array($z_sal, $id_ostan, $selected_season));
}

$rows = array();
if ($stmt) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $row;
    }
}

if (empty($rows)) {
    ?>
    <!DOCTYPE html>
    <html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <title>نمودار شهرستان</title>
        <link href="../../FA.css" rel="stylesheet" type="text/css" />
        <style>
            body { font-family: 'myfont2', Tahoma, Arial, sans-serif; background: #f5f7fa; padding: 40px; }
            .container { max-width: 1000px; margin: 0 auto; }
            .card { background: #fff; padding: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
            .info-message { text-align: center; padding: 24px; background-color: #fff3e0; border: 1px solid #ffcc80; border-radius: 8px; color: #e65100; font-size: 1.2rem; }
            .close-btn { background-color: #F44336; color: white; padding: 12px 24px; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; font-family: 'myfont2', Tahoma, Arial, sans-serif; }
            .close-btn:hover { background-color: #D32F2F; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="card info-message">
                <p>هیچ شهرستانی برای استان <strong><?php echo htmlspecialchars($ostan_name); ?></strong> در سال زراعی <strong><?php echo htmlspecialchars($z_sal); ?></strong> و فصل <strong><?php echo htmlspecialchars($selected_season); ?></strong> یافت نشد.</p>
            </div>
            <div style="text-align:center;margin-top:20px;">
                <button class="close-btn" onclick="window.close()">بستن پنجره</button>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// ----------------------------------------------
// آماده‌سازی داده‌ها برای نمودار
$labels = array();
$data_s_city = array();
$data_s_es_city = array();
$data_s_ba_city = array();

$sum_s_city = 0;
$sum_s_es_city = 0;
$sum_s_ba_city = 0;

foreach ($rows as $row) {
    $city_name = $row['city'];
    $s_city = (float)$row['s_city'];
    $s_es_city = (float)$row['s_es_city'];
    $s_ba_city = (float)$row['s_ba_city'];
    
    $labels[] = $city_name;
    $data_s_city[] = $s_city;
    $data_s_es_city[] = $s_es_city;
    $data_s_ba_city[] = $s_ba_city;
    
    $sum_s_city += $s_city;
    $sum_s_es_city += $s_es_city;
    $sum_s_ba_city += $s_ba_city;
}

// ----------------------------------------------
// ساخت مجموعه‌های داده (datasets) برای Chart.js
$datasets = array();

// 1. سهمیه شهرستان (آبی)
$datasets[] = array(
    'label' => 'سهمیه شهرستان (جمع: ' . number_format($sum_s_city) . ')',
    'data' => $data_s_city,
    'backgroundColor' => '#2196F3',
    'borderColor' => '#2196F3',
    'borderWidth' => 1
);

// 2. استفاده‌شده (قرمز)
$datasets[] = array(
    'label' => 'استفاده‌شده (جمع: ' . number_format($sum_s_es_city) . ')',
    'data' => $data_s_es_city,
    'backgroundColor' => '#F44336',
    'borderColor' => '#F44336',
    'borderWidth' => 1
);

// 3. باقی‌مانده (سبز)
$datasets[] = array(
    'label' => 'باقی‌مانده (جمع: ' . number_format($sum_s_ba_city) . ')',
    'data' => $data_s_ba_city,
    'backgroundColor' => '#4CAF50',
    'borderColor' => '#4CAF50',
    'borderWidth' => 1
);

// تبدیل به JSON
$labels_json = json_encode($labels);
$datasets_json = json_encode($datasets);

// ----------------------------------------------
// شروع خروجی HTML
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نمودار شهرستان - <?php echo htmlspecialchars($ostan_name); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../../15_files/chart.js"></script> 
    <style>
        :root {
            --primary-color: #4CAF50;
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
            gap: 24px;
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
        h2 small {
            font-size: 1.2rem;
            color: #666;
            display: block;
            margin-top: 4px;
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
        .filter-bar .info-text {
            background: #e3f2fd;
            padding: 6px 14px;
            border-radius: 6px;
            color: #0d47a1;
            font-size: 0.95rem;
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

    <!-- فرم فیلترها (فقط فصل قابل تغییر است) -->
    <div class="filter-bar">
        <div class="filter-group">
            <span class="info-text">استان: <strong><?php echo htmlspecialchars($ostan_name); ?></strong></span>
        </div>
        <div class="filter-group">
            <span class="info-text">سال زراعی: <strong><?php echo htmlspecialchars($z_sal); ?></strong></span>
        </div>
        <div class="filter-group">
            <form method="POST" action="" id="filterForm" style="display: flex; gap: 16px; align-items: center;">
                <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan); ?>">
                <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>">
                <label for="season">فصل:</label>
                <select name="fasle" id="season" onchange="document.getElementById('filterForm').submit();">
                    <?php foreach ($seasons_order as $season): ?>
                        <option value="<?php echo $season; ?>" <?php echo ($season == $selected_season) ? 'selected' : ''; ?>>
                            <?php echo $season; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <noscript>
                    <button type="submit" style="padding:6px 16px;">اعمال</button>
                </noscript>
            </form>
        </div>
    </div>

    <!-- کارت نمودار -->
    <div class="card">
        <h2>
            نمودار وضعیت سهمیه و مصرف سوخت شهرستان‌های <?php echo htmlspecialchars($ostan_name); ?>
            <small>سال زراعی: <?php echo htmlspecialchars($z_sal); ?> - فصل: <?php echo htmlspecialchars($selected_season); ?></small>
        </h2>
        <div class="chart-container">
            <canvas id="cityChart"></canvas>
        </div>
    </div>
    
    <script>
    var labels = <?php echo $labels_json; ?>;
    var datasets = <?php echo $datasets_json; ?>;

    function createChart(ctxId, chartTitle, chartDatasets, unit) {
        var ctx = document.getElementById(ctxId).getContext('2d');
        
        var chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: chartDatasets
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    x: {
                        stacked: false,
                        ticks: {
                            autoSkip: false,
                            font: { family: 'myfont2', size: 11 }
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
                                var label = context.dataset.label || '';
                                if (label) {
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
    var myChart = createChart('cityChart', 'منبع : سامانه سدف', datasets, 'لیتر');
    </script>

</div>

</body>
</html>