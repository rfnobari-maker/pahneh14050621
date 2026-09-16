<?php
// autoload.php - بارگذاری دستی کلاس‌های PhpSpreadsheet

spl_autoload_register(function ($class) {
    // تبدیل نام کلاس به مسیر فایل
    $prefixes = [
        'PhpOffice\\PhpSpreadsheet\\' => __DIR__ . '/vendor/phpoffice/phpspreadsheet/src/PhpSpreadsheet/',
        'Psr\\SimpleCache\\' => __DIR__ . '/vendor/psr/simple-cache/src/',
        'Psr\\Http\\Message\\' => __DIR__ . '/vendor/psr/http-message/src/',
        'Psr\\Http\\Factory\\' => __DIR__ . '/vendor/psr/http-factory/src/',
        'Psr\\Http\\Client\\' => __DIR__ . '/vendor/psr/http-client/src/',
        'MyCLabs\\Enum\\' => __DIR__ . '/vendor/myclabs/php-enum/src/',
        'Symfony\\Polyfill\\Mbstring\\' => __DIR__ . '/vendor/symfony/polyfill-mbstring/',
    ];

    foreach ($prefixes as $prefix => $base_dir) {
        // بررسی اینکه کلاس با پیشوند مشخص شروع می‌شود
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }

        // مسیر فایل را بساز
        $relative_class = substr($class, $len);
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // اگر فایل وجود دارد، آن را بارگذاری کن
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});

// بارگذاری توابع کمکی
require_once __DIR__ . '/vendor/phpoffice/phpspreadsheet/src/PhpSpreadsheet/Shared/StringHelper.php';
require_once __DIR__ . '/vendor/phpoffice/phpspreadsheet/src/PhpSpreadsheet/Shared/Ole.php';
require_once __DIR__ . '/vendor/phpoffice/phpspreadsheet/src/PhpSpreadsheet/Shared/File.php';
require_once __DIR__ . '/vendor/phpoffice/phpspreadsheet/src/PhpSpreadsheet/Shared/PasswordHasher.php';
require_once __DIR__ . '/vendor/phpoffice/phpspreadsheet/src/PhpSpreadsheet/Shared/TimeZone.php';
