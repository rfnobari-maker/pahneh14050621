<?php
include ('login/config.php');
include ('event.php');

$query = "UPDATE `public_city97` SET `id`= 0 "; 
$stmt = $dbh->prepare($query);
$stmt->execute();



alert('تمام');
?>