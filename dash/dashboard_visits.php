<?php
/**
 * داشبورد بازدید کاربران — لایهٔ دوم خانه (dash)
 * فایل Cpis/dashboard_visits دست نخورده است.
 */
require_once dirname(__FILE__) . '/auth.php';
require_once dirname(__FILE__) . '/lib.php';
require_once dirname(__FILE__) . '/account.php';
$dash_root = '../';
date_default_timezone_set('Asia/Tehran');

if (isset($_SERVER['REQUEST_METHOD']) && strtoupper((string) $_SERVER['REQUEST_METHOD']) === 'POST') {
    $parts = array();
    if (isset($_POST['hyear'])) {
        $parts['year'] = trim((string) $_POST['hyear']);
        if (!(isset($_POST['year']) && isset($_POST['month']))) {
            $parts['visits_year'] = '';
            $parts['visits_month'] = '';
            $parts['visits_grp'] = null;
        }
    }
    foreach (array('id_ostan', 'id_city', 'id_mar') as $gk) {
        if (isset($_POST[$gk])) {
            $parts[$gk] = trim((string) $_POST[$gk]);
        }
    }
    if (isset($_POST['year']) && isset($_POST['month'])) {
        $parts['visits_year'] = preg_replace('/\D/', '', (string) $_POST['year']);
        $parts['visits_month'] = str_pad(preg_replace('/\D/', '', (string) $_POST['month']), 2, '0', STR_PAD_LEFT);
        if (isset($_POST['grp'])) {
            $parts['visits_grp'] = $_POST['grp'];
        } else {
            $parts['visits_grp'] = array();
        }
    }
    dash_filter_session_set($parts);
    header('Location: dashboard_visits.php', true, 303);
    exit;
}

function dash_visits_level($id_ostan, $id_city, $id_mar)
{
    if ($id_mar !== '') {
        return 'mar';
    }
    if ($id_city !== '') {
        return 'city';
    }
    if ($id_ostan !== '') {
        return 'ostan';
    }
    return 'country';
}

function dash_visits_group_catalog($level)
{
    if ($level === 'country') {
        return array(
            '0' => array('label' => 'معاونین وزیر', 'mode' => 'chief'),
            '2' => array('label' => 'رؤسای سازمان‌ها', 'mode' => 'chief'),
            '3' => array('label' => 'همکاران ستادی', 'mode' => 'chief'),
            '31' => array('label' => 'ستادی معاونت باغبانی', 'mode' => 'chief'),
            '32' => array('label' => 'ستادی معاونت زراعت', 'mode' => 'chief'),
            'none' => array('label' => 'سایر / بدون گروه', 'mode' => 'chief'),
        );
    }
    $all = array(
        'sys' => array('label' => 'مدیریت سامانه', 'mode' => 'access', 'codes' => array('20', '4', '98', '99')),
        'moin' => array('label' => 'کارشناس معین', 'mode' => 'access', 'codes' => array('5')),
        'city' => array('label' => 'مدیر شهرستان', 'mode' => 'access', 'codes' => array('3')),
        'thematic' => array('label' => 'کارشناس موضوعی', 'mode' => 'access', 'codes' => array('6')),
        'center' => array('label' => 'رئیس مرکز', 'mode' => 'access', 'codes' => array('2')),
        'zone' => array('label' => 'کارشناس پهنه', 'mode' => 'access', 'codes' => array('1')),
    );
    if ($level === 'ostan') {
        return $all;
    }
    if ($level === 'city') {
        return array(
            'thematic' => $all['thematic'],
            'center' => $all['center'],
            'zone' => $all['zone'],
        );
    }
    return array('zone' => $all['zone']);
}

function dash_visits_gkey($u, $catalog)
{
    $acc = trim((string) $u['S_access']);
    foreach ($catalog as $key => $g) {
        if (isset($g['mode']) && $g['mode'] === 'access' && !empty($g['codes'])) {
            if (in_array($acc, $g['codes'], true) || in_array((string) ((int) $acc), $g['codes'], true)) {
                return (string) $key;
            }
        }
    }
    return 'none';
}

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

function dash_visits_fa($s)
{
    return strtr((string) $s, array(
        '0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴',
        '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹',
        ',' => '٬',
    ));
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
    $out = '<svg viewBox="0 0 '.$W.' '.$H.'" preserveAspectRatio="none" direction="ltr" font-family="YekanBakh, Tahoma, sans-serif">';
    $out .= '<text x="14" y="'.($H/2).'" font-size="12" fill="#4A5A51" transform="rotate(-90 14 '.($H/2).')" text-anchor="middle">تعداد بازدید</text>';
    $gy = 4;
    for ($g = 0; $g <= $gy; $g++) {
        $yy = $pT + ($H-$pT-$pB) * $g / $gy;
        $val = (int)round($maxH * (1 - $g / $gy));
        $out .= '<line x1="'.$pL.'" y1="'.$yy.'" x2="'.($W-$pR).'" y2="'.$yy.'" stroke="#DDD3BE"/>';
        $out .= '<text x="'.($pL-6).'" y="'.($yy+4).'" text-anchor="end" font-size="11" fill="#4A5A51">'.dash_visits_fa($val).'</text>';
    }
    $out .= '<path d="'.$area.'" fill="url(#ag)"/>';
    $out .= '<path d="'.$path.'" fill="none" stroke="#1F6B45" stroke-width="2.6" stroke-linecap="round"/>';
    foreach ($pts as $i => $p) {
        $c = (int)$hourly[$i]['c'];
        $out .= '<circle cx="'.round($p[0],1).'" cy="'.round($p[1],1).'" r="3.4" fill="#FFFCF6" stroke="#C9A227" stroke-width="2"/>';
        $ly = $p[1] - 10;
        if ($ly < 12) $ly = $p[1] + 16;
        $out .= '<text x="'.round($p[0],1).'" y="'.round($ly,1).'" text-anchor="middle" font-size="12" font-weight="700" fill="#14221A">'.dash_visits_fa($c).'</text>';
        if ($i % 2 === 0 || $i === $n - 1) {
            $out .= '<text x="'.round($p[0],1).'" y="'.($H-16).'" text-anchor="middle" font-size="12" fill="#4A5A51">'.dash_visits_fa((int)$hourly[$i]['h']).'</text>';
        }
    }
    $out .= '<text x="'.($W/2).'" y="'.($H-3).'" text-anchor="middle" font-size="12" fill="#4A5A51">ساعت</text>';
    $out .= '<defs><linearGradient id="ag" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#1F6B45" stop-opacity=".28"/><stop offset="100%" stop-color="#C9A227" stop-opacity=".03"/></linearGradient></defs>';
    $out .= '</svg>';
    return $out;
}

