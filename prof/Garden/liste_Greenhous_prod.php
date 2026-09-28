<?php
include('../../lock_p1.php');
include('../../event.php');
include_once('../../login/config.php');

function list_h($v)
{
    return htmlspecialchars(str_replace('&nbsp;', ' ', $v . ''), ENT_QUOTES, 'UTF-8');
}

function list_map($map, $code)
{
    if (isset($map[$code]) && $code !== '' && $code !== null) {
        return $map[$code];
    }
    return '—';
}

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$no_moj = isset($_POST['no_moj']) ? trim($_POST['no_moj'] . '') : '';
$unit = null;
$prods = array();

$v_unit_map = array(
    '1' => 'فعال',
    '2' => 'در حال اخذ پروانه تاسیس',
    '3' => 'دارای پیشرفت فیزیکی',
    '4' => 'غیرفعال'
);
$mtol_map = array(
    '211100' => 'سبزی و صیفی',
    '211300' => 'گل و گیاهان زینتی',
    '211200' => 'سایر'
);
$kesht_map = array('1' => 'گلخانه', '2' => 'فضای باز');

if ($id > 0) {
    $stmt = $dbh->prepare('SELECT g.id, g.id_ostan, g.id_city, g.add_abadi, g.add_city, g.no_kesht,
                                  g.m_zamin, g.bah_cod_m, g.unit_name, g.num_bah,
                                  bah.name, bah.last_name
                           FROM Greenhous g
                           LEFT JOIN bah ON g.bah_cod_m = bah.bah_cod_m AND g.num_bah = bah.num_bah
                           WHERE g.id = :id');
    $stmt->execute(array(':id' => $id));
    $unit = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($unit) {
        $stmt = $dbh->prepare('SELECT id, bah_cod_m, add_abadi, add_city, unit_id, y_prod, v_unit, num_bah,
                                      nesha_m, bazr_m, t_zan, t_mar, no_mtol
                               FROM Greenhous_prod
                               WHERE unit_id = :unit_id
                               ORDER BY y_prod DESC');
        $stmt->execute(array(':unit_id' => $id));
        $prods = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$page_title = isset($title) ? $title : 'عملکرد سالانه واحد گلخانه';
$bah_name = '—';
if ($unit) {
    $bah_name = trim($unit['last_name'] . ' ' . $unit['name']);
    if ($bah_name === '') {
        $bah_name = '—';
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo list_h($page_title); ?></title>
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
        .agri1-card { background: var(--color-card); border: 1px solid var(--color-border); border-radius: 16px; box-shadow: var(--shadow); padding: 12px 8px; }
        .agri1-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px 16px; direction: rtl; margin-bottom: 16px; }
        .agri1-grid .agri1-field { direction: rtl; }
        .agri1-label { display: block; margin-bottom: 6px; font-weight: 700; }
        .agri1-unit { color: var(--color-muted-foreground); font-size: 0.875rem; font-weight: 400; }
        .agri1-info { min-height: var(--touch); padding: 10px 12px; border-radius: 10px; background: var(--color-muted); overflow-wrap: break-word; word-break: break-word; }
        .agri1-info-ltr { direction: ltr; text-align: center; font-family: Tahoma, "Segoe UI", sans-serif; }
        .agri1-note { margin: 8px 0 0; padding: 12px 14px; border-radius: 10px; background: #EFF6FF; border: 1px solid #BFDBFE; color: #1D4ED8; }
        .agri1-results-toolbar { display: grid; grid-template-columns: 1fr auto 1fr; direction: ltr; margin: 0 0 8px; align-items: center; }
        .agri1-col-picker { justify-self: start; position: relative; }
        .agri1-icon { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .agri1-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: var(--touch); padding: 8px 16px; border-radius: 12px; border: 1px solid var(--color-border); background: transparent; color: var(--color-foreground); font: inherit; font-weight: 700; cursor: pointer; text-decoration: none; }
        .agri1-btn:focus-visible { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-btn-primary { background: var(--color-primary); color: #fff; border-color: transparent; }
        .agri1-btn-ghost:hover { background: var(--color-muted); }
        .agri1-icon-btn { min-width: var(--touch); min-height: var(--touch); padding: 8px; border: 0; background: transparent; cursor: pointer; }
        .agri1-icon-btn img { width: 20px; height: 20px; object-fit: contain; }
        .agri1-col-panel { display: none; position: absolute; z-index: 30; top: calc(100% + 6px); left: 0; min-width: 220px; padding: 12px; background: #fff; border: 1px solid var(--color-border); border-radius: 12px; box-shadow: var(--shadow); direction: rtl; }
        .agri1-col-panel.is-open { display: block; }
        .agri1-col-list label { display: flex; align-items: center; gap: 8px; min-height: var(--touch); }
        .is-col-hidden { display: none !important; }
        .agri1-table-hint { display: none; margin: 0 0 8px; text-align: center; color: var(--color-muted-foreground); font-size: 0.8125rem; }
        .agri1-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; border: 1px solid var(--color-border); border-radius: 12px; direction: ltr; }
        .agri1-table { width: 100%; min-width: 1100px; border-collapse: collapse; table-layout: fixed; direction: ltr; }
        .agri1-table th { background: var(--color-primary); color: #fff; padding: 5px 3px; font-size: 11px; white-space: nowrap; border: 1px solid #fff; }
        .agri1-table td { padding: 4px 3px; text-align: center; vertical-align: middle; font-family: myfont2, yekan, Tahoma, "Segoe UI", sans-serif; font-size: 16px; font-weight: 400; border-bottom: 1px solid var(--color-border); white-space: normal; overflow-wrap: break-word; word-break: break-word; }
        .agri1-table .agri1-ops { white-space: nowrap; }
        .agri1-table tbody tr:nth-child(even) td { background: var(--color-background); }
        .agri1-table tbody tr:hover td { background: #ECFDF3; }
        .agri1-actions { display: flex; justify-content: center; gap: 12px; margin-top: 16px; }
        @media (max-width: 1100px) { .agri1-table-hint { display: block; } }
        @media (max-width: 640px) { .agri1-grid { grid-template-columns: 1fr; } .agri1-table th { font-size: 13px; } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; } }
    </style>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#agri-list">رفتن به فهرست</a>
    <main class="agri1-main" id="agri-list">
        <h1 class="agri1-title">عملکرد سالانه واحد گلخانه</h1>
        <?php if (!$unit) { ?>
        <p class="agri1-note">اطلاعاتی یافت نشد</p>
        <?php } else { ?>
        <section class="agri1-card" aria-label="نتایج جستجو">
            <div class="agri1-grid">
                <div class="agri1-field">
                    <span class="agri1-label">شهرستان</span>
                    <div class="agri1-info"><?php echo list_h(city_name1($unit['id_city'], $unit['id_ostan'])); ?></div>
                </div>
                <div class="agri1-field">
                    <span class="agri1-label">شهر / آبادی</span>
                    <div class="agri1-info"><?php echo list_h(trim(abadi_name($unit['add_abadi']) . shahr_name($unit['add_city']))); ?></div>
                </div>
                <div class="agri1-field">
                    <span class="agri1-label">نام و نام خانوادگی</span>
                    <div class="agri1-info"><?php echo list_h($bah_name); ?></div>
                </div>
                <div class="agri1-field">
                    <span class="agri1-label">کد ملی</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo list_h($unit['bah_cod_m']); ?></div>
                </div>
                <div class="agri1-field">
                    <span class="agri1-label">نام واحد</span>
                    <div class="agri1-info"><?php echo list_h($unit['unit_name']); ?></div>
                </div>
                <div class="agri1-field">
                    <span class="agri1-label">نوع کشت</span>
                    <div class="agri1-info"><?php echo list_h(list_map($kesht_map, $unit['no_kesht'])); ?></div>
                </div>
                <div class="agri1-field">
                    <span class="agri1-label">مساحت زمین <span class="agri1-unit">مترمربع</span></span>
                    <div class="agri1-info agri1-info-ltr"><?php echo list_h($unit['m_zamin']); ?></div>
                </div>
            </div>

            <?php if (!$prods) { ?>
            <p class="agri1-note">عملکردی برای این واحد یافت نشد. ثبت عملکرد سالانه را بزنید.</p>
            <?php } else { ?>
            <div class="agri1-results-toolbar">
                <div class="agri1-col-picker" id="agri1-col-picker">
                    <button type="button" class="agri1-btn agri1-btn-ghost" id="agri1-col-picker-btn" aria-expanded="false" aria-controls="agri1-col-panel">
                        <svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16M4 12h16M4 19h16"></path></svg>
                        ستون‌ها
                    </button>
                    <div class="agri1-col-panel" id="agri1-col-panel" role="group" aria-label="نمایش ستون‌ها">
                        <button type="button" class="agri1-btn agri1-btn-ghost" id="agri1-col-reset">نمایش همه</button>
                        <div class="agri1-col-list">
                            <label><input type="checkbox" data-col-toggle="y_prod" checked/> عملکرد سال</label>
                            <label><input type="checkbox" data-col-toggle="v_unit" checked/> وضعیت واحد</label>
                            <label><input type="checkbox" data-col-toggle="no_mtol" checked/> نوع محصول</label>
                            <label><input type="checkbox" data-col-toggle="t_mar" checked/> شاغل مرد</label>
                            <label><input type="checkbox" data-col-toggle="t_zan" checked/> شاغل زن</label>
                            <label><input type="checkbox" data-col-toggle="bazr" checked/> بذر</label>
                            <label><input type="checkbox" data-col-toggle="nesha" checked/> نشاء</label>
                            <label><input type="checkbox" data-col-toggle="ops" checked/> عملیات</label>
                        </div>
                    </div>
                </div>
            </div>
            <p class="agri1-table-hint">برای مشاهده همه ستون‌ها جدول را افقی بکشید.</p>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <thead>
                        <tr>
                            <th class="agri1-ops" data-col="ops">حذف</th>
                            <th class="agri1-ops" data-col="ops">ویرایش</th>
                            <th class="agri1-ops" data-col="ops">نمایش</th>
                            <th data-col="nesha">تعداد نشاء مصرفی<br/>عدد</th>
                            <th data-col="bazr">میزان بذر مصرفی<br/>کیلوگرم</th>
                            <th data-col="t_zan">تعداد شاغل زن<br/>نفر</th>
                            <th data-col="t_mar">تعداد شاغل مرد<br/>نفر</th>
                            <th data-col="no_mtol">نوع محصول تولیدی</th>
                            <th data-col="v_unit">وضعیت واحد</th>
                            <th data-col="y_prod">عملکرد سال</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($prods as $row) {
                        $open_year = ($row['y_prod'] == '1405');
                    ?>
                        <tr>
                            <td class="agri1-ops" data-col="ops">
                                <?php if ($open_year) { ?>
                                <form action="del_list_Greenhous_prod.php" method="post" onsubmit="target_po2(this)">
                                    <input type="hidden" name="bah_cod_m" value="<?php echo list_h($row['bah_cod_m']); ?>"/>
                                    <input type="hidden" name="add_abadi" value="<?php echo list_h($row['add_abadi']); ?>"/>
                                    <input type="hidden" name="add_city" value="<?php echo list_h($row['add_city']); ?>"/>
                                    <input type="hidden" name="unit_id" value="<?php echo (int) $id; ?>"/>
                                    <input type="hidden" name="y_prod" value="<?php echo list_h($row['y_prod']); ?>"/>
                                    <button class="agri1-icon-btn" type="submit" title="حذف عملکرد واحد" onclick="return confirm('از حذف اطلاعات عملکرد واحد مطمئن هستید ؟')"><img src="../../files/del.png" alt="حذف"/></button>
                                </form>
                                <?php } ?>
                            </td>
                            <td class="agri1-ops" data-col="ops">
                                <?php if ($open_year) { ?>
                                <form action="Greenh_prod_edit.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo (int) $row['id']; ?>"/>
                                    <input type="hidden" name="bah_cod_m" value="<?php echo list_h($row['bah_cod_m']); ?>"/>
                                    <input type="hidden" name="unit_id" value="<?php echo list_h($row['unit_id']); ?>"/>
                                    <input type="hidden" name="y_prod" value="<?php echo list_h($row['y_prod']); ?>"/>
                                    <input type="hidden" name="v_unit" value="<?php echo list_h($row['v_unit']); ?>"/>
                                    <input type="hidden" name="num_bah" value="<?php echo list_h($row['num_bah']); ?>"/>
                                    <button class="agri1-icon-btn" type="submit" title="ویرایش عملکرد واحد"><img src="../../files/edit.png" alt="ویرایش"/></button>
                                </form>
                                <?php } ?>
                            </td>
                            <td class="agri1-ops" data-col="ops">
                                <?php if ($row['v_unit'] == '1') { ?>
                                <form action="Greenh_prod_view.php" method="post" onsubmit="target_po3(this)">
                                    <input type="hidden" name="id" value="<?php echo (int) $row['id']; ?>"/>
                                    <input type="hidden" name="bah_cod_m" value="<?php echo list_h($row['bah_cod_m']); ?>"/>
                                    <input type="hidden" name="unit_id" value="<?php echo list_h($row['unit_id']); ?>"/>
                                    <input type="hidden" name="y_prod" value="<?php echo list_h($row['y_prod']); ?>"/>
                                    <input type="hidden" name="v_unit" value="<?php echo list_h($row['v_unit']); ?>"/>
                                    <input type="hidden" name="num_bah" value="<?php echo list_h($row['num_bah']); ?>"/>
                                    <input type="hidden" name="no_moj" value="<?php echo list_h($no_moj); ?>"/>
                                    <button class="agri1-icon-btn" type="submit" title="نمایش اطلاعات عملکرد واحد"><img src="../../files/view.png" alt="نمایش"/></button>
                                </form>
                                <?php } ?>
                            </td>
                            <td data-col="nesha"><?php echo list_h($row['nesha_m']); ?></td>
                            <td data-col="bazr"><?php echo list_h($row['bazr_m']); ?></td>
                            <td data-col="t_zan"><?php echo list_h($row['t_zan']); ?></td>
                            <td data-col="t_mar"><?php echo list_h($row['t_mar']); ?></td>
                            <td data-col="no_mtol"><?php echo list_h($row['no_mtol'] === '' || $row['no_mtol'] === null ? '—' : list_map($mtol_map, $row['no_mtol'])); ?></td>
                            <td data-col="v_unit"><?php echo list_h(list_map($v_unit_map, $row['v_unit'])); ?></td>
                            <td data-col="y_prod"><?php echo list_h($row['y_prod']); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>

            <form id="form_name" action="Greenhous_prodi.php" method="post">
                <input type="hidden" name="bah_cod_m" value="<?php echo list_h($unit['bah_cod_m']); ?>"/>
                <input type="hidden" name="unit_id" value="<?php echo (int) $id; ?>"/>
                <input type="hidden" name="num_bah" value="<?php echo list_h($unit['num_bah']); ?>"/>
                <input type="hidden" name="no_moj" value="<?php echo list_h($no_moj); ?>"/>
            </form>
            <div class="agri1-actions">
                <button type="submit" class="agri1-btn agri1-btn-primary" form="form_name">ثبت عملکرد سالانه</button>
                <button type="button" class="agri1-btn agri1-btn-ghost" id="agri-close">بازگشت</button>
            </div>
        </section>
        <?php } ?>
        <?php if (!$unit) { ?>
        <div class="agri1-actions">
            <button type="button" class="agri1-btn agri1-btn-ghost" id="agri-close">بازگشت</button>
        </div>
        <?php } ?>
    </main>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td height="109" style="background: url('../../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../../footer.php'); ?>
            </td>
        </tr>
    </table>
    <script>
        function target_po2(form) {
            window.open('null', 'formpopup', 'width=500,height=130,resizeable,scrollbars');
            form.target = 'formpopup';
        }
        function target_po3(form) {
            window.open('null', 'formpopup', 'width=950,height=1400,resizeable,scrollbars');
            form.target = 'formpopup';
        }
        (function () {
            var btn = document.getElementById('agri-close');
            if (btn) btn.addEventListener('click', function () {
                if (window.opener && !window.opener.closed) { window.close(); return; }
                window.history.back();
            });
            var picker = document.getElementById('agri1-col-picker');
            var pbtn = document.getElementById('agri1-col-picker-btn');
            var panel = document.getElementById('agri1-col-panel');
            var table = document.querySelector('.agri1-table');
            if (!picker || !pbtn || !panel || !table) return;
            var KEY = 'liste_Greenhous_prod_hidden_cols';
            function readMap() {
                try {
                    var arr = JSON.parse(localStorage.getItem(KEY) || '[]');
                    var map = {};
                    if (Array.isArray(arr)) for (var i = 0; i < arr.length; i++) map[arr[i]] = true;
                    return map;
                } catch (e) { return {}; }
            }
            function apply(map) {
                var cells = table.querySelectorAll('[data-col]');
                for (var i = 0; i < cells.length; i++) {
                    var id = cells[i].getAttribute('data-col');
                    cells[i].classList.toggle('is-col-hidden', !!map[id]);
                }
                var boxes = panel.querySelectorAll('[data-col-toggle]');
                for (var j = 0; j < boxes.length; j++) boxes[j].checked = !map[boxes[j].getAttribute('data-col-toggle')];
            }
            var hidden = readMap();
            apply(hidden);
            pbtn.addEventListener('click', function (e) {
                e.stopPropagation();
                var open = panel.classList.toggle('is-open');
                pbtn.setAttribute('aria-expanded', open ? 'true' : 'false');
            });
            panel.addEventListener('change', function (e) {
                var box = e.target;
                if (!box.getAttribute || !box.getAttribute('data-col-toggle')) return;
                var id = box.getAttribute('data-col-toggle');
                if (!box.checked) {
                    var left = panel.querySelectorAll('[data-col-toggle]:checked').length;
                    if (left < 1) { box.checked = true; return; }
                    hidden[id] = true;
                } else delete hidden[id];
                var arr = [];
                for (var k in hidden) if (hidden[k]) arr.push(k);
                try { localStorage.setItem(KEY, JSON.stringify(arr)); } catch (err) {}
                apply(hidden);
            });
            document.getElementById('agri1-col-reset').addEventListener('click', function () {
                hidden = {};
                try { localStorage.removeItem(KEY); } catch (err) {}
                apply(hidden);
            });
            document.addEventListener('click', function () { panel.classList.remove('is-open'); pbtn.setAttribute('aria-expanded', 'false'); });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') { panel.classList.remove('is-open'); pbtn.setAttribute('aria-expanded', 'false'); }
            });
        })();
    </script>
</body>
</html>
<?php if (isset($_POST['com_alert'])) alert($_POST['com_alert']); ?>
