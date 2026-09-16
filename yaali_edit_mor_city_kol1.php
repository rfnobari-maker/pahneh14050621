<?php
include ('login/config.php');
include ('event.php');
$query = "SELECT mor_cod_m FROM list_city WHERE 1  group by mor_cod_m ";
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$mor_cod_m = $row['mor_cod_m'];
//alert($mor_cod_m) ; 
$query = " SELECT add_city,mor_cod_m,id_mar,id_city,id_ostan  FROM list_city where mor_cod_m = '$mor_cod_m'  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$add_city = $row['add_city'] ;
$mor_cod_m = $row['mor_cod_m'] ;
$id_mar = $row['id_mar'] ;
$id_city = $row['id_city'] ;
$id_ostan   = $row['id_ostan'] ;

$query = "UPDATE bah SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city,$add_city));

}
}
alert('تمام');
?>