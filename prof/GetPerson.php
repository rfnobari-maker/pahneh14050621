<?php
include('../lock_p1.php');
include('../web/ws_sabt.php');

function getperson_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function getperson_digits($v)
{
    $v = trim($v . '');
    $fa = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $en = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($fa, $en, $v);
}

function getperson_csrf_token()
{
    if (empty($_SESSION['getperson_csrf']) || !is_string($_SESSION['getperson_csrf'])) {
        if (function_exists('random_bytes')) {
            $_SESSION['getperson_csrf'] = bin2hex(random_bytes(16));
        } else {
            $_SESSION['getperson_csrf'] = bin2hex(openssl_random_pseudo_bytes(16));
        }
    }
    return $_SESSION['getperson_csrf'];
}

function getperson_csrf_ok($token)
{
    $sess = isset($_SESSION['getperson_csrf']) ? $_SESSION['getperson_csrf'] : '';
    if ($sess === '' || $token === '') return false;
    if (function_exists('hash_equals')) return hash_equals($sess, $token);
    return $sess === $token;
}

function getperson_valid_cod_m($code)
{
    if (!preg_match('/^\d{10}$/', $code)) return false;
    $check = (int) $code[9];
    $sum = 0;
    for ($i = 0; $i < 9; $i++) {
        $sum += ((int) $code[$i]) * (10 - $i);
    }
    $r = $sum % 11;
    return ($r < 2 && $check === $r) || ($r >= 2 && $check === (11 - $r));
}

function getperson_valid_birth($d)
{
    if (!preg_match('/^\d{8}$/', $d)) return false;
    $y = (int) substr($d, 0, 4);
    $m = (int) substr($d, 4, 2);
    $day = (int) substr($d, 6, 2);
    if ($y < 1200 || $y > 1500) return false;
    if ($m < 1 || $m > 12) return false;
    if ($day < 1 || $day > 31) return false;
    return true;
}

function getperson_format_date($date)
{
    if (strlen($date) === 8 && ctype_digit($date)) {
        return substr($date, 0, 4) . '/' . substr($date, 4, 2) . '/' . substr($date, 6, 2);
    }
    return '';
}

$csrf = getperson_csrf_token();
$birthdate = '';
$nationalid = '';
$field_errors = array();
$result = null;
$result_ok = false;
$ws_error = '';
$did_search = false;

if (isset($_POST['go'])) {
    $did_search = true;
    $token = isset($_POST['csrf']) ? $_POST['csrf'] : '';
    $birthdate = getperson_digits(isset($_POST['birthdate']) ? $_POST['birthdate'] : '');
    $nationalid = getperson_digits(isset($_POST['nationalid']) ? $_POST['nationalid'] : '');
    $birthdate = preg_replace('/[^\d]/', '', $birthdate);
    $nationalid = preg_replace('/[^\d]/', '', $nationalid);

    if (!getperson_csrf_ok($token)) {
        $field_errors['form'] = 'نشست منقضی شده است. صفحه را تازه کنید و دوباره جستجو کنید.';
    }
    if ($birthdate === '') {
        $field_errors['birthdate'] = 'تاریخ تولد را وارد کنید';
    } elseif (!getperson_valid_birth($birthdate)) {
        $field_errors['birthdate'] = 'تاریخ تولد باید هشت رقم باشد (مثال: ۱۳۴۷۰۵۲۲)';
    }
    if ($nationalid === '') {
        $field_errors['nationalid'] = 'کد ملی را وارد کنید';
    } elseif (!getperson_valid_cod_m($nationalid)) {
        $field_errors['nationalid'] = 'کد ملی باید ۱۰ رقم معتبر باشد';
    }

    if (empty($field_errors)) {
        if (function_exists('webservice')) {
            $result = webservice($birthdate, $nationalid);
            $result_ok = (is_array($result) && isset($result['name']) && $result['name'] !== '' && $result['name'] !== null);
        } else {
            $ws_error = 'تابع وب‌سرویس در دسترس نیست.';
        }
    }
}

