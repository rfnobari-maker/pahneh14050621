<?php
 include('lock_p1.php') ;
 include('login/config.php');
 $key=$_GET['key'];
 $array = array();
 $query = "select Last_name,name,ostan,city,markaz,cod_m from users  where 
 	(id_ostan = '$id_ostan' and id_city = '$id_city' and  Last_name LIKE '{$key}%') or  
	(id_ostan = '$id_ostan' and S_access ='1' and  Last_name LIKE '{$key}%') or 
    (id_ostan = '$id_ostan' and S_access ='98' and  Last_name LIKE '{$key}%') or 
    (S_access ='99' and  Last_name LIKE '{$key}%') or 
	(id_ostan = '$id_ostan' and S_access ='4' and  Last_name LIKE '{$key}%') ";
 $stmt = $dbh->prepare($query);
 $stmt->execute();
 foreach($stmt as $row)
    {
      $array[] = $row['Last_name'].' '.$row['name'].' / '.$row['city'].' / '.$row['markaz'].' - '.$row['cod_m'];
    }
    echo json_encode($array);
?>
