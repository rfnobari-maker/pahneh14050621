<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

// ==================================================
// 🚨 اتصال به پایگاه داده از طریق فایل config.php (PDO)
// ==================================================
include('../login/config.php');

// نام جدول مورد نظر برای درج اطلاعات
$TABLE_NAME = "kood_kol"; 

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

// ==================================================
// 🚨 تابع جدید برای نمایش پیام‌های فارسی و استایل‌دار
// ==================================================

/**
 * نمایش پیام نتیجه با استایل زیبا و فارسی
 * @param string $type نوع پیام (success, error, info)
 * @param string $message متن پیام فارسی
 */
function output_message($type, $message) {
    // تنظیمات استایل بر اساس نوع پیام
    $styles = array(
        'success' => array('icon' => '✅', 'color' => '#007000', 'bg' => '#e6ffe6', 'border' => '#00aa00', 'title' => 'عملیات موفقیت‌آمیز'),
        'error'   => array('icon' => '❌', 'color' => '#cc0000', 'bg' => '#ffeeee', 'border' => '#cc0000', 'title' => 'خطا در اجرا'),
        'info'    => array('icon' => '💡', 'color' => '#0056b3', 'bg' => '#e6f7ff', 'border' => '#0099ff', 'title' => 'اطلاع‌رسانی')
    );
    
$style = isset($styles[$type]) ? $styles[$type] : $styles['info'];

    // HTML نهایی برای نمایش در پاپ‌آپ
    $html_output = '<!DOCTYPE html>
        <html lang="fa" dir="rtl">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>' . $style['title'] . '</title>
            <style>
                body {
                    font-family: tahoma, Arial, sans-serif;
                    background-color: #f0f0f0;
                    margin: 0;
                    padding: 0;
                    text-align: center;
                }
                .message-box {
                    width: 90%;
                    max-width: 380px;  
                    min-height: 250px; 
                    margin: 20px auto;
                    padding: 20px;
                    border: 1px solid ' . $style['border'] . ';
                    background-color: ' . $style['bg'] . ';
                    color: ' . $style['color'] . ';
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                }
                h3 {
                    margin-top: 0;
                    font-size: 16px;
                    color: ' . $style['color'] . ';
                }
                .icon {
                    font-size: 24px;
                    display: block;
                    margin-bottom: 10px;
                }
                button {
                    padding: 8px 15px;
                    margin-top: 15px;
                    background-color: ' . $style['border'] . ';
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-family: Tahoma;
                    font-size: 14px;
                }
            </style>
        </head>
        <body>
            <div class="message-box">
                <span class="icon">' . $style['icon'] . '</span>
                <h3>' . $style['title'] . '</h3>
                <p>' . $message . '</p>
                <button onclick="window.close()">بستن پنجره</button>
            </div>
        </body>
        </html>';

    echo $html_output;
    exit;
}

// --------------------------------------------------
// تابع فراخوانی وب‌سرویس (با اصلاحات خطایابی)
// --------------------------------------------------
function check_payesh($id, $type, $year)
{
    $webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
    $chech_result = null; 

    if (!class_exists('SoapClient')) {
        output_message('error', "خطای کشنده: اکستنشن SOAP مورد نیاز برای برقراری ارتباط با وب‌سرویس نصب نشده است.");
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
            "typeName" => "hemayat", "year" => 1404,"category" => -1 
        ));

        if (isset($res->GetAbstractReportResult)) {
            $chech_result = $res->GetAbstractReportResult; 
        } else {
            $chech_result = false; 
        }

    } catch (SoapFault $e) {
        output_message('error', "خطای SOAP: امکان دریافت اطلاعات از وب‌سرویس وجود نداشت.<br><strong>جزئیات خطا:</strong> " . $e->getMessage());
    } catch (Exception $e) {
        output_message('error', "خطای عمومی: امکان دریافت اطلاعات از وب‌سرویس وجود نداشت.<br><strong>جزئیات خطا:</strong> " . $e->getMessage());
    }

    return $chech_result;
}

