<?php
// برای لاگ کردن داده‌های دریافتی
//file_put_contents('debug.log', "داده‌های دریافتی: " . print_r($data, true) . "\n", FILE_APPEND);

include ('./login/config.php');

// تابع برای تولید رشته تصادفی
function rand_string($length) {
    $str = "";
    $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[rand(0, $size - 1)];
    }
    return $str;
}

// دریافت داده‌های ورودی از درخواست
$data = json_decode(file_get_contents("php://input"), true);
$newPassword = $data['newPassword'];
$username = $data['username'];

// بررسی اینکه آیا نام کاربری و کلمه عبور جدید موجود است
if (empty($username) || empty($newPassword)) {
  //  file_put_contents('debug.log', "خطا: نام کاربری و کلمه عبور جدید الزامی است.\n", FILE_APPEND);
    echo "نام کاربری و کلمه عبور جدید الزامی است.";
    exit;
}

// تولید نمک تصادفی و هش کردن کلمه عبور جدید
$p_salt = rand_string(20);
$site_salt = "subinsblogsalt";
$salted_hash = hash('sha256', $newPassword . $site_salt . $p_salt);

// بررسی اتصال به دیتابیس
if ($dbh == null) {
    //file_put_contents('debug.log', "خطا: اتصال به دیتابیس برقرار نشد.\n", FILE_APPEND);
    echo "مشکلی در اتصال به دیتابیس وجود دارد.";
    exit;
}

// به‌روزرسانی کلمه عبور در دیتابیس
try {
     $date_today = date('Y-m-d');
     $query = "UPDATE users SET date_pas=?, password=?, psalt=? WHERE username=?";
     $q = $dbh->prepare($query);
     $q->execute(array($date_today, $salted_hash, $p_salt, $username));
    // لاگ کردن تعداد ردیف‌های تحت تأثیر
    //file_put_contents('debug.log', "تعداد ردیف‌های تحت تأثیر: " . $q->rowCount() . "\n", FILE_APPEND);

    // بررسی موفقیت عملیات
    if ($q->rowCount() > 0) {
      //  file_put_contents('debug.log', "خروجی: کلمه عبور با موفقیت تغییر یافت.\n", FILE_APPEND);
        echo "کلمه عبور با موفقیت تغییر یافت.";
    } else {
       // file_put_contents('debug.log', "خروجی: خطا در تغییر کلمه عبور یا نام کاربری پیدا نشد.\n", FILE_APPEND);
        echo "خطا در تغییر کلمه عبور یا نام کاربری پیدا نشد.";
    }

} catch (PDOException $e) {
    // لاگ کردن خطای PDO
//    file_put_contents('debug.log', "خطای PDO: " . $e->getMessage() . "\n", FILE_APPEND);
    echo "خطا در تغییر کلمه عبور.";
}
?>
