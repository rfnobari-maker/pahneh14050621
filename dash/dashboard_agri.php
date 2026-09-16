<?php
/**
 * داشبورد زراعت — لایهٔ دوم خانه
 */
require_once dirname(__FILE__) . '/auth.php';
require_once dirname(__FILE__) . '/lib.php';
require_once dirname(__FILE__) . '/lib_agri.php';
require_once dirname(__FILE__) . '/account.php';

$dash_root = '../';
$dash_api = 'api_agri.php';

dash_filter_prg(array(
    'year' => 'year',
    'id_ostan' => 'id_ostan',
    'id_city' => 'id_city',
    'id_mar' => 'id_mar',
    'group_cod' => 'agri_group_cod',
    'product_cod' => 'agri_product_cod',
    'water' => 'agri_water',
));
$dash_boot = dash_filter_session_get();
$boot_year = isset($dash_boot['year']) ? (int) $dash_boot['year'] : 0;
$boot_ostan = isset($dash_boot['id_ostan']) ? trim((string) $dash_boot['id_ostan']) : '';
$boot_city = isset($dash_boot['id_city']) ? trim((string) $dash_boot['id_city']) : '';
$boot_mar = isset($dash_boot['id_mar']) ? trim((string) $dash_boot['id_mar']) : '';
dash_clamp_geo($boot_ostan, $boot_city, $boot_mar);
$boot_group = isset($dash_boot['agri_group_cod']) ? trim((string) $dash_boot['agri_group_cod']) : '';
$boot_prod = isset($dash_boot['agri_product_cod']) ? trim((string) $dash_boot['agri_product_cod']) : '';
$boot_water = isset($dash_boot['agri_water']) ? trim((string) $dash_boot['agri_water']) : 'all';

header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

$dash_years_html = array();
if (isset($dbh) && function_exists('dash_rows')) {
    $yrows = dash_rows($dbh, 'SELECT sal FROM b_sal ORDER BY sal DESC', array());
    foreach ($yrows as $yr) {
        if (preg_match('/((?:13|14)\d{2})/', $yr['sal'], $m)) {
            $yi = (int) $m[1];
            if (!in_array($yi, $dash_years_html, true)) {
                $dash_years_html[] = $yi;
            }
        }
    }
}
if (!$dash_years_html) {
    $dash_years_html = array(1404);
}
if ($boot_year < 1300) {
    $boot_year = $dash_years_html[0];
}

$dash_fa_map = array(
    '0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴',
    '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹',
);
$dash_year_opts = '';
foreach ($dash_years_html as $yi) {
    $yi = (int) $yi;
    $sel = ($yi === (int) $boot_year) ? ' selected' : '';
    $dash_year_opts .= '<option value="' . $yi . '"' . $sel . '>' . strtr((string) $yi, $dash_fa_map) . '</option>';
}

function dash_agri_home_href($year, $id_ostan, $id_city, $id_mar)
{
    return 'index.php';
}

