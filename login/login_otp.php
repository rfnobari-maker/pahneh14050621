<?php
$pahnehSecureCookie = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['SERVER_PORT']) && (string) $_SERVER['SERVER_PORT'] === '443');
if (PHP_VERSION_ID >= 70300) {
    session_set_cookie_params(array(
        'lifetime' => 0,
        'path' => '/',
        'secure' => $pahnehSecureCookie,
        'httponly' => true,
        'samesite' => 'Lax',
    ));
} else {
    session_set_cookie_params(0, '/', '', $pahnehSecureCookie, true);
}
session_start();

// --- امنیتی: مدیریت نشست و تلاش‌های ورود ---
// بررسی و تنظیم زمان انقضای نشست (30 دقیقه)
if (isset($_SESSION['last_acted_on']) && (time() - $_SESSION['last_acted_on'] > 1800)) { // 1800 seconds = 30 minutes
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['last_acted_on'] = time();

// پیگیری تعداد تلاش‌های ناموفق از سمت کاربر
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// --- پایان بخش امنیتی ---

include_once __DIR__ . '/zone_login_otp.php';

function loadUserForLogin($username) {
    global $dbh;
    $sql = $dbh->prepare("SELECT username, cod_m, Last_name, ostan, city, id_ostan, id_city, markaz, id_mar, name, jens, date_pas, password, psalt, id, Access, S_access, Last_name, pic, tel_m FROM users WHERE username = ?");
    $sql->execute(array($username));
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    return $row ? $row : null;
}

function finishAuthenticatedLogin($r, $myusername) {
    global $dbh;
    zone_otp_clear_challenge();
    $s_access = $r['S_access'];
    $PersName = $r['Last_name'];

    $_SESSION['login_user'] = $myusername;
    $_SESSION['karbar'] = $s_access;
    $_SESSION['last_acted_on'] = time();
    $_SESSION['title'] = 'سامانه جامع پهنه بندی و مدیریت داده های کشاورزی';
    $_SESSION['username'] = $r['username'];
    $_SESSION['cod_m'] = $r['cod_m'];
    $_SESSION['PersName'] = $r['Last_name'];
    $_SESSION['ostan'] = $r['ostan'];
    $_SESSION['city'] = $r['city'];
    $_SESSION['id_ostan'] = $r['id_ostan'];
    $_SESSION['id_city'] = $r['id_city'];
    $_SESSION['markaz'] = $r['markaz'];
    $_SESSION['id_mar'] = $r['id_mar'];
    $_SESSION['name'] = $r['name'];
    $_SESSION['jens'] = $r['jens'];
    $_SESSION['date_pas'] = $r['date_pas'];
    $_SESSION['v_jen'] = ($r['jens'] == 'مرد') ? 'آقای' : 'خانم';
    $_SESSION['pic'] = $r['pic'] ?: 'no_pic.png';

    // Set first page and user role
    $firstpage = 'index.php';
    switch ($s_access) {
        case 1: $firstpage = 'indexbenef.php'; $_SESSION['no_karbar'] = 'مروج کشاورزی '; break;
        case 2: $firstpage = 'Centers'; $_SESSION['no_karbar'] = 'رئیس مرکز '; break;
        case 3: $firstpage = 'Cities'; break;
        case 4: $firstpage = 'oChief'; break;
        case 5: $firstpage = 'Expert_aria'; break;
        case 6: $firstpage = 'Expert_sh'; break;
        case 7: $firstpage = 'Scholar'; break;
        case 8: $firstpage = 'Slaughterhouse'; break;
        case 20: $firstpage = 'Chief'; break;
        case 21: $firstpage = 'Dafa'; break;
        case 22: $firstpage = 'Gtc'; break;
        case 23: $firstpage = 'Cpis'; break;
        case 98: $firstpage = 'oasystem'; break;
        case 99: $firstpage = 'asystem'; break;
    }

    // Log last user access
    include(__DIR__ . '/../Jalali.php');
    $ip = getUserIP();
    date_default_timezone_set('Asia/Tehran');
    $date = jdate("Y/m/d");
    $time = date('H:i:s');
    $query = "INSERT INTO Last_user (date, time, ip, PersName, PersCode) VALUES (:date, :time, :ip, :PersName, :myusername)";
    $q = $dbh->prepare($query);
    $q->execute(array(':date' => $date, ':time' => $time, ':ip' => $ip, ':PersName' => $PersName, ':myusername' => $myusername));
    $dbh = null;

    header('Location: ../' . $firstpage);
    exit();
}

function zoneOtpRedirect($errorMessage, $infoMessage) {
    if ($errorMessage !== null) {
        $_SESSION['zone_otp_flash_error'] = $errorMessage;
    }
    if ($infoMessage !== null) {
        $_SESSION['zone_otp_flash_info'] = $infoMessage;
    }
    header('Location: login.php');
    exit();
}

$error = null;
$info = null;
if (isset($_SESSION['zone_otp_flash_error'])) {
    $error = $_SESSION['zone_otp_flash_error'];
    unset($_SESSION['zone_otp_flash_error']);
}
if (isset($_SESSION['zone_otp_flash_info'])) {
    $info = $_SESSION['zone_otp_flash_info'];
    unset($_SESSION['zone_otp_flash_info']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['otp_action'])) {
    $otpAction = (string) $_POST['otp_action'];
    if ($otpAction === 'cancel') {
        zone_otp_clear_challenge();
        zoneOtpRedirect(null, null);
    } elseif ($otpAction === 'resend') {
        include(__DIR__ . '/config.php');
        include_once __DIR__ . '/common.php';
        if (!isset($dbh) || $dbh === null) {
            zoneOtpRedirect('ورود اکنون ممکن نیست. دوباره تلاش کنید.', null);
        }
        $resent = zone_otp_resend($dbh);
        if (!$resent['ok']) {
            zoneOtpRedirect($resent['message'], null);
        }
        zoneOtpRedirect(null, $resent['message']);
    } elseif ($otpAction === 'verify') {
        $verified = zone_otp_verify();
        if (!$verified['ok']) {
            zoneOtpRedirect($verified['message'], null);
        }
        include(__DIR__ . '/config.php');
        include_once __DIR__ . '/common.php';
        if (!isset($dbh) || $dbh === null) {
            zone_otp_clear_challenge();
            zone_otp_clear_auth_session();
            zoneOtpRedirect('ورود اکنون ممکن نیست. دوباره تلاش کنید.', null);
        }
        $otpUser = $verified['username'];
        $otpRow = loadUserForLogin($otpUser);
        if (!$otpRow || trim((string) $otpRow['username']) !== trim((string) $otpUser)) {
            zone_otp_clear_challenge();
            zone_otp_clear_auth_session();
            zoneOtpRedirect('درخواست ورود پیدا نشد. دوباره نام کاربری و کلمه عبور را وارد کنید.', null);
        }
        if (!($otpRow['Access'] == 1)) {
            zone_otp_clear_challenge();
            zone_otp_clear_auth_session();
            zoneOtpRedirect('دسترسی شما به سامانه مسدود شده است', null);
        }
        if (!($otpRow['S_access'] == '1')) {
            zone_otp_clear_challenge();
            zone_otp_clear_auth_session();
            zoneOtpRedirect('وضعیت دسترسی شما تغییر کرده است. دوباره نام کاربری و کلمه عبور را وارد کنید.', null);
        }
        $_SESSION['login_attempts'] = 0;
        finishAuthenticatedLogin($otpRow, $otpRow['username']);
    } else {
        zoneOtpRedirect('درخواست ورود نامعتبر است. دوباره نام کاربری و کلمه عبور را وارد کنید.', null);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['otp_action'])) {
    include(__DIR__ . '/config.php');
    include_once __DIR__ . '/common.php';

    // امنیتی: افزایش تعداد تلاش‌های ناموفق
    $_SESSION['login_attempts']++;

    // امنیتی: اعمال تأخیر پس از 5 تلاش ناموفق
    if ($_SESSION['login_attempts'] > 5) {
        sleep(5); // 5 seconds delay
    }

    // Sanitize and validate security code
    $security_code_input = strtoupper($_POST['security_code']);
    $captcha_session = isset($_SESSION['security_code']) ? $_SESSION['security_code'] : '';

    if (strcmp(md5($security_code_input), $captcha_session) != 0) {
        $error = "کد امنیتی وارد شده صحیح نیست";
    } else {
        $myusername = $_POST['User_Name'];
        $mypass = $_POST['Pass'];

        $r = loadUserForLogin($myusername);

        if ($r) {
            $p = $r['password'];
            $p_salt = $r['psalt'];
            $access = $r['Access'];
            $s_access = $r['S_access'];

            // Salting and hashing the password
            $site_salt = "subinsblogsalt";
            $salted_hash = hash('sha256', $mypass . $site_salt . $p_salt);

            if ($p == $salted_hash) {
                // امنیتی: بازنشانی تعداد تلاش‌های ناموفق پس از ورود موفق
                $_SESSION['login_attempts'] = 0;

                if ($access == 1 && $s_access == '1') {
                    $phone = zone_otp_normalize_mobile(isset($r['tel_m']) ? $r['tel_m'] : '');
                    if ($phone === '') {
                        zone_otp_clear_challenge();
                        zone_otp_clear_auth_session();
                        $error = 'شماره همراه معتبری در پرونده شما ثبت نشده است. ورود انجام نشد.';
                    } else {
                        $started = zone_otp_start($r['username'], $phone);
                        if (!$started['ok']) {
                            $error = $started['message'];
                        } else {
                            zoneOtpRedirect(null, $started['message']);
                        }
                    }
                } elseif ($access == 1) {
                    finishAuthenticatedLogin($r, $myusername);
                } else {
                    $error = "دسترسی شما به سامانه مسدود شده است";
                }
            } else {
                $error = "نام کاربری یا کلمه عبور اشتباه است";
            }
        } else {
            $error = "نام کاربری یا کلمه عبور اشتباه است";
        }
    }
}

$otpPanel = zone_otp_panel();
if (is_array($otpPanel) && !empty($otpPanel['expired'])) {
    $otpPanel = null;
    if ($error === null) {
        $error = 'مهلت کد تأیید تمام شده است. دوباره نام کاربری و کلمه عبور را وارد کنید.';
    }
}
if (is_array($otpPanel)) {
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
}

function getUserIP() {
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سامانه جامع پهنه بندی و مدیریت داده های کشاورزی</title>
    <link rel="shortcut icon" href="../files/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link href="../FA.css" rel="stylesheet" type="text/css" />

    <script>
      if (!window.jQuery) {
        var s = document.createElement('script');
        s.src = "../assets/js/jquery-3.6.0.min.js";
        document.head.appendChild(s);
      }
    </script>
    <style>
        :root {
            --primary-color: #2980b9;
            --secondary-color: #2c3e50;
            --background-color: #ecf0f1;
            --card-background: #ffffff;
            --error-color: #e74c3c;
            --input-border: #bdc3c7;
            --placeholder-color: #7f8c8d;
        }

        body {
			overflow-x: hidden;
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--background-color);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            text-align: right;
            direction: rtl;
            padding-top: 50px; /* Add some padding to the top */
            
            /* --- استایل‌های جدید برای پس‌زمینه تمام‌صفحه --- */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;            /* --- پایان استایل‌های پس‌زمینه --- */
        }
        
        /* Main container for the login form */
.login-container {
    /* استفاده از rgba برای background-color */
    /* فرض می‌کنیم var(--card-background) به یک رنگ RGB (مثلاً سفید: 255, 255, 255) اشاره دارد */
    background-color: rgba(255, 255, 255, 0.95); /* اینجا 0.85 میزان شفافیت است (85% کدر، 15% شفاف) */
    
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    width: 400px;
    max-width: 90%;
    padding: 40px;
    box-sizing: border-box;
    transition: transform 0.3s ease-in-out;
    margin-bottom: 20px;
}
        .login-container:hover {
            transform: translateY(-5px);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: var(--secondary-color);
            font-size: 24px;
            margin: 0;
            font-weight: 700;
        }

        .login-header p {
            color: var(--placeholder-color);
            margin-top: 5px;
            font-size: 14px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid var(--input-border);
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: #f7f9fb;
        }

        .login-form input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 5px rgba(41, 128, 185, 0.3);
        }
        
        /* New CSS for the captcha section based on the image */
        .captcha-section {
            position: relative;
            margin-bottom: 20px;
        }

        .captcha-label {
            position: absolute;
            top: -12px;
            right: 15px;
            background-color: var(--card-background);
            padding: 0 5px;
            font-size: 14px;
            color: var(--secondary-color);
            z-index: 10;
        }

        .captcha-box-wrapper {
            border: 1px solid var(--input-border);
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            background-color: #f7f9fb;
        }

        .captcha-image-and-refresh {
            display: flex;
            align-items: center;
            justify-content: center; /* Centering the image */
            position: relative;
        }

        .captcha-image-and-refresh img {
            border: 1px solid var(--input-border);
            border-radius: 8px;
            height: 38px;
            width: 140px;
        }

        .captcha-image-and-refresh a {
            position: absolute; /* Positioning the refresh icon */
            right: 10px; /* Adjust as needed */
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--primary-color);
            transition: transform 0.2s ease-in-out;
            font-size: 18px; /* Smaller icon size */
        }

        .captcha-image-and-refresh a:hover {
            transform: translateY(-50%) rotate(30deg);
        }

        .captcha-input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--input-border);
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #ffffff;
            text-align: center;
        }
        /* End of new CSS */


        .login-button {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
			font-family:myfont2;
            font-size: 18px;
            font-weight: 500;
            transition: background-color 0.3s, transform 0.2s;
        }

        .login-button:hover {
            background-color: #21618c;
            transform: translateY(-2px);
        }

        .error-message {
            color: var(--error-color);
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            font-weight: 500;
        }

        .info-message {
            color: #1e8449;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            font-weight: 500;
        }

        .otp-hint {
            text-align: center;
            color: var(--secondary-color);
            font-size: 14px;
            line-height: 1.7;
            margin: 0 0 16px;
        }

        .otp-code {
            text-align: center;
            letter-spacing: 4px;
            direction: ltr;
        }

        .otp-mask {
            display: inline-flex;
            flex-direction: row;
            direction: ltr;
            unicode-bidi: isolate;
            white-space: nowrap;
            vertical-align: baseline;
        }

        .otp-mask span {
            direction: ltr;
            unicode-bidi: bidi-override;
        }

        .login-button-ghost {
            background-color: #ffffff;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            margin-top: 10px;
        }

        .otp-cancel {
            background: none;
            border: none;
            color: var(--placeholder-color);
            cursor: pointer;
            font-family: inherit;
            font-size: 14px;
            margin-top: 12px;
            width: 100%;
        }

        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }

        .forgot-password a {
            color: var(--placeholder-color);
            font-size: 14px;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .forgot-password a:hover {
            color: var(--primary-color);
        }

        /* News and Links Section */
        .news-links-container {
			width: 100%;
            max-width: 90%; /* یا یک مقدار ثابت مثل 1200px */
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin: 20px 0;
            background-color: var(--card-background);
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            box-sizing: border-box;
        }

        .news-section {
            background: radial-gradient(#CCC, #FFF);
            border-radius: 15px;
            padding: 15px;
            max-height: 250px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--primary-color) #f1f1f1;
        }

        .news-section p {
            margin: 0;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
        
        .news-section p:last-child {
            border-bottom: none;
        }
        
        .news-section .link {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .news-section .link:hover {
            color: #21618c;
        }
        
        .help-links-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .help-links-section h3 {
            color: var(--secondary-color);
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
        }
        
        .help-links-section a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--placeholder-color);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        
        .help-links-section a:hover {
            color: var(--primary-color);
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            transition: opacity 0.3s ease-in-out;
            opacity: 0;
            justify-content: center;
            align-items: center;
        }
        
        .modal-visible {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            position: relative;
            background-color: var(--card-background);
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 500px;
            max-width: 95%;
            height: 400px;
            overflow: hidden;
            transform: translateY(-50px);
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
            opacity: 0;
        }
        
        .modal-visible .modal-content {
            transform: translateY(0);
            opacity: 1;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 30px;
            color: #aaa;
            cursor: pointer;
            transition: color 0.3s;
        }

        .close:hover {
            color: var(--error-color);
        }
.footer-container {
    width: 100%;
    padding: 30px;
    background-image: linear-gradient(to right, #34495e, #2c3e50); /* گرادیان تیره */
    color: #ecf0f1; /* رنگ متن روشن */
    font-size: 15px;
    margin-top: 40px;
    box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1); /* سایه در بالا */
    text-align: center;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.footer-container p {
    margin: 5px 0;
    font-weight: 300;
}

.footer-container a {
    color: #3498db; /* رنگ آبی جذاب برای لینک‌ها */
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

.footer-container a:hover {
    color: #e74c3c; /* تغییر رنگ هنگام هاور */
}

.social-icons {
    margin-top: 20px;
}

.social-icons a {
    color: #ecf0f1;
    font-size: 24px;
    margin: 0 10px;
    transition: color 0.3s, transform 0.3s;
}

.social-icons a:hover {
    color: #3498db;
    transform: scale(1.2); /* افکت بزرگ شدن */
}
        /* New CSS for fade-in animation */
        .hidden-fade {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        
        .visible-fade {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body onload="new_captcha();">
    
    <div class="login-container hidden-fade" id="login-section">
        <div class="login-header">
          <img src="../files/jahad1.png" alt="Logo" width="150" height="130" style="width: 150px; margin-bottom: 15px;">
          <h2>مرکز فاوا</h2>
            <p>سامانه جامع پهنه بندی و مدیریت داده های کشاورزی</p>
      </div>
        
        <?php if (is_array($otpPanel)): ?>
        <div class="login-form">
         <p class="otp-hint" id="otp-expire-hint" data-left="<?php echo (int) $otpPanel['expires_in']; ?>">کد تأیید به شماره <?php echo zone_otp_mask_spans($otpPanel['mask']); ?><span id="otp-expire-rest"> ارسال شده است.</span></p>        <form action="" method="post">
                <input type="hidden" name="otp_action" value="verify">
                <input type="hidden" name="challenge_id" value="<?php echo htmlspecialchars($otpPanel['challenge_id'], ENT_QUOTES, 'UTF-8'); ?>">
                <div class="input-group">
                    <input class="otp-code" name="otp_code" type="text" inputmode="numeric" autocomplete="one-time-code" spellcheck="false" maxlength="12" placeholder="کد تأیید" required>
                </div>
                <button type="submit" class="login-button">تأیید و ورود</button>
            </form>
            <form action="" method="post">
                <input type="hidden" name="otp_action" value="resend">
                <input type="hidden" name="challenge_id" value="<?php echo htmlspecialchars($otpPanel['challenge_id'], ENT_QUOTES, 'UTF-8'); ?>">
                <button type="submit" class="login-button login-button-ghost">ارسال دوباره کد</button>
            </form>
            <p class="otp-hint" id="otp-resend-hint" data-wait="<?php echo (int) $otpPanel['resend_wait']; ?>"></p>
            <?php if (isset($info)): ?>
<div class="info-message">کد تأیید به شماره <?php echo zone_otp_mask_spans($otpPanel['mask']); ?> ارسال شد. اعتبار کد ۱۲۰ ثانیه است.</div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <form action="" method="post">
                <input type="hidden" name="otp_action" value="cancel">
                <button type="submit" class="otp-cancel">ورود با نام کاربری دیگر</button>
            </form>
        </div>
        <script>
            (function () {
                var hint = document.getElementById('otp-resend-hint');
                var expire = document.getElementById('otp-expire-hint');
                var expireRest = document.getElementById('otp-expire-rest');
                var wait = hint ? (parseInt(hint.getAttribute('data-wait'), 10) || 0) : 0;
                var left = expire ? (parseInt(expire.getAttribute('data-left'), 10) || 0) : 0;
                function render() {
                    var keepGoing = false;
                    if (expire) {
                        if (left > 0) {
                            if (expireRest) {
                                expireRest.textContent = ' ارسال شده است. این کد ' + left + ' ثانیه اعتبار دارد.';
                            }
                            left -= 1;
                            keepGoing = true;
                        } else {
                            expire.textContent = 'مهلت کد تأیید تمام شده است. برای دریافت کد جدید دوباره وارد شوید.';
                        }
                    }
                    if (hint) {
                        if (wait > 0) {
                            hint.textContent = 'ارسال دوباره تا ' + wait + ' ثانیه دیگر ممکن است.';
                            wait -= 1;
                            keepGoing = true;
                        } else {
                            hint.textContent = 'در صورت نرسیدن پیامک می‌توانید کد را دوباره ارسال کنید.';
                        }
                    }
                    if (keepGoing) {
                        setTimeout(render, 1000);
                    }
                }
                render();
            })();
        </script>
        <?php else: ?>
        <form action="" method="post" class="login-form">
            <div class="input-group">
                <input name="User_Name" type="text" placeholder="نام کاربری" tabindex="1" autocomplete="username" required>
            </div>
            <div class="input-group">
                <input name="Pass" type="password" placeholder="کلمه عبور" tabindex="2" autocomplete="current-password" required>
            </div>
            
            <div class="captcha-section">
                <label class="captcha-label">کد امنیتی</label>
                <div class="captcha-box-wrapper">
                    <div class="captcha-image-and-refresh">
                        <img border="0" id="captcha" src="image.php" alt="کد امنیتی">
                        <a  href="javascript:void(0);" onclick="new_captcha();"><i class="fas fa-redo-alt"></i></a>
                    </div>
                    <div class="captcha-input-group">
                        <input name="security_code" type="text" id="security_code" placeholder="کد امنیتی را وارد کنید" tabindex="3" autocomplete="off" required>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="login-button" tabindex="4">ورود</button>
            
            <?php if(isset($error)): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <div class="forgot-password">
                <p><a href="javascript:void(0);" onclick="openModal();">فراموشی رمز عبور؟</a></p>
            </div>
        </form>
        <?php endif; ?>
    </div>
    
    <div class="news-links-container hidden-fade" id="news-section">
        <h3>اخبار و تازه های سامانه</h3>
        <div class="news-section">
            <p dir="rtl"><img src="../files/jadid.gif" width="35" height="15"  alt=""/> آخرین تقسیمات کشوری مرکز آمار ایران در سال <span class="style8">1404</span>در سامانه اعمال و به‌روزرسانی گردید</p>
            <p dir="rtl"><img src="../files/jadid.gif" width="35" height="15"  alt=""/>لیست بهره‌برداران فوت‌شده در یک سال گذشته با استعلام از ثبت احوال، در سامانه به‌روز شد </p>
            <p dir="rtl"><img src="../files/jadid.gif" width="35" height="15"  alt=""/> گروه جدیدی تحت عنوان گیاهان داروئی به لیست محصولات باغی سال <span class="style8">1405 </span> اضافه شد  </p>
            <p dir="rtl"><img src="../files/jadid.gif" width="35" height="15"  alt=""/> ماژول ثبت و پیگیری درخواست تغییر الگوی کشت باغبانی ، طراحی و راه اندازی شد </p>
            <p dir="rtl"><img src="../files/jadid.gif" width="35" height="15"  alt=""/> ماژول ثبت و پیگیری درخواست تغییر الگوی کشت زراعت ، طراحی و راه اندازی شد </p>
            <p dir="rtl"><img src="../files/jadid.gif" width="35" height="15"  alt=""/> ثبت برش الگوی کشت شهرستانی و مراکز جهاد کشاورزی در سال زراعی <span class="style8">1405-1404</span> راه اندازی شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> امکان ثبت و پیگیری درخواست تغییر محصول/مساحت برای رکوردهایی مسدود شده <span class="style8">1405-1404</span> راه اندازی شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> امکان ثبت و پیگیری درخوست تغییر بهره بردار برای قطعات مسدود شده <span class="style8">1405-1404</span> راه اندازی شد  </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> سرشماری سراسری زنبورستان ها در سال <span class="style8">1404 </span>آغاز شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/>لیست بهره‌برداران فوت‌شده در یک سال گذشته با استعلام از ثبت احوال، در سامانه به‌روز شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> آخرین تقسیمات کشوری مرکز آمار ایران در سال <span class="style8">1403</span>در سامانه اعمال و به‌روزرسانی گردید</p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/>امکان ثبت و ویرایش اطلاعات عملکرد گلخانه و واحد پرورش قارچ <span class="style8">1404</span>فعال  شد</p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/>امکان ثبت و ویرایش اطلاعات گلخانه و واحد پرورش قارچ  <span class="style8">1403</span>مسدود  شد</p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات زراعی و صیفی <span class="style8">1405-1404 </span> فعال شد</p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/><a href="help/ab_1404.pdf" target="new" class="link">ابلاغیه معاون محترم وزیر در خصوص برنامه الگوی کشت محصولات زراعی سال 1405-1404 </a></p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات مزارع تکثیر و پرورش آبزیان <span class="style8"> 1404 </span> فعال  شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات مزارع تکثیر و پرورش آبزیان <span class="style8"> 1403 </span> مسدود  شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات باغی<span class="style8"> 1404 </span> فعال  شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات باغی<span class="style8"> 1403 </span>  مسدود  شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات زراعی  <span class="style8">1403-1402 </span> مسدود  شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> امکان ثبت توضیحات برای قطعات زراعی سال <span class="style8">1404-1403 </span>فراهم شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> سرشماری سراسری زنبورستان ها در سال <span class="style8">1403 </span>پایان یافت</p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> وب سرویس سامانه شاهکار به منظور تطبیق کد ملی و شماره همراه بهره برداران راه اندازی شد</p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> سرشماری سراسری زنبورستان ها در سال <span class="style8">1403 </span>آغاز شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/>امکان ثبت و ویرایش اطلاعات عملکرد گلخانه و واحد پرورش قارچ <span class="style8">1403</span>فعال  شد</p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/>امکان ثبت و ویرایش اطلاعات گلخانه و واحد پرورش قارچ  <span class="style8">1402</span>مسدود  شد</p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات باغی<span class="style8"> 1403 </span> فعال شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات باغی<span class="style8"> 1401 </span> مسدود شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات زراعی و صیفی <span class="style8">1403-1402 </span> فعال شد</p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> امکان ثبت و ویرایش اطلاعات زراعی و صیفی <span class="style8"></span> سال<span class="style8"> 1402-1401 </span><span class="style8"> </span>مسدود  شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات زراعی سال <span class="style8">1402-1401</span>  روز <span class="style8">شنبه  19 خرداد</span> مسدود خواهد شد <span class="style8"></span></p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> <a href="help/A_1403.pdf" target="new" class="link">نامه سرپرست محترم مرکز آمار فناوری اطلاعات و ارتباطات در خصوص ثبت اطلاعات </a></p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/><a href="help/kh_1.pdf" target="new" class="link">ابلاغیه قائم مقام محترم وزیر و معاون برنامه ریزی و امور اقتصادی در خصوص آمار</a></p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/>آغاز آمارگیری سراسری زنبورستان ها در سال <span class="style8">1402</span></p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش عملکرد<span class="style8"> 1402 </span> گلخانه و قارچ فعال شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش عملکرد<span class="style8"> 1401 </span> گلخانه و قارچ مسدود شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/>آمارگیری سراسری زنبورستان ها در سال <span class="style8">1402</span> از <span class="style8">15 </span>لغایت<span class="style8"> 27 </span>مهرماه ، انجام خواهد شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات باغی<span class="style8"> 1402 </span> فعال شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات باغی<span class="style8"> 1401 </span> مسدود شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت اطلاعات عملکرد<span class="style8"> دوازده ماهه </span> سال <span class="style8">1401 </span>صنایع کشاورزی راه اندازی شد </p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> ثبت و ویرایش اطلاعات زراعی و صیفی <span class="style8">1403-1402 </span> فعال شد</p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/><a href="https://biamar.maj.ir/ManagementReport/powerbi/PAHNE/PahneBIReport" target="new" class="link">داشبورد  پهنه بندی و مدیریت داده های کشاورزی</a></p>
            <p dir="rtl"><img src="../files/con_info.png" width="16" height="16"  alt=""/> دسترسی به سامانه فقط با آدرس <span class="style8">https://poud.maj.ir</span> مقدور شد </p>
            <p dir="rtl">&nbsp;</p>
        </div>
    </div>
    
    <div class="news-links-container hidden-fade" id="help-section">
        <h3>لینک‌های راهنما</h3>
        <div class="help-links-section">
            <a href="help/Change_Request.pdf" target="new"><i class="fas fa-file-pdf"></i>راهنمای ثبت و پیگیری درخواست تغییرات </a>
            <a href="help/Bee_form_1403.pdf" target="new"><i class="fas fa-file-pdf"></i>فرم درخواست بازدید از زنبورستان / خود اظهاری</a>
            <a href="help/centers.pdf" target="new"><i class="fas fa-file-pdf"></i>راهنمای سامانه ویژه روسای مراکز</a>
            <a href="help/Bee_1404.pptx" target="new"><i class="fas fa-file-powerpoint"></i>راهنمای آمارگیری زنبورستان های کشور در سال 1404</a>
            <a href="help/Bee_1404.pdf" target="new"><i class="fas fa-file-pdf"></i>آشنائی با تجهیزات و دستگاه های زنبورداری</a>
            <a href="help/Animal.pdf" target="new"><i class="fas fa-file-pdf"></i>راهنمای ثبت اطلاعات دام</a>
            <a href="help/S_ab_L2.pdf" target="new"><i class="fas fa-file-pdf"></i>دستورالعمل ثبت برش شهرستانی الگوئی کشت</a>
            <a href="help/admin.ppsx" target="new"><i class="fas fa-file-powerpoint"></i>راهنمای سامانه ویژه admin استان</a>
            <a href="help/Data1.xlsx" target="new"><i class="fas fa-file-excel"></i>فایل اکسل اقلام اطلاعاتی فرم های موجود</a>
            <a href="help/manager.ppsx" target="new"><i class="fas fa-file-powerpoint"></i>راهنمای سامانه ویژه مدیریت استان</a>
            <a href="help/Agri1.pdf" target="new"><i class="fas fa-file-pdf"></i>راهنمای تکمیل فرم زراعی</a>
            <a href="help/moravej.ppsx" target="new"><i class="fas fa-file-powerpoint"></i>راهنمای سامانه ویژه کارشناسان پهنه</a>
            <a href="help/Vega.pptx" target="new"><i class="fas fa-file-powerpoint"></i>راهنمای ثبت اطلاعات سبزی و صیفی</a>
            <a href="help/Bee1402.ppsx" target="new"><i class="fas fa-file-powerpoint"></i>راهنمای انتقال اطلاعات زراعی</a>
            <a href="help/Garden.pdf" target="new"><i class="fas fa-file-pdf"></i>راهنمای تکمیل فرم باغی</a>
            <a href="help/mushroom.pdf" target="new"><i class="fas fa-file-pdf"></i>راهنمای تکمیل فرم پرورش قارچ</a>
            <a href="help/Industry_new.pdf" target="new"><i class="fas fa-file-pdf"></i>راهنمای تکمیل فرم صنایع</a>
            <a href="help/Eworker.pdf" target="new"><i class="fas fa-file-pdf"></i>راهنماي ثبت اطلاعات مددکاران و تسهیلگران</a>
            <a href="help/Aquatic.pdf" target="new"><i class="fas fa-file-pdf"></i>راهنمای ثبت اطلاعات مزارع تکثیر و پرورش آبزیان</a>
            <a href="help/Green1401_2.pdf" target="new"><i class="fas fa-file-pdf"></i>راهنمای تکمیل فرم گلخانه</a>
            <a href="help/send_pic_new.pdf" target="new"><i class="fas fa-file-pdf"></i>دستورالعمل و برشورهای دفتر امور گلخانه ها و گیاهان زینت</a>
            <a href="https://pbiamar.maj.ir/ManagementReport/powerbi/Pahne/HomePahneBIReport" target="new"><i class="fas fa-link"></i>داشبورد مدیریتی پهنه بندی USER & PASS: pbiuser</a>
        </div>
    </div>
<div class="footer-container">
    <p>پشتیبانی: <a href="tel:02143541691">۴۳۵۴۱۶۹۱-۰۲۱</a></p>
    <p>کلیه حقوق مادی و معنوی این سامانه متعلق به مرکز فناوری اطلاعات و ارتباطات وزارت جهاد کشاورزی می باشد.</p>
</div> 
   <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <iframe id="forgetIframe" width="100%" height="100%" style="border: none; border-radius: 15px;"></iframe>
        </div>
    </div>
    
    <script>
        // Function to refresh the captcha image
        function new_captcha() {
            var captchaImage = document.getElementById('captcha');
            if (!captchaImage) {
                return;
            }
            var c_currentTime = new Date();
            var c_miliseconds = c_currentTime.getTime();
            captchaImage.src = 'image.php?x=' + c_miliseconds;
        }

        // Functions for the modal
        function openModal() {
            document.getElementById("forgetIframe").src = "../forget.php";
            document.getElementById("modal").classList.add("modal-visible");
        }

        function closeModal() {
            document.getElementById("modal").classList.remove("modal-visible");
            // Give a short delay to allow the CSS transition to finish before clearing the iframe
            setTimeout(function() {
                document.getElementById("forgetIframe").src = "";
            }, 300);
        }

        // New script for delayed fade-in animation on scroll
        document.addEventListener("DOMContentLoaded", function() {
            const hiddenElements = document.querySelectorAll('.hidden-fade');

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible-fade');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.2 }); // Trigger when 20% of the element is visible

            hiddenElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
    <script>
    // یک آرایه از نام فایل‌های تصویری ایجاد کنید
    const images = ['5.jpg', '41.jpg', '43.jpg', '6.jpg', '7.jpg' , '8.jpg'];

    // یک عدد تصادفی بین ۰ تا ۲ تولید کنید
    const randomIndex = Math.floor(Math.random() * images.length);

    // نام فایل تصویر تصادفی را از آرایه انتخاب کنید
    const randomImage = images[randomIndex];

    // عنصر body را انتخاب کنید
    const body = document.body;

    // تصویر پس‌زمینه را به صورت تصادفی تنظیم کنید
    body.style.backgroundImage = `url('./images/${randomImage}')`;
</script>
</body>
</html>