<?php
//	include 'database.php';
	include('login/config.php') ;
	$p_cod=$_POST['p_cod'];
	$p_name=$_POST['p_name'];
	$p_unit=$_POST['p_unit'];
	$max_price=$_POST['max_price'];
	$min_price=$_POST['min_price'];

$query = "INSERT INTO price_pro_list( p_cod,p_name, p_unit, max_price, min_price) 
	VALUES (:p_cod,:p_name,:p_unit,:max_price,:min_price)";
$q = $dbh->prepare($query);
$q->execute(array(':p_cod'=>$p_cod,':p_name'=>$p_name,':p_unit'=>$p_unit,':max_price'=>$max_price,':min_price'=>$min_price));
		echo json_encode(array("statusCode"=>200));
$dbh = null;
?>