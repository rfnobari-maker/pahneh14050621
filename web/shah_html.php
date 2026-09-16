<?php
// اطلاعات کاربری برای احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

// تابعی برای تولید requestId با فرمت مناسب
function generateRequestId() {
    $providerCode = '0554';
    $dateTime = date('YmdHis');
    $microtime = substr((string) microtime(false), 2, 6);
    return $providerCode . $dateTime . $microtime;
}

// تابع ارسال درخواست
function sendRequest($username, $password, $data) {
    $url = 'https://sr-ajix.maj.ir/services/GetIDMatching';

    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        CURLOPT_USERPWD => "$username:$password",
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
    );

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);

    if ($response === false) {
        echo "Error: " . curl_error($ch);
    } else {
        $result = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "JSON decode error: " . json_last_error_msg();
        } else {
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        }
    }

    curl_close($ch);
}
?>

<!-- فرم دریافت اطلاعات کاربر -->
<form method="POST">
    شماره موبایل: <input type="text" name="mobile" required><br><br>
    کد ملی: <input type="text" name="national_id" required><br><br>
    <button type="submit">ارسال</button>
</form>

<?php
// اگر فرم ارسال شده باشد
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mobile = trim($_POST["mobile"]);
    $nationalId = trim($_POST["national_id"]);

    // کنترل ساده ورودی‌ها
    if (!preg_match('/^09\d{9}$/', $mobile)) {
        die("شماره موبایل نادرست است.");
    }

    if (!preg_match('/^\d{10}$/', $nationalId)) {
        die("کد ملی باید ۱۰ رقم باشد.");
    }

    // ساخت داده برای درخواست
    $data = array(
        "requestId" => generateRequestId(),
        "serviceNumber" => $mobile,
        "serviceType" => 2,
        "identificationType" => 0,
        "identificationNo" => $nationalId
    );

    // ارسال درخواست
    sendRequest($username, $password, $data);
}
?>
