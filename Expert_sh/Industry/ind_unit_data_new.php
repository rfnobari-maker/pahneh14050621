<?php
include('../../lock_expsh.php');
include('../../event.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
if (isset($_POST['action']) and $_POST['id_mar'] !='')
{
   $date_s = $date_edit ;
   $mor_cod_m = $login_session ;
   $id_mar = $_POST['id_mar'] ;
   $add_city = $_POST['add_city'] ;
   $add_abadi = $_POST['add_abadi'] ;
   $email  = $_POST['email']; 
   $m_tah   = $_POST['m_tah']; 
   $v_ab = $_POST['v_ab'] ;
  if(isset($_POST['g_en']))
  {
   $g_en = $_POST['g_en'] ;
  }else 
  {
   $g_en = '' ;
  }
   $v_ch = $_POST['v_ch'] ;
  if(isset($_POST['no_mch']))
  {
   $no_mch = $_POST['no_mch'] ;
   $y_mch = $_POST['y_mch'] ;
   $m_mch = $_POST['m_mch'] ;
   $d_mch = $_POST['d_mch'] ;
   $date_mch = $y_mch.'/'.$m_mch.'/'.$d_mch ; 
  }else{
   $date_mch = '';$y_mch='';$m_mch='';$d_mch=''; $no_mch = '' ; 
  }
   $jens2= $_POST['jens2']; 
   
   $v_bar = $_POST['v_bar'] ;
 if(isset($_POST['g_en']))
 {
   $amp = $_POST['amp'] ;
   $t_faz = $_POST['t_faz'] ;
 }else 
 {
   $amp = '';
   $t_faz = '' ;
 }
   $v_gaz = $_POST['v_gaz'] ;
   $v_tas = $_POST['v_tas'] ;
   $no_tas = $_POST['no_tas'] ;
   if($v_tas == '2') $no_tas = '' ;
   $v_tah = $_POST['v_tah'] ;
   $v_rd = $_POST['v_rd'] ;
   $t_mah = $_POST['t_mah'] ;
   $NationalCode = $_POST['NationalCode'];
   $identCode =  $_POST['identCode'] ;


$webservice_url = "http://eagri.maj.ir/Application/WebServices/Get_License_Info_BY_IdentCode_And_NationalCode_WS.asmx?WSDL";
$username = "sanayelicense";
$password = "License123!@#";
		$client = new SoapClient($webservice_url);
		$res = $client->GetLicenseInfoByIdentCode(array(
			"userName"   => $username ,
			"password"   => $password ,
			"nationalCode" => $NationalCode ,
			"identCode"  => $identCode));
$no_moj = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LicenseType ; 
$no_bah = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->PersonType ; 
$add_place = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Location ; 
$id_ostan1 =  substr($add_place,0,2) ; 
$id_city1 = substr($add_place,2,2) ;
$bah_name    = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->FirstName ; 
$last_name    = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LastName  ;
$NationalCode = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->NationalCode ;
$sh_meli      = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->NationalCode ;
$sh_sh     = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->SHSh  ;
$fname    = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->FatherName  ;
$date_t    = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->TarikhTavalod  ;
$cod_jens  = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Sex  ;
$r_tah     = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->ReshteTahsili  ;
$tel_s     = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Tel  ;
$tel_m     = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Mobile  ;
$addres   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Address ;
$no_mal    = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->NoeMalekiat ;
$unit_name = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->UnitName ;
$co_name = $unit_name ; 
$no_co   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->CompanyType ;
$co_sabt   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->RegNo ;
$date_sabt  = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->RegDate ;
$c_name   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Ceo ;
$c_cod_m   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->CeoNationalCode ;
$start_date   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LicenseDoneDate ;
$end_date   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LicenseValidityDate ;
$sarmayeh_s   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->SarmayeSabet ;
$sarmayeh_d   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->SarmayeDarGardesh ;
$m_zamin   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->MasahatZamin ;
$m_zmos   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Mosaghaf ;
$t_shagel          = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->TedadEshteghal ;
$cod_p             = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->PostalCode ;
$ShenaseKasboKar   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->ShenaseKasboKar ;

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



// بانک اطلاعات کشت
if ($no_bah=='1') {$co_name = '' ; $no_co=''; $co_sabt='';$date_sabt='';$c_name='';$c_cod_m='';}
if ($no_bah=='2') {$name= '' ; $last_name= '' ;$fname= '' ; $m_tah='' ; $r_tah= '' ; $jens2='' ; $sh_sh=''; $date_t = '' ; }

$sql = "DELETE FROM ind_bah WHERE ShenaseKasboKar =  :ShenaseKasboKar";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':ShenaseKasboKar', $ShenaseKasboKar, PDO::PARAM_INT);   
$stmt->execute();

$sql = "DELETE FROM ind_unit WHERE ShenaseKasboKar =  :ShenaseKasboKar";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':ShenaseKasboKar', $ShenaseKasboKar, PDO::PARAM_INT);   
$stmt->execute();

