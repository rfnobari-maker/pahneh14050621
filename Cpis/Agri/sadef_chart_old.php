<?php
// PHP 5.2.3 Compatibility Notice
require_once("../../lock_cp.php");
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
            cursor: pointer;
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

        @media (max-width: 768px) {
            .container { padding: 16px; }
            h2 { font-size: 1.5rem; }
            .close-btn-container { top: 10px; left: 10px; }
        }
    </style>
</head>
<body>

<div class="close-btn-container">
    <button class="close-btn" onclick="window.close()">بستن پنجره</button>
</div>

<div class="container">
    <?php
    if (1==1) {
        $dbh = get_db_connection();
        if ($dbh) {
            
            $query = "
                SELECT
                    osn.id_ostan,
                    osn.ostan,
                    SUM(sd.s_sal) AS total_s_sal,
                    SUM(sd.s_payez) AS total_s_payez,
                    SUM(sd.s_t_ostan) AS total_s_t_ostan,
                    SUM(sd.s_est) AS total_s_est,
                    SUM(sd.s_baghi) AS total_s_baghi
                FROM sokht_data sd
                JOIN ostanname osn ON sd.id_ostan = osn.id_ostan
                GROUP BY osn.id_ostan, osn.ostan
                ORDER BY osn.ostan
            ";
            $stmt = execute_prepared_statement($query, array());

            if ($stmt && $stmt->rowCount() > 0) {
                
                $labels = array();          
                $ostan_id_map = array(); 
                
                $data_s_sal = array();     
                $data_s_payez = array();   
                $data_s_t_ostan = array(); 
                $data_s_est = array();     
                $data_s_baghi = array();   

                $sum_s_sal = 0;
                $sum_s_payez = 0;
                $sum_s_t_ostan = 0;
                $sum_s_est = 0;
                $sum_s_baghi = 0;

                foreach($stmt as $row) {
                    $id_ostan = $row['id_ostan']; 
                    $ostan = $row['ostan'];
                    
                    $labels[] = $ostan;
                    $ostan_id_map[$ostan] = $id_ostan;

                    $val_sal = (float)$row['total_s_sal'];
                    $val_payez = (float)$row['total_s_payez'];
                    $val_t_ostan = (float)$row['total_s_t_ostan'];
                    $val_est = (float)$row['total_s_est'];
                    $val_baghi = (float)$row['total_s_baghi'];

                    $data_s_sal[] = $val_sal;
                    $data_s_payez[] = $val_payez;
                    $data_s_t_ostan[] = $val_t_ostan;
                    $data_s_est[] = $val_est;
                    $data_s_baghi[] = $val_baghi;

                    $sum_s_sal += $val_sal;
                    $sum_s_payez += $val_payez;
                    $sum_s_t_ostan += $val_t_ostan;
                    $sum_s_est += $val_est;
                    $sum_s_baghi += $val_baghi;
                }
                
                $datasets = array();

                // 1. سهمیه سالانه
                $datasets[] = array(
                    'label' => 'سهمیه سالانه (جمع: ' . number_format($sum_s_sal) . ')',
                    'data' => $data_s_sal,
                    'backgroundColor' => '#2196F3',
                    'borderColor' => '#2196F3',
                    'borderWidth' => 1
                );

                // 2. سهمیه پاییز
                // ** تغییر رنگ اعمال شده **
                $datasets[] = array(
                    'label' => 'سهمیه پاییز (جمع: ' . number_format($sum_s_payez) . ')',
                    'data' => $data_s_payez,
                    'backgroundColor' => '#E1CC1F', // رنگ زرد مورد نظر
                    'borderColor' => '#E1CC1F',
                    'borderWidth' => 1
                );

                 // 3. برش شهرستانی
                 $datasets[] = array(
                    'label' => 'برش شهرستانی (جمع: ' . number_format($sum_s_t_ostan) . ')',
                    'data' => $data_s_t_ostan,
                    'backgroundColor' => '#9C27B0',
                    'borderColor' => '#9C27B0',
                    'borderWidth' => 1
                );

                // 4. میزان استفاده
                $datasets[] = array(
                    'label' => 'میزان استفاده (جمع: ' . number_format($sum_s_est) . ')',
                    'data' => $data_s_est,
                    'backgroundColor' => '#F44336',
                    'borderColor' => '#F44336',
                    'borderWidth' => 1
                );

                // 5. میزان باقی‌مانده
                $datasets[] = array(
                    'label' => 'میزان باقی‌مانده (جمع: ' . number_format($sum_s_baghi) . ')',
                    'data' => $data_s_baghi,
                    'backgroundColor' => '#4CAF50',
                    'borderColor' => '#4CAF50',
                    'borderWidth' => 1
                );

                $labels_json = json_encode($labels);
                $datasets_json = json_encode($datasets);
                $ostan_id_map_json = json_encode($ostan_id_map);
    ?>
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
                            const postData = { id_ostan: ostanId };
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
                            text: `${unit}`,
                            font: { family: 'myfont2', size: 14 }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        rtl: true,
                        labels: { font: { family: 'myfont2', size: 14 } }
                    },
                    title: {
                        display: true,
                        text: `${chartTitle}`, 
                        font: { family: 'myfont2', size: 16 }
                    },
                    tooltip: {
                        titleFont: { family: 'myfont2' },
                        bodyFont: { family: 'myfont2' },
                        rtl: true,
                        // **این بخش اضافه شد تا جمع کل در تول‌تیپ (هاور موس) نمایش داده نشود**
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    // جدا کردن متن قبل از پرانتز " (جمع:"
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

    const myChart = createChart('fuelChart', 'منبع : سامانه سدف', datasets, 'لیتر');

    </script>
    <?php
            } else {
                echo '<div class="card info-message"><p>اطلاعاتی در جدول سوخت یافت نشد.</p></div>';
            }
        } else {
            echo '<div class="card info-message"><p>خطا در اتصال به پایگاه داده.</p></div>';
        }
    } else {
        echo '<div class="card info-message"><p>خطا در پردازش درخواست.</p></div>';
    }
    ?>
</div>

</body>
</html>