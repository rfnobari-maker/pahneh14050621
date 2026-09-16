<?php
 $identCode = '500931808';
 $response = json_decode(file_get_contents('https://api-semak.maj.ir/api/planLicenses/licenseValidation?docNum='.$identCode), true);
//print_r($response) ; 
echo $no_bah       =  $response['user']['userType'] ; 
  ?>