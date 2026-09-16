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
// تابع فراخوانی وب‌سرویس
// --------------------------------------------------
function check_payesh($id, $type, $year)
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
            "Method" => "GetResponseAction", 
            "typeName" => "hemayat", "year" => 1404,"category" => 1 
        ));
// catagory string zeratid = "0";
//            string baghid = "1";
//            string shilatid = "2";
//            string golkhaneid = "3";
//            string sabziid = "4";
//            string gharchid = "5";

        if (isset($res->GetAbstractReportResult)) {
            $chech_result = $res->GetAbstractReportResult; 
        } else {
            $chech_result = false; 
        }

    } catch (SoapFault $e) {
        $chech_result = false;
        die("SOAP Fault: Could not fetch data. Error: " . $e->getMessage()); 
    } catch (Exception $e) {
        $chech_result = false;
        die("General Error: Could not fetch data. Error: " . $e->getMessage());
    }

    return $chech_result;
}

// --------------------------------------------------
// منطق اصلی تبدیل به CSV و دانلود
// --------------------------------------------------

$soap_result = check_payesh(1, 2, 3);

if ($soap_result === false || $soap_result === null) {
    die("Error: Could not retrieve valid data from webservice.");
}

$report_data = object_to_array_php53($soap_result);

// تعریف هدرهای مورد نیاز
$csv_headers = array('id', 'Ostan', 'shahrestan', 'username', 'Amount', 'Code', 'Year', 'Count');
$rows = array();

// 1. نرمال‌سازی: بررسی و استخراج سطرها
if (isset($report_data['id'])) {
    // الف) اگر خروجی فقط یک سطر تکی بود
    $rows = array($report_data);
} elseif (!empty($report_data) && is_array($report_data)) {
    // ب) بررسی آرایه‌های تودرتو با استفاده از متغیر موقت (رفع خطای PHP 5.3.1)
    
    foreach ($report_data as $key => $potential_rows) {
        // ایجاد متغیر موقت برای اولین عنصر در آرایه تودرتو
        $first_item = null;
        if (is_array($potential_rows) && !empty($potential_rows)) {
            $first_item = reset($potential_rows);
        }
        
        // **اصلاح خطا:** بررسی متغیر موقت به جای عبارت پیچیده
        if (is_array($potential_rows) && is_array($first_item) && (isset($first_item['id']) || isset($first_item['Ostan']))) {
            $rows = $potential_rows;
            break;
        }
    }
}

if (empty($rows)) {
    die("Error: Data is empty or structure is still unrecognized. Check the output structure using print_r.");
}

// 2. نوشتن هدرها و سطرها
fputcsv($output, $csv_headers); 

foreach ($rows as $row) {
    $row = (array)$row; 
    
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