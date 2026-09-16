<?php
/**
 * آمار داشبورد باغبانی: Garden_prod + الگوی Garden_ab_* + کدینگ product_b.
 *
 * واژه‌نامه نسبت به زراعت:
 *   plant     = سطح زیر کشت (بارور + غیربارور، یا فیلتر بارور/غیربارور)
 *   baror     = سطح بارور (s_kesht_b) — معادل «سطح برداشت» زراعت
 *   nonbaror  = سطح غیربارور (s_kesht_gb)
 *   prod/pred = تولید قطعی / پیش‌بینی (mah_tol / mah_tolp)
 *   plan      = سطح ابلاغی استان از Garden_ab_ostan
 *   cut       = برش شهرستانی از Garden_ab_city (نسبت به ابلاغی = تحقق برش)
 */
function dash_garden_z_sal($year)
{
    $y = (int) $year;
    return $y . '-' . ($y + 1);
}

function dash_garden_in($col, $codes)
{
    $out = array();
    foreach ($codes as $c) {
        $c = trim((string) $c);
        if ($c !== '' && !in_array($c, $out, true)) {
            $out[] = $c;
        }
    }
    if (!$out) {
        return array('1=0', array());
    }
    $ph = implode(',', array_fill(0, count($out), '?'));
    return array($col . ' IN (' . $ph . ')', $out);
}

function dash_garden_catalog($dbh)
{
    $groups = array();
    $products = array();
    $byGroup = array();
    $map = array();
    $rows = dash_rows(
        $dbh,
        'SELECT group_cod, group_name, product_cod, product_name
         FROM product_b
         ORDER BY BINARY group_name ASC, BINARY product_name ASC',
        array()
    );
    foreach ($rows as $r) {
        $gc = trim((string) $r['group_cod']);
        $pc = trim((string) $r['product_cod']);
        if ($gc === '' || $pc === '') {
            continue;
        }
        if (!isset($groups[$gc])) {
            $groups[$gc] = array(
                'group_cod' => $gc,
                'group_name' => $r['group_name']
            );
            $byGroup[$gc] = array();
        }
        $item = array(
            'product_cod' => $pc,
            'product_name' => $r['product_name'],
            'group_cod' => $gc,
            'group_name' => $r['group_name']
        );
        $products[] = $item;
        $byGroup[$gc][] = $item;
        $map[$pc] = $item;
    }
    return array(
        'groups' => array_values($groups),
        'products' => $products,
        'by_group' => $byGroup,
        'map' => $map
    );
}

function dash_garden_filter_codes($catalog, $group_cod, $product_cod)
{
    $product_cod = trim((string) $product_cod);
    $group_cod = trim((string) $group_cod);
    if ($product_cod !== '') {
        return array($product_cod);
    }
    if ($group_cod !== '') {
        $all = array();
        if (isset($catalog['by_group'][$group_cod])) {
            foreach ($catalog['by_group'][$group_cod] as $p) {
                $all[] = $p['product_cod'];
            }
        } elseif (isset($catalog['products']) && is_array($catalog['products'])) {
            foreach ($catalog['products'] as $p) {
                if (isset($p['group_cod']) && $p['group_cod'] === $group_cod && isset($p['product_cod'])) {
                    $all[] = $p['product_cod'];
                }
            }
        }
        return $all;
    }
    return null;
}

function dash_garden_norm_fruit($fruit)
{
    $fruit = trim((string) $fruit);
    if ($fruit === 'baror' || $fruit === 'nonbaror') {
        return $fruit;
    }
    return 'all';
}

function dash_garden_norm_water($water)
{
    $water = trim((string) $water);
    if ($water === 'abi' || $water === 'dim') {
        return $water;
    }
    return 'all';
}

function dash_garden_empty_bucket()
{
    return array(
        'plant' => 0,
        'plant_abi' => 0,
        'plant_dim' => 0,
        'baror' => 0,
        'baror_abi' => 0,
        'baror_dim' => 0,
        'nonbaror' => 0,
        'nonbaror_abi' => 0,
        'nonbaror_dim' => 0,
        'tree_b' => 0,
        'tree_gb' => 0,
        'prod' => 0,
        'pred' => 0,
        'plan' => 0,
        'plan_abi' => 0,
        'plan_dim' => 0,
        'plan_bar' => 0,
        'plan_nobar' => 0,
        'cut' => 0,
        'cut_abi' => 0,
        'cut_dim' => 0,
        'cut_bar' => 0,
        'cut_nobar' => 0
    );
}

function dash_garden_add_bucket(&$dst, $src)
{
    foreach ($src as $k => $v) {
        if (!isset($dst[$k])) {
            $dst[$k] = 0;
        }
        $dst[$k] += (float) $v;
    }
}

function dash_garden_round_bucket($b)
{
    foreach ($b as $k => $v) {
        $b[$k] = round((float) $v, 2);
    }
    return $b;
}

function dash_garden_realize($plant, $plan)
{
    $plant = (float) $plant;
    $plan = (float) $plan;
    if ($plan <= 0) {
        return array('pct' => null, 'status' => 'none');
    }
    $pct = round(($plant / $plan) * 100, 1);
    $status = 'near';
    if ($pct < 90) {
        $status = 'under';
    } elseif ($pct > 110) {
        $status = 'over';
    }
    return array('pct' => $pct, 'status' => $status);
}

function dash_garden_geo_meta($dbh, $level, $id_ostan, $id_city, $id_mar)
{
    $geoKey = 'id_ostan';
    $labels = array();
    if ($level === 'ostan' && $id_ostan !== '') {
        $geoKey = 'id_city';
        $rows = dash_rows(
            $dbh,
            'SELECT id_city, city FROM cityname WHERE id_ostan = ? ORDER BY BINARY city ASC',
            array($id_ostan)
        );
        foreach ($rows as $r) {
            $id = trim((string) $r['id_city']);
            $labels[$id] = array(
                'label' => $r['city'],
                'id_ostan' => $id_ostan,
                'id_city' => $id,
                'id_mar' => ''
            );
        }
    } elseif (($level === 'city' || $level === 'mar') && $id_ostan !== '' && $id_city !== '') {
        $geoKey = 'id_mar';
        $rows = dash_rows(
            $dbh,
            'SELECT id_mar, mar FROM mar WHERE id_ostan = ? AND id_city = ? ORDER BY BINARY mar ASC',
            array($id_ostan, $id_city)
        );
        foreach ($rows as $r) {
            $id = trim((string) $r['id_mar']);
            $labels[$id] = array(
                'label' => $r['mar'],
                'id_ostan' => $id_ostan,
                'id_city' => $id_city,
                'id_mar' => $id
            );
        }
    } else {
        $geoKey = 'id_ostan';
        $rows = dash_rows($dbh, 'SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC', array());
        foreach ($rows as $r) {
            $id = dash_garden_pad_ostan(trim((string) $r['id_ostan']));
            $labels[$id] = array(
                'label' => $r['ostan'],
                'id_ostan' => $id,
                'id_city' => '',
                'id_mar' => ''
            );
        }
    }
    return array($geoKey, $labels);
}

function dash_garden_ab_table($level)
{
    /* الگو همیشه Garden_ab_ostan است؛ برش همیشه Garden_ab_city. این تابع دیگر مبدأ KPI نیست. */
    if ($level === 'city' || $level === 'mar') {
        return 'Garden_ab_mar';
    }
    if ($level === 'ostan') {
        return 'Garden_ab_city';
    }
    return 'Garden_ab_ostan';
}

function dash_garden_year_sql($sargable = false)
{
    if ($sargable) {
        return '(z_sal = ? OR z_sal = ?)';
    }
    return '(TRIM(CAST(z_sal AS CHAR)) = ? OR TRIM(CAST(z_sal AS CHAR)) = ?)';
}

