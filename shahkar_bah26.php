<?php
set_time_limit(0);
// ۱. تنظیمات اولیه و اتصال به دیتابیس
include(__DIR__ . "/login/config.php");
require_once(__DIR__ . "/Jalali.php");

date_default_timezone_set('Asia/Tehran');

// ۲. متغیرهای پیکربندی با استفاده از تابع array() مخصوص نسخه 5.3
$config = array(
    'username'    => 'ajix_poudadmin',
    'password'    => '6ae390lm',
    'provider'    => '0554',
    'api_url'     => 'https://sr-ajix.maj.ir/services/GetIDMatching',
    'date_today'  => jdate("Y/m/d")
);

/**
 * تابع تولید شناسه درخواست
 */
function generateRequestId($providerCode) {
    $dateTime = date('YmdHis');
    $microtime = substr((string) microtime(false), 2, 6);
    return $providerCode . $dateTime . $microtime;
}

/**
 * تابع ارسال درخواست به سرویس شاهکار
 */
function checkShahkar($nationalCode, $mobileNumber, $config) {
    // پاکسازی اعداد (سازگار با 5.3)
    $nationalCode = str_pad(preg_replace('/\D/', '', $nationalCode), 10, "0", STR_PAD_LEFT);
    $mobileNumber = str_pad(preg_replace('/\D/', '', $mobileNumber), 11, "0", STR_PAD_LEFT);

    $data = array(
        "requestId"          => generateRequestId($config['provider']),
        "serviceNumber"      => $mobileNumber,
        "serviceType"        => 2,
        "identificationType" => 0,
        "identificationNo"   => $nationalCode
    );

    $ch = curl_init();
    $curlOptions = array(
        CURLOPT_URL            => $config['api_url'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => array('Content-Type: application/json'),
        CURLOPT_USERPWD        => $config['username'] . ":" . $config['password'],
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($data),
        CURLOPT_TIMEOUT        => 20
    );
    
    curl_setopt_array($ch, $curlOptions);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($response === false) {
        return array('error' => $error);
    }

    return json_decode($response, true);
}

/**
 * فرآیند اصلی پردازش رکوردها
 */
function processRecords($dbh, $config, $limit) {
    try {
        $query = "SELECT id, bah_cod_m AS national_code, tel_m AS mobile_number 
                  FROM bah
                  WHERE valid IN ('311') and ok = '1'
                  LIMIT :limit";
	    $stmt = $dbh->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($records) == 0) {
            echo "<div style='font-family:tahoma; text-align:center;'>رکوردی یافت نشد.</div>";
            return;
        }

        echo "<table border='1' style='width:90%; margin:20px auto; text-align:center; border-collapse: collapse; font-family: tahoma; direction:rtl;'>";
        echo "<tr style='background: #f4f4f4;'><th>ردیف</th><th>کد ملی</th><th>شماره موبایل</th><th>وضعیت</th><th>نتیجه</th></tr>";

        $counter = 1;
        foreach ($records as $record) {
            $result = checkShahkar($record['national_code'], $record['mobile_number'], $config);
            
            $shahkarStatus = null;
            if (isset($result['result']['data']['response'])) {
                $shahkarStatus = $result['result']['data']['response'];
            } elseif (isset($result['response'])) {
                $shahkarStatus = $result['response'];
            }

            echo "<tr><td>" . $counter . "</td><td>" . $record['national_code'] . "</td><td>" . $record['mobile_number'] . "</td>";

            if ($shahkarStatus !== null) {
                $updateStmt = $dbh->prepare("UPDATE bah SET valid = :status, date_s = :date_s WHERE bah_cod_m = :bah_cod_m");
                $updateParams = array(
                    ':status' => $shahkarStatus,
                    ':date_s' => $config['date_today'],
                    ':bah_cod_m'     => $record['national_code']
                );
                $success = $updateStmt->execute($updateParams);
                
                echo "<td>" . $shahkarStatus . "</td><td>" . ($success ? "✓" : "✘") . "</td>";
            } else {
                echo "<td>---</td><td style='color:red;'>خطا</td>";
            }
            echo "</tr>";
            $counter++;
        }
        echo "</table>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// اجرا
processRecords($dbh, $config,50000);
?>