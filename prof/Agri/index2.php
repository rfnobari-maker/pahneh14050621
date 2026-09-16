<?php include("../../lock_p1.php"); ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
    <link href="../../FA.css" rel="stylesheet">
    <style>
        :root {
            --color-primary: #15803D;
            --color-on-primary: #FFFFFF;
            --color-secondary: #166534;
            --color-accent: #A16207;
            --color-on-accent: #FFFFFF;
            --color-background: #F0FDF4;
            --color-foreground: #14532D;
            --color-card: #FFFFFF;
            --color-card-foreground: #14532D;
            --color-muted: #E8F0F1;
            --color-muted-foreground: #475569;
            --color-border: #86C9A0;
            --color-destructive: #DC2626;
            --color-on-destructive: #FFFFFF;
            --color-ring: #15803D;
            --color-warning-bg: #FEF2F2;
            --space-1: 8px;
            --space-2: 16px;
            --space-3: 24px;
            --space-4: 32px;
            --radius: 12px;
            --duration: 200ms;
            --shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
            --touch: 44px;
            --font: myfont, Tahoma, "Segoe UI", sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-padding-top: 96px; }

        body.agri1-body {
            margin: 0;
            background: var(--color-background);
            color: var(--color-foreground);
            font-family: var(--font);
            font-size: 16px;
            line-height: 1.6;
        }

        .agri1-skip {
            position: absolute;
            right: -999px;
            top: 8px;
            z-index: 50;
            background: var(--color-primary);
            color: var(--color-on-primary);
            padding: 8px 16px;
            border-radius: 8px;
        }
        .agri1-skip:focus { right: 8px; }

        .agri1-main {
            width: min(920px, 100%);
            margin: 0 auto;
            padding: var(--space-3) var(--space-2) var(--space-4);
        }

        .agri1-title {
            margin: 0 0 var(--space-2);
            color: var(--color-foreground);
            font-size: clamp(1.35rem, 2.4vw, 1.85rem);
            line-height: 1.4;
            text-wrap: balance;
        }

        .agri1-hero { margin-bottom: var(--space-3); }

        .agri1-card {
            background: var(--color-card);
            color: var(--color-card-foreground);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: var(--space-3);
        }

        .agri1-card-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--color-border);
            font-size: 1rem;
        }

        .agri1-icon {
            flex: 0 0 auto;
            width: 24px;
            height: 24px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .agri1-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .agri1-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .agri1-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            min-height: var(--touch);
            min-width: var(--touch);
            padding: 10px 20px;
            border: 0;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            touch-action: manipulation;
            transition: background-color var(--duration) ease, transform var(--duration) ease, box-shadow var(--duration) ease, opacity var(--duration) ease;
        }
        .agri1-btn:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-btn:active { transform: translateY(1px); }

        .agri1-btn-primary {
            background: var(--color-primary);
            color: var(--color-on-primary);
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25);
        }
        .agri1-btn-primary:hover { background: var(--color-secondary); }

        .agri1-btn-accent {
            background: var(--color-accent);
            color: var(--color-on-accent);
        }
        .agri1-btn-accent:hover { background: #854D0E; }

        .agri1-btn-ghost {
            background: transparent;
            color: var(--color-foreground);
            border: 1px solid var(--color-border);
        }
        .agri1-btn-ghost:hover { background: var(--color-muted); }

        .agri1-back { margin-top: var(--space-3); }
        .agri1-back .agri1-btn { width: auto; }

        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            .agri1-btn:active { transform: none; }
        }
    </style>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#agri1-content">رفتن به محتوا</a>

    <?php include(__DIR__ . '/../../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri1-content">زراعت</h1>
        </header>

        <div class="agri1-grid">
            <section class="agri1-card" aria-labelledby="agri1-card-farm">
                <h2 class="agri1-card-title" id="agri1-card-farm">
                    <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 3v18"></path>
                        <path d="M5 10c3 0 5-3 7-7 2 4 4 7 7 7"></path>
                        <path d="M5 16c3 0 5-3 7-7 2 4 4 7 7 7"></path>
                    </svg>
                    بهره‌برداری زراعی
                </h2>
                <nav class="agri1-nav" aria-label="بهره‌برداری زراعی">
                    <a href="Agri1.php" class="agri1-btn agri1-btn-primary">ثبت بهره برداری زراعی جدید</a>
                    <a href="liste_Agri.php" class="agri1-btn agri1-btn-ghost">لیست بهره برداری های زراعی</a>
                    <a href="manager_Agri.php" class="agri1-btn agri1-btn-ghost">جستجوی بهره برداری زراعی</a>
                    <a href="New_Agri1406.php" class="agri1-btn agri1-btn-accent">ثبت اطلاعات پایه، سال زراعی 1406-1405</a>
                    <a href="New_Agri1405.php" class="agri1-btn agri1-btn-accent">ثبت اطلاعات پایه، سال زراعی 1405-1404</a>
                    <a href="AgriP_edit_T_98.php" class="agri1-btn agri1-btn-ghost">تکمیل سطح برداشت و تولید قطعی</a>
                    <a href="liste_noon_edit.php" class="agri1-btn agri1-btn-ghost">لیست قطعات فاقد ویرایش</a>
                    <a href="delivery.php" class="agri1-btn agri1-btn-ghost">ثبت گندم تحویلی به دولت</a>
                </nav>
            </section>

            <section class="agri1-card" aria-labelledby="agri1-card-reports">
                <h2 class="agri1-card-title" id="agri1-card-reports">
                    <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 19V5"></path>
                        <path d="M4 19h16"></path>
                        <path d="M8 16v-5"></path>
                        <path d="M12 16V8"></path>
                        <path d="M16 16v-3"></path>
                    </svg>
                    گزارشات
                </h2>
                <nav class="agri1-nav" aria-label="گزارشات">
                    <a href="Sab_L3.php" class="agri1-btn agri1-btn-ghost">مشاهده برش الگوی کشت مرکز</a>
                    <a href="Agri_rep1.php" class="agri1-btn agri1-btn-ghost">گزارش اطلاعات زراعی به تفکیک بهره بردار</a>
                    <a href="Agri_rep15.php" class="agri1-btn agri1-btn-ghost">گزارش اطلاعات زراعی بهره بردار / محصول</a>
                    <a href="Agri_rep16.php" class="agri1-btn agri1-btn-ghost">گزارش محصولات زراعی</a>
                    <a href="Agri_rep170.php" class="agri1-btn agri1-btn-ghost">گزارش ویژه محصولات زراعی</a>
                    <a href="Agri_rep23.php" class="agri1-btn agri1-btn-ghost">گزارش ویژه اراضی زراعی</a>
                    <a href="Agri_rep160.php" class="agri1-btn agri1-btn-ghost">گزارش گروه محصولات زراعی</a>
                    <a href="Agri_deleted.php" class="agri1-btn agri1-btn-ghost">لیست حذفی های زراعی</a>
                </nav>
            </section>

            <section class="agri1-card" aria-labelledby="agri1-card-vege">
                <h2 class="agri1-card-title" id="agri1-card-vege">
                    <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 21c0-6 4-9 8-10-1 5-5 8-8 10z"></path>
                        <path d="M12 21c0-6-4-9-8-10 1 5 5 8 8 10z"></path>
                        <path d="M12 11V3"></path>
                    </svg>
                    محصولات صیفی
                </h2>
                <nav class="agri1-nav" aria-label="محصولات صیفی">
                    <a href="Vege.php" class="agri1-btn agri1-btn-primary">ثبت اطلاعات محصولات عمده صیفی</a>
                    <a href="liste_Vege.php" class="agri1-btn agri1-btn-ghost">لیست اطلاعات محصولات عمده صیفی</a>
                    <a href="liste_T_Vege.php" class="agri1-btn agri1-btn-ghost">اطلاعات تکمیلی محصولات عمده صیفی</a>
                    <a href="liste_B_Vege.php" class="agri1-btn agri1-btn-ghost">اطلاعات سطح برداشت و تولید قطعی</a>
                    <a href="Vege_rep2.php" class="agri1-btn agri1-btn-ghost">گزارش ویژه محصولات صیفی</a>
                </nav>
            </section>

            <section class="agri1-card" aria-labelledby="agri1-card-req">
                <h2 class="agri1-card-title" id="agri1-card-req">
                    <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path>
                        <path d="M14 3v5h5"></path>
                        <path d="M9 13h6"></path>
                        <path d="M9 17h4"></path>
                    </svg>
                    درخواست تغییرات
                </h2>
                <nav class="agri1-nav" aria-label="درخواست تغییرات">
                    <a href="Agri_reg" class="agri1-btn agri1-btn-accent">ثبت و پیگیری درخواست تغییر محصول/مساحت </a>
                    <a href="Agri_req_bah" class="agri1-btn agri1-btn-accent">ثبت و پیگیری درخواست تغییر بهره بردار </a>
                </nav>
            </section>
        </div>

        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="../index.php">
                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                </svg>
                بازگشت به صفحه قبل
            </a>
        </p>
    </main>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td height="109" style="background: url('../../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../../footer.php'); ?>
            </td>
        </tr>
    </table>
</body>
</html>
