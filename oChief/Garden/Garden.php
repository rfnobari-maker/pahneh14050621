<?php include("../../lock_oce.php");
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
        .card:nth-child(5) { animation-delay: 0.5s; }
        .card:nth-child(6) { animation-delay: 0.6s; }
        .card:nth-child(7) { animation-delay: 0.7s; }
        .card:nth-child(8) { animation-delay: 0.8s; }
        .card:nth-child(9) { animation-delay: 0.9s; }
        .card:nth-child(10) { animation-delay: 1.0s; }

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
            <h2 class="page-title">باغ</h2>
            <p align="center"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

            <div class="cards-container">
                <?php  if(strstr($perm,'d3')) { ?>
                <div class="card">
                    <a href="liste_Garden.php" title="لیست بهره برداری های باغی">
                        <img src="../../files/tree.png" alt="لیست بهره برداری های باغی" class="card-icon">
                    </a>
                    <a href="liste_Garden.php" class="btn">لیست بهره برداری های باغی</a>
                </div>
                <div class="card">
                    <a href="Garden_rep1.php" title="اطلاعات باغی به تفکیک شهرستان">
                        <img src="../../files/Sback.PNG" alt="اطلاعات باغی به تفکیک شهرستان" class="card-icon">
                    </a>
                    <a href="Garden_rep1.php" class="btn">اطلاعات باغی به تفکیک شهرستان</a>
                </div>
                
                <div class="card">
                    <a href="Garden_rep13.php" title="گزارش محصولات باغی">
                        <img src="../../files/Garden_rep13.png" alt="گزارش محصولات باغی" class="card-icon">
                    </a>
                    <a href="Garden_rep13.php" class="btn">گزارش محصولات باغی</a>
                </div>
                <div class="card">
                    <a href="Garden_rep15.php" title="گزارش محصولات باغی / بهره بردار">
                        <img src="../../files/Garden_rep15.png" alt="گزارش محصولات باغی / بهره بردار" class="card-icon">
                    </a>
                    <a href="Garden_rep15.php" class="btn">گزارش محصولات باغی / بهره بردار</a>
                </div>
                <div class="card">
                    <a href="Garden_rep11p.php" title="اطلاعات باغی محصول /شهرستان">
                        <img src="../../files/region.png" alt="اطلاعات باغی محصول /شهرستان" class="card-icon">
                    </a>
                    <a href="Garden_rep11p.php" class="btn">اطلاعات باغی محصول /شهرستان</a>
                </div>
                <div class="card">
                    <a href="Garden_rep16.php" title="گزارش تولید به تفکیک محصول">
                        <img src="../../files/Garden_rep13.png" alt="گزارش تولید به تفکیک محصول" class="card-icon">
                    </a>
                    <a href="Garden_rep16.php" class="btn">گزارش تولید به تفکیک محصول</a>
                </div>
                <div class="card">
                    <a href="rep_dehestan.php" title="اطلاعات باغی دهستان / محصول">
                        <img src="../../files/pub_abadi.png" alt="اطلاعات باغی دهستان / محصول" class="card-icon">
                    </a>
                    <a href="rep_dehestan.php" class="btn">اطلاعات باغی دهستان / محصول</a>
                </div>
                <div class="card">
                    <a href="Garden_rep170.php" title="گزارش ویژه محصولات باغی">
                        <img src="../../files/filter_data.png" alt="گزارش ویژه محصولات باغی" class="card-icon">
                    </a>
                    <a href="Garden_rep170.php" class="btn">گزارش ویژه محصولات باغی</a>
                </div>
                <div class="card">
                    <a href="Garden_no_edit.php" title="ویرایش نشده ها">
                        <img src="../../files/return.png" alt="ویرایش نشده ها" class="card-icon">
                    </a>
                    <a href="Garden_no_edit.php" class="btn">ویرایش نشده ها</a>
                </div>
                <?php } if(strstr($perm,'d4')) { ?>
                <?php } if(strstr($perm,'d5')) { ?>
                <div class="card">
                    <a href="Garden_edit_T_98.php" title="بررسی تولید قطعی">
                        <img src="../../files/icon-rma.png" alt="بررسی تولید قطعی" class="card-icon">
                    </a>
                    <a href="Garden_edit_T_98.php" class="btn">بررسی تولید قطعی</a>
                </div>
                <?php }?>
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