function dash_visits_chart_date($jdate)
{
    static $months = array(
        1 => 'فروردین', 2 => 'اردیبهشت', 3 => 'خرداد', 4 => 'تیر',
        5 => 'مرداد', 6 => 'شهریور', 7 => 'مهر', 8 => 'آبان',
        9 => 'آذر', 10 => 'دی', 11 => 'بهمن', 12 => 'اسفند',
    );
    $s = norm_jdate($jdate);
    if (preg_match('#^(\d{4})/(\d{1,2})/(\d{1,2})$#', $s, $m)) {
        $mon = (int) $m[2];
        return array(
            'day' => dash_visits_fa((int) $m[3]),
            'month' => isset($months[$mon]) ? $months[$mon] : dash_visits_fa($m[2]),
        );
    }
    return array('day' => dash_visits_fa($jdate), 'month' => '');
}

function dash_visits_trend_date_pcts($nD)
{
    $W = 720; $pL = 8; $pR = 8; $nodeW = 44;
    $gap = ($nD > 1) ? ($W - $pL - $pR - $nD * $nodeW) / ($nD - 1) : 0;
    $pcts = array();
    for ($d = 0; $d < $nD; $d++) {
        $x = $pL + $d * ($nodeW + $gap);
        $pcts[] = round(($x + $nodeW / 2) / $W * 100, 3);
    }
    return $pcts;
}

function dash_visits_spread_ys($ys, $minY, $maxY, $gap) {
    $n = count($ys);
    if ($n < 1) {
        return $ys;
    }
    $pass = 0;
    while ($pass < 12) {
        $i = 1;
        while ($i < $n) {
            if ($ys[$i] < $ys[$i - 1] + $gap) {
                $ys[$i] = $ys[$i - 1] + $gap;
            }
            $i++;
        }
        if ($ys[$n - 1] > $maxY) {
            $ys[$n - 1] = $maxY;
            $i = $n - 2;
            while ($i >= 0) {
                if ($ys[$i] > $ys[$i + 1] - $gap) {
                    $ys[$i] = $ys[$i + 1] - $gap;
                }
                $i--;
            }
        }
        if ($ys[0] < $minY) {
            $ys[0] = $minY;
            $i = 1;
            while ($i < $n) {
                if ($ys[$i] < $ys[$i - 1] + $gap) {
                    $ys[$i] = $ys[$i - 1] + $gap;
                }
                $i++;
            }
        }
        $pass++;
    }
    return $ys;
}

function dash_visits_pct_label($c, $total) {
    if ($total < 1) {
        return dash_visits_fa(0) . '٪';
    }
    $pct = round(((int) $c) * 1000 / $total) / 10;
    if ($pct <= 0 && (int) $c > 0) {
        return '<' . dash_visits_fa(1) . '٪';
    }
    if (abs($pct - round($pct)) < 0.05) {
        return dash_visits_fa((int) round($pct)) . '٪';
    }
    return dash_visits_fa(number_format($pct, 1, '.', '')) . '٪';
}

function svg_alluvial($days, $users, $colors) {
    $nD = count($days);
    $nU = count($users);
    if ($nD < 1 || $nU < 1) return '';
    $W = 720; $H = 440;
    $pT = 8; $pB = 10; $pL = 8; $pR = 8;
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
    $out = '<svg viewBox="0 0 '.$W.' '.$H.'" preserveAspectRatio="xMidYMid meet" overflow="visible" direction="ltr" font-family="YekanBakh, Tahoma, sans-serif">';
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
                $out .= '<text class="flow-u" data-u="'.$u.'" x="'.($x[$d]+$nodeW/2).'" y="'.($y0[$d][$u]+$hgt/2+6).'" text-anchor="middle" font-size="16" fill="#FFFCF6" font-weight="700">'.dash_visits_fa($v).'</text>';
            } elseif ($v > 0) {
                $out .= '<text class="flow-u" data-u="'.$u.'" x="'.($x[$d]+$nodeW/2).'" y="'.($y0[$d][$u]+$hgt/2+5).'" text-anchor="middle" font-size="13" fill="#FFFCF6" font-weight="700">'.dash_visits_fa($v).'</text>';
            }
        }
    }
    $out .= '</svg>';
    return $out;
}

