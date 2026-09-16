<?php
// PHP 5.2.3 Compatibility Notice:
// This code is written to be compatible with PHP 5.2.3.
// It is strongly recommended to upgrade to a supported PHP version (e.g., PHP 8.x)
// for security and performance benefits.

// Ensure all necessary files are included
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once("../../login/config.php");

// Function to handle database connections (assuming $dbh is a global or included PDO object)
function get_db_connection() {
    global $dbh;
    if (!$dbh) {
        // Handle database connection error if needed
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
    // PDO::prepare is generally available in PHP 5.1+, which covers 5.2.3/5.3.3.
    $stmt = $dbh->prepare($query);
    
    // اجرای کوئری
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
    <title>نمودار میزان کود تحویلی</title>
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
            cursor: pointer; /* اضافه شده برای نشان دادن کلیک‌پذیر بودن */
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
    // Main Chart Data Processing Logic
    if (1==1) {
        $dbh = get_db_connection();
        if ($dbh) {
            
            // **کوئری SQL جدید: اضافه کردن id_ostan برای drill-down**
          $query = "
                SELECT
                    osn.id_ostan,
                    osn.ostan,
                    list_kood.group_name,
                    SUM(kood_kol.Count) AS total_count
                FROM kood_kol
                INNER JOIN list_kood ON list_kood.code = kood_kol.code
                JOIN ostanname osn ON kood_kol.id_ostan = osn.id_ostan
                 WHERE  kood_kol.category = 1 
                GROUP BY osn.id_ostan, osn.ostan, list_kood.group_name
                ORDER BY osn.ostan, list_kood.group_name
            ";
            $stmt = execute_prepared_statement($query, array());

            if ($stmt && $stmt->rowCount() > 0) {
                
                // **ساختار داده جدید برای Chart.js (Pivoting)**
                $labels = array();          
                $datasets_map = array();    
                $group_totals = array();    
                $total_global_count = 0.0;  
                // **جدید: نگاشت نام استان به ID آن**
                $ostan_id_map = array(); 

                // **جدید: تعریف ترتیب سفارشی گروه‌ها**
                $custom_order = array('پتاسه', 'ازته', 'فسفاته', 'سایر');
                $remaining_groups = array(); 

                // مرحله اول: جمع‌آوری داده‌ها، لیست استان‌ها و محاسبه مجموع گروه‌ها
                foreach($stmt as $row) {
                    // **جدید: دریافت ID استان**
                    $id_ostan = $row['id_ostan']; 
                    $ostan = $row['ostan'];
                    $group_name = $row['group_name'];
                    $total_count = (float)$row['total_count']/1000;
                    
                    if (!in_array($ostan, $labels)) {
                        $labels[] = $ostan;
                        $ostan_id_map[$ostan] = $id_ostan; // ذخیره ID
                    }
                    
                    if (!isset($datasets_map[$group_name])) {
                        $datasets_map[$group_name] = array();
                        $group_totals[$group_name] = 0.0; 
                    }
                    
                    $datasets_map[$group_name][$ostan] = $total_count;
                    $group_totals[$group_name] += $total_count;

                    $total_global_count += $total_count;
                }
                
                $labels = array_values(array_unique($labels));

                // **تعریف پالت رنگی**
                $colors = array('#0077B6', '#FFC107', '#4CAF50', '#F44336', '#9C27B0', '#00BCD4', '#FF9800', '#795548', '#FF6384', '#36A2EB');
                $color_index = 0;

                // **مرحله دوم: تبدیل نقشه به فرمت Datasets مورد نیاز Chart.js**
                $datasets = array();

                // 1. ساختن Datasets بر اساس ترتیب سفارشی
                foreach ($custom_order as $group_name) {
                    if (isset($datasets_map[$group_name])) {
                        
                        $final_data = array();
                        $data_map = $datasets_map[$group_name];
                        
                        // اطمینان از اینکه داده‌ها دقیقاً با ترتیب labels مطابقت داشته باشند.
                        foreach ($labels as $ostan) {
                            $final_data[] = isset($data_map[$ostan]) ? $data_map[$ostan] : 0.0;
                        }

                        // اضافه کردن مجموع گروه به لیبل
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
                
                // 2. (اختیاری) اضافه کردن سایر گروه‌هایی که در $custom_order نبودند (اگر وجود داشته باشند)
                foreach (array_keys($datasets_map) as $group_name) {
                    if (!in_array($group_name, $custom_order)) {
                         // اگر گروهی در لیست سفارشی نبود، آن را به آخر اضافه کن
                        $data_map = $datasets_map[$group_name];
                        $final_data = array();
                        foreach ($labels as $ostan) {
                            $final_data[] = isset($data_map[$ostan]) ? $data_map[$ostan] : 0.0;
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
                // **جدید: تبدیل نقشه ID استان به JSON**
                $ostan_id_map_json = json_encode($ostan_id_map);
    ?>
    <div class="card">
        <h2 class="chart-title">نمودار میزان کود تحویلی به تفکیک استان و گروه کود </h2>
        <div class="chart-container">
            <canvas id="fertilizerChart"></canvas>
        </div>
    </div>
    
    <script>
    // JavaScript for Chart.js
    const labels = <?php echo $labels_json; ?>;
    const datasets = <?php echo $datasets_json; ?>; 
    const total_global_count = <?php echo $total_global_count_json; ?>;
    const ostan_id_map = <?php echo $ostan_id_map_json; ?>; 

    // Function to create a single chart
    function createChart(ctxId, chartTitle, chartDatasets, total, unit) {
        const ctx = document.getElementById(ctxId).getContext('2d');
        
        // **تغییر ۱: ذخیره نمونه (Instance) نمودار در یک متغیر محلی**
        const chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, 
                datasets: chartDatasets 
            },
            options: {
                responsive: true,
                // **تغییر ۲: استفاده از chartInstance به جای myChart در onClick**
                onClick: (e) => {
                    // **خطای شما در اینجا بود. myChart در این Scope تعریف نشده بود.**
                    const points = chartInstance.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
                    if (points.length) {
                        const firstPoint = points[0];
                        const labelIndex = firstPoint.index;
                        const ostanName = labels[labelIndex];
                        const ostanId = ostan_id_map[ostanName]; // دریافت ID استان
                        
                        if (ostanId) {
                            const postData = {
                                id_ostan: ostanId
                            };

                            const form = document.createElement('form');
                            form.method = 'POST';
                            // **تغییر ۳: استفاده از نام فایل جدید payesh_L2_chart.php**
                            form.action = 'payesh_L2_chart.php'; 
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
                            
                            // نام پنجره پاپ‌آپ را ثابت نگه می‌داریم تا اگر مجدد کلیک شد، پنجره قبلی رفرش شود
                            window.open('about:blank', 'Payesh_L2_popup', 'location=1,status=1,scrollbars=1,width=1000,height=800,top=50,left=50');
                            document.body.appendChild(form);
                            form.submit();
                            document.body.removeChild(form);
                        }
                    }
                },
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

        // **تغییر ۴: بازگرداندن نمونه نمودار (اختیاری، اما برای حفظ ساختار خوب است)**
        return chartInstance;
    }

    // Create the fertilizer chart
    // myChart اکنون نمونه واقعی نمودار را دریافت می‌کند، اما مهمتر از آن، کد onClick دیگر به آن وابسته نیست.
    const myChart = createChart('fertilizerChart', 'نمودار میزان کود تحویلی', datasets, total_global_count, 'تن');

    </script>
    <?php
            } else {
                echo '<div class="card info-message"><p>اطلاعاتی برای کوئری مورد نظر یافت نشد.</p></div>';
            }
        } else {
            echo '<div class="card info-message"><p>خطا در اتصال به پایگاه داده.</p></div>';
        }
    } else {
        echo '<div class="card info-message"><p>لطفا ورودی‌های مورد نیاز را وارد کنید.</p></div>';
    }
    ?>
</div>

</body>
</html>