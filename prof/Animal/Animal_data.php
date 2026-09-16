<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');
include('../../web/dam_unitDetails.php'); // توابع برای دریافت اطلاعات واحد از پنجره واحد 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;

/////////////////////////////////////////////////// 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['action_sabt']) || isset($_POST['action_sabt_go']))) {
   $polygonData = $_POST['polygonData'] ;
    $partIDCode = $_POST['partIDCode'];
    $Longitude  = $_POST['Longitude'];
    $Latitude   = $_POST['Latitude'];
    $date_s     = $date_edit ;
     $mor_cod_m  = $login_session ;
    $add_city   = $_POST['add_city'] ;
    $add_abadi   = $_POST['add_abadi'] ;
  if (strlen($add_city) <10) $add_city = '-' ; 
  if (strlen($add_abadi) <16) $add_abadi = '-' ; 
    $vaz_s = $_POST['vaz_s'] ;
   $num_bah = $_POST['num_bah']; 

  $bah_cod_m         =  $_POST['bah_cod_m']; 
    $epidemiologic     = $_POST['epidemiologic']; 
    $unit_postal_code  = $_POST['unit_postal_code']; 
	$postal_address    =  $_POST['postal_address']  ;
	$unit_name         =  $_POST['unit_name']; 
    $unitTypes         = $_POST['unitTypes']; 
    $capacity    = $_POST['capacity']; 
    $license_status = $_POST['license_status']; 
    $rentStatus    = $_POST['rentStatus']; 
    $active_status   = $_POST['active_status']; 
    $entry_date     = $_POST['entry_date']; 

    $docNum = $_POST['docNum'] ; 
    $Product_Name = $_POST['Product_Name'] ; 
    $isikCode = $_POST['isikCode'] ; 
    $licenseType = $_POST['licenseType'] ; 
    $validityDate = $_POST['validityDate'] ; 



    try {
        // ذخیره اطلاعات در دیتابیس
// بررسی وجود PartIdCode در جدول
$stmt_check = $dbh->prepare("SELECT COUNT(*) FROM animals_unit WHERE PartIdCode = :partIDCode");
$stmt_check->execute(array(':partIDCode' => $partIDCode));
$recordExists = $stmt_check->fetchColumn();

if ($recordExists == 0) {
    // اگر وجود نداشت، INSERT انجام بده
$stmt = $dbh->prepare("INSERT INTO animals_unit (
    date_s,
    PartIdCode,
    bah_cod_m,
    longitude,
    latitude,
    coordinates ,
    epidemiologic,
    unit_postal_code,
    postal_address,
    unit_name,
    unit_types,
    capacity,
    license_status,
    rent_status,
    active_status,
    entry_date,
    mor_cod_m,
    add_city,
    add_abadi,
    id_ostan,
    id_city,
    id_mar,
    vaz_s,
    num_bah,

Product_Name, 
isikCode, 
licenseType, 
validityDate, 
docNum


) VALUES (
    :date_s,
    :partIDCode,
    :bah_cod_m,
    :Longitude,
    :Latitude,
    :coordinates ,
    :epidemiologic,
    :unit_postal_code,
    :postal_address,
    :unit_name,
    :unit_types,
    :capacity,
    :license_status,
    :rent_status,
    :active_status,
    :entry_date,
    :mor_cod_m,
    :add_city,
    :add_abadi,
    :id_ostan,
    :id_city,
    :id_mar,
    :vaz_s,
    :num_bah,
:Product_Name, 
:isikCode, 
:licenseType,
:validityDate, 
:docNum
)");

$stmt->execute(array(
    ':date_s' => $date_edit,
    ':partIDCode' => $partIDCode,
    ':bah_cod_m' => $bah_cod_m,
    ':Longitude' => $Longitude,
    ':Latitude' => $Latitude,
	':coordinates' => $polygonData , 
    ':epidemiologic' => $epidemiologic,
    ':unit_postal_code' => $unit_postal_code,
    ':postal_address' => $postal_address,
    ':unit_name' => $unit_name,
    ':unit_types' => $unitTypes,
    ':capacity' => $capacity,
    ':license_status' => $license_status,
    ':rent_status' => $rentStatus,
    ':active_status' => $active_status,
    ':entry_date' => $entry_date,
    ':mor_cod_m' => $mor_cod_m,
    ':add_city' => $add_city,
    ':add_abadi' => $add_abadi,
    ':id_ostan' => $id_ostan,
    ':id_city' => $id_city,
    ':id_mar' => $id_mar,
    ':vaz_s' => $vaz_s,
    ':num_bah' => $num_bah,
   ':Product_Name' =>    $Product_Name ,
   ':isikCode' =>    $isikCode ,
   ':licenseType' =>    $licenseType ,
   ':validityDate' =>    $validityDate ,
      ':docNum' =>    $docNum 
));
	alert('اطلاعات واحد با موفقیت ثبت شد');
    sabt_event($login_session,getUserIP_1(),$date_s,$time,$add_abadi,'ثبت واحد پرورش دام-'.$bah_cod_m,$id_ostan) ; 	
} else {
    // اگر وجود داشت، UPDATE انجام بده
    $stmt = $dbh->prepare("UPDATE animals_unit SET
        date_s = :date_s,
        bah_cod_m = :bah_cod_m,
        longitude = :Longitude,
        latitude = :Latitude,
		coordinates = :coordinates ,
        epidemiologic = :epidemiologic,
        unit_postal_code = :unit_postal_code,
        postal_address = :postal_address,
        unit_name = :unit_name,
        unit_types = :unit_types,
        capacity = :capacity,
        license_status = :license_status,
        rent_status = :rent_status,
        active_status = :active_status,
        entry_date = :entry_date,
        Product_Name = :Product_Name, 
        isikCode = :isikCode, 
        licenseType = :licenseType,
        validityDate = :validityDate , 
        docNum = :docNum 
    WHERE PartIdCode = :partIDCode");

    $stmt->execute(array(
        ':date_s' => $date_edit,
        ':partIDCode' => $partIDCode,
        ':bah_cod_m' => $bah_cod_m,
        ':Longitude' => $Longitude,
        ':Latitude' => $Latitude,
		':coordinates' => $polygonData ,
        ':epidemiologic' => $epidemiologic,
        ':unit_postal_code' => $unit_postal_code,
        ':postal_address' => $postal_address,
        ':unit_name' => $unit_name,
        ':unit_types' => $unitTypes,
        ':capacity' => $capacity,
        ':license_status' => $license_status,
        ':rent_status' => $rentStatus,
        ':active_status' => $active_status,
        ':entry_date' => $entry_date,
        ':Product_Name' => $Product_Name, 
        ':isikCode' => $isikCode, 
        ':licenseType' => $licenseType,
        ':validityDate' => $validityDate ,
        ':docNum' => $docNum 
    ));
alert('اطلاعات واحد با موفقیت بروزرسانی شد');
sabt_event($login_session,getUserIP_1(),$date_s,$time,$add_abadi,'ویرایش واحد پرورش دام-'.$bah_cod_m,$id_ostan) ; 
}
       

//        echo "<p style='color: green; font-size: 18px;'>اطلاعات با موفقیت ذخیره شد.</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red; font-size: 18px;'>خطا در ثبت اطلاعات: " . $e->getMessage() . "</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action_sabt_go'])) { ?>
<form id="hiddenForm"    action="AnimalStats.php" method="POST">
    <input type="hidden" name="partIDCode" value="<?php echo $partIDCode ?>"> <!-- مقدار شناسه یکتا -->
    <input type="hidden" name="no_fa" value="<?php echo $unitTypes ?>"> <!-- مقدار شناسه یکتا -->
    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ?>"> <!-- مقدار شناسه یکتا -->
    <input type="hidden" name="capacity" value="<?php echo $capacity ?>"> <!-- مقدار شناسه یکتا -->
    <input type="hidden" name="epidemiologic" value="<?php echo $epidemiologic ?>"> <!-- مقدار شناسه یکتا -->
    <input type="hidden" name="sal" value="1403"> <!-- مقدار سال -->
</form>
<script>
    // ارسال خودکار فرم پس از بارگذاری صفحه
    document.getElementById("hiddenForm").submit();
</script>
<?php
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['action_sabt']) || isset($_POST['cancel']))) {
 ?>
<form id="hiddenForm"    action="Animal.php" method="POST">
</form>
<script>
    // ارسال خودکار فرم پس از بارگذاری صفحه
    document.getElementById("hiddenForm").submit();
</script>
<?php
}