$sql = "DELETE FROM ind_list_product WHERE ShenaseKasboKar =  :ShenaseKasboKar";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':ShenaseKasboKar', $ShenaseKasboKar, PDO::PARAM_INT);   
$stmt->execute();


 $query = "INSERT IGNORE INTO ind_bah (date_s,mor_cod_m,no_bah,NationalCode,cod_p,jens,name,last_name,date_t,
 sh_sh,fname,m_tah,r_tah,tel_s,tel_m,co_name,no_co,co_sabt,date_sabt,add_abadi,add_city,id_city,id_mar,
 id_ostan,addres,email,c_name,c_cod_m,ShenaseKasboKar) 
 VALUES(:date_s,:mor_cod_m,:no_bah,:NationalCode,:cod_p,:jens,:name,:last_name,:date_t,:sh_sh,:fname,
 :m_tah,:r_tah,:tel_s,:tel_m,:co_name,:no_co,:co_sabt,:date_sabt,:add_abadi,:add_city,:id_city,:id_mar,:id_ostan
 ,:addres,:email,:c_name,:c_cod_m,:ShenaseKasboKar)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':no_bah'=>$no_bah,':NationalCode'=>$NationalCode,
':cod_p'=>$cod_p,':jens'=>$jens2,':name'=>$bah_name,':last_name'=>$last_name,':date_t'=>$date_t,
':sh_sh'=>$sh_sh,':fname'=>$fname,':m_tah'=>$m_tah,':r_tah'=>$r_tah,':tel_s'=>$tel_s,
':tel_m'=>$tel_m,':co_name'=>$co_name,':no_co'=>$no_co,':co_sabt'=>$co_sabt,
':date_sabt'=>$date_sabt,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':id_city'=>$id_city1,':id_mar'=>$id_mar,':id_ostan'=>$id_ostan1,
':addres'=>$addres,':email'=>$email,':c_name'=>$c_name,':c_cod_m'=>$c_cod_m,':ShenaseKasboKar'=>$ShenaseKasboKar));

   
   
    $query = "INSERT INTO ind_unit (date_s,mor_cod_m,id_ostan,id_city,id_mar,NationalCode,no_bah,unit_name,m_zamin
	,m_zmos,X1,Y1,Z1,Zone1,X2,Y2,Z2,Zone2,X3,Y3,Z3,Zone3,X4,Y4,Z4,Zone4,no_mal,sarmayeh_s,sarmayeh_d,identCode
	,ShenaseKasboKar,start_date,end_date,t_shagel,t_mah,v_ab,g_en,v_ch,no_mch,date_mch,v_bar,amp,t_faz,
	v_gaz,v_tas,no_tas,v_tah,v_rd,add_abadi,add_city)
	  VALUES(:date_s,:mor_cod_m,:id_ostan,:id_city,:id_mar,:NationalCode,:no_bah,:unit_name,:m_zamin,:m_zmos
	  ,:X1,:Y1,:Z1,:Zone1,:X2,:Y2,:Z2,:Zone2,:X3,:Y3,:Z3,:Zone3,:X4,:Y4,:Z4,:Zone4,:no_mal,:sarmayeh_s,:sarmayeh_d,:identCode,:ShenaseKasboKar,:start_date,:end_date,:t_shagel,:t_mah,:v_ab,:g_en,:v_ch,:no_mch,:date_mch,:v_bar,:amp,
	  :t_faz,:v_gaz,:v_tas,:no_tas,:v_tah,:v_rd,:add_abadi,:add_city)";
    $q = $dbh->prepare($query);
    $q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':id_ostan'=>$id_ostan1,':id_city'=>$id_city1,':id_mar'=>$id_mar,
	':NationalCode'=>$NationalCode,':no_bah'=>$no_bah,':unit_name'=>$unit_name,':m_zamin'=>$m_zamin,':m_zmos'=>$m_zmos,
	':X1'=>$X1,':Y1'=>$Y1,':Z1'=>$Z1,':Zone1'=>$Zone1,
	':X2'=>$X2,':Y2'=>$Y2,':Z2'=>$Z2,':Zone2'=>$Zone2,
    ':X3'=>$X3,':Y3'=>$Y3,':Z3'=>$Z3,':Zone3'=>$Zone3,
    ':X4'=>$X4,':Y4'=>$Y4,':Z4'=>$Z4,':Zone4'=>$Zone4,
	':no_mal'=>$no_mal,':sarmayeh_s'=>$sarmayeh_s,':sarmayeh_d'=>$sarmayeh_d,':identCode'=>$identCode,
	':ShenaseKasboKar'=>$ShenaseKasboKar,':start_date'=>$start_date,
	':end_date'=>$end_date,':t_shagel'=>$t_shagel,':t_mah'=>$t_mah,':v_ab'=>$v_ab,':g_en'=>$g_en,':v_ch'=>$v_ch,':no_mch'=>$no_mch,
	':date_mch'=>$date_mch,':v_bar'=>$v_bar,':amp'=>$amp,':t_faz'=>$t_faz,':v_gaz'=>$v_gaz,':v_tas'=>$v_tas,':no_tas'=>$no_tas,
	':v_tah'=>$v_tah,':v_rd'=>$v_rd,':add_abadi'=>$add_abadi,':add_city'=>$add_city));



