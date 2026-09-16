<?
include ('../../login/config.php') ;
	$query = "INSERT INTO pm (file) VALUES (:file)";
    $q = $dbh->prepare($query);
    $q->execute(array(':file'=>'salam'));
	?>