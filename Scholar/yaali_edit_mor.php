<?php
include ('event.php');
?>
<form name="test" method="post" > 
  <p>
  <input type="text" name="mor_cod_m" width="75px">
  : کد ملی مروج  </p>
  <p>
    <input type="submit" name="action" id="btn1" >
  </p>
</form>
<?php
if (isset($_POST['action'])) 
{ 
$mor_cod_m = $_POST['mor_cod_m'];
//alert($mor_cod_m) ; 
include ('login/config.php');
 $query = " SELECT add_abadi,mor_cod_m,id_mar,id_city,id_ostan  FROM list_abadi where mor_cod_m = '$mor_cod_m'  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

foreach($stmt as $row){

$add_abadi = $row['add_abadi'] ;
$mor_cod_m = $row['mor_cod_m'] ;
$id_mar    = $row['id_mar'] ;
$id_city   = $row['id_city'] ;
$id_ostan   = $row['id_ostan'] ;

//alert($add_abadi) ; 
include ('login/config.php');
$query = "UPDATE bah SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));


$query = "UPDATE Agri1397_1398 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1398_1399 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1399_1400 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1400_1401 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1402_1403 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1401_1402 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1402_1403 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));


$query = "UPDATE Agri_prod1397_1398 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1398_1399 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1399_1400 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1400_1401 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1401_1402 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1402_1403 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));


$query = "UPDATE Garden SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Garden_prod SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Greenhous SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Greenhous_prod SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Greenprod_annual SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));


$query = "UPDATE Aquatic SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE bee SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE unknown_bee SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Vege SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Vege_prod SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Aquatic SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Mushroom SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Mushroom_prod SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));
$dbh = null ; 
}
alert('تمام');
}
?>