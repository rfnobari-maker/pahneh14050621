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
    <form action="" method="post">
        <p>
            <input type="text" name="identCode" value="288585956">
            :شماره مجوز صادر شده<br>
            <br><input type="text" name="nationalCode" value="3521067718">
            : کد ملی / شناسه ملی<br>
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
                <td height="35" colspan="4" align="center" bgcolor="#990066">اطلاعات واحد </td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LicenseType?></td>
                <td align="center">:</td>
                <td align="right">نوع مجوز</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->PersonType?></td>
                <td align="center">:</td>
                <td align="right">نوع شخص </td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <?php $place = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->PlaceId ;?>
                <td align="right"><?php echo $place ; ?></td>
                <td align="center">:</td>
                <td align="right">مکان طرح</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="right"><?php echo substr($place,1,2) ; ?></td>
              </tr>
              <tr>
                <td align="right" width="18%">&nbsp;</td>
                <td align="right" width="36%"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LicenseDocNum?></td>
                <td align="center" width="8%">:</td>
                <td align="right" width="38%">شماره مجوز صادر شده</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->UnitName?></td>
                <td align="center">:</td>
                <td align="right">نام واحد</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->NationalCode?></td>
                <td align="center">:</td>
                <td align="right">کد ملی یا شناسه ملی </td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->ManagerNationalCode?></td>
                <td align="center">:</td>
                <td align="right">کد ملی مدیر عامل </td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->BirthDate?></td>
                <td align="center">:</td>
                <td align="right">تاریخ تولد</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Address?></td>
                <td align="center">:</td>
                <td align="right">آدرس</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->DateLicenseCreation?></td>
                <td align="center">:</td>
                <td align="right">تاریخ پروانه تاسیس</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->licenseNumberTasis?></td>
                <td align="center">:</td>
                <td align="right">شماره پروانه تاسیس</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LicenseType?></td>
                <td align="center">:</td>
                <td align="right">نوع مجوز</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LicenseDoneDate?></td>
                <td align="center">:</td>
                <td align="right">تاریخ شروع مجوز </td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LicenseValidityDate?></td>
                <td align="center">:</td>
                <td align="right">تاریخ پایان مجوز</td>
              </tr>
              <tr>
                <td align="right">مترمربع</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->MasahatGhirMosaghaf?></td>
                <td align="center">:</td>
                <td align="right">مساحت مسقف</td>
              </tr>
              <tr>
                <td align="right">مترمربع</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->MasahatGhirMosaghaf?></td>
                <td align="center">:</td>
                <td align="right">مساحت غیر مسقف</td>
              </tr>
              <tr>
                <td align="right">مترمربع</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->MasahatZamin?></td>
                <td align="center">:</td>
                <td align="right">مساحت زمین </td>
              </tr>
              <tr>
                <td align="right">مترمکعب در سال</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->MizaneAbe?></td>
                <td align="center">:</td>
                <td align="right">میزان آب </td>
              </tr>
              <tr>
                <td align="right">مترمکعب</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->NaftGaz?></td>
                <td align="center">:</td>
                <td align="right">نفت گاز</td>
              </tr>
              <tr>
                <td align="right">مترمکعب</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Gaz?></td>
                <td align="center">:</td>
                <td align="right">گاز</td>
              </tr>
              <tr>
                <td align="right">کیلووات</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Bargh?></td>
                <td align="center">:</td>
                <td align="right">برق</td>
              </tr>
              <tr>
                <td align="right">میلیون ریال</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->MachineDakheli?></td>
                <td align="center">:</td>
                <td align="right">ماشین داخلی </td>
              </tr>
              <tr>
                <td align="right">نفر</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->TedadEshteghal?></td>
                <td align="center">:</td>
                <td align="right">تعداد اشتغال </td>
              </tr>
              <tr>
                <td  height="39" colspan="4" align="center" bgcolor="#FF9900">اطلاعات محصول</td>
              </tr>
<?php
$test = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Products ; 
$object = (array)($test) ; 
//print_r($object) ; 
$count = count($object['Products']) ; 
?>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $count  ?></td>
                <td align="center">:</td>
                <td align="right">تعداد محصول  </td>
              </tr>
              <tr>
<?php
for ($x = 0; $x <= $count-1; $x++) {
if ($count== 1)
{
$isic     = $object['Products']->IsikCode ; 
$product  =  $object['Products']->ProductTitle ; 
$zarfiyat = $object['Products']->ZarfiyatSalane ; 
$m_jazb   = $object['Products']->MizanJazbMavad ; 
}
else 
{
$isic    = $object['Products'][$x]->IsikCode ; 
$product  =  $object['Products'][$x]->ProductTitle ; 
$zarfiyat = $object['Products'][$x]->ZarfiyatSalane ; 
$m_jazb   = $object['Products'][$x]->MizanJazbMavad ; 
}
?> 
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="right">&nbsp;</td>
              </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="right"><?php echo  $isic  ?></td>
                <td align="center">:</td>
                <td align="right">کد آیسییک </td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo $product  ?></td>
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
	}
	?>
            </pre>
</div>
</body>
</html>
