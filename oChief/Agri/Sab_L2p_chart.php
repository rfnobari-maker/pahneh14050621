<?php
// PHP 5.2.3 Compatibility Notice:
// This code is written to be compatible with PHP 5.2.3.
// It is strongly recommended to upgrade to a supported PHP version (e.g., PHP 8.x)
// for security and performance benefits.

// Ensure all necessary files are included
require_once("../../lock_oce.php");
require_once("../../event.php");
require_once("../../login/config.php");

// Sanitize user inputs to prevent XSS attacks.
// Note: htmlspecialchars() is used for PHP 5.2.3 compatibility.
$z_sal = isset($_POST['z_sal']) ? htmlspecialchars($_POST['z_sal'], ENT_QUOTES) : '';
$mah_qroup = isset($_POST['mah_qroup']) ? htmlspecialchars($_POST['mah_qroup'], ENT_QUOTES) : '';
$mah_name = isset($_POST['mah_name']) ? htmlspecialchars($_POST['mah_name'], ENT_QUOTES) : '';
$id_ostan1 = isset($_POST['id_ostan']) ? htmlspecialchars($_POST['id_ostan'], ENT_QUOTES) : '';
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
        // Use bindParam for better security and type-checking
        $stmt->bindParam($key, $params[$key]);
    }
    $stmt->execute();
    return $stmt;
}

// تابع برای دریافت تعداد کارشناسان پهنه (S_access = 1) بر اساس استان
function get_s_access_count_by_ostan($id_ostan) {
    $dbh = get_db_connection();
    if (!$dbh) {
        return 'N/A';
    }
    // کوئری مورد نظر شما: SELECT count(*) FROM `users` WHERE `S_access` = '1' AND `id_ostan` = :id_ostan_target
    $query = "SELECT count(*) AS count FROM `users` WHERE `S_access` = '1' AND `id_ostan` = :id_ostan_target";
    $stmt = execute_prepared_statement($query, array(':id_ostan_target' => $id_ostan)); 
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    return $row ? (int)$row['count'] : '0';
}

