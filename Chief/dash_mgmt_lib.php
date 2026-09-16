<?php
/**
 * Helpers for the management map dashboard.
 */
if (!function_exists('dash_json_out')) {
    function dash_json_out($payload)
    {
        $flags = 0;
        if (defined('JSON_UNESCAPED_UNICODE')) {
            $flags = JSON_UNESCAPED_UNICODE;
        }
        $json = json_encode($payload, $flags);
        if ($json === false || $json === null) {
            echo '{"ok":false,"error":"json_encode_failed"}';
            return;
        }
        echo $json;
    }
}

if (!function_exists('dash_h')) {
    function dash_h($v)
    {
        if (!isset($v)) {
            return '';
        }
        return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
    }
}

function dash_norm_fa($s)
{
    $s = trim($s . '');
    $s = str_replace(array('استان ', 'ي', 'ك', '‌', 'ـ'), array('', 'ی', 'ک', '', ''), $s);
    $s = preg_replace('/\s+/u', '', $s);
    return $s;
}

function dash_agri_year($dbh)
{
    try {
        $stmt = $dbh->query("SELECT sal FROM b_sal ORDER BY sal DESC LIMIT 1");
        if ($stmt) {
            $sal = $stmt->fetchColumn();
            if ($sal && preg_match('/((?:13|14)\d{2})/', $sal, $m)) {
                return (int) $m[1];
            }
        }
    } catch (Exception $e) {
    }
    return 1404;
}

function dash_geo_sql($id_ostan, $id_city, $id_mar, $alias, $with_mar)
{
    $pre = $alias !== '' ? $alias . '.' : '';
    $w = array('1=1');
    $p = array();
    if ($id_ostan !== '') {
        $w[] = $pre . 'id_ostan = ?';
        $p[] = $id_ostan;
    }
    if ($id_city !== '') {
        $w[] = $pre . 'id_city = ?';
        $p[] = $id_city;
    }
    if ($with_mar && $id_mar !== '') {
        $w[] = $pre . 'id_mar = ?';
        $p[] = $id_mar;
    }
    return array(implode(' AND ', $w), $p);
}

function dash_scalar($dbh, $sql, $params)
{
    if (!$dbh) {
        return 0;
    }
    try {
        $stmt = $dbh->prepare($sql);
        if (!$stmt) {
            return 0;
        }
        $ok = $stmt->execute($params);
        if (!$ok) {
            return 0;
        }
        $v = $stmt->fetchColumn();
        if ($v === false || $v === null) {
            return 0;
        }
        return 0 + $v;
    } catch (Exception $e) {
        return 0;
    }
}

