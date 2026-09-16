<?php
// اطلاعات کاربری برای احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// منطقه زمانی را به ایران تنظیم کنید (اختیاری)
// date_default_timezone_set('Asia/Tehran');

// تابعی برای تولید requestId با فرمت مناسب
function generateRequestId() {
    $providerCode = '0554'; // کد سرویس دهنده
    $dateTime = date('YmdHis'); // زمان دقیق با فرمت یکتایی
    $microtime = substr((string) microtime(false), 2, 6); // شش رقم برای میکروثانیه
    return $providerCode . $dateTime . $microtime;
}

// تابعی برای ارسال درخواست و نمایش نتیجه
function sendRequest($username, $password, $data) {
    echo "<h3>نتیجه استعلام:</h3>";
    $url = 'https://sr-ajix.maj.ir/services/GetIDMatching';
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        CURLOPT_USERPWD => "$username:$password", // احراز هویت
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
    );

    // ارسال درخواست با استفاده از cURL
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);

    // بررسی و مدیریت خطا
    if ($response === false) {
        echo "<p style='color: red;'>خطا در ارسال درخواست cURL: " . curl_error($ch) . "</p>";
    } else {
        $result = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "<p style='color: red;'>خطا در دیکد JSON: " . json_last_error_msg() . "</p>";
            echo "<p>پاسخ خام دریافتی: " . htmlspecialchars($response) . "</p>";
        } else {
            // نمایش نتیجه به صورت خوانا
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        }
    }

    curl_close($ch);
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>سامانه استعلام کد ملی و شماره همراه</title>
    <style>
        body { font-family: Tahoma, Arial, sans-serif; padding: 20px; }
        .form-container { max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        input[type="text"] { width: 100%; padding: 10px; margin: 8px 0; box-sizing: border-box; border: 1px solid #ddd; border-radius: 4px; }
        button { background-color: #4CAF50; color: white; padding: 10px 15px; margin-top: 10px; border: none; border-radius: 4px; cursor: pointer; width: 100%; }
        button:hover { background-color: #45a049; }
        .result-box { margin-top: 30px; padding: 15px; border: 1px dashed #4CAF50; background-color: #f9fff9; }
        pre { background-color: #eee; padding: 10px; border-radius: 3px; overflow-x: auto; text-align: left; }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>فرم استعلام</h2>
        <form method="POST" action="">
            <label for="national_code">کد ملی:</label>
            <input type="text" id="national_code" name="national_code" required maxlength="10" placeholder="مثال: 0012345678">

            <label for="mobile">شماره همراه:</label>
            <input type="text" id="mobile" name="mobile" required maxlength="11" placeholder="مثال: 09123456789">

            <button type="submit">استعلام</button>
        </form>
    </div>

    <?php
    // بررسی می‌کند که آیا فرم با متد POST ارسال شده است یا خیر
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // --- پردازش ورودی‌های کاربر ---
        $mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : null;
        $national_code = isset($_POST['national_code']) ? trim($_POST['national_code']) : null;

        // بررسی اعتبار اولیه ورودی‌ها
        if (empty($mobile) || empty($national_code)) {
            echo "<div class='result-box'><p style='color: red;'>لطفاً هر دو فیلد کد ملی و شماره همراه را پر کنید.</p></div>";
        } else {
            // ساخت آرایه داده‌ها برای ارسال به سرویس
            $data = array(
                "requestId" => generateRequestId(),
                "serviceNumber" => $mobile, // شماره موبایل دریافت شده از فرم
                "serviceType" => 2,
                "identificationType" => 0,
                "identificationNo" => $national_code // کد ملی دریافت شده از فرم
            );

            // --- ارسال درخواست و نمایش نتیجه ---
            echo "<div class='result-box'>";
            sendRequest($username, $password, $data);
            echo "</div>";
        }
    }
    ?>

</body>
</html>