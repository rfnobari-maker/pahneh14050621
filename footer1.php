<meta charset="utf-8">
<p class="MenuItemRight">کلیه حقوق مادی و معنوی این سامانه متعلق به مرکز فناوری اطلاعات و ارتباطات وزارت جهاد کشاورزی می باشد </p>
<?php
// --- شروع کدهای تزریقی برای نمایش پیام‌ها ---

// ۱. تعریف پیام‌های سیستم و کلیدهای مجزا
$message_1_text = "⚠️ **پیام اضطراری:**  ثبت و ویرایش اطلاعات زراعی سال 1404-1403 روز شنبه 23 خرداد مسدود خواهد شد  ";
$message_1_key = 'systemMessageHidden_Emergency_0317'; // کلید مجزا

//$message_2_text = "⚠️ **پیام اضطراری:**  امکان ثبت درخواست تغییر بهره بردار زراعی مقدور شد  ";
//$message_2_key = 'systemMessageHidden_Emergency_0202'; // کلید مجزا

//$message_2_text = "📣 **اطلاعیه:** امکان ثبت درخواست تغییر محصول ، مساحت و کد ملی بهره برداران زراعی 1405-1404 فعال شد ، مشاهده راهنما .";

//$message_2_text = '📣 <strong>اطلاعیه:</strong> ثبت درخواست تغییر محصول ، مساحت و کد ملی بهره برداران زراعی 1405-1404 ، 
//<a href="../../../login/help/Change_Request.pdf" title="برای مشاهده راهنما کیلک کنید" target="_blank" style="color:#00999; text-decoration: underline; font-weight: bold;">
//مشاهده راهنما
//</a>.';
//$message_2_key = 'systemMessageHidden_Training_1121';  // کلید مجزا

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
        max-width: 750px;
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
        <button title="حذف دائمی پیام (دیگر نمایش داده نخواهد شد)" 
                onclick="permanentlyHide('message_1', '<?php echo $message_1_key; ?>');">🗑️</button>
    </span>
</div>

<div id="message_2" class="corner-fixed-message" style="display: none;">
    <?php echo $message_2_text; ?>
    <span class="control-buttons">
        <button title="حذف دائمی پیام (دیگر نمایش داده نخواهد شد)" 
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
//   checkMessageStatus('message_2', '<?php echo $message_2_key; ?>');
</script>

<?php
?>
</body>
</html>
