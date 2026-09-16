<?php

function send_changes_info($webservice_url, $username, $password, $national_id, $area_id, $year, $category, $change_type, $old_value, $new_value, $update_date, $msg_code, $message) {

    if (!class_exists('SoapClient')) {
        echo "SOAP extension is not installed.\n";
        return -1;
    }

    // --- تغییرات پیشنهادی برای غیرفعال کردن کش ---
    ini_set('soap.wsdl_cache_enabled', 0);
    ini_set('soap.wsdl_cache_ttl', 900);

    try {
        $client = new SoapClient($webservice_url, array(
            'connection_timeout' => 10,
            'trace'      => 1,
            'exceptions' => true, // پرتاب خطاها به عنوان exception
            'cache_wsdl' => WSDL_CACHE_NONE // غیرفعال کردن کش WSDL
        ));

        // --- بخش عیب یابی: نمایش تمام متدهای موجود ---
//        echo "Available functions:\n";
 //       echo "<pre>";
 //       print_r($client->__getFunctions());
 //       echo "</pre>";
        // -------------------------------------------

        $params = array(
            "userName" => $username,
            "Password" => $password,
            "NationalID" => $national_id,
            "AreaID" => $area_id,
            "year" => $year,
            "Category" => $category,
            "ChangeType" => $change_type,
            "OldValue" => $old_value,
            "NewValue" => $new_value,
            "UpdateDate" => $update_date,
            "MsgCode" => $msg_code,
            "Message" => $message
        );

        // مطمئن شوید که نام متد صحیح است
        $result = $client->SendChangesInfo($params);

        echo "Request:\n" . htmlspecialchars($client->__getLastRequest()) . "\n";
        echo "Response:\n" . htmlspecialchars($client->__getLastResponse()) . "\n";

        if (isset($result->SendChangesInfoResult->Result)) {
            return (int)$result->SendChangesInfoResult->Result;
        } else {
            echo "SOAP Success, but unexpected response structure for SendChangesInfo.\n";
            return 0;
        }

    } catch (SoapFault $e) {
        echo "SOAP Fault: " . $e->getMessage() . "\n";
        if (isset($client)) {
            echo "Last Request:\n" . htmlspecialchars($client->__getLastRequest()) . "\n";
        }
        return -1;
    } catch (Exception $e) {
        echo "General Error: " . $e->getMessage() . "\n";
        return -1;
    }
}

// --- مقادیر ورودی (بدون تغییر) ---
$webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
$username = "pahne";
$password = "4@pqL9gf";
$national_id = "1380066174";
$area_id = 13520311;
$year = 1404;
$category = 0;
$change_type = "ChangeProduct";
$old_value = "106";
$new_value = "107";
$update_date = "1404/10/27";
$msg_code = 0;
$message = "تصحیح نام محصول کشت شده 1";
$result = send_changes_info($webservice_url, $username, $password, $national_id, $area_id, $year, $category, $change_type, $old_value, $new_value, $update_date, $msg_code, $message);
echo "Result: " . $result . "\n";

?>
