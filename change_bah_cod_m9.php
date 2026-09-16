<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
?>
<form name="test" method="post" > 
  <p>
  <input type="text" name="bah_cod_m1" id="bah_cod_m1">
  : کد ملی نادرست</p>
  <p>
    <input type="text" name="bah_cod_m2" id="bah_cod_m2">
: کد ملی درست</p>
  <p>
    <input type="text" name="num_bah" id="num_bah" width="50">
: num_bah</p>
  <p>
    <input type="submit" name="action" id="btn1" >
  </p>
</form>
<?php
if (isset($_POST['action'])) 
{ 
$bah_cod_m1 = $_POST['bah_cod_m1'] ;
$bah_cod_m2 = $_POST['bah_cod_m2'] ;
$num_bah = $_POST['num_bah'] ;

//$query = "UPDATE bah SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah'  WHERE bah_cod_m = $bah_cod_m1";
//$q = $dbh->prepare($query);
//$q->execute();

$query = "UPDATE bee SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah'  WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE unknown_bee  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1395_1396  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1396_1397  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1397_1398  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1398_1399  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1399_1400  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();


$query = "UPDATE Garden SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Garden_prod SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1395_1396 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1395_1396 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1396_1397 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1397_1398 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1398_1399 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1399_1400 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Aquatic SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Greenhousn SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Greenhous_prod SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Vege SET bah_cod_m ='$bah_cod_m2' , no_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Vege_prod SET bah_cod_m ='$bah_cod_m2' , no_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Mushroom SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Mushroom_prod SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE malek SET m_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE m_cod_m = $bah_cod_m1 and id_ostan = '09'";
$q = $dbh->prepare($query);
$q->execute();

$dbh = null;

alert('تمام');
}
?>