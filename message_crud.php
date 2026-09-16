<?php
// PHP 5.3.2 سازگار

// ۱. وابستگی‌ها و تنظیمات PDO
require_once './login/config.php';


// بررسی اتصال PDO
if (!isset($dbh) || !($dbh instanceof PDO)) {
    die("خطا: اتصال دیتابیس (\$dbh) برقرار نشد. لطفاً config.php را بررسی کنید.");
}

// تنظیمات PDO برای مدیریت خطاها به صورت Exception (برای کارکرد صحیح تراکنش‌ها)
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$message = '';
$edit_id = null;
$edit_text = '';
$edit_key = '';
$edit_type = 'Information';
$redirect = false;


/**
 * تابع کمکی برای تولید کلید پیام به صورت خودکار
 * @param string $type نوع پیام (مثلاً Emergency یا Information)
 * @param int $id شماره ID پیام
 * @return string کلید نهایی
 */
function generate_message_key($type, $id) {
    // حذف فاصله و کاراکترهای خاص
    $key_type = str_replace(array(' ', '-'), '', $type); 
    // کلید با فرمت systemMessageHidden_[Type]_[ID]
    return 'systemMessageHidden_' . $key_type . '_' . $id;
}


// ==============================================================================
// ۲. مدیریت عملیات CRUD
// ==============================================================================

// افزودن/ویرایش پیام
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $text = trim($_POST['message_text']);
    $type = trim($_POST['message_type']);
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if (empty($text) || empty($type)) {
        $message = '<p style="color:red; font-weight:bold;">!لطفاً تمام فیلدهای مورد نیاز را پر کنید</p>';
    } else {
        try {
            // شروع تراکنش برای تضمین اجرای کامل عملیات
            $dbh->beginTransaction();
            
            if ($_POST['action'] === 'add') {
                // الف. افزودن پیام جدید (با تولید خودکار کلید)
                
                // ۱. درج موقت پیام با یک کلید Placeholder (به دلیل یونیک بودن ستون)
                $placeholder_key = 'KEY_PLACEHOLDER_' . time() . '_' . rand(100, 999); 
                
                $sql_insert = "INSERT INTO system_messages (message_text, message_key, message_type) VALUES (?, ?, ?)";
                $stmt_insert = $dbh->prepare($sql_insert);
                $stmt_insert->execute(array($text, $placeholder_key, $type));
                
                // ۲. دریافت ID جدید
                $new_id = $dbh->lastInsertId();
                
                if ($new_id > 0) {
                    // ۳. تولید کلید نهایی
                    $final_key = generate_message_key($type, $new_id);
                    
                    // ۴. به‌روزرسانی پیام با کلید نهایی
                    $sql_update = "UPDATE system_messages SET message_key = ? WHERE id = ?";
                    $stmt_update = $dbh->prepare($sql_update);
                    $stmt_update->execute(array($final_key, $new_id));
                    
                    $message = '<p style="color:green; font-weight:bold;">✅ پیام با موفقیت اضافه شد.</p>';
                    $redirect = true;

                } else {
                    throw new PDOException("خطا: ID جدید از دیتابیس دریافت نشد. (ID = 0)");
                }

            } elseif ($_POST['action'] === 'edit' && $id > 0) {
                // ب. ویرایش پیام
                
                // تولید کلید نهایی بر اساس ID موجود و نوع جدید (در صورت تغییر)
                $final_key = generate_message_key($type, $id);
                $sql = "UPDATE system_messages SET message_text = ?, message_key = ?, message_type = ? WHERE id = ?";
                $stmt = $dbh->prepare($sql);
                $stmt->execute(array($text, $final_key, $type, $id));
                
                $message = '<p style="color:green; font-weight:bold;">✅ پیام با موفقیت ویرایش شد.</p>';
                $redirect = true;
            }
            
            $dbh->commit();
            
        } catch (PDOException $e) {
            // در صورت بروز هرگونه خطا، تراکنش را لغو کن
            if ($dbh->inTransaction()) {
                $dbh->rollBack();
            }
            $message = '<p style="color:red; font-weight:bold;">❌ خطای عملیات دیتابیس: ' . htmlspecialchars($e->getMessage()) . '</p>';
        }
    }
    
    // ریدایرکت برای جلوگیری از ارسال مجدد فرم
    if ($redirect) {
        header('Location: message_crud.php');
        exit;
    }
}

// حذف پیام
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    try {
        $sql = "DELETE FROM system_messages WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($id));
        $message = '<p style="color:green; font-weight:bold;">✅ پیام با موفقیت حذف شد.</p>';
        header('Location: message_crud.php');
        exit;
    } catch (PDOException $e) {
        $message = '<p style="color:red; font-weight:bold;">❌ خطا در حذف پیام: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}

// بارگذاری پیام برای ویرایش
if (isset($_GET['edit_id'])) {
    $edit_id = (int)$_GET['edit_id'];
    $sql = "SELECT * FROM system_messages WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array($edit_id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $edit_text = $row['message_text'];
        $edit_key = $row['message_key']; 
        $edit_type = $row['message_type'];
    } else {
        $message = '<p style="color:red; font-weight:bold;">!پیام مورد نظر برای ویرایش یافت نشد</p>';
        $edit_id = null;
    }
}

