<?php
// Enter these 3 parameters:
$webservice_url = "http://172.17.18.40/GetForeignPersonInfo/getForeignPersonInfo.asmx?WSDL";
//$webservice_url = "http://10.7.234.49:/GetPersonInfo/GetingPersonByNationalIdAndBirthDate.asmx?wsdl";
$Username = "test";
$Password = "test";
//$username = "poudadmin";
//$password = "6ae390lm";
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
	  <br><input type="text" name="Code"> 
    : شناسه ملی <br>
    <br>
    <input type="submit" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px" value="جستجو">
</p>
</form>
<?php
if ($_POST['Code']!='') {
	$client = new SoapClient($webservice_url);
	$res = $client->GetPersonInfo(array(
	 "userName"   => $Username ,
	 "passWord"   => $Password , 
	 "Code" => $_POST['Code']));
	//echo '<pre dir="ltr">';print_r($res);echo '</pre>';
	if (isset($_POST['Code'])) {
	//if ($res->GetForeignPersoninfoByCodeResult->Successful == true) { ;
	print_r($res->GetPersonInfoResult) ; 
	if ($res->GetPersonInfoResult->ErrorCode == 0 and $res->GetPersonInfoResult->person->PersianFirstName != '' ) { ;
	echo '<div dir="rtl">';
	//echo 'کد خطا : ' .$res->GetPersonInfoResult->ErrorMsg ; 
	echo '<br>';
	echo 'کد اختصاصی اتباع خارجی :' .$_POST['Code'] ; 
	echo '<p>';
	echo 'نام فارسی: '.$res->GetPersonInfoResult->person->PersianFirstName ; 
	echo '<br>';
	echo 'نام خانوادگی فارسی: '.$res->GetPersonInfoResult->person->PersianLastName  ; 
	echo '<p>';

	echo 'نام لاتین: '.$res->GetPersonInfoResult->person->LatinFirstName ; 
	echo '<br>';
	echo 'نام خانوادگی لاتین: '.$res->GetPersonInfoResult->person->LatinLastName  ; 
	echo '<p>';

	echo 'جنسیت: '.$res->GetPersonInfoResult->person->Gender   ; 
	echo '<br>';

	echo 'نام پدر : '.$res->GetPersonInfoResult->person->PersianFatherName    ; 
	echo '<br>';
	$originalDate = $res->GetPersonInfoResult->person->BirthDate	    ; 
     echo 'تاریخ تولد: '.$newDate = date("d-m-Y", strtotime($originalDate));
	echo '<p>';
	echo 'کشور محل تولد: '.$res->GetPersonInfoResult->person->BirthPlaceCountry->Title      ; 
	echo '<br>';
	echo 'ملیت: '.$res->GetPersonInfoResult->person->Nationality->Title      ; 
	echo '<p>';
	echo 'شماره شناسایی: '.$res->GetPersonInfoResult->person->IdentificationDocument->Number        ; 
	echo '<br>';
    }
	else 
	{
		echo 'یافت نشد: '.$res->GetPersonInfoResult->ErrorMsg;
	}
	echo '</div>';
}
}
?>
</div>
</body>
</html>