/////////////////////////////////////////////// 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
        }
        .form-container {
            border: 2px solid #09C;
            padding: 15px;
            border-radius: 15px;
            background-color: #fff;
            margin-bottom: 20px;
            display: inline-block;
        }
        .info-container, .map-container {
            border: 2px solid #ccc;
            padding: 20px;
            width: 48%;
            box-sizing: border-box;
            background-color: #fff;
        }
        .unit_table {
            width: 100%;
            border-collapse: collapse;
        }
        .unit_table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
			text-align:right ;
        }
        #map {
            height: 400px;
            width: 100%;
        }
        .container {
            display: flex;
            justify-content: space-between;
        }

        .info-container {
            order: 2;
        }

        .map-container {
            order: 1;
        }
form {
    padding: 20px;
	margin-top:15px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

/* استایل برای ردیف‌های فرم */
.form-row {
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* استایل برای برچسب‌ها (لیبل‌ها) */
.form-row label {
    width: 40%;
    text-align: right;
    font-weight: bold;
    margin-right: 10px;
	font-size:16px
}

/* استایل برای فیلدهای ورودی */
.form-row input[type='text'] {
    width: 50%;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* استایل برای دکمه ثبت */
.form-row1 {
    display: flex;
    justify-content: space-between; /* فاصله بین دکمه‌ها */
    gap: 10px; /* فاصله بین دکمه‌ها */
    margin-top: 15px;
}

/* استایل دکمه‌ها */
.form-row1 button {
    width: 48%; /* هر دکمه 48% از عرض ردیف */
    padding: 15px;
    color: white;
    font-family:myfont;
    font-size: 18px;
    border: none;
    cursor: pointer;
    border-radius: 5px; /* گوشه‌های گرد */
}
.form-row1 button[value='submit_exit'] {
    background-color: green;
}
.form-row1 button[value='submit_exit']:hover {
    background-color: darkgreen;
}
.form-row1 button[value='cancel'] {
    width: 100%; /* هر دکمه 48% از عرض ردیف */
    padding: 15px;
    color: white;
    font-family:myfont;
    font-size: 18px;
	font-weight:bold ; 
    border: none;
    cursor: pointer;
    border-radius: 5px; /* گوشه‌های گرد */
    background-color:#903;
}
.form-row1 button[value='cancel']:hover {
    background-color:#F30 ;
}  
/* استایل دکمه ثبت و ادامه */
.form-row1 button[value='submit_continue'] {
    background-color: blue;
}

.form-row1 button[value='submit_continue']:hover {
    background-color: darkblue;
}    </style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td>
      <?php include('top.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['partIDCode'])) {

$add_abadi = $_POST["add_abadi"]; 
$add_city  = $_POST["add_city"]; 
$bah_cod_m = $_POST['bah_cod_m'];
$num_bah = $_POST['num_bah']; 
$vaz_s    = $_POST['vaz_s'];
if($vaz_s =='1') $v_vaz_s = 'ساکن' ;
if($vaz_s =='2') $v_vaz_s = 'غیر ساکن' ;
if($vaz_s =='3') $v_vaz_s = 'عشایر' ;
$partIDCode = $_POST['partIDCode'];
$docNum = $_POST['docNum'];
if($docNum > 0 ) {
// شروع سماک 
    include('../../web/dam_LicenseDetails.php'); // توابع برای دریافت اطلاعات مجوز از سامانه سماک 
    $licensData = getLicenseDetails($docNum,$bah_cod_m) ; 
    if (isset($licensData['error'])) {
        //echo "<p style='color: red; font-size: 18px;'>" . $unitData['error'] . "</p>";
       // exit;
	   alert ('پاسخ استعلام از سامانه سماک :'.$licensData['error']) ;
?>
<form  name="myform" class="myform" method="post" action="Animal.php">
      </form>
<script type="text/javascript">document.myform.submit();</script>
<?php
    }
$plan_id =   $licensData['plan_id'];
$planTypeName =   $licensData['planTypeName'];
$Product_Name =  $licensData['productName'];
$isikCode = $licensData['isikCode'];
$postalCode =  $licensData['postalCode'];
$address =  $licensData['address'];
$validityDate =  $licensData['validityDate'];
$totalCapacity =  $licensData['totalCapacity'];
$licenseType =  $licensData['licenseType'];
// پایان سماک
}

    $unitData = getUnitDetails($partIDCode); // فراخوانی تابع
    // بررسی خطاها
    if (isset($unitData['error'])) {
        //echo "<p style='color: red; font-size: 18px;'>" . $unitData['error'] . "</p>";
       // exit;
	   alert ('پاسخ استعلام از پنجره واحد :'.$unitData['error']) ;
?>
<form  name="myform" class="myform" method="post" action="Animal.php">
      </form>
<script type="text/javascript">document.myform.submit();</script>
<?php

    }

    // بررسی اینکه UnitGroup برابر با 1 باشد
    if ($unitData['UnitGroup'] != 1) {
	   alert ('پاسخ استعلام پنجره واحد : شناسه یکتا مربوط به دامداری نیست') ;
?>
<form  name="myform" class="myform" method="post" action="Animal.php">
<input name="com_alert" type="hidden" value="پاسخ استعلام پنجره واحد : شناسه یکتا مربوط به دامداری نیست"  />
      </form>
<script type="text/javascript">document.myform.submit();</script>
<?php
    }
    if ( $bah_cod_m != $unitData['OwnerNationalcode']) {
?>
<form  name="myform" class="myform" method="post" action="Animal.php">
<input name="com_alert" type="hidden" value="پاسخ استعلام پنجره واحد : کد ملی بهره بردار/مدیرعامل صحیح نیست"  />
      </form>
<script type="text/javascript">document.myform.submit();</script>
<?php
	}
 if($id_ostan == '31' and $unitData['Ostan'] == '08' ) 
 {
$unitData['Ostan'] = $id_ostan ; 
//$unitData['Shahrestan'] = $id_city ; 
alert('این شناسه یکتا در پنجره واحد استان کرمان ثبت شده است . جهت تسریع در ثبت، با جنوب کرمان مطابقت داده شد. ') ; 
// بررسی اطلاعات جنوب کرمان 
    }
// فرض بر این است که تابع alert() یک تابع تعریف شده در محیط شما است.

if ($unitData['Ostan'] == '09') {
    if ($unitData['Shahrestan'] == '44') {
        $unitData['Shahrestan'] = '45';
        alert('کد نادرست شهرستان در پنجره واحد جهت تسریع در ثبت تصحیح گردید.');
    } 
    else if ($unitData['Shahrestan'] == '45') {
        $unitData['Shahrestan'] = '44';
        alert('کد نادرست شهرستان در پنجره واحد جهت تسریع در ثبت تصحیح گردید.');
    }
}

else 
{
     if ( $id_ostan != $unitData['Ostan'] or $id_city != $unitData['Shahrestan'] ) {
?>
<form  name="myform" class="myform" method="post" action="Animal.php">
<input name="com_alert" type="hidden" value="پاسخ استعلام پنجره واحد : محل این واحد با استان/شهرستان محل خدمت شما مغایرت دارد "  />
      </form>
<script type="text/javascript">document.myform.submit();</script>
<?php
    }}
    $bah_cod_m     = $unitData['OwnerNationalcode'] ;
    $licenseStatus = $unitData['LicenseStatus']*1 ; 
    $rentStatus    = $unitData['RentStatus']*1 ; 
    $ActiStatus    = $unitData['Active']*1  ; 
      ?>
<div style="width: 85%; margin: 0 auto; text-align: center">
    <?php sar_data2($bah_cod_m, $num_bah); ?>
</div>
      <?php
    // نمایش اطلاعات واحد

  // اگر در سماک موجود باشد  
  if ($plan_id) 
  {
  $capacity = $totalCapacity ; 
  $cod_p = $postalCode ; 
  $licenseStatus = 1 ; 
  $unitTypes     = $plan_id+100 ; 
  }
    else 
  {
	  // استخراج PartCapacityInfo و نمایش جزئیات ظرفیت
    $capacities = $unitData['Capacities']; // فرض کنید 'Capacities' در داده‌ها موجود است
    if ($capacities) {
        foreach ($capacities as $capacity) {
     $capacity = $capacity['Amount'] ;
        }
        }
     $cod_p    = $unitData['UnitPostalCode'];
     $unitTypes     = $unitData['UnitType']*1 ; 
     $validityDate = '-' ; 
	 $licenseType = '-' ; 
	 $Product_Name = '-' ; 
	 $isikCode = '-' ; 
	 $docNum = '-' ; 
	 $address = $unitData['PostalAddress'] ; 
  }
  // پایان بررسی ظرفیت گله 
 
    $name_unitTypes =    translateUnitType($unitTypes) ;
    echo "<div class='container'>
            <div class='info-container'>
                <h2>اطلاعات واحد</h2>
                <table class='unit_table' dir='rtl'>
                    <tr><td><strong>شناسه یکتا:</strong></td><td>" . $unitData['PartIdCode'] . "</td></tr>
                    <tr><td><strong>کد اپیدمیولوژیک:</strong></td><td>" . $unitData['EpidemiologicCode'] . "</td></tr>
                    <tr><td><strong>استان:</strong></td><td>" . ostan_name($unitData['Ostan']) . "</td></tr>
                    <tr><td><strong>شهرستان:</strong></td><td>" . city_name1($unitData['Shahrestan'],$unitData['Ostan']) . "</td></tr>
                    <tr><td><strong>مرکز جهاد کشاورزی:</strong></td><td>" . $markaz . "</td></tr>
                    <tr><td><strong>آبادی/شهر:</strong></td><td>" . abadi_name($add_abadi),shahr_name($add_city) . "</td></tr>					
                    <tr><td><strong>کد پستی واحد:</strong></td><td>" .$cod_p  . "</td></tr>
                    <tr><td><strong>آدرس پستی:</strong></td><td>" . $address . "</td></tr>
                   <tr><td><strong>نام واحد:</strong></td><td>" . $unitData['UnitName'] . "</td></tr>
                    <tr><td><strong>گروه واحد:</strong></td><td> دامداری </td></tr>
                    <tr><td><strong>نوع واحد:</strong></td><td>" . $name_unitTypes . "</td></tr>
                    <tr><td><strong>نوع فعالیت:</strong></td><td>" . $Product_Name . "</td></tr>
                    <tr><td><strong> کل گله:(ظرفیت اسمی)</strong></td><td>" . $capacity . "</td></tr>
	                <tr><td><strong>وضعیت مجوز:</strong></td><td>" . translateLicenseStatus($licenseStatus) . "</td></tr>
	                <tr><td><strong>شماره مجوز:</strong></td><td>" . $docNum . "</td></tr>
	                <tr><td><strong>نوع مجوز:</strong></td><td>" . $licenseType . "</td></tr>
                    <tr><td><strong>تاریخ اعتبار:</strong></td><td>" . $validityDate . "</td></tr>
                    <tr><td><strong>وضعیت اجاره واحد:</strong></td><td>" . translateRentStatus($rentStatus) . "</td></tr>
                    <tr><td><strong>وضعیت سکونت بهره بردار:</strong></td><td>" . $v_vaz_s . "</td></tr>
                </table>
           ";
      echo "<p dir='rtl'><strong>وضعیت فعالیت:</strong> " . translateActiStatus($ActiStatus) . "</p>
                  <p dir='rtl'><strong>تاریخ ثبت تغییرات:</strong> " . $unitData['EntryDate'] . "</p>
                </div>";
    // نمایش نقشه
echo "<div class='map-container'>
        <h3>نمایش مکان روی نقشه</h3>
        <div id='map'></div>
        <script src='https://unpkg.com/leaflet@1.7.1/dist/leaflet.js'></script>
        <script src='https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js'></script>
        <link rel='stylesheet' href='https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css' />


        <!-- فرم HTML برای دریافت اطلاعات Longitude و Latitude -->
        <form method='POST' action='' style='max-width: 400px; margin: 0 auto;'>
            <!-- فیلد پنهان برای ارسال partIDCode -->
            <input type='hidden' name='partIDCode' value='". htmlspecialchars($unitData['PartIdCode'])."'>
            <input type='hidden' name='add_city' value='". htmlspecialchars($add_city)."' />
            <input type='hidden' name='add_abadi' value='". htmlspecialchars($add_abadi)."' />
            <input type='hidden' name='vaz_s' value='". htmlspecialchars($vaz_s)."' />
            <input type='hidden' name='num_bah' value='". htmlspecialchars($num_bah)."' />

            <input type='hidden' name='bah_cod_m' value='". htmlspecialchars($bah_cod_m)."'>
            <input type='hidden' name='epidemiologic' value='". htmlspecialchars($unitData['EpidemiologicCode'])."'>
            <input type='hidden' name='unit_postal_code' value='". htmlspecialchars($cod_p)."'>
            <input type='hidden' name='postal_address' value='". htmlspecialchars($address)."'>
            <input type='hidden' name='unit_name' value='". htmlspecialchars($unitData['UnitName'])."'>
            <input type='hidden' name='unitTypes' value='". htmlspecialchars($unitTypes)."'>
            <input type='hidden' name='capacity' value='". htmlspecialchars($capacity)."'>
            <input type='hidden' name='license_status' value='". htmlspecialchars($licenseStatus)."'>
            <input type='hidden' name='rentStatus' value='". htmlspecialchars($rentStatus)."'>			
            <input type='hidden' name='active_status' value='". htmlspecialchars($ActiStatus)."'>
            <input type='hidden' name='entry_date' value='". htmlspecialchars($unitData['EntryDate'])."'>


            <input type='hidden' name='Product_Name' value='". htmlspecialchars($Product_Name)."'>
            <input type='hidden' name='isikCode' value='". htmlspecialchars($isikCode)."'>

            <input type='hidden' name='docNum' value='". htmlspecialchars($docNum)."'>
            <input type='hidden' name='licenseType' value='". htmlspecialchars($licenseType)."'>
            <input type='hidden' name='validityDate' value='". htmlspecialchars($validityDate)."'>


            <!-- فیلد طول جغرافیایی -->
            <div class='form-row'>
                <input type='text' name='Longitude' id='Longitude' value='". htmlspecialchars($unitData['Longitude'])."' required>
                <label for='Longitude'>:طول جغرافیایی</label>
            </div>

            <!-- فیلد عرض جغرافیایی -->
            <div class='form-row'>
                <input type='text' name='Latitude' id='Latitude' value='". htmlspecialchars($unitData['Latitude'])."' required>
                <label for='Latitude'> :عرض جغرافیایی</label>
            </div>

            <!-- فیلد پنهان برای ارسال اطلاعات پلی‌گون -->
            <input type='hidden' name='polygonData' id='polygonData' value='' />

            <div class='form-row1'>
                <button type='submit' name='action_sabt' value='submit_exit'>ثبت و خروج</button>
                <button type='submit' name='action_sabt_go' value='submit_continue'>ثبت و ادامه</button>
            </div>

            <div class='form-row1'>
                <button type='submit' name='cancel' value='cancel'>انصراف و خروج</button>
            </div>
        </form>
<script>
    // مقداردهی به عرض و طول جغرافیایی از PHP
    var latitude = " . $unitData['Latitude'] . ";
    var longitude = " . $unitData['Longitude'] . ";

    // ایجاد نقشه و تنظیم موقعیت جغرافیایی با استفاده از مقادیر PHP
    var map = L.map('map').setView([latitude, longitude], 13);

    // اضافه کردن لایه عکس هوایی از Esri
    var esriSat = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        maxZoom: 19 , // حداکثر زوم به 19 افزایش می‌یابد
        detectRetina: true // برای بهبود کیفیت تصویر
    });

    // اضافه کردن لایه OpenStreetMap
    var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    });

    // اضافه کردن نشانگر برای مکان
    var marker = L.marker([latitude, longitude]).addTo(map)
        .bindPopup('مکان دامداری: " . $unitData['UnitName'] . "')
        .openPopup();

    // ایجاد گروه برای ذخیره پلی‌گون‌ها
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    // تنظیم ابزار رسم
    var drawControl = new L.Control.Draw({
        draw: {
            polygon: {
                allowIntersection: false, // اجازه تقاطع با خودش را نمی‌دهد
                showArea: true, // مساحت پلیگون را نشان می‌دهد
                shapeOptions: {
                    color: '#3388ff', // رنگ خطوط پلیگون
                    fillColor: '#3388ff', // رنگ داخل پلیگون
                    fillOpacity: 0.2 // شفافیت داخل پلیگون
                },
                guidelineDistance: 20, // فاصله راهنما برای رسم
                metric: true // استفاده از سیستم متریک
            },
            polyline: false, // غیر فعال کردن ابزار رسم خط
            rectangle: false, // غیر فعال کردن ابزار رسم مستطیل
            circle: false,    // غیر فعال کردن ابزار رسم دایره
            marker: false     // غیر فعال کردن ابزار رسم مارکر
        },
        edit: {
            featureGroup: drawnItems, // اجازه ویرایش پلی‌گون‌های رسم شده
            remove: true              // امکان حذف پلی‌گون‌ها
        }
    });
    map.addControl(drawControl);

    // متغیر برای ذخیره وضعیت فعال/غیرفعال بودن ابزار رسم
    var isDrawingEnabled = true;

    // رویداد رسم پلی‌گون و ذخیره آن در گروه
    map.on('draw:created', function (e) {
        var layer = e.layer;
        drawnItems.addLayer(layer);

        // استخراج مختصات پلی‌گون به صورت آرایه از [longitude, latitude]
        var latlngs = layer.getLatLngs()[0];  // دریافت مختصات پلی‌گون
        var coordinates = latlngs.map(function(latlng) {
            return [latlng.lng, latlng.lat];  // تبدیل مختصات به [longitude, latitude]
        });

        // تبدیل اطلاعات به رشته JSON و قرار دادن آن در فیلد پنهان
        document.getElementById('polygonData').value = JSON.stringify(coordinates);

        // غیرفعال کردن ابزار رسم پس از رسم اولین پلیگون
        if (isDrawingEnabled) {
            map.removeControl(drawControl); // حذف کنترل رسم
            isDrawingEnabled = false; // وضعیت ابزار رسم را غیرفعال می‌کنیم
        }

        // اضافه کردن رویداد کلیک برای حذف پلیگون
        layer.on('click', function () {
            if (confirm('آیا از حذف این پلیگون اطمینان دارید؟')) {
                drawnItems.removeLayer(layer);
                document.getElementById('polygonData').value = '';  // پاک کردن داده‌های پلیگون از فیلد پنهان

                // فعال کردن ابزار رسم پس از حذف پلیگون
                if (!isDrawingEnabled) {
                    map.addControl(drawControl); // اضافه کردن مجدد کنترل رسم
                    isDrawingEnabled = true; // وضعیت ابزار رسم را فعال می‌کنیم
                }
            }
        });
    });

    // اضافه کردن لایه‌های نقشه به نقشه
    osmLayer.addTo(map); // لایه OpenStreetMap در ابتدا نمایش داده می‌شود

    // کنترل برای سوئیچ بین لایه‌ها
    var layerControl = L.control.layers({
        'نقشه': osmLayer,
        'عکس': esriSat
    }).addTo(map);

    // تابع بروزرسانی نقشه و مارکر
    function updateMap() {
        var latitude = parseFloat(document.getElementById('Latitude').value);
        var longitude = parseFloat(document.getElementById('Longitude').value);

        // بررسی اعتبار مقادیر طول و عرض جغرافیایی
        if (!isNaN(latitude) && !isNaN(longitude)) {
            // بروزرسانی موقعیت مارکر
            marker.setLatLng([latitude, longitude]);

            // تنظیم موقعیت نقشه به موقعیت جدید
            map.setView([latitude, longitude], 13); // 13 میزان زوم نقشه
        }
    }

    // منتظر تغییر در فیلدهای طول و عرض جغرافیایی باشید
    document.getElementById('Longitude').addEventListener('input', updateMap);
    document.getElementById('Latitude').addEventListener('input', updateMap);
