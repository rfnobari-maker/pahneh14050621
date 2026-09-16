<?php
include ('../../login/config.php');
if($_POST['isic_cod'])
{
$isic_cod=$_POST['isic_cod'];
$query = "SELECT  isic_cod,mah_name FROM isic  WHERE  isic_cod = $isic_cod" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['mah_name'] ;?>"
   <?php if ($row['isic_cod']==$isic_cod) echo 'selected=selected'?>> <?php echo $row['mah_name'] ;?></option>
     <?php
}
}
?>