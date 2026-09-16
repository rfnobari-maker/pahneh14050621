<?php
// PHP 5.2.3 Compatibility Version
require_once("../../lock_oce.php");
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
    $stmt = $dbh->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    return $stmt;
}

function get_s_access_count_by_ostan($id_ostan) {
    $dbh = get_db_connection();
    if (!$dbh) return '0';
    $query = "SELECT count(*) AS count FROM `users` WHERE `S_access` = '1' AND `id_ostan` = :id_ostan_target";
    $stmt = execute_prepared_statement($query, array(':id_ostan_target' => $id_ostan)); 
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    return $row ? (int)$row['count'] : '0';
}

function get_ostan_name($id_ostan) {
    $dbh = get_db_connection();
    if (!$dbh) return 'استان ناشناخته';
    $query = "SELECT ostan FROM `ostanname` WHERE id_ostan = :id_ostan LIMIT 1";
    $stmt = execute_prepared_statement($query, array(':id_ostan' => $id_ostan));
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    return $row ? $row['ostan'] : 'استان ناشناخته';
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نمودارهای آماری تفکیکی شهرستان</title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../15_files/chart.js"></script>
    <style>
        :root {
            --primary-color: #4CAF50;
            --background-light: #f5f7fa;
            --card-background: #ffffff;
            --text-color: #333;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --border-radius: 12px;
        }
        body { font-family: 'myfont2', Tahoma, sans-serif; background-color: var(--background-light); color: var(--text-color); margin: 0; padding: 24px; direction: rtl; }
        .container { max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column; gap: 32px; }
        .chart-container { position: relative; height: 400px; width: 100%; }
        .card { background: var(--card-background); padding: 24px; border-radius: var(--border-radius); box-shadow: var(--box-shadow); margin-bottom: 20px;}
        h2 { text-align: center; color: var(--primary-color); font-size: 1.4rem; margin-top: 0; font-family: 'myfont2'; line-height: 1.6; }
        .close-btn { background-color: #F44336; color: white; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-family: 'myfont2'; }
        .close-btn-container { position: fixed; top: 20px; left: 20px; z-index: 1000; }
        .s-access-info-container { position: fixed; top: 20px; right: 20px; z-index: 1000; }
        .s-access-count { background-color: #E8F5E9; color: #2E7D32; padding: 12px 18px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); font-weight: bold; border: 1px solid #C8E6C9; }
        @media (max-width: 768px) {
            .chart-container { height: 300px; }
            .s-access-info-container, .close-btn-container { position: static; margin-bottom: 10px; text-align: center; }
        }
    </style>
</head>
<body>

<div class="close-btn-container"><button class="close-btn" onclick="window.close()">بستن پنجره</button></div>
<div class="s-access-info-container"><div class="s-access-count">کارشناسان پهنه استان: <?php echo get_s_access_count_by_ostan($id_ostan1); ?> نفر</div></div>

<div class="container">
    <?php
    if (!empty($mah_qroup) && !empty($mah_name) && !empty($z_sal) && !empty($id_ostan1)) {
        $ostan_name = get_ostan_name($id_ostan1);
        $query = "
            SELECT 
                c.id_city, c.city,
                a.s_bar_abi, a.s_nobar_abi, a.s_bar_dem, a.s_nobar_dem,
                IFNULL(m.m_bar_abi, 0) as m_bar_abi, IFNULL(m.m_nobar_abi, 0) as m_nobar_abi,
                IFNULL(m.m_bar_dem, 0) as m_bar_dem, IFNULL(m.m_nobar_dem, 0) as m_nobar_dem,
                IFNULL(z.z_bar_abi, 0) as z_bar_abi, IFNULL(z.z_nobar_abi, 0) as z_nobar_abi,
                IFNULL(z.z_bar_dem, 0) as z_bar_dem, IFNULL(z.z_nobar_dem, 0) as z_nobar_dem
            FROM cityname c
            LEFT JOIN Garden_ab_city a ON c.id_city = a.id_city AND a.z_sal = :z_sal AND a.group_cod = :g AND a.product_cod = :p
            LEFT JOIN (
                SELECT id_city, 
                    SUM(s_bar_abi) as m_bar_abi, SUM(s_nobar_abi) as m_nobar_abi,
                    SUM(s_bar_dem) as m_bar_dem, SUM(s_nobar_dem) as m_nobar_dem
                FROM Garden_ab_mar WHERE z_sal = :z_sal AND group_cod = :g AND product_cod = :p GROUP BY id_city
            ) m ON c.id_city = m.id_city
            LEFT JOIN (
                SELECT id_city,
                    SUM(CASE WHEN no_kesh='1' THEN s_kesht_b ELSE 0 END) as z_bar_abi,
                    SUM(CASE WHEN no_kesh='1' THEN s_kesht_gb ELSE 0 END) as z_nobar_abi,
                    SUM(CASE WHEN no_kesh='2' THEN s_kesht_b ELSE 0 END) as z_bar_dem,
                    SUM(CASE WHEN no_kesh='2' THEN s_kesht_gb ELSE 0 END) as z_nobar_dem
                FROM Garden_prod WHERE z_sal = :z_sal AND cod_mah = :p GROUP BY id_city
            ) z ON c.id_city = z.id_city
            WHERE c.id_ostan = :id_ostan_target
            ORDER BY binary c.city ASC
        ";

        $params = array(':z_sal' => $z_sal, ':g' => $mah_qroup, ':p' => $mah_name, ':id_ostan_target' => $id_ostan1);
        $stmt = execute_prepared_statement($query, $params);
        
        if ($stmt && $stmt->rowCount() > 0) {
            $names = array(); $city_ids = array();
            $d = array('ba'=>array(),'na'=>array(),'ca'=>array(),'cna'=>array(),'za'=>array(),'zna'=>array(),'bd'=>array(),'nd'=>array(),'cd'=>array(),'cnd'=>array(),'zd'=>array(),'znd'=>array());
            $totals = array('ba'=>0,'na'=>0,'ca'=>0,'cna'=>0,'za'=>0,'zna'=>0,'bd'=>0,'nd'=>0,'cd'=>0,'cnd'=>0,'zd'=>0,'znd'=>0);

            while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $names[] = $r['city']; $city_ids[] = $r['id_city'];
                $map = array('ba'=>'s_bar_abi','na'=>'s_nobar_abi','ca'=>'m_bar_abi','cna'=>'m_nobar_abi','za'=>'z_bar_abi','zna'=>'z_nobar_abi','bd'=>'s_bar_dem','nd'=>'s_nobar_dem','cd'=>'m_bar_dem','cnd'=>'m_nobar_dem','zd'=>'z_bar_dem','znd'=>'z_nobar_dem');
                foreach($map as $k => $f) { $val = (float)$r[$f]; $d[$k][] = $val; $totals[$k] += $val; }
            }
            $base_title = " محصول " . $product_display_name . " - استان " . $ostan_name;
    ?>
    <div class="card"><h2>مقایسه سطح آبی (بارور) <?php echo $base_title; ?></h2><div class="chart-container"><canvas id="c1"></canvas></div></div>
    <div class="card"><h2>مقایسه سطح آبی (غیربارور) <?php echo $base_title; ?></h2><div class="chart-container"><canvas id="c2"></canvas></div></div>
    <div class="card"><h2>مقایسه سطح دیم (بارور) <?php echo $base_title; ?></h2><div class="chart-container"><canvas id="c3"></canvas></div></div>
    <div class="card"><h2>مقایسه سطح دیم (غیربارور) <?php echo $base_title; ?></h2><div class="chart-container"><canvas id="c4"></canvas></div></div>

    <script>
        var labels = <?php echo json_encode($names); ?>;
        var city_ids = <?php echo json_encode($city_ids); ?>;

        function create(id, sData, cData, zData, sT, cT, zT) {
            new Chart(document.getElementById(id), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        { label: 'ابلاغی شهرستان (' + sT.toLocaleString() + ')', data: sData, backgroundColor: 'rgba(54, 162, 235, 0.7)' },
                        { label: 'برش مراکز (' + cT.toLocaleString() + ')', data: cData, backgroundColor: 'rgba(255, 159, 64, 0.7)' },
                        { label: 'زیرکشت (' + zT.toLocaleString() + ')', data: zData, backgroundColor: 'rgba(75, 192, 192, 0.7)' }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    onClick: function(e, el) {
                        if (el.length > 0) {
                            var idx = el[0].index;
                            var form = document.createElement('form');
                            form.method = 'POST'; form.action = 'marakez_chart.php'; form.target = 'Sab_L3_popup';
                            var params = { id_ostan: '<?php echo $id_ostan1; ?>', id_city: city_ids[idx], z_sal: '<?php echo $z_sal; ?>', mah_qroup: '<?php echo $mah_qroup; ?>', mah_name: '<?php echo $mah_name; ?>' };
                            for (var k in params) {
                                var i = document.createElement('input'); i.type = 'hidden'; i.name = k; i.value = params[k]; form.appendChild(i);
                            }
                            window.open('about:blank', 'Sab_L3_popup', 'width=1000,height=800');
                            document.body.appendChild(form); form.submit(); document.body.removeChild(form);
                        }
                    },
                    plugins: { 
                        legend: { rtl: true, labels: { font: { family: 'myfont2', size: 12 } } },
                        tooltip: { bodyFont: { family: 'myfont2' }, titleFont: { family: 'myfont2' } }
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

        create('c1', <?php echo json_encode($d['ba']); ?>, <?php echo json_encode($d['ca']); ?>, <?php echo json_encode($d['za']); ?>, <?php echo $totals['ba']; ?>, <?php echo $totals['ca']; ?>, <?php echo $totals['za']; ?>);
        create('c2', <?php echo json_encode($d['na']); ?>, <?php echo json_encode($d['cna']); ?>, <?php echo json_encode($d['zna']); ?>, <?php echo $totals['na']; ?>, <?php echo $totals['cna']; ?>, <?php echo $totals['zna']; ?>);
        create('c3', <?php echo json_encode($d['bd']); ?>, <?php echo json_encode($d['cd']); ?>, <?php echo json_encode($d['zd']); ?>, <?php echo $totals['bd']; ?>, <?php echo $totals['cd']; ?>, <?php echo $totals['zd']; ?>);
        create('c4', <?php echo json_encode($d['nd']); ?>, <?php echo json_encode($d['cnd']); ?>, <?php echo json_encode($d['znd']); ?>, <?php echo $totals['nd']; ?>, <?php echo $totals['cnd']; ?>, <?php echo $totals['znd']; ?>);
    </script>
    <?php
        } else { echo '<div class="card" style="text-align:center;">اطلاعاتی یافت نشد.</div>'; }
    }
    ?>
</div>
</body>
</html>