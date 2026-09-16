<?php
/**
 * تغییر خودکار نام آبادی‌ها - نسخه یکبار مصرف
 * کدها مستقیماً در آرایه تعریف شده‌اند
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time', 600);
ini_set('memory_limit', '512M');

// ============================================
// اتصال به دیتابیس
// ============================================
include('login/config.php');
include('event.php');

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ============================================
// لیست تمام جدول‌ها
// ============================================
$tables = array(
    'Agri1397_1398', 'Agri1398_1399', 'Agri1399_1400', 'Agri1400_1401', 
    'Agri1401_1402', 'Agri1402_1403', 'Agri1403_1404', 'Agri1404_1405', 'Agri1405_1406',
    'Agri_prod1397_1398', 'Agri_prod1398_1399', 'Agri_prod1399_1400', 
    'Agri_prod1400_1401', 'Agri_prod1401_1402', 'Agri_prod1402_1403', 
    'Agri_prod1403_1404', 'Agri_prod1404_1405', 'Agri_prod1405_1406',
    'bah', 'bee', 'Aquatic', 'Aquatic2', 'Eworker', 'Garden', 'Garden_prod', 
    'Greenhous', 'Greenprod_annual', 'Greenhous_prod', 'Mushroom', 'Mushroom_prod', 
    'Vege', 'Vege_prod'
);

// ============================================
// داده‌های تغییرات (کد قدیم => کد جدید)
// ============================================
$changes = array(

    '175033' => '175029',   // شرکت زاینده رود → روران
    '480145' => '231179',   // اشکالی سیدی → اشکالی محمدحاجی
    '231178' => '231179',   // اشکالی عوض حسین → اشکالی محمدحاجی
    '231176' => '231179',   // اشکالی زایرحسین → اشکالی محمدحاجی
    '342425' => '044994',   // تاسیسات اداره راه → مایین بلاغ
    '006365' => '825010',   // فرودگاه کوشک نصرت → پایگاه آموزش خلبانی شهید اکبری
    '534480' => '825010',   // میدان تیر کوشک → پایگاه آموزش خلبانی شهید اکبری
    '534440' => '535669',   // دامداری خسروی → شهرک صنعتی محمودآباد
    '825019' => '825018'    // باطری سازی پارسیان پارت پاسارگاد → پهنه صنعتی نیزار
);

// ============================================
// توابع کمکی
// ============================================

/**
 * نرمال‌سازی کد به ۶ رقم (اضافه کردن صفر به چپ)
 */
function normalizeCode($code) {
    $code = trim($code);
    if (empty($code)) return false;
    $code = preg_replace('/[^0-9]/', '', $code);
    if (empty($code)) return false;
    return str_pad($code, 6, '0', STR_PAD_LEFT);
}

/**
 * جستجوی آبادی بر اساس کد
 * @param string $code کد آبادی
 * @param object $dbh اتصال دیتابیس
 * @param string $type نوع جستجو: 'old' برای list_abadi، 'new' برای public_abadi4
 * @return array|null آرایه شامل add_abadi و abadi یا null در صورت عدم پیدا شدن
 */
function findAbadi($code, $dbh, $type = 'old') {
    $code = normalizeCode($code);
    if (!$code) return null;
    
    // تعیین جدول مقصد
    $table = ($type === 'new') ? 'public_abadi4' : 'list_abadi';
    
    $search = '%' . $code;
    $query = "SELECT add_abadi, abadi FROM $table WHERE add_abadi LIKE ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($search));
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($results) == 0) {
        $query2 = "SELECT add_abadi, abadi FROM $table WHERE SUBSTRING(add_abadi, -6) = ?";
        $stmt2 = $dbh->prepare($query2);
        $stmt2->execute(array($code));
        $results = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    }
    
    if (count($results) >= 1) {
        return array(
            'add_abadi' => $results[0]['add_abadi'],
            'abadi' => $results[0]['abadi']
        );
    }
    
    return null;
}

/**
 * ایجاد جدول بکاپ
 */
function ensureBackupTable($dbh) {
    $check_query = "SHOW TABLES LIKE 'list_abadi_del'";
    $check_stmt = $dbh->prepare($check_query);
    $check_stmt->execute();
    
    if ($check_stmt->rowCount() == 0) {
        $create_query = "CREATE TABLE list_abadi_del LIKE list_abadi";
        $dbh->exec($create_query);
    }
}

/**
 * بکاپ از رکورد قدیم
 */