$page_title = (isset($title) && $title !== '') ? $title : 'استعلام مشخصات بهره‌بردار';
$pahneh_crumb = array(
    array('label' => 'خانه', 'href' => '../indexbenef.php'),
    array('label' => 'اطلاعات اختصاصی', 'href' => 'index.php'),
    array('label' => 'بهره‌برداران کشاورزی', 'href' => 'benefic.php'),
    array('label' => 'استعلام مشخصات'),
);
$has_errors = !empty($field_errors);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo getperson_h($page_title); ?></title>
    <link href="../FA.css" rel="stylesheet" type="text/css"/>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
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
        .agri1-card {
            background: var(--color-card);
            color: var(--color-card-foreground);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: var(--space-3);
            margin-bottom: var(--space-3);
        }
        .agri1-card-title {
            margin: 0 0 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--color-border);
            font-size: 1rem;
        }
        .agri1-alert {
            margin-bottom: var(--space-3);
            padding: var(--space-2);
            border-radius: var(--radius);
            border: 1px solid #FECACA;
            background: var(--color-warning-bg);
            color: #991B1B;
        }
        .agri1-alert:focus { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-alert h2 { margin: 0 0 8px; font-size: 1rem; }
        .agri1-alert ul { margin: 0; padding: 0 18px 0 0; }
        .agri1-alert a { color: #991B1B; text-decoration: underline; }
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
        .agri1-field { margin-top: 12px; }
        .agri1-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            color: var(--color-foreground);
        }
        .agri1-hint {
            margin: 6px 0 0;
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
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
        .agri1-page .agri1-form input[type="text"] {
            width: 100%;
            min-height: var(--touch);
            padding: 10px 12px;
            border: 1px solid #64748B;
            border-radius: 10px;
            background: var(--color-card);
            color: var(--color-foreground);
            font-size: 16px;
            font-family: inherit;
            box-shadow: none;
            transition: border-color var(--duration) ease, box-shadow var(--duration) ease;
        }
        .agri1-page .agri1-form #birthdate,
        .agri1-page .agri1-form #nationalid {
            text-align: center;
            letter-spacing: 0.08em;
            font-family: Tahoma, "Segoe UI", sans-serif;
        }
        .agri1-page .agri1-form input[type="text"]:focus {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
        }
        .agri1-page .agri1-form input[aria-invalid="true"] {
            border-color: var(--color-destructive);
        }
        .agri1-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .agri1-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
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
            font-size: 16px;
            font-weight: 700;
            font-family: inherit;
            text-decoration: none;
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
        .agri1-btn-ghost {
            background: transparent;
            color: var(--color-foreground);
            border: 1px solid var(--color-border);
        }
        .agri1-btn-ghost:hover { background: var(--color-muted); }
        .agri1-back { margin-top: var(--space-3); }
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
        .agri1-dl {
            display: grid;
            grid-template-columns: minmax(7rem, 32%) 1fr;
            gap: 10px 16px;
            margin: 0;
        }
        .agri1-dl dt {
            margin: 0;
            color: var(--color-muted-foreground);
            font-weight: 700;
        }
        .agri1-dl dd {
            margin: 0;
            color: var(--color-foreground);
        }
        .agri1-note {
            margin: 0;
            padding: 12px 14px;
            border-radius: 10px;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            color: #1D4ED8;
        }
        .agri1-status-ok { color: var(--color-primary); font-weight: 700; }
        .agri1-status-no { color: var(--color-destructive); font-weight: 700; }
        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
            .agri1-dl { grid-template-columns: 1fr; gap: 2px 0; }
            .agri1-dl dt { margin-top: 8px; }
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
    <a class="agri1-skip" href="#reg-form">رفتن به فرم استعلام</a>
    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>
    <?php include(__DIR__ . '/../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri1-content">استعلام مشخصات بهره‌بردار</h1>
        </header>

        <section class="agri1-card" aria-labelledby="agri1-content">
            <form id="reg-form" class="agri1-form" method="post" action="GetPerson.php#1" novalidate>
                <input type="hidden" name="csrf" value="<?php echo getperson_h($csrf); ?>"/>
                <h2 class="agri1-card-title">استعلام ثبت احوال</h2>
<?php if ($has_errors) { ?>
                <div class="agri1-alert" id="agri1-error-summary" role="alert" tabindex="-1" aria-labelledby="agri1-error-title">
                    <h2 id="agri1-error-title">لطفاً موارد زیر را اصلاح کنید</h2>
                    <ul>
<?php
    foreach ($field_errors as $ek => $em) {
        $href = ($ek === 'form') ? '#reg-form' : '#field-' . $ek;
        echo '<li><a href="' . getperson_h($href) . '">' . getperson_h($em) . '</a></li>';
    }
?>
                    </ul>
                </div>
<?php } ?>
                <div class="agri1-grid">
                    <div class="agri1-field" id="field-birthdate">
                        <label class="agri1-label" for="birthdate">تاریخ تولد</label>
                        <input type="text" name="birthdate" id="birthdate" dir="ltr" inputmode="numeric" maxlength="8" autocomplete="off" value="<?php echo getperson_h($birthdate); ?>" aria-invalid="<?php echo isset($field_errors['birthdate']) ? 'true' : 'false'; ?>" aria-describedby="hint-birthdate error-birthdate"/>
                        <p class="agri1-hint" id="hint-birthdate">هشت رقم شمسی، بدون جداکننده — مثال: ۱۳۴۷۰۵۲۲</p>
                        <p class="agri1-error<?php echo isset($field_errors['birthdate']) ? '' : ' is-hidden'; ?>" id="error-birthdate"><?php echo isset($field_errors['birthdate']) ? getperson_h($field_errors['birthdate']) : ''; ?></p>
                    </div>
                    <div class="agri1-field" id="field-nationalid">
                        <label class="agri1-label" for="nationalid">کد ملی</label>
                        <input type="text" name="nationalid" id="nationalid" dir="ltr" inputmode="numeric" maxlength="10" autocomplete="off" value="<?php echo getperson_h($nationalid); ?>" aria-invalid="<?php echo isset($field_errors['nationalid']) ? 'true' : 'false'; ?>" aria-describedby="hint-nationalid error-nationalid"/>
                        <p class="agri1-hint" id="hint-nationalid">ده رقم، بدون خط تیره</p>
                        <p class="agri1-error<?php echo isset($field_errors['nationalid']) ? '' : ' is-hidden'; ?>" id="error-nationalid"><?php echo isset($field_errors['nationalid']) ? getperson_h($field_errors['nationalid']) : ''; ?></p>
                    </div>
                </div>
                <div class="agri1-actions">
                    <button type="submit" name="go" id="go" value="1" class="agri1-btn agri1-btn-primary">جستجو</button>
                </div>
            </form>
        </section>

        <a name="1" id="1"></a>
<?php if ($did_search && empty($field_errors)) { ?>
        <section class="agri1-card" aria-label="نتیجه استعلام">
<?php if ($ws_error !== '') { ?>
            <p class="agri1-note"><?php echo getperson_h($ws_error); ?></p>
<?php } elseif ($result_ok) {
    $gender = (isset($result['gender']) && (int) $result['gender'] === 1) ? 'مرد' : 'زن';
    $live_ok = (isset($result['deathStatus']) && (string) $result['deathStatus'] === '0');
    $live = $live_ok ? 'زنده' : 'فوت شده';
    $formatted = isset($result['birthDate']) ? getperson_format_date($result['birthDate']) : '';
    if ($formatted === '') $formatted = 'نامشخص';
?>
            <h2 class="agri1-card-title">مشخصات یافت‌شده</h2>
            <dl class="agri1-dl">
                <dt>کد ملی</dt>
                <dd dir="ltr"><?php echo getperson_h(isset($result['nin']) ? $result['nin'] : $nationalid); ?></dd>
                <dt>نام</dt>
                <dd><?php echo getperson_h($result['name']); ?></dd>
                <dt>نام خانوادگی</dt>
                <dd><?php echo getperson_h(isset($result['family']) ? $result['family'] : ''); ?></dd>
                <dt>نام پدر</dt>
                <dd><?php echo getperson_h(isset($result['fatherName']) ? $result['fatherName'] : ''); ?></dd>
                <dt>شماره شناسنامه</dt>
                <dd dir="ltr"><?php echo getperson_h(isset($result['shenasnameNo']) ? $result['shenasnameNo'] : ''); ?></dd>
                <dt>جنسیت</dt>
                <dd><?php echo getperson_h($gender); ?></dd>
                <dt>تاریخ تولد</dt>
                <dd dir="ltr"><?php echo getperson_h($formatted); ?></dd>
                <dt>وضعیت حیات</dt>
                <dd class="<?php echo $live_ok ? 'agri1-status-ok' : 'agri1-status-no'; ?>"><?php echo getperson_h($live); ?></dd>
            </dl>
<?php } else { ?>
            <p class="agri1-note">فردی با مشخصات فوق یافت نشد.</p>
<?php } ?>
        </section>
<?php } ?>

        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="benefic.php" title="برگشت به صفحه قبل">
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
            <td height="109" style="background: url('../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../footer.php'); ?>
            </td>
        </tr>
    </table>
    <script>
        (function () {
            var fa = '۰۱۲۳۴۵۶۷۸۹';
            var ar = '٠١٢٣٤٥٦٧٨٩';
            function toLatin(v) {
                return String(v).replace(/[۰-۹٠-٩]/g, function (ch) {
                    var i = fa.indexOf(ch);
                    if (i > -1) return String(i);
                    i = ar.indexOf(ch);
                    return i > -1 ? String(i) : ch;
                }).replace(/[^\d]/g, '');
            }
            ['birthdate', 'nationalid'].forEach(function (id) {
                var el = document.getElementById(id);
                if (!el) return;
                el.addEventListener('input', function () {
                    this.value = toLatin(this.value);
                });
            });

            var form = document.getElementById('reg-form');
            var overlay = document.getElementById('agri1-overlay');
            var submitBtn = document.getElementById('go');
            var busy = false;
            if (!form) return;

            function setErr(id, msg) {
                var input = document.getElementById(id);
                var err = document.getElementById('error-' + id);
                if (input) input.setAttribute('aria-invalid', msg ? 'true' : 'false');
                if (err) {
                    err.textContent = msg || '';
                    if (msg) err.classList.remove('is-hidden');
                    else err.classList.add('is-hidden');
                }
            }

            form.addEventListener('submit', function (e) {
                if (busy) {
                    e.preventDefault();
                    return;
                }
                var birth = toLatin(document.getElementById('birthdate').value);
                var nid = toLatin(document.getElementById('nationalid').value);
                document.getElementById('birthdate').value = birth;
                document.getElementById('nationalid').value = nid;
                var ok = true;
                if (!/^\d{8}$/.test(birth)) {
                    setErr('birthdate', 'تاریخ تولد باید هشت رقم باشد (مثال: ۱۳۴۷۰۵۲۲)');
                    ok = false;
                } else setErr('birthdate', '');
                if (!/^\d{10}$/.test(nid)) {
                    setErr('nationalid', 'کد ملی باید ۱۰ رقم باشد');
                    ok = false;
                } else setErr('nationalid', '');
                if (!ok) {
                    e.preventDefault();
                    var first = form.querySelector('[aria-invalid="true"]');
                    if (first) first.focus();
                    return;
                }
                busy = true;
                if (overlay) overlay.className = 'agri1-overlay is-open';
                if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
            });
        })();
<?php if ($has_errors) { ?>
        (function () {
            var box = document.getElementById('agri1-error-summary');
            if (box) box.focus();
        })();
<?php } ?>
    </script>
</body>
</html>
