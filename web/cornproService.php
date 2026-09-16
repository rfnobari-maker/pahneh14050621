<?php
require_once "lib/nusoap.php";
$server = new soap_server();
//$server->configureWSDL("Corn_list_Service","urn:service1"); 
function getProd($username,$password,$date_s) {
if ( $username == "poshtibani" and $password == "2@ej5D6*7" ) {
include('../login/config.php');
$query = "SELECT
Agri_prod.`date_s`,
Agri_prod.`id_ostan`,
Agri_prod.`id_city`,
Agri_prod.`id_mar`,
Agri_prod.`add_abadi`,
Agri_prod.`add_city`,
Agri_prod.bah_cod_m,
bah.last_name,
bah.name,
Agri_prod.`num_bah`,
Agri_prod.`zer_kesht_a`/10000+`zer_kesht_b`/10000 as zer_kesht,
Agri_prod.`mah_tolp`,
bah.bank_account,
Agri_prod.`mor_cod_m`
FROM Agri_prod
INNER JOIN bah ON Agri_prod.bah_cod_m=bah.bah_cod_m
where Agri_prod.`z_sal` ='1395-1396' and Agri_prod.`cod_mah` = '108' and Agri_prod.`cod_qroup` = '1' and Agri_prod.`zer_kesht_a`+Agri_prod.`zer_kesht_b` > 0 and Agri_prod.`mah_tolp`>0 and Agri_prod.date_s = '$date_s'  order by Agri_prod.date_s ;"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetchAll();
return $row;
	}
	else {
            return "خطا";
	}
}
$server->register("getProd");
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '' ;
$server->service($HTTP_RAW_POST_DATA);
