<?php
include("../../lock_p1.php");
include('../../event.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$searched = isset($_POST['action']);
$rows = array();
$found = 0;

if ($searched) {
    $query = "SELECT num_bah,id,mor_cod_m,no_mal,bah_cod_m,add_abadi,add_city,sh_gat,z_sal,no_kesh,m_zamin,id_ostan,
id_city,t_mah,check_cod from `Agri1403_1404` where  bah_cod_m = :bah_cod_m  and mor_cod_m = :mor_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m, ':mor_cod_m' => $login_session));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $found = count($rows);
}

$mal_labels = array(
    '1' => 'سند ششدانگ',
    '2' => 'سند مشاعی',
    '3' => 'اصلاحات اراضی',
    '4' => 'موقوفه',
    '5' => 'واگذاری',
    '6' => 'قولنامه',
    '7' => 'اجاره',
    '8' => 'سایر'
);
$kesh_labels = array('1' => 'آبی', '2' => 'دیم');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo agri2_h($title); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
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
            width: min(1180px, 100%);
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
            margin-bottom: var(--space-3);
        }
        .agri1-card-title {
            margin: 0 0 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--color-border);
            font-size: 1rem;
        }
        .agri1-alert {
            display: flex;
            gap: 12px;
            align-items: flex-start;
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
        .agri1-hint {
            margin: 0 0 12px;
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
        }
        .agri1-field { margin-top: 0; }
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
            font-family: inherit;
            box-shadow: none;
            transition: border-color var(--duration) ease, box-shadow var(--duration) ease;
        }
        .agri1-page .agri1-form #bah_cod_m {
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
        .agri1-note {
            margin: 0 0 12px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            color: #1D4ED8;
        }
        .agri1-note a { color: #1D4ED8; font-weight: 700; }
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
        .agri1-btn-accent {
            background: var(--color-accent);
            color: var(--color-on-accent);
        }
        .agri1-btn-accent:hover { background: #854D0E; }
        .agri1-btn-ghost {
            background: transparent;
            color: var(--color-foreground);
            border: 1px solid var(--color-border);
        }
        .agri1-btn-ghost:hover { background: var(--color-muted); }
        .agri1-back { margin-top: var(--space-3); text-align: center; }
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
            max-width: 420px;
            padding: 24px;
            border-radius: 16px;
            background: var(--color-card);
            color: var(--color-foreground);
            text-align: center;
        }
        .agri1-overlay-panel p { margin: 0; }
        .agri1-confirm-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
            margin-top: 8px;
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
            border: 1px solid var(--color-border);
            border-radius: 12px;
            background: var(--color-card);
            direction: ltr;
        }
        .agri1-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
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
            vertical-align: middle;
            border-bottom: 1px solid var(--color-border);
            color: var(--color-foreground);
        }
        .agri1-table tbody tr:nth-child(even) td { background: var(--color-background); }
        .agri1-table tbody tr:hover td { background: #ECFDF3; }
        .agri1-check {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-width: var(--touch);
            min-height: var(--touch);
            cursor: pointer;
        }
        .agri1-check input[type="checkbox"] {
            width: 20px;
            height: 20px;
            accent-color: var(--color-primary);
            cursor: pointer;
        }
        .agri1-check:focus-within {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
            border-radius: 8px;
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
    <a class="agri1-skip" href="#form1">رفتن به فرم جستجو</a>
    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>
    <div id="agri1-confirm" class="agri1-overlay" role="dialog" aria-modal="true" aria-labelledby="agri1-confirm-title" hidden>
        <div class="agri1-overlay-panel">
            <p id="agri1-confirm-title">از آماده‌سازی قطعه / قطعات انتخاب شده برای سال زراعی 1405-1404 مطمئن هستید؟</p>
            <div class="agri1-confirm-actions">
                <button type="button" class="agri1-btn agri1-btn-primary" id="agri1-confirm-ok">تأیید</button>
                <button type="button" class="agri1-btn agri1-btn-ghost" id="agri1-confirm-cancel">انصراف</button>
            </div>
        </div>
    </div>
    <?php include(__DIR__ . '/../../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="new-agri-title">آماده‌سازی اطلاعات پایه، سال زراعی 1405-1404</h1>
        </header>

        <section class="agri1-card" aria-labelledby="new-agri-title">
            <form id="form1" class="agri1-form" name="form1" method="post" action="#result" novalidate>
                <h2 class="agri1-card-title">جستجو</h2>
                <div id="search-alert" class="agri1-alert is-hidden" role="alert" tabindex="-1">
                    <svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 8v5"></path>
                        <path d="M12 16h.01"></path>
                    </svg>
                    <div>
                        <h2>لطفاً موارد زیر را تکمیل کنید</h2>
                        <ul>
                            <li><a href="#field-bah_cod_m">کد ملی بهره‌بردار را وارد کنید</a></li>
                        </ul>
                    </div>
                </div>
                <div class="agri1-field" id="field-bah_cod_m">
                    <label class="agri1-label" for="bah_cod_m">کد ملی بهره‌بردار / مدیر عامل</label>
                    <input type="text" name="bah_cod_m" id="bah_cod_m" dir="ltr" inputmode="numeric" autocomplete="off"
                           value="<?php echo agri2_h($bah_cod_m); ?>"
                           aria-describedby="hint-bah_cod_m error-bah_cod_m"/>
                    <p class="agri1-hint" id="hint-bah_cod_m">کد ملی ۱۰ رقمی را وارد کنید، سپس جستجو را بزنید.</p>
                    <p class="agri1-error is-hidden" id="error-bah_cod_m">کد ملی بهره‌بردار را وارد کنید</p>
                </div>
                <p class="agri1-note">
                    <a href="../../login/help/New_Agri.pdf" target="_blank" rel="noopener">راهنمای استفاده</a>
                </p>
                <div class="agri1-actions">
                    <button type="submit" name="action" id="action" value="جستجو " class="agri1-btn agri1-btn-primary">جستجو</button>
                </div>
            </form>
        </section>

<?php if ($searched) { ?>
        <section class="agri1-card" aria-labelledby="result" id="result-card">
            <h2 class="agri1-card-title" id="result">قطعات سال زراعی 1404-1403</h2>
<?php if ($found > 0) { ?>
            <div id="bulk-alert" class="agri1-alert is-hidden" role="alert" tabindex="-1">
                <svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 8v5"></path>
                    <path d="M12 16h.01"></path>
                </svg>
                <div>
                    <h2>قطعه انتخاب نشده است</h2>
                    <p>حداقل باید یک قطعه انتخاب شود.</p>
                </div>
            </div>
            <form id="bulk_action_form" class="agri1-form" name="bulk_action_form" action="send_data1405.php" method="post" novalidate>
                <div class="agri1-table-wrap">
                    <table class="agri1-table">
                        <thead>
                            <tr>
                                <th rowspan="2">مساحت زمین<br/>هکتار</th>
                                <th rowspan="2">نوع کشت</th>
                                <th rowspan="2">نوع مالکیت</th>
                                <th rowspan="2">شماره قطعه</th>
                                <th rowspan="2">سال زراعی</th>
                                <th colspan="2">مشخصات بهره‌بردار</th>
                                <th colspan="2">موقعیت بهره‌برداری</th>
                                <th rowspan="2">ردیف</th>
                                <th rowspan="2">
                                    <label class="agri1-check" for="select_all">
                                        <input type="checkbox" name="select_all" id="select_all" value=""/>
                                        <span>انتخاب</span>
                                    </label>
                                </th>
                            </tr>
                            <tr>
                                <th>کد ملی</th>
                                <th>نام و نام خانوادگی</th>
                                <th>شهر/آبادی</th>
                                <th>شهرستان</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
$r = 1;
foreach ($rows as $row) {
    $v_no_mal = isset($mal_labels[$row['no_mal']]) ? $mal_labels[$row['no_mal']] : '';
    $v_no_kesh = isset($kesh_labels[$row['no_kesh']]) ? $kesh_labels[$row['no_kesh']] : '';
    $place = abadi_name($row['add_abadi']) . shahr_name($row['add_city']);
    $check_id = 'plot-' . $row['id'];
?>
                            <tr>
                                <td><?php echo agri2_h($row['m_zamin']); ?></td>
                                <td><?php echo agri2_h($v_no_kesh); ?></td>
                                <td><?php echo agri2_h($v_no_mal); ?></td>
                                <td><?php echo agri2_h($row['sh_gat']); ?></td>
                                <td><?php echo agri2_h($row['z_sal']); ?></td>
                                <td dir="ltr"><?php echo agri2_h($row['bah_cod_m']); ?></td>
                                <td><?php echo agri2_h(str_replace('&nbsp;', ' ', bah_name2($row['bah_cod_m'], $row['num_bah']))); ?></td>
                                <td><?php echo agri2_h($place); ?></td>
                                <td><?php echo agri2_h(city_name1($row['id_city'], $row['id_ostan'])); ?></td>
                                <td><?php echo agri2_h($r); ?></td>
                                <td>
                                    <label class="agri1-check" for="<?php echo agri2_h($check_id); ?>">
                                        <input type="checkbox" name="checked_id[]" class="checkbox" id="<?php echo agri2_h($check_id); ?>"
                                               value="<?php echo agri2_h($row['id']); ?>"/>
                                        <span class="is-hidden">انتخاب قطعه <?php echo agri2_h($row['sh_gat']); ?></span>
                                    </label>
                                </td>
                            </tr>
<?php
    $r++;
}
?>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="mor_cod_m" value="<?php echo agri2_h($login_session); ?>"/>
                <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                <input type="hidden" name="Go_send_data" value="مایل به ایجاد اطلاعات فوق در سال زراعی 1405-1404 هستم"/>
                <div class="agri1-actions">
                    <button type="submit" id="send_data" class="agri1-btn agri1-btn-accent">
                        مایل به ایجاد اطلاعات فوق در سال زراعی 1405-1404 هستم
                    </button>
                </div>
            </form>
<?php } else { ?>
            <div class="agri1-alert" role="alert">
                <svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 8v5"></path>
                    <path d="M12 16h.01"></path>
                </svg>
                <p>اطلاعات زراعی بهره‌بردار در سال 1404-1403 یافت نشد.</p>
            </div>
<?php } ?>
        </section>
<?php } ?>

        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="index.php" title="برگشت به صفحه قبل">
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
            <td height="109" style="background: url('../../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../../footer.php'); ?>
            </td>
        </tr>
    </table>

    <script>
        (function () {
            var overlay = document.getElementById('agri1-overlay');
            var confirmBox = document.getElementById('agri1-confirm');
            var searchForm = document.getElementById('form1');
            var searchBtn = document.getElementById('action');
            var searchAlert = document.getElementById('search-alert');
            var searchInput = document.getElementById('bah_cod_m');
            var searchError = document.getElementById('error-bah_cod_m');
            var bulkForm = document.getElementById('bulk_action_form');
            var sendBtn = document.getElementById('send_data');
            var bulkAlert = document.getElementById('bulk-alert');
            var confirmOk = document.getElementById('agri1-confirm-ok');
            var confirmCancel = document.getElementById('agri1-confirm-cancel');
            var sending = false;

            function showOverlay() {
                if (overlay) overlay.className = 'agri1-overlay is-open';
            }

            function openConfirm() {
                if (!confirmBox) return;
                confirmBox.hidden = false;
                confirmBox.className = 'agri1-overlay is-open';
                if (confirmOk) {
                    try { confirmOk.focus(); } catch (e) {}
                }
            }

            function closeConfirm() {
                if (!confirmBox) return;
                confirmBox.className = 'agri1-overlay';
                confirmBox.hidden = true;
            }

            if (searchForm) {
                searchForm.addEventListener('submit', function (e) {
                    if (sending) {
                        e.preventDefault();
                        return;
                    }
                    var value = searchInput ? String(searchInput.value || '').replace(/\s+/g, '') : '';
                    if (value === '') {
                        e.preventDefault();
                        if (searchInput) {
                            searchInput.setAttribute('aria-invalid', 'true');
                            searchInput.setAttribute('aria-describedby', 'hint-bah_cod_m error-bah_cod_m');
                        }
                        if (searchError) searchError.className = 'agri1-error';
                        if (searchAlert) {
                            searchAlert.className = 'agri1-alert';
                            try { searchAlert.focus(); } catch (err) {}
                        }
                        return;
                    }
                    sending = true;
                    showOverlay();
                    if (searchBtn) searchBtn.setAttribute('aria-busy', 'true');
                });
            }

            $('#select_all').on('click', function () {
                $('.checkbox').prop('checked', this.checked);
            });
            $('.checkbox').on('click', function () {
                $('#select_all').prop('checked', $('.checkbox:checked').length === $('.checkbox').length);
            });

            if (bulkForm) {
                bulkForm.addEventListener('submit', function (e) {
                    if (sending) {
                        e.preventDefault();
                        return;
                    }
                    e.preventDefault();
                    if ($('input[name="checked_id[]"]:checked').length === 0) {
                        if (bulkAlert) {
                            bulkAlert.className = 'agri1-alert';
                            try { bulkAlert.focus(); } catch (err) {}
                        }
                        return;
                    }
                    if (bulkAlert) bulkAlert.className = 'agri1-alert is-hidden';
                    openConfirm();
                });
            }

            if (confirmOk) {
                confirmOk.addEventListener('click', function () {
                    if (sending || !bulkForm) return;
                    sending = true;
                    closeConfirm();
                    showOverlay();
                    if (sendBtn) sendBtn.setAttribute('aria-busy', 'true');
                    bulkForm.submit();
                });
            }
            if (confirmCancel) {
                confirmCancel.addEventListener('click', function () {
                    closeConfirm();
                    if (sendBtn) {
                        try { sendBtn.focus(); } catch (e) {}
                    }
                });
            }
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && confirmBox && confirmBox.className.indexOf('is-open') !== -1) {
                    closeConfirm();
                    if (sendBtn) {
                        try { sendBtn.focus(); } catch (err) {}
                    }
                }
            });
        })();
    </script>
</body>
</html>
<?php if (isset($_POST['com_alert'])) alert($_POST['com_alert']); ?>
