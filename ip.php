<?php
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    
    // حذف پورت از آی‌پی در صورت وجود
    $ipParts = explode(':', $ip); // جدا کردن آی‌پی و پورت
    $ip = $ipParts[0]; // دریافت فقط آی‌پی
    return $ip;
}

// نمایش آی‌پی کاربر
$userIP = getUserIP();
echo "آی‌پی شما: " . $userIP;
?>