$test = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Products ; 
$object = (array)($test) ; 
//print_r($object) ; 
$count = count($object['Products']) ; 
if ($count== 1)
{
$isic_code     = $object['Products']->IsikCode ; 
$product_name  =  $object['Products']->ProductTitle ; 
$zarfiyat = $object['Products']->ZarfiyatSalane ; 
$m_jazb   = $object['Products']->MizanJazbMavad ; 
 $query = "INSERT INTO ind_list_product (date_s,mor_cod_m,id_ostan,id_city,id_mar,NationalCode,no_bah,unit_name,identCode,
  isic_code,product_name,zarfiyat,m_jazb,add_abadi,add_city,ShenaseKasboKar)
	  VALUES(:date_s,:mor_cod_m,:id_ostan,:id_city,:id_mar,:NationalCode,:no_bah,:unit_name,:identCode,
	  :isic_code,:product_name,:zarfiyat,:m_jazb,:add_abadi,:add_city,:ShenaseKasboKar)";
    $q = $dbh->prepare($query);
    $q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':id_ostan'=>$id_ostan1,':id_city'=>$id_city1,':id_mar'=>$id_mar,
	':NationalCode'=>$NationalCode,':no_bah'=>$no_bah,':unit_name'=>$unit_name,':identCode'=>$identCode,
	':isic_code'=>$isic_code,':product_name'=>$product_name,':zarfiyat'=>$zarfiyat,':m_jazb'=>$m_jazb,
	':add_abadi'=>$add_abadi,':add_city'=>$add_city,':ShenaseKasboKar'=>$ShenaseKasboKar));

}
else 
{
for ($x = 0; $x <= $count-1; $x++) {
$isic_code    = $object['Products'][$x]->IsikCode ; 
$product_name  =  $object['Products'][$x]->ProductTitle ; 
$zarfiyat = $object['Products'][$x]->ZarfiyatSalane ; 
$m_jazb   = $object['Products'][$x]->MizanJazbMavad ; 

 $query = "INSERT INTO ind_list_product (date_s,mor_cod_m,id_ostan,id_city,id_mar,NationalCode,no_bah,unit_name,identCode,
  isic_code,product_name,zarfiyat,m_jazb,add_abadi,add_city,ShenaseKasboKar)
	  VALUES(:date_s,:mor_cod_m,:id_ostan,:id_city,:id_mar,:NationalCode,:no_bah,:unit_name,:identCode,
	  :isic_code,:product_name,:zarfiyat,:m_jazb,:add_abadi,:add_city,:ShenaseKasboKar)";
    $q = $dbh->prepare($query);
    $q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':id_ostan'=>$id_ostan1,':id_city'=>$id_city1,':id_mar'=>$id_mar,
	':NationalCode'=>$NationalCode,':no_bah'=>$no_bah,':unit_name'=>$unit_name,':identCode'=>$identCode,
	':isic_code'=>$isic_code,':product_name'=>$product_name,':zarfiyat'=>$zarfiyat,':m_jazb'=>$m_jazb,
	':add_abadi'=>$add_abadi,':add_city'=>$add_city,':ShenaseKasboKar'=>$ShenaseKasboKar));

}
}