function dash_garden_year_params($year)
{
    $y = (int) $year;
    return array((string) $y, dash_garden_z_sal($y));
}

function dash_garden_pad_ostan($id)
{
    $id = trim((string) $id);
    if ($id !== '' && ctype_digit($id)) {
        return str_pad($id, 2, '0', STR_PAD_LEFT);
    }
    return $id;
}

function dash_garden_match_gid($geoKey, $gid, $labels)
{
    $gid = trim((string) $gid);
    if ($gid !== '' && isset($labels[$gid])) {
        return $gid;
    }
    if ($geoKey === 'id_ostan') {
        $pad = dash_garden_pad_ostan($gid);
        if ($pad !== '' && isset($labels[$pad])) {
            return $pad;
        }
        foreach ($labels as $id => $meta) {
            if (function_exists('dash_ostan_same') && dash_ostan_same($id, $gid)) {
                return $id;
            }
        }
    }
    return $gid;
}

/**
 * الگوی باغی با سال تقویمی است (مثل 1405)، نه سال زراعی 1404-1405.
 * اگر برای سال انتخاب‌شده ردیفی نباشد، سال بعد را هم می‌آزماید (۱۴۰۴ زراعی → ۱۴۰۵ باغی).
 */
function dash_garden_resolve_ab_year($dbh, $year)
{
    $y = (string) ((int) $year);
    if (!$dbh || !dash_table_exists($dbh, 'Garden_ab_ostan')) {
        return $y;
    }
    $n = (int) dash_scalar(
        $dbh,
        'SELECT COUNT(*) FROM Garden_ab_ostan WHERE TRIM(CAST(z_sal AS CHAR)) = ?',
        array($y)
    );
    if ($n > 0) {
        return $y;
    }
    $y2 = (string) ((int) $year + 1);
    $n2 = (int) dash_scalar(
        $dbh,
        'SELECT COUNT(*) FROM Garden_ab_ostan WHERE TRIM(CAST(z_sal AS CHAR)) = ?',
        array($y2)
    );
    return ($n2 > 0) ? $y2 : $y;
}

function dash_garden_ab_year_sql()
{
    return 'TRIM(CAST(z_sal AS CHAR)) = ?';
}

function dash_garden_plan_geo($table, $id_ostan, $id_city, $id_mar)
{
    if ($table === 'Garden_ab_ostan') {
        $id_ostan = trim((string) $id_ostan);
        if ($id_ostan === '') {
            return array('1=1', array());
        }
        $pad = dash_garden_pad_ostan($id_ostan);
        return array("LPAD(TRIM(CAST(id_ostan AS CHAR)), 2, '0') = ?", array($pad));
    }
    if ($table === 'Garden_ab_city') {
        $id_ostan = trim((string) $id_ostan);
        $id_city = trim((string) $id_city);
        $w = array('1=1');
        $p = array();
        if ($id_ostan !== '') {
            $w[] = "LPAD(TRIM(CAST(id_ostan AS CHAR)), 2, '0') = ?";
            $p[] = dash_garden_pad_ostan($id_ostan);
        }
        if ($id_city !== '') {
            $w[] = 'TRIM(CAST(id_city AS CHAR)) = ?';
            $p[] = $id_city;
        }
        return array(implode(' AND ', $w), $p);
    }
    return dash_geo_sql($id_ostan, $id_city, $id_mar, '', true);
}

function dash_garden_load_prod($dbh, $geoKey, $geoSql, $geoParams, $codes, $year, $water, $fruit, $sargableYear = false)
{
    if (!$dbh || !dash_table_exists($dbh, 'Garden_prod')) {
        return array();
    }
    $w = array($geoSql, dash_garden_year_sql($sargableYear));
    $p = array_merge($geoParams, dash_garden_year_params($year));
    if (is_array($codes)) {
        $in = dash_garden_in('cod_mah', $codes);
        $w[] = $in[0];
        $p = array_merge($p, $in[1]);
    }
    if ($water === 'abi') {
        $w[] = "no_kesh = '1'";
    } elseif ($water === 'dim') {
        $w[] = "no_kesh = '2'";
    }
    $sql = "SELECT `$geoKey` AS gid, cod_mah AS pid, no_kesh AS nk,
            COALESCE(SUM(IFNULL(s_kesht_b,0)), 0) AS baror,
            COALESCE(SUM(IFNULL(s_kesht_gb,0)), 0) AS nonbaror,
            COALESCE(SUM(IFNULL(tree_b,0)), 0) AS tree_b,
            COALESCE(SUM(IFNULL(tree_gb,0)), 0) AS tree_gb,
            COALESCE(SUM(IFNULL(mah_tol,0)), 0) AS prod,
            COALESCE(SUM(IFNULL(mah_tolp,0)), 0) AS pred
         FROM Garden_prod
         WHERE " . implode(' AND ', $w) . "
         GROUP BY `$geoKey`, cod_mah, no_kesh";
    $rows = dash_rows($dbh, $sql, $p);
    if ($fruit === 'all') {
        return $rows;
    }
    foreach ($rows as &$r) {
        if ($fruit === 'baror') {
            $r['nonbaror'] = 0;
            $r['tree_gb'] = 0;
        } else {
            $r['baror'] = 0;
            $r['tree_b'] = 0;
            $r['prod'] = 0;
            $r['pred'] = 0;
        }
    }
    unset($r);
    return $rows;
}

function dash_garden_load_plan($dbh, $abTable, $geoKey, $geoSql, $geoParams, $codes, $group_cod, $year, $water, $fruit)
{
    if (!$dbh || !dash_table_exists($dbh, $abTable)) {
        return array();
    }
    $w = array($geoSql, dash_garden_ab_year_sql());
    $p = array_merge($geoParams, array((string) ((int) $year)));
    if (is_array($codes)) {
        $in = dash_garden_in('product_cod', $codes);
        $w[] = $in[0];
        $p = array_merge($p, $in[1]);
    } elseif ($group_cod !== '') {
        $w[] = 'group_cod = ?';
        $p[] = $group_cod;
    }
    $sql = "SELECT `$geoKey` AS gid, product_cod AS pid,
            COALESCE(SUM(IFNULL(s_bar_abi,0)), 0) AS bar_abi,
            COALESCE(SUM(IFNULL(s_bar_dem,0)), 0) AS bar_dim,
            COALESCE(SUM(IFNULL(s_nobar_abi,0)), 0) AS nobar_abi,
            COALESCE(SUM(IFNULL(s_nobar_dem,0)), 0) AS nobar_dim
         FROM `$abTable`
         WHERE " . implode(' AND ', $w) . "
         GROUP BY `$geoKey`, product_cod";
    $rows = dash_rows($dbh, $sql, $p);
    foreach ($rows as &$r) {
        if ($water === 'abi') {
            $r['bar_dim'] = 0;
            $r['nobar_dim'] = 0;
        } elseif ($water === 'dim') {
            $r['bar_abi'] = 0;
            $r['nobar_abi'] = 0;
        }
        if ($fruit === 'baror') {
            $r['nobar_abi'] = 0;
            $r['nobar_dim'] = 0;
        } elseif ($fruit === 'nonbaror') {
            $r['bar_abi'] = 0;
            $r['bar_dim'] = 0;
        }
    }
    unset($r);
    return $rows;
}

function dash_garden_plan_add_from_row($r)
{
    $barAbi = (float) $r['bar_abi'];
    $barDim = (float) $r['bar_dim'];
    $nobarAbi = (float) $r['nobar_abi'];
    $nobarDim = (float) $r['nobar_dim'];
    return array(
        'plan_abi' => $barAbi + $nobarAbi,
        'plan_dim' => $barDim + $nobarDim,
        'plan' => $barAbi + $nobarAbi + $barDim + $nobarDim,
        'plan_bar' => $barAbi + $barDim,
        'plan_nobar' => $nobarAbi + $nobarDim
    );
}

