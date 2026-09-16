<?php
include("lock_p1.php");
include('counter.php');
// متغیرهای $tel_m و $valid توسط counter.php لود شده‌اند.
// $_SESSION['login_user'] در lock_p1.php یا قبل از آن تنظیم شده و برای شناسایی کاربر فعلی استفاده می‌شود.
$current_user_national_code = $_SESSION['login_user'];
$need_tel_verify = (!isset($valid) || $valid != '200');

function agri_index_h($v)
{
    if (!isset($v)) {
        return '';
    }
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

$count_abadi = isset($count) ? (int) $count : 0;
$count_city_n = isset($count_city) ? (int) $count_city : 0;
$page_title = (isset($title) && $title !== '') ? $title : 'خانه';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo agri_index_h($page_title); ?></title>
    <link href="FA.css" rel="stylesheet">
    <script src="assets/js/jquery-3.6.0.min.js"></script>
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
        body.agri1-locked { overflow: hidden; }

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

        .agri1-choices {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        a.agri1-choice {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: var(--touch);
            padding: 12px 14px;
            border: 2px solid var(--color-border);
            border-radius: var(--radius);
            background: var(--color-card);
            color: var(--color-foreground);
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            touch-action: manipulation;
            transition: border-color var(--duration) ease, background-color var(--duration) ease, box-shadow var(--duration) ease;
        }
        a.agri1-choice:hover {
            border-color: var(--color-primary);
            background: #F7FEF9;
        }
        a.agri1-choice:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }

        .agri1-choice-text { flex: 1; min-width: 0; }

        .agri1-choice-count {
            flex: 0 0 auto;
            min-width: 28px;
            min-height: 28px;
            padding: 2px 8px;
            border-radius: 999px;
            background: #ECFDF3;
            border: 1px solid var(--color-border);
            color: var(--color-primary);
            font-size: 0.875rem;
            font-weight: 700;
            text-align: center;
            direction: ltr;
        }

        .agri1-sticker {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: var(--radius);
            background: #ECFDF3;
            border: 1px solid var(--color-border);
            color: var(--color-primary);
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
            margin: 0 0 12px;
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
        }

        .agri1-field { margin-top: 12px; }

        .agri1-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            color: var(--color-foreground);
        }

        .agri1-page .agri1-form input[type="text"] {
            width: 100%;
            min-height: var(--touch);
            padding: 10px 12px;
            border: 1px solid #64748B;
            border-radius: 10px;
            background: var(--color-card);
            color: var(--color-foreground);
            font-size: 16px;
            box-shadow: none;
            transition: border-color var(--duration) ease, box-shadow var(--duration) ease;
        }
        .agri1-page .agri1-form #tel_m_profile {
            text-align: center;
            letter-spacing: 0.08em;
        }
        .agri1-page .agri1-form input[type="text"]:focus {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
        }
        .agri1-page .agri1-form input[aria-invalid="true"] {
            border-color: var(--color-destructive);
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
            width: 100%;
            min-height: var(--touch);
            min-width: var(--touch);
            padding: 10px 20px;
            border: 0;
            border-radius: 12px;
            cursor: pointer;
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

        .agri1-btn-primary {
            background: var(--color-primary);
            color: var(--color-on-primary);
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25);
        }
        .agri1-btn-primary:hover { background: var(--color-secondary); }

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

        .agri1-overlay-panel.is-dialog {
            width: min(450px, 100%);
            align-items: stretch;
            text-align: right;
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

        @media (max-width: 640px) {
            .agri1-choices { grid-template-columns: 1fr; }
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
<body class="agri1-body agri1-page<?php echo $need_tel_verify ? ' agri1-locked' : ''; ?>">
    <a class="agri1-skip" href="<?php echo $need_tel_verify ? '#tel_m_profile' : '#agri1-content'; ?>">رفتن به محتوا</a>

    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>

<?php if ($need_tel_verify): ?>
    <div class="agri1-overlay is-open" id="verificationModal" role="dialog" aria-modal="true" aria-labelledby="telm-dialog-title">
        <div class="agri1-overlay-panel is-dialog">
            <div class="agri1-alert" role="alert" tabindex="-1" id="telm-dialog-alert">
                <svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="9"></circle>
                    <path d="M12 8v5"></path>
                    <path d="M12 16h.01"></path>
                </svg>
                <div>
                    <h2 id="telm-dialog-title">شماره همراه تأیید نشده است</h2>
                    <p>شماره همراه به نام خود را وارد کنید. تا زمان تأیید، دسترسی به صفحات بعدی مقدور نیست.</p>
                </div>
            </div>

            <form id="telm-verification-form" class="agri1-form" novalidate>
                <div class="agri1-field">
                    <label class="agri1-label" for="tel_m_profile">شماره همراه</label>
                    <p class="agri1-hint" id="hint-tel_m">یازده رقم، با ۰۹ شروع شود.</p>
                    <input name="tel_m" type="text" id="tel_m_profile"
                           value="<?php echo agri_index_h(isset($tel_m) ? $tel_m : ''); ?>"
                           maxlength="11" dir="ltr" inputmode="numeric" autocomplete="tel"
                           aria-describedby="hint-tel_m error-tel_m">
                    <p class="agri1-error is-hidden" id="error-tel_m"></p>
                </div>

                <input type="hidden" name="id" value="0">
                <input type="hidden" name="bah_cod_m" value="<?php echo agri_index_h($current_user_national_code); ?>">

                <div class="agri1-field">
                    <span class="agri1-label" id="telm-status-label">وضعیت احراز هویت</span>
                    <p class="agri1-info" id="modalStatusMessage" role="status" aria-live="polite" aria-labelledby="telm-status-label">در انتظار بررسی</p>
                </div>

                <div class="agri1-actions">
                    <button type="submit" class="agri1-btn agri1-btn-primary" id="modalSubmitBtn">ثبت و بررسی شماره همراه</button>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

    <?php include(__DIR__ . '/chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri1-content">خانه</h1>
        </header>

        <div class="agri1-stack">
            <section class="agri1-card" aria-labelledby="agri1-sec-cover">
                <h2 class="agri1-card-title" id="agri1-sec-cover">پوشش پهنه</h2>
                <nav class="agri1-choices" aria-label="پوشش پهنه">
                    <a href="./lists_city.php" class="agri1-choice" title="مشاهده لیست شهرهای تحت پوشش">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('city'); ?></span>
                        <span class="agri1-choice-text">لیست شهرها</span>
                        <span class="agri1-choice-count"><?php echo $count_city_n; ?></span>
                    </a>
                    <a href="./lists_abadi.php" class="agri1-choice" title="مشاهده لیست آبادی‌های تحت پوشش">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('pin'); ?></span>
                        <span class="agri1-choice-text">لیست آبادی‌ها</span>
                        <span class="agri1-choice-count"><?php echo $count_abadi; ?></span>
                    </a>
                    <a href="./list_pubabadi.php" class="agri1-choice" title="مشاهده و ویرایش اطلاعات عمومی آبادی‌ها">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('grid'); ?></span>
                        <span class="agri1-choice-text">اطلاعات عمومی آبادی‌ها</span>
                    </a>
                    <a href="./list_pubcity.php" class="agri1-choice" title="مشاهده و ویرایش اطلاعات عمومی شهرها">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('city'); ?></span>
                        <span class="agri1-choice-text">اطلاعات عمومی شهرها</span>
                    </a>
                </nav>
            </section>

            <section class="agri1-card" aria-labelledby="agri1-sec-spec">
                <h2 class="agri1-card-title" id="agri1-sec-spec">ثبت و عملکرد</h2>
                <nav class="agri1-choices" aria-label="ثبت و عملکرد">
                    <a href="./prof/index.php" class="agri1-choice">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('wheat'); ?></span>
                        <span class="agri1-choice-text">اطلاعات اختصاصی</span>
                    </a>
                    <a href="./prof/prom_operation.php" class="agri1-choice" title="لیست عملکرد">
                        <span class="agri1-sticker" aria-hidden="true">
                            <svg class="agri1-icon" viewBox="0 0 24 24">
                                <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"></path>
                                <rect x="9" y="3" width="6" height="4" rx="1"></rect>
                                <path d="M9 12h6"></path>
                                <path d="M9 16h4"></path>
                            </svg>
                        </span>
                        <span class="agri1-choice-text">مشاهده لیست عملکرد</span>
                    </a>
                </nav>
            </section>

            <section class="agri1-card" aria-labelledby="agri1-sec-people">
                <h2 class="agri1-card-title" id="agri1-sec-people">کاربران و همکاران</h2>
                <nav class="agri1-choices" aria-label="کاربران و همکاران">
                    <a href="./profile.php" class="agri1-choice" title="مدیریت اطلاعات کاربری">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('edit'); ?></span>
                        <span class="agri1-choice-text">ویرایش اطلاعات کاربری</span>
                    </a>
                    <a href="./search_promo.php" class="agri1-choice" title="جستجوی کاربران سیستم">
                        <span class="agri1-sticker" aria-hidden="true">
                            <svg class="agri1-icon" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="7"></circle>
                                <path d="M20 20l-3.5-3.5"></path>
                            </svg>
                        </span>
                        <span class="agri1-choice-text">جستجوی کاربر</span>
                    </a>
                    <a href="./list_expar.php" class="agri1-choice" title="کارشناسان معین استان">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('users'); ?></span>
                        <span class="agri1-choice-text">کارشناسان معین</span>
                    </a>
                    <a href="./list_expar_sh.php" class="agri1-choice" title="کارشناسان موضوعی شهرستان">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('user'); ?></span>
                        <span class="agri1-choice-text">کارشناسان موضوعی</span>
                    </a>
                    <a href="./list_scholar.php" class="agri1-choice" title="محقق معین شهرستان">
                        <span class="agri1-sticker" aria-hidden="true">
                            <svg class="agri1-icon" viewBox="0 0 24 24">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </span>
                        <span class="agri1-choice-text">محقق معین شهرستان</span>
                    </a>
                    <a href="./list_Admin.php" class="agri1-choice" title="ادمین استان">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('lock'); ?></span>
                        <span class="agri1-choice-text">ادمین استانی سامانه</span>
                    </a>
                    <a href="./Area_experts.php" class="agri1-choice" title="سایر کارشناسان">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('ip'); ?></span>
                        <span class="agri1-choice-text">ارتباط با سایر کارشناسان پهنه</span>
                    </a>
                </nav>
            </section>
        </div>
    </main>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td height="109" style="background: url('files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('footer.php'); ?>
            </td>
        </tr>
    </table>

<?php if ($need_tel_verify): ?>
<script>
$(document).ready(function () {
    var form = document.getElementById('telm-verification-form');
    var telmInput = document.getElementById('tel_m_profile');
    var errorEl = document.getElementById('error-tel_m');
    var statusEl = document.getElementById('modalStatusMessage');
    var submitBtn = document.getElementById('modalSubmitBtn');
    var overlay = document.getElementById('agri1-overlay');
    var busy = false;

    function showOverlay(on) {
        if (!overlay) return;
        overlay.className = on ? 'agri1-overlay is-open' : 'agri1-overlay';
    }

    function setFieldError(msg) {
        if (!errorEl || !telmInput) return;
        if (msg) {
            errorEl.textContent = msg;
            errorEl.classList.remove('is-hidden');
            telmInput.setAttribute('aria-invalid', 'true');
        } else {
            errorEl.textContent = '';
            errorEl.classList.add('is-hidden');
            telmInput.removeAttribute('aria-invalid');
        }
    }

    function setBusy(on) {
        busy = on;
        if (!submitBtn) return;
        submitBtn.setAttribute('aria-busy', on ? 'true' : 'false');
        submitBtn.textContent = on ? 'در حال بررسی اطلاعات...' : 'ثبت و بررسی شماره همراه';
    }

    if (telmInput) {
        telmInput.focus();
    }

    $(form).on('submit', function (e) {
        e.preventDefault();
        if (busy) return;

        var tel_m = telmInput ? telmInput.value.replace(/\s+/g, '') : '';
        if (tel_m === '') {
            setFieldError('شماره همراه را وارد کنید');
            if (telmInput) telmInput.focus();
            return;
        }
        if (!/^09\d{9}$/.test(tel_m)) {
            setFieldError('شماره همراه باید ۱۱ رقم و با ۰۹ شروع شود');
            if (telmInput) telmInput.focus();
            return;
        }

        setFieldError('');
        setBusy(true);
        showOverlay(true);
        if (statusEl) statusEl.textContent = 'در حال بررسی اطلاعات...';

        $.ajax({
            type: 'POST',
            url: 'tel_m_sabt.php',
            data: $(this).serialize(),
            success: function (response) {
                var trimmedResponse = (response || '').toString().trim();
                if (trimmedResponse === 'success') {
                    if (statusEl) statusEl.textContent = 'شماره همراه با موفقیت تأیید شد.';
                    submitBtn.textContent = 'تأیید شد';
                    setTimeout(function () {
                        document.body.classList.remove('agri1-locked');
                        location.reload();
                    }, 1500);
                    return;
                }

                var errorMessage = 'استعلام با مشکل مواجه شد. دوباره تلاش کنید.';
                if (trimmedResponse === 'no_match') {
                    errorMessage = 'عدم تطابق شماره همراه با کد ملی یا اطلاعات کاربری.';
                } else if (trimmedResponse === 'invalid_request') {
                    errorMessage = 'درخواست نامعتبر است. صفحه را تازه‌سازی کنید و دوباره تلاش کنید.';
                } else if (trimmedResponse === 'error') {
                    errorMessage = 'خطا در استعلام یا پاسخ‌دهی سرور. دوباره تلاش کنید.';
                }
                setFieldError(errorMessage);
                if (statusEl) statusEl.textContent = 'تأیید نشد';
                showOverlay(false);
                setBusy(false);
                if (telmInput) telmInput.focus();
            },
            error: function () {
                setFieldError('خطایی در ارتباط با سرور رخ داد. دوباره تلاش کنید.');
                if (statusEl) statusEl.textContent = 'خطای ارتباط';
                showOverlay(false);
                setBusy(false);
                if (telmInput) telmInput.focus();
            }
        });
    });
});
</script>
<?php endif; ?>
</body>
</html>
