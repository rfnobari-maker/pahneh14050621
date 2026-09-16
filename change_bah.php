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
    <input type="submit" name="action" id="btn1" >
  </p>
</form>
<?php
if (isset($_POST['action'])) 
{ 
$bah_cod_m1 = $_POST['bah_cod_m1'] ;
$bah_cod_m2 = $_POST['bah_cod_m2'] ;
$query = "UPDATE bah   t1
INNER JOIN Agri        t2 ON t2.bah_cod_m = t1.bah_cod_m
INNER JOIN Agri_prod   t3 ON t2.bah_cod_m = t3.bah_cod_m
INNER JOIN Garden      t4 ON t2.bah_cod_m = t4.bah_cod_m
INNER JOIN Garden_prod t5 ON t2.bah_cod_m = t5.bah_cod_m
SET t1.bah_cod_m   = '$bah_cod_m2',
    t1.ok          = '2',
    t2.bah_cod_m   = '$bah_cod_m2',
    t3.bah_cod_m   = '$bah_cod_m2',
    t4.bah_cod_m   = '$bah_cod_m2',
    t5.bah_cod_m   = '$bah_cod_m2'
WHERE t1.bah_cod_m = '$bah_cod_m1';";
$q = $dbh->prepare($query);
$q->execute();

$dbh = null;

alert('تمام');
}
?>