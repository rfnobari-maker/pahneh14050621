<?php
if($_POST['cod_m'])
{
// URL وب‌سرویس
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
            "PostCode" => $_POST['cod_m'] 
        )
    ),
    "Signature" => "" // در اینجا امضا را قرار دهید (در صورت نیاز)
);

// تبدیل داده‌ها به JSON
$body = json_encode($input);

// هدرها
$headers = array(
    'Authorization: Basic ' . base64_encode($username . ':' . $password), // احراز هویت Basic
    'Content-Type: application/json', // نوع محتوای درخواست
    'Cookie: BIGipServerPool_Farm_61_8080=3143958794.36895.0000; cookiesession1=678B2897105F9ACB37D083A2B0D7AA09' // کوکی‌ها (در صورت نیاز)
);

// تنظیمات cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); // آدرس وب‌سرویس
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // بازگشت پاسخ به عنوان رشته
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // ارسال هدرها
curl_setopt($ch, CURLOPT_POST, true); // درخواست POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $body); // داده‌های POST

// غیرفعال کردن بررسی گواهینامه SSL (برای تست، در محیط‌های واقعی بهتر است فعال باشد)
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

// اجرای درخواست و دریافت پاسخ
$response = curl_exec($ch);

// بررسی خطاها
if (curl_errno($ch)) {
    echo 'خطا در ارتباط: ' . curl_error($ch);
} else {
    // تبدیل پاسخ به JSON و نمایش آن
    $data = json_decode($response, true);
    echo '<pre>';
  //  print_r($data); // نمایش داده‌های دریافتی
    if (isset($data['result']['data']['Data'][0]['Result']['TownShip']) && $data['result']['data']['Data'][0]['Result']['TownShip'] != '') {
        $Province    = $data['result']['data']['Data'][0]['Result']['Province'];
        $TownShip    = $data['result']['data']['Data'][0]['Result']['TownShip'];
        $village     = $data['result']['data']['Data'][0]['Result']['Village'];
        $SubLocality = $data['result']['data']['Data'][0]['Result']['SubLocality'];
        $Street      = $data['result']['data']['Data'][0]['Result']['Street'];
        $Street2     = $data['result']['data']['Data'][0]['Result']['Street2'];
        $HouseNumber = $data['result']['data']['Data'][0]['Result']['HouseNumber'];
        $Floor       = $data['result']['data']['Data'][0]['Result']['Floor'];
        $BuildingName= $data['result']['data']['Data'][0]['Result']['BuildingName'];
        $Description = $data['result']['data']['Data'][0]['Result']['Description'];
        $address = $Province.' '.$TownShip.' '.$village.' '.$SubLocality.' '.$Street.' '.$Street2.' '.
            $HouseNumber.' '.$Floor.' '.$BuildingName.' '.$Description;
        if (trim($address) == '0') {
            $address = '';
        }
    } else {
        $address = '';
    }
    echo $address;
}

// بستن cURL
curl_close($ch);
}
?>

<script>
document.getElementById('add').value = "<?php echo $address?>";
</script>

