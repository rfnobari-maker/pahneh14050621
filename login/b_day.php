<?php
include('../event.php');
include('../date_con.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$today = date_con($date_edit) ; 
include('config.php');
$mm = (substr($today,5,2)) ;
$dd = (substr($today,8,2)) ;
$query = "SELECT * from users where substr(date_t,6,2) ='$mm' and substr(date_t,9,2) ='$dd' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
// $row حلقه ای
 foreach($stmt as $row){
    echo  $row['date_t'] .$row['Last_name']. "<br />";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>