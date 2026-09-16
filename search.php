<?php
 include('lock_p1.php') ;
 include('login/config.php');
 $key=$_GET['key'];
 $array = array();
 $query = "SELECT Last_name, name, ostan, city, markaz, cod_m
FROM users
WHERE Last_name LIKE '{$key}%'
  AND (
    (id_ostan = '$id_ostan' AND id_city = '$id_city')
    OR (id_ostan = '$id_ostan' AND S_access IN ('1', '4', '98'))
    OR (S_access = '99')
  ); ";
 $stmt = $dbh->prepare($query);
 $stmt->execute();
 foreach($stmt as $row)
    {
      $array[] = $row['Last_name'].' '.$row['name'].' / '.$row['city'].' / '.$row['markaz'].' - '.$row['cod_m'];
    }
    echo json_encode($array);
?>
