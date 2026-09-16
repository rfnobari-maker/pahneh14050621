<?php
function webservice_for($nin) {
// URL وب‌سرویس (با استفاده از ID)
$id = $nin ;  // اینجا ID مورد نظر را جایگزین کنید
$url = "https://sr-ajix.maj.ir/Services/FIDAGetNaturalPerson/{$id}";

// اطلاعات احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// هدرهای درخواست
$headers = array(
    'Content-Type: application/json', // مشخص کردن نوع داده JSON
    'Authorization: Basic ' . base64_encode($username . ':' . $password) // احراز هویت با Basic Auth
);

// تنظیمات cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); // آدرس وب‌سرویس
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // دریافت پاسخ به صورت رشته
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // ارسال هدرها

// اجرای درخواست و دریافت پاسخ
$response = curl_exec($ch);

// بررسی خطاهای cURL
if (curl_errno($ch)) {
    echo 'خطا در ارتباط: ' . curl_error($ch);
} else {
    // تبدیل پاسخ به JSON و نمایش آن
    $data = json_decode($response, true);
//    print_r($data); // نمایش داده‌های دریافتی
	$name      = $data['PersianFirstName'];  
	$last_name =$data['PersianLastName']  ; 
	if ($data['Gender']=='مرد') $jens = '1' ;
	if ($data['Gender']=='زن') $jens = '2' ;
    $fname = $data['PersianFatherName'] ; 
	$originalDate =$data['BirthDate'] ; 
    $date_t =  date("Y/m/d", strtotime($originalDate));
	$m_sod  = $data['BirthPlaceCountry']['Title']; 
	$nation = $data['Nationality']['Title'] ; 
	$sh_sh  = $data['IdentificationDocument']['Number'] ; 
	
	$output = array(
                'name' => $name,
                'last_name' => $last_name,
                'jens' => $jens,
                'fname' => $fname,
                'date_t' => $date_t,
                'm_sod' => $m_sod,
                'nation' => $nation,
                'sh_sh' => $sh_sh
            );  
            return $output;
}
// بستن cURL
curl_close($ch);
} 
?>
