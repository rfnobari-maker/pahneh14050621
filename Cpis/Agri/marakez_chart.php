<?php
// PHP 5.2.3 Compatibility Notice:
// This code is written to be compatible with PHP 5.2.3.
// It is strongly recommended to upgrade to a supported PHP version (e.g., PHP 8.x)
// for security and performance benefits.

require_once("../../lock_cp.php");
require_once("../../event.php");
require_once("../../login/config.php");

// Sanitize user inputs to prevent XSS attacks.
$z_sal = isset($_POST['z_sal']) ? htmlspecialchars($_POST['z_sal'], ENT_QUOTES) : '';
$mah_qroup = isset($_POST['mah_qroup']) ? htmlspecialchars($_POST['mah_qroup'], ENT_QUOTES) : '';
$mah_name = isset($_POST['mah_name']) ? htmlspecialchars($_POST['mah_name'], ENT_QUOTES) : '';
$id_ostan = isset($_POST['id_ostan']) ? htmlspecialchars($_POST['id_ostan'], ENT_QUOTES) : '';
$id_city = isset($_POST['id_city']) ? htmlspecialchars($_POST['id_city'], ENT_QUOTES) : '';
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal);

// The product mapping array - فقط برای سال زراعی 1405-1404
$product_map = array();

// فقط اگر سال زراعی 1405-1404 باشد، نگاشت اعمال می‌شود
if ($z_sal === '1405-1404') {
    $product_map = array(
        '103' => '102',
        '107' => '106',
        '176' => '490',
        '178' => '490',
        '180' => '490',
        '182' => '490',
        '184' => '490',
        '186' => '490',
        '188' => '490',
        '190' => '490',
        '192' => '490',
        '194' => '490',
        '196' => '490',
        '198' => '490',
        '200' => '490',
        '414' => '490',
        '416' => '490',
        '418' => '490',
        '420' => '490',
        '422' => '490',
        '424' => '490',
        '426' => '490',
        '428' => '490',
        '430' => '490',
        '432' => '490',
        '434' => '490',
        '436' => '490',
        '438' => '490',
        '440' => '490',
        '442' => '490',
        '444' => '490',
        '446' => '490',
        '448' => '490',
        '449' => '490',
        '464' => '490'
    );
}

function getProductCodes($mah_name, $product_map) {

    $codes = array($mah_name);

    foreach ($product_map as $child => $parent) {
        if ($parent == $mah_name) {
            $codes[] = $child;
        }
    }

    if (isset($product_map[$mah_name])) {
        $codes[] = $product_map[$mah_name];
    }

    return array_unique($codes);
}

// Apply the product mapping if the product code exists in the map
if (array_key_exists($mah_name, $product_map)) {
    $mah_name_mapped = $product_map[$mah_name];
} else {
    $mah_name_mapped = $mah_name;
}

$product_codes = getProductCodes($mah_name, $product_map);
$product_codes_sql = implode(',', array_map('intval', $product_codes));

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

