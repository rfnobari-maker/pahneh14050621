<form name="test" method="post" > 
  <p>
 <input type="text" name="add_abadi" width="100px">
  : آدرس آماری آبادی   </p>
  <p>
 <input type="text" name="add_city" width="100px">
  : آدرس آماری شهر  </p>
  <p>
    <input type="submit" name="action" id="btn1" >
  </p>
</form>
<?php
if (isset($_POST['action']) && !empty($_POST['add_abadi']) && !empty($_POST['add_city'])) 
{ 
    $add_abadi = $_POST['add_abadi'];
    $add_city = $_POST['add_city'];

    include ('login/config.php');
    include ('event.php');

    // دریافت اطلاعات آبادی
    $stmt = $dbh->prepare("SELECT abadi FROM list_abadi WHERE add_abadi = ?");
    $stmt->execute(array($add_abadi));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $abadi = $row['abadi'];
    
    // دریافت اطلاعات شهر
    $stmt = $dbh->prepare("SELECT shahr FROM public_city WHERE add_city = ?");
    $stmt->execute(array($add_city));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $shahr = $row['shahr'];
    
    // اگر کاربر هنوز تایید نکرده، پیام نمایش بده
    if (!isset($_POST['confirm'])) {
        // ابتدا تعداد رکوردها را در هر جدول محاسبه کن
        $tables = array(
            'Agri1397_1398', 'Agri1398_1399', 'Agri1399_1400', 'Agri1400_1401',
            'Agri1401_1402', 'Agri1402_1403', 'Agri1403_1404', 'Agri1404_1405',
            'Agri1405_1406',
            'Agri_prod1397_1398', 'Agri_prod1398_1399', 'Agri_prod1399_1400',
            'Agri_prod1400_1401', 'Agri_prod1401_1402', 'Agri_prod1402_1403',
            'Agri_prod1403_1404', 'Agri_prod1404_1405', 'Agri_prod1405_1406',
            'Agriprod1399_1400', 'Agriprod1400_1401', 'Agriprod1401_1402',
            'Agriprod1402_1403',
            'Aquatic', 'Aquatic2',
            'bah', 'bah20',
            'bee', 'bee_1403',
            'Garden', 'Garden_prod',
            'Greenhous', 'Greenhous_prod', 'Greenprod_annual',
            'Mushroom', 'Mushroom_prod',
            'Vege', 'Vege_prod'
        );

        $table_counts = array();
        $total_records = 0;
        
        foreach ($tables as $table) {
            $query = "SELECT COUNT(*) as count FROM $table WHERE add_abadi = ?";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array($add_abadi));
            $count = $stmt->fetch(PDO::FETCH_ASSOC);
            $count_num = intval($count['count']);
            
            if ($count_num > 0) {
                $table_counts[$table] = $count_num;
                $total_records += $count_num;
            }
        }
        ?>
        <!DOCTYPE html>
        <html dir="rtl">
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Tahoma; background: #f5f5f5; }
                .confirm-box {
                    max-width: 600px;
                    margin: 30px auto;
                    padding: 30px;
                    background: white;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                .info {
                    background: #e8f4fd;
                    padding: 15px;
                    margin: 10px 0;
                    border-radius: 5px;
                    font-size: 16px;
                }
                .info strong {
                    color: #0066cc;
                }
                .table-list {
                    background: #f9f9f9;
                    padding: 15px;
                    margin: 15px 0;
                    border-radius: 5px;
                    max-height: 300px;
                    overflow-y: auto;
                }
                .table-item {
                    display: flex;
                    justify-content: space-between;
                    padding: 5px 0;
                    border-bottom: 1px solid #eee;
                }
                .table-name {
                    color: #333;
                }
                .table-count {
                    background: #4CAF50;
                    color: white;
                    padding: 2px 10px;
                    border-radius: 12px;
                    font-size: 12px;
                }
                .total {
                    background: #0066cc;
                    color: white;
                    padding: 10px;
                    border-radius: 5px;
                    text-align: center;
                    font-size: 18px;
                    margin: 15px 0;
                }
                .warning {
                    color: #ff6600;
                    font-size: 14px;
                    margin: 10px 0;
                }
                .btn {
                    padding: 10px 30px;
                    margin: 5px;
                    border: none;
                    border-radius: 5px;
                    font-size: 16px;
                    cursor: pointer;
                }
                .btn-confirm {
                    background: #4CAF50;
                    color: white;
                }
                .btn-confirm:hover {
                    background: #45a049;
                }
                .btn-cancel {
                    background: #f44336;
                    color: white;
                }
                .btn-cancel:hover {
                    background: #da190b;
                }
                .btn-center {
                    text-align: center;
                    margin-top: 20px;
                }
                .no-records {
                    background: #fff3cd;
                    color: #856404;
                    padding: 10px;
                    border-radius: 5px;
                    text-align: center;
                    margin: 10px 0;
                }
            </style>
        </head>
        <body>
            <div class="confirm-box">
                <h2 style="text-align: center;">تاییدیه انتقال آبادی</h2>
                
                <div class="info">
                    <strong>آبادی مبدأ:</strong> <?php echo htmlspecialchars($abadi); ?><br>
                    <strong>کد آبادی:</strong> <?php echo htmlspecialchars($add_abadi); ?>
                </div>
                
                <div class="info">
                    <strong>شهر مقصد:</strong> <?php echo htmlspecialchars($shahr); ?><br>
                    <strong>کد شهر:</strong> <?php echo htmlspecialchars($add_city); ?>
                </div>

                <div class="total">
                    📊 تعداد کل رکوردهای قابل انتقال: <strong><?php echo number_format($total_records); ?></strong>
                </div>

                <?php if ($total_records > 0): ?>
                <div class="table-list">
                    <h4 style="margin-top: 0;">جداول دارای رکورد:</h4>
                    <?php foreach ($table_counts as $table => $count): ?>
                    <div class="table-item">
                        <span class="table-name"><?php echo htmlspecialchars($table); ?></span>
                        <span class="table-count"><?php echo number_format($count); ?> رکورد</span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="no-records">
                    ⚠️ هیچ رکوردی برای این آبادی در جداول پیدا نشد.<br>
                    <small>اما عملیات کپی و حذف آبادی همچنان انجام خواهد شد.</small>
                </div>
                <?php endif; ?>

                <p class="warning">⚠️ آیا از انتقال این آبادی به شهر جدید اطمینان دارید؟</p>
                <p style="font-size: 12px; color: #999; text-align: center;">
                    <?php if ($total_records > 0): ?>
                    تمام اطلاعات مربوط به این آبادی در <?php echo count($table_counts); ?> جدول به‌روزرسانی خواهد شد.
                    <?php else: ?>
                    فقط عملیات کپی و حذف آبادی انجام خواهد شد.
                    <?php endif; ?>
                </p>
                
                <div class="btn-center">
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="add_abadi" value="<?php echo htmlspecialchars($add_abadi); ?>">
                        <input type="hidden" name="add_city" value="<?php echo htmlspecialchars($add_city); ?>">
                        <input type="hidden" name="action" value="1">
                        <input type="hidden" name="confirm" value="1">
                        <button type="submit" class="btn btn-confirm">
                            ✔ تایید و انتقال
                        </button>
                    </form>
                    <button type="button" class="btn btn-cancel" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>'">
                        ✖ انصراف
                    </button>
                </div>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
    
    // اگر کاربر تایید کرده، عملیات انجام شود
    try {
        // شروع تراکنش
        $dbh->beginTransaction();

        // کپی در جدول بایگانی (حتی اگر رکوردی در جداول دیگر نباشد)
        $stmt = $dbh->prepare("INSERT INTO list_abadi_del SELECT * FROM list_abadi WHERE add_abadi = ?");
        $stmt->execute(array($add_abadi));
        $copy_count = $stmt->rowCount();

        // حذف از جدول اصلی
        $stmt = $dbh->prepare("DELETE FROM list_abadi WHERE add_abadi = ?");
        $stmt->execute(array($add_abadi));
        $delete_count = $stmt->rowCount();

        // لیست تمام جدول‌ها
        $tables = array(
            'Agri1397_1398', 'Agri1398_1399', 'Agri1399_1400', 'Agri1400_1401',
            'Agri1401_1402', 'Agri1402_1403', 'Agri1403_1404', 'Agri1404_1405',
            'Agri1405_1406',
            'Agri_prod1397_1398', 'Agri_prod1398_1399', 'Agri_prod1399_1400',
            'Agri_prod1400_1401', 'Agri_prod1401_1402', 'Agri_prod1402_1403',
            'Agri_prod1403_1404', 'Agri_prod1404_1405', 'Agri_prod1405_1406',
            'Agriprod1399_1400', 'Agriprod1400_1401', 'Agriprod1401_1402',
            'Agriprod1402_1403',
            'Aquatic', 'Aquatic2',
            'bah', 'bah20',
            'bee', 'bee_1403',
            'Garden', 'Garden_prod',
            'Greenhous', 'Greenhous_prod', 'Greenprod_annual',
            'Mushroom', 'Mushroom_prod',
            'Vege', 'Vege_prod'
        );

        // آرایه برای ذخیره نتایج
        $update_results = array();
        $total_updated = 0;

        // به‌روزرسانی تمام جدول‌ها
        foreach ($tables as $table) {
            // اول تعداد رکوردهای قبل از آپدیت
            $query = "SELECT COUNT(*) as count FROM $table WHERE add_abadi = ?";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array($add_abadi));
            $before = $stmt->fetch(PDO::FETCH_ASSOC);
            $before_count = intval($before['count']);
            
            if ($before_count > 0) {
                // آپدیت کردن
                $query = "UPDATE $table SET add_abadi = '-', add_city = ? WHERE add_abadi = ?";
                $stmt = $dbh->prepare($query);
                $stmt->execute(array($add_city, $add_abadi));
                
                $update_results[$table] = $before_count;
                $total_updated += $before_count;
            }
        }

        // تایید تراکنش
        $dbh->commit();
        
        // پیام موفقیت با نمایش جزئیات
        ?>
        <!DOCTYPE html>
        <html dir="rtl">
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Tahoma; background: #f5f5f5; }
                .success-box {
                    max-width: 600px;
                    margin: 30px auto;
                    padding: 30px;
                    background: white;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                .success {
                    color: #4CAF50;
                    font-size: 24px;
                    text-align: center;
                }
                .info {
                    background: #e8f4fd;
                    padding: 15px;
                    margin: 10px 0;
                    border-radius: 5px;
                    font-size: 16px;
                }
                .total-updated {
                    background: #4CAF50;
                    color: white;
                    padding: 15px;
                    border-radius: 5px;
                    text-align: center;
                    font-size: 20px;
                    margin: 15px 0;
                }
                .table-results {
                    background: #f9f9f9;
                    padding: 15px;
                    margin: 15px 0;
                    border-radius: 5px;
                    max-height: 300px;
                    overflow-y: auto;
                }
                .table-result-item {
                    display: flex;
                    justify-content: space-between;
                    padding: 5px 0;
                    border-bottom: 1px solid #eee;
                }
                .table-name {
                    color: #333;
                }
                .table-count {
                    color: #4CAF50;
                    font-weight: bold;
                }
                .btn {
                    padding: 10px 30px;
                    border: none;
                    border-radius: 5px;
                    font-size: 16px;
                    cursor: pointer;
                    background: #0066cc;
                    color: white;
                }
                .btn:hover {
                    background: #0052a3;
                }
                .btn-center {
                    text-align: center;
                    margin-top: 20px;
                }
                .copy-info {
                    background: #e8f4fd;
                    padding: 10px;
                    border-radius: 5px;
                    text-align: center;
                    margin: 10px 0;
                }
            </style>
        </head>
        <body>
            <div class="success-box">
                <div class="success">✅ عملیات با موفقیت انجام شد</div>
                
                <div class="info">
                    <strong>آبادی:</strong> <?php echo htmlspecialchars($abadi); ?><br>
                    <strong>به شهر:</strong> <?php echo htmlspecialchars($shahr); ?><br>
                    <strong>انتقال یافت.</strong>
                </div>

                <div class="copy-info">
                    📋 آبادی در جدول بایگانی کپی شد: <strong><?php echo number_format($copy_count); ?></strong> رکورد<br>
                    🗑️ آبادی از جدول اصلی حذف شد: <strong><?php echo number_format($delete_count); ?></strong> رکورد
                </div>

                <?php if ($total_updated > 0): ?>
                <div class="total-updated">
                    📊 تعداد کل رکوردهای به‌روزرسانی شده: <strong><?php echo number_format($total_updated); ?></strong>
                </div>

                <div class="table-results">
                    <h4 style="margin-top: 0;">جزئیات به‌روزرسانی جداول:</h4>
                    <?php foreach ($update_results as $table => $count): ?>
                    <div class="table-result-item">
                        <span class="table-name"><?php echo htmlspecialchars($table); ?></span>
                        <span class="table-count"><?php echo number_format($count); ?> رکورد</span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="info" style="background: #fff3cd; color: #856404; text-align: center;">
                    ℹ️ هیچ رکوردی در جداول دیگر به‌روزرسانی نشد.
                </div>
                <?php endif; ?>

                <div class="btn-center">
                    <button class="btn" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>'">بازگشت</button>
                </div>
            </div>
        </body>
        </html>
        <?php

    } catch (Exception $e) {
        // برگشت تغییرات در صورت خطا
        $dbh->rollBack();
        ?>
        <!DOCTYPE html>
        <html dir="rtl">
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Tahoma; background: #f5f5f5; }
                .error-box {
                    max-width: 500px;
                    margin: 50px auto;
                    padding: 30px;
                    background: white;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    text-align: center;
                }
                .error {
                    color: #f44336;
                    font-size: 24px;
                }
                .btn {
                    padding: 10px 30px;
                    border: none;
                    border-radius: 5px;
                    font-size: 16px;
                    cursor: pointer;
                    background: #0066cc;
                    color: white;
                }
                .btn:hover {
                    background: #0052a3;
                }
            </style>
        </head>
        <body>
            <div class="error-box">
                <div class="error">❌ خطا در انجام عملیات</div>
                <p><?php echo htmlspecialchars($e->getMessage()); ?></p>
                <button class="btn" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>'">بازگشت</button>
            </div>
        </body>
        </html>
        <?php
    }
}
?>