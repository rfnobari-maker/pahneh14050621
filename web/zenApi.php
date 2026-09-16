<?php
// URL API برای دریافت نقل‌قول تصادفی
$api_url = 'https://zenquotes.io/api/random';

// ایجاد یک درخواست cURL
$ch = curl_init($api_url);

// تنظیمات cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // در صورت نیاز به غیرفعال کردن تایید SSL

// اجرای درخواست و دریافت نتیجه JSON
$response_json = curl_exec($ch);

// بستن درخواست cURL
curl_close($ch);

// بررسی نتیجه برای اطمینان از موفقیت درخواست
if ($response_json !== false) {
    // تبدیل JSON به آرایه PHP
    $response = json_decode($response_json, true);
    
    // بررسی موفقیت تبدیل و وجود داده در پاسخ
    if (is_array($response) && isset($response[0])) {
        // دریافت متن نقل‌قول و نویسنده
        $quote_text = $response[0]['q'];
        $quote_author = $response[0]['a'];
        
        // نمایش نقل‌قول در صفحه
        echo "<p>\"$quote_text\" - $quote_author</p>";
    } else {
        echo "نقل‌قولی پیدا نشد.";
    }
} else {
    echo "خطا در ارتباط با API.";
}
?>
