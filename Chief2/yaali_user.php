<?php
include ('login/config.php');
include ('event.php');
$query = "UPDATE users SET Access = '0' where S_access = '1' or S_access = '2' or S_access = '3' or S_access = '98' "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array($mor_cod_m));
?>