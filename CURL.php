<?php
$url = 'https://api-semak.maj.ir/api/planLicenses/licenseValidation?docNum=686258543';
$collection_name = 'RapidAPI';
$request_url = $url . '/' . $collection_name;
$curl = curl_init($request_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
echo $response . PHP_EOL;
?>