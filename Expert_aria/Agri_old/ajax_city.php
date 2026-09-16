<?php
include ('../../login/config.php');
if($_POST['group_cod'])
{
echo $group_cod=$_POST['group_cod'];
$query = "SELECT DISTINCT product_cod,product_name FROM product_z WHERE  group_cod = $group_cod" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<? echo $row['product_cod'] ;?>"
   <?php if ($row['product_cod']==$cod_mah) echo 'selected=selected'?>> <? echo $row['product_name'] ;?></option>
     <?php
}
}
?>