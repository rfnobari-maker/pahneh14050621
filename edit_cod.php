<?php
// شامل کردن فایل تنظیمات
include('./login/config.php');

// شناسایی کانکشن‌های کاربر در وضعیت Sleep
$sql = "SHOW PROCESSLIST";
$stmt = $dbh->query($sql);

// بررسی و حذف کانکشن‌های Sleep
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // بررسی وضعیت کانکشن و کاربر
    if ($row['Command'] == 'Sleep' && $row['User'] == 'jahani') {
        $threadId = $row['Id']; // شناسه کانکشن
        echo "Killing connection with ID: $threadId\n";

        // اجرای دستور KILL برای حذف کانکشن
        $killSql = "KILL $threadId";
        if ($dbh->exec($killSql)) {
            echo "Connection $threadId killed successfully.\n";
        } else {
            echo "Error killing connection $threadId.\n";
        }
    }
}

$dbh = null; // بستن اتصال به دیتابیس
?>
