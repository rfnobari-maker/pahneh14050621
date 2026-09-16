<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    if (isset($dbh)) $dbh = null;
    header("Location:login.php");
?>