function svg_donut($share, $colors) {
    $items = array();
    $total = 0;
    foreach ($share as $s) {
        $c = (int) $s['c'];
        if ($c > 0) {
            $items[] = $s;
            $total += $c;
        }
    }
    if ($total < 1 || !$items) {
        return '';
    }
    $nCol = count($colors);
    $W = 320;
    $H = 268;
    $cx = 160;
    $cy = 134;
    $r = 58;
    $sw = 26;
    $circ = 2 * M_PI * $r;
    $rOut = $r + ($sw / 2);
    $rBend = $rOut + 16;
    $minY = 16;
    $maxY = $H - 16;
    $gap = 18;

    $slices = array();
    $angle = -M_PI / 2;
    $off = 0;
    $i = 0;
    foreach ($items as $s) {
        $c = (int) $s['c'];
        $frac = $c / $total;
        $sweep = 2 * M_PI * $frac;
        $mid = $angle + ($sweep / 2);
        $len = $circ * $frac;
        $col = $colors[$i % $nCol];
        $side = (cos($mid) >= 0) ? 'right' : 'left';
        $ly = $cy + sin($mid) * $rBend;
        $slices[] = array(
            'len' => $len,
            'off' => $off,
            'mid' => $mid,
            'side' => $side,
            'ly' => $ly,
            'col' => $col,
            'pct' => dash_visits_pct_label($c, $total),
        );
        $angle += $sweep;
        $off += $len;
        $i++;
    }

    foreach (array('left', 'right') as $side) {
        $idx = array();
        foreach ($slices as $k => $sl) {
            if ($sl['side'] === $side) {
                $idx[] = $k;
            }
        }
        $n = count($idx);
        if ($n < 1) {
            continue;
        }
        $j = 0;
        while ($j < $n - 1) {
            $a = $idx[$j];
            $m = $j;
            $k = $j + 1;
            while ($k < $n) {
                if ($slices[$idx[$k]]['ly'] < $slices[$idx[$m]]['ly']) {
                    $m = $k;
                }
                $k++;
            }
            if ($m !== $j) {
                $tmp = $idx[$j];
                $idx[$j] = $idx[$m];
                $idx[$m] = $tmp;
            }
            $j++;
        }
        $ys = array();
        foreach ($idx as $k) {
            $ys[] = $slices[$k]['ly'];
        }
        $ys = dash_visits_spread_ys($ys, $minY, $maxY, $gap);
        foreach ($idx as $j => $k) {
            $slices[$k]['ly'] = $ys[$j];
        }
    }

    $out = '<svg viewBox="0 0 '.$W.' '.$H.'" class="donut" overflow="visible" font-family="YekanBakh, Tahoma, sans-serif" role="img" aria-hidden="true">';
    $out .= '<circle cx="'.$cx.'" cy="'.$cy.'" r="'.$r.'" fill="none" stroke="#DDD3BE" stroke-width="'.$sw.'"/>';
    foreach ($slices as $sl) {
        $out .= '<circle cx="'.$cx.'" cy="'.$cy.'" r="'.$r.'" fill="none" stroke="'.$sl['col'].'" stroke-width="'.$sw.'"'
             .' stroke-dasharray="'.round($sl['len'], 2).' '.round($circ - $sl['len'], 2).'"'
             .' stroke-dashoffset="'.round(-$sl['off'], 2).'" transform="rotate(-90 '.$cx.' '.$cy.')" stroke-linecap="butt"/>';
    }
    foreach ($slices as $sl) {
        $mid = $sl['mid'];
        $x1 = $cx + cos($mid) * $rOut;
        $y1 = $cy + sin($mid) * $rOut;
        $x2 = $cx + cos($mid) * $rBend;
        $y2 = $cy + sin($mid) * $rBend;
        $isRight = ($sl['side'] === 'right');
        $x3 = $isRight ? ($cx + $rBend + 10) : ($cx - $rBend - 10);
        $ly = $sl['ly'];
        $d = 'M '.round($x1, 1).' '.round($y1, 1)
           .' L '.round($x2, 1).' '.round($y2, 1)
           .' L '.round($x2, 1).' '.round($ly, 1)
           .' L '.round($x3, 1).' '.round($ly, 1);
        $out .= '<path d="'.$d.'" fill="none" stroke="'.$sl['col'].'" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>';
        $out .= '<circle cx="'.round($x1, 1).'" cy="'.round($y1, 1).'" r="2.4" fill="'.$sl['col'].'"/>';
        $anchor = $isRight ? 'start' : 'end';
        $tx = $isRight ? ($x3 + 5) : ($x3 - 5);
        $out .= '<text x="'.round($tx, 1).'" y="'.round($ly + 4, 1).'" text-anchor="'.$anchor.'" font-size="15" font-weight="800" fill="#14221A" stroke="#FFFCF6" stroke-width="3" paint-order="stroke fill">'.$sl['pct'].'</text>';
    }
    $out .= '<text x="'.$cx.'" y="'.($cy - 2).'" text-anchor="middle" font-size="20" font-weight="800" fill="#14221A">'.dash_visits_fa($total).'</text>';
    $out .= '<text x="'.$cx.'" y="'.($cy + 16).'" text-anchor="middle" font-size="11" font-weight="700" fill="#4A5A51">ورود</text>';
    $out .= '</svg>';
    return $out;
}

$PAL = array('#1F6B45','#C9A227','#0C2418','#B45309','#4A7C59','#A97C12','#163524','#8B5A12');

$dash_boot = dash_filter_session_get();
$id_ostan = isset($dash_boot['id_ostan']) ? trim((string) $dash_boot['id_ostan']) : '';
$id_city = isset($dash_boot['id_city']) ? trim((string) $dash_boot['id_city']) : '';
$id_mar = isset($dash_boot['id_mar']) ? trim((string) $dash_boot['id_mar']) : '';
dash_clamp_geo($id_ostan, $id_city, $id_mar);
$hyear = isset($dash_boot['year']) ? trim((string) $dash_boot['year']) : '';
$level = dash_visits_level($id_ostan, $id_city, $id_mar);
$catalog = dash_visits_group_catalog($level);
$GROUP_LABELS = array();
$allGroups = array();
foreach ($catalog as $gid => $g) {
    $k = (string) $gid;
    $GROUP_LABELS[$k] = $g['label'];
    $allGroups[] = $k;
}

$jnow = jalali_from_gregorian((int)date('Y'), (int)date('n'), (int)date('j'));
$today = sprintf('%04d/%02d/%02d', $jnow[0], $jnow[1], $jnow[2]);
$yesterday = jalali_add_days($today, -1);
$year = isset($dash_boot['visits_year']) ? preg_replace('/\D/', '', (string) $dash_boot['visits_year']) : '';
if ($year === '' || strlen($year) !== 4) {
    $year = (string) $jnow[0];
}
$month = isset($dash_boot['visits_month']) ? str_pad(preg_replace('/\D/', '', (string) $dash_boot['visits_month']), 2, '0', STR_PAD_LEFT) : '';
if ($month === '' || (int) $month < 1 || (int) $month > 12) {
    $month = sprintf('%02d', $jnow[1]);
}

$allowed = array();
foreach ($allGroups as $id) {
    $allowed[(string) $id] = true;
}
$grpIn = null;
if (array_key_exists('visits_grp', $dash_boot) && $dash_boot['visits_grp'] !== null) {
    $grpIn = $dash_boot['visits_grp'];
}
if ($grpIn !== null) {
    $chiefs = array();
    foreach ((array) $grpIn as $v) {
        $chiefs[] = (string) $v;
    }
    $chiefs = array_values(array_filter($chiefs, function ($id) use ($allowed) {
        return isset($allowed[$id]);
    }));
    if (count($chiefs) === 0) {
        $chiefs = $allGroups;
    }
} else {
    $chiefs = $allGroups;
}

