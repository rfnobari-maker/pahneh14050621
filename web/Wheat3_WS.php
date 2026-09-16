<?php
require_once "lib/nusoap.php";
$server = new soap_server();
function getList($username,$password,$date_s,$start) {
if ( $username == "poshtibani" and $password == "2@ej5D6*7"  and date("H") > 1 ) {
include('../login/config.php');
$start2 = ($start-1)*1000 ; 
$number_records = 1000 ;
$query = "select * from 
(
SELECT Agri_prod.id_ostan AS id_ostan, Agri_prod.bah_cod_m AS bah_cod_m, Agri_prod.date_s AS date_s, SUM( Agri_prod.mah_tolp ) AS mah_tolp, bah.no_bah AS no_bah, bah.last_name AS last_name, bah.name AS name, bah.co_name AS co_name, bah.sh_meli AS sh_meli
FROM Agri_prod
INNER JOIN bah ON Agri_prod.bah_cod_m = bah.bah_cod_m
AND Agri_prod.num_bah = bah.num_bah
WHERE z_sal =  '1396-1397'
AND cod_mah =  '102'
AND cod_qroup =  '1'
And bah.ok = '1'
 GROUP BY Agri_prod.bah_cod_m, Agri_prod.id_ostan,Agri_prod.num_bah
) test
where date_s='$date_s'
 order by id_ostan 
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
?>
<?php
$server->register("getList");
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '' ;
$server->service($HTTP_RAW_POST_DATA);
?>