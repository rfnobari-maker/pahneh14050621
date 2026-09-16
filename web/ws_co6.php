<?php
// =====================================
//     CLASS: MajIrClient (برای PHP 5.3)
//     Web Service: GSBGetCompanyLatestInfoV2
// =====================================
class MajIrClient {
    // آدرس وب سرویس مطابق سند
    private $baseUrl = 'https://sr-ajix.maj.ir/Services/GSBGetCompanyLatestInfoV2';
    private $username = 'ajix_poudadmin';
    private $password = '6ae390lm';

    public function getCompanyInfo($nationalCode) {
        // فرمت ورودی مطابق سند - فقط شناسه ملی
        $data = array(
            'TheCCompany' => array(
                'NationalCode' => $nationalCode
            )
        );

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->baseUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => 'gzip, deflate, br',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Accept: */*',
                'Authorization: Basic ' . base64_encode($this->username . ':' . $this->password),
                'Cache-Control: no-cache',
                'Connection: keep-alive',
                'Content-Type: application/json',
                'Host: sr-aijx.maj.ir',
                'User-Agent: PHP-CURL-Client/1.0'
            ),
        ));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        curl_close($ch);

        if ($error) {
            throw new Exception("cURL Error: " . $error);
        }

        if ($httpCode != 200) {
            throw new Exception("API request failed with HTTP code: " . $httpCode);
        }

        $decodedResponse = json_decode($response, true);
        
        // بررسی موفقیت آمیز بودن پاسخ
        if (isset($decodedResponse['result']['data']['Result']['Successful']) && 
            $decodedResponse['result']['data']['Result']['Successful'] !== true) {
            $msg = isset($decodedResponse['result']['data']['Result']['Message']) 
                   ? $decodedResponse['result']['data']['Result']['Message'] 
                   : 'Unknown error';
            throw new Exception("API Error: " . $msg);
        }
        
        return $decodedResponse;
    }
}

/**
 * پیدا کردن مدیرعامل از لیست اشخاص (سازگار با PHP 5.3)
 */
function findCEO($persons) {
    if (empty($persons)) {
        return null;
    }
    
    foreach ($persons as $person) {
        // بررسی سمت‌های شخص
        if (isset($person['TheCCompanyPersonPostList']) && is_array($person['TheCCompanyPersonPostList'])) {
            foreach ($person['TheCCompanyPersonPostList'] as $post) {
                if (isset($post['TheCIPostType'])) {
                    $postType = $post['TheCIPostType'];
                    // کد 001 یا عنوان "مدیرعامل" نشان دهنده مدیرعامل است
                    if ((isset($postType['Code']) && $postType['Code'] === '001') ||
                        (isset($postType['Title']) && trim($postType['Title']) === 'مدیرعامل')) {
                        return $person;
                    }
                }
            }
        }
    }
    return null;
}

/**
 * دریافت تمام سمت‌های یک شخص (سازگار با PHP 5.3)
 */
function getPersonPosts($person) {
    $posts = array();
    if (isset($person['TheCCompanyPersonPostList']) && is_array($person['TheCCompanyPersonPostList'])) {
        foreach ($person['TheCCompanyPersonPostList'] as $post) {
            if (isset($post['TheCIPostType']['Title'])) {
                $title = trim($post['TheCIPostType']['Title']);
                if (!empty($title)) {
                    $posts[] = $title;
                }
            }
        }
    }
    return $posts;
}

/**
 * دریافت مقدار از آرایه با پیش‌فرض (جایگزین ?? برای PHP 5.3)
 */
function getVal($arr, $key, $default = '-') {
    return isset($arr[$key]) && !empty($arr[$key]) ? $arr[$key] : $default;
}

/**
 * ایمن کردن خروجی HTML
 */
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>استعلام اطلاعات شرکت (نسخه جدید)</title>
    <style>
        body { font-family: Tahoma, Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 950px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; direction: rtl; }
        th, td { border: 1px solid #ddd; padding: 10px; vertical-align: top; text-align: right; }
        th { background-color: #4CAF50; color: white; font-weight: bold; }
        .section { margin-top: 30px; }
        .section-title { background-color: #2196F3; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .error { color: red; background-color: #ffeeee; padding: 10px; border-radius: 5px; border-right: 4px solid red; }
        .success { color: green; background-color: #eeffee; padding: 10px; border-radius: 5px; border-right: 4px solid green; }
        h2 { color: #333; border-bottom: 2px solid #4CAF50; padding-bottom: 10px; }
        input[type=text] { padding: 8px; width: 250px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        button { padding: 8px 20px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; }
        button:hover { background: #45a049; }
        .info { background: #e7f3fe; padding: 8px; border-radius: 4px; margin-bottom: 15px; font-size: 13px; }
    </style>
</head>
<body dir="rtl">
<div class="container">
    <h2>🏢 استعلام اطلاعات شرکت</h2>
    <div class="info">وب سرویس: GSBGetCompanyLatestInfoV2 (نسخه جدید)</div>

    <form method="post">
        <label><strong>شناسه ملی شرکت:</strong></label><br>
        <input type="text" name="nationalCode" required pattern="[0-9]{11}" title="شناسه ملی باید 11 رقم باشد" placeholder="مثال: 10860227192">
        <button type="submit">🔍 استعلام</button>
    </form>

    <hr>

    <?php
    if (!empty($_POST['nationalCode'])) {
        $nationalCode = trim($_POST['nationalCode']);

        try {
            $client = new MajIrClient();
            $response = $client->getCompanyInfo($nationalCode);
            
            // استخراج داده اصلی مطابق ساختار سند
            $result = isset($response['result']['data']['Result']) 
                      ? $response['result']['data']['Result'] 
                      : null;
            $company = isset($response['result']['data']['TheCCompany']) 
                       ? $response['result']['data']['TheCCompany'] 
                       : null;
            
            if (!$company) {
                echo "<p class='error'>❌ خطا: داده‌ای دریافت نشد</p>";
            } else {
                echo "<div class='success'>✅ نتیجه استعلام برای شناسه ملی: " . e($nationalCode) . "</div>";
                
                // ========== جدول اطلاعات اصلی شرکت ==========
                echo "<h3>📋 اطلاعات شرکت</h3>";
                echo "<table>";
                echo "<tr><th style='width:35%'>فیلد</th><th>مقدار</th></tr>";
                
                $name = isset($company['Name']) ? $company['Name'] : '-';
                echo "<tr><td><strong>نام شرکت</strong></td><td>" . e($name) . "</td></tr>";
                
                $nationalCodeVal = isset($company['NationalCode']) ? $company['NationalCode'] : '-';
                echo "<tr><td><strong>شناسه ملی</strong></td><td>" . e($nationalCodeVal) . "</td></tr>";
                
                $companyType = isset($company['TheCICompanyType']['Title']) ? $company['TheCICompanyType']['Title'] : '-';
                echo "<tr><td><strong>نوع شرکت</strong></td><td>" . e($companyType) . "</td></tr>";
                
                $objectState = isset($company['TheObjectState']['Title']) ? $company['TheObjectState']['Title'] : '-';
                echo "<tr><td><strong>وضعیت شخصیت حقوقی</strong></td><td>" . e($objectState) . "</td></tr>";
                
                $registerDate = isset($company['RegisterDate']) ? $company['RegisterDate'] : '-';
                echo "<tr><td><strong>تاریخ ثبت</strong></td><td>" . e($registerDate) . "</td></tr>";
                
                $registerNumber = isset($company['RegisterNumber']) ? $company['RegisterNumber'] : '-';
                echo "<tr><td><strong>شماره ثبت</strong></td><td>" . e($registerNumber) . "</td></tr>";
                
                $postCode = isset($company['PostCode']) ? $company['PostCode'] : '-';
                echo "<tr><td><strong>کد پستی</strong></td><td>" . e($postCode) . "</td></tr>";
                
                $residency = isset($company['Residency']) ? $company['Residency'] : '-';
                echo "<tr><td><strong>محل فعالیت</strong></td><td>" . e($residency) . "</td></tr>";
                
                $addressDesc = isset($company['AddressDesc']) ? nl2br(e($company['AddressDesc'])) : '-';
                echo "<tr><td><strong>آدرس کامل</strong></td><td>" . $addressDesc . "</td></tr>";
                
                $unitName = isset($company['TheUnit']['UnitName']) ? $company['TheUnit']['UnitName'] : '-';
                echo "<tr><td><strong>مرجع ثبت</strong></td><td>" . e($unitName) . "</td></tr>";
                
                $lastChangeDate = isset($company['LastChangeDate']) ? $company['LastChangeDate'] : '-';
                echo "<tr><td><strong>آخرین تاریخ تغییرات</strong></td><td>" . e($lastChangeDate) . "</td></tr>";
                
                $fixPhone = isset($company['FixPhoneNumber']) ? $company['FixPhoneNumber'] : '-';
                echo "<tr><td><strong>تلفن ثابت</strong></td><td>" . e($fixPhone) . "</td></tr>";
                
                $smsNumber = isset($company['SMSNumber']) ? $company['SMSNumber'] : '-';
                echo "<tr><td><strong>شماره همراه</strong></td><td>" . e($smsNumber) . "</td></tr>";
                
                $issuanceDate = isset($company['IssuanceDate']) ? $company['IssuanceDate'] : '-';
                echo "<tr><td><strong>تاریخ صدور</strong></td><td>" . e($issuanceDate) . "</td></tr>";
                
                $isBranch = isset($company['IsBranch']) ? ($company['IsBranch'] ? 'بله' : 'خیر') : '-';
                echo "<tr><td><strong>آیا شعبه است؟</strong></td><td>" . $isBranch . "</td></tr>";
                
                echo "</table>";
                
                // ========== اطلاعات مدیرعامل ==========
                $persons = isset($company['TheCCompanyPersonList']) && is_array($company['TheCCompanyPersonList']) 
                           ? $company['TheCCompanyPersonList'] 
                           : array();
                $ceo = findCEO($persons);
                
                echo "<div class='section'>";
                echo "<h3 class='section-title'>👨‍💼 اطلاعات مدیرعامل</h3>";
                
                if ($ceo) {
                    echo "<table>";
                    echo "<tr><th style='width:35%'>فیلد</th><th>مقدار</th></tr>";
                    
                    $fullName = '';
                    if (!empty($ceo['FirstNameFA'])) $fullName .= $ceo['FirstNameFA'];
                    if (!empty($ceo['LastNameFA'])) $fullName .= ' ' . $ceo['LastNameFA'];
                    if (empty($fullName)) $fullName = '-';
                    echo "<tr><td><strong>نام و نام خانوادگی</strong></td><td>" . e($fullName) . "</td></tr>";
                    
                    $fatherName = isset($ceo['FatherNameFA']) ? $ceo['FatherNameFA'] : '-';
                    echo "<tr><td><strong>نام پدر</strong></td><td>" . e($fatherName) . "</td></tr>";
                    
                    $birthDate = isset($ceo['BirthDateSH']) ? $ceo['BirthDateSH'] : '-';
                    echo "<tr><td><strong>تاریخ تولد</strong></td><td>" . e($birthDate) . "</td></tr>";
                    
                    $nationalCodePerson = isset($ceo['NationalityCode']) ? $ceo['NationalityCode'] : '-';
                    echo "<tr><td><strong>کد ملی</strong></td><td>" . e($nationalCodePerson) . "</td></tr>";
                    
                    $mobile = isset($ceo['MobileNumber4SMS']) ? $ceo['MobileNumber4SMS'] : '-';
                    echo "<tr><td><strong>شماره همراه</strong></td><td>" . e($mobile) . "</td></tr>";
                    
                    $phone = isset($ceo['PhoneNumber']) ? $ceo['PhoneNumber'] : '-';
                    echo "<tr><td><strong>تلفن ثابت</strong></td><td>" . e($phone) . "</td></tr>";
                    
                    $postCodePerson = isset($ceo['PostCode']) ? $ceo['PostCode'] : '-';
                    echo "<tr><td><strong>کد پستی</strong></td><td>" . e($postCodePerson) . "</td></tr>";
                    
                    $address = isset($ceo['Address']) ? nl2br(e($ceo['Address'])) : '-';
                    echo "<tr><td><strong>آدرس</strong></td><td>" . $address . "</td></tr>";
                    
                    $sex = isset($ceo['Sex']) ? $ceo['Sex'] : 0;
                    $sexText = '-';
                    if ($sex == 2) $sexText = 'مرد';
                    elseif ($sex == 1) $sexText = 'زن';
                    echo "<tr><td><strong>جنسیت</strong></td><td>" . $sexText . "</td></tr>";
                    
                    $posts = getPersonPosts($ceo);
                    $postsText = !empty($posts) ? implode('، ', $posts) : '-';
                    echo "<tr><td><strong>سمت‌ها</strong></td><td>" . e($postsText) . "</td></tr>";
                    
                    echo "</table>";
                } else {
                    echo "<p class='error'>⚠️ مدیرعاملی برای این شرکت یافت نشد.</p>";
                }
                echo "</div>";
                
                // ========== لیست تمام اشخاص شرکت ==========
                if (!empty($persons) && count($persons) > 0) {
                    echo "<div class='section'>";
                    echo "<h3 class='section-title'>👥 لیست تمام اشخاص شرکت</h3>";
                    echo "<table>";
                    echo "<tr><th>ردیف</th><th>نام و نام خانوادگی</th><th>کد ملی</th><th>سمت‌ها</th><th>تاریخ تولد</th></tr>";
                    $counter = 1;
                    foreach ($persons as $person) {
                        $fullName = '';
                        if (!empty($person['FirstNameFA'])) $fullName .= $person['FirstNameFA'];
                        if (!empty($person['LastNameFA'])) $fullName .= ' ' . $person['LastNameFA'];
                        if (empty($fullName)) $fullName = '-';
                        
                        $nationalCodePerson = isset($person['NationalityCode']) ? $person['NationalityCode'] : '-';
                        $posts = getPersonPosts($person);
                        $postsText = !empty($posts) ? implode('، ', $posts) : '-';
                        $birthDate = isset($person['BirthDateSH']) ? $person['BirthDateSH'] : '-';
                        
                        echo "<tr>";
                        echo "<td>" . $counter++ . "</td>";
                        echo "<td>" . e($fullName) . "</td>";
                        echo "<td>" . e($nationalCodePerson) . "</td>";
                        echo "<td>" . e($postsText) . "</td>";
                        echo "<td>" . e($birthDate) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                }
                
                // ========== لیست فعالیت‌های شرکت ==========
                $activities = isset($company['TheCompanyActivitiesList']) && is_array($company['TheCompanyActivitiesList'])
                              ? $company['TheCompanyActivitiesList']
                              : array();
                if (!empty($activities)) {
                    echo "<div class='section'>";
                    echo "<h3 class='section-title'>📝 لیست فعالیت‌های شرکت</h3>";
                    echo "<table>";
                    echo "<tr><th>#</th><th>شرح فعالیت</th><th>مدت فعالیت</th><th>وضعیت</th></tr>";
                    $counter = 1;
                    foreach ($activities as $activity) {
                        $activityDesc = isset($activity['ActivityDesc']) ? $activity['ActivityDesc'] : '-';
                        $activityTimeState = isset($activity['ActivityTimeState']) ? $activity['ActivityTimeState'] : 0;
                        $timeText = '';
                        if ($activityTimeState == 1) $timeText = 'محدود';
                        elseif ($activityTimeState == 2) $timeText = 'نامحدود';
                        else $timeText = 'نامشخص';
                        
                        $state = isset($activity['State']) ? $activity['State'] : 0;
                        $stateText = '';
                        if ($state == 1) $stateText = 'فعال';
                        elseif ($state == 2) $stateText = 'غیرفعال';
                        else $stateText = 'نامشخص';
                        
                        echo "<tr>";
                        echo "<td>" . $counter++ . "</td>";
                        echo "<td>" . e($activityDesc) . "</td>";
                        echo "<td>" . $timeText . "</td>";
                        echo "<td>" . $stateText . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                }
                
                // نمایش وضعیت پاسخ
                if ($result && isset($result['Message'])) {
                    $msg = $result['Message'];
                    $code = isset($result['Code']) ? $result['Code'] : '';
                    echo "<p class='success'><small>📌 وضعیت: " . e($msg) . " (کد: " . e($code) . ")</small></p>";
                }
            }
            
        } catch (Exception $e) {
            echo "<p class='error'>❌ خطا: " . e($e->getMessage()) . "</p>";
        }
    }
    ?>
</div>
</body>
</html>