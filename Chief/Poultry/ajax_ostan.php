<?php
include ('../../login/config.php');
if($_POST['group_cod'])
{
$m_ostan =$_POST['group_cod'];
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$m_ostan' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
                  <option value="" selected="selected">نام شهرستان</option>
                  <?php 
foreach($stmt as $row){
?>
            <option value="<?php  echo $row['id_city'] ;?>"> <?php  echo $row['city'] ;?></option>
     <?php
}
}
?>