// اطلاعات مالک
    sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'ثبت اطلاعات واحد صنعتی - '.$NationalCode,$id_ostan1) ;
    alert ('اطلاعات واحد صنعتی با موفقیت ثبت شد ، اکنون می توانید عملکرد واحد را ثبت کنید ') ;
    unset($date_s,$mor_cod_m,$no_bah,$cod_p,$jens,$name,$last_name,$date_t,$sh_sh,$fname,$m_tah,$r_tah,
$tel_s,$tel_m,$co_name,$no_co,$co_sabt,$date_sabt,$add_abadi,$add_city,$id_city,$id_mar,$id_ostan,
$addres,$email,$c_name,$c_cod_m,$unit_name,$m_zamin,$m_zmos,$X1,$Y1,$Z1,$Zone1,$X2,$Y2,$Z2,$Zone2,
$X3,$Y3,$Z3,$Zone3,$X4,$Y4,$Z4,$Zone4,$no_mal,$sarmayeh_s,$sarmayeh_d,$identCode,$start_date,$end_date,
$t_shagel,$v_ab,$g_en,$v_ch,$no_mch,$date_mch,$v_bar,$amp,$t_faz,$v_gaz,$v_tas,$no_tas,$v_tah,
$v_rd,$isic_code,$product_name,$zarfiyat,$m_jazb);
    ?>
    <form  name="myform" class="myform" method="post" action="ind_prod.php">
     <input type="hidden" name="NationalCode" value=<?php echo $NationalCode; ?> />    
     <input type="hidden" name="ShenaseKasboKar" value=<?php echo $ShenaseKasboKar; ?> />    
     <input type="hidden" name="t_mah" value=<?php echo $t_mah; ?> />    

         </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
}
////////
if  (isset($_POST['identCode']))
{
$identCode = $_POST["identCode"];
$nationalCode = $_POST["nationalCode"];
$webservice_url = "http://eagri.maj.ir/Application/WebServices/Get_License_Info_BY_IdentCode_And_NationalCode_WS.asmx?WSDL";
$username = "sanayelicense";
$password = "License123!@#";
		$client = new SoapClient($webservice_url);
		$res = $client->GetLicenseInfoByIdentCode(array(
			"userName"   => $username ,
			"password"   => $password ,
			"nationalCode" => $_POST['nationalCode'],
			"identCode"  => $_POST['identCode']));

		/*		var_dump($res->GetLicenseInfoByIdentCodeResult->ErroCode);
				exit;*/
$ErroCode = $res->GetLicenseInfoByIdentCodeResult->ErroCode ;
$ErroMessage = $res->GetLicenseInfoByIdentCodeResult->Message ;
if($ErroCode != 0 )
{
alert($ErroMessage) ;
?>
 <form  name="myform" class="myform" method="post" action="index.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
<?php
}
		if ($res->GetLicenseInfoByIdentCodeResult->ErroCode !== 0) {
		echo $res->GetLicenseInfoByIdentCodeResult->Message  ;
		} else {
 //  print_r($res->GetLicenseInfoByIdentCodeResult->LicenseInfo);
$no_moj    = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LicenseType ; 
$no_bah    = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->PersonType ; 
$add_place = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Location ; 
//alert($add_place) ; 
$id_ostan1 = substr($add_place,0,2) ;
$id_city1  = substr($add_place,2,2) ;
if($no_moj != '2' )
{
alert('خطا ! فقط برای پروانه بهره برداری ، امکان ثبت مقدور میباشد') ;
?>
 <form  name="myform" class="myform" method="post" action="index.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
<?php
}
if($id_ostan1 != $id_ostan || $id_city1 != $id_city )
{
alert('خطا ! این واحد در استان/شهرستان شما واقع نشده ، امکان ثبت برای شما مقدور نیست') ;
?>
 <form  name="myform" class="myform" method="post" action="index.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
<?php
}
$id_bakh  = substr($add_place,4,2) ;
// کد آبادی
if (strlen($add_place) == 16) 
{
$id_abadi = substr($add_place,10,6) ;
    $query = "SELECT id_mar,mar,add_abadi,abadi from list_abadi WHERE add_abadi LIKE '%$id_abadi' and id_ostan = '$id_ostan1' and id_city = '$id_city1'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $found = $stmt -> rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $add_abadi = $row["add_abadi"];
    $abadi     = $row["abadi"];
    $id_mar    = $row["id_mar"];
    $mar       = $row["mar"];
    $add_city  = '-' ;

}
if (strlen($add_place) == 10) 
{
    $add_city = $add_place ;
    $query = "SELECT id_mar,mar,shahr from list_city where add_city = :add_city";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':add_city'=>$add_city));
    $found     = $stmt -> rowCount();
    $row       = $stmt->fetch(PDO::FETCH_ASSOC);
    $shahr     = $row["shahr"];
    $id_mar    = $row["id_mar"];
    $mar       = $row["mar"];
    $add_abadi = '-' ; 
}
$bah_name     = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->FirstName ; 
$last_name    = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LastName  ;
$NationalCode = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->NationalCode ;
$sh_meli      = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->NationalCode ;
$sh_sh        = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->SHSh  ;
$fname        = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->FatherName  ;
$date_t       = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->TarikhTavalod  ;
$cod_jens     = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Sex  ;
$r_tah        = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->ReshteTahsili  ;
$tel_s        = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Tel  ;
$tel_m        = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Mobile  ;
$addres       = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Address ;
$no_mal       = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->NoeMalekiat ;
$unit_name    = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->UnitName ;
$no_co        = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->CompanyType ;
$co_sabt      = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->RegNo ;
$date_sabt    = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->RegDate ;
$c_name       = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Ceo ;
$c_cod_m      = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->CeoNationalCode ;
$start_date   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LicenseDoneDate ;
$end_date     = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->LicenseValidityDate ;
$sarmayeh_s   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->SarmayeSabet ;
$sarmayeh_d   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->SarmayeDarGardesh ;
$m_zamin      = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->MasahatZamin ;
$m_zmos    = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Mosaghaf ;
$t_shagel   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->TedadEshteghal ;
$cod_p   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->PostalCode ;
$ShenaseKasboKar   = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->ShenaseKasboKar ;
if($cod_jen == 0)
 { 
$v_jens = 'مرد' ;
$jens2 = '1' ;
} 
else
{
$v_jens = 'زن' ;
$jens2 = '2' ;
 }

$test = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Products ; 
$object = (array)($test) ; 
$count = count($object['Products']) ; 
$t_mah   = $count ;

$test1  = $res->GetLicenseInfoByIdentCodeResult->LicenseInfo->Gis ; 
$object1 = (array)($test1) ; 
$X1      = $object1['Gis'][0]->X ; 
$Y1      =  $object1['Gis'][0]->Y ; 
$Z1      = $object1['Gis'][0]->Z ; 
$Zone1   = $object1['Gis'][0]->Zone ; 
$X2      = $object1['Gis'][1]->X ; 
$Y2      =  $object1['Gis'][1]->Y ; 
$Z2      = $object1['Gis'][1]->Z ; 
$Zone2   = $object1['Gis'][1]->Zone ; 

$X3      = $object1['Gis'][2]->X ; 
$Y3      =  $object1['Gis'][2]->Y ; 
$Z3      = $object1['Gis'][2]->Z ; 
$Zone3   = $object1['Gis'][2]->Zone ; 