// دریافت تمام پیام‌ها برای نمایش
$sql = "SELECT * FROM system_messages ORDER BY order_num ASC, id DESC";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>مدیریت پیام‌های سیستم</title>
    <style>
        body { font-family: Tahoma, sans-serif; direction: rtl; padding: 20px; background-color: #f4f7f6; }
        h1, h2 { border-bottom: 2px solid #ccc; padding-bottom: 5px; color: #333; }
        form { margin-bottom: 30px; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #ffffff; max-width: 700px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        label { display: block; margin-top: 15px; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], textarea, select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-family: Tahoma, sans-serif; }
        textarea { resize: vertical; }
        input[type="submit"] { background-color: #007bff; color: white; padding: 12px 20px; margin-top: 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 1.1em; }
        input[type="submit"]:hover { background-color: #0056b3; }
        .cancel-link { float: left; margin-top: 20px; padding: 12px 20px; border: 1px solid #ccc; border-radius: 4px; text-decoration: none; color: #333; background-color: #f8f9fa; }
        .cancel-link:hover { background-color: #e2e6ea; }

        table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: right; }
        th { background-color: #e9ecef; color: #333; }
        
        .action-links a { margin-left: 10px; text-decoration: none; padding: 6px 10px; border-radius: 4px; font-size: 0.9em; }
        .action-links .edit { background-color: #ffc107; color: #212529; }
        .action-links .delete { background-color: #dc3545; color: white; }
        .type-info { color: #17a2b8; font-weight: bold; }
        .type-emergency { color: #dc3545; font-weight: bold; }
        .message-box { padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .message-box p { margin: 0; }
        p[style*="color:red"] { color: #dc3545 !important; background-color: #f8d7da; border: 1px solid #f5c6cb; }
        p[style*="color:green"] { color: #155724 !important; background-color: #d4edda; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>

    <h1>مدیریت پیام‌های شناور سیستم</h1>

    <div class="message-box">
        <?php echo $message; // نمایش پیام‌های سیستم ?>
    </div>

    <h2><?php echo $edit_id ? '✏️ ویرایش پیام (ID: ' . $edit_id . ')' : '➕ افزودن پیام جدید'; ?></h2>
    <form method="POST" action="message_crud.php">
        <input type="hidden" name="action" value="<?php echo $edit_id ? 'edit' : 'add'; ?>">
        <?php if ($edit_id): ?>
            <input type="hidden" name="id" value="<?php echo $edit_id; ?>">
        <?php endif; ?>

        <label for="message_type">نوع پیام:</label>
        <select id="message_type" name="message_type" required>
            <option value="Information" <?php echo $edit_type === 'Information' ? 'selected' : ''; ?>>اطلاعیه (📣)</option>
            <option value="Emergency" <?php echo $edit_type === 'Emergency' ? 'selected' : ''; ?>>اضطراری (⚠️)</option>
        </select>

        <label for="message_text">متن پیام:</label>
        <textarea id="message_text" name="message_text" rows="4" required placeholder="متن پیام خود را وارد کنید."><?php echo htmlspecialchars($edit_text); ?></textarea>
        
        <?php if ($edit_id): ?>
            <label for="message_key_display">کلید مجزا (تولید خودکار):</label>
            <input type="text" id="message_key_display" value="<?php echo htmlspecialchars($edit_key); ?>" readonly style="background-color: #eee; font-family: monospace;">
            <small style="display: block; margin-top: 5px; color: #555;">این کلید به صورت خودکار با فرمت `systemMessageHidden_[Type]_[ID]` تولید و ذخیره شده است.</small>
        <?php endif; ?>

        <input type="submit" value="<?php echo $edit_id ? 'ذخیره تغییرات' : 'ثبت پیام'; ?>">
        <?php if ($edit_id): ?>
            <a href="message_crud.php" class="cancel-link">لغو ویرایش</a>
        <?php endif; ?>
    </form>

    <h2>📊 لیست پیام‌های موجود</h2>
    <?php if (count($messages) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>نوع</th>
                <th>متن پیام</th>
                <th>کلید مجزا (LocalStorage Key)</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $msg): ?>
            <tr>
                <td><?php echo $msg['id']; ?></td>
                <td class="type-<?php echo strtolower($msg['message_type']); ?>">
                    <?php 
                        echo $msg['message_type'] === 'Emergency' ? '⚠️ اضطراری' : '📣 اطلاعیه';
                    ?>
                </td>
                <td><?php echo nl2br(htmlspecialchars(mb_substr($msg['message_text'], 0, 70) . (mb_strlen($msg['message_text']) > 70 ? '...' : ''))); ?></td>
                <td style="font-family: monospace; font-size: 0.9em;"><?php echo htmlspecialchars($msg['message_key']); ?></td>
                <td class="action-links">
                    <a href="message_crud.php?edit_id=<?php echo $msg['id']; ?>" class="edit">ویرایش</a>
                    <a href="message_crud.php?delete_id=<?php echo $msg['id']; ?>" 
                       onclick="return confirm('آیا مطمئن هستید که می‌خواهید این پیام را حذف کنید؟ این عمل غیرقابل بازگشت است.');" class="delete">حذف</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>⚠️ هیچ پیام سیستمی ثبت نشده است.</p>
    <?php endif; ?>
    <br><br>
</body>
</html>