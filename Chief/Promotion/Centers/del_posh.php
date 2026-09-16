<?php 
 if (isset($_POST['cod_m'])) 
 { 
include_once('../../../login/config.php');
$sql = "DELETE FROM users WHERE cod_m =  :cod_m";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':cod_m', $_POST['cod_m'], PDO::PARAM_INT);   
$stmt->execute();
 header("Location: sstaff.php"); 
 } 
 else 
 { 
 header("Location: sstaff.php"); 
 } 
 ?>