<?php
// این کد برای سازگاری با PHP 5.3.2 بازنویسی شده است.
// توجه: برای امنیت و عملکرد بهتر، توصیه می‌شود از نسخه‌های جدیدتر PHP استفاده کنید.

// اطمینان از اینکه تمامی فایل‌های مورد نیاز گنجانده شده‌اند
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once("../../login/config.php");

// تصفیه ورودی‌های کاربر برای جلوگیری از حملات XSS.
// با توجه به عدم وجود filter_input() در PHP 5.3.2، از htmlspecialchars() استفاده می‌شود.
$z_sal = isset($_POST['z_sal']) ? htmlspecialchars($_POST['z_sal'], ENT_QUOTES, 'UTF-8') : '';
$mah_qroup = isset($_POST['mah_qroup']) ? htmlspecialchars($_POST['mah_qroup'], ENT_QUOTES, 'UTF-8') : '';

// تابع برای مدیریت اتصال به پایگاه داده
function get_db_connection() {
    global $dbh;
    if (!$dbh) {
        // در صورت نیاز، خطای اتصال به پایگاه داده را مدیریت کنید
        return null;
    }
    return $dbh;
}

// تابع برای اجرای امن یک عبارت آماده
function execute_prepared_statement($query, $params = array()) {
    $dbh = get_db_connection();
    if (!$dbh) {
        return null;
    }
    $stmt = $dbh->prepare($query);
    // استفاده از bindValue برای سازگاری بهتر با نسخه‌های قدیمی PDO
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    return $stmt;
}

// تابع برای دریافت نام گروه محصولات از کد آن
function get_group_name($group_cod) {
    $dbh = get_db_connection();
    if (!$dbh) {
        return 'ناشناخته';
    }
    $query = "SELECT group_name FROM `product_z` WHERE group_cod = :group_cod LIMIT 1";
    $stmt = execute_prepared_statement($query, array(':group_cod' => $group_cod));
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    return $row ? $row['group_name'] : 'ناشناخته';
}

