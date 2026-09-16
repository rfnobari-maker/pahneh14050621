<?php
// تابع برای فراخوانی وب‌سرویس و بازگشت اطلاعات به صورت آرایه
function getUnitDetails($partIDCode) {
    $userName = "pahneadmin";
    $password = "pkg@1876";

    $url = "http://172.17.18.41/agriwindows/unitservicesVer3.asmx";
    $headers = array(
        "Content-Type: text/xml; charset=utf-8",
        "SOAPAction: \"http://tempuri.org/WS_G_1_4\""
    );

    $soapRequest = <<<EOD
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">
   <soapenv:Header/>
   <soapenv:Body>
      <tem:WS_G_1_4>
         <tem:userName>{$userName}</tem:userName>
         <tem:Password>{$password}</tem:Password>
         <tem:PartIDcode_>{$partIDCode}</tem:PartIDcode_>
      </tem:WS_G_1_4>
   </soapenv:Body>
</soapenv:Envelope>
EOD;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return array('error' => "خطا در اتصال: " . $error_msg);
    }

    curl_close($ch);

    $xml = simplexml_load_string($response);
    if ($xml === false) {
        return array('error' => "خطا در تجزیه پاسخ XML.");
    }

    $xml->registerXPathNamespace('ns', 'http://tempuri.org/');
    $result = $xml->xpath('//ns:ListUnitProperty/ns:UnitProperty');

    if (!$result) {
        return array('error' => "هیچ اطلاعاتی یافت نشد.");
    }

    $unitProperty = $result[0];
    $data = array(
        'PartIdCode' => (string)$unitProperty->PartIdCode,
        'EpidemiologicCode' => (string)$unitProperty->EpidemiologicCode,
        'UnitPostalCode' => (string)$unitProperty->UnitPostalCode,
        'Ostan' => (string)$unitProperty->Ostan,
        'Shahrestan' => (string)$unitProperty->Shahrestan,
        'PostalAddress' => (string)$unitProperty->PostalAddress,
        'DetailAddress' => (string)$unitProperty->DetailAddress,
        'Longitude' => (string)$unitProperty->Longitude,
        'Latitude'   => (string)$unitProperty->Latitude,
        'UnitName' => (string)$unitProperty->UnitName,
        'UnitGroup' => (int)$unitProperty->UnitGroup,
        'UnitType' => (int)$unitProperty->UnitType,
        'LicenseStatus' => (int)$unitProperty->LicenseStatus,
        'OwnerNationalcode' => (string)$unitProperty->OwnerNationalcode,
        'OwnerName' => (string)$unitProperty->OwnerName,
        'OwnerFamily' => (string)$unitProperty->OwnerFamily,
        'OwnerMobile' => (string)$unitProperty->OwnerMobile,
        'RentStatus' => (int)$unitProperty->RentStatus,
        'Active' => (string)$unitProperty->Active,
        'EntryDate' => (string)$unitProperty->EntryDate,
        'Capacities' => array()
    );

    $capacities = $unitProperty->PartCapacityInfo;
    if ($capacities) {
        foreach ($capacities->UnitCapacityInfo as $capacity) {
            $data['Capacities'][] = array(
                'ActivityTypeName' => (string)$capacity->ActivityTypeName,
                'ActivityTypeCode' => (string)$capacity->ActivityTypeCode,
                'CapacityName' => (string)$capacity->CapacityName,
                'CapacityCode' => (string)$capacity->CapacityCode,
                'CapacityUnitName' => (string)$capacity->CapacityUnitName,			   
                'CapacityName' => (string)$capacity->CapacityName,
                'Amount' => (string)$capacity->Amount
            );
        }
    }

    return $data;
}
?>
