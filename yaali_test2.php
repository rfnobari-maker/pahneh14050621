<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <title>تغییر نام آبادی</title>
    <style>
        body { font-family: Tahoma, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 700px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; }
        input[type="submit"] { padding: 12px 30px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        input[type="submit"]:hover { background: #45a049; }
        .info-box { padding: 15px; border-right: 4px solid #2196F3; margin: 20px 0; background: #e7f3ff; }
        .warning { background: #fff3cd; border-right-color: #ffc107; }
        .success { background: #d4edda; border-right-color: #28a745; }
        .error { background: #f8d7da; border-right-color: #dc3545; }
        .btn-confirm { background: #ff9800; }
        .btn-confirm:hover { background: #e68900; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        td, th { padding: 10px; border: 1px solid #ddd; text-align: right; }
        th { background: #f2f2f2; }
        .backup-info { background: #e8f5e9; border-right: 4px solid #4CAF50; padding: 10px; margin: 10px 0; }
        .btn-back { display: inline-block; padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; }
        .btn-back:hover { background: #5a6268; }
        .btn-new { display: inline-block; padding: 10px 20px; background: #2196F3; color: white; text-decoration: none; border-radius: 4px; }
        .btn-new:hover { background: #0b7dda; }
        .row { display: flex; gap: 15px; }
        .row .form-group { flex: 1; }
    </style>
</head>
<body>
<div class="container">
    <h2>🔧 تغییر نام آبادی</h2>
    
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include('login/config.php');
    include('event.php');
    
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    function extractIdAbadi($add_abadi) {
        if (strlen($add_abadi) >= 6) {
            return substr($add_abadi, -6);
        }
        return $add_abadi;
    }
    
    function showMessage($message, $type = 'info') {
        $class = 'info-box';
        if ($type == 'warning') $class .= ' warning';
        elseif ($type == 'success') $class .= ' success';
        elseif ($type == 'error') $class .= ' error';
        echo "<div class='$class'>$message</div>";
    }
    
    // ============================================
    // مرحله 1: نمایش فرم ورودی دو کد
    // ============================================
    if (!isset($_POST['step']) || $_POST['step'] == '1') {
        ?>
        <form method="post">
            <input type="hidden" name="step" value="2">
            
            <div class="row">
                <div class="form-group">
                    <label>🔑 کد قدیم آبادی (۶ رقم سمت راست):</label>
                    <input type="text" name="old_id_abadi" placeholder="مثال: 000266" required pattern="[0-9]{6}" dir="ltr">
                    <small style="color: #666;">کد آبادی قدیم</small>
                </div>
                
                <div class="form-group">
                    <label>🔑 کد جدید آبادی (۶ رقم سمت راست):</label>
                    <input type="text" name="new_id_abadi" placeholder="مثال: 000300" required pattern="[0-9]{6}" dir="ltr">
                    <small style="color: #666;">کد آبادی جدید</small>
                </div>
            </div>
            
            <div class="form-group">
                <input type="submit" value="🔍 جستجوی آبادی‌ها">
            </div>
        </form>
        <?php
    }
    
    // ============================================
    // مرحله 2: جستجوی هر دو آبادی
    // ============================================
    elseif ($_POST['step'] == '2' && isset($_POST['old_id_abadi']) && isset($_POST['new_id_abadi'])) {
        
        $old_id_abadi = trim($_POST['old_id_abadi']);
        $new_id_abadi = trim($_POST['new_id_abadi']);
        
        // اعتبارسنجی
        if (!preg_match('/^[0-9]{6}$/', $old_id_abadi)) {
            showMessage('❌ خطا: کد قدیم باید دقیقاً ۶ رقم باشد!', 'error');
            echo '<a href="javascript:history.back()" class="btn-back">↩ بازگشت</a>';
            exit;
        }
        
        if (!preg_match('/^[0-9]{6}$/', $new_id_abadi)) {
            showMessage('❌ خطا: کد جدید باید دقیقاً ۶ رقم باشد!', 'error');
            echo '<a href="javascript:history.back()" class="btn-back">↩ بازگشت</a>';
            exit;
        }
        
        try {
            // ============================================
            // جستجوی آبادی قدیم
            // ============================================
            $old_search = '%' . $old_id_abadi;
            $query_old = "SELECT * FROM list_abadi WHERE add_abadi LIKE ?";
            $stmt_old = $dbh->prepare($query_old);
            $stmt_old->execute(array($old_search));
            $old_results = $stmt_old->fetchAll(PDO::FETCH_ASSOC);
            
            // اگر با LIKE پیدا نشد، با SUBSTRING امتحان کن
            if (count($old_results) == 0) {
                $query_old2 = "SELECT * FROM list_abadi WHERE SUBSTRING(add_abadi, -6) = ?";
                $stmt_old2 = $dbh->prepare($query_old2);
                $stmt_old2->execute(array($old_id_abadi));
                $old_results = $stmt_old2->fetchAll(PDO::FETCH_ASSOC);
            }
            
            // ============================================
            // جستجوی آبادی جدید
            // ============================================
            $new_search = '%' . $new_id_abadi;
            $query_new = "SELECT * FROM list_abadi WHERE add_abadi LIKE ?";
            $stmt_new = $dbh->prepare($query_new);
            $stmt_new->execute(array($new_search));
            $new_results = $stmt_new->fetchAll(PDO::FETCH_ASSOC);
            
            // اگر با LIKE پیدا نشد، با SUBSTRING امتحان کن
            if (count($new_results) == 0) {
                $query_new2 = "SELECT * FROM list_abadi WHERE SUBSTRING(add_abadi, -6) = ?";
                $stmt_new2 = $dbh->prepare($query_new2);
                $stmt_new2->execute(array($new_id_abadi));
                $new_results = $stmt_new2->fetchAll(PDO::FETCH_ASSOC);
            }
            
            // ============================================
            // بررسی نتایج
            // ============================================
            $has_error = false;
            
            if (count($old_results) == 0) {
                showMessage('❌ آبادی با کد قدیم ' . $old_id_abadi . ' یافت نشد!', 'error');
                $has_error = true;
            }
            
            if (count($new_results) == 0) {
                showMessage('❌ آبادی با کد جدید ' . $new_id_abadi . ' یافت نشد!', 'error');
                $has_error = true;
            }
            
            if ($has_error) {
                echo '<a href="javascript:history.back()" class="btn-back">↩ بازگشت</a>';
                exit;
            }
            
            // ============================================
            // اگر بیش از یک نتیجه برای هر کد وجود داشت
            // ============================================
            if (count($old_results) > 1) {
                showMessage('⚠️ بیش از یک آبادی با کد قدیم ' . $old_id_abadi . ' یافت شد!', 'warning');
                // نمایش لیست برای انتخاب
                ?>
                <form method="post">
                    <input type="hidden" name="step" value="3">
                    <input type="hidden" name="new_id_abadi" value="<?php echo htmlspecialchars($new_id_abadi, ENT_QUOTES, 'UTF-8'); ?>">
                    <h4>لطفاً آبادی قدیم را انتخاب کنید:</h4>
                    <table>
                        <tr><th>انتخاب</th><th>نام آبادی</th><th>کد</th></tr>
                        <?php foreach ($old_results as $row): ?>
                        <tr>
                            <td><input type="radio" name="selected_old_add_abadi" value="<?php echo htmlspecialchars($row['add_abadi'], ENT_QUOTES, 'UTF-8'); ?>" required></td>
                            <td><?php echo htmlspecialchars($row['add_abadi'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars(extractIdAbadi($row['add_abadi']), ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <input type="submit" value="✅ ادامه">
                </form>
                <?php
                exit;
            }
            
            if (count($new_results) > 1) {
                showMessage('⚠️ بیش از یک آبادی با کد جدید ' . $new_id_abadi . ' یافت شد!', 'warning');
                ?>
                <form method="post">
                    <input type="hidden" name="step" value="3">
                    <input type="hidden" name="old_add_abadi" value="<?php echo htmlspecialchars($old_results[0]['add_abadi'], ENT_QUOTES, 'UTF-8'); ?>">
                    <h4>لطفاً آبادی جدید را انتخاب کنید:</h4>
                    <table>
                        <tr><th>انتخاب</th><th>نام آبادی</th><th>کد</th></tr>
                        <?php foreach ($new_results as $row): ?>
                        <tr>
                            <td><input type="radio" name="selected_new_add_abadi" value="<?php echo htmlspecialchars($row['add_abadi'], ENT_QUOTES, 'UTF-8'); ?>" required></td>
                            <td><?php echo htmlspecialchars($row['add_abadi'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars(extractIdAbadi($row['add_abadi']), ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <input type="submit" value="✅ ادامه">
                </form>
                <?php
                exit;
            }
            
            // ============================================
            // فقط یک نتیجه برای هر کد - نمایش برای تایید
            // ============================================
            $old_add_abadi = $old_results[0]['add_abadi'];
            $new_add_abadi = $new_results[0]['add_abadi'];
            
            ?>
            <div class="info-box">
                <h3>📋 اطلاعات آبادی‌های یافت شده:</h3>
                <table>
                    <tr>
                        <td><strong>کد قدیم:</strong></td>
                        <td><?php echo htmlspecialchars($old_id_abadi, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>نام قدیم آبادی:</strong></td>
                        <td style="color: #dc3545; font-weight: bold;"><?php echo htmlspecialchars($old_add_abadi, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>کد جدید:</strong></td>
                        <td><?php echo htmlspecialchars($new_id_abadi, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>نام جدید آبادی:</strong></td>
                        <td style="color: #28a745; font-weight: bold;"><?php echo htmlspecialchars($new_add_abadi, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                </table>
                
                <div class="backup-info">
                    <strong>📦 اطلاعات بکاپ:</strong> قبل از تغییر، رکورد قدیم در جدول <code>list_abadi_del</code> کپی خواهد شد.
                </div>
                
                <p style="color: #856404; background: #fff3cd; padding: 10px; border-radius: 4px; margin-top: 10px;">
                    ⚠️ <strong>توجه:</strong> با تایید این عملیات، تمامی رکوردهای مربوط به آبادی قدیم 
                    در تمام جداول به‌روزرسانی شده و سپس آبادی قدیم از لیست حذف خواهد شد.
                </p>
            </div>
            
            <form method="post">
                <input type="hidden" name="step" value="4">
                <input type="hidden" name="old_add_abadi" value="<?php echo htmlspecialchars($old_add_abadi, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="new_add_abadi" value="<?php echo htmlspecialchars($new_add_abadi, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="old_id_abadi" value="<?php echo htmlspecialchars($old_id_abadi, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="new_id_abadi" value="<?php echo htmlspecialchars($new_id_abadi, ENT_QUOTES, 'UTF-8'); ?>">
                
                <div class="form-group">
                    <input type="submit" value="✅ تایید و اجرای عملیات" class="btn-confirm" 
                           onclick="return confirm('آیا از انجام این عملیات مطمئن هستید؟ این عملیات غیرقابل بازگشت است!');">
                </div>
                <div class="form-group">
                    <a href="javascript:history.back()" class="btn-back">↩ بازگشت</a>
                </div>
            </form>
            <?php
            
        } catch (PDOException $e) {
            showMessage('❌ خطای پایگاه داده: ' . $e->getMessage(), 'error');
            echo '<a href="javascript:history.back()" class="btn-back">↩ بازگشت</a>';
        }
    }
    
    // ============================================
    // مرحله 3: انتخاب از بین چند نتیجه
    // ============================================
    elseif ($_POST['step'] == '3') {
        // این مرحله برای انتخاب دستی کاربر طراحی شده
        // اگر به این مرحله رسیدیم، یعنی کاربر یکی را انتخاب کرده
        
        if (isset($_POST['selected_old_add_abadi']) && isset($_POST['new_id_abadi'])) {
            // کاربر آبادی قدیم را انتخاب کرده
            $old_add_abadi = trim($_POST['selected_old_add_abadi']);
            $new_id_abadi = trim($_POST['new_id_abadi']);
            
            // جستجوی آبادی جدید
            $new_search = '%' . $new_id_abadi;
            $query_new = "SELECT * FROM list_abadi WHERE add_abadi LIKE ?";
            $stmt_new = $dbh->prepare($query_new);
            $stmt_new->execute(array($new_search));
            $new_results = $stmt_new->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($new_results) == 0) {
                showMessage('❌ آبادی با کد جدید ' . $new_id_abadi . ' یافت نشد!', 'error');
                echo '<a href="javascript:history.back()" class="btn-back">↩ بازگشت</a>';
                exit;
            }
            
            $new_add_abadi = $new_results[0]['add_abadi'];
            
        } elseif (isset($_POST['old_add_abadi']) && isset($_POST['selected_new_add_abadi'])) {
            // کاربر آبادی جدید را انتخاب کرده
            $old_add_abadi = trim($_POST['old_add_abadi']);
            $new_add_abadi = trim($_POST['selected_new_add_abadi']);
        } else {
            showMessage('❌ خطا: اطلاعات کامل نیست!', 'error');
            echo '<a href="javascript:history.back()" class="btn-back">↩ بازگشت</a>';
            exit;
        }
        
        // نمایش برای تایید نهایی
        ?>
        <div class="info-box">
            <h3>📋 تایید نهایی:</h3>
            <table>
                <tr>
                    <td><strong>نام قدیم:</strong></td>
                    <td style="color: #dc3545; font-weight: bold;"><?php echo htmlspecialchars($old_add_abadi, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td><strong>نام جدید:</strong></td>
                    <td style="color: #28a745; font-weight: bold;"><?php echo htmlspecialchars($new_add_abadi, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            </table>
        </div>
        
        <form method="post">
            <input type="hidden" name="step" value="4">
            <input type="hidden" name="old_add_abadi" value="<?php echo htmlspecialchars($old_add_abadi, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="new_add_abadi" value="<?php echo htmlspecialchars($new_add_abadi, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="submit" value="✅ تایید نهایی" class="btn-confirm" 
                   onclick="return confirm('آیا از انجام این عملیات مطمئن هستید؟');">
        </form>
        <?php
    }
    
    // ============================================
    // مرحله 4: اجرای عملیات به‌روزرسانی
    // ============================================
    elseif ($_POST['step'] == '4' && isset($_POST['old_add_abadi']) && isset($_POST['new_add_abadi'])) {
        
        $old_add_abadi = trim($_POST['old_add_abadi']);
        $new_add_abadi = trim($_POST['new_add_abadi']);
        
        // لیست تمام جدول‌ها
 $tables = array(
            // جداول اصلی کشاورزی
            'Agri1397_1398', 'Agri1398_1399', 'Agri1399_1400', 'Agri1400_1401', 
            'Agri1401_1402', 'Agri1402_1403', 'Agri1403_1404', 'Agri1404_1405', 'Agri1405_1406',
            // جداول تولید کشاورزی
            'Agri_prod1397_1398', 'Agri_prod1398_1399', 'Agri_prod1399_1400', 
            'Agri_prod1400_1401', 'Agri_prod1401_1402', 'Agri_prod1402_1403', 
            'Agri_prod1403_1404', 'Agri_prod1404_1405', 'Agri_prod1405_1406',
            // سایر جداول
            'bah', 'bee', 'Aquatic', 'Aquatic2',
            'Eworker', 'Garden', 'Garden_prod', 'Greenhous', 
            'Greenprod_annual', 'Greenhous_prod', 'Mushroom', 
            'Mushroom_prod', 'Vege', 'Vege_prod'
            );
        
        try {
            $dbh->beginTransaction();
            
            $success_count = 0;
            $error_count = 0;
            $errors = array();
            $backup_success = false;
            $tables_updated = array();
            
            // ============================================
            // بکاپ در list_abadi_del
            // ============================================
            try {
                $check_table_query = "SHOW TABLES LIKE 'list_abadi_del'";
                $check_table_stmt = $dbh->prepare($check_table_query);
                $check_table_stmt->execute();
                
                if ($check_table_stmt->rowCount() == 0) {
                    $create_query = "CREATE TABLE list_abadi_del LIKE list_abadi";
                    $dbh->exec($create_query);
                }
                
                $select_query = "SELECT * FROM list_abadi WHERE add_abadi = ?";
                $select_stmt = $dbh->prepare($select_query);
                $select_stmt->execute(array($old_add_abadi));
                $old_record = $select_stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($old_record) {
                    $fields = array_keys($old_record);
                    $field_list = implode(', ', $fields);
                    
                    $placeholders = array();
                    foreach ($fields as $field) {
                        $placeholders[] = '?';
                    }
                    $placeholder_list = implode(', ', $placeholders);
                    
                    $insert_query = "INSERT INTO list_abadi_del ($field_list) VALUES ($placeholder_list)";
                    $insert_stmt = $dbh->prepare($insert_query);
                    
                    $values = array();
                    foreach ($fields as $field) {
                        $values[] = $old_record[$field];
                    }
                    
                    $insert_stmt->execute($values);
                    $backup_success = true;
                    $success_count++;
                }
            } catch (PDOException $e) {
                $error_count++;
                $errors[] = "خطا در بکاپ: " . $e->getMessage();
            }
            
            // ============================================
            // به‌روزرسانی تمام جدول‌ها
            // ============================================
            if ($backup_success) {
                foreach ($tables as $table) {
                    try {
                        $check_query = "SHOW TABLES LIKE ?";
                        $check_stmt = $dbh->prepare($check_query);
                        $check_stmt->execute(array($table));
                        if ($check_stmt->rowCount() == 0) {
                            continue;
                        }
                        
                        $query = "UPDATE `$table` SET add_abadi = ? WHERE add_abadi = ?";
                        $stmt = $dbh->prepare($query);
                        $stmt->execute(array($new_add_abadi, $old_add_abadi));
                        
                        $rows_affected = $stmt->rowCount();
                        if ($rows_affected > 0) {
                            $success_count++;
                            $tables_updated[] = $table . " (" . $rows_affected . " رکورد)";
                        }
                    } catch (PDOException $e) {
                        $error_count++;
                        $errors[] = "جدول $table: " . $e->getMessage();
                    }
                }
            }
            
            // ============================================
            // حذف آبادی قدیم از list_abadi
            // ============================================
            if ($backup_success && $error_count == 0) {
                try {
                    $delete_query = "DELETE FROM list_abadi WHERE add_abadi = ?";
                    $delete_stmt = $dbh->prepare($delete_query);
                    $delete_stmt->execute(array($old_add_abadi));
                    
                    if ($delete_stmt->rowCount() > 0) {
                        $success_count++;
                    }
                } catch (PDOException $e) {
                    $error_count++;
                    $errors[] = "حذف از list_abadi: " . $e->getMessage();
                }
            }
            
            // ============================================
            // نتیجه نهایی
            // ============================================
            if ($error_count > 0) {
                $dbh->rollBack();
                showMessage("❌ عملیات با خطا مواجه شد و تمام تغییرات لغو گردید.", 'error');
                if (!empty($errors)) {
                    echo "<div class='error'><ul>";
                    foreach ($errors as $error) {
                        echo "<li>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</li>";
                    }
                    echo "</ul></div>";
                }
            } else {
                $dbh->commit();
                showMessage("✅ عملیات با موفقیت انجام شد!", 'success');
                
                echo "<div class='info-box success'>";
                echo "<h3>📊 خلاصه عملیات:</h3>";
                echo "<p><strong>نام قدیم:</strong> " . htmlspecialchars($old_add_abadi, ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p><strong>نام جدید:</strong> " . htmlspecialchars($new_add_abadi, ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p><strong>📦 بکاپ:</strong> در جدول <code>list_abadi_del</code> ذخیره شد.</p>";
                
                if (count($tables_updated) > 0) {
                    echo "<p><strong>📋 جدول‌های به‌روزرسانی شده (" . count($tables_updated) . " جدول):</strong></p>";
                    echo "<ul>";
                    foreach ($tables_updated as $table_info) {
                        echo "<li>" . htmlspecialchars($table_info, ENT_QUOTES, 'UTF-8') . "</li>";
                    }
                    echo "</ul>";
                }
                echo "</div>";
            }
            
            echo '<br><a href="' . $_SERVER['PHP_SELF'] . '" class="btn-new">↩ انجام عملیات جدید</a>';
            
        } catch (Exception $e) {
            if ($dbh->inTransaction()) {
                $dbh->rollBack();
            }
            showMessage('❌ خطا: ' . $e->getMessage(), 'error');
        } catch (PDOException $e) {
            if ($dbh->inTransaction()) {
                $dbh->rollBack();
            }
            showMessage('❌ خطای پایگاه داده: ' . $e->getMessage(), 'error');
        }
    }
    ?>
</div>
</body>
</html>