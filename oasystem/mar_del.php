<?php 
 if (isset($_POST['id_mar'])) 
 { 
include('../login/config.php');
$sql = "DELETE FROM mar WHERE id_mar =  :id_mar";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':id_mar', $_POST['id_mar'], PDO::PARAM_INT);   
$stmt->execute();
 header("Location: mar_view.php"); 
 } 
 else 
 { 
 header("Location: mar_view.php"); 
 } 
 ?>