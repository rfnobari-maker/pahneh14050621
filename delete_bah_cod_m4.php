<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$mor_cod_m  = $_POST['mor_cod_m'] ;
?>
<form name="test" method="post" > 
  <p>
    <input type="text" name="mor_cod_m" id="mor_cod_m" value="<?php echo $mor_cod_m?>">
: کد ملی کارشناس </p>
  <p>
    <input type="text" name="bah_cod_m" id="bah_cod_m">
  : کد ملی </p>
  <p>
    <input type="submit" name="action" id="btn1" >
  </p>
</form>

<?php
if (isset($_POST['action'])) 
{ 
$mor_cod_m  = $_POST['mor_cod_m'] ;
$bah_cod_m = $_POST['bah_cod_m'] ;


$query = "SELECT bah_cod_m from bah where bah_cod_m = $bah_cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt -> rowCount();
if ($count == 0) 
  {
  alert('بهره بردار با این کد ملی یافت نشد') ;
  }
   else 
  {
$query = "SELECT mor_cod_m from bah where bah_cod_m = $bah_cod_m and  mor_cod_m = $mor_cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt -> rowCount();
if ($count == 0) 
{
  alert('کارشناس مروج ثبت کننده اطلاعات درست نیست') ;
  }
 else 
 {
$query = "DELETE from bah WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from bee WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from unknown_bee WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from Agri WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from Agri1394-1395 WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from Garden WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from Garden_prod WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from Agri_prod WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from Agri_prod1394-1395 WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from Aquatic WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from Greenhous WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from spoultry WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from malek WHERE bah_cod_m = $bah_cod_m";
$q = $dbh->prepare($query);
$q->execute();

$dbh = null;
alert('تمام');
}
}
}
?>