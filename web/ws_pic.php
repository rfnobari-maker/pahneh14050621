<?php
header('Content-Type: text/html; charset=utf-8');

$username = 'ajix_poudadmin';
$password = '6ae390lm';
$nationalCode = isset($_POST['national_code']) ? $_POST['national_code'] : '';
$cardSerial = isset($_POST['card_serial']) ? $_POST['card_serial'] : '';

// لیست آدرس‌های احتمالی جدید
$possibleUrls = array(
    "https://sr-ajix.maj.ir/api/GSBSabteAhval/GetImageSmart",
    "https://sr-ajix.maj.ir/api/v1/GSBSabteAhval/GetImageSmart",
    "https://sr-ajix.maj.ir/rest/GSBSabteAhval/GetImageSmart",
    "https://sr-ajix.maj.ir/GSBSabteAhval/rest/GetImageSmart",
    "https://sr-ajix.maj.ir/GSBSabteAhval/GetImageSmart",
    "https://sr-ajix.maj.ir/GSBSabteAhvalService/GetImageSmart",
    "https://sr-ajix.maj.ir/Services/GSBSabteAhval/GetImageSmart",
    "https://sr-ajix.maj.ir/Services/GSBSabteAhval/Image",
    "https://sr-ajix.maj.ir/GetImageSmart",
    "https://sr-ajix.maj.ir/image/Smart",
    "https://sr-ajix.maj.ir/api/Image/Smart",
    "https://sr-ajix.maj.ir/nid/GetImageSmart",
    "https://sr-ajix.maj.ir/national-id/image"
);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['test_all'])) {
    echo "<h2>نتایج تست تمام آدرس‌ها:</h2>";
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background: #f0f0f0;'><th>آدرس</th><th>وضعیت</th><th>نوع پاسخ</th></tr>";
    
    foreach ($possibleUrls as $testUrl) {
        $data = array('arg4' => $nationalCode, 'arg5' => $cardSerial);
        $jsonData = json_encode($data);
        
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
            'Authorization: Basic ' . base64_encode($username . ':' . $password)
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $testUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $statusColor = $httpCode == 200 ? 'green' : ($httpCode == 404 ? 'orange' : 'red');
        $responseType = '';
        
        if ($httpCode == 200) {
            $decoded = json_decode($response, true);
            if (isset($decoded['image']) || isset($decoded['result']['data']['image'])) {
                $responseType = "✅ سرویس کار می‌کند!";
            } else {
                $responseType = "⚠️ پاسخ 200 ولی ساختار نامشخص";
            }
        } elseif ($httpCode == 404) {
            $responseType = "❌ آدرس وجود ندارد";
        } elseif ($httpCode == 401) {
            $responseType = "🔒 احراز هویت مشکل دارد";
        } else {
            $responseType = "❓ کد خطا: $httpCode";
        }
        
        echo "<tr style='color: $statusColor;'>";
        echo "<td style='direction: ltr;'>" . htmlspecialchars($testUrl) . "</td>";
        echo "<td>$httpCode</td>";
        echo "<td>$responseType</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br><a href=''>بازگشت</a>";
    exit;
}

// تست با متد GET (برخی سرویس‌ها GET قبول می‌کنند)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['test_get'])) {
    echo "<h2>تست با متد GET:</h2>";
    
    $getUrls = array(
        "https://sr-ajix.maj.ir/api/GSBSabteAhval/GetImageSmart?nationalCode=$nationalCode&cardSerial=$cardSerial",
        "https://sr-ajix.maj.ir/GSBSabteAhval/GetImageSmart?nin=$nationalCode&serial=$cardSerial",
        "https://sr-ajix.maj.ir/nid/image?nin=$nationalCode&serial=$cardSerial"
    );
    
    foreach ($getUrls as $testUrl) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $testUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode($username . ':' . $password)
        ));
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        echo "<div>";
        echo "<strong>آدرس:</strong> " . htmlspecialchars($testUrl) . "<br>";
        echo "<strong>وضعیت:</strong> $httpCode<br>";
        if ($httpCode == 200) {
            echo "<strong>پاسخ:</strong> " . htmlspecialchars(substr($response, 0, 200)) . "<br>";
        }
        echo "</div><hr>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <title>یافتن آدرس صحیح سرویس</title>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .info {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }
        input[type="text"] {
            padding: 8px;
            width: 200px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background: #007bff;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
        }
        button:hover {
            background: #0056b3;
        }
        .warning {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 یافتن آدرس صحیح سرویس</h1>
        
        <div class="info">
            <strong>📌 اطلاعات فعلی:</strong><br>
            آدرس تست شده: https://sr-ajix.maj.ir/Services/GSBSabteAhvalGetlmageSmart<br>
            نتیجه: <span style="color: red;">❌ 404 Not Found</span><br>
            <br>
            <strong>💡 نتیجه گیری:</strong> آدرس سرویس تغییر کرده است. لطفاً آدرس‌های زیر را تست کنید.
        </div>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>کد ملی:</label>
                <input type="text" name="national_code" required value="1234567890">
            </div>
            <div class="form-group">
                <label>سریال کارت:</label>
                <input type="text" name="card_serial" required value="001123456">
            </div>
            <button type="submit" name="test_all">🔍 تست تمام آدرس‌ها</button>
            <button type="submit" name="test_get">📡 تست با متد GET</button>
        </form>
        
        <div class="warning">
            <strong>⚠️ نکات مهم:</strong><br>
            1. اگر هیچ آدرسی جواب نداد، احتمالاً سرویس تغییر کرده یا IP شما اجازه دسترسی ندارد.<br>
            2. با واحد فناوری اطلاعات وزارت جهاد کشاورزی تماس بگیرید و آدرس جدید وب سرویس را دریافت کنید.<br>
            3. ممکن است نیاز به اتصال به VPN یا شبکه داخلی وزارت خانه داشته باشید.<br>
            4. از آنها بخواهید مستند به روز سرویس را برای شما ارسال کنند.<br>
            <br>
            <strong>📞 شماره تماس احتمالی:</strong><br>
            مرکز فناوری اطلاعات وزارت جهاد کشاورزی: 021-12345678
        </div>
    </div>
</body>
</html>