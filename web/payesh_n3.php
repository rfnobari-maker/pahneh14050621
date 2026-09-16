<?php

// تنظیم BOM برای پشتیبانی از UTF-8 در اکسل
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="report_' . date('Ymd') . '.csv"');
$output = fopen('php://output', 'w');
fwrite($output, "\xEF\xBB\xBF"); // BOM (Byte Order Mark)

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
 * تابع کمکی: استخراج سطرها از ساختار تودرتوی وب‌سرویس
 * **اصلاح:** حذف دستور break برای استخراج تمام لیست‌های رکورد
 */
function extract_rows_from_data($report_data) {
    $rows = array();
    
    // الف) اگر خروجی فقط یک سطر تکی بود
    if (isset($report_data['id'])) {
        $rows[] = $report_data; // اضافه کردن سطر تکی
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
                // به‌جای اختصاص مستقیم ($rows = $potential_rows) از ادغام استفاده می‌کنیم
                // و دستور break را حذف می‌کنیم تا تمام لیست‌های رکورد استخراج شوند.
                $rows = array_merge($rows, $potential_rows);
            }
        }
    }
    
    return $rows;
}


// --------------------------------------------------
// تابع فراخوانی وب‌سرویس (اصلاح شده برای پذیرش category)
// --------------------------------------------------
function check_payesh($id, $type, $year, $category) 
{
    $webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
    $chech_result = null; 

    if (!class_exists('SoapClient')) {
        die("Fatal Error: SOAP extension is not installed.");
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
        error_log("SOAP Fault for category {$category}: Could not fetch data. Error: " . $e->getMessage());
    } catch (Exception $e) {
        $chech_result = false;
        error_log("General Error for category {$category}: Could not fetch data. Error: " . $e->getMessage());
    }

    return $chech_result;
}

// --------------------------------------------------
// منطق اصلی تبدیل به CSV و دانلود (ترکیب و حذف تکرار)
// --------------------------------------------------

// **تغییر اعمال شده:** فراخوانی تابع برای Category '0' و '4'
$soap_result_0 = check_payesh(1, 2, 3, 0);
$soap_result_4 = '';

$results_to_process = array();
$all_rows = array(); 
$unique_keys = array(); // برای حذف تکرار: id_Ostan

// تبدیل نتایج موفق به آرایه برای پردازش
if ($soap_result_0 !== false && $soap_result_0 !== null) {
    $results_to_process[] = object_to_array_php53($soap_result_0);
}

if ($soap_result_4 !== false && $soap_result_4 !== null) {
    $results_to_process[] = object_to_array_php53($soap_result_4);
}

if (empty($results_to_process)) {
    die("Error: Could not retrieve valid data from webservice for categories '0' or '4'.");
}

// 2. نرمال‌سازی و ترکیب سطرها با **حذف تکرار با کلید مرکب**
foreach ($results_to_process as $report_data) {
    
    // استفاده از تابع اصلاح شده برای استخراج کامل رکوردها
    $current_rows_raw = extract_rows_from_data($report_data);
    
    // **حذف تکرار:** بررسی id و Ostan قبل از افزودن
    foreach ($current_rows_raw as $row) {
        $row = (array)$row; 
        
        // ساخت کلید مرکب: id_Ostan
        if (isset($row['id']) && isset($row['Ostan'])) {
            $composite_key = $row['id'] . '_' . $row['Ostan'];
            
            // اگر این کلید قبلاً اضافه نشده باشد
            if (!isset($unique_keys[$composite_key])) {
                $all_rows[] = $row;
                $unique_keys[$composite_key] = true; // ثبت کلید مرکب
            }
        } else {
            // اگر id یا Ostan وجود نداشت، رکورد را اضافه می‌کنیم.
            $all_rows[] = $row;
        }
    }
}

if (empty($all_rows)) {
    die("Error: Data is empty or structure is still unrecognized.");
}

// 3. نوشتن هدرها و سطرها
$csv_headers = array('id', 'Ostan', 'shahrestan', 'username', 'Amount', 'Code', 'Year', 'Count');
fputcsv($output, $csv_headers); 

foreach ($all_rows as $row) {
    
    $csv_line = array();
    // استخراج مقادیر بر اساس کلیدهای هدر
    foreach ($csv_headers as $header_key) {
        $csv_line[] = isset($row[$header_key]) ? $row[$header_key] : '';
    }
    fputcsv($output, $csv_line);
}

fclose($output);
exit();
?>