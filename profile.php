<?php
include('lock_p1.php');
include('date_con.php');
include('event.php');
require_once('Jalali.php');
date_default_timezone_set('Asia/Tehran');
$date_edit = jdate('Y/m/d');
$time = date('H:i:s');
include('login/config.php');

function agri_profile_h($v)
{
    if (!isset($v)) {
        return '';
    }
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri_profile_sel($cur, $val)
{
    return ((string) $cur === (string) $val) ? ' selected="selected"' : '';
}

function agri_profile_pic_src($pic)
{
    if ($pic == '') {
        return 'files/users/no_pic.png';
    }
    $web = 'files/users/' . $pic;
    $root = isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '';
    $disk = $root . '/files/users/' . $pic;
    $m = file_exists($disk) ? filemtime($disk) : time();
    return $web . '?m=' . $m;
}

function agri_profile_pic_html($pic)
{
    $src = agri_profile_h(agri_profile_pic_src($pic));
    $html = '<img class="agri1-photo-img" id="user_pic" src="' . $src . '" width="87" height="107" alt="تصویر پرسنلی">';
    if ($pic <> '') {
        $html .= '<p class="agri1-photo-actions"><button type="button" class="agri1-btn agri1-btn-ghost" id="del_pic_btn">حذف تصویر</button></p>';
    }
    return $html;
}

$query = 'SELECT pic,username,ostan,city,markaz,cod_m,name,Last_name,jens,sh_sh,date_t,m_sodor,fname,m_tah,r_tah,univer,m_date,avre,v_tahol,cod_p,tel_s,tel_m,addres,shaba FROM users WHERE username=?';
$stmt = $dbh->prepare($query);
$stmt->execute(array($user_check));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    extract($row);
} else {
    die('خطا: اطلاعات کاربر یافت نشد.');
}

$profile_saved = false;
if (isset($_POST['action'])) {
    $jens = test_input($_POST['jens']);
    $sh_sh = test_input($_POST['sh_sh']);
    $date_t = date_con(test_input($_POST['date_t']));
    $m_sodor = test_input($_POST['m_sodor']);
    $fname = test_input($_POST['fname']);
    $m_tah = test_input($_POST['m_tah']);
    $r_tah = test_input($_POST['r_tah']);
    $univer = test_input($_POST['univer']);
    $m_date = date_con($_POST['m_date']);
    $avre = test_input($_POST['avre']);
    $v_tahol = test_input($_POST['v_tahol']);
    $cod_p = test_input($_POST['cod_p']);
    $tel_s = test_input($_POST['tel_s']);
    $tel_m = test_input($_POST['tel_m']);
    $addres = test_input($_POST['addres']);
    $shaba = test_input($_POST['shaba']);

    include('login/config.php');
    $query = 'UPDATE users
        SET jens=?,sh_sh=?,date_t=?,m_sodor=?,fname=?,m_tah=?,r_tah=?,univer=?,m_date=?,avre=?,v_tahol=?,cod_p=?,tel_s=?,tel_m=?,addres=?,shaba=?,valid=?
        WHERE username=?';
    $q = $dbh->prepare($query);
    $q->execute(array(
        $jens, $sh_sh, $date_t, $m_sodor, $fname, $m_tah, $r_tah, $univer, $m_date, $avre, $v_tahol, $cod_p, $tel_s, $tel_m, $addres, $shaba, '200', $username
    ));
    sabt_event($login_session, getUserIP_1(), $date_edit, $time, '', 'ویرایش اطلاعات کاربر', $id_ostan);
    $profile_saved = true;
}

