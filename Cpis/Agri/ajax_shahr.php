<?php
include ('../../login/config.php');
if($_POST['id_ostan'])
{
$id_ostan=$_POST['id_ostan'];
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = $id_ostan" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php  echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php  echo $row['city'] ;?></option>
     <?php
}
}
?>