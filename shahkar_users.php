<?php
include('./login/config.php');

// اطلاعات احراز هویت
$username = 'ajix_poudadmin';
$password = '6ae390lm';

date_default_timezone_set('Asia/Tehran');

// تابع تولید requestId
function generateRequestId() {
    $providerCode = '0554';
    $dateTime = date('YmdHis');
    $microtime = substr(microtime(false), 2, 6);
    return $providerCode . $dateTime . $microtime;
}

function checkShahkar($nationalCode, $mobileNumber) {
    global $username, $password;

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
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $response = curl_exec($ch);
    if ($response === false) {
        return false;
    }

    $result = json_decode($response, true);
    curl_close($ch);
    return $result;
}

// متغیر سراسری برای شمارش
$GLOBALS['total_processed'] = 0;

function processRecords($limit, $max_records) {
    global $dbh;
    
    $remaining = $max_records - $GLOBALS['total_processed'];
    if ($remaining <= 0) {
        return 0;
    }

    $batch_size = min($limit, $remaining);
    
    $dbh->beginTransaction();
    
    try {
        $stmt = $dbh->prepare("SELECT id, cod_m AS national_code, tel_m AS mobile_number 
                              FROM users 
                              WHERE `S_access` ='1' and valid NOT IN ('200')
                              LIMIT :limit");
        $stmt->bindValue(':limit', $batch_size, PDO::PARAM_INT);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $updateStmt2 = $dbh->prepare("UPDATE users SET valid = :shahkarStatus WHERE id = :id");

        $processed = 0;
        foreach ($records as $record) {
            if ($GLOBALS['total_processed'] >= $max_records) {
                break;
            }
            
            $response = checkShahkar($record['national_code'], $record['mobile_number']);

            if ($response && isset($response['result']['data']['response'])) {
                $shahkarStatus = $response['result']['data']['response'];


                $updateStmt2->execute(array(
                    ':shahkarStatus' => $shahkarStatus,
                    ':id' => $record['id']
                ));

                $processed++;
                $GLOBALS['total_processed']++;
            }

            if ($processed % 50 == 0) {
                sleep(1);
            }
        }

        $dbh->commit();
        return $processed;
    } catch (Exception $e) {
        $dbh->rollBack();
        return false;
    }
}

set_time_limit(0);
ini_set('memory_limit', '512M');

$batchSize = 500; // تعداد رکوردها در هر بسته
$maxRecords = 1000; // حداکثر تعداد رکوردهای قابل پردازش

while (true) {
    $processed = processRecords($batchSize, $maxRecords);
    
    if ($processed === false) {
        echo "خطا در پردازش رکوردها\n";
        break;
    } elseif ($processed == 0) {
        echo "توقف: یا تمام رکوردها پردازش شدند یا به حد مجاز رسیدیم\n";
        break;
    } else {
        echo "پردازش شده در این بسته: $processed - مجموع: ".$GLOBALS['total_processed']." از $maxRecords\n";
        
        if ($GLOBALS['total_processed'] >= $maxRecords) {
            echo "به حد مجاز $maxRecords رکورد رسیدیم. توقف...\n";
            break;
        }
        
        sleep(2);
    }
}

echo "پردازش کامل شد. مجموع رکوردهای پردازش شده: ".$GLOBALS['total_processed']."\n";

// برای اطمینان از توقف، خروجی را فورس کنیم
ob_flush();
flush();
exit(0);
?>