function dash_garden_cut_add_from_row($r)
{
    $p = dash_garden_plan_add_from_row($r);
    return array(
        'cut' => $p['plan'],
        'cut_abi' => $p['plan_abi'],
        'cut_dim' => $p['plan_dim'],
        'cut_bar' => $p['plan_bar'],
        'cut_nobar' => $p['plan_nobar']
    );
}

function dash_garden_sum_plan_rows($rows)
{
    $b = dash_garden_empty_bucket();
    foreach ($rows as $r) {
        dash_garden_add_bucket($b, dash_garden_plan_add_from_row($r));
    }
    return dash_garden_round_bucket($b);
}

function dash_garden_sum_cut_rows($rows)
{
    $b = dash_garden_empty_bucket();
    foreach ($rows as $r) {
        dash_garden_add_bucket($b, dash_garden_cut_add_from_row($r));
    }
    return dash_garden_round_bucket($b);
}

function dash_garden_apply_ab_rows(&$byGeo, &$byProd, $rows, $geoKey, $labels, $maker)
{
    foreach ($rows as $r) {
        $gid = dash_garden_match_gid($geoKey, isset($r['gid']) ? $r['gid'] : '', $labels);
        $pid = trim((string) $r['pid']);
        $add = call_user_func($maker, $r);
        if (!isset($byGeo[$gid])) {
            $byGeo[$gid] = dash_garden_empty_bucket();
        }
        dash_garden_add_bucket($byGeo[$gid], $add);
        if ($pid === '') {
            continue;
        }
        if (!isset($byProd[$pid])) {
            $byProd[$pid] = dash_garden_empty_bucket();
        }
        dash_garden_add_bucket($byProd[$pid], $add);
    }
}

function dash_garden_share_sort($a, $b)
{
    $av = isset($a['plant']) ? (float) $a['plant'] : 0;
    $bv = isset($b['plant']) ? (float) $b['plant'] : 0;
    if ($av === $bv) {
        return 0;
    }
    return ($av > $bv) ? -1 : 1;
}

function dash_garden_assemble($catalog, $level, $group_cod, $product_cod, $water, $fruit, $byGeo, $byProd, $labels, $missingProd, $missingPlan, $planOverlay = null, $cutOverlay = null, $missingCut = false, $kpiOverlay = null)
{
    $tot = dash_garden_empty_bucket();
    foreach ($byGeo as $gid => $b) {
        $byGeo[$gid] = dash_garden_round_bucket($b);
        dash_garden_add_bucket($tot, $byGeo[$gid]);
    }
    $tot = dash_garden_round_bucket($tot);
    if (is_array($kpiOverlay)) {
        $tot = dash_garden_round_bucket($kpiOverlay);
    }
    if (is_array($planOverlay) && (float) $tot['plan'] <= 0 && (float) $planOverlay['plan'] > 0) {
        foreach (array('plan', 'plan_abi', 'plan_dim', 'plan_bar', 'plan_nobar') as $k) {
            $tot[$k] = isset($planOverlay[$k]) ? (float) $planOverlay[$k] : 0;
        }
        $tot = dash_garden_round_bucket($tot);
    }
    if (is_array($cutOverlay) && (float) $tot['cut'] <= 0 && (float) $cutOverlay['cut'] > 0) {
        foreach (array('cut', 'cut_abi', 'cut_dim', 'cut_bar', 'cut_nobar') as $k) {
            $tot[$k] = isset($cutOverlay[$k]) ? (float) $cutOverlay[$k] : 0;
        }
        $tot = dash_garden_round_bucket($tot);
    }

    $places = array();
    foreach ($labels as $gid => $meta) {
        $b = isset($byGeo[$gid]) ? $byGeo[$gid] : dash_garden_empty_bucket();
        if ((float) $b['plan'] > 0) {
            $rz = dash_garden_realize($b['cut'], $b['plan']);
        } elseif ((float) $b['cut'] > 0) {
            $rz = dash_garden_realize($b['plant'], $b['cut']);
        } else {
            $rz = dash_garden_realize(0, 0);
        }
        $places[] = array_merge($meta, $b, array(
            'gid' => $gid,
            'name_key' => dash_norm_fa($meta['label']),
            'realize_pct' => $rz['pct'],
            'realize_status' => $rz['status']
        ));
    }

    $shareMode = 'group';
    if ($product_cod !== '') {
        $shareMode = ($fruit === 'all') ? 'fruit' : 'water';
    } elseif ($group_cod !== '') {
        $shareMode = 'product';
    }
    $share = array();
    if ($shareMode === 'water') {
        $share = array(
            array('label' => 'آبی', 'plant' => $tot['plant_abi'], 'baror' => $tot['baror_abi'], 'pred' => 0),
            array('label' => 'دیم', 'plant' => $tot['plant_dim'], 'baror' => $tot['baror_dim'], 'pred' => 0)
        );
    } elseif ($shareMode === 'fruit') {
        $share = array(
            array('label' => 'بارور', 'plant' => $tot['baror'], 'baror' => $tot['baror'], 'pred' => $tot['pred']),
            array('label' => 'غیربارور', 'plant' => $tot['nonbaror'], 'baror' => 0, 'pred' => 0)
        );
    } elseif ($shareMode === 'product') {
        foreach ($byProd as $pid => $b) {
            $b = dash_garden_round_bucket($b);
            $name = $pid;
            if (isset($catalog['map'][$pid])) {
                $name = $catalog['map'][$pid]['product_name'];
            }
            $share[] = array(
                'code' => $pid,
                'label' => $name,
                'plant' => $b['plant'],
                'baror' => $b['baror'],
                'pred' => $b['pred']
            );
        }
        usort($share, 'dash_garden_share_sort');
        if (count($share) > 12) {
            $share = array_slice($share, 0, 12);
        }
    } else {
        $gacc = array();
        foreach ($byProd as $pid => $b) {
            $gc = 'none';
            $gn = 'سایر';
            if (isset($catalog['map'][$pid])) {
                $gc = $catalog['map'][$pid]['group_cod'];
                $gn = $catalog['map'][$pid]['group_name'];
            }
            if (!isset($gacc[$gc])) {
                $gacc[$gc] = array('code' => $gc, 'label' => $gn, 'plant' => 0, 'baror' => 0, 'pred' => 0);
            }
            $gacc[$gc]['plant'] += $b['plant'];
            $gacc[$gc]['baror'] += $b['baror'];
            $gacc[$gc]['pred'] += $b['pred'];
        }
        foreach ($gacc as $row) {
            $row['plant'] = round($row['plant'], 2);
            $row['baror'] = round($row['baror'], 2);
            $row['pred'] = round($row['pred'], 2);
            $share[] = $row;
        }
        usort($share, 'dash_garden_share_sort');
    }

    $rzTot = dash_garden_realize($tot['cut'], $tot['plan']);
    $yield = null;
    if ($product_cod !== '' && $tot['baror'] > 0) {
        $yield = (int) round(($tot['prod'] / $tot['baror']) * 1000);
    }
    $barorPct = null;
    if ($tot['plant'] > 0) {
        $barorPct = round(($tot['baror'] / $tot['plant']) * 100, 1);
    }

    $groupName = '';
    $productName = '';
    if ($group_cod !== '' && isset($catalog['groups'])) {
        foreach ($catalog['groups'] as $g) {
            if ($g['group_cod'] === $group_cod) {
                $groupName = $g['group_name'];
                break;
            }
        }
    }
    if ($product_cod !== '' && isset($catalog['map'][$product_cod])) {
        $productName = $catalog['map'][$product_cod]['product_name'];
        if ($groupName === '') {
            $groupName = $catalog['map'][$product_cod]['group_name'];
        }
    }

    $rankTitle = 'رتبه‌بندی استان‌ها';
    if ($level === 'ostan') {
        $rankTitle = 'رتبه‌بندی شهرستان‌ها';
    } elseif ($level === 'city' || $level === 'mar') {
        $rankTitle = 'رتبه‌بندی مراکز';
    }

    return array(
        'catalog' => array(
            'groups' => $catalog['groups'],
            'products' => $catalog['products']
        ),
        'filter' => array(
            'group_cod' => $group_cod,
            'group_name' => $groupName,
            'product_cod' => $product_cod,
            'product_name' => $productName,
            'water' => $water,
            'fruit' => $fruit
        ),
        'kpi' => array(
            'plant' => array(
                'total' => $tot['plant'],
                'abi' => $tot['plant_abi'],
                'dim' => $tot['plant_dim']
            ),
            'baror' => array(
                'total' => $tot['baror'],
                'abi' => $tot['baror_abi'],
                'dim' => $tot['baror_dim']
            ),
            'nonbaror' => array(
                'total' => $tot['nonbaror'],
                'abi' => $tot['nonbaror_abi'],
                'dim' => $tot['nonbaror_dim']
            ),
            'baror_pct' => $barorPct,
            'trees' => array(
                'baror' => round($tot['tree_b'] / 1000, 1),
                'nonbaror' => round($tot['tree_gb'] / 1000, 1)
            ),
            'prod' => round($tot['prod'], 2),
            'pred' => round($tot['pred'], 2),
            'yield_kg_ha' => $yield,
            'plan' => array(
                'total' => $tot['plan'],
                'abi' => $tot['plan_abi'],
                'dim' => $tot['plan_dim'],
                'baror' => $tot['plan_bar'],
                'nonbaror' => $tot['plan_nobar']
            ),
            'cut' => array(
                'total' => $tot['cut'],
                'abi' => $tot['cut_abi'],
                'dim' => $tot['cut_dim'],
                'baror' => $tot['cut_bar'],
                'nonbaror' => $tot['cut_nobar']
            ),
            'realize_pct' => $rzTot['pct'],
            'realize_status' => $rzTot['status']
        ),
        'share_mode' => $shareMode,
        'share' => $share,
        'places' => $places,
        'rank_title' => $rankTitle,
        'unit' => 'هکتار',
        'missing_prod' => $missingProd ? true : false,
        'missing_plan' => $missingPlan ? true : false,
        'missing_cut' => $missingCut ? true : false
    );
}

