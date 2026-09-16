<?php
require_once dirname(__FILE__) . '/session.php';
dash_session_clear();
header('Location: login.php');
exit;
