<?php
function edit_180($date_s,$bah_cod_m)
{
include ('../login/config.php') ;
echo $query = "UPDATE `Agri_prod` SET `date_s` = '$date_s' WHERE z_sal = '1395-1396' and bah_cod_m = '$bah_cod_m' and cod_mah = '108'";
$q = $dbh->prepare($query);
$q->execute();
$dbh = null;
}
edit_180('1396/07/07','1739403495') ;
?>
