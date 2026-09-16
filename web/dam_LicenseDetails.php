<?php
function getLicenseDetails($docNum,$bah_cod_m) {
    $apiUrl = 'https://api-semak.maj.ir/api/planLicenses/licenseValidation?docNum=' . $docNum;
	  // تنظیمات context
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'GET',
            'timeout' => 5, // حداکثر زمان دریافت پاسخ به ثانیه
        )
    ));

    // ارسال درخواست
    $response = @file_get_contents($apiUrl, false, $context);

    if ($response === false) {
        return array('error' => 'خطا در دریافت پاسخ از API یا اتمام زمان.');
    }
	
    $response = json_decode(file_get_contents($apiUrl), true);

    if (!$response) {
        return array('error' => 'شماره مجوز یافت نشد.');
    }

    $plan_id = isset($response['plan']['planTypeId']) ? $response['plan']['planTypeId'] : null;
    $resultCode = $response['resultCode'] ; 
	if($response['resultCode'] != 1 ) {
        return array('error' => 'مجوز وارد شده معتبر نیست.');
    }
	
    if ($plan_id > 0 && $plan_id != 1 && $plan_id != 10 && $plan_id != 11) {
        return array('error' => 'مجوز مربوط به دامداری نیست.');
    }

    $nationalCode = $response['user']['nationalCode'] ; 
if ($nationalCode != $bah_cod_m ) {
        return array('error' => 'مجوز مربوط به این دامدار نمیباشد.');
    }
	
    $data = array(
        'plan_id' => isset($response['plan']['planTypeId']) ? $response['plan']['planTypeId'] : '-',
        'planTypeName' => isset($response['plan']['planTypeName']) ? $response['plan']['planTypeName'] : '-',
        'productName' => isset($response['plan']['productInfo'][0]['name']) ? $response['plan']['productInfo'][0]['name'] : '-',
        'isikCode' => isset($response['plan']['productInfo'][0]['isikCode']) ? $response['plan']['productInfo'][0]['isikCode'] : '-',

    );

    $cod_p = '-';
    $addres = '-';
    switch ($plan_id) {
        case 1:
            $cod_p = isset($response['plan']['technicalInfo'][12]['value']) ? $response['plan']['technicalInfo'][12]['value'] : '-';
            $addres = isset($response['plan']['technicalInfo'][23]['value']) ? $response['plan']['technicalInfo'][23]['value'] : '-';
            break;
        case 10:
            $addres = isset($response['plan']['technicalInfo'][29]['value']) ? $response['plan']['technicalInfo'][29]['value'] : '-';
            break;
        case 11:
            $cod_p = isset($response['plan']['technicalInfo'][10]['value']) ? $response['plan']['technicalInfo'][10]['value'] : '-';
            $addres = isset($response['plan']['technicalInfo'][23]['value']) ? $response['plan']['technicalInfo'][23]['value'] : '-';
            break;
    }
    $data['postalCode'] = $cod_p;
    $data['address'] = $addres;

    $validityDate = isset($response['planLicense']['validityDate']) ? $response['planLicense']['validityDate'] : '';
    if ($validityDate) {
        $data['validityDate'] = substr($validityDate, 0, 4) . '/' . substr($validityDate, 4, 2) . '/' . substr($validityDate, 6, 2);
    } else {
        $data['validityDate'] = '-';
    }

    $z_kol = '-';
    if ($plan_id == 10 || $plan_id == 11) {
        $z_kol = isset($response['plan']['productInfo'][0]['detail'][1]['value']) ? $response['plan']['productInfo'][0]['detail'][1]['value'] : '-';
    } elseif ($plan_id == 1) {
        $z_kol = isset($response['plan']['productInfo'][0]['detail'][0]['value']) ? $response['plan']['productInfo'][0]['detail'][0]['value'] : '-';
    }
    $data['totalCapacity'] = $z_kol;

    $data['licenseType'] = isset($response['planLicense']['licenseName']) ? $response['planLicense']['licenseName'] : '-';

    return $data;
}

?>