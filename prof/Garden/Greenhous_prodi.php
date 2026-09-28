<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');
include_once('../../login/config.php');

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate('Y/m/d');
$time = date('H:i:s');

function prodi_h($v)
{
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

$bah_cod_m = isset($_POST['bah_cod_m']) ? trim($_POST['bah_cod_m'] . '') : '';
$unit_id = isset($_POST['unit_id']) ? (int) $_POST['unit_id'] : 0;
$y_prod = isset($_POST['y_prod']) ? trim($_POST['y_prod'] . '') : '';
$v_unit = isset($_POST['v_unit']) ? trim($_POST['v_unit'] . '') : '';
$no_mtol = isset($_POST['no_mtol']) ? trim($_POST['no_mtol'] . '') : '';
$t_mah = isset($_POST['t_mah']) ? trim($_POST['t_mah'] . '') : '';
$num_bah = isset($_POST['num_bah']) ? trim($_POST['num_bah'] . '') : '';
$mess = '';
$units = array();
$selected_kesht = '';

if ($y_prod !== '1405') {
    $y_prod = '';
}
if (!in_array($v_unit, array('1', '2', '3', '4'), true)) {
    $v_unit = '';
}

if (isset($_POST['action'])) {
    $dup = $dbh->prepare('SELECT COUNT(*) FROM Greenhous_prod WHERE unit_id = :unit_id AND y_prod = :y_prod');
    $dup->execute(array(':unit_id' => $unit_id, ':y_prod' => $y_prod));
    if ((int) $dup->fetchColumn() > 0) {
        alert('خطا ! عملکرد این واحد در سال ' . $y_prod . ' قبلاً ثبت شده است');
        echo '<form name="myform" method="post" action="index.php"></form>';
        echo '<script type="text/javascript">document.myform.submit();</script>';
        exit;
    }

    if ($bah_cod_m === '') {
        $mess .= 'کد ملی بهره بردار / مدیر عامل را وارد کنید<p>';
    }
    if ($unit_id < 1) {
        $mess .= 'نام واحد انتخاب نشده است<p>';
    }
    if ($y_prod === '') {
        $mess .= 'سال عملکرد انتخاب نشده است<p>';
    }
    if ($v_unit === '') {
        $mess .= 'وضعیت واحد انتخاب نشده است<p>';
    }
    if ($t_mah !== 'x') {
        if ($t_mah === '') {
            $mess .= 'تنوع محصول را وارد کنید<p>';
        } elseif ((int) $t_mah < 1) {
            $mess .= 'تنوع محصول حداقل باید 1 باشد <p>';
        }
        if ($no_mtol === '') {
            $mess .= 'نوع محصول تولیدی را انتخاب کنید<p>';
        }
    }

    if ($mess === '' && $v_unit === '1') {
        $stmt = $dbh->prepare('SELECT num_bah FROM Greenhous WHERE id = :id AND bah_cod_m = :bah_cod_m AND mor_cod_m = :mor_cod_m');
        $stmt->execute(array(':id' => $unit_id, ':bah_cod_m' => $bah_cod_m, ':mor_cod_m' => $login_session));
        $active_row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$active_row) {
            $mess .= 'نام واحد انتخاب نشده است<p>';
        } else {
        $num_bah = $active_row['num_bah'];
        echo '<form name="myform1" method="post" action="Greenh_prod.php">';
        echo '<input type="hidden" name="num_bah" value="' . prodi_h($num_bah) . '"/>';
        echo '<input type="hidden" name="unit_id" value="' . (int) $unit_id . '"/>';
        echo '<input type="hidden" name="y_prod" value="' . prodi_h($y_prod) . '"/>';
        echo '<input type="hidden" name="no_mtol" value="' . prodi_h($no_mtol) . '"/>';
        echo '<input type="hidden" name="t_mah" value="' . prodi_h($t_mah) . '"/>';
        echo '</form>';
        echo '<script type="text/javascript">document.myform1.submit();</script>';
        exit;
        }
    }

    if ($mess === '' && $v_unit !== '1') {
        $stmt = $dbh->prepare('SELECT num_bah, id_ostan, id_city, id_mar, add_abadi, add_city, no_kesht
                               FROM Greenhous
                               WHERE id = :id AND bah_cod_m = :bah_cod_m AND mor_cod_m = :mor_cod_m');
        $stmt->execute(array(
            ':id' => $unit_id,
            ':bah_cod_m' => $bah_cod_m,
            ':mor_cod_m' => $login_session
        ));
        $unit_row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$unit_row) {
            $mess .= 'نام واحد انتخاب نشده است<p>';
        } else {
            $query = 'INSERT INTO Greenhous_prod (date_s, unit_id, y_prod, v_unit, num_bah, bah_cod_m, mor_cod_m, no_kesht,
                      id_ostan, id_city, id_mar, add_abadi, add_city)
                      VALUES (:date_s, :unit_id, :y_prod, :v_unit, :num_bah, :bah_cod_m, :mor_cod_m, :no_kesht,
                      :id_ostan, :id_city, :id_mar, :add_abadi, :add_city)';
            $q = $dbh->prepare($query);
            $q->execute(array(
                ':date_s' => $date_edit,
                ':unit_id' => $unit_id,
                ':y_prod' => $y_prod,
                ':v_unit' => $v_unit,
                ':num_bah' => $unit_row['num_bah'],
                ':bah_cod_m' => $bah_cod_m,
                ':mor_cod_m' => $login_session,
                ':no_kesht' => $unit_row['no_kesht'],
                ':id_ostan' => $unit_row['id_ostan'],
                ':id_city' => $unit_row['id_city'],
                ':id_mar' => $unit_row['id_mar'],
                ':add_abadi' => $unit_row['add_abadi'],
                ':add_city' => $unit_row['add_city']
            ));
            sabt_event($login_session, getUserIP_1(), $date_edit, $time, '', 'ثبت عملکرد واحد گلخانه-' . $bah_cod_m, $unit_row['id_ostan']);
            alert('عملکرد واحد با موفقیت ثبت شد ');
            echo '<form name="myform" method="post" action="index.php"></form>';
            echo '<script type="text/javascript">document.myform.submit();</script>';
            exit;
        }
    }
}

