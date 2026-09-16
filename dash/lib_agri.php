<?php
/**
 * آمار داشبورد زراعت: Agri_prod + سه محصول صیفی در Vege_prod + الگوی Agri_ab_*.
 */
function dash_agri_vege_codes()
{
    return array('170', '172', '174');
}

function dash_agri_z_sal($year)
{
    $y = (int) $year;
    return $y . '-' . ($y + 1);
}

function dash_agri_prod_table($year)
{
    $y = (int) $year;
    return 'Agri_prod' . $y . '_' . ($y + 1);
}

function dash_agri_in($col, $codes)
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

function dash_agri_catalog($dbh)
{
    $groups = array();
    $products = array();
    $byGroup = array();
    $map = array();
    $rows = dash_rows(
        $dbh,
        'SELECT group_cod, group_name, product_cod, product_name
         FROM product_z
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
            'group_name' => $r['group_name'],
            'vege' => in_array($pc, dash_agri_vege_codes(), true)
        );
        $products[] = $item;
        $byGroup[$gc][] = $item;
        $map[$pc] = $item;
    }
    $glist = array_values($groups);
    return array(
        'groups' => $glist,
        'products' => $products,
        'by_group' => $byGroup,
        'map' => $map
    );
}

function dash_agri_filter_codes($catalog, $group_cod, $product_cod)
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
        }
        return $all;
    }
    return null;
}

function dash_agri_empty_bucket()
{
    return array(
        'plant' => 0,
        'plant_abi' => 0,
        'plant_dim' => 0,
        'harvest' => 0,
        'harvest_abi' => 0,
        'harvest_dim' => 0,
        'prod' => 0,
        'pred' => 0,
        'plan' => 0,
        'plan_abi' => 0,
        'plan_dim' => 0
    );
}

function dash_agri_add_bucket(&$dst, $src)
{
    foreach ($src as $k => $v) {
        if (!isset($dst[$k])) {
            $dst[$k] = 0;
        }
        $dst[$k] += (float) $v;
    }
}

function dash_agri_round_bucket($b)
{
    foreach ($b as $k => $v) {
        $b[$k] = round((float) $v, 2);
    }
    return $b;
}

function dash_agri_realize($plant, $plan)
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

function dash_agri_geo_meta($dbh, $level, $id_ostan, $id_city, $id_mar)
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
            $id = trim((string) $r['id_ostan']);
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

function dash_agri_ab_table($level)
{
    if ($level === 'city' || $level === 'mar') {
        return 'Agri_ab_mar';
    }
    if ($level === 'ostan') {
        return 'Agri_ab_city';
    }
    return 'Agri_ab_ostan';
}

function dash_agri_load_prod($dbh, $table, $geoKey, $geoSql, $geoParams, $codes, $water)
{
    if (!$dbh || !dash_table_exists($dbh, $table)) {
        return array();
    }
    $w = array($geoSql);
    $p = $geoParams;
    if (is_array($codes)) {
        $in = dash_agri_in('cod_mah', $codes);
        $w[] = $in[0];
        $p = array_merge($p, $in[1]);
    }
    if ($water === 'abi') {
        $w[] = "no_kesh = '1'";
    } elseif ($water === 'dim') {
        $w[] = "no_kesh = '2'";
    }
    $sql = "SELECT `$geoKey` AS gid, cod_mah AS pid, no_kesh AS nk,
            COALESCE(SUM(IFNULL(zer_kesht_a,0) + IFNULL(zer_kesht_b,0)), 0) AS plant,
            COALESCE(SUM(IFNULL(s_bar_a,0) + IFNULL(s_bar_b,0)), 0) AS harvest,
            COALESCE(SUM(IFNULL(mah_tol,0)), 0) AS prod,
            COALESCE(SUM(IFNULL(mah_tolp,0)), 0) AS pred
         FROM `$table`
         WHERE " . implode(' AND ', $w) . "
         GROUP BY `$geoKey`, cod_mah, no_kesh";
    return dash_rows($dbh, $sql, $p);
}

