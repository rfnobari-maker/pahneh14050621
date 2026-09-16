<?php
/**
 * داشبورد بازدید کاربران
 * chief: 0 معاون وزیر | 2 رئیس سازمان | 3 ستاد | 31 باغبانی | 32 زراعت
 */
include('../lock_cp.php');
header('Content-Type: text/html; charset=utf-8');

$config_file = $_SERVER['DOCUMENT_ROOT'].'/login/config.php';
if (!is_file($config_file)) {
    echo 'فایل اتصال پیدا نشد: ' . htmlspecialchars($config_file);
    exit;
}
include($config_file);

if (empty($_SESSION['login_user'])) {
    header('Location: /login/cpis.php');
    exit;
}

date_default_timezone_set('Asia/Tehran');

function jalali_from_gregorian($gy, $gm, $gd) {
    $g_d_m = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
    $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
    $days = 355666 + (365 * $gy) + (int)(($gy2 + 3) / 4) - (int)(($gy2 + 99) / 100)
          + (int)(($gy2 + 399) / 400) + $gd + $g_d_m[$gm - 1];
    $jy = -1595 + (33 * (int)($days / 12053));
    $days %= 12053;
    $jy += 4 * (int)($days / 1461);
    $days %= 1461;
    if ($days > 365) {
        $jy += (int)(($days - 1) / 365);
        $days = ($days - 1) % 365;
    }
    if ($days < 186) {
        $jm = 1 + (int)($days / 31);
        $jd = 1 + ($days % 31);
    } else {
        $jm = 7 + (int)(($days - 186) / 30);
        $jd = 1 + (($days - 186) % 30);
    }
    return array($jy, $jm, $jd);
}

function jalali_today() {
    $t = jalali_from_gregorian((int)date('Y'), (int)date('n'), (int)date('j'));
    return sprintf('%04d/%02d/%02d', $t[0], $t[1], $t[2]);
}

