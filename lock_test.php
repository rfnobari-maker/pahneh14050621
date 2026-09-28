<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h3>1) تنظیمات فعلی PHP</h3>";
echo "session.save_handler: " . ini_get('session.save_handler') . "<br>";
echo "session.save_path (ini): " . ini_get('session.save_path') . "<br>";
echo "session.gc_maxlifetime: " . ini_get('session.gc_maxlifetime') . "<br>";
echo "session.cookie_lifetime: " . ini_get('session.cookie_lifetime') . "<br>";
echo "session.name: " . ini_get('session.name') . "<br>";
echo "session.use_cookies: " . ini_get('session.use_cookies') . "<br>";
echo "session.use_strict_mode: " . ini_get('session.use_strict_mode') . "<br>";

echo "<h3>2) کجا session شروع شده؟</h3>";
echo "session_id() قبل از start: '" . session_id() . "'<br>";
echo "session_status: " . (function_exists('session_status') ? session_status() : 'N/A (PHP<5.4)') . "<br>";

echo "<h3>3) بعد از start</h3>";
if (session_id() === '') {
    session_start();
}
echo "session_id() بعد از start: '" . session_id() . "'<br>";
echo "session_save_path() واقعی: '" . session_save_path() . "'<br>";
echo "کوکی سشن در مرورگر: " . (isset($_COOKIE[session_name()]) ? 'YES' : 'NO') . "<br>";
echo "session.name: " . session_name() . "<br>";

echo "<h3>4) محتوای سشن فعلی</h3>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h3>5) فایل سشن کجاست؟</h3>";
$path = session_save_path();
echo "مسیر: $path<br>";
if (is_dir($path)) {
    echo "فایل‌های sess_* موجود:<br>";
    $files = glob($path . '/sess_*');
    foreach ($files as $f) {
        echo " - " . basename($f) . " (" . filesize($f) . " bytes, " . date('H:i:s', filemtime($f)) . ")<br>";
    }
}
?>