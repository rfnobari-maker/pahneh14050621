<?php
include("../lock_p1.php");
$page_title = (isset($title) && $title !== '') ? $title : 'بهره برداران کشاورزی';
$show_household = (isset($login_session) && $login_session == '1370736770');
$pahneh_crumb = array(
    array('label' => 'خانه', 'href' => '../indexbenef.php'),
    array('label' => 'اطلاعات اختصاصی', 'href' => 'index.php'),
    array('label' => 'بهره‌برداران کشاورزی'),
);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?></title>
    <link href="../FA.css" rel="stylesheet">
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
            z-index: 90;
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

        .agri1-stack {
            display: flex;
            flex-direction: column;
            gap: var(--space-3);
        }

        .agri1-card {
            background: var(--color-card);
            color: var(--color-card-foreground);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: var(--space-3);
        }

        .agri1-card-title {
            margin: 0 0 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--color-border);
            font-size: 1rem;
        }

        .agri1-choices {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        a.agri1-choice {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: var(--touch);
            padding: 12px 14px;
            border: 2px solid var(--color-border);
            border-radius: var(--radius);
            background: var(--color-card);
            color: var(--color-foreground);
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            touch-action: manipulation;
            transition: border-color var(--duration) ease, background-color var(--duration) ease, box-shadow var(--duration) ease;
        }
        a.agri1-choice:hover {
            border-color: var(--color-primary);
            background: #F7FEF9;
        }
        a.agri1-choice:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }

        .agri1-choice-text { flex: 1; min-width: 0; }

        .agri1-sticker {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: var(--radius);
            background: #ECFDF3;
            border: 1px solid var(--color-border);
            color: var(--color-primary);
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

        .agri1-btn-ghost {
            background: transparent;
            color: var(--color-foreground);
            border: 1px solid var(--color-border);
        }
        .agri1-btn-ghost:hover { background: var(--color-muted); }

        .agri1-back { margin-top: var(--space-3); }
        .agri1-back .agri1-btn { width: auto; }

        .agri1-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 80;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, 0.55);
            padding: var(--space-2);
        }
        .agri1-overlay.is-open { display: flex !important; }
        #agri1-overlay { z-index: 90; }

        .agri1-overlay-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            min-width: 220px;
            padding: 24px;
            border-radius: 16px;
            background: var(--color-card);
            color: var(--color-foreground);
        }

        .agri1-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--color-border);
            border-top-color: var(--color-primary);
            border-radius: 50%;
            animation: agri1-spin 0.8s linear infinite;
        }

        @keyframes agri1-spin { to { transform: rotate(360deg); } }

        @media (max-width: 640px) {
            .agri1-choices { grid-template-columns: 1fr; }
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

    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>

    <?php include(__DIR__ . '/../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri1-content">بهره برداران کشاورزی</h1>
        </header>

        <div class="agri1-stack">
            <section class="agri1-card" aria-labelledby="agri1-sec-register">
                <h2 class="agri1-card-title" id="agri1-sec-register">ثبت و استعلام</h2>
                <nav class="agri1-choices" aria-label="ثبت و استعلام">
                    <a href="benef.php" class="agri1-choice" title="ثبت بهره بردار جدید">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('user'); ?></span>
                        <span class="agri1-choice-text">ثبت بهره بردار جدید</span>
                    </a>
                    <a href="GetPerson.php#1" class="agri1-choice" title="استعلام مشخصات بهره بردار">
                        <span class="agri1-sticker" aria-hidden="true">
                            <svg class="agri1-icon" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="7"></circle>
                                <path d="M20 20l-3.5-3.5"></path>
                            </svg>
                        </span>
                        <span class="agri1-choice-text">استعلام مشخصات بهره بردار</span>
                    </a>
                </nav>
            </section>

            <section class="agri1-card" aria-labelledby="agri1-sec-search">
                <h2 class="agri1-card-title" id="agri1-sec-search">جستجو و فهرست</h2>
                <nav class="agri1-choices" aria-label="جستجو و فهرست">
                    <a href="manager_benef.php" class="agri1-choice" title="جستجوی یک بهره بردار">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('users'); ?></span>
                        <span class="agri1-choice-text">جستجوی یک بهره بردار</span>
                    </a>
                    <a href="liste_benef.php" class="agri1-choice" title="لیست بهره برداران">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('grid'); ?></span>
                        <span class="agri1-choice-text">لیست بهره برداران</span>
                    </a>
                    <a href="search_benef.php" class="agri1-choice" title="سوابق یک بهره بردار">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('edit'); ?></span>
                        <span class="agri1-choice-text">سوابق یک بهره بردار</span>
                    </a>
                    <a href="list_bah_lastname.php" class="agri1-choice" title="جستجو براساس نام خانوادگی">
                        <span class="agri1-sticker" aria-hidden="true">
                            <svg class="agri1-icon" viewBox="0 0 24 24">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </span>
                        <span class="agri1-choice-text">جستجو براساس نام خانوادگی</span>
                    </a>
                </nav>
            </section>

            <?php if ($show_household): ?>
            <section class="agri1-card" aria-labelledby="agri1-sec-household">
                <h2 class="agri1-card-title" id="agri1-sec-household">سرپرست خانوار</h2>
                <nav class="agri1-choices" aria-label="سرپرست خانوار">
                    <a href="Household_bah.php" class="agri1-choice" title="تعیین سرپرست خانوار">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('users'); ?></span>
                        <span class="agri1-choice-text">تعیین سرپرست خانوار</span>
                    </a>
                    <a href="Household.php" class="agri1-choice" title="ثبت سرپرست خانوار">
                        <span class="agri1-sticker" aria-hidden="true"><?php echo pahneh_chrome_icon('user'); ?></span>
                        <span class="agri1-choice-text">ثبت سرپرست خانوار</span>
                    </a>
                </nav>
            </section>
            <?php endif; ?>
        </div>

        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="index.php">
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
            <td height="109" style="background: url('../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../footer.php'); ?>
            </td>
        </tr>
    </table>
</body>
</html>
