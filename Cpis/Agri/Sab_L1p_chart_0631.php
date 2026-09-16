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
$z_sal = isset($_POST['z_sal']) ? htmlspecialchars($_POST['z_sal'], ENT_QUOTES) : '';
$mah_qroup = isset($_POST['mah_qroup']) ? htmlspecialchars($_POST['mah_qroup'], ENT_QUOTES) : '';
$mah_name = isset($_POST['mah_name']) ? htmlspecialchars($_POST['mah_name'], ENT_QUOTES) : '';

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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }
        
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
    // Check if all required input variables are set
    if (!empty($mah_qroup) && !empty($mah_name) && !empty($z_sal)) {
        $dbh = get_db_connection();
        if ($dbh) {
            // Query to get the total official cultivation area (s_dem and s_abi)
            $query_sum_ostan = "SELECT SUM(s_dem) AS total_s_dem, SUM(s_abi) AS total_s_abi FROM Agri_ab_ostan WHERE z_sal = :z_sal AND group_cod = :mah_qroup AND product_cod = :mah_name";
            $stmt_sum_ostan = execute_prepared_statement($query_sum_ostan, array(
                ':z_sal'     => $z_sal,
                ':mah_qroup' => $mah_qroup,
                ':mah_name'  => $mah_name
            ));
            $sum_ostan_row = $stmt_sum_ostan ? $stmt_sum_ostan->fetch(PDO::FETCH_ASSOC) : null;
            $total_s_dem = $sum_ostan_row ? (float)$sum_ostan_row['total_s_dem'] : 0;
            $total_s_abi = $sum_ostan_row ? (float)$sum_ostan_row['total_s_abi'] : 0;

            // Query to get the total city-level breakdown area (s_dem and s_abi)
            $query_sum_city = "SELECT SUM(s_dem) AS total_city_dem, SUM(s_abi) AS total_city_abi FROM Agri_ab_city WHERE z_sal = :z_sal AND group_cod = :mah_qroup AND product_cod = :mah_name";
            $stmt_sum_city = execute_prepared_statement($query_sum_city, array(
                ':z_sal'     => $z_sal,
                ':mah_qroup' => $mah_qroup,
                ':mah_name'  => $mah_name
            ));
            $sum_city_row = $stmt_sum_city ? $stmt_sum_city->fetch(PDO::FETCH_ASSOC) : null;
            $total_city_dem = $sum_city_row ? (float)$sum_city_row['total_city_dem'] : 0;
            $total_city_abi = $sum_city_row ? (float)$sum_city_row['total_city_abi'] : 0;
             
            $query = "
                SELECT 
                    o.id_ostan,
                    o.product_cod,
                    o.z_sal,
                    o.s_dem,
                    o.s_abi,
                    osn.ostan,
                    IFNULL(c.total_city_dem,0) AS total_city_dem,
                    IFNULL(c.total_city_abi,0) AS total_city_abi
                FROM Agri_ab_ostan o
                JOIN ostanname osn ON o.id_ostan = osn.id_ostan
                LEFT JOIN (
                    SELECT 
                        id_ostan,
                        product_cod,
                        SUM(s_dem) AS total_city_dem,
                        SUM(s_abi) AS total_city_abi
                    FROM Agri_ab_city
                    WHERE z_sal = :z_sal
                    AND group_cod = :mah_qroup
                    AND product_cod = :mah_name
                    GROUP BY id_ostan, product_cod
                ) c 
                   ON o.id_ostan = c.id_ostan
                  AND o.product_cod = c.product_cod
                WHERE o.z_sal = :z_sal
                  AND o.group_cod = :mah_qroup
                  AND o.product_cod = :mah_name
                ORDER BY FIELD(o.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')
            ";
            $stmt = execute_prepared_statement($query, array(
                ':z_sal'     => $z_sal,
                ':mah_qroup' => $mah_qroup,
                ':mah_name'  => $mah_name
            ));

            if ($stmt && $stmt->rowCount() > 0) {
                $province_names = array();
                $s_dem_data = array();
                $total_city_dem_data = array();
                $s_abi_data = array();
                $total_city_abi_data = array();
                $province_ids = array();

                foreach($stmt as $row) {
                    $province_names[] = $row['ostan'];
                    $s_dem_data[] = (float)$row['s_dem'];
                    $total_city_dem_data[] = (float)$row['total_city_dem'];
                    $s_abi_data[] = (float)$row['s_abi'];
                    $total_city_abi_data[] = (float)$row['total_city_abi'];
                    $province_ids[] = $row['id_ostan'];
                }
                
                // JSON encoding for JavaScript
                $province_names_json = json_encode($province_names);
                $s_dem_data_json = json_encode($s_dem_data);
                $total_city_dem_data_json = json_encode($total_city_dem_data);
                $s_abi_data_json = json_encode($s_abi_data);
                $total_city_abi_data_json = json_encode($total_city_abi_data);
                $province_ids_json = json_encode($province_ids);
                
                // Total values
                $total_s_abi_json = json_encode($total_s_abi);
                $total_city_abi_json = json_encode($total_city_abi);
                $total_s_dem_json = json_encode($total_s_dem);
                $total_city_dem_json = json_encode($total_city_dem);
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
        const labels = <?php echo $province_names_json; ?>;
        const s_dem_data = <?php echo $s_dem_data_json; ?>;
        const total_city_dem_data = <?php echo $total_city_dem_data_json; ?>;
        const s_abi_data = <?php echo $s_abi_data_json; ?>;
        const total_city_abi_data = <?php echo $total_city_abi_data_json; ?>;
        const province_ids = <?php echo $province_ids_json; ?>;
        
        const total_s_abi = <?php echo $total_s_abi_json; ?>;
        const total_city_abi = <?php echo $total_city_abi_json; ?>;
        const total_s_dem = <?php echo $total_s_dem_json; ?>;
        const total_city_dem = <?php echo $total_city_dem_json; ?>;

        // Function to create a chart
        function createChart(ctxId, chartLabel, sData, cityData, sTotal, cityTotal) {
            const ctx = document.getElementById(ctxId).getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: `سطح ابلاغی استان (${chartLabel})`,
                        data: sData,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }, {
                        label: `مجموع برش شهرستانی (${chartLabel})`,
                        data: cityData,
                        backgroundColor: 'rgba(255, 159, 64, 0.7)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    onClick: (e) => {
                        const points = myChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
                        if (points.length) {
                            const firstPoint = points[0];
                            const labelIndex = firstPoint.index;
                            const ostanId = province_ids[labelIndex];
                            
                            // Data to be sent to Sab_L2p_chart.php
                            const postData = {
                                id_ostan: ostanId,
                                z_sal: '<?php echo $z_sal; ?>',
                                mah_qroup: '<?php echo $mah_qroup; ?>',
                                mah_name: '<?php echo $mah_name; ?>'
                            };

                            // Dynamically create a form to submit POST data to a new window
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = 'Sab_L2p_chart.php'; // The target file is Sab_L2p_chart.php
                            form.target = 'Sab_L2_popup'; // The name of the new window
                            form.style.display = 'none'; // Hide the form

                            for (const key in postData) {
                                if (postData.hasOwnProperty(key)) {
                                    const hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = key;
                                    hiddenInput.value = postData[key];
                                    form.appendChild(hiddenInput);
                                }
                            }
                            
                            // Open a new window and then submit the form to it
                            window.open('about:blank', 'Sab_L2_popup', 'location=1,status=1,scrollbars=1,width=1000,height=800,top=50,left=50');
                            document.body.appendChild(form);
                            form.submit();
                            document.body.removeChild(form);
                        }
                    },
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
                            text: `مقایسه سطح ${chartLabel} ابلاغی (مجموع: ${sTotal.toLocaleString()}) با برش شهرستانی (مجموع: ${cityTotal.toLocaleString()})`,
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
        createChart('abiChart', 'آبی', s_abi_data, total_city_abi_data, total_s_abi, total_city_abi);
        createChart('demChart', 'دیم', s_dem_data, total_city_dem_data, total_s_dem, total_city_dem);

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