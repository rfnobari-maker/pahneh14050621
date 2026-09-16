<?php
include ('../../login/config.php');
if($_POST['m_ostan'])
{
$group_cod=$_POST['group_cod'];
$query = "SELECT  id_city,city FROM `cityname` WHERE  `id_ostam` = '$m_ostan' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php  echo $row['id_ostan'] ;?>"
   <?php if ($row['id_city']=='$id_city') echo 'selected=selected'?>> <?php  echo $row['city'] ;?></option>
     <?php
}
}
?>