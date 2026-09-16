<?php
// PHP 5.2.3 Compatibility Notice:
// This code is written to be compatible with PHP 5.2.3.

// Ensure all necessary files are included
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once("../../login/config.php");

// Sanitize user inputs
$id_ostan = isset($_POST['id_ostan']) ? htmlspecialchars($_POST['id_ostan'], ENT_QUOTES) : '';

// Function to handle database connections (assuming $dbh is a global or included PDO object)
function get_db_connection() {
    global $dbh;
    if (!$dbh) {
        return null;
    }
    return $dbh;
}

// Function to safely execute a prepared statement
function execute_prepared_statement($query, $params) {
    $dbh = get_db_connection();
    if (!$dbh) {
        return null;
    }
    $stmt = $dbh->prepare($query);
    if ($stmt->execute($params)) {
        return $stmt;
    }
    return null;
}

// تابع برای دریافت نام استان
function get_ostan_name($id_ostan) {
    $dbh = get_db_connection();
    if (!$dbh) {
        return 'استان ناشناخته';
    }
    $query = "SELECT ostan FROM `ostanname` WHERE id_ostan = :id_ostan LIMIT 1";
    // اجرای کوئری با PDO
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id_ostan' => $id_ostan));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['ostan'] : 'استان ناشناخته';
}

$ostan_name = get_ostan_name($id_ostan);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نمودار میزان کود تحویلی شهرستان‌های <?php echo htmlspecialchars($ostan_name, ENT_QUOTES); ?></title>
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

        .close-btn:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .container {
                padding: 16px;
            }
            h2 {
                font-size: 1.5rem;
            }
            .close-btn-container {
                top: 10px;
                left: 10px;
            }
        }
    </style>
</head>
<body>

<div class="close-btn-container">
    <button class="close-btn" onclick="window.close()">بستن پنجره</button>
</div>

