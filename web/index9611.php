<?php
// Enter these 3 parameters:
$webservice_url = "http://172.17.18.40:/GetPersonInfo/GetingPersonByNationalIdAndBirthDate.asmx?wsdl";
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
	<p>
	  <input type="text" name="birthdate"> 
	  : تاریخ تولد  <br>
	  <br><input type="text" name="nationalid"> 
    : کد ملی <br>
    <br>
    <input type="submit" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px" value="جستجو">
</p>
</form>
<?php
if (isset($_POST['go'])) {
	$client = new SoapClient($webservice_url);
	$res = $client->GetPersonInfo(array(
	 "userName"   => $username ,
	 "passWord"   => $password , 
	 "NationalId" => $_POST['nationalid'],
	 "BirthDate"  => $_POST['birthdate']));
	//echo '<pre dir="ltr">';print_r($res);echo '</pre>';
	if ($res->GetPersonInfoResult->status == Okay) { ;
	echo '<div dir="rtl">';
	echo 'نام: '.$res->GetPersonInfoResult->firstName;
	echo '<br>';
	echo 'نام خانوادگی: '.$res->GetPersonInfoResult->lastName;
	echo '<br>';
	echo 'نام پدر: '.$res->GetPersonInfoResult->fatherName;
	echo '<br>';
	echo 'شماره شناسنامه: '.$res->GetPersonInfoResult->identityCertificateID;
	echo '<br>';
	if ($res->GetPersonInfoResult->gender==1) $jens = 'مرد' ;
	if ($res->GetPersonInfoResult->gender==0) $jens = 'زن' ;
	echo 'جنسیت: '.$jens;
	echo '<br>';
	$date_t = $res->GetPersonInfoResult->birthDate;
    $yy = (substr($date_t,0,4));
    $mm = (substr($date_t,4,2)) ;
    $dd = (substr($date_t,6,2)) ;
    $new_date = $yy.'/'.$mm.'/'.$dd ;
	echo 'تاریخ تولد: '.$new_date ; 
	echo '<br>';
	if ($res->GetPersonInfoResult->lifeStatus==0) $live = 'زنده' ;
	if ($res->GetPersonInfoResult->lifeStatus==1) $live = 'فوت شده' . ' تاریخ فوت :' .$res->GetPersonInfoResult->deathDate  ;
	echo 'وضعیت حیات : '.$live;
	}
	else 
	{
		echo 'خطا: '.$res->GetPersonInfoResult->status;
	}
	echo '</div>';

}
?>
</div>
</body>
</html>