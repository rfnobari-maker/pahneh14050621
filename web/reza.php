<?php
require_once "lib/nusoap.php";
$server = new soap_server();
$server->configureWSDL("Corn_list_Service","urn:service1"); 
function getProd($mor_cod_m) {
include('../login/config.php');
include('../event.php');
$query = "SELECT * from bah where mor_cod_m = '$mor_cod_m' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetchAll();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['bah_cod_m'].''.$row['last_name'];
//return $row;
}
$server->register("getProd",array("name"=>"xsd:string"),array("sum"=>"xsd:string"));
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '' ;
$server->service($HTTP_RAW_POST_DATA);
