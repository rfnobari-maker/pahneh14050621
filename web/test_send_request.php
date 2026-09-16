<?php
include 'Send_Request.php';

// --- مقادیر ورودی که باید ارسال شوند ---
$national_id = "1380066174";
$area_id = 13520311;
$year = 1404;
$category = 0;
$change_type = "ChangeProduct";
$old_value = "106";
$new_value = "107";
$update_date = "1404/10/27";
$msg_code = 0;
$message = "تصحیح نام محصول کشت شده 1";

// فراخوانی تابع با پارامترهای کمتر
$result = send_changes_info($national_id, $area_id, $year, $category, $change_type, $old_value, $new_value, $update_date, $msg_code, $message);
//echo "Result: " . $result . "\n";
if ($result == 1 ) echo 'ثبت اطلاعات با موفقیت انجام شد' ; else echo 'خطای رخ داده بعدا تلاش کنید' ; 

