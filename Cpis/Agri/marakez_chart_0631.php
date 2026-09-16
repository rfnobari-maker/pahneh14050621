<?php
// PHP 5.2.3 Compatibility Notice:
// This code is written to be compatible with PHP 5.2.3.
// It is strongly recommended to upgrade to a supported PHP version (e.g., PHP 8.x)
// for security and performance benefits.

require_once("../../lock_cp.php");
require_once("../../event.php");
require_once("../../login/config.php");

// Sanitize user inputs to prevent XSS attacks.
 $z_sal = isset($_GET['z_sal']) ? htmlspecialchars($_GET['z_sal'], ENT_QUOTES) : '';
 $mah_qroup = isset($_GET['mah_qroup']) ? htmlspecialchars($_GET['mah_qroup'], ENT_QUOTES) : '';
 $mah_name = isset($_GET['mah_name']) ? htmlspecialchars($_GET['mah_name'], ENT_QUOTES) : '';
 $id_ostan = isset($_GET['id_ostan']) ? htmlspecialchars($_GET['id_ostan'], ENT_QUOTES) : '';
 $id_city = isset($_GET['id_city']) ? htmlspecialchars($_GET['id_city'], ENT_QUOTES) : '';

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
    <title>نمودار مراکز شهرستان</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap" rel="stylesheet">
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
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            background-color: var(--background-light);
            color: var(--text-color);
            margin: 0;
            padding: 24px;
            direction: rtl;
        }

        .close-btn-container {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 32px;
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
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
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
    if (!empty($mah_qroup) && !empty($mah_name) && !empty($z_sal) && !empty($id_city))
    {
        $dbh = get_db_connection();
        if ($dbh) {
            // Fetch city name for the title
            $city_query = "SELECT city FROM cityname WHERE id_ostan = :id_ostan and id_city = :id_city";
            $city_stmt = execute_prepared_statement($city_query, array(':id_ostan' => $id_ostan,':id_city' => $id_city));
            $city_name = $city_stmt->fetchColumn() ?: "نامشخص";

            // Fetch data for centers within the specific city
            $query = "
                SELECT
                    m.id_mar,
                    mn.mar,
                    IFNULL(m.s_dem, 0) AS s_dem_mar,
                    IFNULL(m.s_abi, 0) AS s_abi_mar
                FROM Agri_ab_mar m
                LEFT JOIN mar mn ON m.id_mar = mn.id_mar
                WHERE m.z_sal = :z_sal
                AND m.group_cod = :mah_qroup
                AND m.product_cod = :mah_name
                AND m.id_city = :id_city
				and m.id_ostan = :id_ostan
                ORDER BY binary mn.mar ASC;
            ";

            $stmt = execute_prepared_statement($query, array(
                ':z_sal'      => $z_sal,
                ':mah_qroup'  => $mah_qroup,
                ':mah_name'   => $mah_name,
                ':id_city'    => $id_city,
                ':id_ostan'    => $id_ostan ,

            ));
            
            if ($stmt && $stmt->rowCount() > 0) {
                $marakez_names = array();
                $s_dem_mar_data = array();
                $s_abi_mar_data = array();

                foreach($stmt as $row) {
                    $marakez_names[] = $row['mar'];
                    $s_dem_mar_data[] = (float)$row['s_dem_mar'];
                    $s_abi_mar_data[] = (float)$row['s_abi_mar'];
                }
                
                // JSON encoding for JavaScript
                $marakez_names_json = json_encode($marakez_names);
                $s_dem_mar_data_json = json_encode($s_dem_mar_data);
                $s_abi_mar_data_json = json_encode($s_abi_mar_data);
                
                // Calculate total values
                $total_s_abi_mar = array_sum($s_abi_mar_data);
                $total_s_dem_mar = array_sum($s_dem_mar_data);

                $total_s_abi_mar_json = json_encode($total_s_abi_mar);
                $total_s_dem_mar_json = json_encode($total_s_dem_mar);
    ?>
    <div class="card">
        <h2 class="chart-title">نمودار مقایسه ای سطح (آبی) محصول <?php echo htmlspecialchars(mah_name($mah_name), ENT_QUOTES); ?> مراکز شهرستان <?php echo htmlspecialchars($city_name, ENT_QUOTES); ?></h2>
        <div class="chart-container">
            <canvas id="abiChart"></canvas>
        </div>
    </div>

    <div class="card">
        <h2 class="chart-title">نمودار مقایسه ای سطح (دیم) محصول <?php echo htmlspecialchars(mah_name($mah_name), ENT_QUOTES); ?> مراکز شهرستان <?php echo htmlspecialchars($city_name, ENT_QUOTES); ?></h2>
        <div class="chart-container">
            <canvas id="demChart"></canvas>
        </div>
    </div>

    <script>
        // JavaScript for Chart.js
        const labels = <?php echo $marakez_names_json; ?>;

        const s_dem_mar_data = <?php echo $s_dem_mar_data_json; ?>;
        const s_abi_mar_data = <?php echo $s_abi_mar_data_json; ?>;
        
        const total_s_abi_mar = <?php echo $total_s_abi_mar_json; ?>;
        const total_s_dem_mar = <?php echo $total_s_dem_mar_json; ?>;

        // Function to create a chart
        function createChart(ctxId, chartLabel, marakezData, marakezTotal) {
            const ctx = document.getElementById(ctxId).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: `میزان برش مراکز (${chartLabel})`,
                        data: marakezData,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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
                                    family: 'Vazirmatn'
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: `مجموع سطح ${chartLabel} مراکز: ${marakezTotal.toLocaleString()}`,
                            font: {
                                size: 16,
                                family: 'Vazirmatn'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'سطح (هکتار)',
                                font: {
                                    size: 14,
                                    family: 'Vazirmatn'
                                }
                            }
                        },
                        x: {
                            ticks: {
                                autoSkip: false,
                                font: {
                                    family: 'Vazirmatn'
                                }
                            }
                        }
                    }
                }
            });
        }

        // Create the charts
        createChart('abiChart', 'آبی', s_abi_mar_data, total_s_abi_mar);
        createChart('demChart', 'دیم', s_dem_mar_data, total_s_dem_mar);
    </script>
    
    <?php
            } else {
                echo '<div class="card info-message"><p>اطلاعاتی برای مراکز این شهرستان یافت نشد.</p></div>';
            }
        } else {
            echo '<div class="card info-message"><p>خطا در اتصال به پایگاه داده.</p></div>';
        }
    } else {
        echo '<div class="card info-message"><p>اطلاعات مورد نیاز وارد نشده است.</p></div>';
    }
    ?>
</div>

</body>
</html>