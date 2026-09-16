<?php 
include("../lock_expar.php");
include('counter.php');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="../FA.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <div class="container">
        <img src="../files/images/header.jpg" alt="header" class="header-image">
        <div dir="ltr"> <?php include('menu.php'); ?> </div>
        <?php include('top.php'); ?>
        <div class="content-section">
            <div class="cards-container">
                <div class="card">
                    <a href="profile.php" title="ویرایش اطلاعات کاربری">
                        <img src="../files/request.jpg" alt="upload" class="card-icon">
                    </a>
                    <a href="profile.php" class="btn">ویرایش اطلاعات کاربری</a>
                </div>
                <div class="card">
                    <a href="centers.php" title="لیست مراکز جهاد کشاورزی">
                        <img src="../files/centers.png" alt="users" class="card-icon">
                    </a>
                    <a href="centers.php" class="btn">شهرستان های منطقه : <?php echo city_count($id_ostan,$id_aria) ; ?></a>
                </div>
                <div class="card">
                    <a href="lists_city.php" title="مشاهده لیست شهر های تحت پوشش">
                        <img src="../files/city.png" alt="users" class="card-icon">
                    </a>
                    <a href="lists_city.php" class="btn">شهرهای تحت پوشش : <?php echo shahr_count($id_ostan,$id_aria) ; ?></a>
                </div>
                <div class="card">
                    <a href="lists_abadi.php" title="لیست آبادی های شهرستان ">
                        <img src="../files/abadi.png" alt="users" class="card-icon">
                    </a>
                    <a href="lists_abadi.php" class="btn">آبادی های تحت پوشش:<?php echo ostan_abadi_count($id_ostan,$id_aria) ; ?></a>
                </div>
                <div class="card">
                    <a href="list_pubcity.php" title="مشاهده اطلاعات عمومی شهر ها ">
                        <img src="../files/city-pub.png" alt="users" class="card-icon">
                    </a>
                    <a href="list_pubcity.php" class="btn">اطلاعات عمومی شهر ها</a>
                </div>
                <div class="card">
                    <a href="listpublic_abadi.php" title="اطلاعات عمومی  آبادی ها">
                        <img src="../files/pub_abadi.png" alt="users" class="card-icon">
                    </a>
                    <a href="listpublic_abadi.php" class="btn">اطلاعات عمومی  آبادی ها</a>
                </div>
                <div class="card">
                    <a href="prof.php" title="اطلاعات اختصاصی  آبادی ها">
                        <img src="../files/p_abadi.png" alt="users" class="card-icon">
                    </a>
                    <a href="prof.php" class="btn">اطلاعات اختصاصی</a>
                </div>
                <div class="card">
                    <a href="ostan_promo.php" title="مروجین شهرستان">
                        <img src="../files/morvege1.png" alt="users" class="card-icon">
                    </a>
                    <a href="ostan_promo.php" class="btn">کارشناسان پهنه  :<?php echo ostan_mor_count($id_ostan,$id_aria) ?></a>
                </div>
                <div class="card">
                    <a href="search_promo.php" title="جستجوی مروج">
                        <img src="../files/morvege2.png" alt="users" class="card-icon">
                    </a>
                    <a href="search_promo.php" class="btn">جستجوی کاربر</a>
                </div>
            </div>
        </div>
        <div class="footer" style="height: 109px; background: url('../files/bottom.gif') repeat-x; display: flex; align-items: center; justify-content: center;">
            <?php include('../footer.php')?>
        </div>
    </div>
    <script>
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
    </script>
</body>
</html> 