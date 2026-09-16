<?php
include ('../../login/config.php');
if($_POST['group_cod'])
{
?>
            <option value="">همه محصولات</option>
<?php
$group_cod=$_POST['group_cod'];
$query = "SELECT DISTINCT mah_cod,mah_name FROM `product_G` WHERE  `group_cod` = '$group_cod'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['mah_cod'] ;?>"
   <?php if ($row['mah_cod']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mah_name'] ;?></option>
     <?php
}
}
?>