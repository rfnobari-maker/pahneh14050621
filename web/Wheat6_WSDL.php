<?php
require_once "lib/nusoap.php";
function getList($username,$password,$date_s,$start) {
if ( $username == "poshtibani" and $password == "2@ej5D6*7"  and date("H") > 21 ) {
include('../login/config.php');
$start2 = ($start-1)*1000 ; 
$number_records = 1000 ;
$query = "select * from 
(
SELECT 
Agri_prod.id_ostan AS id_ostan,
Agri_prod.id_city AS id_city,
Agri_prod.bah_cod_m AS bah_cod_m,
Agri_prod.date_s AS date_s,
SUM( Agri_prod.zer_kesht_a ) AS zer_kesht,
SUM( Agri_prod.mah_tolp ) AS mah_tolp,
bah.no_bah AS no_bah,
bah.last_name AS last_name,
bah.name AS name, 
bah.fname AS fname, 
bah.co_name AS co_name,
bah.sh_meli AS sh_meli
FROM Agri_prod
INNER JOIN bah ON Agri_prod.bah_cod_m = bah.bah_cod_m
AND Agri_prod.num_bah = bah.num_bah
WHERE z_sal =  '1396-1397'
AND cod_mah =  '102'
AND cod_qroup =  '1'
AND zer_kesht_a > 0 
AND mah_tolp > 0
And bah.ok = '1'
 GROUP BY Agri_prod.bah_cod_m,Agri_prod.id_ostan,Agri_prod.id_ostan,Agri_prod.id_city,Agri_prod.num_bah
) test
where date_s='$date_s'
 order by id_ostan,id_city 
 limit $start2,$number_records;"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetchAll();
return $row;
	}
	else {
            return "error";
	}
}

$server = new soap_server();
$server->configureWSDL("productlist", "urn:productlist");

$server->register("getList",
    array(
    	"username" => "xsd:string",
    	"password" => "xsd:string",
    	"date_s" => "xsd:string",
    	"start" => "xsd:int"
	),
    array("return" => "xsd:string"),
    "urn:productlist",
    "urn:productlist#getList",
    "rpc",
    "encoded",
    "Get a listing of products");
$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
$server->service($POST_DATA);            
exit();
?>