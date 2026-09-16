<?php
include ('../../login/config.php');
if($_POST['id_city'])
{
$id_ostan=$_POST['id_ostan'];
$id_city=$_POST['id_city'];
$query = "SELECT  id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan'  and id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
        <?php }
}
?>