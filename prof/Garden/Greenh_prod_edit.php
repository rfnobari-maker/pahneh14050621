<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');
include_once('../../login/config.php');

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate('Y/m/d');
$time = date('H:i:s');

function edit_h($v)
{
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

$bah_cod_m = isset($_POST['bah_cod_m']) ? trim($_POST['bah_cod_m'] . '') : '';
$unit_id = isset($_POST['unit_id']) ? (int) $_POST['unit_id'] : 0;
$y_prod = isset($_POST['y_prod']) ? trim($_POST['y_prod'] . '') : '';
$v_unit = isset($_POST['v_unit']) ? trim($_POST['v_unit'] . '') : '';
$num_bah = isset($_POST['num_bah']) ? trim($_POST['num_bah'] . '') : '';
$t_mah = isset($_POST['t_mah']) ? trim($_POST['t_mah'] . '') : '';
$no_mtol = isset($_POST['no_mtol']) ? trim($_POST['no_mtol'] . '') : '';
$mess = '';

if (!in_array($v_unit, array('1', '2', '3', '4'), true)) {
    $v_unit = '';
}

if (isset($_POST['action'])) {
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
        echo '<form name="myform1" method="post" action="Greenhdata_prod_edit.php">';
        echo '<input type="hidden" name="num_bah" value="1"/>';
        echo '<input type="hidden" name="unit_id" value="' . (int) $unit_id . '"/>';
        echo '<input type="hidden" name="y_prod" value="' . edit_h($y_prod) . '"/>';
        echo '<input type="hidden" name="t_mah" value="' . edit_h($t_mah) . '"/>';
        echo '<input type="hidden" name="no_mtol" value="' . edit_h($no_mtol) . '"/>';
        echo '</form>';
        echo '<script type="text/javascript">document.myform1.submit();</script>';
        exit;
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
            $del = $dbh->prepare('DELETE FROM Greenhous_prod WHERE unit_id = :unit_id AND y_prod = :y_prod');
            $del->execute(array(':unit_id' => $unit_id, ':y_prod' => $y_prod));

            $del_year = $dbh->prepare('DELETE FROM Greenprod_annual WHERE unit_id = :unit_id');
            $del_year->execute(array(':unit_id' => $unit_id));

            $ins = $dbh->prepare('INSERT INTO Greenhous_prod (date_s, unit_id, y_prod, v_unit, num_bah, bah_cod_m, mor_cod_m, no_kesht,
                                  id_ostan, id_city, id_mar, add_abadi, add_city)
                                  VALUES (:date_s, :unit_id, :y_prod, :v_unit, :num_bah, :bah_cod_m, :mor_cod_m, :no_kesht,
                                  :id_ostan, :id_city, :id_mar, :add_abadi, :add_city)');
            $ins->execute(array(
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
            sabt_event($login_session, getUserIP_1(), $date_edit, $time, '', 'ثبت عملکرد گلخانه-' . $bah_cod_m, $unit_row['id_ostan']);
            alert('ویرایش عملکرد واحد گلخانه با موفقیت ثبت شد ');
            echo '<form name="myform" method="post" action="liste_Greenhous_prod.php">';
            echo '<input type="hidden" name="id" value="' . (int) $unit_id . '"/>';
            echo '<input type="hidden" name="bah_cod_m" value="' . edit_h($bah_cod_m) . '"/>';
            echo '</form>';
            echo '<script type="text/javascript">document.myform.submit();</script>';
            exit;
        }
    }
}

if ($unit_id > 0 && $y_prod !== '') {
    $stmt = $dbh->prepare('SELECT t_mah, no_mtol FROM Greenhous_prod WHERE unit_id = :unit_id AND y_prod = :y_prod');
    $stmt->execute(array(':unit_id' => $unit_id, ':y_prod' => $y_prod));
    $prod = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($prod) {
        $no_mtol = $prod['no_mtol'];
        $t_mah = $prod['t_mah'];
    }
}

$units = array();
$no_kesht = '';
if ($bah_cod_m !== '' && $unit_id > 0) {
    $stmt = $dbh->prepare('SELECT id, unit_name, no_kesht, num_bah
                           FROM Greenhous
                           WHERE bah_cod_m = :bah_cod_m AND mor_cod_m = :mor_cod_m
                             AND num_bah = :num_bah AND id = :id');
    $stmt->execute(array(
        ':bah_cod_m' => $bah_cod_m,
        ':mor_cod_m' => $login_session,
        ':num_bah' => $num_bah,
        ':id' => $unit_id
    ));
    $units = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($units) {
        $no_kesht = $units[0]['no_kesht'];
    }
}

$show_crop = ($v_unit === '1');
$btn_label = $show_crop ? 'ادامه' : 'ثبت و خروج';
$open_air = ($no_kesht === '2');
$page_title = isset($title) ? $title : 'ویرایش عملکرد گلخانه';
$kesht_label = array('1' => 'گلخانه', '2' => 'فضای باز');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo edit_h($page_title); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <style>
        :root {
            --color-primary: #15803D;
            --color-on-primary: #FFFFFF;
            --color-secondary: #166534;
            --color-background: #F0FDF4;
            --color-foreground: #14532D;
            --color-card: #FFFFFF;
            --color-muted: #E8F0F1;
            --color-muted-foreground: #475569;
            --color-border: #86C9A0;
            --color-destructive: #DC2626;
            --color-ring: #15803D;
            --space-2: 16px;
            --space-3: 24px;
            --space-4: 32px;
            --shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
            --touch: 44px;
            --font: myfont, Tahoma, "Segoe UI", sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; }
        html { -webkit-text-size-adjust: 100%; text-size-adjust: 100%; }
        body.agri1-body { margin: 0; background: var(--color-background); color: var(--color-foreground); font-family: var(--font); font-size: 16px; line-height: 1.6; }
        .agri1-skip { position: absolute; right: -999px; top: 8px; background: var(--color-primary); color: #fff; padding: 8px 16px; border-radius: 8px; }
        .agri1-skip:focus { right: 8px; }
        .agri1-main { width: 100%; padding: var(--space-3) 8px var(--space-4); }
        .agri1-title { margin: 0 0 var(--space-2); font-size: clamp(1.35rem, 2.4vw, 1.85rem); line-height: 1.4; }
        .agri1-card-search { max-width: 720px; margin: 0 auto; background: var(--color-card); border: 1px solid var(--color-border); border-radius: 16px; box-shadow: var(--shadow); padding: 16px; }
        .agri1-field { margin-top: 12px; }
        .agri1-label { display: block; margin-bottom: 6px; font-weight: 700; }
        .agri1-alert { margin: 0 0 12px; padding: 12px 14px; border-radius: 10px; background: #FEF2F2; border: 1px solid #FECACA; color: var(--color-destructive); }
        .agri1-page .agri1-form input[type="text"],
        .agri1-page .agri1-form select { width: 100%; min-height: 36px; padding: 6px 12px; border: 1px solid #64748B; border-radius: 10px; background: #fff; color: var(--color-foreground); font-size: 16px; font-family: inherit; }
        .agri1-page .agri1-form select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2314532D' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: left 10px center; padding-left: 32px; }
        .agri1-page .agri1-form input:focus, .agri1-page .agri1-form select:focus { border-color: var(--color-ring); box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25); outline: none; }
        #bah_cod_m, #t_mah { direction: ltr; text-align: center; }
        .agri1-select { position: relative; width: 100%; }
        .agri1-select.is-enhanced > select { position: absolute; width: 1px; height: 1px; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); }
        .agri1-select-btn { display: flex; align-items: center; justify-content: space-between; width: 100%; min-height: 36px; padding: 6px 12px; border: 1px solid #64748B; border-radius: 10px; background: #fff; color: var(--color-foreground); font: inherit; font-size: 16px; text-align: right; cursor: pointer; }
        .agri1-select-btn:focus-visible, .agri1-select.is-open .agri1-select-btn { outline: none; border-color: var(--color-ring); box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25); }
        .agri1-select-label { flex: 1; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .agri1-icon { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; }
        .agri1-select.is-open .agri1-select-caret { transform: rotate(180deg); }
        .agri1-select-list { display: none; position: absolute; top: calc(100% + 4px); right: 0; left: 0; z-index: 40; max-height: 240px; overflow-y: auto; margin: 0; padding: 6px 0; list-style: none; background: #fff; border: 1px solid var(--color-border); border-radius: 10px; box-shadow: var(--shadow); }
        .agri1-select.is-open .agri1-select-list { display: block; }
        .agri1-select-option { min-height: 36px; padding: 8px 14px; cursor: pointer; }
        .agri1-select-option:hover, .agri1-select-option.is-selected { background: #ECFDF3; color: var(--color-primary); }
        .is-hidden { display: none !important; }
        .agri1-actions { display: flex; justify-content: center; margin-top: 16px; }
        .agri1-btn { display: inline-flex; align-items: center; justify-content: center; min-height: var(--touch); padding: 10px 20px; border: 0; border-radius: 12px; background: var(--color-primary); color: #fff; font: inherit; font-weight: 700; cursor: pointer; }
        .agri1-btn:focus-visible { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-overlay { display: none; position: fixed; inset: 0; z-index: 90; align-items: center; justify-content: center; background: rgba(15, 23, 42, 0.55); }
        .agri1-overlay.is-open { display: flex; }
        .agri1-overlay-panel { display: flex; flex-direction: column; align-items: center; gap: 12px; min-width: 220px; padding: 24px; border-radius: 16px; background: #fff; }
        .agri1-spinner { width: 40px; height: 40px; border: 3px solid var(--color-border); border-top-color: var(--color-primary); border-radius: 50%; animation: agri1-spin 0.8s linear infinite; }
        @keyframes agri1-spin { to { transform: rotate(360deg); } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; } }
    </style>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#reg-form">رفتن به فرم</a>
    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>
    <main class="agri1-main">
        <h1 class="agri1-title">ویرایش اطلاعات عملکرد سالانه گلخانه</h1>
        <section class="agri1-card agri1-card-search">
            <?php if ($mess !== '') { ?>
            <div class="agri1-alert" role="alert"><?php echo $mess; ?></div>
            <?php } ?>
            <form id="reg-form" class="agri1-form" name="form1" action="#1" method="post" novalidate>
                <div class="agri1-field" style="margin-top:0">
                    <label class="agri1-label" for="bah_cod_m">کد ملی بهره‌بردار</label>
                    <input name="bah_cod_m" id="bah_cod_m" type="text" maxlength="10" inputmode="numeric" dir="ltr" value="<?php echo edit_h($bah_cod_m); ?>"/>
                </div>
                <div class="agri1-field">
                    <label class="agri1-label" for="unit_id">نام واحد</label>
                    <select name="unit_id" id="unit_id">
                        <?php foreach ($units as $unit_opt) {
                            $label = $unit_opt['unit_name'] . ' / نوع کشت : ' . (isset($kesht_label[$unit_opt['no_kesht']]) ? $kesht_label[$unit_opt['no_kesht']] : '');
                        ?>
                        <option value="<?php echo (int) $unit_opt['id']; ?>" data-kesht="<?php echo ($unit_opt['no_kesht'] === '2') ? '2' : '1'; ?>"<?php if ($unit_id === (int) $unit_opt['id']) echo ' selected="selected"'; ?>><?php echo edit_h($label); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="agri1-field">
                    <label class="agri1-label" for="y_prod">عملکرد سال</label>
                    <select name="y_prod" id="y_prod">
                        <option value="">انتخاب کنید</option>
                        <option value="1405"<?php if ($y_prod === '1405') echo ' selected="selected"'; ?>>1405</option>
                    </select>
                </div>
                <div class="agri1-field">
                    <label class="agri1-label" for="v_unit">وضعیت واحد</label>
                    <select name="v_unit" id="v_unit" class="v_unit">
                        <option value="">انتخاب کنید</option>
                        <option value="1"<?php if ($v_unit === '1') echo ' selected="selected"'; ?>>فعال</option>
                        <option value="2"<?php if ($v_unit === '2') echo ' selected="selected"'; ?>>در حال اخذ پروانه تاسیس</option>
                        <option value="3"<?php if ($v_unit === '3') echo ' selected="selected"'; ?>>دارای پیشرفت فیزیکی</option>
                        <option value="4"<?php if ($v_unit === '4') echo ' selected="selected"'; ?>>غیرفعال</option>
                    </select>
                </div>
                <div class="agri1-field<?php if (!$show_crop) echo ' is-hidden'; ?>" id="field-no_mtol">
                    <label class="agri1-label" for="no_mtol">نوع محصول تولیدی</label>
                    <select name="no_mtol" id="no_mtol">
                        <option value="">انتخاب کنید</option>
                        <?php if (!$open_air) { ?>
                        <option value="211100"<?php if ($no_mtol == '211100') echo ' selected="selected"'; ?>>سبزی و صیفی</option>
                        <?php } ?>
                        <option value="211300"<?php if ($no_mtol == '211300') echo ' selected="selected"'; ?>>گل و گیاه زینتی</option>
                        <?php if (!$open_air) { ?>
                        <option value="211200"<?php if ($no_mtol == '211200') echo ' selected="selected"'; ?>>سایر</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="agri1-field<?php if (!$show_crop) echo ' is-hidden'; ?>" id="field-t_mah">
                    <label class="agri1-label" for="t_mah">تنوع محصول</label>
                    <input name="t_mah" id="t_mah" type="text" maxlength="2" inputmode="numeric" dir="ltr" value="<?php echo edit_h($show_crop ? $t_mah : 'x'); ?>"/>
                </div>
                <input type="hidden" name="num_bah" value="<?php echo edit_h($num_bah); ?>"/>
                <div class="agri1-actions">
                    <button type="submit" name="action" id="btn" class="agri1-btn" value="1"><?php echo edit_h($btn_label); ?></button>
                </div>
            </form>
        </section>
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
            var status = document.getElementById('v_unit');
            var cropField = document.getElementById('field-no_mtol');
            var countField = document.getElementById('field-t_mah');
            var count = document.getElementById('t_mah');
            var btn = document.getElementById('btn');
            function showOverlay() {
                if (overlay) overlay.className = 'agri1-overlay is-open';
                if (btn) btn.setAttribute('aria-busy', 'true');
            }
            function applyStatus() {
                var active = status.value === '1';
                cropField.classList.toggle('is-hidden', !active);
                countField.classList.toggle('is-hidden', !active);
                btn.textContent = active ? 'ادامه' : 'ثبت و خروج';
                if (!active) count.value = 'x';
            }
            bah.addEventListener('change', function () {
                showOverlay();
                HTMLFormElement.prototype.submit.call(form);
            });
            status.addEventListener('change', applyStatus);
            form.addEventListener('submit', showOverlay);
            applyStatus();
        })();
        (function () {
            var form = document.getElementById('reg-form');
            if (!form) return;
            function closeAll() {
                var open = form.querySelectorAll('.agri1-select.is-open');
                for (var i = 0; i < open.length; i++) {
                    open[i].classList.remove('is-open');
                    var b = open[i].querySelector('.agri1-select-btn');
                    if (b) b.setAttribute('aria-expanded', 'false');
                }
            }
            function enhance(select) {
                if (select.getAttribute('data-agri1-select') === '1') return;
                select.setAttribute('data-agri1-select', '1');
                var wrap = document.createElement('div');
                wrap.className = 'agri1-select is-enhanced';
                select.parentNode.insertBefore(wrap, select);
                wrap.appendChild(select);
                var button = document.createElement('button');
                button.type = 'button';
                button.className = 'agri1-select-btn';
                button.setAttribute('aria-haspopup', 'listbox');
                button.setAttribute('aria-expanded', 'false');
                button.innerHTML = '<span class="agri1-select-label"></span><svg class="agri1-icon agri1-select-caret" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>';
                var labelEl = button.querySelector('.agri1-select-label');
                var list = document.createElement('ul');
                list.className = 'agri1-select-list';
                list.setAttribute('role', 'listbox');
                wrap.appendChild(button);
                wrap.appendChild(list);
                function sync() {
                    var opt = select.options[select.selectedIndex];
                    labelEl.textContent = opt ? String(opt.text).replace(/^\s+|\s+$/g, '') : '';
                }
                function build() {
                    list.innerHTML = '';
                    for (var i = 0; i < select.options.length; i++) {
                        var li = document.createElement('li');
                        li.className = 'agri1-select-option';
                        li.setAttribute('data-index', String(i));
                        li.textContent = String(select.options[i].text).replace(/^\s+|\s+$/g, '');
                        if (i === select.selectedIndex) li.classList.add('is-selected');
                        list.appendChild(li);
                    }
                    sync();
                }
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var willOpen = !wrap.classList.contains('is-open');
                    closeAll();
                    if (willOpen) {
                        build();
                        wrap.classList.add('is-open');
                        button.setAttribute('aria-expanded', 'true');
                    }
                });
                list.addEventListener('click', function (e) {
                    var t = e.target;
                    if (!t || t.getAttribute('data-index') == null) return;
                    select.selectedIndex = parseInt(t.getAttribute('data-index'), 10);
                    select.dispatchEvent(new Event('change', { bubbles: true }));
                    closeAll();
                });
                select.addEventListener('change', sync);
                build();
            }
            var selects = form.querySelectorAll('select');
            for (var s = 0; s < selects.length; s++) enhance(selects[s]);
            document.addEventListener('click', closeAll);
        })();
    </script>
</body>
</html>
