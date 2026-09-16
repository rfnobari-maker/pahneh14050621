<?php
 include("../lock_Sc.php");
    $key=$_GET['key'];
    $array = array();
    $con=mysql_connect("localhost","eagri_upahneh","Reza9147857121");
    $db=mysql_select_db("eagri_pahneh",$con);
    $query=mysql_query("select * from users  where (id_city = '$id_city' and id_ostan = '$id_ostan' and Last_name LIKE '{$key}%') or (id_ostan = '$id_ostan' and S_access >'2' and  Last_name LIKE '{$key}%') ");
    while($row=mysql_fetch_assoc($query))
    {
      $array[] = $row['Last_name'].' '.$row['name'].' / '.$row['city'].' / '.$row['markaz'].' - '.$row['cod_m'];
    }
    echo json_encode($array);
?>