function dash_rows($dbh, $sql, $params)
{
    if (!$dbh) {
        return array();
    }
    try {
        $stmt = $dbh->prepare($sql);
        if (!$stmt) {
            return array();
        }
        $ok = $stmt->execute($params);
        if (!$ok) {
            return array();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows ? $rows : array();
    } catch (Exception $e) {
        return array();
    }
}

function dash_pic_url($pic, $root)
{
    $pic = trim($pic . '');
    if ($pic === '' || $pic === 'no_pic.png') {
        return '';
    }
    return $root . 'files/users/' . rawurlencode($pic);
}

function dash_official($dbh, $level, $id_ostan, $id_city, $id_mar, $root)
{
    $out = array(
        'ok' => false,
        'role' => '',
        'name' => '',
        'last_name' => '',
        'tel' => '',
        'pic' => ''
    );
    if ($level === 'country') {
        return $out;
    }
    try {
        if ($level === 'ostan') {
            $sql = "SELECT name, Last_name, tel_m, pic FROM users WHERE id_ostan = ? AND chief = '1' ORDER BY id ASC LIMIT 1";
            $params = array($id_ostan);
            $out['role'] = 'رئیس سازمان جهاد کشاورزی';
        } elseif ($level === 'city') {
            $sql = "SELECT name, Last_name, tel_m, pic FROM users WHERE id_ostan = ? AND id_city = ? AND S_access = '3' ORDER BY id ASC LIMIT 1";
            $params = array($id_ostan, $id_city);
            $out['role'] = 'مدیر جهاد کشاورزی شهرستان';
        } else {
            $sql = "SELECT name, Last_name, tel_m, pic FROM users WHERE id_ostan = ? AND id_city = ? AND id_mar = ? AND S_access = '2' ORDER BY id ASC LIMIT 1";
            $params = array($id_ostan, $id_city, $id_mar);
            $out['role'] = 'رئیس مرکز جهاد کشاورزی';
        }
        $stmt = $dbh->prepare($sql);
        if (!$stmt) {
            return $out;
        }
        $ok = $stmt->execute($params);
        if (!$ok) {
            return $out;
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $out['ok'] = true;
            $out['name'] = $row['name'];
            $out['last_name'] = $row['Last_name'];
            $out['tel'] = $row['tel_m'];
            $out['pic'] = dash_pic_url($row['pic'], $root);
        }
    } catch (Exception $e) {
    }
    return $out;
}

function dash_user_stats($dbh, $id_ostan, $id_city, $id_mar)
{
    list($where, $params) = dash_geo_sql($id_ostan, $id_city, $id_mar, '', true);
    $roles = array(
        'sys' => array('20', '4', '98', '99'),
        'moin' => array('5'),
        'city_mgr' => array('3'),
        'thematic' => array('6'),
        'center' => array('2'),
        'zone' => array('1')
    );
    $counts = array();
    foreach ($roles as $key => $codes) {
        $in = implode(',', array_fill(0, count($codes), '?'));
        $counts[$key] = (int) dash_scalar(
            $dbh,
            "SELECT COUNT(*) FROM users WHERE $where AND S_access IN ($in)",
            array_merge($params, $codes)
        );
    }
    $hq = (int) dash_scalar(
        $dbh,
        "SELECT COUNT(*) FROM users WHERE $where AND S_access IN ('20','21','22','23')",
        $params
    );
    $ostani = (int) dash_scalar(
        $dbh,
        "SELECT COUNT(*) FROM users WHERE $where AND S_access IN ('1','2','3','4','5','6','7','98','99')",
        $params
    );
    return array(
        'hq' => $hq,
        'provincial' => $ostani,
        'roles' => $counts
    );
}

/**
 * Live registered beneficiaries from bah (ok = '1').
 * no_bah: 1=حقیقی, 2=حقوقی | jens (حقیقی): 1=مرد, 2=زن
 */
function dash_bah_stats($dbh, $id_ostan, $id_city, $id_mar)
{
    $empty = array(
        'total' => 0,
        'natural' => 0,
        'legal' => 0,
        'male' => 0,
        'female' => 0
    );
    if (!$dbh) {
        return $empty;
    }
    list($where, $params) = dash_geo_sql($id_ostan, $id_city, $id_mar, '', true);
    $rows = dash_rows(
        $dbh,
        "SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN no_bah = '1' THEN 1 ELSE 0 END) AS natural_c,
            SUM(CASE WHEN no_bah = '2' THEN 1 ELSE 0 END) AS legal_c,
            SUM(CASE WHEN no_bah = '1' AND jens = '1' THEN 1 ELSE 0 END) AS male_c,
            SUM(CASE WHEN no_bah = '1' AND jens = '2' THEN 1 ELSE 0 END) AS female_c
         FROM bah
         WHERE ok = '1' AND $where",
        $params
    );
    if (!$rows) {
        return $empty;
    }
    $r = $rows[0];
    return array(
        'total' => (int) $r['total'],
        'natural' => (int) $r['natural_c'],
        'legal' => (int) $r['legal_c'],
        'male' => (int) $r['male_c'],
        'female' => (int) $r['female_c']
    );
}

function dash_visits($dbh, $id_ostan, $id_city, $id_mar)
{
    list($where, $params) = dash_geo_sql($id_ostan, $id_city, $id_mar, 'users', true);
    $rows = dash_rows(
        $dbh,
        "SELECT Last_user.date AS d, COUNT(*) AS c
         FROM Last_user
         INNER JOIN users ON users.username = Last_user.PersCode
         WHERE $where
         GROUP BY Last_user.date
         ORDER BY Last_user.date DESC
         LIMIT 14",
        $params
    );
    $rows = array_reverse($rows);
    $out = array();
    foreach ($rows as $r) {
        $out[] = array('date' => $r['d'], 'count' => (int) $r['c']);
    }
    return $out;
}

function dash_collect_stats($dbh, $id_ostan, $id_city, $id_mar, $year)
{
    list($w, $p) = dash_geo_sql($id_ostan, $id_city, $id_mar, '', true);
    $agri = 'Agri' . $year . '_' . ($year + 1);
    $agri_prod = 'Agri_prod' . $year . '_' . ($year + 1);
    $ys = (string) $year;
    $ys2 = $year . '-' . ($year + 1);

    $plots = array(
        'agri' => (int) dash_scalar($dbh, "SELECT COUNT(*) FROM `$agri` WHERE $w", $p),
        'garden' => (int) dash_scalar($dbh, "SELECT COUNT(*) FROM Garden WHERE $w AND (z_sal = ? OR z_sal = ?)", array_merge($p, array($ys, $ys2))),
        'greenhouse' => (int) dash_scalar($dbh, "SELECT COUNT(*) FROM Greenhous WHERE $w", $p),
        'mushroom' => (int) dash_scalar($dbh, "SELECT COUNT(*) FROM Mushroom WHERE $w", $p),
        'bee' => (int) dash_scalar($dbh, "SELECT COUNT(*) FROM bee WHERE $w AND (sal = ? OR sal = ?)", array_merge($p, array($ys, $ys2))),
        'animal' => dash_animal_unit_count($dbh, $id_ostan, $id_city, $id_mar)
    );

    $abi_area = dash_scalar($dbh, "SELECT COALESCE(SUM(zer_kesht_a),0) FROM `$agri_prod` WHERE $w AND no_kesh = '1'", $p);
    $dim_area = dash_scalar($dbh, "SELECT COALESCE(SUM(zer_kesht_a),0) FROM `$agri_prod` WHERE $w AND no_kesh = '2'", $p);
    if ($abi_area == 0 && $dim_area == 0) {
        $abi_area = dash_scalar($dbh, "SELECT COALESCE(SUM(m_zamin),0) FROM `$agri` WHERE $w AND no_kesh = '1'", $p);
        $dim_area = dash_scalar($dbh, "SELECT COALESCE(SUM(m_zamin),0) FROM `$agri` WHERE $w AND no_kesh = '2'", $p);
    }

    $gardenArea = dash_garden_area_stats($dbh, $id_ostan, $id_city, $id_mar, $year);
    $agri_prod_t = dash_scalar($dbh, "SELECT COALESCE(SUM(mah_tol),0) FROM `$agri_prod` WHERE $w", $p);
    $garden_prod_t = dash_scalar($dbh, "SELECT COALESCE(SUM(mah_tol),0) FROM Garden_prod WHERE $w AND (z_sal = ? OR z_sal = ?)", array_merge($p, array($ys, $ys2)));

    return array(
        'plots' => $plots,
        'agri_area' => array('abi' => round($abi_area, 2), 'dim' => round($dim_area, 2)),
        'garden_area' => $gardenArea,
        'agri_prod' => (int) round($agri_prod_t),
        'garden_prod' => (int) round($garden_prod_t)
    );
}

/**
 * Livestock units from animals_unit (geo filter; no year column on this table).
 */
function dash_animal_unit_count($dbh, $id_ostan, $id_city, $id_mar)
{
    list($w, $p) = dash_geo_sql($id_ostan, $id_city, $id_mar, '', true);
    return (int) dash_scalar($dbh, "SELECT COUNT(*) FROM animals_unit WHERE $w", $p);
}

/**
 * Garden area (ha): baror/nonbaror × abi/dim via Garden_prod.no_kesh (1=آبی, 2=دیم).
 */
function dash_garden_area_stats($dbh, $id_ostan, $id_city, $id_mar, $year)
{
    $empty = array(
        'baror' => 0,
        'nonbaror' => 0,
        'baror_abi' => 0,
        'nonbaror_abi' => 0,
        'baror_dim' => 0,
        'nonbaror_dim' => 0
    );
    if (!$dbh || !(int) $year) {
        return $empty;
    }
    list($w, $p) = dash_geo_sql($id_ostan, $id_city, $id_mar, '', true);
    $ys = (string) ((int) $year);
    $ys2 = $ys . '-' . ((int) $year + 1);
    $rows = dash_rows(
        $dbh,
        "SELECT
            COALESCE(SUM(s_kesht_b), 0) AS baror,
            COALESCE(SUM(s_kesht_gb), 0) AS nonbaror,
            COALESCE(SUM(CASE WHEN no_kesh = '1' THEN s_kesht_b ELSE 0 END), 0) AS baror_abi,
            COALESCE(SUM(CASE WHEN no_kesh = '1' THEN s_kesht_gb ELSE 0 END), 0) AS nonbaror_abi,
            COALESCE(SUM(CASE WHEN no_kesh = '2' THEN s_kesht_b ELSE 0 END), 0) AS baror_dim,
            COALESCE(SUM(CASE WHEN no_kesh = '2' THEN s_kesht_gb ELSE 0 END), 0) AS nonbaror_dim
         FROM Garden_prod
         WHERE $w AND (z_sal = ? OR z_sal = ?)",
        array_merge($p, array($ys, $ys2))
    );
    if (!$rows) {
        return $empty;
    }
    $r = $rows[0];
    return array(
        'baror' => round((float) $r['baror'], 2),
        'nonbaror' => round((float) $r['nonbaror'], 2),
        'baror_abi' => round((float) $r['baror_abi'], 2),
        'nonbaror_abi' => round((float) $r['nonbaror_abi'], 2),
        'baror_dim' => round((float) $r['baror_dim'], 2),
        'nonbaror_dim' => round((float) $r['nonbaror_dim'], 2)
    );
}

function dash_choropleth($dbh, $year)
{
    $agri = 'Agri' . $year . '_' . ($year + 1);
    $rows = dash_rows($dbh, "SELECT id_ostan, COUNT(*) AS c FROM `$agri` GROUP BY id_ostan", array());
    $map = array();
    foreach ($rows as $r) {
        $map[$r['id_ostan']] = (int) $r['c'];
    }
    $ostan = dash_rows($dbh, "SELECT id_ostan, ostan FROM ostanname", array());
    $out = array();
    foreach ($ostan as $o) {
        $id = $o['id_ostan'];
        $out[] = array(
            'id_ostan' => $id,
            'ostan' => $o['ostan'],
            'name_key' => dash_norm_fa($o['ostan']),
            'value' => isset($map[$id]) ? $map[$id] : 0
        );
    }
    return $out;
}

function dash_cities($dbh, $id_ostan, $year = 0)
{
    if (!$year) {
        $year = dash_agri_year($dbh);
    }
    $rows = dash_rows(
        $dbh,
        "SELECT id_city, city FROM cityname WHERE id_ostan = ? ORDER BY BINARY city ASC",
        array($id_ostan)
    );
    $gmap = array();
    $tables = array('Agri' . $year . '_' . ($year + 1), 'Garden', 'Greenhous');
    foreach ($tables as $t) {
        $geo = dash_rows(
            $dbh,
            "SELECT id_city, AVG(lat) AS lat, AVG(lng) AS lng
             FROM `$t`
             WHERE id_ostan = ? AND lat BETWEEN 20 AND 45 AND lng BETWEEN 40 AND 70
             GROUP BY id_city",
            array($id_ostan)
        );
        foreach ($geo as $g) {
            if (!isset($gmap[$g['id_city']])) {
                $gmap[$g['id_city']] = $g;
            }
        }
    }
    foreach ($rows as &$r) {
        $id = $r['id_city'];
        if (isset($gmap[$id])) {
            $r['lat'] = round((float) $gmap[$id]['lat'], 5);
            $r['lng'] = round((float) $gmap[$id]['lng'], 5);
        } else {
            $r['lat'] = null;
            $r['lng'] = null;
        }
    }
    unset($r);
    return $rows;
}

/**
 * Ranking board by cultivated area (ha).
 * Agri domain = Agri_prod + Vege_prod (صیفی added to agri; vege counted in آبی).
 * Garden domain = Garden_prod with آبی/دیم and بارور/غیر بارور.
 */
function dash_rank_board($dbh, $level, $id_ostan, $id_city, $year)
{
    $year = (int) $year;
    $ys = (string) $year;
    $ys2 = $year . '-' . ($year + 1);
    $agriProd = 'Agri_prod' . $year . '_' . ($year + 1);
    $out = array(
        'scope' => $level,
        'unit' => 'هکتار',
        'domains' => array(
            'agri' => array(
                'label' => 'زراعی',
                'metrics' => array(
                    'total' => 'کل',
                    'abi' => 'آبی',
                    'dim' => 'دیم'
                )
            ),
            'garden' => array(
                'label' => 'باغی',
                'axes' => array(
                    'water' => array(
                        'total' => 'کل',
                        'abi' => 'آبی',
                        'dim' => 'دیم'
                    ),
                    'fruit' => array(
                        'total' => 'کل',
                        'baror' => 'بارور',
                        'nonbaror' => 'غیر بارور'
                    )
                ),
                'metrics' => array(
                    'total' => 'کل'
                )
            )
        ),
        'metric_label' => array(
            'agri' => 'سطح زراعی+صیفی',
            'garden' => 'سطح باغی'
        ),
        'items' => array(),
        'title' => 'رتبه‌بندی'
    );
    if (!$dbh || $year < 1300) {
        return $out;
    }

    $geoKey = 'id_ostan';
    $extraWhere = '1=1';
    $extraParams = array();
    $labels = array();

    if ($level === 'country') {
        $geoKey = 'id_ostan';
        $rows = dash_rows($dbh, 'SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC', array());
        foreach ($rows as $r) {
            $id = trim($r['id_ostan'] . '');
            $labels[$id] = array(
                'label' => $r['ostan'],
                'id_ostan' => $id,
                'id_city' => '',
                'id_mar' => ''
            );
        }
        $out['title'] = 'رتبه‌بندی استان‌ها';
        $out['scope'] = 'country';
    } elseif ($level === 'ostan' && $id_ostan !== '') {
        $geoKey = 'id_city';
        $extraWhere = 'id_ostan = ?';
        $extraParams = array($id_ostan);
        $rows = dash_rows(
            $dbh,
            'SELECT id_city, city FROM cityname WHERE id_ostan = ? ORDER BY BINARY city ASC',
            array($id_ostan)
        );
        foreach ($rows as $r) {
            $id = trim($r['id_city'] . '');
            $labels[$id] = array(
                'label' => $r['city'],
                'id_ostan' => $id_ostan,
                'id_city' => $id,
                'id_mar' => ''
            );
        }
        $out['title'] = 'رتبه‌بندی شهرستان‌ها';
        $out['scope'] = 'ostan';
    } elseif (($level === 'city' || $level === 'mar') && $id_ostan !== '' && $id_city !== '') {
        $geoKey = 'id_mar';
        $extraWhere = 'id_ostan = ? AND id_city = ?';
        $extraParams = array($id_ostan, $id_city);
        $mars = dash_rows(
            $dbh,
            'SELECT id_mar, mar FROM mar WHERE id_ostan = ? AND id_city = ? ORDER BY BINARY mar ASC',
            array($id_ostan, $id_city)
        );
        $promo = dash_rows(
            $dbh,
            'SELECT id_mar, m_name FROM promo_cent_public WHERE id_ostan = ? AND id_city = ?',
            array($id_ostan, $id_city)
        );
        $pname = array();
        foreach ($promo as $p) {
            $pname[trim($p['id_mar'] . '')] = $p['m_name'];
        }
        foreach ($mars as $m) {
            $id = trim($m['id_mar'] . '');
            $label = (isset($pname[$id]) && trim($pname[$id] . '') !== '') ? $pname[$id] : $m['mar'];
            $labels[$id] = array(
                'label' => $label,
                'id_ostan' => $id_ostan,
                'id_city' => $id_city,
                'id_mar' => $id
            );
        }
        $out['title'] = 'رتبه‌بندی مراکز';
        $out['scope'] = 'city';
    } else {
        return $out;
    }

    $agriTotal = array();
    $agriAbi = array();
    $agriDim = array();
    $gardenTotal = array();
    $gardenAbi = array();
    $gardenDim = array();
    $gardenBaror = array();
    $gardenNon = array();
    $gardenBarorAbi = array();
    $gardenNonAbi = array();
    $gardenBarorDim = array();
    $gardenNonDim = array();

    $ap = array_merge($extraParams, array());
    $rows = dash_rows(
        $dbh,
        "SELECT `$geoKey` AS gid,
            COALESCE(SUM(zer_kesht_a), 0) AS total_a,
            COALESCE(SUM(CASE WHEN no_kesh = '1' THEN zer_kesht_a ELSE 0 END), 0) AS abi_a,
            COALESCE(SUM(CASE WHEN no_kesh = '2' THEN zer_kesht_a ELSE 0 END), 0) AS dim_a
         FROM `$agriProd`
         WHERE $extraWhere
         GROUP BY `$geoKey`",
        $ap
    );
    foreach ($rows as $r) {
        $id = trim($r['gid'] . '');
        $agriTotal[$id] = (float) $r['total_a'];
        $agriAbi[$id] = (float) $r['abi_a'];
        $agriDim[$id] = (float) $r['dim_a'];
    }

    // صیفی روی زراعی جمع می‌شود؛ چون آبی/دیم جدا ندارد، به کل و آبی افزوده می‌شود
    $vp = array_merge($extraParams, array($ys, $ys2));
    $rows = dash_rows(
        $dbh,
        "SELECT `$geoKey` AS gid, COALESCE(SUM(zer_kesht), 0) AS vege_a
         FROM Vege_prod
         WHERE $extraWhere AND (z_sal = ? OR z_sal = ?)
         GROUP BY `$geoKey`",
        $vp
    );
    foreach ($rows as $r) {
        $id = trim($r['gid'] . '');
        $v = (float) $r['vege_a'];
        if (!isset($agriTotal[$id])) {
            $agriTotal[$id] = 0;
        }
        if (!isset($agriAbi[$id])) {
            $agriAbi[$id] = 0;
        }
        $agriTotal[$id] += $v;
        $agriAbi[$id] += $v;
    }

    $gp = array_merge($extraParams, array($ys, $ys2));
    $rows = dash_rows(
        $dbh,
        "SELECT `$geoKey` AS gid,
            COALESCE(SUM(s_kesht_b + s_kesht_gb), 0) AS total_g,
            COALESCE(SUM(CASE WHEN no_kesh = '1' THEN s_kesht_b + s_kesht_gb ELSE 0 END), 0) AS abi_g,
            COALESCE(SUM(CASE WHEN no_kesh = '2' THEN s_kesht_b + s_kesht_gb ELSE 0 END), 0) AS dim_g,
            COALESCE(SUM(s_kesht_b), 0) AS baror_g,
            COALESCE(SUM(s_kesht_gb), 0) AS nonbaror_g,
            COALESCE(SUM(CASE WHEN no_kesh = '1' THEN s_kesht_b ELSE 0 END), 0) AS baror_abi_g,
            COALESCE(SUM(CASE WHEN no_kesh = '1' THEN s_kesht_gb ELSE 0 END), 0) AS nonbaror_abi_g,
            COALESCE(SUM(CASE WHEN no_kesh = '2' THEN s_kesht_b ELSE 0 END), 0) AS baror_dim_g,
            COALESCE(SUM(CASE WHEN no_kesh = '2' THEN s_kesht_gb ELSE 0 END), 0) AS nonbaror_dim_g
         FROM Garden_prod
         WHERE $extraWhere AND (z_sal = ? OR z_sal = ?)
         GROUP BY `$geoKey`",
        $gp
    );
    foreach ($rows as $r) {
        $id = trim($r['gid'] . '');
        $gardenTotal[$id] = (float) $r['total_g'];
        $gardenAbi[$id] = (float) $r['abi_g'];
        $gardenDim[$id] = (float) $r['dim_g'];
        $gardenBaror[$id] = (float) $r['baror_g'];
        $gardenNon[$id] = (float) $r['nonbaror_g'];
        $gardenBarorAbi[$id] = (float) $r['baror_abi_g'];
        $gardenNonAbi[$id] = (float) $r['nonbaror_abi_g'];
        $gardenBarorDim[$id] = (float) $r['baror_dim_g'];
        $gardenNonDim[$id] = (float) $r['nonbaror_dim_g'];
    }

    foreach ($labels as $id => $meta) {
        $out['items'][] = array(
            'label' => $meta['label'],
            'id_ostan' => $meta['id_ostan'],
            'id_city' => $meta['id_city'],
            'id_mar' => $meta['id_mar'],
            'agri_total' => round(isset($agriTotal[$id]) ? $agriTotal[$id] : 0, 1),
            'agri_abi' => round(isset($agriAbi[$id]) ? $agriAbi[$id] : 0, 1),
            'agri_dim' => round(isset($agriDim[$id]) ? $agriDim[$id] : 0, 1),
            'garden_total' => round(isset($gardenTotal[$id]) ? $gardenTotal[$id] : 0, 1),
            'garden_abi' => round(isset($gardenAbi[$id]) ? $gardenAbi[$id] : 0, 1),
            'garden_dim' => round(isset($gardenDim[$id]) ? $gardenDim[$id] : 0, 1),
            'garden_baror' => round(isset($gardenBaror[$id]) ? $gardenBaror[$id] : 0, 1),
            'garden_nonbaror' => round(isset($gardenNon[$id]) ? $gardenNon[$id] : 0, 1),
            'garden_baror_abi' => round(isset($gardenBarorAbi[$id]) ? $gardenBarorAbi[$id] : 0, 1),
            'garden_nonbaror_abi' => round(isset($gardenNonAbi[$id]) ? $gardenNonAbi[$id] : 0, 1),
            'garden_baror_dim' => round(isset($gardenBarorDim[$id]) ? $gardenBarorDim[$id] : 0, 1),
            'garden_nonbaror_dim' => round(isset($gardenNonDim[$id]) ? $gardenNonDim[$id] : 0, 1)
        );
    }

    return $out;
}

function dash_centers($dbh, $id_ostan, $id_city, $year)
{
    $rows = dash_rows(
        $dbh,
        "SELECT id_mar, mar FROM mar WHERE id_ostan = ? AND id_city = ? ORDER BY BINARY mar ASC",
        array($id_ostan, $id_city)
    );
    $promo = dash_rows(
        $dbh,
        "SELECT id_mar, m_name, lat, lng
         FROM promo_cent_public
         WHERE id_ostan = ? AND id_city = ?",
        array($id_ostan, $id_city)
    );
    $pmap = array();
    foreach ($promo as $g) {
        $pmap[$g['id_mar']] = $g;
    }
    $agri = 'Agri' . $year . '_' . ($year + 1);
    $geo = dash_rows(
        $dbh,
        "SELECT id_mar, AVG(lat) AS lat, AVG(lng) AS lng
         FROM `$agri`
         WHERE id_ostan = ? AND id_city = ? AND lat BETWEEN 20 AND 45 AND lng BETWEEN 40 AND 70
         GROUP BY id_mar",
        array($id_ostan, $id_city)
    );
    $gmap = array();
    foreach ($geo as $g) {
        $gmap[$g['id_mar']] = $g;
    }
    foreach ($rows as &$r) {
        $id = $r['id_mar'];
        $lat = null;
        $lng = null;
        $label = $r['mar'];
        if (isset($pmap[$id])) {
            $pl = (float) $pmap[$id]['lat'];
            $pn = (float) $pmap[$id]['lng'];
            if (dash_coord_ok($pl, $pn)) {
                $lat = round($pl, 6);
                $lng = round($pn, 6);
            } elseif (dash_coord_ok($pn, $pl)) {
                // برخی رکوردها lat/lng جابه‌جا ثبت شده‌اند
                $lat = round($pn, 6);
                $lng = round($pl, 6);
            }
            if (trim($pmap[$id]['m_name'] . '') !== '') {
                $label = $pmap[$id]['m_name'];
            }
        }
        if ($lat === null && isset($gmap[$id])) {
            $lat = round((float) $gmap[$id]['lat'], 5);
            $lng = round((float) $gmap[$id]['lng'], 5);
        }
        $r['m_name'] = $label;
        $r['lat'] = $lat;
        $r['lng'] = $lng;
    }
    unset($r);
    return $rows;
}

function dash_coord_ok($lat, $lng)
{
    return ($lat >= 25 && $lat <= 40 && $lng >= 44 && $lng <= 63);
}

function dash_center_public($dbh, $id_ostan, $id_city, $id_mar)
{
    $out = array(
        'ok' => false,
        'id_mar' => $id_mar,
        'm_name' => '',
        'rating' => '',
        'rating_label' => '',
        'y_tas' => '',
        'address' => '',
        'cod_pos' => '',
        'tel' => '',
        'fax' => '',
        'f_naz_ab' => '',
        'f_dor_ab' => '',
        'zf_g' => '',
        'lat' => null,
        'lng' => null
    );
    if ($id_ostan === '' || $id_mar === '') {
        return $out;
    }
    $rows = dash_rows(
        $dbh,
        "SELECT id_mar, m_name, rating, y_tas, address, cod_pos, tel, fax,
                f_naz_ab, f_dor_ab, zf_g, lat, lng
         FROM promo_cent_public
         WHERE id_ostan = ? AND id_mar = ?
         LIMIT 1",
        array($id_ostan, $id_mar)
    );
    if (!$rows) {
        return $out;
    }
    $row = $rows[0];
    $rating = trim($row['rating'] . '');
    $labels = array('1' => 'یک', '2' => 'دو', '3' => 'سه');
    $lat = (float) $row['lat'];
    $lng = (float) $row['lng'];
    if (!dash_coord_ok($lat, $lng) && dash_coord_ok($lng, $lat)) {
        $tmp = $lat;
        $lat = $lng;
        $lng = $tmp;
    }
    $out['ok'] = true;
    $out['id_mar'] = $row['id_mar'];
    $out['m_name'] = $row['m_name'];
    $out['rating'] = $rating;
    $out['rating_label'] = isset($labels[$rating]) ? $labels[$rating] : $rating;
    $out['y_tas'] = $row['y_tas'];
    $out['address'] = $row['address'];
    $out['cod_pos'] = $row['cod_pos'];
    $out['tel'] = $row['tel'];
    $out['fax'] = $row['fax'] . '';
    $out['f_naz_ab'] = $row['f_naz_ab'] . '';
    $out['f_dor_ab'] = $row['f_dor_ab'] . '';
    $out['zf_g'] = $row['zf_g'];
    if (dash_coord_ok($lat, $lng)) {
        $out['lat'] = round($lat, 6);
        $out['lng'] = round($lng, 6);
    }
    return $out;
}

/** Snapshot helpers (phase 2a: country + ostan, open years) */

function dash_table_exists($dbh, $name)
{
    if (!$dbh || $name === '') {
        return false;
    }
    try {
        $stmt = $dbh->prepare('SHOW TABLES LIKE ?');
        if (!$stmt) {
            return false;
        }
        $stmt->execute(array($name));
        return (bool) $stmt->fetchColumn();
    } catch (Exception $e) {
        return false;
    }
}

function dash_json_encode($payload)
{
    $flags = 0;
    if (defined('JSON_UNESCAPED_UNICODE')) {
        $flags = JSON_UNESCAPED_UNICODE;
    }
    return json_encode($payload, $flags);
}

function dash_open_years($dbh, $domains)
{
    if (!is_array($domains) || !$domains) {
        $domains = array('agri');
    }
    $in = implode(',', array_fill(0, count($domains), '?'));
    $params = $domains;
    $rows = dash_rows(
        $dbh,
        "SELECT DISTINCT year_agri FROM dash_year_status
         WHERE status = 'open' AND domain IN ($in)
         ORDER BY year_agri ASC",
        $params
    );
    $out = array();
    foreach ($rows as $r) {
        $y = trim($r['year_agri'] . '');
        if ($y !== '' && !in_array($y, $out, true)) {
            $out[] = $y;
        }
    }
    return $out;
}

function dash_locked_years($dbh, $domains)
{
    if (!is_array($domains) || !$domains) {
        $domains = array('agri');
    }
    $in = implode(',', array_fill(0, count($domains), '?'));
    $params = $domains;
    $rows = dash_rows(
        $dbh,
        "SELECT DISTINCT year_agri FROM dash_year_status
         WHERE status = 'locked' AND domain IN ($in)
         ORDER BY year_agri ASC",
        $params
    );
    $out = array();
    foreach ($rows as $r) {
        $y = trim($r['year_agri'] . '');
        if ($y !== '' && !in_array($y, $out, true)) {
            $out[] = $y;
        }
    }
    return $out;
}

function dash_snap_upsert_open($dbh, $row)
{
    return dash_snap_upsert_table($dbh, 'dash_snap_open', $row);
}

function dash_snap_upsert_locked($dbh, $row)
{
    return dash_snap_upsert_table($dbh, 'dash_snap_locked', $row);
}

function dash_snap_upsert_table($dbh, $table, $row)
{
    if ($table !== 'dash_snap_open' && $table !== 'dash_snap_locked') {
        return false;
    }
    dash_snap_ensure_extra_column($dbh, $table);
    $sql = "INSERT INTO `$table` (
        year_agri, level_code, id_ostan, id_city, id_mar, name_label,
        cnt_agri, cnt_garden, cnt_greenhouse, cnt_mushroom, cnt_bee, cnt_animal,
        area_abi, area_dim, area_garden_b, area_garden_gb, prod_agri, prod_garden,
        users_zone, users_staff, users_admin,
        children_text, visits_text, extra_text, built_at, build_ms, source_ver
    ) VALUES (
        ?,?,?,?,?,?,
        ?,?,?,?,?,?,
        ?,?,?,?,?,?,
        ?,?,?,
        ?,?,?,?,?,?
    ) ON DUPLICATE KEY UPDATE
        name_label=VALUES(name_label),
        cnt_agri=VALUES(cnt_agri), cnt_garden=VALUES(cnt_garden),
        cnt_greenhouse=VALUES(cnt_greenhouse), cnt_mushroom=VALUES(cnt_mushroom),
        cnt_bee=VALUES(cnt_bee), cnt_animal=VALUES(cnt_animal),
        area_abi=VALUES(area_abi), area_dim=VALUES(area_dim),
        area_garden_b=VALUES(area_garden_b), area_garden_gb=VALUES(area_garden_gb),
        prod_agri=VALUES(prod_agri), prod_garden=VALUES(prod_garden),
        users_zone=VALUES(users_zone), users_staff=VALUES(users_staff),
        users_admin=VALUES(users_admin),
        children_text=VALUES(children_text), visits_text=VALUES(visits_text),
        extra_text=VALUES(extra_text),
        built_at=VALUES(built_at), build_ms=VALUES(build_ms), source_ver=VALUES(source_ver)";
    try {
        $stmt = $dbh->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $ok = $stmt->execute(array(
            $row['year_agri'], $row['level_code'], $row['id_ostan'], $row['id_city'], $row['id_mar'], $row['name_label'],
            $row['cnt_agri'], $row['cnt_garden'], $row['cnt_greenhouse'], $row['cnt_mushroom'], $row['cnt_bee'], $row['cnt_animal'],
            $row['area_abi'], $row['area_dim'], $row['area_garden_b'], $row['area_garden_gb'], $row['prod_agri'], $row['prod_garden'],
            $row['users_zone'], $row['users_staff'], $row['users_admin'],
            $row['children_text'], $row['visits_text'],
            isset($row['extra_text']) ? $row['extra_text'] : null,
            $row['built_at'], $row['build_ms'], $row['source_ver']
        ));
        if (!$ok) {
            $info = $stmt->errorInfo();
            if (is_array($info) && isset($info[2]) && $info[2] !== '') {
                $GLOBALS['dash_snap_last_error'] = $info[2];
            }
        }
        return $ok;
    } catch (Exception $e) {
        $GLOBALS['dash_snap_last_error'] = $e->getMessage();
        return false;
    }
}

