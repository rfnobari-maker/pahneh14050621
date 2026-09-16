<?php
include('../../lock_expar.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['partIDCode'])) {
$partIDCode = $_POST['partIDCode'] ; 
echo  $query = "SELECT * from animals_unit where  PartIdCode = '$partIDCode'"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
 foreach($stmt as $row){
$partIDCode =  $row["PartIdCode"]; 	 
$id_ostan = $row["id_ostan"]; 	 
$id_city = $row["id_city"]; 	 
$id_mar = $row["id_mar"]; 	 
$add_abadi = $row["add_abadi"]; 
$add_city  = $row["add_city"]; 
$bah_cod_m = $row['bah_cod_m'];
$num_bah   = $row['num_bah']; 
$vaz_s     = $row['vaz_s'];
$epidemiologicCode = $row['epidemiologic'];
$unit_postal_code = $row['unit_postal_code'];
$postal_address = $row['postal_address'];
$longitude = $row['longitude'];
$latitude  =$row['latitude'];
$polygonData = $row['coordinates'] ;
$unit_name  =$row['unit_name'];
$unitTypes     = $row['unit_types'] ; 
$licenseStatus = $row['license_status'] ; 
$rentStatus    = $row['rent_status'] ; 
$ActiStatus    = $row['active_status']  ; 
$capacity = $row['capacity'] ;
$entry_date = $row['entry_date'] ;
$date_s = $row['date_s'] ;

$docNum = $row['docNum'] ;
$licenseType = $row['licenseType'] ;
$validityDate = $row['validityDate'] ;
$Product_Name = $row['Product_Name'] ;


if($vaz_s =='1') $v_vaz_s = 'ساکن' ;
if($vaz_s =='2') $v_vaz_s = 'غیر ساکن' ;
if($vaz_s =='3') $v_vaz_s = 'عشایر' ;
 }

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
.btn_cancel {
	margin-top:55px ; 
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
     <td>
<p align="center"> مشاهده مشخصات واحد</p>
<div style="width: 100%; margin: 0 auto; text-align: center">
    <?php sar_data2($bah_cod_m, $num_bah); ?>
</div>
      <?php
    // نمایش اطلاعات واحد



    echo "<div class='container'>
            <div class='info-container'>
                <h2>اطلاعات واحد</h2>
                <table class='unit_table' dir='rtl'>
                    <tr><td><strong>شناسه یکتا:</strong></td><td>" . $partIDCode . "</td></tr>
                    <tr><td><strong>کد اپیدمیولوژیک:</strong></td><td>" . $epidemiologicCode . "</td></tr>
                    <tr><td><strong>استان:</strong></td><td>" . ostan_name($id_ostan) . "</td></tr>
                    <tr><td><strong>شهرستان:</strong></td><td>" . city_name1($id_city,$id_ostan) . "</td></tr>
                    <tr><td><strong>مرکز جهاد کشاورزی:</strong></td><td>" . mar_name($id_mar) . "</td></tr>
                    <tr><td><strong>آبادی/شهر:</strong></td><td>" . abadi_name($add_abadi),shahr_name($add_city) . "</td></tr>					
                    <tr><td><strong>کد پستی واحد:</strong></td><td>" . $unit_postal_code . "</td></tr>
                    <tr><td><strong>آدرس پستی:</strong></td><td>" . $postal_address . "</td></tr>
                   <tr><td><strong>نام واحد:</strong></td><td>" . $unit_name . "</td></tr>
                    <tr><td><strong>گروه واحد:</strong></td><td> دامداری </td></tr>
                    <tr><td><strong>نوع واحد:</strong></td><td>" . translateUnitType($unitTypes) . "</td></tr>

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
                  <p dir='rtl'><strong>تاریخ ثبت تغییرات:</strong> " . $entry_date . "</p>
                </div>";
    // نمایش نقشه
echo "<div class='map-container'>
        <h3>نمایش مکان روی نقشه</h3>
        <div id='map'></div>
        <script src='https://unpkg.com/leaflet@1.7.1/dist/leaflet.js'></script>
        <script>
            // مقداردهی به متغیرهای موقعیت مکانی از PHP
            var latitude = " . $latitude . ";
            var longitude = " . $longitude . ";
            var polygonData = " . json_encode($polygonData) . "; // داده‌های پلیگون

            // ایجاد نقشه و تنظیم موقعیت اولیه
            var map = L.map('map').setView([latitude, longitude], 13);

            // اضافه کردن لایه نقشه OpenStreetMap
            var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            });

            // اضافه کردن لایه عکس هوایی از Esri
            var esriSatLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
              maxZoom: 19 , // حداکثر زوم به 19 افزایش می‌یابد
			  detectRetina: true // برای بهبود کیفیت تصویر
            });


            // اضافه کردن نشانگر برای مکان مشخص شده
            L.marker([latitude, longitude]).addTo(map)
                .bindPopup('مکان دامداری: " . $unit_name . "')
                .openPopup();

            // تبدیل مختصات از [longitude, latitude] به [latitude, longitude]
            if (polygonData) {
                try {
                    var fixedCoordinates = JSON.parse(polygonData).map(function(coord) {
                        return [coord[1], coord[0]]; // جا به جا کردن مختصات
                    });

                    // رسم پلیگون روی نقشه
                    var polygon = L.polygon(fixedCoordinates).addTo(map);
                    map.fitBounds(polygon.getBounds()); // تنظیم نقشه برای نمایش کامل پلیگون
                } catch (e) {
                    console.error('خطا در خواندن داده‌های پلیگون:', e);
                }
            }

            // اضافه کردن لایه‌های نقشه به نقشه
            osmLayer.addTo(map); // لایه OpenStreetMap در ابتدا نمایش داده می‌شود

            // کنترل برای سوئیچ بین لایه‌ها
            var layerControl = L.control.layers({
                ' نقشه': osmLayer,
                ' عکس': esriSatLayer
            }).addTo(map);

        </script>  

        <!-- نمایش اطلاعات در جدول -->
        <table class='unit_table' dir='rtl'>
            <tr><td><strong>طول جغرافیایی:</strong></td><td>" . $longitude . "</td></tr>
            <tr><td><strong>عرض جغرافیایی:</strong></td><td>" . $latitude . "</td></tr>
            <tr><td><strong>تاریخ ثبت:</strong></td><td>" . $date_s . "</td></tr>
        </table>
        
        <button type='submit' class='btn_cancel' name='cancel' value='cancel' onclick='close_window()'>خروج</button>
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
<script>
function close_window() {
      close();
 }
    </script>
</body>
</html>