function dash_garden_collect($dbh, $level, $id_ostan, $id_city, $id_mar, $year, $group_cod, $product_cod, $water, $fruit)
{
    $catalog = dash_garden_catalog($dbh);
    $codes = dash_garden_filter_codes($catalog, $group_cod, $product_cod);
    $water = dash_garden_norm_water($water);
    $fruit = dash_garden_norm_fruit($fruit);
    $year = (int) $year;
    $abYear = dash_garden_resolve_ab_year($dbh, $year);
    list($geoSql, $geoParams) = dash_geo_sql($id_ostan, $id_city, $id_mar, '', true);
    list($geoKey, $labels) = dash_garden_geo_meta($dbh, $level, $id_ostan, $id_city, $id_mar);

    $prodRows = dash_garden_load_prod($dbh, $geoKey, $geoSql, $geoParams, $codes, $year, $water, $fruit, true);
    if (!$prodRows) {
        $prodRows = dash_garden_load_prod($dbh, $geoKey, $geoSql, $geoParams, $codes, $year, $water, $fruit, false);
    }

    list($planGeoSql, $planGeoParams) = dash_garden_plan_geo('Garden_ab_ostan', $id_ostan, '', '');
    $planRows = dash_garden_load_plan(
        $dbh,
        'Garden_ab_ostan',
        'id_ostan',
        $planGeoSql,
        $planGeoParams,
        $codes,
        $group_cod,
        $abYear,
        $water,
        $fruit
    );

    $cutGeoKey = ($level === 'country') ? 'id_ostan' : 'id_city';
    list($cutGeoSql, $cutGeoParams) = dash_garden_plan_geo('Garden_ab_city', $id_ostan, $id_city, '');
    $cutRows = dash_garden_load_plan(
        $dbh,
        'Garden_ab_city',
        $cutGeoKey,
        $cutGeoSql,
        $cutGeoParams,
        $codes,
        $group_cod,
        $abYear,
        $water,
        $fruit
    );

    $planOverlay = null;
    $cutOverlay = null;
    if ($level !== 'country') {
        $planOverlay = dash_garden_sum_plan_rows($planRows);
    }
    if ($level === 'city' || $level === 'mar') {
        $cutOverlay = dash_garden_sum_cut_rows($cutRows);
    }

    $byGeo = array();
    $byProd = array();
    foreach ($labels as $gid => $meta) {
        $byGeo[$gid] = dash_garden_empty_bucket();
    }

    foreach ($prodRows as $r) {
        $gid = dash_garden_match_gid($geoKey, isset($r['gid']) ? $r['gid'] : '', $labels);
        $pid = trim((string) $r['pid']);
        $nk = trim((string) $r['nk']);
        $baror = (float) $r['baror'];
        $nonbaror = (float) $r['nonbaror'];
        $plant = $baror + $nonbaror;
        $prod = (float) $r['prod'];
        $pred = (float) $r['pred'];
        $treeB = (float) $r['tree_b'];
        $treeGb = (float) $r['tree_gb'];
        if (!isset($byGeo[$gid])) {
            $byGeo[$gid] = dash_garden_empty_bucket();
        }
        if (!isset($byProd[$pid])) {
            $byProd[$pid] = dash_garden_empty_bucket();
        }
        $add = array(
            'plant' => $plant,
            'baror' => $baror,
            'nonbaror' => $nonbaror,
            'prod' => $prod,
            'pred' => $pred,
            'tree_b' => $treeB,
            'tree_gb' => $treeGb
        );
        if ($nk === '1') {
            $add['plant_abi'] = $plant;
            $add['baror_abi'] = $baror;
            $add['nonbaror_abi'] = $nonbaror;
        } elseif ($nk === '2') {
            $add['plant_dim'] = $plant;
            $add['baror_dim'] = $baror;
            $add['nonbaror_dim'] = $nonbaror;
        }
        dash_garden_add_bucket($byGeo[$gid], $add);
        dash_garden_add_bucket($byProd[$pid], $add);
    }

    if ($level === 'country') {
        dash_garden_apply_ab_rows($byGeo, $byProd, $planRows, 'id_ostan', $labels, 'dash_garden_plan_add_from_row');
    } else {
        $planOnly = array();
        dash_garden_apply_ab_rows($planOnly, $byProd, $planRows, 'id_ostan', array(), 'dash_garden_plan_add_from_row');
    }
    if ($level === 'city' || $level === 'mar') {
        $cutOnly = array();
        dash_garden_apply_ab_rows($cutOnly, $byProd, $cutRows, 'id_city', array(), 'dash_garden_cut_add_from_row');
    } else {
        dash_garden_apply_ab_rows($byGeo, $byProd, $cutRows, $cutGeoKey, $labels, 'dash_garden_cut_add_from_row');
    }

    return dash_garden_assemble(
        $catalog,
        $level,
        $group_cod,
        $product_cod,
        $water,
        $fruit,
        $byGeo,
        $byProd,
        $labels,
        !dash_table_exists($dbh, 'Garden_prod'),
        !dash_table_exists($dbh, 'Garden_ab_ostan'),
        $planOverlay,
        $cutOverlay,
        !dash_table_exists($dbh, 'Garden_ab_city')
    );
}

