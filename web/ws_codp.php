<?php
// URL وب‌سرویس
//$url = "https://sr-ajix.maj.ir/services/PostApi/AddressByPostcode";
$url = "https://sr-ajix.maj.ir/Services/NewGSBPostApiMethods/AddressByPostcode";
// اطلاعات احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// داده‌های JSON که باید ارسال شوند
$input = array(
    "ClientBatchID" => 3111,
    "Postcodes" => array(
        array(
            "ClientRowID" => 1,
            "PostCode" => "7517765868"
        )
    ),
    "Signature" => "" // در اینجا امضا را قرار دهید (در صورت نیاز)
);

// تبدیل داده‌ها به JSON
$body = json_encode($input);

// هدرها
$headers = array(
    'Authorization: Basic ' . base64_encode($username . ':' . $password), // احراز هویت Basic
    'Content-Type: text/plain' // نوع محتوای درخواست
);

// تنظیمات cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); // آدرس وب‌سرویس
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // بازگشت پاسخ به عنوان رشته
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // ارسال هدرها
curl_setopt($ch, CURLOPT_POST, true); // درخواست POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $body); // داده‌های POST

// غیرفعال کردن بررسی گواهینامه SSL (برای تست، در محیط‌های واقعی بهتر است فعال باشد)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

// اجرای درخواست و دریافت پاسخ
$response = curl_exec($ch);

// بررسی خطاها
if (curl_errno($ch)) {
    echo 'خطا در ارتباط: ' . curl_error($ch);
} else {
    // تبدیل پاسخ به JSON و نمایش آن
    $data = json_decode($response, true);
    echo '<pre>';
    print_r($data); // نمایش داده‌های دریافتی
// فرض می‌کنیم آرایه شما به نام $data باشد
if ($data['Data'][0]['Result']['TownShip']!='') { ;
    $Province    = $data['Data'][0]['Result']['Province'];
    $TownShip    = $data['Data'][0]['Result']['TownShip'];
	$village     = $data['Data'][0]['Result']['Village'];
    $SubLocality = $data['Data'][0]['Result']['SubLocality'];
	$Street      = $data['Data'][0]['Result']['Street'];
    $Street2     = $data['Data'][0]['Result']['Street2'];
	$HouseNumber = $data['Data'][0]['Result']['HouseNumber'];
	$Floor       = $data['Data'][0]['Result']['Floor'];
	$BuildingName= $data['Data'][0]['Result']['BuildingName'];
	$Description = $data['Data'][0]['Result']['Description']; 
$address = $Province.' '.$TownShip.' '.$village.' '.$SubLocality.' '.$Street.' '.$Street2.' '.
	$HouseNumber.' '.$Floor.' '.$BuildingName.' '.$Description;
   if ($address == '      0   ') $address = '' ; 
     }
	else 
	{
		 $address = '' ; 
	}
	echo '</div>';
}
echo $address ; 
// بستن cURL
curl_close($ch);
?>


