<?php
header('Content-Type: application/json; charset=utf-8');
if (!defined('DASH_JSON')) {
    define('DASH_JSON', 1);
}
require_once dirname(__FILE__) . '/auth.php';
require_once dirname(__FILE__) . '/lib.php';

$dash_root = '../';

try {
    dash_require_post();
    $action = dash_req_trim('action', 'stats');
    $id_ostan = dash_req_trim('id_ostan');
    $id_city = dash_req_trim('id_city');
    $id_mar = dash_req_trim('id_mar');
    $year_in = (int) dash_req_trim('year', '0');
    $liveIn = dash_req_trim('live');
    $live = ($liveIn === '1' || $liveIn === 'true');

    $year = $year_in > 1300 ? $year_in : dash_agri_year($dbh);
    $force_ostan = dash_clamp_geo($id_ostan, $id_city, $id_mar);
    dash_filter_session_set(array(
        'year' => (string) $year,
        'id_ostan' => $id_ostan,
        'id_city' => $id_city,
        'id_mar' => $id_mar,
    ));
    $level = dash_geo_level($id_ostan, $id_city, $id_mar);
    $crumb = dash_geo_crumb($dbh, $id_ostan, $id_city, $id_mar, $force_ostan);

    if ($action === 'cities') {
        dash_json_out(array('ok' => true, 'cities' => dash_cities($dbh, $id_ostan, $year)));
        exit;
    }
    if ($action === 'centers') {
        dash_json_out(array('ok' => true, 'centers' => dash_centers($dbh, $id_ostan, $id_city, $year)));
        exit;
    }

    $years = array();
    $yrows = dash_rows($dbh, "SELECT sal FROM b_sal ORDER BY sal DESC", array());
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

    $yearOpen = dash_year_is_open($dbh, (string) $year, 'agri');
    $canSnap = ($level === 'country' || $level === 'ostan' || $level === 'city');
    $dataSource = 'live';
    $builtAt = null;
    $snapRow = null;

    if ($canSnap && !$live) {
        if ($level === 'city') {
            $idO = $id_ostan;
            $idC = $id_city;
        } else {
            $idO = $id_ostan;
            $idC = '';
        }
        if ($yearOpen) {
            $snapRow = dash_snap_get_open($dbh, $year, $level, $idO, $idC, '');
            if ($snapRow) {
                $dataSource = 'snap';
                $builtAt = $snapRow['built_at'];
            }
        } else {
            $snapRow = dash_snap_get_locked($dbh, $year, $level, $idO, $idC, '');
            if ($snapRow) {
                $dataSource = 'snap';
                $builtAt = $snapRow['built_at'];
            }
        }
    } elseif ($canSnap && $live) {
        $dataSource = 'live';
    }

    if ($dataSource === 'snap' && $snapRow) {
        $ag = dash_snap_stats_from_row($snapRow);
        $children = dash_snap_decode(isset($snapRow['children_text']) ? $snapRow['children_text'] : '');
        $visitsSnap = dash_snap_decode(isset($snapRow['visits_text']) ? $snapRow['visits_text'] : '');
        $provinces = ($level === 'country') ? $children : dash_choropleth($dbh, $year);
        $cities = array();
        $centers = array();
        if ($level === 'ostan') {
            $cities = $children;
        } elseif ($level === 'city') {
            if ($yearOpen) {
                $ostanSnap = dash_snap_get_open($dbh, $year, 'ostan', $id_ostan, '', '');
            } else {
                $ostanSnap = dash_snap_get_locked($dbh, $year, 'ostan', $id_ostan, '', '');
            }
            if ($ostanSnap) {
                $cities = dash_snap_decode(isset($ostanSnap['children_text']) ? $ostanSnap['children_text'] : '');
            } else {
                $cities = dash_cities($dbh, $id_ostan, $year);
            }
            $centers = $children;
        }
        $bahView = dash_bah_view(
            $dbh,
            $level,
            $id_ostan,
            $id_city,
            $id_mar,
            (!empty($ag['bah']) && is_array($ag['bah'])) ? $ag['bah'] : null
        );
        // rank: from snap when present (country/ostan). Avoid live country/ostan rank
        // (can exceed PHP timeout and break the whole dashboard JSON).
        if (!empty($ag['rank']) && is_array($ag['rank']) && !empty($ag['rank']['items'])) {
            $rank = $ag['rank'];
        } elseif ($level === 'city' || $level === 'mar') {
            $rank = dash_rank_board($dbh, $level, $id_ostan, $id_city, $year);
        } else {
            $rank = array(
                'scope' => $level,
                'unit' => 'هکتار',
                'items' => array(),
                'title' => ($level === 'ostan') ? 'رتبه‌بندی شهرستان‌ها' : 'رتبه‌بندی استان‌ها',
                'domains' => array(),
                'metric_label' => array()
            );
        }
        $gardenArea = $ag['garden_area'];
        if (!isset($gardenArea['baror_abi']) && !isset($gardenArea['baror_dim'])) {
            $gardenArea = dash_garden_area_stats($dbh, $id_ostan, $id_city, $id_mar, $year);
        }
        $payload = array(
            'ok' => true,
            'level' => $level,
            'year' => $year,
            'years' => $years,
            'force_ostan' => $force_ostan,
            'id_ostan' => $id_ostan,
            'id_city' => $id_city,
            'id_mar' => $id_mar,
            'crumb' => $crumb,
            'official' => dash_official($dbh, $level, $id_ostan, $id_city, $id_mar, $dash_root),
            'users' => dash_user_stats($dbh, $id_ostan, $id_city, $id_mar),
            'bah' => $bahView['bah'],
            'bah_source' => $bahView['bah_source'],
            'bah_built_at' => $bahView['bah_built_at'],
            'visits' => $visitsSnap ? $visitsSnap : dash_visits($dbh, $id_ostan, $id_city, $id_mar),
            'plots' => $ag['plots'],
            'agri_area' => $ag['agri_area'],
            'garden_area' => $gardenArea,
            'agri_prod' => $ag['agri_prod'],
            'garden_prod' => $ag['garden_prod'],
            'provinces' => $provinces,
            'cities' => $cities,
            'centers' => $centers,
            'rank' => $rank,
            'center_public' => null,
            'data_source' => 'snap',
            'built_at' => $builtAt,
            'year_open' => $yearOpen,
            'can_live' => ($canSnap && $yearOpen)
        );
        dash_json_out($payload);
        exit;
    }

    $ag = dash_collect_stats($dbh, $id_ostan, $id_city, $id_mar, $year);
    $bahView = dash_bah_view($dbh, $level, $id_ostan, $id_city, $id_mar, null);
    $payload = array(
        'ok' => true,
        'level' => $level,
        'year' => $year,
        'years' => $years,
        'force_ostan' => $force_ostan,
        'id_ostan' => $id_ostan,
        'id_city' => $id_city,
        'id_mar' => $id_mar,
        'crumb' => $crumb,
        'official' => dash_official($dbh, $level, $id_ostan, $id_city, $id_mar, $dash_root),
        'users' => dash_user_stats($dbh, $id_ostan, $id_city, $id_mar),
        'bah' => $bahView['bah'],
        'bah_source' => $bahView['bah_source'],
        'bah_built_at' => $bahView['bah_built_at'],
        'visits' => dash_visits($dbh, $id_ostan, $id_city, $id_mar),
        'plots' => $ag['plots'],
        'agri_area' => $ag['agri_area'],
        'garden_area' => $ag['garden_area'],
        'agri_prod' => $ag['agri_prod'],
        'garden_prod' => $ag['garden_prod'],
        'provinces' => dash_choropleth($dbh, $year),
        'cities' => ($level === 'ostan' || $level === 'city' || $level === 'mar') ? dash_cities($dbh, $id_ostan, $year) : array(),
        'centers' => ($level === 'city' || $level === 'mar') ? dash_centers($dbh, $id_ostan, $id_city, $year) : array(),
        'rank' => dash_rank_board($dbh, $level, $id_ostan, $id_city, $year),
        'center_public' => ($level === 'mar') ? dash_center_public($dbh, $id_ostan, $id_city, $id_mar) : null,
        'data_source' => $live ? 'live' : (($canSnap) ? 'live_fallback' : 'live'),
        'built_at' => null,
        'year_open' => $yearOpen,
        'can_live' => ($canSnap && $yearOpen)
    );
    dash_json_out($payload);
} catch (Exception $e) {
    dash_json_out(array('ok' => false, 'error' => 'خطا در تهیه آمار'));
}
