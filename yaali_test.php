<?php
include ('login/config.php');
include ('event.php');

$query = "UPDATE Garden_prod SET mah_tolp = 0 ,  mah_tol = 0 where cod_mah = '299007'"; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Garden_prod SET tree_b = 0 ,  tree_gb = 0 where 
cod_mah = '206024' or 
cod_mah = '299003' or 
cod_mah = '208063' or  
cod_mah = '299006' or 
cod_mah = '208999' or 
cod_mah = '208034' or 
cod_mah = '208037' or 
cod_mah = '208046' or 
cod_mah = '208052' or 
cod_mah = '208053' or 
cod_mah = '208108' or 
cod_mah = '203003' or 
cod_mah = '205002' or 
cod_mah = '208092' or 
cod_mah = '208098' 
"; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$dbh = null ; 
alert('تمام');
?>