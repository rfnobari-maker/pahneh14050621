<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div style=" 
    height: 40px; 
    background: linear-gradient(to bottom, #001F3F, #003366, #001F3F); 
    padding: 5px; 
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
    flex-wrap: wrap; 
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.4); 
    color: #fff; 
    font-size: 13px;
    gap: 10px;
">
    <style>
        a:hover {
            font-size: 14px;
            color: #900;
        }
        #clock {
            display: inline-block;
            width: 70px;
            text-align: center;
        }

        /* --- Media Queries برای موبایل --- */
        @media screen and (max-width: 768px) {
            /* استایل اصلی کادر منو */
            div[style*="background: linear-gradient"] {
                display: flex !important; /* به فلکس‌باکس برمی‌گردد */
                height: auto !important;
                padding: 10px 5px !important;
                justify-content: space-around !important; /* آیتم‌ها را با فاصله یکسان نمایش می‌دهد */
                flex-wrap: nowrap !important; /* از شکسته شدن به خط بعدی جلوگیری می‌کند */
            }

            /* مخفی کردن آیتم‌های ناخواسته */
            div.ip-info, div.date-time-info {
                display: none !important;
            }

            /* تنظیم مجدد آیتم‌های باقی‌مانده */
            .logout-item, .username-item, .home-item {
                width: auto !important; /* عرض خودکار برای جایگیری مناسب */
                text-align: center !important;
                margin: 0 5px !important; /* فاصله افقی بین آیتم‌ها */
            }

            /* مخفی کردن فضای خالی */
            div[style*="height: 35px;"] {
                display: none !important;
            }
        }
    </style>

    <div class="logout-item" style="width: 8%; text-align: left; margin-left: 20px;">
        <a href="<?php echo $root; ?>login/logoutc" title="خروج از سامانه" style="color: #FF9; text-decoration: none;">خروج</a>
    </div>
    
    <div class="date-time-info" dir="rtl" style="width: 20%; text-align: left;">
        <?php 
        $root1 = $_SERVER['DOCUMENT_ROOT'] . '/';
         require_once($root1 . 'Jalali.php');     
		 echo jdate("j F Y");
        ?>
        - ساعت <span id="clock"><?php echo date("H:i:s"); ?></span>
    </div>
    
    <div style="width: 5%; height: 35px;">&nbsp;</div>
    
    <div class="ip-info" style="width: 30%; text-align: center;">
        <?php echo 'IP: '.$_SERVER['REMOTE_ADDR']; ?>
    </div>
    
    <div class="username-item" style="width: 20%; text-align: center;">
        <?php echo 'نام کاربر : '.$v_jen . ' ' . $PersName; ?><span class="normalTextSmall"> / </span><?php echo $name; ?>
    </div>
    
    <div class="home-item" style="width: 8%; text-align: center;">
        <a href="<?php echo $base; ?>" style="color: #FF9; text-decoration: none;">صفحه اصلی</a>
    </div>
</div>

<script>
    function updateClock() {
        const clockDiv = document.getElementById('clock');
        const currentDate = new Date();
        const formattedTime = 
            ('0' + currentDate.getHours()).slice(-2) + ':' +
            ('0' + currentDate.getMinutes()).slice(-2) + ':' +
            ('0' + currentDate.getSeconds()).slice(-2);
        clockDiv.innerText = formattedTime;
    }
    setInterval(updateClock, 1000);
</script>