function dash_garden_choropleth($dbh, $year)
{
    $year = (int) $year;
    $map = array();
    if ($dbh && dash_table_exists($dbh, 'Garden_prod')) {
        $rows = dash_rows(
            $dbh,
            'SELECT id_ostan,
                    COALESCE(SUM(IFNULL(s_kesht_b,0) + IFNULL(s_kesht_gb,0)), 0) AS c
             FROM Garden_prod
             WHERE ' . dash_garden_year_sql(true) . '
             GROUP BY id_ostan',
            dash_garden_year_params($year)
        );
        if (!$rows) {
            $rows = dash_rows(
                $dbh,
                'SELECT id_ostan,
                        COALESCE(SUM(IFNULL(s_kesht_b,0) + IFNULL(s_kesht_gb,0)), 0) AS c
                 FROM Garden_prod
                 WHERE ' . dash_garden_year_sql(false) . '
                 GROUP BY id_ostan',
                dash_garden_year_params($year)
            );
        }
        foreach ($rows as $r) {
            $map[dash_garden_pad_ostan(trim((string) $r['id_ostan']))] = (float) $r['c'];
        }
    }
    $ostan = dash_rows($dbh, 'SELECT id_ostan, ostan FROM ostanname', array());
    $out = array();
    foreach ($ostan as $o) {
        $id = dash_garden_pad_ostan(trim((string) $o['id_ostan']));
        $out[] = array(
            'id_ostan' => $id,
            'ostan' => $o['ostan'],
            'name_key' => dash_norm_fa($o['ostan']),
            'value' => isset($map[$id]) ? round($map[$id], 2) : 0
        );
    }
    return $out;
}

function dash_garden_snap_tables()
{
    return array('dash_snap_garden_open', 'dash_snap_garden_locked');
}

function dash_garden_snap_table($yearOpen)
{
    return $yearOpen ? 'dash_snap_garden_open' : 'dash_snap_garden_locked';
}

function dash_garden_snap_lookup($dbh, $year, $yearOpen)
{
    $order = $yearOpen
        ? array('dash_snap_garden_open', 'dash_snap_garden_locked')
        : array('dash_snap_garden_locked', 'dash_snap_garden_open');
    foreach ($order as $table) {
        $hit = dash_garden_snap_has($dbh, $table, $year);
        if ($hit) {
            return array($table, $hit);
        }
    }
    return array(dash_garden_snap_table($yearOpen), false);
}

function dash_garden_snap_numeric_keys()
{
    return array(
        'baror_abi', 'baror_dim', 'nonbaror_abi', 'nonbaror_dim',
        'tree_b_abi', 'tree_b_dim', 'tree_gb_abi', 'tree_gb_dim',
        'prod_abi', 'prod_dim', 'pred_abi', 'pred_dim',
        'plan_bar_abi', 'plan_bar_dim', 'plan_nobar_abi', 'plan_nobar_dim',
        'cut_bar_abi', 'cut_bar_dim', 'cut_nobar_abi', 'cut_nobar_dim'
    );
}

