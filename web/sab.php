<?php
// declare(strict_types=1); در PHP 5.3.3 پشتیبانی نمی شود و حذف می گردد.

function webservice($birthDate, $nin) {
    // اطلاعات احراز هویت
    $username = 'ajix_poudadmin';
    $password = '6ae390lm';
    
    // اطلاعات ورودی
    $data = array(
        "birthDate" => $birthDate,
        "nin" => $nin 
    );

    $jsonData = json_encode($data);
    $url = "https://sr-ajix.maj.ir/Services/GSBSabteAhvalGetEstelam3";
    
    $ch = curl_init($url);
    
    // آرایه‌ها در PHP 5.3.3 باید با 'array(...)' تعریف شوند، نه '[]'.
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
        echo 'Error:' . curl_error($ch);
        curl_close($ch);
        return array();
    }

    curl_close($ch);

    $responseObj = json_decode($response); 
    
    // --- جایگزینی عملگر Null-safe (PHP 8.0+) با بررسی های isset ---
    
    $returnData = null;
    if (isset($responseObj->result) && 
        isset($responseObj->result->data) && 
        isset($responseObj->result->data->getEstelam3Response) && 
        isset($responseObj->result->data->getEstelam3Response->return)
    ) {
        $returnData = $responseObj->result->data->getEstelam3Response->return;
    }

    if (!$returnData) {
        return array(
            'name' => null, 'family' => null, 'fatherName' => null,
            'birthDate' => null, 'nin' => null, 'shenasnameNo' => null,
            'gender' => null, 'deathStatus' => null, 'message' => 'No Data'
        );
    }

    // جایگزینی عملگر Elvis (??) که در PHP 7 به بعد معرفی شد.
    $deathStatusRaw = isset($returnData->deathStatus) ? $returnData->deathStatus : null;
    
    // بررسی اینکه آیا $deathStatusRaw یک آرایه است
    if (is_array($deathStatusRaw)) {
        // استفاده از isset برای جلوگیری از خطای اندیس نامعتبر
        $deathStatusValue = isset($deathStatusRaw[0]) ? $deathStatusRaw[0] : null;
    } else {
        $deathStatusValue = $deathStatusRaw;
    }

    // استفاده از isset برای بررسی وجود خصوصیت قبل از دسترسی
    return array(
        'name' => isset($returnData->name) ? base64_decode($returnData->name) : null,
        'family' => isset($returnData->family) ? base64_decode($returnData->family) : null,
        'fatherName' => isset($returnData->fatherName) ? base64_decode($returnData->fatherName) : null,
        'birthDate' => isset($returnData->birthDate) ? $returnData->birthDate : null,
        'nin' => isset($returnData->nin) ? $returnData->nin : null,
        'shenasnameNo' => isset($returnData->shenasnameNo) ? $returnData->shenasnameNo : null,
        'gender' => isset($returnData->gender) ? $returnData->gender : null,
        'deathStatus' => $deathStatusValue,
        'message' => isset($returnData->Message) ? $returnData->Message : ''
    );
}
?>