<?php  
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $httpProtocol = 'https';
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $httpProtocol = 'https';
} else {
    $httpProtocol = 'http';
}
$root = $httpProtocol.'://'.$_SERVER['HTTP_HOST'].'/';
$base = $httpProtocol.'://'.$_SERVER['HTTP_HOST'].'/Chief1/';
?>

<!DOCTYPE html>
<html lang="fa" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo $base ;?>css/bootstrap.min.css">

    <style>
        #sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 250px;
            height: 100%;
            background: linear-gradient(135deg, #343a40, #3a4148, #2e3238);
            padding-top: 20px;
            transition: all 0.3s;
            transform: translateX(100%);
            overflow-y: auto;
            z-index: 101; /* بالا از پوشش */
            border-radius: 5px;
        }
#sidebar ul {
    padding: 0;
    margin: 0;
}

#sidebar ul li {
    list-style: none;
    padding: 5px;
    text-align: right;
}


        #sidebar.active {
            transform: translateX(0);
        }

#sidebar ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    display: block;
    padding: 5px 15px; /* فاصله از بالا، پایین و چپ */
    padding-right: 35px; /* اضافه کردن فاصله از سمت راست */
    transition: background 0.3s, padding 0.3s;
}


#sidebar ul li a:hover {
    background: #495057;
    /* padding: 5px 15px; // نیازی به تغییر padding نیست */
    border-radius: 5px; /* گردی گوشه‌ها */
}

.zermenu-submenu {
    max-height: 0; /* شروع با ارتفاع صفر */
    overflow: hidden; /* مخفی کردن محتوای اضافی */
    padding-left: 15px; /* فاصله از سمت چپ */
    background: linear-gradient(to bottom, #808080, #09C);  /* رنگ پس‌زمینه زیر منو #3c3c3c */
    transition: max-height 1s ease; /* انیمیشن */
	border-radius: 10px ;
}


        .zermenu-active .zermenu-submenu {
            display: block; /* نمایش زیر منوها */
        }
        #toggle-btn {
            background:#FFF;
			border-radius:5px;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            position: fixed;
            right: 10px;
            top: 20px;
            z-index: 102; /* بالاتر از منو */
            transition: right 0.3s;
        }
   #toggle-btn.active {
            right: 260px;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* رنگ تیره کمرنگ */
            display: none; /* پنهان به طور پیش‌فرض */
            z-index: 100; /* زیر منو */
        }
		.separator {
    border-bottom: 2px solid rgba(255, 255, 255, 0.2); /* خط کم‌رنگ */
    padding-bottom: 10px; /* فاصله از خط */
    margin-right: 0px; /* کمی تو رفتگی از سمت راست */
}
.zermenu-toggle {
    position: relative; /* موقعیت نسبی برای قرار دادن فلش */
}

    </style>
</head>
<body>

      <div id="sidebar">
        <ul>
            <li>
                <a href="#" class="zermenu-toggle"> پروفایل </a>
                <ul class="zermenu-submenu">
                    <li><a href="<?php echo $base; ?>profile">ویرایش اطلاعات کاربری</a></li>
                    <li><a href="<?php echo $base; ?>change-password">تغییر کلمه عبور</a></li>
                    <li><a href="<?php echo $root; ?>login/logout">خروج از سیستم</a></li>
                </ul>
            </li>
            
           <li><a href="<?php echo $root; ?>asystem">پنل ادمین</a></li>
        </ul>
    </div>

    <div class="overlay" id="overlay"></div> <!-- پوشش تیره کمرنگ -->
    <button id="toggle-btn"><img src="<?php echo $base ;?>css/bars-solid.svg" alt="Open Menu" style="width: 15px; height: 15px;"></button>
    <script>
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('active');
            overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none'; // نمایش/پنهان کردن پوشش
            this.classList.toggle('active');

            if (sidebar.classList.contains('active')) {
            this.innerHTML = '<img src="<?php echo $base ;?>css/xmark-solid.svg" alt="Close Menu" style="width: 15px; height: 15px;">'; // آیکون ضربدر برای بستن منو
             } else {
             this.innerHTML = '<img src="<?php echo $base ;?>css/bars-solid.svg" alt="Open Menu" style="width: 15px; height: 15px;">'; // آیکون سه خط برای باز کردن منو
             }
        });


        document.querySelectorAll('.zermenu-toggle').forEach(function(zermenu) {
            zermenu.addEventListener('click', function(e) {
                e.preventDefault();
                const parentLi = this.parentElement;
                const submenu = parentLi.querySelector('.zermenu-submenu');

                if (submenu.style.maxHeight) {
                    submenu.style.maxHeight = null; // بسته شدن زیر منو
                } else {
                    submenu.style.maxHeight = submenu.scrollHeight + "px"; // باز شدن زیر منو
                }

                parentLi.classList.toggle('zermenu-active');
            });
        });
		overlay.addEventListener('click', function() {
    sidebar.classList.remove('active');
    toggleBtn.classList.remove('active');
    overlay.style.display = 'none';
    toggleBtn.innerHTML = '<img src="<?php echo $base ;?>css/bars-solid.svg" alt="Open Menu" style="width: 15px; height: 15px;">';
});

    </script>
</body>
</html>
