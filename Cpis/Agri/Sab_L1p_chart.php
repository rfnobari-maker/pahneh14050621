<?php
// Sab_L1p_chart.php
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once("../../login/config.php");

// اگر درخواست AJAX برای گرفتن داده بود
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    
    $z_sal = isset($_POST['z_sal']) ? htmlspecialchars($_POST['z_sal'], ENT_QUOTES) : '';
    $mah_qroup = isset($_POST['mah_qroup']) ? htmlspecialchars($_POST['mah_qroup'], ENT_QUOTES) : '';
    $mah_name = isset($_POST['mah_name']) ? htmlspecialchars($_POST['mah_name'], ENT_QUOTES) : '';
    $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal);
    
    // تعریف product_map - فقط برای سال زراعی 1405-1404
    $product_map = array();
    
    // فقط اگر سال زراعی 1405-1404 باشد، نگاشت اعمال می‌شود
    if ($z_sal === '1404-1405') {
        $product_map = array(
            '103' => '102', '107' => '106', '176' => '490', '178' => '490', '180' => '490',
            '182' => '490', '184' => '490', '186' => '490', '188' => '490', '190' => '490',
            '192' => '490', '194' => '490', '196' => '490', '198' => '490', '200' => '490',
            '414' => '490', '416' => '490', '418' => '490', '420' => '490', '422' => '490',
            '424' => '490', '426' => '490', '428' => '490', '430' => '490', '432' => '490',
            '434' => '490', '436' => '490', '438' => '490', '440' => '490', '442' => '490',
            '444' => '490', '446' => '490', '448' => '490', '449' => '490', '464' => '490'
        );
    }
    
    function getProductCodes($mah_name, $product_map) {
        $codes = array($mah_name);
        foreach ($product_map as $child => $parent) {
            if ($parent == $mah_name) $codes[] = $child;
        }
        if (isset($product_map[$mah_name])) $codes[] = $product_map[$mah_name];
        return array_unique($codes);
    }
    
    $product_codes = getProductCodes($mah_name, $product_map);
    $product_codes_sql = implode(',', array_map('intval', $product_codes));
    
    function get_db_connection() {
        global $dbh;
        return $dbh;
    }
    
    function execute_prepared_statement($query, $params) {
        $dbh = get_db_connection();
        if (!$dbh) return null;
        try {
            $stmt = $dbh->prepare($query);
            foreach ($params as $key => &$value) $stmt->bindValue($key, $value);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    function get_s_access_count() {
        $dbh = get_db_connection();
        if (!$dbh) return 'N/A';
        $query = "SELECT count(*) AS count FROM `users` WHERE `S_access` = '1'";
        $stmt = $dbh->query($query);
        $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
        return $row ? (int)$row['count'] : '0';
    }
    
    $result = array('success' => false, 'data' => null, 'error' => '');
    
    if (!empty($mah_qroup) && !empty($mah_name) && !empty($z_sal)) {
        $dbh = get_db_connection();
        if ($dbh) {
            $special_products = array('170', '172', '174');
            $mah_name_mapped = $mah_name;
            $zkesht_table = 'Vege_prod';
            $zkesht_abi_col_select = 'IFNULL(z_abi.total_z_kesht, 0)';
            $zkesht_dem_col_select = 'IFNULL(z_dem.total_z_kesht, 0)';
            $zkesht_abi_select = "SUM(zer_kesht) AS total_z_kesht";
            $zkesht_dem_select = "SUM(zer_kesht) AS total_z_kesht";
            $zkesht_abi_condition = "";
            $zkesht_dem_condition = " AND id_ostan = '01'";
            
            if (!in_array($mah_name_mapped, $special_products)) {
                $zkesht_table = $Agri_prod_table;
                $zkesht_abi_col_select = 'IFNULL(z_abi.total_z_kesht_a, 0) + IFNULL(z_abi.total_z_kesht_b, 0)';
                $zkesht_dem_col_select = 'IFNULL(z_dem.total_z_kesht_a, 0) + IFNULL(z_dem.total_z_kesht_b, 0)';
                $zkesht_abi_select = "SUM(zer_kesht_a) AS total_z_kesht_a, SUM(zer_kesht_b) AS total_z_kesht_b";
                $zkesht_dem_select = "SUM(zer_kesht_a) AS total_z_kesht_a, SUM(zer_kesht_b) AS total_z_kesht_b";
                $zkesht_abi_condition = " AND no_kesh = '1'";
                $zkesht_dem_condition = " AND no_kesh = '2'";
            }
            
$query = "
    SELECT 
        o.id_ostan,
        o.s_dem,
        o.s_abi,
        osn.ostan,
        IFNULL(c.total_city_dem, 0) AS total_city_dem,
        IFNULL(c.total_city_abi, 0) AS total_city_abi,
        {$zkesht_abi_col_select} AS total_z_kesht_abi,
        {$zkesht_dem_col_select} AS total_z_kesht_dem
    FROM Agri_ab_ostan o
    JOIN ostanname osn ON o.id_ostan = osn.id_ostan
    LEFT JOIN (
        SELECT id_ostan, SUM(s_dem) AS total_city_dem, SUM(s_abi) AS total_city_abi
        FROM Agri_ab_city
        WHERE z_sal = :z_sal_city AND group_cod = :mah_qroup_city AND product_cod IN ($product_codes_sql)
        GROUP BY id_ostan
    ) c ON o.id_ostan = c.id_ostan
    LEFT JOIN (
        SELECT id_ostan, {$zkesht_abi_select}
        FROM {$zkesht_table}
        WHERE z_sal = :z_sal_abi AND cod_mah IN ($product_codes_sql) {$zkesht_abi_condition}
        GROUP BY id_ostan
    ) z_abi ON o.id_ostan = z_abi.id_ostan
    LEFT JOIN (
        SELECT id_ostan, {$zkesht_dem_select}
        FROM {$zkesht_table}
        WHERE z_sal = :z_sal_dem AND cod_mah IN ($product_codes_sql) {$zkesht_dem_condition}
        GROUP BY id_ostan
    ) z_dem ON o.id_ostan = z_dem.id_ostan
    WHERE o.z_sal = :z_sal_main AND o.group_cod = :mah_qroup_main AND o.product_cod IN ($product_codes_sql)
    ORDER BY osn.sort_order
";            
            $params = array(
                ':z_sal_main' => $z_sal, ':mah_qroup_main' => $mah_qroup,
                ':z_sal_city' => $z_sal, ':mah_qroup_city' => $mah_qroup,
                ':z_sal_abi' => $z_sal, ':z_sal_dem' => $z_sal,
            );
            
            $stmt = execute_prepared_statement($query, $params);
            
            if ($stmt && $stmt->rowCount() > 0) {
                $province_names = array();
                $s_dem_data = array();
                $total_city_dem_data = array();
                $s_abi_data = array();
                $total_city_abi_data = array();
                $z_kesht_abi_data = array();
                $z_kesht_dem_data = array();
                $province_ids = array();
                
                $total_s_dem = $total_s_abi = $total_city_dem = $total_city_abi = $total_z_kesht_abi = $total_z_kesht_dem = 0;
                
                $main_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($main_data as $row) {
                    $province_names[] = $row['ostan'];
                    $s_dem = (float)$row['s_dem'];
                    $s_abi = (float)$row['s_abi'];
                    $city_dem = (float)$row['total_city_dem'];
                    $city_abi = (float)$row['total_city_abi'];
                    $z_abi = (float)$row['total_z_kesht_abi'];
                    $z_dem = (float)$row['total_z_kesht_dem'];
                    
                    $s_dem_data[] = $s_dem;
                    $s_abi_data[] = $s_abi;
                    $total_city_dem_data[] = $city_dem;
                    $total_city_abi_data[] = $city_abi;
                    $z_kesht_abi_data[] = $z_abi;
                    $z_kesht_dem_data[] = $z_dem;
                    $province_ids[] = $row['id_ostan'];
                    
                    $total_s_dem += $s_dem;
                    $total_s_abi += $s_abi;
                    $total_city_dem += $city_dem;
                    $total_city_abi += $city_abi;
                    $total_z_kesht_abi += $z_abi;
                    $total_z_kesht_dem += $z_dem;
                }
                
                $s_access_count = get_s_access_count();
                
                $result['success'] = true;
                $result['data'] = array(
                    'province_names' => $province_names,
                    's_dem_data' => $s_dem_data,
                    'total_city_dem_data' => $total_city_dem_data,
                    's_abi_data' => $s_abi_data,
                    'total_city_abi_data' => $total_city_abi_data,
                    'z_kesht_abi_data' => $z_kesht_abi_data,
                    'z_kesht_dem_data' => $z_kesht_dem_data,
                    'province_ids' => $province_ids,
                    'total_s_abi' => $total_s_abi,
                    'total_city_abi' => $total_city_abi,
                    'total_s_dem' => $total_s_dem,
                    'total_city_dem' => $total_city_dem,
                    'total_z_kesht_abi' => $total_z_kesht_abi,
                    'total_z_kesht_dem' => $total_z_kesht_dem,
                    's_access_count' => $s_access_count,
                    'product_name' => mah_name($mah_name),
                    'z_sal' => $z_sal,
                    'mah_qroup' => $mah_qroup,
                    'mah_name' => $mah_name
                );
            } else {
                $result['error'] = 'اطلاعاتی یافت نشد';
            }
        } else {
            $result['error'] = 'خطا در اتصال به پایگاه داده';
        }
    } else {
        $result['error'] = 'لطفا اطلاعات مورد نیاز را وارد کنید';
    }
    
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}

// اگر درخواست معمولی بود، صفحه HTML با لودینگ نمایش داده شود
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
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'myfont2', Tahoma, Arial, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 24px;
            direction: rtl;
        }
        
        /* لودینگ اصلی - بلافاصله نمایش داده می‌شود */
        #mainLoader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            z-index: 999999;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        
        .spinner {
            width: 70px;
            height: 70px;
            border: 7px solid #e0e0e0;
            border-top: 7px solid #4CAF50;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 25px;
        }
        
        .loader-text {
            font-family: 'myfont2', Tahoma, Arial, sans-serif;
            font-size: 20px;
            color: #2E7D32;
            font-weight: bold;
        }
        
        .loader-subtext {
            font-family: 'myfont2', Tahoma, Arial, sans-serif;
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
        
        .s-access-info-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        .s-access-count {
            background-color: #E8F5E9; 
            color: #2E7D32; 
            padding: 12px 18px; 
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            font-size: 1rem;
            border: 1px solid #C8E6C9;
            font-weight: bold;
        }
        
        .card {
            background: #ffffff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        h2 {
            text-align: center;
            color: #4CAF50;
            margin-top: 0;
            font-size: 1.8rem;
        }
        
        .close-btn {
            background-color: #F44336;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            font-family: 'myfont2', Tahoma, Arial, sans-serif;
        }
        
        .close-btn:hover { background-color: #D32F2F; }
        
        .info-message {
            text-align: center;
            padding: 24px;
            background-color: #fff3e0;
            border: 1px solid #ffcc80;
            border-radius: 8px;
            color: #e65100;
        }
        
        @media (max-width: 768px) {
            body { padding: 16px; }
            h2 { font-size: 1.5rem; }
            .spinner { width: 50px; height: 50px; border-width: 5px; }
            .loader-text { font-size: 16px; }
        }
    </style>
</head>
<body>

<!-- لودینگ - بلافاصله نمایش داده می‌شود -->
<div id="mainLoader">
    <div class="spinner"></div>
    <div class="loader-text">در حال بارگذاری اطلاعات...</div>
    <div class="loader-subtext">لطفاً چند لحظه صبر کنید</div>
</div>

<div class="close-btn-container">
    <button class="close-btn" onclick="window.close()">بستن پنجره</button>
</div>

<div class="s-access-info-container">
    <div class="s-access-count" id="sAccessCount">کارشناسان پهنه کشور: -- نفر</div>
</div>

<div class="container" id="contentContainer" style="display: none;">
    <div class="card" id="abiChartCard">
        <h2 class="chart-title" id="abiChartTitle">نمودار مقایسه ای سطح (آبی)</h2>
        <div class="chart-container">
            <canvas id="abiChart"></canvas>
        </div>
    </div>
    <div class="card" id="demChartCard">
        <h2 class="chart-title" id="demChartTitle">نمودار مقایسه ای سطح (دیم)</h2>
        <div class="chart-container">
            <canvas id="demChart"></canvas>
        </div>
    </div>
</div>

<script>
// دریافت داده‌ها با AJAX
$(document).ready(function() {
    // دریافت مقادیر از POST (از صفحه قبل)
    var z_sal = '<?php echo isset($_POST['z_sal']) ? addslashes($_POST['z_sal']) : ""; ?>';
    var mah_qroup = '<?php echo isset($_POST['mah_qroup']) ? addslashes($_POST['mah_qroup']) : ""; ?>';
    var mah_name = '<?php echo isset($_POST['mah_name']) ? addslashes($_POST['mah_name']) : ""; ?>';
    
    // اگر داده‌ها از طریق POST نیامده، از localStorage یا URL استفاده کنید
    if (!z_sal || !mah_qroup || !mah_name) {
        // می‌توانید از localStorage یا پارامترهای URL استفاده کنید
        console.log('داده‌های ورودی یافت نشد');
        $('#mainLoader .loader-text').text('خطا: اطلاعات ورودی یافت نشد');
        return;
    }
    
    // ارسال درخواست AJAX
    $.ajax({
        url: window.location.href,
        type: 'POST',
        data: {
            z_sal: z_sal,
            mah_qroup: mah_qroup,
            mah_name: mah_name
        },
        dataType: 'json',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
            // مخفی کردن لودینگ
            $('#mainLoader').fadeOut(500);
            
            if (response.success) {
                var data = response.data;
                
                // نمایش تعداد کارشناسان
                $('#sAccessCount').text('کارشناسان پهنه کشور: ' + data.s_access_count + ' نفر');
                
                // به روز رسانی عناوین
                $('#abiChartTitle').text('نمودار مقایسه ای سطح (آبی) محصول ' + data.product_name);
                $('#demChartTitle').text('نمودار مقایسه ای سطح (دیم) محصول ' + data.product_name);
                
                // نمایش محتوا
                $('#contentContainer').show();
                
                // ایجاد نمودارها
                createChart('abiChart', 'آبی', 
                    data.s_abi_data, data.total_city_abi_data, data.z_kesht_abi_data,
                    data.total_s_abi, data.total_city_abi, data.total_z_kesht_abi,
                    data.province_names, data.province_ids,
                    data.z_sal, data.mah_qroup, data.mah_name);
                    
                createChart('demChart', 'دیم',
                    data.s_dem_data, data.total_city_dem_data, data.z_kesht_dem_data,
                    data.total_s_dem, data.total_city_dem, data.total_z_kesht_dem,
                    data.province_names, data.province_ids,
                    data.z_sal, data.mah_qroup, data.mah_name);
            } else {
                $('#contentContainer').html('<div class="card info-message"><p>' + response.error + '</p></div>').show();
            }
        },
        error: function(xhr, status, error) {
            $('#mainLoader').fadeOut(500);
            $('#contentContainer').html('<div class="card info-message"><p>خطا در ارتباط با سرور: ' + error + '</p></div>').show();
        }
    });
});

function createChart(ctxId, chartLabel, sData, cityData, zKeshtData, sTotal, cityTotal, zKeshtTotal, labels, provinceIds, z_sal, mah_qroup, mah_name) {
    var ctx = document.getElementById(ctxId).getContext('2d');
    var chartTitleText = 'مقایسه سطح ' + chartLabel + ' ابلاغی (مجموع: ' + sTotal.toLocaleString() + '), برش شهرستانی (مجموع: ' + cityTotal.toLocaleString() + ') و زیرکشت (مجموع: ' + zKeshtTotal.toLocaleString() + ')';
    
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'سطح ابلاغی استان (' + chartLabel + ')',
                    data: sData,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'مجموع برش شهرستانی (' + chartLabel + ')',
                    data: cityData,
                    backgroundColor: 'rgba(255, 159, 64, 0.7)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                },
                {
                    label: 'سطح زیر کشت (' + chartLabel + ')',
                    data: zKeshtData,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            onClick: function(e) {
                var points = myChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
                if (points.length) {
                    var labelIndex = points[0].index;
                    var ostanId = provinceIds[labelIndex];
                    
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'Sab_L2p_chart.php';
                    form.target = 'Sab_L2_popup';
                    form.style.display = 'none';
                    
                    var fields = {
                        id_ostan: ostanId,
                        z_sal: z_sal,
                        mah_qroup: mah_qroup,
                        mah_name: mah_name
                    };
                    
                    for (var key in fields) {
                        var input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = key;
                        input.value = fields[key];
                        form.appendChild(input);
                    }
                    
                    window.open('about:blank', 'Sab_L2_popup', 'location=no,status=no,scrollbars=yes,resizable=yes,width=1000,height=800,top=50,left=50');
                    document.body.appendChild(form);
                    form.submit();
                    document.body.removeChild(form);
                }
            },
            plugins: {
                legend: { display: true, position: 'top', rtl: true, labels: { font: { size: 14, family: 'myfont2' } } },
                title: { display: true, text: chartTitleText, font: { size: 16, family: 'myfont2' } }
            },
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'سطح (هکتار)', font: { size: 14, family: 'myfont2' } } },
                x: { ticks: { autoSkip: false, font: { family: 'myfont2' } } }
            }
        }
    });
}
</script>

</body>
</html>