// تابع برای دریافت نام استان از کد آن (برای نمایش در عنوان)
function get_ostan_name($id_ostan) {
    $dbh = get_db_connection();
    if (!$dbh) {
        return 'استان ناشناخته';
    }
    $query = "SELECT ostan FROM `ostanname` WHERE id_ostan = :id_ostan LIMIT 1";
    $stmt = execute_prepared_statement($query, array(':id_ostan' => $id_ostan));
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    return $row ? $row['ostan'] : 'استان ناشناخته';
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl"><head>
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
        
        .close-btn-container {
            position: fixed; /* Use fixed to keep it in place while scrolling */
            top: 20px;
            left: 20px;
            z-index: 1000; /* Ensure it is on top of other elements */
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
            /* این مقدار را برای جلوگیری از ناپدید شدن نمودار در موبایل تعیین کنید */
            min-height: 300px; 
            /* این دستور نمودار را به ۱۰۰٪ عرض عنصر پدرش محدود می‌کند */
            width: 100%;
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
            .s-access-info-container {
                top: 10px;
                right: 10px;
            }
        }
		
    </style>
</head>
<body>

<?php
// دریافت تعداد کارشناسان برای استان مورد نظر
$s_access_count = 0;
$ostan_name = '';
if (!empty($id_ostan1)) {
    $s_access_count = get_s_access_count_by_ostan($id_ostan1);
    $ostan_name = get_ostan_name($id_ostan1);
}
?>

<div class="close-btn-container">
    <button class="close-btn" onclick="window.close()">بستن پنجره</button>
</div>

<div class="s-access-info-container">
    <div class="s-access-count">
        کارشناسان پهنه استان : <?php echo htmlspecialchars($s_access_count, ENT_QUOTES); ?> نفر
    </div>
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
                    AND a.product_cod IN ($product_codes_sql)
                    AND a.id_ostan = :id_ostan_target
                LEFT JOIN (
                    SELECT
                        id_city,
                        SUM(s_dem) AS total_marakez_dem,
                        SUM(s_abi) AS total_marakez_abi
                    FROM Agri_ab_mar
                    WHERE z_sal = :z_sal
                    AND group_cod = :mah_qroup
                    AND product_cod IN ($product_codes_sql)
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
                ':id_ostan_target' => $id_ostan1
            ));
            
            if ($stmt && $stmt->rowCount() > 0) {
                $city_names = array();
                $s_dem_city_data = array();
                $total_marakez_dem_data = array();
                $s_abi_city_data = array();
                $total_marakez_abi_data = array();
                $z_kesht_abi_data = array();
                $z_kesht_dem_data = array();
                $city_ids = array();

                $main_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

 // --- START OF Z-KESHT QUERY DEFINITION LOGIC ---
                $special_products = array('170', '172', '174');
                
               if (in_array($mah_name, $special_products)) {
                    // کوئری جدید برای محصولات خاص (170, 172, 174) با استفاده از Vege_prod و ستون zer_kesht
                    $query_zkesht_abi = "
                        SELECT
                            id_city,
                            IFNULL(SUM(zer_kesht), 0) AS total_z_kesht_abi
                        FROM Vege_prod
                        WHERE z_sal = :z_sal
                        AND cod_mah IN ($product_codes_sql)
                        AND id_ostan = :id_ostan_target 
                        GROUP BY id_city
                    ";
                    
                    // کوئری جدید برای دیم با استفاده از Vege_prod و ستون zer_kesht
                    // توجه: در سطح L2p، فیلتر id_ostan = '1' حذف می‌شود تا اطلاعات استان جاری نمایش داده شود.
                    $query_zkesht_dem = "
                        SELECT
                            id_city,
                            IFNULL(SUM(zer_kesht), 0) AS total_z_kesht_dem
                        FROM Vege_prod
                        WHERE z_sal = :z_sal and id_ostan = '01'
                        AND cod_mah IN ($product_codes_sql)
                        AND id_ostan = :id_ostan_target 
                        GROUP BY id_city
                    ";
                    
                } else {
                    // کوئری‌های پیش‌فرض برای سایر محصولات (کوئری‌های قبلی شما)
                    
                    // New query for 'z_kesht' for 'abi' based on no_kesh = 1
                    $query_zkesht_abi = "
                       SELECT
                         id_city,
                         IFNULL(SUM(zer_kesht_a), 0) + IFNULL(SUM(zer_kesht_b), 0) AS total_z_kesht_abi
                        FROM $Agri_prod_table 
                        WHERE z_sal = :z_sal
                        AND cod_mah IN ($product_codes_sql)
                        AND id_ostan = :id_ostan_target
                        AND no_kesh = '1'
                        GROUP BY id_city
                    ";
                    
                    // New query for 'z_kesht' for 'dem' based on no_kesh = 2
                    $query_zkesht_dem = "
                        SELECT
                            id_city,
                            IFNULL(SUM(zer_kesht_a), 0) + IFNULL(SUM(zer_kesht_b), 0) AS total_z_kesht_dem
                        FROM $Agri_prod_table 
                        WHERE z_sal = :z_sal
                        AND cod_mah IN ($product_codes_sql)
                        AND id_ostan = :id_ostan_target
                        AND no_kesh = '2'
                        GROUP BY id_city
                    ";
                }
                
                // اجرای کوئری‌های تعریف شده در بالا (این بخش بدون تغییر باقی می‌ماند)
                $stmt_zkesht_abi = execute_prepared_statement($query_zkesht_abi, array(
                    ':id_ostan_target' => $id_ostan1,
                    ':z_sal'           => $z_sal
                ));
                
                $stmt_zkesht_dem = execute_prepared_statement($query_zkesht_dem, array(
                    ':id_ostan_target' => $id_ostan1,
                    ':z_sal'           => $z_sal
                ));
                // --- END OF Z-KESHT QUERY DEFINITION LOGIC ---

                // Store z_kesht data in associative arrays for easy lookup
                $z_kesht_abi_lookup = array();
                $total_z_kesht_abi = 0;
                if ($stmt_zkesht_abi) {
                    while ($row = $stmt_zkesht_abi->fetch(PDO::FETCH_ASSOC)) {
                        $z_kesht_abi_lookup[$row['id_city']] = (float)$row['total_z_kesht_abi'];
                        $total_z_kesht_abi += (float)$row['total_z_kesht_abi'];
                    }
                }
                
                $z_kesht_dem_lookup = array();
                $total_z_kesht_dem = 0;
                if ($stmt_zkesht_dem) {
                    while ($row = $stmt_zkesht_dem->fetch(PDO::FETCH_ASSOC)) {
                        $z_kesht_dem_lookup[$row['id_city']] = (float)$row['total_z_kesht_dem'];
                        $total_z_kesht_dem += (float)$row['total_z_kesht_dem'];
                    }
                }

                // Populate data arrays from the main data and merge with z_kesht data
                foreach($main_data as $row) {
                    $city_names[] = $row['city'];
                    $s_dem_city_data[] = (float)$row['s_dem_city'];
                    $total_marakez_dem_data[] = (float)$row['total_marakez_dem'];
                    $s_abi_city_data[] = (float)$row['s_abi_city'];
                    $total_marakez_abi_data[] = (float)$row['total_marakez_abi'];
                    $city_ids[] = $row['id_city'];

                    // Look up z_kesht data for the current city
                    $z_kesht_abi_data[] = isset($z_kesht_abi_lookup[$row['id_city']]) ? $z_kesht_abi_lookup[$row['id_city']] : 0;
                    $z_kesht_dem_data[] = isset($z_kesht_dem_lookup[$row['id_city']]) ? $z_kesht_dem_lookup[$row['id_city']] : 0;
                }
                
                // JSON encoding for JavaScript
                $city_names_json = json_encode($city_names);
                $s_dem_city_data_json = json_encode($s_dem_city_data);
                $total_marakez_dem_data_json = json_encode($total_marakez_dem_data);
                $s_abi_city_data_json = json_encode($s_abi_city_data);
                $total_marakez_abi_data_json = json_encode($total_marakez_abi_data);
                $z_kesht_abi_data_json = json_encode($z_kesht_abi_data);
                $z_kesht_dem_data_json = json_encode($z_kesht_dem_data);
                $city_ids_json = json_encode($city_ids);

                // Total values (محاسبه نهایی مجموع‌های استانی)
                $total_s_abi_city = array_sum($s_abi_city_data);
                $total_total_marakez_abi = array_sum($total_marakez_abi_data);
                $total_s_dem_city = array_sum($s_dem_city_data);
                $total_total_marakez_dem = array_sum($total_marakez_dem_data);
                
                $total_s_abi_city_json = json_encode($total_s_abi_city);
                $total_total_marakez_abi_json = json_encode($total_total_marakez_abi);
                $total_s_dem_city_json = json_encode($total_s_dem_city);
                $total_total_marakez_dem_json = json_encode($total_total_marakez_dem);
                $total_z_kesht_abi_json = json_encode($total_z_kesht_abi);
                $total_z_kesht_dem_json = json_encode($total_z_kesht_dem);
    ?>
    <div class="card">
        <h2 class="chart-title">نمودار مقایسه ای سطح (آبی) محصول <?php echo htmlspecialchars(mah_name($mah_name), ENT_QUOTES); ?> در استان <?php echo htmlspecialchars($ostan_name, ENT_QUOTES); ?></h2>
        <div class="chart-container">
            <canvas id="abiChart"></canvas>
        </div>
    </div>

    <div class="card">
        <h2 class="chart-title">نمودار مقایسه ای سطح (دیم) محصول <?php echo htmlspecialchars(mah_name($mah_name), ENT_QUOTES); ?> در استان <?php echo htmlspecialchars($ostan_name, ENT_QUOTES); ?></h2>
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
        const z_kesht_abi_data = <?php echo $z_kesht_abi_data_json; ?>;
        const z_kesht_dem_data = <?php echo $z_kesht_dem_data_json; ?>;
        const city_ids = <?php echo $city_ids_json; ?>;

        const total_s_abi_city = <?php echo $total_s_abi_city_json; ?>;
        const total_total_marakez_abi = <?php echo $total_total_marakez_abi_json; ?>;
        const total_s_dem_city = <?php echo $total_s_dem_city_json; ?>;
        const total_total_marakez_dem = <?php echo $total_total_marakez_dem_json; ?>;
        const total_z_kesht_abi = <?php echo $total_z_kesht_abi_json; ?>;
        const total_z_kesht_dem = <?php echo $total_z_kesht_dem_json; ?>;
        
        // Function to create a chart
        function createChart(ctxId, chartLabel, sData, marakezData, zKeshtData, sTotal, marakezTotal, zKeshtTotal) {
            const ctx = document.getElementById(ctxId).getContext('2d');
            let datasets;
            let chartTitleText;
            
            datasets = [{
                label: `سطح ابلاغی شهرستان (${chartLabel})`,
                data: sData,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: `مجموع برش مراکز (${chartLabel})`,
                data: marakezData,
                backgroundColor: 'rgba(255, 159, 64, 0.7)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }, {
                label: `سطح زیر کشت (${chartLabel})`,
                data: zKeshtData,
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }];
            chartTitleText = `مقایسه سطح ${chartLabel} ابلاغی (مجموع: ${sTotal.toLocaleString()}), برش مراکز (مجموع: ${marakezTotal.toLocaleString()}) و زیرکشت (مجموع: ${zKeshtTotal.toLocaleString()})`;

            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    onClick: (e) => {
                        const points = myChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
                        if (points.length) {
                            const firstPoint = points[0];
                            const labelIndex = firstPoint.index;
                            const cityId = city_ids[labelIndex];
                            
                            // Data to be sent to marakez_chart.php
                            const postData = {
                                id_ostan: '<?php echo $id_ostan1; ?>',
                                id_city: cityId,
                                z_sal: '<?php echo $z_sal; ?>',
                                mah_qroup: '<?php echo $mah_qroup; ?>',
                                mah_name: '<?php echo $mah_name; ?>'
                            };

                            // Dynamically create a form to submit POST data to a new window
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = 'marakez_chart.php'; 
                            form.target = 'Sab_L3_popup'; // The name of the new window
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
                            window.open('about:blank', 'Sab_L3_popup', 'location=1,status=1,scrollbars=1,width=1000,height=800,top=50,left=50');
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
                                    family: 'myfont2'
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: chartTitleText,
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
                    }
                }
            });
        }

        // Create the charts
        createChart('abiChart', 'آبی', s_abi_city_data, total_marakez_abi_data, z_kesht_abi_data, total_s_abi_city, total_total_marakez_abi, total_z_kesht_abi);
        createChart('demChart', 'دیم', s_dem_city_data, total_marakez_dem_data, z_kesht_dem_data, total_s_dem_city, total_total_marakez_dem, total_z_kesht_dem);
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