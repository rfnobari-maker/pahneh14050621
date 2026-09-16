<?php

function send_changes_info($webservice_url, $username, $password, $national_id, $area_id, $year, $category, $change_type, $old_value, $new_value, $update_date, $msg_code, $message) {

    if (!class_exists('SoapClient')) {
        echo "SOAP extension is not installed.\n";
        return -1;
    }

    ini_set('soap.wsdl_cache_enabled', 0);
    ini_set('soap.wsdl_cache_ttl', 900);

    try {
        $client = new SoapClient($webservice_url, array(
            'connection_timeout' => 10,
            'trace'      => 1,
            'exceptions' => true,
            'cache_wsdl' => WSDL_CACHE_NONE
        ));

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

        $result = $client->SendChangesInfo($params);

        echo "Request:\n" . htmlspecialchars($client->__getLastRequest()) . "\n";
        echo "Response:\n" . htmlspecialchars($client->__getLastResponse()) . "\n";

        // *** اصلاح ساختار بررسی نتیجه ***
        if (isset($result->SendChangesInfoResult)) {
            $response_value = (string)$result->SendChangesInfoResult;
            
            if ($response_value === 'SuccessFul') {
                echo "اطلاعات ارسال شد\n"; // پیام موفقیت داخلی
                return 1; // بازگشت 1
            } else {
                echo "SOAP Success, but result value is not 'SuccessFul'. Value received: " . $response_value . "\n";
                return 0;
            }
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

// --- مقادیر ورودی ---
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

// فراخوانی تابع
$result_code = send_changes_info($webservice_url, $username, $password, $national_id, $area_id, $year, $category, $change_type, $old_value, $new_value, $update_date, $msg_code, $message);

// نمایش نهایی Result
echo "Result: " . $result_code . "\n";

// *** اطمینان حاصل کنید که هیچ کد PHP اضافی بعد از این خط وجود ندارد ***

?>
