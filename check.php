<?php
function check_product($id)
{
    $webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
    $Username = "test";
    $Password = "test";
    $type = 0;
    $year = 1404;

    $client = new SoapClient($webservice_url);
    $res = $client->CheckEditorDeletePermission(array(
        "Username" => $Username,
        "Password" => $Password,
        "type" => $type,
        "year" => $year,
        "AreaID" => $id
    ));
    
    // Instead of getting a specific property, return the whole object
    return $res;
}

// Call the function and get the full object
$result_object = check_product(17375);

// Use print_r() or var_dump() to see all the data
print_r($result_object);
?>