if ($bah_cod_m !== '') {
    $where = array('bah_cod_m = :bah_cod_m', 'mor_cod_m = :mor_cod_m');
    $params = array(':bah_cod_m' => $bah_cod_m, ':mor_cod_m' => $login_session);
    if ($unit_id > 0) {
        $where[] = 'id = :id';
        $params[':id'] = $unit_id;
    }
    $stmt = $dbh->prepare('SELECT id, unit_name, no_kesht, num_bah FROM Greenhous WHERE ' . implode(' AND ', $where));
    $stmt->execute($params);
    $units = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($units as $unit_opt) {
        if ((int) $unit_opt['id'] === $unit_id) {
            $selected_kesht = $unit_opt['no_kesht'];
            if ($num_bah === '') {
                $num_bah = $unit_opt['num_bah'];
            }
        }
    }
}

$show_crop = ($v_unit === '1');
$btn_label = $show_crop ? 'ادامه' : 'ثبت و خروج';
$page_title = isset($title) ? $title : 'ثبت عملکرد گلخانه';
$pahneh_crumb_title = 'ثبت اطلاعات عملکرد سالانه واحد گلخانه';
$kesht_label = array('1' => 'گلخانه', '2' => 'فضای باز');
$open_air = ($selected_kesht === '2');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo prodi_h($page_title); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
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
        html { -webkit-text-size-adjust: 100%; text-size-adjust: 100%; }
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
            z-index: 50;
            background: var(--color-primary);
            color: var(--color-on-primary);
            padding: 8px 16px;
            border-radius: 8px;
        }
        .agri1-skip:focus { right: 8px; }
        .agri1-main { width: 100%; margin: 0 auto; padding: var(--space-3) 8px var(--space-4); }
        .agri1-title {
            margin: 0 0 var(--space-2);
            font-size: clamp(1.35rem, 2.4vw, 1.85rem);
            line-height: 1.4;
            text-wrap: balance;
        }
        .agri1-card-search {
            max-width: 720px;
            margin: 0 auto;
            background: var(--color-card);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 16px;
        }
        .agri1-icon { width: 24px; height: 24px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .agri1-field { margin-top: 12px; }
        .agri1-label { display: block; margin-bottom: 6px; font-weight: 700; }
        .agri1-hint { margin: 8px 0 0; color: var(--color-muted-foreground); font-size: 0.875rem; }
        .agri1-note {
            margin: 0 0 12px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            color: #1D4ED8;
        }
        .agri1-alert {
            margin: 0 0 12px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: var(--color-destructive);
        }
        .agri1-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px 12px; direction: ltr; }
        .agri1-grid .agri1-field { direction: rtl; margin-top: 0; }
        .agri1-grid-span { grid-column: 1 / -1; }
        .agri1-page .agri1-form input[type="text"],
        .agri1-page .agri1-form select {
            width: 100%;
            min-height: 36px;
            padding: 6px 12px;
            border: 1px solid #64748B;
            border-radius: 10px;
            background: #fff;
            color: var(--color-foreground);
            font-size: 16px;
            font-family: inherit;
        }
        .agri1-page .agri1-form select {
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2314532D' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 10px center;
            padding-left: 32px;
        }
        .agri1-page .agri1-form input[type="text"]:focus,
        .agri1-page .agri1-form select:focus {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
        }
        #bah_cod_m, #t_mah { direction: ltr; text-align: center; }
        .agri1-select { position: relative; width: 100%; }
        .agri1-select.is-enhanced > select {
            position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px;
            overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;
        }
        .agri1-select-btn {
            display: flex; align-items: center; justify-content: space-between; gap: 8px;
            width: 100%; min-height: 36px; padding: 6px 12px;
            border: 1px solid #64748B; border-radius: 10px; background: #fff;
            color: var(--color-foreground); font-size: 16px; font-family: inherit; text-align: right; cursor: pointer;
        }
        .agri1-select-btn:focus-visible, .agri1-select.is-open .agri1-select-btn {
            outline: none; border-color: var(--color-ring); box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
        }
        .agri1-select-label { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .agri1-select-caret { flex: 0 0 auto; width: 18px; height: 18px; }
        .agri1-select.is-open .agri1-select-caret { transform: rotate(180deg); }
        .agri1-select-list {
            display: none; position: absolute; top: calc(100% + 4px); right: 0; left: 0; z-index: 40;
            max-height: 240px; overflow-y: auto; margin: 0; padding: 6px 0; list-style: none;
            background: var(--color-card); border: 1px solid var(--color-border); border-radius: 10px;
            box-shadow: var(--shadow); direction: rtl; text-align: right;
        }
        .agri1-select.is-open .agri1-select-list { display: block; }
        .agri1-select-option { min-height: 36px; padding: 8px 14px; cursor: pointer; font-size: 0.9375rem; }
        .agri1-select-option:hover, .agri1-select-option.is-active, .agri1-select-option.is-selected {
            background: #ECFDF3; color: var(--color-primary);
        }
        .is-hidden { display: none !important; }
        .agri1-actions { display: flex; justify-content: center; gap: 12px; margin-top: 16px; }
        .agri1-btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            min-height: var(--touch); padding: 10px 20px; border: 0; border-radius: 12px;
            cursor: pointer; font-size: 16px; font-weight: 700; font-family: inherit; text-decoration: none;
        }
        .agri1-btn:focus-visible { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-btn-primary { background: var(--color-primary); color: #fff; box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25); }
        .agri1-btn-primary:hover { background: var(--color-secondary); }
        .agri1-btn-ghost { background: transparent; color: var(--color-foreground); border: 1px solid var(--color-border); }
        .agri1-btn-ghost:hover { background: var(--color-muted); }
        .agri1-back { margin: 24px auto 0; max-width: 720px; text-align: center; }
        .agri1-overlay {
            display: none; position: fixed; inset: 0; z-index: 90;
            align-items: center; justify-content: center; background: rgba(15, 23, 42, 0.55);
        }
        .agri1-overlay.is-open { display: flex; }
        .agri1-overlay-panel {
            display: flex; flex-direction: column; align-items: center; gap: 12px;
            min-width: 220px; padding: 24px; border-radius: 16px; background: #fff;
        }
        .agri1-spinner {
            width: 40px; height: 40px; border: 3px solid var(--color-border);
            border-top-color: var(--color-primary); border-radius: 50%; animation: agri1-spin 0.8s linear infinite;
        }
        @keyframes agri1-spin { to { transform: rotate(360deg); } }
        @media (max-width: 640px) { .agri1-grid { grid-template-columns: 1fr; } }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#reg-form">رفتن به فرم</a>
    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>
    <?php include(__DIR__ . '/../../chrome.php'); ?>
    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title">ثبت اطلاعات عملکرد سالانه واحد گلخانه</h1>
        </header>
        <section class="agri1-card agri1-card-search">
            <?php if ($mess !== '') { ?>
            <div class="agri1-alert" role="alert"><?php echo $mess; ?></div>
            <?php } ?>
            <p class="agri1-note">دقت ثبت عملکرد 1404 مسدود شد</p>
            <form id="reg-form" class="agri1-form" name="form1" action="#1" method="post" novalidate>
                <div class="agri1-grid">
                    <div class="agri1-field">
                        <label class="agri1-label" for="y_prod">عملکرد سال</label>
                        <select name="y_prod" id="y_prod">
                            <option value="">انتخاب کنید</option>
                            <option value="1405"<?php if ($y_prod === '1405') echo ' selected="selected"'; ?>>1405</option>
                        </select>
                    </div>
                    <div class="agri1-field">
                        <label class="agri1-label" for="bah_cod_m">کد ملی بهره‌بردار</label>
                        <input name="bah_cod_m" id="bah_cod_m" type="text" maxlength="12" inputmode="numeric" dir="ltr" value="<?php echo prodi_h($bah_cod_m); ?>"/>
                    </div>
                    <div class="agri1-field agri1-grid-span">
                        <label class="agri1-label" for="unit_id">نام واحد</label>
                        <select name="unit_id" id="unit_id">
                            <option value="">انتخاب کنید</option>
                            <?php foreach ($units as $unit_opt) {
                                $kid = ($unit_opt['no_kesht'] === '2') ? '2' : '1';
                                $label = $unit_opt['unit_name'] . ' / نوع کشت : ' . (isset($kesht_label[$unit_opt['no_kesht']]) ? $kesht_label[$unit_opt['no_kesht']] : '');
                            ?>
                            <option value="<?php echo (int) $unit_opt['id']; ?>" data-kesht="<?php echo prodi_h($kid); ?>" data-num="<?php echo prodi_h($unit_opt['num_bah']); ?>"<?php if ($unit_id === (int) $unit_opt['id']) echo ' selected="selected"'; ?>><?php echo prodi_h($label); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field agri1-grid-span">
                        <label class="agri1-label" for="v_unit">وضعیت واحد</label>
                        <select name="v_unit" id="v_unit" class="v_unit">
                            <option value="">انتخاب کنید</option>
                            <option value="1"<?php if ($v_unit === '1') echo ' selected="selected"'; ?>>فعال</option>
                            <option value="2"<?php if ($v_unit === '2') echo ' selected="selected"'; ?>>در حال اخذ پروانه تاسیس</option>
                            <option value="3"<?php if ($v_unit === '3') echo ' selected="selected"'; ?>>دارای پیشرفت فیزیکی</option>
                            <option value="4"<?php if ($v_unit === '4') echo ' selected="selected"'; ?>>غیرفعال</option>
                        </select>
                    </div>
                    <div class="agri1-field agri1-grid-span<?php if (!$show_crop) echo ' is-hidden'; ?>" id="field-no_mtol">
                        <label class="agri1-label" for="no_mtol">نوع محصول تولیدی</label>
                        <select name="no_mtol" id="no_mtol">
                            <option value="">انتخاب کنید</option>
                            <?php if (!$open_air) { ?>
                            <option value="211100"<?php if ($no_mtol === '211100') echo ' selected="selected"'; ?>>سبزی و صیفی</option>
                            <?php } ?>
                            <option value="211300"<?php if ($no_mtol === '211300') echo ' selected="selected"'; ?>>گل و گیاه زینتی</option>
                            <?php if (!$open_air) { ?>
                            <option value="211200"<?php if ($no_mtol === '211200') echo ' selected="selected"'; ?>>سایر</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="agri1-field<?php if (!$show_crop) echo ' is-hidden'; ?>" id="field-t_mah">
                        <label class="agri1-label" for="t_mah">تنوع محصول</label>
                        <input name="t_mah" id="t_mah" type="text" maxlength="2" inputmode="numeric" dir="ltr" value="<?php echo prodi_h($show_crop ? $t_mah : 'x'); ?>"/>
                    </div>
                </div>
                <input type="hidden" name="num_bah" id="num_bah" value="<?php echo prodi_h($num_bah); ?>"/>
                <div class="agri1-actions">
                    <button type="submit" name="action" id="btn" class="agri1-btn agri1-btn-primary" value="1"><?php echo prodi_h($btn_label); ?></button>
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
            var bah = document.getElementById('bah_cod_m');
            var unit = document.getElementById('unit_id');
            var status = document.getElementById('v_unit');
            var cropField = document.getElementById('field-no_mtol');
            var countField = document.getElementById('field-t_mah');
            var crop = document.getElementById('no_mtol');
            var count = document.getElementById('t_mah');
            var numBah = document.getElementById('num_bah');
            var btn = document.getElementById('btn');
            if (!form) return;

            function showOverlay() {
                if (overlay) overlay.className = 'agri1-overlay is-open';
                if (btn) btn.setAttribute('aria-busy', 'true');
            }

            function fillCrop(openAir) {
                var current = crop.value;
                var options = openAir
                    ? [['', 'انتخاب کنید'], ['211300', 'گل و گیاه زینتی']]
                    : [['', 'انتخاب کنید'], ['211100', 'سبزی و صیفی'], ['211300', 'گل و گیاه زینتی'], ['211200', 'سایر']];
                crop.innerHTML = '';
                for (var i = 0; i < options.length; i++) {
                    var opt = document.createElement('option');
                    opt.value = options[i][0];
                    opt.textContent = options[i][1];
                    if (opt.value === current) opt.selected = true;
                    crop.appendChild(opt);
                }
                crop.dispatchEvent(new Event('change', { bubbles: true }));
            }

            function applyStatus(clearCount) {
                var active = status.value === '1';
                cropField.classList.toggle('is-hidden', !active);
                countField.classList.toggle('is-hidden', !active);
                btn.textContent = active ? 'ادامه' : 'ثبت و خروج';
                if (!active) {
                    count.value = 'x';
                } else if (clearCount) {
                    count.value = '';
                }
            }

            bah.addEventListener('change', function () {
                showOverlay();
                HTMLFormElement.prototype.submit.call(form);
            });
            unit.addEventListener('change', function () {
                var opt = unit.options[unit.selectedIndex];
                if (!opt) return;
                if (numBah && opt.getAttribute('data-num')) numBah.value = opt.getAttribute('data-num');
                fillCrop(opt.getAttribute('data-kesht') === '2');
            });
            status.addEventListener('change', function () { applyStatus(true); });
            form.addEventListener('submit', showOverlay);
            applyStatus(false);
        })();
        (function () {
            var form = document.getElementById('reg-form');
            if (!form) return;
            var openWrap = null;
            function optionText(opt) { return String(opt.text || '').replace(/^\s+|\s+$/g, ''); }
            function closeWrap(wrap) {
                if (!wrap) return;
                wrap.classList.remove('is-open');
                var b = wrap.querySelector('.agri1-select-btn');
                if (b) b.setAttribute('aria-expanded', 'false');
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
                var listId = (select.id || 'sel') + '-list';
                var button = document.createElement('button');
                button.type = 'button';
                button.className = 'agri1-select-btn';
                button.setAttribute('aria-haspopup', 'listbox');
                button.setAttribute('aria-expanded', 'false');
                button.setAttribute('aria-controls', listId);
                button.innerHTML = '<span class="agri1-select-label"></span><svg class="agri1-icon agri1-select-caret" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>';
                var labelEl = button.querySelector('.agri1-select-label');
                var list = document.createElement('ul');
                list.id = listId;
                list.className = 'agri1-select-list';
                list.setAttribute('role', 'listbox');
                wrap.appendChild(button);
                wrap.appendChild(list);
                wrap.classList.add('is-enhanced');
                function currentIndex() { return select.selectedIndex < 0 ? 0 : select.selectedIndex; }
                function syncFromSelect() {
                    var opt = select.options[currentIndex()];
                    labelEl.textContent = opt ? optionText(opt) : '';
                    var items = list.querySelectorAll('.agri1-select-option');
                    for (var i = 0; i < items.length; i++) {
                        var on = items[i].getAttribute('data-index') === String(currentIndex());
                        items[i].classList.toggle('is-selected', on);
                    }
                }
                function buildList() {
                    list.innerHTML = '';
                    for (var i = 0; i < select.options.length; i++) {
                        var li = document.createElement('li');
                        li.className = 'agri1-select-option';
                        li.setAttribute('role', 'option');
                        li.setAttribute('data-index', String(i));
                        li.textContent = optionText(select.options[i]);
                        list.appendChild(li);
                    }
                    syncFromSelect();
                }
                function choose(index) {
                    if (index < 0 || index >= select.options.length) return;
                    select.selectedIndex = index;
                    syncFromSelect();
                    select.dispatchEvent(new Event('change', { bubbles: true }));
                    closeWrap(wrap);
                    button.focus();
                }
                function open() {
                    closeAll();
                    buildList();
                    wrap.classList.add('is-open');
                    button.setAttribute('aria-expanded', 'true');
                    openWrap = wrap;
                }
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (wrap.classList.contains('is-open')) closeWrap(wrap);
                    else open();
                });
                list.addEventListener('click', function (e) {
                    var t = e.target;
                    if (!t || t.getAttribute('data-index') == null) return;
                    choose(parseInt(t.getAttribute('data-index'), 10));
                });
                select.addEventListener('change', syncFromSelect);
                buildList();
            }
            var selects = form.querySelectorAll('select');
            for (var s = 0; s < selects.length; s++) enhance(selects[s]);
            document.addEventListener('click', closeAll);
        })();
    </script>
</body>
</html>