function dash_agri_load_vege($dbh, $geoKey, $geoSql, $geoParams, $codes, $year, $water)
{
    if ($water === 'dim') {
        return array();
    }
    if (!$dbh || !dash_table_exists($dbh, 'Vege_prod')) {
        return array();
    }
    $vege = dash_agri_vege_codes();
    $use = $vege;
    if (is_array($codes)) {
        $use = array();
        foreach ($vege as $c) {
            if (in_array($c, $codes, true)) {
                $use[] = $c;
            }
        }
        if (!$use) {
            return array();
        }
    }
    $in = dash_agri_in('cod_mah', $use);
    $ys = (string) ((int) $year);
    $ys2 = dash_agri_z_sal($year);
    $sql = "SELECT `$geoKey` AS gid, cod_mah AS pid,
            COALESCE(SUM(IFNULL(zer_kesht,0)), 0) AS plant,
            COALESCE(SUM(IFNULL(s_bar,0)), 0) AS harvest,
            COALESCE(SUM(IFNULL(mah_tol,0)), 0) AS prod,
            COALESCE(SUM(IFNULL(mah_tolp,0)), 0) AS pred
         FROM Vege_prod
         WHERE $geoSql AND " . $in[0] . " AND (z_sal = ? OR z_sal = ?)
         GROUP BY `$geoKey`, cod_mah";
    $p = array_merge($geoParams, $in[1], array($ys, $ys2));
    return dash_rows($dbh, $sql, $p);
}

function dash_agri_load_plan($dbh, $abTable, $geoKey, $geoSql, $geoParams, $codes, $group_cod, $year)
{
    if (!$dbh || !dash_table_exists($dbh, $abTable)) {
        return array();
    }
    $z = dash_agri_z_sal($year);
    $w = array($geoSql, '(z_sal = ? OR z_sal = ?)');
    $p = array_merge($geoParams, array($z, (string) ((int) $year)));
    if (is_array($codes)) {
        $in = dash_agri_in('product_cod', $codes);
        $w[] = $in[0];
        $p = array_merge($p, $in[1]);
    } elseif ($group_cod !== '') {
        $w[] = 'group_cod = ?';
        $p[] = $group_cod;
    }
    $sql = "SELECT `$geoKey` AS gid, product_cod AS pid,
            COALESCE(SUM(IFNULL(s_abi,0)), 0) AS plan_abi,
            COALESCE(SUM(IFNULL(s_dem,0)), 0) AS plan_dim
         FROM `$abTable`
         WHERE " . implode(' AND ', $w) . "
         GROUP BY `$geoKey`, product_cod";
    return dash_rows($dbh, $sql, $p);
}

