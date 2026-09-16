<?php
/**
 * مغایرت الگوی کشت: فقط تجاوز سطح پایین‌تر از سطح بالاتر.
 * mar_prod  کارشناسان > مرکز
 * city_mar  مراکز > شهرستان
 * ostan_city  شهرستان‌ها > استان
 * مقایسه کدبه‌کد محصول؛ سال ۱۴۰۴–۱۴۰۵ با نگاشت فرزند→والد.
 *
 * عملکرد: ابتدا سطح پایین جمع زده می‌شود، بعد با ابلاغی بالا مقایسه می‌شود.
 * نام استان/شهرستان/مرکز فقط برای ردیف‌های صفحه وصل می‌شود.
 * جدول کشت کارشناسان فقط وقتی تب mar_prod انتخاب شده اسکن می‌شود.
 */

if (!function_exists('agri2_h')) {
    function agri2_h($v)
    {
        if (!isset($v)) {
            return '';
        }
        return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
    }
}

function agri_ab_moghayer_kinds()
{
    return array(
        'mar_prod' => array(
            'label' => 'کارشناسان و مرکز',
            'up' => 'ابلاغی مرکز',
            'down' => 'کشت کارشناسان'
        ),
        'city_mar' => array(
            'label' => 'مراکز و شهرستان',
            'up' => 'ابلاغی شهرستان',
            'down' => 'جمع مراکز'
        ),
        'ostan_city' => array(
            'label' => 'شهرستان‌ها و استان',
            'up' => 'ابلاغی استان',
            'down' => 'جمع شهرستان‌ها'
        )
    );
}

function agri_ab_moghayer_norm_kind($kind)
{
    $kinds = agri_ab_moghayer_kinds();
    if (isset($kinds[$kind])) {
        return $kind;
    }
    return 'ostan_city';
}

function agri_ab_moghayer_valid_year($z_sal)
{
    return is_string($z_sal) && preg_match('/^\d{4}-\d{4}$/', $z_sal);
}

function agri_ab_moghayer_prod_table($z_sal)
{
    if (!agri_ab_moghayer_valid_year($z_sal)) {
        return '';
    }
    return 'Agri_prod' . str_replace('-', '_', $z_sal);
}

function agri_ab_moghayer_product_map($z_sal)
{
    $z = str_replace(' ', '', (string) $z_sal);
    if ($z !== '1404-1405') {
        return array();
    }
    return array(
        '103' => '102', '107' => '106', '176' => '490', '178' => '490', '180' => '490', '182' => '490', '184' => '490',
        '186' => '490', '188' => '490', '190' => '490', '192' => '490', '194' => '490', '196' => '490', '198' => '490', '200' => '490',
        '414' => '490', '416' => '490', '418' => '490', '420' => '490', '422' => '490', '424' => '490', '426' => '490', '428' => '490',
        '430' => '490', '432' => '490', '434' => '490', '436' => '490', '438' => '490', '440' => '490', '442' => '490', '444' => '490',
        '446' => '490', '448' => '490', '449' => '490', '464' => '490', '150' => '148'
    );
}

function agri_ab_moghayer_map_join($join_alias, $col, $z_sal)
{
    $map = agri_ab_moghayer_product_map($z_sal);
    if (empty($map)) {
        return array('join' => '', 'expr' => $col);
    }
    $parts = array();
    foreach ($map as $child => $parent) {
        $parts[] = 'SELECT ' . (int) $child . ' AS child_cod, ' . (int) $parent . ' AS parent_cod';
    }
    $join = ' LEFT JOIN (' . implode(' UNION ALL ', $parts) . ') `' . $join_alias . '`'
        . ' ON `' . $join_alias . '`.child_cod = CAST(' . $col . ' AS UNSIGNED) ';
    $expr = 'COALESCE(`' . $join_alias . '`.parent_cod, CAST(' . $col . ' AS UNSIGNED))';
    return array('join' => $join, 'expr' => $expr);
}

function agri_ab_moghayer_num($v)
{
    $n = floatval($v);
    if (abs($n - round($n)) < 0.00005) {
        return (string) intval(round($n));
    }
    return rtrim(rtrim(number_format($n, 4, '.', ''), '0'), '.');
}

