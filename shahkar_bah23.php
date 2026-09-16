<?php
include('./login/config.php'); // فایل کانفیگ برای اتصال به دیتابیس

// اطلاعات احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

date_default_timezone_set('Asia/Tehran'); // تنظیم منطقه زمانی

// تابع تولید requestId
function generateRequestId() {
    $providerCode = '0554';
    $dateTime = date('YmdHis');
    $microtime = substr((string) microtime(false), 2, 6);
    return $providerCode . $dateTime . $microtime;
}

// تابع برای ارسال درخواست به وب سرویس و دریافت نتیجه
function checkShahkar($nationalCode, $mobileNumber) {
    global $username, $password;

    // اطمینان از صحیح بودن فرمت ورودی‌ها
    $nationalCode = str_pad($nationalCode, 10, "0", STR_PAD_LEFT);
    $mobileNumber = str_pad($mobileNumber, 11, "0", STR_PAD_LEFT);

    $data = array(
        "requestId" => generateRequestId(),
        "serviceNumber" => $mobileNumber,
        "serviceType" => 2,
        "identificationType" => 0,
        "identificationNo" => $nationalCode
    );

    $url = 'https://sr-ajix.maj.ir/services/GetIDMatching';
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        CURLOPT_USERPWD => "$username:$password",
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data)
    );

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);

    if ($response === false) {
     //   echo "خطا در cURL: " . curl_error($ch) . "\n";
        return false;
    }

//    echo "پاسخ از سرور: $response\n"; // چاپ پاسخ

    $result = json_decode($response, true);
    return $result;
}

// دریافت رکوردها از جدول و بررسی صحت آن‌ها با وب سرویس شاهکار
function processRecords($limit) {
    global $dbh;

    // انتخاب رکوردها از جدول bah20 بر اساس startId و limit
    $stmt = $dbh->prepare("SELECT id, bah_cod_m AS national_code, tel_m AS mobile_number FROM bah WHERE valid not in ('200','600')  and  ok = '1' and valid = '330' LIMIT :limit");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($records as $record) {
        $id = $record['id'];
        $nationalCode = $record['national_code'];
        $mobileNumber = $record['mobile_number'];

        // ارسال درخواست به وب سرویس شاهکار
        $response = checkShahkar($nationalCode, $mobileNumber);

        // بررسی نتیجه و بروزرسانی فیلد shahkar در جدول
        if ($response && isset($response['result']['data']['response'])) {
            $shahkarStatus = $response['result']['data']['response'];

            // بروزرسانی فیلد shahkar در جدول
            $updateStmt = $dbh->prepare("UPDATE bah20 SET valid = :shahkarStatus WHERE bah_cod_m = :bah_cod_m");
            $updateStmt->bindParam(':shahkarStatus', $shahkarStatus, PDO::PARAM_INT);
            $updateStmt->bindParam(':bah_cod_m', $nationalCode, PDO::PARAM_INT);
            $updateStmt->execute();

            $updateStmt = $dbh->prepare("UPDATE bah SET valid = :shahkarStatus WHERE id = :id");
            $updateStmt->bindParam(':shahkarStatus', $shahkarStatus, PDO::PARAM_INT);
            $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $updateStmt->execute();

        }
    }
}

// استفاده از تابع برای بررسی رکوردها
//$startId = 1; // شناسه شروع
$limit = 5000; // تعداد رکوردها برای بررسی
processRecords($limit);
echo "بررسی و بروزرسانی رکوردها انجام شد.";
?>
