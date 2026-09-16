<?php
include("../lock_oce.php");
include('counter.php');
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

            .welcome-banner img {
                max-width: 200px;
            }
        }
    </style>

</head>
<body>
    <div class="container">
        <img src="../files/images/header.jpg" alt="header" class="header-image">
        
        <div dir="ltr"> <?php include('menu.php'); ?> </div>
        <?php include('top.php'); ?>

        <div align="center" class="content-section">
            <div class="title-section">
                <h1>کاربران سامانه</h1>
                <img src="../files/horizontal-line-700x223.png" alt="divider" width="700" height="19">
            </div>

            <div class="cards-container">
                <div class="card">
                    <a href="profile.php" title="ویرایش اطلاعات کاربری">
                        <img src="../files/request.jpg" alt="اطلاعات کاربری" class="card-icon">
                    </a>
                    <a href="profile.php" class="btn">ویرایش اطلاعات کاربری</a>
                </div>

                <div class="card">
                    <a href="user_view.php" title="مدیریت درخواست های ثبت شده">
                        <img src="../files/1_003.png" alt="users" class="card-icon">
                    </a>
                    <a href="user_view.php" class="btn">مدیریت کاربران</a>
                </div>

                <div class="card">
                    <a href="ostan_promo.php" title="مروجین شهرستان">
                        <img src="../files/morvege1.png" alt="مروجین کشاورزی" class="card-icon">
                    </a>
                    <a href="ostan_promo.php" class="btn">مروجین استان: <?php echo ostan_mor_count($id_ostan) ?></a>
                </div>

                <div class="card">
                    <a href="list_chief.php" title="لیست کارشناسان معین استانی">
                        <img src="../files/chief.jpg" alt="مدیران استانی" class="card-icon">
                    </a>
                    <a href="list_chief.php" class="btn">مدیران استانی سامانه: <?php echo ostan_chief_count($id_ostan); ?></a>
                </div>

                <div class="card">
                    <a href="list_expar.php" title="لیست کارشناسان معین استانی">
                        <img src="../files/exp_ostan.png" alt="کارشناسان معین" class="card-icon">
                    </a>
                    <a href="list_expar.php" class="btn">کارشناسان معین استان: <?php echo ostan_expar_count($id_ostan); ?></a>
                </div>

                <div class="card">
                    <a href="list_expar_sh.php" title="لیست کارشناسان معین استانی">
                        <img src="../files/exp_city.png" alt="کارشناسان موضوعی" class="card-icon">
                    </a>
                    <a href="list_expar_sh.php" class="btn">کارشناسان موضوعی شهرستان: <?php echo ostan_expar_sh_count($id_ostan); ?></a>
                </div>

                <div class="card">
                    <a href="list_scholar.php" title="لیست کارشناسان معین استانی">
                        <img src="../files/scholar.png" alt="محققین معین" class="card-icon">
                    </a>
                    <a href="list_scholar.php" class="btn">محققین معین شهرستان: <?php echo ostan_scholar_count($id_ostan); ?></a>
                </div>

                <div class="card">
                    <a href="search_promo.php" title="جستجوی مروج">
                        <img src="../files/morvege2.png" alt="جستجوی کاربر" class="card-icon">
                    </a>
                    <a href="search_promo.php" class="btn">جستجوی کاربر</a>
                </div>

                <div class="card">
                    <a href="live_view.php" title="مشاهده عملکرد روزانه کاربران">
                        <img src="../files/live.png" alt="عملکرد بروز کاربران" class="card-icon">
                    </a>
                    <a href="live_view.php" class="btn">مشاهده عملکرد کاربران</a>
                </div>

                <div class="card">
                    <a href="promo_action.php" title="مروجین شهرستان">
                        <img src="../files/reports.png" alt="عملکرد مروجین" class="card-icon">
                    </a>
                    <a href="promo_action.php" class="btn">گزارش عملکرد کارشناسان پهنه</a>
                </div>

                <div class="card">
                    <a href="login_rep.php" title="گزارش ورود به سامانه">
                        <img src="../files/login_rep.png" alt="گزارش ورود به سامانه" class="card-icon">
                    </a>
                    <a href="login_rep.php" class="btn">گزارش ورود به سامانه</a>
                </div>

                <?php 
                $query = "SELECT * from users WHERE username='".$user_check."' and S_access='98'";
                $stmt = $dbh->prepare($query);
                $stmt->execute();
                $ch_num = $stmt->rowCount();
                if ($ch_num > 0) { ?>
                <div class="card">
                    <a href="admins.php" title="ادمین های استانی">
                        <img src="../files/1_003.png" alt="ادمین" class="card-icon">
                    </a>
                    <a href="admins.php" class="btn">ادمین سایر استان ها</a>
                </div>
                <?php } ?>
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