<?php
include ('login/config.php');
include ('event.php');

$query = "UPDATE Garden_prod99 SET id = 0 ,  Garden_id_old = Garden_id
,date_s= Garden_id , z_sal = '1399' , mah_tol = 0 , mah_tolp = 0
WHERE 1 ";
$q = $dbh->prepare($query);
$q->execute(array());
?>