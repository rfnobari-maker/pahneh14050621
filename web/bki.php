<?php
// Enter these 3 parameters:
$webservice_url = "http://172.17.18.13/wheat/WebService.asmx";
//$webservice_url = "http://10.7.234.49:/GetPersonInfo/GetingPersonByNationalIdAndBirthDate.asmx?wsdl";
$Username = "bkadmin";
$Password = "Amg56HjD#45";
$ostan      = '07' ;
$shahrestan ='06';
$type = '1' ;
$Code = '2549813510' ;

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
	  <br><input type="text" name="NationalCode"> 
    : شناسه ملی <br>
    <br>
    <input type="submit" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px" value="جستجو">
</p>
</form>
<?php
if ($_POST['NationalCode']!='') {
	$client = new SoapClient($webservice_url);
	$res = $client->FetchFarmeronline(array(
	 "username"   => $Username ,
	 "Password"   => $Password , 
     "ostan"   => $ostan ,
     "shahrestan"   => $shahrestan ,
     "type"   => $type ,
     "Code"   => $Code ));
	//echo '<pre dir="ltr">';print_r($res);echo '</pre>';
	if (isset($Code)) {
	if (1==1) { ;
	echo '<div dir="rtl">';
	echo 'نام: '.$res->FetchFarmeronlineResult->CodeMeli;
	echo '<br>';
	echo 'آدرس: '.$res->FetchFarmeronlineResult->name;
	echo '<br>';
	echo 'محل: '.$res->FetchFarmeronlineResult->lastName;
	echo '<br>';
	echo 'کد پستی: '.$res->FetchFarmeronlineResult->fatherName;
	echo '<br>';
	echo 'شماره ثبت: '.$res->FetchFarmeronlineResult->company;
	echo '<br>';
	echo 'تاریخ ثبت: '.$res->FetchFarmeronlineResult->NationalID;
	echo '<br>';
	echo 'نام واحد ثبتی: '.$res->FetchFarmeronlineResult->type;
	echo '<br>';
	echo 'نام واحد ثبتی: '.$res->FetchFarmeronlineResult->Ostan;
	echo '<br>';
	echo 'نام واحد ثبتی: '.$res->FetchFarmeronlineResult->Shahrestan;
	echo '<br>';
	echo 'نام واحد ثبتی: '.$res->FetchFarmeronlineResult->SathZirKesht;
	echo '<br>';
	echo 'نام واحد ثبتی: '.$res->FetchFarmeronlineResult->Tolid;
	echo '<br>';

	}
	else 
	{
		echo 'خطا: '.$res->FetchFarmeronlineResult->Message;
	}
	echo '</div>';
}
}
?>
</div>
</body>
</html>