<?php
include('../lock_p2.php');
include('../login/config.php');
// Enter these 3 parameters:
$webservice_url = "http://172.17.18.40:/GetPersonInfo/GetingPersonByNationalIdAndBirthDate.asmx?wsdl";
$username = "poudadmin";
$password = "6ae390lm";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="reza_1.css">
<style type="text/css"> 
.error { 
    display: block; 
    color: red; 
    font-style: italic; 
} 
#message { 
    display:none; 
    font-size:15px; 
    font-weight:bold; 
    color:#333333; 
} 
</style> 
</head>
<body>
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
  <?php include('top.php'); ?>
    <td width="840" >
           <p class="style8">استعلام مشخصات بهره بردار</p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <p><?php
// Enter these 3 parameters:
$webservice_url = "http://172.17.18.40:/GetPersonInfo/GetingPersonByNationalIdAndBirthDate.asmx?wsdl";
$username = "poudadmin";
$password = "6ae390lm";
?>
             <span class="style8"><span class="normalTextSmall"><span class="style21"><a name="1" id="13"></a></span></span></span>
           <div  align="center" style="margin-top:10px; font-family:tahoma; font-size:16px">
<form action="" method="post">
	<p>
	  <input type="text" name="birthdate" style="font-size:16px ; color:#06C ; font-family:tahoma; width:120px ; height:35px"> 
	  : تاریخ    تولد <br />
	  <span class="style2"> 13470522</span><br>
	  <br><input type="text" name="nationalid" style="font-size:16px ; color:#06C ; font-family:tahoma; width:120px ; height:35px">
    : کد ملی بهره بردار<br>
    <br>
    <input type="submit" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px" value="جستجو">
</p>
</form>
<?php
if (isset($_POST['go'])) {
	$client = new SoapClient($webservice_url);
	$res = $client->GetPersonInfo(array("userName" => $username , "passWord" =>$password , "NationalId" =>$_POST['nationalid'], "BirthDate" =>$_POST['birthdate']));
	//echo '<pre dir="ltr">';print_r($res);echo '</pre>';
	if ($res->GetPersonInfoResult->status==Okay) { ;
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
		echo 'فردی با مشخصات فوق یافت نشد' ;
	}
	echo '</div>';

}
?>
</div>
</p>
           <p>&nbsp;</p>
           <p><a href="benef.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