/** Add extra_text column for extended snap payload (MySQL 5.1). */
function dash_snap_ensure_extra_column($dbh, $table)
{
    static $done = array();
    if ($table !== 'dash_snap_open' && $table !== 'dash_snap_locked') {
        return false;
    }
    if (!empty($done[$table])) {
        return true;
    }
    if (!$dbh || !dash_table_exists($dbh, $table)) {
        return false;
    }
    try {
        $cols = dash_rows($dbh, "SHOW COLUMNS FROM `$table` LIKE 'extra_text'", array());
        if (!$cols) {
            $dbh->exec(
                "ALTER TABLE `$table`
                 ADD COLUMN `extra_text` mediumtext COLLATE utf8_persian_ci
                 COMMENT 'JSON: garden_area detail, bah, rank'
                 AFTER `visits_text`"
            );
        }
        $done[$table] = true;
        return true;
    } catch (Exception $e) {
        return false;
    }
}

/** Ensure snapshot tables exist (MySQL 5.1). */
function dash_snap_ensure_tables($dbh)
{
    if (!$dbh) {
        return false;
    }
    $ddl = array();
    $ddl['dash_snap_locked'] = "CREATE TABLE IF NOT EXISTS `dash_snap_locked` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `year_agri` varchar(4) NOT NULL,
      `level_code` enum('country','ostan','city','mar') NOT NULL,
      `id_ostan` varchar(2) NOT NULL DEFAULT '',
      `id_city` varchar(2) NOT NULL DEFAULT '',
      `id_mar` varchar(5) NOT NULL DEFAULT '',
      `name_label` varchar(100) DEFAULT NULL,
      `cnt_agri` int(10) unsigned NOT NULL DEFAULT '0',
      `cnt_garden` int(10) unsigned NOT NULL DEFAULT '0',
      `cnt_greenhouse` int(10) unsigned NOT NULL DEFAULT '0',
      `cnt_mushroom` int(10) unsigned NOT NULL DEFAULT '0',
      `cnt_bee` int(10) unsigned NOT NULL DEFAULT '0',
      `cnt_animal` int(10) unsigned NOT NULL DEFAULT '0',
      `area_abi` double NOT NULL DEFAULT '0',
      `area_dim` double NOT NULL DEFAULT '0',
      `area_garden_b` double NOT NULL DEFAULT '0',
      `area_garden_gb` double NOT NULL DEFAULT '0',
      `prod_agri` double NOT NULL DEFAULT '0',
      `prod_garden` double NOT NULL DEFAULT '0',
      `users_zone` int(10) unsigned NOT NULL DEFAULT '0',
      `users_staff` int(10) unsigned NOT NULL DEFAULT '0',
      `users_admin` int(10) unsigned NOT NULL DEFAULT '0',
      `children_text` mediumtext,
      `visits_text` text,
      `extra_text` mediumtext,
      `built_at` datetime NOT NULL,
      `build_ms` int(10) unsigned DEFAULT NULL,
      `source_ver` varchar(20) DEFAULT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `uq_dash_snap_locked` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`id_mar`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci";

    $ddl['dash_snap_open'] = "CREATE TABLE IF NOT EXISTS `dash_snap_open` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `year_agri` varchar(4) NOT NULL,
      `level_code` enum('country','ostan','city','mar') NOT NULL,
      `id_ostan` varchar(2) NOT NULL DEFAULT '',
      `id_city` varchar(2) NOT NULL DEFAULT '',
      `id_mar` varchar(5) NOT NULL DEFAULT '',
      `name_label` varchar(100) DEFAULT NULL,
      `cnt_agri` int(10) unsigned NOT NULL DEFAULT '0',
      `cnt_garden` int(10) unsigned NOT NULL DEFAULT '0',
      `cnt_greenhouse` int(10) unsigned NOT NULL DEFAULT '0',
      `cnt_mushroom` int(10) unsigned NOT NULL DEFAULT '0',
      `cnt_bee` int(10) unsigned NOT NULL DEFAULT '0',
      `cnt_animal` int(10) unsigned NOT NULL DEFAULT '0',
      `area_abi` double NOT NULL DEFAULT '0',
      `area_dim` double NOT NULL DEFAULT '0',
      `area_garden_b` double NOT NULL DEFAULT '0',
      `area_garden_gb` double NOT NULL DEFAULT '0',
      `prod_agri` double NOT NULL DEFAULT '0',
      `prod_garden` double NOT NULL DEFAULT '0',
      `users_zone` int(10) unsigned NOT NULL DEFAULT '0',
      `users_staff` int(10) unsigned NOT NULL DEFAULT '0',
      `users_admin` int(10) unsigned NOT NULL DEFAULT '0',
      `children_text` mediumtext,
      `visits_text` text,
      `extra_text` mediumtext,
      `built_at` datetime NOT NULL,
      `build_ms` int(10) unsigned DEFAULT NULL,
      `source_ver` varchar(20) DEFAULT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `uq_dash_snap_open` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`id_mar`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci";

    $ddl['dash_snap_run'] = "CREATE TABLE IF NOT EXISTS `dash_snap_run` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `started_at` datetime NOT NULL,
      `finished_at` datetime DEFAULT NULL,
      `status` enum('running','ok','fail') NOT NULL DEFAULT 'running',
      `target` enum('open','locked','both') NOT NULL DEFAULT 'open',
      `year_agri` varchar(4) DEFAULT NULL,
      `rows_written` int(10) unsigned NOT NULL DEFAULT '0',
      `error_text` text,
      `source_ver` varchar(20) DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci";

    foreach ($ddl as $name => $sql) {
        if (dash_table_exists($dbh, $name)) {
            continue;
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
    dash_snap_ensure_extra_column($dbh, 'dash_snap_open');
    dash_snap_ensure_extra_column($dbh, 'dash_snap_locked');
    return true;
}

/** Years that should be treated as locked for agri (from status, else b_sal minus open). */
function dash_locked_years_or_fallback($dbh)
{
    $years = dash_locked_years($dbh, array('agri'));
    if ($years) {
        return $years;
    }
    $open = dash_open_years($dbh, array('agri'));
    $all = array();
    $salRows = dash_rows($dbh, 'SELECT sal FROM b_sal ORDER BY sal ASC', array());
    foreach ($salRows as $r) {
        $s = trim($r['sal'] . '');
        if (preg_match('/^(13|14)\d{2}$/', $s) && !in_array($s, $all, true)) {
            $all[] = $s;
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

function dash_snap_pack_row($year, $level, $id_ostan, $id_city, $id_mar, $name, $stats, $users, $children, $visits, $builtAt, $buildMs, $ver, $extra = null)
{
    $plots = isset($stats['plots']) ? $stats['plots'] : array();
    $agriArea = isset($stats['agri_area']) ? $stats['agri_area'] : array();
    $gardenArea = isset($stats['garden_area']) ? $stats['garden_area'] : array();
    $roles = isset($users['roles']) ? $users['roles'] : array();
    if (!is_array($extra)) {
        $extra = array();
    }
    if (!isset($extra['garden_area']) && $gardenArea) {
        $extra['garden_area'] = $gardenArea;
    }
    return array(
        'year_agri' => (string) $year,
        'level_code' => $level,
        'id_ostan' => $id_ostan === null ? '' : (string) $id_ostan,
        'id_city' => $id_city === null ? '' : (string) $id_city,
        'id_mar' => $id_mar === null ? '' : (string) $id_mar,
        'name_label' => $name,
        'cnt_agri' => isset($plots['agri']) ? (int) $plots['agri'] : 0,
        'cnt_garden' => isset($plots['garden']) ? (int) $plots['garden'] : 0,
        'cnt_greenhouse' => isset($plots['greenhouse']) ? (int) $plots['greenhouse'] : 0,
        'cnt_mushroom' => isset($plots['mushroom']) ? (int) $plots['mushroom'] : 0,
        'cnt_bee' => isset($plots['bee']) ? (int) $plots['bee'] : 0,
        'cnt_animal' => isset($plots['animal']) ? (int) $plots['animal'] : 0,
        'area_abi' => isset($agriArea['abi']) ? (float) $agriArea['abi'] : 0,
        'area_dim' => isset($agriArea['dim']) ? (float) $agriArea['dim'] : 0,
        'area_garden_b' => isset($gardenArea['baror']) ? (float) $gardenArea['baror'] : 0,
        'area_garden_gb' => isset($gardenArea['nonbaror']) ? (float) $gardenArea['nonbaror'] : 0,
        'prod_agri' => isset($stats['agri_prod']) ? (float) $stats['agri_prod'] : 0,
        'prod_garden' => isset($stats['garden_prod']) ? (float) $stats['garden_prod'] : 0,
        'users_zone' => isset($roles['zone']) ? (int) $roles['zone'] : 0,
        'users_staff' => isset($users['provincial']) ? (int) $users['provincial'] : 0,
        'users_admin' => isset($users['hq']) ? (int) $users['hq'] : 0,
        'children_text' => $children === null ? null : dash_json_encode($children),
        'visits_text' => $visits === null ? null : dash_json_encode($visits),
        'extra_text' => $extra ? dash_json_encode($extra) : null,
        'built_at' => $builtAt,
        'build_ms' => $buildMs,
        'source_ver' => $ver
    );
}

function dash_snap_build_open_country_ostan($dbh, $year, $ver)
{
    return dash_snap_build_levels($dbh, $year, $ver, true, 'dash_snap_open');
}

function dash_snap_build_open_levels($dbh, $year, $ver, $withCity)
{
    return dash_snap_build_levels($dbh, $year, $ver, $withCity, 'dash_snap_open');
}

function dash_snap_build_locked_levels($dbh, $year, $ver, $withCity)
{
    return dash_snap_build_levels($dbh, $year, $ver, $withCity, 'dash_snap_locked');
}

/** Extended snap fields. bah never stored (always live). rank only country/ostan. */
function dash_snap_extra_payload($dbh, $level, $id_ostan, $id_city, $id_mar, $year, $stats, $includeBah = false, $includeRank = false)
{
    $garden = isset($stats['garden_area']) ? $stats['garden_area'] : dash_garden_area_stats($dbh, $id_ostan, $id_city, $id_mar, $year);
    $extra = array(
        'garden_area' => $garden
    );
    if ($includeBah) {
        $extra['bah'] = dash_bah_stats($dbh, $id_ostan, $id_city, $id_mar);
    }
    if ($includeRank) {
        $extra['rank'] = dash_rank_board($dbh, $level, $id_ostan, $id_city, $year);
    }
    return $extra;
}

/**
 * Beneficiaries are not year-scoped — always from live bah table.
 * (Kept for compatibility; prefer dash_bah_stats directly.)
 */
function dash_bah_from_open_or_live($dbh, $level, $id_ostan, $id_city, $id_mar, $preferYear = 0)
{
    return dash_bah_stats($dbh, $id_ostan, $id_city, $id_mar);
}

function dash_snap_build_levels($dbh, $year, $ver, $withCity, $table)
{
    $year = (string) ((int) $year);
    $agri = 'Agri' . $year . '_' . ((int) $year + 1);
    $agriProd = 'Agri_prod' . $year . '_' . ((int) $year + 1);
    $result = array('year' => $year, 'rows' => 0, 'errors' => array(), 'cities' => 0, 'table' => $table);

    if ($table !== 'dash_snap_open' && $table !== 'dash_snap_locked') {
        $result['errors'][] = 'bad target table';
        return $result;
    }
    dash_snap_ensure_extra_column($dbh, $table);
    if (!dash_table_exists($dbh, $agri)) {
        $result['errors'][] = 'missing table ' . $agri;
        return $result;
    }
    if (!dash_table_exists($dbh, $agriProd)) {
        $result['errors'][] = 'missing table ' . $agriProd;
        return $result;
    }

    $builtAt = date('Y-m-d H:i:s');

    $t0 = microtime(true);
    $stats = dash_collect_stats($dbh, '', '', '', (int) $year);
    $users = dash_user_stats($dbh, '', '', '');
    $visits = dash_visits($dbh, '', '', '');
    $children = dash_choropleth($dbh, (int) $year);
    // Rank only at country/ostan (city rank is live on view — keeps build fast)
    $extra = dash_snap_extra_payload($dbh, 'country', '', '', '', (int) $year, $stats, false, true);
    $ms = (int) round((microtime(true) - $t0) * 1000);
    $row = dash_snap_pack_row($year, 'country', '', '', '', 'Iran', $stats, $users, $children, $visits, $builtAt, $ms, $ver, $extra);
    if (dash_snap_upsert_table($dbh, $table, $row)) {
        $result['rows']++;
    } else {
        $errExtra = isset($GLOBALS['dash_snap_last_error']) ? (': ' . $GLOBALS['dash_snap_last_error']) : '';
        $result['errors'][] = 'upsert country failed' . $errExtra;
    }

    $ostans = dash_rows($dbh, 'SELECT id_ostan, ostan FROM ostanname ORDER BY id_ostan ASC', array());
    foreach ($ostans as $o) {
        $idOstan = trim($o['id_ostan'] . '');
        if ($idOstan === '') {
            continue;
        }
        $t1 = microtime(true);
        $stats = dash_collect_stats($dbh, $idOstan, '', '', (int) $year);
        $users = dash_user_stats($dbh, $idOstan, '', '');
        $visits = dash_visits($dbh, $idOstan, '', '');
        $cities = dash_cities($dbh, $idOstan, (int) $year);
        $extra = dash_snap_extra_payload($dbh, 'ostan', $idOstan, '', '', (int) $year, $stats, false, true);
        $ms = (int) round((microtime(true) - $t1) * 1000);
        $row = dash_snap_pack_row(
            $year,
            'ostan',
            $idOstan,
            '',
            '',
            $o['ostan'],
            $stats,
            $users,
            $cities,
            $visits,
            $builtAt,
            $ms,
            $ver,
            $extra
        );
        if (dash_snap_upsert_table($dbh, $table, $row)) {
            $result['rows']++;
        } else {
            $result['errors'][] = 'upsert ostan ' . $idOstan . ' failed';
        }

        if (!$withCity) {
            continue;
        }
        foreach ($cities as $c) {
            $idCity = isset($c['id_city']) ? trim($c['id_city'] . '') : '';
            if ($idCity === '') {
                continue;
            }
            $cityName = isset($c['city']) ? $c['city'] : $idCity;
            $t2 = microtime(true);
            $stats = dash_collect_stats($dbh, $idOstan, $idCity, '', (int) $year);
            $users = dash_user_stats($dbh, $idOstan, $idCity, '');
            $visits = dash_visits($dbh, $idOstan, $idCity, '');
            $centers = dash_centers($dbh, $idOstan, $idCity, (int) $year);
            // City: garden detail only — no bah, no rank (avoids 2× build time)
            $extra = dash_snap_extra_payload($dbh, 'city', $idOstan, $idCity, '', (int) $year, $stats, false, false);
            $ms = (int) round((microtime(true) - $t2) * 1000);
            $row = dash_snap_pack_row(
                $year,
                'city',
                $idOstan,
                $idCity,
                '',
                $cityName,
                $stats,
                $users,
                $centers,
                $visits,
                $builtAt,
                $ms,
                $ver,
                $extra
            );
            if (dash_snap_upsert_table($dbh, $table, $row)) {
                $result['rows']++;
                $result['cities']++;
            } else {
                $result['errors'][] = 'upsert city ' . $idOstan . '-' . $idCity . ' failed';
            }
        }
    }

    return $result;
}

function dash_year_is_open($dbh, $year, $domain)
{
    $year = trim($year . '');
    $domain = trim($domain . '');
    if ($year === '' || $domain === '') {
        return false;
    }
    $rows = dash_rows(
        $dbh,
        "SELECT status FROM dash_year_status WHERE year_agri = ? AND domain = ? LIMIT 1",
        array($year, $domain)
    );
    return ($rows && isset($rows[0]['status']) && $rows[0]['status'] === 'open');
}

function dash_snap_get_open($dbh, $year, $level, $id_ostan, $id_city, $id_mar)
{
    return dash_snap_get_table($dbh, 'dash_snap_open', $year, $level, $id_ostan, $id_city, $id_mar);
}

function dash_snap_get_locked($dbh, $year, $level, $id_ostan, $id_city, $id_mar)
{
    return dash_snap_get_table($dbh, 'dash_snap_locked', $year, $level, $id_ostan, $id_city, $id_mar);
}

function dash_snap_get_table($dbh, $table, $year, $level, $id_ostan, $id_city, $id_mar)
{
    if ($table !== 'dash_snap_open' && $table !== 'dash_snap_locked') {
        return null;
    }
    $rows = dash_rows(
        $dbh,
        "SELECT * FROM `$table`
         WHERE year_agri = ? AND level_code = ? AND id_ostan = ? AND id_city = ? AND id_mar = ?
         LIMIT 1",
        array(
            (string) $year,
            $level,
            $id_ostan === null ? '' : (string) $id_ostan,
            $id_city === null ? '' : (string) $id_city,
            $id_mar === null ? '' : (string) $id_mar
        )
    );
    return $rows ? $rows[0] : null;
}

function dash_snap_decode($text)
{
    if ($text === null || $text === '') {
        return array();
    }
    $decoded = json_decode($text, true);
    return is_array($decoded) ? $decoded : array();
}

function dash_snap_extra_from_row($row)
{
    return dash_snap_decode(isset($row['extra_text']) ? $row['extra_text'] : '');
}

function dash_snap_stats_from_row($row)
{
    $extra = dash_snap_extra_from_row($row);
    $garden = array(
        'baror' => (float) $row['area_garden_b'],
        'nonbaror' => (float) $row['area_garden_gb'],
        'baror_abi' => 0,
        'nonbaror_abi' => 0,
        'baror_dim' => 0,
        'nonbaror_dim' => 0
    );
    if (!empty($extra['garden_area']) && is_array($extra['garden_area'])) {
        foreach ($extra['garden_area'] as $k => $v) {
            $garden[$k] = (float) $v;
        }
    }
    return array(
        'plots' => array(
            'agri' => (int) $row['cnt_agri'],
            'garden' => (int) $row['cnt_garden'],
            'greenhouse' => (int) $row['cnt_greenhouse'],
            'mushroom' => (int) $row['cnt_mushroom'],
            'bee' => (int) $row['cnt_bee'],
            'animal' => (int) $row['cnt_animal']
        ),
        'agri_area' => array(
            'abi' => (float) $row['area_abi'],
            'dim' => (float) $row['area_dim']
        ),
        'garden_area' => $garden,
        'agri_prod' => (int) round((float) $row['prod_agri']),
        'garden_prod' => (int) round((float) $row['prod_garden']),
        'bah' => (!empty($extra['bah']) && is_array($extra['bah'])) ? $extra['bah'] : null,
        'rank' => (!empty($extra['rank']) && is_array($extra['rank'])) ? $extra['rank'] : null
    );
}


