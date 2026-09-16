<?php
function webservice($birthDate, $nin) {
    $username = 'ajix_poudadmin';
    $password = '6ae390lm';
    
    $data = array(
        "birthDate" => $birthDate,
        "nin" => $nin 
    );

    $jsonData = json_encode($data);
    $url = "https://sr-ajix.maj.ir/Services/GSBSabteAhvalGetEstelam3";
    
    $ch = curl_init($url);
    $options = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
            'Authorization: Basic ' . base64_encode("$username:$password")
        ),
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
    );

    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        return array('error' => 'خطا در اتصال: ' . curl_error($ch));
    }
    
    curl_close($ch);
    
    $responseData = json_decode($response, true);
    
    // بررسی ساختار پاسخ
    if (isset($responseData['result']['data']['getEstelam3Response']['return'])) {
        $return = $responseData['result']['data']['getEstelam3Response']['return'];
    } elseif (isset($responseData['result']['getEstelam3Response']['return'])) {
        $return = $responseData['result']['getEstelam3Response']['return'];
    } elseif (isset($responseData['getEstelam3Response']['return'])) {
        $return = $responseData['getEstelam3Response']['return'];
    } else {
        return array('error' => 'پاسخی از سرویس دریافت نشد');
    }
    
    // استخراج deathStatus
    $deathStatus = null;
    if (isset($return['deathStatus'])) {
        if (is_array($return['deathStatus'])) {
            $deathStatus = isset($return['deathStatus'][0]) ? $return['deathStatus'][0] : null;
        } else {
            $deathStatus = $return['deathStatus'];
        }
    }
    
    // استخراج اطلاعات
    $output = array(
        'name' => isset($return['name']) ? base64_decode($return['name']) : '',
        'family' => isset($return['family']) ? base64_decode($return['family']) : '',
        'fatherName' => isset($return['fatherName']) ? base64_decode($return['fatherName']) : '',
        'birthDate' => isset($return['birthDate']) ? $return['birthDate'] : '',
        'nin' => isset($return['nin']) ? $return['nin'] : '',
        'shenasnameNo' => isset($return['shenasnameNo']) ? $return['shenasnameNo'] : '',
        'gender' => isset($return['gender']) ? $return['gender'] : '',
        'officeCode' => isset($return['officeCode']) ? $return['officeCode'] : '',
        'bookNo' => isset($return['bookNo']) ? $return['bookNo'] : '',
        'bookRow' => isset($return['bookRow']) ? $return['bookRow'] : '',
        'deathStatus' => $deathStatus,
        'message' => isset($return['Message']) ? $return['Message'] : (isset($return['message']) ? $return['message'] : ''),
        'exceptionMessage' => isset($return['exceptionMessage']) ? $return['exceptionMessage'] : ''
    );
    
    return $output;
}
?>