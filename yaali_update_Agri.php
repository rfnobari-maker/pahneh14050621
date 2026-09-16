<?php
include ('login/config.php');
include ('event.php');
$query = "SELECT add_city,id_mar,id_ostan,id_city from list_city where 1    " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$add_city = $row['add_city'] ;
$id_mar = $row['id_mar'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;

$query="UPDATE Agri1402_1403 SET id_ostan=?,id_city=? ,id_mar=? WHERE add_city=?";
$q=$dbh->prepare($query);
$q->execute(array($id_ostan,$id_city,$id_mar,$add_city));

$query="UPDATE Agri_prod1402_1403 SET id_ostan=?,id_city=? ,id_mar=? WHERE add_city=?";
$q=$dbh->prepare($query);
$q->execute(array($id_ostan,$id_city,$id_mar,$add_city));


}
alert('تمام');
?>