function dash_agri_assemble($catalog, $level, $group_cod, $product_cod, $water, $byGeo, $byProd, $labels, $missingProd, $missingPlan)
{
    $tot = dash_agri_empty_bucket();
    foreach ($byGeo as $gid => $b) {
        $byGeo[$gid] = dash_agri_round_bucket($b);
        dash_agri_add_bucket($tot, $byGeo[$gid]);
    }
    $tot = dash_agri_round_bucket($tot);

    $places = array();
    foreach ($labels as $gid => $meta) {
        $b = isset($byGeo[$gid]) ? $byGeo[$gid] : dash_agri_empty_bucket();
        $rz = dash_agri_realize($b['plant'], $b['plan']);
        $places[] = array_merge($meta, $b, array(
            'gid' => $gid,
            'name_key' => dash_norm_fa($meta['label']),
            'realize_pct' => $rz['pct'],
            'realize_status' => $rz['status']
        ));
    }

    $shareMode = 'group';
    if ($product_cod !== '') {
        $shareMode = 'water';
    } elseif ($group_cod !== '') {
        $shareMode = 'product';
    }
    $share = array();
    if ($shareMode === 'water') {
        $share = array(
            array('label' => 'آبی', 'plant' => $tot['plant_abi'], 'harvest' => $tot['harvest_abi'], 'pred' => 0),
            array('label' => 'دیم', 'plant' => $tot['plant_dim'], 'harvest' => $tot['harvest_dim'], 'pred' => 0)
        );
    } elseif ($shareMode === 'product') {
        foreach ($byProd as $pid => $b) {
            $b = dash_agri_round_bucket($b);
            $name = $pid;
            if (isset($catalog['map'][$pid])) {
                $name = $catalog['map'][$pid]['product_name'];
            }
            $share[] = array(
                'code' => $pid,
                'label' => $name,
                'plant' => $b['plant'],
                'harvest' => $b['harvest'],
                'pred' => $b['pred']
            );
        }
        usort($share, 'dash_agri_share_sort');
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
                $gacc[$gc] = array('code' => $gc, 'label' => $gn, 'plant' => 0, 'harvest' => 0, 'pred' => 0);
            }
            $gacc[$gc]['plant'] += $b['plant'];
            $gacc[$gc]['harvest'] += $b['harvest'];
            $gacc[$gc]['pred'] += $b['pred'];
        }
        foreach ($gacc as $k => $row) {
            $row['plant'] = round($row['plant'], 2);
            $row['harvest'] = round($row['harvest'], 2);
            $row['pred'] = round($row['pred'], 2);
            $share[] = $row;
        }
        usort($share, 'dash_agri_share_sort');
    }

    $rzTot = dash_agri_realize($tot['plant'], $tot['plan']);
    $yield = null;
    if ($product_cod !== '' && $tot['harvest'] > 0) {
        $yield = (int) round(($tot['prod'] / $tot['harvest']) * 1000);
    }
    $harvestPct = null;
    if ($tot['plant'] > 0) {
        $harvestPct = round(($tot['harvest'] / $tot['plant']) * 100, 1);
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
            'water' => $water
        ),
        'kpi' => array(
            'plant' => array(
                'total' => $tot['plant'],
                'abi' => $tot['plant_abi'],
                'dim' => $tot['plant_dim']
            ),
            'harvest' => array(
                'total' => $tot['harvest'],
                'abi' => $tot['harvest_abi'],
                'dim' => $tot['harvest_dim']
            ),
            'harvest_pct' => $harvestPct,
            'prod' => round($tot['prod'], 2),
            'pred' => round($tot['pred'], 2),
            'yield_kg_ha' => $yield,
            'plan' => array(
                'total' => $tot['plan'],
                'abi' => $tot['plan_abi'],
                'dim' => $tot['plan_dim']
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
        'missing_plan' => $missingPlan ? true : false
    );
}

