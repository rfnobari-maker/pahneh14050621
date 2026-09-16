<?php 
 if (isset($_POST['id_city'])) 
 { 
$id_aria = $_POST['id_aria'] ; 
$id_ostan = $_POST['id_ostan'] ; 
$id_city = $_POST['id_city'] ; 

include('../login/config.php');
$sql = "DELETE FROM aria WHERE id_ostan = '$id_ostan' and id_city = $id_city";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(PDO::PARAM_INT);   
$stmt->execute();
?>
<form name="myform" class="myform" method="post" action="region.php">
<input type="hidden" name="id_aria" value="<?php echo  $id_aria?>">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="region.php">
<input type="hidden" name="id_aria" value="<?php echo  $id_aria?>">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 ?>