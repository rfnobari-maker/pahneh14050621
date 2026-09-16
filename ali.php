
<?php
include 'nusoap_client.php';
$client = new nusoap_client('http://172.17.18.14/getPersonInfo/GetingPersonByNationalldAndBirthDate.asmx');
$err = $client->getError();
if($err)
{
    print_r($err);
    die;
}
echo $client->call(GetPersonInfo('agriPahneh','2@ej5D6*7','1380066174','13520312')); 
echo PersonInformation ; 
