<?php
// ۱. بارگذاری فایل‌های مورد نیاز
// فرض می‌شود این فایل‌ها متغیرهای $dbh (اتصال PDO) و $_SESSION['login_user'], $login_session, $date_pas, $id_mar, $id_ostan را تنظیم می‌کنند.
include ('../lock_p2.php');
include('../login/config.php');

// متغیرهای مورد نیاز را از SESSION استخراج می‌کنیم (اگر هنوز تعریف نشده‌اند)
$login_session = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : '';
// متغیرهای دیگر مانند $date_pas, $id_mar, $id_ostan نیز باید در جایی تعریف شده باشند. 
// برای امنیت، بهتر است برای کوئری‌ها از متغیرهای مرتبط با سشن مستقیماً استفاده شود.

// --- بررسی وضعیت پروفایل ---
// استفاده از Prepared Statement برای جلوگیری از SQL Injection
$query = "SELECT pic, fname FROM users WHERE username = ?";
$stmt = $dbh->prepare($query);
// از $_SESSION['login_user'] به طور مستقیم در bindParam استفاده می‌کنیم.
$stmt->bindParam(1, $_SESSION['login_user']); 
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row || $row['pic'] === '' || $row['fname'] === '') // اضافه کردن چک کردن $row برای حالت خطای کوئری یا عدم وجود کاربر
{
    // از exit/die بعد از header استفاده کنید تا اجرای اسکریپت متوقف شود
    header("Location: profile.php?a");
    exit; 
}

// --- بروز رسانی رمز (انقضای رمز) ---
// تنظیم منطقه زمانی: به دلیل تاریخچه، این بخش در PHP 5.3.3 متداول است.
date_default_timezone_set('Asia/Tehran');
// محاسبه تاریخ انقضا
$v_date = date("Y-m-d", strtotime('-120 days')); 

// فرض بر این است که $date_pas از دیتابیس یا سشن لود شده است.
// مقایسه تاریخ‌ها با استفاده از strtotime
if (isset($date_pas) && strtotime($date_pas) < strtotime($v_date)) {
    header("Location: expaire_pass.php");
    exit; 
}

// --- پیام جدید (پیام‌های خوانده نشده) ---
// استفاده از Prepared Statement با پارامتر نام‌گذاری شده یا علامت سوال
$query_pm = "SELECT COUNT(ru_read) FROM pm WHERE r_user = ? AND ru_read = '1'";
$stmt_pm = $dbh->prepare($query_pm);
$stmt_pm->bindParam(1, $login_session);
$stmt_pm->execute();
// کارایی بیشتر: استفاده از FETCH_COLUMN برای کوئری‌های COUNT
$count_pm = $stmt_pm->fetchColumn(); 

if ($count_pm > 0) {
    header("Location: rec_msg_notseen.php?unread");
    exit; 
}

// --- تعیین وضعیت همکار (بخش کامنت شده) ---
/*
// اگر این بخش نیاز به فعالسازی دارد، حتماً از Prepared Statements استفاده کنید.
// $query_u = "SELECT COUNT(status) FROM users WHERE (status = '' OR date_status < '1403/08/29') AND S_access = '1' AND id_mar = ?";
// $stmt_u = $dbh->prepare($query_u);
// $stmt_u->bindParam(1, $id_mar);
// $stmt_u->execute();
// $count_u = $stmt_u->fetchColumn(); 
// if ($count_u > 0) {
//     header("Location: last_status2.php");
//     exit;
// }
*/

// --- شمارش موارد لیست آبادی ---
// استفاده از COUNT(*) و Prepared Statement
$query_abadi = "SELECT COUNT(*) FROM list_abadi WHERE id_ostan = ? AND id_mar = ?";
$stmt_abadi = $dbh->prepare($query_abadi);
$stmt_abadi->bindParam(1, $id_ostan);
$stmt_abadi->bindParam(2, $id_mar);
$stmt_abadi->execute();
$count = $stmt_abadi->fetchColumn(); // نام متغیر اصلی حفظ شده است

// --- شمارش موارد لیست شهر ---
// استفاده از COUNT(*) و Prepared Statement
$query_city = "SELECT COUNT(*) FROM list_city WHERE id_ostan = ? AND id_mar = ?";
$stmt_city = $dbh->prepare($query_city);
$stmt_city->bindParam(1, $id_ostan);
$stmt_city->bindParam(2, $id_mar);
$stmt_city->execute();
$count_city = $stmt_city->fetchColumn(); // نام متغیر اصلی حفظ شده است

