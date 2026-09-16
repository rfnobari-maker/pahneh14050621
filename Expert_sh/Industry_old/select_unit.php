<?php
include ('../../login/config.php');
if($_POST['cod_m'])
{

$cod_m=$_POST['cod_m'];
$query = "SELECT  id,unit_name FROM ind_unit WHERE  bah_cod_m = $cod_m"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
if ($stmt -> rowCount() <> 0)
{
foreach($stmt as $row){
?>
<script>
document.getElementById('bah_cod_m2').value = "<?php echo $row['unit_name']?>";
</script>
   <?php

}
}
}
?>
