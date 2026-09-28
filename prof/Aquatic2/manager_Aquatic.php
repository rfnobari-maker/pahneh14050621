<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../login/config.php');

$bah_cod_m = isset($_POST['bah_cod_m']) ? trim($_POST['bah_cod_m']) : '';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 1;
if ($id < 1) {
    $id = 1;
}
$limit = 10;
$start = ($id - 1) * $limit;
$query1 = '';
$total = 0;
$found = 0;
$stmt = null;
$list_rows = array();

function agri2_h($v)
{
    if (!isset($v)) {
        return '';
    }
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function manager_aquatic_ops_svg($name)
{
    $d = array(
        'view' => '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>',
        'edit' => '<path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>',
        'del' => '<path d="M4 7h16"/><path d="M9 7V4h6v3"/><path d="M6 7l1 14h10l1-14"/><path d="M10 11v6"/><path d="M14 11v6"/>',
        'lock' => '<rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/>'
    );
    $p = isset($d[$name]) ? $d[$name] : '';
    return '<svg class="agri1-icon" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true">' . $p . '</svg>';
}

function manager_aquatic_filter_hiddens($bah_cod_m)
{
    echo '<input type="hidden" name="action" value="1" />';
    echo '<input type="hidden" name="bah_cod_m" value="' . agri2_h($bah_cod_m) . '" />';
}

function manager_aquatic_label($map, $code)
{
    $key = (string) $code;
    return isset($map[$key]) ? $map[$key] : '';
}

$no_fa_labels = array(
    '1' => 'تکثیر',
    '2' => 'پرورش',
    '3' => 'تکثیر و پرورش'
);
$g_tol_labels = array(
    '1' => 'مجتمع',
    '2' => 'منفرد',
    '3' => 'مداربسته',
    '4' => 'دو منظوره',
    '5' => 'شالیزار',
    '6' => 'قفش',
    '7' => 'پن',
    '8' => 'آب بندان',
    '9' => 'منابع آبی',
    '10' => 'سایر موارد'
);
$m_ab_labels = array(
    '1' => 'رودخانه',
    '2' => 'چاه',
    '3' => 'قنات و چشمه',
    '4' => 'آب بندان',
    '5' => 'خور و دریا',
    '6' => 'دریاچه',
    '7' => 'سایرمنابع'
);

$page_title = (isset($title) && $title !== '') ? $title : 'مدیریت اطلاعات مزارع تکثیر و پرورش آبزیان';
$pahneh_crumb_title = 'مدیریت مزرعه تکثیر و پرورش';

if (isset($_POST['action'])) {
    $sql = "SELECT u.id_ostan, u.id_city, u.sal, u.mor_cod_m, u.no_fa, u.g_tol, u.m_ab, u.bah_cod_m,
                   u.add_abadi, u.add_city, u.id, u.no_mal, u.num_bah, u.m_zamin,
                   bah.name AS bah_name, bah.Last_name AS bah_last,
                   cityname.city,
                   list_abadi.abadi,
                   list_city.shahr
            FROM (
                SELECT id_ostan, id_city, sal, mor_cod_m, no_fa, g_tol, m_ab, bah_cod_m,
                       add_abadi, add_city, id, no_mal, num_bah, m_zamin
                FROM Aquatic
                WHERE bah_cod_m = :bah_cod_m
                UNION ALL
                SELECT id_ostan, id_city, sal, mor_cod_m, no_fa, g_tol, m_ab, bah_cod_m,
                       add_abadi, add_city, id, no_mal, num_bah, m_zamin
                FROM Aquatic2
                WHERE bah_cod_m = :bah_cod_m
            ) u
            LEFT JOIN bah ON u.bah_cod_m = bah.bah_cod_m AND u.num_bah = bah.num_bah
            LEFT JOIN cityname ON cityname.id_city = u.id_city AND cityname.id_ostan = u.id_ostan
            LEFT JOIN list_abadi ON list_abadi.add_abadi = u.add_abadi AND list_abadi.mor_cod_m = u.mor_cod_m
            LEFT JOIN list_city ON list_city.add_city = u.add_city AND list_city.mor_cod_m = u.mor_cod_m
            ORDER BY u.sal DESC, u.id ASC
            LIMIT $start, $limit";
    $query1 = "SELECT COUNT(*) FROM (
                SELECT id FROM Aquatic WHERE bah_cod_m = :bah_cod_m
                UNION ALL
                SELECT id FROM Aquatic2 WHERE bah_cod_m = :bah_cod_m
            ) c";
    $params = array(':bah_cod_m' => $bah_cod_m);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $list_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $found = count($list_rows);
}
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
            --color-destructive: #DC2626; --color-on-destructive: #FFFFFF; --color-ring: #15803D;
            --color-warning-bg: #FEF2F2; --space-1: 8px; --space-2: 16px; --space-3: 24px; --space-4: 32px;
            --radius: 12px; --duration: 200ms; --shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
            --touch: 44px; --font: myfont, Tahoma, "Segoe UI", sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-padding-top: 96px; -webkit-text-size-adjust: 100%; text-size-adjust: 100%; }
        body.agri1-body { margin: 0; background: var(--color-background); color: var(--color-foreground); font-family: var(--font); font-size: 16px; line-height: 1.6; }
        .agri1-skip { position: absolute; right: -999px; top: 8px; z-index: 90; background: var(--color-primary); color: var(--color-on-primary); padding: 8px 16px; border-radius: 8px; }
        .agri1-skip:focus { right: 8px; }
        .agri1-main { width: 100%; margin: 0 auto; padding: var(--space-3) 8px var(--space-4); }
        .agri1-title { margin: 0 0 var(--space-2); color: var(--color-foreground); font-size: clamp(1.35rem, 2.4vw, 1.85rem); line-height: 1.4; text-wrap: balance; }
        .agri1-hero { margin-bottom: var(--space-3); }
        .agri1-card { background: var(--color-card); color: var(--color-card-foreground); border: 1px solid var(--color-border); border-radius: 16px; box-shadow: var(--shadow); padding: var(--space-3); margin-bottom: var(--space-3); }
        .agri1-card-title { margin: 0 0 14px; padding-bottom: 8px; border-bottom: 1px solid var(--color-border); font-size: 1rem; }
        .agri1-card-results { padding: 12px 8px; }
        .agri1-card-search { max-width: 720px; margin-right: auto; margin-left: auto; padding: 16px; }
        .agri1-card-search .agri1-card-title { margin-bottom: 10px; padding-bottom: 6px; }
        .agri1-card-search .agri1-grid { gap: 10px 12px; }
        .agri1-card-search .agri1-label { margin-bottom: 4px; font-size: 0.875rem; }
        .agri1-page .agri1-card-search .agri1-form input[type="text"] { min-height: 36px; padding: 6px 10px; }
        .agri1-icon { flex: 0 0 auto; width: 24px; height: 24px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .agri1-label { display: block; margin-bottom: 6px; font-weight: 700; color: var(--color-foreground); }
        .agri1-note { margin: 0 0 var(--space-3); padding: 12px 14px; border-radius: 10px; background: #EFF6FF; border: 1px solid #BFDBFE; color: #1D4ED8; }
        .agri1-page .agri1-form input[type="text"] {
            width: 100%; min-height: var(--touch); padding: 10px 12px; border: 1px solid #64748B; border-radius: 10px;
            background: var(--color-card); color: var(--color-foreground); font-size: 16px; font-family: inherit;
        }
        .agri1-page .agri1-form input[type="text"]:focus { border-color: var(--color-ring); box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25); outline: none; }
        .agri1-page .agri1-form #bah_cod_m { text-align: center; letter-spacing: 0.08em; }
        .agri1-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; direction: ltr; }
        .agri1-grid .agri1-field { direction: rtl; text-align: right; }
        .agri1-actions { display: flex; flex-wrap: wrap; justify-content: center; gap: 12px; margin-top: var(--space-2); }
        .agri1-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: var(--touch); min-width: var(--touch); padding: 10px 20px; border: 0; border-radius: 12px; cursor: pointer; font-size: 16px; font-weight: 700; font-family: inherit; text-decoration: none; touch-action: manipulation; }
        .agri1-btn:focus-visible { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-btn[aria-busy="true"] { opacity: 0.85; }
        .agri1-btn-primary { background: var(--color-primary); color: var(--color-on-primary); box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25); }
        .agri1-btn-primary:hover { background: var(--color-secondary); }
        .agri1-btn-ghost { background: transparent; color: var(--color-foreground); border: 1px solid var(--color-border); }
        .agri1-btn-ghost:hover { background: var(--color-muted); }
        .agri1-back { margin-top: var(--space-3); }
        .agri1-overlay { display: none; position: fixed; inset: 0; z-index: 80; align-items: center; justify-content: center; background: rgba(15, 23, 42, 0.55); }
        .agri1-overlay.is-open { display: flex !important; }
        #agri1-overlay { z-index: 90; }
        .agri1-overlay-panel { display: flex; flex-direction: column; align-items: center; gap: 12px; min-width: 220px; padding: 24px; border-radius: 16px; background: var(--color-card); }
        .agri1-spinner { width: 40px; height: 40px; border: 3px solid var(--color-border); border-top-color: var(--color-primary); border-radius: 50%; animation: agri1-spin 0.8s linear infinite; }
        @keyframes agri1-spin { to { transform: rotate(360deg); } }
        .agri1-results-toolbar { display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; gap: 8px; margin: 0 0 8px; direction: ltr; }
        .agri1-results-toolbar .agri1-col-picker { justify-self: start; }
        .agri1-col-picker { position: relative; }
        .agri1-col-picker-btn { min-height: var(--touch); padding: 8px 14px; font-size: 0.875rem; }
        .agri1-col-panel { display: none; position: absolute; top: calc(100% + 4px); left: 0; z-index: 30; min-width: 260px; max-height: min(420px, 70vh); overflow-y: auto; padding: 10px 8px 12px; border: 1px solid var(--color-border); border-radius: 12px; background: var(--color-card); box-shadow: var(--shadow); direction: rtl; text-align: right; }
        .agri1-col-picker.is-open .agri1-col-panel { display: block; }
        .agri1-col-panel-head { display: flex; align-items: center; justify-content: space-between; gap: 8px; padding: 4px 8px 8px; border-bottom: 1px solid var(--color-border); margin-bottom: 6px; }
        .agri1-col-reset { background: none; border: 0; color: var(--color-primary); cursor: pointer; font: inherit; font-weight: 700; font-size: 0.8125rem; min-height: var(--touch); padding: 0 8px; }
        .agri1-col-list { list-style: none; margin: 0; padding: 0; }
        .agri1-col-list label { display: flex; align-items: center; gap: 10px; min-height: var(--touch); padding: 0 8px; border-radius: 8px; cursor: pointer; font-size: 0.875rem; }
        .agri1-col-list input[type="checkbox"] { width: 18px; height: 18px; accent-color: var(--color-primary); }
        .agri1-table .is-col-hidden { display: none !important; }
        .agri1-table-hint { display: none; margin: 0 0 8px; color: var(--color-muted-foreground); font-size: 0.8125rem; }
        .agri1-table-wrap { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; border: 1px solid var(--color-border); border-radius: 12px; background: var(--color-card); direction: ltr; }
        .agri1-table { width: 100%; min-width: 1100px; border-collapse: collapse; table-layout: fixed; direction: ltr; }
        .agri1-table th { background: var(--color-primary); color: var(--color-on-primary); padding: 5px 3px; font-weight: 700; text-align: center; line-height: 1.3; font-size: 11px; border: 1px solid #FFFFFF; white-space: nowrap; }
        .agri1-table td { padding: 4px 3px; text-align: center; vertical-align: middle; border-bottom: 1px solid var(--color-border); color: var(--color-foreground); font-family: myfont2, yekan, Tahoma, "Segoe UI", sans-serif; font-weight: 400; font-size: 16px; white-space: normal; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; }
        .agri1-table tbody tr:nth-child(even) td { background: var(--color-background); }
        .agri1-table tbody tr:hover td { background: #ECFDF3; }
        .agri1-table th.agri1-ops-col, .agri1-table td.agri1-ops { white-space: nowrap; }
        .agri1-table .agri1-name-col { white-space: normal; overflow: visible; text-overflow: clip; overflow-wrap: break-word; word-break: break-word; }
        .agri1-ops-bar { display: inline-flex; align-items: center; justify-content: center; gap: 4px; }
        .agri1-ops-bar form { display: inline-flex; margin: 0; }
        .agri1-ops-btn, .agri1-ops-lock { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; padding: 0; border: 1px solid var(--color-border); border-radius: 8px; background: var(--color-card); color: var(--color-foreground); cursor: pointer; }
        .agri1-ops-btn .agri1-icon, .agri1-ops-lock .agri1-icon { width: 16px; height: 16px; }
        .agri1-ops-btn:hover { background: var(--color-background); border-color: var(--color-primary); color: var(--color-primary); }
        .agri1-ops-btn:focus-visible { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-ops-btn-del { color: var(--color-destructive); border-color: #FECACA; }
        .agri1-ops-btn-del:hover { background: var(--color-warning-bg); border-color: var(--color-destructive); color: var(--color-destructive); }
        .agri1-ops-lock { cursor: default; color: var(--color-muted-foreground); background: var(--color-muted); }
        .agri1-pager { margin-top: var(--space-2); padding: 10px 12px; border: 1px solid var(--color-border); border-radius: 12px; background: var(--color-card); text-align: center; }
        .agri1-pager-list { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 4px; list-style: none; margin: 0; padding: 0; }
        .agri1-pager-list form { display: inline; }
        .agri1-pager-btn { display: inline-flex; align-items: center; justify-content: center; min-height: 32px; min-width: 32px; padding: 4px 10px; border: 1px solid var(--color-border); border-radius: 8px; background: var(--color-card); color: var(--color-foreground); cursor: pointer; font-family: inherit; font-size: 13px; font-weight: 700; }
        .agri1-pager-btn:hover { background: var(--color-muted); }
        .agri1-pager-btn.is-current, .agri1-pager-btn.is-nav { background: var(--color-primary); color: var(--color-on-primary); border-color: var(--color-primary); }
        .agri1-pager-btn.is-num { font-family: Tahoma, "Segoe UI", sans-serif; font-weight: 600; direction: ltr; }
        .agri1-pager-ellipsis { color: var(--color-muted-foreground); padding: 4px 6px; font-family: Tahoma, "Segoe UI", sans-serif; font-size: 13px; }
        .agri1-pager-jump { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 6px; margin-top: 8px; }
        .agri1-pager-jump form { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 6px; }
        .agri1-pager-jump input[type="text"] { width: 64px; min-height: 32px; padding: 4px 8px; border: 1px solid #64748B; border-radius: 8px; font-size: 13px; font-family: Tahoma, "Segoe UI", sans-serif; text-align: center; direction: ltr; }
        @media (max-width: 1100px) { .agri1-table-hint { display: block; } }
        @media (max-width: 640px) { .agri1-grid { grid-template-columns: 1fr; } .agri1-table th { font-size: 13px; } }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.01ms !important; animation-iteration-count: 1 !important; transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#reg-form">رفتن به فرم جستجو</a>
    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>
    <?php include(__DIR__ . '/../../chrome.php'); ?>
    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title">مدیریت اطلاعات مزارع تکثیر و پرورش آبزیان</h1>
        </header>
        <section class="agri1-card agri1-card-search" aria-labelledby="agri1-search-title">
            <form id="reg-form" name="form1" class="agri1-form" method="post" action="#1" novalidate>
                <h2 class="agri1-card-title" id="agri1-search-title">جستجو</h2>
                <div class="agri1-grid">
                    <div class="agri1-field">
                        <label class="agri1-label" for="bah_cod_m">کد ملی بهره‌بردار / مدیر عامل</label>
                        <input name="bah_cod_m" type="text" id="bah_cod_m" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    </div>
                    <div class="agri1-field"></div>
                </div>
                <div class="agri1-actions">
                    <button type="submit" name="action" id="action_lise" value="جستجو " class="agri1-btn agri1-btn-primary">جستجو</button>
                </div>
            </form>
        </section>
        <a name="1" id="1"></a>
<?php if (isset($_POST['action'])) { ?>
<?php     if ($found > 0) { ?>
        <section class="agri1-card agri1-card-results" aria-label="نتایج جستجو">
            <div class="agri1-results-toolbar">
                <div class="agri1-col-picker" id="agri1-col-picker">
                    <button type="button" class="agri1-btn agri1-btn-ghost agri1-col-picker-btn" id="agri1-col-picker-btn" aria-expanded="false" aria-controls="agri1-col-panel">
                        <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"></rect><path d="M9 4v16"></path><path d="M15 4v16"></path></svg>
                        <span class="agri1-col-picker-label">ستون‌ها</span>
                    </button>
                    <div id="agri1-col-panel" class="agri1-col-panel" role="group" aria-labelledby="agri1-col-panel-title">
                        <div class="agri1-col-panel-head">
                            <strong id="agri1-col-panel-title">نمایش ستون‌ها</strong>
                            <button type="button" class="agri1-col-reset" id="agri1-col-reset">نمایش همه</button>
                        </div>
                        <ul class="agri1-col-list">
                            <li><label><input type="checkbox" data-col-toggle="ops" checked/> عملیات</label></li>
                            <li><label><input type="checkbox" data-col-toggle="m_zamin" checked/> مساحت زمین</label></li>
                            <li><label><input type="checkbox" data-col-toggle="m_ab" checked/> منبع تامین آب</label></li>
                            <li><label><input type="checkbox" data-col-toggle="g_tol" checked/> قالب تولید</label></li>
                            <li><label><input type="checkbox" data-col-toggle="no_fa" checked/> نوع فعالیت</label></li>
                            <li><label><input type="checkbox" data-col-toggle="sal" checked/> سال</label></li>
                            <li><label><input type="checkbox" data-col-toggle="bah_cod_m" checked/> کد ملی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="name" checked/> نام و نام خانوادگی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="abadi" checked/> شهر/آبادی</label></li>
                            <li><label><input type="checkbox" data-col-toggle="city" checked/> شهرستان</label></li>
                            <li><label><input type="checkbox" data-col-toggle="row" checked/> ردیف</label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="agri1-table-hint">برای مشاهده همه ستون‌ها جدول را افقی بکشید.</p>
            <div class="agri1-table-wrap">
                <table class="agri1-table">
                    <colgroup>
                        <col data-col="ops" style="width:10%"/>
                        <col data-col="m_zamin" style="width:8%"/>
                        <col data-col="m_ab" style="width:10%"/>
                        <col data-col="g_tol" style="width:9%"/>
                        <col data-col="no_fa" style="width:9%"/>
                        <col data-col="sal" style="width:6%"/>
                        <col data-col="bah_cod_m" style="width:10%"/>
                        <col data-col="name" style="width:12%"/>
                        <col data-col="abadi" style="width:10%"/>
                        <col data-col="city" style="width:9%"/>
                        <col data-col="row" style="width:7%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="agri1-ops-col" data-col="ops" rowspan="2">عملیات</th>
                            <th data-col="m_zamin" rowspan="2">مساحت زمین<br/>متر مربع</th>
                            <th data-col="m_ab" rowspan="2">منبع تامین آب</th>
                            <th data-col="g_tol" rowspan="2">قالب تولید</th>
                            <th data-col="no_fa" rowspan="2">نوع فعالیت</th>
                            <th data-col="sal" rowspan="2">سال</th>
                            <th data-col-group="bah" colspan="2">مشخصات بهره‌بردار</th>
                            <th data-col-group="loc" colspan="2">موقعیت بهره‌برداری</th>
                            <th data-col="row" rowspan="2">ردیف</th>
                        </tr>
                        <tr>
                            <th data-col="bah_cod_m">کد ملی</th>
                            <th data-col="name">نام و نام خانوادگی</th>
                            <th data-col="abadi">شهر/آبادی</th>
                            <th data-col="city">شهرستان</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
        $r = $start + 1;
        foreach ($list_rows as $row) {
            $v_no_fa = manager_aquatic_label($no_fa_labels, isset($row['no_fa']) ? $row['no_fa'] : '');
            $v_g_tol = manager_aquatic_label($g_tol_labels, isset($row['g_tol']) ? $row['g_tol'] : '');
            $v_m_ab = manager_aquatic_label($m_ab_labels, isset($row['m_ab']) ? $row['m_ab'] : '');
            $bah_full = trim((isset($row['bah_last']) ? $row['bah_last'] : '') . ' ' . (isset($row['bah_name']) ? $row['bah_name'] : ''));
            $place = trim((isset($row['abadi']) ? $row['abadi'] : '') . ' ' . (isset($row['shahr']) ? $row['shahr'] : ''));
            $is_owner = ((string) $row['mor_cod_m'] === (string) $login_session);
            $is_1404 = ((string) $row['sal'] === '1404');
            $view_action = ($is_owner && $is_1404) ? 'Aquatic_view2.php' : 'Aquatic_view.php';
?>
                        <tr>
                            <td class="agri1-ops" data-col="ops">
                                <div class="agri1-ops-bar">
<?php if ($is_owner) { ?>
<?php     if ($is_1404) { ?>
                                    <form action="del_Aquatic.php" method="post">
                                        <input type="hidden" name="m_page" value="manager_Aquatic.php"/>
                                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                        <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                        <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>"/>
                                        <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                        <input type="hidden" name="sal" value="<?php echo agri2_h($row['sal']); ?>"/>
                                        <button type="submit" class="agri1-ops-btn agri1-ops-btn-del" title="حذف اطلاعات مزرعه" aria-label="حذف اطلاعات مزرعه" onclick="return confirm('از حذف اطلاعات این مزرعه مطمئن هستید ؟ ')"><?php echo manager_aquatic_ops_svg('del'); ?></button>
                                    </form>
                                    <form action="Aquatic_edit.php" method="post">
                                        <input type="hidden" name="m_page" value="manager_Aquatic.php"/>
                                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                        <input type="hidden" name="sal" value="<?php echo agri2_h($row['sal']); ?>"/>
                                        <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                        <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>"/>
                                        <input type="hidden" name="no_fa" value="<?php echo agri2_h($row['no_fa']); ?>"/>
                                        <input type="hidden" name="no_mal" value="<?php echo agri2_h($row['no_mal']); ?>"/>
                                        <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                        <input type="hidden" name="num_bah" value="<?php echo agri2_h($row['num_bah']); ?>"/>
                                        <button type="submit" class="agri1-ops-btn" title="ویرایش اطلاعات بهره‌برداری" aria-label="ویرایش اطلاعات بهره‌برداری"><?php echo manager_aquatic_ops_svg('edit'); ?></button>
                                    </form>
<?php     } ?>
                                    <form action="<?php echo agri2_h($view_action); ?>" method="post">
                                        <input type="hidden" name="m_page" value="manager_Aquatic.php"/>
                                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                        <input type="hidden" name="sal" value="<?php echo agri2_h($row['sal']); ?>"/>
                                        <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                        <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>"/>
                                        <input type="hidden" name="no_fa" value="<?php echo agri2_h($row['no_fa']); ?>"/>
                                        <input type="hidden" name="no_mal" value="<?php echo agri2_h($row['no_mal']); ?>"/>
                                        <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                        <input type="hidden" name="num_bah" value="<?php echo agri2_h($row['num_bah']); ?>"/>
                                        <button type="submit" class="agri1-ops-btn" title="نمایش اطلاعات بهره‌برداری" aria-label="نمایش اطلاعات بهره‌برداری"><?php echo manager_aquatic_ops_svg('view'); ?></button>
                                    </form>
<?php } else { ?>
                                    <form action="Aquatic_view.php" method="post">
                                        <input type="hidden" name="m_page" value="manager_Aquatic.php"/>
                                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($row['bah_cod_m']); ?>"/>
                                        <input type="hidden" name="sal" value="<?php echo agri2_h($row['sal']); ?>"/>
                                        <input type="hidden" name="add_abadi" value="<?php echo agri2_h($row['add_abadi']); ?>"/>
                                        <input type="hidden" name="add_city" value="<?php echo agri2_h($row['add_city']); ?>"/>
                                        <input type="hidden" name="no_mal" value="<?php echo agri2_h($row['no_mal']); ?>"/>
                                        <input type="hidden" name="id" value="<?php echo agri2_h($row['id']); ?>"/>
                                        <input type="hidden" name="num_bah" value="<?php echo agri2_h($row['num_bah']); ?>"/>
                                        <button type="submit" class="agri1-ops-btn" title="نمایش اطلاعات بهره‌برداری" aria-label="نمایش اطلاعات بهره‌برداری"><?php echo manager_aquatic_ops_svg('view'); ?></button>
                                    </form>
                                    <span class="agri1-ops-lock" title="ویرایش و حذف اطلاعات مقدور نمیباشد" aria-label="ویرایش و حذف اطلاعات مقدور نمیباشد"><?php echo manager_aquatic_ops_svg('lock'); ?></span>
<?php } ?>
                                </div>
                            </td>
                            <td data-col="m_zamin"><?php echo agri2_h($row['m_zamin']); ?></td>
                            <td data-col="m_ab"><?php echo agri2_h($v_m_ab); ?></td>
                            <td data-col="g_tol"><?php echo agri2_h($v_g_tol); ?></td>
                            <td data-col="no_fa"><?php echo agri2_h($v_no_fa); ?></td>
                            <td data-col="sal"><?php echo agri2_h($row['sal']); ?></td>
                            <td data-col="bah_cod_m" dir="ltr"><?php echo agri2_h($row['bah_cod_m']); ?></td>
                            <td class="agri1-name-col" data-col="name"><?php echo agri2_h($bah_full); ?></td>
                            <td class="agri1-name-col" data-col="abadi"><?php echo agri2_h($place); ?></td>
                            <td class="agri1-name-col" data-col="city"><?php echo agri2_h(isset($row['city']) ? $row['city'] : ''); ?></td>
                            <td data-col="row"><?php echo (int) $r; ?></td>
                        </tr>
<?php
            $r++;
        }
?>
                    </tbody>
                </table>
            </div>
        </section>
<?php
    } else {
        echo '<p class="agri1-note">اطلاعاتی یافت نشد</p>';
    }
}

if ($query1 !== '') {
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute(array(':bah_cod_m' => $bah_cod_m));
    $rows = (int) $stmt1->fetchColumn();
    $total = $limit > 0 ? (int) ceil($rows / $limit) : 0;
    if ($rows > 0) {
        $visible_pages = 3;
        $start_page = max(1, $id - $visible_pages);
        $end_page = min($total, $id + $visible_pages);
        $show_first = ($start_page > 1);
        $show_last = ($end_page < $total);
?>
        <nav class="agri1-pager" aria-label="صفحه‌بندی">
            <ul class="agri1-pager-list">
                <?php if ($id > 1) { ?>
                <li>
                    <form action="manager_Aquatic.php?id=<?php echo (int) $id - 1; ?>#1" method="post">
                        <?php manager_aquatic_filter_hiddens($bah_cod_m); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">&laquo; قبلی</button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($show_first) { ?>
                <li>
                    <form action="manager_Aquatic.php?id=1#1" method="post">
                        <?php manager_aquatic_filter_hiddens($bah_cod_m); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en">1</button>
                    </form>
                </li>
                    <?php if ($start_page > 2) { ?><li><span class="agri1-pager-ellipsis">...</span></li><?php } ?>
                <?php } ?>
                <?php for ($i = $start_page; $i <= $end_page; $i++) { ?>
                <li>
                    <?php if ($i == $id) { ?>
                    <span class="agri1-pager-btn is-current is-num" lang="en"><?php echo (int) $i; ?></span>
                    <?php } else { ?>
                    <form action="manager_Aquatic.php?id=<?php echo (int) $i; ?>#1" method="post">
                        <?php manager_aquatic_filter_hiddens($bah_cod_m); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int) $i; ?></button>
                    </form>
                    <?php } ?>
                </li>
                <?php } ?>
                <?php if ($show_last) { ?>
                    <?php if ($end_page < $total - 1) { ?><li><span class="agri1-pager-ellipsis">...</span></li><?php } ?>
                <li>
                    <form action="manager_Aquatic.php?id=<?php echo (int) $total; ?>#1" method="post">
                        <?php manager_aquatic_filter_hiddens($bah_cod_m); ?>
                        <button type="submit" class="agri1-pager-btn is-num" lang="en"><?php echo (int) $total; ?></button>
                    </form>
                </li>
                <?php } ?>
                <?php if ($id != $total && $total > 0) { ?>
                <li>
                    <form action="manager_Aquatic.php?id=<?php echo (int) $id + 1; ?>#1" method="post">
                        <?php manager_aquatic_filter_hiddens($bah_cod_m); ?>
                        <button type="submit" class="agri1-pager-btn is-nav">بعدی &raquo;</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <div class="agri1-pager-jump">
                <form id="pageJumpForm" action="manager_Aquatic.php" method="post">
                    <?php manager_aquatic_filter_hiddens($bah_cod_m); ?>
                    <span>به صفحه</span>
                    <input type="text" inputmode="numeric" lang="en" dir="ltr" id="pageIdInput" name="page_input" value="<?php echo (int) $id; ?>"/>
                    <button type="submit" class="agri1-pager-btn is-nav">برو</button>
                </form>
            </div>
        </nav>
        <script>
        (function () {
            var input = document.getElementById('pageIdInput');
            var form = document.getElementById('pageJumpForm');
            if (!input || !form) return;
            function toLatinDigits(v) {
                var fa = '۰۱۲۳۴۵۶۷۸۹'; var ar = '٠١٢٣٤٥٦٧٨٩';
                return String(v).replace(/[۰-۹٠-٩]/g, function (ch) {
                    var i = fa.indexOf(ch); if (i > -1) return String(i);
                    i = ar.indexOf(ch); return i > -1 ? String(i) : ch;
                }).replace(/[^\d]/g, '');
            }
            input.addEventListener('input', function () { this.value = toLatinDigits(this.value); });
            form.addEventListener('submit', function (e) {
                var pageId = parseInt(toLatinDigits(input.value), 10);
                if (!isNaN(pageId) && pageId >= 1 && pageId <= <?php echo (int) $total; ?>) {
                    this.action = 'manager_Aquatic.php?id=' + pageId + '#1';
                } else {
                    e.preventDefault();
                }
            });
        })();
        </script>
<?php
    }
}
?>
        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="index.php">
                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
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
            var form = document.getElementById('reg-form');
            var overlay = document.getElementById('agri1-overlay');
            var submitBtn = document.getElementById('action_lise');
            if (!form) return;
            form.addEventListener('submit', function () {
                if (overlay) overlay.className = 'agri1-overlay is-open';
                if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
            });
        })();
        (function () {
            var picker = document.getElementById('agri1-col-picker');
            var btn = document.getElementById('agri1-col-picker-btn');
            var panel = document.getElementById('agri1-col-panel');
            var table = document.querySelector('.agri1-table');
            if (!picker || !btn || !panel || !table) return;
            var KEY = 'manager_Aquatic_hidden_cols';
            var GROUPS = { bah: ['bah_cod_m', 'name'], loc: ['abadi', 'city'] };
            function readHidden() {
                try {
                    var raw = localStorage.getItem(KEY);
                    var arr = raw ? JSON.parse(raw) : [];
                    if (!Array.isArray(arr)) return {};
                    var map = {};
                    for (var i = 0; i < arr.length; i++) map[arr[i]] = true;
                    return map;
                } catch (e) { return {}; }
            }
            function writeHidden(map) {
                var arr = [];
                for (var k in map) { if (Object.prototype.hasOwnProperty.call(map, k) && map[k]) arr.push(k); }
                try { localStorage.setItem(KEY, JSON.stringify(arr)); } catch (e) {}
            }
            function allIds() {
                var nodes = table.querySelectorAll('thead [data-col]');
                var ids = []; var seen = {};
                for (var i = 0; i < nodes.length; i++) {
                    var id = nodes[i].getAttribute('data-col');
                    if (id && !seen[id]) { seen[id] = true; ids.push(id); }
                }
                return ids;
            }
            function visibleCount(map) {
                var ids = allIds(); var n = 0;
                for (var i = 0; i < ids.length; i++) { if (!map[ids[i]]) n++; }
                return n;
            }
            function applyGroup(map, groupId, kids) {
                var groupTh = table.querySelector('[data-col-group="' + groupId + '"]');
                if (!groupTh) return 0;
                var vis = 0;
                for (var j = 0; j < kids.length; j++) { if (!map[kids[j]]) vis++; }
                if (vis === 0) groupTh.classList.add('is-col-hidden');
                else { groupTh.classList.remove('is-col-hidden'); groupTh.colSpan = vis; }
                return vis;
            }
            function apply(map) {
                var cells = table.querySelectorAll('[data-col]');
                for (var i = 0; i < cells.length; i++) {
                    var id = cells[i].getAttribute('data-col');
                    if (map[id]) cells[i].classList.add('is-col-hidden');
                    else cells[i].classList.remove('is-col-hidden');
                }
                var visSecond = 0;
                for (var g in GROUPS) {
                    if (Object.prototype.hasOwnProperty.call(GROUPS, g)) visSecond += applyGroup(map, g, GROUPS[g]);
                }
                var groupRow = table.querySelector('thead tr:nth-child(2)');
                if (groupRow) {
                    if (visSecond === 0) groupRow.classList.add('is-col-hidden');
                    else groupRow.classList.remove('is-col-hidden');
                }
                var boxes = panel.querySelectorAll('input[type="checkbox"][data-col-toggle]');
                for (var b = 0; b < boxes.length; b++) boxes[b].checked = !map[boxes[b].getAttribute('data-col-toggle')];
                var hiddenCount = 0; var ids = allIds();
                for (var n = 0; n < ids.length; n++) { if (map[ids[n]]) hiddenCount++; }
                var label = btn.querySelector('.agri1-col-picker-label');
                if (label) label.textContent = hiddenCount > 0 ? ('ستون‌ها (' + hiddenCount + ' پنهان)') : 'ستون‌ها';
            }
            var hidden = readHidden();
            apply(hidden);
            function openPanel() { picker.classList.add('is-open'); btn.setAttribute('aria-expanded', 'true'); }
            function closePanel() { picker.classList.remove('is-open'); btn.setAttribute('aria-expanded', 'false'); }
            btn.addEventListener('click', function (e) { e.stopPropagation(); if (picker.classList.contains('is-open')) closePanel(); else openPanel(); });
            panel.addEventListener('click', function (e) { e.stopPropagation(); });
            document.addEventListener('click', closePanel);
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && picker.classList.contains('is-open')) { closePanel(); btn.focus(); } });
            panel.addEventListener('change', function (e) {
                var t = e.target;
                if (!t || t.getAttribute('data-col-toggle') == null) return;
                var id = t.getAttribute('data-col-toggle');
                if (!t.checked) {
                    hidden[id] = true;
                    if (visibleCount(hidden) < 1) { delete hidden[id]; t.checked = true; return; }
                } else { delete hidden[id]; }
                writeHidden(hidden); apply(hidden);
            });
            var resetBtn = document.getElementById('agri1-col-reset');
            if (resetBtn) resetBtn.addEventListener('click', function () { hidden = {}; writeHidden(hidden); apply(hidden); });
        })();
    </script>
</body>
</html>
<?php if (isset($_POST['com_alert'])) alert($_POST['com_alert']); ?>