// --- شمارش کاربران منطقه‌ای (مور) ---
// استفاده از COUNT(*) و Prepared Statement
$query_mor = "SELECT COUNT(*) FROM users WHERE id_ostan = ? AND id_mar = ? AND S_access = '1'";
$stmt_mor = $dbh->prepare($query_mor);
$stmt_mor->bindParam(1, $id_ostan);
$stmt_mor->bindParam(2, $id_mar);
$stmt_mor->execute();
$count_mor = $stmt_mor->fetchColumn(); 

// --- شمارش کل کاربران با دسترسی (کول) ---
// استفاده از COUNT(*)
$query_kol = "SELECT COUNT(*) FROM users WHERE S_access = '1'";
$stmt_kol = $dbh->prepare($query_kol);
$stmt_kol->execute();
$count_kol = $stmt_kol->fetchColumn(); 

// $dbh = null; // اتصال PDO باید در انتهای اسکریپت یا فایلی که آن را قطع می‌کند بسته شود.
?>

<?php
// --- توابع کمکی ---

/**
 * شمارش آبادی‌های یک کاربر/منطقه خاص
 * @param string $mor_cod_m کد مور
 * @param string $id_ostan کد استان
 * @return int تعداد آبادی‌ها
 */
function mor_abadi_count($mor_cod_m, $id_ostan)
{
    // استفاده از global $dbh در PHP 5.3.3 متداول است، اما تزریق وابستگی (Dependency Injection) بهتر است.
    global $dbh; 
    $query = "SELECT COUNT(*) FROM list_abadi WHERE id_ostan = ? AND mor_cod_m = ?";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(1, $id_ostan);
    $stmt->bindParam(2, $mor_cod_m);
    $stmt->execute();
    $count_abadi = $stmt->fetchColumn(); // استفاده از fetchColumn
    // $dbh = null; // قطع اتصال در داخل تابع درست نیست، چون اتصال سراسری است
    return $count_abadi; 	
}

/**
 * شمارش موارد 'bah' برای یک کاربر/منطقه خاص
 * @param string $mor_cod_m کد مور
 * @param string $id_ostan کد استان
 * @return int تعداد موارد 'bah'
 */
function mor_bah_count($mor_cod_m, $id_ostan)
{
    global $dbh; 
    $query = "SELECT COUNT(id) FROM bah WHERE id_ostan = ? AND mor_cod_m = ?";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(1, $id_ostan);
    $stmt->bindParam(2, $mor_cod_m);
    $stmt->execute();
    $count_bah = $stmt->fetchColumn(); // استفاده از fetchColumn
    return $count_bah; 	
}

/**
 * شمارش شهرهای یک کاربر/منطقه خاص
 * @param string $mor_cod_m کد مور
 * @param string $id_ostan کد استان
 * @return int تعداد شهرها
 */
function mor_shahr_count($mor_cod_m, $id_ostan)
{
    global $dbh; 
    $query = "SELECT COUNT(id) FROM list_city WHERE id_ostan = ? AND mor_cod_m = ?";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(1, $id_ostan);
    $stmt->bindParam(2, $mor_cod_m);
    $stmt->execute();
    $count_shahr = $stmt->fetchColumn(); 
    return $count_shahr; 	
}

/**
 * شمارش موارد 'bah' برای یک آبادی خاص
 * @param string $add_abadi آدرس آبادی
 * @return int تعداد موارد 'bah'
 */
function abadi_bah_count($add_abadi)
{
    global $dbh; 
    $query = "SELECT COUNT(id) FROM bah WHERE add_abadi = ?";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(1, $add_abadi);
    $stmt->execute();
    $count_abadi_bah = $stmt->fetchColumn(); 
    return $count_abadi_bah; 	
}

/**
 * شمارش موارد 'bah' برای یک شهر خاص
 * @param string $add_city آدرس شهر
 * @return int تعداد موارد 'bah'
 */
function shahr_bah_count($add_city)
{
    global $dbh; 
    $query = "SELECT COUNT(id) FROM bah WHERE add_city = ?";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(1, $add_city);
    $stmt->execute();
    $count_city_bah = $stmt->fetchColumn(); 
    return $count_city_bah; 	
}
?>