<?php
// PHP 5.3.3 Compatibility Version
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once("../../login/config.php");

$z_sal = isset($_POST['z_sal']) ? htmlspecialchars($_POST['z_sal'], ENT_QUOTES) : '';
$mah_qroup = isset($_POST['mah_qroup']) ? htmlspecialchars($_POST['mah_qroup'], ENT_QUOTES) : '';
$mah_name = isset($_POST['mah_name']) ? htmlspecialchars($_POST['mah_name'], ENT_QUOTES) : '';
$id_ostan = isset($_POST['id_ostan']) ? htmlspecialchars($_POST['id_ostan'], ENT_QUOTES) : '';
$id_city = isset($_POST['id_city']) ? htmlspecialchars($_POST['id_city'], ENT_QUOTES) : '';

$product_display_name = function_exists('mah_name_bagh') ? mah_name_bagh($mah_name) : 'محصول انتخاب شده';

function get_db_connection() {
    global $dbh;
    return $dbh;
}

function execute_prepared_statement($query, $params) {
    $dbh = get_db_connection();
    if (!$dbh) return null;
    try {
        $stmt = $dbh->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt;
    } catch (PDOException $e) {
        error_log("PDO Error: " . $e->getMessage());
        return null;
    }
}

function get_s_access_count_by_city($id_ostan, $id_city) {
    $query = "SELECT count(*) AS count FROM `users` WHERE `S_access` = '1' AND `id_ostan` = :id_ostan AND `id_city` = :id_city";
    $stmt = execute_prepared_statement($query, array(':id_ostan' => $id_ostan, ':id_city' => $id_city));
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    return $row ? (int)$row['count'] : 0;
}

function get_city_name($id_ostan, $id_city) {
    $query = "SELECT city FROM `cityname` WHERE id_ostan = :id_ostan AND id_city = :id_city LIMIT 1";
    $stmt = execute_prepared_statement($query, array(':id_ostan' => $id_ostan, ':id_city' => $id_city));
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    return $row ? $row['city'] : 'شهرستان نامشخص';
}

