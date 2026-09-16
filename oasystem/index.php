<?php
include("../lock_ad.php");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="../files/images/favicon.ico" type="image/x-icon">
    <link href="../FA.css" rel="stylesheet">
    <style>
        :root {
            --primary-color:#216d0e;
            --hover-color:rgb(6, 56, 19);
            --bg-color: #f0f4f8;
            --text-color: #1e293b;
            --card-bg: #ffffff;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --accent-color:#064b20;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: Tahoma, Arial, sans-serif;
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
            height: 149px;
            object-fit: cover;
            display: block;
        }

        .content-section {
            padding: 0 20px;
        }

        .welcome-banner {
            text-align: center;
            margin: 20px auto;
        }

        .welcome-banner img {
            border-radius: 15px;
            max-width: 240px;
            height: auto;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            padding: 20px;
            margin: 20px auto;
            max-width: 1100px;
        }

        /* استایل‌های انیمیشن */
        .card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 16px var(--shadow-color);
            transition: all 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            text-align: center;
            opacity: 0;
            transform: translateY(30px);
            will-change: transform, opacity;
        }

        .card.animated {
            animation: cardEntrance 0.8s ease-out forwards;
        }

        @keyframes cardEntrance {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* تاخیرهای زمانی با CSS Variables */
        .card {
            --delay: calc((var(--order) - 1) * 0.1s);
            animation-delay: var(--delay);
        }

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
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            display: block;
            transition: all 0.4s ease;
            filter: drop-shadow(0 4px 8px var(--shadow-color));
            object-fit: contain;
        }

        .card:hover .card-icon {
            transform: scale(1.15) rotate(5deg);
            opacity: 0.8;
        }

        .btn {
            display: block;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
            margin: 12px 0;
            text-align: center;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
            font-size: 14px;
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

        .footer {
            height: 109px;
            background: url('../files/bottom.gif') repeat-x;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
                margin-top: 10px;
            }

            .cards-container {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 10px;
            }

            .card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="../files/images/header.jpg" alt="header" class="header-image">
        
        <div dir="ltr"> <?php include('menu.php'); ?> </div>
        <?php include('top.php'); ?>

        <div class="content-section">
            <div class="cards-container">
                <div class="card" data-order="1">
                    <a href="user.php" title="تعریف کاربر جدید">
                        <img src="../files/adduser.jpg" alt="تعریف کاربر" class="card-icon">
                    </a>
                    <a href="user.php" class="btn">تعریف کاربر جدید</a>
                </div>

                <div class="card" data-order="2">
                    <a href="user_view.php" title="مدیریت کاربران">
                        <img src="../files/user.jpg" alt="مدیریت کاربران" class="card-icon">
                    </a>
                    <a href="user_view.php" class="btn">مدیریت کاربران</a>
                </div>

                <div class="card" data-order="3">
                    <a href="#" title="تعریف مرکز جدید">
                        <img src="../files/mar.png" alt="تعریف مرکز" class="card-icon">
                    </a>
                    <a href="#" class="btn">تعریف مرکز جدید</a>
                </div>

                <div class="card" data-order="4">
                    <a href="mar_view.php" title="مدیریت مراکز جهاد کشاورزی">
                        <img src="../files/mar_edit.png" alt="مدیریت مراکز" class="card-icon">
                    </a>
                    <a href="#" class="btn">مدیریت مراکز جهاد کشاورزی</a>
                </div>

                <div class="card" data-order="5">
                    <a href="region.php" title="منطقه بندی استان">
                        <img src="../files/region.png" alt="منطقه بندی" class="card-icon">
                    </a>
                    <a href="region.php" class="btn">منطقه بندی استان</a>
                </div>

                <div class="card" data-order="6">
                    <a href="active_abadi.php" title="لیست آبادی های فعال">
                        <img src="../files/active_abadi.png" alt="آبادی های فعال" class="card-icon">
                    </a>
                    <a href="active_abadi.php" class="btn">لیست آبادی های فعال</a>
                </div>

                <div class="card" data-order="7">
                    <a href="inactive_abadi.php" title="لیست آبادهای غیر فعال">
                        <img src="../files/inactive_abadi.png" alt="آبادی های غیرفعال" class="card-icon">
                    </a>
                    <a href="inactive_abadi.php" class="btn">لیست آبادهای غیر فعال</a>
                </div>

                <div class="card" data-order="8">
                    <a href="add_abadi.php" title="ثبت آبادی جدید مرکز">
                        <img src="../files/add_abadi.png" alt="ثبت آبادی" class="card-icon">
                    </a>
                    <a href="add_abadi.php" class="btn">فعال سازی یک آبادی</a>
                </div>

                <div class="card" data-order="9">
                    <a href="change_abadi_mar.php" title="تغییر مروج و مرکز آبادی">
                        <img src="../files/edity_abadi.png" alt="ویرایش آبادی" class="card-icon">
                    </a>
                    <a href="change_abadi_mar.php" class="btn">ویرایش مروج / مرکز ، آبادی</a>
                </div>

                <div class="card" data-order="10">
                    <a href="active_city.php" title="لیست شهرهای فعال">
                        <img src="../files/active_city.png" alt="شهرهای فعال" class="card-icon">
                    </a>
                    <a href="active_city.php" class="btn">لیست شهرهای فعال</a>
                </div>

                <div class="card" data-order="11">
                    <a href="inactive_city.php" title="لیست شهرهای غیر فعال">
                        <img src="../files/inactive_city.png" alt="شهرهای غیرفعال" class="card-icon">
                    </a>
                    <a href="inactive_city.php" class="btn">لیست شهرهای غیر فعال</a>
                </div>

                <div class="card" data-order="12">
                    <a href="add_city.php" title="فعال سازی یک شهر">
                        <img src="../files/add_city.png" alt="فعال سازی شهر" class="card-icon">
                    </a>
                    <a href="add_city.php" class="btn">فعال سازی یک شهر</a>
                </div>

                <div class="card" data-order="13">
                    <a href="change_city_mar.php" title="تغییر مروج و مرکز شهر">
                        <img src="../files/edit_city.png" alt="ویرایش شهر" class="card-icon">
                    </a>
                    <a href="change_city_mar.php" class="btn">ویرایش مروج /مرکز، شهر</a>
                </div>

                <div class="card" data-order="14">
                    <a href="search_user.php" title="جستجوی کاربر">
                        <img src="../files/morvege2.png" alt="جستجوی کاربر" class="card-icon">
                    </a>
                    <a href="search_user.php" class="btn">جستجوی کاربر</a>
                </div>

                <div class="card" data-order="15">
                    <a href="message_list.php" title="لیست پیام ها">
                        <img src="../files/messanger.png" alt="پیام ها" class="card-icon">
                    </a>
                    <a href="message_list.php" class="btn">لیست پیام ها</a>
                </div>

                <div class="card" data-order="16">
                    <a href="requests.php" title="درخواست رسیده">
                        <img src="../files/Sback.PNG" alt="درخواست ها" class="card-icon">
                    </a>
                    <a href="requests.php" class="btn">درخواست های رسیده</a>
                </div>

                <div class="card" data-order="17">
                    <a href="list_bah.php" title="ویرایش شماره همراه بهره بردار">
                        <img src="../files/login_rep.png" alt="ویرایش شماره" class="card-icon">
                    </a>
                    <a href="list_bah.php" class="btn">ویرایش شماره همراه بهره بردار</a>
                </div>

                <div class="card" data-order="18">
                    <a href="../oChief" title="کاربری مدیریت سامانه">
                        <img src="../files/changeuser.png" alt="مدیریت سامانه" class="card-icon">
                    </a>
                    <a href="../oChief" class="btn">کاربری مدیریت سامانه</a>
                </div>
            </div>
        </div>

        <div class="footer">
            <?php include('../footer.php')?>
        </div>
    </div>

    <script>
    // اسکریپت تشخیص نمایش کارت‌ها هنگام اسکرول
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card');
        
        // تنظیم order برای هر کارت
        cards.forEach(card => {
            const order = card.getAttribute('data-order');
            card.style.setProperty('--order', order);
        });

        // تنظیمات Intersection Observer
        const observerOptions = {
            threshold: 0.1, // وقتی 10% از المان در viewport قرار گرفت
            rootMargin: '0px 0px -50px 0px' // 50px از پایین viewport کم می‌شود
        };
        
        const observerCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    observer.unobserve(entry.target);
                }
            });
        };
        
        const observer = new IntersectionObserver(observerCallback, observerOptions);
        
        // مشاهده همه کارت‌ها
        cards.forEach(card => {
            observer.observe(card);
        });
    });
    </script>
</body>
</html>