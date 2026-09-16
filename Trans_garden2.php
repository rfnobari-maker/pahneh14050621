<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query="SELECT Garden_id_old FROM Garden_prod08 WHERE 1 group by Garden_id_old";
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$id_old  = $row['Garden_id_old'] ;
//alert($id_abadi) ; 
$query="SELECT id FROM Garden  WHERE id_old= $id_old ";
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$Garden_id  = $row['id'] ;
//alert($add_abadi) ; 
$query = "UPDATE Garden_prod08 SET Garden_id =? WHERE Garden_id_old=? ";
$q = $dbh->prepare($query);
$q->execute(array($Garden_id,$id_old));


}
}
alert('تمام');
?>