<?php 
 if (isset($_POST['username'])) 
 { 
include('../login/config.php');
$sql = "DELETE FROM users WHERE username =  :username";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':username', $_POST['username'], PDO::PARAM_INT);   
$stmt->execute();
 header("Location: user_view.php"); 
 } 
 else 
 { 
 header("Location: user_view.php"); 
 } 
 ?>