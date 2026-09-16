<?php include("../lock_p1.php");
//include('counter.php');
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
            height: 117px;
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
            position: relative;
        }

        .page-title::after {
            content: '';
            display: block;
            width: 100px;
            height: 4px;
            background: var(--accent-color);
            margin: 10px auto;
            border-radius: 2px;
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
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
        }

        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
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
        <img src="../files/images/header.jpg" alt="header" class="header-image">
        
       <div dir="ltr"> <?php include('menu.php'); ?> </div>
        <?php include('top.php'); ?>

        <div class="content-section">
            <h1 class="page-title">بهره برداران کشاورزی</h1>
            <div class="divider"></div>

            <div class="cards-container">
                <div class="card">
                    <a href="benef.php">
                        <img src="../files/farmer.png" alt="ثبت بهره بردار" class="card-icon">
                    </a>
                    <a href="benef.php" class="btn">ثبت بهره بردار جدید</a>
                </div>

                <div class="card">
                    <a href="GetPerson.php#1">
                        <img src="../files/GetPer.png" alt="استعلام" class="card-icon">
                    </a>
                    <a href="GetPerson.php#1" class="btn">استعلام مشخصات بهره بردار</a>
                </div>

                <div class="card">
                    <img src="../files/morvege2.png" alt="جستجو" class="card-icon">
                    <a href="manager_benef.php" class="btn">جستجوی یک بهره بردار</a>
                </div>

                <div class="card">
                    <img src="../files/morvege1.png" alt="لیست" class="card-icon">
                    <a href="liste_benef.php" class="btn">لیست بهره برداران</a>
                </div>

                <?php if($login_session =='1370736770') { ?>
                <div class="card">
                    <a href="Household_bah.php">
                        <img src="../files/add_mor.png" alt="تعیین سرپرست" class="card-icon">
                    </a>
                    <a href="Household_bah.php" class="btn">تعیین سرپرست خانوار</a>
                </div>

                <div class="card">
                    <a href="Household.php">
                        <img src="../files/add_new.png" alt="ثبت سرپرست" class="card-icon">
                    </a>
                    <a href="Household.php" class="btn">ثبت سرپرست خانوار</a>
                </div>
                <?php } ?>

                <div class="card">
                    <a href="search_benef.php">
                        <img src="../files/user-search-icon.png" alt="سوابق" class="card-icon">
                    </a>
                    <a href="search_benef.php" class="btn">سوابق یک بهره بردار</a>
                </div>

                <div class="card">
                    <a href="list_bah_lastname.php">
                        <img src="../files/0347.png" alt="جستجو نام خانوادگی" class="card-icon">
                    </a>
                    <a href="list_bah_lastname.php" class="btn">جستجو براساس نام خانوادگی</a>
                </div>
            </div>

            <a href="index.php">
                <button class="back-button">بازگشت</button>
            </a>
        </div>

        <div class="footer">
            <?php include('../footer.php')?>
        </div>
    </div>
</body>
</html> 