function agri_ab_moghayer_ostan_sql($alias, $id_ostan, &$params)
{
    if ($id_ostan === '' || $id_ostan === null) {
        return '';
    }
    $params[] = $id_ostan;
    return ' AND ' . $alias . '.id_ostan = ? ';
}

function agri_ab_moghayer_noe_join()
{
    return "CROSS JOIN (
        SELECT 'آبی' AS noe, 1 AS which
        UNION ALL
        SELECT 'دیم' AS noe, 2 AS which
    ) n";
}

function agri_ab_moghayer_pair_sql($kind, $z_sal, $id_ostan, $prod_table)
{
    $params = array();
    $use_map = agri_ab_moghayer_product_map($z_sal) !== array();

    if ($kind === 'mar_prod') {
        $ostan_p = agri_ab_moghayer_ostan_sql('p0', $id_ostan, $params);
        $params[] = $z_sal;
        $ostan_m = agri_ab_moghayer_ostan_sql('m0', $id_ostan, $params);
        $mp = agri_ab_moghayer_map_join('map_p', 'p0.cod_mah', $z_sal);
        $mm = agri_ab_moghayer_map_join('map_m', 'm0.product_cod', $z_sal);
        $m_name = $use_map ? "''" : 'MAX(m0.product_name)';

        $sql = "
SELECT p.id_ostan,
       p.id_city,
       p.id_mar,
       p.cod_mah AS product_cod,
       CASE WHEN p.noe = 1 THEN 'آبی' ELSE 'دیم' END AS noe,
       COALESCE(CASE WHEN p.noe = 1 THEN m.s_abi ELSE m.s_dem END, 0) AS val_up,
       p.val_down,
       COALESCE(NULLIF(m.product_name, ''), '') AS product_name
FROM (
    SELECT p0.id_ostan,
           p0.id_city,
           p0.id_mar,
           {$mp['expr']} AS cod_mah,
           CASE WHEN p0.no_kesh IN (1, '1') THEN 1 ELSE 2 END AS noe,
           SUM(COALESCE(p0.zer_kesht_a, 0) + COALESCE(p0.zer_kesht_b, 0)) AS val_down
    FROM `{$prod_table}` p0
    {$mp['join']}
    WHERE (p0.no_kesh IN (1, 2) OR p0.no_kesh IN ('1', '2'))
          {$ostan_p}
    GROUP BY p0.id_ostan, p0.id_city, p0.id_mar, {$mp['expr']},
             CASE WHEN p0.no_kesh IN (1, '1') THEN 1 ELSE 2 END
) p
LEFT JOIN (
    SELECT m0.id_ostan,
           m0.id_city,
           m0.id_mar,
           {$mm['expr']} AS product_cod,
           SUM(COALESCE(m0.s_abi, 0)) AS s_abi,
           SUM(COALESCE(m0.s_dem, 0)) AS s_dem,
           {$m_name} AS product_name
    FROM Agri_ab_mar m0
    {$mm['join']}
    WHERE m0.z_sal = ?
          {$ostan_m}
    GROUP BY m0.id_ostan, m0.id_city, m0.id_mar, {$mm['expr']}
) m ON m.id_ostan = p.id_ostan
   AND m.id_city = p.id_city
   AND m.id_mar = p.id_mar
   AND CAST(m.product_cod AS UNSIGNED) = CAST(p.cod_mah AS UNSIGNED)
WHERE p.val_down > COALESCE(CASE WHEN p.noe = 1 THEN m.s_abi ELSE m.s_dem END, 0)
";
        return array('sql' => $sql, 'params' => $params);
    }

    if ($kind === 'city_mar') {
        $params[] = $z_sal;
        $ostan_m = agri_ab_moghayer_ostan_sql('m0', $id_ostan, $params);
        $params[] = $z_sal;
        $ostan_c = agri_ab_moghayer_ostan_sql('c0', $id_ostan, $params);
        $nj = agri_ab_moghayer_noe_join();
        $mm = agri_ab_moghayer_map_join('map_m', 'm0.product_cod', $z_sal);
        $mc = agri_ab_moghayer_map_join('map_c', 'c0.product_cod', $z_sal);
        $m_name = $use_map ? "''" : 'MAX(m0.product_name)';
        $c_name = $use_map ? "''" : 'MAX(c0.product_name)';

        $sql = "
SELECT m.id_ostan,
       m.id_city,
       '' AS id_mar,
       m.product_cod,
       n.noe,
       COALESCE(CASE WHEN n.which = 1 THEN c.s_abi ELSE c.s_dem END, 0) AS val_up,
       CASE WHEN n.which = 1 THEN m.down_abi ELSE m.down_dem END AS val_down,
       COALESCE(NULLIF(c.product_name, ''), NULLIF(m.product_name, ''), '') AS product_name
FROM (
    SELECT m0.id_ostan,
           m0.id_city,
           {$mm['expr']} AS product_cod,
           SUM(COALESCE(m0.s_abi, 0)) AS down_abi,
           SUM(COALESCE(m0.s_dem, 0)) AS down_dem,
           {$m_name} AS product_name
    FROM Agri_ab_mar m0
    {$mm['join']}
    WHERE m0.z_sal = ?
          {$ostan_m}
    GROUP BY m0.id_ostan, m0.id_city, {$mm['expr']}
) m
LEFT JOIN (
    SELECT c0.id_ostan,
           c0.id_city,
           {$mc['expr']} AS product_cod,
           SUM(COALESCE(c0.s_abi, 0)) AS s_abi,
           SUM(COALESCE(c0.s_dem, 0)) AS s_dem,
           {$c_name} AS product_name
    FROM Agri_ab_city c0
    {$mc['join']}
    WHERE c0.z_sal = ?
          {$ostan_c}
    GROUP BY c0.id_ostan, c0.id_city, {$mc['expr']}
) c ON c.id_ostan = m.id_ostan
   AND c.id_city = m.id_city
   AND CAST(c.product_cod AS UNSIGNED) = CAST(m.product_cod AS UNSIGNED)
{$nj}
WHERE CASE WHEN n.which = 1 THEN m.down_abi ELSE m.down_dem END
      > COALESCE(CASE WHEN n.which = 1 THEN c.s_abi ELSE c.s_dem END, 0)
";
        return array('sql' => $sql, 'params' => $params);
    }

    $params[] = $z_sal;
    $ostan_c = agri_ab_moghayer_ostan_sql('c0', $id_ostan, $params);
    $params[] = $z_sal;
    $ostan_o = agri_ab_moghayer_ostan_sql('o0', $id_ostan, $params);
    $nj = agri_ab_moghayer_noe_join();
    $mc = agri_ab_moghayer_map_join('map_c', 'c0.product_cod', $z_sal);
    $mo = agri_ab_moghayer_map_join('map_o', 'o0.product_cod', $z_sal);
    $c_name = $use_map ? "''" : 'MAX(c0.product_name)';
    $o_name = $use_map ? "''" : 'MAX(o0.product_name)';

    $sql = "
SELECT c.id_ostan,
       '' AS id_city,
       '' AS id_mar,
       c.product_cod,
       n.noe,
       COALESCE(CASE WHEN n.which = 1 THEN os.s_abi ELSE os.s_dem END, 0) AS val_up,
       CASE WHEN n.which = 1 THEN c.down_abi ELSE c.down_dem END AS val_down,
       COALESCE(NULLIF(os.product_name, ''), NULLIF(c.product_name, ''), '') AS product_name
FROM (
    SELECT c0.id_ostan,
           {$mc['expr']} AS product_cod,
           SUM(COALESCE(c0.s_abi, 0)) AS down_abi,
           SUM(COALESCE(c0.s_dem, 0)) AS down_dem,
           {$c_name} AS product_name
    FROM Agri_ab_city c0
    {$mc['join']}
    WHERE c0.z_sal = ?
          {$ostan_c}
    GROUP BY c0.id_ostan, {$mc['expr']}
) c
LEFT JOIN (
    SELECT o0.id_ostan,
           {$mo['expr']} AS product_cod,
           SUM(COALESCE(o0.s_abi, 0)) AS s_abi,
           SUM(COALESCE(o0.s_dem, 0)) AS s_dem,
           {$o_name} AS product_name
    FROM Agri_ab_ostan o0
    {$mo['join']}
    WHERE o0.z_sal = ?
          {$ostan_o}
    GROUP BY o0.id_ostan, {$mo['expr']}
) os ON os.id_ostan = c.id_ostan
   AND CAST(os.product_cod AS UNSIGNED) = CAST(c.product_cod AS UNSIGNED)
{$nj}
WHERE CASE WHEN n.which = 1 THEN c.down_abi ELSE c.down_dem END
      > COALESCE(CASE WHEN n.which = 1 THEN os.s_abi ELSE os.s_dem END, 0)
";
    return array('sql' => $sql, 'params' => $params);
}

