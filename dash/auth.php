<?php
/**
 * Auth for the independent dash module.
 * Session lasts one working day (Asia/Tehran calendar date). No idle logout.
 */
require_once dirname(__FILE__) . '/session.php';
dash_session_boot();

$dash_json = defined('DASH_JSON') && DASH_JSON;

function dash_auth_fail()
{
    global $dash_json;
    dash_session_clear();
    if (!empty($dash_json)) {
        header('Content-Type: application/json; charset=utf-8');
        echo '{"ok":false,"error":"auth","login":"login.php"}';
        exit;
    }
    header('Location: login.php');
    exit;
}

require_once dirname(__FILE__) . '/../login/config.php';
$sysAccess = dirname(__FILE__) . '/../login/sys_access.php';
if (is_file($sysAccess)) {
    require_once $sysAccess;
}

if (isset($dbh) && $dbh && function_exists('pahneh_sys_ensure')) {
    pahneh_sys_ensure($dbh);
}

if (!function_exists('pahneh_sys_fetch_user') || !function_exists('pahneh_sys_can')) {
    dash_auth_fail();
}

$today = dash_today();
$user_check = '';
if (!empty($_SESSION['dash_user'])) {
    $user_check = $_SESSION['dash_user'];
} elseif (!empty($_SESSION['login_user'])) {
    $user_check = $_SESSION['login_user'];
}

if ($user_check === '' || empty($_SESSION['dash_day']) || $_SESSION['dash_day'] !== $today) {
    dash_auth_fail();
}

if (empty($dbh)) {
    dash_auth_fail();
}

$row = pahneh_sys_fetch_user($dbh, $user_check);
$accessOn = $row && isset($row['Access']) && ((int) $row['Access'] === 1 || $row['Access'] === '1');
if (!$row || !$accessOn || !pahneh_sys_can($row, 'dash')) {
    dash_auth_fail();
}

if (!array_key_exists('chief', $row)) {
    try {
        $cst = $dbh->prepare('SELECT chief FROM users WHERE username = ? LIMIT 1');
        if ($cst && $cst->execute(array($user_check))) {
            $crow = $cst->fetch(PDO::FETCH_ASSOC);
            if ($crow) {
                $row['chief'] = $crow['chief'];
            }
        }
    } catch (Exception $e) {
    }
}

$dash_user_ostan = $row['id_ostan'];
$dash_user_access = $row['S_access'];
$login_session = $row['username'];
$PersName = '';
if (isset($row['Last_name'])) {
    $PersName = trim($row['Last_name'] . '');
} elseif (isset($row['last_name'])) {
    $PersName = trim($row['last_name'] . '');
}
$euser = $PersName;
$ostan = $row['ostan'];
$name = isset($row['name']) ? trim($row['name'] . '') : '';
$id_ostan = $row['id_ostan'];
$id_city = isset($row['id_city']) ? $row['id_city'] : '';
$id_mar = isset($row['id_mar']) ? $row['id_mar'] : '';
$dash_user_chief = isset($row['chief']) ? trim($row['chief'] . '') : '';
$dash_force_ostan = '';
if ($dash_user_chief === '1') {
    $ownOstan = trim($id_ostan . '');
    if ($ownOstan !== '' && $ownOstan !== '0') {
        $dash_force_ostan = $ownOstan;
    }
}
$pic = !empty($row['pic']) ? $row['pic'] : 'no_pic.png';
$jens = isset($row['jens']) ? trim($row['jens'] . '') : '';
$perm = isset($row['perm']) ? $row['perm'] : '';
$date_pas = $row['date_pas'];
$S_access = $row['S_access'];
$jensNorm = str_replace(array('ي', 'ك', '‌'), array('ی', 'ک', ''), $jens);
if ($jensNorm === 'زن' || $jensNorm === 'خانم' || $jensNorm === '2') {
    $v_jen = 'خانم';
} elseif ($jensNorm === 'مرد' || $jensNorm === 'آقا' || $jensNorm === 'آقای' || $jensNorm === '1') {
    $v_jen = 'آقا';
} else {
    $v_jen = '';
}
$dash_user_last = $PersName;
$dash_user_first = $name;
$dash_user_vjen = $v_jen;
$dash_user_jens = $jens;
$dash_user_pic = $pic;
$title = 'داشبورد مدیریتی سامانه جامع پهنه‌بندی';
