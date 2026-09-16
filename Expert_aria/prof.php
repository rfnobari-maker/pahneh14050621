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
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            justify-content: end;
            direction: rtl;
        }
        .card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 32px;
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
            max-width: 350px;
            margin: 0;
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
        .back-btn {
            display: inline-block;
            margin: 30px auto 0 auto;
            background: var(--primary-color);
            color: #fff;
            padding: 12px 36px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 2px 8px var(--shadow-color);
            transition: background 0.3s, transform 0.3s;
        }
        .back-btn:hover {
            background: var(--hover-color);
            transform: translateY(-2px);
        }
        @media (max-width: 768px) {
            .cards-container {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 15px;
                padding: 15px;
                max-width: 100%;
                justify-content: center;
            }
            .card {
                padding: 15px;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="../files/images/header.jpg" alt="header" class="header-image">
        <div dir="ltr"> <?php include('menu.php'); ?> </div>
        <?php include('top.php'); ?>
        <p align="center"><img src="../files/reza.gif" width="240" height="57" style="border-radius:15px" alt=""/></p>
        <div class="content-section">
            <div class="cards-container">
                <div class="card">
                    <a href="list_bah.php" title="اطلاعات بهره برداران کشاورزی">
                        <img src="../files/farmer.png" alt="upload" class="card-icon" style="width:71px;height:86px;">
                    </a>
                    <a href="list_bah.php" class="btn">بهره برداران کشاورزی</a>
                </div>
                <?php if ($expert_unit=='4') {?>
                <div class="card">
                    <a href="Agri/liste_Agri.php" title="ویرایش و حذف اطلاعات بهره بردار">
                        <img src="../files/zera.png" alt="users" class="card-icon" style="width:86px;height:86px;">
                    </a>
                    <a href="Agri" class="btn">مدیریت امور زراعت</a>
                </div>
                <?php } if ($expert_unit=='2') {?>
                <div class="card">
                    <a href="Garden" title="#">
                        <img src="../files/tree.png" alt="users" class="card-icon" style="width:86px;height:86px;">
                    </a>
                    <a href="Garden" class="btn">مدیریت امور باغبانی</a>
                </div>
                <?php } if ($expert_unit=='6') {?>
                <div class="card">
                    <a href="Animal/index.php" title="#">
                        <img src="../files/ani.jpg" alt="users" class="card-icon" style="width:86px;height:86px;">
                    </a>
                    <a href="Animal/index.php" class="btn">مدیریت امور دام</a>
                </div>
                <?php } if ($expert_unit=='7') {?>
                <div class="card">
                    <a href="Poultry/" title="#">
                        <img src="../files/pol.jpg" alt="users" class="card-icon" style="width:86px;height:86px;">
                    </a>
                    <a href="Poultry/" class="btn">مدیریت امور طیور و زنبور عسل</a>
                </div>
                <?php } if ($expert_unit=='5') {?>
                <div class="card">
                    <a href="Aquatic" title="#">
                        <img src="../files/fish1.png" alt="users" class="card-icon" style="width:86px;height:87px;">
                    </a>
                    <a href="Aquatic" class="btn">مدیریت شیلات و آبزی پروری</a>
                </div>
                <?php } if ($expert_unit=='10') {?>
                <div class="card">
                    <a href="#" title="#">
                        <img src="../files/ab.png" alt="users" class="card-icon" style="width:100px;height:83px;">
                    </a>
                    <a href="#" class="btn">مدیریت آب و خاک</a>
                </div>
                <?php } if ($expert_unit=='9') {?>
                <div class="card">
                    <a href="Industry" title="#">
                        <img src="../files/sana.png" alt="users" class="card-icon" style="width:158px;height:86px;">
                    </a>
                    <a href="Industry" class="btn">مدیریت صنایع کشاورزی</a>
                </div>
                <?php } if ($expert_unit=='1') {?>
                <div class="card">
                    <a href="Promotion/index.php" title="#">
                        <img src="../files/farmer-512.png" alt="users" class="card-icon" style="width:86px;height:86px;">
                    </a>
                    <a href="Promotion/index.php" class="btn">مدیریت هماهنگی ترویج</a>
                </div>
                <?php } ?>
            </div>
        </div>
        <div style="text-align:center;">
            <a href="javascript:history.back()" class="back-btn">بازگشت</a>
        </div>
        <div class="footer" style="height: 109px; background: url('../files/bottom.gif') repeat-x; display: flex; align-items: center; justify-content: center; margin-top:30px;">
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