function agri_ab_moghayer_named_sql($inner_sql)
{
    return "SELECT u.id_ostan,
                   COALESCE(o.ostan, '') AS ostan,
                   u.id_city,
                   COALESCE(ct.city, '') AS city,
                   u.id_mar,
                   COALESCE(mk.mar, '') AS mar,
                   u.product_cod,
                   COALESCE(NULLIF(u.product_name, ''), pz.product_name, u.product_cod) AS product_name,
                   u.noe,
                   u.val_up,
                   u.val_down,
                   (u.val_down - u.val_up) AS val_diff
            FROM (" . $inner_sql . ") u
            LEFT JOIN ostanname o ON o.id_ostan = u.id_ostan
            LEFT JOIN cityname ct ON NULLIF(u.id_city, '') IS NOT NULL
                AND ct.id_city = u.id_city AND ct.id_ostan = u.id_ostan
            LEFT JOIN mar mk ON NULLIF(u.id_mar, '') IS NOT NULL
                AND mk.id_mar = u.id_mar AND mk.id_city = u.id_city AND mk.id_ostan = u.id_ostan
            LEFT JOIN product_z pz ON CAST(pz.product_cod AS UNSIGNED) = CAST(u.product_cod AS UNSIGNED)";
}

function agri_ab_moghayer_wrap($inner_sql, $start, $limit)
{
    if ($limit === null) {
        return agri_ab_moghayer_named_sql($inner_sql)
            . ' ORDER BY u.id_ostan, u.id_city, u.id_mar, u.product_cod, u.noe';
    }
    $page_inner = 'SELECT z.* FROM (' . $inner_sql . ') z
        ORDER BY z.id_ostan, z.id_city, z.id_mar, z.product_cod, z.noe
        LIMIT ' . intval($start) . ', ' . intval($limit);
    return agri_ab_moghayer_named_sql($page_inner);
}

