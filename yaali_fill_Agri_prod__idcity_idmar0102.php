<?php
include ('login/config.php');
include ('event.php');
$query = "SELECT  Agri_id from Agri_prod1401_1402  WHERE id_mar ='/' or id_city ='/' or id_mar ='0' or id_city ='0'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
//$count = $stmt -> rowCount();
foreach($stmt as $row){
 $Agri_id = $row['Agri_id'] ;
//alert($mor_cod_m);
$query2 = "SELECT id_city,id_mar from Agri1401_1402  WHERE  id = $Agri_id  "; 
$stmt = $dbh->prepare($query2);
$stmt->execute();
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
//$count = $stmt -> rowCount();
 $id_mar = $row2['id_mar'] ;
 $id_city = $row2['id_city'] ;

//alert($id_mar);
$query = "UPDATE Agri_prod1401_1402 SET id_city=?,id_mar=?  WHERE  Agri_id = ? and id_city='/' or id_mar ='/' or id_mar ='0' or id_city ='0'  ";
$q = $dbh->prepare($query);
$q->execute(array($id_city,$id_mar,$Agri_id));
}
alert('تمام');

?>