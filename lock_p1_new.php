<?php
if (session_id() == '') session_start();

// تنظیم زمان انقضای جلسه به 1 ساعت (3600 ثانیه)
// در PHP 5.3.2، ممکن است نیاز باشد این تنظیمات را در php.ini یا .htaccess انجام دهید.
// اما این خطوط سعی می‌کنند در زمان اجرا اعمال شوند:
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);

// بررسی اینکه آیا جلسه فعال است
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 3600) {
    // اگر بیشتر از 1 ساعت از آخرین فعالیت گذشته باشد، جلسه منقضی می‌شود
    session_unset();
    session_destroy();
    if (isset($dbh)) $dbh = null;
    header("Location: /login/login.php?message=timeout");
    exit();
} else {
    // به‌روزرسانی زمان آخرین فعالیت
    $_SESSION['last_activity'] = time();
}

// خواندن تمامی متغیرهای مورد نیاز از سشن
$actual_link = "https://$_SERVER[HTTP_HOST]";

// در PHP 5.3.2، عملگر ?? (Null Coalescing Operator) وجود ندارد.
// باید از isset() برای بررسی وجود متغیرها قبل از استفاده استفاده کنید.
$title = isset($_SESSION['title']) ? $_SESSION['title'] : null;
$user_check = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;
$karbar_m = isset($_SESSION['karbar']) ? $_SESSION['karbar'] : null;
$login_session = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$cod_m_session = isset($_SESSION['cod_m']) ? $_SESSION['cod_m'] : null;
$PersName = isset($_SESSION['PersName']) ? $_SESSION['PersName'] : null;
$euser = $PersName; // اگر PersName وجود ندارد، $euser هم null خواهد بود
$ostan = isset($_SESSION['ostan']) ? $_SESSION['ostan'] : null;
$city = isset($_SESSION['city']) ? $_SESSION['city'] : null;
$id_ostan = isset($_SESSION['id_ostan']) ? $_SESSION['id_ostan'] : null;
$id_city = isset($_SESSION['id_city']) ? $_SESSION['id_city'] : null;
$markaz = isset($_SESSION['markaz']) ? $_SESSION['markaz'] : null;
$id_mar = isset($_SESSION['id_mar']) ? $_SESSION['id_mar'] : null;
$name = isset($_SESSION['name']) ? $_SESSION['name'] : null;
$v_jen = isset($_SESSION['v_jen']) ? $_SESSION['v_jen'] : ''; // پیش‌فرض خالی
$pic = isset($_SESSION['pic']) ? $_SESSION['pic'] : null;
$no_karbar = isset($_SESSION['no_karbar']) ? $_SESSION['no_karbar'] : null;
$date_pas = isset($_SESSION['date_pas']) ? $_SESSION['date_pas'] : null;

// --- نکته مهم: بستن سشن پس از خواندن اطلاعات ---
// این کار باعث آزاد شدن فایل سشن می‌شود و درخواست‌های دیگر می‌توانند به سشن دسترسی پیدا کنند.
session_write_close(); 

// حالا می‌توانید عملیات‌های طولانی‌تر را انجام دهید (مثلاً کوئری‌های دیتابیس)
// و نیازی نیست نگران قفل شدن سشن باشید.


// بررسی احراز هویت و ریدایرکت
if (!isset($login_session) || $karbar_m != '1') {
    // اگر کاربر احراز هویت نشده یا نوع کاربر صحیح نیست، سشن را از بین می‌بریم و ریدایرکت می‌کنیم
    // باید مطمئن شویم سشن برای destroy کردن فعال است.
    // در اینجا، session_write_close() قبلاً سشن را بسته است. برای destroy کردن، باید دوباره session_start() را فراخوانی کنید.
    if (session_id() == '') { 
        session_start();
    }
    session_unset(); // حذف تمام متغیرهای سشن
    session_destroy(); // از بین بردن سشن
    
    if (isset($dbh)) $dbh = null; // اگر اتصال دیتابیس فعال بود، آن را ببندید.
    header("Location: {$actual_link}/login/login.php");
    exit();
}
?>