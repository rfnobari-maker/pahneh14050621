<?php  
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $httpProtocol = 'https';
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $httpProtocol = 'https';
} elseif (empty($_SERVER['HTTP_X_FORWARDED_PROTO']) || $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'http') { 
    $httpProtocol = 'http';
}
$root = $httpProtocol.'://'.$_SERVER['HTTP_HOST'].'/';
$base = $httpProtocol.'://'.$_SERVER['HTTP_HOST'].'/Chief/';
?>

<!DOCTYPE html>
<html lang="fa" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo $base ;?>css/bootstrap.min.css">
    <link href="<?php echo $root ;?>FA.css" rel="stylesheet" type="text/css" />
    <style>
#sidebar {
    position: fixed;
    top: 0;
    right: 0;
    width: 250px;
    height: 100%;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); /* پس‌زمینه جدید */
    padding-top: 20px;
    transition: all 0.3s;
    transform: translateX(100%);
    overflow-y: auto;
    z-index: 101;
    border-radius: 5px;
    box-shadow: 10px 0 20px rgba(0, 0, 0, 0.3); /* سایه جدید */
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

.dropdown1-submenu {
    max-height: 0;
    overflow: hidden;
    padding-left: 15px;
    background: linear-gradient(135deg, #667eea, #764ba2);  /* پس‌زمینه جدید */
    transition: max-height 1s ease;
	border-radius: 10px ;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* اضافه کردن سایه */
}

        .dropdown1-active .dropdown1-submenu {
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
.dropdown1-toggle {
    position: relative; /* موقعیت نسبی برای قرار دادن فلش */
}

.dropdown1-toggle::after {
    content: '\25BC'; /* کاراکتر فلش به سمت پایین */
    position: absolute;
    right: 10px; /* فاصله از سمت راست */
    top: 50%; /* وسط چین کردن فلش */
    transform: translateY(-50%); /* تنظیم برای وسط قرار گرفتن */
    font-size: 10px; /* اندازه فلش */
    margin-right: 10px; /* فاصله بین فلش و متن */
    transition: transform 0.75s ease; /* انیمیشن چرخش */
}

.dropdown1-active .dropdown1-toggle::after {
    transform: translateY(-50%) rotate(90deg); /* چرخاندن فلش 45 درجه به سمت چپ */
}
    </style>
</head>
<body>

      <div id="sidebar">
        <ul>
            <li>
                <a href="#" class="dropdown1-toggle"> پروفایل </a>
                <ul class="dropdown1-submenu">
<?php if($login_session =='1380066174' or $login_session =='0061741787'){ ?>
                    <li><a href="<?php echo $base; ?>Add_user_Garden">تعریف کاربر جدید</a></li>
<?php }?>
                    <li><a href="<?php echo $base; ?>profile">ویرایش اطلاعات کاربری</a></li>
                    <li><a href="<?php echo $base; ?>change-password">تغییر کلمه عبور</a></li>
                    <li><a href="<?php echo $root; ?>login/logout">خروج از سیستم</a></li>
                </ul>
            </li>
             <li><a href="#"class="dropdown1-toggle">سیستم پیام</a>
               <ul class="dropdown1-submenu">
                    <li><a href="<?php echo $base; ?>messanger">پیام های دریافتی</a></li>
                    <li><a href="<?php echo $base; ?>sent_message">پیام های ارسالی</a></li>
                    <li><a href="<?php echo $base; ?>search_promo">ارسال پیام جدید</a></li>
                    <li><a href="<?php echo $base; ?>send_group_pm">ارسال پیام گروهی</a></li>
                </ul>
            </li>
        <?php if(strstr($perm,'p1')) { ?>
                <li><a href="#" onclick="confirmRedirect('<?php echo $base; ?>provinces')">داشبورد</a></li>
          <?php } if(strstr($perm,'p4')) { ?>
                <li><a href="#" class="dropdown1-toggle">کاربران سامانه</a>
                    <ul class="dropdown1-submenu">
                    <li><a href="<?php echo $base; ?>user_view">مدیریت کاربران</a></li>
                    <li><a href="<?php echo $base; ?>search_promo">جستجوی کاربر</a></li>
                    <li><a href="<?php echo $base; ?>promo">کارشناسان پهنه</a></li>
                    <li><a href="<?php echo $base; ?>admins">ادمین های استانی</a></li>
                    <li><a href="<?php echo $base; ?>live_view">مشاهده عملکرد کاربران</a></li>
                    <li><a href="<?php echo $base; ?>promo_action">گزارش عملکرد کارشناس</a></li>
                    <li><a href="<?php echo $base; ?>ostan_action">گزارش عملکرد استان</a></li>
                    <li><a href="<?php echo $base; ?>login_rep">گزارش ورود به سامانه</a></li>
                </ul>
            </li>
   <?php } if(strstr($perm,'p2')) {?>
            <li><a href="#"class="dropdown1-toggle">شهرها و آبادی‌ها</a>
                <ul class="dropdown1-submenu">
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
<?php }?>
  <?php  if(strstr($perm,'d9')) {?>
            <li><a href="#"class="dropdown1-toggle">بهره برداران کشاورزی</a>
                <ul class="dropdown1-submenu">
                    <li><a href="<?php echo $base; ?>list_bah">لیست بهره برداران</a></li>
                    <li><a href="<?php echo $base; ?>GetPerson">استعلام ثبت احوال</a></li>
                    <li><a href="<?php echo $base; ?>list_bah_lastname">جستجوی نام خانوادگی</a></li>
                    <li><a href="<?php echo $base; ?>search_benef">سوابق بهره بردار</a></li>
                    <li><a href="#" onclick="confirmRedirect('<?php echo $base; ?>bah_rep1')">براساس مدرک تحصیلی</a></li>
                    <li><a href="#" onclick="confirmRedirect('<?php echo $base; ?>bah_rep2')">براساس زمینه فعالیت</a></li>
                </ul>
            </li>
<?php  } if (strstr($perm, 'd1')) { ?>
            <li><a href="#"class="dropdown1-toggle">زراعت</a>
                <ul class="dropdown1-submenu">
                    <li><a href="<?php echo $base; ?>Agri/liste_Agri">لیست بهره برداران زراعی</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep11">اطلاعات زراعی استان</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Agri_rep160">گزارش گروه محصولات </a></li>
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
                    <li><a href="<?php echo $base; ?>Agri/amar.php">گزارشات آمارنامه</a></li>                    
                </ul>
            </li>
<?php  } if (strstr($perm, 'd2')) { ?>
            <li><a href="#"class="dropdown1-toggle">صیفی</a>
                <ul class="dropdown1-submenu">
                    <li><a href="<?php echo $base; ?>Agri/Vege_rep1">لیست بهره برداری صیفی</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Vege_rep40">تولید به تفکیک استان</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Vege_rep30">تولید به تفکیک شهرستان</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Vege_rep31">تولید به تفکیک مرکز</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Vege_rep5">تولید شهرستان / رقم</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Vege_rep2">گزارش ویژه محصولات</a></li>
                    <li><a href="<?php echo $base; ?>Agri/Vege_v_eostan">سطح زیر کشت ابلاغی</a></li>
                <?php if($user_check == '1285851455') {?> 
                    <li><a href="<?php echo $base; ?>Agri/Vege_e_ostan">درج زیر کشت ابلاغی</a></li>
                    <?php }?>
                </ul>
            </li>
 <?php  } if (strstr($perm, 'd3')) { ?> 
  <li><a href="#"class="dropdown1-toggle">باغ</a>
                <ul class="dropdown1-submenu">
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
 <?php } if (strstr($perm, 'd4')) { ?>
            <li><a href="#"class="dropdown1-toggle">گلخانه</a>
                <ul class="dropdown1-submenu">
                    <li><a href="<?php echo $base; ?>Garden/liste_Greenhousn">لیست واحد ها </a></li>
                    <li><a href="<?php echo $base; ?>Garden/list_Greenhous_nonP">واحد های فاقد عملکرد</a></li>
                    <li><a href="<?php echo $base; ?>Garden/list_Greenhous_W_P">واحد های دارای عملکرد</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Greenh_rep1">لیست عملکرد سالانه </a></li>
                    <li><a href="<?php echo $base; ?>Garden/Greenh_report1">گزارش وضعیت واحد</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Greenh_daily_report">گزارش روزانه واحد</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Greenh_rep170">گزارش ویژه محصولات</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Greenh_rep4">گزارش جمع بندی استانی</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Greenh_rep5">گزارش جمع بندی کشور</a></li>
                </ul>
            </li>
 <?php } if (strstr($perm, 'd5')) { ?>
            <li><a href="#"class="dropdown1-toggle">پرورش قارچ</a>
                <ul class="dropdown1-submenu">
                    <li><a href="<?php echo $base; ?>Garden/list_Mushroom">لیست واحد ها </a></li>
                    <li><a href="<?php echo $base; ?>Garden/list_Mushroom_nonP">واحد های فاقد عملکرد</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Mush_rep5">اطلاعات سالن های پرورش</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Mush_rep2"> واحد به تفکیک استان</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Mush_rep3"> واحد به تفکیک شهرستان</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Mush_rep1">گزارش عملکرد سالانه</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Mush_rep4">گزارش تولید به تفکیک استان</a></li>
                    <li><a href="<?php echo $base; ?>Garden/Mush_rep6">آمار تولید</a></li>
                </ul>
            </li>
 <?php } if(strstr($perm,'d7')) { ?>
           <li><a href="#"class="dropdown1-toggle">پرورش زنبورعسل</a>
                <ul class="dropdown1-submenu">
                    <li><a href="<?php echo $base; ?>Poultry/list_bee">لیست زنبورستان </a></li>
                    <li><a href="<?php echo $base; ?>Poultry/manager_bee">جستجوی زنبوردار</a></li>
                    <li><a href="<?php echo $base; ?>Poultry/list_unknown_bee">زنبورستان های ناشناس</a></li>
                    <li><a href="<?php echo $base; ?>Poultry/list_bee_kol">لیست نهایی زنبورستان</a></li>
                    <li class="separator"><a href="<?php echo $base; ?>Poultry/duplicates">کد ملی های تکراری</a></li>
                    <li><a href="<?php echo $base; ?>Poultry/bee6">تولید به تفکیک استان</a></li>
                    <li><a href="<?php echo $base; ?>Poultry/bee2">تولید به تفکیک شهرستان</a></li>
                    <li><a href="<?php echo $base; ?>Poultry/bee60">تولید نهایی به تفکیک استان</a></li>
                    <li class="separator">
                    <a href="<?php echo $base; ?>Poultry/bee_Ncity">تولید نهایی به تفکیک شهرستان</a></li>
                    <li><a href="<?php echo $base; ?>Poultry/bee72">زنبوردار به تفکیک استان </a></li>
                    <li class="separator"><a href="<?php echo $base; ?>Poultry/bee5">زنبوردار به تفکیک شهرستان </a></li>
                    <li class="separator"><a href="<?php echo $base; ?>Poultry/beeT">تلفات به تفکیک استان </a></li>
                    <li><a href="<?php echo $base; ?>Poultry/equip">آمار تجهیزات نهائی</a></li>
                </ul>
            </li>
 <?php } if(strstr($perm,'d7')) { ?>
           <li><a href="#"class="dropdown1-toggle">پرورش دام</a>
                <ul class="dropdown1-submenu">
                     <li class="separator"><a href="<?php echo $base; ?>Animal/list_Animal">لیست دامداری ها </a></li>
                   
                    <li><a href="<?php echo $base; ?>Animal/Animal_rep2">گزارش به تفکیک گونه</a></li>
                    <li><a href="<?php echo $base; ?>">گزارش به تفکیک نوع فعالیت</a></li>
                    <li><a href="<?php echo $base; ?>">گزارش به تفکیک نوع مجوز</a></li>
                </ul>
            </li>
 <?php   } if(strstr($perm,'d6')) { ?>
            <li><a href="#"class="dropdown1-toggle">تکثیر و پرورش آبزیان</a>
               <ul class="dropdown1-submenu">
                    <li><a href="<?php echo $base; ?>Aquatic/liste_Aquatic">لیست واحد ها</a></li>
                    <li><a href="<?php echo $base; ?>Aquatic/Aquatic_rep1">گزارش واحد</a></li>
                    <li><a href="<?php echo $base; ?>Aquatic/Aquatic_rep2">گزارش عملکرد تولید</a></li>
                </ul>
            </li>
       <?php }?>
             
       <?php  if(strstr($perm,'d10')) { ?>
            <li>
                <a href="#" class="dropdown1-toggle">صنایع کشاورزی</a>
                <ul class="dropdown1-submenu">
                    <li><a href="<?php echo $base; ?>Industry/list_ind_unit_prod">لیست و عملکرد واحد ها</a></li>
                    <li><a href="<?php echo $base; ?>Industry/Ind_rep2">آمار واحد های صنعتی</a></li>
                    <li><a href="<?php echo $base; ?>Industry/Ind_rep1">گزارش تولید محصول</a></li>
                </ul>
            </li>
       <?php } if(strstr($perm,'p3')) { ?>
            <li>
                <a href="#" class="dropdown1-toggle">تحقیقات آموزش و ترویج</a>
                <ul class="dropdown1-submenu">
                    <li><a href="<?php echo $base; ?>list_center">مراکز جهاد کشاورزی</a></li>
                    <li><a href="<?php echo $base; ?>Promotion/Eworker/Eworker_rep">مددکار / تسهیلگر</a></li>
                </ul>
            </li>
       <?php } if(strstr($perm,'p0')) { ?>
           <li><a href="<?php echo $root; ?>asystem">پنل ادمین سامانه</a></li>
        </ul>
       <?php }?>
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

document.querySelectorAll('.dropdown1-toggle').forEach(function(dropdown1) {
    dropdown1.addEventListener('click', function(e) {
        e.preventDefault();

        const parentLi = this.parentElement;
        const submenu = parentLi.querySelector('.dropdown1-submenu');

        // بستن زیرمنوهای دیگر
        document.querySelectorAll('.dropdown1-submenu').forEach(function(otherSubmenu) {
            if (otherSubmenu !== submenu) { // چک کردن اینکه زیرمنوی دیگر است یا خیر
                otherSubmenu.style.maxHeight = null;
                otherSubmenu.parentElement.classList.remove('dropdown1-active');
            }
        });

        // باز و بسته کردن زیرمنوی فعلی
        if (submenu.style.maxHeight) {
            submenu.style.maxHeight = null; // بسته شدن زیرمنوی فعلی
        } else {
            submenu.style.maxHeight = submenu.scrollHeight + "px"; // باز شدن زیرمنوی فعلی
        }

        parentLi.classList.toggle('dropdown1-active');
    });
});
		overlay.addEventListener('click', function() {
    sidebar.classList.remove('active');
    toggleBtn.classList.remove('active');
    overlay.style.display = 'none';
    toggleBtn.innerHTML = '<img src="<?php echo $base ;?>css/bars-solid.svg" alt="Open Menu" style="width: 15px; height: 15px;">';
});

function confirmRedirect(url) {
        if (confirm('نمایش این گزارش زمان‌بر است. آیا از مشاهده آن اطمینان دارید ؟')) {
            window.location.href = url;
        }
    }
    </script>
</body>
</html>