function dash_agri_collect($dbh, $level, $id_ostan, $id_city, $id_mar, $year, $group_cod, $product_cod, $water)
{
    $catalog = dash_agri_catalog($dbh);
    $codes = dash_agri_filter_codes($catalog, $group_cod, $product_cod);
    $water = ($water === 'abi' || $water === 'dim') ? $water : 'all';
    $year = (int) $year;
    list($geoSql, $geoParams) = dash_geo_sql($id_ostan, $id_city, $id_mar, '', true);
    list($geoKey, $labels) = dash_agri_geo_meta($dbh, $level, $id_ostan, $id_city, $id_mar);

    $prodTable = dash_agri_prod_table($year);
    $agriRows = dash_agri_load_prod($dbh, $prodTable, $geoKey, $geoSql, $geoParams, $codes, $water);
    $vegeRows = dash_agri_load_vege($dbh, $geoKey, $geoSql, $geoParams, $codes, $year, $water);
    $abTable = dash_agri_ab_table($level);
    $planRows = dash_agri_load_plan($dbh, $abTable, $geoKey, $geoSql, $geoParams, $codes, $group_cod, $year);

    $byGeo = array();
    $byProd = array();
    foreach ($labels as $gid => $meta) {
        $byGeo[$gid] = dash_agri_empty_bucket();
    }

    foreach ($agriRows as $r) {
        $gid = trim((string) $r['gid']);
        $pid = trim((string) $r['pid']);
        $nk = trim((string) $r['nk']);
        $plant = (float) $r['plant'];
        $harvest = (float) $r['harvest'];
        $prod = (float) $r['prod'];
        $pred = (float) $r['pred'];
        if (!isset($byGeo[$gid])) {
            $byGeo[$gid] = dash_agri_empty_bucket();
        }
        if (!isset($byProd[$pid])) {
            $byProd[$pid] = dash_agri_empty_bucket();
        }
        $byGeo[$gid]['plant'] += $plant;
        $byGeo[$gid]['harvest'] += $harvest;
        $byGeo[$gid]['prod'] += $prod;
        $byGeo[$gid]['pred'] += $pred;
        $byProd[$pid]['plant'] += $plant;
        $byProd[$pid]['harvest'] += $harvest;
        $byProd[$pid]['prod'] += $prod;
        $byProd[$pid]['pred'] += $pred;
        if ($nk === '1') {
            $byGeo[$gid]['plant_abi'] += $plant;
            $byGeo[$gid]['harvest_abi'] += $harvest;
            $byProd[$pid]['plant_abi'] += $plant;
            $byProd[$pid]['harvest_abi'] += $harvest;
        } elseif ($nk === '2') {
            $byGeo[$gid]['plant_dim'] += $plant;
            $byGeo[$gid]['harvest_dim'] += $harvest;
            $byProd[$pid]['plant_dim'] += $plant;
            $byProd[$pid]['harvest_dim'] += $harvest;
        }
    }

    foreach ($vegeRows as $r) {
        $gid = trim((string) $r['gid']);
        $pid = trim((string) $r['pid']);
        $plant = (float) $r['plant'];
        $harvest = (float) $r['harvest'];
        $prod = (float) $r['prod'];
        $pred = (float) $r['pred'];
        if (!isset($byGeo[$gid])) {
            $byGeo[$gid] = dash_agri_empty_bucket();
        }
        if (!isset($byProd[$pid])) {
            $byProd[$pid] = dash_agri_empty_bucket();
        }
        $add = array(
            'plant' => $plant,
            'plant_abi' => $plant,
            'harvest' => $harvest,
            'harvest_abi' => $harvest,
            'prod' => $prod,
            'pred' => $pred
        );
        dash_agri_add_bucket($byGeo[$gid], $add);
        dash_agri_add_bucket($byProd[$pid], $add);
    }

    foreach ($planRows as $r) {
        $gid = trim((string) $r['gid']);
        $pid = trim((string) $r['pid']);
        $abi = (float) $r['plan_abi'];
        $dim = (float) $r['plan_dim'];
        if ($water === 'abi') {
            $dim = 0;
        } elseif ($water === 'dim') {
            $abi = 0;
        }
        if (!isset($byGeo[$gid])) {
            $byGeo[$gid] = dash_agri_empty_bucket();
        }
        if (!isset($byProd[$pid])) {
            $byProd[$pid] = dash_agri_empty_bucket();
        }
        $byGeo[$gid]['plan_abi'] += $abi;
        $byGeo[$gid]['plan_dim'] += $dim;
        $byGeo[$gid]['plan'] += $abi + $dim;
        $byProd[$pid]['plan_abi'] += $abi;
        $byProd[$pid]['plan_dim'] += $dim;
        $byProd[$pid]['plan'] += $abi + $dim;
    }

    return dash_agri_assemble(
        $catalog,
        $level,
        $group_cod,
        $product_cod,
        $water,
        $byGeo,
        $byProd,
        $labels,
        !dash_table_exists($dbh, $prodTable),
        !dash_table_exists($dbh, $abTable)
    );
}

function dash_agri_share_sort($a, $b)
{
    $av = isset($a['plant']) ? (float) $a['plant'] : 0;
    $bv = isset($b['plant']) ? (float) $b['plant'] : 0;
    if ($av === $bv) {
        return 0;
    }
    return ($av > $bv) ? -1 : 1;
}

function dash_agri_snap_tables()
{
    return array('dash_snap_agri_open', 'dash_snap_agri_locked');
}

function dash_agri_snap_table($yearOpen)
{
    return $yearOpen ? 'dash_snap_agri_open' : 'dash_snap_agri_locked';
}

