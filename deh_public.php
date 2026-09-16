<?php
include('login/config.php');
$query = "SELECT add_abadi,id_deh from public_abadi1";
$stmt = $dbh->prepare($query);
$stmt->execute();
 foreach($stmt as $row){
$add_abadi = $row['add_abadi'] .'<p>'; 
echo $id_deh = substr($add_abadi,6,4) ;
echo '<p>';
$query2 = "UPDATE public_abadi1 
        SET id_deh=?  where add_abadi = ?";
$q2 = $dbh->prepare($query2);
$q2->execute(array($id_deh,$add_abadi));
 }
?>