function get_ostan_name($id_ostan) {
    $query = "SELECT ostan FROM `ostanname` WHERE id_ostan = :id_ostan LIMIT 1";
    $stmt = execute_prepared_statement($query, array(':id_ostan' => $id_ostan));
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    return $row ? $row['ostan'] : 'استان نامشخص';
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نمودار تحلیلی مراکز</title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../15_files/chart.js"></script>
    <style>
        body { 
            font-family: 'myfont2', Tahoma; 
            background-color: #f5f7fa; 
            margin: 0; 
            padding: 20px; 
            direction: rtl; 
        }
        .container { max-width: 1200px; margin: 0 auto; }
        .card { 
            background: #ffffff; 
            padding: 20px; 
            border-radius: 12px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
            margin-bottom: 30px; 
        }
        .chart-container { position: relative; height: 450px; width: 100%; }
        h2 { 
            text-align: center; 
            color: #4CAF50; 
            font-size: 1.3rem; 
            margin-bottom: 20px; 
            font-family: 'myfont2'; 
        }
        
        .header-bar { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 20px; 
        }
        .s-access-badge { 
            background: #E8F5E9; 
            color: #2E7D32; 
            padding: 10px 15px; 
            border-radius: 8px; 
            font-weight: bold; 
            border: 1px solid #C8E6C9; 
        }
        .btn-close { 
            background: #F44336; 
            color: white; 
            border: none; 
            padding: 10px 20px; 
            border-radius: 8px; 
            cursor: pointer; 
            font-family: 'myfont2'; 
            transition: 0.3s; 
        }
        .btn-close:hover { background: #d32f2f; }
        .no-data { text-align: center; padding: 40px; font-size: 1.2rem; color: #666; }
    </style>
</head>
<body>

<div class="container">
    <div class="header-bar">
        <div class="s-access-badge">
            تعداد کارشناسان پهنه شهرستان: <?php echo get_s_access_count_by_city($id_ostan, $id_city); ?> نفر
        </div>
        <button class="btn-close" onclick="window.close()">بستن پنجره</button>
    </div>

    <?php
    if (!empty($mah_qroup) && !empty($mah_name) && !empty($z_sal) && !empty($id_ostan) && !empty($id_city)) {
        
        $ostan_name = get_ostan_name($id_ostan);
        $city_name = get_city_name($id_ostan, $id_city);
        
        // ========== کوئری با LEFT JOIN مانند Sab_L1p_chart.php ==========
        $query = "
            SELECT 
                m.id_mar,
                mn.mar,
                m.s_bar_abi, 
                m.s_nobar_abi, 
                m.s_bar_dem, 
                m.s_nobar_dem,
                IFNULL(z.z_bar_abi, 0) as z_bar_abi,
                IFNULL(z.z_nobar_abi, 0) as z_nobar_abi,
                IFNULL(z.z_bar_dem, 0) as z_bar_dem,
                IFNULL(z.z_nobar_dem, 0) as z_nobar_dem
            FROM Garden_ab_mar m
            LEFT JOIN mar mn ON m.id_mar = mn.id_mar
            LEFT JOIN (
                SELECT 
                    id_mar,
                    SUM(CASE WHEN no_kesh = '1' THEN s_kesht_b ELSE 0 END) as z_bar_abi,
                    SUM(CASE WHEN no_kesh = '1' THEN s_kesht_gb ELSE 0 END) as z_nobar_abi,
                    SUM(CASE WHEN no_kesh = '2' THEN s_kesht_b ELSE 0 END) as z_bar_dem,
                    SUM(CASE WHEN no_kesh = '2' THEN s_kesht_gb ELSE 0 END) as z_nobar_dem
                FROM Garden_prod 
                WHERE z_sal = :z_sal_z
                AND cod_mah = :cod_mah_z
                AND id_ostan = :id_ostan_z
                AND id_city = :id_city_z
                GROUP BY id_mar
            ) z ON m.id_mar = z.id_mar
            WHERE m.z_sal = :z_sal_m
            AND m.group_cod = :group_cod_m
            AND m.product_cod = :product_cod_m
            AND m.id_ostan = :id_ostan_m
            AND m.id_city = :id_city_m
            ORDER BY mn.mar ASC
        ";

        $params = array(
            ':z_sal_m' => $z_sal,
            ':group_cod_m' => $mah_qroup,
            ':product_cod_m' => $mah_name,
            ':id_ostan_m' => $id_ostan,
            ':id_city_m' => $id_city,
            
            ':z_sal_z' => $z_sal,
            ':cod_mah_z' => $mah_name,
            ':id_ostan_z' => $id_ostan,
            ':id_city_z' => $id_city
        );

        $stmt = execute_prepared_statement($query, $params);
        
        if ($stmt && $stmt->rowCount() > 0) {
            $labels = array();
            $mar_ids = array();
            $d = array(
                'ba' => array(), 'na' => array(), 
                'bd' => array(), 'nd' => array(),
                'zba' => array(), 'zna' => array(),
                'zbd' => array(), 'znd' => array()
            );
            $totals = array(
                'ba' => 0, 'na' => 0, 'bd' => 0, 'nd' => 0,
                'zba' => 0, 'zna' => 0, 'zbd' => 0, 'znd' => 0
            );

            while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $labels[] = $r['mar'];
                $mar_ids[] = $r['id_mar'];
                
                // داده‌های مراکز
                $d['ba'][] = (float)$r['s_bar_abi'];
                $totals['ba'] += (float)$r['s_bar_abi'];
                
                $d['na'][] = (float)$r['s_nobar_abi'];
                $totals['na'] += (float)$r['s_nobar_abi'];
                
                $d['bd'][] = (float)$r['s_bar_dem'];
                $totals['bd'] += (float)$r['s_bar_dem'];
                
                $d['nd'][] = (float)$r['s_nobar_dem'];
                $totals['nd'] += (float)$r['s_nobar_dem'];
                
                // داده‌های زیرکشت
                $d['zba'][] = (float)$r['z_bar_abi'];
                $totals['zba'] += (float)$r['z_bar_abi'];
                
                $d['zna'][] = (float)$r['z_nobar_abi'];
                $totals['zna'] += (float)$r['z_nobar_abi'];
                
                $d['zbd'][] = (float)$r['z_bar_dem'];
                $totals['zbd'] += (float)$r['z_bar_dem'];
                
                $d['znd'][] = (float)$r['z_nobar_dem'];
                $totals['znd'] += (float)$r['z_nobar_dem'];
            }
            
            $base_title = " محصول " . $product_display_name . " - استان " . $ostan_name . " - شهرستان " . $city_name;
    ?>

    <div class="card">
        <h2>مقایسه سطح آبی (بارور) <?php echo $base_title; ?></h2>
        <div class="chart-container"><canvas id="c1"></canvas></div>
    </div>
    
    <div class="card">
        <h2>مقایسه سطح آبی (غیربارور) <?php echo $base_title; ?></h2>
        <div class="chart-container"><canvas id="c2"></canvas></div>
    </div>
    
    <div class="card">
        <h2>مقایسه سطح دیم (بارور) <?php echo $base_title; ?></h2>
        <div class="chart-container"><canvas id="c3"></canvas></div>
    </div>
    
    <div class="card">
        <h2>مقایسه سطح دیم (غیربارور) <?php echo $base_title; ?></h2>
        <div class="chart-container"><canvas id="c4"></canvas></div>
    </div>

    <script>
        var labels = <?php echo json_encode($labels); ?>;
        var mar_ids = <?php echo json_encode($mar_ids); ?>;

        function create(id, marData, zData, marTotal, zTotal) {
            new Chart(document.getElementById(id), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        { 
                            label: 'برش مراکز (' + marTotal.toLocaleString() + ' هکتار)', 
                            data: marData, 
                            backgroundColor: 'rgba(54, 162, 235, 0.7)' 
                        },
                        { 
                            label: 'زیرکشت (' + zTotal.toLocaleString() + ' هکتار)', 
                            data: zData, 
                            backgroundColor: 'rgba(75, 192, 192, 0.7)' 
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    onClick: function(e, el) {
                        if (el.length > 0) {
                            var idx = el[0].index;
                            alert('مرکز: ' + labels[idx] + '\nکد مرکز: ' + mar_ids[idx]);
                        }
                    },
                    plugins: { 
                        legend: { rtl: true, labels: { font: { family: 'myfont2', size: 12 } } },
                        tooltip: { 
                            bodyFont: { family: 'myfont2' }, 
                            titleFont: { family: 'myfont2' }, 
                            callbacks: { 
                                label: function(ctx) { 
                                    return ctx.dataset.label.split(' (')[0] + ': ' + ctx.raw.toLocaleString() + ' هکتار'; 
                                } 
                            } 
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            title: { display: true, text: 'سطح (هکتار)', font: { family: 'myfont2', size: 14 } },
                            ticks: { font: { family: 'myfont2' } } 
                        },
                        x: { ticks: { font: { family: 'myfont2' }, autoSkip: false } }
                    }
                }
            });
        }

        // ساخت نمودارها
        create('c1', <?php echo json_encode($d['ba']); ?>, <?php echo json_encode($d['zba']); ?>, <?php echo $totals['ba']; ?>, <?php echo $totals['zba']; ?>);
        create('c2', <?php echo json_encode($d['na']); ?>, <?php echo json_encode($d['zna']); ?>, <?php echo $totals['na']; ?>, <?php echo $totals['zna']; ?>);
        create('c3', <?php echo json_encode($d['bd']); ?>, <?php echo json_encode($d['zbd']); ?>, <?php echo $totals['bd']; ?>, <?php echo $totals['zbd']; ?>);
        create('c4', <?php echo json_encode($d['nd']); ?>, <?php echo json_encode($d['znd']); ?>, <?php echo $totals['nd']; ?>, <?php echo $totals['znd']; ?>);
    </script>
    <?php
        } else {
            echo '<div class="card no-data">❌ داده‌ای برای مراکز این شهرستان یافت نشد.</div>';
        }
    } else {
        echo '<div class="card no-data">❌ اطلاعات مورد نیاز وارد نشده است.</div>';
    }
    ?>
</div>
</body>
</html>