function dash_agri_snap_ddl($table)
{
    if ($table !== 'dash_snap_agri_open' && $table !== 'dash_snap_agri_locked') {
        return '';
    }
    $uq = ($table === 'dash_snap_agri_locked') ? 'uq_dash_snap_agri_locked' : 'uq_dash_snap_agri_open';
    return "CREATE TABLE IF NOT EXISTS `$table` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `year_agri` varchar(4) NOT NULL,
      `level_code` enum('country','ostan') NOT NULL,
      `id_ostan` varchar(2) NOT NULL DEFAULT '',
      `product_cod` varchar(20) NOT NULL,
      `group_cod` varchar(20) NOT NULL DEFAULT '',
      `plant_abi` double NOT NULL DEFAULT '0',
      `plant_dim` double NOT NULL DEFAULT '0',
      `harvest_abi` double NOT NULL DEFAULT '0',
      `harvest_dim` double NOT NULL DEFAULT '0',
      `prod_abi` double NOT NULL DEFAULT '0',
      `prod_dim` double NOT NULL DEFAULT '0',
      `pred_abi` double NOT NULL DEFAULT '0',
      `pred_dim` double NOT NULL DEFAULT '0',
      `plan_abi` double NOT NULL DEFAULT '0',
      `plan_dim` double NOT NULL DEFAULT '0',
      `built_at` datetime NOT NULL,
      `build_ms` int(10) unsigned DEFAULT NULL,
      `source_ver` varchar(20) DEFAULT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `$uq` (`year_agri`,`level_code`,`id_ostan`,`product_cod`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci";
}

function dash_agri_snap_ensure($dbh)
{
    if (!$dbh) {
        return false;
    }
    foreach (dash_agri_snap_tables() as $name) {
        if (dash_table_exists($dbh, $name)) {
            continue;
        }
        $sql = dash_agri_snap_ddl($name);
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

function dash_agri_snap_empty_cell()
{
    return array(
        'group_cod' => '',
        'plant_abi' => 0,
        'plant_dim' => 0,
        'harvest_abi' => 0,
        'harvest_dim' => 0,
        'prod_abi' => 0,
        'prod_dim' => 0,
        'pred_abi' => 0,
        'pred_dim' => 0,
        'plan_abi' => 0,
        'plan_dim' => 0
    );
}

function dash_agri_snap_cell_nonzero($cell)
{
    foreach ($cell as $k => $v) {
        if ($k === 'group_cod') {
            continue;
        }
        if ((float) $v != 0) {
            return true;
        }
    }
    return false;
}

function dash_agri_snap_touch_cell(&$acc, $idOstan, $pid, $groupCod)
{
    $idOstan = trim((string) $idOstan);
    $pid = trim((string) $pid);
    if ($pid === '') {
        return null;
    }
    if (!isset($acc[$idOstan])) {
        $acc[$idOstan] = array();
    }
    if (!isset($acc[$idOstan][$pid])) {
        $acc[$idOstan][$pid] = dash_agri_snap_empty_cell();
    }
    if ($groupCod !== '' && $acc[$idOstan][$pid]['group_cod'] === '') {
        $acc[$idOstan][$pid]['group_cod'] = $groupCod;
    }
    return $pid;
}

function dash_agri_snap_upsert($dbh, $table, $row)
{
    if ($table !== 'dash_snap_agri_open' && $table !== 'dash_snap_agri_locked') {
        return false;
    }
    $sql = "INSERT INTO `$table` (
        year_agri, level_code, id_ostan, product_cod, group_cod,
        plant_abi, plant_dim, harvest_abi, harvest_dim,
        prod_abi, prod_dim, pred_abi, pred_dim,
        plan_abi, plan_dim, built_at, build_ms, source_ver
    ) VALUES (
        ?,?,?,?,?,
        ?,?,?,?,
        ?,?,?,?,
        ?,?,?,?,?
    ) ON DUPLICATE KEY UPDATE
        group_cod=VALUES(group_cod),
        plant_abi=VALUES(plant_abi), plant_dim=VALUES(plant_dim),
        harvest_abi=VALUES(harvest_abi), harvest_dim=VALUES(harvest_dim),
        prod_abi=VALUES(prod_abi), prod_dim=VALUES(prod_dim),
        pred_abi=VALUES(pred_abi), pred_dim=VALUES(pred_dim),
        plan_abi=VALUES(plan_abi), plan_dim=VALUES(plan_dim),
        built_at=VALUES(built_at), build_ms=VALUES(build_ms), source_ver=VALUES(source_ver)";
    try {
        $stmt = $dbh->prepare($sql);
        if (!$stmt) {
            return false;
        }
        return $stmt->execute(array(
            $row['year_agri'], $row['level_code'], $row['id_ostan'], $row['product_cod'], $row['group_cod'],
            $row['plant_abi'], $row['plant_dim'], $row['harvest_abi'], $row['harvest_dim'],
            $row['prod_abi'], $row['prod_dim'], $row['pred_abi'], $row['pred_dim'],
            $row['plan_abi'], $row['plan_dim'], $row['built_at'], $row['build_ms'], $row['source_ver']
        ));
    } catch (Exception $e) {
        $GLOBALS['dash_agri_snap_last_error'] = $e->getMessage();
        return false;
    }
}

function dash_agri_snap_pack_row($year, $level, $idOstan, $pid, $cell, $builtAt, $ms, $ver)
{
    return array(
        'year_agri' => (string) ((int) $year),
        'level_code' => $level,
        'id_ostan' => $idOstan,
        'product_cod' => $pid,
        'group_cod' => isset($cell['group_cod']) ? $cell['group_cod'] : '',
        'plant_abi' => round((float) $cell['plant_abi'], 4),
        'plant_dim' => round((float) $cell['plant_dim'], 4),
        'harvest_abi' => round((float) $cell['harvest_abi'], 4),
        'harvest_dim' => round((float) $cell['harvest_dim'], 4),
        'prod_abi' => round((float) $cell['prod_abi'], 4),
        'prod_dim' => round((float) $cell['prod_dim'], 4),
        'pred_abi' => round((float) $cell['pred_abi'], 4),
        'pred_dim' => round((float) $cell['pred_dim'], 4),
        'plan_abi' => round((float) $cell['plan_abi'], 4),
        'plan_dim' => round((float) $cell['plan_dim'], 4),
        'built_at' => $builtAt,
        'build_ms' => (int) $ms,
        'source_ver' => $ver
    );
}

function dash_agri_snap_build_year($dbh, $year, $ver, $table)
{
    $year = (string) ((int) $year);
    $result = array('year' => $year, 'rows' => 0, 'ostan' => 0, 'country' => 0, 'errors' => array(), 'table' => $table);
    if ($table !== 'dash_snap_agri_open' && $table !== 'dash_snap_agri_locked') {
        $result['errors'][] = 'bad agri snap table';
        return $result;
    }
    if (!dash_agri_snap_ensure($dbh)) {
        $result['errors'][] = 'cannot ensure agri snap tables';
        return $result;
    }

    $prodTable = dash_agri_prod_table($year);
    $catalog = dash_agri_catalog($dbh);
    $map = isset($catalog['map']) ? $catalog['map'] : array();
    $acc = array();
    $t0 = microtime(true);
    $builtAt = date('Y-m-d H:i:s');
    $ys = $year;
    $ys2 = dash_agri_z_sal($year);

    if (dash_table_exists($dbh, $prodTable)) {
        $agriRows = dash_rows(
            $dbh,
            "SELECT id_ostan AS gid, cod_mah AS pid, no_kesh AS nk,
                    COALESCE(SUM(IFNULL(zer_kesht_a,0) + IFNULL(zer_kesht_b,0)), 0) AS plant,
                    COALESCE(SUM(IFNULL(s_bar_a,0) + IFNULL(s_bar_b,0)), 0) AS harvest,
                    COALESCE(SUM(IFNULL(mah_tol,0)), 0) AS prod,
                    COALESCE(SUM(IFNULL(mah_tolp,0)), 0) AS pred
             FROM `$prodTable`
             GROUP BY id_ostan, cod_mah, no_kesh",
            array()
        );
        foreach ($agriRows as $r) {
            $gid = trim((string) $r['gid']);
            $pid = trim((string) $r['pid']);
            $gc = (isset($map[$pid]) && isset($map[$pid]['group_cod'])) ? $map[$pid]['group_cod'] : '';
            if (dash_agri_snap_touch_cell($acc, $gid, $pid, $gc) === null) {
                continue;
            }
            $nk = trim((string) $r['nk']);
            $side = ($nk === '2') ? 'dim' : 'abi';
            $acc[$gid][$pid]['plant_' . $side] += (float) $r['plant'];
            $acc[$gid][$pid]['harvest_' . $side] += (float) $r['harvest'];
            $acc[$gid][$pid]['prod_' . $side] += (float) $r['prod'];
            $acc[$gid][$pid]['pred_' . $side] += (float) $r['pred'];
        }
    } else {
        $result['errors'][] = 'missing table ' . $prodTable;
    }

    if (dash_table_exists($dbh, 'Vege_prod')) {
        $in = dash_agri_in('cod_mah', dash_agri_vege_codes());
        $vegeRows = dash_rows(
            $dbh,
            "SELECT id_ostan AS gid, cod_mah AS pid,
                    COALESCE(SUM(IFNULL(zer_kesht,0)), 0) AS plant,
                    COALESCE(SUM(IFNULL(s_bar,0)), 0) AS harvest,
                    COALESCE(SUM(IFNULL(mah_tol,0)), 0) AS prod,
                    COALESCE(SUM(IFNULL(mah_tolp,0)), 0) AS pred
             FROM Vege_prod
             WHERE " . $in[0] . " AND (z_sal = ? OR z_sal = ?)
             GROUP BY id_ostan, cod_mah",
            array_merge($in[1], array($ys, $ys2))
        );
        foreach ($vegeRows as $r) {
            $gid = trim((string) $r['gid']);
            $pid = trim((string) $r['pid']);
            $gc = (isset($map[$pid]) && isset($map[$pid]['group_cod'])) ? $map[$pid]['group_cod'] : '';
            if (dash_agri_snap_touch_cell($acc, $gid, $pid, $gc) === null) {
                continue;
            }
            $acc[$gid][$pid]['plant_abi'] += (float) $r['plant'];
            $acc[$gid][$pid]['harvest_abi'] += (float) $r['harvest'];
            $acc[$gid][$pid]['prod_abi'] += (float) $r['prod'];
            $acc[$gid][$pid]['pred_abi'] += (float) $r['pred'];
        }
    }

    if (dash_table_exists($dbh, 'Agri_ab_ostan')) {
        $planRows = dash_rows(
            $dbh,
            "SELECT id_ostan AS gid, product_cod AS pid,
                    COALESCE(SUM(IFNULL(s_abi,0)), 0) AS plan_abi,
                    COALESCE(SUM(IFNULL(s_dem,0)), 0) AS plan_dim
             FROM Agri_ab_ostan
             WHERE (z_sal = ? OR z_sal = ?)
             GROUP BY id_ostan, product_cod",
            array($ys2, $ys)
        );
        foreach ($planRows as $r) {
            $gid = trim((string) $r['gid']);
            $pid = trim((string) $r['pid']);
            $gc = (isset($map[$pid]) && isset($map[$pid]['group_cod'])) ? $map[$pid]['group_cod'] : '';
            if (dash_agri_snap_touch_cell($acc, $gid, $pid, $gc) === null) {
                continue;
            }
            $acc[$gid][$pid]['plan_abi'] += (float) $r['plan_abi'];
            $acc[$gid][$pid]['plan_dim'] += (float) $r['plan_dim'];
        }
    }

    $country = array();
    foreach ($acc as $gid => $prods) {
        foreach ($prods as $pid => $cell) {
            if (!isset($country[$pid])) {
                $country[$pid] = dash_agri_snap_empty_cell();
            }
            if ($cell['group_cod'] !== '' && $country[$pid]['group_cod'] === '') {
                $country[$pid]['group_cod'] = $cell['group_cod'];
            }
            foreach ($cell as $k => $v) {
                if ($k === 'group_cod') {
                    continue;
                }
                $country[$pid][$k] += (float) $v;
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
            if (!dash_agri_snap_cell_nonzero($cell)) {
                continue;
            }
            $row = dash_agri_snap_pack_row($year, 'ostan', $gid, $pid, $cell, $builtAt, $ms, $ver);
            if (dash_agri_snap_upsert($dbh, $table, $row)) {
                $result['rows']++;
                $result['ostan']++;
            } else {
                $err = isset($GLOBALS['dash_agri_snap_last_error']) ? $GLOBALS['dash_agri_snap_last_error'] : '';
                $result['errors'][] = 'upsert ostan ' . $gid . '/' . $pid . ($err !== '' ? (': ' . $err) : '');
                if (count($result['errors']) > 12) {
                    return $result;
                }
            }
        }
    }
    foreach ($country as $pid => $cell) {
        if (!dash_agri_snap_cell_nonzero($cell)) {
            continue;
        }
        $row = dash_agri_snap_pack_row($year, 'country', '', $pid, $cell, $builtAt, $ms, $ver);
        if (dash_agri_snap_upsert($dbh, $table, $row)) {
            $result['rows']++;
            $result['country']++;
        } else {
            $err = isset($GLOBALS['dash_agri_snap_last_error']) ? $GLOBALS['dash_agri_snap_last_error'] : '';
            $result['errors'][] = 'upsert country/' . $pid . ($err !== '' ? (': ' . $err) : '');
        }
    }

    return $result;
}

function dash_agri_snap_has($dbh, $table, $year)
{
    if ($table !== 'dash_snap_agri_open' && $table !== 'dash_snap_agri_locked') {
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

function dash_agri_snap_row_bucket($r, $water)
{
    $b = dash_agri_empty_bucket();
    $useAbi = ($water !== 'dim');
    $useDim = ($water !== 'abi');
    if ($useAbi) {
        $b['plant_abi'] = (float) $r['plant_abi'];
        $b['harvest_abi'] = (float) $r['harvest_abi'];
        $b['plan_abi'] = (float) $r['plan_abi'];
        $b['prod'] += (float) $r['prod_abi'];
        $b['pred'] += (float) $r['pred_abi'];
    }
    if ($useDim) {
        $b['plant_dim'] = (float) $r['plant_dim'];
        $b['harvest_dim'] = (float) $r['harvest_dim'];
        $b['plan_dim'] = (float) $r['plan_dim'];
        $b['prod'] += (float) $r['prod_dim'];
        $b['pred'] += (float) $r['pred_dim'];
    }
    $b['plant'] = $b['plant_abi'] + $b['plant_dim'];
    $b['harvest'] = $b['harvest_abi'] + $b['harvest_dim'];
    $b['plan'] = $b['plan_abi'] + $b['plan_dim'];
    return $b;
}

function dash_agri_collect_from_snap($dbh, $year, $group_cod, $product_cod, $water, $table)
{
    $catalog = dash_agri_catalog($dbh);
    $codes = dash_agri_filter_codes($catalog, $group_cod, $product_cod);
    $water = ($water === 'abi' || $water === 'dim') ? $water : 'all';
    $year = (int) $year;
    list($unusedGeoKey, $labels) = dash_agri_geo_meta($dbh, 'country', '', '', '');
    unset($unusedGeoKey);

    $rows = dash_rows(
        $dbh,
        "SELECT level_code, id_ostan, product_cod, group_cod,
                plant_abi, plant_dim, harvest_abi, harvest_dim,
                prod_abi, prod_dim, pred_abi, pred_dim,
                plan_abi, plan_dim, built_at
         FROM `$table`
         WHERE year_agri = ?",
        array((string) $year)
    );

    $byGeo = array();
    $byProdCountry = array();
    $byProdOstan = array();
    foreach ($labels as $gid => $meta) {
        $byGeo[$gid] = dash_agri_empty_bucket();
    }

    $builtAt = null;
    foreach ($rows as $r) {
        $pid = trim((string) $r['product_cod']);
        if ($pid === '') {
            continue;
        }
        if (is_array($codes) && !in_array($pid, $codes, true)) {
            continue;
        }
        if ($builtAt === null && !empty($r['built_at'])) {
            $builtAt = $r['built_at'];
        }
        $b = dash_agri_snap_row_bucket($r, $water);
        $level = $r['level_code'];
        if ($level === 'country') {
            if (!isset($byProdCountry[$pid])) {
                $byProdCountry[$pid] = dash_agri_empty_bucket();
            }
            dash_agri_add_bucket($byProdCountry[$pid], $b);
        } elseif ($level === 'ostan') {
            $gid = trim((string) $r['id_ostan']);
            if ($gid === '') {
                continue;
            }
            if (!isset($byGeo[$gid])) {
                $byGeo[$gid] = dash_agri_empty_bucket();
            }
            dash_agri_add_bucket($byGeo[$gid], $b);
            if (!isset($byProdOstan[$pid])) {
                $byProdOstan[$pid] = dash_agri_empty_bucket();
            }
            dash_agri_add_bucket($byProdOstan[$pid], $b);
        }
    }
    $byProd = $byProdCountry ? $byProdCountry : $byProdOstan;

    $out = dash_agri_assemble(
        $catalog,
        'country',
        $group_cod,
        $product_cod,
        $water,
        $byGeo,
        $byProd,
        $labels,
        false,
        false
    );
    $out['built_at'] = $builtAt;
    return $out;
}
