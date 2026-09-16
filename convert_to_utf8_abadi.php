<?php
include ('event.php');
include ('login/config.php');
$query = " SELECT *  FROM list_abadi where 1   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row)
{
$id_ostan = $row['id_ostan'] ;
$ostan= $row['ostan'] ;
$id_city= $row['id_city'] ;
$city= $row['city'] ;
$bakh= $row['bakh'] ;
$deh= $row['deh'] ;
$id_mar= $row['id_mar'] ;
$mar= $row['mar'] ;
$abadi= $row['abadi'] ;
$mor_cod_m	= $row['mor_cod_m'] ;
$add_abadi= $row['add_abadi'] ;
$add_deh= $row['add_deh'] ;
$add_bakh= $row['add_bakh'] ;
$post_cod= $row['post_cod'] ;
$id= 0 ;
include ('login/config_utf8.php');
$query = "INSERT INTO  list_abadi_utf8(id_ostan,ostan,id_city,city,bakh,deh,id_mar,
mar,abadi,mor_cod_m,add_abadi,add_deh,add_bakh,post_cod)
VALUES(:id_ostan,:ostan,:id_city,:city,:bakh,:deh,:id_mar,:mar,:abadi,:mor_cod_m,:add_abadi,
:add_deh,:add_bakh,:post_cod)";
$q = $dbh->prepare($query);
$q->execute(array(
':id_ostan'=>$id_ostan,':ostan'=>$ostan,':id_city'=>$id_city,':city'=>$city,':bakh'=>$bakh,':deh'=>$deh,':id_mar'=>$id_mar,
':mar'=>$mar,':abadi'=>$abadi,':mor_cod_m'=>$mor_cod_m,':add_abadi'=>$add_abadi,':add_deh'=>$add_deh,':add_bakh'=>$add_bakh,
':post_cod'=>$post_cod));
}
alert('تمام');
?>