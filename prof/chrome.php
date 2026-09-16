<?php
/**
 * نوار بالا + منو + کارت کاربر — نسخهٔ مشترک ریشهٔ prof
 * menu.php و top.php و menup.php همین فایل را صدا می‌زنند (یک‌بار رندر می‌شود).
 * مسیر لینک‌ها از روی محل صفحهٔ جاری حساب می‌شود تا از Agri و Garden هم درست باشد.
 * بردکرامب: $pahneh_crumb (آرایه) یا $pahneh_crumb_title (متن صفحه) قبل از include.
 */
if (defined('PAHNEH_PROF_CHROME')) {
    return;
}
define('PAHNEH_PROF_CHROME', true);

if (!function_exists('pahneh_chrome_h')) {
    function pahneh_chrome_h($v)
    {
        if (!isset($v)) {
            return '';
        }
        return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('pahneh_rel_to')) {
    function pahneh_rel_to($fromDir, $toDir)
    {
        $norm = function ($p) {
            $p = str_replace('\\', '/', $p);
            $p = preg_replace('#/+#', '/', $p);
            return rtrim($p, '/');
        };
        $from = $norm($fromDir);
        $to = $norm($toDir);
        $fromReal = @realpath($fromDir);
        $toReal = @realpath($toDir);
        if ($fromReal && $toReal) {
            $from = $norm($fromReal);
            $to = $norm($toReal);
        }
        if (strcasecmp($from, $to) === 0) {
            return '';
        }
        $fromParts = explode('/', $from);
        $toParts = explode('/', $to);
        while ($fromParts && $toParts && strcasecmp($fromParts[0], $toParts[0]) === 0) {
            array_shift($fromParts);
            array_shift($toParts);
        }
        $up = count($fromParts);
        $down = count($toParts) ? implode('/', $toParts) . '/' : '';
        return str_repeat('../', $up) . $down;
    }
}

if (!function_exists('pahneh_chrome_icon')) {
    function pahneh_chrome_icon($name)
    {
        $paths = array(
            'home' => '<path d="M3 11L12 3l9 8"/><path d="M5 10v10h14V10"/>',
            'lock' => '<rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/>',
            'logout' => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/>',
            'user' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
            'mail' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 7 9-7"/>',
            'support' => '<path d="M4 13a8 8 0 0 1 16 0"/><path d="M4 13v5h4v-5"/><path d="M20 13v5h-4v-5"/><path d="M16 18a4 4 0 0 1-8 0"/>',
            'users' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
            'menu' => '<path d="M4 7h16"/><path d="M4 12h16"/><path d="M4 17h16"/>',
            'chevron' => '<path d="M6 9l6 6 6-6"/>',
            'ip' => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3a14 14 0 0 1 0 18"/><path d="M12 3a14 14 0 0 0 0 18"/>',
            'pin' => '<path d="M12 21s7-5.2 7-11a7 7 0 1 0-14 0c0 5.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>',
            'edit' => '<path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>',
            'city' => '<path d="M4 21V10l6-4 6 4v11"/><path d="M10 21V13h4v8"/><path d="M16 21V8h4v13"/>',
            'grid' => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>',
            'wheat' => '<path d="M12 3v18"/><path d="M5 10c3 0 5-3 7-7 2 4 4 7 7 7"/><path d="M5 16c3 0 5-3 7-7 2 4 4 7 7 7"/>',
            'leaf' => '<path d="M12 22V10"/><path d="M12 10c2-4 6-6 8-6-1 5-5 8-8 8z"/><path d="M12 10c-2-4-6-6-8-6 1 5 5 8 8 8z"/>',
            'bee' => '<path d="M12 8c3 0 6 2 6 5s-3 5-6 5-6-2-6-5 3-5 6-5z"/><path d="M8 8c0-3 2-5 4-5 1 2 1 4 0 6"/><path d="M16 8c0-3-2-5-4-5"/>',
            'fish' => '<path d="M3 12s4-6 9-6 9 6 9 6-4 6-9 6-9-6-9-6z"/><path d="M16 12h5"/><circle cx="9" cy="12" r="1"/>',
            'cow' => '<path d="M6 8c2-3 10-3 12 0"/><path d="M5 12h14"/><path d="M7 12v7"/><path d="M17 12v7"/><path d="M5 19h14"/><path d="M9 8V5"/><path d="M15 8V5"/>',
            'send' => '<path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4z"/>'
        );
        $d = isset($paths[$name]) ? $paths[$name] : '';
        return '<svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true">' . $d . '</svg>';
    }
}

if (!function_exists('pahneh_chrome_crumbs')) {
    function pahneh_chrome_crumbs($toRoot, $toProf)
    {
        if (isset($GLOBALS['pahneh_crumb']) && is_array($GLOBALS['pahneh_crumb']) && $GLOBALS['pahneh_crumb']) {
            return $GLOBALS['pahneh_crumb'];
        }

        $homeHref = $toRoot . 'indexbenef.php';
        $override = '';
        if (isset($GLOBALS['pahneh_crumb_title'])) {
            $override = trim($GLOBALS['pahneh_crumb_title'] . '');
        }

        $script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', $_SERVER['SCRIPT_NAME']) : '';
        $file = strtolower(basename($script));
        $pathLower = strtolower($script);

        $pages = array(
            'indexbenef.php' => 'خانه',
            'change-password.php' => 'تغییر رمز',
            'profile.php' => 'ویرایش پروفایل',
            'lists_abadi.php' => 'آبادی‌های تحت پوشش',
            'list_pubabadi.php' => 'اطلاعات عمومی آبادی‌ها',
            'lists_city.php' => 'شهرهای تحت پوشش',
            'list_pubcity.php' => 'اطلاعات عمومی شهرها',
            'list_expar.php' => 'کارشناسان معین',
            'search_promo.php' => 'ارسال پیام جدید',
            'messanger.php' => 'پیام‌های دریافتی',
            'sent_message.php' => 'پیام‌های ارسالی',
            'support.php' => 'پشتیبان',
            'interface.php' => 'رابط ستادی',
            'benefic.php' => 'بهره‌برداران کشاورزی',
            'benef.php' => 'ثبت بهره‌بردار جدید',
            'liste_benef.php' => 'لیست بهره‌برداران',
            'manager_benef.php' => 'جستجو با کد ملی',
            'list_bah_lastname.php' => 'جستجو با نام خانوادگی',
            'liste_benef_notok.php' => 'بهره‌برداران تایید نشده',
            'agri1.php' => 'ثبت بهره‌برداری زراعی',
            'agri2.php' => 'ثبت بهره‌برداری زراعی',
            'agri.php' => 'زراعت',
            'liste_agri.php' => 'لیست بهره‌برداری‌ها',
            'manager_agri.php' => 'جستجوی بهره‌برداری',
            'agri_rep1.php' => 'گزارش اطلاعات زراعی',
            'agri_edit.php' => 'ویرایش بهره‌برداری زراعی',
            'agrip_edit_t_98.php' => 'گزارش تولید زراعی',
            'garden.php' => 'ثبت بهره‌برداری باغی',
            'liste_garden.php' => 'لیست بهره‌برداری‌ها',
            'manager_garden.php' => 'جستجوی بهره‌برداری',
            'greenhous.php' => 'ثبت گلخانه جدید',
            'liste_greenhousn.php' => 'لیست گلخانه‌ها',
            'list_greenhous_nonp.php' => 'گلخانه‌های فاقد عملکرد',
            'animal' => 'ثبت دامداری جدید',
            'liste_animal' => 'لیست دامداری‌ها',
            'finish_animal' => 'اعلام خاتمه عملیات',
            'aquatic.php' => 'ثبت مزرعه تکثیر و پرورش',
            'liste_aquatic.php' => 'لیست مزارع تکثیر و پرورش',
            'manager_aquatic.php' => 'جستجوی مزرعه تکثیر و پرورش',
            'bee.php' => 'ثبت زنبورستان جدید',
            'list_bee.php' => 'لیست زنبورستان‌ها',
            'unknown_bee.php' => 'ثبت زنبورستان ناشناس',
            'list_unknown_bee.php' => 'لیست زنبورستان ناشناس'
        );

        $label = $override;
        if ($label === '' && isset($pages[$file])) {
            $label = $pages[$file];
        }
        if ($label === '') {
            $fileNoExt = preg_replace('/\.php$/i', '', $file);
            if (isset($pages[$fileNoExt])) {
                $label = $pages[$fileNoExt];
            }
        }

        if ($file === 'indexbenef.php') {
            return array(array('label' => 'خانه'));
        }
        if ($label === '' && $file === 'index.php' && strpos($pathLower, '/prof/index.php') !== false) {
            $label = 'اطلاعات اختصاصی';
        }

        $crumbs = array(array('label' => 'خانه', 'href' => $homeHref));

        $sections = array(
            '/agri/' => array('زراعت', $toProf . 'Agri/'),
            '/garden/' => array('باغبانی', $toProf . 'Garden/'),
            '/animal/' => array('دام', $toProf . 'Animal/'),
            '/aquatic/' => array('آبزی‌پروری', $toProf . 'Aquatic/'),
            '/poultry/' => array('طیور و زنبورعسل', $toProf . 'Poultry/')
        );
        foreach ($sections as $needle => $sec) {
            if (strpos($pathLower, $needle) !== false) {
                $crumbs[] = array('label' => $sec[0], 'href' => $sec[1]);
                break;
            }
        }

        if ($label === '') {
            if (count($crumbs) > 1) {
                return $crumbs;
            }
            $label = 'صفحه جاری';
        }

        $last = $crumbs[count($crumbs) - 1];
        if ($label !== $last['label']) {
            $crumbs[] = array('label' => $label);
        }

        return $crumbs;
    }
}

$pahneh_site_dir = dirname(__DIR__);
$pahneh_prof_dir = __DIR__;
$pahneh_script_dir = isset($_SERVER['SCRIPT_FILENAME'])
    ? dirname($_SERVER['SCRIPT_FILENAME'])
    : $pahneh_prof_dir;

$toRoot = pahneh_rel_to($pahneh_script_dir, $pahneh_site_dir);
$toProf = pahneh_rel_to($pahneh_script_dir, $pahneh_prof_dir);

include_once $pahneh_site_dir . DIRECTORY_SEPARATOR . 'lock_p1.php';
include_once $pahneh_site_dir . DIRECTORY_SEPARATOR . 'login' . DIRECTORY_SEPARATOR . 'config.php';

$count_pm = 0;
if (isset($dbh, $login_session) && $login_session !== '') {
    try {
        $stmt = $dbh->prepare("SELECT ru_read FROM `pm` WHERE r_user = :u AND ru_read = '1'");
        $stmt->execute(array(':u' => $login_session));
        $count_pm = (int) $stmt->rowCount();
    } catch (Exception $e) {
        $count_pm = 0;
    }
}

if (!function_exists('getUserIP')) {
    function getUserIP()
    {
        $ip = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        }
        $parts = explode(',', $ip);
        $ip = trim($parts[0]);
        if (strpos($ip, '.') !== false && substr_count($ip, ':') === 1) {
            $ipParts = explode(':', $ip);
            return $ipParts[0];
        }
        return $ip;
    }
}

