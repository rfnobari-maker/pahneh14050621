<?php
// image_handler.php
// این فایل مسئول مدیریت درخواست‌های AJAX برای آپلود و حذف تصویر است.
include('lock_p1.php'); // اطمینان از دسترسی مجاز
include('date_con.php');
include('event.php');
require_once('Jalali.php');
include('login/config.php');

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

// تعریف پاسخ نهایی با سینتکس array() برای PHP 5.3
$response = array(
    'success' => false, 
    'message' => 'عملیات ناموفق.', 
    'html' => '', 
    'is_uploaded' => false
);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_type'])) {
    
    // استفاده از $user_check از lock_p1.php امن‌تر است
    $username = $user_check; 

    // ----------------------------------------------------
    // تابع کمکی برای نمایش مجدد تصویر یا تصویر پیش‌فرض
    // ----------------------------------------------------
    function generate_image_html($dbh, $username) {
        $query = "SELECT pic FROM users WHERE username=?";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array($username)); // سازگار با 5.3
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $pic = isset($row['pic']) ? $row['pic'] : '';
        $root = isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '';

        if ($pic <> "") {
            $image_path = 'files/users/'.$pic;
            $disk = $root.'/files/users/'.$pic;
            $mtime = file_exists($disk) ? filemtime($disk) : time();
            $src = htmlspecialchars($image_path.'?m='.$mtime, ENT_QUOTES, 'UTF-8');
            $html = '<img class="agri1-photo-img" id="user_pic" src="'.$src.'" width="87" height="107" alt="تصویر پرسنلی"><p class="agri1-photo-actions"><button type="button" class="agri1-btn agri1-btn-ghost" id="del_pic_btn">حذف تصویر</button></p>';
            return array('html' => $html, 'is_uploaded' => true); // سازگار با 5.3
        } else {
            $html = '<img class="agri1-photo-img" id="user_pic" src="files/users/no_pic.png" width="87" height="107" alt="تصویر پرسنلی">';
            return array('html' => $html, 'is_uploaded' => false); // سازگار با 5.3
        }
    }

    // ----------------------------------------------------
    // حذف تصویر
    // ----------------------------------------------------
    if ($_POST['action_type'] === 'delete') {
        
        $query = "SELECT pic FROM users WHERE username=?";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array($username));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $pic_name = $row['pic'];

        if (!empty($pic_name)) {
            $file_path = $_SERVER['DOCUMENT_ROOT'].'/files/users/'.$pic_name;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        
        $query = "UPDATE users SET pic=? WHERE username=?";
        $q = $dbh->prepare($query);
        $q->execute(array('',$username));
        
        sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','حذف تصویر کاربر',$id_ostan);
        
        $response['success'] = true;
        $response['message'] = 'تصویر با موفقیت حذف شد.';
        $response = array_merge($response, generate_image_html($dbh, $username)); // سازگار با 5.3

    // ----------------------------------------------------
    // آپلود تصویر
    // ----------------------------------------------------
    } elseif ($_POST['action_type'] === 'upload' && isset($_FILES['pic'])) {
        
        $file = $_FILES['pic'];
        $folder = 'files/users';
        $allowed_types = array('jpg', 'JPG', 'jpeg', 'gif', 'png'); // سازگار با 5.3
        $min_size = 2000; // 2 کیلوبایت
        $max_size = 30000; // 30 کیلوبایت
        
        // اعتبارسنجی سمت سرور
        $file_name = $file['name'];
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        if (!in_array($ext, $allowed_types)) {
            $response['message'] = 'نوع فایل مجاز نیست: '.$ext;
        } elseif ($file['size'] < $min_size || $file['size'] > $max_size) {
            $response['message'] = 'حجم فایل باید بین ۲ تا ۳۰ کیلوبایت باشد.';
        } else {
            // ساخت نام فایل بهینه و ایمن
            $new_file_name = strrev($username) . '.' . $ext;
            $upload_path = $_SERVER['DOCUMENT_ROOT'].'/'.$folder.'/'.$new_file_name;

            // تلاش برای آپلود
            if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                
                // به‌روزرسانی دیتابیس
                $query = "UPDATE users SET pic=? WHERE username=?";
                $q = $dbh->prepare($query);
                $q->execute(array($new_file_name, $username)); // سازگار با 5.3
                
                // تنظیم مجوزها (0644 امن‌تر از 0777)
                chmod($upload_path, 0644); 
                
                sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','آپلود تصویر کاربر',$id_ostan);
                
                $response['success'] = true;
                $response['message'] = 'تصویر با موفقیت آپلود شد.';
                
            } else {
                $response['message'] = 'خطا در ذخیره فایل در سرور.';
            }
        }
        
        // حتماً HTML را تولید و برگردانید
        $response = array_merge($response, generate_image_html($dbh, $username));
    }
}

header('Content-Type: application/json');
echo json_encode($response); // سازگار با PHP 5.3
?>