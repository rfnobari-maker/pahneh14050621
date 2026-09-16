<?php
include ('login/config.php');
include ('event.php');

//$query = "UPDATE `list_abadi` SET `bah_cod_m`='4609420783' where `bah_cod_m`='9999'";
//$query = "UPDATE `Vege` SET `confi` = '1' , `confi2` = '1' WHERE `id_mar` = '1315' and z_sal = '1401-1402' " ; 
$query = "UPDATE `Agri_prod1398_1399` SET `bah_cod_m` = '4620688215' , num_bah = '2' where `bah_cod_m` = '4621445855' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();

alert('تمام');
?>