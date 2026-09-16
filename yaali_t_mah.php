<?php

// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT t_mah,id from Vege WHERE  1   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$t_mah = $row['t_mah'] ;
$id = $row['id'] ;
//alert($id);
$query = "SELECT count(*) FROM  Vege_prod WHERE Vege_id =  $id " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_id = $stmt->fetchColumn();
//alert($count_id) ; 
if ($t_mah != $count_id) {
$query = "UPDATE Vege SET t_mah= $count_id  WHERE id = ?  ";
$q = $dbh->prepare($query);
$q->execute(array($id));
}
}
alert('تمام');
?>