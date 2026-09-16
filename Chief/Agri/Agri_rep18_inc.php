<?php
if (!function_exists('agri2_h')) {
    function agri2_h($v)
    {
        if (!isset($v)) {
            return '';
        }
        return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
    }
}

function agri_rep18_table($prefix, $z_sal)
{
    if (!preg_match('/^\d{4}-\d{4}$/', $z_sal)) {
        return '';
    }
    return $prefix . str_replace('-', '_', $z_sal);
}

function agri_rep18_yield($mtol, $sb)
{
    $area = (float) $sb;
    if ($area <= 0) {
        return '';
    }
    return round(((float) $mtol) / $area, 2);
}

function agri_rep18_m_ab_name($code)
{
    $map = array(
        '1' => 'چشمه',
        '2' => 'قنات',
        '3' => 'رودخانه',
        '4' => 'سد',
        '5' => 'چاه سطحی',
        '6' => 'چاه عمیق',
        '7' => 'چاه نیمه عمیق',
        '8' => 'زهکش',
        '9' => 'پساب',
        '10' => 'آب بندان',
        '11' => 'سایر'
    );
    $key = (string) $code;
    return isset($map[$key]) ? $map[$key] : '';
}

function agri_rep18_no_kesh_name($code)
{
    if ((string) $code === '1') {
        return 'آبی';
    }
    if ((string) $code === '2') {
        return 'دیم';
    }
    return '';
}

function agri_rep18_join_name($last, $first)
{
    return trim(str_replace('&nbsp;', ' ', (string) $last . ' ' . (string) $first));
}

function agri_rep18_filters()
{
    $id_city = '';
    if (isset($_POST['id_city5'])) {
        $id_city = $_POST['id_city5'];
    } elseif (isset($_POST['id_city'])) {
        $id_city = $_POST['id_city'];
    }
    return array(
        'id_ostan' => isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '',
        'id_city' => $id_city,
        'no_kesh' => isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '',
        'z_sal' => isset($_POST['z_sal']) ? $_POST['z_sal'] : '',
        'mah_qroup' => isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '',
        'mah_name' => isset($_POST['mah_name']) ? $_POST['mah_name'] : ''
    );
}

function agri_rep18_city_all($id_city)
{
    return ($id_city === '' || $id_city === '0' || $id_city === 0 || $id_city === '-1');
}

function agri_rep18_where($f)
{
    $where = array();
    $params = array();
    if ($f['id_ostan'] !== '' && $f['id_ostan'] !== '-1') {
        $where[] = 'p.id_ostan = :id_ostan';
        $params[':id_ostan'] = $f['id_ostan'];
    }
    if (!agri_rep18_city_all($f['id_city'])) {
        $where[] = 'p.id_city = :id_city';
        $params[':id_city'] = $f['id_city'];
    }
    if ($f['no_kesh'] !== '') {
        $where[] = 'p.no_kesh = :no_kesh';
        $params[':no_kesh'] = $f['no_kesh'];
    }
    if ($f['mah_name'] !== '') {
        $where[] = 'p.cod_mah = :cod_mah';
        $params[':cod_mah'] = $f['mah_name'];
    }
    $sql = $where ? implode(' AND ', $where) : '1';
    return array($sql, $params);
}

function agri_rep18_select_list($prod)
{
    return "SELECT MAX(p.id_ostan) AS id_ostan, MAX(p.id_city) AS id_city, MAX(p.id_mar) AS id_mar,
        MAX(p.mor_cod_m) AS mor_cod_m, p.bah_cod_m,
        (SUM(p.zer_kesht_a) + SUM(p.zer_kesht_b)) AS zk,
        (SUM(p.s_bar_a) + SUM(p.s_bar_b)) AS sb,
        SUM(p.mah_tol) AS mtol,
        SUM(p.mah_tolp) AS mtol_p,
        MAX(c.city) AS city_name,
        MAX(mar.mar) AS mar_name,
        MAX(b.name) AS bah_n,
        MAX(b.Last_name) AS bah_ln,
        MAX(b.fname) AS bah_fn,
        MAX(b.tel_m) AS bah_tel,
        MAX(u.name) AS mor_n,
        MAX(u.Last_name) AS mor_ln,
        MAX(u.tel_m) AS mor_tel
        FROM `$prod` p
        LEFT JOIN bah b ON b.bah_cod_m = p.bah_cod_m
        LEFT JOIN users u ON u.username = p.mor_cod_m
        LEFT JOIN cityname c ON c.id_city = p.id_city AND c.id_ostan = p.id_ostan
        LEFT JOIN mar ON mar.id_mar = p.id_mar";
}

function agri_rep18_select_xls($prod, $agri)
{
    return "SELECT p.id_ostan, p.id_city, p.id_mar, p.no_kesh, a.m_ab, MAX(p.mor_cod_m) AS mor_cod_m, p.bah_cod_m,
        MAX(p.date_s) AS date_s,
        (SUM(p.zer_kesht_a) + SUM(p.zer_kesht_b)) AS zk,
        (SUM(p.s_bar_a) + SUM(p.s_bar_b)) AS sb,
        SUM(p.mah_tol) AS mtol,
        SUM(p.mah_tolp) AS mtol_p,
        MAX(o.ostan) AS ostan_name,
        MAX(c.city) AS city_name,
        MAX(mar.mar) AS mar_name,
        MAX(b.name) AS bah_n,
        MAX(b.Last_name) AS bah_ln,
        MAX(b.fname) AS bah_fn,
        MAX(b.tel_m) AS bah_tel,
        MAX(u.name) AS mor_n,
        MAX(u.Last_name) AS mor_ln,
        MAX(u.tel_m) AS mor_tel
        FROM `$prod` p
        LEFT JOIN `$agri` a ON a.id = p.Agri_id
        LEFT JOIN bah b ON b.bah_cod_m = p.bah_cod_m
        LEFT JOIN users u ON u.username = p.mor_cod_m
        LEFT JOIN ostanname o ON o.id_ostan = p.id_ostan
        LEFT JOIN cityname c ON c.id_city = p.id_city AND c.id_ostan = p.id_ostan
        LEFT JOIN mar ON mar.id_mar = p.id_mar";
}

function agri_rep18_filter_hiddens($f)
{
    $pairs = array(
        'action' => '1',
        'id_ostan' => $f['id_ostan'],
        'id_city5' => $f['id_city'],
        'z_sal' => $f['z_sal'],
        'mah_qroup' => $f['mah_qroup'],
        'mah_name' => $f['mah_name'],
        'no_kesh' => $f['no_kesh']
    );
    foreach ($pairs as $n => $v) {
        echo '<input type="hidden" name="' . agri2_h($n) . '" value="' . agri2_h($v) . '" />';
    }
}
