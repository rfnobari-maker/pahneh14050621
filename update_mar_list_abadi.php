<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT id_mar,mar from mar where 1   " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$id_mar = $row['id_mar'] ;
$mar = $row['mar'] ;

//alert($bah_cod_m);
//alert($cod_p);

$query = "UPDATE list_abadi SET mar=?  WHERE id_mar=? ";
$q = $dbh->prepare($query);
$q->execute(array($mar,$id_mar));

//$sql = "DELETE FROM Agri_prod1397_1398 WHERE Agri_id =  :id";
//$stmt =  $dbh->prepare($sql);
//$stmt->bindParam(':id', $id, PDO::PARAM_INT);   
//$stmt->execute();
}
alert('1تمام');
?>