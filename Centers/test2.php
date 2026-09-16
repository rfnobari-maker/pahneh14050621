<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<form action="" method="post"> 
<select name="abadi">
<option >انتخاب </option>
<?php
include('../login/config.php') ; 
$query = "SELECT abadi from list_abadi";
$stmt = $dbh->prepare($query);
$stmt->execute();
 foreach($stmt as $row){
   ?>
<option value="<?php echo $row['abadi']?>"><?php  echo $row['abadi'] ;?></option>
 <?php
}
?>
</select>
<input name="action" type="submit">
</form>
</body>
</html>
<?php
if (isset($_POST['action']))
{
	echo $_POST['abadi'] ;
	}
?>