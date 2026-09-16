<?php
// Enter these 3 parameters:
$webservice_url = "http://172.17.18.14:1080/GetPersonInfo/GetingPersonByNationalIdAndBirthDate.asmx?wsdl";
$username = "agriPahneh";
$password = "2@ej5D6*7";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Web Service</title>
</head>
<body>
<form action="" method="post">
	Birthdate: <input type="text" name="birthdate"><br>
	National ID: <input type="text" name="nationalid"><br>
	<input type="submit" name="go" value="Get Data!">
</form>
<?php
if (isset($_POST['go'])) {
	$client = new SoapClient($webservice_url);
	$res = $client->GetPersonInfo(array("username" => $username , "password" =>$password , "NationalId" =>$_POST['nationalid'], "BirthDate" =>$_POST['birthdate']));
	echo '<pre dir="ltr">';print_r($res);echo '</pre>';
	echo '<div dir="rtl">';
	echo 'نام: '.$res->GetPersonInfoResult->firstName;
	echo '<br>';
	echo 'نام خانوادگی: '.$res->GetPersonInfoResult->lastName;
	echo '<br>';
	echo 'نام پدر: '.$res->GetPersonInfoResult->fatherName;
	echo '</div>';
	echo 'پیام: '.$res->GetPersonInfoResult->identityInformationExceptionMessage;
	echo '</div>';

}
?>
</body>
</html>