$pic = isset($pic) ? $pic : '';
$ostan = isset($ostan) ? $ostan : '';
$city = isset($city) ? $city : '';
$markaz = isset($markaz) ? $markaz : '';
$v_jen = isset($v_jen) ? $v_jen : '';
$PersName = isset($PersName) ? $PersName : '';
$name = isset($name) ? $name : '';

$user_display = trim($v_jen . ' ' . $PersName);
$place_parts = array();
if ($ostan !== '') {
    $place_parts[] = $ostan;
}
if ($city !== '') {
    $place_parts[] = $city;
}
if ($markaz !== '') {
    $place_parts[] = $markaz;
}
$place_text = implode(' / ', $place_parts);
$pic_src = ($pic !== '') ? ($toRoot . 'files/users/' . $pic) : '';
$user_ip = getUserIP();
$pahneh_crumbs = pahneh_chrome_crumbs($toRoot, $toProf);
$msg_label = ($count_pm > 0)
    ? ('پیام‌ها، ' . (int) $count_pm . ' خوانده‌نشده')
    : 'پیام‌ها';
?>
<link href="<?php echo pahneh_chrome_h($toRoot); ?>FA.css" rel="stylesheet" type="text/css"/>
<style>
    .agri1-chrome {
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
        --space-1: 8px;
        --space-2: 16px;
        --space-3: 24px;
        --radius: 12px;
        --duration: 200ms;
        --shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
        --touch: 44px;
        --font: myfont, Tahoma, "Segoe UI", sans-serif;
        --chrome-crumb-h: 32px;
        box-sizing: border-box;
        position: relative;
        z-index: 50;
        width: 100%;
        max-width: 100%;
        margin: 0 0 var(--space-2);
        color: var(--color-foreground);
        font-family: var(--font);
        font-size: 16px;
        line-height: 1.6;
        background: var(--color-background);
    }
    .agri1-chrome *,
    .agri1-chrome *::before,
    .agri1-chrome *::after { box-sizing: border-box; }

    .agri1-chrome a { color: inherit; text-decoration: none; }
    .agri1-chrome a:hover { text-decoration: underline; }
    .agri1-chrome button {
        font: inherit;
        color: inherit;
        background: none;
        border: 0;
        cursor: pointer;
    }
    .agri1-chrome :focus-visible {
        outline: 3px solid var(--color-ring);
        outline-offset: 2px;
    }

    .agri1-chrome .agri1-icon {
        flex: 0 0 auto;
        width: 24px;
        height: 24px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .agri1-chrome-sr {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    .agri1-chrome-bar {
        --chrome-chip-h: 48px;
        --chrome-chip-bg: rgba(255, 255, 255, 0.12);
        --chrome-crumb-h: 32px;
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: flex-start;
        gap: 8px;
        padding: 8px 12px;
        background: var(--color-primary);
        color: var(--color-on-primary);
    }
    .agri1-chrome-bar a {
        color: var(--color-on-primary);
    }
    .agri1-chrome-bar a:hover { text-decoration: none; }
    .agri1-chrome-bar :focus-visible {
        outline-color: #FFFFFF;
    }

    .agri1-chrome-chip,
    .agri1-chrome button.agri1-chrome-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        height: var(--chrome-chip-h);
        min-height: var(--chrome-chip-h);
        max-height: var(--chrome-chip-h);
        padding: 0 12px;
        border-radius: 999px;
        background: var(--chrome-chip-bg);
        color: var(--color-on-primary);
        min-width: 0;
    }

    .agri1-chrome-crumb {
        display: flex;
        align-items: center;
        width: 100%;
        height: var(--chrome-crumb-h, 32px);
        min-height: var(--chrome-crumb-h, 32px);
        max-height: var(--chrome-crumb-h, 32px);
        padding: 0 16px;
        background: #ECFDF3;
        color: var(--color-foreground);
        border-bottom: 1px solid var(--color-border);
        box-sizing: border-box;
    }
    .agri1-chrome-brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        flex: 0 1 auto;
        margin: 0;
        margin-inline-end: auto;
        max-width: min(580px, 58vw);
        min-width: 0;
        color: #FFFFFF;
    }
    .agri1-chrome-brand-mark {
        flex: 0 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 51px;
        height: 51px;
    }
    .agri1-chrome-brand-mark img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: contain;
        filter: brightness(0) invert(1);
    }
    .agri1-chrome-brand-text {
        margin: 0;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        text-align: right;
        font-size: 0.9375rem;
        font-weight: 500;
        line-height: 1.3;
        color: #FFFFFF;
    }
    .agri1-chrome-crumb ol {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        gap: 6px;
        list-style: none;
        margin: 0;
        padding: 0;
        width: 100%;
        min-width: 0;
        overflow: hidden;
    }
    .agri1-chrome-crumb li {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        flex: 0 0 auto;
        font-size: 0.8125rem;
        font-weight: 400;
        line-height: 1.2;
        white-space: nowrap;
    }
    .agri1-chrome-crumb li:last-child {
        flex: 1 1 auto;
        min-width: 0;
        overflow: hidden;
    }
    .agri1-chrome-crumb li + li::before {
        content: ">";
        flex: 0 0 auto;
        opacity: 0.55;
        font-weight: 500;
        color: var(--color-muted-foreground);
    }
    .agri1-chrome-crumb a {
        display: inline-flex;
        align-items: center;
        height: 28px;
        padding: 0 4px;
        border-radius: 6px;
        color: var(--color-primary);
        font-weight: 400;
    }
    .agri1-chrome-crumb a:hover { background: #DCFCE7; text-decoration: none; }
    .agri1-chrome-crumb [aria-current="page"] {
        display: block;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-weight: 500;
        color: var(--color-foreground);
        padding: 0 4px;
    }

    .agri1-chrome-tools {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        width: auto;
        min-width: 0;
        flex: 0 1 auto;
        margin-inline-start: auto;
    }

    .agri1-chrome-place-chip,
    .agri1-chrome button.agri1-chrome-place-chip {
        flex: 0 0 auto;
        width: max-content;
        max-width: none;
        height: 32px;
        min-height: 32px;
        max-height: 32px;
        gap: 4px;
        padding: 0 8px;
        overflow: visible;
        font-size: 0.625rem;
        line-height: 1.25;
    }
    .agri1-chrome-place-chip .agri1-icon {
        width: 14px;
        height: 14px;
    }
    .agri1-chrome-place-text {
        overflow: visible;
        text-overflow: clip;
        white-space: nowrap;
    }

    .agri1-chrome-icons {
        display: flex;
        flex: 0 0 auto;
        align-items: center;
        gap: 8px;
    }

    .agri1-chrome-account { position: relative; flex: 0 0 auto; }
    .agri1-chrome-account-btn {
        padding-inline-start: 4px;
        padding-inline-end: 12px;
        gap: 8px;
    }
    .agri1-chrome-account-btn:hover,
    .agri1-chrome-account.is-open > .agri1-chrome-account-btn {
        background: var(--color-secondary);
    }
    .agri1-chrome-account-btn .agri1-icon {
        width: 18px;
        height: 18px;
        transition: transform var(--duration) ease;
    }
    .agri1-chrome-account.is-open .agri1-chrome-account-btn .agri1-icon {
        transform: rotate(180deg);
    }
    .agri1-chrome-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        width: 42px;
        height: 42px;
        overflow: hidden;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.45);
        background: rgba(255, 255, 255, 0.22);
    }
    .agri1-chrome-avatar img {
        display: block;
        width: 42px;
        height: 42px;
        object-fit: contain;
        object-position: center;
    }
    .agri1-chrome-avatar-fallback {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: var(--color-on-primary);
    }
    .agri1-chrome-avatar-fallback .agri1-icon { width: 22px; height: 22px; }
    .agri1-chrome-account-name {
        max-width: 140px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-weight: 700;
        font-size: 0.875rem;
        line-height: 1.3;
    }

    .agri1-chrome-account-menu {
        display: none;
        position: absolute;
        top: calc(100% + 4px);
        inset-inline-end: 0;
        min-width: 240px;
        max-width: min(320px, calc(100vw - 16px));
        padding: 8px 0;
        background: var(--color-card);
        color: var(--color-card-foreground);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        box-shadow: var(--shadow);
        z-index: 40;
    }
    .agri1-chrome-account.is-open > .agri1-chrome-account-menu { display: block; }
    .agri1-chrome-account-meta {
        display: flex;
        flex-direction: column;
        gap: 2px;
        padding: 8px 14px 10px;
        border-bottom: 1px solid var(--color-border);
    }
    .agri1-chrome-account-meta strong {
        font-size: 0.9375rem;
        line-height: 1.4;
        text-wrap: balance;
    }
    .agri1-chrome-account-meta span {
        color: var(--color-muted-foreground);
        font-size: 0.8125rem;
    }
    .agri1-chrome-account-menu a,
    .agri1-chrome-account-ip {
        display: flex;
        align-items: center;
        gap: 8px;
        min-height: var(--touch);
        padding: 0 14px;
        color: var(--color-card-foreground);
    }
    .agri1-chrome-account-menu a:hover {
        background: #ECFDF3;
        text-decoration: none;
    }
    .agri1-chrome-account-ip {
        color: var(--color-muted-foreground);
        font-size: 0.875rem;
    }
    .agri1-chrome-account-sep {
        height: 1px;
        margin: 6px 0;
        background: var(--color-border);
        border: 0;
    }
    .agri1-chrome-account-menu a.is-danger { color: var(--color-destructive); }
    .agri1-chrome-account-menu a.is-danger:hover { background: #FEF2F2; }
    .agri1-chrome-ip { direction: ltr; unicode-bidi: isolate; }

    .agri1-chrome-iconbtn {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: var(--chrome-chip-h);
        height: var(--chrome-chip-h);
        min-width: var(--chrome-chip-h);
        min-height: var(--chrome-chip-h);
        padding: 0;
        border-radius: 50%;
        color: var(--color-on-primary);
        background: var(--chrome-chip-bg);
    }
    .agri1-chrome-iconbtn:hover { background: var(--color-secondary); }
    .agri1-chrome-iconbtn .agri1-chrome-badge {
        position: absolute;
        top: 2px;
        inset-inline-end: 2px;
        min-width: 18px;
        height: 18px;
        padding: 0 5px;
        font-size: 0.6875rem;
    }

    .agri1-chrome-nav {
        position: relative;
        z-index: 30;
        overflow: visible;
        background: var(--color-card);
        color: var(--color-foreground);
        padding: 0 8px;
        border-bottom: 1px solid var(--color-border);
    }
    .agri1-chrome-burger {
        display: none;
        align-items: center;
        gap: 8px;
        min-height: 40px;
        padding: 0 12px;
        border-radius: 8px;
        color: var(--color-foreground);
        font-weight: 400;
    }
    .agri1-chrome-burger:hover { background: #ECFDF3; }

    .agri1-chrome-menu,
    .agri1-chrome-sub {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .agri1-chrome-menu {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        gap: 0 4px;
        overflow: visible;
    }
    .agri1-chrome-item { position: relative; z-index: 1; }
    .agri1-chrome-item.is-parent:hover,
    .agri1-chrome-item.is-parent:focus-within,
    .agri1-chrome-item.is-parent.is-open {
        z-index: 6;
    }
    .agri1-chrome-row {
        display: flex;
        align-items: stretch;
    }
    .agri1-chrome-tab,
    .agri1-chrome-row > a,
    .agri1-chrome-caret-text {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 44px;
        padding: 0 18px;
        border: 0;
        border-bottom: 2px solid transparent;
        border-radius: 0;
        color: var(--color-foreground);
        background: transparent;
        font-size: 0.875rem;
        font-weight: 400;
        white-space: nowrap;
    }
    .agri1-chrome-tab .agri1-icon,
    .agri1-chrome-row > a .agri1-icon,
    .agri1-chrome-caret-text .agri1-icon {
        width: 16px;
        height: 16px;
        color: var(--color-muted-foreground);
    }
    .agri1-chrome-row > a:hover,
    .agri1-chrome-caret-text:hover,
    .agri1-chrome-tab:hover,
    .agri1-chrome-item.is-open > .agri1-chrome-row > a,
    .agri1-chrome-item.is-open > .agri1-chrome-row > .agri1-chrome-caret-text,
    .agri1-chrome-item.is-open > .agri1-chrome-row > .agri1-chrome-tab {
        background: transparent;
        border-bottom-color: var(--color-primary);
        color: var(--color-primary);
        text-decoration: none;
    }
    .agri1-chrome-caret {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        min-width: 36px;
        min-height: 44px;
        border-radius: 0;
        color: var(--color-muted-foreground);
    }
    .agri1-chrome-caret.agri1-chrome-caret-text {
        width: auto;
        min-width: 0;
        margin-inline-start: 0;
        justify-content: flex-start;
    }
    .agri1-chrome-caret:hover { background: transparent; color: var(--color-primary); }
    .agri1-chrome-caret .agri1-icon { width: 16px; height: 16px; }

    .agri1-chrome-sub {
        display: none;
        position: absolute;
        top: calc(100% - 2px);
        inset-inline-start: 0;
        min-width: 240px;
        max-width: min(320px, calc(100vw - 16px));
        padding: 8px 0;
        background: var(--color-card);
        color: var(--color-card-foreground);
        border: 1px solid var(--color-border);
        border-radius: 8px;
        box-shadow: var(--shadow);
        z-index: 40;
        pointer-events: auto;
    }
    .agri1-chrome-sub::before {
        content: "";
        position: absolute;
        right: 0;
        left: 0;
        bottom: 100%;
        height: 10px;
    }
    .agri1-chrome-sub a,
    .agri1-chrome-sub .agri1-chrome-caret-text {
        color: var(--color-card-foreground);
        width: 100%;
        min-height: 44px;
        white-space: normal;
        border: 0;
        border-radius: 0;
        padding: 10px 18px;
        font-size: 0.875rem;
        font-weight: 400;
        text-align: right;
    }
    .agri1-chrome-sub > li > a {
        display: flex;
        align-items: center;
    }
    .agri1-chrome-sub .agri1-chrome-caret { color: var(--color-foreground); }
    .agri1-chrome-sub a:hover,
    .agri1-chrome-sub .agri1-chrome-caret-text:hover {
        background: #ECFDF3;
        color: var(--color-primary);
        text-decoration: none;
    }

    .agri1-chrome-sub .agri1-chrome-row {
        width: 100%;
    }
    .agri1-chrome-sub .agri1-chrome-row > a {
        flex: 1 1 auto;
        min-width: 0;
        padding-inline-end: 8px;
    }
    .agri1-chrome-sub .agri1-chrome-sub {
        top: -8px;
        inset-inline-start: 100%;
        inset-inline-end: auto;
        margin: 0;
        z-index: 41;
    }
    .agri1-chrome-sub .agri1-chrome-sub::before {
        top: 0;
        bottom: 0;
        inset-inline-start: -12px;
        inset-inline-end: auto;
        width: 12px;
        height: auto;
    }

    @media (min-width: 901px) {
        .agri1-chrome-item.is-parent:hover > .agri1-chrome-sub,
        .agri1-chrome-item.is-parent:focus-within > .agri1-chrome-sub,
        .agri1-chrome-item.is-parent.is-open > .agri1-chrome-sub {
            display: block;
        }
    }

    .agri1-chrome-user {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: var(--space-2);
        padding: 12px var(--space-2);
        background: var(--color-card);
        color: var(--color-card-foreground);
        border: 1px solid var(--color-border);
        border-top: 0;
        box-shadow: var(--shadow);
    }
    .agri1-chrome-who { flex: 1 1 220px; min-width: 0; }
    .agri1-chrome-title {
        margin: 0 0 4px;
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.45;
        text-wrap: balance;
    }
    .agri1-chrome-role {
        margin: 0;
        color: var(--color-muted-foreground);
        font-size: 0.875rem;
    }
    .agri1-chrome-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 22px;
        height: 22px;
        padding: 0 6px;
        border-radius: 999px;
        background: var(--color-destructive);
        color: var(--color-on-destructive);
        font-size: 0.75rem;
        font-weight: 700;
        line-height: 1;
    }

    @media (max-width: 900px) {
        .agri1-chrome-tools { width: auto; flex-wrap: nowrap; }
        .agri1-chrome-burger { display: inline-flex; }
        .agri1-chrome-menu {
            display: none;
            flex-direction: column;
            flex-wrap: nowrap;
            gap: 8px;
            margin-top: 8px;
            padding: 8px;
            background: var(--color-card);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
        }
        .agri1-chrome-menu.is-open { display: flex; }
        .agri1-chrome-row > a,
        .agri1-chrome-caret-text,
        .agri1-chrome-tab,
        .agri1-chrome-caret {
            color: var(--color-foreground);
            width: 100%;
            justify-content: flex-start;
        }
        .agri1-chrome-row > a:hover,
        .agri1-chrome-caret-text:hover,
        .agri1-chrome-tab:hover,
        .agri1-chrome-item.is-open > .agri1-chrome-row > a,
        .agri1-chrome-item.is-open > .agri1-chrome-row > .agri1-chrome-caret-text,
        .agri1-chrome-item.is-open > .agri1-chrome-row > .agri1-chrome-tab {
            background: #ECFDF3;
            border-color: var(--color-border);
        }
        .agri1-chrome-sub {
            position: static;
            display: none;
            min-width: 0;
            max-width: none;
            margin: 0;
            border: 0;
            border-radius: 0;
            box-shadow: none;
            top: auto;
        }
        .agri1-chrome-sub::before { display: none; }
        .agri1-chrome-item.is-open > .agri1-chrome-sub { display: block; }
        .agri1-chrome-sub .agri1-chrome-sub { position: static; margin: 0; padding-right: 16px; }
        .agri1-chrome-brand { max-width: min(340px, 48vw); }
        .agri1-chrome-brand-text { font-size: 0.875rem; }
        .agri1-chrome-brand-mark { width: 46px; height: 46px; }
    }

    @media (max-width: 640px) {
        .agri1-chrome-user { align-items: flex-start; }
        .agri1-chrome-title { font-size: 0.95rem; }
        .agri1-chrome-account-name { max-width: 96px; }
        .agri1-chrome-place-chip { flex: 0 0 auto; width: max-content; }
        .agri1-chrome-crumb { padding: 0 12px; }
        .agri1-chrome-brand { max-width: min(280px, 44vw); }
        .agri1-chrome-brand-text { font-size: 0.8125rem; }
        .agri1-chrome-brand-mark { width: 41px; height: 41px; }
    }

    @media (prefers-reduced-motion: reduce) {
        .agri1-chrome,
        .agri1-chrome * {
            transition-duration: 0.01ms !important;
        }
    }
</style>

<header class="agri1-chrome" dir="rtl" lang="fa">
    <div class="agri1-chrome-bar">
        <div class="agri1-chrome-brand">
            <span class="agri1-chrome-brand-mark">
                <img src="<?php echo pahneh_chrome_h($toProf); ?>1.png" width="51" height="51" alt="جهاد کشاورزی"/>
            </span>
            <p class="agri1-chrome-brand-text" title="سامانه جامع پهنه بندی و مدیریت داده های کشاورزی">سامانه جامع پهنه بندی و مدیریت داده های کشاورزی</p>
        </div>
        <div class="agri1-chrome-tools">
            <?php if ($place_text !== '') { ?>
                <span class="agri1-chrome-chip agri1-chrome-place-chip" title="<?php echo pahneh_chrome_h('محل خدمت: ' . $place_text); ?>">
                    <?php echo pahneh_chrome_icon('pin'); ?>
                    <span class="agri1-chrome-place-text">محل خدمت: <?php echo pahneh_chrome_h($place_text); ?></span>
                </span>
            <?php } ?>

            <div class="agri1-chrome-icons">
                <a class="agri1-chrome-iconbtn" href="<?php echo pahneh_chrome_h($toRoot); ?>messanger.php" title="سیستم ارسال و دریافت پیام" aria-label="<?php echo pahneh_chrome_h($msg_label); ?>">
                    <?php echo pahneh_chrome_icon('mail'); ?>
                    <?php if ($count_pm > 0) { ?>
                        <span class="agri1-chrome-badge" id="mes_count"><?php echo (int) $count_pm; ?></span>
                    <?php } ?>
                </a>
                <a class="agri1-chrome-iconbtn" href="<?php echo pahneh_chrome_h($toRoot); ?>support.php" onclick="return pahnehChromePopup(this.href)" title="ارتباط با پشتیبان سامانه" aria-label="پشتیبان سامانه">
                    <?php echo pahneh_chrome_icon('support'); ?>
                </a>
                <a class="agri1-chrome-iconbtn" href="<?php echo pahneh_chrome_h($toRoot); ?>interface.php" onclick="return pahnehChromePopup(this.href)" title="ارتباط با رابط ستادی" aria-label="رابط ستادی">
                    <?php echo pahneh_chrome_icon('users'); ?>
                </a>
            </div>

            <div class="agri1-chrome-account">
                <button type="button" class="agri1-chrome-chip agri1-chrome-account-btn" aria-expanded="false" aria-haspopup="true" aria-controls="agri1-chrome-account-menu">
                    <span class="agri1-chrome-avatar">
                        <?php if ($pic_src !== '') { ?>
                            <img src="<?php echo pahneh_chrome_h($pic_src); ?>" width="42" height="42" alt="<?php echo pahneh_chrome_h(($user_display === '' && $name === '') ? 'تصویر کارشناس' : ''); ?>"/>
                        <?php } else { ?>
                            <span class="agri1-chrome-avatar-fallback"><?php echo pahneh_chrome_icon('user'); ?></span>
                        <?php } ?>
                    </span>
                    <span class="agri1-chrome-account-name"><?php echo pahneh_chrome_h($user_display !== '' ? $user_display : $name); ?></span>
                    <?php echo pahneh_chrome_icon('chevron'); ?>
                </button>
                <div class="agri1-chrome-account-menu" id="agri1-chrome-account-menu">
                    <div class="agri1-chrome-account-meta">
                        <strong><?php echo pahneh_chrome_h($user_display !== '' ? $user_display : 'کارشناس'); ?></strong>
                        <?php if ($name !== '') { ?>
                            <span><?php echo pahneh_chrome_h($name); ?></span>
                        <?php } ?>
                    </div>
                    <div class="agri1-chrome-account-ip" title="نشانی اینترنتی">
                        <?php echo pahneh_chrome_icon('ip'); ?>
                        <span class="agri1-chrome-ip"><?php echo pahneh_chrome_h($user_ip); ?></span>
                    </div>
                    <a href="<?php echo pahneh_chrome_h($toRoot); ?>profile.php">
                        <?php echo pahneh_chrome_icon('edit'); ?>
                        <span>ویرایش پروفایل</span>
                    </a>
                    <a href="<?php echo pahneh_chrome_h($toRoot); ?>change-password.php">
                        <?php echo pahneh_chrome_icon('lock'); ?>
                        <span>تغییر رمز</span>
                    </a>
                    <hr class="agri1-chrome-account-sep"/>
                    <a class="is-danger" href="<?php echo pahneh_chrome_h($toRoot); ?>login/logout.php">
                        <?php echo pahneh_chrome_icon('logout'); ?>
                        <span>خروج از سیستم</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <nav class="agri1-chrome-crumb" aria-label="موقعیت صفحه">
        <ol>
            <?php
            $crumb_last = count($pahneh_crumbs) - 1;
            foreach ($pahneh_crumbs as $i => $crumb) {
                $crumb_label = isset($crumb['label']) ? $crumb['label'] : '';
                $crumb_href = isset($crumb['href']) ? $crumb['href'] : '';
                echo '<li>';
                if ($i === $crumb_last || $crumb_href === '') {
                    echo '<span aria-current="page">' . pahneh_chrome_h($crumb_label) . '</span>';
                } else {
                    echo '<a href="' . pahneh_chrome_h($crumb_href) . '">' . pahneh_chrome_h($crumb_label) . '</a>';
                }
                echo '</li>';
            }
            ?>
        </ol>
    </nav>

    <nav class="agri1-chrome-nav" aria-label="منوی سامانه">
        <button type="button" class="agri1-chrome-burger" aria-expanded="false" aria-controls="agri1-chrome-menu">
            <?php echo pahneh_chrome_icon('menu'); ?>
            <span>منو</span>
        </button>
        <ul id="agri1-chrome-menu" class="agri1-chrome-menu">
            <li class="agri1-chrome-item is-parent">
                <div class="agri1-chrome-row">
                    <button type="button" class="agri1-chrome-caret agri1-chrome-caret-text agri1-chrome-tab" aria-expanded="false">
                        <span>آبادی ها</span>
                        <?php echo pahneh_chrome_icon('chevron'); ?>
                    </button>
                </div>
                <ul class="agri1-chrome-sub">
                    <li><a href="<?php echo pahneh_chrome_h($toRoot); ?>lists_abadi.php">آبادی های تحت پوشش</a></li>
                    <li><a href="<?php echo pahneh_chrome_h($toRoot); ?>list_pubabadi.php">اطلاعات عمومی آبادی ها</a></li>
                </ul>
            </li>
            <li class="agri1-chrome-item is-parent">
                <div class="agri1-chrome-row">
                    <button type="button" class="agri1-chrome-caret agri1-chrome-caret-text agri1-chrome-tab" aria-expanded="false">
                        <span>شهرها</span>
                        <?php echo pahneh_chrome_icon('chevron'); ?>
                    </button>
                </div>
                <ul class="agri1-chrome-sub">
                    <li><a href="<?php echo pahneh_chrome_h($toRoot); ?>lists_city.php">شهر های تحت پوشش</a></li>
                    <li><a href="<?php echo pahneh_chrome_h($toRoot); ?>list_pubcity.php">اطلاعات عمومی شهر ها</a></li>
                </ul>
            </li>
            <li class="agri1-chrome-item is-parent">
                <div class="agri1-chrome-row">
                    <a class="agri1-chrome-tab" href="<?php echo pahneh_chrome_h($toProf); ?>">اطلاعات اختصاصی</a>
                    <button type="button" class="agri1-chrome-caret" aria-expanded="false" aria-label="زیرمنوی اطلاعات اختصاصی">
                        <?php echo pahneh_chrome_icon('chevron'); ?>
                    </button>
                </div>
                <ul class="agri1-chrome-sub">
                    <li class="agri1-chrome-item is-parent">
                        <div class="agri1-chrome-row">
                            <a href="<?php echo pahneh_chrome_h($toProf); ?>benefic.php">بهره برداران کشاورزی</a>
                            <button type="button" class="agri1-chrome-caret" aria-expanded="false" aria-label="زیرمنوی بهره برداران کشاورزی">
                                <?php echo pahneh_chrome_icon('chevron'); ?>
                            </button>
                        </div>
                        <ul class="agri1-chrome-sub">
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>benef.php">ثبت بهره بردار جدید</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>liste_benef.php">لیست بهره برداران</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>manager_benef.php">جستجو با کد ملی</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>list_bah_lastname.php">جستجو با نام خانوادگی</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>liste_benef_notok.php">بهره برداران تایید نشده</a></li>
                        </ul>
                    </li>
                    <li class="agri1-chrome-item is-parent">
                        <div class="agri1-chrome-row">
                            <a href="<?php echo pahneh_chrome_h($toProf); ?>Poultry/">طیور و زنبورعسل</a>
                            <button type="button" class="agri1-chrome-caret" aria-expanded="false" aria-label="زیرمنوی طیور و زنبورعسل">
                                <?php echo pahneh_chrome_icon('chevron'); ?>
                            </button>
                        </div>
                        <ul class="agri1-chrome-sub">
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Poultry/bee.php">ثبت زنبورستان جدید</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Poultry/list_bee.php">لیست زنبورستان ها</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Poultry/unknown_bee.php">ثبت زنبورستان ناشناس</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Poultry/list_unknown_bee.php">لیست زنبورستان ناشناس</a></li>
                        </ul>
                    </li>
                    <li class="agri1-chrome-item is-parent">
                        <div class="agri1-chrome-row">
                            <a href="<?php echo pahneh_chrome_h($toProf); ?>Animal/">دام</a>
                            <button type="button" class="agri1-chrome-caret" aria-expanded="false" aria-label="زیرمنوی دام">
                                <?php echo pahneh_chrome_icon('chevron'); ?>
                            </button>
                        </div>
                        <ul class="agri1-chrome-sub">
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Animal/Animal">ثبت دامداری جدید</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Animal/liste_Animal">لیست دامداری ها</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Animal/finish_Animal">اعلام خاتمه عملیات</a></li>
                        </ul>
                    </li>
                    <li class="agri1-chrome-item is-parent">
                        <div class="agri1-chrome-row">
                            <a href="<?php echo pahneh_chrome_h($toProf); ?>Aquatic/">آبزی پروی</a>
                            <button type="button" class="agri1-chrome-caret" aria-expanded="false" aria-label="زیرمنوی آبزی پروری">
                                <?php echo pahneh_chrome_icon('chevron'); ?>
                            </button>
                        </div>
                        <ul class="agri1-chrome-sub">
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Aquatic/Aquatic.php">ثبت مزرعه تکثیر و پرورش</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Aquatic/liste_Aquatic.php">لیست مزارع تکثیر و پرورش</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Aquatic/manager_Aquatic.php">جستجوی یک مزرعه</a></li>
                        </ul>
                    </li>
                    <li class="agri1-chrome-item is-parent">
                        <div class="agri1-chrome-row">
                            <a href="<?php echo pahneh_chrome_h($toProf); ?>Agri/">زراعت</a>
                            <button type="button" class="agri1-chrome-caret" aria-expanded="false" aria-label="زیرمنوی زراعت">
                                <?php echo pahneh_chrome_icon('chevron'); ?>
                            </button>
                        </div>
                        <ul class="agri1-chrome-sub">
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Agri/Agri1.php">ثبت بهره برداری زراعی</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Agri/liste_Agri.php">لیست بهره برداری ها</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Agri/manager_Agri.php">جستجوی بهره برداری</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Agri/Agri_rep1.php">گزارش اطلاعات زراعی</a></li>
                        </ul>
                    </li>
                    <li class="agri1-chrome-item is-parent">
                        <div class="agri1-chrome-row">
                            <a href="<?php echo pahneh_chrome_h($toProf); ?>Garden/">باغبانی</a>
                            <button type="button" class="agri1-chrome-caret" aria-expanded="false" aria-label="زیرمنوی باغبانی">
                                <?php echo pahneh_chrome_icon('chevron'); ?>
                            </button>
                        </div>
                        <ul class="agri1-chrome-sub">
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Garden/Garden.php">ثبت بهره برداری باغی</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Garden/liste_Garden.php">لیست بهره برداری ها</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Garden/manager_Garden.php">جستجوی بهره برداری</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Garden/Greenhous.php">ثبت گلخانه جدید</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Garden/liste_Greenhousn.php">لیست گلخانه ها</a></li>
                            <li><a href="<?php echo pahneh_chrome_h($toProf); ?>Garden/list_Greenhous_nonP.php">گلخانه های فاقد عملکرد</a></li>
                        </ul>
                    </li>
                    <li><a href="#">آب و خاک</a></li>
                    <li><a href="#">صنایع کشاورزی</a></li>
                    <li><a href="#">ترویج</a></li>
                </ul>
            </li>
            <li class="agri1-chrome-item">
                <div class="agri1-chrome-row">
                    <a class="agri1-chrome-tab" href="<?php echo pahneh_chrome_h($toRoot); ?>list_expar.php">کارشناسان معین</a>
                </div>
            </li>
            <li class="agri1-chrome-item is-parent">
                <div class="agri1-chrome-row">
                    <button type="button" class="agri1-chrome-caret agri1-chrome-caret-text agri1-chrome-tab" aria-expanded="false">
                        <span>سیستم پیام</span>
                        <?php echo pahneh_chrome_icon('chevron'); ?>
                    </button>
                </div>
                <ul class="agri1-chrome-sub">
                    <li><a href="<?php echo pahneh_chrome_h($toRoot); ?>search_promo.php" target="_blank" rel="noopener noreferrer">ارسال پیام جدید</a></li>
                    <li><a href="<?php echo pahneh_chrome_h($toRoot); ?>messanger.php" target="_blank" rel="noopener noreferrer">پیام های دریافتی</a></li>
                    <li><a href="<?php echo pahneh_chrome_h($toRoot); ?>sent_message.php" target="_blank" rel="noopener noreferrer">پیام های ارسالی</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="user_data" hidden></div>
</header>
<script>
function pahnehChromePopup(url) {
    window.open(url, 'pahneh_popup', 'scrollbars=1,resizable=1,width=700,height=700,left=0,top=0');
    return false;
}
function target_popup2(el) {
    var url = '';
    if (el && el.href) url = el.href;
    else if (el && el.action) url = el.action;
    if (url) return pahnehChromePopup(url);
    return false;
}
(function () {
    var root = document.querySelector('.agri1-chrome');
    if (!root || root.getAttribute('data-ready') === '1') return;
    root.setAttribute('data-ready', '1');

    var burger = root.querySelector('.agri1-chrome-burger');
    var menu = root.querySelector('#agri1-chrome-menu');
    if (burger && menu) {
        burger.addEventListener('click', function () {
            var open = burger.getAttribute('aria-expanded') === 'true';
            burger.setAttribute('aria-expanded', open ? 'false' : 'true');
            if (open) menu.classList.remove('is-open');
            else menu.classList.add('is-open');
        });
    }

    var account = root.querySelector('.agri1-chrome-account');
    var accountBtn = root.querySelector('.agri1-chrome-account-btn');
    function closeAccount() {
        if (!account || !accountBtn) return;
        account.classList.remove('is-open');
        accountBtn.setAttribute('aria-expanded', 'false');
    }
    if (account && accountBtn) {
        accountBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var open = account.classList.contains('is-open');
            if (open) {
                closeAccount();
            } else {
                account.classList.add('is-open');
                accountBtn.setAttribute('aria-expanded', 'true');
            }
        });
        document.addEventListener('click', function (e) {
            if (!account.contains(e.target)) closeAccount();
        });
    }

    root.querySelectorAll('.agri1-chrome-caret').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var item = btn.closest('.agri1-chrome-item');
            var expanded = btn.getAttribute('aria-expanded') === 'true';
            if (item && item.parentNode) {
                var kids = item.parentNode.children;
                for (var i = 0; i < kids.length; i++) {
                    if (kids[i] !== item && kids[i].classList.contains('is-open')) {
                        kids[i].classList.remove('is-open');
                        var other = kids[i].querySelector('.agri1-chrome-row .agri1-chrome-caret');
                        if (other) other.setAttribute('aria-expanded', 'false');
                    }
                }
            }
            btn.setAttribute('aria-expanded', expanded ? 'false' : 'true');
            if (item) {
                if (expanded) item.classList.remove('is-open');
                else item.classList.add('is-open');
            }
        });
    });

    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') return;
        var accountWasOpen = account && account.classList.contains('is-open');
        closeAccount();
        root.querySelectorAll('.is-open').forEach(function (el) { el.classList.remove('is-open'); });
        root.querySelectorAll('[aria-expanded="true"]').forEach(function (el) {
            el.setAttribute('aria-expanded', 'false');
        });
        if (accountWasOpen && accountBtn) accountBtn.focus();
    });
})();
</script>