$need_complete_notice = isset($_GET['a']);
$page_title = (isset($title) && $title !== '') ? $title : 'ویرایش اطلاعات کاربری';
$has_pic = ($pic <> '');
$pahneh_crumb_title = 'ویرایش پروفایل';
$previous_val = isset($previous) ? $previous : '';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo agri_profile_h($page_title); ?></title>
    <link href="FA.css" rel="stylesheet">
    <link rel="stylesheet" href="jspc-gray.css">
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="js-persian-cal.min.js"></script>
    <style>
        :root {
            --color-primary: #15803D;
            --color-on-primary: #FFFFFF;
            --color-secondary: #166534;
            --color-accent: #A16207;
            --color-on-accent: #FFFFFF;
            --color-background: #F0FDF4;
            --color-foreground: #14532D;
            --color-card: #FFFFFF;
            --color-card-foreground: #14532D;
            --color-muted: #E8F0F1;
            --color-muted-foreground: #475569;
            --color-border: #86C9A0;
            --color-destructive: #DC2626;
            --color-on-destructive: #FFFFFF;
            --color-ring: #15803D;
            --color-warning-bg: #FEF2F2;
            --space-1: 8px;
            --space-2: 16px;
            --space-3: 24px;
            --space-4: 32px;
            --radius: 12px;
            --duration: 200ms;
            --shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
            --touch: 44px;
            --font: myfont, Tahoma, "Segoe UI", sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-padding-top: 96px; }

        body.agri1-body {
            margin: 0;
            background: var(--color-background);
            color: var(--color-foreground);
            font-family: var(--font);
            font-size: 16px;
            line-height: 1.6;
        }

        .agri1-skip {
            position: absolute;
            right: -999px;
            top: 8px;
            z-index: 90;
            background: var(--color-primary);
            color: var(--color-on-primary);
            padding: 8px 16px;
            border-radius: 8px;
        }
        .agri1-skip:focus { right: 8px; }

        .agri1-main {
            width: min(920px, 100%);
            margin: 0 auto;
            padding: var(--space-3) var(--space-2) var(--space-4);
        }

        .agri1-title {
            margin: 0 0 var(--space-2);
            color: var(--color-foreground);
            font-size: clamp(1.35rem, 2.4vw, 1.85rem);
            line-height: 1.4;
            text-wrap: balance;
        }

        .agri1-hero { margin-bottom: var(--space-3); }

        .agri1-stack {
            display: flex;
            flex-direction: column;
            gap: var(--space-3);
        }

        .agri1-card {
            background: var(--color-card);
            color: var(--color-card-foreground);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: var(--space-3);
        }

        .agri1-card-title {
            margin: 0 0 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--color-border);
            font-size: 1rem;
        }

        .agri1-icon {
            flex: 0 0 auto;
            width: 24px;
            height: 24px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .agri1-alert {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: var(--space-2);
            padding: var(--space-2);
            border-radius: var(--radius);
            border: 1px solid #FECACA;
            background: var(--color-warning-bg);
            color: #991B1B;
        }
        .agri1-alert:focus { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-alert h2 { margin: 0 0 8px; font-size: 1rem; }
        .agri1-alert p { margin: 0; }

        .agri1-hint {
            margin: 0 0 8px;
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
        }
        .agri1-hint a {
            color: var(--color-primary);
            font-weight: 700;
        }

        .agri1-field { margin-top: 12px; }

        .agri1-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            color: var(--color-foreground);
        }

        .agri1-page .agri1-form input[type="text"],
        .agri1-page .agri1-form select {
            width: 100%;
            min-height: var(--touch);
            padding: 10px 12px;
            border: 1px solid #64748B;
            border-radius: 10px;
            background: var(--color-card);
            color: var(--color-foreground);
            font-family: var(--font);
            font-size: 16px;
            box-shadow: none;
            transition: border-color var(--duration) ease, box-shadow var(--duration) ease;
        }
        .agri1-page .agri1-form #tel_m,
        .agri1-page .agri1-form #tel_s,
        .agri1-page .agri1-form #cod_m,
        .agri1-page .agri1-form #shaba,
        .agri1-page .agri1-form #cod_p,
        .agri1-page .agri1-form #sh_sh {
            text-align: center;
            letter-spacing: 0.04em;
        }
        .agri1-page .agri1-form input[type="text"]:focus,
        .agri1-page .agri1-form select:focus {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
        }
        .agri1-page .agri1-form input[aria-invalid="true"],
        .agri1-page .agri1-form select[aria-invalid="true"] {
            border-color: var(--color-destructive);
        }
        .agri1-page .agri1-form input.agri-lock,
        .agri1-page .agri1-form input[readonly] {
            background: #FFFBEB;
        }

        .agri1-error {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 8px 0 0;
            color: var(--color-destructive);
            font-size: 0.875rem;
        }
        .is-hidden { display: none !important; }

        .agri1-info {
            min-height: var(--touch);
            padding: 10px 12px;
            border-radius: 10px;
            background: var(--color-muted);
            color: var(--color-foreground);
        }

        .agri1-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .agri1-field-span { grid-column: 1 / -1; }

        .agri1-photo-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: var(--space-2);
            align-items: start;
        }
        .agri1-photo {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            min-width: 160px;
        }
        .agri1-photo-img {
            width: 87px;
            height: 107px;
            object-fit: cover;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            background: var(--color-muted);
        }
        .agri1-photo-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
            margin: 0;
        }
        .agri1-photo .agri1-btn,
        .agri1-photo-actions .agri1-btn { width: 100%; }

        .agri1-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: var(--space-2);
        }

        .agri1-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: var(--touch);
            min-width: var(--touch);
            padding: 10px 20px;
            border: 0;
            border-radius: 12px;
            cursor: pointer;
            font-family: var(--font);
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            touch-action: manipulation;
            transition: background-color var(--duration) ease, transform var(--duration) ease, box-shadow var(--duration) ease, opacity var(--duration) ease;
        }
        .agri1-btn:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-btn:active { transform: translateY(1px); }
        .agri1-btn[aria-busy="true"] { opacity: 0.85; }
        .agri1-btn:disabled {
            opacity: 0.55;
            cursor: not-allowed;
        }

        .agri1-btn-primary {
            background: var(--color-primary);
            color: var(--color-on-primary);
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25);
        }
        .agri1-btn-primary:hover { background: var(--color-secondary); }

        .agri1-btn-ghost {
            background: transparent;
            color: var(--color-foreground);
            border: 1px solid var(--color-border);
        }
        .agri1-btn-ghost:hover { background: var(--color-muted); }

        .agri1-back { margin-top: var(--space-3); }
        .agri1-back .agri1-btn { width: auto; }
        .agri1-actions .agri1-btn { width: auto; min-width: 160px; }

        .agri1-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 80;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, 0.55);
            padding: var(--space-2);
        }
        .agri1-overlay.is-open { display: flex !important; }
        #agri1-overlay { z-index: 90; }

        .agri1-overlay-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            min-width: 220px;
            padding: 24px;
            border-radius: 16px;
            background: var(--color-card);
            color: var(--color-foreground);
        }

        .agri1-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--color-border);
            border-top-color: var(--color-primary);
            border-radius: 50%;
            animation: agri1-spin 0.8s linear infinite;
        }

        @keyframes agri1-spin { to { transform: rotate(360deg); } }

        div.picker { z-index: 70; }

        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
            .agri1-photo-row { grid-template-columns: 1fr; }
            .agri1-photo { min-width: 0; }
            .agri1-actions .agri1-btn { width: 100%; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            .agri1-btn:active { transform: none; }
        }
    </style>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="<?php echo $profile_saved ? '#agri1-overlay' : '#agri1-content'; ?>">رفتن به محتوا</a>

    <div id="agri1-overlay" class="agri1-overlay<?php echo $profile_saved ? ' is-open' : ''; ?>">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p><?php echo $profile_saved ? 'اطلاعات کاربری شما با موفقیت تصحیح شد' : 'در حال بررسی اطلاعات...'; ?></p>
        </div>
    </div>

