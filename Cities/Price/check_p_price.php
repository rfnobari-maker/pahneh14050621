<?php
//require_once 'functions.php';
switch ($_POST['op']) {
	case 'check_p_price':
		$p_cod=$_POST['p_cod'];
		$p_price=$_POST['p_price'];
		$max_price = max_price($p_cod,$p_price);
    	$min_price = min_price($p_cod,$p_price);
  if ($p_price > $max_price or $p_price < $min_price) 
//      if( ($min_price > $p_price) && ($p_price > $max_price))
			echo 'no';
		else
			echo 'true';
		break;

	default:
		# code...
		break;
}

function max_price($p_cod,$p_price)
{
include('../../login/config.php');
$query = "SELECT max_price from price_pro_list where p_cod = '$p_cod' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$rcount = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$max_price = $row['max_price'] ;
return  $max_price ;
// clos conntection 
$dbh = null;
}
function min_price($p_cod,$p_price)
{
include('../../login/config.php');
$query = "SELECT min_price from price_pro_list where p_cod = '$p_cod' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$rcount = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$min_price = $row['min_price'] ;
return  $min_price ;
// clos conntection 
$dbh = null;
}

?>
