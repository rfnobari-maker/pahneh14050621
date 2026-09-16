<?php
// شروع Session به صورت شرطی
if (session_id() == '') {
    session_start();
}

$title = 'سامانه جامع پهنه بندی و مدیریت داده های کشاورزی';

// بررسی وجود متغیرهای session
$user_check = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;
$karbar_m = isset($_SESSION['karbar']) ? $_SESSION['karbar'] : null;

// اگر کاربری لاگین نکرده، به صفحه لاگین هدایت شود
if ($user_check === null) {
    header("Location: /login/login.php");
    exit();
}

include('login/config.php');
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

// بررسی انقضای session (30 دقیقه)
if (isset($_SESSION["last_acted_on"]) && (time() - $_SESSION["last_acted_on"] > 60 * 30)) {
    $_SESSION = array();
    session_destroy();
    header("Location:".$actual_link."/login/login.php");
    exit();
} else {
    $_SESSION["last_acted_on"] = time();
}

// استفاده از Prepared Statements برای جلوگیری از SQL Injection
$query = "SELECT date_pas, username, Last_name, ostan, id_ostan, city, id_city, markaz, name, id_mar, pic, jens FROM users WHERE username = ? AND S_access = '2'";
$stmt = $dbh->prepare($query);
$stmt->execute(array($user_check));

$row = $stmt->fetch(PDO::FETCH_ASSOC);
$dbh = null;

// اگر کاربر در پایگاه داده پیدا نشد، یا سطح دسترسی اشتباه بود
if (!$row) {
    $_SESSION = array();
    session_destroy();
    header("Location:".$actual_link."/login/login.php");
    exit();
}

// ذخیره اطلاعات کاربر در session برای استفاده مجدد و کاهش کوئری
$_SESSION['user_data'] = $row;
$login_session = $row['username'];
$PersName = $row['Last_name'];
$euser = $PersName;
$ostan = $row['ostan'];
$id_ostan = $row['id_ostan'];
$city = $row['city'];
$id_city = $row['id_city'];
$mor_id_city = $row['id_city'];
$markaz = $row['markaz'];
$name = $row['name'];
$id_mar = $row['id_mar'];
$pic = $row['pic'];
$jens = $row['jens'];
$date_pas = $row['date_pas'];

if ($jens == 'مرد') {
    $v_jen = 'آقای';
} else if ($jens == 'زن') {
    $v_jen = 'خانم';
}

if ($pic == '') {
    $pic = 'no_pic.png';
}

$no_karbar = 'رئیس مرکز';

// بررسی نهایی برای اطمینان از لاگین بودن
if(!isset($login_session)) {
    header("Location:".$actual_link."/login/login.php");
    exit();
}
?>