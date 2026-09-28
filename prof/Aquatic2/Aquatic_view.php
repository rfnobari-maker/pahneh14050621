<?php
include('../../lock_p1.php');
include('../../event.php');
include_once('../../login/config.php');

function view_h($v)
{
    if (!isset($v)) {
        return '';
    }
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function view_place($v)
{
    return view_h(str_replace('&nbsp;', ' ', $v));
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

function aquatic_view_go_home()
{
    echo '<form name="myform" class="myform" method="post" action="Aquatic.php"></form>';
    echo '<script type="text/javascript">document.myform.submit();</script>';
    exit;
}

function aquatic_view_return_page($m_page)
{
    $base = basename((string) $m_page);
    if (!preg_match('/^[A-Za-z0-9_]+\.php$/', $base)) {
        return 'Aquatic.php';
    }
    return $base;
}

$m_page = aquatic_view_return_page(isset($_POST['m_page']) ? $_POST['m_page'] : 'Aquatic.php');
$h_add_abadi = isset($_POST['h_add_abadi']) ? $_POST['h_add_abadi'] : '';
$h_add_city = isset($_POST['h_add_city']) ? $_POST['h_add_city'] : '';
$h_no_fa = isset($_POST['h_no_fa']) ? $_POST['h_no_fa'] : '';
$h_no_mal = isset($_POST['h_no_mal']) ? $_POST['h_no_mal'] : '';
$h_sal = isset($_POST['h_sal']) ? $_POST['h_sal'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? trim($_POST['bah_cod_m'] . '') : '';
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$sal = isset($_POST['sal']) ? $_POST['sal'] : '';
$num_bah_post = isset($_POST['num_bah']) ? $_POST['num_bah'] : '1';

if ($bah_cod_m === '' || $id < 1) {
    aquatic_view_go_home();
}

$query = "SELECT id, bah_cod_m, num_bah, sal, id_ostan, id_city, id_mar, add_abadi, add_city,
                 m_zamin, no_mal, lng, lat, m_cod_m, m_vaz_sok, no_fa, g_tol,
                 pt_no, pt_date, pb_no, pb_date, m_ab, unit_name,
                 tak1, tak2, tak3, tak4, tak5, par1, par2, par3, par4
          FROM Aquatic
          WHERE bah_cod_m = :bah_cod_m AND sal = :sal AND id = :id";
$stmt = $dbh->prepare($query);
$stmt->execute(array(
    ':bah_cod_m' => $bah_cod_m,
    ':sal' => $sal,
    ':id' => $id,
));

if ($stmt->rowCount() == 0) {
    aquatic_view_go_home();
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$bah_cod_m = $row['bah_cod_m'];
$num_bah = $row['num_bah'];
if ($num_bah == '') {
    $num_bah = ($num_bah_post !== '') ? $num_bah_post : '1';
}
$id = (int) $row['id'];
$sal = $row['sal'];
$id_ostan2 = $row['id_ostan'];
$id_city2 = $row['id_city'];
$id_mar = $row['id_mar'];
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
$m_zamin = $row['m_zamin'];
$no_mal = $row['no_mal'];
$lng = $row['lng'];
$lat = $row['lat'];
$m_cod_m = $row['m_cod_m'];
$m_vaz_sok = $row['m_vaz_sok'];
$no_fa = $row['no_fa'];
$g_tol = $row['g_tol'];
$pt_no = $row['pt_no'];
$pt_date = $row['pt_date'];
$pb_no = $row['pb_no'];
$pb_date = $row['pb_date'];
$m_ab = $row['m_ab'];
$unit_name = $row['unit_name'];
$tak1 = $row['tak1'];
$tak2 = $row['tak2'];
$tak3 = $row['tak3'];
$tak4 = $row['tak4'];
$tak5 = $row['tak5'];
$par1 = $row['par1'];
$par2 = $row['par2'];
$par3 = $row['par3'];
$par4 = $row['par4'];

$m_name = '';
$m_jens = '';
$m_last_name = '';
$m_fname = '';
$m_tel_m = '';
$m_addres = '';
$no_bah = '';
$co_name = '';

if ($no_mal != 7) {
    $query = "SELECT name, jens, last_name, fname, tel_m, no_bah, co_name
              FROM bah
              WHERE bah_cod_m = :bah_cod_m AND num_bah = :num_bah";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m, ':num_bah' => $num_bah));
    if ($stmt->rowCount() > 0) {
        $row_bah = $stmt->fetch(PDO::FETCH_ASSOC);
        $no_bah = $row_bah['no_bah'];
        $co_name = $row_bah['co_name'];
        $m_jens = $row_bah['jens'];
        $m_name = $row_bah['name'];
        $m_last_name = $row_bah['last_name'];
        $m_fname = ($no_bah == '2') ? '-' : $row_bah['fname'];
        $m_tel_m = $row_bah['tel_m'];
    }
} else {
    $query = "SELECT m_name, m_jens, m_last_name, m_fname, m_tel_m, m_addres
              FROM malek
              WHERE m_cod_m = :m_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':m_cod_m' => $m_cod_m));
    if ($stmt->rowCount() > 0) {
        $row_malek = $stmt->fetch(PDO::FETCH_ASSOC);
        $m_name = $row_malek['m_name'];
        $m_jens = $row_malek['m_jens'];
        $m_last_name = $row_malek['m_last_name'];
        $m_fname = $row_malek['m_fname'];
        $m_tel_m = $row_malek['m_tel_m'];
        $m_addres = $row_malek['m_addres'];
    }
}

if ($m_addres === '' && $m_cod_m !== '' && $m_cod_m !== null) {
    $query = "SELECT m_addres FROM malek WHERE m_cod_m = :m_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':m_cod_m' => $m_cod_m));
    if ($stmt->rowCount() > 0) {
        $row_addr = $stmt->fetch(PDO::FETCH_ASSOC);
        $m_addres = $row_addr['m_addres'];
    }
}

if ($no_mal != '7') {
    $m_cod_m = $bah_cod_m;
}

$v_no_fa = view_map(array(
    '1' => 'تکثیر',
    '2' => 'پرورش',
    '3' => 'تکثیر و پرورش',
), $no_fa);
$v_no_mal = view_map(array(
    '1' => 'سند ششدانگ',
    '2' => 'سند مشاعی',
    '3' => 'اصلاحات اراضی',
    '4' => 'موقوفه',
    '5' => 'واگذاری',
    '6' => 'قولنامه',
    '7' => 'اجاره',
    '8' => 'سایر',
), $no_mal);
$v_g_tol = view_map(array(
    '1' => 'مجتمع',
    '2' => 'منفرد',
    '3' => 'مداربسته',
    '4' => 'دو منظوره',
    '5' => 'شالیزار',
    '6' => 'قفش',
    '7' => 'پن',
    '8' => 'آب بندان',
    '9' => 'منابع آبی',
    '10' => 'سایر موارد',
), $g_tol);
$v_m_ab = view_map(array(
    '1' => 'رودخانه',
    '2' => 'چاه',
    '3' => 'قنات و چشمه',
    '4' => 'آب بندان',
    '5' => 'خور و دریا',
    '6' => 'دریاچه',
    '7' => 'سایرمنابع',
), $m_ab);
$v_jens = view_map(array('1' => 'مرد', '2' => 'زن'), $m_jens);
$v_vaz_sok = view_map(array('1' => 'ساکن', '2' => 'غیرساکن'), $m_vaz_sok);

$show_tak = ($no_fa == '1' || $no_fa == '3');
$show_par = ($no_fa == '2' || $no_fa == '3');

$place_abadi = ($add_abadi != '' && $add_abadi != '-' && $add_abadi != '0') ? abadi_name($add_abadi) : '';
$place_shahr = ($add_city != '' && $add_city != '-' && $add_city != '0') ? shahr_name($add_city) : '';
$place_name = trim(($place_abadi ? $place_abadi : '') . ' ' . ($place_shahr ? $place_shahr : ''));
if ($place_name === '') {
    $place_name = '—';
}

$page_title = isset($title) ? $title : 'مشاهده اطلاعات واحد';
$pahneh_crumb_title = 'مشاهده مزرعه آبزیان';
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
            scroll-padding-top: 96px;
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

        .agri1-card {
            background: var(--color-card);
            color: var(--color-card-foreground);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: var(--space-3);
            margin-bottom: var(--space-2);
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

        .agri1-hint {
            margin: 8px 0 0;
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
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

        .agri1-info-block {
            white-space: pre-wrap;
        }

        .agri1-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .agri1-grid-span { grid-column: 1 / -1; }

        .agri1-note {
            margin-bottom: 12px;
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
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 12px;
            direction: ltr;
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

        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
            .agri1-table th { font-size: 13px; white-space: normal; }
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

    <?php include(__DIR__ . '/../../chrome.php'); ?>

    <main class="agri1-main" id="agri-view">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri-view-title">مشاهده اطلاعات واحد</h1>
        </header>

        <section class="agri1-card" aria-labelledby="agri-loc-title">
            <div><?php sar_data2($bah_cod_m, $num_bah); ?></div>
            <h2 class="agri1-card-title" id="agri-loc-title">موقعیت بهره‌برداری</h2>
            <div class="agri1-grid">
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">استان</span>
                    <div class="agri1-info"><?php echo view_place(ostan_name($id_ostan2)); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">شهرستان</span>
                    <div class="agri1-info"><?php echo view_place(city_name1($id_city2, $id_ostan2)); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">مرکز جهاد کشاورزی</span>
                    <div class="agri1-info"><?php echo view_place(mar_name($id_mar)); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">آبادی / شهر</span>
                    <div class="agri1-info"><?php echo view_place($place_name); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">نوع فعالیت</span>
                    <div class="agri1-info"><?php echo view_h($v_no_fa); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">نوع مالکیت</span>
                    <div class="agri1-info"><?php echo view_h($v_no_mal); ?></div>
                </div>
            </div>
        </section>

        <section class="agri1-card" aria-labelledby="agri-land-title">
            <h2 class="agri1-card-title" id="agri-land-title">اطلاعات زمین</h2>
            <div class="agri1-grid">
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">طول جغرافیایی X</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($lng); ?></div>
                    <p class="agri1-hint">مثال: 46.212486</p>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">عرض جغرافیایی Y</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($lat); ?></div>
                    <p class="agri1-hint">مثال: 37.010521</p>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">مساحت مفید <span class="agri1-unit">مترمربع</span></span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_num($m_zamin); ?></div>
                </div>
            </div>
        </section>

        <section class="agri1-card" aria-labelledby="agri-owner-title">
            <h2 class="agri1-card-title" id="agri-owner-title">اطلاعات مالک</h2>
            <?php if ($no_mal != 7) { ?>
            <p class="agri1-note">اطلاعات بهره‌بردار بعنوان مالک ثبت شده است</p>
            <?php } ?>
            <div class="agri1-grid">
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">کد ملی مالک</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($m_cod_m); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">جنسیت</span>
                    <div class="agri1-info"><?php echo view_h($v_jens); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">نام</span>
                    <div class="agri1-info"><?php echo view_h($m_name); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">نام خانوادگی</span>
                    <div class="agri1-info"><?php echo view_h($m_last_name); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label"><?php echo ($no_bah == '2') ? 'نام شرکت' : 'نام پدر'; ?></span>
                    <div class="agri1-info"><?php echo view_h(($no_bah == '2') ? $co_name : $m_fname); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">تلفن همراه</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($m_tel_m); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">وضعیت سکونت</span>
                    <div class="agri1-info"><?php echo view_h($v_vaz_sok); ?></div>
                </div>
                <div class="agri1-field agri1-grid-span" style="margin-top:0">
                    <span class="agri1-label">آدرس محل سکونت</span>
                    <div class="agri1-info agri1-info-block"><?php echo view_h($m_addres); ?></div>
                </div>
            </div>
        </section>

        <section class="agri1-card" aria-labelledby="agri-unit-title">
            <h2 class="agri1-card-title" id="agri-unit-title">اطلاعات واحد</h2>
            <div class="agri1-grid">
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">قالب تولید</span>
                    <div class="agri1-info"><?php echo view_h($v_g_tol); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">منبع تامین آب</span>
                    <div class="agri1-info"><?php echo view_h($v_m_ab); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">شماره پروانه تاسیس</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($pt_no); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">تاریخ پروانه تاسیس</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($pt_date); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">شماره پروانه بهره برداری</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($pb_no); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">تاریخ پروانه بهره برداری</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($pb_date); ?></div>
                </div>
                <div class="agri1-field agri1-grid-span" style="margin-top:0">
                    <span class="agri1-label">نام مجتمع</span>
                    <div class="agri1-info"><?php echo view_h($unit_name); ?></div>
                    <p class="agri1-hint">در صورت واقع شدن در مجتمع شیلاتی</p>
                </div>
            </div>
        </section>

        <section class="agri1-card" aria-labelledby="agri-prod-title">
            <h2 class="agri1-card-title" id="agri-prod-title">اطلاعات تولید</h2>
            <div class="agri1-grid">
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">سال</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($sal); ?></div>
                </div>
            </div>

            <?php if ($show_tak) { ?>
            <p class="agri1-hint">تکثیر — واحد: هزار قطعه</p>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <thead>
                        <tr>
                            <th>ماهیان زینتی</th>
                            <th>میگوی آب شور و شیرین و شاه میگو</th>
                            <th>قزل آلا</th>
                            <th>کپور ماهیان</th>
                            <th>ماهیان خاویاری</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo view_num($tak5); ?></td>
                            <td><?php echo view_num($tak4); ?></td>
                            <td><?php echo view_num($tak3); ?></td>
                            <td><?php echo view_num($tak2); ?></td>
                            <td><?php echo view_num($tak1); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php } ?>

            <?php if ($show_par) { ?>
            <p class="agri1-hint">پرورش — واحد: تن</p>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <thead>
                        <tr>
                            <th>میگوی آب شور و شیرین و شاه میگو</th>
                            <th>قزل آلا</th>
                            <th>کپور ماهیان</th>
                            <th>ماهیان خاویاری</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo view_num($par4); ?></td>
                            <td><?php echo view_num($par3); ?></td>
                            <td><?php echo view_num($par2); ?></td>
                            <td><?php echo view_num($par1); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php } ?>
        </section>

        <form action="<?php echo view_h($m_page); ?>" method="post" id="form1" name="form1">
            <input type="hidden" name="action" value="1"/>
            <input type="hidden" name="bah_cod_m" value="<?php echo view_h($bah_cod_m); ?>"/>
            <input type="hidden" name="add_abadi" value="<?php echo view_h($h_add_abadi); ?>"/>
            <input type="hidden" name="add_city" value="<?php echo view_h($h_add_city); ?>"/>
            <input type="hidden" name="no_fa" value="<?php echo view_h($h_no_fa); ?>"/>
            <input type="hidden" name="no_mal" value="<?php echo view_h($h_no_mal); ?>"/>
            <input type="hidden" name="sal" value="<?php echo view_h($h_sal); ?>"/>
            <div class="agri1-actions agri1-back">
                <button type="submit" name="action11" value="انصراف" class="agri1-btn agri1-btn-ghost" id="submit">
                    <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M5 12h14"></path>
                        <path d="M12 5l7 7-7 7"></path>
                    </svg>
                    انصراف
                </button>
            </div>
        </form>
    </main>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td height="109" style="background: url('../../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../../footer.php'); ?>
            </td>
        </tr>
    </table>
</body>
</html>
