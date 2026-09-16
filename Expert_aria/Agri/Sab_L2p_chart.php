<?php
// PHP 5.2.3 Compatibility Notice:
// This code is written to be compatible with PHP 5.2.3.
// It is strongly recommended to upgrade to a supported PHP version (e.g., PHP 8.x)
// for security and performance benefits.

// Ensure all necessary files are included
require_once("../../lock_expar.php");
require_once("../../event.php");
require_once("../../login/config.php");

// Sanitize user inputs to prevent XSS attacks.
// Note: htmlspecialchars() is used for PHP 5.2.3 compatibility.
$z_sal = isset($_POST['z_sal']) ? htmlspecialchars($_POST['z_sal'], ENT_QUOTES) : '';
$mah_qroup = isset($_POST['mah_qroup']) ? htmlspecialchars($_POST['mah_qroup'], ENT_QUOTES) : '';
$mah_name = isset($_POST['mah_name']) ? htmlspecialchars($_POST['mah_name'], ENT_QUOTES) : '';
$id_ostan1 = isset($_POST['id_ostan']) ? htmlspecialchars($_POST['id_ostan'], ENT_QUOTES) : '';

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
            position: fixed; /* Use fixed to keep it in place while scrolling */
            top: 20px;
            left: 20px;
            z-index: 1000; /* Ensure it is on top of other elements */
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
    if (!empty($mah_qroup) && !empty($mah_name) && !empty($z_sal) && !empty($id_ostan1))
    {
        $dbh = get_db_connection();
        if ($dbh) {
            $query = "
                SELECT
                    c.id_city,
                    c.city,
                    IFNULL(a.s_dem, 0) AS s_dem_city,
                    IFNULL(a.s_abi, 0) AS s_abi_city,
                    IFNULL(m.total_marakez_dem, 0) AS total_marakez_dem,
                    IFNULL(m.total_marakez_abi, 0) AS total_marakez_abi
                FROM cityname c
                LEFT JOIN Agri_ab_city a
                    ON c.id_city = a.id_city
                    AND a.z_sal = :z_sal
                    AND a.group_cod = :mah_qroup
                    AND a.product_cod = :mah_name
                    AND a.id_ostan = :id_ostan_target
                LEFT JOIN (
                    SELECT
                        id_city,
                        SUM(s_dem) AS total_marakez_dem,
                        SUM(s_abi) AS total_marakez_abi
                    FROM Agri_ab_mar
                    WHERE z_sal = :z_sal
                    AND group_cod = :mah_qroup
                    AND product_cod = :mah_name
                    AND id_ostan = :id_ostan_target
                    GROUP BY id_city
                ) m
                    ON c.id_city = m.id_city
                WHERE c.id_ostan = :id_ostan_target
                ORDER BY binary c.city ASC;
            ";

            $stmt = execute_prepared_statement($query, array(
                ':z_sal'           => $z_sal,
                ':mah_qroup'       => $mah_qroup,
                ':mah_name'        => $mah_name,
                ':id_ostan_target' => $id_ostan1
            ));
            
            if ($stmt && $stmt->rowCount() > 0) {
                $city_names = array();
                $s_dem_city_data = array();
                $total_marakez_dem_data = array();
                $s_abi_city_data = array();
                $total_marakez_abi_data = array();

                foreach($stmt as $row) {
                    $city_names[] = $row['city'];
                    $s_dem_city_data[] = (float)$row['s_dem_city'];
                    $total_marakez_dem_data[] = (float)$row['total_marakez_dem'];
                    $s_abi_city_data[] = (float)$row['s_abi_city'];
                    $total_marakez_abi_data[] = (float)$row['total_marakez_abi'];
                }
                
                // JSON encoding for JavaScript
                $city_names_json = json_encode($city_names);
                $s_dem_city_data_json = json_encode($s_dem_city_data);
                $total_marakez_dem_data_json = json_encode($total_marakez_dem_data);
                $s_abi_city_data_json = json_encode($s_abi_city_data);
                $total_marakez_abi_data_json = json_encode($total_marakez_abi_data);
                
                // Calculate total values
                $total_s_abi_city = array_sum($s_abi_city_data);
                $total_total_marakez_abi = array_sum($total_marakez_abi_data);
                $total_s_dem_city = array_sum($s_dem_city_data);
                $total_total_marakez_dem = array_sum($total_marakez_dem_data);

                $total_s_abi_city_json = json_encode($total_s_abi_city);
                $total_total_marakez_abi_json = json_encode($total_total_marakez_abi);
                $total_s_dem_city_json = json_encode($total_s_dem_city);
                $total_total_marakez_dem_json = json_encode($total_total_marakez_dem);
    ?>
    <div class="card">
        <h2 class="chart-title">نمودار مقایسه ای سطح (آبی) محصول <?php echo htmlspecialchars(mah_name($mah_name), ENT_QUOTES); ?></h2>
        <div class="chart-container">
            <canvas id="abiChart"></canvas>
        </div>
    </div>

    <div class="card">
        <h2 class="chart-title">نمودار مقایسه ای سطح (دیم) محصول <?php echo htmlspecialchars(mah_name($mah_name), ENT_QUOTES); ?></h2>
        <div class="chart-container">
            <canvas id="demChart"></canvas>
        </div>
    </div>

    <script>
        // JavaScript for Chart.js
        const labels = <?php echo $city_names_json; ?>;
        const s_dem_city_data = <?php echo $s_dem_city_data_json; ?>;
        const total_marakez_dem_data = <?php echo $total_marakez_dem_data_json; ?>;
        const s_abi_city_data = <?php echo $s_abi_city_data_json; ?>;
        const total_marakez_abi_data = <?php echo $total_marakez_abi_data_json; ?>;
        
        const total_s_abi_city = <?php echo $total_s_abi_city_json; ?>;
        const total_total_marakez_abi = <?php echo $total_total_marakez_abi_json; ?>;
        const total_s_dem_city = <?php echo $total_s_dem_city_json; ?>;
        const total_total_marakez_dem = <?php echo $total_total_marakez_dem_json; ?>;

        // Function to create a chart
        function createChart(ctxId, chartLabel, cityData, marakezData, cityTotal, marakezTotal) {
            const ctx = document.getElementById(ctxId).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: `میزان برش شهرستان (${chartLabel})`,
                        data: cityData,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }, {
                        label: `مجموع برش مراکز (${chartLabel})`,
                        data: marakezData,
                        backgroundColor: 'rgba(255, 159, 64, 0.7)',
                        borderColor: 'rgba(255, 159, 64, 1)',
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
                            text: `مقایسه سطح ${chartLabel} برش شهرستان (مجموع: ${cityTotal.toLocaleString()}) با برش مراکز (مجموع: ${marakezTotal.toLocaleString()})`,
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
        createChart('abiChart', 'آبی', s_abi_city_data, total_marakez_abi_data, total_s_abi_city, total_total_marakez_abi);
        createChart('demChart', 'دیم', s_dem_city_data, total_marakez_dem_data, total_s_dem_city, total_total_marakez_dem);
    </script>
    
    <?php
            } else {
                echo '<div class="card info-message"><p>اطلاعاتی یافت نشد. لطفاً گروه محصولات، نام محصول و سال زراعی را انتخاب و جستجو کنید.</p></div>';
            }
        } else {
            echo '<div class="card info-message"><p>خطا در اتصال به پایگاه داده.</p></div>';
        }
    } else {
        echo '<div class="card info-message"><p>لطفا اطلاعات مورد نیاز را وارد کنید.</p></div>';
    }
    ?>
</div>

</body>
</html>