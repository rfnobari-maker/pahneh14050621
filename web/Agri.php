<?php
// Enter these 3 parameters:
$webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
$Username = "test";
$Password = "test";
$type= 0 ; 
$year= 1401 ;
//$AreaID = 15 ;
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
	  <br><input type="text" name="AreaID"> 
    : id <br>
    <br>
    <input type="submit" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px" value="جستجو">
</p>
</form>
<?php
if ($_POST['AreaID']!='') {
	$client = new SoapClient($webservice_url);
	$res = $client->CheckEditorDeletePermission(array(
	 "Username"   => $Username ,
	 "Password"   => $Password ,
	 "type" => $type ,
     "year" => $year ,
	 "AreaID" => $_POST['AreaID']));
	if (isset($_POST['AreaID'])) {
		print_r($res->CheckEditorDeletePermissionResult) ; 
	//	echo 'EditPermission: '.$res->CheckEditorDeletePermissionResult->EditPermission ;
//		echo '<br>' ; 
  //  	        echo 'nokesht:'.$res->CheckEditorDeletePermissionResult->nokesht ;
//	echo '</div>';
}
}
?>
</div>
</body>
</html>