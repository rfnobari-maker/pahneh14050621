<?php
include("../../lock_p1.php");
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
            height: 150px;
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
            width: 91px;
            height: 67px;
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
            width: 128px;
            height: 57px;
            margin: 40px auto;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            transform: translateY(-3px);
            filter: brightness(1.1);
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
            <h1 class="page-title">طیور و زنبور عسل</h1>
            <div class="divider"></div>

            <div class="cards-container">
                <!-- کارت زنبورستان -->
                <div class="card">
                    <img src="../../files/bee.png" alt="زنبورستان" class="card-icon">
                    <a href="bee.php" class="btn">ثبت زنبورستان جدید</a>
                    <a href="manager_bee.php" class="btn">مدیریت زنبورستان</a>
                    <a href="list_bee.php" class="btn">لیست زنبورستان ها</a>
                </div>

                <!-- کارت زنبورستان ناشناس -->
                <div class="card">
                    <img src="../../files/unknown_bee.png" alt="زنبورستان ناشناس" class="card-icon">
                    <a href="unknown_bee.php" class="btn">ثبت زنبورستان ناشناس</a>
                    <a href="list_unknown_bee.php" class="btn">لیست زنبورستان های ناشناس</a>
                </div>

                <!-- کارت خاتمه عملیات -->
                <div class="card">
                    <img src="../../files/finish_bee.png" alt="خاتمه عملیات" class="card-icon">
                    <a href="finish_bee.php" class="btn">اعلام خاتمه عملیات</a>
                </div>
            </div>

            <a href="../index.php" title="برگشت به صفحه قبل">
                <img src="../../files/goback.jpg" alt="بازگشت" class="back-button">
            </a>
        </div>

        <div class="footer">
            <?php include('../../footer.php')?>
        </div>
    </div>
</body>
</html> 