$placeLabel = 'کل کشور';
$ostanName = '';
$cityName = '';
$marName = '';
if ($id_ostan !== '' && isset($dbh) && $dbh instanceof PDO) {
    $orow = dash_rows($dbh, 'SELECT ostan FROM ostanname WHERE id_ostan = ? LIMIT 1', array($id_ostan));
    $ostanName = ($orow && !empty($orow[0]['ostan'])) ? $orow[0]['ostan'] : $id_ostan;
    $placeLabel = $ostanName;
}
if ($id_city !== '' && isset($dbh) && $dbh instanceof PDO) {
    $crow = dash_rows($dbh, 'SELECT city FROM cityname WHERE id_ostan = ? AND id_city = ? LIMIT 1', array($id_ostan, $id_city));
    $cityName = ($crow && !empty($crow[0]['city'])) ? $crow[0]['city'] : $id_city;
    $placeLabel .= ' / ' . $cityName;
}
if ($id_mar !== '' && isset($dbh) && $dbh instanceof PDO) {
    $mrow = dash_rows($dbh, 'SELECT m_name FROM promo_cent_public WHERE id_ostan = ? AND id_city = ? AND id_mar = ? LIMIT 1', array($id_ostan, $id_city, $id_mar));
    if (!$mrow) {
        $mrow = dash_rows($dbh, 'SELECT mar FROM mar WHERE id_ostan = ? AND id_mar = ? LIMIT 1', array($id_ostan, $id_mar));
        $marName = ($mrow && !empty($mrow[0]['mar'])) ? $mrow[0]['mar'] : $id_mar;
    } else {
        $marName = $mrow[0]['m_name'];
    }
    $placeLabel .= ' / ' . $marName;
}

$crumbs = array();
if (dash_force_ostan() === '') {
    $crumbs[] = array(
        'label' => 'کشور',
        'id_ostan' => '',
        'id_city' => '',
        'id_mar' => '',
        'current' => ($level === 'country')
    );
}
if ($ostanName !== '') {
    $crumbs[] = array(
        'label' => $ostanName,
        'id_ostan' => $id_ostan,
        'id_city' => '',
        'id_mar' => '',
        'current' => ($level === 'ostan')
    );
}
if ($cityName !== '') {
    $crumbs[] = array(
        'label' => $cityName,
        'id_ostan' => $id_ostan,
        'id_city' => $id_city,
        'id_mar' => '',
        'current' => ($level === 'city')
    );
}
if ($marName !== '') {
    $crumbs[] = array(
        'label' => $marName,
        'id_ostan' => $id_ostan,
        'id_city' => $id_city,
        'id_mar' => $id_mar,
        'current' => ($level === 'mar')
    );
}

$backUrl = 'index.php';
$formAction = 'dashboard_visits.php';

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

        $users = array();
        if ($level === 'country') {
            $st = $dbh->prepare(
                "SELECT username, name, Last_name, chief, S_access
                 FROM users
                 WHERE S_access IN ('20','21','22','23')
                    OR chief IN ('0','1','2','3','31','32')"
            );
            $st->execute();
            $users = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $accCodes = array();
            foreach ($chiefs as $gk) {
                if (isset($catalog[$gk]['codes'])) {
                    foreach ($catalog[$gk]['codes'] as $c) {
                        $accCodes[$c] = true;
                    }
                }
            }
            $accList = array_keys($accCodes);
            if ($accList) {
                list($where, $params) = dash_geo_sql($id_ostan, $id_city, $id_mar, '', true);
                $in = implode(',', array_fill(0, count($accList), '?'));
                $st = $dbh->prepare("SELECT username, name, Last_name, chief, S_access FROM users WHERE $where AND S_access IN ($in)");
                $st->execute(array_merge($params, $accList));
                $users = $st->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        $byCode = array();
        $codes = array();
        foreach ($users as $u) {
            $code = trim((string)$u['username']);
            if ($level === 'country') {
                $gkey = norm_chief($u['chief']);
                if ($gkey === '1') {
                    $gkey = '2';
                }
            } else {
                $gkey = dash_visits_gkey($u, $catalog);
            }
            if (!in_array((string)$gkey, $chiefs, true)) continue;
            $nm = trim($u['name'] . ' ' . $u['Last_name']);
            if ($nm === '') $nm = $code;
            $byCode[$code] = array('name' => $nm, 'chief' => $gkey);
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
                $visitName = isset($byCode[$code]) ? $byCode[$code]['name'] : $lg['PersName'];
                $ch = isset($byCode[$code]) ? $byCode[$code]['chief'] : 'none';
                $d = norm_jdate($lg['date']);
                $tm = trim((string)$lg['time']);
                $hh = (int)substr($tm, 0, 2);
                if ($d === $today) $todaySet[$code] = 1;
                if ($d === $yesterday) $yestSet[$code] = 1;
                if ($hh >= 0 && $hh <= 23) $hours[$hh]++;
                if (!isset($active[$code])) $active[$code] = array('name' => $visitName, 'c' => 0);
                $active[$code]['c']++;
                $daysHit[$d] = 1;
                if (!isset($dayUser[$d][$visitName])) $dayUser[$d][$visitName] = 0;
                $dayUser[$d][$visitName]++;
                $lab = isset($GROUP_LABELS[$ch]) ? $GROUP_LABELS[$ch] : $ch;
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
            usort($data['share'], function ($a, $b) {
                return (int) $b['c'] - (int) $a['c'];
            });
        }
    } catch (Exception $e) {
        $err = 'خطای پایگاه داده: ' . $e->getMessage();
    }
}

