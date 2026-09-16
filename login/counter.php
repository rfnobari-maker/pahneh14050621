<?php
include('../login/config.php');
$query = "SELECT id  FROM  `bah` " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$bah = $stmt -> rowCount();
$query = "SELECT id  FROM  `bee` " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$bee = $stmt -> rowCount();
?>
