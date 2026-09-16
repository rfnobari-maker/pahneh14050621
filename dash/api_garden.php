<?php
header('Content-Type: application/json; charset=utf-8');
if (!defined('DASH_JSON')) {
    define('DASH_JSON', 1);
}
@set_time_limit(90);
require_once dirname(__FILE__) . '/auth.php';
require_once dirname(__FILE__) . '/lib.php';
require_once dirname(__FILE__) . '/lib_garden.php';

try {
    dash_require_post();
    $action = dash_req_trim('action', 'stats');
    $id_ostan = dash_req_trim('id_ostan');
    $id_city = dash_req_trim('id_city');
    $id_mar = dash_req_trim('id_mar');
    $year_in = (int) dash_req_trim('year', '0');
    $group_cod = dash_req_trim('group_cod');
    $product_cod = dash_req_trim('product_cod');
    $water = dash_garden_norm_water(dash_req('water', 'all'));
    $fruit = dash_garden_norm_fruit(dash_req('fruit', 'all'));
    $liveIn = dash_req_trim('live');
    $live = ($liveIn === '1' || $liveIn === 'true');

    $year = $year_in > 1300 ? $year_in : dash_agri_year($dbh);
    $force_ostan = dash_clamp_geo($id_ostan, $id_city, $id_mar);
    dash_filter_session_set(array(
        'year' => (string) $year,
        'id_ostan' => $id_ostan,
        'id_city' => $id_city,
        'id_mar' => $id_mar,
        'garden_group_cod' => $group_cod,
        'garden_product_cod' => $product_cod,
        'garden_water' => $water,
        'garden_fruit' => $fruit,
    ));
    $level = dash_geo_level($id_ostan, $id_city, $id_mar);
    $crumb = dash_geo_crumb($dbh, $id_ostan, $id_city, $id_mar, $force_ostan);

    $years = array();
    $yrows = dash_rows($dbh, 'SELECT sal FROM b_sal ORDER BY sal DESC', array());
    foreach ($yrows as $yr) {
        if (preg_match('/((?:13|14)\d{2})/', $yr['sal'], $m)) {
            $yi = (int) $m[1];
            if (!in_array($yi, $years, true)) {
                $years[] = $yi;
            }
        }
    }
    if (!$years) {
        $years = array($year);
    }

    if ($action === 'catalog') {
        $cat = dash_garden_catalog($dbh);
        dash_json_out(array(
            'ok' => true,
            'groups' => $cat['groups'],
            'products' => $cat['products']
        ));
        exit;
    }

    $yearOpen = dash_year_is_open($dbh, (string) $year, 'garden');
    $canSnap = ($level === 'country' || $level === 'ostan');
    $dataSource = 'live';
    $builtAt = null;
    $ag = null;
    list($snapTable, $snapHit) = dash_garden_snap_lookup($dbh, $year, $yearOpen);

    if ($canSnap && !$live && $snapHit) {
        $ag = dash_garden_collect_from_snap(
            $dbh,
            $year,
            $group_cod,
            $product_cod,
            $water,
            $fruit,
            $snapTable,
            $level,
            $id_ostan
        );
        if ($ag) {
            $dataSource = 'snap';
            $builtAt = isset($ag['built_at']) ? $ag['built_at'] : (isset($snapHit[0]['built_at']) ? $snapHit[0]['built_at'] : null);
        }
    }

    if ($ag === null) {
        $ag = dash_garden_collect(
            $dbh,
            $level,
            $id_ostan,
            $id_city,
            $id_mar,
            $year,
            $group_cod,
            $product_cod,
            $water,
            $fruit
        );
        if ($canSnap && !$live) {
            $dataSource = 'live_fallback';
        } elseif ($live) {
            $dataSource = 'live';
        }
    }

    $provinces = array();
    $cities = array();
    $centers = array();
    $catalogCodes = dash_garden_filter_codes($ag['catalog'], $group_cod, $product_cod);
    if ($level === 'country') {
        foreach ($ag['places'] as $p) {
            $provinces[] = array(
                'id_ostan' => $p['id_ostan'],
                'ostan' => $p['label'],
                'name_key' => $p['name_key'],
                'value' => $p['plant']
            );
        }
    } else {
        if ($level === 'ostan' || $level === 'city' || $level === 'mar') {
            $cities = dash_cities($dbh, $id_ostan, $year, false);
        }
        if ($level === 'city' || $level === 'mar') {
            $centers = dash_centers($dbh, $id_ostan, $id_city, $year);
        }
        if ($snapHit && !$live) {
            $provinces = dash_garden_snap_choropleth(
                $dbh,
                $snapTable,
                $year,
                $water,
                $fruit,
                $catalogCodes
            );
        }
        if (!$provinces) {
            $provinces = dash_garden_choropleth($dbh, $year);
        }
    }

    dash_json_out(array(
        'ok' => true,
        'level' => $level,
        'year' => $year,
        'years' => $years,
        'force_ostan' => $force_ostan,
        'id_ostan' => $id_ostan,
        'id_city' => $id_city,
        'id_mar' => $id_mar,
        'crumb' => $crumb,
        'catalog' => $ag['catalog'],
        'filter' => $ag['filter'],
        'kpi' => $ag['kpi'],
        'share_mode' => $ag['share_mode'],
        'share' => $ag['share'],
        'places' => $ag['places'],
        'rank_title' => $ag['rank_title'],
        'unit' => $ag['unit'],
        'provinces' => $provinces,
        'cities' => $cities,
        'centers' => $centers,
        'missing_prod' => $ag['missing_prod'],
        'missing_plan' => $ag['missing_plan'],
        'missing_cut' => !empty($ag['missing_cut']),
        'data_source' => $dataSource,
        'built_at' => $builtAt,
        'year_open' => $yearOpen,
        'can_live' => ($canSnap && $yearOpen)
    ));
} catch (Exception $e) {
    dash_json_out(array('ok' => false, 'error' => 'خطا در تهیه آمار باغبانی'));
}