function jalali_to_gregorian($jy, $jm, $jd) {
    $jy += 1595;
    $days = -355668 + (365 * $jy) + ((int)($jy / 33)) * 8 + (int)((($jy % 33) + 3) / 4) + $jd
          + (($jm < 7) ? ($jm - 1) * 31 : (($jm - 7) * 30) + 186);
    $gy = 400 * (int)($days / 146097);
    $days %= 146097;
    if ($days > 36524) {
        $gy += 100 * (int)(--$days / 36524);
        $days %= 36524;
        if ($days >= 365) $days++;
    }
    $gy += 4 * (int)($days / 1461);
    $days %= 1461;
    if ($days > 365) {
        $gy += (int)(($days - 1) / 365);
        $days = ($days - 1) % 365;
    }
    $gd = $days + 1;
    $sal_a = array(0, 31, (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    for ($gm = 1; $gm <= 12 && $gd > $sal_a[$gm]; $gm++) {
        $gd -= $sal_a[$gm];
    }
    return array($gy, $gm, $gd);
}

function jalali_add_days($jdate, $delta) {
    $p = explode('/', $jdate);
    $g = jalali_to_gregorian((int)$p[0], (int)$p[1], (int)$p[2]);
    $ts = mktime(12, 0, 0, $g[1], $g[2], $g[0]) + ($delta * 86400);
    $j = jalali_from_gregorian((int)date('Y', $ts), (int)date('n', $ts), (int)date('j', $ts));
    return sprintf('%04d/%02d/%02d', $j[0], $j[1], $j[2]);
}

function norm_jdate($s) {
    $s = trim(str_replace(array('-', '\\'), '/', (string)$s));
    if (preg_match('#(\d{4})/(\d{1,2})/(\d{1,2})#', $s, $m)) {
        return sprintf('%04d/%02d/%02d', (int)$m[1], (int)$m[2], (int)$m[3]);
    }
    return $s;
}

function norm_chief($v) {
    $v = trim((string)$v);
    if ($v === '' || strcasecmp($v, 'null') === 0) return 'none';
    if (is_numeric($v)) return (string)((int)$v);
    return $v;
}

function h($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

function to_utf8($s) {
    if (!is_string($s) || $s === '') return $s;
    if (function_exists('mb_check_encoding') && mb_check_encoding($s, 'UTF-8') && @preg_match('//u', $s)) return $s;
    if (function_exists('mb_convert_encoding')) {
        $t = @mb_convert_encoding($s, 'UTF-8', 'UTF-8,Windows-1256,ISO-8859-1');
        if ($t !== false && $t !== '') return $t;
    }
    return utf8_encode($s);
}

function utf8ize($d) {
    if (is_array($d)) {
        $o = array();
        foreach ($d as $k => $v) {
            $nk = is_string($k) ? to_utf8($k) : $k;
            $o[$nk] = utf8ize($v);
        }
        return $o;
    }
    if (is_string($d)) return to_utf8($d);
    return $d;
}

function svg_area_ltr($hourly) {
    $maxH = 1;
    foreach ($hourly as $hr) if ((int)$hr['c'] > $maxH) $maxH = (int)$hr['c'];
    $n = count($hourly);
    if ($n < 1) return '';
    $W = 680; $H = 240; $pL = 48; $pR = 18; $pT = 28; $pB = 38;
    $pts = array();
    for ($i = 0; $i < $n; $i++) {
        $x = $pL + ($W - $pL - $pR) * ($n === 1 ? 0 : $i / ($n - 1));
        $y = $pT + ($H - $pT - $pB) * (1 - ((int)$hourly[$i]['c'] / $maxH));
        $pts[] = array($x, $y);
    }
    $path = 'M '.round($pts[0][0],1).' '.round($pts[0][1],1);
    for ($i = 0; $i < $n - 1; $i++) {
        $x0 = $pts[$i][0]; $y0 = $pts[$i][1];
        $x1 = $pts[$i+1][0]; $y1 = $pts[$i+1][1];
        $cx = ($x0 + $x1) / 2;
        $path .= ' C '.round($cx,1).' '.round($y0,1).', '.round($cx,1).' '.round($y1,1).', '.round($x1,1).' '.round($y1,1);
    }
    $last = $pts[$n-1];
    $area = $path.' L '.round($last[0],1).' '.($H-$pB).' L '.$pL.' '.($H-$pB).' Z';
    $out = '<svg viewBox="0 0 '.$W.' '.$H.'" preserveAspectRatio="none" direction="ltr">';
    $out .= '<text x="14" y="'.($H/2).'" font-size="12" fill="#64748b" transform="rotate(-90 14 '.($H/2).')" text-anchor="middle">تعداد بازدید</text>';
    $gy = 4;
    for ($g = 0; $g <= $gy; $g++) {
        $yy = $pT + ($H-$pT-$pB) * $g / $gy;
        $val = (int)round($maxH * (1 - $g / $gy));
        $out .= '<line x1="'.$pL.'" y1="'.$yy.'" x2="'.($W-$pR).'" y2="'.$yy.'" stroke="#eef2f6"/>';
        $out .= '<text x="'.($pL-6).'" y="'.($yy+4).'" text-anchor="end" font-size="11" fill="#94a3b8">'.$val.'</text>';
    }
    $out .= '<path d="'.$area.'" fill="url(#ag)"/>';
    $out .= '<path d="'.$path.'" fill="none" stroke="#2b7bb9" stroke-width="2.6" stroke-linecap="round"/>';
    foreach ($pts as $i => $p) {
        $c = (int)$hourly[$i]['c'];
        $out .= '<circle cx="'.round($p[0],1).'" cy="'.round($p[1],1).'" r="3.4" fill="#fff" stroke="#2b7bb9" stroke-width="2"/>';
        $ly = $p[1] - 10;
        if ($ly < 12) $ly = $p[1] + 16;
        $out .= '<text x="'.round($p[0],1).'" y="'.round($ly,1).'" text-anchor="middle" font-size="12" font-weight="700" fill="#1e293b">'.$c.'</text>';
        if ($i % 2 === 0 || $i === $n - 1) {
            $out .= '<text x="'.round($p[0],1).'" y="'.($H-16).'" text-anchor="middle" font-size="12" fill="#475569">'.(int)$hourly[$i]['h'].'</text>';
        }
    }
    $out .= '<text x="'.($W/2).'" y="'.($H-3).'" text-anchor="middle" font-size="12" fill="#64748b">ساعت</text>';
    $out .= '<defs><linearGradient id="ag" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#2b7bb9" stop-opacity=".28"/><stop offset="100%" stop-color="#2b7bb9" stop-opacity=".03"/></linearGradient></defs>';
    $out .= '</svg>';
    return $out;
}

function svg_alluvial($days, $users, $colors) {
    $nD = count($days);
    $nU = count($users);
    if ($nD < 1 || $nU < 1) return '';
    $W = 720; $H = 380;
    $pT = 8; $pB = 42; $pL = 8; $pR = 8;
    $nodeW = 44;
    $gap = ($nD > 1) ? ($W - $pL - $pR - $nD * $nodeW) / ($nD - 1) : 0;
    $avail = $H - $pT - $pB;
    $maxTot = 1;
    for ($d = 0; $d < $nD; $d++) {
        $s = 0;
        for ($u = 0; $u < $nU; $u++) $s += isset($users[$u]['values'][$d]) ? (int)$users[$u]['values'][$d] : 0;
        if ($s > $maxTot) $maxTot = $s;
    }
    $x = array();
    $y0 = array(); $y1 = array();
    for ($d = 0; $d < $nD; $d++) {
        $x[$d] = $pL + $d * ($nodeW + $gap);
        $y = $pT;
        for ($u = 0; $u < $nU; $u++) {
            $v = isset($users[$u]['values'][$d]) ? (int)$users[$u]['values'][$d] : 0;
            $hgt = $avail * $v / $maxTot;
            $y0[$d][$u] = $y;
            $y1[$d][$u] = $y + $hgt;
            $y += $hgt;
        }
    }
    $out = '<svg viewBox="0 0 '.$W.' '.$H.'" preserveAspectRatio="none" direction="ltr">';
    for ($d = 0; $d < $nD - 1; $d++) {
        $x1 = $x[$d] + $nodeW;
        $x2 = $x[$d + 1];
        $cx = ($x1 + $x2) / 2;
        for ($u = 0; $u < $nU; $u++) {
            $a0 = $y0[$d][$u]; $a1 = $y1[$d][$u];
            $b0 = $y0[$d+1][$u]; $b1 = $y1[$d+1][$u];
            if (($a1 - $a0) < 1 && ($b1 - $b0) < 1) continue;
            $col = $colors[$u % count($colors)];
            $p = 'M '.$x1.' '.$a0.' C '.$cx.' '.$a0.', '.$cx.' '.$b0.', '.$x2.' '.$b0
               .' L '.$x2.' '.$b1.' C '.$cx.' '.$b1.', '.$cx.' '.$a1.', '.$x1.' '.$a1.' Z';
            $out .= '<path class="flow-u" data-u="'.$u.'" d="'.$p.'" fill="'.$col.'" fill-opacity="0.8"/>';
        }
    }
    for ($d = 0; $d < $nD; $d++) {
        for ($u = 0; $u < $nU; $u++) {
            $hgt = $y1[$d][$u] - $y0[$d][$u];
            if ($hgt < 1) continue;
            $v = (int)$users[$u]['values'][$d];
            $col = $colors[$u % count($colors)];
            $out .= '<rect class="flow-u" data-u="'.$u.'" x="'.$x[$d].'" y="'.$y0[$d][$u].'" width="'.$nodeW.'" height="'.$hgt.'" rx="3" fill="'.$col.'"/>';
            if ($v > 0 && $hgt >= 18) {
                $out .= '<text class="flow-u" data-u="'.$u.'" x="'.($x[$d]+$nodeW/2).'" y="'.($y0[$d][$u]+$hgt/2+6).'" text-anchor="middle" font-size="16" fill="#fff" font-weight="700">'.$v.'</text>';
            } elseif ($v > 0) {
                $out .= '<text class="flow-u" data-u="'.$u.'" x="'.($x[$d]+$nodeW/2).'" y="'.($y0[$d][$u]+$hgt/2+5).'" text-anchor="middle" font-size="13" fill="#fff" font-weight="700">'.$v.'</text>';
            }
        }
        $out .= '<text x="'.($x[$d]+$nodeW/2).'" y="'.($H-14).'" text-anchor="middle" font-size="15" fill="#1e293b" font-weight="700">'.h($days[$d]).'</text>';
    }
    $out .= '</svg>';
    return $out;
}

function svg_donut($share, $colors) {
    $total = 0;
    foreach ($share as $s) $total += (int)$s['c'];
    if ($total < 1) return '';
    $cx = 90; $cy = 90; $r = 58; $sw = 22;
    $c = 2 * M_PI * $r;
    $off = 0;
    $out = '<svg viewBox="0 0 180 180" class="donut">';
    $out .= '<circle cx="'.$cx.'" cy="'.$cy.'" r="'.$r.'" fill="none" stroke="#eef2f6" stroke-width="'.$sw.'"/>';
    $i = 0;
    foreach ($share as $s) {
        $len = $c * ((int)$s['c'] / $total);
        $col = $colors[$i % count($colors)];
        $out .= '<circle cx="'.$cx.'" cy="'.$cy.'" r="'.$r.'" fill="none" stroke="'.$col.'" stroke-width="'.$sw.'"'
             .' stroke-dasharray="'.round($len,2).' '.round($c-$len,2).'"'
             .' stroke-dashoffset="'.round(-$off,2).'" transform="rotate(-90 '.$cx.' '.$cy.')" stroke-linecap="butt"/>';
        $off += $len;
        $i++;
    }
    $out .= '<text x="'.$cx.'" y="'.($cy+5).'" text-anchor="middle" font-size="18" fill="#1e293b" font-weight="700">'.($total>0?round(100*((int)$share[0]['c']/$total)):0).'%</text>';
    $out .= '</svg>';
    return $out;
}

$CHIEF_LABELS = array(
    '0'    => 'معاونین وزیر',
    '2'    => 'رؤسای سازمان‌ها',
    '3'    => 'همکاران ستادی',
    '31'   => 'ستادی معاونت باغبانی',
    '32'   => 'ستادی معاونت زراعت',
    'none' => 'سایر / بدون گروه',
);
$PAL = array('#3b82f6','#f59e0b','#8b5cf6','#e11d48','#10b981','#6366f1','#14b8a6','#fb7185');

$jnow = jalali_from_gregorian((int)date('Y'), (int)date('n'), (int)date('j'));
$today = sprintf('%04d/%02d/%02d', $jnow[0], $jnow[1], $jnow[2]);
$yesterday = jalali_add_days($today, -1);
$year = '1405';
$month = isset($_POST['month']) ? str_pad(preg_replace('/\D/', '', $_POST['month']), 2, '0', STR_PAD_LEFT) : sprintf('%02d', $jnow[1]);
$allChiefs = array('0', '2', '3', '31', '32', 'none');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['chief'])) {
    $chiefs = array();
    foreach ((array)$_POST['chief'] as $v) $chiefs[] = (string)$v;
    $allowed = array();
    foreach ($allChiefs as $id) $allowed[$id] = true;
    $chiefs = array_values(array_filter($chiefs, function ($id) use ($allowed) {
        return isset($allowed[$id]);
    }));
    if (count($chiefs) === 0) $chiefs = $allChiefs;
} else {
    $chiefs = $allChiefs;
}

$err = '';
$data = array(
    'last_update' => '—',
    'kpi_today' => 0,
    'kpi_yesterday' => 0,
    'kpi_today_label' => 'تعداد کاربران لاگین شده روز جاری',
    'kpi_yesterday_label' => 'تعداد کاربران لاگین شده روز گذشته',
    'hourly' => array(),
    'active' => array(),
    'trend_days' => array(),
    'trend_users' => array(),
    'share' => array(),
    'debug' => '',
    'month_total' => 0,
);
for ($h = 6; $h <= 21; $h++) $data['hourly'][] = array('h' => $h, 'c' => 0);

if (!isset($dbh) || !($dbh instanceof PDO)) {
    $err = 'متغیر $dbh از نوع PDO در config.php پیدا نشد.';
} else {
    try {
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try { $dbh->exec("SET NAMES utf8"); } catch (Exception $e) {}

        $q = $dbh->query("SELECT date, time FROM Last_user ORDER BY id DESC LIMIT 1");
        $row = $q->fetch(PDO::FETCH_ASSOC);
        if ($row) $data['last_update'] = $row['date'] . '  ' . substr($row['time'], 0, 5);

        $st = $dbh->query("SELECT username, name, Last_name, chief FROM users WHERE S_access = 23 OR S_access = '23'");
        $users = $st->fetchAll(PDO::FETCH_ASSOC);
        $byCode = array();
        $codes = array();
        foreach ($users as $u) {
            $code = trim((string)$u['username']);
            $ch = norm_chief($u['chief']);
            if (!in_array((string)$ch, $chiefs, true)) continue;
            $nm = trim($u['name'] . ' ' . $u['Last_name']);
            if ($nm === '') $nm = $code;
            $byCode[$code] = array('name' => $nm, 'chief' => $ch);
            $codes[] = $code;
        }
        $data['debug'] = count($users).' کاربر / '.count($codes).' در فیلتر';

        if ($codes) {
            $place = implode(',', array_fill(0, count($codes), '?'));
            $prefix = $year . '/' . $month . '/%';
            $st = $dbh->prepare("SELECT date, time, PersName, PersCode FROM Last_user WHERE date LIKE ? AND PersCode IN ($place)");
            $st->execute(array_merge(array($prefix), $codes));
            $logs = $st->fetchAll(PDO::FETCH_ASSOC);
            $data['month_total'] = count($logs);
            $data['debug'] .= ' / '.count($logs).' ورود';

            $hours = array();
            for ($hh = 0; $hh <= 23; $hh++) $hours[$hh] = 0;
            $active = array(); $dayUser = array(); $share = array();
            $todaySet = array(); $yestSet = array(); $daysHit = array();

            foreach ($logs as $lg) {
                $code = trim((string)$lg['PersCode']);
                $name = isset($byCode[$code]) ? $byCode[$code]['name'] : $lg['PersName'];
                $ch = isset($byCode[$code]) ? $byCode[$code]['chief'] : 'none';
                $d = norm_jdate($lg['date']);
                $tm = trim((string)$lg['time']);
                $hh = (int)substr($tm, 0, 2);
                if ($d === $today) $todaySet[$code] = 1;
                if ($d === $yesterday) $yestSet[$code] = 1;
                if ($hh >= 0 && $hh <= 23) $hours[$hh]++;
                if (!isset($active[$code])) $active[$code] = array('name' => $name, 'c' => 0);
                $active[$code]['c']++;
                $daysHit[$d] = 1;
                if (!isset($dayUser[$d][$name])) $dayUser[$d][$name] = 0;
                $dayUser[$d][$name]++;
                $lab = isset($CHIEF_LABELS[$ch]) ? $CHIEF_LABELS[$ch] : $CHIEF_LABELS['none'];
                if (!isset($share[$lab])) $share[$lab] = 0;
                $share[$lab]++;
            }

            $data['kpi_today'] = count($todaySet);
            $data['kpi_yesterday'] = count($yestSet);
            if ($data['kpi_today'] === 0 && $data['kpi_yesterday'] === 0 && $daysHit) {
                ksort($daysHit);
                $dk = array_keys($daysHit);
                $lastD = $dk[count($dk) - 1];
                $prevD = (count($dk) >= 2) ? $dk[count($dk) - 2] : '';
                $todaySet = array(); $yestSet = array();
                foreach ($logs as $lg) {
                    $code = trim((string)$lg['PersCode']);
                    $d = norm_jdate($lg['date']);
                    if ($d === $lastD) $todaySet[$code] = 1;
                    if ($prevD !== '' && $d === $prevD) $yestSet[$code] = 1;
                }
                $data['kpi_today'] = count($todaySet);
                $data['kpi_yesterday'] = count($yestSet);
                $data['kpi_today_label'] = 'کاربران لاگین‌شده در '.$lastD;
                $data['kpi_yesterday_label'] = $prevD !== '' ? 'کاربران لاگین‌شده در '.$prevD : 'روز قبل در داده موجود نیست';
            }

            $hourly = array();
            $hStart = 6; $hEnd = 21;
            for ($hh = 0; $hh <= 5; $hh++) { if (!empty($hours[$hh])) { $hStart = 0; break; } }
            for ($hh = 22; $hh <= 23; $hh++) { if (!empty($hours[$hh])) { $hEnd = 23; break; } }
            for ($hh = $hStart; $hh <= $hEnd; $hh++) $hourly[] = array('h' => $hh, 'c' => $hours[$hh]);
            $data['hourly'] = $hourly;

            usort($active, function ($a, $b) { return $b['c'] - $a['c']; });
            $data['active'] = array_slice(array_values($active), 0, 10);

            ksort($daysHit);
            $trendDays = array_slice(array_keys($daysHit), -4);
            $data['trend_days'] = $trendDays;
            $userTotals = array();
            foreach ($trendDays as $d) {
                if (!isset($dayUser[$d])) continue;
                foreach ($dayUser[$d] as $nm => $c) {
                    if (!isset($userTotals[$nm])) $userTotals[$nm] = 0;
                    $userTotals[$nm] += $c;
                }
            }
            arsort($userTotals);
            foreach (array_slice(array_keys($userTotals), 0, 12) as $nm) {
                $vals = array();
                foreach ($trendDays as $d) $vals[] = isset($dayUser[$d][$nm]) ? $dayUser[$d][$nm] : 0;
                $data['trend_users'][] = array('name' => $nm, 'values' => $vals);
            }
            foreach ($share as $lab => $c) $data['share'][] = array('label' => $lab, 'c' => $c);
        }
    } catch (Exception $e) {
        $err = 'خطای پایگاه داده: ' . $e->getMessage();
    }
}

$years = array('1405');
$monthsFa = array('01'=>'فروردین','02'=>'اردیبهشت','03'=>'خرداد','04'=>'تیر','05'=>'مرداد','06'=>'شهریور','07'=>'مهر','08'=>'آبان','09'=>'آذر','10'=>'دی','11'=>'بهمن','12'=>'اسفند');
$self = htmlspecialchars($_SERVER['PHP_SELF']);
$data = utf8ize($data);
$monthTotal = (int)$data['month_total'];
$selNames = array();
foreach ($chiefs as $c) if (isset($CHIEF_LABELS[$c])) $selNames[] = $CHIEF_LABELS[$c];
$groupBtn = (count($chiefs) === count($allChiefs)) ? 'همه گروه‌ها' : implode('، ', $selNames);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>داشبورد بازدید کاربران</title>
<style>
:root {
    --bg:#e8edf2; --card:#fff; --ink:#1e293b; --muted:#64748b;
    --line:#e2e8f0; --accent:#2b7bb9; --soft:#d6eaf8; --navy:#2c3e50;
}
* { box-sizing:border-box; }
body { margin:0; background:var(--bg); color:var(--ink); font-family:Tahoma,"Vazirmatn",sans-serif; }
.page { max-width:1480px; margin:0 auto; padding:18px 22px 32px; }
.topbar { display:flex; justify-content:space-between; align-items:baseline; margin-bottom:14px; }
h1 { margin:0; font-size:21px; font-weight:700; letter-spacing:-.3px; }
.brand { color:var(--muted); font-size:12px; }
.pills { display:flex; flex-wrap:wrap; gap:6px; margin-bottom:8px; }
.pill {
    display:inline-block; padding:6px 13px; border-radius:8px; text-decoration:none;
    background:#fff; color:var(--ink); border:1px solid var(--line); font-size:13px;
    font-family:inherit; cursor:pointer;
}
.pill.on { background:var(--navy); color:#fff; border-color:var(--navy); }
.layout { display:grid; grid-template-columns:240px 300px minmax(0,1fr); grid-template-rows:auto auto; gap:14px; }
.side { grid-column:1; grid-row:1 / span 2; display:flex; flex-direction:column; gap:12px; }
.card { background:var(--card); border-radius:16px; padding:16px 18px; border:1px solid #eef2f5; }
.card h2 { margin:0 0 12px; font-size:14px; font-weight:700; color:#334155; }
.kpi { background:var(--soft); border-radius:14px; padding:18px 12px; text-align:center; }
.kpi .n { font-size:38px; font-weight:700; color:#1a5276; line-height:1; }
.kpi .l { font-size:12px; color:#334155; margin-top:8px; line-height:1.5; }
.meta { font-size:12px; color:var(--muted); }
.err { background:#fdecea; color:#c0392b; padding:10px 12px; border-radius:10px; margin-bottom:12px; }
.ltr { direction:ltr; }
.ltr svg { width:100%; height:240px; display:block; }
.flowbox { display:flex; align-items:stretch; gap:18px; }
.tleg { width:168px; flex-shrink:0; padding-top:2px; }
.tleg-h { font-size:12px; color:#64748b; font-weight:700; margin-bottom:8px; }
.flow { flex:1; min-width:0; direction:ltr; }
.flow svg { width:100%; height:380px; display:block; }
.hbar { display:flex; align-items:center; gap:10px; margin:8px 0; font-size:12px; }
.hbar .nm { width:118px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:#334155; }
.hbar .track { flex:1; background:#f1f5f9; border-radius:999px; height:11px; overflow:hidden; }
.hbar .fill { height:11px; background:linear-gradient(90deg,#5dade2,#2b7bb9); border-radius:999px; }
.hbar .c { width:28px; color:var(--muted); font-size:11px; }
.drop { position:relative; }
.drop-btn {
    width:100%; text-align:right; border:1px solid var(--line); background:#fff;
    border-radius:10px; padding:11px 12px; font-family:inherit; cursor:pointer; font-size:13px; color:var(--ink);
}
.drop-btn:focus-visible { outline:2px solid var(--accent); outline-offset:2px; }
.drop-list {
    display:none; position:absolute; right:0; left:0; top:100%; z-index:8;
    background:#fff; border:1px solid var(--line); border-radius:12px; margin-top:6px; padding:8px;
}
.drop.open .drop-list { display:block; }
.drop-list label { display:flex; gap:8px; align-items:center; padding:7px 8px; font-size:13px; cursor:pointer; border-radius:8px; min-height:36px; }
.drop-list label:hover { background:#f8fafc; }
.drop-list label:focus-within { outline:2px solid var(--accent); outline-offset:1px; }
.drop-tools { display:flex; gap:6px; margin-bottom:6px; padding-bottom:6px; border-bottom:1px solid var(--line); }
.drop-tools button, .drop-apply {
    flex:1; font-family:inherit; font-size:12px; padding:8px 8px; border-radius:8px;
    border:1px solid var(--line); background:#f8fafc; cursor:pointer; color:var(--ink); min-height:36px;
}
.drop-tools button:hover { background:#eef2f6; }
.drop-apply { width:100%; margin-top:6px; background:var(--navy); color:#fff; border-color:var(--navy); flex:none; }
.drop-apply:hover { filter:brightness(1.08); }
.tleg-item {
    display:flex; align-items:center; gap:8px; width:100%; margin:0; padding:6px 4px;
    border:0; background:none; font:inherit; font-size:12px; line-height:1.7; color:#1e293b;
    text-align:right; cursor:pointer; border-radius:8px; min-height:36px;
}
.tleg-item:hover { background:#f8fafc; }
.tleg-item:focus-visible { outline:2px solid var(--accent); outline-offset:1px; }
.tleg-item.is-on { font-weight:700; background:#eef6fb; }
.tleg-item.is-muted { opacity:.38; }
.tleg-item i { width:9px; height:9px; border-radius:50%; display:inline-block; flex-shrink:0; }
.flow svg .flow-u { transition: opacity .2s ease, fill-opacity .2s ease; }
.flow.is-focus .flow-u { opacity:.16; }
.flow.is-focus .flow-u.is-on { opacity:1; }
@media (prefers-reduced-motion: reduce) {
    .flow svg .flow-u { transition: none; }
}
.donut-row { display:flex; align-items:center; gap:8px; }
.donut { width:150px; height:150px; }
.dleg { font-size:12px; }
.dleg div { display:flex; align-items:center; gap:8px; margin:6px 0; }
.dleg i { width:10px; height:10px; border-radius:50%; display:inline-block; }
.card.trend-card { grid-column: 3; grid-row: 2; }
@media (max-width:1100px){ .layout{grid-template-columns:1fr;} .side{grid-column:1;grid-row:auto;} .card.trend-card{grid-column:1;grid-row:auto;} }
</style>
</head>
<body>
<div class="page">
    <div class="topbar">
        <div class="brand">طراحی و توسعه سامانه الگوی کشت</div>
        <h1>داشبورد بازدید کاربران</h1>
    </div>
    <?php if ($err): ?><div class="err"><?php echo h($err); ?></div><?php endif; ?>
    <form method="post" action="<?php echo $self; ?>">
    <input type="hidden" name="year" value="<?php echo h($year); ?>">
    <input type="hidden" name="month" value="<?php echo h($month); ?>">
    <div class="pills">
        <?php foreach ($years as $y): ?>
            <button type="submit" class="pill<?php echo $y===$year?' on':''; ?>" name="year" value="<?php echo h($y); ?>"><?php echo h($y); ?></button>
        <?php endforeach; ?>
    </div>
    <div class="pills">
        <?php foreach ($monthsFa as $num => $title): ?>
            <button type="submit" class="pill<?php echo $num===$month?' on':''; ?>" name="month" value="<?php echo h($num); ?>"><?php echo h($title); ?></button>
        <?php endforeach; ?>
    </div>

    <div class="layout">
        <aside class="side">
            <div class="card"><div class="meta">آخرین بروزرسانی : <?php echo h($data['last_update']); ?></div></div>
            <div class="kpi"><div class="n"><?php echo (int)$data['kpi_today']; ?></div><div class="l"><?php echo h($data['kpi_today_label']); ?></div></div>
            <div class="kpi"><div class="n"><?php echo (int)$data['kpi_yesterday']; ?></div><div class="l"><?php echo h($data['kpi_yesterday_label']); ?></div></div>
            <div class="card drop" id="groupDrop">
                <div class="meta" style="margin-bottom:8px" id="groupDropLabel">گروه کاربری</div>
                <button type="button" class="drop-btn" id="groupBtn" aria-expanded="false" aria-controls="groupList" aria-labelledby="groupDropLabel"><?php echo h($groupBtn); ?></button>
                <div class="drop-list" id="groupList" role="group" aria-labelledby="groupDropLabel">
                    <div class="drop-tools">
                        <button type="button" id="groupSelectAll">انتخاب همه</button>
                        <button type="button" id="groupClearAll">غیرفعال کردن همه</button>
                    </div>
                    <?php foreach ($CHIEF_LABELS as $cid => $clab): ?>
                        <label>
                            <input type="checkbox" name="chief[]" value="<?php echo h((string)$cid); ?>" <?php echo in_array((string)$cid, $chiefs, true) ? 'checked' : ''; ?>>
                            <?php echo h($clab); ?>
                        </label>
                    <?php endforeach; ?>
                    <button type="submit" class="drop-apply">اعمال</button>
                </div>
            </div>
        </aside>

        <div class="card">
            <h2>کاربران فعال</h2>
            <?php if (empty($data['active'])): ?>
                <div class="meta">در این بازه ورودی ثبت نشده است.</div>
            <?php else:
                $maxA = 1;
                foreach ($data['active'] as $a) if ((int)$a['c'] > $maxA) $maxA = (int)$a['c'];
                foreach ($data['active'] as $a):
                    $w = round(((int)$a['c']) * 100 / $maxA);
            ?>
                <div class="hbar"><div class="nm" title="<?php echo h($a['name']); ?>"><?php echo h($a['name']); ?></div><div class="track"><div class="fill" style="width:<?php echo $w; ?>%"></div></div><div class="c"><?php echo (int)$a['c']; ?></div></div>
            <?php endforeach; endif; ?>
        </div>

        <div class="card">
            <h2>تعداد بازدید در هر ساعت</h2>
            <div class="ltr"><?php echo svg_area_ltr($data['hourly']); ?></div>
        </div>

        <div class="card">
            <h2>سهم ورود بر اساس گروه کاربری</h2>
            <?php if (empty($data['share'])): ?>
                <div class="meta">داده‌ای برای سهم گروه نیست.</div>
            <?php else: ?>
            <div class="donut-row">
                <?php echo svg_donut($data['share'], $PAL); ?>
                <div class="dleg">
                    <?php $pi=0; $sumS=0; foreach ($data['share'] as $s) $sumS+=(int)$s['c']; if($sumS<1)$sumS=1;
                    foreach ($data['share'] as $s): $pct=round(((int)$s['c'])*100/$sumS); ?>
                    <div><i style="background:<?php echo $PAL[$pi%8]; ?>"></i><?php echo h($s['label']); ?> — <?php echo $pct; ?>%</div>
                    <?php $pi++; endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="card trend-card">
            <h2>روند بازدید کاربران</h2>
            <?php if (empty($data['trend_days']) || empty($data['trend_users'])): ?>
                <div class="meta">روندی برای نمایش نیست.</div>
            <?php else: ?>
            <div class="flowbox">
                <div class="flow" id="trendFlow"><?php echo svg_alluvial($data['trend_days'], $data['trend_users'], $PAL); ?></div>
                <div class="tleg" dir="rtl" id="trendLegend">
                    <div class="tleg-h">نام کاربر</div>
                    <?php foreach ($data['trend_users'] as $ui => $tu): ?>
                    <button type="button" class="tleg-item" data-u="<?php echo (int)$ui; ?>" aria-pressed="false">
                        <i style="background:<?php echo $PAL[$ui % 8]; ?>" aria-hidden="true"></i><?php echo h($tu['name']); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    </form>
</div>
<script>
(function(){
    var d = document.getElementById('groupDrop');
    var b = document.getElementById('groupBtn');
    var form = d ? (d.closest ? d.closest('form') : b.form) : null;
    var selectAll = document.getElementById('groupSelectAll');
    var clearAll = document.getElementById('groupClearAll');

    function boxes() {
        return d ? d.querySelectorAll('input[name="chief[]"]') : [];
    }
    function snapshot() {
        var list = boxes(), s = [], i;
        for (i = 0; i < list.length; i++) s.push(list[i].checked ? '1' : '0');
        return s.join('');
    }
    function setOpen(open) {
        if (!d || !b) return;
        if (open) d.classList.add('open');
        else d.classList.remove('open');
        b.setAttribute('aria-expanded', open ? 'true' : 'false');
    }
    function isSubmitControl(el) {
        if (!el) return false;
        var tag = el.tagName;
        if (tag === 'BUTTON' && el.type !== 'button') return true;
        if (tag === 'INPUT' && (el.type === 'submit' || el.type === 'image')) return true;
        return false;
    }
    if (d && b) {
        var initial = snapshot();
        b.onclick = function(e) {
            e.preventDefault();
            setOpen(!d.classList.contains('open'));
        };
        if (selectAll) {
            selectAll.onclick = function() {
                var list = boxes(), i;
                for (i = 0; i < list.length; i++) list[i].checked = true;
            };
        }
        if (clearAll) {
            clearAll.onclick = function() {
                var list = boxes(), i;
                for (i = 0; i < list.length; i++) list[i].checked = false;
            };
        }
        document.addEventListener('click', function(e) {
            if (!d.classList.contains('open') || d.contains(e.target)) return;
            setOpen(false);
            if (!form || snapshot() === initial || isSubmitControl(e.target)) return;
            form.submit();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key !== 'Escape' || !d.classList.contains('open')) return;
            var list = boxes(), bits = initial.split(''), i;
            for (i = 0; i < list.length; i++) list[i].checked = bits[i] === '1';
            setOpen(false);
            b.focus();
        });
    }

    var flow = document.getElementById('trendFlow');
    var items = document.querySelectorAll('#trendLegend .tleg-item');
    if (flow && items.length) {
        var current = null;
        function setFocus(idx) {
            var nodes = flow.querySelectorAll('.flow-u');
            var i, on;
            if (idx === null) {
                flow.classList.remove('is-focus');
                for (i = 0; i < nodes.length; i++) nodes[i].classList.remove('is-on');
                for (i = 0; i < items.length; i++) {
                    items[i].classList.remove('is-on');
                    items[i].classList.remove('is-muted');
                    items[i].setAttribute('aria-pressed', 'false');
                }
                current = null;
                return;
            }
            flow.classList.add('is-focus');
            for (i = 0; i < nodes.length; i++) {
                on = nodes[i].getAttribute('data-u') === String(idx);
                if (on) nodes[i].classList.add('is-on');
                else nodes[i].classList.remove('is-on');
            }
            for (i = 0; i < items.length; i++) {
                on = items[i].getAttribute('data-u') === String(idx);
                if (on) items[i].classList.add('is-on');
                else items[i].classList.remove('is-on');
                if (on) items[i].classList.remove('is-muted');
                else items[i].classList.add('is-muted');
                items[i].setAttribute('aria-pressed', on ? 'true' : 'false');
            }
            current = String(idx);
        }
        for (var i = 0; i < items.length; i++) {
            items[i].onclick = function() {
                var idx = this.getAttribute('data-u');
                if (current === idx) setFocus(null);
                else setFocus(idx);
            };
        }
    }
})();
</script>
</body>
</html>
