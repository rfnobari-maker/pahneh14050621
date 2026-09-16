<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
require_once('Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$mor_cod_m  = $_POST['mor_cod_m'] ;
?>
<form name="test" method="post" > 
  <p>
    <input type="text" name="mor_cod_m" id="mor_cod_m" value="<?php echo $mor_cod_m?>">
: کد ملی کارشناس </p>
  <p>
    <input type="text" name="bah_cod_m1" id="bah_cod_m1">
  : کد ملی نادرست</p>
  <p>
    <input type="text" name="bah_cod_m2" id="bah_cod_m2">
: کد ملی درست</p>
  <p>
    <input type="submit" name="action" id="btn1" >
  </p>
</form>
<?php
if (isset($_POST['action'])) 
{ 
$mor_cod_m  = $_POST['mor_cod_m'] ;
$bah_cod_m1 = $_POST['bah_cod_m1'] ;
$bah_cod_m2 = $_POST['bah_cod_m2'] ;

$query = "SELECT bah_cod_m from bah where bah_cod_m = $bah_cod_m1";
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt -> rowCount();
if ($count == 0) 
  {
  alert('بهره بردار با کد ملی نادرست در سامانه یافت نشد') ;
  }
$query = "SELECT bah_cod_m from bah where bah_cod_m = $bah_cod_m2";
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt -> rowCount();
if ($count > 0) 
  {
  alert('بهره بردار با کد ملی درست قبلاً در سامانه ثبت شده است') ;
  }
   else 
  {
$query = "SELECT mor_cod_m from bah where bah_cod_m = $bah_cod_m1 and  mor_cod_m = $mor_cod_m";
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
$query = "UPDATE bah SET date_s ='$date_edit',bah_cod_m =$bah_cod_m2,ok='2' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from bah WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE bee SET bah_cod_m =$bah_cod_m2 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from bee WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();


$query = "UPDATE unknown_bee  SET bah_cod_m =$bah_cod_m2 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from unknown_bee WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();


$query = "UPDATE Agri  SET bah_cod_m =$bah_cod_m2 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from Agri WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1394-1395 SET bah_cod_m =$bah_cod_m2 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from Agri1394-1395 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();



$query = "UPDATE Garden SET bah_cod_m =$bah_cod_m2 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from Garden WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Garden_prod SET bah_cod_m =$bah_cod_m2 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from Garden_prod WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod SET bah_cod_m =$bah_cod_m2 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from Agri_prod WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();



$query = "UPDATE Agri_prod1394-1395 SET bah_cod_m =$bah_cod_m2 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from Agri_prod1394-1395 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Aquatic SET bah_cod_m =$bah_cod_m2 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from Aquatic WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Greenhous SET bah_cod_m =$bah_cod_m2 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from Greenhous WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE spoultry SET bah_cod_m =$bah_cod_m2 WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from spoultry WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE malek SET m_cod_m =$bah_cod_m2 WHERE m_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE from malek WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$dbh = null;
alert('تمام');
}
}
}
?>