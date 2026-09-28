<?php
include('../../lock_p1.php');
include_once('../../login/config.php');
include('../../event.php');

function view_h($v)
{
    if (!isset($v)) {
        return '';
    }
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function view_place($v)
{
    return view_h(str_replace('&nbsp;', ' ', $v . ''));
}

function view_map($map, $code)
{
    if (isset($map[$code]) && $code !== '' && $code !== null) {
        return $map[$code];
    }
    return '—';
}

function view_num($v)
{
    if ($v === '' || $v === null) {
        return '—';
    }
    return view_h($v * 1);
}

function view_field($label, $value, $ltr = false)
{
    $cls = $ltr ? 'agri1-info agri1-info-ltr' : 'agri1-info';
    echo '<div class="agri1-field">';
    echo '<span class="agri1-label">' . $label . '</span>';
    echo '<div class="' . $cls . '">' . $value . '</div>';
    echo '</div>';
}

function view_kv_table($rows)
{
    echo '<div class="agri1-table-wrap is-compact"><table class="agri1-table">';
    echo '<thead><tr><th>ارزش<br/>ریال</th><th>مقدار</th><th>نوع</th></tr></thead><tbody>';
    foreach ($rows as $row) {
        echo '<tr>';
        echo '<td>' . view_num($row[2]) . '</td>';
        echo '<td>' . view_num($row[1]) . '</td>';
        echo '<td>' . view_h($row[0]) . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table></div>';
}

function greenh_prod_go_home()
{
    echo '<form name="myform" class="myform" method="post" action="Greenhous_prod.php"></form>';
    echo '<script type="text/javascript">document.myform.submit();</script>';
    exit;
}

$unit_id = isset($_POST['unit_id']) ? (int) $_POST['unit_id'] : 0;
$y_prod = isset($_POST['y_prod']) ? trim($_POST['y_prod'] . '') : '';
$num_bah = isset($_POST['num_bah']) ? trim($_POST['num_bah'] . '') : '';

if ($unit_id < 1 || $y_prod === '') {
    greenh_prod_go_home();
}

$query = "SELECT g.bah_cod_m, g.add_abadi, g.add_city, g.id_ostan, g.id_city, g.id_mar,
                 g.unit_name, g.no_kesht, g.gaz, g.barg,
                 p.no_mtol, p.z_dep, p.dep, p.lisan, p.t_mar, p.t_zan, p.m_fani,
                 p.gar_j, p.gar_ja, p.gar_m, p.gar_ma,
                 p.hash_j, p.hash_ja, p.hash_m, p.hash_ma,
                 p.zof_j, p.zof_ja, p.zof_m, p.zof_ma,
                 p.gazoil_m, p.gazoil_a, p.ab_m, p.ab_a, p.benz_m, p.benz_a,
                 p.barg_m, p.barg_a, p.gaz_m, p.gaz_a,
                 p.kod_h1_m, p.kod_h1_a, p.kod_h2_m, p.kod_h2_a, p.kod_h3_m, p.kod_h3_a,
                 p.kod_sh1_m, p.kod_sh1_a, p.kod_sh2_m, p.kod_sh2_a, p.kod_sh3_m, p.kod_sh3_a,
                 p.kod_bio1_m, p.kod_bio1_a, p.kod_bio2_m, p.kod_bio2_a, p.kod_bio3_m, p.kod_bio3_a,
                 p.bazr_m, p.bazr_a, p.nesha_m, p.nesha_a,
                 p.t_hshekar, p.t_zgard,
                 p.b_coco, p.b_mas, p.b_per, p.b_pet, p.b_say
          FROM Greenhous g
          INNER JOIN Greenhous_prod p ON p.unit_id = g.id AND p.y_prod = :y_prod
          WHERE g.id = :id
          LIMIT 1";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id' => $unit_id, ':y_prod' => $y_prod));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    greenh_prod_go_home();
}

if ($num_bah === '') {
    $num_bah = '1';
}

$bah_cod_m = $row['bah_cod_m'];
$view_ostan = $row['id_ostan'];
$view_city = $row['id_city'];
$view_mar = $row['id_mar'];
$no_mtol = $row['no_mtol'];
$no_kesht = $row['no_kesht'];

$mtol_map = array(
    '211100' => 'سبزی و صیفی',
    '211300' => 'گل و گیاه زینتی',
    '211200' => 'سایر'
);
$unit_map = array(
    '211100' => 'تن',
    '211300' => 'شاخه/گلدان/بونه/اصله',
    '211200' => 'تن/عدد'
);
$v_no_mtol = view_map($mtol_map, $no_mtol);
$unit = isset($unit_map[$no_mtol]) ? $unit_map[$no_mtol] : '';
$v_no_kesht = view_map(array('1' => 'گلخانه', '2' => 'در فضای باز'), $no_kesht);
$v_m_fani = view_map(array('1' => 'دارد', '2' => 'ندارد'), $row['m_fani']);
$show_dates = ($no_mtol == '211100');
$show_hydro = ($no_kesht != '2');
$month_map = array(
    '01' => 'فروردین',
    '02' => 'اردیبهشت',
    '03' => 'خرداد',
    '04' => 'تیر',
    '05' => 'مرداد',
    '06' => 'شهریور',
    '07' => 'مهر',
    '08' => 'آبان',
    '09' => 'آذر',
    '10' => 'دی',
    '11' => 'بهمن',
    '12' => 'اسفند'
);

$query = "SELECT id, group_cod, mah_cod, date_1_kesh, date_2_kesh,
                 s_kesh, date_1_bar, date_2_bar, m_tol
          FROM Greenprod_annual
          WHERE unit_id = :unit_id AND y_prod = :y_prod
          ORDER BY id ASC";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':unit_id' => $unit_id, ':y_prod' => $y_prod));
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$groups = array();
$mah_names = array();
if ($products) {
    $params = array();
    $g_ph = array();
    $m_ph = array();
    $gi = 0;
    $mi = 0;
    $seen_g = array();
    $seen_m = array();
    foreach ($products as $prod_row) {
        $gc = $prod_row['group_cod'];
        $mc = $prod_row['mah_cod'];
        if ($gc !== '' && $gc !== null && !isset($seen_g[$gc])) {
            $seen_g[$gc] = true;
            $key = ':g' . $gi;
            $g_ph[] = $key;
            $params[$key] = $gc;
            $gi++;
        }
        if ($mc !== '' && $mc !== null && !isset($seen_m[$mc])) {
            $seen_m[$mc] = true;
            $key = ':m' . $mi;
            $m_ph[] = $key;
            $params[$key] = $mc;
            $mi++;
        }
    }
    if ($g_ph || $m_ph) {
        $where_n = array();
        if ($g_ph) {
            $where_n[] = 'group_cod IN (' . implode(',', $g_ph) . ')';
        }
        if ($m_ph) {
            $where_n[] = 'mah_cod IN (' . implode(',', $m_ph) . ')';
        }
        $lookup = 'SELECT DISTINCT group_cod, group_name, mah_cod, mah_name
                   FROM product_G
                   WHERE ' . implode(' OR ', $where_n);
        $stmt_n = $dbh->prepare($lookup);
        $stmt_n->execute($params);
        foreach ($stmt_n as $nm) {
            $groups[$nm['group_cod']] = $nm['group_name'];
            $mah_names[$nm['mah_cod']] = $nm['mah_name'];
        }
    }
}

$place_abadi = ($row['add_abadi'] != '' && $row['add_abadi'] != '-') ? abadi_name($row['add_abadi']) : '';
$place_shahr = ($row['add_city'] != '' && $row['add_city'] != '-') ? shahr_name($row['add_city']) : '';
$place_name = trim(($place_abadi ? $place_abadi : '') . ($place_shahr ? $place_shahr : ''));
if ($place_name === '') {
    $place_name = '—';
}

$energy = array(
    array('آب', 'مترمکعب', $row['ab_m'], $row['ab_a']),
    array('بنزین', 'لیتر', $row['benz_m'], $row['benz_a']),
    array('گازوئیل', 'لیتر', $row['gazoil_m'], $row['gazoil_a'])
);
if ($row['barg'] == '1') {
    $energy[] = array('برق', 'کیلووات', $row['barg_m'], $row['barg_a']);
}
if ($row['gaz'] == '1') {
    $energy[] = array('گاز', 'مترمکعب', $row['gaz_m'], $row['gaz_a']);
}

$page_title = isset($title) ? $title : 'عملکرد گلخانه';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo view_h($page_title); ?></title>
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
        html {
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
        }

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

        .agri1-main {
            width: 100%;
            margin: 0 auto;
            padding: var(--space-3) 8px var(--space-4);
        }

        .agri1-title {
            margin: 0 0 var(--space-2);
            color: var(--color-foreground);
            font-size: clamp(1.35rem, 2.4vw, 1.85rem);
            line-height: 1.4;
            text-wrap: balance;
        }

        .agri1-card {
            background: var(--color-card);
            color: var(--color-card-foreground);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: var(--space-3);
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

        .agri1-field { margin-top: 12px; }

        .agri1-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            color: var(--color-foreground);
        }

        .agri1-unit {
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
            font-weight: 400;
        }

        .agri1-info {
            min-height: var(--touch);
            padding: 10px 12px;
            border-radius: 10px;
            background: var(--color-muted);
            color: var(--color-foreground);
            white-space: normal;
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
        }

        .agri1-info-ltr {
            direction: ltr;
            text-align: center;
            letter-spacing: 0.08em;
            font-family: Tahoma, "Segoe UI", sans-serif;
        }

        .agri1-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .agri1-grid .agri1-field { margin-top: 0; }

        .agri1-note {
            margin: 12px 0 0;
            padding: 12px 14px;
            border-radius: 10px;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            color: #1D4ED8;
        }

        .agri1-card-title {
            margin: 0 0 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--color-border);
            font-size: 1rem;
        }
        .agri1-card-title.is-later { margin-top: 24px; }

        .agri1-subhead {
            margin: 16px 0 10px;
            font-size: 0.9375rem;
            font-weight: 700;
            color: var(--color-secondary);
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

        .agri1-btn-ghost {
            background: transparent;
            color: var(--color-foreground);
            border: 1px solid var(--color-border);
        }
        .agri1-btn-ghost:hover { background: var(--color-muted); }

        .agri1-back { margin-top: var(--space-3); }

        .agri1-table-hint {
            display: none;
            margin: 0 0 8px;
            color: var(--color-muted-foreground);
            font-size: 0.8125rem;
            text-align: center;
        }

        .agri1-table-wrap {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            overscroll-behavior-x: contain;
            margin-top: var(--space-2);
            border: 1px solid var(--color-border);
            border-radius: 12px;
            background: var(--color-card);
            direction: ltr;
        }

        .agri1-table {
            width: 100%;
            min-width: 1100px;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 12px;
            direction: ltr;
        }
        .agri1-table-wrap.is-compact .agri1-table {
            min-width: 640px;
        }
        .agri1-table th {
            background: var(--color-primary);
            color: var(--color-on-primary);
            padding: 5px 3px;
            font-weight: 700;
            text-align: center;
            line-height: 1.3;
            font-size: 11px;
            border: 1px solid #FFFFFF;
            white-space: nowrap;
        }
        .agri1-table td {
            padding: 4px 3px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid var(--color-border);
            color: var(--color-foreground);
            font-family: myfont2, yekan, Tahoma, "Segoe UI", sans-serif;
            font-weight: 400;
            font-size: 16px;
            white-space: normal;
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
        }
        .agri1-table tbody tr:nth-child(even) td { background: var(--color-background); }
        .agri1-table tbody tr:hover td { background: #ECFDF3; }

        @media (max-width: 1100px) {
            .agri1-table-hint { display: block; }
        }

        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
            .agri1-table th { font-size: 13px; }
            .agri1-table td { font-size: 16px; }
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
    <a class="agri1-skip" href="#agri-view">رفتن به اطلاعات</a>

    <main class="agri1-main" id="agri-view">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri-view-title">عملکرد سال <?php echo view_h($y_prod); ?> گلخانه</h1>
        </header>

        <section class="agri1-card" aria-labelledby="agri-view-title">
            <div><?php sar_data2($bah_cod_m, $num_bah); ?></div>

            <h2 class="agri1-card-title">موقعیت بهره‌برداری</h2>
            <div class="agri1-grid">
                <?php
                view_field('استان', view_place(ostan_name($view_ostan)));
                view_field('شهرستان', view_place(city_name1($view_city, $view_ostan)));
                view_field('مرکز جهاد کشاورزی', view_place(mar_name($view_mar)));
                view_field('آبادی / شهر', view_place($place_name));
                view_field('نام واحد', view_h($row['unit_name']));
                view_field('نوع محصول تولیدی', view_h($v_no_mtol));
                view_field('نوع کشت', view_h($v_no_kesht));
                ?>
            </div>

            <h2 class="agri1-card-title is-later">تعداد افراد شاغل</h2>
            <div class="agri1-grid">
                <?php
                view_field('زیر دیپلم <span class="agri1-unit">نفر</span>', view_num($row['z_dep']), true);
                view_field('دیپلم یا بالاتر <span class="agri1-unit">نفر</span>', view_num($row['dep']), true);
                view_field('لیسانس یا بالاتر <span class="agri1-unit">نفر</span>', view_num($row['lisan']), true);
                view_field('تعداد شاغل مرد <span class="agri1-unit">نفر</span>', view_num($row['t_mar']), true);
                view_field('تعداد شاغل زن <span class="agri1-unit">نفر</span>', view_num($row['t_zan']), true);
                view_field('مسئول فنی', view_h($v_m_fani));
                ?>
            </div>

            <h2 class="agri1-card-title is-later">وضعیت سموم و مواد ضدعفونی‌کننده</h2>
            <div class="agri1-table-wrap is-compact">
                <table class="agri1-table">
                    <thead>
                        <tr>
                            <th>ارزش مایع<br/>ریال</th>
                            <th>مایع<br/>لیتر</th>
                            <th>ارزش جامد<br/>ریال</th>
                            <th>جامد<br/>کیلوگرم</th>
                            <th>نوع</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo view_num($row['gar_ma']); ?></td>
                            <td><?php echo view_num($row['gar_m']); ?></td>
                            <td><?php echo view_num($row['gar_ja']); ?></td>
                            <td><?php echo view_num($row['gar_j']); ?></td>
                            <td>قارچ‌کش</td>
                        </tr>
                        <tr>
                            <td><?php echo view_num($row['hash_ma']); ?></td>
                            <td><?php echo view_num($row['hash_m']); ?></td>
                            <td><?php echo view_num($row['hash_ja']); ?></td>
                            <td><?php echo view_num($row['hash_j']); ?></td>
                            <td>حشره‌کش</td>
                        </tr>
                        <tr>
                            <td><?php echo view_num($row['zof_ma']); ?></td>
                            <td><?php echo view_num($row['zof_m']); ?></td>
                            <td><?php echo view_num($row['zof_ja']); ?></td>
                            <td><?php echo view_num($row['zof_j']); ?></td>
                            <td>ضدعفونی‌کننده</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 class="agri1-card-title is-later">میزان و ارزش کودهای مصرفی</h2>
            <p class="agri1-subhead" style="margin-top:0">کود حیوانی <span class="agri1-unit">تن</span></p>
            <?php
            view_kv_table(array(
                array('گاوی / گوسفندی', $row['kod_h1_m'], $row['kod_h1_a']),
                array('مرغی', $row['kod_h2_m'], $row['kod_h2_a']),
                array('سایر', $row['kod_h3_m'], $row['kod_h3_a'])
            ));
            ?>

            <p class="agri1-subhead">کود شیمیایی <span class="agri1-unit">کیلوگرم</span></p>
            <?php
            view_kv_table(array(
                array('فسفات', $row['kod_sh1_m'], $row['kod_sh1_a']),
                array('پتاس', $row['kod_sh2_m'], $row['kod_sh2_a']),
                array('سایر', $row['kod_sh3_m'], $row['kod_sh3_a'])
            ));
            ?>

            <p class="agri1-subhead">کود بیولوژیک <span class="agri1-unit">کیلوگرم</span></p>
            <?php
            view_kv_table(array(
                array('فسفات بارو', $row['kod_bio1_m'], $row['kod_bio1_a']),
                array('مایکوروت', $row['kod_bio2_m'], $row['kod_bio2_a']),
                array('سایر', $row['kod_bio3_m'], $row['kod_bio3_a'])
            ));
            ?>

            <h2 class="agri1-card-title is-later">وضعیت مصرف حامل‌های انرژی</h2>
            <div class="agri1-grid">
                <?php
                foreach ($energy as $item) {
                    view_field(view_h($item[0]) . ' — مقدار <span class="agri1-unit">' . view_h($item[1]) . '</span>', view_num($item[2]), true);
                    view_field(view_h($item[0]) . ' — ارزش <span class="agri1-unit">ریال</span>', view_num($item[3]), true);
                }
                ?>
            </div>

            <h2 class="agri1-card-title is-later">وضعیت تأمین نهاده تکثیری</h2>
            <div class="agri1-grid">
                <?php
                view_field('بذر مصرفی — مقدار <span class="agri1-unit">عدد/کیلوگرم</span>', view_num($row['bazr_m']), true);
                view_field('بذر مصرفی — ارزش <span class="agri1-unit">ریال</span>', view_num($row['bazr_a']), true);
                view_field('نشاء مصرفی — مقدار <span class="agri1-unit">عدد</span>', view_num($row['nesha_m']), true);
                view_field('نشاء مصرفی — ارزش <span class="agri1-unit">ریال</span>', view_num($row['nesha_a']), true);
                ?>
            </div>

            <h2 class="agri1-card-title is-later">شکارگرها و گرده‌افشان‌ها</h2>
            <div class="agri1-grid">
                <?php
                view_field('میزان استفاده از حشرات شکارگر <span class="agri1-unit">عدد</span>', view_num($row['t_hshekar']), true);
                view_field('میزان استفاده از زنبورهای گرده‌افشان <span class="agri1-unit">عدد</span>', view_num($row['t_zgard']), true);
                ?>
            </div>

            <?php if ($show_hydro) { ?>
            <h2 class="agri1-card-title is-later">سیستم کشت هیدروپونیک</h2>
            <div class="agri1-grid">
                <?php
                view_field('کوکوپیت <span class="agri1-unit">تن یا مترمکعب</span>', view_num($row['b_coco']), true);
                view_field('پیت ماس <span class="agri1-unit">تن یا مترمکعب</span>', view_num($row['b_mas']), true);
                view_field('پرلیت <span class="agri1-unit">تن یا مترمکعب</span>', view_num($row['b_per']), true);
                view_field('پالم پیت <span class="agri1-unit">تن یا مترمکعب</span>', view_num($row['b_pet']), true);
                view_field('سایر <span class="agri1-unit">تن یا مترمکعب</span>', view_num($row['b_say']), true);
                ?>
            </div>
            <?php } ?>

            <h2 class="agri1-card-title is-later">اطلاعات تولید محصول</h2>
            <?php if (!$products) { ?>
            <p class="agri1-note">اطلاعاتی یافت نشد</p>
            <?php } else { ?>
            <p class="agri1-table-hint">برای مشاهده همه ستون‌ها جدول را افقی بکشید.</p>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <thead>
                        <tr>
                            <th rowspan="2">میزان تولید<br/><?php echo view_h($unit); ?></th>
                            <?php if ($show_dates) { ?>
                            <th colspan="2">تاریخ برداشت</th>
                            <?php } ?>
                            <th rowspan="2">سطح زیر کشت<br/>مترمربع</th>
                            <?php if ($show_dates) { ?>
                            <th colspan="2">تاریخ کشت</th>
                            <?php } ?>
                            <th colspan="2">اطلاعات محصول</th>
                            <th rowspan="2">ردیف</th>
                        </tr>
                        <tr>
                            <?php if ($show_dates) { ?>
                            <th>پایان</th>
                            <th>شروع</th>
                            <th>پایان</th>
                            <th>شروع</th>
                            <?php } ?>
                            <th>نام محصول</th>
                            <th>نام گروه</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 1;
                    foreach ($products as $row_prod) {
                        $group_cod = $row_prod['group_cod'];
                        $mah_cod = $row_prod['mah_cod'];
                        $group_name = isset($groups[$group_cod]) ? $groups[$group_cod] : '—';
                        $product_name = isset($mah_names[$mah_cod]) ? $mah_names[$mah_cod] : '—';
                    ?>
                        <tr>
                            <td><?php echo view_num($row_prod['m_tol']); ?></td>
                            <?php if ($show_dates) { ?>
                            <td><?php echo view_h(view_map($month_map, $row_prod['date_2_bar'])); ?></td>
                            <td><?php echo view_h(view_map($month_map, $row_prod['date_1_bar'])); ?></td>
                            <?php } ?>
                            <td><?php echo view_num($row_prod['s_kesh']); ?></td>
                            <?php if ($show_dates) { ?>
                            <td><?php echo view_h(view_map($month_map, $row_prod['date_2_kesh'])); ?></td>
                            <td><?php echo view_h(view_map($month_map, $row_prod['date_1_kesh'])); ?></td>
                            <?php } ?>
                            <td><?php echo view_h($product_name); ?></td>
                            <td><?php echo view_h($group_name); ?></td>
                            <td><?php echo (int) $n; ?></td>
                        </tr>
                    <?php
                        $n++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>

            <form id="agri-back-form" method="post" action="liste_Greenhous_prod.php">
                <input type="hidden" name="id" value="<?php echo (int) $unit_id; ?>"/>
                <input type="hidden" name="bah_cod_m" value="<?php echo view_h($bah_cod_m); ?>"/>
            </form>

            <div class="agri1-actions agri1-back">
                <button type="button" class="agri1-btn agri1-btn-ghost" id="agri-close">
                    <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M18 6L6 18"></path>
                        <path d="M6 6l12 12"></path>
                    </svg>
                    بستن پنجره
                </button>
            </div>
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
            var btn = document.getElementById('agri-close');
            var form = document.getElementById('agri-back-form');
            if (!btn) return;
            btn.addEventListener('click', function () {
                if (window.opener && !window.opener.closed) {
                    window.close();
                    return;
                }
                if (form) {
                    form.submit();
                    return;
                }
                window.history.back();
            });
        })();
    </script>
</body>
</html>
