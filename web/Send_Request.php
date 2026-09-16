<?php

function send_changes_info($national_id, $area_id, $year, $category, $change_type, $old_value, $new_value, $update_date, $msg_code, $message) {
    
    // --- انتقال مقادیر ثابت از test_send_request.php ---
    $webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
    $username = "pahne";
    $password = "4@pqL9gf";
    // ---------------------------------------------------

    if (!class_exists('SoapClient')) {
        echo "SOAP extension is not installed.\n";
        return -1;
    }

    // --- تغییرات پیشنهادی برای غیرفعال کردن کش ---
    ini_set('soap.wsdl_cache_enabled', 0);
    ini_set('soap.wsdl_ttl', 900);

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

        $result = $client->SendChangesInfo($params);
        if (isset($result->SendChangesInfoResult)) {
            $response_value = (string)$result->SendChangesInfoResult;

            if ($response_value === 'SuccessFul') {
                return 1; // بازگشت مقدار 1 برای نمایش نهایی
            } else {
                // اگر پاسخ رشته‌ای غیر از "SuccessFul" بود
                // echo "SOAP Success, but received: " . $response_value . "\n"; // حذف شد
                return 0;
            }
        } else {
            // اگر ساختار شیء پاسخدهی مورد انتظار نبود
            // echo "SOAP Success, but unexpected response structure for SendChangesInfo.\n"; // حذف شد
            return 0;
        }

    } catch (SoapFault $e) {
        return -1;
    } catch (Exception $e) {
        return -1;
    }
}
?>
