<?php
require_once "lib/nusoap.php";
$param = '1376869411';
$client = new nusoap_client('http://10.7.234.126/web/reza.php?wsdl,true') ;
$respans = $client -> call("getProd",array("name" => $param)) ;
echo $respans ;