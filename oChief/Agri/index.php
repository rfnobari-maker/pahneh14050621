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
        .card:nth-child(11) { animation-delay: 1.1s; }
        .card:nth-child(12) { animation-delay: 1.2s; }
        .card:nth-child(13) { animation-delay: 1.3s; }
        .card:nth-child(14) { animation-delay: 1.4s; }
        .card:nth-child(15) { animation-delay: 1.5s; }
        .card:nth-child(16) { animation-delay: 1.6s; }
        .card:nth-child(17) { animation-delay: 1.7s; }
        .card:nth-child(18) { animation-delay: 1.8s; }
        .card:nth-child(19) { animation-delay: 1.9s; }
        .card:nth-child(20) { animation-delay: 2.0s; }
        .card:nth-child(21) { animation-delay: 2.1s; }

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
            <h2 class="page-title">مدیریت زراعت</h2>
            <p align="center"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

            <div class="cards-container">
                <?php if(strstr($perm,'d1')) { ?>
               <div class="card">
                    <a href="Pattern" title="الگوی کشت ابلاغی">
                        <img src="../../files/add_new.png" alt="الگوی کشت ابلاغی" class="card-icon">
                    </a>
                    <a href="Pattern" class="btn">الگوی کشت ابلاغی</a>
                </div>
                <div class="card">
                    <a href="liste_Agri.php" title="لیست بهره برداری های زراعی">
                        <img src="../../files/Sback.PNG" alt="بهره برداری زراعی" class="card-icon">
                    </a>
                    <a href="liste_Agri.php" class="btn">لیست بهره برداری های زراعی</a>
                </div>
                <div class="card">
                    <a href="Agri_rep11.php" title="گزارش اطلاعات زراعی استان">
                        <img src="../../files/setting.png" alt="گزارش اطلاعات زراعی استان" class="card-icon">
                    </a>
                    <a href="Agri_rep11.php" class="btn">گزارش اطلاعات زراعی استان</a>
                </div>
                <div class="card">
                    <a href="Agri_rep160.php" title="گزارش گروه محصولات زراعی">
                        <img src="../../files/receive.png" alt="گزارش گروه محصولات زراعی" class="card-icon">
                    </a>
                    <a href="Agri_rep160.php" class="btn">گزارش گروه محصولات زراعی</a>
                </div>
                <div class="card">
                    <a href="Agri_rep16.php" title="گزارش محصولات زراعی">
                        <img src="../../files/agri_prod.png" alt="گزارش محصولات زراعی" class="card-icon">
                    </a>
                    <a href="Agri_rep16.php" class="btn">گزارش محصولات زراعی</a>
                </div>
                <div class="card">
                    <a href="Agri_rep21.php" title="اطلاعات زراعی آبادی / محصول">
                        <img src="../../files/abadi.png" alt="اطلاعات زراعی آبادی / محصول" class="card-icon">
                    </a>
                    <a href="Agri_rep21.php" class="btn">اطلاعات زراعی آبادی / محصول</a>
                </div>
                <div class="card">
                    <a href="rep_keshavarz_city.php" title="اطلاعات زراعی شهر / محصول">
                        <img src="../../files/active_city.png" alt="اطلاعات زراعی شهر / محصول" class="card-icon">
                    </a>
                    <a href="rep_keshavarz_city.php" class="btn">اطلاعات زراعی شهر / محصول</a>
                </div>
                <div class="card">
                    <a href="Agri_rep14.php" title="گزارش اطلاعات زراعی به تفکیک بهره بردار">
                        <img src="../../files/morvege.png" alt="گزارش اطلاعات زراعی به تفکیک بهره بردار" class="card-icon">
                    </a>
                    <a href="Agri_rep14.php" class="btn">گزارش اطلاعات زراعی به تفکیک بهره بردار</a>
                </div>
                <div class="card">
                    <a href="Agri_rep15.php" title="گزارش اطلاعات زراعی بهره بردار / محصول">
                        <img src="../../files/morvege.png" alt="گزارش اطلاعات زراعی بهره بردار / محصول" class="card-icon">
                    </a>
                    <a href="Agri_rep15.php" class="btn">گزارش اطلاعات زراعی بهره بردار / محصول</a>
                </div>
                <div class="card">
                    <a href="Agri_rep18.php" title="بهره برداران تولید کننده یک محصول">
                        <img src="../../files/user.jpg" alt="بهره برداران تولید کننده یک محصول" class="card-icon">
                    </a>
                    <a href="Agri_rep18.php" class="btn">بهره برداران تولید کننده یک محصول</a>
                </div>
                <div class="card">
                    <a href="Agri_rep220.php" title="گزارش تولید به تفکیک محصول">
                        <img src="../../files/agri_prod.png" alt="گزارش تولید به تفکیک محصول" class="card-icon">
                    </a>
                    <a href="Agri_rep220.php" class="btn">گزارش تولید به تفکیک محصول</a>
                </div>
                <div class="card">
                    <a href="Agri_rep170.php" title="گزارش ویژه محصولات زراعی">
                        <img src="../../files/filter_data.png" alt="گزارش ویژه محصولات زراعی" class="card-icon">
                    </a>
                    <a href="Agri_rep170.php" class="btn">گزارش ویژه محصولات زراعی</a>
                </div>
                <div class="card">
                    <a href="Agri_rep23.php" title="گزارش ویژه اراضی زراعی">
                        <img src="../../files/filter_data.png" alt="گزارش ویژه اراضی زراعی" class="card-icon">
                    </a>
                    <a href="Agri_rep23.php" class="btn">گزارش ویژه اراضی زراعی</a>
                </div>
                <div class="card">
                    <a href="Agri_rep11p.php" title="اطلاعات زراعی محصول / شهرستان">
                        <img src="../../files/region.png" alt="اطلاعات زراعی محصول / شهرستان" class="card-icon">
                    </a>
                    <a href="Agri_rep11p.php" class="btn">اطلاعات زراعی محصول / شهرستان</a>
                </div>
                <div class="card">
                    <a href="rep_keshavarz.php" title="اطلاعات زراعی دهستان / محصول">
                        <img src="../../files/pub_abadi.png" alt="اطلاعات زراعی دهستان / محصول" class="card-icon">
                    </a>
                    <a href="rep_keshavarz.php" class="btn">اطلاعات زراعی دهستان / محصول</a>
                </div>
                <div class="card">
                    <a href="AgriP_edit_T.php" title="بررسی تولید قطعی">
                        <img src="../../files/icon-rma.png" alt="بررسی تولید قطعی" class="card-icon">
                    </a>
                    <a href="AgriP_edit_T.php" class="btn">بررسی تولید قطعی</a>
                </div>
                <div class="card">
                    <a href="list_Agri_no_editing.php" title="لیست قطعات فاقد ویرایش">
                        <img src="../../files/download-(2).jpg" alt="لیست قطعات فاقد ویرایش" class="card-icon">
                    </a>
                    <a href="list_Agri_no_editing.php" class="btn">لیست قطعات فاقد ویرایش</a>
                </div>
                <div class="card">
                    <a href="amar.php" title="گزارشات آمارنامه">
                        <img src="../../files/sent0.png" alt="گزارشات آمارنامه" class="card-icon">
                    </a>
                    <a href="amar.php" class="btn">گزارشات آمارنامه</a>
                </div>
                <div class="card">
                    <a href="Agri_deleted.php" title="رکوردهای حذف شده">
                        <img src="../../files/download-(2).jpg" alt="رکوردهای حذف شده" class="card-icon">
                    </a>
                    <a href="Agri_deleted.php" class="btn">رکوردهای حذف شده</a>
                </div>
                <div class="card">
                    <a href="delivery" title="گندم تحویلی به دولت">
                        <img src="../../files/zera.png" alt="گندم تحویلی به دولت" class="card-icon">
                    </a>
                    <a href="delivery.php" class="btn">گندم تحویلی به دولت</a>
                </div>

          
              <?php } if(strstr($perm,'d2')) { ?>
                <div class="card">
                    <a href="Vege.php" title="محصولات عمده صیفی">
                        <img src="../../files/Vege.png" alt="محصولات عمده صیفی" class="card-icon">
                    </a>
                    <a href="Vege.php" class="btn">محصولات عمده صیفی</a>
                </div>
                <?php } ?>
            </div>

            <div class="back-button">
                <a href="../prof.php" title="برگشت به صفحه قبل">
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