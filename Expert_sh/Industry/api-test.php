<?php

$identCode = '500931808';
$response = json_decode(file_get_contents('https://api-semak.maj.ir/api/planLicenses/licenseValidation?docNum='.$identCode), true);

echo $no_bah       =  $response['user']['userType'] . "\n"; 
echo $bah_name     =  $response['user']['firstName'] . "\n"; 
echo $last_name    =  $response['user']['name'] . "\n"; 
echo $NationalCode =  $response['user']['nationalCode'] . "\n";
?>
<br><br>Complete response is this : 
<pre>
<?php
var_dump($response);