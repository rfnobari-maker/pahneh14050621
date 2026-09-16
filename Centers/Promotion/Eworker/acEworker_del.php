<?php 
 if (isset($_POST['id'])) 
 { 
include('../../../login/config.php');
$cod_m = $_POST['cod_m'] ; 
$sql = "DELETE FROM Eworker_ac WHERE id = :id";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
$stmt->execute();
?>
	 <form name="myform1" class="myform" method="post" action="acEworker.php#result">
      <input type="hidden" name="cod_m"   value="<?php echo $cod_m ?>" />
      <input type="hidden" name="action_lise" value="1" />
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
 } 
 else 
 { 
?>
	 <form name="myform1" class="myform" method="post" action="acEworker.php#result">
      <input type="hidden" name="cod_m"   value="<?php echo $cod_m ?>" />
      <input type="hidden" name="action_lise" value="1" />
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
 } 
 ?>