$years = array();
if (isset($dbh) && $dbh instanceof PDO) {
    try {
        $q = $dbh->query("SELECT DISTINCT LEFT(date, 4) AS y FROM Last_user WHERE date LIKE '13%' OR date LIKE '14%' ORDER BY y DESC");
        if ($q) {
            while ($r = $q->fetch(PDO::FETCH_ASSOC)) {
                $yy = preg_replace('/\D/', '', (string) $r['y']);
                if (strlen($yy) === 4 && !in_array($yy, $years, true)) {
                    $years[] = $yy;
                }
            }
        }
    } catch (Exception $e) {
    }
}
if (!in_array((string) $jnow[0], $years, true)) {
    array_unshift($years, (string) $jnow[0]);
}
if (!in_array($year, $years, true)) {
    array_unshift($years, $year);
}
if (!$years) {
    $years = array((string) $jnow[0]);
}
$monthsFa = array('01'=>'فروردین','02'=>'اردیبهشت','03'=>'خرداد','04'=>'تیر','05'=>'مرداد','06'=>'شهریور','07'=>'مهر','08'=>'آبان','09'=>'آذر','10'=>'دی','11'=>'بهمن','12'=>'اسفند');
$self = htmlspecialchars($formAction);
$data = utf8ize($data);
$monthTotal = (int)$data['month_total'];
$selNames = array();
foreach ($chiefs as $c) {
    if (isset($GROUP_LABELS[$c])) {
        $selNames[] = $GROUP_LABELS[$c];
    }
}
$groupBtn = (count($chiefs) === count($allGroups)) ? 'همه گروه‌ها' : implode('، ', $selNames);

