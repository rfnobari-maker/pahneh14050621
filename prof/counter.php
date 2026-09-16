<?php
include ('../lock_p1.php') ;
include('../login/config.php');
//$query = "SELECT * from list_abadi where mor_cod_m'".$user_check."'";
$query = "SELECT * FROM  `bah` WHERE  `mor_cod_m` = $user_check " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count = $stmt -> rowCount();
?>