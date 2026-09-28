<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
include('../cod_m.php');

function agri2_h($v)
{
    if (!isset($v)) {
        return '';
    }
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri2_post($key, $default)
{
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}

function aquatic_hidden_form($action, $fields)
{
    echo '<form name="myform1" class="myform" method="post" action="' . agri2_h($action) . '">';
    foreach ($fields as $name => $val) {
        echo '<input type="hidden" name="' . agri2_h($name) . '" value="' . agri2_h($val) . '"/>';
    }
    echo '</form>';
    echo '<script type="text/javascript">document.myform1.submit();</script>';
}

$page_title = (isset($title) && $title !== '') ? $title : 'ثبت مزرعه تکثیر و پرورش آبزیان';
$pahneh_crumb_title = 'ثبت مزرعه تکثیر و پرورش آبزیان';

if (isset($_POST['action1'])) {
    echo '<form name="myform" class="myform" method="post" action="../benef.php"></form>';
    echo '<script type="text/javascript">document.myform.submit();</script>';
    exit;
}

$no_fa = agri2_post('no_fa', '');
$no_mal = agri2_post('no_mal', '');
$bah_cod_m = agri2_post('bah_cod_m', '');
$m_poul = agri2_post('m_poul', '');
$add_abadi = agri2_post('add_abadi', '');
$add_city = agri2_post('add_city', '');
$field_errors = array();
$not_found_bah = false;

if (isset($_POST['action'])) {
    if ($m_poul == '') {
        $field_errors['m_poul'] = 'موقعیت بهره برداری را تعیین کنید';
    }
    if ($m_poul == 'shahr' && $add_city == '') {
        $field_errors['add_city'] = 'نام شهر را انتخاب کنید';
    }
    if ($m_poul == 'abadi' && $add_abadi == '') {
        $field_errors['add_abadi'] = 'نام آبادی را انتخاب کنید';
    }
    if ($bah_cod_m == '') {
        $field_errors['bah_cod_m'] = 'کد ملی را وارد کنید';
    }
    if ($no_fa == '') {
        $field_errors['no_fa'] = 'نوع فعالیت مزرعه مورد نظر را انتخاب کنید';
    }
    if ($no_mal == '') {
        $field_errors['no_mal'] = 'نوع مالکیت را انتخاب کنید';
    }

    if (!$field_errors) {
        $query = "SELECT bah_cod_m FROM bah WHERE bah_cod_m = :bah_cod_m";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
        $count_codm = $stmt->rowCount();
        $fwd = array(
            'bah_cod_m' => $bah_cod_m,
            'm_poul' => $m_poul,
            'add_city' => $add_city,
            'add_abadi' => $add_abadi,
            'no_fa' => $no_fa,
            'no_mal' => $no_mal
        );
        if ($count_codm > 1) {
            $fwd['m_page'] = 'Aquatic.php';
            aquatic_hidden_form('bah_history2.php', $fwd);
            exit;
        }
        if ($count_codm == 0) {
            $field_errors['bah_cod_m'] = 'اطلاعات بهره بردار یافت نشد. برای ثبت اطلاعات مزرعه پرورش آبزیان، ابتدا اطلاعات بهره بردار را ثبت نمایید';
            $not_found_bah = true;
        } else {
            $query = "SELECT bah_cod_m FROM Greenhous WHERE bah_cod_m = :bah_cod_m";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
            if ($stmt->rowCount() > 0) {
                aquatic_hidden_form('Aquatic_history.php', $fwd);
                exit;
            }
            aquatic_hidden_form('Aquatic_data.php', $fwd);
            exit;
        }
    }
}

$city_rows = array();
$abadi_rows = array();
$st = $dbh->prepare("SELECT add_city, shahr FROM list_city WHERE mor_cod_m = :m ORDER BY BINARY shahr");
$st->execute(array(':m' => $login_session));
$city_rows = $st->fetchAll(PDO::FETCH_ASSOC);
$st = $dbh->prepare("SELECT add_abadi, abadi FROM list_abadi WHERE mor_cod_m = :m ORDER BY BINARY abadi");
$st->execute(array(':m' => $login_session));
$abadi_rows = $st->fetchAll(PDO::FETCH_ASSOC);

$show_city = ($m_poul == 'shahr');
$show_abadi = ($m_poul == 'abadi');
$has_errors = !empty($field_errors);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo agri2_h($page_title); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <style>
        :root {
            --color-primary: #15803D; --color-on-primary: #FFFFFF; --color-secondary: #166534;
            --color-accent: #A16207; --color-on-accent: #FFFFFF; --color-background: #F0FDF4;
            --color-foreground: #14532D; --color-card: #FFFFFF; --color-card-foreground: #14532D;
            --color-muted: #E8F0F1; --color-muted-foreground: #475569; --color-border: #86C9A0;
            --color-destructive: #DC2626; --color-ring: #15803D; --color-warning-bg: #FEF2F2;
            --space-1: 8px; --space-2: 16px; --space-3: 24px; --space-4: 32px;
            --radius: 12px; --duration: 200ms; --shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
            --touch: 44px; --font: myfont, Tahoma, "Segoe UI", sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-padding-top: 96px; -webkit-text-size-adjust: 100%; text-size-adjust: 100%; }
        body.agri1-body { margin: 0; background: var(--color-background); color: var(--color-foreground); font-family: var(--font); font-size: 16px; line-height: 1.6; }
        .agri1-skip { position: absolute; right: -999px; top: 8px; z-index: 90; background: var(--color-primary); color: var(--color-on-primary); padding: 8px 16px; border-radius: 8px; }
        .agri1-skip:focus { right: 8px; }
        .agri1-main { width: min(920px, 100%); margin: 0 auto; padding: var(--space-3) var(--space-2) var(--space-4); }
        .agri1-title { margin: 0 0 var(--space-2); color: var(--color-foreground); font-size: clamp(1.35rem, 2.4vw, 1.85rem); line-height: 1.4; }
        .agri1-card { background: var(--color-card); border: 1px solid var(--color-border); border-radius: 16px; box-shadow: var(--shadow); padding: var(--space-3); }
        .agri1-alert { display: flex; gap: 12px; margin-bottom: var(--space-3); padding: var(--space-2); border-radius: var(--radius); border: 1px solid #FECACA; background: var(--color-warning-bg); color: #991B1B; }
        .agri1-alert h2 { margin: 0 0 8px; font-size: 1rem; }
        .agri1-alert a { color: #991B1B; }
        .agri1-icon { flex: 0 0 auto; width: 24px; height: 24px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .agri1-fieldset { margin: 0 0 var(--space-3); padding: 0; border: 0; }
        .agri1-legend { display: flex; align-items: center; gap: 8px; margin-bottom: 10px; font-size: 1rem; font-weight: 700; }
        .agri1-hint { margin: 0 0 12px; color: var(--color-muted-foreground); font-size: 0.875rem; }
        .agri1-choices { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .agri1-choice { position: relative; display: flex; align-items: center; gap: 10px; min-height: 52px; padding: 12px 14px; border: 2px solid var(--color-border); border-radius: var(--radius); background: var(--color-card); cursor: pointer; }
        .agri1-choice:hover { border-color: var(--color-primary); background: #F7FEF9; }
        .agri1-choice.is-selected { border-color: var(--color-primary); background: #ECFDF3; box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.16); }
        .agri1-choice:focus-within { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-choice input { position: absolute; opacity: 0; width: 1px; height: 1px; }
        .agri1-choice-mark { width: 20px; height: 20px; border: 2px solid var(--color-primary); border-radius: 50%; position: relative; flex-shrink: 0; }
        .agri1-choice.is-selected .agri1-choice-mark::after { content: ""; position: absolute; inset: 3px; border-radius: 50%; background: var(--color-primary); }
        .agri1-field { margin-top: 12px; }
        .agri1-label { display: block; margin-bottom: 6px; font-weight: 700; }
        .agri1-page .agri1-form input[type="text"],
        .agri1-page .agri1-form select {
            width: 100%; min-height: var(--touch); padding: 10px 12px; border: 1px solid #64748B; border-radius: 10px;
            background: var(--color-card); color: var(--color-foreground); font-size: 16px; font-family: inherit;
        }
        .agri1-page .agri1-form select {
            appearance: none; -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2314532D' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: left 10px center; padding-left: 32px;
        }
        .agri1-page .agri1-form input[type="text"]:focus,
        .agri1-page .agri1-form select:focus { border-color: var(--color-ring); box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25); outline: none; }
        .agri1-page .agri1-form input[aria-invalid="true"],
        .agri1-page .agri1-form select[aria-invalid="true"] { border-color: var(--color-destructive); }
        .agri1-page .agri1-form input[name="bah_cod_m"] { text-align: center; letter-spacing: 0.06em; }
        .agri1-select { position: relative; width: 100%; }
        .agri1-select.is-enhanced > select { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0; }
        .agri1-select-btn { display: flex; align-items: center; justify-content: space-between; gap: 8px; width: 100%; min-height: var(--touch); padding: 6px 12px; border: 1px solid #64748B; border-radius: 10px; background: var(--color-card); color: var(--color-foreground); font-size: 16px; font-family: inherit; text-align: right; cursor: pointer; }
        .agri1-select-btn:focus-visible, .agri1-select.is-open .agri1-select-btn { outline: none; border-color: var(--color-ring); box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25); }
        .agri1-select-label { flex: 1; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .agri1-select-list { display: none; position: absolute; top: calc(100% + 4px); right: 0; left: 0; z-index: 40; max-height: 240px; overflow-y: auto; margin: 0; padding: 6px 0; list-style: none; background: var(--color-card); border: 1px solid var(--color-border); border-radius: 10px; box-shadow: var(--shadow); direction: rtl; }
        .agri1-select.is-open .agri1-select-list { display: block; }
        .agri1-select-option { min-height: 36px; padding: 8px 14px; cursor: pointer; }
        .agri1-select-option:hover, .agri1-select-option.is-active, .agri1-select-option.is-selected { background: #ECFDF3; }
        .agri1-error { margin: 8px 0 0; color: var(--color-destructive); font-size: 0.875rem; }
        .is-hidden { display: none !important; }
        .agri1-actions { display: flex; justify-content: center; flex-wrap: wrap; gap: 12px; margin-top: var(--space-2); }
        .agri1-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: var(--touch); padding: 10px 20px; border: 0; border-radius: 12px; cursor: pointer; font-size: 16px; font-weight: 700; font-family: inherit; text-decoration: none; }
        .agri1-btn:focus-visible { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-btn[aria-busy="true"] { opacity: 0.85; }
        .agri1-btn-primary { background: var(--color-primary); color: var(--color-on-primary); box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25); }
        .agri1-btn-primary:hover { background: var(--color-secondary); }
        .agri1-btn-accent { background: var(--color-accent); color: var(--color-on-accent); }
        .agri1-btn-accent:hover { background: #854D0E; }
        .agri1-btn-ghost { background: transparent; color: var(--color-foreground); border: 1px solid var(--color-border); }
        .agri1-btn-ghost:hover { background: var(--color-muted); }
        .agri1-back { margin-top: var(--space-3); }
        .agri1-overlay { display: none; position: fixed; inset: 0; z-index: 90; align-items: center; justify-content: center; background: rgba(15, 23, 42, 0.55); }
        .agri1-overlay.is-open { display: flex !important; }
        .agri1-overlay-panel { display: flex; flex-direction: column; align-items: center; gap: 12px; min-width: 220px; padding: 24px; border-radius: 16px; background: var(--color-card); }
        .agri1-spinner { width: 40px; height: 40px; border: 3px solid var(--color-border); border-top-color: var(--color-primary); border-radius: 50%; animation: agri1-spin 0.8s linear infinite; }
        @keyframes agri1-spin { to { transform: rotate(360deg); } }
        @media (max-width: 640px) { .agri1-choices { grid-template-columns: 1fr; } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; } }
    </style>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#reg-form">رفتن به فرم ثبت</a>
    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>
    <?php include(__DIR__ . '/../../chrome.php'); ?>
    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title">ثبت اطلاعات مزرعه تکثیر و پرورش آبزیان جدید</h1>
        </header>
        <section class="agri1-card" aria-labelledby="reg-form">
<?php if ($has_errors) { ?>
            <div class="agri1-alert" id="agri1-error-summary" role="alert" tabindex="-1">
                <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 9v4"></path><path d="M12 17h.01"></path><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path></svg>
                <div>
                    <h2>لطفاً موارد زیر را تکمیل کنید</h2>
                    <ul>
                        <?php foreach ($field_errors as $fid => $ferr) { ?>
                        <li><a href="#field-<?php echo agri2_h($fid); ?>"><?php echo agri2_h($ferr); ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
<?php } ?>
            <form id="reg-form" class="agri1-form" method="post" action="#1" novalidate>
                <fieldset class="agri1-fieldset" id="field-m_poul">
                    <legend class="agri1-legend">موقعیت بهره برداری</legend>
                    <p class="agri1-hint">محل را انتخاب کنید؛ سپس نام شهر یا آبادی را از فهرست برگزینید.</p>
                    <div class="agri1-choices" role="radiogroup">
                        <label class="agri1-choice<?php if ($m_poul == 'shahr') echo ' is-selected'; ?>">
                            <input type="radio" class="region" name="m_poul" value="shahr"<?php if ($m_poul == 'shahr') echo ' checked="checked"'; ?>/>
                            <span class="agri1-choice-mark" aria-hidden="true"></span><span>شهر</span>
                        </label>
                        <label class="agri1-choice<?php if ($m_poul == 'abadi') echo ' is-selected'; ?>">
                            <input type="radio" class="region" name="m_poul" value="abadi"<?php if ($m_poul == 'abadi') echo ' checked="checked"'; ?>/>
                            <span class="agri1-choice-mark" aria-hidden="true"></span><span>آبادی</span>
                        </label>
                    </div>
                    <?php if (isset($field_errors['m_poul'])) { ?><p class="agri1-error" id="error-m_poul"><?php echo agri2_h($field_errors['m_poul']); ?></p><?php } ?>
                    <div class="agri1-field shahr_wrap<?php echo $show_city ? '' : ' is-hidden'; ?>" id="field-add_city">
                        <label class="agri1-label" for="add_city">نام شهر</label>
                        <select name="add_city" id="add_city" aria-invalid="<?php echo isset($field_errors['add_city']) ? 'true' : 'false'; ?>">
                            <option value="">انتخاب کنید</option>
                            <?php foreach ($city_rows as $crow) {
                                $sel = ((string) $crow['add_city'] === (string) $add_city) ? ' selected="selected"' : '';
                                echo '<option value="' . agri2_h($crow['add_city']) . '"' . $sel . '>' . agri2_h($crow['shahr']) . '</option>';
                            } ?>
                        </select>
                        <?php if (isset($field_errors['add_city'])) { ?><p class="agri1-error" id="error-add_city"><?php echo agri2_h($field_errors['add_city']); ?></p><?php } ?>
                    </div>
                    <div class="agri1-field abadi_wrap<?php echo $show_abadi ? '' : ' is-hidden'; ?>" id="field-add_abadi">
                        <label class="agri1-label" for="add_abadi">نام آبادی</label>
                        <select name="add_abadi" id="add_abadi" aria-invalid="<?php echo isset($field_errors['add_abadi']) ? 'true' : 'false'; ?>">
                            <option value="">انتخاب کنید</option>
                            <?php foreach ($abadi_rows as $arow) {
                                $sel = ((string) $arow['add_abadi'] === (string) $add_abadi) ? ' selected="selected"' : '';
                                echo '<option value="' . agri2_h($arow['add_abadi']) . '"' . $sel . '>' . agri2_h($arow['abadi']) . '</option>';
                            } ?>
                        </select>
                        <?php if (isset($field_errors['add_abadi'])) { ?><p class="agri1-error" id="error-add_abadi"><?php echo agri2_h($field_errors['add_abadi']); ?></p><?php } ?>
                    </div>
                </fieldset>
                <div class="agri1-field" id="field-bah_cod_m">
                    <label class="agri1-label" for="bah_cod_m">کد ملی بهره بردار / مدیرعامل</label>
                    <input type="text" name="bah_cod_m" id="bah_cod_m" dir="ltr" inputmode="numeric" maxlength="10" value="<?php echo agri2_h($bah_cod_m); ?>" aria-invalid="<?php echo isset($field_errors['bah_cod_m']) ? 'true' : 'false'; ?>"/>
                    <?php if (isset($field_errors['bah_cod_m'])) { ?><p class="agri1-error" id="error-bah_cod_m"><?php echo agri2_h($field_errors['bah_cod_m']); ?></p><?php } ?>
                </div>
                <div class="agri1-field" id="field-no_fa">
                    <label class="agri1-label" for="no_fa">نوع فعالیت</label>
                    <select name="no_fa" id="no_fa" aria-invalid="<?php echo isset($field_errors['no_fa']) ? 'true' : 'false'; ?>">
                        <option value="">انتخاب کنید</option>
                        <option value="1"<?php if ($no_fa == '1') echo ' selected="selected"'; ?>>تکثیر</option>
                        <option value="2"<?php if ($no_fa == '2') echo ' selected="selected"'; ?>>پرورش</option>
                        <option value="3"<?php if ($no_fa == '3') echo ' selected="selected"'; ?>>تکثیر و پرورش</option>
                    </select>
                    <?php if (isset($field_errors['no_fa'])) { ?><p class="agri1-error" id="error-no_fa"><?php echo agri2_h($field_errors['no_fa']); ?></p><?php } ?>
                </div>
                <div class="agri1-field" id="field-no_mal">
                    <label class="agri1-label" for="no_mal">نوع مالکیت</label>
                    <select name="no_mal" id="no_mal" aria-invalid="<?php echo isset($field_errors['no_mal']) ? 'true' : 'false'; ?>">
                        <option value="">انتخاب کنید</option>
                        <option value="0"<?php if ($no_mal == '0') echo ' selected="selected"'; ?>>------</option>
                        <option value="1"<?php if ($no_mal == '1') echo ' selected="selected"'; ?>>سند ششدانگ</option>
                        <option value="2"<?php if ($no_mal == '2') echo ' selected="selected"'; ?>>سند مشاعی</option>
                        <option value="3"<?php if ($no_mal == '3') echo ' selected="selected"'; ?>>اصلاحات اراضی</option>
                        <option value="4"<?php if ($no_mal == '4') echo ' selected="selected"'; ?>>موقوفه</option>
                        <option value="5"<?php if ($no_mal == '5') echo ' selected="selected"'; ?>>واگذاری</option>
                        <option value="6"<?php if ($no_mal == '6') echo ' selected="selected"'; ?>>قولنامه</option>
                        <option value="7"<?php if ($no_mal == '7') echo ' selected="selected"'; ?>>اجاره</option>
                        <option value="8"<?php if ($no_mal == '8') echo ' selected="selected"'; ?>>سایر</option>
                    </select>
                    <?php if (isset($field_errors['no_mal'])) { ?><p class="agri1-error" id="error-no_mal"><?php echo agri2_h($field_errors['no_mal']); ?></p><?php } ?>
                </div>
                <div class="agri1-actions">
                    <button type="submit" name="action" id="sub" value="ادامه" class="agri1-btn agri1-btn-primary">ادامه</button>
                    <?php if ($not_found_bah) { ?>
                    <button type="submit" name="action1" id="sub1" value="ثبت اطلاعات بهره بردار" class="agri1-btn agri1-btn-accent">ثبت اطلاعات بهره بردار</button>
                    <?php } ?>
                </div>
            </form>
        </section>
        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="index.php">بازگشت به صفحه قبل</a>
        </p>
    </main>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td height="109" style="background: url('../../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../../footer.php'); ?>
            </td>
        </tr>
    </table>
    <script>
        (function () {
            var form = document.getElementById('reg-form');
            var overlay = document.getElementById('agri1-overlay');
            var submitBtn = document.getElementById('sub');
            var sending = false;
            if (!form) return;
            function syncChoice() {
                var labels = form.querySelectorAll('.agri1-choice');
                for (var i = 0; i < labels.length; i++) {
                    var input = labels[i].querySelector('input[type=radio]');
                    if (input && input.checked) labels[i].className = 'agri1-choice is-selected';
                    else labels[i].className = labels[i].className.replace(/\bis-selected\b/g, '').replace(/\s+/g, ' ').replace(/^\s|\s$/g, '') || 'agri1-choice';
                }
            }
            function showPlace() {
                var shahr = form.querySelector('input[name="m_poul"][value="shahr"]');
                var abadi = form.querySelector('input[name="m_poul"][value="abadi"]');
                var sw = form.querySelector('.shahr_wrap');
                var aw = form.querySelector('.abadi_wrap');
                if (shahr && shahr.checked) { sw.classList.remove('is-hidden'); aw.classList.add('is-hidden'); }
                else if (abadi && abadi.checked) { aw.classList.remove('is-hidden'); sw.classList.add('is-hidden'); }
            }
            var radios = form.querySelectorAll('.agri1-choice input[type=radio]');
            for (var r = 0; r < radios.length; r++) {
                radios[r].addEventListener('change', function () { syncChoice(); showPlace(); });
            }
            syncChoice(); showPlace();
            form.addEventListener('submit', function (e) {
                if (sending) { e.preventDefault(); return; }
                sending = true;
                if (overlay) overlay.className = 'agri1-overlay is-open';
                if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
            });
            var openWrap = null;
            function optionText(opt) { return String(opt.text || '').replace(/^\s+|\s+$/g, ''); }
            function closeWrap(wrap) {
                if (!wrap) return;
                wrap.classList.remove('is-open');
                var btn = wrap.querySelector('.agri1-select-btn');
                if (btn) btn.setAttribute('aria-expanded', 'false');
                if (openWrap === wrap) openWrap = null;
            }
            function closeAll() {
                var wraps = form.querySelectorAll('.agri1-select.is-open');
                for (var i = 0; i < wraps.length; i++) closeWrap(wraps[i]);
            }
            function enhance(select) {
                if (select.getAttribute('data-agri1-select') === '1') return;
                select.setAttribute('data-agri1-select', '1');
                var wrap = document.createElement('div');
                wrap.className = 'agri1-select';
                select.parentNode.insertBefore(wrap, select);
                wrap.appendChild(select);
                var listId = (select.id || ('agri1-sel-' + Math.random().toString(36).slice(2))) + '-list';
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'agri1-select-btn';
                btn.setAttribute('aria-haspopup', 'listbox');
                btn.setAttribute('aria-expanded', 'false');
                btn.setAttribute('aria-controls', listId);
                btn.innerHTML = '<span class="agri1-select-label"></span><svg class="agri1-icon" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>';
                var labelEl = btn.querySelector('.agri1-select-label');
                var list = document.createElement('ul');
                list.id = listId; list.className = 'agri1-select-list'; list.setAttribute('role', 'listbox');
                wrap.appendChild(btn); wrap.appendChild(list); wrap.classList.add('is-enhanced');
                function currentIndex() { return select.selectedIndex < 0 ? 0 : select.selectedIndex; }
                function syncFromSelect() {
                    var opt = select.options[currentIndex()];
                    labelEl.textContent = opt ? optionText(opt) : '';
                    var items = list.querySelectorAll('.agri1-select-option');
                    for (var i = 0; i < items.length; i++) items[i].classList.toggle('is-selected', items[i].getAttribute('data-index') === String(currentIndex()));
                }
                function buildList() {
                    list.innerHTML = '';
                    for (var i = 0; i < select.options.length; i++) {
                        var li = document.createElement('li');
                        li.className = 'agri1-select-option'; li.setAttribute('role', 'option');
                        li.setAttribute('data-index', String(i)); li.textContent = optionText(select.options[i]);
                        list.appendChild(li);
                    }
                    syncFromSelect();
                }
                function choose(index) {
                    if (index < 0 || index >= select.options.length) return;
                    select.selectedIndex = index; syncFromSelect(); closeWrap(wrap); btn.focus();
                }
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (wrap.classList.contains('is-open')) { closeWrap(wrap); return; }
                    closeAll(); buildList(); wrap.classList.add('is-open'); btn.setAttribute('aria-expanded', 'true'); openWrap = wrap;
                });
                list.addEventListener('click', function (e) {
                    var li = e.target.closest ? e.target.closest('.agri1-select-option') : null;
                    if (!li) return;
                    choose(parseInt(li.getAttribute('data-index'), 10));
                });
                btn.addEventListener('keydown', function (e) {
                    var items = list.querySelectorAll('.agri1-select-option');
                    var idx = currentIndex();
                    if (e.key === 'ArrowDown') { e.preventDefault(); if (!wrap.classList.contains('is-open')) { btn.click(); } else choose(Math.min(idx + 1, items.length - 1)); }
                    else if (e.key === 'ArrowUp') { e.preventDefault(); choose(Math.max(idx - 1, 0)); }
                    else if (e.key === 'Escape') { closeWrap(wrap); }
                    else if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); if (!wrap.classList.contains('is-open')) btn.click(); }
                });
                buildList();
                select.agri1Rebuild = buildList;
            }
            var selects = form.querySelectorAll('select');
            for (var s = 0; s < selects.length; s++) enhance(selects[s]);
            document.addEventListener('click', function (e) {
                if (openWrap && !openWrap.contains(e.target)) closeAll();
            });
        })();
    </script>
</body>
</html>
