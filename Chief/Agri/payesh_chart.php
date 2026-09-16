<?php
// PHP 5.2.3 Compatibility Notice
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once("../../login/config.php");

function get_db_connection() {
    global $dbh;
    return $dbh;
}

function execute_prepared_statement($query, $params) {
    $dbh = get_db_connection();
    if (!$dbh) return null;
    $stmt = $dbh->prepare($query);
    if ($stmt->execute($params)) return $stmt;
    return null;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نمودار عملکرد و برنامه کود تحویلی</title>
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
            --border-radius: 12px;
        }
        body {
            font-family: 'myfont2', Tahoma, Arial, sans-serif;
            background-color: var(--background-light);
            padding: 24px;
            margin: 0;
            direction: rtl;
        }
        .container { max-width: 1400px; margin: 0 auto; display: flex; flex-direction: column; gap: 20px; }
        .card { background: var(--card-background); padding: 20px; border-radius: var(--border-radius); box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        h2 { text-align: center; color: var(--primary-color); font-size: 1.2rem; margin-bottom: 20px; }
        
        .chart-container { 
            position: relative; 
            margin: auto; 
            height: 70vh; 
            width: 100%; 
        }

        .close-btn-container { position: fixed; top: 15px; left: 15px; z-index: 1000; }
        .close-btn { 
            background-color: #F44336; 
            color: white; 
            padding: 10px 20px; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            font-family: 'myfont2'; 
            font-size: 14px;
            transition: background 0.3s;
        }
        .close-btn:hover { background-color: #D32F2F; }

        @media (max-width: 768px) {
            body { padding: 10px; }
            .chart-container { height: 60vh; }
            h2 { font-size: 1rem; }
        }
    </style>
</head>
<body>

<div class="close-btn-container">
    <button class="close-btn" onclick="window.close()">بستن پنجره</button>
</div>

<div class="container">
    <?php
    $dbh = get_db_connection();
    if ($dbh) {
        $q_perf = "SELECT osn.id_ostan, osn.ostan, list_kood.group_name, SUM(kood_kol.Count) AS total_count 
                   FROM kood_kol 
                   INNER JOIN list_kood ON list_kood.code = kood_kol.code 
                   JOIN ostanname osn ON kood_kol.id_ostan = osn.id_ostan 
                   WHERE kood_kol.category in (0,4) 
                   GROUP BY osn.id_ostan, osn.ostan, list_kood.group_name";

        $q_plan = "SELECT osn.id_ostan, osn.ostan, kb.group_name, SUM(kb.Count) AS total_plan 
                   FROM kood_bar kb 
                   JOIN ostanname osn ON kb.id_ostan = osn.id_ostan 
                   GROUP BY osn.id_ostan, osn.ostan, kb.group_name";

        $stmt_perf = execute_prepared_statement($q_perf, array());
        $stmt_plan = execute_prepared_statement($q_plan, array());

        $labels = array();
        $ostan_id_map = array();
        $perf_map = array();
        $plan_map = array();
        $all_groups = array();
        $group_totals_perf = array();
        $group_totals_plan = array();
        $grand_total_perf = 0;
        $grand_total_plan = 0;

        if ($stmt_perf) {
            foreach($stmt_perf as $row) {
                $ostan = $row['ostan'];
                $grp = $row['group_name'];
                $val = (float)$row['total_count'] / 1000;
                if (!in_array($ostan, $labels)) { $labels[] = $ostan; $ostan_id_map[$ostan] = $row['id_ostan']; }
                if (!in_array($grp, $all_groups)) { $all_groups[] = $grp; }
                $perf_map[$grp][$ostan] = $val;
                $group_totals_perf[$grp] = (isset($group_totals_perf[$grp]) ? $group_totals_perf[$grp] : 0) + $val;
                $grand_total_perf += $val;
            }
        }

        if ($stmt_plan) {
            foreach($stmt_plan as $row) {
                $ostan = $row['ostan'];
                $grp = $row['group_name'];
                $val = (float)$row['total_plan'];
                if (!in_array($ostan, $labels)) { $labels[] = $ostan; $ostan_id_map[$ostan] = $row['id_ostan']; }
                if (!in_array($grp, $all_groups)) { $all_groups[] = $grp; }
                $plan_map[$grp][$ostan] = $val;
                $group_totals_plan[$grp] = (isset($group_totals_plan[$grp]) ? $group_totals_plan[$grp] : 0) + $val;
                $grand_total_plan += $val;
            }
        }

        sort($labels);
        $custom_order = array('پتاسه', 'ازته', 'فسفاته', 'سایر');
        foreach ($all_groups as $g) { if (!in_array($g, $custom_order)) { $custom_order[] = $g; } }

        // پالت رنگی مطابق با فایل payesh_L2_chart.php
        $colors = array('#0077B6', '#FFC107', '#4CAF50', '#F44336', '#9C27B0', '#00BCD4', '#FF9800', '#795548', '#FF6384', '#36A2EB');
        
        $datasets = array();

        // بخش اول: عملکرد (تحویلی) - رنگ‌های توپر
        $color_index = 0;
        foreach ($custom_order as $grp) {
            if (isset($perf_map[$grp])) {
                $d_perf = array(); 
                foreach($labels as $l) { $d_perf[] = isset($perf_map[$grp][$l]) ? $perf_map[$grp][$l] : 0; }
                $g_total_p = number_format($group_totals_perf[$grp]);
                $currentColor = $colors[$color_index % count($colors)];
                
                $datasets[] = array(
                    'label' => $grp . " (تحویلی - جمع: ".$g_total_p.")",
                    'pureLabel' => $grp . " (تحویلی)",
                    'data' => $d_perf,
                    'backgroundColor' => $currentColor,
                    'stack' => 'performance'
                );
                $color_index++;
            }
        }

        // بخش دوم: برنامه - رنگ‌های شفاف شده (Faded) برای تمایز بصری
        $color_index = 0; // ریست ایندکس برای همرنگ شدن گروه‌های مشابه در عملکرد و برنامه
        foreach ($custom_order as $grp) {
            if (isset($plan_map[$grp])) {
                $d_plan = array(); 
                foreach($labels as $l) { $d_plan[] = isset($plan_map[$grp][$l]) ? $plan_map[$grp][$l] : 0; }
                $g_total_pl = number_format($group_totals_plan[$grp]);
                $currentColor = $colors[$color_index % count($colors)];
                
                $datasets[] = array(
                    'label' => $grp . " (برنامه - جمع: ".$g_total_pl.")",
                    'pureLabel' => $grp . " (برنامه)",
                    'data' => $d_plan,
                    'backgroundColor' => $currentColor . '55', // شفافیت 33 درصد در فرمت هگز
                    'borderColor' => $currentColor,
                    'borderWidth' => 1,
                    'stack' => 'plan'
                );
                $color_index++;
            }
        }

        $total_title = "مجموع تحویلی: " . number_format($grand_total_perf) . " تن | مجموع برنامه: " . number_format($grand_total_plan) . " تن";
    ?>
    <div class="card">
        <h2>نمودار مقایسه‌ای عملکرد و برنامه کود به تفکیک استان</h2>
        <div class="chart-container">
            <canvas id="fertilizerChart"></canvas>
        </div>
    </div>

    <script>
    const ctx = document.getElementById('fertilizerChart').getContext('2d');
    const labels = <?php echo json_encode($labels); ?>;
    const ostan_id_map = <?php echo json_encode($ostan_id_map); ?>;

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: <?php echo json_encode($datasets); ?>
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            onClick: (e) => {
                const points = myChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
                if (points.length) {
                    const ostanName = labels[points[0].index];
                    const ostanId = ostan_id_map[ostanName];
                    if (ostanId) {
                        const form = document.createElement('form');
                        form.method = 'POST'; form.action = 'payesh_L2_chart.php'; form.target = 'Payesh_L2_popup';
                        const input = document.createElement('input');
                        input.type = 'hidden'; input.name = 'id_ostan'; input.value = ostanId;
                        form.appendChild(input);
                        window.open('about:blank', 'Payesh_L2_popup', 'width=1000,height=800');
                        document.body.appendChild(form); form.submit(); document.body.removeChild(form);
                    }
                }
            },
            scales: {
                x: { 
                    stacked: true, 
                    ticks: { 
                        font: { family: 'myfont2', size: 11 },
                        maxRotation: 45,
                        minRotation: 45 
                    } 
                },
                y: { 
                    stacked: true, 
                    beginAtZero: true, 
                    title: { display: true, text: 'مقدار (تن)', font: { family: 'myfont2' } },
                    ticks: { font: { family: 'myfont2', size: 11 } }
                }
            },
            plugins: {
                legend: { 
                    position: 'top', 
                    rtl: true, 
                    labels: { 
                        font: { family: 'myfont2', size: 11 }, 
                        boxWidth: 15,
                        padding: 10
                    } 
                },
                tooltip: {
                    rtl: true,
                    titleFont: { family: 'myfont2' },
                    bodyFont: { family: 'myfont2' },
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.pureLabel || '';
                            if (label) label += ': ';
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('fa-IR').format(context.parsed.y) + ' تن';
                            }
                            return label;
                        }
                    }
                },
                title: { 
                    display: true, 
                    text: '<?php echo $total_title; ?>', 
                    font: { family: 'myfont2', size: 15 } 
                }
            }
        }
    });
    </script>
    <?php } else { echo "خطا در اتصال به پایگاه داده."; } ?>
</div>
</body>
</html>