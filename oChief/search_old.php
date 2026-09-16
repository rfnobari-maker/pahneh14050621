<?php
 include('../lock_oce.php') ;
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <?php
    $key=$_GET['key'];
    $array = array();
    $con=mysql_connect("localhost","eagri_upahneh","Reza9147857121");
    $db=mysql_select_db("eagri_pahneh",$con);
    $query=mysql_query("select * from users  where (id_ostan = '$id_ostan' and  Last_name LIKE '{$key}%' and S_access <> '98') or S_access = '99' ");
    while($row=mysql_fetch_assoc($query))
    {$array[] = $row['Last_name'].' '.$row['name'].' / '.$row['city'].' / '.$row['markaz'].' - '.$row['cod_m']; }
    echo json_encode($array);
?>
