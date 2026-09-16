<?php
include("../lock_oce.php");
include('../login/config.php');

// Cache configuration
$cache_time = 300; // 5 minutes cache
$cache_dir = '../cache/';
if (!file_exists($cache_dir)) {
    mkdir($cache_dir, 0777, true);
}

// Function to get cached data
function get_cached_data($key) {
    global $cache_dir, $cache_time;
    $cache_file = $cache_dir . md5($key) . '.cache';
    if (file_exists($cache_file) && (time() - filemtime($cache_file) < $cache_time)) {
        return unserialize(file_get_contents($cache_file));
    }
    return false;
}

// Function to save data to cache
function save_to_cache($key, $data) {
    global $cache_dir;
    $cache_file = $cache_dir . md5($key) . '.cache';
    file_put_contents($cache_file, serialize($data));
}

// Get user data
$query = "SELECT pic, fname FROM users WHERE username = ?";
$stmt = $dbh->prepare($query);
$stmt->execute(array($_SESSION['login_user']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row['pic'] == '' || $row['fname'] == '') {
    header("Location: profile.php?a");
    exit;
}

// Password expiration check
date_default_timezone_set('Asia/Tehran');
$v_date = date("Y-m-d", strtotime('-45 days'));
if (strtotime($date_pas) < strtotime($v_date)) {
    header("Location:expaire_pass.php");
    exit;
}

// Combined query for initial counts
$query = "SELECT 
    (SELECT COUNT(*) FROM users WHERE id_city = ? AND S_access = '2') as count_m,
    (SELECT COUNT(*) FROM list_abadi WHERE id_city = ?) as count_abadi,
    (SELECT COUNT(*) FROM users WHERE S_access = '1') as count_kol";
$stmt = $dbh->prepare($query);
$stmt->execute(array($id_city, $id_city));
$counts = $stmt->fetch(PDO::FETCH_ASSOC);

// Optimized counting functions
function get_count($table, $conditions = array(), $params = array()) {
    global $dbh;
    $where = '';
    if (!empty($conditions)) {
        $where = 'WHERE ' . implode(' AND ', $conditions);
    }
    $query = "SELECT COUNT(*) FROM $table $where";
    $stmt = $dbh->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}

// Optimized functions
function mor_abadi_count($mor_cod_m) {
    return get_count('list_abadi', array('mor_cod_m = ?'), array($mor_cod_m));
}

function mar_abadi_count($id_mar) {
    return get_count('list_abadi', array('id_mar = ?'), array($id_mar));
}

function mar_mor_count($id_mar) {
    return get_count('users', array('id_mar = ?', "S_access = '1'"), array($id_mar));
}

function city_mor_count($id_ostan, $id_city) {
    return get_count('users', array('id_ostan = ?', 'id_city = ?', "S_access = '1'"), array($id_ostan, $id_city));
}

function mar_mor_jens_count($id_mar, $n_jens) {
    $jens = ($n_jens == 1) ? 'مرد' : 'زن';
    return get_count('users', array('id_mar = ?', 'jens = ?', "S_access = '1'"), array($id_mar, $jens));
}

function city_mor_jens_count($id_ostan, $id_city, $n_jens) {
    $jens = ($n_jens == 1) ? 'مرد' : 'زن';
    return get_count('users', array('id_ostan = ?', 'id_city = ?', 'jens = ?', "S_access = '1'"), array($id_ostan, $id_city, $jens));
}

function mar_mor_mtah_count($id_mar, $m_tah) {
    return get_count('users', array('id_mar = ?', 'm_tah = ?', "S_access = '1'"), array($id_mar, $m_tah));
}

function city_mor_mtah_count($id_ostan, $id_city, $m_tah) {
    return get_count('users', array('id_ostan = ?', 'id_city = ?', 'm_tah = ?', "S_access = '1'"), array($id_ostan, $id_city, $m_tah));
}

function mar_request_count($id_mar, $status) {
    return get_count('change_mor', array('id_mar = ?', 'status = ?'), array($id_mar, $status));
}

function city_abadi_count($id_ostan, $id_city) {
    return get_count('list_abadi', array('id_ostan = ?', 'id_city = ?'), array($id_ostan, $id_city));
}

function city_shahr_count($id_ostan, $id_city) {
    return get_count('list_city', array('id_ostan = ?', 'id_city = ?'), array($id_ostan, $id_city));
}

function city_mar_count($id_ostan, $id_city) {
    return get_count('mar', array('id_ostan = ?', 'id_city = ?'), array($id_ostan, $id_city));
}

function city_count($id_ostan) {
    return get_count('cityname', array('id_ostan = ?'), array($id_ostan));
}

function shahr_count($id_ostan) {
    return get_count('list_city', array('id_ostan = ?'), array($id_ostan));
}

function ostan_abadi_count($id_ostan) {
    return get_count('list_abadi', array('id_ostan = ?'), array($id_ostan));
}

function ostan_mor_jens_count($id_ostan, $n_jens) {
    $jens = ($n_jens == 1) ? 'مرد' : 'زن';
    return get_count('users', array('id_ostan = ?', 'jens = ?', "S_access = '1'"), array($id_ostan, $jens));
}

function ostan_mor_mtah_count($id_ostan, $m_tah) {
    return get_count('users', array('id_ostan = ?', 'm_tah = ?', "S_access = '1'"), array($id_ostan, $m_tah));
}

function ostan_mor_count($id_ostan) {
    return get_count('users', array('id_ostan = ?', "S_access = '1'"), array($id_ostan));
}

function city_request_count($city) {
    return get_count('change_mor', array('city = ?'), array($city));
}

function ostan_bah_count($id_ostan) {
    return get_count('bah', array('id_ostan = ?', "ok = '1'"), array($id_ostan));
}

function city_bah_count($id_ostan, $id_city) {
    return get_count('bah', array('id_ostan = ?', 'id_city = ?', "ok = '1'"), array($id_ostan, $id_city));
}

function city_bah_notok($id_ostan, $id_city) {
    return get_count('bah', array('id_ostan = ?', 'id_city = ?', "ok = '2'"), array($id_ostan, $id_city));
}

function city_bee_count($id_ostan, $id_city) {
    return get_count('bee', array('id_ostan = ?', 'id_city = ?'), array($id_ostan, $id_city));
}

function abadi_update_per($id_ostan, $id_city) {
    global $dbh;
    $query = "SELECT COUNT(*) FROM list_abadi
              LEFT JOIN public_abadi4 ON public_abadi4.add_abadi = list_abadi.add_abadi
              WHERE public_abadi4.id_ostan = ? AND public_abadi4.id_city = ? AND public_abadi4.up_date <> ''";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($id_ostan, $id_city));
    $count_update = $stmt->fetchColumn();
    $count_kol = city_abadi_count($id_ostan, $id_city);
    return round((($count_update * 100) / $count_kol), 1);
}

function city_status($id_ostan, $id_city) {
    $count_finish_mor = get_count('users', array('id_city = ?', "S_access = '1'", "con_city = '1'"), array($id_city));
    return ($count_finish_mor == city_mor_count($id_ostan, $id_city)) ? 1 : 2;
}

function mor_shahr_count($mor_cod_m) {
    return get_count('list_city', array('mor_cod_m = ?'), array($mor_cod_m));
}

function mor_bah_count($mor_cod_m) {
    return get_count('bah', array('mor_cod_m = ?'), array($mor_cod_m));
}

function abadi_bah_count($add_abadi) {
    return get_count('bah', array('add_abadi = ?'), array($add_abadi));
}

function shahr_bah_count($add_city) {
    return get_count('bah', array('add_city = ?'), array($add_city));
}

function mor_Agri_count($mor_cod_m) {
    return get_count('Agri', array('mor_cod_m = ?'), array($mor_cod_m));
}

function mor_Garden_count($mor_cod_m) {
    return get_count('Garden', array('mor_cod_m = ?'), array($mor_cod_m));
}

function mor_spoul_count($mor_cod_m) {
    return get_count('spoul', array('mor_cod_m = ?'), array($mor_cod_m));
}

function mor_bee_count($mor_cod_m) {
    return get_count('bee', array('mor_cod_m = ?'), array($mor_cod_m));
}

function totl_mar_count($id_ostan) {
    return get_count('mar', array('id_ostan = ?'), array($id_ostan));
}

function ostan_chief_count($id_ostan) {
    return get_count('users', array('id_ostan = ?', "S_access = '4'", "username <> '9141120034'"), array($id_ostan));
}

function ostan_expar_sh_count($id_ostan) {
    return get_count('users', array('id_ostan = ?', "S_access = '6'"), array($id_ostan));
}

function ostan_scholar_count($id_ostan) {
    return get_count('users', array('id_ostan = ?', "S_access = '7'"), array($id_ostan));
}

function ostan_expar_count($id_ostan) {
    return get_count('users', array('id_ostan = ?', "S_access = '5'"), array($id_ostan));
}
?> 