$dash_year_opts = '';
foreach ($years as $y) {
    $sel = ($y === $year) ? ' selected' : '';
    $dash_year_opts .= '<option value="' . h($y) . '"' . $sel . '>' . dash_visits_fa($y) . '</option>';
}
$dash_month_opts = '';
foreach ($monthsFa as $num => $title) {
    $sel = ($num === $month) ? ' selected' : '';
    $dash_month_opts .= '<option value="' . h($num) . '"' . $sel . '>' . h($title) . '</option>';
}
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد بازدید کاربران</title>
    <link rel="shortcut icon" href="<?php echo h($dash_root); ?>files/images/favicon.ico" type="image/x-icon">
    <style>
        @font-face { font-family: YekanBakh; src: url("<?php echo h($dash_root); ?>assets/fonts/Yekan-Bakh-Fa-En-04-Regular.woff") format("woff"); font-weight: 400; font-display: swap; }
        @font-face { font-family: YekanBakh; src: url("<?php echo h($dash_root); ?>assets/fonts/Yekan-Bakh-Fa-En-05-Medium.woff") format("woff"); font-weight: 500; font-display: swap; }
        @font-face { font-family: YekanBakh; src: url("<?php echo h($dash_root); ?>assets/fonts/Yekan-Bakh-Fa-En-06-Bold.woff") format("woff"); font-weight: 700; font-display: swap; }
        @font-face { font-family: YekanBakh; src: url("<?php echo h($dash_root); ?>assets/fonts/Yekan-Bakh-Fa-En-07-Heavy.woff") format("woff"); font-weight: 800; font-display: swap; }
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
        .dash-tools {
            display: flex; flex-wrap: wrap; gap: 8px; align-items: flex-end;
            background: #fff; border: 1px solid #DDD3BE; border-radius: 16px; padding: 10px;
            min-width: 0; overflow: visible;
        }
        .dash-tool { display: flex; flex-direction: column; gap: 4px; min-width: 0; }
        .dash-tools label { font-size: 12px; color: var(--muted); padding-inline: 4px; font-weight: 700; }
        .dash-tools select, .dash-back {
            min-height: var(--touch); min-width: 44px; border: 1px solid var(--line); border-radius: 14px;
            background: #fff; color: var(--text); font-family: inherit; font-size: 16px; padding: 0 12px; cursor: pointer;
        }
        .dash-tools select {
            min-width: 168px; padding: 0 36px 0 12px; font-weight: 700; color-scheme: light;
            appearance: none; -webkit-appearance: none; -moz-appearance: none;
            background-color: #fff;
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%23A97C12' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: left 12px center; background-size: 18px;
        }
        .dash-tools select:hover { border-color: #C4B79A; background-color: #FFFCF6; }
        .dash-tools select option { background-color: #FFFCF6; color: #14221A; font-weight: 600; }
        .dash-back {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(180deg, #D4AF37, #A97C12); color: #1A1404; border: 0;
            font-weight: 800; text-decoration: none; align-self: end;
            box-shadow: 0 10px 22px rgba(169, 124, 18, 0.28);
        }
        .dash-back:hover { filter: brightness(1.05); }
        .dash-tools select:focus-visible, .dash-back:focus-visible, .dash-account-btn:focus-visible,
        .dash-crumb a:focus-visible, .drop-btn:focus-visible, .drop-apply:focus-visible,
        .drop-tools button:focus-visible, .tleg-item:focus-visible {
            outline: 3px solid rgba(201, 162, 39, 0.55); outline-offset: 2px;
        }
        .dash-crumb { display: flex; flex-wrap: wrap; gap: 6px; list-style: none; margin: 0 0 10px; padding: 0; }
        .dash-crumb li { display: flex; }
        .dash-crumb a {
            display: inline-flex; align-items: center; min-height: 40px;
            border: 1px solid #C9A227; background: #fff; border-radius: 999px;
            padding: 0 14px; font-family: inherit; font-size: 13px; color: #14221A;
            text-decoration: none; font-weight: 700;
        }
        .dash-crumb a:hover { background: #F4EFE4; }
        .dash-crumb a[aria-current="page"] {
            background: linear-gradient(180deg, #D4AF37, #A97C12); color: #1A1404; border-color: #A97C12; font-weight: 800;
        }
        .dash-status {
            min-height: 20px; margin: 0 0 14px; font-size: 14px; color: #4A5A51;
            background: rgba(255,255,255,.7); border-radius: 12px; padding: 8px 12px;
            border: 1px dashed rgba(201,162,39,.7);
        }
        .dash-err {
            margin: 0 0 14px; padding: 10px 12px; border-radius: 12px;
            background: var(--danger-bg); color: var(--danger); border: 1px solid #F5C2C0; font-weight: 700;
        }
        .dash-grid {
            display: grid;
            grid-template-columns: minmax(240px, 280px) minmax(0, 1.6fr) minmax(240px, 300px);
            gap: 16px;
            align-items: start;
        }
        .dash-col { display: flex; flex-direction: column; gap: 14px; min-width: 0; }
        .dash-card {
            background: #fff; border: 1px solid #C9A227; border-radius: 18px;
            box-shadow: 0 10px 28px rgba(6, 20, 12, 0.08); padding: 16px; min-width: 0;
        }
        .dash-card-head {
            display: flex; align-items: center; justify-content: space-between; gap: 8px;
            margin: 0 0 14px; padding-bottom: 10px; border-bottom: 1px solid #DDD3BE;
        }
        .dash-card h2, .dash-card-head h2 { margin: 0; font-size: 15px; color: #14221A; padding: 0; border: 0; }
        .dash-card-tag {
            font-size: 11px; color: #A97C12; background: #FFF8EA; border: 1px solid #C9A227;
            border-radius: 999px; padding: 2px 8px; white-space: nowrap;
        }
        .dash-col, .dash-card, .kpi, .hbar { min-width: 0; }
        .kpi {
            background: linear-gradient(160deg, #F4EFE4, #FFFCF6);
            border: 1px solid #DDD3BE; border-radius: 14px; padding: 12px 10px; text-align: center;
        }
        .kpi b {
            display: block; max-width: 100%; min-width: 0;
            font-size: 1.7rem; line-height: 1.25;
            direction: ltr; unicode-bidi: isolate; color: #14221A;
            font-variant-numeric: tabular-nums; font-weight: 800; white-space: nowrap;
        }
        .kpi span { display: block; margin-top: 6px; font-size: 12px; color: #4A5A51; line-height: 1.45; overflow-wrap: anywhere; }
        .dash-meta { margin: 0; font-size: 13px; color: #4A5A51; }
        .chart-box {
            height: 240px; position: relative; border-radius: 14px;
            background: linear-gradient(180deg, #FFFCF6, #fff); border: 1px solid #DDD3BE; padding: 8px;
        }
        .chart-box svg { width: 100%; height: 100%; display: block; }
        .hbar { display: flex; align-items: center; gap: 10px; margin: 8px 0; font-size: 13px; }
        .hbar .nm { width: 42%; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #14221A; }
        .hbar .track { flex: 1; min-width: 0; background: #F4EFE4; border-radius: 999px; height: 11px; overflow: hidden; }
        .hbar .fill { height: 11px; background: linear-gradient(90deg, #C9A227, #1F6B45); border-radius: 999px; max-width: 100%; }
        .hbar .c {
            min-width: 0; max-width: 38%; color: #1F6B45; font-size: 12px; font-weight: 700;
            direction: ltr; unicode-bidi: isolate; font-variant-numeric: tabular-nums; white-space: nowrap;
        }
        .donut-row { display: flex; flex-direction: column; align-items: stretch; gap: 10px; }
        .donut { width: 100%; height: auto; display: block; }
        .donut text { font-variant-numeric: tabular-nums; }
        .dleg {
            display: grid; grid-template-columns: 1fr; gap: 4px 10px;
            font-size: 12px; color: #14221A; min-width: 0;
        }
        .dleg div { display: flex; align-items: center; gap: 8px; margin: 0; min-width: 0; overflow-wrap: anywhere; }
        .dleg i { width: 10px; height: 10px; border-radius: 50%; display: inline-block; flex-shrink: 0; }
        .flowbox { display: flex; flex-direction: column; align-items: stretch; gap: 12px; }
        .tleg {
            width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 2px 10px;
        }
        .tleg-h { grid-column: 1 / -1; font-size: 12px; color: #4A5A51; font-weight: 700; margin-bottom: 4px; }
        .flow-stage { flex: 1; min-width: 0; }
        .flow { min-width: 0; direction: ltr; overflow: visible; }
        .flow svg { width: 100%; height: auto; display: block; }
        .flow-dates {
            position: relative; height: 46px; margin-top: 6px;
            direction: ltr;
        }
        .flow-date {
            position: absolute; top: 0; transform: translateX(-50%);
            text-align: center; white-space: nowrap; line-height: 1.25;
            color: #14221A; pointer-events: none; font-family: inherit;
            font-variant-numeric: tabular-nums;
        }
        .flow-date b { display: block; font-size: 15px; font-weight: 800; }
        .flow-date em { display: block; font-size: 12px; font-style: normal; color: #4A5A51; font-weight: 700; }
        .drop { position: relative; }
        .drop-btn {
            width: 100%; text-align: right; border: 1px solid var(--line); background: #fff;
            border-radius: 14px; padding: 0 12px; min-height: var(--touch);
            font-family: inherit; cursor: pointer; font-size: 14px; font-weight: 700; color: var(--text);
        }
        .drop-list {
            display: none; position: absolute; right: 0; left: 0; top: 100%; z-index: 8;
            background: #FFFCF6; border: 1px solid #C9A227; border-radius: 14px; margin-top: 6px; padding: 8px;
            box-shadow: 0 14px 32px rgba(6, 20, 12, 0.12);
        }
        .drop.open .drop-list { display: block; }
        .drop-list label {
            display: flex; gap: 8px; align-items: center; padding: 7px 8px; font-size: 13px;
            cursor: pointer; border-radius: 8px; min-height: 40px; color: #14221A;
        }
        .drop-list label:hover { background: #F4EFE4; }
        .drop-tools { display: flex; gap: 6px; margin-bottom: 6px; padding-bottom: 6px; border-bottom: 1px solid var(--line); }
        .drop-tools button, .drop-apply {
            flex: 1; font-family: inherit; font-size: 12px; font-weight: 700; padding: 8px;
            border-radius: 10px; border: 1px solid var(--line); background: #fff; cursor: pointer;
            color: var(--text); min-height: 40px;
        }
        .drop-apply {
            width: 100%; margin-top: 6px; flex: none; border: 0;
            background: linear-gradient(180deg, #D4AF37, #A97C12); color: #1A1404;
        }
        .tleg-item {
            display: flex; align-items: center; gap: 8px; width: 100%; margin: 0; padding: 6px 4px;
            border: 0; background: none; font: inherit; font-size: 12px; color: #14221A;
            text-align: right; cursor: pointer; border-radius: 8px; min-height: 40px; min-width: 0;
            overflow-wrap: anywhere;
        }
        .tleg-item:hover { background: #F4EFE4; }
        .tleg-item.is-on { font-weight: 800; background: #FFF8EA; }
        .tleg-item.is-muted { opacity: .38; }
        .tleg-item i { width: 9px; height: 9px; border-radius: 50%; display: inline-block; flex-shrink: 0; }
        .flow svg .flow-u { transition: opacity .2s var(--ease); }
        .flow.is-focus .flow-u { opacity: .16; }
        .flow.is-focus .flow-u.is-on { opacity: 1; }
        @media (max-width: 1100px) {
            .dash-grid { grid-template-columns: 1fr; }
            .dash-shell { padding: 14px 10px 12px; border-radius: 18px; }
            .dash-emblem-wrap { width: 56px; height: 56px; }
            .dash-emblem { width: 40px; }
            .dleg { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 480px) {
            .tleg, .dleg { grid-template-columns: 1fr; }
        }
        @media (prefers-reduced-motion: reduce) {
            .dash-back, .dash-card, .flow svg .flow-u { transition: none; }
        }
<?php dash_account_css(); ?>
    </style>
</head>
<body class="dash-body">
<form method="post" action="<?php echo $self; ?>" id="visitsForm">
<input type="hidden" name="hyear" value="<?php echo h($hyear); ?>">
<input type="hidden" name="id_ostan" id="visits-ostan" value="<?php echo h($id_ostan); ?>">
<input type="hidden" name="id_city" id="visits-city" value="<?php echo h($id_city); ?>">
<input type="hidden" name="id_mar" id="visits-mar" value="<?php echo h($id_mar); ?>">
<div class="dash">
    <div class="dash-shell">
        <div class="dash-top">
            <div class="dash-brand">
                <div class="dash-emblem-wrap">
                    <img class="dash-emblem" src="<?php echo h($dash_root); ?>files/jahad-white.png" width="52" height="52" alt="آرم وزارت جهاد کشاورزی">
                </div>
                <div class="dash-brand-copy">
                    <p class="dash-brand-kicker">وزارت جهاد کشاورزی</p>
                    <h1>داشبورد بازدید کاربران</h1>
                    <p class="dash-brand-aka"><span dir="ltr">MAPKA</span> · مپکا</p>
                </div>
            </div>
            <div class="dash-head-actions">
            <div class="dash-tools">
                <div class="dash-tool">
                    <select id="dash-year" name="year" aria-label="سال شمسی" onchange="this.form.submit()">
                        <?php echo $dash_year_opts; ?>
                    </select>
                </div>
                <div class="dash-tool">
                    <select id="dash-month" name="month" aria-label="ماه شمسی" onchange="this.form.submit()">
                        <?php echo $dash_month_opts; ?>
                    </select>
                </div>
                <a class="dash-back dash-home" href="<?php echo h($backUrl); ?>" id="dash-home" aria-label="بازگشت به خانه" title="بازگشت به خانه"><?php echo dash_account_icon('home'); ?></a>
            </div>
            <?php dash_account_html(); ?>
            </div>
        </div>

        <ol class="dash-crumb" aria-label="موقعیت جغرافیایی">
            <?php foreach ($crumbs as $c): ?>
            <li>
                <a href="#" class="dash-crumb-geo" data-ostan="<?php echo h($c['id_ostan']); ?>" data-city="<?php echo h($c['id_city']); ?>" data-mar="<?php echo h($c['id_mar']); ?>"<?php echo !empty($c['current']) ? ' aria-current="page"' : ''; ?>><?php echo h(dash_visits_fa($c['label'])); ?></a>
            </li>
            <?php endforeach; ?>
        </ol>
        <p class="dash-status" role="status">
            تاریخ به‌روزرسانی: <?php echo dash_visits_fa($data['last_update']); ?>
            — تعداد بازدید این ماه: <?php echo dash_visits_fa($monthTotal); ?>
        </p>
        <?php if ($err): ?><div class="dash-err" role="alert"><?php echo h($err); ?></div><?php endif; ?>

        <div class="dash-grid">
            <aside class="dash-col">
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>ورود امروز</h2>
                        <span class="dash-card-tag">شاخص</span>
                    </div>
                    <div class="kpi">
                        <b><?php echo dash_visits_fa((int) $data['kpi_today']); ?></b>
                        <span><?php echo dash_visits_fa($data['kpi_today_label']); ?></span>
                    </div>
                </section>
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>ورود دیروز</h2>
                        <span class="dash-card-tag">شاخص</span>
                    </div>
                    <div class="kpi">
                        <b><?php echo dash_visits_fa((int) $data['kpi_yesterday']); ?></b>
                        <span><?php echo dash_visits_fa($data['kpi_yesterday_label']); ?></span>
                    </div>
                </section>
                <section class="dash-card drop" id="groupDrop">
                    <div class="dash-card-head">
                        <h2 id="groupDropLabel">گروه کاربری</h2>
                        <span class="dash-card-tag">فیلتر</span>
                    </div>
                    <button type="button" class="drop-btn" id="groupBtn" aria-expanded="false" aria-controls="groupList" aria-labelledby="groupDropLabel"><?php echo h($groupBtn); ?></button>
                    <div class="drop-list" id="groupList" role="group" aria-labelledby="groupDropLabel">
                        <div class="drop-tools">
                            <button type="button" id="groupSelectAll">انتخاب همه</button>
                            <button type="button" id="groupClearAll">غیرفعال کردن همه</button>
                        </div>
                        <?php foreach ($GROUP_LABELS as $cid => $clab): ?>
                            <label>
                                <input type="checkbox" name="grp[]" value="<?php echo h((string) $cid); ?>" <?php echo in_array((string) $cid, $chiefs, true) ? 'checked' : ''; ?>>
                                <?php echo h($clab); ?>
                            </label>
                        <?php endforeach; ?>
                        <button type="submit" class="drop-apply">اعمال</button>
                    </div>
                </section>
            </aside>

            <section class="dash-col">
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>تعداد بازدید در هر ساعت</h2>
                        <span class="dash-card-tag">ساعت</span>
                    </div>
                    <div class="chart-box"><?php echo svg_area_ltr($data['hourly']); ?></div>
                </section>
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>روند بازدید کاربران</h2>
                        <span class="dash-card-tag">چندروزه</span>
                    </div>
                    <?php if (empty($data['trend_days']) || empty($data['trend_users'])): ?>
                        <p class="dash-meta">روندی برای نمایش نیست.</p>
                    <?php else: ?>
                    <div class="flowbox">
                        <div class="flow-stage">
                            <div class="flow" id="trendFlow"><?php echo svg_alluvial($data['trend_days'], $data['trend_users'], $PAL); ?></div>
                            <div class="flow-dates" aria-hidden="true">
                                <?php
                                $datePcts = dash_visits_trend_date_pcts(count($data['trend_days']));
                                foreach ($data['trend_days'] as $di => $td):
                                    $dlab = dash_visits_chart_date($td);
                                ?>
                                <span class="flow-date" style="left:<?php echo htmlspecialchars((string) $datePcts[$di], ENT_QUOTES, 'UTF-8'); ?>%">
                                    <b><?php echo h($dlab['day']); ?></b>
                                    <?php if ($dlab['month'] !== ''): ?><em><?php echo h($dlab['month']); ?></em><?php endif; ?>
                                </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="tleg" dir="rtl" id="trendLegend">
                            <div class="tleg-h">نام کاربر</div>
                            <?php foreach ($data['trend_users'] as $ui => $tu): ?>
                            <button type="button" class="tleg-item" data-u="<?php echo (int) $ui; ?>" aria-pressed="false">
                                <i style="background:<?php echo $PAL[$ui % 8]; ?>" aria-hidden="true"></i><?php echo h($tu['name']); ?>
                            </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </section>
            </section>

            <aside class="dash-col">
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>کاربران فعال</h2>
                        <span class="dash-card-tag">رتبه</span>
                    </div>
                    <?php if (empty($data['active'])): ?>
                        <p class="dash-meta">در این بازه ورودی ثبت نشده است.</p>
                    <?php else:
                        $maxA = 1;
                        foreach ($data['active'] as $a) if ((int) $a['c'] > $maxA) $maxA = (int) $a['c'];
                        foreach ($data['active'] as $a):
                            $w = round(((int) $a['c']) * 100 / $maxA);
                    ?>
                        <div class="hbar">
                            <div class="nm" title="<?php echo h($a['name']); ?>"><?php echo h($a['name']); ?></div>
                            <div class="track"><div class="fill" style="width:<?php echo (int) $w; ?>%"></div></div>
                            <div class="c"><?php echo dash_visits_fa((int) $a['c']); ?></div>
                        </div>
                    <?php endforeach; endif; ?>
                </section>
                <section class="dash-card">
                    <div class="dash-card-head">
                        <h2>سهم ورود گروه کاربری</h2>
                        <span class="dash-card-tag">سهم</span>
                    </div>
                    <?php if (empty($data['share'])): ?>
                        <p class="dash-meta">داده‌ای برای سهم گروه نیست.</p>
                    <?php else: ?>
                    <div class="donut-row">
                        <?php echo svg_donut($data['share'], $PAL); ?>
                        <div class="dleg">
                            <?php
                            $pi = 0;
                            foreach ($data['share'] as $s):
                            ?>
                            <div><i style="background:<?php echo $PAL[$pi % 8]; ?>"></i><?php echo h($s['label']); ?> — <?php echo dash_visits_fa((int) $s['c']); ?></div>
                            <?php $pi++; endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </section>
            </aside>
        </div>
    </div>
</div>
</form>
<script>
(function () {
    var d = document.getElementById('groupDrop');
    var b = document.getElementById('groupBtn');
    var form = document.getElementById('visitsForm');
    var selectAll = document.getElementById('groupSelectAll');
    var clearAll = document.getElementById('groupClearAll');

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

    var homeBtn = document.getElementById('dash-home');
    if (homeBtn) {
        homeBtn.addEventListener('click', function (e) {
            e.preventDefault();
            dashPost('index.php', {
                year: <?php echo json_encode($hyear); ?>,
                id_ostan: <?php echo json_encode($id_ostan); ?>,
                id_city: <?php echo json_encode($id_city); ?>,
                id_mar: <?php echo json_encode($id_mar); ?>
            });
        });
    }
    var crumbs = document.querySelectorAll('.dash-crumb-geo');
    var ci;
    for (ci = 0; ci < crumbs.length; ci++) {
        crumbs[ci].addEventListener('click', function (e) {
            e.preventDefault();
            if (!form) return;
            var o = document.getElementById('visits-ostan');
            var c = document.getElementById('visits-city');
            var m = document.getElementById('visits-mar');
            if (o) o.value = this.getAttribute('data-ostan') || '';
            if (c) c.value = this.getAttribute('data-city') || '';
            if (m) m.value = this.getAttribute('data-mar') || '';
            form.submit();
        });
    }

    function boxes() {
        return d ? d.querySelectorAll('input[name="grp[]"]') : [];
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
        b.onclick = function (e) {
            e.preventDefault();
            setOpen(!d.classList.contains('open'));
        };
        if (selectAll) {
            selectAll.onclick = function () {
                var list = boxes(), i;
                for (i = 0; i < list.length; i++) list[i].checked = true;
            };
        }
        if (clearAll) {
            clearAll.onclick = function () {
                var list = boxes(), i;
                for (i = 0; i < list.length; i++) list[i].checked = false;
            };
        }
        document.addEventListener('click', function (e) {
            if (!d.classList.contains('open') || d.contains(e.target)) return;
            setOpen(false);
            if (!form || snapshot() === initial || isSubmitControl(e.target)) return;
            form.submit();
        });
        document.addEventListener('keydown', function (e) {
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
            items[i].onclick = function () {
                var idx = this.getAttribute('data-u');
                if (current === idx) setFocus(null);
                else setFocus(idx);
            };
        }
    }

    function fitInBox(el, maxPx, minPx) {
        if (!el || !el.clientWidth) return;
        maxPx = maxPx || 24;
        minPx = minPx || 11;
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
    }
    var kpiNums = document.querySelectorAll('.kpi b');
    var iK;
    for (iK = 0; iK < kpiNums.length; iK++) fitInBox(kpiNums[iK], 26, 12);
    var barNums = document.querySelectorAll('.hbar .c');
    for (iK = 0; iK < barNums.length; iK++) fitInBox(barNums[iK], 12, 10);
})();
</script>
</body>
</html>
