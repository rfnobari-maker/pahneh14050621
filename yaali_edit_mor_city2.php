<?php
include ('login/config.php');
include ('event.php');
$query = "SELECT `mor_cod_m`
FROM Agri_prod1402_1403
WHERE LEFT(id_mar, 2) <> id_ostan and  LENGTH(`add_city`) > 5  ";
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

$query = "UPDATE bah20 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city,$add_city));


$query = "UPDATE Agri1397_1398 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri1398_1399 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri1399_1400 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri1400_1401 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Agri1401_1402 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Agri1402_1403 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri1403_1404 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));


$query = "UPDATE Agri_prod1397_1398 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri_prod1398_1399 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri_prod1399_1400 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri_prod1400_1401 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Agri_prod1401_1402 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Agri_prod1402_1403 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri_prod1403_1404 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));


$query = "UPDATE Garden SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Garden_prod SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Greenhous SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Greenhous_prod SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Greenprod_annual SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));


$query = "UPDATE bee SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE unknown_bee SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Vege SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Vege_prod SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Aquatic SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Mushroom SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Mushroom_prod SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE animals_unit SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

}
}
alert('تمام');
?>