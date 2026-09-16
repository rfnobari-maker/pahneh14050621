<?php include("../../lock_p1.php"); ?>
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
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
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
            width: 86px;
            height: 86px;
            margin: 0 auto 30px;
            display: block;
            transition: all 0.4s ease;
            filter: drop-shadow(0 4px 8px var(--shadow-color));
        }

        .card:hover .card-icon {
            transform: scale(1.15) rotate(5deg);
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
        <img src="../../files/images/header.jpg" alt="header" class="header-image">
        
       <div dir="ltr"> <?php include('menu.php'); ?> </div>
        <?php include('top.php'); ?>

        <div class="content-section">
            <h1 class="page-title">زراعت</h1>
            <div class="divider"></div>

            <div class="cards-container">
                <!-- کارت بهره برداری زراعی -->
                <div class="card">
                    <img src="../../files/zera.png" alt="بهره برداری زراعی" class="card-icon">
                    <a href="Agri1.php" class="btn">ثبت بهره برداری زراعی جدید</a>
                    <a href="liste_Agri.php" class="btn">لیست بهره برداری های زراعی</a>
                    <a href="manager_Agri.php" class="btn">جستجوی بهره برداری زراعی</a>
                    <a href="New_Agri1404.php" class="btn">ثبت اطلاعات پایه، سال زراعی 1404-1403</a>
                    <a href="New_Agri1405.php" class="btn">ثبت اطلاعات پایه، سال زراعی 1405-1404</a>
                    <a href="AgriP_edit_T_98.php" class="btn">تکمیل سطح برداشت و تولید قطعی</a>
                    <a href="liste_noon_edit.php" class="btn">لیست قطعات فاقد ویرایش</a>
                </div>

                <!-- کارت گزارشات -->
                <div class="card">
                    <img src="../../files/reports.png" alt="گزارشات" class="card-icon">
                    <a href="Sab_L3.php" class="btn">مشاهده برش الگوی کشت مرکز</a>
                    <a href="Agri_rep1.php" class="btn">گزارش اطلاعات زراعی به تفکیک بهره بردار</a>
                    <a href="Agri_rep15.php" class="btn">گزارش اطلاعات زراعی بهره بردار / محصول</a>
                    <a href="Agri_rep16.php" class="btn">گزارش محصولات زراعی</a>
                    <a href="Agri_rep170.php" class="btn">گزارش ویژه محصولات زراعی</a>
                    <a href="Agri_rep23.php" class="btn">گزارش ویژه اراضی زراعی</a>
                    <a href="Agri_rep160.php" class="btn">گزارش گروه محصولات زراعی</a>
                    <a href="Agri_deleted.php" class="btn">لیست حذفی های زراعی</a>
                </div>

                <!-- کارت محصولات صیفی -->
                <div class="card">
                    <img src="../../files/Vege.png" alt="محصولات صیفی" class="card-icon">
                    <a href="Vege.php" class="btn">ثبت اطلاعات محصولات عمده صیفی</a>
                    <a href="liste_Vege.php" class="btn">لیست اطلاعات محصولات عمده صیفی</a>
                    <a href="liste_T_Vege.php" class="btn">اطلاعات تکمیلی محصولات عمده صیفی</a>
                    <a href="liste_B_Vege.php" class="btn">اطلاعات سطح برداشت و تولید قطعی</a>
                    <a href="Vege_rep2.php" class="btn">گزارش ویژه محصولات صیفی</a>
                </div>
            </div>

            <a href="../index.php">
                <button class="back-button">بازگشت</button>
            </a>
        </div>

        <table width="100%" cellpadding="0" cellspacing="0" style="margin: 0; padding: 0;">
            <tr>
                <td height="109" style="background: url('../../files/bottom.gif') repeat-x; vertical-align: middle;">
                    <?php include('../../footer.php')?>
                </td>
            </tr>
        </table>
    </div>
</body>
</html> 