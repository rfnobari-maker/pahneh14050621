<?php
/**
 * فایل اتصال به پایگاه داده
 * این فایل باید در ابتدای تمام صفحات با require_once('../../login/config.php') فراخوانی شود
 */

// بررسی اینکه آیا قبلاً کانکشن برقرار شده یا نه (جلوگیری از ایجاد کانکشن تکراری)
if (!isset($dbh)) {
    $dsn = 'mysql:dbname=eagri_pahneh;host=localhost';
    $user = 'eagri_upahneh';
    $password = 'Reza9147857121';
    
    try {
        $dbh = new PDO($dsn, $user, $password);
        $dbh->exec('set names utf8');
        // تنظیم حالت خطا برای مدیریت بهتر خطاها
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // غیرفعال کردن emulated prepares برای امنیت بیشتر
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
        // در محیط production بهتر است خطا را لاگ کنید نه نمایش دهید
        error_log('Database connection failed: ' . $e->getMessage());
        die('خطا در اتصال به پایگاه داده. لطفاً با مدیر سیستم تماس بگیرید.');
    }
}

// تابع برای بستن کانکشن
function closeConnection() {
    global $dbh;
    if (isset($dbh) && $dbh instanceof PDO) {
        $dbh = null;
    }
}

// ثبت تابع برای اجرا در پایان اسکریپت (فقط یک بار)
// این تابع به صورت خودکار در پایان اجرای هر صفحه، کانکشن را می‌بندد
if (!defined('DB_SHUTDOWN_REGISTERED')) {
    register_shutdown_function('closeConnection');
    define('DB_SHUTDOWN_REGISTERED', true);
}


// ثبت تابع برای اجرا در پایان اسکریپت (فقط یک بار)
if (!defined('DB_SHUTDOWN_REGISTERED')) {
    register_shutdown_function('closeConnection');
    define('DB_SHUTDOWN_REGISTERED', true);
}
//$query = "SELECT * from Pay_User";
//$stmt = $dbh->prepare($query);
//$stmt->execute();
// $row تک خطی 
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
//echo $row['User_Name'] ; 
// $row حلقه ای
// foreach($stmt as $row){
//    echo "User : " . $row['Last_Name'] . "<br />";
//}
// شمارش تعداد ردیف ها 
//echo 'Rows: '.$stmt -> rowCount();


//// insert 
//$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
//$title = 'PHP Security';
//$author = 'Jack Hijack';
//$query = "INSERT INTO books (title,author) VALUES (:title,:author)";
//$q = $dbh->prepare($query);
//$q->execute(array(':author'=>$author,':title'=>$title));


////update
//$title = 'PHP Pattern';
//$author = 'Imanda';
//$id = 3;
//$query = "UPDATE books 
//        SET title=?, author=?
//		WHERE id=?";
//$q = $dbh->prepare($query);
//$q->execute(array($title,$author,$id));


////delete
//$sql = "DELETE FROM movies WHERE filmID =  :filmID";
//$stmt =  $dbh->prepare($sql);
//$stmt->bindParam(':filmID', $_POST['filmID'], PDO::PARAM_INT);   
//$stmt->execute();
//

// clos conntection 
//$dbh = null;
?>