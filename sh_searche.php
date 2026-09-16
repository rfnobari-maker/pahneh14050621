<?php
if (isset($_POST['txtsearch']) && (strlen($_POST['txtsearch'])>4))
{
$bah_cod_m = $_POST['txtsearch'] ; 
include('login/config.php');
$query = "SELECT name,last_name,bah_cod_m FROM  bah WHERE  last_name LIKE  '%$bah_cod_m%'  or bah_cod_m =  '$bah_cod_m'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
 foreach($stmt as $row){
 echo $row['bah_cod_m'].'---'.$row['name'].'----'.$row['last_name'].'<p>' ;
}
}
?>