<?php
// Enter these 3 parameters:
$webservice_url = "http://eagri.maj.ir/Application/WebServices/Get_License_Info_BY_IdentCode_And_NationalCode_WS.asmx";
$username = "sanayelicense";
$password = "License123!@#";
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
	<p>
	  <input type="text" name="identCode" value="288585956"> 
	  : شماره پروانه  <br>
	  <br><input type="text" name="nationalCode" value="3521067718"> 
    : کد ملی <br>
    <br>
    <input type="submit" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px" value="جستجو">
</p>
</form>
<?php
if (isset($_POST['go'])) {
    $client = new SoapClient($webservice_url);
	$res = $client->GetLicenseInfoByIdentCode(array(
	 "userName"   => $username ,
	 "password"   => $password , 
	 "nationalCode" => $_POST['nationalCode'],
	 "identCode"  => $_POST['identCode']));
    echo 'hi' ; 
}
?>
</div>
</body>
</html>