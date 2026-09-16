<?php
// Enter these 3 parameters:
$webservice_url = "http://eagri.maj.ir/Application/WebServices/Get_License_Info_BY_IdentCode_And_NationalCode_WS.asmx?WSDL";
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
<div  align="center" style="margin-top: 100px; font-family: tahoma; font-size: 16px; color: #39C;">
	<?php
	   $client = new SoapClient($webservice_url);
		$res = $client->GetLicenseInfoByIdentCode(array(
			"userName"   => $username ,
			"password"   => $password ,
			"nationalCode" => '10861933991',
			"identCode"  => '497837339'));
//			"nationalCode" => $_POST['nationalCode'],
	//		"identCode"  => $_POST['identCode']));

		/*		var_dump($res->GetLicenseInfoByIdentCodeResult->ErroCode);
				exit;*/
		if ($res->GetLicenseInfoByIdentCodeResult->ErroCode !== 0) {
		echo $res->GetLicenseInfoByIdentCodeResult->Message  ;
		} else {
 //  print_r($res->GetLicenseInfoByIdentCodeResult->LicenseInfo);
				?>
</pre>
            <table width="65%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td  height="39" colspan="4" align="center" bgcolor="#FF9900">اطلاعات محصول</td>
              </tr>
<?php
$test = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Products ; 
$object = (array)($test) ; 
//print_r($object) ; 
$count = count($object['Products']) ; 
$count = 1 ; 
?>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $count  ?></td>
                <td align="center">:</td>
                <td align="right">تعداد محصول  </td>
              </tr>
              <tr>
<?php
if ($count== 1)
{
$isic_code     = $object['Products']->IsikCode ; 
$product_name  =  $object['Products']->ProductTitle ; 
$zarfiyat = $object['Products']->ZarfiyatSalane ; 
$m_jazb   = $object['Products']->MizanJazbMavad ; 
}

for ($x = 0; $x <= $count-1; $x++) {
$isic_code    = $object['Products'][$x]->IsikCode ; 
$product_name  =  $object['Products'][$x]->ProductTitle ; 
$zarfiyat = $object['Products'][$x]->ZarfiyatSalane ; 
$m_jazb   = $object['Products'][$x]->MizanJazbMavad ; 

?> 
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="right">&nbsp;</td>
              </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="right"><?php echo  $isic_code  ?></td>
                <td align="center">:</td>
                <td align="right">کد آیسییک </td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo $product_name  ?></td>
                <td align="center">:</td>
                <td align="right">عنوان محصول </td>
              </tr>
              <tr>
                <td align="right">تن</td>
                <td align="right"><?php echo   $zarfiyat  ?></td>
                <td align="center">:</td>
                <td align="right">ظرفیت سالن</td>
              </tr>
              <tr>
                <td align="right">تن</td>
                <td align="right"><?php echo  $m_jazb  ?></td>
                <td align="center">:</td>
                <td align="right">ظرفیت جذب مواد </td>
              </tr>
<?php }?>
              <tr>
                <td  height="39" colspan="4" align="center" bgcolor="#FFFFFF"><p>&nbsp;</p>       
   </td>
              </tr>
            </table>
            <pre dir="ltr" style="text-align: left;">

			<?php

	}
	
	?>
            </pre>
</div>
</body>
</html>
