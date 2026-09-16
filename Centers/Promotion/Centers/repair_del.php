<?php 
 if (isset($_POST['id'])) 
 { 
include('../../../login/config.php');
$sql = "DELETE FROM promo_cent_repair WHERE id =  :id";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
$stmt->execute();
 header("Location: building.php"); 
 } 
 else 
 { 
 header("Location: building.php"); 
 } 
 ?>