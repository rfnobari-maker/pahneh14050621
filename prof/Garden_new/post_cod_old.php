<?php
if($_POST['cod_m'])
{
$webservice_url = "http://172.17.18.40/GetPostinfo/getPostalInfo.asmx?wsdl";
$username = "poudadmin";
$password = "6ae390lm";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
<?php
if ($_POST['cod_m']!='') {
	$client = new SoapClient($webservice_url);
	$res = $client->GetAddressByPostalCode(array(
	 "username"   => $username ,
	 "password"   => $password , 
	 "postalcode" => $_POST['cod_m']));
	if (isset($_POST['cod_m'])) {
	if ($res->GetAddressByPostalCodeResult->ErrorCode != 51 or $res->GetAddressByPostalCodeResult->TownShip !='') { ;
    $Province    = $res->GetAddressByPostalCodeResult->Province;
    $TownShip    = $res->GetAddressByPostalCodeResult->TownShip;
	$village     = $res->GetAddressByPostalCodeResult->Village;
    $SubLocality = $res->GetAddressByPostalCodeResult->SubLocality;
	$Street      = $res->GetAddressByPostalCodeResult->Street;
    $Street2     = $res->GetAddressByPostalCodeResult->Street2;
	$HouseNumber = $res->GetAddressByPostalCodeResult->HouseNumber;
	$Floor       = $res->GetAddressByPostalCodeResult->Floor;
	$BuildingName= $res->GetAddressByPostalCodeResult->BuildingName;
	$Description = $res->GetAddressByPostalCodeResult->Description;
	$address = $Province.' '.$TownShip.' '.$village.' '.$SubLocality.' '.$Street.' '.$Street2.' '.
	$HouseNumber.' '.$Floor.' '.$BuildingName.' '.$Description;
  if ($address == '      0   ') $address = '' ; 
     }
	else 
	{
		 $address = '' ; 
	}
	echo '</div>';
}
}
?>
<script>
document.getElementById('add').value = "<?php echo $address?>";
</script>
<?php
}
?>
</body>
</html>