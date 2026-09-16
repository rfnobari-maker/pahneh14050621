<?php
$add_abadi = $_POST['add_abadi'] ; 
$add_city = $_POST['add_city'] ; 
include ('login/config.php');
include ('event.php');

$sql = "DELETE FROM list_abadi WHERE add_abadi =:add_abadi";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':add_abadi', $add_abadi, PDO::PARAM_INT);   
$stmt->execute();

$sql = "DELETE FROM public_abadi4 WHERE add_abadi =:add_abadi";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':add_abadi', $add_abadi, PDO::PARAM_INT);   
$stmt->execute();

$query = "UPDATE Agri1395_1396 SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1396_1397 SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1397_1398 SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1398_1399 SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1399_1400 SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1400_1401 SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri_prod1395_1396 SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri_prod1396_1397 SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri_prod1397_1398 SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri_prod1398_1399 SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri_prod1399_1400 SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri_prod1400_1401 SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Aquatic SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE bah SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE bee SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Garden SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Garden_prod SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Greenhousn SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Greenhous_prod SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Mushroom SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Mushroom_prod SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Vege SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Vege_prod SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

include ('login/config61.php');
$query = "UPDATE bah SET add_abadi = '-' , add_city = '$add_city' where add_abadi = '$add_abadi'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
alert('تمام');
$actual_link = "http://$_SERVER[HTTP_HOST]";
header("Location:$actual_link/yaali_convert_abadi_to_city2.php");
?>