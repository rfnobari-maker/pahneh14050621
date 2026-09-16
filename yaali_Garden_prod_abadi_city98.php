<?php
include ('login/config.php');
include ('event.php');
$query = "SELECT id_mar,id_city,bah_cod_m from Garden_prod WHERE add_abadi <1 and add_city <1  and z_sal = '1404' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
//$count = $stmt -> rowCount();
foreach($stmt as $row){
$id_mar = $row['id_mar'] ;
$id_city = $row['id_city'] ;
$bah_cod_m = $row['bah_cod_m'] ;

//alert($bah_cod_m);
$query2 = "SELECT add_abadi,add_city from bah WHERE id_city = '$id_city' and id_mar = '$id_mar' and bah_cod_m = '$bah_cod_m'  "; 
$stmt = $dbh->prepare($query2);
$stmt->execute();
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt -> rowCount();
if ($count > 0)
{
$add_abadi = $row2['add_abadi'] ;
$add_city = $row2['add_city'] ;

//alert($add_abadi);
$query = "UPDATE Garden_prod SET add_abadi=? , add_city=?  where id_city = ?  and 
id_mar = ? and bah_cod_m = ? and add_abadi < 1 and add_city < 1  and z_sal = '1404' ";
$q = $dbh->prepare($query);
$q->execute(array($add_abadi,$add_city,$id_city,$id_mar,$bah_cod_m));
}
}
alert('تمام');
?>