// تابع جدید برای دریافت تعداد کارشناسان پهنه (S_access = 1) بر اساس شهرستان و استان
function get_s_access_count_by_city($id_ostan, $id_city) {
    $dbh = get_db_connection();
    if (!$dbh) {
        return 'N/A';
    }
    // کوئری با فیلتر id_ostan و id_city
    $query = "SELECT count(*) AS count FROM `users` WHERE `S_access` = '1' AND `id_ostan` = :id_ostan_target AND `id_city` = :id_city_target";
    $params = array(':id_ostan_target' => $id_ostan, ':id_city_target' => $id_city);
    
    $stmt = execute_prepared_statement($query, $params); 
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    return $row ? (int)$row['count'] : '0';
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نمودار مراکز شهرستان</title>
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

        .close-btn-container {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        /* کانتینر جدید برای نمایش تعداد کارشناسان (سمت راست) */
        .s-access-info-container {
            position: fixed;
            top: 20px;
            right: 20px; /* تنظیم موقعیت در سمت راست */
            z-index: 1000;
        }

        /* استایل نمایش تعداد کارشناسان با پس‌زمینه رنگی */
        .s-access-count {
            background-color: #E8F5E9; /* سبز روشن */
            color: #2E7D32; /* سبز پررنگ */
            padding: 12px 18px; /* افزایش Padding برای جلوه بهتر */
            border-radius: 8px; /* گردتر شدن لبه‌ها */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            font-size: 1rem;
            border: 1px solid #C8E6C9; /* اضافه کردن حاشیه سبز کم‌رنگ */
            direction: rtl; 
            font-weight: bold;
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
            /* مطمئن شدن از جایگاه کانتینر کارشناسان در موبایل */
            .s-access-info-container {
                top: 10px;
                right: 10px;
            }
        }
    </style>
</head>
<body>

<?php
// دریافت تعداد کارشناسان برای شهرستان و استان مورد نظر
$s_access_count = 0;
if (!empty($id_ostan) && !empty($id_city)) {
    $s_access_count = get_s_access_count_by_city($id_ostan, $id_city);
}
?>

<div class="close-btn-container">
    <button class="close-btn" onclick="window.close()">بستن پنجره</button>
</div>

<div class="s-access-info-container">
    <div class="s-access-count">
        کارشناسان پهنه شهرستان: <?php echo htmlspecialchars($s_access_count, ENT_QUOTES); ?> نفر
    </div>
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

            // Query for 's_dem' and 's_abi' from Agri_ab_mar
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
                AND m.product_cod IN ($product_codes_sql)
                AND m.id_city = :id_city
                and m.id_ostan = :id_ostan
                ORDER BY binary mn.mar ASC;
            ";

            $stmt = execute_prepared_statement($query, array(
                ':z_sal'           => $z_sal,
                ':mah_qroup'       => $mah_qroup,
                ':id_city'         => $id_city,
                ':id_ostan'        => $id_ostan
            ));
            
            if ($stmt && $stmt->rowCount() > 0) {
                $marakez_names = array();
                $s_dem_mar_data = array();
                $s_abi_mar_data = array();
                $z_kesht_abi_data = array();
                $z_kesht_dem_data = array();
                $mar_ids = array();

                $main_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // --- START OF Z-KESHT QUERY DEFINITION LOGIC ---
                $special_products = array('170', '172', '174');

                if (in_array($mah_name_mapped, $special_products)) {
                    // کوئری جدید برای محصولات خاص (170, 172, 174) با استفاده از Vege_prod و ستون zer_kesht
                    $query_zkesht_abi = "
                        SELECT
                            id_mar,
                            IFNULL(SUM(zer_kesht), 0) AS total_z_kesht_abi
                        FROM Vege_prod
                        WHERE z_sal = :z_sal
                        AND cod_mah IN ($product_codes_sql)
                        AND id_city = :id_city_target
                        AND id_ostan = :id_ostan_target
                        GROUP BY id_mar
                    ";
                    
                    // کوئری جدید برای دیم با استفاده از Vege_prod و ستون zer_kesht
                    $query_zkesht_dem = "
                        SELECT
                            id_mar,
                            IFNULL(SUM(zer_kesht), 0) AS total_z_kesht_dem
                        FROM Vege_prod
                        WHERE z_sal = :z_sal
                        AND cod_mah IN ($product_codes_sql)
                        AND id_city = :id_city_target
                        AND id_ostan = '01'
                        GROUP BY id_mar
                    ";
                    
                } else {
                    // کوئری‌های پیش‌فرض برای سایر محصولات (کوئری‌های قبلی شما)
                    
                    // Query for 'z_kesht' for 'abi' based on no_kesh = 1
                    $query_zkesht_abi = "
                       SELECT
                         id_mar,
                         IFNULL(SUM(zer_kesht_a), 0) + IFNULL(SUM(zer_kesht_b), 0) AS total_z_kesht_abi
                        FROM $Agri_prod_table 
                        WHERE z_sal = :z_sal
                        AND cod_mah IN ($product_codes_sql)
                       AND id_city = :id_city_target
                        AND id_ostan = :id_ostan_target
                        AND no_kesh = '1'
                        GROUP BY id_mar
                    ";
                    
                    // Query for 'z_kesht' for 'dem' based on no_kesh = 2
                    $query_zkesht_dem = "
                        SELECT
                            id_mar,
                            IFNULL(SUM(zer_kesht_a), 0) + IFNULL(SUM(zer_kesht_b), 0) AS total_z_kesht_dem
                        FROM $Agri_prod_table 
                        WHERE z_sal = :z_sal
                        AND cod_mah IN ($product_codes_sql)
                        AND id_city = :id_city_target
                        AND id_ostan = :id_ostan_target
                        AND no_kesh = '2'
                        GROUP BY id_mar
                    ";
                }
                
                // Execution of the chosen queries
                $stmt_zkesht_abi = execute_prepared_statement($query_zkesht_abi, array(
                    ':id_ostan_target' => $id_ostan,
                    ':id_city_target' => $id_city,
                    ':z_sal'           => $z_sal,
                    

                ));
                
                $stmt_zkesht_dem = execute_prepared_statement($query_zkesht_dem, array(
                    ':id_ostan_target' => $id_ostan,
                    ':id_city_target' => $id_city,
                    ':z_sal'           => $z_sal,
                    

                ));
                // --- END OF Z-KESHT QUERY DEFINITION LOGIC ---
                
                // Store z_kesht data in associative arrays for easy lookup
                $z_kesht_abi_lookup = array();
                $total_z_kesht_abi = 0;
                if ($stmt_zkesht_abi) {
                    while ($row = $stmt_zkesht_abi->fetch(PDO::FETCH_ASSOC)) {
                        $z_kesht_abi_lookup[$row['id_mar']] = (float)$row['total_z_kesht_abi'];
                        $total_z_kesht_abi += (float)$row['total_z_kesht_abi'];
                    }
                }
                
                $z_kesht_dem_lookup = array();
                $total_z_kesht_dem = 0;
                if ($stmt_zkesht_dem) {
                    while ($row = $stmt_zkesht_dem->fetch(PDO::FETCH_ASSOC)) {
                        $z_kesht_dem_lookup[$row['id_mar']] = (float)$row['total_z_kesht_dem'];
                        $total_z_kesht_dem += (float)$row['total_z_kesht_dem'];
                    }
                }

                // Populate data arrays from the main data and merge with z_kesht data
                foreach($main_data as $row) {
                    $marakez_names[] = $row['mar'];
                    $s_dem_mar_data[] = (float)$row['s_dem_mar'];
                    $s_abi_mar_data[] = (float)$row['s_abi_mar'];
                    $mar_ids[] = $row['id_mar'];

                    $z_kesht_abi_data[] = isset($z_kesht_abi_lookup[$row['id_mar']]) ? $z_kesht_abi_lookup[$row['id_mar']] : 0;
                    $z_kesht_dem_data[] = isset($z_kesht_dem_lookup[$row['id_mar']]) ? $z_kesht_dem_lookup[$row['id_mar']] : 0;
                }
                
                // JSON encoding for JavaScript
                $marakez_names_json = json_encode($marakez_names);
                $s_dem_mar_data_json = json_encode($s_dem_mar_data);
                $s_abi_mar_data_json = json_encode($s_abi_mar_data);
                $z_kesht_abi_data_json = json_encode($z_kesht_abi_data);
                $z_kesht_dem_data_json = json_encode($z_kesht_dem_data);
                
                // Calculate total values
                $total_s_abi_mar = array_sum($s_abi_mar_data);
                $total_s_dem_mar = array_sum($s_dem_mar_data);

                $total_s_abi_mar_json = json_encode($total_s_abi_mar);
                $total_s_dem_mar_json = json_encode($total_s_dem_mar);
                $total_z_kesht_abi_json = json_encode($total_z_kesht_abi);
                $total_z_kesht_dem_json = json_encode($total_z_kesht_dem);
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
        const marakez_ids = <?php echo json_encode($mar_ids); ?>;

        const s_dem_mar_data = <?php echo $s_dem_mar_data_json; ?>;
        const s_abi_mar_data = <?php echo $s_abi_mar_data_json; ?>;
        const z_kesht_abi_data = <?php echo $z_kesht_abi_data_json; ?>;
        const z_kesht_dem_data = <?php echo $z_kesht_dem_data_json; ?>;
        
        const total_s_abi_mar = <?php echo $total_s_abi_mar_json; ?>;
        const total_s_dem_mar = <?php echo $total_s_dem_mar_json; ?>;
        const total_z_kesht_abi = <?php echo $total_z_kesht_abi_json; ?>;
        const total_z_kesht_dem = <?php echo $total_z_kesht_dem_json; ?>;

        // Function to create a chart
        function createChart(ctxId, chartLabel, marakezData, zKeshtData, marakezTotal, zKeshtTotal) {
            const ctx = document.getElementById(ctxId).getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: `میزان برش مراکز (${chartLabel})`,
                        data: marakezData,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }, {
                        label: `سطح زیر کشت (${chartLabel})`,
                        data: zKeshtData,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
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
                            text: `مقایسه سطح ${chartLabel} مراکز (مجموع: ${marakezTotal.toLocaleString()}) و زیرکشت (مجموع: ${zKeshtTotal.toLocaleString()})`,
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
                                text: 'سطح (هکتار)',
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
                    },
                    onClick: (e) => {
                        const points = myChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
                        if (points.length) {
                            const firstPoint = points[0];
                            const labelIndex = firstPoint.index;
                            const marakezId = marakez_ids[labelIndex];

                            const postData = {
                                z_sal: '<?php echo $z_sal; ?>',
                                id_ostan: '<?php echo $id_ostan; ?>',
                                id_city: '<?php echo $id_city; ?>',
                                id_mar: marakezId,
                                cod_mah: '<?php echo $mah_name_mapped; ?>'
                            };

                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = 'list_mah_zk.php';
                            form.target = 'list_mah_zk_popup';
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

                            window.open('about:blank', 'list_mah_zk_popup', 'location=1,status=1,scrollbars=1,width=1000,height=800,top=50,left=50');
                            document.body.appendChild(form);
                            form.submit();
                            document.body.removeChild(form);
                        }
                    }
                }
            });
        }

        // Create the charts
        createChart('abiChart', 'آبی', s_abi_mar_data, z_kesht_abi_data, total_s_abi_mar, total_z_kesht_abi);
        createChart('demChart', 'دیم', s_dem_mar_data, z_kesht_dem_data, total_s_dem_mar, total_z_kesht_dem);
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