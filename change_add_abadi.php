<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
?>
<form name="test" method="post" > 
  <p>
  <input type="text" name="add_abadi1">
  : جدید</p>
  <p>
    <input type="text" name="add_abadi2">
: قدیم </p>
  <p>
    <input type="submit" name="action" id="btn1" >
  </p>
</form>
<?php
if (isset($_POST['action'])) 
{ 
$add_abadi1 = $_POST['add_abadi1'] ;
$add_abadi2 = $_POST['add_abadi2'] ;

$query = "UPDATE list_abadi SET add_abadi=?  WHERE add_abadi = ? ";
$q = $dbh->prepare($query);
$q->execute(array($add_abadi1,$add_abadi2));

$query = "UPDATE bah SET add_abadi=?  WHERE add_abadi = ? ";
$q = $dbh->prepare($query);
$q->execute(array($add_abadi1,$add_abadi2));

$query = "UPDATE Agri SET add_abadi=?  WHERE add_abadi = ? ";
$q = $dbh->prepare($query);
$q->execute(array($add_abadi1,$add_abadi2));

$query = "UPDATE Agri_prod SET add_abadi=?  WHERE add_abadi = ? ";
$q = $dbh->prepare($query);
$q->execute(array($add_abadi1,$add_abadi2));

$query = "UPDATE Garden SET add_abadi=?  WHERE add_abadi = ? ";
$q = $dbh->prepare($query);
$q->execute(array($add_abadi1,$add_abadi2));

$query = "UPDATE Garden_prod SET add_abadi=?  WHERE add_abadi = ? ";
$q = $dbh->prepare($query);
$q->execute(array($add_abadi1,$add_abadi2));

$query = "UPDATE Greenhous SET add_abadi=?  WHERE add_abadi = ? ";
$q = $dbh->prepare($query);
$q->execute(array($add_abadi1,$add_abadi2));

$query = "UPDATE Aquatic SET add_abadi=?  WHERE add_abadi = ? ";
$q = $dbh->prepare($query);
$q->execute(array($add_abadi1,$add_abadi2));

$query = "UPDATE bee SET add_abadi=?  WHERE add_abadi = ? ";
$q = $dbh->prepare($query);
$q->execute(array($add_abadi1,$add_abadi2));

alert('تمام');
}
?>