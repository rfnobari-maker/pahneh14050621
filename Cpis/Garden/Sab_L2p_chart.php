<?php
// PHP 5.3.3 Compatibility Version
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once("../../login/config.php");

$z_sal = isset($_POST['z_sal']) ? htmlspecialchars($_POST['z_sal'], ENT_QUOTES) : '';
$mah_qroup = isset($_POST['mah_qroup']) ? htmlspecialchars($_POST['mah_qroup'], ENT_QUOTES) : '';
$mah_name = isset($_POST['mah_name']) ? htmlspecialchars($_POST['mah_name'], ENT_QUOTES) : '';
$id_ostan1 = isset($_POST['id_ostan']) ? htmlspecialchars($_POST['id_ostan'], ENT_QUOTES) : '';

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
        return null;
    }
}

function get_s_access_count_by_ostan($id_ostan) {
    $query = "SELECT count(*) AS count FROM `users` WHERE `S_access` = '1' AND `id_ostan` = :id_ostan";
    $stmt = execute_prepared_statement($query, array(':id_ostan' => $id_ostan)); 
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    return $row ? (int)$row['count'] : 0;
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
    <title>نمودار تحلیلی شهرستان‌ها</title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../15_files/chart.js"></script>
    <style>
        body { font-family: 'myfont2', Tahoma; background-color: #f5f7fa; margin: 0; padding: 20px; direction: rtl; }
        .container { max-width: 1200px; margin: 0 auto; }
        .card { background: #ffffff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 30px; }
        .chart-container { position: relative; height: 450px; width: 100%; }
        h2 { text-align: center; color: #4CAF50; font-size: 1.3rem; margin-bottom: 20px; font-family: 'myfont2'; }
        
        /* استایل نوار هدر برای جابه‌جایی */
        .header-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .s-access-badge { background: #E8F5E9; color: #2E7D32; padding: 10px 15px; border-radius: 8px; font-weight: bold; border: 1px solid #C8E6C9; }
        .btn-close { background: #F44336; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-family: 'myfont2'; transition: 0.3s; }
        .btn-close:hover { background: #d32f2f; }
    </style>
</head>
<body>

<div class="container">
    <div class="header-bar">
        <div class="s-access-badge">تعداد کارشناسان پهنه استان: <?php echo get_s_access_count_by_ostan($id_ostan1); ?> نفر</div>
        
        <button class="btn-close" onclick="window.close()">بستن پنجره</button>
    </div>

    <?php
    if (!empty($mah_qroup) && !empty($mah_name) && !empty($z_sal) && !empty($id_ostan1)) {
        $ostan_name = get_ostan_name($id_ostan1);
        
        $query = "
            SELECT 
                cn.id_city, cn.city,
                IFNULL(A.s_ba, 0) as s_ba, IFNULL(A.s_na, 0) as s_na, IFNULL(A.s_bd, 0) as s_bd, IFNULL(A.s_nd, 0) as s_nd,
                IFNULL(M.m_ba, 0) as m_ba, IFNULL(M.m_na, 0) as m_na, IFNULL(M.m_bd, 0) as m_bd, IFNULL(M.m_nd, 0) as m_nd,
                IFNULL(Z.z_ba, 0) as z_ba, IFNULL(Z.z_na, 0) as z_na, IFNULL(Z.z_bd, 0) as z_bd, IFNULL(Z.z_nd, 0) as z_nd
            FROM cityname cn
            LEFT JOIN (
                SELECT id_city, SUM(s_bar_abi) as s_ba, SUM(s_nobar_abi) as s_na, SUM(s_bar_dem) as s_bd, SUM(s_nobar_dem) as s_nd
                FROM Garden_ab_city WHERE z_sal = :z1 AND group_cod = :g1 AND product_cod = :p1 GROUP BY id_city
            ) A ON cn.id_city = A.id_city
            LEFT JOIN (
                SELECT id_city, SUM(s_bar_abi) as m_ba, SUM(s_nobar_abi) as m_na, SUM(s_bar_dem) as m_bd, SUM(s_nobar_dem) as m_nd
                FROM Garden_ab_mar WHERE z_sal = :z2 AND group_cod = :g2 AND product_cod = :p2 GROUP BY id_city
            ) M ON cn.id_city = M.id_city
            LEFT JOIN (
                SELECT id_city,
                       SUM(CASE WHEN no_kesh='1' THEN s_kesht_b ELSE 0 END) as z_ba,
                       SUM(CASE WHEN no_kesh='1' THEN s_kesht_gb ELSE 0 END) as z_na,
                       SUM(CASE WHEN no_kesh='2' THEN s_kesht_b ELSE 0 END) as z_bd,
                       SUM(CASE WHEN no_kesh='2' THEN s_kesht_gb ELSE 0 END) as z_nd
                FROM Garden_prod WHERE z_sal = :z3 AND cod_mah = :p3 GROUP BY id_city
            ) Z ON cn.id_city = Z.id_city
            WHERE cn.id_ostan = :id_o
            ORDER BY cn.city ASC
        ";

        $params = array(
            ':z1' => $z_sal, ':g1' => $mah_qroup, ':p1' => $mah_name,
            ':z2' => $z_sal, ':g2' => $mah_qroup, ':p2' => $mah_name,
            ':z3' => $z_sal, ':p3' => $mah_name,
            ':id_o' => $id_ostan1
        );

        $stmt = execute_prepared_statement($query, $params);
        
        if ($stmt && $stmt->rowCount() > 0) {
            $labels = array();
            $data = array(
                'ba' => array('s'=>array(), 'm'=>array(), 'z'=>array(), 'st'=>0, 'mt'=>0, 'zt'=>0),
                'na' => array('s'=>array(), 'm'=>array(), 'z'=>array(), 'st'=>0, 'mt'=>0, 'zt'=>0),
                'bd' => array('s'=>array(), 'm'=>array(), 'z'=>array(), 'st'=>0, 'mt'=>0, 'zt'=>0),
                'nd' => array('s'=>array(), 'm'=>array(), 'z'=>array(), 'st'=>0, 'mt'=>0, 'zt'=>0)
            );

            while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $labels[] = $r['city'];
                $data['ba']['s'][] = (float)$r['s_ba']; $data['ba']['st'] += (float)$r['s_ba'];
                $data['ba']['m'][] = (float)$r['m_ba']; $data['ba']['mt'] += (float)$r['m_ba'];
                $data['ba']['z'][] = (float)$r['z_ba']; $data['ba']['zt'] += (float)$r['z_ba'];
                $data['na']['s'][] = (float)$r['s_na']; $data['na']['st'] += (float)$r['s_na'];
                $data['na']['m'][] = (float)$r['m_na']; $data['na']['mt'] += (float)$r['m_na'];
                $data['na']['z'][] = (float)$r['z_na']; $data['na']['zt'] += (float)$r['z_na'];
                $data['bd']['s'][] = (float)$r['s_bd']; $data['bd']['st'] += (float)$r['s_bd'];
                $data['bd']['m'][] = (float)$r['m_bd']; $data['bd']['mt'] += (float)$r['m_bd'];
                $data['bd']['z'][] = (float)$r['z_bd']; $data['bd']['zt'] += (float)$r['z_bd'];
                $data['nd']['s'][] = (float)$r['s_nd']; $data['nd']['st'] += (float)$r['s_nd'];
                $data['nd']['m'][] = (float)$r['m_nd']; $data['nd']['mt'] += (float)$r['m_nd'];
                $data['nd']['z'][] = (float)$r['z_nd']; $data['nd']['zt'] += (float)$r['z_nd'];
            }
            
            $base_title = " محصول " . $product_display_name . " - استان " . $ostan_name;
    ?>

    <div class="card"><h2>مقایسه سطح آبی (بارور) <?php echo $base_title; ?></h2><div class="chart-container"><canvas id="c1"></canvas></div></div>
    <div class="card"><h2>مقایسه سطح آبی (غیربارور) <?php echo $base_title; ?></h2><div class="chart-container"><canvas id="c2"></canvas></div></div>
    <div class="card"><h2>مقایسه سطح دیم (بارور) <?php echo $base_title; ?></h2><div class="chart-container"><canvas id="c3"></canvas></div></div>
    <div class="card"><h2>مقایسه سطح دیم (غیربارور) <?php echo $base_title; ?></h2><div class="chart-container"><canvas id="c4"></canvas></div></div>

    <script>
        var cityLabels = <?php echo json_encode($labels); ?>;
        function renderChart(canvasId, sData, mData, zData, sTotal, mTotal, zTotal) {
            new Chart(document.getElementById(canvasId), {
                type: 'bar',
                data: {
                    labels: cityLabels,
                    datasets: [
                        { label: 'ابلاغی شهرستان (' + sTotal.toLocaleString() + ')', data: sData, backgroundColor: 'rgba(54, 162, 235, 0.7)' },
                        { label: 'برش مراکز (' + mTotal.toLocaleString() + ')', data: mData, backgroundColor: 'rgba(255, 159, 64, 0.7)' },
                        { label: 'زیرکشت (' + zTotal.toLocaleString() + ')', data: zData, backgroundColor: 'rgba(75, 192, 192, 0.7)' }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { rtl: true, labels: { font: { family: 'myfont2' } } },
                        tooltip: { bodyFont: { family: 'myfont2' }, titleFont: { family: 'myfont2' } }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { font: { family: 'myfont2' } } },
                        x: { ticks: { font: { family: 'myfont2' } } }
                    }
                }
            });
        }
        renderChart('c1', <?php echo json_encode($data['ba']['s']); ?>, <?php echo json_encode($data['ba']['m']); ?>, <?php echo json_encode($data['ba']['z']); ?>, <?php echo $data['ba']['st']; ?>, <?php echo $data['ba']['mt']; ?>, <?php echo $data['ba']['zt']; ?>);
        renderChart('c2', <?php echo json_encode($data['na']['s']); ?>, <?php echo json_encode($data['na']['m']); ?>, <?php echo json_encode($data['na']['z']); ?>, <?php echo $data['na']['st']; ?>, <?php echo $data['na']['mt']; ?>, <?php echo $data['na']['zt']; ?>);
        renderChart('c3', <?php echo json_encode($data['bd']['s']); ?>, <?php echo json_encode($data['bd']['m']); ?>, <?php echo json_encode($data['bd']['z']); ?>, <?php echo $data['bd']['st']; ?>, <?php echo $data['bd']['mt']; ?>, <?php echo $data['bd']['zt']; ?>);
        renderChart('c4', <?php echo json_encode($data['nd']['s']); ?>, <?php echo json_encode($data['nd']['m']); ?>, <?php echo json_encode($data['nd']['z']); ?>, <?php echo $data['nd']['st']; ?>, <?php echo $data['nd']['mt']; ?>, <?php echo $data['nd']['zt']; ?>);
    </script>
    <?php
        } else { echo '<div class="card" style="text-align:center;">داده‌ای برای این استان یافت نشد.</div>'; }
    }
    ?>
</div>
</body>
</html>