function agri_ab_moghayer_tmp_name()
{
    return 'tmp_abm_' . str_replace('.', '', uniqid('', true));
}

function agri_ab_moghayer_table_exists($dbh, $table)
{
    static $cache = array();
    if ($table === '') {
        return false;
    }
    if (isset($cache[$table])) {
        return $cache[$table];
    }
    $stmt = $dbh->query("SHOW TABLES LIKE " . $dbh->quote($table));
    $cache[$table] = ($stmt && $stmt->rowCount() > 0);
    return $cache[$table];
}

function agri_ab_moghayer_pair_ready($dbh, $kind, $z_sal, $id_ostan)
{
    $kind = agri_ab_moghayer_norm_kind($kind);
    if (!agri_ab_moghayer_valid_year($z_sal)) {
        return null;
    }
    $prod_table = agri_ab_moghayer_prod_table($z_sal);
    if ($kind === 'mar_prod' && !agri_ab_moghayer_table_exists($dbh, $prod_table)) {
        return null;
    }
    return agri_ab_moghayer_pair_sql($kind, $z_sal, $id_ostan, $prod_table);
}

function agri_ab_moghayer_fill_tmp($dbh, $pair)
{
    $tmp = agri_ab_moghayer_tmp_name();
    $sql = $pair['sql'];
    foreach ($pair['params'] as $p) {
        $quoted = $dbh->quote($p);
        $pos = strpos($sql, '?');
        if ($pos === false) {
            break;
        }
        $sql = substr($sql, 0, $pos) . $quoted . substr($sql, $pos + 1);
    }
    $dbh->exec('DROP TEMPORARY TABLE IF EXISTS `' . $tmp . '`');
    $dbh->exec('CREATE TEMPORARY TABLE `' . $tmp . '` AS ' . $sql);
    return $tmp;
}

