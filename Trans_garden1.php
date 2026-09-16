<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query="SELECT id_old FROM Garden WHERE z_sal = '1400' and mor_cod_m = '1671916281'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$id_old = $row['id_old'] ;


$query="DELETE FROM Garden_08 WHERE  id_old = $id_old ";
$q = $dbh->prepare($query);
$q->execute();

alert($query) ;
$query="DELETE FROM Garden_prod08 WHERE  Garden_id_old = $id_old ";
$q = $dbh->prepare($query);
$q->execute();


}
alert('تمام');
?>