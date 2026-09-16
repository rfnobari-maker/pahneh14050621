<?php
include("../../lock_p1.php");
include('../../event_new.php');
include('../../date_con.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

function view_h($v)
{
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function view_map($map, $code)
{
    if (isset($map[$code]) && $code !== '' && $code !== null) {
        return $map[$code];
    }
    return '—';
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $z_sal = $_POST['z_sal'];
    $id_page = isset($_POST['id_page']) ? (int)$_POST['id_page'] : 1;
    if ($id_page < 1) { $id_page = 1; }

    $Agri_table = 'Agri' . str_replace('-', '_', $z_sal);
    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

    include('../../login/config.php');

    $query = "SELECT * FROM `$Agri_table` WHERE id = :id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id' => $id));

    if ($stmt->rowCount() == 0) {
        echo '<form name="myform" method="post" action="Agri1.php"></form>';
        echo '<script type="text/javascript">document.myform.submit();</script>';
        exit;
    }

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $bah_cod_m = $row['bah_cod_m'];
    $num_bah = $row['num_bah'];
    $sh_gat = $row['sh_gat'];
    $z_sal = $row['z_sal'];
    $t_mah = $row['t_mah'];
    $no_mal = $row['no_mal'];
    $no_kesh = $row['no_kesh'];
    $id_ostan1 = $row["id_ostan"];
    $id_city1 = $row["id_city"];
    $id_mar1 = $row["id_mar"];
    $add_abadi = $row["add_abadi"];
    $add_city = $row["add_city"];
    $lng = $row['lng'];
    $lat = $row['lat'];
    $m_zamin = $row['m_zamin'];
    $m_cod_m = $row['m_cod_m'];
    $m_ab = $row['m_ab'];
    $md_ab = $row['md_ab'];
    $h_ab = $row['h_ab'];
    $no_sab = $row['no_sab'];
    $no_ab = $row['no_ab'];
    $es = $row['es'];
    $s_ayesh = $row['s_ayesh'];
    $m_vaz_sok = $row['m_vaz_sok'];

    $v_no_kesh = view_map(array('1' => 'آبی', '2' => 'دیم'), $no_kesh);
    $v_no_mal = view_map(array(
        '1' => 'سند ششدانگ',
        '2' => 'سند مشاعی',
        '3' => 'اصلاحات اراضی',
        '4' => 'موقوفه',
        '5' => 'واگذاری',
        '6' => 'قولنامه',
        '7' => 'اجاره',
        '8' => 'سایر'
    ), $no_mal);

    $query = "SELECT * FROM malek WHERE m_cod_m = :m_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':m_cod_m' => $m_cod_m));

    $m_name = '';
    $m_jens = '';
    $m_last_name = '';
    $m_fname = '';
    $m_tel_m = '';

    if ($stmt->rowCount() > 0) {
        $row_malek = $stmt->fetch(PDO::FETCH_ASSOC);
        $m_name = $row_malek['m_name'];
        $m_jens = $row_malek['m_jens'];
        $m_last_name = $row_malek['m_last_name'];
        $m_fname = $row_malek['m_fname'];
        $m_tel_m = $row_malek['m_tel_m'];
    }

    if ($no_mal != '7') {
        $m_cod_m = $bah_cod_m;
    }

    $v_jens = view_map(array('1' => 'مرد', '2' => 'زن'), $m_jens);
    $v_vaz_sok = view_map(array('1' => 'ساکن', '2' => 'غیرساکن'), $m_vaz_sok);
    $v_m_ab = view_map(array(
        '1' => 'چشمه', '2' => 'قنات', '3' => 'رودخانه', '4' => 'سد',
        '5' => 'چاه سطحی', '6' => 'چاه عمیق', '7' => 'چاه نیمه عمیق',
        '8' => 'زهکش', '9' => 'پساب', '10' => 'آب بندان', '11' => 'سایر'
    ), $m_ab);
    $v_no_sab = view_map(array(
        '1' => 'پروانه بهره برداری', '2' => 'مجوز آب', '3' => 'عرفی', '4' => 'سایر'
    ), $no_sab);
    $v_es = view_map(array(
        '1' => 'ندارد', '2' => 'دارد / جهت ذخیره آب', '3' => 'دارد - دو منظوره'
    ), $es);
    $v_no_ab = view_map(array(
        '1' => 'جوی و پشته', '2' => 'نواری', '3' => 'غرقابی', '4' => 'تشتکی',
        '5' => 'تحت فشار قطره ای', '6' => 'تحت فشار بارانی', '7' => 'سایر'
    ), $no_ab);
    $yn = array('1' => 'بلی', '2' => 'خیر');

    $groups = array();
    $qry = "SELECT DISTINCT group_cod, group_name FROM `product_z`";
    $stmt_g = $dbh->prepare($qry);
    $stmt_g->execute();
    foreach ($stmt_g as $grp) {
        $groups[$grp['group_cod']] = $grp['group_name'];
    }

    $products = array();
    $query = "SELECT * FROM `$Agri_prod_table` WHERE Agri_id = :Agri_id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':Agri_id' => $id));
    $row_count = $stmt->rowCount();
    $num2_t_mah = $t_mah;
    if ($row_count == $num2_t_mah && $num2_t_mah > 0) {
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo view_h($title); ?></title>
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
        }

        .agri1-info-ltr {
            direction: ltr;
            text-align: center;
            letter-spacing: 0.08em;
        }

        .agri1-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

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
        }
        .agri1-overlay.is-open { display: flex !important; }

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

        .agri1-table-wrap {
            width: 100%;
            overflow-x: auto;
            margin-top: var(--space-2);
            border: 1px solid var(--color-border);
            border-radius: 12px;
            background: var(--color-card);
            direction: ltr;
        }

        .agri1-table {
            width: 100%;
            min-width: 720px;
            border-collapse: collapse;
            font-size: 0.875rem;
            direction: ltr;
        }
        .agri1-table th {
            background: var(--color-primary);
            color: var(--color-on-primary);
            padding: 10px 8px;
            font-weight: 700;
            text-align: center;
        }
        .agri1-table td {
            padding: 10px 8px;
            text-align: center;
            border-bottom: 1px solid var(--color-border);
            color: var(--color-foreground);
            min-height: var(--touch);
        }
        .agri1-table tbody tr:nth-child(even) td { background: var(--color-background); }

        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
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

    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>

    <?php include(__DIR__ . '/../../chrome.php'); ?>

    <main class="agri1-main" id="agri-view">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri-view-title">نمایش اطلاعات زراعی</h1>
        </header>

        <section class="agri1-card" aria-labelledby="agri-view-title">
            <div><?php sar_data2($bah_cod_m, $num_bah); ?></div>

            <h2 class="agri1-card-title">موقعیت بهره‌برداری</h2>
            <div class="agri1-grid">
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">استان</span>
                    <div class="agri1-info"><?php echo ostan_name($id_ostan1); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">شهرستان</span>
                    <div class="agri1-info"><?php echo city_name1($id_city1, $id_ostan1); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">مرکز جهاد کشاورزی</span>
                    <div class="agri1-info"><?php echo mar_name($id_mar1); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">آبادی / شهر</span>
                    <div class="agri1-info"><?php echo abadi_name($add_abadi); ?><?php echo shahr_name($add_city); ?></div>
                </div>
            </div>

            <h2 class="agri1-card-title" style="margin-top:24px">اطلاعات زمین</h2>
            <div class="agri1-grid">
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">نوع کشت</span>
                    <div class="agri1-info"><?php echo view_h($v_no_kesh); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">نوع مالکیت</span>
                    <div class="agri1-info"><?php echo view_h($v_no_mal); ?></div>
                </div>
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
                    <span class="agri1-label">مساحت زمین (هکتار)</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($m_zamin); ?></div>
                </div>
            </div>

            <h2 class="agri1-card-title" style="margin-top:24px">اطلاعات مالک</h2>
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
                    <span class="agri1-label">نام پدر</span>
                    <div class="agri1-info"><?php echo view_h($m_fname); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">تلفن همراه</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($m_tel_m); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">وضعیت سکونت مالک</span>
                    <div class="agri1-info"><?php echo view_h($v_vaz_sok); ?></div>
                </div>
            </div>

            <?php if ($no_kesh == '1') { ?>
            <h2 class="agri1-card-title" style="margin-top:24px">اطلاعات آب</h2>
            <div class="agri1-grid">
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">منبع آب</span>
                    <div class="agri1-info"><?php echo view_h($v_m_ab); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">مدار آبیاری (شبانه روز)</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($md_ab); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">حقابه (ساعت)</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($h_ab); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">نوع سند حقابه</span>
                    <div class="agri1-info"><?php echo view_h($v_no_sab); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">نحوه آبیاری</span>
                    <div class="agri1-info"><?php echo view_h($v_no_ab); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">وضعیت استخر</span>
                    <div class="agri1-info"><?php echo view_h($v_es); ?></div>
                </div>
            </div>
            <?php } ?>

            <h2 class="agri1-card-title" style="margin-top:24px">اطلاعات کاشت</h2>
            <div class="agri1-grid">
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">سال زراعی</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo view_h($z_sal); ?></div>
                </div>
                <div class="agri1-field" style="margin-top:0">
                    <span class="agri1-label">سطح آیش (هکتار)</span>
                    <div class="agri1-info agri1-info-ltr"><?php echo ($s_ayesh * 1); ?></div>
                </div>
            </div>

            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <thead>
                        <tr>
                            <th rowspan="2">محصول بیمه شده؟</th>
                            <th rowspan="2">خسارت</th>
                            <th colspan="2">میزان تولید<br/>تن</th>
                            <th colspan="2">سطح برداشت<br/>هکتار</th>
                            <th colspan="2">سطح زیر کشت<br/>هکتار</th>
                            <th colspan="2">اطلاعات محصول</th>
                            <th rowspan="2">ردیف</th>
                        </tr>
                        <tr>
                            <th>قطعی</th>
                            <th>پیش بینی</th>
                            <th>دوم</th>
                            <th>اول</th>
                            <th>دوم</th>
                            <th>اول</th>
                            <th>نام</th>
                            <th>گروه</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 1;
                    foreach ($products as $row_prod) {
                        $group_cod = $row_prod['cod_qroup'];
                        $group_name = isset($groups[$group_cod]) ? $groups[$group_cod] : '—';
                    ?>
                        <tr>
                            <td><?php echo view_h(view_map($yn, $row_prod['mah_bem'])); ?></td>
                            <td><?php echo view_h(view_map($yn, $row_prod['mah_kh'])); ?></td>
                            <td><?php echo ($row_prod['mah_tol'] * 1); ?></td>
                            <td><?php echo ($row_prod['mah_tolp'] * 1); ?></td>
                            <td><?php echo ($row_prod['s_bar_b'] * 1); ?></td>
                            <td><?php echo ($row_prod['s_bar_a'] * 1); ?></td>
                            <td><?php echo ($row_prod['zer_kesht_b'] * 1); ?></td>
                            <td><?php echo ($row_prod['zer_kesht_a'] * 1); ?></td>
                            <td><?php echo mah_name($row_prod['cod_mah']); ?></td>
                            <td><?php echo view_h($group_name); ?></td>
                            <td><?php echo $n; ?></td>
                        </tr>
                    <?php
                        $n++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <form action="liste_Agri.php?id=<?php echo $id_page . '#1'; ?>" method="post" id="form1" name="form1" class="agri1-form">
                <input type="hidden" name="action_lise" value="1"/>
                <input type="hidden" name="back_p" value="1"/>
                <div class="agri1-actions">
                    <button type="submit" name="action" value="بازگشت" class="agri1-btn agri1-btn-ghost" id="submit">
                        <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M5 12h14"></path>
                            <path d="M12 5l7 7-7 7"></path>
                        </svg>
                        بازگشت
                    </button>
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
            var form = document.getElementById('form1');
            var overlay = document.getElementById('agri1-overlay');
            var submitBtn = document.getElementById('submit');
            var sending = false;
            if (!form) return;
            form.addEventListener('submit', function (e) {
                if (sending) {
                    e.preventDefault();
                    return;
                }
                sending = true;
                if (overlay) overlay.className = 'agri1-overlay is-open';
                if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
            });
        })();
    </script>
</body>
</html>
<?php
} else {
?>
<form name="myform" class="myform" method="post" action="Agri1.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
