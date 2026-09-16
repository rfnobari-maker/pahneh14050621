<?php
// اطلاعات احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// تابع برای دریافت اطلاعات استعلام بر اساس کد ملی و تاریخ تولد
function getEstelam3($nin, $birthDate) {
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
        'Authorization: Basic ' . base64_encode("ajix_poudadmin:6ae390lm") // افزودن احراز هویت Basic Authentication
    ));
    curl_setopt($ch, CURLOPT_POST, true); // متد POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // ارسال داده‌ها به صورت JSON

    // اجرای درخواست و دریافت پاسخ
    $response = curl_exec($ch);

    // بررسی خطا در درخواست cURL
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        return false; // در صورت وجود خطا، تابع false را برمی‌گرداند
    } else {
        // داده‌های برگشتی از سرویس
        $response = json_decode($response);

        // بررسی وجود داده معتبر در پاسخ
        if (isset($response->result->data->getEstelam3Response->return)) {
            $result = $response->result->data->getEstelam3Response->return;

            // دسترسی به داده‌های مورد نیاز
            $birthDate = $result->birthDate;
            $nin = $result->nin;
            $name = base64_decode($result->name);
            $family = base64_decode($result->family);
            $fatherName = base64_decode($result->fatherName);
            $shenasnameNo = $result->shenasnameNo;
            $gender = $result->gender;
            $deathStatusValue = $result->deathStatus[0];
            $message = $result->message;

            // نمایش داده‌ها
            echo "Name: " . $name . "<br>";
            echo "Family: " . $family . "<br>";
            echo "Father's Name: " . $fatherName . "<br>";
            echo "Birth Date: " . $birthDate . "<br>";
            echo "National ID (NIN): " . $nin . "<br>";
            echo "Shenasname No: " . $shenasnameNo . "<br>";
            echo "Gender: " . $gender . "<br>";
            echo "Death Status: " . $deathStatusValue . "<br>";
            echo "Message: " . $message . "<br>";
        } else {
            echo "No valid data found in the response.";
        }
    }

    // بستن اتصال cURL
    curl_close($ch);
}

// بررسی اینکه آیا کاربر فرم را ارسال کرده است یا نه
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nin = $_POST["nin"];
    $birthDate = $_POST["birthDate"];

    // فراخوانی تابع و نمایش نتایج
    getEstelam3($nin, $birthDate);
}
?>

<!-- فرم HTML برای دریافت ورودی از کاربر -->
<form method="POST" action="">
    <label for="nin">Enter National ID (NIN):</label>
    <input type="text" id="nin" name="nin" required><br><br>
    
    <label for="birthDate">Enter Birth Date (YYYYMMDD):</label>
    <input type="text" id="birthDate" name="birthDate" required><br><br>
    
    <input type="submit" value="Submit">
</form>
