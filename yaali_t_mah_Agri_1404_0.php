
<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT id,Agri_id from Agri_prod1403_1404 WHERE  `zer_kesht_a` = 0 and `zer_kesht_b` = 0     "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$id_prod = $row['id'] ;
$id = $row['Agri_id'] ;
//alert($id_prod);

$sql = "DELETE FROM Agri_prod1403_1404 WHERE id =  :id";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':id', $id_prod, PDO::PARAM_INT);   
$stmt->execute();

//alert($id);
$query = "SELECT t_mah from Agri1403_1404 where id = $id  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$t_mah = $row['t_mah'] ;
//alert($t_mah);
if($t_mah==1)
{
$sql = "DELETE FROM Agri1403_1404 WHERE id =  :id";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);   
$stmt->execute();
}
else 
{
$query = "UPDATE Agri1403_1404 SET t_mah=t_mah-1  WHERE id = ?  ";
$q = $dbh->prepare($query);
$q->execute(array($id));
}
}
alert('تمام');
?>
