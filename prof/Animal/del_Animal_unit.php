<?php 
include("../../lock_p1.php");
include('../../login/config.php');
include('../../event.php');
require_once('../../Jalali.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['partIDCode'])) {
    // دریافت و فیلتر ورودی‌ها برای جلوگیری از حملات SQL Injection
    $partIDCode = filter_input(INPUT_POST, 'partIDCode', FILTER_SANITIZE_STRING);
    $bah_cod_m = filter_input(INPUT_POST, 'bah_cod_m', FILTER_SANITIZE_STRING);
    $add_abadi = filter_input(INPUT_POST, 'add_abadi', FILTER_SANITIZE_STRING);
    
    // بررسی وجود آمار دام
    $query = "SELECT count(*) FROM animals WHERE partIDCode = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($partIDCode));
    $result = $stmt->fetchColumn();
    if ($result > 0) {
        ?>
<?php 
    // پیام با کاراکترهای صحیح برای جلوگیری از خطا
    $message = "برای حذف اطلاعات واحد باید ابتدا آمار دام ثبت شده را حذف کنید";
?>
<script>
    alert('<?php echo addslashes($message); ?>');
    setTimeout(function() {
        window.close();
    }, 1000);
</script>
        <?php
        exit; // این خط در PHP است
    }

    // حذف اطلاعات واحد پرورش دام
    if (isset($bah_cod_m)) { 
        date_default_timezone_set('Asia/Tehran');
        $date_edit = jdate("Y/m/d");
        $time = date('H:i:s');
        
        $query = "DELETE FROM animals_unit WHERE PartIdCode = ?";
        $q = $dbh->prepare($query);
        $q->execute(array($partIDCode));

        // ثبت لاگ حذف
        sabt_event($login_session, getUserIP_1(), $date_edit, $time, $add_abadi, 'حذف واحد پرورش دام - ' . $bah_cod_m, $id_ostan);
        ?>
        <script>
            alert('اطلاعات با موفقیت حذف شد');
            window.opener.location.reload(); // بارگذاری مجدد صفحه اصلی
            window.close(); // بستن پنجره
        </script>
        <?php
    } else { 
        ?>
        <script>
            alert('خطایی در حذف اطلاعات رخ داده است');
            window.close();
        </script>
        <?php
    }
}
?>
