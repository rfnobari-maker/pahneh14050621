<form name="test" method="post" > 
  <p>
 <input type="text" name="add_abadi1" width="100px">
  : آدرس آماری آبادی ادغام شده  </p>
  <p>
 <input type="text" name="add_abadi2" width="100px">
  : در آدرس آماری آبادی  </p>
  <p>
    <input type="submit" name="action" id="btn1" >
  </p>
</form>
<?php
if (isset($_POST['action']) and ($_POST['add_abadi1'] != '') and ($_POST['add_abadi2']!='')) 
{ 
$add_abadi1 = $_POST['add_abadi1'] ; 
$add_abadi1 = str_replace(" ","",$add_abadi1);
$add_abadi2 = $_POST['add_abadi2'] ; 
$add_abadi2 = str_replace(" ","",$add_abadi2);

include ('login/config.php');
include ('event.php');

$query = "select abadi FROM list_abadi WHERE add_abadi = '$add_abadi1'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$abadi1 = $row['abadi'] ; 

$query = "select abadi FROM public_abadi4 WHERE add_abadi = '$add_abadi2'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$abadi2 = $row['abadi'] ; 
alert($abadi1) ; 
alert($abadi2) ; 
?>
<form name="send" method="post" action="do_edit_abadi.php" > 
     <input type="hidden" name="add_abadi1" value="<?php echo $add_abadi1  ;?>" />
     <input type="hidden" name="add_abadi2" value="<?php echo $add_abadi2  ;?>" />
    <input type="submit" name="action2" id="btn2" value="انجام تغییرات" >
</form>
<?php }?>
