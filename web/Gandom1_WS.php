<?php
require_once "lib/nusoap.php";
$server = new soap_server();
//$server->configureWSDL("Corn_list_Service","urn:service1"); 
function getProd($username,$password,$id_ostan,$no_bah,$meli) {
if ( $username == "user_GTC" and $password == "Sa#912E27@511" ) {
include('../login/config.php');
if ($no_bah == '1'){  $v_meli = 1                      ; $v_bah_cod_m = "bah_cod_m = '$meli'" ;}
if ($no_bah == '2'){  $v_meli = "bah.sh_meli='$meli'"  ;  $v_bah_cod_m  = 1 ; }
 $query = "SELECT 
bah.`no_bah` ,
Agri_prod.`num_bah` ,
Agri_prod.`bah_cod_m` ,
bah.`last_name` ,
bah.`name` ,
bah.`co_name` ,
bah.`sh_meli` ,
sum(Agri_prod.mah_tolp) as  mah_tolp
FROM (
SELECT *
FROM Agri_prod
WHERE `z_sal` = '1396-1397'
AND `cod_mah` = '102'
AND `cod_qroup` = '1'
and `id_ostan`  = '$id_ostan'
and $v_bah_cod_m
)Agri_prod
INNER JOIN bah ON Agri_prod.bah_cod_m = bah.bah_cod_m
AND Agri_prod.num_bah = bah.num_bah
where bah.no_bah = '$no_bah'  and $v_meli and bah.ok = '1'
GROUP BY Agri_prod.bah_cod_m, Agri_prod.`id_ostan`,Agri_prod.`num_bah`"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetchAll();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($no_bah == '2') {  $row['bah_cod_m'] = $row['sh_meli'] ;  $row['name'] = '' ;  $row['last_name'] = '' ;  }
return $row;
	}
	else {
            return "خطا";
	}
}
$server->register("getProd");
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '' ;
$server->service($HTTP_RAW_POST_DATA);
?>