// --------------------------------------------------
// منطق اصلی: دریافت داده، پاک‌سازی و درج در MySQL با PDO
// --------------------------------------------------

// 1. بررسی شیء اتصال PDO (dbh)
if (!isset($dbh) || !($dbh instanceof PDO)) {
    output_message('error', "خطای کشنده: شیء اتصال PDO به پایگاه داده پیدا نشد یا در config.php مقداردهی اولیه نشده است.");
}


// 2. دریافت داده‌ها از وب‌سرویس
$soap_result = check_payesh(1, 2, 3);

if ($soap_result === false || $soap_result === null) {
    output_message('error', "خطا: امکان دریافت اطلاعات معتبر از وب‌سرویس وجود نداشت.");
}

$report_data = object_to_array_php53($soap_result);

// --- تعریف نگاشت فیلدها ---
$field_map = array(
    'id'         => 'id',
    'id_ostan'   => 'Ostan', 
    'id_city'    => 'shahrestan', 
    'code'       => 'Code',
    'year'       => 'Year',
    'Count'      => 'Count',
    'category'   => 'category',
);
$db_fields = array_keys($field_map); 
$ws_fields = array_values($field_map); 
// --------------------------

$rows = array();

// 3. نرمال‌سازی داده‌ها (همانند قبل)
if (isset($report_data['id'])) {
    $rows = array($report_data);
} elseif (!empty($report_data) && is_array($report_data)) {
    foreach ($report_data as $key => $potential_rows) {
        $first_item = null;
        if (is_array($potential_rows) && !empty($potential_rows)) {
            $first_item = reset($potential_rows);
        }
        if (is_array($potential_rows) && is_array($first_item) && (isset($first_item['id']) || isset($first_item['Ostan']))) {
            $rows = $potential_rows;
            break;
        }
    }
}

if (empty($rows)) {
    output_message('info', "موفقیت: داده‌های دریافتی از وب‌سرویس خالی بود.<br>هیچ رکوردی برای درج/به‌روزرسانی وجود ندارد.");
}


// 4. پاک‌سازی جدول: حذف تمامی سطرها (PDO Execute)
$truncate_query = "TRUNCATE TABLE `$TABLE_NAME`";

try {
    $dbh->exec($truncate_query);
    $truncate_message = "✅ جدول کود با موفقیت خالی شد.<br>";
} catch (PDOException $e) {
    output_message('error', "خطا در پاک‌سازی (Truncate) جدول <strong>`" . $TABLE_NAME . "`</strong>:<br><strong>جزئیات خطا:</strong> " . $e->getMessage());
}


// 5. ساخت و اجرای کوئری INSERT با Prepared Statements
$fields = implode(', ', array_map(function($f) { return "`$f`"; }, $db_fields)); 
$placeholders = implode(', ', array_fill(0, count($db_fields), '?')); 

$insert_query = "INSERT INTO `$TABLE_NAME` ($fields) VALUES ($placeholders)";

try {
    $stmt = $dbh->prepare($insert_query);
    $records_inserted = 0;
    
    foreach ($rows as $row) {
        $row = (array)$row; 
        $bind_values = array();
        

        foreach ($ws_fields as $ws_key) {
            $bind_values[] = isset($row[$ws_key]) ? (string)$row[$ws_key] : '';
        }
        
        if ($stmt->execute($bind_values)) {
            $records_inserted++;
        }
    }

    // پیام نهایی موفقیت: شامل پاک‌سازی و تعداد رکوردها
    $final_message = $truncate_message . "
        <br>
        ✅ <strong>تعداد " . $records_inserted . " رکورد جدید</strong> با موفقیت از وب‌سرویس دریافت و در جدول کود درج شد.
        <br>
    ";
    
    output_message('success', $final_message);

} catch (PDOException $e) {
    output_message('error', "خطا در درج رکوردهای جدید در جدول <strong>`" . $TABLE_NAME . "`</strong>:<br><strong>جزئیات خطا:</strong> " . $e->getMessage());
}

// 6. بستن اتصال
$dbh = null;
?>