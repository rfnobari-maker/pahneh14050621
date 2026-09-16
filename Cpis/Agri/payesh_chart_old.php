<?php
// PHP 5.2.3 Compatibility Notice:
// This code is written to be compatible with PHP 5.2.3.
// It is strongly recommended to upgrade to a supported PHP version (e.g., PHP 8.x)
// for security and performance benefits.

// Ensure all necessary files are included
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once("../../login/config.php");

// Sanitize user inputs to prevent XSS attacks.
// Note: filter_input() is not available in PHP 5.2.3, so we use htmlspecialchars().

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
        // Note: PHP 5.2.3 compatibility might require a different approach for named parameters.
        // This is a more modern practice.
        if (strpos($key, ':') !== false) {
            $stmt->bindParam($key, $params[$key]);
        }
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
    // Check if the required input variables are set
    if (1==1) {
        $dbh = get_db_connection();
        if ($dbh) {
            // Query to get the total delivered fertilizer (m_tah) per province
            $query = "
                SELECT 
                    osn.ostan,
                    SUM(p.m_tah) AS total_m_tah
                FROM payesh p
                JOIN ostanname osn ON p.id_ostan = osn.id_ostan
                WHERE 1
                GROUP BY osn.ostan
                ORDER BY total_m_tah DESC
            ";
            $stmt = execute_prepared_statement($query, array());

            if ($stmt && $stmt->rowCount() > 0) {
                $province_names = array();
                $m_tah_data = array();
                $total_m_tah = 0;

                foreach($stmt as $row) {
                    $province_names[] = $row['ostan'];
                    $m_tah_data[] = (float)$row['total_m_tah'];
                    $total_m_tah += (float)$row['total_m_tah'];
                }
                
                // JSON encoding for JavaScript
                $province_names_json = json_encode($province_names);
                $m_tah_data_json = json_encode($m_tah_data);
                $total_m_tah_json = json_encode($total_m_tah);
    ?>
    <div class="card">
        <h2 class="chart-title">نمودار میزان کود دریافت شده به روز به تفکیک استان</h2>
        <div class="chart-container">
            <canvas id="fertilizerChart"></canvas>
        </div>
    </div>
    
    <script>
// JavaScript for Chart.js
const labels = <?php echo $province_names_json; ?>;
const m_tah_data = <?php echo $m_tah_data_json; ?>;
const total_m_tah = <?php echo $total_m_tah_json; ?>;

// Function to create a single chart
function createChart(ctxId, chartTitle, data, total, unit) {
    const ctx = document.getElementById(ctxId).getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: `میزان تحویلی`,
                data: data,
                backgroundColor: '#0077B6',
                borderColor: '#00B4D8',
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
                    text: `${chartTitle} - مجموع کل: ${total.toLocaleString()}`,
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

// Create the fertilizer chart
createChart('fertilizerChart', 'نمودار میزان کود تحویلی', m_tah_data, total_m_tah, 'تن');

    </script>

    <?php
            } else {
                echo '<div class="card info-message"><p>اطلاعاتی برای سال زراعی و کد کود انتخاب شده یافت نشد.</p></div>';
            }
        } else {
            echo '<div class="card info-message"><p>خطا در اتصال به پایگاه داده.</p></div>';
        }
    } else {
        echo '<div class="card info-message"><p>لطفا سال زراعی و کد کود مورد نیاز را وارد کنید.</p></div>';
    }
    ?>
</div>

</body>
</html>