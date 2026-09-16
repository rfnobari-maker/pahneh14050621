<?php
 include('../../login/config.php');
 include('../../event.php');
 $query = "SELECT DISTINCT bah_cod_m,num_bah,id_ostan,id_city from Agri_prod where id_ostan='05'  and cod_mah='108' "; 
 $stmt = $dbh->prepare($query);
 $stmt->execute();
 $userData = array();
 while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  $userData['Data'][] = $row;
 }
 echo json_encode($userData);
?>
