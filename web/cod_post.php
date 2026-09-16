<?php
// Enter these 3 parameters:
$webservice_url = "http://172.17.18.40/GetPostinfo/getPostalInfo.asmx?wsdl";
//$webservice_url = "http://10.7.234.49:/GetPersonInfo/GetingPersonByNationalIdAndBirthDate.asmx?wsdl";
$username = "poudadmin";
$password = "6ae390lm";
//$username = "agriPahneh";
//$password = "2@ej5D6*7";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Web Service</title>
</head>
<body>
<div  align="center" style="margin-top:100px; font-family:tahoma; font-size:16px">
<form action="" method="post">
	<p><br>
	  <br><input type="text" name="postalcode"> 
    : کد پستی<br>
    <br>
    <input type="submit" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px" value="جستجو">
</p>
</form>
<?php
if ($_POST['postalcode']!='') {
	$client = new SoapClient($webservice_url);
	$res = $client->GetAddressByPostalCode(array(
	 "username"   => $username ,
	 "password"   => $password , 
	 "postalcode" => $_POST['postalcode']));
	//echo '<pre dir="ltr">';print_r($res);echo '</pre>';
	if (isset($_POST['postalcode'])) {
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
//	echo 'استان:  '.$Province;
//	echo '<br>';
//	echo 'شهرستان:'.$TownShip;
//	echo '<br>';
//  if ($village != '')  { echo 'روستای:'. $village ; 	echo '<br>' ; }
//	echo 'محله:'. $SubLocality ; 
//	echo '<br>';
//	echo 'خیابان:  '.$Street;
//	echo '<br>';
//	echo 'خیابان 2: '.$Street2;
//	echo '<br>';
//	echo 'پلاک: '  .$HouseNumber;
//	echo '<br>';
//	echo 'طبقه: '.$Floor;
//	echo '<br>';
//	echo 'نام ساختمان: '.$BuildingName;
//	echo '<br>';
//	echo 'توضیح: '.$Description;
//	echo '<br>';
	$address = $Province.','.$TownShip.','.$village.','.$SubLocality.','.$Street.','.$Street2.','.
	$HouseNumber.'-'.$Floor.'-'.$BuildingName.'-'.$Description;
     }
	else 
	{
	//	echo 'خطا: '.$res->GetAddressByPostalCodeResult->ErrorMessage;
		 $address = '' ; 
	}
	echo '</div>';
}
}
echo $address ; 
?>
</div>
</body>
</html>