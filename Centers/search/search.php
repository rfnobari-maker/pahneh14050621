<?php
    $key=$_GET['key'];
    $array = array();
    $con=mysql_connect("localhost","eagri_upahneh","Reza9147857121");
    $db=mysql_select_db("eagri_pahneh",$con);
    $query=mysql_query("select * from users where Last_name LIKE '{$key}%'");
    while($row=mysql_fetch_assoc($query))
    {
      $array[] = $row['Last_name'].' '.$row['name'].' / '.$row['city'].' - '.$row['cod_m'];
    }
    echo json_encode($array);
?>
