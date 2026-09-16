<?php 
include("lock_p1.php");
include('counter1.php');
// متغیرهای $tel_m و $valid توسط counter.php لود شده‌اند.
// $_SESSION['login_user'] در lock_p1.php یا قبل از آن تنظیم شده و برای شناسایی کاربر فعلی استفاده می‌شود.
$current_user_national_code = $_SESSION['login_user'];
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="FA.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <style>
        :root {
            --primary-color: #2563eb;
            --hover-color: #1d4ed8;
            --bg-color: #f0f4f8;
            --text-color: #1e293b;
            --card-bg: #ffffff;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --accent-color: #3b82f6;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: myfont, Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            width: 100%;
            margin: 0;
            padding: 0;
            background: var(--bg-color);
        }

        .header-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .content-section {
            padding: 0 20px;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* استایل‌های انیمیشن (کدهای موجود شما) */
        .card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 16px var(--shadow-color);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            opacity: 0;
            transform: translateY(30px);
            will-change: transform, opacity;
        }

        .card.animate {
            animation: cardEntrance 0.8s ease-out forwards;
        }

        @keyframes cardEntrance {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* تاخیرهای زمانی (کدهای موجود شما) */
        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }
        .card:nth-child(5) { animation-delay: 0.5s; }
        .card:nth-child(6) { animation-delay: 0.6s; }
        .card:nth-child(7) { animation-delay: 0.7s; }
        .card:nth-child(8) { animation-delay: 0.8s; }
        .card:nth-child(9) { animation-delay: 0.9s; }
        .card:nth-child(10) { animation-delay: 1.0s; }
        .card:nth-child(11) { animation-delay: 1.1s; }
        .card:nth-child(12) { animation-delay: 1.2s; }
        .card:nth-child(13) { animation-delay: 1.3s; }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--accent-color);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px var(--shadow-color);
        }

        .card:hover::before {
            transform: scaleX(1);
        }

        .card-icon {
            width: 66px;
            height: 66px;
            margin: 0 auto 20px;
            display: block;
            transition: all 0.4s ease;
            filter: drop-shadow(0 4px 8px var(--shadow-color));
        }

        .card:hover .card-icon {
            transform: scale(1.15) rotate(5deg);
            opacity: 0.8;
        }

        .btn {
            display: block;
            width: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 14px 0;
            border-radius: 12px;
            text-decoration: none;
            margin: 15px 0 0 0;
            text-align: center;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
        }

        .btn:hover::before {
            left: 100%;
        }

        @media (max-width: 768px) {
            .cards-container {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
                padding: 15px;
            }

            .card {
                padding: 15px;
            }
        }
        
