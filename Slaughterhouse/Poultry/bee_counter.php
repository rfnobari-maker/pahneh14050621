<?php function ostan_status($id_ostan,$id_city)
{
include('../../login/config.php');
$query = "SELECT con_ostan  FROM `users` WHERE  `id_ostan`=$id_ostan and S_access='1' and con_ostan='1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_finish_mor = $stmt -> rowCount();
if ($count_finish_mor > 0 ) $result = 1 ; else $result = 2;   
return $result ; 
}
?>
<?php function city_status($id_ostan,$id_city)
{
include('../../login/config.php');
$query = "SELECT con_center  FROM  `users`  WHERE  `id_ostan` = $id_ostan and  `id_city` = $id_city  and S_access = '1' and con_city!='1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_finish_mor = $stmt -> rowCount();
if ($count_finish_mor > 0 ) $result = 2 ; else $result = 1;   
return $result ; 
}
?>