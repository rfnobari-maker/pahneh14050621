<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<form name='form1' action="" method="post">
 <input type="text" name="id_city" >
کد شهرستان 
  <p>
  <select dir="rtl"  name="city" id="city" style="width:170px ; height:40px" >
    <option value="0">انتخاب شهرستان</option>
    <?php
include_once('../login/config.php');
$query = "SELECT DISTINCT city FROM  users "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
    <option value="<? echo $row['city'] ;?>"><? echo $row['city'] ;?></option>
    <?php }?>
  </select>
  </p>
  <p>
    <input type="submit" name="action" id="action" value="ثبت" >
  </p>
</form>
</body>
</html>
<?php if (isset($_POST['action']))
{
echo 	$city = $_POST['city'] ;
echo    $id_city = $_POST['id_city'] ;

$query = "UPDATE users
        SET id_city=?
		WHERE city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_city,$city));


}
?>