<?php if ($profile_saved): ?>
    <form name="myform" class="myform" method="post" action="indexbenef.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
<?php else: ?>

    <?php include(__DIR__ . '/chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri1-content">ویرایش اطلاعات کاربری</h1>
        </header>

<?php if ($need_complete_notice): ?>
        <div class="agri1-alert" role="alert" tabindex="-1" id="profile-complete-alert">
            <svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="12" r="9"></circle>
                <path d="M12 8v5"></path>
                <path d="M12 16h.01"></path>
            </svg>
            <div>
                <h2>تکمیل اطلاعات الزامی است</h2>
                <p>برای استفاده از امکانات سامانه، تکمیل اطلاعات کاربری و آپلود عکس پرسنلی الزامی است.</p>
            </div>
        </div>
<?php endif; ?>

        <div class="agri1-stack">
            <section class="agri1-card" aria-labelledby="agri1-sec-photo">
                <h2 class="agri1-card-title" id="agri1-sec-photo">تصویر پرسنلی</h2>
                <div class="agri1-photo-row">
                    <div>
                        <p class="agri1-hint">حجم فایل ارسالی نباید از ۳ کیلوبایت کمتر و از ۳۰ کیلوبایت بیشتر باشد.</p>
                        <p class="agri1-hint">برای تغییر تصویر موجود، ابتدا تصویر قبلی را حذف نمایید.</p>
                        <p class="agri1-hint">پسوند فایل ارسالی با حروف کوچک تایپ شود.</p>
                        <p class="agri1-hint"><a href="help.html" target="_blank" rel="noopener noreferrer">راهنمای تبدیل پسوند فایل به حروف کوچک</a></p>
                        <p class="agri1-error is-hidden" id="image_status_message" role="status" aria-live="polite"></p>
                    </div>
                    <div class="agri1-photo">
                        <div id="image_container">
                            <?php echo agri_profile_pic_html($pic); ?>
                        </div>
                        <form id="upload_form" class="agri1-photo-actions" enctype="multipart/form-data">
                            <input type="hidden" name="action_type" value="upload">
                            <input type="hidden" name="username" value="<?php echo agri_profile_h($username); ?>">
                            <input name="pic" type="file" id="pic_input" accept=".jpg,.JPG,.jpeg,.gif,.png" class="is-hidden">
                            <button type="button" class="agri1-btn agri1-btn-ghost" id="select_file_btn"<?php if ($has_pic) echo ' disabled="disabled"'; ?>>انتخاب فایل</button>
                            <button type="submit" class="agri1-btn agri1-btn-primary is-hidden" id="upload_btn">آپلود</button>
                        </form>
                    </div>
                </div>
            </section>

            <form action="" method="post" id="form1" name="form1" class="agri1-form agri1-stack" novalidate>
                <input type="hidden" name="action" value="تصحیح اطلاعات">
                <input type="hidden" name="username" value="<?php echo agri_profile_h($username); ?>">
                <input type="hidden" name="previous" value="<?php echo agri_profile_h($previous_val); ?>">

                <section class="agri1-card" aria-labelledby="agri1-sec-work">
                    <h2 class="agri1-card-title" id="agri1-sec-work">اطلاعات محل خدمت</h2>
                    <div class="agri1-grid">
                        <div class="agri1-field">
                            <label class="agri1-label" for="ostan">استان</label>
                            <input name="ostan" type="text" class="agri-lock" id="ostan" dir="rtl" lang="fa" value="<?php echo agri_profile_h($ostan); ?>" maxlength="50" readonly>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="city">شهرستان</label>
                            <input name="city" type="text" class="agri-lock" id="city" dir="rtl" value="<?php echo agri_profile_h($city); ?>" readonly>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="markaz">مرکز جهاد کشاورزی</label>
                            <input name="markaz" type="text" class="agri-lock" id="markaz" dir="rtl" value="<?php echo agri_profile_h($markaz); ?>" readonly>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="cod_m">کد ملی</label>
                            <input name="cod_m" type="text" class="agri-lock" id="cod_m" dir="ltr" inputmode="numeric" value="<?php echo agri_profile_h($cod_m); ?>" readonly>
                        </div>
                    </div>
                </section>

                <section class="agri1-card" aria-labelledby="agri1-sec-user">
                    <h2 class="agri1-card-title" id="agri1-sec-user">مشخصات کاربر</h2>
                    <div class="agri1-grid">
                        <div class="agri1-field">
                            <label class="agri1-label" for="name">نام</label>
                            <input name="name" type="text" class="agri-lock" id="name" tabindex="1" dir="rtl" lang="fa" value="<?php echo agri_profile_h($name); ?>" maxlength="50" readonly>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="last_name">نام خانوادگی</label>
                            <input name="last_name" type="text" class="agri-lock" id="last_name" tabindex="2" dir="rtl" lang="fa" value="<?php echo agri_profile_h($Last_name); ?>" maxlength="50" readonly>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="jens">جنسیت</label>
                            <select name="jens" id="jens" tabindex="3" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="مرد"<?php echo agri_profile_sel($jens, 'مرد'); ?>>آقا</option>
                                <option value="زن"<?php echo agri_profile_sel($jens, 'زن'); ?>>خانم</option>
                            </select>
                            <p class="agri1-error is-hidden" id="error-jens"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="sh_sh">شماره شناسنامه</label>
                            <input name="sh_sh" type="text" id="sh_sh" tabindex="4" dir="ltr" inputmode="numeric" lang="fa" value="<?php echo agri_profile_h($sh_sh); ?>" maxlength="20">
                            <p class="agri1-error is-hidden" id="error-sh_sh"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="pcal1">تاریخ تولد</label>
                            <input name="date_t" type="text" class="pdate" id="pcal1" tabindex="5" dir="rtl" lang="fa" value="<?php echo agri_profile_h($date_t); ?>" maxlength="10">
                            <p class="agri1-error is-hidden" id="error-date_t"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="m_sodor">محل صدور</label>
                            <input name="m_sodor" type="text" id="m_sodor" tabindex="6" dir="rtl" lang="fa" value="<?php echo agri_profile_h($m_sodor); ?>" maxlength="35">
                            <p class="agri1-error is-hidden" id="error-m_sodor"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="fname">نام پدر</label>
                            <input name="fname" type="text" id="fname" tabindex="7" dir="rtl" lang="fa" value="<?php echo agri_profile_h($fname); ?>" maxlength="35">
                            <p class="agri1-error is-hidden" id="error-fname"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="m_tah">مدرک تحصیلی</label>
                            <select name="m_tah" id="m_tah" tabindex="8" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="4"<?php echo agri_profile_sel($m_tah, '4'); ?>>دیپلم</option>
                                <option value="5"<?php echo agri_profile_sel($m_tah, '5'); ?>>فوق دیپلم</option>
                                <option value="1"<?php echo agri_profile_sel($m_tah, '1'); ?>>لیسانس</option>
                                <option value="2"<?php echo agri_profile_sel($m_tah, '2'); ?>>فوق لیسانس</option>
                                <option value="3"<?php echo agri_profile_sel($m_tah, '3'); ?>>دکتری</option>
                            </select>
                            <p class="agri1-error is-hidden" id="error-m_tah"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="r_tah">رشته تحصیلی</label>
                            <input name="r_tah" type="text" id="r_tah" tabindex="9" dir="rtl" lang="fa" value="<?php echo agri_profile_h($r_tah); ?>" maxlength="35">
                            <p class="agri1-error is-hidden" id="error-r_tah"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="univer">نام دانشگاه</label>
                            <input name="univer" type="text" id="univer" tabindex="10" dir="rtl" lang="fa" value="<?php echo agri_profile_h($univer); ?>" maxlength="35">
                            <p class="agri1-error is-hidden" id="error-univer"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="pcal2">تاریخ اخذ مدرک</label>
                            <input name="m_date" type="text" class="pdate" id="pcal2" tabindex="11" dir="rtl" lang="fa" value="<?php echo agri_profile_h($m_date); ?>" maxlength="10">
                            <p class="agri1-error is-hidden" id="error-m_date"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="avre">معدل</label>
                            <input name="avre" type="text" id="avre" tabindex="12" dir="ltr" inputmode="decimal" lang="fa" value="<?php echo agri_profile_h($avre); ?>" maxlength="5">
                            <p class="agri1-error is-hidden" id="error-avre"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="v_tahol">وضعیت تاهل</label>
                            <select name="v_tahol" id="v_tahol" tabindex="13" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="1"<?php echo agri_profile_sel($v_tahol, '1'); ?>>متاهل</option>
                                <option value="2"<?php echo agri_profile_sel($v_tahol, '2'); ?>>مجرد</option>
                            </select>
                            <p class="agri1-error is-hidden" id="error-v_tahol"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="cod_p">کد پرسنلی</label>
                            <input name="cod_p" type="text" id="cod_p" tabindex="14" dir="ltr" lang="fa" value="<?php echo agri_profile_h($cod_p); ?>" maxlength="35">
                            <p class="agri1-error is-hidden" id="error-cod_p"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="tel_s">شماره تلفن ثابت</label>
                            <input name="tel_s" type="text" id="tel_s" tabindex="15" dir="ltr" inputmode="numeric" lang="fa" value="<?php echo agri_profile_h($tel_s); ?>" maxlength="11">
                            <p class="agri1-error is-hidden" id="error-tel_s"></p>
                        </div>
                        <div class="agri1-field">
                            <label class="agri1-label" for="tel_m">شماره همراه</label>
                            <p class="agri1-hint" id="hint-tel_m">یازده رقم، با ۰۹ شروع شود.</p>
                            <input name="tel_m" type="text" id="tel_m" tabindex="16" dir="ltr" inputmode="numeric" autocomplete="tel" lang="fa" value="<?php echo agri_profile_h($tel_m); ?>" maxlength="11" aria-describedby="hint-tel_m error-tel_m tel_m_status">
                            <p class="agri1-error is-hidden" id="error-tel_m"></p>
                            <p class="agri1-info" id="tel_m_status" role="status" aria-live="polite">در انتظار بررسی</p>
                        </div>
                        <div class="agri1-field agri1-field-span">
                            <label class="agri1-label" for="addres">آدرس محل سکونت</label>
                            <input name="addres" type="text" id="addres" tabindex="17" dir="rtl" lang="fa" value="<?php echo agri_profile_h($addres); ?>" maxlength="300">
                            <p class="agri1-error is-hidden" id="error-addres"></p>
                        </div>
                        <div class="agri1-field agri1-field-span">
                            <label class="agri1-label" for="shaba">شماره شبا</label>
                            <input type="text" name="shaba" id="shaba" value="<?php echo agri_profile_h($shaba); ?>" tabindex="18" dir="ltr" inputmode="numeric">
                            <p class="agri1-error is-hidden" id="error-shaba"></p>
                        </div>
                    </div>

                    <div class="agri1-actions">
                        <button type="submit" class="agri1-btn agri1-btn-primary" id="profileSubmitBtn" tabindex="39">تصحیح اطلاعات</button>
                    </div>
                </section>
            </form>
        </div>

        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="indexbenef.php">
                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                </svg>
                بازگشت به صفحه قبل
            </a>
        </p>
    </main>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td height="109" style="background: url('files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('footer.php'); ?>
            </td>
        </tr>
    </table>

<script type="text/javascript">
new AMIB.persianCalendar('pcal1');
new AMIB.persianCalendar('pcal2');
</script>
<script type="text/javascript">
$(document).ready(function () {
    var overlay = document.getElementById('agri1-overlay');
    var notice = document.getElementById('profile-complete-alert');
    var form = document.getElementById('form1');
    var submitBtn = document.getElementById('profileSubmitBtn');
    var busy = false;
    var allowNativeSubmit = false;
    var initial_tel_m = '<?php echo agri_profile_h($tel_m); ?>';
    var initial_cod_m = '<?php echo agri_profile_h($cod_m); ?>';
    var shahkar_match_status = null;
    var $status = $('#tel_m_status');
    var username = '<?php echo agri_profile_h($username); ?>';

    var requiredFields = [
        { id: 'jens', msg: 'جنسیت را انتخاب کنید' },
        { id: 'sh_sh', msg: 'شماره شناسنامه را وارد کنید' },
        { id: 'pcal1', name: 'date_t', msg: 'تاریخ تولد را وارد کنید' },
        { id: 'm_sodor', msg: 'محل صدور را وارد کنید' },
        { id: 'fname', msg: 'نام پدر را وارد کنید' },
        { id: 'm_tah', msg: 'مدرک تحصیلی را انتخاب کنید' },
        { id: 'r_tah', msg: 'رشته تحصیلی را وارد کنید' },
        { id: 'univer', msg: 'نام دانشگاه را وارد کنید' },
        { id: 'pcal2', name: 'm_date', msg: 'تاریخ اخذ مدرک را وارد کنید' },
        { id: 'avre', msg: 'معدل را وارد کنید' },
        { id: 'v_tahol', msg: 'وضعیت تاهل را انتخاب کنید' },
        { id: 'cod_p', msg: 'کد پرسنلی را وارد کنید' },
        { id: 'tel_s', msg: 'شماره تلفن ثابت را وارد کنید' },
        { id: 'tel_m', msg: 'شماره همراه را وارد کنید' },
        { id: 'addres', msg: 'آدرس محل سکونت را وارد کنید' },
        { id: 'shaba', msg: 'شماره شبا را وارد کنید' }
    ];

    function showOverlay(on) {
        if (!overlay) return;
        overlay.className = on ? 'agri1-overlay is-open' : 'agri1-overlay';
    }

    function setBusy(on) {
        busy = on;
        if (!submitBtn) return;
        submitBtn.setAttribute('aria-busy', on ? 'true' : 'false');
        submitBtn.textContent = on ? 'در حال بررسی اطلاعات...' : 'تصحیح اطلاعات';
    }

    function setFieldError(id, msg) {
        var el = document.getElementById(id);
        var err = document.getElementById('error-' + (id === 'pcal1' ? 'date_t' : (id === 'pcal2' ? 'm_date' : id)));
        if (!el) return;
        if (msg) {
            if (err) {
                err.textContent = msg;
                err.classList.remove('is-hidden');
            }
            el.setAttribute('aria-invalid', 'true');
        } else {
            if (err) {
                err.textContent = '';
                err.classList.add('is-hidden');
            }
            el.removeAttribute('aria-invalid');
        }
    }

    function setImageMsg(msg, isError) {
        var $msg = $('#image_status_message');
        $msg.text(msg || '');
        if (msg) {
            $msg.removeClass('is-hidden');
            $msg.toggleClass('agri1-error', !!isError);
            $msg.toggleClass('agri1-info', !isError);
        } else {
            $msg.addClass('is-hidden');
        }
    }

    function validateRequired() {
        var firstInvalid = null;
        var i;
        for (i = 0; i < requiredFields.length; i++) {
            var item = requiredFields[i];
            var el = document.getElementById(item.id);
            var val = el ? $.trim(el.value) : '';
            if (val === '') {
                setFieldError(item.id, item.msg);
                if (!firstInvalid) firstInvalid = el;
            } else {
                setFieldError(item.id, '');
            }
        }
        var sh_sh = $('#sh_sh').val();
        if (sh_sh !== '' && !/^\d+$/.test(sh_sh)) {
            setFieldError('sh_sh', 'شماره شناسنامه باید فقط رقم باشد');
            if (!firstInvalid) firstInvalid = document.getElementById('sh_sh');
        }
        var tel_s = $('#tel_s').val();
        if (tel_s !== '' && !/^\d+$/.test(tel_s)) {
            setFieldError('tel_s', 'شماره تلفن ثابت باید فقط رقم باشد');
            if (!firstInvalid) firstInvalid = document.getElementById('tel_s');
        }
        var shaba = $('#shaba').val();
        if (shaba !== '' && !/^\d+$/.test(shaba)) {
            setFieldError('shaba', 'شماره شبا باید فقط رقم باشد');
            if (!firstInvalid) firstInvalid = document.getElementById('shaba');
        }
        if (firstInvalid) {
            firstInvalid.focus();
            return false;
        }
        return true;
    }

    function validateTelMShahkar(done) {
        var tel_m_val = $('#tel_m').val();
        var cod_m_val = $('#cod_m').val();

        if (tel_m_val === initial_tel_m && cod_m_val === initial_cod_m) {
            setFieldError('tel_m', '');
            $status.text('شماره همراه و کد ملی قبلی تایید شده است.');
            shahkar_match_status = true;
            if (done) done(true);
            return;
        }

        shahkar_match_status = null;

        if (tel_m_val.length !== 11 || tel_m_val.substring(0, 2) !== '09' || !/^\d+$/.test(tel_m_val)) {
            setFieldError('tel_m', 'شماره همراه باید ۱۱ رقم و با ۰۹ شروع شود');
            $status.text('تأیید نشد');
            shahkar_match_status = false;
            $('#tel_m').focus();
            if (done) done(false);
            return;
        }

        if (cod_m_val.length !== 10) {
            setFieldError('tel_m', 'کد ملی باید ۱۰ رقم باشد');
            $status.text('تأیید نشد');
            shahkar_match_status = false;
            if (done) done(false);
            return;
        }

        setFieldError('tel_m', '');
        $status.text('در حال استعلام...');

        $.ajax({
            type: 'POST',
            url: 'tel_m_valid.php',
            data: { tel_m: tel_m_val, cod_m: cod_m_val },
            dataType: 'text',
            success: function (response) {
                var trimmedResponse = $.trim(response || '');
                if (trimmedResponse === 'success') {
                    $status.text('مطابقت دارد');
                    shahkar_match_status = true;
                    initial_tel_m = tel_m_val;
                    initial_cod_m = cod_m_val;
                    if (done) done(true);
                    return;
                }
                shahkar_match_status = false;
                if (trimmedResponse === 'no_match') {
                    setFieldError('tel_m', 'عدم تطابق شماره همراه با کد ملی');
                    $status.text('تأیید نشد');
                } else {
                    setFieldError('tel_m', 'خطای فنی در اعتبارسنجی رخ داد. دوباره تلاش کنید.');
                    $status.text('خطای استعلام');
                }
                $('#tel_m').focus();
                if (done) done(false);
            },
            error: function () {
                setFieldError('tel_m', 'خطا در برقراری ارتباط با سرور');
                $status.text('خطای ارتباط');
                shahkar_match_status = false;
                if (done) done(false);
            }
        });
    }

    if (notice) {
        notice.focus();
    }

    $('#select_file_btn').click(function () {
        if (!$(this).is(':disabled')) {
            $('#pic_input').click();
        }
    });

    $('#pic_input').change(function () {
        var $selectBtn = $('#select_file_btn');
        var $uploadBtn = $('#upload_btn');
        if ($(this).val()) {
            var file = this.files[0];
            var isValid = true;
            if (file && (file.size < 2000 || file.size > 30000)) {
                setImageMsg('حجم فایل باید بین ۲ تا ۳۰ کیلوبایت باشد.', true);
                isValid = false;
            } else {
                setImageMsg('', false);
            }
            $uploadBtn.toggleClass('is-hidden', !isValid);
            $selectBtn.text('انتخاب مجدد');
        } else {
            $uploadBtn.addClass('is-hidden');
            $selectBtn.text('انتخاب فایل');
            setImageMsg('', false);
        }
    });

    $('#upload_form').submit(function (e) {
        e.preventDefault();
        if ($('#pic_input')[0].files.length === 0 || $('#upload_btn').is(':disabled')) {
            setImageMsg('فایلی انتخاب نشده یا دارای اشکال حجم است.', true);
            return;
        }
        setImageMsg('در حال آپلود...', false);
        showOverlay(true);
        $.ajax({
            url: 'image_handler.php',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                showOverlay(false);
                setImageMsg(response.message || '', !response.success);
                $('#image_container').html(response.html);
                if (response.is_uploaded) {
                    $('#select_file_btn').prop('disabled', true).hide();
                    $('#upload_btn').addClass('is-hidden');
                } else {
                    $('#select_file_btn').prop('disabled', false).show();
                    $('#upload_btn').addClass('is-hidden');
                }
                $('#pic_input').val('');
            },
            error: function () {
                showOverlay(false);
                setImageMsg('خطا در برقراری ارتباط با سرور.', true);
            }
        });
    });

    $(document).on('click', '#del_pic_btn', function () {
        var $btn = $(this);
        if ($btn.data('confirming') !== 1) {
            $btn.data('confirming', 1);
            $btn.text('تأیید حذف');
            setImageMsg('برای حذف تصویر، دوباره «تأیید حذف» را بزنید.', false);
            return;
        }
        setImageMsg('در حال حذف...', false);
        showOverlay(true);
        $.ajax({
            url: 'image_handler.php',
            type: 'POST',
            data: { action_type: 'delete', username: username },
            dataType: 'json',
            success: function (response) {
                showOverlay(false);
                setImageMsg(response.message || '', !response.success);
                $('#image_container').html(response.html);
                $('#select_file_btn').prop('disabled', false).show().text('انتخاب فایل');
                $('#upload_btn').addClass('is-hidden');
            },
            error: function () {
                showOverlay(false);
                setImageMsg('خطا در برقراری ارتباط با سرور.', true);
            }
        });
    });

    $(form).on('submit', function (e) {
        if (allowNativeSubmit) return;
        e.preventDefault();
        if (busy) return;
        if (!validateRequired()) return;

        setBusy(true);
        showOverlay(true);

        validateTelMShahkar(function (ok) {
            if (!ok) {
                showOverlay(false);
                setBusy(false);
                return;
            }
            allowNativeSubmit = true;
            form.submit();
        });
    });

    $('#tel_m').on('blur', function () {
        validateTelMShahkar();
    });
    $('#cod_m').on('blur', function () {
        validateTelMShahkar();
    });
});
</script>
<?php endif; ?>
</body>
</html>
