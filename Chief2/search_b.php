<?php
 include('../lock_ce.php') ;
 include('../login/config.php');
 $key=$_GET['key'];
 $array = array();
 $query = "select last_name,name,id_ostan,id_city,id_mar,bah_cod_m from bah  where last_name LIKE '{$key}%'";
 $stmt = $dbh->prepare($query);
 $stmt->execute();
 foreach($stmt as $row)
    {
      $array[] = $row['last_name'].' '.$row['name'].' / '.$row['id_ostan'].' / '.$row['id_city'].' / '.$row['id_mar'].' - '.$row['bah_cod_m'];
    }
    echo json_encode($array);
?>