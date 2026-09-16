<?php
//call library
require_once "lib/nusoap.php";
$URL       = "www.10.7.234.126/test97.php";
$namespace = $URL . '?wsdl';
//using soap_server to create server object
$server    = new soap_server;
$server->configureWSDL('hellotesting', $namespace);

//register a function that works on server
$server->register('hello');

// create the function
function hello($name)
{
    if (!$name) {
        return new soap_fault('Client', '', 'Put your name!');
    }
    $result = "Hello, " . $name;
    return $result;
}
// create HTTP listener
$server->service($HTTP_RAW_POST_DATA);
exit();
?>