// تابع برای دریافت تعداد کارشناسان پهنه (S_access = 1)
function get_s_access_count() {
    $dbh = get_db_connection();
    if (!$dbh) {
        return 'N/A';
    }
    // کوئری مورد نظر شما
    $query = "SELECT count(*) AS count FROM `users` WHERE `S_access` = '1'";
    $stmt = execute_prepared_statement($query);
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
    <title>نمودارهای آماری - گروه محصولات</title>
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
        
        /* کانتینر برای دکمه (سمت چپ) */
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
        
        /* استایل نمایش تعداد کارشناسان */
        .s-access-count {
       /* رنگ پس‌زمینه جدید - سبز روشن */
        background-color: #E8F5E9; 
        /* رنگ متن */
        color: #2E7D32; 
        
        padding: 12px 18px; /* افزایش Padding برای جلوه بهتر */
        border-radius: 8px; /* گردتر شدن لبه‌ها */
        /* اضافه کردن سایه بیشتر برای برجسته‌سازی */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
        
        font-size: 1rem;
        border: 1px solid #C8E6C9; /* اضافه کردن حاشیه سبز کم‌رنگ */
        direction: rtl; 
        font-weight: bold;
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
// دریافت تعداد کارشناسان
$s_access_count = get_s_access_count();
?>

<div class="close-btn-container">
    <button class="close-btn" onclick="window.close()">بستن پنجره</button>
</div>

<div class="s-access-info-container">
    <div class="s-access-count">
        کارشناسان پهنه کشور:<?php echo htmlspecialchars($s_access_count, ENT_QUOTES, 'UTF-8'); ?> نفر
    </div>
</div>

<div class="container">
    <?php
    // بررسی اینکه آیا متغیرهای ورودی مورد نیاز تنظیم شده‌اند
    if (!empty($mah_qroup) && !empty($z_sal)) {
        $dbh = get_db_connection();
        if ($dbh) {
            $group_name = get_group_name($mah_qroup);

            // کوئری برای دریافت داده‌های تجمیعی بر اساس گروه محصولات
            $query = "
                SELECT
                    o.id_ostan,
                    osn.ostan,
                    SUM(o.s_dem) AS s_dem,
                    SUM(o.s_abi) AS s_abi,
                    IFNULL(c.total_city_dem,0) AS total_city_dem,
                    IFNULL(c.total_city_abi,0) AS total_city_abi
                FROM Agri_ab_ostan o
                JOIN ostanname osn ON o.id_ostan = osn.id_ostan
                LEFT JOIN (
                    SELECT
                        id_ostan,
                        SUM(s_dem) AS total_city_dem,
                        SUM(s_abi) AS total_city_abi
                    FROM Agri_ab_city
                    WHERE z_sal = :z_sal
                    AND group_cod = :mah_qroup
                    GROUP BY id_ostan
                ) c
                   ON o.id_ostan = c.id_ostan
                WHERE o.z_sal = :z_sal
                  AND o.group_cod = :mah_qroup
                GROUP BY o.id_ostan, osn.ostan
                ORDER BY FIELD(o.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')
            ";
            $stmt = execute_prepared_statement($query, array(
                ':z_sal'     => $z_sal,
                ':mah_qroup' => $mah_qroup
            ));

            if ($stmt && $stmt->rowCount() > 0) {
                $province_names = array();
                $s_dem_data = array();
                $total_city_dem_data = array();
                $s_abi_data = array();
                $total_city_abi_data = array();

                $total_s_abi = 0;
                $total_city_abi = 0;
                $total_s_dem = 0;
                $total_city_dem = 0;

                foreach($stmt as $row) {
                    $province_names[] = $row['ostan'];
                    $s_dem = (float)$row['s_dem'];
                    $s_abi = (float)$row['s_abi'];
                    $total_city_dem_from_row = (float)$row['total_city_dem'];
                    $total_city_abi_from_row = (float)$row['total_city_abi'];
                    
                    $s_dem_data[] = $s_dem;
                    $total_city_dem_data[] = $total_city_dem_from_row;
                    $s_abi_data[] = $s_abi;
                    $total_city_abi_data[] = $total_city_abi_from_row;

                    $total_s_abi += $s_abi;
                    $total_city_abi += $total_city_abi_from_row;
                    $total_s_dem += $s_dem;
                    $total_city_dem += $total_city_dem_from_row;
                }
                
                // تبدیل داده‌ها به فرمت JSON برای استفاده در جاوااسکریپت
                $province_names_json = json_encode($province_names);
                $s_dem_data_json = json_encode($s_dem_data);
                $total_city_dem_data_json = json_encode($total_city_dem_data);
                $s_abi_data_json = json_encode($s_abi_data);
                $total_city_abi_data_json = json_encode($total_city_abi_data);
                
                // مقادیر کل
                $total_s_abi_json = json_encode($total_s_abi);
                $total_city_abi_json = json_encode($total_city_abi);
                $total_s_dem_json = json_encode($total_s_dem);
                $total_city_dem_json = json_encode($total_city_dem);
    ?>
    <div class="card">
        <h2 class="chart-title">نمودار مقایسه ای سطح (آبی) گروه محصولات <?php echo htmlspecialchars($group_name, ENT_QUOTES, 'UTF-8'); ?></h2>
        <div class="chart-container">
            <canvas id="abiChart"></canvas>
        </div>
    </div>

    <div class="card">
        <h2 class="chart-title">نمودار مقایسه ای سطح (دیم) گروه محصولات <?php echo htmlspecialchars($group_name, ENT_QUOTES, 'UTF-8'); ?></h2>
        <div class="chart-container">
            <canvas id="demChart"></canvas>
        </div>
    </div>

    <script>
        // کدهای جاوااسکریپت برای Chart.js
        const labels = <?php echo $province_names_json; ?>;
        const s_dem_data = <?php echo $s_dem_data_json; ?>;
        const total_city_dem_data = <?php echo $total_city_dem_data_json; ?>;
        const s_abi_data = <?php echo $s_abi_data_json; ?>;
        const total_city_abi_data = <?php echo $total_city_abi_data_json; ?>;
        
        const total_s_abi = <?php echo $total_s_abi_json; ?>;
        const total_city_abi = <?php echo $total_city_abi_json; ?>;
        const total_s_dem = <?php echo $total_s_dem_json; ?>;
        const total_city_dem = <?php echo $total_city_dem_json; ?>;

        // تابع برای ایجاد نمودار
        function createChart(ctxId, chartLabel, sData, cityData, sTotal, cityTotal) {
            const ctx = document.getElementById(ctxId).getContext('2d');
            
            // رنگ‌های گرادیانت
            let s_color_gradient, city_color_gradient;
            if (ctxId === 'abiChart') {
                s_color_gradient = ctx.createLinearGradient(0, 0, 0, 400);
                s_color_gradient.addColorStop(0, '#2196F3');
                s_color_gradient.addColorStop(1, '#42A5F5');
                
                city_color_gradient = ctx.createLinearGradient(0, 0, 0, 400);
                city_color_gradient.addColorStop(0, '#FFA726');
                city_color_gradient.addColorStop(1, '#FFCA28');
            } else {
                s_color_gradient = ctx.createLinearGradient(0, 0, 0, 400);
                s_color_gradient.addColorStop(0, '#4CAF50');
                s_color_gradient.addColorStop(1, '#66BB6A');
                
                city_color_gradient = ctx.createLinearGradient(0, 0, 0, 400);
                city_color_gradient.addColorStop(0, '#FF5722');
                city_color_gradient.addColorStop(1, '#FF8A65');
            }

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: `سطح ابلاغی استان (${chartLabel})`,
                        data: sData,
                        backgroundColor: s_color_gradient,
                        borderColor: 'rgba(255, 255, 255, 0.5)',
                        borderWidth: 1,
                        borderRadius: 8,
                        borderSkipped: false
                    }, {
                        label: `مجموع برش شهرستانی (${chartLabel})`,
                        data: cityData,
                        backgroundColor: city_color_gradient,
                        borderColor: 'rgba(255, 255, 255, 0.5)',
                        borderWidth: 1,
                        borderRadius: 8,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuart'
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
                                },
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        title: {
                            display: true,
                            text: `مقایسه سطح ${chartLabel} ابلاغی (مجموع: ${sTotal.toLocaleString()}) با برش شهرستانی (مجموع: ${cityTotal.toLocaleString()})`,
                            font: {
                                size: 16,
                                family: 'Vazirmatn'
                            },
                            color: '#444'
                        },
                        tooltip: {
                            rtl: true,
                            bodyFont: { family: 'Vazirmatn' },
                            titleFont: { family: 'Vazirmatn' },
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('fa-IR').format(context.parsed.y) + ' هکتار';
                                    }
                                    return label;
                                }
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
                            },
                            grid: {
                                color: '#e0e0e0'
                            }
                        },
                        x: {
                            ticks: {
                                autoSkip: false,
                                font: {
                                    family: 'Vazirmatn'
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // ایجاد نمودارها
        createChart('abiChart', 'آبی', s_abi_data, total_city_abi_data, total_s_abi, total_city_abi);
        createChart('demChart', 'دیم', s_dem_data, total_city_dem_data, total_s_dem, total_city_dem);

    </script>

    <?php
            } else {
                echo '<div class="card info-message"><p>اطلاعاتی برای گروه محصولات و سال زراعی مورد نظر یافت نشد.</p></div>';
            }
        } else {
            echo '<div class="card info-message"><p>خطا در اتصال به پایگاه داده.</p></div>';
        }
    } else {
        echo '<div class="card info-message"><p>لطفا اطلاعات مورد نیاز را از صفحه اصلی وارد کنید.</p></div>';
    }
    ?>
</div>

</body>
</html>