$X4      = $object1['Gis'][3]->X ; 
$Y4      =  $object1['Gis'][3]->Y ; 
$Z4      = $object1['Gis'][3]->Z ; 
$Zone4   = $object1['Gis'][3]->Zone ; 
}
$query = "SELECT count(*) FROM  ind_unit WHERE  ShenaseKasboKar = $ShenaseKasboKar  " ;
$stmt = $dbh->prepare($query);
$stmt -> execute();
$count = $stmt->fetchColumn();
if ($count > 0 ) 
{ 
//alert('شناسه کسب کار این واحد در سیستم موجود هست در صورت ادامه  اطلاعات بروز رسانی خواهد شد ')  ; 
$query = "SELECT * from ind_bah WHERE  ShenaseKasboKar = $ShenaseKasboKar";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$email = $row['email'] ; 
$m_tah = $row['m_tah'] ;

$query = "SELECT * from ind_unit WHERE  ShenaseKasboKar = $ShenaseKasboKar";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$v_ab = $row['v_ab'] ; 
   $v_ab1 = $row['v_ab'] ;
   $g_en1 = $row['g_en'] ;
   $v_ch = $row['v_ch'] ;
   $no_mch = $row['no_mch'] ;
   $date_mch = $row['date_mch'] ;
   $y_mch = substr($date_mch,0,4);
   $m_mch = substr($date_mch,5,2) ;
   $d_mch = substr($date_mch,8,2) ;
   $v_bar = $row['v_bar'] ;
   $amp1 = $row['amp'] ;
   $t_faz1 = $row['t_faz'] ;
   $v_gaz = $row['v_gaz'] ;
   $v_tas = $row['v_tas'] ;
   $no_tas1 = $row['no_tas'] ;
   $v_tah = $row['v_tah'] ;
   $v_rd = $row['v_rd'] ;
}
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .style10 {color: #FF0000}
    .style11 {font-size: 14px}
    .size:hover
    {
        width: 20px;
        height:19px ;
    }
</style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
        });
    </script>
    <!--دریافت اطلاعات مالک -->
    <script type="text/javascript">
        $(document).ready(function()
        {
            $(".Mcod_m").change(function()
            {
                var id=$(this).val();
                var dataString = 'cod_m='+ id;
                $.ajax
                ({
                    type: "POST",
                    url: "select_mar.php",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        $(".mar").html(html);
                    }
                });

            });
        });
$(document).ready(function() {
      $(".vtas_comment").hide();
      $(".vbar_comment").hide();
      $(".vch_comment").hide();
      $(".vab_comment").hide();
	  <?php if($v_ab == '1') {?>$(".vab_comment").show();<?php }?>
	  <?php if($v_ch == '1') {?>$(".vch_comment").show();<?php }?>
	  <?php if($v_bar == '1') {?>$(".vbar_comment").show();<?php }?>
	  <?php if($v_tas == '1') {?>$(".vtas_comment").show();<?php }?>

  $("#v_ab").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vab_comment").show();
    } else if (value == "2") {
      $(".vab_comment").hide();
     document.getElementById("g_en").disabled = true;
    } 
  });

  $("#v_ch").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vch_comment").show();
    } 
	 if (value == "2") {
      $(".vch_comment").hide();
     document.getElementById("y_mch").disabled = true;
	 document.getElementById("m_mch").disabled = true;
	 document.getElementById("d_mch").disabled = true;
	 document.getElementById("no_mch").disabled = true;
    } 
  });

  $("#v_bar").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vbar_comment").show();
    } else if (value == "2") {
      $(".vbar_comment").hide();
     document.getElementById("t_faz").disabled = true;
	 document.getElementById("amp").disabled = true;
    } 
  });

  $("#v_tas").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vtas_comment").show();
    } else if (value == "2") {
      $(".vtas_comment").hide();
	  <?php $no_tas = '1' ; ?>
    } 
  });
});
</script>
    <!-- پایان دریافت اطلاعات مالک -->
</head>
<body>
<div id="rasul" style="width: 100%; height: 100%; background: #726d6d; display: none;  opacity: 0.6; position: fixed; z-index: 4;">
   <img src="img/loading2.gif" style="margin: auto;float: right;z-index: 93;width: 90px;min-height: 50px;position: fixed;left: 0;right: 0;margin: 200px auto;">
</div>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
    </tr>
    <tr>
        <td><?php include('menu.php'); ?>
        </td>
    </tr>
    <tr>
        <td>
 <?php include('top.php'); ?>
 <p class="style8">ثبت اطلاعات واحد صنعتی جدید<br />
   <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
