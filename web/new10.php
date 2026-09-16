<?php
// اطلاعات احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';
// اطلاعات ورودی به صورت آرایه PHP
$data = array(
    "birthDate" => "13520312",
    "nin" => "1380066174"
);
// تبدیل آرایه PHP به فرمت JSON
$jsonData = json_encode($data);
// آدرس URL سرویس
$url = "https://sr-ajix.maj.ir/Services/GSBSabteAhvalGetEstelam3"; // آدرس درست سرویس را جایگزین کنید
// مقداردهی اولیه cURL
$ch = curl_init($url);
// تنظیمات cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // دریافت نتیجه به صورت رشته
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json', // تعیین نوع داده به JSON
    'Content-Length: ' . strlen($jsonData), // طول داده‌های ارسالی
    'Authorization: Basic ' . base64_encode("$username:$password") // افزودن احراز هویت Basic Authentication
));
curl_setopt($ch, CURLOPT_POST, true); // متد POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // ارسال داده‌ها به صورت JSON
// اجرای درخواست و دریافت پاسخ
$response = curl_exec($ch);
// بررسی خطا در درخواست cURL
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
	// داده‌های برگشتی از سرویس
$response = json_decode($response); 
// دسترسی به داده‌های مورد نیاز
$birthDate = $response->result->data->getEstelam3Response->return->birthDate;
$nin = $response->result->data->getEstelam3Response->return->nin;
$nameEncoded = base64_decode($response->result->data->getEstelam3Response->return->name);
$familyEncoded = base64_decode($response->result->data->getEstelam3Response->return->family);
$fatherNameEncoded = base64_decode($response->result->data->getEstelam3Response->return->fatherName);
$shenasnameNo = $response->result->data->getEstelam3Response->return->shenasnameNo;
$gender = $response->result->data->getEstelam3Response->return->gender;
$deathStatus = $response->result->data->getEstelam3Response->return->deathStatus;
$deathStatusValue = $deathStatus[0];
echo $Message = $response->result->data->getEstelam3Response->return->Message;
}
// بستن اتصال cURL
curl_close($ch);
