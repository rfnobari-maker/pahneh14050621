<?php
if (!isset($login_session)) {
    include('../lock_cp.php');
}
include('../login/config.php');

date_default_timezone_set('Asia/Tehran');
$v_date = date('Y-m-d', strtotime('-120 days'));
if (isset($date_pas) && $date_pas !== '' && strtotime($date_pas) < strtotime($v_date)) {
    header('Location: expaire_pass.php');
    exit;
}

$_cpis_province_cache = null;
$_cpis_update_per_cache = null;

function get_province_counts() {
    global $dbh, $_cpis_province_cache;

    if ($_cpis_province_cache !== null) {
        return $_cpis_province_cache['counts'];
    }

    $counts = array();
    $totals = array(
        'benef_count' => 0,
        'abadi_count' => 0,
        'shahr_count' => 0,
        'mor_count' => 0,
        'mar_count' => 0,
        'city_count' => 0
    );

    $queries = array(
        'benef_count' => "SELECT id_ostan, COUNT(*) AS cnt FROM bah WHERE ok = '1' GROUP BY id_ostan",
        'abadi_count' => "SELECT id_ostan, COUNT(*) AS cnt FROM list_abadi GROUP BY id_ostan",
        'shahr_count' => "SELECT id_ostan, COUNT(*) AS cnt FROM list_city GROUP BY id_ostan",
        'mor_count' => "SELECT id_ostan, COUNT(*) AS cnt FROM users WHERE S_access = '1' GROUP BY id_ostan",
        'mar_count' => "SELECT id_ostan, COUNT(*) AS cnt FROM mar GROUP BY id_ostan",
        'city_count' => "SELECT id_ostan, COUNT(*) AS cnt FROM cityname GROUP BY id_ostan"
    );

    foreach ($queries as $key => $sql) {
        $stmt = $dbh->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ostan_id = $row['id_ostan'];
            $n = (int) $row['cnt'];
            if (!isset($counts[$ostan_id])) {
                $counts[$ostan_id] = array();
            }
            $counts[$ostan_id][$key] = $n;
            $totals[$key] += $n;
        }
    }

    $_cpis_province_cache = array(
        'counts' => $counts,
        'totals' => $totals
    );

    return $counts;
}

function get_province_totals() {
    global $_cpis_province_cache;
    get_province_counts();
    return $_cpis_province_cache['totals'];
}

function province_count_row($id_ostan) {
    $all = get_province_counts();
    $empty = array(
        'benef_count' => 0,
        'abadi_count' => 0,
        'shahr_count' => 0,
        'mor_count' => 0,
        'mar_count' => 0,
        'city_count' => 0
    );
    if (!isset($all[$id_ostan])) {
        return $empty;
    }
    return array_merge($empty, $all[$id_ostan]);
}

function mor_count() {
    $t = get_province_totals();
    return $t['mor_count'];
}

function abadi_count() {
    $t = get_province_totals();
    return $t['abadi_count'];
}

function totl_shahr_count() {
    $t = get_province_totals();
    return $t['shahr_count'];
}

function totl_mar_count() {
    $t = get_province_totals();
    return $t['mar_count'];
}

function kol_city_count() {
    $t = get_province_totals();
    return $t['city_count'];
}

function kol_bah_count() {
    $t = get_province_totals();
    return $t['benef_count'];
}

function get_all_ostan_abadi_update_per() {
    global $dbh, $_cpis_update_per_cache;

    if ($_cpis_update_per_cache !== null) {
        return $_cpis_update_per_cache;
    }

    $_cpis_update_per_cache = array();
    $updated = array();
    $counts = get_province_counts();

    $stmt = $dbh->query("
        SELECT pa.id_ostan, COUNT(*) AS cnt
        FROM list_abadi la
        INNER JOIN public_abadi4 pa ON pa.add_abadi = la.add_abadi
        WHERE pa.up_date <> ''
        GROUP BY pa.id_ostan
    ");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $updated[$row['id_ostan']] = (int) $row['cnt'];
    }

    foreach ($counts as $id => $row) {
        $kol = isset($row['abadi_count']) ? (int) $row['abadi_count'] : 0;
        $up = isset($updated[$id]) ? $updated[$id] : 0;
        $_cpis_update_per_cache[$id] = $kol > 0 ? round(($up * 100) / $kol, 1) : 0;
    }

    return $_cpis_update_per_cache;
}

function ostan_abadi_update_per($id_ostan) {
    $all = get_all_ostan_abadi_update_per();
    return isset($all[$id_ostan]) ? $all[$id_ostan] : 0;
}
