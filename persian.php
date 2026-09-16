<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<?php 
include('login/config2.php');

$query = "SELECT * from users1";
$stmt = $dbh->prepare($query);
$stmt->execute();
// $row حلقه ای
 foreach($stmt as $row){
    echo "User : " . $row['city'] . "<br />";
}
?>
<form action="" method="post">
<input name="Last_name" type="text" >
<input name="sub" type="submit" value="ثبت">
</form>
<?php
if (isset($_POST['Last_name']))
{
$Last_name = $_POST['Last_name'] ;
}
$query = "INSERT INTO users1 (Last_name) VALUES (:Last_name)";
$q = $dbh->prepare($query);
$q->execute(array(':Last_name'=>$Last_name));
 ?>
</body>
</html>