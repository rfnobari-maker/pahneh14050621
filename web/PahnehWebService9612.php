<?php
require_once "lib/nusoap.php";
$server = new soap_server();
//$server->configureWSDL("Corn_list_Service","urn:service1"); 
function getProd($username,$password,$date_s,$start,$number_records) {
if ( $username == "poshtibani" and $password == "2@ej5D6*7" ) {
include('../login/config.php');
$query = "SELECT
Agri_prod.`date_s`,Agri_prod.`id_ostan`,
Agri_prod.bah_cod_m,
bah.last_name,
bah.name,
Agri_prod.`num_bah`,
SUM(Agri_prod.`mah_tolp`) as mah_tolp
FROM Agri_prod
INNER JOIN bah ON Agri_prod.bah_cod_m=bah.bah_cod_m and Agri_prod.num_bah=bah.num_bah
where Agri_prod.`z_sal` ='1396-1397' and Agri_prod.`cod_mah` = '102' and Agri_prod.`cod_qroup` = '1' and   Agri_prod.date_s > '$date_s'  group by Agri_prod.bah_cod_m,Agri_prod.`id_ostan`,Agri_prod.`num_bah` limit $start,$number_records
;"; 
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

