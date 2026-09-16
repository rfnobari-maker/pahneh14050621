<?php
$add_abadi1 = $_POST['add_abadi1'] ; 
$add_abadi2 = $_POST['add_abadi2'] ; 

include ('login/config.php');
include ('event.php');

$sql = "DELETE FROM list_abadi WHERE add_abadi =:add_abadi";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':add_abadi', $add_abadi1, PDO::PARAM_INT);   
$stmt->execute();



$query = "UPDATE `Agri1397_1398` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Agri1398_1399` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Agri1399_1400` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Agri1400_1401` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Agri1401_1402` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Agri1402_1403` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Agri1403_1404` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$query = "UPDATE `Agri_prod1397_1398` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Agri_prod1398_1399` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Agri_prod1399_1400` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Agri_prod1400_1401` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Agri_prod1401_1402` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Agri_prod1402_1403` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Agri_prod1403_1404` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$query = "UPDATE `Aquatic` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `bah` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `bee` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Garden` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Garden_prod` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Greenhous` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Greenhous_prod` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Greenprod_annual` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Mushroom` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Mushroom_prod` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Vege` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE `Vege_prod` SET  `add_abadi` = '$add_abadi2' where `add_abadi` = '$add_abadi1'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

alert('تمام');
$actual_link = "http://$_SERVER[HTTP_HOST]";
header("Location:$actual_link/yaali_merge_abadi_to_abadi.php");
?>