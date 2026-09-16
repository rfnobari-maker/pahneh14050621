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

// --------------------------------------------------
// تابع فراخوانی وب‌سرویس (با پارامتر category)
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
        // خطا را چاپ می‌کنیم اما اجرای اسکریپت را متوقف نمی‌کنیم تا فرصت دهیم نتیجه دیگر ثبت شود
        echo "SOAP Fault for category {$category}: Could not fetch data. Error: " . $e->getMessage() . "\n"; 
    } catch (Exception $e) {
        $chech_result = false;
        echo "General Error for category {$category}: Could not fetch data. Error: " . $e->getMessage() . "\n";
    }

    return $chech_result;
}

// --------------------------------------------------
// منطق اصلی تبدیل به CSV و دانلود
// --------------------------------------------------

// 1. فراخوانی تابع برای Category '0' (زراعت)
$soap_result_0 = check_payesh(1, 2, 3, 0);

// 2. فراخوانی تابع برای Category '4' (سبزی)
$soap_result_4 = check_payesh(1, 2, 3, 4);

$results_to_process = array();
$all_rows = array(); // آرایه نهایی سطرها
$unique_ids = array(); // برای جلوگیری از تکرار

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

// 3. نرمال‌سازی و ترکیب سطرها با **حذف تکرار**
foreach ($results_to_process as $report_data) {
    
    $current_rows_raw = array();
    
    // الف) اگر خروجی فقط یک سطر تکی بود
    if (isset($report_data['id'])) {
        $current_rows_raw = array($report_data);
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
                $current_rows_raw = $potential_rows;
                break;
            }
        }
    }
    
    // **حذف تکرار:** بررسی id قبل از افزودن به آرایه نهایی
    foreach ($current_rows_raw as $row) {
        $row = (array)$row; 
        
        if (isset($row['id'])) {
            $record_id = $row['id'];
            
            // اگر این id قبلاً اضافه نشده باشد
            if (!isset($unique_ids[$record_id])) {
                $all_rows[] = $row;
                $unique_ids[$record_id] = true; // ثبت id
            }
        } else {
            // اگر id موجود نبود، رکورد را اضافه می‌کنیم (با ریسک تکرار)
            $all_rows[] = $row;
        }
    }
}

if (empty($all_rows)) {
    die("Error: Data is empty or structure is still unrecognized. Check the output structure using print_r.");
}

// 4. نوشتن هدرها و سطرها
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