<?php
// --- منطق PHP موجود (مدیریت نشست و احراز هویت) ---

if (session_id() == '')  session_start();

// تنظیم زمان انقضای جلسه به 1 ساعت (3600 ثانیه)
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);

// بررسی اینکه آیا جلسه فعال است
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 3600) {
    session_unset();
    session_destroy();
    if (isset($dbh)) $dbh = null;
    header("Location: /login/login.php?message=timeout");
    exit();
} else {
    $_SESSION['last_activity'] = time();
}

$actual_link = "https://$_SERVER[HTTP_HOST]";
if (isset($_SESSION['title'])) $title = $_SESSION['title'];
if (isset($_SESSION['login_user'])) $user_check = $_SESSION['login_user'];
if (isset($_SESSION['karbar'])) $karbar_m = $_SESSION['karbar'];
if (isset($_SESSION['username'])) $login_session = $_SESSION['username'];
if (isset($_SESSION['cod_m'])) $cod_m_session = $_SESSION['cod_m'];
if (isset($_SESSION['PersName'])) $PersName = $_SESSION['PersName'];
if (isset($PersName)) $euser = $PersName;
if (isset($_SESSION['ostan'])) $ostan = $_SESSION['ostan'];
if (isset($_SESSION['city'])) $city = $_SESSION['city'];
if (isset($_SESSION['id_ostan'])) $id_ostan = $_SESSION['id_ostan'];
if (isset($_SESSION['id_city'])) $id_city = $_SESSION['id_city'];
if (isset($_SESSION['markaz'])) $markaz = $_SESSION['markaz'];
if (isset($_SESSION['id_mar'])) $id_mar = $_SESSION['id_mar'];
if (isset($_SESSION['name'])) $name = $_SESSION['name'];
if (isset($_SESSION['v_jen'])) { $v_jen = $_SESSION['v_jen']; } else {  $v_jen = ''; }
if (isset($_SESSION['pic'])) $pic = $_SESSION['pic'];
if (isset($_SESSION['no_karbar'])) $no_karbar = $_SESSION['no_karbar'];
if (isset($_SESSION['date_pas'])) $date_pas = $_SESSION['date_pas'];

if (!isset($login_session) || $karbar_m != '1') {
    if (isset($_SESSION)) session_destroy();
    if (isset($dbh)) $dbh = null;
    header("Location: {$actual_link}/login/login.php");
    exit();
}

// --- پایان منطق PHP موجود ---
// --- شروع کدهای تزریقی برای نمایش پیام‌ها ---

// ۱. تعریف پیام‌های سیستم و کلیدهای مجزا
$message_1_text = "⚠️ **پیام اضطراری:** در ثبت محصول زراعی دقت فرمایید ، پس از دریافت کود ، حذف و ویرایش مقدور نخواهد بود.";
$message_1_key = 'systemMessageHidden_Emergency'; // کلید مجزا

$message_2_text = "📣 **اطلاعیه:** سرشماری سراسری زنبورستان های کشور شنبه 5 مهر آغاز خواهد شد .";
$message_2_key = 'systemMessageHidden_Training';  // کلید مجزا

?>
<style>
    /* استایل پایه برای هر دو پیام */
    .corner-fixed-message {
        position: fixed;
        right: 15px;
        z-index: 9999;
        padding: 12px 20px;
        border-radius: 6px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        direction: rtl; 
        font-family: Tahoma, sans-serif;
        font-size: 0.9em;
        max-width: 350px;
    }
    
    /* استایل اختصاصی برای پیام ۱ (هشدار/اضطراری - بالاتر) */
    #message_1 {
        top: 15px;
        background-color: #f8d7da;
        color: #721c24;  
        border: 1px solid #f5c6cb;
    }
    
    /* استایل اختصاصی برای پیام ۲ (اطلاعیه - کمی پایین‌تر) */
    #message_2 {
        top: 130px; /* تنظیم موقعیت نسبت به پیام اول */
        background-color: #d1ecf1;
        color: #0c5460;  
        border: 1px solid #bee5eb;
    }

    /* استایل دکمه‌های کنترلی */
    .corner-fixed-message .control-buttons {
        float: left; /* قرارگیری دکمه‌ها در سمت چپ پیام */
        margin-left: 5px;
        /* Line up buttons with text */
        line-height: 1.2; 
    }
    .corner-fixed-message button {
        background: none;
        border: none;
        font-weight: bold;
        cursor: pointer;
        font-size: 1.2em;
        padding: 0 4px;
        margin: 0;
    }
    /* رنگ دکمه‌ها برای پیام ۱ */
    #message_1 button { color: #721c24; }
    /* رنگ دکمه‌ها برای پیام ۲ */
    #message_2 button { color: #0c5460; }

</style>

<div id="message_1" class="corner-fixed-message" style="display: none;">
    <?php echo $message_1_text; ?>
    <span class="control-buttons">
        <button title="بستن موقت" 
                onclick="temporarilyHide('message_1');">×</button>
        <button title="حذف دائمی" 
                onclick="permanentlyHide('message_1', '<?php echo $message_1_key; ?>');">🗑️</button>
    </span>
</div>

<div id="message_2" class="corner-fixed-message" style="display: none;">
    <?php echo $message_2_text; ?>
    <span class="control-buttons">
        <button title="بستن موقت" 
                onclick="temporarilyHide('message_2');">×</button>
        <button title="حذف دائمی" 
                onclick="permanentlyHide('message_2', '<?php echo $message_2_key; ?>');">🗑️</button>
    </span>
</div>


<script>
    /**
     * بررسی می‌کند که آیا پیام باید نمایش داده شود یا خیر (بر اساس localStorage).
     * @param {string} elementId - شناسه HTML پیام (مثلا: 'message_1')
     * @param {string} storageKey - کلید localStorage مجزا
     */
    function checkMessageStatus(elementId, storageKey) {
        const messageBox = document.getElementById(elementId);
        // اگر کلید ذخیره‌شده‌ای وجود نداشت، پیام را نمایش بده
        if (localStorage.getItem(storageKey) !== 'true') {
            messageBox.style.display = 'block';
        }
        // در غیر این صورت، مخفی بماند (طبق وضعیت localStorage)
    }

    /**
     * پیام را فقط برای این صفحه مخفی می‌کند (بستن موقت).
     * @param {string} elementId - شناسه HTML پیام
     */
    function temporarilyHide(elementId) {
        document.getElementById(elementId).style.display = 'none';
        // توجه: در این تابع از localStorage استفاده نمی‌شود، بنابراین در صفحات دیگر مجدداً نمایش داده می‌شود.
    }

    /**
     * پیام را مخفی کرده و وضعیت را در localStorage ذخیره می‌کند (حذف دائمی).
     * @param {string} elementId - شناسه HTML پیام
     * @param {string} storageKey - کلید localStorage مجزا
     */
    function permanentlyHide(elementId, storageKey) {
        // ۱. پیام را در صفحه جاری مخفی کن
        document.getElementById(elementId).style.display = 'none';
        
        // ۲. وضعیت را در مرورگر ذخیره کن تا در صفحات دیگر هم مخفی بماند
        localStorage.setItem(storageKey, 'true');
    }

    // اجرای تابع بررسی وضعیت برای هر پیام هنگام بارگذاری صفحه
    checkMessageStatus('message_1', '<?php echo $message_1_key; ?>');
    checkMessageStatus('message_2', '<?php echo $message_2_key; ?>');
</script>

<?php
// --- پایان کدهای تزریقی ---
?>