function backupRecord($old_add_abadi, $dbh) {
    $select_query = "SELECT * FROM list_abadi WHERE add_abadi = ?";
    $select_stmt = $dbh->prepare($select_query);
    $select_stmt->execute(array($old_add_abadi));
    $old_record = $select_stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$old_record) return false;
    
    $fields = array_keys($old_record);
    $field_list = implode(', ', $fields);
    $placeholders = implode(', ', array_fill(0, count($fields), '?'));
    
    $insert_query = "INSERT INTO list_abadi_del ($field_list) VALUES ($placeholders)";
    $insert_stmt = $dbh->prepare($insert_query);
    $insert_stmt->execute(array_values($old_record));
    
    return true;
}

/**
 * به‌روزرسانی یک جفت آبادی
 */
function updateAbadi($old_code, $new_code, $dbh, $tables, &$log) {
    $old_code = normalizeCode($old_code);
    $new_code = normalizeCode($new_code);
    
    if (!$old_code || !$new_code) {
        $log[] = "❌ کد نامعتبر";
        return false;
    }
    
    if ($old_code == $new_code) {
        $log[] = "⏭️ کدها یکسان هستند - نادیده گرفته شد";
        return true;
    }
    
    // جستجوی کد قدیم از list_abadi
    $old_result = findAbadi($old_code, $dbh, 'old');
    // جستجوی کد جدید از public_abadi4
    $new_result = findAbadi($new_code, $dbh, 'new');
    
    if (!$old_result) {
        $log[] = "❌ آبادی با کد $old_code در list_abadi یافت نشد";
        return false;
    }
    
    if (!$new_result) {
        $log[] = "❌ آبادی با کد $new_code در public_abadi4 یافت نشد";
        return false;
    }
    
    $old_add_abadi = $old_result['add_abadi'];
    $new_add_abadi = $new_result['add_abadi'];
    
    if ($old_add_abadi == $new_add_abadi) {
        $log[] = "⏭️ نام آبادی‌ها یکسان است - نادیده گرفته شد";
        return true;
    }
    
    try {
        $dbh->beginTransaction();
        
        // 1. بکاپ
        ensureBackupTable($dbh);
        backupRecord($old_add_abadi, $dbh);
        
        // 2. به‌روزرسانی جدول‌ها
        $updated_count = 0;
        foreach ($tables as $table) {
            $check_query = "SHOW TABLES LIKE ?";
            $check_stmt = $dbh->prepare($check_query);
            $check_stmt->execute(array($table));
            
            if ($check_stmt->rowCount() == 0) continue;
            
            $query = "UPDATE `$table` SET add_abadi = ? WHERE add_abadi = ?";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array($new_add_abadi, $old_add_abadi));
            
            if ($stmt->rowCount() > 0) {
                $updated_count++;
            }
        }
        
        // 3. حذف از list_abadi
        $delete_query = "DELETE FROM list_abadi WHERE add_abadi = ?";
        $delete_stmt = $dbh->prepare($delete_query);
        $delete_stmt->execute(array($old_add_abadi));
        
        $dbh->commit();
        
        $log[] = "✅ $old_add_abadi ({$old_result['abadi']}) → $new_add_abadi ({$new_result['abadi']}) ($updated_count جدول)";
        return true;
        
    } catch (Exception $e) {
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
        }
        $log[] = "❌ خطا: " . $e->getMessage();
        return false;
    }
}

