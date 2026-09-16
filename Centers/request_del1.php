<?php 
include("../lock_p2.php");
include('../login/config.php');
 if (isset($_POST['del_id'])) 
 { 
$del_id = $_POST['del_id'] ;
$sql = "DELETE FROM change_mor WHERE id =  :id";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':id', $del_id, PDO::PARAM_INT);   
$stmt->execute();
?>
<script>
window.location.href='list_request.php';
</script>
<?php
 } 
 else 
 { 
?>
<script>
window.location.href='list_request.php';
</script>
<?php
 } 
 ?>