<?php  
$httpProtocol = !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' : 'https';
$root = $httpProtocol.'://'.$_SERVER['HTTP_HOST'].'/';
$base = $httpProtocol.'://'.$_SERVER['HTTP_HOST'].'/Chief/';
?>
<!DOCTYPE html>
<html lang="fa" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="../FA.css" rel="stylesheet" type="text/css" />
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
    padding: 10px;
    text-align: right;
}


        #sidebar.active {
            transform: translateX(0);
        }

#sidebar ul li a {
    color: #fff;
    text-decoration: none;
	font-size:13px ;
    display: block;
    padding: 5px 15px; /* padding ثابت برای حالت عادی */
    transition: background 0.3s, padding 0.3s; /* انیمیشن نرم برای تغییر رنگ و padding */
}

#sidebar ul li a:hover {
    background: #495057;
    /* padding: 5px 15px; // نیازی به تغییر padding نیست */
    border-radius: 5px; /* گردی گوشه‌ها */
}

.dropdown-submenu {
    max-height: 0; /* شروع با ارتفاع صفر */
    overflow: hidden; /* مخفی کردن محتوای اضافی */
    padding-left: 15px; /* فاصله از سمت چپ */
    background: linear-gradient(to bottom, #808080, #09C);  /* رنگ پس‌زمینه زیر منو #3c3c3c */
    transition: max-height 1s ease; /* انیمیشن */
	border-radius: 10px ;
}


        .dropdown-active .dropdown-submenu {
            display: block; /* نمایش زیر منوها */
        }
        #toggle-btn {
            background: #333;
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
    </style>
</head>
<body>

      <div id="sidebar">
        <ul>
            <li>
                <a href="#" class="dropdown-toggle">پروفایل</a>
                <ul class="dropdown-submenu">
                    <li><a href="<?php echo $base; ?>profile">ویرایش اطلاعات کاربری</a></li>
                    <li><a href="<?php echo $base; ?>change-password">تغییر کلمه عبور</a></li>
                    <li><a href="<?php echo $root; ?>login/logout">خروج از سیستم</a></li>
                </ul>
            </li>
                <li><a href="<?php echo $base; ?>provinces">داشبورد</a></li>
                <li><a href="#" class="dropdown-toggle">کاربران سامانه</a>
                    <ul class="dropdown-submenu">
                    <li><a href="<?php echo $base; ?>user_view">مدیریت کاربران</a></li>
                    <li><a href="<?php echo $base; ?>search_promo">جستجوی کاربر</a></li>
                    <li><a href="<?php echo $base; ?>promo">کارشناسان پهنه</a></li>
                    <li><a href="<?php echo $base; ?>admins">ادمین استان</a></li>
                    <li><a href="<?php echo $base; ?>live_view">مشاهده عملکرد کاربران</a></li>
                    <li><a href="<?php echo $base; ?>promo_action">گزارش کارشناس</a></li>
                    <li><a href="<?php echo $base; ?>ostan_action">گزارش استان</a></li>
                    <li><a href="<?php echo $base; ?>login_rep">گزارش ورود</a></li>

                </ul>
            </li>
            <li><a href="#"class="dropdown-toggle">شهرها و آبادی‌ها</a>
                <ul class="dropdown-submenu">
                    <li><a href="<?php echo $base; ?>list_pubcity">اطلاعات عمومی شهر </a></li>
                    <li><a href="<?php echo $base; ?>lists_city">شهرهای تحت پوشش</a></li>
                    <li><a href="<?php echo $base; ?>inactive_city">شهرهای غیرفعال</a></li>
                    <li><a href="<?php echo $base; ?>listpublic_abadi">اطلاعات عمومی آبادی </a></li>
                    <li><a href="<?php echo $base; ?>lists_abadi">آبادی های تحت پوشش</a></li>
                    <li><a href="<?php echo $base; ?>inactive_abadi">آبادی های غیرفعال</a></li>
                    <li><a href="<?php echo $base; ?>lists_abadi_nmor">آبادی های فاقد کارشناس</a></li>
                    <li><a href="<?php echo $base; ?>ostan_cod">کدینگ استان،شهرستان،مرکز</a></li>
                    <li><a href="<?php echo $base; ?>search_abadi">سوابق یک آبادی</a></li>
                </ul>
            
            
            </li>
            <li><a href="#"class="dropdown-toggle">بهره برداران کشاورزی</a>
                <ul class="dropdown-submenu">
                    <li><a href="<?php echo $base; ?>list_bah">لیست بهره برداران</a></li>
                    <li><a href="<?php echo $base; ?>GetPerson">استعلام ثبت احوال</a></li>
                    <li><a href="<?php echo $base; ?>list_bah_lastname">جستجوی نام خانوادگی</a></li>
                    <li><a href="<?php echo $base; ?>search_benef">سوابق بهره بردار</a></li>
                    <li><a href="<?php echo $base; ?>bah_rep1">براساس مدرک</a></li>
                    <li><a href="<?php echo $base; ?>bah_rep2">براساس زمینه فعالیت</a></li>
                </ul>
            </li>
            <li><a href="#"class="dropdown-toggle">زراعت</a>
                <ul class="dropdown-submenu">
                    <li><a href="<?php echo $base; ?>Agri/liste_Agri">لیست بهره برداران زراعی</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep11">اطلاعات زراعی استان</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep160">کزارش گروه محصولات </a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep16">گزارش محصولات زراعی </a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep14">به تفکیک بهره بردار</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep15">بهره بردار/محصول</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep18">تولید کننده یک محصول</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep12p">گزارش محصول/استان</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep11p">گزارش محصول/شهرستان</a></li>
                    <li><a href="<?php echo $base; ?>Agri/rep_keshavarz_city">گزارش محصول/شهر</a></li>
                    <li><a href="<?php echo $base; ?>Agri/rep_keshavarz">گزارش محصول/دهستان</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep21">گزارش محصول/آبادی</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep220">تولید به تفکیک محصول</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep170">گزارش ویژه محصولات</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep23">گزارش ویژه اراضی</a></li>
                    <li><a href="<?php echo $base; ?>Agri/list_Agri_no_editing">قطعات فاقد ویرایش</a></li>
                    <li><a href="<?php echo $base; ?>Agri/AgriP_edit_T">قطعات فاقد تولید قطعی</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_deleted">رکورد های حذف شده</a></li>                    
                    <li><a href="<?php echo $root; ?>list_product_amar_xls">کدینگ محصولات </a></li>                    
                    <li><a href="<?php echo $base; ?>Agri/amar">گزارشات آمارنامه</a></li>                    
                </ul>
            </li>

            <li><a href="#"class="dropdown-toggle">صیفی</a>
                <ul class="dropdown-submenu">
                    <li><a href="<?php echo $base; ?>Vege_rep1">لیست بهره برداری صیفی</a></li>
                    <li><a href="<?php echo $base; ?>Vege_rep40">تولید به تفکیک استان</a></li>
                    <li><a href="<?php echo $base; ?>Vege_rep30">تولید به تفکیک شهرستان</a></li>
                    <li><a href="<?php echo $base; ?>Vege_rep31">تولید به تفکیک مرکز</a></li>
                    <li><a href="<?php echo $base; ?>Vege_rep5">تولید شهرستان / رقم</a></li>
                    <li><a href="<?php echo $base; ?>Vege_rep2">گزارش ویژه محصولات</a></li>
                    <li><a href="<?php echo $base; ?>Vege_v_eostan">سطح زیر کشت ابلاغی</a></li>
                </ul>
            </li>
  <li><a href="#"class="dropdown-toggle">باغ</a>
                <ul class="dropdown-submenu">
                    <li><a href="<?php echo $base; ?>Garden/liste_Garden">لیست بهره برداران باغی</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Garden_rep13">گزارش گروه محصولات </a></li>
                    <li><a href="<?php echo $base; ?>Garden/Garden_rep16">تولید به تفکیک محصول</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Garden_rep12p">گزارش محصول/استان</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Garden_rep11p">گزارش محصول/شهرستان</a></li>
                    <li><a href="<?php echo $base; ?>Garden/rep_dehestan">گزارش محصول/دهستان</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Garden_rep170">گزارش ویژه محصولات</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Garden_rep18">گزارش ویژه اراضی</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Garden_no_edit">قطعات فاقد ویرایش</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Garden_edit_T_98">قطعات فاقد تولید قطعی</a></li>
                    <li><a href="<?php echo $root; ?>list_product_b_xls.php">کدینگ محصولات </a></li>                    
                    <li><a href="<?php echo $base; ?>Garden/amar">گزارشات آمارنامه</a></li>                    
                </ul>
            </li>
            <li><a href="#">گلخانه</a></li>
            <li><a href="#">قارچ</a></li>
           <li><a href="#">دام</a></li>
           <li><a href="#">زنبور</a></li>
           <li><a href="#">آبزی پروری</a></li>
            <li><a href="#"class="dropdown-toggle">پیام ها</a>
               <ul class="dropdown-submenu">
                    <li><a href="<?php echo $base; ?>profile">ارسال پیام جدید</a></li>
                    <li><a href="<?php echo $base; ?>#">ارسال پیام گروهی</a></li>
                    <li><a href="<?php echo $base; ?>#">پیام های دریافتی</a></li>
                    <li><a href="<?php echo $base; ?>#">پیام های ارسالی</a></li>

                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">تحقیقات آموزش و ترویج</a>
                <ul class="dropdown-submenu">
                    <li><a href="<?php echo $base; ?>list_center">مراکز جهاد کشاورزی</a></li>
                    <li><a href="<?php echo $base; ?>Eworker_rep">مددکار / تسهیلگر</a></li>
                </ul>
            </li>
           <li><a href="<?php echo $root; ?>asystem">پنل ادمین</a></li>
        </ul>
    </div>

    <div class="overlay" id="overlay"></div> <!-- پوشش تیره کمرنگ -->

    <button id="toggle-btn"><i class="fas fa-bars"></i></button>

    <script>
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('active');
            overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none'; // نمایش/پنهان کردن پوشش
            this.classList.toggle('active');

            if (sidebar.classList.contains('active')) {
                this.innerHTML = '<i class="fas fa-times"></i>'; // آیکون ضربدر برای بستن منو
            } else {
                this.innerHTML = '<i class="fas fa-bars"></i>'; // آیکون سه خط برای باز کردن منو
            }
        });


        document.querySelectorAll('.dropdown-toggle').forEach(function(dropdown) {
            dropdown.addEventListener('click', function(e) {
                e.preventDefault();
                const parentLi = this.parentElement;
                const submenu = parentLi.querySelector('.dropdown-submenu');

                if (submenu.style.maxHeight) {
                    submenu.style.maxHeight = null; // بسته شدن زیر منو
                } else {
                    submenu.style.maxHeight = submenu.scrollHeight + "px"; // باز شدن زیر منو
                }

                parentLi.classList.toggle('dropdown-active');
            });
        });
    </script>
</body>
</html>
