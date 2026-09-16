<?php
include ('login/config.php');
include ('event.php');

$query = " SELECT * FROM public_city WHERE add_city !=add_city1 and add_city1 !=''   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

foreach($stmt as $row){
$add_city = $row['add_city'] ;
$add_city1 = $row['add_city1'] ;
$id_city  = $row['id_city'] ;
//$id_bakh  = $row['id_bakh'] ;
//$city  = $row['city'] ;
//$bakh  = $row['bakh'] ;
//$shahr  = $row['shahr'] ;

//$query = "UPDATE list_city SET add_city = '$add_city' , id_city = '$id_city' , city = '$city'
//, bakh = '$bakh' , shahr = '$shahr' , add_bakh = '$add_city'   WHERE add_city = '$add_city1' "; 
//$stmt = $dbh->prepare($query);
//$stmt->execute();

$query = "UPDATE bah SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE bee SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$query = "UPDATE Agri1397_1398 SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1398_1399 SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$query = "UPDATE Agri1399_1400 SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1400_1401 SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1401_1402 SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1402_1403 SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$query = "UPDATE Agri_prod1397_1398 SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri_prod1398_1399 SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri_prod1399_1400 SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri_prod1400_1401 SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri_prod1401_1402 SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri_prod1402_1403 SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$query = "UPDATE Aquatic SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$query = "UPDATE Garden SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Garden_prod SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$query = "UPDATE Greenhous SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Greenhous_prod SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Greenprod_annual SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$query = "UPDATE Mushroom SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$query = "UPDATE Mushroom_prod SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();



$query = "UPDATE Vege SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$query = "UPDATE Vege_prod SET 
add_city = '$add_city' , id_city = '$id_city'  WHERE add_city = '$add_city1' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();


}

alert('تمام');
?>