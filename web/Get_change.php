<?php
function check_payesh($id, $type, $year)
{
    $webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
    $Username = "pahne";
    $Password = "4@pqL9gf";

    $chech_result = -1; 
    
    if (!class_exists('SoapClient')) {
        error_log("SOAP extension is not installed.");
        return $chech_result;
    }

    try {
        $client = new SoapClient($webservice_url, array(
            'connection_timeout' => 5,
            'trace' => 1 
        ));

        $res = $client->CheckEditorDeletePermission(array(
            "Username" => $Username,
            "Password" => $Password,
            "type" => 0,
            "year" => 1404,
            "AreaID" => 2669779
        ));

        if (isset($res->CheckEditorDeletePermissionResult->EditPermission)) {
            $chech_result = (int)$res->CheckEditorDeletePermissionResult->EditPermission;
        } else {
            $chech_result = 0;
            error_log("SOAP Success, but unexpected response structure for CheckEditorDeletePermission.");
        }

    } catch (SoapFault $e) {
        error_log("SOAP Fault: " . $e->getMessage() . " | Request: " . (isset($client) ? $client->__getLastRequest() : 'N/A'));
        $chech_result = -1; 
    } catch (Exception $e) {
        error_log("General Error: " . $e->getMessage());
        $chech_result = -1;
    }
    return $chech_result;
}
echo check_payesh()
?>