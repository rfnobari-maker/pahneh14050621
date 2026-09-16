<?php
require_once dirname(__FILE__) . '/session.php';
dash_session_boot();

function dash_login_h($s)
{
    return htmlspecialchars($s . '', ENT_QUOTES, 'UTF-8');
}

$today = dash_today();
if (!empty($_SESSION['dash_user']) && !empty($_SESSION['dash_day']) && $_SESSION['dash_day'] === $today) {
    header('Location: index.php');
    exit;
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['dash_login_attempts'])) {
        $_SESSION['dash_login_attempts'] = 0;
    }
    $_SESSION['dash_login_attempts']++;
    if ($_SESSION['dash_login_attempts'] > 5) {
        sleep(5);
    }

    $codeIn = isset($_POST['security_code']) ? strtoupper(trim($_POST['security_code'] . '')) : '';
    $codeSes = isset($_SESSION['dash_captcha']) ? $_SESSION['dash_captcha'] : '';
    if ($codeSes === '' || strcmp(md5($codeIn), $codeSes) !== 0) {
        $error = 'کد امنیتی وارد شده صحیح نیست';
    } else {
        $cfg = dirname(__FILE__) . '/../login/config.php';
        $acc = dirname(__FILE__) . '/../login/sys_access.php';
        if (!is_file($cfg) || !is_file($acc)) {
            $error = 'فایل تنظیمات ورود روی سرور یافت نشد.';
        } else {
            require_once $cfg;
            require_once $acc;
            $myusername = isset($_POST['User_Name']) ? trim($_POST['User_Name'] . '') : '';
            $mypass = isset($_POST['Pass']) ? $_POST['Pass'] : '';
            $r = (isset($dbh) && $dbh) ? pahneh_sys_fetch_user($dbh, $myusername) : false;
            if ($r) {
                $salted_hash = hash('sha256', $mypass . 'subinsblogsalt' . $r['psalt']);
                if ($r['password'] === $salted_hash) {
                    $accessOn = isset($r['Access']) && ((int) $r['Access'] === 1 || $r['Access'] === '1');
                    if (!$accessOn) {
                        $error = 'دسترسی شما به سامانه مسدود شده است';
                    } elseif (!pahneh_sys_can($r, 'dash')) {
                        $error = 'دسترسی شما به داشبورد مدیریتی فعال نیست';
                    } else {
                        $_SESSION['dash_login_attempts'] = 0;
                        unset($_SESSION['dash_captcha']);
                        $_SESSION['dash_user'] = $r['username'];
                        $_SESSION['login_user'] = $r['username'];
                        $_SESSION['dash_day'] = dash_today();
                        $_SESSION['karbar'] = $r['S_access'];
                        $_SESSION['PersName'] = $r['Last_name'];
                        $_SESSION['id_ostan'] = $r['id_ostan'];
                        $_SESSION['id_city'] = $r['id_city'];
                        $_SESSION['id_mar'] = $r['id_mar'];
                        $_SESSION['name'] = $r['name'];
                        $_SESSION['pic'] = !empty($r['pic']) ? $r['pic'] : 'no_pic.png';

                        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
                        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                            $ip = $_SERVER['HTTP_CLIENT_IP'];
                        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                        }
                        $ipParts = explode(':', $ip);
                        $ip = $ipParts[0];

                        $jalali = dirname(__FILE__) . '/../Jalali.php';
                        if (is_file($jalali) && !function_exists('jdate')) {
                            include $jalali;
                        }
                        date_default_timezone_set('Asia/Tehran');
                        $date = function_exists('jdate') ? jdate('Y/m/d') : date('Y/m/d');
                        $time = date('H:i:s');
                        if (isset($dbh) && $dbh) {
                            try {
                                $q = $dbh->prepare('INSERT INTO Last_user (date, time, ip, PersName, PersCode) VALUES (:date, :time, :ip, :PersName, :myusername)');
                                if ($q) {
                                    $q->execute(array(
                                        ':date' => $date,
                                        ':time' => $time,
                                        ':ip' => $ip,
                                        ':PersName' => $r['Last_name'],
                                        ':myusername' => $r['username'],
                                    ));
                                }
                            } catch (Exception $e) {
                            }
                        }

                        header('Location: index.php');
                        exit;
                    }
                } else {
                    $error = 'نام کاربری یا کلمه عبور اشتباه است';
                }
            } else {
                $error = 'نام کاربری یا کلمه عبور اشتباه است';
            }
        }
    }
}