// ============================================
// نمایش پیام‌ها
// ============================================
function showMessage($message, $type = 'info') {
    $class = 'info-box';
    if ($type == 'warning') $class .= ' warning';
    elseif ($type == 'success') $class .= ' success';
    elseif ($type == 'error') $class .= ' error';
    echo "<div class='$class'>$message</div>";
}
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <title>تغییر خودکار نام آبادی</title>
    <style>
        body { font-family: Tahoma, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 950px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .info-box { padding: 15px; border-right: 4px solid #2196F3; margin: 20px 0; background: #e7f3ff; }
        .warning { background: #fff3cd; border-right-color: #ffc107; }
        .success { background: #d4edda; border-right-color: #28a745; }
        .error { background: #f8d7da; border-right-color: #dc3545; }
        .btn { display: inline-block; padding: 12px 30px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; text-decoration: none; }
        .btn:hover { background: #45a049; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .btn-primary { background: #2196F3; }
        .btn-primary:hover { background: #0b7dda; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 13px; }
        td, th { padding: 8px; border: 1px solid #ddd; text-align: right; }
        th { background: #f2f2f2; }
        .summary { background: #e8f5e9; padding: 15px; border-radius: 4px; margin: 15px 0; }
        .log-box { max-height: 500px; overflow-y: auto; font-size: 13px; }
        .log-item { padding: 5px 10px; margin: 3px 0; border-radius: 3px; }
        .log-success { background: #d4edda; border-right: 3px solid #28a745; }
        .log-error { background: #f8d7da; border-right: 3px solid #dc3545; }
        .log-warning { background: #fff3cd; border-right: 3px solid #ffc107; }
        .log-info { background: #e7f3ff; border-right: 3px solid #2196F3; }
        .badge { display: inline-block; padding: 2px 10px; border-radius: 12px; font-size: 12px; }
        .badge-success { background: #28a745; color: white; }
        .badge-danger { background: #dc3545; color: white; }
        .badge-warning { background: #ffc107; color: #333; }
        .progress-bar { background: #e0e0e0; border-radius: 4px; overflow: hidden; height: 30px; margin: 15px 0; }
        .progress-fill { background: #4CAF50; height: 100%; transition: width 0.5s; color: white; text-align: center; line-height: 30px; font-size: 13px; }
    </style>
</head>
<body>
<div class="container">
    <h2>🤖 تغییر خودکار نام آبادی‌ها</h2>
    
    <?php
    // ============================================
    // پردازش درخواست‌ها
    // ============================================
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        $action = $_POST['action'];
        
        // ============================================
        // مرحله 1: پیش‌نمایش
        // ============================================
        if ($action === 'preview') {
            echo "<h3>📋 پیش‌نمایش تغییرات</h3>";
            echo "<p><strong>تعداد کل تغییرات:</strong> " . count($changes) . "</p>";
            
            // نمایش جدول
            echo "<table>";
            echo "<tr><th>#</th><th>کد قدیم</th><th>نام قدیم</th><th>کد جدید</th><th>نام جدید</th><th>وضعیت</th></tr>";
            
            $valid_count = 0;
            $invalid_count = 0;
            $skip_count = 0;
            $i = 0;
            
            foreach ($changes as $old_code => $new_code) {
                $i++;
                $old_code_norm = normalizeCode($old_code);
                $new_code_norm = normalizeCode($new_code);
                
                // جستجوی کد قدیم از list_abadi
                $old_result = findAbadi($old_code, $dbh, 'old');
                // جستجوی کد جدید از public_abadi4
                $new_result = findAbadi($new_code, $dbh, 'new');
                
                $status = '';
                $badge_class = '';
                
                if ($old_code_norm == $new_code_norm) {
                    $status = '⏭️ کد یکسان';
                    $badge_class = 'badge-warning';
                    $skip_count++;
                } elseif (!$old_result) {
                    $status = '❌ کد قدیم یافت نشد';
                    $badge_class = 'badge-danger';
                    $invalid_count++;
                } elseif (!$new_result) {
                    $status = '❌ کد جدید یافت نشد';
                    $badge_class = 'badge-danger';
                    $invalid_count++;
                } else {
                    $status = '✅ معتبر';
                    $badge_class = 'badge-success';
                    $valid_count++;
                }
                
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td><code>$old_code_norm</code></td>";
                echo "<td>" . ($old_result ? htmlspecialchars($old_result['abadi'], ENT_QUOTES, 'UTF-8') . ' <small>(' . htmlspecialchars($old_result['add_abadi'], ENT_QUOTES, 'UTF-8') . ')</small>' : '⚠️ یافت نشد') . "</td>";
                echo "<td><code>$new_code_norm</code></td>";
                echo "<td>" . ($new_result ? htmlspecialchars($new_result['abadi'], ENT_QUOTES, 'UTF-8') . ' <small>(' . htmlspecialchars($new_result['add_abadi'], ENT_QUOTES, 'UTF-8') . ')</small>' : '⚠️ یافت نشد') . "</td>";
                echo "<td><span class='badge $badge_class'>$status</span></td>";
                echo "</tr>";
            }
            echo "</table>";
            
            // خلاصه
            echo "<div class='summary'>";
            echo "<h4>📊 خلاصه:</h4>";
            echo "<ul>";
            echo "<li>✅ معتبر: <strong>$valid_count</strong> رکورد</li>";
            echo "<li>❌ نامعتبر: <strong>$invalid_count</strong> رکورد</li>";
            echo "<li>⏭️ یکسان: <strong>$skip_count</strong> رکورد</li>";
            echo "<li>📊 مجموع: <strong>" . count($changes) . "</strong> رکورد</li>";
            echo "</ul>";
            echo "</div>";
            
            // دکمه اجرا
            if ($valid_count > 0) {
                echo "<form method='post'>";
                echo "<input type='hidden' name='action' value='execute'>";
                echo "<button type='submit' class='btn' onclick='return confirm(\"آیا از انجام عملیات برای $valid_count رکورد مطمئن هستید؟\\nاین عملیات غیرقابل بازگشت است!\");'>";
                echo "🚀 اجرای عملیات برای $valid_count رکورد";
                echo "</button>";
                echo "</form>";
            }
            
            echo '<br><a href="' . $_SERVER['PHP_SELF'] . '" class="btn btn-primary">↩ بازگشت</a>';
        }
        
        // ============================================
        // مرحله 2: اجرای عملیات
        // ============================================
        elseif ($action === 'execute') {
            echo "<h3>🔄 در حال اجرای عملیات...</h3>";
            echo "<div class='progress-bar'>";
            echo "<div class='progress-fill' id='progress' style='width: 0%'>0%</div>";
            echo "</div>";
            
            echo "<div class='log-box' id='logBox'>";
            
            $success = 0;
            $failed = 0;
            $skipped = 0;
            
            // جمع‌آوری رکوردهای معتبر
            $valid_items = array();
            foreach ($changes as $old_code => $new_code) {
                $old_result = findAbadi($old_code, $dbh, 'old');
                $new_result = findAbadi($new_code, $dbh, 'new');
                if ($old_result && $new_result && normalizeCode($old_code) != normalizeCode($new_code)) {
                    $valid_items[] = array('old' => $old_code, 'new' => $new_code);
                }
            }
            
            $total_valid = count($valid_items);
            $processed = 0;
            
            // اجرای عملیات برای هر رکورد
            foreach ($valid_items as $item) {
                $processed++;
                $old_code = $item['old'];
                $new_code = $item['new'];
                
                // نمایش پیشرفت
                $percent = round(($processed / $total_valid) * 100);
                echo "<script>document.getElementById('progress').style.width = '{$percent}%'; document.getElementById('progress').textContent = '{$percent}% ({$processed}/{$total_valid})';</script>";
                flush();
                ob_flush();
                
                $log_messages = array();
                $result = updateAbadi($old_code, $new_code, $dbh, $tables, $log_messages);
                
                if ($result) {
                    $success++;
                } else {
                    $failed++;
                }
                
                foreach ($log_messages as $log) {
                    $class = 'log-info';
                    if (strpos($log, '✅') !== false) $class = 'log-success';
                    elseif (strpos($log, '❌') !== false) $class = 'log-error';
                    elseif (strpos($log, '⚠️') !== false || strpos($log, '⏭️') !== false) $class = 'log-warning';
                    echo "<div class='log-item $class'>$log</div>";
                    flush();
                    ob_flush();
                }
            }
            
            echo "</div>";
            
            // گزارش نهایی
            echo "<div class='summary'>";
            echo "<h3>📊 گزارش نهایی عملیات</h3>";
            echo "<ul>";
            echo "<li>✅ <strong>موفق:</strong> $success رکورد</li>";
            echo "<li>❌ <strong>ناموفق:</strong> $failed رکورد</li>";
            echo "<li>⏭️ <strong>نادیده گرفته شده:</strong> " . (count($changes) - $total_valid) . " رکورد</li>";
            echo "<li>📊 <strong>مجموع پردازش:</strong> $total_valid رکورد</li>";
            echo "</ul>";
            echo "</div>";
            
            echo '<br><a href="' . $_SERVER['PHP_SELF'] . '" class="btn btn-primary">↩ بازگشت به صفحه اصلی</a>';
        }
        
    } else {
        // ============================================
        // صفحه اصلی
        // ============================================
        ?>
        
        <div class="info-box">
            <h4>📖 راهنمای استفاده</h4>
            <p>این ابزار به‌صورت خودکار کدهای آبادی را بر اساس لیست تعریف شده تغییر می‌دهد.</p>
            <ul>
                <li><strong>تعداد تغییرات:</strong> <?php echo count($changes); ?> رکورد</li>
                <li><strong>کدهای کمتر از ۶ رقم:</strong> به‌طور خودکار با صفر به چپ تکمیل می‌شوند</li>
                <li><strong>منبع کدهای جدید:</strong> جدول public_abadi4</li>
                <li><strong>منبع کدهای قدیم:</strong> جدول list_abadi</li>
            </ul>
            <div class="warning" style="margin-top: 10px;">
                <strong>⚠️ هشدار مهم:</strong> قبل از اجرا، حتماً از پایگاه داده بکاپ تهیه کنید!
            </div>
        </div>
        
        <form method='post'>
            <input type='hidden' name='action' value='preview'>
            <button type='submit' class='btn btn-primary'>🔍 پیش‌نمایش و بررسی داده‌ها</button>
        </form>
        
        <br>
        <div class="warning">
            <strong>💡 نکته:</strong> این ابزار عملیات را به‌صورت خودکار و مرحله‌به‌مرحله انجام می‌دهد.
        </div>
        <?php
    }
    ?>
    
</div>
</body>
</html>