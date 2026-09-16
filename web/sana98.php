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
            <input type="text" name="identCode" value="<?php echo $_POST['identCode']?>">
            :شماره مجوز صادر شده<br>
            <br><input type="text" name="nationalCode" value="<?php echo $_POST['nationalCode']?>">
            : کد/شناسه ملی<br>
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
                <td align="right"><?php echo substr($place,0,2) ; ?></td>
                <td align="center">:</td>
                <td align="right">کد استان</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo substr($place,2,2) ; ?></td>
                <td align="center">:</td>
                <td align="right">کد شهرستان</td>
              </tr>
              <tr>
                <td align="right" width="18%">&nbsp;</td>
                <td align="right" width="36%"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LicenseDocNum?></td>
                <td align="center" width="8%">:</td>
                <td align="right" width="38%">شماره مجوز صادر شده</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->NoeMalekiat?></td>
                <td align="center">:</td>
                <td align="right">نوع مالکیت</td>
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
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->FirstName?></td>
                <td align="center">:</td>
                <td align="right">نام</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LastName?></td>
                <td align="center">:</td>
                <td align="right">نام خانوادگی</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->FatherName?></td>
                <td align="center">:</td>
                <td align="right">نام پدر</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->SHSh?></td>
                <td align="center">:</td>
                <td align="right">شماره شناسنامه</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Sex?></td>
                <td align="center">:</td>
                <td align="right">جنسیت</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->TarikhTavalod?></td>
                <td align="center">:</td>
                <td align="right">تاریخ تولد</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Tel?></td>
                <td align="center">:</td>
                <td align="right">تلفن</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Mobile?></td>
                <td align="center">:</td>
                <td align="right">همراه</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->ReshteTahsili?></td>
                <td align="center">:</td>
                <td align="right">رشته تحصیلی</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Address?></td>
                <td align="center">:</td>
                <td align="right">آدرس</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->CompanyType?></td>
                <td align="center">:</td>
                <td align="right"> نوع شرکت</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->RegNo?></td>
                <td align="center">:</td>
                <td align="right">شماره ثبت</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->RegDate?></td>
                <td align="center">:</td>
                <td align="right">تاریخ ثبت</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Ceo?></td>
                <td align="center">:</td>
                <td align="right">نام و نام خانوادگی مدیر عامل</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->CeoNationalCode?></td>
                <td align="center">:</td>
                <td align="right">کد ملی مدیر عامل</td>
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
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Mosaghaf?></td>
                <td align="center">:</td>
                <td align="right">مساحت مسقف</td>
              </tr>
              <tr>
                <td align="right">مترمربع</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->GhireMosaghaf?></td>
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
                <td align="right">میلیون ریال</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->SarmayeSabet?></td>
                <td align="center">:</td>
                <td align="right">سرمایه ثابت</td>
              </tr>
                            <tr>
                <td align="right">میلیون ریال</td>
                <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->SarmayeDarGardesh?></td>
                <td align="center">:</td>
                <td align="right">سرمایه در گردش </td>
              </tr>
                            <tr>
                              <td align="right">نفر</td>
                              <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->TedadEshteghal?></td>
                              <td align="center">:</td>
                              <td align="right">تعداد اشتغال </td>
                            </tr>
                            <tr>
                              <td align="right">&nbsp;</td>
                              <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->PostalCode?></td>
                              <td align="center">:</td>
                              <td align="right">کد پستی  </td>
                            </tr>
                            <tr>
                              <td align="right">&nbsp;</td>
                              <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->PlanId?></td>
                              <td align="center">:</td>
                              <td align="right">شماره پرونده </td>
                            </tr>
                            <tr>
                              <td align="right">&nbsp;</td>
                              <td align="right"><?php echo  $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->ShenaseKasboKar?></td>
                              <td align="center">:</td>
                              <td align="right">شناسه کسب و کار  </td>
                            </tr>
              <tr>
                              
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
                <td  height="39" colspan="4" align="center" bgcolor="#FF9900">اطلاعات مکانی</td>
              </tr>
<?php
$test1  = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Gis ; 
$object = (array)($test1) ; 
//print_r($object) ; 
$count = count($object['Gis']) ; 
?>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $count  ?></td>
                <td align="center">:</td>
                <td align="right">تعداد نقاط  </td>
              </tr>
              <tr>
<?php
for ($x = 0; $x <= $count-1; $x++) {
if ($count== 1)
{
$X     = $object['Gis']->X ; 
$Y     =  $object['Gis']->Y ; 
$Z     = $object['Gis']->Z ; 
$Zone  = $object['Gis']->Zone ; 
}
else 
{
$X      = $object['Gis'][$x]->X ; 
$Y      =  $object['Gis'][$x]->Y ; 
$Z      = $object['Gis'][$x]->Z ; 
$Zone   = $object['Gis'][$x]->Zone ; 
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
                  <td align="right"><?php echo  $X  ?></td>
                <td align="center">:</td>
                <td align="right">X </td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo $Y  ?></td>
                <td align="center">:</td>
                <td align="right">Y</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo   $Z  ?></td>
                <td align="center">:</td>
                <td align="right">Z</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><?php echo  $Zone  ?></td>
                <td align="center">:</td>
                <td align="right">Zone </td>
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