$userVal = isset($_POST['User_Name']) ? dash_login_h($_POST['User_Name']) : '';
$errCaptcha = ($error === 'کد امنیتی وارد شده صحیح نیست');
$errAuth = ($error === 'نام کاربری یا کلمه عبور اشتباه است');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به داشبورد مدیریتی | مپکا</title>
    <link rel="shortcut icon" href="../files/images/favicon.ico" type="image/x-icon">
    <style>
        @font-face {
            font-family: YekanBakh;
            src: url("../assets/fonts/Yekan-Bakh-Fa-En-04-Regular.woff") format("woff");
            font-weight: 400;
            font-display: swap;
        }
        @font-face {
            font-family: YekanBakh;
            src: url("../assets/fonts/Yekan-Bakh-Fa-En-05-Medium.woff") format("woff");
            font-weight: 500;
            font-display: swap;
        }
        @font-face {
            font-family: YekanBakh;
            src: url("../assets/fonts/Yekan-Bakh-Fa-En-06-Bold.woff") format("woff");
            font-weight: 700;
            font-display: swap;
        }
        @font-face {
            font-family: YekanBakh;
            src: url("../assets/fonts/Yekan-Bakh-Fa-En-07-Heavy.woff") format("woff");
            font-weight: 800;
            font-display: swap;
        }
        :root {
            --ink: #06140C;
            --forest: #0C2418;
            --canopy: #163524;
            --leaf: #1F6B45;
            --gold: #C9A227;
            --gold-soft: #E8D48B;
            --cream: #F6F1E7;
            --paper: #FFFCF6;
            --text: #14221A;
            --muted: #4A5A51;
            --line: #DDD3BE;
            --danger: #B42318;
            --danger-bg: #FDECEC;
            --ring: #C9A227;
            --touch: 48px;
            --radius: 28px;
            --ease: cubic-bezier(.22, 1, .36, 1);
        }
        * { box-sizing: border-box; }
        html {
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
        }
        body {
            margin: 0;
            min-height: 100vh;
            min-height: 100dvh;
            font-family: YekanBakh, Tahoma, "Segoe UI", sans-serif;
            font-size: 16px;
            line-height: 1.65;
            color: var(--text);
            background:
                radial-gradient(50% 40% at 80% 0%, rgba(201, 162, 39, 0.14), transparent 55%),
                radial-gradient(45% 50% at 10% 100%, rgba(31, 107, 69, 0.22), transparent 50%),
                #07110C;
            display: grid;
            place-items: center;
            padding: max(16px, env(safe-area-inset-top)) max(16px, env(safe-area-inset-right)) max(16px, env(safe-area-inset-bottom)) max(16px, env(safe-area-inset-left));
        }
        .auth {
            width: min(1120px, 100%);
            min-height: min(720px, calc(100dvh - 32px));
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            border-radius: var(--radius);
            overflow: hidden;
            background: var(--paper);
            box-shadow:
                0 40px 80px rgba(0, 0, 0, 0.38),
                0 0 0 1px rgba(232, 212, 139, 0.12);
        }
        .auth-stage {
            position: relative;
            isolation: isolate;
            color: var(--cream);
            background:
                radial-gradient(80% 70% at 0% 0%, rgba(201, 162, 39, 0.18), transparent 55%),
                linear-gradient(165deg, #10281C 0%, var(--ink) 58%, #08150E 100%);
            padding: 40px 36px 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }
        .auth-orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }
        .auth-orb-gold {
            width: 280px;
            height: 280px;
            top: -90px;
            left: -50px;
            background: radial-gradient(circle, rgba(201, 162, 39, 0.32), transparent 68%);
            animation: drift 16s var(--ease) infinite;
        }
        .auth-orb-leaf {
            width: 340px;
            height: 340px;
            right: -120px;
            bottom: 8%;
            background: radial-gradient(circle, rgba(31, 107, 69, 0.45), transparent 70%);
            animation: drift 22s var(--ease) infinite reverse;
        }
        .auth-fields {
            position: absolute;
            inset: auto 0 0 0;
            height: 46%;
            z-index: 0;
            background:
                repeating-linear-gradient(-14deg, transparent 0 22px, rgba(232, 212, 139, 0.05) 22px 23px),
                linear-gradient(180deg, transparent, rgba(6, 20, 12, 0.78));
            pointer-events: none;
        }
        .auth-grain {
            position: absolute;
            inset: 0;
            z-index: 1;
            opacity: 0.18;
            pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.55'/%3E%3C/svg%3E");
        }
        .auth-stage-top,
        .auth-stage-mid,
        .auth-stage-foot {
            position: relative;
            z-index: 2;
        }
        .auth-kicker {
            margin: 0 0 18px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            letter-spacing: 0.08em;
            color: var(--gold-soft);
            font-weight: 500;
        }
        .auth-kicker::before {
            content: "";
            width: 22px;
            height: 1px;
            background: var(--gold);
        }
        .auth-emblem-wrap {
            width: 118px;
            height: 118px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            margin-bottom: 22px;
            background: radial-gradient(circle, rgba(255, 252, 246, 0.08), transparent 70%);
            box-shadow: 0 0 0 1px rgba(201, 162, 39, 0.35), 0 0 40px rgba(201, 162, 39, 0.12);
        }
        .auth-emblem {
            display: block;
            width: 96px;
            height: auto;
            object-fit: contain;
        }
        .auth-org {
            margin: 0 0 8px;
            font-size: clamp(1.45rem, 2.4vw, 2rem);
            font-weight: 800;
            line-height: 1.45;
            color: #FFFCF6;
        }
        .auth-aka {
            margin: 0 0 16px;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            color: var(--gold);
        }
        .auth-mission {
            margin: 0;
            max-width: 26em;
            color: rgba(246, 241, 231, 0.78);
            font-size: 15px;
        }
        .auth-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 28px 0 0;
            padding: 0;
            list-style: none;
        }
        .auth-pills li {
            padding: 6px 12px;
            border-radius: 999px;
            border: 1px solid rgba(201, 162, 39, 0.28);
            background: rgba(255, 252, 246, 0.04);
            color: var(--gold-soft);
            font-size: 12px;
            font-weight: 500;
        }
        .auth-stage-foot {
            margin: 32px 0 0;
            font-size: 13px;
            color: rgba(246, 241, 231, 0.62);
        }
        .auth-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px 40px 28px;
            background:
                linear-gradient(180deg, rgba(255, 252, 246, 0.96), #F4EFE4);
        }
        .auth-card {
            width: min(420px, 100%);
            margin: 0 auto;
            animation: rise 0.55s var(--ease) both;
        }
        .auth-eyebrow {
            margin: 0 0 8px;
            color: var(--leaf);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.04em;
        }
        h1 {
            margin: 0 0 8px;
            font-size: clamp(1.45rem, 2vw, 1.85rem);
            font-weight: 800;
            line-height: 1.35;
            color: var(--ink);
        }
        .auth-lead {
            margin: 0 0 28px;
            color: var(--muted);
            font-size: 14.5px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .field label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            font-size: 14px;
            color: var(--forest);
        }
        .field-control {
            position: relative;
        }
        .field-icon {
            position: absolute;
            top: 50%;
            right: 14px;
            width: 20px;
            height: 20px;
            transform: translateY(-50%);
            color: #7C8B80;
            pointer-events: none;
        }
        .field-icon svg,
        .field-toggle svg,
        .auth-captcha-refresh svg,
        .auth-error svg,
        .auth-submit .spin {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.75;
            stroke-linecap: round;
            stroke-linejoin: round;
            display: block;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            min-height: var(--touch);
            padding: 0 46px 0 14px;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: #fff;
            color: var(--text);
            font-family: inherit;
            font-size: 16px;
            box-shadow: 0 1px 0 rgba(20, 34, 26, 0.04);
            transition: border-color 180ms ease, box-shadow 180ms ease;
        }
        input[type="password"] {
            padding-left: 48px;
        }
        #security_code {
            padding: 0 14px;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            font-weight: 700;
            text-align: center;
        }
        input::placeholder { color: #94A39A; }
        input:hover { border-color: #C4B79A; }
        input[aria-invalid="true"] {
            border-color: var(--danger);
            background: #FFF8F8;
        }
        input:focus,
        button:focus-visible,
        .auth-vendor a:focus-visible {
            outline: 3px solid rgba(201, 162, 39, 0.55);
            outline-offset: 2px;
            border-color: var(--gold);
        }
        .field-toggle {
            position: absolute;
            top: 50%;
            left: 6px;
            width: 40px;
            height: 40px;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #5A6B61;
            cursor: pointer;
            display: grid;
            place-items: center;
            border-radius: 10px;
        }
        .field-toggle:hover { color: var(--forest); background: rgba(12, 36, 24, 0.05); }
        .auth-captcha-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }
        .auth-captcha-img {
            display: block;
            width: 152px;
            height: 52px;
            border-radius: 12px;
            background: #E7DCC4;
        }
        .auth-captcha-refresh {
            width: var(--touch);
            height: var(--touch);
            border: 1px solid var(--line);
            border-radius: 14px;
            background: #fff;
            color: var(--forest);
            cursor: pointer;
            display: grid;
            place-items: center;
            padding: 0;
            flex: 0 0 auto;
            transition: border-color 180ms ease, background 180ms ease, transform 180ms var(--ease);
        }
        .auth-captcha-refresh:hover {
            border-color: var(--gold);
            background: #FFF8EA;
        }
        .auth-captcha-refresh.is-spin svg { animation: spin 0.7s linear; }
        .auth-error {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 0;
            padding: 12px 14px;
            border-radius: 14px;
            background: var(--danger-bg);
            color: var(--danger);
            font-size: 14px;
            font-weight: 500;
            border: 1px solid rgba(180, 35, 24, 0.16);
        }
        .auth-error svg { flex: 0 0 auto; margin-top: 1px; }
        .auth-submit {
            min-height: var(--touch);
            margin-top: 6px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(180deg, #D4AF37, #A97C12);
            color: #1A1404;
            font-family: inherit;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 10px 22px rgba(169, 124, 18, 0.28);
            transition: transform 180ms var(--ease), filter 180ms ease, box-shadow 180ms ease;
        }
        .auth-submit:hover { filter: brightness(1.05); box-shadow: 0 14px 26px rgba(169, 124, 18, 0.36); }
        .auth-submit:active { transform: translateY(1px); }
        .auth-submit.is-busy {
            pointer-events: none;
            filter: saturate(0.85);
        }
        .auth-submit .spin { display: none; }
        .auth-submit.is-busy .spin { display: block; animation: spin 0.8s linear infinite; }
        .auth-note {
            margin: 18px 0 0;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }
        .auth-vendor {
            width: min(420px, 100%);
            margin: 28px auto 0;
            text-align: center;
        }
        .auth-vendor p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }
        .auth-vendor a {
            color: var(--forest);
            font-weight: 700;
            text-decoration: none;
            border-bottom: 1px solid rgba(12, 36, 24, 0.28);
            display: inline-flex;
            align-items: center;
            min-height: 44px;
        }
        .auth-vendor a:hover { color: #A97C12; border-bottom-color: #A97C12; }
        @keyframes rise {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes drift {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(18px, 10px); }
        }
        @keyframes spin { to { transform: rotate(-360deg); } }
        @media (max-width: 900px) {
            .auth {
                grid-template-columns: 1fr;
                min-height: 0;
            }
            .auth-stage {
                padding: 24px 22px 20px;
                min-height: 0;
            }
            .auth-emblem-wrap {
                width: 84px;
                height: 84px;
                margin-bottom: 12px;
            }
            .auth-emblem { width: 68px; }
            .auth-org { font-size: 1.25rem; }
            .auth-pills,
            .auth-mission,
            .auth-stage-foot { display: none; }
            .auth-aka { margin-bottom: 0; }
            .auth-fields { height: 34%; }
            .auth-panel { padding: 28px 20px 20px; }
        }
        @media (max-width: 420px) {
            body { padding: 0; }
            .auth { border-radius: 0; min-height: 100dvh; }
            .auth-captcha-img { width: 132px; height: 46px; }
        }
        @media (prefers-reduced-motion: reduce) {
            .auth-card,
            .auth-orb-gold,
            .auth-orb-leaf,
            .auth-submit,
            .auth-captcha-refresh,
            .auth-submit .spin {
                animation: none;
                transition: none;
            }
        }
    </style>
</head>
<body>
    <div class="auth">
        <aside class="auth-stage">
            <div class="auth-orb auth-orb-gold" aria-hidden="true"></div>
            <div class="auth-orb auth-orb-leaf" aria-hidden="true"></div>
            <div class="auth-fields" aria-hidden="true"></div>
            <div class="auth-grain" aria-hidden="true"></div>
            <div class="auth-stage-top">
                <p class="auth-kicker">وزارت جهاد کشاورزی</p>
                <div class="auth-emblem-wrap">
                    <img class="auth-emblem" src="../files/jahad-white.png" width="96" height="96" alt="آرم وزارت جهاد کشاورزی">
                </div>
            </div>
            <div class="auth-stage-mid">
                <p class="auth-org">مرکز پایش اطلاعات کشاورزی ایران</p>
                <p class="auth-aka"><span dir="ltr">MAPKA</span> · مپکا</p>
                <p class="auth-mission">سامانه جامع پهنه‌بندی و مدیریت داده‌های.</p>
                <p class="auth-mission">تصویر کلان از سطح کشور تا پهنه.</p>
                <ul class="auth-pills">
                    <li>پهنه‌بندی</li>
                    <li>پایش تولید</li>
                </ul>
            </div>
            <p class="auth-stage-foot">نشست تا پایان امروز معتبر است</p>
        </aside>
        <main class="auth-panel">
            <div class="auth-card">
                <p class="auth-eyebrow">داشبورد مدیریتی</p>
                <h1>ورود به سامانه</h1>
                <p class="auth-lead">با حساب سازمانی خود وارد شوید. نشست تا پایان امروز برقرار می‌ماند.</p>
                <form method="post" action="" id="dash-login-form">
                    <div class="field">
                        <label for="User_Name">نام کاربری</label>
                        <div class="field-control">
                            <span class="field-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </span>
                            <input id="User_Name" name="User_Name" type="text" autocomplete="username" required autofocus spellcheck="false" value="<?php echo $userVal; ?>"<?php echo $errAuth ? ' aria-invalid="true"' : ''; ?>>
                        </div>
                    </div>
                    <div class="field">
                        <label for="Pass">کلمه عبور</label>
                        <div class="field-control">
                            <span class="field-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input id="Pass" name="Pass" type="password" autocomplete="current-password" required<?php echo $errAuth ? ' aria-invalid="true"' : ''; ?>>
                            <button class="field-toggle" type="button" id="pass-toggle" aria-label="نمایش کلمه عبور" aria-pressed="false">
                                <svg id="pass-icon-show" viewBox="0 0 24 24" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="pass-icon-hide" viewBox="0 0 24 24" aria-hidden="true" hidden><path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.8 21.8 0 0 1 5.06-5.94"/><path d="M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 8 11 8a21.8 21.8 0 0 1-2.16 3.19"/><path d="M14.12 14.12a3 3 0 0 1-4.24-4.24"/><path d="M1 1l22 22"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="field">
                        <label for="security_code">کد امنیتی</label>
                        <div class="auth-captcha-row">
                            <img class="auth-captcha-img" id="captcha-img" src="captcha.php" width="152" height="52" alt="">
                            <button class="auth-captcha-refresh" type="button" id="captcha-refresh" aria-label="کد جدید">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 12a9 9 0 1 0 3-6.7"/><path d="M3 4v5h5"/></svg>
                            </button>
                        </div>
                        <input id="security_code" name="security_code" type="text" autocomplete="off" inputmode="text" required maxlength="8" dir="ltr" spellcheck="false"<?php echo $error ? ' aria-describedby="login-error"' : ''; ?><?php echo $errCaptcha ? ' aria-invalid="true"' : ''; ?>>
                    </div>
                    <?php if ($error) { ?>
                        <p class="auth-error" id="login-error" role="alert">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v5"/><path d="M12 16h.01"/></svg>
                            <span><?php echo dash_login_h($error); ?></span>
                        </p>
                    <?php } ?>
                    <button class="auth-submit" type="submit" id="login-submit">
                        <svg class="spin" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2v4"/><path d="M12 18v4"/><path d="M4.93 4.93l2.83 2.83"/><path d="M16.24 16.24l2.83 2.83"/><path d="M2 12h4"/><path d="M18 12h4"/><path d="M4.93 19.07l2.83-2.83"/><path d="M16.24 7.76l2.83-2.83"/></svg>
                        <span>ورود به داشبورد</span>
                    </button>
                </form>
                <p class="auth-note">ورود فقط برای کاربران دارای دسترسی داشبورد مدیریتی</p>
            </div>
            <footer class="auth-vendor">
                <p>طراحی و توسعه : <a href="https://asiatechin.com" target="_blank" rel="noopener noreferrer">شرکت آسیاتکین</a></p>
            </footer>
        </main>
    </div>
    <script>
        (function () {
            var form = document.getElementById('dash-login-form');
            var submit = document.getElementById('login-submit');
            var refresh = document.getElementById('captcha-refresh');
            var img = document.getElementById('captcha-img');
            var toggle = document.getElementById('pass-toggle');
            var pass = document.getElementById('Pass');
            var iconShow = document.getElementById('pass-icon-show');
            var iconHide = document.getElementById('pass-icon-hide');

            if (refresh && img) {
                refresh.addEventListener('click', function () {
                    refresh.classList.add('is-spin');
                    img.src = 'captcha.php?r=' + Date.now();
                    window.setTimeout(function () { refresh.classList.remove('is-spin'); }, 700);
                });
            }
            if (toggle && pass) {
                toggle.addEventListener('click', function () {
                    var shown = pass.type === 'text';
                    pass.type = shown ? 'password' : 'text';
                    toggle.setAttribute('aria-pressed', shown ? 'false' : 'true');
                    toggle.setAttribute('aria-label', shown ? 'نمایش کلمه عبور' : 'پنهان کردن کلمه عبور');
                    if (iconShow) { iconShow.hidden = !shown; }
                    if (iconHide) { iconHide.hidden = shown; }
                });
            }
            if (form && submit) {
                form.addEventListener('submit', function () {
                    submit.classList.add('is-busy');
                });
            }
        })();
    </script>
</body>
</html>
