<?php 
 if (isset($_POST['cod_m'])) 
 { 
include('../../../login/config.php');
$sql = "DELETE FROM users WHERE cod_m =  :cod_m";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':cod_m', $_POST['cod_m'], PDO::PARAM_INT);   
$stmt->execute();
 header("Location: list_sold.php"); 
 } 
 else 
 { 
 header("Location: list_sold.php"); 
 } 
 ?>