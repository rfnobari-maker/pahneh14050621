<?php
// PHP 5.3.3 Compatibility Version
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once("../../login/config.php");

$z_sal = isset($_POST['z_sal']) ? htmlspecialchars($_POST['z_sal'], ENT_QUOTES) : '';
$mah_qroup = isset($_POST['mah_qroup']) ? htmlspecialchars($_POST['mah_qroup'], ENT_QUOTES) : '';
$mah_name = isset($_POST['mah_name']) ? htmlspecialchars($_POST['mah_name'], ENT_QUOTES) : '';

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

function get_s_access_count() {
    $dbh = get_db_connection();
    if (!$dbh) return '0';
    $query = "SELECT count(*) AS count FROM `users` WHERE `S_access` = '1'";
    $stmt = $dbh->query($query); 
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
    <title>نمودارهای آماری تفکیکی</title>
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
        
        /* بهینه‌سازی ظرف نمودار برای Responsive */
        .chart-container { 
            position: relative; 
            height: 400px; /* ارتفاع ثابت یا درصدی مناسب */
            width: 100%; 
        }
        
        .card { background: var(--card-background); padding: 24px; border-radius: var(--border-radius); box-shadow: var(--box-shadow); margin-bottom: 20px;}
        h2 { text-align: center; color: var(--primary-color); font-size: 1.4rem; margin-top: 0; font-family: 'myfont2'; line-height: 1.6; }
        .close-btn { background-color: #F44336; color: white; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-family: 'myfont2'; }
        
        /* استایل‌های ثابت برای دکمه‌ها */
        .close-btn-container { position: fixed; top: 20px; left: 20px; z-index: 1000; }
        .s-access-info-container { position: fixed; top: 20px; right: 20px; z-index: 1000; }
        .s-access-count { background-color: #E8F5E9; color: #2E7D32; padding: 12px 18px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); font-weight: bold; border: 1px solid #C8E6C9; }
        
        @media (max-width: 768px) {
            .chart-container { height: 300px; } /* ارتفاع کمتر در موبایل */
            .s-access-info-container, .close-btn-container { position: static; margin-bottom: 10px; text-align: center; }
        }
    </style>
</head>
<body>

<div class="close-btn-container"><button class="close-btn" onclick="window.close()">بستن پنجره</button></div>
<div class="s-access-info-container"><div class="s-access-count">کارشناسان پهنه کشور: <?php echo get_s_access_count(); ?> نفر</div></div>

<div class="container">
    <?php
    if (!empty($mah_qroup) && !empty($mah_name) && !empty($z_sal)) {
        $query = "
            SELECT 
                o.id_ostan, osn.ostan,
                o.s_bar_abi, o.s_nobar_abi, o.s_bar_dem, o.s_nobar_dem,
                IFNULL(c.c_bar_abi, 0) as c_bar_abi, IFNULL(c.c_nobar_abi, 0) as c_nobar_abi,
                IFNULL(c.c_bar_dem, 0) as c_bar_dem, IFNULL(c.c_nobar_dem, 0) as c_nobar_dem,
                IFNULL(z.z_bar_abi, 0) as z_bar_abi, IFNULL(z.z_nobar_abi, 0) as z_nobar_abi,
                IFNULL(z.z_bar_dem, 0) as z_bar_dem, IFNULL(z.z_nobar_dem, 0) as z_nobar_dem
            FROM Garden_ab_ostan o
            JOIN ostanname osn ON o.id_ostan = osn.id_ostan
            LEFT JOIN (
                SELECT id_ostan, 
                    SUM(s_bar_abi) as c_bar_abi, SUM(s_nobar_abi) as c_nobar_abi,
                    SUM(s_bar_dem) as c_bar_dem, SUM(s_nobar_dem) as c_nobar_dem
                FROM Garden_ab_city WHERE z_sal = :z_sal_c AND group_cod = :g_c AND product_cod = :p_c GROUP BY id_ostan
            ) c ON o.id_ostan = c.id_ostan
            LEFT JOIN (
                SELECT id_ostan,
                    SUM(CASE WHEN no_kesh='1' THEN s_kesht_b ELSE 0 END) as z_bar_abi,
                    SUM(CASE WHEN no_kesh='1' THEN s_kesht_gb ELSE 0 END) as z_nobar_abi,
                    SUM(CASE WHEN no_kesh='2' THEN s_kesht_b ELSE 0 END) as z_bar_dem,
                    SUM(CASE WHEN no_kesh='2' THEN s_kesht_gb ELSE 0 END) as z_nobar_dem
                FROM Garden_prod WHERE z_sal = :z_sal_z AND cod_mah = :p_z GROUP BY id_ostan
            ) z ON o.id_ostan = z.id_ostan
            WHERE o.z_sal = :z_sal_m AND o.group_cod = :g_m AND o.product_cod = :p_m
            ORDER BY FIELD(o.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')
        ";

        $params = array(
            ':z_sal_m' => $z_sal, ':g_m' => $mah_qroup, ':p_m' => $mah_name,
            ':z_sal_c' => $z_sal, ':g_c' => $mah_qroup, ':p_c' => $mah_name,
            ':z_sal_z' => $z_sal, ':p_z' => $mah_name
        );

        $stmt = execute_prepared_statement($query, $params);
        if ($stmt && $stmt->rowCount() > 0) {
            $names = array(); $p_ids = array();
            $d = array('ba'=>array(),'na'=>array(),'ca'=>array(),'cna'=>array(),'za'=>array(),'zna'=>array(),'bd'=>array(),'nd'=>array(),'cd'=>array(),'cnd'=>array(),'zd'=>array(),'znd'=>array());
            $totals = array('ba'=>0,'na'=>0,'ca'=>0,'cna'=>0,'za'=>0,'zna'=>0,'bd'=>0,'nd'=>0,'cd'=>0,'cnd'=>0,'zd'=>0,'znd'=>0);

            while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $names[] = $r['ostan']; $p_ids[] = $r['id_ostan'];
                $map = array('ba'=>'s_bar_abi','na'=>'s_nobar_abi','ca'=>'c_bar_abi','cna'=>'c_nobar_abi','za'=>'z_bar_abi','zna'=>'z_nobar_abi','bd'=>'s_bar_dem','nd'=>'s_nobar_dem','cd'=>'c_bar_dem','cnd'=>'c_nobar_dem','zd'=>'z_bar_dem','znd'=>'z_nobar_dem');
                foreach($map as $k => $f) { $val = (float)$r[$f]; $d[$k][] = $val; $totals[$k] += $val; }
            }
            
            $base_title = " محصول " . $product_display_name . " در سال " . $z_sal;
    ?>
    <div class="card"><h2>مقایسه سطح آبی (بارور) <?php echo $base_title; ?></h2><div class="chart-container"><canvas id="c1"></canvas></div></div>
    <div class="card"><h2>مقایسه سطح آبی (غیربارور) <?php echo $base_title; ?></h2><div class="chart-container"><canvas id="c2"></canvas></div></div>
    <div class="card"><h2>مقایسه سطح دیم (بارور) <?php echo $base_title; ?></h2><div class="chart-container"><canvas id="c3"></canvas></div></div>
    <div class="card"><h2>مقایسه سطح دیم (غیربارور) <?php echo $base_title; ?></h2><div class="chart-container"><canvas id="c4"></canvas></div></div>

    <script>
        var labels = <?php echo json_encode($names); ?>;
        var p_ids = <?php echo json_encode($p_ids); ?>;

        function create(id, sData, cData, zData, sT, cT, zT) {
            new Chart(document.getElementById(id), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        { label: 'ابلاغی (' + sT.toLocaleString() + ' هکتار)', data: sData, backgroundColor: 'rgba(54, 162, 235, 0.7)' },
                        { label: 'برش شهرستانی (' + cT.toLocaleString() + ' هکتار)', data: cData, backgroundColor: 'rgba(255, 159, 64, 0.7)' },
                        { label: 'زیرکشت (' + zT.toLocaleString() + ' هکتار)', data: zData, backgroundColor: 'rgba(75, 192, 192, 0.7)' }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // بسیار مهم برای تغییر سایز درست
                    resizeDelay: 200, // تاخیر اندک برای رندر بهتر هنگام درگ کردن پنجره
                    onClick: function(e, el) {
                        if (el.length > 0) {
                            var idx = el[0].index;
                            var form = document.createElement('form');
                            form.method = 'POST'; form.action = 'Sab_L2p_chart.php'; form.target = 'Sab_L2_popup';
                            var params = { id_ostan: p_ids[idx], z_sal: '<?php echo $z_sal; ?>', mah_qroup: '<?php echo $mah_qroup; ?>', mah_name: '<?php echo $mah_name; ?>' };
                            for (var k in params) {
                                var i = document.createElement('input'); i.type = 'hidden'; i.name = k; i.value = params[k]; form.appendChild(i);
                            }
                            window.open('about:blank', 'Sab_L2_popup', 'width=1100,height=800');
                            document.body.appendChild(form); form.submit(); document.body.removeChild(form);
                        }
                    },
                    plugins: { 
                        legend: { rtl: true, labels: { font: { family: 'myfont2', size: 12 } } },
                        tooltip: { 
                            bodyFont: { family: 'myfont2' }, 
                            titleFont: { family: 'myfont2' }, 
                            callbacks: { label: function(ctx) { return ctx.dataset.label.split(' (')[0] + ': ' + ctx.raw.toLocaleString() + ' هکتار'; } } 
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

        // فراخوانی توابع ساخت نمودار
        create('c1', <?php echo json_encode($d['ba']); ?>, <?php echo json_encode($d['ca']); ?>, <?php echo json_encode($d['za']); ?>, <?php echo $totals['ba']; ?>, <?php echo $totals['ca']; ?>, <?php echo $totals['za']; ?>);
        create('c2', <?php echo json_encode($d['na']); ?>, <?php echo json_encode($d['cna']); ?>, <?php echo json_encode($d['zna']); ?>, <?php echo $totals['na']; ?>, <?php echo $totals['cna']; ?>, <?php echo $totals['zna']; ?>);
        create('c3', <?php echo json_encode($d['bd']); ?>, <?php echo json_encode($d['cd']); ?>, <?php echo json_encode($d['zd']); ?>, <?php echo $totals['bd']; ?>, <?php echo $totals['cd']; ?>, <?php echo $totals['zd']; ?>);
        create('c4', <?php echo json_encode($d['nd']); ?>, <?php echo json_encode($d['cnd']); ?>, <?php echo json_encode($d['znd']); ?>, <?php echo $totals['nd']; ?>, <?php echo $totals['cnd']; ?>, <?php echo $totals['znd']; ?>);
    </script>
    <?php
        } else { echo '<div class="card" style="text-align:center; font-family:\'myfont2\'">اطلاعاتی یافت نشد.</div>'; }
    }
    ?>
</div>
</body>
</html>