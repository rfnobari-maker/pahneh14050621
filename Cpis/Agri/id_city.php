<?php
include ('../../login/config.php');
if($_POST['id_ostan'])
{
$id_ostan=$_POST['id_ostan'];
$query = "SELECT DISTINCT id_city,city FROM public_abadi4 WHERE  id_ostan = '$id_ostan' ORDER BY BINARY city ASC" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
           <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
     <?php
}
}
?>