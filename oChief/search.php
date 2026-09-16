<?php
 include('../lock_oce.php') ;
 include('../login/config.php');
 $key=$_GET['key'];
 $array = array();
// $query = "select Last_name,name,ostan,city,markaz,cod_m from users  where Last_name LIKE '%{$key}%'";
 $query = "select * from users  where (id_ostan = '$id_ostan' and  Last_name LIKE '{$key}%') or S_access = '99' or username = '3230698584'";
 $stmt = $dbh->prepare($query);
 $stmt->execute();
 foreach($stmt as $row)
    {
      $array[] = $row['Last_name'].' '.$row['name'].' / '.$row['ostan'].' / '.$row['city'].' / '.$row['markaz'].' - '.$row['cod_m'];
    }
    echo json_encode($array);
?>