<?php
include ('event.php');
include ('./login/config.php');
$query = " SELECT *  FROM product_G where 1    "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row)
{
$catagory_name = $row['catagory_name'] ;
$catagory_cod= $row['catagory_cod'] ;
$group_name= $row['group_name'] ;
$group_cod= $row['group_cod'] ;
$mah_name= $row['mah_name'] ;
$mah_cod= $row['mah_cod'] ;
$ht= $row['ht'] ;
$id= 0 ;
include ('./login/config_utf8.php');
$query = "INSERT INTO product_G_uft8(catagory_name,catagory_cod,group_name,group_cod,mah_name,mah_cod,ht)
VALUES(:catagory_name,:catagory_cod,:group_name,:group_cod,:mah_name,:mah_cod,:ht)";
$q = $dbh->prepare($query);
$q->execute(array(':catagory_name'=>$catagory_name,
':catagory_cod'=>$catagory_cod,
':group_name'=>$group_name,
':group_cod'=>$group_cod,
':mah_name'=>$mah_name,
':mah_cod'=>$mah_cod,
':ht'=>$ht,
));
}
alert('تمام');
?>