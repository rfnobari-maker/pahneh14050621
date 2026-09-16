<?php
include ('login/config.php');
include ('event.php');
$query = "SELECT id,m_zamin FROM Agri1401_1402  WHERE s_ayesh > m_zamin  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
//$count = $stmt -> rowCount();
foreach($stmt as $row){
$Agri_id = $row['id'] ;
$m_zamin = $row['m_zamin'] ;

//alert($bah_cod_m);
$query2 = "SELECT SUM(mah_mas) as mah_mas FROM Agri_prod1401_1402 WHERE Agri_id = $Agri_id"; 
$stmt = $dbh->prepare($query2);
$stmt->execute();
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$mah_mas = $row2['mah_mas'] ;
$s_ayesh = $m_zamin - $mah_mas ;

//alert($add_abadi);
$query = "UPDATE Agri1401_1402 SET s_ayesh=?  where id = ?  ";
$q = $dbh->prepare($query);
$q->execute(array($s_ayesh,$Agri_id));
}
alert('تمام');
?>