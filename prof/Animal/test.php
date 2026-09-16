<?php 
$unit_id = $_POST['unit_id'] ;
$y_prod = $_POST['y_prod'] ;
include('../../login/config.php') ;
$query = "SELECT sum(zer_kesh) as zer_kesh FROM Mushroom_spawn where unit_id =? and y_prod=? order by id";
$stmt = $dbh->prepare($query);
$stmt->execute(array($unit_id,$y_prod));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$zer_kesh = $row['zer_kesh'] ;
if ($zer_kesh == 0) 
{
echo 'error' ; 
}
else 
{
echo $zer_kesh ; 
}
?>