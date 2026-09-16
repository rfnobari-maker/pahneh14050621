<?php include("../../lock_p2.php"); ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
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
            --gradient-start: #2563eb;
            --gradient-end: #3b82f6;
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
            margin: 0 auto;
            background: var(--bg-color);
        }

        .header-image {
            width: 100%;
            height: 100px;
            object-fit: cover;
            display: block;
        }

        .content-section {
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin: 30px 0;
            color: var(--text-color);
            font-size: 24px;
            font-weight: bold;
        }

        .divider {
            width: 700px;
            height: 19px;
            margin: 20px auto;
            display: block;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(275px, 1fr));
            gap: 25px;
            padding: 20px;
            max-width: 1400px;
            margin: 20px auto;
        }

        .card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 16px var(--shadow-color);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-align: center;
            opacity: 0;
            transform: translateY(30px);
            will-change: transform, opacity;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card.animate {
            animation: cardEntrance 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
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

        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 12px 24px var(--shadow-color);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
            z-index: 10;
        }

        .card:hover::before {
            transform: scaleX(1);
        }

        .card-icon {
            width: 86px;
            height: 80px;
            margin: 0 auto 20px;
            display: block;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 4px 8px var(--shadow-color));
        }

        .card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
            opacity: 0.8;
        }

        .btn {
            display: block;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: white;
            padding: 14px 0;
            border-radius: 12px;
            text-decoration: none;
            margin: 15px auto 0;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            width: 90%;
            max-width: 250px;
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
            position: relative;
            overflow: hidden;
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
            background: linear-gradient(135deg, var(--gradient-end), var(--gradient-start));
        }

        .btn:hover::before {
            left: 100%;
        }

        .back-button {
            display: block;
            width: 150px;
            height: 45px;
            margin: 20px auto;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: Tahoma, Arial, sans-serif;
        }

        .back-button:hover {
            background: var(--hover-color);
            transform: translateY(-2px);
        }

        .footer {
            height: 109px;
            background: url('../../files/bottom.gif') repeat-x;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .cards-container {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 15px;
            }

            .card {
                padding: 20px;
            }

            .btn {
                padding: 12px 0;
            }

            .divider {
                width: 100%;
                max-width: 700px;
            }
        }

        @media (max-width: 480px) {
            .cards-container {
                gap: 15px;
                padding: 10px;
            }

            .card {
                padding: 15px;
            }

            .card-icon {
                width: 70px;
                height: 65px;
            }

            .section-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="../../files/images/header.jpg" alt="header" class="header-image">
        <div dir="ltr"><?php include('menu.php'); ?></div>
        <?php include('top.php'); ?>

        <div class="content-section">
            <h1 class="section-title">واحدهای گلخانه</h1>
            <img src="../../files/horizontal-line-700x223.png" alt="divider" class="divider">

            <div class="cards-container">
                <div class="card">
                    <a href="liste_Greenhousn.php" title="لیست واحدهای گلخانه">
                        <img src="../../files/greenhous.png" alt="bee" class="card-icon">
                    </a>
                    <a href="liste_Greenhousn.php" class="btn">لیست واحدهای گلخانه</a>
                </div>

                <div class="card">
                    <a href="list_Mushroom_nonP.php" title="لیست واحدهای فاقد عملکرد">
                        <img src="../../files/inactive_abadi.png" alt="bee" class="card-icon">
                    </a>
                    <a href="list_Greenhous_nonP.php" class="btn">لیست واحدهای فاقد عملکرد</a>
                </div>

                <div class="card">
                    <a href="list_Greenhous_W_P.php" title="لیست واحدهای دارای عملکرد">
                        <img src="../../files/active_abadi.png" alt="bee" class="card-icon">
                    </a>
                    <a href="list_Greenhous_W_P.php" class="btn">لیست واحدهای دارای عملکرد</a>
                </div>

                <div class="card">
                    <a href="Greenh_rep1.php" title="گزارش ویژه عملکرد سالانه">
                        <img src="../../files/active_abadi.png" alt="گزارش ویژه زراعت" class="card-icon">
                    </a>
                    <a href="Greenh_rep1.php" class="btn">گزارش ویژه عملکرد سالانه</a>
                </div>

                <div class="card">
                    <a href="Greenh_report1.php" title="گزارش گلخانه ها">
                        <img src="../../files/filter_data_icon.jpg" alt="گزارش ویژه زراعت" class="card-icon">
                    </a>
                    <a href="Greenh_report1.php" class="btn">گزارش گلخانه ها</a>
                </div>

                <div class="card">
                    <a href="Greenh_rep170.php" title="گزارش ویژه محصولات">
                        <img src="../../files/filter_data.png" alt="گزارش ویژه زراعت" class="card-icon">
                    </a>
                    <a href="Greenh_rep170.php" class="btn">گزارش ویژه محصولات</a>
                </div>
            </div>

            <a href="index.php">
                <input type="submit" value="بازگشت" class="back-button">
            </a>
        </div>

        <div class="footer">
            <?php include('../../footer.php') ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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