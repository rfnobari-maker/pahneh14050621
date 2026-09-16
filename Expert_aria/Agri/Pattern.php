<?php include("../../lock_expar.php");
//include('../counter.php');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="../../files/images/favicon.ico" type="image/x-icon">
    <link href="../../FA.css" rel="stylesheet">
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
            height: 149px; /* Adjusted height for consistency with the previous header image */
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

        .card.animate {
            animation: cardEntrance 0.8s ease-out forwards;
        }

        @keyframes cardEntrance {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* تاخیرهای زمانی */
        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }

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

        .back-button {
            display: block;
            margin: 20px auto;
            text-align: center;
        }

        .back-button img {
            transition: transform 0.3s ease;
        }

        .back-button img:hover {
            transform: translateX(-5px);
        }

        .footer {
            height: 109px;
            background: url('../../files/bottom.gif') repeat-x;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 40px;
        }
        
        .page-title {
            text-align: center;
            font-size: 24px; /* Adjust as needed */
            color: var(--text-color);
            margin-top: 20px;
            margin-bottom: 10px;
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

            .btn {
                padding: 10px 16px;
            }

            .welcome-banner img {
                max-width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="../../files/images/header.jpg" alt="header" class="header-image">
        
        <div dir="ltr"> <?php include('menu.php'); ?> </div>
        <?php include('top.php'); ?>

        <div class="content-section">
            <h2 class="page-title">برنامه الگوی کشت محصولات زراعی</h2>
            <p align="center"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

            <div class="cards-container">
                <div class="card">
                    <a href="Sab_L1" title="برنامه الگوی کشت استان">
                        <img src="../../files/Sback.PNG" alt="برنامه الگوی کشت استان" class="card-icon">
                    </a>
                    <a href="Sab_L1" class="btn">مشاهده برنامه الگوی کشت استان</a>
                </div>

                <div class="card">
                    <a href="Sab_L2_Prod" title="برش محصول به تفکیک شهرستان">
                        <img src="../../files/region.png" alt="محصول به تفکیک شهرستان" class="card-icon">
                    </a>
                    <a href="Sab_L2_Prod" class="btn">محصول به تفکیک شهرستان</a>
                </div>
             
             
            <?php  if(strstr($perm,'Bsh')) { ?>
                <div class="card">
                    <a href="Agri_s_ab.php" title="ثبت برش شهرستانی الگوی کشت">
                        <img src="../../files/add_new.png" alt="ثبت برش شهرستانی الگوی کشت" class="card-icon">
                    </a>
                    <a href="Agri_s_ab.php" class="btn">ثبت برش شهرستانی الگوی کشت</a>
                </div>

                <div class="card">
                    <a href="Agri_s_ab3.php" title="ثبت برش شهرستانی الگوی کشت-محصول ">
                        <img src="../../files/agri_prod.png" alt="ثبت برش شهرستانی الگوی کشت" class="card-icon">
                    </a>
                    <a href="Agri_s_ab2.php" class="btn">ثبت برش شهرستان به تفکیک محصول</a>
                </div>


              <?php }  ?>

                <div class="card">
                    <a href="Sab_L2" title="مشاهده برش شهرستانی الگوی کشت">
                        <img src="../../files/ostan_cod.png" alt="مشاهده برش شهرستانی " class="card-icon">
                    </a>
                    <a href="Sab_L2" class="btn">مشاهده برش شهرستانی الگوی کشت </a>
                </div>
             
             
              <div class="card">
                    <a href="Sab_L3" title="مشاهده برش مراکز جهاد کشاورزی ">
                        <img src="../../files/send_data.png" alt="مشاهده برش مراکز جهاد کشاورزی " class="card-icon">
                    </a>
                    <a href="Sab_L3" class="btn">مشاهده برش مراکز جهاد کشاورزی </a>
              </div>
            </div>

            <div class="back-button">
                <a href="index.php" title="برگشت به صفحه قبل">
                    <img src="../../files/goback.jpg" alt="بازگشت" width="118" height="47">
                </a>
            </div>
        </div>

        <div class="footer">
            <?php include('../../footer.php')?>
        </div>
    </div>

    <script>
    // اسکریپت تشخیص نمایش کارت‌ها هنگام اسکرول
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card');
        
        // ایجاد Intersection Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1, // وقتی 10% از المان در viewport قرار گرفت
            rootMargin: '0px 0px -50px 0px' // 50px از پایین viewport کم می‌شود
        });

        // مشاهده همه کارت‌ها
        cards.forEach(card => {
            observer.observe(card);
        });
    });
    </script>
</body>
</html> 