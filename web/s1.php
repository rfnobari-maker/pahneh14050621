<?php
require_once "lib/nusoap.php";
$client = new nusoap_client("http://10.7.234.61/web/PahnehWebService.php");
$username = "poshtibani";
$password = "2@ej5D6*7";
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre class = 'brush: php' >" . $error . "</pre>";
}
$result = $client->call("getProd", array("username" => $username , "password" =>$password,"date_s" => '1396/07/1' ,"start"=>0,"number_records" => 10));
if ($client->fault) {
    echo "<h2>Fault</h2><pre class = 'brush: php' >";
    print_r($result);
    echo "</pre>";
}
else {
    $error = $client->getError();
    if ($error) {
        echo "<h2>Error</h2><pre class = 'brush: php'>" . $error . "</pre>";
    }
    else {
        echo "<h2>خروجی</h2><pre class = 'brush: php'>";
        echo $result;
        echo "</pre>";
    }
}