<?php
include ('login/config.php');
include ('event.php');
$id_ostan = $_POST['id_ostan'] ;
$query = "SELECT bah_cod_m,no_bah from bah3  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$bah_cod_m = $row['bah_cod_m'] ;
$no_bah = $row['no_bah'] ;
$query = "SELECT count(*) FROM Aquatic WHERE bah_cod_m = ?  " ;
$stmt = $dbh->prepare($query);
$stmt -> execute(array($bah_cod_m));
$count = $stmt->fetchColumn();
if ($count > 0)
{
$query = "DELETE from bah3 WHERE bah_cod_m = ? and no_bah = ? ";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$no_bah));
}
}
alert('تمام');

?>