$homeHref = dash_agri_home_href($boot_year, $boot_ostan, $boot_city, $boot_mar);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد زراعت</title>
    <link rel="shortcut icon" href="<?php echo dash_h($dash_root); ?>files/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo dash_h($dash_root); ?>inc/leaflet.css">
    <style>
        @font-face { font-family: YekanBakh; src: url("<?php echo dash_h($dash_root); ?>assets/fonts/Yekan-Bakh-Fa-En-04-Regular.woff") format("woff"); font-weight: 400; font-display: swap; }
        @font-face { font-family: YekanBakh; src: url("<?php echo dash_h($dash_root); ?>assets/fonts/Yekan-Bakh-Fa-En-05-Medium.woff") format("woff"); font-weight: 500; font-display: swap; }
        @font-face { font-family: YekanBakh; src: url("<?php echo dash_h($dash_root); ?>assets/fonts/Yekan-Bakh-Fa-En-06-Bold.woff") format("woff"); font-weight: 700; font-display: swap; }
        @font-face { font-family: YekanBakh; src: url("<?php echo dash_h($dash_root); ?>assets/fonts/Yekan-Bakh-Fa-En-07-Heavy.woff") format("woff"); font-weight: 800; font-display: swap; }
        :root {
            --ink: #06140C;
            --forest: #0C2418;
            --canopy: #163524;
            --leaf: #1F6B45;
            --gold: #C9A227;
            --gold-soft: #E8D48B;
            --cream: #F6F1E7;
            --paper: #FFFCF6;
            --text: #14221A;
            --muted: #4A5A51;
            --line: #DDD3BE;
            --danger: #B42318;
            --danger-bg: #FDECEC;
            --ring: #C9A227;
            --touch: 48px;
            --radius: 28px;
            --ease: cubic-bezier(.22, 1, .36, 1);
        }
        html { scroll-padding-top: 8px; -webkit-text-size-adjust: 100%; text-size-adjust: 100%; }
        * { box-sizing: border-box; }
        body.dash-body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(50% 40% at 80% 0%, rgba(201, 162, 39, 0.14), transparent 55%),
                radial-gradient(45% 50% at 10% 100%, rgba(31, 107, 69, 0.22), transparent 50%),
                #07110C;
            color: #14221A;
            font-family: YekanBakh, Tahoma, "Segoe UI", sans-serif;
            font-size: 16px;
            line-height: 1.65;
            padding: 16px;
        }
        .dash { direction: rtl; max-width: 1440px; margin: 0 auto; padding: 0 0 24px; }
        .dash-shell {
            position: relative;
            isolation: isolate;
            overflow: visible;
            border-radius: 28px;
            padding: 18px 16px 16px;
            background:
                radial-gradient(80% 50% at 0% 0%, rgba(201, 162, 39, 0.14), transparent 55%),
                linear-gradient(180deg, rgba(255, 252, 246, 0.96), #F4EFE4);
            border: 1px solid rgba(201, 162, 39, 0.35);
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.38), 0 0 0 1px rgba(232, 212, 139, 0.12);
        }
        .dash-top {
            display: flex; flex-wrap: wrap; gap: 14px;
            align-items: flex-end; justify-content: space-between; margin-bottom: 14px;
        }
        .dash-brand { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .dash-emblem-wrap {
            width: 72px; height: 72px; border-radius: 50%; display: grid; place-items: center; flex: 0 0 auto;
            background: radial-gradient(circle, rgba(12, 36, 24, 0.92), #06140C);
            box-shadow: 0 0 0 1px rgba(201, 162, 39, 0.4), 0 0 24px rgba(201, 162, 39, 0.12);
        }
        .dash-emblem { width: 52px; height: auto; display: block; object-fit: contain; }
        .dash-brand-copy { display: flex; flex-direction: column; gap: 2px; }
        .dash-brand-kicker { margin: 0; font-size: 12px; letter-spacing: 0.06em; color: #A97C12; font-weight: 500; }
        .dash-top h1 { margin: 0; font-size: clamp(1.25rem, 2.2vw, 1.85rem); line-height: 1.35; color: var(--ink); font-weight: 800; }
        .dash-brand-aka { margin: 0; font-size: 12px; font-weight: 700; letter-spacing: 0.12em; color: #C9A227; }
        .dash-tools, .dash-filters {
            display: flex; flex-wrap: wrap; gap: 8px; align-items: flex-end;
            background: #fff; border: 1px solid #DDD3BE; border-radius: 16px; padding: 10px;
            min-width: 0; overflow: visible;
        }
        .dash-filters { width: 100%; margin-bottom: 10px; }
        .dash-tool { display: flex; flex-direction: column; gap: 4px; min-width: 0; }
        .dash-tools label, .dash-filters label, .dash-pills-label {
            font-size: 12px; color: var(--muted); padding-inline: 4px; font-weight: 700;
        }
        .dash-tools select, .dash-filters select, .dash-back {
            min-height: var(--touch); min-width: 44px; border: 1px solid var(--line); border-radius: 14px;
            background: #fff; color: var(--text); font-family: inherit; font-size: 16px; padding: 0 12px; cursor: pointer;
        }
        .dash-tools select, .dash-filters select {
            min-width: 168px; padding: 0 36px 0 12px; font-weight: 700; color-scheme: light;
            appearance: none; -webkit-appearance: none; -moz-appearance: none;
            background-color: #fff;
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%23A97C12' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: left 12px center; background-size: 18px;
        }
        .dash-tools select:hover, .dash-filters select:hover { border-color: #C4B79A; background-color: #FFFCF6; }
        .dash-filters select:disabled { opacity: .55; cursor: not-allowed; }
        .dash-tools select:disabled { cursor: default; opacity: 0.95; background-color: #F4EFE4; }
        .dash-tools select option, .dash-filters select option {
            background-color: #FFFCF6; color: #14221A; font-weight: 600;
            font-family: YekanBakh, Tahoma, "Segoe UI", sans-serif;
        }
        .dash-back {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(180deg, #D4AF37, #A97C12); color: #1A1404; border: 0;
            font-weight: 800; text-decoration: none; align-self: end;
            box-shadow: 0 10px 22px rgba(169, 124, 18, 0.28);
        }
        .dash-back:hover { filter: brightness(1.05); }
        .dash-tools select:focus-visible, .dash-filters select:focus-visible, .dash-back:focus-visible,
        .dash-account-btn:focus-visible, .dash-pill:focus-visible, .dash-crumb button:focus-visible,
        .dash-rank-metric:focus-visible, .dash-chip:focus-visible, .dash-live-btn:focus-visible {
            outline: 3px solid rgba(201, 162, 39, 0.55); outline-offset: 2px;
        }
        .dash-pills { display: flex; flex-wrap: wrap; gap: 6px; align-items: center; }
        .dash-pill {
            min-height: 40px; padding: 0 12px; border: 1px solid #C9A227; border-radius: 999px;
            background: #fff; color: #14221A; font: inherit; font-size: 13px; font-weight: 700; cursor: pointer;
        }
        .dash-pill.is-on {
            background: linear-gradient(180deg, #D4AF37, #A97C12); color: #1A1404; border-color: #A97C12; font-weight: 800;
        }
        .dash-crumb { display: flex; flex-wrap: wrap; gap: 6px; list-style: none; margin: 0 0 10px; padding: 0; }
        .dash-crumb button {
            min-height: 40px; border: 1px solid #C9A227; background: #fff; border-radius: 999px;
            padding: 0 14px; font-family: inherit; font-size: 13px; color: #14221A; cursor: pointer; font-weight: 700;
        }
        .dash-crumb button:hover { background: #F4EFE4; }
        .dash-crumb button[aria-current="page"] {
            background: linear-gradient(180deg, #D4AF37, #A97C12); color: #1A1404; border-color: #A97C12; font-weight: 800;
        }
        .dash-crumb button:disabled { cursor: default; opacity: .85; }
        .dash-status {
            min-height: 20px; margin: 0 0 14px; font-size: 14px; color: #4A5A51;
            background: rgba(255,255,255,.7); border-radius: 12px; padding: 8px 12px;
            border: 1px dashed rgba(201,162,39,.7);
        }
        .dash-source-bar {
            display: flex; flex-wrap: wrap; align-items: center; gap: 10px;
            margin: 0 0 14px; padding: 8px 12px; border-radius: 12px;
            background: #FFFCF6; border: 1px solid #DDD3BE; font-size: 13px; color: #14221A;
        }
        .dash-source-bar[hidden] { display: none !important; }
        .dash-source-bar .dash-source-tag {
            display: inline-flex; align-items: center; min-height: 28px; padding: 0 10px;
            border-radius: 999px; font-size: 12px; font-weight: 700;
            background: #F4EFE4; border: 1px solid #C9A227; color: #0C2418;
        }
        .dash-source-bar .dash-source-tag.is-live {
            background: #FFFBEB; border-color: #F59E0B; color: #A16207;
        }
        .dash-source-bar .dash-source-meta { color: #4A5A51; }
        .dash-live-btn {
            margin-right: auto; min-height: 36px; padding: 0 14px; border-radius: 10px;
            border: 1px solid #C9A227; background: #fff; color: #14221A;
            font: inherit; font-size: 13px; font-weight: 700; cursor: pointer;
        }
        .dash-live-btn:hover { background: #F4EFE4; }
        .dash-live-btn:disabled { opacity: .55; cursor: not-allowed; }
        .dash-grid {
            display: grid;
            grid-template-columns: minmax(240px, 300px) minmax(0, 1.6fr) minmax(240px, 300px);
            gap: 16px;
            align-items: start;
        }
        .dash-col, .dash-card, .kpi-row, .kpi, .dash-rank-list li { min-width: 0; }
        .dash-col { display: flex; flex-direction: column; gap: 14px; }
        .dash-card {
            background: #fff; border: 1px solid #C9A227; border-radius: 18px;
            box-shadow: 0 10px 28px rgba(6, 20, 12, 0.08); padding: 16px;
        }
        .dash-card-head {
            display: flex; align-items: center; justify-content: space-between; gap: 8px;
            margin: 0 0 14px; padding-bottom: 10px; border-bottom: 1px solid #DDD3BE;
        }
        .dash-card h2 { margin: 0; font-size: 15px; color: #14221A; line-height: 1.4; min-width: 0; }
        .dash-card-tag {
            font-size: 11px; color: #A97C12; background: #FFF8EA; border: 1px solid #C9A227;
            border-radius: 999px; padding: 2px 8px; white-space: nowrap; flex-shrink: 0;
        }
        .dash-card-tag.is-plan { color: #A97C12; background: #FFF8EA; border-color: #C9A227; }
        .kpi-row { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 8px; }
        .kpi {
            background: linear-gradient(160deg, #F4EFE4, #FFFCF6);
            border: 1px solid #DDD3BE; border-radius: 14px; padding: 10px 8px; text-align: center;
        }
        .kpi.is-wide { grid-column: 1 / -1; }
        .kpi b {
            display: block; max-width: 100%; min-width: 0;
            font-size: 1.2rem; line-height: 1.25; font-weight: 800;
            direction: ltr; unicode-bidi: isolate; color: #14221A;
            font-variant-numeric: tabular-nums; white-space: nowrap;
        }
        .kpi.is-wide b { font-size: 1.35rem; }
        .kpi span { display: block; font-size: 12px; color: #4A5A51; line-height: 1.4; }
        .kpi em { display: block; margin-top: 4px; font-style: normal; font-size: 12px; color: #1F6B45; overflow-wrap: anywhere; }
        .agri-bar {
            height: 10px; border-radius: 999px; background: #F4EFE4; overflow: hidden; margin-top: 10px;
        }
        .agri-bar > i { display: block; height: 100%; background: #1F6B45; width: 0; max-width: 100%; }
        .agri-bar.is-under > i { background: #B45309; }
        .agri-bar.is-over > i { background: #C9A227; }
        .agri-bar.is-none > i { width: 0 !important; }
        .chart-box {
            height: 210px; position: relative; border-radius: 14px;
            background: linear-gradient(180deg, #FFFCF6, #fff); border: 1px solid #DDD3BE; padding: 8px;
        }
        .dash-map-wrap { min-height: 620px; }
        #dash-map { height: 420px; width: 100%; border-radius: 14px; background: #F4EFE4; border: 1px solid #DDD3BE; }
        #dash-map .leaflet-container { background: #F4EFE4; font-family: inherit; }
        .leaflet-default-icon-path { background-image: none !important; }
        .dash-map-icon { background: none !important; border: none !important; }
        .dash-map-label {
            transform: translate(-50%, -50%);
            background: transparent;
            border: none;
            border-radius: 0;
            padding: 0;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.15;
            color: #111827;
            white-space: nowrap;
            box-shadow: none;
            text-shadow:
                0 0 2px #fff,
                0 0 4px #fff,
                1px 0 0 #fff,
                -1px 0 0 #fff,
                0 1px 0 #fff,
                0 -1px 0 #fff;
            pointer-events: none;
            cursor: default;
            font-family: inherit;
        }
        .dash-map-label.is-chip {
            pointer-events: auto;
            cursor: pointer;
            background: rgba(255,255,255,.94);
            border: 1px solid #C9A227;
            border-radius: 8px;
            padding: 3px 8px;
            font-weight: 600;
            color: #14221A;
            text-shadow: none;
            box-shadow: 0 1px 4px rgba(6,20,12,.18);
        }
        .dash-map-label.is-on { color: #14221A; font-size: 13px; }
        .dash-map-label.is-chip.is-on {
            background: #1F6B45;
            color: #fff;
            border-color: #14221A;
        }
        .dash-flag-icon { background: none !important; border: none !important; }
        .dash-flag {
            width: 32px;
            height: 40px;
            transform: translate(-50%, -100%);
            cursor: pointer;
            transition: transform .18s ease;
            filter: drop-shadow(0 2px 4px rgba(6,20,12,.28));
        }
        .dash-flag:hover { transform: translate(-50%, -100%) scale(1.08); }
        .dash-flag svg { display: block; width: 32px; height: 40px; }
        .dash-flag.is-on svg .flag-cloth { fill: #14221A; }
        .dash-flag-tip.leaflet-tooltip {
            background: #14221A;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 8px 12px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(6,20,12,.28);
        }
        .dash-flag-tip.leaflet-tooltip::before { border-top-color: #14221A; }
        #dash-map .leaflet-container { background: #F4EFE4; font-family: inherit; }
        .leaflet-default-icon-path { background-image: none !important; }
        .dash-map-icon { background: none !important; border: none !important; }
        .dash-map-label {
            transform: translate(-50%, -50%);
            background: transparent; border: none; border-radius: 0; padding: 0;
            font-size: 12px; font-weight: 700; line-height: 1.15; color: #111827;
            white-space: nowrap; box-shadow: none; pointer-events: none; cursor: default;
            font-family: inherit;
            text-shadow: 0 0 2px #fff, 0 0 4px #fff, 1px 0 0 #fff, -1px 0 0 #fff, 0 1px 0 #fff, 0 -1px 0 #fff;
        }
        .dash-map-label.is-chip {
            pointer-events: auto; cursor: pointer; background: rgba(255,255,255,.94);
            border: 1px solid #C9A227; border-radius: 8px; padding: 3px 8px;
            font-weight: 600; color: #14221A; text-shadow: none;
            box-shadow: 0 1px 4px rgba(6,20,12,.18);
        }
        .dash-map-label.is-on { color: #14221A; font-size: 13px; }
        .dash-map-label.is-chip.is-on { background: #1F6B45; color: #fff; border-color: #14221A; }
        .dash-flag-icon { background: none !important; border: none !important; }
        .dash-flag {
            width: 32px; height: 40px; transform: translate(-50%, -100%); cursor: pointer;
            transition: transform .18s ease; filter: drop-shadow(0 2px 4px rgba(6,20,12,.28));
        }
        .dash-flag:hover { transform: translate(-50%, -100%) scale(1.08); }
        .dash-flag svg { display: block; width: 32px; height: 40px; }
        .dash-flag.is-on svg .flag-cloth { fill: #14221A; }
        .dash-flag-tip.leaflet-tooltip {
            background: #14221A; color: #fff; border: none; border-radius: 10px;
            padding: 8px 12px; font-family: inherit; font-size: 13px; font-weight: 600;
            box-shadow: 0 8px 20px rgba(6,20,12,.28);
        }
        .dash-flag-tip.leaflet-tooltip::before { border-top-color: #14221A; }
        @media (prefers-reduced-motion: reduce) {
            .dash-flag, .dash-flag:hover { transition: none; transform: translate(-50%, -100%); }
        }
        .dash-side-list {
            max-height: 180px; overflow: auto; display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 8px; margin-top: 12px;
        }
        .dash-chip {
            min-height: 44px; border: 1px solid #C9A227; background: #FFFCF6; border-radius: 12px;
            padding: 6px 10px; font-family: inherit; font-size: 13px; color: #14221A; cursor: pointer; text-align: right;
            overflow-wrap: anywhere;
        }
        .dash-chip.is-on, .dash-chip:hover { background: #F4EFE4; border-color: #1F6B45; }
        .dash-rank { margin-top: 14px; padding-top: 12px; border-top: 1px solid #DDD3BE; }
        .dash-rank-list { margin: 0; padding: 0; list-style: none; display: grid; gap: 6px; max-height: 560px; overflow: auto; }
        .dash-rank-list li {
            display: grid; grid-template-columns: 36px minmax(0, 1fr) auto; grid-template-rows: auto 4px;
            column-gap: 10px; row-gap: 6px; align-items: center;
            margin: 0; padding: 8px 10px; border: 1px solid #DDD3BE; border-radius: 12px; background: #FFFCF6;
            cursor: pointer; font-size: 13px; color: #14221A;
        }
        .dash-rank-list li:hover { border-color: #C9A227; background: #F4EFE4; }
        .dash-rank-list .dash-rank-name { min-width: 0; overflow-wrap: anywhere; }
        .dash-rank-n {
            width: 28px; height: 28px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;
            background: #1F6B45; color: #fff; font-size: 12px; font-weight: 700; flex-shrink: 0; direction: ltr;
        }
        .dash-rank-list li:nth-child(1) .dash-rank-n { background: #A16207; }
        .dash-rank-list li:nth-child(2) .dash-rank-n { background: #DDD3BE; }
        .dash-rank-list li:nth-child(3) .dash-rank-n { background: #B45309; }
        .dash-rank-v {
            direction: ltr; unicode-bidi: isolate; font-variant-numeric: tabular-nums; color: #1F6B45; font-weight: 700;
            font-size: 12px; text-align: left; line-height: 1.3; white-space: nowrap;
        }
        .dash-rank-list .dash-rank-bar {
            grid-column: 2 / -1; height: 4px; border-radius: 999px; background: #DDD3BE; overflow: hidden;
        }
        .dash-rank-list .dash-rank-bar > i {
            display: block; height: 100%; background: linear-gradient(90deg, #C9A227, #1F6B45); border-radius: 999px;
        }
        .dash-rank-metrics { display: flex; flex-wrap: wrap; gap: 6px; margin: 0 0 10px; }
        .dash-rank-metric {
            min-height: 30px; padding: 0 10px; border-radius: 999px; border: 1px solid #C9A227;
            background: #fff; color: #14221A; font: inherit; font-size: 12px; font-weight: 700; cursor: pointer;
        }
        .dash-rank-metric.is-on { background: #F4EFE4; border-color: #1F6B45; color: #0C2418; }
        .dash-rank-hint { margin: 0 0 10px; font-size: 12px; color: #4A5A51; }
        .dash-family { margin: 0 0 8px; font-size: 12px; font-weight: 700; color: #4A5A51; }
        .dash-overlay {
            position: fixed; inset: 0; background: rgba(7, 17, 12, 0.62);
            display: none; align-items: center; justify-content: center; z-index: 200;
        }
        .dash-overlay.is-open { display: flex; }
        .dash-overlay-panel {
            background: #FFFCF6; border-radius: 16px; padding: 24px; text-align: center; min-width: 220px;
            border: 1px solid rgba(201, 162, 39, 0.35); color: #14221A;
        }
        .dash-spinner {
            width: 36px; height: 36px; margin: 0 auto 12px; border: 3px solid #DDD3BE;
            border-top-color: #C9A227; border-radius: 50%; animation: dashspin .8s linear infinite;
        }
        @keyframes dashspin { to { transform: rotate(360deg); } }
        @media (max-width: 1100px) {
            .dash-grid { grid-template-columns: 1fr; }
            .dash-shell { padding: 14px 10px 12px; border-radius: 18px; }
            .dash-emblem-wrap { width: 56px; height: 56px; }
            .dash-emblem { width: 40px; }
            .dash-map-wrap, #dash-map { min-height: 420px; height: 420px; }
        }
        @media (prefers-reduced-motion: reduce) {
            .dash-spinner, .dash-back { animation: none; transition: none; }
            .dash-flag, .dash-flag:hover { transform: translate(-50%, -100%); }
        }
<?php dash_account_css(); ?>
    </style>
</head>
<body class="dash-body">
<div id="dash-overlay" class="dash-overlay">
    <div class="dash-overlay-panel" role="status" aria-live="polite">
        <div class="dash-spinner" aria-hidden="true"></div>
        <p>در حال بررسی اطلاعات...</p>
    </div>
</div>

<div class="dash">
    <div class="dash-shell">
        <div class="dash-top">
            <div class="dash-brand">
                <div class="dash-emblem-wrap">
                    <img class="dash-emblem" src="<?php echo dash_h($dash_root); ?>files/jahad-white.png" width="52" height="52" alt="آرم وزارت جهاد کشاورزی">
                </div>
                <div class="dash-brand-copy">
                    <p class="dash-brand-kicker">وزارت جهاد کشاورزی</p>
                    <h1>داشبورد زراعت</h1>
                    <p class="dash-brand-aka"><span dir="ltr">MAPKA</span> · مپکا</p>
                </div>
            </div>
            <div class="dash-head-actions">
            <div class="dash-tools">
                <div class="dash-tool">
                    <select id="dash-year" aria-label="سال زراعی">
                        <?php echo $dash_year_opts; ?>
                    </select>
                </div>
                <div class="dash-tool">
                    <select id="dash-ostan" aria-label="استان"<?php echo (!empty($dash_force_ostan)) ? ' disabled' : ''; ?>>
<?php if (empty($dash_force_ostan)): ?>
                        <option value="">کل کشور</option>
<?php else: ?>
                        <option value="<?php echo dash_h($dash_force_ostan); ?>" selected><?php echo dash_h((isset($ostan) && trim($ostan . '') !== '') ? $ostan : $dash_force_ostan); ?></option>
<?php endif; ?>
                    </select>
                </div>
                <a class="dash-back dash-home" id="dash-home" href="<?php echo dash_h($homeHref); ?>" aria-label="بازگشت به خانه" title="بازگشت به خانه"><?php echo dash_account_icon('home'); ?></a>
            </div>
            <?php dash_account_html(); ?>
            </div>
        </div>

        <div class="dash-filters">
            <div class="dash-tool">
                <label for="dash-group">گروه محصول</label>
                <select id="dash-group" aria-label="گروه محصول">
                    <option value="">همه گروه‌ها</option>
                </select>
            </div>
            <div class="dash-tool">
                <label for="dash-product">نام محصول</label>
                <select id="dash-product" aria-label="نام محصول">
                    <option value="">همه محصولات</option>
                </select>
            </div>
            <div class="dash-tool">
                <span class="dash-pills-label" id="water-label">آبی / دیم</span>
                <div class="dash-pills" role="group" aria-labelledby="water-label">
                    <button type="button" class="dash-pill is-on" data-water="all">هر دو</button>
                    <button type="button" class="dash-pill" data-water="abi">آبی</button>
                    <button type="button" class="dash-pill" data-water="dim">دیم</button>
                </div>
            </div>
        </div>

        <ol class="dash-crumb" id="dash-crumb" aria-label="سطح جغرافیایی"></ol>
        <div class="dash-source-bar" id="dash-source-bar" hidden>
            <span class="dash-source-tag" id="dash-source-tag">اسنپ‌شات</span>
            <span class="dash-source-meta" id="dash-source-meta"></span>
            <button type="button" class="dash-live-btn" id="dash-live-btn" hidden>بروزرسانی آنلاین</button>
        </div>
        <p class="dash-status" id="dash-status" role="status">در حال بارگذاری آمار زراعت...</p>

        <div class="dash-grid">
            <aside class="dash-col">
                <p class="dash-family">وضعیت موجود</p>
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>سطح پراکندگی کشت</h2>
                        <span class="dash-card-tag">هکتار</span>
                    </div>
                    <div class="kpi is-wide"><b id="k-plant">۰</b><span>کل کشت</span></div>
                    <div class="kpi-row">
                        <div class="kpi"><b id="k-plant-abi">۰</b><span>آبی</span></div>
                        <div class="kpi"><b id="k-plant-dim">۰</b><span>دیم</span></div>
                    </div>
                </section>
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>سطح برداشت</h2>
                        <span class="dash-card-tag">هکتار</span>
                    </div>
                    <div class="kpi is-wide">
                        <b id="k-harvest">۰</b>
                        <span>کل برداشت</span>
                        <em id="k-harvest-pct"></em>
                    </div>
                    <div class="kpi-row">
                        <div class="kpi"><b id="k-harvest-abi">۰</b><span>آبی</span></div>
                        <div class="kpi"><b id="k-harvest-dim">۰</b><span>دیم</span></div>
                    </div>
                </section>
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>پیش‌بینی تولید</h2>
                        <span class="dash-card-tag">تن</span>
                    </div>
                    <div class="kpi is-wide"><b id="k-pred">۰</b><span>پیش‌بینی</span></div>
                    <div class="kpi-row">
                        <div class="kpi"><b id="k-prod">۰</b><span>تولید ثبت‌شده</span></div>
                        <div class="kpi"><b id="k-yield">—</b><span>عملکرد (کیلوگرم در هکتار)</span></div>
                    </div>
                </section>
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>آبی و دیم کشت</h2>
                        <span class="dash-card-tag">سهم</span>
                    </div>
                    <div class="chart-box"><canvas id="chart-water" aria-label="نمودار آبی و دیم"></canvas></div>
                </section>
            </aside>

            <section class="dash-card dash-map-wrap">
                <div class="dash-card-head">
                    <h2 id="map-title">نقشه کشور</h2>
                    <span class="dash-card-tag">فیلتر جاری</span>
                </div>
                <div class="dash-rank-metrics" role="tablist" aria-label="شاخص نقشه">
                    <button type="button" class="dash-rank-metric is-on" data-metric="plant">کشت</button>
                    <button type="button" class="dash-rank-metric" data-metric="harvest">برداشت</button>
                    <button type="button" class="dash-rank-metric" data-metric="realize">تحقق الگو</button>
                </div>
                <div id="dash-map" role="application" aria-label="نقشه زراعت"></div>
                <div id="place-list" class="dash-side-list" hidden></div>
                <section class="dash-rank" id="dash-rank">
                    <h3 id="dash-rank-title" style="margin:0 0 8px;font-size:1rem;color:#14221A">رتبه‌بندی</h3>
                    <p class="dash-rank-hint" id="dash-rank-hint">اعداد سطح به هکتار است — برای رفتن به همان محدوده کلیک کنید.</p>
                    <ol class="dash-rank-list" id="dash-rank-list"></ol>
                </section>
            </section>

            <aside class="dash-col">
                <p class="dash-family">برنامه و الگو</p>
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>برنامه الگوی کشت</h2>
                        <span class="dash-card-tag is-plan">ابلاغی</span>
                    </div>
                    <div class="kpi is-wide"><b id="k-plan">۰</b><span>سطح ابلاغی (هکتار)</span></div>
                    <div class="kpi-row">
                        <div class="kpi"><b id="k-plan-abi">۰</b><span>آبی</span></div>
                        <div class="kpi"><b id="k-plan-dim">۰</b><span>دیم</span></div>
                    </div>
                </section>
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>وضعیت برش الگو</h2>
                        <span class="dash-card-tag is-plan">تحقق</span>
                    </div>
                    <div class="kpi is-wide">
                        <b id="k-realize">—</b>
                        <span id="k-realize-label">کشت واقعی نسبت به ابلاغی</span>
                    </div>
                    <div class="agri-bar is-none" id="k-realize-bar"><i id="k-realize-fill"></i></div>
                </section>
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2 id="share-title">سهم گروه‌ها</h2>
                        <span class="dash-card-tag">کشت</span>
                    </div>
                    <div class="chart-box"><canvas id="chart-share" aria-label="نمودار سهم"></canvas></div>
                </section>
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>کشت، برداشت، ابلاغی</h2>
                        <span class="dash-card-tag">هکتار</span>
                    </div>
                    <div class="chart-box"><canvas id="chart-compare" aria-label="مقایسه کشت و برنامه"></canvas></div>
                </section>
            </aside>
        </div>
    </div>
</div>

<script src="<?php echo dash_h($dash_root); ?>assets/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo dash_h($dash_root); ?>assets/js/Chart.min.js"></script>
<script src="<?php echo dash_h($dash_root); ?>inc/leaflet.js"></script>
<script>
(function () {
    var API = <?php echo json_encode($dash_api); ?>;
    var ROOT = <?php echo json_encode($dash_root); ?>;
    var FORCE_OSTAN = <?php echo json_encode(isset($dash_force_ostan) ? $dash_force_ostan : ''); ?>;
    var GEO = ROOT + 'inc/iran-provinces.json?v=20260904e';
    var GEO_COUNTY = ROOT + 'assets/geo/counties/';
    var GEO_ISO = ROOT + 'assets/geo/ostan-iso.json?v=20260904e';
    var state = {
        level: FORCE_OSTAN ? 'ostan' : 'country',
        id_ostan: <?php echo json_encode($boot_ostan); ?>,
        id_city: <?php echo json_encode($boot_city); ?>, id_mar: <?php echo json_encode($boot_mar); ?>,
        year: <?php echo (int) $boot_year; ?>,
        group_cod: <?php echo json_encode($boot_group); ?>,
        product_cod: <?php echo json_encode($boot_prod); ?>,
        water: <?php echo json_encode(($boot_water === 'abi' || $boot_water === 'dim') ? $boot_water : 'all'); ?>,
        metric: 'plant',
        wantLive: false,
        force_ostan: FORCE_OSTAN || ''
    };
    var last = null;
    var catalog = { groups: [], by_group: {} };
    var map, geoLayer, countyLayer, tileLayer, markers, charts = {};
    var nameIndex = {};
    var ostanIso = {};
    var countyCache = {};
    var countyReq = 0;
    var overlay = document.getElementById('dash-overlay');
    var fitTimer = 0;
    window.onerror = function (msg) {
        var s = document.getElementById('dash-status');
        if (s) s.textContent = 'خطای صفحه: ' + msg;
        if (overlay) overlay.className = 'dash-overlay';
        return false;
    };

    if (typeof Chart !== 'undefined' && Chart.defaults && Chart.defaults.global) {
        Chart.defaults.global.defaultFontFamily = 'YekanBakh, Tahoma, sans-serif';
        Chart.defaults.global.defaultFontColor = '#14221A';
    }

    function busy(on) { overlay.className = on ? 'dash-overlay is-open' : 'dash-overlay'; }
    function dashNeedLogin(d) {
        if (d && d.error === 'auth') { window.location.href = 'login.php'; return true; }
        return false;
    }
    function dashPost(url, fields) {
        var f = document.createElement('form');
        var k, inp;
        f.method = 'post';
        f.action = url;
        f.style.display = 'none';
        for (k in fields) {
            if (!Object.prototype.hasOwnProperty.call(fields, k)) continue;
            inp = document.createElement('input');
            inp.type = 'hidden';
            inp.name = k;
            inp.value = fields[k] == null ? '' : String(fields[k]);
            f.appendChild(inp);
        }
        document.body.appendChild(f);
        f.submit();
    }
    function dashApi(data) {
        return $.ajax({ url: API, type: 'POST', dataType: 'json', data: data });
    }
    function formatBuiltAt(s) {
        s = String(s || '').replace('T', ' ');
        return toFaDigits(s);
    }
    function renderSourceBar(d) {
        var bar = document.getElementById('dash-source-bar');
        var tag = document.getElementById('dash-source-tag');
        var meta = document.getElementById('dash-source-meta');
        var btn = document.getElementById('dash-live-btn');
        if (!bar || !tag || !meta || !btn) return;
        var src = d.data_source || 'live';
        if (d.level !== 'country') {
            bar.hidden = true;
            btn.hidden = true;
            return;
        }
        bar.hidden = false;
        if (src === 'snap') {
            tag.textContent = 'اسنپ‌شات';
            tag.className = 'dash-source-tag';
            meta.textContent = d.built_at
                ? ('تاریخ به‌روزرسانی: ' + formatBuiltAt(d.built_at))
                : 'آمار زراعت کشور از جدول اسنپ';
        } else if (src === 'live') {
            tag.textContent = 'آنلاین';
            tag.className = 'dash-source-tag is-live';
            meta.textContent = 'واکشی زنده برای این مشاهده (اسنپ‌شات تغییر نکرد)';
        } else {
            tag.textContent = 'زنده';
            tag.className = 'dash-source-tag is-live';
            meta.textContent = 'اسنپ‌شات زراعت برای این سال یافت نشد';
        }
        btn.hidden = !(d.can_live && src !== 'live');
        btn.disabled = false;
    }
    function toFaDigits(s) {
        return String(s).replace(/[0-9]/g, function (d) {
            return '۰۱۲۳۴۵۶۷۸۹'[d];
        }).replace(/,/g, '٬');
    }
    function faNum(n) {
        n = Number(n);
        if (!isFinite(n)) n = 0;
        var rounded = Math.round(n * 10) / 10;
        var s = (Math.abs(rounded - Math.round(rounded)) < 1e-9)
            ? String(Math.round(rounded))
            : String(rounded);
        s = s.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return toFaDigits(s).replace(/\./g, '٫');
    }
    function faHa(n) {
        n = Number(n) || 0;
        if (Math.abs(n) >= 100) n = Math.round(n);
        else n = Math.round(n * 10) / 10;
        return faNum(n);
    }
    function fitInBox(el, maxPx, minPx) {
        if (!el) return;
        maxPx = maxPx || 19;
        minPx = minPx || 11;
        if (!el.clientWidth) return;
        el.style.whiteSpace = 'nowrap';
        el.style.overflowWrap = 'normal';
        el.style.wordBreak = 'normal';
        el.style.fontSize = maxPx + 'px';
        var guard = 28;
        while (el.scrollWidth > el.clientWidth + 1 && maxPx > minPx && guard--) {
            maxPx -= 1;
            el.style.fontSize = maxPx + 'px';
        }
        if (el.scrollWidth > el.clientWidth + 1) {
            el.style.whiteSpace = 'normal';
            el.style.overflowWrap = 'anywhere';
            el.style.wordBreak = 'break-word';
        }
        el.setAttribute('title', el.textContent || '');
    }
    function fitAllNums() {
        document.querySelectorAll('.kpi b').forEach(function (el) {
            var box = el.parentNode;
            var wide = box && box.className && (' ' + box.className + ' ').indexOf(' is-wide ') !== -1;
            fitInBox(el, wide ? 22 : 16, 11);
        });
        document.querySelectorAll('.dash-rank-v').forEach(function (el) {
            fitInBox(el, 12, 10);
        });
    }
    function scheduleFit() {
        if (fitTimer) window.clearTimeout(fitTimer);
        fitTimer = window.setTimeout(fitAllNums, 40);
    }
    function escHtml(s) {
        return String(s || '').replace(/[&<>"']/g, function (ch) {
            return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[ch];
        });
    }
    function ostanId(v) {
        v = String(v == null ? '' : v).trim();
        if (!v) return '';
        if (/^\d+$/.test(v)) return ('0' + v).slice(-2);
        return v;
    }
    function normFa(s) {
        return String(s || '').replace(/استان\s+/g, '').replace(/ي/g, 'ی').replace(/ك/g, 'ک').replace(/ـ/g, '').replace(/‌/g, '').replace(/\s+/g, '');
    }
    function colorFor(v, max) {
        if (!max || v <= 0) return '#DDD3BE';
        var t = v / max;
        if (t > 0.75) return '#14221A';
        if (t > 0.5) return '#0C2418';
        if (t > 0.25) return '#1F6B45';
        return '#C9A227';
    }
    function countyColorFor(v, max) {
        if (!max || v <= 0) return '#DDD3BE';
        var t = v / max;
        if (t > 0.75) return '#163524';
        if (t > 0.5) return '#1F6B45';
        if (t > 0.25) return '#C9A227';
        return '#E8D48B';
    }
    function hasLeaflet() {
        return typeof L !== 'undefined';
    }
    function setTiles(on) {
        if (!hasLeaflet() || !map) return;
        if (on && !tileLayer) {
            tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 18 }).addTo(map);
        } else if (!on && tileLayer) {
            map.removeLayer(tileLayer);
            tileLayer = null;
        }
    }
    function countyDisplayName(raw) {
        return String(raw || '')
            .replace(/^شهرستان\s*ویژه\s+/u, '')
            .replace(/^شهرستان\s+/u, '')
            .replace(/^شهرستان/u, '')
            .trim();
    }
    function featCountyName(feat) {
        var p = feat && feat.properties ? feat.properties : {};
        if (p.tags && p.tags.name) return p.tags.name;
        return p.name || '';
    }
    function layerCentroid(layer) {
        try {
            var latlngs = layer.getLatLngs();
            var flat = [];
            function walk(arr) {
                if (!arr || !arr.length) return;
                if (arr[0] && typeof arr[0].lat === 'number') {
                    for (var i = 0; i < arr.length; i++) flat.push(arr[i]);
                    return;
                }
                for (var j = 0; j < arr.length; j++) walk(arr[j]);
            }
            walk(latlngs);
            if (!flat.length) return layer.getBounds().getCenter();
            var lat = 0, lng = 0, n = flat.length;
            for (var k = 0; k < n; k++) {
                lat += flat[k].lat;
                lng += flat[k].lng;
            }
            return L.latLng(lat / n, lng / n);
        } catch (e) {
            try { return layer.getBounds().getCenter(); } catch (e2) { return null; }
        }
    }
    function clearCounties() {
        countyReq += 1;
        if (countyLayer && map) {
            try { map.removeLayer(countyLayer); } catch (e) {}
        }
        countyLayer = null;
    }
    function ostanLabel(d) {
        var name = '';
        var want = ostanId(d.id_ostan);
        (d.provinces || []).forEach(function (p) {
            if (ostanId(p.id_ostan) === want) name = p.ostan;
        });
        if (!name && d.crumb && d.crumb.length) {
            for (var i = 0; i < d.crumb.length; i++) {
                if (d.crumb[i].level === 'ostan') name = d.crumb[i].label;
            }
        }
        return name;
    }
    function isoForOstan(d) {
        var id = ostanId(d.id_ostan);
        if (id) return 'IR-' + id;
        var key = normFa(ostanLabel(d));
        return ostanIso[key] || '';
    }
    function placeValue(p, metric) {
        if (metric === 'harvest') return Number(p.harvest) || 0;
        if (metric === 'realize') return Number(p.realize_pct) || 0;
        return Number(p.plant) || 0;
    }
    function goHome(e) {
        if (e) e.preventDefault();
        dashPost('index.php', {
            year: document.getElementById('dash-year').value || state.year || '',
            id_ostan: state.id_ostan || '',
            id_city: state.id_city || '',
            id_mar: state.id_mar || ''
        });
    }
    function syncHome() {
        var home = document.getElementById('dash-home');
        if (home) home.href = 'index.php';
    }
    function setCatalog(cat) {
        catalog.groups = (cat && cat.groups) ? cat.groups : [];
        catalog.by_group = {};
        var list = (cat && cat.products) ? cat.products : [];
        list.forEach(function (p) {
            var g = String(p.group_cod || '');
            if (!g) return;
            if (!catalog.by_group[g]) catalog.by_group[g] = [];
            catalog.by_group[g].push(p);
        });
    }
    function fillGroups() {
        var gsel = document.getElementById('dash-group');
        var cur = state.group_cod;
        gsel.innerHTML = '<option value="">همه گروه‌ها</option>';
        (catalog.groups || []).forEach(function (g) {
            var o = document.createElement('option');
            o.value = g.group_cod;
            o.textContent = toFaDigits(g.group_name);
            gsel.appendChild(o);
        });
        gsel.value = cur || '';
        fillProducts();
    }
    function fillProducts() {
        var psel = document.getElementById('dash-product');
        var g = document.getElementById('dash-group').value;
        var keep = state.product_cod;
        psel.innerHTML = '<option value="">همه محصولات</option>';
        var list = [];
        if (g && catalog.by_group && catalog.by_group[g]) list = catalog.by_group[g];
        list.forEach(function (p) {
            var o = document.createElement('option');
            o.value = p.product_cod;
            o.textContent = toFaDigits(p.product_name);
            psel.appendChild(o);
        });
        psel.disabled = !g;
        if (!g) {
            state.product_cod = '';
            return;
        }
        if (keep) {
            psel.value = keep;
        }
    }
    function killChart(id) {
        if (charts[id]) { charts[id].destroy(); charts[id] = null; }
    }
    function drawDoughnut(id, labels, data, colors) {
        killChart(id);
        var el = document.getElementById(id);
        if (!el || typeof Chart === 'undefined') return;
        var ctx = el.getContext('2d');
        var vals = (data || []).map(function (v) { return Number(v) || 0; });
        var total = 0;
        vals.forEach(function (v) { total += v; });
        var onSlice = '#FFFCF6';
        function pctOf(v) {
            if (total <= 0) return 0;
            return Math.round((v * 1000) / total) / 10;
        }
        charts[id] = new Chart(ctx, {
            type: 'doughnut',
            data: { labels: labels, datasets: [{ data: vals, backgroundColor: colors, borderWidth: 0 }] },
            options: {
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        fontFamily: 'YekanBakh, Tahoma',
                        boxWidth: 10,
                        fontSize: 11,
                        generateLabels: function (chart) {
                            var ds = chart.data.datasets[0] || { data: [], backgroundColor: [] };
                            var meta = chart.getDatasetMeta(0);
                            return (chart.data.labels || []).map(function (label, i) {
                                var val = Number(ds.data[i]) || 0;
                                var hidden = meta && meta.data[i] ? meta.data[i].hidden : false;
                                return {
                                    text: toFaDigits(label) + ' — ' + faNum(pctOf(val)) + '٪',
                                    fillStyle: ds.backgroundColor[i],
                                    strokeStyle: ds.backgroundColor[i],
                                    lineWidth: 0,
                                    hidden: hidden,
                                    index: i
                                };
                            });
                        }
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, cdata) {
                            var val = Number(cdata.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]) || 0;
                            var name = cdata.labels[tooltipItem.index] || '';
                            return toFaDigits(name) + ': ' + faHa(val) + ' (' + faNum(pctOf(val)) + '٪)';
                        }
                    }
                }
            },
            plugins: [{
                afterDatasetsDraw: function (chart) {
                    if (total <= 0) return;
                    var c = chart.chart.ctx;
                    var meta = chart.getDatasetMeta(0);
                    if (!meta || !meta.data) return;
                    meta.data.forEach(function (arc, i) {
                        if (!arc || arc.hidden) return;
                        var val = vals[i];
                        if (val <= 0) return;
                        var pct = pctOf(val);
                        if (pct < 3) return;
                        var pos = arc.tooltipPosition();
                        c.save();
                        c.fillStyle = onSlice;
                        c.font = 'bold 13px YekanBakh, Tahoma, sans-serif';
                        c.textAlign = 'center';
                        c.textBaseline = 'middle';
                        c.shadowColor = 'rgba(6, 20, 12, 0.55)';
                        c.shadowBlur = 4;
                        c.fillText(faNum(pct) + '٪', pos.x, pos.y);
                        c.restore();
                    });
                }
            }]
        });
    }
    function drawBar(id, labels, datasets) {
        killChart(id);
        var el = document.getElementById(id);
        if (!el || typeof Chart === 'undefined') return;
        charts[id] = new Chart(el.getContext('2d'), {
            type: 'bar',
            data: { labels: labels, datasets: datasets },
            options: {
                legend: { display: datasets.length > 1, position: 'bottom' },
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{ ticks: { beginAtZero: true, fontSize: 11, maxTicksLimit: 6, callback: function (v) { return faNum(v); } } }],
                    xAxes: [{ ticks: { fontSize: 11, callback: function (v) { return toFaDigits(v); } } }]
                },
                tooltips: { callbacks: { label: function (t) { return faHa(t.yLabel); } } }
            }
        });
    }
    function setKpi() {
        var k = (last && last.kpi) ? last.kpi : {};
        var plant = k.plant || {};
        var harvest = k.harvest || {};
        var plan = k.plan || {};
        document.getElementById('k-plant').textContent = faHa(plant.total);
        document.getElementById('k-plant-abi').textContent = faHa(plant.abi);
        document.getElementById('k-plant-dim').textContent = faHa(plant.dim);
        document.getElementById('k-harvest').textContent = faHa(harvest.total);
        document.getElementById('k-harvest-abi').textContent = faHa(harvest.abi);
        document.getElementById('k-harvest-dim').textContent = faHa(harvest.dim);
        var hp = document.getElementById('k-harvest-pct');
        hp.textContent = (k.harvest_pct != null) ? ('نسبت به کشت: ' + faNum(k.harvest_pct) + '٪') : '';
        document.getElementById('k-pred').textContent = faHa(k.pred);
        document.getElementById('k-prod').textContent = faHa(k.prod);
        document.getElementById('k-yield').textContent = (k.yield_kg_ha != null) ? faNum(k.yield_kg_ha) : '—';
        document.getElementById('k-plan').textContent = faHa(plan.total);
        document.getElementById('k-plan-abi').textContent = faHa(plan.abi);
        document.getElementById('k-plan-dim').textContent = faHa(plan.dim);
        var rz = k.realize_pct;
        document.getElementById('k-realize').textContent = (rz == null) ? '—' : (faNum(rz) + '٪');
        var bar = document.getElementById('k-realize-bar');
        var fill = document.getElementById('k-realize-fill');
        var st = k.realize_status || 'none';
        bar.className = 'agri-bar is-' + st;
        fill.style.width = (rz == null) ? '0%' : (Math.max(0, Math.min(100, rz)) + '%');
        var lab = { none: 'ابلاغی برای این فیلتر نیست', under: 'کمتر از برنامه', near: 'نزدیک به برنامه', over: 'بیش از برنامه' };
        document.getElementById('k-realize-label').textContent = lab[st] || lab.none;
        drawDoughnut('chart-water', ['آبی', 'دیم'], [plant.abi || 0, plant.dim || 0], ['#1F6B45', '#A16207']);
        var share = last.share || [];
        var sl = share.map(function (s) { return s.label; });
        var sd = share.map(function (s) { return Number(s.plant) || 0; });
        var titles = { group: 'سهم گروه‌ها', product: 'سهم محصولات گروه', water: 'آبی و دیم' };
        document.getElementById('share-title').textContent = titles[last.share_mode] || 'سهم';
        var pal = ['#1F6B45', '#A16207', '#163524', '#C9A227', '#0C2418', '#D97706', '#14221A', '#B45309', '#4A5A51', '#E8D48B', '#06140C', '#DDD3BE'];
        drawDoughnut('chart-share', sl, sd, pal);
        drawBar('chart-compare', ['کشت', 'برداشت', 'ابلاغی'], [{
            data: [plant.total || 0, harvest.total || 0, plan.total || 0],
            backgroundColor: ['#1F6B45', '#163524', '#C9A227']
        }]);
        scheduleFit();
    }
    function renderCrumb(d) {
        var ol = document.getElementById('dash-crumb');
        ol.innerHTML = '';
        (d.crumb || []).forEach(function (c, i, arr) {
            var li = document.createElement('li');
            var b = document.createElement('button');
            b.type = 'button';
            b.textContent = toFaDigits(c.label);
            if (i === arr.length - 1) b.setAttribute('aria-current', 'page');
            b.addEventListener('click', function () {
                load({ id_ostan: c.id_ostan, id_city: c.id_city, id_mar: c.id_mar });
            });
            li.appendChild(b);
            ol.appendChild(li);
        });
        var f = d.filter || {};
        if (f.group_name) {
            var g = document.createElement('li');
            g.innerHTML = '<button type="button" disabled>' + escHtml(toFaDigits(f.group_name)) + '</button>';
            ol.appendChild(g);
        }
        if (f.product_name) {
            var p = document.createElement('li');
            p.innerHTML = '<button type="button" aria-current="page">' + escHtml(toFaDigits(f.product_name)) + '</button>';
            ol.appendChild(p);
        }
        var titles = { country: 'نقشه کشور', ostan: 'شهرستان‌های استان', city: 'مراکز جهاد کشاورزی', mar: 'مرکز انتخاب‌شده' };
        document.getElementById('map-title').textContent = titles[d.level] || 'نقشه';
    }
    function renderPlaces(d) {
        var box = document.getElementById('place-list');
        box.innerHTML = '';
        var items = [];
        if (d.level === 'ostan') {
            (d.cities || []).forEach(function (c) {
                items.push({ label: c.city, go: function () { load({ id_ostan: d.id_ostan, id_city: c.id_city, id_mar: '' }); } });
            });
        } else if (d.level === 'city' || d.level === 'mar') {
            (d.centers || []).forEach(function (c) {
                items.push({
                    label: c.m_name || c.mar,
                    on: String(c.id_mar) === String(d.id_mar),
                    go: function () { load({ id_ostan: d.id_ostan, id_city: d.id_city, id_mar: c.id_mar }); }
                });
            });
        }
        if (!items.length) { box.hidden = true; return; }
        box.hidden = false;
        items.forEach(function (it) {
            var b = document.createElement('button');
            b.type = 'button';
            b.className = 'dash-chip' + (it.on ? ' is-on' : '');
            b.textContent = toFaDigits(it.label);
            b.addEventListener('click', it.go);
            box.appendChild(b);
        });
    }
    function renderRank(d) {
        var list = document.getElementById('dash-rank-list');
        var title = document.getElementById('dash-rank-title');
        var places = (d.places || []).slice();
        var metric = state.metric;
        places.sort(function (a, b) { return placeValue(b, metric) - placeValue(a, metric); });
        title.textContent = toFaDigits(d.rank_title || 'رتبه‌بندی');
        list.innerHTML = '';
        if (!places.length) {
            list.innerHTML = '<li style="cursor:default">مقداری برای این شاخص نیست.</li>';
            scheduleFit();
            return;
        }
        var max = 0;
        places.forEach(function (p) {
            var v = placeValue(p, metric);
            if (v > max) max = v;
        });
        places.forEach(function (p, i) {
            var v = placeValue(p, metric);
            var li = document.createElement('li');
            var unit = (metric === 'realize') ? '٪' : '';
            var txt = (metric === 'realize' && p.realize_pct == null) ? '—' : faHa(v) + unit;
            var pct = max > 0 ? Math.round((v * 100) / max) : 0;
            li.setAttribute('role', 'button');
            li.tabIndex = 0;
            li.innerHTML =
                '<span class="dash-rank-n">' + faNum(i + 1) + '</span>' +
                '<span class="dash-rank-name">' + escHtml(toFaDigits(p.label)) + '</span>' +
                '<span class="dash-rank-v">' + txt + '</span>' +
                '<span class="dash-rank-bar" aria-hidden="true"><i style="width:' + pct + '%"></i></span>';
            function go() {
                var oid = p.id_ostan || '';
                if (state.force_ostan && oid && ostanId(oid) !== ostanId(state.force_ostan)) {
                    oid = state.force_ostan;
                }
                load({ id_ostan: oid || state.force_ostan || '', id_city: p.id_city || '', id_mar: p.id_mar || '' });
            }
            li.addEventListener('click', go);
            li.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    go();
                }
            });
            list.appendChild(li);
        });
        scheduleFit();
    }
    function paintGeo(d, keepView) {
        if (!hasLeaflet() || !geoLayer) return;
        var metric = state.metric;
        var max = 0;
        var byId = {};
        if (d.level === 'country') {
            (d.places || []).forEach(function (p) {
                var id = ostanId(p.id_ostan);
                var val = placeValue(p, metric);
                byId[id] = { rec: p, value: val };
                if (val > max) max = val;
            });
        } else {
            (d.provinces || []).forEach(function (p) {
                var val = Number(p.value) || 0;
                byId[ostanId(p.id_ostan)] = { rec: p, value: val };
                if (val > max) max = val;
            });
        }
        var showCounties = (d.level === 'ostan');
        var drillLocal = (d.level === 'city' || d.level === 'mar');
        geoLayer.eachLayer(function (layer) {
            var props = layer.feature && layer.feature.properties ? layer.feature.properties : {};
            var oid = ostanId(props.id_ostan);
            var hit = oid ? byId[oid] : null;
            if (!hit) {
                var rec = nameIndex[normFa(props.name)];
                if (rec) { oid = ostanId(rec.id_ostan); hit = byId[oid]; }
            }
            var val = hit ? hit.value : 0;
            var selected = oid !== '' && oid === ostanId(d.id_ostan);
            var fade = selected && (showCounties || drillLocal);
            layer.setStyle({
                fillColor: selected ? '#C9A227' : colorFor(val, max || 1),
                weight: selected ? 2.5 : 1,
                color: selected ? '#A97C12' : '#1F6B45',
                fillOpacity: fade ? (showCounties ? 0.05 : 0.12) : (selected ? 0.85 : 0.72)
            });
            if (oid) layer._dashId = oid;
        });
        if (keepView) {
            return;
        }
        if (d.level === 'ostan' || d.level === 'city' || d.level === 'mar') {
            geoLayer.eachLayer(function (layer) {
                if (String(layer._dashId) === ostanId(d.id_ostan)) {
                    try { map.fitBounds(layer.getBounds(), { padding: [20, 20], maxZoom: 8 }); } catch (e) {}
                }
            });
        } else if (map) {
            map.setView([32.4, 53.6], 5);
        }
    }
    function addMapLabel(lat, lng, name, on, go, asChip) {
        if (lat == null || lng == null) return null;
        var cls = 'dash-map-label' + (asChip ? ' is-chip' : '') + (on ? ' is-on' : '');
        var ic = L.divIcon({
            className: 'dash-map-icon',
            html: '<div class="' + cls + '">' + escHtml(toFaDigits(name)) + '</div>',
            iconSize: [0, 0],
            iconAnchor: [0, 0]
        });
        var m = L.marker([lat, lng], { icon: ic, title: name, riseOnHover: true, interactive: !!asChip });
        if (asChip && go) m.on('click', go);
        markers.addLayer(m);
        return m;
    }
    function countyPlaceIndex(d) {
        var byKey = {};
        var byCity = {};
        var max = 0;
        (d.places || []).forEach(function (p) {
            var val = placeValue(p, state.metric);
            var rec = { rec: p, value: val };
            byKey[normFa(p.label)] = rec;
            if (p.id_city) byCity[String(p.id_city)] = rec;
            if (val > max) max = val;
        });
        return { byKey: byKey, byCity: byCity, max: max };
    }
    function countyTooltip(label, hit) {
        var name = toFaDigits(label);
        if (!hit) return name;
        var unit = (state.metric === 'realize') ? '٪' : ' هکتار';
        var v = (state.metric === 'realize' && hit.rec && hit.rec.realize_pct == null) ? '—' : faHa(hit.value);
        return name + ' — ' + v + (v === '—' ? '' : unit);
    }
    function styleCountyLayer(d) {
        if (!countyLayer) return;
        var idx = countyPlaceIndex(d);
        countyLayer.eachLayer(function (layer) {
            var key = layer._dashCountyKey || '';
            var cityId = layer._dashCityId || '';
            var hit = (key && idx.byKey[key]) || (cityId && idx.byCity[String(cityId)]) || null;
            var val = hit ? hit.value : 0;
            layer.setStyle({
                color: '#163524',
                weight: 1.2,
                fillColor: countyColorFor(val, idx.max || 1),
                fillOpacity: 0.78
            });
            var raw = featCountyName(layer.feature);
            var label = countyDisplayName(raw) || layer._dashCountyLabel || '';
            if (label) layer.bindTooltip(countyTooltip(label, hit), { sticky: true, direction: 'center', opacity: 0.9 });
        });
    }
    function renderCountyMap(d, gj) {
        if (!hasLeaflet() || !map) return;
        if (countyLayer) {
            try { map.removeLayer(countyLayer); } catch (e) {}
            countyLayer = null;
        }
        if (markers) markers.clearLayers();
        else markers = L.layerGroup().addTo(map);

        var cityByKey = {};
        (d.cities || []).forEach(function (c) {
            cityByKey[normFa(c.city)] = c;
        });
        var idx = countyPlaceIndex(d);
        var matched = {};

        countyLayer = L.geoJSON(gj, {
            filter: function (feat) {
                var t = feat && feat.geometry ? feat.geometry.type : '';
                return t === 'Polygon' || t === 'MultiPolygon';
            },
            style: {
                color: '#163524',
                weight: 1.2,
                fillColor: '#DDD3BE',
                fillOpacity: 0.78
            },
            onEachFeature: function (feat, layer) {
                var raw = featCountyName(feat);
                var label = countyDisplayName(raw);
                if (!label) return;
                var key = normFa(label);
                var city = cityByKey[key];
                var hit = idx.byKey[key] || (city && idx.byCity[String(city.id_city)]) || null;
                var center = layerCentroid(layer);
                layer._dashCountyKey = key;
                layer._dashCountyLabel = label;
                if (city) {
                    matched[key] = true;
                    layer._dashCityId = String(city.id_city);
                    layer.on('click', function () {
                        load({ id_ostan: d.id_ostan, id_city: city.id_city, id_mar: '' });
                    });
                    if (layer._path) layer._path.style.cursor = 'pointer';
                }
                layer.setStyle({
                    color: '#163524',
                    weight: 1.2,
                    fillColor: countyColorFor(hit ? hit.value : 0, idx.max || 1),
                    fillOpacity: 0.78
                });
                layer.bindTooltip(countyTooltip(label, hit), { sticky: true, direction: 'center', opacity: 0.9 });
                if (center) {
                    addMapLabel(center.lat, center.lng, label, false, null, false);
                }
            }
        }).addTo(map);

        var pending = [];
        (d.cities || []).forEach(function (c) {
            if (!matched[normFa(c.city)]) pending.push(c);
        });
        if (pending.length) {
            var pb = null;
            if (geoLayer) {
                geoLayer.eachLayer(function (layer) {
                    if (String(layer._dashId) === ostanId(d.id_ostan)) {
                        try { pb = layer.getBounds(); } catch (e) {}
                    }
                });
            }
            pending.forEach(function (c, i) {
                var lat = c.lat, lng = c.lng;
                if ((lat == null || lng == null) && pb) {
                    var sw = pb.getSouthWest();
                    var ne = pb.getNorthEast();
                    var cols = Math.ceil(Math.sqrt(pending.length));
                    var rows = Math.ceil(pending.length / cols);
                    var col = i % cols;
                    var row = Math.floor(i / cols);
                    lng = sw.lng + (ne.lng - sw.lng) * (col + 0.5) / cols;
                    lat = ne.lat - (ne.lat - sw.lat) * (row + 0.5) / rows;
                }
                addMapLabel(lat, lng, c.city, false, function () {
                    load({ id_ostan: d.id_ostan, id_city: c.id_city, id_mar: '' });
                }, true);
            });
        }

        try {
            if (countyLayer.getLayers().length) {
                map.fitBounds(countyLayer.getBounds(), { padding: [24, 24], maxZoom: 9 });
            }
        } catch (e) {}
    }
    function showCountyLayer(d) {
        clearCounties();
        if (markers) { markers.clearLayers(); }
        else if (hasLeaflet() && map) { markers = L.layerGroup().addTo(map); }
        if (!hasLeaflet() || !map || d.level !== 'ostan') return;
        var iso = isoForOstan(d);
        if (!iso) {
            drawMapNamesFallbackCities(d);
            return;
        }
        var req = countyReq;
        var url = GEO_COUNTY + iso + '_geo.json?v=20260904e';
        function applyGj(gj) {
            if (req !== countyReq) return;
            if (ostanId(state.id_ostan) !== ostanId(d.id_ostan) || state.level !== 'ostan') return;
            renderCountyMap(d, gj);
        }
        if (countyCache[iso]) {
            applyGj(countyCache[iso]);
            return;
        }
        $.getJSON(url).done(function (gj) {
            countyCache[iso] = gj;
            applyGj(gj);
        }).fail(function () {
            if (req !== countyReq) return;
            document.getElementById('dash-status').textContent =
                'مرز شهرستان‌ها برای این استان بارگذاری نشد (' + iso + '). فایل‌های assets/geo/counties را روی سرور بررسی کنید.';
            drawMapNamesFallbackCities(d);
        });
    }
    function drawMapNamesFallbackCities(d) {
        if (!hasLeaflet() || !map) return;
        if (markers) { markers.clearLayers(); }
        else { markers = L.layerGroup().addTo(map); }
        var cities = d.cities || [];
        var pb = null;
        if (geoLayer) {
            geoLayer.eachLayer(function (layer) {
                if (String(layer._dashId) === ostanId(d.id_ostan)) {
                    try { pb = layer.getBounds(); } catch (e) {}
                }
            });
        }
        var pending = 0;
        cities.forEach(function (c) {
            if (c.lat == null || c.lng == null) pending += 1;
        });
        var gi = 0;
        cities.forEach(function (c) {
            var lat = c.lat, lng = c.lng;
            if ((lat == null || lng == null) && pb) {
                var sw = pb.getSouthWest();
                var ne = pb.getNorthEast();
                var cols = Math.ceil(Math.sqrt(pending || cities.length));
                var rows = Math.ceil((pending || cities.length) / cols);
                var col = gi % cols;
                var row = Math.floor(gi / cols);
                gi += 1;
                lng = sw.lng + (ne.lng - sw.lng) * (col + 0.5) / cols;
                lat = ne.lat - (ne.lat - sw.lat) * (row + 0.5) / rows;
            }
            addMapLabel(lat, lng, c.city, false, function () {
                load({ id_ostan: d.id_ostan, id_city: c.id_city, id_mar: '' });
            }, true);
        });
    }
    function flagHtml(on) {
        return '<div class="dash-flag' + (on ? ' is-on' : '') + '">'
            + '<svg viewBox="0 0 32 40" aria-hidden="true">'
            + '<path d="M7 2 v36" stroke="#1E293B" stroke-width="2.2" fill="none"/>'
            + '<path class="flag-cloth" d="M9 3.5 h18 l-3.5 6.5 3.5 6.5 H9 z" fill="#DC2626"/>'
            + '<circle cx="7" cy="2.5" r="1.6" fill="#1E293B"/>'
            + '</svg></div>';
    }
    function addFlagMarker(lat, lng, name, on, go) {
        if (lat == null || lng == null) return null;
        var ic = L.divIcon({
            className: 'dash-flag-icon',
            html: flagHtml(on),
            iconSize: [32, 40],
            iconAnchor: [16, 40]
        });
        var m = L.marker([lat, lng], { icon: ic, title: name, riseOnHover: true });
        m.bindTooltip(escHtml(toFaDigits(name)), {
            className: 'dash-flag-tip',
            direction: 'top',
            offset: [0, -40],
            opacity: 1,
            sticky: false
        });
        if (go) m.on('click', go);
        markers.addLayer(m);
        return m;
    }
    function drawMapNames(d) {
        if (!hasLeaflet() || !map) return;
        if (d.level === 'ostan') {
            showCountyLayer(d);
            return;
        }
        clearCounties();
        if (markers) { markers.clearLayers(); }
        else { markers = L.layerGroup().addTo(map); }
        var pts = [];
        if (d.level === 'city' || d.level === 'mar') {
            var centers = d.centers || [];
            var cb = null;
            if (geoLayer) {
                geoLayer.eachLayer(function (layer) {
                    if (String(layer._dashId) === ostanId(d.id_ostan)) {
                        try { cb = layer.getBounds(); } catch (e) {}
                    }
                });
            }
            var cpend = 0;
            centers.forEach(function (c) {
                if (c.lat == null || c.lng == null) cpend += 1;
            });
            var cj = 0;
            centers.forEach(function (c) {
                var lat = c.lat, lng = c.lng;
                if ((lat == null || lng == null) && cb) {
                    var sw = cb.getSouthWest();
                    var ne = cb.getNorthEast();
                    var cols = Math.ceil(Math.sqrt(cpend || centers.length));
                    var rows = Math.ceil((cpend || centers.length) / cols);
                    var col = cj % cols;
                    var row = Math.floor(cj / cols);
                    cj += 1;
                    lng = sw.lng + (ne.lng - sw.lng) * (col + 0.5) / cols;
                    lat = ne.lat - (ne.lat - sw.lat) * (row + 0.5) / rows;
                }
                var label = c.m_name || c.mar;
                addFlagMarker(lat, lng, label, String(c.id_mar) === String(d.id_mar), function () {
                    load({ id_ostan: d.id_ostan, id_city: d.id_city, id_mar: c.id_mar });
                });
                if (lat != null && lng != null) pts.push([lat, lng]);
            });
        }
        if (pts.length && (d.level === 'city' || d.level === 'mar')) {
            map.fitBounds(pts, { padding: [48, 48], maxZoom: 12 });
        }
    }
    function apply(d) {
        last = d;
        state.level = d.level;
        state.id_ostan = d.id_ostan || '';
        state.id_city = d.id_city || '';
        state.id_mar = d.id_mar || '';
        if (d.year) state.year = d.year;
        if (d.catalog) setCatalog(d.catalog);
        (d.provinces || []).forEach(function (p) { nameIndex[p.name_key] = p; });
        var ysel = document.getElementById('dash-year');
        if (d.year) ysel.value = String(d.year);
        state.force_ostan = d.force_ostan || state.force_ostan || FORCE_OSTAN || '';
        var osel = document.getElementById('dash-ostan');
        if (state.force_ostan) {
            var forceLabel = '';
            (d.crumb || []).forEach(function (c) {
                if (c.level === 'ostan') forceLabel = c.label;
            });
            if (!forceLabel) {
                (d.provinces || []).forEach(function (p) {
                    if (ostanId(p.id_ostan) === ostanId(state.force_ostan)) forceLabel = p.ostan;
                });
            }
            osel.innerHTML = '';
            var fo = document.createElement('option');
            fo.value = state.force_ostan;
            fo.textContent = toFaDigits(forceLabel || state.force_ostan);
            osel.appendChild(fo);
            osel.value = state.force_ostan;
            osel.disabled = true;
        } else if (d.provinces && d.provinces.length && osel.options.length < 2) {
            d.provinces.forEach(function (p) {
                var o = document.createElement('option');
                o.value = p.id_ostan;
                o.textContent = toFaDigits(p.ostan);
                osel.appendChild(o);
            });
            osel.value = d.id_ostan || '';
        } else {
            osel.value = d.id_ostan || '';
        }
        if (!document.getElementById('dash-group').options.length || document.getElementById('dash-group').options.length < 2) {
            fillGroups();
        }
        document.getElementById('dash-group').value = state.group_cod || '';
        fillProducts();
        document.querySelectorAll('[data-water]').forEach(function (b) {
            b.classList.toggle('is-on', b.getAttribute('data-water') === state.water);
        });
        document.querySelectorAll('[data-metric]').forEach(function (b) {
            b.classList.toggle('is-on', b.getAttribute('data-metric') === state.metric);
        });
        setKpi();
        renderCrumb(d);
        renderPlaces(d);
        renderRank(d);
        setTiles(d.level === 'city' || d.level === 'mar');
        paintGeo(d);
        drawMapNames(d);
        syncHome();
        var bits = [];
        if (d.missing_prod) bits.push('جدول کشت این سال در دسترس نیست.');
        if (d.missing_plan) bits.push('جدول الگوی کشت این سطح موجود نیست.');
        var hints = {
            country: 'برای دیدن جزئیات استان، روی نقشه یا فهرست رتبه کلیک کنید.',
            ostan: 'شهرستان را از فهرست یا رتبه انتخاب کنید.',
            city: 'مرکز جهاد را از فهرست انتخاب کنید.',
            mar: 'آمار این مرکز با فیلتر محصول به‌روز شد.'
        };
        document.getElementById('dash-status').textContent = bits.length ? bits.join(' ') : (hints[d.level] || '');
        if (d.data_source === 'live') state.wantLive = false;
        renderSourceBar(d);
    }
    function load(q) {
        q = q || {};
        if (q.id_ostan != null) state.id_ostan = q.id_ostan;
        if (q.id_city != null) state.id_city = q.id_city;
        if (q.id_mar != null) state.id_mar = q.id_mar;
        if (q.live) state.wantLive = true;
        if (q.id_ostan) state.wantLive = false;
        var year = document.getElementById('dash-year').value || state.year || '';
        var live = (state.wantLive && !state.id_ostan) ? '1' : '';
        busy(true);
        dashApi({
            action: 'stats',
            year: year,
            id_ostan: state.id_ostan || '',
            id_city: state.id_city || '',
            id_mar: state.id_mar || '',
            group_cod: state.group_cod || '',
            product_cod: state.product_cod || '',
            water: state.water || 'all',
            live: live
        }).done(function (d) {
            if (dashNeedLogin(d)) return;
            if (d && d.ok) apply(d);
            else document.getElementById('dash-status').textContent = 'بارگذاری آمار انجام نشد.';
        }).fail(function () {
            document.getElementById('dash-status').textContent = 'ارتباط با سرور برقرار نشد.';
        }).always(function () { busy(false); });
    }
    function initMap(first) {
        if (!hasLeaflet()) {
            apply(first);
            document.getElementById('dash-status').textContent = 'نقشه بارگذاری نشد. از فهرست استان‌ها استفاده کنید.';
            busy(false);
            return;
        }
        map = L.map('dash-map', { zoomControl: true, attributionControl: false }).setView([32.4, 53.6], 5);
        $.getJSON(GEO).done(function (gj) {
            geoLayer = L.geoJSON(gj, {
                style: { color: '#1F6B45', weight: 1, fillColor: '#C9A227', fillOpacity: 0.7 },
                onEachFeature: function (feat, layer) {
                    var props = feat.properties || {};
                    var n = props.name;
                    var oid = ostanId(props.id_ostan);
                    layer.bindTooltip(toFaDigits(n), { sticky: true });
                    layer.on('click', function () {
                        var id = oid;
                        if (!id) {
                            var rec = nameIndex[normFa(n)];
                            if (rec) id = ostanId(rec.id_ostan);
                        }
                        if (id) {
                            if (state.force_ostan && ostanId(id) !== ostanId(state.force_ostan)) return;
                            load({ id_ostan: id, id_city: '', id_mar: '' });
                        }
                    });
                }
            }).addTo(map);
            apply(first);
            setTimeout(function () { if (map) map.invalidateSize(); scheduleFit(); }, 250);
        }).fail(function () {
            apply(first);
            document.getElementById('dash-status').textContent = 'فایل نقشه استان‌ها بارگذاری نشد.';
        }).always(function () { busy(false); });
    }

    document.getElementById('dash-year').addEventListener('change', function () {
        state.wantLive = false;
        load({});
    });
    document.getElementById('dash-ostan').addEventListener('change', function () {
        state.wantLive = false;
        load({ id_ostan: this.value, id_city: '', id_mar: '' });
    });
    document.getElementById('dash-group').addEventListener('change', function () {
        state.group_cod = this.value;
        state.product_cod = '';
        fillProducts();
        load({});
    });
    document.getElementById('dash-product').addEventListener('change', function () {
        state.product_cod = this.value;
        load({});
    });
    document.querySelectorAll('[data-water]').forEach(function (b) {
        b.addEventListener('click', function () {
            state.water = b.getAttribute('data-water') || 'all';
            load({});
        });
    });
    document.querySelectorAll('[data-metric]').forEach(function (b) {
        b.addEventListener('click', function () {
            state.metric = b.getAttribute('data-metric') || 'plant';
            document.querySelectorAll('[data-metric]').forEach(function (x) {
                x.classList.toggle('is-on', x.getAttribute('data-metric') === state.metric);
            });
            if (last) { renderRank(last); paintGeo(last, true); styleCountyLayer(last); }
        });
    });
    window.addEventListener('resize', scheduleFit);

    var liveBtn = document.getElementById('dash-live-btn');
    if (liveBtn) {
        liveBtn.addEventListener('click', function () {
            liveBtn.disabled = true;
            load({ live: true });
        });
    }

    var homeBtn = document.getElementById('dash-home');
    if (homeBtn) {
        homeBtn.addEventListener('click', goHome);
    }

    busy(true);
    $.when(
        $.getJSON(GEO_ISO).then(function (m) {
            ostanIso = {};
            Object.keys(m || {}).forEach(function (k) {
                ostanIso[normFa(k)] = m[k];
            });
        }, function () { ostanIso = {}; }),
        dashApi({
            action: 'stats',
            year: state.year || '',
            id_ostan: state.id_ostan || '',
            id_city: state.id_city || '',
            id_mar: state.id_mar || '',
            group_cod: state.group_cod || '',
            product_cod: state.product_cod || '',
            water: state.water || 'all'
        })
    ).done(function (_iso, statsArgs) {
        var d = statsArgs[0];
        if (dashNeedLogin(d)) return;
        if (!d || !d.ok) {
            busy(false);
            document.getElementById('dash-status').textContent = 'بارگذاری اولیه انجام نشد.';
            return;
        }
        (d.provinces || []).forEach(function (p) { nameIndex[p.name_key] = p; });
        initMap(d);
    }).fail(function () {
        busy(false);
        document.getElementById('dash-status').textContent = 'ارتباط با سرور برقرار نشد.';
    });
})();
</script>
</body>
</html>