</script>
    </div>";
}
// نوع فعالیت
function translateUnitType($unitType) {
    $unitTypes = array(
        1  => 'واحد پرواربندی گاو',
        2  => 'واحد پرورش گاو شيري',
        3  => 'واحد پرورش گاوميش داشتی',
        4  => 'واحد پرواربندی گوسفند',
        5  => 'واحد پرورش گوسفند داشتي',
        6  => 'واحد پرورش بز',
        7  => 'واحد پرورش اسب',
        8  => 'واحد پرورش گوزن',
        9  => 'واحد پرورش شتر داشتی',
        10 => 'واحد پرورش لاما',
        11 => 'واحد پرورش سگ(گله، پليس، نگهبان و...)',
        13 => 'واحد پرورش حيوانات آزمايشگاهي(موش، خوكچه هندي، هامستر و...)',
        15 => 'واحد پرورش دام چند منظوره',
        16 => 'واحد پروش دام روستايی',
        19 => 'واحد پرورش دام مستقر در مجتمع دامپروري',
        20 => 'واحد پرواربندی گاوميش',
        21 => 'واحد پرواربندی شتر',
        22 => 'واحد پرورش آهو و جبير',
        23 => 'واحد پرورش مارال',
        24 => 'واحد پرورش كل و بز',
        25 => 'واحد پرورش قوچ و ميش',
        26 => 'واحد پرورش الاغ شيري',
        27 => 'واحد پرورش روباه (توليد پوست)',
        28 => 'واحد پرورش خرگوش',
        29 => 'واحد پروش دام غیر صنعتی',
        30 => 'واحد پرورش دام مستقر در مجموعه دامپروري' ,
		101=> 'دام صنعتی و نیمه صنعتی' ,
		110=> 'دامداری عشایری' ,
		111=> 'دامداری روستایی و غیرصنعتی'
    );
    // بازگشت ترجمه کد واحد
    return isset($unitTypes[$unitType]) ? $unitTypes[$unitType] : 'نوع واحد نامشخص';
}

// تابع برای ترجمه وضعیت پروانه
function translateLicenseStatus($licenseStatus) {
    $status = array(
        1 => 'دارای پروانه/ مجوز',
        2 => 'فاقد پروانه/ مجوز'
    );

    // بازگشت ترجمه کد وضعیت پروانه
    return isset($status[$licenseStatus]) ? $status[$licenseStatus] : 'وضعیت نامشخص';
}

// تابع برای ترجمه وضعیت اجاره واحد
function translateRentStatus($rentStatus) {
    $status = array(
        1 => 'دارای مستاجر',
        2 => 'بدون مستاجر'
    );

    // بازگشت ترجمه کد وضعیت اجاره
    return isset($status[$rentStatus]) ? $status[$rentStatus] : 'وضعیت نامشخص';
}

// تابع برای ترجمه وضعیت فعالیت واحد
function translateActiStatus($ActiStatus) {
    $status = array(
        1 => 'فعال',
        2 => 'غیرفعال'
    );

    // بازگشت ترجمه کد وضعیت اجاره
    return isset($status[$ActiStatus]) ? $status[$ActiStatus] : 'وضعیت نامشخص';
}
?>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php');?></td>
   </tr>
</table>

</body>
</html>

