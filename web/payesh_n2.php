<?php

// --------------------------------------------------
// تنظیمات موقت برای نمایش آمار (CSV تولید نمی‌شود)
// --------------------------------------------------
header('Content-Type: text/html; charset=utf-8');
// BOM و fclose حذف شده‌اند.
echo "<h1>گزارش آمار رکوردها</h1>";

// تنظیمات WSDL Cache
if (!defined('WSDL_CACHE_NONE')) {
    define('WSDL_CACHE_NONE', 0);
}

// --------------------------------------------------
// توابع کمکی
// --------------------------------------------------

/**
 * تابع کمکی: تبدیل شیء به آرایه در PHP 5.3.1 (به صورت بازگشتی)
 */
function object_to_array_php53($data) {
    if (is_array($data) || is_object($data)) {
        $result = array();
        foreach ($data as $key => $value) {
            $result[$key] = object_to_array_php53($value);
        }
        return $result;
    }
    return $data;
}


/**
 * تابع نرمال‌سازی: استخراج سطرها از ساختار تودرتوی وب‌سرویس
 */
function extract_rows_from_data($report_data) {
    $rows = array();
    
    // الف) اگر خروجی فقط یک سطر تکی بود
    if (isset($report_data['id'])) {
        $rows = array($report_data);
    } 
    // ب) بررسی آرایه‌های تودرتو 
    elseif (!empty($report_data) && is_array($report_data)) {
        foreach ($report_data as $key => $potential_rows) {
            
            $first_item = null;
            if (is_array($potential_rows) && !empty($potential_rows)) {
                $first_item = reset($potential_rows);
            }
            
            // استخراج سطرها از آرایه تودرتو
            if (is_array($potential_rows) && is_array($first_item) && (isset($first_item['id']) || isset($first_item['Ostan']))) {
                $rows = $potential_rows;
                break;
            }
        }
    }
    
    return $rows;
}


// --------------------------------------------------
// تابع فراخوانی وب‌سرویس
// --------------------------------------------------
function check_payesh($category)
{
    $webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
    $chech_result = null; 

    if (!class_exists('SoapClient')) {
        // die("Fatal Error: SOAP extension is not installed.");
        echo "<p style='color:red;'>خطا: افزونه SOAP نصب نشده است.</p>";
        return false;
    }

    $client = null;

    try {
        $client = new SoapClient($webservice_url, array(
            'connection_timeout' => 20,
            'trace' => 1,
            'exceptions' => true,
            'cache_wsdl' => WSDL_CACHE_NONE 
        ));

        $res = $client->GetAbstractReport(array(
            "UserName" => "", "Password" => "", 
            "Method" => "GetResponse", 
            "typeName" => "hemayat", "year" => 1404,
            "category" => $category 
        ));

        if (isset($res->GetAbstractReportResult)) {
            $chech_result = $res->GetAbstractReportResult; 
        } else {
            $chech_result = false; 
        }

    } catch (SoapFault $e) {
        $chech_result = false;
        echo "<p style='color:red;'>خطای SOAP برای Category {$category}: " . $e->getMessage() . "</p>";
    } catch (Exception $e) {
        $chech_result = false;
        echo "<p style='color:red;'>خطای عمومی برای Category {$category}: " . $e->getMessage() . "</p>";
    }

    return $chech_result;
}

// --------------------------------------------------
// منطق اصلی نمایش آمار
// --------------------------------------------------

$all_rows = array(); 
$unique_keys = array(); 
$categories = array('0', '4');

echo "<h2>نتایج فراخوانی وب‌سرویس</h2>";

foreach ($categories as $category) {
    echo "<h3>Category: {$category}</h3>";
    
    // 1. فراخوانی وب‌سرویس
    $soap_result = check_payesh($category);
    
    if ($soap_result === false || $soap_result === null) {
        echo "<p>❌ خطا: داده‌ای دریافت نشد.</p>";
        continue;
    }

    // 2. تبدیل و نرمال‌سازی
    $report_data = object_to_array_php53($soap_result);
    $current_rows_raw = extract_rows_from_data($report_data);
    $count_raw = count($current_rows_raw);

    echo "<p>✅ تعداد رکوردهای خام (قبل از ترکیب): <strong>{$count_raw}</strong></p>";

    // 3. ادغام با حذف تکرار (بر اساس کلید مرکب: id_Ostan)
    $added_count = 0;
    foreach ($current_rows_raw as $row) {
        $row = (array)$row; 
        
        // ساخت کلید مرکب
        if (isset($row['id']) && isset($row['Ostan'])) {
            $composite_key = $row['id'] . '_' . $row['Ostan'];
            
            if (!isset($unique_keys[$composite_key])) {
                $all_rows[] = $row;
                $unique_keys[$composite_key] = true;
                $added_count++;
            }
        } else {
            // اگر id یا Ostan موجود نبود، رکورد را اضافه می‌کنیم و آن را تکراری فرض نمی‌کنیم
            $all_rows[] = $row;
            $added_count++;
        }
    }
    echo "<p>➕ تعداد رکوردهای **جدید** اضافه شده: <strong>{$added_count}</strong></p>";
    echo "<hr>";
}

echo "<h2>نتیجه نهایی</h2>";
$final_count = count($all_rows);
echo "<p>تعداد کل رکوردهای **نهایی** پس از ترکیب و حذف تکرار: <strong>{$final_count}</strong></p>";

// در صورت نیاز، می‌توانید این خط را فعال کنید تا ساختار آرایه نهایی را ببینید:
// echo "<h3>جزئیات آرایه نهایی:</h3><pre>" . print_r($all_rows, true) . "</pre>";
exit();
?>