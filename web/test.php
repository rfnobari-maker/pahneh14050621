<?php
require_once "lib/nusoap.php";
function getProd($username,$password) {
if ( $username == "poshtibani" and $password == "2@ej5D6*7" ) {
include('../login/config.php');
include('../event.php');
$query = "SELECT * from bah limit 0,10   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return join(",", array($row['id_ostan'],$row['id_city'],$row['id_mar'],$row['bah_cod_m'],$row['mor_cod_m'],$row['cod_mah'],bah_name($row['bah_cod_m'
])));
	}
	else {
            return "خطا";
	}
}
$server = new soap_server();
$server->register("getProd");
$server->service($HTTP_RAW_POST_DATA);