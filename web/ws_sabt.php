<?php
function webservice($birthDate, $nin) {
    // اطلاعات احراز هویت
    $username = 'ajix_poudadmin';
    $password = '6ae390lm';
    
    // اطلاعات ورودی به صورت آرایه PHP
    $data = array(
        "birthDate" => $birthDate,
        "nin" => $nin 
    );

    // تبدیل آرایه PHP به فرمت JSON
    $jsonData = json_encode($data);
    
    // آدرس URL سرویس
    $url = "https://sr-ajix.maj.ir/Services/GSBSabteAhvalGetEstelam3"; // آدرس درست سرویس را جایگزین کنید
    
    // مقداردهی اولیه cURL
    $ch = curl_init($url);
    
    // تنظیمات cURL
    $options = array(
        CURLOPT_RETURNTRANSFER => true, // دریافت نتیجه به صورت رشته
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json', // تعیین نوع داده به JSON
            'Content-Length: ' . strlen($jsonData), // طول داده‌های ارسالی
            'Authorization: Basic ' . base64_encode("$username:$password") // افزودن احراز هویت Basic Authentication
        ),
        CURLOPT_POST => true, // متد POST
        CURLOPT_POSTFIELDS => $jsonData, // ارسال داده‌ها به صورت JSON
        CURLOPT_SSL_VERIFYPEER => false, // غیرفعال کردن تأیید گواهی SSL
        CURLOPT_SSL_VERIFYHOST => false  // غیرفعال کردن تأیید نام گواهی SSL
    );

    // اعمال تنظیمات به cURL
    curl_setopt_array($ch, $options);

    // اجرای درخواست و دریافت پاسخ
    $response = curl_exec($ch);

    // بررسی خطا در درخواست cURL
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        // داده‌های برگشتی از سرویس
        $response = json_decode($response); 
        
        // دسترسی به داده‌های مورد نیاز
// بررسی ایمن برای هر مسیر داده
$birthDate = isset($response->result->data->getEstelam3Response->return->birthDate) ? 
             $response->result->data->getEstelam3Response->return->birthDate : null;

$nin = isset($response->result->data->getEstelam3Response->return->nin) ? 
       $response->result->data->getEstelam3Response->return->nin : null;

$name = isset($response->result->data->getEstelam3Response->return->name) ? 
        base64_decode($response->result->data->getEstelam3Response->return->name) : null;

$family = isset($response->result->data->getEstelam3Response->return->family) ? 
          base64_decode($response->result->data->getEstelam3Response->return->family) : null;

$fatherName = isset($response->result->data->getEstelam3Response->return->fatherName) ? 
              base64_decode($response->result->data->getEstelam3Response->return->fatherName) : null;

$shenasnameNo = isset($response->result->data->getEstelam3Response->return->shenasnameNo) ? 
                $response->result->data->getEstelam3Response->return->shenasnameNo : null;

$gender = isset($response->result->data->getEstelam3Response->return->gender) ? 
          $response->result->data->getEstelam3Response->return->gender : null;

$deathStatus = isset($response->result->data->getEstelam3Response->return->deathStatus) ? 
               $response->result->data->getEstelam3Response->return->deathStatus : null;

$deathStatusValue = is_array($deathStatus) ? $deathStatus[0] : null;

$message = isset($response->result->data->getEstelam3Response->return->Message) ? 
           $response->result->data->getEstelam3Response->return->Message : '';

// ساخت آرایه خروجی
$output = array(
    'name' => $name,
    'family' => $family,
    'fatherName' => $fatherName,
    'birthDate' => $birthDate,
    'nin' => $nin,
    'shenasnameNo' => $shenasnameNo,
    'gender' => $gender,
    'deathStatus' => $deathStatusValue,
    'message' => $message
);

        return $output;
    }

    // بستن اتصال cURL
    curl_close($ch);
}
?>
