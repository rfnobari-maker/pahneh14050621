<?php 
include ('../login/config.php');
$query = "UPDATE users SET date_pas = NOW() - INTERVAL 1 DAY ";
$q = $dbh->prepare($query);
$q->execute();
?>