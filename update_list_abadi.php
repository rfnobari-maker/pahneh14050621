<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT city,abadi,add_abadi from public_abadi4 where id_ostan = '07' and id_city='31'   " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$city = $row['city'] ;
$abadi = $row['abadi'] ;
$add_abadi = $row['add_abadi'] ;

//alert($bah_cod_m);
//alert($cod_p);

$query = "UPDATE list_abadi SET city=? ,abadi= ?  WHERE add_abadi=? ";
$q = $dbh->prepare($query);
$q->execute(array($city,$abadi,$add_abadi));

//$sql = "DELETE FROM Agri_prod1397_1398 WHERE Agri_id =  :id";
//$stmt =  $dbh->prepare($sql);
//$stmt->bindParam(':id', $id, PDO::PARAM_INT);   
//$stmt->execute();
}
alert('1تمام');
?>