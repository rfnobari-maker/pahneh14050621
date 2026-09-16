<?php
/**
 * Auth for the management dashboard. Uses __DIR__ so it works from Chief/Cpis.
 */
if (session_id() === '') {
    session_start();
}

require_once dirname(__FILE__) . '/../login/config.php';

if (!isset($dash_allowed) || !is_array($dash_allowed) || !$dash_allowed) {
    $dash_allowed = array('20', '99', '23');
}

$actual_link = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

if (isset($_SESSION['last_acted_on']) && (time() - $_SESSION['last_acted_on'] > 60 * 15)) {
    $_SESSION = array();
    session_destroy();
    header('Location: ' . $actual_link . '/login/login.php');
    exit;
}
$_SESSION['last_acted_on'] = time();

$user_check = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : '';
if ($user_check === '' || !$dbh) {
    header('Location: ' . $actual_link . '/login/login.php');
    exit;
}

// Temporary: pages may set $dash_any_access=true to skip S_access filter
if (!empty($dash_any_access)) {
    $sql = "SELECT date_pas, username, Last_name, ostan, id_ostan, city, id_city, markaz, name, id_mar, pic, jens, perm, S_access
            FROM users WHERE username = ? LIMIT 1";
    $stmt = $dbh->prepare($sql);
    if (!$stmt) {
        header('Location: ' . $actual_link . '/login/login.php');
        exit;
    }
    $stmt->execute(array($user_check));
} else {
    $placeholders = implode(',', array_fill(0, count($dash_allowed), '?'));
    $sql = "SELECT date_pas, username, Last_name, ostan, id_ostan, city, id_city, markaz, name, id_mar, pic, jens, perm, S_access
            FROM users WHERE username = ? AND S_access IN ($placeholders)";
    $stmt = $dbh->prepare($sql);
    if (!$stmt) {
        header('Location: ' . $actual_link . '/login/login.php');
        exit;
    }
    $bind = array_merge(array($user_check), $dash_allowed);
    $stmt->execute($bind);
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    header('Location: ' . $actual_link . '/login/login.php');
    exit;
}

$dash_user_ostan = $row['id_ostan'];
$dash_user_access = $row['S_access'];
$login_session = $row['username'];
$PersName = $row['Last_name'];
$euser = $PersName;
$ostan = $row['ostan'];
$name = $row['name'];
$id_ostan = $row['id_ostan'];
$id_city = isset($row['id_city']) ? $row['id_city'] : '';
$id_mar = isset($row['id_mar']) ? $row['id_mar'] : '';
$pic = $row['pic'] ? $row['pic'] : 'no_pic.png';
$jens = $row['jens'];
$perm = $row['perm'];
$date_pas = $row['date_pas'];
$S_access = $row['S_access'];
$v_jen = '';
if ($jens == 'مرد') {
    $v_jen = 'آقای';
}
if ($jens == 'زن') {
    $v_jen = 'خانم';
}
$title = 'سامانه جامع پهنه‌بندی و مدیریت داده‌های کشاورزی';