function agri_ab_moghayer_count($dbh, $kind, $z_sal, $id_ostan)
{
    $pair = agri_ab_moghayer_pair_ready($dbh, $kind, $z_sal, $id_ostan);
    if ($pair === null) {
        return 0;
    }
    $sql = 'SELECT COUNT(*) FROM (' . $pair['sql'] . ') u';
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute($pair['params']);
        return intval($stmt->fetchColumn());
    } catch (PDOException $e) {
        return 0;
    }
}

function agri_ab_moghayer_rows($dbh, $kind, $z_sal, $id_ostan, $start, $limit)
{
    $pair = agri_ab_moghayer_pair_ready($dbh, $kind, $z_sal, $id_ostan);
    if ($pair === null) {
        return array();
    }
    $sql = agri_ab_moghayer_wrap($pair['sql'], $start, $limit);
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute($pair['params']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return array();
    }
}

function agri_ab_moghayer_page_from_pair($dbh, $pair, $start, $limit)
{
    $start = intval($start);
    $limit = intval($limit);
    if ($limit < 1) {
        $limit = 10;
    }
    $empty = array('rows' => array(), 'total' => 0, 'start' => 0);

    try {
        $tmp = agri_ab_moghayer_fill_tmp($dbh, $pair);
        $total = intval($dbh->query('SELECT COUNT(*) FROM `' . $tmp . '`')->fetchColumn());
        if ($total < 1) {
            $dbh->exec('DROP TEMPORARY TABLE IF EXISTS `' . $tmp . '`');
            return $empty;
        }
        if ($start >= $total) {
            $start = (int) (floor(($total - 1) / $limit) * $limit);
        }
        if ($start < 0) {
            $start = 0;
        }
        $page_inner = 'SELECT * FROM `' . $tmp . '`
            ORDER BY id_ostan, id_city, id_mar, product_cod, noe
            LIMIT ' . $start . ', ' . $limit;
        $named_q = $dbh->query(agri_ab_moghayer_named_sql($page_inner));
        if (!$named_q) {
            throw new PDOException('named page query failed');
        }
        $rows = $named_q->fetchAll(PDO::FETCH_ASSOC);
        $dbh->exec('DROP TEMPORARY TABLE IF EXISTS `' . $tmp . '`');
        return array('rows' => $rows, 'total' => $total, 'start' => $start);
    } catch (PDOException $e) {
        try {
            $count_stmt = $dbh->prepare('SELECT COUNT(*) FROM (' . $pair['sql'] . ') u');
            $count_stmt->execute($pair['params']);
            $total = intval($count_stmt->fetchColumn());
            if ($total < 1) {
                return $empty;
            }
            if ($start >= $total) {
                $start = (int) (floor(($total - 1) / $limit) * $limit);
            }
            if ($start < 0) {
                $start = 0;
            }
            $sql = agri_ab_moghayer_wrap($pair['sql'], $start, $limit);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($pair['params']);
            return array(
                'rows' => $stmt->fetchAll(PDO::FETCH_ASSOC),
                'total' => $total,
                'start' => $start
            );
        } catch (PDOException $e2) {
            return $empty;
        }
    }
}

function agri_ab_moghayer_page($dbh, $kind, $z_sal, $id_ostan, $start, $limit)
{
    $empty = array('rows' => array(), 'total' => 0, 'start' => intval($start));
    $pair = agri_ab_moghayer_pair_ready($dbh, $kind, $z_sal, $id_ostan);
    if ($pair === null) {
        return $empty;
    }
    return agri_ab_moghayer_page_from_pair($dbh, $pair, $start, $limit);
}

function agri_ab_moghayer_blank($v)
{
    $v = trim($v . '');
    if ($v === '' || $v === '/' || $v === '0') {
        return '—';
    }
    return $v;
}

function agri_ab_moghayer_filter_hiddens($z_sal, $id_ostan, $moghayer)
{
    $pairs = array(
        'action' => '1',
        'z_sal' => $z_sal,
        'id_ostan' => $id_ostan,
        'moghayer' => $moghayer
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}
