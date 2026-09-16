<?php
$dash_allowed = array('20', '99');
$dash_here = dirname(__FILE__);
$dash_inc = $dash_here . '/../inc';
$dash_auth = is_file($dash_here . '/dash_mgmt_auth.php') ? $dash_here . '/dash_mgmt_auth.php' : $dash_inc . '/dash_mgmt_auth.php';
$dash_lib  = is_file($dash_here . '/dash_mgmt_lib.php') ? $dash_here . '/dash_mgmt_lib.php' : $dash_inc . '/dash_mgmt_lib.php';
$dash_body = is_file($dash_here . '/dash_mgmt_body.php') ? $dash_here . '/dash_mgmt_body.php' : $dash_inc . '/dash_mgmt_body.php';
require_once $dash_auth;
require_once $dash_lib;
require_once $dash_here . '/side_menu1.php';
$dash_api = 'dash_mgmt_api.php';
$dash_root = '../';
?>
<script>document.body.className += ' agri1-body agri1-page';</script>
<?php require $dash_body; ?>
