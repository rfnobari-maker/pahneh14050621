<?php
// PHP 5.2.3 Compatibility Notice:
// This code is written to be compatible with PHP 5.2.3.
// It is strongly recommended to upgrade to a supported PHP version (e.g., PHP 8.x)
// for security and performance benefits.

// Ensure all necessary files are included
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once("../../login/config.php");

// Sanitize user inputs to prevent XSS attacks.
// Note: filter_input() is not available in PHP 5.2.3, so we use htmlspecialchars().
$z_sal = isset($_POST['z_sal']) ? htmlspecialchars($_POST['z_sal'], ENT_QUOTES) : '';

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
    $stmt = $dbh->prepare($query);
    foreach ($params as $key => $value) {
        // Use bindParam for better security and type-checking
        $stmt->bindParam($key, $params[$key]);
    }
    $stmt->execute();
    return $stmt;
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نمودارهای آماری</title>
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
        
        /* New styling for the button container */
        .close-btn-container {
            position: fixed; /* Use fixed to keep it in place while scrolling */
            top: 20px;
            left: 20px;
            z-index: 1000; /* Ensure it is on top of other elements */
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
    // Check if the required input variable is set
    if (!empty($z_sal)) {
        $dbh = get_db_connection();
        if ($dbh) {
            // Query to get the total official cultivation area (s_dem and s_abi) and production (t_dem and t_abi)
            $query_sum_ostan = "
                SELECT 
                    SUM(s_dem) AS total_s_dem, 
                    SUM(s_abi) AS total_s_abi,
                    SUM(t_dem) AS total_t_dem, 
                    SUM(t_abi) AS total_t_abi
                FROM Agri_ab_ostan 
                WHERE z_sal = :z_sal";
            $stmt_sum_ostan = execute_prepared_statement($query_sum_ostan, array(
                ':z_sal'     => $z_sal
            ));
            $sum_ostan_row = $stmt_sum_ostan ? $stmt_sum_ostan->fetch(PDO::FETCH_ASSOC) : null;
            $total_s_dem = $sum_ostan_row ? (float)$sum_ostan_row['total_s_dem'] : 0;
            $total_s_abi = $sum_ostan_row ? (float)$sum_ostan_row['total_s_abi'] : 0;
            $total_t_dem = $sum_ostan_row ? (float)$sum_ostan_row['total_t_dem'] : 0;
            $total_t_abi = $sum_ostan_row ? (float)$sum_ostan_row['total_t_abi'] : 0;

            // Query to get province-specific data
            $query = "
                SELECT 
                    osn.ostan,
                    SUM(o.s_dem) AS total_s_dem,
                    SUM(o.s_abi) AS total_s_abi,
                    SUM(o.t_dem) AS total_t_dem,
                    SUM(o.t_abi) AS total_t_abi
                FROM Agri_ab_ostan o
                JOIN ostanname osn ON o.id_ostan = osn.id_ostan
                WHERE o.z_sal = :z_sal
                GROUP BY osn.ostan
                ORDER BY FIELD(o.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')
            ";
            $stmt = execute_prepared_statement($query, array(
                ':z_sal'     => $z_sal
            ));

            if ($stmt && $stmt->rowCount() > 0) {
                $province_names = array();
                $s_dem_data = array();
                $s_abi_data = array();
                $t_dem_data = array();
                $t_abi_data = array();

                foreach($stmt as $row) {
                    $province_names[] = $row['ostan'];
                    $s_dem_data[] = (float)$row['total_s_dem'];
                    $s_abi_data[] = (float)$row['total_s_abi'];
                    $t_dem_data[] = (float)$row['total_t_dem'];
                    $t_abi_data[] = (float)$row['total_t_abi'];
                }
                
                // JSON encoding for JavaScript
                $province_names_json = json_encode($province_names);
                $s_dem_data_json = json_encode($s_dem_data);
                $s_abi_data_json = json_encode($s_abi_data);
                $t_dem_data_json = json_encode($t_dem_data);
                $t_abi_data_json = json_encode($t_abi_data);
                
                // Total values
                $total_s_abi_json = json_encode($total_s_abi);
                $total_s_dem_json = json_encode($total_s_dem);
                $total_t_abi_json = json_encode($total_t_abi);
                $total_t_dem_json = json_encode($total_t_dem);
    ?>
    <div class="card">
        <h2 class="chart-title">نمودار مقایسه‌ای سطح (آبی و دیم)</h2>
        <div class="chart-container">
            <canvas id="sChart"></canvas>
        </div>
    </div>
    
    <div class="card">
        <h2 class="chart-title">نمودار مقایسه‌ای پیش بینی تولید (آبی و دیم)</h2>
        <div class="chart-container">
            <canvas id="tChart"></canvas>
        </div>
    </div>

    <script>
// JavaScript for Chart.js
const labels = <?php echo $province_names_json; ?>;
const s_dem_data = <?php echo $s_dem_data_json; ?>;
const s_abi_data = <?php echo $s_abi_data_json; ?>;
const t_dem_data = <?php echo $t_dem_data_json; ?>;
const t_abi_data = <?php echo $t_abi_data_json; ?>;

const total_s_abi = <?php echo $total_s_abi_json; ?>;
const total_s_dem = <?php echo $total_s_dem_json; ?>;
const total_t_abi = <?php echo $total_t_abi_json; ?>;
const total_t_dem = <?php echo $total_t_dem_json; ?>;

// Function to create a chart
function createChart(ctxId, chartTitle, demData, abiData, demTotal, abiTotal, unit) {
    const ctx = document.getElementById(ctxId).getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: `دیم`,
                data: demData,
                backgroundColor: '#FFBE0B', // رنگ جدید برای دیم
                borderColor: '#FB5607',
                borderWidth: 1
            }, {
                label: `آبی`,
                data: abiData,
                backgroundColor: '#3A86FF', // رنگ جدید برای آبی
                borderColor: '#8338EC',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    rtl: true,
                    labels: {
                        font: {
                            size: 14,
                            family: 'myfont2'
                        }
                    }
                },
                title: {
                    display: true,
                    text: `${chartTitle} - مجموع آبی: ${abiTotal.toLocaleString()} و مجموع دیم: ${demTotal.toLocaleString()}`,
                    font: {
                        size: 16,
                        family: 'myfont2'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: `${unit}`,
                        font: {
                            size: 14,
                            family: 'myfont2'
                        }
                    }
                },
                x: {
                    ticks: {
                        autoSkip: false,
                        font: {
                            family: 'myfont2'
                        }
                    }
                }
            }
        }
    });
}

// Create the charts
createChart('sChart', 'نمودار سطح', s_dem_data, s_abi_data, total_s_dem, total_s_abi, 'هکتار');
createChart('tChart', 'نمودار پیش بینی تولید', t_dem_data, t_abi_data, total_t_dem, total_t_abi, 'تن');

    </script>

    <?php
            } else {
                echo '<div class="card info-message"><p>اطلاعاتی برای سال زراعی انتخاب شده یافت نشد.</p></div>';
            }
        } else {
            echo '<div class="card info-message"><p>خطا در اتصال به پایگاه داده.</p></div>';
        }
    } else {
        echo '<div class="card info-message"><p>لطفا سال زراعی مورد نیاز را وارد کنید.</p></div>';
    }
    ?>
</div>

</body>
</html>