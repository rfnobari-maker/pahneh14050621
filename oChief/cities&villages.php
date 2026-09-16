<?php 
include("../lock_oce.php");
include('counter.php');
//echo $login_session;
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
            height: 149px;
            object-fit: cover;
            display: block;
        }

        .content-section {
            padding: 0 20px;
        }

        .page-title {
            text-align: center;
            font-size: 24px;
            margin: 20px 0;
            color: var(--text-color);
        }

        .divider {
            display: block;
            margin: 20px auto;
            max-width: 700px;
            height: 19px;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            padding: 20px;
            margin: 20px auto;
            max-width: 1100px;
        }

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

            .btn {
                padding: 10px 16px;
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
            <h2 class="page-title">شهرها و آبادی ها</h2>
            <img src="../files/horizontal-line-700x223.png" alt="divider" class="divider">

            <div class="cards-container">
                <div class="card">
                    <a href="list_pubcity.php" title="مشاهده اطلاعات عمومی شهر ها">
                        <img src="../files/city-pub.png" alt="عمومی شهرها" class="card-icon">
                    </a>
                    <a href="list_pubcity.php" class="btn">اطلاعات عمومی شهر ها</a>
                </div>

                <div class="card">
                    <a href="lists_city.php" title="لیست شهر های تحت پوشش">
                        <img src="../files/city.png" alt="شهرها" class="card-icon">
                    </a>
                    <a href="lists_city.php" class="btn">شهرهای تحت پوشش: <?php echo shahr_count($id_ostan); ?></a>
                </div>

                <div class="card">
                    <a href="lists_abadi.php" title="لیست آبادی های شهرستان">
                        <img src="../files/abadi.png" alt="آبادی ها" class="card-icon">
                    </a>
                    <a href="lists_abadi.php" class="btn">آبادی های تحت پوشش: <?php echo ostan_abadi_count($id_ostan); ?></a>
                </div>

                <div class="card">
                    <a href="listpublic_abadi.php" title="اطلاعات عمومی آبادی ها">
                        <img src="../files/pub_abadi.png" alt="اطلاعات عمومی آبادی" class="card-icon">
                    </a>
                    <a href="listpublic_abadi.php" class="btn">اطلاعات عمومی آبادی ها</a>
                </div>

                <div class="card">
                    <a href="ostan_cod.php" title="کد های استان، شهرستان و مرکز جهاد کشاورزی">
                        <img src="../files/ostan_cod.png" alt="کدهای استان و شهرستان" class="card-icon">
                    </a>
                    <a href="ostan_cod.php" class="btn">کد های استان، شهرستان و مرکز</a>
                </div>

                <div class="card">
                    <a href="lists_abadi_conflict_mor.php" title="آبادی های مغایر">
                        <img src="../files/morvege_notok.png" alt="آبادی های مغایر" class="card-icon">
                    </a>
                    <a href="lists_abadi_conflict_mor.php" class="btn">آبادی های مغایر شهرستان / کارشناس</a>
                </div>

                <div class="card">
                    <a href="search_abadi.php" title="سوابق اطلاعات آبادی">
                        <img src="../files/add_new.png" alt="سوابق آبادی" class="card-icon">
                    </a>
                    <a href="search_abadi.php" class="btn">سوابق اطلاعات یک آبادی</a>
                </div>
            </div>

            <div class="back-button">
                <a href="index.php" title="برگشت به صفحه قبل">
                    <img src="../files/goback.jpg" alt="بازگشت" width="118" height="47">
                </a>
            </div>
        </div>

        <div class="footer">
            <?php include('../footer.php')?>
        </div>
    </div>
</body>
</html> 