function dash_garden_snap_ddl($table)
{
    if ($table !== 'dash_snap_garden_open' && $table !== 'dash_snap_garden_locked') {
        return '';
    }
    $uq = ($table === 'dash_snap_garden_locked') ? 'uq_dash_snap_garden_locked' : 'uq_dash_snap_garden_open';
    return "CREATE TABLE IF NOT EXISTS `$table` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `year_agri` varchar(4) NOT NULL,
      `level_code` enum('country','ostan') NOT NULL,
      `id_ostan` varchar(2) NOT NULL DEFAULT '',
      `product_cod` varchar(20) NOT NULL,
      `group_cod` varchar(20) NOT NULL DEFAULT '',
      `baror_abi` double NOT NULL DEFAULT '0',
      `baror_dim` double NOT NULL DEFAULT '0',
      `nonbaror_abi` double NOT NULL DEFAULT '0',
      `nonbaror_dim` double NOT NULL DEFAULT '0',
      `tree_b_abi` double NOT NULL DEFAULT '0',
      `tree_b_dim` double NOT NULL DEFAULT '0',
      `tree_gb_abi` double NOT NULL DEFAULT '0',
      `tree_gb_dim` double NOT NULL DEFAULT '0',
      `prod_abi` double NOT NULL DEFAULT '0',
      `prod_dim` double NOT NULL DEFAULT '0',
      `pred_abi` double NOT NULL DEFAULT '0',
      `pred_dim` double NOT NULL DEFAULT '0',
      `plan_bar_abi` double NOT NULL DEFAULT '0',
      `plan_bar_dim` double NOT NULL DEFAULT '0',
      `plan_nobar_abi` double NOT NULL DEFAULT '0',
      `plan_nobar_dim` double NOT NULL DEFAULT '0',
      `cut_bar_abi` double NOT NULL DEFAULT '0',
      `cut_bar_dim` double NOT NULL DEFAULT '0',
      `cut_nobar_abi` double NOT NULL DEFAULT '0',
      `cut_nobar_dim` double NOT NULL DEFAULT '0',
      `built_at` datetime NOT NULL,
      `build_ms` int(10) unsigned DEFAULT NULL,
      `source_ver` varchar(20) DEFAULT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `$uq` (`year_agri`,`level_code`,`id_ostan`,`product_cod`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci";
}

function dash_garden_snap_ensure($dbh)
{
    if (!$dbh) {
        return false;
    }
    foreach (dash_garden_snap_tables() as $name) {
        if (dash_table_exists($dbh, $name)) {
            continue;
        }
        $sql = dash_garden_snap_ddl($name);
        if ($sql === '') {
            return false;
        }
        try {
            $dbh->exec($sql);
        } catch (Exception $e) {
            return false;
        }
        if (!dash_table_exists($dbh, $name)) {
            return false;
        }
    }
    return true;
}

function dash_garden_snap_empty_cell()
{
    $cell = array('group_cod' => '');
    foreach (dash_garden_snap_numeric_keys() as $k) {
        $cell[$k] = 0;
    }
    return $cell;
}

function dash_garden_snap_cell_nonzero($cell)
{
    foreach (dash_garden_snap_numeric_keys() as $k) {
        if (isset($cell[$k]) && (float) $cell[$k] != 0) {
            return true;
        }
    }
    return false;
}

function dash_garden_snap_touch_cell(&$acc, $idOstan, $pid, $groupCod)
{
    $idOstan = dash_garden_pad_ostan(trim((string) $idOstan));
    $pid = trim((string) $pid);
    if ($pid === '') {
        return null;
    }
    if (!isset($acc[$idOstan])) {
        $acc[$idOstan] = array();
    }
    if (!isset($acc[$idOstan][$pid])) {
        $acc[$idOstan][$pid] = dash_garden_snap_empty_cell();
    }
    if ($groupCod !== '' && $acc[$idOstan][$pid]['group_cod'] === '') {
        $acc[$idOstan][$pid]['group_cod'] = $groupCod;
    }
    return $pid;
}

function dash_garden_snap_upsert($dbh, $table, $row)
{
    if ($table !== 'dash_snap_garden_open' && $table !== 'dash_snap_garden_locked') {
        return false;
    }
    $keys = dash_garden_snap_numeric_keys();
    $cols = array_merge(
        array('year_agri', 'level_code', 'id_ostan', 'product_cod', 'group_cod'),
        $keys,
        array('built_at', 'build_ms', 'source_ver')
    );
    $ph = implode(',', array_fill(0, count($cols), '?'));
    $upd = array();
    foreach (array_merge(array('group_cod'), $keys, array('built_at', 'build_ms', 'source_ver')) as $c) {
        $upd[] = $c . '=VALUES(' . $c . ')';
    }
    $sql = 'INSERT INTO `' . $table . '` (' . implode(',', $cols) . ') VALUES (' . $ph . ')
            ON DUPLICATE KEY UPDATE ' . implode(',', $upd);
    $vals = array();
    foreach ($cols as $c) {
        $vals[] = isset($row[$c]) ? $row[$c] : '';
    }
    try {
        $stmt = $dbh->prepare($sql);
        if (!$stmt) {
            return false;
        }
        return $stmt->execute($vals);
    } catch (Exception $e) {
        $GLOBALS['dash_garden_snap_last_error'] = $e->getMessage();
        return false;
    }
}

function dash_garden_snap_pack_row($year, $level, $idOstan, $pid, $cell, $builtAt, $ms, $ver)
{
    $row = array(
        'year_agri' => (string) ((int) $year),
        'level_code' => $level,
        'id_ostan' => $idOstan,
        'product_cod' => $pid,
        'group_cod' => isset($cell['group_cod']) ? $cell['group_cod'] : '',
        'built_at' => $builtAt,
        'build_ms' => (int) $ms,
        'source_ver' => $ver
    );
    foreach (dash_garden_snap_numeric_keys() as $k) {
        $row[$k] = round(isset($cell[$k]) ? (float) $cell[$k] : 0, 4);
    }
    return $row;
}

function dash_garden_snap_build_year($dbh, $year, $ver, $table)
{
    $year = (string) ((int) $year);
    $result = array('year' => $year, 'rows' => 0, 'ostan' => 0, 'country' => 0, 'errors' => array(), 'table' => $table);
    if ($table !== 'dash_snap_garden_open' && $table !== 'dash_snap_garden_locked') {
        $result['errors'][] = 'bad garden snap table';
        return $result;
    }
    if (!dash_garden_snap_ensure($dbh)) {
        $result['errors'][] = 'cannot ensure garden snap tables';
        return $result;
    }

    $catalog = dash_garden_catalog($dbh);
    $map = isset($catalog['map']) ? $catalog['map'] : array();
    $acc = array();
    $t0 = microtime(true);
    $builtAt = date('Y-m-d H:i:s');
    $abYear = dash_garden_resolve_ab_year($dbh, $year);

    if (dash_table_exists($dbh, 'Garden_prod')) {
        $prodRows = dash_rows(
            $dbh,
            'SELECT id_ostan AS gid, cod_mah AS pid, no_kesh AS nk,
                    COALESCE(SUM(IFNULL(s_kesht_b,0)), 0) AS baror,
                    COALESCE(SUM(IFNULL(s_kesht_gb,0)), 0) AS nonbaror,
                    COALESCE(SUM(IFNULL(tree_b,0)), 0) AS tree_b,
                    COALESCE(SUM(IFNULL(tree_gb,0)), 0) AS tree_gb,
                    COALESCE(SUM(IFNULL(mah_tol,0)), 0) AS prod,
                    COALESCE(SUM(IFNULL(mah_tolp,0)), 0) AS pred
             FROM Garden_prod
             WHERE ' . dash_garden_year_sql() . '
             GROUP BY id_ostan, cod_mah, no_kesh',
            dash_garden_year_params($year)
        );
        foreach ($prodRows as $r) {
            $gid = trim((string) $r['gid']);
            $pid = trim((string) $r['pid']);
            $gc = (isset($map[$pid]) && isset($map[$pid]['group_cod'])) ? $map[$pid]['group_cod'] : '';
            if (dash_garden_snap_touch_cell($acc, $gid, $pid, $gc) === null) {
                continue;
            }
            $gid = dash_garden_pad_ostan($gid);
            if ($gid === '') {
                continue;
            }
            $nk = trim((string) $r['nk']);
            $side = ($nk === '2') ? 'dim' : 'abi';
            $acc[$gid][$pid]['baror_' . $side] += (float) $r['baror'];
            $acc[$gid][$pid]['nonbaror_' . $side] += (float) $r['nonbaror'];
            $acc[$gid][$pid]['tree_b_' . $side] += (float) $r['tree_b'];
            $acc[$gid][$pid]['tree_gb_' . $side] += (float) $r['tree_gb'];
            $acc[$gid][$pid]['prod_' . $side] += (float) $r['prod'];
            $acc[$gid][$pid]['pred_' . $side] += (float) $r['pred'];
        }
    } else {
        $result['errors'][] = 'missing table Garden_prod';
    }

    if (dash_table_exists($dbh, 'Garden_ab_ostan')) {
        $planRows = dash_rows(
            $dbh,
            "SELECT id_ostan AS gid, product_cod AS pid,
                    COALESCE(SUM(IFNULL(s_bar_abi,0)), 0) AS bar_abi,
                    COALESCE(SUM(IFNULL(s_bar_dem,0)), 0) AS bar_dim,
                    COALESCE(SUM(IFNULL(s_nobar_abi,0)), 0) AS nobar_abi,
                    COALESCE(SUM(IFNULL(s_nobar_dem,0)), 0) AS nobar_dim
             FROM Garden_ab_ostan
             WHERE " . dash_garden_ab_year_sql() . '
             GROUP BY id_ostan, product_cod',
            array($abYear)
        );
        foreach ($planRows as $r) {
            $gid = trim((string) $r['gid']);
            $pid = trim((string) $r['pid']);
            $gc = (isset($map[$pid]) && isset($map[$pid]['group_cod'])) ? $map[$pid]['group_cod'] : '';
            if (dash_garden_snap_touch_cell($acc, $gid, $pid, $gc) === null) {
                continue;
            }
            $gid = dash_garden_pad_ostan($gid);
            if ($gid === '') {
                continue;
            }
            $acc[$gid][$pid]['plan_bar_abi'] += (float) $r['bar_abi'];
            $acc[$gid][$pid]['plan_bar_dim'] += (float) $r['bar_dim'];
            $acc[$gid][$pid]['plan_nobar_abi'] += (float) $r['nobar_abi'];
            $acc[$gid][$pid]['plan_nobar_dim'] += (float) $r['nobar_dim'];
        }
    }

    if (dash_table_exists($dbh, 'Garden_ab_city')) {
        $cutRows = dash_rows(
            $dbh,
            "SELECT id_ostan AS gid, product_cod AS pid,
                    COALESCE(SUM(IFNULL(s_bar_abi,0)), 0) AS bar_abi,
                    COALESCE(SUM(IFNULL(s_bar_dem,0)), 0) AS bar_dim,
                    COALESCE(SUM(IFNULL(s_nobar_abi,0)), 0) AS nobar_abi,
                    COALESCE(SUM(IFNULL(s_nobar_dem,0)), 0) AS nobar_dim
             FROM Garden_ab_city
             WHERE " . dash_garden_ab_year_sql() . '
             GROUP BY id_ostan, product_cod',
            array($abYear)
        );
        foreach ($cutRows as $r) {
            $gid = trim((string) $r['gid']);
            $pid = trim((string) $r['pid']);
            $gc = (isset($map[$pid]) && isset($map[$pid]['group_cod'])) ? $map[$pid]['group_cod'] : '';
            if (dash_garden_snap_touch_cell($acc, $gid, $pid, $gc) === null) {
                continue;
            }
            $gid = dash_garden_pad_ostan($gid);
            if ($gid === '') {
                continue;
            }
            $acc[$gid][$pid]['cut_bar_abi'] += (float) $r['bar_abi'];
            $acc[$gid][$pid]['cut_bar_dim'] += (float) $r['bar_dim'];
            $acc[$gid][$pid]['cut_nobar_abi'] += (float) $r['nobar_abi'];
            $acc[$gid][$pid]['cut_nobar_dim'] += (float) $r['nobar_dim'];
        }
    }

    $country = array();
    foreach ($acc as $gid => $prods) {
        foreach ($prods as $pid => $cell) {
            if (!isset($country[$pid])) {
                $country[$pid] = dash_garden_snap_empty_cell();
            }
            if ($cell['group_cod'] !== '' && $country[$pid]['group_cod'] === '') {
                $country[$pid]['group_cod'] = $cell['group_cod'];
            }
            foreach (dash_garden_snap_numeric_keys() as $k) {
                $country[$pid][$k] += (float) $cell[$k];
            }
        }
    }

    $ms = (int) round((microtime(true) - $t0) * 1000);

    try {
        $del = $dbh->prepare("DELETE FROM `$table` WHERE year_agri = ?");
        if ($del) {
            $del->execute(array($year));
        }
    } catch (Exception $e) {
        $result['errors'][] = 'delete year failed: ' . $e->getMessage();
        return $result;
    }

    foreach ($acc as $gid => $prods) {
        foreach ($prods as $pid => $cell) {
            if (!dash_garden_snap_cell_nonzero($cell)) {
                continue;
            }
            $row = dash_garden_snap_pack_row($year, 'ostan', $gid, $pid, $cell, $builtAt, $ms, $ver);
            if (dash_garden_snap_upsert($dbh, $table, $row)) {
                $result['rows']++;
                $result['ostan']++;
            } else {
                $err = isset($GLOBALS['dash_garden_snap_last_error']) ? $GLOBALS['dash_garden_snap_last_error'] : '';
                $result['errors'][] = 'upsert ostan ' . $gid . '/' . $pid . ($err !== '' ? (': ' . $err) : '');
                if (count($result['errors']) > 12) {
                    return $result;
                }
            }
        }
    }
    foreach ($country as $pid => $cell) {
        if (!dash_garden_snap_cell_nonzero($cell)) {
            continue;
        }
        $row = dash_garden_snap_pack_row($year, 'country', '', $pid, $cell, $builtAt, $ms, $ver);
        if (dash_garden_snap_upsert($dbh, $table, $row)) {
            $result['rows']++;
            $result['country']++;
        } else {
            $err = isset($GLOBALS['dash_garden_snap_last_error']) ? $GLOBALS['dash_garden_snap_last_error'] : '';
            $result['errors'][] = 'upsert country/' . $pid . ($err !== '' ? (': ' . $err) : '');
        }
    }

    return $result;
}

function dash_garden_snap_has($dbh, $table, $year)
{
    if ($table !== 'dash_snap_garden_open' && $table !== 'dash_snap_garden_locked') {
        return false;
    }
    if (!$dbh || !dash_table_exists($dbh, $table)) {
        return false;
    }
    $year = (string) ((int) $year);
    $rows = dash_rows(
        $dbh,
        "SELECT built_at FROM `$table` WHERE year_agri = ? LIMIT 1",
        array($year)
    );
    return $rows ? $rows : false;
}

function dash_garden_snap_select_cols()
{
    return 'level_code, id_ostan, product_cod, group_cod,
            baror_abi, baror_dim, nonbaror_abi, nonbaror_dim,
            tree_b_abi, tree_b_dim, tree_gb_abi, tree_gb_dim,
            prod_abi, prod_dim, pred_abi, pred_dim,
            plan_bar_abi, plan_bar_dim, plan_nobar_abi, plan_nobar_dim,
            cut_bar_abi, cut_bar_dim, cut_nobar_abi, cut_nobar_dim,
            built_at';
}

function dash_garden_snap_where($year, $codes, $levelCode = '', $id_ostan = '')
{
    $w = array('year_agri = ?');
    $p = array((string) ((int) $year));
    if ($levelCode !== '') {
        $w[] = 'level_code = ?';
        $p[] = $levelCode;
    }
    $id_ostan = trim((string) $id_ostan);
    if ($id_ostan !== '') {
        $pad = dash_garden_pad_ostan($id_ostan);
        if ($pad !== '' && $pad !== $id_ostan) {
            $w[] = '(id_ostan = ? OR id_ostan = ?)';
            $p[] = $pad;
            $p[] = $id_ostan;
        } else {
            $w[] = 'id_ostan = ?';
            $p[] = ($pad !== '') ? $pad : $id_ostan;
        }
    }
    if (is_array($codes) && $codes) {
        $in = dash_garden_in('product_cod', $codes);
        $w[] = $in[0];
        $p = array_merge($p, $in[1]);
    }
    return array(implode(' AND ', $w), $p);
}

function dash_garden_snap_choropleth($dbh, $table, $year, $water, $fruit, $codes)
{
    if ($table !== 'dash_snap_garden_open' && $table !== 'dash_snap_garden_locked') {
        return array();
    }
    $water = dash_garden_norm_water($water);
    $fruit = dash_garden_norm_fruit($fruit);
    list($where, $params) = dash_garden_snap_where($year, $codes, 'ostan', '');
    $rows = dash_rows(
        $dbh,
        'SELECT ' . dash_garden_snap_select_cols() . " FROM `$table` WHERE " . $where,
        $params
    );
    $map = array();
    foreach ($rows as $r) {
        $id = dash_garden_pad_ostan(trim((string) $r['id_ostan']));
        if ($id === '') {
            continue;
        }
        $b = dash_garden_snap_row_bucket($r, $water, $fruit);
        if (!isset($map[$id])) {
            $map[$id] = 0;
        }
        $map[$id] += (float) $b['plant'];
    }
    $ostan = dash_rows($dbh, 'SELECT id_ostan, ostan FROM ostanname', array());
    $out = array();
    foreach ($ostan as $o) {
        $id = dash_garden_pad_ostan(trim((string) $o['id_ostan']));
        $out[] = array(
            'id_ostan' => $id,
            'ostan' => $o['ostan'],
            'name_key' => dash_norm_fa($o['ostan']),
            'value' => isset($map[$id]) ? round($map[$id], 2) : 0
        );
    }
    return $out;
}

function dash_garden_prod_add_from_row($r)
{
    $baror = (float) $r['baror'];
    $nonbaror = (float) $r['nonbaror'];
    $plant = $baror + $nonbaror;
    $nk = trim((string) $r['nk']);
    $add = array(
        'plant' => $plant,
        'baror' => $baror,
        'nonbaror' => $nonbaror,
        'prod' => (float) $r['prod'],
        'pred' => (float) $r['pred'],
        'tree_b' => (float) $r['tree_b'],
        'tree_gb' => (float) $r['tree_gb']
    );
    if ($nk === '1') {
        $add['plant_abi'] = $plant;
        $add['baror_abi'] = $baror;
        $add['nonbaror_abi'] = $nonbaror;
    } elseif ($nk === '2') {
        $add['plant_dim'] = $plant;
        $add['baror_dim'] = $baror;
        $add['nonbaror_dim'] = $nonbaror;
    }
    return $add;
}

function dash_garden_city_geo_buckets($dbh, $id_ostan, $year, $codes, $water, $fruit)
{
    list($geoKey, $labels) = dash_garden_geo_meta($dbh, 'ostan', $id_ostan, '', '');
    list($geoSql, $geoParams) = dash_geo_sql($id_ostan, '', '', '', true);
    $byGeo = array();
    foreach ($labels as $gid => $meta) {
        $byGeo[$gid] = dash_garden_empty_bucket();
    }
    $prodRows = dash_garden_load_prod($dbh, $geoKey, $geoSql, $geoParams, $codes, $year, $water, $fruit, true);
    if (!$prodRows) {
        $prodRows = dash_garden_load_prod($dbh, $geoKey, $geoSql, $geoParams, $codes, $year, $water, $fruit, false);
    }
    foreach ($prodRows as $r) {
        $gid = dash_garden_match_gid($geoKey, isset($r['gid']) ? $r['gid'] : '', $labels);
        if ($gid === '') {
            continue;
        }
        if (!isset($byGeo[$gid])) {
            $byGeo[$gid] = dash_garden_empty_bucket();
        }
        dash_garden_add_bucket($byGeo[$gid], dash_garden_prod_add_from_row($r));
    }
    $dummyProd = array();
    $abYear = dash_garden_resolve_ab_year($dbh, $year);
    list($cutGeoSql, $cutGeoParams) = dash_garden_plan_geo('Garden_ab_city', $id_ostan, '', '');
    $cutRows = dash_garden_load_plan(
        $dbh,
        'Garden_ab_city',
        'id_city',
        $cutGeoSql,
        $cutGeoParams,
        $codes,
        '',
        $abYear,
        $water,
        $fruit
    );
    dash_garden_apply_ab_rows($byGeo, $dummyProd, $cutRows, 'id_city', $labels, 'dash_garden_cut_add_from_row');
    return array($byGeo, $labels);
}

function dash_garden_snap_row_bucket($r, $water, $fruit)
{
    $b = dash_garden_empty_bucket();
    $useAbi = ($water !== 'dim');
    $useDim = ($water !== 'abi');
    $useBar = ($fruit !== 'nonbaror');
    $useNobar = ($fruit !== 'baror');
    $sides = array();
    if ($useAbi) {
        $sides[] = 'abi';
    }
    if ($useDim) {
        $sides[] = 'dim';
    }
    foreach ($sides as $side) {
        $bar = $useBar ? (float) $r['baror_' . $side] : 0;
        $nobar = $useNobar ? (float) $r['nonbaror_' . $side] : 0;
        $treeB = $useBar ? (float) $r['tree_b_' . $side] : 0;
        $treeGb = $useNobar ? (float) $r['tree_gb_' . $side] : 0;
        $prod = $useBar ? (float) $r['prod_' . $side] : 0;
        $pred = $useBar ? (float) $r['pred_' . $side] : 0;
        $planBar = $useBar ? (float) $r['plan_bar_' . $side] : 0;
        $planNobar = $useNobar ? (float) $r['plan_nobar_' . $side] : 0;
        $cutBar = $useBar ? (float) $r['cut_bar_' . $side] : 0;
        $cutNobar = $useNobar ? (float) $r['cut_nobar_' . $side] : 0;
        $plant = $bar + $nobar;
        $b['plant_' . $side] = $plant;
        $b['baror_' . $side] = $bar;
        $b['nonbaror_' . $side] = $nobar;
        $b['plant'] += $plant;
        $b['baror'] += $bar;
        $b['nonbaror'] += $nobar;
        $b['tree_b'] += $treeB;
        $b['tree_gb'] += $treeGb;
        $b['prod'] += $prod;
        $b['pred'] += $pred;
        $b['plan_' . $side] += $planBar + $planNobar;
        $b['plan'] += $planBar + $planNobar;
        $b['plan_bar'] += $planBar;
        $b['plan_nobar'] += $planNobar;
        $b['cut_' . $side] += $cutBar + $cutNobar;
        $b['cut'] += $cutBar + $cutNobar;
        $b['cut_bar'] += $cutBar;
        $b['cut_nobar'] += $cutNobar;
    }
    return $b;
}

function dash_garden_collect_from_snap($dbh, $year, $group_cod, $product_cod, $water, $fruit, $table, $level = 'country', $id_ostan = '')
{
    if ($table !== 'dash_snap_garden_open' && $table !== 'dash_snap_garden_locked') {
        return null;
    }
    $catalog = dash_garden_catalog($dbh);
    $codes = dash_garden_filter_codes($catalog, $group_cod, $product_cod);
    $water = dash_garden_norm_water($water);
    $fruit = dash_garden_norm_fruit($fruit);
    $year = (int) $year;
    $level = ($level === 'ostan') ? 'ostan' : 'country';
    $id_ostan = trim((string) $id_ostan);

    list($where, $params) = dash_garden_snap_where(
        $year,
        $codes,
        $level === 'ostan' ? 'ostan' : '',
        $level === 'ostan' ? $id_ostan : ''
    );
    $rows = dash_rows(
        $dbh,
        'SELECT ' . dash_garden_snap_select_cols() . " FROM `$table` WHERE " . $where,
        $params
    );
    if (!$rows) {
        return null;
    }

    $builtAt = null;
    foreach ($rows as $r) {
        if ($builtAt === null && !empty($r['built_at'])) {
            $builtAt = $r['built_at'];
            break;
        }
    }

    if ($level === 'ostan') {
        list($byGeo, $labels) = dash_garden_city_geo_buckets($dbh, $id_ostan, $year, $codes, $water, $fruit);
        $byProd = array();
        $kpi = dash_garden_empty_bucket();
        foreach ($rows as $r) {
            $pid = trim((string) $r['product_cod']);
            if ($pid === '') {
                continue;
            }
            $b = dash_garden_snap_row_bucket($r, $water, $fruit);
            if (!isset($byProd[$pid])) {
                $byProd[$pid] = dash_garden_empty_bucket();
            }
            dash_garden_add_bucket($byProd[$pid], $b);
            dash_garden_add_bucket($kpi, $b);
        }
        $out = dash_garden_assemble(
            $catalog,
            'ostan',
            $group_cod,
            $product_cod,
            $water,
            $fruit,
            $byGeo,
            $byProd,
            $labels,
            false,
            false,
            null,
            null,
            false,
            $kpi
        );
        $out['built_at'] = $builtAt;
        return $out;
    }

    list($unusedGeoKey, $labels) = dash_garden_geo_meta($dbh, 'country', '', '', '');
    unset($unusedGeoKey);

    $byGeo = array();
    $byProdCountry = array();
    $byProdOstan = array();
    foreach ($labels as $gid => $meta) {
        $byGeo[$gid] = dash_garden_empty_bucket();
    }

    foreach ($rows as $r) {
        $pid = trim((string) $r['product_cod']);
        if ($pid === '') {
            continue;
        }
        $b = dash_garden_snap_row_bucket($r, $water, $fruit);
        $rowLevel = $r['level_code'];
        if ($rowLevel === 'country') {
            if (!isset($byProdCountry[$pid])) {
                $byProdCountry[$pid] = dash_garden_empty_bucket();
            }
            dash_garden_add_bucket($byProdCountry[$pid], $b);
        } elseif ($rowLevel === 'ostan') {
            $gid = dash_garden_match_gid('id_ostan', isset($r['id_ostan']) ? $r['id_ostan'] : '', $labels);
            if ($gid === '') {
                continue;
            }
            if (!isset($byGeo[$gid])) {
                $byGeo[$gid] = dash_garden_empty_bucket();
            }
            dash_garden_add_bucket($byGeo[$gid], $b);
            if (!isset($byProdOstan[$pid])) {
                $byProdOstan[$pid] = dash_garden_empty_bucket();
            }
            dash_garden_add_bucket($byProdOstan[$pid], $b);
        }
    }
    $byProd = $byProdCountry ? $byProdCountry : $byProdOstan;

    $out = dash_garden_assemble(
        $catalog,
        'country',
        $group_cod,
        $product_cod,
        $water,
        $fruit,
        $byGeo,
        $byProd,
        $labels,
        false,
        false,
        null,
        null,
        false
    );
    $out['built_at'] = $builtAt;
    return $out;
}

function dash_garden_locked_years_or_fallback($dbh)
{
    $years = dash_locked_years($dbh, array('garden'));
    if ($years) {
        return $years;
    }
    $open = dash_open_years($dbh, array('garden'));
    $all = array();
    $salRows = dash_rows($dbh, 'SELECT sal FROM b_sal ORDER BY sal ASC', array());
    foreach ($salRows as $r) {
        $s = trim($r['sal'] . '');
        if (preg_match('/^(13|14)\d{2}$/', $s) && !in_array($s, $all, true)) {
            $all[] = $s;
        }
        if (preg_match('/((?:13|14)\d{2})/', $s, $m)) {
            $y = $m[1];
            if (!in_array($y, $all, true)) {
                $all[] = $y;
            }
        }
    }
    $out = array();
    foreach ($all as $y) {
        if (!in_array($y, $open, true)) {
            $out[] = $y;
        }
    }
    sort($out);
    return $out;
}
