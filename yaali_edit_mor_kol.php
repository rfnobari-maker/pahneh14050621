<?php
include ('login/config.php');
include ('event.php');
$query = "SELECT mor_cod_m FROM list_abadi WHERE id_ostan = '05'  group by mor_cod_m ";
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$mor_cod_m = $row['mor_cod_m'];
//alert($mor_cod_m) ; 
$query = " SELECT add_abadi,mor_cod_m,id_mar,id_city,id_ostan  FROM list_abadi where mor_cod_m = '$mor_cod_m'  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$add_abadi = $row['add_abadi'] ;
$mor_cod_m = $row['mor_cod_m'] ;
$id_mar = $row['id_mar'] ;
$id_city = $row['id_city'] ;
$id_ostan   = $row['id_ostan'] ;




$query = "UPDATE Agri1402_1403 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));


$query = "UPDATE Agri_prod1402_1403 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));


$query = "UPDATE Garden SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));

$query = "UPDATE Garden_prod SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));

$query = "UPDATE Greenhous SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));

$query = "UPDATE Greenhous_prod SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));

$query = "UPDATE Greenprod_annual SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));


$query = "UPDATE bee SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));

$query = "UPDATE unknown_bee SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));

$query = "UPDATE Vege SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));

$query = "UPDATE Vege_prod SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));

$query = "UPDATE Aquatic SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));

$query = "UPDATE Mushroom SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));

$query = "UPDATE Mushroom_prod SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_abadi));

}
}
alert('تمام');
?>