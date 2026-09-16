<?php
include("../../lock_ce.php");
?>
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
            font-size: 32px;
            margin: 30px 0;
            color: var(--text-color);
            text-shadow: 2px 2px 4px var(--shadow-color);
        }

        .divider {
            max-width: 700px;
            margin: 30px auto;
            height: 3px;
            background: linear-gradient(to right, transparent, var(--accent-color), transparent);
            opacity: 0.7;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            padding: 20px;
            margin: 20px 0;
        }

        .card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 16px var(--shadow-color);
            transition: all 0.4s ease;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px var(--shadow-color);
        }

        .card-icon {
            width: 86px;
            height: 86px;
            margin: 0 auto 30px;
            display: block;
            transition: all 0.4s ease;
            filter: drop-shadow(0 4px 8px var(--shadow-color));
        }

        .card:hover .card-icon {
            transform: scale(1.15) rotate(5deg);
            opacity: 0.2;
        }

        .btn {
            display: block;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 14px 24px;
            border-radius: 12px;
            text-decoration: none;
            margin: 15px 0;
            text-align: center;
            transition: all 0.3s ease;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
        }

        .back-button {
            display: block;
            width: 180px;
            height: 50px;
            margin: 40px auto;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
        }

        .footer {
            background: url('../../files/bottom.gif') repeat-x;
            height: 109px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .cards-container {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 10px;
            }

            .card {
                padding: 20px;
            }

            .page-title {
                font-size: 24px;
            }

            .btn {
                padding: 12px 20px;
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
            <h1 class="page-title">باغبانی</h1>
            <div class="divider"></div>

            <div class="cards-container">
                <!-- کارت باغ و قلمستان -->
                <div class="card">
                    <img src="../../files/tree.png" alt="باغ" class="card-icon">
                    <a href="Garden.php" class="btn">ثبت بهره برداری باغی و قلمستان جدید</a>
                    <a href="manager_Garden.php" class="btn">مدیریت بهره برداری باغی و قلمستان</a>
                    <a href="liste_Garden.php" class="btn">لیست بهره برداری های باغی و قلمستان</a>
                    <a href="Garden_no_edit.php" class="btn">ویرایش نشده های بعد از انتقال</a>
                    <a href="Garden_edit_T_new.php" class="btn">تکمیل اطلاعات تولید قطعی</a>
                </div>

                <!-- کارت گزارشات -->
                <div class="card">
                    <img src="../../files/Garden_rep13.png" alt="گزارشات باغ" class="card-icon">
                    <a href="Garden_rep13.php" class="btn">گزارش محصولات باغی</a>
                    <a href="Garden_rep15.php" class="btn">گزارش محصولات باغی / بهره بردار</a>
                    <a href="Garden_rep170.php" class="btn">گزارش ویژه محصولات باغی</a>
                </div>

                <!-- کارت گلخانه -->
                <div class="card">
                    <img src="../../files/greenhous.png" alt="گلخانه" class="card-icon">
                    <a href="Greenhous.php" class="btn">ثبت گلخانه جدید</a>
                    <a href="Greenhous_prodi.php" class="btn">ثبت عملکرد سالانه واحد</a>
                    <a href="liste_Greenhousn_old.php" class="btn">مدیریت واحد گلخانه</a>
                    <a href="list_Greenhous_nonP.php" class="btn">واحد های فاقد عملکرد</a>
                    <a href="Greenh_rep1.php" class="btn">لیست عملکرد واحدها</a>
                    <a href="Greenh_rep170.php" class="btn">گزارش اختصاصی محصولات</a>
                </div>

                <!-- کارت قارچ -->
                <div class="card">
                    <img src="../../files/mushroom.png" alt="قارچ" class="card-icon">
                    <a href="Mushroom.php" class="btn">ثبت واحد پرورش قارچ جدید</a>
                    <a href="Mushroom_prodi.php" class="btn">ثبت عملکرد سالانه واحد</a>
                    <a href="liste_Mushroom.php" class="btn">مدیریت واحد های پرورش قارچ</a>
                </div>
            </div>

            <a href="../index.php">
                <button class="back-button">بازگشت</button>
            </a>
        </div>

        <div class="footer">
            <?php include('../../footer.php')?>
        </div>
    </div>
</body>
</html> 