<td width="4"><p>&nbsp;</p>
                        <p>&nbsp;</p></td>
                    <td width="840" >
                        <form action="" method="post" id="form1" name="form1">
                          <table width="95%" height="1225" border="0" align="center" cellpadding="0" cellspacing="0" id=" " style="border:3px solid #069;">
                                <tr>
                                  <td height="40" colspan="7"  align="right" >
                                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  s="s" >
                                    <tr>
                                      <?php  if ($no_bah=='1') { ?>
                                      <td height="22" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی  </strong></div></td>
                                    </tr>
                                    <tr>
                                      <td width="208" height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $last_name ; ?></div></td>
                                      <td width="151" bgcolor="#FFFFFF"><div align="right">:نام خانوادگی</div></td>
                                      <td width="34" rowspan="5" bgcolor="#FFFFFF">&nbsp;</td>
                                      <td width="225" bgcolor="#FFFFFF"><div align="right"><?php echo $bah_name ; ?></div></td>
                                      <td width="233" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
                                    </tr>
                                    <tr>
                                      <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $sh_sh ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div align="right">:شماره شناسنامه</div></td>
                                      <td bgcolor="#FFFFFF"><div align="right"><?php echo $NationalCode ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:کد ملی</div></td>
                                    </tr>
                                    <tr>
                                      <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $date_t ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div align="right">:تاریخ تولد</div></td>
                                      <td bgcolor="#FFFFFF"><div align="right"><?php echo $fname ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:نام پدر</div></td>
                                    </tr>
                                    <tr>
                                      <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                      <td bgcolor="#FFFFFF">&nbsp;</td>
                                      <td bgcolor="#FFFFFF"><div align="right"><?php echo $v_jens ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:جنسیت</div></td>
                                    </tr>
                                    <tr>
                                      <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $tel_m ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div align="right">:شماره همراه</div></td>
                                      <td bgcolor="#FFFFFF"><div align="right"><?php echo $tel_s ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
                                    </tr>
                                    <tr>
                                      <td height="30" colspan="4" bgcolor="#FFFFFF"><div align="right"><?php echo $addres ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:آدرس</div></td>
                                    </tr>
                                    <tr>
                                      <td height="45" bgcolor="#FFFFFF"><div align="right"><?php echo $r_tah ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div align="right">:رشته تحصیلی</div></td>
                                      <td rowspan="2"  class="style8">&nbsp;</td>
                                      <td><div align="right">
         <select name="m_tah" class="required" id="m_tah" style="height:40px ; width:150px ; direction:rtl" tabindex="2">
         <option value="">انتخاب کنید</option>
         <option value="1" <?php if($m_tah=="1") echo "selected='selected'"?>>بیسواد</option>
         <option value="2" <?php if($m_tah=="2") echo "selected='selected'"?>>خواندن و نوشتن</option>
         <option value="3" <?php if($m_tah=="3") echo "selected='selected'"?>>سیکل</option>
         <option value="4" <?php if($m_tah=="4") echo "selected='selected'"?>>دیپلم</option>
         <option value="5" <?php if($m_tah=="5") echo "selected='selected'"?>>فوق دیپلم</option>
         <option value="6" <?php if($m_tah=="6") echo "selected='selected'"?>>لیسانس</option>
         <option value="7" <?php if($m_tah=="7") echo "selected='selected'"?>>فوق لیسانس</option>
         <option value="8" <?php if($m_tah=="8") echo "selected='selected'"?>>دکتری</option>
         <option value="9" <?php if($m_tah=="9") echo "selected='selected'"?>>تحصیلات حوزوی</option>
         </select>
                                      </div></td>
                                      <td><div style="margin-right:30px" align="right" >:مدرک تحصیلی</div></td>
                                    </tr>
                                    <tr>
                                      <td height="34"><div align="right">
                                        <input name="email" type="text" class="required email" id="email" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $email ; ?>" maxlength="75" xml:lang="fa"/>
                                      </div></td>
                                      <td><div align="right">:آدرس پست الکترونیک</div></td>
                                      <td><div align="right">
                                      <?php echo $cod_p ; ?></div></td>
                                      <td><div style="margin-right:30px" align="right" >:کد پستی</div></td>
                                    </tr>
                                    <tr>
                                      <?php }  if ($no_bah=='2') { ?>
                                      <td height="22" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی </strong></div></td>
                                    </tr>
                                    <tr>
                                      <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $NationalCode; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div align="right">:شناسه ملی</div></td>
                                      <td rowspan="4" bgcolor="#FFFFFF">&nbsp;</td>
                                      <td bgcolor="#FFFFFF"><div align="right"><?php echo $unit_name ; ?><br />
                                      </div></td>
                                      <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام شرکت </div></td>
                                    </tr>
                                    <tr>
                                      <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $no_co ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div align="right">: نوع شرکت</div></td>
                                      <td bgcolor="#FFFFFF"><div align="right"><?php echo $co_sabt ; ?> -- <?php echo $date_sabt ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: تاریخ و شماره ثبت شرکت</div></td>
                                    </tr>
                                    <tr>
                                      <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $c_cod_m ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div align="right">: کد ملی مدیرعامل</div></td>
                                      <td bgcolor="#FFFFFF"><div align="right"><?php echo $c_name ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام و نام خانوادگی مدیرعامل</div></td>
                                    </tr>
                                    <tr>
                                      <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $tel_m ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div align="right">:شماره همراه</div></td>
                                      <td bgcolor="#FFFFFF"><div align="right"><?php echo $tel_s ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >: تلفن ثابت</div></td>
                                    </tr>
                                    <tr>
                                      <td height="30" colspan="4" bgcolor="#FFFFFF"><div align="right"><?php echo $addres ; ?></div></td>
                                      <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:آدرس</div></td>
                                    </tr>
                                    <tr>
                                      <td height="34"><div align="right">
                                        <input name="email" type="text" class="required email" id="email" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $email ; ?>" maxlength="75" xml:lang="fa"/>
                                      </div></td>
                                      <td><div align="right">:آدرس پست الکترونیک</div></td>
                                      <td  class="style8">&nbsp;</td>
                                      <td><div align="right">
                                        <div align="right"> <?php echo $cod_p ; ?></div>
                                      </div></td>
                                      <td><div style="margin-right:30px" align="right" >:کد پستی</div></td>
                                    </tr>
                                    <?php  }?>
                                  </table></td>
                                </tr>
                                <tr>
                                    <td height="32" colspan="7" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
                                </tr>
                                <tr>
                                    <td width="30" height="28" colspan="2"><div align="right"> <?php echo city_name1($id_city1,$id_ostan1) ?></div></td>
                                    <td width="21%"><div align="right">:شهرستان</div></td>
                                    <td width="1%">&nbsp;</td>
                                    <td width="27" colspan="2"><div align="right"><?php echo ostan_name($id_ostan1) ; ?></div></td>
                                    <td width="21%"><div style="margin-right:30px" align="right">: استان</div></td>
                                </tr>
                                <tr>
                                    <td height="47" colspan="2"><div align="right"> <?php echo $shahr; ?><?php echo $abadi ; ?></div></td>
                                    <td><div align="right">: آبادی/شهر</div></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><div align="right"> <?php echo $mar ; ?></div></td>
                                    <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
                                </tr>
                                <tr>
                                    <td height="43" colspan="2"><div align="right"> <?php echo $no_mal; ?></div></td>
                                    <td><div align="right">:نوع مالکیت</div></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><div align="right"><?php echo $unit_name ; ?></div></td>
                                    <td><div style="margin-right:30px" align="right" >:نام واحد</div></td>
                                </tr>
                                <tr>
                                  <td height="46"><div align="right" class="style2"> متر مربع </div></td>
                                  <td><div align="right"><?php echo $m_zmos ;  ?></div></td>
                                  <td height="46"><div align="right">:مساحت مسقف</div></td>
                                  <td height="46">&nbsp;</td>
                                  <td height="46"><div align="right" class="style2">  متر مربع </div></td>
                                  <td><div align="right"> <?php echo $m_zamin; ?></div></td>
                                  <td><div style="margin-right:30px" align="right">:مساحت  زمین</div></td>
                                </tr>
                                <tr>
                                  <td height="30" colspan="7" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مختصات جغرافیایی</strong></div></td>
                            </tr>
                                <tr>
                                  <td height="46" colspan="7"><table width="95%" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr class="style8">
                                      <td width="28%">Zone</td>
                                      <td width="22%">Z</td>
                                      <td width="29%">Y</td>
                                      <td width="21%"> X</td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $Zone1; ?></td>
                                      <td><?php echo $Z1; ?></td>
                                      <td><?php echo $Y1; ?></td>
                                      <td><?php echo $X1; ?></td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $Zone2; ?></td>
                                      <td><?php echo $Z2; ?></td>
                                      <td><?php echo $Y2; ?></td>
                                      <td><?php echo $X2; ?></td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $Zone3; ?></td>
                                      <td><?php echo $Z3; ?></td>
                                      <td><?php echo $Y3; ?></td>
                                      <td><?php echo $X3; ?></td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $Zone2; ?></td>
                                      <td><?php echo $Z4; ?></td>
                                      <td><?php echo $Y4; ?></td>
                                      <td><?php echo $X4; ?></td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="30" colspan="7" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات تکمیلی </strong></div></td>
                                </tr>
                                <tr>
                                  <td height="46"><div align="right"><span class="style2"> میلیون ریال</span></div></td>
                                  <td height="46"><div align="right"><?php echo $sarmayeh_d; ?></div></td>
                                  <td height="46"><div align="right">:سرمایه در گردش</div></td>
                                  <td height="46">&nbsp;</td>
                                  <td height="46"><div align="right"><span class="style2"> میلیون ریال</span></div></td>
                                  <td height="46"><div align="right"><?php echo $sarmayeh_s; ?></div></td>
                                  <td><div style="margin-right:30px" align="right">:سرمایه ثابت</div></td>
                                </tr>
                                <tr>
                                  <td height="43" colspan="2"><div dir="rtl" align="right"> از <?php echo $start_date;  ?> لغایت <?php echo $end_date ;  ?></div></td>
                                  <td><div align="right">:تاریخ  اعتبار</div></td>
                                  <td>&nbsp;</td>
                                  <td colspan="2"><div align="right"><?php echo $identCode ; ?></div></td>
                                  <td><div style="margin-right:30px" align="right" >:شماره پروانه بهره برداری</div></td>
                                </tr>
                                <tr>
                                  <td height="43" colspan="2"><div dir="rtl" align="right"><?php echo $t_mah;  ?></div></td>
                                  <td><div align="right">:تنوع محصول تولیدی</div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="right" class="style2">نفر </div></td>
                                  <td><div align="right"><?php echo $t_shagel; ?></div></td>
                                  <td><div style="margin-right:30px" align="right" >:تعداد اشتغال</div></td>
                                </tr>
                                <tr>
                                  <td height="29" colspan="7" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>منابع و تجهیزات</strong></div></td>
                                </tr>
                                <tr>
                                  <td height="170" colspan="7">
                                    <table width="793" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td height="42" colspan="3">&nbsp;</td>
                                      <td width="14%" ><div align="center" class="vab_comment" >
                            <input name="g_en" type="text" class="input_text number required >" id="g_en" style="width:75px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $g_en1 ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                                      </div></td>
                                      <td width="12%" ><div align="right" class="vab_comment"> :قطر انشعاب</div></td>
                                      <td width="21%"><div align="center">
                             <select name="v_ab" class="required input_text " id="v_ab" style="height:40px ; width:120px ; direction:rtl" tabindex="20">
                             <option value="">انتخاب کنید</option>
                             <option    value="1"<?php if ($v_ab == '1') echo "selected='selected'"?>>دارد</option>
                             <option    value="2"<?php if ($v_ab == '2') echo "selected='selected'"?>>ندارد</option>
                             </select>
                                      </div></td>
                                      <td width="16%"><div align="right" > :آب لوله کشی</div></td>
                                    </tr>
                                    <tr>
                                      <td width="25%" height="40"><div align="right" class="vch_comment">
 <input name="y_mch" type="text" class="input_text number required" id="y_mch" style="width:50px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $y_mch ; ?>"min="0" max="1400" maxlength="4" minlength="4" align="baseline" xml:lang="fa" />
                                        /
  <input name="m_mch" type="text" class="input_text number required" id="m_mch" style="width:30px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $m_mch; ?>" min="0" max="12" maxlength="2" minlength="2"  align="baseline" xml:lang="fa" />
                                        /
  <input name="d_mch" type="text" class="input_text number required" id="d_mch" style="width:30px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $d_mch ; ?>" min="0" max="31" maxlength="2" minlength="2"  align="baseline" xml:lang="fa" />
                                      </div></td>
                                      <td colspan="2"> <div align="right" class="vch_comment"> :تاریخ مجوز</div></td>
                         <td><div align="center" class="vch_comment">
  <input name="no_mch"  type="text" class="input_text number required" id="no_mch" style="width:75px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $no_mch ; ?>" maxlength="15"  align="baseline" xml:lang="fa" />
                                      </div></td>
                                      <td><div align="right" class="vch_comment"> :شماره مجوز </div></td>
                                      <td><div align="center">
                                        <select name="v_ch" class="required input_text  " id="v_ch"  style="height:40px ; width:120px ; direction:rtl" tabindex="22">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_ch == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_ch == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td><div align="right" > :آب چاه</div></td>
                                    </tr>
                                    <tr>
                                      <td height="44"><div align="right" class="vbar_comment">
                                        <input name="amp" type="text" class="input_text number required" id="amp" style="width:50px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $amp1 ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
                                      </div></td>
                                      <td colspan="2"><div align="right" class="vbar_comment"> :آمپر</div></td>
                                      <td><div align="center" class="vbar_comment">
                                        <input name="t_faz" type="text" class="input_text number required" id="t_faz" style="width:75px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $t_faz1 ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
                                      </div></td>
                                      <td> <div align="right" class="vbar_comment"> :تعداد فاز</div></td>
                                      <td><div align="center">
                                        <select name="v_bar" class="required input_text  " id="v_bar"  style="height:40px ; width:120px ; direction:rtl" tabindex="27">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_bar == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_bar == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td><div align="right" > :انشعاب برق</div></td>
                                    </tr>
                                    <tr>
                                      <td height="42" colspan="5">&nbsp;</td>
                                      <td><div align="center">
                                        <select name="v_gaz" class="required input_text  " id="v_gaz"  style="height:40px ; width:120px ; direction:rtl" tabindex="30">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_gaz == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_gaz == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td><div align="right" > :انشعاب گاز</div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="99" colspan="7"><table width="795" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td width="39%" height="42"><div align="right" class="vtas_comment">
                                        <select name="no_tas" class="required input_text  " id="no_tas"  style="height:40px ; width:120px ; direction:rtl" tabindex="32">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($no_tas == '1') echo "selected='selected'"?>>سپتیک</option>
                                          <option value="2"<?php if ($no_tas == '2') echo "selected='selected'"?>>صنعتی</option>
                                        </select>
                                      </div></td>
                                      <td width="24%"><div align="right" class="vtas_comment"> :نوع تصفیه</div></td>
                                      <td width="21%"><div align="center">
                                        <select name="v_tas" class="required input_text" id="v_tas"  style="height:40px ; width:120px ; direction:rtl" tabindex="31">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_tas == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_tas == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td width="16%"><div align="right" > :تصفیه خانه</div></td>
                                    </tr>
                                    <tr>
                                      <td><div align="right">
                                        <select name="v_rd" class="required input_text  " id="m_vaz_sok7"  style="height:40px ; width:120px ; direction:rtl" tabindex="34">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_rd == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_rd == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td><div align="right" > :R&amp;Dواحد تحقیق و توسعه <br />
                                      </div></td>
                                      <td height="57"><div align="center">
                                        <select name="v_tah" class="required input_text  " id="m_vaz_sok6"  style="height:40px ; width:120px ; direction:rtl" tabindex="33">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_tah == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_tah == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td><div align="right" > :تهویه هوا</div></td>
                                    </tr>
                                  </table></td>
                            </tr>
                          </table>
                            <div align="center">
                              <p>
                    <input type="hidden" name="NationalCode" value=<?php echo $NationalCode; ?> />
                    <input type="hidden" name="identCode" value=<?php echo $identCode; ?> />
                    <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
                    <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
                    <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
                    <input type="hidden" name="t_mah" value=<?php echo $t_mah; ?> />
                    <input type="hidden" name="no_mal" value=<?php echo $no_mal; ?> />
                    <input type="hidden" name="jens2" value=<?php echo $jens2; ?> />
      <input  type="submit" name="action" value="ثبت و ادامه" style="width:150px ; height:45px" tabindex="35" id="submit" 
      onClick="setTimeout(disableFunction, 1);"/>
             <a href="index.php">
             <input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="36" /></a>
                              </p>
                          </div>
                      </form>
                      <script>

                            $('#submit').click(function () {

                                $('#rasul').css('display', 'block');
                                setTimeout(function () {
                                    $('#rasul').css('display', 'none');
                                },3000)

                              
                            },3000)


                            function disableFunction() {
                                document.getElementById("submit").disabled = 'true';
                                $("#submit").attr("disabled","");
                            }
                        </script>
                    </td>
                </tr>
                <?php
                }
                else
                {
                    ?>
                    <form  name="myform" class="myform" method="post" action="index.php">
                    </form>
                    <script type="text/javascript">document.myform.submit();</script>
                    <?php
                }
                ?>
                <tr>
                    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
                </tr>
          </table>
</table>
</body>
</html>