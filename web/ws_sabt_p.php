<?php
// فایل display_photo.php

// ۱. فایل حاوی تابع وب سرویس را فراخوانی کنید
require_once 'ws_photo.php';

// --- ۲. اصلاح ورودی‌ها ---
// **لطفاً مقادیر زیر را با اطلاعات صحیح و فرمت دقیق جایگزین کنید.**
$nin = '2800397896';         // <<< کد ملی واقعی را جایگزین کنید >>>
$card_serial = '3369140310'; // <<< سریال 10 رقمی عددی پشت کارت هوشمند (بدون حروف) یا سریال 9 رقمی قدیمی را جایگزین کنید >>>

// ۳. فراخوانی تابع
$result = get_sabt_ahval_photo($nin, $card_serial);

// ۴. بررسی نتیجه و نمایش
if ($result['success'] === TRUE) {
    // تنظیم هدر برای نمایش عکس JPEG
    header('Content-Type: image/jpeg');
    
    // ارسال داده‌های باینری عکس به مرورگر
    echo $result['image_binary'];
    exit;
} else {
    // در صورت خطا، پیام و پاسخ خام را نمایش دهید
    header('Content-Type: text/html; charset=utf-8');
    echo "<h1>❌ خطا در دریافت عکس</h1>";
    echo "<p style='color: red;'>پیام خطا: <strong>" . htmlspecialchars($result['message']) . "</strong></p>";
    echo "<p>کد HTTP: " . (isset($result['http_code']) ? htmlspecialchars($result['http_code']) : 'N/A') . "</p>";

    echo "<h2>پاسخ کامل سرویس (JSON خام):</h2>";
    echo "<pre style='background-color: #f4f4f4; padding: 10px; border: 1px solid #ccc; white-space: pre-wrap; word-break: break-all;'>";
    if (isset($result['raw_response'])) {
        echo htmlspecialchars($result['raw_response']); 
    } else {
        echo "پاسخ خام در دسترس نیست.";
    }
    echo "</pre>";
}
?>