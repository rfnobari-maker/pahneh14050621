<?php
$docNum = 751331955 ;
$response = json_decode(file_get_contents('https://api-semak.maj.ir/api/planLicenses/licenseValidation?docNum='.$docNum), true);
?>
<?php
print_r($response) ; 
if($response['resultCode'] != 1 ) echo $response['validationMessage'];
$raste       = $response['plan']['planTypeId'] ; 
//باید 15 باشد 
$no_moj     = $response['planLicense']['licenseTypeId']; 
// باید 1 باشد 
?>
<?php
$no_bah       =  $response['user']['userType'] ; 
$bah_name     =  $response['user']['firstName'] ; 
$last_name    =  $response['user']['lastName'] ; 
$NationalCode =  $response['user']['nationalCode'] ; 
$sh_meli      =  $response['user']['nationalCode'] ; 
$sh_sh        =  $response['user']['identityNumber'] ; 
$fname        =  $response['user']['fatherName'] ; 
$cod_jens     =  $response['user']['gender'] ; 
$tel_s        =  $response['user']['phone'] ; 
$tel_m        =  $response['user']['mobile'] ; 
 $m_tah        =  $response['user']['certificate'] ; 
$unit_name    =  $response['user']['name'] ; 
$co_sabt      =  $response['user']['identityNumbe'] ; 
$date_sabt    =  $response['user']['registerDate'] ; 
$no_co        =  $response['user']['legalTypeId'] ; 
$c_cod_m      =  $response['user']['managerNationalCode'] ; 



?>
<?php
$no_mal       = $response['plan']['technicalInfo'][17]['value']  ; 
$cod_p       = $response['plan']['technicalInfo'][23]['value']  ; 
$addres       = $response['plan']['technicalInfo'][24]['value']  ; 
$no_mal_cod   = $response['plan']['technicalInfo'][17]['fieldType']  ; 
$m_zamin      = $response['plan']['technicalInfo'][0]['value'] ; 
$m_zmos       = $response['plan']['technicalInfo'][1]['value'] ; 
$sarmayeh_s   = $response['plan']['technicalInfo'][4]['value'] ; 
$sarmayeh_d   = $response['plan']['technicalInfo'][5]['value'] ; 
$t_shagel     = $response['plan']['technicalInfo'][11]['value'] ; 
?>
<?php
$t_mah        = count($response['plan']['productInfo']); 
for ($x = 0; $x <= $t_mah-1; $x++) {
$product_name = $response['plan']['productInfo'][$x]['name']; 
$isic_code    = $response['plan']['productInfo'][$x]['isikCode']; 
$zarfiyat     = $response['plan']['productInfo'][$x]['detail'][0]['value']; 
$m_jazb       = $response['plan']['productInfo'][$x]['detail'][1]['value']; 
}

?>
<?php
     $add_place       = $response['planLocation']['statisticalCenterCode'] ; 
?>
<?php
     $ShenaseKasboKar = $response['planLicense']['identCode']; 
     $doneDate        = $response['planLicense']['doneDate']; 
     $star_date       = substr($doneDate,0,4).'/'.substr($doneDate,4,2).'/'.substr($doneDate,6,2) ; 
	 $validityDate    = $response['planLicense']['validityDate']; 
     $end_date        = substr($validityDate,0,4).'/'.substr($validityDate,4,2).'/'.substr($validityDate,6,2) ; 
?>
<?php
$GIS     = $response['planGisPoints'] ; 
$X1      = $GIS[0]['x'] ; 
$Y1      = $GIS[0]['y'] ; 
$Z1      = $GIS[0]['z'] ; 
$Zone1   = $GIS[0]['zone'] ; 
$X2      = $GIS[1]['x'] ; 
$Y2      = $GIS[1]['y'] ; 
$Z2      = $GIS[1]['z'] ; 
$Zone2   = $GIS[1]['zone'] ; 
$X3      = $GIS[2]['x'] ; 
$Y3      = $GIS[2]['y'] ; 
$Z3      = $GIS[2]['z'] ; 
$Zone3   = $GIS[2]['zone'] ; 
$X4      = $GIS[3]['x'] ; 
$Y4      = $GIS[3]['y'] ; 
$Z4      = $GIS[3]['z'] ; 
$Zone4   = $GIS[3]['zone'] ; 
?>