/* --- استایل‌های جدید برای پاپ‌آپ اجباری --- */
        .verification-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* 💡 تغییر رنگ به خاکستری تیره با شفافیت کمتر */
            background-color: rgba(0, 0, 0, 0.70); /* رنگ سیاه با شفافیت ۷۰ درصد */
            /* شما می‌توانید از '0.5' برای شفافیت بیشتر یا '0.8' برای تیره‌تر شدن استفاده کنید. */
            
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000; 
        }
		
        .verification-modal {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            width: 90%;
            max-width: 450px;
            text-align: center;
            border: 3px solid #ef4444; 
        }

        .modal-title {
            color: #ef4444; 
            font-size: 22px;
            margin-bottom: 20px;
        }

        .modal-input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            direction: ltr; 
            text-align: center;
        }

        .modal-btn {
            display: block;
            width: 100%;
            background: linear-gradient(135deg, #22c55e, #10b981); 
            color: white;
            padding: 14px 0;
            border-radius: 12px;
            text-decoration: none;
            margin: 20px 0 0 0;
            text-align: center;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: background 0.3s;
        }

        .modal-btn:hover {
            background: linear-gradient(135deg, #10b981, #22c55e);
        }

        .modal-status {
            margin-top: 15px;
            font-weight: bold;
            min-height: 20px;
        }

        .modal-status .error-msg {
            color: #ef4444; 
            display: none;
        }

        .modal-status .success-msg {
            color: #10b981; 
            display: none;
        }

        body.modal-open {
            overflow: hidden; 
        }
        /* --- پایان استایل‌های جدید --- */
    </style>
</head>
<body>
    <div class="container">
        <img src="files/images/header.jpg" alt="header" class="header-image">
        
       <div dir="ltr"> <?php include('menu.php'); ?> </div>
        <?php include('top.php'); ?>

<?php 
// پاپ‌آپ تنها زمانی نمایش داده می‌شود که valid تنظیم شده باشد و مقدار آن '200' نباشد
if (isset($valid) && $valid != '200'): 
?>
<div class="verification-modal-overlay" id="verificationModal">
    <div class="verification-modal">
        <h3 class="modal-title">⛔ شماره همراه شما تایید نشده است ⛔</h3>
        
        <p style="color: #000000; font-weight: bold; font-size: 15px;">
           لطفا شماره همراه به نام خود را وارد کرده و روی دکمه ثبت و بررسی کلیک کنید. تا زمان تأیید ، دسترسی به صفحات بعدی مقدور نمیباشد.
        </p>

        <form id="telm-verification-form">
            <label style="display: block; margin-bottom: 5px; text-align: right; font-weight: 600;">شماره همراه شما:</label>
            
            <input name="tel_m" type="text" class="modal-input" 
                   id="tel_m_profile" value="<?php echo htmlspecialchars($tel_m); ?>" 
                   maxlength="11" placeholder="مثال: 09121234567" required />
                   
            <input type="hidden" name="id" value="0" /> 
            <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($current_user_national_code); ?>" />

            <div style="margin-top: 20px; display: flex; align-items: center; justify-content: center; font-size: 16px;">
               <span style="margin-left: 10px; font-weight: 600;">وضعیت احراز هویت:</span>
               <img id="modalStatusIcon" src="files/FAQ.png" title="در انتظار بررسی" width="30" height="20" alt="Status" />
            </div>
            
            <button type="submit" class="modal-btn" id="modalSubmitBtn">ثبت و بررسی شماره همراه</button>
            
            <div class="modal-status" id="modalStatusMessage">
                <span class="error-msg"></span>
                <span class="success-msg">✅ شماره همراه با موفقیت تأیید شد.</span>
            </div>
        </form>
    </div>
</div>
<script>
    // اعمال کلاس برای جلوگیری از اسکرول و قفل کردن صفحه
    document.body.classList.add('modal-open');
</script>
<?php endif; ?>
<div class="content-section">
            <div class="cards-container">
                <div class="card">
                    <a href="./profile.php" title="مدیریت اطلاعات کاربری">
                        <img src="files/request.jpg" alt="upload" class="card-icon">
                    </a>
                    <a href="./profile.php" class="btn">ویرایش اطلاعات کاربری</a>
                </div>

                <div class="card">
                    <a href="./lists_city.php" title="مشاهده لیست آبادی های تحت پوشش">
                        <img src="files/city.png" alt="users" class="card-icon">
                    </a>
                    <a href="./lists_city.php" class="btn">لیست شهرها :<?php echo $count_city ; ?></a>
                </div>

                <div class="card">
                    <a href="./lists_abadi.php" title="مشاهده لیست آبادی های تحت پوشش">
                        <img src="files/abadi.png" alt="users" class="card-icon">
                    </a>
                    <a href="./lists_abadi.php" class="btn">لیست آبادی ها :<?php echo $count ; ?></a>
                </div>

                <div class="card">
                    <a href="./list_pubabadi.php" title="مشاهده و ویرایش اطلاعات عمومی آبادی ها">
                        <img src="files/pub_abadi.png" alt="اطلاعاات عمومی آبادی" class="card-icon">
                    </a>
                    <a href="./list_pubabadi.php" class="btn">اطلاعات عمومی آبادی ها</a>
                </div>

                <div class="card">
                    <a href="./list_pubcity.php" title="مشاهده و ویرایش اطلاعات عمومی شهر ها">
                        <img src="files/city-pub.png" alt="اطلاعات عمومی شهر" class="card-icon">
                    </a>
                    <a href="./list_pubcity.php" class="btn">اطلاعات عمومی شهر ها</a>
                </div>

                <div class="card">
                    <a href="./prof/index.php">
                        <img src="files/p_abadi.png" alt="اطلاعات اختصاصی" class="card-icon">
                    </a>
                    <a href="./prof/index.php" class="btn">اطلاعات اختصاصی</a>
                </div>

                <div class="card">
                    <a href="./search_promo.php" title="جستجوی کاربران سیستم">
                        <img src="files/morvege2.png" alt="جستجو" class="card-icon">
                    </a>
                    <a href="./search_promo.php" class="btn">جستجوی کاربر</a>
                </div>

                <div class="card">
                    <a href="./list_expar.php" title="کارشناسان معین استان">
                        <img src="files/exp_ostan.png" alt="کارشناسان معین" class="card-icon">
                    </a>
                    <a href="./list_expar.php" class="btn">کارشناسان معین</a>
                </div>

                <div class="card">
                    <a href="./list_expar_sh.php" title="کارشناسان موضوعی شهرستان">
                        <img src="files/exp_city.png" alt="کارشناسان موضوعی" class="card-icon">
                    </a>
                    <a href="./list_expar_sh.php" class="btn">کارشناسان موضوعی</a>
                </div>

                <div class="card">
                    <a href="./list_scholar.php" title="محقق معین شهرستان">
                        <img src="files/scholar1.png" alt="محقق معین" class="card-icon">
                    </a>
                    <a href="./list_scholar.php" class="btn">محقق معین شهرستان</a>
                </div>

                <div class="card">
                    <a href="./list_Admin.php" title="ادمین استان">
                        <img src="files/admin.png" alt="ادمین استان" class="card-icon">
                    </a>
                    <a href="./list_Admin.php" class="btn">ادمین استانی سامانه</a>
                </div>

                <div class="card">
                    <a href="./Area_experts.php" title="سایر کارشناسان">
                        <img src="files/map.png" alt="سایر کارشناسان" class="card-icon">
                    </a>
                    <a href="./Area_experts.php" class="btn">ارتباط با سایر کارشناسان پهنه</a>
                </div>

                <div class="card">
                    <a href="./prof/prom_operation.php" title="لیست عملکرد">
                        <img src="files/ostan_cod.png" alt="لیست عملکرد" class="card-icon">
                    </a>
                    <a href="./prof/prom_operation.php" class="btn">مشاهده لیست عملکرد</a>
                </div>
            </div>
        </div>

         <div class="footer" style="height: 109px; background: url('files/bottom.gif') repeat-x; display: flex; align-items: center; justify-content: center;">
            <?php include('footer.php')?>
        </div>
    </div>

<script>
    // --- انیمیشن کارت‌ها هنگام اسکرول ---
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        cards.forEach(card => {
            observer.observe(card);
        });
    });

    // --- شروع: منطق جاوااسکریپت احراز هویت اجباری ---
    <?php if (!isset($valid) || $valid != '200'): ?>
    $(document).ready(function() {

        const form = document.getElementById('telm-verification-form');
        const telmInput = document.getElementById('tel_m_profile');
        const nationalCodeInput = form.querySelector('input[name="bah_cod_m"]');

        const statusMessage = document.getElementById('modalStatusMessage');
        const errorMsg = statusMessage.querySelector('.error-msg');
        const successMsg = statusMessage.querySelector('.success-msg');
        const modalIcon = document.getElementById('modalStatusIcon');
        const submitBtn = document.getElementById('modalSubmitBtn');

        function updateIcon(src, title, message = '', isError = false) {
            modalIcon.src = src;
            modalIcon.title = title;

            const isDefault = src.includes('FAQ.png');
            modalIcon.width = isDefault ? 30 : 33;
            modalIcon.height = isDefault ? 20 : 26;

            errorMsg.style.display = 'none';
            successMsg.style.display = 'none';

            if (message) {
                if (isError) {
                    errorMsg.innerText = message;
                    errorMsg.style.display = 'block';
                } else {
                    successMsg.innerText = message;
                    successMsg.style.display = 'block';
                }
            }
        }

        $(form).submit(function(e) {
            e.preventDefault();

            const tel_m = telmInput.value;
            const bah_cod_m = nationalCodeInput ? nationalCodeInput.value : 'نامشخص';
            const dataString = $(this).serialize();

            updateIcon("files/FAQ.png", "درحال بررسی...");
            submitBtn.disabled = true;
            submitBtn.innerText = "درحال بررسی...";

            $.ajax({
                type: "POST",
                url: "tel_m_sabt.php",
                data: dataString,
                success: function(response) {
                    const trimmedResponse = response.trim();
                    console.log("Response:", trimmedResponse);

                    if (trimmedResponse === "success") {
                        // موفق
                        updateIcon("files/icon1Active.png", "تایید شده", "✅ شماره همراه با موفقیت تأیید شد.", false);
                        submitBtn.innerText = "✅ تأیید شد";

                        setTimeout(() => {
                            document.body.classList.remove('modal-open');
                            $("#verificationModal").fadeOut(300);
                            location.reload();
                        }, 1500);

                    } else {
                        // خطاها
                        let errorMessage = "";

                        if (trimmedResponse === "no_match") {
                            errorMessage = "❌ عدم تطابق شماره همراه با کد ملی یا اطلاعات کاربری.";
                        }
                        else if (trimmedResponse === "invalid_request") {
                            errorMessage = "❌ درخواست نامعتبر است. لطفاً صفحه را رفرش کنید و دوباره تلاش کنید.";
                        }
                        else if (trimmedResponse === "error") {
                            errorMessage = "❌ خطا در استعلام یا پاسخ‌دهی سرور. لطفاً دوباره تلاش کنید.";
                        }
                        else {
                            // سایر پاسخ‌های ناشناخته
                            errorMessage = `❌ استعلام با مشکل مواجه شده. (شماره همراه: ${tel_m} | کد ملی: ${bah_cod_m})`;
                        }

                        updateIcon("files/icon1Inactive.png", "تایید نشده", errorMessage, true);
                        submitBtn.disabled = false;
                        submitBtn.innerText = "ثبت و بررسی شماره همراه";
                    }
                },
                error: function() {
                    const errorMessage = `❌ خطایی در ارتباط با سرور رخ داد. (شماره همراه: ${tel_m} | کد ملی: ${bah_cod_m}). لطفاً دوباره تلاش کنید.`;
                    updateIcon("files/icon1Inactive.png", "خطای ارتباط", errorMessage, true);
                    submitBtn.disabled = false;
                    submitBtn.innerText = "ثبت و بررسی شماره همراه";
                }
            });
        });

    });
    <?php endif; ?>
    // --- پایان: منطق جاوااسکریپت احراز هویت اجباری ---
</script>
</body>
</html>