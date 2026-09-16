<?php
// اطلاعات احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// تابع برای دریافت اطلاعات استعلام بر اساس کد ملی و تاریخ تولد
function webservice($birthDate, $nin) {
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
        return 'Error:' . curl_error($ch);
    } else {
        // داده‌های برگشتی از سرویس
        $result = json_decode($response);

        // بررسی اینکه آیا پاسخ معتبر است یا خیر
        if ($result && isset($result->result->data->getEstelam3Response->return)) {
            $returnData = $result->result->data->getEstelam3Response->return;

            // بررسی محتوای پاسخ
            var_dump($returnData); // اضافه کردن برای بررسی محتوای دقیق

            // دسترسی به داده‌های مورد نیاز
            $name = base64_decode($returnData->name);
            $family = base64_decode($returnData->family);
            $fatherName = base64_decode($returnData->fatherName);
            $birthDate = $returnData->birthDate;
            $nin = $returnData->nin;
            $shenasnameNo = $returnData->shenasnameNo;
            $gender = $returnData->gender;
            $deathStatusValue = $returnData->deathStatus[0];
            $message = $returnData->message;

            // ساخت رشته برای بازگشت به عنوان خروجی تابع
            $output = "Name: $name\n";
            $output .= "Family: $family\n";
            $output .= "Father's Name: $fatherName\n";
            $output .= "Birth Date: $birthDate\n";
            $output .= "National ID (NIN): $nin\n";
            $output .= "Shenasname No: $shenasnameNo\n";
            $output .= "Gender: $gender\n";
            $output .= "Death Status: $deathStatusValue\n";
            $output .= "Message: $message\n";

            return $output;
        } else {
            var_dump($result); // برای بررسی داده‌های بازگشتی در صورت بروز مشکل
            return "No valid data found in the response.";
        }
    }

    // بستن اتصال cURL
    curl_close($ch);
}
echo webservice('13520312', '1380066174');
?>