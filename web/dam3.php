<?php
// Enter these 3 parameters:
$webservice_url = "http://172.17.18.41/agriwindows/unitservicesver3.asmx?WSDL";
//$webservice_url = "http://172.17.18.41/agriwindows/unitservices.asmx?WSDL";
$userName = "pahne";
$Password = "jahani2904";
$UpdateDate = NULL;
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
            <input type="text" name="PartIDcode" value="">
            :شناسه یکتا<br>
            <input type="submit" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px" value="جستجو">
        </p>
    </form>
	<?php
	if (isset($_POST['go'])) {
  echo  'PartIDcode ='. $PartIDcode = 	$_POST['PartIDcode'] ;  
  echo '<p>';
  echo 'UpdateDate='.$UpdateDate ;
  echo '<p>';
	$client = new SoapClient($webservice_url);
	$res = $client->WS_G_1_4(array(
	 "userName"   => $userName ,
	 "Password"   => $Password , 
     "PartIDcode"  => $PartIDcode,
	 "UpdateDate"  => $UpdateDate ));

	print_r($res->WS_G_1_4Result) ; 	
			?>
            <table width="65%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="35" colspan="3" align="center" bgcolor="#990066">اطلاعات واحد </td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->PartIdCode ?></td>
                <td align="center">:</td>
                <td align="right">شناسه یکتا</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->EpidemiologicCode ?></td>
                <td align="center">:</td>
                <td align="right">کد اپیدیمیولوژیک</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->UnitPostalCode ?></td>
                <td align="center">:</td>
                <td align="right">کد پستی</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->Ostan ?></td>
                <td align="center">:</td>
                <td align="right">کد استان</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->Shahrestan ?></td>
                <td align="center">:</td>
                <td align="right">کد شهرستان</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->Longitude ?></td>
                <td align="center">:</td>
                <td align="right">طول جغرافیایی</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->Latitude ?></td>
                <td align="center">:</td>
                <td align="right">عرض جغرافیایی</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->UnitName ?></td>
                <td align="center">:</td>
                <td align="right">نام واحد </td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->LicenseStatus ?></td>
                <td align="center">:</td>
                <td align="right">وضعيت مجوز</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->UnitGroup ?></td>
                <td align="center">:</td>
                <td align="right">طبقه بندی نوع واحد</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->UnitType ?></td>
                <td align="center">:</td>
                <td align="right"> نوع واحد</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->PartCapacity ?></td>
                <td align="center">:</td>
                <td align="right">ظرفیت واحد</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->OwnerBirthDate ?></td>
                <td align="center">:</td>
                <td align="right">تاریخ تولد مالک</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->LicenseISS ?></td>
                <td align="center">:</td>
                <td align="right">تاریخ صدور پروانه بهره برداری/ مجوز فعالیت</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->LicenseExp ?></td>
                <td align="center">:</td>
                <td align="right">تاریخ اعتبار پروانه بهره برداری/ مجوز فعالیت</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->OwnerCitizenship ?></td>
                <td align="center">:</td>
                <td align="right">تابعیت مالک/ بهره بردار</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->OwnerBirthDate ?></td>
                <td align="center">:</td>
                <td align="right">تاریخ تولد مالک</td>
              </tr>
              <tr>
                <td height="51" align="right"><?php echo  $res->WS_G_1_4Result->ListUnitProperty->UnitProperty->OwnerBirthDate ?></td>
                <td align="center">:</td>
                <td align="right">تاریخ تولد مالک</td>
              </tr>
              <tr>
                <td height="51" align="right">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="right">&nbsp;</td>
              </tr>
              <tr>
                <td height="51" align="right">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="right">&nbsp;</td>
              </tr>
              <tr>
                <td height="51" align="right">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="right">&nbsp;</td>
              </tr>
            </table>
			<?php
	}
	?>
</div>
</body>
</html>
