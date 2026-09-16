<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT * from public_abadi4 where add_abadi2 != '' and add_abadi != add_abadi2    " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$add_abadi = $row['add_abadi'] ;
$add_abadi2 = $row['add_abadi2'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
//alert($add_abadi) ; 
//alert($add_abadi2) ; 

//$query="UPDATE bah SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));



//$query="UPDATE Agri1397_1398 SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Agri1398_1399 SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Agri1399_1400 SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Agri1400_1401 SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Agri1401_1402 SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Agri1402_1403 SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));


//$query="UPDATE Agri_prod1397_1398 SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Agri_prod1398_1399 SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Agri_prod1399_1400 SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Agri_prod1400_1401 SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Agri_prod1401_1402 SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Agri_prod1402_1403 SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Garden SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Garden_prod SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Aquatic SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Greenhous SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Greenhous_prod SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Greenprod_annual SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE ind_bah SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE ind_list_product SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE ind_unit SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Mushroom SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE Mushroom_prod SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

//$query="UPDATE bee SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
//$q=$dbh->prepare($query);
//$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

$query="UPDATE Vege SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
$q=$dbh->prepare($query);
$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));

$query="UPDATE Vege_prod SET add_abadi=?,id_ostan=?,id_city=? WHERE add_abadi=?";
$q=$dbh->prepare($query);
$q->execute(array($add_abadi,$id_ostan,$id_city,$add_abadi2));


}
alert('تمام');
?>