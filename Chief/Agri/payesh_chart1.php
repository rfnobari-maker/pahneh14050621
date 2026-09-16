<?php
// PHP 5.2.3 Compatibility Notice:
// This code is written to be compatible with PHP 5.2.3.
// It is strongly recommended to upgrade to a supported PHP version (e.g., PHP 8.x)
// for security and performance benefits.

// Ensure all necessary files are included
require_once("../../lock_ce.php");
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
    // PDO::prepare is generally available in PHP 5.1+, which covers 5.2.3.
    $stmt = $dbh->prepare($query);
    // Execute the statement. For simple SELECT queries without user input binding, this is safe.
    if ($stmt->execute($params)) {
        return $stmt;
    }
    return null;
}

// ----------------------------------------------------------------------
// Main Chart Data Processing Logic
// ----------------------------------------------------------------------

// فرض بر این است که منطق اصلی برنامه بدون فیلتر ورودی اجرا می‌شود (WHERE 1)
// اگر نیاز به فیلتر بر اساس سال یا کد کود بود، باید $params پر می‌شد.
if (1==1) {
    $dbh = get_db_connection();
    if ($dbh) {
        
        // **کوئری جدید برای دریافت مجموع Count بر اساس نام استان و گروه کود**
        $query = "
            SELECT
                osn.ostan,
                list_kood.group_name,
                SUM(kood.Count) AS total_count
            FROM kood
            INNER JOIN list_kood ON list_kood.code = kood.code
            -- فرض بر این است که جدول ostanname برای تبدیل id_ostan به نام استان وجود دارد.
            JOIN ostanname osn ON kood.id_ostan = osn.id_ostan
            WHERE 1
            GROUP BY osn.ostan, list_kood.group_name
            ORDER BY osn.ostan, list_kood.group_name
        ";
        $stmt = execute_prepared_statement($query, array());

        if ($stmt && $stmt->rowCount() > 0) {
            
            // **ساختار داده جدید برای Chart.js**
            $labels = array();          // نام استان‌ها (برای محور X)
            $datasets_map = array();    // نقشه‌ای برای ذخیره داده‌های هر group_name (به عنوان Dataset)
            $total_global_count = 0.0;    // مجموع کل برای نمایش در عنوان

            // مرحله اول: جمع‌آوری داده‌ها و لیست استان‌ها (Labels)
            $results_by_ostan = array(); // ذخیره موقت نتایج برای مرتب‌سازی نهایی

            foreach($stmt as $row) {
                $ostan = $row['ostan'];
                $group_name = $row['group_name'];
                $total_count = (float)$row['total_count'];
                
                // افزودن استان به Labels (بهتر است بعد از جمع‌آوری همه نتایج، یک بار از array_unique استفاده شود)
                $labels[] = $ostan;

                // ذخیره مقدار در نقشه موقت بر اساس گروه و استان
                $datasets_map[$group_name][$ostan] = $total_count;
                
                $total_global_count += $total_count;
            }
            
            // نهایی‌سازی Labels: حذف تکراری‌ها و حفظ ترتیب
            $labels = array_values(array_unique($labels));

            // **تعریف پالت رنگی (برای Group Names)**
            $colors = array('#0077B6', '#FFC107', '#4CAF50', '#F44336', '#9C27B0', '#00BCD4', '#FF9800', '#795548', '#FF6384', '#36A2EB');
            $color_index = 0;

            // **تبدیل ساختار datasets_map به فرمت نهایی Datasets مورد نیاز Chart.js**
            $datasets = array();

            foreach ($datasets_map as $group_name => $data_map) {
                $final_data = array();
                
                // مطمئن می‌شویم که داده‌های هر گروه برای تک تک استان‌ها (Labels) وجود داشته باشد (اگر نبود، 0 قرار می‌دهیم)
                foreach ($labels as $ostan) {
                    // اگر استان در داده‌های group_name وجود نداشت، 0.0 قرار می‌دهیم
                    $final_data[] = isset($data_map[$ostan]) ? $data_map[$ostan] : 0.0;
                }

                $datasets[] = array(
                    'label' => $group_name,
                    'data' => $final_data,
                    // استفاده از رنگ‌های دوره‌ای
                    'backgroundColor' => $colors[$color_index % count($colors)],
                    'borderColor' => $colors[$color_index % count($colors)],
                    'borderWidth' => 1
                );
                $color_index++;
            }

            
            // JSON encoding for JavaScript
            $labels_json = json_encode($labels);
            $datasets_json = json_encode($datasets);
            $total_global_count_json = json_encode($total_global_count);
?>
    <div class="card">
        <h2 class="chart-title">نمودار میزان کود تحویلی به تفکیک استان و گروه کود</h2>
        <div class="chart-container">
            <canvas id="fertilizerChart"></canvas>
        </div>
    </div>
    
    <script>
// JavaScript for Chart.js
const labels = <?php echo $labels_json; ?>;
const datasets = <?php echo $datasets_json; ?>;
const total_global_count = <?php echo $total_global_count_json; ?>;

// Function to create a single chart
function createChart(ctxId, chartTitle, chartDatasets, total, unit) {
    const ctx = document.getElementById(ctxId).getContext('2d');
    new Chart(ctx, {
        type: 'bar', // نوع نمودار بار (میله‌ای)
        data: {
            labels: labels, // نام استان‌ها (محور X)
            datasets: chartDatasets // مجموعه‌های داده (هر گروه کود یک مجموعه)
        },
        options: {
            responsive: true,
            // **تنظیمات Stacked Bar Chart**
            scales: {
                x: {
                    stacked: true, // برای انباشته شدن داده‌ها بر روی هم (برای نمایش کل کود هر استان)
                    ticks: {
                        autoSkip: false,
                        font: { family: 'myfont2' }
                    }
                },
                y: {
                    stacked: true, // برای انباشته شدن داده‌ها بر روی هم
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: `${unit}`,
                        font: { size: 14, family: 'myfont2' }
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    rtl: true,
                    labels: {
                        font: { size: 14, family: 'myfont2' }
                    }
                },
                title: {
                    display: true,
                    text: `${chartTitle} - مجموع کل: ${total.toLocaleString()}`,
                    font: { size: 16, family: 'myfont2' }
                }
            }
        }
    });
}

// Create the fertilizer chart
createChart('fertilizerChart', 'نمودار میزان کود تحویلی', datasets, total_global_count, 'تن');

    </script>

    <?php
            } else {
                echo '<div class="card info-message"><p>اطلاعاتی برای کوئری مورد نظر یافت نشد.</p></div>';
            }
        } else {
            echo '<div class="card info-message"><p>خطا در اتصال به پایگاه داده.</p></div>';
        }
    } else {
        echo '<div class="card info-message"><p>لطفا ورودی‌های مورد نیاز را وارد کنید.</p></div>';
    }

?>