<div class="container">
    <?php
    if (!empty($id_ostan)) {
        $dbh = get_db_connection();
        if ($dbh) {
            
            // کوئری SQL برای نمایش اطلاعات شهرستان‌های استان انتخاب شده
            $query = "
                SELECT
                    c.city,
                    list_kood.group_name,
                    SUM(kood_kol.Count) AS total_count
                FROM kood_kol
                INNER JOIN list_kood ON list_kood.code = kood_kol.code
                JOIN cityname c ON kood_kol.id_city = c.id_city AND kood_kol.id_ostan = c.id_ostan
                WHERE kood_kol.id_ostan = :id_ostan_target and kood_kol.category in (0,4)
                GROUP BY c.city, list_kood.group_name
                ORDER BY c.city, list_kood.group_name
            ";
            
            $stmt = execute_prepared_statement($query, array(':id_ostan_target' => $id_ostan));

            if ($stmt && $stmt->rowCount() > 0) {
                
                $labels = array();          
                $datasets_map = array();    
                $group_totals = array();    
                $total_global_count = 0.0;  

                // تعریف ترتیب سفارشی گروه‌ها
                $custom_order = array('پتاسه', 'ازته', 'فسفاته', 'سایر');

                // مرحله اول: جمع‌آوری داده‌ها، لیست شهرستان‌ها و محاسبه مجموع گروه‌ها
                foreach($stmt as $row) {
                    $city = $row['city'];
                    $group_name = $row['group_name'];
                    $total_count = (float)$row['total_count']/1000; // تبدیل به تن
                    
                    if (!in_array($city, $labels)) {
                        $labels[] = $city;
                    }
                    
                    if (!isset($datasets_map[$group_name])) {
                        $datasets_map[$group_name] = array();
                        $group_totals[$group_name] = 0.0; 
                    }
                    
                    $datasets_map[$group_name][$city] = $total_count;
                    $group_totals[$group_name] += $total_count;

                    $total_global_count += $total_count;
                }
                
                $labels = array_values(array_unique($labels));

                // تعریف پالت رنگی (همانند فایل اصلی)
                $colors = array('#0077B6', '#FFC107', '#4CAF50', '#F44336', '#9C27B0', '#00BCD4', '#FF9800', '#795548', '#FF6384', '#36A2EB');
                $color_index = 0;

                // مرحله دوم: تبدیل نقشه به فرمت Datasets مورد نیاز Chart.js
                $datasets = array();

                // ۱. ساختن Datasets بر اساس ترتیب سفارشی
                foreach ($custom_order as $group_name) {
                    if (isset($datasets_map[$group_name])) {
                        
                        $final_data = array();
                        $data_map = $datasets_map[$group_name];
                        
                        foreach ($labels as $city) {
                            $final_data[] = isset($data_map[$city]) ? $data_map[$city] : 0.0;
                        }

                        $formatted_total = number_format($group_totals[$group_name]);
                        $new_label = $group_name . " (جمع: " . $formatted_total . " تن)";

                        $datasets[] = array(
                            'label' => $new_label, 
                            'data' => $final_data,
                            'backgroundColor' => $colors[$color_index % count($colors)],
                            'borderColor' => $colors[$color_index % count($colors)],
                            'borderWidth' => 1
                        );
                        $color_index++;
                    }
                }
                
                // ۲. (اختیاری) اضافه کردن سایر گروه‌ها
                foreach (array_keys($datasets_map) as $group_name) {
                    if (!in_array($group_name, $custom_order)) {
                        $data_map = $datasets_map[$group_name];
                        $final_data = array();
                        foreach ($labels as $city) {
                            $final_data[] = isset($data_map[$city]) ? $data_map[$city] : 0.0;
                        }
                        
                        $formatted_total = number_format($group_totals[$group_name]);
                        $new_label = $group_name . " (جمع: " . $formatted_total . " تن)";

                        $datasets[] = array(
                            'label' => $new_label, 
                            'data' => $final_data,
                            'backgroundColor' => $colors[$color_index % count($colors)],
                            'borderColor' => $colors[$color_index % count($colors)],
                            'borderWidth' => 1
                        );
                        $color_index++;
                    }
                }


                
                // تبدیل به JSON برای انتقال به جاوااسکریپت
                $labels_json = json_encode($labels);
                $datasets_json = json_encode($datasets);
                $total_global_count_json = json_encode($total_global_count);
    ?>
    <div class="card">
        <h2 class="chart-title">نمودار میزان کود تحویلی شهرستان‌های استان <?php echo htmlspecialchars($ostan_name, ENT_QUOTES); ?></h2>
        <div class="chart-container">
            <canvas id="cityFertilizerChart"></canvas>
        </div>
    </div>
    
    <script>
    // JavaScript for Chart.js
    const labels = <?php echo $labels_json; ?>;
    const datasets = <?php echo $datasets_json; ?>; 
    const total_global_count = <?php echo $total_global_count_json; ?>;

    // Function to create a single chart
    function createChart(ctxId, chartTitle, chartDatasets, total, unit) {
        const ctx = document.getElementById(ctxId).getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, 
                datasets: chartDatasets 
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                        ticks: {
                            autoSkip: false,
                            font: { family: 'myfont2' }
                        }
                    },
                    y: {
                        stacked: true,
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
                        labels: {
                            font: { family: 'myfont2', size: 14 }
                        }
                    },
                    title: {
                        display: true,
                        text: `${chartTitle} - مجموع کل: ${total.toLocaleString()}`, 
                        font: { family: 'myfont2', size: 16 }
                    }
                }
            }
        });
    }

    // Create the city fertilizer chart
    createChart('cityFertilizerChart', 'نمودار میزان کود تحویلی شهرستان‌ها', datasets, total_global_count, 'تن');

    </script>

    <?php
            } else {
                echo '<div class="card info-message"><p>اطلاعاتی برای شهرستان‌های استان ' . htmlspecialchars($ostan_name, ENT_QUOTES) . ' یافت نشد.</p></div>';
            }
        } else {
            echo '<div class="card info-message"><p>خطا در اتصال به پایگاه داده.</p></div>';
        }
    } else {
        echo '<div class="card info-message"><p>لطفا کد استان مورد نیاز را وارد کنید.</p></div>';
    }
    ?>
</div>

</body>
</html>