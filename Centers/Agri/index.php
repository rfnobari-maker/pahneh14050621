
<?php include("../../lock_p2.php");
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
        .card:nth-child(7) { animation-delay: 0.7s; }
        .card:nth-child(8) { animation-delay: 0.8s; }
        .card:nth-child(9) { animation-delay: 0.9s; }

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
            height: 86px;
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

        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid var(--gradient-start);
            border-right: 16px solid var(--gradient-end);
            border-bottom: 16px solid var(--hover-color);
            border-left: 16px solid var(--accent-color);
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            margin: 20px auto;
            display: none;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
                height: 70px;
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
            <h1 class="section-title">زراعت</h1>
            <img src="../../files/horizontal-line-700x223.png" alt="divider" class="divider">

            <div class="cards-container">
               <div class="card">
                    <a href="Sab_L3" title="مشاهده برش مرکز جهاد کشاورزی ">
                        <img src="../../files/region.png" alt="مشاهده برش مرکز جهاد کشاورزی " class="card-icon">
                    </a>
                    <a href="Sab_L3" class="btn">مشاهده برش مرکز جهاد کشاورزی </a>
                </div>
                            <div class="card">
                    <a href="liste_Agri.php" title="لیست بهره برداری های زراعی">
                        <img src="../../files/Sback.PNG" alt="agri_list" class="card-icon">
                    </a>
                    <a href="liste_Agri.php" class="btn">لیست بهره برداری های زراعی</a>
                </div>

                <div class="card">
                    <a href="Agri_rep14.php" title="گزارش اطلاعات زراعی به تفکیک بهره بردار">
                        <img src="../../files/morvege.png" alt="agri_rep" class="card-icon">
                    </a>
                    <a href="Agri_rep14.php" class="btn">گزارش اطلاعات زراعی به تفکیک بهره بردار</a>
                </div>

                <div class="card">
                    <a href="Agri_rep15.php" title="گزارش اطلاعات زراعی بهره بردار / محصول">
                        <img src="../../files/morvege.png" alt="Agri_rep15" class="card-icon">
                    </a>
                    <a href="Agri_rep15.php" class="btn">گزارش اطلاعات زراعی بهره بردار / محصول</a>
                </div>

                <div class="card">
                    <a href="Agri_rep16.php" title="گزارش محصولات زراعی">
                        <img src="../../files/agri_prod.png" alt="Agri_rep16" class="card-icon">
                    </a>
                    <a href="Agri_rep16.php" class="btn">گزارش محصولات زراعی</a>
                </div>

                <div class="card">
                    <a href="Agri_rep170.php" title="گزارش ویژه محصولات زراعی">
                        <img src="../../files/filter_data.png" alt="گزارش ویژه زراعت" class="card-icon">
                    </a>
                    <a href="Agri_rep170.php" class="btn">گزارش ویژه محصولات زراعی</a>
                </div>

                <div class="card">
                    <a href="AgriP_edit_T.php" title="بررسی تولید قطعی">
                        <img src="../../files/icon-rma.png" alt="bee" class="card-icon">
                    </a>
                    <a href="AgriP_edit_T.php" class="btn">بررسی تولید قطعی</a>
                </div>

                <div class="card">
                    <a href="list_Agri_no_editing.php" title="لیست قطعات فاقد ویرایش">
                        <img src="../../files/return.png" alt="سوابق" class="card-icon">
                    </a>
                    <a href="list_Agri_no_editing.php" class="btn">لیست قطعات فاقد ویرایش</a>
                </div>

                <div class="card">
                    <a href="review_prod_requests" title="درخواست های تغییر محصول /مساحت">
                        <img src="../../files/send_data.png" alt="Vege" class="card-icon">
                    </a>
                    <a href="review_prod_requests" class="btn">درخواست های تغییر محصول /مساحت</a>
                </div>
                <div class="card">
                    <a href="review_farmer_requests" title="درخواست های تغییر بهره بردار">
                        <img src="../../files/changeuser.png" alt="Vege" class="card-icon">
                    </a>
                    <a href="review_farmer_requests" class="btn">درخواست های تغییر بهره بردار</a>
                </div>
                <div class="card">
                    <a href="delivery" title="گندم تحویلی به دولت">
                        <img src="../../files/zera.png" alt="گندم تحویلی به دولت" class="card-icon">
                    </a>
                    <a href="delivery.php" class="btn">گندم تحویلی به دولت</a>
                </div>

                <div class="card">
                    <a href="Vege_pro.php" title="محصولات عمده صیفی">
                        <img src="../../files/Vege.png" alt="Vege" class="card-icon">
                    </a>
                    <a href="Vege_pro.php" class="btn">محصولات عمده صیفی</a>
                </div>


            </div>

            <a href="../prof.php">
                <input type="submit" value="بازگشت" class="back-button">
            </a>
        </div>

        <div class="footer">
            <?php include('../../footer.php') ?>
        </div>
    </div>

    <div class="loader" id="loader"></div>

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

            // Show loader when links are clicked
            document.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function() {
                    document.getElementById('loader').style.display = 'block';
                });
            });
        });
    </script>
</body>
</html> 